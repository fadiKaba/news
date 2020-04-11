<template>
    
    <div class="border-top pt-2">
        <p class="alert alert-danger" v-if="errMessage != ''">{{errMessage}}</p>
        <p class="alert alert-success" v-if="success != ''">{{success}}</p>
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">User Name</label>
                <input v-model="name" type="text" class="form-control" placeholder="Name">
                <small v-if="errors != '' && errors.name" id="emailHelp" class="form-text text-danger">{{errors.name[0]}}</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">User Email</label>
                <input v-model="email" type="email" class="form-control" placeholder="Email">
                <small v-if="errors != '' && errors.email" id="emailHelp" class="form-text text-danger">{{errors.email[0]}}</small>
            </div> 
            <div class="form-group">
                <label for="exampleInputPassword1">User Password</label>
                <input v-model="password" type="password" class="form-control" placeholder="Password">
                <small v-if="errors != '' && errors.password" id="emailHelp" class="form-text text-danger">{{errors.password[0]}}</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">User Role</label>
                <select v-model="role" class="form-control">
                    <option selected value="0">Subscriber</option>
                    <option value="1">Admin</option>
                </select>
                <small v-if="errors != '' && errors.role" id="emailHelp" class="form-text text-danger">{{errors.role[0]}}</small>
            </div>           
        </form>
        <button @click="save()" class="btn main-btn">Save</button>
    </div>
    
</template>
<script>

import axios from 'axios';

export default {
    name: 'Newuser',
    data: function(){
        return{
            name:'',
            email:'',
            password:'',
            role:'',
            success:'',
            errMessage:'',
            errors:'',
        }
    },
    methods:{
        allNull:function(){
            this.name='';
            this.email='';
            this.password='';
            this.role='',
            this.errMessage='';
            this.errors='';
        },
        save: function(){
            axios.post('/user/add',{
                name: this.name,
                email: this.email,
                password: this.password,
                role: this.role,
            })
            .then((response) => {
                this.success = 'User has been successfully added';
                this.allNull();
            }).catch((err) => {
                if(err.response){
                    this.errMessage = err.response.data.message;
                    this.errors = err.response.data.errors;
                }
            })
        }
    },
     watch: {
        success: function(newVal, oldVal){
            setTimeout(()=>{
              this.success = '';  
            },7000)
            
        }
    }
}
</script>
<style scoped>

</style>