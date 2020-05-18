<?php
        session_start();
        require 'connect_db.php';

        $registred = $db->prepare("SELECT COUNT(users.id) as c_id FROM users INNER JOIN agriculteurs ON users.id=agriculteurs.user_id AND  users.wilaya_id = ?");
        $registred->execute([$_SESSION['wilaya_id']]);
        
        $result = $registred->fetch(PDO::FETCH_ASSOC);
        $output = $result['c_id'];
        echo $output;


?>