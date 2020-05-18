<?php

  require 'query.php';
  require 'send_reset_password_email.php';


  $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

  if(filter_var($email,FILTER_VALIDATE_EMAIL))
  {
         if(email_exist($email))
         {
               // generate a random 
               $random_code = bin2hex(random_bytes(4));
              

               /// insert the generated code in the password_reset table 

                    /// check if the user have already a reset password code inserted to update if not we insert a new code
                    if(user_have_already_rest_code($email))
                    {
                         $reset_code = $db->prepare("UPDATE password_reset SET code = ?,created_at =  NOW()");
                         $reset_code->execute([$random_code]);
                    }
                    else
                    {  
                         $reset_code = $db->prepare(" INSERT INTO password_reset (user_email,code) VALUES(?,?)");
                         $reset_code->execute([$email,$random_code]);
                    }

                    
                    /// send email to user 
                    
                    $data['err'] = 'success';
                    
                    $user_id = find_user_id_by_email($email);
                    send_rest_password_code($user_id,$random_code);

                    
                    


         }
         else
         {
               $data['err'] = 'email n\'existe pas';
         }

  }
  else
  {
       $data['err'] = 'email incorrécte';
  }

  echo json_encode($data);


?>