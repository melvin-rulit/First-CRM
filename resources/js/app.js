require('./bootstrap');
window.Vue = require('vue');

//-- Import Components
import User from './components/User/UserComponent.vue'
// import Users from './components/Users/UsersComponent.vue'
import Callendar from './components/Callendar/Callendar.vue'
import Vcallendar from './components/Callendar/Vcallendar.vue'
import Base from './components/base/BaseController.vue'
// import Personal from './components/Personal/PersonalComponent.vue'


const routes = [

    { path: '/home', component: Base},
    { path: '/user', component: User },
    { path: '/callendar', component: Callendar },
    { path: '/vcallendar', component: Vcallendar },
    // { path: '/personal', component: Personal },



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

//-- Buefy
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
Vue.use(Buefy)

//-- BootstrapVue  &  BootstrapVueIcons
import { BootstrapVue, IconsPlugin, BootstrapVueIcons } from 'bootstrap-vue'
// import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

//-- Import vue-router
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


//-- Import Global Components
Vue.component('head-component', require('./components/header/head.vue').default);
Vue.component('list-up-component', require('./components/header/List-up-side.vue').default);



const app = new Vue({

    el: '#app',
    router
});
