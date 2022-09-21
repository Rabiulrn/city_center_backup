<?php
	session_start();
	if(!isset($_SESSION['username'])){
	  header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	$sucMsg = '';

	$rod_category_id = $_GET['rod_category_id'];
	

	if(isset($_POST['submit'])){
		$rod_c = trim($_POST['rod_category']);
		// var_dump($rod_c);

		$sql="UPDATE rod_category SET category_name = '$rod_c' WHERE id = '$rod_category_id'";

		if ($db->update($sql) === TRUE) {
		    $sucMsg = "Rod Category Updated Successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $db->error;
		}

		// $db->close();
		
	}
	if(isset($_GET['rod_category_id'])){
		$sql = "SELECT category_name FROM rod_category WHERE id = '$rod_category_id'";
		$result = $db->select($sql);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$category_name = $row['category_name'];
		}
		// var_dump($row['category_name']);
	}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Rod category Edit</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../css/voucher.css">

  


  <style type="text/css">
    .dateInput{
        line-height: 22px !important;
    }
    .allowText {
        float: right;
        margin-bottom: 3px;
    }
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
    }
    .table > thead > tr > th {
        border-bottom: 2px solid #ddd;
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd;
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

		<h3 class="text-center text-success"><?php echo $sucMsg; ?></h3>
		<div class="com_en_con">
			<!-- <h3 class="rod_header">Rod Category Entry</h3>
			<hr class="hrstyle"> -->
			<form action="" method="post" onsubmit = 'return valid()'>
			    <table class="table table-bordered table-condensed">
					<thead>
						<tr>
							<th>Rod Category Name:</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input type="text" name = "rod_category" class="form-control" id="rod_category" value="<?php echo $category_name;?>">
							</td>
						</tr>
					</tbody>
				</table>
				<input type="submit" name="submit" class="btn btn-block btn-primary" value="Update">
			</form>
		</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		function valid(){
			validReturn = false;
			var rod_category = $('#rod_category').val();
			// alert(rod_category);
			if(rod_category == ''){
				alert('Rod Category cant be empty !');
				$('#rod_category').focus();
				validReturn = false;
			} else if($.isNumeric(rod_category)){
				alert('Rod Category cant be Number !');
				$('#rod_category').focus();
				validReturn = false;
			} else{
				validReturn = true;
			}

			if(validReturn){
				return true;
			} else{
				return false;
			}
		}
	</script>
</body>
</html>