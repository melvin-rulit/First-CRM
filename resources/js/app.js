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
import Promouter  from './components/Kurer/PromouterComponent.vue'
import Setings from './components/Setings/SetingsComponent.vue'

//----------- inside -------------
import add_and_edit_Racion  from './components/Inside_CRM/add_OR_edit_Racion_and_AdressComponent.vue'
import add_and_edit_Adress  from './components/Inside_CRM/add_OR_edit_Racion_and_AdressComponent.vue'



const routes = [

    { path: '/home',  name: 'zakaz', component: Zakaz},
    { path: '/kvadrat',  name: 'kvadrat' ,component: Kvadrat },
    { path: '/kurer', name: 'kurer', component: Kurer },
    { path: '/promouter',   name: 'promouter', component: Promouter },
    { path: '/setings', component: Setings },

    //---------- inside --------------
    { path: '/addRacion', name: 'addRacion' , component: add_and_edit_Racion },
    { path: '/addAdress', name: 'addAdress' , component: add_and_edit_Adress },


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

//-- vue-confirm-dialog
import VueConfirmDialog from 'vue-confirm-dialog'
Vue.use(VueConfirmDialog)
Vue.component('vue-confirm-dialog', VueConfirmDialog.default)

//------------------------------------------------------------------------------------------------------------------------------------------------------


//-- Head
Vue.component('head-component', require('./components/header/head.vue').default);
Vue.component('list-up-component', require('./components/header/List-up-side.vue').default);
Vue.component('addnewuser-component', require('./components/header/AddNewUserComponent.vue').default);
Vue.component('filter-component', require('./components/Zakazi/PersonalComponent.vue').default);

Vue.component('showEditStatus_ZakazModalModal-component', require('./components/header/EditZakaz/EditZakazFieldStatus_ZakazComponent.vue').default);
Vue.component('showModalEditZakazFieldPay-component', require('./components/header/EditZakaz/EditZakazFieldPayComponent.vue').default);
Vue.component('showModalEditZakazFieldDeliv-component', require('./components/header/EditZakaz/EditZakazFieldDelivComponent.vue').default);
Vue.component('showModalEditZakazFieldKurer-component', require('./components/header/EditZakaz/EditZakazFieldKurerComponent.vue').default);
Vue.component('showModalEditZakazFieldTotal-component', require('./components/header/EditZakaz/EditZakazFieldTotalComponent.vue').default);
Vue.component('showModalEditZakazFieldRacion-component', require('./components/header/EditZakaz/EditZakazFieldRacionComponent.vue').default);
Vue.component('showModalEditZakazDataDelivery-component', require('./components/header/EditZakaz/EditDataDeliveryComponent.vue').default);
Vue.component('showModalEditZakazFieldTel-component', require('./components/header/EditZakaz/EditPhoneComponent.vue').default);
Vue.component('showModalEditZakazFieldAdress-component', require('./components/header/EditZakaz/EditAdressComponent.vue').default);


//-- Kurer
Vue.component('editkurer-component', require('./components/Kurer/EditKurerComponent.vue').default);

//-- Promotuer
Vue.component('promouter-component', require('./components/Kurer/PromouterComponent.vue').default);


//-- Settings
Vue.component('settings-modal', require('./components/Setings/SetingsComponent.vue').default);


// -- Input-Form
Vue.component('input-form', require('./components/Inside_CRM/InputFormComponent.vue').default);
Vue.component('input-component', require('./components/Inside_CRM/InputComponent.vue').default);
Vue.component('prosto_input-component', require('./components/Inside_CRM/prosto_input-component.vue').default);

//------------------------------------------------------------------------------------------------------------------------------------------------------

let app;
app = new Vue({
    el: '#app',
    router,
    store,
});

// new Vue({
//     router,
//     render: h => h(App)
// }).$mount('#app')
