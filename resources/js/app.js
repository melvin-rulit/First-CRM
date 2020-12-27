require('./bootstrap');
window.Vue = require('vue');


import { BootstrapVue, IconsPlugin, BootstrapVueIcons } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import router from "./router"

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('head', require('./components/header/head.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    
    el: '#app',
    router
});
