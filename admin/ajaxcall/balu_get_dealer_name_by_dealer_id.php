<?php 
	session_start();
    $dealerId	= $_POST['dealerId'];
    $_SESSION['dealerIdInput'] = $_POST['dealerId'];
	// echo $dealerId;

	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	$sql = "SELECT customer_name, address, mobile FROM customers_balu WHERE customer_id = '$dealerId'";
    $all_custmr_id = $db->select($sql);
	if($all_custmr_id->num_rows > 0){
	  	$row = $all_custmr_id->fetch_assoc();

	    $customer_name = $row['customer_name'];
	    $address = $row['address'];
	    // $contact_person_name = $row['contact_person_name'];
	    $mobile = $row['mobile'];
?>
		<!-- <h2 class="text-center"><?php echo $customer_name; ?></h2>
		<h5 class="text-center"><?php echo $address; ?></h5>
		<h5 class="text-center"><?php echo $contact_person_name; ?>, <?php echo $mobile; ?></h5>
		<h4 class="text-center"><?php echo date("d/m/Y"); ?></h4> -->

		<?php
			// echo $dealer_name . ", ";
			echo $customer_name ;
		?>
		<span class="protidinHisab"><?php echo $address; ?></span>
		<span class="protidinHisab"><?php echo $contact_person_name .", ". $mobile . ", তারিখ: " . date("d/m/Y"); ?></span>

<?php
	} else{
?>
		<!-- To view select a dealer name, <span class="protidinHisab"> ক্রয় হিসাব</span> -->
<?php
	}
?>





