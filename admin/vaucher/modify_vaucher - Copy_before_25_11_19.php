<?php 

require '../config/config.php';
require '../lib/database.php';
$db = new Database();
?>

<?php

if (isset($_POST['submit'])) 
{
  $due_credit_amount  = $_POST['due_credit_amount'];
  $due_debit_amount   = $_POST['due_debit_amount'];
  $due_debit_date     = $_POST['due_debit_date'];

  if ($due_credit_amount == '' || $due_debit_amount == '') 
  {
    echo "<script>alert('Data is not inserted because Field was empty !')</script>";
    echo "<script>window.location.href = 'modify_vaucher.php'</script>";
  }
  else
  {
    $query = "INSERT INTO due(due_credit_amount, due_debit_amount, due_debit_date)VALUES('$due_credit_amount', '$due_debit_amount', '$due_debit_date')";
    $result = $db->insert($query);
    if ($result) 
    {
      echo "<script>alert('Data is inserted successfully !');</script>";
      echo "<script>window.location.href = 'print_vaucher.php'</script>";
    }
    else
    {
      echo "<script>alert('Data is not inserted !')</script>";
    }
  }
}

?>



<!-- total calculation section -->

<?php 
$sql_qry="SELECT SUM(debit_cost) AS count FROM vaucher ";

$duration = $db->select($sql_qry);
while($record = $duration->fetch_array()){
  $total = $record['count'];
}


$sql_qrys="SELECT SUM(credit_amount) AS total_credit FROM vaucher_credit ";

$credit = $db->select($sql_qrys);
while($credit_record = $credit->fetch_array()){
  $credit_total = $credit_record['total_credit'];
}

$result = $credit_total - $total;

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

  <form action="#" method="POST">         
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Credit_Name</th>
          <th>Credit_Amount</th>
          <th>Debit_Name</th>
          <th>Debit_Description</th>
          <th>Debit_Rate</th>
          <th>Debit_Pices</th>
          <th>Debit_Amount</th>
          <th>Debit_Pay</th>
          <th>Debit_Due</th>
        </tr>
      </thead>
      <tbody>
  <?php 
  
  $query = "SELECT vaucher_credit.credit_name, vaucher_credit.credit_amount, vaucher.debit_name, vaucher.debit_description, vaucher.debit_cost, vaucher.debit_pay, vaucher.debit_due FROM vaucher_credit RIGHT JOIN vaucher ON vaucher_credit.id=vaucher.id ORDER BY vaucher.id";
  $read = $db->select($query);
  if ($read) 
  {
    while ($row = $read->fetch_assoc()) 
    {
  ?>
        <tr>
          <td><?php echo $row['credit_name']; ?></td>
          <td><?php echo $row['credit_amount']; ?></td>
          <td><?php echo $row['debit_name']; ?></td>
          <td><?php echo $row['debit_description']; ?></td>
          <td><?php //echo $row['debit_description']; ?></td>
          <td><?php //echo $row['debit_description']; ?></td>
          <td><?php echo $row['debit_cost']; ?></td>
          <td><?php echo $row['debit_pay']; ?></td>
          <td><?php echo $row['debit_due']; ?></td>
        </tr>
  <?php  

    }
  }

  ?>
  <?php 

  $query = "SELECT * FROM debit_group_data ORDER BY group_id";
  $read = $db->select($query);
  if ($read) 
  {
    while ($row = $read->fetch_assoc()) 
    {
  ?>
        <tr>
          <td></td>
          <td></td>
          <td><?php echo $row['group_name']; ?></td>
          <td><?php echo $row['group_description']; ?></td>
          <td><?php echo $row['group_taka']; ?></td>
          <td><?php //echo $row['debit_description']; ?></td>
          <td><?php //echo $row['debit_description']; ?></td>
          <td><?php echo $row['group_pices']; ?></td>
          <td><?php echo $row['group_total_taka']; ?></td>
          <td><?php echo $row['group_total_bill']; ?></td>
          <td><?php echo $row['group_pay']; ?></td>
        </tr>
  <?php  

    }
  }

  ?>
      </tbody>
      <tbody>
        <tr>
          <td>Credits</td>
          <td><?php echo $credit_total; ?></td>
          <td></td>
          <td></td>
          <td></td>
          <td>Debits</td>
          <td><?php echo $total; ?></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
      <tbody>
        <tr>
          <td>Due_Credits(পূবের জে‌রঃ-)</td>
          <td><input type="text" name="due_credit_amount" class="form-control" /></td>
          <td></td>
          <td>Debit_Date(পাওনা তারিখঃ-)</td>
          <td><input type="date" name="due_debit_date" class="form-control" /></td>
          <td>Due_Debits(পূরব‌ের পাওনাঃ-)</td>
          <td><input type="text" name="due_debit_amount" class="form-control" /></td>
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
          <td></td>
          <td>Total Remain</td>
          <td><?php echo $result; ?></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
    <div class="form-group">
      <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit">
    </div>
  </form>
</div>

</body>
</html>