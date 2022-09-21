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
	$edit_data_permission   = $_SESSION['edit_data'];
	$delete_data_permission = $_SESSION['delete_data'];

	$_SESSION['pageName'] = 'cash_calculator';
	
	
	$sucMsg = '';

	if(isset($_POST['submit'])){
		// print_r($_POST['submit']);

		$date = date("Y-m-d");
		$total_amount = 0;
		$total_notes = 0;

		$thousand = 0;
		$fiveHundred = 0;
		$oneHundred = 0;
		$fifty = 0;
		$twenty = 0;
		$ten = 0;
		$five = 0;
		$two = 0;
		$one = 0;
		$cash_id = $_POST['cash_id'];
		if($_POST['thousand'] !== ''){
			$thousand = trim($_POST['thousand']);
		}
		if($_POST['fiveHundred'] !== ''){
			$fiveHundred = trim($_POST['fiveHundred']);
		}
		if($_POST['oneHundred'] !== ''){
			$oneHundred = trim($_POST['oneHundred']);
		}
		if($_POST['fifty'] !== ''){
			$fifty = trim($_POST['fifty']);
		}
		if($_POST['twenty'] !== ''){
			$twenty = trim($_POST['twenty']);
		}
		if($_POST['ten'] !== ''){
			$ten = trim($_POST['ten']);
		}
		if($_POST['five'] !==''){
			$five = trim($_POST['five']);
		}
		if($_POST['two'] !== ''){
			$two = trim($_POST['two']);
		}
		if($_POST['one'] !== ''){
			$one = trim($_POST['one']);
		}

		$total_amount += $thousand * 1000;
		$total_amount += $fiveHundred * 500;
		$total_amount += $oneHundred * 100;
		$total_amount += $fifty * 50;
		$total_amount += $twenty * 20;
		$total_amount += $ten * 10;
		$total_amount += $five * 5;
		$total_amount += $two * 2;
		$total_amount += $one * 1;


		$total_notes += $thousand;
		$total_notes += $fiveHundred;
		$total_notes += $oneHundred;
		$total_notes += $fifty;
		$total_notes += $twenty;
		$total_notes += $ten;
		$total_notes += $five;
		$total_notes += $two;
		$total_notes += $one;
		
		// echo $date .'<br>';
		// echo $total_amount .'<br>';
		// echo $total_notes .'<br>';
		// echo $thousand .'<br>';
		// echo $fiveHundred .'<br>';
		// echo $oneHundred .'<br>';
		// echo $fifty .'<br>';
		// echo $twenty .'<br>';
		// echo $ten .'<br>';
		// echo $five .'<br>';
		// echo $two .'<br>';
		// echo $one .'<br>';
		if($_POST['submit'] == 'Save'){
			$sql = "INSERT INTO cash(note_1000,	note_500, note_100, note_50, note_20, note_10, note_5, note_2, note_1, total_notes, total_amout,	dates,  	project_name_id) VALUES ('$thousand', '$fiveHundred', '$oneHundred', '$fifty', '$twenty', '$ten', '$five', '$two', '$one', '$total_notes', '$total_amount', '$date', '$project_name_id')";
			$result = $db->insert($sql);
			if ($result) 
			{	  
			   $sucMsg = 'Cash is inserted successfully !';
			}
			else
			{
			  $sucMsg = 'Cash is not inserted !';
			}
		} else {			
			// $sql = "UPDATE cash SET note_1000 = '$thousand', note_500 = '$fiveHundred', note_100 = '$oneHundred', note_50 = '$fifty', note_20 = '$twenty', note_10 = '$ten', note_5 = '$five', note_2 = '$two', note_1, '$one'total_notes = '$total_notes', total_amout = '$total_amount',	dates = '$date' WHERE id = '$cash_id'";

			//Without date update
			$sql = "UPDATE cash SET note_1000 = '$thousand', note_500 = '$fiveHundred', note_100 = '$oneHundred', note_50 = '$fifty', note_20 = '$twenty', note_10 = '$ten', note_5 = '$five', note_2 = '$two', note_1 = '$one', total_notes = '$total_notes', total_amout = '$total_amount' WHERE id = '$cash_id'";
			$result = $db->update($sql);
			if ($result) 
			{	  
			   $sucMsg = 'Cash is updated successfully !';
			}
			else
			{
			  $sucMsg = 'Cash is not updated !';
			}
		}
	}

	if(isset($_GET['remove_id'])){
		$delete_cash_id = $_GET['remove_id'];
		$sql = "DELETE FROM cash WHERE id = '$delete_cash_id'";
		$result = $db->delete($sql);
		if ($result) 
		{	  
		   $sucMsg = 'Cash is deleted successfully !';
		}
		else
		{
		  $sucMsg = 'Cash is not deleted !';
		}
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
  <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
  <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>

	<style type="text/css">
	    .backcircle{
	        font-size: 18px;
	        position: absolute;
	        margin-top: -50px;
	    }
	    .backcircle a:hover{
	        text-decoration: none !important;
	    }
	    .cashCalcCon{
	    	width: 100%;
	    	/*position: relative;
	    	left: 50%;
	    	margin-left: -30%;*/
	    	border: 5px solid #002644;
	    	background-color: #2194EF;
	    	background-color: #00589D;
	    	float: left;
	    	padding-bottom: 20px;
	    }
	    .cashHeader{
	    	color: #00589D;
	    	font-weight: bold;
	    	text-align: center;
	    	float: left;
	    	width: 100%;
	    	margin: 8px 0px 4px;
	    	font-size: 17px;
	    }
	    .cashLeft{
	    	width: 50%;
	    	float: left;
	    	height: 70px;
	    }
		.cashRight{
			width: 50%;
			float: right;
			height: 70px;
			position: relative;
		}
		.cashRight h3{
			font-size: 20px;
			padding: 5px 10px 5px;
			margin: 0px;
			color: #fff;
		}
		.cashRight .vaucherInp{
			width: 160px;
			color: #000;
			font-weight: bold;
			padding: 2px 5px;
			font-size: 20px;
		}
		.vaucherInp::placeholder{
			font-size: 12px;
		}
		.notesAndTk{
			padding: 5px 10px 5px;
			margin: 0px;
			color: #fff;
			font-size: 20px;
		}
		.notesAndTkBottom{
			padding: 5px 10px 5px;
			margin: 0px;
			color: #fff;
			text-align: center;
		}
		.borderOf{
			background-color: #002644;
			float: left;
			height: 3px;
			width: 100%;
		}
		.whiteBar{
			background-color: #fff;
			float: left;
			height: 3px;
			width: 100%;
			clear: both;
		}
		.buttonClear{
			/*color: #ff;*/
			background-color: #fff;
			color: #2194EF;
			border: 0px;
			border-radius: 4px;
			padding: 10px 15px;
			font-size: 15px;
			font-weight: bold;
			position: absolute;
			top: 8px;
			right: 14px;
			transition: all .3s;
			border: 1px solid #999;
		}
		.buttonClear:hover{
			box-shadow: 1px 0px 5px #fff;
			transition: all .3s;
		}
		
		.tkbox{
			float: left;
			padding: 3px 10px 3px;
			width: 100%;
		}
		.tkaImg{
			width: 100px;
			height: 35px;
		}
		.tkControl{
			font-size: 20px;
			color: #fff;
			margin: 5px 0px 8px;	
		}
		.inputeNotes{
			color: #000;
			font-weight: bold;
			padding: 2px 5px;
			font-size: 20px;
			width: 148px;
		}
		.inputeNotes::placeholder{
			font-size: 12px;
		}
		.amountFig{
			width: 90px;
			font-weight: bold;
			display: inline-block;
			text-align: center;
			/*font-size: 18px;*/
		}
		.saveCashBtn{
			width: 50%;
			border-radius: 5px;
			font-size: 20px;
			position: relative;
			left: 50%;
			margin-left: -25%;
			margin-top: 10px;
		}
		.message{
			float: left;
			width: 100%;
			text-align: center;
			color: #93ffab;
			font-size: 25px;
		}
		.cashTable{
			width: 100%;
			margin-top: 1px;
		}

		.cashTable tr td, .cashTable tr th{
			border: 1px solid #333;
			padding: 2px 5px;
		}
		.cashTable tr th{
			text-align: center;
			background-color: #00589D;
			padding: 10px;
			color: #fff;
		}

		.tablink {
			background-color: #555;
			color: white;
			float: left;
			border: none;
			outline: none;
			cursor: pointer;
			padding: 10px 16px;
			font-size: 17px;
			width: 50%;
			border-bottom: 15px solid #00589d;
		}

		.tablink:hover {
			background-color: #777;
		}

		/* Style the tab content (and add height:100% for full page content) */
		.tabcontent {
			color: #000;
			/*display: none;*/
			/*padding: 0px 50px 0px;*/
			/*height: 100%;*/
			float: left;
			margin-top: -1px;
			width: 100%;
		}
		.tabBtnCon{
			width: 100%;
			position: relative;
			/*left: 50%;
			margin-left: -30%;*/
			float: left;
		}
	</style>
</head>
<body>
	<?php
	    include '../navbar/header_text.php';
	    $page ='doinik_hisab';
	    include '../navbar/navbar.php';
	?> 
	<div class="container" id="">
	    <!-- <div class="backcircle noprint">
			<a href="../vaucher/doinik_all_hisab.php">
				<img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
			</a>
	    </div> -->
	    
	</div>    

	<div class="bar_con">
  		<div class="left_side_bar">  			
	  		<?php require '../others_page/left_menu_bar.php'; ?>
	  	</div>
	  	<div class="main_bar" style="padding-bottom: 100px; position: relative;">
	  		<?php
                $ph_id = $_SESSION['project_name_id'];
                $query = "SELECT * FROM project_heading WHERE id = $ph_id";
                $show = $db->select($query);
                if ($show) {
                    while ($rows = $show->fetch_assoc()) {
                ?>
                    <div class="project_heading">      
                        <h2 class="headingOfAllProject">
                            <?php echo $rows['heading']; ?>, <span class="protidinHisab">ক্যাশ ক্যালকুলেটর ও বিস্তারিত হিসাব</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                        </h2>
                    </div>
                <?php 
                    }
                } 
            ?>
	  		<div class="tabBtnCon" style="">
			    <button class="tablink" onclick="openPage('calculator', this, '#00589D'), changeBorder2()" id="defaultOpen">Cash Calculator</button>
				<button class="tablink" onclick="openPage('details', this, '#00589D'), changeBorder()" id="detailsOpen">Details</button>
			</div>

			<div id="calculator" class="tabcontent" style="">
				<div class="cashCalcCon">
					<form method="post" action="" onsubmit="return validation();">
				    	<!-- <h2 class="cashHeader">Cash Calculator</h2> -->
				    	<p class="message"><?php echo $sucMsg;?></p>
				    	
				    	<!-- <div class="borderOf"></div> -->
				    	<div class="cashLeft">

				    		<h3 class="notesAndTk ">মোট টাকা = <span id="totalTaka" class="totalTaka">0</span></h3>
				    		<h3 class="notesAndTk ">মোট নোট = <span class="totalNotes">0</span></h3>
				    	</div>
				    	<div class="cashRight">
				    		<input type="button" name="" value="Clear" class="buttonClear">
				    		<h3>খরচ = <input type="text" name="vaucher" class="vaucherInp" id="vaucherInp" placeholder="খরচের টাকা..."> টাকা</h3>
				    		<h3>নগদ টাকা  = ৳. <span id="cashTaka">0</span></h3>
				    	</div>
				    	<div class="borderOf"></div>
		    			<div class="tkbox">
		    		
			    			<input type="hidden" name="cash_id" id="cash_id">
				    		<p class="tkControl">
				    			<img src="../img/taka_img/1000_tk.jpg" alt="Taka" class="tkaImg">
				    			<span class="amountFig">1000 X </span>
				    			<input type="text" name="thousand" id="thousand" placeholder="Notes of 1000 Taka" class="inputeNotes">
				    			<b>=&nbsp;</b>
				    			<b><span id="thousandAmount">0</span></b>
				    		</p>
				    		<p class="tkControl">
				    			<img src="../img/taka_img/500_tk.jpg" alt="Taka" class="tkaImg">
				    			<span class="amountFig">500 X </span>
				    			<input type="text" name="fiveHundred" id="fiveHundred" placeholder="Notes of 500 Taka" class="inputeNotes">
				    			<b>=&nbsp;</b>
				    			<b><span id="fiveHundredAmount">0</span></b>
				    		</p>
				    		<p class="tkControl">
				    			<img src="../img/taka_img/100_tk.jpg" alt="Taka" class="tkaImg">
				    			<span class="amountFig">100 X </span>
				    			<input type="text" name="oneHundred" id="oneHundred" placeholder="Notes of 100 Taka" class="inputeNotes">
				    			<b>=&nbsp;</b>
				    			<b><span id="oneHundredAmount">0</span></b>
				    		</p>
				    		<p class="tkControl">
				    			<img src="../img/taka_img/50_tk.jpg" alt="Taka" class="tkaImg">
				    			<span class="amountFig">50 X </span>
				    			<input type="text" name="fifty" id="fifty" placeholder="Notes of 50 Taka" class="inputeNotes">
				    			<b>=&nbsp;</b>
				    			<b><span id="fiftyAmount">0</span></b>
				    		</p>
				    		<p class="tkControl">
				    			<img src="../img/taka_img/20_tk.jpg" alt="Taka" class="tkaImg">
				    			<span class="amountFig">20 X </span>
				    			<input type="text" name="twenty" id="twenty" placeholder="Notes of 20 Taka" class="inputeNotes">
				    			<b>=&nbsp;</b>
				    			<b><span id="twentyAmount">0</span></b>
				    		</p>
				    		<p class="tkControl">
				    			<img src="../img/taka_img/10_tk.jpg" alt="Taka" class="tkaImg">
				    			<span class="amountFig">10 X </span>
				    			<input type="text" name="ten" id="ten" placeholder="Notes of 10 Taka" class="inputeNotes">
				    			<b>=&nbsp;</b>
				    			<b><span id="tenAmount">0</span></b>
				    		</p>
				    		<p class="tkControl">
				    			<img src="../img/taka_img/5_tk.jpg" alt="Taka" class="tkaImg">
				    			<span class="amountFig">5 X </span>
				    			<input type="text" name="five" id="five" placeholder="Notes of 5 Taka" class="inputeNotes">
				    			<b>=&nbsp;</b>
				    			<b><span id="fiveAmount">0</span></b>
				    		</p>
				    		<p class="tkControl">
				    			<img src="../img/taka_img/2_tk.jpg" alt="Taka" class="tkaImg">
				    			<span class="amountFig">2 X </span>
				    			<input type="text" name="two" id="two" placeholder="Notes of 2 Taka" class="inputeNotes">
				    			<b>=&nbsp;</b>
				    			<b><span id="twoAmount">0</span></b>
				    		</p>
				    		<p class="tkControl">
				    			<img src="../img/taka_img/1_tk.jpg" alt="Taka" class="tkaImg">
				    			<span class="amountFig">1 X </span>
				    			<input type="text" name="one" id="one" placeholder="Notes of 1 Taka" class="inputeNotes">
				    			<b>=&nbsp;</b>
				    			<b><span id="oneAmount">0</span></b>
				    		</p>
				    		<div class="whiteBar"></div>
				    		<!-- <h3 class="notesAndTkBottom" >Total Taka = <span class="totalTaka">0</span></h3>
			    			<h3 class="notesAndTkBottom" style="font-size: 22px;">Total Notes = <span class="totalNotes">0</span></h3> -->

			    			<input type="submit" name="submit" value="Save" id="saveCashBtn" class="saveCashBtn">
				    		
				    	</div>
			    	</form>
			    </div>
			</div>

			<div id="details" class="tabcontent">
				<!-- <div style="clear: both;"></div> -->
			    <table class="cashTable" id="cashTable">
			    	<tr>
			    		<th>Sl No</th>
			    		<th>Date</th>
			    		<th>1000 Tk</th>
			    		<th>500 Tk</th>
			    		<th>100 Tk</th>
			    		<th>50 Tk</th>
			    		<th>20 Tk</th>
			    		<th>10 Tk</th>
			    		<th>5 Tk</th>
			    		<th>2 Tk</th>
			    		<th>1 Tk</th>
			    		<th>Total Notes</th>
			    		<th>Total Taka</th>
			    		<th width="50px">Delete</th>
			    		<th width="50px">Edit</th>
			    	</tr>
			    
			    <?php
			    	$sql = "SELECT * FROM cash WHERE project_name_id = '$project_name_id'";
			    	$read = $db->select($sql);
			    	$i =1;
			    	if($read){
			    		while($row = $read->fetch_assoc()) {
			    			echo "<tr>";
			    				echo "<td style='text-align: center;'>".$i."</td>";
			    				echo "<td>".date("d/m/Y", strtotime($row['dates']))."</td>";
			    				echo "<td>".$row['note_1000']."</td>";
			    				echo "<td>".$row['note_500']."</td>";
			    				echo "<td>".$row['note_100']."</td>";
			    				echo "<td>".$row['note_50']."</td>";
			    				echo "<td>".$row['note_20']."</td>";
			    				echo "<td>".$row['note_10']."</td>";
			    				echo "<td>".$row['note_5']."</td>";
			    				echo "<td>".$row['note_2']."</td>";
			    				echo "<td>".$row['note_1']."</td>";
			    				echo "<td>".$row['total_notes']."</td>";
			    				echo "<td>".number_format($row['total_amout'], 2)."</td>";

			    				if($delete_data_permission == 'yes'){
			    					echo "<td><a data_trash_id='".$row['id']."' class='btn btn-danger cashDelete'>Delete</a></td>";
			    				} else {
			    					echo "<td><a class='btn btn-danger edPermit' disabled>Delete</a></td>";
			    				}
			    				
			    				if($edit_data_permission == 'yes'){
			    					echo "<td><a data_edit_id='".$row['id']."' class='btn btn-success' onclick='displayupdate(this)'>&nbsp;Edit&nbsp;</a></td>";
								} else {
			    					echo "<td><a class='btn btn-success edPermit' disabled>&nbsp;Edit&nbsp;</a></td>";
			    				}
			    				
			    			echo "</tr>";
			    			$i++;
			    		}
			    	}
			    ?>
			    </table>
			</div>
		</div>
	</div>
	<?php include '../others_page/delete_permission_modal.php';  ?>
	    

	    
	
    <script type="text/javascript">
    	$(".buttonClear").click(function(){
    		window.location.href = '../vaucher/cash_calculator.php';
    		// window.scrollTop('100px');
    	});
    	$.fn.digits = function(){ 
		    return this.each(function(){ 
		        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); 
		    })
		}
		
    	$(document).on('input paste change keyup cut', '.inputeNotes', function(){
    		var totalTaka = 0;
			var totalNotes = 0;

			var thousand = 0;
			var fiveHundred = 0;
			var oneHundred = 0;
			var fifty = 0;
			var twenty = 0;
			var ten = 0;
			var five = 0;
			var two = 0;
			var one = 0;

			thousand = $('#thousand').val();
			$('#thousandAmount').html(thousand * 1000).digits();
			totalTaka += thousand * 1000;
			totalNotes += thousand * 1;

			fiveHundred = $('#fiveHundred').val();
			$('#fiveHundredAmount').html(fiveHundred * 500).digits();
			totalTaka += fiveHundred * 500;
			totalNotes += fiveHundred * 1;

			oneHundred = $('#oneHundred').val();
			$('#oneHundredAmount').html(oneHundred * 100).digits();
			totalTaka += oneHundred * 100;
			totalNotes += oneHundred * 1;

			fifty = $('#fifty').val();
			$('#fiftyAmount').html(fifty * 50).digits();
			totalTaka += fifty * 50;
			totalNotes += fifty * 1;

			twenty = $('#twenty').val();
			$('#twentyAmount').html(twenty * 20).digits();
			totalTaka += twenty * 20;
			totalNotes += twenty * 1;

			ten = $('#ten').val();
			$('#tenAmount').html(ten * 10).digits();
			totalTaka += ten * 10;
			totalNotes += ten * 1;

			five = $('#five').val();
			$('#fiveAmount').html(five * 5).digits();
			totalTaka += five * 5;
			totalNotes += five * 1;

			two = $('#two').val();
			$('#twoAmount').html(two * 2).digits();
			totalTaka += two * 2;
			totalNotes += two * 1;

			one = $('#one').val();
			$('#oneAmount').html(one * 1).digits();
			totalTaka += one * 1;
			totalNotes += one * 1;




			$('.totalTaka').html(totalTaka).digits();
			$('.totalNotes').html(totalNotes).digits();
    	});

    	$(document).on('input paste change keyup cut', '#vaucherInp', function(){
    		var totalTaka = $('#totalTaka').html();
			var tAmount = totalTaka.replace(/,/g, '');
			var vaucherTaka = $('#vaucherInp').val();

			var cashTaka = tAmount - vaucherTaka;
			// alert(cashTaka);
			$('#cashTaka').html(cashTaka).digits();
    	});
    	


    	$(".inputeNotes").bind("keypress", function (e) {			
			var keyCode = e.which ? e.which : e.keyCode;
			// alert(keyCode);
			if (!(keyCode >= 48 && keyCode <= 57)) {

				// $(".error").css("display", "inline");
				return false;
			}else{
				// $(".error").css("display", "none");
			}

      	});
      	$(".vaucherInp").bind("keypress", function (e) {			
			var keyCode = e.which ? e.which : e.keyCode;
			if (!(keyCode >= 48 && keyCode <= 57)) {
				return false;
			}else{
			}
      	});
    	function validation(){
    		var thousand = false;
			var fiveHundred = false;
			var oneHundred = false;
			var fifty = false;
			var twenty = false;
			var ten = false;
			var five = false;
			var two = false;
			var one = false;

			if($('#thousand').val() !== ''){
				thousand = true;
			}
			if($('#fiveHundred').val() !== ''){
				fiveHundred = true;
			}
			if($('#oneHundred').val() !== ''){
				oneHundred = true;
			}
			if($('#fifty').val() !== ''){
				fifty = true;
			}
			if($('#twenty').val() !== ''){
				twenty = true;
			}
			if($('#ten').val() !== ''){
				ten = true;
			}
			if($('#five').val() !== ''){
				five = true;
			}
			if($('#two').val() !== ''){
				two = true;
			}
			if($('#one').val() !== ''){
				one = true;
			}

			if(thousand || fiveHundred || oneHundred || fifty || twenty || ten || five || two || one){
				return true;
			} else {
				alert('Please input at least one type of note.');
				return false;

			}
    	}
    </script>
    <script type="text/javascript">
    	$(document).on('click', '.cashDelete', function(event){          
          var data_trash_id = $(event.target).attr('data_trash_id');
          $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
          $("#matchPassword").val('');
          $("#passMsg").html('');
          $("#verifyToDeleteBtn").attr("data_trash_id", data_trash_id);
      });

    	$(document).on('click', '#verifyToDeleteBtn', function(event){
	        var remove_id = $(event.target).attr('data_trash_id');
	        console.log(remove_id);
	        $("#passMsg").html("").css({'margin':'0px'});          
          var pass = $("#matchPassword").val();
          $.ajax({
              url: "../ajaxcall/match_password_for_vaucher_credit.php",
              type: "post",
              data: { pass : pass },
              success: function (response) {
                  // alert(response);
                  if(response == 'password_matched'){
                      $("#verifyPasswordModal").hide();
                      ConfirmDialog('Are you sure delete cash info?');
                  } else {
                      $("#passMsg").html(response).css({'color':'red','margin-top':'10px'});
                  }
	            },
	            error: function(jqXHR, textStatus, errorThrown) {
	                console.log(textStatus, errorThrown);
	            }
          });
        
	        function ConfirmDialog(message){
	            $('<div></div>').appendTo('body')
	                            .html('<div><h4>'+message+'</h4></div>')
	                            .dialog({
	                                modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
	                                width: '40%', resizable: false,
	                                position: { my: "center", at: "center center-20%", of: window },
	                                buttons: {
	                                    Yes: function () {
	                                        $(this).dialog("close");
	                                        $.get("cash_calculator.php?remove_id="+remove_id, function(data, status){
		                                          // console.log(status);
		                                        	if(status == 'success'){
		                                            // window.location.href = 'cash_calculator.php';
		                                            	$.ajax({
																											url: '../ajaxcall/cash_calculator_data_search.php',
																											type: 'post',
																											data: {
																											  tableName: 'cash',
																											},
																											success: function(res){
																											  // alert(res);
																											  $('#cashTable').html(res);
																											},
																											error: function(jqXHR, textStatus, errorThrown){
																											  console.log(textStatus, errorThrown);
																											}
																									});
		                                        	}
	                                        });
	                                    },
	                                    No: function () {
	                                        $(this).dialog("close");
	                                    }
	                                },
	                                close: function (event, ui) {
	                                    $(this).remove();
	                                }
	                            });
	        };
	    });
	    $(document).on('click', '.edPermit', function(event){
          event.preventDefault();
          ConfirmDialog('You have no permission edit/delete this data !');
          function ConfirmDialog(message){
              $('<div></div>').appendTo('body')
                              .html('<div><h4>'+message+'</h4></div>')
                              .dialog({
                                  modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                  width: '40%', resizable: false,
                                  position: { my: "center", at: "center center-20%", of: window },
                                  buttons: {
                                      Ok: function () {
                                          $(this).dialog("close");
                                      },
                                      Cancel: function () {
                                          $(this).dialog("close");
                                      }
                                  },
                                  close: function (event, ui) {
                                      $(this).remove();
                                  }
                              });
          };
      });
    </script>
    <script type="text/javascript">
	    	function displayupdate(element){
		    		var cash_id = $(element).attr('data_edit_id');
		    		var dates = $(element).closest('tr').find('td:eq(1)').text();
		    		var note_1000 = $(element).closest('tr').find('td:eq(2)').text();
		    		var note_500 = $(element).closest('tr').find('td:eq(3)').text();
		    		var note_100 = $(element).closest('tr').find('td:eq(4)').text();
		    		var note_50 = $(element).closest('tr').find('td:eq(5)').text();
		    		var note_20 = $(element).closest('tr').find('td:eq(6)').text();
		    		var note_10 = $(element).closest('tr').find('td:eq(7)').text();
		    		var note_5 = $(element).closest('tr').find('td:eq(8)').text();
		    		var note_2 = $(element).closest('tr').find('td:eq(9)').text();
		    		var note_1 = $(element).closest('tr').find('td:eq(10)').text();
		    		
		    		$('#thousand').val(note_1000).change();
		    		$('#fiveHundred').val(note_500).change();
		    		$('#oneHundred').val(note_100).change();
		    		$('#fifty').val(note_50).change();
		    		$('#twenty').val(note_20).change();
		    		$('#ten').val(note_10).change();
		    		$('#five').val(note_5).change();
		    		$('#two').val(note_2).change();
		    		$('#one').val(note_1).change();
		    		$('#saveCashBtn').val('Update Cash');
		    		$('#cash_id').val(cash_id);
		    		$('.message').html('');
		    		$('#defaultOpen').trigger('click');
	    	}
    </script>
    <script type="text/javascript">
		function changeBorder(){
			// alert('asdfasd');
			$('.tablink').css('border-bottom', '15px solid #00589D');
		}
		function changeBorder2(){
			// alert('asdfasd');
			$('.tablink').css('border-bottom', '15px solid #00589D');
		}
	</script>
    <script>
		function openPage(pageName,elmnt,color) {
		  var i, tabcontent, tablinks;
		  // console.log(color);
		  tabcontent = document.getElementsByClassName("tabcontent");
		  for (i = 0; i < tabcontent.length; i++) {
		    tabcontent[i].style.display = "none";
		  }
		  tablinks = document.getElementsByClassName("tablink");
		  for (i = 0; i < tablinks.length; i++) {
		    tablinks[i].style.backgroundColor = "";
		  }
		  document.getElementById(pageName).style.display = "block";
		  elmnt.style.backgroundColor = color;
		}

		// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();
	</script>
		<script type="text/javascript">
  		$('.left_side_bar').height($('.main_bar').innerHeight());
  	</script>
  	<script type="text/javascript">
		    $(document).on("click", ".kajol_close, .cancel", function(){
		        $("#verifyPasswordModal").hide();
		    });
  	</script>
  	<script src="../js/common_js.js"> </script>
</body>
</html>