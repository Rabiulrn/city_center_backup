<?php 
	// phpinfo();
	session_start();
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	if(!isset($_SESSION['username']) ){    
	    header('location:../index.php');
	}
	$project_name_id = $_SESSION['project_name_id'];
?>


<?php
	//Total Joma
	$total_joma = 0;
	$sql_total_joma ="SELECT SUM(credit_amount) AS total_credit_amount FROM vaucher_credit WHERE project_name_id = '$project_name_id'";	
	$tj_result = $db->select($sql_total_joma);
	while($row = $tj_result->fetch_array()){
		$total_joma = $row['total_credit_amount'];
	}


	//total_khoros
	$total_khoros = 0;
	$sql_total_khoros ="SELECT SUM(group_total_taka) AS group_total_taka FROM debit_group_data WHERE project_name_id = '$project_name_id'";	
	$tk_result = $db->select($sql_total_khoros);
	while($row = $tk_result->fetch_array()){
		$total_khoros = $row['group_total_taka'];
	}

	//total_paona
	$total_paona = 0;
	$sql_total_paona ="SELECT SUM(amount) AS total_amount FROM nij_paonadar WHERE project_name_id = '$project_name_id'";	
	$tp_result = $db->select($sql_total_paona);
	while($row = $tp_result->fetch_array()){
		$total_paona = $row['total_amount'];
	}

	//total_pabe
	$total_pabe = 0;
	$sql_total_pabe ="SELECT SUM(pabe_amount) AS total_pabe_amount FROM jara_pabe WHERE project_name_id = '$project_name_id'";	
	$tpabe_result = $db->select($sql_total_pabe);
	while($row = $tpabe_result->fetch_array()){
		$total_pabe = $row['total_pabe_amount'];
	}






	$query = "SELECT due_credit_amount, due_debit_amount FROM due WHERE project_name_id = '$project_name_id'";
  	$show = $db->select($query);
  	if ($show) 
  	{
  		$due_credit_amount	= 0;
		$due_debit_amount	= 0;
  		while ($rows = $show->fetch_assoc()){
  			$due_credit_amount	= $rows['due_credit_amount'];
			$due_debit_amount	= $rows['due_debit_amount'];
		}
		// echo $due_credit_amount;
		// echo $due_debit_amount;
  	}
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
	<link rel="stylesheet" href="../css/voucher.css">

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
		.holder{
			width: 100%;
			/*border: 1px solid red;*/
			padding: 0px 20px;
		}
		.inner{
			font-size: 16px;
		}
		.backcircle{
	        font-size: 18px;
	        position: absolute;
	        margin-top: -15px;
	        margin-left: 18px;
	    }
	    .backcircle a:hover{
	        text-decoration: none !important;
	    }
	</style>
</head>
<body>
<?php
    include '../navbar/header_text.php';
    $page ='doinik_all_hisab';
    include '../navbar/navbar.php';
?> 
<div class="container" id="" style="margin-bottom: 100px;">
	<?php
      $ph_id = $_SESSION['project_name_id'];
      $query = "SELECT * FROM project_heading WHERE id = $ph_id";
      $show = $db->select($query);
      if ($show) 
      {
        while ($rows = $show->fetch_assoc()) 
        {
    ?>
    <div class="project_heading text-center" >      
      <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
      <!-- <h4 class="text-center"><?php //echo $rows['subheading']; ?></h4> -->
    </div>
  	<?php 
        }
      } 
  	?>
  	<div class="backcircle">
      <a href="../vaucher/home.php">
        <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
      </a>
    </div>
  	<div class="row">
  		<?php
  			if($_SESSION['doinik_hisab'] == 'yes'){
  		?>
		  		<div class="col-md-4 boxcon">
		  			<a href="../vaucher/index.php">
		  				<div class="boxmain">
			  				<h4 class="pageheader">
			  					<img src="../img/logo/summary.png" alt="image" width="40px" height="40px">
			  					&nbsp;
			  					<b>দৈনিক হিসাব সারংশ</b>	
			  				</h4> 			
			  				<div class="holder">			  					
			  					<!-- <h5>পূর্বের জেরঃ <?php echo $due_credit_amount;?>/-</h5> -->
			  					<h3 class="inner"><b>মোট জমাঃ
			  						<?php
			  							$motjomaShow = $due_credit_amount +  $total_joma;
			  							echo number_format($motjomaShow, 2);
			  							?>/-</b></h3>
			  					<!-- <h5>পূর্বের পাওনাঃ <?php echo $due_debit_amount;?>/-</h5> -->
			  					<!-- <h5>মোট জমাঃ <?php echo $due_debit_amount +  $total_khoros;?>/-</h5> -->
			  					<!-- <h5>পাওনাঃ
				  					<?php
				  						$total_p_amount = 0;
				  						$all_debit_due = 0;

										$sql_qry_debit_group_pay="SELECT SUM(group_pay) AS group_pay FROM debit_group_data WHERE project_name_id = '$project_name_id'";
										$duration_debit_group_pay = $db->select($sql_qry_debit_group_pay);
										while($record_debit_group_pay = $duration_debit_group_pay->fetch_array()){
											$group_pay = $record_debit_group_pay['group_pay'];
										}										
										$debit_pay = $total_khoros - $group_pay;
										$all_debit_due +=$debit_pay;

										$sql_pabe_amount="SELECT SUM(pabe_amount) AS pabe_amount FROM jara_pabe WHERE project_name_id = '$project_name_id'";
										$duration_pabe_amount = $db->select($sql_pabe_amount);
										while($record_pabe_amount = $duration_pabe_amount->fetch_array()){
											$pabe_amount = $record_pabe_amount['pabe_amount'];
										} 

							            if(!empty($all_debit_due) && !empty($pabe_amount)){
							              echo $total_p_amount=$all_debit_due+$pabe_amount; 
							            }else if(!empty($all_debit_due)){
							              echo $total_p_amount=$all_debit_due; 
							            }else if(!empty($pabe_amount)){
							              echo $total_p_amount=$pabe_amount; 
							            }
							        ?>
						        /-</h5> -->
						        <h3 class="inner"><b>মোট খরচঃ 
						        	<?php 
							        	$total_kkk = $due_debit_amount +  $total_khoros - $total_p_amount; 
							        	// echo $total_kkk;
							        	echo number_format($total_kkk, 2);
						        	?>/-</b>
						        </h3>
						        <h3 class="inner"><b>জের/পাওনাঃ 
						        	<?php
						        		echo number_format($due_credit_amount +  $total_joma - $total_kkk, 2);
						        	?>/-</b></h3>
			  				</div>		
			  			</div>
		  			</a>
		  		</div>
	  	<?php
  			}
  			if($_SESSION['joma_khat'] == 'yes'){
  		?>
		  		<div class="col-md-4 boxcon">
		  			<a href="../vaucher/add_vaucher_credit.php">
		  				<div class="boxmain">
			  				<h4 class="pageheader">
			  					<img src="../img/logo/newentry.png" alt="image" width="40px" height="40px">
			  					&nbsp;
			  					<b>জমা খাত এন্ট্রি</b>
			  				</h4>			  				
			  				<div class="holder">			  					
			  					<h3 class="inner"><b>মোট জমাঃ <?php if($total_joma == NULL){echo '0.00';} else { echo number_format($total_joma, 2);}?>/-</b></h3>
			  				</div>				
			  			</div>
		  			</a>
		  		</div>
  		<?php
  			}
  			if($_SESSION['khoros_khat'] == 'yes'){
  		?>
		  		<div class="col-md-4 boxcon">
		  			<a href="../vaucher/add_vaucher_group.php">
		  				<div class="boxmain">
			  				<h4 class="pageheader">
			  					<img src="../img/logo/khoros.png" alt="image" width="40px" height="40px">
			  					&nbsp;
			  					<b>খরচ খাত এন্ট্রি</b>
			  				</h4>
			  				<div class="holder">			  					
			  					<h3 class="inner"><b>মোট খরচঃ <?php if($total_khoros == NULL){echo '0.00';} else {echo number_format($total_khoros, 2);}?>/-</b></h3>
			  				</div>			
			  			</div>
		  			</a>
		  		</div>
  		<?php
  			}
  			if($_SESSION['nije_pabo'] == 'yes'){
  		?>
		  		<div class="col-md-4 boxcon">
		  			<a href="../vaucher/nij_paonadar_add.php">
		  				<div class="boxmain">
			  				<h4 class="pageheader">
			  					<img src="../img/logo/nijepabo.png" alt="image" width="40px" height="40px">
			  					&nbsp;<b>নিজে পাবো এন্ট্রি</b>
			  				</h4>
			  				<div class="holder">			  					
			  					<h3 class="inner"><b>মোট পাওনাঃ <?php if($total_paona == NULL){echo '0.00';} else {echo number_format($total_paona, 2);}?>/-</b></h3>
			  				</div>					
			  			</div>
		  			</a>
		  		</div>
  		<?php
  			}
  			if($_SESSION['paonader'] == 'yes'){
  		?>
		  		<div class="col-md-4 boxcon">
		  			<a href="../vaucher/jara_pabe_add.php">
		  				<div class="boxmain">
			  				<h4 class="pageheader">
			  					<img src="../img/logo/paonader.png" alt="image" width="40px" height="40px">
			  					&nbsp;
			  					<b>পাওনাদার এন্ট্রি</b>
			  				</h4>
			  				<div class="holder">			  					
			  					<h3 class="inner"><b>মোট পাওনাঃ <?php if($total_pabe == NULL){echo '0.00';} else {echo number_format($total_pabe, 2);}?>/-</b></h3>
			  				</div>					
			  			</div>
		  			</a>
		  		</div>
  		<?php
  			}
  			if($_SESSION['modify_data'] == 'yes'){
  		?>
		  		<div class="col-md-4 boxcon">
		  			<a href="../vaucher/modify_vaucher.php">
		  				<div class="boxmain">
			  				<h4 class="pageheader">
			  					<img src="../img/logo/modify2.png" alt="image" width="40px" height="40px">
			  					&nbsp;
			  					<b>মডিফাই ডাটা</b>
			  				</h4>
			  				<div class="holder">			  					
			  					<h3 class="inner"><b>*এডিট/আপডেট</b></h3>
			  				</div>	 				
			  			</div>
		  			</a>
		  		</div>
  		<?php
  			}
  			
  		?>
  			<div class="col-md-4 boxcon">
	  			<a href="../vaucher/report_joma.php">
	  				<div class="boxmain">
		  				<h4 class="pageheader">
		  					<img src="../img/logo/report.png" alt="image" width="40px" height="40px">
		  					&nbsp;
		  					<b>রিপোর্ট</b>
		  				</h4>
		  				<div class="holder">			  					
		  					<h3 class="inner"><b>* রিপোর্ট দেখুন</b></h3>
		  				</div>	 				
		  			</div>
	  			</a>
	  		</div>
	  		<div class="col-md-4 boxcon">
	  			<a href="../vaucher/cash_calculator.php">
	  				<div class="boxmain">
		  				<h4 class="pageheader">
		  					<img src="../img/logo/calc.png" alt="image" width="40px" height="40px">
		  					&nbsp;
		  					<b>ক্যাশ ক্যালকুলেটর</b>
		  				</h4>
		  				<div class="holder">			  					
		  					<h4 class="inner"><b>* হিসাব করুন</b></h4>
		  				</div>	
		  			</div>
	  			</a>
	  		</div>

  	</div>
</div>
</body>
</html>