
/* show  update ofice  and update office account */

function show_update_profile_form()
{
         $.ajax({
 
                url : 'action/show_update_profile_office_form.php',
                type : 'POST',
                success : function(data)
                {
                     $('.p_from_ajax').html(data);
 
                        // update information
                        $('.update_ofice').on('submit',function(e){
 
                            e.preventDefault();
                            var email = $('#u_mail').val();
                            var u_mob = $('#u_mob').val();
                            var pass = $('#u_pass').val();
    
                            $.ajax({

                                 url :'action/update_office.php',
                                 type : 'POST',
                                 dataType : 'JSON',
                                 data : { email : email, mob :u_mob,  pass : pass},
                                success:function data(data){

                                    if(data.result != 'fail')
                                    {

                                        $('#u_pass').val('');

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
                                           
                                            // clean the inputs
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
         });
}     

/////

