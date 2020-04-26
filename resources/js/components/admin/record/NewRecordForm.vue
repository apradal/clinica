<template>
    <form :action="this.route" v-on:submit="formSubmit" ref="form" method="post">
        <div class="row fieldset-separator">
            <div class="col-12 col-md-12 title-separator">
                <h4>Datos Personales</h4>
            </div>
            <div class="col-12 col-md-3 form__group">
                <input v-model="patient.name" id="name" class="form__field form-required" name="name" placeholder="Nombre"/>
                <label class="form__label" for="name">Nombre</label>
            </div>
            <div class="col-12 col-md-3 form__group">
                <input v-model="patient.surname" class="form__field form-required" id="surname" name="surname" placeholder="Apellidos"/>
                <label class="form__label" for="surname">Apellidos</label>
            </div>
            <div class="col-12 col-md-3 form__group">
                <input v-model="patient.nif" class="form__field" id="nif" name="nif" placeholder="DNI"/>
                <label class="form__label" for="nif">DNI</label>
            </div>
            <div class="col-12 col-md-3 form__group">
                <input type="date" v-model="patient.birth_year" class="form__field form-date" id="birth_year" name="birth_year" placeholder="Fecha de nacimiento"/>
                <label class="form__label" for="birth_year">Fecha de nacimiento</label>
            </div>
            <div class="col-12 col-md-4 form__group">
                <textarea v-model="patient.address" v-on:keyup="textAreaAdjust" placeholder="Dirección" class="form__field" id="address" name="address" rows="1"></textarea>
                <label class="form__label" for="address">Dirección</label>
            </div>
            <div class="col-12 col-md-4 form__group">
                <input v-model="patient.location" class="form__field" id="location" name="location" placeholder="Localidad"/>
                <label class="form__label" for="location">Localidad</label>
            </div>
            <div class="col-12 col-md-4 form__group">
                <input type="number" v-model="patient.postal_code" class="form__field" id="postal_code" name="postal_code" placeholder="Código postal"/>
                <label class="form__label" for="postal_code">Código postal</label>
            </div>
            <div class="col-12 col-md-4 form__group">
                <input type="email" v-model="patient.email" class="form__field" id="email" name="email" placeholder="Email"/>
                <label class="form__label" for="email">Email</label>
            </div>
            <div class="col-12 col-md-4 form__group">
                <input type="number" v-model="patient.phone" class="form__field form-required" id="phone" name="phone" placeholder="Teléfono"/>
                <label class="form__label" for="phone">Teléfono</label>
            </div>
            <div class="col-12 col-md-4 form__group">
                <input type="number" v-model="patient.phone2" class="form__field" id="phone2" name="phone2" placeholder="Teléfono 2"/>
                <label class="form__label" for="phone2">Teléfono 2</label>
            </div>
            <div class="col-12 col-md-4 form__group">
                <textarea v-model="patient.insurance" v-on:keyup="textAreaAdjust" class="form__field" id="insurance" name="insurance" placeholder="Aseguradora" rows="1"></textarea>
                <label class="form__label" for="insurance">Aseguradora</label>
            </div>
        </div>
        <div class="row fieldset-separator">
            <div class="col-12 col-md-12 title-separator">
                <h4>Historia</h4>
            </div>
            <div class="col-12 col-md-6 form__group">
                <textarea v-model="record.allergies" v-on:keyup="textAreaAdjust" class="form__field" id="allergies" name="allergies" placeholder="Aseguradora" rows="1"></textarea>
                <label class="form__label" for="allergies">¿Tiene usted alguna alergia?</label>
            </div>
            <div class="col-12 col-md-6 form__group">
                <textarea v-model="record.treatment" v-on:keyup="textAreaAdjust" class="form__field" id="treatment" name="treatment" placeholder="Aseguradora" rows="1"></textarea>
                <label class="form__label" for="treatment">¿Está usted bajo tratamiento médico?</label>
            </div>
        </div>
        <div class="row fieldset-separator">
            <div class="col-12 col-md-12 title-separator">
                <h4>Enfermedades</h4>
                <div class="show-form" v-on:click="toggleForm"><span>{{showFormText}}</span></div>
            </div>
            <div class="col-12">
                <div v-show="showForm" class="row">
                    <div class="col-12 col-md-6 form__group">
                        <label for="heart">Corazón</label>
                        <select v-model="diseases.heart" class="form__field" name="heart" id="heart">
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <textarea v-model="diseases.heart_description" v-show="diseases.heart" v-on:keyup="textAreaAdjust"
                                  class="form__field" name="heart_description"></textarea>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                        <label for="osteoporosis">Osteoporosis</label>
                        <select v-model="diseases.osteoporosis" class="form__field" name="osteoporosis" id="osteoporosis">
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <textarea v-model="diseases.osteoporosis_description" v-show="diseases.osteoporosis" v-on:keyup="textAreaAdjust"
                                  class="form__field" name="osteoporosis_description"></textarea>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                        <label for="liver">Hígado</label>
                        <select v-model="diseases.liver" class="form__field" name="liver" id="liver" >
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <textarea v-model="diseases.liver_description" v-show="diseases.liver" v-on:keyup="textAreaAdjust"
                                  class="form__field" name="liver_description"></textarea>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                        <label for="cancer">Cancer</label>
                        <select v-model="diseases.cancer" class="form__field" name="cancer" id="cancer">
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <textarea v-model="diseases.cancer_description" v-show="diseases.cancer" v-on:keyup="textAreaAdjust"
                                  class="form__field" name="cancer_description"></textarea>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                        <label for="kidney">Riñón</label>
                        <select v-model="diseases.kidney" class="form__field" name="kidney" id="kidney">
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <textarea v-model="diseases.kidney_description" v-show="diseases.kidney" v-on:keyup="textAreaAdjust"
                                  class="form__field" name="kidney_description"></textarea>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                        <label for="hiv">IVH</label>
                        <select v-model="diseases.hiv" class="form__field" name="hiv" id="hiv">
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <textarea v-model="diseases.hiv_description" v-show="diseases.hiv" v-on:keyup="textAreaAdjust"
                                  class="form__field" name="hiv_description"></textarea>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                        <label for="lung">Pulmón</label>
                        <select v-model="diseases.lung" class="form__field" name="lung" id="lung">
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <textarea v-model="diseases.lung_description" v-show="diseases.lung" v-on:keyup="textAreaAdjust"
                                  class="form__field" name="lung_description"></textarea>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                        <div><span>Hepatitis</span></div>
                        <template v-for="radio in radioInputs">
                            <input type="radio" class="form__radio" v-model="diseases.hepatitis_description" name="hepatitis_description"
                                   :id="'hepatitis_' + radio.label" v-bind:value="radio.value"/>
                            <label class="form__label_radio" :for="'hepatitis_' + radio.label">{{radio.label}}</label>
                        </template>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                        <label for="diabetes">Diabetes</label>
                        <select v-model="diseases.diabetes" class="form__field" name="diabetes" id="diabetes">
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <textarea v-model="diseases.diabetes_description" v-show="diseases.diabetes" v-on:keyup="textAreaAdjust"
                                  class="form__field" name="diabetes_description"></textarea>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                        <label for="circulatory">Circulatorio</label>
                        <select v-model="diseases.circulatory" class="form__field" name="circulatory" id="circulatory">
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <textarea v-model="diseases.circulatory_description" v-show="diseases.circulatory" v-on:keyup="textAreaAdjust"
                                  class="form__field" name="circulatory_description"></textarea>
                    </div>
                    <div class="col-12 col-md-6 form__group">
                    <textarea v-model="diseases.others_description" v-on:keyup="textAreaAdjust"
                              class="form__field" id="others_description" name="others_description" placeholder="Otros"></textarea>
                        <label class="form__label" for="others_description">Otros</label>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <slot name="csrf"></slot>
            <button class="dark-white-btn" type="submit" ref="submit">Guardar <font-awesome-icon icon="save" /></button>
        </div>
    </form>
</template>

<script>
    import FormValidator from '../../generic/mixins/FormValidator';

    export default {
        props: ['route'],
        mixins: [FormValidator],
        data: function() {
            return {
                showForm: false,
                showFormText: 'Mostrar Información',
                patient: {
                    name: null,
                    surname: null,
                    nif: null,
                    email: null,
                    address: null,
                    postal_code: null,
                    location: null,
                    phone: null,
                    phone2: null
                },
                record: {
                    allergies: null,
                    treatment: null
                },
                diseases: {
                    heart: 0,
                    heart_description: null,
                    osteoporosis: 0,
                    osteoporosis_description: null,
                    liver: 0,
                    liver_description: null,
                    cancer: 0,
                    cancer_description: null,
                    kidney: 0,
                    kidney_description: null,
                    hiv: 0,
                    hiv_description: null,
                    lung: 0,
                    lung_description: null,
                    hepatitis_description: null,
                    diabetes: 0,
                    diabetes_description: null,
                    circulatory: 0,
                    circulatory_description: null,
                    others_description: null
                },
                selectOptions: [
                    {text: 'Si', value: 1},
                    {text: 'No', value: 0}
                ],
                radioInputs: [
                    {label: 'A', value: 'a'},
                    {label: 'B', value: 'b'},
                    {label: 'C', value: 'c'}
                ]
            }
        },
        methods: {
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
            },
            formSubmit(event) {
                event.preventDefault();

                if (FormValidator.methods.validate(this.$refs.form)) event.target.submit();
            }
        }
    }
</script>
