

<?php

session_start();

require 'query.php';

office_auth();

require 'connect_db.php';



$output ='';

date_default_timezone_set('Africa/Algiers');  //set date to GMT+1

$current_date = strtotime(date('Y-m-d H:i:s')); //current date 


if(office_has_rendez_vous($_SESSION['office_id']))
{
    $r_list = $db->prepare("SELECT * FROM rendez_vous INNER JOIN agriculteurs ON rendez_vous.agriculteur_id = agriculteurs.id WHERE office_id = ? AND is_taken=1 ORDER BY date ASC");

    $r_list->execute([$_SESSION['office_id']]);
    
   
    
    
       if($r_list->rowCount() > 0)  
       
       {
            $r_list_count_result = $r_list->fetchAll(PDO::FETCH_ASSOC);
        
            $output = '
            <span class="a_title">Rendez-vous pris</span>    
            <table>
            <tr class="b_bottom">
            <th class="t_custom">Date</th>
            <th class="t_custom">Nom et prénom d\'agriculteur</th>
            
        
            <th class="t_custom">Opération</th>
        
        
            </tr> ';
        
           foreach($r_list_count_result as $rendez_vous)
           {
      
                  
                        $rendez_vous_id = find_rendez_vous_by_date($rendez_vous['date']);
                        $r_date = strtotime($rendez_vous['date']);
                        $date_part1 = date('d/m/Y',$r_date);
                        $date_part2 = date('H:i',$r_date);
                        $output = $output.' <tr class="b_bottom">
                        <td>'. $date_part1.' à '. $date_part2 ;

                            // rendez-vous expired
                            if( $current_date >= strtotime($rendez_vous['date'])) //expired 
                            {
                               
                                    $output.= ' <strong> (expiré) </strong>';

                            } 
                        
                        $output.='
                        </td>
                        <td>'.$rendez_vous['nom'].' '.$rendez_vous['prenom'].'</td>     
                        <td>               
                            <i class="fas fa-tv" onclick="show_account('.$rendez_vous['user_id'].')" title="profile d\'agriculteur"></i>
                            <i class="fas fa-tractor" onclick="show_add_recolte('.$rendez_vous_id.','.$rendez_vous['agriculteur_id'].')"  title="ajouter récolte" ></i>
                            <i class="fas fa-trash-alt custum_trash"   onclick="cancel_rendez_vous('.$rendez_vous_id.','.$rendez_vous['agriculteur_id'].')"  title="annuler ce  récolte" ></i>
            
                        </td>
                    
                    </tr>';
                   
               
           }
           $output = $output.' </table> ';
       }
       else{
            $output = '';
       }
        
    
           echo $output;
}






?>


                                       