<?php
        session_start();


        require 'connect_db.php';
        require  'query.php';


        $registred = $db->prepare("SELECT COUNT(users.id) as c_id FROM users INNER JOIN agriculteurs ON users.id=agriculteurs.user_id AND users.wilaya_id = ?  AND is_verified= 0");
        $registred->execute([$_SESSION['wilaya_id']]);
        
        $result = $registred->fetch(PDO::FETCH_ASSOC);
        $output = $result['c_id'];


        if(have_full_acces($_SESSION['office_id']))
        {
                $registred_office = $db->prepare("SELECT COUNT(users.id) as c_id FROM users INNER JOIN offices ON users.id=offices.user_id   AND is_verified= 0");
                $registred_office->execute([$_SESSION['wilaya_id']]);
        
                $result = $registred_office->fetch(PDO::FETCH_ASSOC);
                $output = (int) $output + (int) $result['c_id'];
        }
        echo $output;


?>