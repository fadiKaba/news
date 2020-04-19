<template>
    <div class="main-category mt-2 mt-md-5">
        <div class="client">
            <h2>{{category.category}} <span v-if="category.category == 'world' || category.category == 'sports'">news</span> </h2>
        </div>
        <div v-if="user != false">
            <button class="mt-2 btn main-btn" v-if="authmain || authcat" @click="newMode= !newMode, getSpecials(category.id)">add new post</button>
            <div v-if="newMode" class="bg-white shadow p-4 mt-3"> 
                <form id="category-single-post-form" action="">
                    <input type="hidden" name="category" :value="category.id">
                    <div class="my-3">
                        <h4>English</h4>
                        <div class="form-group" v-if="specialsArr.length > 0">
                            <label for="">Special:</label>
                            <select class="form-control" name="special">
                                <option v-for="special in specialsArr" :key="'sp'+special.id" :value="special.id">{{special.special}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Image:</label>
                            <input class="form-control" type="file" name="img" id="new-post-img">
                            <small class="text-danger" v-if="errors != '' && errors.img">{{errors.img[0]}}</small>
                        </div>               
                        <div class="form-group">
                            <label for="">Title:</label>
                            <input class="form-control" v-model="title" type="text" name="title" placeholder="Title">
                            <small class="text-danger" v-if="errors != '' && errors.title">{{errors.title[0]}}</small> 
                        </div>  
                        <label for="">Post body:</label>            
                        <ckeditor name="body" :editor="editor"  v-model="body" :config="editorConfig"></ckeditor>
                        <small class="text-danger" v-if="errors != '' && errors.body">{{errors.body[0]}}</small> 
                        <input type="hidden" name="body" v-model="body">
                    </div>
                    <hr>
                    <div class="my-3">
                        <h4>العربية</h4>               
                        <div class="form-group">
                            <label for="">:العنوان</label>
                        <input class="form-control" v-model="titleAr" type="text" name="title_ar" placeholder="العنوان">
                        <small class="text-danger" v-if="errors != '' && errors.title_ar">{{errors.title_ar[0]}}</small>
                        </div>  
                        <label for="">:النص</label>           
                        <ckeditor class="form-control" :editor="editor"  v-model="bodyAr" :config="editorConfig"></ckeditor> 
                        <small class="text-danger" v-if="errors != '' && errors.body_ar">{{errors.body_ar[0]}}</small>
                        <input type="hidden" name="body_ar" v-model="bodyAr">
                    </div>     
                </form>
                <p class="alert alert-success" v-if="success != ''">{{success}}</p>
                <p class="alert alert-danger" v-if="errMessage != ''">{{errMessage}}</p>
                <button class="btn main-btn" @click="newPost()">Save</button>       
            </div>
        </div>
        <div class="client">
            <Categorynav :category="category"></Categorynav>
            <div class="sections">
                <div class="section1 mt-3 mt-md-4" v-if="postsArr.length > 0">
                    <div class="row" v-for="pos in postsArr" :key="'pss'+ pos.id">
                        <div class="col-md-5">
                            <div>
                                <img :src="'/images/single-post-photos/'+pos[index].src" :alt="pos[index].title" width="100%">
                                <h4 class="mt-2 mt-md-4"><a :href="'/post/show/'+pos[index].id" class="text-dark">{{pos[index].title}}</a></h4>
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
                                <h4 class="mt-2 mt-md-4"><a :href="'/post/show/'+pos[index + 1].id" class="text-dark">{{pos[index +1].title}}</a></h4>
                                <p v-html="maxLength(pos[index +1].body, 200)"></p>
                                <small class="text-muted">
                                    {{ moment.utc(pos[index +1].created_at).fromNow() }}
                                    <span>' By {{pos[index +1].userName}}</span>
                                </small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <h4 class=""><a :href="'/post/show/'+pos[index + 2].id" class="text-dark">{{pos[index +2].title}}</a></h4>
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
                                <h4 class=""><a :href="'/post/show/'+pos[index + 3].id" class="text-dark">{{pos[index +3].title}}</a></h4>
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
            <div class="random">
                <div class="mt-3 pt-3 mt-md-5 pt-md-5 main-random" v-if="postsArr.length > 0 && postsArr[0].length > 8">
                    <div class="row justify-content-around">
                        <div  :key="'r2'+postsArr[0][index +4].id" class="col-md-2">
                            <img :src="'/images/single-post-photos/'+postsArr[0][index +4].src" alt="" width="100%">
                            <h5 class=""><a :href="'/post/show/'+postsArr[0][index +4].id" class="text-dark">{{postsArr[0][index +4].title}}</a></h5>
                        </div>
                        <div  :key="'r2'+postsArr[0][index +5].id" class="col-md-2">
                            <img :src="'/images/single-post-photos/'+postsArr[0][index +5].src" alt="" width="100%">
                            <h5 class=""><a :href="'/post/show/'+postsArr[0][index +5].id" class="text-dark">{{postsArr[0][index +5].title}}</a></h5>
                        </div>
                        <div  :key="'r2'+postsArr[0][index +6].id" class="col-md-2">
                            <img :src="'/images/single-post-photos/'+postsArr[0][index +6].src" alt="" width="100%">
                            <h5 class=""><a :href="'/post/show/'+postsArr[0][index +6].id" class="text-dark">{{postsArr[0][index +6].title}}</a></h5>
                        </div>
                        <div  :key="'r2'+postsArr[0][index +7].id" class="col-md-2">
                            <img :src="'/images/single-post-photos/'+postsArr[0][index +7].src" alt="" width="100%">
                            <h5 class=""><a :href="'/post/show/'+postsArr[0][index +7].id" class="text-dark">{{postsArr[0][index +7].title}}</a></h5>
                        </div>
                        <div  :key="'r2'+postsArr[0][index +8].id" class="col-md-2">
                            <img :src="'/images/single-post-photos/'+postsArr[0][index +8].src" alt="" width="100%">
                            <h5 class=""><a :href="'/post/show/'+postsArr[0][index +8].id" class="text-dark">{{postsArr[0][index +8].title}}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="latest">
                <Postlatest :categoryId="this.category.id" specialId="no"></Postlatest>
            </div>
        </div>
    </div>
</template>
<script>

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Categorynav from './Categorynav';
import Postlatest from './Postlatest';

export default {
    name:'Category',
    components:{Categorynav, Postlatest},
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
            errMessage:'',
            errors:'',
            index:0,
            postsArr: [],
        }
    },
    created: function(){
       this.makePostArr(this.posts.data);
    },
    mounted: function(){
      
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
                if(this.postsArr[0]){
                    this.postsArr[0].unshift(response.data); 
                    this.success = 'New post has been added successfully to '  + this.category.category;
                    this.allNull();
                }else{
                    console.log(this.postsArr)
                    this.success = 'New post has been added successfully to ' + this.category.category + '; 4 posts are the minimum required to start showing them';
                    this.allNull();
                    if(this.postsArr.length == 4){
                        location.reload();
                    }
                }
                
            }).catch((err) => {
                 if(err.response){
                     this.errMessage = err.response.data.message;
                     this.errors = err.response.data.errors;
                 }
            })
        },
        allNull: function(){
            this.title = '';
            this.body = '';
            this.titleAr = '';
            this.bodyAr = '';
            this.errMessage= '';
            this.errors = '';
            document.querySelector('#new-post-img').value = '';
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
            if(arrP.length >= 4){
              this.postsArr.push(arrP)  
            }           
        },
        maxLength: function(str, max){
          if(str.length > max){
             return str.slice(0, max) + '...';
          }else{
              return str;
          }
        },
    },
    watch:{
        success: function(newVal, oldVal){
          setTimeout(()=>{
              this.success = ''
          },8000);
        }
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

  .main-random{
      border-top: solid rgb(195, 195, 195) 1px;
      h5{ 
          margin-top:15px;
          font-weight: 600;
          font-family: 'Domine', serif;
          font-size: 0.9rem;
      }
  }

</style>