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

        <tr v-for="user in usersArr" :key="'us'+user.id">
            <td :class="userToEdit != 'us'+user.id ? '' : 'text-danger'">{{user.id}}</td>
            <td>
                <span v-if="userToEdit != 'us'+user.id">{{user.name}}</span>
                <input class="form-control border-danger" v-if="userToEdit == 'us'+user.id" name="" :value="user.name">
            </td>
            <td>
                <span v-if="userToEdit != 'us'+user.id">{{user.email}}</span>
                <input class="form-control border-danger" v-if="userToEdit == 'us'+user.id" name="" :value="user.email">
            </td>
            <td>
                <span v-if="userToEdit != 'us'+user.id">{{user.role}}</span>
                <select class="form-control border-danger" v-if="userToEdit == 'us'+user.id" name="" :value="user.role">
                    <option>0</option>
                    <option>1</option>
                </select>
            </td>
            <td>
                <span v-if="userToEdit != 'us'+user.id">cat</span>
                <select class="form-control border-danger" v-if="userToEdit == 'us'+user.id" name="" value="cat">
                    <option v-for="category in user.categories" :key="'cat'+category.id">{{category.category}}</option> 
                </select>
            </td>
            <td>
                <button @click="editUser(user.id)" class="edit-admin bg-dark">Edit</button>
                <button class="edit-admin">Save</button>
                <button class="edit-admin bg-danger">Delete</button>
            </td>
        </tr>
    </table>
</div>
</template>
<script>
export default {
    name:'Useradmin',
    props: ['users'],
    data: function(){
        return {
            usersArr:[],
            userToEdit:''
        }
    },
    mounted: function(){
      this.makeUsersArr(this.users);
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
        editUser: function(userId){
           this.userToEdit = 'us'+userId;
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

</style>