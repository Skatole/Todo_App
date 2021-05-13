
import './bootstrap'
import Vue from 'vue'
import Index from './Index'
import routes from './routes/router'
import VueRouter from 'vue-router'
import abilityPlugin  from '@casl/vue'
import abilities from './services/abilities'
import store from './services/store/store'
import Vuetify from 'vuetify';

Vue.config.productionTip = false

// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.use(VueRouter)

//Set vuetify
Vue.use(Vuetify);

//Load abilities
Vue.use('abilityPlugin', 'abilities' )
// Load Index
Vue.component('index', Index)


const app = new Vue({
    el: '#app',
    router: new VueRouter({
        routes
    }),
    vuetify: new Vuetify(),
    store: store,
}).$mount('#app');
