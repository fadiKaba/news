
require('./bootstrap');

window.Vue = require('vue');

import VueGeolocation from 'vue-browser-geolocation';
Vue.use(VueGeolocation);

 import Maincomponent from './components/Maincomponent';

const app = new Vue({
    el: '#app',
    components:{Maincomponent}
});
