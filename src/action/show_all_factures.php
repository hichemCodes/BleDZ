
<?php

session_start();


require 'connect_db.php';
require 'query.php';


////  afficher tous les factures a partient a l'office

if(isset($_POST['start_page']) && isset($_POST['end_page']))
{
          $start_p = (int)$_POST['start_page'];
          $end_p = (int)$_POST['end_page'];
}
else
{
            $start_p = 0;
            $end_p = 5;
}

$all_factures = $db->prepare("SELECT date,nom,prenom,montant,factures.id as f_id FROM factures INNER JOIN agriculteurs ON factures.agriculteur_id = agriculteurs.id
                                 AND office_id = :office_id ORDER BY  date DESC LIMIT 10 OFFSET :start_p");

$all_factures->bindValue(':office_id',$_SESSION['office_id'],PDO::PARAM_INT);
$all_factures->bindValue(':start_p',$start_p,PDO::PARAM_INT);

$all_factures->execute();


        if($all_factures->rowCount() > 0)
        {
                $output = '
               
                <table >
                <tr class="b_bottom">
                <th class="t_normal">Date</th>
                <th class="t_normal">Nom et Prenom d\'agriculteur</th>
                <th class="t_normal">Montant</th> 
                <th class="t_normal">Opération</th>

            </tr>';

        $all_factures_result = $all_factures->fetchALL(PDO::FETCH_ASSOC);
        
                foreach($all_factures_result as $facture)
                {
                    $output  = $output. ' 
                    <tr class="b_bottom">

                        <td>'. date('d/m/Y',strtotime($facture['date']))  .'</td>
                        <td>'.$facture['nom']." ".$facture['prenom'].'</td>
                        <td>'. $facture['montant'] .'</td>
                        <td>
                        <i class="far fa-file-pdf" onclick="show_facture('.$facture['f_id'].')" title="afficher cette facture"></i>         
                        </td>
                
                    </tr>';
                }
                $output = $output.'</table>';

                //  pagination

                $item_by_page = 10;

                if(factures_count() > $item_by_page)
                {
                 
                    $output = $output . '<div class="flex j_center a_center all_opginate_btn">';  // add pagination container
                    $number_page = ceil(factures_count()/$item_by_page);

                    // first itiration
                    $first_page = 0;
                    $last_page = $item_by_page;

                    for($i = 1;$i<=$number_page;$i++)
                    {
                        if($i == $end_p/$item_by_page)
                        {
                            $output = $output . '<button class="paginate_btn active_page"  onclick="show_all_factures('. $first_page .','. $last_page .')">'.$i.'</button>';
                        }
                        else
                        {
                            $output = $output . '<button class="paginate_btn"  onclick="show_all_factures('. $first_page .','. $last_page .')">'.$i.'</button>';
                        }
                        $first_page = $last_page;
                        $last_page = (int)$last_page + 5;
                    }

                    
                    $output = $output.'</div>';
                }
        }
        else
        {
            $output = " <span> il n'ya pas encore des factures  </span>";
        }

        echo $output;





?>
                     
