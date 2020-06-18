
$(document).ready(function()
 
{
    
                           
                            /// afficher formulaire d'ajout d'une news latter
                            $('.add_newslatter').on('click',function()
                            {
                                          $('.cover_all').show();
                                          $('#add_news_latter').css("display","flex");
                                          $.ajax({
                                               url : 'action/show_add_newslatter.php',
                                               type:'POST',
                                               beforeSend : function()
                                               {
                                                    
                                                    $('.add_news_latter_form').html('<div class="lds-ripple"><div></div><div></div></div>');
                                       
                                               },
                                               success:function(data)
                                               {
                                                   
                                                    $('.add_news_latter_form').html(data);

                                                    /// ajouter news latter 
                                                    $('.add_news_latter_form').bind('submit',function(e)
                                                    {
                                                                e.preventDefault();
                                                               
                                                                var dest = $('#public_c').val();
                                                                var object = $('#subject').val();
                                                                var msg = $('#msg_n_l').val();
                                                                
                                                                if(dest != '' && dest!= null &&  object != '' && msg!= '')
                                                                {
                                                                    $.ajax({
                                                                     
                                                                     url : 'action/send_news_latter.php',
                                                                     type : 'POST',
                                                                     dataType : 'json',
                                                                     data : {
                                                                                dest : dest,
                                                                                object : object,
                                                                                msg : msg
                                                                            },
                                                                     beforeSend : function()
                                                                     {
                                                                         Swal.fire(
                                                                            {
                                                                                 title : 'envoi du newsletter en cours',
                                                                                 showCancelButton : false,
                                                                                 showConfirmButton : false,
                                                                            }                
                                                                         );
                                                                         Swal.showLoading();
                                                                     },
                                                                    success:function(data)
                                                                    {
                                                                        if(data.result != 'fail')
                                                                        {
                                                                            $('.add_news_latter_form').unbind('submit') //remove event
                                                                               
                                                                            exit_add_news_latter();
                                                                            
                                                                            Swal.fire(
                                                                                'envoyé !',
                                                                                 data.result,
                                                                                'success'
                                                                            );
                                                                        }
                                                                        else
                                                                        {
                                                                            show_fail_msg(data.err);
                                                                        }
                                                                       

                                                                    }        

                                                                });
                                                                }                                                       
                                                                else
                                                                {
                                                                        show_fail_msg("tous les champs doivent être remplis !");
                                                                }
                                                                
                                                                

                                                    })
                                               }
                                          })
                            });
                                
        

                        });
                       
                        
                        
                       
                       // fermer le formulaire d'ajout de news latter
                        function exit_add_news_latter()
                        {
                            $('#add_news_latter_form').html('');
                            $('#add_news_latter').hide();
                            $('.cover_all').hide();

                            // remove error div if is exist
                            if(document.querySelector('.s_updated').classList.contains('error_u'))
                            { 
                                $('.s_updated').removeClass('error_u');
                                $('.s_updated').addClass('hidden');
                            }

                        }
                       ///