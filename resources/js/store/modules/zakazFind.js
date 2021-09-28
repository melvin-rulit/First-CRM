export default {

    state: {
        zakaz:[],
    },

    getters: {
        AllZakazFind(state){
            return state.zakaz
        },

    },

    mutations: {
        getZakaz(state, zakazi) {
            state.zakaz = zakazi
        }
    },

    actions: {

        PhoneFilterZakaz({commit}, {phone}){

            axios.post(`api/v1/zakazFilterPhone`, { FindPhone: phone })
                .then((response) => {
                    commit('getZakaz', response.data)
                })
        },

        DataFilterZakaz({commit}, {data}){

            axios.post(`api/v1/zakazFilterData`, { FindData: data })
                .then((response) => {
                    commit('getZakaz', response.data)
                })
        },
    },

}
