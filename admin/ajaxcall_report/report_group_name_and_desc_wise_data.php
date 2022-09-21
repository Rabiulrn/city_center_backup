<?php
    session_start();  
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $search_date = $_POST['search_date'];
    $khoros_marfot_name = $_POST['khoros_marfot_name'];
    $biboron = $_POST['biboron'];

    $table_start = '<table class="tableshow" id="tableshow" style="border: 1px solid #ddd; font-size: 14px; border-collapse: collapse; width: 100%;">';
    $table_header = "<tr class='tableGroupColor' style='border: 1px solid #ddd; background-color: #8e8e8e;'>".
                        "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>নং</th>".
                        "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>তারিখ</th>".
                        "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>মারফোত নাম</th>".
                        "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>বিবরণ নাম</th>".
                        "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>দর</th>".
                        "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>জন</th>".
                        "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>মোট টাকা</th>".
                        "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>জমা</th>".
                        "<th style='border: 1px solid #ddd;  padding: 3px 5px;'>জের</th>".
                    "</tr>";
    $table_data_not_fund = $table_start
                            .'<tr>
                                <td colspan ="9" style="text-align: center;">No data found.</td>
                            </tr>
                          </table>';
    $mot_bill = 0;
    $mot_joma = 0;
    if($search_date == 'alldates'){
        $i = 1;
        $qry = "SELECT * FROM debit_group_data WHERE group_name = '$khoros_marfot_name' AND group_description = '$biboron' AND project_name_id = '$project_name_id'";
        $reads = $db->select($qry);
        if ($reads && mysqli_num_rows($reads) > 0) {
            echo $table_start;
                echo $table_header;
                while ($rows = $reads->fetch_assoc()) {
                    $dg_id = $rows['id'];
                    $dg_entry_date = $rows['entry_date'];
                    $dg_name = trim($rows['group_name']);
                    $dg_description = trim($rows['group_description']);
                    $dg_taka = trim($rows['group_taka']);
                    $dg_pices = trim($rows['group_pices']);
                    $dg_total_taka =trim($rows['group_total_taka']);
                    $dg_pay = trim($rows['group_pay']);
                    $dg_due = trim($rows['group_due']);
                    if($dg_entry_date == '0000-00-00'){
                        $dg_entry_date = '';
                    }
                    if($dg_taka == ''){
                        $dg_taka = 0;
                    }
                    if($dg_total_taka == ''){
                        $dg_total_taka = 0;
                    }
                    if($dg_pay == ''){
                        $dg_pay = 0;
                    }
                    if($dg_due == ''){
                        $dg_due = 0;
                    }
                    $mot_bill += $dg_total_taka;
                    $mot_joma += $dg_pay;
                    echo "<tr>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px; text-align:center'>" . $i . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px; width: 85px;'>" . date("d-m-Y", strtotime($dg_entry_date)) . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_name . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_description . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_taka . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_pices . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . number_format($dg_total_taka, 2) . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . number_format($dg_pay, 2) . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . number_format($dg_due, 2) . "</td>";
                    echo "</tr>";
                    $i++;
                }
                $jer = $mot_bill - $mot_joma;
                echo "<tr>
                        <td colspan='6' style='border: 1px solid #ddd;  padding: 3px 5px; text-align: right;'>মোটঃ</td>                               
                        <td style='border: 1px solid #ddd;  padding: 3px 5px;'>".number_format($mot_bill, 2)."</td>
                        <td style='border: 1px solid #ddd;  padding: 3px 5px;'>".number_format($mot_joma, 2)."</td>
                        <td style='border: 1px solid #ddd;  padding: 3px 5px;'>".number_format($jer, 2)."</td>
                     </tr>";
            echo '</table>';
        } else {
            echo $table_data_not_fund;
        }
    } else {
        $i = 1;
        $qry = "SELECT * FROM debit_group_data WHERE group_name = '$khoros_marfot_name' AND entry_date = '$search_date' AND group_description = '$biboron' AND project_name_id = '$project_name_id'";
        $reads = $db->select($qry);
        if ($reads && mysqli_num_rows($reads) > 0) {
            echo $table_start;
                echo $table_header;
                while ($rows = $reads->fetch_assoc()) {
                    $dg_id = $rows['id'];
                    $dg_entry_date = $rows['entry_date'];
                    $dg_name = trim($rows['group_name']);
                    $dg_description = trim($rows['group_description']);
                    $dg_taka = trim($rows['group_taka']);
                    $dg_pices = trim($rows['group_pices']);
                    $dg_total_taka =trim($rows['group_total_taka']);
                    $dg_pay = trim($rows['group_pay']);
                    $dg_due = trim($rows['group_due']);
                    if($dg_entry_date == '0000-00-00'){
                        $dg_entry_date = '';
                    }
                    if($dg_taka == ''){
                        $dg_taka = 0;
                    }
                    if($dg_total_taka == ''){
                        $dg_total_taka = 0;
                    }
                    if($dg_pay == ''){
                        $dg_pay = 0;
                    }
                    if($dg_due == ''){
                        $dg_due = 0;
                    }
                    $mot_bill += $dg_total_taka;
                    $mot_joma += $dg_pay;
                    echo "<tr>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px; text-align:center'>" . $i . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px; width: 85px;'>" . date("d-m-Y", strtotime($dg_entry_date)) . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_name . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_description . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_taka . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . $dg_pices . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . number_format($dg_total_taka, 2) . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . number_format($dg_pay, 2) . "</td>";
                        echo "<td style='border: 1px solid #ddd;  padding: 3px 5px;'>" . number_format($dg_due, 2) . "</td>";
                    echo "</tr>";
                    $i++;
                }
                $jer = $mot_bill - $mot_joma;
                echo "<tr>
                        <td colspan='6' style='border: 1px solid #ddd;  padding: 3px 5px; text-align: right;'>মোটঃ</td>                               
                        <td style='border: 1px solid #ddd;  padding: 3px 5px;'>".number_format($mot_bill, 2)."</td>
                        <td style='border: 1px solid #ddd;  padding: 3px 5px;'>".number_format($mot_joma, 2)."</td>
                        <td style='border: 1px solid #ddd;  padding: 3px 5px;'>".number_format($jer, 2)."</td>
                     </tr>";
            echo '</table>';
        } else {
            echo $table_data_not_fund;
        }
    }
?>
