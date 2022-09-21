<?php 
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php');
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $sucMsg = '';
  if(isset($_POST['submit'])){
    $motor_cash       = trim($_POST['motor_cash']);
    $unload           = trim($_POST['unload']);
    $car_rent_redeem  = trim($_POST['car_rent_redeem']);
    $Information      = trim($_POST['information']);
    $customer_id    = trim($_POST['customer_id']);
    $delear_id      = trim($_POST['delear_id']);
    $address        = trim($_POST['address']);
    $sl_no          = trim($_POST['sl_no']);
    $delivery_no    = trim($_POST['delivery_no']);
    $motor          = trim($_POST['motor']);
    $motor_no       = trim($_POST['motor_no']);

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
    $paritculars    = trim($_POST['paritculars']);
    $debit        = trim($_POST['debit']);
    $mm           = trim($_POST['mm']);
    $kg           = trim($_POST['kg']);
    $paras        = trim($_POST['paras']);
    $credit       = trim($_POST['credit']);
    $discount     = trim($_POST['discount']);
    $balance      = trim($_POST['balance']);
    $bundil       = trim($_POST['bundil']);
    $total_paras  = trim($_POST['total_paras']);

    $sql = "INSERT INTO details (motor_cash, unload, cars_rent_redeem, information, customer_id, dealer_id, address, sl_no, delivery_no, motor, motor_no, delivery_date, dates, partculars, particulars, debit,   mm, kg, paras, credit, discount, balance, bundil, total_paras) VALUES('$motor_cash', '$unload', '$car_rent_redeem', '$Information', '$customer_id', '$delear_id', '$address', '$sl_no', '$delivery_no', '$motor', '$motor_no', '$delivery_date', '$dates', '$partculars', '$paritculars', '$debit', '$mm', '$kg', '$paras', '$credit ', '$discount', '$balance', '$bundil', '$total_paras')";

    $result = $db->insert($sql);
    if ($result) 
    {
      $sucMsg = "New Entry Saved Successfully.";
    } else{
      echo "Error: " . $sql . "<br>" . $db->error;
    }

    // $conn = new mysqli(HOST, USER, PASS, DB_NAME);

    //  $sql = "INSERT INTO details (motor_cash, unload, cars_rent_redeem, information, customer_id, dealer_id, address, sl_no, delivery_no, motor, motor_no, delivery_date, dates, partculars, particulars, debit,   mm, kg, paras, credit, discount, balance, bundil, total_paras) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?,?,?,?,?,?,?,?,?,?,?,?)";

    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("ssssssssssssssssssssssss", $motor_cash, $unload, $car_rent_redeem, $Information, $customer_id, $delear_id, $address, $sl_no, $delivery_no, $motor, $motor_no, $delivery_date, $dates, $partculars, $paritculars, $debit, $mm, $kg, $paras, $credit , $discount, $balance, $bundil, $total_paras);
    // $stmt->execute();
  
  }






  if(isset($_GET['remove_id'])){
      $details_id = $_GET['remove_id'];

      $sql = "DELETE FROM details WHERE id = '$details_id'";
      if ($db->select($sql) === TRUE) {
        $sucDel = "Details entry deleted successfully.";
      } else {
        echo "Error: " . $sql . "<br>" .$db->error;
      }
  }



  $entryDisBlock= 'display';
  $editDisBlock= 'none';
  if(isset($_GET['rod_details_id'])){
      $rod_details_id = $_GET['rod_details_id'];
      
      $entryDisBlock= 'none';
      $editDisBlock= 'display';
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




      if(isset($_POST['submitUpdate'])){
          $motor_cash       = trim($_POST['motor_cash']);
          $unload           = trim($_POST['unload']);
          $car_rent_redeem  = trim($_POST['car_rent_redeem']);
          $Information      = trim($_POST['information']);
          $customer_id    = trim($_POST['customer_id']);
          $delear_id      = trim($_POST['delear_id']);
          $address        = trim($_POST['address']);
          $sl_no          = trim($_POST['sl_no']);
          $delivery_no    = trim($_POST['delivery_no']);
          $motor          = trim($_POST['motor']);
          $motor_no       = trim($_POST['motor_no']);

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
          $partculars   = trim($_POST['partculars']);
          $paritculars  = trim($_POST['paritculars']);
          // echo $paritculars;
          $debit        = trim($_POST['debit']);
          $mm           = trim($_POST['mm']);
          $kg           = trim($_POST['kg']);
          $paras        = trim($_POST['paras']);
          $credit       = trim($_POST['credit']);
          $discount     = trim($_POST['discount']);
          $balance      = trim($_POST['balance']);
          $bundil       = trim($_POST['bundil']);
          $total_paras  = trim($_POST['total_paras']);

          // update query likte hobe
          // ========================================
          $sql = "UPDATE details SET motor_cash = '$motor_cash', unload = '$unload', cars_rent_redeem = '$car_rent_redeem', information = '$Information', customer_id = '$customer_id', dealer_id = '$delear_id', address = '$address', sl_no = '$sl_no', delivery_no = '$delivery_no', motor = '$motor', motor_no = '$motor_no', delivery_date = '$delivery_date', dates = '$dates', partculars = '$partculars', particulars = '$paritculars', debit = '$debit', mm = '$mm', kg = '$kg', paras = '$paras', credit = '$credit ', discount = '$discount', balance = '$balance', bundil = '$bundil', total_paras = '$total_paras' WHERE id = '$rod_details_id'";

          if ($db->select($sql) === TRUE) {
              $sucMsg = "Rod details updated Successfully.";

          } else {
              echo "Error: " . $sql . "<br>" . $db->error;
          }

        }

  }

  
  
?>




<!DOCTYPE html>
<html>
<head>
  <title>রড বিস্তারিত হিসাব এনট্রি</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
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
        height: 500px;
        overflow-x: auto;
        /*overflow-y: auto;*/
        margin-bottom: 50px;
    }
    .ui-dialog-titlebar{
      color: white;
      background-color: #ce0000;
    }
    .searchCon{
        width: 100%;
        margin-bottom: 10px;            
    }
    .searchCon p{
        margin-bottom: 5px;
        padding-left: 10px;
    }
    .otherSearchCon{
        width: 100%;
        border: 1px solid #ddd;
        padding: 10px;
    }
    .dateSearch{
        width: 172px;
    }
    .bootstrap-select{
        width: 130px !important;
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

        <div class="rodDetailsEnCon" style="display: <?php echo $entryDisBlock;?>;">
            <form action="" method="post" onsubmit="return valid()">
              <h2 class="ce_header bg-primary">Details Entry</h2>
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
                              $sql = "SELECT customer_id FROM customers";
                              $all_custmr_id = $db->select($sql);
                              echo '<select name="customer_id" id="customer_id" class="form-control" style="width: 140px;">';
                                echo '<option value="none">Select...</option>';
                                if($all_custmr_id->num_rows > 0){
                                    while($row = $all_custmr_id->fetch_assoc()){
                                      $id = $row['customer_id'];
                                      echo '<option value="' . $id . '">' . $id . '</option>';
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
                              $sql = "SELECT dealer_id FROM dealers";
                              $all_custmr_id = $db->select($sql);
                              echo '<select name="delear_id" id="delear_id" class="form-control" style="width: 140px;">';
                                echo '<option value="">Select...</option>';
                                if($all_custmr_id->num_rows > 0){
                                    while($row = $all_custmr_id->fetch_assoc()){
                                      $id = $row['dealer_id'];
                                      echo '<option value="' . $id . '">' . $id . '</option>';
                                    }
                                  } else{
                                    echo '<option value="none">0 Result</option>';
                                  }
                                echo '</select>';
                            ?>
                          </td>
                          <td>
                            <input type="text" name = "motor_cash" class="form-control value-calc" id="motor_cash" placeholder="Enter Motor Cash...">
                          </td>
                          <td>
                            <input type="text" name ="unload" class="form-control value-calc" id="unload" placeholder="Unload">
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
                            <input type="text" name="sl_no" class="form-control" id="sl_no" placeholder="Enter SL No...">
                          </td>
                          <td>
                            <input type="text" name="delivery_no" class="form-control" id="delivery_no" placeholder="Enter delivery no...">
                          </td>
                          <td>
                            <input type="text" name="motor" class="form-control" id="motor" placeholder="Enter number of motor...">
                          </td>
                          <td>
                            <input type="text" name="motor_no" class="form-control" id="motor_no" placeholder="Enter Motor No...">
                          </td>
                          <td>
                            <input type="text" name="delivery_date" class="form-control" id="delivery_date" placeholder="dd-mm-yy">
                          </td>
                          <td>
                            <input type="text" name="dates" class="form-control" id="dates" placeholder="dd-mm-yy">
                          </td>
                          <td>
                            <input type="text" name="partculars" class="form-control" id="partculars" placeholder="Enter partculars...">
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
                              $rod_catgry_sql = "SELECT * FROM rod_category";
                              $rslt_rod_catgry = $db->select($rod_catgry_sql);

                              echo '<select name="paritculars" id="paritculars" class="form-control" style="width: 260px;">';
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

                                      // echo '</optgroup>';
                                    }

                                    // echo '<optgroup label="Others...">';
                                    // $others_sql = "SELECT * FROM rod_and_other_label WHERE rod_category_id = '0'";
                                    // $rslt_others = $db->select($others_sql);

                                    // if($rslt_others->num_rows > 0){                                 
                                    //   while($row3 = $rslt_others->fetch_assoc()){
                                    //     $others_id = $row3['id'];
                                    //     $others_label = $row3['rod_label'];
                                    //     $others_category_id = $row3['rod_category_id'];

                                    //     echo "<option value='" . ($others_label) . "'>" . $others_label . "</option>";
                                    //   }
                                    // } 
                                    // echo '</optgroup>';

                                  } else{
                                    echo '<option>0 results</option>';
                                  }
                              echo '</select> ';
                            ?>

                          </td>
                          <td>
                            <input type="text" name="debit" class="form-control value-calc" id="debit" placeholder="Enter debit...">
                          </td>
                          <td>
                            <input type="text" name="mm" class="form-control" id="mm" placeholder="Example '00 mm'...">
                          </td>
                          <td>
                            <input type="text" name="kg" class="form-control value-calc" id="kg" placeholder="Enter kg...">
                          </td>
                          <td>
                            <input type="text" name="paras" class="form-control value-calc" id="paras" placeholder="Enter paras...">
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
                      <h3 class="text-success text-center"><?php echo $sucMsg; ?></h3>
              </div>
                <input type="submit" name = "submit" class="btn btn-block btn-primary scroll-after-btn" value="Save">
            </form>
        </div>
        <div class="rodDetailsEdit"  style="display: <?php echo $editDisBlock;?>;">
            <form action="" method="post" onsubmit="return validEdit()">
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
                              $sql = "SELECT customer_id FROM customers";
                              $all_custmr_id = $db->select($sql);
                              echo '<select name="customer_id" id="customer_id_edit" class="form-control" style="width: 140px;">';
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
                              $sql = "SELECT dealer_id FROM dealers";
                              $all_custmr_id = $db->select($sql);
                              echo '<select name="delear_id" id="delear_id_edit" class="form-control" style="width: 140px;">';
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
                              $rod_catgry_sql = "SELECT * FROM rod_category";
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
                                                  echo "<option value='" . $raol_rod_label . "'".$select1.">" . $raol_rod_label . "</option>";
                                              }
                                            }
                                        } else{
                                          echo '<option>0 results</option>';
                                        }

                                      // echo '</optgroup>';
                                    }

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
                      <h3 class="text-success text-center" id="sucUpdate"><?php echo $sucMsg; ?></h3>
              </div>
                <input type="submit" name = "submitUpdate" class="btn btn-block btn-primary scroll-after-btn" value="Update">
            </form>
        </div>
        <br><br>


        <div class="searchCon">
            <p><b>Search By:</b></p>
            <div class="otherSearchCon">
                
                <div class="dateSearch"> 
                <b>Date:</b>                   
                    <select class="selectpicker" data-style="btn-info" id="dateSearchList">
                        <option value="alldates">All dates</option>
                        <?php
                            $sql = "SELECT DISTINCT dates FROM details ORDER BY dates ASC";
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
            </div>
        </div>

        <div class="viewDetailsCon" id="viewDetails">
            <table id="detailsNewTable2" >
              <head>
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
                  <th></th>
                  <th></th>
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
                      <th></th>
                      <th></th>
                </tr>
              </head>
              <tbody>
              <?php
                    $sql ="SELECT * FROM details";
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
                            echo "<td width='78px'><a class='btn btn-danger detailsDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
                            // echo "<td width='60px'><a class='btn btn-success' href='rod_details_edit.php?rod_details_id=" . $rows['id'] . "'>Edit</a></td>";
                            echo "<td width='60px'><a class='btn btn-success' href='rod_details_entry.php?rod_details_id=" . $rows['id'] . "'>Edit</a></td>";
                            echo "</tr>";                            
                        }
                    } 
              ?>
              </tbody>
            </table>
        </div>

        <br><br>
    </div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>

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
      function validEdit() {
          var returnValid = false;
          var customer_id = $('#customer_id_edit').val();
          var delear_id   = $('#delear_id_edit').val();
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
  <script type="text/javascript">
      $('.selectpicker').selectpicker();
  </script>
  <script type="text/javascript">
      function getDataByDates(datestr){
          $.ajax({
              url: '../ajaxcall/rod_search_date_entry.php',
              type: 'post',
              data: {
                  optionDate: datestr
              },
              success: function(res){
                  // alert(res);
                  $('#viewDetails').html(res);
              },
              error: function(jqXHR, textStatus, errorThrown){
                  console.log(textStatus, errorThrown);
              }
          });
      }



      $(document).on('change', '#dateSearchList', function(){
          var optionText = $('#dateSearchList option:selected').val();
          // alert(optionText);
          if(optionText === 'alldates'){
              window.location.href = '../vaucher/rod_details_entry.php';
          } else {
              getDataByDates(optionText);
          }
      });
  </script>
  <script type="text/javascript">
    var value =$('#sucUpdate').html();
    // alert(value);
    function wait(){
      if( value == 'Rod details updated Successfully.'){
        
        document.location.href = '../vaucher/rod_details_entry.php';
      }
    }
    setTimeout('wait()', 1500);
  </script>
</body>
</html>