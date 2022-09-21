<?php 
	session_start();
	$cement_details_id = $_POST['cement_details_id'];

	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$sucMsg ="";


if(isset($cement_details_id)){
    
	
    $buyer_id       = trim($_POST['buyer_id']);
    // $type = trim($_POST['type']);
    $motor_name           = trim($_POST['motor_name']);
    $driver_name           = trim($_POST['driver_name']);
    $motor_vara          = trim($_POST['motor_vara']);
    $unload          = trim($_POST['unload']);
    $car_rent_redeem  = trim($_POST['cars_rent_redeem']);
    $information      = trim($_POST['information']);
    // $delear_id      = trim($_POST['delear_id']);
    $dealer_id      = trim($_SESSION['dealerIdInput']);
    $sl      = trim($_POST['sl_no']);
    $challan_no     = trim($_POST['challan_no']);
    $address        = trim($_POST['address']);
    $motor_no          = trim($_POST['motor_number']);
    $motor_sl    = trim($_POST['motor_sl']);
  
    // $delivery_date  = trim($_POST['delivery_date']);
    if($_POST['challan_date'] == ''){
      $challan_date = $_POST['challan_date'];
    } else {
      $postDateArr    = explode('-', $_POST['challan_date']);
      $challan_date  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
    }
    if($_POST['so_date'] == ''){
      $so_date = $_POST['so_date'];
    } else {
      $postDateArr    = explode('-', $_POST['so_date']);
      $so_date  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
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
    $count          = trim($_POST['count']);
    $fee  = trim($_POST['fee']);
   
   
    $paras      = trim($_POST['paras']);
    $discount     = trim($_POST['discount']);
    $credit      = trim($_POST['credit']);
    $balance      = trim($_POST['balance']);
    $total_credit = trim($_POST['total_credit']);
    $weight      = trim($_POST['weight']);
   

	// update query likte hobe
	// ========================================
    //  $sql2 = "UPDATE details_balu SET information = '$information'";
  //  $sql = "UPDATE details_balu SET buyer_id = '$buyer_id', motor_name = '$motor_name', driver_name = '$driver_name', motor_vara = '$motor_vara', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$information', sl = '$sl', voucher_no = '$voucher_no', address = '$address',  motor_sl = '$motor_sl', delivery_date = '$delivery_date', dates = '$dates', partculars = '$partculars', particulars = '$particulars', debit = '$debit',`ton & kg`='$ton_kg',`length`='$length',`width`='$width',`height`='$height',`shifty`='$shifty',`inchi (-)_minus`='$inchi_minus',`cft (-)_dropped out`='$cft_dropped_out',`inchi (+)_added`='$inchi_added',`points ( - )_dropped out`='$points_dropped_out',`shift`='$shift',`total_shift`='$total_shift',`paras`='$paras',`discount`='$discount',`credit`='$credit',`balance`='$balance',`cemeats_paras`='$cemeats_paras',`ton`='$ton',`bank_name`='$bank_name',`fee`='$fee'  WHERE id = '$balu_details_id'";
 // UPDATE `details_cement` SET `id`=[value-1],`buyer_id`=[value-2],`dealer_id`=[value-3],`motor_name`=[value-4],`driver_name`=[value-5],`motor_vara`=[value-6],`unload`=[value-7],`cars_rent_redeem`=[value-8],`information`=[value-9],`sl`=[value-10],`challan_no`=[value-11],`address`=[value-12],`motor_no`=[value-13],`motor_sl`=[value-14],`so_date`=[value-15],`dates`=[value-16],`partculars`=[value-17],`particulars`=[value-18],`debit`=[value-19],`challan_date`=[value-20],`count`=[value-21],`total_credit`=[value-22],`weight`=[value-23],`paras`=[value-24],`discount`=[value-25],`credit`=[value-26],`balance`=[value-27],`fee`=[value-28],`project_name_id`=[value-29] WHERE 1;

    $sql = "UPDATE details_cement SET motor_name = '$motor_name', driver_name = '$driver_name', motor_vara = '$motor_vara', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$information', sl = '$sl', challan_no = '$challan_no', address = '$address',  motor_sl = '$motor_sl', dates = '$dates', motor_no ='$motor_no', debit = '$debit', count='$count',

    `paras`='$paras',`discount`='$discount',`credit`='$credit',`balance`='$balance',`fee`='$fee'  WHERE id = '$cement_details_id'";
    // partculars = '$partculars', particulars = '$particulars', debit = '$debit',`ton & kg`='$ton_kg',`length`='$length',`width`='$width',`height`='$height',`shifty`='$shifty',`inchi (-)_minus`='$inchi_minus',`cft (-)_dropped out`='$cft_dropped_out',`inchi (+)_added`='$inchi_added',`points ( - )_dropped out`='$points_dropped_out',`shift`='$shift',`total_shift`='$total_shift',`ton`='$ton',
    // 

//    $sql2 = "UPDATE `details_balu` SET `motor_name`='$motor_name',`driver_name`='$driver_name',`motor_vara`= '$motor_vara',`unload`='$unload',`cars_rent_redeem`='$car_rent_redeem',`information`='$information',`sl`='$sl',`voucher_no`='$voucher_no',`address`='$address',`motor_no`='$motor_sl',`motor_sl`='$motor_sl',`delivery_date`='$delivery_date',
//    `dates`='$dates',`partculars`='$particulars',`particulars`='$debit'  WHERE id = '$id'";
//--    ,`debit`=[value-20],`ton & kg`=[value-21],`length`=[value-22],`width`=[value-23],`height`=[value-24],`shifty`=[value-25],`inchi (-)_minus`=[value-26],`cft (-)_dropped out`=[value-27],`inchi (+)_added`=[value-28],`points ( - )_dropped out`=[value-29],`shift`=[value-30],`total_shift`=[value-31],`paras`=[value-32],`discount`=[value-33],`credit`=[value-34],`balance`=[value-35],`cemeats_paras`=[value-36],`ton`=[value-37],`total_shifts`=[value-38],`tons`=[value-39],`bank_name`=[value-40],`fee`=[value-41] WHERE 1";
    
    //  ,  

	if ($db->select($sql) === TRUE) {
		$sucMsg = "Pathor details updated Successfully.";
		echo "Pathor details updated Successfully.";
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}


}

