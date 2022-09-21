<?php 

require '../config/config.php';
require '../lib/database.php';
$db = new Database();

?>

<!-- total calculation section -->

<?php 
$sql_qry="SELECT SUM(cost) AS count FROM debit ";

$duration = $db->select($sql_qry);
while($record = $duration->fetch_array()){
    $total = $record['count'];
}


$sql_qry="SELECT SUM(taka) AS total_credit FROM credit ";

$credit = $db->select($sql_qry);
while($credit_record = $credit->fetch_array()){
    $credit_total = $credit_record['total_credit'];
}


$sql_qry="SELECT SUM(taka) AS total_credit FROM credit ";

$credit = $db->select($sql_qry);
while($credit_record = $credit->fetch_array()){
    $credit_total = $credit_record['total_credit'];
}

$result = $credit_total - $total;

?>

<?php  


/*if (isset($_GET['del_id'])) 
{
  $visibility = 0;
  $del = $_GET['del_id'];
  $query = "DELETE FROM credit WHERE id = $del";
  $delete = $db->delete($query);
  if ($delete) {
    echo "<script>alert('Data Deleted Successfully!');</script>";
    echo "<script>window.location.href = 'view_credit.php'</script>";
  }
  else
  {
    echo "<script>alert('Failed to Delete Data!');</script>";
  }
}*/

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
  <h2 class="text-center">CSEA HSTU Student Management</h2>
  <p class="text-center">The table below contains a student information faculty of CSE university of Hajee Mohammad Danesh Science and Technology University Dinajpur 5200.</p>  
  <!-- <p class="text-center"><button onclick="window.location.href = 'add_credit.php';" class="btn btn-info">Add Credit</button></p>  -->         
  <p class="text-center"><button href="#" onclick="myFunction()" class="btn btn-info">Print</button></p>          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Credit_Name</th>
        <th>Credit_Amount</th>
        <th>Debit_Name</th>
        <th>Debit_Description</th>
        <th>Debit_Amount</th>
        <th>Debit_Pay</th>
        <th>Debit_Due</th>
      </tr>
    </thead>
    <tbody>
<?php  
$i = 0;
$query = "SELECT credit.credit_name, credit.taka, debit.debit_name, debit.description, debit.cost, debit.pay, debit.due FROM credit RIGHT JOIN debit ON credit.id=debit.id ORDER BY debit.id";
$read = $db->select($query);
if ($read) 
{
  while ($row = $read->fetch_assoc()) 
  {
    $i = $i+1; 
?>
      <tr>
        <td><?php echo $row['credit_name']; ?></td>
        <td><?php echo $row['taka']; ?></td>
        <td><?php echo $row['debit_name']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['cost']; ?></td>
        <td><?php echo $row['pay']; ?></td>
        <td><?php echo $row['due']; ?></td>
      </tr>
<?php  

  }
}

?>
    </tbody>
    <tbody>
    <tr>
      <td>Credits</td>
      <td><?php echo '= '.$credit_total ?></td>
      <td></td>
      <td>Debits</td>
      <td><?php echo '= '.$total ?></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
  <tbody>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td>Total Remain</td>
      <td><?php echo '= '.$result ?></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
  </table>
</div>

</body>
</html>
