<?php

session_start();

require 'query.php';

office_auth();


if(office_have_recolte($_SESSION['office_id']))                                                     
{
    $data['result'] = 'success';
}
else
{
    $data['result'] = 'fail';
}

echo json_encode($data);