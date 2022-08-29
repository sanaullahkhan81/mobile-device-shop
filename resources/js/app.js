/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import '@mdi/font/css/materialdesignicons.css'
window.Vue = Vue;
require('./bootstrap');

import vuetify from './vuetify';
import ExampleComponent from "./components/ExampleComponent";
import DeviceComponent from "./components/DeviceComponent";
import Toasted from "vue-toasted";

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('device-component', require('./components/DeviceComponent.vue').default);
Vue.use(Toasted,{
    duration: 3500,
    });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify,
    render: h => h(DeviceComponent),
});
