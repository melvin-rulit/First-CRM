export default {

    state: {
        zakaz: [],
        data: '',
        phone: '',
    },

    getters: {
        AllZakazFind(state) {
            return state.zakaz
        },

        DataFind(state) {
            return state.data
        },

        PhoneFind(state) {
            return state.phone
        },

    },

    mutations: {
        getZakaz(state, zakazi) {
            state.zakaz = zakazi
        },

        updateData: function (state, payload) {
            state.data = payload
        },

        updatePhone: function (state, payload) {
            state.phone = payload
        },
    },

    actions: {

        PhoneFilterZakaz({commit}, {phone}) {

            axios.post(`api/v1/zakazFilterPhone`, {FindPhone: phone})
                .then((response) => {
                    commit('getZakaz', response.data)
                })
        },

        DataFilterZakaz({commit}, {data}) {

            axios.post(`api/v1/zakazFilterData`, {FindData: data})
                .then((response) => {
                    commit('getZakaz', response.data)
                })
        },

        FindData: function (store, payload) {
            store.commit('updateData', payload)
        },

        FindPhone: function (store, payload) {
            store.commit('updatePhone', payload)
        },

    },
}
