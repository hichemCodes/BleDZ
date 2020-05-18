<?php
        session_start();
        require 'connect_db.php';

        $recolte = $db->prepare("SELECT COUNT(*) as c_id FROM récoltes");
        $recolte->execute();
        
        $result = $recolte->fetch(PDO::FETCH_ASSOC);
        $output = $result['c_id'];
        echo $output;


?>