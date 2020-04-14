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
        <form action="">
            <div class="my-3">
                <h4>English</h4>
                <div class="form-group">
                   <input class="form-control" v-model="title" type="text" name="title" placeholder="Title"> 
                </div>              
                <ckeditor name="body" :editor="editor"  v-model="body" :config="editorConfig"></ckeditor> 
            </div>
            <div class="my-3">
                <h4>العربية</h4>               
                <div class="form-group">
                   <input class="form-control" v-model="titleAr" type="text" name="title_ar" placeholder="العنوان">
                </div>               
                <ckeditor class="form-control" name="body_ar" id="txt" :editor="editor"  v-model="bodyAr" :config="editorConfig"></ckeditor> 
            </div>          
        </form>       
    </div>
    <button class="btn main-btn" @click="save()">Save</button>
</div>

</template>
<script>

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';


export default {
    name:'Single',
    props:['post'],
    data: function(){
        return{
            editor: ClassicEditor,
            editorConfig: {
                toolbar: {
                    items: ['bold','italic','link','undo','redo','bulletedList', 'numberedList', 'blockQuote', ]
                },
            },
            title:'',
            body: '',
            titleAr:'',
            bodyAr:'',          
        }
    },
    mounted: function(){

    },
    methods:{
        save: function(){
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