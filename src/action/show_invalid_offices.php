<?php

require 'connect_db.php';
require 'query.php';

session_start();

if(have_full_acces($_SESSION['office_id']))
{
    if(exist_invalid_offices())
    {
        $output = '<span class="a_title">Offices a valider</span>';

     
      
        $office = $db->prepare("SELECT * FROM users INNER JOIN offices ON users.id = offices.user_id
        AND users.profile_id = 1 AND users.is_verified = 0 ");
        
        $office->execute();
             $output = $output.' 
                                    
                                    <table id="s_table">
                                     <tr class="b_bottom">
                                    <th class="t_normal">Nom</th>
                                    <th class="t_normal">Email</th>
                                    <th class="t_normal">Wilaya</th>
                                    <th class="t_small">Status</th>
                                    <th class="t_large">operation</th>
    
                                </tr>
             ';
             $office_result = $office->fetchAll(PDO::FETCH_ASSOC);
             foreach($office_result as $office_r)
             {
                  
                  $output = $output.'
                    
                                 <tr class="b_bottom">
                    <td>'.  $office_r['nom']  .'</td>
                    <td>'. $office_r['email'] .'</td>
                    <td>'.  getWilaya($office_r['wilaya_id']) . '</td>
                    <td>non valide</td>
                    <td>
                
                    <i class="fas fa-user-check" onclick="valid_account('. $office_r['user_id'] .')" title="valider ce compte"></i>
                    
                    
                    
                    </td>
                    
                </tr></table>
                  
                  ';
             }
            }
             else
             {
                  $output = '';
             }

             echo $output;
    }
    

  

    




    
?>



