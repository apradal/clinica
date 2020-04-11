<template>
    <div class="row">
        <div class="col-12">
        <h4>Plan de Tratamientos</h4>
            <div id="treatment-table">
                <div class="tr">
                    <div class="td">Fecha</div>
                    <div class="td">Descripción</div>
                </div>
                <template v-for="treatment in treatments">
                    <TreamtentForm
                        :routes="routes"
                        :treatment-data="treatment"
                    >
                    </TreamtentForm>
                </template>
                <div class="tr" id="btn-row">
                    <button type="button" v-on:click="renderNewForm">Añadir</button>
                </div>
            </div>
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

    import TreamtentForm from './treatmentForm/Form';

    export default {
        props: ['routes', 'treatmentData', 'patientData'],
        components: {
            TreamtentForm
        },
        data: function() {
            return {
                showBtn: false,
                alertSuccess: false,
                alertError: false,
                treatments: []
            }
        },
        methods: {
            renderNewForm() {
                this.treatments.push(new TreatmentModel(null, null, null, this.patientData.id));
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
