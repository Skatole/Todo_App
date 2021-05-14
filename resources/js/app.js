import './bootstrap'
import Vue from 'vue'
import Index from './Index'
import routes from './routes/router'
import VueRouter from 'vue-router'
import abilityPlugin from '@casl/vue'
import abilities from './services/store/abilities'
import store from './services/store/store'
import vuetify from './plugins/vuetify';
import VeeValidate from 'vee-validate'

Vue.config.productionTip = false


// Set Vue globally

// Set Vue router
Vue.use(VueRouter)
Vue.use(VeeValidate)

//Load abilities
Vue.use('abilityPlugin', 'abilities')
// Load Index
Vue.component('index', Index)

//Store
require('./services/store/subscriber')
store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
    new Vue({
        el: '#app',
        vuetify,
        router: new VueRouter({
            routes
        }),
        store: store,
    }).$mount('#app');

})

