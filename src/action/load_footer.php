

<div class="fotter flex j_around a_center s_width">

<div class="item1 flex d_column">
           <img src="../img/logo.png" alt="">
           <p>© 2020, BléDz. Tous les droits sont réservés.
               Modèle par : Laouar Mohamed hichem</p>
</div>
<div class="item1 flex d_column">

   <span class="t_fotter" > OBTENEZ UN NEWSLATTER </span>
   
   <div class="newslaters flex j_between a_center">

       <form  class='flex j_between a_center share'>
       <?php 
       if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type'] == 'agriculteur')
       {
            if(email_exist_in_news_latter($email)) 
            {
                echo '
                <div class="input_n_container">
                    <input type="email" id="email"  class="n_email" placeholder="Email" value="'.$email.'" readonly >
                    <span class="focus-border"></span>
                </div>
                <input type="submit" value="Abonné" class="cnx_btn m disabled" disabled title="vous êtes déja abonné a la newsletter">
                ';
            }
            else
            {
                echo '
                <div class="input_n_container">
                    <input type="email" id="email"  class="n_email" placeholder="Email" value="'.$email.'">
                    <span class="focus-border"></span>
                </div>
                <input type="submit" value="Souscrire" class="cnx_btn m" >
                ';
            }
       }
       else
       {
                echo '
                <div class="input_n_container">
                    <input type="email" id="email"  class="n_email" placeholder="Email">
                    <span class="focus-border"></span>
                </div>
                <button type="submit" class="cnx_btn m c_n_btn"> Souscrire</button> 
                ';   
       }
          
       ?>
               
       </form>

   </div>
</div>

</div>

