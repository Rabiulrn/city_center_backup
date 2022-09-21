<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$_SESSION['pageName'] = 'electric_kroy_bikroy';

$project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];
$sucMsg = "";


$e_date              = $_POST["e_date"];
$suplier_id         = $_POST["suplier_id"];
$gari_number          = $_POST["gari_number"];
$vara_khalas         = $_POST["vara_khalas"];
$vaucher_number         = $_POST["vaucher_number"];
$maler_biboron         = $_POST["maler_biboron"];
$jometaka               = $_POST["jometaka"];
$maler_dor              =$_POST["maler_dor"];
$maler_poriman            = $_POST["maler_poriman"];
$maler_mullo            = $_POST["maler_mullo"];
$commission            = $_POST["commission"];
$maler_mot_mullo            = $_POST["maler_mot_mullo"];
$abosistho            = $_POST["abosistho"];
$mot_abosistho            = $_POST["mot_abosistho"];



$number = count($e_date);
if ($number > 0) {
    for ($i = 0; $i < $number; $i++) {


        $query1 = "INSERT INTO electric_daily_hisab(e_date, suplier_id,gari_number,vara_khalas,vaucher_number,maler_biboron,jometaka,maler_dor,maler_poriman,maler_mullo,commission,maler_mot_mullo,abosistho,mot_abosistho, project_name_id)
      VALUES ('$e_date[$i]', '$suplier_id[$i]','$gari_number[$i]','$vara_khalas[$i]','$vaucher_number[$i]','$maler_biboron[$i]','$jometaka[$i]','$maler_dor[$i]','$maler_poriman[$i]','$maler_mullo[$i]','$commission[$i]','$maler_mot_mullo[$i]','$abosistho[$i]','$mot_abosistho[$i]','$project_name_id')";

        $result = $db->insert($query1);
    }

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}
// day wise entry all data 
if ($_POST["action"] == "getall_data") {

    $query_detail = "SELECT electric_daily_hisab.*, electric_suplier_create.id as eid, electric_suplier_create.suplier_name  FROM electric_daily_hisab 
    INNER JOIN electric_suplier_create ON electric_daily_hisab.suplier_id = electric_suplier_create.id WHERE electric_daily_hisab.project_name_id='$project_name_id' ";

    $data = $db->select($query_detail);
    if ($data) {
        $i = 1;
        while ($rows = $data->fetch_assoc()) { ?>
            <tr>
                <td align="center"> <?php echo  $i++; ?></td>
                <td align="center"> <?php echo  $rows['e_date']; ?> </td>
                <td align="center"> <?php echo  $rows['suplier_name']; ?></td>
                <td align="center"> <?php echo  $rows['gari_number']; ?></td>
                <td align="center"> <?php echo  $rows['vara_khalas']; ?></td>
                <td align="center"> <?php echo  $rows['vaucher_number']; ?></td>
                <td align="center"> <?php echo  $rows['maler_biboron']; ?></td>
                <td align="center"> <?php echo  $rows['jometaka']; ?></td>
                <td align="center"> <?php echo  $rows['maler_dor']; ?></td>
                <td align="center"> <?php echo  $rows['maler_poriman']; ?></td>
                <td align="center"> <?php echo  $rows['maler_mullo']; ?></td>
                <td align="center"> <?php echo  $rows['commission']; ?></td>
                <td align="center"> <?php echo  $rows['maler_mot_mullo']; ?></td>
                <td align="center"> <?php echo  $rows['abosistho']; ?></td>
                <td align="center"> <?php echo  $rows['mot_abosistho']; ?></td>

                <!-- <td align="center"><button class="btn btn-primary">View</button></td> -->
                <td align="center"><button class="btn btn-danger" id="<?php echo  $rows['id']; ?>" data_row_id="<?php echo $rows['id']; ?>" onclick="delete_row(this)">Delete</button></td>
                <td align="center"><button class="btn btn-success edit_data" id="<?php echo  $rows['id']; ?>" data-id="<?php echo  $rows['id']; ?>">Edit</button></td>
            </tr>


<?php

        }
    }
}

// edit data
if ($_POST["action"] == "single_edit") {
    $query1 = "SELECT * FROM electric_daily_hisab WHERE id ='" . $_POST["id"] . "' ";

    $statement1 = $db->select($query1);
    //$result = $statement->fetch_assoc();
    while ($row = $statement1->fetch_assoc()) {
        $data['id']                         = $row['id'];
        $data['e_date']                     = $row['e_date'];
        $data['suplier_id']                 = $row['suplier_id'];
        $data['gari_number']                = $row['gari_number'];
        $data['vara_khalas']                = $row['vara_khalas'];
        $data['vaucher_number']             = $row['vaucher_number'];
        $data['maler_biboron']              = $row['maler_biboron'];
        $data['jometaka']                   = $row['jometaka'];
        $data['maler_dor']                  = $row['maler_dor'];
        $data['maler_poriman']              = $row['maler_poriman'];
        $data['maler_mullo']                = $row['maler_mullo'];
        $data['commission']                 = $row['commission'];
        $data['maler_mot_mullo']            = $row['maler_mot_mullo'];
        $data['abosistho']                  = $row['abosistho'];
        $data['mot_abosistho']              = $row['mot_abosistho'];
    }
    echo json_encode($data);
}


if ($_POST["action"] == "updateData") {

    $id                            = $_POST['id'];
    $e_date              = $_POST["e_date"];
    $suplier_id         = $_POST["suplier_id"];
    $gari_number          = $_POST["gari_number"];
    $vara_khalas         = $_POST["vara_khalas"];
    $vaucher_number         = $_POST["vaucher_number"];
    $maler_biboron         = $_POST["maler_biboron"];
    $jometaka               = $_POST["jometaka"];
    $maler_dor              =$_POST["maler_dor"];
    $maler_poriman            = $_POST["maler_poriman"];
    $maler_mullo            = $_POST["maler_mullo"];
    $commission            = $_POST["commission"];
    $maler_mot_mullo            = $_POST["maler_mot_mullo"];
    $abosistho            = $_POST["abosistho"];
    $mot_abosistho            = $_POST["mot_abosistho"];

    $mesg = "";

    $sql = "UPDATE electric_daily_hisab SET  e_date = '$e_date', suplier_id = '$suplier_id', gari_number = '$gari_number',vara_khalas = '$vara_khalas', 
    vaucher_number='$vaucher_number',maler_biboron ='$maler_biboron',jometaka='$jometaka',maler_dor='$maler_dor',maler_poriman='$maler_poriman',maler_mullo='$maler_mullo'  
    commission='$commission', maler_mot_mullo='$maler_mot_mullo', abosistho='$abosistho', mot_abosistho='$mot_abosistho'  WHERE id = '$id' ";

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

      <select name="suplier_id" id="suplier_id" class="form-control suplier_name" >

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