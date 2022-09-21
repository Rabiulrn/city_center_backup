<?php 
	// phpinfo();
	session_start();
	if(!isset($_SESSION['username']) ){    
	    header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$_SESSION['pageName'] = 'report_paonader';
	$project_name_id = $_SESSION['project_name_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>পাওনাদার রিপোর্ট</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

	<link rel="stylesheet" href="../css/voucher.css">
	<link rel="stylesheet" href="../css/doinik_hisab.css">
	<link rel="stylesheet" href="../css/report.css">
	<script src="../js/jquery-printme.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<style type="text/css">
		#tableshow tr:last-child td {
			/*border-bottom: 1px solid transparent !important;*/
		}
		.backcircle{
			margin-left: 0px;
		}
		.fixed_top{
			position: fixed;
			top: 0;
			left: 0;
            /*border-right: 1px solid #ddd;
            background-color: #F8F8F8;*/
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
				<a href="../vaucher/report_joma.php" >জমা খাত</a>
				<a href="../vaucher/report_khoros_khat.php">খরচ খাত</a>
				<a href="../vaucher/report_nije_pabo.php">নিজে পাবো</a>
				<a href="../vaucher/report_paonader.php" class="active">পাওনাদার</a>
				<a href="../vaucher/report_agrim_hisab.php">অগ্রিম হিসাব</a>
			</div>
		</div>
		<div class="main_bar">
			<?php
				$ph_id = $_SESSION['project_name_id'];
				$query = "SELECT * FROM project_heading WHERE id = $ph_id";
				$show = $db->select($query);
				if ($show) {
					while ($rows = $show->fetch_assoc()) {
			    		?>
						<!-- <div class="project_heading text-center" >      
							<h2 class="text-center"><?php echo $rows['heading']; ?></h2>
						</div> -->
			  			<?php 
			        }
			    } 
			?>
			<div class="project_heading text-center" >      
		    	<h2 class="text-center" style="font-size: 23px; line-height: 22px;">পাওনাদার</h2>
		    </div>
			<div class="backcircle">
				<a href="../vaucher/doinik_all_hisab.php">
					<img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
				</a>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="optionsCon">
						<span>
		    				<b>Date:</b>
		    				<select id="searchdate" style="height: 34px; width: 130px;">
		    					<option value="alldates">All Dates...</option>
		    					<?php
		    						$sql = "SELECT DISTINCT jp_date FROM entry_jara_pabe WHERE project_name_id = '$project_name_id' ORDER BY jp_date ASC";
		    						$rslt = $db->select($sql);
						            $row_no = mysqli_num_rows($rslt);
						            if ($rslt && $row_no > 0) {
						            	while ($row = $rslt->fetch_assoc()){
						            		echo "<option value='".$row['jp_date']."'>". date("d-m-Y", strtotime($row['jp_date'])) ."</option>";
						            	}
						            }
		    					?>
		    				</select>
		    			</span>
		    			<span class="chkboxStylish">
		    				<label class="conlabel">Advanced Search
								<input type="checkbox" id="showHide">
								<span class="checkmark"></span>
							</label>
		    			</span>
		    			<span class="monthYearcon" id="monthYearcon">
		    				<div class="separator"></div>		    				
		    				<b>Year</b>
		    				<select id="yearvalue" style="width: 90px;"> 
		    					<option value="">Select...</option>
		    					<?php
		    						$current_year = date("Y");	    						
			    					for($i = 2000; $i <= $current_year; $i++){
			    						echo "<option value='".$i."'>".$i."</option>";
			    					}
		    					?>
		    				</select>
		    				<b>Month</b>
		    				<select id="monthvalue" style="width: 100px;">
		    					<option value="">Select...</option>
		    					<option value="01">January</option>
		    					<option value="02">February</option>
		    					<option value="03">March</option>
		    					<option value="04">April</option>
		    					<option value="05">May</option>
		    					<option value="06">June</option>
		    					<option value="07">July</option>
		    					<option value="08">August</option>
		    					<option value="09">September</option>
		    					<option value="10">October</option>
		    					<option value="11">November</option>
		    					<option value="12">December</option>
		    				</select>
		    			</span>
		    			<span id="advancedFromTo">
		    				<div class="separator"></div>
		    				<b>From</b>
		    				<input type="text" name="fromdate" id="fromdate" class="form-control option-contol" placeholder="dd-mm-yyyy">
		    				<b>To</b>
		    				<input type="text" name="todate" id="todate" class="form-control option-contol" placeholder="dd-mm-yyyy">
		    			</span>		    			
					</div>
				</div>
			</div>
    		<div class="srchCon">
    			<span class="printText" id="printBtn"><b>Print &nbsp;&nbsp; |</b></span>
    			<span class="printText"><b>&nbsp;&nbsp;Download</b></span>
    			<span class="seachright">
    				<b>Search</b>
    				<input type="text" name="search" id="search" class="form-control option-contol-search" placeholder="Search...">
    			</span>
    		</div>
    		
    		<div id="table-con">
    			<!-- <table class="tableshow" id="tableshow" style="border: 1px solid #ddd; border-collapse: collapse; font-size: 14px;"> -->
	    			<?php
			    // 		$query = "SELECT * FROM jara_pabe WHERE project_name_id = '$project_name_id'";
			    //         $result = $db->select($query);
			    //         if ($result && mysqli_num_rows($result) > 0) {
			    //         	$i = 1;
			    //         	while ($row = $result->fetch_assoc()){
			    //         		$pabe_id = $row['pabe_id'];
			    //         		$pabe_date = $row['pabe_date'];
			    //         		$pabe_name = $row['pabe_name'];
			    //         		$pabe_description = $row['pabe_description'];
			    //         		$pabe_amount = trim($row['pabe_amount']);
			    //         		if($pabe_amount == ''){
			    //         			$pabe_amount = 0;
			    //         		}
			    //         		echo "<tr style='background-color: #8e8e8e;'>";
				   //          		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" .$i . "</th>";
				   //          		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'  width = '100px'>" . date("d-m-Y", strtotime($pabe_date)) . "</th>";
				   //          		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $pabe_name . "</th>";
				   //          		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . $pabe_description . "</th>";
				   //          		echo "<th style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($pabe_amount, 2) . "</th>";			            		
			    //         		echo "</tr>";

			    //         		$sub_total = 0;
			    //         		$sql = "SELECT * FROM entry_jara_pabe WHERE jara_pabe_id ='$pabe_id' AND project_name_id = '$project_name_id' ORDER BY jp_date ASC";
			    //         		$rslt = $db->select($sql);
			    //         		if (mysqli_num_rows($rslt) > 0) {
							// 		while ($rslt_row = $rslt->fetch_assoc()) {
							// 			$jp_id = trim($rslt_row['jp_id']);
					  //           		$jp_name = trim($rslt_row['jp_name']);
					  //           		$jp_description = trim($rslt_row['jp_description']);
					  //           		$jp_amount = trim($rslt_row['jp_amount']);
					  //           		$jp_date = trim($rslt_row['jp_date']);
					  //           		if($jp_amount == ''){
					  //           			$jp_amount = 0;
					  //           		}
					  //           		$sub_total += $jp_amount;
							// 			echo "<tr>";
					  //           			echo "<td></td>";
					  //           			echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($jp_date)) . "</td>";
					  //           			echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $jp_name . "</td>";
						 //            		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $jp_description . "</td>";
						 //            		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($jp_amount, 2) . "</td>";				            			
							// 			echo "</tr>";
							// 		}
							// 	}
							// 	echo "<tr><td colspan='4' style='border: 1px solid #ddd; padding:3px 10px; text-align: right;'>মোট এন্ট্রিঃ</td><td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($sub_total, 2) . "</td></tr>";
							// 	echo "<tr><td colspan='5' style='border: 1px solid #ddd; padding:3px 10px; border-left: 1px solid transparent; border-right: 1px solid transparent;'>&nbsp;</td></tr>";
			    //         		$i++;
			    //         	}
			    //         } else {
							// echo '<tr><td style="border: 1px solid #ddd !important; padding:3px 10px;">Data is not found !</tr></td>';
			    //         }
	            	?>
	            <!-- </table> -->
    		</div>    		
		</div>
	</div>




	<script type="text/javascript">
		$("#fromdate").datepicker({
	    	dateFormat: "dd-mm-yy",
	    	changeMonth: true,
	    	changeYear: true,
		});
		
		$("#todate").datepicker({
	    	dateFormat: "dd-mm-yy",
	    	changeMonth: true,
	    	changeYear: true,
		});

		function fromTodateSearch(fromdate, todate){
			$.ajax({
		        url: "../ajaxcall_report/report_paonader_fromdate_todate_search.php",
		        type: "post",
		        data: {
		        	fromdate 	: fromdate, 
		        	todate 		: todate,
		        },
		        success: function (response) {
		          // alert(response);
		          $('#table-con').html(response);
		          heightChange();
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		}
		$(document).on('change', '#fromdate', function(){
			var fromdate 	= $("#fromdate").val();
			var todate 		= $("#todate").val();
			fromTodateSearch(fromdate, todate);
		});
		$(document).on('change', '#todate', function(){
			var fromdate 	= $("#fromdate").val();
			var todate 		= $("#todate").val();
			fromTodateSearch(fromdate, todate);
		});
	</script>
	<script type="text/javascript">
		$(document).on('input', '#search', function(){
			function searchNijePabo(searchTxt){
			    $.ajax({
			        url: "../ajaxcall_report/report_paonader_search.php",
			        type: "post",
			        data: { searchTxt : searchTxt },
			        success: function (response) {
			          // alert(response);
			          $('#table-con').html(response);
			          heightChange();
			        },
			        error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }
			    });
			}
			var searchTxt = $('#search').val();
			// alert(searchTxt);
			searchNijePabo(searchTxt);
		
		});

		function dateSearch(searchdate){
			$.ajax({
		        url: "../ajaxcall_report/report_paonader_date_wise_search.php",
		        type: "post",
		        data: {
		        	searchdate 	: searchdate,
		        },
		        success: function (response) {
		          // alert(response);
		          $('#table-con').html(response);
		          heightChange();
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		}
		$(document).on('change', '#searchdate', function(){
			var searchdate 	= $("#searchdate").val();
			dateSearch(searchdate);
		});

		function yearMonthSearch(monthvalue, yearvalue){
			$.ajax({
		        url: "../ajaxcall_report/report_paonader_year_month_search.php",
		        type: "post",
		        data: {
		        	monthvalue 	: monthvalue, 
		        	yearvalue 	: yearvalue,
		        },
		        success: function (response) {
					// alert(response);
					$('#tableshow').html(response);
					heightChange();
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		}
		$(document).on('change', '#monthvalue', function(){
			var monthvalue 	= $("#monthvalue").val();
			var yearvalue 		= $("#yearvalue").val();		
			yearMonthSearch(monthvalue, yearvalue);
		});
		$(document).on('change', '#yearvalue', function(){
			var monthvalue 	= $("#monthvalue").val();
			var yearvalue 		= $("#yearvalue").val();		
			yearMonthSearch(monthvalue, yearvalue);		
		});
	</script>
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
	<script type="text/javascript">	
		$(document).on('change', '#showHide', function(){
			if($('#showHide').is(":checked")){
				$('#advancedFromTo').show();
				$('#monthYearcon').show();
				resetSearchItems('noid');
				 // alert("Checkbox is checked.");
			} else {
				// resetSearchItems('noid');
				$('#advancedFromTo').hide();
				$('#monthYearcon').hide();
			}
		});
		function resetSearchItems(eventOcurId){
			// alert(eventOcurId);
			if(eventOcurId == 'noid'){
				$('#fromdate').val('');
				$('#todate').val('');
				$('#monthvalue').val('').change();						
				$('#yearvalue').val(new Date().getFullYear()).change();				
				$('#search').val('');
				$('#searchdate').val('alldates').change();
				// $('.selctpik').selectpicker('refresh');	
				// $('.selctpikYear').selectpicker('refresh');
			}
		}
	</script>

	<script type="text/javascript">
		// $('.selctpik').selectpicker();
		// var newyear = new Date().getFullYear();
		// $('.selctpikYear').selectpicker('val', newyear);

		$('#searchdate').select2().on('select2:open', function(e){
          $('.select2-search__field').attr('placeholder', 'Search...');          
      	});

		$('#yearvalue').select2().on('select2:open', function(e){
          $('.select2-search__field').attr('placeholder', 'Search...');          
      	});

      	$('#monthvalue').select2({ minimumResultsForSearch: -1 }).on('select2:open', function(e){
          // $('.select2-search__field').attr('placeholder', 'Search...');          
      	});
      	$('#searchdate').val('alldates').change();
	</script>
	<script type="text/javascript">	
		$('#printBtn').click(function(){
			var printme = document.getElementById('tableshow');
			var wme	= window.open("", "", "width=900,height=700, scrollbars=yes");
			wme.document.write(printme.outerHTML);
			// wme.document.write('<style>#tableshow tr:last-child td {border-bottom: 1px solid transparent !important;}</style>');
			wme.document.close();
			wme.focus();
			wme.print();
			wme.close();
		});
	</script>
	<script src="../js/common_js.js"> </script>
</body>
</html>