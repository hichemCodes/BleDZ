<?php

session_start();

require 'query.php';

office_auth();

$user_id = find_agr_user_id($_POST['agr_id']);

if(is_member($user_id,$_SESSION['wilaya_id']))
{
       if(delete_member($_POST['agr_id']))
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
    $data['err'] = 'vous ne pouvez pas supprimer ce compte';
}

echo(json_encode($data));