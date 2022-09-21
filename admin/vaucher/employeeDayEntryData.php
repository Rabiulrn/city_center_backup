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

if ($_POST["action"] == "update_day_data") {

    $id                     = $_POST['id'];
    $employee_id            = $_POST['employee_id'];
    $employee_start_date          = $_POST['employee_start_date'];
    $employee_end_date             = $_POST["employee_end_date"];
    $totalDay             = $_POST["totalDay"];
    $total_naster_bill            = $_POST["total_naster_bill"];
    $total_khaber_bill            = $_POST["total_khaber_bill"];
    $total_diner_beton            = $_POST["total_diner_beton"];
    $bonus                  = $_POST["bonus"];
    $nea_joma               = $_POST["nea_joma"];


    $sql1 = "UPDATE employee_daily_hisab SET  employee_id = '$employee_id', employee_start_date = '$employee_start_date',employee_end_date = '$employee_end_date',totalDay='$totalDay', total_naster_bill='$total_naster_bill', total_khaber_bill='$total_khaber_bill', total_diner_beton='$total_diner_beton', bonus='$bonus', nea_joma='$nea_joma' WHERE id = '$id' ";

    $update_Data = $db->update($sql1);
    
    if ($update_Data) {
        echo "Data update successfully";
    } else {
        echo "Data update Error";
    }
}
if ($_POST['action'] == "getName") {
    $query = "SELECT * FROM employee_entry WHERE employee_status = '1' AND project_name_id = '$project_name_id' ";
    $data = $db->select($query);
    if ($data) { ?>

        <select class="form-control employeeCheck" name="employee_id" id="employee_id" required>
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
if ($_POST['action'] == "getMontName") {
    $query = "SELECT * FROM employee_entry WHERE employee_status = '1' AND project_name_id = '$project_name_id' ";
    $data = $db->select($query);
    if ($data) { ?>

        <select class="form-control employeeCheck" name="employee_id" id="employee_id" required>
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


//get employ data by group by month 
// day wise entry all data 
if ($_POST["action"] == "all_data_by_Month") {
    $month = $_POST["month_name"];
    $employee_id = $_POST["employee_id"];
    //echo $employee;

    if ($month != "") {

        $query_detail = "SELECT employee_daily_hisab.*,employee_entry.id as empid, employee_entry.employee_name, employee_entry.employee_mobile_num, employee_entry.employee_profile_pic,employee_entry.employee_designation FROM employee_daily_hisab
    INNER JOIN employee_entry ON employee_daily_hisab.employee_id = employee_entry.id WHERE employee_daily_hisab.project_name_id ='$project_name_id' AND employee_daily_hisab.employee_id='$employee_id' AND employee_daily_hisab.month_name='$month'  ";


        $resultTotalEmplyee = "SELECT SUM(naster_bill) AS sum_naster_bill, SUM(khaber_bill) AS sum_khaber_bill, SUM(diner_beton) AS sum_diner_beton, SUM(bonus) AS sum_bonus, SUM(nea_joma) AS sum_nea_joma  
          FROM employee_daily_hisab WHERE employee_daily_hisab.employee_id='$employee_id' AND employee_daily_hisab.month_name='$month'  ";
        //Total accoutnt for specific Employee
        $countMonthName = "SELECT month_name, COUNT(month_name) as mont
            FROM employee_daily_hisab GROUP BY month_name";
        $rowSum = $db->select($countMonthName);

        //echo $rowSum['mont'];
        $rowSumEmployee = $db->select($resultTotalEmplyee);
        $fetchTotal         = $rowSumEmployee->fetch_assoc();
        $total_naster_bill  = $fetchTotal['sum_naster_bill'];
        $total_khaber_bill  = $fetchTotal['sum_khaber_bill'];
        $total_diner_beton  = $fetchTotal['sum_diner_beton'];
        $total_bonus        = $fetchTotal['sum_bonus'];
        $total_nea_joma     = $fetchTotal['sum_nea_joma'];


        // get employee details
        $data2 = $db->select($query_detail);
        $display = $data2->fetch_assoc();
        $imgName =    $display['employee_profile_pic'];
        $beton =    $display['diner_beton'];
        $khaber_bill =    $display['khaber_bill'];
        $naster_bill =    $display['naster_bill'];
        $motTaka =  $total_naster_bill + $total_diner_beton + $total_bonus;
        $motPowna =  $total_nea_joma - $total_diner_beton;



        if ($imgName == "") { ?>
            <div class="profile">
                <div class="profile_area">
                    <h2 style="text-align: center; margin-top: 0px;"> </h2>



                </div>

            <?php  } else { ?>
                <div class="flexDiv">
                    <div class="profile_area">
                        <img class="profileImg" src="../uploads/employee_pic/<?php echo $imgName ?>">

                        <div style="text-align: center; margin-top: 0px;"> <?php echo $display['employee_name']; ?></div>
                    </div>

                <?php  } ?>

                <div class="raj_align">
                    <div style="margin-left: 10px;">মোবাইল নাম্বারঃ </div>
                    <div> <?php echo $display['employee_mobile_num']; ?> </div>
                </div>

                </div>

            </div>
            <table class="table_dis" style="border:1px solid black;margin-left:auto;margin-right:auto; margin-bottom: 20px; padding:10px;width: 400px; ">
                <!-- <caption>table title and/or explanatory text</caption> -->

                <tbody>
                    <tr>
                        <td>প্রতিদিনের নাস্তা মিল</td>
                        <td><?php echo $naster_bill; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>খাওয়া মিল</td>
                        <td><?php echo $khaber_bill ?></td>

                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>

                        <td>দিনের বেতন</td>
                        <td><?php echo $beton; ?></td>
                        <td></td>
                        <td>মোট বেতন</td>
                        <td> <?php echo $total_diner_beton; ?> </td>
                    </tr>
                    <tr>
                        <td>মোট টাকা </td>
                        <td><?php echo $motTaka; ?> </td>
                        <td></td>
                        <td>মোট নেওয়া</td>
                        <td> <?php echo $total_nea_joma ?> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>পাওনা</td>
                        <td> <?php echo $motPowna ?> </td>
                    </tr>
                </tbody>
            </table>


            <?php
            $data = $db->select($query_detail);
            if ($data) {
                $i = 1;



            ?>
                <h3 id="heading" style="text-align: center; margin-top: 0px;">কর্মচারী হিসাব</h3>
                <table class="table_dis" id="detailsNewTable2">
                    <thead>

                        <tr style="background-color: #b5b5b5;">
                            <th class="cenText">নং</th>
                            <th class="cenText">তারিখ</th>
                            <th class="cenText">নাম</th>
                            <th class="cenText">মাসের নাম</th>
                            <th class="cenText"> নাস্তা বিল</th>
                            <!-- <th class="cenText">মোট নাস্তা বিল</th> -->
                            <th class="cenText">খাওয়া মিল</th>
                            <!-- <th class="cenText">মোট খাওয়া মিল</th> -->
                            <th class="cenText">দিনের বেতন</th>
                            <!-- <th class="cenText">মোট বেতন</th> -->
                            <th class="cenText">মারফোত</th>
                            <th class="cenText">বোনাস</th>
                            <th class="cenText">নেওয়া জমা</th>
                            <!-- <th class="cenText">মোট টাকা </th> -->

                        </tr>

                    </thead>



                    <?php
                    while ($rows = $data->fetch_assoc()) {

                        $mounthday = count($rows['month_name']);

                    ?>
                        <tr>
                            <td align="center"> <?php echo  $i++; ?></td>
                            <td align="center"> <?php echo  $rows['employee_date']; ?> </td>
                            <td align="center"> <?php echo  $rows['employee_name']; ?></td>
                            <td align="center"> <?php echo  $rows['month_name']; ?></td>
                            <td align="center"> <?php echo  $rows['naster_bill']; ?></td>
                            <!-- <td align="center"> <?php echo   $mounthday ?></td> -->
                            <td align="center"> <?php echo  $rows['khaber_bill']; ?></td>
                            <td align="center"> <?php echo  $rows['diner_beton']; ?></td>
                            <td align="center"> <?php echo  $rows['marphot']; ?></td>
                            <td align="center"> <?php echo  $rows['bonus']; ?></td>
                            <td align="center"> <?php echo  $rows['nea_joma']; ?></td>

                        </tr>


                    <?php

                    }
                    ?>
                    <tfoot>
                        <tr>
                            <th align="center"> #</th>
                            <th colspan="3" align="center"></th>
                            <th align="center"> Total = <?php echo  $total_naster_bill; ?></th>
                            <th align="center">Total = <?php echo  $total_khaber_bill; ?></th>
                            <th align="center"> Total = <?php echo  $total_diner_beton; ?></th>
                            <th align="center"></th>
                            <th align="center"> Total = <?php echo  $total_bonus; ?></th>
                            <th align="center"> Total = <?php echo  $total_nea_joma; ?></th>

                        </tr>
                    </tfoot>

                </table>

            <?php
            }
        } else { ?>

            <table class="table_dis" id="detailsNewTable2">
                <thead>

                    <tr style="background-color: #b5b5b5;">
                        <th class="cenText">নং</th>
                        <th class="cenText">তারিখ</th>
                        <th class="cenText">নাম</th>
                        <th class="cenText">মাসের নাম</th>
                        <th class="cenText"> নাস্তা বিল</th>
                        <!-- <th class="cenText">মোট নাস্তা বিল</th> -->
                        <th class="cenText">খাওয়া মিল</th>
                        <!-- <th class="cenText">মোট খাওয়া মিল</th> -->
                        <th class="cenText">দিনের বেতন</th>
                        <!-- <th class="cenText">মোট বেতন</th> -->
                        <th class="cenText">মারফোত</th>
                        <th class="cenText">বোনাস</th>
                        <th class="cenText">নেওয়া জমা</th>
                        <!-- <th class="cenText">মোট টাকা </th> -->
                    </tr>

                </thead>
                <tbody>
                    <tr>
                    <td colspan="10">
                            <h3>No data found</h3>
                    </td> 
                    </tr>
                </tbody>
            </table>
            <?php
        }
    }


    // emplye only 
    if ($_POST["action"] == "all_data_employee") {
        $employee_id = $_POST["employee_id"];
        //echo $employee;

    if ($employee_id != '') {

    //     $query_detail = "SELECT employee_daily_hisab.*,employee_entry.id as empid, employee_entry.employee_name, employee_entry.employee_mobile_num, employee_entry.employee_profile_pic,employee_entry.employee_designation FROM employee_daily_hisab
    // INNER JOIN employee_entry ON employee_daily_hisab.employee_id = employee_entry.id WHERE employee_daily_hisab.project_name_id ='$project_name_id' AND employee_daily_hisab.employee_id='$employee_id' ";
        
        $query_detail = "SELECT employee_daily_hisab.*,employee_entry.id as empid, employee_entry.employee_name, employee_entry.employee_mobile_num, employee_entry.employee_profile_pic,employee_entry.employee_designation,employee_entry.emp_naster_meal,employee_entry.emp_khaber_meal,employee_entry.emp_diner_beton FROM employee_daily_hisab
         INNER JOIN employee_entry ON employee_daily_hisab.employee_id = employee_entry.id WHERE employee_daily_hisab.project_name_id ='$project_name_id' AND employee_daily_hisab.employee_id='$employee_id'  ORDER BY id DESC";
            
        //     $resultTotalEmplyee = "SELECT SUM(naster_bill) AS sum_naster_bill, SUM(khaber_bill) AS sum_khaber_bill, SUM(diner_beton) AS sum_diner_beton, SUM(bonus) AS sum_bonus, SUM(nea_joma) AS sum_nea_joma  
        //   FROM employee_daily_hisab WHERE employee_daily_hisab.employee_id='$employee_id'  ";
            //Total accoutnt for specific Employee
            // $countMonthName = "SELECT month_name, COUNT(month_name) as mont
            // FROM employee_daily_hisab GROUP BY month_name";
            // $rowSum = $db->select($countMonthName);

            //echo $rowSum['mont'];
           // $rowSumEmployee = $db->select($resultTotalEmplyee);
            // $fetchTotal         = $rowSumEmployee->fetch_assoc();
            // $total_naster_bill  = $fetchTotal['sum_naster_bill'];
            // $total_khaber_bill  = $fetchTotal['sum_khaber_bill'];
            // $total_diner_beton  = $fetchTotal['sum_diner_beton'];
            // $total_bonus        = $fetchTotal['sum_bonus'];
            // $total_nea_joma     = $fetchTotal['sum_nea_joma'];


            // get employee details
            $data2 = $db->select($query_detail);
            $display = $data2->fetch_assoc();
            $imgName =    $display['employee_profile_pic'];
            $beton =    $display['total_diner_beton'];
            $khaber_bill =    $display['total_khaber_bill'];
            $naster_bill =    $display['total_naster_bill'];
            $total_bonus =    $display['bonus'];
            $total_nea_joma =    $display['nea_joma'];
            $motTaka =  $naster_bill + $beton + $total_bonus;
            $motPowna =  $total_nea_joma - $beton;



            if ($imgName == "") { ?>
                <div class="profile">
                    <div class="profile_area">
                        <h2 style="text-align: center; margin-top: 0px;"> </h2>



                    </div>

                <?php  } else { ?>
                    <div class="flexDiv">
                        <div class="profile_area">
                            <img class="profileImg" src="../uploads/employee_pic/<?php echo $imgName ?>">

                            <div style="text-align: center; margin-top: 0px;"> <?php echo $display['employee_name']; ?></div>
                        </div>

                    <?php  } ?>

                    <div class="raj_align">
                        <div style="margin-left: 10px;">মোবাইল নাম্বারঃ </div>
                        <div> <?php echo $display['employee_mobile_num']; ?> </div>
                    </div>

                    </div>

                </div>
                <table class="table_dis" style="border:1px solid black;margin-left:auto;margin-right:auto; margin-bottom: 20px; padding:10px;width: 400px; ">
                    <!-- <caption>table title and/or explanatory text</caption> -->

                    <tbody>
                        <tr>
                            <td>প্রতিদিনের নাস্তা মিল</td>
                            <td><?php echo $naster_bill; ?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>খাওয়া মিল</td>
                            <td><?php echo $khaber_bill ?></td>

                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td>মোট বেতন</td>
                            <td> <?php echo $beton; ?> </td>
                        </tr>
                        <tr>
                            <td>মোট টাকা </td>
                            <td><?php echo $motTaka; ?> </td>
                            <td></td>
                            <td>মোট নেওয়া</td>
                            <td> <?php echo $total_nea_joma ?> </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>পাওনা</td>
                            <td> <?php echo $motPowna ?> </td>
                        </tr>
                    </tbody>
                </table>


                <?php
                $data = $db->select($query_detail);
                if ($data) {
                    $i = 1;



                ?>
                    <h3 id="heading" style="text-align: center; margin-top: 0px;">কর্মচারী হিসাব</h3>
                    <table class="table_dis" id="detailsNewTable2">
                        <thead>

                            <tr style="background-color: #b5b5b5;">
                                <th class="cenText">নং</th>
                                <th class="cenText">নাম</th>
                                <th class="cenText">শুরুর তারিখ</th>
                                <th class="cenText">শেষের তারিখ</th>
                                <th class="cenText">মোট দিন</th>
                                <th class="cenText">নাস্তা বিল</th>
                                <th class="cenText">মোট নাস্তা বিল</th>
                                <th class="cenText">খাওয়া মিল</th>
                                <th class="cenText">মোট খাওয়া মিল</th>
                                <th class="cenText">দিনের বেতন</th>
                                <th class="cenText">মোট বেতন</th>
                                <!-- <th class="cenText">মারফোত</th> -->
                                <th class="cenText">বোনাস</th>
                                <th class="cenText">নেওয়া জমা</th>
                                <!-- <th class="cenText">মোট টাকা </th> -->

                            </tr>

                        </thead>



                        <?php
                         $i = 1;
                        while ($rows = $data->fetch_assoc()) {


                        ?>
                            <tr>
                                <td align="center"> <?php echo  $i++; ?></td>
                                <td align="center"> <?php echo  $rows['employee_name']; ?></td>
                                <td align="center"> <?php echo  $rows['employee_start_date']; ?> </td>
                                <td align="center"> <?php echo  $rows['employee_end_date']; ?></td>
                                <td align="center"> <?php echo  $rows['totalDay']; ?></td>
                                <td align="center"> <?php echo  $rows['emp_naster_meal']; ?></td>
                                <td align="center"> <?php echo  $rows['total_naster_bill']; ?></td>

                                <td align="center"> <?php echo  $rows['emp_khaber_meal']; ?></td>
                                <td align="center"> <?php echo  $rows['total_khaber_bill']; ?></td>

                                <td align="center"> <?php echo  $rows['emp_diner_beton']; ?></td>
                                <td align="center"> <?php echo  $rows['total_diner_beton']; ?></td>

                                <td align="center"> <?php echo  $rows['bonus']; ?></td>
                                <td align="center"> <?php echo  $rows['nea_joma']; ?></td>

                            </tr>


                        <?php

                        }
                        ?>
                        <!-- <tfoot>
                            <tr>
                                <th align="center"> #</th>
                                <th colspan="3" align="center"></th>
                                <th align="center"> Total = <?php echo  $total_naster_bill; ?></th>
                                <th align="center">Total = <?php echo  $total_khaber_bill; ?></th>
                                <th align="center"> Total = <?php echo  $total_diner_beton; ?></th>
                                <th align="center"></th>
                                <th align="center"> Total = <?php echo  $total_bonus; ?></th>
                                <th align="center"> Total = <?php echo  $total_nea_joma; ?></th>

                            </tr>
                        </tfoot> -->

                    </table>

                <?php
                }
            } else { ?>

                <table class="table_dis" id="detailsNewTable2">
                    <thead>

                        <tr style="background-color: #b5b5b5;">
                                <th class="cenText">নং</th>
                                <th class="cenText">নাম</th>
                                <th class="cenText">শুরুর তারিখ</th>
                                <th class="cenText">শেষের তারিখ</th>
                                <th class="cenText">মোট দিন</th>
                                <th class="cenText">নাস্তা বিল</th>
                                <th class="cenText">মোট নাস্তা বিল</th>
                                <th class="cenText">খাওয়া মিল</th>
                                <th class="cenText">মোট খাওয়া মিল</th>
                                <th class="cenText">দিনের বেতন</th>
                                <th class="cenText">মোট বেতন</th>
                                <!-- <th class="cenText">মারফোত</th> -->
                                <th class="cenText">বোনাস</th>
                                <th class="cenText">নেওয়া জমা</th>
                                <!-- <th class="cenText">মোট টাকা </th> -->
                        </tr>

                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="10">
                                <h3>No data found</h3>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
            }
        }


        if ($_POST["action"] == "checkAlldata") {

            $query_detail = "SELECT employee_daily_hisab.*,employee_entry.id as empid, employee_entry.employee_name,employee_entry.emp_naster_meal,employee_entry.emp_khaber_meal,employee_entry.emp_diner_beton FROM employee_daily_hisab
        INNER JOIN employee_entry ON employee_daily_hisab.employee_id = employee_entry.id WHERE employee_daily_hisab.project_name_id ='$project_name_id' ORDER BY id DESC";
            $resultTotalEmplyee = "SELECT SUM(total_naster_bill) AS sum_naster_bill, SUM(total_khaber_bill) AS sum_khaber_bill, SUM(total_diner_beton) AS sum_diner_beton, SUM(bonus) AS sum_bonus, SUM(nea_joma) AS sum_nea_joma  
            FROM employee_daily_hisab   WHERE employee_daily_hisab.project_name_id ='$project_name_id'";
            $rowSumEmployee = $db->select($resultTotalEmplyee);
            $fetchTotal         = $rowSumEmployee->fetch_assoc();
            $total_naster_bill  = $fetchTotal['sum_naster_bill'];
            $total_khaber_bill  = $fetchTotal['sum_khaber_bill'];
            $total_diner_beton  = $fetchTotal['sum_diner_beton'];
            $total_bonus        = $fetchTotal['sum_bonus'];
            $total_nea_joma     = $fetchTotal['sum_nea_joma'];





            $data = $db->select($query_detail);
            if ($data) {
                $i = 1;
                while ($rows = $data->fetch_assoc()) { ?>
                    <tr>
                        <td align="center"> <?php echo  $i++; ?></td>
                    
                        <td align="center"> <?php echo  $rows['employee_name']; ?></td>
                        <td align="center"> <?php echo  $rows['employee_start_date']; ?> </td>
                        <td align="center"> <?php echo  $rows['employee_end_date']; ?></td>
                        <td align="center"> <?php echo  $rows['totalDay']; ?></td>
                        <td align="center"> <?php echo  $rows['emp_naster_meal']; ?></td>
                        <td align="center"> <?php echo  $rows['total_naster_bill']; ?></td>

                        <td align="center"> <?php echo  $rows['emp_khaber_meal']; ?></td>
                        <td align="center"> <?php echo  $rows['total_khaber_bill']; ?></td>

                        <td align="center"> <?php echo  $rows['emp_diner_beton']; ?></td>
                        <td align="center"> <?php echo  $rows['total_diner_beton']; ?></td>

                        <td align="center"> <?php echo  $rows['bonus']; ?></td>
                        <td align="center"> <?php echo  $rows['nea_joma']; ?></td>



                    </tr>


                <?php

                } ?>

                <tr>
                    <th align="center"> #</th>
                    <th colspan="5" align="center"></th>
                    <th align="center"> Total = <?php echo  $total_naster_bill; ?></th>
                    <th align="center"> </th>
                    <th align="center">Total = <?php echo  $total_khaber_bill; ?></th>
                    <th align="center"> </th>
                    <th align="center"> Total = <?php echo  $total_diner_beton; ?></th>
                    <th align="center"> Total = <?php echo  $total_bonus; ?></th>
                    <th align="center"> Total = <?php echo  $total_nea_joma; ?></th>

                </tr>



        <?php
            }
        }

        if (isset($_POST['data_delete_id'])) {
            $id = $_POST['data_delete_id'];

            $sql = "DELETE FROM employee_daily_hisab WHERE id = '$id'";
            $result = $db->delete($sql);
            if ($result) {
                $sucMsg = "Data delete successfully !";
            } else {
                echo "Error: " . $sql . "<br>" . $db->error;
            }
        }



        ?>