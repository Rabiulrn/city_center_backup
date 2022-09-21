<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	$project_name_id = $_SESSION['project_name_id'];
	$monthvalue		= $_POST['monthvalue'];
	$yearvalue		= $_POST['yearvalue'];
	// echo $fromdate;
	// echo $todate;
	

	$table_header = '<tr style="border: 1px solid #ddd; background-color: #8e8e8e;">
				        <th width="100px" style="border: 1px solid #ddd;  padding: 3px 10px;">ক্রমিক নং</th>
				        <th width="100px" style="border: 1px solid #ddd;  padding: 3px 10px;">তারিখ</th>
				        <th style="border: 1px solid #ddd;  padding: 3px 10px;">মারফোত নাম</th>
				        <th style="border: 1px solid #ddd;  padding: 3px 10px;">টাকা</th>
				        <th style="border: 1px solid #ddd;  padding: 3px 10px;">খরচ</th>
				        <th style="border: 1px solid #ddd;  padding: 3px 10px;">জের</th>
				    </tr>';
	


	if($monthvalue == ''){
		echo $table_header;
		$query = "SELECT * FROM agrim_hisab WHERE project_name_id = '$project_name_id'";
        $result = $db->select($query);
        $row_number = mysqli_num_rows($result);
		if ($result && $row_number > 0) {
        	$i = 1;
            $total_agrim_amount = 0;
            $total_agrim_khoros = 0;
            $total_agrim_jer = 0;
        	while ($row = $result->fetch_assoc()){
        		$agrim_name = $row['agrim_name'];
                $agrim_amount = $row['agrim_amount'];
                $agrim_khoros = $row['agrim_khoros'];
                $agrim_jer = $row['agrim_jer'];
                $agrim_date = $row['agrim_date'];

                if($agrim_amount == ''){
                    $agrim_amount = 0;
                }
                if($agrim_khoros == ''){
                    $agrim_khoros = 0;
                }
                if($agrim_jer == ''){
                    $agrim_jer = 0;
                }
                $total_agrim_amount += $agrim_amount;
                $total_agrim_khoros += $agrim_khoros;
                $total_agrim_jer += $agrim_jer;
                if($agrim_date == '0000-00-00'){
                    $agrim_date ='';
                    //then date will show 01/01/1970
                }
                echo "<tr class='cm_row' onclick=\"show_credit_name_wise_agrim('" . $agrim_name . "')\">";
                echo "<td style='border: 1px solid #ddd; text-align:center'>" .$i . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($agrim_date)) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $agrim_name . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($agrim_amount, 2) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($agrim_khoros, 2) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($agrim_jer, 2) . "</td>";
                
                echo "</tr>";
                $i++;
            }
            echo "<tr>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;' colspan='3'>মোটঃ</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($total_agrim_amount, 2) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($total_agrim_khoros, 2) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($total_agrim_jer, 2) . "</td>";
            echo "</tr>";
        } else {
			echo "<tr><td colspan='6' class='cenText'>Data is not found !</tr></td>";
        }
	} else {
		$dateMatch = $yearvalue."-".$monthvalue."-";


		echo $table_header;
		$query = "SELECT * FROM agrim_hisab WHERE agrim_date like '$dateMatch%%' AND project_name_id = '$project_name_id'";
        $result = $db->select($query);
        $row_number = mysqli_num_rows($result);
		if ($result && $row_number > 0) {
        	$i = 1;
            $total_agrim_amount = 0;
            $total_agrim_khoros = 0;
            $total_agrim_jer = 0;
        	while ($row = $result->fetch_assoc()){
        		$agrim_name = $row['agrim_name'];
                $agrim_amount = $row['agrim_amount'];
                $agrim_khoros = $row['agrim_khoros'];
                $agrim_jer = $row['agrim_jer'];
                $agrim_date = $row['agrim_date'];

                if($agrim_amount == ''){
                    $agrim_amount = 0;
                }
                if($agrim_khoros == ''){
                    $agrim_khoros = 0;
                }
                if($agrim_jer == ''){
                    $agrim_jer = 0;
                }
                $total_agrim_amount += $agrim_amount;
                $total_agrim_khoros += $agrim_khoros;
                $total_agrim_jer += $agrim_jer;
                if($agrim_date == '0000-00-00'){
                    $agrim_date ='';
                    //then date will show 01/01/1970
                }
                echo "<tr>";
                echo "<td style='border: 1px solid #ddd; text-align:center'>" .$i . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($agrim_date)) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $agrim_name . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($agrim_amount, 2) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($agrim_khoros, 2) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($agrim_jer, 2) . "</td>";
                
                echo "</tr>";
                $i++;
            }
            echo "<tr>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;' colspan='3'>মোটঃ</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($total_agrim_amount, 2) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($total_agrim_khoros, 2) . "</td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>" . number_format($total_agrim_jer, 2) . "</td>";
            echo "</tr>";
        } else {
			echo "<tr><td colspan='6' class='cenText'>Data is not found !</tr></td>";
        }
	}
?>

	




