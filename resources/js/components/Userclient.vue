<template>  
   <div>
       <p class="alert alert-success fade show mt-1" v-if="success != ''">{{success}}</p>
       <p class="alert alert-danger fade show mt-1" v-if="errMessage != ''">{{errMessage}}</p>
       
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Edit</th>
        </tr>
        <tr v-for="user in usersArr" :key="'us'+user.id" class="inputs">
            <td>
                <input 
                disabled 
                :class="userToEdit != 'us'+user.id ? 'form-control' : 'form-control border-info'" 
                :value="user.id">
            </td>
            <td>
                <input 
                disabled 
                class="form-control" 
                v-if="userToEdit != 'us'+user.id" 
                :value="user.name">
                <input 
                :class="errors != '' && errors.name ? 'form-control border-danger' : 'form-control border-info'" 
                v-else 
                v-model="userName" 
                :placeholder="user.name">
                <small class="text-danger" v-if="'us'+user.id == userToEdit && errors != '' && errors.name">{{errors.name[0]}}</small>
            </td>
            <td>
                <input 
                disabled 
                class="form-control" 
                v-if="userToEdit != 'us'+user.id" 
                :value="user.email">
                <input 
                :class="errors != '' && errors.email ? 'form-control border-danger' : 'form-control border-info'" 
                v-else v-model="userEmail"  
                :placeholder="user.email">
                <small class="text-danger" v-if="'us'+user.id == userToEdit && errors != '' && errors.email">{{errors.email[0]}}</small>
            </td>
            <td>
                <input 
                disabled 
                class="form-control" 
                v-if="userToEdit != 'us'+user.id" 
                :value="user.role == 1 ? 'Admin' : 'Subscriber'">
                <select class="form-control border-info" v-else v-model="userRole">
                    <option value="0">Subsciber</option>
                    <option value="1">Admin</option>
                </select>
            </td>
            <td>
                <button @click="editUser(user.id)" class="edit-admin bg-dark">Edit</button>
                <button @click="save(user.id, user.name)" class="edit-admin">Save</button>
                <button @click="destroy(user.id, user.name)" class="edit-admin bg-danger">Delete</button>
            </td>
        </tr>        
    </table>   
    <button v-if="currentPage < lastPage" class="btn main-btn" @click="showMore">Show More</button>
</div>
</template>
<script>

import axios from 'axios';

export default {
    name:'Userclient',
    props: ['users', 'time'],
    data: function(){
        return {
            usersArr:[],
            userToEdit:'',
            success:'',
            errMessage:'',
            errors:'',
            userName:'',
            userEmail:'',
            userRole:'',
            currentPage:1,
            lastPage:'',
        }
    },
    mounted: function(){
     //  console.log(this.users);
    //   this.makeUsersArr(this.users);
    this.getUsers();
          
    },
    methods:{
        makeUsersArr: function(users){
            class User{
                constructor(user){
                    this.id = user.id;
                    this.name = user.name;
                    this.email = user.email;
                    this.role = user.is_admin;
                    this.categories = user.category
                }
            }

            users.forEach(element => {
                let usr = new User(element);
                this.usersArr.push(usr);
            });
        },
        getUsers: function(){
            axios.get(`/users/getusersclientjson?page=${this.currentPage}`)
                .then((response) => {
                    this.usersArr = [];
                    this.lastPage = response.data.last_page;
                    this.makeUsersArr(response.data.data);
                });
        },
        showMore: function(){
           axios.get(`/users/getusersclientjson?page=${this.currentPage+1}`)
                .then((response) => {
                    this.makeUsersArr(response.data.data);
                    this.currentPage++;
                });
        },
        editUser: function(userId){
            this.allNull();
            if(this.userToEdit == 'us'+userId){
                this.userToEdit = '';
                this.getUsers();
            }else{
                this.userToEdit = 'us'+userId
            }          
        },
        allNull: function(){
            this.userName = '';
            this.userEmail ='';
            this.userRole = '';
            this.errMessage = '';
            this.errors = '';
        },
        save: function(userId, userN){
            if(this.userName != '' || this.userEmail != '' || this. userRole != ''){
                axios.post(`/user/save/${userId}`, {
                    name: this.userName,
                    email: this.userEmail,
                    role: this.userRole
                }).then((response) => {
                    if(response.data == 'saved'){
                        this.getUsers();
                        this.userToEdit = '';
                        this.success = userN + ' updated successfully';
                        this.allNull();                      
                    }
                }).catch((err) => {
                    if(err.response){                      
                        this.errMessage = err.response.data.message;
                        this.errors = err.response.data.errors;
                    }
                });
            }           
        },
        destroy: function(userId, userName){
            let ask = confirm('Delete ' + userName + '?')
            if(ask){
                axios.post(`/user/destroy/${userId}`)
                .then((response) => {
                    if(response.data == 'deleted'){
                        for(let i = 0; i < this.usersArr.length; i ++){
                            if(this.usersArr[i].id == userId){
                                this.usersArr.splice(i, 1);
                            }
                        }
                        this.success = userName + ' deleted successfully'
                    }
                })
            }            
        }
    },
    watch: {
        success: function(newVal, oldVal){
            setTimeout(()=>{
              this.success = '';  
            },7000)
            
        },
        time: function(newVal, oldVal){
            this.currentPage = 1;
            this.getUsers()            
        }
    }
}
</script>

<style lang="scss" scoped>

$color1: #567b95;
$color2: #326891;

.edit-admin{
    background-color: $color1;
    font-size: 0.6rem;
    font-weight: bold;
    border: none;
    color: #fff;
    border-radius: 3px;
    padding: 3px 5px;
    transition: 0.4s;
    font-family: Arial, Helvetica, sans-serif;;
    &:hover{
        background-color: $color2;
        text-decoration: none;
        color: #fff;
    }
}

.inputs{
    td{
        padding: 5px 5px;
    }
}
// .fade-enter-active, .fade-leave-active {
//   transition: opacity .5s;
// }
// .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
//   opacity: 0;
// }
</style>