<?php 
  session_start();
  if(!isset($_SESSION['username']) ){    
      header('location:../index.php');
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $project_name_id = $_SESSION['project_name_id'];
  


  if(isset($_GET['sucMsgFromDelete'])){
    $sucMsgFromDelete = $_GET['sucMsgFromDelete'];
  }

  $sucMsg ='';
  $due_date = '';
  if(isset($_GET['edite_id'])){
      $edit_id = $_GET['edite_id'];
  }
  
  //update
  // if(isset($_GET['edite_id'])){
  //     $edit_id = $_GET['edite_id'];
  //     if(isset($_POST['update'])) {
  //         $edit_row_id = $_POST['row_id'];
  //         $due_credit_amount = $_POST['due_credit_amount'];
  //         $due_debit_amount = $_POST['due_debit_amount'];
  //         $post_due_date = $_POST['due_date'];
  //         $postDateArr = explode('/', $post_due_date);
  //         $due_date    = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

  //         if($due_credit_amount == ''){
  //           $due_credit_amount = 0;
  //         }
  //         if($due_debit_amount == ''){
  //           $due_debit_amount = 0;
  //         }

  //         $query = "UPDATE due SET due_credit_amount='$due_credit_amount', due_debit_amount='$due_debit_amount', due_debit_date = '$due_date' WHERE id = '$edit_row_id' AND project_name_id = '$project_name_id'";
  //         $update = $db->update($query);
  //         if ($update) {
  //           $sucMsg = '';
  //           $_SESSION['jerPaonaSucMsg'] = 'Data Updated Successfully!';
  //           $_SESSION['date_reload'] = $due_date;
  //           echo "<script>window.location.href = 'update_vaucher_due.php'</script>";
  //         } else {
  //           $sucMsg = 'Failed to Update Data!';
            
  //         }
  //     }
  // }

  //Insert and update
  // if(isset($_POST['inertUpdateBtn'])){
  //   $submitVal = $_POST['inertUpdateBtn'];
  //   $edit_row_id = $_POST['row_id'];
  //   $due_credit_amount = $_POST['due_credit_amount'];
  //   $due_debit_amount = $_POST['due_debit_amount'];
  //   $post_due_date = $_POST['due_date'];
  //   $postDateArr = explode('/', $post_due_date);
  //   $due_date    = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

  //   if($due_credit_amount == ''){
  //     $due_credit_amount = 0;
  //   }
  //   if($due_debit_amount == ''){
  //     $due_debit_amount = 0;
  //   }
    
  //   if($submitVal == 'Save'){
  //       $isExitDate_sql = "SELECT due_debit_date FROM due WHERE due_debit_date = '$due_date' AND project_name_id = '$project_name_id'";
  //       $hasDate = $db->select($isExitDate_sql);
  //       if(mysqli_num_rows($hasDate) == 0){
  //           $query ="INSERT INTO due (due_credit_amount, due_debit_amount, due_debit_date, project_name_id) VALUES ('$due_credit_amount', '$due_debit_amount', '$due_date', '$project_name_id')";
  //           $result = $db->select($query);
  //           if($result){
  //             $sucMsg = 'New Data Inserted Successfully!';
  //           } else {
  //             $sucMsg = 'Data is not Inserted';
  //           }
  //       } else {
  //           // $sucMsg = 'Data already inserted at the date '.$post_due_date.'. Please update that data.';
  //           $sucMsg = 'Data already inserted at the date. Please update that data.';
  //       }
  //   } else {
  //         $query = "UPDATE due SET due_credit_amount='$due_credit_amount', due_debit_amount='$due_debit_amount', due_debit_date = '$due_date' WHERE id = ' $edit_row_id' AND project_name_id = '$project_name_id'";
  //         $update = $db->update($query);
  //         if ($update) {
  //           $sucMsg = 'Data Updated Successfully!';
  //         } else {
  //           $sucMsg = 'Failed to Update Data!';
  //         }
  //   }
  // }

  if(isset($_GET['detele_id'])){
      $detele_id = $_GET['detele_id'];

      $sql = "DELETE FROM due WHERE id = '$detele_id'";
      if ($db->select($sql) === TRUE) {
        $sucMsg = "Jer/paona delete successfully.";
        // echo '<script>$("#sucMsg").html(' . $sucMsg . ');</script>';
      } else {
        $sucMsg = "Jer/paona is not delete.";
        echo "Error: " . $sql . "<br>" .$db->error;
      }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Vaucher Due</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <style type="text/css">
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
    }
    .table > thead > tr > th {
        border-bottom: 2px solid #ddd;
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd;
    }
    .backcircle{
        font-size: 18px;
        position: absolute;
        margin-top: -30px;
    }
    .backcircle a:hover{
        text-decoration: none !important;
    }
    .updateBtn{
      width: 150px;
      float: right;
    }
    .view{
      vertical-align: middle !important;
    }
    .part{
      margin-bottom: 15px;
    }
    .btn-info {
      color: #000;
      background-color: #F0F0F0;
      border-color: #5bc0de;
    }
    .btn-info:hover {
      color: #000;
      background-color: #F0F0F0;
      border-color: #5bc0de;
    }
    .btn-info:focus {
      color: #000;
      background-color: #F0F0F0;
      border-color: #5bc0de;
    }
    .select2-container .select2-selection--single{
        height:34px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #000;
        font-size: 14px;
        line-height: 31px;        
    }
    .select2-container--default .select2-selection--single{
        border: 1px solid #46b8da !important;
        background-color: #F0F0F0;
    }
    .select2-container--default .select2-results > .select2-results__options {
        max-height: 310px;
    }
  </style>
</head>
<body>
  <?php
    include '../navbar/header_text.php';
    include '../navbar/navbar.php';    
  ?> 
  <div class="container" style="margin-bottom: 100px;">
    <?php
      $query = "SELECT * FROM project_heading WHERE id = '$project_name_id'";
      $show = $db->select($query);
      if ($show){
          while ($rows = $show->fetch_assoc()){
            ?>
            <div class="project_heading text-center">      
              <h2 class="text-center" style="font-size: 25px;"><?php echo $rows['heading']; ?></h2>
              <!-- <h4 class="text-center"><?php //echo $rows['subheading']; ?></h4> -->
            </div>
            <?php 
          }
      } 
    ?>
    <div class="backcircle">
      <a href="../vaucher/modify_vaucher.php">
        <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
      </a>
    </div>
    <h4 class="text-center">পূ্র্বের জের / পূ্র্বের পাওনা</h4>
    <div class="part">
        তারিখঃ 
        <?php
            $sql = "SELECT DISTINCT due_debit_date FROM due WHERE project_name_id = '$project_name_id' ORDER BY due_debit_date DESC";
            $result = $db->select($sql);
            echo '<select id="debit_date_list" style="width: 125px">';
            echo '<option value ="'.date("Y-m-d").'">'.date("d/m/Y").'</option>';
            echo '<option value ="none">All Dates...</option>';
            if($result && mysqli_num_rows($result) > 0){
                while ($date = $result->fetch_assoc()) {
                    $due_debit_date = $date['due_debit_date'];
                    if( $due_debit_date !== '0000-00-00'){
                        echo '<option value="' . $due_debit_date . '">' . date("d/m/Y", strtotime($due_debit_date)) . '</option>';
                    }                                
                }                            
            }
            echo '</select>';
        ?>
    </div>

    <div id="changeTable">
        <?php
            if(isset($edit_id)){
                  ?>
                  <form action="" method="POST" onsubmit="return validation()">  
                      <table class="table table-bordered table-condensed" id="dynamic_field">
                          <?php
                              $query = "SELECT * FROM due WHERE id = '$edit_id'";
                              $show = $db->select($query);
                              while($data = $show->fetch_assoc()){
                                $due_credit_amount = $data['due_credit_amount'];
                                $due_debit_amount = $data['due_debit_amount'];
                                $due_date = $data['due_debit_date'];
                                // echo '<script>alert('.$due_date.')</script>';
                                if($due_date == '0000-00-00'){
                                  $due_date = date("d/m/Y");
                                } else {
                                  $orginal_date = $due_date;
                                  $due_date = date("d/m/Y", strtotime($due_date));
                                  
                                }
                            ?>
                              <tr>
                                <td class="text-center" style="width: 140px;">তারিখ</td>
                                <td class="text-center" >পূর্বের জে‌রঃ</td>
                                <td class="text-center" >পূর্বের পাওনাঃ</td>
                                <td class="text-center" >Delete</td>
                                <td class="text-center" >Edit</td>
                              </tr>
                              <tr>
                                <td>
                                  <input type="text" name="due_date" class="form-control" placeholder="dd/mm/yy" id="due_date_new" value="<?php echo $due_date; ?>">
                                </td>
                                <td>
                                  <input type="text" name="due_credit_amount" class="form-control" value="<?php echo $due_credit_amount; ?>" id="credit_new" placeholder="পূর্বের জে‌র সংখ্যায়..."/>
                                </td>
                                <td>
                                  <input type="text" name="due_debit_amount" class="form-control" value="<?php echo $due_debit_amount; ?>" id="debit_new" placeholder="পূর্বের পাওনা সংখ্যায়..."/>
                                </td>
                                <td></td>
                                <td></td>
                              </tr>
                            <?php
                          }
                        ?>
                      </table>
                      <div class="form-group">
                        <input type="button" class="form-control btn btn-primary updateBtn" name="inertUpdateBtn" value="Update" id="inertUpdateBtn">
                        <input type="hidden" name="row_id" value="<?php echo $edit_id; ?>" id="row_id">
                      </div>
                  </form>              
                  <?php
            } else {
                ?>
                <form action="" method="POST" onsubmit="">                
                    <table class="table table-bordered table-condensed" id="dynamic_field">
                      <tr>
                        <td class="text-center" style="width: 140px;">তারিখ</td>
                        <td class="text-center" >পূর্বের জে‌রঃ</td>
                        <td class="text-center" >পূর্বের পাওনাঃ</td>
                        <td class="text-center" >Delete</td>
                        <td class="text-center" >Edit</td>
                      </tr>
                      <tr>
                        <td>
                          <input type="text" name="due_date" class="form-control" placeholder="dd/mm/yy" id="due_date_new" value="">
                        </td>
                        <td>
                          <input type="text" name="due_credit_amount" class="form-control" value="" id="credit_new" placeholder="পূর্বের জে‌র সংখ্যায়..." />
                        </td>
                        <td>
                          <input type="text" name="due_debit_amount" class="form-control" value="" id="debit_new" placeholder="পূর্বের পাওনা সংখ্যায়..." />
                        </td>
                        <td></td>
                        <td></td>
                      </tr>
                    </table>
                    <div class="form-group">
                      <input type="button" class="form-control btn btn-primary updateBtn" name="inertUpdateBtn" value="Save" id="inertUpdateBtn">
                      <input type="hidden" name="row_id" value="0" id="row_id">                     
                    </div>
                </form>
                <?php
            }
        ?>
    </div>
    <h4 class="text-center text-success" id="sucMsg" style="margin-left: 150px;">
      <?php
        if(isset($sucMsgFromDelete)){
          echo $sucMsgFromDelete;
        }
      ?>
    </h4>
  </div>

    <?php include '../others_page/delete_permission_modal.php';  ?>
    <script type="text/javascript">
        $('#debit_date_list').selectpicker();
        function deleteParameter(){
            var location = window.location.href;
            var n = location.indexOf("?");
            var newLocation = location.substr(0, n);
            history.pushState('', '', newLocation);
        }
    </script>
    <script type="text/javascript">
     // function validation(){
     //        validReturn = false;

     //        var credit   = $('#credit').val();
     //        var debit = $('#debit').val();
     //        // alert(credit +" | "+ debit);
     //        if(credit == ""){
     //            alert("পূবর্ের জের ফঁকা হবে না ! মান না থাকলে ০ বসান ।");
     //            $('#credit').focus();
     //            validReturn = false;
     //        } else if(!$.isNumeric(credit)){
     //            alert("পূরব‌ের জের অবশ্যই সংখ্যা হতে হবে ?");
     //            $('#credit').focus();
     //            validReturn = false;
     //        } else {
     //          if(debit == ""){
     //                alert("পূরব‌ের পাওনা ফাঁকা হবে না ! মান না থাকলে ০ বসান ।");
     //                $('#debit').focus();
     //                validReturn = false;
     //            } else if(!$.isNumeric(debit)){
     //                alert("পূরব‌ের পাওনা অবশ্যই সংখ্যা হতে হবে ?");
     //                $('#debit').focus();
     //                validReturn = false;
     //            } else {
     //              validReturn = true;
     //            }
     //        }

     //        if(validReturn){
     //            return true;
     //        }else{
     //            return false;
     //        }
     //    }
    </script>
    <script type="text/javascript">
      // if($('#sucMsg').html() === 'Data Updated Successfully!'){
      //     var delay = 1500;
      //     setTimeout(function() {
      //         window.location.href = 'modify_vaucher.php';
      //     }, delay);        
      //   } else{}
    </script>
    
    <script type="text/javascript">
        $(document).on('click', '.delete_due', function(event){          
            var detele_id = $(event.target).attr('detele_id');
            var delete_date = $(event.target).attr('delete_date');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("detele_id", detele_id).attr("delete_date", delete_date);
        });
        $(document).on('click', '#verifyToDeleteBtn', function(event){
            var detele_id = $(event.target).attr('detele_id');
            var delete_date = $(event.target).attr('delete_date');
            var seletedDate = $('#debit_date_list option:selected').val();

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
                        ConfirmDialog('Are you sure delete jer/paona info?');
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
                                            $.get("update_vaucher_due.php?detele_id="+detele_id, function(data, status){
                                              console.log(status);
                                              if(status == 'success'){
                                                  if(seletedDate =="none"){
                                                      getAllJerPaona();
                                                      $("#sucMsg").html('Jer/paona delete successfully.');
                                                      $("#debit_date_list option[value='" + delete_date + "']").remove();
                                                      $("#debit_date_list").selectpicker('refresh');
                                                  } else {
                                                      // getAllJerPaonaDateWise(seletedDate);
                                                      var sucMsg = 'Jer/paona delete successfully.'
                                                      window.location.href = 'update_vaucher_due.php?sucMsgFromDelete='+sucMsg;
                                                  }
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
        function displayupdate(element){
            var td_date     = $(element).closest('tr').find('td:eq(0)').text();
            var td_jer   = $(element).closest('tr').find('td:eq(1)').text();
            var td_paona   = $(element).closest('tr').find('td:eq(2)').text();
            var attr_row_id = $(element).attr('edit_id');
            // alert(row_id);

            $('#due_date_new').val(td_date);
            $('#credit_new').val(td_jer);
            $('#debit_new').val(td_paona);
            $('#row_id').val(attr_row_id);
            $('#inertUpdateBtn').val('Update');
            $('#sucMsg').html('');
            // $('html').animate({ scrollTop: 0 }, 'slow');
            $('html').animate({ scrollTop: $(document).height()}, 'slow');
        }
        $('#debit_date_list').select2({ width: 'resolve' }).on('select2:open', function(e){
            $('.select2-search__field').attr('placeholder', 'Search...');          
        });
    </script>
    <script type="text/javascript">
        $(document).on('change', '#debit_date_list', function(){
            deleteParameter();  
            var seletedDate = $('#debit_date_list option:selected').val();
            var msgShow = 'no';
            $("#sucMsg").html('');
            if(seletedDate === 'none'){
                // window.location.href = "../vaucher/modify_vaucher.php";
                getAllJerPaona(msgShow);
            } else {
                getAllJerPaonaDateWise(seletedDate, msgShow);
            }          
        });

        function getAllJerPaona(msgShow){
          $.ajax({
              url: '../ajaxcall/getAllJerPaona.php',
              // type: 'post',
              // data: {selectedDate: date},
              success: function(res){
                  // alert(res);
                  $('#changeTable').html(res);
                  $('#due_date_new').datepicker( {
                      onSelect: function(date) {
                          // alert(date);
                          $(this).change();
                      },
                      dateFormat: "dd/mm/yy",
                      changeYear: true,
                  }).datepicker("setDate", new Date());             
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
        }
        function getAllJerPaonaDateWise(dateStr, msgShow){          
          $.ajax({
              url: '../ajaxcall/getAllJerPaonaDateWise.php',
              type: 'post',
              data: {selectedDate: dateStr},
              success: function(res){
                  // alert(res);
                  $('#changeTable').html(res);
                  $('#due_date_new').datepicker( {
                      onSelect: function(date) {
                          // alert(date);
                          $(this).change();
                      },
                      dateFormat: "dd/mm/yy",
                      changeYear: true,
                  }).datepicker("setDate", new Date());
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
        }
    </script>
    <script type="text/javascript">
        $(document).on('click', '#inertUpdateBtn', function(){
            $("#sucMsg").html('');
            var seletedDate = $('#debit_date_list option:selected').val();

            var insert_update_val = $(this).val();

            var entry_date = $('#due_date_new').val();
            var dateArr = entry_date.split('/');
            var entry_date_format = dateArr[2] + '-' + dateArr[1] + '-' + dateArr[0].slice(-2);

            var credit_new = $('#credit_new').val();
            var debit_new = $('#debit_new').val();
            var row_id = $('#row_id').val();
            // alert(credit_new);

            inertUpdateJerPaona(seletedDate, insert_update_val, entry_date_format, credit_new, debit_new, row_id);
        });

        function inertUpdateJerPaona(seletedDate, insert_update_val, entry_date_format, credit_new, debit_new, row_id){
          $.ajax({
              url: '../ajaxcall_save_update/insert_update_jer_paona.php',
              type: 'post',
              data: {
                insert_update_val : insert_update_val,
                entry_date : entry_date_format,
                credit_new: credit_new,
                debit_new : debit_new,
                row_id    : row_id
              },
              dataType: 'JSON',
              success: function(res){
                  var sucMsg = res[0].sucMsg;
                  var state = res[0].state;
                  var date_list_html = res[0].date_list_html;
                  // var len = res.length;
                  // for(var i=0; i<len; i++){
                  //     alert(res[i].sucMsg);
                  //     alert(res[i].state);
                  // }
                  // $("#sucMsg").html(sucMsg);
                  deleteParameter(); //Remove url parameter                  
                  
                  // alert(date_list_html);
                  // alert(entry_date_format);

                  if(state == 'inserted') {
                      $("#debit_date_list").html(date_list_html);
                      $("#debit_date_list").val(entry_date_format).trigger('change');
                      // getAllJerPaonaDateWise(entry_date_format);
                      $("#sucMsg").html(sucMsg);
                  } else if(state == 'updated'){
                      $("#debit_date_list").html(date_list_html);
                      $("#debit_date_list").val(entry_date_format).trigger('change');
                      // getAllJerPaonaDateWise(entry_date_format);
                      $("#sucMsg").html(sucMsg);
                  }  else {
                      $("#sucMsg").html(sucMsg);
                  }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
        }
    </script>
    <script type="text/javascript" id="script-1">
      var location_for_set_date = window.location.href;
      var nn = location_for_set_date.indexOf("?");
      // alert(nn);
      if(nn == '-1'){
          $('#due_date_new').datepicker( {
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd/mm/yy",
            changeYear: true,
        }).datepicker("setDate", new Date());
      } else {
        var due_date = "<?php echo $due_date; ?>";
          if(due_date == ''){ //? thakle ki hobe
              $('#due_date_new').datepicker( {
                  onSelect: function(date) {
                      // alert(date);
                      $(this).change();
                  },
                  dateFormat: "dd/mm/yy",
                  changeYear: true,
              }).datepicker("setDate", new Date());
          } else {
              $('#due_date_new').datepicker( {
                  onSelect: function(date) {
                      // alert(date);
                      $(this).change();
                  },
                  dateFormat: "dd/mm/yy",
                  changeYear: true,
              });
          }          
      }
    </script>
    <script type="text/javascript">
      $(document).on("click", ".kajol_close, .cancel", function(){
          $("#verifyPasswordModal").hide();
      });
    </script>
</body>
</html>
