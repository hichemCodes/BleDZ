<?php


session_start();

require 'connect_db.php';
require 'query.php';



if(product_already_used($_POST['code']))
{
    $data['result'] = 'fail';

    $data['err'] = 'vous ne pouvez pas supprimer ce produit car il est déjà récolté par des agriculteurs !';   

}
else
{
    /// supprimer le produit
    $d_product = $db->prepare("DELETE FROM produit where code = ? ");
    $d_product->execute([$_POST['code']]);

    $data['result'] = "<div class='succes_valid s_updated '>produit supprimé avec succès </div>";
}

echo json_encode($data);


     

?>



                                       