    
             
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
                                            $('body').append("<div class='succes_valid error_u'> l'image doit étre au type jpg au jpeg au png </div>");
                                      }
                                      else if(data == 'fail_size')
                                      {
                                                   $('body').append("<div class='succes_valid error_u'> la taille de l'image est trop grand il faut que ne dépasse pas 1 Mo </div>")
                                      }
                                      else
                                      {
                                            $('body').append("<div class='succes_valid '> la photo de profile est changé avec succée </div>");

                                            $('.user_img').attr('src','../users_avatar/'+data);
                                            $('.user_img2').attr('src','../users_avatar/'+data);
                                            $('.user_img3').attr('src','../users_avatar/'+data);

                                      }
                                      
                                      setTimeout(function () { $('.succes_valid').hide(); }, 4000);
                                      
                                      
                               }
                       })
                })   
         });