<template>
    <div class="fieldset-separator">
        <div class="title-separator"><h4>Plan de Tratamientos</h4></div>
        <div id="treatment-table" v-show="showForm">
            <div class="row">
                <div class="col-12 col-md-2 date-order form__group" v-on:click="orderByDate">
                    <button type="button" class="dark-white-btn">Fecha
                        <font-awesome-icon :icon="arrowIcon"/></button>
                </div>
                <div class="col-12 col-md-10 form__group">Descripción</div>
            </div>
            <template v-for="(treatment, index) in treatments">
                <TreamtentForm
                    :routes="routes"
                    :treatment-data="treatment"
                    :index="index"
                    :key="treatment.id"
                    v-on:openModal="openModal"
                >
                </TreamtentForm>
            </template>
            <div>
                <button id="btn-row" class="dark-white-btn" type="button" v-on:click="renderNewForm">Añadir <font-awesome-icon icon="plus-square" /></button>
            </div>
        </div>
        <div class="show-form" v-on:click="toggleForm"><span>{{showFormText}}</span></div>

        <div class="col-12">
            <GenericModal v-if="showModal">
                <template slot="body">
                    <div>
                        <p>¿Estás seguro de eliminar este tratamiento?</p>
                    </div>
                    <div class="flex btn-container">
                        <button class="dark-white-btn" v-on:click="removeForm(true)">Si</button>
                        <button class="dark-white-btn" v-on:click="removeForm(false)">No</button>
                    </div>
                </template>
            </GenericModal>
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
                arrowIcon: 'sort-amount-down-alt',
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
                    this.treatments.splice(this.currentChild.index, 1);
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
            },
            orderByDate() {
                this.treatments.reverse();
                this.arrowIcon = (this.arrowIcon === 'sort-amount-down-alt') ? 'sort-amount-up' : 'sort-amount-down-alt';
            }
        },
        created() {
            let self = this;

            //sorting by date desc
            this.treatmentData.sort(function(a,b){
                return new Date(a.date) - new Date(b.date);
            });

            //fetch array with models.
            this.treatmentData.forEach(function(el){
                self.treatments.push(new TreatmentModel(el.id, el.date, el.description, self.patientData.id, false));
            });
        }
    }
</script>
