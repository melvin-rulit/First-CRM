export default {

    state: {
        zakaz:[],
    },
    getters: {
        FilterZakaz(state){
            return state.zakaz
        }
    },
    mutations: {
        getFilterZakaz(state, zakazi) {
            state.zakaz = zakazi
        }
    },
    actions: {

        GetFilterZakaz({commit}){

            axios.get(`api/v1/zakazFilter`, {  datetimes: 'Sun, 08 Aug 21 20:32:08 +0400'})
                .then((response) => {
                    commit('getFilterZakaz', response.data.data)
                })
        }
    },

}
