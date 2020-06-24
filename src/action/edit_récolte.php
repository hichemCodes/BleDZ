<?php

session_start();

require 'connect_db.php';
require 'query.php';

office_auth();

/* array variabels */
$variabls  = array ( $_POST['produit_code'],$_POST['poids_entré'],$_POST['poids_sortie'],
                     $_POST['quality'],$_POST['matricule_v'],$_POST['marque_v'],$_POST['n_p_chauf'],$_POST['n_permis']);

if(!in_array("",$variabls))
{

$produit_code = $_POST['produit_code'];
$poids_entré = filter_var($_POST['poids_entré'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
//$poids_entré = $_POST['poids_entré'];
$poids_sortie = filter_var($_POST['poids_sortie'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

$quality = $_POST['quality'];

/*   all the product */
$products = all_code_product();
/* all qualitys */
$qualitys = array('A','B','C');

/// car information
$matricule_v = filter_var($_POST['matricule_v'],FILTER_SANITIZE_NUMBER_INT);
$marque_v = filter_var($_POST['marque_v'],FILTER_SANITIZE_STRING);
$n_p_chauf = filter_var($_POST['n_p_chauf'],FILTER_SANITIZE_STRING);
$n_permis = filter_var($_POST['n_permis'],FILTER_SANITIZE_NUMBER_INT);
 
if(in_assoc_array('code',$produit_code,$products))
{
     
    if(filter_var($poids_entré,FILTER_VALIDATE_FLOAT) && preg_match('/^[0-9]*\.?[0-9]*$/',$_POST['poids_entré']))
    {
        if((filter_var($poids_sortie,FILTER_VALIDATE_FLOAT) && preg_match('/^[0-9]*\.?[0-9]*$/',$_POST['poids_sortie'] )) || (float)$poids_sortie == 0)   
        {
                if(in_array($quality,$qualitys) )
                {
                        $quantié = (float)$poids_entré - (float)$poids_sortie;

                        // si quantité inférieur a 0
                        if($quantié < 0 || $quantié == 0)
                        {
                            $data['result'] = "le poids de sortie doit être inférieur au poids d'entré";
                        }
                        else
                        {
                                     /// calculé le montant du récolte 
                        if($quality == 'A')
                        {
                            $produit_prix = find_product_by_code($produit_code)['prix_unitaire_A'];
                        }
                        else if ($quality == 'B')
                        {
                            $produit_prix = find_product_by_code($produit_code)['prix_unitaire_B'];
                        }
                        else
                        {
                            $produit_prix = find_product_by_code($produit_code)['prix_unitaire_C'];
                        }
                        
                        $montant = (float)$produit_prix * (float)$quantié;
                        
                      
                              if(preg_match('/^[0-9]{10,10}$/',$matricule_v))
                              {
                                    if(preg_match('/^[0-9]{6,6}$/',$n_permis))
                                    {
                                               ////////  edit harvest
                                            try
                                            {
                                               
                                                $edit_recolte = $db->prepare("UPDATE récoltes SET produit_code = ?,poids_entré = ?,poids_sortie = ?,Quantité = ?,
                                                                         Qualité = ?,montant = ? WHERE id = ? ");
                                                                       
                                                $edit_recolte->execute([$produit_code,$poids_entré,$poids_sortie,$quantié,$quality,$montant,$_POST['recolte_id']]);

                                                // edit car
                                                $edit_car = $db->prepare("UPDATE  véhicule SET matricule = ?,marque = ?,
                                                                          nom_de_chauffeur = ?,num_de_permis = ? WHERE récolte_id = ? ");
                                                $edit_car->execute([$matricule_v,$marque_v,$n_p_chauf,$n_permis,$_POST['recolte_id']]);

                                                $data['result'] = "success";
                                                
                                            }
                                            catch(PDOExeption $e)
                                            {
                                                $output = $e->getMessage();
                                            }
                                           
                                          
                                    
                                    }
                                    else
                                    {
                                             $data['result'] = "le numéro de permis du véhicule doit contenir 6 chiffres ";   
                                    }
                              }
                              else
                              {
                                   $data['result'] = "la matricule de véhicule est incorrect";
                              }
                        }
                       
                              
                                         
                }
                else
                {
                        $data['result'] = "la qualité doit être parmi les qualités proposées";
                }
        }  
        else
        {
            $data['result'] = "le poids de sortie est incorrect";   
        }
    }
    else
    {
        $data['result'] = "le poids d'entré est incorrect";
    }

}
else{
    $data['result'] = "le produit que vous avez choisi ne fait pas partie de nous produits ";
}
}
else{
    $data['result'] = "tous les champs doivent être remplis";

}


echo json_encode($data);


?>


                                       