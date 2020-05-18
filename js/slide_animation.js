// slide profile animation 

let btn_slider_right = document.querySelector('.slide_profile_right');
let btn_slider_left = document.querySelector('.slide_profile_left');

let all_profile = document.querySelector('.agr_list');
let all_profile_count_h = all_profile.childElementCount;


// add the default transition in the local storage
localStorage.setItem('slider',0);

if(all_profile_count_h > 4)  // number of the minumuim profile
{
    btn_slider_right.classList.add('show_slide');
    
    // slide right
    btn_slider_right.addEventListener('click',()=>{

            let current_scroll =  parseInt(localStorage.getItem('slider'));

             
             all_profile.style.transform = 'translateX('+(-(current_scroll+280))+'px)';

             localStorage.setItem('slider',current_scroll+280);
             
            if(current_scroll+280 == 280)  //animation for the first time
            {
                btn_slider_left.classList.add('show_slide');
            }
            // if we are in the last profile 
            if((current_scroll+280) == (all_profile_count_h-4)*280 )
            {
                btn_slider_right.classList.remove('show_slide');

            }
            

    });
    /// slide right

    btn_slider_left.addEventListener('click',()=>{

        let current_scroll =  parseInt(localStorage.getItem('slider'));

         all_profile.style.transform = 'translateX('+(-(current_scroll-280))+'px)';

         localStorage.setItem('slider',current_scroll-280);
         
        if(current_scroll-280 == 0)  //animation for the first time
        {
            btn_slider_left.classList.remove('show_slide');
        }
        // if we clicked at least one time in slider left button
        if( current_scroll > ((all_profile_count_h-4)*280)-280  )
        {
            btn_slider_right.classList.add('show_slide');

        }
        

    });

}

