let poster_items = document.querySelectorAll(".update_poster div");

let cover =  document.querySelector(".cover");

let all_images = ['../img/b_cover.jpg','../img/sign_in_up.jpg','../img/pfe2.jpg'];

var cpt = 0;

setInterval (()=>{
    
           cover.style.backgroundImage = "url('"+all_images[cpt] +"')";
            cpt  = (cpt+1)%2;

},6000);