<?php  

    //start the session
    session_start();

    require 'action/query.php';
    redirect_if_already_loged_in();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/flex.css">
    <link rel="stylesheet" href="../css/sign_in_sign_up.css?v=<?php echo time(); ?>">
   
    <link rel="stylesheet" href="../css/fontawesome-free-5.12.1-web/css/all.min.css">
    <link rel="icon" href="../img/logo_s.png" type="image/icon type">

    
    <title>BléDz | Se Connecter</title>
</head>
<body class="cover_me flex j_center a_center">
     <div class="cover_all cover_s"></div>
    <div class="form_type flex d_column">
         <a href="home.php"><img src="../img/logo.png" alt=""></a>
      <!--  <span>Se Connecter</span>   -->  
        <form class="flex d_column j_end conx-form" autocomplete="on">

                <div class="err redirect_a custum_err"></div>

                <div class="item c_email">
                        <i id="icmail"class="fas fa-at"></i>
                        <input type="email" name="email_c"  class= "email" placeholder="Email"  required>
                        <span class="border"> <i></i></span>
                </div>
                <div class="item flex c_pass">
                        <i class="fas fa-key"></i>
                        <input type="password" name="pass_c"  placeholder="Mot De Passe" class= "effect-7 email" required>
                        <span class="border"> <i></i></span>
                    
                </div>

                 <div class="err in_valid redirect_a custum_err"></div> 
               
               <div class="bottom flex j_between d_column ">

                    <div class="flex j_between a_center ">
                        <a href="sign_up.php" class="bold creat_account_link">Créer un Compte </a>
                        <a href="password_reset.php" class="bold">Mot de passe oublié ?</a>
                    </div> 


                   <button type="submit" name="connexion" id="custum_submit" class="submit  button  cnx-btn flex j_center a_center"> 
                      
                      <span>
                                 Connecter
                      </span>

                   </button>
                
               </div>
                

        </form>


    </div>

        <script src="../js/jquery-3.4.1.min.js" type="text/javascript"></script>
        <script src="../js/sign_in_sign_up_ajax.js?v=<?php echo time();?>" type="text/javascript"></script>

</body>
    
</html>
