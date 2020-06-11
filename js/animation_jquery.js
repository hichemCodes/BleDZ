
$(document).ready(function(){

    var services = $('#services');
    var agruculteurs = $('.about');

$('.to_top').click(function(){
    $('body,html').animate({scrollTop:0},'slow');
  })
  

var window_height =$(window).height();

// scroll events
 $(window).scroll(function(){

    if( $(window).scrollTop() + 100 > window_height ){

        $('.nav').addClass('spacial_nav animate_me');
        $('.cnx_btn').addClass('light_black');
        $('.to_top').addClass('show_me');

        

    }
    else
    {
        $('.nav').removeClass('spacial_nav animate_me');
        $('.cnx_btn').removeClass('light_black');
        $('.to_top').removeClass('show_me')
    }

    if( $(window).scrollTop() > 0 ){

   

        // change color of links when scrolling
         
        if( ($(window).scrollTop()  < agruculteurs.position().top-75) && ( $(window).scrollTop()  > services.position().top-75 ) )
        {
            reset_links();
            $('#service').addClass('active_nav_link');
        }
        else if( ($(window).scrollTop() > agruculteurs.position().top-75) && ( $(window).scrollTop() > services.position().top-75 ) )
        {
             reset_links();
             $('#agriculteur').addClass('active_nav_link');
        }
        else
        {
            reset_links();
            $('#acceuil').addClass('active_nav_link');   
        }

    }


    
     


})


    
    
    $('#service').click(function(){

        $('body,html').animate({scrollTop:services.position().top-29},'slow');
    });

    $('#agriculteur').click(function(){

        $('body,html').animate({scrollTop:agruculteurs.position().top-29},'slow');
    });

    $('#acceuil').click(function(){

        $('body,html').animate({scrollTop:0},'slow');
    });


   


});

const all_links = document.querySelectorAll('.nav_child ul li');

function reset_links()
{

     all_links.forEach ( link =>{
          if(link.classList.contains('active_nav_link'))  link.classList.remove('active_nav_link');
     });

}