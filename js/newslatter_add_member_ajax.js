$(document).ready(function(){

    $('.share').on('submit',function(e){
       

                  e.preventDefault();

                  var email = $('#email').val();

                  $.ajax({
                        'url' : 'action/newslatter_add.php',
                        'type' : 'POST',
                        data : {email:email},
                        success:function(data)
                        {
                          $('body').append(data);
                          setTimeout(function () { $('.succes_valid').hide(); }, 1650);
                        }
                        
                  });

    });
})