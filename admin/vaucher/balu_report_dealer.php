<?php 
	// phpinfo();
	session_start();
	if(!isset($_SESSION['username']) ){    
	    header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$_SESSION['pageName'] = 'balu_report_dealer';
	
	$project_name_id = $_SESSION['project_name_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>ডিলার রিপোর্ট হিসাব</title>
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
		.bootstrap-select{
			width: 180px !important;
		}
		.selctpikYear{
			width: 80px !important;
		}
		.selctpik{
			width: 110px !important;
		}
		.tableshow tr td, .tableshow tr th{
			border: 1px solid #777;
		}
		.tableshow tr:hover{
			background-color: transparent;
		}
		.tableshow tr th {
		    background-color: #c4c4c4;
		}
		.tableshow tr:last-child td{
			border-bottom: 1px solid transparent;
			height: 0px !important;
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
				<a href="../vaucher/balu_report_buy_hisab.php" >ক্রয় অনুযায়ী </a>
				<a href="../vaucher/balu_report_sell_hisab.php">বিক্রয় অনুযায়ী </a>
				<!-- <a href="../vaucher/rod_report_others_category.php">রড ও অন্যান্ন ক্যাটাগরি</a> -->
				 <a href="../vaucher/balu_report_dealer.php" class="active">ডিলার অনুযায়ী </a>
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
					    <!-- <div class="project_heading text-center" >      
					      <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
					    </div> -->
		  		<?php 
					}
				} 
		  	?> 
		  	<div class="project_heading text-center" >      
		    	<h2 class="text-center" style="font-size: 23px; line-height: 22px;">ডিলার হিসাব রিপোর্ট</h2>
		    </div>
		  	<div class="backcircle">
		      <a href="../vaucher/balu_index.php">
		        <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
		      </a>
		    </div>
		    <div class="row">
				<div class="col-md-12">
					<div class="optionsCon">
						<span style="position: relative; top: -13px;">
		    				<b>Search:</b>
		    				<select class="selctpik2" id="searchDealer">
		    					<option value="alldealers">All Dealers</option>
		    					<?php
		    						$sql = "SELECT DISTINCT dealer_id, dealer_name FROM balu_dealer WHERE project_name_id = '$project_name_id' ORDER BY dealer_name ASC";
		    						$rslt = $db->select($sql);
						            $row_no = mysqli_num_rows($rslt);
						            if ($rslt && $row_no > 0) {
						            	while ($row = $rslt->fetch_assoc()){
						            		echo "<option value='".$row['dealer_id']."'>".$row['dealer_name'] ."</option>";
						            	}
						            }
		    					?>
		    				</select>
		    			</span>
		    			<span class="chkboxStylish">
		    				<label class="conlabel" style="width: 120px;">
		    					Advanced <br>Search
								<input type="checkbox" id="showHide">
								<span class="checkmark"></span>
							</label>
		    			</span>
		    			<span id="advancedFromTo" style="position: relative; top: -13px;">
		    				<div class="separator"></div>
		    				<b>From</b>
		    				<input type="text" name="fromdate" id="fromdate" class="form-control option-contol" placeholder="dd-mm-yyyy">
		    				<b>To</b>
		    				<input type="text" name="todate" id="todate" class="form-control option-contol" placeholder="dd-mm-yyyy">
		    			</span>
		    			<span class="monthYearcon" id="monthYearcon" style="position: relative; top: -13px;">
		    				<div class="separator"></div>
		    				<!-- <b>Month</b>
		    				<select class="selctpik" id="monthvalue" style="width: 80px;">
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
		    				<b>Year</b>
		    				<select class="selctpikYear" id="yearvalue"> 
		    					<option value="">Select...</option>
		    					<?php		    						
			    					for($i = 2000; $i <= 2100; $i++){
			    						echo "<option value='".$i."'>".$i."</option>";
			    					}
		    					?>
		    				</select> -->
		    			</span>
					</div>
				</div>
			</div>
    		<div class="srchCon">
    			<!-- <span class="printText" id="printBtn"><b>Print &nbsp;&nbsp; |</b></span> -->
				<!-- <span class="printText" id="printBtn"><b>Print</b></span> -->
				<button class="btn btn-primary">
				<span id="printBtn"><b>Print</b></span>	
				</button>
    			<!-- <span class="printText" id="download"><b>&nbsp;&nbsp;Download</b></span> -->
    			<span class="seachright">
    				<b>Search by Dealer Name</b>
    				<input type="text" name="search" id="search" class="form-control option-contol-search" placeholder="Search...">	    				
    			</span>
    		</div>
    		<table class="tableshow" id="tableshow" style="border-collapse: collapse; border: 1px solid #777 !important;">
    			
    			<?php
    				$sql = "SELECT * FROM balu_dealer WHERE project_name_id = '$project_name_id'";
    				$result = $db->select($sql);
    				$row_number = mysqli_num_rows($result);
    				if($result && $row_number > 0){
    					// echo $row_number;
    					$i = 1;
						echo "<tr>";
						// echo "<th style='border: 1px solid #777 !important;'>".$i."</th>";
						echo "<th style='border: 1px solid #777 !important;'>#</th>";
						echo "<th style='border: 1px solid #777 !important;'>ডিলার আই.ডি</th>";
						echo "<th style='border: 1px solid #777 !important;'>ডিলার নাম</th>";
						echo "<th style='border: 1px solid #777 !important;'>মোট গাড়ী ভাড়াঃ</td>";
						echo "<th style='border: 1px solid #777 !important;'>মোট খালাস খরচঃ</td>";

						echo "<th style='border: 1px solid #777 !important;'>মোট মূলঃ</th>";
						echo "<th style='border: 1px solid #777 !important;'>মোট জমাঃ</th>";
						echo "<th style='border: 1px solid #777 !important;'>মো‌ট জেরঃ</th>";
						echo "<th style='border: 1px solid #777 !important;'>নিজ পাওনাঃ</th>";
						echo "</tr>"; 
						 
    					while($row = $result->fetch_assoc()){
    						$dealer_id = $row['dealer_id'];
    						// echo "<tr>";
    						// echo "<td colspan='5' style='border: 1px solid #777 !important; text-align: center; font-size: 28px; background-color: #ddd;'>".$row['dealer_name']."</td>";
							// echo "</tr>";

    					    // echo "<tr>";
			    		    // echo "<th style='border: 1px solid #777 !important;'>".$i."</th>";
			    		    // echo "<th style='border: 1px solid #777 !important;'>ডিলার আই.ডি</th>";
			    			// echo "<th style='border: 1px solid #777 !important;'>ঠিকানা</th>";
			    		    // echo "<th style='border: 1px solid #777 !important;'>যোগাযোগ ব্যাক্তির নাম</th>";
			    			// echo "<th style='border: 1px solid #777 !important;'>মোবাইল</th>";
			    			//  echo "</tr>";


    					    //  echo "<tr>";
    						//  echo "<td style='border: 1px solid #777 !important;'></td>";
    						//  echo "<td style='border: 1px solid #777 !important;'>".$dealer_id."</td>";	    						
    						//  echo "<td style='border: 1px solid #777 !important;'>".$row['address']."</td>";
    						//  echo "<td style='border: 1px solid #777 !important;'>".$row['contact_person_name']."</td>";
    						//  echo "<td style='border: 1px solid #777 !important;'>".$row['mobile']."</td>";
    						//  echo "</tr>";
    						
    						

    						// Details Showing Code Here
    						// $rod500w = 0;
    						// $rod400w = 0;

    						// $sql2 = "SELECT SUM(kg) as kg FROM details_balu WHERE particulars LIKE '%500W%' AND dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
					        // $result2 = $db->select($sql2);
					        // if($result2->num_rows > 0){
					        //     while($row2 = $result2->fetch_assoc()){
					        //         $rod500w = $row2['kg'];
					        //         if(is_null($rod500w)){
					        //             $rod500w = 0;
					        //         }
					        //     }
					        // } else{
					        //     $rod500w = 0;
					        // }
					        // $sql2 = "SELECT SUM(kg) as kg FROM details_balu WHERE particulars LIKE '%400W%' AND dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
					        // $result2 = $db->select($sql2);
					        // if($result2->num_rows > 0){
					        //     while($row2 = $result2->fetch_assoc()){
					        //         $rod400w = $row2['kg'];
					        //         if(is_null($rod400w)){
					        //             $rod400w = 0;
					        //         }
					        //     }
					        // } else{
					        //     $rod400w = 0;
					        // }
					        // $rod_total_500w_400W = $rod400w + $rod500w;
    						
					        // // Start total total_motor
					        // 	$total_motor = 0;
						    //     $sql2 = "SELECT SUM(motor) as motor FROM details_balu WHERE dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
						    //     $result2 = $db->select($sql2);
						    //     if($result2->num_rows > 0){
						    //         while($row2 = $result2->fetch_assoc()){
						    //             $total_motor = $row2['motor'];
						    //             if(is_null($total_motor)){
						    //                 $total_motor = 0;
						    //             }
						    //         }
						    //     } else{
						    //         $total_motor = 0;
						    //     }
						    // End total total_motor
					        //Start Gari vara
							$motor_vara = 0;
							$sql2 = "SELECT SUM(motor_vara) as motor_vara FROM details_balu WHERE dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
							$result3 = $db->select($sql2);
							if($result3->num_rows > 0){
								while($row3 = $result3->fetch_assoc()){
									$motor_vara = $row3['motor_vara'];
									if(is_null($motor_vara)){
										$motor_vara = 0;
									}
								}
							} else{
								$motor_vara = 0;
							}

								$total_motor_vara = 0;
						        $sql3 = "SELECT SUM(motor_vara) as motor_vara FROM details_balu WHERE project_name_id = '$project_name_id'";
						        $result3 = $db->select($sql3);
						        if($result3->num_rows > 0){
						            while($row3 = $result3->fetch_assoc()){
						                $total_motor_vara = $row3['motor_vara'];
						                if(is_null($total_motor_vara)){
						                    $total_motor_vara = 0;
						                }
						            }
						        } else{
						            $total_motor_vara = 0;
						        }
						    //End Gari vara

						    //Start khalas/Unload
						        $unload = 0;
						        $sql2 = "SELECT SUM(unload) as unload FROM details_balu WHERE dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
						        $result2 = $db->select($sql2);
						        if($result2->num_rows > 0){
						            while($row2 = $result2->fetch_assoc()){
						                $unload = $row2['unload'];
						                if(is_null($unload)){
						                    $unload = 0;
						                }
						            }
						        } else{
						            $unload = 0;
						        }
						        $motor_vara_and_unload = $motor_vara + $unload;

								$total_unload = 0;
								$sql3 = "SELECT SUM(unload) as unload FROM details_balu WHERE  project_name_id = '$project_name_id'";
								$result3 = $db->select($sql3);
								if($result3->num_rows > 0){
									while($row3 = $result3->fetch_assoc()){
										$total_unload = $row3['unload'];
									   if(is_null($total_unload)){
										  $total_unload = 0;
									  }
								   }
								} else{
								   $total_unload = 0;
								}
						    //End khalas/Unload
						    // Start total total_credit/mot_mul
						        $total_credit = 0;
						        $sql2 = "SELECT SUM(credit) as credit FROM details_balu WHERE dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
						        $result2 = $db->select($sql2);
						        if($result2->num_rows > 0){
						            while($row2 = $result2->fetch_assoc()){
						                $total_credit = $row2['credit'];
						                if(is_null($total_credit)){
						                    $total_credit = 0;
						                }
						            }
						        } else{
						            $total_credit = 0;
						        }
								$total1_credit = 0;
						        $sql3 = "SELECT SUM(credit) as credit FROM details_balu WHERE project_name_id = '$project_name_id'";
						        $result3 = $db->select($sql3);
						        if($result3->num_rows > 0){
						            while($row3 = $result3->fetch_assoc()){
						                $total1_credit = $row3['credit'];
						                if(is_null($total1_credit)){
						                    $total1_credit = 0;
						                }
						            }
						        } else{
						            $total1_credit = 0;
						        }
						    // End total total_credit/mot_mul

						    // Start total total_debit/joma
						        $total_debit = 0;
						        $sql2 = "SELECT SUM(debit) as debit FROM details_balu WHERE dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
						        $result2 = $db->select($sql2);
						        if($result2->num_rows > 0){
						            while($row2 = $result2->fetch_assoc()){
						                $total_debit = $row2['debit'];
						                if(is_null($total_debit)){
						                    $total_debit = 0;
						                }
						            }
						        } else{
						            $total_debit = 0;
						        }

								$total1_debit = 0;
						        $sql3 = "SELECT SUM(debit) as debit FROM details_balu WHERE project_name_id = '$project_name_id'";
						        $result3 = $db->select($sql3);
						        if($result3->num_rows > 0){
						            while($row3 = $result3->fetch_assoc()){
						                $total1_debit = $row3['debit'];
						                if(is_null($total1_debit)){
						                    $total1_debit = 0;
						                }
						            }
						        } else{
						            $total1_debit = 0;
						        }
						    // End total total_debit/joma

						    // Start total total_Balance/mot_jer
						        $total_balance = 0;
						        $sql2 = "SELECT SUM(balance) as balance FROM details_balu WHERE dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
						        $result2 = $db->select($sql2);
						        if($result2->num_rows > 0){
						            while($row2 = $result2->fetch_assoc()){
						                $total_balance = $row2['balance'];
						                if(is_null($total_balance)){
						                    $total_balance = 0;
						                }
						            }
						        } else{
						            $total_balance = 0;
						        }

								$total1_balance = 0;
						        $sql3 = "SELECT SUM(balance) as balance FROM details_balu WHERE  project_name_id = '$project_name_id'";
						        $result3 = $db->select($sql3);
						        if($result3->num_rows > 0){
						            while($row3 = $result3->fetch_assoc()){
						                $total1_balance = $row3['balance'];
						                if(is_null($total1_balance)){
						                    $total1_balance = 0;
						                }
						            }
						        } else{
						            $total1_balance = 0;
						        }


								// $total1_debit = 0;
						        // $sql3 = "SELECT SUM(debit) as debit FROM details_balu WHERE project_name_id = '$project_name_id'";
						        // $result3 = $db->select($sql3);
						        // if($result3->num_rows > 0){
						        //     while($row3 = $result3->fetch_assoc()){
						        //         $total1_debit = $row3['debit'];
						        //         if(is_null($total1_debit)){
						        //             $total1_debit = 0;
						        //         }
						        //     }
						        // } else{
						        //     $total1_debit = 0;
						        // }
						    // End total total_Balance/mot_jer
						    //Start GB Bank Ganti
						        $gb_bank_ganti = 0;
						        $sql2 = "SELECT SUM(debit) as debit, id FROM details_balu WHERE particulars = 'BG' AND dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
						        $result2 = $db->select($sql2);
						        if($result2->num_rows > 0){
						            while($row2 = $result2->fetch_assoc()){
						                $gb_bank_ganti = $row2['debit'];
						                $gb_bank_ganti_db_id = $row2['id'];
						                if(is_null($gb_bank_ganti)){
						                    $gb_bank_ganti = 0;
						                }
						            }
						        } else{
						            $gb_bank_ganti = 0;
						        }



						        
						    //End GB Bank Ganti
						//Start Total para/mot_mul_khoros_shoho
						        $paras = 0;
						        $sql2 = "SELECT SUM(paras) as paras FROM details_balu WHERE dealer_id = '$dealer_id' AND project_name_id = '$project_name_id'";
						        $result2 = $db->select($sql2);
						        if($result2->num_rows > 0){
						            while($row2 = $result2->fetch_assoc()){
						                $total_paras = $row2['paras'];
						                if(is_null($paras)){
						                    $paras = 0;
						                }
						            }
						        } else{
						            $paras = 0;
						        }
						    //End Total para/mot_mul_khoros_shoho

						    $nij_paona = $total_debit - $total_credit;
							$total_nij_paona = $total1_debit - $total1_credit;
						    $company_paona = ($total_debit - $total_credit) - $gb_bank_ganti;

					        //Nested table
					        // echo "<tr><td colspan='5' style='border: 1px solid #777 !important;'>";
						    //     echo "<table style='width: 100%; border-collapse:collapse;'>";
						    //     echo "<tr><td colspan='8' style='border: 0px; height: 15px;'></td></tr>";
						    //     echo "<tr>";
						    //     // echo "<td style='width: 170px; border: 1px solid #777 !important;'>Rod 500W/60G, Total Kg:</td>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>".$rod500w." kg</td>";
						    //     // echo "<td style='text-align: right; border: 1px solid #777 !important;'>মোট গাড়ীঃ</td>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>".$total_motor." টি</td>";
						    //     echo "<td style='text-align: right; border: 1px solid #777 !important;'>মোট গাড়ী ভাড়াঃ</td>";
						    //     echo "<td style='border: 1px solid #777 !important;'>".$motor_cash." টাকা</td>";
						    //     echo "<td style='text-align: right; border: 1px solid #777 !important;'>মোট খালাস খরচঃ</td>";
						    //     echo "<td style='border: 1px solid #777 !important;'>".$unload." টাকা</td>";
							// 	echo "<td style='border: 1px solid #777 !important; text-align: right;'>মোট মূলঃ</td>";
						    //     echo "<td style='border: 1px solid #777 !important;'>".$total_credit." টাকা</td>";
						    //     echo "</tr>";


						    //     echo "<tr>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>Rod 400W/60G, Total Kg:</td>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>".$rod400w." kg</td>";
						    //     // echo "<td style='border: 1px solid #777 !important; text-align: right;'>মোট মূলঃ</td>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>".$total_credit." টাকা</td>";
						    //     echo "<td style='border: 1px solid #777 !important; text-align: right;'>মোট জমাঃ</td>";
						    //     echo "<td style='border: 1px solid #777 !important;'>".$total_debit." টাকা</td>";
						    //     echo "<td style='border: 1px solid #777 !important; text-align: right;'>মো‌ট জেরঃ</td>";
						    //     echo "<td style='border: 1px solid #777 !important;'>".$total_balance." টাকা</td>";
							// 	echo "<td style='text-align: right; border: 1px solid #777 !important;'>নিজ পাওনাঃ</td>";
						    //     echo "<td style='border: 1px solid #777 !important;'>".$nij_paona." টাকা</td>";
						    //     echo "</tr>";


						    //     echo "<tr>";
						    //     // echo "<td style='text-align: right; border: 1px solid #777 !important;'>Total Kg:</td>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>".$rod_total_500w_400W." kg</td>";
						    //     // echo "<td style='text-align: right; border: 1px solid #777 !important;'>কোম্পানি পাওনাঃ</td>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>". $company_paona." kg</td>";
						    //     // echo "<td style='text-align: right; border: 1px solid #777 !important;'>নিজ পাওনাঃ</td>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>".$nij_paona." টাকা</td>";
						    //     // echo "<td style='text-align: right; border: 1px solid #777 !important;'>মোট মূল খরচ সহঃ</td>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>".$total_paras." টাকা</td>";
						    //     echo "</tr>";


						    //     echo "<tr>";
						    //     // echo "<td style='text-align: right; border: 1px solid #777 !important;'>মোট টোনঃ</td>";
						    //     // echo "<td style='border: 1px solid #777 !important;'>".($rod_total_500w_400W/100)." tonne</td>";
							// 	echo "</tr>";
						    //     echo "</table>";
					        // echo "</td></tr>";
					        //
						//    echo "<tr><td colspan='6' style='border-left: 1px solid transparent; border-right: 1px solid transparent; border-bottm: 1px solid #777; border-top: 1px solid #777; height: 70px;'></td></tr>";
                           


    					     echo "<tr>";
    						//  echo "<td style='border: 1px solid #777 !important;'></td>";
							echo "<td  style='border: 1px solid #777 !important;'>".$i."</td>";
    					    echo "<td style='border: 1px solid #777 !important;'>".$row['dealer_id']."</td>";
							echo "<td style='border: 1px solid #777 !important;'>".$row['dealer_name']."</td>";
							echo "<td style='border: 1px solid #777 !important;'>".$motor_vara." টাকা</td>";
			                echo "<td style='border: 1px solid #777 !important;'>".$unload." টাকা</td>";	
							echo "<td style='border: 1px solid #777 !important;'>".$total_credit." টাকা</td>";
							echo "<td style='border: 1px solid #777 !important;'>".$total_debit." টাকা</td>";
							echo "<td style='border: 1px solid #777 !important;'>".$total_balance." টাকা</td>";
							echo "<td style='border: 1px solid #777 !important;'>".$nij_paona." টাকা</td>";
    						echo "</tr>";




					        $i++;
    					}
    				}
    			?>
    		<!-- </table> -->
			<?php
			echo"<td style='text-align: left; border: 1px solid #777 !important;'></td>";
			echo"<td style='text-align: left; border: 1px solid #777 !important;'></td>";
			echo"<td style='text-align: left; border: 1px solid #777 !important;'></td>";
			echo"<td style='text-align: left; border: 1px solid #777 !important;'>total = ".$total_motor_vara. " টাকা</td>";
			echo"<td style='text-align: left; border: 1px solid #777 !important;'>total = ".$total_unload. " টাকা</td>";
			echo"<td style='text-align: left; border: 1px solid #777 !important;'>total = ".$total1_credit." টাকা </td>";
			echo"<td style='text-align: left; border: 1px solid #777 !important;'>total = ".$total1_debit." টাকা </td>";
			echo"<td style='text-align: left; border: 1px solid #777 !important;'>total = ".$total1_balance." টাকা </td>";
			echo"<td style='text-align: left; border: 1px solid #777 !important;'>total = ".$total_nij_paona." টাকা </td>";
			
	        // <!-- echo "<td style='border: 1px solid #777 !important;'>"" tonne</td>"; -->
			?>
			<!-- </table> -->
		</div>
	</div>
	<script>
		

var num1 = parseFloat('$total_motor_vara').toFixed(2);
var num2 = parseFloat("$total_unload").toFixed(2);
var num3 = parseFloat("$total1_credit").toFixed(2);
var num4 = parseFloat("$total1_debit").toFixed(2);
var num5 = parseFloat("$total1_balance").toFixed(2);
var num6 = parseFloat("$total_nij_paona").toFixed(2);




console.log(num1);
console.log(num2);
console.log(num3);
console.log(num4);
console.log(num5);
		</script>

	<script type="text/javascript">	
		var height = $('.content').height();
		$('.menu').height(height);
	</script>
	<script type="text/javascript">	
		$(document).on('change', '#showHide', function(){
			if($('#showHide').is(":checked")){
				$('#advancedFromTo').show();
				$('#monthYearcon').show();
				 // alert("Checkbox is checked.");
			} else {
				$('#advancedFromTo').hide();
				$('#monthYearcon').hide();
			}
		});

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
		        url: "../ajaxcall_rod_report/balu_report_dealer_fromdate_todate_search.php",
		        type: "post",
		        data: {
		        	fromdate 	: fromdate, 
		        	todate 		: todate,
		        },
		        success: function (response) {
		          // alert(response);
		          $('#tableshow').html(response);
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
			// alert(fromdate + "=" + todate);
		});
		$(document).on('change', '#todate', function(){
			var fromdate 	= $("#fromdate").val();
			var todate 		= $("#todate").val();
			fromTodateSearch(fromdate, todate);
			// alert(fromdate + "=" + todate);
		});

		function yearMonthSearch(monthvalue, yearvalue){
			$.ajax({
		        url: "../ajaxcall_rod_report/balu_report_dealer_year_month_search.php",
		        type: "post",
		        data: {
		        	monthvalue 	: monthvalue, 
		        	yearvalue 	: yearvalue,
		        },
		        success: function (response) {
		          // alert(response);
		          $('#tableshow').html(response);
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
		$('.selctpik2').selectpicker();
		$('.selctpik').selectpicker();
		var newyear = new Date().getFullYear();
		// console.log(newdate);
		$('.selctpikYear').selectpicker('val', newyear);
	</script>
	<script type="text/javascript">
		$(document).on('input', '#search', function(){
			function searchByDealerName(searchTxt){
			    $.ajax({
			        url: "../ajaxcall_rod_report/balu_report_dealer_search.php",
			        type: "post",
			        data: { searchTxt : searchTxt },
			        success: function (response) {
			          // alert(response);
			          $('#tableshow').html(response);
			        },
			        error: function(jqXHR, textStatus, errorThrown) {
			           console.log(textStatus, errorThrown);
			        }
			    });
			}
			var searchTxt = $('#search').val();
			searchByDealerName(searchTxt);
		
		});


		function dealerWiseSearch(searchDealer){
			$.ajax({
		        url: "../ajaxcall_rod_report/balu_report_dealer_name_wise_search.php",
		        type: "post",
		        data: {
		        	searchDealer 	: searchDealer,
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
		$(document).on('change', '#searchDealer', function(){
			var searchDealer 	= $("#searchDealer").val();
			if(searchDealer == 'alldealers'){
				window.location = '../vaucher/balu_report_dealer.php';
			} else {
				dealerWiseSearch(searchDealer);
			}
			
		});
	</script>
	<script type="text/javascript">	
		$('#printBtn').click(function(){
			var printme = document.getElementById('tableshow');
			var wme	= window.open("", "", "width=900,height=700, scrollbars=yes");
			wme.document.write('<style type="text/css">.tableshow tr:last-child td{			border-bottom: 1px solid transparent;height: 0px !important;}</style>');
			wme.document.write(printme.outerHTML);
			wme.document.close();
			wme.focus();
			wme.print();
			wme.close();
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
	<script src="../js/common_js.js"> </script>
</body>
</html>