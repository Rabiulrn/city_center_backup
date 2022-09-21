<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php'); 
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $sucMsg = '';
    $_SESSION['pageName'] = 'modify_data';
    $project_name_id = $_SESSION['project_name_id'];

    $date_update = $_POST['date_update'];
	$search_date = $_POST['search_date'];

	if($date_update !=='' && $search_date !== ''){		
		$postDateArr        = explode('-', $date_update);
        $date_update        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
        // echo $date_update ."<br>" . $search_date;
        $query = "UPDATE vaucher_credit SET credit_date = '$date_update' WHERE credit_date = '$search_date' AND project_name_id = '$project_name_id'";
        $result = $db->update($query);
        if ($result) {
           $sucMsg .= 'Update successfully vaucher_credit!';
        } else {
            $sucMsg .= 'Data is not inserted !';
        }


        $query = "UPDATE nij_paonadar SET nij_paona_date = '$date_update' WHERE nij_paona_date = '$search_date' AND project_name_id = '$project_name_id'";
        $result = $db->update($query);
        if ($result) {
           $sucMsg .= 'Update successfully nij_paonadar!';
        } else {
            $sucMsg .= 'Data is not inserted !';
        }


        $query = "UPDATE jara_pabe SET pabe_date = '$date_update' WHERE pabe_date = '$search_date' AND project_name_id = '$project_name_id'";
        $result = $db->update($query);
        if ($result) {
           $sucMsg .= 'Update successfully jara_pabe!';
        } else {
            $sucMsg .= 'Data is not inserted !';
        }

        // $query = "UPDATE debit_group SET group_date = '$date_update' WHERE group_date = '$search_date' AND project_name_id = '$project_name_id'";
        // $result = $db->update($query);
        // if ($result) {
        // 	$sucMsg = 'Data is inserted successfully !';
        	$query = "UPDATE debit_group_data SET entry_date = '$date_update' WHERE entry_date = '$search_date' AND project_name_id = '$project_name_id'";
	        $result = $db->update($query);
	        if ($result) {
	           $sucMsg .= 'Update successfully debit_group_data!';
	        } else {
	            $sucMsg .= 'Data is not inserted !';
	        }
        // } else {
        //     $sucMsg = 'Data is not inserted !';
        // }
            echo  $sucMsg;
	}