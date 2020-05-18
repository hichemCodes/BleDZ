<?php

session_start();

require 'action/query.php';

agr_auth();  // check if the office is connected

require 'action/load_all_session.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BléDZ | Profile</title>
    <!--  load all style files    !-->
    <?php require 'action/load_all_home_agr_styles.php';  ?> 

    
</head>
<body>
<div class="nav flex j_center spacial_nav animate_me">
       <!--  load nav_bar here    !-->
       <?php require 'action/load_nav_bar.php';  ?> 
</div>
       
 <div class="pop_up flex j_center a_center d_column hidden">
       <!--  load pop_up here    !-->  
       <?php require 'action/load_pop_up.php';  ?>          
 </div> 
                  
<div class="title"> Mon Profile </div>
        <!--  load profile   !-->
        <?php require 'action/load_profile.php';  ?> 

<div class="fotter_container flex j_center">
        <!--  load footer   !-->
        <?php require 'action/load_footer.php';  ?> 
</div>  
   

  
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/load_page_fragments.js?v=<?php echo time(); ?>"></script>
    <script src="../js/update_avatar_ajax.js"></script>
    <script src="../js/newslatter_add_member_ajax.js"></script>
   
</body>
</html>
