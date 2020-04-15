<template>
    <div>
        <button class="mt-2 btn main-btn" v-if="authmain || authcat" @click="newMode= !newMode, getSpecials(post.admincat.id)">Edit</button>
    <div v-if="editMode" class="bg-white shadow p-4 mt-3"> 
        <p class="alert alert-success" v-if="success != ''">{{success}}</p>
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
        <button class="btn main-btn" @click="save()">Save</button>       
    </div>
    </div>
</template>
<script>
export default {
    name:'Category',
    props:['authmain', 'authcat'],
    data: function(){
        return{
            newMode: false,
        }
    }
}
</script>
<style scoped>

</style>