<template>
    <div class="main-latest pt-3 mt-3">
        <div class="latest-nav">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active latest-btn bg-white" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Latest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Search</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row mt-3 mt-md-4">
                        <div class="col-md-10">
                            <div class="row mt-3 border-bottom pb-4" v-for="post in latestArr" :key="'lat'+post.id">
                                <div class="col-md-3">
                                    <small class="text-muted">{{ moment(post.created_at).format("MMMM D, Y, h:m a") }}</small>
                                </div>
                                <div class="col-md-6">
                                    <h3><a class="text-dark" :href="'/post/show/'+post.id">{{post.title}}</a></h3>
                                    <p v-html="maxLength(post.body, 210)"></p>
                                    <small class="text-muted">By {{post.userName}}</small>
                                </div>
                                <div class="col-md-3">
                                    <img :src="'/images/single-post-photos/'+post.src" :alt="post.title" width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">Advertisment</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center col-md-8 mt-3">
            <button class="btn btn-light border" v-if="index < lastPage" @click="showMore()">Show more</button>
        </div>
    </div>    
</template>
<script>
export default {
    name:'Postlatest',
    props:['categoryId', 'specialId'],
    data: function(){
        return{
            index:2,
            lastPage:'',
            latestArr:[],
            moment: require('moment'),
        }
    },
    mounted: function(){
       this.getLatest(this.categoryId, this.specialId)
    },
    methods:{
        getLatest: function(categoryId, specialId){
            axios.post(`/post/latest/${categoryId}/${specialId}?page=${this.index}`)
            .then(response => {
                this.makeLatestArr(response.data.data);
                this.lastPage = response.data.last_page;
            })
        },
        makeLatestArr: function(arr){
            class Post{
               constructor(post){
                    this.id = post.id,
                    this.title = post.title;
                    this.body = post.body;
                    this.special = post.special;
                    this.category = post.admincat_id;
                    this.src = post.src;
                    this.userName = post.user.name;
               } 
            }
            arr.forEach(element => {
                let postR = new Post(element);
                this.latestArr.push(postR);
            });
        },
        maxLength: function(str, max){
          if(str.length > max){
             return str.slice(0, max) + '...';
          }else{
              return str;
          }
        },
        showMore: function(){
            this.index += 1;
            this.getLatest(this.categoryId, this.specialId);
        }
    }
}
</script>
<style lang="scss" scoped>
  .main-latest{
      border-top: solid rgb(195, 195, 195) 1px;
      ul{
          li{
              .latest-btn{
              font-weight: 700;
              }
          }
          
      }
      h3{
          font-family: 'Domine', serif;
          font-weight: 500;
          text-transform: capitalize;
      }
      p{
          font-family: 'Tinos', serif;         
            word-wrap: normal;  
      }
  }
</style>