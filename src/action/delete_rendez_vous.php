<?php


require 'connect_db.php';

session_start();




$delete_r = $db->prepare("DELETE  FROM rendez_vous WHERE id = ? AND office_id = ? AND is_taken = 0 ");

$delete_r->execute([$_POST['id'],$_SESSION['office_id']]);

echo "<div class='succes_valid v_3'>rendez-vous supprimé avec succès</div>";




?>


                                       