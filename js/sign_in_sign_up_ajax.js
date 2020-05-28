
$(document).ready(function()
{


 // insert agriculteur   
$('.f-agr').on('click',function(e)
{
    e.preventDefault();
    
  
        // remove all the error msg and reset the default style style 
        clear_form('custum_err','redirect_a');
    
 


    $.ajax({
         url : 'action/sign_up_ajax.php',
         method : 'POST',
         dataType : 'JSON',
         data : {

                    nom : $("input[name=nom]").val(),
                    prenom : $("input[name=prenom]").val(),
                    email : $("input[name=email]").val(),
                    pass1 : $("input[name=pass1]").val(),
                    pass2 : $("input[name=pass2]").val(),
                    n_cart : $("input[name=n_cart]").val(),
                    wilaya : $("#wilaya_a").val(),
                    type : 'agriculteur'

                },
         beforeSend : function()
                {
                    $('.f-agr').addClass('button--loading');
                },    
         success : function(data)
            {
                if(data.result == 'success')
                    {
                        
                        $('.redirect_a').addClass('success');
                        redirect('success');

                        localStorage.clear();
                    }
                    else
                    {
                        if(data.fail == 'redirect_a')
                        {
                             $('.redirect_a').html(data.result);
                        }
                        else
                        {
                            
                        
                            document.querySelector('.'+data.fail).children[0].classList.add('c_error');
                            document.querySelector('.'+data.fail).children[1].classList.add('error');
    
                            //create div error 
                            let error = document.createElement('div');
                            //set the classe of the element 
                            error.className = 'err custum_err';
                            // set the text to the current error 
                            error.innerText = data.result;
                            //  insert that div after the element
                            document.querySelector('.'+data.fail).parentNode.insertBefore
                            (error,document.querySelector('.'+data.fail).nextSibling);
                        }

                        $('.f-agr').removeClass('button--loading');
                       



                    }
                    
            }
    })
     
});


 // insert office   
 $('.f-office').on('click',function(e)
 {
     e.preventDefault();
     
   
         // remove all the error msg and reset the default style style 
         clear_form('custum_err2','redirect_b');
     
     $.ajax({
          url : 'action/sign_up_ajax.php',
          method : 'POST',
          dataType : 'JSON',
          data : {
 
                     nom : $("input[name=nom_o]").val(),
                     email : $("input[name=email_o]").val(),
                     pass1 : $("input[name=pass1_o]").val(),
                     pass2 : $("input[name=pass2_o]").val(),
                     n_cart : $("input[name=n_cart_o]").val(),
                     wilaya : $("#wilaya_b").val(),
                     type : 'office'
 
                 },
          beforeSend : function()
                 {
                     $('.f-office').addClass('button--loading');
                 },    
          success : function(data)
             {
                 if(data.result == 'success')
                     {
                         
                         $('.redirect_b').addClass('success2');
                         redirect('success2');
                         localStorage.clear();
                     }
                     else
                     {
                         if(data.fail == 'redirect_b')
                         {
                              $('.redirect_b').html(data.result);
                         }
                         else
                         {
                             
                         
                             document.querySelector('.'+data.fail).children[0].classList.add('c_error');
                             document.querySelector('.'+data.fail).children[1].classList.add('error');
     
                             //create div error 
                             let error = document.createElement('div');
                             //set the classe of the element 
                             error.className = 'err custum_err2';
                             // set the text to the current error 
                             error.innerText = data.result;
                             //  insert that div after the element
                             document.querySelector('.'+data.fail).parentNode.insertBefore
                             (error,document.querySelector('.'+data.fail).nextSibling);
                         }
 
                         $('.f-office').removeClass('button--loading');
                        
 
 
 
                     }
                     
             }
     })
      
 });

 //sign in 
 $('.conx-form').on('submit',function(e)
 {
      e.preventDefault();

       // remove all the error msg and reset the default style style 
       clear_form('custum_err','redirect_a');
     
       $.ajax({
            url : 'action/sign_in_ajax.php',
            method : 'POST',
            dataType : 'JSON',
            data : {
   
                       email : $("input[name=email_c]").val(),
                       pass : $("input[name=pass_c]").val(),
                   },
            beforeSend : function()
                   {
                       $('.cnx-btn').addClass('button--loading');
                   },    
            success : function(data)
               {
                       if(data.result == 'success')
                       {
                           
                               document.location.href = data.home;

                               localStorage.clear();

                        
                       }
                       else
                       {
                           if(data.fail == 'redirect_a')
                           {
                                $('.redirect_a').html(data.result);
                           }
                           else if(data.fail == 'in_valid')
                           {
                                $('.in_valid').html(data.result);
                           }
                           else
                           {
                               
                           
                               document.querySelector('.'+data.fail).children[0].classList.add('c_error');
                               document.querySelector('.'+data.fail).children[1].classList.add('error');
       
                               //create div error 
                               let error = document.createElement('div');
                               //set the classe of the element 
                               error.className = 'err custum_err';
                               // set the text to the current error 
                               error.innerText = data.result;
                               //  insert that div after the element
                               document.querySelector('.'+data.fail).parentNode.insertBefore
                               (error,document.querySelector('.'+data.fail).nextSibling);
                           }
   
                           $('.cnx-btn').removeClass('button--loading');
                          
   
   
   
                       }
                       
               }
       })
      
 })

    //clear local storage when click to the creat account link

    $('.creat_account_link').on('click',function()
    {
        localStorage.clear();
    })



});

function redirect(element)
{
    
    var counter = 5;
    var redirectCount = setInterval(function(){
                                                                                                                                                
    document.querySelector('.'+element).innerText= "votre compte est créé avec succés réorientation vers la page de connexion dans  "+counter+"s"; 
    counter--;
    if (counter === 0) {
                clearInterval(redirectCount);
                    document.location.href = 'http://localhost/pfe/src/sign_in.php';
                                                                    }
    }, 1000);   


}

function clear_form(element1,element2)
{
     let all_errors =  document.querySelectorAll('.'+element1);

     let all_items = document.querySelectorAll('.item');

     //remove all errors

     all_errors.forEach( element => {
          
          

           // if the element is the last error we don't delete it the first time 

           if(element.classList.contains(element2))
           {
               if(element.innerHTML != '')
               {
                    element.innerText = '';
               }
           }
           else
           {
                   element.remove();
           }

     });

     // remove the error style from input and icons

     all_items.forEach ( element =>{

         if(element.children[0].classList.contains('c_error'))
         {
            element.children[0].classList.remove('c_error')
         }

         if(element.children[1].classList.contains('error'))
         {
            element.children[1].classList.remove('error')
         }

     })
}
