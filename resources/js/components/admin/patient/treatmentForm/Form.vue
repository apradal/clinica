<template>
    <form :action="this.route" @submit="formSubmit" ref="form" method="post" >
        <div class="alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
        <div class="alert alert-danger" ref="alertError" v-show="alertError"></div>
        <div class="row" ref="treatmentEditable">
            <div class="col-12 col-md-2">
                <input type="date" v-model="treatment.date" class="form-control form-required" name="date" :readonly="!this.new" />
            </div>
            <div class="col-12 col-md-10">
                <textarea v-model="treatment.description" v-on:keyup="textAreaAdjust"
                          class="form-control" name="description" :readonly="!this.new"></textarea>
            </div>
            <input v-model="treatment.id" type="hidden" name="id" />
            <input v-model="treatment.patient_id" type="hidden" name="patient_id" />
            <span class="edit-icon" v-show="!this.new" data-target="treatmentEditable" v-on:click="edit">edit</span>
            <span class="delete-icon" v-show="!this.new" v-on:click="openModal">delete</span>
            <button type="submit" v-show="showBtn">Guardar</button>
        </div>
    </form>
</template>

<script>
    import FormValidator from '../../../generic/mixins/FormValidator';

    export default {
        props: ['routes', 'treatmentData', 'index'],
        mixins: [FormValidator],
        data: function() {
            return {
                new: this.treatmentData.new,
                showBtn: false,
                alertSuccess: false,
                alertError: false,
                route: this.treatmentData.new ? this.routes.add : this.routes.edit,
                treatment: {
                    id: this.treatmentData.id,
                    date: this.treatmentData.date,
                    description: this.treatmentData.description,
                    patient_id: this.treatmentData.patient_id
                }
            }
        },
        methods: {
            edit(event) {
                let target = event.target.getAttribute('data-target');
                let wrapper = this.$refs[target];

                if (wrapper !== undefined) {
                    wrapper.querySelectorAll('input, textarea').forEach(function (elmt) {
                        if (elmt.hasAttribute('readonly')) elmt.removeAttribute('readonly');
                        if (elmt.hasAttribute('disabled')) elmt.removeAttribute('disabled');
                        elmt.focus();
                    })
                }
                this.showBtn = true;
            },
            remove() {
                axios
                    .post(this.routes.delete, this.treatment)
                    .then(function (response) {})
            },
            openModal() {
                this.$emit('openModal', this)
            },
            formSubmit(event) {
                event.preventDefault();
                let self = this;

                if (FormValidator.methods.validate(this.$refs.form)) {
                    axios.post(event.target.getAttribute('action'), this.treatment)
                        .then(function (response) {
                            self.new = false;
                            self.route = self.routes.edit;
                            self.showBtn = false;

                            //if new form has been saved and page haven't been reloaded, it needs id for edit.
                            if (self.treatment.id === null || self.treatment.id === undefined && response.success === true)
                                self.treatment.id = response.data.id;

                            let inputs = event.target.querySelectorAll('input, textarea');
                            for (let i = 0; i < inputs.length; i++) inputs[i].setAttribute('readonly', true);

                            self.$refs.alertSuccess.innerText = response.data.message;
                            self.alertSuccess = true;
                            setTimeout(() => self.alertSuccess = false, 3000);
                        })
                        .catch(function (error) {
                            let data = error.response.data;
                            if (data.error) {
                                self.$refs.alertError.innerText = data.message;
                                self.alertError = true;
                                setTimeout(() => self.alertError = false, 5000);
                            }
                        });
                }
            },
            textAreaAdjust(event) {
                if (event.target.scrollHeight >= 58)
                    event.target.style.height = event.target.scrollHeight + "px";
            }
        },
        created() {
            this.showBtn = this.new
        }
    }
</script>