import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import Head from "./components/header/head.vue"

const routes = [
    { path: '/home', component: Head },

];


export default new VueRouter({
    mode: "history",
    routes
});