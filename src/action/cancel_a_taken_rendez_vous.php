
<?php

session_start();

require 'connect_db.php';
require 'query.php';
require 'send_cancel_rendez_vous_email.php';

/// modifie le rendez_vous 

$annuler_rendez_vous  =  $db->prepare("UPDATE rendez_vous SET agriculteur_id = NULL, is_taken = 0 
                            WHERE id = ?  AND agriculteur_id = ?");
$annuler_rendez_vous->execute ([$_POST['r_v_id'],$_POST['agr_id']]);


///// send a email to the user

$date_r_v = date('d/m/Y',strtotime(find_rendez_vous_information($_POST['r_v_id'])['date']));  // date of rendez_vous
$user_id = find_agr_user_id($_POST['agr_id']);   // user id

send_cancel_rendez_vous_email($user_id,$date_r_v);

///

echo "<div class='succes_valid s_updated' > ce rendez-vous est annulé un email a était envoyé a l'utilisateur</div>";

  
?>
 