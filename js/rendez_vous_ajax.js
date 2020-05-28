$(document).ready(function()
{
          all_offices();
          my_rendez_vous();

});
function all_offices()
{
     $.ajax({
              'url':'action/all_offices_proche.php',
              'type':'POST',
               beforeSend : function()
              {
                 
                   $('.offices').html('<div class="lds-ripple"><div></div><div></div></div>');  
              },
              success:function(data)
              {
                   $('.offices').html(data);
              }
               
     });
}
function my_rendez_vous()
{
     $.ajax({
              'url':'action/mon_rendez_vous.php',
              'type':'POST',
              beforeSend : function()
              {
                   $('.my_r_v_container').html('<div class="lds-ripple"><div></div><div></div></div>');  
              },
              success:function(data)
              {
                   $('.my_r_v_container').html(data);
              }
               
     });
}
function rendez_vous(id)
     {
          $('.cover_all2').css("display","flex");
          
          $.ajax({
                'url':'action/rendez_vous_list.php',
                'type':'POST',
                 'data':{id:id},
                 beforeSend : function()
              {
                 
                   $('.tab_wraper').html('<div class="lds-ripple"><div></div><div></div></div>');  
              },
                 success:function(data){
                  
                      
                      $('.tab_wraper').html(data);

                 }
          });
     };
     function prend_r_v(id,office_nom,date)
      {
          $.ajax({
                 url :'action/prendre_rendez_vous.php',
                 type : 'POST',
                 data : {id:id},
                 success:function(data){

                         $('.cover_all2').hide();
                    
                         // refresh the function
                         all_offices();
                         my_rendez_vous();

                         $('body').append(data);

                         generate_pdf_conv(id);

                         setTimeout(function () { $('.succes_valid').hide(); }, 3000);
                     
                 }
          });
      }
      function annuler_rendez_vous(id)
      {
          if(confirm('Est-ce que vous êtes sûr d\'annuler votre rendez-vous'))
          {
               $.ajax({
                     url : 'action/annuler_rendez_vous.php',
                     type : 'POST',
                     data : {id:id},
                    success:function(data)
                    {
                         all_offices();
                         my_rendez_vous();
                         $('body').append(data);
                         setTimeout(function () { $('.succes_valid').hide(); }, 3000);
                    }
              });
          }
           
      }  
      function generate_pdf_conv(rendez_vous_id)
      {
           $.ajax({

                    url : 'action/generate_conv.php',
                    type : 'POST',
                    dataType : 'JSON',
                    data : { rendez_vous_id : rendez_vous_id},
                    success : function(data)
                    {
                         console.log(data);
                         downloads_pdf_conv(data);
                    }
           })
      }
      function downloads_pdf_conv(data)
      {
                       var doc = new jsPDF();

     
                    doc.setFontStyle("bold");
                    doc.setFontSize('20');
                    doc.text('Convocation du dépôt de la récolte',103.5,50,null,null,"center");
                    doc.setFontSize('13');
                    doc.setFontStyle("normal");
                    
                         
                    doc.text(`Nom d'agriculteur : `, 15,76,null,null);
                    doc.text(`prenom : `, 15,84,null,null);
                    doc.text(`Numéro de carte : `, 15,92,null,null);
                    doc.text(`Email : `, 15,100,null,null);


                    doc.text(`Nom d'office : `, 119,76,null,null);
                    doc.text(`Wilaya : `, 119,84,null,null);
                    doc.text(`Numéro de téléphone : `, 119,92,null,null);


                    doc.setFontStyle("bold");
                    doc.text(`${data.nom_agr}`, 54.5,76,null,null);
                    doc.text(`${data.prenom_agr}`, 34.5,84,null,null);
                    doc.text(`${data.carte}`, 52.8,92,null,null);
                    doc.text(`${data.email_agr} `, 30.5,100,null,null);


                    doc.text(`${data.office_nom} `, 148.2,76,null,null);
                    doc.text(`${data.wilaya} `, 136.5,84,null,null);
                    doc.text(`${data.phone}`,167.5,92,null,null);




                     
                     doc.setFontStyle("normal");
                     doc.text(`Votre rendez-vous pour le dépôt de la récolte aura lieu le  ${data.date} .`, 15,135,null,null);
                     doc.text(`Veuillez apporter au rendez-vous la présente convocation, votre pièce d’identité et votre  `, 15,145,null,null);
                     doc.text(`récolte.`, 15,151,null,null);
                     doc.text(`Merci de vous présenter 30 minutes avant l’heure prévue de votre rendez-vous .`, 15,162,null,null);           
                     
                     doc.save('Rendez-vous dépôt du la récolte.pdf');
      }


      function hide_rendez_vous_form()
      {   
               $('.tab_wraper').html('');
               $('.cover_all2').hide();
      }