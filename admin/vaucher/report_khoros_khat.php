<?php 
	// phpinfo();
	session_start();
	if(!isset($_SESSION['username']) ){    
	    header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();	
	$_SESSION['pageName'] = 'report_khoros_khat';
	$project_name_id = $_SESSION['project_name_id'];

	require '../function/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>খরচ রিপোর্ট</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
	<link rel="stylesheet" href="../css/doinik_hisab.css">
	<link rel="stylesheet" href="../css/report.css?v=1.0.0">
	<script src="../js/jquery-printme.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<style type="text/css">
		.backcircle{
			margin-left: 0px;
		}
		.fixed_top{
			position: fixed;
			top: 0;
			left: 0;
        }
        .optionsCon{
        	/*height: 102px;*/
        }
        .chkboxStylish{
        	/*margin-left: 0px;*/
        }
        .separator{
        	/*margin-top: 5px;*/
        }
        .separatorHeight{
        	display: inline-block;
			height: 21px;
        }
        .advanced_search{
        	margin-top: 10px;
        	height: 36px;
        }
        .date_marfot_search{

        }
        .groupnames{
        	padding: 0px 10px;
        }
        #loader_img{
        	position: absolute;
			left: calc(50% - 40px);
			top: 155px;
			z-index: 9999;
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
		
		<div class="left_side_bar menu">
			<div id="left_all_menu_con">
				<h4 class="reportHeader"><b>রিপোর্ট</b></h4>  		
				<a href="../vaucher/report_joma.php" >জমা খাত</a>
				<a href="../vaucher/report_khoros_khat.php" class="active">খরচ খাত</a>
				<a href="../vaucher/report_nije_pabo.php">নিজে পাবো</a>
				<a href="../vaucher/report_paonader.php" >পাওনাদার</a>
				<a href="../vaucher/report_agrim_hisab.php">অগ্রিম হিসাব</a>
			</div>
		</div>
		<div class="main_bar" style="position: relative;">
			<img src="../img/loader_used.png" id="loader_img" style="display: inline-block;" width="80px">
			<?php
				$query = "SELECT * FROM project_heading WHERE id = '$project_name_id'";
				$show = $db->select($query);
				if ($show){
					while ($rows = $show->fetch_assoc()){
			    	?>
				    <!-- <div class="project_heading text-center" >      
				      <h2 class="text-center"><?php //echo $rows['heading']; ?></h2>
				    </div> -->
			  		<?php 
			        }
			    } 
			?>
			<div class="project_heading text-center" >      
		    	<h2 class="text-center" style="font-size: 23px; line-height: 22px;">খরচ খাত</h2>
		    </div>
		    <div class="backcircle">
				<a href="../vaucher/doinik_all_hisab.php">
					<img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
				</a>
		    </div>
			<div class="optionsCon">
				<div class="date_marfot_search">
					<span>
	    				<b>Date:</b>
	    				<select id="searchdate" style="height: 34px; width: 130px;">
	    					<option value="alldates">All Dates...</option>
	    					<?php
	    						// $sql = "SELECT DISTINCT group_date FROM debit_group WHERE project_name_id = '$project_name_id' ORDER BY group_date ASC";
	    						$sql = "SELECT DISTINCT entry_date FROM debit_group_data WHERE project_name_id = '$project_name_id' ORDER BY entry_date ASC";
	    						$rslt = $db->select($sql);
					            $row_no = mysqli_num_rows($rslt);
					            if ($rslt && $row_no > 0) {
					            	while ($row = $rslt->fetch_assoc()){
					            		$group_date_list = $row['entry_date'];
					            		if($group_date_list != '0000-00-00'){
					            			echo "<option value='".$group_date_list."'>". date("d-m-Y", strtotime($group_date_list)) ."</option>";
					            		}					            		
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
						<div class="separatorHeight"></div>
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
				

    			<!-- <div class="advanced_search">
    				<span class="chkboxStylish">
	    				<label class="conlabel">Advanced Search
							<input type="checkbox" id="showHide">
							<span class="checkmark"></span>
						</label>
						<div class="separatorHeight"></div>
	    			</span>
	    			<span class="monthYearcon" id="monthYearcon">
	    				<div class="separator"></div>
	    				<b>Year</b>
	    				<select id="yearvalue" style="width: 90px;"> 
	    					<option value="">Select...</option>
	    					<?php
	    						//$current_year = date("Y");
		    					//for($i = 2000; $i <= $current_year; $i++){
		    					//	echo "<option value='".$i."'>".$i."</option>";
		    					//}
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
    			</div>  -->   			
			</div>
			
    		<div class="srchCon">
    			<span class="printText" id="printBtn"><b>Print &nbsp;&nbsp; |</b></span>
    			<span class="printText"><b>&nbsp;&nbsp;Download</b></span>
    			<span class="groupnames">
    				<?php
    					$html = group_name_from_debit_group_tbl_select_box($db, $project_name_id);
    					echo $html;
    				?>
    			</span>
    			<span id="biboronCon" style="display: inline-block;">
    			</span>
    			<span class="seachright">    				
    				<style type="text/css">
    					.searchCon{
    						width: 260px;
    					}
    					#search:focus + #searchBtn {
    						border: 1px solid transparent;
    						border-left: 1px solid #66afe9;
    						box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
    					}
    					#searchBtn{
    						position: absolute;
							right: 1px;
							top: 1px;
							padding: 5px 14px;
							border-radius: 0px 3px 3px 0px;
							border: 1px solid transparent;
							border-left: 1px solid #ddd;
							transition: all .5s;
    					}
    					@media screen and (-webkit-min-device-pixel-ratio:0) and (min-resolution:.001dpcm) { 
							#searchBtn{
								/*right: 3px;*/
							}
						}
    					#searchBtn:hover{
    						background-color: #66afe9;
    						/*border: 1px solid transparent;
							border-left: 1px solid #66afe9;*/
    						color: #fff;
    						transition: all .5s;
    					}
    				</style>
    				<div class="searchCon">
    					<!-- <b>Search</b> -->
	    				<input type="text" id="search" class="form-control option-contol-search" placeholder="Search...">
						<button type="submit" id="searchBtn"><i class="fa fa-search"></i></button>
					</div>
    			</span>
    		</div>
    		<div id="table_container">
    			<!-- id=tableshow placed here -->
    		</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).on('change','#headerGroupNameList', function() {
			var search_date = $("#searchdate option:selected").val();
	        var khoros_marfot_name = $(this).children("option:selected").val();
	        
	        // alert(search_date);
	        if(search_date == 'alldates' && khoros_marfot_name == 'none') {
	            show_only_khoros_marfot_wise_data(search_date, khoros_marfot_name);
	            $("#biboronCon").html('');
	        } else if(search_date == 'alldates' && khoros_marfot_name != 'none'){
	            show_only_khoros_marfot_wise_data(search_date, khoros_marfot_name);
	            show_biboron_list(search_date, khoros_marfot_name);
	        } else if(search_date != 'alldates' && khoros_marfot_name == 'none'){
	        	show_only_khoros_marfot_wise_data(search_date, khoros_marfot_name);
	        } else if(search_date != 'alldates' && khoros_marfot_name != 'none'){
	            show_only_khoros_marfot_wise_data(search_date, khoros_marfot_name);
	            show_biboron_list(search_date, khoros_marfot_name);
	        } else {
	            alert("Logic error !");
	        }
	    });
	    function show_only_khoros_marfot_wise_data(search_date, khoros_marfot_name){
	        $("#loader_img").show();
	        $.ajax({
	            url: "../ajaxcall_report/report_khoros_marfot_name_wise_data.php",
	            type: "post",
	            data: {
	              search_date     : search_date,
	              khoros_marfot_name  : khoros_marfot_name
	            },
	            success: function (response) {
	                // alert(response);
	                $('#table_container').html(response);
	                heightChange();
	            },
	            complete:function(data){
	              $("#loader_img").hide();
	            },
	            error: function(jqXHR, textStatus, errorThrown) {
	                console.log(textStatus, errorThrown);
	            }
	        });
	    }
	    function show_biboron_list(search_date, khoros_marfot_name){
	        $("#loader_img").show();
	        $.ajax({
	            url: "../ajaxcall/show_biboron_list_box_khoros_marfot_name_wise.php",
	            type: "post",
	            data: {
	              search_date     : search_date,
	              khoros_marfot_name  : khoros_marfot_name },
	            success: function (response) {
	                // alert(response);
	                $('#biboronCon').html(response).show();
	                $("#descriptionGroupList").css('width', '280px');
	                $('#descriptionGroupList').select2().on('select2:open', function(e){
	                    $('.select2-search__field').attr('placeholder', 'Search...');          
	                });
	            },
	            complete:function(data){
	              $("#loader_img").hide();
	            },
	            error: function(jqXHR, textStatus, errorThrown) {
	                console.log(textStatus, errorThrown);
	            }
	        });
	    }
	    $(document).on('change','#descriptionGroupList', function() {
			var search_date = $("#searchdate option:selected").val();
			var khoros_marfot_name = $("#headerGroupNameList option:selected").val();
	        var biboron = $(this).children("option:selected").val();	        
	        // alert(search_date +'/'+khoros_marfot_name +'/'+ biboron);
	        if(biboron == 'none'){
	            show_only_khoros_marfot_wise_data(search_date, khoros_marfot_name);
	        } else {
	            group_desc_and_group_name_wise_data(search_date, khoros_marfot_name, biboron);
	        }
	    });
	    function group_desc_and_group_name_wise_data(search_date, khoros_marfot_name, biboron){
	        $("#loader_img").show();
	        $.ajax({
	            url: "../ajaxcall_report/report_group_name_and_desc_wise_data.php",
	            type: "post",
	            data: {
	                    search_date     : search_date,
	                    khoros_marfot_name  : khoros_marfot_name,
	                    biboron         : biboron
	                  },
	            success: function (response) {
	                // alert(response);                         
	                $('#table_container').html(response);          
	                heightChange();
	            },
	            complete:function(data){
	                $("#loader_img").hide();
	            },
	            error: function(jqXHR, textStatus, errorThrown) {
	                console.log(textStatus, errorThrown);
	            }
	        });
	    }
	    function no_search_way(){
	        var htm = '<table id="mytable" class="table table-bordered" style="font-size: 20px;">';
	            htm +=    '<tr>';
	            htm +=      '<td style="text-align: center;">খরচ মারফোতের নাম নির্বাচন করুন ।</td>';
	            htm +=    '</tr>';
	            htm += '</table>';
	        // alert(htm);
	        // heightChange();
	    }
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
			$("#loader_img").show();
			$.ajax({
		        url: "../ajaxcall_report/report_khoros_khat_fromdate_todate_search.php",
		        type: "post",
		        data: {
		        	fromdate 	: fromdate, 
		        	todate 		: todate,
		        },
		        success: function (response) {
		          // alert(response);
		          $('#table_container').html(response);
		          heightChange();
		        },
	            complete:function(data){
	                $("#loader_img").hide();
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
			function searchKhorosKhat(searchTxt){
				$("#loader_img").show();
			    $.ajax({
			        url: "../ajaxcall_report/report_khoros_khat_search.php",
			        type: "post",
			        data: { searchTxt : searchTxt },
			        success: function (response) {
			          // alert(response);
			          $('#table_container').html(response);
			          heightChange();
			        },			        
		            complete:function(data){
		                $("#loader_img").hide();
		            },
			        error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }
			    });
			}
			var searchTxt = $('#search').val();
			// alert(searchTxt);
			searchKhorosKhat(searchTxt);		
		});

		function dateSearch(searchdate){
			$("#loader_img").show();
			$.ajax({
		        url: "../ajaxcall_report/report_khoros_khat_date_wise_search.php",
		        type: "post",
		        data: {
		        	searchdate 	: searchdate,
		        },
		        success: function (response) {
					// alert(response);
					$('#table_container').html(response);
					heightChange();
		        },
		        complete:function(data){
	              	$("#loader_img").hide();
	            },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		}
		$(document).on('change', '#searchdate', function(){
			var searchdate 	= $("#searchdate").val();
			$('#headerGroupNameList').val('none');
			$('#headerGroupNameList').select2().on('select2:open', function(e){
	          	$('.select2-search__field').attr('placeholder', 'Search...');          
	      	});
	      	$("#biboronCon").html('');
			dateSearch(searchdate);
		});

		function yearMonthSearch(monthvalue, yearvalue){
			$("#loader_img").show();
			$.ajax({
		        url: "../ajaxcall_report/report_khoros_khat_year_month_search.php",
		        type: "post",
		        data: {
		        	monthvalue 	: monthvalue, 
		        	yearvalue 	: yearvalue,
		        },
		        success: function (response) {
		          // alert(response);
		          $('#table_container').html(response);
		          heightChange();
		        },
		        complete:function(data){
	              	$("#loader_img").hide();
	            },
		        error: function(jqXHR, textStatus, errorThrown) {
		           console.log(textStatus, errorThrown);
		        }
		    });
		}
		$(document).on('change', '#monthvalue', function(){
			var monthvalue 	= $("#monthvalue").val();
			var yearvalue 		= $("#yearvalue").val();
			$("#fromdate").val('');
			$("#todate").val('');
			yearMonthSearch(monthvalue, yearvalue);
		});
		$(document).on('change', '#yearvalue', function(){
			var monthvalue 	= $("#monthvalue").val();
			var yearvalue 		= $("#yearvalue").val();
			$("#fromdate").val('');
			$("#todate").val('');		
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
				resetSearchItems('noid');
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
				$('#headerGroupNameList').val('none').change();
				$('#searchdate').val('alldates').change();
				// $('.selctpik').selectpicker('refresh');	
				// $('.selctpikYear').selectpicker('refresh');
			}
		}
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
      	$('#headerGroupNameList').select2().on('select2:open', function(e){
          $('.select2-search__field').attr('placeholder', 'Search...');          
      	});
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
		$("#searchdate").val('alldates').trigger('change');
	</script>
	<script src="../js/common_js.js"> </script>
</body>
</html>