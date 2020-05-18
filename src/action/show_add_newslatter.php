<?php

session_start();
require 'query.php';

$output = '
        
        <i class="fas fa-times exit_add_f_i" onclick="exit_add_news_latter()"> </i>

                <select name="" id="public_c">
                        <option value="empty" selected disabled>Sélectionnez le public cible</option>
                        <option value="all_belongs">Tous les membres de votre wilaya</option>
                        <option value="all">Toutes les personnes qui ont abonné à la newsletter</option>
                </select>

                <input type="text"  id="subject" placeholder="Objet">
                <textarea id="msg_n_l" placeholder="écrivez votre message"></textarea> 
                <button id="add_r" >  envoyer    </button>
        ';


echo $output;


?>