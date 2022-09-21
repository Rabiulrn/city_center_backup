<?php 
	session_start();
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$project_name_id        = $_SESSION['project_name_id'];
	$delete_data_permission = $_SESSION['delete_data'];
	$user_name				= $_SESSION['username'];
	$user_type 				= $_SESSION['usertype'];
	$is_super_admin			= $_SESSION['is_super_admin']; //true or false

	$password 				= md5($_POST['pass']);
	// echo $_POST['pass'];
	// echo $password;

	// $sql = "SELECT password FROM login WHERE password = '$password' AND username = '$user_name' AND usertype = '$user_type' AND delete_data = '$delete_data_permission' AND project_name_id LIKE '%$project_name_id%'";

	if($is_super_admin) {
		//super admin login
		//when super admin loged in usertype admin too
		$sql = "SELECT password FROM login WHERE password = '$password' AND username = '$user_name' AND usertype = 'admin'";
	} else {
		//if not super admin
		if($_POST['pass'] == "") {
			echo "Password can not be empty!";
		} else {
			$get_super_admin_user_name_sql = "SELECT username FROM login WHERE usertype = 'superAdmin'";
			$super_admin_result = $db->select($get_super_admin_user_name_sql);

			if(mysqli_num_rows($super_admin_result) > 0){
				$row = $super_admin_result->fetch_assoc();
				$superAdminUserName = $row['username'];

				$sql = "SELECT password FROM login WHERE password = '$password' AND username = '$superAdminUserName' AND usertype = 'superAdmin'";
				$match_pass_result = $db->select($sql);
				if(mysqli_num_rows($match_pass_result) > 0){
					echo "password_matched";
				} else {
					echo "সুপার অ্যাডমিন পাসওয়ার্ড ব্যাতীত তথ্যটি ডিলিট করা যাবে না ! অথবা পাসওয়ার্ড মিলছে না ।";
				}
			} else {
				echo "Unable to Delete.";
			}
			
		}
	}
	


//user and admin delete can delete data but need admin password 