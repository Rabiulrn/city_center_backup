<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $_SESSION['pageName'] = 'raj_kajerhisab';
    
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];
    $sucMsg = "";
    $imgName = '';
     

     if (isset($_POST['mistressLocation'])) {
           $query_hedmistress = "SELECT * FROM raj_kajer_location WHERE location_status = '1' AND project_name_id = '$project_name_id' ";
                $showData = $db->select($query_hedmistress);
                    if ($showData) { 

                ?>

                <select class="form-control location_name" name="r_location_name" id="r_location_name" required >
                        <option value="">কাজের স্থান নির্ধারন করুন</option>
                <?php
                    while ($rows = $showData->fetch_assoc()) {
                ?>
                                           
                <option value="<?php echo $rows['id']; ?>" id="<?php echo $rows['id']; ?>" > <?php echo $rows['hedmistress_location_name']; ?> </option>
                                                          
       <?php
        }
        ?>
      </select>

      <?php
    }
}   
     

      


  if ($_POST["action"] == "single_view") {

  $query = "SELECT * FROM raj_kajerhisab 
    LEFT JOIN raj_kajer_hedmistress ON raj_kajer_hedmistress.id = raj_kajerhisab.r_hedmistress
    LEFT JOIN raj_kajer_location ON raj_kajer_location.id = raj_kajerhisab.r_location_name
    WHERE raj_kajerhisab.id ='".$_POST["id"]."' ";

            //$query_hedmistress1 = "SELECT * FROM raj_kajerhisab  WHERE project_name_id = '$project_name_id' ";

                $data = $db->select($query);
                    if ($data) {
                      $i = 1;
                    while ($rowsnew = $data->fetch_assoc()) {
                      //echo $rowsnew['id'];
                    
                ?>
                  <table class="table_dis">
                      <thead>
                          <tr style="background-color: #b5b5b5;">
                                <th class="cenText">নং</th>
                                <th class="cenText" style="width: 86px;">তারিখ</th>
                                <th class="cenText">ঠিকানা</th>                         
                                <th class="cenText">হেড মিস্ত্রী নাম</th>
                                <!-- <th class="cenText">কাজের স্থান</th> -->
                                <th class="cenText">মারফোত নাম</th>
                                
                                <th class="cenText">কান্ট্রাক</th>
                                <th class="cenText">বাক্তির ধরণ</th>
                                <th class="cenText">দর</th>
                                <th class="cenText">জন</th>
                                <th class="cenText">কাজের বিল</th>
                                <th class="cenText">নগদ জমা</th>
                                <th class="cenText">পাওনা</th>

                          </tr>
                      </thead>
                      <tbody id="hedmistress_area">
       
                           <tr id="row_<?php echo $rowsnew['id']; ?>">
                            <td align="center"><?php echo $i++; ?></td>
                            <td align="center"><?php echo $rowsnew['r_date']; ?></td>
                            <td align="center"><?php echo $rowsnew['r_address']; ?></td>
                            <td align="center"><?php echo $rowsnew['hedmistress_name']; ?></td>
                            <!-- <td align="center"><?php // echo $rowsnew['hedmistress_location_name']; ?></td> -->
                            <td align="center"><?php echo $rowsnew['r_marphot']; ?></td>

                            <td align="center"><?php echo $rowsnew['r_contract']; ?></td>
                            <td align="center"><?php echo $rowsnew['r_job_cat']; ?></td>
                            <td align="center"><?php echo $rowsnew['r_taka']; ?></td>
                            <td align="center"><?php echo $rowsnew['r_person']; ?></td>
                            <td align="center"><?php echo $rowsnew['r_totalbill']; ?></td>
                            <td align="center"><?php echo $rowsnew['r_credit']; ?></td>
                            <td align="center"><?php echo $rowsnew['r_paowna']; ?></td>
                            
                           </tr>
                             
                    </tbody>
                        

                </table>    
                <?php 

                    }
                }
                    
        

        }



if ($_POST["action"] == "view_details") {

    // $query = "SELECT * FROM raj_kajer_location 
    // LEFT JOIN raj_kajerhisab ON raj_kajerhisab.r_location_name = raj_kajer_location.id
    // LEFT JOIN raj_kajer_hedmistress ON raj_kajer_hedmistress.id = raj_kajerhisab.r_hedmistress
    // WHERE raj_kajer_location.id ='".$_POST["id"]."'";

  $query = "SELECT * FROM 
    raj_kajer_hedmistress LEFT JOIN raj_kajerhisab ON raj_kajerhisab.r_hedmistress = raj_kajer_hedmistress.id LEFT JOIN project_heading ON project_heading.id = raj_kajer_hedmistress.project_name_id
    WHERE raj_kajer_hedmistress.project_name_id ='$project_name_id' AND  raj_kajer_hedmistress.id ='".$_POST["id"]."' ";

      $resultTotalbilMistree = "SELECT SUM(r_totalbill) AS sum_r_totalbill, SUM(r_credit) AS sum_r_credit, SUM(r_paowna) AS sum_r_paowna  FROM raj_kajerhisab WHERE r_hedmistress ='".$_POST["id"]."'  "; 
          //Total accoutnt for specific Mistree
            $rowSumMistree = $db->select($resultTotalbilMistree); 
            $fetchTotalMistree     = $rowSumMistree->fetch_assoc();
            $total_Bill_Mistree    = $fetchTotalMistree['sum_r_totalbill'];
            $total_credit_Mistree  = $fetchTotalMistree['sum_r_credit'];
            $total_paowna_Mistree  = $fetchTotalMistree['sum_r_paowna'];

          $resultTotalbil = "SELECT SUM(r_totalbill) AS sum_r_totalbill, SUM(r_credit) AS sum_r_credit, SUM(r_paowna) AS sum_r_paowna  FROM raj_kajerhisab WHERE project_name_id ='$project_name_id' "; 
          $rowSum = $db->select($resultTotalbil); 
          $fetchTotal    = $rowSum->fetch_assoc();

          $total_sum     = $fetchTotal['sum_r_totalbill'];
          $total_credit  = $fetchTotal['sum_r_credit'];
          $total_paowna  = $fetchTotal['sum_r_paowna'];


                    $data2 = $db->select($query);
                    $display = $data2->fetch_assoc();
                    $imgName =    $display['hedmistress_profile_pic'];
                    $docName =    $display['hedmistress_ducument'];
                    $contractAmount=    $display['contract'];
                    $chuktiPowna =  $contractAmount - $total_credit;
 
              
                      
                     
          if($imgName==""){?>
            <div class="profile">
                <div class="profile_area">
                  <h2 style="text-align: center; margin-top: 0px;"> 
                   
                 </h2>
                      
                    </div>
                      
                  <?php }else{?>
        <div class="inlineDiv">
              <div class="profile_area">
                <img class="profileImg" src="../uploads/profilepic/<?php echo $imgName ?>">

                  <div style="text-align: center; margin-top: 0px; font-size: 16px"> <?php echo $display['hedmistress_name']; ?>                  
                 </div>
                    </div>

                 <?php  } ?>
                                    
              <div class="custom_text">
                  <div style=" margin-top: 0px; font-size: 16px">কাজের হিসাব।</div>
                  <div style=" margin-top: 0px;font-size: 16px">কাজের বিল।</div>                
              </div>

              <div class="raj_align">
                <div style="font-size: 16px">  <?php echo $display['heading'] .','; ?> </div>
                 <div style="margin-left: 10px;font-size: 16px">মোবাইল নাম্বারঃ </div>
                 <div style="font-size: 16px" > <?php echo $display['hedmistress_mobile_num']; ?> </div>
              </div>
              <?php  if($docName==""){ ?>
                <div class="profiledoc">
                 
               </div>
              <?php  } else { ?>
           
              <div class="profiledoc" style="text-align: center">
               
                 <img class="docImg" src="../img/document-file-icon.png" style="width: 35px;
margin-right: 20px;text-align: center;">
                 <a href="../uploads/ducuments/<?php  echo $docName ?>"  >
                    <p style="text-align: center" class="downloadText btn btn-success" >Download</p>
                 </a>
               </div>

               <?php  } ?>
    </div>
              
              <table class="table_dis" style="border:1px solid black;margin-left:auto;margin-right:auto; margin-bottom: 20px; padding:10px;width: 400px; ">
                          <!-- <caption>table title and/or explanatory text</caption> -->
                    
                          <tbody >
                            <tr>
                              <td>চুকতিপাত্র</td>
                              <td><?php echo $contractAmount; ?></td>
                              <td></td>
                              <td>মোট  বিল</td>
                              <td><?php echo $total_sum ?></td>
                            </tr>
                            <tr>
                              <td>চুকতি পাওনা</td>
                              <td> <?php echo $chuktiPowna ?> </td>
                              <td></td>
                              <td>মোট জমা</td>
                              <td> <?php echo $total_credit ?></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>পাওনা</td>
                              <td> <?php echo $total_paowna ?> </td>
                            </tr>
                          </tbody>
                </table>

                <table class="table_dis">
                      <thead>
                          <tr style="background-color: #b5b5b5;">
                                <th class="cenText">নং</th>
                                <th class="cenText" style="width: 86px;">তারিখ</th> 
                                <th class="cenText">ঠিকানা</th>                        
                                <th class="cenText">হেড মিস্ত্রী নাম</th>
                                <!-- <th class="cenText">কাজের স্থান</th> -->
                                <th class="cenText">মারফোত নাম</th>
                                
                                <th class="cenText">কান্ট্রাক</th>
                                <th class="cenText">বাক্তির ধরণ</th>
                                <th class="cenText">দর</th>
                                <th class="cenText">জন</th>
                                <th class="cenText">কাজের বিল</th>
                                <th class="cenText">নগদ জমা</th>
                                <th class="cenText">পাওনা</th>

                          </tr>
                      </thead>
                      <tbody id="hedmistress_area">
                       

                 <?php 
                  $data = $db->select($query);
                  $i = 1;
                    while ($rowsnew = $data->fetch_assoc()) {
                     
                    
                ?>

                           <tr id="row_<?php echo $rowsnew['id']; ?>">
                            <td align="center"><?php echo $i++; ?></td>
                            <td align="center"><?php echo $rowsnew['r_date']; ?></td>
                            <td align="center"><?php echo $rowsnew['address']; ?></td>
                            <td align="center"><?php echo $rowsnew['hedmistress_name']; ?></td>
                            <!-- <td align="center"><?php // echo $rowsnew['heading']; ?></td> -->
                            <td align="center"><?php echo $rowsnew['marphot_name']; ?></td>

                            <td align="center"><?php echo $rowsnew['contract']; ?></td>
                           <td align="center">

                                 <?php echo $rowsnew['r_job_cat']; ?>
          
                            </td>
                              
                            <td align="center">
                                 <?php echo $rowsnew['r_taka']; ?>
       
                              </td>
                            <td align="center">

                              <?php echo $rowsnew['r_person']; ?>
                               
                              </td>
                            <td align="center">

                              <?php echo $rowsnew['r_totalbill']; ?>
                                
                              </td>
                            <td align="center">
                                <?php echo $rowsnew['r_credit']; ?>
                                
                                
                              </td>
                            <td align="center">
                              <?php echo $rowsnew['r_paowna']; ?>
                             
                              </td>
                            
                           </tr>
                             
                   
                <?php 

                    }
                ?> 

                <tr>
                                
      
                    <th class="cenText" colspan="9"></th>

                    <th class="cenText"><?php echo $total_Bill_Mistree; ?></th>
                    <th class="cenText"><?php echo $total_credit_Mistree; ?></th>
                    <th class="cenText" colspan="3"> <?php echo $total_paowna_Mistree; ?></th>

                            
                </tr>

                </tbody>
                        

                </table>    

                <?php
              //  }
                    
        

        }elseif($_POST["action"] == "auto_view"){

          $query = "SELECT * FROM 
          raj_kajer_hedmistress LEFT JOIN raj_kajerhisab ON raj_kajerhisab.r_hedmistress = raj_kajer_hedmistress.id LEFT JOIN project_heading ON project_heading.id = raj_kajer_hedmistress.project_name_id
          WHERE raj_kajer_hedmistress.project_name_id ='$project_name_id' AND  raj_kajer_hedmistress.id ='".$_POST["id"]."' ";
      
            $resultTotalbilMistree = "SELECT SUM(r_totalbill) AS sum_r_totalbill, SUM(r_credit) AS sum_r_credit, SUM(r_paowna) AS sum_r_paowna  FROM raj_kajerhisab WHERE r_hedmistress ='".$_POST["id"]."'  "; 
                //Total accoutnt for specific Mistree
                  $rowSumMistree = $db->select($resultTotalbilMistree); 
                  $fetchTotalMistree     = $rowSumMistree->fetch_assoc();
                  $total_Bill_Mistree    = $fetchTotalMistree['sum_r_totalbill'];
                  $total_credit_Mistree  = $fetchTotalMistree['sum_r_credit'];
                  $total_paowna_Mistree  = $fetchTotalMistree['sum_r_paowna'];
      
                $resultTotalbil = "SELECT SUM(r_totalbill) AS sum_r_totalbill, SUM(r_credit) AS sum_r_credit, SUM(r_paowna) AS sum_r_paowna  FROM raj_kajerhisab WHERE project_name_id ='$project_name_id' "; 
                $rowSum = $db->select($resultTotalbil); 
                $fetchTotal    = $rowSum->fetch_assoc();
      
                $total_sum     = $fetchTotal['sum_r_totalbill'];
                $total_credit  = $fetchTotal['sum_r_credit'];
                $total_paowna  = $fetchTotal['sum_r_paowna'];
      
      
                $data2   = $db->select($query);
                $display = $data2->fetch_assoc();
                $imgName = $display['hedmistress_profile_pic'];
                $docName = $display['hedmistress_ducument'];
                $contractAmount = $display['contract'];
                $chuktiPowna =  $contractAmount - $total_credit;
                                                                  
                if($imgName==""){?>
                  <div class="profile">
                      <div class="profile_area">
                        <h2 style="text-align: center; margin-top: 0px;"> 
                         
                       </h2>
                            
                          </div>
                            
                        <?php }else{?>
              <div class="inlineDiv">
                    <div class="profile_area">
                      <img class="profileImg" src="../uploads/profilepic/<?php echo $imgName ?>">
      
                        <div style="text-align: center; margin-top: 0px; font-size: 16px"> <?php echo $display['hedmistress_name']; ?>                  
                       </div>
                          </div>
      
                       <?php  } ?>
                                          
                    <div class="custom_text">
                        <div style=" margin-top: 0px; font-size: 16px">কাজের হিসাব।</div>
                        <div style=" margin-top: 0px;font-size: 16px">কাজের বিল।</div>                
                    </div>
      
                    <div class="raj_align">
                      <div style="font-size: 16px">  <?php echo $display['heading'] .','; ?> </div>
                       <div style="margin-left: 10px;font-size: 16px">মোবাইল নাম্বারঃ </div>
                       <div style="font-size: 16px" > <?php echo $display['hedmistress_mobile_num']; ?> </div>
                    </div>
                    <?php  if($docName==""){ ?>
                      <div class="profiledoc">
                       
                     </div>
                    <?php  } else { ?>
                 
                    <div class="profiledoc" style="text-align: center">
                     
                       <img class="docImg" src="../img/document-file-icon.png" style="width: 35px;
      margin-right: 20px;text-align: center;">
                       <a href="../uploads/ducuments/<?php  echo $docName ?>"  >
                          <p style="text-align: center" class="downloadText btn btn-success" >Download</p>
                       </a>
                     </div>
      
                     <?php  } ?>
          </div>
                    
                    <table class="table_dis" style="border:1px solid black;margin-left:auto;margin-right:auto; margin-bottom: 20px; padding:10px;width: 400px; ">
                                <!-- <caption>table title and/or explanatory text</caption> -->
                          
                                <tbody >
                                  <tr>
                                    <td>চুকতিপাত্র</td>
                                    <td><?php echo $contractAmount; ?></td>
                                    <td></td>
                                    <td>মোট  বিল</td>
                                    <td><?php echo $total_sum ?></td>
                                  </tr>
                                  <tr>
                                    <td>চুকতি পাওনা</td>
                                    <td> <?php echo $chuktiPowna ?> </td>
                                    <td></td>
                                    <td>মোট জমা</td>
                                    <td> <?php echo $total_credit ?></td>
                                  </tr>
                                  <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>পাওনা</td>
                                    <td> <?php echo $total_paowna ?> </td>
                                  </tr>
                                </tbody>
                      </table>
      
                      <table class="table_dis">
                            <thead>
                                <tr style="background-color: #b5b5b5;">
                                      <th class="cenText">নং</th>
                                      <th class="cenText" style="width: 86px;">তারিখ</th> 
                                      <th class="cenText">ঠিকানা</th>                        
                                      <th class="cenText">হেড মিস্ত্রী নাম</th>
                                      <th class="cenText">কাজের স্থান</th>
                                      <th class="cenText">মারফোত নাম</th>
                                      
                                      <th class="cenText">কান্ট্রাক</th>
                                      <th class="cenText">বাক্তির ধরণ</th>
                                      <th class="cenText">দর</th>
                                      <th class="cenText">জন</th>
                                      <th class="cenText">কাজের বিল</th>
                                      <th class="cenText">নগদ জমা</th>
                                      <th class="cenText">পাওনা</th>
      
                                </tr>
                            </thead>
                            <tbody id="hedmistress_area">
                             
      
                       <?php 
                        $data = $db->select($query);
                        $i = 1;
                          while ($rowsnew = $data->fetch_assoc()) {
                           
                          
                      ?>
      
                                 <tr id="row_<?php echo $rowsnew['id']; ?>">
                                  <td align="center"><?php echo $i++; ?></td>
                                  <td align="center"><?php echo $rowsnew['r_date']; ?></td>
                                  <td align="center"><?php echo $rowsnew['address']; ?></td>
                                  <td align="center"><?php echo $rowsnew['hedmistress_name']; ?></td>
                                  <td align="center"><?php echo $rowsnew['heading']; ?></td>
                                  <td align="center"><?php echo $rowsnew['marphot_name']; ?></td>
      
                                  <td align="center"><?php echo $rowsnew['contract']; ?></td>
                                 <td align="center">
      
                                       <?php echo $rowsnew['r_job_cat']; ?>
                
                                  </td>
                                    
                                  <td align="center">
                                       <?php echo $rowsnew['r_taka']; ?>
             
                                    </td>
                                  <td align="center">
      
                                    <?php echo $rowsnew['r_person']; ?>
                                     
                                    </td>
                                  <td align="center">
      
                                    <?php echo $rowsnew['r_totalbill']; ?>
                                      
                                    </td>
                                  <td align="center">
                                      <?php echo $rowsnew['r_credit']; ?>
                                      
                                      
                                    </td>
                                  <td align="center">
                                    <?php echo $rowsnew['r_paowna']; ?>
                                   
                                    </td>
                                  
                                 </tr>
                                   
                         
                      <?php 
      
                          }
                      ?> 
      
                      <tr>
                                      
            
                          <th class="cenText" colspan="10"></th>
      
                          <th class="cenText"><?php echo $total_Bill_Mistree; ?></th>
                          <th class="cenText"><?php echo $total_credit_Mistree; ?></th>
                          <th class="cenText" colspan="3"> <?php echo $total_paowna_Mistree; ?></th>
      
                                  
                      </tr>
      
                      </tbody>
                              
      
                      </table>    
      
                      <?php
                    //  }




        }


// Get all date data
if ($_POST["action"] == "date_details") {

  $query = "SELECT * FROM 
    raj_kajer_hedmistress LEFT JOIN raj_kajerhisab ON raj_kajerhisab.r_hedmistress = raj_kajer_hedmistress.id LEFT JOIN project_heading ON project_heading.id = raj_kajer_hedmistress.project_name_id
    WHERE raj_kajer_hedmistress.project_name_id ='$project_name_id' AND  raj_kajer_hedmistress.id ='".$_POST["id"]."' ";


      $resultTotalbilMistree = "SELECT SUM(r_totalbill) AS sum_r_totalbill, SUM(r_credit) AS sum_r_credit, SUM(r_paowna) AS sum_r_paowna  FROM raj_kajerhisab WHERE r_hedmistress ='".$_POST["id"]."'  "; 
          //Total accoutnt for specific Mistree
            $rowSumMistree = $db->select($resultTotalbilMistree); 
            $fetchTotalMistree     = $rowSumMistree->fetch_assoc();
            $total_Bill_Mistree    = $fetchTotalMistree['sum_r_totalbill'];
            $total_credit_Mistree  = $fetchTotalMistree['sum_r_credit'];
            $total_paowna_Mistree  = $fetchTotalMistree['sum_r_paowna'];



          $resultTotalbil = 'SELECT SUM(r_totalbill) AS sum_r_totalbill, SUM(r_credit) AS sum_r_credit, SUM(r_paowna) AS sum_r_paowna  FROM raj_kajerhisab'; 
          $rowSum = $db->select($resultTotalbil); 
          $fetchTotal    = $rowSum->fetch_assoc();

          $total_sum     = $fetchTotal['sum_r_totalbill'];
          $total_credit  = $fetchTotal['sum_r_credit'];
          $total_paowna  = $fetchTotal['sum_r_paowna'];


                    $data2 = $db->select($query);
                    $display = $data2->fetch_assoc();
                    $imgName =    $display['hedmistress_profile_pic'];
                    $docName =    $display['hedmistress_ducument'];
                    $contractAmount=    $display['contract'];
                    $chuktiPowna =  $contractAmount - $total_credit;
 
              
                      
                     
          if($imgName==""){?>
            <div class="profile">
                    <div class="profile_area">
                        <h2 style="text-align: center; margin-top: 0px;"> </h2>
                   
                 
                      
                    </div>
                      
                  <?php  }else{?>
                <div class="flexDiv">
                  
                
                    <div class="profile_area">
                       <img class="profileImg" src="../uploads/profilepic/<?php echo $imgName ?>">

                       <h2 style="text-align: center; margin-top: 0px;"> <?php echo $display['hedmistress_name']; ?></h2>
                   
                 
                    </div>

                 <?php  } ?>
                    
                 
        
              <h3 style="text-align: center; margin-top: 0px;">রাজ কাজের হিসাব।</h3>
              <h4 style="text-align: center; margin-top: 0px;"> মিস্ত্রী ও লেবার কাজের বিল।</h4>
              <?php  if($docName==""){ ?>


              <div class="profiledoc">
                 
               </div>
              <?php  } else { ?>
              <div class="profiledoc">
                 <img class="docImg" src="../img/document-file-icon.png">
                 <a href="../uploads/ducuments/<?php  echo $docName ?>"  >
                    <p class="downloadText btn btn-success" >Download</p>
                 </a>
               </div>

               <?php  } ?>
              
              <div class="raj_align">
                <p>  <?php echo $display['heading'] .','; ?> </p>
                 <p style="margin-left: 10px;">মোবাইল নাম্বারঃ </p>
                 <p> <?php echo $display['hedmistress_mobile_num']; ?> </p>
              </div>

          </div>    
              <table class="table_dis" style="border:1px solid black;margin-left:auto;margin-right:auto; margin-bottom: 20px; padding:10px;width: 400px; ">
                          <!-- <caption>table title and/or explanatory text</caption> -->
                    
                          <tbody >
                            <tr>
                              <td>চুকতিপাত্র</td>
                              <td><?php echo $contractAmount; ?></td>
                              <td></td>
                              <td>মোট  বিল</td>
                              <td><?php echo $total_sum ?></td>
                            </tr>
                            <tr>
                              <td>চুকতি পাওনা</td>
                              <td> <?php echo $chuktiPowna ?> </td>
                              <td></td>
                              <td>মোট জমা</td>
                              <td> <?php echo $total_credit ?></td>
                            </tr>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>পাওনা</td>
                              <td> <?php echo $total_paowna ?> </td>
                            </tr>
                          </tbody>
                </table>

                <table class="table_dis">
                      <thead>
                          <tr style="background-color: #b5b5b5;">
                                <th class="cenText">নং</th>
                                <th class="cenText" style="width: 86px;">তারিখ</th> 
                                <th class="cenText">ঠিকানা</th>                        
                                <th class="cenText">হেড মিস্ত্রী নাম</th>
                                <th class="cenText">কাজের স্থান</th>
                                <th class="cenText">মারফোত নাম</th>
                                
                                <th class="cenText">কান্ট্রাক</th>
                                <th class="cenText">বাক্তির ধরণ</th>
                                <th class="cenText">দর</th>
                                <th class="cenText">জন</th>
                                <th class="cenText">কাজের বিল</th>
                                <th class="cenText">নগদ জমা</th>
                                <th class="cenText">পাওনা</th>

                          </tr>
                      </thead>
                      <tbody id="hedmistress_area">
                       

                 <?php 
                  $data = $db->select($query);
                  $i = 1;
                    while ($rowsnew = $data->fetch_assoc()) {
                     
                    
                ?>

                 
                           <tr id="row_<?php echo $rowsnew['id']; ?>">

                            <td align="center"><?php echo $i++; ?></td>
                            <td align="center"><?php echo $rowsnew['r_date']; ?></td>
                            <td align="center"><?php echo $rowsnew['address']; ?></td>
                            <td align="center"><?php echo $rowsnew['hedmistress_name']; ?></td>
                            <td align="center"><?php echo $rowsnew['heading']; ?></td>
                            <td align="center"><?php echo $rowsnew['marphot_name']; ?></td>

                            <td align="center"><?php echo $rowsnew['contract']; ?></td>
                           <td align="center">

                                 <?php echo $rowsnew['r_job_cat']; ?>
          
                            </td>
                              
                            <td align="center">
                                 <?php echo $rowsnew['r_taka']; ?>
       
                              </td>
                            <td align="center">

                              <?php echo $rowsnew['r_person']; ?>
                               
                              </td>
                            <td align="center">

                              <?php echo $rowsnew['r_totalbill']; ?>
                                
                              </td>
                            <td align="center">
                                <?php echo $rowsnew['r_credit']; ?>
                                
                                
                              </td>
                            <td align="center">
                              <?php echo $rowsnew['r_paowna']; ?>
                             
                              </td>
                            
                           </tr>
                             
                   
                <?php 

                    }
                ?> 

                <tr>
                                
      
                    <th class="cenText" colspan="10"></th>

                    <th class="cenText"><?php echo $total_Bill_Mistree; ?></th>
                    <th class="cenText"><?php echo $total_credit_Mistree; ?></th>
                    <th class="cenText" colspan="3"> <?php echo $total_paowna_Mistree; ?></th>

                            
                </tr>

                </tbody>
                        

                </table>    

                <?php
              //  }
                    
        

        }
       
       
       

?>