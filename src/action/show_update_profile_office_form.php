<?php

session_start();

$output =  '
                                <span class="a_title">Mon compte</span>
                                 <div class="s_small">
                                 <form  class="flex update_ofice">
                                       
                                        <div class="line flex d_column  j_center a_center m_bottom">
                                            <label for="">Nom</label>
                                            <input class="normal_input" type="text" id="u_name"  value="office du blé '.$_SESSION['nom'].'" title ="vous pouvez pas cahnger votre nom" readonly>
                                            
                                        </div>
                                        <div class="line flex d_column j_center a_center m_bottom">
                                            <label for="">Email</label>
                                            <input class="normal_input" type="email"  id="u_mail" value="'.$_SESSION['email'].'">
                                            
                                        </div>
                                        <div class="line flex d_column j_center a_center">
                                            <label for="">Numéro de téléphone</label>
                                            <input class="normal_input" type="text"  id="u_mob" value="';
                                             if($_SESSION['phone'] != "") {  $output = $output.''.$_SESSION['phone'].'"';}
                                             else{ $output = $output.'"'; }
                                             $output = $output.' required>
                                           
                                        </div>
                                        <div class="line flex d_column j_center a_center">
                                            <label for="">Mot de passe </label>
                                            <input class="normal_input" id="u_pass" type="password"  required >
                                            
                                        </div>
                                        <label for="edit" class=" flex j_center a_center edit" title="modifier les information">
                                            
                                              <div class="flex j_center a_center">
                                              <i class="fas fa-pencil-alt"></i> 
                                            <input id="edit" type="submit" hidden >
                                              </div>
                                        </label>   
                                         
                                            
                                        </form>   
                                        <form   class="flex update_ofice_pass">
                                       
                                        <div class="line flex d_column  j_center a_center m_bottom">
                                            <label for="old_pass">Ancien mot de passe</label>
                                            <input class="normal_input" type="password" id="old_pass" required>
                                            
                                        </div>
                                        <div class="line flex d_column j_center a_center m_bottom">
                                            <label for="new_pass">Nouveau mot de passe </label>
                                            <input class="normal_input" type="password"  id="new_pass" required>
                                            
                                        </div>
                                        <div class="line flex d_column j_center a_center">
                                            <label for="new_pass_conf">Nouveau mot de passe </label>
                                            <input class="normal_input" type="password"  id="new_pass_conf" required>
                                            
                                        </div>
                                       
                                        <label for="edit_pass" class=" flex j_center a_center edit" title="modifier le  mot de passe">
                                            
                                              <div class="flex j_center a_center">
                                              <i class="fas fa-pencil-alt"></i> 
                                            <input id="edit_pass" type="submit" value="'.  $_SESSION['id'].'" hidden >
                                              </div>
                                        </label>   
                                         
                                            
                                        </form>   
                                        </div>

                                        <span class="a_title">modifier le théme</span>

                                   


';
 

echo $output;
                          
?>  
