
<div class="profile_container my_profile_c flex j_center a_center">
                            <div class="profile flex d_column ">
                              <div class="p_header flex j_center a_center">
                              <a href="account_setting.php">
                              <i class="fas fa-pencil-alt"></i>
                              <span>Modifier</span>
                              </a>
                              </div>
                              <div class="p_body flex j_between a_center">
                                 <div class="information flex d_column ">
                                            <div class="i_item flex  j_between a_center">
                                            <i class="fas fa-at "></i>
                                                 <div class="second_part flex d_column">
                                                        <span class="holder">E-mail</span>
                                                        <span class="i_result"><?php echo  $email; ?> </span>
                                                 </div>
                                            </div>
                                            <div class="i_item flex  j_between a_center">
                                                 <i class="fas fa-user"></i>
                                                 <div class="second_part flex d_column">
                                                        <span class="holder">Nom et Prénom</span>
                                                        <span class="i_result"><?php echo  $nom .' '.$prenom; ?> </span>
                                                 </div>
                                            </div>
                                            <div class="i_item flex  j_between a_center">
                                            <i class="fas fa-id-card"></i>
                                                 <div class="second_part flex d_column">
                                                        <span class="holder">Numéro de cart </span>
                                                        <span class="i_result"><?php echo  $carte; ?> </span>
                                                 </div>
                                            </div>
                                            <div class="i_item flex  j_between a_center">
                                            <i class="fas fa-city"></i>
                                                 <div class="second_part flex d_column">
                                                        <span class="holder">Wilaya</span>
                                                        <span class="i_result"><?php echo  $wilaya; ?> </span>
                                                 </div>
                                            </div>
                                 </div>
                                <div class="e_avatar flex j_center a_center d_column">
                                
                               
                                   <div class="old_avatar <?php  if(!has_avatar($_SESSION['agr_id'])){echo ' first_avatar ';}   ?>flex j_center a_center ">
                                   <?php  if(!has_avatar($_SESSION['agr_id'])){ 
                                           
                                                               ?>
                                                        <i class="fas fa-user fa-5x"></i> 
                                   <?php } else {   ?>
                                     <img src="../users_avatar/<?php echo find_avatar($_SESSION['agr_id']);   ?>" class="user_img">  <?php }    ?>
                                   </div>
                                   <div class="p_name"><?php echo $nom.' '.$prenom; ?></div>
                                     <form action="" method="POST" enctype="multipart/form-data" class="update_a">
                                             <label for="file" class="flex d_center a_center">
                                             <i class="fas fa-camera "></i>
                                             </label>
                                             <input type="file"  id="file" name="file" hidden>
                                             <label for="n_avatar"></label>
                                             <input type="submit" id="n_avatar" name="update_avatar" value="modifier" hidden>
                                     </form>
                                </div>
                              </div>
                              
                            </div>
                  </div>