function Patient() {

    this.addBtnTreatment = $('#add-treatment-btn');
    this.treatmentTable = $('#treatment-table');
    this.ajaxMsgRow = $('#btn-row');
    this.editIcons = $('.edit-icon');
    this.forms = $('#patient-edit-form, .treatments-edit-form, #record-edit-form, #diseases-edit-form');

    this.init = function () {
        this._addBtnListeners();
        this._addFormListeners();
    };

    this._addBtnListeners = function ()
    {
        let self = this;
        //Add Treatment button
        this.addBtnTreatment.on('click', function () {
            //print form
            if (!$(this).hasClass('submit')) {
                let formId = self._createDynamicTreatmentForm();
                $(this).addClass('submit');
                $(this).html('Guardar');
                $(this).attr('data-form-id', formId);
            } else if ($(this).hasClass('submit')) {
                $(this).attr('disabled', true);
                let form = $('#' + $(this).attr('data-form-id'));
                self._sendFormTreatmentAjax(form);
            }
        });
        //Edit patient data icons
        this.editIcons.on('click', function () {
            let wrapper = $('#' + $(this).data('target'));
            let inputs = wrapper.find('input, textarea, select');
            let submit = $(this).closest('form').find('button[type="submit"]');

            //iterate all inputs
            inputs.each(function (counter, elmt) {
                if ($(elmt).attr('readOnly')) $(elmt).attr('readOnly', false);
                if ($(elmt).attr('disabled')) $(elmt).attr('disabled', false);
                let type = $(elmt).attr('type');

                if (type !== 'radio') $(elmt).attr('data-changed', true);

                //set focus
                if ($(elmt).data('focus')) {
                    $(elmt).focus();
                    if (type !== 'date' || type !== 'radio') {
                        let strLength = $(elmt).val().length * 2;
                        $(elmt)[0].setSelectionRange(strLength, strLength);
                    }
                }
            });

            if (submit.hasClass('hidden')) submit.removeClass('hidden');
        })
    };

    this._addFormListeners = function ()
    {
        let self = this;

        this.forms.on('submit', function (e) {
            e.preventDefault();

            let data = self._getInputsModified($(this));
            let form = $(this);

            if (Object.keys(data).length) {
                self._editFormAjax(form, data, function (response) {
                    if (response.success) {
                        $.each(form.find(':input'), function () {
                            if ($(this).attr('type') === 'submit') {
                                return true;
                            } else if ($(this).prop('type') === 'select-one') {
                                $(this).attr('disabled', true);
                            } else {
                                $(this).attr('readonly', true);
                            }
                        });
                        form.find('button[type="submit"]').addClass('hidden');
                        let success = form.find('.alert-success');
                        if (success.css('display') === 'none') success.css('display', '');
                        success.html(response.message).delay(2000).fadeOut('slow');
                    } else {
                        form.find('.alert-danger').html(response.message).delay(2000).fadeOut('slow');
                    }
                });
            }
        });
    };

    this._editFormAjax = function (form, data, successCallback, failCallback) {
        let self = this;

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (response) {
            successCallback(response);
        }).fail(function (response) {
            //todo show errors
            console.log('Error')
        })
    };

    this._createDynamicTreatmentForm = function()
    {
        let id = this.makeUniqueId();
        //form
        let form = $('<form></form>');
        form.attr({
            'id': id,
            'action': 'patient/add-treatment-ajax',
            'method': 'POST'
        });
        //row
        let row = $('<div></div>');
        row.attr({'class': 'tr', 'id': 'row-' + id});
        //inputs
        let patientInput = $('<input type="hidden" />');
        patientInput.attr({
            'name': 'patient-id',
            'value': this.treatmentTable.data('pacient-id')
        });
        let dateInput = $('<input type="date" />');
        dateInput.attr({
            'name': 'date',
            'class': 'td',
            'value': ''
        });
        let descriptionTextArea = $('<textarea></textarea>');
        descriptionTextArea.attr({
            'name': 'description',
            'class': 'td',
            'cols': '60',
            'rows': '2'
        });

        row.append([dateInput, descriptionTextArea, patientInput]);
        form.append(row);

        this.addBtnTreatment.before(form);

        return id;
    };

    this._sendFormTreatmentAjax = function (form) {
        this._readOnlyInputs(form, true);
        let self = this;

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function (response) {
            if (response.success) {
                self.addBtnTreatment.removeClass('submit');
                self.addBtnTreatment.html('Añadir');
                self.addBtnTreatment.attr('disabled', false);
                self.ajaxMsgRow.find('.alert-success').html('Tratamiento añadido');
                self.ajaxMsgRow.find('.alert-danger').html('');
            } else {
                self.ajaxMsgRow.find('.alert-danger').html('Error al añadir tratamiento');
                self.ajaxMsgRow.find('.alert-success').html('');
                self.addBtnTreatment.attr('disabled', false);
                self._readOnlyInputs(form, false);
            }
        }).fail(function (response) {
            self.ajaxMsgRow.find('.alert-danger').html('Error al añadir tratamiento');
            self.ajaxMsgRow.find('.alert-success').html('');
            self.addBtnTreatment.attr('disabled', false);
            self._readOnlyInputs(form, false);
        })
    };

    this._readOnlyInputs = function (form, $value)
    {
        let id = form.attr('id');
        $('#'+id+' input, #'+id+' textarea').each(function () {
            $(this).attr('readOnly', $value);
        })
    };

    this.makeUniqueId = function ()
    {
        return Math.random().toString(36).substr(2, 9);
    };

    /**
     * Gets only the data from inputs modified.
     * @param form
     * @private
     */
    this._getInputsModified = function (form) {
        let data = {};

        $.each(form.find(':input'), function() {
            if (($(this).data('changed') || $(this).attr('type') === 'hidden') || $(this).is(':checked')) {
                data[$(this).attr('name')] = $(this).val();
            }
        });

        return data;
    }
}

$(document).ready(function () {
    new Patient().init();
});
