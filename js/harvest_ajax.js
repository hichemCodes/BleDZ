$(document).ready(function(){

  
    // call to all_recolte function
    all_recolte("date",2020);
    recolte_list_année();

   //
       $('.t_date').on('submit',function(){
         
         localStorage.setItem('oreder_by_search','date');
         if( $( "#year_s" ).val() == "tous" )
         {
           all_recolte("date");
         }
         else
         {
           all_recolte("date",$( "#year_s" ).val());
         }
          
           
       });
       $('.t_qantity').on('submit',function(){
            
             localStorage.setItem('oreder_by_search','Quantity');
             if( $( "#year_s" ).val() == "tous" )
               {
                 all_recolte("Quantity");
               }
               else
               {
                 all_recolte("Quantity",$( "#year_s" ).val());
               }
       
       });
       $('.t_quality').on('submit',function(){
             
             localStorage.setItem('oreder_by_search','Quality');
             if( $( "#year_s" ).val() == "tous" )
               {
                 all_recolte("Quality");
               }
               else
               {
                 all_recolte("Quality",$( "#year_s" ).val());
               }
         
       });
       $('.t_montant').on('submit',function(){
         
         localStorage.setItem('oreder_by_search','montant');
         if( $( "#year_s" ).val() == "tous" )
               {
                 all_recolte("montant");
               }
               else
               {
                 all_recolte("montant",$( "#year_s" ).val());
               }
     
       });

       $('#year_s').on('change',function(e)
       {   
             localStorage.setItem('start_page',0);
             localStorage.setItem('end_page',5);
             all_recolte(localStorage.getItem('oreder_by_search'),$("#year_s").val());
       });
       // prevent form 
       $('.t_year').on('submit',function(e)
       {
             e.preventDefault();
       })
    
});


///////////  show all recoltes
function all_recolte(order_by,year = "tous")
{
  
  var start_p = (localStorage.getItem('start_page') === null) ? 0 : (localStorage.getItem('start_page'));
  var end_p = (localStorage.getItem('end_page') === null) ? 0 : (localStorage.getItem('end_page'));
  
  $.ajax({
        'url':'action/recolte_list_agriculteur.php',
        'type':'POST',
        data: { 
                order_by:order_by,
                year,year,
                start_p : start_p,
                end_p : end_p
               
              },
            
        success:function(data)
        {
              $('.all_recolte').html(data);
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
      
       all_recolte(order_by,year);
}
 ///////////                 
function recolte_list_année()
{
  $.ajax({
         'url':'action/recolte_list_année.php',
         'type':'POST',
         beforeSend : function()
         {
              
              $('.all_recolte_annee').html('<div class="lds-ripple"><div></div><div></div></div>');  
         },
         success:function(data)
         {
               $('.all_recolte_annee').html(data);
         }
  });
}
function show_recolte_detail(id)
     {

        $('.cover_all2').show();
        $('.profile_container').css("display","flex");

           $.ajax({
               'url' : 'action/show_recolte_detail.php',
               'type' : 'POST',
               data : { id:id },
               beforeSend : function()
               {
                     $('.profile').addClass('custum_profile');
                     $('.profile').html('<div class="lds-ripple"><div></div><div></div></div>');  
               },
               success:function(data)
               {
                  $('.profile').html(data);
               }
           });
     }
     
      // les détails de récolte par année
     function recolte_detail_year(year)
     {

        $('.cover_all2').show();
        $('.profile_container').css("display","flex");

        $.ajax({

           'url' : 'action/show_recolte_detail_year.php',
           'type' : 'POST',
            data : {year:year,type:'agriculteur'},
            beforeSend : function()
            {
                  $('.profile').addClass('custum_profile');
                  $('.profile').html('<div class="lds-ripple"><div></div><div></div></div>');  
            },
            success:function(data){
              if(data == 'fail year')
              {
                     $('body').append("<div class='succes_valid error_u'> email incorrécte  </div>");
                     setTimeout(function () { $('.succes_valid').hide(); }, 1500);
              }
              else
              {
                    $('.profile').html(data);
              }
             
           }
        });
     }

     function exit_from_recolte_detail(){

        $('.profile').removeClass('custum_profile');
        $('.profile').html('');
        $('profile_container').hide();
        $('.cover_all2').hide();
    }