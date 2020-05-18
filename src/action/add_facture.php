
<?php

require 'connect_db.php';
require 'query.php';

session_start();
$montant = 0;
 // table contains all recolte
$all_recolte_tab= $_POST['all_recolte'];

//serialaze the array 
$serialized_array = serialize($all_recolte_tab);


/// calculate the global price of all recoltes

foreach ($all_recolte_tab as $recolte)
{

        $recolte_montant = montant_recolte($recolte);

        $montant = (float)$montant +  (float)$recolte_montant;

}

        // ajouter une facture
        try
        {

                $add_facture = $db->prepare("INSERT INTO factures (montant,recoltes_id,office_id,agriculteur_id) VALUES (?,?,?,?) ");
                $add_facture->execute([$montant,$serialized_array,$_SESSION['office_id'],$_POST['agriculteur_id']]);

                echo "<div class='succes_valid s_updated'>facture ajoutée avec succès !</div>";

        }
        catch (Exception $e)
        {
                echo '<div class="succes_valid s_updated error_u"> il ya une erreur  </div> ';
        }


?>
                     
