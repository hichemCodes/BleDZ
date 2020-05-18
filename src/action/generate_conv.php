
<?php

session_start();

require 'connect_db.php';
require 'query.php';

//agr_auth();


$rendez_vous = $db->prepare("SELECT * FROM rendez_vous
                         INNER JOIN agriculteurs ON rendez_vous.agriculteur_id = agriculteurs.id
                         INNER JOIN offices ON rendez_vous.office_id = offices.id 
                         AND rendez_vous.id = ? ");


$rendez_vous->execute([$_POST['rendez_vous_id']]);

$rendez_vous_result = $rendez_vous->fetch(PDO::FETCH_ASSOC);

    $data['date'] = date('d/m/Y',strtotime($rendez_vous_result['date']));
    $data['nom_agr'] = $rendez_vous_result['nom'];
    $data['prenom_agr'] = $rendez_vous_result['prenom'];
    $data['email_agr'] =  $_SESSION['email'];
    $data['wilaya'] =  getWilaya($_SESSION['wilaya_id']);
    $data['office_nom'] = find_office_name($rendez_vous_result['office_id']);
    $data['carte'] = $_SESSION['carte'];
    $data['phone'] = ($rendez_vous_result['num_telephone'] != NULL ) ?  $rendez_vous_result['num_telephone'] :  '/';
    
    


    echo json_encode($data);






?>
                     
