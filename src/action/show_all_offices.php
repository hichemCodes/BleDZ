



<?php

session_start();

require 'connect_db.php';
require 'query.php';

office_auth();

$output = '';

if(have_full_acces($_SESSION['office_id']) )
{

    if(exist_offices() && exist_offices_other_than_me($_SESSION['id']))
    {

         $all_offices = $db->prepare("SELECT * FROM users INNER JOIN offices ON users.id = offices.user_id AND users.id  <> ?");

         $all_offices->execute([$_SESSION['id']]);

         $all_offices_result = $all_offices->fetchAll(PDO::FETCH_ASSOC);

         $output =  '
         <table>
         <tr class="b_bottom">
         <th class="t_normal">Nom</th>
         <th class="t_normal">Email</th>
         <th class="t_normal">Wilaya</th>
         <th class="t_small">Status</th>
         <th class="t_large">opération</th>


          </tr>';

         foreach($all_offices_result as $result)
         {
                    if($result['is_verified'] == 1)
                    {
                        $is_valid = "valide";
                    }
                    else
                    {
                        $is_valid = "non valide";
                    }   
                    if($is_valid == "non valide")
                    { 
                        $exist ='
                    
                        <i class="fas fa-user-check custum_v" onclick="valid_account('.$result['user_id'].')" title="valider ce compte"></i>
                        ';
                    }
                    else
                    {
                            $exist='';
                    }



                    $output  = $output . ' <tr class="b_bottom">
                    <td>'.  $result['nom'].'</td>
                    <td>'.  $result['email'].'</td>
                    <td>'.getWilaya($result['wilaya_id']).'</td>
                    <td>'. $is_valid .'</td>
                    <td>
                    '. $exist .'  
                        <i class="fas fa-tv" onclick="show_office_account('.$result['user_id'].')" title="voir ce compte"></i>
                    </td>
                    
                </tr>';
         }
         $output = $output .'</table>';

    }
    else
    {
        $output = "<span> il n'ya pas des membres encore </span> ";


    }

    echo $output;
}

?>

