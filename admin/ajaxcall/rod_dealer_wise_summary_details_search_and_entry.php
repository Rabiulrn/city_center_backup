<?php 
	session_start();
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();

    $dealerId	= $_POST['dealerId'];
    $_SESSION['dealerIdInput'] = $_POST['dealerId'];
	// echo $dealerId;
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];

	

	$sucMsg ="";


	//Start Sql For Summary 500W/60G
        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $mm0450_rod500 = $row['kg'];
                if(is_null($mm0450_rod500)){
                    $mm0450_rod500 = 0;
                }
            }
        } else{
            $mm0450_rod500 = 0;
        }


        $mm06_rod500 = 0;
        $mm08_rod500 = 0;
        $mm10_rod500 = 0;
        $mm12_rod500 = 0;
        $mm16_rod500 = 0;
        $mm20_rod500 = 0;
        $mm22_rod500 = 0;
        $mm25_rod500 = 0;
        $mm32_rod500 = 0;
        $mm42_rod500 = 0;

        $mmRodArry = array('06','08','10','12','16','20', '22','25','32','42');
        $arrlength = count($mmRodArry);

        for($i=0; $i<$arrlength; $i++){
            // echo $mmRodArry[$i];
            // echo "<br>";

            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '$mmRodArry[$i] mm' OR mm = '$mmRodArry[$i]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
            $result = $db->select($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    ${"mm$mmRodArry[$i]_rod500"} = $row['kg'];
                    if(is_null(${"mm$mmRodArry[$i]_rod500"})){
                        ${"mm$mmRodArry[$i]_rod500"} = 0;
                    }
                }
            } else{
                ${"mm$mmRodArry[$i]_rod500"} = 0;
            }
        }
        $total_kg_rod500 = $mm0450_rod500 + $mm06_rod500 + $mm08_rod500 + $mm10_rod500 + $mm12_rod500 + $mm16_rod500 + $mm20_rod500 + $mm22_rod500 + $mm25_rod500 + $mm32_rod500 + $mm42_rod500;
    //End Sql For Summary 500W/60G

    //Start Sql For Summary 400W/60G
        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $mm0450_rod400 = $row['kg'];
                if(is_null($mm0450_rod400)){
                    $mm0450_rod400 = 0;
                }
            }
        } else{
            $mm0450_rod400 = 0;
        }


        $mm06_rod400 = 0;
        $mm08_rod400 = 0;
        $mm10_rod400 = 0;
        $mm12_rod400 = 0;
        $mm16_rod400 = 0;
        $mm20_rod400 = 0;
        $mm22_rod400 = 0;
        $mm25_rod400 = 0;
        $mm32_rod400 = 0;
        $mm42_rod400 = 0;

        $mmRodArry2 = array('06','08','10','12','16','20', '22','25','32','42');
        $arrlength2 = count($mmRodArry2);

        for($j=0; $j<$arrlength2; $j++){
            // echo $mmRodArry2[$j];
            // echo "<br>";

            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '$mmRodArry2[$j] mm' OR mm = '$mmRodArry2[$j]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
            $result = $db->select($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    ${"mm$mmRodArry2[$j]_rod400"} = $row['kg'];
                    if(is_null(${"mm$mmRodArry2[$j]_rod400"})){
                        ${"mm$mmRodArry2[$j]_rod400"} = 0;
                    }
                }
            } else{
                ${"mm$mmRodArry2[$j]_rod400"} = 0;
            }
        }
        $total_kg_rod400 = $mm0450_rod400 + $mm06_rod400 + $mm08_rod400 + $mm10_rod400 + $mm12_rod400 + $mm16_rod400 + $mm20_rod400 + $mm22_rod400 + $mm25_rod400 + $mm32_rod400 + $mm42_rod400;
    //End Sql For Summary 400W/60G


    //Start Gari vara
        $sql = "SELECT SUM(motor_cash) as motor_cash FROM details WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $motor_cash = $row['motor_cash'];
                if(is_null($motor_cash)){
                    $motor_cash = 0;
                }
            }
        } else{
            $motor_cash = 0;
        }
    //End Gari vara

    //Start khalas/Unload
        $sql = "SELECT SUM(unload) as unload FROM details WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $unload = $row['unload'];
                if(is_null($unload)){
                    $unload = 0;
                }
            }
        } else{
            $unload = 0;
        }
        $motor_cash_and_unload = $motor_cash + $unload;
    //End khalas/Unload

    // Start total total_motor
        $sql = "SELECT SUM(motor) as motor FROM details WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_motor = $row['motor'];
                if(is_null($total_motor)){
                    $total_motor = 0;
                }
            }
        } else{
            $total_motor = 0;
        }
    // End total total_motor

    //Start GB Bank Ganti
        $sql = "SELECT SUM(debit) as debit, id FROM details WHERE particulars = 'BG' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $gb_bank_ganti = $row['debit'];
                $gb_bank_ganti_db_id = $row['id'];
                if(is_null($gb_bank_ganti)){
                    $gb_bank_ganti = 0;
                }
            }
        } else{
            $gb_bank_ganti = 0;
        }
        
    //End GB Bank Ganti
    // Start total total_kg
        $sql = "SELECT SUM(kg) as kg FROM details WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_kg = $row['kg'];
                if(is_null($total_kg)){
                    $total_kg = 0;
                }
            }
        } else{
            $total_kg = 0;
        }
        $total_ton = $total_kg/1000;
    // End total total_kg

    // Start total total_credit/mot_mul
        $sql = "SELECT SUM(credit) as credit FROM details WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_credit = $row['credit'];
                if(is_null($total_credit)){
                    $total_credit = 0;
                }
            }
        } else{
            $total_credit = 0;
        }
    // End total total_credit/mot_mul

    // Start total total_debit/joma
        $sql = "SELECT SUM(debit) as debit FROM details WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_debit = $row['debit'];
                if(is_null($total_debit)){
                    $total_debit = 0;
                }
            }
        } else{
            $total_debit = 0;
        }
    // End total total_debit/joma

    // Start total total_Balance/mot_jer
        $sql = "SELECT SUM(balance) as balance FROM details WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_balance = $row['balance'];
                if(is_null($total_balance)){
                    $total_balance = 0;
                }
            }
        } else{
            $total_balance = 0;
        }
    // End total total_Balance/mot_jer

    //Start Total para/mot_mul_khoros_shoho
        $sql = "SELECT SUM(total_paras) as total_paras FROM details WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_paras = $row['total_paras'];
                if(is_null($total_paras)){
                    $total_paras = 0;
                }
            }
        } else{
            $total_paras = 0;
        }
    //End Total para/mot_mul_khoros_shoho

    $nij_paona = $total_debit - $total_credit;
    $company_paona = ($total_debit - $total_credit) - $gb_bank_ganti;
?>






<div id="flip">    
    <label class="conchk" id="flipChkbox">Show/Hide Summary
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>

    
    <div class="contorlAfterDealer">          
        <div class="dateSearch"> 
            <b>Search Date:</b>                   
              <select class="selectpicker" data-style="btn-info" id="dateSearchList">
                  <option value="alldates">All dates</option>
                  <?php
                      $sql = "SELECT DISTINCT dates FROM details WHERE dealer_id='$dealerId' AND project_name_id = '$project_name_id' ORDER BY dates ASC";
                      $result = $db->select($sql);
                      if($result->num_rows > 0){
                          while($row = $result->fetch_assoc()){
                              $dates = $row['dates'];
                              $newDate = date("d-m-Y", strtotime($dates));
                              // echo $newDate;
                              if($dates == '0000-00-00'){
                              
                              } else {
                                  echo '<option value="'.$newDate.'">'. $newDate .'</option>';
                              }
                          }
                      } else{
                          echo '<option value="">Not Found</option>';
                      }
                  ?>
              </select>
        </div>
        <button onclick="myFunction()" class="btn printBtnDlr">Print</button>
        <button onclick="myFunction()" class="btn printBtnDlrDown">Download</button>
    </div>
</div>
<div id="panel">
	<table width="100%" class="summary">
		<tr>
			<td class="hastext" width="150px">04.50mm 500W/60G</td>
			<td style="min-width: 85px; max-width: 150px;"><?php echo $mm0450_rod500; ?></td>
			<td class="hastext" width="150px">04.50mm 400W/60G</td>
			<td style="min-width: 85px; max-width: 150px;"><?php echo $mm0450_rod500; ?></td>
			
            <td class="hastext" style="min-width: 85px; max-width: 150px;">মোট কেজিঃ</td>
            <td><?php echo $total_kg; ?></td>
			<td class="hastext">জ‌িব‌ি ব্যাংক গ্যান্ট‌িঃ</td>
			<td style="width: 150px; position: relative;" id="gb_bank_ganti_td">
                <span id="gbbank_stable_val"><?php echo $gb_bank_ganti; ?></span>
                
                <input data-id="<?php echo $gb_bank_ganti_db_id; ?>" type="text" name="gb_bank_ganti" id="gb_bank_ganti" value="<?php echo $gb_bank_ganti; ?>" onfocus="this.value = this.value;">  
            </td>
						
		</tr>
		<tr>
			<td class="hastext">06mm 500W/60G</td>
			<td><?php echo $mm06_rod500; ?></td>
			<td class="hastext">06mm 400W/60G</td>
			<td><?php echo $mm06_rod400; ?></td>
			
            <td class="hastext">মোট টোনঃ</td>
            <td><?php echo $total_ton; ?></td>
			<td class="hastext">কোম্পানী পাওনাঃ</td>
			<td><?php echo $company_paona; ?></td>			
		</tr>
		<tr>
			<td class="hastext">08mm 500W/60G</td>
			<td><?php echo $mm08_rod500; ?></td>
			<td class="hastext">08mm 400W/60G</td>
			<td><?php echo $mm08_rod400; ?></td>			
            <td class="hastext">মোট গাড়ীঃ</td>
            <td><?php echo $total_motor; ?></td>
			<td class="hastext">নিজ পাওনাঃ</td>
			<td><?php echo $nij_paona; ?></td>											
		</tr>
		<tr>
			<td class="hastext">10mm 500W/60G</td>
			<td><?php echo $mm10_rod500; ?></td>
			<td class="hastext">10mm 400W/60G</td>
			<td><?php echo $mm10_rod400; ?></td>
			<td></td><td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td class="hastext">12mm 500W/60G</td>
			<td><?php echo $mm12_rod500; ?></td>
			<td class="hastext">12mm 400W/60G</td>
			<td><?php echo $mm12_rod400; ?></td>
			<td style="background-color: #bcbcbc;"></td>
			<td style="background-color: #bcbcbc;"></td>
			<td style="background-color: #bcbcbc;"></td>
			<td style="background-color: #bcbcbc;"></td>
		</tr>
		<!-- Ekhan theke -->
		<tr>
			<td class="hastext">16mm 500W/60G</td>
			<td><?php echo $mm16_rod500; ?></td>
			<td class="hastext">16mm 400W/60G</td>
			<td><?php echo $mm16_rod400; ?></td>
			<td class="hastext">মোট গাড়ী ভাড়াঃ</td>
            <td ><?php echo $motor_cash; ?></td>
			<td class="hastext">ম‌োট মূলঃ</td>
			<td><?php echo $total_credit; ?></td>			
		</tr>
		<tr>
			<td class="hastext">20mm 500W/60G</td>
			<td><?php echo $mm20_rod500; ?></td>
			<td class="hastext">20mm 400W/60G</td>
			<td><?php echo $mm20_rod400; ?></td>
			<td class="hastext">মোট খালাস খরচঃ</td>
            <td><?php echo $unload; ?></td>
			<td class="hastext">ম‌োট জমাঃ</td>
			<td><?php echo $total_debit; ?></td>
		</tr>
        <tr>
            <td class="hastext">22mm 500W/60G</td>
            <td><?php echo $mm22_rod500; ?></td>
            <td class="hastext">22mm 400W/60G</td>
            <td><?php echo $mm22_rod400; ?></td>
            <td class="hastext">গাড়ী ভাড়া ও খালাস খরচঃ</td>
            <td><?php echo $motor_cash_and_unload; ?></td>
            <td class="hastext">ম‌োট পাওনা ও জেরঃ</td>
            <td><?php echo $total_balance; ?></td>
        </tr>
		<tr>
			<td class="hastext">25mm 500W/60G</td>
			<td><?php echo $mm25_rod500; ?></td>
			<td class="hastext">25mm 400W/60G</td>
			<td><?php echo $mm25_rod400; ?></td>			
			<td class="hastext">ম‌োট মূল খরচ সহঃ</td>
			<td><?php echo $total_paras; ?></td>
            <td></td>			
            <td></td>
		</tr>
		<tr>
			<td class="hastext">32mm 500W/60G</td>
			<td><?php echo $mm32_rod500; ?></td>
			<td class="hastext">32mm 400W/60G</td>
			<td><?php echo $mm32_rod400; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td class="hastext">42mm 500W/60G</td>
			<td><?php echo $mm42_rod500; ?></td>
			<td class="hastext">42mm 400W/60G</td>
			<td><?php echo $mm42_rod400; ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td class="hastext"><b>Total Kg:</b></td>
			<td><b><?php echo $total_kg_rod500; ?></b></td>
			<td class="hastext"><b>Total Kg:</b></td>
			<td><b><?php echo $total_kg_rod400; ?></b></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
</div>


<div class="rodDetailsEnCon" style="display: block;">
	<form id="form_entry">        
	    <!-- <h2 class="ce_header bg-primary">Details Entry</h2> -->
	    <div class="scrolling-div" id="scrolling-entry-div">
                <div id="popUpNewBtn">
                    <img src="../img/others/new_entry.png" width="100%" height="100%">
                </div>
                <div class="scrollsign_plus" id="entry_scroll3">+</div> 
                <div class="scrollsign_plus" id="entry_scroll2">+</div>                  
                <div class="scrollsign_plus" id="entry_scroll1">+</div>                  
	            <table border="1" id="detailsEtryTable">
	              <tr>
	                    <td class="widthPercent1">Buyer ID</td>
	                    <!-- <td width="150">Dealer ID</td> -->
	                    <td class="widthPercent1">Motor Cash</td>
	                    <td class="widthPercent1">Unload</td>
	                    <td class="widthPercent1">Cars rent & Redeem</td>
	                    <td class="widthPercent1">Information</td>                  
	                    <td class="widthPercent1">Address</td>
	                    <td class="widthPercent1">SL No</td>
	                    <td class="widthPercent1">Delivery No</td>
	                    <td class="widthPercent2">Motor</td>
	                    <td class="widthPercent2">Motor No</td>
	                    <td class="widthPercent2">Delivery Date</td>
	                    <td class="widthPercent2">Date</td>
	                    <td class="widthPercent2">Partculars</td>
	                    <td class="widthPercent2">Particulars</td>
	                    <td class="widthPercent2">Debit</td>
	                    <td class="widthPercent3">mm</td>
	                    <td class="widthPercent3">Kg</td>
	                    <td class="widthPercent3">Para's</td>
	                    <td class="widthPercent3">Credit</td>
	                    <td class="widthPercent3">Discount</td>
	                    <td class="widthPercent3">Balance</td>
	                    <td class="widthPercent3">Bundil</td>
	                    <td class="widthPercent3">Total Para's</td>
	              </tr>
	              <tr>
	                    <td>বায়ার আই ডি</td>
	                    <!-- <td>ডিলার আই ডি</td> -->
	                    <td>গাড়ী ভাড়া</td>
	                    <td>আনলোড</td>
	                    <td>গাড়ী ভাড়া ও খালাস</td>
	                    <td>মালের বিবরণ</td>                  
	                    <td>ঠিকানা</td>
	                    <td>ক্রমিক নং</td>
	                    <td>ভাউচার নং</td>
	                    <td>গাড়ী</td>
	                    <td>গাড়ী নাম্বার</td>
	                    <td>ডেলিভারি তারিখ</td>
	                    <td>তারিখ</td>
	                    <td>মারফোত নাম</td>
	                    <td>বিবরণ</td>
	                    <td>জমা টাকা</td>
	                    <td>মি.মি.</td>
	                    <td>কে.জি.</td>
	                    <td>দর</td>
	                    <td>মূল</td>
	                    <td>কমিশন</td>
	                    <td>অবশিষ্ট</td>
	                    <td>বান্ডিল</td>
	                    <td>মোট দাম</td>
	              </tr>
	              <tr style = "position: relative;">
	                    <td>
	                      <!-- <input type="text" name="customer_id" class="form-control" id="customer_id" placeholder="Enter customer_id..."> -->
	                      <?php
	                        $sql = "SELECT buyer_id FROM buyers";
	                        $all_custmr_id = $db->select($sql);
	                        echo '<select name="buyer_id" id="buyer_id" class="form-control" style="width: 140px;">';
	                          echo '<option value="none">Select...</option>';
	                          if($all_custmr_id->num_rows > 0){
	                              while($row = $all_custmr_id->fetch_assoc()){
	                                $id = $row['buyer_id'];
	                                echo '<option value="' . $id . '">' . $id . '</option>';
	                              }
	                            } else{
	                              echo '<option value="none">0 Resulst</option>';
	                            }
	                          echo '</select>';
	                      ?>

	                    </td>
	                    <!-- <td> -->
	                      <!-- <input type="text" name="delear_id" class="form-control" id="delear_id" placeholder="Enter delear_id..."> -->
	                      <?php
	                        // $sql = "SELECT dealer_id FROM dealers";
	                        // $all_custmr_id = $db->select($sql);
	                        // echo '<select name="delear_id" id="delear_id" class="form-control" style="width: 140px;">';
	                        //   echo '<option value="">Select...</option>';
	                        //   if($all_custmr_id->num_rows > 0){
	                        //       while($row = $all_custmr_id->fetch_assoc()){
	                        //         $id = $row['dealer_id'];
	                        //         echo '<option value="' . $id . '">' . $id . '</option>';
	                        //       }
	                        //     } else{
	                        //       echo '<option value="none">0 Result</option>';
	                        //     }
	                        //   echo '</select>';
	                      ?>
	                    <!-- </td> -->
	                    <td>
	                      <input type="text" onkeypress="return isNumber(event)" name = "motor_cash" class="form-control value-calc" id="motor_cash" placeholder="Enter motor cash...">
	                    </td>
	                    <td>
	                      <input type="text" onkeypress="return isNumber(event)" name = "motor_cash" name ="unload" class="form-control value-calc" id="unload" placeholder="Unload">
	                    </td>
	                    <td>
	                      <input type="text" name = "car_rent_redeem" class="form-control value-calc" id="car_rent_redeem" placeholder="Enter cars rent & redeem...">
	                    </td>
	                    <td>
	                      <input type="text" name="information" class="form-control" id="information" placeholder="Enter information...">
	                    </td>
	                    
	                    <td>
	                      <input type="text" name="address" class="form-control" id="address" placeholder="Enter address...">
	                    </td>
	                    <td>
	                      <input type="text" name="sl_no" class="form-control" id="sl_no" placeholder="Enter sl no...">
	                    </td>
	                    <td>
	                      <input type="text" name="delivery_no" class="form-control" id="delivery_no" placeholder="Enter delivery no...">
	                    </td>
	                    <td>
	                      <input type="text" name="motor" class="form-control" id="motor" placeholder="Enter number of motor...">
	                    </td>
	                    <td>
	                      <input type="text" name="motor_no" class="form-control" id="motor_no" placeholder="Enter motor no...">
	                    </td>
	                    <td  style = "z-index:2">
	                      <input onkeypress="datecheckformat(event)" type="text" name="delivery_date" class="form-control" id="delivery_date" placeholder="dd-mm-yyyy">
	                    </td>
	                    <td style = "z-index:2">
	                      <input onkeypress="datecheckformat(event)" type="text" name="dates" class="form-control" id="dates" placeholder="dd-mm-yyyy">
	                    </td>
	                    <td>
	                      <input type="text" name="partculars" class="form-control" id="partculars" placeholder="Enter partculars...">
	                    </td>
	                    <td>	                      
	                      <?php
	                        $rod_catgry_sql = "SELECT * FROM rod_category";
	                        $rslt_rod_catgry = $db->select($rod_catgry_sql);

	                        echo '<select name="particulars" id="particulars" class="form-control" style="width: 260px;">';
	                        echo '<option value="">Select...</option>';
	                        if($rslt_rod_catgry->num_rows > 0){
	                              while($row = $rslt_rod_catgry->fetch_assoc()){
	                                $rod_category_id = $row['id'];
	                                $rod_category_name = $row['category_name'];

	                                echo '<option style="font-weight: bold;">'. $rod_category_name . '</option>';

	                                  $rod_lbl_sql = "SELECT * FROM rod_and_other_label";
	                                  $rslt_rod_lbl = $db->select($rod_lbl_sql);
	                                  if($rslt_rod_lbl->num_rows > 0){

	                                    while($row2 = $rslt_rod_lbl->fetch_assoc()){
	                                        $raol_id = $row2['id'];
	                                        $raol_rod_label = $row2['rod_label'];
	                                        $raol_rod_category_id = $row2['rod_category_id'];


	                                        if($rod_category_id == $raol_rod_category_id){
	                                          echo "<option value='" . $raol_rod_label . "'>" . $raol_rod_label . "</option>";
	                                        }
	                                      }
	                                  } else{
	                                    echo '<option>0 results</option>';
	                                  }

	                              }

	                            } else{
	                              echo '<option>0 results</option>';
	                            }
	                        echo '</select> ';
	                      ?>

	                    </td>
	                    <td>
	                      <input type="text" onkeypress="return isNumber(event)" name="debit" class="form-control value-calc" id="debit" placeholder="Enter debit...">
	                    </td>
	                    <td>
	                      <input type="text" name="mm" class="form-control" id="mm" placeholder="Example '00 mm'...">
	                    </td>
	                    <td>
	                      <input type="text" onkeypress="return isNumber(event)" name = "motor_cash" name="kg" class="form-control value-calc" id="kg" placeholder="Enter kg...">
	                    </td>
	                    <td>
	                      <input type="text" onkeypress="return isNumber(event)" name = "motor_cash" name="paras" class="form-control value-calc" id="paras" placeholder="Enter paras...">
	                    </td>
	                    <td>
	                      <input type="text" name="credit" class="form-control" id="credit" placeholder="Enter credit...">
	                    </td>
	                    <td>
	                      <input type="text" name="discount" class="form-control" id="discount" placeholder="Enter discount...">
	                    </td>
	                    <td>
	                      <input type="text" name="balance" class="form-control" id="balance" placeholder="Enter balance...">
	                    </td>
	                    <td>
	                      <input type="text" name="bundil" class="form-control" id="bundil" placeholder="Enter bundil...">
	                    </td>
	                    <td>
	                      <input type="text" name="total_paras" class="form-control" id="total_paras" placeholder="Enter total_paras...">
	                    </td>
	                <!-- <td colspan="2"></td> -->
	              </tr>               
	            </table>
	            <h4 class="text-success text-center" id="NewEntrySucMsg"></h4>
	    </div>
	      <input onclick="valid('insert')" type="button" name = "submit" class="btn btn-primary scroll-after-btn" value="Save">

	</form>  
</div>

<div class="rodDetailsEdit"  style="display: none; position: relative;"> 
</div>

<br><br>


<?php
    $sql ="SELECT * FROM details WHERE dealer_id='$dealerId' AND project_name_id = '$project_name_id'";
    $result = $db->select($sql);
    if ($result) {
        $rowcount=mysqli_num_rows($result);
        if($rowcount != 0) {
?>
            <div id="viewDetailsSearchAfterNewEntry" style="margin-top:25px;">
              <div class="viewDetailsCon" id="viewDetails">
                  <table id="detailsNewTable2" >
                    <thead class="header">
                      <tr>
                        <th>Buyer ID:</th>
                        <th>Dealer ID:</th>
                        <th>Motor Cash</th>
                        <th>Unload</th>
                        <th>Cars rent & Redeem</th>
                        <th>Information</th>
                        <th>Address</th>
                        <th>SL</th>
                        <th>Delivery No:</th>
                        <th>Motor</th>
                        <th>Motor No</th>
                        <th>Delivery Date</th>
                        <th>Date</th>
                        <th>Partculars</th>
                        <th>Particulars</th>
                        <th>Debit</th>
                        <th>mm</th>
                        <th>Kg</th>
                        <th>Para's:</th>
                        <th>Credit</th>
                        <th>Discount</th>
                        <th>Balance</th>
                        <th>Bundil</th>
                        <th>Total Para's:</th>
                        <th class='no_print_media'></th>
                        <th class='no_print_media'></th>
                      </tr>
                      <tr>
                        <th>বায়ার আই ডি</th>
                        <th>ডিলার আই ডি</th>
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
                        <th>মোট দামঃ</th>
                        <th class='no_print_media'></th>
                        <th class='no_print_media'></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($rows = $result->fetch_assoc()) {
                          if($rows['delivery_date'] == '0000-00-00'){
                              $format_delivery_date = '';
                          } 
                          else{
                              $delivery_date = $rows['delivery_date'];
                              $format_delivery_date = date("d-m-Y", strtotime($delivery_date));
                          }
                          if($rows['dates'] == '0000-00-00'){
                              $format_dates = '';
                          } 
                          else{
                              $dates = $rows['dates'];
                              $format_dates = date("d-m-Y", strtotime($dates));
                          }
                          echo "<tr>";
                          echo "<td>". $rows['buyer_id'] ."</td>";
                          echo "<td>". $rows['dealer_id'] ."</td>";
                          echo "<td>". $rows['motor_cash'] ."</td>";
                          echo "<td>". $rows['unload'] ."</td>";
                          echo "<td>". $rows['cars_rent_redeem'] ."</td>";
                          echo "<td>". $rows['information'] ."</td>";
                          echo "<td>". $rows['address'] ."</td>";
                          echo "<td>". $rows['sl_no'] ."</td>";
                          echo "<td>". $rows['delivery_no'] ."</td>";
                          echo "<td>". $rows['motor'] ."</td>";
                          echo "<td>". $rows['motor_no'] ."</td>";
                          echo "<td>". $format_delivery_date ."</td>";
                          echo "<td>". $format_dates ."</td>";
                          echo "<td>". $rows['partculars'] ."</td>";
                          echo "<td>". $rows['particulars'] ."</td>";
                          echo "<td>". $rows['debit'] ."</td>";
                          echo "<td>". $rows['mm'] ."</td>";
                          echo "<td>". $rows['kg'] ."</td>";
                          echo "<td>". $rows['paras'] ."</td>";
                          echo "<td>". $rows['credit'] ."</td>";
                          echo "<td>". $rows['discount'] ."</td>";
                          echo "<td>". $rows['balance'] ."</td>";
                          echo "<td>". $rows['bundil'] ."</td>";
                          echo "<td>". $rows['total_paras'] ."</td>";

                          if($delete_data_permission == 'yes'){
                            echo "<td width='78px' class='no_print_media'><a class='btn btn-danger detailsDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
                          } else {
                            echo '<td width="78px" class="no_print_media"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                          }

                          if($edit_data_permission == 'yes'){
                            echo "<td width='60px' class='no_print_media'><a onclick='edit_rod_popup(this," . $rows['id'] . ")'  class='btn btn-success'>Edit</a></td>";
                          } else {
                            echo '<td width="60px" class="no_print_media"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
                          }

                          echo "</tr>";                            
                        }
                    ?>
                    </tbody>
                  </table>
              </div>
              <br><br>
            </div>
<?php
        }
        else{
            echo '<div style="width: 100%; height: 100px;"></div>';
        }
    }
?>






