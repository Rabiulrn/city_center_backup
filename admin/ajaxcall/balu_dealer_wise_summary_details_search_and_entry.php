<?php
session_start();
require '../config/config.php';
require '../lib/database.php';
$db = new Database();

$dealerId  = $_POST['dealerId'];
$_SESSION['dealerIdInput'] = $_POST['dealerId'];
// echo $dealerId;
$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];



$sucMsg = "";



//Start Gari vara
$sql = "SELECT SUM(motor_vara) as motor_vara FROM details_balu WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $motor_vara = $row['motor_vara'];
    if (is_null($motor_vara)) {
      $motor_vara = 0;
    }
  }
} else {
  $motor_vara = 0;
}
//End Gari vara

//Start khalas/Unload
$sql = "SELECT SUM(unload) as unload FROM details_balu WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $unload = $row['unload'];
    if (is_null($unload)) {
      $unload = 0;
    }
  }
} else {
  $unload = 0;
}
$motor_vara_and_unload = $motor_vara + $unload;
//End khalas/Unload

 // Start total total_motor
 $sql = "SELECT COUNT(motor_vara) as motor FROM details_balu WHERE dealer_id = '$dealerId' AND motor_vara > 0 AND project_name_id = '$project_name_id'";
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


//End GB Bank Ganti
// Start total total_kg
// $sql = "SELECT SUM(total_shift) as shift FROM details_balu WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
// $result = $db->select($sql);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $total_shift = $row['shift'];
//     if (is_null($total_shift)) {
//       $total_shift = 0;
//     }
//   }
// } else {
//   $total_shift = 0;
// }
// $total_ton = $total_shift / 23.5;
// End total total_kg
// Start total total_kg
$sql = "SELECT SUM(tons) as ton_kg FROM details_balu WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_ton_kg = $row['ton_kg'];
    if (is_null($total_ton_kg)) {
      $total_ton_kg = 0;
    }
  }
} else {
  $total_ton_kg = 0;
}
$total_shift = $total_ton_kg * 23.5;
// End total total_kg

// Start total total_credit/mot_mul
$sql = "SELECT SUM(credit) as credit FROM details_balu WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_credit = $row['credit'];
    if (is_null($total_credit)) {
      $total_credit = 0;
    }
  }
} else {
  $total_credit = 0;
}
$total_credit = number_format($total_credit, 2);
// End total total_credit/mot_mul

// Start total total_debit/joma
$sql = "SELECT SUM(debit) as debit FROM details_balu WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_debit = $row['debit'];
    if (is_null($total_debit)) {
      $total_debit = 0;
    }
  }
} else {
  $total_debit = 0;
}
$total_balance = $total_debit-$total_credit -$motor_vara_and_unload ;
// End total total_debit/joma

// // Start total total_Balance/mot_jer
// $sql = "SELECT SUM(balance) as balance FROM details_balu WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
// $result = $db->select($sql);
// if ($result->num_rows > 0) {
//   while ($row = $result->fetch_assoc()) {
//     $total_balance = $row['balance'];
    
//     if (is_null($total_balance)) {
//       $total_balance = 0;
//     }
//   }
// } else {
//   $total_balance = 0;
// }
// End total total_Balance/mot_jer

//Start Total para/mot_mul_khoros_shoho

$vara_credit = $motor_vara_and_unload + $total_credit;



//End Total para/mot_mul_khoros_shoho


?>






<div id="flip">
  <!-- <label class="conchk" id="flipChkbox">Show/Hide Summary
      <input type="checkbox">
      <span class="checkmark"></span>
    </label> -->


  <div class="contorlAfterDealer">
    <div class="dateSearch">
      <!-- <b>Search Date:</b>                   
              <select class="selectpicker" data-style="btn-info" id="dateSearchList">
                  <option value="alldates">All dates</option>
                  <?php
                  $sql = "SELECT DISTINCT dates FROM details WHERE dealer_id='$dealerId' AND project_name_id = '$project_name_id' ORDER BY dates ASC";
                  $result = $db->select($sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $dates = $row['dates'];
                      $newDate = date("d-m-Y", strtotime($dates));
                      // echo $newDate;
                      if ($dates == '0000-00-00') {
                      } else {
                        echo '<option value="' . $newDate . '">' . $newDate . '</option>';
                      }
                    }
                  } else {
                    echo '<option value="">Not Found</option>';
                  }
                  ?>
              </select> -->
    </div>
    <button onclick="myFunction()" class="btn printBtnDlr">Print</button>
    <!-- <button onclick="myFunction2()" class="btn printBtnDlrDown">Download</button> -->
  </div>
</div>
<div id="panel">
<table width="100%" class="summary">
    <tr>
      <!-- <td class="hastext" width="150px">04.50mm 500W/60G</td>
			<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td>
			<td class="hastext" width="150px">04.50mm 400W/60G</td>
			<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td> -->
      <td class="hastext">মোট সিএফটি </td>
      <td style="min-width: 85px"><?php
       $format_number2 = number_format($total_shift, 2);
      echo $format_number2; ?></td>
      <!-- <td class="hastext">জ‌িব‌ি ব্যাংক গ্যান্ট‌িঃ</td>
			<td style="min-width: 85px"><?php echo $gb_bank_ganti; ?></td> -->

    </tr>
    <tr>
      <!-- <td class="hastext">06mm 500W/60G</td>
			<td><?php echo $mm06_rod500; ?></td>
			<td class="hastext">06mm 400W/60G</td>
			<td><?php echo $mm06_rod400; ?></td> -->
      <td class="hastext">মোট টন</td>
      <td><?php
          $format_number1 = number_format($total_ton_kg, 2);
          echo $format_number1; ?></td>
      <!-- <td class="hastext">কোম্পানী পাওনাঃ</td>
			<td><?php echo $company_paona; ?></td>			 -->
    </tr>
    <tr>
      <!-- <td class="hastext">08mm 500W/60G</td>
			<td><?php echo $mm08_rod500; ?></td>
			<td class="hastext">08mm 400W/60G</td>
			<td><?php echo $mm08_rod400; ?></td> -->
      <!-- <td class="hastext">মোট গাড়ীঃ</td>
            <td><?php echo $total_motor; ?></td>
			<td class="hastext">নিজ পাওনাঃ</td>
			<td><?php echo $nij_paona; ?></td>											 -->
    </tr>
    <tr>
      <!-- <td class="hastext">10mm 500W/60G</td>
			<td><?php echo $mm10_rod500; ?></td>
			<td class="hastext">10mm 400W/60G</td>
			<td><?php echo $mm10_rod400; ?></td> -->
      <!-- <td></td>
      <td></td>
      <td></td>
      <td></td> -->
    </tr>
    <tr>
      <!-- <td class="hastext">12mm 500W/60G</td>
			<td><?php echo $mm12_rod500; ?></td>
			<td class="hastext">12mm 400W/60G</td>
			<td><?php echo $mm12_rod400; ?></td> -->
      <td style="background-color: #bcbcbc;"></td>
      <td style="background-color: #bcbcbc;"></td>
      <td style="background-color: #bcbcbc;"></td>
      <td style="background-color: #bcbcbc;"></td>
    </tr>
    <!-- Ekhan theke -->
    <tr>
      <td class="hastext">মোট গাড়ীঃ</td>
      <td><?php echo $total_motor; ?></td>
      <td class="hastext">ম‌োট মূলঃ</td>
      <td><?php echo $total_credit; ?></td>
    </tr>
    <tr>
      <!-- <td class="hastext">16mm 500W/60G</td>
			<td><?php echo $mm16_rod500; ?></td>
			<td class="hastext">16mm 400W/60G</td>
			<td><?php echo $mm16_rod400; ?></td> -->
      <td class="hastext">মোট গাড়ী ভাড়াঃ</td>
      <td><?php echo $motor_vara; ?></td>
      <td class="hastext">ম‌োট মূল খরচ সহঃ</td>
      <td><?php echo $vara_credit; ?></td>
    
    </tr>
    <tr>
      <!-- <td class="hastext">20mm 500W/60G</td>
			<td><?php echo $mm20_rod500; ?></td>
			<td class="hastext">20mm 400W/60G</td>
			<td><?php echo $mm20_rod400; ?></td> -->
      <td class="hastext">মোট খালাস খরচঃ</td>
      <td><?php echo $unload; ?></td>
      <td class="hastext">ম‌োট জমাঃ</td>
      <td><?php echo $total_debit; ?></td>
      
      
    </tr>
    <tr>
      <!-- <td class="hastext">22mm 500W/60G</td>
            <td><?php echo $mm22_rod500; ?></td>
            <td class="hastext">22mm 400W/60G</td>
            <td><?php echo $mm22_rod400; ?></td> -->
      <td class="hastext">গাড়ী ভাড়া ও খালাস খরচঃ</td>
      <td><?php echo $motor_vara_and_unload; ?></td>
      <td class="hastext">ম‌োট পাওনা ও জেরঃ</td>
      <td><?php echo $total_balance; ?></td>
      
    

    </tr>
    <tr>
      <!-- <td class="hastext">25mm 500W/60G</td>
			<td><?php echo $mm25_rod500; ?></td>
			<td class="hastext">25mm 400W/60G</td>
			<td><?php echo $mm25_rod400; ?></td> -->
      <!-- <td></td>
      <td></td> -->
    
      
    
    </tr>
    <tr>
      <!-- <td class="hastext">32mm 500W/60G</td>
			<td><?php echo $mm32_rod500; ?></td>
			<td class="hastext">32mm 400W/60G</td>
			<td><?php echo $mm32_rod400; ?></td> -->
      <!-- <td></td>
      <td></td>
      <td></td>
      <td></td> -->
    </tr>
    <tr>
      <!-- <td class="hastext">42mm 500W/60G</td>
			<td><?php echo $mm42_rod500; ?></td>
			<td class="hastext">42mm 400W/60G</td>
			<td><?php echo $mm42_rod400; ?></td> -->
      <!-- <td></td>
      <td></td>
      <td></td>
      <td></td> -->
    </tr>
    <tr>
      <!-- <td class="hastext"><b>Total Kg:</b></td>
			<td><b><?php echo $total_kg_rod500; ?></b></td>
			<td class="hastext"><b>Total Kg:</b></td>
			<td><b><?php echo $total_kg_rod400; ?></b></td> -->
      <!-- <td></td>
      <td></td>
      <td></td>
      <td></td> -->
    </tr>
  </table>
</div>

<div class="rodDetailsEnCon" style="display: block;">
  <form id="form_entry">
    <!-- <h2 class="ce_header bg-primary">Details Entry</h2> -->
    <div class="scrolling-div" id="scrolling-entry-div">
      <!-- <div id="popUpNewBtn">
        <img src="../img/others/new_entry.png" width="100%" height="100%">
      </div> -->
      <!-- <div class="scrollsign_plus" id="entry_scroll3">+</div> 
                <div class="scrollsign_plus" id="entry_scroll2">+</div>                  
                <div class="scrollsign_plus" id="entry_scroll1">+</div>                   -->
      <table border="1" id="detailsEtryTable">
        <tr>
          <td class="widthPercent1">Dealer ID</td>
          <!-- <td width="150">Dealer ID</td> -->
          <!-- <td class="widthPercent1">Type</td> -->

          <!-- <td class="widthPercent1">Information</td> -->
          <td class="widthPercent1">Motor Name</td>
          <td class="widthPercent1">Driver Name</td>
          <td class="widthPercent1">Motor Vara</td>
          <td class="widthPercent1">Unload</td>
          <td class="widthPercent1">Cars rent & Redeem</td>
          <td class="widthPercent1">Information</td>

          <td class="widthPercent1">SL</td>
          <!-- <td class="widthPercent2">Particulars</td> -->
          <td class="widthPercent1">Voucher No.</td>
          <td class="widthPercent1">Address</td>
          <td class="widthPercent1">Motor Number</td>
          <td class="widthPercent1">Motor SL</td>
          <td class="widthPercent1">Delivery Date</td>
          <td class="widthPercent2">Date</td>
          <td class="widthPercent2">Partculars</td>
          <td class="widthPercent2">Particulars</td>
          <td class="widthPercent2">Debit</td>
          <td class="widthPercent3">Ton & Kg</td>
          <td class="widthPercent3">Length</td>
          <td class="widthPercent3">width</td>
          <td class="widthPercent3">Height</td>
          <td class="widthPercent3">Cft</td>
          <td class="widthPercent3"> Inchi (-) Minus</td>
          <td class="widthPercent3">Cft ( - ) Dropped Out</td>
          <td class="widthPercent3">Inchi (+) Added</td>
          <td class="widthPercent3">Points ( - ) Dropped Out</td>
          <td class="widthPercent3">Cft</td>
          <td class="widthPercent3">Para's</td>
          <td class="widthPercent3">Total Cft</td>
          <td style="display:none;" class="widthPercent3">Ton</td>
         
          <td class="widthPercent3">Discount</td>
          <td class="widthPercent3">Credit</td>
          <td style="display:none;" class="widthPercent3" >Balance</td>
          <td style="display:none;" class="widthPercent3">Cemeat's Para's</td>
          <td style="display:none;" class="widthPercent3">Ton</td>
          <td style="display:none;" class="widthPercent3">Total Cft</td>
          <td style="display:none;" class="widthPercent3">Tons</td>
          <td class="widthPercent3">Bank Name</td>
          <td class="widthPercent3">Fee</td>
        </tr>
        <tr>
          <td>ডিলার আইডি</td>
          <!-- <td>ডিলার আই ডি</td> -->
          <!-- <td>টাইপ</td> -->

          <!-- <td>মালের বিবরণ</td> -->
          <td>গাড়ী নাম</td>
          <td>ড্রাইভারের নাম</td>
          <td>গাড়ী ভাড়া</td>
          <td>আনলোড</td>
          <td>গাড়ী ভাড়া ও খালাস</td>
          <td>মালের বিবরণ</td>

          <td>ক্রমিক</td>
          <!-- <td>ব‌িবরণ</td> -->
          <td>ভাউচার নং</td>
          <td>ঠিকানা</td>
          <td>গাড়ী নাম্বার</td>
          <td>গাড়ী নং</td>
          <td>ডেলিভারী তারিখ</td>
          <td>তারিখ</td>
          <td>মারফ‌োত নাম</td>
          <td>ব‌িবরণ</td>
          <td>জমা টাকা</td>
          <td>টন ও কেজি</td>
          <td>দৈর্ঘ্য</td>
          <td>প্রস্থ</td>
          <td>উচ্চতা</td>
          <td>সিএফটি</td>
          <td>Inchi (-) বিয়োগ </td>
          <td>সিএফটি ( - ) বাদ</td>
          <td>Inchi (+) যোগ </td>
          <td>পয়েন্ট ( - ) বাদ</td>
          <td>সিএফটি</td>
          <td>দর</td>
          <td>মোট সিএফটি</td>
          <td style="display:none;">টন</td>
         
          <td>কমিশন</td>
          <td>মূল</td>
          <td style="display:none;">অবশিষ্ট</td>
          <td style="display:none;">গাড়ী ভাড়া / লেবার সহ</td>
          <td style="display:none;">টন</td>
          <td style="display:none;">মোট সিএফটি</td>
          <td style="display:none;">টন</td>
          <td>ব্যাংক নাম</td>
          <td>ফি</td>

        </tr>
        <tr style="position: relative;">
          <td>
            <!-- <input type="text" name="customer_id" class="form-control-balu" id="customer_id" placeholder="Enter customer_id..."> -->
            <?php
            $sql = "SELECT * FROM balu_dealer WHERE project_name_id ='$project_name_id'";
            $all_custmr_id = $db->select($sql);
            echo '<select name="dealer_id" id="dealer_id" class="form-control" style="width: 140px; required">';
            echo '<option value="none">Select...</option>';
            if ($all_custmr_id->num_rows > 0) {
              while ($row = $all_custmr_id->fetch_assoc()) {
                $id = $row['dealer_id'];
                $dealer_name = $row['dealer_name'];

                echo '<option value="' . $id . '">'.$id.'--'.$dealer_name.'</option>';
              }
            } else {
              echo '<option value="none">0 Result</option>';
            }
            echo '</select>';
            ?>

          </td>
          <!-- <td>
            <select id="type" name="type" class="form-control-balu" style="width: 160px;">
              <option value="balu">balu</option>
              <option value="pathor">pathor</option>
            </select>
             <input id="button1" type="button" value="Click!" /> 
          </td> -->






          <!-- <td>
            <input type="text" name="information" class="form-control-balu" id="information" placeholder="Enter information...">
          </td> -->

          <!-- <td> -->
          <!-- <input type="text" name="delear_id" class="form-control-balu" id="delear_id" placeholder="Enter delear_id..."> -->
          <?php
          // $sql = "SELECT dealer_id FROM dealers";
          // $all_custmr_id = $db->select($sql);
          // echo '<select name="delear_id" id="delear_id" class="form-control-balu" style="width: 140px;">';
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
            <input type="text" name="motor_name" class="form-control-balu" id="motor_name" placeholder="Motor name...">
          </td>
          <td>
            <input type="text" name="driver_name" class="form-control-balu" id="driver_name" placeholder="Driver name...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="motor_vara" class="form-control-balu value-calc" id="motor_vara"  placeholder="Gari vara...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="unload" class="form-control-balu value-calc" id="unload"  placeholder="Unload...">
          </td>
          <td>
            <input type="text" name="car_rent_redeem" class="form-control-balu value-calc" id="car_rent_redeem" placeholder="Enter cars rent & redeem...">
          </td>
          <td>
            <input type="text" name="information" class="form-control-balu" id="information" placeholder="Enter information...">
          </td>

          <?PHP
          $sql = "SELECT sl FROM details_balu ORDER BY id DESC LIMIT 1";
          $customersId = $db->select($sql);
          if ($customersId->num_rows > 0) {
            $row = $customersId->fetch_assoc();
            $largestId = $row['sl'];
          } else {
            $largestId = 'sl-100000';
          }
          $matches = preg_replace('/\D/', '', $largestId);
          $newNumber = $matches + 1;
          $newId = 'SL-' . $newNumber;
          ?>


          <td>
            <input type="text" name="sl_no" class="form-control-balu" id="sl_no" value="<?php echo $newId ?>" placeholder="Enter sl no..." style="cursor:not-allowed;">
          </td>

          <td>
            <input type="text" name="delivery_no" class="form-control-balu" id="delivery_no" placeholder="Enter voucher no..." required>
          </td>
          <td>
            <input type="text" name="address" class="form-control-balu" id="address" placeholder="Address..." pattern="[a-zA-Z0-9-\s]+" required>
          </td>
          <td>
            <input type="text" name="motor" class="form-control-balu" id="motor" placeholder="Motor...">
          </td>
          <td>
            <input type="text" name="motor_no" class="form-control-balu" id="motor_no" placeholder="Motor sl...">
          </td>
          <td style="z-index:2;">
            <input onkeypress="datecheckformat(event)" type="text" name="delivery_date" class="form-control-balu" id="delivery_date" placeholder="dd-mm-yyyy">
          </td>
          <td>
            <input onkeypress="datecheckformat(event)" type="text" name="dates" class="form-control-balu" id="dates" placeholder="dd-mm-yyyy">
          </td>
          <td>
            <input type="text" name="partculars" class="form-control-balu" id="partculars" placeholder="Marfot...">
          </td>
          <td>
            <?php
            // var parti_val = $('#car_rent_redeem').val();
            $sql = "SELECT DISTINCT category_name FROM balu_category WHERE  category_name != ''";
            $all_particular = $db->select($sql);
            echo '<select name="particulars" id="particulars" class="form-control" style="width: 140px;" required>';
            echo '<option value="none">Select...</option>';
            if ($all_particular->num_rows > 0) {
              while ($row = $all_particular->fetch_assoc()) {
                $particulars = $row['category_name'];
                echo '<option value="' . $particulars . '">' . $particulars . '</option>';
              }
            } else {
              echo '<option value="none">0 Result</option>';
            }
            echo '</select>';
            ?>

          </td>

          <td>
            <input type="text" onkeypress="return isNumber(event)" name="debit" class="form-control-balu value-calc" id="debit" placeholder="Debit...">
          </td>
          <td id="td_kg">
            <input type="text" onkeypress="return isNumber(event)" name="kg" class="form-control-balu value-calc" id="kg" placeholder="Ton & kg...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="length" class="form-control-balu value-calc" id="length" placeholder="Length'00 mm'...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="width" class="form-control-balu value-calc" id="width" placeholder="Width'00 mm'...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="height" class="form-control-balu value-calc" id="height" placeholder="Height '00 mm'...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="shifty" class="form-control-balu value-calc" id="shifty" placeholder="Cft '00 mm'...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="inchi(-)_minus" class="form-control-balu value-calc" id="inchi_minus" placeholder="-Inchi'00 mm'...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="cft(-)_dropped_out" class="form-control-balu value-calc" id="cft_dropped_out" placeholder="-Cft'00 mm'...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="inchi(+)_added" class="form-control-balu value-calc" id="inchi_added" placeholder="+Inchi '00 mm'...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="points(-)_dropped_out" class="form-control-balu value-calc" id="points_dropped_out" placeholder="-Point '00 mm'...">
          </td>
          <td>
            <input type="text" name="shift" class="form-control-balu value-calc" id="shift" placeholder="Cft '00 mm'...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="paras" class="form-control-balu value-calc" id="paras" placeholder="Paras per ton...">
          </td>
          <td>
            <input type="text" name="total_shift" class="form-control-balu value-calc" id="total_shift" placeholder="Total-cft '00 mm'...">
          </td>
          <td style="display:none;">
            <input type="text" onkeypress="return isNumber(event)" name="ton" class="form-control-balu value-calc" id="ton" placeholder="Ton...">
          </td>
         
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="discount" class="form-control-balu value-calc" id="discount" placeholder="Discount...">
          </td>
          <td>
            <input type="text" name="credit" class="form-control-balu value-calc" id="credit" placeholder="Credit...">
          </td>

          <td style="display:none;">
            <input type="text" name="balance" class="form-control-balu value-calc" id="balance" placeholder="Balance...">
          </td>
          <td style="display:none;">
            <input type="text" onkeypress="return isNumber(event)" name="cemeats_paras" class="form-control-balu value-calc" id="cemeats_paras" placeholder="Cemeats_paras...">
          </td>


          <td style="display:none;">
            <input type="text" name="total_shifts" class="form-control-balu value-calc" id="total_shifts" placeholder="Total-cft '00 mm'...">
          </td>
          <td style="display:none;">
            <input type="text" onkeypress="return isNumber(event)" name="tons" name="tons" class="form-control-balu value-calc" id="tons" placeholder="Tons...">
          </td>
          <td>
            <input type="text" name="bank" class="form-control-balu" id="bank" placeholder="Bank name...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="fee" class="form-control-balu value-calc" id="fee" placeholder="Fee...">
          </td>
          <!-- <input type="hidden" name="balu_details_id" id="balu_details_id"> -->
          <!-- <td colspan="2"></td> -->
        </tr>
      </table>
      <h4 class="text-success text-center" id="NewEntrySucMsg"></h4>
    </div>
    <input onclick="valid('insert')" type="button" name="submit" class="btn btn-primary scroll-after-btn" value="Save">

  </form>
</div>

<div class="rodDetailsEdit" style="display: none; position: relative;">
</div>

<br><br>


<?php
$sql = "SELECT * FROM details_balu WHERE dealer_id='$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result) {
  $rowcount = mysqli_num_rows($result);
  if ($rowcount != 0) {
?>
    <div id="viewDetailsSearchAfterNewEntry" style="margin-top:25px;">
      <div class="viewDetailsCon" id="viewDetails">
        <table id="detailsNewTable2">

          <thead class="header">
            <tr>
              <th>Dealer ID</th>
              <th>Motor Name</th>
              <th>Driver Name</th>
              <th>Motor Vara</th>
              <th>Unload</th>
              <th>Cars&nbsp;rent&nbsp;& Redeem</th>
              <th>Information</th>
              <th>SL</th>
              <th>Voucher No.</th>
              <th>Address</th>
              <th>Motor Number</th>
              <th>Motor SL</th>
              <th>Delivery Date</th>
              <th>Date</th>
              <th>Partculars</th>
              <th>Particulars</th>
              <th>Debit</th>
              <th>Ton&nbsp;& Kg</th>
              <th>Length</th>
              <th>width</th>
              <th>Height</th>
              <th>Cft</th>
              <th>Inchi&nbsp;(-) Minus</th>
              <th>Cft ( - ) Dropped&nbsp;Out</th>
              <th>Inchi&nbsp;(+) Added</th>
              <th>Points ( - ) Dropped&nbsp;Out</th>
              <th>Cft</th>
              <th>Total Cft </th>
              <th>Para's</th>
              <th>Discount</th>
              <th>Credit</th>
              <th>Balance</th>
              <th>Cemeat's Para's</th>
              <!-- <th>Ton</th> -->
              <th>Total Cft </th>
              <th>Tons</th>
              <th>Bank Name</th>
              <th>Fee</th>
           
              <th class='no_print_media'></th>
              <th class='no_print_media'></th>
            </tr>
            <tr>
              <th>ডিলার আইডি</th>
              <th>গাড়ী নাম</th>
              <th>ড্রাইভারের নাম</th>
              <th>গাড়ী ভাড়া</th>
              <th>আনলোড</th>
              <th>গাড়ী&nbsp;ভাড়া ও খালাস</th>
              <th>মালের বিবরণ</th>
              <th>ক্রমিক</th>
              <th>ভাউচার নং</th>
              <th>ঠিকানা</th>
              <th>গাড়ী নাম্বার</th>
              <th>গাড়ী নং</th>
              <th>ডেলিভারী তারিখ</th>
              <th>তারিখ</th>
              <th>মারফ‌োত নাম</th>
              <th>ব‌িবরণ</th>
              <th>জমা টাকা</th>
              <th>টন&nbsp;ও কেজি</th>
              <th>দৈর্ঘ্য</th>
              <th>প্রস্থ</th>
              <th>উচ্চতা</th>
              <th>সিএফটি</th>
              <th>Inchi&nbsp;(-) বিয়োগ </th>
              <th>সিএফটি ( - ) বাদ</th>
              <th>Inchi (+) যোগ </th>
              <th>পয়েন্ট ( - ) বাদ</th>
              <th>সিএফটি</th>
              <th>মোট সিএফটি</th>
              <th>দর</th>
              <th>কমিশন</th>
              <th>মূল</th>
              <th>অবশিষ্ট</th>
              <th>গাড়ী&nbsp;ভাড়া&nbsp;লেবার সহ</th>
              <!-- <th>টোন</th> -->
              <th>মোট সিএফটি</th>
              <th>টন</th>
              <th>ব্যাংক নাম</th>
              <th>ফি</th>
              
              <th class='no_print_media'></th>
              <th class='no_print_media'></th>
            </tr>
          </thead>
          <tbody>
            <?php
            while ($rows = $result->fetch_assoc()) {
              if ($rows['delivery_date'] == '0000-00-00') {
                $format_delivery_date = '';
              } else {
                $delivery_date = $rows['delivery_date'];
                $format_delivery_date = date("d-m-Y", strtotime($delivery_date));
              }
              if ($rows['dates'] == '0000-00-00') {
                $format_dates = '';
              } else {
                $dates = $rows['dates'];
                $format_dates = date("d-m-Y", strtotime($dates));
              }
              echo "<tr>";
              echo "<td>" . $rows['dealer_id'] . "</td>";
              echo "<td>" . $rows['motor_name'] . "</td>";
              echo "<td>" . $rows['driver_name'] . "</td>";
              echo "<td>" . $rows['motor_vara'] . "</td>";
              echo "<td>" . $rows['unload'] . "</td>";
              echo "<td>" . $rows['cars_rent_redeem'] . "</td>";
              echo "<td>" . $rows['information'] . "</td>";
              echo "<td>" . $rows['sl'] . "</td>";
              echo "<td>" . $rows['voucher_no'] . "</td>";
              echo "<td>" . $rows['address'] . "</td>";
              echo "<td>" . $rows['motor_no'] . "</td>";
              echo "<td>" . $rows['motor_sl'] . "</td>";
              echo "<td>" . $format_delivery_date . "</td>";
              echo "<td>" . $format_dates . "</td>";
              echo "<td>" . $rows['partculars'] . "</td>";
              echo "<td>" . $rows['particulars'] . "</td>";
              echo "<td>" . $rows['debit'] . "</td>";
              echo "<td>" . $rows['ton & kg'] . "</td>";
              echo "<td>" . $rows['length'] . "</td>";
              echo "<td>" . $rows['width'] . "</td>";
              echo "<td>" . $rows['height'] . "</td>";
              echo "<td>" . $rows['shifty'] . "</td>";
              echo "<td>" . $rows['inchi (-)_minus'] . "</td>";
              echo "<td>" . $rows['cft (-)_dropped out'] . "</td>";
              echo "<td>" . $rows['inchi (+)_added'] . "</td>";
              echo "<td>" . $rows['points ( - )_dropped out'] . "</td>";
              echo "<td>" . $rows['shift'] . "</td>";
              echo "<td>" . $rows['total_shift'] . "</td>";
              echo "<td>" . $rows['paras'] . "</td>";
              echo "<td>" . $rows['discount'] . "</td>";
              echo "<td>" . $rows['credit'] . "</td>";
              echo "<td>" . $rows['balance'] . "</td>";
              echo "<td>" . $rows['cemeats_paras'] . "</td>";
              // echo "<td>" . $rows['ton'] . "</td>";
              echo "<td>" . $rows['total_shifts'] . "</td>";
              echo "<td>" . $rows['tons'] . "</td>";
              echo "<td>" . $rows['bank_name'] . "</td>";
              echo "<td>" . $rows['fee'] . "</td>";
              // echo "<td>" . $rows[''] . "</td>";

              if ($delete_data_permission == 'yes') {
                echo "<td width='78px' class='no_print_media'><a class='btn btn-danger detailsDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
              } else {
                echo '<td width="78px" class="no_print_media"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
              }

              if ($edit_data_permission == 'yes') {
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
  } else {
    echo '<div style="width: 100%; height: 100px;"></div>';
  }
}
?>