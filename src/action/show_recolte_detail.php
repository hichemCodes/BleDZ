<?php
       

        require 'connect_db.php';
        require 'query.php';


         session_start();

        $recolte = $db->prepare("SELECT * FROM récoltes 
        INNER JOIN offices ON récoltes.office_id = offices.id 
        INNER JOIN agriculteurs on récoltes.agriculteur_id = agriculteurs.id
        INNER JOIN véhicule on véhicule.récolte_id = récoltes.id
         AND  récoltes.id = ? ");
         
        $recolte->execute([$_POST['id']]);
        
        

        
            
             if( $recolte->rowCount() > 0)
             {
                  
                     
                
               $recolte_rusult = $recolte->fetch(PDO::FETCH_ASSOC);
               $produit_nom = find_product_by_code($recolte_rusult['produit_code'])['description'];
               $office_nom = find_office_name($recolte_rusult['office_id']);
               
               $date = date("d/m/Y",strtotime($recolte_rusult['date']));
               $time = date("G:i",strtotime($recolte_rusult['date']));
               $output =   '
          

            
               <i class="fas fa-times" onclick="exit_from_recolte_detail()"></i>
                 <div class="p_header flex j_center a_center custum_child_profile">
                
                 <i class="fas fa-user"></i>
                 <span>'. $recolte_rusult['nom']. " " . $recolte_rusult['prenom'].'</span>
                 
                 </div>
                 <div class="p_body flex j_evenly a_center">
                    <div class="information flex d_column ">
                               <div class="i_item flex  j_around a_center">
                               <i class="fas fa-calendar-week "></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Date </span>
                                           <span class="i_result"> '.$date.' a '. $time.'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                                    <img src="../img/product_wheat.png" alt="">
                                    <div class="second_part flex d_column">
                                           <span class="holder">Produit</span>
                                           <span class="i_result">'. $produit_nom .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                               <i class="fas fa-balance-scale-right"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Poids d\'entré </span>
                                           <span class="i_result"> '. $recolte_rusult['poids_entré'] .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                               <i class="fas fa-balance-scale-right"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Poids de sortie</span>
                                           <span class="i_result">'. $recolte_rusult['poids_sortie'] .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                               <i class="fas fa-balance-scale-right"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Quantité </span>
                                           <span class="i_result"> '. $recolte_rusult['Quantité'] .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                               <img src="../img/quality.png" alt="">
                               <div class="second_part flex d_column">
                                      <span class="holder">Qualité</span>
                                      <span class="i_result">'. $recolte_rusult['Qualité'] .'</span>
                               </div>
                          </div>
                    </div>
                    <div class="information flex d_column ">
                   
                   
                     
                    <div class="i_item flex  j_between a_center">
                         <i class="fas fa-dollar-sign"></i>
                         <div class="second_part flex d_column">
                                <span class="holder">Montant</span>
                                <span class="i_result">'. $recolte_rusult['montant'] .'</span>
                         </div>
                    </div>
                    <div class="i_item flex  j_between a_center">
                    <i class="fas fa-city"></i>
                         <div class="second_part flex d_column">
                                <span class="holder">Office  </span>
                                <span class="i_result"> '. $office_nom .'</span>
                         </div>
                    </div>
                    <div class="i_item flex  j_between a_center">
                    <i class="fas fa-tractor"></i>
                         <div class="second_part flex d_column">
                                <span class="holder">Matricule du véhicule</span>
                                <span class="i_result">'. $recolte_rusult['matricule'] .'</span>
                         </div>
                    </div>
                    <div class="i_item flex  j_between a_center">
                    <i class="fas fa-tractor"></i>
                         <div class="second_part flex d_column">
                                <span class="holder">Marque du véhicule</span>
                                <span class="i_result">'. $recolte_rusult['marque'] .'</span>
                         </div>
                    </div>
                    <div class="i_item flex  j_between a_center">
                    <i class="fas fa-user"></i>
                         <div class="second_part flex d_column">
                                <span class="holder">Nom et prénom du chauffeure</span>
                                <span class="i_result">'. $recolte_rusult['nom_de_chauffeur'] .'</span>
                         </div>
                    </div>
                    <div class="i_item flex  j_between a_center">
                    <i class="fas fa-id-card"></i>
                         <div class="second_part flex d_column">
                                <span class="holder">Numéro de permis</span>
                                <span class="i_result">'. $recolte_rusult['num_de_permis'] .'</span>
                         </div>
                    </div>
                  </div>
                </div>
                 
           
      ';
               
               
               echo $output;
             }

            else{
              
                    echo "fail";
              
             }
           
            
        
?>