import Vue from 'vue';
import Vuex from "vuex";
import abilities from '../abilities';
import createPersistedState from 'vuex-persistedstate'
import * as Cookies from 'js-cookie'

Vue.use(Vuex);

const updateAbilities = (store) => {
    abilities(store.state.user.role)
    return store.subscribe((mutation) => {
        switch (mutation.type) {
            case 'login':
                abilities(mutation.payload.user.role)
                break
            case 'logout':
                abilities([])
                break
        }
    });
}

export default new Vuex.Store(
    {
        plugins: [
            updateAbilities,
        ],
        state: {
            user: {
                role:'',
                name:'',
                email:'',
                access_token: {},
                refresh_token: {},
                isLoggedIn: false,
            },
        },
        mutations: {
            login(state, status) {
                state.user.role = status.role;
              state.user.name = status.name;
              state.user.email = status.email;
              state.user.access_token = status.access_token;
              state.user.refresh_token = status.refresh_token;
                state.user.isLoggedIn = status.isLoggedIn;
            },
            logout(state) {
              state.user.role = ''
            },
            retrieveToken(state, token) {
                state.token = token
            },
            destroyToken(state) {
                state.token = null
            }
        },
        actions: {
            destroyToken(context) {
                axios.defaults.headers.common['Authorization'] = 'Bearer' + context.state.token;

                if (context.getters.user.isLoggedIn) {
                    return new Promise((resolve, reject) => {
                        axios.post('/logout')
                            .then(response => {
                                this.logout();
                                localStorage.removeItem('access_token');
                                context.commit('destroyToken');
                                context.commit('')

                            })
                    })
                }
            },
        }
    });



