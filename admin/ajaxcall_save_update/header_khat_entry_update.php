<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $edit_id   = $_POST['edit_id'];

    $postDateArr        = explode('/', $_POST['entry_date']);      
    $entry_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

    $group_name = trim($_POST['group_name']);
    $group_description = trim($_POST['group_description']);
    $group_taka = trim($_POST['group_taka']);
    $group_pices = trim($_POST['group_pices']);
    $group_total_taka = trim($_POST['group_total_taka']);
    $group_pay = trim($_POST['group_pay']);
    $group_due = trim($_POST['group_due']);

    $query = "UPDATE debit_group_data SET entry_date ='$entry_date', group_name='$group_name', group_description='$group_description', group_taka='$group_taka', group_pices='$group_pices', group_total_taka='$group_total_taka', group_pay='$group_pay', group_due='$group_due' WHERE id = '$edit_id' AND project_name_id = '$project_name_id'";
    $update = $db->update($query);
    if ($update) {
        echo 'Data Updated Successfully!';
    } else {
        echo 'Failed to Update Data!';
    }
