<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $group_id   = $_POST['group_id'];
    $sucMsg = '';
// if(isset($_POST['update']))
// {  
    $postDateArr        = explode('/', $_POST['group_date']);      
    $group_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

    $group_name = trim($_POST['group_name']);
    $group_description = trim($_POST['group_description']);
    $taka = trim($_POST['taka']);
    $pices = trim($_POST['pices']);
    $total_taka = trim($_POST['total_taka']);
    $pay = trim($_POST['pay']);
    $due = trim($_POST['due']);

    $query = "UPDATE debit_group SET group_date = '$group_date', group_name = '$group_name', group_description = '$group_description', taka ='$taka', pices = '$pices', total_taka = '$total_taka', pay = '$pay', due = '$due' WHERE id = '$group_id'";
    $update = $db->update($query);
    if ($update) {
    $sucMsg = 'Data Header Updated Successfully!';
    } else {
    $sucMsg = 'Failed to Update Data!';
    }
// }
echo $sucMsg;