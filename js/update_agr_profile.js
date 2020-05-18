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
                              data : {email:email,pass:pass},
                              success:function(data)
                              {
                                    $('body').append(data);
                                    $('#pass_u').val('');
            
                                    setTimeout(function () { $('.s_updated').hide(); }, 2500);
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
                                    $('body').append(data.err);  
                                    setTimeout(function () { $('.s_updated').hide(); }, 3700);
                                }
                                else
                                {
                                    $('body').append(data.result);
                                    setTimeout(function () { $('.s_updated').hide(); }, 2500);
                                    // clen the input 
                                    $('#old_pass').val('');
                                    $('#new_pass').val('');
                                    $('#new_pass_conf').val('');
                                }
                                
                            
                            }

                        });
                });
          }

    })
   
});