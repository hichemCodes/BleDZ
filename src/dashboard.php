<?php

session_start();
require 'action/query.php';


        office_auth();  // check if the office is connected

        $nom = $_SESSION['nom'];
        $email = $_SESSION['email'];
        $wilaya_id  = $_SESSION['wilaya_id'];
        $wilaya = strtoupper(getwilaya($wilaya_id));
        $phone = find_phone($_SESSION['id']);
           
               
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/flex.css">
    <link rel="stylesheet" href="../css/Dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/Dashboard2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/Dashboard3.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/loader_animation.css">
    

    <link rel="stylesheet" href="../css/paginate_style.css">
    <link rel="stylesheet" href="../css/fontawesome-free-5.12.1-web/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <title>BléDZ | Dashboard</title>
  
</head>
<body>
            <div class="flex container ">
                           <div class="item1 flex j_start a_center d_column mini_side_bar">
                             <div class="logo">
                                <a href="">
                                    <img src="../img/logo.png" alt="">
                                </a>
                                 
                             </div>
                           
                             <div class="item section flex a_center j_center active" id="Dashboard" title="Dashboard" >
                                <i class="fas fa-chart-line center_transform"></i>
                                <span class="small_bottom_txt" > Dashboard</span>
                             </div>
                             <div class="item  section flex a_center j_center" id="accounts" title="Membres">
                                    <i class="fas fa-user center_transform"></i>
                                    <span class="small_bottom_txt" > Membres </span>
                              </div>
                             <div class="item  section flex a_center j_center" id="valider" title="Comptes a valider">
                                   <i class="fas fa-user-check center_transform"></i>
                                   <span class="small_bottom_txt">à valider</span>
                             </div>
                             <div class="item section  flex a_center j_center" id="rendez_vous2" title="Rendez-vous">
                                    <i class="fas fa-business-time center_transform"></i>
                                    <span class="small_bottom_txt">Rendez-vous</span>
                             </div>
                             <div class="item section  flex a_center j_center" id="récolte_s" title="Récoltes">
                                    <i class="fas fa-tractor center_transform"></i>
                                    <span class="small_bottom_txt">Récoltes</span>
                             </div>

                             <?php if(have_full_acces($_SESSION['office_id'])){
                               echo '<div class="item section  flex a_center j_center" id="products" title="Produits">
                                        <img src="../img/wheat.png" alt="" class="center_transform">
                                        <span class="small_bottom_txt">Produits</span>
                                    </div>';
                              }
                             ?>
                             <div class="item section  flex a_center j_center" id="facture" title="Factures">
                             <i class="fas fa-hand-holding-usd center_transform"></i>
                                    <span class="small_bottom_txt">Factures</span>
                             </div>
                             <div class="item section  flex a_center j_center" id="newslater" title="Newslatter">
                                        <i class="fas fa-envelope-open-text center_transform"></i>
                                        <span class="small_bottom_txt">Newslatter</span>
                             </div>
                                 
                             <div class="item  section flex a_center j_center" id="parametre" title="Paramètres">
                                        <i class="fas fa-user-cog center_transform"></i>
                                        <span class="small_bottom_txt">Paramètres</span>
                             </div>
                              
                            <a href="action/logout.php" class="item  flex a_center j_center log_out_link" title="Déconnexion">
                                    <i class="fas fa-sign-out-alt center_transform"></i>
                                    <span class="small_bottom_txt">Déconnexion</span>
                            </a> 
                             
                          
                    </div>
                    <div class="item2 flex d_column large_item">
                        <div class="nav_dash flex  j_center a_center ">
                                  
                                  
                                  <form action="" method="POST" class="flex j_center a_center">
                                   
                                  <?php if(have_full_acces($_SESSION['office_id']))
                                  {
                                          echo ' <input type="search"  class="search" placeholder="Rechercher des membres et offices" >';
                                  }
                                  else
                                  {
                                          echo ' <input type="search"  class="search" placeholder="Rechercher des membres" >';
                                  }
                                 ?>                                     
                                      <label for="search"><i class="fas fa-search"></i> </label>
                                      <input type="submit" value="" id="search" hidden>

                                  </form>
                                   <span>office <?php echo $nom." ".$wilaya; ?>   </span>

                    </div>
                    <div class="search_r"></div>
                    <div class="output">

                      <div class="flex j_center a_center d_column Dashboard special hidden">

                                 <span class="a_title">Dashboard</span>
                                 <div class="carts  s_width flex j_between a_center  ">
                    
                                        <div class="cart flex j_center a_center users_c click_member">
                                                <i class="fas fa-user fa-4x"></i>
                                                <div class="fact flex j_between a_center d_column">
                                                        <span class="number r_users"></span>
                                                        <span class="d_text">  Agriculteurs Inscrits</span>
                                                </div>
                                        </div>
                                        <div class="cart flex j_center a_center valid click_valid">
                                                <i class="fas fa-user-check fa-4x"></i>
                                                <div class="fact flex j_between a_center d_column">
                                                        <span class="number invalid"></span>
                                                        <span class="d_text">  Comptes à validés </span>
                                                </div>
                                        </div>
                                        <div class="cart flex j_center a_center rendez_vous click_r_v">
                                                <i class="fas fa-business-time fa-4x "></i> 
                                                <div class="fact flex j_between a_center d_column">
                                                        <span class="number r_v_pris"></span>
                                                        <span class="d_text">  Rendez-vous</span>
                                                </div>
                                        </div>
                                        <div class="cart flex j_center a_center recolte click_recolte">
                                                <i class="fas fa-tractor fa-4x"></i>
                                                <div class="fact flex j_between a_center d_column">
                                                        <span class="number count_recolte"></span>
                                                        <span class="d_text">  Récoltes enregistrés</span>
                                                </div>
                                        </div>
                    
                                  </div>
                                  <!-- <span class="a_title">Graphe de récoltes</span> !-->
                                  <div class="recoltes_chart_container my_chart_container s_width flex j_center a_center d_column">                               
                                                <span class="flex chart_title">Graph des récoltes par mois Année 
                                                      <select class="chart_year">
                                                           <?php   echo all_available_years();//all availabel years ?>
                                                      </select>
                                                </span>
                                                <canvas id="myChart"  ></canvas>
                                  </div>
                                  <div class="recoltes_chart_container my_chart_money_container s_width flex j_center a_center d_column ">                               
                                                <span class="flex">Graph de Revenu mensuel Année 
                                                      <select class="chart_year_money">
                                                             <?php   echo all_available_years();//all availabel years ?>
                                                      </select>
                                                </span>
                                                <canvas id="myChart_money"  ></canvas>
                                  </div>
                                  <?php  if(have_full_acces($_SESSION['office_id']))
                                         {
                                                echo '

                                                <div class="recoltes_chart_container s_width flex j_center a_center d_column my_chart_doughnut_container">                               
                                                        <span class="flex c_span_ch">Graph des récoltes par wilaya Année :  
                                                        <select class="chart_year_wilayas">';
                                                            echo all_available_years();//all availabel years
                                                      echo '</select>
                                                        </span>
                                                        <canvas id="myChart_wilayas" ></canvas>
                                                     
                                                 </div>        
                                                
                                                ';
                                         }
                                  ?>                                
                      </div>
                    
                       
                      <div class=" accounts special flex d_column  j_center a_center hidden">
                                    <span class="a_title">Membres</span>
                                    <!--     all member  -->
                                    <div class="o_accounts flex j_center a_center "></div>
                                      <!--     all offices if user is allowed to si them  -->  
                                        <?php  if(have_full_acces($_SESSION['office_id'])) 
                                            echo'     <span class="a_title">Offices</span>
                                                 <div class="o_accounts_offices flex j_center a_center ">
                                                
                                                   
                                                 
                                                </div>'
                                        ?>
                                        <span class="a_title">Ajouter un Agriculteur</span>
                                        <i class="fas fa-folder-plus fa-4x add_member"></i>

                                        <?php  if(have_full_acces($_SESSION['office_id'])) 
                                            echo'<span class="a_title">Ajouter un office admin</span>
                                                   <i class="fas fa-folder-plus fa-4x" onclick="show_add_admin_form()"></i>
                                                ';
                                        ?>

                        </div>
                        <!--     validate accounts  -->
                        <div class=" valider special flex d_column  j_center a_center hidden ">
                            <span class="a_title">Agriculteurs à valider</span>
                            <div class="o_accounts_invalid flex a_center j_center"></div>
                            <div class="o_accounts_invalid_office flex a_center j_center d_column"> </div>


                         </div>   

                        <!--     récolte list  -->
                        <div class="récolte_s special flex d_column j_center a_center hidden ">
                                            <span class="a_title"> Récoltes des membres</span>
                                            <?php  if(office_have_recolte($_SESSION['office_id'])) 
                                                        {
                                                                require 'action/sort_option.php';
                                                        }
                                                    else
                                                        {
                                                            echo ' <span class="empty_result">vous n\'avez pas des récoltes encore</span>';
                                                        }
                                             ?>
                                             <!--   récoltes list ordred by date  -->
                                             <div class="o_récolte flex a_center d_column j_center"></div>
                                             <!--   récoltes liste group by year  -->
                                             <div class="a_récolte flex a_center d_column j_center"> </div>
                                             <!--   récoltes liste group by wilayas  -->
                                             <div class="w_récolte flex a_center d_column j_center">
                                             <?php  if(have_full_acces($_SESSION['office_id'])) 
                                                                {
                                                                    echo '<div class="a_title">Récoltes par wilaya Année   
                                                                                        <select class="s_years_wilayas">';
                                                                                        echo  all_available_years('current_year_selected');
                                                                     echo' </select></div>';
                                                                 }
                                                        ?>
                                                        <div class="r_wilayas_t flex a_center d_column j_center">
                                                               
                                                        </div>
                                                        
                                             </div>
                        </div>                    
                         <!--   factures  -->
                        <div class="facture special flex d_column j_center a_center hidden">
                                      <span class="a_title">Factures enregistrés </span>
                                      <div class="o_accounts_factures flex a_center j_center d_column"></div>
                                      <span class="a_title">Ajouter une facture</span>
                                      <i class="fas fa-folder-plus fa-4x add_facture"></i>

                        </div>
                          <!--   newslatter  -->

                         <div class="newslater special flex d_column j_center a_center hidden">
                                                    <span class="a_title">Ajouter une Newsletter</span>
                                                    <i class="fas fa-folder-plus fa-4x add_newslatter"></i>

                          </div>
                           <!--     products   -->
                          <div class="products special flex j_center a_center d_column hidden">
                                        <div class="product_items flex j_center a_center d_column"></div> 
                                        <span class="a_title">Ajouter un produit</span>
                                        <i class="fas fa-folder-plus fa-4x add_product"></i>           
                           </div>
                         <!--     account settings   -->
                          <div class=" parametre special flex d_column  j_center a_center hidden">
                                
                                <div class="p_from_ajax flex d_column  j_center a_center">
                                        
                                </div>

                           <!--     <div class="s_small flex j_center a_center s_s_small">

                                        <div class="theme flex j_center a_center d_column">
                                                <i class="fas fa-palette resize "></i>
                                                <span class="togle ">changer le thème</span>
                                        </div>

                                </div>
                             -->
                          </div>

                              
                         <div class=" rendez_vous2 special flex d_column  j_center a_center hidden ">
                                
                           
                                <div class="r_output2 flex j_center a_center d_column"> </div>   
      
                                <div class="r_output flex j_center a_center d_column"> </div>   
                                <span class="a_title add_r">Ajouter un Redez-vous</span>

                                 <i class="fas fa-folder-plus fa-4x add_rendez_vous"></i>
                                               
                         </div>
                                  
                    </div> 
                    </div>

                    <div class='succes_valid s_updated  hidden'>  </div>
                </div>
                
               
                <div class="cover_all">
                           <!--  add rendez-vous -->
                           <div class="add_r_f flex j_center a_center d_column">
                                  <i class="fas fa-times exit_r" onclick="hide_add_rendez_form_form()"> </i>
                                  <form   class="add_r_v_f flex d_center a_center d_column">
                                  </form>
                            </div>
                           <!--  add memeber -->
                           <div class="flex j_center a_center d_column" id="add_member">        
                                <form action="" class="flex j_center a_center add_member_form">
                                    
                                </form>
                           </div>
                           <!--  add add recolte -->
                           <div class="add_recolte flex j_center a_center"> 
                               <form  class="flex  add_recolte_form">
                                 
                               </form>
                           </div>
                           <!--  add facture -->
                           <div class="flex j_center a_center d_column" id="add_facture">
                                 <div   class="add_facture_next flex d_center a_center d_column" id="add_facture_form"> </div>
                           </div>
                            <!--  add admin -->
                            <div class="flex j_center a_center d_column" id="add_office_admin">
                                 <div   class="add_facture_next flex d_center a_center d_column" id="add_office_admin_form"> </div>
                           </div>
                           <!--  add newslatter -->
                           <div class="flex j_center a_center d_column" id="add_news_latter">
                                 <form class="flex j_center a_center d_column add_news_latter_form">  </form>
                           </div>
                           <!--  update product -->
                           <div class="flex j_center a_center d_column"  id="update_product">
                                      <form  class="flex j_center a_center" id="update_product_form">  </form>
                           </div>
                           <!--  show_profile -->  
                           <div class="profile_container flex j_center a_center" >
                              <div class="profile  flex d_column ">   </div>
                           </div>


                           
                </div>


                
                <script src="../js/jquery-3.4.1.min.js?v=<?php echo time(); ?>"></script>
                <script src="../js/error_handling.js?v=<?php echo time(); ?>"></script>
                <script src="../js/member_ajax.js?v=<?php echo time(); ?>"></script>
                <script src="../js/validate_account_ajax.js?v=<?php echo time(); ?>"></script>
                <script src="../js/Appointement_office_ajax.js?v=<?php echo time(); ?>"></script>
                <script src="../js/harvest_office_ajax.js?v=<?php echo time(); ?>"></script>
                <script src="../js/facture_ajax.js?v=<?php echo time(); ?>"></script>
                <script src="../js/products_ajax.js?v=<?php echo time(); ?>"></script>
                <script src="../js/newslatter_ajax.js?v=<?php echo time(); ?>"></script>
                <script src="../js/account_settings_office_ajax.js?v=<?php echo time(); ?>"></script>
                <script src="../js/dashboard_ajax_call.js?v=<?php echo time(); ?>"></script>
                <script src="../js/Dashboard.js?v=<?php echo time(); ?>"></script>
                <script src="../js/jspdf.min.js?v=<?php echo time(); ?>"></script>
                <script src="../js/facture_generator_ajax.js?v=<?php echo time(); ?>"></script> 
                <script src="../js/radio_change_event.js?v=<?php echo time(); ?>"></script>
                <script src="../js/route_generator.js?v=<?php echo time(); ?>"></script>
                <script src="../js/chart_generator_ajax.js?v=<?php echo time(); ?>"></script>
                
                <?php  if(have_full_acces($_SESSION['office_id']))
                        {
                                echo '<script src="../js/Doughnut_chart_generator.js?v='.time().'" type="module"></script>';
                                echo '<script src="../js/harvest_wilayas.js?v='.time().'"></script>';   
                        }
                                      
                ?>
                <script src="../js/Chart.bundle.js"></script>
                <script src="../js/side_bar_animation.js?v=<?php echo time(); ?>"></script>

         
</body>
</html>
