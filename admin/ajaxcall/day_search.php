<?php
  session_start();  
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $project_name_id = $_SESSION['project_name_id'];
  $optionDate = date('Y-m-d', strtotime($_POST['optionDate']));

  //total calculation section
  $credit_total = 0;
  $sql_qry="SELECT SUM(credit_amount) AS total_credit FROM vaucher_credit WHERE credit_date = '$optionDate' AND project_name_id = '$project_name_id'";
  $credit = $db->select($sql_qry);
  while($credit_record = $credit->fetch_array()){
    $credit_total = $credit_record['total_credit'];
  }

  $total_due_credit = 0;
  $sql_qry_due_credit="SELECT SUM(due_credit_amount) AS total_due_credit FROM due WHERE due_debit_date = '$optionDate' AND project_name_id = '$project_name_id'";
  $due_credit = $db->select($sql_qry_due_credit);
  while($due_credits = $due_credit->fetch_array()){
    $total_due_credit = $due_credits['total_due_credit'];
  }

  $total_due_debit = 0;
  $sql_qry_due_debit="SELECT SUM(due_debit_amount) AS total_due_debit FROM due WHERE due_debit_date = '$optionDate' AND project_name_id = '$project_name_id'";
  $due_debit = $db->select($sql_qry_due_debit);
  while($due_debits = $due_debit->fetch_array()){
    $total_due_debit = $due_debits['total_due_debit'];
  }


  // $total = 0;
  // $total_due = 0;
  // $all_debit_due  = 0;
  // $total_pabe_amount = 0;
  // $deu_pay_total = 0;

  $total_p_amount = 0;
  $remain_credit = $credit_total + $total_due_credit;


  $sql="SELECT * FROM vaucher_credit WHERE credit_date = '$optionDate' AND project_name_id = '$project_name_id'";
  $p_read = $db->select($sql);
  $data=array();
  $size=0;
  if($p_read){
      while ($row= $p_read->fetch_assoc()) {
          $data[$size]['credit_name'] = trim($row['credit_name']);
          $cm = trim($row['credit_amount']);
          if($cm == ''){
            $cm = 0;
          }
          $data[$size]['credit_amount']= $cm;
          $size++;
      }
  }

  
  // $sqls="SELECT * FROM nij_paonadar WHERE nij_paona_date = '$optionDate' AND project_name_id = '$project_name_id'";
  $sqls="SELECT * FROM nij_paonadar WHERE nij_paona_date <= '$optionDate' AND project_name_id = '$project_name_id'";
  $p_reads = $db->select($sqls);
  $datas=array();
  $sizes=0;
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
          
          $enp_sql = "SELECT nij_amount, nij_status FROM entry_nij_paonadar WHERE nij_paonadar_id ='" . $id . "' AND nij_date <= '$optionDate' AND project_name_id = '$project_name_id'";
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
      }
  }
?>
<thead>
    <tr class="d-flex">
        <!-- <th class="col-3">Day</th> -->
        
    </tr>
</thead>

<thead id="noborders" class="text-format">
    <tr class="d-flex ">
        <th class="active width_200px ">কোম্পানির পাওনার নামঃ </th>
        <th class="active width_5px">টাকাঃ</th>
        <th id="borderless-cell"></th>
        <th id="borderless-cell"></th>
        <th id="borderless-cell"></th>
        <th id="borderless-cell"></th>
        <th class="active width_100px">পাওনার নামঃ </th>
        <th class="active">বিবরণ</th>
        <th class="active">টাকাঃ</th>
    </tr>
</thead>
<?php  

    $j = 0;
    // $paona_query = "SELECT * FROM jara_pabe WHERE pabe_date = '$optionDate' AND project_name_id = '$project_name_id'";
    $paona_query = "SELECT * FROM jara_pabe WHERE pabe_date <= '$optionDate' AND project_name_id = '$project_name_id'";
    $paona_read = $db->select($paona_query);
    if ($paona_read) {
        while ($paona_row = $paona_read->fetch_assoc()) {
            $pabe_id = trim($paona_row['pabe_id']);
            $pabe_name = trim($paona_row['pabe_name']);
            $pabe_description = trim($paona_row['pabe_description']);
            $pabe_amount = trim($paona_row['pabe_amount']);
            
            $ejp_sql = "SELECT jp_amount, jp_status FROM entry_jara_pabe WHERE jara_pabe_id ='" .$pabe_id . "' AND jp_date <= '$optionDate' AND project_name_id = '$project_name_id'";
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
                <tbody id="noborders">
                    <tr class="d-flex">
                        <td class="col-3"><span style="max-width:200px; word-wrap: anywhere;"><?php if($j<$sizes){echo $datas[$j]['name']; }?></span></td>
                        <td class="text-right">
                            <?php
                                if($j<$sizes){
                                    echo number_format($datas[$j]['amount'], 2); $j++;
                                }
                            ?>                  
                        </td>
                        <td id="noborders"><?php //if($j<$sizes){echo $datas[$j]['description']; $j++; }?></td>
                        <td id="noborders"></td>
                        <td id="noborders"></td>
                        <td id="noborders"></td>
                        <!-- <td><?php //echo $paona_row['pabe_name'] ?></td>
                        <td><?php //echo $paona_row['pabe_description'] ?></td>
                        <td class="text-right"><?php //echo number_format($paona_row['pabe_amount'], 0) ?></td> -->
                        <?php                    
                            echo '<td>' . $pabe_name . '</td>',
                            '<td>' . $pabe_description . '</td>',
                            '<td class="text-right">' . number_format($remain_pabe_amount, 2) .'</td>';
                        ?>
                    </tr>
                </tbody>
                <?php
            }             
        }
    }



    while ($j < $sizes) {
      ?>
      <tbody id="noborders">
          <tr class="d-flex">
              <td class="col-3"><span style="max-width:200px; word-wrap: anywhere;"><?php if($j<$sizes){echo $datas[$j]['name']; }?></span></td>
              <td class="text-right">
                  <?php if($j<$sizes){echo number_format($datas[$j]['amount'], 2); $j++; }?>
              </td>
              <td id="noborders"><?php //if($j<$sizes){echo $datas[$j]['description']; $j++; }?></td>
              <td id="noborders"></td>
              <td id="noborders"></td>
              <td id="noborders"></td>
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
            <th class="text-center">জমা মারফোত নামঃ</th>
            <th class="text-center">জমাঃ</th>
            <th class="width_200px text-center">খরচের মারফোত নামঃ</th>
            <th class="width_200px text-center">বিবরণ নামঃ</th>
            <th class="text-center">দরঃ</th>
            <th class="text-center width_100px">জনঃ</th>
            <th class="text-center width_100px">মোট টাকাঃ</th>
            <th class="text-center width_5px">জমাঃ</th>
            <th class="text-center">জেরঃ </th>
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
            // view debit group data from databas
            $debit_group_id = $row['id'];

            
            $pabe_amount = 0;
            $sql_pabe_amount="SELECT SUM(pabe_amount) AS pabe_amount FROM jara_pabe WHERE project_name_id = '$project_name_id' AND pabe_date = '$optionDate'";
            $duration_pabe_amount = $db->select($sql_pabe_amount);
            while($record_pabe_amount = $duration_pabe_amount->fetch_array()){
                $pabe_amount = $record_pabe_amount['pabe_amount'];                
            } 
            
            
            $group_wise_total_taka = 0;
            $group_wise_total_bill = 0;
            $group_wise_total_pay = 0;
            $group_wise_total_due = 0;
            $qry = "SELECT * FROM debit_group_data WHERE group_id = '$debit_group_id' AND entry_date = '$optionDate'";
            $reads = $db->select($qry);
            if (mysqli_num_rows($reads) > 0) {
                ?>
                <tbody>
                    <tr class="d-flex">
                        <td class="col-3"><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                        <td class="text-right"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
                        <td class="newGroup text-center"><?php echo $row['group_name']; ?></td>
                        <td class="newGroup text-center"><?php echo $row['group_description']; ?></td>
                        <td class="newGroup text-center"><?php echo $row['taka']; ?></td>
                        <td class="newGroup text-center"><?php echo $row['pices']; ?></td>
                        <td class="newGroup text-center"><?php echo $row['total_taka']; ?></td>
                        <!-- <td class="newGroup text-center"><?php //echo $row['total_bill']; ?></td> -->
                        <td class="newGroup text-center"><?php echo $row['pay']; ?></td>
                        <td class="newGroup text-center"><?php echo $row['due']; ?></td>
                    </tr>
                </tbody>
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
                    <tbody>
                        <tr class="d-flex">
                          <td class="">
                            <span style="max-width:200px; word-wrap: anywhere;">
                              <?php if($i<$size){ echo $data[$i]['credit_name']; }?>
                            </span>
                          </td>                                        
                          <td class="text-right">
                            <?php if($i<$size){if($data[$i]['credit_amount'] !== ''){ echo number_format($data[$i]['credit_amount'], 2);} $i++;} ?>
                          </td>                          
                          <td><?php echo $group_name; ?></td>
                          <td><?php echo $group_description; ?></td>
                          <td class="text-right">
                            <?php echo number_format($group_taka, 2); ?>
                          </td>
                          <td class="text-right"><?php echo $group_pices; ?></td>
                          <td class="text-right">
                            <?php echo number_format($group_total_taka, 2); ?>
                          </td>
                          <!-- <td class="text-right"> -->
                            <?php //echo number_format($group_total_bill, 2); ?>
                          <!-- </td> -->
                          <td class="text-right"><?php echo number_format($group_pay, 2); ?></td>
                          <td class="text-right"><?php echo number_format($group_due, 2); ?></td>
                        </tr>
                    </tbody>
                    <?php
                }
              ?>
                    <tbody id="borderless-cell">
                        <tr class="d-flex">
                          <td class="col-3"><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                          <td class="text-right"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
                          <!-- <td id="noborders"></td>
                          <td id="noborders"></td>
                          <td id="noborders"></td> -->
                          <td class="text-right " colspan="4">মোট বিলঃ</td>
                          <td class="text-right"><?php echo number_format($group_wise_total_taka, 2); ?></td>
                          <!-- <td class="text-right"><?php //echo number_format($group_wise_total_bill, 2); ?></td> -->
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
                    </tbody>

            <?php
            }
            ?>


        <?php  

        }
    }



    while ($i < $size) {
      ?>
      <tbody>
          <tr>
              <td class="col-3"><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
              <td class="text-right"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <!-- <td></td> -->
          </tr>
      </tbody>
      <?php
    }
  ?>

      


<?php 

    $query = "SELECT due_credit_amount, due_debit_amount, due_debit_date FROM due WHERE due_debit_date = '$optionDate' AND project_name_id = '$project_name_id'";
    $show = $db->select($query);
    if (mysqli_num_rows($show) > 0){
        while ($rows = $show->fetch_assoc()){
          ?>
            <tbody>
                <tr >
                  <td >&nbsp;</td>                  
                  <td ></td>
                  <td colspan="7"></td>
                </tr> 
                <tr>
                  <td class="text-right">জমাঃ-</td>
                  <td class="text-right"><?php echo number_format($credit_total, 2) ?></td>
                  <td id="noborders"></td>
                  <td id="noborders"></td>
                  <td id="noborders"></td>
                  <!-- <td id="noborders"></td>         -->
                  <td class="text-right">খরচঃ-</td>
                  <td class="text-right"><?php echo number_format($all_total_taka, 2) ?></td>
                  <td class="text-right">পাওনাঃ-</td>
                  <td class="text-right">
                    <?php
                      echo number_format($all_group_due, 2);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td class="text-right">পূরব‌ের জে‌রঃ-</td>
                  <td class="text-right"><?php echo number_format($rows['due_credit_amount'], 2); ?></td>
                  <td id="borderless-cell"></td>
                  <td id="noborders"></td>
                  <td id="noborders"></td>
                  <!-- <td id="noborders"></td> -->
                  <td class="text-right">পূরব‌ের পাওনাঃ-</td>
                  <td class="text-right"><?php echo number_format($rows['due_debit_amount'], 2); ?></td>
                  <td id="noborders"></td>
                  <td id="noborders"></td>
                </tr>
            </tbody>
          <?php
        }
    } else {
        ?>
        <tbody>
          <tr>
            <td >&nbsp;</td>                  
            <td ></td>
            <td colspan="7"></td>
          </tr> 
          <tr>
            <td class="text-right">জমাঃ-</td>
            <td class="text-right"><?php echo number_format($credit_total, 2) ?></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <!-- <td id="noborders"></td>         -->
            <td class="text-right">খরচঃ-</td>
            <td class="text-right"><?php echo number_format($all_total_taka, 2) ?></td>
            <td class="text-right">পাওনাঃ-</td>
            <td class="text-right">
              <?php
                echo number_format($all_group_due, 2);
              ?>
            </td>
          </tr>
          <tr>
            <td class="text-right">পূরব‌ের জে‌রঃ-</td>
            <td class="text-right"><?php echo number_format(0, 2); ?></td>
            <td id="borderless-cell"></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <!-- <td id="noborders"></td> -->
            <td class="text-right">পূরব‌ের পাওনাঃ-</td>
            <td class="text-right"><?php echo number_format(0, 2); ?></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
          </tr>
      </tbody>
        <?php
    }

?>  
    <tbody id="noborders">
        <tr>
            <td class="text-right">ম‌োট জমাঃ-</td>
            <td class="text-right"><?php echo number_format($remain_credit, 2); ?></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <!-- <td id="noborders"></td> -->
            <td class="text-right">মোট খরচঃ-</td>
            <td class="text-right"><?php 
                $remain_debit = $all_total_taka + $total_due_debit + $total_p_amount - $all_group_due;
                echo number_format($remain_debit, 2); ?></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
        </tr>
    </tbody>
    <tbody id="noborders">
        <tr>
            <td id="borderless-cell"></td>
            <td id="borderless-cell"></td>
            <td id="borderless-cell"></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <!-- <td id="noborders"></td> -->
            <td class="text-right"><!-- Total Remain --> জের / পাওনাঃ-</td>
            <td class="text-right"><?php 
                $result = $remain_credit - $remain_debit;
                echo number_format($result, 2); ?></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
        </tr>
    </tbody>
   
    

