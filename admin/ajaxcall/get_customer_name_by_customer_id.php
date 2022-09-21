<?php 
	session_start();
    $customerId	= $_POST['customerId'];
    // $_SESSION['customerIdInput'] = $_POST['customerId'];
	// echo $dealerId;

	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	$sql = "SELECT customer_name, address, mobile FROM customers WHERE customer_id = '$customerId'";
    $all_custmr_id = $db->select($sql);
	  	if($all_custmr_id->num_rows > 0){
	      	$row = $all_custmr_id->fetch_assoc();
	        
	        $customer_name = $row['customer_name'];
	        $address = $row['address'];
	        $mobile = $row['mobile'];
?>
			<h2 class="text-center"><?php echo $customer_name; ?></h2>
			<h5 class="text-center"><?php echo $address; ?></h5>
			<h5 class="text-center"><?php echo $mobile; ?></h5>
			<h4 class="text-center"><?php echo date("d/m/Y"); ?></h4>
<?php	        
	    } else{
?>
	    	<h2 class="text-center">To view select a customer name.</h2>
			<h4 class="text-center"><?php echo date("d/m/Y"); ?></h4>
<?php
	    }
?>