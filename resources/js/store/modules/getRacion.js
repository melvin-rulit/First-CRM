export default {

    state: {
        racion: [],
        otchet: [],

    },

    getters: {
        AllRacion(state) {
            return state.racion
        },

        AllOtchet(state) {
            return state.otchet
        },

    },

    mutations: {

        getRacion(state, racion) {
            state.racion = racion

        },

        get_otchet_Racion(state, otchet) {
            state.otchet = otchet

        },

    },

    actions: {

        GetAllRacion({commit}) {

            axios.get(`api/v1/Racion`)
                .then((response) => {
                    commit('getRacion', response.data.data)
                })
        },

        Get_Otchet_Racion({commit}) {

            axios.get(`api/v1/get_Otchet_For_Racion`)
                .then((response) => {
                    commit('get_otchet_Racion', response.data.data)
                })
        },

    },

}
