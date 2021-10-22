export default {

    state: {
        zakaz:[],
        if_empty_zakaz: '',
    },

    getters: {
        AllZakaz(state){
            return state.zakaz
        },

        if_empty_zakaz(state){
            return state.if_empty_zakaz
        },

    },

    mutations: {

        getZakaz(state, zakazi) {
            state.zakaz = zakazi
            state.if_empty_zakaz = zakazi.data[0].date_delivery
        },

    },

    actions: {

        GetAllZakaz({commit}){

            axios.get(`api/v1/zakaz`)
                .then((response) => {
                    commit('getZakaz', response.data)
                })
        },

    },

}
