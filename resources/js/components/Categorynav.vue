<template>
    <div>
        <div class="third-navbar cat-nav">
            <nav class="navbar navbar-expand-lg py-1 mt-1 px-0">
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li v-for="special in specialsArr" :key="'spp' + special.id" class="nav-item mini-nav-element active">
                    <a class="nav-link pl-0 pr-4" :href="'/posts/special/'+category.id+'/'+special.id">{{special.special}}<span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                </div>
            </nav>
        </div>
    </div>
</template>
<script>
import Axios from 'axios'
export default {
    name:'Categorynav',
    props:['category'],
    data: function(){
        return {
            specialsArr: [],
        }
    },
    mounted: function(){
        this.getSpecials(this.category.id)
    },
    methods: {
        getSpecials: function(categoryId){
            axios.post(`/posts/getSpecials/${categoryId}`)
            .then((response) => {
                this.specialsArr = response.data
            })
        },
    }
    
}
</script>
<style lang="scss" scoped>
.cat-nav{
    border-bottom: 1px solid #000;
}
.mini-nav-element{
    a{
      border-right: rgb(168, 168, 168) 1px solid; 
      &:hover{
          color:blue;
      } 
    }
    
}
</style>