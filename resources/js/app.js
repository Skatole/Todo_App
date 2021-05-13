import './bootstrap'
import Vue from 'vue'
import Index from './Index'
import routes from './routes/router'
import VueRouter from 'vue-router'
import abilityPlugin from '@casl/vue'
import abilities from './services/store/abilities'
import store from './services/store/store'
import vuetify from './plugins/vuetify';

Vue.config.productionTip = false


// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.use(VueRouter)

//Load abilities
Vue.use('abilityPlugin', 'abilities')
// Load Index
Vue.component('index', Index)

//Store
require('./services/store/subscriber')
store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
    new Vue({
        el: '#app',
        router: new VueRouter({
            routes
        }),
        vuetify,
        store: store,
    }).$mount('#app');

})

