<?php 

require '../config/config.php';
require '../lib/database.php';
$db = new Database();

?>

<!-- total calculation section -->

<?php 
$sql_qry="SELECT SUM(credit_amount) AS total_credit FROM vaucher ";

$credit = $db->select($sql_qry);
while($credit_record = $credit->fetch_array()){
  $credit_total = $credit_record['total_credit'];
}


$sql_qry_due_credit="SELECT SUM(credit_amount) AS total_due_credit FROM due ";

$due_credit = $db->select($sql_qry_due_credit);
while($due_credits = $due_credit->fetch_array()){
  $total_due_credit = $due_credits['total_due_credit'];
}


$sql_qry="SELECT SUM(debit_cost) AS count FROM vaucher ";

$duration = $db->select($sql_qry);
while($record = $duration->fetch_array()){
  $total = $record['count'];
}


$sql_qry_due_debit="SELECT SUM(debit_amount) AS total_due_debit FROM due ";

$due_debit = $db->select($sql_qry_due_debit);
while($due_debits = $due_debit->fetch_array()){
  $total_due_debit = $due_debits['total_due_debit'];
}

$remain_credit = $credit_total + $total_due_credit;

$remain_debit  = $total - $total_due_debit;

$result = $remain_credit - $remain_debit;

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    function myFunction() {
      window.print();
    }
  </script>
</head>
<body>

<div class="container">

  <?php include '../navbar/navbar.php'; ?>      
  
  <p class="text-center"><button href="#" onclick="myFunction()" class="btn btn-info">Print</button></p>     
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Credit_Name</th>
        <th>Credit_Amount</th>
        <th>Debit_Name</th>
        <th>Date</th>
        <th>Debit_Description</th>
        <th>Debit_Amount</th>
        <th>Debit_Pay</th>
        <th>Debit_Due</th>
      </tr>
    </thead>

    
<?php  
/*$query = "SELECT credit.credit_name, credit.taka, debit.debit_name, debit.description, debit.cost, debit.pay, debit.due FROM credit RIGHT JOIN debit ON credit.id=debit.id ORDER BY debit.id";*/

$query = "SELECT credit_name, credit_amount, debit_name, debit_description, debit_cost, debit_pay, debit_due FROM vaucher";
$read = $db->select($query);
if ($read) 
{
  while ($row = $read->fetch_assoc()) 
  {
?>
	<tbody>
      <tr>
        <td><?php echo $row['credit_name']; ?></td>
        <td><?php echo $row['credit_amount']; ?></td>
        <td><?php echo $row['debit_name']; ?></td>
        <td><?php //echo $row['debit_name']; ?></td>
        <td><?php echo $row['debit_description']; ?></td>
        <td><?php echo $row['debit_cost']; ?></td>
        <td><?php echo $row['debit_pay']; ?></td>
        <td><?php echo $row['debit_due']; ?></td>
      </tr>
    </tbody>
<?php  

  }
}

?>
    

    <tbody>
		<tr>
		  <td>Total_Credits</td>
		  <td><?php echo $credit_total; ?></td>
		  <td></td>
		  <td></td>
		  <td>Total_Debits</td>
		  <td><?php echo $total; ?></td>
		  <td></td>
		  <td></td>
		</tr>
	</tbody>

<?php 

	$query = "SELECT credit_amount, debit_amount, debit_date FROM due";
	$show = $db->select($query);
	if ($show) 
	{
	  while ($rows = $show->fetch_assoc()) 
	  {
?>
    <tbody>
		<tr>
		  <td>Due_Credit(পূরব‌ের জে‌রঃ-)</td>
		  <td><?php echo $rows['credit_amount']; ?></td>
		  <td>Due_Date(পাওনা তারিখঃ-)</td>
		  <td><?php echo $rows['debit_date']; ?></td>
		  <td>Due_Debit(পূরব‌ের পাওনাঃ-)</td>
		  <td><?php echo $rows['debit_amount']; ?></td>
		  <td></td>
		  <td></td>
		</tr>
	</tbody>
<?php  

  }
}

?>	
    <tbody>
		<tr>
		  <td>Credits(ম‌োট জমাঃ-)</td>
		  <td><?php echo $remain_credit; ?></td>
		  <td></td>
		  <td></td>
		  <td>Debits(খরচ)</td>
		  <td><?php echo $remain_debit; ?></td>
		  <td></td>
		  <td></td>
		</tr>
	</tbody>
	<tbody>
	    <tr>
	      <td></td>
	      <td></td>
	      <td></td>
	      <td></td>
	      <td><!-- Total Remain --> জের / পাওনাঃ ( - )</td>
	      <td><?php echo $result; ?></td>
	      <td></td>
	      <td></td>
	    </tr>
	</tbody>
  </table>
</div>

</body>
</html>
