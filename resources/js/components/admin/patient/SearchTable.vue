<template>
    <div>
        <form :action="routes.add" v-on:submit="submitForm" method="get">
            <span>Filtros de búsqueda:</span>
            <div class="flex">
                <input v-model="filter.name" class="form-text" id="name" name="name" placeholder="Nombre" autocomplete="off"/>
                <input v-model="filter.surname" class="form-text" id="surname" name="surname" placeholder="Apellido" autocomplete="off"/>
                <input v-model="filter.email" class="form-text" id="email" name="email" placeholder="Email" autocomplete="off"/>
                <input v-model="filter.nif" class="form-text" id="nif" name="nif" placeholder="Dni" autocomplete="off"/>
                <input v-model="filter.phone" class="form-text" id="phone" name="phone" placeholder="Teléfono" autocomplete="off"/>
                <button type="submit">Buscar</button>
            </div>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Dni</th>
                    <th scope="col">Email</th>
                    <th scope="col">Teléfono</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table-body">
                <tr v-show="noResults">
                    <td class="center" colspan="6">
                        <h2>No existen pacientes con estos filtros</h2>
                    </td>
                </tr>
                <template v-for="patient in patients">
                    <tr>
                        <th scope="row">{{patient.name}}</th>
                        <td>{{patient.surname}}</td>
                        <td>{{patient.nif}}</td>
                        <td>{{patient.email}}</td>
                        <td>{{patient.phone}}</td>
                        <td>
                            <form method="get" :action="routes.record">
                                <input type="hidden" name="id" :value="patient.id">
                                <button type="submit">Ir a Historia</button>
                            </form>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['routes'],
        data: function() {
            return {
                noResults: false,
                filter: {
                    name: null,
                    surname: null,
                    nif: null,
                    email: null,
                    phone: null,
                },
                patients: []
            }
        },
        methods: {
            submitForm(event) {
                event.preventDefault();
                let self = this;
                let data = this.prepareDataSend();

                if (Object.keys(data).length !== 0) {
                    axios.get(event.target.getAttribute('action'), {params: data})
                        .then(function (response) {
                            if (response.data.success && response.data.patients.length) {
                                ///first, clear array
                                self.patients = [];
                                self.noResults = false;
                                response.data.patients.forEach(function (el) {
                                    self.patients.push(el);
                                })
                            } else {
                                self.patients = [];
                                self.noResults = true;
                            }
                        })
                        .catch(function (error) {
                            console.log(error)
                        });
                }
            },
            prepareDataSend() {
                let data = {};

                for (let [key, value] of Object.entries(this.filter)) {
                    if (value !== null && value !== undefined && value.length) data[key] = value
                }

                return data;
            }
        }
    }
</script>
