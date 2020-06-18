<?php

session_start();

require 'query.php';

office_auth();

if(is_member($_POST['agr_id'],$_SESSION['wilaya_id']))
{
       if(delete_member($_POST['agr_id']))
       {
             //$data['result'] = 'success';
             echo 'yes';
       }
       else
       {
           /*$data['result'] = 'fail';
           $data['err'] = 'il ya une erreur';*/

       }
}
else
{
    /*$data['result'] = 'fail';
    $data['err'] = 'vous ne pouvez pas supprimer ce compte';*/
}