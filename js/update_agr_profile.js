$(document).ready(function(){
    
    $.ajax({

          url :'action/load_update_agr_profile.php',
          method : 'POST',
          success : function(data)
          {
                $('.small').html(data);
                  console.log(data);
                  $('.edit_form').on('submit',function(e){
    
                        e.preventDefault();
            
                        var email = $('#email_u').val();
                        var pass = $('#pass_u').val();
            
                        $.ajax({
            
                              url : 'action/update_agr_profile.php',
                              type : 'POST',
                              dataType : 'JSON',
                              data : {email:email,pass:pass},
                              success:function(data)
                              {
                                  if(data.result != 'fail')
                                  {
                                        $('#pass_u').val('');

                                        if(document.querySelector('.s_updated').classList.contains('error_u'))
                                        {
                                             $('.s_updated').addClass('hidden');
                                        }
                                        
                                        Swal.fire(
                                            'Modifié !',
                                             data.result,
                                            'success'
                                        )
                                  }
                                  else
                                  {
                                        show_fail_msg(data.err);
                                  }
                                    
                              }       
            
                        });
         
                      });
                  // update password
                  $('.update_ofice_pass').on('submit',function(e){
 
                        e.preventDefault();
                        var old_pass = $('#old_pass').val();
                        var new_pass = $('#new_pass').val();
                        var new_pass_conf = $('#new_pass_conf').val();
                        

                        $.ajax({

                            url :'action/update_user_password.php',
                            type :'POST',
                            dataType : 'JSON',
                            data : { 
                                        old_pass : old_pass, 
                                        new_pass : new_pass,  
                                        new_pass_conf : new_pass_conf
                                    },
                            success:function data(data){

                                if(data.result == 'fail')
                                {
                                    show_fail_msg(data.err);
                                }
                                else
                                {
                                    
                                    // clen the input 
                                    $('#old_pass').val('');
                                    $('#new_pass').val('');
                                    $('#new_pass_conf').val('');

                                    if(document.querySelector('.s_updated').classList.contains('error_u'))
                                    {
                                         $('.s_updated').addClass('hidden');
                                    }

                                    Swal.fire(
                                        'Modifié !',
                                         data.result,
                                        'success'
                                    )
                                }
                                
                            
                            }

                        });
                });
          }

    })
   
});