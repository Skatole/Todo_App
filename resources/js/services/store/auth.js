// import axios from "axios";
//
// export default {
//     namespaced: true,
//     state: {
//         token: null,
//         user:  null,
//         rules: null,
//     },
//
//     getters: {
//         authenticated(state) {
//             return state.token && state.user
//         },
//
//         user(state) {
//             return state.user
//         },
//
//         rules(state) {
//             return state.rules
//         }
//     },
//
//     mutations: {
//         SET_TOKEN(state, token) {
//             state.token = token
//         },
//
//         SET_USER(state, data) {
//             state.user = data
//         },
//
//         SET_RULES(state, data) {
//             state.rules = data
//         },
//     },
//
//     actions: {
//         async login({ dispatch }, credentials) {
//             await axios.post('api/auth/login', credentials)
//                 .then(response => {
//                     return dispatch('attempt', response.data.token)
//                 });
//         },
//
//         async attempt({ commit, state }, token) {
//
//             if (token) {
//                 commit('SET_TOKEN', token)
//             }
//
//             if (!state.token) {
//                 return
//             }
//
//             try {
//                 await axios.get('api/auth/user')
//                     .then(response => {
//                         commit('SET_USER',  response.data)
//                         commit('SET_RULES', response.data.permissions)
//                     })
//
//             } catch (e) {
//                 commit('SET_TOKEN', null)
//                 commit('SET_USER',  null)
//                 commit('SET_RULES', null)
//             }
//         },
//
//         logout({ commit }) {
//             return axios.post('api/auth/logout')
//                 .then(() => {
//                     commit('SET_USER',  null)
//                     commit('SET_TOKEN', null)
//                     commit('SET_RULES', null)
//                 }).catch((e) => {
//                     localStorage.removeItem('token');
//                     router.replace('login');
//                 })
//
//
//
//         }
//     },
//
// }
