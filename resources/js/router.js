import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


// import Region from "./components/ExampleComponent"
import Region from "./components/header/head.vue"

const routes = [
    { path: '/home', component: Region },

];


export default new VueRouter({
    mode: "history",
    routes
});