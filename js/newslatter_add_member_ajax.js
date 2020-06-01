$(document).ready(function(){

    $('.share').on('submit',function(e){
       

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
                                Swal.fire(
                                  'Abonné !',
                                   data.result,
                                  'success'
                                );

                                $('#email').val('');
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
})