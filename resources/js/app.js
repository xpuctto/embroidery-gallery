import './bootstrap';
import vue from 'vue';
import VueRouter from 'vue-router';

import Home from './components/Home';
import AdminPanel from './components/admin/AdminPanel';

window.Vue = vue;

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/admin',
        component: AdminPanel
    }
];

const router = new VueRouter({ routes, history: true, mode: 'history' });

Vue.use(VueRouter);

Vue.component(
    'Home',
    Home
);

const app = new Vue({
    el: '#app',
    router
});
