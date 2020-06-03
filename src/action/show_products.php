<?php


session_start();

require 'connect_db.php';
require 'query.php';

if(have_full_acces($_SESSION['office_id']))
{
        
     $output = '
     <span class="a_title">Produits</span>
            <div class="s_small products_custum">      
                <table>
                    <tr class="b_bottom">
                    <th class="t_normal">Code</th>
                    <th class="t_normal">Description</th>
                    <th class="t_small_multi_price">Prix unitaire en DA / Tonne</th>
                    <th class="t_large">Opération</th>
                    </tr>
     ';

   

     ///  tous les produits

     $all_product = all_product();



     foreach($all_product as $product)
     {
          $price_B = isset($product['prix_unitaire_B']) ? 'B : '.$product['prix_unitaire_B'] : '';
          $price_C = isset($product['prix_unitaire_C']) ? 'C : '.$product['prix_unitaire_C'] : '';

          $output = $output.'
          <tr class="b_bottom row_t">
          <td>'.$product['code'].'</td>
          <td>'.$product['description'].'</td>
          <td>A : '.$product['prix_unitaire_A'].'<br>'.$price_B.'<br>'.$price_C.'</td>
          <td>
             <i class="fas fa-trash-alt"  onclick="delete_product(\''.$product['code'].'\')" title="supprimé ce produit"></i>
             <i class="fas fa-pencil-alt custum_pencil"  onclick="update_product(\''.$product['code'].'\',\'update\')" title="modifier ce produit"></i>
          </td>
          </tr>
          ';
     }

     $output = $output.'</table>  </div>
     ';
     echo $output;
     
}
?>



                                       