    
             
              $(document).ready(function(){

                $('#file').change(function(){

                       $('.update_a').submit();
                });

                $('.update_a').on('submit',function(e)
                {
                       var fd = new FormData();
                       var files = $('#file')[0].files[0];
                       fd.append('file',files);
                       
                       e.preventDefault();
                       $.ajax({
                              'url':'action/update_avatar.php',
                              'type' : 'POST',
                              'data': fd,
                              contentType: false,
                              processData: false,
                               success:function(data)
                               {
                                      if(data == 'fail_type')
                                      {       
                                            show_fail_msg("l'image doit être au type Jpg / jpeg / Png !");
                                      }
                                      else if(data == 'fail_size')
                                      {
                                            show_fail_msg('la taille de l\'image est trop grande, il faut que ne dépasse pas 1 Mo !');
                                      }
                                      else
                                      {
                                            show_success_msg('photo de profil changé avec succès');
                                          
                                            if($('.user_img2').length == 0)
                                            {
                                                 $('.old_avatar .fa-5x').replaceWith('<img src="../users_avatar/'+data+'" class="user_img">');
                                                 $('.avatar_d').replaceWith('<img src="../users_avatar/'+data+'" class="user_img2">');
                                                 $('.p_logo .fa-2x').replaceWith('<img src="../users_avatar/'+data+'" class="user_img3">');

                                            }
                                            else
                                            {
                                                 $('.user_img').attr('src','../users_avatar/'+data);
                                                 $('.user_img2').attr('src','../users_avatar/'+data);
                                                 $('.user_img3').attr('src','../users_avatar/'+data);
                                            }
                                           

                                      }
                                      
                                      
                                      
                               }
                       })
                })   
         });