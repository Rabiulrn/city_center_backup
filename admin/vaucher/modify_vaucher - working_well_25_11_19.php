<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php'); 
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $_SESSION['pageName'] = 'modify_data';

    $project_name_id = $_SESSION['project_name_id'];

    //delete data section
 

    if (isset($_GET['del_id'])) {
      $visibility = 0;
      $del = $_GET['del_id'];
      $query = "DELETE FROM debit_group WHERE id = $del";
      $delete = $db->delete($query);

      $query2 = "DELETE FROM debit_group_data WHERE group_id = $del";
      $delete2 = $db->delete($query2);
      //If else not effect
      if ($delete && $delete2) {
        // echo "<script>alert('Data Deleted Successfully!');</script>";
        // echo "<script>window.location.href = 'modify_vaucher.php'</script>";
      } else {
        // echo "<script>alert('Failed to Delete Data!');</script>";
      }
    }

    if (isset($_GET['remove_id'])) {
      $visibility = 0;
      $del = $_GET['remove_id'];
      $query = "DELETE FROM jara_pabe WHERE pabe_id = $del";
      $delete = $db->delete($query);
      //if else provide no effect 
      if ($delete) {
          // echo "<script>alert('Data Deleted Successfully!');</script>";
          // echo "<script>window.location.href = 'modify_vaucher.php'</script>";
          $sql = "DELETE FROM entry_jara_pabe WHERE jara_pabe_id ='$del' AND project_name_id = '$project_name_id'";
          $del2 = $db->delete($sql);
      } else {
          // echo "<script>alert('Failed to Delete Data!');</script>";
      }
    }

    if (isset($_GET['delete_id'])) {
        $visibility = 0;
        $del = $_GET['delete_id'];
        $query = "DELETE FROM nij_paonadar WHERE id = '$del'";
        $delete = $db->delete($query);
        //if else provide no effect 
        if ($delete) {
            // echo "<script>alert('Data Deleted Successfully!');</script>";
            // echo "<script>window.location.href = 'modify_vaucher.php'</script>";
            $sql = "DELETE FROM entry_nij_paonadar WHERE nij_paonadar_id ='$del' AND project_name_id = '$project_name_id'";
            $del2 = $db->delete($sql);
        } else {
            // echo "<script>alert('Failed to Delete Data!');</script>";
        }
    }

    if (isset($_GET['trash_id'])) {
        $visibility = 0;
        $del = $_GET['trash_id'];
        $query = "DELETE FROM vaucher_credit WHERE id = $del";
        $delete = $db->delete($query);

        //if else provide no effect 
        if ($delete) {
            echo "<script>alert('Data Deleted Successfully!');</script>";
            echo "<script>window.location.href = 'modify_vaucher.php'</script>";
        } else {
            echo "<script>alert('Failed to Delete Data!');</script>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modify Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/voucher.css?v=2.0.0">
    <link rel="stylesheet" href="../css/doinik_hisab.css?v=2.0.0">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <style type="text/css">
        .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
          border: 1px solid #ccc !important;
        }
        body {
          font-weight: normal !important;
          color : black;
          font-size: 12px;
        }
        .table>tbody>tr.success>td, .table>tbody>tr.success>th, .table>tbody>tr>td.success, .table>tbody>tr>th.success, .table>tfoot>tr.success>td, .table>tfoot>tr.success>th, .table>tfoot>tr>td.success, .table>tfoot>tr>th.success, .table>thead>tr.success>td, .table>thead>tr.success>th, .table>thead>tr>td.success, .table>thead>tr>th.success {
            background-color: #373737 !important;
            color: #d0d0d0;
            vertical-align: middle;
            font-size: 13px;
           -webkit-print-color-adjust: exact;
        }
         .table>tbody>tr.active>td, .table>tbody>tr.active>th, .table>tbody>tr>td.active, .table>tbody>tr>th.active, .table>tfoot>tr.active>td, .table>tfoot>tr.active>th, .table>tfoot>tr>td.active, .table>tfoot>tr>th.active, .table>thead>tr.active>td, .table>thead>tr.active>th, .table>thead>tr>td.active, .table>thead>tr>th.active {
              background-color: #959595 !important;
              color: #000;
              text-align: center;
              font-size: 13px;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
          padding: 5px;
        }
        .width_5px{
          width: 5px;
        }
        .width_35px{
          width: 35px;
        }
        .width_85px{
          width: 85px;
        }
        .width_100px{
          width: 100px;
        }
        .width_200px{
          width: 200px;
          max-width: 200px;
        }
        .width_300px{
          width: 300px;
          max-width: 300px;
        }
        /*#modify_vaucher_date_lists*/
        .bootstrap-select{
            height: 34px;
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 5px;
            position: relative;
            /*margin-bottom: 15px;*/
        }
        .bootstrap-select .dropdown-toggle{
          position: absolute;
          top: 0px;
          left: 0px;
        }
        .headingDateUpdateCon{
          /*border: 1px solid red;*/
          position: relative;
          height: 32px;
          margin-bottom: 10px;}
        .backcircle{
          font-size: 18px;
          position: absolute;
          margin-top: -35px;
        }
        .backcircle a:hover{
          text-decoration: none !important;
        }
        .btn-info {
          color: #000;
          background-color: #F0F0F0;
          border-color: #46b8da;
        }
        .btn-info:hover {
          color: #000;
          background-color: #F0F0F0;
          border-color: #46b8da;
        }
        .btn-info:focus {
          color: #000;
          background-color: #F0F0F0;
          border-color: #46b8da;
        }
        .btn-info.active, .btn-info:active, .open > .dropdown-toggle.btn-info {
            color: #000;
            background-color: #F0F0F0;
            border-color: #46b8da;
        }
        .dropdown-toggle.btn-info:hover {
            color: #000 !important;
            background-color: #F0F0F0 !important;
            border-color: #46b8da;
        }
        #dateWiseDelete{
            display: none;
            margin-left: 10px;
        }
        .main_bar {padding-bottom: 50px;}
        .first_view{
            /*background-color: #eee;*/
            height: 340px;
            font-size: 25px;
            color: #575757;
            vertical-align: middle !important;
            font-weight: normal;
            text-align: center;
        }
        #showAllDatesAllData{
            margin-left: 10px;
            display: none;
        }
        #modify_search{
            width: 240px;
            float: right;
            /*position: relative;
            right: -440px;*/
        }
        .select2-container .select2-selection--single{
            height:34px !important;
        }
        .select2-container--default .select2-selection--single{
                 border: 1px solid #46b8da !important;
                 background-color: #F0F0F0;
             /*border-radius: 0px !important; */
        } 
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #000;
            font-size: 14px;
            line-height: 34px;        
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
          height: 32px;
          color: #000 !important;
        }
        .select2-container--default{
            width: 240px !important;
        }
        .select2-container {
            margin-left: 10px;
        }
        .select2-dropdown {
            margin-left: -10px;
            font-size: 14px;
            /*color: #464646;*/
        }
        #verifyPasswordModal{
            display: none;
            position: fixed;
            background: rgba(0,0,0,.6);
            height: 100%;
            width: 100%;
            top: 0px;
        }
        .kajol-dialog{
           width: 40%;
           min-height: 20px;
           /*border: 1px solid red;*/
           border-radius: 5px;
           position: relative;
           left: 50%;
           margin-left: -20%;
           top: 140px;
           background-color: #fff;
        }
        .kajol-title{
            margin: 0px;
            padding: 15px;
        }
        .kajol_close{
            color:
            red;
            font-size: 30px;
            line-height: 24px;
            filter: alpha(opacity=70);
            opacity: 0.7;
            margin: 12px;
        }
        .kajol-body{
            padding: 15px;

        }
        .kajol-footer{
           padding: 15px;
           padding-top: 0px;
        }
        .cancel {
            float: right;
        }
        #loader_img{
            left: 50%;
            position: absolute;
            top: 170px;
            z-index: 99999999999999;
            display: none;
        }
        .dataTables_wrapper .dataTables_filter input {
              margin-left: 0.5em;
              background-color:  #373737;
              color: #fff;
              border: 1px solid #000;
              padding: 0px 10px;
          }
    </style>
    <script>
        function myFunction() {
            window.print();
        }
    </script>
    <script type="text/javascript">
        $(document).on('change', '#headerGroupNameList', function(){
            var groupid = $(this).children("option:selected").val();
            var search_date = $("#modify_vaucher_date_lists option:selected").val();

            if(search_date == 'alldates' && groupid == 'none') {
                getAllMvData_last10();
                $('#dateWiseDelete').css('display', 'none');
                $('#showAllDatesAllData').css('display', 'inline-block');
                $("#biboronCon").html('');
            } else if(search_date == 'alldates' && groupid != 'none'){
                // show_only_khoros_khat_wise_data(search_date, khotos_khat_id);
                // show_biboron_list(search_date, khotos_khat_id);
                // alert('nnnnnnn');

                getGroupWiseOnlyGroupedData(search_date, groupid);                
                show_biboron_list(search_date, groupid);
                $('#showAllDatesAllData').css('display', 'inline-block');
                $('#dateWiseDelete').css('display', 'none');
            } else if(search_date != 'alldates' && groupid == 'none'){
                no_search_way();   
            } else if(search_date != 'alldates' && groupid != 'none'){
                // show_only_khoros_khat_wise_data(search_date, khotos_khat_id);
                // show_biboron_list(search_date, khotos_khat_id);

                getGroupWiseOnlyGroupedData(search_date, groupid);                
                show_biboron_list(search_date, groupid);
                $('#showAllDatesAllData').css('display', 'inline-block');
                $('#dateWiseDelete').css('display', 'none');
            } else {
                alert("Logic error !");
            }
        });
        function getGroupWiseOnlyGroupedData(search_date, groupid){
            $("#loader_img").show();
            $.ajax({
                url: '../ajaxcall/getModify_vaucher_debit_group_wise_data.php',
                type: 'post',
                data: {
                    search_date: search_date,
                    groupid: groupid
                },
                success: function(res){
                    // alert(res);

                    $('#allInfoCon').hide();
                    $('#changeDateForm').hide();
                    $('#container_table_div').html(res).show();
                    dataTableCall_byId('mytable', 2);
                    heightChange();

                    //data table plugins custom
                        var mytable_length = $('#mytable_length');
                        mytable_length.find('select').attr('id', 'data_view_number');

                        var mytable_filter = $('#mytable_filter');
                        mytable_filter.find('input').attr('id', 'data_view_search');
                    //data table plugins custom
                },
                complete:function(){
                    $("#loader_img").hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        function show_biboron_list(search_date, khotos_khat_id){
            $("#loader_img").show();
            $.ajax({
                url: "../ajaxcall/show_biboron_list_box.php",
                type: "post",
                data: { 
                  search_date : search_date,
                  khotos_khat_id : khotos_khat_id },
                success: function (response) {
                    // alert(response);
                    $('#biboronCon').html(response).show();                
                    // heightChange();
                    // $("#descriptionGroupList").html();
                    $('#descriptionGroupList').select2().on('select2:open', function(e){
                        $('.select2-search__field').attr('placeholder', 'Search...');          
                    });
                },
                complete:function(data){
                  $("#loader_img").hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        function no_search_way(){
            var htm = '<table id="mytable" class="table table-bordered" style="font-size: 20px;">';
                htm +=    '<tr>';
                htm +=      '<td style="text-align: center;">খরচ খাতের নাম নির্বাচন করুন ।</td>';
                htm +=    '</tr>';
                htm += '</table>';

            // alert(htm);

            $('#biboronCon').html('');
            $('#container_table').hide();
            $('#container_table_div').html(htm).show();
            heightChange();
        }
    </script>
    <script type="text/javascript">        
        $(document).on('change', '#modify_vaucher_date_lists', function(){
            // var seletedDate = $('#modify_vaucher_date_lists option:selected').val();
            $("#headerGroupNameList").val('none').trigger('change');
            var seletedDate = $(this).children("option:selected").val();            
            // alert(seletedDate);
            if(seletedDate === 'alldates'){
                // window.location.href = "../vaucher/modify_vaucher.php";
                getAllMvData_last10();
                $('#dateWiseDelete').css('display', 'none');
                $('#showAllDatesAllData').css('display', 'inline-block');
            } else {
                // alert(seletedDate);
                getDateWiseModifyVauchersData(seletedDate);                
                
                var dateAr = seletedDate.split('-');
                var newDate = dateAr[2] + '-' + dateAr[1] + '-' + dateAr[0];
                $('#dateWiseDelete').css('display', 'inline-block').attr('value', 'Delete datas on '+ newDate);
                $('#showAllDatesAllData').css('display', 'none');
            }
            // $("#headerGroupNameList").val('none').off('change');
            // if($("#headerGroupNameList option:selected").val() != 'none'){
            //     $("#headerGroupNameList").val('none').trigger('change');
            // }        
        });

        function getDateWiseModifyVauchersData(date){
          $("#loader_img").show();
          $.ajax({
              url: '../ajaxcall/modify_vaucher_search_by_date.php',
              type: 'post',
              data: {selectedDate: date},
              success: function(res){
                  // alert(res);
                  $('#allInfoCon').html(res).show();
                  $('#changeDateForm').show();
                  $('#container_table_div').hide();
                  heightChange();
              },
              complete:function(){
                $("#loader_img").hide();
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
        }

        
        function getAllMvData_last10(){
          $("#loader_img").show();
          $.ajax({
              url: '../ajaxcall/modify_vaucher_search_all_data_last10.php',
              // type: 'post',
              // data: {selectedDate: date},
              success: function(res){
                  // alert(res);
                  $('#allInfoCon').html(res).show();
                  $('#changeDateForm').show();
                  $('#container_table_div').hide();                  
                  heightChange();
              },
              complete:function(){
                $("#loader_img").hide();
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
        }         
        function getAllMvData(){
          $("#loader_img").show();
          $.ajax({
              url: '../ajaxcall/modify_vaucher_search_all_data.php',
              // type: 'post',
              // data: {selectedDate: date},
              success: function(res){
                  // alert(res);
                  $('#allInfoCon').html(res).show();
                  $('#changeDateForm').show();
                  $('#container_table_div').hide();                  
                  heightChange();
              },
              complete:function(){
                $("#loader_img").hide();
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
        }
        $(document).on('click', '#showAllDatesAllData', function(){
            $("#headerGroupNameList").val('none').trigger('change');                       
            getAllMvData();
            // alert('asfd');
        });


        $(document).on('input', '#modify_search', function(){
            var match_string = $(this).val();
            $('#container_table_div').hide();
            $('#mytable').hide();
            // alert(match_string);
            $("#headerGroupNameList").val('none').change();
            $("#modify_vaucher_date_lists").val('alldates').change();
            setTimeout(function(){
                getMatchStringDataFromAllTable(match_string);
            }, 500);
        });

        function getMatchStringDataFromAllTable(match_string){
            $("#loader_img").show();
            $.ajax({
                url: "../ajaxcall/get_match_string_data_from_all_table_modify_vaucher.php",
                type: "post",
                data: { match_string : match_string },
                success: function (response) {
                    // alert(response);
                    $('#allInfoCon').html(response).show();
                    $('#changeDateForm').hide();
                    $('#container_table_div').hide();
                    heightChange();
                },
                complete:function(){
                  $("#loader_img").hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        $(document).on('change','#descriptionGroupList', function() {
            var search_date = $("#modify_vaucher_date_lists option:selected").val();
            var groupid = $("#headerGroupNameList option:selected").val();
            var biboron = $(this).children("option:selected").val();
            // alert(groupid + "==" + biboron);
            if(biboron == 'none'){
                getGroupWiseOnlyGroupedData(search_date, groupid);
                // show_only_khoros_khat_wise_data(groupid);
            } else {
                group_description_wise_data(search_date, groupid, biboron);
            }
        });
        // function show_only_khoros_khat_wise_data(khotos_khat_id){
        //     $("#loader_img").show();
        //     $.ajax({
        //         url: "../ajaxcall/search_only_khoros_khat_wise_data.php",
        //         type: "post",
        //         data: { khotos_khat_id : khotos_khat_id },
        //         success: function (response) {
        //             // alert(response);
        //             $('#container_table').hide();
        //             $('#changeDateForm').hide();
        //             $('#container_table_div').html(response).show();

        //             dataTableCall_byId('mytable', 2);
        //             heightChange();
        //         },
        //         complete:function(data){
        //           $("#loader_img").hide();
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             console.log(textStatus, errorThrown);
        //         }
        //     });
        // }
        function group_description_wise_data(search_date, khotos_khat_id, biboron){
            $.ajax({
                url: "../ajaxcall/search_only_group_description_wise_data.php",
                type: "post",
                data: {
                        search_date : search_date,
                        khotos_khat_id : khotos_khat_id,
                        biboron : biboron
                      },
                success: function (response) {
                    // alert(response);
                    $('#container_table').hide();
                    $('#changeDateForm').hide();                           
                    $('#container_table_div').html(response).show();
                    dataTableCall_byId('mytable', 2);                
                    heightChange();
                    //data table plugins custom
                        var mytable_length = $('#mytable_length');
                        mytable_length.find('select').attr('id', 'data_view_number');

                        var mytable_filter = $('#mytable_filter');
                        mytable_filter.find('input').attr('id', 'data_view_search');
                    //data table plugins custom
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    </script>
    <script type="text/javascript">
        // function updateUserAllow(data){
        //   $.ajax({
        //     url: "../ajaxcall/allow_user_access.php",
        //     type: "post",
        //     data: {
        //       allowUserHome : data,
        //       page : 'modify_data'
        //     },
        //     success: function(res){
        //       // alert(res);
        //     },
        //     error: function(jqXHR, textStatus, errorThrown){
        //       console.log(textStatus, errorThrown);
        //     }
        //   });
        // }

        // $(document).on('change','#allowUser', function(){
        //     var allowUserHome = $(this).val();
        //     // alert(allowUserHome);
        //     var attributeTest = $(this).is(':checked'); //Input checked or not
        //     // alert(attributeTest);
        //     if(attributeTest==true){
        //       $(this).val("yes");
        //     } else {
        //       $(this).val("no");
        //     }
        //     updateUserAllow(allowUserHome);
        // });
    </script>
    <script type="text/javascript">
      function callSearchFn()  {
      }
      $(document).on('click', '.paonaDelete', function(event){
          event.preventDefault();
          var remove_id = $(event.target).attr('data-remove_id');
          console.log(remove_id);
          ConfirmDialog('Are you sure delete paonader info');
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
                                          $.get("modify_vaucher.php?remove_id="+remove_id, function(data, status){
                                            // console.log(status);
                                            if(status == 'success'){
                                                window.location.href = 'modify_vaucher.php';
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




      $(document).on('click', '.nijepaboDelete', function(event){
          event.preventDefault();
          var delete_id = $(event.target).attr('data-delete_id');
          console.log(delete_id);
          ConfirmDialog('Are you sure delete nije pabo info');
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
                                          $.get("modify_vaucher.php?delete_id="+delete_id, function(data, status){
                                            if(status == 'success'){
                                              window.location.href = 'modify_vaucher.php';
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
      


      $(document).on('click', '.jomaDelete', function(event){
          event.preventDefault();
          var trash_id = $(event.target).attr('data-trash_id');
          console.log(trash_id);
          ConfirmDialog('Are you sure delete joma info');
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
                                          $.get("modify_vaucher.php?trash_id="+trash_id, function(data, status){
                                              if(status == 'success'){
                                                window.location.href = 'modify_vaucher.php';
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



      $(document).on('click', '.voucherDelete', function(event){
          event.preventDefault();
          var del_id = $(event.target).attr('data-del_id');
          // console.log(del_id);
          $("#verifyPasswordModal").show().height($("html").height()+$(".bar_con").height());
          $("#matchPassword").val('');
          $("#passMsg").html('');
          $("#verifyToDeleteBtn").attr("data-del_id", del_id);
      });
      $(document).on('click', '#verifyToDeleteBtn', function(event){
          event.preventDefault();
          $("#passMsg").html(response).css({'margin':'0px'});
          var del_id = $(event.target).attr('data-del_id');
          var pass = $("#matchPassword").val();
          $.ajax({
              url: "../ajaxcall/match_password_for_vaucher_credit.php",
              type: "post",
              data: { pass : pass },
              success: function (response) {
                  // alert(response);
                  if(response == 'password_matched'){
                      $("#verifyPasswordModal").hide();
                      ConfirmDialog('Are you sure delete khoros group & its datas?');
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

                                          $.get("modify_vaucher.php?del_id="+del_id, function(data, status){
                                              if(status == 'success'){
                                                window.location.href = 'modify_vaucher.php';
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
        $(document).on('click', '#dateWiseDelete', function(event){
            event.preventDefault();
            var dateForDelete = $('#modify_vaucher_date_lists option:selected').val();
            console.log(dateForDelete);
            ConfirmDialog('Are you sure to delete data of this date?');
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
                                            $.get("../ajaxcall/modify_vaucher_date_wise_delete_from_all_table.php?dateForDelete="+dateForDelete, function(data, status){
                                                if(status == 'success'){
                                                  window.location.href = 'modify_vaucher.php';
                                                  console.log(data);
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
    </script>
    <style type="text/css">
      .borderless-cell { border: 0px solid Transparent!important; }
      .noborders {border: none!important;}
      .padding{padding: 20px!important;}
      .allowText {
        position: absolute;
        right: 0px;
      }
      .bdrTransAll{
        border: 1px solid transparent !important;
      }
    </style>
</head>
<body>
    <?php
      include '../navbar/header_text.php';  
      $page ='modify_vaucher';
      include '../navbar/navbar.php';
    ?>
    <div class="container">
      <!-- project_heading modify section -->
      <?php 
        // $ph_id = $_SESSION['project_name_id'];
        // $query = "SELECT * FROM project_heading WHERE id = $ph_id";
        // $show = $db->select($query);
        // if ($show) {
        //   while ($rows = $show->fetch_assoc()) {
              ?>
              <!-- <div class="project_heading">
                <h2 class="text-center"><?php //echo $rows['heading']; ?></h2>
                <h4 class="text-center"><?php //echo $rows['subheading']; ?></h4>
                <div class="headingDateUpdateCon" >      
                
                    <a class="btn" style="position: absolute; right: 0px; border: 1px solid #46b8da; color: #000; background-color: #F0F0F0;" href="project_heading.php?project_heading_edit_id=<?php //echo $rows['id']; ?>">UPDATE</a> -->
                  
                    <?php  
        //   }
        // }
      ?>
        
            <!-- </div>
          </div> -->
    </div>




<div class="bar_con" style="position: absolute;">
    <img src="../img/loader_used.png" id="loader_img" width="80px">
    <div class="left_side_bar" style="min-height: 550px;">       
        <?php require '../others_page/left_menu_bar.php'; ?>
        <!-- <p class="edPermit">asdfasdf</p> -->
    </div>
    <div class="main_bar" style="width: calc(80% - 20px);">
            <?php
                $ph_id = $_SESSION['project_name_id'];
                $query = "SELECT * FROM project_heading WHERE id = $ph_id";
                $show = $db->select($query);
                if ($show) {
                    while ($rows = $show->fetch_assoc()) {
                        ?>
                        <div class="project_heading">      
                            <h2 class="headingOfAllProject">
                                <?php echo $rows['heading']; ?> <span class="protidinHisab"><?php echo $rows['subheading']; ?></span>
                                
                            </h2>
                        </div>
                        <?php 
                    }
                } 
            ?>

            <div style="margin-bottom: 15px;">
                <?php          
                    $date_query = "SELECT credit_date AS unique_date FROM vaucher_credit WHERE project_name_id = '$project_name_id'
                                UNION
                                SELECT group_date FROM debit_group WHERE project_name_id = '$project_name_id'
                                UNION
                                SELECT nij_paona_date FROM nij_paonadar WHERE project_name_id = '$project_name_id'
                                UNION
                                SELECT pabe_date FROM jara_pabe WHERE project_name_id = '$project_name_id'
                                UNION
                                SELECT entry_date FROM debit_group_data WHERE project_name_id = '$project_name_id'
                                UNION
                                SELECT due_debit_date FROM due WHERE project_name_id = '$project_name_id'
                                ORDER BY unique_date DESC";
                  
                    $date_read = $db->select($date_query);
                    if ($date_read) {                    
                        echo '<select id="modify_vaucher_date_lists" class="selectpicker" data-style="btn-info" data-width="170px">';
                            echo '<option value="' . date("Y-m-d") . '">' . date("d-m-Y") . '</option>';
                            echo '<option value="alldates">All Dates 10 Datas...</option>';
                                while ($date_row = $date_read->fetch_assoc()) {
                                    $newDate = $date_row['unique_date'];
                                    if($newDate == '0000-00-00') {

                                    } else {
                                        $newdateformate = date("d-m-Y", strtotime($newDate));

                                        echo '<option value="' . $newDate .'">' . $newdateformate .'</option>';
                                    }
                                }
                        echo '</select>';
                    }  
                ?>
                <input type="button" class="btn btn-info" value="Show all datas" id="showAllDatesAllData">
                <input type="button" class="btn btn-info" value="Delete data by date" id="dateWiseDelete">
                <select id="headerGroupNameList" class="" >                    
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
                <span id="biboronCon" style="display: inline-block;"></span>
                <input type="text" class="form-control" placeholder="Search..." id = "modify_search">
            </div>

            

        <div id="container_table_div">
          
        </div>
        <form action="" method="POST">         
          <table class="table table-bordered" id="allInfoCon">
              <!-- <tr>
                  <th class="first_view">
                      <?php //echo date('d/m/Y'); ?>
                      Please change the date from above dropdown menu for view datas.
                  </th>
              </tr> -->
          </table>
        </form>


        
        <form method="post" action="" onSubmit="return validation_date();" id="changeDateForm" style="display: none">    
            <table class="table table-bordered">
                <thead>
                    <tr class="d-flex">
                        <th class="col-3">Change Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td><input type="text" name="date_update" id="date_update" class="form-control" placeholder="dd-mm-yyyy" /></td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <input type="submit" class="form-control btn btn-primary" name="change_date" value="Submit">
            </div>
        </form>
    </div>
</div>
<div id="verifyPasswordModal">
    <div class="kajol-dialog">
        <div class="kajol-content">
            <div class="bg-primary kajol-header" style="border-radius: 5px 5px 0px 0px;">
              <button type="button" class="close kajol_close">&times;</button>
              <h4 class="kajol-title">Verify Admin Password</h4>
            </div>
            <div class="kajol-body">
                <div class="form-group" style="margin-bottom: 0px;">
                    <label for="matchPassword">Password:</label>
                    <input type="password" class="form-control" id="matchPassword" placeholder="Password...">
                    <h4 id="passMsg" style="margin: 0px;"></h4>
                </div>
            </div>
            <div class="kajol-footer">
                <button type="button" class="btn btn-success" id="verifyToDeleteBtn">Verify to delete</button>
                <button type="button" class="btn btn-danger cancel">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.selectpicker').selectpicker();
    
    $('#date_update').datepicker( {
        onSelect: function(date) {
            // alert(date);
            $(this).change();
        },
        dateFormat: "dd-mm-yy",
        changeYear: true,
    });
    
    function validation_date(){        
        var search_date = $('#modify_vaucher_date_lists option:selected').val();
        var date_update = $('#date_update').val();
        console.log(search_date, date_update);
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
                                    $.ajax({
                                            url: "../ajaxcall_save_update/update_all_tables_date_from_modify_vaucher.php",
                                            type: "post",
                                            data: {
                                                date_update : date_update,
                                                search_date : search_date
                                            } ,
                                            success: function (response) {
                                                // alert(response);
                                                window.location.href = 'modify_vaucher.php';
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                               console.log(textStatus, errorThrown);
                                            }
                                        });                                    
                                     
                                      // $.get("modify_vaucher.php?date_update="+date_update + "&search_date="+ search_date, function(data, status){
                                      //     if(status == 'success'){
                                      //       window.location.href = 'modify_vaucher.php';
                                      //     }
                                      // });
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
        if(search_date == 'alldates'){
            alert('Please a select a date from search for update.');
            return false;
        } else if(date_update == ''){
            alert('Please set new date for update.');
            $('#date_update').focus();
            return false;
        } else {
            // alert($('#modify_vaucher_date_lists option:selected').val());
            // alert($('#date_update').val());
            ConfirmDialog('Are you sure to change date?');
            return false;
        }
    }
</script>
<script type="text/javascript">
    $('.left_side_bar').height($('.main_bar').innerHeight()).trigger('change');
    function heightChange(){
        var left_side_bar_height = $('.left_side_bar').height();
        var main_bar_height = $('.main_bar').innerHeight();
        if(left_side_bar_height >= main_bar_height){
            $('.left_side_bar').height(main_bar_height + 25);          
        } else {
            $('.left_side_bar').height(main_bar_height + 25);            
        }
    }
    // heightChange();

    function dataTableCall_byId(id, collumn){        
        var table = $('#'+id).DataTable( {
              "order": [[ collumn, "asc" ]],
              "retrieve": true,
              "paging": true,
              "searching": true,
              "destroy": true,
        });
        // table.destroy(true);
        table.destroy();

        table = $('#'+id).DataTable( {
              "order": [[ collumn, "asc" ]],
              "retrieve": true,
              "paging": true,
              "searching": true,
              "destroy": true,
              "footerCallback": function ( row, data, start, end, display ) {
                  var api = this.api(), data;
       
                  // Remove the formatting to get integer data for summation
                  var intVal = function ( i ) {
                      return typeof i === 'string' ?
                          i.replace(/[\$,]/g, '')*1 :
                          typeof i === 'number' ?
                              i : 0;
                  };
       
                  // Total over all pages
                  total = api
                      .column( 4 )
                      .data()
                      .reduce( function (a, b) {
                          return intVal(a) + intVal(b);
                      }, 0 );
       
                  // Total over this page
                  pageTotal = api
                      .column( 4, { page: 'current'} )
                      .data()
                      .reduce( function (a, b) {
                          return intVal(a) + intVal(b);
                      }, 0 );
       
                  // Update footer
                  $( api.column( 4 ).footer() ).html(
                      pageTotal +'.00' + '<br><span style="text-decoration:overline;">of '+ total +'.00</>'
                  );
              },
              "aLengthMenu": [[10, 25, 50, 75, 100, 150, 200, -1], [10, 25, 50, 75, 100, 150, 200, "All"]],
              "iDisplayLength": 10,
        });
    }
</script>
<script type="text/javascript">
    // $("#headerGroupNameList").select2();
    $('#headerGroupNameList').select2({ width: 'resolve' }).on('select2:open', function(e){
        $('.select2-search__field').attr('placeholder', 'Search...');          
    });
</script>
<script type="text/javascript">
      $("#modify_vaucher_date_lists").val('alldates').trigger('change');
</script>
<script type="text/javascript">
    $(document).on("click", ".kajol_close, .cancel", function(){
        $("#verifyPasswordModal").hide();
    });
</script>
<script type="text/javascript">                        
    $(document).on('change', '#data_view_number', function(){
        heightChange();
    });

    $(document).on('input paste keydown', '#data_view_search', function(){
        heightChange();
    });
</script>
</body>
</html>
