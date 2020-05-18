<?php
        session_start();

        require 'connect_db.php';

       

        $all_accounts = $db->prepare("SELECT * FROM users INNER JOIN agriculteurs on users.id= agriculteurs.user_id AND  wilaya_id=? ");
        $all_accounts->execute([$_SESSION['wilaya_id']]);

        $all_acounts_count = $all_accounts->rowCount();

        if($all_acounts_count == 0){
              $output = "<span> il n'ya pas des membres encore </span> ";
        }
        else 
        {
            $all_acounts_result = $all_accounts->fetchAll(PDO::FETCH_ASSOC);

            $output =  '
            <table>
            <tr class="b_bottom">
            <th class="t_normal">Nom et précom</th>
            <th class="t_normal">Email</th>
            <th class="t_normal">Numéro de carte</th>
            <th class="t_small">Status</th>
            <th class="t_large">Opération</th>


        </tr>';
            foreach($all_acounts_result as $account)
            {
                if($account['is_verified'] == 1){$is_valid = "valide";}
                else{$is_valid = "non valide";}   
                if($is_valid == "non valide"){ $exist ='
                   
                    <i class="fas fa-user-check custum_v" onclick="valid_account('.$account['user_id'].')" title="valider ce compte"></i>
                    ';
                    }
                    else{
                        $exist='';
                    }



                $output  = $output . ' <tr class="b_bottom">
                <td>'.  $account['nom']." ".$account['prenom'] .'</td>
                <td>'.  $account['email'].'</td>
                <td>'.$account['num_de_carte'].'</td>
                <td>'. $is_valid .'</td>
                <td>
                 '. $exist .'  
                    <i class="fas fa-tv" onclick="show_account('.$account['user_id'].')" title="voir ce compte"></i>
                </td>
                
            </tr>';
            
            }
           
            $output = $output .'</table>';
        }

        echo $output;
?>