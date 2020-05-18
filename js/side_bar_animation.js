

let side_bar = document.querySelector('.item1');
let container = document.querySelector('.item2');
let toggle_side_bar = document.querySelector('.resize');

let logo = document.querySelector('.logo a');
let all_links_text = document.querySelectorAll('.section span,.log_out_link span');
let all_links_icons = document.querySelectorAll('.section i,.section img,.log_out_link i');



// test if the side bar is alredy resized

if(localStorage.getItem('side_bar') != null)
{
    if(localStorage.getItem('side_bar') == 'large')
    {
        toggle_side_bar_fun();
    }

}
else
{
    localStorage.setItem('side_bar','small')
}


toggle_side_bar.addEventListener('click',()=>{

        toggle_side_bar_fun();

});

function toggle_side_bar_fun()
{
   
            toggle_side_bar.classList.toggle('resized');

            side_bar.classList.toggle('mini_side_bar');
        
            container.classList.toggle('large_item');
        
        
            all_links_text.forEach( element =>{
        
                    element.classList.toggle('small_bottom_txt');
        
            });
        
            all_links_icons.forEach( element =>{
        
                element.classList.toggle('center_transform');
        
            });

            //update localstorage
            if(side_bar.classList.contains('mini_side_bar'))
            {
                localStorage.setItem('side_bar','small');              

            }
            else
            {
                localStorage.setItem('side_bar','large');

            }

 

}
