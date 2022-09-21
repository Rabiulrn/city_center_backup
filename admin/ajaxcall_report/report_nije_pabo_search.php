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

    echo '<table class="tableshow" id="tableshow" style="border: 1px solid #ddd; border-collapse: collapse; font-size: 14px; width: 100%;">';
  	$query = "SELECT * FROM nij_paonadar WHERE name LIKE '%$searchTxt%' AND project_name_id = '$project_name_id'";
    $result = $db->select($query);
    $row_number = mysqli_num_rows($result);
    $report_nije_pabo_grand_total = 0;
    if ($result && $row_number > 0) {
      	$i = 1;
      	while ($row = $result->fetch_assoc()){
        		$id = trim($row['id']);
        		$name = trim($row['name']);
        		$description = trim($row['description']);
        		$amount = trim($row['amount']);
        		$nij_paona_date = trim($row['nij_paona_date']);
        		if($amount == ''){
        			$amount = 0;
        		}
        		echo "<tr style='background-color: #8e8e8e;'>";
            		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $i . "</th>";
            		echo "<th style='border: 1px solid #ddd; padding:3px 10px;' width='100px'>" . date("d-m-Y", strtotime($nij_paona_date)) . "</th>";
            		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $name . "</th>";
            		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $description . "</th>";
            		echo "<th style='border: 1px solid #ddd; padding:3px 10px; text-align: left;'>" . number_format($amount, 2) . "</th>";
        		echo "</tr>";
      		
        		$sql = "SELECT * FROM entry_nij_paonadar WHERE nij_paonadar_id ='$id' AND project_name_id = '$project_name_id' ORDER BY nij_date ASC";
        		$rslt = $db->select($sql);
        		if (mysqli_num_rows($rslt) > 0) {
    				    while ($rslt_row = $rslt->fetch_assoc()) {
    					      $nij_id = trim($rslt_row['nij_id']);
                		$nij_name = trim($rslt_row['nij_name']);
                		$nij_description = trim($rslt_row['nij_description']);
                		$nij_amount = trim($rslt_row['nij_amount']);
                    $nij_status = trim($rslt_row['nij_status']);
                		$nij_date = trim($rslt_row['nij_date']);
                		if($nij_amount == ''){
                			$nij_amount = 0;
                		}
          					if($nij_status == 'add'){
                        $amount += $nij_amount;
                        echo "<tr>";
                            echo "<td></td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($nij_date)) . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $nij_name . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $nij_description . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>+ " . number_format($nij_amount, 2) . "</td>";                                        
                        echo "</tr>";
                    } else {
                        $amount -= $nij_amount;
                        echo "<tr>";
                            echo "<td></td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($nij_date)) . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $nij_name . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $nij_description . "</td>";
                            echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>- " . number_format($nij_amount, 2) . "</td>";                                        
                        echo "</tr>";
                    }
    				    }
            }
            $balance = $amount;
            $report_nije_pabo_grand_total += $amount;
      			echo "<tr><td colspan='4' style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>ব্যালেন্সঃ</td><td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($balance, 2) . "</td></tr>";
      			echo "<tr><td colspan='5' style='border: 1px solid #ddd; padding:3px 10px; border-left: 1px solid transparent; border-right: 1px solid transparent;'>&nbsp;</td></tr>";
          	$i++;
      	}
        echo "<tr><td colspan='4' style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'><b>Ground Total:</b></td><td><b>". number_format($report_nije_pabo_grand_total, 2) ."</b></td></tr>";
    } else {
		    echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Data is not found !</tr></td>';
    }
    echo '</table>';
?>



























	<!-- <tr style="border: 1px solid #ddd; background-color: #8e8e8e;">
		<th width="100px" style="border: 1px solid #ddd;  padding: 3px 10px;">ক্রমিক নং</th>
		<th style="border: 1px solid #ddd;  padding: 3px 10px;">মারফোত নাম</th>
		<th style="border: 1px solid #ddd;  padding: 3px 10px;">বিবরণ</th>
		<th style="border: 1px solid #ddd;  padding: 3px 10px;">জমা</th>
		<th width="100px" style="border: 1px solid #ddd;  padding: 3px 10px;">তারিখ</th>
	</tr> -->

	<?php
		// $query = "SELECT * FROM nij_paonadar WHERE name LIKE '%$searchTxt%' AND project_name_id = '$project_name_id'";
  //       $result = $db->select($query);
  //       $row_number = mysqli_num_rows($result);
		// if ($result && $row_number > 0) {
  //       	$i = 1;
  //       	while ($row = $result->fetch_assoc()){
  //       		echo "<tr>";
  //       		echo "<td class='cenText' style='border: 1px solid #ddd; text-align:center'>" .$i . "</td>";
  //       		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $row['name'] . "</td>";
  //       		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $row['description'] . "</td>";
  //       		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($row['amount'], 2) . "</td>";
  //       		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($row['nij_paona_date'])) . "</td>";
  //       		echo "</tr>";
  //       		$i++;
  //       	}					
  //       } else {
		// 	echo "<tr><td colspan='4' class='cenText'>Data is not found !</tr></td>";
  //       }
    ?>
