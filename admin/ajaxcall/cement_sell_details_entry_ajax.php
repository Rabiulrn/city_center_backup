<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location:../index.php');
}
$project_name_id = $_SESSION['project_name_id'];
require '../config/config.php';
require '../lib/database.php';
$db = new Database();


$customer_id       = trim($_POST['customer_id']);
$motor_name           = trim($_POST['motor_name']);
$driver_name           = trim($_POST['driver_name']);
$motor_vara          = trim($_POST['motor_vara']);
$unload          = trim($_POST['unload']);
$car_rent_redeem  = trim($_POST['car_rent_redeem']);
$information      = trim($_POST['information']);
// $delear_id      = trim($_POST['delear_id']);
$dealer_id      = trim($_SESSION['dealerIdInput']);
$sl      = trim($_POST['sl_no']);
$challan_no     = trim($_POST['challan_no']);
$address        = trim($_POST['address']);
$motor_no          = trim($_POST['motor']);
$motor_sl    = trim($_POST['motor_no']);

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
// $sql = "INSERT INTO details_balu (motor_name, driver_name, motor_vara, unload, cars_rent_redeem, information, buyer_id, dealer_id, voucher_no, address, motor_no, motor_sl, delivery_date, dates, partculars, debit, ton & kg, length, width , height, inchi(-)_minus, credit, cft(-)_dropped_out, inchi(+)_added, points(-)_dropped_out, shift, total_shift, paras, discount, credit, cemeats_paras, ton, total_shifts, tons, bank_name, fee, project_name_id) 
// VALUES('$motor_name', '$driver_name', '$motor_vara', '$unload', '$car_rent_redeem', '$information', '$buyer_id', '$delear_id', '$voucher_no', '$address', '$motor_no', '$motor_sl', '$delivery_date', '$dates', '$partculars', '$particulars', '$debit', '$ton_kg', '$length', '$width', '$height ','$inchi_minus','$cft_dropped_out', '$inchi_added', '$points_dropped_out', '$shift', '$total_shift', '$paras', '$discount', '$credit', '$cemeats_paras', '$ton', '$total_shifts', '$tons', '$bank_name', '$fee', '$project_name_id')";





// $sql = "SELECT partculars,particulars,sum(ton) as 'ton' FROM stocks_pathor WHERE partculars != '' AND ton > '$ton' GROUP BY partculars,particulars";
// $show = $db->select($sql);
// if ($show) {
//   $sql_update = "UPDATE stocks_pathor SET `ton` = `ton` - '$ton' WHERE partculars ='$partculars' AND particulars ='$particulars' AND ton > 0 ORDER BY ton DESC LIMIT 1";

//   $result2 = $db->select($sql_update);
//   // print_r($result2);
//   if ($result2) {
//     // print_r($sql_update);
//     // $sucMsg = "stocks updated Successfully.";
//     echo "stocks updated  Successfully.";
//   } else {
//     echo " marfot and particular not matched ";
//   }
// } else {
//   echo "higher than stocks.";
// }





if($customer_id != 'none'){
$sql = "INSERT INTO `details_sell_cement`
           (`customer_id`, `dealer_id`, `motor_name`,`driver_name`, `motor_vara`, `unload`, `cars_rent_redeem`, `information`, `sl`, `challan_no`, `address`, `motor_no`, `motor_sl`, `so_date`, `dates`, `partculars`, `particulars`, `debit`, `total_credit`, `paras`, `discount`, `credit`, `balance`, `weight`, `count`, `fee`,`project_name_id`) 
    VALUES ('$customer_id', '$dealer_id', '$motor_name', '$driver_name', '$motor_vara', '$unload', '$car_rent_redeem', '$information','$sl','$challan_no', '$address', '$motor_no', '$motor_sl', '$so_date', '$dates', '$partculars', '$particulars', '$debit', '$total_credit', '$paras', '$discount', '$credit', '$balance', '$weight','$count', '$fee','$project_name_id')";

// $sql ="INSERT INTO `details_sell_cement`
// (`id`, `dealer_id`, `customer_id`, `motor_name`, `driver_name`, `motor_vara`, `unload`, `cars_rent_redeem`, `information`, `sl`, `challan_no`, `address`, `motor_no`, `motor_sl`, `so_date`, `dates`, `partculars`, `particulars`, `debit`, `total_credit`, `challan_date`, `paras`, `discount`, `credit`, `balance`, `weight`, `count`, `fee`, `project_name_id`) 
// VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14],[value-15],[value-16],[value-17],[value-18],[value-19],[value-20],[value-21],[value-22],[value-23],[value-24],[value-25],[value-26],[value-27],[value-28],[value-29])";


$result = $db->insert($sql);
if ($result) {
  $sucMsg = "New Entry Saved Successfully.";
  $sucMsgPopup = "New Entry Saved Successfully.";
  echo $sucMsg;
} else {
  echo "Error: " . $sql . "<br>" . $db->error;
}


// $sql_update = "UPDATE stocks_pathor SET `ton` = `ton` - '$ton' WHERE partculars ='$partculars' AND particulars ='$particulars' AND `ton` - '$ton' >= 0 ORDER BY ton DESC LIMIT 1";

//   $result2 = $db->select($sql_update);
//   // print_r($result2);
//   if ($result2) {
//     // print_r($sql_update);
//     // $sucMsg = "stocks updated Successfully.";
//     echo "stocks updated  Successfully.";
//   } else {
//     echo " marfot and particular not matched ";
//   }
} ?>