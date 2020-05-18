<?php

session_start();

require 'query.php';

office_auth();

$output = '<option value="0" disabled selected >Selectionner la qualité</option>';

$product = all_product_qualitys($_POST['product_id']);

if($product['prix_unitaire_A'] != NULL)
{
   $output.= '<option value="A">A</option>';
}
if($product['prix_unitaire_B'] != NULL)
{
    $output.= '<option value="B">B</option>';    
}
if($product['prix_unitaire_C'] != NULL)
{
    $output.= '<option value="C">C</option>';
}

echo $output;
