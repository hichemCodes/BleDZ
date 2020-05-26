



<div class="p_logo  flex j_center a_center">
        <?php  if(!has_avatar($_SESSION['agr_id'])){  ?>
              <i class="fas fa-user fa-2x"></i>
              <?php  } else {   ?>
                <img src="../users_avatar/<?php echo find_avatar($_SESSION['agr_id']);   ?>" class="user_img3">  <?php }    ?>
        </div>
        <span class="p_name"><?php echo $nom .' '.$prenom; ?></span>
        <span class="silver p_email"> <?php echo $email ?> </span>
        <div class="option flex d_column j_center a_center">
                    <a href="account_setting.php" class="flex j_center a_center">
                        <div class="a_inside s_width flex  a_center ">
                        <i class="fas fa-user-cog"></i>
                        <span>Paramètres</span>
                        </div>
                    
                        
                    </a>
                    <a href="action/logout.php" class="flex j_center a_center">
                        <div class="a_inside s_width flex  a_center ">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Déconnexion</span>
                        </div>
                    
                       
                    </a>
        </div>