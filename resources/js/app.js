
require('./bootstrap');

window.Vue = require('vue');


 import Maincomponent from './components/Maincomponent';
 import Useradmin from './components/Useradmin';

const app = new Vue({
    el: '#app',
    components:{Maincomponent, Useradmin}
});
