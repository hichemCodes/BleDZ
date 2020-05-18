<?php
       

        require 'connect_db.php';
          
        session_start();


        $recolte_count = $db->prepare("SELECT COUNT(*) as cpt FROM récoltes WHERE office_id =? ");
        $recolte_count->execute([$_SESSION['office_id']]);

        $recolte_count_result = $recolte_count->fetch(PDO::FETCH_ASSOC);

        $output = $recolte_count_result['cpt'];

        echo $output;

        
            
        
?>