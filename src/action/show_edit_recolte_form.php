<?php

session_start();

require 'query.php';

office_auth();

// find harvest information

$harvest = harvest_information($_POST['harvest_id']);

$output = '
                          <i class="fas fa-times" onclick="hide_edit_recolte_form()"> </i>
                          
                          <div class="f_item flex d_center a_center d_column custum_f_item">
                                <label for="produit" class="form-label">Produit </label>
                               
                                <select  id="produit">
                                <option value="0" disabled>Selectionner le produit</option>';
                                     

                                     $all_product = all_product();
                                          foreach($all_product as $product)
                                          {
                                              if($product['code'] == $harvest['produit_code'])
                                              {
                                                  $output = $output. '<option value="'.$product['code'].'" selected>'.$product['description'].'</option>';
                                              }
                                              else
                                              {
                                                  $output = $output. '<option value="'.$product['code'].'">'.$product['description'].'</option>';      
                                              }

                                          } 
                                                   
                                                    
                                $output = $output. '</select>
                                
                                <img src="../img/wheat2.png" alt="" class="custum_icon_form">
                          </div>
                          <div class="f_item flex d_center a_center d_column">
                                <label for="poids_entré" class="form-label">Poids d\'entré en Tonne</label>
                                <input type="text" id="poids_entré" value="'. $harvest['poids_entré']. '"required>
                                <i class="fas fa-balance-scale-right"></i>
                          </div>
                          <div class="f_item flex d_center a_center d_column">
                                <label for="poids_sortie" class="form-label"> Poids de sortie en Tonne </label>
                                <input type="text" id="poids_sortie" value="'. $harvest['poids_sortie']. '" required>
                                <i class="fas fa-balance-scale-right"></i>
                          </div>
                          <div class="f_item flex d_center a_center d_column custum_f_item">

                                <label for="qualité" class="form-label">Qualité </label>
                                <select  id="qualité" required>

                                    <option value="0" disabled selected >Selectionner la qualité</option>

                                </select>
                              
                                <i class="fas fa-key "></i>
                          </div>
                          <div class="f_item flex d_center a_center d_column">
                                <label for="matricule_v" class="form-label"> Matricule du véhicule </label>
                                <input type="text" id="matricule_v" value="'. $harvest['matricule']. '" required>
                                <i class="fas fa-tractor"></i>
                          </div><div class="f_item flex d_center a_center d_column">
                                <label for="marque_v" class="form-label">Marque du véhicule </label>
                                <input type="text" id="marque_v" value="'. $harvest['marque']. '" required>
                                <i class="fas fa-tractor"></i>
                          </div><div class="f_item flex d_center a_center d_column">
                                <label for="n_p_chauf" class="form-label">Nom et prénom du chauffeur </label>
                                <input type="text" id="n_p_chauf" value="'. $harvest['nom_de_chauffeur']. '" required>
                                <i class="fas fa-user"></i>
                          </div>
                           <div class="f_item flex d_center a_center d_column">
                                <label for="n_permis" class="form-label">Numéro de permis </label>
                                <input type="text" id="n_permis" value="'. $harvest['num_de_permis']. '" required>
                                <i class="fas fa-id-card"></i>
                          </div>
                          
                          <div class="f_item flex d_center a_center d_column">
                               
                                <input type="submit" id="sub_r" value="Modifier">
                          </div>


                        

';

echo $output;