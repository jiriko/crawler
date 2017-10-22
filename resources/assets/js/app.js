require('./bootstrap');
import App from './App.vue'
window.Vue = require('vue');

Object.defineProperty(Vue.prototype, '$bus', {
    get() {
        return new Vue()
    }
})

import Vuetify from 'vuetify'

import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify)

const app = new Vue({
    el: '#app',
    ...App
});
