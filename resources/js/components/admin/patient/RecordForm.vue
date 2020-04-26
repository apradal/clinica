<template>
    <form :action="this.route" @submit="formSubmit" method="post" ref="form">
        <div class="fieldset-separator">
            <div class="title-separator"><h4>Historia</h4></div>
            <div class="col-12 alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
            <div class="col-12 alert alert-danger" ref="alertError" v-show="alertError"></div>
            <div class="row" v-show="showForm">
                <div class="col-12 col-md-6 form__group flex" ref="allergiesEditable">
                    <textarea v-model="record.allergies" v-on:keyup="textAreaAdjust"
                              class="form__field" id="allergies" name="allergies" readonly placeholder="Alergias"></textarea>
                    <label class="form__label" for="allergies">Alergias</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('allergiesEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('allergiesEditable')" />
                    </button>
                </div>
                <div class="col-12 col-md-6 form__group flex" ref="treatmentEditable">
                    <textarea v-model="record.treatment" v-on:keyup="textAreaAdjust"
                              class="form__field" id="treatment" name="treatment" readonly placeholder="Tratamiento médico"></textarea>
                    <label class="form__label" for="treatment">Tratamiento médico</label>
                    <button type="button" class="dark-white-btn-icon" v-on:click="edit('treatmentEditable')">
                        <font-awesome-icon icon="edit" v-on:click="edit('treatmentEditable')" />
                    </button>
                </div>
                <div class="col-12 title-separator">
                    <input type="hidden" name="id" :value="record.id" />
                    <input type="hidden" name="patient_id" :value="record.patient_id" />
                    <button type="submit" class="dark-white-btn" ref="submit" v-show="showBtn">Guardar <font-awesome-icon icon="save" /></button>
                </div>
            </div>
            <div class="col-12 show-form" v-on:click="toggleForm"><span>{{showFormText}}</span></div>
        </div>
    </form>
</template>

<script>
    export default {
        props: ['route', 'patientData', 'recordData'],
        data: function() {
            return {
                show: false,
                showForm: false,
                showFormText: 'Mostrar Información',
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
