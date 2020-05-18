<?php


require 'connect_db.php';

session_start();


    $update_r = $db->prepare("UPDATE rendez_vous SET is_taken = 0 , agriculteur_id = NULL WHERE  id = ? AND agriculteur_id = ?");

    $update_r->execute([$_POST['id'],$_SESSION['agr_id']]);
    
    echo "<div class='succes_valid '> Rendez-vous annulé  </div>";







?>


                                       