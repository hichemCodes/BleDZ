<?php


require 'connect_db.php';
require 'query.php';

session_start();

if($_POST['step'] == 'first')
{
                $output = '
                        
                        <i class="fas fa-times exit_add_f_i" onclick="hide_add_admin_form()"> </i>
                        <select  id="user_selected" required>
                            <option value="" disabled selected>choisit le compte d\'office</option>';
                        
            // all the offices that not have full acces 
            
            $all_offices = $db->prepare("SELECT * FROM users INNER JOIN offices
                                         on users.id = offices.user_id AND  full_acces = 0");

            $all_offices->execute();

            if($all_offices->rowCount() == 0)
            {
                 $output = $output.'<option value="" disabled selected> il n\'y a pas des offices encore</option>';
            }
            else
            {
                 $all_offices_result = $all_offices->fetchAll(PDO::FETCH_ASSOC);

                 foreach($all_offices_result as $result)
                 {
                    $output = $output.'<option value="'. $result['id'].'">'.  $result['nom'] .' '. getWilaya($result['wilaya_id']).'</option>';
                 }
            }
            
                  $output = $output.'</select>
            
                  <button id="add_r" class="add_admin">  Suivant    </button>

                 
            ';     

            echo $output;
}
else
{
    if(office_exist_and_is_not_full_acces($_POST['office_id']))
    {
        // update office to full_acces 
        $update_office = $db->prepare("UPDATE offices SET  full_acces = 1 WHERE id = ?");
        $update_office->execute([$_POST['office_id']]);

        $data['result'] = 'l\'office '.find_office_name($_POST['office_id']).' est devenue Admin </div>';

    }
    else
    {
          $data['result'] = 'fail';
          $data['err'] = "<div class='succes_valid s_updated error_u'>ce office n'exite pas !  </div>";
    }

    echo json_encode($data);
    
}



