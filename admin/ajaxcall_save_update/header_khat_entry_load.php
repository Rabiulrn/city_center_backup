<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $edit_id   = $_POST['edit_id'];
    $dataset_id = $_POST['dataset_id'];

?>

<form action="" method="POST">
          <table class="table table-bordered table-condensed">
              <thead>
                  <tr>
                  <?php
                      $group_sql = "SELECT * FROM debit_group WHERE id = '$dataset_id' AND project_name_id = '$project_name_id'";
                      $group = $db->select($group_sql);
                      while($gdata = $group->fetch_assoc()) {
                          echo '<th class="text-center" width="110px">তারিখঃ</th>';
                          echo '<th class="text-center">'.$gdata['group_name'].'</th>';
                          echo '<th class="text-center">'.$gdata['group_description'].'</th>';
                          echo '<th class="text-center">'.$gdata['taka'].'</th>';
                          echo '<th class="text-center">'.$gdata['pices'].'</th>';
                          echo '<th class="text-center">'.$gdata['total_taka'].'</th>';
                          // echo '<th class="text-center">'.$gdata['total_bill'].'</th>';
                          echo '<th class="text-center">'.$gdata['pay'].'</th>';
                          echo '<th class="text-center">'.$gdata['due'].'</th>';
                      }
                  ?>
                  
                      
                      <!-- মারফোত নামঃ
                      <th class="text-center">বিবরণ নামঃ</th>
                      <th class="text-center">দর</th>
                      <th class="text-center">জন</th>
                      <th class="text-center">মোট টাকাঃ</th>
                      <th class="text-center">নগদ পরি‌ষদ</th>
                      <th class="text-center">জমা</th>
                      <th class="text-center">জের</th> -->
                  </tr>
              </thead>
              <?php
                  $query = "SELECT * FROM debit_group_data WHERE id = '$edit_id' AND project_name_id = '$project_name_id'";
                  $show = $db->select($query);
                  while($data = $show->fetch_assoc()) {
                    ?>
                      <tbody>
                        <tr>
                          <td><input type="text" name="entry_date" class="form-control" id="entry_date" placeholder="dd/mm/yyyy" value = "<?php if( $data['entry_date'] == '0000-00-00'){} else {echo date("d/m/Y", strtotime($data['entry_date']));} ?>"/></td>
                          <td><input type="text" name="group_name" class="form-control" size="100" value="<?php echo $data['group_name']; ?>" id="group_name"/></td>
                          <td><input type="text" name="group_description" class="form-control" size="100" value="<?php echo $data['group_description']; ?>" id="group_description"/></td>
                          <td><input type="text" name="group_taka" class="form-control calc1" size="40" value="<?php echo $data['group_taka']; ?>" id="group_taka"/></td>
                          <td><input type="text" name="group_pices" class="form-control calc1" size="40" value="<?php echo $data['group_pices']; ?>" id="group_pices"/></td>
                          <td><input type="text" name="group_total_taka" class="form-control" value="<?php echo $data['group_total_taka']; ?>" id="group_total_taka"/></td>
                          <td><input type="text" name="group_pay" class="form-control payCalc1" value="<?php echo $data['group_pay']; ?>" id="group_pay"/></td>
                          <td><input type="text" name="group_due" class="form-control" value="<?php echo $data['group_due']; ?>" id="group_due"/></td>
                        </tr>
                      </tbody>
                    <?php 
                    } 
                  ?>
          </table>          
          <div style="height: 35px; text-align: right;">
                <input type="button" class="btn btn-primary" value="Update" style="width: 200px; margin-right: 20px;" edit_id ="<?php echo $edit_id; ?>" dataset_id = "<?php echo $dataset_id; ?>" onclick="update_row(this)">
                <input type="button" class="btn btn-danger" onclick="$('#edit_data').hide()" value="Cancel" style="width: 200px; ">
          </div>
          <!-- <div class="form-group">
              <h3 class="text-center text-success" id='sucMsg'></h3>
          </div> -->
    </form>