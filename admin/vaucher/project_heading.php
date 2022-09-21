<?php 
session_start();
require '../config/config.php';
require '../lib/database.php';

$db = new Database();


$sucMsg = '';
$errMsg = '';
if(isset($_POST['update']))
{
  $heading = $_POST['heading'];
  $subheading = $_POST['subheading'];
  $project_heading_edit = $_GET['project_heading_edit_id'];
  $query = "UPDATE project_heading SET heading='$heading', subheading='$subheading' WHERE id = $project_heading_edit";
  $update = $db->update($query);
  if ($update) 
  {
    // echo "<script>alert('Data Updated Successfully!');</script>";    
    $sucMsg = 'Data Updated Successfully!';
    // echo "<script>window.location.href = 'modify_vaucher.php'</script>";
  }
  else
  {
    // echo "<script>alert('Failed to Update Data!');</script>";
    $errMsg = 'Failed to Update Data !';
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Project Heading</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
    }
    .table > thead > tr > th {
        border-bottom: 2px solid #ddd;
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd;
    }
    .backcircle{
        font-size: 18px;
        position: absolute;
        margin-top: -35px;
    }
    .backcircle a:hover{
        text-decoration: none !important;
    }
  </style>
</head>
<body>
  <?php
    include '../navbar/header_text.php';
    include '../navbar/navbar.php';    
  ?> 
  <div class="container">
    <?php 
      $ph_id = $_SESSION['project_name_id'];
      $query = "SELECT * FROM project_heading WHERE id = $ph_id";
      $show = $db->select($query);
      if ($show) 
      {
        while ($rows = $show->fetch_assoc()) 
        {
    ?>
    <div class="project_heading text-center">      
      <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
      <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
    </div>
  <?php 
        }
      } 
  ?>
  <div class="backcircle">
      <a href="../vaucher/modify_vaucher.php">
        <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
      </a>
  </div>
	<form method="POST" onsubmit="return validation()">
		<table class="table table-bordered">
		<?php  
			$project_heading_edit = $_GET['project_heading_edit_id'];
			$query = "SELECT * FROM project_heading WHERE id = $project_heading_edit";
			$show = $db->select($query);
			while($data = $show->fetch_assoc())
			{
		?>
			<thead>
	          <tr>
	            <th><input type="text" name="heading" class="form-control" value="<?php echo $data['heading']; ?>" id = "heading" placeholder="প্রতিষ্ঠানের নাম..."/></th>
	          </tr>
	          <tr>
	            <th><input type="text" name="subheading" class="form-control" value="<?php echo $data['subheading']; ?>" id = "subheading" placeholder="কাজের বিবরন..."/></th>
	          </tr>
	        </thead>
	    <?php } ?>
      	</table>
        <div class="form-group">
	        <input type="submit" class="form-control btn btn-primary" name="update" value="UPDATE">
	      </div>
        <div class="form-group">
          <h2 class="text-center text-success" id='sucMsg'><?php echo $sucMsg; ?></h2>
          <h2 class="text-center text-danger"><?php echo $errMsg; ?></h2>
        </div>
	</form>
</div>
<script type="text/javascript">
      function validation(){
          validReturn = false;

          var heading   = $('#heading').val();
          var subheading = $('#subheading').val();
          // alert(heading +" | "+ subheading);
          if(heading == ""){
              alert("প্রতিষ্ঠানের নাম ফাঁকা হবে না !");
              $('#heading').focus();
              validReturn = false;
          } else if(heading.length > 40){
              alert("প্রতিষ্ঠানের নাম ৪০ অক্ষরের বেশী হবে না !");
              $('#heading').focus();
              validReturn = false;
          } else if($.isNumeric(heading)){
              alert("প্রতিষ্ঠানের নাম সংখ্যা হতে পারে না !");
              $('#heading').focus();
              validReturn = false;
          } else {
            if(subheading == ""){
                  alert("কাজের বিবরন ফাঁকা হবে না !");
                  $('#subheading').focus();
                  validReturn = false;
              }else if(subheading.length > 40){
                  alert("কাজের বিবরন ৪০ অক্ষরের বেশী হবে না !");
                  $('#subheading').focus();
                  validReturn = false;
              } else if($.isNumeric(subheading)){
                  alert("কাজের বিবরন সংখ্যা হতে পারে না !");
                  $('#subheading').focus();
                  validReturn = false;
              } else {
                validReturn = true;
              }
          }

          if(validReturn){
              return true;
          }else{
              return false;
          }
      }





      if($('#sucMsg').html() === 'Data Updated Successfully!'){
        var delay = 1500;
        setTimeout(function() {
            window.location.href = 'modify_vaucher.php';
        }, delay);
        
      } else{}


  </script>
</body>
</html>