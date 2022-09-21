<?php 

require '../config/config.php';
require '../lib/database.php';
$db = new Database();

?>


<?php  
$query = "SELECT id FROM debit_group_data";
$read = $db->select($query);
if ($read) 
{
  while ($row = $read->fetch_assoc()) 
  {
    $id = $row['id'];
  }
}

?>

<?php  

if (isset($_GET['del_id'])) 
{
  $visibility = 0;
  $del = $_GET['del_id'];
  $query = "DELETE FROM debit_group WHERE id = $del";
  $delete = $db->delete($query);
  if ($delete) {
    echo "<script>alert('Data Deleted Successfully!');</script>";
    echo "<script>window.location.href = 'add_vaucher_group_data.php'</script>";
  }
  else
  {
    echo "<script>alert('Failed to Delete Data!');</script>";
  }
}

?>


<?php 

$qry = "UPDATE debit_group_data SET group_total_taka = group_taka * group_pices";
$result = $db->update($qry);

$add_id = $_GET['add_id'];
$sql_qry_debit_due="SELECT SUM(group_total_taka) AS debit_due FROM debit_group_data WHERE group_id =$add_id";
$duration_debit_due = $db->select($sql_qry_debit_due);
while($record_debit_due = $duration_debit_due->fetch_array()){
  $total_debit_due = $record_debit_due['debit_due'];
}


?>


<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- add remove field script -->
  <script>
      $(document).ready(function(){
          var i = 1;
          $('#add').click(function(){
              i++;
              $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="group_name" class="form-control" size="100" /></td><td><input type="text" name="group_description" class="form-control" size="100" /></td><td><input type="text" name="taka" class="form-control" size="40" /></td><td><input type="text" name="pices" class="form-control" size="40" /></td><td><input type="text" name="total_taka" class="form-control" /></td><td><input type="text" name="total_bill" class="form-control" /></td><td><input type="text" name="pay" class="form-control" /></td><td><input type="text" name="due" class="form-control" /></td><td><button type="button" name="add" id="add" class="btn btn-success">+</button></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');
          });

          $(document).on('click','.btn_remove', function(){
              var button_id = $(this).attr("id");
              $("#row"+button_id+"").remove();
          });
      });
  </script>
</head>
<body>
    <div class="container">

      <?php include '../navbar/navbar.php'; ?>  
      
      <form action="#" method="POST">
        <table class="table table-bordered table-condensed" id="dynamic_field">
          
<?php  
$i = 0;
$query = "SELECT * FROM debit_group";
$read = $db->select($query);
if ($read) 
{
  while ($row = $read->fetch_assoc()) 
  {
    $i = $i+1; 
?>
    <thead>
      <tr>
        <th><?php echo $row['group_name']; ?></th>
        <th><?php echo $row['group_description']; ?></th>
        <th><?php echo $row['taka']; ?></th>
        <th><?php echo $row['pices']; ?></th>
        <th><?php echo $row['total_taka']; ?></th>
        <th><?php echo $row['total_bill']; ?></th>
        <th><?php echo $row['pay']; ?></th>
        <th><?php echo $row['due']; ?></th>
        <td>
          <a href="add_vaucher_group_data.php?del_id=<?php echo $row['id']; ?>" class="btn btn-danger">-</a> 
        </td>
        <td>
          <a href="add_vaucher_group_data.php?add_id=<?php echo $row['id']; ?>" class="btn btn-success">Data</button>
        </td>
      </tr>
    </thead>
<?php  

  }
}

?>



<?php  

$add_id = $_GET['add_id'];
$query = "SELECT * FROM debit_group WHERE id = $add_id";
$read = $db->select($query);
if ($read) 
{
  while ($row = $read->fetch_assoc()) 
  {
?>
    <thead>
      <tr>
        <th><?php echo $row['group_name']; ?></th>
        <th><?php echo $row['group_description']; ?></th>
        <th><?php echo $row['taka']; ?></th>
        <th><?php echo $row['pices']; ?></th>
        <th><?php echo $row['total_taka']; ?></th>
        <th><?php echo $row['total_bill']; ?></th>
        <th><?php echo $row['pay']; ?></th>
        <th><?php echo $row['due']; ?></th>
        <td>Del</td>
        <td>Edit</td>
      </tr>
    </thead>
<?php  

  }
}

?>





<!-- view debit group data from database -->
<?php  
$add_id = $_GET['add_id'];
$query = "SELECT * FROM debit_group_data WHERE group_id = $add_id";
$read = $db->select($query);
if ($read) 
{
  while ($row = $read->fetch_assoc()) 
  {
?>



    <thead>
      <tr>
        <th><?php echo $row['group_name']; ?></th>
        <th><?php echo $row['group_description']; ?></th>
        <th><?php echo $row['group_taka']; ?></th>
        <th><?php echo $row['group_pices']; ?></th>
        <th><?php echo $row['group_taka'] * $row['group_pices']; ?></th>
        <th><?php //echo $total_debit_due; ?></th>
        <th><?php echo $row['group_pay']; ?></th>
        <th><?php echo $row['group_due']; ?></th>
        <td>
          <a href="view.php?del_id=<?php echo $row['id']; ?>" class="btn btn-danger">-</a> 
        </td>
        <td>
          <button onclick="window.location.href = 'update_single_group_data.php?edit_id=<?php echo $row['id']; ?>';" class="btn btn-success">Update</button>
        </td>
      </tr>
    </thead>
<?php  

  }
}

?>

<thead>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th><?php echo $total_debit_due; ?></th>
        <th></th>
        <th></th>
      </tr>
    </thead>



          <tbody>
            <tr>
              <td><input type="text" name="group_name" class="form-control" size="100" /></td>
              <td><input type="text" name="group_description" class="form-control" size="100" /></td>
              <td><input type="text" name="taka" class="form-control" size="40" /></td>
              <td><input type="text" name="pices" class="form-control" size="40" /></td>
              <td><input type="text" name="total_taka" class="form-control" /></td>
              <td><input type="text" name="total_bill" class="form-control" /></td>
              <td><input type="text" name="pay" class="form-control" /></td>
              <td><input type="text" name="due" class="form-control" /></td>
              <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
              <td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td>
            </tr>
          </tbody>
        </table>
        <div class="form-group">
          <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit">
        </div>




          
        </table>
      </form>   
    </div>
    
</body>
</html>



<!-- insert data to table debit_group_data -->
<?php

$total_taka_calculation = 0;
$add_id = $_GET['add_id'];


if (isset($_POST['submit'])) 
{
  $group_name        = $_POST['group_name'];
  $group_description = $_POST['group_description'];
  $taka              = $_POST['taka'];
  $pices             = $_POST['pices'];
  $total_taka        = $_POST['total_taka'];
  $total_bill        = $_POST['total_bill'];
  $pay               = $_POST['pay'];
  $due               = $_POST['due'];


  if ($taka == '' || $pices == '') 
  {
    echo "<script>alert('Data is not inserted because Field was empty !')</script>";
    echo "<script>window.location.href = 'add_vaucher_group_data.php?add_id=$add_id'</script>";
  }
  else
  {
    $query = "INSERT INTO debit_group_data(group_name, group_description, group_taka, group_pices, group_total_taka, group_total_bill, group_pay, group_due, group_id)VALUES('$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$total_bill', '$pay', '$due', $add_id)";
    $result = $db->insert($query);
    if ($result) 
    {
      echo "<script>alert('Data is inserted successfully !');</script>";
      echo "<script>window.location.href = 'add_vaucher_group_data.php?add_id=$add_id'</script>";
    }
    else
    {
      echo "<script>alert('Data is not inserted !')</script>";
    }
  }
}

?>


<?php 
$qry = "UPDATE debit_group_data SET group_total_taka = group_taka * group_pices";
$result = $db->update($qry);

$add_id = $_GET['add_id'];
$sql_qry_debit_due="SELECT SUM(group_total_taka) AS debit_due FROM debit_group_data WHERE group_id =$add_id";
$duration_debit_due = $db->select($sql_qry_debit_due);
while($record_debit_due = $duration_debit_due->fetch_array()){
  $total_debit_due = $record_debit_due['debit_due'];
}

?>


<!-- delete data part -->
<?php  

if (isset($_GET['del_id'])) 
{
  $visibility = 0;
  $del = $_GET['del_id'];
  $query = "DELETE FROM debit_group WHERE id = $del";
  $delete = $db->delete($query);
  if ($delete) {
    echo "<script>alert('Data Deleted Successfully!');</script>";
    echo "<script>window.location.href = 'add_vaucher_group_data.php'</script>";
  }
  else
  {
    echo "<script>alert('Failed to Delete Data!');</script>";
  }
}

?>
