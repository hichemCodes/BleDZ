


<?php

require 'connect_db.php';
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
                              
                              $output =  "<div class='succes_valid '>vous êtes désormais abonner a la newsletter  </div>";
                       }
                       else
                       {
                        $output =  "<div class='succes_valid '>vous êtes déja abonné la newsletter  </div>"; 
                       }
                      

                 }
                 else
                 {

                    $output =  "<div class='succes_valid error_u'> email incorrécte  </div>";

                    
                 }
           
      }
      else
      {
          
          $output =  "<div class='succes_valid error_u'> le champ email doit étre rempli  </div>";
      }
      echo $output;

?>



