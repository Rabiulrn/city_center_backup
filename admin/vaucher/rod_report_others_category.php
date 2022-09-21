<?php 
	// phpinfo();
	session_start();
	if(!isset($_SESSION['username']) ){    
	    header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	
	$project_name_id = $_SESSION['project_name_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>রড ও অন্যান্ন ক্যাটাগরি রিপোর্ট</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="../css/voucher.css">
	<link rel="stylesheet" href="../css/report.css">

	
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
    // $page ='doinik_all_hisab';
    include '../navbar/navbar.php';
?> 
	<div class="container-fluid" id="">
		<div class="row">
			<div class="col-md-12">
				
			</div>
		</div>
	    <div class="row">
    		<div class="col-md-2 menu">
	    		<h4 class="reportHeader"><b>রিপোর্ট</b></h4>
    			<a href="../vaucher/rod_report_buy_hisab.php" >ক্রয় হিসাব</a>
    			<a href="../vaucher/rod_report_sell_hisab.php">বিক্রয় হিসাব</a>
    			<!-- <a href="../vaucher/rod_report_others_category.php" class="active">রড ও অন্যান্ন ক্যাটাগরি</a> -->
    			<a href="../vaucher/rod_report_dealer.php">ডিলার</a>
    			<!-- <a href="../vaucher/rod_report_customer.php">কাস্টমার</a> -->
    			<!-- <a href="../vaucher/rod_report_buyer.php">বায়ার</a> -->
	    	</div>
	    	<div class="col-md-9 content">
	    		<?php
					$ph_id = $_SESSION['project_name_id'];
					$query = "SELECT * FROM project_heading WHERE id = $ph_id";
					$show = $db->select($query);
					if ($show) 
					{
						while ($rows = $show->fetch_assoc()) 
						{
			    	?>
						    <!-- <div class="project_heading text-center" >      
						      <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
						    </div> -->
			  		<?php 
						}
					} 
			  	?>
			  	<div class="project_heading text-center" >      
			    	<h2 class="text-center">রড ও অন্যান্ন ক্যাটাগরি</h2>
			    </div>
			  	<div class="backcircle">
					<a href="../vaucher/rod_index.php">
						<img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
					</a>
			    </div>
			    <div class="srchCon">
	    			<span class="printText" id="printBtn"><b>Print &nbsp;&nbsp; |</b></span>
	    			<span class="printText" id="download"><b>&nbsp;&nbsp;Download</b></span>
	    			<span class="seachright">
	    				<b>Search</b>
	    				<input type="text" name="search" id="search" class="form-control option-contol-search" placeholder="Search...">	    				
	    			</span>
	    		</div>
	    		<table class="tableshow">
	    			<tr>
	    				<th>ক্রমিক নং</th>
	    				<th>ক্যাটাগরি নাম</th>
	    				<th>লেবেল নাম</th>	    				
	    			</tr>
	    			<?php
	    				$sql = "SELECT * FROM rod_category";
	    				$result = $db->select($sql);
	    				$row_number = mysqli_num_rows($result);
	    				if($result && $row_number > 0){
	    					$i = 1;
	    					while($row = $result->fetch_assoc()){
	    						$rod_category_id = $row['id'];
	    						
								echo "<tr>";
	    						echo "<td class='text-center'>".$i."</td>";
	    						echo "<td><b>".$row['category_name']."</b></td>";
	    						// echo "<td></td>";
	    						// echo "</tr>";


	    						$sql2 = "SELECT * FROM rod_and_other_label WHERE rod_category_id = '$rod_category_id'";
			    				$result2 = $db->select($sql2);
			    				$row_number2 = mysqli_num_rows($result2);
			    				if($result2 && $row_number2 > 0){				    
			    					$x =1;
			    					while($row2 = $result2->fetch_assoc()){
			    						if($x == 1){
			    							echo "<td>".$row2['rod_label']."</td>";
		    								echo "</tr>";
			    						} else {
			    							echo "<tr>";
				    						echo "<td></td>";
				    						echo "<td></td>";
				    						echo "<td>".$row2['rod_label']."</td>";
				    						echo "</tr>";
			    						}
			    						// echo "<tr><td></td><td></td><td></td></tr>";
			    						$x++;
			    					}
			    				}


	    						
	    						$i++;
	    					}
	    				}
	    			?>
	    		</table>
	    	</div>
	    </div>
	    
	</div>
	<script type="text/javascript">	
		var height = $('.content').height();
		$('.menu').height(height);
	</script>
</body>
</html>