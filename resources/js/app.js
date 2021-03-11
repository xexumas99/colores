
require('./bootstrap');

window.Vue = require('vue').default;

import router from './router';
import App from './App.vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const app = new Vue({
    router,
    el: '#app',
    render: h => h(App)
});
