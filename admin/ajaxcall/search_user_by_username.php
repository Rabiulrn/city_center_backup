<?php
require '../config/config.php';
require '../lib/database.php';
$db = new Database();

$usernamePost = $_POST['username'];
// echo $username . "kkkkkkkkkkkkkkkkkk";
if ($usernamePost) {
  $sql = "SELECT * FROM login WHERE username = '$usernamePost'";
  $result = $db->select($sql);
  if ($result) {
    $row = $result->fetch_assoc();
    // var_dump($row);
    //Manzu raj_kajerhisab get from login table
    $fname    = $row['first_name'];
    $lname     = $row['last_name'];
    $username = $row['username'];
    $usertype  = $row['usertype'];
    $mobile    = $row['mobile'];

    $doinik_hisab       = $row['doinik_hisab'];
    $protidiner_hisab  = $row['protidiner_hisab'];
    $modify_data       = $row['modify_data'];
    $joma_khat         = $row['joma_khat'];
    $khoros_khat       = $row['khoros_khat'];
    $khoros_khat_entry = $row['khoros_khat_entry'];
    $nije_pabo         = $row['nije_pabo'];
    $paonader          = $row['paonader'];
    $report            = $row['report'];
    $agrim_hisab       = $row['agrim_hisab'];
    $cash_calculator   = $row['cash_calculator'];
    $raj_kajer_all_hisab   =  $row['raj_kajer_all_hisab'];
    $electric_kroy_bikroy = $row['electric_kroy_bikroy'];
    $rod_hisab         = $row['rod_hisab'];
    $rod_kroy_hisab    = $row['rod_kroy_hisab'];
    $rod_bikroy_hisab  = $row['rod_bikroy_hisab'];
    $rod_category      = $row['rod_category'];
    $rod_dealer        = $row['rod_dealer'];
    $rod_customer      = $row['rod_customer'];
    $rod_buyer         = $row['rod_buyer'];
    $rod_report        = $row['rod_report'];
    $create_user       = $row['create_user'];

    $balu_hisab         = $row['balu_hisab'];
    $balu_kroy_hisab    = $row['balu_kroy_hisab'];
    $balu_bikroy_hisab  = $row['balu_bikroy_hisab'];
    $balu_category      = $row['balu_category'];
    $balu_dealer        = $row['balu_dealer'];
    $balu_customer      = $row['balu_customer'];
    $balu_buyer         = $row['balu_buyer'];
    $balu_report        = $row['balu_report'];
    $balu_stocks        = $row['balu_stocks'];

    $pathor_hisab         = $row['pathor_hisab'];
    $pathor_kroy_hisab    = $row['pathor_kroy_hisab'];
    $pathor_bikroy_hisab  = $row['pathor_bikroy_hisab'];
    $pathor_category      = $row['pathor_category'];
    $pathor_dealer        = $row['pathor_dealer'];
    $pathor_customer      = $row['pathor_customer'];
    $pathor_buyer         = $row['pathor_buyer'];
    // $balu_report        = $row['balu_report'];
    $pathor_stocks       = $row['pathor_stocks'];

    $cement_hisab         = $row['cement_hisab'];
    $cement_kroy_hisab    = $row['cement_kroy_hisab'];
    $cement_bikroy_hisab  = $row['cement_bikroy_hisab'];
    $cement_category      = $row['cement_category'];
    $cement_dealer        = $row['cement_dealer'];
    $cement_customer      = $row['cement_customer'];
    $cement_buyer         = $row['cement_buyer'];
    // $balu_report        = $row['balu_report'];
    $cement_stocks       = $row['cement_stocks'];
    $cement_report       = $row['cement_report'];


    $edit_data    = $row['edit_data'];
    $delete_data  = $row['delete_data'];

    $project_name_id = $row['project_name_id'];
    $verification     = $row['verification'];
  }
}



?>




<div class="form-control">
  <label><span class="frmLbl">Name: </span><?php echo ucfirst($fname) . " " . ucfirst($lname); ?></label>
</div>
<div class="form-control">
  <label><span class="frmLbl">Mobile: </span><?php echo $mobile; ?></label>
</div>
<div class="form-control">
  <label><span class="frmLbl">User Type: </span><?php echo ucfirst($usertype); ?></label>
</div>
<div class="form-control">
  <label><span class="frmLbl">Email Verified: </span><?php echo ucfirst($verification); ?></label>
</div>



<div class="form-control" style="height: unset;" id="project_con">
  <label style="margin: 0px;">
    <span class="frmLbl">Project Name:
      <div class="" style="display: inline-block;">
        <?php
        $hsql = "SELECT id, heading FROM project_heading";
        $h_result = $db->select($hsql);
        // var_dump($result);
        $datas = array();
        $sizes = 0;
        if ($result) {
          while ($rows = $h_result->fetch_assoc()) {
            $datas[$sizes]['id']          = $rows['id'];
            $datas[$sizes]['heading']     = $rows['heading'];
            $sizes++;
          }
        }
        // echo "<pre>";
        // var_dump($datas);
        ?>
        <select id="p_heading_list" name="p_heading_list[]" multiple="multiple" style="padding: 2px; display: inline-block;">
          <!-- <option value="none">Select one...</option> -->
          <?php
          if ($datas) {
            // if($project_name_id == 0){
            // echo '<option value="0">None...</option>';
            // }
            foreach ($datas as $row) {
              $p_id = $row['id'];
              $project_heading = $row['heading'];

              $sel = '';
              $categories = '';
              $pids = explode(",", $project_name_id);
              foreach ($pids as $pid) {
                if ($p_id == trim($pid)) {
                  $sel = 'selected';
                }
              }
              echo '<option value = "' . $p_id . '" ' . $sel . '>' . $project_heading . '</option>';
            }
          }
          ?>
        </select>
        <?php

        ?>
      </div>
    </span></label>
</div>





<div class="inpCheck">
  <div class="allowP">Allowable pages:</div>
  <div class="pageCollumn line" id="left-col">
    <div class="pagename" style="margin-right: 15px;">দৈনিক হিসাব</div>
    <!-- <div class="check-group">
        <label>
            <input type="checkbox" name="doinik_hisab" id="doinik_hisab" onchange="checkUncheck(this)" value="<?php //echo $doinik_hisab;
                                                                                                              ?>" <?php //echo ($doinik_hisab == 'yes' ? 'checked' : '');
                                                                                                                                              ?>> দৈনিক হিসাব
<<<<<<< HEAD
=======
        </label>
      </div> -->
    <div class="check-group">
      <label>
        <input type="checkbox" name="protidiner_hisab" id="protidiner_hisab" onchange="checkUncheck(this)" value="<?php echo $protidiner_hisab; ?>" <?php echo ($protidiner_hisab == 'yes' ? 'checked' : ''); ?>> প্রতিদিনের হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="modify_data" id="modify_data" onchange="checkUncheck(this)" value="<?php echo $modify_data; ?>" <?php echo ($modify_data == 'yes' ? 'checked' : ''); ?>> মডিফাই ডাটা
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="joma_khat" id="joma_khat" onchange="checkUncheck(this)" value="<?php echo $joma_khat; ?>" <?php echo ($joma_khat == 'yes' ? 'checked' : ''); ?>> জমা খাত এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="khoros_khat" id="khoros_khat" onchange="checkUncheck(this)" value="<?php echo $khoros_khat; ?>" <?php echo ($khoros_khat == 'yes' ? 'checked' : ''); ?>> খরচ খাতের হেডার
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="khoros_khat_entry" id="khoros_khat_entry" onchange="checkUncheck(this)" value="<?php echo $khoros_khat_entry; ?>" <?php echo ($khoros_khat_entry == 'yes' ? 'checked' : ''); ?>>
        খরচ খাত এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="nije_pabo" id="nije_pabo" onchange="checkUncheck(this)" value="<?php echo $nije_pabo; ?>" <?php echo ($nije_pabo == 'yes' ? 'checked' : ''); ?>> নিজে পাবো এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="paonader" id="paonader" onchange="checkUncheck(this)" value="<?php echo $paonader; ?>" <?php echo ($paonader == 'yes' ? 'checked' : ''); ?>> পাওনাদার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="report" id="report" onchange="checkUncheck(this)" value="<?php echo $report; ?>" <?php echo ($report == 'yes' ? 'checked' : ''); ?>> রিপোর্ট
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="agrim_hisab" id="agrim_hisab" onchange="checkUncheck(this)" value="<?php echo $agrim_hisab; ?>" <?php echo ($agrim_hisab == 'yes' ? 'checked' : ''); ?>> অগ্রিম হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cash_calculator" id="cash_calculator" onchange="checkUncheck(this)" value="<?php echo $cash_calculator; ?>" <?php echo ($cash_calculator == 'yes' ? 'checked' : ''); ?>> ক্যাশ ক্যালকুলেটর
      </label>
    </div>
    <!--  =======Added by manzu========== -->
    <div class="check-group">
      <label>
        <input type="checkbox" name="raj_kajer_all_hisab" id="raj_kajer_all_hisab" onchange="checkUncheck(this)" value="<?php echo $raj_kajer_all_hisab; ?>" <?php echo ($raj_kajer_all_hisab == 'yes' ? 'checked' : ''); ?>> রাজ কাজের হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="electric_kroy_bikroy" id="electric_kroy_bikroy" onchange="checkUncheck(this)" value="<?php echo $electric_kroy_bikroy; ?>" <?php echo ($electric_kroy_bikroy == 'yes' ? 'checked' : ''); ?>> ইলেকট্রিক মালামাল ক্রয় হিসাব
      </label>
    </div>


    <div class="pagename" style="margin-right: 15px;">পাথর হিসাব</div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_kroy_hisab" id="pathor_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $pathor_kroy_hisab; ?>" <?php echo ($pathor_kroy_hisab == 'yes' ? 'checked' : ''); ?>> ক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_bikroy_hisab" id="pathor_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $pathor_bikroy_hisab; ?>" <?php echo ($pathor_bikroy_hisab == 'yes' ? 'checked' : ''); ?>> বিক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_category" id="pathor_category" onchange="checkUncheck(this)" value="<?php echo $pathor_category; ?>" <?php echo ($pathor_category == 'yes' ? 'checked' : ''); ?>> ক্যাটাগরি এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_dealer" id="pathor_dealer" onchange="checkUncheck(this)" value="<?php echo $pathor_dealer; ?>" <?php echo ($pathor_dealer == 'yes' ? 'checked' : ''); ?>> ডিলার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_customer" id="pathor_customer" onchange="checkUncheck(this)" value="<?php echo $pathor_customer; ?>" <?php echo ($pathor_customer == 'yes' ? 'checked' : ''); ?>> কাস্টমার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_buyer" id="pathor_buyer" onchange="checkUncheck(this)" value="<?php echo $pathor_buyer; ?>" <?php echo ($pathor_buyer == 'yes' ? 'checked' : ''); ?>> বায়ার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_stocks" id="pathor_stocks" onchange="checkUncheck(this)" value="<?php echo $pathor_stocks; ?>" <?php echo ($pathor_stocks == 'yes' ? 'checked' : ''); ?>> স্টক তথ্য
      </label>
    </div>
    <!-- <div class="check-group">
        <label>
            <input type="checkbox" name="pathor_report" id="balu_report" onchange="checkUncheck(this)" value="<?php echo $pathor_report; ?>" <?php echo ($pathor_report == 'yes' ? 'checked' : ''); ?>> রিপোর্ট
>>>>>>> c2e6b74e9e1f9b0e033ac7e32667bfe7a79d57a1
        </label>
      </div> -->
    <div class="check-group">
      <label>
        <input type="checkbox" name="protidiner_hisab" id="protidiner_hisab" onchange="checkUncheck(this)" value="<?php echo $protidiner_hisab; ?>" <?php echo ($protidiner_hisab == 'yes' ? 'checked' : ''); ?>> প্রতিদিনের হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="modify_data" id="modify_data" onchange="checkUncheck(this)" value="<?php echo $modify_data; ?>" <?php echo ($modify_data == 'yes' ? 'checked' : ''); ?>> মডিফাই ডাটা
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="joma_khat" id="joma_khat" onchange="checkUncheck(this)" value="<?php echo $joma_khat; ?>" <?php echo ($joma_khat == 'yes' ? 'checked' : ''); ?>> জমা খাত এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="khoros_khat" id="khoros_khat" onchange="checkUncheck(this)" value="<?php echo $khoros_khat; ?>" <?php echo ($khoros_khat == 'yes' ? 'checked' : ''); ?>> খরচ খাতের হেডার
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="khoros_khat_entry" id="khoros_khat_entry" onchange="checkUncheck(this)" value="<?php echo $khoros_khat_entry; ?>" <?php echo ($khoros_khat_entry == 'yes' ? 'checked' : ''); ?>>
        খরচ খাত এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="nije_pabo" id="nije_pabo" onchange="checkUncheck(this)" value="<?php echo $nije_pabo; ?>" <?php echo ($nije_pabo == 'yes' ? 'checked' : ''); ?>> নিজে পাবো এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="paonader" id="paonader" onchange="checkUncheck(this)" value="<?php echo $paonader; ?>" <?php echo ($paonader == 'yes' ? 'checked' : ''); ?>> পাওনাদার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="report" id="report" onchange="checkUncheck(this)" value="<?php echo $report; ?>" <?php echo ($report == 'yes' ? 'checked' : ''); ?>> রিপোর্ট
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="agrim_hisab" id="agrim_hisab" onchange="checkUncheck(this)" value="<?php echo $agrim_hisab; ?>" <?php echo ($agrim_hisab == 'yes' ? 'checked' : ''); ?>> অগ্রিম হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cash_calculator" id="cash_calculator" onchange="checkUncheck(this)" value="<?php echo $cash_calculator; ?>" <?php echo ($cash_calculator == 'yes' ? 'checked' : ''); ?>> ক্যাশ ক্যালকুলেটর
      </label>
    </div>
    <!--  =======Added by manzu========== -->
    <div class="check-group">
      <label>
        <input type="checkbox" name="raj_kajer_all_hisab" id="raj_kajer_all_hisab" onchange="checkUncheck(this)" value="<?php echo $raj_kajer_all_hisab; ?>" <?php echo ($raj_kajer_all_hisab == 'yes' ? 'checked' : ''); ?>> রাজ কাজের হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="electric_kroy_bikroy" id="electric_kroy_bikroy" onchange="checkUncheck(this)" value="<?php echo $electric_kroy_bikroy; ?>" <?php echo ($electric_kroy_bikroy == 'yes' ? 'checked' : ''); ?>> ইলেকট্রিক মালামাল ক্রয় হিসাব
      </label>
    </div>


    <div class="pagename" style="margin-right: 15px;">পাথর হিসাব</div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_kroy_hisab" id="pathor_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $pathor_kroy_hisab; ?>" <?php echo ($pathor_kroy_hisab == 'yes' ? 'checked' : ''); ?>> ক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_bikroy_hisab" id="pathor_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $pathor_bikroy_hisab; ?>" <?php echo ($pathor_bikroy_hisab == 'yes' ? 'checked' : ''); ?>> বিক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_category" id="pathor_category" onchange="checkUncheck(this)" value="<?php echo $pathor_category; ?>" <?php echo ($pathor_category == 'yes' ? 'checked' : ''); ?>> ক্যাটাগরি এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_dealer" id="pathor_dealer" onchange="checkUncheck(this)" value="<?php echo $pathor_dealer; ?>" <?php echo ($pathor_dealer == 'yes' ? 'checked' : ''); ?>> ডিলার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_customer" id="pathor_customer" onchange="checkUncheck(this)" value="<?php echo $pathor_customer; ?>" <?php echo ($pathor_customer == 'yes' ? 'checked' : ''); ?>> কাস্টমার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_buyer" id="pathor_buyer" onchange="checkUncheck(this)" value="<?php echo $pathor_buyer; ?>" <?php echo ($pathor_buyer == 'yes' ? 'checked' : ''); ?>> বায়ার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="pathor_stocks" id="pathor_stocks" onchange="checkUncheck(this)" value="<?php echo $pathor_stocks; ?>" <?php echo ($pathor_stocks == 'yes' ? 'checked' : ''); ?>> স্টক তথ্য
      </label>
    </div>
    <div class="check-group">
        <label>
            <input type="checkbox" name="pathor_report" id="balu_report" onchange="checkUncheck(this)" value="<?php echo $pathor_report; ?>" <?php echo ($pathor_report == 'yes' ? 'checked' : ''); ?>> রিপোর্ট
        </label>
      </div>





      <div class="pagename" style="margin-right: 15px;">সিমেন্ট হিসাব</div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_kroy_hisab" id="cement_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $cement_kroy_hisab; ?>" <?php echo ($cement_kroy_hisab == 'yes' ? 'checked' : ''); ?>> ক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_bikroy_hisab" id="cement_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $cement_bikroy_hisab; ?>" <?php echo ($cement_bikroy_hisab == 'yes' ? 'checked' : ''); ?>> বিক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_category" id="cement_category" onchange="checkUncheck(this)" value="<?php echo $cement_category; ?>" <?php echo ($cement_category == 'yes' ? 'checked' : ''); ?>> ক্যাটাগরি এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_dealer" id="cement_dealer" onchange="checkUncheck(this)" value="<?php echo $cement_dealer; ?>" <?php echo ($cement_dealer == 'yes' ? 'checked' : ''); ?>> ডিলার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_customer" id="cement_customer" onchange="checkUncheck(this)" value="<?php echo $cement_customer; ?>" <?php echo ($cement_customer == 'yes' ? 'checked' : ''); ?>> কাস্টমার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_buyer" id="cement_buyer" onchange="checkUncheck(this)" value="<?php echo $cement_buyer; ?>" <?php echo ($cement_buyer == 'yes' ? 'checked' : ''); ?>> বায়ার এন্ট্রি
      </label>
    </div>
    <!-- <div class="check-group">
      <label>
        <input type="checkbox" name="cement_stocks" id="cement_stocks" onchange="checkUncheck(this)" value="<?php echo $cement_stocks; ?>" <?php echo ($cement_stocks == 'yes' ? 'checked' : ''); ?>> স্টক তথ্য
      </label>
    </div> -->
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_report" id="cement_report" onchange="checkUncheck(this)" value="<?php echo $cement_report; ?>" <?php echo ($cement_report == 'yes' ? 'checked' : ''); ?>>  রিপোর্ট
      </label>
    </div>



      <div class="pagename" style="margin-right: 15px;">সিমেন্ট হিসাব</div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_kroy_hisab" id="cement_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $cement_kroy_hisab; ?>" <?php echo ($cement_kroy_hisab == 'yes' ? 'checked' : ''); ?>> ক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_bikroy_hisab" id="cement_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $cement_bikroy_hisab; ?>" <?php echo ($cement_bikroy_hisab == 'yes' ? 'checked' : ''); ?>> বিক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_category" id="cement_category" onchange="checkUncheck(this)" value="<?php echo $cement_category; ?>" <?php echo ($cement_category == 'yes' ? 'checked' : ''); ?>> ক্যাটাগরি এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_dealer" id="cement_dealer" onchange="checkUncheck(this)" value="<?php echo $cement_dealer; ?>" <?php echo ($cement_dealer == 'yes' ? 'checked' : ''); ?>> ডিলার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_customer" id="cement_customer" onchange="checkUncheck(this)" value="<?php echo $cement_customer; ?>" <?php echo ($cement_customer == 'yes' ? 'checked' : ''); ?>> কাস্টমার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_buyer" id="cement_buyer" onchange="checkUncheck(this)" value="<?php echo $cement_buyer; ?>" <?php echo ($cement_buyer == 'yes' ? 'checked' : ''); ?>> বায়ার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_stocks" id="cement_stocks" onchange="checkUncheck(this)" value="<?php echo $cement_stocks; ?>" <?php echo ($cement_stocks == 'yes' ? 'checked' : ''); ?>> স্টক তথ্য
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="cement_report" id="cement_report" onchange="checkUncheck(this)" value="<?php echo $cement_report; ?>" <?php echo ($cement_report == 'yes' ? 'checked' : ''); ?>> স্ত
      </label>
    </div>

  </div>

  <div class="pageCollumn" id="right-col">
    <div class="pagename">রড হিসাব</div>
    <!-- <div class="check-group">
        <label>
            <input type="checkbox" name="rod_hisab" id="rod_hisab" onchange="checkUncheck(this)" value="<?php //echo $rod_hisab; 
                                                                                                        ?>" <?php //echo ($rod_hisab == 'yes' ? 'checked' : '');
                                                                                                                                      ?>> রড হিসাব
        </label>
      </div> -->

    <div class="check-group">
      <label>
        <input type="checkbox" name="rod_kroy_hisab" id="rod_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $rod_kroy_hisab; ?>" <?php echo ($rod_kroy_hisab == 'yes' ? 'checked' : ''); ?>> ক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="rod_bikroy_hisab" id="rod_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $rod_bikroy_hisab; ?>" <?php echo ($rod_bikroy_hisab == 'yes' ? 'checked' : ''); ?>> বিক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="rod_category" id="rod_category" onchange="checkUncheck(this)" value="<?php echo $rod_category; ?>" <?php echo ($rod_category == 'yes' ? 'checked' : ''); ?>> ক্যাটাগরি এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="rod_dealer" id="rod_dealer" onchange="checkUncheck(this)" value="<?php echo $rod_dealer; ?>" <?php echo ($rod_dealer == 'yes' ? 'checked' : ''); ?>> ডিলার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="rod_customer" id="rod_customer" onchange="checkUncheck(this)" value="<?php echo $rod_customer; ?>" <?php echo ($rod_customer == 'yes' ? 'checked' : ''); ?>> কাস্টমার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="rod_buyer" id="rod_buyer" onchange="checkUncheck(this)" value="<?php echo $rod_buyer; ?>" <?php echo ($rod_buyer == 'yes' ? 'checked' : ''); ?>> বায়ার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="rod_report" id="rod_report" onchange="checkUncheck(this)" value="<?php echo $rod_report; ?>" <?php echo ($rod_report == 'yes' ? 'checked' : ''); ?>> রিপোর্ট
      </label>
    </div>

    <!-- balu hisab -->
    <div class="pagename">বালু হিসাব</div>
    <!-- <div class="check-group">
        <label>
            <input type="checkbox" name="rod_hisab" id="rod_hisab" onchange="checkUncheck(this)" value="<?php //echo $rod_hisab; 
                                                                                                        ?>" <?php //echo ($rod_hisab == 'yes' ? 'checked' : '');
                                                                                                                                      ?>> রড হিসাব
        </label>
      </div> -->

    <div class="check-group">
      <label>
        <input type="checkbox" name="balu_kroy_hisab" id="balu_kroy_hisab" onchange="checkUncheck(this)" value="<?php echo $balu_kroy_hisab; ?>" <?php echo ($balu_kroy_hisab == 'yes' ? 'checked' : ''); ?>> ক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="balu_bikroy_hisab" id="balu_bikroy_hisab" onchange="checkUncheck(this)" value="<?php echo $balu_bikroy_hisab; ?>" <?php echo ($balu_bikroy_hisab == 'yes' ? 'checked' : ''); ?>> বিক্রয় হিসাব
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="balu_category" id="balu_category" onchange="checkUncheck(this)" value="<?php echo $balu_category; ?>" <?php echo ($balu_category == 'yes' ? 'checked' : ''); ?>> ক্যাটাগরি এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="balu_dealer" id="balu_dealer" onchange="checkUncheck(this)" value="<?php echo $balu_dealer; ?>" <?php echo ($balu_dealer == 'yes' ? 'checked' : ''); ?>> ডিলার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="balu_customer" id="balu_customer" onchange="checkUncheck(this)" value="<?php echo $balu_customer; ?>" <?php echo ($balu_customer == 'yes' ? 'checked' : ''); ?>> কাস্টমার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="balu_buyer" id="balu_buyer" onchange="checkUncheck(this)" value="<?php echo $balu_buyer; ?>" <?php echo ($balu_buyer == 'yes' ? 'checked' : ''); ?>> বায়ার এন্ট্রি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="balu_report" id="balu_report" onchange="checkUncheck(this)" value="<?php echo $balu_report; ?>" <?php echo ($balu_report == 'yes' ? 'checked' : ''); ?>> রিপোর্ট
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="balu_stocks" id="balu_stocks" onchange="checkUncheck(this)" value="<?php echo $balu_stocks; ?>" <?php echo ($balu_stocks == 'yes' ? 'checked' : ''); ?>> স্টক তথ্য
      </label>
    </div>

    <div class="pagename" style="margin-right: 15px;">অন্যান্ন</div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="create_user" id="create_user" onchange="checkUncheck(this)" value="<?php echo $create_user; ?>" <?php echo ($create_user == 'yes' ? 'checked' : ''); ?>> Create User
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="edit_data" id="edit_data" onchange="checkUncheck(this)" value="<?php echo $edit_data; ?>" <?php echo ($edit_data == 'yes' ? 'checked' : ''); ?>> আপডেট অনুমতি
      </label>
    </div>
    <div class="check-group">
      <label>
        <input type="checkbox" name="delete_data" id="delete_data" onchange="checkUncheck(this)" value="<?php echo $delete_data; ?>" <?php echo ($delete_data == 'yes' ? 'checked' : ''); ?>> ডিলেট অনুমতি
      </label>
    </div>
  </div>
</div>

<div style="margin: 20px 0px 0px; float: left; width: 100%;">
  <input type="button" class="btn btn-primary btn-block" name="sumbit" id="submitBtnId" value="Save" />
</div>