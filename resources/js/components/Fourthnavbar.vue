<template>
      <div>
          <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-3"></div>
              <div class="col-md-3"></div>
              <div class="col-md-3">
                  <div>weather here</div>
                  <p>{{userInfo.cityName +', '+ userInfo.countryName}}</p>
              </div>
          </div>
      </div>
</template>
<script>

import axios from 'axios';

export default {
    name:'Fourthnavbar',
    data: function(){
      return {
          userInfo: '',
      }
    },
    mounted: function(){
        this.getIpAdress();
    },
    methods:{
        getIpAdress: function(){
            $.getJSON("http://api.db-ip.com/v2/free/self").then((addrInfo) =>{
                console.log(addrInfo)
               this.makeUserInfo(addrInfo);
                }
             );
         },
         makeUserInfo: function(info){
           class UserInfo{
               constructor(location){
                   this.continentName = location.continentName;
                   this.countryCode = location.countryCode;
                   this.countryName = location.countryName;
                   this.cityName = location.city;
               }
           }
           this.userInfo = new UserInfo(info)
           this.getWeather( this.userInfo.cityName, this.countryCode );
         },
        getWeather: function(cityID, code) {
            var key = '{feb4305836e07f97a8d44c5d7209a5a4}';
            fetch('https://api.openweathermap.org/data/2.5/weather?q=' + cityID +','+code+ '&appid=' + key)  
            .then(function(resp) { return resp.json() }) // Convert data to json
            .then(function(data) {
                console.log(data);
            })
            .catch(function(err) {
               console.log(err)
            });
            }
    }
}
</script>
<style scoped>

</style>