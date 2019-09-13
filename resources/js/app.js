import './bootstrap';
import vue from 'vue';

window.Vue = vue;

import Home from './components/Home';

Vue.component(
    'Home',
    Home
);

const app = new Vue({
    el: '#app'
});

