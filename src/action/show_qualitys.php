<?php

session_start();

require 'query.php';

office_auth();

$output = '<option value="0" disabled selected >Selectionner la qualité</option>';

$product = all_product_qualitys($_POST['product_id']);

if(!isset($_POST['s_quality']))
{
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
}
else
{
    if($product['prix_unitaire_A'] != NULL)
    {
        $output.= ($_POST['s_quality'] == 'A') ? '<option value="A" selected>A</option>' : '<option value="A">A</option>';
    }
    if($product['prix_unitaire_B'] != NULL)
    {
        $output.= ($_POST['s_quality'] == 'B') ? '<option value="B" selected>B</option>' : '<option value="B">B</option>'; 
    }
    if($product['prix_unitaire_C'] != NULL)
    {
        $output.= ($_POST['s_quality'] == 'C') ? '<option value="C" selected>C</option>' : '<option value="C">C</option>'; 
    }
}



echo $output;
