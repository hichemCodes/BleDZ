<?php
        session_start();

        require 'connect_db.php';

        $all_accounts_invalid = $db->prepare("SELECT * FROM users INNER JOIN agriculteurs on users.id= agriculteurs.user_id AND  wilaya_id=? AND users.is_verified= 0");
        $all_accounts_invalid->execute([$_SESSION['wilaya_id']]);

        $all_acounts_count = $all_accounts_invalid->rowCount();
        
        if($all_acounts_count == 0){
              $output = " <span> Toutes les comptes de votre region sont validé </span>";
        }
        else 
        {
            $all_acounts_result = $all_accounts_invalid->fetchAll(PDO::FETCH_ASSOC);

            $output = '
            
            <table id="s_table">
            <tr class="b_bottom">
            <th class="t_normal">Nom</th>
            <th class="t_normal">Email</th>
            <th class="t_normal">N carte</th>
            <th class="t_small">Status</th>
            <th class="t_large">operation</th>

        </tr>';
        
            foreach($all_acounts_result as $account)
            {
                $output  = $output. ' <tr class="b_bottom">
                <td>'.  $account['nom']." ".$account['prenom'] .'</td>
                <td>'.  $account['email'].'</td>
                <td>'.$account['num_de_carte'].'</td>
                <td>non valide</td>
                <td>
            
                <i class="fas fa-user-check" onclick="valid_account('.$account['user_id'].')" title="valider ce compte"></i>
               
                
                
                </td>
                
            </tr>';
            
            }
           
            
        }
        $output = $output.'</table>';
        echo $output;
?>