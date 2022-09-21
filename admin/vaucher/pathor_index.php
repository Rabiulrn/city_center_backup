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
	<title>পাথর হিসাব</title>
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
		
		.boxcon{
			/*border: 1px solid red;*/
		}
		.boxmain{
			border: 2px solid #ff8b8b;
			border-radius: 5px;
			background-color: #f9e2e2;
			width: 90%;
			position: relative;
			left: 50%;
			margin: 30px 0px 30px -45%;	
			height: 215px;
			/*padding: 30px;*/
			transition: all .5s;
		}
		.boxmain:hover{
			box-shadow: 0px 0px 30px #040;
			transition: all .5s;
		}
		.pageheader{
			margin-top: 0px;
			text-align: center;
			background-color: red;
			border-radius: 4px 4px 0px 0px;
			padding: 10px;
			background-color: #ffb6b6;
			border-bottom: 2px solid #ff8b8b;
		}
		a:hover{
			text-decoration: none;
		}
		.inner{
			font-size: 16px;
			margin: 0px 20px;
		}
	</style>
</head>
<body>
	<?php
	    include '../navbar/header_text.php';
	    $page ='pathor_hisab';
	    include '../navbar/navbar.php';
	?> 
	<div class="container" id="">
	</div>

	<div class="bar_con">
  		<div class="left_side_bar">  			
	  		<?php require '../others_page/left_menu_bar_pathor_hisab.php'; ?>
	  	</div>
	  	<div class="main_bar">
	  		<?php
                $ph_id = $_SESSION['project_name_id'];
                $query = "SELECT * FROM project_heading WHERE id = $ph_id";
                $show = $db->select($query);
                if ($show) {
                    while ($rows = $show->fetch_assoc()) {
                ?>
                    <div class="project_heading">      
                        <h2 class="headingOfAllProject">
                            <?php echo $rows['heading']; ?>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                        </h2>
                    </div>
                <?php 
                    }
                } 
            ?>
	  		<div class="wraper_con">
	  			<div class="wraper_head">
				  পাথর হিসাব
	  			</div>
	  			<div class="wraper_content">
	  				<p class="tiny_text">Please click on the appropriate icon below in order to access information about shah enterprise.</p>
	  					 <?php
	  						if($_SESSION['pathor_kroy_hisab'] == 'yes'){
        						?>
			  					<div class="pannel_con" >
				  					<a href="../vaucher/pathor_details_entry.php">
				  						<h5 class="pannel_head" style="background-color: #D2007C;">
				  							<img src="../img/logo/add1_square.png" alt="logo" class="img_pannel">
				  							ক্রয় হিসাব
				  						</h5>
				  						 <!-- <p class="img_pannel_con">
				  							<img src="../img/logo/add1.png" alt="logo" class="img_pannel">
				  						</p> --> 
				  						<p class="pannel_foot" style="color: #D2007C;">
				  							Click here
				  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  						</p>
				  					</a>	  					
				  				</div>
				  				<?php
				  			}
				  			if($_SESSION['pathor_bikroy_hisab'] == 'yes'){
				  				?>
			  					<div class="pannel_con" >
				  					<a href="../vaucher/pathor_details_sell_entry.php">
				  						<h5 class="pannel_head" style="background-color: #DB0101;">
				  							<img src="../img/logo/add2_square.png" alt="logo" class="img_pannel">
											  বিক্রয় হিসাব
				  						</h5>
				  						<!-- <p class="img_pannel_con">
				  							<img src="../img/logo/add2.png" alt="logo" class="img_pannel">
				  						</p> -->
				  						<p class="pannel_foot" style="color: #DB0101;">
				  							Click here
				  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  						</p>
				  					</a>	  					
				  				</div>
				  				<?php
				  			}
				  			if($_SESSION['pathor_category'] == 'yes'){
				  				?>
				  				<div class="pannel_con" >
				  					<a href="../vaucher/pathor_hisab_entry.php">
				  						<h5 class="pannel_head" style="background-color: #1B9901;">
				  							<img src="../img/logo/add3_square.png" alt="logo" class="img_pannel">
				  							ক্যাটাগরি এন্ট্রি
				  						</h5>
				  						<!-- <p class="img_pannel_con">
				  							<img src="../img/logo/add3.png" alt="logo" class="img_pannel">
				  						</p> -->
				  						<p class="pannel_foot" style="color: #1B9901;">
				  							Click here
				  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  						</p>
				  					</a>	  					
				  				</div>
				  			<?php
				  			}
				  			if($_SESSION['pathor_dealer'] == 'yes'){
				  				?>
				  				<div class="pannel_con" >
				  					<a href="../vaucher/pathor_dealer_entry.php">
				  						<h5 class="pannel_head" style="background-color: #0096FF;">
				  							<img src="../img/logo/add4_square.png" alt="logo" class="img_pannel">
				  							ডিলার এন্ট্রি
				  						</h5>
				  						<!-- <p class="img_pannel_con">
				  							<img src="../img/logo/add4.png" alt="logo" class="img_pannel">
				  						</p> -->
				  						<p class="pannel_foot">
				  							Click here
				  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  						</p>
				  					</a>	  					
				  				</div>
				  			<?php
				  			}
				  			if($_SESSION['pathor_stocks'] == 'yes'){
				  				?>
				  				<!-- <div class="pannel_con" >
				  					<a href="../vaucher/pathor_stocks.php">
				  						<h5 class="pannel_head" style="background-color: #00D089;">
				  							<img src="../img/logo/add5_square.png" alt="logo" class="img_pannel">
				  							স্টক তথ্য
				  						</h5>
				  						
				  						<p class="pannel_foot" style="color: #00D089;">
				  							Click here
				  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  						</p>
				  					</a>	  					
				  				</div> -->
				  			<?php
				  			}
				  			if($_SESSION['pathor_buyer'] == 'yes'){
				  				?>
				  				<div class="pannel_con" >
				  					<a href="../vaucher/pathor_buyer_entry.php">
				  						<h5 class="pannel_head" style="background-color: #FF5620;">
				  							<img src="../img/logo/add6_square.png" alt="logo" class="img_pannel">
				  							বায়ার এন্ট্রি
				  						</h5>
				  						<!-- <p class="img_pannel_con">
				  							<img src="../img/logo/add6.png" alt="logo" class="img_pannel">
				  						</p> -->
				  						<p class="pannel_foot" style="color: #FF5620;">
				  							Click here
				  							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
				  						</p>
				  					</a>	  					
				  				</div>
				  			<?php
				  			}

							  if($_SESSION['pathor_customer'] == 'yes'){
								?>
								<div class="pannel_con" >
									<a href="../vaucher/pathor_customer_entry.php">
										<h5 class="pannel_head" style="background-color:#00D089;">
											<img src="../img/logo/add6_square.png" alt="logo" class="img_pannel">
											কাস্টমার এন্ট্রি
										</h5>
										<!-- <p class="img_pannel_con">
											<img src="../img/logo/add6.png" alt="logo" class="img_pannel">
										</p> -->
										<p class="pannel_foot" style="color: #00D089;">
											Click here
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
										</p>
									</a>	  					
								</div>
							<?php
							}
							if($_SESSION['rod_report'] == 'yes'){
								?>
								<div class="pannel_con" >
									<a href="../vaucher/pathor_report_buy_hisab.php">
										<h4 class="pannel_head" style="background-color: #0083A9;">
											<img src="../img/logo/reportVector.svg" alt="logo" class="img_pannel">
											রিপোর্ট
										</h4>
										
										<p class="pannel_foot" style="color: #0083A9;">
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