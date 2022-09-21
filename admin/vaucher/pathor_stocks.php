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

  $_SESSION['pageName'] = 'pathor_stocks';  
  $sucMsg = '';



?>




<!DOCTYPE html>
<html>
<head>
    <title>স্টক তথ্য</title>
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
      }
      .balu_table_headerssTableCon{
          width: 100%;
          margin-bottom: 0px;
		  background-color: gray;
      }
      .balu_table_headerssTableCon tr th {
        border: 1px solid #ddd;
        text-align: center;
      }
      .balu_table_headerssTableCon tr td {
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
      .showDealerCon table th{
        border: 1px solid #ddd;
        text-align: center;
        padding: 4px 5px;
      }
      .showDealerCon table tr:nth-child(odd) td {
	    	border: 2px solid #ddd;
	    	padding: 2px 5px;
			/* text-align: center; */
            background-color: #d2df0d2e;
            color: black;
	    }
      .showDealerCon table td{
        border: 1px solid #ddd;
        padding: 2px 5px;
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
            <?php require '../others_page/left_menu_bar_pathor_hisab.php'; ?>
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
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">স্টক তথ্য</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                            
                        </h2>
                    </div>
                <?php 
                    }
                } 
            ?>
            <!-- <h4 class="company_header">Dealer Entry</h4> -->
  

            <div class="showDealerCon">
              <table >
                <tr class="bg-primary">
                  <th>মারফ‌োত নাম</th>
                  <th>ব‌িবরণ</th>
                  <th>টোন</th>

                  <!-- <th>Address</th>
                  <th>Contact Person Name</th>
                  <th>Mobile</th> -->
                  <!-- <th>Delete</th>
                  <th>Edit</th> -->
                </tr>
                <?php
                  $sql = "SELECT partculars,particulars,sum(ton) as 'ton' FROM stocks_pathor WHERE partculars != '' AND project_name_id = '$project_name_id' AND ton > 0 GROUP BY partculars,particulars";
                  $show = $db->select($sql);
                  if ($show) {
                      while ($rows = $show->fetch_assoc()){
                          echo "<tr>";
                              echo "<td>". $rows['partculars'] . "</td>";
                              echo "<td>". $rows['particulars'] . "</td>";
                              echo "<td>". $rows['ton'] . "</td>";
                                      
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
            var company_name = $('#header_name').val();
            var address    = $('#address').val();
            var contact_person  = $('#contact_person').val();
            var mobile      = $('#mobile').val();
            // alert(company_name.length);
            var company_name_valid  = false;
            var address_valid       = false;
            var contact_person_valid= false;
            var mobile_valid        = false;

            if(company_name == ''){
              $('#companyNameErrMsg').html('Header name can not be empty !');
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

            // if(address == ''){
            //   $('#addressErrMsg').html('Address can not be empty !');
            //   $('#address').focus();        
            // } else if(address.length > 255) {
            //   $('#addressErrMsg').html('Address can not be greater than 255 characters !');
            //   $('#address').focus();        
            // } else if($.isNumeric(address)) {
            //   $('#addressErrMsg').html('Address can not be a number!');
            //   $('#address').focus();        
            // } else {
            //   $('#addressErrMsg').html('');
            //   address_valid  = true;
            // }


            // if(contact_person == ''){
            //   $('#contactPersonNameErrMsg').html('Contact person name can not be empty !');
            //   $('#contact_person').focus();       
            // } else if(contact_person.length > 100) {
            //   $('#contactPersonNameErrMsg').html('Contact person name can not be greater than 100 characters !');
            //   $('#contact_person').focus();       
            // } else if($.isNumeric(contact_person)) {
            //   $('#contactPersonNameErrMsg').html('Contact person name can not be a number!');
            //   $('#contact_person').focus();       
            // } else {
            //   $('#contactPersonNameErrMsg').html('');
            //   contact_person_valid =true;
            // }


            // if(mobile == ''){
            //   $('#mobileErrMsg').html('Mobile number can not be empty !');
            //   $('#mobile').focus();       
            // } else if(mobile.length > 11) {
            //   $('#mobileErrMsg').html('Mobile number can not be greater than 11 characters !');
            //   $('#mobile').focus();       
            // } else if(!$.isNumeric(mobile)) {
            //   $('#mobileErrMsg').html('Mobile number must contain number!');
            //   $('#mobile').focus();       
            // } else {
            //   $('#mobileErrMsg').html('');
            //   mobile_valid  = true;
            // }


            if(company_name_valid){
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

            $('#header_id').val(td_id);
            $('#header_id_hidden').val(td_id);
            $('#header_name').val(td_name);
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
                                            $.get("pathor_stocks.php?remove_id="+remove_id, function(data, status){
                                              console.log(status);
                                              if(status == 'success'){
                                                window.location.href = 'pathor_stocks.php';
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