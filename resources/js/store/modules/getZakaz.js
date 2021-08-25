export default {

    state: {
        zakaz:[],
    },
    getters: {
        AllZakaz(state){
            return state.zakaz
        },

    },
    mutations: {
        getZakaz(state, zakazi) {
            state.zakaz = zakazi
        }
    },
    actions: {

        GetAllZakaz({commit}){

            axios.get(`api/v1/zakaz`)
                .then((response) => {
                    commit('getZakaz', response.data)
                })
        },

        FilterZakaz({commit}, {date}){

                axios.post(`api/v1/zakazFilter`, {  PeriodDate: date})
                    .then((response) => {
                        commit('getZakaz', response.data)
                    })
            }
    },

}
