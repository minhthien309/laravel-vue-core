require('./bootstrap');

import Vue from 'vue'
import router from './routers'
import VueRouter from 'vue-router'
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';

Vue.use(VueRouter)
Vue.use(Antd)

const app = new Vue({
    el: '#app',
    router,
});
app.$mount('#app')