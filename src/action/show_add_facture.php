
<?php

require 'connect_db.php';
require 'query.php';

session_start();

if($_POST['step'] == 'first')
{
                $output = '
               
                        <i class="fas fa-times exit_add_f_i" onclick="exit_add_facture()"> </i>
                        <select  id="user_selected" required>
                            <option value="" disabled selected>comptes d\'agriculteurs</option>';
                        
            // all the users that belong to the same wilaya as the office 
            
            $all_users = $db->prepare("SELECT * FROM users INNER JOIN agriculteurs
                                       ON users.id = agriculteurs.user_id 
                                       AND users.wilaya_id = ? AND users.is_verified = 1");

            $all_users->execute([$_SESSION['wilaya_id']]);

            if($all_users->rowCount() == 0)
            {
            $output = $output.'<option value="" disabled selected> il n\'y a pas des membres encore</option>';
            }
            else
            {
            $all_users_result = $all_users->fetchAll(PDO::FETCH_ASSOC);

            foreach($all_users_result as $result)
            {
            $output = $output.'<option value="'. $result['id'].'">'.  $result['nom'] .'  '. $result['prenom'] .'</option>';
            }
            }
            
            $output = $output.'</select>
            
            <button id="add_r" class="move_next">Suivant</button>

             
            ';


            
}
else
{
                $output = '
                     
                            <i class="fas fa-times exit_add_f_i" onclick="exit_add_facture()"> </i>
                       ';
                        
            // afficher tous les utilisateurs qui appartienne a la méme wilaya que l'office

            $all_users = $db->prepare("SELECT récoltes.id as id,récoltes.date as date, Quantité as quan  FROM récoltes 
                                       INNER JOIN offices ON récoltes.office_id = offices.id
                                       AND agriculteur_id = ?  AND récoltes.office_id = ? ");

            $all_users->execute([$_POST['agr_id'],$_SESSION['office_id']]);

            if($all_users->rowCount() == 0)
            {
                    $output = $output .' <select user_selected id="user_selected" required>
                   
                    
                    <option value="" disabled selected>Cet agriculteur n\'a aucun récolte</option></select>

                    <button id="add_r" class="return_add_f" onclick="return_to_add_facture()">  Retour  </button>

                    
                    ';
            }
            else
            {   
            $all_users_result = $all_users->fetchAll(PDO::FETCH_ASSOC);

              $output = $output.' <div class="select" onclick="show_recolte_list_option()"> 
                                         <span>  Sélctionner tous les récolte </span >
                                         <i class="fas fa-sort-down"></i>
                                </div> 
               <div class="cheked_items">';
               
               
            foreach($all_users_result as $result)
            {
                
                /// vérifer si ce récolte est déja facturé ou non 

                if(exist_in_facture($result['id'],$_POST['agr_id']))
                {
                        $output = $output .' <label  class="flex j_start a_center" >   <span class="err_fact"> '.  date('d/m/Y',strtotime($result['date'])) . ' ce récolte est déja facturé</span> </label>';
                }
                else
                {
                        $output = $output .' <label for="'. $result['id'].'" class="flex j_start a_center" > <input type="checkbox" id="'.  $result['id'] .'"  value="'. $result['id'].'" name="recolte" >  <span>'.  date('d/m/Y',strtotime($result['date'])) .''. str_repeat('&nbsp;', 16).'   Quantité :'. $result['quan'] .'</span> </label>';
                }       
            }

                        $output = $output.' </div>
                        <div class="flex j_center a_center">

                                <button id="add_r" class="return_add_f" onclick="return_to_add_facture() ">  Retour  </button>
                                <button id="add_r" class="add_facture_final">  Ajouter   </button>

                                
                        </div>
                        
                        ';
            }
            

}

echo $output;



?>
                     
