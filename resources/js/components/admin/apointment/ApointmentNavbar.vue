<template>
    <div>
        <div class="dark-white-btn-icon">
            <font-awesome-icon class="fa-lg" v-on:click="openTab" icon="calendar-check"/>
        </div>
        <div id="appointment-tab-container" v-show="showTab">
            <h3>Citas</h3>
            <template v-if="appointments.length">
                <div>
                    <div class="col-12 flex appointment-row" v-for="(appointment, index) in appointments">
                        <p>{{appointment.date}}</p>
                        <p>{{appointment.patient_name}}</p>
                        <p>{{appointment.patient_surname}}</p>
                        <p class="description">{{appointment.description}}</p>
                        <p>
                            <button type="button" class="dark-white-btn-icon" v-on:click="openModal(appointment)">
                                <font-awesome-icon class="icon" icon="times" v-on:click="openModal(appointment)"/>
                            </button>
                        </p>
                    </div>
                </div>
            </template>
            <template v-else>
                <p>No existen citas actualmente</p>
            </template>
        </div>
        <GenericModal v-if="showModal">
            <template slot="close">
                <div class="close-icon-modal click-icon">
                    <font-awesome-icon icon="times" v-on:click="showModal = false"/>
                </div>
            </template>
            <template slot="body">
                <div>
                    <p>¿Estás seguro de eliminar esta cita?</p>
                </div>
                <div class="flex btn-container">
                    <button class="dark-white-btn" v-on:click="removeAppointment(true, appointment)">Si</button>
                    <button class="dark-white-btn" v-on:click="removeAppointment(false)">No</button>
                </div>
            </template>
        </GenericModal>
    </div>
</template>

<script>
    //since vue cant handle collections, create model outside
    class AppointmentModel {
        constructor(id, date, description, patientId, revised, patientName, patientSurname) {
            this.id = id;
            this.date = date;
            this.description = description;
            this.patient_id = patientId;
            this.revised = revised;
            this.patient_name = patientName;
            this.patient_surname = patientSurname;
        }
    }

    export default {
        props: ['routes'],
        data: function() {
            return {
                patientId: null,
                showModal: false,
                alertSuccess: false,
                alertError: false,
                showTab: false,
                appointment: null,
                appointments: []
            }
        },
        methods: {
            openTab() {
                this.showTab = !this.showTab;
            },
            _formatDate(string) {
                let date = new Date(string);
                let day = (date.getDate() < 10) ? '0' + date.getDate() : date.getDate();
                let month = (date.getMonth()+1  < 10) ? '0' + (date.getMonth()+1) : date.getMonth()+1;
                return day + '/' + month + '/' + date.getFullYear();
            },
            openModal(appointment) {
                this.appointment = appointment;
                this.showModal = true;
            },
            removeAppointment(value, appointment = null) {
                if (value && appointment) {
                    let self = this;
                    axios.post(this.routes.delete, appointment)
                        .then(function (response) {
                            let data = response.data;
                            if (data.success) {
                                self.appointments.forEach(function (e, idx) {
                                    if (e.id === appointment.id) {
                                        self.appointments.splice(idx, 1);
                                    }
                                })
                            } else if (data.success === false) {

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
                this.showModal = false;
            },
            getAllAppointments() {
                let self = this;
                axios.get(this.routes.all)
                    .then(function (response) {
                        let data = response.data;
                        if (data.success) {
                            data.appointments.forEach(function (el) {
                                let date = self._formatDate(el.date);
                                self.appointments.push(new AppointmentModel(el.id, date, el.description, el.patient_id, el.revised, el.patient.name, el.patient.surname));
                            });
                        } else if (data.success === false) {

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
        created() {
            this.getAllAppointments();
        }
    }
</script>