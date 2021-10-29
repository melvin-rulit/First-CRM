export default {

    state: {
        time:'',

    },

    getters: {
        UseTime(state){
            return state.time
        },

    },

    mutations: {

        getTime(state, time) {
            state.time = time

        },

    },

    actions: {

        GetUseTime({commit}){

            axios.get(`api/v1/getTime`)
                .then((response) => {
                    commit('getTime', response.data.data)
                })
        },

        sendSetTime({commit}, {time}) {

            axios.post(`api/v1/setTime`, {setTime: time})
        },

    },

}
