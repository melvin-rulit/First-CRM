require('./bootstrap');
window.Vue = require('vue');

//-- Import Components
import Users from './components/UsersComponent.vue'
import Callendar from './components/Callendar.vue'
import Vcallendar from './components/Vcallendar.vue'
import Base from './components/base/BaseController.vue'

const routes = [
    { path: '/home', component: Base},
    { path: '/users', component: Users },
    { path: '/callendar', component: Callendar },
    { path: '/vcallendar', component: Vcallendar },
]


const router = new VueRouter({
    mode: 'history',
    routes
})

//-- VCalendar
import VCalendar from 'v-calendar';
// Use v-calendar & v-date-picker components
Vue.use(VCalendar, {
  componentPrefix: 'vc',  // Use <vc-calendar /> instead of <v-calendar />
              // ...other defaults
});


//-- BootstrapVue  &  BootstrapVueIcons
import { BootstrapVue, IconsPlugin, BootstrapVueIcons } from 'bootstrap-vue'
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

//-- Import vue-router
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


//-- Import Global Components
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('head-component', require('./components/header/head.vue').default);



const app = new Vue({
    
    el: '#app',
    router
});
