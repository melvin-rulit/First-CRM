export default {

    state: {
        zakaz_for_kurer:[],
    },

    getters: {
        AllZakaz_for_kurer(state){
            return state.zakaz_for_kurer
        },

    },

    mutations: {

        getZakaz_for_Kurer(state, zakazi) {
            state.zakaz_for_kurer = zakazi

        },

    },

    actions: {

        getZakazForKurer({commit}) {
            axios.get('api/v1/getZakazForKurer')
                .then((response) => {
                    commit('getZakaz_for_Kurer', response.data.data)
                })
        },
    },

}
