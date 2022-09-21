<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	$project_name_id = $_SESSION['project_name_id'];
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	$sucMsg 	='';

	$details_id = $_POST['details_id'];
	$gbvalue	= $_POST['gbvalue'];
	$balance	= -1 * $gbvalue;
	
	$sql="UPDATE details SET debit = '$gbvalue', balance = '$balance' WHERE id = '$details_id' AND project_name_id = '$project_name_id'";

	if ($db->update($sql) === TRUE) {
		$sucMsg = "Gb Updated Successfully";

		$sql="SELECT debit FROM details WHERE id = '$details_id' AND project_name_id = '$project_name_id'";		
		$gb_read = $db->select($sql);
		if($gb_read){
			$row= $gb_read->fetch_assoc();
		}
		echo $row['debit'];
	} else {
	  echo "Error: " . $sql . "<br>" . $db->error;
	}


