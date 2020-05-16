<template>
    <div>
        <button type="button" id="new-appointment-btn" class="dark-white-btn-icon" v-on:click="openModal">
            Nueva Cita <font-awesome-icon icon="calendar-check"/>
        </button>

        <form :action="this.route" @submit="formSubmit" method="post" ref="form">
            <GenericModal v-if="showModal" v-bind:styles="{width: '500px'}">
                    <template slot="close">
                        <div class="close-icon-modal click-icon">
                            <font-awesome-icon icon="times" v-on:click="showModal = false"/>
                        </div>
                    </template>
                    <template slot="body">
                        <div class="alert alert-success" ref="alertSuccess" v-show="alertSuccess"></div>
                        <div class="alert alert-danger" ref="alertError" v-show="alertError"></div>
                        <div class="col-12 form__group">
                            <input v-model="appointment.date" type="date" id="date" class="form__field form-date form-required" name="date" placeholder="Fecha"/>
                            <label class="form__label" for="date">Fecha</label>
                        </div>
                        <div class="col-12 form__group">
                            <textarea v-model="appointment.description" v-on:keyup="textAreaAdjust" id="description" class="form__field form-required" placeholder="Descripción" name="description"></textarea>
                            <label class="form__label" for="description">Descripción</label>
                        </div>
                        <input v-model="appointment.patient_id" type="hidden" name="patient_id" />
                        <div class="mt_20"></div>
                        <div class="flex btn-container">
                            <button type="submit" class="dark-white-btn">Guardar</button>
                        </div>
                    </template>
            </GenericModal>
        </form>
    </div>
</template>

<script>
    import FormValidator from '../../generic/mixins/FormValidator';

    export default {
        props: ['route', 'patientData'],
        mixins: [FormValidator],
        data: function() {
            return {
                alertSuccess: false,
                alertError: false,
                showModal: false,
                modalWidth: '90%',
                appointment: {
                    date: null,
                    description: null,
                    patient_id: this.patientData.id
                }
            }
        },
        methods: {
            openModal() {
                this.showModal = true;
            },
            textAreaAdjust(event) {
                if (event.target.scrollHeight >= 58)
                    event.target.style.height = event.target.scrollHeight + "px";
            },
            formSubmit(event) {
                event.preventDefault();
                let self = this;

                if (FormValidator.methods.validate(this.$refs.form)) {
                    axios.post(event.target.getAttribute('action'), this.appointment)
                        .then(function (response) {
                            let data = response.data;
                            if (data.success) {
                                self.$refs.alertSuccess.innerText = data.message;
                                self.alertSuccess = true;
                                setTimeout(() => self.alertSuccess = false, 3000);
                            } else if (data.success === false) {
                                self.$refs.alertError.innerText = data.message;
                                self.alertError = true;
                                setTimeout(() => self.alertError = false, 3000)
                            }
                        })
                        .catch(function (error) {
                            let data = error.response.data;
                            if (data.error) {
                                self.$refs.alertError.innerText = data.message;
                                self.alertError = true;
                                setTimeout(() => self.alertError = false, 3000);
                            }
                        });
                }
            },
            calculateModalWidth() {
                let viewport = document.documentElement.clientWidth;

                if (viewport > 720) {
                    this.modalWidth = '70%'
                } else if (viewport > 1020) {
                    this.modalWidth = '50%'
                } else if (viewport > 1220) {
                    this.modalWidth = '30%'
                }
            }
        },
        mounted() {
            this.calculateModalWidth();
        }
    }
</script>