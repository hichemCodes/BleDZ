<?php

session_start();


require 'connect_db.php';
require 'query.php';



     if(already_have_rendez_vous($_SESSION['agr_id']))
     {
          $output = '
          
          <span class="pas_rendez_vous"> 
                <i class="fas fa-times" onclick="hide_rendez_vous_form()"> </i>
                 vous avez déjà pris un rendez, vous ne pouvez pas prendre 2 rendez-vous au même temps
          </span>
          
          </div>';
     }
     else
     {
          $r_list = $db->prepare("SELECT * FROM rendez_vous WHERE office_id = ? AND is_taken=0 ORDER BY date ASC");

          $r_list->execute([$_POST['id']]);

          $r_list_count = $r_list->rowCount();

          if($r_list_count == 0 )
          {
          
               $output = '

               <span class="pas_rendez_vous"> 
                    <i class="fas fa-times empty_r_v" onclick="hide_rendez_vous_form()"> </i>
                          il n\'y a pas des rendez-vous disponibles proposés par l\'office '. find_office_name($_POST['id']) .'
               </span>
               
               ';

          }
          else
          {
               
          $r_list_count_result = $r_list->fetchAll(PDO::FETCH_ASSOC);

          $output = '
                       
               <i class="fas fa-times" onclick="hide_rendez_vous_form()"> </i>
               <table>
               
                    <tr class="b_bottom">
                         <th class="t_large">Date</th>
                         
                         <th class="t_large">Opération</th>
                    </tr>';

          foreach($r_list_count_result as $rendez_vous)
          {
               
               $o_name = strval(find_office_name($rendez_vous['office_id']));
               $r_date = strtotime($rendez_vous['date']);
               $date_part1 = date('d/m/Y',$r_date);
               $date_part2 = date('H:i',$r_date);
               $output = $output.'<tr class="b_bottom">
               <td>'. $date_part1.' à '. $date_part2 .'</td>
               <td> 
               
                    
                         <i class="fas fa-business-time" 
                                   onclick="prend_r_v('. $rendez_vous['id'].',\''. $o_name.'\',\''. $rendez_vous['date'].'\')"
                                   title = "prendre ce rendez-vous"
                                   "></i>                        
                    
                    
               </td>
               </tr>';
          }
       $output = $output.' </table> ';
}




}
echo $output;
?>


                                       