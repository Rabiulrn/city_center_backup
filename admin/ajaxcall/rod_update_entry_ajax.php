<?php 
	session_start();
	$rod_details_id = $_POST['rod_details_id'];

	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$sucMsg ="";


if(isset($rod_details_id)){
	$motor_cash       = trim($_POST['motor_cash']);
	$unload           = trim($_POST['unload']);
	$car_rent_redeem  = trim($_POST['car_rent_redeem']);
	$Information      = trim($_POST['information']);
	$buyer_id    = trim($_POST['buyer_id']);
	// $delear_id      = trim($_POST['delear_id']);          
	$address        = trim($_POST['address']);
	$sl_no          = trim($_POST['sl_no']);
	$delivery_no    = trim($_POST['delivery_no']);
	$motor          = trim($_POST['motor']);
	$motor_no       = trim($_POST['motor_no']);

	// $delivery_date  = trim($_POST['delivery_date']);
	if($_POST['delivery_date'] == ''){
		$delivery_date = $_POST['delivery_date'];
	} else {
		$postDateArr    = explode('-', $_POST['delivery_date']);
		$delivery_date  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
	}
	// $dates          = trim($_POST['dates']);
	if($_POST['dates'] == ''){
		$dates = $_POST['dates'];
	} else {
		$postDateArr2   = explode('-', $_POST['dates']);
		$dates          = $postDateArr2['2'].'-'.$postDateArr2['1'].'-'.$postDateArr2['0'];
	}
	$partculars   = trim($_POST['partculars']);
	$particulars  = trim($_POST['particulars']);
	// echo $paritculars;
	$debit        = trim($_POST['debit']);
	$mm           = trim($_POST['mm']);
	$kg           = trim($_POST['kg']);
	$paras        = trim($_POST['paras']);
	$credit       = trim($_POST['credit']);
	$discount     = trim($_POST['discount']);
	$balance      = trim($_POST['balance']);
	$bundil       = trim($_POST['bundil']);
	$total_paras  = trim($_POST['total_paras']);

	// update query likte hobe
	// ========================================
	$sql = "UPDATE details SET motor_cash = '$motor_cash', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$Information', buyer_id = '$buyer_id', address = '$address', sl_no = '$sl_no', delivery_no = '$delivery_no', motor = '$motor', motor_no = '$motor_no', delivery_date = '$delivery_date', dates = '$dates', partculars = '$partculars', particulars = '$particulars', debit = '$debit', mm = '$mm', kg = '$kg', paras = '$paras', credit = '$credit ', discount = '$discount', balance = '$balance', bundil = '$bundil', total_paras = '$total_paras' WHERE id = '$rod_details_id'";

	if ($db->select($sql) === TRUE) {
		$sucMsg = "Rod details updated Successfully.";
		echo "Rod details updated Successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}

}

