
$(document).ready(function(){



$('.to_top').click(function(){
    $('body,html').animate({scrollTop:0},'slow');
  })
  

var window_height =$(window).height();

 $(window).scroll(function(){
    if( $(window).scrollTop() >window_height ){
        $('.nav').addClass('spacial_nav animate_me');
        $('.cnx_btn').addClass('light_black');
        $('.to_top').addClass('show_me')


    }
    else{
        $('.nav').removeClass('spacial_nav animate_me');
        $('.cnx_btn').removeClass('light_black');
        
        $('.to_top').removeClass('show_me')
    }


})


    var services = $('#services');
    var agruculteurs = $('.about');
    
    $('#service').click(function(){

        $('body,html').animate({scrollTop:services.position().top+5},'slow');
    })

    $('#agriculteur').click(function(){

        $('body,html').animate({scrollTop:agruculteurs.position().top-30},'slow');
    })

    $('#acceuil').click(function(){

        $('body,html').animate({scrollTop:0},'slow');
    })
})