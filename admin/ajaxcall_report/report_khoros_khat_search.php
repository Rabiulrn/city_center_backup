<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	$project_name_id = $_SESSION['project_name_id'];
	$searchTxt = $_POST['searchTxt'];
	// echo $searchTxt;
    $table_start = '<table class="tableshow" id="tableshow" style="border: 1px solid #ddd; font-size: 14px; border-collapse: collapse; width: 100%;">';
    $table_empty_row = '<tr><td colspan="8" style="border: 1px solid transparent;">&nbsp;</td></tr>';
    $table_no_data_fund = $table_start. '<tr><td style="text-align:center;">Data is not found khoros khat!</td></tr></table>';
    $table_row_without_table_tag = '<tr><td style="text-align:center;">Data is not found !1</td></tr>';
    $not_found_debit_group_data = 0;
    $not_found_first_time_debit_group_data = 0;

    $query = "SELECT * FROM debit_group WHERE project_name_id = '$project_name_id'";
    $result = $db->select($query);
    if ($result && mysqli_num_rows($result) > 0) {
        echo $table_start;
        $i = 1;
        while ($row = $result->fetch_assoc()){
            $debit_group_id = $row['id'];
            $debit_group_name = $row['group_name'];
            $debit_group_description = $row['group_description'];
            $debit_group_taka = $row['taka'];
            $debit_group_pices = $row['pices'];
            $debit_group_total_taka = $row['total_taka'];
            $debit_group_pay = $row['pay'];
            $debit_group_due = $row['due'];

            $mot_bill = 0;
            $mot_joma = 0;
            $not_found_first_time_debit_group_data++;
            $sql = "SELECT * FROM debit_group_data WHERE (group_name LIKE '%$searchTxt%' OR group_description LIKE '%$searchTxt%') AND project_name_id = '$project_name_id'";
            $rslt = $db->select($sql);
            if($rslt && mysqli_num_rows($rslt) > 0){                    
                // start header print
                    echo "<tr class='tableGroupColor' style='border: 1px solid #ddd; background-color: #8e8e8e;'>";
                        echo "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>" .$i . "</th>";
                        echo "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $debit_group_name . "</th>";
                        echo "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $debit_group_description . "</th>";
                        echo "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $debit_group_taka . "</th>";
                        echo "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $debit_group_pices . "</th>";
                        echo "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $debit_group_total_taka . "</th>";
                        echo "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $debit_group_pay . "</th>";
                        echo "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $debit_group_due . "</th>";
                        // echo "<th width='100px'>" . date("d-m-Y", strtotime($row['group_date'])) . "</th>";
                    echo "</tr>";
                // end header print
                while ($rows = $rslt->fetch_assoc()){
                    $dg_id = $rows['id'];
                    $dg_entry_date = $rows['entry_date'];
                    $dg_name = trim($rows['group_name']);
                    $dg_description = trim($rows['group_description']);
                    $dg_taka = trim($rows['group_taka']);
                    $dg_pices = trim($rows['group_pices']);
                    $dg_total_taka =trim( $rows['group_total_taka']);
                    $dg_pay = trim($rows['group_pay']);
                    $dg_due = trim($rows['group_due']);
                    if($dg_entry_date == '0000-00-00'){
                        $dg_entry_date = '';
                    }
                    if($dg_taka == ''){
                        $dg_taka = 0;
                    }
                    if($dg_total_taka == ''){
                        $dg_total_taka = 0;
                    }
                    if($dg_pay == ''){
                        $dg_pay = 0;
                    }
                    if($dg_due == ''){
                        $dg_due = 0;
                    }
                    $mot_bill += $dg_total_taka;
                    $mot_joma += $dg_pay;
                    echo "<tr>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . date("d-m-Y", strtotime($dg_entry_date)) . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_name . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_description . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_taka . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_pices . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . number_format($dg_total_taka, 2) . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . number_format($dg_pay, 2) . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . number_format($dg_due, 2) . "</td>";
                    echo "</tr>";                        
                }

                $jer = $mot_bill - $mot_joma;
                echo "<tr>
                        <td colspan='5' style='border: 1px solid #ddd;  padding: 3px 5px; text-align: right;'>মোটঃ</td>                               
                        <td style='border: 1px solid #ddd;  padding: 3px 5px;'>".number_format($mot_bill, 2)."</td>
                        <td style='border: 1px solid #ddd;  padding: 3px 5px;'>".number_format($mot_joma, 2)."</td>
                        <td style='border: 1px solid #ddd;  padding: 3px 5px;'>".number_format($jer, 2)."</td>
                    </tr>";
                echo $table_empty_row;
                $i++;
                $not_found_debit_group_data++;
            } else {
                if($not_found_debit_group_data == 0 && $not_found_first_time_debit_group_data == 0){
                    echo $table_row_without_table_tag;
                }
                $not_found_debit_group_data++;
            }
            
        }
        echo "</table>";
    } else {
        echo $table_no_data_fund;
    }

?>
