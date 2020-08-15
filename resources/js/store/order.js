import card from "./card";

export default {
    namespaced: true,

    state: {
        order: null,
        message: null,
        errors: [],
        history: []
    },

    getters: {
        message(state) {
            return state.message
        },

        order(state) {
            return state.order
        },

        errors(state) {
            return state.errors
        },

        history(state) {
            return state.history
        }
    },

    mutations: {
        SET_ORDER(state, order) {
            state.order = order
        },

        SET_MESSAGE(state, message) {
            state.message = message
        },

        SET_ERRORS(state, errors) {
            state.errors = errors
        },

        SET_HISTORY(state, data) {
            state.history = data
        }
    },

    actions: {
        async getCurrentUserId({dispatch, rootGetters}, email) {
            const authUser = await rootGetters['auth/authenticated']

            if (authUser) {
                return authUser.id
            } else {
                await dispatch('auth/guest', email, {root: true})
                let guest = rootGetters['auth/guest']

                return guest.id
            }
        },

        async createOrder({commit, dispatch, state, rootGetters}, fields) {
            fields.user_id = await dispatch('getCurrentUserId', fields.email)

            await axios.post('/orders', fields).then(response => {
                fields.id = response.data.id

                commit('SET_ORDER', fields)
                commit('SET_MESSAGE', response.data.status)

                dispatch('card/clearCard')
            }).catch(err => console.log(err.response.data.errors)).then(() => {
                const orderId = state.order.id

                let orderItems = {
                    'data': fields.pizzas.map(pizza => {
                        return {
                            order_id: orderId,
                            pizza_id: pizza.id,
                            quantity: pizza.quantity,
                            price: pizza.orderPrice
                        }
                    })
                }

                dispatch('createOrderItems', orderItems)
                    .then(() => console.log('Everything is ok'))
                    .catch(err => commit('SET_ERRORS', err.response))

            }).catch(err => commit('SET_ERRORS', err.response))
        },

        createOrderItems(_, items) {
            return axios({
                url: '/order_items',
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify(items)
            })
        },

        getHistory({commit}) {
            axios.get('/orders/history')
                .then(res => commit('SET_HISTORY', res.data.orders))
        }
    },

    modules: {
        card
    }
}
