<?php
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();


    $project_name_id = $_POST['project_name_id'];
    $usernamePost = $_POST['user_name'];
    
    if($project_name_id == 'none'){
        echo "project_name_id = ".$project_name_id." Not work...";
    }
    else{    	
    	$sql = "UPDATE login SET project_name_id = '$project_name_id' WHERE username = '$usernamePost'";
    	$result = $db->update($sql);
    	if($result){
            echo "Updated Successully.";
    	} else{
            echo "Updated Failed.";
        }
    }


 
?>