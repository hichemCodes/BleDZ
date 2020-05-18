let Dashboard = document.querySelector('.Dashboard');
let all_items = document.querySelectorAll('.section');
let all_hidden = document.querySelectorAll('.special');
let search_popup = document.querySelector('.search_r');
let search_bar = document.querySelector('.search');
let body = document.querySelector('body');

// change page when click in the links
all_items.forEach((Element)=>{
    Element.addEventListener('click',()=>{

        
         
        all_hidden.forEach((e)=>{

                if(!(e.className).includes('hidden')) {
                    e.classList.add('hidden');


                }

       })
       the_one = document.querySelector('.'+Element.id);
       the_one.classList.toggle('hidden');
       

    });

   
})
// change the color of the background of item when we click

all_items.forEach((element)=>{

    element.addEventListener('click',()=>{
    
        all_items.forEach((p)=>{
    
            if((p.className).includes('active')){
                p.classList.remove('active');
    
            }
        })
        element.classList.toggle('active');
    })
})

///   check localstorage when load the page 
if(  (localStorage.getItem('active')) === null) {

    localStorage.setItem('active','Dashboard');
    document.querySelector('.Dashboard').classList.remove('hidden');



    }
    else{
         let y = localStorage.getItem('active');

         document.querySelector('.'+y).classList.remove('hidden');
         document.querySelector('#'+y).click();


    }

    


    all_items.forEach((element)=>{
         element.addEventListener('click',()=>{
             let new_y = element.id;

             localStorage.setItem('active',new_y);/// add the current page in the localstorag
             
             localStorage.setItem('start_page',0);  // rensialize pagination system to 0
             localStorage.setItem('end_page',5);
         });
    })


   // resize search popup when focus and when blur the search bar 

   search_bar.addEventListener('focus',()=>{

         search_popup.classList.add('resize_pop_up');   
   });

    /*search_bar.addEventListener('blur',()=>{

    search_popup.classList.remove('resize_pop_up');   
    });*/

   
   body.addEventListener('click',(event)=>{
    
    if(event.target.closest('.search'))  return;
    if(search_popup.classList.contains('resize_pop_up'))
    {
        if(event.target.closest('.search_r'))  return;
        search_popup.classList.remove('resize_pop_up');  
        search_popup.style.display = 'none'; 
    } 
});