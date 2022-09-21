<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $_SESSION['pageName'] = 'raj_kajer_all_hisab';
    
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];
    $sucMsg = "";

     
       

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


            $sql="UPDATE raj_kajerhisab set  r_date = '$r_date', r_hedmistress = '$r_hedmistress', r_job_cat = '$r_job_cat',r_taka = '$r_taka',r_person = '$r_person',r_totalbill = '$r_totalbill',r_credit = '$r_credit',r_paowna = '$r_paowna' WHERE id = '$id' ";

             $update_result = $db->update($sql);
         
               
          if ($update_result) {
                  echo json_encode(array("statusCode"=>200));
                } 
                else {
                   echo json_encode(array("statusCode"=>201));
                }



}



	// if(ISSET($_POST['id'])){
	// 	$id = $_POST['id'];
	// 	$firstname = $_POST['firstname'];
	// 	$lastname = $_POST['lastname'];
	// 	$address = $_POST['address'];
 
	// 	$conn->query("UPDATE `member` set `firstname` = '$firstname', `lastname` = '$lastname', `address` = '$address' WHERE `mem_id` = '$id'");
	// }

                      
        

?>