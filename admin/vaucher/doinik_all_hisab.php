<?php 
	// phpinfo();
	session_start();
	if(!isset($_SESSION['username']) ){    
	    header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$_SESSION['pageName'] = '';
	$project_name_id = $_SESSION['project_name_id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>দৈনিক হিসাব</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
	<link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">

	<script src="../js/jquery-printme.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
	<style type="text/css">
		
		
	</style>
</head>
<body>
	<?php
	    include '../navbar/header_text.php';
	    $page ='doinik_all_hisab';
	    include '../navbar/navbar.php';
	?> 
	<!-- <div class="container" id="">		
	  	<div class="backcircleNew">
	      <a href="../vaucher/home.php">
	        <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
	      </a>
	    </div>
	</div> -->
	<div class="bar_con">
  		<div class="left_side_bar">  			
	  		<?php require '../others_page/left_menu_bar.php'; ?>
	  	</div>

	  	<div class="main_bar">
	  		<?php
				$ph_id = $_SESSION['project_name_id'];

				$query = "SELECT * FROM project_heading WHERE id = $ph_id";
				$show = $db->select($query);
				if ($show) {
					while ($rows = $show->fetch_assoc()) {
	    				?>
					    <div class="project_heading" >      
					    	<h2 class="headingOfAllProject text-center"><?php echo $rows['heading']; ?></h2>
					    </div>
		  				<?php 
		        	}
		      	} 
		  	?>
	  		<div class="wraper_con">
	  			<div class="wraper_head">
	  				দৈনিক হিসাব
	  			</div>
				  <?php 
				 //echo $ph_id; 
				  ?>
	  			<div class="wraper_content">
	  				<p class="tiny_text">Please click on the appropriate icon below in order to access information about shah enterprise.</p>

	  				<?php
	  					if($_SESSION['protidiner_hisab'] == 'yes'){
	  						?>
			  				<div class="pannel_con" >
			  					<a href="../vaucher/index.php">
			  						<h4 class="pannel_head" style="background-color: #004A95;">
			  							<img src="../img/logo/summary_square.png" alt="logo" class="img_pannel">
			  							প্রতিদিনের হিসাব
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/summary.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
	  						<?php
	  					}
	  					if($_SESSION['modify_data'] == 'yes'){
							?>
			  				<div class="pannel_con">
			  					<a href="../vaucher/modify_vaucher.php">
			  						<h4 class="pannel_head" style="background-color: red;">
			  							<img src="../img/logo/modify2_square.png" alt="logo" class="img_pannel">
			  							মডিফাই ডাটা
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/modify2.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot" style="color: red;">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
	  						<?php
	  					}	  				
	  					if($_SESSION['joma_khat'] == 'yes'){
	  						?>
			  				<div class="pannel_con">
			  					<a href="../vaucher/add_vaucher_credit.php">
			  						<h4 class="pannel_head" style="background-color: #008EB9;">
			  							<img src="../img/logo/newentry_square.png" alt="logo" class="img_pannel">
			  							জমা খাত এন্ট্রি
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/newentry.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot" style="color: #008EB9;">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
	  						<?php
	  					}
						if($_SESSION['khoros_khat'] == 'yes'){
							?>
			  				<div class="pannel_con">
			  					<a href="../vaucher/add_vaucher_group.php">
			  						<h4 class="pannel_head" style="background-color: #7A0298;">
			  							<img src="../img/logo/khoros_square.png" alt="logo" class="img_pannel">
			  							খরচ খাতের হেডার
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/khoros.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot" style="color: #7A0298;">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
			  				<?php
			  			}
			  			if($_SESSION['khoros_khat_entry'] == 'yes'){
							?>
			  				<div class="pannel_con">
			  					<a href="../vaucher/add_vaucher_data_by_search.php">
			  						<h4 class="pannel_head" style="background-color: #000;">
			  							<img src="../img/logo/khoros_entry_square.png" alt="logo" class="img_pannel">
			  							খরচ খাত এন্ট্রি
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/khoros_entry.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot" style="color: #000;">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
			  				<?php
			  			}
						if($_SESSION['nije_pabo'] == 'yes'){
							?>
			  				<div class="pannel_con">
			  					<a href="../vaucher/nij_paonadar_add.php">
			  						<h4 class="pannel_head" style="background-color: #CC3E00;">
			  							<img src="../img/logo/nijepabo_square.png" alt="logo" class="img_pannel">
			  							নিজে পাবো এন্ট্রি
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/nijepabo.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot" style="color: #CC3E00;">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
	  						<?php
	  					}
						if($_SESSION['paonader'] == 'yes'){
							?>
			  				<div class="pannel_con">
			  					<a href="../vaucher/jara_pabe_add.php">
			  						<h4 class="pannel_head" style="background-color: #D2007C;">
			  							<img src="../img/logo/paonader_square.png" alt="logo" class="img_pannel">
			  							পাওনাদার এন্ট্রি
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/paonader.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot" style="color: #D2007C;">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
	  						<?php
	  					}
	  					if($_SESSION['report'] == 'yes'){
							?>
			  				<div class="pannel_con">
			  					<a href="../vaucher/report_joma.php">
			  						<h4 class="pannel_head" style="background-color: #00AB00;">
			  							<img src="../img/logo/report_square.png" alt="logo" class="img_pannel">
			  							রিপোর্ট
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/report.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot" style="color: #00AB00;">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
			  				<?php
	  					}
	  					if($_SESSION['agrim_hisab'] == 'yes'){
							?>
			  				<div class="pannel_con">
			  					<a href="../vaucher/agrim_hisab.php">
			  						<h4 class="pannel_head" style="background-color: #4A04E6;">
			  							<img src="../img/logo/payment-icon_square.png" alt="logo" class="img_pannel">
			  							অগ্রিম হিসাব
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/payment-icon.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot" style="color: #4A04E6;">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
			  				<?php
	  					}
	  					if($_SESSION['cash_calculator'] == 'yes'){
							?>
			  				<div class="pannel_con">
			  					<a href="../vaucher/cash_calculator.php">
			  						<h4 class="pannel_head" style="background-color: #00FFBF;">
			  							<img src="../img/logo/calc.png" alt="logo" class="img_pannel">
			  							ক্যাশ ক্যালকুলেটর
			  						</h4>
			  						<!-- <p class="img_pannel_con">
			  							<img src="../img/logo/calc.png" alt="logo" class="img_pannel">
			  						</p> -->
			  						<p class="pannel_foot" style="color: #00FFBF;">
			  							Click here
			  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
			  						</p>
			  					</a>	  					
			  				</div>
			  				<?php
	  					}
							?>
	  			</div>
	  			
	  		</div>
	  	</div>
  	</div>

  	<script type="text/javascript">
		var left_side_bar = $('.left_side_bar').height();
		var main_bar = $('.main_bar').outerHeight();
		if(left_side_bar < main_bar){
			$('.left_side_bar').height(main_bar);
		}
		var left_height = $('.left_side_bar').height();
		if (left_height < 510){
			$('.left_side_bar').height(510);
		}  		
  	</script>
  	<script src="../js/common_js.js"> </script>
</body>
</html>