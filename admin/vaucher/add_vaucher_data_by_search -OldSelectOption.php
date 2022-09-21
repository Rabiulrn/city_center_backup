<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    


    $_SESSION['pageName'] = '';
    $_SESSION['pageName'] = 'khoros_khat_entry';
    // $khorosKhat="active";
    $sucMsg = '';
    $_SESSION['Pageload'] = 'NewLoad';   


    if (isset($_POST['set'])) {
        $_SESSION['Pageload'] = 'AfterReload';
        //print_r($_POST);
        $pay_due_total = $_POST['pay_due_total'];
        $get_debit_group_id = $_POST['get_debit_group_id'];
        $_SESSION['get_debit_group_id'] = $get_debit_group_id;
        $g_id      = $_POST['id'];

        if ($g_id>0) {
            $query = "UPDATE debit_group_data SET group_pay='$pay_due_total', group_id='$get_debit_group_id' WHERE id = $g_id";
            $update = $db->update($query);
            if ($update) {
              // echo "<script>window.location.href = 'add_single_group_data.php?add_id=$get_id'</script>";
              // echo "<script>window.location.href = 'add_vaucher_data_by_search.php'</script>";
            } else {
              echo "<script>alert('Data is not inserted !')</script>";
            }
        }      
    }


    //insert data to table debit_group_data
    if (isset($_POST['submit'])) {
        $_SESSION['Pageload'] = 'AfterReload';

        $newFormatDate ='';
        $get_debit_group_id = $_POST['group_id'];
        $_SESSION['get_debit_group_id'] = $get_debit_group_id;

        $query = "SELECT * FROM debit_group WHERE id = '$get_debit_group_id'";
        $read = $db->select($query);
        if ($read) {
            $row = $read->fetch_assoc();    
            $group_date_insert  = $row['group_date'];
            // echo '<script>alert("a' . $group_date_insert . '")</script>';
            $time = strtotime($group_date_insert);
            $newFormatDate = date('Y-m-d', $time);
        }
        for ($i = 0; $i < count($_POST['group_name']); $i++) {
            $postDateArr        = explode('/', $_POST['entry_date'][$i]);      
            $entry_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

            $group_name        = $_POST['group_name'][$i];
            $group_description = $_POST['group_description'][$i];
            $taka              = $_POST['taka'][$i];
            $pices             = $_POST['pices'][$i];
            $total_taka        = $_POST['total_taka'][$i];
            // $total_bill        = $_POST['total_bill'][$i];
            $pay               = $_POST['pay'][$i];
            $due               = $_POST['due'][$i];
            $group_id          = $get_debit_group_id;
            
            // $query = "INSERT INTO debit_group_data(entry_date, group_name, group_description, group_taka, group_pices, group_total_taka, group_total_bill, group_pay, group_due, group_id, dg_date, project_name_id) VALUES ('$entry_date', '$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$total_bill', '$pay', '$due', '$group_id', '$newFormatDate', '$project_name_id')";
            $query = "INSERT INTO debit_group_data(entry_date, group_name, group_description, group_taka, group_pices, group_total_taka, group_pay, group_due, group_id, dg_date, project_name_id) VALUES ('$entry_date', '$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$pay', '$due', '$group_id', '$newFormatDate', '$project_name_id')";

            $result = $db->insert($query);
            if ($result) {
                $sucMsg = 'Data is inserted successfully !';
            } else {
                $sucMsg = 'Data is not inserted !';
            }
        }
    }




    // delete data part
    if (isset($_GET['dels_id'])) {
        $visibility = 0;
        $del    = $_GET['dels_id'];
        $query = "DELETE FROM debit_group_data WHERE id = $del";
        $delete = $db->delete($query);
        if ($delete) {
            echo "<script>alert('Data Deleted Successfully!');</script>";
            // echo "<script>window.location.href = 'modify_vaucher.php'</script>";
        } else {
            echo "<script>alert('Failed to Delete Data!');</script>";
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
    <title>খরচ খাত এন্ট্রি</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
    <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <style type="text/css">
        .table > thead:first-child > tr:first-child > th {
            border-top: 1px solid #ddd !important;
        }
        .table > thead > tr > th {
            border: 1px solid #ddd !important;
        }
        .table-bordered > tbody > tr > td{
            border: 1px solid #ddd !important;
        }

        /*.main_bar {
            padding-bottom: 0px;
        }*/
        
        #sucMsg{
            text-align: center;
            margin: 15px 0px;
        }
        .selectList{
            /*text-align: center;*/
            /*margin-bottom: 20px;*/
        }
        .centerTxt{
            text-align: center;
        }
        .btn-default {
            color: #000;
            background-color: #F0F0F0;
            border-color: #46b8da;
        }
        .btn-default:hover {
            color: #000;
            background-color: #F0F0F0;
            border-color: #46b8da;
        }
        .btn-default.active, .btn-default:active, .open > .dropdown-toggle.btn-default {
            color: #000;
            background-color: #F0F0F0;
            border-color: #46b8da;
        }
        .btn-default.active.focus, .btn-default.active:focus, .btn-default.active:hover, .btn-default:active.focus, .btn-default:active:focus, .btn-default:active:hover, .open > .dropdown-toggle.btn-default.focus, .open > .dropdown-toggle.btn-default:focus, .open > .dropdown-toggle.btn-default:hover {
            color: #000;
            background-color: #F0F0F0;
            border-color: #46b8da;
        }
        .bootstrap-select .dropdown-toggle:focus, .bootstrap-select > select.mobile-device:focus + .dropdown-toggle {
            border-color: #46b8da;
        }
        .entrydatepicker{
            color: #000;
            background-color: #F0F0F0;
            border: 1px solid #46b8da;
            border-radius: 5px;
            padding: 6px 10px;
            font-size: 15px;
            position: relative;
            top: 2px;
        }
        .sumrow {
            border: 2px solid #ddd !important;
        }
        .optionSearch{

        }   
    </style>
    <script>        
        $(document).on('click','.btn_remove', function(){
            $('#sucMsg').html('');
            var button_id = $(this).attr("id");
            // alert(button_id);
            if(button_id == 1){

            } else{
              // alert("Data row removed successfully !");
              // $("#row"+button_id+"").remove();
              ConfirmDialog('Are you sure remove the row');
              function ConfirmDialog(message){
                  $('<div></div>').appendTo('body')
                                  .html('<div><h4>'+message+'?</h4></div>')
                                  .dialog({
                                      modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                      width: '40%', resizable: false,
                                      position: { my: "center", at: "center center-20%", of: window },
                                      buttons: {
                                          Yes: function () {
                                              $("#row"+button_id+"").remove();
                                              // $("#script-"+button_id+"").remove();
                                              $("#calculation-"+button_id+"").remove();
                                              // alert("Data row removed successfully !");

                                              $(this).dialog("close");
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
            }
            
        });

        $(document).on('click','.sgdDelete', function(event){                
              event.preventDefault();
              $('#sucMsg').html('');
              var dels_id = $(event.target).attr('data_dels_id');
              var debit_group_id = $(event.target).attr('debit_group_id');
              var entry_list_date = $(event.target).attr('entry_list_date');
              console.log(dels_id);
              console.log(debit_group_id);
              ConfirmDialog('Are you sure delete the row');
              function ConfirmDialog(message){
                  $('<div></div>').appendTo('body')
                                  .html('<div><h4>'+message+'?</h4></div>')
                                  .dialog({
                                      modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                      width: '40%', resizable: false,
                                      position: { my: "center", at: "center center-20%", of: window },
                                      buttons: {
                                          Yes: function () {   
                                            $(this).dialog("close");
                                            var url = window.location.href;
                                            var getId = url.split("?").pop();
                                            // alert(getId);
                                            $.get("add_single_group_data.php?dels_id="+dels_id, function(data, status){
                                                console.log(status);
                                                if(status == 'success'){
                                                    // window.location.href = 'add_vaucher_data_by_search.php?'+getId;
                                                    if(entry_list_date == ''){
                                                        getAllDebitGroupData(debit_group_id);
                                                    } else {
                                                        getNewEntryOfDebitAndDate(entry_list_date, debit_group_id);
                                                    }
                                                    $('#sucMsg').html('Data is deleted successfully !');
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
        function add_row(entryListDate){
            var i = 1;
            $('#add').click(function(){
              var group_name_placeholder = $('#group_name1').attr('placeholder');
              var group_description_placeholder = $('#group_description1').attr('placeholder');
              var taka_placeholder = $('#taka1').attr('placeholder');
              var pices_placeholder = $('#pices1').attr('placeholder');
              var total_tk_placeholder = $('#total_taka1').attr('placeholder');
              // var total_bill_placeholder = $('#total_bill1').attr('placeholder');
              var total_pay_placeholder = $('#pay1').attr('placeholder');
              var total_due_placeholder = $('#due1').attr('placeholder'); 

              i++;
              $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="entry_date[]" class="form-control" id="entry_date'+i+'" placeholder="dd-mm-yyyy" /></td><td><input type="text" name="group_name[]" class="form-control" size="100" id="group_name'+i+'" placeholder="'+group_name_placeholder+'"/></td><td><input type="text" name="group_description[]" class="form-control" size="100" id="group_description'+i+'" placeholder="'+group_description_placeholder+'"/></td><td><input type="text" name="taka[]" class="form-control tkCount calc'+i+'" size="40" id="taka'+i+'" placeholder="'+taka_placeholder+'"/></td><td><input type="text" name="pices[]" class="form-control calc'+i+'" size="40" id="pices'+i+'" placeholder="'+pices_placeholder+'"/></td><td><input type="text" name="total_taka[]" class="form-control" id="total_taka'+i+'" placeholder="'+total_tk_placeholder+'"/></td><td><input type="text" name="pay[]" class="form-control payCalc'+i+'"  id="pay'+i+'" placeholder="'+total_pay_placeholder+'"/></td><td><input type="text" name="due[]" class="form-control" id="due'+i+'" placeholder="'+total_due_placeholder+'"/></td><td class="centerTxt"><button type="button" name="add" id="add" class="btn btn-success disabled">+</button></td><td class="centerTxt"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');


                // <td><input type="text" name="total_bill[]" class="form-control" id="total_bill'+i+'" placeholder="'+total_bill_placeholder+'"/></td>
                // alert(entryListDate);
                if(entryListDate == 'new_entry' || entryListDate == 'undefined'){
                    // var datePicker = document.createElement("script");
                    // datePicker.innerHTML = '$(function() { $("#entry_date'+i+'").datepicker( {  onSelect: function(date) { $(this).change(); }, dateFormat: "dd/mm/yy", changeYear: true, }).datepicker("setDate", new Date()); });';
                    // datePicker.setAttribute("id", "script-"+i);
                    // $("body").append(datePicker);
                    // alert(entryListDate);
                    $("#entry_date"+i).datepicker({
                      onSelect: function(date) { $(this).change(); 
                      }, 
                      dateFormat: "dd/mm/yy", 
                      changeYear: true, })
                    .datepicker("setDate", new Date());
                } else {
                    // alert(entryListDate);
                    $("#entry_date"+i).datepicker({
                      onSelect: function(date) { $(this).change(); 
                      }, 
                      dateFormat: "dd/mm/yy", 
                      changeYear: true, })
                    .datepicker("setDate", new Date(entryListDate));
                }


                var calculation = document.createElement("script");
                calculation.innerHTML = '$(document).on("input", ".calc'+i+'", function(){var taka = $("#taka'+i+'").val();var pices = $("#pices'+i+'").val();var pay = $("#pay'+i+'").val();if(taka !== "" && pices !==""){var total_taka = taka * pices;$("#total_taka'+i+'").val(total_taka);$("#pay'+i+'").val(0);$("#due'+i+'").val(total_taka);} else {$("#total_taka'+i+'").val(0);$("#pay'+i+'").val(0);$("#due'+i+'").val(0);}});$(document).on("input", ".payCalc'+i+'", function(){var total_taka = $("#total_taka'+i+'").val();var pay = $("#pay'+i+'").val();if(total_taka !== "" && pay !==""){var due = total_taka - pay;$("#due'+i+'").val(due);}});';
                calculation.setAttribute("id", "calculation-"+i);
                $("body").append(calculation);

                heightSet();
          });
        }    

        $(document).on('change', '#groupNameList', function(){
            var seletedId = $('#groupNameList option:selected').val();
            $('#groupNameList').attr("isClickedKallol", "true");
            // alert(seletedId);
            removeScripts();
            if(seletedId === 'none'){
                window.location.href = "../vaucher/add_vaucher_data_by_search.php";
            } else {
                getAllDebitGroupData(seletedId);
                getDateAndForNewEntry(seletedId);
            }          
        });

        function getAllDebitGroupData(seletedId){
          $.ajax({
              url: '../ajaxcall_save_update/khoros_khat_name_wise_search_insert_update.php',
              type: 'post',
              data: {seletedId: seletedId},
              success: function(res){
                // alert(res);
                $('#changeContent').html(res);
                // alert($('#groupNameList').attr("isClickedKallol"));                
                if($('#groupNameList').attr("isClickedKallol")){
                    $('#sucMsg').html('');
                }
                    
                    if($('.main_bar').innerHeight() > $('.left_side_bar').height()){
                        heightSet();
                    } else {
                        $('.left_side_bar').height(800);
                    }

                    $('#entry_date1').datepicker( {
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd/mm/yy",
                        changeYear: true,
                    }).datepicker("setDate", new Date());

                    $(document).on('input', '.calc1', function(){
                        var taka = $('#taka1').val();
                        var pices = $('#pices1').val();
                        var pay = $('#pay1').val();
                        // alert(pices);
                        if(taka !== '' && pices !==''){
                            var total_taka = taka * pices;
                            $('#total_taka1').val(total_taka);
                            $('#pay1').val(0);
                            $('#due1').val(total_taka);
                        } else  {
                            $('#total_taka1').val(0);
                            $('#pay1').val(0);
                            $('#due1').val(0);
                        }
                    });
                    $(document).on('input', '.payCalc1', function(){
                        var total_taka = $('#total_taka1').val();
                        var pay = $('#pay1').val();
                        if(total_taka !== '' && pay !==''){
                            var due = total_taka - pay;
                            $('#due1').val(due);
                        }
                    });
                    add_row();                    
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
        }

        function getDateAndForNewEntry(seletedId){
          $.ajax({
              url: '../ajaxcall_save_update/debit_entry_date_and_new.php',
              type: 'post',
              data: {seletedId: seletedId},
              success: function(res){
                // alert(res);
                $('#newEntryStyle').html(res);
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
        }
        function heightSet(){
              $('.left_side_bar').height($('.main_bar').innerHeight() + 34);            
        }
    </script>
    <script type="text/javascript">
        function removeScripts(){
            // $('script[id^="script-"]').each(function() {
            //     // alert( this.id );
            //     $(this).remove();
            // });
            $('script[id^="calculation-"]').each(function() {
                // alert( this.id );
                $(this).remove();
            });
        }
        $(document).on('change', '#newAndDateList', function(){
            var entryList = $('#newAndDateList option:selected').val();
            var seletedGroupId = $('#groupNameList option:selected').val();
            // alert(seletedGroupId);
            removeScripts();

            if(entryList == 'none'){
                getAllDebitGroupData(seletedGroupId);
            } else {
                // get new_entry or date working here
                getNewEntryOfDebitAndDate(entryList, seletedGroupId);
            }      
        });

        function getNewEntryOfDebitAndDate(entryList, seletedGroupId){
            $.ajax({
                url: '../ajaxcall_save_update/new_entry_date_show_debit_group_data.php',
                type: 'post',
                data: {
                    entryList: entryList,                
                    seletedGroupId: seletedGroupId               
                },
                success: function(res){
                    // alert(res);
                    $('#changeContent').html(res);
                    $('#sucMsg').html('');
                    
                    if($('.main_bar').innerHeight() > $('.left_side_bar').height()){
                        heightSet();
                    } else {
                        $('.left_side_bar').height(800);
                    }

                    // console.log('111',new Date(entryList));
                    $('#entry_date1').datepicker( {
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd/mm/yy",
                        changeYear: true,
                    }).datepicker("setDate", new Date(entryList));
                    
                    add_row(entryList);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    </script>
    <script type="text/javascript">
        // $(document).on('click', '#insertUpdate', function(){
        //     var operationName = $('#insertUpdate').val();
        //     alert(operationName);
        //     if(operationName === 'Submit'){                
        //         insertUpdateDebitGroupData(seletedId);
        //     } else {

        //     }          
        // });

        // function insertUpdateDebitGroupData(seletedId){
        //     var urlText = '../ajaxcall_save_update/debit_group_data_insert_update.php';
        //     $.ajax({
        //         url: urlText,
        //         type: 'post',
        //         data: {seletedId: seletedId},
        //         success: function(res){
        //             // alert(res);
        //             $('#sucMsg').html(res);
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             console.log(textStatus, errorThrown);
        //         }
        //     });
        // }
    </script>
</head>
<body>
    <?php
        include '../navbar/header_text.php';
        include '../navbar/navbar.php';
    ?>
    <div class="container">          
    </div>

    <div class="bar_con">
        <div class="left_side_bar">
            <?php require '../others_page/left_menu_bar.php'; ?>
        </div>
        <div class="main_bar">
            <?php
                $query = "SELECT * FROM project_heading WHERE id = '$project_name_id'";
                $show = $db->select($query);
                if ($show) {
                    while ($rows = $show->fetch_assoc()) {
                ?>
                    <div class="project_heading">      
                        <h2 class="headingOfAllProject">
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">খরচ খাত এন্ট্রি</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                            
                        </h2>
                    </div>
                <?php 
                    }
                } 
            ?>

            <div class="selectList">
                খরচ খাতের হেডার নির্বাচন করুনঃ                
                <select class="selectpicker" id="groupNameList">                    
                    <option value="none">Select...</option>
                    <!-- <option value="search" style="position: relative;">a
                        <input type="text" id="gnlSearch" class="optionSearch" style="position: absolute; left: 0; top: 0;">
                    </option> -->
                    <?php
                        $query = "SELECT id, group_name FROM debit_group WHERE project_name_id = '$project_name_id'";
                        $show = $db->select($query);
                        if($show){
                            while($rows = $show->fetch_assoc()) {
                                $id = $rows['id'];
                                $group_name = $rows['group_name'];
                                echo '<option value="' . $id . '">' . $group_name . '</option>';
                            }
                        }
                    ?>
                </select>
                <span id="newEntryStyle">
                </span>
            </div>
            <h4 class="sugMsg text-success" id="sucMsg"><?php echo $sucMsg; ?></h4>

            <div class="" id="changeContent">                
            </div>
            
        </div>
    </div>
    <script type="text/javascript">
        // function validation(){
        //   var validReturn = false;
          
        //   var nameid1         = $('#group_name1').attr('placeholder');
        //   var descriptionid1  = $('#group_description1').attr('placeholder');
        //   var takaid1         = $('#taka1').attr('placeholder');
        //   var picesid1        = $('#pices1').attr('placeholder');

        //   $( ".tkCount" ).each(function() {
        //       // var id = $( this ).attr( "id" );
        //       var idNo = this.id.match(/\d+/);
        //       // alert(idNo);

        //       var group_name        = $('#group_name'+idNo).val();
        //       var group_description = $('#group_description'+idNo).val();
        //       var taka              = $('#taka'+idNo).val();
        //       var pices             = $('#pices'+idNo).val();
        //       var total_taka        = $('#total_taka'+idNo).val();
        //       var total_bill        = $('#total_bill'+idNo).val();
        //       var pay               = $('#pay'+idNo).val();
        //       var due               = $('#due'+idNo).val();


        //         if(group_name == ""){
        //               alert(nameid1 + " ফাঁকা হবে না !");
        //               $('#group_name'+idNo).focus();
        //               validReturn = false;
        //               return false;
        //           } else if($.isNumeric(group_name)){
        //               alert(nameid1 + " সংখ্যা হবে না !");
        //               $('#group_name'+idNo).focus();
        //               validReturn = false;
        //               return false;
        //           } else if(group_name.length > 40){
        //               alert(nameid1 + " ৪০ অক্ষরের বেশী হবে না !");
        //               $('#group_name'+idNo).focus();
        //               validReturn = false;
        //               return false;
        //           } else {
        //               if(group_description == ""){
        //                   alert(descriptionid1 + " ফাঁকা হবে না !");
        //                   $('#group_description'+idNo).focus();
        //                   validReturn = false;
        //                   return false;
        //               } else if($.isNumeric(group_description)){
        //                   alert(descriptionid1 + " সংখ্যা হবে না !");
        //                   $('#group_description'+idNo).focus();
        //                   validReturn = false;
        //                   return false;
        //               } else if(group_name.length > 40){
        //                 alert(descriptionid1 + " ৪০ অক্ষরের বেশী হবে না !");
        //                 $('#group_description'+idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //               } else{
        //                   if(taka == ""){                        
        //                       alert(takaid1 + " ফাঁকা হবে না !");
        //                       $('#taka'+idNo).focus();
        //                       validReturn = false;
        //                       return false;
        //                   } else if(!$.isNumeric(taka)){
        //                       alert(takaid1 + " সংখ্যা হতে হবে !");
        //                       $('#taka'+idNo).focus();
        //                       validReturn = false;
        //                       return false;
        //                   } else{
        //                       if(pices == ""){
        //                           alert(picesid1 + " ফাঁকা হবে না !");
        //                           $('#pices'+idNo).focus();
        //                           validReturn = false;
        //                           return false;
        //                       } else if(!$.isNumeric(pices)){
        //                           alert(picesid1 + " সংখ্যা হতে হবে !");
        //                           $('#pices'+idNo).focus();
        //                           validReturn = false;
        //                           return false;
        //                       } else{
        //                             validReturn = true;
        //                             // if(total_taka == ""){
        //                             //     alert("মোট টাকাঃ ফাঁকা হবে না !");
        //                             //     $('#total_taka'+idNo).focus();
        //                             //     validReturn = false;
        //                             //     return false;
        //                             // } else if(!$.isNumeric(total_taka)){
        //                             //     alert("মোট টাকাঃ সংখ্যা হতে হবে !");
        //                             //     $('#total_taka'+idNo).focus();
        //                             //     validReturn = false;
        //                             //     return false;
        //                             // } else{
                                          
        //                                   // if(total_bill == ""){
        //                                   //     alert("নগদ পরি‌ষদ ফাঁকা হবে না !");
        //                                   //     $('#total_bill'+idNo).focus();
        //                                   //     validReturn = false;
        //                                   //     return false;
        //                                   // } else if(!$.isNumeric(total_bill)){
        //                                   //     alert("নগদ পরি‌ষদ সংখ্যা হতে হবে !");
        //                                   //     $('#total_bill'+idNo).focus();
        //                                   //     validReturn = false;
        //                                   //     return false;
        //                                   // } else if(total_bill.length > 15){
        //                                   //     alert("নগদ পরি‌ষদ ১৫ অক্ষরের বেশী হবে না !");
        //                                   //     $('#total_bill'+idNo).focus();
        //                                   //     validReturn = false;
        //                                   //     return false;
        //                                   // } else{
        //                                   //     if(pay == ""){
        //                                   //         alert("জমা ফাঁকা হবে না !");
        //                                   //         $('#pay'+idNo).focus();
        //                                   //         validReturn = false;
        //                                   //         return false;
        //                                   //     } else if(!$.isNumeric(pay)){
        //                                   //         alert("জমা সংখ্যা হতে হবে !");
        //                                   //         $('#pay'+idNo).focus();
        //                                   //         validReturn = false;
        //                                   //         return false;
        //                                   //     } else{
        //                                   //           if(due == ""){
        //                                   //               alert("জের ফাঁকা হবে না !");
        //                                   //               $('#due'+idNo).focus();
        //                                   //               validReturn = false;
        //                                   //               return false;
        //                                   //           } else if(!$.isNumeric(due)){
        //                                   //               alert("জের সংখ্যা হতে হবে!");
        //                                   //               $('#due'+idNo).focus();
        //                                   //               validReturn = false;
        //                                   //               return false;
        //                                   //           } else{
        //                                   //               validReturn = true;
        //                                   //           }
        //                                   //     }
        //                                   // }
        //                             //}
        //                       }
        //                   }
        //               }
        //         }

        //   });

        //   if(validReturn){
        //     return true;
        //   } else {
        //     return false;
        //   }
        // }

        if($('.main_bar').innerHeight() > $('.left_side_bar').height()){
            $('.left_side_bar').height($('.main_bar').innerHeight() + 34);
        } else {
            $('.left_side_bar').height(550);
        }        
    </script>
    <script type="text/javascript">
        var pageload = "<?php echo $_SESSION['Pageload']; ?>";
        // alert(pageload);
        if(pageload !== 'NewLoad'){
            var get_debit_group_id = "<?php echo $_SESSION['get_debit_group_id']; ?>";
            getAllDebitGroupData(get_debit_group_id);            
            getDateAndForNewEntry(get_debit_group_id);
            $('#groupNameList').val(get_debit_group_id);
        }
    </script>
</body>
</html>


