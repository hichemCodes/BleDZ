<?php

session_start();
require 'query.php';

office_auth();  // check if the office is connected

if(have_full_acces($_SESSION['office_id']))
{
    $all_harvest_wilaya = $db->prepare(" SELECT COUNT(récoltes.id) as cpt ,SUM(quantité) as s_quan,
                                         SUM(récoltes.poids_entré) as p_entrer,SUM(poids_sortie) as p_sortie,
                                         wilayas.id as wilaya_id ,wilayas.nom as wilaya_nom 
                                         ,SUM(récoltes.montant) as s_montant FROM récoltes
                                         INNER JOIN offices ON récoltes.office_id = offices.id
                                         INNER JOIN users ON offices.user_id = users.id
                                         INNER JOIN wilayas ON users.wilaya_id = wilayas.id
                                         AND YEAR(récoltes.date) = ? AND wilayas.id = ?
                                         LIMIT 1
                                       ");

     $all_harvest_wilaya->execute([$_POST['year'],$_POST['wilaya_id']]);


   
    if($all_harvest_wilaya->rowCount() > 0)
    {

        $harvest_result = $all_harvest_wilaya->fetch(PDO::FETCH_ASSOC);

        // frequent product
        $frquent_product = top_product_in_year($_POST['year'],$_POST['wilaya_id'],'wilayas');
        // frequent quality
        $frquent_quality = top_quality_in_year($_POST['year'],$_POST['wilaya_id'],'wilayas');
        //best office
        $best_office = best_office_in_wilaya($_POST['wilaya_id'],$_POST['year']);
        //best agriculteur
        $best_agr = best_agr_in_wilaya($_POST['wilaya_id'],$_POST['year']);  


        $data['result'] =   '
              
        <i class="fas fa-times" onclick="exit_from_recolte_detail()"></i>
          <div class="p_header flex j_center a_center">
         
                <i class="fas fa-user"></i> 
                <span> 
                        wilaya '. getWilaya($_POST['wilaya_id']).' récoltes anneé '. $_POST['year'] .'
                </span>

          </div>
          <div class="p_body flex j_evenly a_center">

             <div class="information flex d_column ">
                         <div class="i_item flex  j_between a_center">
                         <i class="fas fa-sort-amount-up-alt cpt_harvest"></i>
                             <div class="second_part flex d_column">
                                     <span class="holder"> Nombre de récoltes</span>
                                     <span class="i_result">'. $harvest_result['cpt'] .'</span>
                        </div>
                         </div>
                        <div class="i_item flex  j_between a_center">
                        <i class="fas fa-balance-scale-right"></i>
                             <div class="second_part flex d_column">
                                    <span class="holder">Poids d\'entré totale</span>
                                    <span class="i_result"> '. $harvest_result['p_entrer'] .'</span>
                             </div>
                        </div>
                        <div class="i_item flex  j_between a_center">
                              <i class="fas fa-balance-scale-right"></i>
                             <div class="second_part flex d_column">
                                    <span class="holder">Poids de sortie totale  </span>
                                    <span class="i_result">'. $harvest_result['p_sortie'] .'</span>
                             </div>
                        </div>
                        <div class="i_item flex  j_between a_center">
                             <i class="fas fa-balance-scale-right"></i>
                             <div class="second_part flex d_column">
                                    <span class="holder">Quantité totale  </span>
                                    <span class="i_result"> '. $harvest_result['s_quan'] .'</span>
                             </div>
                        </div>   
                        <div class="i_item flex  j_between a_center">
                            <i class="fas fa-dollar-sign"></i>
                            <div class="second_part flex d_column">
                                    <span class="holder">Montant Totale</span>
                                    <span class="i_result">'. $harvest_result['s_montant'] .'</span>
                            </div>
                        </div>
                       
             
             </div>
             <div class="information flex d_column ">
            
             <div class="i_item flex  j_between a_center">
                   <img src="../img/quality.png" alt="">
                  <div class="second_part flex d_column">
                         <span class="holder">Qualité moyenne</span>
                         <span class="i_result">'. $frquent_quality .'</span>
                  </div>
             </div>
           
             <div class="i_item flex  j_between a_center">
                 <img src="../img/product_wheat.png" alt="">
                  <div class="second_part flex d_column">
                         <span class="holder">Produit récolté fréquemment </span>
                         <span class="i_result">'. $frquent_product .' </span>
                  </div>
             </div>
             <div class="i_item flex  j_between a_center">
                 <img src="../img/quality.png" alt="">
                  <div class="second_part flex d_column">
                         <span class="holder">Meilleur office </span>
                         <span class="i_result">'. $best_office .' </span>
                  </div>
             </div>
             <div class="i_item flex  j_between a_center">
                 <img src="../img/quality.png" alt="">
                  <div class="second_part flex d_column">
                         <span class="holder">Meilleur agriculteur </span>
                         <span class="i_result">'. $best_agr .' </span>
                  </div>
             </div>
            
           </div>
         </div>
          
    
';
    }
        else
        {
            $data['result'] = 'empty';
            $data['err'] = 'pas de récoltes pendant l\'année '.$_POST['year'];   
        }
        
    }
    else
    {
        $data['result'] = 'empty';
        $data['err'] = 'pas de récoltes pendant l\'année '.$_POST['year'];
    }
    
    echo json_encode($data);
   



?>
