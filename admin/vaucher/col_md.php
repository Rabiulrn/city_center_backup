<?php 

require '../config/config.php';
require '../lib/database.php';
$db = new Database();

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
  <!-- add remove field script -->
  <script>
      $(document).ready(function(){
          var i = 1;
          $('#add').click(function(){
              i++;
              $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="group_name" class="form-control" size="100" /></td><td><input type="text" name="group_name" class="form-control" size="100" /></td><td><button type="button" name="add" id="add" class="btn btn-success">+</button></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');
          });

          $(document).on('click','.btn_remove', function(){
              var button_id = $(this).attr("id");
              $("#row"+button_id+"").remove();
          });
      });
  </script>
  <script>
    function myFunction() {
      window.print();
    }
  </script>
  <style type="text/css">
    #borderless-cell { border: 1px solid Transparent!important; }
    #noborders {border: none!important;}
    .padding{padding: 20px!important;}
  </style>
</head>
<body>
  <div class="col-md-6">   
    <table class="table table-bordered">
      <thead id="noborders">
        <tr>
          <th>নাম</th>
          <th>বিবরণ</th>
          <th>টাকাঃ</th>
        </tr>
      </thead>
  <?php  
    $nij_paonadar_query = "SELECT * FROM nij_paonadar";
    $nij_paonadar_read = $db->select($nij_paonadar_query);
    if ($nij_paonadar_read) 
    {
      while ($nij_paonadar_row = $nij_paonadar_read->fetch_assoc()) 
      {
  ?>
      <tbody id="noborders">
        <tr>
          <td><?php echo $nij_paonadar_row['name'] ?></td>
          <td><?php echo $nij_paonadar_row['description'] ?></td>
          <td><?php echo $nij_paonadar_row['amount'] ?></td>
          <td id="noborders">
            <a href="modify_vaucher.php?delete_id=<?php echo $nij_paonadar_row['id']; ?>" class="btn btn-danger">-</a> 
          </td>
        </tr>
      </tbody>
  <?php  
      }
    }
  ?>
    </table>
  </div>
  <div class="col-md-6">   
    <table class="table table-bordered">
      <thead id="noborders">
        <tr>
          <th>নাম</th>
          <th>বিবরণ</th>
          <th>টাকাঃ</th>
        </tr>
      </thead>
  <?php  
    $jara_pabe_query = "SELECT * FROM jara_pabe";
    $jara_pabe_read = $db->select($jara_pabe_query);
    if ($jara_pabe_read) 
    {
      while ($jara_pabe_row = $jara_pabe_read->fetch_assoc()) 
      {
  ?>
      <tbody id="noborders">
        <tr>
          <td><?php echo $jara_pabe_row['pabe_name'] ?></td>
          <td><?php echo $jara_pabe_row['pabe_description'] ?></td>
          <td><?php echo $jara_pabe_row['pabe_amount'] ?></td>
          <td id="noborders">
            <a href="modify_vaucher.php?del_id=<?php echo $jara_pabe_row['pabe_id']; ?>" class="btn btn-danger">-</a> 
          </td>
        </tr>
      </tbody>
  <?php  
      }
    }
  ?>
    </table>
  </div>
</body>
</html>