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

    $paonader_grand_total = 0;
    echo '<table class="tableshow" id="tableshow" style="border: 1px solid #ddd; border-collapse: collapse; font-size: 14px; width: 100%;">';
	$query = "SELECT * FROM jara_pabe WHERE pabe_name LIKE '%$searchTxt%' AND project_name_id = '$project_name_id'";
    $result = $db->select($query);
    if ($result && mysqli_num_rows($result) > 0) {
    	$i = 1;        
    	while ($row = $result->fetch_assoc()){
    		$pabe_id = $row['pabe_id'];
    		$pabe_date = $row['pabe_date'];
    		$pabe_name = $row['pabe_name'];
    		$pabe_description = $row['pabe_description'];
    		$pabe_amount = trim($row['pabe_amount']);
    		if($pabe_amount == ''){
    			$pabe_amount = 0;
    		}
    		echo "<tr style='background-color: #8e8e8e;'>";
        		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" .$i . "</th>";
        		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'  width = '100px'>" . date("d-m-Y", strtotime($pabe_date)) . "</th>";
        		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $pabe_name . "</th>";
        		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $pabe_description . "</th>";
        		echo "<th style='border: 1px solid #ddd; padding:3px 10px; text-align: left;'>" . number_format($pabe_amount, 2) . "</th>";			            		
    		echo "</tr>";

    		
    		$sql = "SELECT * FROM entry_jara_pabe WHERE jara_pabe_id ='$pabe_id' AND project_name_id = '$project_name_id' ORDER BY jp_date ASC";
    		$rslt = $db->select($sql);
    		if (mysqli_num_rows($rslt) > 0) {
				while ($rslt_row = $rslt->fetch_assoc()) {
					$jp_id = trim($rslt_row['jp_id']);
            		$jp_name = trim($rslt_row['jp_name']);
            		$jp_description = trim($rslt_row['jp_description']);
            		$jp_amount = trim($rslt_row['jp_amount']);
                    $jp_status = trim($rslt_row['jp_status']);
            		$jp_date = trim($rslt_row['jp_date']);
            		if($jp_amount == ''){
            			$jp_amount = 0;
            		}
            		if($jp_status == 'add'){
                        // $sub_total += $nij_amount;
                        $pabe_amount += $jp_amount;
                        echo "<tr>";
                            echo "<td></td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($jp_date)) . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $jp_name . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $jp_description . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>+ " . number_format($jp_amount, 2) . "</td>";                                     
                        echo "</tr>";
                    } else {
                        // $sub_total -= $nij_amount;
                        $pabe_amount -= $jp_amount;
                        echo "<tr>";
                            echo "<td></td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($jp_date)) . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $jp_name . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $jp_description . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>- " . number_format($jp_amount, 2) . "</td>";                                     
                        echo "</tr>";
                    }
				}
			}
            $balance = $pabe_amount;
            $paonader_grand_total += $pabe_amount;
			echo "<tr><td colspan='4' style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>ব্যালেন্সঃ</td><td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($balance, 2) . "</td></tr>";
			echo "<tr><td colspan='5' style='border: 1px solid #ddd; padding:3px 10px; border-left: 1px solid transparent; border-right: 1px solid transparent;'>&nbsp;</td></tr>";
    		$i++;
    	}
        echo "<tr><td colspan='4' style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'><b>Ground Total:</b></td><td><b>". number_format($paonader_grand_total, 2) ."</b></td></tr>";
    } else {
		echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Data is not found !</tr></td>';
    }
    echo "</table>";
?>

