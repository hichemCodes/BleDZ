<?php
 
        require 'connect_db.php';
         
        $all_agr = $db->prepare("SELECT COUNT(*) as count FROM agriculteurs");
        $all_agr->execute();

        $all_agr_result = $all_agr->fetch(PDO::FETCH_ASSOC);
        echo $all_agr_result['count'];

        
?>