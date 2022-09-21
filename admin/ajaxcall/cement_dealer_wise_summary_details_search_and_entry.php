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

$total_weight = 0;
$sql = "SELECT SUM(weight) as weight FROM details_cement WHERE particulars LIKE '%Cement (Cem3)-Gold%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $total_weight = $row['weight'];
        if(is_null($total_weight)){
            $total_weight = 0;
        }
    }
} else{
    $total_weight = 0;
}

$total_weight1 = 0;
$sql = "SELECT SUM(weight) as weight FROM details_cement WHERE particulars LIKE '%Cement (OPC)-1%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $total_weight1 = $row['weight'];
        if(is_null($total_weight1)){
            $total_weight1 = 0;
        }
    }
} else{
    $total_weight1 = 0;
}

$total_weight2 = 0;
$sql = "SELECT SUM(weight) as weight FROM details_cement WHERE particulars LIKE '%Cement Poly (PCC)-1%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $total_weight2 = $row['weight'];
        if(is_null($total_weight2)){
            $total_weight2 = 0;
        }
    }
} else{
    $total_weight2 = 0;
}

$total_weight3 = 0;
$sql = "SELECT SUM(weight) as weight FROM details_cement WHERE particulars LIKE '%Cement Poly (PCC)-2%' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $total_weight3 = $row['weight'];
        if(is_null($total_weight3)){
            $total_weight3 = 0;
        }
    }
} else{
    $total_weight3 = 0;
}

$total1_weight = 0;
$sql = "SELECT SUM(weight) as weight FROM details_cement WHERE particulars AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $total1_weight = $row['weight'];
        if(is_null($total1_weight)){
            $total1_weight = 0;
        }
    }
} else{
    $total1_weight = 0;
}

  
// Start total total_motor
$sql = "SELECT COUNT(motor_vara) as motor FROM details_cement WHERE dealer_id = '$dealerId'AND motor_vara > 0 AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_motor = $row['motor'];
    if (is_null($total_motor)) {
      $total_motor = 0;
    }
  }
} else {
  $total_motor = 0;
}

//Start Gari vara
$sql = "SELECT SUM(motor_vara) as motor_vara FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
$sql = "SELECT SUM(unload) as unload FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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

// // Start total total_motor

// // End total total_motor

// //Start GB Bank Ganti


// //End GB Bank Ganti
// Start total total_kg
$sql = "SELECT SUM(weight) as shift FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
$result = $db->select($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_shift = $row['shift'];
    if (is_null($total_shift)) {
      $total_shift = 0;
    }
  }
} else {
  $total_shift = 0;
}
// $total_ton = $total_shift / 23.5;
// // End total total_kg

// Start total total_credit/mot_mul
$sql = "SELECT SUM(credit) as credit FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
// End total total_credit/mot_mul

// Start total total_debit/joma
$sql = "SELECT SUM(debit) as debit FROM details_cement WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
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
// End total total_debit/joma
$total_balance = $total_debit - $total_credit - $motor_vara_and_unload;
// // Start total total_Balance/mot_jer
//     $sql = "SELECT SUM(balance) as balance FROM details_sell_pathor WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
//     $result = $db->select($sql);
//     if($result->num_rows > 0){
//         while($row = $result->fetch_assoc()){
//             $total_balance = $row['balance'];
//             if(is_null($total_balance)){
//                 $total_balance = 0;
//             }
//         }
//     } else{
//         $total_balance = 0;
//     }
// // End total total_Balance/mot_jer

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

    <button onclick="myFunction()" class="btn printBtnDlr">Print</button>
    <!-- <button onclick="myFunction()" class="btn printBtnDlrDown">Download</button> -->
  </div>
</div>

<div id="panel">
  <table width="100%" class="summary">
    <tr>
      <!-- <td class="hastext" width="150px">04.50mm 500W/60G</td>
			<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td>
			<td class="hastext" width="150px">04.50mm 400W/60G</td>
			<td style="min-width: 85px"><?php echo $mm0450_rod500; ?></td> -->
      <!-- <td class="hastext">মোট সেপ্টি </td>
      <td style="min-width: 85px"><?php echo $total_shift; ?></td> -->
      <!-- <td class="hastext">জ‌িব‌ি ব্যাংক গ্যান্ট‌িঃ</td>
			<td style="min-width: 85px"><?php echo $gb_bank_ganti; ?></td> -->

    </tr>
    <tr>
      <td class="hastext">Cement (Cem3)-Gold</td>
			<td><?php echo $total_weight; ?></td>
			<!-- <td class="hastext">06mm 400W/60G</td>
			<td><?php echo $mm06_rod400; ?></td> -->
      <td class="hastext">ওজন (এম,টি )</td>
      <td><?php echo $total_shift; ?></td>
      <td class="hastext"></td>
			<td><?php echo $company_paona; ?></td>
    </tr>
    <tr>
      <td class="hastext">Cement (OPC)-1</td>
			<td><?php echo $total_weight1; ?></td>
			<!-- <td class="hastext">08mm 400W/60G</td>
			<td><?php echo $mm08_rod400; ?></td> -->
       <td class="hastext">মোট গাড়ীঃ</td>
            <td><?php echo $total_motor; ?></td>
          
			<td class="hastext"></td>
			<td><?php echo $nij_paona; ?></td>											
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
      <!-- <td style="background-color: #bcbcbc;"></td>
      <td style="background-color: #bcbcbc;"></td>
      <td style="background-color: #bcbcbc;"></td>
      <td style="background-color: #bcbcbc;"></td> -->
    </tr>
    <!-- Ekhan theke -->
    <tr>
      <td class="hastext">Cement Poly (PCC)-1</td>
			<td><?php echo $total_weight2; ?></td>
			<!-- <td class="hastext">16mm 400W/60G</td>
			<td><?php echo $mm16_rod400; ?></td> -->
      <td class="hastext">মোট গাড়ী ভাড়াঃ</td>
      <td><?php echo $motor_vara; ?></td>
      <td class="hastext">ম‌োট মূলঃ</td>
      <td><?php echo $total_credit; ?></td>
    </tr>
    <tr>
      <td class="hastext">Cement Poly (PCC)-2</td>
			<td><?php echo $total_weight3; ?></td>
			<!-- <td class="hastext">20mm 400W/60G</td>
			<td><?php echo $mm20_rod400; ?></td> -->
      <td class="hastext">মোট খালাস খরচঃ</td>
      <td><?php echo $unload; ?></td>
      <td class="hastext">ম‌োট জমাঃ</td>
      <td><?php echo $total_debit; ?></td>
    </tr>
    <tr>
    <td class="hastext"></td>
            <td><?php echo $mm22_rod500; ?></td>
            <!-- <td class="hastext">22mm 400W/60G</td>
            <td><?php echo $mm22_rod400; ?></td> -->
      <td class="hastext">গাড়ী ভাড়া ও খালাস খরচঃ</td>
      <td><?php echo $motor_vara_and_unload; ?></td>
      <td class="hastext">ম‌োট পাওনা ও জেরঃ</td>
      <td><?php echo $total_balance; ?></td>

    </tr>
    <tr>
      <td class="hastext"></td>
			<td><?php echo $mm25_rod500; ?></td>
			<!-- <td class="hastext">25mm 400W/60G</td>
			<td><?php echo $mm25_rod400; ?></td> -->
      <td class="hastext">ম‌োট মূল খরচ সহঃ</td>
      <td><?php echo $vara_credit; ?></td>
      <td></td>
      <td></td>
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
       <td class="hastext"><b>Total Weight (MT):</b></td>
			<td><b><?php echo $total_shift; ?></b></td> 
			<!-- <td class="hastext"><b>Total Kg:</b></td>
			<td><b><?php echo $total_kg_rod400; ?></b></td> -->
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
          <td class="widthPercent1">Driver Name</td>
          <td class="widthPercent1">Motor Name</td>
          <td class="widthPercent1">Motor Vara</td>
          <td class="widthPercent1">Unload</td>
          <td class="widthPercent1">Cars rent & Redeem</td>
          <td class="widthPercent1">Information</td>

          <td class="widthPercent1">SL</td>
          <!-- <td class="widthPercent2">Particulars</td> -->
          <td class="widthPercent1">Address</td>
          <td class="widthPercent1">Challan No.</td>
          <td class="widthPercent1">Motor SL</td>
          <td class="widthPercent1">Motor Number</td>

          <td class="widthPercent1">Challan Date</td>
          <td class="widthPercent2">SO Date</td>
          <td class="widthPercent2">Date</td>
          <td class="widthPercent2">Partculars</td>
          <td class="widthPercent2">Particulars</td>
          <td class="widthPercent2">Debit</td>
          <td class="widthPercent3">Count</td>
          <td class="widthPercent3">Fee</td>
          <td class="widthPercent3">Para's</td>
          <td class="widthPercent3">Discount</td>
          <td class="widthPercent3">Credit</td>
          <td class="widthPercent3" style="display: none;">Balance</td>
          <td class="widthPercent3" style="display: none;">Total Credit</td>
          <td class="widthPercent3">Weight ( MT )</td>
        </tr>
        <tr>
          <td>ডিলার আই ডি</td>
          <!-- <td>ডিলার আই ডি</td> -->
          <!-- <td>টাইপ</td> -->

          <!-- <td>মালের বিবরণ</td> -->
          <td>ড্রাইভারের নাম</td>
          <td>গাড়ী নাম</td>

          <td>গাড়ী ভাড়া</td>
          <td>আনলোড</td>
          <td>গাড়ী ভাড়া ও খালাস</td>
          <td>মালের বিবরণ</td>

          <td>ক্রমিক নং</td>
          <td>ঠিকানা</td>
          <td>ভাউচার নং</td>

          <td>গাড়ী নাম্বার</td>
          <td>গাড়ী নং</td>
          <td>ভাউচার তারিখ</td>
          <td>অর্ডার তারিখ</td>
          <td>তারিখ</td>
          <td>মারফ‌োত নাম</td>
          <td>ব‌িবরণ</td>
          <td>জমা টাকা</td>
          <td>পরিমান‌</td>
          <td>ফি</td>
          <td>দর</td>
          <td>কমিশন</td>
          <td>মূল</td>
          <td style="display: none;">অবশিষ্ট</td>
          <td style="display: none;">মোট মূলঃ</td>
          <td>ওজন (এম,টি )</td>


        </tr>
        <tr>
          <td>
            <!-- <input type="text" name="customer_id" class="form-control-balu" id="customer_id" placeholder="Enter customer_id..."> -->
            <?php
            $sql = "SELECT dealer_id FROM cement_dealer WHERE project_name_id ='$project_name_id'";
            $all_custmr_id = $db->select($sql);
            echo '<select name="dealer_id" id="dealer_id" class="form-control" style="width: 140px; required">';
            echo '<option value="none">Select...</option>';
            if ($all_custmr_id->num_rows > 0) {
              while ($row = $all_custmr_id->fetch_assoc()) {
                $id = $row['dealer_id'];
                echo '<option value="' . $id . '">' . $id . '</option>';
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
              <option value="cement">cement</option>
            </select>
             <input id="button1" type="button" value="Click!" /> 
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
            <input type="text" name="driver_name" class="form-control-cement" id="driver_name" placeholder="Driver name...">
          </td>
          <td>
            <input type="text" name="motor_name" class="form-control-cement" id="motor_name" placeholder="Motor name...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="motor_vara" class="form-control-cement value-calc" id="motor_vara" placeholder="Gari vara...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="unload" name="unload" class="form-control-cement value-calc" id="unload" placeholder="Unload...">
          </td>
          <td>
            <input type="text" name="car_rent_redeem" class="form-control-cement value-calc" id="car_rent_redeem" placeholder="Enter cars rent & redeem...">
          </td>
          <td>
            <input type="text" name="information" class="form-control-cement" id="information" placeholder="Enter Information...">
          </td>


          <?PHP
          $sql = "SELECT sl FROM details_cement ORDER BY id DESC LIMIT 1";
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
            <input type="text" name="sl_no" class="form-control-cement" id="sl_no" value="<?php echo $newId ?>" placeholder="Enter sl no..." style="cursor:not-allowed;">
          </td>
          <td>
            <input type="text" name="address" class="form-control-cement" id="address" placeholder="Address..." pattern="[a-zA-Z0-9-\s]+" required>
          </td>
          <td>
            <input type="text" name="challan_no" class="form-control-cement" id="challan_no" placeholder="Enter challan no..." required>
          </td>

          <td>
            <input type="text" name="motor" class="form-control-cement" id="motor" placeholder="Motor...">
          </td>
          <td>
            <input type="text" name="motor_no" class="form-control-cement" id="motor_no" placeholder="Motor sl...">
          </td>
          <td>
            <input onkeypress="datecheckformat(event)" type="text" name="challan_date" class="form-control-cement" id="delivery_date" placeholder="dd-mm-yyyy">
          </td>
          <td>
            <input onkeypress="datecheckformat(event)" type="text" name="so_date" class="form-control-cement" id="dates2" placeholder="dd-mm-yyyy">
          </td>
          <td>
            <input onkeypress="datecheckformat(event)" type="text" name="dates" class="form-control-cement" id="dates" placeholder="dd-mm-yyyy">
          </td>
          <td>
            <input type="text" name="partculars" class="form-control-cement" id="partculars" placeholder="Marfot...">
          </td>
          <td>
            <?php
            // var parti_val = $('#car_rent_redeem').val();
            $sql = "SELECT DISTINCT category_name FROM cement_category WHERE  category_name != ''";
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
            <input type="text" onkeypress="return isNumber(event)" name="debit" class="form-control-cement value-calc" id="debit" placeholder="Debit...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="count" class="form-control-cement value-calc" id="count" placeholder="Count...">
          </td>

          <td>
            <input type="text" onkeypress="return isNumber(event)" name="fee" class="form-control-cement value-calc" id="fee" placeholder="Fee...">
          </td>

          <td>
            <input type="text" onkeypress="return isNumber(event)" name="paras" class="form-control-cement value-calc" id="paras" placeholder="Paras per ton...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="discount" class="form-control-cement value-calc" id="discount" placeholder="Discount...">
          </td>
          <td>
            <input type="text" name="credit" class="form-control-cement value-calc" id="credit" placeholder="Credit...">
          </td>

          <td style="display: none;">
            <input type="text" name="balance" class="form-control-cement value-calc" id="balance" placeholder="Balance...">
          </td>
          <td style="display: none;">
            <input type="text" name="total_credit" class="form-control-cement value-calc" id="total_credit" placeholder="Total_Credit...">
          </td>
          <td>
            <input type="text" onkeypress="return isNumber(event)" name="weight" name="weight" class="form-control-cement value-calc" id="weight" placeholder="Weight ( MT )...">
          </td>
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
$sql = "SELECT * FROM details_cement WHERE dealer_id='$dealerId' AND project_name_id = '$project_name_id'";
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
              <th>Dealer ID:</th>
              <th>Driver Name</th>
              <th>Motor Name</th>

              <th>Motor Vara</th>
              <th>Unload</th>
              <th>Cars rent & Redeem</th>
              <th>Information</th>
              <th>SL</th>
              <th>Address</th>
              <th>Challan No.</th>
              <th>Motor SL</th>
              <th>Motor Number</th>
              <th>Challan Date</th>
              <th>SO Date</th>
              <th>Date</th>
              <th>Partculars</th>
              <th>Particulars</th>
              <th>Debit</th>
              <th>Count</th>
              <th>Fee</th>
              <th>Para's</th>
              <th>Discount</th>
              <th>Credit</th>
              <th>Balance</th>
              <th>Total Credit</th>
              <th>Weight (MT)</th>
              <th></th>
              <th class='no_print_media'></th>
              <th class='no_print_media'></th>
            </tr>
            <tr>
              <th>ডিলার আই ডি</th>
              <!-- <td>ডিলার আই ডি</td> -->
              <!-- <td>টাইপ</td> -->

              <!-- <td>মালের বিবরণ</td> -->
              <th>ড্রাইভারের নাম</th>
              <th>গাড়ী নাম</th>

              <th>গাড়ী ভাড়া</th>
              <th>আনলোড</th>
              <th>গাড়ী ভাড়া ও খালাস</th>
              <th>মালের বিবরণ</th>

              <th>ক্রমিক নং</th>
              <th>ঠিকানা</th>
              <th>ভাউচার নং</th>

              <th>গাড়ী নাম্বার</th>
              <th>গাড়ী নং</th>
              <th>ভাউচার তারিখ</th>
              <th>অর্ডার তারিখ</th>
              <th>তারিখ</th>
              <th>মারফ‌োত নাম</th>
              <th>ব‌িবরণ</th>
              <th>জমা টাকা</th>
              <th>পরিমান‌</th>
              <th>ফি</th>
              <th>দর</th>
              <th>কমিশন</th>
              <th>মূল</th>
              <th>অবশিষ্ট</th>
              <th>মোট মূলঃ</th>
              <th>ওজন (এম,টি )</th>
              <th></th>
              <th class='no_print_media'></th>
              <th class='no_print_media'></th>
            </tr>
            </head>
          <tbody>
            <?php
            while ($rows = $result->fetch_assoc()) {
              if ($rows['challan_date'] == '0000-00-00') {
                $format_challan_date = '';
              } else {
                $challan_date = $rows['challan_date'];
                $format_challan_date = date("d-m-Y", strtotime($challan_date));
              }
              if ($rows['so_date'] == '0000-00-00') {
                $format_so_date = '';
              } else {
                $so_date = $rows['so_date'];
                $format_so_date = date("d-m-Y", strtotime($so_date));
              }
              if ($rows['dates'] == '0000-00-00') {
                $format_dates = '';
              } else {
                $dates = $rows['dates'];
                $format_dates = date("d-m-Y", strtotime($dates));
              }
              echo "<tr>";
              echo "<td>" . $rows['dealer_id'] . "</td>";
              echo "<td>" . $rows['driver_name'] . "</td>";
              echo "<td>" . $rows['motor_name'] . "</td>";
              echo "<td>" . $rows['motor_vara'] . "</td>";
              echo "<td>" . $rows['unload'] . "</td>";
              echo "<td>" . $rows['cars_rent_redeem'] . "</td>";
              echo "<td>" . $rows['information'] . "</td>";
              echo "<td>" . $rows['sl'] . "</td>";
              echo "<td>" . $rows['address'] . "</td>";
              echo "<td>" . $rows['challan_no'] . "</td>";

              echo "<td>" . $rows['motor_sl'] . "</td>";
              echo "<td>" . $rows['motor_no'] . "</td>";
              // echo "<td>" . $format_challan_date . "</td>";
              echo "<td>" . $rows['challan_date'] . "</td>";
              echo "<td>" . $rows['so_date'] . "</td>";
              echo "<td>" . $format_dates . "</td>";
              echo "<td>" . $rows['partculars'] . "</td>";
              echo "<td>" . $rows['particulars'] . "</td>";
              echo "<td>" . $rows['debit'] . "</td>";
              echo "<td>" . $rows['count'] . "</td>";
              echo "<td>" . $rows['fee'] . "</td>";
              echo "<td>" . $rows['paras'] . "</td>";
              echo "<td>" . $rows['discount'] . "</td>";
              echo "<td>" . $rows['credit'] . "</td>";
              echo "<td>" . $rows['balance'] . "</td>";
              echo "<td>" . $rows['total_credit'] . "</td>";
              echo "<td>" . $rows['weight'] . "</td>";

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