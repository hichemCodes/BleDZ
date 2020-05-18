<?php

session_start();

require 'query.php';
require 'validate_fields.php';

if($_SESSION['type'] == 'office')
{
    office_auth();
}
else
{
    agr_auth();
}
// variables
$old_password_s = $_POST['old_pass'];
$new_password = $_POST['new_pass'];
$new_password_confirmation = $_POST['new_pass_conf'];


///find the old password 
$old_password = find_user_information($_SESSION['id'])['mot_de_passe'];

// array of variables 
$array_var = [$old_password_s,$new_password,$new_password_confirmation];

if(!in_array('',$array_var))
{

        //chek if the old password is 
        if(password_verify($old_password_s,$old_password))
        {
                /// check if the format of the password match
                if(validate_password($new_password))
                {
                        if(password_equals($new_password,$new_password_confirmation))
                        {
                                //pass hash
                                $new_password_hash = password_hash($new_password,PASSWORD_DEFAULT);
                                $new_password_confirmation_hash = password_hash($new_password_confirmation,PASSWORD_DEFAULT);
                                // update the password
                                $update_pass = $db->prepare("UPDATE users SET mot_de_passe = ?,mot_de_passe_confirmation = ? WHERE id = ?");
                                $update_pass->execute([$new_password_hash,$new_password_confirmation_hash,$_SESSION['id']]);

                                $data['result']  = "mot de passe changé avec succès";

                        }
                        else
                        {
                            $data['result'] = 'fail';
                            $data['err'] = "les nouveaux mots de passe doivent être identiques";
                        }
                }
                else
                {
                    $data['result'] = 'fail';
                    $data['err'] = "le nouveau mot de passe doit comporter au moin 8 caractères dont une lettre majuscule et une lettre minusculle et un chiffre !";
                }
        }
        else
        {
            $data['result'] = 'fail';
            $data['err'] = "l'ancien mot de passe est incorrect";
        }
}
else
{
    $data['result'] = 'fail';
    $data['err'] = "tous les champs doivent être remplis !";
}



echo json_encode($data)

?>  