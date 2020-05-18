<?php
session_start();

require 'connect_db.php';

$r_v_count = $db->prepare("SELECT COUNT(*) AS count FROM rendez_vous WHERE office_id = ? AND is_taken = 1");
$r_v_count->execute([$_SESSION['office_id']]);
$r_v_count_result = $r_v_count->fetch(PDO::FETCH_ASSOC);

echo $r_v_count_result['count'];
?>