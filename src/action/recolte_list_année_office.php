<?php
        session_start();

        require 'connect_db.php';
        require 'query.php';
        $office_id = $_SESSION['office_id'];
       
            
            
            $recolte = $db->prepare("SELECT count(*) as cpt, sum(Quantité) as quan,max(Qualité) as qual,
             YEAR(date) as year, SUM(montant) AS t_montant FROM récoltes where  office_id = ? GROUP BY YEAR(date) ORDER BY YEAR(date) DESC ");
            $recolte->execute([$office_id]);

        $recolte_count = $recolte->rowCount();

        if($recolte_count == 0){
            $output ='';// ' <span class="empty_result">vous avez pas des récolte encore</span>';
        }
        else 
        {
            $all_recolte = $recolte->fetchAll(PDO::FETCH_ASSOC);

            $output =  '
            <div class="a_title">Récoltes d\'office par Année</div>
             <table>
            <tr class="b_bottom">
                <th class="t_normal">Année</th>
                <th class="t_normal">Nombre de récoltes</th>
                <th class="t_small ">Quantité</th>
                <th class="t_small">Qualité</th>
                <th class="t_normal">Montant</th>
                <th class="t_large">Opération</th>


            </tr>';
            foreach($all_recolte as $recolte)
            {
                
               
                $frquent_quality = top_quality_in_year($recolte['year'],$_SESSION['office_id'],'office');
               
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