<?php    
                     
                     session_start();
                     require 'query.php';


                     if(already_have_rendez_vous($_SESSION['agr_id']))
                     {
                           $output =  '<div class="title c_h_title">Mon rendez-vous </div>';
                           $mon_rendez_vous = my_rendez_vous($_SESSION['agr_id']);
                           $r_date = strtotime($mon_rendez_vous['date']);
                           $date_part1 = date('d/m/Y',$r_date);
                           $date_part2 = date('H:i',$r_date);
                           $date_f = $date_part1.' à '.$date_part2;
                           $wilaya = getWilaya($_SESSION['wilaya_id']);
                          $office_name  = find_office_name($mon_rendez_vous['office_id']);

                            $output = $output .'<table class="my_r_v">
                             <tr class="b_bottom">
                                <th class="t_large">Date</th>
                                 
                                <th class="t_large">operation</th>
                           </tr>
                           
                           <tr class="b_bottom">
                           <td>'. $date_part1.' à '. $date_part2 .'</td>
                                <td>   
                                
                                            <i class="fas fa-trash-alt" title="annuler"  onclick="annuler_rendez_vous('. $mon_rendez_vous['id'] .')"></i> 
                                            
                                            <i class="far fa-file-pdf" title="télecharger la convocation de rendez-vous" onclick="generate_pdf_conv(\''.$mon_rendez_vous['id'].'\')"></i>                      
                            
                                </td>
                                </table> ';

                     }
                     else{
                                $output = "";
                     }
                       echo $output;
                     ?>