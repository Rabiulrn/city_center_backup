<?php 
	session_start();  
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	$username = $_POST['username'];

	
	
	$sql 	= "SELECT id, heading FROM project_heading";
	$rslt 	= $db->select($sql);
	$row_no = mysqli_num_rows($rslt);
	if($rslt && $row_no == 0){
		echo '<option value="0">SELECT A PROJECT NAME</option>';
	} else {
		echo '<option value="0">SELECT A PROJECT NAME</option>';
		while($row = $rslt->fetch_array()){
			$sqlproject 	= "SELECT project_name_id FROM login WHERE username = '$username'";
			$rsltproject 	= $db->select($sqlproject);
			$row2 			= $rsltproject->fetch_array();
			$projectIdFromDb= $row2['project_name_id'];
			$pid_explode 	= explode(",", $projectIdFromDb);

			for($i=0; $i < count($pid_explode); $i++){
				// echo $pid_explode[$i];
				if($row['id'] == $pid_explode[$i]){
					echo "<option value='".$row['id']."'>".$row['heading']."</option>";
				}
			}
		}
	}
?>