<?php 
	// phpinfo();
	session_start();
	if(!isset($_SESSION['username']) ){    
	    header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$_SESSION['pageName'] = 'balu_report_sell_hisab';
	
	$project_name_id = $_SESSION['project_name_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>বিক্রয় হিসাব রিপোর্ট</title>
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
    			<a href="../vaucher/balu_report_buy_hisab.php" >ক্রয় অনুযায়ী </a>
    			<a href="../vaucher/balu_report_sell_hisab.php" class="active">বিক্রয় অনুযায়ী </a>
    			<!-- <a href="../vaucher/rod_report_others_category.php">রড ও অন্যান্ন ক্যাটাগরি</a> -->
    			 <a href="../vaucher/balu_report_dealer.php">ডিলার অনুযায়ী </a> 
    			<a href="../vaucher/balu_report_customer.php">কাস্টমার অনুযায়ী </a>
    			<!-- <a href="../vaucher/balu_report_buyer.php">বায়ার অনুযায়ী </a> -->
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
<!-- 						    <div class="project_heading text-center" >      
					      <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
					    </div> -->
		  		<?php 
					}
				} 
		  	?>
		  	<div class="project_heading text-center" >      
		    	<h2 class="text-center" style="font-size: 23px; line-height: 22px;">বিক্রয় হিসাব রিপোর্ট</h2>
				<hr style="border: 1px solid grey; margin-top:0px;">
		    </div>
		  	<div class="backcircle">
		      <a href="../vaucher/balu_index.php">
		        <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="40px"> Back
		      </a>
		    </div>
		    		    	
    		<table class="tableshow">
    			<thead>
	    			<tr>
	    				<th>Customer Id</th>
	    				<!-- <th>Motor Name</th>
	    				<th>Driver Name</th> -->
	    				<th>Motor Vara</th>
	    				<th>Unload</th>
	    				<th>Cars Rent & Redeem</th>
                        <th>Information </th>
                        <!-- <th>SL</th> -->
                        <!-- <th>Voucher No.</th>
	    				<th>Address</th>
	    				<th>Motor No</th>
                        <th>Motor SL</th> -->
	    				<!-- <th>Delivery Date</th> -->
	    				<!-- <th>Date</th> -->
	    				<th>Partculars</th>
	    				<th>Particulars</th>
	    				<th>Debit</th>
	    				<th>Ton & Kg</th>
                        <!-- <th>Length</th>
                        <th>width</th>
                        <th>Height</th>
                        <th>Shifty</th>
                        <th>Inchi (-) Minus</th>
                        <th>Cft ( - ) Dropped Out</th>
                        <th>Inchi (+) Added</th>
                        <th>Points ( - ) Dropped Out</th>
                        <th>Shift</th> -->
                        <!-- <th>Total Shift</th> -->
	    				<th>Para's</th>
	    				<th>Discount</th>
                        <th>Credit </th>
	    				<th>Balance</th>
                        <th>Cemeat's Para's</th>
                        <!-- <th>Ton</th> -->
                        <th>Total Cft</th>
                        <!-- <th>Tons</th> -->
	    				<!-- <th>Bank Name</th> -->
	    				<th>Bank fee</th>
	    			</tr>
	    			<tr>
                        <th>কাষ্টমার আই ডি</th>
	    				<!-- <th>গাড়ী নাম</th>
	    				<th>ড্রাইভারের নাম</th> -->
	    				<th>গাড়ী ভাড়া</th>
	    				<th>আনলোড</th>
	    				<th>গাড়ী ভাড়া ও খালাস</th>
	    				<th>মালের বিবরণ</th>
	    				<!-- <th>ক্রমিক</th> -->
	    				<!-- <th>ভাউচার নং</th>
                        <th>ঠিকানা</th>
	    				<th>গাড়ী নাম্বার</th>
	    				<th>গাড়ী নং</th> -->
	    				<!-- <th>ডেলিভারী তারিখ</th> -->
	    				<!-- <th>তারিখ</th> -->
	    				<th>মারফোত নাম</th>
	    				<th>বিবরণ</th>
	    				<th>জমা টাকা</th>
	    				<th>টন ও কেজি</th>
	    				<!-- <th>দৈর্ঘ্যের</th>
                        <th>প্রস্ত</th>
                        <th>উচাঁ</th>
                        <th>সেপ্টি</th>
                        <th>Inchi (-) বিয়োগ </th>
                        <th>সিএফটি ( - ) বাদ</th>
                        <th>Inchi (+) যোগ </th>
                        <th>পয়েন্ট ( - )  বাদ</th>
                        <th>সেপ্টি</th> -->
                        <!-- <th>মোট সেপ্টি</th> -->
                        <th>দর</th>
                        <th>কমিশন</th>
                        <th>মূল</th>
                        <th>অবশিষ্ট</th>
	    				<th>গাড়ী ভাড়া / লেবার সহ</th>
                        <!-- <th>টন</th> -->
                        <th> মোট সিএফটি</th>
	    				<!-- <th>টন</th> -->
	    				<!-- <th>ব্যাংক নাম</th> -->
	    				<th>ব্যাংক ফি</th>
	    				
	    			</tr>
    			</thead>
    			<tbody>
	    			<?php
	    				$sql = "SELECT * FROM details_sell_balu WHERE project_name_id = $project_name_id";
	    				$result = $db->select($sql);
	    				$row_number = mysqli_num_rows($result);
	    				if($result && $row_number > 0){
	    					$i = 1;
	    					while($row = $result->fetch_assoc()){
	    						echo "<tr>";
	    						// echo "<td>".$i."</td>";
                                // echo "<td>".$row['id']."</td>";
								echo "<td>".$row['customer_id']."</td>";
	    						// echo "<td>".$row['motor_name']."</td>";
	    						// echo "<td>".$row['driver_name']."</td>";
	    						echo "<td>".$row['motor_vara']."</td>";
	    						echo "<td>".$row['unload']."</td>";
	    						echo "<td>".$row['cars_rent_redeem']."</td>";
	    						echo "<td>".$row['information']."</td>";
	    						// echo "<td>".$row['sl']."</td>";
	    						// echo "<td>".$row['voucher_no']."</td>";
	    						// echo "<td>".$row['address']."</td>";
	    						// echo "<td>".$row['motor_no']."</td>";
	    						// echo "<td>".$row['motor_sl']."</td>";
								// if($row['delivery_date'] =='0000-00-00') {
								// 	echo "<td></td>";
	    						// } else {
	    						// 	echo "<td>".date("d-m-Y", strtotime($row['delivery_date']))."</td>"; 
	    						// };
	    						// if($row['dates'] == '0000-00-00'){
	    						// 	echo "<td></td>";
	    						// } else {
	    						// 	echo "<td>".date("d-m-Y", strtotime($row['dates']))."</td>"; 
	    						// }
	    						echo "<td>".$row['partculars']."</td>";
	    						echo "<td>".$row['particulars']."</td>";
	    						echo "<td>".$row['debit']."</td>";
	    					    echo "<td>".$row['ton & kg']."</td>";
	    						// echo "<td>".$row['length']."</td>";
	    						// echo "<td>".$row['width']."</td>";
	    						// echo "<td>".$row['height']."</td>";
	    						// echo "<td>".$row['shifty']."</td>";
	    						// echo "<td>".$row['inchi (-)_minus']."</td>";
                                // echo "<td>".$row['cft (-)_dropped Out']."</td>";
                                // echo "<td>".$row['inchi (+)_added']."</td>";
                                // echo "<td>".$row['points ( - )_dropped out']."</td>";
	    						// echo "<td>".$row['shift']."</td>";
                                // echo "<td>".$row['total_shift']."</td>";
	    						echo "<td>".$row['paras']."</td>";
                                echo "<td>".$row['discount']."</td>";
                                echo "<td>".$row['credit']."</td>";
								echo "<td>".$row['balance']."</td>";
                                echo "<td>".$row['cemeats_paras']."</td>";
                                // echo "<td>".$row['ton']."</td>";
                                echo "<td>".$row['total_shifts']."</td>";
                                // echo "<td>".$row['tons']."</td>";
                                // echo "<td>".$row['bank_name']."</td>";
                                echo "<td>".$row['fee']."</td>";

                                
	    						echo "</tr>";
	    						$i++;
	    					}
	    				}
	    			?>
	    		</tbody>
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