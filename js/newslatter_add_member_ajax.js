$(document).ready(function(){

    $('.subscribe').on('click',function(e){
       

                  e.preventDefault();

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

    });

    $('.un_subscribe').on('click',function(e){
       

        e.preventDefault();
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
                  //dataType : 'JSON',
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
                      }
                      else
                      {
                            Swal.fire(
                              'Erreur !',
                              data.err,
                              'error'
                            );
                      }
                      console.log(data);

                      $('.cnx_btn').html('Abonner');
                      $('.cnx_btn').removeClass('un_subscribe');
                      $('.cnx_btn').addClass('subscribe');
                  
                  }
                  
            });
      }
      }); 

        

      });
})