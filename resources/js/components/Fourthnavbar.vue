<template>
      <div class="main-fourth-navbar">
          <div class="row py-2">
              <div v-for="post in posts" :key="'fpo'+post.id" class="col-md-3">
                   <div class="media">
                        <img :src="'/images/fourth-bar/'+post.src" class="mr-3" alt="..." width="60px">
                        <div class="media-body">
                            <h5 class="my-0">{{post.title}}</h5>
                            {{maxLength(post.body, '52')}}
                            <button class="mt-1 edit-admin" v-if="authmain">Edit</button>
                        </div>
                    </div>
              </div>
              <div class="col-md-3 text-right">
                  <div v-if="weatherInfo != ''" class="row">
                      <div class="col-md-6">
                          <p>somthing else</p>
                      </div>
                      <div class="col-md-6">
                          <img :src="'/ico/'+weatherInfo.main+'.svg'" alt="" width="40px">
                          <span class="ml-2 font-weight-bold area">{{weatherInfo.temperature + 'C'}}</span>
                      </div>
                  </div>
                  <p v-if="userInfo != ''" class="area">{{userInfo.cityName +', '+ userInfo.countryName}}</p>
              </div>
          </div>
      </div>
</template>
<script>

import axios from 'axios';

export default {
    name:'Fourthnavbar',
    props:['authmain'],
    data: function(){
      return {
          userInfo: '',
          weatherInfo: '',
          posts:[],
      }
    },
    mounted: function(){
      //you shod turn this on when you finish developing your website weather app
      // this.getIpAdress(); 
      
      this.getPosts();

    },
    methods:{
        getIpAdress: function(){
            $.getJSON("http://api.db-ip.com/v2/free/self").then((addrInfo) =>{
                 axios.get(`http://ip-api.com/json/${addrInfo.ipAddress}`)
                  .then((response)=>{                     
                       this.makeUserInfo(response.data);
                })   
                }
             );
             
        },        
        makeUserInfo: function(info){
           class UserInfo{
               constructor(location){
                   this.countryCode = location.countryCode;
                   this.countryName = location.country;
                   this.cityName = location.city;
                   this.ipAddress = location.query;
                   this.timeZone = location.timezone
               }
           }
           this.userInfo = new UserInfo(info)
           this.getWeather( this.userInfo.cityName, this.userInfo.countryCode );
         },
         makeWeatherInfo: function(weatherInfo){
             class Weather{
                 constructor(weather){
                    this.temperature = Math.floor((weather.main.temp_min + weather.main.temp_min) / 2 - 273.15);
                    this.description = weather.weather[0].description;
                    this.main = weather.weather[0].main;
                    this.icon = weather.weather[0].ico;
                 }
             }
             this.weatherInfo = new Weather(weatherInfo);
         },
         getWeather: function(cityName, code) {
            let vm = this;
            var key = '{feb4305836e07f97a8d44c5d7209a5a4}';
            fetch(`https://api.openweathermap.org/data/2.5/weather?q=${cityName},${code}&APPID=feb4305836e07f97a8d44c5d7209a5a4`)
         // fetch(`https://api.openweathermap.org/data/2.5/weather?q=Damascus,${code}&APPID=feb4305836e07f97a8d44c5d7209a5a4`) 
            .then(function(resp) { return resp.json() }) // Convert data to json
            .then(function(data) {               
             vm.makeWeatherInfo(data);          
            })
            .catch(function(err) {
            //console.log(err)
            });
        },
        maxLength: function(str, max){
          if(str.length > max){
             return str.slice(0, max) + '...';
          }else{
              return str;
          }
        },
        getPosts: function(){
            axios.post('/forthbar/posts')
            .then((response) => {
                this.posts = response.data
            })
        } 
    },   
}
</script>
<style lang="scss" scoped>
     .main-fourth-navbar{
         .row{
            div{
                .media{
                    line-height: 14px;
                }
                .area{
                    font-size: 0.7rem;
                }
            }
         }
     }
</style>