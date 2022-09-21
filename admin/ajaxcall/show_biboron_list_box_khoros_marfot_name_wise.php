<?php
  	session_start();  
  	require '../config/config.php';
  	require '../lib/database.php';
  	$db = new Database();
  	$project_name_id = $_SESSION['project_name_id'];
  	$khoros_marfot_name = $_POST['khoros_marfot_name'];
    $search_date = $_POST['search_date'];

    $all_total_taka = 0;
    $all_total_bill = 0;
    $all_group_pay = 0;
    $all_group_due = 0;

    if($search_date == 'alldates'){
        // $query = "SELECT DISTINCT group_description FROM debit_group_data WHERE group_id='$khotos_khat_id' AND project_name_id = '$project_name_id'";
        $query = "SELECT DISTINCT group_description FROM debit_group_data WHERE group_name='$khoros_marfot_name' AND project_name_id = '$project_name_id'";
        $read = $db->select($query);
        if ($read) {
            echo '<select id="descriptionGroupList" style="position: absolute; margin-left: 4px;">';
            echo '<option value="none">Select...</option>';
            while ($row = $read->fetch_assoc()) {
                $group_description = $row['group_description'];
                if($group_description != ''){
                    echo '<option value="'.$group_description.'">'.$group_description.'</option>';
                }                        
            }
            echo '</select>';
        }
    } else {
        // echo $search_date; jodi date thake
        // $query = "SELECT DISTINCT group_description, id  FROM debit_group_data WHERE group_id='$khotos_khat_id' AND project_name_id = '$project_name_id'";
        $query = "SELECT DISTINCT group_description FROM debit_group_data WHERE group_name='$khoros_marfot_name' AND entry_date = '$search_date' AND project_name_id = '$project_name_id'";
        $read = $db->select($query);
        if ($read) {
            echo '<select id="descriptionGroupList" style="position: absolute; margin-left: 4px;">';
            echo '<option value="none">Select...</option>';
            while ($row = $read->fetch_assoc()) {
                $group_description = $row['group_description'];
                if($group_description != ''){
                    echo '<option value="'.$group_description.'">'.$group_description.'</option>';
                }
            }
            echo '</select>';
        }
    }

    