<nav class="navbar navbar-inverse">
    <div class="container">
      <!-- <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
      </div>
 -->
    <ul class="nav navbar-nav" id="main-menu">        
        <?php
                if($_SESSION['page_permission'] == 'no'){
                    echo '<li class="';
                    if($page == 'allow_page'){echo 'active';}
                    echo '"><a href="../vaucher/no_permission.php">ডেমো মেনু</a></li>';
                } else {
                    // if($_SESSION['home'] == 'yes'){
                    //     echo '<li class="';
                    //     if($page == 'home'){echo 'active';}
                    //     echo '"><a href="../vaucher/home.php">হোম</a></li>';
                    // } else {
                    //     echo '';
                    // }

                    if(isset($_SESSION['project_name_id'])){
                        echo '<li class="';
                        if($page == 'doinik_all_hisab'){echo 'active';}
                        else if($_SESSION['pageName'] == 'protidiner_hisab'){echo 'active';}
                        else if($_SESSION['pageName'] == 'modify_data'){echo 'active';}
                        else if($_SESSION['pageName'] == 'joma_khat'){echo 'active';}
                        else if($_SESSION['pageName'] == 'khoros_khat'){echo 'active';}
                        else if($_SESSION['pageName'] == 'khoros_khat_entry'){echo 'active';}
                        else if($_SESSION['pageName'] == 'nije_pabo'){echo 'active';}
                        else if($_SESSION['pageName'] == 'jara_pabe'){echo 'active';}
                        else if($_SESSION['pageName'] == 'report'){echo 'active';}
                        else if($_SESSION['pageName'] == 'agrim_hisab'){echo 'active';}
                        else if($_SESSION['pageName'] == 'cash_calculator'){echo 'active';}
                         //Manzu raj_kajerhisab get page
                        //else if($_SESSION['pageName'] == 'raj_kajerhisab'){echo 'active';}

                        else if($_SESSION['pageName'] == 'report_khoros_khat'){echo 'active';}
                        else if($_SESSION['pageName'] == 'report_nije_pabo'){echo 'active';}
                        else if($_SESSION['pageName'] == 'report_paonader'){echo 'active';}

                        echo '"><a href="../vaucher/doinik_all_hisab.php">দৈনিক হিসাব</a></li>';
                         
  
 

                        if($_SESSION['raj_kajer_all_hisab'] == 'yes'){
                            echo '<li class="';
                            if($page == 'raj_kajer_all_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'raj_kajerhisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'raj_kajer_details_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'raj_kajer_mistree'){echo 'active';}
                            echo '"><a href="../vaucher/raj_kajer_all_hisab.php">রাজ কাজের হিসাব</a></li>';
                        } else {
                            echo '';
                        }
                        if($_SESSION['rod_hisab'] == 'yes'){
                            echo '<li class="';
                            if($page == 'rod_hisab'){echo 'active';}

                            if($_SESSION['pageName'] == 'rod_kroy_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_bikroy_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_hisab_entry'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_dealer_entry'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_cusotomer_entry'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_buyer_entry'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_report_buy_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_report_sell_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_report_dealer'){echo 'active';}

                            echo '"><a href="../vaucher/rod_index.php">রড হিসাব</a>';
                            echo '</li>';
                        }
                        if($_SESSION['rod_hisab'] == 'yes'){
                            echo '<li class="';
                            if($page == 'rod_hisab'){echo 'active';}

                            if($_SESSION['pageName'] == 'rod_kroy_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_bikroy_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_hisab_entry'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_dealer_entry'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_cusotomer_entry'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_buyer_entry'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_report_buy_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_report_sell_hisab'){echo 'active';}
                            else if($_SESSION['pageName'] == 'rod_report_dealer'){echo 'active';}

                            echo '"><a href="../vaucher/rod1_index.php">balu হিসাব</a>';
                            echo '</li>';
                        }
                        if($_SESSION['electric_kroy_bikroy'] == 'yes'){
                          echo '<li class="';
                          if($page == 'electric_kroy_bikroy'){echo 'active';}

                          if($_SESSION['pageName'] == 'electric_day_hisab'){echo 'active';}
                          else if($_SESSION['pageName'] == 'electric_details_hisab'){echo 'active';}
                          else if($_SESSION['pageName'] == 'electric_suplier_create'){echo 'active';}
                         // echo '"><a href="../vaucher/electric_kroy_bikroy.php">ইলেকট্রিক মালের খরচ হিসাব</a>';
                          echo '"><a href="../vaucher/electric_kroy_bikroy.php">ক্রয় হিসাব</a>';
                          echo '</li>';
                      }
                       // if($_SESSION['raj_kajer_all_hisab'] == 'yes'){
                          echo '<li class="';
                          if($page == 'employee'){echo 'active';}
                          else if($_SESSION['pageName'] == 'employee_everyday_entry'){echo 'active';}
                          else if($_SESSION['pageName'] == 'employee_details_hisab'){echo 'active';}
                          else if($_SESSION['pageName'] == 'employee_new_create'){echo 'active';}
                          echo '"><a href="../vaucher/employee.php">কর্মচারী</a></li>';
                      // } else {
                      //     echo '';
                      // }
                    }
                }

                

        ?>
    </ul>











      <?php
        $imgNameFromDb = '';
        $sesstion_user_name = $_SESSION['username'];
        $query = "SELECT photo FROM login WHERE username = '$sesstion_user_name'";
        $result = $db->select($query);
        if ($result){
            $row = $result->fetch_assoc();
            $imgNameFromDb = $row['photo'];
            // var_dump($imgNameFromDb."asdsdf");
        }
        else
        {
            echo 'Image not retrived, Error From DB !';
        }
      ?>


      <ul class="nav navbar-nav navbar-right">
        <li class="<?php
            $sub_mnu_active = '';
            $sub_mnu_active2 = '';
            $sub_mnu_active3 = '';
            $sub_mnu_active4 = '';
            $sub_mnu_active5 = '';
            $sub_mnu_active6 = '';
            if($_SESSION['pageName'] == 'user_permision_by_admin'){echo 'active'; $sub_mnu_active = 'sub_mnu_active';}
            else if($_SESSION['pageName'] == 'page_setting'){echo 'active'; $sub_mnu_active2 = 'sub_mnu_active';}
            else if($_SESSION['pageName'] == 'create_project'){echo 'active'; $sub_mnu_active3 = 'sub_mnu_active';}
            else if($_SESSION['pageName'] == 'create_user'){echo 'active'; $sub_mnu_active4 = 'sub_mnu_active';}
            else if($_SESSION['pageName'] == 'user_setting'){echo 'active'; $sub_mnu_active5 = 'sub_mnu_active';}
            else if($_SESSION['pageName'] == 'change_password'){echo 'active'; $sub_mnu_active6 = 'sub_mnu_active';}
            
        ?>">
            <a href="" data-toggle="dropdown" style="padding: 3px 10px 3px 3px;">
                <!-- <span class="glyphicon glyphicon-cog"> -->
                <img src="<?php
                    if($imgNameFromDb == ''){
                        echo '../img/user_photo/default_user_photo.jpg';
                    } else {
                        echo '../img/user_photo/' . $imgNameFromDb;
                    }
                ?>" height="44px" width="44px"/>
                সেটিংস <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <?php
                   $fullname = ucwords($_SESSION['first_name'])." ".ucwords($_SESSION['last_name']);
                   // var_dump($fullname);
                ?>                
              <li class="text-right"><a><b><?php echo $fullname; ?></b></a></li>
              <li class="text-right"><a><?php echo $_SESSION['username']; ?></a></li>
                <?php
                    if(isset($_SESSION['project_name_id'])){
                        if($_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'superAdmin'){
                            echo '<li class="text-right '. $sub_mnu_active .'"><a href="../vaucher/user_permission_by_admin.php">ইউজার পেইজের অনুমতি</a></li>';
                            echo '<li class="text-right '. $sub_mnu_active2 .'"><a href="../others_page/page_setting.php">পেইজ সেটিং</a></li>';
                            echo '<li class="text-right '. $sub_mnu_active3 .'"><a href="../others_page/create_project.php">প্রজেক্ট তৈরি করা</a></li>';
                        }

                        // if($_SESSION['create_user'] == 'yes'){
                        echo '<li class="text-right '. $sub_mnu_active4 .'"><a href="../vaucher/create_user.php">ইউজার তৈরি করা</a></li>'; 
                        // }
                        echo '<li class="text-right '. $sub_mnu_active5 .'"><a href="../others_page/user_setting.php">ইউজার সেটিং</a></li>';
                        echo '<li class="text-right '. $sub_mnu_active6 .'"><a href="../vaucher/change_password.php">পাসওয়ার্ড পরিবর্তন করুন</a></li>';
                    }
                ?>
              
              <li class="text-right"><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> লগ আউট</a></li>
            </ul>
        </li>
      </ul>
  <!--     <form class="navbar-form navbar-left" action="">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search" name="search">
      <div class="input-group-btn">
        <button class="btn btn-default" type="submit">
          <i class="glyphicon glyphicon-search"></i>
        </button>
      </div>
    </div>
  </form> -->
    </div>
</nav>



