<?php
session_start();
if(!isset($_SESSION['username'])){
	header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$project_name_id = $_SESSION['project_name_id'];
$group_id = $_POST['group_id'];
$sucMsg 	='';


// if (isset($_POST['submit'])) {
if (isset($group_id)) {
    $newFormatDate ='';
    $query = "SELECT * FROM debit_group WHERE id = $group_id";
    $read = $db->select($query);
    if ($read) {
        $row = $read->fetch_assoc();    
        $group_date_insert  = $row['group_date'];
        // echo '<script> alert("a' . $group_date_insert . '")</script>';
        $time = strtotime($group_date_insert);
        $newFormatDate = date('Y-m-d', $time);
    }
    for ($i = 0; $i < count($_POST['group_name']); $i++) {
        $postDateArr        = explode('/', $_POST['entry_date'][$i]);      
        $entry_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

        $group_name        = trim($_POST['group_name'][$i]);
        $group_description = trim($_POST['group_description'][$i]);
        $taka              = trim($_POST['taka'][$i]);
        $pices             = trim($_POST['pices'][$i]);
        $total_taka        = trim($_POST['total_taka'][$i]);
        // $total_bill        = $_POST['total_bill'][$i];
        $pay               = trim($_POST['pay'][$i]);
        $due               = trim($_POST['due'][$i]);
        
        // $query = "INSERT INTO debit_group_data(entry_date, group_name, group_description, group_taka, group_pices, group_total_taka, group_total_bill, group_pay, group_due, group_id, dg_date, project_name_id) VALUES ('$entry_date', '$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$total_bill', '$pay', '$due', '$group_id', '$newFormatDate', '$project_name_id')";
        $query = "INSERT INTO debit_group_data(entry_date, group_name, group_description, group_taka, group_pices, group_total_taka, group_pay, group_due, group_id, dg_date, project_name_id) VALUES ('$entry_date', '$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$pay', '$due', '$group_id', '$newFormatDate', '$project_name_id')";
        $result = $db->insert($query);
        if ($result) {          
            $sucMsg = 'Data is inserted successfully !';
        } else {
            $sucMsg = 'Data is not inserted !';
        }
    }
}
echo $sucMsg;