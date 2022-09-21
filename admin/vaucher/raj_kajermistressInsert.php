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

     
       $r_date              = $_POST['r_date'];
       $r_hedmistress       = $_POST['r_hedmistress'];
       $r_job_cat           = $_POST["r_job_cat"];
       $r_taka              = $_POST["r_taka"];
       $r_person            = $_POST["r_person"];
       $r_totalbill         = $_POST["r_totalbill"];
       $r_credit            = $_POST["r_credit"];
       $r_paowna            = $_POST["r_paowna"];

      $number = count($r_job_cat);
      if($number > 0){
        for($i = 0; $i < $number; $i++){
     

        $query = "INSERT INTO raj_kajerhisab(r_date, r_hedmistress,r_job_cat,r_taka,r_person,r_totalbill,r_credit,r_paowna, project_name_id) VALUES ('$r_date[$i]', '$r_hedmistress','$r_job_cat[$i]','$r_taka[$i]','$r_person[$i]','$r_totalbill[$i]','$r_credit[$i]','$r_paowna[$i]','$project_name_id')";

             $result = $db->insert($query);
         }
               
          if ($result) {
                  echo json_encode(array("statusCode"=>200));
                } else {
                   echo json_encode(array("statusCode"=>201));
                }
}


 if($_POST["updateData"] == "updateData"){

	   $id              	= $_POST['id'];
       $r_date              = $_POST['r_date'];
       $r_hedmistress       = $_POST['r_hedmistress'];
       $r_job_cat           = $_POST["r_job_cat"];
       $r_taka              = $_POST["r_taka"];
       $r_person            = $_POST["r_person"];
       $r_totalbill         = $_POST["r_totalbill"];
       $r_credit            = $_POST["r_credit"];
       $r_paowna            = $_POST["r_paowna"];


            $sql="UPDATE raj_kajerhisab SET id= '$id', r_date = '$r_date', r_hedmistress = '$r_hedmistress', r_job_cat = '$r_job_cat',r_taka = '$r_taka',r_person = '$r_person',r_totalbill = '$r_totalbill',r_credit = '$r_credit',r_paowna = '$r_paowna' WHERE id = '$id' ";

             $update_result = $db->update($sql);
         
               
          if ($update_result) {
                  echo json_encode(array("statusCode"=>200));
                } 
                else {
                   echo json_encode(array("statusCode"=>201));
                }



}




    if (isset($_POST['checkhedmistre'])) {
           $query_hedmistressdetail = "SELECT * FROM raj_kajerhisab WHERE hedmistress_status = '1' AND project_name_id = '$project_name_id' ";
                $data = $db->select($query_hedmistress);
                    if ($data) {?>

                 <select class="form-control location_name" name="r_location_name" id="r_location_name" required >
                        <option value="">কাজের স্থান নির্ধারন করুন</option>                     

                 <?php     
                    while ($rows = $data->fetch_assoc()) {
                ?>
                                           
                     <option value="<?php echo $rows['id']; ?>"> <?php echo $rows['hedmistress_name']; ?> </option>
                             
                      
                <?php } ?> 
                  
                 </select>

            <?php    
                }
                    
        

        }    



                      
        

?>