


<?php

require 'query.php';


      if(!empty($_POST['email']))
      {
           $v_email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
           
                 if(filter_var($v_email,FILTER_VALIDATE_EMAIL))
                 {
                           
                       if(!email_exist_in_news_latter($v_email))
                       {
                              $add_news_latter = $db->prepare("INSERT INTO newslatter (email) VALUE (?) ");
                              $add_news_latter->execute([$v_email]);
                              
                              $data['result'] =  "vous êtes désormais abonné à la newsletter";
                       }
                       else
                       {
                                $data['result'] = 'fail';

                                $data['err'] =  "vous êtes déja abonné à la newsletter "; 
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



