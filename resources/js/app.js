require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue'
import store from './store'


//-- Import vue-router
import VueRouter from 'vue-router'
Vue.use(VueRouter);

//-- Import Components
import User from './components/User/MainComponent.vue'
import Callendar from './components/header/ShowCalendarComponent.vue'
import Vcallendar from './components/Callendar/Vcallendar.vue'
// import Base from './components/base/BaseComponent.vue'
// import Zakaz from './components/header/PersonalComponent.vue'
import Zakaz from './components/Zakazi/PersonalComponent.vue'
import Kurer from './components/Kurer/MainComponent.vue'
import Setings from './components/Setings/SetingsComponent.vue'


const routes = [

    { path: '/home',  name: 'zakaz', component: Zakaz},
    { path: '/user', component: User },
    { path: '/callendar', component: Callendar },
    { path: '/vcallendar', component: Vcallendar },
    { path: '/zakazi', name: 'zakaz' , component: Zakaz },
    { path: '/kurer', name: 'kurer', component: Kurer },
    { path: '/setings', component: Setings },

]


const router = new VueRouter({

    mode: 'history',
    routes,
    linkExactActiveClass: "active",
})



//-- VCalendar
// import VCalendar from 'v-calendar';
// // Use v-calendar & v-date-picker components
// Vue.use(VCalendar, {
//   componentPrefix: 'vc',  // Use <vc-calendar /> instead of <v-calendar />
//               // ...other defaults
// });

//-- vue2-datepicker
import DatePicker from 'vue2-datepicker'
Vue.use(DatePicker);
import 'vue2-datepicker/index.css'

//-- ant-design-vue
// import { Button, message } from 'ant-design-vue';
// Vue.use(Button)


//-- Buefy
import Buefy from 'buefy'
// import 'buefy/dist/buefy.css'
Vue.use(Buefy)

//-- Vuetify
import Vuetify from 'vuetify'
// import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)

//-- at-ui
import AtComponents from 'at-ui'
// import 'at-ui-style'
Vue.use(AtComponents)

//-- VueMaterial
import VueMaterial from 'vue-material'
import 'vue-material/dist/vue-material.min.css'
Vue.use(VueMaterial)

//-- BootstrapVue  &  BootstrapVueIcons
import { BootstrapVue, IconsPlugin, BootstrapVueIcons } from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import 'bootstrap/dist/css/bootstrap.css'
Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)
Vue.use(IconsPlugin)

//-- vue-the-mask
import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

//-- multiselect
import Multiselect from 'vue-multiselect'
Vue.component('multiselect', Multiselect)

//-- VueToast
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);

import DynamicSelect from 'vue-dynamic-select'
Vue.use(DynamicSelect)



//-- Head
Vue.component('head-component', require('./components/header/head.vue').default);
Vue.component('list-up-component', require('./components/header/List-up-side.vue').default);
Vue.component('addnewuser-component', require('./components/header/AddNewUserComponent.vue').default);
Vue.component('showCalendar-component', require('./components/header/ShowCalendarComponent.vue').default);
Vue.component('filter-component', require('./components/header/PersonalComponent.vue').default);
Vue.component('showModalEditZakazField-component', require('./components/header/EditZakazFieldComponent.vue').default);


//-- Kurer
Vue.component('editkurer-component', require('./components/Kurer/EditKurerComponent.vue').default);

//-- User
Vue.component('add-foto', require('./components/User/AddFoto.vue').default);
Vue.component('edit-profile', require('./components/User/EditProfile.vue').default);
Vue.component('edit-personal', require('./components/User/EditPersonal.vue').default);

Vue.component('edit-roles-in-usercard', require('./components/User/EditRolesModal.vue').default);

//-- Settings
Vue.component('edit-roles-in-settings', require('./components/Setings/EditRolesModal.vue').default);
Vue.component('delete-roles-in-settings', require('./components/Setings/DeleteRolesModal.vue').default);
Vue.component('edit-access-in-settings', require('./components/Setings/Three/EditAccessModal.vue').default);
Vue.component('delete-access-in-settings', require('./components/Setings/Three/DeleteAccessModal.vue').default);

// -- Weather
// Vue.component('weather-component', require('./components/Weather/WeatherComponent.vue').default);
//
// Vue.component('callendar-component', require('./components/User/Callendar.vue').default);

// -- Input-Form
Vue.component('input-form', require('./components/InputComponent.vue').default);



const app = new Vue({
    el: '#app',
    router,
    store,
});
