/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/** Font Awesome **/
import { library } from '@fortawesome/fontawesome-svg-core'
import {fas} from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(fas);
Vue.component('font-awesome-icon', FontAwesomeIcon);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/** Components **/
Vue.component('admin-patient-patient-form', require('./components/admin/patient/PatientForm.vue').default);
Vue.component('admin-patient-record-form', require('./components/admin/patient/RecordForm.vue').default);
Vue.component('admin-patient-diseases-form', require('./components/admin/patient/DiseasesForm.vue').default);
Vue.component('admin-patient-treatment-form', require('./components/admin/patient/TreatmentForm.vue').default);
Vue.component('TreamtentForm', require('./components/admin/patient/treatmentForm/Form.vue').default);
Vue.component('GenericModal', require('./components/admin/patient/treatmentForm/ModalDelete.vue').default);
Vue.component('admin-record-new-form', require('./components/admin/record/NewRecordForm.vue').default);
Vue.component('admin-patient-search-table', require('./components/admin/patient/SearchTable.vue').default);
Vue.component('loader', require('./components/generic/Loader.vue').default);
Vue.component('admin-user-new-form', require('./components/admin/user/CreateForm.vue').default);
Vue.component('admin-patient-new-appointment', require('./components/admin/patient/NewAppointment.vue').default);
Vue.component('admin-appointments-navbar', require('./components/admin/apointment/ApointmentNavbar.vue').default);
Vue.component('admin-christmas-onoff', require('./components/admin/christmas/onoff.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
