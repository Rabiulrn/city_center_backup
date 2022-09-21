<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$_SESSION['pageName'] = 'electric_day_hisab';
$user_name        = $_SESSION['username'];
$user_type         = $_SESSION['usertype'];
$is_super_admin      = $_SESSION['is_super_admin'];

$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];
$sucMsg = "";


if (isset($_POST['data_delete_id'])) {
  $id = $_POST['data_delete_id'];

  $sql = "DELETE FROM raj_kajerhisab WHERE id = '$id'";
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
  <title>রাজ কাজের হিসাব</title>
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

    .err_job_cat {
      color: #f90707;

    }

.err_taka {
      color: #f90707;

    }

.main_bar {
      width: calc(89% - 100px) !important;
    }

.form-control {

      padding: 5px 5px;
    }

.left_side_bar {

      width: 15% !important;
      margin-right: 15px !important;

    }

.error {
      color: #f90707;
    }
#updatebtn {
    margin-right: 10px;
}
  </style>

</head>

<body>
  <?php
  include '../navbar/header_text.php';
  $page = 'electric_day_hisab';
  include '../navbar/navbar.php';
  ?>
  <div class="bar_con">
    <div class="left_side_bar">
      <?php require '../others_page/left_menu_electric_kroy_bikroy_hisab.php'; ?>
    </div>
    <div class="main_bar">

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




      <form method="POST" id="InsertForm" name="InsertForm" style="margin-top:20px ">
        <table class="table table-border table-condensed" id="FormTable">
          <input type="hidden" name="id" id="id">
          <thead>
            <tr>
              
              <th class="cenText">তারিখ</th>
              <th class="cenText">সাপ্লায়ার নাম</th>
              <th class="cenText">গাড়ী নাম্বার</th>
              <th class="cenText">ভাড়া ও খালাস</th>
              <th class="cenText">ভাউচার নং</th>
              <th class="cenText">মালের বিবরণ</th>
              <th class="cenText">জমা</th>
              <th class="cenText">দর</th>

              <th class="cenText">পরিমান‌</th>
              <th class="cenText">মূল্য</th>
              <th class="cenText">কমিসন</th>
              <th class="cenText">মোট মূল্য</th>
              <th class="cenText">অবশিষ্ট</th>
              <th class="cenText">মোট অবশিষ্ট</th>
              <th class="cenText">Add</th>
              <th class="cenText">Remove</th>
            </tr>
          </thead>

          <tbody class="table_tbody">

            <tr>
              <div class="row commonrow" row-id="row1">
                <td colspan="" rowspan="" headers="">
                  <input type="text" class="form-control e_date" id="e_date" name="e_date[]" placeholder="তারিখ">

                </td>
                <td colspan="" rowspan="" headers="">
                  <div class="suplierName">

                  </div>
                  <div id="error_name"> </div>
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control gari_number" data-id="gari_number1" id="gari_number" name="gari_number[]" placeholder="গাড়ী নাম্বার">
                  <div class="err_gari_number"> </div>
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" name="vara_khalas[]" id="vara_khalas" onkeyup="update_amounts()" data-id="vara_khalas1" class="form-control vara_khalas" placeholder="ভাড়া ও খালাস">
                  <div class="err_vara_khalas"> </div>
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control vaucher_number" name="vaucher_number[]" id="vaucher_number" data-id="vaucher_number1" placeholder="ভাউচার নং">
                  <div class="err_vaucher_number"> </div>
                </td>

                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control maler_biboron" name="maler_biboron[]" data-id="maler_biboron1" id="maler_biboron" placeholder="মালের বিবরণ">
                  <div class="err_maler_biboron"></div>
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control jometaka" onkeyup="update_amounts()" name="jometaka[]" data-id="jometaka1" id="jometaka" placeholder="জমা">
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control maler_dor" name="maler_dor[]" onkeyup="update_amounts()" data-id="maler_dor1" id="maler_dor" placeholder="দর">
                  <div class="err_maler_dor"></div>
                </td>

                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control maler_poriman" name="maler_poriman[]" onkeyup="update_amounts()" data-id="maler_poriman1" id="maler_poriman" placeholder="পরিমান‌">
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control maler_mullo" name="maler_mullo[]" onkeyup="update_amounts()" data-id="maler_mullo1" id="maler_mullo" readonly placeholder="মালের মূল্য">
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control commission" name="commission[]" onkeyup="update_amounts()" data-id="commission1" id="commission" placeholder="কমিসন">
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control maler_mot_mullo" name="maler_mot_mullo[]" onkeyup="update_amounts()" data-id="maler_mot_mullo1" readonly id="maler_mot_mullo" placeholder="মোট মূল্য">
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control abosistho" name="abosistho[]" onkeyup="update_amounts()" data-id="abosistho1" id="abosistho" readonly placeholder="অবশিষ্ট">
                </td>
                <td colspan="" rowspan="" headers="">

                  <input type="text" class="form-control mot_abosistho" name="mot_abosistho[]" onkeyup="update_amounts()" data-id="mot_abosistho1" id="mot_abosistho" readonly placeholder="মোট অবশিষ্ট">
                </td>

                <td colspan="" rowspan="" headers="">

                  <button class="btn btn-success add_button" type="button"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>

                </td>
                <td colspan="" rowspan="" headers="">
                  <button class="btn btn-danger disabled" type="button"> <span class="glyphicon glyphicon-minus " aria-hidden="true"></span> </button>
                </td>


            </tr>

            <div class="field_wrapper">

            </div>
          </tbody>
    </div>
    </table>
    <div class="row">
      <div class="form-group col-md-12">
        <button name="submit" name="submit" id="submit_btn" type="button" class="btn btn-primary pull-right">Submit</button>
      </div>
      <div class="form-group col-md-12">
      <button type="button" name="cancle_emp" id="cancle_emp" class="btn btn-danger pull-right">Cancle</button>
        <button name="updatebtn" id="updatebtn" type="button" class="btn btn-primary pull-right">Update</button>
      </div>
    </div>

    </form>

    <div class="displayCon">
      <h3 style="text-align: center; margin-top: 0px;">মালের হিসাব</h3>

      <table class="table_dis">
        <thead>
          <tr style="background-color: #b5b5b5;">
            <th class="cenText">নং</th>
            <th class="cenText">তারিখ</th>
            <th class="cenText">সাপ্লায়ার নাম</th>
            <th class="cenText">গাড়ী নাম্বার</th>
            <th class="cenText">ভাড়া ও খালাস</th>
            <th class="cenText">ভাউচার নং</th>
            <th class="cenText">মালের বিবরণ</th>
            <th class="cenText">জমাঃ</th>
            <th class="cenText">দর</th>
            <th class="cenText">পরিমান‌</th>
            <th class="cenText">মূল্য</th>
            <th class="cenText">কমিসন</th>
            <th class="cenText">মোট মূল্য</th>
            <th class="cenText">অবশিষ্ট</th>
            <th class="cenText">মোট অবশিষ্ট</th>
            <th class="cenText" style="width: 76px;">Delete</th>
            <th class="cenText" style="width: 59px;">Edit</th>
          </tr>



        </thead>
        <tbody id="alldata_area">

        </tbody>


      </table>

    </div>

  </div>
  </div>


  <!-- Modal details view -->





  <?php include '../others_page/delete_permission_modal.php';  ?>

  <script type="text/javascript">
    datepickerfunction();
    $(function() {
      $("body").on("click", ".add_button", function() {
        $('.name_show:last-child').val($(".suplier_name").find('option:selected').text());
        datepickerfunction();
      });
    });

    function datepickerfunction() {
      $('.e_date').datepicker({
        onSelect: function(date) {
          // alert(date);
          $(this).change();
        },
        dateFormat: "dd/mm/yy",
        changeYear: true,
      }).datepicker("setDate", new Date());
    }

    $(document).on('change', '.suplier_name', function() {

      $('.name_show').val($(this).find('option:selected').text());
    });

    // var $option = $('.r_hedmistress').val();
    // var value = $option.val();
    // $(".mistree").val(value);
    // console.log("value ==========",value);
    // var text = $option.text();


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
            ConfirmDialog('Are you sure to delete joma khat entry ?', data_row_id);
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
                $.post("electricDailyHisabUpdataData.php", {
                  data_delete_id: data_row_id
                }, function(data, status) {
                  console.log(status);
                  console.log(data);
                  if (status == 'success') {
                    // $('#sucMsg').html('succsess');
                    window.location.href = 'electric_day_hisab.php';
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
      datepickerfunction();

      var x = 2;
      var maxField = 10; //Input fields increment limitation
      var addButton = $('.add_button'); //Add button selector
      var wrapper = $('.table_tbody'); //Input field wrapper

      var fieldHTML = '<tr row-id="row' + x + '">'

      fieldHTML += '<td>'
      //  fieldHTML +=  '<label for="r_date">তারিখ</label>'                    
      fieldHTML += '<input type="text" class="form-control e_date" data-id="e_date' + x + '" id="e_date" name="e_date[]" placeholder="তারিখ">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      //  fieldHTML +=  '<label for="r_date">তারিখ</label>'                    
      fieldHTML += '<input type="text" name="suplier_id" id="suplier_id" class="form-control name_show">'
      fieldHTML += '</td>'



      fieldHTML += '<td>'
      // fieldHTML +=  '<label for="r_job_cat">বাক্তির ধরণ</label>'    
      fieldHTML += '<input type="text" class="form-control" data-id="gari_number' + x + '" id="gari_number" name="gari_number[]" placeholder="গাড়ী নাম্বার">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      // fieldHTML +=   '<label for="r_taka">দর</label>'
      fieldHTML += '<input type="text" name="vara_khalas[]" onkeyup="update_amounts()" data-id="vara_khalas' + x + '" id="vara_khalas" class="form-control vara_khalas"  placeholder="ভাড়া ও খালাস" >'

      fieldHTML += '</td>'
      fieldHTML += '<td >'
      //  fieldHTML +=   '<label for="r_person">জন</label>'
      fieldHTML += '<input type="text" class="form-control vaucher_number" data-id="vaucher_number' + x + '" name="vaucher_number[]" id="r_person"  placeholder="ভাউচার নং">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      //  fieldHTML +=   '<label for="r_totalbill">কাজের বিল</label>'
      fieldHTML += '<input type="text" class="form-control maler_biboron"  data-id="maler_biboron' + x + '"  name="maler_biboron[]" id="maler_biboron" placeholder="মালের বিবরণ" >'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      // fieldHTML +=   '<label for="r_credit">নগদ জমা</label>'
      fieldHTML += '<input type="text" class="form-control jometaka" onkeyup="update_amounts()" name="jometaka[]" id="jometaka"  data-id="jometaka' + x + '"  placeholder="জমা">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      // fieldHTML +=   '<label for="r_credit">নগদ জমা</label>'
      fieldHTML += ' <input type="text" class="form-control maler_dor" onkeyup="update_amounts()" name="maler_dor[]" data-id="maler_dor' + x + '" id="maler_dor" placeholder="দর">'
      fieldHTML += '</td>'


      fieldHTML += '<td>'

      // fieldHTML +=   '<label for="r_paowna">পাওনা</label>'
      fieldHTML += '<input type="text" class="form-control maler_poriman" onkeyup="update_amounts()" data-id="maler_poriman' + x + '" name="maler_poriman[]" id="maler_poriman"  placeholder="পরিমান‌">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'

      // fieldHTML +=   '<label for="r_paowna">পাওনা</label>'
      fieldHTML += ' <input type="text" class="form-control maler_mullo" onkeyup="update_amounts()" name="maler_mullo[]" data-id="maler_mullo' + x + '" id="maler_mullo" readonly placeholder="মালের মূল্য">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'

      // fieldHTML +=   '<label for="r_paowna">পাওনা</label>'
      fieldHTML += '<input type="text" class="form-control commission" onkeyup="update_amounts()" name="commission[]" data-id="commission' + x + '" id="commission" placeholder="কমিসন">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'

      // fieldHTML +=   '<label for="r_paowna">পাওনা</label>'
      fieldHTML += '<input type="text" class="form-control maler_mot_mullo" onkeyup="update_amounts()"  name="maler_mot_mullo[]" data-id="maler_mot_mullo' + x + '" id="maler_mot_mullo" readonly placeholder="মোট মূল্য">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'

      // fieldHTML +=   '<label for="r_paowna">পাওনা</label>'
      fieldHTML += '<input type="text" class="form-control abosistho" onkeyup="update_amounts()" name="abosistho[]" data-id="abosistho' + x + '" id="abosistho" readonly placeholder="অবশিষ্ট">'
      fieldHTML += '</td>'
      fieldHTML += '<td>'

      // fieldHTML +=   '<label for="r_paowna">পাওনা</label>'
      fieldHTML += '<input type="text" class="form-control mot_abosistho" onkeyup="update_amounts()" name="mot_abosistho[]" data-id="mot_abosistho' + x + '" id="mot_abosistho" readonly placeholder="মোট অবশিষ্ট">'
      fieldHTML += '</td>'

      fieldHTML += '<td>'
      fieldHTML += '<button class="btn btn-success add_button disabled" type="button" > <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>'
      fieldHTML += '</td>'
      fieldHTML += '<td>'
      fieldHTML += '<button class="btn btn-danger remove_button" type="button"> <span class="glyphicon glyphicon-minus " aria-hidden="true"></span> </button>'
      fieldHTML += '</td>'

      fieldHTML += '</tr>';

      datepickerfunction();

      $(addButton).click(function() {

        datepickerfunction();

        if (x < maxField) {
          x++; //Increment field counter
          $(wrapper).append(fieldHTML); //Add field html
        }
      });

      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();

        datepickerfunction();
        $(this).closest('tr').remove(); //Remove field html
        x--; //Decrement field counter
      });

    });


    getSuplierName();

    function getSuplierName() {

      var action = "getsuplier";
      $.ajax({
        url: 'electricSuplierFromData.php',
        type: 'POST',
        // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {
          action: action
        },
        success: function(data, status) {
          $(".suplierName").html(data);
          //alert('message========',data)
          console.log("data =============", data)
        },
        error: function(xhr, status, error) {
          var errorMessage = xhr.status + ': ' + xhr.statusText
          alert('Error - ' + errorMessage);
        }
      });



    }

getAlldata();

function getAlldata() {

  var action = "getall_data";
  $.ajax({
    url: 'electricDailyHisabData.php',
    type: 'POST',
    data: {
      action: action
    },
    success: function(response, status) {
      $("#alldata_area").html(response);

      console.log("datass =============", response)
    },
    error: function(data) {
      //  var errorMessage = xhr.status + ': ' + xhr.statusText
      alert('Error - ' + data);
    }
  });

}



    //============== Electric daily hisab data inserted
  

      $(".vara_khalas").keypress(function(e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          //display error message
          alert('Should be a number');
          return false;
        }
      });
      $(".jometaka").keypress(function(e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          //display error message
          alert('Should be a number');
          return false;
        }
      });
      $(".maler_dor").keypress(function(e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          //display error message
          alert('Should be a number');
          return false;
        }
      });
      $(".maler_poriman").keypress(function(e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          //display error message
          alert('Should be a number');
          return false;
        }
      });
      $(".commission").keypress(function(e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
          //display error message
          alert('Should be a number');
          return false;
        }
      });

      

      
    

    $('#submit_btn').on('click', function(e) {

      //var suplier_id = $('.suplier_name').find('option:selected').val();
     // var suplier_id = document.forms["InsertForm"]["suplier_id"].value;
     
      var suplier_id =$(".suplier_id").find('option:selected').val();
      var gari_number = $(".gari_number").val();
      var vara_khalas = $(".vara_khalas").val();
      var vaucher_number = $(".vaucher_number").val();
      var maler_biboron = $(".maler_biboron").val();
      var jometaka = $(".jometaka").val();
      var maler_dor = $(".maler_dor").val();
      var maler_poriman = $(".maler_poriman").val();
      var maler_mullo = $(".maler_mullo").val();
      var commission = $(".commission").val();
      var maler_mot_mullo = $(".maler_mot_mullo").val();
      var abosistho = $(".abosistho").val();
      var mot_abosistho = $(".mot_abosistho").val();


      if (suplier_id.length < 1) {
        document.getElementById('error_name').innerHTML = "Required";
        //return;
      }
      if (vaucher_number == '') {
        $('.err_vaucher_number').html('<div class="error">Required</div>');
        return false;
      }
      if (maler_biboron == '') {
        $('.err_maler_biboron').html('<div class="error">Required</div>');
        return false;
      }
      if (maler_dor == '') {
        $('.err_maler_dor').html('<div class="error"> Required</div>');
        return false;
      }
      if (maler_poriman == '') {
        $('.err_maler_poriman').html('<div class="error"> Required</div>');
        return false;
      }
      var fdata = $('form#InsertForm').serialize();
      $.ajax({
        url: "electricDailyHisabData.php",
        type: "POST",
        data: fdata,
        success: function(data) {
          console.log("from data insert ==========", data)

          //$('#success').html('Data added successfully !'); 
          if (data) {
            alert("Data added successfully !");
            $('#InsertForm')[0].reset();
            getAlldata();

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
      $('#InsertForm')[0].reset();
      $('#submit_btn').show();
      $('#updatebtn').hide();
      $('#cancle_emp').hide();
      location.reload();

    });

    $(document).on('click', '.edit_data', function() {

      var id = $(this).attr('id');
      //alert(id);
      var action = 'single_edit';
      var mydata = {
        id: id,
        action: action
      };

      $.ajax({
        url: "electricDailyHisabData.php",
        type: "POST",
        dataType: "JSON",
        data: mydata,

        success: function(data) {
          // console.log("editdata==========",data);
          $('#id').val(data.id);
          $('#e_date').val(data.e_date);
          $('#suplier_id').val(data.suplier_id);
          $('#gari_number').val(data.gari_number);
          $('#vara_khalas').val(data.vara_khalas);
          $('#vaucher_number').val(data.vaucher_number);
          $('#maler_biboron').val(data.maler_biboron);
          $('#jometaka').val(data.jometaka);
          $('#maler_dor').val(data.maler_dor);
          $('#maler_poriman').val(data.maler_poriman);
          $('#maler_mullo').val(data.maler_mullo);
          $('#commission').val(data.commission);
          $('#maler_mot_mullo').val(data.maler_mot_mullo);
          $('#abosistho').val(data.abosistho);
          $('#mot_abosistho').val(data.mot_abosistho);

          $('#submit_btn').hide();
          $('#updatebtn').show();
          $('#cancle_emp').show();
          //$('#id').val(data.id);
         // console.log(data);

        },
        error: function(jqXHR, textStatus, errorThrown) {
         // console.log(textStatus, errorThrown);
        }
      });

    });


    $('#updatebtn').on('click', function() {


      //var id = $(this).attr("id");
      var id = $('#id').val();
  
      var e_date = $('.e_date').val();
      //alert(e_date);
      var suplier_id = $(".suplier_id").find('option:selected').val();
      var gari_number = $(".gari_number").val();
      var vara_khalas = $(".vara_khalas").val();
      var vaucher_number = $(".vaucher_number").val();
      var maler_biboron = $(".maler_biboron").val();
      var jometaka = $(".jometaka").val();
      var maler_dor = $(".maler_dor").val();
      var maler_poriman = $(".maler_poriman").val();
      var maler_mullo = $(".maler_mullo").val();
      var commission = $(".commission").val();
      var maler_mot_mullo = $(".maler_mot_mullo").val();
      var abosistho = $(".abosistho").val();
      var mot_abosistho = $(".mot_abosistho").val();
      var action = "updateData";


      $.ajax({
        url: 'electricDailyHisabUpdataData.php',
        type: 'POST',
        data: {
          id: id,
          e_date: e_date,
          suplier_id: suplier_id,
          gari_number: gari_number,
          vara_khalas: vara_khalas,
          vaucher_number: vaucher_number,
          maler_biboron: maler_biboron,
          jometaka:jometaka,
          maler_dor: maler_dor,
          maler_poriman: maler_poriman,
          maler_mullo: maler_mullo,
          commission: commission,
          maler_mot_mullo: maler_mot_mullo,
          abosistho: abosistho,
          mot_abosistho: mot_abosistho,
          action: action

        },
        success: function(data) {
          console.log(data);

          alert("Successfully Updated!");
          $('#InsertForm')[0].reset();
          $('#submit_btn').show();
          $('#updatebtn').hide();
          $('#cancle_emp').hide();
          getAlldata();

        },
        error: function(data) {
          console.log('Error - ' + data);

        }
      });
    });




    update_amounts();

    function update_amounts() {

      $('tr').each(function() {

        if ($(".maler_dor").val() == 0 && $(".maler_dor").val() == '') {

          $(".maler_mullo").val(0);
          $('.mot_abosistho').val(0);
          $('.abosistho').val(0)
        }

        if ($(".maler_poriman").val() == 0 && $(".maler_poriman").val() == '') {

          $(".maler_mullo").val(0);
          $('.mot_abosistho').val(0);
          $('.abosistho').val(0)
        }

        if ($(".maler_dor").val() == 0 && $(".maler_dor").val() == '') {

          $(".maler_mot_mullo").val(0);
          $('.mot_abosistho').val(0);
          $('.abosistho').val(0)
        }
        if ($(".maler_poriman").val() == 0 && $(".maler_poriman").val() == '') {
          $(".maler_mot_mullo").val(0);
          $('.mot_abosistho').val(0);
          $('.abosistho').val(0)
        }
        if ($(".commission").val() == 0 && $(".commission").val() == '') {
          $(".maler_mot_mullo").val(0);
          $('.mot_abosistho').val(0);
          $('.abosistho').val(0)
        }
        


        var maler_dor = parseFloat($(this).find('.maler_dor').val());
        var maler_poriman = parseFloat($(this).find('.maler_poriman').val());
        var amount = maler_dor * maler_poriman;

        var maler_mullo = $(this).find('.maler_mullo').val(amount);
        var maler_mot_mullo = $(this).find('.maler_mot_mullo').val(amount);
        var commission = parseFloat( $(this).find('.commission').val());
        var jometaka =  parseFloat($(this).find('.jometaka').val());
        var vara_khalas =  parseFloat($(this).find('.vara_khalas').val());
        var maler_mot_mullo_n =   parseFloat($(this).find('.maler_mullo').val());
        //alert(maler_mot_mullo_n);

        var abosisthoAmmout = maler_mot_mullo_n - commission ;
        var abosisthoAmmouttot = abosisthoAmmout - jometaka ;
        var mot_abosisthoAmout = maler_mot_mullo_n + vara_khalas;

        var mot_abosistho =  parseFloat($(this).find('.mot_abosistho').val(mot_abosisthoAmout));
        var abosistho =  parseFloat($(this).find('.abosistho').val(abosisthoAmmouttot));


        //var calculation = parseInt($(this).find('.r_totalbill').val()) - parseInt($(this).find('.r_credit').val());
        console.log("mot_abosistho==========", mot_abosistho);
        console.log("abosistho==========", mot_abosistho);
        // console.log(typeof(calculation));


        //var r_paowna = parseInt($(this).find('.r_paowna').val(calculation));



      });



    }
  </script>

  <script src="../js/common_js.js"></script>
</body>

</html>