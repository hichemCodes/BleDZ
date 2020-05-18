
                $(document).ready(function()
                {

                        $('.reset_password').on('submit',function(e)
                        {
                               
                                e.preventDefault();
                                 
                                var email = $('#email_reset').val();

                                $.ajax({

                                      url : 'action/show_reset_password.php',
                                      type : 'POST',
                                      dataType : 'JSON',
                                      data : { email : email},
                                      beforeSend : function()
                                      {
                                         $('.err').addClass('r_load');
                                        $('.err').html("vérification et envoie du code a votre email ...");
                                      },
                                      success:function(data)
                                      {
                                           if(data.err == 'success')
                                           {
                                                
                                                $.ajax({

                                                      url : 'action/reset_password.php',
                                                      type : 'POST',
                                                     
                                                      data : { action : 'show'},
                                                      success : function(data)
                                                      {

                                                          $('.form_type').html(data);

                                                          $('.reset_password_final').on('submit',function(e)
                                                          {

                                                                e.preventDefault();  

                                                                var code = $('#code_reset').val();
                                                                var pass1 = $('#pass1_reset').val();
                                                                var pass2 = $('#pass2_reset').val();
                                                                
                                                                /// reset the style 
                                                                $('#pass2_reset').removeClass('error');
                                                                $('.i_pass2').removeClass('c_error');
                                                                $('.er_pass2').html("");
                                                                $('#pass1_reset').removeClass('error');
                                                                $('.i_pass1').removeClass('c_error');
                                                                $('.er_pass1').html("");
                                                                $('#code_reset').removeClass('error');
                                                                $('.icmail').removeClass('c_error');
                                                                $('.er_code').html("");
                                                                

                                                            $.ajax({
                                                          
                                                                        url : 'action/reset_password.php',
                                                                        type : 'POST',
                                                                        dataType: 'JSON',
                                                                        data : 
                                                                            { 
                                                                                action : 'reset',
                                                                                code : code,
                                                                                pass1 : pass1,
                                                                                pass2 : pass2,
                                                                                email : email
                                                                            },
                                                                        success:function(data)
                                                                        {
                                                                            if( !('code_inv' in data) )
                                                                            {
                                                                                if( !('pass_inv' in data) )
                                                                                {
                                                                                    if( !('pass_n_m' in data) )
                                                                                    {
                                                                                        
                                                                                        $('.er_pass2').addClass('r_load');
                                                                                       
                                                                                        var counter = 8;
                                                                                        var redirectCount = setInterval(function(){
                                                                                        
                                                                                        $('.er_pass2').html(data.success+counter+'s'); 
                                                                                        counter--
                                                                                        if (counter === 0) {

                                                                                            clearInterval(redirectCount);
                                                                                            document.location.href = 'http://localhost/projet_licence/src/sign_in.php';
                                                                                        }
                                                                                        }, 1000);
                                                                                    }
                                                                                    else
                                                                                    {
                                                                                         $('#pass2_reset').addClass('error');
                                                                                         $('.i_pass2').addClass('c_error');
                                                                                         $('.er_pass2').html(data.pass_n_m);
                                                                                    }
                                                                                }
                                                                                else
                                                                                {
                                                                                    $('#pass1_reset').addClass('error');
                                                                                    $('.i_pass1').addClass('c_error');
                                                                                    $('.er_pass1').html(data.pass_inv);
                                                                                }
                                                                            }

                                                                            else
                                                                            {
                                                                                $('#code_reset').addClass('error');
                                                                                $('.icmail').addClass('c_error');
                                                                                $('.er_code').html(data.code_inv);
                                                                            }
                                                                        }      
                                                                    });
                                                          })
                                                      }
                                                });
                                           }
                                           else
                                           {
                                         

                                                $('.err').removeClass('r_load');
                                                $('.err').html(data.err);
                                                $('.email_reset').addClass('error');
                                                $('.fa-at').addClass('c_error');

                                           
                                           }
                                          
                                      }
                                });
                        });

                });
