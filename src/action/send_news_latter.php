<?php

session_start();

require 'query.php';
require 'filter_newsllter_mailing.php';


$dest = filter_var($_POST['dest'],FILTER_SANITIZE_STRING);
$object = filter_var($_POST['object'],FILTER_SANITIZE_STRING);
$msg = filter_var($_POST['msg'],FILTER_SANITIZE_STRING);

$valid_public = array('all_belongs','all_subscriber','all');

    if(in_array($dest,$valid_public))
    {
        
          $result = send_newslatter($_SESSION['office_id'],$object,$msg,$dest);

          if( $result === true)
          {
                $data['result'] = "Newsletter envoyée avec succès";
          }
          else
          {
               $data['result'] = 'fail';
               $data['err'] = "err : ".$result;        
          }
    }
    else
    {
        $data['result'] = 'fail';
        $data['err'] = "le public cible incorrect !";
    }

    echo json_encode($data);
?>