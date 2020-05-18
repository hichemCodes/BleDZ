<?php
       
        session_start();

        require 'connect_db.php';
        require 'query.php';

        office_auth();


         $all_accounts = $db->prepare("SELECT * FROM users INNER JOIN agriculteurs on users.id= agriculteurs.user_id AND  users.id=? AND users.wilaya_id = ? ");
         $all_accounts->execute([$_POST['id'],$_SESSION['wilaya_id']]);
        
        
          
             if( $all_accounts->rowCount() > 0)
             {
                  
               
               $user = $all_accounts->fetch(PDO::FETCH_ASSOC);
               if(has_avatar($user['id'])){

                    $avatar = '<img src="../users_avatar/'.find_avatar($user['id']).'" class="user_img3">';
               }
               else
               {
                     $avatar = '<i class="fas fa-user fa-5x"></i>';
               }


               $data['result'] =   '
                 
               <i class="fas fa-times" onclick="exit_profile()"></i>
                 <div class="p_header flex j_center a_center">
                
                 <i class="fas fa-user"></i>
                 <span>'. $user['nom']. " " . $user['prenom'].'</span>
                 
                 </div>
                 <div class="p_body flex j_between a_center">
                    <div class="information flex d_column custum_info_profile">
                               <div class="i_item flex  j_between a_center">
                               <i class="fas fa-at "></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">E-mail</span>
                                           <span class="i_result"> '. $user['email'] .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                                    <i class="fas fa-user"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Nom et Prénom</span>
                                           <span class="i_result">'.  $user['nom'].' ' .$user['prenom'] .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                               <i class="fas fa-id-card"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Numéro de carte </span>
                                           <span class="i_result"> '. $user['num_de_carte'] .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                               <i class="fas fa-city"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Wilaya</span>
                                           <span class="i_result">'. getWilaya($user['wilaya_id']) .'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                                   <i class="far fa-clock"></i>
                                          <div class="second_part flex d_column">
                                                 <span class="holder">Date d\'inscription</span>
                                                 <span class="i_result">'. generate_date($user['created_at']) .'</span>
                                          </div>
                                   </div>
                              </div>
                   <div class="e_avatar flex j_center a_center d_column">
                      <div class="old_avatar first_avatar flex j_center a_center ">
                    '. $avatar .'
                      </div>
                      
                   </div>
                 </div>
                 
              
      ';
                         
              
             }

            else{
              
                    $data['result'] = "fail";
                    $dat['err'] = '<i class="fas fa-times" onclick="exit_profile()"></i>
                           <span> vous avez pas le droit de voir ce compte !  </span>';
              
             }

             echo json_encode($data);
           
            
        
?>