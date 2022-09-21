<?php 
    session_start();
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $get_id = 0;
    $get_id = $_GET['add_id'];
    $sucMsg ='';

    $total_taka_calculation = 0;
    
    $data_id = -1;

    if (isset($_POST['set'])) {
        //print_r($_POST);
        $pay_due_total  = $_POST['pay_due_total'];
        $g_id           = $_POST['id']; //table row id 
        $entry_date_modal = $_POST['entry_date_modal'];
        if($entry_date_modal == 'none'){
            // if ($g_id>0) {
            //     $query = "UPDATE debit_group_data SET group_pay='$pay_due_total', group_id='$get_id' WHERE id = $g_id";
            //   // $query = "UPDATE debit_group_data SET group_pay='$pay_due_total' WHERE entry_date = '$entry_date_modal' AND  group_id='$get_id' AND project_name_id = '$project_name_id'";
            //     $update = $db->update($query);
            //     if ($update) {
            //         echo "<script>window.location.href = 'add_single_group_data.php?add_id=$get_id'</script>";
            //     } else {
            //         echo "<script>alert('Data is not inserted !')</script>";
            //     }
            // }
        } else {
            if ($g_id>0) {
                // $query = "UPDATE debit_group_data SET group_pay='$pay_due_total', group_id='$get_id' WHERE id = $g_id";
              $query = "UPDATE debit_group_data SET group_pay='$pay_due_total' WHERE entry_date = '$entry_date_modal' AND  group_id='$get_id' AND project_name_id = '$project_name_id' ORDER BY id LIMIT 1";
                $update = $db->update($query);
                if ($update) {
                    echo "<script>window.location.href = 'add_single_group_data.php?add_id=$get_id'</script>";
                } else {
                    echo "<script>alert('Data is not inserted !')</script>";
                }
            }
        }
        
        
        //$query = "INSERT INTO debit_group_data(group_pay, group_id)VALUES('$pay_due_total', $get_id)";
      
    }


    // insert data to table debit_group_data
    if (isset($_POST['submit'])) {
        $newFormatDate ='';
        $query = "SELECT * FROM debit_group WHERE id = $get_id";
        $read = $db->select($query);
        if ($read) {
            $row = $read->fetch_assoc();    
            $group_date_insert  = $row['group_date'];
            // echo '<script> alert("a' . $group_date_insert . '")</script>';
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
            $total_bill        = $_POST['total_bill'][$i];
            $pay               = $_POST['pay'][$i];
            $due               = $_POST['due'][$i];
            $group_id          = $_GET['add_id'];
            // if ($taka == '' || $pices == '') {
            //   $sucMsg = 'Data is not inserted because Field was empty !';
            // } else {
                $query = "INSERT INTO debit_group_data(entry_date, group_name, group_description, group_taka, group_pices, group_total_taka, group_total_bill, group_pay, group_due, group_id, dg_date, project_name_id) VALUES ('$entry_date', '$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$total_bill', '$pay', '$due', '$group_id', '$newFormatDate', '$project_name_id')";
                $result = $db->insert($query);
                if ($result) {          
                    $sucMsg = 'Data is inserted successfully !';
                } else {
                    $sucMsg = 'Data is not inserted !';
                }
            // }
        }


        // $group_name        = $_POST['group_name'];
        // $group_description = $_POST['group_description'];
        // $taka              = $_POST['taka'];
        // $pices             = $_POST['pices'];
        // $total_taka        = $_POST['total_taka'];
        // $total_bill        = $_POST['total_bill'];
        // $pay               = $_POST['pay'];
        // $due               = $_POST['due'];
        // $get_id            = $_GET['add_id'];

        // if ($taka == '' || $pices == '') 
        // {
        //   // echo "<script>alert('Data is not inserted because Field was empty !')</script>";
        //   // echo "<script>window.location.href = 'add_single_group_data.php?add_id=$get_id'</script>";
        //   $sucMsg = 'Data is not inserted because Field was empty !';
        // }
        // else
        // {
        //   $query = "INSERT INTO debit_group_data(group_name, group_description, group_taka, group_pices, group_total_taka, group_total_bill, group_pay, group_due, group_id)VALUES('$group_name', '$group_description', '$taka', '$pices', '$total_taka', '$total_bill', '$pay', '$due', $get_id)";
        //   $result = $db->insert($query);
        //   if ($result) 
        //   {
        //     // echo "<script>alert('Data is inserted successfully !');</script>";
        //     // echo "<script>window.location.href = 'add_single_group_data.php?add_id=$get_id'</script>";
        //     $sucMsg = 'Data is inserted successfully !';
        //   }
        //   else
        //   {
        //     // echo "<script>alert('Data is not inserted !')</script>";
        //     $sucMsg = 'Data is not inserted !';
        //   }
        // }
    }

 
    $query = "SELECT group_id FROM debit_group_data";
    $read = $db->select($query);
    if ($read) {
        while ($row = $read->fetch_assoc()) {
            $add_id = $row['group_id'];
        }
    }

    //delete data part
    if (isset($_GET['dels_id'])) {
        $visibility = 0;
        $del    = $_GET['dels_id'];
        $query = "DELETE FROM debit_group_data WHERE id = $del";
        $delete = $db->delete($query);
        if ($delete) {
            echo "<script>alert('Data Deleted Successfully!');</script>";
            echo "<script>window.location.href = 'modify_vaucher.php'</script>";
        } else {
            echo "<script>alert('Failed to Delete Data!');</script>";
        }
    }

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/voucher.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <!-- add remove field script -->
    <script>

        function newRowAdd(ival){
            var i = ival;
            // $('#add').click(function(){
                var group_name_placeholder = $('#group_name1').attr('placeholder');
                var group_description_placeholder = $('#group_description1').attr('placeholder');
                var taka_placeholder = $('#taka1').attr('placeholder');
                var pices_placeholder = $('#pices1').attr('placeholder');

                i++;
                $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="entry_date[]" class="form-control" id="entry_date'+i+'" placeholder="dd-mm-yyyy" /></td><td><input type="text" name="group_name[]" class="form-control" size="100" id="group_name'+i+'" placeholder="'+group_name_placeholder+'"/></td><td><input type="text" name="group_description[]" class="form-control" size="100" id="group_description'+i+'" placeholder="'+group_description_placeholder+'"/></td><td><input type="text" name="taka[]" class="form-control tkCount" size="40" id="taka'+i+'" placeholder="'+taka_placeholder+'"/></td><td><input type="text" name="pices[]" class="form-control" size="40" id="pices'+i+'" placeholder="'+pices_placeholder+'"/></td><td><input type="text" name="total_taka[]" class="form-control" id="total_taka'+i+'" placeholder="No Entry"/></td><td><input type="text" name="total_bill[]" class="form-control" id="total_bill'+i+'" placeholder="No Entry"/></td><td><input type="text" name="pay[]" class="form-control"  id="pay'+i+'" placeholder="No Entry"/></td><td><input type="text" name="due[]" class="form-control" id="due'+i+'" placeholder="No Entry"/></td><td class="centerTxt"><button type="button" name="add" id="add" class="btn btn-success disabled">+</button></td><td class="centerTxt"><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">-</button></td></tr>');

                var datePicker = document.createElement("script");
                  datePicker.innerHTML = '$(function() { $("#entry_date'+i+'").datepicker( {  onSelect: function(date) { $(this).change(); }, dateFormat: "dd/mm/yy", changeYear: true, }).datepicker("setDate", new Date()); });';
                  datePicker.setAttribute("id", "script-"+i);
                  $("body").append(datePicker);
            // });
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
              var dels_id = $(event.target).attr('data-dels_id');
              console.log(dels_id);
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
                                                  // window.location.href = 'modify_vaucher.php';
                                                  window.location.href = 'add_single_group_data.php?'+getId;
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
    </style>
</head>
<body>
    <?php
        include '../navbar/header_text.php';
        include '../navbar/navbar.php';    
    ?> 
    <div class="container" style="margin-bottom: 100px;">
        <?php 
            $ph_id = $_SESSION['project_name_id'];
            $query = "SELECT * FROM project_heading WHERE id = $ph_id";
            $show = $db->select($query);
            if ($show) {
                while ($rows = $show->fetch_assoc()) {
                ?>
                    <div class="project_heading text-center">      
                        <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
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
            <form action="" method="POST" onsubmit="return validation()">
                <div class="part">
                    তারিখঃ 
                    <?php
                        $sql = "SELECT DISTINCT entry_date FROM debit_group_data WHERE group_id = '$get_id' AND project_name_id = '$project_name_id'";
                        $result = $db->select($sql);
                        echo '<select id="debit_group_date_list" data-width="125px" data-style="btn-info">';
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
                        $pay_for_modal = '';
                        
                        $query = "SELECT * FROM debit_group WHERE id = '$get_id' AND project_name_id = '$project_name_id'";
                        $read = $db->select($query);
                        if ($read) {
                            while ($row = $read->fetch_assoc()) {
                                $postDateArr        = explode('-', $row['group_date']);
                                $credit_date        = $postDateArr['2'].'/'.$postDateArr['1'].'/'.$postDateArr['0'];
                                

                                $group_name         = $row['group_name'];
                                $group_description  = $row['group_description'];
                                $taka         = $row['taka'];
                                $pices        = $row['pices'];
                            ?>
                            <!-- <thead>
                                <tr>
                                    <th colspan="11">
                                        খরচ খাতের তারিখ: <?php //echo $credit_date; ?>                        
                                    </th>
                                </tr>
                            </thead> -->
                            <thead>
                                <tr style="background-color: #bbb;">
                                    <th class="centerTxt" width="112px">তারিখ</th>
                                    <th class="centerTxt"><?php echo $row['group_name']; ?></th>
                                    <th class="centerTxt"><?php echo $row['group_description']; ?></th>
                                    <th class="centerTxt"><?php echo $row['taka']; ?></th>
                                    <th class="centerTxt"><?php echo $row['pices']; ?></th>
                                    <th class="centerTxt"><?php echo $row['total_taka']; ?></th>
                                    <th class="centerTxt"><?php echo $row['total_bill']; ?></th>
                                    <th class="centerTxt"><?php echo $row['pay']; $pay_for_modal =$row['pay']; ?></th>
                                    <th class="centerTxt"><?php echo $row['due']; ?></th>
                                    <th class="centerTxt">Delete</th>
                                    <th class="centerTxt">
                                        <a href="update_add_vaucher_group.php?edite_id=<?php echo $row['id']; ?>" class="btn btn-success">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                                  	</th>
                                </tr>
                            </thead>
                            <?php 
                            }
                        }
                    ?>

                    <?php

                        $qry = "UPDATE debit_group_data SET group_total_taka = group_taka * group_pices";
                        $result = $db->update($qry);


                        $sql_qry_debit_due="SELECT SUM(group_total_taka) AS debit_due FROM debit_group_data WHERE group_id =$get_id AND project_name_id = '$project_name_id'";
                        $duration_debit_due = $db->select($sql_qry_debit_due);
                        while($record_debit_due = $duration_debit_due->fetch_array()){
                            $total_debit_due = $record_debit_due['debit_due'];
                        }

                        $sql_qry_debit_group_pay="SELECT SUM(group_pay) AS group_pay FROM debit_group_data WHERE group_id =$get_id AND project_name_id = '$project_name_id'";
                        $duration_debit_group_pay = $db->select($sql_qry_debit_group_pay);
                        while($record_debit_group_pay = $duration_debit_group_pay->fetch_array()){
                            $group_pay = $record_debit_group_pay['group_pay'];
                        }

                        /*$qry = "UPDATE debit_group_data SET group_total_bill = $total_debit_due WHERE id IS NOT NULL";
                        $result = $db->update($qry);*/
                    ?>


                    <!-- view debit group data from database -->
                    <?php

                        // $deu_pay_total=array();
                        $deu_pay_total= 0;
                        $query = "SELECT * FROM debit_group_data WHERE group_id = $get_id AND project_name_id = '$project_name_id'";
                        $read = $db->select($query);
                        if ($read) {
                            // $cnt=0;
                            while ($row = $read->fetch_assoc()) {
                                // if($cnt==0){
                                    $deu_pay_total += (int)$row['group_pay'];
                                    // $cnt++;
                                // }
                                ?>
                                <thead>
                                    <tr>
                                        <th>
                                          <?php if( $row['entry_date'] == '0000-00-00'){} else {echo date("d/m/Y", strtotime($row['entry_date']));} ?>            
                                        </th>
                                        <th><?php echo $row['group_name']; ?></th>
                                        <th><?php echo $row['group_description']; ?></th>
                                        <th><?php echo $row['group_taka']; ?></th>
                                        <th><?php echo $row['group_pices']; ?></th>
                                        <th><?php if($row['group_taka'] !== '' && $row['group_pices'] !==''){echo $row['group_taka'] * $row['group_pices'];} ?></th>
                                        <th><?php //echo $total_debit_due;  ?></th>
                                        <th><?php //echo $row['group_pay']; ?></th>
                                        <th><?php //echo $row['group_due']; ?> </th>
                                        <?php  
                                          if($data_id==-1){
                                            $data_id = $row['id'];
                                          }         
                                        ?>
                                        <td class="centerTxt">
                                          <!-- <a href="add_single_group_data.php?dels_id=<?php echo $row['id']; ?>"  class="btn btn-danger sgdDelete">-</a>  -->
                                          <a href="#" data-dels_id="<?php echo $row['id']; ?>" class="btn btn-danger sgdDelete">-</a> 
                                        </td>
                                        <td class="centerTxt">
                                          <?php
                                            // $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                            // $str_arr = explode ("?", $url);
                                            // $last_part = end($str_arr);
                                            // // var_dump($last_part);
                                            // preg_match("|\d+|", $last_part, $m);
                                            // $idOfDataSet = $m[0];
                                            // // var_dump($idOfDataSet);
                                          ?>
                                          <a href="update_single_group_data.php?edit_id=<?php echo $row['id']; ?>&dataset_id=<?php echo $get_id; ?>" class="btn btn-success">Update</a>
                                        </td>
                                    </tr>
                                </thead>
                            <?php
                            }
                        }
                    ?>

                    <?php  
                        $all_debit_due = 0;
                        $debit_pay=$total_debit_due-$group_pay;
                        $all_debit_due +=$debit_pay;
                        /*$debit_pay_qry = "UPDATE debit_group_data SET group_due = $debit_pay";
                        $result = $db->update($debit_pay_qry);*/
                    ?>
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><?php echo $total_debit_due; ?></th>
                            <th>
                            <?php 
                              //echo "id ".$get_id."</br>";
                              if (!empty($deu_pay_total)) {
                                echo $deu_pay_total; 
                              }

                            ?>  
                            </th>
                            <th><?php echo $debit_pay; ?></th>
                            <th></th>
                            <th>
                              <!-- Trigger the modal with a button -->
                              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="modal">Set <?php echo $pay_for_modal; ?></button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="entry_date[]" class="form-control" id="entry_date1" placeholder="dd/mm/yyyy" /></td>
                            <td><input type="text" name="group_name[]" class="form-control" size="100" id="group_name1" placeholder="<?php echo $group_name;?>" /></td>
                            <td><input type="text" name="group_description[]" class="form-control" size="100" id="group_description1" placeholder="<?php echo $group_description;?>" /></td>
                            <td><input type="text" name="taka[]" class="form-control tkCount" size="40" id="taka1" placeholder="<?php echo $taka; ?>" /></td>
                            <td><input type="text" name="pices[]" class="form-control" size="40" id="pices1" placeholder="<?php echo $pices; ?>" /></td>
                            <td><input type="text" name="total_taka[]" class="form-control" id="total_taka1" placeholder="No Entry" /></td>
                            <td><input type="text" name="total_bill[]" class="form-control"  id="total_bill1" placeholder="No Entry" /></td>
                            <td><input type="text" name="pay[]" class="form-control" id="pay1" placeholder="No Entry" /></td>
                            <td><input type="text" name="due[]" class="form-control" id="due1" placeholder="No Entry" /></td>

                            <td class="centerTxt"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
                            <td class="centerTxt"><button type="button" name="remove" id="1" class="btn btn-danger btn_remove disabled">-</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit">
                </div>
                <div class="form-group">
                    <h3 class="text-center text-success" id="sucMsg"><?php echo $sucMsg; ?></h3>
                </div>
        </form>   
    </div>



    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">      
            <!-- Modal content-->
            <form action="" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Set <?php echo $pay_for_modal; ?> amount</h4>
                    </div>
                    <div class="modal-body">                    
                        <input type="text" name="pay_due_total" class="form-control" id='pay_due_total'/>
                        <input type="hidden" name="id" value="<?php echo $data_id; ?>">
                        <input type="text" name="entry_date_modal" value="" id="entry_date_modal">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" name="set" class="btn btn-primary" value="SET" />
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



        var sucMsg = $('#sucMsg').html();
        if(sucMsg == 'Data is inserted successfully !'){
            // alert('Data is inserted successfully !');
        } else if(sucMsg == ''){

        } else{
            alert('Data is not inserted !');
        }

        $('#debit_group_date_list').selectpicker();
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
    </script>
    <script type="text/javascript">
        $(document).on('click', '#modal', function(){
            // var joma = "<?php //echo $deu_pay_total[$get_id]; ?>";
            var joma = $(this).closest('tr').find('th').eq(7).text().trim();
            // alert(joma);            
            $('#pay_due_total').val(joma);
            var dateval = $('#debit_group_date_list option:selected').val();
            alert(dateval);
            // if(dateval == 'none') {

            // } else {
                $('#entry_date_modal').val(dateval);
            // }
        });

        $(function(){
            if($('#debit_group_date_list option:selected').val() == 'none') {
              $("#modal").css('display', 'none');
            } 
        });
        
    </script>
    <script type="text/javascript">
        $(document).on('change', '#debit_group_date_list', function(){
            var date = $('#debit_group_date_list option:selected').val();
            var group_id = "<?php echo $get_id; ?>";
            // alert(date);
            if(date == 'none'){
                // window.location.href = "../vaucher/add_single_group_data.php?add_id=" + group_id;
                getAllDatesData(group_id);
            } else {
                $("#modal").css('display', 'block');
                getGroupIdAndDateWiseData(date, group_id);
            }
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
                  }).datepicker("setDate", new Date());
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          });
        }

        function getAllDatesData(group_id){
          $.ajax({
              url: '../ajaxcall/get_group_id_and_dates_data.php',
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
</body>
</html>