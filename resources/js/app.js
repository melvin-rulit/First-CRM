require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import store from './store'

//------------------------------------------------------------------------------------------------------------------------------------------------------

//-- Import vue-router
import VueRouter from 'vue-router'
Vue.use(VueRouter);

//-- Import Components
import Kvadrat from './components/Kvadrat/KvadratComponent.vue'
import Zakaz from './components/Zakazi/PersonalComponent.vue'
import Kurer from './components/Kurer/MainComponent.vue'
import Setings from './components/Setings/SetingsComponent.vue'


const routes = [

    { path: '/home',  name: 'zakaz', component: Zakaz},
    { path: '/Kvadrat',  name: 'kvadrat' ,component: Kvadrat },
    { path: '/zakazi', name: 'zakaz' , component: Zakaz },
    { path: '/kurer', name: 'kurer', component: Kurer },
    { path: '/setings', component: Setings },

]

const router = new VueRouter({

    mode: 'history',
    routes,
    linkExactActiveClass: "active",
})

//------------------------------------------------------------------------------------------------------------------------------------------------------

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

//-- VueToast
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';
Vue.use(VueToast);

//-- vue2-datepicker
import DatePicker from 'vue2-datepicker'
import 'vue2-datepicker/index.css'
Vue.use(DatePicker)

//-- v-calendar
import VCalendar from 'v-calendar'
Vue.use(VCalendar);

//-- vue-simple-alert
import VueSimpleAlert from "vue-simple-alert";
Vue.use(VueSimpleAlert);

//------------------------------------------------------------------------------------------------------------------------------------------------------


//-- Head
Vue.component('head-component', require('./components/header/head.vue').default);
Vue.component('list-up-component', require('./components/header/List-up-side.vue').default);
Vue.component('addnewuser-component', require('./components/header/AddNewUserComponent.vue').default);
Vue.component('addnewkvadrat-component', require('./components/header/ShowAddKvadratModalComponent.vue').default);
Vue.component('filter-component', require('./components/Zakazi/PersonalComponent.vue').default);

Vue.component('showModalEditZakazFieldPay-component', require('./components/header/EditZakaz/EditZakazFieldPayComponent.vue').default);
Vue.component('showModalEditZakazFieldDeliv-component', require('./components/header/EditZakaz/EditZakazFieldDelivComponent.vue').default);
Vue.component('showModalEditZakazFieldKurer-component', require('./components/header/EditZakaz/EditZakazFieldKurerComponent.vue').default);
Vue.component('showModalEditZakazFieldTotal-component', require('./components/header/EditZakaz/EditZakazFieldTotalComponent.vue').default);
Vue.component('showModalEditZakazFieldRacion-component', require('./components/header/EditZakazFieldRacionComponent.vue').default);

//--CalendarPeriod
Vue.component('showModalCalendarForPeriod-component', require('./components/header/CalendarPeriodComponent.vue').default);


//-- Kurer
Vue.component('editkurer-component', require('./components/Kurer/EditKurerComponent.vue').default);


//-- Settings
Vue.component('edit-roles-in-settings', require('./components/Setings/EditRolesModal.vue').default);
Vue.component('delete-roles-in-settings', require('./components/Setings/DeleteRolesModal.vue').default);
Vue.component('edit-access-in-settings', require('./components/Setings/Three/EditAccessModal.vue').default);
Vue.component('delete-access-in-settings', require('./components/Setings/Three/DeleteAccessModal.vue').default);


// -- Input-Form
Vue.component('input-form', require('./components/InputFormComponent.vue').default);
Vue.component('input-component', require('./components/InputComponent.vue').default);

//------------------------------------------------------------------------------------------------------------------------------------------------------

let app;
app = new Vue({
    el: '#app',
    router,
    store,
});
