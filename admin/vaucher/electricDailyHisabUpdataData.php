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
    vaucher_number='$vaucher_number',maler_biboron ='$maler_biboron',jometaka='$jometaka',maler_dor='$maler_dor',maler_poriman='$maler_poriman',maler_mullo='$maler_mullo',  
    commission='$commission', maler_mot_mullo='$maler_mot_mullo', abosistho='$abosistho', mot_abosistho='$mot_abosistho'  WHERE id = '$id' ";

    $update_result = $db->update($sql);
    if ($update_result) {
        echo "Data update successfully";
        // echo json_encode( $update_result ); 
    } else {
        echo "Data update Error";
    }
}
// Get suplier name
if ($_POST['action'] == "getSupliername") {
    $query = "SELECT * FROM electric_suplier_create WHERE project_name_id = '$project_name_id' ";
    $data = $db->select($query);
    if ($data) { ?>

        <select class="form-control suplier_name" name="suplier_id" id="suplier_id" required>
            <option value=""> সাপ্লায়ার নাম</option>

            <?php
            while ($rows = $data->fetch_assoc()) {
            ?>

                <option value="<?php echo $rows['id']; ?>"> <?php echo $rows['suplier_name']; ?> </option>


            <?php } ?>

        </select>

        <?php
    }
}

// Get sum of all datas
if ($_POST["action"] == "all_data_suplier") {
    $suplier_id = $_POST["suplier_id"];
   // echo $suplier_id;

if ($suplier_id != '') {

    $query_detail = "SELECT electric_daily_hisab.*, electric_suplier_create.id as eid, electric_suplier_create.suplier_name, electric_suplier_create.suplier_Protisthan_name,electric_suplier_create.suplier_Protisthan_slogan,electric_suplier_create.suplier_mobile_num,electric_suplier_create.suplier_address FROM electric_daily_hisab 
    INNER JOIN electric_suplier_create ON electric_daily_hisab.suplier_id = electric_suplier_create.id  WHERE electric_daily_hisab.project_name_id ='$project_name_id' AND electric_daily_hisab.suplier_id='$suplier_id' ";

        $resultTotal = "SELECT SUM(vara_khalas) AS sum_vara_khalas, SUM(jometaka) AS sum_jometaka, SUM(maler_dor) AS sum_maler_dor, SUM(maler_poriman) AS sum_maler_poriman, SUM(maler_mullo) AS sum_maler_mullo, SUM(commission) AS sum_commission, SUM(maler_mot_mullo) AS sum_maler_mot_mullo , SUM(abosistho) AS sum_abosistho ,SUM(mot_abosistho) AS sum_mot_abosistho FROM electric_daily_hisab WHERE electric_daily_hisab.project_name_id ='$project_name_id' AND electric_daily_hisab.suplier_id='$suplier_id'  ";
        //Total accoutnt for specific Employee
        // $countMonthName = "SELECT month_name, COUNT(month_name) as mont
        // FROM employee_daily_hisab GROUP BY month_name";
        // $rowSum = $db->select($countMonthName);

        //echo $rowSum['mont'];
        $rowSumSuplier = $db->select($resultTotal);
        $fetchTotal                 = $rowSumSuplier->fetch_assoc();
        $total_vara_khalas          = $fetchTotal['sum_vara_khalas'];
        $total_jometaka             = $fetchTotal['sum_jometaka'];
        $total_maler_dor            = $fetchTotal['sum_maler_dor'];
        $total_maler_poriman        = $fetchTotal['sum_maler_poriman'];
        $total_maler_mullo          = $fetchTotal['sum_maler_mullo'];
        $sum_commission             = $fetchTotal['sum_commission'];
        $total_maler_mot_mullo      = $fetchTotal['sum_maler_mot_mullo'];
        $total_abosistho            = $fetchTotal['sum_abosistho'];
        $total_mot_abosistho        = $fetchTotal['sum_mot_abosistho'];
        $total_mot_nea = intval($total_jometaka) - intval($total_maler_mullo) ;


        // get employee details
        $data2 = $db->select($query_detail);
        $display = $data2->fetch_assoc();

        // $imgName =    $display['employee_profile_pic'];
        // $beton =    $display['diner_beton'];
        // $khaber_bill =    $display['khaber_bill'];
        // $naster_bill =    $display['naster_bill'];
        // $motTaka =  $total_naster_bill + $total_diner_beton + $total_bonus;
        // $motPowna =  $total_nea_joma - $total_diner_beton;



       ?>
            <div class="profile">

                <div class="flexDiv">
                    <div class="profile_area">
                

                        <div style="text-align: center; margin-top: 0px;"> নাম : <?php echo $display['suplier_name']; ?> , </div>
                        <div style="text-align: center; margin-top: 0px;"> <?php echo $display['suplier_Protisthan_name']; ?> ,</div>
                        <div style="text-align: center; margin-top: 0px;"> <?php echo $display['suplier_Protisthan_slogan']; ?>,</div>
                        <div style="text-align: center; margin-top: 0px;"> <?php echo $display['suplier_address']; ?>,</div>
                    </div>

              

                <div class="raj_align">

                    <div style="margin-left: 10px;">মোবাইল নাম্বারঃ </div>
                    <div> <?php echo $display['suplier_mobile_num']; ?> </div>
                </div>

                </div>

            </div>
            <table class="table_dis" style="border:1px solid black;margin-left:auto;margin-right:auto; margin-bottom: 20px; padding:10px;width: 400px; ">
                <!-- <caption>table title and/or explanatory text</caption> -->

                <tbody>
                    <tr>
                    <td></td>
                    <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        
                    <td>গাড়ী ভাড়া ও খালাসঃ</td>
                        <td><?php echo $total_vara_khalas; ?></td>
                        <td></td>
                        <td>ম‌োট মূলঃ</td>
                        <td><?php echo $total_maler_mullo; ?></td>
                    </tr>
                    <tr>

                    <td>ম‌োট মূল খরচ সহ</td>
                        <td><?php echo $total_maler_mot_mullo ?></td>
                        <td></td>
                        <td>ম‌োট জমাঃ</td>
                        <td> <?php echo $total_jometaka; ?> </td>
                    </tr>
                    <tr>
                        
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td>পাওনা ও জেরঃ </td>
                        <td><?php echo $total_mot_nea; ?> </td>
                    </tr>
                    <!-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td> <?php //echo $motPowna ?> </td>
                    </tr> -->
                </tbody>
            </table>


            <?php
            $data = $db->select($query_detail);
            if ($data) {
                $i = 1;



            ?>
                <h3 id="heading" style="text-align: center; margin-top: 0px;"> বৈদ্যুতিক সামগ্রী হিসাব</h3>
                <table class="table_dis" id="detailsNewTable2">
                    <thead>

                    <tr style="background-color: #b5b5b5;">
                        <th class="cenText">#</th>
                        <th class="cenText">তারিখ</th>
                        <th class="cenText">সাপ্লায়ার নাম</th>
                        <th class="cenText">গাড়ী নাম্বার</th>
                        <th class="cenText">ভাড়া ও খালাস</th>
                        <th class="cenText">ভাউচার নং</th>
                        <th class="cenText">মালের বিবরণ</th>
                        <th class="cenText">জমা</th>
                        <th class="cenText">দর</th>

                        <th class="cenText">পরিমান‌</th>
                        <th class="cenText">মূল্য</th>
                        <th class="cenText">কমিসন</th>
                        <th class="cenText">মোট মূল্য</th>
                        <th class="cenText">অবশিষ্ট</th>
                        <th class="cenText">মোট অবশিষ্ট</th>

                    </tr>

                    </thead>



                    <?php
                    while ($rows = $data->fetch_assoc()) {

                        $mounthday = count($rows['month_name']);

                    ?>
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

                        </tr>


                    <?php

                    }
                    ?>
                    <tfoot>
                        <tr>

                            <th colspan="4" align="center"></th>
                            <th align="center"> Total = <?php echo  $total_vara_khalas; ?> </th>
                            <th align="center"></th>
                            <th align="center"> </th>
                            <th align="center"> Total = <?php echo  $total_jometaka; ?></th>
                            <th align="center"> Total = <?php echo  $total_maler_dor; ?></th>
                            <th align="center"> Total = <?php echo  $total_maler_poriman; ?></th>
                            <th align="center"> Total = <?php echo  $total_maler_mullo; ?></th>
                            <th align="center"> Total = <?php echo  $total_commission; ?></th>
                            <th align="center"> Total = <?php echo  $total_maler_mot_mullo; ?></th>
                            <th align="center"> Total = <?php echo  $total_abosistho; ?></th>
                            <th align="center"> Total = <?php echo  $total_mot_abosistho; ?></th>
                            

                        </tr>
                    </tfoot>

                </table>

            <?php
            }
        } else { ?>

            <table class="table_dis" id="detailsNewTable2">
                <thead>

                    <tr style="background-color: #b5b5b5;">
                        <th class="cenText">তারিখ</th>
                        <th class="cenText">সাপ্লায়ার নাম</th>
                        <th class="cenText">গাড়ী নাম্বার</th>
                        <th class="cenText">ভাড়া ও খালাস</th>
                        <th class="cenText">ভাউচার নং</th>
                        <th class="cenText">মালের বিবরণ</th>
                        <th class="cenText">জমা</th>
                        <th class="cenText">দর</th>

                        <th class="cenText">পরিমান‌</th>
                        <th class="cenText">মূল্য</th>
                        <th class="cenText">কমিসন</th>
                        <th class="cenText">মোট মূল্য</th>
                        <th class="cenText">অবশিষ্ট</th>
                        <th class="cenText">মোট অবশিষ্ট</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td colspan="14">
                            <h3>No data found</h3>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
        }
    }
    if ($_POST["action"] == "checkAlldata") {

        $query_detail = "SELECT electric_daily_hisab.*, electric_suplier_create.id as eid, electric_suplier_create.suplier_name, electric_suplier_create.suplier_Protisthan_name,electric_suplier_create.suplier_Protisthan_slogan,electric_suplier_create.suplier_mobile_num,electric_suplier_create.suplier_address FROM electric_daily_hisab 
        INNER JOIN electric_suplier_create ON electric_daily_hisab.suplier_id = electric_suplier_create.id  WHERE electric_daily_hisab.project_name_id ='$project_name_id' ";
        $resultTotal = "SELECT SUM(vara_khalas) AS sum_vara_khalas, SUM(jometaka) AS sum_jometaka, SUM(maler_dor) AS sum_maler_dor, SUM(maler_poriman) AS sum_maler_poriman, SUM(maler_mullo) AS sum_maler_mullo, SUM(commission) AS sum_commission, SUM(maler_mot_mullo) AS sum_maler_mot_mullo , SUM(abosistho) AS sum_abosistho ,SUM(mot_abosistho) AS sum_mot_abosistho FROM electric_daily_hisab WHERE electric_daily_hisab.project_name_id = '$project_name_id'  ";
        
        $rowSumSuplier = $db->select($resultTotal);
        $fetchTotal                 = $rowSumSuplier->fetch_assoc();
        $total_vara_khalas          = $fetchTotal['sum_vara_khalas'];
        $total_jometaka             = $fetchTotal['sum_jometaka'];
        $total_maler_dor            = $fetchTotal['sum_maler_dor'];
        $total_maler_poriman        = $fetchTotal['sum_maler_poriman'];
        $total_maler_mullo          = $fetchTotal['sum_maler_mullo'];
        $sum_commission             = $fetchTotal['sum_commission'];
        $total_maler_mot_mullo      = $fetchTotal['sum_maler_mot_mullo'];
        $total_abosistho            = $fetchTotal['sum_abosistho'];
        $total_mot_abosistho        = $fetchTotal['sum_mot_abosistho'];





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



                </tr>


            <?php

            } ?>

            <tr>
                            <th colspan="4" align="center"></th>
                            <th align="center"> Total = <?php echo  $total_vara_khalas; ?> </th>
                            <th align="center"></th>
                            <th align="center"> </th>
                            <th align="center"> Total = <?php echo  $total_jometaka; ?></th>
                            <th align="center"> Total = <?php echo  $total_maler_dor; ?></th>
                            <th align="center"> Total = <?php echo  $total_maler_poriman; ?></th>
                            <th align="center"> Total = <?php echo  $total_maler_mullo; ?></th>
                            <th align="center"> Total = <?php echo  $total_commission; ?></th>
                            <th align="center"> Total = <?php echo  $total_maler_mot_mullo; ?></th>
                            <th align="center"> Total = <?php echo  $total_abosistho; ?></th>
                            <th align="center"> Total = <?php echo  $total_mot_abosistho; ?></th>

            </tr>



    <?php
        }
    }




if (isset($_POST['data_delete_id'])) {
    $id = $_POST['data_delete_id'];

    $sql = "DELETE FROM electric_daily_hisab WHERE id = '$id'";
    $result = $db->delete($sql);
    if ($result) {
        $sucMsg = "Data delete successfully !";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}
