<?php

session_start();

require 'connect_db.php';
require 'query.php';

office_auth();

date_default_timezone_set('Africa/Algiers');  //set date to GMT+1

$current_date = strtotime(date('Y-m-d G:i')); //current date 

// valider la date 
$v_date = filter_var($_POST['date'],FILTER_SANITIZE_STRING);
if(preg_match('(\d{4}-\d{2}-\d{2} \d{2}:\d{2})',$v_date))
{
    // tester si ce rendez-vous est déja existe
    if(!(appointement_already_exist($v_date,$_SESSION['office_id'])))
    {

        if(strtotime($_POST['date']) > $current_date) //tester si la date de ce rendez-vous est supérieur a la date actuelle
        {
                $add_r = $db->prepare("INSERT INTO rendez_vous (date,office_id) VALUES (?,?) ");
                $add_r->execute([$_POST['date'],$_SESSION['office_id']]);
                
                $data['result'] = "success";
        }
        else
        {
                $data['result'] = "<div class='succes_valid s_updated error_u'>heure inférieur à l'heure actuelle </div>";      
        }
         
    }
    else
    {
        $data['result'] = "<div class='succes_valid s_updated error_u'> ce rendez-vous existe déjà  </div>";
    }
}
else
{
    $data['result'] = "<div class='succes_valid s_updated error_u'>format incorrecte  </div>";
}


echo  json_encode($data);


?>