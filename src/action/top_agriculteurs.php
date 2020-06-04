


<?php

require 'connect_db.php';
require 'query.php';

$current_year = date('Y');
$output = '';

$top_agr = $db->prepare("SELECT sum(Quantité) as quan,agriculteur_id as agr_id ,nom,prenom,wilaya_id FROM récoltes
                            INNER JOIN agriculteurs ON récoltes.agriculteur_id = agriculteurs.id 
                            INNER JOIN users ON agriculteurs.user_id = users.id 
                            AND YEAR(récoltes.date) = ? 
                            GROUP BY récoltes.agriculteur_id 
                            ORDER BY sum(Quantité) DESC LIMIT 10") ;

 $top_agr->execute([$current_year]);

 $top_agr_result = $top_agr->fetchAll(PDO::FETCH_ASSOC);

 foreach($top_agr_result as $agr)
 {
      
 
        if(!has_avatar($agr['agr_id']))
        {
              $avatar = '<div class="img_default flex j_center a_center d_column">
                             <i class="fas fa-user fa-8x "></i> 
                          </div>';
        }
        else
        { 
            // $avatar_src = find_avatar($agr['agr_id']);
             $avatar = '  <img src="../users_avatar/'.find_avatar($agr['agr_id']).'" alt="">';


        }

        $nom_prenom = $agr['nom'].' '.$agr['prenom'];
        $wilaya = getWilaya($agr['wilaya_id']);
       
        for($i=0;$i<4;$i++)
        {
          $output .= '
          
          <div class="profile flex d_column j_center a_center">

               <div class="img ">
                         '. $avatar  .'
               </div>
               <div class="fotter_profile flex j_center a_center d_column">
               <span class="p_name">'. $nom_prenom .'</span>
               <span class="p_city">' . $wilaya . '</span>
               <span>'. $agr['quan'].' tonne /an</span>
               </div>
          </div>

          ';
        }
     }
 

 echo $output;
       
 

?>



