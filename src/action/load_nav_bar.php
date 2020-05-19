



<div class="nav_child flex j_start a_center">
            <a href="" class="logo"><img src="../img/logo.png" alt=""></a>
            <ul class="flex j_around linked_target">
              <a href="Appointement.php" >  <li id="acceuil">Rendez-vous </li>  </a> 
              <a href="harvest.php" >  <li id="acceuil"> récoltes </li>  </a> 
              <a href="profile.php" >  <li id="acceuil"> profil </li>  </a> 
             
                
            </ul>
            <div class="avatar_container flex j_center a_center" onclick="show_pop_up()">
             
            <?php  if(!has_avatar($_SESSION['agr_id'])){  ?>
           
            <div class="avatar_d flex j_center a_center "> 
            <i class="fas fa-user "></i>
            </div>
            <?php  } else {   ?>
                <img src="../users_avatar/<?php echo find_avatar($_SESSION['agr_id']);   ?>" class="user_img2">  <?php }    ?>
              
            
           
            </div>
</div>