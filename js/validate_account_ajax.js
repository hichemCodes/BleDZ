$(document).ready(function()
{

});
 /// show all the invalid agriculteur account
function in_valid_accounts_count()
    {
        $.ajax({
            url:'action/in_valid_accounts_count.php',
            type:'POST',
            success:function(data){
                $('.invalid').html(data);
            }
        })
    }

    
    /// show the count of all  invalid agriculteur account
    function all_invalid_accounts()
    {
        $.ajax({
            url:'action/in_valid_accounts.php',
            type:'POST',
            success:function(data){
                $('.o_accounts_invalid').html(data);
              
            }
        })
    }
 /// show all the invalid offices only allowed if the office have a full acces 
    function show_invalid_offices()
                {
                    $.ajax({
                        'url' : 'action/show_invalid_offices.php',
                        'type' : 'POST',
                        success:function(data)
                        {
                            $('.o_accounts_invalid_office').html(data);
                            
                        }
                    })
                }
  
/// valid user account           
function valid_account(id,element){
      
          
        $.ajax({
        url:'action/valid_account.php',
        method:'POST',
        dataType : 'JSON',
        data: { id:id },
        beforeSend : function()
        {
            show_success_msg('validation en cours ...',true)
        },
        success: function(data) {
            
           
            if(data.result == 'fail')
            {
                show_fail_msg(data.err);
            }
            else
            {                             
                show_success_msg(data.result);

                all_invalid_accounts();
                show_invalid_offices();
            }
            
            console.log(data);
            console.log(data.err);

            
         },
            
        
        });
    } 