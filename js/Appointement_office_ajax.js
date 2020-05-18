$(document).ready(function()
{
    /// afficher formulaire d'ajout du rendez-vous et ajouter un rendez-vous
       
    $('.add_rendez_vous').on('click',function(){

             
        $('.cover_all').show();
        $('.add_r_f').css("display","flex");
        
        $.ajax({
            url : 'action/show_add_rendez_vous_form.php',
            type : 'POST',
            beforeSend : function()
            {
                $('.add_r_v_f').html('<div class="lds-ripple"><div></div><div></div></div>');
            },
            success : function(data)
            {
                // show form
                $('.add_r_v_f').html("");
                $('.add_r_v_f').html(data);
                
                
                update_calander();
                
                $('.add_r_v_f').bind('submit',function(e){

                    e.preventDefault();
                    
                    var date = $('#calandar').val();
                    var heur  = $('#heur').val();
                    var c_date = date+' '+heur;
                    console.log(c_date);
                    // add
                    $.ajax({
                            url : 'action/add_rendez_vous.php',
                            type : 'POST',
                            dataType : 'JSON',
                            data : {date:c_date},
                            success:function(data){

                               if(data.result == 'success')
                                {
                                    show_success_msg("Rendez-vous ajouté avec succès");

                                    hide_add_rendez_form_form();
                                    rendez_vous_non_prise();
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

/// show all not taken rendez-vous
function rendez_vous_prise(){
    $.ajax({
         'url':'action/rendez_vous_prise.php',
         type:'POST',
         success:function(data)
         {
             $('.r_output').html(data);
         }
    });
}
/// show all not taken rendez-vous
function rendez_vous_non_prise(){
    $.ajax({
         'url':'action/rendez_vous_list_office.php',
         type:'POST',
         success:function(data)
         {
             $('.r_output2').html(data);
         }
    });
}
//// delete a rendez-vous
function destroy_r_v(id)
{
   

    if(confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?'))
    {
        $.ajax({
            'url' : 'action/delete_rendez_vous.php',
            type : 'POST',
            data : {id:id},
            success:function (data)
            {
                  
                    show_success_msg(data);

                   rendez_vous_non_prise();
            }
       })
    }
   
   
}
// annuler rendez_vous
function cancel_rendez_vous(r_v_id,agr_id)
{
    if(confirm('es-ce que vous êtes sûr de annuler ce rendez-vous'))
    {

        $.ajax({
        
         url : 'action/cancel_a_taken_rendez_vous.php',
         type : 'POST',
         datatype : 'json',
         data : {
                    r_v_id : r_v_id,
                    agr_id : agr_id
                },
        beforeSend : function()
        {
            $('.output').append("<div class='succes_valid s_updated' > annulation en cours ...</div>");

        },
        success : function(data)
        {
            $('.s_updated').html(data);
            setTimeout(function () { $('.s_updated').hide(); }, 8000);
            
            rendez_vous_non_prise();
            rendez_vous_prise()

        }        

    });
    }
}
// the number of taken rendez-vous
function rendez_vous_pris_count()
  {
       $.ajax({
            'url':'action/rendez_vous_pris_count.php',
            'type':'POST',
            success:function(data)
            {
                 $('.r_v_pris').html(data);
                 
            }
       })
  }

///  update the calander of rendez-vous

function update_calander()
{
        var calandar = document.querySelector("#calandar");
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth()+1;
        var day = date.getDate();

        if(day<10){
            day='0'+day;
        } 
        if(month<10){
            month='0'+month;
        } 
        var today = year+'-'+month+'-'+day;
        calandar.setAttribute('min',today);
        calandar.setAttribute('value',today);
}
 // hide add rendez-vous form 
 function hide_add_rendez_form_form()
 {
      $('.add_r_v_f').unbind('submit');
      $('.add_r_v_f').html('');
      $('.add_r_f').hide();
      $('.cover_all').hide();

    // remove error div if is exist
    if(document.querySelector('.s_updated').classList.contains('error_u'))
    { 
        $('.s_updated').removeClass('error_u');
        $('.s_updated').addClass('hidden');
    }
 }
 