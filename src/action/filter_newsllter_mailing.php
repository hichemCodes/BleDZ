<?php

    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoloader
    require '../../vendor/autoload.php';


     

    function send_newslatter($office,$object,$msg,$dest)
    {

       /* $all_user_information = find_user_information($user_receiver_id);
        $user_email = $all_user_information['email'];*/
        

        $office_nom = $_SESSION['nom'];
        $office_email = $_SESSION['email'];
        $office_wilaya = getWilaya($_SESSION['wilaya_id']);
        $office_nom_wilaya = 'office du ble : '.$office_nom.' '.$office_wilaya;
 
    

        // Instantiation 
        $mail = new PHPMailer(true);

        try {
            //Server settings
        
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'bledz.offices@gmail.com';                     // SMTP username
            $mail->Password   = '123456dz';                               // SMTP password
            $mail->SMTPSecure = "ssl"; // tls //PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;//587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            


            $mail->setFrom($office_email,$office_nom_wilaya);  // sender 
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $object;
            $mail->Body    = $msg;
            $mail->AltBody = strip_tags($msg);

            /*  find_all_users */
             
            if($dest == 'all_belongs')
            {
                   $all_users = all_members($_SESSION['wilaya_id']);

            }
            else
            {
                   $all_users = all_in_newslatter();
            }
            
            /*  loop for all  users  */

            foreach($all_users as $user)
            {
                $mail->addAddress($user['email'],$user['nom'] = '/');     // Add a recipient
            }
           
            $mail->send();
            /// if send with successfuly
            return true;
        
        } 
        catch (Exception $e)
        {
            
            $err = $mail->ErrorInfo;

            return $err;
        }
                
            }


?>