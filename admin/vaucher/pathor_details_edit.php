<?php 
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php');
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $sucMsg = '';
  $balu_details_id = $_GET['rod_details_id'];

  if(isset($_POST['submit'])){
    $motor_name           = trim($_POST['motor_name']);
    $driver_name           = trim($_POST['driver_name']);
    $motor_vara          = trim($_POST['motor_vara']);
    $unload          = trim($_POST['unload']);
    $car_rent_redeem  = trim($_POST['car_rent_redeem']);
    $information      = trim($_POST['information']);
    // $delear_id      = trim($_POST['delear_id']);
    $delear_id      = trim($_SESSION['dealerIdInput']);
    $sl      = trim($_POST['sl_no']);
    $voucher_no     = trim($_POST['delivery_no']);
    $address        = trim($_POST['address']);
    $motor_no          = trim($_POST['motor']);
    $motor_sl    = trim($_POST['motor_no']);
  
    // $delivery_date  = trim($_POST['delivery_date']);
    if($_POST['delivery_date'] == ''){
      $delivery_date = $_POST['delivery_date'];
    } else {
      $postDateArr    = explode('-', $_POST['delivery_date']);
      $delivery_date  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
    }
    // $dates          = trim($_POST['dates']);
    if($_POST['dates'] == ''){
      $dates = $_POST['dates'];
    } else {
      $postDateArr2   = explode('-', $_POST['dates']);
      $dates          = $postDateArr2['2'].'-'.$postDateArr2['1'].'-'.$postDateArr2['0'];
    }
    $partculars     = trim($_POST['partculars']);
    $particulars    = trim($_POST['particulars']);
    $debit        = trim($_POST['debit']);
    $ton_kg          = trim($_POST['kg']);
    $length         = trim($_POST['length']);
    $width        = trim($_POST['width']);
    $height     = trim($_POST['height']);
    $shifty     = trim($_POST['shifty']);
    $inchi_minus        = trim($_POST['inchi(-)_minus']);
    $cft_dropped_out    = trim($_POST['cft(-)_dropped_out']);
    $inchi_added    = trim($_POST['inchi(+)_added']);
    $points_dropped_out      = trim($_POST['points(-)_dropped_out']);
    $shift      = trim($_POST['shift']);
    $total_shift      = trim($_POST['total_shift']);
   
    $paras      = trim($_POST['paras']);
    $discount     = trim($_POST['discount']);
    $credit      = trim($_POST['credit']);
    $balance      = trim($_POST['balance']);
    $cemeats_paras      = trim($_POST['cemeats_paras']);
    $ton    = trim($_POST['ton']);
    $total_shifts  = trim($_POST['total_shifts']);
    $tons  = trim($_POST['tons']);
    $bank_name  = trim($_POST['bank']);
    $fee  = trim($_POST['fee']);

    // update query likte hobe
    // ========================================
    $sql = "UPDATE details_pathor SET motor_name = '$motor_name', driver_name = '$driver_name', motor_vara = '$motor_vara', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$Information', sl = '$sl', voucher_no = '$voucher_no',  dealer_id = '$delear_id', address = '$address', motor_number = '$motor_number', motor_sl = '$motor_sl', delivery_date = '$delivery_date', dates = '$dates', partculars = '$partculars', particulars = '$paritculars', debit = '$debit', ton_kg = '$ton_kg', length = '$length', width = '$width',  height = '$height',  shifty = '$shifty ', inchi_minus = '$inchi_minus', cft_dropped = '$cft_dropped', inchi_added = '$inchi_added', points_dropped = '$points_dropped', shift = '$shift', total_shift = '$total_shift', paras = '$paras', discount = '$discount', credit = '$credit', balance = '$balance', cemeats_paras = '$cemeats_paras', ton = '$ton', total_shifts = '$total_shifts', tons = '$tons', bank_name = '$bank_name', fee = '$fee' WHERE id = '$balu_details_id'";

    if ($db->select($sql) === TRUE) {
        $sucMsg = "balu details updated Successfully.";

    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

  }



  if(isset($_GET['rod_details_id'])){
      $sql = "SELECT * FROM details WHERE id = '$rod_details_id'";
      $result = $db->select($sql);
          if($result) {
              while ($rows = $result->fetch_assoc()){
                  $customer_id        = $rows['customer_id'];
                  $dealer_id          = $rows['dealer_id'];
                  $motor_cash         = $rows['motor_cash'];
                  $unload             = $rows['unload'];
                  $cars_rent_redeem   = $rows['cars_rent_redeem'];
                  $information        = $rows['information'];                  
                  $address            = $rows['address'];
                  $sl_no              = $rows['sl_no'];
                  $delivery_no        = $rows['delivery_no'];
                  $motor         = $rows['motor'];
                  $motor_no      = $rows['motor_no'];


                  $delivery_date = $rows['delivery_date'];
                  if($delivery_date == '0000-00-00'){
                      $delivery_date ='';
                  } else {
                      $postDateArr2   = explode('-', $delivery_date);
                      $delivery_date  = $postDateArr2['2'].'-'.$postDateArr2['1'].'-'.$postDateArr2['0'];
                  }
                  

                  $dates         = $rows['dates'];
                  if($dates == '0000-00-00'){
                      $dates ='';
                  } else {
                      $postDateArr2   = explode('-', $dates);
                      $dates  = $postDateArr2['2'].'-'.$postDateArr2['1'].'-'.$postDateArr2['0'];
                  }

                  $partculars    = $rows['partculars'];
                  $particulars   = $rows['particulars'];
                  $debit         = $rows['debit'];
                  $mm            = $rows['mm'];
                  $kg            = $rows['kg'];
                  $paras         = $rows['paras'];
                  $credit        = $rows['credit'];
                  $discount      = $rows['discount'];
                  $balance       = $rows['balance'];
                  $bundil        = $rows['bundil'];
                  $total_paras   = $rows['total_paras'];
              }
          }

  }


?>




<!DOCTYPE html>
<html>
<head>
  <title>রড বিস্তারিত হিসাব এডিট</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../css/voucher.css">

  


  <style type="text/css">
    
    .scroll-after-btn {
        margin-top: 25px;
    }
    #detailsEtryTable{
      width: 280%;
      border: 1px solid #ddd;
    }
    #detailsEtryTable tr:first-child td{
      text-align: center;
    }
    #detailsEtryTable tr:nth-child(2) td{
      text-align: center;
    }
    #detailsEtryTable td{
      border: 1px solid #9c9c9c;
    }
    .scrolling-div{
      width: 100%;
      overflow-y: auto;      
    }
    .scrolling-div::-webkit-scrollbar {
      width: 10px;
      
    }
    .scrolling-div::-webkit-scrollbar-track {
      background: #ff9696;
      box-shadow: inset 0 0 5px grey; 
      border-radius: 10px;
    }
    .scrolling-div::-webkit-scrollbar-thumb {
      background: red;
      border-radius: 10px;
    }
    .scrolling-div::-webkit-scrollbar-thumb:hover {
      background: #900;
    }

    #detailsNewTable2{
      width: 217%;
      border: 1px solid #ddd;
      /*transform: rotateX(180deg);*/
    }
    #detailsNewTable2 th, td{
      border: 1px solid #ddd;
      padding: 2px 5px;
    }
    #detailsNewTable2 tr:first-child th{
      text-align: center;
      background-color: #8f0000;
      color: #fff;
      padding: 5px 0px;
    }
    #detailsNewTable2 tr:nth-child(2) th{
      text-align: center;
      background-color: #009e07;
      padding: 5px 0px;
      color: #fff;
    }
    .viewDetailsCon{
        width: 100%;
        overflow-x: auto;
        margin-bottom: 50px;
    }
    .ui-dialog-titlebar{
      color: white;
      background-color: #ce0000;
    }
  </style>
</head>
<body>
    <?php
      include '../navbar/header_text.php';
      $page = 'rod_hisab';
      include '../navbar/navbar.php';
    ?>
    <div class="container">
    		<?php
    			$ph_id = $_SESSION['project_name_id'];
    			$query = "SELECT * FROM project_heading WHERE id = $ph_id";
    			$show = $db->select($query);
    			if ($show) 
    			{
    				while ($rows = $show->fetch_assoc()) 
    				{
    			?>
    				<div class="project_heading text-center">      
    				  <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
    				  <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
    				</div>
    			<?php 
    				}
    			} 
    		?>

        <div class="rodDetailsEdit">
            <form action="" method="post" onsubmit="return valid()">
              <h2 class="ce_header bg-primary">Details Edit</h2>
              <div class="scrolling-div">                    
                      <table border="1" id="detailsEtryTable">
                        <tr>
                          <td width="150">Customer ID</td>
                          <td width="150">Dealer ID</td>
                          <td width="120">Motor Cash</td>
                          <td width="100">Unload</td>
                          <td width="150">Cars rent & Redeem</td>
                          <td width="120">Information</td>                  
                          <td width="100">Address</td>
                          <td width="100">SL No</td>
                          <td width="120">Delivery No</td>
                          <td width="100">Motor</td>
                          <td width="150">Motor No</td>
                          <td width="150">Delivery Date</td>
                          <td width="150">Date</td>
                          <td width="150">Partculars</td>
                          <td width="150">Particulars</td>
                          <td width="150">Debit</td>
                          <td width="150">mm</td>
                          <td width="150">Kg</td>
                          <td width="150">Para's</td>
                          <td width="150">Credit</td>
                          <td width="150">Discount</td>
                          <td width="150">Balance</td>
                          <td width="150">Bundil</td>
                          <td width="150">Total Para's</td>
                        </tr>
                        <tr>
                          <td>কাস্টমার আই ডি</td>
                          <td>ডিলার আই ডি</td>
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
                        <tr>
                          <td>
                            <!-- <input type="text" name="customer_id" class="form-control" id="customer_id" placeholder="Enter customer_id..."> -->
                            <?php
                              $sql = "SELECT customer_id FROM customers_pathor";
                              $all_custmr_id = $db->select($sql);
                              echo '<select name="customer_id" id="customer_id" class="form-control" style="width: 140px;">';
                                echo '<option value="none">Select...</option>';
                                if($all_custmr_id->num_rows > 0){
                                    while($row = $all_custmr_id->fetch_assoc()){
                                      $id = $row['customer_id'];
                                      if($customer_id ==  $id){
                                        $select = "selected";
                                      } else {
                                        $select = "";
                                      }
                                      
                                      echo '<option value="' . $id . '"'.$select.'>' . $id . '</option>';
                                    }
                                  } else{
                                    echo '<option value="none">0 Resulst</option>';
                                  }
                                echo '</select>';
                            ?>

                          </td>
                          <td>
                            <!-- <input type="text" name="delear_id" class="form-control" id="delear_id" placeholder="Enter delear_id..."> -->
                            <?php
                              $sql = "SELECT dealer_id FROM pathor_dealer";
                              $all_custmr_id = $db->select($sql);
                              echo '<select name="delear_id" id="delear_id" class="form-control" style="width: 140px;">';
                                echo '<option value="">Select...</option>';
                                if($all_custmr_id->num_rows > 0){
                                    while($row = $all_custmr_id->fetch_assoc()){
                                      $id1 = $row['dealer_id'];
                                      if($dealer_id == $id1){
                                        $select3 = "selected";
                                      } else {
                                        $select3 = "";
                                      }
                                      echo '<option value="' . $id1 . '"'. $select3 .'>' . $id1 . '</option>';
                                    }
                                  } else{
                                    echo '<option value="none">0 Result</option>';
                                  }
                                echo '</select>';
                            ?>
                          </td>
                          <td>
                            <input type="text" name = "motor_cash" class="form-control value-calc" id="motor_cash" placeholder="Enter Motor Cash..." value="<?php echo $motor_cash; ?>">
                          </td>
                          <td>
                            <input type="text" name ="unload" class="form-control value-calc" id="unload" placeholder="Unload..."  value="<?php echo $unload; ?>">
                          </td>
                          <td>
                            <input type="text" name = "car_rent_redeem" class="form-control value-calc" id="car_rent_redeem" placeholder="Enter cars rent & redeem..." value="<?php echo $cars_rent_redeem; ?>">
                          </td>
                          <td>
                            <input type="text" name="information" class="form-control" id="information" placeholder="Enter information..." value="<?php echo $information; ?>">
                          </td>
                          
                          <td>
                            <input type="text" name="address" class="form-control" id="address" placeholder="Enter address..." value="<?php echo $address; ?>">
                          </td>
                          <td>
                            <input type="text" name="sl_no" class="form-control" id="sl_no" placeholder="Enter SL No..." value="<?php echo $sl_no; ?>">
                          </td>
                          <td>
                            <input type="text" name="delivery_no" class="form-control" id="delivery_no" placeholder="Enter delivery no..." value="<?php echo $delivery_no; ?>">
                          </td>
                          <td>
                            <input type="text" name="motor" class="form-control" id="motor" placeholder="Enter number of motor..." value="<?php echo $motor; ?>">
                          </td>
                          <td>
                            <input type="text" name="motor_no" class="form-control" id="motor_no" placeholder="Enter Motor No..." value="<?php echo $motor_no; ?>">
                          </td>
                          <td>
                            <input type="text" name="delivery_date" class="form-control" id="delivery_date" placeholder="dd-mm-yy" value="<?php echo $delivery_date; ?>">
                          </td>
                          <td>
                            <input type="text" name="dates" class="form-control" id="dates" placeholder="dd-mm-yy" value="<?php echo $dates; ?>">
                          </td>
                          <td>
                            <input type="text" name="partculars" class="form-control" id="partculars" placeholder="Enter partculars..." value="<?php echo $partculars; ?>">
                          </td>
                          <td>
                            <?php
                              // $rod_catgry_sql = "SELECT * FROM rod_category";
                              // $rslt_rod_catgry = $db->select($rod_catgry_sql);

                              // echo '<select name="paritculars" id="paritculars" class="form-control" style="width: 260px;">';
                              // echo '<option value="">Select...</option>';
                              // if($rslt_rod_catgry->num_rows > 0){
                              //       while($row = $rslt_rod_catgry->fetch_assoc()){
                              //         $rod_category_id = $row['id'];
                              //         $rod_category_name = $row['category_name'];

                              //         echo '<optgroup label="'. $rod_category_name . '" rod_category_id="' . $rod_category_id . '">';

                              //           $rod_lbl_sql = "SELECT * FROM rod_and_other_label";
                              //           $rslt_rod_lbl = $db->select($rod_lbl_sql);
                              //           if($rslt_rod_lbl->num_rows > 0){

                              //             while($row2 = $rslt_rod_lbl->fetch_assoc()){
                              //                 $raol_id = $row2['id'];
                              //                 $raol_rod_label = $row2['rod_label'];
                              //                 $raol_rod_category_id = $row2['rod_category_id'];


                              //                 if($rod_category_id == $raol_rod_category_id){
                              //                   echo '<option value="' . $raol_rod_label . '">' . $raol_rod_label . '</option>';
                              //                 }
                              //               }
                              //           } else{
                              //             echo '<option>0 results</option>';
                              //           }

                              //         echo '</optgroup>';
                              //       }

                              //       echo '<optgroup label="Others...">';
                              //       $others_sql = "SELECT * FROM rod_and_other_label WHERE rod_category_id = '0'";
                              //       $rslt_others = $db->select($others_sql);

                              //       if($rslt_others->num_rows > 0){                                 
                              //         while($row3 = $rslt_others->fetch_assoc()){
                              //           $others_id = $row3['id'];
                              //           $others_label = $row3['rod_label'];
                              //           $others_category_id = $row3['rod_category_id'];

                              //           echo '<option value="' . $others_label . '">' . $others_label . '</option>';
                              //         }
                              //       } 
                              //       echo '</optgroup>';

                              //     } else{
                              //       echo '<option>0 results</option>';
                              //     }
                              // echo '</select> ';
                            ?>
                            <?php
                              $rod_catgry_sql = "SELECT * FROM pathor_category";
                              $rslt_rod_catgry = $db->select($rod_catgry_sql);

                              echo '<select name="paritculars" id="paritculars" class="form-control" style="width: 260px;">';
                              echo '<option value="">Select...</option>';
                              if($rslt_rod_catgry->num_rows > 0){
                                    while($row = $rslt_rod_catgry->fetch_assoc()){
                                      $rod_category_id = $row['id'];
                                      $rod_category_name = $row['category_name'];
                                      if($particulars ==  $rod_category_name){
                                        $select = "selected";
                                      } else {
                                        $select = "";
                                      }
                                      echo '<option style="font-weight: bold;"'.$select.'>'. $rod_category_name . '</option>';

                                        $rod_lbl_sql = "SELECT * FROM rod_and_other_label";
                                        $rslt_rod_lbl = $db->select($rod_lbl_sql);
                                        if($rslt_rod_lbl->num_rows > 0){

                                          while($row2 = $rslt_rod_lbl->fetch_assoc()){
                                              $raol_id = $row2['id'];
                                              $raol_rod_label = $row2['rod_label'];
                                              $raol_rod_category_id = $row2['rod_category_id'];
                                              if($rod_category_id == $raol_rod_category_id){
                                                  if($particulars ==  $raol_rod_label){
                                                      $select1 = "selected";
                                                  } else {
                                                      $select1 = "";
                                                  }
                                                  echo '<option value="' . $raol_rod_label . '"'.$select1.'>' . $raol_rod_label . '</option>';
                                              }
                                            }
                                        } else{
                                          echo '<option>0 results</option>';
                                        }

                                      // echo '</optgroup>';
                                    }

                                    echo '<optgroup label="Others...">';
                                    $others_sql = "SELECT * FROM pathor_and_other_label WHERE rod_category_id = '0'";
                                    $rslt_others = $db->select($others_sql);

                                    if($rslt_others->num_rows > 0){                                 
                                      while($row3 = $rslt_others->fetch_assoc()){
                                        $others_id = $row3['id'];
                                        $others_label = $row3['rod_label'];
                                        $others_category_id = $row3['rod_category_id'];
                                        if($particulars ==  $others_label){
                                            $select2 = "selected";
                                        } else {
                                            $select2 = "";
                                        }
                                        echo '<option value="' . $others_label . '"'.$select2.'>' . $others_label . '</option>';
                                      }
                                    } 
                                    echo '</optgroup>';

                                  } else{
                                    echo '<option>0 results</option>';
                                  }
                              echo '</select> ';
                            ?>

                          </td>
                          <td>
                            <input type="text" name="debit" class="form-control value-calc" id="debit" placeholder="Enter debit..." value="<?php echo $debit; ?>">
                          </td>
                          <td>
                            <input type="text" name="mm" class="form-control" id="mm" placeholder="Example '00 mm'..." value="<?php echo $mm; ?>">
                          </td>
                          <td>
                            <input type="text" name="kg" class="form-control value-calc" id="kg" placeholder="Enter kg..." value="<?php echo $kg; ?>">
                          </td>
                          <td>
                            <input type="text" name="paras" class="form-control value-calc" id="paras" placeholder="Enter paras..." value="<?php echo $paras; ?>">
                          </td>
                          <td>
                            <input type="text" name="credit" class="form-control" id="credit" placeholder="Enter credit..." value="<?php echo $credit; ?>">
                          </td>
                          <td>
                            <input type="text" name="discount" class="form-control" id="discount" placeholder="Enter discount..." value="<?php echo $discount; ?>">
                          </td>
                          <td>
                            <input type="text" name="balance" class="form-control" id="balance" placeholder="Enter balance..." value="<?php echo $balance; ?>">
                          </td>
                          <td>
                            <input type="text" name="bundil" class="form-control" id="bundil" placeholder="Enter bundil..." value="<?php echo $bundil; ?>">
                          </td>
                          <td>
                            <input type="text" name="total_paras" class="form-control" id="total_paras" placeholder="Enter total_paras..." value="<?php echo $total_paras; ?>">
                          </td>
                          <!-- <td colspan="2"></td> -->
                        </tr>               
                      </table>
                      <h3 class="text-success text-center"><?php echo $sucMsg; ?></h3>
              </div>
                <input type="submit" name = "submit" class="btn btn-block btn-primary scroll-after-btn" value="Update">
            </form>
        </div>


    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript">
      function valid() {
          var returnValid = false;
          var customer_id = $('#customer_id').val();
          var delear_id   = $('#delear_id').val();
          // var paritculars = $('#paritculars').val();
          // alert(customer_id);

          if(customer_id == 'none'){
            alert('Please select a customer Id');
            returnValid = false;
          } 
          // else if(delear_id == ''){
          //   alert('Please select a dealer Id');
          //   returnValid = false;
          // }
          //else if(paritculars == 'none'){
          //   alert('Please select a particulars');
          //   returnValid = false;
          // }
           else{
            returnValid = true;
          }



          if(returnValid){
            return true;
          } else{
            return false;
          }
      }
  </script>
  <script type="text/javascript">   
    // Start calculation
      $(".value-calc").on("input change paste keyup", function() {
          var kg    = $('#kg').val();
          var paras = $('#paras').val();
          if(kg == ''){
            $('#credit').val('0');
          } else if(paras == ''){
            $('#credit').val('0');
          } else {
            var credit = kg * paras;
            // alert(credit);
            $('#credit').val(credit);
          }

          var debit = $("#debit").val();
          var credit = $("#credit").val();
          if(debit == ''){
            $('#balance').val('0');
          } else if(credit == ''){
            $('#balance').val('0');
          } else {
            var balance = credit - debit;
            // alert(balance);
            $('#balance').val(balance);
          }

          var motor_cash = $('#motor_cash').val();
          var unload = $('#unload').val();
          if(motor_cash == ''){
            $('#car_rent_redeem').val('0');
          } else if(unload == ''){
            $('#car_rent_redeem').val('0');
          } else {
            var car_rent_redeem = parseInt(motor_cash) + parseInt(unload);
            // alert(balance);
            $('#car_rent_redeem').val(car_rent_redeem);
          }
          

          var car_rent_redeem = $('#car_rent_redeem').val();
          var credit = $("#credit").val();
          if(car_rent_redeem == ''){
            var total_paras = credit;
            $('#total_paras').val(total_paras);
          } else {
            var total_paras = parseInt(car_rent_redeem) + parseInt(credit);
            $('#total_paras').val(total_paras);
          }
      });
    //End calculation
  </script>

  <script type="text/javascript">
    // Start Date pickers
        $('#delivery_date').datepicker( {
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd-mm-yy",
            changeYear: true,
        });


        $('#dates').datepicker( {
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd-mm-yy",
            changeYear: true,
        });
    // End Date pickers
  </script>
  <script type="text/javascript">    

    $(document).on('click', '.detailsDelete', function(event){
        event.preventDefault();
        var data_delete_id = $(event.target).attr('data_delete_id');
        console.log(data_delete_id);
        ConfirmDialog('Are you sure delete details info?');
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
                                        $.get("rod_details_entry.php?remove_id="+ data_delete_id, function(data, status){
                                          console.log(status);
                                          if(status == 'success'){
                                            window.location.href = 'rod_details_entry.php';
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

  </script>
</body>
</html>