<?php

    require 'connect_db.php';
    require 'validate_fields.php';

if($_POST['type']  == 'agriculteur')
{
    if(!empty($_POST['nom'])&& !empty($_POST['prenom']) &&
    !empty($_POST['email']) && !empty($_POST['pass1']) && !empty($_POST['pass2']) && !empty($_POST['n_cart']) && !empty($_POST['wilaya']) )
    {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $pass1 =$_POST['pass1'];
        $pass2 =$_POST['pass2'];
        $n_cart = $_POST['n_cart'];
        $wilaya = $_POST['wilaya'];

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
                                                 $v_wilaya = filter_var($wilaya,FILTER_SANITIZE_STRING);
                                                
                                                 //// tester si le compte d'agriculteur est déja existe 
                                                if(!(user_already_exist($v_email,$v_cart))){
                                                        
                                                        $new_user = $db->prepare("INSERT INTO users
                                                        (email,mot_de_passe,mot_de_passe_confirmation,wilaya_id,profile_id) VALUES (?,?,?,?,2)");
                                                        $new_user->execute([$v_email,$pass1_hash,$pass2_hash,$v_wilaya]);


                                                        // insérer dans la table agriculteur
                                                        $user_id = find_id($v_email); // récupurer le id d'agriculteur déja inscrit dans la table users
                                                        $new_agr = $db->prepare("INSERT INTO agriculteurs
                                                        (nom,prenom,num_de_carte,user_id) VALUES (?,?,?,?)");
                                                        $new_agr->execute([$v_nom,$v_prenom,$v_cart,$user_id]);
    
                                                        $data['result'] = 'success';
                                                     }
                            else{
                                if(email_already_exist($v_email) && cart_already_exist($v_cart))
                                {
                                    $data['result'] ='ce email existe déja ';
                                    $data['result'] ='cette carte existe déja ';

                                    $data['fail'] = 'a_email';
                                   
                                }
                                else if( email_already_exist($v_email) && !(cart_already_exist($v_cart)) )
                                {
                                    $data['fail'] = 'a_email';
                                    $data['result'] ='ce email existe déja ';
                                }
                                else
                                {
                                    $data['fail'] = 'a_cart';
                                    $data['result'] ='cette carte éxiste déja ';
                                }
                                }
                                 }
                         else{
                                $data['fail'] = 'a_cart';
                                $data['result'] ='num de cart incorrécte';
                             }
                             }     
                    else{
                            $data['fail'] = 'a_pass2';
                            $data['result'] = 'la conformation du mot de passe doit étre édentique';
                             }                           
                        }
                 else{

                         $data['fail'] = 'a_pass1';
                         $data['result'] = 'le mot de passe doit étre contenir au moins 1 charactére majuscule est un minuscuile et un chifre';
                        }
                    }
            else{
                 $data['fail'] = 'a_email';
                 $data['result'] = 'email inccorécte';
                 }
            }
          else{
                 $data['fail'] = 'a_prenom';
                $data['result'] = 'le  prenom doit étre au moins 4 lettres';
            }
        }
        else{
            $data['fail'] = 'a_nom';
            $data['result'] = 'le nom doit étre au moins 3 lettres';
        }
    }
    else{
        $data['fail'] = 'redirect_a';
        $data['result'] = " tous les champ doit étre remplit";
    }
}
else
{
    if(!empty($_POST['nom'])&&  
    !empty($_POST['email']) && !empty($_POST['pass1']) && !empty($_POST['pass2']) && !empty($_POST['wilaya']) )
    {

        $nom = $_POST['nom'];
        
        $email = $_POST['email'];
        $pass1 =$_POST['pass1'];
        $pass2 =$_POST['pass2'];
       
        $wilaya = $_POST['wilaya'];

        if(validate_nom($nom)){
           
            if( validate_email($email)){
                if(validate_password($pass1)){
                    if(password_equals($pass1,$pass2)){
                        
                                                 // tous les champ sont valide 
                                                 $v_nom = filter_var($nom,FILTER_SANITIZE_STRING);
                                                 $v_email = filter_var($email,FILTER_SANITIZE_EMAIL);
                                                 $pass1_hash = password_hash($pass1,PASSWORD_DEFAULT);
                                                 $pass2_hash = password_hash($pass2,PASSWORD_DEFAULT);
                                                 $v_wilaya = filter_var($wilaya,FILTER_SANITIZE_STRING);
                                                 
                                                //// tester si le compte d'agriculteur est déja existe 
                                                if(!(office_already_exist($v_email,$v_nom))){
                                                    
                                                    
                                                    $new_user = $db->prepare("INSERT INTO users
                                                    (email,mot_de_passe,mot_de_passe_confirmation,wilaya_id,profile_id) VALUES (?,?,?,?,1)");
                                                    $new_user->execute([$v_email,$pass1_hash,$pass2_hash,$v_wilaya]);
                                                            
                                                     // insérer dans la table offices
                                                     $user_id = find_id($v_email);
                                                     $new_agr = $db->prepare("INSERT INTO offices(nom,user_id) VALUES (?,?)");
                                                     $new_agr->execute([$v_nom,$user_id]);

                                                      $data['result'] = 'success';
                    
                                                     }
                            else{
                                if(email_already_exist($v_email) && office_name_exist($v_nom))
                                {
                                    $data['fail'] = 'o_nom';
                                    $data['result'] = 'ce nom  existe déja ';
                                    $data['result'] = 'ce  email existe déja ';
                                }  
                                else if(email_already_exist($v_email))
                                {   
                                    $data['fail'] = 'o_email';
                                    $data['result'] = 'ce  email existe déja ';  
                                }
                                else
                                {
                                    $data['fail'] = 'o_nom';
                                    $data['result'] = 'ce nom  existe déja ';
                                }
                                
                                }
                                 
                             }     
                    else{
                            $data['fail'] = 'o_pass2';
                            $data['result'] = 'la conformation du mot de passe doit étre édentique';
                             }                           
                        }
                 else{
                         $data['fail'] = 'o_pass1';
                         $data['result'] = 'le mot de passe doit étre contenir au moins 1 charactére majuscule est un minuscuile et un chifre';
                        }
                    }
            else{
                    $data['fail'] = 'o_email';
                    $data['result'] = 'email inccorécte';
                 }
            
        }
        else{
            $data['fail'] = 'o_noms';
            $data['result'] = 'le  nom doit étre au moins 3 lettres';
        }
    }
    else{
        $data['fail'] = 'redirect_b';
        $data['result'] = " tous les champ doit étre romplit";
    }
}



  echo json_encode($data);      