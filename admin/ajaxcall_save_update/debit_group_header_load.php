<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $group_id = $_POST['group_id'];



?>
<form action="" method="POST" onsubmit="return validation()" id="inputHeaderForm">
    <table class="table table-bordered table-condensed" id="dynamic_field">
        <thead>
            <tr>
                <th class="text-center" width="110px">তারিখ</th>
                <th class="text-center">মারফোত নামঃ</th>
                <th class="text-center">বিবরণ নামঃ</th>
                <th class="text-center">দর</th>
                <th class="text-center">জন</th>
                <th class="text-center">মোট টাকা</th>
                <!-- <th class="text-center">নগদ পরি‌ষদ</th> -->
                <th class="text-center">জমা</th>
                <th class="text-center">জের</th>
            </tr>
        </thead>          
        <?php
        $query = "SELECT * FROM debit_group WHERE id = $group_id";
        $show = $db->select($query);
        while($data = $show->fetch_assoc()) {
            ?>
            <tbody>
                <tr>
                    <td><input type="text" name="group_date" class="form-control" id="group_date" placeholder="dd/mm/yyyy" value = "<?php if( $data['group_date'] == '0000-00-00'){} else {echo date("d/m/Y", strtotime($data['group_date']));} ?>"/></td>
                    <td><input type="text" name="group_name" class="form-control" size="100" value="<?php echo $data['group_name']; ?>" id="group_name"/></td>
                    <td><input type="text" name="group_description" class="form-control" size="100" value="<?php echo $data['group_description']; ?>" id="group_description"/></td>
                    <td><input type="text" name="taka" class="form-control" size="40" value="<?php echo $data['taka']; ?>" id="taka"/></td>
                    <td><input type="text" name="pices" class="form-control" size="40" value="<?php echo $data['pices']; ?>" id="pices"/></td>
                    <td><input type="text" name="total_taka" class="form-control" value="<?php echo $data['total_taka']; ?>" id="total_taka"/></td>
                    <td><input type="text" name="pay" class="form-control" value="<?php echo $data['pay']; ?>" id="pay"/></td>
                    <td><input type="text" name="due" class="form-control" value="<?php echo $data['due']; ?>" id="due"/></td>
                </tr>
            </tbody>
            <?php
        } ?>
    </table>
    <div style="height: 35px; text-align: right;">
        <input type="button" class="btn btn-primary" value="Update" style="width: 200px; margin-right: 20px;" group_id="<?php echo $group_id; ?>" onclick="update_row_header(this)">
        <input type="button" class="btn btn-danger" onclick="$('#edit_data_header').hide()" value="Cancel" style="width: 200px;">
    </div>
</form> 