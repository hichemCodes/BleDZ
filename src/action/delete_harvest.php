<?php

session_start();

require 'query.php';

office_auth();

if(is_harvest($_POST['harvest_id']))
{
       if(delete_harvest($_POST['harvest_id']))
       {
             $data['result'] = 'success';
       }
       else
       {
           $data['result'] = 'fail';
           $data['err'] = 'il ya une erreur';

       }
}
else
{
    $data['result'] = 'fail';
    $data['err'] = 'vous ne pouvez pas supprimer cette récolte';
}

echo json_encode($data);