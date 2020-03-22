function Patient() {

    this.addBtnTreatment = $('#add-treatment-btn');
    this.treatmentTable = $('#treatment-table');

    this.init = function () {
        this._addBtnListeners()
    };

    this._addBtnListeners = function ()
    {
        let self = this;
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
                self._sendFormAjax(form);
            }
        });
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
            'class': 'td'
        });

        row.append([dateInput, descriptionTextArea, patientInput]);
        form.append(row);

        this.addBtnTreatment.before(form);

        return id;
    };

    this._sendFormAjax = function (form) {
        this._readOnlyInputs(form);
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
            } else {
                //TODO messages of succes or error under form.
                console.log('error')
                self.addBtnTreatment.attr('disabled', false);
            }
        }).fail(function (response) {
            console.log('error')
            self.addBtnTreatment.attr('disabled', false);
        })
    };

    this._readOnlyInputs = function (form)
    {
        let id = form.attr('id');
        $('#'+id+' input, #'+id+' textarea').each(function () {
            $(this).attr('readOnly', true);
        })
    };

    this.makeUniqueId = function ()
    {
        return Math.random().toString(36).substr(2, 9);
    }
}

$(document).ready(function () {
    new Patient().init();
});
