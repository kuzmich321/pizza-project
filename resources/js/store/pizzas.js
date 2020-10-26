export default {
    namespaced: true,

    state: {
        pizzas: []
    },

    getters: {
        pizzas(state) {
            return state.pizzas
        }
    },

    mutations: {
        SET_PIZZAS(state, data) {
            state.pizzas = data
        }
    },

    actions: {
        async fetch({ commit }) {
            try {
                let response = await axios.get('/pizzas')

                commit('SET_PIZZAS', response.data.data)
            } catch (err) {
                console.log(err)
            }
        }
    }
}
