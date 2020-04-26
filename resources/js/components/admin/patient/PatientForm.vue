<template>
    <form :action="this.route" @submit="formSubmit" method="post" ref="form">
        <div class="fieldset-separator">
            <div class="title-separator"><h4>Datos Personales</h4></div>
            <div class="col-12 alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
            <div class="col-12 alert alert-danger" ref="alertError" v-show="alertError"></div>
            <div class="row" v-show="showForm">
                <div class="col-12 col-md-4 form__group flex flex-baseline" ref="emailEditable">
                    <input type="email" v-model="patient.email" id="email" class="form__field" name="email" placeholder="Email" readonly/>
                    <label class="form__label" for="email">Email</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('emailEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('emailEditable')" />
                    </button>
                </div>
                <div class="col-12 col-md-4 form__group flex flex-baseline" ref="birthYearEditable">
                    <input v-model="patient.birth_year" type="date" id="birth_year" class="form__field form-date" readonly name="birth_year" placeholder="Fecha de nacimiento"/>
                    <label class="form__label" for="birth_year">Fecha de nacimiento</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('birthYearEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('birthYearEditable')" />
                    </button>
                </div>
                <div class="col-12 col-md-4 form__group flex flex-baseline" ref="nifEditable">
                    <input v-model="patient.nif" type="text" id="nif" class="form__field" readonly name="nif" placeholder="Dni"/>
                    <label class="form__label" for="nif">Dni</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('nifEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('nifEditable')" />
                    </button>
                </div>
                <div class="col-12 col-md-4 form__group flex" ref="addressEditable">
                    <textarea v-model="patient.address" v-on:keyup="textAreaAdjust"
                              id="address" class="form__field" placeholder="Direccion" name="address" readonly></textarea>
                    <label class="form__label" for="address">Dirección</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('addressEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('addressEditable')" />
                    </button>
                </div>
                <div class="col-12 col-md-4 form__group flex flex-baseline" ref="locationEditable">
                    <input v-model="patient.location" type="text" id="location" class="form__field" placeholder="Localidad" readonly name="location"/>
                    <label class="form__label" for="location">Localidad</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('locationEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('locationEditable')" />
                    </button>
                </div>
                <div class="col-12 col-md-4 form__group flex flex-baseline" ref="postalcodeEditable">
                    <input v-model="patient.postal_code" type="text" id="postal_code" class="form__field" placeholder="Código postal" readonly name="postal_code"/>
                    <label class="form__label" for="location">Código postal</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('postalcodeEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('postalcodeEditable')" />
                    </button>
                </div>
                <div class="col-12 col-md-4 form__group flex flex-baseline" ref="phoneEditable">
                    <input v-model="patient.phone" type="number" id="phone" class="form__field" name="phone" readonly placeholder="Teléfono" />
                    <label class="form__label" for="phone">Teléfono</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('phoneEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('phoneEditable')" />
                    </button>
                </div>
                <div class="col-12 col-md-4 form__group flex flex-baseline" ref="phone2Editable">
                    <input v-model="patient.phone2" type="number" class="form__field" id="phone2" name="phone2" readonly placeholder="Teléfono 2" />
                    <label class="form__label" for="phone2">Teléfono 2</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('phone2Editable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('phone2Editable')" />
                    </button>
                </div>
                <div class="col-12 col-md-4 form__group flex" ref="insuranceEditable">
                    <textarea v-model="patient.insurance" v-on:keyup="textAreaAdjust"
                              class="form__field" id="insurance" name="insurance" readonly placeholder="Aseguradora"></textarea>
                    <label class="form__label" for="insurance">Aseguradora</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('insuranceEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('insuranceEditable')" />
                    </button>
                </div>
                <div class="col-12 title-separator">
                    <input type="hidden" name="id" :value="patient.id" />
                    <button type="submit" class="dark-white-btn" ref="submit" v-show="showBtn">Guardar <font-awesome-icon icon="save" /></button>
                </div>
            </div>
            <div class="col-12 show-form" v-on:click="toggleForm"><span>{{showFormText}}</span></div>
        </div>
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
            edit(dataTarget) {
                let wrapper = this.$refs[dataTarget];

                if (wrapper !== undefined) {
                    for (let i = 0; i < wrapper.children.length; i++) {
                        let elmt = wrapper.children[i];
                        if (elmt.hasAttribute('readonly')) elmt.removeAttribute('readonly');
                        if (elmt.nodeName === 'INPUT' || elmt.nodeName === 'TEXTAREA') elmt.focus();
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
