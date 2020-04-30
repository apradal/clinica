<template>
    <div>
        <form :action="routes.add" v-on:submit="submitForm" ref="form" method="get">
            <div id="filters_search" class="row flex">
                <div class="col-12 col-md-8 row">
                    <div class="col-12">
                        <span>Filtros de búsqueda</span>
                    </div>
                    <div class="col-12 col-md-4">
                        <input class="form-control" v-model="filter.name" id="name" name="name" placeholder="Nombre" autocomplete="off"/>
                    </div>
                    <div class="col-12 col-md-4">
                        <input class="form-control" v-model="filter.surname" id="surname" name="surname" placeholder="Apellido" autocomplete="off"/>
                    </div>
                    <div class="col-12 col-md-4">
                        <input class="form-control" v-model="filter.email" id="email" name="email" placeholder="Email" autocomplete="off"/>
                    </div>
                    <div class="col-12 col-md-4"></div>
                    <div class="col-12 col-md-4">
                        <input class="form-control" v-model="filter.nif" id="nif" name="nif" placeholder="Dni" autocomplete="off"/>
                    </div>
                    <div class="col-12 col-md-4">
                        <input class="form-control" v-model="filter.phone" id="phone" name="phone" placeholder="Teléfono" autocomplete="off"/>
                    </div>
                </div>
                <div id="pagination" class="col-12 col-md-4 row">
                    <div class="col-12">
                        <label for="pager">Resultados por página</label>
                        <select v-model="filter.pager" class="form-control" name="pager" id="pager">
                            <option v-for="option in pagerOptions" v-bind:value="option.value">{{option.text}}</option>
                        </select>
                        <button type="submit" class="dark-white-btn col-12">Buscar <font-awesome-icon icon="search"/></button>
                        <div class="flex arrows">
                            <button v-show="prevPage" class="dark-white-btn" v-on:click="getPrevPage">
                                Anterior <font-awesome-icon icon="angle-double-left" />
                            </button>
                            <button v-show="nextPage" class="dark-white-btn" v-on:click="getNextPage">
                                Siguiente <font-awesome-icon icon="angle-double-right" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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
                            <td data-label="Nombre" scope="row">{{patient.name}}</td>
                            <td data-label="Apellidos">{{patient.surname}}</td>
                            <td data-label="Dni">{{patient.nif}}</td>
                            <td data-label="Email">{{patient.email}}</td>
                            <td data-label="Teléfono">{{patient.phone}}</td>
                            <td>
                                <form method="get" :action="routes.record">
                                    <input type="hidden" name="id" :value="patient.id">
                                    <button type="submit" class="dark-white-btn">Ir a Historia</button>
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
