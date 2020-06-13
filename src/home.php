
<?php

    session_start();

    require 'action/query.php';

    redirect_if_already_loged_in();

 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/flex.css">
    <link rel="stylesheet" href="../css/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/sign_in_sign_up.css">
    <link rel="stylesheet" href="../css/swwet_alert_style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../img/logo_s.png" type="image/icon type">   
    <link rel="stylesheet" href="../css/fontawesome-free-5.12.1-web/css/all.min.css">
       
    <title>BléDZ | Accueil</title>
</head>
<body>
    <div class="first_page">
                     
    <div class="cover_all"></div>
      
         <div class="cover flex ">
                    
          
                 
         </div>          
                <div class="description flex d_center j_center a_center">
                    
                     <div class="pub">

                    </div>
                      
                     
                </div>
            
           
            <div class="nav flex j_center">

                <div class="nav_child flex j_start a_center">
                            <a href="" class="logo" ><img src="../img/logo.png" alt=""></a>
                            <ul class="flex j_around">
                               <li id="acceuil" class="active_nav_link">Acceuil</li>
                             <li id="service">Services</li>
                              <li id="agriculteur"> Agriculteurs</li>
                                
                            </ul>
                            <a href="sign_in.php" class="cnx_btn">
                                Connecter
                            </a>
                </div>



            </div>

            <div class="change_bg flex j_center a_center">
                 <div class="active_bg" id="0"></div>
                 <div id="1"></div>
                 <div id="2"></div>
            </div>              
        </div>    
        <div class="second_page flex j_center a_center ">

            <div class="s_width ">

                <div class="title light_black " id="services">Nos Services</div>
                            <div class="services flex j_between a_center  ">
                                
                                        <div class="service flex  j_center d_column rendez_vous">
                                            <i class="fas fa-business-time fa-6x "></i> 
                                                <!--  fa-business-time fa-calendar-check-->
                                                
                                            <div class="s_description light_black d_rendez_vous">Rendez-vous de dépôt de la récolte</div>
                                    
                                        </div>
                                        <div class="service flex d_column class ">
                                            <i class="fas fa-tractor fa-6x"></i>
                                            <div class="s_description light_black d_class">Classification des récoltes</div>
                                    
                                        </div>
                                        <div class="service flex d_column vente ">
                                            <i class="fas fa-file-invoice-dollar d_top"></i> 
                                                    
                                                <div class="s_description light_black ">Factures de vente</div>
                                        
                                        </div>
                                        <div class="service flex d_column ">
                                                    <i class="fas fa-chart-line fa-7x"></i> 
                                                    <div class="s_description light_black">Statistiques des récoltes</div>
                                            
                                        </div>    
                            </div>
                            
                

            </div>
            
        </div>
        <div class="title"></div>
        <div class="third_page flex j_center">
                    <div class="s_width flex j_center a_center d_column">

                       <div class="title white"> Faits Agricoles</div> 
                        <div class="facts flex j_between s_width ">
                            <div class="fact flex j_start d_column">
                                <span class="number all_agr"></span>
                                <span class="f_d">Agriculteurs inscrits</span>
                            </div>
                            <div class="fact flex j_start d_column">
                                <span class="number all_offices"></span>
                                <span class="f_d">Offices du blé</span>
                            </div>
                            <div class="fact flex j_start d_column">
                                <span  class="number all_recolte" ></span>
                                <span class="f_d" >Récoltes enrigistrés</span>
                            </div>
                                    
                        </div>
                    </div>
        </div>
        
    <div class="about  flex j_center a_center d_column">
            <div class="title" id="agruculteurs">
                Nos Agriculteurs
            </div>
         <div class="all_profiles s_width">
            <div class=" flex j_start a_center agr_list">
      
           
             
            </div>
            </div>
             <div class="slide_profile_right flex j_center a_center">
                  <i class="fas fa-chevron-right"></i>
             </div> 
             <div class="slide_profile_left flex j_center a_center">
                  <i class="fas fa-chevron-left"></i>
         </div>         
    </div>
    <div class="fotter_container flex j_center">
       <!--  load all style files    !-->
       <?php require 'action/load_footer.php';  ?>      
    </div>
        <div class="to_top flex j_center a_center"> <i class="fas fa-arrow-up"></i></div>
       
        
        
       
           <script src="../js/jquery-3.4.1.min.js"></script>
           <script src="../js/animation_jquery.js?v=<?php echo time(); ?>"></script>
        
           <script src="../js/swwet_alert.js"></script>

            <script src="../js/home_out_ajax.js?v=<?php echo time(); ?>"></script>
            <script src="../js/newslatter_add_member_ajax.js?v=<?php echo time(); ?>"></script>
            <script src="../js/home_out.js?v=<?php echo time(); ?>"></script>
           
              
            <script src="../js/typed1.js"></script>
            <script src="../js/typed_animation.js?v=<?php echo time();?>"></script>         
            <script src="../js/facts_counter_animation.js?v=<?php echo time();?>"></script>
            
        
      <script>
      
      
    

      </script>
</body>
</html>

   