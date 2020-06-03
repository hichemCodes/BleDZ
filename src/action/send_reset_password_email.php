<?php
   
     
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../../vendor/autoload.php';
   
    
  // validate_email_function
    
  function send_rest_password_code($user_receiver_id,$code)
  {
    

    $all_user_information = find_user_information($user_receiver_id);
    $user_email = $all_user_information['email'];
    

    $office_nom = 'Administration du site web BléDz';
   
    
    

    if($all_user_information['profile_id'] == 1)
    {
        $user_name = find_office_name($user_receiver_id);
    }
    else
    {
        $user_name = find_agr_information($user_receiver_id)['nom'].' '.find_agr_information($user_receiver_id)['prenom'];
    }
    

   $body = '<p> Bonjour <strong> '. $user_name . '</strong> Votre code de réinitialisation du mot de passe est '.$code.'</p>';
 
    


////// envoyer un email a l'utilisateur pour le notifier que leurs comtpte est valider

// Instantiation 
$mail = new PHPMailer(true);

try {
    //Server settings
   
    iconv_set_encoding("internal_encoding", "UTF-8");

    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'bledz.offices@gmail.com';                     // SMTP username
    $mail->Password   = '123456dz';                               // SMTP password
    $mail->SMTPSecure = "ssl"; // tls //PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;//587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
    //Recipients
    $mail->setFrom('bledz.offices@gmail.com',utf8_decode($office_nom));  // sender   //changed later to office administrator email
    $mail->addAddress($user_email,$user_name);     // Add a recipient
      

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'code de changement du mot de passe';
    $mail->Body    = $body;
    $mail->AltBody = strip_tags($body);

    $mail->send();
    return true;
   
} catch (Exception $e) {
    
   
    return false;
}

}
      


?>

