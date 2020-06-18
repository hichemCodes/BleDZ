<?php 

    require ("connect_db.php");
   

    function office_auth()
    {
        if (!isset($_SESSION['id']) || (isset($_SESSION['type']) && $_SESSION['type'] != 'office' ) )
        {
            die(header("Location:/pfe/src/sign_in.php"));   
        }
        
    }
    function agr_auth()
    {
        if (!isset($_SESSION['id']) || ( (isset($_SESSION['type']) && $_SESSION['type'] != 'agriculteur' ) ) )
        {
            die(header("Location:/pfe/src/sign_in.php"));
        }
    }
    function redirect_if_already_loged_in()
    {
        if(isset($_SESSION['id']))
        {
            if($_SESSION['type'] == 'agriculteur')
            {
                    header("location:Appointement.php");
            }
            else
            {
                    header("location:dashboard.php");
            }
        }
    }
    function is_type_agriculteurs($email)
    {
         global $db;

        $type = $db->prepare("SELECT * FROM users WHERE email = ? AND profile_id = ? ");
        $type->execute([$email,2]);
        

        if($type->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    }

    function getWilaya($id)
    {
        global $db;
        $wilaya = $db->prepare("SELECT * FROM wilayas WHERE id=?");
        $wilaya->execute([$id]);
        $wilaya_result = $wilaya->fetch(PDO::FETCH_ASSOC);
        return $wilaya_result['nom'];

    }

    function generate_date($value)
    {
        $date = strtotime($value);
        $date_part1 = date('d/m/Y',$date);
        $date_part2 = date('H:i',$date);
        
        return $date_part1.' à '.$date_part2;
    }

    function find_phone($id)
    {
        global $db;
        $phone = $db->prepare("SELECT * FROM offices  WHERE user_id=?");
        $phone->execute([$id]);
        $phone_result = $phone->fetch(PDO::FETCH_ASSOC);

        return $phone_result['num_telephone'];

    }
    function find_office_name($office_id)
    {
        global $db;
        $office = $db->prepare("SELECT * FROM offices  WHERE id = ?");
        $office->execute([$office_id]);
        $office_result = $office->fetch(PDO::FETCH_ASSOC);

        return $office_result['nom'];

    }
    function office_exist_and_is_not_full_acces($office_id)
    {
        global $db;
        $office = $db->prepare("SELECT * FROM offices  WHERE id = ? AND full_acces = 0");
        $office->execute([$office_id]);
        
        if($office->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    function find_agr_information($user_id)
    {
        global $db;
        $agr = $db->prepare("SELECT * FROM users  INNER JOIN agriculteurs ON users.id = agriculteurs.user_id
         AND agriculteurs.user_id = ? ");
        $agr->execute([$user_id]);
        $agr_result = $agr->fetch(PDO::FETCH_ASSOC);

        return $agr_result;

    }
    function find_agr_user_id($agr_id)
    {
        global $db;
        $user_id = $db->prepare("SELECT * FROM users  INNER JOIN agriculteurs ON users.id = agriculteurs.user_id
         AND agriculteurs.id = ? ");
        $user_id->execute([$agr_id]);
        $user_id_result = $user_id->fetch(PDO::FETCH_ASSOC);

        return $user_id_result['user_id'];
    }
    function find_user_information($id)
    {
        global $db;
        $email = $db->prepare("SELECT * FROM users  WHERE id = ? ");
        $email->execute([$id]);

        $email_result = $email->fetch(PDO::FETCH_ASSOC);
        return $email_result;
    }
    
    function find_office_id($name)
    {
        global $db;
        $office = $db->prepare("SELECT * FROM offices  WHERE nom=?");
        $office->execute([$name]);
        $office_result = $office->fetch(PDO::FETCH_ASSOC);

        return $office_result['id'];

       
    }
    function office_exist($id)
    {
        global $db;
        $office = $db->prepare("SELECT * FROM offices  WHERE id=?");
        $office->execute([$id]);

        if($office->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }  
    }

    function has_avatar($id)
    {
        global $db;
        $avatar = $db->prepare("SELECT avatar FROM agriculteurs  WHERE id=?");
        $avatar->execute([$id]);
        $avatar_result = $avatar->fetch(PDO::FETCH_ASSOC);
        if(empty($avatar_result['avatar']))
        {
            return false;
        }
        else
        {
            return true;
        }  
    }

    function find_avatar($id)
     {
        global $db;
        $avatar_f = $db->prepare("SELECT * FROM agriculteurs  WHERE id=?");
        $avatar_f->execute([$id]);
        $avatar_f_result = $avatar_f->fetch(PDO::FETCH_ASSOC);
        return $avatar_f_result['avatar'];
     }

     function find_rendez_vous_by_date($date)
     {
      
        global $db;
        $rendez_vous = $db->prepare("SELECT * FROM rendez_vous  WHERE date = ?");
        $rendez_vous->execute([$date]);
        $rendez_vous_result = $rendez_vous->fetch(PDO::FETCH_ASSOC);
        return $rendez_vous_result['id'];
     }

     function all_product()
     {
        global $db;
        $produit = $db->prepare("SELECT * FROM produit ORDER BY created_at ASC");
        $produit->execute();
        $produit_result = $produit->fetchAll(PDO::FETCH_ASSOC);
        return $produit_result;
     }
     function all_code_product()
     {
        global $db;
        $produit = $db->prepare("SELECT code FROM produit");
        $produit->execute();
        $produit_result = $produit->fetchAll(PDO::FETCH_ASSOC);
        return $produit_result;
     }

     function all_description_product()
     {
        global $db;
        $produit = $db->prepare("SELECT description FROM produit");
        $produit->execute();
        $produit_result = $produit->fetchAll(PDO::FETCH_ASSOC);
        return $produit_result;
     }

     function all_product_qualitys($product_id)
     {
          global $db;

          $qualitys = $db->prepare("SELECT * FROM produit where code = ? LIMIT 1");
          $qualitys->execute([$product_id]);

          $qualitys_result = $qualitys->fetch(PDO::FETCH_ASSOC);

          return $qualitys_result;
     }

     function already_have_rendez_vous($id)
     {
        global $db;
        $user_r_v = $db->prepare("SELECT * FROM rendez_vous WHERE  agriculteur_id = ?");
        $user_r_v->execute([$id]);

         

        if($user_r_v->rowCount() == 0)
        {
            return false;
        }
        else
        {
             return true;
        }
        

     }

     function my_rendez_vous($agr_id)
     {
        global $db;
        $rendez_vous = $db->prepare("SELECT * FROM rendez_vous WHERE  agriculteur_id = ? AND is_taken = 1");
        $rendez_vous->execute([$agr_id]);
                                                           
        $result = $rendez_vous->fetch(PDO::FETCH_ASSOC);

        return $result;
     }

    function find_rendez_vous_information($r_v_id)
    {
        
        global $db;
        $rendez_vous = $db->prepare("SELECT * FROM rendez_vous WHERE  id = ? ");
        $rendez_vous->execute([$r_v_id]);
                                                           
        $result = $rendez_vous->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
    function rendez_vous_exist($id)
    {
         global $db;

         $rendez_vous = $db->prepare("SELECT * FROM rendez_vous WHERE  id = ? ");
         $rendez_vous->execute([$id]);
                                                            
        if($rendez_vous->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }

    }
    function find_product_by_code($code)
     {
        global $db;
        $produit = $db->prepare("SELECT * FROM produit WHERE  code = ? ");
        $produit->execute([$code]);

        $result = $produit->fetch(PDO::FETCH_ASSOC);

        return $result;
     }

     function agr_have_recolte($agr_id)
     {
          global $db;
          $have_recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = ? ");
          $have_recolte->execute([$agr_id]);
          
          if($have_recolte->rowCount() == 0)
          {
              return false;
          }
          else
          {
              return true;
          }
     }

     function user_have_recolte_in_year($id,$year,$type)
     {
        global $db;
        if($type == 'agriculteur')
        {
            $have_recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = ? and YEAR(date) = ?");
        }
        else
        {
            $have_recolte = $db->prepare("SELECT * FROM récoltes WHERE office_id = ? and YEAR(date) = ?");
        }
        
        $have_recolte->execute([$id,$year]);
        
        if($have_recolte->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
     }
     function agr_have_recolte_in_year($agr_id,$year)
     {
          global $db;
          $have_recolte = $db->prepare("SELECT * FROM récoltes WHERE agriculteur_id = ? and YEAR(date) = ?");
          $have_recolte->execute([$agr_id,$year]);
          
          if($have_recolte->rowCount() == 0)
          {
              return false;
          }
          else
          {
              return true;
          }
     }
     function office_have_recolte($office_id)
     {
          global $db;
          $have_recolte = $db->prepare("SELECT * FROM récoltes WHERE office_id = ? ");
          $have_recolte->execute([$office_id]);
          
          if($have_recolte->rowCount() == 0)
          {
              return false;
          }
          else
          {
              return true;
          }
     }
      
     function wilaya_have_récoltes($wilaya_id,$year)
     {
          global $db;

          $have_recolte = $db->prepare('select * from récoltes INNER JOIN offices
                                        on récoltes.office_id = offices.id INNER JOIN users 
                                        on offices.user_id = users.id and users.wilaya_id = ? 
                                        and YEAR(récoltes.date) = ?');
          
          $have_recolte->execute([$wilaya_id,$year]);

          if($have_recolte->rowCount() == 0)
          {
              return false;
          } 
          else
          {
              return true;
          }
     }
     // acces to valid offices accounts 

     function have_full_acces($id)
     {
        

         global $db;

         $have_acces = $db->prepare("SELECT * FROM offices WHERE id = ? AND full_acces = 1 ");

         $have_acces->execute([$id]);

         if($have_acces->rowCount() == 0)
         {
             return false;

         }
         else
         {
             return true;
         }
     }
       
     //// check if  office has member or not 


     function office_has_rendez_vous($id)
     {
         global $db;
        $has_r_v = $db->prepare("SELECT * FROM rendez_vous WHERE office_id = ? ");
        $has_r_v->execute([$id]);

        if($has_r_v->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
     }
     //check if office exist invalid office 

       function exist_invalid_offices()
       {
        global $db;
        $exist_offices_n_v = $db->prepare("SELECT * FROM users WHERE profile_id = 1 AND is_verified = 0");
        $exist_offices_n_v->execute();

        if($exist_offices_n_v->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
       } 
      /// check if exist offices 
      function exist_offices()
      {
          global $db;
          $exist_offices = $db->prepare("SELECT * FROM users WHERE profile_id = ? ");
          $exist_offices->execute([1]);
          
          if($exist_offices->rowCount() > 0)
          {
              return true;
          }
          else
          {
              return false;
          }

      }
       /// check if exist offices other then the coffice passsed in the argument
       function exist_offices_other_than_me($id)
       {
           global $db;
           $exist_offices = $db->prepare("SELECT * FROM users WHERE profile_id = ? AND id <> ?");
           $exist_offices->execute([1,$id]);
           
           if($exist_offices->rowCount() > 0)
           {
               return true;
           }
           else
           {
               return false;
           }
 
       }
     function office_has_available_rendez_vous($id)
     {
        global $db;
        $has_available_r_v = $db->prepare("SELECT * FROM rendez_vous WHERE office_id = ?  AND is_taken = 0 ");
        $has_available_r_v->execute([$id]);
          
        if($has_available_r_v->rowCount() == 0)
        {
            return false;
        }
        else
        {
            return true;
        }
     }
     

     /// check if email already exist in newslateer table 

    function email_exist_in_news_latter($email)
    {
             global $db;
             $mail_exist = $db->prepare("SELECT * FROM newslatter WHERE email = ?");
             $mail_exist->execute([$email]);

             if($mail_exist->rowCount() == 0)
             {
                 return false;
             }
             else
             {
                 return true;
             }
    }

    // l'office le plus fréquant dans les récoltes d'un agriculteur durant une année
       function top_office_in_year($year,$agr_id)
       {
            global $db;
            $top_offices = $db->prepare("select count(office_id) as cpt ,nom from récoltes INNER join offices 
            on récoltes.office_id = offices.id and récoltes.agriculteur_id = ? and YEAR(date) = ? 
            GROUP BY récoltes.office_id ORDER BY cpt DESC LIMIT 1");
            $top_offices->execute([$agr_id,$year]);
            $result = $top_offices->fetch(PDO::FETCH_ASSOC);

            return $result['nom'].' ('.$result['cpt'].' fois )';
       }
       // le produit  le plus fréquant dans les récoltes d'un agriculteur durant une année
       function top_product_in_year($year,$id,$type)
       {
            global $db;
            if($type == 'agriculteur')
            {
                $top_product = $db->prepare("select count(produit_code) as cpt ,description from récoltes 
                INNER join produit on récoltes.produit_code = produit.code and récoltes.agriculteur_id = ? and YEAR(date) = ?
                 GROUP BY récoltes.produit_code ORDER BY cpt DESC LIMIT 1");
            }
            else if($type == 'office')
            {
                $top_product = $db->prepare("select count(produit_code) as cpt ,description from récoltes 
                INNER join produit on récoltes.produit_code = produit.code and récoltes.office_id = ? and YEAR(date) = ?
                GROUP BY récoltes.produit_code ORDER BY cpt DESC LIMIT 1");
            }
            else
            {
                $top_product = $db->prepare("select count(produit_code) as cpt ,description from récoltes 
                INNER JOIN produit on récoltes.produit_code = produit.code
                INNER JOIN offices ON récoltes.office_id = offices.id 
                INNER JOIN users ON offices.user_id = users.id 
                and users.wilaya_id = ? and YEAR(date) = ?
                GROUP BY récoltes.produit_code ORDER BY cpt DESC LIMIT 1");
            }
            
            $top_product->execute([$id,$year]);
            $result = $top_product->fetch(PDO::FETCH_ASSOC);

            return $result['description'];
       }
        // la qualité  la plus fréquante dans les récoltes d'un agriculteur ou office ou wilaya durant une année 
        function top_quality_in_year($year,$id,$type)
        {
             global $db;
             if($type == 'agriculteur')
             {
                $top_qualité = $db->prepare("select count(Qualité) as cpt,Qualité from récoltes WHERE agriculteur_id = ?
                and YEAR(date) = ? GROUP BY Qualité ORDER BY cpt DESC LIMIT 1");
             }
             else if($type == 'office')
             {
                $top_qualité = $db->prepare("select count(Qualité) as cpt,Qualité from récoltes WHERE office_id = ?
                and YEAR(date) = ? GROUP BY Qualité ORDER BY cpt DESC LIMIT 1");
             }
             else
             {
                $top_qualité = $db->prepare("select count(Qualité) as cpt,Qualité from récoltes 
                                             INNER JOIN offices ON récoltes.office_id = offices.id
                                             INNER JOIN users ON users.id = offices.user_id
                                             INNER JOIN wilayas ON wilayas.id = users.wilaya_id
                                             AND wilayas.id = ? AND YEAR(date) = ? 
                                             GROUP BY Qualité ORDER BY cpt DESC LIMIT 1
                                            ");
             }
             
             $top_qualité->execute([$id,$year]);
             $result = $top_qualité->fetch(PDO::FETCH_ASSOC);
 
             return $result['Qualité'];
        }

        //best office in wilaya in year
        function best_office_in_wilaya($wilaya_id,$year)
        {
            global $db;
            $best_office = $db->prepare("SELECT offices.nom as best_office , SUM(récoltes.quantité) as s_quan FROM récoltes
                                     INNER JOIN offices ON récoltes.office_id = offices.id 
                                     INNER JOIN users ON offices.user_id = users.id AND users.wilaya_id = ?
                                     AND YEAR(date) = ? 
                                     GROUP BY offices.id
                                     order by s_quan desc
                                     LIMIT 1");

            $best_office->execute([$wilaya_id,$year]);

            $best_office_result = $best_office->fetch(PDO::FETCH_ASSOC);
            return $best_office_result['best_office'].' ('.$best_office_result['s_quan'] .' tonne)';

        }
        //best agriculteur in wilaya in year
        function best_agr_in_wilaya($wilaya_id,$year)
        {
            global $db;
            $best_agr = $db->prepare("SELECT agriculteurs.nom as best_agr_nom,
                                     agriculteurs.prenom as best_agr_prenom, SUM(récoltes.quantité) as s_quan FROM récoltes
                                     INNER JOIN agriculteurs ON récoltes.agriculteur_id = agriculteurs.id 
                                     INNER JOIN users ON agriculteurs.user_id = users.id AND users.wilaya_id = ?
                                     AND YEAR(date) = ? 
                                     GROUP BY agriculteurs.id
                                     order by s_quan desc
                                     LIMIT 1");

            $best_agr->execute([$wilaya_id,$year]);

            $best_agr_result = $best_agr->fetch(PDO::FETCH_ASSOC);
            return $best_agr_result['best_agr_nom'].' '.$best_agr_result['best_agr_prenom'].' ('.$best_agr_result['s_quan'] .' tonne)';

        }

        /// trouver le montant d'un recolte par id

        function montant_recolte($id)
        {
            global $db;

            $montant = $db->prepare("SELECT * FROM récoltes WHERE id = ? ");
            $montant->execute([$id]);

            $montant_result = $montant->fetch(PDO::FETCH_ASSOC);
            return $montant_result['montant'];
        }
        

        // factures count

        function factures_count()
        {
            global $db;

            $facture_count = $db->prepare("SELECT COUNT(*) AS cpt FROM factures");
            $facture_count->execute();

            $facture_count_result = $facture_count->fetch(PDO::FETCH_ASSOC);
            return $facture_count_result['cpt'];
        }
        // vérifer si un  récolte donné est déja facturé ou non

        function exist_in_facture($recolte_id,$agr_id)
        {
            global $db;


            $is_exist = $db->prepare("SELECT * FROM factures WHERE agriculteur_id = ? ");
                                   
            $is_exist->execute([$agr_id]);

            if($is_exist->rowCount() == 0)
            {
                    $boolean = 'false';
            }
            else
            {
                $is_exist_result = $is_exist->fetchAll(PDO::FETCH_ASSOC);

                foreach($is_exist_result as $result)
                {
                          
                           $array_recoltes = unserialize($result['recoltes_id']);
    
                           foreach ($array_recoltes as $item)
                           {
                               if($item == $recolte_id)
                               {
                                    $boolean = 'true';
                                    break;
                               }
                               else
                               {
                                     $boolean = 'false';
                               }
                           }
                           if($boolean == 'true')
                           {
                             break;
                           }
                }
            }

            


            if($boolean == 'true')
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    
        /// information d'un récolte

        function recolte_information($id)
        {
             global $db;

             $recolte = $db->prepare("SELECT * FROM récoltes WHERE id = ? ");
             $recolte->execute([$id]);

             $recolte_result = $recolte->fetch(PDO::FETCH_ASSOC);

             return $recolte_result;
        }

        //// number of harvest of a farmer in a year

        function all_recolte_of_agr($agr_id,$year = 'tous')
        {
            global $db;
   
            if($year == 'tous')
            {
                $count = $db->prepare("SELECT COUNT(*) AS cpt FROM récoltes WHERE agriculteur_id = ? ");
                $count->execute([$agr_id]);
            }
            else
            {
                $count = $db->prepare("SELECT COUNT(*) AS cpt FROM récoltes WHERE agriculteur_id = ? AND YEAR(date) = ?");
                $count->execute([$agr_id,$year]);
            }
            
            $count_result = $count->fetch(PDO::FETCH_ASSOC);
             
             return $count_result['cpt'];
        }
        //// le nombre des recoltes d'un agriculteur

        function all_recolte_of_office($office_id,$year = 'tous')
        {
             global $db;

             if($year == 'tous')
             {
                 $count = $db->prepare("SELECT COUNT(*) AS cpt FROM récoltes WHERE office_id = ? ");
                 $count->execute([$office_id]);
             }
             else
             {
                 $count = $db->prepare("SELECT COUNT(*) AS cpt FROM récoltes WHERE office_id = ? AND YEAR(date) = ?");
                 $count->execute([$office_id,$year]);
             }

             $count_result = $count->fetch(PDO::FETCH_ASSOC);
             return $count_result['cpt'];
        }
        
        /// check if the email exist in users tabel
        function email_exist($email)
        {
             global $db;

             $email_count = $db->prepare("SELECT COUNT(*) AS cpt FROM users WHERE email = ? ");
             $email_count->execute([$email]);

             $email_result = $email_count->fetch(PDO::FETCH_ASSOC);

             if($email_result['cpt'] == 0)
             {
                 return false;
             }
             else
             {
                 return true;
             }
             
        }

        /// check if the user have already a reset password code inserted to update if not we insert a new code
        function user_have_already_rest_code($email)
        {
            global $db;

            $rest_code = $db->prepare("SELECT * FROM password_reset WHERE user_email = ? ");
            $rest_code->execute([$email]);

            if($rest_code->rowCount() == 0)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        ////
        function reset_code_matches($email,$code)
        {
            global $db;

            $code_match = $db->prepare("SELECT * FROM password_reset WHERE user_email = ? AND code = ?");
            $code_match->execute([$email,$code]);

            if($code_match->rowCount() == 0)
            {
                return false;
            }
            else
            {
                return true;
            }
        }

        function find_user_id_by_email($email)
        {
            global $db;

            $id = $db->prepare("SELECT * FROM users WHERE email = ? ");
            $id->execute([$email]);

            $id_result = $id->fetch(PDO::FETCH_ASSOC);

            return $id_result['id'];
        }

        // all members belons to wilaya 

        function all_members($wilaya_id)
        {
             global $db;

             $members = $db->prepare("SELECT email,nom FROM users INNER JOIN agriculteurs ON users.id = agriculteurs.user_id
                                      AND users.wilaya_id = ?");
             $members->execute([$wilaya_id]);
             
             $members_result = $members->fetchAll(PDO::FETCH_ASSOC);
             return $members_result;

        }
        // all_subscriber and belons to teh same wilaya 

        function all_subscribers($wilaya_id)
        {
            global $db;

            $subscribers = $db->prepare("SELECT email,nom FROM users INNER JOIN agriculteurs ON users.id = agriculteurs.user_id
                                        AND users.wilaya_id = ? AND email IN(SELECT email FROM newslatter) ");
            
            $subscribers->execute([$wilaya_id]);
             
            $subscribers_result = $subscribers->fetchAll(PDO::FETCH_ASSOC);

            return $subscribers_result;

        }
        // all_subscriber and belons to teh same wilaya 

        function all_in_newslatter()
        {
            global $db;

            $all_in_newslatter = $db->prepare("SELECT email FROM newslatter");
            
            $all_in_newslatter->execute();
             
            $all_in_newslatter_result = $all_in_newslatter->fetchAll(PDO::FETCH_ASSOC);

            return $all_in_newslatter_result;

        }
        
        // check if this appointement is already exist or not 
        function appointement_already_exist($date,$office_id)
        {
            global $db;

            $is_exist = $db->prepare("SELECT * FROM rendez_vous WHERE date = ? AND office_id = ?");
            $is_exist->execute([$date,$office_id]);
  
            if($is_exist->rowCount() == 0)
            {
                 return false;
            }
            else
            {
                 return true;
            }

        }

        // user celong to the same wilaya

        function is_member($user_id,$wilaya_id)
        {
              global $db;

              $is_member = $db->prepare("SELECT * FROM users WHERE id = ? AND wilaya_id = ?");
              $is_member->execute([$user_id,$wilaya_id]);

              if($is_member->rowCount() == 0)
              {
                  return false;
              }
              else
              {
                  return true;
              }
        }
        //delete a memeber 
        function delete_member($agr_id)
        {
              global $db;

              $user_id = find_agr_user_id($agr_id);

              // delete all factures of the member
              $delete_factures = $db->prepare("DELETE FROM factures WHERE agriculteur_id = ? ");
              $delete_factures->execute([$agr_id]);

              // delete all harvest of the member
              $delete_harvest = $db->prepare("DELETE FROM récoltes WHERE agriculteur_id = ?");
              $delete_harvest->execute([$agr_id]);

              // delete all appointements of the member
              $delete_appointment = $db->prepare("DELETE FROM rendez_vous WHERE agriculteur_id = ?");
              $delete_appointment->execute([$agr_id]);

              try
              {

                    $delete_agr = $db->prepare("DELETE FROM agriculteurs WHERE id = ?");
                    $delete_agr->execute([$agr]);

                    try
                    {          
                        $delete_agr = $db->prepare("DELETE FROM users WHERE id = ?");
                        $delete_agr->execute([$user_id]);

                        return true;
                    }
                    catch (Exception $e)
                    {
                        return false;
                    }
              }
              catch (Exception $e)
              {
                     return false;
              }

        }


        //// in array assoc

        function in_assoc_array($key,$value,$array)
        {
            if (empty($array))
                return false;
            else
            {
                foreach($array as $a)
                {
                    if ($a[$key] == $value)
                        return true;
                }
                return false;
            }
        }

        function all_available_years($option = 'current_year_selected')
        {
            $first_year = '2019';  // we set it to 2019 to show example but should be inisialized by the year of the sign_up of the first user
            
            //$current_year
            $current_year = date('Y');
            
  
            $output = '';

            for($year = $first_year;$year<=$current_year;$year++)
            {
                if($year == $current_year)
                {
                    $output.= '<option value="'.$year.'"';
                    $output.= ($option == 'current_year_selected') ? 'selected' : '';
                    $output.= '>'.$year.'</option>';
                }
                else
                {
                        $output.= '<option value="'.$year.'">'.$year.'</option>';
                }
                
            }
            return $output;
        }


        function product_already_used($product_id)
        {
             
            global $db;

            $is_used = $db->prepare("SELECT * FROM récoltes  
                                     INNER JOIN produit ON récoltes.produit_code = produit.code 
                                     AND produit.code = ? ");

            $is_used->execute([$product_id]);
  
            if($is_used->rowCount() == 0)
            {
                 return false;
            }
            else
            {
                 return true;
            }

        }

        // find harvest information
        function harvest_information($harvest_id)
        {
            global $db;

            $harvest = $db->prepare("SELECT * from récoltes where id = ? ");
            
            $harvest->execute([$harvest_id]);
             
            $harvest_result = $harvest->fetchAll(PDO::FETCH_ASSOC);

            return $harvest_result;
        }
?>