<?php
        session_start();

        require 'connect_db.php';
        require 'query.php';
        $agr_id = $_SESSION['agr_id'];
       
            $output = '';
        if(agr_have_recolte($agr_id))   
        {
            $recolte = $db->prepare("SELECT count(*) as cpt, sum(Quantité) as quan,max(Qualité) as qual,
            YEAR(date) as year, SUM(montant) AS t_montant FROM récoltes where  agriculteur_id = ? GROUP BY YEAR(date) ORDER BY YEAR(date) DESC ");
           $recolte->execute([$_SESSION['agr_id']]);
       
       
        
      
           $all_recolte = $recolte->fetchAll(PDO::FETCH_ASSOC);
           
           $output =  '
           <div class="title c_h_title">Récoltes par Année</div>
            <table>
           <tr class="b_bottom">
               <th class="t_normal">Année</th>
               <th class="t_normal">Nb de récoltes</th>
               <th class="t_small ">Quantité</th>
               <th class="t_small">Qualité</th>
               <th class="t_normal">Montant</th>
               <th class="t_large">opération</th>


           </tr>';
           foreach($all_recolte as $recolte)
           {
               $frquent_quality = top_quality_in_year($recolte['year'],$_SESSION['agr_id'],'agriculteur');
              /* $produit = find_product_by_code($recolte['produit_code']);
               $montant = $produit['prix_unitaire'] * $recolte['quan'];*/
               $output  = $output .' <tr class="b_bottom">
              
               <td>'.  $recolte['year'] .'</td>
               <td> '. $recolte['cpt'] .'</td>
               <td>'.  $recolte['quan'].'</td>
               <td>'. $frquent_quality .'</td>
               <td> '. $recolte['t_montant'] .' </td>
               <td>
                  
                            <i class="fas fa-tv" onclick="recolte_detail_year('.$recolte['year'] .')"></i>
               </td>
               
           </tr>';
           
           }
            $output = $output." </table>";
           
           
       }
        
        
            

        echo $output;

?>