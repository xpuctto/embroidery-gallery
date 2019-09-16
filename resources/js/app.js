import './bootstrap';
import vue from 'vue';
import axios from 'axios';
import vueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import VueAuth from '@websanova/vue-auth';

import Home from './components/Home';
import AdminPanel from './components/admin/Panel';
import AdminDashboard from './components/admin/Dashboard';
import Login from './components/admin/Login';
import Register from './components/admin/Register';

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
    }
];

const router = new VueRouter({ routes, history: true, mode: 'history' });

Vue.use(VueRouter);
Vue.use(vueAxios, axios);

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
