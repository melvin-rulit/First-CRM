export default {

    state: {
        adress:[],
    },

    getters: {
        AllAdress(state){
            return state.adress
        }
    },

    mutations: {
        getAdress(state, adress) {
            state.adress = adress
        }
    },

    actions: {

        GetAllAdress({commit}){

            axios.get(`api/v1/getAdress`)
                .then((response) => {
                    commit('getAdress', response.data.data)
                })

        }
    },

}
