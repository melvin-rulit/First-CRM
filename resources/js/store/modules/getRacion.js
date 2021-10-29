export default {

    state: {
        racion:[],

    },

    getters: {
        AllRacion(state){
            return state.racion
        },

    },

    mutations: {

        getRacion(state, racion) {
            state.racion = racion

        },

    },

    actions: {

        GetAllRacion({commit}){

            axios.get(`api/v1/Racion`)
                .then((response) => {
                    commit('getRacion', response.data.data)
                })
        },

    },

}
