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


    // if (isset($_POST['set'])) {
    //     $_SESSION['Pageload'] = 'AfterReload';
    //     //print_r($_POST);
    //     $pay_due_total = $_POST['pay_due_total'];
    //     $get_debit_group_id = $_POST['get_debit_group_id'];
    //     $_SESSION['get_debit_group_id'] = $get_debit_group_id;
    //     $g_id      = $_POST['id'];

    //     if ($g_id>0) {
    //         $query = "UPDATE debit_group_data SET group_pay='$pay_due_total', group_id='$get_debit_group_id' WHERE id = $g_id";
    //         $update = $db->update($query);
    //         if ($update) {
    //           // echo "<script>window.location.href = 'add_single_group_data.php?add_id=$get_id'</script>";
    //           // echo "<script>window.location.href = 'add_vaucher_data_by_search.php'</script>";
    //         } else {
    //           echo "<script>alert('Data is not inserted !')</script>";
    //         }
    //     }      
    // }


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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
    <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
        .select2-container .select2-selection--single{
            height:34px !important;
        }
        .select2-container--default .select2-selection--single{
                 border: 1px solid #46b8da !important; 
             /*border-radius: 0px !important; */
        } 
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #000;
            line-height: 34px;
            
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
          height: 32px;
          color: #000 !important;
        }
        .select2-container--default{
            width: 220px !important;
        }
        .edit_data{
            height: calc(100% + 50px);
            width: 100%;
            background-color: rgba(0,0,0,.5);
            /*z-index: 99999;*/
            position: fixed;
            left: 0;
            top: 0;
            transition: all .4s;
            display: none;
        }
        .innerdiv{
            width: 80%;
            left: 50%;
            margin-left: -40%;
            position: relative;
            top: 154px;
            /*height: 50px;*/
            background-color: #fff;
            border-radius: 5px;
            padding: 25px;
        }
        .closeImg{
            height: 25px;
            width: 25px;
            display: block;
            position: absolute;
            right: 0px;
            top: 0px;
            cursor: pointer;
            border-radius: 5px;
        }
        .edit_data_header{
            height: calc(100% + 50px);
            width: 100%;
            background-color: rgba(0,0,0,.5);
            /*z-index: 99999;*/
            position: fixed;
            left: 0;
            top: 0;
            transition: all .4s;
            display: none;
        }
        .innerdiv_header{
            width: 80%;
            left: 50%;
            margin-left: -40%;
            position: relative;
            top: 154px;
            /*height: 50px;*/
            background-color: #fff;
            border-radius: 5px;
            padding: 25px;
        }
        .closeImg_header{
            height: 25px;
            width: 25px;
            display: block;
            position: absolute;
            right: 0px;
            top: 0px;
            cursor: pointer;
            border-radius: 5px;
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
                ConfirmDialog('Are you sure remove the row?');
                function ConfirmDialog(message){
                    $('<div></div>').appendTo('body')
                                    .html('<div><h4>'+message+'</h4></div>')
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

        $(document).on('click', '.sgdDelete', function(event){          
            var dels_id = $(event.target).attr('data_dels_id');
            var debit_group_id = $(event.target).attr('debit_group_id');
            var entry_list_date = $(event.target).attr('entry_list_date');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("data_dels_id", dels_id).attr("debit_group_id", debit_group_id).attr("entry_list_date", entry_list_date);
        });

        $(document).on('click', '#verifyToDeleteBtn', function(event){                
              event.preventDefault();
              $('#sucMsg').html('');
              var dels_id = $(event.target).attr('data_dels_id');
              var debit_group_id = $(event.target).attr('debit_group_id');
              var entry_list_date = $(event.target).attr('entry_list_date');
              console.log(dels_id); console.log(debit_group_id);
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
                          ConfirmDialog('Are you sure to delete khoros khat entry?');
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
                                                    $('#groupNameList').removeAttr('isclickedkallol');
                                                    // alert('hi');
                                                    $('#sucMsg').html('Data is deleted successfully !');
                                                    // $('#groupNameList').attr('isclickedkallol', 'true');
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
                // getAllDebitGroupData(seletedId);  //Temprary off call for loading problem
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
                    // $('#groupNameList').attr("isClickedKallol", "true");                    
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
                      $('#newAndDateList').select2().on('select2:open', function(e){
                          $('.select2-search__field').attr('placeholder', 'Search...');
                      });
                  $('#newAndDateList').val('new_entry').trigger('change');             
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
            $("#sucMsg").html('');

            if(entryList == 'none'){
                getAllDebitGroupData(seletedGroupId);
            } else {
                // get new_entry or date select2 box working here
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
                    if($('#groupNameList').attr("isClickedKallol")){
                        $('#sucMsg').html('');
                    }
                    
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
                    
                    $(document).on('input', '.calc1', function(){
                        // alert('asdfasdf');
                        var taka = $('#taka1').val();
                        var pices = $('#pices1').val();
                        // var pay = $('#pay1').val();
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

                    add_row(entryList);
                    // $('#groupNameList').attr("isClickedKallol", "true");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(document).on('click', '#submitBtn', function(){
            var groupNameList = $('#groupNameList option:selected').val();
            var newAndDateList = $('#newAndDateList option:selected').val();
            // alert(groupNameList + " " + newAndDateList);

            var urlText = '../ajaxcall_save_update/debit_group_data_insert.php';
            var formElement = $('#inputDataForm')[0];
            var formData = new FormData(formElement);
            $.ajax({
                url: urlText,
                type: 'post',
                dataType: 'html',
                processData: false,
                contentType: false,
                data: formData,
                success: function(res){
                    // alert(res);
                    $('#groupNameList').removeAttr("isClickedKallol");
                    if(groupNameList != 'none' && newAndDateList == 'none'){
                        getAllDebitGroupData(groupNameList);
                        $('#sucMsg').html(res); 
                    } else if(groupNameList != 'none' && newAndDateList == 'new_entry'){
                        getNewEntryOfDebitAndDate(newAndDateList, groupNameList);
                        // $("#newAndDateList").val('none').trigger('change');
                        $('#sucMsg').html(res);
                    } else if(groupNameList != 'none' && (newAndDateList != 'none' || newAndDateList != 'new_entry')){
                        getNewEntryOfDebitAndDate(newAndDateList, groupNameList);
                        // $("#newAndDateList").val('none').trigger('change');
                        $('#sucMsg').html(res); 
                    }                                       
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });     
        });

        // function insertDebitGroupDataOnHeader(groupNameListId){
        //     var urlText = '../ajaxcall_save_update/debit_group_data_insert.php';
        //     var formElement = $('#inputDataForm')[0];
        //     var formData = new FormData(formElement);
        //     $.ajax({
        //         url: urlText,
        //         type: 'post',
        //         dataType: 'html',
        //         processData: false,
        //         contentType: false,
        //         data: formData,
        //         success: function(res){
        //             // alert(res);
        //             getAllDebitGroupData(groupNameListId);
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
                <select id="groupNameList" class="" >                    
                    <option value="none">Select...</option>
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

        <div class="edit_data" id="edit_data">
            <div class="innerdiv">
                <img src="../img/logo/close.png" class="closeImg">
                <div class="" id="ajax_data">
                </div>
            </div>
        </div>

        <div class="edit_data_header" id="edit_data_header">
            <div class="innerdiv_header">
                <img src="../img/logo/close.png" class="closeImg_header">
                <div class="" id="ajax_data_header">
                </div>
            </div>
        </div>
    </div>

    <?php include '../others_page/delete_permission_modal.php';  ?>
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
        // var pageload = "<?php //echo $_SESSION['Pageload']; ?>";
        // // alert(pageload);
        // if(pageload !== 'NewLoad'){
            // var get_debit_group_id = "<?php //echo $_SESSION['get_debit_group_id']; ?>";
        //     getAllDebitGroupData(get_debit_group_id);            
        //     getDateAndForNewEntry(get_debit_group_id);
        //     $('#groupNameList').val(get_debit_group_id);
        // }
    </script>
    <script type="text/javascript">
      // $("#groupNameList").select2();
      $('#groupNameList').select2().on('select2:open', function(e){
          $('.select2-search__field').attr('placeholder', 'Search...');
      });
    </script>
    <script type="text/javascript">
        function load_row(element){
            var edit_id = $(element).attr('edit_id');
            var dataset_id = $(element).attr('dataset_id');                      
            console.log(edit_id + " "+ dataset_id);
            $('#groupNameList').removeAttr("isClickedKallol");

            $.ajax({
                url: '../ajaxcall_save_update/header_khat_entry_load.php',
                type: 'post',
                data: {
                    edit_id: edit_id,                
                    dataset_id: dataset_id               
                },
                success: function(res){
                    // alert(res);
                    $('#ajax_data').html(res);
                    $('#edit_data').show().height($('html').height());
                    $('#sucMsg').html(''); 
                    $("#entry_date").datepicker({
                        onSelect: function(date) { $(this).change(); 
                        }, 
                        dateFormat: "dd/mm/yy", 
                        changeYear: true, });
                    $(document).on('input', '.calc1', function(){
                        var taka = $('#group_taka').val();
                        var pices = $('#group_pices').val();
                        // var pay = $('#pay1').val();
                        // alert(pices);
                        if(taka !== '' && pices !==''){
                            var total_taka = taka * pices;
                            $('#group_total_taka').val(total_taka);
                            $('#group_pay').val(0);
                            $('#group_due').val(total_taka);
                        } else  {
                            $('#group_total_taka').val(0);
                            $('#group_pay').val(0);
                            $('#group_due').val(0);
                        }
                    });
                    $(document).on('input', '.payCalc1', function(){
                        var total_taka = $('#group_total_taka').val();
                        var pay = $('#group_pay').val();
                        if(total_taka !== '' && pay !==''){
                            var due = total_taka - pay;
                            $('#group_due').val(due);
                        }
                    });                 
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        function update_row(element){
            var edit_id = $(element).attr('edit_id');
            var dataset_id = $(element).attr('dataset_id');
            console.log(edit_id + " " + dataset_id);

            var entry_date = $("#ajax_data table").find('tr:eq(1)').find('td:eq(0)').find('#entry_date').val();
            var group_name = $("#ajax_data table").find('tr:eq(1)').find('td:eq(1)').find('#group_name').val();
            var group_description = $("#ajax_data table").find('tr:eq(1)').find('td:eq(2)').find('#group_description').val();
            var group_taka = $("#ajax_data table").find('tr:eq(1)').find('td:eq(3)').find('#group_taka').val();
            var group_pices = $("#ajax_data table").find('tr:eq(1)').find('td:eq(4)').find('#group_pices').val();
            var group_total_taka = $("#ajax_data table").find('tr:eq(1)').find('td:eq(5)').find('#group_total_taka').val();
            var group_pay = $("#ajax_data table").find('tr:eq(1)').find('td:eq(6)').find('#group_pay').val();
            var group_due = $("#ajax_data table").find('tr:eq(1)').find('td:eq(7)').find('#group_due').val();


            // console.log(entry_date," ", group_name," ", group_description," ", group_taka," ", group_pices," ", group_total_taka," ", group_pay," ", group_due);
            $.ajax({
                url: '../ajaxcall_save_update/header_khat_entry_update.php',
                type: 'post',
                data: {
                    edit_id: edit_id,                
                    // dataset_id: dataset_id,               
                    entry_date: entry_date,               
                    group_name: group_name,               
                    group_description: group_description,               
                    group_taka: group_taka,               
                    group_pices: group_pices,               
                    group_total_taka: group_total_taka,               
                    group_pay: group_pay,              
                    group_due: group_due,             
                },
                success: function(res){
                    // alert(res);
                    // getAllDebitGroupData(group_id);   
                    var groupNameList = $('#groupNameList option:selected').val();
                    var newAndDateList = $('#newAndDateList option:selected').val();

                    if(groupNameList != 'none' && newAndDateList == 'none'){
                        getAllDebitGroupData(groupNameList);
                        $('#sucMsg').html(res); 
                    } else if(groupNameList != 'none' && newAndDateList == 'new_entry'){
                        getNewEntryOfDebitAndDate(newAndDateList, groupNameList);
                        // $("#newAndDateList").val('none').trigger('change');
                        $('#sucMsg').html(res);
                    } else if(groupNameList != 'none' && (newAndDateList != 'none' || newAndDateList != 'new_entry')){
                        getNewEntryOfDebitAndDate(newAndDateList, groupNameList);
                        // $("#newAndDateList").val('none').trigger('change');
                        $('#sucMsg').html(res); 
                    }

                    // $('#sucMsg').html(res); 
                    $('#edit_data').hide();             
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        $(document).on('click', '.closeImg', function(){
            $('#edit_data').hide();
        });
        $(document).on('click', '.closeImg_header', function(){
            $('#edit_data_header').hide();
        });

        function load_header_for_edit(ele){
            var group_id = $(ele).attr('group_id');
            // alert(group_id);
            $.ajax({
                url: '../ajaxcall_save_update/debit_group_header_load.php',
                type: 'post',
                data: {
                    group_id: group_id           
                },
                success: function(res){
                    // alert(res);
                    $('#ajax_data_header').html(res);
                    $('#edit_data_header').show();

                    $("#group_date").datepicker({
                        onSelect: function(date) { $(this).change(); 
                    }, 
                    dateFormat: "dd/mm/yy", 
                    changeYear: true, });

                    // getAllDebitGroupData(group_id);
                    // $('#sucMsg').html(res); 
                    // $('#edit_data').hide();             
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        function update_row_header(element){
            var group_id = $(element).attr('group_id');
            console.log(group_id);

            var group_date = $("#ajax_data_header table").find('tr:eq(1)').find('td:eq(0)').find('#group_date').val();
            var group_name = $("#ajax_data_header table").find('tr:eq(1)').find('td:eq(1)').find('#group_name').val();
            var group_description = $("#ajax_data_header table").find('tr:eq(1)').find('td:eq(2)').find('#group_description').val();
            var taka = $("#ajax_data_header table").find('tr:eq(1)').find('td:eq(3)').find('#taka').val();
            var pices = $("#ajax_data_header table").find('tr:eq(1)').find('td:eq(4)').find('#pices').val();
            var total_taka = $("#ajax_data_header table").find('tr:eq(1)').find('td:eq(5)').find('#total_taka').val();
            var pay = $("#ajax_data_header table").find('tr:eq(1)').find('td:eq(6)').find('#pay').val();
            var due = $("#ajax_data_header table").find('tr:eq(1)').find('td:eq(7)').find('#due').val();

            // console.log(group_date," ", group_name," ", group_description," ", taka," ", pices," ", total_taka," ", pay," ", due);



            $.ajax({
                url: '../ajaxcall_save_update/header_update.php',
                type: 'post',
                data: {
                    group_id: group_id,               
                    group_date: group_date,               
                    group_name: group_name,               
                    group_description: group_description,               
                    taka: taka,               
                    pices: pices,               
                    total_taka: total_taka,               
                    pay: pay,              
                    due: due,             
                },
                success: function(res){
                    // alert(res);
                    // getAllDebitGroupData(group_id);   
                    var groupNameList = $('#groupNameList option:selected').val();
                    var newAndDateList = $('#newAndDateList option:selected').val();


                    if(groupNameList != 'none' && newAndDateList == 'none'){
                        getAllDebitGroupData(groupNameList);
                        $('#sucMsg').html(res); 
                    } else if(groupNameList != 'none' && newAndDateList == 'new_entry'){
                        getNewEntryOfDebitAndDate(newAndDateList, groupNameList);
                        // $("#newAndDateList").val('none').trigger('change');
                        $('#sucMsg').html(res);
                    } else if(groupNameList != 'none' && (newAndDateList != 'none' || newAndDateList != 'new_entry')){
                        getNewEntryOfDebitAndDate(newAndDateList, groupNameList);
                        // $("#newAndDateList").val('none').trigger('change');
                        $('#sucMsg').html(res); 
                    }

                    $("#groupNameList option:selected").text(group_name);
                    $("#groupNameList").select2();
                    $('#groupNameList').removeAttr("isClickedKallol");                    
                    // $('#sucMsg').html(res); 
                    $('#edit_data_header').hide();
                         
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }



        // var draggable = $('.innerdiv_header');

        // draggable.on('mousedown', function(e){
        //   var dr = $(this).addClass("drag").css("cursor","move");
        //   height = dr.outerHeight();
        //   width = dr.outerWidth();
        //   ypos = dr.offset().top + height - e.pageY,
        //   xpos = dr.offset().left + width - e.pageX;
        //   $(document.body).on('mousemove', function(e){
        //     var itop = e.pageY + ypos - height;
        //     var ileft = e.pageX + xpos - width;
        //     if(dr.hasClass("drag")){
        //       dr.offset({top: itop,left: ileft});
        //     }
        //   }).on('mouseup', function(e){
        //       dr.removeClass("drag");
        //   });
        // });
    </script>
    <script type="text/javascript">
        $(document).on("click", ".kajol_close, .cancel", function(){
            $("#verifyPasswordModal").hide();
        });
    </script>
    <script type="text/javascript">
       $("#groupNameList").val($("#groupNameList option:eq(1)").val()).trigger('change');
    </script>
    <script src="../js/common_js.js"> </script>
</body>
</html>


