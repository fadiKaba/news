<template>
    <div class="mt-3 pt-3 main-random">
        <div class="row">
            <div v-for="post in postsArr" :key="'r'+post.id" class="col-md-2">
                <img :src="'/images/single-post-photos/'+post.src" alt="" width="100%">
                <h5 class="mt-2"><a class="text-dark" :href="'/post/show/'+post.id">{{post.title}}</a></h5>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Postrandom',
    props: ['category'],
    data: function(){
        return{
            postsArr: [],
        }
    },
    created: function(){
       
    },
    mounted: function(){
      this.getRandomposts(this.category)
    },
    methods: {
        getRandomposts: function(categoryId){
            axios.post(`/posts/random/${categoryId}`)
            .then((response) => {
               this.makPostsArr(response.data);
            });
        },
        makPostsArr: function(arr){ 
            class Post{
                constructor(post){
                    this.id = post.id,
                    this.title = post.title;
                    this.body = post.body;
                    this.special = post.special;
                    this.category = post.admincat_id;
                    this.src = post.src;
                }
            }    
            arr.forEach(element => {
                if(element != null){
                   let postR = new Post(element)
                   this.postsArr.push(postR) 
                }                
            });       
        }
    }
}
</script>
<style lang="scss" scoped>
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