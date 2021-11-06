export default {

    state: {
        kurer:[],
    },
    getters: {
        AllKurers(state){
            return state.kurer
        },

        sumKurer(state){
            return state.kurer.length
        }
    },
    mutations: {
        getKurier(state, kurer) {
            state.kurer = kurer
        }
    },
    actions: {

        GetAllKurer({commit}){

            axios.get(`api/v1/kurer`)
                .then((response) => {
                    commit('getKurier', response.data.data)
                })

        }
    },

}
