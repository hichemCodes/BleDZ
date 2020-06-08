$(document).ready(function()
{
   

    // afficher formulaire d'ajout de produit
    $('.add_product').on('click',function()
    {
        update_product('','add');
    });
    
    
});



 /// afficher les produits

 function show_all_product()
 {
      $.ajax({

             url : 'action/show_products.php',
             type : 'POST',
             success:function(data)
             {
                $('.product_items').html("");
                $('.product_items').html(data);
             }
      });
 };
 // supprimer un produit
 function delete_product(code)
 {
         
        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Vous ne pourrez pas revenir sur cela !",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: 'tomato',
            cancelButtonText : 'Annuler',
            confirmButtonText: 'Oui, supprimez-le !'
            }).then((result) => {
            if (result.value) {
            
                $.ajax({

                    url : 'action/delete_product.php',
                    type : 'POST',
                    dataType : 'JSON',
                    data : {code:code},
                    success:function(data)
                    {
                        if(data.result != 'fail')
                        {
                       
                            show_all_product();

                            Swal.fire(
                                'Supprimé !',
                                'Produit supprimé avec succès.',
                                'success'
                              )

                        }
                        else
                        {
                             alert(data.err);
                        }
                 
                    }
                });
         }
        }); 
 }

 
 // modifier ou ajouter un produit

 function update_product(code = '',type)
 {

    $('.cover_all').show();
    $('#update_product').css("display","flex");
    $.ajax({

          url : 'action/show_update_product.php',
          type : 'POST',
          data : {code:code,type:type},
          beforeSend : function()
          {
                $('#update_product_form').html('<div class="lds-ripple"><div></div><div></div></div>');  
          },
          success:function(data)
          {  
              $('#update_product_form').html(data);
              
              if(type == 'update')
              {
                   $('.sub_u_p').bind('click',function(e)
                   {
                       e.preventDefault();
                       
                       var code_u = $('#code_p').val();
                       var desc_u = $('#desc_p').val();
                       var prix_u = $('#prix_p').val();
                       var prix_u_2 = $('#prix_p_2').val();
                       var prix_u_3 = $('#prix_p_3').val();
                      
                       if(code_u != '' && desc_u !='' && prix_u != '')
                       {
                        if(/^\d+(\.\d+)?$/.test(prix_u_2) || prix_u_2 == '')
                        {
                            if(/^\d+(\.\d+)?$/.test(prix_u_3) || prix_u_3 == '')
                            {
                                $.ajax({
                                    url : 'action/update_product.php',
                                    type : 'POST',
                                    dataType : 'JSON',
                                    data: {
                                                code_u : code_u,
                                                desc_u : desc_u,
                                                prix_u : prix_u,
                                                p_id : code,
                                                prix_u_2 : prix_u_2,
                                                prix_u_3 : prix_u_3
                                          },
                                    success:function(data)
                                    {
                                          if(data.result != 'fail')
                                         {
                                              $('.sub_u_p').unbind('click') ///remove the event
                                              exit_product_form();

                                              show_all_product();

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
                            }
                            else
                            {
                                show_fail_msg('prix unitaire C incorrect !');
                            }
                            
                        }
                        else
                        {
                            show_fail_msg('prix unitaire B incorrect!');
                        }
                      
                       }
                       else
                       {
                                 show_fail_msg('tous les champs doivent être remplis !');                                              
                       }   
                   });
                   
              }
              else
              {
                   $('.sub_a_p').bind('click',function(e)   // fix later 
                   {
                       e.preventDefault();
                       
                       var code_a = $('#code_p').val();
                       var desc_a = $('#desc_p').val();
                       var prix_a = $('#prix_p').val();
                       var prix_u_2 = $('#prix_p_2').val();
                       var prix_u_3 = $('#prix_p_3').val();
                      
                       if(code_a != '' && desc_a !='' && prix_a != '')
                       {

                            if(/^\d+(\.\d+)?$/.test(prix_u_2) || prix_u_2 == '')
                            {
                                if(/^\d+(\.\d+)?$/.test(prix_u_3) || prix_u_3 == '')
                                {
                                        $.ajax({
                                            url : 'action/add_product.php',
                                            type : 'POST',
                                            dataType : 'JSON',
                                            data  : {
                                                        code_a : code_a,
                                                        desc_a : desc_a,
                                                        prix_a : prix_a,
                                                        prix_u_2 : prix_u_2,
                                                        prix_u_3 : prix_u_3
                                                    },
                                            success:function(data)
                                            {
                                                    if(data.result == 'fail')
                                                    {
                                                        show_fail_msg(data.err);
                                                    }  
                                                    else
                                                    {
                                                    

                                                        $('.sub_u_p').unbind('click') ///remove the event
                                                        exit_product_form();
                                                        show_all_product();

                                                        Swal.fire(
                                                            'Ajouté !',
                                                            data.result,
                                                            'success'
                                                        )

                                                        
                                                    }
                                            
                                    
                                            }        
            
                                            
                                        });
                                }
                                else
                                {
                                    show_fail_msg('prix unitaire C incorrect !');
                                }
                                
                            }
                        else
                        {
                            show_fail_msg('prix unitaire B incorrect !');
                        }
                      
                       }
                       
                       else
                       {
                           show_fail_msg('tous les champs doivent être remplis !');      
                       }   
                   });
                   
              }



            
          }
       });
}
// fermer le formulaire d'ajout de news latter

function exit_product_form()
{
     $('.sub_u_p').unbind('click')
     $('#update_product_form').html("");
     $('#update_product').hide();
     $('.cover_all').hide();


    // remove error div if is exist
    if(document.querySelector('.s_updated').classList.contains('error_u'))
    { 
        $('.s_updated').removeClass('error_u');
        $('.s_updated').addClass('hidden');
    }
}