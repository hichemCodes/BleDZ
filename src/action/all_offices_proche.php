   <?php  
     session_start();
     require 'query.php';
     require 'connect_db.php';
                        

               
   
                             $wilaya = getWilaya($_SESSION['wilaya_id']);
                            
                             $output = '';
                           

                               
                                $offices = $db->prepare("SELECT * FROM users INNER JOIN offices ON users.id=offices.user_id  AND users.wilaya_id = ? AND users.is_verified = 1");
                        
                        
                                $offices ->execute([$_SESSION['wilaya_id']]);
                                if($offices->rowCount() == 0)
                                {
                                     
                                       $output = ' <span class="empty_result">il n\'y a pas  encore des offices  dans votre wilaya</span>';
                                       
                                }
                                else
                                {
                                    $offices_result = $offices->fetchAll(PDO::FETCH_ASSOC);
                             
                            foreach($offices_result as $office)
                            {
                                
                                $output = $output.'
                                <div class="office flex j_center a_center">
                                <i class="fas fa-map-marker-alt fa-2x"></i>
                                <span class="office_name">Office '.$office['nom'].' '.$wilaya .'</span>
                                    <div class="update flex j_center a_center">
                                    <i class="fas fa-business-time fa-4x" title = "afficher les rendez-vous disponibles " onclick="rendez_vous('.$office['id'].')"></i>
                                    </div>
                                </div>
                                                          
                                ';
                                
                            }
                        }
                            echo $output;
                            
                    ?>