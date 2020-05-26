



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/flex.css">
    <link rel="stylesheet" href="../css/bulma.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/sign_in_sign_up.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">    
    

   
    <link rel="stylesheet" href="../css/fontawesome-free-5.12.1-web/css/all.min.css">
    <style>
                        
                   
    </style>
    <title>BléDZ | Inscription</title>
</head>
<body class="cover_me flex j_center a_center">
     <div class="cover_all cover_s"></div>
   <div class="form_type flex d_column">

        <img src="../img/logo.png" alt="">
      <div class="output  flex d_column">
          <div class="f_header flex d_column a_center j_end">
        <select class="select" >
            <option value="0" disabled selected class="select special">sélectionnez le type du compte</option>
            <option value="1" class="select" >Agriculteur</option>
            <option value="2"   class="select">Office du blé</option>
        </select>
        <button class="next">
            Suivant
        </button>
        </div>
         <!--   agriculteur form -->
        <form  class="flex d_column j_end hidden form_argr form_agr" method="POST">

                <div class="err redirect_a custum_err"></div>

                <div class="item a_nom">

                    <i class="fas fa-user "></i>
                    <input type="text" name="nom"  placeholder="Nom" value="" required>
                    <span class="border"> <i></i></span>
                </div>
              
                <div class="item a_prenom">

                        <i class="fas fa-user"></i>
                        <input type="text" name="prenom"  placeholder="Prénom" required>
                        <span class="border"> <i></i></span>
                   </div>
                   

            <div class="item a_email">

                    <i id="icmail"class="fas fa-at"></i>
                    <input type="email" name="email"  placeholder="Email" value="" class="email "required >
                    <span class="border"> <i></i></span>
                </div>
                <div class="item flex a_pass1 ">

                        <i class="fas fa-key" ></i>
                        <input type="password" name="pass1"  placeholder="Mot De Passe" value="" class="" required>
                        <span class="border"> <i></i></span>                        

                </div>

                <div class="item flex a_pass2 ">

                        <i class="fas fa-key "></i>
                        <input type="password" name="pass2"  placeholder="Mot De Passe Confirmation" class="" required>
                        <span class="border"> <i></i></span>                        

                </div>
                <div class="item a_cart">

                        <i class="fas fa-id-card"></i>
                        <input type="text" name="n_cart"   placeholder="Numéro de carte" class="" required>
                        <span class="border"> <i></i></span>
                   </div>
                   
                   <div class="item a_wilaya">
                   <i class="fas fa-city s_top"></i>
                   <select name="wilaya"  class="select2" id="wilaya_a" required>

                   <option value="0" disabled selected class="select special">sélectionnez votre wilaya</option>
                   
                   
                   
                   </select>
   
                   </div>
               <div class="bottom flex j_between a_ceter">
                              
               <div class="back flex a_center">
               
               <span>Retour</span>
               </div>
                <button type="submit" name="insert_agri" class="submit f-agr button   flex j_center a_center"> 
                      
                        <span>
                                 Inscrit
                        </span>
                </button>
               </div>
</form>
                  <!--   office form -->
        <form  method="POST" class="flex d_column j_end hidden form_office">

        <div class="err redirect_b custum_err2"></div>

            <div class="item o_nom">

                    <i class="fas fa-user"></i>
                    <input type="text" name="nom_o"  placeholder="Nom" required>
                    <span class="border"> <i></i></span>
            </div>
                   <div class="item o_email">

                            <i id="icmail"class="fas fa-at"></i>
                            <input type="email" name="email_o"  placeholder="Email" required >
                            <span class="border"> <i></i></span>
                        </div>
                        <div class="item flex o_pass1">

                                <i class="fas fa-key" ></i>
                                <input type="password" name="pass1_o"  placeholder="Mot De Passe" required>
                                <span class="border"> <i></i></span>

                        </div>

                        <div class="item flex o_pass2">

                                <i class="fas fa-key "></i>
                                <input type="password" name="pass2_o"  placeholder="Mot De Passe Confirmation"  required>
                                <span class="border"> <i></i></span>

                        </div>

                    <div class="item o_wilaya">
                            <i class="fas fa-city s_top"></i>
                            <select name="wilaya"  class="select2" id="wilaya_b">

                                 <option value="0" disabled selected class="select special">sélectionnez votre wilaya</option>
                            
                            </select>

                    </div>
                <div class="bottom flex j_between a_center">
                            
                <div class="back flex a_center">
               
               <span>Retour</span>
               </div>
                
                <button type="submit" name="insert_office" class="submit f-office button   flex j_center a_center"> 
                      
                      <span>
                               Inscrit
                      </span>
               </button>
            
            </div>
        </form>




    </div>
   </div>

     <script src="../js/jquery-3.4.1.min.js" type="text/javascript"></script>

    <script  type="module" src="../js/wilayas.js"></script>
    <script type="module" src="../js/sign_up.js"></script>
    <script src="../js/storage_cleaner.js" type="text/javascript"></script>
    <script src="../js/sign_in_sign_up_ajax.js?v=<?php echo time();?>" type="text/javascript"></script>

    

</body>
</html>

