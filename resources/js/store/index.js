    //-----------------------------------  Vuex ---------------------------------------------//

import Vue from 'vue';
import Vuex from 'vuex'
import kurer from './modules/addKurer'
import getZakaz from './modules/getZakaz'
import getZakazForKurer from './modules/getZakazForKurer'
import zakazFind from './modules/zakazFind'
import getRacion from './modules/getRacion'
import Time from './modules/get_and_post_Time'
import Adress from './modules/adress'

Vue.use(Vuex);

export default new Vuex.Store({

    modules:{
        kurer,
        getZakaz,
        zakazFind,
        getZakazForKurer,
        getRacion,
        Time,
        Adress
    }
});
