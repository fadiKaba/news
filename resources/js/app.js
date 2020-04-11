
require('./bootstrap');

window.Vue = require('vue');


 import Maincomponent from './components/Maincomponent';
 import Useradmin from './components/Useradmin';
 import Userclient from './components/Userclient';
 import Newuser from './components/Newuser';

const app = new Vue({
    el: '#app',
    components:{Maincomponent, Useradmin, Userclient, Newuser},
    data: function(){
        return{          
            time: ''
        }
    },
    methods:{
        getTime: function(){
            let d = new Date();
            let t = d.getTime();
            this.time = t;
        }
    }
});
