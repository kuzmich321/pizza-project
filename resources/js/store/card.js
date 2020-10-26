export default {
    namespaced: true,

    state: {
        card: [],
        totalPrice: null
    },

    getters: {
        card(state) {
            return state.card
        },

        totalPrice(state) {
            return state.totalPrice
        },
    },

    mutations: {
        REMOVE_FROM_CARD(state, pizza) {
            state.card = state.card.filter(product => product !== pizza)
            state.totalPrice -= pizza.orderPrice
        },

        SET_TOTAL_PRICE(state, price) {
            state.totalPrice = price
        },

        SET_CARD(state, pizzas) {
            state.card = pizzas
        },

        CLEAR_CARD(state) {
            state.card = []
        }
    },

    actions: {
        addToCard({commit}, pizza) {
            const userCard = JSON.parse(localStorage.getItem('card'));

            pizza = {...pizza, quantity: 1, orderPrice: pizza.price}

            if (userCard) {
                localStorage.removeItem('card')

                let found = userCard.find(product => product.id === pizza.id)
                found ? found = {...found, quantity: found.quantity + 1, orderPrice: found.quantity * found.price}
                    : userCard.push(pizza)

                localStorage.setItem('card', JSON.stringify(userCard))
            } else {
                localStorage.setItem('card', JSON.stringify([pizza]))
            }
        },

        removeFromCard({commit}, pizza) {
            let userCard = JSON.parse(localStorage.getItem('card'))

            if (userCard) {
                localStorage.removeItem('card')
                userCard = userCard.filter(product => product.id !== pizza.id)
                localStorage.setItem('card', JSON.stringify(userCard))
            }

            commit('REMOVE_FROM_CARD', pizza)
        },

        getFromLocalStorage({commit}) {
            const pizzas = JSON.parse(localStorage.getItem('card'));

            if (pizzas) {
                let totalPrice = 0;

                pizzas.forEach(pizza => totalPrice += pizza.orderPrice)

                commit('SET_CARD', pizzas)
                commit('SET_TOTAL_PRICE', totalPrice)
            }
        },

        clearCard({commit}) {
            if (localStorage.getItem('card')) {
                localStorage.removeItem('card')
                commit('CLEAR_CARD')
            }
        }
    }
}
