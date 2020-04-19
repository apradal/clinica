<script>
    export default {
        data: function() {
            return {
                form: null,
                validated: null,
                requiredClass: null,
                requiredInputs: null,
                requiredMsgs: null,
            }
        },
        methods: {
            init: function (form) {
                this.form = form;
                this.validated = true;
                this.requiredClass = '.form-required';
                this.requiredInputs = 0;
                this.requiredMsgs = '*Este campo es obligatorio';
            },
            validate: function(form) {
                this.init(form);
                this._required();

                return this.validated;
            },
            _required: function () {
                if ((this.requiredInputs = this.form.querySelectorAll(this.requiredClass)).length > 0) {
                    let self = this;

                    this.requiredInputs.forEach((el, idx) => {
                        if (el.value.length <= 0) {
                            this.validated = false;
                            self._printRequired(el)
                        }
                    });
                }
            },
            _printRequired: function (el) {
                let span = document.createElement('span');
                span.style.color = 'red';
                span.innerText = this.requiredMsgs;
                el.style.borderColor = 'red';
                el.parentNode.insertBefore(span, el.nextSibling);
                setTimeout(function () {
                    el.style.removeProperty('border-color');
                    span.remove()
                }, 3000)
            }
        }
    }
</script>