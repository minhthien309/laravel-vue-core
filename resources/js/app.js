require('./bootstrap');

import Vue from 'vue'
import router from './routers'
import VueRouter from 'vue-router'
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';
import VueCookies from 'vue-cookies';
import axios from 'axios';

axios.defaults.baseURL = '/api/';

Vue.use(VueRouter)
Vue.use(Antd)
Vue.use(VueCookies);

Vue.prototype.$axios = axios

const app = new Vue({
    el: '#app',
    router
});
app.$mount('#app')