
<?php

session_start();
require 'query.php';

office_auth();

require 'connect_db.php';



$s_one = $_POST['query'];

$output ='';



/// search for memebrs 

$search = $db->prepare("SELECT * FROM users INNER JOIN agriculteurs ON users.id = agriculteurs.user_id 
                        AND (agriculteurs.nom LIKE ? OR agriculteurs.prenom LIKE ?) 
                        AND (agriculteurs.nom LIKE ? OR agriculteurs.prenom LIKE ?) 
                        AND users.wilaya_id = ?");

$search->bindValue(1,"$s_one%", PDO::PARAM_STR);
$search->bindValue(2,"$s_one%", PDO::PARAM_STR);
$search->bindValue(3,"$s_one%", PDO::PARAM_STR);
$search->bindValue(4,"$s_one%", PDO::PARAM_STR);
$search->bindValue(5,$_SESSION['wilaya_id'], PDO::PARAM_STR);
$search->execute();

// row count for memebers 
$search_result_count = $search->rowCount();


if(have_full_acces($_SESSION['office_id']))
{
     
    $search_offices = $db->prepare("SELECT * FROM users INNER JOIN offices ON users.id = offices.user_id 
    AND nom LIKE ? ");

    $search_offices->bindValue(1,"$s_one%", PDO::PARAM_STR);
    $search_offices->execute();

    // row count for memebers 
    $search_result_offices_count = $search_offices->rowCount();

}
if(have_full_acces($_SESSION['office_id']))
{
    if($search_result_count == 0 && $search_result_offices_count == 0)
    {
        $output = '<div class="profile_s">

        
        <span> ce membre ou office  n\'exite pas </span> 

        </div>';
    }
    else
    {
        $search_result = $search->fetchAll(PDO::FETCH_ASSOC);  // result for members
        $search_offices_result = $search_offices->fetchAll(PDO::FETCH_ASSOC);  // result for offices
        
        foreach($search_result as $agriculteur){

            $output =$output .'<div class="profile_s flex succes_search" onclick="show_account('. $agriculteur['user_id'].')">
    
            <span>'.$agriculteur["nom"].' '. $agriculteur["prenom"] .' (agriculteur)</span> 
        
            </div>';
        
        }
        foreach($search_offices_result as $office){

            $output =$output .'<div class="profile_s flex succes_search" onclick="show_office_account('. $office['user_id'].')">
    
            <span>'.$office["nom"].' (office)  </span> 
        
            </div>';
        
        }

    }
}

else
{

    if($search_result_count == 0)
    {
        $output = '<div class="profile_s">

        
        <span> ce nom n\'esite pas </span> 

        </div>';
    }

    else{

        $search_result = $search->fetchAll(PDO::FETCH_ASSOC);

        
        foreach($search_result as $item){

            $output =$output .'<div class="profile_s flex succes_search" onclick="show_account('. $item['user_id'].')">
    
            <span>'.$item["nom"].' '. $item["prenom"] .' </span> 
        
            </div>';
        
        }

    }
}



echo $output;





?>

