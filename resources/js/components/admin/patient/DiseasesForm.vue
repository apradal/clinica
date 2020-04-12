<template>
    <form :action="this.route" @submit="formSubmit" method="post" ref="form">
        <div>
            <h4>Enfermedades</h4>
            <div class="alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
            <div class="alert alert-danger" ref="alertError" v-show="alertError"></div>
        </div>
        <div class="row" v-show="showForm">
            <div class="col-12 col-md-6" ref="heartEditable">
                <label for="heart">Corazón</label>
                <select v-model="diseases.heart" v-on:change="onChange($event, 'heart_description')"
                        class="form-control" name="heart" id="heart" disabled>
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.heart_description" v-show="diseases.heart"
                          class="form-control" name="heart_description" readonly></textarea>
                <span class="edit-icon" data-target="heartEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="osteoporosisEditable">
                <label for="osteoporosis">Osteoporosis:</label>
                <select v-model="diseases.osteoporosis" v-on:change="onChange($event, 'osteoporosis_description')"
                        class="form-control" name="osteoporosis" id="osteoporosis" disabled>
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.osteoporosis_description" v-show="diseases.osteoporosis"
                          class="form-control" name="osteoporosis_description" readonly></textarea>
                <span class="edit-icon" data-target="osteoporosisEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="liverEditable">
                <label for="liver">Hígado:</label>
                <select v-model="diseases.liver" v-on:change="onChange($event, 'liver_description')"
                        class="form-control" name="liver" id="liver" disabled>
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.liver_description" v-show="diseases.liver"
                          class="form-control" name="liver_description" readonly></textarea>
                <span class="edit-icon" data-target="liverEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="cancerEditable">
                <label for="cancer">Cancer:</label>
                <select v-model="diseases.cancer" v-on:change="onChange($event, 'cancer_description')"
                        class="form-control" name="cancer" id="cancer" disabled>
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.cancer_description" v-show="diseases.cancer"
                          class="form-control" name="cancer_description" readonly></textarea>
                <span class="edit-icon" data-target="cancerEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="kidneyEditable">
                <label for="kidney">Riñón:</label>
                <select v-model="diseases.kidney" v-on:change="onChange($event, 'kidney_description')"
                        class="form-control" name="kidney" id="kidney" disabled>
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.kidney_description" v-show="diseases.kidney"
                          class="form-control" name="kidney_description" readonly></textarea>
                <span class="edit-icon" data-target="kidneyEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="hivEditable">
                <label for="hiv">IVH:</label>
                <select v-model="diseases.hiv" v-on:change="onChange($event, 'hiv_description')"
                        class="form-control" name="hiv" id="hiv" disabled>
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.hiv_description" v-show="diseases.hiv"
                          class="form-control" name="hiv_description" readonly></textarea>
                <span class="edit-icon" data-target="hivEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="lungEditable">
                <label for="lung">Pulmón:</label>
                <select v-model="diseases.lung" v-on:change="onChange($event, 'lung_description')"
                        class="form-control" name="lung" id="lung" disabled>
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.lung_description" v-show="diseases.lung"
                          class="form-control" name="lung_description" readonly></textarea>
                <span class="edit-icon" data-target="lungEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="hepatitisEditable">
                <div><span>Hepatitis:</span></div>
                <template v-for="radio in radioInputs">
                    <label :for="'hepatitis_' + radio.label">{{radio.label}}</label>
                    <input type="radio" v-model="diseases.hepatitis_description" name="hepatitis_description"
                           :id="'hepatitis_' + radio.label" v-bind:value="radio.value" disabled/>
                </template>
                <span class="edit-icon" data-target="hepatitisEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="diabetesEditable">
                <label for="diabetes">Diabetes:</label>
                <select v-model="diseases.diabetes" v-on:change="onChange($event, 'diabetes_description')"
                        class="form-control" name="diabetes" id="diabetes" disabled>
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.diabetes_description" v-show="diseases.diabetes"
                          class="form-control" name="diabetes_description" readonly></textarea>
                <span class="edit-icon" data-target="diabetesEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="circulatoryEditable">
                <label for="circulatory">Circulatorio:</label>
                <select v-model="diseases.circulatory" v-on:change="onChange($event, 'circulatory_description')"
                        class="form-control" name="circulatory" id="circulatory" disabled>
                    <option v-for="option in selectOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <textarea v-model="diseases.circulatory_description" v-show="diseases.circulatory"
                          class="form-control" name="circulatory_description" readonly></textarea>
                <span class="edit-icon" data-target="circulatoryEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12 col-md-6" ref="othersEditable">
                <label for="others_description">Otros:</label>
                <textarea v-model="diseases.others_description" class="form-control" id="others_description" name="others_description" readonly></textarea>
                <span class="edit-icon" data-target="othersEditable" v-on:click="edit">edit</span>
            </div>
            <div class="col-12">
                <input type="hidden" name="id" :value="diseases.id" />
                <input type="hidden" name="record_id" :value="diseases.record_id" />
                <button type="submit" ref="submit" v-show="showBtn">Guardar</button>
            </div>
        </div>
        <div class="show-form" v-on:click="toggleForm"><span>{{showFormText}}</span></div>
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
            edit(event) {
                let target = event.target.getAttribute('data-target');
                let wrapper = this.$refs[target];

                if (wrapper !== undefined) {
                    for (let i = 0; i < wrapper.children.length; i++) {
                        let elmt = wrapper.children[i];

                        if (elmt.hasAttribute('readonly')) elmt.removeAttribute('readonly');
                        if (elmt.hasAttribute('disabled')) elmt.removeAttribute('disabled');
                        elmt.focus();
                    }
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
            }
        }
    }
</script>
