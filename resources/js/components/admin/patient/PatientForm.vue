<template>
    <form :action="this.route" @submit="formSubmit" method="post" ref="form">
        <div>
            <h4>Datos Personales</h4>
            <div class="alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
            <div class="alert alert-danger" ref="alertError" v-show="alertError"></div>
        </div>
        <div class="row" v-show="showForm">
            <div class="col-12 col-md-4" ref="emailEditable">
                <label class="col-form-label" for="email">Email:</label>
                <input v-model="patient.email" id="email" class="form-control" name="email" readonly/>
                <font-awesome-icon icon="edit" class="edit-icon" data-target="emailEditable" v-on:click="edit"/>
            </div>
            <div class="col-12 col-md-4" ref="birthYearEditable">
                <label class="col-form-label" for="birth_year">Fecha de nacimiento:</label>
                <input v-model="patient.birth_year" type="date" id="birth_year" class="form-control form-date" readonly name="birth_year"/>
                <span class="edit-icon" data-target="birthYearEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-4" ref="nifEditable">
                <label class="col-form-label" for="nif">Dni:</label>
                <input v-model="patient.nif" type="text" id="nif" class="form-control" readonly name="nif"/>
                <span class="edit-icon" data-target="nifEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-4" ref="addressEditable">
                <label class="col-form-label" for="address">Dirección:</label>
                <textarea v-model="patient.address" v-on:keyup="textAreaAdjust"
                          id="address" class="form-control" name="address" readonly></textarea>
                <span class="edit-icon" data-target="addressEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-4" ref="locationEditable">
                <label class="col-form-label" for="location">Localidad:</label>
                <input v-model="patient.location" type="text" id="location" class="form-control" readonly name="location"/>
                <span class="edit-icon" data-target="locationEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-4" ref="postalcodeEditable">
                <label class="col-form-label" for="location">Código postal:</label>
                <input v-model="patient.postal_code" type="text" id="postal_code" class="form-control" readonly name="postal_code"/>
                <span class="edit-icon" data-target="postalcodeEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-4" ref="phoneEditable">
                <label class="col-form-label" for="phone">Teléfono:</label>
                <input v-model="patient.phone" type="number" id="phone" class="form-control" name="phone" readonly />
                <span class="edit-icon" data-target="phoneEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-4" ref="phone2Editable">
                <label class="col-form-label" for="phone2">Teléfono 2:</label>
                <input v-model="patient.phone2" type="number" class="form-control" id="phone2" name="phone2" readonly />
                <span class="edit-icon" data-target="phone2Editable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-4" ref="insuranceEditable">
                <label class="col-form-label" for="insurance">Aseguradora:</label>
                <textarea v-model="patient.insurance" v-on:keyup="textAreaAdjust"
                          class="form-control" id="insurance" name="insurance" readonly></textarea>
                <span class="edit-icon" data-target="insuranceEditable" v-on:click="edit">edit</span>
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
    import FormValidator from '../../generic/mixins/FormValidator';

    export default {
        props: ['route', 'patientData'],
        mixins: [FormValidator],
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
                    insurance: this.patientData.insurance,
                    nif: this.patientData.nif,
                    postal_code: this.patientData.postal_code,
                    location: this.patientData.location
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

                if (FormValidator.methods.validate(this.$refs.form)) {
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
                }
            },
            toggleForm() {
                if (!this.showForm) {
                    this.showForm = true;
                    this.showFormText = 'Ocultar Información';
                } else {
                    this.showForm = false;
                    this.showFormText = 'Mostrar Información';
                }
            },
            textAreaAdjust(event) {
                if (event.target.scrollHeight >= 58)
                    event.target.style.height = event.target.scrollHeight + "px";
            }
        }
    }
</script>
