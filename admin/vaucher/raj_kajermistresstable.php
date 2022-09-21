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

    $sucMsg = "";
     
        
if (isset($_POST['checkhedmistre'])) {
  

  $query_hedmistress1 = "SELECT raj_kajerhisab.*,raj_kajer_hedmistress.id as rid,raj_kajer_hedmistress.hedmistress_name as hedmistress_name, 
  raj_kajer_hedmistress.hedmistress_mobile_num,raj_kajer_hedmistress.hedmistress_profile_pic,raj_kajer_hedmistress.hedmistress_ducument,raj_kajer_hedmistress.address, raj_kajer_hedmistress.marphot_name, 
  raj_kajer_hedmistress.contract, raj_kajer_hedmistress.hedmistress_status,raj_kajer_hedmistress.project_name_id, project_heading.id as headingid, project_heading.heading  FROM 
    raj_kajerhisab INNER JOIN raj_kajer_hedmistress ON raj_kajer_hedmistress.id = raj_kajerhisab.r_hedmistress 
    INNER JOIN project_heading ON project_heading.id = raj_kajerhisab.project_name_id where raj_kajerhisab.project_name_id = '$project_name_id'  ORDER BY r_date DESC";

            //$query_hedmistress1 = "SELECT * FROM raj_kajerhisab  WHERE project_name_id = '$project_name_id' ";
          $resultTotalbil = "SELECT SUM(r_totalbill) AS sum_r_totalbill, SUM(r_credit) AS sum_r_credit, SUM(r_paowna) AS sum_r_paowna  FROM raj_kajerhisab WHERE project_name_id = '$project_name_id' "; 
          $rowSum = $db->select($resultTotalbil); 
          $fetchTotal    = $rowSum->fetch_assoc();
          
          $total_sum     = $fetchTotal['sum_r_totalbill'];
          $total_credit  = $fetchTotal['sum_r_credit'];
          $total_paowna  = $fetchTotal['sum_r_paowna'];


                $sData = $db->select($query_hedmistress1);
                    if ($sData) {
                      $i = 1;
                    while ($rowsnew = $sData->fetch_assoc()) {
                      $newid = $rowsnew['id'];
                      //echo "id====================". $newid;
                    
                ?>
                                           
 
                     <tr id="row_<?php echo $newid; ?>">

                      <td align="center"><?php echo $i++; ?></td>
                      <td align="center"><?php echo $rowsnew['r_date']; ?></td>
                      <!-- <td align="center"><?php //echo $rowsnew['address']; ?></td> -->
                     
                      <!-- <td align="center">
                        <a href="raj_kajer_details_hisab.php" ><?php echo $rowsnew['heading']; ?></a>
                      </td> -->
                       <td align="center"><?php echo $rowsnew['hedmistress_name']; ?></td>
                      <!-- <td align="center"><?php //echo $rowsnew['marphot_name']; ?></td> -->
                    
                     <!--  <td align="center"><?php //echo $rowsnew['contract']; ?></td> -->
                      <td align="center"><?php echo $rowsnew['r_job_cat']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_taka']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_person']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_totalbill']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_credit']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_paowna']; ?></td>
                      <td align="center">
                            <!-- <input type="button" value="view" class="btn btn-primary viewBtn" id="<?php echo $rowsnew['id']?>" data-toggle="modal" data-target="#fullHeightModalRight" > -->
                          <a class="btn btn-primary viewBtn" id="<?php echo $rowsnew['id']; ?>" href="raj_kajer_details_hisab.php" >view</a>
                      </td>
                      <td align="center">
                            <input type="button" value="Delete"  data_row_id="<?php echo $rowsnew['id'] ?>" class="btn btn-danger " onclick="delete_row(this)" id="<?php echo $newid ?>" >
                        </td>
                      <td>
                            <input type="button" value="Edit" class="btn btn-success editBtn" id="<?php echo $rowsnew['id']; ?>">
                      </td>
                     </tr>
                             
                     
                <?php 

                    }
                ?>
                <tr>                                
                    <th class="cenText" colspan="6"></th>
                    <th class="cenText"><?php echo  $total_sum ?></th>
                    <th class="cenText"><?php echo  $total_credit ?></th>
                    <th class="cenText"><?php echo  $total_paowna ?></th>
                    <th class="cenText" colspan="3"></th>                            
                </tr>

                <?php    

                }
                    
        

        }



  if (isset($_POST['mistree_details'])) {

  $hedmistress = "SELECT * from raj_kajer_hedmistress where  project_name_id ='$project_name_id' ";

                $mData = $db->select($hedmistress);
                  if ($mData) {
                      $i = 1;
                    while ($mrows = $mData->fetch_assoc()) {

                      $_SESSION["mistreeName"] = $mrows['hedmistress_name'];
                      $_SESSION["mistree_id"] = $mrows['id'];
                      
                ?>                      
                     <tr id="row_<?php echo $mrows['id']; ?>">

                      <td align="center"><?php echo $i++; ?></td>
                      <td align="center"><?php echo $mrows['hedmistress_name']; ?></td>
                      <td align="center"><?php echo $mrows['hedmistress_mobile_num']; ?></td>
                      <td align="center">
                        <img style="width: 50px; height: 50px;" src="../uploads/profilepic/<?php echo $mrows['hedmistress_profile_pic']; ?>">

                        </td>
                      <td align="center">
                        <a href="../uploads/ducuments/<?php echo $mrows['hedmistress_ducument']; ?>" ><?php echo $mrows['hedmistress_ducument']; ?></a>
                      </td>
                      <td align="center"><?php echo $mrows['address']; ?></td>
                    
                      <td align="center"><?php echo $mrows['marphot_name']; ?></td>
                      <td align="center"><?php echo $mrows['contract']; ?></td>

                      <td align="center">

                        <a class="btn btn-primary mistree_viewBtn" id="<?php echo $mrows['id']; ?>" href="raj_kajer_details_hisab.php?id=<?php echo $mrows['id']; ?>" >view</a>
                        </td>
                      <td align="center">
                            <input type="button" value="Delete"  data_row_id="<?php echo $mrows['id']; ?>" class="btn btn-danger " onclick="delete_row(this)" id="<?php echo $mrows['id']; ?>" >
                        </td>
                      <td style="">
                            <input type="button" value="Edit" class="btn btn-success mistree_editBtn" id="<?php echo $mrows['id']; ?>">
                        </td>
                     </tr>
                             
                     
                <?php 

                    }
                

                }
                    
        

        }      

if (isset($_POST['checkAlldata'])) {

  $query_1 = "SELECT raj_kajerhisab.*,raj_kajer_hedmistress.id as rajid,raj_kajer_hedmistress.hedmistress_name as hedmistress_name, raj_kajer_hedmistress.hedmistress_mobile_num,raj_kajer_hedmistress.hedmistress_profile_pic,raj_kajer_hedmistress.hedmistress_ducument,raj_kajer_hedmistress.address, raj_kajer_hedmistress.marphot_name, raj_kajer_hedmistress.contract, raj_kajer_hedmistress.hedmistress_status,raj_kajer_hedmistress.project_name_id  FROM 
    raj_kajerhisab INNER JOIN raj_kajer_hedmistress ON raj_kajer_hedmistress.id = raj_kajerhisab.r_hedmistress  WHERE raj_kajerhisab.project_name_id='$project_name_id'  ORDER BY r_date DESC";

          $resultTotalbil = "SELECT SUM(r_totalbill) AS sum_r_totalbill, SUM(r_credit) AS sum_r_credit, SUM(r_paowna) AS sum_r_paowna  FROM raj_kajerhisab  WHERE project_name_id = '$project_name_id' ";
         // $resultTotalbil = "SELECT SUM(r_totalbill) AS sum_r_totalbill, SUM(r_credit) AS sum_r_credit, SUM(r_paowna) AS sum_r_paowna  FROM raj_kajerhisab WHERE project_name_id= '$project_name_id' "; 
          $rowSum = $db->select($resultTotalbil); 
          $fetchTotal    = $rowSum->fetch_assoc();
          
          $total_sum     = $fetchTotal['sum_r_totalbill'];
          $total_credit  = $fetchTotal['sum_r_credit'];
          $total_paowna  = $fetchTotal['sum_r_paowna'];


                $sData = $db->select($query_1);
                    if ($sData) {
                      $i = 1;
                    while ($rowsnew = $sData->fetch_assoc()) {
                      $newid = $rowsnew['id'];
                     // echo "id====================". $newid;
                    
                ?>
                                           
 
                     <tr id="row_<?php echo $newid; ?>">

                      <td align="center"><?php echo $i++; ?></td>
                      <td align="center"><?php echo $rowsnew['r_date']; ?></td>
                      <td align="center"><?php echo $rowsnew['address']; ?></td>
                      
                      <!-- <td align="center">
                        <a href="raj_kajer_details_hisab.php" ><?php echo $rowsnew['heading']; ?></a>
                      </td> -->
                      <td align="center"><?php echo $rowsnew['hedmistress_name']; ?></td>
                      <td align="center"><?php echo $rowsnew['marphot_name']; ?></td>
                    
                      <td align="center"><?php echo $rowsnew['contract']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_job_cat']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_taka']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_person']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_totalbill']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_credit']; ?></td>
                      <td align="center"><?php echo $rowsnew['r_paowna']; ?></td>                      
                     </tr>
                             
                     
                <?php 

                    }
                ?>
                <tr>
                                
      
                    <th class="cenText" colspan="9"></th>
                    <th class="cenText"><?php echo  $total_sum ?></th>
                    <th class="cenText"><?php echo  $total_credit ?></th>
                    <th class="cenText"><?php echo  $total_paowna ?></th>
                </tr>

                <?php    

                }

        }



if($_POST["action"] == "fetch_single")
    {
        //$query = "SELECT * FROM raj_kajerhisab WHERE id = '".$_POST["id"]."'";
    $query = "SELECT raj_kajerhisab.*,raj_kajer_hedmistress.id as r_id,raj_kajer_hedmistress.hedmistress_name  FROM raj_kajerhisab LEFT JOIN raj_kajer_hedmistress ON raj_kajerhisab.r_hedmistress = raj_kajer_hedmistress.id WHERE raj_kajerhisab.id ='".$_POST["id"]."' ";


        $statement = $db->select($query);
        //$result = $statement->fetch_assoc();
        while($row = $statement->fetch_assoc())
         {
          $data['id']               = $row['id'];
          $data['r_date']           = $row['r_date'];
          $data['r_hedmistress']    = $row['r_hedmistress'];
          $data['hedmistress_name'] = $row['hedmistress_name'];
          $data['r_job_cat']        = $row['r_job_cat'];
          $data['r_taka']           = $row['r_taka'];
          $data['r_person']         = $row['r_person'];
          $data['r_totalbill']      = $row['r_totalbill'];
          $data['r_credit']         = $row['r_credit'];
          $data['r_paowna']         = $row['r_paowna'];

         }
        echo json_encode( $data );  
    }

   // Mistree edit data
   
if($_POST["action"] == "edit_mistree_single")
    {
        //$query = "SELECT * FROM raj_kajerhisab WHERE id = '".$_POST["id"]."'";
    $query1 = "SELECT * FROM raj_kajer_hedmistress WHERE id ='".$_POST["id"]."' ";


        $statement1 = $db->select($query1);
        //$result = $statement->fetch_assoc();
        while($row = $statement1->fetch_assoc())
         {
          $data['id']                         = $row['id'];
          $data['hedmistress_name']           = $row['hedmistress_name'];
          $data['hedmistress_mobile_num']     = $row['hedmistress_mobile_num'];
          $data['hedmistress_profile_pic']    = $row['hedmistress_profile_pic'];
          $data['hedmistress_ducument']       = $row['hedmistress_ducument'];
          $data['address']                    = $row['address'];
          $data['marphot_name']               = $row['marphot_name'];
          $data['contract']                   = $row['contract'];


         }
        echo json_encode( $data );  
    }
     // Mistree update data

  if($_POST["action"] == "mistree_update"){

       $id                        = $_POST['id'];
       $hedmistress_name          = trim($_POST['hedmistress_name']) ;
       $hedmistress_mobile_num    = trim($_POST['hedmistress_mobile_num']) ;
      // $hedmistress_profile_pic   = $_FILES['hedmistress_profile_pic']['name'];
       //$hedmistress_ducument      = $_FILES['hedmistress_ducument']['name'];
       $hedmistress_old_pic       = $_POST['hedmistress_old_pic'];
       $hedmistress_old_ducument  = $_POST['hedmistress_old_ducument'];
       $address                   = trim($_POST['address']);
       $marphot_name              = trim($_POST['marphot_name']);
       $contract                  = floatval($_POST['contract']);

       
    $mesg="";   

            $filePath = "../uploads/profilepic/".$hedmistress_old_pic;
            $filePath2 = "../uploads/ducuments/".$hedmistress_old_pic;
            $hedmistress_profile_pic = [];
          if ($_FILES["hedmistress_profile_pic"]['size'] > 1) {
                   /* Location */
                   if (file_exists($filePath)) 
                     {
                       unlink($filePath);
                     
                    }

                    $time = date("d-m-Y")."-".time() ;
                    $ext = pathinfo($_FILES['hedmistress_profile_pic']['name'], PATHINFO_EXTENSION);
                    $targetDir = "../uploads/profilepic/";
                    $hedmistress_profile_pic = $time.".".$ext;
                    $targetFilePath = $targetDir . $hedmistress_profile_pic;
                     move_uploaded_file($_FILES["hedmistress_profile_pic"]["tmp_name"], $targetFilePath);
              }else{

                $hedmistress_profile_pic = $hedmistress_old_pic;
              }
              $hedmistress_ducument =[];

          if ($_FILES["hedmistress_ducument"]['size'] > 1) {
                   /* Location */
                   if (file_exists($filePath2)) 
                     {
                       unlink($filePath2);
                       // echo "Document Successfully Delete."; 
                    }
                    $time2 = date("d-m-Y")."-".time() ;
                    $ext2 = pathinfo($_FILES['hedmistress_ducument']['name'], PATHINFO_EXTENSION);
                    $targetDir2 = "../uploads/ducuments/";
                    $hedmistress_ducument = $time2.".".$ext2;
                    $targetFilePath2 = $targetDir2 . $hedmistress_ducument;
                     move_uploaded_file($_FILES["hedmistress_ducument"]["tmp_name"], $targetFilePath2);

              }else{
                $hedmistress_ducument = $hedmistress_old_ducument;

              }
            $sql="UPDATE raj_kajer_hedmistress SET  hedmistress_name = '$hedmistress_name', hedmistress_mobile_num = '$hedmistress_mobile_num', hedmistress_profile_pic = '$hedmistress_profile_pic',hedmistress_ducument = '$hedmistress_ducument',address = '$address',marphot_name = '$marphot_name',contract = '$contract' WHERE id = '$id' ";

          $update_result = $db->update($sql);
          if ($update_result) {
                  echo "Data update successfully";
                 // echo json_encode( $update_result ); 
            } else {
                    echo "Data update Error";
          }

}  


    if($_POST["action"] == "delete_single")
    {
        $id = $_POST['id'];

      $sql = "DELETE FROM raj_kajerhisab WHERE id = '$id'";
      $result = $db->delete($sql);
      if ($result) {
          $sucMsg = "Delete successfully !";
          echo json_encode($sucMsg );  
      } else {
          echo "Error: " . $sql . "<br>" .$db->error;
      }
       // echo json_encode( $data );  
    }

if(isset($_POST['data_delete_id'])){
      $id = $_POST['data_delete_id'];

      $sql = "DELETE FROM raj_kajer_hedmistress WHERE id = '$id'";
      $result = $db->delete($sql);
      if ($result) {
          $sucMsg = "Data delete successfully !";
      } else {
          echo "Error: " . $sql . "<br>" .$db->error;
      }
  }

  // ========== হেড মিস্ত্রী নাম=============

     if (isset($_POST['checkheadmistress'])) {
           $query_hedmistress1 = "SELECT * FROM raj_kajer_hedmistress WHERE hedmistress_status = '1' AND project_name_id = '$project_name_id' ";
                $shData = $db->select($query_hedmistress1);
                    if ($shData) {?>

             <select name="hedmistress_name" id="hedmistress_name" class="checkmistree" >

           <!--   <option value="">হেড মিস্ত্রী নাম</option> -->


                <?php 
                    while ($ro = $shData->fetch_assoc()) {
                ?>
                                           
                     <option value="<?php echo $ro['id']; ?>"> <?php echo $ro['hedmistress_name']; ?> </option>
                             
                      
                <?php 
                    }?>

              </select>         

               <?php 
           }
                    
        

        }  
      if (isset($_POST['checkdate'])) {
           $query_checkdate = "SELECT * FROM raj_kajerhisab WHERE project_name_id = '$project_name_id' ";
                $shDate = $db->select($query_checkdate);
                    if ($shDate) {?>

             <select name="dates_list" id="dates_list" class="checkDate" >

             <option value="">All Dates 10 Datas ...</option>


                <?php 
                    while ($rowDate = $shDate->fetch_assoc()) {
                ?>
                                           
                     <option value="<?php echo $rowDate['id']; ?>"> <?php echo $rowDate['r_date']; ?> </option>
                             
                      
                <?php }?>
                    

              </select>         

               <?php 
           }
                    
        

        }  


?>