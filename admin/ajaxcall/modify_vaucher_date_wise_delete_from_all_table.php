<?php
    session_start();
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $dates =  $_GET['dateForDelete'];
    // echo  $dates;
    $sucDel ='';

    $sql = "DELETE FROM vaucher_credit WHERE credit_date = '$dates' AND project_name_id = '$project_name_id'";
    if ($db->select($sql) === TRUE) {
        $sucDel = "Joma Khat, From vaucher_credit delete successfully. ";
    } else {
        echo "Error: " . $sql . "<br>" .$db->error;
    }



    $slct_sql = "SELECT id FROM nij_paonadar WHERE nij_paona_date = '$dates' AND project_name_id = '$project_name_id'";
    $slct_rslt = $db->select($slct_sql);
    if($slct_rslt && $slct_rslt->num_rows > 0){
        while ($rows = $slct_rslt->fetch_assoc()){
            $id = $rows['id'];
            $sql = "DELETE FROM entry_nij_paonadar WHERE nij_paonadar_id = '$id' AND nij_date = '$dates' AND project_name_id = '$project_name_id'";
            if ($db->select($sql) === TRUE) {
                $sucDel .= "Nij paonadar entry, From entry_nij_paonadar delete successfully. ";
            } else {
                echo "Error: " . $sql . "<br>" .$db->error;
            }
        }
        $sql = "DELETE FROM nij_paonadar WHERE nij_paona_date = '$dates' AND project_name_id = '$project_name_id'";
        if ($db->select($sql) === TRUE) {
            $sucDel .= "Nije Pabo, From nij_paonadar delete successfully. ";
        } else {
            echo "Error: " . $sql . "<br>" .$db->error;
        }
    }
    


    $slct_sql = "SELECT pabe_id FROM jara_pabe WHERE pabe_date = '$dates' AND project_name_id = '$project_name_id'";
    $slct_rslt = $db->select($slct_sql);
    if($slct_rslt && $slct_rslt->num_rows > 0){
        while ($rows = $slct_rslt->fetch_assoc()){
            $pabe_id = $rows['pabe_id'];
            $sql = "DELETE FROM entry_jara_pabe WHERE jara_pabe_id = '$pabe_id' AND jp_date = '$dates' AND project_name_id = '$project_name_id'";
            if ($db->select($sql) === TRUE) {
                $sucDel .= "Jara pabe entry, From entry_jara_pabe delete successfully. ";
            } else {
                echo "Error: " . $sql . "<br>" .$db->error;
            }
        }
        $sql = "DELETE FROM jara_pabe WHERE pabe_date = '$dates' AND project_name_id = '$project_name_id'";
        if ($db->select($sql) === TRUE) {
            $sucDel .= "Jara pabe, From jara_pabe delete successfully. ";
        } else {
            echo "Error: " . $sql . "<br>" .$db->error;
        }
    }
    



    // $sql = "DELETE FROM debit_group WHERE group_date = '$dates' AND project_name_id = '$project_name_id'";
    // if ($db->select($sql) === TRUE) {
    	$sql2 = "DELETE FROM debit_group_data WHERE entry_date = '$dates' AND project_name_id = '$project_name_id'";
    	if ($db->select($sql2) === TRUE) {
	      $sucDel .= "Khoros Khat, From debit_group and debit_group_data delete successfully. ";
	    } else {
	      echo "Error: " . $sql . "<br>" .$db->error;
	    }
    // } else {
    //   echo "Error: " . $sql . "<br>" .$db->error;
    // }

    $sql = "DELETE FROM due WHERE due_debit_date = '$dates' AND project_name_id = '$project_name_id'";
    if ($db->select($sql) === TRUE) {
        $sucDel .= "Purber Paona and Jer, From due delete successfully. ";
    } else {
        echo "Error: " . $sql . "<br>" .$db->error;
    }

    echo $sucDel;
?>