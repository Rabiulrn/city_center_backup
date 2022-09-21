<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];

$_SESSION['pageName'] = 'balu_dealer_entry';
$sucMsg = '';

$sql = "SELECT dealer_id FROM balu_dealer ORDER BY id DESC LIMIT 1";
$customersId = $db->select($sql);
if ($customersId->num_rows > 0) {
  $row = $customersId->fetch_assoc();
  $largestId = $row['dealer_id'];
} else {
  $largestId = 'DLAR-100000';
}
$matches = preg_replace('/\D/', '', $largestId);
$newNumber = $matches + 1;
$newId = 'DLAR-' . $newNumber;


if (isset($_POST['submit'])) {
  $submitBtn_value = $_POST['submit'];
  $motor_name   = trim($_POST['Motor_Name']);
  $driver_name  = trim($_POST['Driver_Name']);
  $Motor_Vara = trim($_POST['Motor_Vara']);
  $Unload        = trim($_POST['Unload']);
  $Cars_Rent = $_POST['Cars_Rent_&_Redeem'];
  $Information   = trim($_POST['Information']);
  $SL        = trim($_POST['SL']);
  $Voucher_No_ = trim($_POST['Voucher_No_']);
  $Address       = trim($_POST['Address']);
  $Motor_Number = $_POST['Motor_Number'];
  $Motor_SL   = trim($_POST['Motor_SL']);
  $Delivery_Date        = trim($_POST['Delivery_Date']);
  $Date = trim($_POST['Date']);
  $Partculars        = trim($_POST['Partculars']);
  $Particulars        = trim($_POST['Particulars']);
  $Debit = $_POST['Debit'];
  $Ton_Kg  = trim($_POST['Ton_&_Kg']);
  $Length        = trim($_POST['Length']);
  $width = trim($_POST['width']);
  $Height        = trim($_POST['Height']);
  $Shifty = $_POST['Shifty'];
  $Inchi   = trim($_POST['Inchi_(-)_Minus']);
  $Cft       = trim($_POST['Cft_(_-_)_Dropped_Out']);
  $Inchi_plus = trim($_POST['Inchi_(+)_Added']);
  $Points       = trim($_POST['Points_(_-_)_Dropped_Out']);

  $Shift   = trim($_POST['Shift']);
  $Total_Shift        = trim($_POST['Total_Shift']);
  $Para = trim($_POST['Para']);
  $Discount        = trim($_POST['Discount']);
  $Credit = $_POST['Credit'];
  $Balance   = trim($_POST['Balance']);
  $Cemeat_Paras        = trim($_POST['Cemeats_Paras']);
  $Ton = trim($_POST['Ton']);
  $Total_shifts      = trim($_POST['Total_shifts']);
  $Tons = $_POST['Tons'];
  $Bank_Name   = trim($_POST['Bank_Name']);
  $Fee        = trim($_POST['Fee ']);
  $Buyer_Id   = trim($_POST['Buyer_Id']);
  $Dealer_Id       = trim($_POST['Dealer_Id']);

  //  var_dump($driver_name);
  print_r($_POST);
  echo $driver_name;
  if ($submitBtn_value == 'Save') {
    $dealer_id     = $newId;
    $sql = "INSERT INTO `details_balu`(`id`, `buyer_id`, `dealer_id`, `motor_name`, `motor_vara`, `unload`, `cars_rent_redeem`, `information`, `sl`, `voucher_no`, `address`, `motor_no`, `motor_sl`, `delivery_date`, `dates`, `partculars`, `particulars`, `debit`, `ton & kg`, `length`, `width`, `height`, `shifty`, `inchi (-)_minus`, `cft (-)_dropped Out`, `inchi (+)_added`, `points ( - )_dropped out`, `shift`, `total_shift`, `paras`, `discount`, `credit`, `cemeats_paras`, `ton`, `total_shifts`, `tons`, `bank_name`, `fee`) 
          VALUES ('',  '$Buyer_Id', '$Dealer_Id', '$motor_name', '$Motor_Vara', '$Unload', '$Cars_Rent', '$Information', '$SL', '$Voucher_No', '$Address', '$Motor_No', '$Motor_SL', '$Delivery_Date', '$Dates', '$Partculars', '$Particulars', '$Debit', '$Ton_Kg', '$Length', '$Width', '$Height', '$Shifty', '$Inchi', '$Cft',  '$Inchi', '$Points', '$Shift', '$Total_Shift', '$Paras', '$Discount', '$Credit', '$Cemeats_Paras', '$Ton', '$Total_Shifts', 
          '$Tons', '$Bank_Name', '$Fee')";

    // $sql="INSERT INTO details_balu (motor_vara) VALUES ('$Motor_Vara')";

    if ($db->select($sql) === TRUE) {
      //   $sql = "SELECT dealer_id FROM balu_dealer ORDER BY id DESC LIMIT 1";
      //   $customersId = $db->select($sql);
      //   if($customersId->num_rows > 0){
      //     $row = $customersId->fetch_assoc();
      //     $largestId = $row['dealer_id'];
      //   }
      //   $matches = preg_replace('/\D/', '', $largestId);
      //   $newNumber = $matches + 1;
      //   $newId = 'CMPY-' . $newNumber;

      $sucMsg = "New Dealer Saved Successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $db->error;
    }
  }
  //    else {
  //       $dealer_id = $_POST['dealer_id'];
  //       $sql="UPDATE balu_dealer SET dealer_name = '$dealer_name', address = '$address', contact_person_name = '$contact_person_name', mobile = '$mobile' WHERE dealer_id = '$dealer_id'";

  //       if ($db->update($sql) === TRUE) {
  //           $sucMsg = "Dealer Updated Successfully";
  //       } else {
  //           echo "Error: " . $sql . "<br>" . $db->error;
  //       }
  //   }


}

//   if(isset($_GET['remove_id'])){
//       $delete_dealer = $_GET['remove_id'];

//       $sql = "DELETE FROM balu_dealer WHERE id = '$delete_dealer'";
//       if ($db->select($sql) === TRUE) {
//         $sucDel = "Dealer delete successfully.";
//       } else {
//         echo "Error: " . $sql . "<br>" .$db->error;
//       }
//   }

?>




<!DOCTYPE html>
<html>

<head>
  <title>বালু ক্রয় হিসাব</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
  <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">


  <style type="text/css">
    .dateInput {
      line-height: 22px !important;
    }

    .allowText {
      float: right;
      margin-bottom: 3px;
    }

    .table-bordered>tbody>tr>td {
      border: 1px solid #ddd;
    }

    .table>thead>tr>th {
      border-bottom: 2px solid #ddd;
    }

    .table-bordered>thead>tr>th {
      border: 1px solid #ddd;
    }

    .rodDelEnCon {
      margin-bottom: 50px;
      position: relative;
      height: 157px;
    }

    .balu_dealersTableCon {
      width: 100%;
      margin-bottom: 0px;
      background-color: gray;
    }

    .balu_dealersTableCon tr th {
      border: 1px solid #ddd;
      text-align: center;
    }

    .balu_dealersTableCon tr td {
      border: 1px solid #ddd;
      padding: 2px;
    }

    .borderLess {
      border: none !important;
    }

    .showDealerCon table {
      width: 100%;
      margin-bottom: 50px;
    }

    .showDealerCon table th {
      border: 1px solid #ddd;
      text-align: center;
      padding: 2px 5px;
    }

    .showDealerCon table td {
      border: 1px solid #ddd;
      padding: 2px 5px;
    }

    .backcircle {
      font-size: 18px;
      position: absolute;
      margin-top: -20px;
    }

    .backcircle a:hover {
      text-decoration: none !important;
    }

    #submitBtn {
      width: 100px;
      position: absolute;
      right: 0px;
    }


    .header-input {
      width: 100%;
      border: none;

    }
  </style>

</head>

<body>
  <?php
  include '../navbar/header_text.php';
  // $page = 'rod_hisab';
  include '../navbar/navbar.php';
  ?>
  <div class="container">

  </div>


  <div class="bar_con">
    <div class="left_side_bar">
      <?php require '../others_page/left_menu_bar_balu_hisab.php'; ?>
    </div>
    <div class="main_bar">
      <?php
      $ph_id = $_SESSION['project_name_id'];
      $query = "SELECT * FROM project_heading WHERE id = $ph_id";
      $show = $db->select($query);
      if ($show) {
        while ($rows = $show->fetch_assoc()) {
      ?>
          <div class="project_heading">
            <h2 class="headingOfAllProject">
              <?php echo $rows['heading']; ?> <span class="protidinHisab">বালু ক্রয় হিসাব</span>
              <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; 
                                                  ?></span> -->

            </h2>
          </div>
      <?php
        }
      }
      ?>

      <h3 class="text-center my-3"> মেসার্স এ.জেড.এম. ওয়াজেদুল হক</h3>
      <h4 class="text-center my-3"> পাথর ক্রয় হিসাব </h4>
      <h4 class="text-center my-3"> ( প্রোঃ মমিন ভাইর পাথর হিসাব ) </h4>
      <h5 class="text-center my-3"> বুড়িমারী, পাটগ্রাম, লালমনিরহাট / BURIMARY, PATGAM, LALMNIHAT</h5>
      <hr>
      <!-- <h4 class="company_header">Dealer Entry</h4> -->
      <div class="rodDelEnCon">

        <!-- <div class="backcircle">
                  <a href="../vaucher/rod_index.php">
                    <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
                  </a>
                </div> -->

        <form action="" method="post" onsubmit="return validation()">

          <div class="showDealerCon">
            <table>
              <tr class="bg-primary">
                <th>Header Name</th>
                <th>Input</th>
                <!-- <th>Address</th>
                  <th>Contact Person Name</th>
                  <th>Mobile</th>
                  <th>Delete</th>
                  <th>Edit</th> -->
              </tr>
              <?php
              $sql = "SELECT * FROM balu_table_headers";
              $show = $db->select($sql);
              if ($show) {
                while ($rows = $show->fetch_assoc()) {
                  echo "<tr>";
                  $temp = $rows['header_name'];
                  echo "<td>" . $rows['header_name'] . "</td>";
                  echo "<td><input class=\"header-input\" type=\"text\" name=\"$temp\" placeholder=\"$temp\"  ></td>";
                  //   echo "<td><input type=\"text\" name=\" { $rows['header_name']  } \"placeholder=\" { $rows['header_name']  } \"></td>";
                  //   echo "<td>". $rowss['address'] . "</td>";
                  //   echo "<td>". $rowss['contact_person_name'] . "</td>";
                  //   echo "<td>". $rowss['mobile'] . "</td>";

                  //   if($delete_data_permission == 'yes'){
                  //     echo "<td width='78px'><a class='btn btn-danger dealerDelete' data_delete_id=" . $rowss['id'] . ">Delete</a></td>";
                  //   } else {
                  //     echo '<td width="78px"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                  //   }

                  //   if($edit_data_permission == 'yes'){
                  //     echo "<td width='60px'><a class='btn btn-success' onclick='displayupdate(this)'>Edit</a></td>";
                  //   } else {
                  //     echo '<td width="60px"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
                  //   }                              
                  echo "</tr>";
                }
              }
              ?>
            </table>
          </div>

          <h4 class="text-center text-success"><?php echo $sucMsg; ?></h4>
          <input type="submit" name="submit" id="submitBtn" class="btn btn-primary" value="Save">
        </form>
<hr>
<hr>
<hr>

        <div style="overflow-x: scroll">
                <table class="table table-bordered table-striped mt-5">
                    <thead class="text-light bg-info text-center">
                        <tr>
                            <th>Motor Name</th>
                            <th>Driver Name</th>
                            <th>Cft(-) Motor Vara</th>
                            <th>Unload</th>
                            <th>Cars Rent & Redeem</th>
                            <th>Information</th>
                            <th>SL</th>
                            <th>Voucher No.</th>
                            <th>Address</th>
                            <th>Motor Number</th>
                            <th>Motor SL</th>
                            <th>Delivery Date</th>
                            <th>Date</th>
                            <th>Partculars</th>
                            <th>Partculars</th>
                            <th>Debit</th>
                            <th>Ton & Kg</th>
                            <th>Lenght</th>
                            <th>width</th>
                            <th>Hight</th>
                            <th>Shifty</th>
                            <th> Inchi (-) Minus</th>
                            <th>Cft ( - ) Dropped Out</th>
                            <th>Inchi (+) Added</th>
                            <th>Points ( - ) Dropped Out</th>
                            <th>Shift</th>
                            <th>Total Shift</th>
                            <th>Para's</th>
                            <th>Discount</th>

                            <th>Crebit</th>
                            <th>Balance</th>
                            <th>Cemeat's Para's</th>

                            <th>Ton</th>
                            <th>Total Shift</th>
                            <th>Ton</th>
                            <th>ব্যাংক ফ্রি হিসাব। </th>
                        </tr>
                        <tr>
                            <th>গাড়ী নাম</th>
                            <th>ড্রাইভারের নাম</th>
                            <th>গাড়ী ভাড়া</th>
                            <th>আনলোড</th>
                            <th>গাড়ী ভাড়া ও খালাস</th>
                            <th>মালের বিবরণ</th>
                            <th>ক্রমিক</th>
                            <th>ভাউচার নং</th>
                            <th>ঠিকানা</th>
                            <th>গাড়ী নাম্বার</th>
                            <th>গাড়ী নং</th>
                            <th>ডেলিভারী তারিখ</th>
                            <th>তারিখ</th>
                            <th>মারফ‌োত নাম</th>
                            <th>ব‌িবরণ।</th>
                            <th>জমা টাকা</th>
                            <th>টোন ও কেজি</th>
                            <th>দৈর্ঘ্যের</th>
                            <th>প্রস্ত</th>
                            <th>উচাঁ</th>
                            <th>সেপ্টি</th>
                            <th> Inchi (-) বিয়োগ </th>
                            <th>সিএফটি ( - ) বাদ</th>
                            <th>Inchi (+) যোগ </th>
                            <th>পয়েন্ট ( - ) বাদ</th>
                            <th>সেপ্টি</th>
                            <th>মোট সেপ্টি</th>
                            <th>দর</th>
                            <th>কমিশন</th>

                            <th>মূল</th>
                            <th>অবশিষ্ট</th>
                            <th>গাড়ী ভাড়া / লেবার সহ</th>

                            <th>টোন</th>
                            <th>সেপ্টি</th>
                            <th>টোন</th>
                            <th>ব্যাংক নাম</th>
                            <th>ফ্রি </th>
                        </tr>

                        <?php
                        // $sql2 = "SELECT * FROM 'details_balu";
                        // $result = mysqli_query($conn, $sql2);
                        // $num = mysqli_num_rows($result);
                        // echo $sql2;
                        // echo $result;


                        
                  $sql = "SELECT * FROM details_balu";
                  $show = $db->select($sql);
                  if ($show) {
                      while ($rows = $show->fetch_assoc()){
                        echo '<tr><td>' . $rows['motor_name'] . '</td>'
                        . $rows['Header_name'] . '</td><td>'
                        . $rows['motor_vara'] . '</td><td>'
                        . $rows['Unload'] . '</td><td>'
                        . $rows['Cars Rent & Redeem'] . '</td><td>'
                        . $rows['Information'] . '</td><td>'
                        . $rows['SL'] . '</td><td>'
                        . $rows['Voucher No.'] . '</td><td>'
                        . $rows['Address'] . '</td><td>'
                        . $rows['Motor Number'] . '</td><td>'
                        . $rows['Motor SL'] . '</td><td>'
                        . $rows['Delivery Date'] . '</td><td>'
                        . $rows['Date'] . '</td><td>'
                        . $rows['Partculars'] . '</td><td>'
                        . $rows['Partcular'] . '</td><td>'
                        . $rows['Debit'] . '</td><td>'
                        . $rows['Ton & Kg'] . '</td><td>'
                        . $rows['Length'] . '</td><td>'
                        . $rows['width'] . '</td><td>'
                        . $rows['Hight'] . '</td><td>'
                        . $rows['Shift'] . '</td><td>'
                        . $rows['Inchi (-) Minus'] . '</td><td>'
                        . $rows['Cft ( - ) Dropped Out'] . '</td><td>'
                        . $rows['Inchi (+) Added'] . '</td><td>'
                        . $rows['Points ( - ) Dropped Out'] . '</td><td>'
                        . $rows['Shift'] . '</td><td>'
                        . $rows['Total Shift'] . '</td><td>'
                        . $rows["Para's"] . '</td><td>'
                        . $rows['Discount'] . '</td><td>'
                        . $rows['Crebit'] . '</td><td>'
                        . $rows['Balance'] . '</td><td>'
                        . $rows["Cemeat's Para's"] . '</td><td>'
                        . $rows['Ton'] . '</td><td>'
                        . $rows['Total Shift'] . '</td><td>'
                        . $rows['Tons'] . '</td><td>'
                        . $rows['ব্যাংক ফ্রি হিসাব।'] . '</td> </tr>';
                      }
                  }
                

                        // Display the rows returned by the sql query
                        // if ($num > 0) {


                        //     // We can fetch in a better way using the while loop
                        //     while ($row = mysqli_fetch_assoc($result)) {
                        //         echo '<tr>' . $rows['motor_name'] . '</td>'
                        //             . $rows['Header_name'] . '</td><td>'
                        //             . $rows['Motor Vara'] . '</td><td>'
                        //             . $rows['Unload'] . '</td><td>'
                        //             . $rows['Cars Rent & Redeem'] . '</td><td>'
                        //             . $rows['Information'] . '</td><td>'
                        //             . $rows['SL'] . '</td><td>'
                        //             . $rows['Voucher No.'] . '</td><td>'
                        //             . $rows['Address'] . '</td><td>'
                        //             . $rows['Motor Number'] . '</td><td>'
                        //             . $rows['Motor SL'] . '</td><td>'
                        //             . $rows['Delivery Date'] . '</td><td>'
                        //             . $rows['Date'] . '</td><td>'
                        //             . $rows['Partculars'] . '</td><td>'
                        //             . $rows['Partcular'] . '</td><td>'
                        //             . $rows['Debit'] . '</td><td>'
                        //             . $rows['Ton & Kg'] . '</td><td>'
                        //             . $rows['Length'] . '</td><td>'
                        //             . $rows['width'] . '</td><td>'
                        //             . $rows['Hight'] . '</td><td>'
                        //             . $rows['Shift'] . '</td><td>'
                        //             . $rows['Inchi (-) Minus'] . '</td><td>'
                        //             . $rows['Cft ( - ) Dropped Out'] . '</td><td>'
                        //             . $rows['Inchi (+) Added'] . '</td><td>'
                        //             . $rows['Points ( - ) Dropped Out'] . '</td><td>'
                        //             . $rows['Shift'] . '</td><td>'
                        //             . $rows['Total Shift'] . '</td><td>'
                        //             . $rows["Para's"] . '</td><td>'
                        //             . $rows['Discount'] . '</td><td>'
                        //             . $rows['Crebit'] . '</td><td>'
                        //             . $rows['Balance'] . '</td><td>'
                        //             . $rows["Cemeat's Para's"] . '</td><td>'
                        //             . $rows['Ton'] . '</td><td>'
                        //             . $rows['Total Shift'] . '</td><td>'
                        //             . $rows['Tons'] . '</td><td>'
                        //             . $rows['ব্যাংক ফ্রি হিসাব।'] . '</td> </tr>';
                        //     }
                        // }
                        ?>


                    </thead>
                    <tbody class="text-center">

          


                        <!-- Optional JavaScript; choose one of the two! -->

                        <!-- Option 1: Bootstrap Bundle with Popper -->
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

                        <!-- Option 2: Separate Popper and Bootstrap JS -->

                </table>
            </div>
      </div>


    </div>
  </div>
  <?php include '../others_page/delete_permission_modal.php';  ?>





  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
    function validation() {
      var company_name = $('#dealer_name').val();
      var address = $('#address').val();
      var contact_person = $('#contact_person').val();
      var mobile = $('#mobile').val();
      // alert(company_name.length);
      var company_name_valid = false;
      var address_valid = false;
      var contact_person_valid = false;
      var mobile_valid = false;

      if (company_name == '') {
        $('#companyNameErrMsg').html('Company name can not be empty !');
        $('#company_name').focus();
      } else if (company_name.length > 100) {
        $('#companyNameErrMsg').html('Company name can not be greater than 100 characters !');
        $('#company_name').focus();
      } else if ($.isNumeric(company_name)) {
        $('#companyNameErrMsg').html('Company name can not be a number !');
        $('#company_name').focus();
      } else {
        $('#companyNameErrMsg').html('');
        company_name_valid = true;
      }

      if (address == '') {
        $('#addressErrMsg').html('Address can not be empty !');
        $('#address').focus();
      } else if (address.length > 255) {
        $('#addressErrMsg').html('Address can not be greater than 255 characters !');
        $('#address').focus();
      } else if ($.isNumeric(address)) {
        $('#addressErrMsg').html('Address can not be a number!');
        $('#address').focus();
      } else {
        $('#addressErrMsg').html('');
        address_valid = true;
      }


      if (contact_person == '') {
        $('#contactPersonNameErrMsg').html('Contact person name can not be empty !');
        $('#contact_person').focus();
      } else if (contact_person.length > 100) {
        $('#contactPersonNameErrMsg').html('Contact person name can not be greater than 100 characters !');
        $('#contact_person').focus();
      } else if ($.isNumeric(contact_person)) {
        $('#contactPersonNameErrMsg').html('Contact person name can not be a number!');
        $('#contact_person').focus();
      } else {
        $('#contactPersonNameErrMsg').html('');
        contact_person_valid = true;
      }


      if (mobile == '') {
        $('#mobileErrMsg').html('Mobile number can not be empty !');
        $('#mobile').focus();
      } else if (mobile.length > 11) {
        $('#mobileErrMsg').html('Mobile number can not be greater than 11 characters !');
        $('#mobile').focus();
      } else if (!$.isNumeric(mobile)) {
        $('#mobileErrMsg').html('Mobile number must contain number!');
        $('#mobile').focus();
      } else {
        $('#mobileErrMsg').html('');
        mobile_valid = true;
      }


      if (company_name_valid && address_valid && contact_person_valid && mobile_valid) {
        return true;
      } else {
        return false;
      }
    }

    function displayupdate(element) {
      var td_id = $(element).closest('tr').find('td:eq(0)').text();
      var td_name = $(element).closest('tr').find('td:eq(1)').text();
      var td_addr = $(element).closest('tr').find('td:eq(2)').text();
      var td_contact = $(element).closest('tr').find('td:eq(3)').text();
      var td_mobile = $(element).closest('tr').find('td:eq(4)').text();
      // alert(td_mobile);

      $('#dealer_id').val(td_id);
      $('#dealer_id_hidden').val(td_id);
      $('#dealer_name').val(td_name);
      $('#address').val(td_addr);
      $('#contact_person').val(td_contact);
      $('#mobile').val(td_mobile);
      $('#submitBtn').val('Update');



      $('#companyNameErrMsg').html('');
      $('#addressErrMsg').html('');
      $('#contactPersonNameErrMsg').html('');
      $('#mobileErrMsg').html('');

      $("html, body").animate({
        scrollTop: 0
      }, 500);
    }
  </script>
  <script type="text/javascript">
    $(document).on('click', '.dealerDelete', function(event) {
      var remove_id = $(event.target).attr('data_delete_id');
      $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
      $("#matchPassword").val('');
      $("#passMsg").html('');
      $("#verifyToDeleteBtn").attr("data_delete_id", remove_id);
    });
    $(document).on('click', '#verifyToDeleteBtn', function(event) {
      event.preventDefault();
      var remove_id = $(event.target).attr('data_delete_id');
      console.log(remove_id);
      $("#passMsg").html("").css({
        'margin': '0px'
      });
      var pass = $("#matchPassword").val();
      $.ajax({
        url: "../ajaxcall/match_password_for_vaucher_credit.php",
        type: "post",
        data: {
          pass: pass
        },
        success: function(response) {
          // alert(response);
          if (response == 'password_matched') {
            $("#verifyPasswordModal").hide();
            ConfirmDialog('Are you sure delete dealer info?');
          } else {
            $("#passMsg").html(response).css({
              'color': 'red',
              'margin-top': '10px'
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });

      function ConfirmDialog(message) {
        $('<div></div>').appendTo('body')
          .html('<div><h4>' + message + '</h4></div>')
          .dialog({
            modal: true,
            title: 'Alert',
            zIndex: 10000,
            autoOpen: true,
            width: '40%',
            resizable: false,
            position: {
              my: "center",
              at: "center center-20%",
              of: window
            },
            buttons: {
              Yes: function() {
                $(this).dialog("close");
                $.get("balu_dealer_entry.php?remove_id=" + remove_id, function(data, status) {
                  console.log(status);
                  if (status == 'success') {
                    window.location.href = 'balu_dealer_entry.php';
                  }
                });
              },
              No: function() {
                $(this).dialog("close");
              }
            },
            close: function(event, ui) {
              $(this).remove();
            }
          });
      };
    });

    $(document).on('click', '.edPermit', function(event) {
      event.preventDefault();
      ConfirmDialog('You have no permission edit/delete this data !');

      function ConfirmDialog(message) {
        $('<div></div>').appendTo('body')
          .html('<div><h4>' + message + '</h4></div>')
          .dialog({
            modal: true,
            title: 'Alert',
            zIndex: 10000,
            autoOpen: true,
            width: '40%',
            resizable: false,
            position: {
              my: "center",
              at: "center center-20%",
              of: window
            },
            buttons: {
              Ok: function() {
                $(this).dialog("close");
              },
              Cancel: function() {
                $(this).dialog("close");
              }
            },
            close: function(event, ui) {
              $(this).remove();
            }
          });
      };
    });
  </script>
  <script type="text/javascript">
    $('.left_side_bar').height($('.main_bar').innerHeight());
  </script>
  <script type="text/javascript">
    $(document).on("click", ".kajol_close, .cancel", function() {
      $("#verifyPasswordModal").hide();
    });
  </script>
  <script src="../js/common_js.js"> </script>
</body>

</html>