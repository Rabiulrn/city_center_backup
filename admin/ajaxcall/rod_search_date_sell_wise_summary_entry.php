<?php 
	session_start();
	$getdate = $_POST['optionDate'];
	$dealerId	= $_POST['dealerId'];
	if($getdate === 'alldates'){
		$dateStr = 'alldates';
	} else {
		$dateStr = date('Y-m-d', strtotime($getdate));
	}
    // echo $dateStr;
    $project_name_id = $_SESSION['project_name_id'];
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

	if($dateStr === 'alldates'){
		//Start Sql For Summary 500W/60G
	        //Buy table data
	        $mm0450_rod500_buy = 0;
	        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $mm0450_rod500_buy = $row['kg'];
	                if(is_null($mm0450_rod500_buy)){
	                    $mm0450_rod500_buy = 0;
	                }
	            }
	        } else{
	            $mm0450_rod500_buy = 0;
	        }


	        $mm06_rod500_buy = 0;
	        $mm08_rod500_buy = 0;
	        $mm10_rod500_buy = 0;
	        $mm12_rod500_buy = 0;
	        $mm16_rod500_buy = 0;
	        $mm20_rod500_buy = 0;
	        $mm22_rod500_buy = 0;
	        $mm25_rod500_buy = 0;
	        $mm32_rod500_buy = 0;
	        $mm42_rod500_buy = 0;

	        $mmRodArry = array('06','08','10','12','16','20', '22','25','32','42');
	        $arrlength = count($mmRodArry);

	        for($i=0; $i<$arrlength; $i++){
	            // echo $mmRodArry[$i];
	            // echo "<br>";

	            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '$mmRodArry[$i] mm' OR mm = '$mmRodArry[$i]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	            $result = $db->select($sql);
	            if($result->num_rows > 0){
	                while($row = $result->fetch_assoc()){
	                    ${"mm$mmRodArry[$i]_rod500_buy"} = $row['kg'];
	                    if(is_null(${"mm$mmRodArry[$i]_rod500_buy"})){
	                        ${"mm$mmRodArry[$i]_rod500_buy"} = 0;
	                    }
	                }
	            } else{
	                ${"mm$mmRodArry[$i]_rod500_buy"} = 0;
	            }
	        }
	        $total_kg_rod500_buy = $mm0450_rod500_buy + $mm06_rod500_buy + $mm08_rod500_buy + $mm10_rod500_buy + $mm12_rod500_buy + $mm16_rod500_buy + $mm20_rod500_buy + $mm22_rod500_buy + $mm25_rod500_buy + $mm32_rod500_buy + $mm42_rod500_buy;
	        

	        //sell table data
	        $mm0450_rod500_sell = 0;
	        $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE particulars LIKE '%500W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $mm0450_rod500_sell = $row['kg'];
	                if(is_null($mm0450_rod500_sell)){
	                    $mm0450_rod500_sell = 0;
	                }
	            }
	        } else{
	            $mm0450_rod500_sell = 0;
	        }

	        


	        $mm06_rod500_sell = 0;
	        $mm08_rod500_sell = 0;
	        $mm10_rod500_sell = 0;
	        $mm12_rod500_sell = 0;
	        $mm16_rod500_sell = 0;
	        $mm20_rod500_sell = 0;
	        $mm22_rod500_sell = 0;
	        $mm25_rod500_sell = 0;
	        $mm32_rod500_sell = 0;
	        $mm42_rod500_sell = 0;

	        $mmRodArry = array('06','08','10','12','16','20', '22','25','32','42');
	        $arrlength = count($mmRodArry);

	        for($i=0; $i<$arrlength; $i++){
	            // echo $mmRodArry[$i];
	            // echo "<br>";

	            $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE particulars LIKE '%500W%' AND (mm = '$mmRodArry[$i] mm' OR mm = '$mmRodArry[$i]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	            $result = $db->select($sql);
	            if($result->num_rows > 0){
	                while($row = $result->fetch_assoc()){
	                    ${"mm$mmRodArry[$i]_rod500_sell"} = $row['kg'];
	                    if(is_null(${"mm$mmRodArry[$i]_rod500_sell"})){
	                        ${"mm$mmRodArry[$i]_rod500_sell"} = 0;
	                    }
	                }
	            } else{
	                ${"mm$mmRodArry[$i]_rod500_sell"} = 0;
	            }
	        }
	        
	        $total_kg_rod500_sell = $mm0450_rod500_sell + $mm06_rod500_sell + $mm08_rod500_sell + $mm10_rod500_sell + $mm12_rod500_sell + $mm16_rod500_sell + $mm20_rod500_sell + $mm22_rod500_sell + $mm25_rod500_sell + $mm32_rod500_sell + $mm42_rod500_sell;


	        $mm0450_rod500 = $mm0450_rod500_buy - $mm0450_rod500_sell;
	        $mm06_rod500 = $mm06_rod500_buy - $mm06_rod500_sell;
	        $mm08_rod500 = $mm08_rod500_buy - $mm08_rod500_sell;
	        // echo $mm8_rod500_buy.'<br>'.$mm8_rod500_sell;
	        $mm10_rod500 = $mm10_rod500_buy - $mm10_rod500_sell;
	        $mm12_rod500 = $mm12_rod500_buy - $mm12_rod500_sell;
	        $mm16_rod500 = $mm16_rod500_buy - $mm16_rod500_sell;
	        $mm20_rod500 = $mm20_rod500_buy - $mm20_rod500_sell;
	        $mm22_rod500 = $mm22_rod500_buy - $mm22_rod500_sell;
	        $mm25_rod500 = $mm25_rod500_buy - $mm25_rod500_sell;
	        $mm32_rod500 = $mm32_rod500_buy - $mm32_rod500_sell;
	        $mm42_rod500 = $mm42_rod500_buy - $mm42_rod500_sell;


	        $total_kg_rod500 = $total_kg_rod500_buy - $total_kg_rod500_sell;
	    //End Sql For Summary 500W/60G

	    //Start Sql For Summary 400W/60G
	        //Buy table data
	        $mm0450_rod400_buy = 0;
	        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $mm0450_rod400_buy = $row['kg'];
	                if(is_null($mm0450_rod400_buy)){
	                    $mm0450_rod400_buy = 0;
	                }
	            }
	        } else{
	            $mm0450_rod400_buy = 0;
	        }


	        $mm06_rod400_buy = 0;
	        $mm08_rod400_buy = 0;
	        $mm10_rod400_buy = 0;
	        $mm12_rod400_buy = 0;
	        $mm16_rod400_buy = 0;
	        $mm20_rod400_buy = 0;
	        $mm22_rod400_buy = 0;
	        $mm25_rod400_buy = 0;
	        $mm32_rod400_buy = 0;
	        $mm42_rod400_buy = 0;

	        $mmRodArry2 = array('06','08','10','12','16','20', '22','25','32','42');
	        $arrlength2 = count($mmRodArry2);

	        for($j=0; $j<$arrlength2; $j++){
	            // echo $mmRodArry2[$j];
	            // echo "<br>";

	            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '$mmRodArry2[$j] mm' OR mm = '$mmRodArry2[$j]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	            $result = $db->select($sql);
	            if($result->num_rows > 0){
	                while($row = $result->fetch_assoc()){
	                    ${"mm$mmRodArry2[$j]_rod400_buy"} = $row['kg'];
	                    if(is_null(${"mm$mmRodArry2[$j]_rod400_buy"})){
	                        ${"mm$mmRodArry2[$j]_rod400_buy"} = 0;
	                    }
	                }
	            } else{
	                ${"mm$mmRodArry2[$j]_rod400_buy"} = 0;
	            }
	        }
	        $total_kg_rod400_buy = $mm0450_rod400_buy + $mm06_rod400_buy + $mm08_rod400_buy + $mm10_rod400_buy + $mm12_rod400_buy + $mm16_rod400_buy + $mm20_rod400_buy + $mm22_rod400_buy + $mm25_rod400_buy + $mm32_rod400_buy + $mm42_rod400_buy;

	        //sell table data
	        $mm0450_rod400_sell = 0;
	        $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE particulars LIKE '%400W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $mm0450_rod400_sell = $row['kg'];
	                if(is_null($mm0450_rod400_sell)){
	                    $mm0450_rod400_sell = 0;
	                }
	            }
	        } else{
	            $mm0450_rod400_sell = 0;
	        }


	        $mm06_rod400_sell = 0;
	        $mm08_rod400_sell = 0;
	        $mm10_rod400_sell = 0;
	        $mm12_rod400_sell = 0;
	        $mm16_rod400_sell = 0;
	        $mm20_rod400_sell = 0;
	        $mm22_rod400_sell = 0;
	        $mm25_rod400_sell = 0;
	        $mm32_rod400_sell = 0;
	        $mm42_rod400_sell = 0;

	        $mmRodArry2 = array('06','08','10','12','16','20', '22','25','32','42');
	        $arrlength2 = count($mmRodArry2);

	        for($j=0; $j<$arrlength2; $j++){
	            // echo $mmRodArry2[$j];
	            // echo "<br>";

	            $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE particulars LIKE '%400W%' AND (mm = '$mmRodArry2[$j] mm' OR mm = '$mmRodArry2[$j]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	            $result = $db->select($sql);
	            if($result->num_rows > 0){
	                while($row = $result->fetch_assoc()){
	                    ${"mm$mmRodArry2[$j]_rod400_sell"} = $row['kg'];
	                    if(is_null(${"mm$mmRodArry2[$j]_rod400_sell"})){
	                        ${"mm$mmRodArry2[$j]_rod400_sell"} = 0;
	                    }
	                }
	            } else{
	                ${"mm$mmRodArry2[$j]_rod400_sell"} = 0;
	            }
	        }
	        $total_kg_rod400_sell = $mm0450_rod400_sell + $mm06_rod400_sell + $mm08_rod400_sell + $mm10_rod400_sell + $mm12_rod400_sell + $mm16_rod400_sell + $mm20_rod400_sell + $mm22_rod400_sell + $mm25_rod400_sell + $mm32_rod400_sell + $mm42_rod400_sell;




	        $mm0450_rod400 = $mm0450_rod400_buy - $mm0450_rod400_sell;
	        $mm06_rod400 = $mm06_rod400_buy - $mm06_rod400_sell;
	        $mm08_rod400 = $mm08_rod400_buy - $mm08_rod400_sell;
	        $mm10_rod400 = $mm10_rod400_buy - $mm10_rod400_sell;
	        $mm12_rod400 = $mm12_rod400_buy - $mm12_rod400_sell;
	        $mm16_rod400 = $mm16_rod400_buy - $mm16_rod400_sell;
	        $mm20_rod400 = $mm20_rod400_buy - $mm20_rod400_sell;
	        $mm22_rod400 = $mm22_rod400_buy - $mm22_rod400_sell;
	        $mm25_rod400 = $mm25_rod400_buy - $mm25_rod400_sell;
	        $mm32_rod400 = $mm32_rod400_buy - $mm32_rod400_sell;
	        $mm42_rod400 = $mm42_rod400_buy - $mm42_rod400_sell;


	        $total_kg_rod400 = $total_kg_rod400_buy - $total_kg_rod400_sell;
	    //End Sql For Summary 400W/60G


	    //Start Gari vara
	        $sql = "SELECT SUM(motor_cash) as motor_cash FROM details_sell WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(unload) as unload FROM details_sell WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(motor) as motor FROM details_sell WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(debit) as debit FROM details_sell WHERE particulars = 'BG' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $gb_bank_ganti = $row['debit'];
	                if(is_null($gb_bank_ganti)){
	                    $gb_bank_ganti = 0;
	                }
	            }
	        } else{
	            $gb_bank_ganti = 0;
	        }
	        
	    //End GB Bank Ganti
	    // Start total total_kg
	        $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(credit) as credit FROM details_sell WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(debit) as debit FROM details_sell WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(balance) as balance FROM details_sell WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(total_paras) as total_paras FROM details_sell WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
		<table width="100%" class="summary">
			<tr>
				<td class="hastext" width="150px">04.50mm 500W/60G</td>
				<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td>
				<td class="hastext" width="150px">04.50mm 400W/60G</td>
				<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td>
	            <td class="hastext">মোট কেজিঃ</td>
	            <td style="min-width: 85px"><?php echo $total_kg; ?></td>
				<td class="hastext">জ‌িব‌ি ব্যাংক গ্যান্ট‌িঃ</td>
				<td style="min-width: 85px"><?php echo $gb_bank_ganti; ?></td>
							
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
				<td></td>
	            <td></td>
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
	            <td><?php echo $motor_cash; ?></td>
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
<?php
	} else{
		//Any date then date wise summary show
		//Start Sql For Summary 500W/60G
	        //Buy table data
	        $mm0450_rod500_buy = 0;
	        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $mm0450_rod500_buy = $row['kg'];
	                if(is_null($mm0450_rod500_buy)){
	                    $mm0450_rod500_buy = 0;
	                }
	            }
	        } else{
	            $mm0450_rod500_buy = 0;
	        }


	        $mm06_rod500_buy = 0;
	        $mm08_rod500_buy = 0;
	        $mm10_rod500_buy = 0;
	        $mm12_rod500_buy = 0;
	        $mm16_rod500_buy = 0;
	        $mm20_rod500_buy = 0;
	        $mm22_rod500_buy = 0;
	        $mm25_rod500_buy = 0;
	        $mm32_rod500_buy = 0;
	        $mm42_rod500_buy = 0;

	        $mmRodArry = array('06','08','10','12','16','20', '22','25','32','42');
	        $arrlength = count($mmRodArry);

	        for($i=0; $i<$arrlength; $i++){
	            // echo $mmRodArry[$i];
	            // echo "<br>";

	            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '$mmRodArry[$i] mm' OR mm = '$mmRodArry[$i]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	            $result = $db->select($sql);
	            if($result->num_rows > 0){
	                while($row = $result->fetch_assoc()){
	                    ${"mm$mmRodArry[$i]_rod500_buy"} = $row['kg'];
	                    if(is_null(${"mm$mmRodArry[$i]_rod500_buy"})){
	                        ${"mm$mmRodArry[$i]_rod500_buy"} = 0;
	                    }
	                }
	            } else{
	                ${"mm$mmRodArry[$i]_rod500_buy"} = 0;
	            }
	        }
	        $total_kg_rod500_buy = $mm0450_rod500_buy + $mm06_rod500_buy + $mm08_rod500_buy + $mm10_rod500_buy + $mm12_rod500_buy + $mm16_rod500_buy + $mm20_rod500_buy + $mm22_rod500_buy + $mm25_rod500_buy + $mm32_rod500_buy + $mm42_rod500_buy;
	        

	        //sell table data
	        $mm0450_rod500_sell = 0;
	        $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE particulars LIKE '%500W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $mm0450_rod500_sell = $row['kg'];
	                if(is_null($mm0450_rod500_sell)){
	                    $mm0450_rod500_sell = 0;
	                }
	            }
	        } else{
	            $mm0450_rod500_sell = 0;
	        }

	        


	        $mm06_rod500_sell = 0;
	        $mm08_rod500_sell = 0;
	        $mm10_rod500_sell = 0;
	        $mm12_rod500_sell = 0;
	        $mm16_rod500_sell = 0;
	        $mm20_rod500_sell = 0;
	        $mm22_rod500_sell = 0;
	        $mm25_rod500_sell = 0;
	        $mm32_rod500_sell = 0;
	        $mm42_rod500_sell = 0;

	        $mmRodArry = array('06','08','10','12','16','20', '22','25','32','42');
	        $arrlength = count($mmRodArry);

	        for($i=0; $i<$arrlength; $i++){
	            // echo $mmRodArry[$i];
	            // echo "<br>";

	            $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE particulars LIKE '%500W%' AND (mm = '$mmRodArry[$i] mm' OR mm = '$mmRodArry[$i]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	            $result = $db->select($sql);
	            if($result->num_rows > 0){
	                while($row = $result->fetch_assoc()){
	                    ${"mm$mmRodArry[$i]_rod500_sell"} = $row['kg'];
	                    if(is_null(${"mm$mmRodArry[$i]_rod500_sell"})){
	                        ${"mm$mmRodArry[$i]_rod500_sell"} = 0;
	                    }
	                }
	            } else{
	                ${"mm$mmRodArry[$i]_rod500_sell"} = 0;
	            }
	        }
	        
	        $total_kg_rod500_sell = $mm0450_rod500_sell + $mm06_rod500_sell + $mm08_rod500_sell + $mm10_rod500_sell + $mm12_rod500_sell + $mm16_rod500_sell + $mm20_rod500_sell + $mm22_rod500_sell + $mm25_rod500_sell + $mm32_rod500_sell + $mm42_rod500_sell;


	        $mm0450_rod500 = $mm0450_rod500_buy - $mm0450_rod500_sell;
	        $mm06_rod500 = $mm06_rod500_buy - $mm06_rod500_sell;
	        $mm08_rod500 = $mm08_rod500_buy - $mm08_rod500_sell;
	        // echo $mm8_rod500_buy.'<br>'.$mm8_rod500_sell;
	        $mm10_rod500 = $mm10_rod500_buy - $mm10_rod500_sell;
	        $mm12_rod500 = $mm12_rod500_buy - $mm12_rod500_sell;
	        $mm16_rod500 = $mm16_rod500_buy - $mm16_rod500_sell;
	        $mm20_rod500 = $mm20_rod500_buy - $mm20_rod500_sell;
	        $mm22_rod500 = $mm22_rod500_buy - $mm22_rod500_sell;
	        $mm25_rod500 = $mm25_rod500_buy - $mm25_rod500_sell;
	        $mm32_rod500 = $mm32_rod500_buy - $mm32_rod500_sell;
	        $mm42_rod500 = $mm42_rod500_buy - $mm42_rod500_sell;


	        $total_kg_rod500 = $total_kg_rod500_buy - $total_kg_rod500_sell;
	    //End Sql For Summary 500W/60G

	    //Start Sql For Summary 400W/60G
	        //Buy table data
	        $mm0450_rod400_buy = 0;
	        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $mm0450_rod400_buy = $row['kg'];
	                if(is_null($mm0450_rod400_buy)){
	                    $mm0450_rod400_buy = 0;
	                }
	            }
	        } else{
	            $mm0450_rod400_buy = 0;
	        }


	        $mm06_rod400_buy = 0;
	        $mm08_rod400_buy = 0;
	        $mm10_rod400_buy = 0;
	        $mm12_rod400_buy = 0;
	        $mm16_rod400_buy = 0;
	        $mm20_rod400_buy = 0;
	        $mm22_rod400_buy = 0;
	        $mm25_rod400_buy = 0;
	        $mm32_rod400_buy = 0;
	        $mm42_rod400_buy = 0;

	        $mmRodArry2 = array('06','08','10','12','16','20', '22','25','32','42');
	        $arrlength2 = count($mmRodArry2);

	        for($j=0; $j<$arrlength2; $j++){
	            // echo $mmRodArry2[$j];
	            // echo "<br>";

	            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '$mmRodArry2[$j] mm' OR mm = '$mmRodArry2[$j]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	            $result = $db->select($sql);
	            if($result->num_rows > 0){
	                while($row = $result->fetch_assoc()){
	                    ${"mm$mmRodArry2[$j]_rod400_buy"} = $row['kg'];
	                    if(is_null(${"mm$mmRodArry2[$j]_rod400_buy"})){
	                        ${"mm$mmRodArry2[$j]_rod400_buy"} = 0;
	                    }
	                }
	            } else{
	                ${"mm$mmRodArry2[$j]_rod400_buy"} = 0;
	            }
	        }
	        $total_kg_rod400_buy = $mm0450_rod400_buy + $mm06_rod400_buy + $mm08_rod400_buy + $mm10_rod400_buy + $mm12_rod400_buy + $mm16_rod400_buy + $mm20_rod400_buy + $mm22_rod400_buy + $mm25_rod400_buy + $mm32_rod400_buy + $mm42_rod400_buy;

	        //sell table data
	        $mm0450_rod400_sell = 0;
	        $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE particulars LIKE '%400W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $mm0450_rod400_sell = $row['kg'];
	                if(is_null($mm0450_rod400_sell)){
	                    $mm0450_rod400_sell = 0;
	                }
	            }
	        } else{
	            $mm0450_rod400_sell = 0;
	        }


	        $mm06_rod400_sell = 0;
	        $mm08_rod400_sell = 0;
	        $mm10_rod400_sell = 0;
	        $mm12_rod400_sell = 0;
	        $mm16_rod400_sell = 0;
	        $mm20_rod400_sell = 0;
	        $mm22_rod400_sell = 0;
	        $mm25_rod400_sell = 0;
	        $mm32_rod400_sell = 0;
	        $mm42_rod400_sell = 0;

	        $mmRodArry2 = array('06','08','10','12','16','20', '22','25','32','42');
	        $arrlength2 = count($mmRodArry2);

	        for($j=0; $j<$arrlength2; $j++){
	            // echo $mmRodArry2[$j];
	            // echo "<br>";

	            $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE particulars LIKE '%400W%' AND (mm = '$mmRodArry2[$j] mm' OR mm = '$mmRodArry2[$j]mm') AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
	            $result = $db->select($sql);
	            if($result->num_rows > 0){
	                while($row = $result->fetch_assoc()){
	                    ${"mm$mmRodArry2[$j]_rod400_sell"} = $row['kg'];
	                    if(is_null(${"mm$mmRodArry2[$j]_rod400_sell"})){
	                        ${"mm$mmRodArry2[$j]_rod400_sell"} = 0;
	                    }
	                }
	            } else{
	                ${"mm$mmRodArry2[$j]_rod400_sell"} = 0;
	            }
	        }
	        $total_kg_rod400_sell = $mm0450_rod400_sell + $mm06_rod400_sell + $mm08_rod400_sell + $mm10_rod400_sell + $mm12_rod400_sell + $mm16_rod400_sell + $mm20_rod400_sell + $mm22_rod400_sell + $mm25_rod400_sell + $mm32_rod400_sell + $mm42_rod400_sell;




	        $mm0450_rod400 = $mm0450_rod400_buy - $mm0450_rod400_sell;
	        $mm06_rod400 = $mm06_rod400_buy - $mm06_rod400_sell;
	        $mm08_rod400 = $mm08_rod400_buy - $mm08_rod400_sell;
	        $mm10_rod400 = $mm10_rod400_buy - $mm10_rod400_sell;
	        $mm12_rod400 = $mm12_rod400_buy - $mm12_rod400_sell;
	        $mm16_rod400 = $mm16_rod400_buy - $mm16_rod400_sell;
	        $mm20_rod400 = $mm20_rod400_buy - $mm20_rod400_sell;
	        $mm22_rod400 = $mm22_rod400_buy - $mm22_rod400_sell;
	        $mm25_rod400 = $mm25_rod400_buy - $mm25_rod400_sell;
	        $mm32_rod400 = $mm32_rod400_buy - $mm32_rod400_sell;
	        $mm42_rod400 = $mm42_rod400_buy - $mm42_rod400_sell;


	        $total_kg_rod400 = $total_kg_rod400_buy - $total_kg_rod400_sell;
	    //End Sql For Summary 400W/60G


	    //Start Gari vara
	        $sql = "SELECT SUM(motor_cash) as motor_cash FROM details_sell WHERE dealer_id = '$dealerId' AND dates = '$dateStr' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(unload) as unload FROM details_sell WHERE dealer_id = '$dealerId' AND dates = '$dateStr' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(motor) as motor FROM details_sell WHERE dealer_id = '$dealerId' AND dates = '$dateStr' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(debit) as debit FROM details_sell WHERE particulars = 'BG' AND project_name_id = '$project_name_id'";
	        $result = $db->select($sql);
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $gb_bank_ganti = $row['debit'];
	                if(is_null($gb_bank_ganti)){
	                    $gb_bank_ganti = 0;
	                }
	            }
	        } else{
	            $gb_bank_ganti = 0;
	        }
	        
	    //End GB Bank Ganti
	    // Start total total_kg
	        $sql = "SELECT SUM(kg) as kg FROM details_sell WHERE dealer_id = '$dealerId' AND dates = '$dateStr' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(credit) as credit FROM details_sell WHERE dealer_id = '$dealerId' AND dates = '$dateStr' AND project_name_id = '$project_name_id'";
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
	        $total_debit = 0;
	        $sql = "SELECT SUM(debit) as debit FROM details_sell WHERE dealer_id = '$dealerId' AND dates = '$dateStr' AND project_name_id = '$project_name_id'";
	        if($result->num_rows > 0){
	            while($row = $result->fetch_assoc()){
	                $total_debit = $row['debit'];
	                if(is_null($total_debit)){
	                    $total_debit = 0;
	                }
	            }
	            // var_dump($total_debit);
	        } else{
	            $total_debit = 0;
	        }
	    // End total total_debit/joma

	    // Start total total_Balance/mot_jer
	        $sql = "SELECT SUM(balance) as balance FROM details_sell WHERE dealer_id = '$dealerId' AND dates = '$dateStr' AND project_name_id = '$project_name_id'";
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
	        $sql = "SELECT SUM(total_paras) as total_paras FROM details_sell WHERE dealer_id = '$dealerId' AND dates = '$dateStr' AND project_name_id = '$project_name_id'";
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
		// echo $total_debit;
	    $nij_paona = $total_debit - $total_credit;

	    $company_paona = ($total_debit - $total_credit) - $gb_bank_ganti;
?>
		<table width="100%" class="summary">
			<tr>
				<td class="hastext" width="150px">04.50mm 500W/60G</td>
				<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td>
				<td class="hastext" width="150px">04.50mm 400W/60G</td>
				<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td>
	            <td class="hastext">মোট কেজিঃ</td>
	            <td style="min-width: 85px"><?php echo $total_kg; ?></td>
				<td class="hastext">জ‌িব‌ি ব্যাংক গ্যান্ট‌িঃ</td>
				<td style="min-width: 85px"><?php echo $gb_bank_ganti; ?></td>
							
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
				<td></td>
	            <td></td>
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
	            <td><?php echo $motor_cash; ?></td>
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
<?php
	}
?>