<?php 
	session_start();
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();

    $dateStr = $_POST['optionDate'];
    $dealerId	= $_POST['dealerId'];
	// echo $optionDate;
    $project_name_id = $_SESSION['project_name_id'];
	$edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];



    if($dateStr === 'alldates'){
        ?>
            <!-- <div class="viewDetailsCon" id="viewDetails"> -->
            <table id="detailsNewTable2" >
              <tr>
                <th>Customer ID:</th>
                <!-- <th>DEALER ID:</th> -->
                <th>Motor Cash</th>
                <th>Unload</th>
                <th>Cars rent & Redeem</th>
                <th>Information</th>
                <th>Address</th>
                <th>SL</th>
                <th>Delivery No:</th>
                <th>Motor</th>
                <th>Motor No</th>
                <th>Delivery Date</th>
                <th>Date</th>
                <th>Partculars</th>
                <th>Particulars</th>
                <th>Debit</th>
                <th>mm</th>
                <th>Kg</th>
                <th>Para's:</th>
                <th>Credit</th>
                <th>Discount</th>
                <th>Balance</th>
                <th>Bundil</th>
                <th>Total Para's:</th>
                <th class='no_print_media'></th>
                <th class='no_print_media'></th>
              </tr>
              <tr>
                    <th>কাস্টমার আই ডি</th>
                    <!-- <th>ডিলার আই ডি</th> -->
                    <th>গাড়ী ভাড়া</th>
                    <th>আনলোড</th>
                    <th>গাড়ী ভাড়া ও খালাস</th>
                    <th>মালের বিবরণ</th>
                    <th>ঠিকানা</th>
                    <th>ক্রমিক নং</th>
                    <th>ভাউচার নং</th>
                    <th>গাড়ী</th>
                    <th>গাড়ী নাম্বার</th>
                    <th>ডেলিভারী তারিখ</th>
                    <th>তারিখ</th>
                    <th>মারফোত নাম</th>
                    <th>বিবরণ</th>
                    <th>জমা টাকা</th>
                    <th>মিমি</th>
                    <th>কেজি</th>
                    <th>দর</th>
                    <th>মূল</th>
                    <th>কমিশন</th>
                    <th>অবশিষ্ট</th>
                    <th>বান্ডিল</th>
                    <th>মোট দামঃ</th>
                    <th class='no_print_media'></th>
                    <th class='no_print_media'></th>
              </tr>
              <?php
                    $sql ="SELECT * FROM details_sell WHERE dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
                    $result = $db->select($sql);
                    if ($result) {
                        while ($rows = $result->fetch_assoc()) {
                            if($rows['delivery_date'] == '0000-00-00'){
                                $format_delivery_date = '';
                            } 
                            else{
                                $delivery_date = $rows['delivery_date'];
                                $format_delivery_date = date("d-m-Y", strtotime($delivery_date));
                            }
                            if($rows['dates'] == '0000-00-00'){
                                $format_dates = '';
                            } 
                            else{
                                $dates = $rows['dates'];
                                $format_dates = date("d-m-Y", strtotime($dates));
                            }
                            echo "<tr>";
                            echo "<td>". $rows['customer_id'] ."</td>";
                            // echo "<td>". $rows['dealer_id'] ."</td>";
                            echo "<td>". $rows['motor_cash'] ."</td>";
                            echo "<td>". $rows['unload'] ."</td>";
                            echo "<td>". $rows['cars_rent_redeem'] ."</td>";
                            echo "<td>". $rows['information'] ."</td>";
                            echo "<td>". $rows['address'] ."</td>";
                            echo "<td>". $rows['sl_no'] ."</td>";
                            echo "<td>". $rows['delivery_no'] ."</td>";
                            echo "<td>". $rows['motor'] ."</td>";
                            echo "<td>". $rows['motor_no'] ."</td>";
                            echo "<td>". $format_delivery_date ."</td>";
                            echo "<td>". $format_dates ."</td>";
                            echo "<td>". $rows['partculars'] ."</td>";
                            echo "<td>". $rows['particulars'] ."</td>";
                            echo "<td>". $rows['debit'] ."</td>";
                            echo "<td>". $rows['mm'] ."</td>";
                            echo "<td>". $rows['kg'] ."</td>";
                            echo "<td>". $rows['paras'] ."</td>";
                            echo "<td>". $rows['credit'] ."</td>";
                            echo "<td>". $rows['discount'] ."</td>";
                            echo "<td>". $rows['balance'] ."</td>";
                            echo "<td>". $rows['bundil'] ."</td>";
                            echo "<td>". $rows['total_paras'] ."</td>";
                                                       
                            
                            if($delete_data_permission == 'yes'){
                                echo "<td width='78px'><a class='btn btn-danger detailsDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
                            } else {
                                echo '<td width="78px" class="no_print_media"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                            }

                            if($edit_data_permission == 'yes'){
                                echo "<td width='60px'><a onclick='edit_rod_details(" . $rows['id'] . ")' class='btn btn-success' >Edit</a></td>";
                            } else {
                                echo '<td width="60px" class="no_print_media"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
                            }
                            echo "</tr>";                            
                        }
                    } 
              ?>
            </table>
            <!-- </div> -->
        <?php
    } else{
        $optionDate = date('Y-m-d', strtotime($dateStr));

        ?>
        <!-- <div class="viewDetailsCon" id="viewDetails"> -->
        <table id="detailsNewTable2" >
          <tr>
            <th>Customer ID:</th>
            <!-- <th>DEALER ID:</th> -->
            <th>Motor Cash</th>
            <th>Unload</th>
            <th>Cars rent & Redeem</th>
            <th>Information</th>
            <th>Address</th>
            <th>SL</th>
            <th>Delivery No:</th>
            <th>Motor</th>
            <th>Motor No</th>
            <th>Delivery Date</th>
            <th>Date</th>
            <th>Partculars</th>
            <th>Particulars</th>
            <th>Debit</th>
            <th>mm</th>
            <th>Kg</th>
            <th>Para's:</th>
            <th>Credit</th>
            <th>Discount</th>
            <th>Balance</th>
            <th>Bundil</th>
            <th>Total Para's:</th>
            <th class='no_print_media'></th>
            <th class='no_print_media'></th>
          </tr>
          <tr>
                <th>কাস্টমার আই ডি</th>
                <!-- <th>ডিলার আই ডি</th> -->
                <th>গাড়ী ভাড়া</th>
                <th>আনলোড</th>
                <th>গাড়ী ভাড়া ও খালাস</th>
                <th>মালের বিবরণ</th>
                <th>ঠিকানা</th>
                <th>ক্রমিক নং</th>
                <th>ভাউচার নং</th>
                <th>গাড়ী</th>
                <th>গাড়ী নাম্বার</th>
                <th>ডেলিভারী তারিখ</th>
                <th>তারিখ</th>
                <th>মারফোত নাম</th>
                <th>বিবরণ</th>
                <th>জমা টাকা</th>
                <th>মিমি</th>
                <th>কেজি</th>
                <th>দর</th>
                <th>মূল</th>
                <th>কমিশন</th>
                <th>অবশিষ্ট</th>
                <th>বান্ডিল</th>
                <th>মোট দামঃ</th>
                <th class='no_print_media'></th>
                <th class='no_print_media'></th>
          </tr>
          <?php
                $sql ="SELECT * FROM details_sell WHERE dates = '$optionDate' AND dealer_id = '$dealerId' AND project_name_id = '$project_name_id'";
                $result = $db->select($sql);
                if ($result) {
                    while ($rows = $result->fetch_assoc()) {
                        if($rows['delivery_date'] == '0000-00-00'){
                            $format_delivery_date = '';
                        } 
                        else{
                            $delivery_date = $rows['delivery_date'];
                            $format_delivery_date = date("d-m-Y", strtotime($delivery_date));
                        }
                        if($rows['dates'] == '0000-00-00'){
                            $format_dates = '';
                        } 
                        else{
                            $dates = $rows['dates'];
                            $format_dates = date("d-m-Y", strtotime($dates));
                        }
                        echo "<tr>";
                        echo "<td>". $rows['customer_id'] ."</td>";
                        // echo "<td>". $rows['dealer_id'] ."</td>";
                        echo "<td>". $rows['motor_cash'] ."</td>";
                        echo "<td>". $rows['unload'] ."</td>";
                        echo "<td>". $rows['cars_rent_redeem'] ."</td>";
                        echo "<td>". $rows['information'] ."</td>";
                        echo "<td>". $rows['address'] ."</td>";
                        echo "<td>". $rows['sl_no'] ."</td>";
                        echo "<td>". $rows['delivery_no'] ."</td>";
                        echo "<td>". $rows['motor'] ."</td>";
                        echo "<td>". $rows['motor_no'] ."</td>";
                        echo "<td>". $format_delivery_date ."</td>";
                        echo "<td>". $format_dates ."</td>";
                        echo "<td>". $rows['partculars'] ."</td>";
                        echo "<td>". $rows['particulars'] ."</td>";
                        echo "<td>". $rows['debit'] ."</td>";
                        echo "<td>". $rows['mm'] ."</td>";
                        echo "<td>". $rows['kg'] ."</td>";
                        echo "<td>". $rows['paras'] ."</td>";
                        echo "<td>". $rows['credit'] ."</td>";
                        echo "<td>". $rows['discount'] ."</td>";
                        echo "<td>". $rows['balance'] ."</td>";
                        echo "<td>". $rows['bundil'] ."</td>";
                        echo "<td>". $rows['total_paras'] ."</td>";
                                                
                        if($delete_data_permission == 'yes'){
                            echo "<td width='78px' class='no_print_media'><a class='btn btn-danger detailsDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
                        } else {
                          echo '<td width="78px" class="no_print_media"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                        }

                        if($edit_data_permission == 'yes'){
                            echo "<td width='60px' class='no_print_media'><a onclick='edit_rod_details(" . $rows['id'] . ")'  class='btn btn-success'>Edit</a></td>";
                        } else {
                          echo '<td width="60px" class="no_print_media"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
                        }
                        echo "</tr>";                            
                    }
                } 
          ?>
        </table>
        <!-- </div> -->
        <?php
    }
        ?>





