export default {
    namespaced: true,

    state: {
        token: null,
        user: null,
        guest: null
    },

    getters: {
        authenticated(state) {
            return state.token && state.user
        },

        user(state) {
            return state.user
        },

        guest(state) {
            return state.guest
        }
    },

    mutations: {
        SET_TOKEN(state, token) {
            state.token = token
        },

        SET_USER(state, data) {
            state.user = data
        },

        SET_GUEST(state, data) {
            state.guest = data
        }
    },

    actions: {
        async login({dispatch}, credentials) {
            let response = await axios.post('/auth/login', credentials)

            return dispatch('attempt', response.data.token)
        },

        async attempt({commit, state}, token) {
            if (token) {
                commit('SET_TOKEN', token)
            }

            if (!state.token) {
                return
            }

            try {
                let response = await axios.get('/auth/me')

                commit('SET_USER', response.data);
            } catch (e) {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            }
        },

        logout({commit}) {
            return axios.post('/auth/logout').then(() => {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            })
        },

        register({dispatch, commit}, credentials) {
            return axios.post('/auth/register', credentials)
        },

        guest({commit}, email) {
            return axios.post('/auth/guest', {email: email})
                .then(res => commit('SET_GUEST', res.data))
                .catch(err => console.log(err.response.data))
        }
    }
}
