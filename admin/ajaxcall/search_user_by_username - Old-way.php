<?php
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();


    $usernamePost = $_POST['username'];
    // echo $username . "kkkkkkkkkkkkkkkkkk";
    if($usernamePost){
    	
    	$sql = "SELECT * FROM login WHERE username = '$usernamePost'";
    	$result = $db->select($sql);
    	if($result){
    		$row = $result->fetch_assoc();			
    		// var_dump($row);
			
			$fname		= $row['first_name'];
			$lname 		= $row['last_name'];
			$username 	= $row['username'];
			$usertype	= $row['usertype'];
			$mobile		= $row['mobile'];			

			$home			    = $row['home'];
      $doinik_hisab = $row['doinik_hisab'];
			$joma_khat		= $row['joma_khat'];
			$khoros_khat	= $row['khoros_khat'];
			$nije_pabo		= $row['nije_pabo'];
			$paonader		  = $row['paonader'];
			$modify_data	= $row['modify_data'];
      $rod_hisab    = $row['modify_data'];
			$create_user	= $row['rod_hisab'];
      $project_name_id = $row['project_name_id'];

			$verification	= $row['verification'];
    	}
    }


 
?>




<div class="form-control">
  <label><span class="frmLbl">Name: </span><?php echo ucfirst($fname)." ".ucfirst($lname); ?></label>
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



<div class="form-control">
  <label>
    <span class="frmLbl">Project Name: 
    <div class="" style="display: inline-block;">
      <?php
          $hsql = "SELECT id, heading FROM project_heading";
          $h_result = $db->select($hsql);
          // var_dump($result);
          $datas=array();
          $sizes=0;
          if($result){
            while ($rows= $h_result->fetch_assoc()) {
                $datas[$sizes]['id']          = $rows['id'];
                $datas[$sizes]['heading']     = $rows['heading'];
                
                $sizes++;
            }
          }
          // echo "<pre>";
          // var_dump($datas);
      ?>                
      <select id='p_heading_list' style="padding: 2px; display: inline-block;">
          <!-- <option value="none">Select one...</option> -->
          <?php
            if($datas){
              if($project_name_id == 0){
                  echo '<option value="none">Select one...</option>';
              }
              foreach($datas as $row) {
                 $p_id = $row['id'];
                 $project_heading = $row['heading'];

                 $sel ='';
                             
                 if($p_id == $project_name_id){
                    $sel = 'selected';
                  }
                 echo '<option value = "'.$p_id.'" '.$sel.'>'.$project_heading.'</option>';
                
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
  <div class="check-group">
    <label>
        <input type="checkbox" name="" id="home" value="<?php echo $home;?>" <?php echo ($home == 'yes' ? 'checked' : '');?>> Home
    </label>
  </div>
  <div class="check-group">
    <label>
        <input type="checkbox" name="" id="doinik_hisab" value="<?php echo $doinik_hisab;?>" <?php echo ($doinik_hisab == 'yes' ? 'checked' : '');?>> দৈনিক হিসাব
    </label>
  </div>
  <div class="check-group">
    <label>
        <input type="checkbox" name="" id="joma_khat" value="<?php echo $joma_khat;?>" <?php echo ($joma_khat == 'yes' ? 'checked' : '');?>> জমা খাত
    </label>
  </div>
  <div class="check-group">
    <label>
        <input type="checkbox" name="" id="khoros_khat" value="<?php echo $khoros_khat;?>" <?php echo ($khoros_khat == 'yes' ? 'checked' : '');?>> খরচ খাত
    </label>
  </div>
  <div class="check-group">
    <label>
      <input type="checkbox" name="" id="nije_pabo" value="<?php echo $nije_pabo;?>" <?php echo ($nije_pabo == 'yes' ? 'checked' : '');?>> নিজে পাবো
    </label>
  </div>
  <div class="check-group">
    <label>
        <input type="checkbox" name="" id="paonader" value="<?php echo $paonader;?>" <?php echo ($paonader == 'yes' ? 'checked' : '');?>> পাওনাদার
    </label>
  </div>
  <div class="check-group">
    <label>
        <input type="checkbox" name="" id="modify_data" value="<?php echo $modify_data;?>" <?php echo ($modify_data == 'yes' ? 'checked' : '');?>> Modify Data
    </label>
  </div>
  <div class="check-group">
    <label>
        <input type="checkbox" name="" id="rod_hisab" value="<?php echo $rod_hisab; ?>" <?php echo ($rod_hisab == 'yes' ? 'checked' : '');?>> রড হিসাব
    </label>
  </div>
  <div class="check-group">
    <label>
        <input type="checkbox" name="" id="create_user" value="<?php echo $create_user;?>" <?php echo ($create_user == 'yes' ? 'checked' : '');?>> Create User
    </label>
  </div>
</div>

<div style="margin: 20px 0px 0px; float: left; width: 100%;" >
    <input type="submit" class="btn btn-primary btn-block" name="sumbit" id="submitBtnId" value="Save" />
</div>
