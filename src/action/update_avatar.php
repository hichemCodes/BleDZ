<?php    

   session_start();
   require 'connect_db.php';
  

    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_err = $_FILES['file']['error'];
    $file_tmp_name = $_FILES['file']['tmp_name'];

    //$file_name = $file['name'];
    $location = "upload/".$file_name;
   
   $file_src = explode('.',$file_name);
    $file_src_f = strtolower(end($file_src));
     
     $allwed = array('jpg','jpeg','png');
   
   
      if(in_array($file_src_f,$allwed))
      {
         if($file_err === 0)
         {
           if($file_size < 1000000 )
           {
              $file_new_name = uniqid('',true).".".$file_src_f;
              $f_destination = '../../users_avatar/'.$file_new_name;
              if(move_uploaded_file($file_tmp_name,$f_destination)){
                    
                   $update = $db->prepare("UPDATE agriculteurs SET avatar = ? WHERE id = ?");
                   $update->execute([$file_new_name,$_SESSION['agr_id']]);
                    
                   echo $file_new_name;
                   
                       
              }
           }
           else{
              echo "fail_size";
           }
         } 
      }
      else
      {
         echo "fail_type";
      }

      

   
  
 

                                           
                                           

?>