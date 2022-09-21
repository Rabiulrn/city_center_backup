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


    $_SESSION['pageName'] = '';
    $khorosKhat="active";   

    $sucMsg = "";
    $group_id = $_POST['seletedId'];


?>

<form action="" method="POST" id="inputDataForm">
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

            $query = "SELECT * FROM debit_group WHERE id = '$group_id' AND project_name_id = '$project_name_id'";
            $read = $db->select($query);
            if ($read) {
                while ($row = $read->fetch_assoc()) {
                    $postDateArr        = explode('-', $row['group_date']);
                    $credit_date        = $postDateArr['2'].'/'.$postDateArr['1'].'/'.$postDateArr['0'];


                    $row_id             = $row['id'];
                    $name         = $row['group_name'];
                    $description  = $row['group_description'];
                    $taka               = $row['taka'];
                    $pices              = $row['pices'];
                    $total_taka         = $row['total_taka'];
                    // $total_bill         = $row['total_bill'];
                    $pay                = $row['pay'];
                    $due                = $row['due'];
                    ?>
                    <thead>
                        <tr>
                            <th colspan="11">খরচ খাতের তারিখ: <?php echo $credit_date; ?></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr style="background-color: #bbb;">
                            <th class="centerTxt" width="112px">তারিখ</th>
                            <th class="centerTxt"><?php echo $name; ?></th>
                            <th class="centerTxt"><?php echo $description; ?></th>
                            <th class="centerTxt"><?php echo $taka; ?></th>
                            <th class="centerTxt"><?php echo $pices; ?></th>
                            <th class="centerTxt"><?php echo $total_taka; ?></th>
                            <!-- <th class="centerTxt"><?php //echo $total_bill; ?></th> -->
                            <th class="centerTxt"><?php echo $pay; ?></th>
                            <th class="centerTxt"><?php echo $due; ?></th>
                            <th class="centerTxt">Delete</th>
                            <th class="centerTxt">
                                <?php
                                    if($edit_data_permission == 'yes'){
                                        // echo '<a href="update_add_vaucher_group.php?edite_id=' .$row['id'] .'" class="btn btn-success">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>';
                                        echo '<a group_id="' .$row['id'] .'" class="btn btn-success" onclick="load_header_for_edit(this)">&nbsp;&nbsp;Edit &nbsp;&nbsp;</a>';
                                    } else {
                                        echo '<a class="btn btn-success edPermit" disabled>&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>';
                                    }
                                ?>                                
                            </th>
                        </tr>
                    </thead>
                <?php  

                }
            }
        ?>


    <!-- view debit group data from database -->
    <?php        
        $query = "SELECT * FROM debit_group_data WHERE group_id = $group_id AND project_name_id = '$project_name_id' ORDER BY entry_date ASC";
        $read = $db->select($query);
        if ($read) {
            while ($row = $read->fetch_assoc()) {
                $entry_date = $row['entry_date'];
                $group_name = $row['group_name'];
                $group_description = $row['group_description'];
                $group_taka = $row['group_taka'];
                $group_pices = $row['group_pices'];
                $group_total_taka = $row['group_total_taka'];
                // $group_total_bill = $row['group_total_bill'];
                $group_pay = $row['group_pay'];
                $group_due = $row['group_due'];
                ?>
            <!-- <tbody> -->
                <tr>
                    <td>
                      <?php if($entry_date == '0000-00-00'){} else {echo date("d/m/Y", strtotime($entry_date));} ?>            
                    </td>
                    <td><?php echo $group_name; ?></td>
                    <td><?php echo $group_description; ?></td>
                    <td class="text-right">
                        <?php 
                            if(!empty($group_taka)){
                                echo $group_taka;
                            } else {
                                echo '0';
                            }
                        ?>                                    
                    </td>
                    <td class="text-right">
                        <?php 
                            if(!empty($group_pices)){
                                echo $group_pices;
                            } else {
                                echo '0';
                            }
                        ?>  
                    </td>
                    <td class="text-right">
                        <?php 
                            if(!empty($group_total_taka)){
                                echo $group_total_taka;
                            } else {
                                echo '0';
                            }
                        ?>  
                    </td>
                    <!-- <td class="text-right"> -->
                        <?php 
                            // if(!empty($group_total_bill)){
                            //     echo $group_total_bill;
                            // } else {
                            //     echo '0';
                            // }
                        ?>  
                    <!-- </td> -->
                    <td class="text-right">
                        <?php 
                            if(!empty($group_pay)){
                                echo $group_pay;
                            } else {
                                echo '0';
                            }
                        ?>  
                    </td>
                    <td class="text-right">
                        <?php 
                            if(!empty($group_due)){
                                echo $group_due;
                            } else {
                                echo '0';
                            }
                        ?>                                
                    </td>
                    <td class="centerTxt">                        
                        <?php
                            if($delete_data_permission == 'yes'){
                                echo '<a data_dels_id="'.$row['id'].'" class="btn btn-danger sgdDelete" debit_group_id="'.$group_id.'" entry_list_date = "">-</a>';
                            } else {
                                echo "<a class='btn btn-danger edPermit' disabled>-</a>";
                            }
                        ?>
                    </td>
                    <td class="centerTxt">
                        <?php
                            if($edit_data_permission == 'yes'){
                                // echo '<a href="update_single_group_data.php?edit_id='.$row['id'].'&dataset_id='.$group_id.'" class="btn btn-success">Update</a>';
                                echo '<a edit_id="'.$row['id'].'" dataset_id="'.$group_id.'" class="btn btn-success" onclick="load_row(this)">Update</a>';
                            } else {
                                echo "<a class='btn btn-success edPermit' disabled>Update</a>";
                            }
                        ?>
                    </td>
                </tr>
            <!-- </tbody> -->
            <?php
            }
        }
    ?>

    <?php  
        $group_total_taka = 0;
        // $group_total_bill = 0;
        $group_pay        = 0;
        $group_due        = 0;
        

        $sql_qry_total_taka="SELECT SUM(group_total_taka) AS total_taka FROM debit_group_data WHERE group_id ='$group_id' AND project_name_id ='$project_name_id'";
        $duration_total_taka = $db->select($sql_qry_total_taka);
        while($record_total_taka = $duration_total_taka->fetch_array()){
            $group_total_taka = $record_total_taka['total_taka'];
        }

        // $sql_qry_total_bill="SELECT SUM(group_total_bill) AS total_bill FROM debit_group_data WHERE group_id ='$group_id' AND entry_date = '$group_date' AND project_name_id ='$project_name_id'";
        // $duration_total_bill = $db->select($sql_qry_total_bill);
        // while($record_total_bill = $duration_total_bill->fetch_array()){
        //     $group_total_bill = $record_total_bill['total_bill'];
        // }

        $sql_qry_debit_group_pay="SELECT SUM(group_pay) AS group_pay FROM debit_group_data WHERE group_id ='$group_id' AND project_name_id ='$project_name_id'";
        $duration_debit_group_pay = $db->select($sql_qry_debit_group_pay);
        while($record_debit_group_pay = $duration_debit_group_pay->fetch_array()){
            $group_pay = $record_debit_group_pay['group_pay'];
        }

        $qry_group_group_due="SELECT SUM(group_due) AS group_due FROM debit_group_data WHERE group_id ='$group_id' AND project_name_id ='$project_name_id'";
        $result_bill = $db->select($qry_group_group_due);
        while($result_bill_row = $result_bill->fetch_array()){
            $group_due = $result_bill_row['group_due'];
        }


    ?>
        <!-- <thead> -->
    <tr>
        <td colspan="5" class="text-right sumrow">মোটঃ</td>
        <td class="text-right sumrow"><?php echo $group_total_taka; ?></td>
        <!-- <td class="text-right sumrow"><?php //echo $group_total_bill; ?></td> -->
        <td class="text-right sumrow"><?php echo $group_pay;?></td>
        <td class="text-right sumrow"><?php echo $group_due; ?></td>
        <td colspan="2" class="sumrow"></td>
        <!-- <th>
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" id="modal">Set <?php //echo $pay_for_modal; ?></button>
        </th> -->
    </tr>
<!-- </thead> -->
<!-- <tbody> -->
    <tr class="entryRow">
        <td><input type="text" name="entry_date[]" class="form-control" id="entry_date1" placeholder="dd/mm/yyyy" /></td>
        <td><input type="text" name="group_name[]" class="form-control" size="100" id="group_name1" placeholder="<?php echo $name;?>" /></td>
        <td><input type="text" name="group_description[]" class="form-control" size="100" id="group_description1" placeholder="<?php echo $description;?>" /></td>
        <td><input type="text" name="taka[]" class="form-control tkCount calc1" size="40" id="taka1" placeholder="<?php echo $taka; ?>" /></td>
        <td><input type="text" name="pices[]" class="form-control calc1" size="40" id="pices1" placeholder="<?php echo $pices; ?>" /></td>
        <td><input type="text" name="total_taka[]" class="form-control" id="total_taka1" placeholder="<?php echo $total_taka; ?>" /></td>
        <!-- <td><input type="text" name="total_bill[]" class="form-control"  id="total_bill1" placeholder="<?php //echo $total_bill; ?>" /></td> -->
        <td><input type="text" name="pay[]" class="form-control payCalc1" id="pay1" placeholder="<?php echo $pay; ?>" /></td>
        <td><input type="text" name="due[]" class="form-control" id="due1" placeholder="<?php echo $due; ?>" /></td>
        <td class="centerTxt"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
        <td class="centerTxt"><button type="button" name="remove" id="1" class="btn btn-danger btn_remove disabled">-</button></td>
    </tr>
<!-- </tbody> -->
    </table>
    <div class="form-group">
        <input type="hidden" class="" name="group_id" value="<?php echo $group_id; ?>" id="group_id">
        <input type="button" class="form-control btn btn-primary" name="submit" id="submitBtn" value="Submit">
    </div>
</form>