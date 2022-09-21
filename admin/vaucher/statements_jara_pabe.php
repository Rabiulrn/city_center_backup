<?php 
session_start();
if(!isset($_SESSION['username']) ){    
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';

$db = new Database();
$sucMsg = '';
$project_name_id = $_SESSION['project_name_id'];
$info_id = $_GET['info_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Statement Nij paonader paisi amount -</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <style type="text/css">
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
    }
    .table > thead > tr > th {
        border-bottom: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd !important;
    }
    .cancelBtn{
      float: right;
    }
    .headingOfAllProject {
        margin: 16px 0px 10px;
        min-height: 32px;
        padding-bottom: 8px;
        /*border-bottom: 1px solid #A54686 !important;*/
        font-size: 25px;
        line-height: 20px;
        text-align: center;
    }
    .headingOfAllProject:before {
       content: none;
    }
  </style>
</head>
<body>
    <?php
      include '../navbar/header_text.php';
      include '../navbar/navbar.php';    
      ?> 
      <div class="container">
          <?php
              $ph_id = $_SESSION['project_name_id'];
              $query = "SELECT * FROM project_heading WHERE id = '$ph_id'";
              $show = $db->select($query);
              if ($show) {
                while ($rows = $show->fetch_assoc()) {
                ?>
                    <div class="project_heading text-center">      
                        <h2 class="headingOfAllProject"><?php echo $rows['heading']; ?></h2>
                        <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
                    </div>
                <?php 
                }
              } 
          ?>

          <div class="back-circle2">
              <a href="../vaucher/modify_vaucher.php">
                    <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
              </a>
          </div>
          <?php
              echo '<h3 class="statement-header text-success">যারা পাবে স্টেটমেন্টস</h3>';
              echo '<table class="table table-bordered" width="100%" style="margin: 0px 0px 80px; float: left;">';
              echo '<tr align="center" class="bg-primary">';
                  echo '<td width="75px">ক্রমিক নং</td>';
                  echo '<td width="85px">তারিখ</td>';
                  echo '<td style="min-width: 200px;">যার কাছে পাবো তার নাম</td>';
                  echo '<td>বিবরণ</td>';
                  echo '<td style="min-width: 90px;">ডেবিট টাকা (-)</td>';
                  echo '<td style="min-width: 90px;">ক্রেডিট টাকা (+)</td>';
                  echo '<td style="min-width: 90px;">ব্যালেন্স</td>';
              echo '</tr>';

              $i = 1;
              $pabe_amount = '';
              $opening_balance = 0;
              $debit_total= 0;
              $debit_count= 0;
              $credit_total= 0;
              $credit_count= 0;
              $sql = "SELECT * FROM jara_pabe WHERE pabe_id = '$info_id' AND project_name_id = '$project_name_id'";
              $jara_pabe = $db->select($sql);
              if(mysqli_num_rows($jara_pabe) == 1){
                  $table_row = $jara_pabe->fetch_assoc();

                  $pabe_name = trim($table_row['pabe_name']);
                  $pabe_description = trim($table_row['pabe_description']);
                  $pabe_amount = trim($table_row['pabe_amount']);
                  if($pabe_amount == ''){
                      $pabe_amount = 0;
                  }
                  $opening_balance = $pabe_amount;
                  $pabe_date = $table_row['pabe_date'];
                  echo '<tr>';
                      echo '<td align="center">' . $i . '</td>';
                      echo '<td>' . date("d/m/Y", strtotime($pabe_date)) . '</td>';
                      echo '<td>' . $pabe_name . '</td>';
                      echo '<td>' . $pabe_description . '</td>';
                      echo '<td class="dr-cr-bl"></td>';
                      echo '<td class="dr-cr-bl"></td>';
                      echo '<td class="dr-cr-bl">' . number_format($pabe_amount, 2) . '</td>';
                  echo '</tr>';
                  
                  $query = "SELECT * FROM entry_jara_pabe WHERE jara_pabe_id = '$info_id' AND project_name_id = '$project_name_id' ORDER BY jp_date ASC";
                  $show = $db->select($query);
                  while($data = $show->fetch_assoc()) {
                      $html = '';
                      // $jp_id =  trim($data['jp_id']);
                      $jp_name =  trim($data['jp_name']);
                      $jp_description =  trim($data['jp_description']);
                      $jp_amount =  trim($data['jp_amount']);
                      $jp_date =  $data['jp_date'];
                      $jp_status =  $data['jp_status'];
                      // $jara_pabe_id = trim($data['jara_pabe_id']);

                      if($jp_status == 'add') {
                          $pabe_amount += $jp_amount;
                          $credit_total += $jp_amount;
                          $credit_count++;
                          $html .= '<tr>';
                              $html .= '<td class="text-center">' . $i .'</td>';
                              $html .= '<td>' . date("d/m/Y", strtotime($jp_date)) .'</td>';
                              $html .= '<td>' . $jp_name .'</td>';
                              $html .= '<td>' . $jp_description .'</td>';
                              $html .= '<td class="dr-cr-bl"></td>';
                              $html .= '<td class="dr-cr-bl">+ ' . number_format($jp_amount, 2) .'</td>';
                              $html .= '<td class="dr-cr-bl">' . number_format($pabe_amount, 2) .'</td>';
                          $html .= '</tr>';
                          echo $html;
                      } else {
                          $pabe_amount -= $jp_amount;
                          $debit_total += $jp_amount;
                          $debit_count++;
                          $html .= '<tr>';
                              $html .= '<td class="text-center">' . $i .'</td>';
                              $html .= '<td>' . date("d/m/Y", strtotime($jp_date)) .'</td>';
                              $html .= '<td>' . $jp_name .'</td>';
                              $html .= '<td>' . $jp_description .'</td>';
                              $html .= '<td class="dr-cr-bl">- ' . number_format($jp_amount, 2) .'</td>';
                              $html .= '<td class="dr-cr-bl"></td>';
                              $html .= '<td class="dr-cr-bl">' . number_format($pabe_amount, 2) .'</td>';
                          $html .= '</tr>';
                          echo $html;
                      }

                      $i++;          
                  }
                  echo '<tr class="bg-success">';
                      echo '<td colspan="6" align="right"><b>মোট যারা পাবেঃ</b></td>';
                      echo '<td class="dr-cr-bl"><b>' . number_format($pabe_amount, 2) . '</b></td>';
                  echo '</tr>';
              }
              echo '</table>';
               echo '<div class="statment-summary row">'.
                        '<div class="stat-box">'.
                            '<div class="stat-text-left">Opening Balance:&nbsp;&nbsp;</div>'.
                            '<div class="stat-text-right">' . number_format($opening_balance, 2) . '</div>'.
                        '</div>'.
                        '<div  class="stat-box">'.
                            '<div class="stat-text-left">Closing Balance:&nbsp;&nbsp;</div>'.
                            '<div class="stat-text-right">' . number_format($pabe_amount, 2) . '</div>'.
                        '</div>'.
                        '<div class="stat-box">'.
                            '<div class="stat-text-left">Debit Total:&nbsp;&nbsp;</div>'.
                            '<div class="stat-text-right">-' . number_format($debit_total, 2) . '</div>'.
                        '</div>'.
                        '<div  class="stat-box">'.
                            '<div class="stat-text-left">Debit Count:&nbsp;&nbsp;</div>'.
                            '<div class="stat-text-right">' . $debit_count . '</div>'.
                        '</div>'.
                        '<div class="stat-box">'.
                            '<div class="stat-text-left">Credit Total:&nbsp;&nbsp;</div>'.
                            '<div class="stat-text-right">+' . number_format($credit_total, 2) . '</div>'.
                        '</div>'.
                        '<div  class="stat-box">'.
                            '<div class="stat-text-left">Creit Count:&nbsp;&nbsp;</div>'.
                            '<div class="stat-text-right">' . $credit_count . '</div>'.
                        '</div>'.
                    '</div>';
          ?>
      </div>
      <?php //include '../others_page/delete_permission_modal.php';  ?>
  <script type="text/javascript">
      // function validation(){
      //     validReturn = false;

              // var mName   = $('#mName').val();
              // var mAmount = $('#mAmount').val();
              // // alert(mName +"  "+ mAmount);
              // if(mName == ""){
              //     alert("মারফোত নাম ফাঁকা হবে না !");
              //     $('#mName').focus();
              //     validReturn = false;
              // } else if(mName.length > 100){
              //     alert("মারফোত নাম ১০০ অক্ষরের বেশী হবে না !");
              //     $('#mName').focus();
              //     validReturn = false;
              // } else if($.isNumeric(mName)){
              //     alert("মারফোত নাম সংখ্যা হতে পারে না !");
              //     $('#mName').focus();
              //     validReturn = false;
              // } else {
              //   if(mAmount == ""){
              //         alert("জমা ফাঁকা হবে না ! মান না থাকলে ০ বসান ।");
              //         $('#mAmount').focus();
              //         validReturn = false;
              //     } else if(!$.isNumeric(mAmount)){
              //         alert("জমা অবশ্যই সংখ্যা হতে হবে ।");
              //         $('#mAmount').focus();
              //         validReturn = false;
              //     } else {
              //       validReturn = true;
              //     }
              // }


      //     var submitVal = $("#insertUpdateBtn").val();
      //     var total = 0;
      //     var sub_total = 0;
      //     total += parseInt($("#total_amount_id").attr("data_amount"));          
      //     // alert(total);
      //     $(".single_amount_class").each(function() {
      //         sub_total += parseInt($(this).attr("data_amount"));            
      //     });
      //     // alert(sub_total);
      //     var amount = parseInt($("#amount").val().trim());
      //     if(isNaN(amount)){
      //         amount = 0;
      //     }
      //     if(submitVal == 'Save Peyesi Amount'){              
      //         sub_total += amount;
      //         if(total >= sub_total){
      //             validReturn = true;
      //         } else {
      //             var extra_amount = sub_total - total;
      //             $("#updateMsg").html('Total entry amount can not greater than ' + total +'.00 !  Here, extra amount is ' + extra_amount + '.00 .');
      //         }
      //     } else {
      //         sub_total -= parseInt($("#amount").attr("update_base_amount"));
      //         sub_total += amount
      //         if(total >= sub_total){
      //             validReturn = true;
      //         } else {
      //             var extra_amount = sub_total - total;
      //             $("#updateMsg").html('Total entry amount can not greater than ' + total +'.00 !  Here, extra amount is ' + extra_amount + '.00 .');
      //         }
      //     }
          


      //     if(validReturn){
      //         return true;
      //     } else {
      //         return false;
      //     }
      // }
  </script>
  <script type="text/javascript">
      // var text = $('#updateMsg').html();
      // if(text == 'Data Updated Successfully!'){
      //   // alert(text);
      //   function sample(){
      //     window.location.href = 'modify_vaucher.php';
      //   }
      //   setTimeout(sample, 1000);
        
      // }

      // function display_update(ele){
      //     var nij_date = $(ele).closest('tr').find('td').eq(1).text();
      //     var nij_name = $(ele).closest('tr').find('td').eq(2).text();
      //     var nij_desc = $(ele).closest('tr').find('td').eq(3).text();
      //     var nij_amount = $(ele).closest('tr').find('td').eq(4).text();
      //       var arr = nij_amount.split('.');
      //       var arr2 = arr[0].split(',');
      //       // console.log(arr2);
      //       var amount = '';
      //       for ( var i = 0; i < arr2.length; i++){                
      //           amount += arr2[i];
      //           // console.log(amount + '='+i);
      //       }
      //     var nij_id = $(ele).attr('row_id');
      //     // console.log(nij_id);

      //     $('#nij_paona_date').val(nij_date).change();
      //     $('#name').val(nij_name);
      //     $('#description').val(nij_desc);
      //     $('#amount').val(amount);
      //     $('#nij_id').val(nij_id);          
      //     $('#insertUpdateBtn').val('Update Peyesi Amount');
      //     $('html,body').animate({ scrollTop: 0 }, 'slow');

      //     $('#amount').attr('update_base_amount', amount);
      //     $("#updateMsg").html('');
      // }



      // $(document).on('click', '.entry_delete', function(event){          
      //     var row_id = $(event.target).attr('row_id');
      //     var data_id = $(event.target).attr('data_id');
      //     $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
      //     $("#matchPassword").val('');
      //     $("#passMsg").html('');
      //     $("#verifyToDeleteBtn").attr("row_id", row_id).attr("data_id", data_id);
      // });
      
      // $(document).on('click', '#verifyToDeleteBtn', function(event){
      //     var row_id = $(event.target).attr('row_id');
      //     var data_id = $(event.target).attr('data_id');
      //     console.log(row_id); console.log(data_id);

      //     $("#passMsg").html("").css({'margin':'0px'});          
      //     var pass = $("#matchPassword").val();
      //     $.ajax({
      //         url: "../ajaxcall/match_password_for_vaucher_credit.php",
      //         type: "post",
      //         data: { pass : pass },
      //         success: function (response) {
      //             // alert(response);
      //             if(response == 'password_matched'){
      //                 $("#verifyPasswordModal").hide();
      //                 ConfirmDialog('Are you sure delete paonader entry info?');
      //             } else {
      //                 $("#passMsg").html(response).css({'color':'red','margin-top':'10px'});
      //             }
      //         },
      //         error: function(jqXHR, textStatus, errorThrown) {
      //             console.log(textStatus, errorThrown);
      //         }
      //     });
      //     function ConfirmDialog(message){
      //         $('<div></div>').appendTo('body')
      //                         .html('<div><h4>'+message+'</h4></div>')
      //                         .dialog({
      //                             modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
      //                             width: '40%', resizable: false,
      //                             position: { my: "center", at: "center center-20%", of: window },
      //                             buttons: {
      //                                 Yes: function () {
      //                                     $(this).dialog("close");
      //                                     $.get("nij_paonader_paisi_amount_minus.php?data_id="+data_id+"&row_id="+row_id, function(data, status){
      //                                       // console.log(status);
      //                                       if(status == 'success'){
      //                                           window.location.href = "nij_paonader_paisi_amount_minus.php?data_id="+data_id;
      //                                       }
      //                                     });
      //                                 },
      //                                 No: function () {
      //                                     $(this).dialog("close");
      //                                 }
      //                             },
      //                             close: function (event, ui) {
      //                                 $(this).remove();
      //                             }
      //         });
      //     };
      // });
  </script>
  <script type="text/javascript" id="script-1">
      // $(function() {
      //   $('#nij_paona_date').datepicker( {
      //       onSelect: function(date) {
      //           // alert(date);
      //           $(this).change();
      //       },
      //       dateFormat: "dd/mm/yy",
      //       changeYear: true,
      //   }).datepicker("setDate", new Date());
      // });
  </script>
  <script type="text/javascript">
      // function page_redirect(){
      //     window.location.href = 'modify_vaucher.php';
      // }
  </script>
  <script type="text/javascript">
    // $(document).on("click", ".kajol_close, .cancel", function(){
    //     $("#verifyPasswordModal").hide();
    // });
  </script>
</body>
</html>
