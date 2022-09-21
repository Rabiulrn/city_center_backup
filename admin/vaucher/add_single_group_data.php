<?php 
    session_start();
    if(!isset($_SESSION['username']) ){    
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];
    
    $group_id = 0;
    $group_id = $_GET['add_id'];
    $sucMsg ='';

   
    
    // insert data into debit_group_data table 
    // if (isset($_POST['submit'])) {
    //     $newFormatDate ='';
    //     $query = "SELECT * FROM debit_group WHERE id = $group_id";
    //     $read = $db->select($query);
    //     if ($read) {
    //         $row = $read->fetch_assoc();    
    //         $group_date_insert  = $row['group_date'];
    //         // echo '<script> alert("a' . $group_date_insert . '")</script>';
    //         $time = strtotime($group_date_insert);
    //         $newFormatDate = date('Y-m-d', $time);
    //     }
    //     for ($i = 0; $i < count($_POST['group_name']); $i++) {
    //         $postDateArr        = explode('/', $_POST['entry_date'][$i]);      
    //         $entry_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

    //         $group_name        = $_POST['group_name'][$i];
    //         $group_description = $_POST['group_description'][$i];
    //         $taka              = $_POST['taka'][$i];
    //         $pices             = $_POST['pices'][$i];
    //         $total_taka        = $_POST['total_taka'][$i];
    //         $total_bill        = $_POST['total_bill'][$i];
    //         $pay               = $_POST['pay'][$i];
    //         $due               = $_POST['due'][$i];
            
    //         $query = "INSERT INTO debit_group_data(entry_date, group_name, group_description, group_taka, group_pices, group_total_taka, group_total_bill, group_pay, group_due, group_id, dg_date, project_name_id) VALUES ('$entry_date', '$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$total_bill', '$pay', '$due', '$group_id', '$newFormatDate', '$project_name_id')";
    //         $result = $db->insert($query);
    //         if ($result) {          
    //             $sucMsg = 'Data is inserted successfully !';
    //             $_SESSION['entry_date'] = $entry_date;
    //         } else {
    //             $sucMsg = 'Data is not inserted !';
    //         }
    //     }
    // }

 

    //delete data part
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

    // if (isset($_POST['set'])) {
    //     //print_r($_POST);
    //     $pay_due_total  = $_POST['pay_due_total'];
    //     $get_ids           = $_POST['id']; //table row id 
    //     $entry_date_modal = $_POST['entry_date_modal'];
    //     if($entry_date_modal == 'none'){

    //     } else {
    //         if ($get_ids > 0) {
    //           $query = "UPDATE debit_group_data SET group_pay='$pay_due_total' WHERE entry_date = '$entry_date_modal' AND  group_id='$get_ids' AND project_name_id = '$project_name_id' ORDER BY id LIMIT 1";
    //             $update = $db->update($query);
    //             if ($update) {
    //                 // echo "<script>window.location.href = 'add_single_group_data.php?add_id=$get_id'</script>";
    //               $sucMsg = 'New value set successfully.';
    //             } else {
    //                 echo "<script>alert('Data is not Updated !')</script>";
    //             }
    //         }
    //     }
    // }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Single group data</title>
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
        /*.table > thead > tr > th {
            border-bottom: 2px solid #ddd;
        }
        .table-bordered > thead > tr > th {
            border: 1px solid #ddd;
        }*/
        .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
            border: 1px solid #ddd !important;
        }
        .table-bordered > tbody > tr > th {
            border: 2px solid #b9b9b9;
        }
        .centerTxt{
            text-align: center;
        }
        .backcircle{
            font-size: 18px;
            position: absolute;
            margin-top: -30px;
        }
        .backcircle a:hover{
            text-decoration: none !important;
        }
        .part{
            padding: 5px 0px 10px;
            /*width: 125px;
            display: inline-block;*/
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
        tbody tr:nth-child(even) {
            background-color: #eee;
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
    <!-- add remove field script -->
    <script>
        function newRowAdd(ival){
            var i = ival;
                var group_name_placeholder = $('#group_name1').attr('placeholder');
                var group_description_placeholder = $('#group_description1').attr('placeholder');
                var taka_placeholder = $('#taka1').attr('placeholder');
                var pices_placeholder = $('#pices1').attr('placeholder');
                var total_tk_placeholder = $('#total_taka1').attr('placeholder');
                // var total_bill_placeholder = $('#total_bill1').attr('placeholder');
                var total_pay_placeholder = $('#pay1').attr('placeholder');
                var total_due_placeholder = $('#due1').attr('placeholder');

                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="entry_date[]" class="form-control" id="entry_date'+i+'" placeholder="dd-mm-yyyy" /></td><td><input type="text" name="group_name[]" class="form-control" size="100" id="group_name'+i+'" placeholder="'+group_name_placeholder+'"/></td><td><input type="text" name="group_description[]" class="form-control" size="100" id="group_description'+i+'" placeholder="'+group_description_placeholder+'"/></td><td><input type="text" name="taka[]" class="form-control tkCount calc'+i+'" size="40" id="taka'+i+'" placeholder="'+taka_placeholder+'"/></td><td><input type="text" name="pices[]" class="form-control calc'+i+'" size="40" id="pices'+i+'" placeholder="'+pices_placeholder+'"/></td><td><input type="text" name="total_taka[]" class="form-control" id="total_taka'+i+'" placeholder="'+total_tk_placeholder+'"/></td><td><input type="text" name="pay[]" class="form-control payCalc'+i+'"  id="pay'+i+'" placeholder="'+total_pay_placeholder+'"/></td><td><input type="text" name="due[]" class="form-control" id="due'+i+'" placeholder="'+total_due_placeholder+'"/></td><td class="centerTxt"><button type="button" class="btn btn-success disabled">+</button></td><td class="centerTxt"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');

                // <td><input type="text" name="total_bill[]" class="form-control" id="total_bill'+i+'" placeholder="'+total_bill_placeholder+'"/></td>


                var datePicker = document.createElement("script");
                  datePicker.innerHTML = '$(function() { $("#entry_date'+i+'").datepicker( {  onSelect: function(date) { $(this).change(); }, dateFormat: "dd/mm/yy", changeYear: true, }).datepicker("setDate", new Date()); });';
                  datePicker.setAttribute("id", "script-"+i);
                  $("body").append(datePicker);

                var calculation = document.createElement("script");
                calculation.innerHTML = '$(document).on("input", ".calc'+i+'", function(){var taka = $("#taka'+i+'").val();var pices = $("#pices'+i+'").val();var pay = $("#pay'+i+'").val();if(taka !== "" && pices !==""){var total_taka = taka * pices;$("#total_taka'+i+'").val(total_taka);$("#pay'+i+'").val(0);$("#due'+i+'").val(total_taka);} else {$("#total_taka'+i+'").val(0);$("#pay'+i+'").val(0);$("#due'+i+'").val(0);}});$(document).on("input", ".payCalc'+i+'", function(){var total_taka = $("#total_taka'+i+'").val();var pay = $("#pay'+i+'").val();if(total_taka !== "" && pay !==""){var due = total_taka - pay;$("#due'+i+'").val(due);}});';
                calculation.setAttribute("id", "calculation-"+i);
                $("body").append(calculation);
        }

        var i = 1;
        $(document).on('click','#add', function(){            
            newRowAdd(i);
            i++;
        });
        
        $(document).on('click','.btn_remove', function(){
            var button_id = $(this).attr("id");
            // alert(button_id);
            if(button_id == 1){

            } else{
              // alert("Data row removed successfully !");
              // $("#row"+button_id+"").remove();
              ConfirmDialog('Are you sure remove the row ?');
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
                                              $("#script-"+button_id+"").remove();
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
    </script>
</head>
<body>
    <?php
        include '../navbar/header_text.php';
        include '../navbar/navbar.php';    
    ?> 
    <div class="container" style="margin-bottom: 100px; width: 95%;">
        <?php 
            $ph_id = $_SESSION['project_name_id'];
            $query = "SELECT * FROM project_heading WHERE id = $ph_id";
            $show = $db->select($query);
            if ($show) {
                while ($rows = $show->fetch_assoc()) {
                ?>
                    <div class="project_heading text-center">      
                        <h2 class="text-center" style="font-size: 25px; "><?php echo $rows['heading']; ?></h2>
                        <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
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
            <form action="" method="POST" onsubmit="return validation()" id="insertDatas">
                <div class="part">
                    তারিখঃ 
                    <?php
                        $sql = "SELECT DISTINCT entry_date FROM debit_group_data WHERE group_id = '$group_id' AND project_name_id = '$project_name_id' ORDER BY entry_date DESC";
                        $result = $db->select($sql);
                        echo '<select id="debit_group_date_list" style="width: 125px">';
                        echo '<option value ="'.date("Y-m-d").'">'.date("d/m/Y").'</option>';
                        echo '<option value ="none">All Dates...</option>';
                        if($result && mysqli_num_rows($result) > 0){
                            while ($date = $result->fetch_assoc()) {
                                $entry_date = $date['entry_date'];
                                if( $entry_date !== '0000-00-00'){
                                    echo '<option value="' . $entry_date . '">' . date("d/m/Y", strtotime($entry_date)) . '</option>';
                                }                                
                            }                            
                        }
                        echo '</select>';
                    ?>
                </div>
                <table class="table table-bordered table-condensed" id="dynamic_field">          
                    <?php
                        $group_name         = '';
                        $group_description  = '';
                        $taka         = '';
                        $pices        = '';
                        $total_taka   = '';
                        $total_bill   = '';
                        $pay          = '';
                        $due          = '';
                        $pay_for_modal = '';
                        
                        $query = "SELECT * FROM debit_group WHERE id = '$group_id' AND project_name_id = '$project_name_id'";
                        $read = $db->select($query);
                        if ($read) {
                            while ($row = $read->fetch_assoc()) {
                                $postDateArr        = explode('-', $row['group_date']);
                                $credit_date        = $postDateArr['2'].'/'.$postDateArr['1'].'/'.$postDateArr['0'];
                                

                                $group_name         = $row['group_name'];
                                $group_description  = $row['group_description'];
                                $taka               = $row['taka'];
                                $pices              = $row['pices'];
                                $total_taka         = $row['total_taka'];
                                $total_bill         = $row['total_bill'];
                                $pay                = $row['pay'];
                                $due                = $row['due'];
                            ?>
                            <thead>
                                <tr style="background-color: #bbb;">
                                    <th class="centerTxt" width="112px">তারিখ</th>
                                    <th class="centerTxt"><?php echo $row['group_name']; ?></th>
                                    <th class="centerTxt"><?php echo $row['group_description']; ?></th>
                                    <th class="centerTxt"><?php echo $row['taka']; ?></th>
                                    <th class="centerTxt"><?php echo $row['pices']; ?></th>
                                    <th class="centerTxt"><?php echo $row['total_taka']; ?></th>
                                    <!-- <th class="centerTxt"><?php //echo $row['total_bill']; ?></th> -->
                                    <th class="centerTxt"><?php echo $row['pay']; $pay_for_modal =$row['pay']; ?></th>
                                    <th class="centerTxt"><?php echo $row['due']; ?></th>
                                    <th class="centerTxt">Delete</th>
                                    <th class="centerTxt">
                                        <?php
                                            if($edit_data_permission == 'yes'){
                                                echo '<a href="update_add_vaucher_group.php?edite_id=' . $row['id'] . '" class="btn btn-success">&nbsp;Edit&nbsp;</a>';
                                            } else {
                                                echo '<a class="btn btn-success edPermit" disabled>&nbsp;Edit&nbsp;</a>';
                                            }
                                        ?>
                                  	</th>
                                </tr>
                            </thead>
                            <?php 
                            }
                        }
                    ?>

                    
                    <tbody>
                        <tr class="entryRow">
                            <td><input type="text" name="entry_date[]" class="form-control" id="entry_date1" placeholder="dd/mm/yyyy" /></td>
                            <td><input type="text" name="group_name[]" class="form-control" size="100" id="group_name1" placeholder="<?php echo $group_name;?>" /></td>
                            <td><input type="text" name="group_description[]" class="form-control" size="100" id="group_description1" placeholder="<?php echo $group_description;?>" /></td>
                            <td><input type="text" name="taka[]" class="form-control tkCount calc1" size="40" id="taka1" placeholder="<?php echo $taka; ?>" /></td>
                            <td><input type="text" name="pices[]" class="form-control calc1" size="40" id="pices1" placeholder="<?php echo $pices; ?>" /></td>
                            <td><input type="text" name="total_taka[]" class="form-control" id="total_taka1" placeholder="<?php echo $total_taka; ?>" /></td>
                            <!-- <td><input type="text" name="total_bill[]" class="form-control"  id="total_bill1" placeholder="<?php //echo $total_bill; ?>" /></td> -->
                            <td><input type="text" name="pay[]" class="form-control payCalc1" id="pay1" placeholder="<?php echo $pay; ?>" /></td>
                            <td><input type="text" name="due[]" class="form-control" id="due1" placeholder="<?php echo $due; ?>" /></td>

                            <td class="centerTxt"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                            <td class="centerTxt"><button type="button" name="remove" id="1" class="btn btn-danger btn_remove disabled">-</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <input type="hidden" class="" name="group_id" value="<?php echo $group_id; ?>" id="group_id">
                    <input type="button" class="form-control btn btn-primary" name="submit" id="submitBtn" value="Submit">
                </div>
                <div class="form-group">
                    <h3 class="text-center text-success" id="sucMsg"><?php echo $sucMsg; ?></h3>
                </div>
        </form>   
    </div>
    <?php include '../others_page/delete_permission_modal.php';  ?>


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">      
            <!-- Modal content-->
            <form action="" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" id="closeModal">&times;</button>
                        <h4 class="modal-title">Set <?php echo $pay_for_modal; ?> amount</h4>
                    </div>
                    <div class="modal-body">                    
                        <input type="text" name="pay_due_total" class="form-control" id='pay_due_total'/>
                        <input type="hidden" name="id" value="<?php echo $group_id; ?>" id="get_id">
                        <input type="hidden" name="entry_date_modal" value="" id="entry_date_modal">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="button" name="set" class="btn btn-primary" id="set" value="SET" />
                        <!-- <h3><?php //echo $modalValueSet; ?></h3> -->
                    </div>
                </div>
            </form>        
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
    </script>
    <script type="text/javascript">
        $(document).on('click', '#modal', function(){
            var joma = $(this).closest('tr').find('th').eq(7).text().trim();
            // alert(joma);
            $('#pay_due_total').val(joma);
            var dateval = $('#debit_group_date_list option:selected').val();
            // alert(dateval);            
            $('#entry_date_modal').val(dateval);            
        });

        $(document).on('click', '#set', function(){
             var pay_due_total = $('#pay_due_total').val();
             var get_id = $('#get_id').val();
             var entry_date_modal = $('#entry_date_modal').val();
             updateModal(pay_due_total, get_id, entry_date_modal);
        });

        function updateModal(pay_due_total, get_id, entry_date_modal){
            $.ajax({
                url: '../ajaxcall_save_update/update_modal.php',
                type: 'post',
                data: {
                    pay_due_total: pay_due_total,
                    get_id: get_id,
                    entry_date_modal: entry_date_modal
                },
                success: function(res){
                    // alert(res);
                    $('#closeModal').trigger('click');
                    if(res == 'New value set successfully.'){
                        // var group_id = "<?php echo $group_id; ?>";
                        getGroupIdAndDateWiseData(entry_date_modal, get_id);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    </script>    
    <script type="text/javascript">
        function removeScripts(){
            $('script[id^="script-"]').each(function() {
                // alert( this.id );
                $(this).remove();
            });
            $('script[id^="calculation-"]').each(function() {
                // alert( this.id );
                $(this).remove();
            });
        }
        $(document).on('change', '#debit_group_date_list', function(){
            var date = $('#debit_group_date_list option:selected').val();
            var group_id = "<?php echo $group_id; ?>";
            // alert(date);
            var today = "<?php echo date("Y-m-d"); ?>";
            // alert(today);
            removeScripts();
            if(date == today){
                getGroupIdAndDateWiseData(date, group_id);
            } else if(date == 'none'){
                // window.location.href = "../vaucher/add_single_group_data.php?add_id=" + group_id;
                // alert(date);
                getAllDatesData(group_id);
            } else {
                getGroupIdAndDateWiseData(date, group_id);
            }
            $('#sucMsg').html('');
        });

        function getGroupIdAndDateWiseData(date, group_id){
            $.ajax({
                url: '../ajaxcall/get_group_id_and_date_wise_data.php',
                type: 'post',
                data: {
                  date: date,
                  group_id: group_id
                },
                success: function(res){
                    // alert(res);
                    $('#dynamic_field').html(res);
                    $('#entry_date1').datepicker( {
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd/mm/yy",
                        changeYear: true,
                    }).datepicker("setDate", new Date(date));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function getAllDatesData(group_id){
            $.ajax({
                url: '../ajaxcall/get_group_id_and_all_dates_data.php',
                type: 'post',
                data: {
                    group_id: group_id
                },
                success: function(res){
                    // alert(res);
                    $('#dynamic_field').html(res);
                    $('#entry_date1').datepicker( {
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
        $(document).on('click', '.sgdDelete', function(event){          
            var dels_id = $(event.target).attr('data-dels_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("data-dels_id", dels_id);
        });
        $(document).on('click','#verifyToDeleteBtn', function(event){                
              event.preventDefault();
              var dels_id = $(event.target).attr('data-dels_id');
              console.log(dels_id);
              var date = $('#debit_group_date_list option:selected').val();
              var group_id = "<?php echo $group_id; ?>";

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
                          ConfirmDialog('Are you sure to delete khoros khat entry ?');
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
                                                    // window.location.href = 'add_single_group_data.php?'+getId;
                                                    if(date == 'none'){
                                                        getAllDatesData(group_id);
                                                    } else {
                                                        getGroupIdAndDateWiseData(date, group_id);
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
        // var sucMsg = $('#sucMsg').html();
        // if(sucMsg == 'Data is inserted successfully !'){
        //     var date = $('#debit_group_date_list option:selected').val();
        //     console.log(date);
        //     var group_id = "<?php echo $group_id; ?>";
        //     getGroupIdAndDateWiseData(date, group_id);
        // } else if(sucMsg == 'New value set successfully.'){
            
        // } else{
            
        // }
    </script>
    <script type="text/javascript">        
        $(document).on('click', '#submitBtn', function(){
            var formElement = $('#insertDatas')[0];
            var formData = new FormData(formElement);            
            console.log(formData);
            $.ajax({
                url: '../ajaxcall_save_update/insert_debit_group_datas.php',
                type: 'post',
                dataType: 'html',
                processData: false,
                contentType: false,
                data: formData,
                success: function(res){
                    // alert(res);
                    var date = $('#debit_group_date_list option:selected').val();
                    var group_id = $('#group_id').val();
                    if(date == 'none'){
                        getAllDatesData(group_id);

                    } else {
                        getGroupIdAndDateWiseData(date, group_id);
                    }
                    $('#sucMsg').html(res);               
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThrown);
                }
            });
        });
    </script>
    <script type="text/javascript" id="script-1">
      $(function() {
          $('#entry_date1').datepicker( {
              onSelect: function(date) {
                  // alert(date);
                  $(this).change();
              },
              dateFormat: "dd/mm/yy",
              changeYear: true,
          }).datepicker("setDate", new Date());
      });
        $('#debit_group_date_list').select2({ width: 'resolve' }).on('select2:open', function(e){
            $('.select2-search__field').attr('placeholder', 'Search...');          
        });
    </script>
    <script type="text/javascript" id="calculation-1">
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
    </script>
    <script type="text/javascript">
      $(document).on("click", ".kajol_close, .cancel", function(){
          $("#verifyPasswordModal").hide();
      });
    </script>
</body>
</html>