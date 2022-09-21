<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php'); 
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $_SESSION['pageName'] = 'jara_pabe';
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];
    $sucMsg = '';



    if (isset($_POST['submit'])){
        if($_POST['submit'] == 'Submit'){
            for ($i = 0; $i < count($_POST['name']); $i++) {
                $postDateArr  = explode('/', $_POST['jp_date'][$i]);
                $jp_date      = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];   
                $name         = trim($_POST['name'][$i]);
                $description  = trim($_POST['description'][$i]);
                $amount       = trim($_POST['amount'][$i]);

                if($amount == ''){
                    $amount = 0;
                }

                $query = "INSERT INTO jara_pabe(pabe_name, pabe_description, pabe_amount, pabe_date, project_name_id)VALUES('$name', '$description', '$amount', '$jp_date', '$project_name_id')";
                $result = $db->insert($query);
                if ($result) {
                    // echo "<script>alert('Data is inserted successfully !');</script>";
                    // echo "<script>window.location.href = 'modify_vaucher.php'</script>";
                    $sucMsg = 'Data is inserted successfully !';
                } else {
                    $sucMsg = 'Data is not inserted !';
                }
            }
        } else {
            $i=0;
            $postDateArr  = explode('/', $_POST['jp_date'][$i]);
            $jp_date      = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];   
            $name         = trim($_POST['name'][$i]);
            $description  = trim($_POST['description'][$i]);
            $amount       = trim($_POST['amount'][$i]);

            if($amount == ''){
                $amount = 0;
            }
            $data_row_id          = trim($_POST['data_row_id']);

            $query = "UPDATE jara_pabe SET pabe_name = '$name', pabe_description = '$description', pabe_amount = '$amount', pabe_date = '$jp_date' WHERE pabe_id = '$data_row_id' AND project_name_id = '$project_name_id'";
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
          $jara_pabe_id = $_POST['data_delete_id'];

          $sql = "DELETE FROM jara_pabe WHERE pabe_id = '$jara_pabe_id'";
          $result = $db->delete($sql);
          if ($result) {
              $sucMsg = "Jara pabe entry delete successfully !";
          } else {
              echo "Error: " . $sql . "<br>" .$db->error;
          }
    }
?>



<!DOCTYPE html>
<html>
<head>
    <title>পাওনাদার</title>
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
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="jp_date[]" class="form-control dateInput dtCount" id="jpDate'+i+'" placeholder="DD/MM/YYYY"/></td><td><input type="text" name="name[]" class="form-control" size="100" placeholder="নিজ পাওনাদারের নাম" id="name'+i+'"/></td><td><input type="text" name="description[]" class="form-control" placeholder="বিবরণ" id="description'+i+'"/></td><td><input type="text" name="amount[]" class="form-control" placeholder="টাকাঃ" id="amount'+i+'"/></td><td class="cenText"><button type="button" name="add" id="add" class="btn btn-success disabled">+</button></td><td class="cenText"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');


                $("#jpDate"+i).datepicker({
                    onSelect: function(date) {
                        $(this).change();
                    },
                    dateFormat: "dd/mm/yy",
                    changeYear: true,
                }).datepicker("setDate", new Date());

                $('#sucMsgId').html('');
                heightChange();
            });

            $(document).on('click','.btn_remove', function(){
                var button_id = $(this).attr("id");
                if(button_id == 1){

                } else{
                  // alert("Data row removed successfully !");
                  // $("#row"+button_id+"").remove();
                  // var num = button_id.match(/\d+/);
                  // // alert(num);
                  // $("#script-"+num+"").remove();
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
        });
    </script>
    <script type="text/javascript">

    </script>
</head>
<body>
    <?php
        include '../navbar/header_text.php';
        $page = 'paonader';
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
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">পাওনাদার এন্ট্রি</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                        </h2>
                    </div>
                    <?php 
                    }
                } 
          ?>
            <form action="" method="POST" onsubmit="return validation()">
                <table class="table table-border table-condensed" id="dynamic_field">
                    <thead>
                        <tr>
                            <th class="cenText">তারিখ</th>
                            <th class="cenText">নিজ পাওনাদারের নাম</th>
                            <th class="cenText">বিবরণ</th>
                            <th class="cenText">টাকাঃ</th>
                            <th class="cenText">Add</th>
                            <th class="cenText">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="jp_date[]" class="form-control dateInput dtCount" id="jpDate1" placeholder="DD/MM/YYYY" /></td>
                            <td><input type="text" name="name[]" class="form-control" size="100" placeholder="নিজ পাওনাদারের নাম" id="name1"/></td>
                            <td><input type="text" name="description[]" class="form-control" placeholder="বিবরণ" id="description1"/></td>
                            <td><input type="text" name="amount[]" class="form-control" placeholder="টাকাঃ" id="amount1"/></td>
                            <td class="cenText"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                            <td class="cenText"><button type="button" name="remove" id="1 " class="btn btn-danger btn_remove disabled">-</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary submitBtn" name="submit" value="Submit" id="submitBtnId">
                    <input type="hidden" name="data_row_id" value="0" id="data_row_id">
                </div>
                <div class="form-group">
                    <h4 class="text-success text-center" id='sucMsgId'><?php echo $sucMsg; ?></h4>
                </div>
            </form>

            <div class="displayCon">
                <h3 style="text-align: center; margin-top: 0px;">পাওনাদার</h3>
               <?php
                    echo '<table class="table_dis">';
                    echo '<tr style="background-color: #b5b5b5;">
                            <th class="cenText">নং</th>
                            <th class="cenText" style="width: 86px;">তারিখ</th>
                            <th class="cenText">নিজ পাওনাদারের নাম</th>
                            <th class="cenText">বিবরণ</th>
                            <th class="cenText">টাকাঃ</th>
                            <th class="cenText" style="width: 76px;">Delete</th>
                            <th class="cenText" style="width: 59px;">Edit</th>
                        </tr>';
                    $i = 1;
                    $sql = "SELECT * FROM jara_pabe WHERE project_name_id = '$project_name_id'";
                    $result = $db->select($sql);
                    if ($result && mysqli_num_rows($result) > 0) {
                        $total_pabe_amount = 0;
                        while($row = $result->fetch_assoc()){
                            $pabe_id = trim($row['pabe_id']);
                            $pabe_name = trim($row['pabe_name']);
                            $pabe_description = trim($row['pabe_description']);
                            $pabe_amount = trim($row['pabe_amount']);
                            $pabe_date = $row['pabe_date'];
                            if($pabe_amount == ''){
                                $pabe_amount = 0;
                            }
                            if($pabe_date == '0000-00-00'){
                                $pabe_date = '';
                            }
                            $total_pabe_amount += $pabe_amount;
                            $html = '<tr>'
                                        . '<td style="text-align:center;">'. $i .'</td>'
                                        . '<td style="">'. date("d/m/Y", strtotime($pabe_date)) .'</td>'
                                        . '<td style="">'. $pabe_name .'</td>'
                                        . '<td style="">'. $pabe_description .'</td>'
                                        . '<td style="">'. number_format($pabe_amount, 2) .'</td>';

                            if($delete_data_permission == 'yes'){
                                $html .= '<td style=""><input type="button" value="Delete" class="btn btn-danger" data_row_id="'. $pabe_id .'" onclick="delete_row(this)"></td>';
                            } else {
                                $html .= '<td align="center"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                            }

                            if($edit_data_permission == 'yes'){
                                $html .= '<td style=""><input type="button" value="Edit" class="btn btn-success" data_row_id="'. $pabe_id .'" data_row_pabe_amount="'.$pabe_amount.'" onclick="display_update(this)"></td>';
                            } else {
                                $html .= '<td align="center"><a class="btn btn-success edPermit" disabled>&nbsp;Edit&nbsp</a></td>';
                            }
                            $html .= '</tr>';
                            echo $html;
                            $i++;
                        }
                        $html_total = '<tr>'
                                          .'<td colspan="4" style="text-align:right;">মোটঃ</td>'
                                          .'<td>'.number_format($total_pabe_amount, 2).'</td>'
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
        //     validReturn = false;


        //     $( ".dtCount" ).each(function() {
        //         var idNo = this.id.match(/\d+/);

        //         var jpDate        = $('#jpDate' + idNo).val();
        //         var name          = $('#name' + idNo).val();
        //         var description   = $('#description' + idNo).val();
        //         var amount        = $('#amount' + idNo).val();

        //         if(jpDate == ""){
        //             alert("তারিখ ফাঁকা হবে না !");
        //             validReturn = false;
        //             return false;
        //         } else {
        //           validReturn = true;
        //         }

        //         if(name == ""){
        //             alert("নিজ পাওনাদারের নাম ফাঁকা হবে না !");
        //             $('#name' + idNo).focus();
        //             validReturn = false;
        //             return false;
        //         } else if($.isNumeric(name)){
        //             alert("নিজ পাওনাদারের নাম সংখ্যা হতে পারে না !");
        //             $('#name' + idNo).focus();
        //             validReturn = false;
        //             return false;
        //         } else if(name.length > 40){
        //             alert("নিজ পাওনাদারের নাম ৪০ অক্ষরের বেশী হতে পারবে না !");
        //             $('#name' + idNo).focus();
        //             validReturn = false;
        //             return false;              
        //         } else {
        //             // validReturn = true;
        //             if(description == ""){
        //                 alert("   বিবরণ ফাঁকা হবে না !");
        //                 $('#description' + idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else if($.isNumeric(description)){
        //                 alert("   বিবরণ সংখ্যা হতে পারে না !");
        //                 $('#description' + idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else if(description.length > 40){
        //                 alert("   বিবরণ ৪০ অক্ষরের বেশী হতে পারবে না !");
        //                 $('#description' + idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else {
        //                 // validReturn = true;
        //                 if(amount == ""){
        //                     alert("টকাঃ ফাঁকা হবে না !");
        //                     $('#amount' + idNo).focus();
        //                     validReturn = false;
        //                     return false;
        //                 } else if(!$.isNumeric(amount)){
        //                     alert("টকাঃ সংখ্যায় হতে হবে !");
        //                     $('#amount' + idNo).focus();
        //                     validReturn = false;
        //                     return false;
        //                 } else {
        //                     validReturn = true;
        //                 }
                      
        //             }
                  
        //         }
        //     });



        //     if(validReturn){
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }
    </script>
    <script type="text/javascript" id="script-1">
        $(function() {
            $('#jpDate1').datepicker( {
                onSelect: function(date) {
                    // alert(date);
                    $(this).change();
                },
                dateFormat: "dd/mm/yy",
                changeYear: true,
            }).datepicker("setDate", new Date());
        });
    </script>
    <script type="text/javascript">
        function delete_row(ele){
            $('#sucMsgId').html('');
            var data_row_id = $(ele).attr('data_row_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("data_row_id", data_row_id);            
        }
        $(document).on('click', '#verifyToDeleteBtn', function(){
            delete_jara_pabe_data($(this).attr("data_row_id"));
        });

        function delete_jara_pabe_data(data_row_id){
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
                      $('#sucMsgId').html('');
                      $("#verifyPasswordModal").hide();
                        ConfirmDialog('Are you sure to delete jara pabe entry ?', data_row_id);  
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
                                            $.post("jara_pabe_add.php", {data_delete_id : data_row_id}, function(data, status){
                                                console.log(status);
                                                console.log(data);
                                                if(status == 'success'){
                                                    // $('#sucMsg').html('succsess');
                                                    window.location.href = 'jara_pabe_add.php';
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
            var row_biboron = $(ele).closest('tr').find('td:eq(3)').text();
            var data_row_pabe_amount = $(ele).attr('data_row_pabe_amount');
            
            $('#sucMsgId').html('');
            $('#data_row_id').val(data_row_id);
            $('#submitBtnId').val('Update');
            $('#jpDate1').val(row_date);
            $('#name1').val(row_name);
            $('#description1').val(row_biboron);
            $('#amount1').val(data_row_pabe_amount);
            $('#add').attr('disabled', '');
            $('html, body').animate({ scrollTop: 0 }, 600);
        }
    </script>
    <script type="text/javascript">
      // function pageRedirect(){
      //   // alert("Boom!");
      //   window.location.href = 'modify_vaucher.php';
      // }
      // if($('#sucMsgId').html() == 'Data is inserted successfully !'){
      //   setTimeout(pageRedirect, 2000);
      // } else{

      // }
      
      //an anonymous function
      // setTimeout(function(){
      //   if($('#sucMsgId').html() == 'Data is inserted successfully !'){
      //     window.location.href = 'modify_vaucher.php';
      //   } else{

      //   }
      // }, 2000);
    </script>
    <script type="text/javascript">
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