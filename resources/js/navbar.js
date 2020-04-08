const searchBtn = document.querySelector('#search-btn');
const searchForm = document.querySelector('#search-form');

const menuBtn = document.querySelector('#menu-btn');
const leftMenu = document.querySelector('#left-menu');

searchBtn.addEventListener('click', ()=>{
    if(searchForm.classList.contains('d-none')){
        searchForm.classList.remove('d-none')
    }else{
        searchForm.classList.add('d-none')
    }
})

menuBtn.addEventListener('click', ()=>{
    if(leftMenu.classList.contains('menu-left')){
        leftMenu.classList.remove('menu-left')
    }else{
        leftMenu.classList.add('menu-left')
    }
})

