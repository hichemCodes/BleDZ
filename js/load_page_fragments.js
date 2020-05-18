$(document).ready(function()
{

      change_cuurent_link_color();
      hide_pop_up();
      
});



let pop_up = document.querySelector('.pop_up');
function show_pop_up()
{

  pop_up.classList.toggle('hidden');


} 
function hide_pop_up()
{
  let body = document.querySelector('body');
 


  body.addEventListener('click',(event)=>{
      if(event.target.closest('.pop_up')) return;
      if(event.target.closest('.avatar_container')) return;
      pop_up.classList.add('hidden');

      });
}

function change_cuurent_link_color()
{
    let title = document.title.split('|')[1].toLowerCase().trim();
    let all_links = document.querySelectorAll('.linked_target a');

    all_links.forEach( (element)=>{
         

         if( element.children[0].innerHTML.trim().toLowerCase() == title)
         {
            element.children[0].setAttribute('id','current');
            return;
         }


    })
}