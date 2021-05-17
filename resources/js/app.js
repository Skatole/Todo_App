import './bootstrap'

import Vue from 'vue'
import Index from './Index'

import routes from './routes/router'
import VueRouter from 'vue-router'
// import http from './services/http'

import store from './services/store/store'
import vuetify from './plugins/vuetify';
import Vuetify from 'vuetify/lib'
import VueSweetalert2 from 'vue-sweetalert2';
import { abilitiesPlugin } from '@casl/vue'
Vue.use(Vuetify);

import 'sweetalert2/dist/sweetalert2.min.css';
import 'vuetify/dist/vuetify.min.css'
import 'vuetify/src/styles/main.sass'



Vue.config.productionTip = false
Vue.use(VueSweetalert2);

// Set Vue router
Vue.use(VueRouter)
global.router = new VueRouter( {
    routes
})

//Load abilities
Vue.use(abilitiesPlugin, store.getters.ability)


// Load Index
Vue.component('index', Index)

//Store
require('./services/store/subscriber')
// http.token = store.state.token
// http.onError = (response) => {
//     if (response.status === 403) {
//         store.dispatch('forbidden', response)
//         return true
//     }
//
//     if (response.status === 401) {
//         store.dispatch('sessionExpired', response)
//         return true
//     }
// }



store.dispatch('attempt', localStorage.getItem('token')).then(() => {
    new Vue({
        el: '#app',
        vuetify,
        router,
        store: store,
    }).$mount('#app');

})

