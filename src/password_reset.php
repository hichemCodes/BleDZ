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

    <link rel="stylesheet" href="../css/swwet_alert_style.css?v=<?php echo time(); ?>">

  
    <title>BléDZ | Mot de passe oublié</title>
</head>
<body class="cover_me flex j_center a_center" style= "height: 100vh !important;">
     <div class="cover_all cover_s"></div>
    <div class="form_type flex d_column">
       
        <a href="home.php">
             <img src="../img/logo.png" alt="">
        </a>

      <!--  <span>Se Connecter</span>   -->  
        <form  class="flex d_column j_end reset_password">
                <div class="item">

                        <i id="icmail"class="fas fa-at "></i>
                        <input type="email" id="email_reset"  class= "email email_reset" placeholder="écrivez votre email" required>
                        <span class="border"> <i></i></span>
                </div>
                <div class="err"></div>
                <input type="submit" id="custum_submit" name="connexion" value="Suivant" class="submit ">
                
               
                

        </form>
    </div>


    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/swwet_alert.js"></script>
    <script src="../js/reset_password_ajax.js?v=<?php echo time(); ?>"></script>
    <script src="../js/newslatter_add_member_ajax.js"></script>
  
</body>
</html>
