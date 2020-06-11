// slide profile animation 

let btn_slider_right = document.querySelector('.slide_profile_right');
let btn_slider_left = document.querySelector('.slide_profile_left');

let all_profile = document.querySelector('.agr_list');
let all_profile_count_h = all_profile.childElementCount;

let profile_img = document.querySelectorAll('.profile .img,.profile');
let client_window_width = window.innerWidth;

let profile_width = Math.ceil(client_window_width * 0.1847575058);
let slider_width = Math.ceil(client_window_width * 0.212);
let final_slide =(slider_width * all_profile_count_h) ; // the final slide

//set the width of the profile items

profile_img.forEach ( profile => {


        profile.style.width = profile_width+'px';

});





// add the default transition in the local storage
localStorage.setItem('slider',0);

if(all_profile_count_h > 4)  // number of the minumuim profile
{
    btn_slider_right.classList.add('show_slide');
    
    // slide right
    btn_slider_right.addEventListener('click',()=>{

            let current_scroll =  parseInt(localStorage.getItem('slider'));

            if( ((current_scroll + (slider_width * 4)) > final_slide ))// check if we can slide 4 item in one slide or not)
            {
                 var next_silide = current_scroll + slider_width;
            }    
            else
            {
                 var next_silide = current_scroll+ 4 *slider_width;                 
            }


             all_profile.style.transform = 'translateX('+(-next_silide)+'px)';

             localStorage.setItem('slider',next_silide);
             
            if( (next_silide == slider_width) || (next_silide == slider_width * 4) )  //animation for the first time
            {
                btn_slider_left.classList.add('show_slide');
            }
            // if we are in the last profile 
            if((next_silide+4*slider_width) == (all_profile_count_h*slider_width) )
            {
                btn_slider_right.classList.remove('show_slide');

            }
            

    });
    /// slide right

    btn_slider_left.addEventListener('click',()=>{

            let current_scroll =  parseInt(localStorage.getItem('slider'));

            if( ((current_scroll - (slider_width * 4)) < 0 ))// check if we can slide 4 item in one slide or not)
            {
                 var next_silide = current_scroll - slider_width;        
            }    
            else
            {
                 var next_silide = current_scroll - 4 * slider_width;
            }

         all_profile.style.transform = 'translateX('+(-next_silide)+'px)';

         localStorage.setItem('slider',next_silide);
         
        if(next_silide == 0)  //animation for the first time
        {
            btn_slider_left.classList.remove('show_slide');
        }
        // if we clicked at least one time in slider left button
        if( current_scroll > ((all_profile_count_h-4)*slider_width)-slider_width  )
        {
            btn_slider_right.classList.add('show_slide');

        }
        

    });

}

