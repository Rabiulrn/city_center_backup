<?php 
	session_start();
	$balu_details_id = $_POST['balu_details_id'];

	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$sucMsg ="";


if(isset($balu_details_id)){
    
    $motor_name           = trim($_POST['motor_name']);
    $driver_name           = trim($_POST['driver_name']);
    $motor_vara          = trim($_POST['motor_vara']);
    $unload          = trim($_POST['unload']);
    $car_rent_redeem  = trim($_POST['cars_rent_redeem']);
    $information      = trim($_POST['information']);
    // $delear_id      = trim($_POST['delear_id']);
    $delear_id      = trim($_SESSION['dealerIdInput']);
    $sl      = trim($_POST['sl']);
    $voucher_no     = trim($_POST['voucher_no']);
    $address        = trim($_POST['address']);
    $motor_number          = trim($_POST['motor_number']);
    $motor_sl    = trim($_POST['motor_sl']);

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
	$partculars     = trim($_POST['partculars']);
    $particulars    = trim($_POST['particulars']);
    $debit        = trim($_POST['debit']);
    $ton_kg          = trim($_POST['ton_kg']);
    $length         = trim($_POST['length']);
    $width        = trim($_POST['width']);
    $height     = trim($_POST['height']);
    $shifty     = trim($_POST['shifty']);
    $inchi_minus        = trim($_POST['inchi_minus']);
    $cft_dropped_out    = trim($_POST['cft_dropped_out']);
    $inchi_added    = trim($_POST['inchi_added']);
    $points_dropped_out      = trim($_POST['points_dropped_out']);
    $shift      = trim($_POST['shift']);
    $total_shift      = trim($_POST['total_shift']);
   
    $paras      = trim($_POST['paras']);
    $discount     = trim($_POST['discount']);
    $credit      = trim($_POST['credit']);
    $balance      = trim($_POST['balance']);
    $cemeats_paras      = trim($_POST['cemeats_paras']);
    $ton    = trim($_POST['ton']);
    $total_shifts  = trim($_POST['total_shifts']);
    $tons  = trim($_POST['tons']);
    $bank_name  = trim($_POST['bank_name']);
    $fee  = trim($_POST['fee']);

	// update query is written here
	// ========================================
	// $sql = "UPDATE details_sell_balu SET motor_name = '$motor_name', driver_name = '$driver_name', motor_vara = '$motor_vara', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$information', sl = '$sl', voucher_no = '$voucher_no', address = '$address', motor_number = '$motor_number', motor_sl = '$motor_sl', delivery_date = '$delivery_date', dates = '$dates', partculars = '$partculars', particulars = '$particulars', debit = '$debit', ton & kg = '$ton_kg', length = '$length', width = '$width', height = '$height', shifty = '$shifty', inchi (-)_minus = '$inchi_minus', cft_ (-)dropperd_out = '$cft_dropperd_out', inchi (+)_added = '$inchi_added', points ( - )_dropped_out = '$points_dropped_out', shift = '$shift', total_shift = '$total_shift', paras = '$paras', discount = '$discount', balance = '$balance', discount ='$discount', credit ='$credit', balance = '$balance', cemeats_paras= '$cemeats_paras', ton = '$ton', total_shifts = '$total_shifts' tons = '$tons', bank_name = '$bank_name', fee = '$fee' WHERE id = '$balu_details_id'";

 //   $sql = "UPDATE details_balu SET buyer_id = '$buyer_id', motor_name = '$motor_name', driver_name = '$driver_name', motor_vara = '$motor_vara', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$information', sl = '$sl', voucher_no = '$voucher_no', address = '$address',  motor_sl = '$motor_sl', delivery_date = '$delivery_date', dates = '$dates', partculars = '$partculars', particulars = '$particulars', debit = '$debit',`ton & kg`='$ton_kg',`length`='$length',`width`='$width',`height`='$height',`shifty`='$shifty',`inchi (-)_minus`='$inchi_minus',`cft (-)_dropped out`='$cft_dropped_out',`inchi (+)_added`='$inchi_added',`points ( - )_dropped out`='$points_dropped_out',`shift`='$shift',`total_shift`='$total_shift',`paras`='$paras',`discount`='$discount',`credit`='$credit',`balance`='$balance',`cemeats_paras`='$cemeats_paras',`ton`='$ton',`bank_name`='$bank_name',`fee`='$fee'  WHERE id = '$balu_details_id'";
$sql ="UPDATE `details_sell_balu` SET `motor_name`='$motor_name',`driver_name`='$driver_name',`motor_vara`='$motor_vara',`unload`='$unload',`cars_rent_redeem`='$car_rent_redeem',`information`='$information',`sl`='$sl',`voucher_no`='$voucher_no',`address`='$address', motor_no = '$motor_number',`motor_sl`='$motor_sl ',`delivery_date`='$delivery_date',`dates`='$dates',`debit`='$debit',

`paras`='$paras',`discount`='$discount',`credit`='$credit',`balance`='$balance',`cemeats_paras`='$cemeats_paras',`bank_name`='$bank_name',`fee`='$fee'  WHERE id = '$balu_details_id'";
//,`partculars`='$partculars ',`particulars`='$particulars',`ton & kg`='$ton_kg',`length`='$length',`width`='$width',`height`='$height',`shifty`='$shifty',`inchi (-)_minus`='$inchi_minus',`cft (-)_dropped out`='$cft_dropped_out',`inchi (+)_added`='$inchi_added',`points ( - )_dropped out`='$points_dropped_out',`shift`='$shift',`total_shift`='$total_shift',`ton`='$ton',


// `length`='$length',`width`='$width',`height`='$height',`shifty`='$shifty',`inchi (-)_minus`='$inchi_minus',`cft (-)_dropped Out`='$cft_dropped_out',`inchi (+)_added`=' $inchi_added',`points ( - )_dropped out`='$points_dropped_out',`shift`='$shift',`total_shift`='$total_shift',`paras`='$paras',`discount`='$discount',`credit`='$credit',`balance`='$balance',`cemeats_paras`='$cemeats_paras',`ton`=' $ton',`total_shifts`='$total_shifts',`tons`=' $tons',`bank_name`='$bank_name',`fee`='$fee' WHERE id = '$balu_details_id'";





if ($db->select($sql) === TRUE) {
		$sucMsg = "Balu details updated Successfully.";
		echo "Balu details updated Successfully.";



	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}

}

