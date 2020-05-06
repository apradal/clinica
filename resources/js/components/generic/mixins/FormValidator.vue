<script>
    export default {
        data: function() {
            return {
                form: null,
                validated: null,
                requiredClass: null,
                requiredInputs: null,
                dateClass: null,
                dateInputs: null,
                requiredMsgs: null,
            }
        },
        methods: {
            init: function (form) {
                this.form = form;
                this.validated = true;
                this.requiredClass = '.form-required';
                this.dateClass = '.form-date';
                this.requiredInputs = 0;
                this.dateInputs = 0;
                this.requiredMsg = '*Campo obligatorio';
                this.dateMsg = '*Fecha introducida errónea'
            },
            validate: function(form) {
                this.init(form);
                this._required();
                this._date();

                return this.validated;
            },
            _required: function () {
                if ((this.requiredInputs = this.form.querySelectorAll(this.requiredClass)).length > 0) {
                    let self = this;

                    this.requiredInputs.forEach((el, idx) => {
                        if (el.value.length <= 0) {
                            this.validated = false;
                            self._printRequired(el, this.requiredMsg)
                        }
                    });
                }
            },
            _date: function() {
                if ((this.dateInputs = this.form.querySelectorAll(this.dateClass)).length > 0) {
                    let self = this;

                    this.dateInputs.forEach((el, idx) => {
                        if (el.value.length > 0) {
                            if (!el.value.match(/^\d{4}\-\d{1,2}\-\d{1,2}$/g)) {
                                this.validated = false;
                                self._printRequired(el, this.dateMsg)
                            }
                        }
                    });
                }
            },
            _printRequired: function (el, msg) {
                let span = document.createElement('p');
                span.style.color = 'red';
                span.innerText = msg;
                el.style.borderColor = 'red';
                el.parentNode.insertBefore(span, el.nextSibling);
                setTimeout(function () {
                    el.style.removeProperty('border-color');
                    span.remove();
                }, 3000)
            }
        }
    }
</script>