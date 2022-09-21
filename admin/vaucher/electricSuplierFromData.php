<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$_SESSION['pageName'] = 'employee';

$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];
$sucMsg = "";


// $employee_date       = $_POST["employee_date"];
// $employee_id         = $_POST["employee_id"];
// $month_name          = $_POST["month_name"];
// $naster_bill         = $_POST["naster_bill"];
// $khaber_bill         = $_POST["khaber_bill"];
// $diner_beton         = $_POST["diner_beton"];
// $bonus               = $_POST["bonus"];
// $nea_joma            = $_POST["nea_joma"];


// $number = count($naster_bill);
// if ($number > 0) {
//     for ($i = 0; $i < $number; $i++) {


//         $query1 = "INSERT INTO employee_daily_hisab(employee_date, employee_id,month_name,naster_bill,khaber_bill,diner_beton,bonus,nea_joma, project_name_id)
//       VALUES ('$employee_date[$i]', '$employee_id[$i]','$month_name','$naster_bill[$i]','$khaber_bill[$i]','$diner_beton[$i]','$bonus[$i]','$nea_joma[$i]','$project_name_id')";

//         $result = $db->insert($query1);
//     }

//     if ($result) {
//         echo json_encode($result);
//     } else {
//         echo json_encode(array("statusCode" => 201));
//     }
// }





if ($_POST["action"] == "suplier_insert") {
    $suplier_name                  = $_POST['suplier_name'];
    $suplier_Protisthan_name       = $_POST['suplier_Protisthan_name'];
    $suplier_Protisthan_slogan     = $_POST["suplier_Protisthan_slogan"];
    $suplier_mobile_num            = $_POST["suplier_mobile_num"];
    $suplier_address               = $_POST["suplier_address"];
 

    $query = "INSERT INTO electric_suplier_create (suplier_name, suplier_Protisthan_name,suplier_Protisthan_slogan,suplier_mobile_num,suplier_address, project_name_id)
     VALUES ('$suplier_name', '$suplier_Protisthan_name','$suplier_Protisthan_slogan','$suplier_mobile_num','$suplier_address','$project_name_id')";
    $result = $db->insert($query);


    if ($result) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}

if ($_POST["action"] == "suplier_details") {

    $query_detail = "SELECT * FROM electric_suplier_create WHERE  project_name_id = '$project_name_id' ";

    $data = $db->select($query_detail);
    if ($data) {
        $i = 1;
        while ($rows = $data->fetch_assoc()) { ?>
            <tr>
                <td align="center"> <?php echo  $i++; ?></td>
                <td align="center"> <?php echo  $rows['suplier_name']; ?> </td>
                <td align="center"> <?php echo  $rows['suplier_Protisthan_name']; ?></td>
                <td align="center"> <?php echo  $rows['suplier_Protisthan_slogan']; ?></td>
                <td align="center"> <?php echo  $rows['suplier_mobile_num']; ?></td>
                <td align="center"> <?php echo  $rows['suplier_address']; ?></td>
                <!-- <td align="center"><button class="btn btn-primary">View</button></td> -->
                <td align="center"><button class="btn btn-danger" id="<?php echo  $rows['id']; ?>" data_row_id="<?php echo $rows['id']; ?>" onclick="delete_row(this)">Delete</button></td>
                <td align="center"><button class="btn btn-success edit_data" id="<?php echo  $rows['id']; ?>" data-id="<?php echo  $rows['id']; ?>">Edit</button></td>
            </tr>


        <?php

        }
    }
}

// Mistree edit data
if ($_POST["action"] == "edit_single") {
    $query1 = "SELECT * FROM electric_suplier_create WHERE id ='" . $_POST["id"] . "' ";

    $statement1 = $db->select($query1);
    //$result = $statement->fetch_assoc();
    while ($row = $statement1->fetch_assoc()) {
        $data['id']                         = $row['id'];
        $data['suplier_name']               = $row['suplier_name'];
        $data['suplier_Protisthan_name']    = $row['suplier_Protisthan_name'];
        $data['suplier_Protisthan_slogan']  = $row['suplier_Protisthan_slogan'];
        $data['suplier_mobile_num']         = $row['suplier_mobile_num'];
        $data['suplier_address']            = $row['suplier_address'];
    }
    echo json_encode($data);
}


if ($_POST["action"] == "single_update") {

    $id                            = $_POST['id'];
    $suplier_name                  = $_POST['suplier_name'];
    $suplier_Protisthan_name       = $_POST['suplier_Protisthan_name'];
    $suplier_Protisthan_slogan     = $_POST["suplier_Protisthan_slogan"];
    $suplier_mobile_num            = $_POST["suplier_mobile_num"];
    $suplier_address               = $_POST["suplier_address"];

    $mesg = "";

    $sql = "UPDATE electric_suplier_create SET  suplier_name = '$suplier_name', suplier_Protisthan_name = '$suplier_Protisthan_name', suplier_Protisthan_slogan = '$suplier_Protisthan_slogan',suplier_mobile_num = '$suplier_mobile_num', suplier_address='$suplier_address', project_name_id='$project_name_id' WHERE id = '$id' ";

    $update_result = $db->update($sql);
    if ($update_result) {
        echo "Data update successfully";
        // echo json_encode( $update_result ); 
    } else {
        echo "Data update Error";
    }
}

if (isset($_POST['data_delete_id'])) {
    $id = $_POST['data_delete_id'];

    $sql = "DELETE FROM electric_suplier_create WHERE id = '$id'";
    $result = $db->delete($sql);
    if ($result) {
        $sucMsg = "Data delete successfully !";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}


if ($_POST['action'] == "employee_name") {
    $query = "SELECT * FROM employee_entry WHERE employee_status = '1' AND project_name_id = '$project_name_id' ";
    $data = $db->select($query);
    if ($data) { ?>

        <select class="form-control employeeName" name="employee_id[]" id="employee_id" required>
            <option value="">কর্মচারী নাম</option>

            <?php
            while ($rows = $data->fetch_assoc()) {
            ?>

                <option value="<?php echo $rows['id']; ?>"> <?php echo $rows['employee_name']; ?> </option>


            <?php } ?>

        </select>

        <?php
    }
}


// day wise entry all data 
if ($_POST["action"] == "all_data") {

    $query_detail = "SELECT employee_daily_hisab.*,employee_entry.id as empid, employee_entry.employee_name FROM employee_daily_hisab
    INNER JOIN employee_entry ON employee_daily_hisab.employee_id = employee_entry.id WHERE employee_daily_hisab.project_name_id ='$project_name_id' ORDER BY id DESC";

    $data = $db->select($query_detail);
    if ($data) {
        $i = 1;
        while ($rows = $data->fetch_assoc()) { ?>
            <tr>
                <td align="center"> <?php echo  $i++; ?></td>
                <td align="center"> <?php echo  $rows['employee_date']; ?> </td>
                <td align="center"> <?php echo  $rows['employee_name']; ?></td>
                <td align="center"> <?php echo  $rows['month_name']; ?></td>
                <td align="center"> <?php echo  $rows['naster_bill']; ?></td>
                <td align="center"> <?php echo  $rows['khaber_bill']; ?></td>
                <td align="center"> <?php echo  $rows['diner_beton']; ?></td>
                <td align="center"> <?php echo  $rows['marphot']; ?></td>
                <td align="center"> <?php echo  $rows['bonus']; ?></td>
                <td align="center"> <?php echo  $rows['nea_joma']; ?></td>

                <!-- <td align="center"><button class="btn btn-primary">View</button></td> -->
                <td align="center"><button class="btn btn-danger" id="<?php echo  $rows['id']; ?>" data_row_id="<?php echo $rows['id']; ?>" onclick="delete_row(this)">Delete</button></td>
                <td align="center"><button class="btn btn-success edit_employee" id="<?php echo  $rows['id']; ?>" data-id="<?php echo  $rows['id']; ?>">Edit</button></td>
            </tr>


<?php

        }
    }
}
// Mistree edit data
if ($_POST["action"] == "edit_day_data") {

    $query1 = "SELECT * FROM employee_daily_hisab WHERE id ='" . $_POST["id"] . "' ";

    $statement1 = $db->select($query1);
    while ($row = $statement1->fetch_assoc()) {
        $data['id']              = $row['id'];
        $data['employee_date']   = $row['employee_date'];
        $data['employee_id']     = $row['employee_id'];
        $data['month_name']      = $row['month_name'];
        $data['naster_bill']     = $row['naster_bill'];
        $data['khaber_bill']     = $row['khaber_bill'];
        $data['diner_beton']     = $row['diner_beton'];
        $data['marphot']         = $row['marphot'];
        $data['bonus']           = $row['bonus'];
        $data['nea_joma']        = $row['nea_joma'];
    }
    echo json_encode($data);
}

if ($_POST["action"] == "update_day_data") {

    $id                     = $_POST['id'];
    $employee_date          = $_POST['employee_date'];
    $employee_id            = $_POST['employee_id'];
    $month_name             = $_POST["month_name"];
    $naster_bill            = $_POST["naster_bill"];
    $khaber_bill            = $_POST["khaber_bill"];
    $diner_beton            = $_POST["diner_beton"];
    $marphot                = $_POST["marphot"];
    $bonus                  = $_POST["bonus"];
    $nea_joma               = $_POST["nea_joma"];


    $sql1 = "UPDATE employee_daily_hisab SET employee_date = '$employee_date', employee_id = '$employee_id', employee_id = '$employee_id',month_name = '$month_name', naster_bill='$naster_bill', khaber_bill='$khaber_bill', diner_beton='$diner_beton', marphot='$marphot', bonus='$bonus', nea_joma='$nea_joma' WHERE id = '$id' ";

    $update_Data = $db->update($sql1);
    if ($update_Data) {
        echo "Data update successfully";
    } else {
        echo "Data update Error";
    }
}

// Get supplier name
if ($_POST['action']=="getsuplier") {
    $query = "SELECT * FROM electric_suplier_create WHERE project_name_id = '$project_name_id' ";
         $showData = $db->select($query);
             if ($showData) {?>

      <select name="suplier_id" id="suplier_id" class="form-control suplier_name suplier_id" >

      <option value="">সাপ্লায়ার নাম</option>


         <?php 
             while ($rows = $showData->fetch_assoc()) {
         ?>
                                    
              <option value="<?php echo $rows['id']; ?>"> <?php echo $rows['suplier_name']; ?> </option>
                      
               
         <?php 
             }?>

       </select>         

        <?php 
    }
             
 

 }   


?>