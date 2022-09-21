<?php
  	session_start();  
  	require '../config/config.php';
  	require '../lib/database.php';
  	$db = new Database();
  	$project_name_id = $_SESSION['project_name_id'];
  	$khotos_khat_id = $_POST['khotos_khat_id'];
    $search_date = $_POST['search_date'];

    // echo $search_date;                    

    $all_total_taka = 0;
    $all_total_bill = 0;
    $all_group_pay = 0;
    $all_group_due = 0;
    

    if($search_date == 'alldates'){
        $query = "SELECT * FROM debit_group WHERE id='$khotos_khat_id' AND project_name_id = '$project_name_id'";
        $read = $db->select($query);
        if ($read) {
            while ($row = $read->fetch_assoc()) {
                $debit_group_id = $row['id'];            
                
                $group_wise_total_taka = 0;
                $group_wise_total_bill = 0;
                $group_wise_total_pay = 0;
                $group_wise_total_due = 0;
                $qry = "SELECT * FROM debit_group_data WHERE group_id = '$debit_group_id' AND project_name_id = '$project_name_id'";
                $reads = $db->select($qry);
                if (mysqli_num_rows($reads) > 0) {
                    ?>
                    <table id="mytable" class="table table-bordered" style="font-size: 12px;">

                        <thead>
                            <tr class="d-flex">
                                <td class="newGroup text-center"><?php echo $row['group_name']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['group_description']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['taka']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['pices']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['total_taka']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['pay']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['due']; ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                    
                            while ($row = $reads->fetch_assoc()) {
                                $group_name = $row['group_name'];
                                $group_description = $row['group_description'];
                                if($row['group_taka'] == ''){$group_taka = 0;} else {$group_taka = $row['group_taka'];}
                                if($row['group_pices'] == ''){$group_pices = 0;} else {$group_pices = $row['group_pices'];}
                                if($row['group_total_taka'] == ''){$group_total_taka = 0;} else {$group_total_taka = $row['group_total_taka'];}
                                if($row['group_total_bill'] == ''){$group_total_bill = 0;} else {$group_total_bill = $row['group_total_bill'];}
                                if($row['group_pay'] == ''){$group_pay = 0;} else {$group_pay = $row['group_pay'];}
                                if($row['group_due'] == ''){$group_due = 0;} else {$group_due = $row['group_due'];}

                                $all_total_taka += $group_total_taka;
                                $group_wise_total_taka += $group_total_taka;

                                $all_total_bill += $group_total_bill;
                                $group_wise_total_bill += $group_total_bill;

                                $all_group_pay += $group_pay;
                                $group_wise_total_pay += $group_pay;

                                $all_group_due += $group_due;
                                $group_wise_total_due += $group_due;
                                ?>
                            
                                <tr class="d-flex">                      
                                  <td><?php echo $group_name; ?></td>
                                  <td><?php echo $group_description; ?></td>
                                  <td class="text-right">
                                    <?php echo number_format($group_taka, 2); ?>
                                  </td>
                                  <td class="text-right"><?php echo $group_pices; ?></td>
                                  <td class="text-right">
                                    <?php echo number_format($group_total_taka, 2); ?>
                                  </td>
                                  <td class="text-right"><?php echo number_format($group_pay, 2); ?></td>
                                  <td class="text-right"><?php echo number_format($group_due, 2); ?></td>
                                </tr>                        
                                <?php
                            }                    
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                              <td class="text-right " colspan="4">মোট বিলঃ</td>
                              <td class="text-right"><?php echo number_format($group_wise_total_taka, 2); ?></td>
                              <td class="text-right">
                                <?php
                                  // echo number_format($group_wise_total_pay, 2);
                                ?>
                              </td>
                              <td class="text-right">
                                <?php
                                  // echo number_format($group_wise_total_due, 2);
                                ?></td>
                            </tr>
                        </tfoot>
                    </table>
                <?php
                } else {
                    ?>
                      <table id="mytable" class="table table-bordered" style="font-size: 20px;">
                          <tr>
                            <td style="text-align: center;">No data found.</td>
                          </tr>
                      </table>
                    <?php
                }
            }
        }
    } else {
        //echo $search_date; jodi tarikh thake
        $query = "SELECT * FROM debit_group WHERE id='$khotos_khat_id' AND project_name_id = '$project_name_id'";
        $read = $db->select($query);
        if ($read) {
            while ($row = $read->fetch_assoc()) {
                $debit_group_id = $row['id'];            
                
                $group_wise_total_taka = 0;
                $group_wise_total_bill = 0;
                $group_wise_total_pay = 0;
                $group_wise_total_due = 0;
                $qry = "SELECT * FROM debit_group_data WHERE group_id = '$debit_group_id' AND entry_date ='$search_date' AND project_name_id = '$project_name_id'";
                $reads = $db->select($qry);
                if (mysqli_num_rows($reads) > 0) {
                    ?>
                    <table id="mytable" class="table table-bordered" style="font-size: 12px;">

                        <thead>
                            <tr class="d-flex">
                                <td class="newGroup text-center"><?php echo $row['group_name']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['group_description']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['taka']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['pices']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['total_taka']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['pay']; ?></td>
                                <td class="newGroup text-center"><?php echo $row['due']; ?></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php                    
                            while ($row = $reads->fetch_assoc()) {
                                  $group_name = $row['group_name'];
                                  $group_description = $row['group_description'];
                                  if($row['group_taka'] == ''){$group_taka = 0;} else {$group_taka = $row['group_taka'];}
                                  if($row['group_pices'] == ''){$group_pices = 0;} else {$group_pices = $row['group_pices'];}
                                  if($row['group_total_taka'] == ''){$group_total_taka = 0;} else {$group_total_taka = $row['group_total_taka'];}
                                  if($row['group_total_bill'] == ''){$group_total_bill = 0;} else {$group_total_bill = $row['group_total_bill'];}
                                  if($row['group_pay'] == ''){$group_pay = 0;} else {$group_pay = $row['group_pay'];}
                                  if($row['group_due'] == ''){$group_due = 0;} else {$group_due = $row['group_due'];}

                                  $all_total_taka += $group_total_taka;
                                  $group_wise_total_taka += $group_total_taka;

                                  $all_total_bill += $group_total_bill;
                                  $group_wise_total_bill += $group_total_bill;

                                  $all_group_pay += $group_pay;
                                  $group_wise_total_pay += $group_pay;

                                  $all_group_due += $group_due;
                                  $group_wise_total_due += $group_due;
                                  ?>
                                
                                  <tr class="d-flex">                      
                                    <td><?php echo $group_name; ?></td>
                                    <td><?php echo $group_description; ?></td>
                                    <td class="text-right">
                                      <?php echo number_format($group_taka, 2); ?>
                                    </td>
                                    <td class="text-right"><?php echo $group_pices; ?></td>
                                    <td class="text-right">
                                      <?php echo number_format($group_total_taka, 2); ?>
                                    </td>
                                    <td class="text-right"><?php echo number_format($group_pay, 2); ?></td>
                                    <td class="text-right"><?php echo number_format($group_due, 2); ?></td>
                                  </tr>
                                
                                  <?php
                            }                    
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                              <td class="text-right " colspan="4">মোট বিলঃ</td>
                              <td class="text-right"><?php echo number_format($group_wise_total_taka, 2); ?></td>
                              <td class="text-right">
                                <?php
                                  // echo number_format($group_wise_total_pay, 2);
                                ?>
                              </td>
                              <td class="text-right">
                                <?php
                                  // echo number_format($group_wise_total_due, 2);
                                ?>                                  
                              </td>
                            </tr>
                        </tfoot>
                    </table>
                    <?php
                } else {
                    ?>
                      <table id="mytable" class="table table-bordered" style="font-size: 20px;">
                          <tr>
                            <td style="text-align: center;">No data found.</td>
                          </tr>
                      </table>
                    <?php
                }
            }
        }
    }
    

?>
