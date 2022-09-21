<?php 
  session_start();
  $search_date = $_POST['search_date'];
  // $debit_groupid = $_POST['groupid'];  
  $khoros_marfot_name = $_POST['khoros_marfot_name'];  
  // var_dump($debit_groupid);
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();

  $project_name_id = $_SESSION['project_name_id'];
  $edit_data_permission   = $_SESSION['edit_data'];
  $delete_data_permission = $_SESSION['delete_data'];

    $all_total_taka = 0;
    $all_total_bill = 0;
    $all_group_pay = 0;
    $all_group_due = 0;

  if($search_date == 'alldates'){
      // $query = "SELECT * FROM debit_group WHERE id = '$debit_groupid' AND project_name_id = '$project_name_id'";
      // $read = $db->select($query);
      // while ($row = $read->fetch_assoc()) {        
          // $debit_group_id = $row['id'];

          $group_wise_total_taka = 0;
          $group_wise_total_bill = 0;
          $group_wise_total_pay = 0;
          $group_wise_total_due = 0;
          $qry = "SELECT * FROM debit_group_data WHERE group_name = '$khoros_marfot_name' AND project_name_id = '$project_name_id'";
          $reads = $db->select($qry);
          if (mysqli_num_rows($reads) > 0 ){
              ?>
              <table id="mytable" class="table table-bordered" style="font-size: 12px;">
                  <!-- <thead>
                    <tr>
                        <td class="success text-center"><?php //echo $row['group_name']; ?></td>
                        <td class="success text-center"><?php //echo $row['group_description']; ?></td>
                        <td class="success text-center"><?php //echo $row['taka']; ?></td>
                        <td class="success text-center"><?php //echo $row['pices']; ?></td>
                        <td class="success text-center"><?php //echo $row['total_taka']; ?></td>
                        <td class="success text-center"><?php //echo $row['pay']; ?></td>
                        <td class="success text-center"><?php //echo $row['due']; ?></td>
                        //<td style="width: 68px;">
                          //<a href="add_single_group_data.php?add_id=<?php //echo $row['id']; ?>" class="btn btn-success">Data</a>
                        //</td>
                    </tr>
                  </thead> -->
                  <thead>
                      <tr class="d-flex">
                          <td class="newGroup text-center" width="62px">তারিখ</td>
                          <td class="newGroup text-center">মারফোত নাম</td>
                          <td class="newGroup text-center">বিবরণ নাম</td>
                          <td class="newGroup text-center">দর</td>
                          <td class="newGroup text-center">জন</td>
                          <td class="newGroup text-center">মোট টাকা</td>
                          <td class="newGroup text-center">জমা</td>
                          <td class="newGroup text-center">জের</td>
                      </tr>
                  </thead>
                  <tbody>
                      <?php                
                        while ($rows = $reads->fetch_assoc()) {                
                            $group_name = $rows['group_name'];
                            $group_description = $rows['group_description'];
                            if($rows['group_taka'] == ''){$group_taka = 0;} else {$group_taka = $rows['group_taka'];}
                            if($rows['group_pices'] == ''){$group_pices = 0;} else {$group_pices = $rows['group_pices'];}
                            if($rows['group_total_taka'] == ''){$group_total_taka = 0;} else {$group_total_taka = $rows['group_total_taka'];}
                            if($rows['group_total_bill'] == ''){$group_total_bill = 0;} else {$group_total_bill = $rows['group_total_bill'];}
                            if($rows['group_pay'] == ''){$group_pay = 0;} else {$group_pay = $rows['group_pay'];}
                            if($rows['group_due'] == ''){$group_due = 0;} else {$group_due = $rows['group_due'];}
                            if($rows['entry_date'] == '0000-00-00'){$entry_date = '';} else {$entry_date = $rows['entry_date'];}

                            $all_total_taka += $group_total_taka;
                            $group_wise_total_taka += $group_total_taka;

                            $all_total_bill += $group_total_bill;
                            $group_wise_total_bill += $group_total_bill;

                            $all_group_pay += $group_pay;
                            $group_wise_total_pay += $group_pay;

                            $all_group_due += $group_due;
                            $group_wise_total_due += $group_due;
                            ?> 
                            
                              <tr>
                                <td><?php if($entry_date !=''){ echo date('d/m/Y', strtotime($entry_date));}; ?></td>
                                <td><?php echo $group_name; ?></td>
                                <td><?php echo $group_description; ?></td>
                                <td class="text-right"><?php echo number_format($group_taka, 2); ?></td>
                                <td class="text-right"><?php echo $group_pices; ?></td>
                                <td class="text-right"><?php echo number_format($group_total_taka, 2); ?></td>
                                <td class="text-right"><?php echo number_format($group_pay, 2); ?></td>
                                <td class="text-right"><?php echo number_format($group_due, 2); ?></td>
                                <!-- <td style="border-color: transparent !important;"></td> -->
                              </tr>
                            
                            <?php 
                        }
                      ?>
                  </tbody>
                  <tfoot>
                      <tr>                  
                        <td class="text-right" colspan="5">মোট বিলঃ</td>
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
                        <!-- <td style="border-color: transparent !important;"></td> -->
                      </tr>
                  </tfoot>
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
      // }

      
  } else {
      // $query = "SELECT * FROM debit_group WHERE id = '$debit_groupid' AND project_name_id = '$project_name_id'";
      // $read = $db->select($query);
      // while ($row = $read->fetch_assoc()) {        
          // $debit_group_id = $row['id'];

          $group_wise_total_taka = 0;
          $group_wise_total_bill = 0;
          $group_wise_total_pay = 0;
          $group_wise_total_due = 0;
          $qry = "SELECT * FROM debit_group_data WHERE group_name = '$khoros_marfot_name' AND entry_date ='$search_date' AND project_name_id = '$project_name_id'";
          $reads = $db->select($qry);
          if (mysqli_num_rows($reads) > 0 ){
              ?>
              <table id="mytable" class="table table-bordered" style="font-size: 12px;">
                  <!-- <thead>
                    <tr>
                        <td class="success text-center"><?php //echo $row['group_name']; ?></td>
                        <td class="success text-center"><?php //echo $row['group_description']; ?></td>
                        <td class="success text-center"><?php //echo $row['taka']; ?></td>
                        <td class="success text-center"><?php //echo $row['pices']; ?></td>
                        <td class="success text-center"><?php //echo $row['total_taka']; ?></td>
                        <td class="success text-center"><?php //echo $row['pay']; ?></td>
                        <td class="success text-center"><?php //echo $row['due']; ?></td>
                        //<td style="width: 68px;">
                          //<a href="add_single_group_data.php?add_id=<?php //echo $row['id']; ?>" class="btn btn-success">Data</a>
                        //</td>
                    </tr>
                  </thead> -->
                  <thead>
                      <tr class="d-flex">
                          <td class="newGroup text-center" width="62px">তারিখ</td>
                          <td class="newGroup text-center">মারফোত নাম</td>
                          <td class="newGroup text-center">বিবরণ নাম</td>
                          <td class="newGroup text-center">দর</td>
                          <td class="newGroup text-center">জন</td>
                          <td class="newGroup text-center">মোট টাকা</td>
                          <td class="newGroup text-center">জমা</td>
                          <td class="newGroup text-center">জের</td>
                      </tr>
                  </thead>
                  <tbody>
                  <?php                
                    while ($rows = $reads->fetch_assoc()) {                
                        $group_name = $rows['group_name'];
                        $group_description = $rows['group_description'];
                        if($rows['group_taka'] == ''){$group_taka = 0;} else {$group_taka = $rows['group_taka'];}
                        if($rows['group_pices'] == ''){$group_pices = 0;} else {$group_pices = $rows['group_pices'];}
                        if($rows['group_total_taka'] == ''){$group_total_taka = 0;} else {$group_total_taka = $rows['group_total_taka'];}
                        if($rows['group_total_bill'] == ''){$group_total_bill = 0;} else {$group_total_bill = $rows['group_total_bill'];}
                        if($rows['group_pay'] == ''){$group_pay = 0;} else {$group_pay = $rows['group_pay'];}
                        if($rows['group_due'] == ''){$group_due = 0;} else {$group_due = $rows['group_due'];}
                        if($rows['entry_date'] == '0000-00-00'){$entry_date = '';} else {$entry_date = $rows['entry_date'];}

                        $all_total_taka += $group_total_taka;
                        $group_wise_total_taka += $group_total_taka;

                        $all_total_bill += $group_total_bill;
                        $group_wise_total_bill += $group_total_bill;

                        $all_group_pay += $group_pay;
                        $group_wise_total_pay += $group_pay;

                        $all_group_due += $group_due;
                        $group_wise_total_due += $group_due;
                        ?> 
                        
                        <tr>
                          <td><?php if($entry_date !=''){ echo date('d/m/Y', strtotime($entry_date));}; ?></td>
                          <td><?php echo $group_name; ?></td>
                          <td><?php echo $group_description; ?></td>
                          <td class="text-right"><?php echo number_format($group_taka, 2); ?></td>
                          <td class="text-right"><?php echo $group_pices; ?></td>
                          <td class="text-right"><?php echo number_format($group_total_taka, 2); ?></td>
                          <td class="text-right"><?php echo number_format($group_pay, 2); ?></td>
                          <td class="text-right"><?php echo number_format($group_due, 2); ?></td>
                          <!-- <td style="border-color: transparent !important;"></td> -->
                        </tr>

                        <?php 
                    }
                    ?>
                  </tbody>
                  <tfoot>
                      <tr>                  
                        <td class="text-right" colspan="5">মোট বিলঃ</td>
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
                        <!-- <td style="border-color: transparent !important;"></td> -->
                      </tr>
                  </tfoot>
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
  // }
?>



    