
require('./bootstrap');

window.Vue = require('vue');

import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );

Vue.use(require('vue-moment'));

 import Maincomponent from './components/Maincomponent';
 import Useradmin from './components/Useradmin';
 import Userclient from './components/Userclient';
 import Newuser from './components/Newuser';
 import Singlepost from './components/Singlepost';
 import Category from './components/Category';

const app = new Vue({
    el: '#app',
    components:{Maincomponent, Useradmin, Userclient, Newuser, Singlepost, Category},
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
