<template>
    <div>
        
        <Fourthnavbar :authmain="authmain"></Fourthnavbar>
    
    </div>
</template>
<script>

import Fourthnavbar from './Fourthnavbar';

export default {
    name:'Maincomponent',
    components:{Fourthnavbar},
    props:['authmain'],
    mounted: function(){

    }
}
</script>
<style scoped>

</style>