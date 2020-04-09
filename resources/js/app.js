
require('./bootstrap');

window.Vue = require('vue');


 import Maincomponent from './components/Maincomponent';

const app = new Vue({
    el: '#app',
    components:{Maincomponent}
});
