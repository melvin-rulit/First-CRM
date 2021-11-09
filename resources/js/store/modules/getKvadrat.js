export default {

    state: {
        kvadrat:[],

    },

    getters: {
        AllKvadrat(state){
            return state.kvadrat
        },

    },

    mutations: {

        getKvadrat(state, kvadrat) {
            state.kvadrat = kvadrat

        },

    },

    actions: {

        GetAllKvadrat({commit}){

            axios.get(`api/v1/kvadrat`)
                .then((response) => {
                    commit('getKvadrat', response.data.data)
                })
        },

    },

}
