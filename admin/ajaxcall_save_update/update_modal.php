<?php
session_start();
if(!isset($_SESSION['username'])){
	header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$project_name_id = $_SESSION['project_name_id'];
$sucMsg 	='';
$pay_due_total  = $_POST['pay_due_total'];
$get_ids           = $_POST['get_id']; //table row id 
$entry_date_modal = $_POST['entry_date_modal'];
if($entry_date_modal !== 'none'){
    if ($get_ids > 0) {
        // $query = "UPDATE debit_group_data SET group_pay='$pay_due_total', group_id='$get_id' WHERE id = $g_id";
      $query = "UPDATE debit_group_data SET group_pay='$pay_due_total' WHERE entry_date = '$entry_date_modal' AND  group_id='$get_ids' AND project_name_id = '$project_name_id' ORDER BY id LIMIT 1";
        $update = $db->update($query);
        if ($update) {
            // echo "<script>window.location.href = 'add_single_group_data.php?add_id=$get_id'</script>";
          	$sucMsg = 'New value set successfully.';
        } else {
            $sucMsg = 'New value can not set.';
        }
    }
}
echo $sucMsg;