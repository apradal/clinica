function SearchPatient() {

    this.filterForm = $('#table-filters-form');
    this.tableBody = $('#table-body');

    this.init = function () {
        this._setListeners();
    };

    this._setListeners = function () {
        let self = this;

        //search button
        this.filterForm.on('submit', function (e) {
            e.preventDefault();
            let form = $(this);

            $.ajax({
                url: form.attr('action'),
                type: 'GET',
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function (response) {
                if (response.success) {
                    self.tableBody.html(response.content);
                } else {

                }
            }).fail(function (response) {

            })

        })
    }
}

$(document).ready(function () {
    new SearchPatient().init();
});
