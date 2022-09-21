<?php 

require '../config/config.php';
require '../lib/database.php';
$db = new Database();

?>


<?php

if (isset($_POST['submit'])) 
{
  $credit_name        = $_POST['credit_name'];
  $credit_amount      = $_POST['credit_amount'];
  $debit_name         = $_POST['debit_name'];
  $debit_description  = $_POST['debit_description'];
  $rate               = $_POST['rate'];
  $pices              = $_POST['pices'];
  $total_debit_amount = $_POST['total_debit_amount'];
  $debit_pay          = $_POST['debit_pay'];
  $debit_due          = $_POST['debit_due'];


  if ($debit_name == '' || $debit_description == '') 
  {
    echo "<script>alert('Data is not inserted because Field was empty !')</script>";
    echo "<script>window.location.href = 'add_vaucher.php'</script>";
  }
  else
  {
    $query = "INSERT INTO vaucher(credit_name, credit_amount, debit_name, debit_description, rate, pices, debit_cost, debit_pay, debit_due)VALUES('$credit_name', '$credit_amount', '$debit_name', '$debit_description', '$rate', '$pices', '$total_debit_amount', '$debit_pay', '$debit_due')";
    $result = $db->insert($query);
    if ($result) 
    {
      echo "<script>alert('Data is inserted successfully !');</script>";
      echo "<script>window.location.href = 'add_vaucher.php'</script>";
    }
    else
    {
      echo "<script>alert('Data is not inserted !')</script>";
    }
  }
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
  <script>
      $(document).ready(function(){
          var i = 1;
          $('#add').click(function(){
              i++;
              $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="credit_name" class="form-control" size="100" /></td><td><input type="text" name="credit_amount" class="form-control" /></td><td><input type="text" name="debit_name" class="form-control" size="100" /></td><td><input type="text" name="debit_description" class="form-control" size="100" /></td><td><input type="text" name="rate" class="form-control" size="40" /></td><td><input type="text" name="pices" class="form-control" size="40" /></td><td><input type="text" name="total_debit_amount" class="form-control" /></td><td><input type="text" name="total_pay" class="form-control" /></td><td><input type="text" name="debit_pay" class="form-control" /></td><td><input type="text" name="debit_due" class="form-control" /></td><td><button type="button" name="add" id="add" class="btn btn-success">+</button></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');
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
      
      <form action="add_vaucher.php" method="POST">
        <table class="table table-bordered table-condensed" id="dynamic_field">
          <thead>
            <tr>
              <th>মারফোত নাম</th>
              <th>জমাঃ</th>
              <th>মারফোত নামঃ </th>
              <th>বিবরণ নামঃ</th>
              <th>দর</th>
              <th>জন</th>
              <th>মোট টাকাঃ-</th>
              <th>নগদ পরি‌ষদ</th>
              <th>জমা</th>
              <th>জের</th>
              <th>Add</th>
              <th>Remove</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" name="credit_name" class="form-control" size="100" /></td>
              <td><input type="text" name="credit_amount" class="form-control" /></td>
              <td><input type="text" name="debit_name" class="form-control" size="100" /></td>
              <td><input type="text" name="debit_description" class="form-control" size="100" /></td>
              <td><input type="text" name="rate" class="form-control" size="40" /></td>
              <td><input type="text" name="pices" class="form-control" size="40" /></td>
              <td><input type="text" name="total_debit_amount" class="form-control" /></td>
              <td><input type="text" name="total_pay" class="form-control" /></td>
              <td><input type="text" name="debit_pay" class="form-control" /></td>
              <td><input type="text" name="debit_due" class="form-control" /></td>
              <td><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
              <td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td>
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