<?php 
	session_start();
	$optionDate = date('Y-m-d', strtotime($_POST['optionDate']));
	// echo $optionDate;
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();

    //Start Sql For Summary 500W/60G
        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dates='$optionDate'";
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


        $mm6_rod500 = 0;
        $mm8_rod500 = 0;
        $mm10_rod500 = 0;
        $mm12_rod500 = 0;
        $mm16_rod500 = 0;
        $mm20_rod500 = 0;
        $mm25_rod500 = 0;
        $mm32_rod500 = 0;
        $mm42_rod500 = 0;

        $mmRodArry = array(6,8,10,12,16,20,25,32,42);
        $arrlength = count($mmRodArry);

        for($i=0; $i<$arrlength; $i++){
            // echo $mmRodArry[$i];
            // echo "<br>";

            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '$mmRodArry[$i] mm' OR mm = '$mmRodArry[$i]mm') AND dates='$optionDate'";
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
        $total_kg_rod500 = $mm0450_rod500 + $mm6_rod500 + $mm8_rod500 + $mm10_rod500 + $mm12_rod500 + $mm16_rod500 + $mm20_rod500 + $mm25_rod500 + $mm32_rod500 + $mm42_rod500;
    //End Sql For Summary 500W/60G

    //Start Sql For Summary 400W/60G
        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '04.50 mm' OR mm = '04.50mm') AND dates='$optionDate'";
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


        $mm6_rod400 = 0;
        $mm8_rod400 = 0;
        $mm10_rod400 = 0;
        $mm12_rod400 = 0;
        $mm16_rod400 = 0;
        $mm20_rod400 = 0;
        $mm25_rod400 = 0;
        $mm32_rod400 = 0;
        $mm42_rod400 = 0;

        $mmRodArry2 = array(6,8,10,12,16,20,25,32,42);
        $arrlength2 = count($mmRodArry2);

        for($j=0; $j<$arrlength2; $j++){
            // echo $mmRodArry2[$j];
            // echo "<br>";

            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '$mmRodArry2[$j] mm' OR mm = '$mmRodArry2[$j]mm') AND dates='$optionDate'";
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
        $total_kg_rod400 = $mm0450_rod400 + $mm6_rod400 + $mm8_rod400 + $mm10_rod400 + $mm12_rod400 + $mm16_rod400 + $mm20_rod400 + $mm25_rod400 + $mm32_rod400 + $mm42_rod400;
    //End Sql For Summary 400W/60G


    //Start Total para
        $sql = "SELECT SUM(total_paras) as total_paras FROM details WHERE dates='$optionDate'";
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
    //End Total para
    
    // Start total total_Balance
        $sql = "SELECT SUM(balance) as balance FROM details WHERE dates='$optionDate'";
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
    // End total total_Balance
    
    // Start total total_debit
        $sql = "SELECT SUM(debit) as debit FROM details WHERE dates='$optionDate'";
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
    // End total total_debit
    
    // Start total total_credit
        $sql = "SELECT SUM(credit) as credit FROM details WHERE dates='$optionDate'";
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
    // End total total_credit
    
    // Start total total_kg
        $sql = "SELECT SUM(kg) as kg FROM details WHERE dates='$optionDate'";
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
        $total_ton = $total_kg/100;
    // End total total_kg
    
    // Start total total_motor
        $sql = "SELECT SUM(motor) as motor FROM details WHERE dates='$optionDate'";
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
    $nij_paona = $total_debit - $total_credit;

    //Start GB Bank Ganti
        $sql = "SELECT SUM(debit) as debit FROM details WHERE particulars = 'BG'";
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
        $company_paona = ($total_debit - $total_credit) - $gb_bank_ganti;
    //End GB Bank Ganti

    //Start Dealer customer info
        $query = "SELECT * FROM dealers WHERE id = '10'";
        $result = $db->select($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $id             = $row['id'];
                $dealer_id      = $row['dealer_id'];
                $dealer_name    = $row['dealer_name'];
                $address        = $row['address'];
                $contact_person_name = $row['contact_person_name'];
                $mobile              = $row['mobile'];
                
            }
        } else{
            echo "Dealer id 10 not found.";
        }


        $query = "SELECT * FROM customers WHERE id = '16'";
        $result = $db->select($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $id               = $row['id'];
                $customer_id      = $row['customer_id'];
                $customer_name    = $row['customer_name'];
                $customer_address = $row['address'];
                $custpmer_mobile  = $row['mobile'];
                $buying_type      = $row['buying_type'];
                
            }
        } else{
            echo "Dealer id 10 not found.";
        }
    //End Dealer customer info
    
    //Start Gari vara
        $sql = "SELECT SUM(motor_cash) as motor_cash FROM details WHERE dates='$optionDate'";
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
        $sql = "SELECT SUM(unload) as unload FROM details WHERE dates='$optionDate'";
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
    //End khalas/Unload
    
    //Start All kg adding
        $sql = "SELECT SUM(kg) as kg FROM details WHERE dates='$optionDate'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_kg = $row['kg'];
                if(is_null($all_kg)){
                    $all_kg = 0;
                }
            }
        } else{
            $all_kg = 0;
        }
    //End All kg adding
    
    //Start All paras adding
        $sql = "SELECT SUM(paras) as paras FROM details WHERE dates='$optionDate'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_paras = $row['paras'];
                if(is_null($all_paras)){
                    $all_paras = 0;
                }
            }
        } else{
            $all_paras = 0;
        }
    //End All paras adding
    
    //Start All discount adding
        $sql = "SELECT SUM(discount) as discount FROM details WHERE dates='$optionDate'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_discount = $row['discount'];
                if(is_null($all_discount)){
                    $all_discount = 0;
                }
            }
        } else{
            $all_discount = 0;
        }
    //End All discount adding
    
    //Start All debit adding
        $sql = "SELECT SUM(debit) as debit FROM details WHERE dates='$optionDate'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_debit = $row['debit'];
                if(is_null($all_debit)){
                    $all_debit = 0;
                }
            }
        } else{
            $all_debit = 0;
        }
    //End All debit adding
    $mul = ($all_kg * $all_paras - $all_discount) - $all_debit;
    //Start All bundil adding
        $sql = "SELECT SUM(bundil) as bundil FROM details WHERE dates='$optionDate'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_bundil = $row['bundil'];
                if(is_null($all_bundil)){
                    $all_bundil = 0;
                }
            }
        } else{
            $all_bundil = 0;
        }
    //End All bundil adding
?>



<table id="detailsNewTable1">
  <tr>
    <td class="ntfc1 noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc3 noborderk"></td>
    <td class="ntfc4 noborderk"></td>
    <td class="ntfc5 noborderk"></td>

    <td class="ntfc6" width="160px">04.50mm 500W/60G</td>
    <td><?php echo $mm0450_rod500; ?></td>
    <td class="ntfc8" width="160px">04.50mm 400W/60G</td>
    <td><?php echo $mm0450_rod400; ?></td>
    

    <td colspan="6" rowspan="2" class="ntHeading noborderk"><?php echo $dealer_name; ?></td>
    <!-- <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td> -->

    <td colspan="2" class="twodate">01.2016 & 12.2016</td>
    <!-- <td></td> -->
    <td class="noborderk" width="100px"></td>
    <td class="ntfc18 noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc20 noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc22 noborderk"></td>
    <td class="align-center">Logout</td>
  </tr>
  <!-- 2nd row -->
  <tr>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc5 noborderk"></td>

    <td>06mm 500W/60G</td>
    <td><?php echo $mm6_rod500; ?></td>
    <td>06mm 400W/60G</td>
    <td><?php echo $mm6_rod400; ?></td>
    
    <!-- <td colspan="6"></td> -->
    <!-- <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td> -->

    <td align="right">জিবি ব্যাংক গ্যান্টিঃ</td>
    <td><?php echo $gb_bank_ganti; ?></td>
    <td class="noborderk"></td>
    <td align="right">মোট কেজিঃ</td>
    <td><?php echo $total_kg; ?></td>
    <td align="right">মোট মূলঃ</td>
    <td><?php echo $total_credit; ?></td>
    <td align="right">Password</td>
    <td></td>
  </tr>
  <!-- 3rd row -->
  <tr>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc5 noborderk"></td>

    <td>08mm 500W/60G</td>
    <td><?php echo $mm8_rod500; ?></td>
    <td>08mm 400W/60G</td>
    <td><?php echo $mm8_rod400; ?></td>
    

    <td colspan="6" class="ntsubHeading noborderk"><?php echo $buying_type; ?></td>
    <!-- <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td> -->

    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
  </tr>
  <!-- 4th row -->
  <tr>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc5 noborderk"></td>

    <td>10mm 500W/60G</td>
    <td><?php echo $mm10_rod500; ?></td>
    <td>10mm 400W/60G</td>
    <td><?php echo $mm10_rod400; ?></td>

    
    <td colspan="6" class="align-center noborderk"><?php echo $contact_person_name; ?></td>
    <!-- <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td> -->

    <td align="right">কম্পানি পাওনাঃ</td>
    <td><?php echo $company_paona; ?></td>
    <td class="noborderk"></td>
    <td align="right">মোট টোনঃ</td>
    <td><?php echo round($total_ton,2); ?></td>
    <td align="right">মোট জমাঃ</td>
    <td><?php echo $total_debit; ?></td>
    <td align="right">মোট মূল খরচ সহঃ</td>
    <td><?php echo $total_paras; ?></td>
  </tr>
  <!-- 5th row -->
  <tr>
    <td align="right">গাড়ী ভাড়া</td>
    <td width="100px"><?php echo $motor_cash; ?></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc5 noborderk"></td>

    <td>12mm 500W/60G</td>
    <td><?php echo $mm12_rod500; ?></td>
    <td>12mm 400W/60G</td>
    <td><?php echo $mm12_rod400; ?></td>
    
    <td colspan="6" class="align-center noborderk"><?php echo $address; ?></td>
    <!-- <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td> -->

    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
  </tr>
  <!-- 6th row -->
  <tr>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc5 noborderk"></td>

    <td>16mm 500W/60G</td>
    <td><?php echo $mm16_rod500; ?></td>
    <td>16mm 400W/60G</td>
    <td><?php echo $mm16_rod400; ?></td>
    
    <td colspan="6" class="align-center noborderk">Customer ID: <b><?php echo $customer_id; ?></b></td>
    <!-- <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td> -->

    <td align="right">নিজ পাওনাঃ</td>
    <td><?php echo $nij_paona; ?></td>
    <td class="noborderk"></td>
    <td align="right">মোট গাড়ীঃ</td>
    <td><?php echo $total_motor; ?></td>
    <td align="right">মোট জেরঃ</td>
    <td><?php echo $total_balance; ?></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
  </tr>
  <!-- 7th row -->
  <tr>
    <td align="right">খালাস</td>
    <td><?php echo $unload; ?></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc5 noborderk"></td>

    <td>20mm 500W/60G</td>
    <td><?php echo $mm20_rod500; ?></td>
    <td>20mm 500W/60G</td>
    <td><?php echo $mm20_rod400; ?></td>
    
    <td colspan="6" class="noborderk"></td>
    <!-- <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td> -->

    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
  </tr>
  <!-- 8th row -->
  <tr>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="ntfc5 noborderk"></td>

    <td>25mm 500W/60G</td>
    <td><?php echo $mm25_rod500; ?></td>
    <td>25mm 400W/60G</td>
    <td><?php echo $mm25_rod400; ?></td>
    
    <td colspan="5" class="noborderk"></td>
    <td class="ntDelearid" align="right">ডিলার আই ডিঃ</td>
    
    <td align="center">
        <?php
            $sql = "SELECT DISTINCT dealer_id FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 100px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $info_dealer_id = $row['dealer_id'];
                        if($info_dealer_id == ''){
                        
                        } else {
                            echo '<option value="'.$info_dealer_id.'">'. $info_dealer_id .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">ঠিকানাঃ</td>
    <td align="center">
        <?php
            $sql = "SELECT DISTINCT address FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 100px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $info_address = $row['address'];
                        if($info_address == ''){
                        
                        } else {
                            echo '<option value="'.$info_address.'">'. $info_address .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">ক্রমিক নংঃ</td>
    <td align="center">
        <?php
            $sql = "SELECT DISTINCT sl_no FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 100%;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $info_sl_no = $row['sl_no'];
                        if($info_sl_no == ''){
                        
                        } else {
                            echo '<option value="'.$info_sl_no.'">'. $info_sl_no .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">ভাউচার নংঃ</td>
    <td align="center">
        <?php
            $sql = "SELECT DISTINCT delivery_no FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 100%;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $info_delivery_no = $row['delivery_no'];
                        if($info_delivery_no == ''){
                        
                        } else {
                            echo '<option value="'.$info_delivery_no.'">'. $info_delivery_no .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">গাড়ীঃ</td>
    <td><?php echo $total_motor; ?></td>
  </tr>
  <!-- 9th row -->
  <tr>
    <td colspan="2" align="right">মালের বিবরণ</td>
    <!-- <td></td> -->
    <td colspan="2" align="center">
        <?php
            // $sql = "SELECT information FROM details WHERE information IS NOT NULL";
            $sql = "SELECT information FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 140px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){

                    while($row = $result->fetch_assoc()){
                        $info = $row['information'];
                        if($info == ''){
                        
                        } else {
                            echo '<option value="'.$info.'">'. $info .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <!-- <td></td> -->
    <td class="ntfc5 noborderk"></td>

    <td>32mm 500W/60G</td>
    <td><?php echo $mm32_rod500; ?></td>
    <td>32mm 400W/60G</td>
    <td><?php echo $mm32_rod400; ?></td>
    
    <td colspan="5" class="noborderk"></td>
    <td class="noborderk"></td>
    <!-- <td></td>
    <td></td>
    <td></td>
    <td></td> -->

    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
  </tr>
  <!-- 10th row -->
  <tr>
    <td colspan="2" class="noborderk"></td>
    <!-- <td></td> -->
    <td colspan="2" class="noborderk"></td>
    <!-- <td></td> -->
    <td class="ntfc5" class="noborderk"></td>

    <td>42mm 500W/60G</td>
    <td><?php echo $mm42_rod500; ?></td>
    <td>42mm 400W/60G</td>
    <td><?php echo $mm42_rod400; ?></td>
    
    <td class="ntopeningDate" align="right" width="120px">Opening Date:</td>
    <td class="ntopeningDate">
    	<?php
            $sql = "SELECT DISTINCT dates FROM details ORDER BY dates ASC LIMIT 2";
            $result = $db->select($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $last_dates = $row['dates'];
                        if($last_dates == '0000-00-00'){
                            
                        } else {
                            $postDateArr    = explode('-', $last_dates);
                            $new_last_dates  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
                            echo $new_last_dates;
                        }
                    }

                } else{
                    echo 'Not Found';
                }
        ?>
    </td>
    <td class="ntEmptyCollumn noborderk" ></td>
    <td class="ntGarino" align="right">গাড়ী নাম্বারঃ</td>
    <td class="ntGarino" align="center">
        <?php
            // $sql = "SELECT DISTINCT motor_no FROM details WHERE motor_no IS NOT NULL";
            $sql = "SELECT DISTINCT motor_no FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 140px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){

                    while($row = $result->fetch_assoc()){
                        $info_motor_no = $row['motor_no'];
                        if($info_motor_no == ''){
                        
                        } else {
                            echo '<option value="'.$info_motor_no.'">'. $info_motor_no .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">ডেলিভারী তারিখঃ</td>

    <td align="center">
        <?php
            $sql = "SELECT DISTINCT delivery_date FROM details WHERE dates='$optionDate' ORDER BY delivery_date ASC";
            $result = $db->select($sql);
            echo '<select style="min-width: 120px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $info_delivery_date = $row['delivery_date'];
                        if($info_delivery_date == '0000-00-00'){
                        
                        } else {
                            $DateArr    = explode('-', $info_delivery_date);
                            $ordered_delivery_date  = $DateArr['2'].'-'.$DateArr['1'].'-'.$DateArr['0'];
                            echo '<option value="'.$ordered_delivery_date.'">'. $ordered_delivery_date .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">তারিখঃ</td>
    <td align="center">
        <?php
            $sql = "SELECT DISTINCT dates FROM details WHERE dates='$optionDate' ORDER BY dates ASC";
            $result = $db->select($sql);
            echo '<select style="min-width: 100px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $info_dates = $row['dates'];
                        if($info_dates == '0000-00-00'){
                        
                        } else {
                            $postDateArr    = explode('-', $info_dates);
                            $ordered_dates  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
                            echo '<option value="'.$ordered_dates.'">'. $ordered_dates .'</option>';
                        }
                    }

                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">মারফোত নামঃ</td>
    <td align="center">
        <?php
            $sql = "SELECT DISTINCT partculars FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 100px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $info_partculars = $row['partculars'];
                        if($info_partculars == ''){
                        
                        } else {
                            echo '<option value="'.$info_partculars.'">'. $info_partculars .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">বিবরণঃ</td>
    <td align="center">
        <?php
            $sql = "SELECT DISTINCT particulars FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 100px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $info_particulars = $row['particulars'];
                        if($info_particulars == ''){
                        
                        } else {
                            echo '<option value="'.$info_particulars.'">'. $info_particulars .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">জমা টাকাঃ</td>
    <td><?php echo $all_debit; ?></td>
  </tr>
  <!-- 11th row -->
  <tr>
    <td colspan="2" align="right">ডিলার আই ডি</td>
    <!-- <td></td> -->
    <td colspan="2" align="center">
        <?php
            $sql = "SELECT dealer_id FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 140px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $dealer_id = $row['dealer_id'];
                        if($dealer_id == ''){
                        
                        } else {
                            echo '<option value="'.$dealer_id.'">'. $dealer_id .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <!-- <td></td> -->
    <td class="ntfc5 noborderk"></td>

    <td class="noborderk"></td>
    <td></td>
    <td class="noborderk"></td>
    <td></td>
    
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>

    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
    <td class="noborderk"></td>
  </tr>
  <!-- 12th row -->
  <tr>
    <td colspan="2" class="noborderk"></td>
    <!-- <td></td> -->
    <td colspan="2" class="noborderk"></td>
    <!-- <td></td> -->
    <td class="ntfc5 noborderk"></td>

    <td align="right">Total Kg:</td>
    <td><?php echo $total_kg_rod500; ?></td>
    <td align="right">Total Kg:</td>
    <td><?php echo $total_kg_rod400; ?></td>
    
    <td align="right">Last Tr. Date:</td>
    <td>
    	<?php
            $sql = "SELECT DISTINCT dates FROM details ORDER BY dates DESC LIMIT 1";
            $result = $db->select($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $last_dates = $row['dates'];
                        if($last_dates == '0000-00-00'){
                            echo 'Not Found';
                        } else {
                            $postDateArr    = explode('-', $last_dates);
                            $new_last_dates  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
                            echo $new_last_dates;
                        }
                    }

                } else{
                    echo 'Not Found';
                }
        ?>
    </td>
    <td class="noborderk"></td>
    <td align="right">মিমিঃ</td>
    <td align="center">
        <?php
            // $sql = "SELECT DISTINCT mm FROM details WHERE mm IS NOT NULL";
            $sql = "SELECT DISTINCT mm FROM details WHERE dates='$optionDate'";
            $result = $db->select($sql);
            echo '<select style="min-width: 140px;">';
                echo '<option value="">Select...</option>';
                if($result->num_rows > 0){

                    while($row = $result->fetch_assoc()){
                        $info_mm = $row['mm'];
                        if($info_mm == ''){
                        
                        } else {
                            echo '<option value="'.$info_mm.'">'. $info_mm .'</option>';
                        }
                    }
                } else{
                    echo '<option value="">Not Found</option>';
                }
            echo '</select>';
        ?>
    </td>
    <td align="right">কেজিঃ</td>

    <td><?php echo $all_kg; ?></td>
    <td align="right">দরঃ</td>
    <td><?php echo $all_paras; ?></td>
    <td align="right">কমিশনঃ</td>
    <td><?php echo $all_discount; ?></td>
    <td align="right">মূলঃ</td>
    <td><?php echo $mul; ?></td>
    <td align="right">বান্ডিলঃ</td>
    <td><?php echo $all_bundil; ?></td>
  </tr>
</table>



<br>



<table id="detailsNewTable2" >
  <tr>
    <th>Customer ID:</th>
    <th>DEALER ID:</th>
    <th>Motor Cash</th>
    <th>Unload</th>
    <th>Cars rent & Redeem</th>
    <th>Information</th>

    <th class="dntSpace"></th>

    
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
  </tr>
  <tr>
    <th>কাষ্টমার আই ডি</th>
    <th>ডিলার আই ডি</th>
    <th>গাড়ী ভাড়া</th>
    <th>আনলোড</th>
    <th>গাড়ী ভাড়া ও খালাস</th>
    <th>মালের বিবরণ</th>

    <th class="dntSpace"></th>

    
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
  </tr>
  <?php
        $sql ="SELECT * FROM details WHERE dates = '$optionDate'";
        $result = $db->select($sql);
        if ($result) {
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
                echo "<td>". $rows['customer_id'] ."</td>";
                echo "<td>". $rows['dealer_id'] ."</td>";
                echo "<td>". $rows['motor_cash'] ."</td>";
                echo "<td>". $rows['unload'] ."</td>";
                echo "<td>". $rows['cars_rent_redeem'] ."</td>";
                echo "<td>". $rows['information'] ."</td>";
                
                echo '<td class="dntSpace"></td>';

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
                echo "</tr>";                            
            }
        } 
  ?>
</table>