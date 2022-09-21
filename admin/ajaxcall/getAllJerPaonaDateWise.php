<?php 
	session_start();  
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$project_name_id = $_SESSION['project_name_id'];
	$due_debit_date = $_POST['selectedDate'];
	$edit_data_permission   = $_SESSION['edit_data'];
  	$delete_data_permission = $_SESSION['delete_data'];
?>

<form action="" method="POST" onsubmit="">                
	<table class="table table-bordered table-condensed" id="dynamic_field">
		<tr>
			<td class="text-center" style="width: 120px;">তারিখ</td>
			<td class="text-center" >পূর্বের জে‌রঃ</td>
			<td class="text-center" >পূর্বের পাওনাঃ</td>
			<td class="text-center" style="width: 90px;">Delete</td>
			<td class="text-center" style="width: 90px;">Edit</td>
		</tr>
		<?php
			$sql = "SELECT * FROM due WHERE due_debit_date = '$due_debit_date' AND project_name_id = '$project_name_id'";
			$result = $db->select($sql);
			$row_number = mysqli_num_rows($result);
			if($result && $row_number > 0){
				$i = 1;
				while($row = $result->fetch_assoc()){
					$row_id = $row['id'];
					$due_debit_date = $row['due_debit_date'];
					$due_credit_amount = $row['due_credit_amount'];
					$due_debit_amount = $row['due_debit_amount'];

					$due_debit_date_formated = '';
					if($due_debit_date == '0000-00-00'){
						$due_debit_date_formated = '';
					} else {
						$due_debit_date_formated = date('d/m/Y', strtotime($due_debit_date));
					}
					echo '<tr>';
					// echo '<td class='text-center'>'.$i.'</td>';
					echo '<td style="vertical-align: middle; text-align:center;">'.$due_debit_date_formated.'</td>';
					echo '<td style="vertical-align: middle;">'.$due_credit_amount.'</td>';
					echo '<td style="vertical-align: middle;">'.$due_debit_amount.'</td>';
					

					
					if($delete_data_permission == 'yes'){
			            echo '<td class="text-center" style="vertical-align: middle;"><input type="button" value="Delete" class= "btn btn-danger delete_due" detele_id="' . $row_id . '" delete_date="'.$due_debit_date.'"/></td>';
			        } else {
			            echo '<td class="text-center" style="vertical-align: middle;"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
			        }
								
					if($edit_data_permission == 'yes'){
			        	echo '<td class="text-center" style="vertical-align: middle;"><input type="button" value="Edit" class= "btn btn-success" edit_id="' . $row_id . '" onclick="displayupdate(this)"/></td>';    
			        } else {
			            echo '<td class="text-center" style="vertical-align: middle;"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
			        }

					echo "</tr>";
					$i++;
				}
			}
		?>
		<tr>
			<td>
				<input type="text" name="due_date" class="form-control" placeholder="dd/mm/yy" id="due_date_new" value="" />
			</td>
			<td>
				<input type="text" name="due_credit_amount" class="form-control" value="" id="credit_new" placeholder="পূর্বের জে‌র সংখ্যায়..." />
			</td>
			<td>
				<input type="text" name="due_debit_amount" class="form-control" value="" id="debit_new" placeholder="পূর্বের পাওনা সংখ্যায়..." />
			</td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<div class="form-group">
		<input type="button" class="form-control btn btn-primary updateBtn" name="inertUpdateBtn" value="Save" id="inertUpdateBtn">
		<input type="hidden" name="row_id" value="0" id="row_id">
	</div>
</form>