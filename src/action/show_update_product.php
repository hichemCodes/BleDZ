
<?php

session_start();

require 'connect_db.php';
require 'query.php';


if($_POST['type'] == 'update')
{

/// tous les information du projet concérné

$product = $db->prepare("SELECT * FROM produit WHERE code = ? ");
$product->execute([$_POST['code']]);

$product_result = $product->fetch(PDO::FETCH_ASSOC);

$output = '

<i class="fas fa-times exit_r" onclick="exit_product_form()"> </i>

<div class="f_item flex d_center a_center d_column">
      <label for="code_p" class="form-label">Code du produit *</label>
      <input type="text"  id="code_p" value="'.  $product_result['code'] .'">
      <img src="../img/wheat2.png" alt="" class="custum_icon_form">

</div>
<div class="f_item flex d_center a_center d_column">
      <label for="desc_p" class="form-label">Description *</label>
      <input type="text"  id="desc_p" value="'.  $product_result['description'] .'">
      <i class="far fa-clipboard"></i>
</div>
<div class="f_item flex d_center a_center d_column">
      <label for="prix_p" class="form-label">Prix unitaire qualité A *</label>
      <input type="text"  id="prix_p" value="'.  $product_result['prix_unitaire_A'] .'">
      <i id="icmail" class="fas fa-euro-sign "></i>
</div>
<div class="f_item flex d_center a_center d_column">
      <label for="prix_p_2" class="form-label"> Prix unitaire qualité B</label>
      <input type="text"  id="prix_p_2" value="'.  $product_result['prix_unitaire_B'] .'">
      <i id="icmail" class="fas fa-euro-sign "></i>
</div>
<div class="f_item flex d_center a_center d_column">
      <label for="prix_p_3" class="form-label"> Prix unitaire qualité C</label>
      <input type="text"  id="prix_p_3" value="'.  $product_result['prix_unitaire_C'] .'">
      <i id="icmail" class="fas fa-euro-sign "></i>
</div>
<div class="f_item flex d_center a_center d_column">
                               
<input type="submit"  id="sub_m" class="sub_u_p" value="Modifier">
</div>
';
  
}

else
{
    $output = '
    
    <i class="fas fa-times exit_r" onclick="exit_product_form()"> </i>
    
    <div class="f_item flex d_center a_center d_column">
          <label for="code_p" class="form-label">Code du produit *</label>
          <input type="text"  id="code_p" >
          <img src="../img/wheat2.png" alt="" class="custum_icon_form">
    
    </div>
    <div class="f_item flex d_center a_center d_column">
          <label for="desc_p" class="form-label">Description *</label>
          <input type="text"  id="desc_p" >
          <i class="far fa-clipboard"></i>
    </div>
    <div class="f_item flex d_center a_center d_column">
          <label for="prix_p" class="form-label"> Prix unitaire qualité A *</label>
          <input type="email"  id="prix_p">
          <i id="icmail" class="fas fa-euro-sign"></i>
    </div>
     <div class="f_item flex d_center a_center d_column">
          <label for="prix_p_2" class="form-label"> Prix unitaire qualité B</label>
          <input type="email"  id="prix_p_2">
          <i id="icmail" class="fas fa-euro-sign"></i>
    </div>
    <div class="f_item flex d_center a_center d_column">
          <label for="prix_p_3" class="form-label"> Prix unitaire qualité C</label>
          <input type="email"  id="prix_p_3">
          <i id="icmail" class="fas fa-euro-sign"></i>
    </div>
    <div class="f_item flex d_center a_center d_column">
                                   
    <input type="submit"  id="sub_m" class="sub_a_p" value="Ajouter">
    </div>';
}

echo $output;


?>