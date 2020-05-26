



<?php

require 'connect_db.php';
require 'validate_fields.php';


session_start();
 
     $email = $_POST['email'];
     
     $pass = $_POST['pass'];

     /// test in the password is match

     $check_pass = $db->prepare("SELECT * FROM users WHERE id = ?");
     $check_pass->execute([$_SESSION['id']]);

     

     $v_email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

     if(validate_email($v_email))
     {
        $check_pass_result = $check_pass->fetch(PDO::FETCH_ASSOC);
        if(password_verify($pass,$check_pass_result['mot_de_passe']))
        {
   
          
           $update = $db->prepare("UPDATE users SET email = ?  WHERE id = ? ");
           $update->execute([$v_email,$_SESSION['id']]);

           $_SESSION['email'] = $v_email;
      
         
           $data['result'] = 'vos informations sont modifié';
       
        }
        else
        {
           $data['result'] = 'fail';
           $data['err'] = 'le mot de passe est incorrect';
        }
     }
     else
     {
        $data['result'] = 'fail';
        $data['err'] = 'l\'email est incorrect';
     }
     
     echo json_encode($data);


     




?>

