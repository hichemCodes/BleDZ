<?php 

session_start();

require 'connect_db.php';
require 'query.php';


/// check if the user have acces to this action 

if(have_full_acces($_SESSION['office_id']))
{
      //array that contain our results 
      $array_result = [];

      // loop through all wilayas
      for($wilaya = 1;$wilaya<=48;$wilaya++)
      {
            /// check if a wilaya have at least a récolte
            if(wilaya_have_récoltes($wilaya,$_POST['year']))
            {
                        $wilaya_recoltes = $db->prepare('select SUM(Quantité) as s_quan from récoltes
                        INNER JOIN offices on récoltes.office_id = offices.id 
                        INNER JOIN users on offices.user_id = users.id 
                        and users.wilaya_id = ? and YEAR(récoltes.date) = ?');

                        $wilaya_recoltes->execute([$wilaya,$_POST['year']]);

                        $wilaya_recoltes_result = $wilaya_recoltes->fetch(PDO::FETCH_ASSOC);
                        // add result to result array
                        array_push($array_result,(float)$wilaya_recoltes_result['s_quan']);
            }
            else
            {
                array_push($array_result,0);
            }
      }
      // add array to output array
      $data['result'] = $array_result;
     
}
else
{
     $data['result'] = 'err';
}

/// send the result to ajax js filein jso format
echo json_encode($data);

