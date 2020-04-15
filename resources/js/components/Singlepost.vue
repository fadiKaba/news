<template>
    <div class="col-md-8 m-auto py-2 py-md-5" id="single-post">
   <h3 class="pl-md-5 py-4">{{post.title}}</h3>
   <div>
       <img class="" :src="'/images/single-post-photos/'+post.src" width="100%">
       <div v-html="post.body" class="mt-3 post-body px-md-4"></div>
       <div class="social">

       </div>
    </div>
    <button class="mt-2 btn main-btn" v-if="authmain" @click="editMode = !editMode">Edit</button>
    <div v-if="editMode" class="bg-white shadow p-4 mt-3"> 
        <form id="single-post-form" action="">
            <div class="my-3">
                <h4>English</h4>
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
        <button class="btn main-btn" @click="save()">Save</button>       
    </div>
</div>

</template>
<script>

import axios from 'axios';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    name:'Single',
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
                url: `/post/update/${this.post.admincat.category}/${this.post.id}`,
                data: fr,
                config: { headers: {'Content-Type': 'multipart/form-data' }},               
              }).then((response) => {
                  console.log(response)
              });
            }
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
        .post-body{
            font-size: 1.3rem;
            font-family: 'Tinos', serif;
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