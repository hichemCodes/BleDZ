<?php


require 'connect_db.php';
require 'query.php';
session_start();
$output = "";

if(office_has_rendez_vous($_SESSION['office_id']))
{
      
if(office_has_available_rendez_vous($_SESSION['office_id']))

{ 
      
      $r_list_n = $db->prepare("SELECT * FROM rendez_vous WHERE office_id = ? AND is_taken = 0 ORDER BY date ASC");

$r_list_n->execute([$_SESSION['office_id']]);

$r_list_count_result = $r_list_n->fetchAll(PDO::FETCH_ASSOC);

    $output = '
        
    
    <span class="a_title">Rndez Vous non pris</span>                     
    <table>
        <tr class="b_bottom">
            <th class="t_large">Date</th>
             
            <th class="t_large">Opération</th>
       </tr>';

       foreach($r_list_count_result as $rendez_vous)
       {
            
            
            
            $r_date = strtotime($rendez_vous['date']);
            $date_part1 = date('d/m/Y',$r_date);
            $date_part2 = date('H:i',$r_date);
            $output = $output.'<tr class="b_bottom">
            <td>'. $date_part1.' à '. $date_part2 .'</td>
            <td> 
            
                   
                        <i class="fas fa-trash-alt" onclick="destroy_r_v('. $rendez_vous['id'].')" title="supprimer ce rendez-vous"></i>                        
                        
                 
            </td>
            </tr>';
       }
       $output = $output.' </table> </div>';



}

}
else
{
      $output = '   
      <span class="empty_r_v">pas des rendez-vous pour le mement si vous voulez ajouter </span> ';

}
echo $output;



?>


                                       