<?php
        session_start();
        require 'connect_db.php';

        $recolte = $db->prepare("SELECT COUNT(*) as c_id FROM récoltes WHERE office_id = ? ");
        $recolte->execute([$_SESSION['office_id']]);
        
        $result = $recolte->fetch(PDO::FETCH_ASSOC);
        $output = $result['c_id'];
        echo $output;


?>