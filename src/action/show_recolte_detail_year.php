<?php
       

        require 'connect_db.php';
        require 'query.php';


         session_start();
        


         if($_POST['type'] == 'agriculteur')
         {
             $user_id = $_SESSION['agr_id'];
         }
         else
         {
              $user_id = $_SESSION['office_id'];
         }
         $recolte_year = $_POST['year'];///filter_var( (int)($_POST['year']),FILTER_SANITIZE_INT);

        if(user_have_recolte_in_year($user_id,$recolte_year,$_POST['type']))
        {

          if($_POST['type'] == 'agriculteur')
          {
               $recolte = $db->prepare("SELECT count(*) as cpt, sum(Quantité) as quan,sum(poids_entré) as t_poids_e,
               sum(poids_sortie) as t_poids_s,YEAR(date) as year, SUM(montant) AS t_montant,
               agriculteurs.nom as nom,prenom FROM récoltes
                INNER JOIN agriculteurs ON récoltes.agriculteur_id = agriculteurs.id 
               
                AND YEAR(date) = ?  AND agriculteur_id = ? 
                ");
          }
          else
          {
               $recolte = $db->prepare("SELECT count(*) as cpt, sum(Quantité) as quan,sum(poids_entré) as t_poids_e,
               sum(poids_sortie) as t_poids_s,YEAR(date) as year, SUM(montant) AS t_montant,
               offices.nom as nom FROM récoltes
                INNER JOIN offices ON récoltes.office_id = offices.id   AND YEAR(date) = ?  AND office_id = ? 
             ");
          }
            
          
              $recolte->execute([$recolte_year,$user_id]);
        
        

              
            
             if($recolte->rowCount() > 0 )
             {
                  
               
               
                
                $recolte_rusult = $recolte->fetch(PDO::FETCH_ASSOC);

               $produit_nom = top_product_in_year($recolte_year,$user_id,$_POST['type']);
               if($_POST['type'] == 'agriculteur')
               {
                    $office_nom = top_office_in_year($recolte_year,$user_id);
               }
               $quality = top_quality_in_year($recolte_year,$user_id,$_POST['type']);
               

               $output =   '
          

             
               <i class="fas fa-times" onclick="exit_from_recolte_detail()"></i>
                 <div class="p_header flex j_center a_center">
                
                 <i class="fas fa-user"></i> <span>';
                 if($_POST['type'] == 'office')
                 { 
                      $output = $output.'office ';
                 }

                 $output .=$recolte_rusult['nom'].' '; 
                 if($_POST['type'] == 'agriculteur')
                 { 
                      $output = $output.$recolte_rusult['prenom'];
                 }
                 
                 $output = $output.' récolte anneé '.$recolte_rusult['year'].'</span>
                 </div>
                 <div class="p_body flex';
                 if($_POST['type'] == 'agriculteur')
                 { 
                      $output .= ' j_evenly';
                 }
                 else
                 {
                      $output .= ' j_around' ;
                 }
                 
                 $output.= ' a_center">
                    <div class="information flex d_column ">
                                <div class="i_item flex  j_between a_center">
                                <i class="fas fa-balance-scale-right"></i>
                                    <div class="second_part flex d_column">
                                            <span class="holder"> Nombre de récoltes</span>
                                            <span class="i_result">'. $recolte_rusult['cpt'] .'</span>
                                    </div>
                                </div>
                               <div class="i_item flex  j_between a_center">
                               <i class="fas fa-balance-scale-right"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Poids d\'entré totale </span>
                                           <span class="i_result"> '. $recolte_rusult['t_poids_e'] .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                                     <i class="fas fa-balance-scale-right"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">poids de sortie totale </span>
                                           <span class="i_result">'. $recolte_rusult['t_poids_s'] .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                                    <i class="fas fa-balance-scale-right"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Quantité totale  </span>
                                           <span class="i_result"> '. $recolte_rusult['quan'] .'</span>
                                    </div>
                               </div>
                              
                              
                              
                    </div>
                    <div class="information flex d_column ">
                   
                    <div class="i_item flex  j_between a_center">
                          <img src="../img/quality.png" alt="">
                         <div class="second_part flex d_column">
                                <span class="holder">Qualité moyenne</span>
                                <span class="i_result">'. $quality .'</span>
                         </div>
                    </div>
                     
                    <div class="i_item flex  j_between a_center">
                         <i class="fas fa-dollar-sign"></i>
                         <div class="second_part flex d_column">
                                <span class="holder">Montant totale</span>
                                <span class="i_result">'. $recolte_rusult['t_montant'] .'</span>
                         </div>
                    </div>';
                    if($_POST['type'] == 'agriculteur')
                    {
                          $output = $output.'
                          <div class="i_item flex  j_between a_center">
                          <i class="fas fa-city"></i>
                               <div class="second_part flex d_column">
                                      <span class="holder">Office fréquent  </span>
                                      <span class="i_result"> '.$office_nom.' </span>
                               </div>
                          </div>
                          ';
                    }
                    $output = $output.'
                    <div class="i_item flex  j_between a_center">
                        <img src="../img/product_wheat.png" alt="">
                         <div class="second_part flex d_column">
                                <span class="holder">Produit récolté fréquemment </span>
                                <span class="i_result">'. $produit_nom .' </span>
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
        }
        else
        {
            echo "fail year";
        }
       

        
        
           
            
        
?>