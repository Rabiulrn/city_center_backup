<?php 
session_start();  
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$project_name_id = $_SESSION['project_name_id'];
?>

<html>

<head>
	<title>Download</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<style type="text/css">
		
	</style>
</head>
<body>
	<div>
<p style="text-align: center;"><button style="color: #fff; font-weight: bold; font-size: 14px; background-color: green; padding: 5px 10px; cursor: pointer; " onclick="download()">Download</button></p>
<table id="container_table" class="table table-bordered" style="font-size: 12px; border-collapse: collapse;" >
<?php
if($_GET['date'] === 'alldates'){

	  //total calculation section
	  $sql_qry="SELECT SUM(credit_amount) AS total_credit FROM vaucher_credit WHERE project_name_id = '$project_name_id'";
	  $credit = $db->select($sql_qry);
	  while($credit_record = $credit->fetch_array()){
	      $credit_total = $credit_record['total_credit'];
	  }


	  $sql_qry_due_credit="SELECT SUM(due_credit_amount) AS total_due_credit FROM due WHERE project_name_id = '$project_name_id'";
	  $due_credit = $db->select($sql_qry_due_credit);
	  while($due_credits = $due_credit->fetch_array()){
	      $total_due_credit = $due_credits['total_due_credit'];
	  }


	  $sql_qry_due_debit="SELECT SUM(due_debit_amount) AS total_due_debit FROM due WHERE project_name_id = '$project_name_id'";
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


	  $sql="SELECT * FROM vaucher_credit WHERE project_name_id = '$project_name_id'";
	  $p_read = $db->select($sql);
	  $data=array();
	  $size=0;
	  if($p_read){
	      while ($row= $p_read->fetch_assoc()) {
	          $data[$size]['credit_name']= $row['credit_name']; 
	          $data[$size]['credit_amount']= $row['credit_amount']; 
	          $size++;
	      }
	  }

	  $sqls="SELECT * FROM nij_paonadar WHERE project_name_id = '$project_name_id'";
	  $p_reads = $db->select($sqls);
	  $datas=array();
	  $sizes=0;
	  if($p_reads){
	      while ($rows= $p_reads->fetch_assoc()) {
	          $datas[$sizes]['id']= $rows['id'];
	          $datas[$sizes]['name']= $rows['name'];
	          $datas[$sizes]['description']= $rows['description'];
	          $datas[$sizes]['amount']= $rows['amount'];
	          $sizes++;
	      }
	  }
	  ?>
	  <thead>
            <tr class="d-flex">
              <!-- <th class="col-3">Day</th> -->
            </tr>
        </thead>
        <thead id="noborders" class="text-format">
            <tr>
              <th class="active width_200px" style="font-size: 13px; border: 1px solid #ddd; padding: 4px;">কোম্পানির পাওনার নামঃ </th>
              <th class="active text-right width_5px" style="font-size: 13px; border: 1px solid #ddd; padding: 4px;">টাকাঃ</th>
              <th id="borderless-cell" ></th>
              <th id="borderless-cell" ></th>
              <th id="borderless-cell" ></th>
              <th id="borderless-cell" ></th>
              <!-- <th id="borderless-cell" ></th>  -->
              <th class="active width_100px" style="font-size: 13px; border: 1px solid #ddd; padding: 4px;">পাওনার নামঃ </th>
              <th class="active" style="font-size: 13px; border: 1px solid #ddd; padding: 4px;">বিবরণ</th>
              <th class="active text-right" style="font-size: 13px; border: 1px solid #ddd; padding: 4px;">টাকাঃ</th>
            </tr>
        </thead>
          <?php
            $j = 0;
            $paona_query = "SELECT * FROM jara_pabe WHERE project_name_id = '$project_name_id'";
            $paona_read = $db->select($paona_query);
            if ($paona_read){
              while ($paona_row = $paona_read->fetch_assoc()) {
              ?>
                <tbody id="noborders">
                  <tr class="d-flex">
                    <td class="col-3" style="border: 1px solid #ddd; padding: 4px;"><span style="max-width:200px; word-wrap: anywhere;"><?php if($j<$sizes){echo $datas[$j]['name']; }?></span></td>
                    <td class="text-right" style="border: 1px solid #ddd; text-align: right; padding: 4px;"><?php if($j<$sizes){echo number_format($datas[$j]['amount'], 2); $j++; }?></td>
                    <td id="noborders"><?php //if($j<$sizes){echo $datas[$j]['description']; $j++; }?></td>
                    <td id="noborders"></td>
                    <td id="noborders"></td>
                    <td id="noborders"></td>
                    <!-- <td id="noborders"></td> -->
                    <td style="border: 1px solid #ddd; padding: 4px;"><?php echo $paona_row['pabe_name'] ?></td>
                    <td style="border: 1px solid #ddd; padding: 4px;"><?php echo $paona_row['pabe_description'] ?></td>
                    <td class="text-right" style="border: 1px solid #ddd; text-align: right; padding: 4px;"><?php echo number_format($paona_row['pabe_amount'], 2) ?></td>
                  </tr>
                </tbody>
              <?php  
              }
            }

            while ($j < $sizes) {
            ?>
              <tbody id="noborders">
                  <tr class="d-flex">
                    <td class="col-3"><span style="max-width:200px; word-wrap: anywhere; border: 1px solid #ddd; padding: 4px;"><?php if($j<$sizes){echo $datas[$j]['name']; }?></span></td>
                    <td class="text-right" style="border: 1px solid #ddd; text-align: right; padding: 4px;"><?php if($j<$sizes){echo number_format($datas[$j]['amount'], 2); $j++; }?></td>
                    <td id="noborders"><?php //if($j<$sizes){echo $datas[$j]['description']; $j++; }?></td>
                    <td id="noborders"></td>
                    <td id="noborders"></td>
                    <td id="noborders"></td>
                    <!-- <td id="noborders"></td> -->
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
                <th class="col-3 active text-center" style='font-size: 13px; border: 1px solid #ddd;'>জমা মারফোত নামঃ
                </th>
                <th class="text-right active  text-center" style='font-size: 13px; border: 1px solid #ddd;'>জমাঃ</th>
                <th class="width_200px active  text-center" style='font-size: 13px; border: 1px solid #ddd;'>খরচের মারফোত নামঃ </th>
                <th class="width_200px active  text-center" style='font-size: 13px; border: 1px solid #ddd;'>বিবরণ নামঃ</th>
                <th class="text-right active  text-center" style='font-size: 13px; border: 1px solid #ddd;'>দরঃ</th>
                <th class="text-right active  text-center width_100px" style='font-size: 13px; border: 1px solid #ddd;'>জনঃ</th>
                <th class="text-right active  text-center width_100px" style='font-size: 13px; border: 1px solid #ddd;'>মোট টাকাঃ</th>
                <!-- <th class="text-right active  text-center" style='font-size: 13px; border: 1px solid #ddd;'>নগদ পরি‌ষদঃ</th> -->
                <th class="text-right active  text-center width_5px" style='font-size: 13px; border: 1px solid #ddd;'>জমাঃ</th>
                <th class="text-right active  text-center" style='font-size: 13px; border: 1px solid #ddd;'>জেরঃ </th>
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
                    <tr class="d-flex">
                      <td class="col-3" style="border: 1px solid #ddd; padding: 4px;"><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>

                      <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php if($i<$size){if($data[$i]['credit_amount'] !== ''){echo number_format($data[$i]['credit_amount'], 2);} $i++;}?></td>
                      <td class="newGroup text-center" style="border: 1px solid #ddd; padding: 4px; text-align: center; font-weight: bold; background-color: #bdbdbd;"><?php echo $row['group_name']; ?></td>
                      <td class="newGroup text-center" style="border: 1px solid #ddd; padding: 4px; text-align: center; font-weight: bold; background-color: #bdbdbd;"><?php echo $row['group_description']; ?></td>
                      <td class="newGroup text-center" style="border: 1px solid #ddd; padding: 4px; text-align: center; font-weight: bold; background-color: #bdbdbd;"><?php echo $row['taka']; ?></td>
                      <td class="newGroup text-center" style="border: 1px solid #ddd; padding: 4px; text-align: center; font-weight: bold; background-color: #bdbdbd;"><?php echo $row['pices']; ?></td>
                      <td class="newGroup text-center" style="border: 1px solid #ddd; padding: 4px; text-align: center; font-weight: bold; background-color: #bdbdbd;"><?php echo $row['total_taka']; ?></td>
                      <!-- <td class="newGroup text-center" style="border: 1px solid #ddd; padding: 4px; text-align: center; font-weight: bold;"><?php //echo $row['total_bill']; ?></td> -->
                      <td class="newGroup text-center" style="border: 1px solid #ddd; padding: 4px; text-align: center; font-weight: bold; background-color: #bdbdbd;"><?php echo $row['pay']; ?></td>
                      <td class="newGroup text-center" style="border: 1px solid #ddd; padding: 4px; text-align: center; font-weight: bold; background-color: #bdbdbd;"><?php echo $row['due']; ?></td>
                    </tr>
                  </tbody>
          

                  <!-- view debit group data from database -->
                  <?php 
                  $debit_group_id = $row['id'];


                  // $sql_qry_debit_due="SELECT SUM(group_total_taka) AS debit_due FROM debit_group_data WHERE group_id ='$debit_group_id' AND project_name_id = '$project_name_id'";
                  // $duration_debit_due = $db->select($sql_qry_debit_due);
                  // while($record_debit_due = $duration_debit_due->fetch_array()){
                  //   $total_debit_due = $record_debit_due['debit_due'];
                  //   $total += $total_debit_due;
                  // } 
                  

                  $pabe_amount = 0;
                  $sql_pabe_amount="SELECT SUM(pabe_amount) AS pabe_amount FROM jara_pabe WHERE project_name_id = '$project_name_id'";
                  $duration_pabe_amount = $db->select($sql_pabe_amount);
                  while($record_pabe_amount = $duration_pabe_amount->fetch_array()){
                    $pabe_amount = $record_pabe_amount['pabe_amount'];
                    // $total_pabe_amount += $pabe_amount;
                  } 
                  
                  // $sql_qry_debit_group_pay="SELECT SUM(group_pay) AS group_pay FROM debit_group_data WHERE group_id =$debit_group_id";
                  // $duration_debit_group_pay = $db->select($sql_qry_debit_group_pay);
                  // while($record_debit_group_pay = $duration_debit_group_pay->fetch_array()){
                  //   $group_pay = $record_debit_group_pay['group_pay'];
                  // }

                  // $debit_pay=$total_debit_due-$group_pay;
                  // $all_debit_due +=$debit_pay;
                  // $deu_pay_total=array();
               


                  $group_wise_total_taka = 0;
                  $group_wise_total_bill = 0;
                  $group_wise_total_pay = 0;
                  $group_wise_total_due = 0;
                  $qry = "SELECT * FROM debit_group_data WHERE group_id = '$debit_group_id' AND project_name_id = '$project_name_id'";
                  $reads = $db->select($qry);
                  if ($reads) {
                    // $cnt=0;
                    while ($row = $reads->fetch_assoc()) {
                      // if($cnt==0){
                      //   $deu_pay_total[$debit_group_id] = $row['group_pay'];
                      //   $cnt++;
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
                        <tr class="d-flex">
                          <td style="border: 1px solid #ddd; padding: 4px;">
                            <span style="max-width:200px; word-wrap: anywhere;">
                              <?php if($i<$size){ echo $data[$i]['credit_name']; }?>
                            </span>
                          </td>                                        
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">
                            <?php if($i<$size){if($data[$i]['credit_amount'] !== ''){ echo number_format($data[$i]['credit_amount'], 2);} $i++;} ?>
                          </td>                          
                          <td style="border: 1px solid #ddd; padding: 4px;"><?php echo $group_name; ?></td>
                          <td style="border: 1px solid #ddd; padding: 4px;"><?php echo $group_description; ?></td>
                          <td class="text-right" style="border: 1px solid #ddd; text-align: right; padding: 4px;">
                            <?php echo number_format($group_taka, 2); ?>
                          </td>
                          <td class="text-right" style="border: 1px solid #ddd; text-align: right; padding: 4px;"><?php echo $group_pices; ?></td>
                          <td class="text-right" style="border: 1px solid #ddd; text-align: right; padding: 4px;">
                            <?php echo number_format($group_total_taka, 2); ?>
                          </td>
                          <!-- <td class="text-right" style="border: 1px solid #ddd; text-align: right; padding: 4px;">
                            <?php //echo number_format($group_total_bill, 2); ?>
                          </td> -->
                          <td class="text-right" style="border: 1px solid #ddd; text-align: right; padding: 4px;"><?php echo number_format($group_pay, 2); ?></td>
                          <td class="text-right" style="border: 1px solid #ddd; text-align: right; padding: 4px;"><?php echo number_format($group_due, 2); ?></td>
                        </tr>
                      </tbody>
                    <?php
                    }
                  }

                ?>
                <tbody id="borderless-cell">
                  <tr class="d-flex">
                    <td class="col-3" style="border: 1px solid #ddd !important; padding: 4px;"><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                    <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;"><?php if($i<$size){if($data[$i]['credit_amount'] !==''){echo number_format($data[$i]['credit_amount'], 2);} $i++;}?></td>
                    <!-- <td id="noborders" style="border-bottom: 1px solid #b0b0b0 !important;"></td>
                    <td id="noborders" style="border-bottom: 1px solid #b0b0b0 !important;"></td>
                    <td id="noborders" style="border-bottom: 1px solid #b0b0b0 !important;"></td> -->
                    <td id="noborders" colspan="4" class = "text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">মোট বিলঃ</td>
                    <td class = "text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">
                      <?php echo number_format($group_wise_total_taka, 2);  ?>
                    </td>
                    <!-- <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">
                      <?php //echo number_format($total_debit_due, 2); ?>
                      <?php //echo number_format($group_wise_total_bill, 2); ?>
                    </td> -->
                    <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">
                      <?php
                        // echo number_format($group_wise_total_pay, 2);
                      ?>
                    </td>
                    <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">
                      <?php
                        // echo number_format($group_wise_total_due, 2);
                      ?>
                    </td>
                  </tr>
                </tbody>
              <?php  

              }
            }


            while ($i < $size) {
              ?>
              <tbody>
                <tr>
                  <td class="col-3" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></td>
                  <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;"><?php if($i<$size){echo $data[$i]['credit_amount']; $i++;}?></td>
                  <td style="border: 1px solid #ddd !important;"></td>
                  <td style="border: 1px solid #ddd !important;"></td>
                  <td style="border: 1px solid #ddd !important;"></td>
                  <td style="border: 1px solid #ddd !important;"></td>
                  <td style="border: 1px solid #ddd !important;"></td>
                  <td style="border: 1px solid #ddd !important;"></td>
                  <td style="border: 1px solid #ddd !important;"></td>
                  <!-- <td style="border: 1px solid #ddd !important;"></td> -->
                </tr>
              </tbody>
            <?php
            }
            ?>

            


        <?php
            // $query = "SELECT due_credit_amount, due_debit_amount, due_debit_date FROM due WHERE project_name_id = '$project_name_id'";
            // $show = $db->select($query);
            // if ($show) {
            //     while ($rows = $show->fetch_assoc()) {
                  ?>
                  <tbody>
                    <!-- kallol added row -->
                    <tr>
                      <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">জমাঃ-</td>
                      <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;"><?php echo number_format($credit_total, 2); ?></td>
                      <td id="noborders"></td>
                      <td id="noborders"></td>
                      <td id="noborders"></td>       
                      <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">খরচঃ-</td>
                      <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">
                        <?php //echo number_format($total, 2); ?>                  
                        <?php echo number_format($all_total_bill, 2); ?>                  
                      </td>
                      <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">পাওনাঃ-</td>
                      <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">
                        <?php
                          // $total_p_amount = $all_group_pay + $pabe_amount;
                          // echo number_format($total_p_amount, 2);
                          echo number_format($all_group_due, 2);
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">পূরব‌ের জে‌রঃ-</td>
                      <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;"><?php echo number_format($total_due_credit, 2); ?></td>
                      <td id="borderless-cell"></td>
                      <td id="noborders"></td>
                      <td id="noborders"></td>
                      <!-- <td id="noborders"></td> -->
                        <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">পূরব‌ের পাওনাঃ-</td>
                        <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;"><?php echo number_format($total_due_debit, 2); ?></td>
                        <td id="noborders"></td>
                        <td id="noborders"></td>
                      </tr>
                    </tbody>
                    <?php
            //     }
            // }
        ?>    
          <tbody id="noborders">
              <tr>
                <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">ম‌োট জমাঃ-</td>
                <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;"><?php echo number_format($remain_credit, 2); ?></td>
                <td id="noborders"></td>
              <td id="noborders"></td>
              <td id="noborders"></td>
                <!-- <td id="noborders"></td> -->
                <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">মোট খরচঃ-</td>
                <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">
                  <?php
                    // $remain_debit  = $total + $total_due_debit - $total_p_amount;
                    // echo number_format($remain_debit, 2);

                    $remain_debit = $all_total_bill + $total_due_debit + $total_p_amount - $all_group_due;
                    echo number_format($remain_debit, 2);
                  ?>            
              </td>
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
                <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;"><!-- Total Remain --> জের / পাওনাঃ-</td>
                <td class="text-right" style="border: 1px solid #ddd !important; text-align: right; padding: 4px;">
                  <?php
                      $result = $remain_credit - $remain_debit;
                      echo number_format($result, 2);
                  ?>
                </td>
                <td id="noborders"></td>
                <td id="noborders"></td>
              </tr>
          </tbody>

		<?php
} else{
	//*************************************************************************************
	//Date Pele ja hobe *******************************************************************
	//*************************************************************************************
	$optionDate = date('Y-m-d', strtotime($_GET['date']));
	// <!-- total calculation section -->

	//total calculation section  
  $sql_qry="SELECT SUM(credit_amount) AS total_credit FROM vaucher_credit WHERE credit_date = '$optionDate' AND project_name_id = '$project_name_id'";

  $credit = $db->select($sql_qry);
  while($credit_record = $credit->fetch_array()){
    $credit_total = $credit_record['total_credit'];
  }


  $sql_qry_due_credit="SELECT SUM(due_credit_amount) AS total_due_credit FROM due WHERE due_debit_date = '$optionDate' AND project_name_id = '$project_name_id'";
  $due_credit = $db->select($sql_qry_due_credit);
  while($due_credits = $due_credit->fetch_array()){
    $total_due_credit = $due_credits['total_due_credit'];
  }

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

          $data[$size]['credit_name']= $row['credit_name']; 
          $data[$size]['credit_amount']= $row['credit_amount']; 
          $size++;
      }
  }

  
  $sqls="SELECT * FROM nij_paonadar WHERE nij_paona_date = '$optionDate' AND project_name_id = '$project_name_id'";
  $p_reads = $db->select($sqls);
  $datas=array();
  $sizes=0;
  if($p_reads){
      while ($rows= $p_reads->fetch_assoc()) {
          $datas[$sizes]['id']= $rows['id'];
          $datas[$sizes]['name']= $rows['name'];
          $datas[$sizes]['description']= $rows['description'];
          $datas[$sizes]['amount']= $rows['amount'];
          $sizes++;
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
        <th class="active width_200px" style="font-size: 13px; border: 1px solid #ddd; padding: 4px; text-align: center;">কোম্পানির পাওনার নামঃ </th>
        <th class="active text-right width_5px" style="font-size: 13px; border: 1px solid #ddd; padding: 4px; text-align: center;">টাকাঃ</th>
        <th id="borderless-cell"></th>
        <th id="borderless-cell"></th>
        <th id="borderless-cell"></th>
        <th id="borderless-cell"></th>
        <!-- <th id="borderless-cell"></th> -->
        <th class="active width_100px" style="font-size: 13px; border: 1px solid #ddd; padding: 4px; text-align: center;">পাওনার নামঃ </th>
        <th class="active" style="font-size: 13px; border: 1px solid #ddd; padding: 4px; text-align: center;">বিবরণ</th>
        <th class="active text-right" style="font-size: 13px; border: 1px solid #ddd; padding: 4px; text-align: ri;">টাকাঃ</th>
    </tr>
</thead>
<?php  

    $j = 0;
    // $paona_query = "SELECT * FROM jara_pabe WHERE project_name_id = '$project_name_id'";
    $paona_query = "SELECT * FROM jara_pabe WHERE pabe_date = '$optionDate' AND project_name_id = '$project_name_id'";
    $paona_read = $db->select($paona_query);
    if ($paona_read) {
        while ($paona_row = $paona_read->fetch_assoc()) {
            ?>
            <tbody id="noborders">
                <tr class="d-flex">
                    <td class="col-3" style="border: 1px solid #ddd; padding: 4px;"><span style="max-width:200px; word-wrap: anywhere;"><?php if($j<$sizes){echo $datas[$j]['name']; }?></span></td>
                    <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php if($j<$sizes){echo number_format($datas[$j]['amount'], 0); $j++; }?></td>
                    <td id="noborders"><?php //if($j<$sizes){echo $datas[$j]['description']; $j++; }?></td>
                    <td id="noborders"></td>
                    <td id="noborders"></td>
                    <td id="noborders"></td>
                    <!-- <td id="noborders"></td> -->
                    <td style="border: 1px solid #ddd; padding: 4px;"><?php echo $paona_row['pabe_name'] ?></td>
                    <td style="border: 1px solid #ddd; padding: 4px;"><?php echo $paona_row['pabe_description'] ?></td>
                    <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo number_format($paona_row['pabe_amount'], 0) ?></td>
                </tr>
            </tbody>
            <?php  
        }
    }



    while ($j < $sizes) {
      ?>
      <tbody id="noborders">
          <tr class="d-flex">
              <td class="col-3" style="border: 1px solid #ddd; padding: 4px;"><span style="max-width:200px; word-wrap: anywhere;"><?php if($j<$sizes){echo $datas[$j]['name']; }?></span></td>
              <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php if($j<$sizes){echo number_format($datas[$j]['amount'], 0); $j++; }?></td>
              <td id="noborders"><?php //if($j<$sizes){echo $datas[$j]['description']; $j++; }?></td>
              <td id="noborders" style="border: 1px solid #ddd;"></td>
              <td id="noborders" style="border: 1px solid #ddd;"></td>
              <td id="noborders" style="border: 1px solid #ddd;"></td>
              <td id="noborders" style="border: 1px solid #ddd;"></td>
              <td style="border: 1px solid #ddd;"></td>
              <td style="border: 1px solid #ddd;"></td>
              <!-- <td style="border: 1px solid #ddd;"></td> -->
          </tr>
      </tbody>
      <?php
    }
?>
    <thead>
        <tr class="active">
            <th class="col-3" style="border: 1px solid #ddd; padding: 4px; text-align: center;">জমা মারফোত নামঃ
            </th>
            <th class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: center;">জমাঃ</th>
            <th class="width_200px" style="border: 1px solid #ddd; padding: 4px; text-align: center;">খরচের মারফোত নামঃ</th>
            <th class="width_200px" style="border: 1px solid #ddd; padding: 4px; text-align: center;">বিবরণ নামঃ</th>
            <th class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: center;">দরঃ</th>
            <th class="text-right width_100px" style="border: 1px solid #ddd; padding: 4px; text-align: center;">জনঃ</th>
            <th class="text-right width_100px" style="border: 1px solid #ddd; padding: 4px; text-align: center;">মোট টাকাঃ</th>
            <!-- <th class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: center;">নগদ পরি‌ষদঃ</th> -->
            <th class="text-right width_5px" style="border: 1px solid #ddd; padding: 4px; text-align: center;">জমাঃ</th>
            <th class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: center;">জেরঃ </th>
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
                        <td class="col-3" style="border: 1px solid #ddd; text-align: center; padding: 4px;"><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                        <td class="text-right" style="border: 1px solid #ddd; text-align: center; padding: 4px;"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
                        <td class="newGroup" style="border: 1px solid #ddd; text-align: center; font-weight: bold; padding: 4px; background-color: #bdbdbd;"><?php echo $row['group_name']; ?></td>
                        <td class="newGroup" style="border: 1px solid #ddd; text-align: center; font-weight: bold; padding: 4px; background-color: #bdbdbd;"><?php echo $row['group_description']; ?></td>
                        <td class="newGroup text-right" style="border: 1px solid #ddd; text-align: center; font-weight: bold; padding: 4px; background-color: #bdbdbd;"><?php echo $row['taka']; ?></td>
                        <td class="newGroup text-right" style="border: 1px solid #ddd; text-align: center; font-weight: bold; padding: 4px; background-color: #bdbdbd;"><?php echo $row['pices']; ?></td>
                        <td class="newGroup text-right" style="border: 1px solid #ddd; text-align: center; font-weight: bold; padding: 4px; background-color: #bdbdbd;"><?php echo $row['total_taka']; ?></td>
                        <!-- <td class="newGroup text-right" style="border: 1px solid #ddd; text-align: center; font-weight: bold; padding: 4px;"><?php //echo $row['total_bill']; ?></td> -->
                        <td class="newGroup text-right" style="border: 1px solid #ddd; text-align: center; font-weight: bold; padding: 4px; background-color: #bdbdbd;"><?php echo $row['pay']; ?></td>
                        <td class="newGroup text-right" style="border: 1px solid #ddd; text-align: center; font-weight: bold; padding: 4px; background-color: #bdbdbd;"><?php echo $row['due']; ?></td>
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
                          <td class="" style="border: 1px solid #ddd; padding: 4px;">
                            <span style="max-width:200px; word-wrap: anywhere;">
                              <?php if($i<$size){ echo $data[$i]['credit_name']; }?>
                            </span>
                          </td>                                        
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px;">
                            <?php if($i<$size){if($data[$i]['credit_amount'] !== ''){ echo number_format($data[$i]['credit_amount'], 2);} $i++;} ?>
                          </td>                          
                          <td style="border: 1px solid #ddd; padding: 4px;"><?php echo $group_name; ?></td>
                          <td style="border: 1px solid #ddd; padding: 4px;"><?php echo $group_description; ?></td>
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">
                            <?php echo number_format($group_taka, 2); ?>
                          </td>
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo $group_pices; ?></td>
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">
                            <?php echo number_format($group_total_taka, 2); ?>
                          </td>
                          <!-- <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">
                            <?php //echo number_format($group_total_bill, 2); ?>
                          </td> -->
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo number_format($group_pay, 2); ?></td>
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo number_format($group_due, 2); ?></td>
                        </tr>
                    </tbody>
                    <?php
                }
              ?>
                    <tbody id="borderless-cell">
                        <tr class="d-flex">
                          <td class="col-3" style="border: 1px solid #ddd; padding: 4px;"><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
                          <!-- <td id="noborders"></td>
                          <td id="noborders"></td>
                          <td id="noborders"></td> -->
                          <td class="text-right " colspan="4" style="border: 1px solid #ddd; padding: 4px; text-align: right;">মোট বিলঃ</td>
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo number_format($group_wise_total_taka, 2); ?></td>
                          <!-- <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php //echo number_format($group_wise_total_bill, 2); ?></td> -->
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">
                            <?php
                              // echo number_format($group_wise_total_pay, 2);
                            ?>
                          </td>
                          <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php
                            //echo number_format($group_wise_total_due, 2); ?>
                          </td>
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
              <td class="col-3" style="border: 1px solid #ddd; padding: 4px;"><span style="max-width:200px; word-wrap: anywhere;"><?php if($i<$size){echo $data[$i]['credit_name']; }?></span></td>
              <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php if($i<$size){echo number_format($data[$i]['credit_amount'], 2); $i++;}?></td>
              <td style="border: 1px solid #ddd;"></td>
              <td style="border: 1px solid #ddd;"></td>
              <td style="border: 1px solid #ddd;"></td>
              <td style="border: 1px solid #ddd;"></td>
              <td style="border: 1px solid #ddd;"></td>
              <td style="border: 1px solid #ddd;"></td>
              <td style="border: 1px solid #ddd;"></td>
              <!-- <td style="border: 1px solid #ddd;"></td> -->
          </tr>
      </tbody>
      <?php
    }
  ?>

      


<?php 

    // $query = "SELECT due_credit_amount, due_debit_amount, due_debit_date FROM due WHERE project_name_id = '$project_name_id'";
    // $show = $db->select($query);
    // if ($show){
    //     while ($rows = $show->fetch_assoc()){
          ?>
            <tbody>      
                <!-- kallol added row -->
                <tr>
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">জমাঃ-</td>
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo number_format($credit_total, 2) ?></td>
                  <td id="noborders"></td>
                  <td id="noborders"></td>
                  <td id="noborders"></td>
                  <!-- <td id="noborders"></td>         -->
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">খরচঃ-</td>
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo number_format($all_total_bill, 2) ?></td>
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">পাওনাঃ-</td>
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">
                    <?php 
                      // if(!empty($all_debit_due) && !empty($pabe_amount)){
                      //   echo number_format($total_p_amount=$all_debit_due+$pabe_amount, 2); 
                      // }else if(!empty($all_debit_due)){
                      //   echo number_format($total_p_amount=$all_debit_due, 2); 
                      // }else if(!empty($pabe_amount)){
                      //   echo number_format($total_p_amount=$pabe_amount, 2); 
                      // } else {
                      //   echo '0.00';
                      // }
                      echo number_format($all_group_due, 2);
                    ?>
                  </td>
                </tr>
                <tr>
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">পূরব‌ের জে‌রঃ-</td>
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo number_format($total_due_credit, 2); ?></td>
                  <td id="borderless-cell"></td>
                  <td id="noborders"></td>
                  <td id="noborders"></td>
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">পূরব‌ের পাওনাঃ-</td>
                  <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo number_format($total_due_debit, 2); ?></td>
                  <td id="noborders"></td>
                  <td id="noborders"></td>
                </tr>
            </tbody>
          <?php
    //     }
    // }

?>  
    <tbody id="noborders">
        <tr>
            <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">ম‌োট জমাঃ-</td>
            <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php echo number_format($remain_credit, 2); ?></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
            <!-- <td id="noborders"></td> -->
            <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;">মোট খরচঃ-</td>
            <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php 
                $remain_debit = $all_total_bill + $total_due_debit + $total_p_amount - $all_group_due;
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
            <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><!-- Total Remain --> জের / পাওনাঃ-</td>
            <td class="text-right" style="border: 1px solid #ddd; padding: 4px; text-align: right;"><?php 
                $result = $remain_credit - $remain_debit;
                echo number_format($result, 2); ?></td>
            <td id="noborders"></td>
            <td id="noborders"></td>
        </tr>
    </tbody>



	<?php
	}
	?>
</table>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script type="text/javascript">
	
	function download(){
		// var doc = new jsPDF();          
		// var elementHandler = {
		//   '#ignorePDF': function (element, renderer) {
		//     return true;
		//   }
		// };
		// var source = window.document.getElementById("container_table");
		// doc.fromHTML(
		//     source,
		//     15,
		//     15,
		//     {
		//       'width': 180,
		//       'elementHandlers': elementHandler
		//     });

		// // doc.save("daily-work.pdf");
		// doc.output("dataurlnewwindow");







		var pdf = new jsPDF('p', 'pt', 'letter');
      source = $('#container_table')[0];

	    specialElementHandlers = {
	        '#bypassme': function (element, renderer) {
	            return true
	        }
	    };
	    margins = {
	        top: 80,
	        bottom: 60,
	        left: 40,
	        width: 522
	    };
	    pdf.fromHTML(
  	    source, // HTML string or DOM elem ref.
  	    margins.left, // x coord
  	    margins.top, { // y coord
  	        'width': margins.width, // max width of content on PDF
  	        // 'elementHandlers': specialElementHandlers
  	    },

  	    function (dispose) {
  	        pdf.save('Test.pdf');
  	    }, margins);		
	}
</script>
</body>
</html>