  <?php
  
   session_start();

   require 'query.php';


  if($_SESSION['type'] == 'office')
  {
       $user_id = $_SESSION['office_id'];
       

  }
  else
  {
    $user_id = $_SESSION['agr_id'];
  }
      if(user_have_recolte_in_year($user_id,$_POST['year'],$_SESSION['type']))  // si l'utilisateur a déja des récoltes
      {
       
             $year = $_POST['year'];
             $array_result = array();
              
             for ($i=1;$i<13; $i++)  // boucler sur tous les mois d'année
             {
                if($_SESSION['type'] == 'office')  // si l'utilisateur de type office 
                {
                    if($_POST['action'] == 'recoltes')  // si l'action actuelle est quantité
                    {
                      $recolte_month = $db->prepare("SELECT SUM(Quantité) as s_quan from récoltes where office_id = ? 
                                                     AND YEAR(date) = ? AND MONTH(date) = ?");
                    }
                    else   // si l'action actuelle est montant
                    {
                      $recolte_month = $db->prepare("SELECT SUM(montant) as s_quan from récoltes where office_id = ? AND 
                                                    YEAR(date) = ? AND MONTH(date) = ?");
                    }
                }
                else
                {

                  if($_POST['action'] == 'recoltes')
                  {

                     $recolte_month = $db->prepare("SELECT SUM(Quantité) as s_quan from récoltes where agriculteur_id = ? AND YEAR(date) = ? AND MONTH(date) = ?");
                 
                  }
                  else
                  {

                     $recolte_month = $db->prepare("SELECT SUM(montant) as s_quan from récoltes where agriculteur_id = ? AND YEAR(date) = ? AND MONTH(date) = ?");
                 
                  }

                }
                $recolte_month->execute([$user_id,$year,$i]);

                     $month_result = $recolte_month->fetch(PDO::FETCH_ASSOC);
                     array_push($array_result,$month_result['s_quan']);
              
                
             }
             
             $data['result'] = $array_result;
 
      }
      else
      {
           $data['result'] = [0,0,0,0,0,0,0,0,0,0,0,0];
      }
      
      
      echo json_encode($data);

  
  ?>