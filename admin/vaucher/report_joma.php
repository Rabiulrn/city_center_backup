<?php 
	// phpinfo();
	session_start();
	if(!isset($_SESSION['username']) ){    
	    header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$_SESSION['pageName'] = 'report';
	
	$project_name_id = $_SESSION['project_name_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>জমা রিপোর্ট</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
	<link rel="stylesheet" href="../css/doinik_hisab.css">
	<link rel="stylesheet" href="../css/report.css?v=1.0.0">
	<!-- <link rel="stylesheet" href="../css/report_print.css" media="print" /> -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
	<style type="text/css">
		.fixed_top{
			position: fixed;
			top: 0;
			left: 0;
            /*border-right: 1px solid #ddd;
            background-color: #F8F8F8;*/
        }
        .backcircle{
			margin-left: 0px;
		}
		.select2-selection__rendered {
		    line-height: 32px !important;
		}
		.select2-container .select2-selection--single {
		    height: 35px !important;
		}
		.select2-selection__arrow {
		    height: 34px !important;
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
				<a href="../vaucher/report_joma.php" class="active">জমা খাত</a>
				<a href="../vaucher/report_khoros_khat.php">খরচ খাত</a>
				<a href="../vaucher/report_nije_pabo.php">নিজে পাবো</a>
				<a href="../vaucher/report_paonader.php">পাওনাদার</a>
				<a href="../vaucher/report_agrim_hisab.php">অগ্রিম হিসাব</a>
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
		    	<h2 class="text-center" style="font-size: 23px; line-height: 22px;">জমা খাত</h2>
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
		    						$sql = "SELECT DISTINCT credit_date FROM vaucher_credit WHERE project_name_id = '$project_name_id' ORDER BY credit_date ASC";
		    						$rslt = $db->select($sql);
						            $row_no = mysqli_num_rows($rslt);
						            if ($rslt && $row_no > 0) {
						            	while ($row = $rslt->fetch_assoc()){
						            		$credit_date_list = $row['credit_date'];
						            		if($credit_date_list == '0000-00-00'){
												$credit_date_list ='';
												//then date will show 01/01/1970
						            		}
						            		echo "<option value='".$row['credit_date']."'>". date("d-m-Y", strtotime($credit_date_list)) ."</option>";
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
    			<span class="printText" id="download"><b>&nbsp;&nbsp;Download</b></span>
    			<span class="seachright">
    				<b>Search</b>
    				<input type="text" name="search" id="search" class="form-control option-contol-search" placeholder="Search...">	    				
    			</span>
    			&nbsp;&nbsp;
    			<button class="btn btn-danger btn-arro-back" onclick="back_before_view()">&#x21a9; Back</button>
    		</div>
    		<table class="tableshow" id="tableshow" style="border: 1px solid #ddd; font-size: 14px; border-collapse: collapse; width: 100%;">
    			<tr style="border: 1px solid #ddd; background-color: #8e8e8e;">
    				<th width="100px" style="border: 1px solid #ddd;  padding: 3px 10px;">ক্রমিক নং</th>
    				<th style="border: 1px solid #ddd;  padding: 3px 10px;">মারফোত নাম</th>
    				<th style="border: 1px solid #ddd;  padding: 3px 10px;">জমা</th>
    				<th width="100px" style="border: 1px solid #ddd;  padding: 3px 10px;">তারিখ</th>
    			</tr>
    		
	    		<?php
		    		$query = "SELECT * FROM vaucher_credit WHERE project_name_id = '$project_name_id'";
		            $result = $db->select($query);
		            $row_number = mysqli_num_rows($result);
		    //         if ($result && $row_number > 0) {
		    //         	$i = 1;
		    //         	$credit_amount_total = 0;
		    //         	while ($row = $result->fetch_assoc()){
		    //         		$credit_name = $row['credit_name'];
			   //          	$credit_amount = $row['credit_amount'];
			   //          	$credit_date = $row['credit_date'];

			   //          	if($credit_amount == ''){
			   //          		$credit_amount = 0;
			   //          	}
			   //          	$credit_amount_total += $credit_amount;
			   //          	if($credit_date == '0000-00-00'){
						// 		$credit_date ='';
						// 		//then date will show 01/01/1970
			   //          	}
		    //         		echo "<tr>";
		    //         		echo "<td class='cenText' style='border: 1px solid #ddd; text-align:center'>" .$i . "</td>";
		    //         		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . $credit_name . "</td>";
		    //         		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($credit_amount, 2) . "</td>";
		    //         		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . date("d-m-Y", strtotime($credit_date)) . "</td>";
		    //         		echo "</tr>";
		    //         		$i++;
		    //         	}
		    //         	echo "<tr>";
		    //         		echo "<td colspan='2' style='border: 1px solid #ddd; text-align:right'>মোটঃ </td>";
		            		
		    //         		echo "<td style='border: 1px solid #ddd; padding:3px 10px;'>" . number_format($credit_amount_total, 2) . "</td>";
		    //         	echo "</tr>";		
		    //         } else {
						// echo "<tr><td colspan='4' class='cenText'>Data is not found !</tr></td>";
		    //         }
	            ?>
            </table>
            <!-- <div id="credit_name_wise_show">
            	<table class="tableshow">
            		<tr>
	            		<tr style="border: 1px solid #ddd; background-color: #8e8e8e;">
	    				<th width="100px" style="border: 1px solid #ddd; padding: 3px 10px;">ক্রমিক নং</th>
	    				<th style="border: 1px solid #ddd; padding: 3px 10px;">মারফোত নাম</th>
	    				<th style="border: 1px solid #ddd; padding: 3px 10px;">জমা</th>
	    				<th width="100px" style="border: 1px solid #ddd; padding: 3px 10px;">তারিখ</th>
	    			</tr>
            	</table>
            	
            </div> -->
            <div class="back-arrow-con">
            	<button class="btn btn-danger btn-arro-back" onclick="back_before_view()">&#x21a9; Back</button>
            </div>
            
		</div>
	</div>
	<script type="text/javascript">
		$(document).on('input', '#search', function(){
			function searchJoma(searchTxt){
			    $.ajax({
			        url: "../ajaxcall_save_update/report_joma_search.php",
			        type: "post",
			        data: { searchTxt : searchTxt },
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
			var searchTxt = $('#search').val();
			searchJoma(searchTxt);
		
		});
	</script>
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
		        url: "../ajaxcall_save_update/report_joma_fromdate_todate_search.php",
		        type: "post",
		        data: {
		        	fromdate 	: fromdate, 
		        	todate 		: todate,
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




		function yearMonthSearch(monthvalue, yearvalue){
			$.ajax({
		        url: "../ajaxcall_save_update/report_joma_year_month_search.php",
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



		function dateSearch(searchdate){
			$.ajax({
		        url: "../ajaxcall_save_update/report_joma_date_wise_search.php",
		        type: "post",
		        data: {
		        	searchdate 	: searchdate,
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
		$(document).on('change', '#searchdate', function(){
			var searchdate 	= $("#searchdate").val();
			dateSearch(searchdate);
		});
	</script>
	<script type="text/javascript">
		$('#searchdate').select2().on('select2:open', function(e){
          $('.select2-search__field').attr('placeholder', 'Search...');          
      	});

		$('#yearvalue').select2().on('select2:open', function(e){
          $('.select2-search__field').attr('placeholder', 'Search...');          
      	});

      	$('#monthvalue').select2({ minimumResultsForSearch: -1 }).on('select2:open', function(e){
          // $('.select2-search__field').attr('placeholder', 'Search...');          
      	});
      	$('#searchdate').val("alldates").change();
	</script>
	<script type="text/javascript">	
		// $(document).on('change', '#showHide', function(){
		// 	if($('#showHide').is(":checked")){
		// 		$('#advancedFromTo').show();
		// 		$('#monthYearcon').show();
		// 		 // alert("Checkbox is checked.");
		// 	} else {
		// 		$('#advancedFromTo').hide();
		// 		$('#monthYearcon').hide();
		// 	}
		// });
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
		$('#printBtn').click(function(){
			var printme = document.getElementById('tableshow');
			var wme	= window.open("", "", "width=900,height=700, scrollbars=yes");
			wme.document.write(printme.outerHTML);
			wme.document.close();
			wme.focus();
			wme.print();
			wme.close();
		});
	</script>
	<script type="text/javascript">
		// var pdfdoc = new jsPDF();

		// $('#download').click(function(){
		// 	pdfdoc.fromHTML($('#tableshow').html(), 10, 10, {
		// 		'width': 110,
		// 	});
		// 	pdfdoc.save('joma_khat_report.pdf');
		// });



		$('#download').click(function(){
	    // var pdf = new jsPDF('p', 'pt', 'a4');
	    // pdf.setFontSize(15);
	    // // pdf.text(170, 13, 'Status Report');
	    // // pdf.setFontSize(10);
	    // var source = $('#tableshow')[0],
	    // specialElementHandlers = {
	    //     '#bypassme': function (element, renderer) {
	    //         return true
	    //     }
	    // };
	    // margins = {
	    //     top: 80,
	    //     bottom: 60,
	    //     left: 40,
	    //     width:'100%'
	    // };
	    // pdf.fromHTML(
	    // source,
	    // margins.left,
	    // margins.top, {
	    //     'width': margins.width,
	    //     // 'elementHandlers': specialElementHandlers
	    // },

	    // function (dispose) {
	    //     pdf.save('Test.pdf');
	    // }, margins);


		});
	</script>
	<script type="text/javascript">
		var all_row;
		function show_credit_name_wise_joma(credit_name) {
			all_row = $("#tableshow").html();
			$.ajax({
		        url: "../ajaxcall_save_update/report_joma_credit_name_wise_view.php",
		        type: "post",
		        data: {
		        	credit_name 	: credit_name,
		        },
		        success: function (response) {
		          // alert(response);
		          $('#tableshow').html(response);
		          $('.btn-arro-back').show();
		          heightChange();
		        },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		}
		function back_before_view(){
			$('#tableshow').html(all_row);
			$(".btn-arro-back").hide();
		}
	</script>
	<script src="../js/common_js.js"> </script>
</body>
</html>