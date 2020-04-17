<template>
    <div class="row">
        <div class="col-12">
            <h4>Plan de Tratamientos</h4>
            <div id="treatment-table" v-show="showForm">
                <div class="row">
                    <div class="col-12 col-md-2">Fecha</div>
                    <div class="col-12 col-md-10">Descripción</div>
                </div>
                <template v-for="(treatment, index) in treatments">
                    <TreamtentForm
                        :routes="routes"
                        :treatment-data="treatment"
                        :index="index"
                        v-on:openModal="openModal"
                    >
                    </TreamtentForm>
                </template>
                <div class="tr" id="btn-row">
                    <button type="button" v-on:click="renderNewForm">Añadir</button>
                </div>
            </div>
            <div class="show-form" v-on:click="toggleForm"><span>{{showFormText}}</span></div>
        </div>
        <div class="col-12">
            <TreamtentModal v-if="showModal" v-on:closeModal="removeForm">
            </TreamtentModal>
        </div>
    </div>
</template>

<script>
    //since vue cant handle collections, create model outside
    class TreatmentModel {
        constructor(id, date, description, patientId, isNew = true) {
            this.id = id;
            this.date = date;
            this.description = description;
            this.patient_id = patientId;
            this.new = isNew;
        }
    }

    export default {
        props: ['routes', 'treatmentData', 'patientData'],
        data: function() {
            return {
                idToDelete: null,
                showForm: true,
                showFormText: 'Ocultar Información',
                showModal: false,
                showBtn: false,
                alertSuccess: false,
                alertError: false,
                treatments: [],
                currentChild: null
            }
        },
        methods: {
            renderNewForm() {
                this.treatments.push(new TreatmentModel(null, null, null, this.patientData.id));
            },
            openModal(component) {
                this.showModal = true;
                this.currentChild = component;
            },
            removeForm(value) {
                if (this.currentChild !== null && value) {
                    //deletes model
                    this.currentChild.remove();
                    // updates array of models (for DOM)
                    this.currentChild.deleted = true;
                    this.currentChild = null;
                }
                this.showModal = false;
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
        },
        created() {
            let self = this;

            //fetch array with models.
            this.treatmentData.forEach(function(el){
                self.treatments.push(new TreatmentModel(el.id, el.date, el.description, self.patientData.id, false));
            });
        }
    }
</script>
