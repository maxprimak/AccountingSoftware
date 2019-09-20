/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Buefy from 'buefy'
import Icon from 'vue-awesome/components/Icon'
import 'buefy/dist/buefy.css'
import 'vue-awesome/icons'
import StarRating from 'vue-star-rating'

Vue.use(Buefy);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('star-rating', StarRating);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('new-repair', require('./components/NewRepairOrder.vue').default);

//Companies module
Vue.component('companies-table', require('./components/Companies/CompaniesTableComponent.vue').default);
Vue.component('branches-table', require('./components/Companies/BranchesTableComponent.vue').default);
Vue.component('create-branch', require('./components/Companies/CreateBranchComponent.vue').default);

//Employees module
Vue.component('employees-table', require('./components/Employees/EmployeesTableComponent.vue').default);
Vue.component('create-employee', require('./components/Employees/CreateEmployeeComponent.vue').default);

//Registration module
Vue.component('registration', require('./components/Registration/RegistrationComponent.vue').default);

//Customers module
Vue.component('customers-table', require('./components/Customers/CustomersTableComponent.vue').default);
Vue.component('create-customer', require('./components/Customers/CreateCustomerComponent.vue').default);

Vue.component('v-icon', Icon)

Vue.prototype.$colors = ['#F64272', '#F6648B', '#F493A7', '#F891A6', '#FFCCD5'];
Vue.prototype.$color = '#F64272';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
     el: '#app'
});
