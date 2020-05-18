
<?php

session_start();
require 'connect_db.php';
require 'query.php';

office_auth();

////  afficher tous les factures a partient a l'office

$facture = $db->prepare("SELECT * FROM factures
                         INNER JOIN agriculteurs ON factures.agriculteur_id = agriculteurs.id
                         AND factures.id = ? ");


$facture->execute([$_POST['id']]);

$facture_result = $facture->fetch(PDO::FETCH_ASSOC);

    $data['date'] = date('d/m/Y',strtotime($facture_result['date']));
    $data['recoltes_id'] = $facture_result['recoltes_id'];
    $data['nom_agr'] = $facture_result['nom'];
    $data['prenom_agr'] = $facture_result['prenom'];
    $data['email_agr'] =  find_agr_information($facture_result['user_id'])['email'];
    $data['wilaya'] =  getWilaya($_SESSION['wilaya_id']);
    $data['office_nom'] = find_office_name($facture_result['office_id']);
    $data['montant_total'] = $facture_result['montant'];
    $data['carte'] = $facture_result['num_de_carte'];
    $data['phone'] = ($_SESSION['phone'] != '' ) ?  $_SESSION['phone'] :  '/';
    
    /// information de chaque récolte 
    $array_recolte = unserialize($data['recoltes_id']);
    $array_item = array();


    foreach($array_recolte as $recolte)
    {
            $this_recolte = recolte_information($recolte);

            $product_name = find_product_by_code($this_recolte['produit_code'])['description'];
           
            $this_item = $product_name.','.date('d/m/Y',strtotime($this_recolte['date'])).','.$this_recolte['Quantité'].','.$this_recolte['Qualité'].','.$this_recolte['montant'];

            array_push($array_item,$this_item);
    
    }
    // add all anformation to data array to pass then in json format

    $data['array_recolte'] = $array_item;
    
    echo json_encode($data);
  






?>
                     
