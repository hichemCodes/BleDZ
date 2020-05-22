let poster_items = document.querySelectorAll(".update_poster div");

let cover =  document.querySelector(".cover");

let all_images = ['../img/b_cover.jpg','../img/sign_in_up.jpg','../img/pfe2.jpg'];

let all_b_slide = document.querySelectorAll('.change_bg div');


var cpt = 0;

//set the interval
let changeBg = setInterval (changeAll,6000);


function changeAll()
{

    changeBackground();

    changeCurrentActive();

}




function changeBackground()
{
    cover.style.backgroundImage = "url('"+all_images[cpt] +"')";
    cpt  = (cpt+1)%3;
}

function changeCurrentActive()
{
    all_b_slide.forEach( element =>{
   
        if(element.classList.contains('active_bg'))
        {
            element.classList.remove('active_bg');
        }

        all_b_slide[cpt].classList.add('active_bg');


    });

}

