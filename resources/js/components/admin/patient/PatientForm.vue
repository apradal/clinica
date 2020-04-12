<template>
    <form :action="this.route" @submit="formSubmit" method="post" ref="form">
        <div>
            <h4>Datos Personales</h4>
            <div class="alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
            <div class="alert alert-danger" ref="alertError" v-show="alertError"></div>
        </div>
        <div class="row" v-show="showForm">
            <div class="col-12 col-md-6" ref="emailEditable">
                <label class="col-form-label" for="email">Email:</label>
                <input v-model="patient.email" id="email" class="form-control" name="email" readonly/>
                <span class="edit-icon" data-target="emailEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="birthYearEditable">
                <label class="col-form-label" for="birth_year">Fecha de nacimiento:</label>
                <input v-model="patient.birth_year" type="date" id="birth_year" class="form-control" readonly name="birth_year"/>
                <span class="edit-icon" data-target="birthYearEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="addressEditable">
                <label class="col-form-label" for="address">Dirección:</label>
                <textarea v-model="patient.address" id="address" class="form-control" name="address" readonly></textarea>
                <span class="edit-icon" data-target="addressEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="insuranceEditable">
                <label class="col-form-label" for="insurance">Aseguradora:</label>
                <textarea v-model="patient.insurance" class="form-control" id="insurance" name="insurance" readonly></textarea>
                <span class="edit-icon" data-target="insuranceEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="phoneEditable">
                <label class="col-form-label" for="phone">Teléfono:</label>
                <input v-model="patient.phone" type="number" id="phone" class="form-control" name="phone" readonly />
                <span class="edit-icon" data-target="phoneEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="phone2Editable">
                <label class="col-form-label" for="phone2">Teléfono 2:</label>
                <input v-model="patient.phone2" type="number" class="form-control" id="phone2" name="phone2" readonly />
                <span class="edit-icon" data-target="phone2Editable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12">
                <input type="hidden" name="id" :value="patient.id" />
                <button type="submit" ref="submit" v-show="showBtn">Guardar</button>
            </div>
        </div>
        <div class="show-form" v-on:click="toggleForm"><span>{{showFormText}}</span></div>
    </form>
</template>

<script>
    export default {
        props: ['route', 'patientData'],
        data: function() {
            return {
                showForm: false,
                showFormText: 'Mostrar Información',
                showBtn: false,
                alertSuccess: false,
                alertError: false,
                patient: {
                    id: this.patientData.id,
                    email: this.patientData.email,
                    birth_year: this.patientData.birth_year,
                    phone: this.patientData.phone,
                    phone2: this.patientData.phone2,
                    address: this.patientData.address,
                    insurance: this.patientData.insurance
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

                axios.post(event.target.getAttribute('action'), this.patient)
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
            },
            toggleForm() {
                if (!this.showForm) {
                    this.showForm = true;
                    this.showFormText = 'Ocultar Información';
                } else {
                    this.showForm = false;
                    this.showFormText = 'Mostrar Información';
                }
            }
        }
    }
</script>
