<?php 
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php');
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $project_name_id = $_SESSION['project_name_id'];
  $edit_data_permission   = $_SESSION['edit_data'];
  $delete_data_permission = $_SESSION['delete_data'];

  $_SESSION['pageName'] = 'rod_dealer_entry';  
  $sucMsg = '';

  $sql = "SELECT dealer_id FROM dealers ORDER BY id DESC LIMIT 1";
  $customersId = $db->select($sql);
  if($customersId->num_rows > 0){
      $row = $customersId->fetch_assoc();
      $largestId = $row['dealer_id'];
  } else {
        $largestId = 'DLAR-100000';
  }
  $matches = preg_replace('/\D/', '', $largestId);
  $newNumber = $matches + 1;
  $newId = 'DLAR-' . $newNumber;


  if(isset($_POST['submit'])){
      $submitBtn_value = $_POST['submit'];      
      $dealer_name   = trim($_POST['dealer_name']);
      $address        = trim($_POST['address']);
      $contact_person_name = trim($_POST['contact_person_name']);
      $mobile        = trim($_POST['mobile']);
      // var_dump($rod_c);

      if($submitBtn_value == 'Save'){
          $dealer_id     = $newId;
          $sql="INSERT INTO dealers (dealer_id, dealer_name, address, contact_person_name, mobile, project_name_id) VALUES ('$dealer_id','$dealer_name', '$address', '$contact_person_name', '$mobile',  '$project_name_id')";

          if ($db->select($sql) === TRUE) {
              $sql = "SELECT dealer_id FROM dealers ORDER BY id DESC LIMIT 1";
              $customersId = $db->select($sql);
              if($customersId->num_rows > 0){
                $row = $customersId->fetch_assoc();
                $largestId = $row['dealer_id'];
              }
              $matches = preg_replace('/\D/', '', $largestId);
              $newNumber = $matches + 1;
              $newId = 'CMPY-' . $newNumber;

              $sucMsg = "New Dealer Saved Successfully";
          } else {
              echo "Error: " . $sql . "<br>" . $db->error;
          }
      } else {
          $dealer_id = $_POST['dealer_id'];
          $sql="UPDATE dealers SET dealer_name = '$dealer_name', address = '$address', contact_person_name = '$contact_person_name', mobile = '$mobile' WHERE dealer_id = '$dealer_id'";

          if ($db->update($sql) === TRUE) {
              $sucMsg = "Dealer Updated Successfully";
          } else {
              echo "Error: " . $sql . "<br>" . $db->error;
          }
      }

          
  }

  if(isset($_GET['remove_id'])){
      $delete_dealer = $_GET['remove_id'];

      $sql = "DELETE FROM dealers WHERE id = '$delete_dealer'";
      if ($db->select($sql) === TRUE) {
        $sucDel = "Dealer delete successfully.";
      } else {
        echo "Error: " . $sql . "<br>" .$db->error;
      }
  }

?>




<!DOCTYPE html>
<html>
<head>
    <title>রড ডিলার এনট্রি</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
    <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">

  
    <style type="text/css">
      .dateInput{
          line-height: 22px !important;
      }
      .allowText {
          float: right;
          margin-bottom: 3px;
      }
      .table-bordered > tbody > tr > td {
          border: 1px solid #ddd;
      }
      .table > thead > tr > th {
          border-bottom: 2px solid #ddd;
      }
      .table-bordered > thead > tr > th {
          border: 1px solid #ddd;
      }
      .rodDelEnCon{
          margin-bottom: 50px;
          position: relative;
          height: 157px;
      }
      .dealersTableCon{
          width: 100%;
          margin-bottom: 0px;
      }
      .dealersTableCon tr th {
        border: 2px solid #ddd;
        text-align: center;
        padding: 4px 5px;
        background-color:#3e9309d4;
        color: white;
      }
      .dealersTableCon tr td {
        border: 2px solid #ddd;
        padding: 2px 5px;
      }
      .borderLess {
        border: none !important;
      }
      .showDealerCon table {
        width: 100%;
        margin-bottom: 50px;
      }
      .showDealerCon table th{
        border:2px solid #ddd;
        text-align: center;
        padding: 5px 5px;
      }
      .showDealerCon table td{
        border: 2px solid #ddd;
        padding: 2px 5px;
      }
      .showDealerCon table tr:nth-child(odd) td {
	    	border: 2px solid #ddd;
	    	padding: 2px 5px;
			/* text-align: center; */
            background-color: #d2df0d2e;
            color: black;
            /* width: 100%;
        margin-bottom: 50px; */
	    }
      .backcircle{
        font-size: 18px;
        position: absolute;
        margin-top: -20px;
      }
      .backcircle a:hover{
          text-decoration: none !important;
      }
      #submitBtn{
          width: 100px;
          position: absolute;
          right: 0px;
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
            <?php require '../others_page/left_menu_bar_rod_hisab.php'; ?>
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
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">ডিলার এন্ট্রি</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                            
                        </h2>
                    </div>
                <?php 
                    }
                } 
            ?>
            <!-- <h4 class="company_header">Dealer Entry</h4> -->
            <div class="rodDelEnCon">        
            
                <!-- <div class="backcircle">
                  <a href="../vaucher/rod_index.php">
                    <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
                  </a>
                </div> -->
                
                <form action="" method="post" onsubmit="return validation()">
                    <table class="dealersTableCon">
                        <tr>
                          <th width="130px">Delear Id</th>
                          <th>Delear Name</th>
                          <th width="260px">Address</th>
                          <th>Contact Person Name</th>
                          <th>Mobile</th>
                        </tr>
                        <tr>
                          <td>
                            <input type="text" class="form-control" id="dealer_id" value="<?php echo $newId; ?>" disabled>
                            <input type="hidden" name= "dealer_id" class="form-control" id="dealer_id_hidden" value="<?php echo $newId; ?>">
                          </td>
                          <td><input type="text" name = "dealer_name" class="form-control" id="dealer_name" placeholder="Enter company name..."></td>
                          <td><input type="text" name = "address" class="form-control" id="address" placeholder="Enter company address..."></td>
                          <!-- <td><textarea name = "address" class = "form-control" rows = "2" placeholder = "Enter Company Address..." id='address' style="resize: none;"></textarea></td> -->
                          <td><input type="text" name = "contact_person_name" class="form-control" id="contact_person" placeholder="Enter contact person name..."></td>
                          <td><input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile no..."></td>
                        </tr>
                        <tr>
                          <td class="borderLess"></td>
                          <td class="borderLess"><h4 id="companyNameErrMsg" class="text-danger"></h4></td>
                          <td class="borderLess"><h4 id="addressErrMsg" class="text-danger"></h4></td>
                          <td class="borderLess"><h4 id="contactPersonNameErrMsg" class="text-danger"></h4></td>
                          <td class="borderLess"><h4 id="mobileErrMsg" class="text-danger"></h4></td>
                        </tr>
                    </table>
                    <h4 class="text-center text-success"><?php echo $sucMsg; ?></h4>
                    <input type="submit" name="submit" id="submitBtn" class="btn btn-primary" value="Save">
                </form>
            </div>

            <div class="showDealerCon">
              <table >
                <tr class="bg-primary">
                  <th>Dealer Id</th>
                  <th>Dealer Name</th>
                  <th>Address</th>
                  <th>Contact Person Name</th>
                  <th>Mobile</th>
                  <th>Delete</th>
                  <th>Edit</th>
                </tr>
                <?php
                  $sql = "SELECT * FROM dealers";
                  $show = $db->select($sql);
                  if ($show) {
                      while ($rows = $show->fetch_assoc()){
                          echo "<tr>";
                              echo "<td>". $rows['dealer_id'] . "</td>";
                              echo "<td>". $rows['dealer_name'] . "</td>";
                              echo "<td>". $rows['address'] . "</td>";
                              echo "<td>". $rows['contact_person_name'] . "</td>";
                              echo "<td>". $rows['mobile'] . "</td>";
                              
                              if($delete_data_permission == 'yes'){
                                echo "<td width='78px'><a class='btn btn-danger dealerDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
                              } else {
                                echo '<td width="78px"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                              }

                              if($edit_data_permission == 'yes'){
                                echo "<td width='60px'><a class='btn btn-success' onclick='displayupdate(this)'>Edit</a></td>";
                              } else {
                                echo '<td width="60px"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
                              }                              
                          echo "</tr>";
                      }
                  }
                ?>
              </table>
            </div>
        </div>
    </div>
    <?php include '../others_page/delete_permission_modal.php';  ?>





  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        function validation(){
            var company_name = $('#dealer_name').val();
            var address    = $('#address').val();
            var contact_person  = $('#contact_person').val();
            var mobile      = $('#mobile').val();
            // alert(company_name.length);
            var company_name_valid  = false;
            var address_valid       = false;
            var contact_person_valid= false;
            var mobile_valid        = false;

            if(company_name == ''){
              $('#companyNameErrMsg').html('Company name can not be empty !');
              $('#company_name').focus();       
            } else if(company_name.length > 100) {
              $('#companyNameErrMsg').html('Company name can not be greater than 100 characters !');
              $('#company_name').focus();       
            } else if($.isNumeric(company_name)){
              $('#companyNameErrMsg').html('Company name can not be a number !');
              $('#company_name').focus();       
            } else{
              $('#companyNameErrMsg').html('');
              company_name_valid  = true;
            }

            if(address == ''){
              $('#addressErrMsg').html('Address can not be empty !');
              $('#address').focus();        
            } else if(address.length > 255) {
              $('#addressErrMsg').html('Address can not be greater than 255 characters !');
              $('#address').focus();        
            } else if($.isNumeric(address)) {
              $('#addressErrMsg').html('Address can not be a number!');
              $('#address').focus();        
            } else {
              $('#addressErrMsg').html('');
              address_valid  = true;
            }


            if(contact_person == ''){
              $('#contactPersonNameErrMsg').html('Contact person name can not be empty !');
              $('#contact_person').focus();       
            } else if(contact_person.length > 100) {
              $('#contactPersonNameErrMsg').html('Contact person name can not be greater than 100 characters !');
              $('#contact_person').focus();       
            } else if($.isNumeric(contact_person)) {
              $('#contactPersonNameErrMsg').html('Contact person name can not be a number!');
              $('#contact_person').focus();       
            } else {
              $('#contactPersonNameErrMsg').html('');
              contact_person_valid =true;
            }


            if(mobile == ''){
              $('#mobileErrMsg').html('Mobile number can not be empty !');
              $('#mobile').focus();       
            } else if(mobile.length > 11) {
              $('#mobileErrMsg').html('Mobile number can not be greater than 11 characters !');
              $('#mobile').focus();       
            } else if(!$.isNumeric(mobile)) {
              $('#mobileErrMsg').html('Mobile number must contain number!');
              $('#mobile').focus();       
            } else {
              $('#mobileErrMsg').html('');
              mobile_valid  = true;
            }


            if(company_name_valid && address_valid && contact_person_valid && mobile_valid){
              return true;
            } else {
              return false;
            }
        }

        function displayupdate(element){
            var td_id     = $(element).closest('tr').find('td:eq(0)').text();
            var td_name   = $(element).closest('tr').find('td:eq(1)').text();
            var td_addr   = $(element).closest('tr').find('td:eq(2)').text();
            var td_contact = $(element).closest('tr').find('td:eq(3)').text();
            var td_mobile   = $(element).closest('tr').find('td:eq(4)').text();
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

            $("html, body").animate({scrollTop: 0}, 500);
        }
    </script>
    <script type="text/javascript">
        $(document).on('click', '.dealerDelete', function(event){          
            var remove_id = $(event.target).attr('data_delete_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("data_delete_id", remove_id);
        });
        $(document).on('click', '#verifyToDeleteBtn', function(event){
            event.preventDefault();
            var remove_id = $(event.target).attr('data_delete_id');
            console.log(remove_id);
            $("#passMsg").html("").css({'margin':'0px'});          
            var pass = $("#matchPassword").val();
            $.ajax({
                url: "../ajaxcall/match_password_for_vaucher_credit.php",
                type: "post",
                data: { pass : pass },
                success: function (response) {
                    // alert(response);
                    if(response == 'password_matched'){
                        $("#verifyPasswordModal").hide();
                        ConfirmDialog('Are you sure delete dealer info?');
                    } else {
                        $("#passMsg").html(response).css({'color':'red','margin-top':'10px'});
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
            
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
                                            $.get("rod_dealer_entry.php?remove_id="+remove_id, function(data, status){
                                              console.log(status);
                                              if(status == 'success'){
                                                window.location.href = 'rod_dealer_entry.php';
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

        $(document).on('click', '.edPermit', function(event){
            event.preventDefault();
            ConfirmDialog('You have no permission edit/delete this data !');
            function ConfirmDialog(message){
                $('<div></div>').appendTo('body')
                                .html('<div><h4>'+message+'</h4></div>')
                                .dialog({
                                    modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                    width: '40%', resizable: false,
                                    position: { my: "center", at: "center center-20%", of: window },
                                    buttons: {
                                        Ok: function () {
                                            $(this).dialog("close");
                                        },
                                        Cancel: function () {
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
        $('.left_side_bar').height($('.main_bar').innerHeight());
    </script>
    <script type="text/javascript">
        $(document).on("click", ".kajol_close, .cancel", function(){
            $("#verifyPasswordModal").hide();
        });
    </script>
    <script src="../js/common_js.js"> </script>
</body>
</html>