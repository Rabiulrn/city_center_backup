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
  // $sql_qrys="SELECT SUM(credit_amount) AS total_credit FROM vaucher_credit WHERE project_name_id = '$project_name_id'";
  $sql_qrys="SELECT SUM(credit_amount) AS total_credit FROM vaucher_credit WHERE project_name_id = '$project_name_id' ORDER BY id DESC LIMIT 10";
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
  // $sql = "SELECT * FROM vaucher_credit WHERE project_name_id = '$project_name_id'";
  $sql = "(SELECT * FROM vaucher_credit WHERE project_name_id = '$project_name_id' ORDER BY id DESC LIMIT 10) ORDER BY id ASC ";
  $p_read = $db->select($sql);
  $data = array();
  $size = 0;
  if($p_read){
      while ($row= $p_read->fetch_assoc()) {
          $data[$size]['id']= trim($row['id']);
          $data[$size]['credit_name'] = trim($row['credit_name']);
          $cm = trim($row['credit_amount']);
          if($cm == ''){
            $cm = 0;
          }
          $data[$size]['credit_amount']= $cm;
          $size++;
      }
  }
  // echo "<pre>";
  // var_dump($data);
  // echo "</pre>";

  //Eta Amar data
  // $sqls = "(SELECT * FROM nij_paonadar WHERE project_name_id = '$project_name_id' ORDER BY id DESC LIMIT 10) ORDER BY id ASC";
  $sqls = "SELECT * FROM nij_paonadar WHERE project_name_id = '$project_name_id' ORDER BY id ASC";
  $p_reads = $db->select($sqls);
  $datas = array();
  $sizes = 0;
  if($p_reads){
      while ($rows= $p_reads->fetch_assoc()) {
          $id = trim($rows['id']);
          $name = trim($rows['name']);
          $description = trim($rows['description']);
          $am = trim($rows['amount']);
          if($am == ''){
            $am = 0;
          }
          $amount = $am;
          
          $enp_sql = "SELECT nij_amount, nij_status FROM entry_nij_paonadar WHERE nij_paonadar_id ='" . $id . "' AND project_name_id = '$project_name_id'";
          $enp_sql_rslt = $db->select($enp_sql);
          if($enp_sql_rslt){
              while ($sumof_enp_result= $enp_sql_rslt->fetch_assoc()){
                  $nij_status = trim($sumof_enp_result['nij_status']);
                  $nij_amount = trim($sumof_enp_result['nij_amount']);
                  if($nij_amount ==''){
                      $nij_amount = 0;
                  }
                  if($nij_status == 'add'){
                      $amount += $nij_amount;
                  } else {
                      $amount -= $nij_amount;
                  }
              }
          }
          $remain_paonader_amount = $amount;
          if($remain_paonader_amount > 0){
              $datas[$sizes]['id']= $id;
              $datas[$sizes]['name']= $name;
              $datas[$sizes]['description']= $description;              
              $datas[$sizes]['amount'] = $remain_paonader_amount;
              $sizes++;
          }

          // $datas[$sizes]['id']= trim($rows['id']);
          // $datas[$sizes]['name']= trim($rows['name']);
          // $datas[$sizes]['description']= trim($rows['description']);
          // $am = trim($rows['amount']);
          // if($am == ''){
          //   $am = 0;
          // }
          // $datas[$sizes]['amount'] = $am;
          // $sizes++;
      }
  }
  // echo "<pre>";
  // var_dump($datas);
  // echo "</pre>";
?>

<!-- <table class="table table-bordered"> --> 
<thead class="noborders">
    <tr>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
        <th class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important; border-bottom: 1px solid #ccc !important; min-width: 90px;"></th>
        <th class="width_200px headerTextAlign">নাম</th>
        <th class="headerTextAlign">টাকাঃ</th>
        <th class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important; min-width: 105px;"></th>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
        <th class="noborders" style="border: 1px solid transparent !important;"></th>
        <th class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important; min-width: 90px;"></th>
        <th class="headerTextAlign">নাম</th>
        <th class="headerTextAlign">বিবরণ</th>
        <th class="headerTextAlign">টাকাঃ</th>
        <th class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important;"></th>
        <th class="noborders" style="border: 1px solid transparent !important; border-bottom: 1px solid #ccc !important;"></th>
    </tr>
</thead>
<?php  
    $j = 0;
    // $paona_query = "(SELECT * FROM jara_pabe WHERE project_name_id = '$project_name_id' ORDER BY pabe_id DESC LIMIT 10) ORDER BY pabe_id ASC";
    $paona_query = "SELECT * FROM jara_pabe WHERE project_name_id = '$project_name_id' ORDER BY pabe_id ASC";
    $paona_read = $db->select($paona_query);
    if ($paona_read) {
        while ($paona_row = $paona_read->fetch_assoc()) {
            $pabe_id = trim($paona_row['pabe_id']);
            $pabe_name = trim($paona_row['pabe_name']);
            $pabe_description = trim($paona_row['pabe_description']);
            $pabe_amount = trim($paona_row['pabe_amount']);
            
            $ejp_sql = "SELECT jp_amount, jp_status FROM entry_jara_pabe WHERE jara_pabe_id ='" .$pabe_id . "' AND project_name_id = '$project_name_id'";
            $ejp_sql_rslt = $db->select($ejp_sql);
            if($ejp_sql_rslt){
                while ($sumof_ejp_result= $ejp_sql_rslt->fetch_assoc()){
                    $jp_status = trim($sumof_ejp_result['jp_status']);
                    $jp_amount = trim($sumof_ejp_result['jp_amount']);
                    if($jp_amount == ''){
                        $jp_amount = 0;
                    }
                    if($jp_status == 'add'){
                        $pabe_amount += $jp_amount;
                    } else {
                        $pabe_amount -= $jp_amount;
                    }
                }
            }
            $remain_pabe_amount = $pabe_amount;
            if($remain_pabe_amount > 0){
                ?>
                <tbody class="borderless-cell">
                    <tr>
                        <th class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important;"></th>
                        <th class="noborders" style="">
                            <?php
                                if($j<$sizes){
                                    echo '<a class="btn btn-primary" href="nij_paonader_paisi_amount_minus.php?data_id=' . $datas[$j]['id'] .'" style ="margin-right: 8px;">&minus;</a>';
                                    echo '<a class="btn btn-primary" href="nij_paonader_paisi_amount_plus.php?data_id=' . $datas[$j]['id'] .'">&plus;</a>';
                                }
                            ?>
                        </th>
                        <td>
                            <span style="max-width:200px; word-wrap: anywhere;">
                                <?php if($j<$sizes){echo $datas[$j]['name']; }?>
                            </span>
                        </td>
                        <td style="text-align: right;">
                            <?php
                                if($j<$sizes){                        
                                    echo number_format($datas[$j]['amount'], 2);
                                }
                            ?>
                        </td>
                        <td class="noborders" style="">
                            <div class="del-edit-details">
                            <?php
                                if($j < $sizes){
                                    $nijAmount = $datas[$j]['id'];
                                    if($delete_data_permission == 'yes'){
                                        echo '<a data-delete_id="' . $nijAmount .'" class="btn btn-danger nijepaboDelete">-</a>';
                                    } else {
                                        echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                                    }
                     
                                    $nijAmountId = $datas[$j]['id'];
                                    if($edit_data_permission == 'yes'){
                                        echo '<a href="update_nij_paonader.php?edit_id=' . $nijAmountId .'" class="btn btn-success mg-others">Edit</a>';
                                    } else {
                                        echo '<a class="btn btn-success edPermit mg-others" disabled>Edit</a>';
                                    }

                                    echo '<a href="statements_nij_paonader.php?info_id=' . $nijAmountId .'"class="btn btn-warning mg-others">?</a>';

                                    $j++;
                                }
                            ?>
                            </div>
                        </td>
                        <td class="noborders" style="border: 1px solid transparent !important;"></td>
                        <td class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important;"></td>
                        <td class="noborders" style="border: 1px solid #ccc !important;">
                            <?php
                                echo '<a class="btn btn-primary" href="jara_pabe_diesi_amount_minus.php?data_id='.$pabe_id.'" style ="margin-right: 8px;">&minus;</a>';
                                echo '<a class="btn btn-primary" href="jara_pabe_diesi_amount_plus.php?data_id='.$pabe_id.'">&plus;</a>';
                            ?>
                        </td>
                        <td><?php echo $pabe_name; ?></td>
                        <td><?php echo $pabe_description; ?></td>
                        <td style="text-align: right;">
                            <?php 
                                echo number_format($remain_pabe_amount, 2); 
                            ?>
                        </td>
                        <td class="noborders" style="">
                            <?php
                                if($delete_data_permission == 'yes'){
                                    echo '<a data-remove_id="' . $pabe_id .'" class="btn btn-danger paonaDelete">-</a>';
                                } else {
                                    echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                                }                                                       
                            ?>
                        </td>
                        <td class="noborders">
                            <div class="pabe-edit-details">
                                <?php
                                    if($edit_data_permission == 'yes'){
                                        echo '<a href="update_jara_pabe.php?edit_id=' . $pabe_id .'" class="btn btn-success">Edit</a>';
                                    } else {
                                        echo '<a class="btn btn-success edPermit" disabled>Edit</a>';
                                    }
                                    echo '<a href="statements_jara_pabe.php?info_id=' . $pabe_id .'"class="btn btn-warning mg-others">?</a>';
                                ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <?php
            }           
        }
    }

    
    while ($j < $sizes) {
        ?>
        <tbody class="borderless-cell">
            <tr>
                <td class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important;"></td>
                <td class="noborders">
                      <?php
                          if($j<$sizes){
                              echo '<a class="btn btn-primary" href="nij_paonader_paisi_amount_minus.php?data_id=' . $datas[$j]['id'] .'" style ="margin-right: 8px;">&minus;</a>';
                              echo '<a class="btn btn-primary" href="nij_paonader_paisi_amount_plus.php?data_id=' . $datas[$j]['id'] .'">&plus;</a>';
                          }
                      ?>
                </td>
                <td><span style="max-width:200px; word-wrap: anywhere;"><?php if($j<$sizes){echo $datas[$j]['name']; }?></span></td>
                <td style="text-align: right;">
                    <?php
                        if($j<$sizes){                          
                          echo number_format($datas[$j]['amount'], 2); 
                        }
                    ?>                    
                </td>
                <td class="noborders"  style="">
                    <div class="del-edit-details">
                        <?php
                            if($j<$sizes){
                                $nijAmount2 = $datas[$j]['id'];
                                if($delete_data_permission == 'yes'){
                                    echo '<a data-delete_id="' . $nijAmount2 .'" class="btn btn-danger nijepaboDelete">-</a>';
                                } else {
                                    echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                                }
                        
                                $nijAmountId2 = $datas[$j]['id'];
                                if($edit_data_permission == 'yes'){
                                    echo '<a href="update_nij_paonader.php?edit_id=' . $nijAmountId2 .'" class="btn btn-success" style="margin-left: 8px;">Edit</a>';
                                } else {
                                    echo '<a class="btn btn-success edPermit" disabled style="margin-left: 8px;">Edit</a>';
                                }

                                echo '<a href="statements_nij_paonader.php?info_id=' . $nijAmountId2 .'"class="btn btn-warning mg-others">?</a>';
                                $j++;
                            }
                        ?>
                    </div>
                </td>
                <td class="noborders" style="border: 1px solid transparent !important; "></td>
                <td class="noborders" style="border: 1px solid transparent !important; border-right: 1px solid #ccc !important;"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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
                          <?php
                              if($i<$size) {
                                  if($delete_data_permission == 'yes'){
                                      echo '<a data-trash_id="' . $data[$i]['id'] .'" class="btn btn-danger jomaDelete">-</a>';
                                  } else {
                                      echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                                  }
                              }
                          ?>
                      </td>
                      <td>
                          <?php
                              if($i<$size){
                                  if($edit_data_permission == 'yes'){
                                      echo '<a href="update_vaucher_credit.php?edit_id=' . $data[$i]['id'] .'" class="btn btn-success">Edit</a>';
                                  } else {
                                      echo '<a class="btn btn-success edPermit" disabled>Edit</a>';
                                  }                              
                              }
                          ?>
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
                          <?php
                              if($delete_data_permission == 'yes'){
                                  echo '<a data-del_id="'. $row['id'] .'" class="btn btn-danger voucherDelete">-</a>';
                              } else {
                                  echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                              }
                          ?>
                      </td>
                      <td>
                        <a href="add_single_group_data.php?add_id=<?php echo $row['id']; ?>" class="btn btn-success">Data</a>
                      </td>
                  </tr>
              </tbody>


              <!-- view debit group data from database -->
              <?php 
                  $debit_group_id = $row['id'];

                  $pabe_amount = 0;
                  $sql_pabe_amount="SELECT SUM(pabe_amount) AS pabe_amount FROM jara_pabe WHERE project_name_id = '$project_name_id' ORDER BY pabe_id DESC LIMIT 10";
                  
                  $duration_pabe_amount = $db->select($sql_pabe_amount);
                  while($record_pabe_amount = $duration_pabe_amount->fetch_array()){
                      $pabe_amount = $record_pabe_amount['pabe_amount'];
                  } 


                  $group_wise_total_taka = 0;
                  $group_wise_total_bill = 0;
                  $group_wise_total_pay = 0;
                  $group_wise_total_due = 0;
                  $qry = "(SELECT * FROM debit_group_data WHERE group_id = '$debit_group_id' AND project_name_id='$project_name_id' ORDER BY id DESC LIMIT 10) ORDER BY id ASC";

                  // SELECT * FROM `dealers` ORDER BY id DESC LIMIT 10) ORDER BY id ASC
                  $reads = $db->select($qry);
                  if ($reads) {
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
                          <tbody>
                              <tr>
                                  <td>
                                      <?php
                                          if($i<$size) {
                                              if($delete_data_permission == 'yes'){
                                                  echo '<a data-trash_id="' . $data[$i]['id'] .'" class="btn btn-danger jomaDelete">-</a>';
                                              } else {
                                                  echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                                              }
                                          }
                                      ?>
                                  </td>
                                  <td>
                                      <?php
                                          if($i<$size){
                                              if($edit_data_permission == 'yes'){
                                                  echo '<a href="update_vaucher_credit.php?edit_id=' . $data[$i]['id'] .'" class="btn btn-success">Edit</a>';
                                              } else {
                                                  echo '<a class="btn btn-success edPermit" disabled>Edit</a>';
                                              }                              
                                          }
                                      ?>
                                  </td>
                                  <td><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                                  <td style="text-align: right;"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
                                  <td><?php echo $group_name; ?></td>
                                  <td><?php echo $group_description; ?></td>
                                  <td class="text-right"><?php echo number_format($group_taka, 2); ?></td>
                                  <td class="text-right"><?php echo $group_pices; ?></td>
                                  <td class="text-right"><?php echo number_format($group_total_taka, 2); ?></td>
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
                        <?php
                            if($i<$size) {
                                if($delete_data_permission == 'yes'){
                                    echo '<a data-trash_id="' . $data[$i]['id'] .'" class="btn btn-danger jomaDelete">-</a>';
                                } else {
                                    echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            if($i<$size){
                                if($edit_data_permission == 'yes'){
                                    echo '<a href="update_vaucher_credit.php?edit_id=' . $data[$i]['id'] .'" class="btn btn-success">Edit</a>';
                                } else {
                                    echo '<a class="btn btn-success edPermit" disabled>Edit</a>';
                                }                              
                            }
                        ?>
                    </td>
                    <td><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                    <td style="text-align: right;"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
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
        <?php
            if($delete_data_permission == 'yes'){
                echo '<a data-trash_id="' . $data[$i]['id'] .'" class="btn btn-danger jomaDelete">-</a>';
            } else {
                echo '<a class="btn btn-danger edPermit" disabled>-</a>';
            }
        ?>
    </td>
    <td>
        <?php
            if($edit_data_permission == 'yes'){
                echo '<a href="update_vaucher_credit.php?edit_id=' . $data[$i]['id'] .'" class="btn btn-success">Edit</a>';
            } else {
                echo '<a class="btn btn-success edPermit" disabled>Edit</a>';
            }
        ?>
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