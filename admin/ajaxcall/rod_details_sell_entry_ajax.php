<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];


    $motor_cash       = trim($_POST['motor_cash']);
    $unload           = trim($_POST['unload']);
    $car_rent_redeem  = trim($_POST['car_rent_redeem']);
    $Information      = trim($_POST['information']);
    $customer_id      = trim($_POST['customer_id']);
    // $delear_id      = trim($_POST['delear_id']);
    $delear_id      = trim($_SESSION['dealerIdInput']);
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
    $debit        = trim($_POST['debit']);
    $mm           = trim($_POST['mm']);
    $kg           = trim($_POST['kg']);
    $paras        = trim($_POST['paras']);
    $credit       = trim($_POST['credit']);
    $discount     = trim($_POST['discount']);
    $balance      = trim($_POST['balance']);
    $bundil       = trim($_POST['bundil']);
    $total_paras  = trim($_POST['total_paras']);

    // $sql = "INSERT INTO details_sell (motor_cash, unload, cars_rent_redeem, information, customer_id, dealer_id, address, sl_no, delivery_no, motor, motor_no, delivery_date, dates, partculars, particulars, debit,   mm, kg, paras, credit, discount, balance, bundil, total_paras) VALUES ('$motor_cash', '$unload', '$car_rent_redeem', '$Information', '$customer_id', '$delear_id', '$address', '$sl_no', '$delivery_no', '$motor', '$motor_no', '$delivery_date', '$dates', '$partculars', '$particulars', '$debit', '$mm', '$kg', '$paras', '$credit ', '$discount', '$balance', '$bundil', '$total_paras')";


    $sql = "INSERT INTO details_sell (motor_cash, unload, cars_rent_redeem, information, customer_id, dealer_id,  address, sl_no, delivery_no, motor, motor_no, delivery_date, dates, partculars, particulars, debit,   mm, kg, paras, credit, discount, balance, bundil, total_paras, project_name_id) VALUES ('$motor_cash', '$unload', '$car_rent_redeem', '$Information', '$customer_id', '$delear_id', '$address', '$sl_no', '$delivery_no', '$motor', '$motor_no', '$delivery_date', '$dates', '$partculars', '$particulars', '$debit', '$mm', '$kg', '$paras', '$credit ', '$discount', '$balance', '$bundil', '$total_paras', '$project_name_id')";

    $result = $db->insert($sql);
    if ($result) 
    {
      $sucMsg = "New Sells Entry Saved Successfully.";
      echo $sucMsg;
    } else{
      echo "Error: " . $sql . "<br>" . $db->error;
    }
  
  
  ?>