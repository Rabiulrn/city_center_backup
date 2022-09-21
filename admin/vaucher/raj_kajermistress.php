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
//if (isset($_POST['submit_hedmistress'])) {

       $hedmistress_name          = trim($_POST['hedmistress_name']) ;
       $hedmistress_mobile_num    = trim($_POST['hedmistress_mobile_num']) ;
       //$hedmistress_profile_pic   = $_FILES['hedmistress_profile_pic']['name'];
       //$hedmistress_ducument      = $_FILES['hedmistress_ducument']['name'];
       $address                   = trim($_POST['address']);
       $marphot_name              = trim($_POST['marphot_name']);
       $contract                  = floatval($_POST['contract']);
       $hedmistress_status        = '1' ;
       
    $mesg="";   



                    $time = date("d-m-Y")."-".time() ;
                    $ext = pathinfo($_FILES['hedmistress_profile_pic']['name'], PATHINFO_EXTENSION);
                    $targetDir = "../uploads/profilepic/";
                    $hedmistress_profile_pic = $time.".".$ext;
                    $targetFilePath = $targetDir . $hedmistress_profile_pic;
                     move_uploaded_file($_FILES["hedmistress_profile_pic"]["tmp_name"], $targetFilePath);

                   
                  

                    $time2 = date("d-m-Y")."-".time() ;
                    $ext2 = pathinfo($_FILES['hedmistress_ducument']['name'], PATHINFO_EXTENSION);
                    $targetDir2 = "../uploads/ducuments/";
                    $hedmistress_ducument = $time2.".".$ext2;
                    $targetFilePath2 = $targetDir2 . $hedmistress_ducument;
                     move_uploaded_file($_FILES["hedmistress_ducument"]["tmp_name"], $targetFilePath2);


            $query1 = "INSERT INTO raj_kajer_hedmistress (hedmistress_name,hedmistress_mobile_num,hedmistress_profile_pic,hedmistress_ducument,address,marphot_name,contract,hedmistress_status, project_name_id) VALUES ('$hedmistress_name','$hedmistress_mobile_num','$hedmistress_profile_pic','$hedmistress_ducument','$address','$marphot_name','$contract','$hedmistress_status','$project_name_id')";
                $result1 = $db->insert($query1);
                if ($result1) {
                  echo "success";
                } else {
                    echo "error";
                }

                  

//}


 

   
    
       

?>