<template>
    <div class="main-category mt-2 mt-md-5">
        <div class="client">
            <h2>{{category.category}} news</h2>

        </div>
        <div v-if="user != false">
            <button class="mt-2 btn main-btn" v-if="authmain || authcat" @click="newMode= !newMode, getSpecials(category.id)">add new post</button>
            <div v-if="newMode" class="bg-white shadow p-4 mt-3"> 
                <p class="alert alert-success" v-if="success != ''">{{success}}</p>
                <form id="category-single-post-form" action="">
                    <input type="hidden" name="category" :value="category.id">
                    <div class="my-3">
                        <h4>English</h4>
                        <div class="form-group">
                            <label for="">Special:</label>
                            <select class="form-control" name="special">
                                <option v-for="special in specialsArr" :key="'sp'+special.id" :value="special.id">{{special.special}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Image:</label>
                            <input class="form-control" type="file" name="img">
                        </div>               
                        <div class="form-group">
                            <label for="">Title:</label>
                        <input class="form-control" v-model="title" type="text" name="title" placeholder="Title"> 
                        </div>  
                        <label for="">Post body:</label>            
                        <ckeditor name="body" :editor="editor"  v-model="body" :config="editorConfig"></ckeditor> 
                        <input type="hidden" name="body" v-model="body">
                    </div>
                    <hr>
                    <div class="my-3">
                        <h4>العربية</h4>               
                        <div class="form-group">
                            <label for="">:العنوان</label>
                        <input class="form-control" v-model="titleAr" type="text" name="title_ar" placeholder="العنوان">
                        </div>  
                        <label for="">:النص</label>           
                        <ckeditor class="form-control" :editor="editor"  v-model="bodyAr" :config="editorConfig"></ckeditor> 
                        <input type="hidden" name="body_ar" v-model="bodyAr">
                    </div>     
                </form>
                <button class="btn main-btn" @click="newPost()">Save</button>       
            </div>
        </div>
        <div class="client">
            <Categorynav :category="category"></Categorynav>
            <div class="sections">
                <div class="section1 mt-3 mt-md-4">
                    <div class="row" v-for="pos in postsArr" :key="'pss'+ pos.id">
                        <div class="col-md-5">
                            <div>
                                <img :src="'/images/single-post-photos/'+pos[index].src" :alt="pos[index].title" width="100%">
                                <h4 class="mt-2 mt-md-4">{{pos[index].title}}</h4>
                                <p class="" v-html="maxLength(pos[index].body, 200)"></p>
                                <small class="text-muted">
                                    {{ moment.utc(pos[index].created_at).fromNow() }}
                                    <span>' By {{pos[index].userName}}</span>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <img :src="'/images/single-post-photos/'+pos[index +1].src" :alt="pos[index +1].title" width="100%">
                                <h4 class="mt-2 mt-md-4">{{pos[index +1].title}}</h4>
                                <p v-html="maxLength(pos[index +1].body, 200)"></p>
                                <small class="text-muted">
                                    {{ moment.utc(pos[index +1].created_at).fromNow() }}
                                    <span>' By {{pos[index +1].userName}}</span>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <h4 class="">{{pos[index +2].title}}</h4>
                                <div>
                                    <img class="float-right" :src="'/images/single-post-photos/'+pos[index +2].src" :alt="pos[index +2].title" width="30%">
                                    <span v-html="maxLength(pos[index +2].body, 200)"></span>
                                    <small class="text-muted">
                                        {{ moment.utc(pos[index +2].created_at).fromNow() }}
                                        <span>' By {{pos[index +2].userName}}</span>
                                    </small>
                                </div>
                            </div>
                            <div>
                                <h4 class="">{{pos[index +3].title}}</h4>
                                <div>
                                    <img class="float-right" :src="'/images/single-post-photos/'+pos[index +3].src" :alt="pos[index +3].title" width="30%">
                                    <span v-html="maxLength(pos[index +3].body, 200)"></span>
                                    <small class="text-muted">
                                        {{ moment.utc(pos[index +3].created_at).fromNow() }}
                                        <span>' By {{pos[index +3].userName}}</span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Categorynav from './Categorynav';

export default {
    name:'Category',
    components:{Categorynav},
    props:['authmain', 'authcat', 'user', 'category', 'posts'],
    data: function(){
        return{
            editor: ClassicEditor,
            editorConfig: {
                toolbar: {
                    items: ['heading', '|','bold','italic','link','undo','redo','bulletedList', 'numberedList', 'blockQuote' ]
                },
            },
            newMode: false,
            moment: require('moment'),
            specialsArr: [],
            title:'',
            body:'',
            titleAr:'',
            bodyAr:'',
            success: '',
            index:0,
            postsArr: [],
        }
    },
    created: function(){
       this.makePostArr(this.posts.data);
    },
    mounted: function(){
       console.log(this.posts)
    },
    methods:{
        getSpecials: function(catId){
           axios.post(`/specials/get/${catId}`)
           .then((response) => {
               this.specialsArr = response.data
           })
        },
        newPost: function(){
            let newPostForm = new FormData(document.querySelector('#category-single-post-form'));
            axios({
                method: 'POST',
                url:'/post/new',
                data: newPostForm,
                config: { headers: {'Content-Type': 'multipart/form-data' }},
            }).then((response) => {
                console.log(response)
            })
        },
        makePostArr: function(postsArr){
            class Post{
                constructor(post){
                    this.id = post.id;
                    this.title = post.title;
                    this.body = post.body;
                    this.special = post.special;
                    this.category = post.admincat_id;
                    this.src = post.src;
                    this.userName = post.user.name;
                }
            }
            let arrP = [];
            postsArr.forEach((item) => {
                let postR = new Post(item);
                arrP.push(postR);
            })
            this.postsArr.push(arrP)
        },
        maxLength: function(str, max){
          if(str.length > max){
             return str.slice(0, max) + '...';
          }else{
              return str;
          }
        },

    }
}
</script>
<style lang="scss" scoped>

.main-category{
    .client{
        h2{
           font-size: 2.9rem;
           font-weight: 700;
           font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
           text-transform: capitalize;  
        }               
    }
}

hr {
  margin-top: 2rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgb(0, 0, 0);
}

.sections{
    h4{
        font-weight: 700;
        font-family: 'Domine', serif;
    }
    p{
        color: #333333;
        font-family: 'Tinos', serif;
    }
}

</style>