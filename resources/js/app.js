import './bootstrap'
import Vue from 'vue'
import Index from './Index'
// Set Vue globally
window.Vue = Vue
// Load Index
Vue.component('index', Index)
const app = new Vue({
    el: '#app'
});
