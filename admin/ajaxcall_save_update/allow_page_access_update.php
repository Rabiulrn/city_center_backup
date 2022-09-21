<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$fromSessionUserName = $_SESSION['username'];
	$fromSessionUserType = $_SESSION['usertype'];

//========raj_kajerhisab added by me

	$sucMsg 	='';
	$username 			= $_POST['username'];
	$project_name_id 	= $_POST['project_name_id'];
	// $doinik_hisab 		= $_POST['doinik_hisab'];
	$protidiner_hisab 	= $_POST['protidiner_hisab'];
	$modify_data 		= $_POST['modify_data'];
	$joma_khat 			= $_POST['joma_khat'];
	$khoros_khat 		= $_POST['khoros_khat'];
	$khoros_khat_entry 	= $_POST['khoros_khat_entry'];
	$nije_pabo 			= $_POST['nije_pabo'];
	$paonader 			= $_POST['paonader'];
	$report 			= $_POST['report'];
	$agrim_hisab 		= $_POST['agrim_hisab'];
	$cash_calculator 	= $_POST['cash_calculator'];
	$raj_kajer_all_hisab= $_POST['raj_kajer_all_hisab'];
	$electric_kroy_bikroy= $_POST['electric_kroy_bikroy'];
	// $rod_hisab 			= $_POST['rod_hisab'];
	$rod_kroy_hisab 	= $_POST['rod_kroy_hisab'];
	$rod_bikroy_hisab 	= $_POST['rod_bikroy_hisab'];
	$rod_category 		= $_POST['rod_category'];
	$rod_dealer 		= $_POST['rod_dealer'];
	$rod_customer 		= $_POST['rod_customer'];
	$rod_buyer 			= $_POST['rod_buyer'];
	$rod_report 		= $_POST['rod_report'];

	$balu_kroy_hisab 	= $_POST['balu_kroy_hisab'];
	$balu_bikroy_hisab 	= $_POST['balu_bikroy_hisab'];
	$balu_category 		= $_POST['balu_category'];
	$balu_dealer 		= $_POST['balu_dealer'];
	$balu_customer 		= $_POST['balu_customer'];
	$balu_buyer 			= $_POST['balu_buyer'];
	$balu_report 		= $_POST['balu_report'];
	$balu_stocks  		= $_POST['balu_stocks'];

	$pathor_kroy_hisab 	= $_POST['pathor_kroy_hisab'];
	$pathor_bikroy_hisab 	= $_POST['pathor_bikroy_hisab'];
	$pathor_category 		= $_POST['pathor_category'];
	$pathor_dealer 		= $_POST['pathor_dealer'];
	$pathor_customer 		= $_POST['pathor_customer'];
	$pathor_buyer 			= $_POST['pathor_buyer'];
	$pathor_stocks 			= $_POST['pathor_stocks'];
	// $pathor_report 		= $_POST['pathor_report'];

	$cement_kroy_hisab 	= $_POST['cement_kroy_hisab'];
	$cement_bikroy_hisab 	= $_POST['cement_bikroy_hisab'];
	$cement_category 		= $_POST['cement_category'];
	$cement_dealer 		= $_POST['cement_dealer'];
	$cement_customer 		= $_POST['cement_customer'];
	$cement_buyer 			= $_POST['cement_buyer'];
	$cement_stocks 			= $_POST['cement_stocks'];
	$cement_report 			= $_POST['cement_report'];
	// $pathor_report 		= $_POST['pathor_report'];

	$create_user 		= $_POST['create_user'];
	$edit_data 			= $_POST['edit_data'];
	$delete_data 		= $_POST['delete_data'];

	// echo $username ." " . $project_name_id . " " . $home . " " . $protidiner_hisab . " " . $joma_khat . " " . $khoros_khat . " " . $nije_pabo . " " . $paonader . " " . $modify_data . " " . $rod_hisab . " " . $create_user;

	$sql="UPDATE login SET protidiner_hisab = '$protidiner_hisab', modify_data = '$modify_data', joma_khat = '$joma_khat', khoros_khat = '$khoros_khat', khoros_khat_entry = '$khoros_khat_entry', nije_pabo = '$nije_pabo', paonader = '$paonader', report = '$report', agrim_hisab = '$agrim_hisab', cash_calculator = '$cash_calculator',raj_kajer_all_hisab ='$raj_kajer_all_hisab',electric_kroy_bikroy='$electric_kroy_bikroy', rod_kroy_hisab = '$rod_kroy_hisab', rod_bikroy_hisab = '$rod_bikroy_hisab', rod_category = '$rod_category',rod_dealer = '$rod_dealer', rod_customer = '$rod_customer',rod_buyer = '$rod_buyer', rod_report = '$rod_report',
	balu_kroy_hisab = '$balu_kroy_hisab',balu_bikroy_hisab = '$balu_bikroy_hisab',
	balu_category = '$balu_category', balu_dealer = '$balu_dealer', balu_customer = '$balu_customer',
	balu_buyer = '$balu_buyer', balu_report = '$balu_report',balu_stocks = '$balu_stocks',
	pathor_kroy_hisab = '$pathor_kroy_hisab',pathor_bikroy_hisab = '$pathor_bikroy_hisab',
	pathor_category = '$pathor_category', pathor_dealer = '$pathor_dealer', pathor_customer = '$pathor_customer',
	pathor_buyer = '$pathor_buyer',pathor_stocks = '$pathor_stocks',
	cement_kroy_hisab = '$cement_kroy_hisab',cement_bikroy_hisab = '$cement_bikroy_hisab',
	cement_category = '$cement_category', cement_dealer = '$cement_dealer', cement_customer = '$cement_customer',
	cement_buyer = '$cement_buyer',cement_stocks = '$cement_stocks',cement_report = '$cement_report',
	  create_user = '$create_user', edit_data = '$edit_data', delete_data = '$delete_data', project_name_id = '$project_name_id' WHERE username = '$username'";

	if ($db->update($sql) === TRUE) {
		$sucMsg = "User Access Updated Successfully";
		echo $sucMsg;
		$page_permission_sql = "SELECT * FROM login WHERE username = '$username'";
		$permission_result = $db->select($page_permission_sql);
		if($permission_result && mysqli_num_rows($permission_result) == '1'){
        	$row = $permission_result->fetch_assoc();

        	$protidiner_hisab 	= $row['protidiner_hisab'];
        	$modify_data 		= $row['modify_data'];
        	$joma_khat 			= $row['joma_khat'];
        	$khoros_khat 		= $row['khoros_khat'];
        	$khoros_khat_entry 	= $row['khoros_khat_entry'];
        	$nije_pabo 			= $row['nije_pabo'];
        	$paonader 			= $row['paonader'];
        	$report 			= $row['report'];
        	$agrim_hisab 		= $row['agrim_hisab'];
        	$cash_calculator 	= $row['cash_calculator'];
			$raj_kajer_all_hisab 	= $row['raj_kajer_all_hisab'];
			$electric_kroy_bikroy =$row['electric_kroy_bikroy'];
        	$rod_kroy_hisab 	= $row['rod_kroy_hisab'];
        	$rod_bikroy_hisab 	= $row['rod_bikroy_hisab'];
        	$rod_category 		= $row['rod_category'];
        	$rod_dealer 		= $row['rod_dealer'];
        	$rod_customer 		= $row['rod_customer'];
        	$rod_buyer	 		= $row['rod_buyer'];
        	$rod_report			= $row['rod_report'];

			$balu_kroy_hisab 	= $row['balu_kroy_hisab'];
        	$balu_bikroy_hisab 	= $row['balu_bikroy_hisab'];
			$balu_category 		= $row['balu_category'];
        	$balu_dealer 		= $row['balu_dealer'];
        	$balu_customer 		= $row['balu_customer'];
        	$balu_buyer	 		= $row['balu_buyer'];
        	$balu_report			= $row['balu_report'];
			$balu_stocks			= $row['balu_stocks'];

			$pathor_kroy_hisab 	= $row['pathor_kroy_hisab'];
        	$pathor_bikroy_hisab 	= $row['pathor_bikroy_hisab'];
			$pathor_category 		= $row['pathor_category'];
        	$pathor_dealer 		= $row['pathor_dealer'];
        	$pathor_customer 		= $row['pathor_customer'];
        	$pathor_buyer	 		= $row['pathor_buyer'];
			$pathor_stocks			= $row['pathor_stocks'];

			$cement_kroy_hisab 	= $row['cement_kroy_hisab'];
        	$cement_bikroy_hisab 	= $row['cement_bikroy_hisab'];
			$cement_category 		= $row['cement_category'];
        	$cement_dealer 		= $row['cement_dealer'];
        	$cement_customer 		= $row['cement_customer'];
        	$cement_buyer	 		= $row['cement_buyer'];
			$cement_stocks			= $row['cement_stocks'];
			$cement_report			= $row['cement_report'];
        	// $pathor_report			= $row['pathor_report'];


        	if($protidiner_hisab == 'yes' || $modify_data == 'yes' || $joma_khat == 'yes' || $khoros_khat == 'yes' || $khoros_khat_entry == 'yes' || $nije_pabo == 'yes' || $paonader == 'yes' || $report == 'yes' || $agrim_hisab == 'yes' || $cash_calculator == 'yes' || $raj_kajer_all_hisab == 'yes'|| $electric_kroy_bikroy == 'yes' || $rod_kroy_hisab == 'yes' || $rod_bikroy_hisab == 'yes' || $rod_category == 'yes' || $rod_dealer == 'yes' || $rod_customer == 'yes' || $rod_buyer == 'yes' || $rod_report == 'yes' ||
			 $balu_kroy_hisab == 'yes' || $balu_bikroy_hisab == 'yes' || $balu_category == 'yes' || $balu_dealer == 'yes' || $balu_customer == 'yes' || $balu_buyer == 'yes' || $balu_report == 'yes' || $balu_stocks == 'yes' ||
			 $pathor_kroy_hisab == 'yes' || $pathor_bikroy_hisab == 'yes' || $pathor_category == 'yes' || $pathor_dealer == 'yes' || $pathor_customer == 'yes' || $pathor_buyer == 'yes' || $pathor_stocks == 'yes' ||
			 $cement_kroy_hisab == 'yes' || $cement_bikroy_hisab == 'yes' || $cement_category == 'yes' || $cement_dealer == 'yes' || $cement_customer == 'yes' || $cement_buyer == 'yes' || $cement_stocks == 'yes' || $cement_report == 'yes' 
			){
        		$sql_doinik_hisab_permission = "UPDATE login SET page_permission = 'yes' WHERE username = '$username'";
        		$update_result = $db->update($sql_doinik_hisab_permission);
        	} else {
        		$sql_doinik_hisab_permission = "UPDATE login SET page_permission = 'no' WHERE username = '$username'";
        		$update_result = $db->update($sql_doinik_hisab_permission);
        	}
          
        }
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}



	$session_update_sql = "SELECT * FROM login WHERE username='$fromSessionUserName' AND  usertype='$fromSessionUserType'";
	$session_update = $db->login($session_update_sql);
	$num_row = mysqli_num_rows($session_update);
	$row = mysqli_fetch_array($session_update);
	if($session_update && $num_row ==1 ) {
		// $_SESSION['project_name_id']  = $project_name;

		// $_SESSION['first_name']   = $row['first_name'];
		// $_SESSION['last_name']    = $row['last_name'];
		// $_SESSION['username']     = $row['username'];
		// $_SESSION['usertype']     = $row['usertype'];

		$_SESSION['doinik_hisab']     = $row['doinik_hisab'];
		$_SESSION['protidiner_hisab'] = $row['protidiner_hisab'];
		$_SESSION['modify_data']      = $row['modify_data'];    
		$_SESSION['joma_khat']        = $row['joma_khat'];
		$_SESSION['khoros_khat']      = $row['khoros_khat'];
		$_SESSION['khoros_khat_entry']= $row['khoros_khat_entry'];
		$_SESSION['nije_pabo']        = $row['nije_pabo'];
		$_SESSION['paonader']         = $row['paonader'];
		$_SESSION['report']           = $row['report'];
		$_SESSION['agrim_hisab']      = $row['agrim_hisab'];
		$_SESSION['cash_calculator']  = $row['cash_calculator'];
		$_SESSION['raj_kajer_all_hisab']   = $row['raj_kajer_all_hisab'];
		$_SESSION['electric_kroy_bikroy']   = $row['electric_kroy_bikroy'];
		
		$_SESSION['rod_hisab']        = $row['rod_hisab'];
		$_SESSION['rod_kroy_hisab']   = $row['rod_kroy_hisab'];
		$_SESSION['rod_bikroy_hisab'] = $row['rod_bikroy_hisab'];
		$_SESSION['rod_category']     = $row['rod_category'];
		$_SESSION['rod_dealer']       = $row['rod_dealer'];
		$_SESSION['rod_customer']     = $row['rod_customer'];
		$_SESSION['rod_buyer']        = $row['rod_buyer'];
		$_SESSION['rod_report']       = $row['rod_report'];

		$_SESSION['balu_kroy_hisab']   = $row['balu_kroy_hisab'];
		$_SESSION['balu_bikroy_hisab'] = $row['balu_bikroy_hisab'];
		$_SESSION['balu_category']     = $row['balu_category'];
		$_SESSION['balu_dealer']       = $row['balu_dealer'];
		$_SESSION['balu_customer']     = $row['balu_customer'];
		$_SESSION['balu_buyer']        = $row['balu_buyer'];
		$_SESSION['balu_report']       = $row['balu_report'];
		$_SESSION['balu_stocks']       = $row['balu_stocks'];


		$_SESSION['pathor_kroy_hisab']   = $row['pathor_kroy_hisab'];
		$_SESSION['pathor_bikroy_hisab'] = $row['pathor_bikroy_hisab'];
		$_SESSION['pathor_category']     = $row['pathor_category'];
		$_SESSION['pathor_dealer']       = $row['pathor_dealer'];
		$_SESSION['pathor_customer']     = $row['pathor_customer'];
		$_SESSION['pathor_buyer']        = $row['pathor_buyer'];
		$_SESSION['pathor_stocks']        = $row['pathor_stocks'];
		// $_SESSION['pathor_report']       = $row['pathor_report'];


		$_SESSION['cement_kroy_hisab']   = $row['cement_kroy_hisab'];
		$_SESSION['cement_bikroy_hisab'] = $row['cement_bikroy_hisab'];
		$_SESSION['cement_category']     = $row['cement_category'];
		$_SESSION['cement_dealer']       = $row['cement_dealer'];
		$_SESSION['cement_customer']     = $row['cement_customer'];
		$_SESSION['cement_buyer']        = $row['cement_buyer'];
		$_SESSION['cement_stocks']        = $row['cement_stocks'];
		$_SESSION['cement_report']        = $row['cement_report'];
		// $_SESSION['pathor_report']       = $row['pathor_report'];


		$_SESSION['create_user']      = $row['create_user'];
		$_SESSION['edit_data']        = $row['edit_data'];
		$_SESSION['delete_data']      = $row['delete_data'];

		$_SESSION['verification']     = $row['verification'];
		$_SESSION['page_permission']  = $row['page_permission'];
	}
