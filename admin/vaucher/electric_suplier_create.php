<?php
session_start();
if (!isset($_SESSION['username'])) {
  header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$_SESSION['pageName'] = 'electric_suplier_create';
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
  <title>সাপ্লায়ার এন্ট্রি</title>
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
    .main_bar {

      width: calc(86% - 100px) !important;
    }

    .btn.btn-success.add_button {
      margin-top: 24px;
    }

    .remove_button {
      margin-top: 24px;
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

    .error {
      color: #fb1515;
    }

    input[class="error"] {
      border: 1px solid #f00 !important;
    }

    input[class="form control error"] {
      border: 1px solid #f00 !important;
    }

    .error p {
      color: #f00 !important;
    }

    #rajkerMistreeFormTable td label {
      color: #dd150b;
    }

    #cancle_hedmistress {
      margin-left: 20px;
    }
  </style>

</head>

<body>
  <?php
  include '../navbar/header_text.php';
  $page = 'electric_suplier_create';
  include '../navbar/navbar.php';
  ?>
  <div class="bar_con">
    <div class="left_side_bar">
      <?php require '../others_page/left_menu_electric_kroy_bikroy_hisab.php'; ?>
    </div>
    <div class="main_bar">
      <?php
      $query = "SELECT * FROM project_heading WHERE id = '$project_name_id'";
      $show = $db->select($query);
      if ($show) {
        while ($rows = $show->fetch_assoc()) {
      ?>
          <div class="project_heading" id="project_heading">
            <h2 class="headingOfAllProject">
              <?php echo $rows['heading']; ?>
              <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; 
                                                  ?></span> -->

            </h2>
          </div>
      <?php
        }
      }
      ?>
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

      <strong style="font-size: 18px">সাপ্লায়ার এন্ট্রি</strong>
      <form name="dataEntryForm" id="dataEntryForm" enctype="multipart/form-data" style="margin-top:20px ">

        <table class="table table-border table-condensed" id="rajkerMistreeFormTable">

          <thead>
            <tr>
              <th class="cenText">সাপ্লায়ার নাম</th>
              <th class="cenText">প্রতিষ্ঠানের নাম</th>
              <th class="cenText">স্লোগান</th>
              <th class="cenText">মোবাইল নাম্বার</th>
              <th class="cenText">ঠিকানা</th>



            </tr>
          </thead>
          <tbody>
            <tr>
              <input type="hidden" name="id" id="id">
              <td colspan="" rowspan="" headers="">
                <input type="text" class="form-control" name="suplier_name" id="suplier_name" placeholder="নাম">
                <p class="name_err"></p>
              </td>
              <td colspan="" rowspan="" headers="">
                <input type="text" class="form-control" name="suplier_Protisthan_name" id="suplier_Protisthan_name" placeholder="প্রতিষ্ঠানের নাম">
                <p class="Protisthan_name_err"></p>
              </td>
              <td colspan="" rowspan="" headers="">
                <input type="text" class="form-control" name="suplier_Protisthan_slogan" id="suplier_Protisthan_slogan" placeholder="প্রতিষ্ঠানের স্লোগান">
                <p class="slogan_err"></p>
              </td>
              <td colspan="" rowspan="" headers="">
                <input type="text" class="form-control" name="suplier_mobile_num" id="suplier_mobile_num" placeholder="মোবাইল নাম্বার">
                <p class="mobile_num_err"></p>

              </td>
              <td colspan="" rowspan="" headers="">
                <input type="text" class="form-control" name="suplier_address" id="suplier_address" placeholder="ঠিকানা">
                <p class="suplier_address_err"></p>
              </td>

            </tr>
          </tbody>

        </table>

        <div class="row">
          <div class="form-group col-sm-12">
            <button type="button" name="submit_btn" id="submit_btn" class="btn btn-primary pull-right">Save</button>

            <button type="button" name="cancle_btn" id="cancle_btn" class="btn btn-danger pull-right">Cancle</button>
            <button style="margin-right: 10px;" type="button" name="update_btn" id="update_btn" class="btn btn-success pull-right">Update</button>
          </div>
        </div>

      </form>
      <div class="displayCon">
        <h3 style="text-align: center; margin-top: 0px;">সাপ্লায়ার তালিকা</h3>

        <table class="table_dis">
          <thead>
            <tr style="background-color: #b5b5b5;">
            <th class="cenText">#</th>
              <th class="cenText">সাপ্লায়ার নাম</th>
              <th class="cenText">প্রতিষ্ঠানের নাম</th>
              <th class="cenText">স্লোগান</th>
              <th class="cenText">মোবাইল নাম্বার</th>
              <th class="cenText">ঠিকানা</th>
              <!-- <th class="cenText" style="width: 76px;">view</th> -->
              <th class="cenText" style="width: 76px;">Delete</th>
              <th class="cenText" style="width: 59px;">Edit</th>

            </tr>

          </thead>
          <tbody id="suplier_details">

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
        $('.mistree_name_show:last-child').val($("#r_hedmistress").find('option:selected').text());
        datepickerfunction();
      });
    });

    function datepickerfunction() {
      $('.r_date').datepicker({
        onSelect: function(date) {
          // alert(date);
          $(this).change();
        },
        dateFormat: "dd/mm/yy",
        changeYear: true,
      }).datepicker("setDate", new Date());
    }



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
            ConfirmDialog('Are you sure to delete this entry ?', data_row_id);
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
                $.post("electricSuplierFromData.php", {
                  data_delete_id: data_row_id
                }, function(data, status) {
                  console.log(status);
                  console.log(data);
                  if (status == 'success') {
                    // $('#sucMsg').html('succsess');
                    window.location.href = 'electric_suplier_create.php';
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
    suplierAllData();

    function suplierAllData() {

      var action = "suplier_details";
      $.ajax({
        url: 'electricSuplierFromData.php',
        type: 'POST',
        data: {
          action: action
        },
        success: function(response, status) {
          $("#suplier_details").html(response);

          console.log("datass =============", response)
        },
        error: function(data) {
          //  var errorMessage = xhr.status + ': ' + xhr.statusText
          alert('Error - ' + data);
        }
      });

    }

    // $("#employee_profile_pic").change(function(){

    //   var allowedExtension = ['jpeg', 'jpg', 'png', 'gif'];
    //           var fileExtension = document.getElementById('employee_profile_pic').value.split('.').pop().toLowerCase();
    //           var isValidFile = false;

    //               for(var index in allowedExtension) {

    //                   if(fileExtension === allowedExtension[index]) {
    //                       isValidFile = true; 
    //                       break;
    //                   }
    //               }

    //               if(!isValidFile) {
    //                   alert('Allowed image formate should be : *.' + allowedExtension.join(', *.'));
    //                   $("#employee_profile_pic").val('');
    //               }

    //               return isValidFile;

    // });


    $('#submit_btn').show();
    $('#update_btn').hide();
    $('#cancle_btn').hide();
    $(document).on('click', '#cancle_btn', function() {
      $('#employeeEntryForm')[0].reset();
      $('#submit_btn').show();
      $('#update_btn').hide();
      $('#cancle_btn').hide();

    });
    $('#submit_btn').on('click', function() {
      var suplier_name = $("#suplier_name").val();
      var suplier_Protisthan_name = $('#suplier_Protisthan_name').val();
      var suplier_Protisthan_slogan = $('#suplier_Protisthan_slogan').val();
      var suplier_mobile_num = $('#suplier_mobile_num').val();
      var suplier_address = $('#suplier_address').val();
      var project_name_id = "<?php echo $_SESSION['project_name_id'] ?>";
      var action = "suplier_insert";


      if ($('#suplier_name').val().length === 0) {
        $('.name_err').html('<div class="error">Name is required</div>');
        return false;
      }
      if ($('#suplier_Protisthan_name').val() == '') {
        $('.Protisthan_name_err').html('<div class="error">This field required</div>');
        return false;
      }
      if ($('#suplier_mobile_num').val() == '') {
        $('.mobile_num_err').html('<div class="error">This field required</div>');
        return false;
      }
      if ($('#suplier_address').val() == '') {
        $('.suplier_address_err').html('<div class="error">This field required</div>');
        return false;
      }

      var formData = new FormData($('#dataEntryForm')[0]);
      formData.append("suplier_name", suplier_name);
      formData.append("suplier_Protisthan_name", suplier_Protisthan_name);
      formData.append("suplier_Protisthan_slogan", suplier_Protisthan_slogan);
      formData.append("suplier_mobile_num", suplier_mobile_num);
      formData.append("suplier_address", suplier_address);
      formData.append("project_name_id", project_name_id);
      formData.append("action", action);
      $.ajax({
        url: "electricSuplierFromData.php",
        type: "POST",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
          console.log("Suplier Insert data data ========== ", data)
          //$('#success').html('Data added successfully !'); 
          if (data) {
            alert('Data added successfully !');
            $('#dataEntryForm')[0].reset();
              suplierAllData();
          } else {
            console.log(data.error);
          }

        },
        error: function(error) {
          //var errorMessage = xhr.status + ': ' + xhr.statusText
          console.log('Error mistree - ' + error);
        }

      });

    });




    $(document).on('click', '.edit_data', function() {
      $('#submit_btn').hide();
      $('#cancle_btn').show();
      $('#update_btn').show();

      var id = $(this).attr('id');
      //alert(id);
      var action = 'edit_single';
      var data = {
        id: id,
        action: action
      };
      $.ajax({
        url: "electricSuplierFromData.php",
        type: "POST",
        dataType: "JSON",
        data: data,

        success: function(data) {
          console.log("editdata==========", data);
          $('#id').val(data.id);
          $('#suplier_name').val(data.suplier_name);
          $('#suplier_Protisthan_name').val(data.suplier_Protisthan_name);
          $('#suplier_Protisthan_slogan').val(data.suplier_Protisthan_slogan);
          $('#suplier_mobile_num').val(data.suplier_mobile_num);
          $('#suplier_address').val(data.suplier_address);
          //$('#id').val(data.id);
          console.log(data);

        },
        error: function(data) {
          console.log("Error mistree data===", data);
        }
      });

    });



    $('#update_btn').on('click', function() {
      var id = $('#id').val();
      var suplier_name = $("#suplier_name").val();
      var suplier_Protisthan_name = $('#suplier_Protisthan_name').val();
      var suplier_Protisthan_slogan = $('#suplier_Protisthan_slogan').val();
      var suplier_mobile_num = $('#suplier_mobile_num').val();
      var suplier_address = $('#suplier_address').val();
      var project_name_id = "<?php echo $_SESSION['project_name_id'] ?>";
      var action = "single_update";


      if ($('#suplier_name').val().length === 0) {
        $('.name_err').html('<div class="error">Name is required</div>');
        return false;
      }
      if ($('#suplier_Protisthan_name').val() == '') {
        $('.Protisthan_name_err').html('<div class="error">This field required</div>');
        return false;
      }
      if ($('#suplier_mobile_num').val() == '') {
        $('.mobile_num_err').html('<div class="error">This field required</div>');
        return false;
      }
      if ($('#suplier_address').val() == '') {
        $('.suplier_address_err').html('<div class="error">This field required</div>');
        return false;
      }

      var formData = new FormData($('#dataEntryForm')[0]);
      formData.append("id", id);
      formData.append("suplier_name", suplier_name);
      formData.append("suplier_Protisthan_name", suplier_Protisthan_name);
      formData.append("suplier_Protisthan_slogan", suplier_Protisthan_slogan);
      formData.append("suplier_mobile_num", suplier_mobile_num);
      formData.append("suplier_address", suplier_address);
      formData.append("project_name_id", project_name_id);
      formData.append("action", action);

      $.ajax({
        url: "electricSuplierFromData.php",
        type: "POST",
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {
          console.log("Mistree update data ========== ", data)
          //$('#success').html('Data added successfully !'); 
          alert(data);
          $('#submit_btn').show();
      $('#cancle_btn').hide();
      $('#update_btn').hide();
          $('#dataEntryForm')[0].reset();
          suplierAllData();


        },
        error: function(error) {
          //var errorMessage = xhr.status + ': ' + xhr.statusText
          console.log('Error mistree - ' + error);
        }

      });

    });


  </script>

  <script src="../js/common_js.js"></script>
</body>

</html>