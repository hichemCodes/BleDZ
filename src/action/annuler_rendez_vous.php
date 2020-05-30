<?php


require 'connect_db.php';

session_start();


    $update_r = $db->prepare("UPDATE rendez_vous SET is_taken = 0 , agriculteur_id = NULL WHERE  id = ? AND agriculteur_id = ?");

    $update_r->execute([$_POST['id'],$_SESSION['agr_id']]);
    
    $data['result'] =  "Rendez-vous annulé avec succès";

    echo json_encode($data);







?>


                                       