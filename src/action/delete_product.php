<?php


session_start();

require 'connect_db.php';
require 'query.php';

/// suprimé le produit

$d_product = $db->prepare("DELETE FROM produit where code = ? ");
$d_product->execute([$_POST['code']]);

 echo "<div class='succes_valid s_updated '>produit supprimé avec succès </div>";

     

?>



                                       