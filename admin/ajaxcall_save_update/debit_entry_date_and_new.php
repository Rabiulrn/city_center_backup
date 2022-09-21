<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();

    $project_name_id = $_SESSION['project_name_id'];
    $debit_group_id = $_POST['seletedId'];

    $query = "SELECT DISTINCT entry_date FROM debit_group_data WHERE group_id = '$debit_group_id' AND project_name_id = '$project_name_id' ORDER BY entry_date DESC";
    
    $show = $db->select($query);
    if($show){
        echo '<select class="entrydatepicker" id="newAndDateList">';
        echo '<option value="none">Select...</option>';
        echo '<option value="new_entry">New Entry</option>';
        while($rows = $show->fetch_assoc()) {
            $entry_date = $rows['entry_date'];
            if($entry_date !== '0000-00-00'){
                echo '<option value="' . $entry_date . '">' . date("d/m/Y", strtotime($entry_date)) . '</option>';
            }
        }
        echo '</select>';
    }