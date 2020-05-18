$(document).ready(function()
{

     /// afficher le formulaire d'ajout d'une nouvelle facture 
     /////
     $('.add_facture').on('click',function(){
                                   
        $('.cover_all').show();
        $('#add_facture').css("display","flex");
         
        
        $.ajax({
              
            url : 'action/show_add_facture.php',
            type : 'POST',
            data : {step : 'first'},
            beforeSend:function()
            {
                $('#add_facture_form').html('<div class="lds-ripple"><div></div><div></div></div>');
            },
            success:function(data)
            {
               
                $('#add_facture_form').html(data);
                
                $('.move_next').on('click',function(e)
                {
                      e.preventDefault();

                      var is_selected = $('#user_selected').val(); 
                      var agr_id = $('#user_selected').val();
                      if(is_selected != '' && is_selected!= null)
                     {
                     $.ajax({

                          
                         url : 'action/show_add_facture.php',
                         type : 'POST',
                         data : {agr_id : agr_id,step : 'end'},
                         beforeSend:function()
                         {
                            $('#add_facture_form').html('<div class="lds-ripple"><div></div><div></div></div>');
                         },
                         success:function(data)
                         {
   
                              $('#add_facture_form').html(data);

                              $('.s_updated').addClass('hidden');

                              $('.add_facture_final').bind('click',function()
                              {

                                        var items = [];
                                        $.each($("input[name='recolte']:checked"), function(){
                                            items.push($(this).val());
                                        });

                                        ///var items_join = items.join(",");
                                        if(items.length > 0)
                                        {
                                        $.ajax({

                                                url : 'action/add_facture.php',
                                                type : 'POST',
                                                data : { all_recolte : items,agriculteur_id : agr_id},
                                                success:function(data)
                                                {
                                                      $('.add_facture_final').unbind('click')  //remove event
                                                      $('.exit_add_f_i').click();
                                                      show_all_factures();

                                                      show_success_msg(data);

                                                }
                                        });
                                     }
                                     else
                                     {
                                              show_fail_msg("il faut choisir au moins une récolte !");
                                     }

                              })

                         }
                     });
                     }
                     else
                     {            
                             show_fail_msg("il faut choisir un compte !");
                     }
                });
            }
        });
});
});


//// afficher tous les factures ajouté déja
function show_all_factures(start_page=0,end_page=5)
{
     $.ajax({
          
          url : 'action/show_all_factures.php',
          type : 'POST',
          data : {
                        start_page : start_page,
                        end_page : end_page,
                 },
          success:function(data)
          {
               $('.o_accounts_factures').html(data);
          }
     });
}
///
///  
function return_to_add_facture()
    {
                           
        $('#add_facture_form').html("");  
        $('.add_facture').click();
                            
    }
 ///                         
function show_recolte_list_option()
    {
        document.querySelector('.cheked_items').classList.toggle('show_recolte_list_option');
    }


////fermer le formulaire d'ajout de récolte
function exit_add_facture()
    {
        $('.move_next').unbind('click');
        $('.add_facture_final').unbind('click');
        $('#add_facture_form').html("");
        $('#add_facture').hide();
        $('.cover_all').hide();

        // remove error div if is exist
        if(document.querySelector('.s_updated').classList.contains('error_u'))
        { 
            $('.s_updated').removeClass('error_u');
            $('.s_updated').addClass('hidden');
        }
    }


