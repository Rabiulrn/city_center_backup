<?php 
  session_start();
    $rod_details_id = $_POST['rod_details_id'];

  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $sucMsg ="";
  // echo $_POST['rod_details_id'];

  if(isset($rod_details_id)){
      // $rod_details_id = $_POST['rod_details_id'];
      
      $entryDisBlock= 'none';
      $editDisBlock= 'display';
      $sql = "SELECT * FROM details_sell WHERE id = '$rod_details_id'";
      $result = $db->select($sql);
      if($result) {
          while ($rows = $result->fetch_assoc()){
              $customer_id        = $rows['customer_id'];
              $dealer_id          = $rows['dealer_id'];
              $motor_cash         = $rows['motor_cash'];
              $unload             = $rows['unload'];
              $cars_rent_redeem   = $rows['cars_rent_redeem'];
              $information        = $rows['information'];                  
              $address            = $rows['address'];
              $sl_no              = $rows['sl_no'];
              $delivery_no        = $rows['delivery_no'];
              $motor              = $rows['motor'];
              $motor_no           = $rows['motor_no'];


              $delivery_date = $rows['delivery_date'];
              if($delivery_date == '0000-00-00'){
                  $delivery_date ='';
              } else {
                  $postDateArr2   = explode('-', $delivery_date);
                  $delivery_date  = $postDateArr2['2'].'-'.$postDateArr2['1'].'-'.$postDateArr2['0'];
              }
              

              $dates         = $rows['dates'];
              if($dates == '0000-00-00'){
                  $dates ='';
              } else {
                  $postDateArr2   = explode('-', $dates);
                  $dates  = $postDateArr2['2'].'-'.$postDateArr2['1'].'-'.$postDateArr2['0'];
              }

              $partculars    = $rows['partculars'];
              $particulars   = $rows['particulars'];
              $debit         = $rows['debit'];
              $mm            = $rows['mm'];
              $kg            = $rows['kg'];
              $paras         = $rows['paras'];
              $credit        = $rows['credit'];
              $discount      = $rows['discount'];
              $balance       = $rows['balance'];
              $bundil        = $rows['bundil'];
              $total_paras   = $rows['total_paras'];
          }
      }
      
  }
    ?>

<form id="form_edit">
    <!-- <h2 class="ce_header bg-primary">Details Edit</h2> -->
    <input type="hidden" name="rod_details_id" value="<?php echo $rod_details_id; ?>">
    <div class="scrolling-div">                    
            <table border="1" id="detailsEtryTable">
              <tr>
                <td width="150">Customer ID</td>
                <!-- <td width="150">Dealer ID</td> -->
                <td width="120">Motor Cash</td>
                <td width="100">Unload</td>
                <td width="150">Cars rent & Redeem</td>
                <td width="120">Information</td>                  
                <td width="100">Address</td>
                <td width="100">SL No</td>
                <td width="120">Delivery No</td>
                <td width="100">Motor</td>
                <td width="150">Motor No</td>
                <td width="150">Delivery Date</td>
                <td width="150">Date</td>
                <td width="150">Partculars</td>
                <td width="150">Particulars</td>
                <td width="150">Debit</td>
                <td width="150">mm</td>
                <td width="150">Kg</td>
                <td width="150">Para's</td>
                <td width="150">Credit</td>
                <td width="150">Discount</td>
                <td width="150">Balance</td>
                <td width="150">Bundil</td>
                <td width="150">Total Para's</td>
              </tr>
              <tr>
                <td>কাষ্টমার আই ডি</td>
                <!-- <td>ডিলার আই ডি</td> -->
                <td>গাড়ী ভাড়া</td>
                <td>আনলোড</td>
                <td>গাড়ী ভাড়া ও খালাস</td>
                <td>মালের বিবরণ</td>                  
                <td>ঠিকানা</td>
                <td>ক্রমিক নং</td>
                <td>ভাউচার নং</td>
                <td>গাড়ী</td>
                <td>গাড়ী নাম্বার</td>
                <td>ডেলিভারি তারিখ</td>
                <td>তারিখ</td>
                <td>মারফোত নাম</td>
                <td>বিবরণ</td>
                <td>জমা টাকা</td>
                <td>মি.মি.</td>
                <td>কে.জি.</td>
                <td>দর</td>
                <td>মূল</td>
                <td>কমিশন</td>
                <td>অবশিষ্ট</td>
                <td>বান্ডিল</td>
                <td>মোট দাম</td>
              </tr>
              <tr>
                <td>
                  <!-- <input type="text" name="customer_id" class="form-control" id="customer_id" placeholder="Enter customer_id..."> -->
                  <?php
                    $sql = "SELECT customer_id FROM customers";
                    $all_custmr_id = $db->select($sql);
                    echo '<select name="customer_id" id="customer_id_edit" class="form-control" style="width: 140px;">';
                      echo '<option value="none">Select...</option>';
                      if($all_custmr_id->num_rows > 0){
                          while($row = $all_custmr_id->fetch_assoc()){
                            $id = $row['customer_id'];
                            if($customer_id ==  $id){
                              $select = "selected";
                            } else {
                              $select = "";
                            }
                            
                            echo '<option value="' . $id . '"'.$select.'>' . $id . '</option>';
                          }
                        } else{
                          echo '<option value="none">0 Resulst</option>';
                        }
                      echo '</select>';
                  ?>

                </td>
                <!-- <td> -->
                  <!-- <input type="text" name="delear_id" class="form-control" id="delear_id" placeholder="Enter delear_id..."> -->
                  <?php
                    // $sql = "SELECT dealer_id FROM dealers";
                    // $all_custmr_id = $db->select($sql);
                    // echo '<select name="delear_id" id="delear_id_edit" class="form-control" style="width: 140px;">';
                    //   echo '<option value="">Select...</option>';
                    //   if($all_custmr_id->num_rows > 0){
                    //       while($row = $all_custmr_id->fetch_assoc()){
                    //         $id1 = $row['dealer_id'];
                    //         if($dealer_id == $id1){
                    //           $select3 = "selected";
                    //         } else {
                    //           $select3 = "";
                    //         }
                    //         echo '<option value="' . $id1 . '"'. $select3 .'>' . $id1 . '</option>';
                    //       }
                    //     } else{
                    //       echo '<option value="none">0 Result</option>';
                    //     }
                    //   echo '</select>';
                  ?>
                <!-- </td> -->
                <td>
                  <input type="text" name = "motor_cash" class="form-control value-calc_edit" id="motor_cash_edit" placeholder="Enter Motor Cash..." value="<?php echo $motor_cash; ?>">
                </td>
                <td>
                  <input type="text" name ="unload" class="form-control value-calc_edit" id="unload_edit" placeholder="Unload..."  value="<?php echo $unload; ?>">
                </td>
                <td>
                  <input type="text" name = "car_rent_redeem" class="form-control value-calc_edit" id="car_rent_redeem_edit" placeholder="Enter cars rent & redeem..." value="<?php echo $cars_rent_redeem; ?>">
                </td>
                <td>
                  <input type="text" name="information" class="form-control" id="information_edit" placeholder="Enter information..." value="<?php echo $information; ?>">
                </td>
                
                <td>
                  <input type="text" name="address" class="form-control" id="address_edit" placeholder="Enter address..." value="<?php echo $address; ?>">
                </td>
                <td>
                  <input type="text" name="sl_no" class="form-control" id="sl_no_edit" placeholder="Enter SL No..." value="<?php echo $sl_no; ?>">
                </td>
                <td>
                  <input type="text" name="delivery_no" class="form-control" id="delivery_no_edit" placeholder="Enter delivery no..." value="<?php echo $delivery_no; ?>">
                </td>
                <td>
                  <input type="text" name="motor" class="form-control" id="motor_edit" placeholder="Enter number of motor..." value="<?php echo $motor; ?>">
                </td>
                <td>
                  <input type="text" name="motor_no" class="form-control" id="motor_no_edit" placeholder="Enter Motor No..." value="<?php echo $motor_no; ?>">
                </td>
                <td>
                  <input type="text" name="delivery_date" class="form-control" id="delivery_date_edit" placeholder="dd-mm-yy" value="<?php echo $delivery_date; ?>">
                </td>
                <td>
                  <input type="text" name="dates" class="form-control" id="dates_edit" placeholder="dd-mm-yy" value="<?php echo $dates; ?>">
                </td>
                <td>
                  <input type="text" name="partculars" class="form-control" id="partculars_edit" placeholder="Enter partculars..." value="<?php echo $partculars; ?>">
                </td>
                <td>
                  <?php
                    $rod_catgry_sql = "SELECT * FROM rod_category";
                    $rslt_rod_catgry = $db->select($rod_catgry_sql);

                    echo '<select name="paritculars" id="paritculars_edit" class="form-control" style="width: 260px;">';
                    echo '<option value="">Select...</option>';
                    if($rslt_rod_catgry->num_rows > 0){
                          while($row = $rslt_rod_catgry->fetch_assoc()){
                            $rod_category_id = $row['id'];
                            $rod_category_name = $row['category_name'];
                            if($particulars ==  $rod_category_name){
                              $select = "selected";
                            } else {
                              $select = "";
                            }
                            echo '<option style="font-weight: bold;"' . $select . '>'. $rod_category_name . '</option>';

                              $rod_lbl_sql = "SELECT * FROM rod_and_other_label";
                              $rslt_rod_lbl = $db->select($rod_lbl_sql);
                              if($rslt_rod_lbl->num_rows > 0){

                                while($row2 = $rslt_rod_lbl->fetch_assoc()){
                                    $raol_id = $row2['id'];
                                    $raol_rod_label = $row2['rod_label'];
                                    $raol_rod_category_id = $row2['rod_category_id'];
                                    if($rod_category_id == $raol_rod_category_id){
                                        if($particulars ==  $raol_rod_label){
                                            $select1 = "selected";
                                        } else {
                                            $select1 = "";
                                        }
                                        echo "<option value='" . $raol_rod_label . "'".$select1.">" . $raol_rod_label . "</option>";
                                    }
                                  }
                              } else{
                                echo '<option>0 results</option>';
                              }
                          }

                        } else{
                          echo '<option>0 results</option>';
                        }
                    echo '</select> ';
                  ?>

                </td>
                <td>
                  <input type="text" name="debit" class="form-control value-calc_edit" id="debit_edit" placeholder="Enter debit..." value="<?php echo $debit; ?>">
                </td>
                <td>
                  <input type="text" name="mm" class="form-control" id="mm_edit" placeholder="Example '00 mm'..." value="<?php echo $mm; ?>">
                </td>
                <td>
                  <input type="text" name="kg" class="form-control value-calc_edit" id="kg_edit" placeholder="Enter kg..." value="<?php echo $kg; ?>">
                </td>
                <td>
                  <input type="text" name="paras" class="form-control value-calc_edit" id="paras_edit" placeholder="Enter paras..." value="<?php echo $paras; ?>">
                </td>
                <td>
                  <input type="text" name="credit" class="form-control" id="credit_edit" placeholder="Enter credit..." value="<?php echo $credit; ?>">
                </td>
                <td>
                  <input type="text" name="discount" class="form-control" id="discount" placeholder="Enter discount..." value="<?php echo $discount; ?>">
                </td>
                <td>
                  <input type="text" name="balance" class="form-control" id="balance_edit" placeholder="Enter balance..." value="<?php echo $balance; ?>">
                </td>
                <td>
                  <input type="text" name="bundil" class="form-control" id="bundil_edit" placeholder="Enter bundil..." value="<?php echo $bundil; ?>">
                </td>
                <td>
                  <input type="text" name="total_paras" class="form-control" id="total_paras_edit" placeholder="Enter total_paras..." value="<?php echo $total_paras; ?>">
                </td>
                <!-- <td colspan="2"></td> -->
              </tr>               
            </table>
            <h3 class="text-success text-center" id="sucUpdate"><?php echo $sucMsg; ?></h3>
    </div>
      <input onclick="valid('edit')" type="button" name = "submitUpdate" class="btn btn-primary scroll-after-btn" value="Update">
  </form>
