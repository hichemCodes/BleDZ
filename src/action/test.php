<?php 

     
date_default_timezone_set('Africa/Algiers');  //set date to GMT+1
$current_date = date('Y-m-d G:i'); //date actuelle 


echo strtotime($current_date);



echo '  '.strtotime('2020-05-30 03:12');