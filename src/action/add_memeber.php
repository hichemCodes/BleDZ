

<?php
session_start();

require 'connect_db.php';
  
require 'validate_fields.php';


if(!empty($_POST['nom'])&& !empty($_POST['prenom']) &&
!empty($_POST['email']) && !empty($_POST['pass1']) && !empty($_POST['pass2']) && $_POST['carte'] )
{

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $pass1 =$_POST['pass1'];
    $pass2 =$_POST['pass2'];
    $n_cart = $_POST['carte'];
   

    if(validate_nom($nom)){
        if(validate_prenom($prenom)){
        if( validate_email($email)){
            if(validate_password($pass1)){
                if(password_equals($pass1,$pass2)){
                    if(validate_cart($n_cart)){
                                             // tous les champ sont valide 
                                             $v_nom = filter_var($nom,FILTER_SANITIZE_STRING);
                                             $v_prenom = filter_var($prenom,FILTER_SANITIZE_STRING);
                                             $v_email = filter_var($email,FILTER_SANITIZE_EMAIL);
                                             $pass1_hash = password_hash($pass1,PASSWORD_DEFAULT);
                                             $pass2_hash = password_hash($pass2,PASSWORD_DEFAULT);
                                             $v_cart = $n_cart;

                                             $nom_prenom = $v_nom.' '.$v_prenom;
                                             //// user already exist test 

                                            if(!(user_already_exist($v_email,$v_cart,$nom_prenom))){
                                                    
                                                $new_user = $db->prepare("INSERT INTO users
                                                 (email,mot_de_passe,mot_de_passe_confirmation,is_verified,wilaya_id,profile_id) VALUES (?,?,?,?,?,?)");
                                                  $new_user->execute([$v_email,$pass1_hash,$pass2_hash,1,$_SESSION['wilaya_id'],2]);
                                                        // inserer dans la table agriculteur

                                                        $user_id = find_id($v_email);
                                                 $new_agr = $db->prepare("INSERT INTO agriculteurs
                                                 (nom,prenom,num_de_carte,user_id) VALUES (?,?,?,?)");
                                                 $new_agr->execute([$v_nom,$v_prenom,$v_cart,$user_id]);

                                                    $data['result'] =  "success";

                                                 }
                        else{
                                        
                                        if(email_already_exist($v_email) && cart_already_exist($v_cart))
                                        {
                                            $data['result'] ='l\'email et la carte existent déjà';
                                            
                                        }
                                        else if( email_already_exist($v_email) && !(cart_already_exist($v_cart)) )
                                        {
                                            $data['result'] ='ce email existe déjà ';
                                        }
                                        else if( !email_already_exist($v_email) && (cart_already_exist($v_cart)) )
                                        {
                                            $data['result'] ='cette carte existe déjà';
                                        }
                                        else
                                        {
                                            $data['result'] = "le nom et le prénom existent déjà";
                                        }

                            }
                             }
                     else{
                            
                            $data['result'] =  "le numéro de carte est incorrect !";
                         }
                         }     
                else{
                       
                        $data['result'] =  "la conformation du mot de passe doit être identique !";
                         }                           
                    }
             else{
                     $data['result'] =  "le mot de passe doit comporter au moins 8 caractères dont une lettre majuscule et une lettre minusculle et un chiffre !";

                    }
                }
        else{
             
             $data['result'] =  "email incorrect !";

             }
        }
      else{
            
            $data['result'] =  "le prénom doit comporter au moins 3 lettres !";
        }
    }
    else{
       
        $data['result'] =  "le nom doit comporter au moins 3 lettres !";
    }
}
else{
   
    $data['result'] =  "tous les champs doivent être remplis !";
}

   echo json_encode($data);
?>