<?php 
  session_start();
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $project_name_id        = $_SESSION['project_name_id'];
  $edit_data_permission   = $_SESSION['edit_data'];
  $delete_data_permission = $_SESSION['delete_data'];

  //total calculation section
  $credit_total = 0;
  $sql_qrys="SELECT SUM(credit_amount) AS total_credit FROM vaucher_credit WHERE project_name_id = '$project_name_id'";
  $credit = $db->select($sql_qrys);
  while($credit_record = $credit->fetch_array()){
    $credit_total = $credit_record['total_credit'];
  }

  $total_due_credit = 0;
  $sql_qry_due_credit="SELECT SUM(due_credit_amount) AS total_due_credit FROM due WHERE project_name_id = '$project_name_id'";
  $due_credit = $db->select($sql_qry_due_credit);
  while($due_credits = $due_credit->fetch_array()){
      $total_due_credit = $due_credits['total_due_credit'];
  }

  $total_due_debit = 0;
  $sql_qry_due_debit="SELECT SUM(due_debit_amount) AS total_due_debit FROM due WHERE project_name_id = '$project_name_id'";
  $due_debit = $db->select($sql_qry_due_debit);
  while($due_debits = $due_debit->fetch_array()){
      $total_due_debit = $due_debits['total_due_debit'];
  }


  $total_p_amount = 0;
  $remain_credit = $credit_total + $total_due_credit;




  //Data from joma kaht || marfot name
  $sql="SELECT * FROM vaucher_credit WHERE project_name_id = '$project_name_id'";
  $p_read = $db->select($sql);
  $data=array();
  $size=0;
  if($p_read){
      while ($row= $p_read->fetch_assoc()) {
          $data[$size]['id']= $row['id']; 
          $data[$size]['credit_name']= $row['credit_name']; 
          $data[$size]['credit_amount']= $row['credit_amount']; 
          $size++;              
      }
  }
  // echo "<pre>";
  // var_dump($data);
  // echo "</pre>";

  //Eta Amar data
  $sqls="SELECT * FROM nij_paonadar WHERE project_name_id = '$project_name_id'";
  $p_reads = $db->select($sqls);
  $datas = array();
  $sizes = 0;
  if($p_reads){
      while ($rows= $p_reads->fetch_assoc()) {
          $datas[$sizes]['id']= $rows['id'];
          $datas[$sizes]['name']= $rows['name'];
          $datas[$sizes]['description']= $rows['description'];
          $datas[$sizes]['amount']= $rows['amount'];
          $sizes++;
      }
  }
  // echo "<pre>";
  // var_dump($datas);
  // echo "</pre>";
?>


<thead class="noborders">
    <tr>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
        <th class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important;"></th>
        <th class="width_200px headerTextAlign">নাম</th>
        <th class="headerTextAlign">টাকাঃ</th>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
        <th class="headerTextAlign">নাম</th>
        <th class="headerTextAlign">বিবরণ</th>
        <th class="headerTextAlign">টাকাঃ</th>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
    </tr>
</thead>
<?php  
    $j = 0;
    $paona_query = "SELECT * FROM jara_pabe WHERE project_name_id = '$project_name_id'";
    $paona_read = $db->select($paona_query);
    if ($paona_read) {
        while ($paona_row = $paona_read->fetch_assoc()) {
            // var_dump($j);
          ?>
          <tbody class="borderless-cell">
              <tr>
                  <th class="noborders" style="border: 1px solid transparent !important;"></th>
                  <th class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important;"></th>
                  <td><span style="max-width:200px; word-wrap: anywhere;"><?php if($j<$sizes){echo $datas[$j]['name']; }?></span></td>
                  <td style="text-align: right;"><?php if($j<$sizes){echo number_format($datas[$j]['amount'], 2); }?></td>
                  <td class="noborders" style="border: 1px solid transparent !important;">
                      <?php if($j<$sizes){?>
                          <a href="#" data-delete_id="<?php if($j<$sizes){echo $datas[$j]['id']; $j++; } ?>" class="btn btn-danger nijepaboDelete">-</a>
                      <?php } ?>
                  </td>
                  <td class="noborders" style="border: 1px solid transparent !important;"></td>
                  <td class="noborders" style="border: 1px solid transparent !important;"></td>
                  <td class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important;"></td>
                  <!-- <td class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important;"></td> -->
                  <td><?php echo $paona_row['pabe_name'] ?></td>
                  <td><?php echo $paona_row['pabe_description'] ?></td>
                  <td style="text-align: right;"><?php echo number_format($paona_row['pabe_amount'], 2) ?></td>
                  <td class="noborders" style="border: 1px solid transparent !important;">
                      <?php
                          if($delete_data_permission == 'yes'){?>
                              <a href="modify_vaucher.php?remove_id=<?php echo $paona_row['pabe_id']; ?>" class="btn btn-danger">-</a><?php 
                          } else {
                              echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                          }                          
                      ?>
                      
                  </td>
                  <td class="noborders" style="border: 1px solid transparent !important;"></td>
              </tr>
          </tbody>
          <?php  
        }
    }

    //I dont know its use
    while ($j < $sizes) {
        ?>
        <tbody class="borderless-cell">
            <tr>
                <td class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important;"></td>
                <td class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important; border-right: 1px solid #ccc !important;"></td>
                <td><span style="max-width:200px; word-wrap: anywhere;"><?php if($j<$sizes){echo $datas[$j]['name']; }?></span></td>
                <td style="text-align: right;"><?php if($j<$sizes){echo number_format($datas[$j]['amount'], 2); }?></td>
                <td class="noborders"  style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important;">
                    <?php                     
                        // if($delete_data_permission == 'yes'){
                        //     
                        // } else {
                        //     echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                        // }                     
                    ?>
                    <a data-delete_id="<?php if($j<$sizes){echo $datas[$j]['id']; $j++; } ?>" class="btn btn-danger nijepaboDelete">-</a>
                </td>
                <td class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important;"></td>
                <td class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important;"></td>
                <td class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important; border-right: 1px solid #ccc !important;"></td>
                <!-- <td class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important; border-bottom: 1px solid #ccc !important;"></td> -->
                <td class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important; border-bottom: 1px solid #ccc !important;"></td>
                <td ></td>
                <td ></td>
                <td class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important;"></td>
                <td class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important;"></td>
            </tr>
        </tbody>

        <?php
    } 
    ?>
    <thead>
        <tr class="active">
            <th>del</th>
            <th>edit</th>
            <th>মারফোত নাম</th>
            <th>জমাঃ</th>
            <th>মারফোত নামঃ </th>
            <th>বিবরণ নামঃ</th>
            <th>দর</th>
            <th>জন</th>
            <th>মোট টাকাঃ</th>
            <!-- <th>নগদ পরি‌ষদ</th> -->
            <th>জমা</th>
            <th>জের </th>
            <th>del</th>
            <th>add</th>
        </tr>
    </thead>

    <?php 
        $all_total_taka = 0;
        $all_total_bill = 0;
        $all_group_pay = 0;
        $all_group_due = 0;
        $i=0;
        $query = "SELECT * FROM debit_group WHERE project_name_id = '$project_name_id'";
        $read = $db->select($query);
        if ($read) {
            while ($row = $read->fetch_assoc()) {
              ?>
              <tbody>
                  <tr>
                      <td>
                        <?php if($i<$size){ ?>
                          <!-- <a href="modify_vaucher.php?trash_id=<?php //echo $data[$i]['id']; ?>" class="btn btn-danger jomaDelete">-</a> -->
                          <a href="#" data-trash_id="<?php echo $data[$i]['id']; ?>" class="btn btn-danger jomaDelete">-</a>
                        <?php } ?>
                      </td>
                      <td>
                        <?php if($i<$size){ ?>
                          <a href="update_vaucher_credit.php?edit_id=<?php echo $data[$i]['id']; ?>" class="btn btn-success">Edit</a>
                        <?php } ?>
                      </td>
                      <td><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                      <td style="text-align: right;"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
                      <td class="success text-center"><?php echo $row['group_name']; ?></td>
                      <td class="success text-center"><?php echo $row['group_description']; ?></td>
                      <td class="success text-center"><?php echo $row['taka']; ?></td>
                      <td class="success text-center"><?php echo $row['pices']; ?></td>
                      <td class="success text-center"><?php echo $row['total_taka']; ?></td>
                      <!-- <td class="success text-center"><?php //echo $row['total_bill']; ?></td> -->
                      <td class="success text-center"><?php echo $row['pay']; ?></td>
                      <td class="success text-center"><?php echo $row['due']; ?></td>
                      <td>
                        <!-- <a href="modify_vaucher.php?del_id=<?php echo $row['id']; ?>" class="btn btn-danger voucherDelete">-</a> -->
                        <a href="#" data-del_id="<?php echo $row['id']; ?>" class="btn btn-danger voucherDelete">-</a> 
                      </td>
                      <td>
                        <a href="add_single_group_data.php?add_id=<?php echo $row['id']; ?>" class="btn btn-success">Data</a>
                      </td>
                  </tr>
              </tbody>


              <!-- view debit group data from database -->
              <?php 
                  $debit_group_id = $row['id'];                            

                  // $sql_qry_debit_due="SELECT SUM(group_total_taka) AS debit_due FROM debit_group_data WHERE group_id =$debit_group_id";
                  // $duration_debit_due = $db->select($sql_qry_debit_due);
                  // while($record_debit_due = $duration_debit_due->fetch_array()){
                  //     $total_debit_due = $record_debit_due['debit_due'];
                  //     $total += $total_debit_due;
                  // } 

                  $pabe_amount = 0;
                  $sql_pabe_amount="SELECT SUM(pabe_amount) AS pabe_amount FROM jara_pabe WHERE project_name_id = '$project_name_id'";
                  $duration_pabe_amount = $db->select($sql_pabe_amount);
                  while($record_pabe_amount = $duration_pabe_amount->fetch_array()){
                      $pabe_amount = $record_pabe_amount['pabe_amount'];
                  } 


                  // $sql_qry_debit_group_pay="SELECT SUM(group_pay) AS group_pay FROM debit_group_data WHERE group_id =$debit_group_id";
                  // $duration_debit_group_pay = $db->select($sql_qry_debit_group_pay);
                  // while($record_debit_group_pay = $duration_debit_group_pay->fetch_array()){
                  //     $group_pay = $record_debit_group_pay['group_pay'];
                  // }

                  // $debit_pay=$total_debit_due-$group_pay;
                  // $all_debit_due +=$debit_pay;
                  // $total_pabe_amount += $pabe_amount;
                  // $deu_pay_total=array();

                  $group_wise_total_taka = 0;
                  $group_wise_total_bill = 0;
                  $group_wise_total_pay = 0;
                  $group_wise_total_due = 0;
                  $qry = "SELECT * FROM debit_group_data WHERE group_id = $debit_group_id";
                  $reads = $db->select($qry);
                  if ($reads) {
                      // $cnt=0;
                      while ($row = $reads->fetch_assoc()) {
                          // if($cnt==0){
                          //     $deu_pay_total[$debit_group_id] = $row['group_pay'];
                          //     $cnt++;
                          // }
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
                          <tbody>
                              <tr>
                                  <td>
                                      <!-- aaaaaaaaaaa2 -->
                                      <?php if($i<$size){ ?>
                                        <!-- <a href="modify_vaucher.php?trash_id=<?php echo $data[$i]['id']; ?>" class="btn btn-danger jomaDelete">-</a> -->
                                        <a href="#" data-trash_id="<?php echo $data[$i]['id']; ?>" class="btn btn-danger jomaDelete">-</a>
                                      <?php } ?>
                                  </td>
                                  <td>
                                      <?php if($i<$size){ ?>
                                        <a href="update_vaucher_credit.php?edit_id=<?php echo $data[$i]['id']; ?>" class="btn btn-success">Edit</a>
                                      <?php } ?>
                                  </td>
                                  <td><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                                  <td style="text-align: right;"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
                                  <td><?php echo $group_name; ?></td>
                                  <td><?php echo $group_description; ?></td>
                                  <td class="text-right"><?php echo number_format($group_taka, 2); ?></td>
                                  <td class="text-right"><?php echo $group_pices; ?></td>
                                  <td class="text-right"><?php echo number_format($group_total_taka, 2); ?></td>
                                  <!-- <td class="text-right"><?php //echo number_format($group_total_bill, 2); ?></td> -->
                                  <td class="text-right"><?php echo number_format($group_pay, 2); ?></td>
                                  <td class="text-right"><?php echo number_format($group_due, 2); ?></td>
                                  <td rowspan="2"></td>
                                  <td rowspan="2"></td>
                              </tr>
                          </tbody>
                          <?php
                      }
                  }
              ?>

              <tbody>
                  <tr>
                    <td>
                      <!-- aaaaaaaaaa3 -->
                      <?php if($i<$size){ ?>
                        <!-- <a href="modify_vaucher.php?trash_id=<?php echo $data[$i]['id']; ?>" class="btn btn-danger jomaDelete">-</a> -->
                        <a href="#" data-trash_id="<?php echo $data[$i]['id']; ?>" class="btn btn-danger jomaDelete">-</a>

                      <?php } ?>
                    </td>
                    <td>
                      <?php if($i<$size){ ?>
                      <a href="update_vaucher_credit.php?edit_id=<?php echo $data[$i]['id']; ?>" class="btn btn-success">Edit</a>
                      <?php } ?>
                    </td>
                    <td><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                    <td style="text-align: right;"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
                    <!-- <td></td>
                    <td></td>
                    <td></td> -->
                    <td colspan="4" class="text-right">মোট বিলঃ</td>
                    <td class="text-right" ><?php echo number_format($group_wise_total_taka, 2); ?></td>
                    <!-- <td class="text-right"><?php //echo number_format($group_wise_total_bill, 2); ?></td> -->
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
                    <td></td>
                    <td></td>
                  </tr>
              </tbody>
              <?php  
            }
          }
while ($i < $size) {
?>
<tbody>
  <tr>
    <td>
      <!-- aaaaaaaaaa4 -->
      <!-- <a href="modify_vaucher.php?trash_id=<?php echo $data[$i]['id']; ?>" class="btn btn-danger jomaDelete">-</a> -->
      <a href="#" data-trash_id="<?php echo $data[$i]['id']; ?>" class="btn btn-danger jomaDelete">-</a>
    </td>
    <td>
      <a href="update_vaucher_credit.php?edit_id=<?php echo $data[$i]['id']; ?>" class="btn btn-success">Edit</a>
    </td>
    <td><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
    <td class="text-right"><?php if($i<$size){echo $data[$i]['credit_amount']; $i++;}?></td>
    <td class="borderless-cell"></td>
    <td class="borderless-cell"></td>
    <td class="borderless-cell"></td>
    <td class="borderless-cell"></td>
    <td class="borderless-cell"></td>
    <td class="borderless-cell"></td>
    <td class="borderless-cell"></td>
    <td class="borderless-cell"></td>
    <td class="borderless-cell"></td>
    <!-- <td class="borderless-cell"></td> -->
  </tr>
</tbody>
<?php
}
?>

<tbody class="borderless-cell">
<tr>
<td class="noborders">&nbsp;</td>
<td class="noborders"></td>
<td class="noborders"></td>
<td class="noborders"></td>
<td class="noborders" colspan="9"></td>
<!-- <td class="noborders"></td>
<td class="noborders"></td>
<td class="noborders"></td>
<td class="noborders"></td>
<td class="noborders"></td>
<td class="noborders"></td>
<td class="noborders"></td>
<td class="noborders"></td>
<td class="noborders"></td> -->
</tr>
<tr>
  <td class="noborders"></td>
  <td class="noborders"></td>
  <td class="text-right" style="font-weight: bold;">জমাঃ-</td>
  <td class="text-right" style="font-weight: bold;"><?php echo number_format($credit_total, 2); ?></td>
  <td></td>
  <td></td>
  <td></td>
  <!-- <td></td> -->
  <td class="text-right" style="font-weight: bold;">খরচঃ-</td>
  <td class="text-right" style="font-weight: bold;">
    <?php //echo number_format($total, 2); ?>
    <?php echo number_format($all_total_taka, 2); ?>
  </td>
  <td style="font-weight: bold;">পাওনাঃ-</td>
  <td style="font-weight: bold;">
      <?php
          echo number_format($all_group_due, 2);
      ?>
  </td>
  <td class="noborders"></td>
  <td class="noborders"></td>
</tr>
</tbody>
<?php 
// $due_credit_amount = 0;
// $due_debit_amount = 0;  
// $query = "SELECT id, due_credit_amount, due_debit_amount, due_debit_date FROM due WHERE project_name_id = '$project_name_id'";
// $show = $db->select($query);
// if ($show) 
// {
//     while ($rows = $show->fetch_assoc()) 
//     {
?>
<thead class="noborders">
  <tr>
      <th class="borderless-cell"></th>
      <th class="borderless-cell"></th>
      <th class="text-right">পূরব‌ের জে‌রঃ-</th>
      <th class="text-right">
        <?php
            // echo number_format($rows['due_credit_amount'], 2);
            echo number_format( $total_due_credit, 2);
        ?>
      </th>
      <th class="borderless-cell"></th>
      <th class="borderless-cell"></th>
      <th class="borderless-cell"></th>
      <!-- <th class="borderless-cell"></th> -->
      <th class="text-right">পূরব‌ের পাওনাঃ-</th>
      <th class="text-right">
        <?php
          // echo number_format($rows['due_debit_amount'], 2);
          echo number_format($total_due_debit, 2);
        ?>                                
      </th>
      <th>
          <!-- <a href="update_vaucher_due.php?edite_id=<?php echo $rows['id']; ?>" class="btn btn-success">Edit</a> -->
          <a href="update_vaucher_due.php" class="btn btn-success">
          Add</a>
      </th>
      <th class="borderless-cell"></th>
      <th class="borderless-cell"></th>
      <th class="borderless-cell"></th>
  </tr>
</thead>
<?php
//     }
// }
?>    
<thead class="noborders">
  <tr>
      <th></th>
      <th></th>
      <th class="text-right">ম‌োট জমাঃ-</th>
      <th class="text-right">
          <?php
              // echo number_format($credit_total+$due_credit_amount, 2);
              // var_dump($due_credit_amount);
              echo number_format($remain_credit, 2);
          ?>
      </th>
      <th></th>
      <th></th>
      <th></th>
      <!-- <th></th> -->
      <th class="text-right">ম‌োট খরচঃ-</th>
      <th class="text-right">
        <?php

          $remain_debit = $all_total_taka + $total_due_debit + $total_p_amount - $all_group_due;
          echo number_format($remain_debit, 2);
        ?>
          
        </th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
  </tr>
</thead>
<thead class="noborders">
  <tr>
      <th></th>
      <th></th>
      <th></th>
      <th class="text-right"></th>
      <th></th>
      <th></th>
      <th></th>
      <!-- <th></th> -->
      <th class="text-right">জের/পাওনাঃ-</th>
      <th class="text-right"><?php 
        // echo number_format($credit_total+$due_credit_amount - $total - $due_debit_amount + $total_p_amount, 2);
        
        $result = $remain_credit - $remain_debit;
        echo number_format($result, 2);
      ?></th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
  </tr>
</thead>