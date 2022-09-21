<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];
    
    $_SESSION['pageName'] = 'agrim_hisab';


    
    $sucMsg = "";
    if (isset($_POST['submit'])){
        if($_POST['submit'] == 'Submit'){
            for ($i = 0; $i < count($_POST['credit_name']); $i++){
                $postDateArr        = explode('/', $_POST['credit_date'][$i]);
                $credit_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
                $credit_name        = trim($_POST['credit_name'][$i]);
                $credit_amount      = trim($_POST['credit_amount'][$i]);
                $credit_khoros      = trim($_POST['credit_khoros'][$i]);
                $credit_jer         = trim($_POST['credit_jer'][$i]);
                if($credit_amount == ''){
                    $credit_amount = 0;
                }
                if($credit_khoros == ''){
                    $credit_khoros = 0;
                }
                if($credit_jer == ''){
                    $credit_jer = 0;
                }


                $query = "INSERT INTO agrim_hisab(agrim_name, agrim_amount, agrim_khoros, agrim_jer, agrim_date, project_name_id) VALUES ('$credit_name', '$credit_amount', '$credit_khoros', '$credit_jer', '$credit_date', '$project_name_id')";
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
            $credit_khoros      = trim($_POST['credit_khoros'][$i]);
            $credit_jer         = trim($_POST['credit_jer'][$i]);
            if($credit_amount == ''){
                $credit_amount = 0;
            }
            if($credit_khoros == ''){
                $credit_khoros = 0;
            }
            if($credit_jer == ''){
                $credit_jer = 0;
            }
            $credit_id          = trim($_POST['agirm_id']);

            $query = "UPDATE agrim_hisab SET agrim_name = '$credit_name', agrim_amount = '$credit_amount', agrim_khoros = '$credit_khoros', agrim_jer = '$credit_jer', agrim_date = '$credit_date' WHERE id = '$credit_id'";
            $result = $db->insert($query);
            if ($result) {
               $sucMsg = 'Agrimi Updated successfully !';
            } else {
                $sucMsg = 'Data is not updated !';
            }
        }
    // unset($_POST);
    }


    if(isset($_POST['delete_id'])){
        $delete_agrimi = $_POST['delete_id'];

        $sql = "DELETE FROM agrim_hisab WHERE id = '$delete_agrimi'";
        $result = $db->delete($sql);
        if ($result) {
            $sucMsg = "Agrimi delete successfully.";
        } else {
            echo "Error: " . $sql . "<br>" .$db->error;
        }
    }




    $total_taka_calculation = 0;
    $total = 0;
    $total_due = 0;
    $all_debit_due  = 0;
    $total_pabe_amount = 0;
    $total_p_amount = 0;
    $deu_pay_total = 0;

    $sql_qrys="SELECT SUM(credit_amount) AS total_credit FROM vaucher_credit WHERE project_name_id = '$project_name_id'";

    $credit = $db->select($sql_qrys);
    while($credit_record = $credit->fetch_array()){
        $credit_total = $credit_record['total_credit'];
    }




    $query = "SELECT * FROM debit_group WHERE project_name_id = '$project_name_id'";
    $read = $db->select($query);
    if ($read) {
        while ($row = $read->fetch_assoc()) {
            $debit_group_id = $row['id'];


            $qrys = "UPDATE debit_group_data SET group_total_taka = group_taka * group_pices";
            $result = $db->update($qrys);

            $sql_qry_debit_due="SELECT SUM(group_total_taka) AS debit_due FROM debit_group_data WHERE group_id =$debit_group_id";
            $duration_debit_due = $db->select($sql_qry_debit_due);
            while($record_debit_due = $duration_debit_due->fetch_array()){
                $total_debit_due = $record_debit_due['debit_due'];
                $total += $total_debit_due;
            } 

            $sql_pabe_amount="SELECT SUM(pabe_amount) AS pabe_amount FROM jara_pabe WHERE project_name_id = '$project_name_id'";
            $duration_pabe_amount = $db->select($sql_pabe_amount);
            while($record_pabe_amount = $duration_pabe_amount->fetch_array()){
                $pabe_amount = $record_pabe_amount['pabe_amount'];
            } 


            $sql_qry_debit_group_pay="SELECT SUM(group_pay) AS group_pay FROM debit_group_data WHERE group_id =$debit_group_id";
            $duration_debit_group_pay = $db->select($sql_qry_debit_group_pay);
            while($record_debit_group_pay = $duration_debit_group_pay->fetch_array()){
                $group_pay = $record_debit_group_pay['group_pay'];
            }

            $debit_pay=$total_debit_due-$group_pay;
            $all_debit_due +=$debit_pay;
            $total_pabe_amount += $pabe_amount;
            $deu_pay_total=array();

            $qry = "SELECT * FROM debit_group_data WHERE group_id = $debit_group_id";
            $reads = $db->select($qry);
            if ($reads) {
                $cnt=0;
                while ($row = $reads->fetch_assoc()) {
                    if($cnt==0){
                        $deu_pay_total[$debit_group_id] = $row['group_pay'];
                        $cnt++;
                    }
                }
            }
        }
    }
    $debit_pay=$total_debit_due-$group_pay;

    if(!empty($all_debit_due) && !empty($pabe_amount)){
        $total_p_amount=$all_debit_due+$pabe_amount; 
    } else if(!empty($all_debit_due)){
        $total_p_amount=$all_debit_due; 
    } else if(!empty($pabe_amount)){
        $total_p_amount=$pabe_amount; 
    }
    $due_credit_amount = 0;
    $due_debit_amount = 0;  
    $query = "SELECT id, due_credit_amount, due_debit_amount, due_debit_date FROM due WHERE project_name_id = '$project_name_id'";
    $show = $db->select($query);
    if ($show) {
        while ($rows = $show->fetch_assoc()) {
            $due_debit_amount = $rows['due_debit_amount'];
        }
    }


    $final_khoros = $total+ $due_debit_amount - $total_p_amount;
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
            position: absolute;
            right: 0px;
        }
        .showAgrim{
            width: 100%;
                       
        }
        .showAgrim tr th{
            text-align: center;
            padding: 4px;
            background-color: #b5b5b5;
        }
        .showAgrim tr th, .showAgrim tr td{
            border: 1px solid #ddd;
            padding: 4px;
        }
        .noborderSet{
            border: none !important;
        }
    </style>
    <script>
        $(document).ready(function(){
            var i = 1;
            $('#add').click(function(){
                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="credit_date[]" class="form-control dateInput dtCount" id="cDate'+i+'" placeholder="DD/MM/YYYY"/></td><td><input type="text" name="credit_name[]" class="form-control" size="100" placeholder="মারফোত নাম" id="credit_name'+i+'"/></td><td><input type="text" name="credit_amount[]" class="form-control calc'+i+'" placeholder="জমাঃ" id="credit_amount'+i+'"/></td><td><input type="text" name="credit_khoros[]" class="form-control payCalc'+i+'" placeholder="খরচ" id="credit_khoros'+i+'"/></td><td><input type="text" name="credit_jer[]" class="form-control" placeholder="জের" id="credit_jer'+i+'"/></td><td class="cenText"><button type="button" name="add" id="add" class="btn btn-success disabled">+</button></td><td class="cenText"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');

                $('#sucMsg').html('');
                calculation(i);
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
    <div class="container"> 
      <!-- <div class="backcircle">
        <a href="../vaucher/doinik_all_hisab.php">
          <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
        </a>
      </div> -->         
    </div>

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
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">অগ্রিম খাত এন্ট্রি</span>
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
                        <th class="cenText">টাকা</th>
                        <th class="cenText">খরচ</th>
                        <th class="cenText">জের</th>
                        <th class="cenText">Add</th>
                        <th class="cenText">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="hidden" name="agirm_id" id="agirm_id">
                            <input type="text" name="credit_date[]" class="form-control dateInput dtCount" id="cDate1" placeholder="DD/MM/YYYY"/>
                        </td>
                        <td><input type="text" name="credit_name[]" class="form-control" size="100" placeholder="মারফোত নাম" id="credit_name1"/></td>
                        <td><input type="text" name="credit_amount[]" class="form-control calc1" placeholder="টাকা" id="credit_amount1"/></td>
                        <td><input type="text" name="credit_khoros[]" class="form-control payCalc1" placeholder="খরচ" id="credit_khoros1"/></td>
                        <td><input type="text" name="credit_jer[]" class="form-control" placeholder="জের" id="credit_jer1"/></td>
                        <td class="cenText"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                        <td class="cenText"><button type="button" name="remove" id="1" class="btn btn-danger btn_remove disabled">-</button></td>
                    </tr>
                </tbody>
                </table>
                <div class="form-group" style="position: relative;">
                    <input type="submit" class="btn btn-primary submitBtn" name="submit" value="Submit" id="submitBtn">
                </div>
                <div class="form-group">
                    <h4 class="text-success text-center" id="sucMsg"><?php echo $sucMsg; ?></h4>
                </div>
            </form>

            <div>
                <br><br>
                <h3 class="text-center">অগ্রিমি</h3>
                <?php
                    echo "<table class='showAgrim'>";
                    echo "<tr>";
                        echo "<th width='80px'>ক্রমিক নং</th>";
                        echo "<th width='100px'>তারিখ</th>";
                        echo "<th>মারফোত নাম</th>";
                        echo "<th>টাকা</th>";
                        echo "<th>খরচ</th>";
                        echo "<th>জের</th>";
                        echo "<th>Delete</th>";
                        echo "<th>Edit</th>";
                    echo "</tr>";
                    $agrim_total_amount = 0;
                    $agrim_total_khoros = 0;
                    $agrim_total_jer = 0;
                    $sql ="SELECT * FROM agrim_hisab WHERE project_name_id = '$project_name_id'";
                    $result = $db->select($sql);
                    if($result){
                        $i = 1;
                        while($rows = $result->fetch_assoc()){
                            $id = $rows['id'];
                            $agrim_name = $rows['agrim_name'];
                            $agrim_amount = trim($rows['agrim_amount']);
                            $agrim_khoros = trim($rows['agrim_khoros']);
                            $agrim_jer = trim($rows['agrim_jer']);
                            $agrim_date = $rows['agrim_date'];
                            if($agrim_date == '0000-00-00'){
                                $agrim_date = '';
                            }
                            if($agrim_amount == ''){
                                $agrim_amount = 0;
                            }
                            if($agrim_khoros == ''){
                                $agrim_khoros = 0;
                            }
                            if($agrim_jer == ''){
                                $agrim_jer = 0;
                            }
                            $agrim_total_amount += $agrim_amount;
                            $agrim_total_khoros += $agrim_khoros;
                            $agrim_total_jer += $agrim_jer;

                            echo "<tr>";
                                echo "<td class='text-center'>". $i . "</td>";
                                echo "<td>". date("d/m/Y", strtotime($agrim_date)) . "</td>";
                                echo "<td>". $agrim_name . "</td>";
                                echo "<td class='text-right' agrim_amount='".$agrim_amount."'>". number_format($agrim_amount, 2) . "</td>";
                                echo "<td class='text-right' agrim_khoros='".$agrim_khoros."'>". number_format($agrim_khoros, 2) . "</td>";
                                echo "<td class='text-right' agrim_jer='".$agrim_jer."'>". number_format($agrim_jer, 2) . "</td>";
                                                                
                                if($delete_data_permission == 'yes'){
                                    echo "<td width='78px' align='center'><a class='btn btn-danger agrimiDelete' data_delete_id=" . $id . ">Delete</a></td>";
                                } else {
                                    echo '<td width="78px" align="center"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                                }

                                if($edit_data_permission == 'yes'){
                                    echo "<td width='60px' align='center'><a class='btn btn-success' onclick='displayupdate(this, ".$id.")'>&nbsp;Edit&nbsp;</a></td>";
                                } else {
                                    echo '<td width="78px" align="center"><a class="btn btn-success edPermit" disabled>&nbsp;Edit&nbsp;</a></td>';
                                }
                                
                            echo "</tr>";
                            $i++;
                        }
                    }

                        echo "<tr>";
                            echo "<td class='text-right' colspan='3'>মোটঃ</td>";
                            echo "<td class='text-right'>".number_format($agrim_total_amount, 2)."</td>";
                            echo "<td class='text-right'>".number_format($agrim_total_khoros, 2)."</td>";
                            echo "<td class='text-right'>".number_format($agrim_total_jer, 2)."</td>";
                            echo "<td class=''></td>";
                            echo "<td class=''></td>";
                        echo "</tr>";
                        // echo "<tr>";
                        //     echo "<td class='noborderSet'></td>";
                        //     echo "<td class='noborderSet'></td>";
                        //     echo "<td class='text-right'>খরচঃ</td>";
                        //     echo "<td class='text-right'>".$final_khoros."</td>";
                        //     echo "<td class='noborderSet'></td>";
                        //     echo "<td class='noborderSet'></td>";
                        // echo "</tr>";
                        // echo "<tr>";
                        //     echo "<td class='noborderSet'></td>";
                        //     echo "<td class='noborderSet'></td>";
                        //     echo "<td class='text-right'>জেরঃ</td>";
                        //     echo "<td class='text-right'>".($final_khoros - $agrim_total_amount)."</td>";
                        //     echo "<td class='noborderSet'></td>";
                        //     echo "<td class='noborderSet'></td>";
                        // echo "</tr>";
                    echo "</table>"
                ?>
            </div>
        </div>
    </div>
    <?php include '../others_page/delete_permission_modal.php';  ?>

    <script type="text/javascript">
        function calculation(i){
            $('#cDate'+i).datepicker( {
                onSelect: function(date) {
                    // alert(date);
                    $(this).change();
                },
                dateFormat: "dd/mm/yy",
                changeYear: true,
            }).datepicker("setDate", new Date());

            $(document).on('input', '.calc'+i, function(){
                var amount = $('#credit_amount'+i).val();
                if(amount == ''){
                    $('#credit_khoros'+i).val('');
                    $('#credit_jer'+i).val('');
                } else {
                    $('#credit_khoros'+i).val(0);
                    $('#credit_jer'+i).val(0);
                }
            });
            $(document).on('input', '.payCalc'+i, function(){
                var amount = $('#credit_amount'+i).val();
                var khoros = $('#credit_khoros'+i).val();
                if(amount !== '' && khoros !==''){
                    var jer = amount - khoros;
                    $('#credit_jer'+i).val(jer);
                } else {
                    $('#credit_jer'+i).val('0');
                }
            });
        }
        calculation(1);
    </script>
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
        $(document).on('click', '.agrimiDelete', function(event){          
            var data_delete_id = $(event.target).attr('data_delete_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("data_delete_id", data_delete_id);
        });
        $(document).on('click', '#verifyToDeleteBtn', function(event){
            var delete_id = $(event.target).attr('data_delete_id');
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
                        ConfirmDialog('Are you sure delete agrimi info?');
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
                                            $.post("agrim_hisab.php", {delete_id : delete_id}, function(data, status){
                                              console.log(status);
                                              if(status == 'success'){
                                                // $('#sucMsg').html('succsess');
                                                window.location.href = 'agrim_hisab.php';
                                              }
                                            });

                                            // $.get("agrim_hisab.php?delete_id="+delete_id, function(data, status){
                                            //   console.log(status);
                                            //   if(status == 'success'){
                                            //     window.location.href = 'agrim_hisab.php';
                                            //   }
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
            }
        });        
    </script>
    <script type="text/javascript">
        function displayupdate(element, id){
            // alert("aaaaaaaaa");
            var td_date   = $(element).closest('tr').find('td:eq(1)').text();
            var td_name   = $(element).closest('tr').find('td:eq(2)').text();
            // var td_amount = $(element).closest('tr').find('td:eq(3)').text();
            var td_amount = $(element).closest('tr').find('td:eq(3)').attr('agrim_amount');
            var td_khoros = $(element).closest('tr').find('td:eq(4)').attr('agrim_khoros');
            var td_jer = $(element).closest('tr').find('td:eq(5)').attr('agrim_jer');
            // alert(td_mobile);

            // function val_without_format(td_amount){
            //     var arr = td_amount.split('.');
            //     var partval = arr[0].split(',');
            //     var wholeVal = '';
            //     for(var i = 0; i < partval.length; i++){
            //         wholeVal += partval[i];
            //     }
            //     return wholeVal;
            // }
            // alert(val_without_format(td_amount));

            $('#agirm_id').val(id);
            $('#cDate1').val(td_date);
            $('#credit_name1').val(td_name);
            $('#credit_amount1').val(td_amount);
            $('#credit_khoros1').val(td_khoros);
            $('#credit_jer1').val(td_jer);

            $('#add').attr("disabled", "disabled");
            $('#submitBtn').val('Update');
            $('#sucMsg').html('');
            
            $("html, body").animate({ scrollTop: 0 }, 600);
        }


        function heightChange(){
            if($('.main_bar').innerHeight() > $('.left_side_bar').height()){
                $('.left_side_bar').height($('.main_bar').innerHeight() + 34);
            } else {
                $('.left_side_bar').height(550);
            }
        }
        heightChange();
    </script>
    <script type="text/javascript">
        $(document).on("click", ".kajol_close, .cancel", function(){
            $("#verifyPasswordModal").hide();
        });
    </script>
    <script src="../js/common_js.js"> </script>
</body>
</html>