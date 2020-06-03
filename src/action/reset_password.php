<?php

  require 'query.php';
  require 'connect_db.php';
  require 'validate_fields.php';


  if($_POST['action'] == 'show')
  {
         $output = '

         <img src="../img/logo.png" alt="">
         <!--  <span>Se Connecter</span>   -->  
           <form  class="flex d_column j_end reset_password_final">
                   <div class="item">
                           <i id="icmail"class="fas fa-at icmail"></i>
                           <input type="text" id="code_reset"  placeholder="écrivez le code que vous avez recu" required> 
                           <span class="border"> <i></i></span>    
                   </div>
                   <div class="err er_code"></div>
                   <div class="item">
                           <i id="i_pass1"class="fas fa-key i_pass1"></i>
                           <input type="password" id="pass1_reset"  placeholder="votrez nouveau mot de pass" required>
                           <span class="border"> <i></i></span>     
                   </div>
                   <div class="err er_pass1"></div>
                   <div class="item">
                           <i id="i_pass2"class="fas fa-key i_pass2"></i>
                           <input type="password" id="pass2_reset"  placeholder="confirmation du mot de passe" required>    
                           <span class="border"> <i></i></span> 
                   </div>
                   <div class="err er_pass2"></div>
                   <div class="err"></div>
                   <input type="submit" id="custum_submit" name="connexion" value="Suivant" class="submit ">
           </form>
                 ';
  
                 echo $output;
}
  else
  {
        $code = $_POST['code'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $email = $_POST['email'];

        $pass1_hash = password_hash($pass1,PASSWORD_DEFAULT);
        $pass2_hash = password_hash($pass2,PASSWORD_DEFAULT);

        /// chek if the code match the code sended previosly

        if(reset_code_matches($email,$code))
        {
                if(validate_password($pass1))
                {
                            if (password_equals($pass1,$pass2))
                            {
                                  // update the password 
                                  $u_password = $db->prepare("UPDATE users SET mot_de_passe = ?,mot_de_passe_confirmation = ? 
                                                                WHERE email = ?");
                                  $u_password->execute([$pass1_hash,$pass2_hash,$email]); 
                                            
                                   $data['success'] = 'mot de passe chnagé avec succsé orientation vers la page de connexion dans ';               
                            }
                            else
                            {
                                $data['pass_n_m'] = 'les mots de passe ne sont pas identiques';
                            }
                }
                else
                {
                        $data['pass_inv'] = 'le mot de passe doit comporter au moins 8 caractères dont une lettre majuscule et une lettre minusculle et un chiffre !';
                }
        }
        else
        {
                $data['code_inv'] = 'le code de confirmation est incorrect';
        }

        echo json_encode($data);
        
  }

  

?>