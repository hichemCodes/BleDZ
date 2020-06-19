$(document).ready(function()
{
    

    /// classer la récolte
    $('.t_date').on('submit',function(){

        localStorage.setItem('oreder_by_search','date');
         
        if( $( "#year_s" ).val() == "tous" )
        {
            show_all_recolte_office("date");
        }
        else
        {
            show_all_recolte_office("date",$( "#year_s" ).val());
        }
        
            
    });
        $('.t_qantity').on('submit',function(){
            
            localStorage.setItem('oreder_by_search','Quantity');
            if( $( "#year_s" ).val() == "tous" )
                {
                   show_all_recolte_office("Quantity");
                }
                else
                {
                   show_all_recolte_office("Quantity",$( "#year_s" ).val());
                }
        
        });
        $('.t_quality').on('submit',function(){
            
                localStorage.setItem('oreder_by_search','Quality');

                if( $( "#year_s" ).val() == "tous" )
                {
                 show_all_recolte_office("Quality");
                }
                else
                {
                 show_all_recolte_office("Quality",$( "#year_s" ).val());
                }

                 });
                $('.t_montant').on('submit',function(){
                
                localStorage.setItem('oreder_by_search','montant');
                if( $( "#year_s" ).val() == "tous" )
                        {
                        show_all_recolte_office("montant");
                        }
                        else
                        {
                        show_all_recolte_office("montant",$( "#year_s" ).val());
                        }
            
            });

                $('#year_s').on('change',function(e)
                {
                    localStorage.setItem('start_page',0);
                    localStorage.setItem('end_page',5);
                    show_all_recolte_office(localStorage.getItem('oreder_by_search'),$( "#year_s" ).val());
                });

});
 
//// afficher le formulaire d'ajout du récolte et ajouter récolte
function show_add_recolte(rendez_vous_id,agr_id)
{

           $('.cover_all').show();
           $('.add_recolte').css("display","flex");

           $.ajax({
                 
                 url : 'action/show_add_recolte_form.php',
                 type : 'POST',
                 beforeSend : function()
                 {
                     $('.add_recolte_form').html('<div class="lds-ripple"><div></div><div></div></div>');
                 },
                 success : function(data)
                          {
                               $('.add_recolte_form').html("");
                               $('.add_recolte_form').html(data);

                                // show all qualitys of a product when the product field changed
                                $('#produit').on('change',function(e)
                                {
                                        var current_product = e.target.value;
                                        
                                        $.ajax({
                                                    url : 'action/show_qualitys.php',
                                                    method : 'POST',
                                                    data : { product_id : current_product},
                                                    success : function(data)
                                                    {
                                                        $('#qualité').html(data);
                                                    }
                                               });

                                });

                               $('.add_recolte_form').unbind('submit').bind('submit',function(e){
                                           e.preventDefault();

                                           /// variable 
                                           var  produit_code = $('#produit').val();
                                           var poids_entré = $('#poids_entré').val();
                                           var poids_sortie = $('#poids_sortie').val();
                                           var quality = $('#qualité').val();
                                           var agriculteur_id = agr_id;
                                           var r_d_v = rendez_vous_id;
                                           var matricule_v = $('#matricule_v').val();
                                           var marque_v = $('#marque_v').val();
                                           var n_p_chauf = $('#n_p_chauf').val();
                                           var n_permis = $('#n_permis').val();


                                           $.ajax({

                                               url : 'action/add_récolte.php',
                                               type : 'POST',
                                               dataType : 'JSON',
                                               data:{
                                                   agriculteur_id:agriculteur_id,
                                                   produit_code : produit_code,
                                                   poids_entré : poids_entré,
                                                   poids_sortie : poids_sortie,
                                                   quality : quality,
                                                   r_d_v : r_d_v,
                                                   matricule_v : matricule_v,
                                                   marque_v : marque_v,
                                                   n_p_chauf : n_p_chauf,
                                                   n_permis : n_permis
                                                   
                                               },
                                               success:function(data)
                                               {
                                                   if(data.result == "success")
                                                   {
                                                       

                                                        //hide form
                                                        hide_add_recolte_form();
                                                       
                                                        // refresh 
                                                        rendez_vous_prise();

                                                        Swal.fire(
                                                            'Ajoutée !',
                                                             'récolte ajoutée avec succès',
                                                            'success'
                                                          )
                                                      
                                                       
                                                   }
                                                   else
                                                   {
                                                    
                                                        show_fail_msg(data.result);
                                                    
                                                   }
                                                   
                                              
                                                   
                                             }                   
                                           });
                               });
                          }
                   });
           
};
 //  le nombre de récoltes enregistré
 function recolte_count()
 {
      $.ajax({

         url : 'action/recolte_count.php',
         type : 'POST',
         success:function(data)
             {
               $('.count_recolte').html(data);
             }

             });
 }

 function show_all_recolte_office(
                                  order_by = (localStorage.getItem('oreder_by_search') != null ) ? localStorage.getItem('oreder_by_search') : 'date',
                                  year = $("#year_s").val()
                                  )
{
    var start_p = (localStorage.getItem('start_page') != null ) ? localStorage.getItem('start_page') : 0;
    var end_p = (localStorage.getItem('end_page') != null ) ? localStorage.getItem('start_page') : 5;
   
    $.ajax({

            url : 'action/show_sort_option.php',
            type : 'POST',
            dataType : 'JSON',
            success:function(data)
                {
                    if(data.result == 'success')
                    {
                            $('.no_o_recelte').hide();
                            $('.sort_l').show();

                            $.ajax({
                                url : 'action/show_all_recolte_office.php',
                                type : 'POST',
                                data : {
                                          order_by:order_by,
                                          year:year,
                                          start_p : start_p,
                                          end_p : end_p
                                      },
                                success:function(data)
                                {
                                  $('.o_récolte').html(data);
                                  
                                  
                                }
                           });
                            
                    }
                    else
                    {
                         $('.sort_l').hide();
                         $('.no_o_recelte').show();

                    }
                }

            });
   

    
}
/////////////  change search page 

function show_interval_page(start_p,end_p)
{
 
      localStorage.setItem('start_page',start_p);
      localStorage.setItem('end_page',end_p);
      
       var order_by =  localStorage.getItem('oreder_by_search');
       var year = $( "#year_s" ).val();
      
       show_all_recolte_office(order_by,year);
}
////
function show_all_recolte_office_année()
{
     $.ajax({
          'url' : 'action/recolte_list_année_office.php',
          'type' : 'POST',
          
          success:function(data)
          {
            $('.a_récolte').html(data);
          }
     });
}
function show_recolte_detail(id)
{
      $('.cover_all').show(); 
      $('.profile_container').css("display","flex"); 
      
      
      $.ajax({
          'url' : 'action/show_recolte_detail.php',
          'type' : 'POST',
          beforeSend : function()
          {
              $('.profile').addClass('custum_profile');
              $('.profile').html('<div class="lds-ripple"><div></div><div></div></div>');
              
          },
          data : { id:id },
          success:function(data)
          {
           
          
            $('.profile').html(data);
            
          }
      });
}

/// show edit harvest form
function show_recolte_edit(recolte_id)
{
    $('.cover_all').show();
    $('.edit_recolte').css("display","flex");

    $.ajax({
          
          url : 'action/show_edit_recolte_form.php',
          type : 'POST',
          data : { harvest_id : recolte_id},
          beforeSend : function()
          {
              $('.edit_recolte form').html('<div class="lds-ripple"><div></div><div></div></div>');
          },
          success : function(data)
                   {
                        $('.edit_recolte form').html("");
                        $('.edit_recolte form').html(data);

                         // show all qualitys of a product 
                      
                            var current_product = $("#produit").val();
                                 
                                $.ajax({
                                        url : 'action/show_qualitys.php',
                                        method : 'POST',
                                        data : { product_id : current_product},
                                        success : function(data)
                                            {
                                                 $('#qualité').html(data);
                                            }
                                        });
                   }
            });    
}
/// recolte detaile pendant une année

function recolte_detail_year(year)
     {

        $('.cover_all').show(); 
        $('.profile_container').css("display","flex");
        $.ajax({

           'url' : 'action/show_recolte_detail_year.php',
           'type' : 'POST',
            data : {year:year,type:'office'},
            beforeSend : function()
            {
                $('.profile').addClass('custum_profile');
                $('.profile').html('<div class="lds-ripple"><div></div><div></div></div>');
            },
           success:function(data){
              if(data == 'fail year')
              {
                     $('body').append("<div class='succes_valid error_u'> cette années ne trouve pas   </div>");
                     setTimeout(function () { $('.succes_valid').hide(); }, 1500);
              }
              else{

                 $('.profile').addClass('.custum_profile');
                 $('.profile').html(data);
              }
             
           }
        });
     }

  // hide add_recolte form
      
  function hide_add_recolte_form()
  {
       $('.add_recolte_form').unbind('submit');
       $('.add_recolte_form').html('');
       $('.add_recolte').hide();
       $('.cover_all').hide();

            // remove error div if is exist
        if(document.querySelector('.s_updated').classList.contains('error_u'))
        { 
            $('.s_updated').removeClass('error_u');
            $('.s_updated').addClass('hidden');
        }
  }    
  // hide edit_recolte form

  function hide_edit_recolte_form()
  {
       $('.edit_recolte_form').unbind('submit');
       $('.edit_recolte_form').html('');
       $('.edit_recolte').hide();
       $('.cover_all').hide();

            // remove error div if is exist
        if(document.querySelector('.s_updated').classList.contains('error_u'))
        { 
            $('.s_updated').removeClass('error_u');
            $('.s_updated').addClass('hidden');
        }
  }    

  function exit_from_recolte_detail(){

    $('.profile').removeClass('custum_profile');
    $('.profile').html('');
    $('.profile_container').hide();
    $('.cover_all').hide();
}
