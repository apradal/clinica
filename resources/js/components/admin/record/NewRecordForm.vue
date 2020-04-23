<template>
    <form :action="this.route" v-on:submit="formSubmit" ref="form" method="post">
        <div>
            <h4>Datos Personales</h4>
        </div>
        <div class="row">
            <div class="col-12 col-md-3">
                <label class="col-form-label" for="name">Nombre:</label>
                <input v-model="patient.name" id="name" class="form-control form-required" name="name"/>
            </div>
            <div class="col-12 col-md-3">
                <label class="col-form-label" for="surname">Apellidos:</label>
                <input v-model="patient.surname" class="form-control form-required" id="surname" name="surname"/>
            </div>
            <div class="col-12 col-md-3">
                <label class="col-form-label" for="nif">DNI:</label>
                <input v-model="patient.nif" class="form-control" id="nif" name="nif"/>
            </div>
            <div class="col-12 col-md-3">
                <label class="col-form-label" for="birth_year">Fecha de nacimiento:</label>
                <input type="date" v-model="patient.birth_year" class="form-control form-date" id="birth_year" name="birth_year"/>
            </div>
            <div class="col-12 col-md-4">
                <label class="col-form-label" for="address">Dirección:</label>
                <textarea v-model="patient.address" v-on:keyup="textAreaAdjust" class="form-control" id="address" name="address"></textarea>
            </div>
            <div class="col-12 col-md-4">
                <label class="col-form-label" for="location">Localidad:</label>
                <input v-model="patient.location" class="form-control" id="location" name="location"/>
            </div>
            <div class="col-12 col-md-4">
                <label class="col-form-label" for="postal_code">Código postal:</label>
                <input type="number" v-model="patient.postal_code" class="form-control" id="postal_code" name="postal_code"/>
            </div>
            <div class="col-12 col-md-4">
                <label class="col-form-label" for="email">Email:</label>
                <input type="email" v-model="patient.email" class="form-control" id="email" name="email"/>
            </div>
            <div class="col-12 col-md-4">
                <label class="col-form-label" for="phone">Teléfono:</label>
                <input type="number" v-model="patient.phone" class="form-control form-required" id="phone" name="phone"/>
            </div>
            <div class="col-12 col-md-4">
                <label class="col-form-label" for="phone2">Teléfono 2:</label>
                <input type="number" v-model="patient.phone2" class="form-control" id="phone2" name="phone2"/>
            </div>
            <div class="col-12 col-md-4">
                <label class="col-form-label" for="insurance">Aseguradora:</label>
                <textarea v-model="patient.insurance" v-on:keyup="textAreaAdjust" class="form-control" id="insurance" name="insurance"></textarea>
            </div>
        </div>
        <div>
            <h4>Historia</h4>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <label class="col-form-label" for="allergies">¿Tiene usted alguna alergia?:</label>
                <textarea v-model="record.allergies" v-on:keyup="textAreaAdjust" class="form-control" id="allergies" name="allergies"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label class="col-form-label" for="treatment">¿Está usted bajo tratamiento médico?:</label>
                <textarea v-model="record.treatment" v-on:keyup="textAreaAdjust" class="form-control" id="treatment" name="treatment"></textarea>
            </div>
        </div>
        <div>
            <h4>Enfermedades</h4>
            <div class="show-form" v-on:click="toggleForm"><span>{{showFormText}}</span></div>
        </div>
        <div class="row" v-show="showForm">
            <div class="col-12 col-md-6">
                <label for="heart">Corazón</label>
                <select v-model="diseases.heart" class="form-control" name="heart" id="heart">
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.heart_description" v-show="diseases.heart" v-on:keyup="textAreaAdjust"
                          class="form-control" name="heart_description"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for="osteoporosis">Osteoporosis:</label>
                <select v-model="diseases.osteoporosis" class="form-control" name="osteoporosis" id="osteoporosis">
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.osteoporosis_description" v-show="diseases.osteoporosis" v-on:keyup="textAreaAdjust"
                          class="form-control" name="osteoporosis_description"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for="liver">Hígado:</label>
                <select v-model="diseases.liver" class="form-control" name="liver" id="liver" >
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.liver_description" v-show="diseases.liver" v-on:keyup="textAreaAdjust"
                          class="form-control" name="liver_description"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for="cancer">Cancer:</label>
                <select v-model="diseases.cancer" class="form-control" name="cancer" id="cancer">
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.cancer_description" v-show="diseases.cancer" v-on:keyup="textAreaAdjust"
                          class="form-control" name="cancer_description"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for="kidney">Riñón:</label>
                <select v-model="diseases.kidney" class="form-control" name="kidney" id="kidney">
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.kidney_description" v-show="diseases.kidney" v-on:keyup="textAreaAdjust"
                          class="form-control" name="kidney_description"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for="hiv">IVH:</label>
                <select v-model="diseases.hiv" class="form-control" name="hiv" id="hiv">
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.hiv_description" v-show="diseases.hiv" v-on:keyup="textAreaAdjust"
                          class="form-control" name="hiv_description"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for="lung">Pulmón:</label>
                <select v-model="diseases.lung" class="form-control" name="lung" id="lung">
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.lung_description" v-show="diseases.lung" v-on:keyup="textAreaAdjust"
                          class="form-control" name="lung_description"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <div><span>Hepatitis:</span></div>
                <template v-for="radio in radioInputs">
                    <label :for="'hepatitis_' + radio.label">{{radio.label}}</label>
                    <input type="radio" v-model="diseases.hepatitis_description" name="hepatitis_description"
                           :id="'hepatitis_' + radio.label" v-bind:value="radio.value"/>
                </template>
            </div>
            <div class="col-12 col-md-6">
                <label for="diabetes">Diabetes:</label>
                <select v-model="diseases.diabetes" class="form-control" name="diabetes" id="diabetes">
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.diabetes_description" v-show="diseases.diabetes" v-on:keyup="textAreaAdjust"
                          class="form-control" name="diabetes_description"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for="circulatory">Circulatorio:</label>
                <select v-model="diseases.circulatory" class="form-control" name="circulatory" id="circulatory">
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.circulatory_description" v-show="diseases.circulatory" v-on:keyup="textAreaAdjust"
                          class="form-control" name="circulatory_description"></textarea>
            </div>
            <div class="col-12 col-md-6">
                <label for="others_description">Otros:</label>
                <textarea v-model="diseases.others_description" v-on:keyup="textAreaAdjust"
                          class="form-control" id="others_description" name="others_description"></textarea>
            </div>
        </div>
        <div>
            <slot name="csrf"></slot>
            <button type="submit" ref="submit">Guardar</button>
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
