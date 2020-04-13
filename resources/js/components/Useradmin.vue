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
            <th>Categories</th>
            <th>Edit</th>
        </tr>

        <tr v-for="user in usersArr" :key="'us'+user.id" class="inputs">
            <td>
                <input disabled :class="userToEdit != 'us'+user.id ? 'form-control bg-white border-0' : 'form-control border-info bg-white'" :value="user.id">
            </td>
            <td>
                <input 
                disabled 
                class="form-control bg-white border-0" 
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
                class="form-control bg-white border-0" 
                v-if="userToEdit != 'us'+user.id" 
                :value="user.email">
                <input 
                :class="errors != '' && errors.email ? 'form-control border-danger' : 'form-control border-info'" 
                v-else v-model="userEmail"  
                :placeholder="user.email">
                <small class="text-danger" v-if="'us'+user.id == userToEdit && errors != '' && errors.email">{{errors.email[0]}}</small>
            </td>
            <td>
                <input disabled class="form-control bg-white border-0" v-if="userToEdit != 'us'+user.id" :value="user.role == 1 ? 'Admin' : 'Subscriber'">
                <select class="form-control border-info" v-else v-model="userRole">
                    <option value="0">Subsciber</option>
                    <option value="1">Admin</option>
                </select>
            </td>
            <td>
                <div class="dropdown" v-if="userToEdit != 'us'+user.id" name="">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button disabled v-if="user.categories.length == 0" class="btn text-danger font-weight-bold" href="#">Main Admin</button>
                        <button disabled v-for="category in user.categories" :key="'cat'+category.id" class="btn" href="#">{{category.category}}</button>
                    </div>
                </div>
                <div class="dropdown" v-else name="">
                    <button class="btn border-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <span class="text-success">+</span>/<span class="text-danger">-</span> Categories
                    </button>
                    <div class="dropdown-menu" id="" aria-labelledby="dropdownMenuButton">
                        <a v-for="category in remainedCat" :key="'cat'+category.id" @click="addCategory(user.id, category)" class="dropdown-item" href="#"><span class="text-success">+</span> {{category.category}}</a>
                        <a v-for="category in adminCat" :key="'cat'+category.id" @click="addCategory(user.id, category)" class="dropdown-item" href="#"><span class="text-danger">-</span> {{category.category}}</a>
                    </div>
                </div>
            </td>
            <td>
                <button @click="editUser(user.id), makeAdminRemainedcatVar(user.categories)" class="edit-admin bg-dark">Edit</button>
                <button @click="save(user.id, user.name)" class="edit-admin">Save</button>
                <button @click="destroy(user.id, user.name)" class="edit-admin bg-danger">Delete</button>
            </td>
        </tr>
    </table>
</div>
</template>
<script>

import axios from 'axios';

export default {
    name:'Useradmin',
    props: ['users', 'time'],
    data: function(){
        return {
            usersArr:[],
            userToEdit:'',
            adminCat:'',
            remainedCat:'',
            allCats: '',
            success:'',
            errMessage:'',
            errors:'',
            userName:'',
            userEmail:'',
            userRole:''
        }
    },
    mounted: function(){
      // console.log(this.users)
      this.makeUsersArr(this.users);
      this.getCategories();
          
        $(function() {
            $('.dropdown-menu').on('click', function(event) {
                event.stopPropagation();
            });
        });

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
            axios.get('/users/getusersjson')
                .then((response) => {
                    this.usersArr = [];
                    this.makeUsersArr(response.data);
                    this.userToEdit = ''
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
        makeAdminRemainedcatVar: function(catArr){
            if(catArr != null && catArr !== ''){
                this.remainedCat = [];
                this.adminCat = [];
                 for(let i = 0; i < this.allCats.length; i++){
                    let is = catArr.find(x => x.id == this.allCats[i].id)
                    if(is == undefined){
                        this.remainedCat.push(this.allCats[i])
                    }else{
                        this.adminCat.push(this.allCats[i])
                    }
                 }
            }                     
        },
        getCategories: function(){
            axios.post('/users/gategories')
            .then((response) => {
                this.allCats = response.data;
            })
        },
        addCategory: function(userId, category){
            axios.post(`/user/addcategory/${userId}/${category.id}`)
            .then((response) => {
                if(response.data == 'detach'){
                    for(let i = 0; i < this.adminCat.length; i++){
                        if(category.id == this.adminCat[i].id){
                            this.adminCat.splice(i, 1);
                            this.remainedCat.push(category)
                        }
                    }
                }else{
                    this.adminCat.push(category);
                    for(let i = 0; i < this.remainedCat.length; i++){
                        if(category.id == this.remainedCat[i].id){
                            this.remainedCat.splice(i, 1);
                        }
                    }
                }
            })
        },
        allNull: function(){
            this.userName = '';
            this.userEmail ='';
            this.userRole = '';
            this.errMessage = '';
            this.errors = '';
        },
        save: function(userId, userN){
           // this.getUsers();
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
</style>