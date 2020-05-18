<?php


echo '

                              <i class="fas fa-times" onclick="hide_add_member_form()"> </i>
                          
                          <div class="f_item flex d_center a_center d_column">
                                <label for="nom_m" class="form-label">Nom </label>
                                <input type="text"  id="nom_m" >
                                <i class="fas fa-user "></i>

                          </div>
                          <div class="f_item flex d_center a_center d_column">
                                <label for="prenom_m" class="form-label">Prénom </label>
                                <input type="text"  id="prenom_m" >
                                <i class="fas fa-user "></i>
                          </div>
                          <div class="f_item flex d_center a_center d_column">
                                <label for="email_m" class="form-label"> Email </label>
                                <input type="email"  id="email_m" >
                                <i id="icmail" class="fas fa-at "></i>
                          </div>
                          <div class="f_item flex d_center a_center d_column">
                                <label for="pass_m" class="form-label">Mot de passe  </label>
                                <input type="password"  id="pass1_m" >
                                <i class="fas fa-key "></i>
                          </div>
                          <div class="f_item flex d_center a_center d_column">
                                <label for="pass2_m" class="form-label">Mot de passe confirmation </label>
                                <input type="password"  id="pass2_m" >
                                <i class="fas fa-key "></i>
                          </div>
                          <div class="f_item flex d_center a_center d_column">
                                <label for="num_m" class="form-label">Numéro de carte </label>
                                <input type="text"  id="num_m" >
                                <i class="fas fa-id-card "></i>
                          </div>
                          <div class="f_item flex d_center a_center d_column">
                               
                                <input type="submit"  id="sub_m" value="Ajouter">
                          </div>


                         
';

?>