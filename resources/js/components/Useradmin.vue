<template>  
   <div>
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
                <input disabled :class="userToEdit != 'us'+user.id ? 'form-control' : 'form-control border-danger'" :value="user.id">
            </td>
            <td>
                <input disabled class="form-control" v-if="userToEdit != 'us'+user.id" :value="user.name">
                <input class="form-control border-danger" v-else name="" :value="user.name">
            </td>
            <td>
                <input disabled class="form-control" v-if="userToEdit != 'us'+user.id" :value="user.email">
                <input class="form-control border-danger" v-else name="" :value="user.email">
            </td>
            <td>
                <input disabled class="form-control" v-if="userToEdit != 'us'+user.id" :value="user.role">
                <select class="form-control border-danger" v-else name="" :value="user.role">
                    <option>0</option>
                    <option>1</option>
                </select>
            </td>
            <td>
                <div class="dropdown" v-if="userToEdit != 'us'+user.id" name="">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button disabled v-for="category in user.categories" :key="'cat'+category.id" class="btn" href="#">{{category.category}}</button>
                    </div>
                </div>
                <div class="dropdown" v-else name="">
                    <button class="btn border-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       + Categories
                    </button>
                    <div class="dropdown-menu" id="" aria-labelledby="dropdownMenuButton">
                        <a v-for="category in remainedCat" :key="'cat'+category.id" @click="addCategory(user.id, category)" class="dropdown-item" href="#"><span class="text-success">+</span> {{category.category}}</a>
                        <a v-for="category in adminCat" :key="'cat'+category.id" @click="addCategory(user.id, category)" class="dropdown-item" href="#"><span class="text-danger">-</span> {{category.category}}</a>
                    </div>
                </div>
            </td>
            <td>
                <button @click="editUser(user.id), makeAdminRemainedcatVar(user.categories)" class="edit-admin bg-dark">Edit</button>
                <button @click="save()" class="edit-admin">Save</button>
                <button class="edit-admin bg-danger">Delete</button>
            </td>
        </tr>
    </table>
</div>
</template>
<script>

import axios from 'axios';

export default {
    name:'Useradmin',
    props: ['users'],
    data: function(){
        return {
            usersArr:[],
            userToEdit:'',
            adminCat:'',
            remainedCat:'',
            allCats: '',
        }
    },
    mounted: function(){
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
                });
        },
        editUser: function(userId){
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
        save: function(){
            this.getUsers();
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