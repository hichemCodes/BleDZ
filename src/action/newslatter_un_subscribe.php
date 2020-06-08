<?php

session_start();

require 'connect_db.php';
require 'query.php';

agr_auth();


      if(!empty($_POST['email']))
      {
           $v_email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
           
                 if(filter_var($v_email,FILTER_VALIDATE_EMAIL))
                 {
                           
                       if(email_exist_in_news_latter($v_email))
                       {
                              $un_subscribe = $db->prepare("DELETE FROM newslatter WHERE email = ? ");
                              $un_subscribe->execute([$v_email]);
                              
                              $data['result'] =  "vous êtes désormais désabonné à la newsletter";
                       }    
                       else
                       {
                                    $data['result'] = 'fail';
                                    $data['err']=  "vous êtes pas abonné a la newslatter !";          
                       }      

                 }
                 else
                 {
                              $data['result'] = 'fail';
                              $data['err'] =  " email incorrect ";          
                 }
           
      }
      else
      {
          $data['result'] = 'fail';
          $data['err'] =  "le champ email doit être rempli";
      }

      echo json_encode($data);

?>



