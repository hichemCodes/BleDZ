
<?php

session_start();

require 'connect_db.php';
require 'query.php';




/// modifie le  produit

$code = $_POST['code_a'];
$description = filter_var($_POST['desc_a'],FILTER_SANITIZE_STRING);
$price = filter_var($_POST['prix_a'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$price_2= filter_var($_POST['prix_u_2'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);
$price_3 = filter_var($_POST['prix_u_3'],FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);


// si le produit n'existe pas 

if( (!in_assoc_array('code',$code,all_code_product())) && (!in_assoc_array('description',$description,all_description_product())) )
{
      
      
      /// si le code contient seulement des charactére et des chifre 
      if(ctype_alnum($code))
      {
            
                  if($price_2 == '')  { $price_2 = NULL;}
                  if($price_3 == '')  { $price_3 = NULL;}

                  
                  if(filter_var($price,FILTER_VALIDATE_FLOAT) &&  preg_match('/^[0-9]*\.?[0-9]*$/',$_POST['prix_a'])) 
                  {
                        if($price_2 == NULL && $price_3 == NULL)
                        {
                              add_product($code,$description,$price,$price_2,$price_3);
                        }
                        else if($price_2 != NULL && $price_3 != NULL)
                        {
                              if(filter_var($price_2,FILTER_VALIDATE_FLOAT) && preg_match('/^[0-9]*\.?[0-9]*$/',$_POST['prix_u_2']))
                              {
                                    if(filter_var($price_3,FILTER_VALIDATE_FLOAT) && preg_match('/^[0-9]*\.?[0-9]*$/',$_POST['prix_u_3']))
                                    {
                                          add_product($code,$description,$price,$price_2,$price_3);
                                    }
                                    else
                                    {
                                          $data['result'] = 'fail';
                                          $data['err'] = "prix unitaire C incorrect !";     
                                    }
                              }
                              else
                              {
                                    $data['result'] = 'fail';
                                    $data['err'] = "prix unitaire B incorrect !";     
                              }
                        }
                        else if($price_2 == NULL && $price_3 != NULL)
                        {
                              $data['result'] = 'fail';
                              $data['err'] = "il faut mettre le prix unitaire B d'abord";
                        }
                        else
                        {
                              if(filter_var($price_2,FILTER_VALIDATE_FLOAT) && preg_match('/^[0-9]*\.?[0-9]*$/',$_POST['prix_u_2']))
                              {
                                    add_product($code,$description,$price,$price_2,$price_3);
                              }
                              else
                              {
                                    $data['result'] = 'fail';
                                    $data['err'] = "prix unitaire B incorrect";     
                              }
                        }
                  
                  }
                  else
                  {
                        $data['result'] = 'fail';
                        $data['err'] = "prix unitaire A incorrect";
                  }
      }
      else
      {
            $data['result'] = 'fail';
            $data['err'] = "le code doit contenir des caractères et des chiffres";
      }
}
else
{
      $data['result'] = 'fail';
      $data['err'] = "ce produit existe déjà ! ";
}

function add_product($code,$description,$price,$price_2,$price_3)
{
      global $db;

      $u_product = $db->prepare("INSERT INTO produit (code,description,prix_unitaire_A,prix_unitaire_B,prix_unitaire_C)
      VALUES (?,?,?,?,?) ");
      $u_product->execute([$code,$description,$price,$price_2,$price_3]);

      $GLOBALS['data']['result'] = "<div class='succes_valid s_updated '> produit ajouté avec succès ! ";

}

echo json_encode($data);


?>


