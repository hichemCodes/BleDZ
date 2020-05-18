<?php
 
        require 'connect_db.php';
         
        $all_offices = $db->prepare("SELECT COUNT(*) as count FROM offices");
        $all_offices->execute();

        $all_offices_result = $all_offices->fetch(PDO::FETCH_ASSOC);
        echo $all_offices_result['count'];

        
?>