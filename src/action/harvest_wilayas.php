<?php

session_start();
require 'query.php';

office_auth();  // check if the office is connected

if(have_full_acces($_SESSION['office_id']))
{
    $all_harvest_wilaya = $db->prepare(" SELECT SUM(quantité) as s_quan,wilayas.id as wilaya_id ,wilayas.nom as wilaya_nom 
                                         ,SUM(récoltes.montant) as s_montant FROM récoltes
                                         INNER JOIN offices ON récoltes.office_id = offices.id
                                         INNER JOIN users ON offices.user_id = users.id
                                         INNER JOIN wilayas ON users.wilaya_id = wilayas.id
                                         AND YEAR(récoltes.date) = ? 
                                         GROUP BY wilayas.id 
                                         ORDER BY s_quan DESC
                                       ");

    $all_harvest_wilaya->execute([$_POST['year']]);
    
   
    if($all_harvest_wilaya->rowCount() > 0)
    {
        $all_harvest_wilaya_result = $all_harvest_wilaya->fetchAll(PDO::FETCH_ASSOC);

        $data['result']= '
            <table>
            <tr class="b_bottom">
                <th class="t_normal">matricule</th>
                <th class="t_normal">nom</th>
                <th class="t_small ">Quantité</th>
                <th class="t_small">Qualité</th>
                <th class="t_normal">Montant</th>
                <th class="t_large">Opération</th>
        
        
            </tr>';

        foreach($all_harvest_wilaya_result as $harvest)
        {
            // frequent quality
            $frquent_quality = top_quality_in_year($_POST['year'],$harvest['wilaya_id'],'wilayas');
            $data['result'].='
            <tr class="b_bottom">

                    <td>'.  $harvest['wilaya_id'] .'</td>
                    <td> '. $harvest['wilaya_nom'] .'</td>
                    <td>'.  $harvest['s_quan'].'</td>
                    <td>'.  $frquent_quality .'</td>
                    <td> '. $harvest['s_montant'] .' </td>
                    <td>  
                        <i class="fas fa-tv"
                         onclick="recolte_wilaya_detail_year('.$harvest['wilaya_id'] .')"
                         title ="afficher les informations"
                        ></i>
                    </td>
            
            </tr>
            ';
        }
        $data['result'] .= '</table>';


    }
    else
    {
        $data['result'] = 'empty';
        $data['err'] = '<span class="empty_result">pas de récoltes pendant l\'année '.$_POST['year'].' </span>';
    }
    
    echo json_encode($data);
   
}


?>
