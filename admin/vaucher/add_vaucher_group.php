<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$_SESSION['pageName'] = 'khoros_khat';
$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];
$sucMsg       = '';

if (isset($_POST['submit'])) {
    if ($_POST['submit'] == 'Submit') {
        for ($i = 0; $i < count($_POST['group_name']); $i++) {
            $postDateArr        = explode('/', $_POST['group_date'][$i]);

            $group_date        = $postDateArr['2'] . '-' . $postDateArr['1'] . '-' . $postDateArr['0'];
            $group_name        = trim($_POST['group_name'][$i]);
            $group_description = trim($_POST['group_description'][$i]);
            $taka              = trim($_POST['taka'][$i]);
            $pices             = trim($_POST['pices'][$i]);
            $total_taka        = trim($_POST['total_taka'][$i]);
            // $total_bill        = $_POST['total_bill'][$i];
            $pay               = trim($_POST['pay'][$i]);
            $due               = trim($_POST['due'][$i]);

            // $query = "INSERT INTO debit_group(group_name, group_description, taka, pices, total_taka, total_bill, pay, due, group_date, project_name_id)VALUES('$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$total_bill', '$pay', '$due', '$group_date', '$project_name_id')";
            $query = "INSERT INTO debit_group(group_name, group_description, taka, pices, total_taka, pay, due, group_date, project_name_id)VALUES('$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$pay', '$due', '$group_date', '$project_name_id')";
            $result = $db->insert($query);
            if ($result) {
                $sucMsg = 'Data is inserted successfully !';
            } else {
                $sucMsg = 'Data is not inserted !';
            }
        }
    } else {
        $i = 0;
        $postDateArr        = explode('/', $_POST['group_date'][$i]);
        $group_date        = $postDateArr['2'] . '-' . $postDateArr['1'] . '-' . $postDateArr['0'];

        $group_name        = trim($_POST['group_name'][$i]);
        $group_description = trim($_POST['group_description'][$i]);
        $taka              = trim($_POST['taka'][$i]);
        $pices             = trim($_POST['pices'][$i]);
        $total_taka        = trim($_POST['total_taka'][$i]);
        $pay               = trim($_POST['pay'][$i]);
        $due               = trim($_POST['due'][$i]);

        $row_id               = trim($_POST['row_id']);

        $query = "UPDATE debit_group SET group_name ='$group_name', group_description ='$group_description', taka ='$taka', pices ='$pices', total_taka ='$total_taka', pay ='$pay', due ='$due', group_date ='$group_date' WHERE id='$row_id' AND project_name_id ='$project_name_id'";
        $result = $db->insert($query);
        if ($result) {
            $sucMsg = 'Data is updated successfully !';
        } else {
            $sucMsg = 'Data is not updated !';
        }
    }
}

if (isset($_POST['delete_id'])) {
    $debit_group = $_POST['delete_id'];

    $query = "DELETE FROM debit_group WHERE id = '$debit_group' AND project_name_id='$project_name_id'";
    $delete = $db->delete($query);

    $query2 = "DELETE FROM debit_group_data WHERE group_id = '$debit_group'";
    $delete2 = $db->delete($query2);
    //If else not effect
    if ($delete && $delete2) {
        $sucMsg = "Delete khoros khat and its dependent datas successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>খরচ খাত</title>
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

        .not-valid:focus {
            border-color: #c9302c;
            outline: 0;
            -webkit-box-shadow: inset 0 1px 1px rgba(255, 0, 0, .075), 0 0 8px rgba(255, 0, 0, .6);
            box-shadow: inset 0 1px 1px rgba(255, 0, 0, .075), 0 0 8px rgba(255, 0, 0, .6);
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
    </style>
    <script>
        $(document).ready(function() {
            var i = 1;
            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<tr id="row' + i + '"><td><input type="text" size="30" name="group_date[]" class="form-control dateInput dtCount" id="gDate' + i + '"/></td><td><input type="text" name="group_name[]" class="form-control" size="60" id="group_name' + i + '" placeholder="মারফোত গ্রুপের নাম" /></td><td><input type="text" name="group_description[]" class="form-control" size="60" id="group_description' + i + '" placeholder="গ্রুপ বিবরণ"/></td><td><input type="text" name="taka[]" class="form-control" size="30" id="taka' + i + '" placeholder="দর"/></td><td><input type="text" name="pices[]" class="form-control" size="30" id="pices' + i + '" placeholder="জন/কতটি"/></td><td><input type="text" name="total_taka[]" class="form-control" id="total_taka' + i + '" placeholder="মোট টাকা"/></td><td><input type="text" name="pay[]" class="form-control" id="pay' + i + '" placeholder="জমা"/></td><td><input type="text" name="due[]" class="form-control" id="due' + i + '" placeholder="জের"/></td><td class="cenText"><button type="button" name="add" id="add" class="btn btn-success disabled">+</button></td><td class="cenText"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">-</button></td></tr>');


                $("#gDate" + i).datepicker({
                    onSelect: function(date) {
                        $(this).change();
                    },
                    dateFormat: "dd/mm/yy",
                    changeYear: true,
                }).datepicker("setDate", new Date());

                $('#sucMsg').html('');

                heightChange();
            });

            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");

                if (button_id == 1) {

                } else {
                    ConfirmDialog('Are you sure remove the row?');

                    function ConfirmDialog(message) {
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

                                        $("#row" + button_id + "").remove();
                                        var num = button_id.match(/\d+/);
                                        // alert(num);
                                        $("#script-" + num + "").remove();
                                        // alert("Data row removed successfully !");                                           
                                        $(this).dialog("close");
                                    },
                                    No: function() {
                                        // $('body').append('<h1>Confirm Dialog Result: <i>No</i></h1>');

                                        $(this).dialog("close");
                                    }
                                },
                                close: function(event, ui) {
                                    $(this).remove();
                                }
                            });
                    };
                }
            });
        });
    </script>
    <!-- minus calculation -->
    <script type="text/javascript">
        // //any time the amount changes
        // $(document).ready(function() {
        //     $('input[name=total_debit_amount],input[name=debit_pay]').change(function(e) {
        //         var total = 0;
        //         var $row = $(this).parent();
        //         var rate = $row.find('input[name=total_debit_amount]').val();
        //         var pack = $row.find('input[name=debit_pay]').val();
        //         total = parseFloat(rate - pack);
        //         //update the row total
        //         $row.find('.amount').text(total);

        //         var total_amounts = 0;
        //         $('.amount').each(function() {
        //             //Get the value
        //             var am= $(this).text();
        //             console.log(am);
        //             //if it's a number add it to the total
        //             if (IsNumeric(am)) {
        //                 total_amounts += parseFloat(am, 10);
        //             }
        //         });
        //         $('.total_amount').text(total_amounts);
        //     });
        // });

        // //isNumeric function Stolen from: 
        // //http://stackoverflow.com/questions/18082/validate-numbers-in-javascript-isnumeric

        // function IsNumeric(input) {
        //     return (input - 0) == input && input.length > 0;
        // }
    </script>

</head>

<body>
    <?php
    include '../navbar/header_text.php';
    $page = 'khoros_khat';
    include '../navbar/navbar.php';
    ?>
    <div class="bar_con">
        <div class="left_side_bar" style="height: 500px;">
            <?php require '../others_page/left_menu_bar.php'; ?>
        </div>
        <div class="main_bar">
            <?php
            $ph_id = $_SESSION['project_name_id'];
            $query = "SELECT * FROM project_heading WHERE id = $ph_id";
            $show = $db->select($query);
            if ($show) {
                while ($rows = $show->fetch_assoc()) {
            ?>
                    <div class="project_heading">
                        <h2 class="headingOfAllProject">
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">খরচ খাত হেডার এন্ট্রি</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; 
                                                                ?></span> -->

                        </h2>
                        <!-- <h4 class="text-center"></h4> -->
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
                            <th class="cenText">মারফোত <img src="../img/others/grouper_nam_bold_222.png" width="37px" height="" /> নামঃ
                                <!-- <abbr title="মারফোত গ্রুপের নাম বা খরচের গ্রুপের নাম কথায় লিখতে হবে ।">?</abbr> -->
                            </th>
                            <th class="cenText"><img src="../img/others/group_bold_111.png" width="24px" height="" /> বিবরণের নামঃ
                                <!-- <abbr title="গ্রুপ বিবরণের নাম বা খরচের বিবরণের নাম কথায় লিখতে হবে ।">?</abbr> -->
                            </th>
                            <th class="cenText">দর
                                <!-- <abbr title="দর গ্রুপের নাম বা খরচের দর কথায় লিখতে হবে ।">?</abbr> -->
                            </th>
                            <th class="cenText">জন
                                <!-- <abbr title="জন/কতটি গ্রুপের নাম কথায় লিখতে হবে ।"> ?</abbr>-->
                            </th>
                            <th class="cenText">মোট টাকাঃ
                                <!-- <abbr title="মোট টাকা কথায় লিখতে হবে ।">?</abbr> -->
                            </th>
                            <!-- <th class="cenText">নগদ পরি‌শোধ<abbr title="নগদ পরি‌ষদ কথায় লিখতে হবে ।">?</abbr></th> -->
                            <th class="cenText">জমা
                                <!-- <abbr title="জমা কথায় লিখতে হবে ।">?</abbr> -->
                            </th>
                            <th class="cenText">জের
                                <!-- <abbr title="জের কথায় লিখতে হবে ।">?</abbr> -->
                            </th>
                            <th class="cenText">Add</th>
                            <th class="cenText">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="group_date[]" class="form-control dateInput dtCount" size="30" id="gDate1" /></td>
                            <td><input type="text" name="group_name[]" class="form-control" size="60" id="group_name1" placeholder="মারফোত গ্রুপের নাম" /></td>
                            <td><input type="text" name="group_description[]" class="form-control" size="60" id="group_description1" placeholder="গ্রুপ বিবরণ" /></td>
                            <td><input type="text" name="taka[]" class="form-control" size="30" id="taka1" placeholder="দর" /></td>
                            <td><input type="text" name="pices[]" class="form-control" size="30" id="pices1" placeholder="জন/কতটি" /></td>
                            <td><input type="text" name="total_taka[]" class="form-control" id="total_taka1" placeholder="মোট টাকা" /></td>
                            <!-- <td><input type="text" name="total_bill[]" class="form-control" id="total_bill1" placeholder="নগদ পরিশোধ"/></td> -->
                            <td><input type="text" name="pay[]" class="form-control" id="pay1" placeholder="জমা" /></td>
                            <td><input type="text" name="due[]" class="form-control" id="due1" placeholder="জের" /></d>
                            <td class="cenText"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                            <td class="cenText"><button type="button" name="remove" id="1" class="btn btn-danger btn_remove disabled">-</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary submitBtn" name="submit" value="Submit" id="submitBtn">
                    <input type="hidden" name="row_id" value="0" id="row_id">
                </div>
                <div class="form-group">
                    <h4 class="text-success text-center" id="sucMsg"><?php echo $sucMsg; ?></h4>
                </div>
            </form>

            <div class="displayCon">
                <h3 style="text-align: center; margin-top: 0px;">খরচ খাত হেডার</h3>
                <?php
                echo '<table class="table_dis">';
                echo '<tr style="background-color: #b5b5b5;">
                            <th class="cenText">নং</th>
                            <th class="cenText" style="width: 86px;">তারিখ</th>
                            <th class="cenText">মারফোত গ্রুপের নাম</th>
                            <th class="cenText">গ্রুপ বিবরণের নাম</th>
                            <th class="cenText">দর</th>
                            <th class="cenText">জন</th>
                            <th class="cenText">মোট টাকা</th>
                            <th class="cenText">জমা</th>
                            <th class="cenText">জের</th>
                            <th class="cenText" style="width: 76px;">Delete</th>
                            <th class="cenText" style="width: 59px;">Edit</th>                       
                        </tr>';


                $i = 1;
                $sql = "SELECT * FROM debit_group WHERE project_name_id = '$project_name_id'";
                $result = $db->select($sql);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id           = trim($row['id']);
                        $group_name   = trim($row['group_name']);
                        $group_description = trim($row['group_description']);
                        $taka         = trim($row['taka']);
                        $pices        = trim($row['pices']);
                        $total_taka   = trim($row['total_taka']);
                        $pay          = trim($row['pay']);
                        $due          = trim($row['due']);
                        $group_date   = trim($row['group_date']);

                        if ($group_date == '0000-00-00') {
                            $group_date = '';
                        }
                        $html = '<tr>'
                            . '<td style="text-align:center;">' . $i . '</td>'
                            . '<td style="">' . date("d/m/Y", strtotime($group_date)) . '</td>'
                            . '<td style="">' . $group_name . '</td>'
                            . '<td style="">' . $group_description . '</td>'
                            . '<td style="">' . $taka . '</td>'
                            . '<td style="">' . $pices . '</td>'
                            . '<td style="">' . $total_taka . '</td>'
                            . '<td style="">' . $pay . '</td>'
                            . '<td style="">' . $due . '</td>';

                        if ($delete_data_permission == 'yes') {
                            $html .= '<td align="center"><input type="button" value="Delete" class="btn btn-danger" data_row_id="' . $id . '" onclick="delete_row(this)"></td>';
                        } else {
                            $html .= '<td align="center"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                        }

                        if ($edit_data_permission == 'yes') {
                            $html .= '<td style=""><input type="button" value="Edit" class="btn btn-success" data_row_id="' . $id . '" onclick="displayupdate(this)"></td>';
                        } else {
                            $html .= '<td align="center"><a class="btn btn-success edPermit" disabled>&nbsp;Edit&nbsp</a></td>';
                        }
                        $html .= '</tr>';
                        echo $html;
                        $i++;
                    }
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

        //         var gDate               = $('#gDate' + idNo).val();
        //         var group_name          = $('#group_name' + idNo).val();
        //         var group_description   = $('#group_description' + idNo).val();
        //         var taka                = $('#taka' + idNo).val();
        //         var pices               = $('#pices' + idNo).val();
        //         var total_taka          = $('#total_taka' + idNo).val();
        //         var total_bill          = $('#total_bill' + idNo).val();
        //         var pay                 = $('#pay' + idNo).val();
        //         var due                 = $('#due' + idNo).val();


        //         if(gDate == ""){
        //             alert("তারিখ ফাঁকা হবে না !");
        //             validReturn = false;
        //             return false;
        //         } else {
        //             // validReturn = true;
        //             if(group_name == ""){
        //                 alert("মারফোত গ্রুপের নাম ফাঁকা হবে না !");
        //                 $('#group_name' + idNo).focus();
        //                 // $('#group_name' + idNo).focus().addClass('not-valid');

        //                 validReturn = false;
        //                 return false;
        //             } else if($.isNumeric(group_name)){
        //                 alert("মারফোত গ্রুপের নাম সংখ্যা হতে পারে না !");
        //                 $('#group_name' + idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else if(group_name.length > 40){
        //                 alert("মারফোত গ্রুপের নাম ৪০ অক্ষরের বেশী হতে পারবে না !");
        //                 $('#group_name' + idNo).focus();
        //                 validReturn = false;
        //                 return false;
        //             } else {
        //                 // validReturn = true;
        //                 if(group_description == ""){
        //                     alert("গ্রুপ বিবরণের নাম ফাঁকা হবে না !");
        //                     $('#group_description' + idNo).focus();
        //                     validReturn = false;
        //                     return false;
        //                 } else if($.isNumeric(group_description)){
        //                     alert("গ্রুপ বিবরণের নাম সংখ্যা হতে পারে না !");
        //                     $('#group_description' + idNo).focus();
        //                     validReturn = false;
        //                     return false;
        //                 } else if(group_description.length > 40){
        //                     alert("গ্রুপ বিবরণের নাম ৪০ অক্ষরের বেশী হতে পারবে না !");
        //                     $('#group_description' + idNo).focus();
        //                     validReturn = false;
        //                     return false;
        //                 } else {
        //                     // validReturn = true;
        //                     if(taka == ""){
        //                         alert("দরের নাম ফাঁকা হবে না !");
        //                         $('#taka' + idNo).focus();
        //                         validReturn = false;
        //                         return false;
        //                     } else if($.isNumeric(taka)){
        //                         alert("দরের নাম সংখ্যা হতে পারে না !");
        //                         $('#taka' + idNo).focus();
        //                         validReturn = false;
        //                         return false;
        //                     } else if(taka.length > 40){
        //                         alert("দরের নাম ৪০ অক্ষরের বেশী হতে পারবে না !");
        //                         $('#taka' + idNo).focus();
        //                         validReturn = false;
        //                         return false;
        //                     } else {
        //                         // validReturn = true;
        //                         if(pices == ""){
        //                             alert("জন/পরিমানের নাম ফাঁকা হবে না !");
        //                             $('#pices' + idNo).focus();
        //                             validReturn = false;
        //                             return false;
        //                         } else if($.isNumeric(pices)){
        //                             alert("জন/পরিমানের নাম সংখ্যা হতে পারে না !");
        //                             $('#pices' + idNo).focus();
        //                             validReturn = false;
        //                             return false;
        //                         } else if(pices.length > 40){
        //                             alert("জন/পরিমানের নাম ৪০ অক্ষরের বেশী হতে পারবে না !");
        //                             $('#pices' + idNo).focus();
        //                             validReturn = false;
        //                             return false;
        //                         } else {
        //                             // validReturn = true;
        //                             if(total_taka == ""){
        //                                 alert("মোট টাকার কলাম ফাঁকা হবে না !");
        //                                 $('#total_taka' + idNo).focus();
        //                                 validReturn = false;
        //                                 return false;
        //                             } else if($.isNumeric(total_taka)){
        //                                 alert("মোট টাকার কলাম সংখ্যা হতে পারে না !");
        //                                 $('#total_taka' + idNo).focus();
        //                                 validReturn = false;
        //                                 return false;
        //                             } else if(total_taka.length > 40){
        //                                 alert("মোট টাকার কলাম ৪০ অক্ষরের বেশী হতে পারবে না !");
        //                                 $('#total_taka' + idNo).focus();
        //                                 validReturn = false;
        //                                 return false;
        //                             } else {
        //                                 // validReturn = true;  
        //                                 if(total_bill == ""){
        //                                     alert("নগদ পরি‌ষদের কলাম ফাঁকা হবে না !");
        //                                     $('#total_bill' + idNo).focus();
        //                                     validReturn = false;
        //                                     return false;
        //                                 } else if($.isNumeric(total_bill)){
        //                                     alert("নগদ পরি‌ষদের কলাম সংখ্যা হতে পারে না !");
        //                                     $('#total_bill' + idNo).focus();
        //                                     validReturn = false;
        //                                     return false;
        //                                 } else if(total_bill.length > 40){
        //                                     alert("নগদ পরি‌ষদের কলাম ৪০ অক্ষরের বেশী হতে পারবে না !");
        //                                     $('#total_bill' + idNo).focus();
        //                                     validReturn = false;
        //                                     return false;
        //                                 } else {
        //                                     // validReturn = true;
        //                                     if(pay == ""){
        //                                         alert("জমার কলাম ফাঁকা হবে না !");
        //                                         $('#pay' + idNo).focus();
        //                                         validReturn = false;
        //                                         return false;
        //                                     } else if($.isNumeric(pay)){
        //                                         alert("জমার কলাম সংখ্যা হতে পারে না !");
        //                                         $('#pay' + idNo).focus();
        //                                         validReturn = false;
        //                                         return false;
        //                                     } else if(pay.length > 40){
        //                                         alert("জমার কলাম ৪০ অক্ষরের বেশী হতে পারবে না !");
        //                                         $('#pay' + idNo).focus();
        //                                         validReturn = false;
        //                                         return false;
        //                                     } else {
        //                                         // validReturn = true;  
        //                                         if(due == ""){
        //                                             alert("জের এর কলাম ফাঁকা হবে না !");
        //                                             $('#due' + idNo).focus();
        //                                             validReturn = false;
        //                                             return false;
        //                                         } else if($.isNumeric(due)){
        //                                             alert("জের এর কলাম সংখ্যা হতে পারে না !");
        //                                             $('#due' + idNo).focus();
        //                                             validReturn = false;
        //                                             return false;
        //                                         } else if(due.length > 40){
        //                                             alert("জের এর কলাম ৪০ অক্ষরের বেশী হতে পারবে না !");
        //                                             $('#due' + idNo).focus();
        //                                             validReturn = false;
        //                                             return false;
        //                                         } else {
        //                                             validReturn = true;          
        //                                         }        
        //                                     }
        //                                 }        
        //                             }          
        //                         }       
        //                     }          
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
            $('#gDate1').datepicker({
                onSelect: function(date) {
                    // alert(date);
                    $(this).change();
                },
                dateFormat: "dd/mm/yy",
                changeYear: true,
            }).datepicker("setDate", new Date());
        });

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

        function displayupdate(element) {
            // alert("aaaaaaaaa");
            var row_id = $(element).attr('data_row_id');
            var td_date = $(element).closest('tr').find('td:eq(1)').text();
            var td_name = $(element).closest('tr').find('td:eq(2)').text();
            var td_desc = $(element).closest('tr').find('td:eq(3)').text();
            var td_dor = $(element).closest('tr').find('td:eq(4)').text();
            var td_jon = $(element).closest('tr').find('td:eq(5)').text();
            var td_total = $(element).closest('tr').find('td:eq(6)').text();
            var td_pay = $(element).closest('tr').find('td:eq(7)').text();
            var td_due = $(element).closest('tr').find('td:eq(8)').text();
            // alert(row_id);



            $('#row_id').val(row_id);
            $('#gDate1').val(td_date);
            $('#group_name1').val(td_name);
            $('#group_description1').val(td_desc);
            $('#taka1').val(td_dor);
            $('#pices1').val(td_jon);
            $('#total_taka1').val(td_total);
            $('#pay1').val(td_pay);
            $('#due1').val(td_due);
            $('#add').attr("disabled", "disabled");
            $('#submitBtn').val('Update');
            $('#sucMsg').html('');

            $("html, body").animate({
                scrollTop: 0
            }, 600);
        }


        function delete_row(ele) {
            var data_row_id = $(ele).attr('data_row_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("data_delete_id", data_row_id);
        }

        $(document).on('click', '#verifyToDeleteBtn', function(event) {
            var delete_id = $(event.target).attr('data_delete_id');
            $("#passMsg").html("").css({
                'margin': '0px'
            });
            var pass = $("#matchPassword").val();
           // alert(pass);
            $.ajax({
                url: "../ajaxcall/match_password_for_vaucher_credit.php",
                type: "post",
                data: {
                    pass: pass
                },
                success: function(response) {
                   // alert(response);
                    if (response == 'password_matched') {
                        $("#verifyPasswordModal").hide();
                        ConfirmDialog('Are you sure delete vaucher khat and its dependent datas?', delete_id);
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

            function ConfirmDialog(message, delete_id) {
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
                                $.post("add_vaucher_group.php", {
                                    delete_id: delete_id
                                }, function(data, status) {
                                    console.log(status);
                                    if (status == 'success') {
                                        // $('#sucMsg').html('succsess');
                                        window.location.href = 'add_vaucher_group.php';
                                    }
                                });

                                // $.get("agrim_hisab.php?delete_id="+delete_id, function(data, status){
                                //   console.log(status);
                                //   if(status == 'success'){
                                //     window.location.href = 'agrim_hisab.php';
                                //   }
                                // });
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
        });
    </script>
    <script src="../js/common_js.js"></script>
</body>

</html>