<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	$project_name_id = $_SESSION['project_name_id'];
	$credit_txt = $_POST['credit_name'];
	?>

	<tr style="border: 1px solid #ddd; background-color: #8e8e8e;">
		<th width="100px" style="border: 1px solid #ddd;  padding: 3px 10px;">ক্রমিক নং</th>
		<th style="border: 1px solid #ddd;  padding: 3px 10px;">মারফোত নাম</th>
		<th style="border: 1px solid #ddd;  padding: 3px 10px;">জমা</th>
		<th width="100px" style="border: 1px solid #ddd;  padding: 3px 10px;">তারিখ</th>
	</tr>

	<?php
		$query = "SELECT * FROM vaucher_credit WHERE credit_name = '$credit_txt' AND project_name_id = '$project_name_id'";
        $result = $db->select($query);
        $row_number = mysqli_num_rows($result);
		if ($result && $row_number > 0) {
        	$i = 1;
            $credit_amount_total = 0;
        	while ($row = $result->fetch_assoc()){
        		$credit_name = $row['credit_name'];
                $credit_amount = $row['credit_amount'];
                $credit_date = $row['credit_date'];

                if($credit_amount == ''){
                    $credit_amount = 0;
                }
                $credit_amount_total += $credit_amount;
                if($credit_date == '0000-00-00'){
                    $credit_date ='';
                    //then date will show 01/01/1970
                }
        		echo "<tr>";
	        		echo "<td class='cenText' style='border: 1px solid #ddd; text-align:center'>" .$i . "</td>";
	        		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $credit_name . "</td>";
	        		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($credit_amount, 2) . "</td>";
	        		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($credit_date)) . "</td>";
        		echo "</tr>";
        		$i++;
        	}
        	echo "<tr>";
                echo "<td colspan='2' style='border: 1px solid #ddd; text-align:right'>মোটঃ </td>";
                echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($credit_amount_total, 2) . "</td>";
            echo "</tr>";		
        } else {
			echo "<tr><td colspan='4' class='cenText'>Data is not found !</tr></td>";
        }
    ?>
