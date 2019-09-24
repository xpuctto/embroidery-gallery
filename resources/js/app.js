import './bootstrap';
import vue from 'vue';
import axios from 'axios';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css'

import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import VueAuth from '@websanova/vue-auth';

import SearchEngine from './components/SearchEngine';
import Home from './components/Home';
import AdminPanel from './components/admin/Panel';
import AdminDashboard from './components/admin/Dashboard';
import Login from './components/admin/Login';
import Register from './components/admin/Register';
import Region from './components/Region';

window.Vue = vue;

const routes = [
    {
        path: '/',
        component: Home,
        name: 'home'
    },
    {
        path: '/admin',
        component: AdminPanel,
        name: 'adminPanel',
    },
    {
        path: '/admin/dashboard',
        component: AdminDashboard,
        name: 'adminDashboard',
    },
    {
        path: '/admin/login',
        component: Login,
        name: 'login',
    },
    {
        path: '/admin/register',
        component: Register,
        name: 'register',
    },
    {
        path: '/region/:regionId',
        component: Region
    },
    {
        path: '/search',
        component: SearchEngine
    }
];

const router = new VueRouter({ routes, history: true, mode: 'history' });

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(ElementUI);

Vue.router = router;

Vue.use(VueAuth, {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js')
});

const app = new Vue({
    el: '#app',
    router
});
