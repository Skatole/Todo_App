import axios from "axios";

export default {
    namespaced: true,
    state: {
        token: null,
        user: null,

    },

    getters: {
        authenticated(state) {
            return state.token && state.user
        },

        user(state) {
            return state.user
        }
    },

    mutations: {
        SET_TOKEN(state, token) {
            state.token = token
        },

        SET_USER(state, data) {
            state.user = data
        }
    },

    actions: {
        async login({ dispatch }, credentials) {
            await axios.post('api/auth/login', credentials)
                .then(response => {
                    return dispatch('attempt', response.data.token)
                });
        },

        async attempt({ commit, state }, token) {

            if (token) {
                commit('SET_TOKEN', token)
            }

            if (!state.token) {
                return
            }

            try {
                await axios.get('api/auth/user')
                    .then(response => {
                        commit('SET_USER', response.data)
                    })

            } catch (e) {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            }
        },

        logout({ commit }) {
            return axios.post('api/auth/logout')
                .then(() => {
                    commit('SET_USER', null)
                    commit('SET_TOKEN', null)
                })
        }
    },

}
