<template>
     <div>
         <div v-if="errors != ''" class="alert alert-warning alert-dismissible fade show" role="alert">
             <span v-for="error in errors" :key="'er'+error.id">{{error[0]}}</span>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
             </button>
         </div>         
         <div class="input-group mb-3">
            <input 
            type="text" 
            class="form-control" 
            :placeholder="pholder" 
            aria-label="Recipient's username" 
            v-model="val">
            <div class="input-group-append">
                <button 
                class="btn main-btn" 
                @click="search(val)" 
                type="button" 
                id="button-addon2">
                <div v-if="loading" class="spinner-border spinner-border-sm text-light" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <img v-else src="/ico/search.svg" alt="search" width="25px">
                </button>
            </div>
        </div>
     </div>    
</template>
<script>

import axios from 'axios';

export default {
    name:'Search',
    props:['destination','pholder'],
    data: function(){
        return {
            val:'',
            errors:'',
            loading:false,
        }
    },
    methods:{
        search: function(val){
            if(this.val.length > 0){
                this.loading = true;
                axios.post(`/${this.destination}/search/${val}`)
                .then((response) => {
                    this.loading = false;
                    this.$emit('results', response.data)
                }).catch((err) => {
                    if(err.response){
                        this.loading = false;
                        this.errors = err.response.data.errors
                    }
                })
            }         
        },
    }
}
</script>
<style lang="scss" scoped>

</style>