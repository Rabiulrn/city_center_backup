<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $_SESSION['pageName'] = 'joma_khat';
    
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];
    $sucMsg = "";
  
    if (isset($_POST['submit'])){
        if($_POST['submit'] == 'Submit'){
            for ($i = 0; $i < count($_POST['credit_name']); $i++) {
                $postDateArr        = explode('/', $_POST['credit_date'][$i]);
                $credit_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
                $credit_name        = trim($_POST['credit_name'][$i]);
                $credit_amount      = trim($_POST['credit_amount'][$i]);
                if($credit_amount == ''){
                    $credit_amount = 0;
                }

                $query = "INSERT INTO vaucher_credit(credit_name, credit_amount, credit_date, project_name_id) VALUES ('$credit_name', '$credit_amount', '$credit_date', '$project_name_id')";
                $result = $db->insert($query);
                if ($result) {
                   $sucMsg = 'Data is inserted successfully !';
                } else {
                    $sucMsg = 'Data is not inserted !';
                }
          
            }
      } else {
            $i=0;
            $postDateArr        = explode('/', $_POST['credit_date'][$i]);
            $credit_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
            $credit_name        = trim($_POST['credit_name'][$i]);
            $credit_amount      = trim($_POST['credit_amount'][$i]);
            if($credit_amount == ''){
                $credit_amount = 0;
            }
            $data_row_id          = trim($_POST['data_row_id']);

            $query = "UPDATE vaucher_credit SET credit_name = '$credit_name', credit_amount = '$credit_amount', credit_date = '$credit_date' WHERE id = '$data_row_id' AND project_name_id = '$project_name_id'";
            $result = $db->insert($query);
            if ($result) {
             $sucMsg = 'Data is updated successfully !';
            } else {
              $sucMsg = 'Data is not updated !';
            }
      }
      // unset($_POST);
  }

  if(isset($_POST['data_delete_id'])){
      $vaucher_credit = $_POST['data_delete_id'];

      $sql = "DELETE FROM vaucher_credit WHERE id = '$vaucher_credit'";
      $result = $db->delete($sql);
      if ($result) {
          $sucMsg = "Joma khat entry delete successfully !";
      } else {
          echo "Error: " . $sql . "<br>" .$db->error;
      }
  }
?>



<!DOCTYPE html>
<html>
<head>
    <title>জমা খাত</title>
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
        .dateInput{
            line-height: 22px !important;
        }
        .allowText {
            float: right;
            margin-bottom: 3px;
        }
        
        .table-border > tbody > tr > td {
            border: 1px solid #ddd !important;
        }
        .table-border > thead > tr > th {
            border: 1px solid #ddd !important;
        }
        
        .backcircle{
            font-size: 18px;
            position: absolute;
            margin-top: -35px;
        }
        .backcircle a:hover{
            text-decoration: none !important;
        }
        .cenText{
            text-align: center;
        }
        .submitBtn{
            width: 100px;
            float: right;
        }
    </style>
    <script>
        $(document).ready(function(){

            var i = 1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="credit_date[]" class="form-control dateInput dtCount" id="cDate'+i+'" placeholder="DD/MM/YYYY"/></td><td><input type="text" name="credit_name[]" class="form-control" size="100" placeholder="মারফোত নাম" id="credit_name'+i+'"/></td><td><input type="text" name="credit_amount[]" class="form-control" placeholder="জমাঃ" id="credit_amount'+i+'"/></td><td class="cenText"><button type="button" name="add" id="add" class="btn btn-success disabled">+</button></td><td class="cenText"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');

                $("body").append(datePicker);
                $("#cDate"+i).datepicker({
                    onSelect: function(date) {
                    $(this).change();
                },
                    dateFormat: "dd/mm/yy",
                    changeYear: true,
                }).datepicker("setDate", new Date());

                $('#sucMsg').html('');

                heightChange();
            });
        });

        $(document).on('click','.btn_remove', function(){
            var button_id = $(this).attr("id");
            // alert(button_id);
            if(button_id == 1){
                // alert("Cant Remove it !");
                // break;
            } else{
                ConfirmDialog('Are you sure remove the row?');
                // $("#row"+button_id+"").remove();
                // var num = button_id.match(/\d+/);
                // // alert(num);
                // $("#script-"+num+"").remove();

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
                                                var num = button_id.match(/\d+/);
                                                // alert(num);
                                                $("#script-"+num+"").remove();
                                                // alert("Data row removed successfully !");                                           
                                                $(this).dialog("close");
                                            },
                                            No: function () {
                                                // $('body').append('<h1>Confirm Dialog Result: <i>No</i></h1>');
                                                
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
    </script>
</head>
<body>
    <?php
        include '../navbar/header_text.php';
        $page = 'joma_khat';
        include '../navbar/navbar.php';
    ?>
    <div class="bar_con">
        <div class="left_side_bar" style="height: 500px;">
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
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">জমা খাত এন্ট্রি</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                            
                        </h2>
                    </div>
                <?php 
                    }
                } 
            ?>
            <form action="" method="POST" onsubmit="return validation()" id="jomaForm">
                <table class="table table-border table-condensed" id="dynamic_field">
                    <thead>
                        <tr>
                            <th class="cenText">তারিখ</th>
                            <th class="cenText">মারফোত নাম</th>
                            <th class="cenText">জমাঃ</th>
                            <th class="cenText">Add</th>
                            <th class="cenText">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="credit_date[]" class="form-control dateInput dtCount" id="cDate1" placeholder="DD/MM/YYYY"/></td>
                            <td><input type="text" name="credit_name[]" class="form-control" size="100" placeholder="মারফোত নাম" id="credit_name1"/></td>
                            <td><input type="text" name="credit_amount[]" class="form-control" placeholder="জমাঃ" id="credit_amount1"/></td>
                            <td class="cenText"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                            <td class="cenText"><button type="button" name="remove" id="1" class="btn btn-danger btn_remove disabled">-</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary submitBtn" name="submit" value="Submit" id="submitBtnId">
                    <input type="hidden" name="data_row_id" value="0" id="data_row_id">
                </div>


                <div class="form-group">
                    <h4 class="text-success text-center" id="sucMsg"><?php echo $sucMsg; ?></h4>
                </div>
            </form>

            <div class="displayCon">
                <h3 style="text-align: center; margin-top: 0px;">জমা খাত</h3>
               <?php
                    echo '<table class="table_dis">';
                    echo '<tr style="background-color: #b5b5b5;">
                            <th class="cenText">নং</th>
                            <th class="cenText" style="width: 86px;">তারিখ</th>
                            <th class="cenText">মারফোত নাম</th>
                            <th class="cenText">জমা</th>
                            <th class="cenText" style="width: 76px;">Delete</th>
                            <th class="cenText" style="width: 59px;">Edit</th>
                        </tr>';
                    $i = 1;
                    $sql = "SELECT * FROM vaucher_credit WHERE project_name_id = '$project_name_id'";
                    $result = $db->select($sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $total_amount = 0;
                        while($row = $result->fetch_assoc()){
                            $id = trim($row['id']);
                            $credit_name = trim($row['credit_name']);
                            $credit_amount = trim($row['credit_amount']);
                            $credit_date = $row['credit_date'];
                            if($credit_amount == ''){
                                $credit_amount = 0;
                            }
                            if($credit_date == '0000-00-00'){
                                $credit_date = '';
                            }
                            $total_amount += $credit_amount;
                            $html = '<tr>'
                                        . '<td style="text-align:center;">'. $i .'</td>'
                                        . '<td style="">'. date("d/m/Y", strtotime($credit_date)) .'</td>'
                                        . '<td style="">'. $credit_name .'</td>'
                                        . '<td style="">'. number_format($credit_amount, 2) .'</td>';

                            if($delete_data_permission == 'yes'){
                                $html .= '<td align="center"><input type="button" value="Delete" class="btn btn-danger" data_row_id="'. $id .'" onclick="delete_row(this)"></td>';
                            } else {
                                $html .= '<td align="center"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                            }

                            if($edit_data_permission == 'yes'){
                                $html .= '<td style=""><input type="button" value="Edit" class="btn btn-success" data_row_id="'. $id .'" data_row_amount="'.$credit_amount.'" onclick="display_update(this)"></td>';
                            } else {
                                $html .= '<td align="center"><a class="btn btn-success edPermit" disabled>&nbsp;Edit&nbsp</a></td>';
                            }
                            $html .= '</tr>';
                            echo $html;
                            $i++;
                        }
                        $html_total = '<tr>'
                                          .'<td colspan="3" style="text-align:right;">মোটঃ</td>'
                                          .'<td>'.number_format($total_amount, 2).'</td>'
                                          .'<td></td>'
                                          .'<td></td>'
                                      .'</tr>';
                        echo $html_total;
                    }

                    echo '</table>';       
               ?>
            </div>

        </div>
    </div>
    <?php include '../others_page/delete_permission_modal.php';  ?>
    <script type="text/javascript">
        // function validation(){
        //         var validReturn = false;
        //         $( ".dtCount" ).each(function() {
        //             var idNo = this.id.match(/\d+/);
        //             // alert(idNo);
        //             var cDate          = $("#cDate"+idNo).val();
        //             var credit_name    = $("#credit_name"+idNo).val();
        //             var credit_amount  = $("#credit_amount"+idNo).val();
        //             if(cDate == ""){
        //                 alert("তারিখ ফাঁকা হবে না !");
        //                 validReturn = false;
        //                 return false;
        //             } else {
        //                 validReturn = true;
        //             }

        //             if(credit_name == ""){
        //                 alert("মারফোত নাম ফাঁকা হবে না !");
        //                 $("#credit_name"+idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else if($.isNumeric(credit_name)){
        //                 alert("মারফোত নাম সংখ্যা হতে পারে না !");
        //                 $("#credit_name"+idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else if(credit_name.length > 100){
        //                 alert("মারফোত নাম ১০০ অক্ষরের বেশী হতে পারবে না !");
        //                 $("#credit_name"+idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else {
        //             // validReturn = true;
        //             if(credit_amount == ""){
        //                 alert("জমা ফাঁকা হবে না !");
        //                 $("#credit_amount"+idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else if(!$.isNumeric(credit_amount)){
        //                 alert("জমা সংখ্যায় হতে হবে !");
        //                 $("#credit_amount"+idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else {
        //                 validReturn = true;
        //             }
        //         }
        //     });


        //     if(validReturn){
        //         return true;
        //     } else {
        //         return false;
        //     }
        // }
    </script>
    <script type="text/javascript"> 
      // $(function () {
      //     setNavigation();
      // });

      // function setNavigation() {
      //     var path = window.location.pathname;
      //     console.log(path);
      //     path = path.replace(/\/$/, "");
      //     path = decodeURIComponent(path);

      //     $(".nav a").each(function () {
      //         var href = $(this).attr('href');
      //         if (path.substring(0, href.length) === href) {
      //             $(this).closest('li').addClass('active');
      //         }
      //     });
      // }



      // $(document).ready(function() {
      //   // get current URL path and assign 'active' class
      //   var pathname = window.location.pathname;
      //   $('.nav > li > a[href="'+pathname+'"]').parent().addClass('active');
      // });
    </script>
    <script type="text/javascript">
        function delete_row(ele){
            var data_row_id = $(ele).attr('data_row_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("data_row_id", data_row_id);            
        }
        $(document).on('click', '#verifyToDeleteBtn', function(){
            delete_vaucher_credit_data($(this).attr("data_row_id"));
        });

        function delete_vaucher_credit_data(data_row_id){
            console.log(data_row_id);
            $("#passMsg").html("").css({'margin':'0px'});          
            var pass = $("#matchPassword").val();
            $.ajax({
                url: "../ajaxcall/match_password_for_vaucher_credit.php",
                type: "post",
                data: { pass : pass },
                success: function (response) {
                  // alert(response);
                  if(response == 'password_matched'){
                      $('#sucMsg').html('');
                      $("#verifyPasswordModal").hide();
                      ConfirmDialog('Are you sure to delete joma khat entry ?', data_row_id);
                  } else {
                      $("#passMsg").html(response).css({'color':'red','margin-top':'10px'});
                  }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
                }
            });
            function ConfirmDialog(message, data_row_id){
                $('<div></div>').appendTo('body')
                                .html('<div><h4>'+message+'</h4></div>')
                                .dialog({
                                    modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                    width: '40%', resizable: false,
                                    position: { my: "center", at: "center center-20%", of: window },
                                    buttons: {
                                        Yes: function () {
                                            $(this).dialog("close");
                                            $.post("add_vaucher_credit.php", {data_delete_id : data_row_id}, function(data, status){
                                                console.log(status);
                                                console.log(data);
                                                if(status == 'success'){
                                                    // $('#sucMsg').html('succsess');
                                                    window.location.href = 'add_vaucher_credit.php';
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
            }
        }
                
        function display_update(ele){
            console.log(ele);
            var data_row_id = $(ele).attr('data_row_id');
            var row_date = $(ele).closest('tr').find('td:eq(1)').text();
            var row_name = $(ele).closest('tr').find('td:eq(2)').text();
            var data_row_amount = $(ele).attr('data_row_amount');
            
            $('#sucMsg').html('');
            $('#data_row_id').val(data_row_id);
            $('#submitBtnId').val('Update');
            $('#cDate1').val(row_date);
            $('#credit_name1').val(row_name);
            $('#credit_amount1').val(data_row_amount);
            $('#add').attr('disabled', '');
            $('html, body').animate({ scrollTop: 0 }, 600);
        }
    </script>
    <script type="text/javascript" id="script-1">
        $(function() {
          $('#cDate1').datepicker( {
              onSelect: function(date) {
                  // alert(date);
                  $(this).change();
              },
              dateFormat: "dd/mm/yy",
              changeYear: true,
          }).datepicker("setDate", new Date());
        });

        if($('.main_bar').innerHeight() > $('.left_side_bar').height()){
            $('.left_side_bar').height($('.main_bar').innerHeight() + 34);
        } else {
            $('.left_side_bar').height(640);
        }
        function heightChange(){
            var left_side_bar_height = $('.left_side_bar').height();
            var main_bar_height = $('.main_bar').innerHeight();
            if(left_side_bar_height >= main_bar_height){
                // $('.left_side_bar').height(main_bar_height + 25);          
            } else {
                $('.left_side_bar').height(main_bar_height + 25);            
            }
        }
    </script>
    <script src="../js/common_js.js"></script>
</body>
</html>