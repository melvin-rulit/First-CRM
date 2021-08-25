    //-----------------------------------  Vuex ---------------------------------------------//

import Vue from 'vue';
import Vuex from 'vuex'
import kurer from './modules/addKurer'
import getZakaz from './modules/getZakaz'
import zakazFilter from './modules/zakazFilter'
Vue.use(Vuex);

export default new Vuex.Store({

    modules:{
        kurer,
        getZakaz,
        zakazFilter
    }
});
