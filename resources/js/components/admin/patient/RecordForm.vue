<template>
    <form :action="this.route" @submit="formSubmit" method="post" ref="form">
        <div class="row">
            <div class="col-12">
                <h4>Historia</h4>
                <div class="alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
                <div class="alert alert-danger" ref="alertError" v-show="alertError"></div>
            </div>
            <div class="col-12 col-md-6" ref="allergiesEditable">
                <label for="allergies">Alergias:</label>
                <textarea v-model="record.allergies" class="form-control" id="allergies" name="allergies" readonly></textarea>
                <span class="edit-icon" data-target="allergiesEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="treatmentEditable">
                <label for="treatment">Tratamiento médico:</label>
                <textarea v-model="record.treatment" class="form-control" id="treatment" name="treatment" readonly></textarea>
                <span class="edit-icon" data-target="treatmentEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12">
                <input type="hidden" name="id" :value="record.id" />
                <input type="hidden" name="patient_id" :value="record.patient_id" />
                <button type="submit" ref="submit" v-show="showBtn">Guardar</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['route', 'patientData', 'recordData'],
        data: function() {
            return {
                showBtn: false,
                alertSuccess: false,
                alertError: false,
                record: {
                    id: this.recordData.id,
                    allergies: this.recordData.allergies,
                    treatment: this.recordData.treatment,
                    patient_id: this.patientData.id
                }
            }
        },
        methods: {
            edit(event) {
                let target = event.target.getAttribute('data-target');
                let wrapper = this.$refs[target];

                if (wrapper !== undefined) {
                    for (let i = 0; i < wrapper.children.length; i++) {
                        let elmt = wrapper.children[i];
                        if (elmt.hasAttribute('readonly')) elmt.removeAttribute('readonly');
                        elmt.focus();
                    }
                }
                this.showBtn = true;
            },
            formSubmit(event) {
                event.preventDefault();
                let self = this;

                axios.post(event.target.getAttribute('action'), this.record)
                    .then(function (response) {
                        let inputs = self.$refs.form.querySelectorAll('input, textarea');
                        for (let i = 0; i < inputs.length; i++) inputs[i].setAttribute('readonly', true);

                        self.showBtn = false;
                        self.$refs.alertSuccess.innerText = response.data.message;
                        self.alertSuccess = true;
                        setTimeout(() => self.alertSuccess = false, 3000);
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            }
        }
    }
</script>
