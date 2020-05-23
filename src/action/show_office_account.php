<?php
       

        require 'connect_db.php';
          require 'query.php';


         session_start();

        $office = $db->prepare("SELECT * FROM users INNER JOIN offices on users.id= offices.user_id AND  users.id=?  ");
        $office->execute([$_POST['user_id']]);
        
        

        
            
             if( $office->rowCount() > 0)
             {
                  
                $user = $office->fetch(PDO::FETCH_ASSOC);
                
                $phone_n = ($user['num_telephone'] == null) ? '/' : $user['num_telephone'];


                $output =   '
              
               <i class="fas fa-times" onclick="exit_profile()"></i>
                 <div class="p_header flex j_center a_center">
                
                 <i class="fas fa-user"></i>
                 <span>'. $user['nom']. '</span>
                 
                 </div>
                 <div class="p_body flex j_between a_center">
                    <div class="information flex d_column c_o_info">
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
                                           <span class="holder">Nom</span>
                                           <span class="i_result">'.  $user['nom'].'</span>
                                    </div>
                               </div>
                               <div class="i_item flex  j_between a_center">
                               <i class="fas fa-id-card"></i>
                                    <div class="second_part flex d_column">
                                           <span class="holder">Numéro de téléphone </span>
                                           <span class="i_result"> '. $phone_n  .'</span>
                                    </div>
                               </div>
                              
                          </div>


                          <div class="information flex d_column c_o_info">

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
                               
                    </div>
                   
                 </div>
                 
               
      ';
               
               
               echo $output;
             }

            else{
              
                    echo "fail";
              
             }
           
            
        
?>