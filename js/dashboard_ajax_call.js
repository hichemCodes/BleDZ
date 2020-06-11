///// on load event 

$(document).ready(function(){

    setInterval ( ()=>{

        // dashboard count 
        register_user_count();
        in_valid_accounts_count();
        rendez_vous_pris_count();
        recolte_count();

        
         // rendez-vous
         rendez_vous_prise();
         rendez_vous_non_prise();


    },2000);

        // dashboard count 
        register_user_count();
        in_valid_accounts_count();
        rendez_vous_pris_count();
        recolte_count();

        // chart graph
        chart_recoltes(2020);  
        chart_money(2020);
        
          //account
          all_account();
          show_all_offices();
  
          // invalid account
          all_invalid_accounts();
          show_invalid_offices();
  

        // rendez-vous
        rendez_vous_prise();
        rendez_vous_non_prise();

        // récoltes
        show_all_recolte_office();  // classer la récolte par date la premiere fois 
        show_all_recolte_office_année(); 

        //product
        show_all_product();

        // factures
        show_all_factures();

        //account_setting
        show_update_profile_form();


       
   
    
    

    /// rechercher a les utilisateur qui apartient a la méme wilaya que l'office
    $('.search').keyup(function(){

        value = $(this).val();
            if(value.length == 0)
            { 
                   $('.search_r').hide();
            }
            else
            {
                   $('.search_r').show();

                    $.ajax({
                            url:'action/search_users.php',
                            type:'POST',
                            data :{query:value},
                            dataType:'text',
                            success:function(data)
                            {
                                $('.search_r').html(data);

                                $('.search_r').on('click',function()
                                {
                                     $('.search_r').hide();
                                })
                            }
                })
             }
       
    });

    // event when click to dashboard section
    $('.click_member').click(function(){
        $('#accounts').click();
        });

        $('.click_r_v').click(function(){
            $('#rendez_vous2').click();
        });

        $('.click_valid').click(function(){
        $('#valider').click();
        });
        
        $('.click_recolte').click(function(){
        $('#récolte_s').click();
        });
        
        $('.profile_s').click(function()
        {
        $('.search_r').hide();
        $('.search').val('');
    });    
   
        
    /// end of onload events
});


    /// show profile
    function show_account(id){

        $('.cover_all').show();
        $('.profile_container').css("display","flex");
         
        
        $.ajax({

            url:'action/visit_profile.php',
            type:'POST',
            dataType : 'JSON',
            data : { id : id },
            beforeSend : function()
            {
                $('.profile').html('<div class="lds-ripple"><div></div><div></div></div>');
            },
            success:function(data){
                 if(data.result == "fail")
                 {
                     $('.profile').html(data.err);
                 }
                 else
                 {  
                     
                    $('.profile').html(data.result);
                 }
               

            }
            
        });
    }
    
    /// show office account 
    function show_office_account(user_id)
    {

            $('.cover_all').show();
            $('.profile_container').css("display","flex");
            $('.profile').addClass('c_o_body');

            $.ajax({
                  url : 'action/show_office_account.php',
                  type : 'POST',
                  data : {user_id : user_id},
                  beforeSend : function()
                  {
                      $('.profile').html('<div class="lds-ripple"><div></div><div></div></div>');
                  },
                  success:function(data)
                  {
                    $('.profile').html(data);
                  }
            })
    }
   
     // exit from profile form
      function exit_profile(){

        $('.profile').removeClass('c_o_body');
        $('.profile').html('');
        $('.profile_container').hide();
        $('.cover_all').hide();

    }

