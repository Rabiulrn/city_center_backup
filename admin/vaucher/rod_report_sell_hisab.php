<?php 
	// phpinfo();
	session_start();
	if(!isset($_SESSION['username']) ){    
	    header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$_SESSION['pageName'] = 'rod_report_sell_hisab';
	
	$project_name_id = $_SESSION['project_name_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>বিক্রয় হিসাব রিপোর্ট</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
	<link rel="stylesheet" href="../css/doinik_hisab.css">
	<link rel="stylesheet" href="../css/report.css?v=1.0.0">

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
	<style type="text/css">
		.fixed_top{
			position: fixed;
			top: 0;
			left: 0;
            /*border-right: 1px solid #ddd;
            background-color: #F8F8F8;*/
        }
        #left_all_menu_con{
        	min-height: 1000px;
        	border-right: 1px solid #ddd;
        	background-color: #d9eed9;
        }
        .left_side_bar{
        	border-right: 0px solid transparent;
        }
	</style>
</head>
<body>
<?php
    include '../navbar/header_text.php';
    // $page ='doinik_all_hisab';
    include '../navbar/navbar.php';
?> 
	<div class="bar_con">
		<img src="../img/loader_used.png" id="loader_img" style="display: none;" width="80px">
		<div class="left_side_bar menu">
			<div id="left_all_menu_con">
				<h4 class="reportHeader"><b>রিপোর্ট</b></h4>
    			<a href="../vaucher/rod_report_buy_hisab.php" >ক্রয় হিসাব</a>
    			<a href="../vaucher/rod_report_sell_hisab.php" class="active">বিক্রয় হিসাব</a>
    			<!-- <a href="../vaucher/rod_report_others_category.php">রড ও অন্যান্ন ক্যাটাগরি</a> -->
    			<a href="../vaucher/rod_report_dealer.php">ডিলার</a>
    			<!-- <a href="../vaucher/rod_report_customer.php">কাস্টমার</a> -->
    			<!-- <a href="../vaucher/rod_report_buyer.php">বায়ার</a> -->
			</div>
		</div>
		<div class="main_bar">
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
		    	<h2 class="text-center" style="font-size: 23px; line-height: 22px;">বিক্রয় হিসাব</h2>
		    </div>
		  	<div class="backcircle">
				<a href="../vaucher/rod_index.php">
					<img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
				</a>
		    </div>
    		<table class="tableshow">
    			<tr>
    				<th>Customer ID</th>
    				<th>Motor Cash</th>
    				<th>Unload</th>
    				<th>Cars rent & Redeem</th>
    				<th>Information</th>
    				<th>Address</th>
    				<th>SL</th>
    				<th>Delivery No</th>
    				<th>Motor</th>
    				<th>Motor No</th>
    				<th>Delivery Date</th>
    				<th>Date</th>
    				<th>Partculars</th>
    				<th>Particulars</th>
    				<th>Debit</th>
    				<th>mm</th>
    				<th>Kg</th>
    				<th>Para's</th>
    				<th>Credit</th>
    				<th>Discount</th>
    				<th>Balance</th>
    				<th>Bundil</th>
    				<th>Total Para's</th>
    			</tr>
    			<tr>
    				<th>কাষ্টমার আই ডি</th>
    				<th>গাড়ী ভাড়া</th>
    				<th>আনলোড</th>
    				<th>গাড়ী ভাড়া ও খালাস</th>
    				<th>মালের বিবরণ</th>
    				<th>ঠিকানা</th>
    				<th>ক্রমিক নং</th>
    				<th>ভাউচার নং</th>
    				<th>গাড়ী</th>
    				<th>গাড়ী নাম্বার</th>
    				<th>ডেলিভারী তারিখ</th>
    				<th>তারিখ</th>
    				<th>মারফোত নাম</th>
    				<th>বিবরণ</th>
    				<th>জমা টাকা</th>
    				<th>মিমি</th>
    				<th>কেজি</th>
    				<th>দর</th>
    				<th>মূল</th>
    				<th>কমিশন</th>
    				<th>অবশিষ্ট</th>
    				<th>বান্ডিল</th>
    				<th>মোট দাম</th>
    			</tr>
    			<?php
    				$sql = "SELECT * FROM details_sell WHERE project_name_id = '$project_name_id'";
    				$result = $db->select($sql);
    				$row_number = mysqli_num_rows($result);
    				if($result && $row_number > 0){
    					$i = 1;
    					while($row = $result->fetch_assoc()){
    						echo "<tr>";
    						echo "<td>" .$row['customer_id']."</td>";
    						echo "<td>" .$row['motor_cash']."</td>";
    						echo "<td>" .$row['unload']."</td>";
    						echo "<td>" .$row['cars_rent_redeem']."</td>";
    						echo "<td>" .$row['information']."</td>";
    						echo "<td>" .$row['address']."</td>";
    						echo "<td>" .$row['sl_no']."</td>";
    						echo "<td>" .$row['delivery_no']."</td>";
    						echo "<td>" .$row['motor']."</td>";
    						echo "<td>" .$row['motor_no']."</td>";
    						if($row['delivery_date'] =='0000-00-00') {
								echo "<td></td>";
    						} else {
    							echo "<td>".date("d-m-Y", strtotime($row['delivery_date']))."</td>"; 
    						};
    						if($row['dates'] == '0000-00-00'){
    							echo "<td></td>";
    						} else {
    							echo "<td>".date("d-m-Y", strtotime($row['dates']))."</td>"; 
    						}
    						echo "<td>" .$row['partculars']."</td>";
    						echo "<td>" .$row['particulars']."</td>";
    						echo "<td>" .$row['debit']."</td>";
    						echo "<td>" .$row['mm']."</td>";
    						echo "<td>" .$row['kg']."</td>";
    						echo "<td>" .$row['paras']."</td>";
    						echo "<td>" .$row['credit']."</td>";
    						echo "<td>" .$row['discount']."</td>";
    						echo "<td>" .$row['balance']."</td>";
    						echo "<td>" .$row['bundil']."</td>";
    						echo "<td>" .$row['total_paras']."</td>";
    						echo "</tr>";
    					}
    				}
    			?>
    		</table>
		</div>
	</div>

	<script type="text/javascript">	
		$('.left_side_bar').height($('.main_bar').innerHeight()).trigger('change');
		if($('.left_side_bar').height() < 700){
	        $('.left_side_bar').height(700);
	    }
	    function heightChange(){
	        var left_side_bar_height = $('.left_side_bar').height();
	        var main_bar_height = $('.main_bar').innerHeight();
	        if(left_side_bar_height >= main_bar_height){
	            $('.left_side_bar').height(main_bar_height + 25);          
	        } else {
	            $('.left_side_bar').height(main_bar_height + 25);            
	        }
	        if($('.left_side_bar').height() < 700){
		        $('.left_side_bar').height(700);
		    }
	    }
	</script>
	<script src="../js/common_js.js"> </script>
</body>
</html>