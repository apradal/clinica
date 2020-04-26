<template>
    <form :action="this.route" @submit="formSubmit" method="post" ref="form">
        <div class="fieldset-separator">
            <div class="title-separator"><h4>Enfermedades</h4></div>
            <div class="col-12 alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
            <div class="col-12 alert alert-danger" ref="alertError" v-show="alertError"></div>
            <div class="row" v-show="showForm">
                <div class="col-12 col-md-6 form__group" ref="heartEditable">
                    <label for="heart">Corazón</label>
                    <div class="flex">
                        <select v-model="diseases.heart" v-on:change="onChange($event, 'heart_description')"
                                class="form__field" name="heart" id="heart" disabled>
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="button" class="dark-white-btn-icon" v-on:click="edit('heartEditable')">
                            <font-awesome-icon icon="edit" v-on:click="edit('heartEditable')" />
                        </button>
                    </div>
                    <textarea v-model="diseases.heart_description" v-show="diseases.heart" v-on:keyup="textAreaAdjust"
                              class="form__field" name="heart_description" readonly></textarea>
                </div>
                <div class="col-12 col-md-6 form__group" ref="osteoporosisEditable">
                    <label for="osteoporosis">Osteoporosis</label>
                    <div class="flex">
                        <select v-model="diseases.osteoporosis" v-on:change="onChange($event, 'osteoporosis_description')"
                                class="form__field" name="osteoporosis" id="osteoporosis" disabled>
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="button" class="dark-white-btn-icon" v-on:click="edit('osteoporosisEditable')">
                            <font-awesome-icon icon="edit" v-on:click="edit('osteoporosisEditable')" />
                        </button>
                    </div>
                    <textarea v-model="diseases.osteoporosis_description" v-show="diseases.osteoporosis" v-on:keyup="textAreaAdjust"
                              class="form__field" name="osteoporosis_description" readonly></textarea>
                </div>
                <div class="col-12 col-md-6 form__group" ref="liverEditable">
                    <label for="liver">Hígado</label>
                    <div class="flex">
                        <select v-model="diseases.liver" v-on:change="onChange($event, 'liver_description')"
                                class="form__field" name="liver" id="liver" disabled>
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="button" class="dark-white-btn-icon" v-on:click="edit('liverEditable')">
                            <font-awesome-icon icon="edit" v-on:click="edit('liverEditable')" />
                        </button>
                    </div>
                    <textarea v-model="diseases.liver_description" v-show="diseases.liver" v-on:keyup="textAreaAdjust"
                              class="form__field" name="liver_description" readonly></textarea>
                </div>
                <div class="col-12 col-md-6 form__group" ref="cancerEditable">
                    <label for="cancer">Cancer</label>
                    <div class="flex">
                        <select v-model="diseases.cancer" v-on:change="onChange($event, 'cancer_description')"
                                class="form__field" name="cancer" id="cancer" disabled>
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="button" class="dark-white-btn-icon" v-on:click="edit('cancerEditable')">
                            <font-awesome-icon icon="edit" v-on:click="edit('cancerEditable')" />
                        </button>
                    </div>
                    <textarea v-model="diseases.cancer_description" v-show="diseases.cancer" v-on:keyup="textAreaAdjust"
                              class="form__field" name="cancer_description" readonly></textarea>
                </div>
                <div class="col-12 col-md-6 form__group" ref="kidneyEditable">
                    <label for="kidney">Riñón</label>
                    <div class="flex">
                        <select v-model="diseases.kidney" v-on:change="onChange($event, 'kidney_description')"
                                class="form__field" name="kidney" id="kidney" disabled>
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="button" class="dark-white-btn-icon" v-on:click="edit('kidneyEditable')">
                            <font-awesome-icon icon="edit" v-on:click="edit('kidneyEditable')" />
                        </button>
                    </div>
                    <textarea v-model="diseases.kidney_description" v-show="diseases.kidney" v-on:keyup="textAreaAdjust"
                              class="form__field" name="kidney_description" readonly></textarea>
                </div>
                <div class="col-12 col-md-6 form__group" ref="hivEditable">
                    <label for="hiv">IVH</label>
                    <div class="flex">
                        <select v-model="diseases.hiv" v-on:change="onChange($event, 'hiv_description')"
                                class="form__field" name="hiv" id="hiv" disabled>
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="button" class="dark-white-btn-icon" v-on:click="edit('hivEditable')">
                            <font-awesome-icon icon="edit" v-on:click="edit('hivEditable')" />
                        </button>
                    </div>
                    <textarea v-model="diseases.hiv_description" v-show="diseases.hiv" v-on:keyup="textAreaAdjust"
                              class="form__field" name="hiv_description" readonly></textarea>
                </div>
                <div class="col-12 col-md-6 form__group" ref="lungEditable">
                    <label for="lung">Pulmón</label>
                    <div class="flex">
                        <select v-model="diseases.lung" v-on:change="onChange($event, 'lung_description')"
                                class="form__field" name="lung" id="lung" disabled>
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="button" class="dark-white-btn-icon" v-on:click="edit('lungEditable')">
                            <font-awesome-icon icon="edit" v-on:click="edit('lungEditable')" />
                        </button>
                    </div>
                    <textarea v-model="diseases.lung_description" v-show="diseases.lung" v-on:keyup="textAreaAdjust"
                              class="form__field" name="lung_description" readonly></textarea>
                </div>
                <div class="col-12 col-md-6 form__group" ref="hepatitisEditable">
                    <div><span>Hepatitis</span></div>
                    <template v-for="radio in radioInputs">
                        <input type="radio" class="form__radio" v-model="diseases.hepatitis_description" name="hepatitis_description"
                               :id="'hepatitis_' + radio.label" v-bind:value="radio.value" disabled/>
                        <label class="form__label_radio" :for="'hepatitis_' + radio.label">{{radio.label}}</label>
                    </template>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('hepatitisEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('hepatitisEditable')" />
                    </button>
                </div>
                <div class="col-12 col-md-6 form__group" ref="diabetesEditable">
                    <label for="diabetes">Diabetes</label>
                    <div class="flex">
                        <select v-model="diseases.diabetes" v-on:change="onChange($event, 'diabetes_description')"
                                class="form__field" name="diabetes" id="diabetes" disabled>
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="button" class="dark-white-btn-icon" v-on:click="edit('diabetesEditable')">
                            <font-awesome-icon icon="edit" v-on:click="edit('diabetesEditable')" />
                        </button>
                    </div>
                    <textarea v-model="diseases.diabetes_description" v-show="diseases.diabetes" v-on:keyup="textAreaAdjust"
                              class="form__field" name="diabetes_description" readonly></textarea>
                </div>
                <div class="col-12 col-md-6 form__group" ref="circulatoryEditable">
                    <label for="circulatory">Circulatorio</label>
                    <div class="flex">
                        <select v-model="diseases.circulatory" v-on:change="onChange($event, 'circulatory_description')"
                                class="form__field" name="circulatory" id="circulatory" disabled>
                            <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="button" class="dark-white-btn-icon" v-on:click="edit('circulatoryEditable')">
                            <font-awesome-icon icon="edit" v-on:click="edit('circulatoryEditable')" />
                        </button>
                    </div>
                    <textarea v-model="diseases.circulatory_description" v-show="diseases.circulatory" v-on:keyup="textAreaAdjust"
                              class="form__field" name="circulatory_description" readonly></textarea>
                </div>
                <div class="col-12 col-md-6 form__group flex" ref="othersEditable">
                    <textarea v-model="diseases.others_description" v-on:keyup="textAreaAdjust"
                              class="form__field" id="others_description" name="others_description" readonly></textarea>
                    <label class="form__label" for="others_description">Otros</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('othersEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('othersEditable')" />
                    </button>
                </div>
                <div class="col-12 title-separator">
                    <input type="hidden" name="id" :value="diseases.id" />
                    <input type="hidden" name="record_id" :value="diseases.record_id" />
                    <button type="submit" class="dark-white-btn" ref="submit" v-show="showBtn">Guardar <font-awesome-icon icon="save" /></button>
                </div>
            </div>
            <div class="col-12 show-form" v-on:click="toggleForm"><span>{{showFormText}}</span></div>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['route', 'recordData', 'diseasesData'],
        data: function() {
            return {
                showForm: false,
                showFormText: 'Mostrar Información',
                showBtn: false,
                alertSuccess: false,
                alertError: false,
                diseases: {
                    id: this.diseasesData.id,
                    heart: this.diseasesData.heart,
                    heart_description: this.diseasesData.heart_description,
                    osteoporosis: this.diseasesData.osteoporosis,
                    osteoporosis_description: this.diseasesData.osteoporosis_description,
                    liver: this.diseasesData.liver,
                    liver_description: this.diseasesData.liver_description,
                    cancer: this.diseasesData.cancer,
                    cancer_description: this.diseasesData.cancer_description,
                    kidney: this.diseasesData.kidney,
                    kidney_description: this.diseasesData.kidney_description,
                    hiv: this.diseasesData.hiv,
                    hiv_description: this.diseasesData.hiv_description,
                    lung: this.diseasesData.lung,
                    lung_description: this.diseasesData.lung_description,
                    hepatitis_description: this.diseasesData.hepatitis_description,
                    diabetes: this.diseasesData.diabetes,
                    diabetes_description: this.diseasesData.diabetes_description,
                    circulatory: this.diseasesData.circulatory,
                    circulatory_description: this.diseasesData.circulatory_description,
                    others_description: this.diseasesData.others_description,
                    record_id: this.recordData.id
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
            edit(dataTarget) {
                let wrapper = this.$refs[dataTarget];

                if (wrapper !== undefined) {
                    wrapper.querySelectorAll('select, textarea, input[type="radio"]').forEach(function (elmt) {
                        if (elmt.hasAttribute('readonly')) elmt.removeAttribute('readonly');
                        if (elmt.hasAttribute('disabled')) elmt.removeAttribute('disabled');
                        if (elmt.nodeName === 'INPUT' || elmt.nodeName === 'TEXTAREA') elmt.focus();
                    });
                }
                this.showBtn = true;
            },
            onChange(event, a) {
                //removes val on select if select NO
                if (parseInt(event.target.value) === 0) this.diseases[a] = null;
            },
            formSubmit(event) {
                event.preventDefault();
                let self = this;

                axios.post(event.target.getAttribute('action'), this.diseases)
                    .then(function (response) {
                        let inputs = self.$refs.form.querySelectorAll('input, textarea, select');
                        for (let i = 0; i < inputs.length; i++) {
                            if (inputs[i].tagName.toLowerCase() === 'select' ||
                                inputs[i].getAttribute('type') === 'radio') {
                                inputs[i].setAttribute('disabled', true);
                            } else {
                                inputs[i].setAttribute('readonly', true);
                            }
                        }

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
            },
            textAreaAdjust(event) {
                if (event.target.scrollHeight >= 58)
                    event.target.style.height = event.target.scrollHeight + "px";
            }
        }
    }
</script>
