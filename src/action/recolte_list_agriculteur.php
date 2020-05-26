<?php
        session_start();

        require 'connect_db.php';
        require 'query.php';

        $output = '';

        

     if(agr_have_recolte($_SESSION['agr_id']))

     {
        
        
        //// set up  the pages result 
        if(!isset($_POST['start_p']) && !isset($_POST['end_p']))
        {
             $start_p = 0;
             $end_p = 5;
        }
        else
        {
             $start_p = $_POST['start_p'];
             $end_p = $_POST['end_p'];
        }
      
        if($_POST['year'] == 'tous')
        {
            if($_POST['order_by'] == "date")
            {
               
                $recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = :agr_id ORDER BY date DESC limit 5 OFFSET :start_p ");
    
            }
            else if ($_POST['order_by'] == "Quantity")
            {
    
                $recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = :agr_id ORDER BY Quantité DESC limit 5 OFFSET :start_p ");
    
            }
            else if($_POST['order_by'] == "Quality")
            {
    
                $recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = :agr_id ORDER BY Qualité ASC limit 5 OFFSET :start_p");
    
            }
            else if($_POST['order_by'] == "montant"){
                
                   $recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = :agr_id order by montant desc limit 5 OFFSET :start_p ");
            }

            $recolte->bindValue(':agr_id', $_SESSION['agr_id'], PDO::PARAM_INT); 
            $recolte->bindValue(':start_p', (int) $start_p, PDO::PARAM_INT); 
            

            $recolte->execute();

        }
        else{
            if($_POST['order_by'] == "date")
            {
               
                $recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = :agr_id AND YEAR(date) = :date_y ORDER BY date DESC limit 5 OFFSET :start_p");
    
            }
            else if ($_POST['order_by'] == "Quantity")
            {
    
                $recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = :agr_id AND YEAR(date) = :date_y ORDER BY Quantité DESC limit 5 OFFSET :start_p");
    
            }
            else if($_POST['order_by'] == "Quality")
            {
    
                $recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = :agr_id AND YEAR(date) = :date_y ORDER BY Qualité ASC limit 5 OFFSET :start_p");
    
            }
            else if($_POST['order_by'] == "montant"){
                   $recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = :agr_id  AND YEAR(date) = :date_y order by montant desc limit 5 OFFSET :start_p");
            }

            $recolte->bindValue(':agr_id', $_SESSION['agr_id'], PDO::PARAM_INT); 
            $recolte->bindValue(':date_y', $_POST['year'], PDO::PARAM_INT); 
            $recolte->bindValue(':start_p', (int) $start_p, PDO::PARAM_INT); 
            

            $recolte->execute();
           }
       

        
        
        $recolte_count = $recolte->rowCount();
        
        
        


        if($recolte_count == 0){
              $output = ' <span class="empty_result empty_result_custum">vous n\'avez pas des récoltes dans cette année</span>';
        }
        else 
        {
            $all_recolte = $recolte->fetchAll(PDO::FETCH_ASSOC);

            $output =  ' <table>
            <tr class="b_bottom">
                <th class="t_normal">Date</th>
                <th class="t_normal">Produit</th>
                <th class="t_small ">Quantité</th>
                <th class="t_small">Qualité</th>
                <th class="t_normal">Montant</th>
                <th class="t_large">opération</th>


            </tr>';
            foreach($all_recolte as $recolte)
            {
                
                $r_date = strtotime($recolte['date']);
                $r_date = date('d/m/Y',$r_date);
                $produit = find_product_by_code($recolte['produit_code']);
                $produit_nom = $produit['description'];
               // $montant = $produit['prix_unitaire'] * $recolte['Quantité'];
                $output  = $output .' <tr class="b_bottom">
                 
                <td>'.  $r_date .'</td>
                <td> '. $produit_nom .' </td>
                <td>'.  $recolte['Quantité'].'</td>
                <td>'.$recolte['Qualité'].'</td>
                <td> '. $recolte['montant'] .' </td>
                <td>
                   
                             <i class="fas fa-tv" onclick="show_recolte_detail('.$recolte['id'].')"></i>
                </td>
                
            </tr>';
            
            }
             $output = $output." </table>";

            // add pagination button id exists 

            $result_per_page = 5;
            $recolte_count = all_recolte_of_agr($_SESSION['agr_id'],$_POST['year']);
            $number_of_pages  = ceil((int)$recolte_count/$result_per_page);

            if($number_of_pages > 1)
            {
                  // initialisation de la premierre page 
                        $first_page = 0;
                        $last_page = 5;
                        $output = $output . '<div class="flex j_center a_center all_opginate_btn">';
                  for ($i = 1;$i<=$number_of_pages;$i++)
                  {
                      
                       

                       if($i == $end_p/$result_per_page)
                       {
                        
                           $output = $output . '<button class="paginate_btn active_page"  onclick="show_interval_page('. $first_page .','. $last_page .','. $i .')">'.$i.'</button>';

                       }
                       else
                       {

                           $output = $output . '<button class="paginate_btn"   onclick="show_interval_page('. $first_page .','. $last_page .','. $i .')">'.$i.'</button>';

                       }

                       $first_page = $last_page;
                       $last_page = (int) $last_page + 5; 

                  }
                  $output = $output.'</div>';
            }
            
            
        }
     }
        

        echo $output;

?>


