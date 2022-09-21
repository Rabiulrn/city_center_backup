<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:../index.php'); 
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	

	if (isset($_POST['project'])){
		$projectName = $_POST['projectName'];
		// $_SESSION['project_name_id']  = $row['project_name_id'];
		$_SESSION['project_name_id']  = $projectName;
		header('location: ../vaucher/doinik_all_hisab.php');

	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css"> -->
  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>


<style>
  	.sldrStyle{
  		border: 5px solid #ddd;
  		-moz-box-shadow: 0 4px 4px rgba(0, 0, 0, 0.4);
  		-webkit-box-shadow: 0 4px 4px rgba(0, 0, 0, 0.4);
  		box-shadow: 0 4px 4px rgba(0, 0, 0, 0.4);  		
  	}
  	.carousel-inner{
  		height: -moz-calc(100% - 20%);
	    height: -webkit-calc(100% - (20px + 30px));
	    height: calc(100% - (20px + 30px));
  	}
  	/*@keyframes example {
	  from {margin-top: -50px; color: red;}
	  to { margin-top: 20px; color: green;}
	}*/
</style>

  <script></script>

</head>
<body>
    <?php
      include '../navbar/header_text.php';
      $page = 'home';
      include '../navbar/navbar.php';
    ?>
    <div class="container-fluid" style="margin-bottom: 50px; padding: 0px; margin-top: 50px;">
    	<!-- <div id="myCarousel" class="carousel slide sldrStyle" data-ride="carousel" style="">
		    <ol class="carousel-indicators">
		      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		      <li data-target="#myCarousel" data-slide-to="1"></li>
		      <li data-target="#myCarousel" data-slide-to="2"></li>
		      <li data-target="#myCarousel" data-slide-to="3"></li>
		      <li data-target="#myCarousel" data-slide-to="4"></li>
		    </ol>

		    <div class="carousel-inner">
		      <div class="item active">
		        <img src="../img/slider/111.jpg" alt="Los Angeles" style="width:100%; height: 100%;">
		      </div>

		      <div class="item">
		        <img src="../img/slider/222.jpg" alt="Chicago" style="width:100%;">
		      </div>
		    
		      <div class="item">
		        <img src="../img/slider/333.jpg" alt="New york" style="width:100%;">
		      </div>
		      <div class="item">
		        <img src="../img/slider/444.jpg" alt="New york" style="width:100%;">
		      </div>
		      <div class="item">
		        <img src="../img/slider/555.jpg" alt="New york" style="width:100%;">
		      </div>
		    </div>

		    
		    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
		      <span class="glyphicon glyphicon-chevron-left" style="font-size: 80px;"></span>
		      <span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#myCarousel" data-slide="next">
		      <span class="glyphicon glyphicon-chevron-right" style="font-size: 80px;"></span>
		      <span class="sr-only">Next</span>
		    </a>
	  	</div> -->

	  	<br>
	  	<h1 class="text-center text-success welcome" style="font-size: 60px; font-weight: bold; animation-duration: 1.8s;">স্বাগতম, মেসার্স শাহ এন্টারপ্রাইজ</h1>
	  	
	  	

		<div class="" style="text-align: center; font-size: 24px; height: 40px;">
			<form method="post" action="" onsubmit="return checkProject()">
				Select your project name:
				<select id="prjectName" name="projectName" class="form-control" style="display: inline-block; width: 270px;">
					<option value="0">Select one...</option>
					<?php
						$sql 	= "SELECT id, heading FROM project_heading";
						$rslt 	= $db->select($sql);
						while($row = $rslt->fetch_array()){
							$username 		= $_SESSION['username'];
							$sqlproject 	= "SELECT project_name_id FROM login WHERE username = '$username'";
							$rsltproject 	= $db->select($sqlproject);
							$row2 			= $rsltproject->fetch_array();
							$projectIdFromDb= $row2['project_name_id'];
							$pid_explode 	= explode(",", $projectIdFromDb);

							for($i=0; $i < count($pid_explode); $i++){
								// echo $pid_explode[$i];
								if($row['id'] == $pid_explode[$i]){
									echo "<option value='".$row['id']."'>".$row['heading']."</option>";
								}
							}
						}

					?>
				</select>
				<input type="submit" name="project" value="Submit" class="btn btn-success" style="width: 200px; font-weight: bold;">
				<h4 id="sucMsg" class="text-danger"></h4>
			</form>
		</div>



	  	<div id="line" style="height: 4px; background-color: #ddd; width: 50%; margin-left: 25%;margin-top: 12px;"></div>
	  	<div style="height: 20px; width: 20px; border-radius: 50%; border: 4px solid #ddd; margin-left: calc(50% - 10px); margin-top: -12px; background-color: #fff"></div>

	  	<p class="text-center vv" style="margin:10px 0px;"><img src="../img/others/colorAlponaImg.jpg" style="width: 30%; animation-duration: 1s;"></p>

	</div>
	<script type="text/javascript">
		const element =  document.querySelector('.welcome');
		element.classList.add('animated', 'zoomIn');

		const vv =  document.querySelector('.vv');
		vv.classList.add('animated', 'fadeInDown');
	</script>
	<script type="text/javascript">
		function checkProject(){
			var valid = false;
			var project_value = $('#prjectName option:selected').val();
			
			if(project_value == '0'){
				// alert(project_value);
				$('#sucMsg').html('Please Select Your project !');
				$('#line').css({'margin-top': '34px'});
				valid = false;
			} else {
				valid = true;
			}
			
			if(valid){
				return true;
			} else {
				return false;
			}
		}
	</script>
	<script type="text/javascript">
		var session_project_name_id = "<?php echo $_SESSION['project_name_id']; ?>";
		// alert(session_project_name_id);
		// $('#prjectName select').val(session_project_name_id).change();
		$("#prjectName option[value=" + session_project_name_id +"]").prop('selected', true);
	</script>
</body>
</html>