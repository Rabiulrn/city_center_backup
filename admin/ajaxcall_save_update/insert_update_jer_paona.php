<?php 
	session_start();  
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$sucMsg = '';
	$state = '';
	$return_arr = array();
	$project_name_id = $_SESSION['project_name_id'];

	$submitVal = trim($_POST['insert_update_val']);
	$due_date = trim($_POST['entry_date']);
	$due_credit_amount = trim($_POST['credit_new']);
	$due_debit_amount = trim($_POST['debit_new']);
	$edit_row_id = trim($_POST['row_id']);

	  if($due_credit_amount == ''){
	    $due_credit_amount = 0;
	  }
	  if($due_debit_amount == ''){
	    $due_debit_amount = 0;
	  }
	  
	  if($submitVal == 'Save' && $edit_row_id == '0'){
	      $isExitDate_sql = "SELECT due_debit_date FROM due WHERE due_debit_date = '$due_date' AND project_name_id = '$project_name_id'";
	      $hasDate = $db->select($isExitDate_sql);
	      if(mysqli_num_rows($hasDate) == 0){
	          $query ="INSERT INTO due (due_credit_amount, due_debit_amount, due_debit_date, project_name_id) VALUES ('$due_credit_amount', '$due_debit_amount', '$due_date', '$project_name_id')";
	          $result = $db->select($query);
	          if($result){
	            $sucMsg = 'New Data Inserted Successfully!';
	            $state = 'inserted';
	          } else {
	            $sucMsg = 'Data is not Inserted';
	            $state = 'not_inserted';
	          }
	      } else {
	      		$date_exit = date('d/m/Y', strtotime($due_date));
	          $sucMsg = 'Data already inserted at the date '. $date_exit .'. Please update that data.';
	          // $sucMsg = 'Data already inserted at the date. Please update that data.';
	          $state = 'already_exist';
	      }
	  } else {
	        $query = "UPDATE due SET due_credit_amount='$due_credit_amount', due_debit_amount='$due_debit_amount', due_debit_date = '$due_date' WHERE id = ' $edit_row_id' AND project_name_id = '$project_name_id'";
	        $update = $db->update($query);
	        if ($update) {
	          $sucMsg = 'Data Updated Successfully!';
	          $state = 'updated';
	        } else {
	          $sucMsg = 'Failed to Update Data!';
	          $state = 'not_updated';
	        }
	  }
	// }
	// echo $sucMsg;
	

	  //Update date list
    $sql = "SELECT DISTINCT due_debit_date FROM due WHERE project_name_id = '$project_name_id' ORDER BY due_debit_date ASC";
    $result = $db->select($sql);
    // echo '<select id="debit_date_list" data-width="125px" data-style="btn-info">';
    $date_list_html = '';
    $date_list_html .= '<option value ="'.date("Y-m-d").'">'.date("d/m/Y").'</option>';
    $date_list_html .= '<option value ="none">All Dates...</option>';
    if($result && mysqli_num_rows($result) > 0){
        while ($date = $result->fetch_assoc()) {
            $due_debit_date = $date['due_debit_date'];
            if( $due_debit_date !== '0000-00-00'){
                $date_list_html .= '<option value="' . $due_debit_date . '">' . date("d/m/Y", strtotime($due_debit_date)) . '</option>';
            }                                
        }                            
    }
    // echo '</select>';



	$return_arr[] = array("sucMsg" => $sucMsg,
                    "state" => $state,
                    "date_list_html" => $date_list_html);
	// Encoding array in JSON format
	echo json_encode($return_arr);