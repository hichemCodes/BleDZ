
<?php

require 'connect_db.php';
session_start();
 
     $email = $_POST['email'];
     $mob = $_POST['mob'];
     $pass = $_POST['pass'];

     /// test in the password is match

     $check_pass = $db->prepare("SELECT * FROM users WHERE id = ?");
     $check_pass->execute([$_SESSION['id']]);

     $check_pass_result = $check_pass->fetch(PDO::FETCH_ASSOC);

     if(password_verify($pass,$check_pass_result['mot_de_passe']))
     {
        $update = $db->prepare("UPDATE users SET email = ?  WHERE id = ? ");
        $update->execute([$email,$_SESSION['id']]);
   
        $update_2 =  $db->prepare("UPDATE offices  SET num_telephone = ?  WHERE user_id = ? ");
        $update_2->execute([$mob,$_SESSION['id']]);

        echo "vos informations sont modifiées";
    
     }
     else
     {
        echo "le mot de passe est incorrect";     
     }


     


     




?>

