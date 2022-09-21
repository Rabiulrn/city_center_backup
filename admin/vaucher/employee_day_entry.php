<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$_SESSION['pageName'] = 'employee_everyday_entry';
$user_name        = $_SESSION['username'];
$user_type         = $_SESSION['usertype'];
$is_super_admin      = $_SESSION['is_super_admin'];

$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];
$sucMsg = "";


if (isset($_POST['data_delete_id'])) {
  $id = $_POST['data_delete_id'];

  $sql = "DELETE FROM employeeDayEntryData WHERE id = '$id'";
  $result = $db->delete($sql);
  if ($result) {
    $sucMsg = "Data delete successfully !";
  } else {
    echo "Error: " . $sql . "<br>" . $db->error;
  }
}
?>



<!DOCTYPE html>
<html>

<head>
  <title>কর্মচারী দৈনিক এন্ট্রি</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
  <link rel="stylesheet" href="../css/report.css?v=1.0.0">
  <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <script src="../js/moment-with-locales.js"></script>
  <style type="text/css">
    .dateInput {
      line-height: 22px !important;
    }

    .allowText {
      float: right;
      margin-bottom: 3px;
    }

    .table-border>tbody>tr>td {
      border: 1px solid #ddd !important;
    }

    .table-border>thead>tr>th {
      border: 1px solid #ddd !important;
    }

    .backcircle {
      font-size: 18px;
      position: absolute;
      margin-top: -35px;
    }

    .backcircle a:hover {
      text-decoration: none !important;
    }

    .cenText {
      text-align: center;
    }

    .submitBtn {
      width: 100px;
      float: right;
    }

    /*         .main_bar{
            width: 100% !important;
            margin: 0 auto;
            padding-left: 10px;
            padding-right: 10px;
        } */

    .remove_button {
      margin-top: 0px;
    }

    fieldset.scheduler-border {
      border: 1px groove #ddd !important;
      padding: 0 1.4em 1.4em 1.4em !important;
      margin: 0 0 1.5em 0 !important;
      -webkit-box-shadow: 0px 0px 0px 0px #000;
      box-shadow: 0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
      font-size: 1.2em !important;
      font-weight: bold !important;
      text-align: left !important;
      width: auto;
      padding: 0 10px;
      border-bottom: none;
    }

    #r_address {

      height: 35px;

    }

    .modal {
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      overflow: hidden;
    }

    .modal-dialog {
      position: fixed;
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
    }

    .modal-header {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      border: none;
    }

    .modal-content {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      border-radius: 0;
      box-shadow: none;
    }

    .modal-body {
      position: absolute;
      top: 50px;
      bottom: 0;
      font-size: 15px;
      overflow: auto;
      margin-bottom: 60px;
      padding: 0 15px 0;
      width: 100%;
    }

    .modal-footer {
      position: absolute;
      right: 0;
      bottom: 0;
      left: 0;
      height: 60px;
      padding: 10px;
      background: #f1f3f5;
    }

    .modal-header .close {

      font-size: 35px;
      margin-top: -32px;

    }

    .displayCon {
      padding-top: 0;
    }

    .left_side_bar {
      height: 120vh !important;
    }

    .row.commonrow .form-group {
      padding-left: 2px;
      padding-right: 2px;
    }

    #error_name {
      color: #f90707;

    }

    .error_name {
      color: #f90707;

    }

    .err_naster_bill {
      color: #f90707;
    }

    .err_job_cat {
      color: #f90707;

    }

    .err_taka {
      color: #f90707;

    }

    .main_bar {

      width: calc(86% - 100px) !important;
    }
    #employee_id {
    width: 200px;
}
  </style>

</head>

<body>
  <?php
  include '../navbar/header_text.php';
  $page = 'employee_everyday_entry';
  include '../navbar/navbar.php';
  ?>
  <div class="bar_con">
    <div class="left_side_bar">
      <?php require '../others_page/left_menu_bar_employee.php'; ?>
    </div>
    <div class="main_bar">
    <div class="row" id="back_again" style="margin-top: 5px;">
          <div class="col-md-12">
          <button name="" id="" class="btn btn-success" role="button">Back</button> 

          </div>
        </div>
      
    <div class="row" id="employee_talika">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title ">কর্মচারী নাম তালিকা :</h3>
            </div>
              <div class="list-group">
                <ul class="list-group list-group-flush">
                  <?php 
                           $query_detail = "SELECT * FROM employee_entry WHERE employee_status = '1' AND project_name_id = '$project_name_id' ";
                           $data = $db->select($query_detail);
                           if ($data) {
                               $i = 1;
                               while ($rows = $data->fetch_assoc()) { 
                          ?>
                  <li class="list-group-item">
                    <a data-employeeName="<?php echo  $rows['employee_name']; ?> " data-id="<?php echo $rows['id'] ?>" href="javascript:void(0)" class="list-group-item list-group-item-action employee-name"><?php echo  $rows['employee_name']; ?> </a>
                  </li>

                <?php  } } ?>
                  
                </ul>
            </div>
          </div>


        </div>

      </div> 
  <div id="hidden_div">
      <div id="success">

      </div>




      <!-- Full Height Modal Right -->
      <div class="modal fade top" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
        <div class="modal-dialog modal-full-height modal-top" role="document">


          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal-body">

            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Full Height Modal Right -->




      <form method="POST" id="employeeDeatails_form" name="employeeDeatails_form" style="margin-top:20px ">
        <table class="table table-border table-condensed" id="employeeDeatailsTable">

          <thead>
            <tr>
            <th class="cenText">নাম</th>
              <th class="cenText">শুরুর তারিখ</th>
              <th class="cenText">শেষের তারিখ</th>
             
              <th class="cenText">মোট দিন</th>
              <th class="cenText"> নাস্তা বিল</th>
              <th class="cenText">খাওয়া মিল</th>
              <th class="cenText">দিনের বেতন</th>
              <!-- <th class="cenText">মারফোত</th> -->
              <th class="cenText">বোনাস</th>
              <th class="cenText">নেওয়া জমা</th>
              <!-- <th class="cenText">Add</th>
              <th class="cenText">Remove</th> -->
            </tr>
          </thead>

          <tbody class="table_tbody">
            <input type="hidden" name="id" id="id">
            <tr>
              <div class="row commonrow" row-id="row1">

              <td colspan="" rowspan="" headers="">
                  <!-- <div name="employeeName" id="employeeName" class="employeeName">

                  </div> -->
                  <select disabled class="form-control employeeName employee_id" name="employee_id[]" id="employee_id1" required>
                  </select>
                  <div class="error_name"> </div>
                </td>

                <td colspan="" rowspan="" headers="">
                  <input type="text" data-id="employee_start_date1" readonly  class="form-control employee_start_date datepicker" id="employee_start_date1" name="employee_start_date[]" placeholder="শুরুর তারিখ">

                </td>
                <td colspan="" rowspan="" headers="">
                  <input type="text" data-id="employee_end_date1" onchange="countDay()" class="form-control employee_end_date datepicker" id="employee_end_date1" name="employee_end_date[]" placeholder="শেষের তারিখ">

                </td>
                
                <td colspan="" rowspan="" headers="">

                  <input  type="text" class="form-control totalDay" readonly   data-id="totalDay1" id="totalDay1" name="totalDay[]" readonly placeholder="মোট দিন">
                  <div class="err_month_name"> </div>
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" onkeypress="return isNumber(event)" readonly  name="naster_bill[]" id="naster_bill1" data-id="naster_bill1" class="form-control naster_bill" placeholder="নাস্তা বিল">
                  <div class="err_naster_bill"> </div>
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" onkeypress="return isNumber(event)" readonly  class="form-control khaber_bill" name="khaber_bill[]" id="khaber_bill1" data-id="khaber_bill1" placeholder="খাওয়া মিল">
                  <div class="err_khaber_bill"> </div>
                </td>

                <td colspan="" rowspan="" headers="">

                  <input type="text" onkeypress="return isNumber(event)" readonly  class="form-control diner_beton" name="diner_beton[]" data-id="diner_beton1" id="diner_beton1" placeholder="দিনের বেতন">
                  <div class="err_diner_beton"> </div>

                </td>
                <!-- <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control marphot" name="marphot[]" data-id="marphot1" id="marphot" placeholder="মারফোত">

                </td> -->
                <td colspan="" rowspan="" headers="">

                  <input type="text" onkeypress="return isNumber(event)"  class="form-control bonus" name="bonus[]" data-id="bonus1" id="bonus1" placeholder="বোনাস">

                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" onkeypress="return isNumber(event)"   class="form-control nea_joma" name="nea_joma[]" data-id="nea_joma1" id="nea_joma1" placeholder="নেওয়া জমা">
                </td>
                <!-- <td colspan="" rowspan="" headers="">

                  <button class="btn btn-success add_button" type="button"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>

                </td>
                <td colspan="" rowspan="" headers="">
                  <button class="btn btn-danger disabled" type="button"> <span class="glyphicon glyphicon-minus " aria-hidden="true"></span> </button>
                </td> -->


            </tr>

            <div class="field_wrapper">

            </div>
          </tbody>
    
    </table>
    <div class="row">
      <div class="form-group col-md-12">
        <button  name="submit" id="submit_btn" type="button" class="btn btn-primary pull-right">Submit</button>
      </div>
      <div class="form-group col-md-12">
        <button type="button" name="cancle_emp" id="cancle_emp" class="btn btn-danger pull-right">Cancle</button>
        <button style="margin-right: 10px;" name="updatebtn" id="updatebtn" type="button" class="btn btn-primary pull-right">Update</button>
      </div>
    </div>

    </form>

    <div class="displayCon">
      <h3 style="text-align: center; margin-top: 0px;">প্রতিদিনের হিসাব</h3>

      <table class="table_dis" id="employeeDeatails">
        <thead>
          <tr style="background-color: #b5b5b5;">
            <th class="cenText">নং</th>
            <th class="cenText">নাম</th>
              <th class="cenText">শুরুর তারিখ</th>
              <th class="cenText">শেষের তারিখ</th>
             
              <th class="cenText">মোট দিন</th>
              <th class="cenText"> নাস্তা বিল</th>
              <th class="cenText">খাওয়া মিল</th>
              <th class="cenText">দিনের বেতন</th>
              <!-- <th class="cenText">মারফোত</th> -->
              <th class="cenText">বোনাস</th>
              <th class="cenText">নেওয়া জমা</th>
            <!-- <th class="cenText" style="width: 76px;">view</th> -->
            <th class="cenText" style="width: 76px;">Delete</th>
            <th class="cenText" style="width: 59px;">Edit</th>
          </tr>
        </thead>
        <tbody id="employee_day_wise_data">

        </tbody>


      </table>

    </div>
    </div>                       
  </div>
</div>


  <!-- Modal details view -->





  <?php include '../others_page/delete_permission_modal.php';  ?>

  <script type="text/javascript">
   // datepickerfunction();
   var currentDate = new Date();
var datePickerOptions = {
  "setDate": currentDate,
  dateFormat: 'd/m/yy',
  firstDay: 1,
  changeMonth: true,
  changeYear: true
}
    $(function() {
      $("body").on("click", ".add_button", function() {
        // $('.employeeNameShow:last-child').val($("#employee_id").find('option:selected').text());
        //datepickerfunction();
        currentmonthName();
       
      });
      var count=1;
      for(i=1;i<=count;i++){
        $('body').on('focus','#employee_start_date'+i, function(){
          $(this).datepicker(datePickerOptions);
        });
        $('body').on('focus','#employee_end_date'+i, function(){
          $(this).datepicker(datePickerOptions);
        });


    }
    
    getEmployeeName();

    function getEmployeeName() {

      var action = "employee_name";
      $.ajax({
        url: 'employeeFromData.php',
        type: 'POST',
        // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {
          action: action
        },
        success: function(data, status) {
          $(".employeeName").append(data);
          //alert('message========',data)
          console.log("employeeName data =============", data)
        },
        error: function(xhr, status, error) {
          var errorMessage = xhr.status + ': ' + xhr.statusText
          alert('Error - ' + errorMessage);
        }
      });



    }

    
    var num_ber=1;
    for(i=1;i<=num_ber;i++){
      
    $("#employee_id"+i).change(function(){ 
     // alert();
            var element = $(this).find('option:selected'); 
            var myTag = element.attr("startData");
            var naster_bill = element.attr('naster_bill');
            var khaber_bill = element.attr('khaber_bill');
            var diner_beton = element.attr('diner_beton');

          
            $(this).closest("tr").find('input[name="employee_start_date[]"]').val(myTag);
            $(this).closest("tr").find('input[name="naster_bill[]"]').val(naster_bill);
            $(this).closest("tr").find('input[name="khaber_bill[]"]').val(khaber_bill);
            $(this).closest("tr").find('input[name="diner_beton[]"]').val(diner_beton);

        }); 
    }
        //Click list employee list
          $("#hidden_div").hide();
          $("#back_again").hide();
            $("#employee_talika").show();
            $(document).on('click','.employee-name', function(){
             // alert($(this).data('id'))
             $("#hidden_div").show();
             $("#back_again").show();
             $("#employee_talika").hide();
              $('.employee_id').val($(this).data('id'));
              $(".employee_id").trigger('change');
              //$('.mistree_name_show').val( $(this).data('mistreename'));
      });
      $(document).on('click','#back_again', function(){ 
              $("#back_again").hide();
              $("#hidden_div").hide();
              $("#employee_talika").show();

            });

   });

    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var d = new Date();
    var monthName = monthNames[d.getMonth()];
    $(".month_name").val(monthName);
    currentmonthName();

    function currentmonthName() {
      $(".month_name_show").val(monthName);
    }


    function delete_row(ele) {
      var data_row_id = $(ele).attr('data_row_id');
      $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
      $("#matchPassword").val('');
      $("#passMsg").html('');
      $("#verifyToDeleteBtn").attr("data_row_id", data_row_id);
    }
    $(document).on('click', '#verifyToDeleteBtn', function() {
      delete_vaucher_credit_data($(this).attr("data_row_id"));
    });

    function delete_vaucher_credit_data(data_row_id) {
      console.log(data_row_id);
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
            $('#sucMsg').html('');
            $("#verifyPasswordModal").hide();
            ConfirmDialog('Are you sure to delete entry ?', data_row_id);
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

      function ConfirmDialog(message, data_row_id) {
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
                $.post("employeeDayEntryData.php", {
                  data_delete_id: data_row_id
                }, function(data, status) {
                  console.log(status);
                  console.log(data);
                  if (status == 'success') {
                    // $('#sucMsg').html('succsess');
                    window.location.href = 'employee_day_entry.php';
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
      }
    }

    function display_update(ele) {
      console.log(ele);
      var data_row_id = $(ele).attr('data_row_id');
      var row_date = $(ele).closest('tr').find('td:eq(1)').text();
      var row_name = $(ele).closest('tr').find('td:eq(2)').text();
      var data_row_amount = $(ele).attr('data_row_amount');

      $('#sucMsg').html('');
      $('#data_row_id').val(data_row_id);
      $('#submitBtnId').val('Update');
      $('#r_date1').val(row_date);
      $('#credit_name1').val(row_name);
      $('#credit_amount1').val(data_row_amount);
      $('#add').attr('disabled', '');
      $('html, body').animate({
        scrollTop: 0
      }, 600);
    }
  </script>
  <script type="text/javascript" id="script-1">
    if ($('.main_bar').innerHeight() > $('.left_side_bar').height()) {
      $('.left_side_bar').height($('.main_bar').innerHeight() + 34);
    } else {
      $('.left_side_bar').height(640);
    }

    function heightChange() {
      var left_side_bar_height = $('.left_side_bar').height();
      var main_bar_height = $('.main_bar').innerHeight();
      if (left_side_bar_height >= main_bar_height) {
        // $('.left_side_bar').height(main_bar_height + 25);          
      } else {
        $('.left_side_bar').height(main_bar_height + 25);
      }
    }
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

      var x = 2;

      var maxField = 10; //Input fields increment limitation
      var addButton = $('.add_button'); //Add button selector
      var wrapper = $('.table_tbody'); //Input field wrapper

      var fieldHTML = '<tr row-id="row' + x + '">'

      fieldHTML += '<td>'
     // fieldHTML += '<div name="employeeName" id="employeeName' + x + '" class="employeeName"></div>'
      fieldHTML += '<select class="form-control employeeName" name="employee_id[]" id="employee_id' + x + '" required></select>'
                  
      fieldHTML += '</td>'

      fieldHTML += '<td>'
      //  fieldHTML +=  '<label for="r_date">তারিখ</label>'                    
      fieldHTML += '<input type="text" class="form-control employee_start_date datepicker "  data-id="employee_start_date' + x + '" id="employee_start_date' + x + '" name="employee_start_date[]" placeholder="শুরুর তারিখ">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      //  fieldHTML +=  '<label for="r_date">তারিখ</label>'                     
      fieldHTML += '<input type="text" class="form-control employee_end_date datepicker " onchange="countDay()" data-id="employee_end_date' + x + '" id="employee_end_date' + x + '" name="employee_end_date[]" placeholder="শেষের তারিখ">'
      fieldHTML += '</td>'


      fieldHTML += '<td>'

      // fieldHTML +=  '<label for="r_job_cat">বাক্তির ধরণ</label>'    
      fieldHTML += '<input readonly type="text" class="form-control totalDay" data-id="totalDay' + x + '" id="totalDay' + x + '" name="totalDay" placeholder="মোট দিন">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      // fieldHTML +=   '<label for="r_taka">দর</label>'
      fieldHTML += '<input type="text" onkeypress="return isNumber(event)" name="naster_bill[]" data-id="naster_bill' + x + '" id="naster_bill' + x + '" class="form-control naster_bill" " placeholder="নাস্তা বিল" >'

      fieldHTML += '</td>'
      fieldHTML += '<td >'
      //  fieldHTML +=   '<label for="r_person">জন</label>'
      fieldHTML += '<input type="text" onkeypress="return isNumber(event)" class="form-control khaber_bill" data-id="khaber_bill' + x + '" name="khaber_bill[]" id="khaber_bill' + x + '"  placeholder="খাওয়া মিল">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      //  fieldHTML +=   '<label for="r_totalbill">কাজের বিল</label>'
      fieldHTML += '<input type="text" onkeypress="return isNumber(event)" class="form-control diner_beton" data-id="diner_beton' + x + '"  name="diner_beton[]" id="diner_beton' + x + '" placeholder="দিনের বেতন" >'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      // fieldHTML +=   '<label for="r_credit">নগদ জমা</label>'
      fieldHTML += '<input type="text" class="form-control marphot" name="marphot[]" id="marphot"  data-id="marphot' + x + '"  placeholder="মারফোত" >'
      fieldHTML += '</td>'
      fieldHTML += '<td>'

      // fieldHTML +=   '<label for="r_paowna">পাওনা</label>'
      fieldHTML += '<input type="text" onkeypress="return isNumber(event)" class="form-control bonus" data-id="bonus' + x + '" name="bonus[]" id="bonus' + x + '"  placeholder="বোনাস">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      // fieldHTML +=   '<label for="r_paowna">পাওনা</label>'
      fieldHTML += '<input type="text" onkeypress="return isNumber(event)" class="form-control nea_joma" data-id="nea_joma' + x + '" name="nea_joma[]" id="nea_joma' + x + '"  placeholder="নেওয়া জমা">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      fieldHTML += '<button class="btn btn-success add_button disabled" type="button" > <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      fieldHTML += '<button class="btn btn-danger remove_button" type="button"> <span class="glyphicon glyphicon-minus " aria-hidden="true"></span> </button>'
      fieldHTML += '</td>'

      fieldHTML += '</tr>';

     // datepickerfunction();
     $('body').on('focus','#employee_start_date'+x, function(){
          $(this).datepicker(datePickerOptions);
        });
        $('body').on('focus','#employee_end_date'+x, function(){
          $(this).datepicker(datePickerOptions);
        });

        
        // $('body').on('focus','#employee_start_date'+x, function(){
        //   $(this).datepicker(datePickerOptions);
        // });
        // $('body').on('focus','#employee_end_date'+x, function(){
        //   $(this).datepicker(datePickerOptions);
        // });

       // $("#employee_id"+i).change(function(){
          

       

      $(addButton).click(function() {

       // datepickerfunction();
        currentmonthName();
        getEmployeeName();


        if (x < maxField) {
        $('body').on('focus','#employee_start_date'+x, function(){
          $(this).datepicker(datePickerOptions);
        });
        $('body').on('focus','#employee_end_date'+x, function(){
          $(this).datepicker(datePickerOptions);
        });

          $('body').on('change', "#employee_id"+x, function () {
        // alert("some thing");
            var element = $(this).find('option:selected'); 
            var myTag = element.attr("startData");
            var naster_bill = element.attr('naster_bill');
            var khaber_bill = element.attr('khaber_bill');
            var diner_beton = element.attr('diner_beton');
          
            $(this).closest("tr").find('.employee_start_date').val(myTag);
            $(this).closest("tr").find('.naster_bill').val(naster_bill);
            $(this).closest("tr").find('.khaber_bill').val(khaber_bill);
            $(this).closest("tr").find('.diner_beton').val(diner_beton);

        }); 
         

        x++;
           //Increment field counter
          $(wrapper).append(fieldHTML); //Add field html
        }
       
      });


      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();

        //datepickerfunction();
        $(this).closest('tr').remove(); //Remove field html
        x--; //Decrement field counter
      });

    });


    getAllEmployeeDayData();

    function getAllEmployeeDayData() {

      var action = "all_data";
      $.ajax({
        url: 'employeeFromData.php',
        type: 'POST',
        data: {
          action: action
        },
        success: function(response, status) {
          $("#employee_day_wise_data").html(response);

          console.log("datass =============", response)
        },
        error: function(xhr, status, error) {
          var errorMessage = xhr.status + ': ' + xhr.statusText
          alert('Error - ' + errorMessage);
        }
      });



    }
    // var employee_id = $(".employeeName option:selected" ).val();
    // $('.employeeName').change(function(){

    //       alert($('.employeeName').find('option:selected').val());

    //     });
    //=================== Insert employee details==================================

    function isNumber(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        alert("Should be enter a number value");
        return false;
      }
      return true;
    }
    $('#submit_btn').on('click', function(e) {
      //alert($(".month_name").val());
      $('select[name="employee_id[]"]').prop('disabled', false);
      var employee_id = $('.employeeName').find('option:selected').val();
      var naster_bill = $(".naster_bill").val();
      var khaber_bill = $(".khaber_bill").val();
      var diner_beton = $(".diner_beton").val();
      // function validate() {


      if (employee_id == "") {
        $('.error_name').html("Please fill the field")
        // document.employeeDeatails_form.employee_id.focus() ;
        return false;
      }
      if (naster_bill == "") {
        $('.err_naster_bill').html("Please fill the field")
        document.employeeDeatails_form.naster_bill.focus();
        return false;
      }
      if (khaber_bill == "") {
        $('.err_khaber_bill').html("Please fill the field")
        document.employeeDeatails_form.khaber_bill.focus();
        return false;
      }
      if (diner_beton == "") {
        $('.err_diner_beton').html("Please fill the field")
        document.employeeDeatails_form.diner_beton.focus();
        return false;
      }

      var action = "insert";
      var fdata = $('form#employeeDeatails_form').serialize();
      $.ajax({
        url: "employeeFromData.php",
        type: "POST",
        data: fdata,
        dataType: "JSON",
        success: function(data) {
          console.log("from data insert ==========", data)

          //$('#success').html('Data added successfully !'); 
          if (data) {
            alert("Data added successfully !");
            $('#employeeDeatails_form')[0].reset();
            $('select[name="employee_id[]"]').prop('disabled', true);
            getAllEmployeeDayData();

          }

        },
        error: function(data) {
          console.log('Error - ' + data);

        }

      });

    });


    $('#submit_btn').show();
    $('#updatebtn').hide();
    $('#cancle_emp').hide();
    $(document).on('click', '#cancle_emp', function() {
      $('#employeeDeatails_form')[0].reset();
      $('#submit_btn').show();
      $('#updatebtn').hide();
      $('#cancle_emp').hide();
      location.reload();

    });

    $(document).on('click', '.edit_employee', function() {
      $('#submit_btn').hide();
      $('#updatebtn').show();
      $('#cancle_emp').show();

      var id = $(this).attr('id');
      //alert(id);
      //return;
      var action = 'edit_day_data';
      var mydata = {
        id: id,
        action: action
      };

      // '#r_hedmistress option[value="' + data.hedmistress_name + '"]'
      $.ajax({
        url: "employeeFromData.php",
        type: "POST",
        dataType: "JSON",
        data: mydata,

        success: function(data) {
          console.log("editdata==========", data);
          $('#id').val(data.id);
          $('.employee_id').val(data.employee_id);
          $('.employee_start_date').val(data.employee_start_date);
          $('.employee_end_date').val(data.employee_end_date);
          $('.totalDay').val(data.totalDay);
          $('.naster_bill').val(data.total_naster_bill);
          $('.khaber_bill').val(data.total_khaber_bill);
          $('.diner_beton').val(data.total_diner_beton);
          $('.bonus').val(data.bonus);
          $('.nea_joma').val(data.nea_joma);

          //$('#id').val(data.id);
          //console.log(data);

        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });

    });


    $('#updatebtn').on('click', function() {

      //var id = $(this).attr("id");
      var id = $('#id').val();
      var employee_id = $('.employeeName').find('option:selected').val();
      var employee_start_date = $('.employee_start_date').val();
      var employee_end_date = $('.employee_end_date').val();
      var totalDay = $('.totalDay').val();
      var total_naster_bill = $('.naster_bill').val();
      var total_khaber_bill = $('.khaber_bill').val();
      var total_diner_beton = $('.diner_beton').val();
      var bonus = $('.bonus').val();
      var nea_joma = $('.nea_joma').val();
      var action = "update_day_data";
      
      var formData = new FormData($('#employeeDeatails_form')[0]);
      formData.append("id", id);
      formData.append("employee_id", employee_id);
      formData.append("employee_start_date", employee_start_date);
      formData.append("employee_end_date", employee_end_date);
      formData.append("totalDay", totalDay);
      formData.append("total_naster_bill", total_naster_bill);
      formData.append("total_khaber_bill", total_khaber_bill);
      formData.append("total_diner_beton", total_diner_beton);
      formData.append("bonus", bonus);
      formData.append("nea_joma", nea_joma);
      formData.append("action", action);


      $.ajax({
        url: 'employeeDayEntryData.php',
        type: 'POST',
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
          if(data){

            alert("Data updated successfully");
          }
          getAllEmployeeDayData();
          $('#submit_btn').show();
          $('#updatebtn').hide();
          $('#cancle_emp').hide();
          $('#employeeDeatails_form')[0].reset();
         
        },
        error: function(error) {
          console.log('Error - ' + error);

        }
      });
    });




 countDay();
    function countDay(){
      $('tr').each(function() {

        if ($(".employee_end_date").val() == 0 && $(".employee_end_date").val() == '') {
          $(".totalDay").val(0);
          $(".naster_bill").val(0);
          $(".khaber_bill").val(0);
          $(".diner_beton").val(0);
         
          }

          
        var employee_start_date =$(this).find(".employee_start_date").val();
        //alert(employee_start_date);
        var employee_end_date = $(this).find(".employee_end_date").val(); 
       // console.log(employee_end_date); 
        var startDate = moment(employee_start_date, "DD/MM/YYYY");
        var endDate = moment(employee_end_date, "DD/MM/YYYY");
        var result = endDate.diff(startDate, 'days');
        var totalDay= parseInt($(this).find(".totalDay").val(result));

          var element = $(this).find('.employee_id option:selected'); 
          var attr_nasterbill = element.attr('naster_bill');
          var attr_khaber_bill = element.attr('khaber_bill');
          var attr_diner_beton = element.attr('diner_beton');
        console.log("attr_nasterbill==", attr_nasterbill);

        var totalDayval = parseInt($(this).find(".totalDay").val());

        var totnaster_bill = attr_nasterbill * totalDayval;
       $(this).find(".naster_bill").val(totnaster_bill);

       var totkhaber_bill = attr_khaber_bill * totalDayval;
       var nn = totkhaber_bill.toFixed(2);
      $(this).find(".khaber_bill").val(nn);

         var totdiner_beton = attr_diner_beton * totalDayval;
         var n = totdiner_beton.toFixed(2);
       $(this).find(".diner_beton").val(n);
        

      });
  }

  
  

  </script>

  <script src="../js/common_js.js"></script>
</body>

</html>