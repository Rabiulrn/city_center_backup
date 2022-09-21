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

$check_emp = "SELECT * FROM employee_entry WHERE employee_status = '1' AND project_name_id = '$project_name_id' ";
  
$employee_id         = $_POST["employee_id"];
$employee_start_date = $_POST["employee_start_date"];
$employee_end_date   = $_POST["employee_end_date"];
$totalDay            = $_POST["totalDay"];
$total_naster_bill   = $_POST["naster_bill"];
$total_khaber_bill   = $_POST["khaber_bill"];
$total_diner_beton   = $_POST["diner_beton"];
$bonus               = $_POST["bonus"];
$nea_joma            = $_POST["nea_joma"];


 $number = count($total_naster_bill);
if ($number > 0) {
    for ($i = 0; $i < $number; $i++) {


$query1 = "INSERT INTO employee_daily_hisab(employee_id,employee_start_date,employee_end_date,totalDay,total_naster_bill,total_khaber_bill,total_diner_beton,bonus,nea_joma, project_name_id)
      VALUES ('$employee_id[$i]','$employee_start_date[$i]','$employee_end_date[$i]','$totalDay[$i]','$total_naster_bill[$i]','$total_khaber_bill[$i]','$total_diner_beton[$i]','$bonus[$i]','$nea_joma[$i]','$project_name_id')";

        $result = $db->insert($query1);
    }

    if ($result) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}
// if(isset($_POST["Submit"])){

// $employee_id         = $_POST["employee_id"];
// $employee_start_date = $_POST["employee_start_date"];
// $employee_end_date   = $_POST["employee_end_date"];
// $totalDay            = $_POST["totalDay"];
// $total_naster_bill   = $_POST["naster_bill"];
// $total_khaber_bill   = $_POST["khaber_bill"];
// $total_diner_beton   = $_POST["diner_beton"];
// $bonus               = $_POST["bonus"];
// $nea_joma            = $_POST["nea_joma"];


// //$number = count($naster_bill);

// $queryinsert = "INSERT INTO employee_daily_hisab(employee_id,employee_start_date,employee_end_date,totalDay,total_naster_bill,total_khaber_bill,total_diner_beton,bonus,nea_joma, project_name_id)
//       VALUES ('$employee_date', '$employee_id','$employee_start_date','$employee_end_date','$totalDay','$total_naster_bill','$total_khaber_bill','$total_diner_beton','$bonus','$nea_joma','$project_name_id')";

//         $result = $db->insert($queryinsert);
    

//     if ($result) {
//         echo json_encode(array("statusCode" => 200));
//     } else {
//         echo json_encode(array("statusCode" => 201));
//     }

// }


if ($_POST["action"] == "employee_insert") {
    $jogdaner_tarikh            = $_POST['jogdaner_tarikh'];
    $employee_name              = $_POST['employee_name'];
    $employee_mobile_num        = $_POST['employee_mobile_num'];
    $employee_address           = $_POST["employee_address"];
    $employee_designation       = $_POST["employee_designation"];
    $emp_naster_meal            = $_POST["emp_naster_meal"];
    $emp_khaber_meal            = $_POST["emp_khaber_meal"];
    $emp_diner_beton            = $_POST["emp_diner_beton"];
    $emp_marphot                = $_POST["emp_marphot"];
    //$employee_profile_pic            = $_FILES["employee_profile_pic"]['name'];
    $employee_status                 = '1';
    $time = date("d-m-Y") . "-" . time();
    $ext = pathinfo($_FILES['employee_profile_pic']['name'], PATHINFO_EXTENSION);
    $employee_profile_pic = $time . "." . $ext;

    $query = "INSERT INTO employee_entry(jogdaner_tarikh,employee_name, employee_mobile_num,employee_address,employee_designation,employee_profile_pic,emp_naster_meal,emp_khaber_meal,emp_diner_beton,emp_marphot,employee_status, project_name_id)
     VALUES ('$jogdaner_tarikh','$employee_name', '$employee_mobile_num','$employee_address','$employee_designation','$employee_profile_pic','$emp_naster_meal','$emp_khaber_meal','$emp_diner_beton','$emp_marphot','$employee_status','$project_name_id')";
    $result = $db->insert($query);


    if ($result) {

        $targetDir = "../uploads/employee_pic/";
        $targetFilePath = $targetDir . $employee_profile_pic;

        move_uploaded_file($_FILES["employee_profile_pic"]["tmp_name"], $targetFilePath);

        echo json_encode(array("statusCode" => 200));
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}

if ($_POST["action"] == "employee_details") {

    $query_detail = "SELECT * FROM employee_entry WHERE employee_status = '1' AND project_name_id = '$project_name_id' ";

    $data = $db->select($query_detail);
    if ($data) {
        $i = 1;
        while ($rows = $data->fetch_assoc()) { ?>
            <tr>
                <td align="center"> <?php echo  $i++; ?></td>
                <td align="center"> <?php echo  $rows['jogdaner_tarikh']; ?> </td>
                <td align="center"> <?php echo  $rows['employee_name']; ?> </td>
                <td align="center"> <?php echo  $rows['employee_mobile_num']; ?></td>
                <td align="center"> <?php echo  $rows['employee_address']; ?></td>
                <td align="center"> <?php echo  $rows['employee_designation']; ?></td>
                <td align="center"> <img style="width:50px; height:50px;" src="../uploads/employee_pic/<?php echo $rows['employee_profile_pic'];  ?>" alt="Profile pic"></td>
                <!-- <td align="center"><button class="btn btn-primary">View</button></td> -->
                <td align="center"> <?php echo  $rows['emp_naster_meal']; ?></td>
                <td align="center"> <?php echo  $rows['emp_khaber_meal']; ?></td>
                <td align="center"> <?php echo  $rows['emp_diner_beton']; ?></td>
                <td align="center"> <?php echo  $rows['emp_marphot']; ?></td>
                <td align="center"><button class="btn btn-danger" id="<?php echo  $rows['id']; ?>" data_row_id="<?php echo $rows['id']; ?>" onclick="delete_row(this)">Delete</button></td>
                <td align="center"><button class="btn btn-success edit_employee" id="<?php echo  $rows['id']; ?>" data-id="<?php echo  $rows['id']; ?>">Edit</button></td>
            </tr>


        <?php

        }
    }
}

// Mistree edit data
if ($_POST["action"] == "edit_single_employee") {
    //$query = "SELECT * FROM raj_kajerhisab WHERE id = '".$_POST["id"]."'";
    $query1 = "SELECT * FROM employee_entry WHERE project_name_id = '$project_name_id' AND id ='" . $_POST["id"] . "'  ";

    $statement1 = $db->select($query1);
    //$result = $statement->fetch_assoc();
    while ($row = $statement1->fetch_assoc()) {
        $data['id']                       = $row['id'];
        $data['jogdaner_tarikh']          = $row['jogdaner_tarikh'];
        $data['employee_name']            = $row['employee_name'];
        $data['employee_mobile_num']      = $row['employee_mobile_num'];
        $data['employee_address']         = $row['employee_address'];
        $data['employee_designation']     = $row['employee_designation'];
        $data['employee_profile_pic']     = $row['employee_profile_pic'];
        $data['emp_naster_meal']          = $row['emp_naster_meal'];
        $data['emp_khaber_meal']          = $row['emp_khaber_meal'];
        $data['emp_diner_beton']          = $row['emp_diner_beton'];
        $data['emp_marphot']              = $row['emp_marphot'];
    }
    echo json_encode($data);
}

if ($_POST["action"] == "get_single_employee") {
    //$query = "SELECT * FROM raj_kajerhisab WHERE id = '".$_POST["id"]."'";
    $query1 = "SELECT * FROM employee_entry WHERE id ='" . $_POST["employee_id"] . "' ";

    $statement1 = $db->select($query1);
    //$result = $statement->fetch_assoc();
    while ($row = $statement1->fetch_assoc()) {
        $data['jogdaner_tarikh']          = $row['jogdaner_tarikh'];
        $data['employee_name']            = $row['employee_name'];
        $data['employee_mobile_num']      = $row['employee_mobile_num'];
        $data['employee_address']         = $row['employee_address'];
        $data['employee_designation']     = $row['employee_designation'];
        $data['employee_profile_pic']     = $row['employee_profile_pic'];
        $data['emp_naster_meal']          = $row['emp_naster_meal'];
        $data['emp_khaber_meal']          = $row['emp_khaber_meal'];
        $data['emp_diner_beton']          = $row['emp_diner_beton'];
    }
    echo json_encode($data);
}


if ($_POST["action"] == "employee_update") {

    $id                              = $_POST['id'];
    $jogdaner_tarikh                 = $_POST['jogdaner_tarikh'];
    $employee_name                   = $_POST['employee_name'];
    $employee_mobile_num             = $_POST['employee_mobile_num'];
    $employee_address                = $_POST["employee_address"];
    $employee_designation            = $_POST["employee_designation"];
    $emp_naster_meal                 = $_POST["emp_naster_meal"];
    $emp_khaber_meal                 = $_POST["emp_khaber_meal"];
    $emp_diner_beton                 = $_POST["emp_diner_beton"];
    $emp_marphot                     = $_POST["emp_marphot"];
    $employee_old_pic                = $_POST["employee_old_pic"];

    $mesg = "";
    $filePath = "../uploads/employee_pic/" . $employee_old_pic;
    $employee_profile_pic = [];
    if ($_FILES["employee_profile_pic"]['size'] > 1) {
        /* Location */
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $time = date("d-m-Y") . "-" . time();
        $ext = pathinfo($_FILES['employee_profile_pic']['name'], PATHINFO_EXTENSION);
        $targetDir = "../uploads/employee_pic/";
        $employee_profile_pic = $time . "." . $ext;
        $targetFilePath = $targetDir . $employee_profile_pic;
        move_uploaded_file($_FILES["employee_profile_pic"]["tmp_name"], $targetFilePath);
    } else {

        $employee_profile_pic = $employee_old_pic;
    }

    $sql = "UPDATE employee_entry SET  jogdaner_tarikh = '$jogdaner_tarikh',employee_name = '$employee_name', employee_mobile_num = '$employee_mobile_num', employee_address = '$employee_address',employee_designation = '$employee_designation', employee_profile_pic='$employee_profile_pic', emp_naster_meal='$emp_naster_meal', emp_khaber_meal='$emp_khaber_meal', emp_diner_beton='$emp_diner_beton', emp_marphot='$emp_marphot' WHERE project_name_id = '$project_name_id' AND  id = '$id' ";

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

    $sql = "DELETE FROM employee_entry WHERE id = '$id'";
    $result = $db->delete($sql);
    if ($result) {
        $sucMsg = "Data delete successfully !";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}


if ($_POST['action'] == "employee_name") {
    $query = "SELECT * FROM employee_entry WHERE project_name_id = '$project_name_id'";
    $data = $db->select($query);
    if ($data) { ?>

       
            <option value="">কর্মচারী নাম</option>

            <?php
            while ($rows = $data->fetch_assoc()) {
            ?>

                <option startData ="<?php echo $rows['jogdaner_tarikh']; ?>" naster_bill="<?php echo $rows['emp_naster_meal']; ?>" khaber_bill="<?php echo $rows['emp_khaber_meal']; ?>" diner_beton="<?php echo $rows['emp_diner_beton']; ?>"  value="<?php echo $rows['id']; ?>"> <?php echo $rows['employee_name']; ?> </option>


            <?php } ?>

       

        <?php
    }
}





// day wise entry all data 
if ($_POST["action"] == "all_data") {

    $query_detail = "SELECT employee_daily_hisab.*,employee_entry.id as empid, employee_entry.employee_name,employee_entry.jogdaner_tarikh FROM employee_daily_hisab
    INNER JOIN employee_entry ON employee_daily_hisab.employee_id = employee_entry.id WHERE employee_daily_hisab.project_name_id  = '$project_name_id'  ORDER BY id DESC";

    $data = $db->select($query_detail);
    if ($data) {
        $i = 1;
        while ($rows = $data->fetch_assoc()) { ?>
            <tr>
                <td align="center"> <?php echo  $i++; ?></td>
                <td align="center"> <?php echo  $rows['employee_name']; ?></td>
                <td align="center"> <?php echo  $rows['employee_start_date']; ?></td>
                <td align="center"> <?php echo  $rows['employee_end_date']; ?></td>
                <td align="center"> <?php echo  $rows['totalDay']; ?></td>
                <td align="center"> <?php echo  $rows['total_naster_bill']; ?></td>
                <td align="center"> <?php echo  $rows['total_khaber_bill']; ?></td>
                <td align="center"> <?php echo  $rows['total_diner_beton']; ?></td>
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
        $data['id']                    = $row['id'];
        $data['employee_id']           = $row['employee_id'];
        $data['employee_start_date']   = $row['employee_start_date'];
        $data['employee_end_date']     = $row['employee_end_date'];
        $data['totalDay']              = $row['totalDay'];
        $data['total_naster_bill']     = $row['total_naster_bill'];
        $data['total_khaber_bill']     = $row['total_khaber_bill'];
        $data['total_diner_beton']     = $row['total_diner_beton'];
        $data['bonus']                 = $row['bonus'];
        $data['nea_joma']              = $row['nea_joma'];
    }
    echo json_encode($data);
}

if ($_POST["action"] == "update_day_data") {

    $id                     = $_POST['id'];
    $employee_id            = $_POST['employee_id'];
    $employee_start_date    = $_POST['employee_start_date'];
    $employee_end_date      = $_POST['employee_end_date'];
    $totalDay               = $_POST['totalDay'];
    $naster_bill            = $_POST["naster_bill"];
    $khaber_bill            = $_POST["khaber_bill"];
    $diner_beton            = $_POST["diner_beton"];
    $bonus                  = $_POST["bonus"];
    $nea_joma               = $_POST["nea_joma"];


    $sql1 = "UPDATE employee_daily_hisab SET  employee_id = '$employee_id',employee_start_date = '$employee_start_date', employee_end_date = '$employee_end_date', total_naster_bill='$naster_bill', total_khaber_bill='$khaber_bill', total_diner_beton='$diner_beton', bonus='$bonus', nea_joma='$nea_joma' WHERE project_name_id = '$project_name_id' AND id = '$id' ";

    $update_Data = $db->update($sql1);
    if ($update_Data) {
        echo "Data update successfully";
    } else {
        echo "Data update Error";
    }
}



?>