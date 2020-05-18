<?php
 session_start();
 
 require 'query.php';
 require 'load_all_session.php';
 

              $output =  '<form  action="" class="flex edit_form">
                                       
                                       <div class="line flex d_column  j_center a_center m_bottom">
                                           <label for="">Nom et Prenom</label>
                                           <input class="normal_input" id="np" type="text"   value="'. $nom .' '.$prenom.'" readonly>
                                           
                                       </div>
                                       <div class="line flex d_column j_center a_center m_bottom">
                                           <label for="">Email</label>
                                           <input class="normal_input" type="email" id="email_u"   value="'.$email.'" required>
                                           
                                       </div>
                                       <div class="line flex d_column j_center a_center">
                                           <label for="">Numéro de carte</label>
                                           <input class="normal_input" id="cart" type="text" value="'.$carte.'"  readonly >
                                          
                                       </div>
                                       <div class="line flex d_column j_center a_center">
                                           <label for="">Mot de passe </label>
                                           <input class="normal_input" id="pass_u" type="password" required >
                                           
                                       </div>
                                       <div class=" flex j_center a_center edit" title="modifier les informations">
                                            <label for="edit" id="update_label" class="flex j_center a_center"> 
                                                <i class="fas fa-pencil-alt"></i> 
                                            </label>
                                                <input id="edit" type="submit" hidden >
                                                    
                                       </div>
                                           
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
                        
                         
                         <div class=" flex j_center a_center edit" title="modifier le  mot de passe">
                                            <label for="edit_pass" id="update_label" class="flex j_center a_center"> 
                                                <i class="fas fa-pencil-alt"></i> 
                                            </label>
                                                <input id="edit_pass" type="submit" hidden >
                                                    
                         </div>  
                          
                             
                         </form>';

echo $output;