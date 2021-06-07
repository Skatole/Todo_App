import Vue from 'vue';
import Vuex from "vuex";
import auth from './auth';
import storage from "./storage";
import notifications from "./notifications";
import posts from "./posts";
import reference from './reference';
import abilityPlugin from './abilities';
import {Ability} from '@casl/ability'
import axios from "axios";

Vue.use(Vuex);

//Abilities
// const updateAbilities = (store) => {
//     abilities(store.state.user.role)
//     return store.subscribe((mutation) => {
//         switch (mutation.type) {
//             case 'login':
//                 abilities(mutation.payload.user.role)
//                 break
//             case 'logout':
//                 abilities([])
//                 break
//         }
//     });
// }

export default new Vuex.Store(
    {
        plugins: [
            storage({
                storedKeys: ['token', 'rules', 'user'],
                destroyOn: ['destroySession'],
            }),
            abilityPlugin
        ],

        modules: {
            notifications,
            posts,
            reference
        },

        state: {
            token: '',
            user: {},
            rules: [],
            role: '',
            developers: {},
            managers: {},
            subject: 'all'
        },


        getters: {
            isLoggedIn(state) {
                return !!state.token
            },

            ability() {
                return new Ability([], {
                  subjectName(subject) {
                    return !subject || typeof subject === 'string'
                      ? subject
                      : subject[TYPE_KEY]
                  }
                })
              },

            authenticated(state) {
                return state.token && state.user
            },

            user(state) {
                return state.user
            },

            rules(state) {
                return state.rules
            },

            role(state) {
              return state.role
            },

            developers(state) {
                return state.developers
            },

            managers(state) {
                return state.managers
            }
        },

        mutations: {
            createSession(state, session) {
                state.user = session.user
                state.rules = session.permissions
                state.role = session.role
            },

            destroySession(state) {
                state.token = ''
                state.user = {}
                state.rules = []
                state.role = ''
            },

            SET_TOKEN(state, token) {
                state.token = token
            },

            SET_DEVELOPERS(state, data) {
                state.developers = data.developers
            },

            SET_MANAGERS(state, data) {
                state.managers = data.managers
            }
        },

        actions: {
            async login({dispatch}, credentials) {
                await axios.post('api/auth/login', credentials)
                    .then(response => {
                        return dispatch('attempt', response.data.token)
                    });
            },

            async attempt({commit, state}, token) {

                if (token) {
                    commit('SET_TOKEN', token)
                }

                if (!state.token) {
                    return
                }

                try {
                    await axios.get('api/auth/user')
                        .then(response => {
                            commit('createSession', response.data)
                        })

                } catch (e) {

                }
            },

            async logout({commit}) {
                 return await axios.post('api/auth/logout')
                    .then(() => {
                        commit('destroySession')
                        localStorage.removeItem('token');
                        router.replace('login')
                    }).catch((e) => {
                        localStorage.removeItem('token');
                        router.replace('login');
                    })
            },

            sessionExpired({dispatch, commit}) {
                dispatch('notifications/info', 'Session has been expired')
                commit('destroySession')
                router.push('/login')
            },

            forbidden({dispatch}, response) {
                dispatch('notifications/error', response.body.message)
                router.back()
            },

            async getAllDevUsers({commit}) {
                return await axios.get('api/auth/users/developers')
                .then(response => {
                    commit('SET_DEVELOPERS', response.data)
                })
            },

            async getAllManUsers({commit}) {
                return await axios.get('api/auth/users/managers')
                .then(response => {
                    commit('SET_MANAGERS', response.data)
                })
            },
        },



    });



