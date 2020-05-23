<?php
   
     session_start();
    
   
    require 'connect_db.php';
    require 'query.php';
    require 'send_validate_email.php';
    
    

    $user_id = $_POST['id'];

    if(have_full_acces($_SESSION['office_id']))  //tetser si ce office a une accés pour valider les comtptes offices 
    {
        
        $valid = $db->prepare("UPDATE users SET is_verified = 1 WHERE id = ?");
        $valid->execute([$user_id]);

        send_email_validation($user_id);  // envoyer un mail a l'utilisateur pour indiquer que son compte a était validé

        $data['result'] = 'ce compte est valider et un email a était envoyé a l\'utilisateur';
    }
    else
    {
        // tester si l'utilisateur appartient a la méme wilaya que l'office 
        if(is_member($user_id,$_SESSION['wilaya_id']))
        {
            $valid = $db->prepare("UPDATE users SET is_verified = 1 WHERE id = ? AND wilaya_id = ?");
            $valid->execute([$user_id,$_SESSION['wilaya_id']]);
            
            send_email_validation($user_id); // envoyer un mail a l'utilisateur pour indiquer que son compte a était validé

            $data['result'] = 'ce compte est validé et un email a été envoyé à l\'utilisateur';
            
        }
        else
        {
            $data['result'] = 'fail';
            $data['err'] = " vous n'avez le droit de valider ce compte";
        }
        

    }

    function send_email_validation($id)
    {
        if(validate_email($id))
        {
           
            $data['result'] = "compte validé et l'émail de validation envoyé avec succés";
        }
        else
        { 
            $data['result'] = 'fail';
            $data['err'] =  "il ya une erreur sur votre connexion";
        }
    }

    echo json_encode($data);
    
    
   
      
?>