<template>
    <div class="col-md-8 m-auto py-2 py-md-5" id="single-post">
   <h3>{{post.title}}</h3>
   <div>
       <img class="" :src="'/images/single-post-photos/'+post.src" width="100%">
       <div class="social">
           {{post.body}}
       </div>
    </div>
    <div>
        <form id="single-post-form" action="">
            <div class="my-3">
                <h4>English</h4>
                <div class="form-group">
                    <input class="form-control" type="file" name="img">
                </div>               
                <div class="form-group">
                   <input class="form-control" v-model="title" type="text" name="title" placeholder="Title"> 
                </div>              
                <ckeditor name="body" :editor="editor"  v-model="body" :config="editorConfig"></ckeditor> 
                <input type="hidden" name="body" v-model="body">
            </div>
            <div class="my-3">
                <h4>العربية</h4>               
                <div class="form-group">
                   <input class="form-control" v-model="titleAr" type="text" name="title_ar" placeholder="العنوان">
                </div>             
                <ckeditor class="form-control" :editor="editor"  v-model="bodyAr" :config="editorConfig"></ckeditor> 
                <input type="hidden" name="body_ar" v-model="bodyAr">
            </div>          
        </form>       
    </div>
    <button class="btn main-btn" @click="save()">Save</button>
</div>

</template>
<script>

import axios from 'axios';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    name:'Single',
    props:['post'],
    data: function(){
        return{
            editor: ClassicEditor,
            editorConfig: {
                toolbar: {
                    items: ['heading', '|','bold','italic','link','undo','redo','bulletedList', 'numberedList', 'blockQuote' ]
                },
            },
            title:this.post.title,
            body: this.post.body,
            titleAr:this.post.title_ar,
            bodyAr:this.post.body_ar,          
        }
    },
    mounted: function(){
      console.log(this.post)
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
        font-size: 3rem;
    }
}


</style>