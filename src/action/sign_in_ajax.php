<?php


    session_start();

    require 'query.php';

    require 'connect_db.php';
    require 'validate_fields.php';

    if(!empty($_POST['email'] && !empty($_POST['pass']))){

        $email = $_POST['email'];
        $password = $_POST['pass'];

        if(validate_email($email)){

            $v_email = filter_var($email,FILTER_SANITIZE_EMAIL);

            $email_exist = $db->prepare("SELECT * FROM users WHERE email = ? ");
            $email_exist->execute([$v_email]);

            $email_exist_count = $email_exist->rowCount();
            
            if($email_exist_count == 1)
            {
                    $email_result = $email_exist->fetch(PDO::FETCH_ASSOC);
                    $password_hash = $email_result['mot_de_passe'];
                    
                    if(password_verify($password,$password_hash)){
                        
                          if($email_result['is_verified']){


                                    if(is_type_agriculteurs($v_email))
                                    {
                                           $all_data = $db->prepare("SELECT * FROM users INNER JOIN agriculteurs 
                                            ON users.id = agriculteurs.user_id AND users.id =? ");
                                            $all_data->execute([$email_result['id']]);
                                            
                                            $all_data_result = $all_data->fetch(PDO::FETCH_ASSOC);

                                            
                                            $_SESSION['id'] = $all_data_result['user_id'];
                                            $_SESSION['agr_id'] = $all_data_result['id'];
                                            $_SESSION['nom'] = $all_data_result['nom'];
                                            $_SESSION['prenom'] = $all_data_result['prenom'];
                                            $_SESSION['wilaya_id'] = $all_data_result['wilaya_id'];

                                            $_SESSION['carte'] = $all_data_result['num_de_carte'];
                                            $_SESSION['type'] = 'agriculteur';
                                            $_SESSION['email'] = $all_data_result['email'];

                                            $data['result'] = 'success';
                                            $data['home'] = 'Appointement.php';
                                        
                                    }
                                    else
                                    {
                                            $all_data = $db->prepare("SELECT * FROM users INNER JOIN offices 
                                            ON users.id = offices.user_id AND users.id =? ");
                                            $all_data->execute([$email_result['id']]);
                                            
                                            $all_data_result = $all_data->fetch(PDO::FETCH_ASSOC);

                                            

                                            $_SESSION['id'] = $all_data_result['user_id'];
                                            
                                            $_SESSION['nom'] = $all_data_result['nom'];
                                            $_SESSION['office_id'] = find_office_id($_SESSION['nom']);
                                            $_SESSION['wilaya_id'] = $all_data_result['wilaya_id'];
                                            $_SESSION['type'] = 'office';
                                            
                                            $_SESSION['email'] = $all_data_result['email'];
                                            $_SESSION['phone'] = "";

                                            $data['result'] = 'success';
                                            $data['home'] = 'dashboard.php';
                                    }
                          }
                          else{
                                
                                $data['fail'] = 'in_valid';
                                $data['result'] = "votre compte n'est pas encore validé, dès qu'il sera validé vous recevrez un email dans votre boîte email";
                          }
                    }
                    else{

                        $data['fail'] = 'c_pass';
                         $data['result'] = 'mot de passe incorrect';
                    }
                   
            }
            else{

                $data['fail'] = 'c_email';
                $data['result'] = "email n'existe pas";
            }

        }
        else
        {
                $data['fail'] = 'c_email';
                $data['result'] = "email incorrect";

        }
        

    }
    else
    {
        
        $data['fail'] = 'redirect_a';
        $data['result'] = "tous les champs doivent être remplis";
    }

    echo json_encode($data);      