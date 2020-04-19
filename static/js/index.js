ready();
function ready(fn) {
    if (document.readyState != 'loading'){
        show_body();
    } 
    else {
        document.addEventListener('DOMContentLoaded', show_body);
    }
}

function show_body(){
    document.getElementsByTagName("body")[0].className = "";
    setTimeout(() => {  
    var banner_content = document.getElementsByClassName("index-banner-content")[0];
    banner_content.className = banner_content.className.replace(" hidden" , "");
        }, 500); 
}

// after loading page
var nav = document.getElementById('nav-bar');
// var open_desc = document.querySelector('#open-desc');
// var toolkit_desc = document.querySelector('#toolkit-desc');

function scroll_down(){
    document.querySelector('.index-learn-more').scrollIntoView({ 
        behavior: 'smooth' 
    });
}


// function in_viewport(elem){
//     // function to check if element is in viewport
//     var bounding = elem.getBoundingClientRect();
//     if (    bounding.top >= 0 &&
//             bounding.left >= 0 &&
//             bounding.right <= (window.innerWidth || document.documentElement.clientWidth) &&
//             bounding.bottom <= (window.innerHeight || document.documentElement.clientHeight)){
//             return true;
//         } 
//         else{
//             return false;
//         }
// }

// function add_animations(){
//     if(in_viewport(open_desc)){
//         open_desc.classList.remove("hidden");
//     }
//     if(in_viewport(toolkit_desc)){
//         toolkit_desc.classList.remove("hidden");
//     }
// }

window.onscroll = function () { 
    "use strict";
    // add_animations();
    if (document.body.scrollTop >= 200 || document.documentElement.scrollTop >=200 ) {
        nav.classList.add("navbar-custom-sb");
        nav.classList.remove("navbar-custom");
        nav.classList.remove("navbar-animate-slidein");
    } 
    else {
        nav.classList.remove("navbar-custom-sb");
        nav.classList.add("navbar-custom");
    }
};

function redirect_shop(){
    window.location.href  += "shop.php";
}
