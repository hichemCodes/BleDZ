<?php


require 'connect_db.php';

function clean($data){
    $data=trim(htmlspecialchars($data));
    $data2=stripslashes($data);
    return $data2;
    }
   
    $errors = array('nom'=>'','prenom'=>'','email'=>'','password'=>'',
    'password2'=>'','cart'=>'','exist'=>'');
  function validate_nom($nom){

        $s_nom = filter_var(clean($nom),FILTER_SANITIZE_STRING);
        $reg_nom = '/^[A-Za-z]{3,12}$/';
        
        if( !(preg_match($reg_nom , $s_nom) ) ){ return false;}
        else  {return true;}

  }
  

  function validate_prenom($prenom){
          $s_prenom = filter_var($prenom,FILTER_SANITIZE_STRING);
          $reg_prenom = '/^[A-Za-z]{4,12}$/';
        
        if( !(preg_match($reg_prenom , $s_prenom) ) ){ return false;}
        else  {return true;}
  }

  function  validate_email($email){

    $s_email= filter_var(clean($email),FILTER_SANITIZE_EMAIL);

    if(! (filter_var($s_email,FILTER_VALIDATE_EMAIL))){  return false;  }
      else{  return true; }
   
}
   function validate_password($pass1){

         $reg_pass = '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$^';
         if(!(preg_match($reg_pass,$pass1))){return false;}
         else{return true;}
   }
   function password_equals($pass1,$pass2){
              
            if($pass1 != $pass2)
            {
              return false;
            }
            else
            {
              return true;
            }
   }
   function validate_cart($n_cart){
       // $v_cart = filter_var($n_cart,FILTER_SANITIZE_NUMBER_INT	);

        if(! (preg_match('/^[0-9]{6,6}$/',$n_cart))){ return false;}
        else { return true;}
   }
   
      //// user already exist test 

      function user_already_exist($email,$carte){
            
           global $db;

            $email_exist = $db->prepare("SELECT *  FROM users WHERE email = ?");
            $email_exist->execute([$email]);
            $count_email_exist = $email_exist->rowCount();
            if($count_email_exist == 0){
              $cart_exist = $db->prepare("
              SELECT *  FROM users INNER JOIN agriculteurs ON users.id = agriculteurs.user_id AND agriculteurs.num_de_carte = ?");

              $cart_exist->execute([$carte]);
              $count_cart_exist = $cart_exist->rowCount();
              if($count_cart_exist == 0){return false;}
              else{ 
                
                return true;}
            }
            else{
              
              return true;
            }
            

      }
      function office_already_exist($email,$name)
      {
        global $db;


        $email_exist = $db->prepare("SELECT *  FROM users WHERE email = ?");
        $email_exist->execute([$email]);
        $count_email_exist = $email_exist->rowCount();
        if($count_email_exist == 0){
          $name_exist = $db->prepare("
          SELECT *  FROM users INNER JOIN offices ON users.id = offices.user_id AND offices.nom = ?");

          $name_exist->execute([$name]);
          $count_name_exist = $name_exist->rowCount();
          if($count_name_exist == 0){return false;}
          else{ 
            
            return true;}
        }
        else{
          
          return true;
        }
      }
      function office_name_exist($name)
      {
        global $db;
        $name_exist = $db->prepare("SELECT * FROM offices WHERE nom = ?");
        $name_exist->execute([$name]);

        if($name_exist->rowCount() == 0)
        {
            return false;
        }
        else
        {
           return true;
        }
      }


      function find_id($email){
        global $db;

           $user = $db->prepare("SELECT * FROM users WHERE email =?");
           $user->execute([$email]);
           $user_result = $user->fetch(PDO::FETCH_ASSOC);
           return $user_result['id'];

      }

      function email_already_exist($email)
      {
        global $db;
        $mail_exit = $db->prepare("SELECT * FROM users WHERE email = ?");
        $mail_exit->execute([$email]);

        if($mail_exit->rowCount() == 0)
        {
            return false;
        }
        else
        {
           return true;
        }
      }

      function cart_already_exist($cart)
      {

        global $db;
        $cart_exist = $db->prepare("SELECT * FROM users INNER JOIN agriculteurs ON users.id = agriculteurs.user_id
         and  agriculteurs.num_de_carte  = ?");
        $cart_exist->execute([$cart]);

        if($cart_exist->rowCount() == 0)
        {
            return false;
        }
        else
        {
           return true;
        }
      }



      
  ?>