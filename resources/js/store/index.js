    //-----------------------------------  Vuex ---------------------------------------------//

import Vue from 'vue';
import Vuex from 'vuex'
import kurer from './modules/addKurer'
import getZakaz from './modules/getZakaz'
import zakazFind from './modules/zakazFind'

Vue.use(Vuex);

export default new Vuex.Store({

    modules:{
        kurer,
        getZakaz,
        zakazFind,
    }
});
