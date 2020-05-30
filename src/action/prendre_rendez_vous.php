<?php

session_start();


require 'connect_db.php';
require 'query.php';


// tester si ce rendez-vou existe et non pris
if(rendez_vous_exist($_POST['id']))
{
    
    $u_rendez_v = $db->prepare("UPDATE rendez_vous SET is_taken = 1 , agriculteur_id = ? WHERE id = ? ");
    $u_rendez_v->execute([$_SESSION['agr_id'],$_POST['id'] ]);
    
    $data['result'] =  "rendez-vous pris avec succès";

}
else
{
    $data['result'] =  "fail";

    $data['err'] =  "ce rendez-vous n'éxiste pas";
}

echo json_encode($data);




?>


                                       