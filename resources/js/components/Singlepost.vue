<template>
    <div class="col-md-9 m-auto py-2 py-md-5" id="single-post">
   <h3 class="pl-md-5 py-4">{{post.title}}</h3>
   <div class="">
       <img class="" :src="'/images/single-post-photos/'+src" width="100%">
       <div class="pt-2 pt-md-5 col-md-10 mx-auto">
           <a href="#" class="text-dark font-weight-bold admin-name">By {{post.user.name}}</a>
           <div class="row mt-3">               
                <div class="col-md-6">
                    {{ moment(post.created_at).format("MMMM D, Y, h:m a") }}
                </div>
                <div class="col-md-6 social text-right">
                    <a href="#"><img src="/ico/facebook.svg" alt="facebook" width="17px"></a>
                    <a href="#"><img src="/ico/twitter.svg" alt="twitter" width="17px"></a>
                    <a href="#"><img src="/ico/mail.svg" alt="mail" width="17px"></a>
                    <a href="#"><img src="/ico/share.svg" alt="share" width="17px"></a>
                </div>         
           </div>
        </div>                  
       <div v-html="post.body" class="mt-3 post-body col-md-10 mx-auto"></div>
    </div>
    <button class="mt-2 btn main-btn" v-if="authmain" @click="editMode = !editMode, getSpecials(post.admincat.id)">Edit</button>
    <div v-if="editMode" class="bg-white shadow p-4 mt-3"> 
            <form id="single-post-form" action="">
                <div class="my-3">
                    <h4>English</h4>
                    <div class="form-group">
                        <label for="">Special:</label>
                        <select class="form-control" name="special">
                            <option value="" disabled selected>{{defaultSpecial}}</option>
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
                <input type="hidden" name="admincat_id" :value="post.admincat_id">        
            </form>
            <p class="alert alert-success" v-if="success != ''">{{success}}</p>
            <button class="btn main-btn" @click="save()">Save</button>       
        </div>
        <!-- <Postrandom :category="post.admincat_id"></Postrandom> -->
    </div>
</template>
<script>

import axios from 'axios';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Postrandom from './Postrandom';

export default {
    name:'Single',
    components:{Postrandom},
    props:['post', 'authmain'],
    data: function(){
        return{
            editor: ClassicEditor,
            editorConfig: {
                toolbar: {
                    items: ['heading', '|','bold','italic','link','undo','redo','bulletedList', 'numberedList', 'blockQuote' ]
                },
            },
            editMode:false,
            title:this.post.title,
            body: this.post.body,
            titleAr:this.post.title_ar,
            bodyAr:this.post.body_ar, 
            src: this.post.src,
            success: '',   
            moment: require('moment'),
            specialsArr:[], 
            defaultSpecial:'',
            updatedTitle:'',
            updatedBody:'' 
        }
    },
    mounted: function(){

    },
    methods:{
        save: function(){
            let ask = confirm('Save this post ?');
            if(ask){
                let fr = new FormData(document.querySelector('#single-post-form'));
              axios({
                method: 'POST',
                url: `/post/update/${this.post.id}/${this.post.admincat.id}`,
                data: fr,
                config: { headers: {'Content-Type': 'multipart/form-data' }},               
              }).then((response) => {
                  this.success = 'Post saved'
                  setInterval(()=>{
                      this.success = '';
                      location.reload();
                      }, 3000);
                  if(response.data != 'saved'){
                      this.src = response.data;
                      setInterval(()=>{
                      this.success = '';
                      location.reload();
                      }, 3000);
                  }
              });
            }
        },
        getSpecials(categoryId){
            axios.post(`/posts/getSpecials/${categoryId}`)
            .then((response) => {
                this.specialsArr = response.data;
                this.defaultSpecial = this.specialsArr[this.post.special - 1]['special'];
            })
        }
    }
}
</script>
<style lang="scss" scoped>
 #single-post{
    h3{
        font-family: 'Domine', serif;
        font-size: 2.1rem;
        font-weight: 700;
        font-style: italic;
        text-transform: capitalize;
    }
    div{
        .admin-name{
            font-size: 1rem;
        }
        .post-body{
            font-size: 1.3rem;
            font-family: 'Tinos', serif;
        }
    }
}

.social{
    a{ 
        padding: 5px;
        border-radius: 50%;
        border: solid rgb(255, 255, 255) 1px;
        transition:0.2s;
        margin-right: 10px;
       &:hover{
        border: solid rgb(204, 204, 204) 1px;
        } 
    }  
}

hr {
  margin-top: 2rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgb(0, 0, 0);
}
</style>