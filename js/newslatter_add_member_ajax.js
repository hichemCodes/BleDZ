

if( document.querySelector('.subscribe') != null)
{
      document.querySelector('.subscribe').addEventListener('click',(event) =>{
       
            subscribe(event);
      });
}
else
{
      document.querySelector('.un_subscribe').addEventListener('click',(event) =>{
       
            un_subscribe(event);
      });
}





function subscribe(event){
       

      event.preventDefault();

      var email = $('#email').val();

      $.ajax({
             url  : 'action/newslatter_add.php',
             type  : 'POST',
             dataType : 'JSON',
             data : {email:email},
            success:function(data)
            {
              if(data.result != 'fail')
              {

                  $('.cnx_btn').html('Abonné');
                  $('.cnx_btn').removeClass('subscribe');
                  $('.cnx_btn').addClass('un_subscribe');
                  
                  Swal.fire(
                      'Abonné !',
                       data.result,
                      'success'
                  );

                  $('.cnx_btn').replaceWith('<input type="submit" class="cnx_btn m un_subscribe" value="Abonné" title="désabonner" onclick="un_subscribe(event)">');

                  
              }
              else
              {
                    Swal.fire(
                      'Erreur !',
                       data.err,
                      'error'
                    );
              }
             
            }
            
      });

};

function un_subscribe(event){


event.preventDefault();
var email = $('#email').val();

Swal.fire({
title: 'Êtes-vous sûr ?',
icon: 'warning',
showCancelButton: true,
cancelButtonColor: 'tomato',
cancelButtonText : 'Annuler',
confirmButtonText: 'Oui, désabonner !'
}).then((result) => {
if (result.value) {

    $.ajax({
      url  : 'action/newslatter_un_subscribe.php',
      type  : 'POST',
      dataType : 'JSON',
      data : {email:email},
      success:function(data)
      {
          if(data.result != 'fail')
          {
                Swal.fire(
                  'Désabonné !',
                  data.result,
                  'success'
                );

                $('.cnx_btn').replaceWith('<input type="submit" value="Abonner" title = "abonner" class="cnx_btn m subscribe" onclick="subscribe(event)"></input>');

          }
          else
          {
                Swal.fire(
                  'Erreur !',
                  data.err,
                  'error'
                );
          }
      
      }
      
});
}
}); 



};