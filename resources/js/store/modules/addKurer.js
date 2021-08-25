export default {

    state: {
        kurer:[],
    },
    getters: {
        AllKurers(state){
            return state.kurer
        }
    },
    mutations: {
        getKurier(state, kurer) {
            state.kurer = kurer
        }
    },
    actions: {

        GetAllKurer({commit}){

            axios.get(`api/v1/users`)
                .then((response) => {
                    commit('getKurier', response.data.data)
                })

        }
    },

}
