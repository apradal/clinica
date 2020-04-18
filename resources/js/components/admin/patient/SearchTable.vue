<template>
    <div>
        <form :action="routes.add" v-on:submit="submitForm" ref="form" method="get">
            <span>Filtros de búsqueda:</span>
            <div class="flex">
                <input v-model="filter.name" class="form-text" id="name" name="name" placeholder="Nombre" autocomplete="off"/>
                <input v-model="filter.surname" class="form-text" id="surname" name="surname" placeholder="Apellido" autocomplete="off"/>
                <input v-model="filter.email" class="form-text" id="email" name="email" placeholder="Email" autocomplete="off"/>
                <input v-model="filter.nif" class="form-text" id="nif" name="nif" placeholder="Dni" autocomplete="off"/>
                <input v-model="filter.phone" class="form-text" id="phone" name="phone" placeholder="Teléfono" autocomplete="off"/>
                <select v-model="filter.pager" class="form-control" name="pager" id="pager">
                    <option v-for="option in pagerOptions" v-bind:value="option.value">{{option.text}}</option>
                </select>
                <button type="submit">Buscar</button>
            </div>
            <button v-show="prevPage" v-on:click="getPrevPage">Anterior página</button>
            <button v-show="nextPage" v-on:click="getNextPage">Siguiente página</button>
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
                    <loader v-show="showLoader"></loader>
                    <tr v-show="noResults">
                        <td class="center no-result" colspan="6">
                            <h2>{{noResultsText}}</h2>
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
        </form>
    </div>
</template>

<script>
    export default {
        props: ['routes'],
        data: function() {
            return {
                noResults: true,
                noResultsText: 'Indique filtros de búsqueda',
                showLoader: false,
                nextPage: false,
                nextPageUrl: null,
                prevPage: false,
                prevPageUrl: null,
                filter: {
                    name: null,
                    surname: null,
                    nif: null,
                    email: null,
                    phone: null,
                    pager: '10'
                },
                pagerOptions: [
                    {text: '10', value: '10'},
                    {text: '20', value: '20'},
                    {text: '30', value: '30'},
                    {text: '40', value: '40'},
                    {text: '50', value: '50'},
                    {text: '100', value: '100'}
                ],
                patients: []
            }
        },
        methods: {
            submitForm(event) {
                event.preventDefault();
                let self = this;
                let data = this.prepareDataSend();

                this.showLoader = true;
                this.noResultsText = null;

                if (Object.keys(data).length !== 0) {
                    axios.get(event.target.getAttribute('action'), {params: data})
                        .then(function (response) {
                            if (response.data.success && response.data.patients.data.length) {
                                ///first, clear array
                                self.patients = [];
                                self.noResults = false;
                                response.data.patients.data.forEach(function (el) {
                                    self.patients.push(el);
                                });
                                self._preparePagers(response.data.patients);
                            } else {
                                self.patients = [];
                                self.noResults = true;
                                self.noResultsText = 'No existen pacientes con estos filtros';
                                self._preparePagers({});
                            }
                        })
                        .catch(function (error) {
                            console.log(error)
                        })
                        .then(function () {
                            self.showLoader = false;
                            event.target.setAttribute('action', self.routes.add);
                        });
                }
            },
            prepareDataSend() {
                let data = {};

                for (let [key, value] of Object.entries(this.filter)) {
                    if (value !== null && value !== undefined && value.length) data[key] = value
                }

                return data;
            },
            _preparePagers(data) {
                if (data.next_page_url) {
                    this.nextPage = true;
                    this.nextPageUrl = data.next_page_url;
                } else {
                    this.nextPage = false;
                    this.nextPageUrl = null;
                }

                if (data.prev_page_url) {
                    this.prevPage = true;
                    this.prevPageUrl = data.prev_page_url;
                } else {
                    this.prevPage = false;
                    this.prevPageUrl = null;
                }
            },
            getNextPage() {
                let form = this.$refs.form;
                form.setAttribute('action', this.nextPageUrl);
            },
            getPrevPage() {
                let form = this.$refs.form;
                form.setAttribute('action', this.prevPageUrl);
            }
        }
    }
</script>
