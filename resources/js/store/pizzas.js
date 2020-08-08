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
            await axios.get('/pizzas').then(({data: {data :data}}) => {
                commit('SET_PIZZAS', data)
            }).catch(err => console.log(err));
        }
    }
}
