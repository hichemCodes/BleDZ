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
    <title>BléDZ | Récoltes</title>
    <!--  load all style files    !-->
    <?php require 'action/load_all_home_agr_styles.php';  ?> 
   
</head>
<body class="flex j_center a_center d_column" >

<div class="nav flex j_center spacial_nav animate_me">
    <!--  load nav_bar here    !-->
    <?php require 'action/load_nav_bar.php';  ?> 
</div>
       
 <div class="pop_up flex j_center a_center d_column hidden">
    <!--  load pop_up here    !-->  
    <?php require 'action/load_pop_up.php';  ?>          
 </div> 
                  
                  <div class="title"> Mes Récoltes </div>
                 <?php 
                       /// chek if recolte have recolte 
                      if(agr_have_recolte($_SESSION['agr_id']))
                      {  
                            require 'action/sort_option.php';
                      }
                      else
                      {
                          echo ' <span class="empty_result no_recoltes">vous n\'avez pas des récoltes encore</span>';
                      }
                      
                      
                      ?>
                       
                 
<div class="accounts special flex d_column  j_center a_center  all_recolte">
<!--  load récoltes    !-->
 </div>
                        
<div class="accounts special flex d_column  j_center a_center  all_recolte_annee"> 
<!--  loadrécoltes group by year   !-->
</div>   
 <!--  Graphs   !-->
<div class="recoltes_chart_container s_width flex j_center a_center d_column">                               
  <span class="flex">Graph des récoltes Année 
              <select class="chart_year">
                   <option value="2020" selected>2020</option>
                   <option value="2019" >2019</option>
               </select>
  </span>
<canvas id="myChart"  ></canvas>
</div>       
<div class="recoltes_chart_container s_width flex j_center a_center d_column last_item_r">                               
   <span class="flex">Graph de Revenu mensuel Année 
                <select class="chart_year_money">
                      <option value="2020" selected>2020</option>
                      <option value="2019">2019</option>
                </select>
    </span>
    <canvas id="myChart_money"></canvas>
</div>         

<div class="fotter_container flex j_center">
        <!--  load footer   !-->
        <?php require 'action/load_footer.php';  ?> 

</div> 

<div class="cover_all2"> 
   <div class="profile_container flex j_center a_center">
      <div class="profile  flex d_column ">   </div>
   </div>
</div>
          
                <!--  scripts   !-->
                <script src="../js/jquery-3.4.1.min.js"></script>
                <script src="../js/load_page_fragments.js?v=<?php echo time(); ?>"></script>
                <script src="../js/radio_change_event.js"></script>
                <script src="../js/harvest_ajax.js?v=<?php echo time(); ?>"></script>
                <script src="../js/newslatter_add_member_ajax.js"></script>
                <script src="../js/Chart.bundle.js"></script>
                <script src="../js/chart_generator_ajax.js"></script>
                

</body>
</html>

