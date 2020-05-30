$(document).ready(function(){

 ///  afficher le formulaire de l'ajout d'un mombre et ajouter un mombre
     
 $('.add_member').on('click',function(){
            
    $('.cover_all').show();
    $('#add_member').css("display","flex");
     
    $.ajax({

           url: 'action/show_add_member_form.php',
           type : 'POST',
           beforeSend : function()
           {
                 $('.add_member_form').html('<div class="lds-ripple"><div></div><div></div></div>');
           },
           success : function(data)
           {
              $('.add_member_form').html('');
              $('.add_member_form').html(data);
              ///// ajouter un mombre

                  $('.add_member_form').bind('submit',function(e){
                      e.preventDefault();
                      var nom = $('#nom_m').val();
                      var prenom = $('#prenom_m').val();
                      var email = $('#email_m').val();
                      var pass1 = $('#pass1_m').val();
                      var pass2 = $('#pass2_m').val();
                      var carte = $('#num_m').val();

                      $.ajax({
                          url :'action/add_memeber.php',
                          type :'POST',
                          dataType : 'JSON',
                          data :{nom:nom,prenom:prenom,email:email,pass1:pass1,pass2:pass2,carte:carte},
                          success:function(data){

                                 if(data.result == "success")
                                 {
                                   
                                        $('.add_member_form').unbind('submit');// remove the event
                                        hide_add_member_form();
                                        
                                        all_account();

                                        Swal.fire(
                                            'Ajouté !',
                                             'Membre ajouté avec succès',
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
  
 
});

});

// the count of registred agriculteurs the belogn to the same wilaya as the office 
function register_user_count()
{
    $.ajax({
        url:'action/register_users_count.php',
        type:'POST',
        success:function(data){
         $('.r_users').html(data);
              }
        })
    
}

/// show all the  agriculteur account that belong to the same wilaya as the office
function all_account()
{
    $.ajax({
        url:'action/all_account.php',
        type:'POST',
        success:function(data){
            $('.o_accounts').html(data);
            }
    })
}    
// show all registred offices only allowed if the office have a full acces 
function show_all_offices()
{
    $.ajax({

        url : 'action/show_all_offices.php',
        type : 'POST',
        success:function(data)
        {
             $('.o_accounts_offices').html(data);
        }
    })
}         

function show_add_admin_form()
{
    $('.cover_all').show();
    $('#add_office_admin').css("display","flex");
     
    
    $.ajax({
          
        url : 'action/show_add_office_admin.php',
        type : 'POST',
        data : {step : 'first'},
        beforeSend:function()
        {
            $('#add_office_admin_form').html('<div class="lds-ripple"><div></div><div></div></div>');
        },
        success:function(data)
        {
           
            $('#add_office_admin_form').html(data);
            
            $('.add_admin').bind('click',function(e)
            {
                  e.preventDefault();

                  var is_selected = $('#user_selected').val(); 
                 

                  if(is_selected != '' && is_selected!= null)
                   {
                        $.ajax({

                            
                            url : 'action/show_add_office_admin.php',
                            type : 'POST',
                            dataType : 'JSON',
                            data : {office_id : is_selected,step : 'end'},
                            
                            success:function(data)
                            {
                               
                                if(data.result == "fail")
                                {
                                    show_fail_msg(data.err);                                   
                                }
                                else
                                {
                                    hide_add_admin_form();

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
                         show_fail_msg("il faut choisir un office !");
                 }
            });
        }
    });
}

function hide_add_admin_form()
{

    $('.add_admin').unbind('click');
    $('#add_office_admin_form').html("");
    $('#add_office_admin').hide();
    $('.cover_all').hide();

     // remove error div if is exist
     if(document.querySelector('.s_updated').classList.contains('error_u'))
     { 
         $('.s_updated').removeClass('error_u');
         $('.s_updated').addClass('hidden');
     }
}
//// hide add_member_form
function hide_add_member_form()
{
    $('.add_member_form').unbind('submit');
    $('#add_member form').html('');
    $('#add_member').hide();
    $('.cover_all').hide();

    // remove error div if is exist
    if(document.querySelector('.s_updated').classList.contains('error_u'))
    { 
        $('.s_updated').removeClass('error_u');
        $('.s_updated').addClass('hidden');
    }
}
