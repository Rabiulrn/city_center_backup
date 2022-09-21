<?php 
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php'); 
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $_SESSION['pageName'] = 'user_permision_by_admin';
?>


<!DOCTYPE html>
<html>
<head>
  <title>User Page Permission</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/voucher.css">
  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  <style type="text/css">    
      .info-con{
          width: 50%;
          padding: 25px;
          border: 2px solid #ddd;
          float: left;
          position: relative;
          left: 50%;
          margin-left: -25%;
          margin-bottom: 100px;
      }
      #infoByUser{
        /*float: left;*/
      }
      #infoByUser .form-control{
        margin-top: 10px;
      }
      .inpCheck::placeholder {
          color: #999;
          opacity: 1;
      }
      .inpCheck:focus {
          border-color: #66afe9;
          outline: 0;
          -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
      }
      .inpCheck {
          float: left;
          display: block;
          width: 100%;
          /*height: 34px;*/
          margin-top: 10px;
          padding: 6px 12px 6px 35px;
          font-size: 14px;
          line-height: 1.42857143;
          color: #555;
          background-color: #fff;
          background-image: none;
          border: 1px solid #ccc;
          border-top-color: rgb(204, 204, 204);
          border-right-color: rgb(204, 204, 204);
          border-bottom-color: rgb(204, 204, 204);
          border-left-color: rgb(204, 204, 204);
          border-radius: 4px;
          -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
          -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
          -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
      }
      .check-group{
        width: 100%;
        /*float: left;*/
      }
      .allowP{
        margin-left: -20px;
        display: block;
        font-weight: bold;
        font-size: 14px;
        padding-bottom: 3px;
        border-bottom: 2px solid #969696;
        margin-bottom: 10px;
      }
      .lblStyle{
        color: green;
        cursor: pointer;
        user-select: none;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
      }
      .select2-container{
        width: 388px !important;
        
      }
      .select2-selection{
        min-height: 62px !important;
      }
      .pageCollumn{
          width: 49%;
          /*border: 1px solid red;*/
          /*height: 50px;*/
          float: left;
      }
      .line {
          border-right: 2px solid #ccc;
          margin-right: 2%;
      }
      #rod_category{
        min-width: unset;
      }
      .pagename{
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        border-bottom: 2px solid #ddd;
        margin-bottom: 10px;
        border-bottom-length: 50px;
      }
  </style>
  <script>
          function checkUncheck(element){
                console.log(element);
                var attributeTest = $(element).is(':checked'); //Input checked or ot
                // alert(attributeTest);
                if(attributeTest==true){
                  $(element).val("yes");
                  $(element).parent().addClass("lblStyle");
                } else {
                  $(element).val("no");
                  $(element).parent().removeClass("lblStyle");
                }
            }
            // $(document).on('change','#home', function(){
                  // var attributeTest = $(this).is(':checked'); //Input checked or ot
                  // alert(attributeTest);
                  // if(attributeTest==true){
                  //   $(this).val("yes");
                  //   $(this).parent().addClass("lblStyle");
                  // } else {
                  //   $(this).val("no");
                  //   $(this).parent().removeClass("lblStyle");
                  // }
            // });
     

            // function changeProjectName(data, data2){
            //   $.ajax({
            //     url: "../ajaxcall/change_project_name.php",
            //     type: "post",
            //     data: {
            //         project_name_id : data,
            //         user_name: data2,
            //     },
            //     success: function(res){
            //         // alert(res);
            //     },
            //     error: function(jqXHR, textStatus, errorThrown){
            //         console.log(textStatus, errorThrown);
            //     }
            //   });
            // }

            // $(document).on('change','#p_heading_list', function(){
            //     var project_name_id = $(this).val();
                
            //     var username = $('#select_user').val();
            //     // alert(project_name_id);
            //       changeProjectName(project_name_id, username);
            // });


            function getUserByUsername(data){
              $.ajax({
                url: "../ajaxcall/search_user_by_username.php",
                type: "post",
                data: {
                  username : data,
                },
                success: function(res){
                    // alert(res);                  
                    $('#infoByUser').html(res);
                    $('input[type="checkbox"]').css("cursor","pointer").parent().css("cursor","pointer");
                    $('input[type="checkbox"]:checked').parent().addClass("lblStyle");
                    $('#p_heading_list').select2({
                        placeholder: 'প্রজেক্ট নির্বাচন করতে এখানে ক্লিক করুন',
                        // allowClear: true,
                    });
                    collumn_height();
                },
                error: function(jqXHR, textStatus, errorThrown){
                  console.log(textStatus, errorThrown);
                }
              });
            }
            
            $(document).on('change','#select_user', function(){
                var username = $(this).val();
                // alert(username);
                if(username == 'none'){
                  window.location.href = 'user_permission_by_admin.php';
                } else{
                  getUserByUsername(username);
                  // alert(username);                 
                }
            });

            
// manzu add raj_kajer_all_hisab here 
            function userAccessUpdate(username, project_name_id, protidiner_hisab, modify_data, joma_khat, khoros_khat, khoros_khat_entry, nije_pabo, paonader, report, agrim_hisab, cash_calculator,raj_kajer_all_hisab,electric_kroy_bikroy, rod_kroy_hisab, rod_bikroy_hisab, rod_category, rod_dealer, rod_customer, rod_buyer, rod_report,balu_kroy_hisab, balu_bikroy_hisab, balu_category, balu_dealer, balu_customer, balu_buyer, balu_report, balu_stocks,  
            pathor_kroy_hisab, pathor_bikroy_hisab, pathor_category, pathor_dealer, pathor_customer, pathor_buyer, pathor_stocks,
            cement_kroy_hisab, cement_bikroy_hisab, cement_category, cement_dealer, cement_customer, cement_buyer, cement_stocks,cement_report,
            create_user, edit_data, delete_data){
                $.ajax({
                url: "../ajaxcall_save_update/allow_page_access_update.php",
                type: "post",
                data: {
                    username        : username,
                    project_name_id : project_name_id,
                    protidiner_hisab: protidiner_hisab,
                    modify_data     : modify_data,
                    joma_khat       : joma_khat,
                    khoros_khat     : khoros_khat,
                    khoros_khat_entry: khoros_khat_entry,
                    nije_pabo       : nije_pabo,
                    paonader        : paonader,
                    report          : report,
                    agrim_hisab     : agrim_hisab,
                    cash_calculator : cash_calculator,
                    raj_kajer_all_hisab  : raj_kajer_all_hisab,
                    electric_kroy_bikroy:electric_kroy_bikroy,
                    rod_kroy_hisab  : rod_kroy_hisab,
                    rod_bikroy_hisab: rod_bikroy_hisab,
                    rod_category    : rod_category,
                    rod_dealer      : rod_dealer,
                    rod_customer    : rod_customer,
                    rod_buyer       : rod_buyer,
                    rod_report      : rod_report,
                    balu_kroy_hisab  : balu_kroy_hisab,
                    balu_bikroy_hisab: balu_bikroy_hisab,
                    balu_category    : balu_category,
                    balu_dealer      : balu_dealer,
                    balu_customer    : balu_customer,
                    balu_buyer       : balu_buyer,
                    balu_report      : balu_report,
                    balu_stocks      : balu_stocks,
                    pathor_kroy_hisab  : pathor_kroy_hisab,
                    pathor_bikroy_hisab: pathor_bikroy_hisab,
                    pathor_category    : pathor_category,
                    pathor_dealer      : pathor_dealer,
                    pathor_customer    : pathor_customer,
                    pathor_buyer       : pathor_buyer,
                    pathor_stocks       : pathor_stocks,
                    cement_kroy_hisab  : cement_kroy_hisab,
                    cement_bikroy_hisab: cement_bikroy_hisab,
                    cement_category    : cement_category,
                    cement_dealer      : cement_dealer,
                    cement_customer    : cement_customer,
                    cement_buyer       : cement_buyer,
                    cement_stocks       : cement_stocks,
                    cement_report       : cement_report,
                    // pathor_report      : pathor_report,
                    create_user     : create_user,
                    edit_data       : edit_data,
                    delete_data     : delete_data
                },
                success: function(res){
                    alert(res);

                    // getUserByUsername(username);              
                    // $('#infoByUser').html(res);
                    // $('input[type="checkbox"]').css("cursor","pointer").parent().css("cursor","pointer");
                    // $('input[type="checkbox"]:checked').parent().addClass("lblStyle");
                },
                error: function(jqXHR, textStatus, errorThrown){
                  console.log(textStatus, errorThrown);
                }
              });
            }
            $(document).on('click','#submitBtnId', function(){
                var username        = $('#select_user option:selected').val();
                alert(username);
                // var project_name_id = $('#p_heading_list option:selected').val();
                var project_name_id = $("#p_heading_list option:selected").map(function(){ return this.value }).get().join(",");
                // alert(project_name_id);
                // manzu add raj_kajer_all_hisab here 
                // var doinik_hisab      = $('#doinik_hisab').val();
                var protidiner_hisab  = $('#protidiner_hisab').val();
                var modify_data       = $('#modify_data').val();
                var joma_khat         = $('#joma_khat').val();
                var khoros_khat       = $('#khoros_khat').val();
                var khoros_khat_entry = $('#khoros_khat_entry').val();
                var nije_pabo         = $('#nije_pabo').val();
                var paonader          = $('#paonader').val();
                var report            = $('#report').val();
                var agrim_hisab       = $('#agrim_hisab').val();
                var cash_calculator   = $('#cash_calculator').val();
                var raj_kajer_all_hisab    = $('#raj_kajer_all_hisab').val();
                var electric_kroy_bikroy = $('#electric_kroy_bikroy').val();
                // var rod_hisab     = $('#rod_hisab').val();
                var rod_kroy_hisab    = $('#rod_kroy_hisab').val();
                var rod_bikroy_hisab  = $('#rod_bikroy_hisab').val();
                var rod_category      = $('#rod_category').val();
                var rod_dealer        = $('#rod_dealer').val();
                var rod_customer      = $('#rod_customer').val();
                var rod_buyer         = $('#rod_buyer').val();
                var rod_report        = $('#rod_report').val();
            
                var balu_kroy_hisab    = $('#balu_kroy_hisab').val();
                var balu_bikroy_hisab  = $('#balu_bikroy_hisab').val();
                var balu_category      = $('#balu_category').val();
                var balu_dealer        = $('#balu_dealer').val();
                var balu_customer      = $('#balu_customer').val();
                var balu_buyer         = $('#balu_buyer').val();
                var balu_report        = $('#balu_report').val();
                var balu_stocks         = $('#balu_stocks').val();
                var pathor_kroy_hisab    = $('#pathor_kroy_hisab').val();
                var pathor_bikroy_hisab  = $('#pathor_bikroy_hisab').val();
                var pathor_category      = $('#pathor_category').val();
                var pathor_dealer        = $('#pathor_dealer').val();
                var pathor_customer      = $('#pathor_customer').val();
                var pathor_buyer         = $('#pathor_buyer').val();
                var pathor_stocks         = $('#pathor_stocks').val();
                var cement_kroy_hisab    = $('#cement_kroy_hisab').val();
                var cement_bikroy_hisab  = $('#cement_bikroy_hisab').val();
                var cement_category      = $('#cement_category').val();
                var cement_dealer        = $('#cement_dealer').val();
                var cement_customer      = $('#cement_customer').val();
                var cement_buyer         = $('#cement_buyer').val();
                var cement_stocks         = $('#cement_stocks').val();
                var cement_report         = $('#cement_report').val();
                // var pathor_report        = $('#pathor_report').val();

                var create_user = $('#create_user').val();                
                var edit_data   = $('#edit_data').val();                
                var delete_data = $('#delete_data').val();                
                // alert(create_user);
                 // manzu add raj_kajer_all_hisab here 
                userAccessUpdate(username, project_name_id, protidiner_hisab, modify_data, joma_khat, khoros_khat, khoros_khat_entry, nije_pabo, paonader, report, agrim_hisab, cash_calculator,raj_kajer_all_hisab,electric_kroy_bikroy, rod_kroy_hisab, rod_bikroy_hisab, rod_category, rod_dealer, rod_customer, rod_buyer, rod_report,balu_kroy_hisab, balu_bikroy_hisab, balu_category, balu_dealer, balu_customer, balu_buyer, balu_report, balu_stocks,
                pathor_kroy_hisab, pathor_bikroy_hisab, pathor_category, pathor_dealer, pathor_customer, pathor_buyer, pathor_stocks,  
                cement_kroy_hisab, cement_bikroy_hisab, cement_category, cement_dealer, cement_customer, cement_buyer, cement_stocks,cement_report,  
                 create_user, edit_data, delete_data);     
            });
            
  </script>
</head>
<body>
    <?php
      include '../navbar/header_text.php';
      $page = 'user_page_permission';
      include '../navbar/navbar.php';
    ?>
    <div class="container">      
      <div class="row">
        <div class="col-md-12">
          <?php 
            $ph_id = $_SESSION['project_name_id'];
            $query = "SELECT * FROM project_heading WHERE id = $ph_id";
            $show = $db->select($query);
            if ($show) 
            {
              while ($rows = $show->fetch_assoc()) 
              {
          ?>
            <div class="project_heading text-center">      
              <h2 class="text-center" style="font-size: 25px;"><?php echo $rows['heading']; ?></h2>
              <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
            </div>
          <?php 
                }
              } 
          ?>
          <div class="info-con">
            <h3 class="text-center bg-primary" style="margin-top: 0px; padding: 5px;">Allow page access for selected user</h3>
            <div class="form-control" style="height: 73px;">
                <div style="width: 100%; font-weight: bold; text-align: center;">Select an User Name</div>
                <div class="" style="width: 100%; text-align: center;">
                    <?php
                        $queryGetUser = "SELECT username FROM login ORDER BY username ASC";
                        $result = $db->select($queryGetUser);
                        // var_dump($result);
                        $datas=array();
                        $sizes=0;
                        if($result){
                          while ($rows= $result->fetch_assoc()) {
                              $datas[$sizes]['username']= $rows['username'];
                              $sizes++;
                          }
                        }
                        // echo "<pre>";
                        // var_dump($datas);
                    ?>                
                    <select id='select_user'>
                      <option value="none">Select one...</option>
                          <?php
                            if($datas){
                              foreach($datas as $row) {
                                 $username = $row['username'];
                                 echo '<option value = "'.$username.'">'.$username.'</option>';
                              }
                            }
                          ?>                  
                    </select>
                </div>                
            </div>

            <div id="infoByUser">                
                <!-- view fields of pages allow -->
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
 
<script type="text/javascript">
  $('#select_user').selectpicker();
</script>
<script type="text/javascript">
  function collumn_height(){
      var left_col_height = $("#left-col").height();
      var right_col_height = $("#right-col").height();
      if(left_col_height > right_col_height){
          $("#right-col").height(left_col_height);
      } else {
          $("#left-col").height(right_col_height);
      }
  }
  // $("#project_con").height($(".select2-container").height());
</script>
</body>
</html>












///////////////////////////////////////////////////////////////////////////////
allow_page_access_update



<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$fromSessionUserName = $_SESSION['username'];
	$fromSessionUserType = $_SESSION['usertype'];

//========raj_kajerhisab added by me

	$sucMsg 	='';
	$username 			= $_POST['username'];
	$project_name_id 	= $_POST['project_name_id'];
	// $doinik_hisab 		= $_POST['doinik_hisab'];
	$protidiner_hisab 	= $_POST['protidiner_hisab'];
	$modify_data 		= $_POST['modify_data'];
	$joma_khat 			= $_POST['joma_khat'];
	$khoros_khat 		= $_POST['khoros_khat'];
	$khoros_khat_entry 	= $_POST['khoros_khat_entry'];
	$nije_pabo 			= $_POST['nije_pabo'];
	$paonader 			= $_POST['paonader'];
	$report 			= $_POST['report'];
	$agrim_hisab 		= $_POST['agrim_hisab'];
	$cash_calculator 	= $_POST['cash_calculator'];
	$raj_kajer_all_hisab= $_POST['raj_kajer_all_hisab'];
	$electric_kroy_bikroy= $_POST['electric_kroy_bikroy'];
	// $rod_hisab 			= $_POST['rod_hisab'];
	$rod_kroy_hisab 	= $_POST['rod_kroy_hisab'];
	$rod_bikroy_hisab 	= $_POST['rod_bikroy_hisab'];
	$rod_category 		= $_POST['rod_category'];
	$rod_dealer 		= $_POST['rod_dealer'];
	$rod_customer 		= $_POST['rod_customer'];
	$rod_buyer 			= $_POST['rod_buyer'];
	$rod_report 		= $_POST['rod_report'];

	$balu_kroy_hisab 	= $_POST['balu_kroy_hisab'];
	$balu_bikroy_hisab 	= $_POST['balu_bikroy_hisab'];
	$balu_category 		= $_POST['balu_category'];
	$balu_dealer 		= $_POST['balu_dealer'];
	$balu_customer 		= $_POST['balu_customer'];
	$balu_buyer 			= $_POST['balu_buyer'];
	$balu_report 		= $_POST['balu_report'];
	$balu_stocks  		= $_POST['balu_stocks'];

	$pathor_kroy_hisab 	= $_POST['pathor_kroy_hisab'];
	$pathor_bikroy_hisab 	= $_POST['pathor_bikroy_hisab'];
	$pathor_category 		= $_POST['pathor_category'];
	$pathor_dealer 		= $_POST['pathor_dealer'];
	$pathor_customer 		= $_POST['pathor_customer'];
	$pathor_buyer 			= $_POST['pathor_buyer'];
	$pathor_stocks 			= $_POST['pathor_stocks'];
	// $pathor_report 		= $_POST['pathor_report'];

	$cement_kroy_hisab 	= $_POST['cement_kroy_hisab'];
	$cement_bikroy_hisab 	= $_POST['cement_bikroy_hisab'];
	$cement_category 		= $_POST['cement_category'];
	$cement_dealer 		= $_POST['cement_dealer'];
	$cement_customer 		= $_POST['cement_customer'];
	$cement_buyer 			= $_POST['cement_buyer'];
	$cement_stocks 			= $_POST['cement_stocks'];
	$cement_report 			= $_POST['cement_report'];
	// $pathor_report 		= $_POST['pathor_report'];

	$create_user 		= $_POST['create_user'];
	$edit_data 			= $_POST['edit_data'];
	$delete_data 		= $_POST['delete_data'];

	// echo $username ." " . $project_name_id . " " . $home . " " . $protidiner_hisab . " " . $joma_khat . " " . $khoros_khat . " " . $nije_pabo . " " . $paonader . " " . $modify_data . " " . $rod_hisab . " " . $create_user;

	$sql="UPDATE login SET protidiner_hisab = '$protidiner_hisab', modify_data = '$modify_data', joma_khat = '$joma_khat', khoros_khat = '$khoros_khat', khoros_khat_entry = '$khoros_khat_entry', nije_pabo = '$nije_pabo', paonader = '$paonader', report = '$report', agrim_hisab = '$agrim_hisab', cash_calculator = '$cash_calculator',raj_kajer_all_hisab ='$raj_kajer_all_hisab',electric_kroy_bikroy='$electric_kroy_bikroy', rod_kroy_hisab = '$rod_kroy_hisab', rod_bikroy_hisab = '$rod_bikroy_hisab', rod_category = '$rod_category',rod_dealer = '$rod_dealer', rod_customer = '$rod_customer',rod_buyer = '$rod_buyer', rod_report = '$rod_report',
	balu_kroy_hisab = '$balu_kroy_hisab',balu_bikroy_hisab = '$balu_bikroy_hisab',
	balu_category = '$balu_category', balu_dealer = '$balu_dealer', balu_customer = '$balu_customer',
	balu_buyer = '$balu_buyer', balu_report = '$balu_report',balu_stocks = '$balu_stocks',
	pathor_kroy_hisab = '$pathor_kroy_hisab',pathor_bikroy_hisab = '$pathor_bikroy_hisab',
	pathor_category = '$pathor_category', pathor_dealer = '$pathor_dealer', pathor_customer = '$pathor_customer',
	pathor_buyer = '$pathor_buyer',pathor_stocks = '$pathor_stocks',
	cement_kroy_hisab = '$cement_kroy_hisab',cement_bikroy_hisab = '$cement_bikroy_hisab',
	cement_category = '$cement_category', cement_dealer = '$cement_dealer', cement_customer = '$cement_customer',
	cement_buyer = '$cement_buyer',cement_stocks = '$cement_stocks',cement_report = '$cement_report',
	  create_user = '$create_user', edit_data = '$edit_data', delete_data = '$delete_data', project_name_id = '$project_name_id' WHERE username = '$username'";

	if ($db->update($sql) === TRUE) {
		$sucMsg = "User Access Updated Successfully";
		echo $sucMsg;
		$page_permission_sql = "SELECT * FROM login WHERE username = '$username'";
		$permission_result = $db->select($page_permission_sql);
		if($permission_result && mysqli_num_rows($permission_result) == '1'){
        	$row = $permission_result->fetch_assoc();

        	$protidiner_hisab 	= $row['protidiner_hisab'];
        	$modify_data 		= $row['modify_data'];
        	$joma_khat 			= $row['joma_khat'];
        	$khoros_khat 		= $row['khoros_khat'];
        	$khoros_khat_entry 	= $row['khoros_khat_entry'];
        	$nije_pabo 			= $row['nije_pabo'];
        	$paonader 			= $row['paonader'];
        	$report 			= $row['report'];
        	$agrim_hisab 		= $row['agrim_hisab'];
        	$cash_calculator 	= $row['cash_calculator'];
			$raj_kajer_all_hisab 	= $row['raj_kajer_all_hisab'];
			$electric_kroy_bikroy =$row['electric_kroy_bikroy'];
        	$rod_kroy_hisab 	= $row['rod_kroy_hisab'];
        	$rod_bikroy_hisab 	= $row['rod_bikroy_hisab'];
        	$rod_category 		= $row['rod_category'];
        	$rod_dealer 		= $row['rod_dealer'];
        	$rod_customer 		= $row['rod_customer'];
        	$rod_buyer	 		= $row['rod_buyer'];
        	$rod_report			= $row['rod_report'];

			$balu_kroy_hisab 	= $row['balu_kroy_hisab'];
        	$balu_bikroy_hisab 	= $row['balu_bikroy_hisab'];
			$balu_category 		= $row['balu_category'];
        	$balu_dealer 		= $row['balu_dealer'];
        	$balu_customer 		= $row['balu_customer'];
        	$balu_buyer	 		= $row['balu_buyer'];
        	$balu_report			= $row['balu_report'];
			$balu_stocks			= $row['balu_stocks'];

			$pathor_kroy_hisab 	= $row['pathor_kroy_hisab'];
        	$pathor_bikroy_hisab 	= $row['pathor_bikroy_hisab'];
			$pathor_category 		= $row['pathor_category'];
        	$pathor_dealer 		= $row['pathor_dealer'];
        	$pathor_customer 		= $row['pathor_customer'];
        	$pathor_buyer	 		= $row['pathor_buyer'];
			$pathor_stocks			= $row['pathor_stocks'];

			$cement_kroy_hisab 	= $row['cement_kroy_hisab'];
        	$cement_bikroy_hisab 	= $row['cement_bikroy_hisab'];
			$cement_category 		= $row['cement_category'];
        	$cement_dealer 		= $row['cement_dealer'];
        	$cement_customer 		= $row['cement_customer'];
        	$cement_buyer	 		= $row['cement_buyer'];
			$cement_stocks			= $row['cement_stocks'];
			$cement_report			= $row['cement_report'];
        	// $pathor_report			= $row['pathor_report'];


        	if($protidiner_hisab == 'yes' || $modify_data == 'yes' || $joma_khat == 'yes' || $khoros_khat == 'yes' || $khoros_khat_entry == 'yes' || $nije_pabo == 'yes' || $paonader == 'yes' || $report == 'yes' || $agrim_hisab == 'yes' || $cash_calculator == 'yes' || $raj_kajer_all_hisab == 'yes'|| $electric_kroy_bikroy == 'yes' || $rod_kroy_hisab == 'yes' || $rod_bikroy_hisab == 'yes' || $rod_category == 'yes' || $rod_dealer == 'yes' || $rod_customer == 'yes' || $rod_buyer == 'yes' || $rod_report == 'yes' ||
			 $balu_kroy_hisab == 'yes' || $balu_bikroy_hisab == 'yes' || $balu_category == 'yes' || $balu_dealer == 'yes' || $balu_customer == 'yes' || $balu_buyer == 'yes' || $balu_report == 'yes' || $balu_stocks == 'yes' ||
			 $pathor_kroy_hisab == 'yes' || $pathor_bikroy_hisab == 'yes' || $pathor_category == 'yes' || $pathor_dealer == 'yes' || $pathor_customer == 'yes' || $pathor_buyer == 'yes' || $pathor_stocks == 'yes' ||
			 $cement_kroy_hisab == 'yes' || $cement_bikroy_hisab == 'yes' || $cement_category == 'yes' || $cement_dealer == 'yes' || $cement_customer == 'yes' || $cement_buyer == 'yes' || $cement_stocks == 'yes' || $cement_report == 'yes' 
			){
        		$sql_doinik_hisab_permission = "UPDATE login SET page_permission = 'yes' WHERE username = '$username'";
        		$update_result = $db->update($sql_doinik_hisab_permission);
        	} else {
        		$sql_doinik_hisab_permission = "UPDATE login SET page_permission = 'no' WHERE username = '$username'";
        		$update_result = $db->update($sql_doinik_hisab_permission);
        	}
          
        }
	} else {
		echo "Error: " . $sql . "<br>" . $db->error;
	}



	$session_update_sql = "SELECT * FROM login WHERE username='$fromSessionUserName' AND  usertype='$fromSessionUserType'";
	$session_update = $db->login($session_update_sql);
	$num_row = mysqli_num_rows($session_update);
	$row = mysqli_fetch_array($session_update);
	if($session_update && $num_row ==1 ) {
		// $_SESSION['project_name_id']  = $project_name;

		// $_SESSION['first_name']   = $row['first_name'];
		// $_SESSION['last_name']    = $row['last_name'];
		// $_SESSION['username']     = $row['username'];
		// $_SESSION['usertype']     = $row['usertype'];

		$_SESSION['doinik_hisab']     = $row['doinik_hisab'];
		$_SESSION['protidiner_hisab'] = $row['protidiner_hisab'];
		$_SESSION['modify_data']      = $row['modify_data'];    
		$_SESSION['joma_khat']        = $row['joma_khat'];
		$_SESSION['khoros_khat']      = $row['khoros_khat'];
		$_SESSION['khoros_khat_entry']= $row['khoros_khat_entry'];
		$_SESSION['nije_pabo']        = $row['nije_pabo'];
		$_SESSION['paonader']         = $row['paonader'];
		$_SESSION['report']           = $row['report'];
		$_SESSION['agrim_hisab']      = $row['agrim_hisab'];
		$_SESSION['cash_calculator']  = $row['cash_calculator'];
		$_SESSION['raj_kajer_all_hisab']   = $row['raj_kajer_all_hisab'];
		$_SESSION['electric_kroy_bikroy']   = $row['electric_kroy_bikroy'];
		
		$_SESSION['rod_hisab']        = $row['rod_hisab'];
		$_SESSION['rod_kroy_hisab']   = $row['rod_kroy_hisab'];
		$_SESSION['rod_bikroy_hisab'] = $row['rod_bikroy_hisab'];
		$_SESSION['rod_category']     = $row['rod_category'];
		$_SESSION['rod_dealer']       = $row['rod_dealer'];
		$_SESSION['rod_customer']     = $row['rod_customer'];
		$_SESSION['rod_buyer']        = $row['rod_buyer'];
		$_SESSION['rod_report']       = $row['rod_report'];

		$_SESSION['balu_kroy_hisab']   = $row['balu_kroy_hisab'];
		$_SESSION['balu_bikroy_hisab'] = $row['balu_bikroy_hisab'];
		$_SESSION['balu_category']     = $row['balu_category'];
		$_SESSION['balu_dealer']       = $row['balu_dealer'];
		$_SESSION['balu_customer']     = $row['balu_customer'];
		$_SESSION['balu_buyer']        = $row['balu_buyer'];
		$_SESSION['balu_report']       = $row['balu_report'];
		$_SESSION['balu_stocks']       = $row['balu_stocks'];


		$_SESSION['pathor_kroy_hisab']   = $row['pathor_kroy_hisab'];
		$_SESSION['pathor_bikroy_hisab'] = $row['pathor_bikroy_hisab'];
		$_SESSION['pathor_category']     = $row['pathor_category'];
		$_SESSION['pathor_dealer']       = $row['pathor_dealer'];
		$_SESSION['pathor_customer']     = $row['pathor_customer'];
		$_SESSION['pathor_buyer']        = $row['pathor_buyer'];
		$_SESSION['pathor_stocks']        = $row['pathor_stocks'];
		// $_SESSION['pathor_report']       = $row['pathor_report'];


		$_SESSION['cement_kroy_hisab']   = $row['cement_kroy_hisab'];
		$_SESSION['cement_bikroy_hisab'] = $row['cement_bikroy_hisab'];
		$_SESSION['cement_category']     = $row['cement_category'];
		$_SESSION['cement_dealer']       = $row['cement_dealer'];
		$_SESSION['cement_customer']     = $row['cement_customer'];
		$_SESSION['cement_buyer']        = $row['cement_buyer'];
		$_SESSION['cement_stocks']        = $row['cement_stocks'];
		$_SESSION['cement_report']        = $row['cement_report'];
		// $_SESSION['pathor_report']       = $row['pathor_report'];


		$_SESSION['create_user']      = $row['create_user'];
		$_SESSION['edit_data']        = $row['edit_data'];
		$_SESSION['delete_data']      = $row['delete_data'];

		$_SESSION['verification']     = $row['verification'];
		$_SESSION['page_permission']  = $row['page_permission'];
	}



    /////////////////////////////////////////////////////////////////

search_user_username




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
        </label>
      </div> -->





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



///////////////////////////////////////////////////


index.php



<?php
  ob_start();
  session_start();
  require 'config/config.php';
  require 'lib/database.php';
  $db = new Database();
  if(isset($_POST['submit'])){
      $usertype = $_POST['usertype'];
      $username = trim($_POST['username']);
      $password = md5(trim($_POST['password']));
      $project_name = $_POST['project_name'];
      
      $_SESSION['uNameForPlaceHolerVerify'] = $username;
      

      // $query = "SELECT * FROM login WHERE username='$username' AND password='$password' AND usertype='$usertype' AND project_name_id LIKE '%$project_name%'";
      $query = "SELECT * FROM login WHERE username='$username' AND password='$password' AND (usertype='$usertype' OR usertype='superAdmin') AND project_name_id LIKE '%$project_name%'";
      $result = $db->login($query);
      $num_row = mysqli_num_rows($result);
    //   echo "user found = ". $num_row;
      $row=mysqli_fetch_array($result);
      if( $num_row ==1 ) {
        $_SESSION['project_name_id']  = $project_name;

        $_SESSION['first_name']   = $row['first_name'];
        $_SESSION['last_name']    = $row['last_name'];
        $_SESSION['username']     = $row['username'];

        if($_SESSION['usertype'] == "superAdmin") {
          $_SESSION['usertype']   = "admin";
          $_SESSION['is_super_admin'] = true;
        } else {
          $_SESSION['usertype']   = $row['usertype'];
          $_SESSION['is_super_admin'] = false;
        }
        


        $_SESSION['doinik_hisab']     = $row['doinik_hisab'];
        $_SESSION['protidiner_hisab'] = $row['protidiner_hisab'];
        $_SESSION['modify_data']      = $row['modify_data'];
        $_SESSION['joma_khat']        = $row['joma_khat'];
        $_SESSION['khoros_khat']      = $row['khoros_khat'];
        $_SESSION['khoros_khat_entry']= $row['khoros_khat_entry'];
        $_SESSION['nije_pabo']        = $row['nije_pabo'];
        $_SESSION['paonader']         = $row['paonader'];
        $_SESSION['report']           = $row['report'];
        $_SESSION['agrim_hisab']      = $row['agrim_hisab'];
        $_SESSION['cash_calculator']  = $row['cash_calculator'];
        
        // Manzu raj_kajerhisab add in sessions
        $_SESSION['raj_kajer_all_hisab']  = $row['raj_kajer_all_hisab'];
        $_SESSION['electric_kroy_bikroy']  = $row['electric_kroy_bikroy'];
        
        $_SESSION['balu_hisab']        = $row['balu_hisab'];
        $_SESSION['balu_kroy_hisab']   = $row['balu_kroy_hisab'];
        $_SESSION['balu_bikroy_hisab'] = $row['balu_bikroy_hisab'];
        $_SESSION['balu_category']     = $row['balu_category'];
        $_SESSION['balu_dealer']       = $row['balu_dealer'];
        $_SESSION['balu_customer']     = $row['balu_customer'];
        $_SESSION['balu_buyer']        = $row['balu_buyer'];
        $_SESSION['balu_report']       = $row['balu_report'];
        $_SESSION['balu_stocks']       = $row['balu_stocks'];


        $_SESSION['pathor_hisab']        = $row['pathor_hisab'];
        $_SESSION['pathor_kroy_hisab']   = $row['pathor_kroy_hisab'];
        $_SESSION['pathor_bikroy_hisab'] = $row['pathor_bikroy_hisab'];
        $_SESSION['pathor_category']     = $row['pathor_category'];
        $_SESSION['pathor_dealer']       = $row['pathor_dealer'];
        $_SESSION['pathor_customer']     = $row['pathor_customer'];
        $_SESSION['pathor_buyer']        = $row['pathor_buyer'];
        $_SESSION['pathor_report']       = $row['pathor_report'];
        $_SESSION['pathor_stocks']       = $row['pathor_stocks'];


        $_SESSION['cement_hisab']        = $row['cement_hisab'];
        $_SESSION['cement_kroy_hisab']   = $row['cement_kroy_hisab'];
        $_SESSION['cement_bikroy_hisab'] = $row['cement_bikroy_hisab'];
        $_SESSION['cement_category']     = $row['cement_category'];
        $_SESSION['cement_dealer']       = $row['cement_dealer'];
        $_SESSION['cement_customer']     = $row['cement_customer'];
        $_SESSION['cement_buyer']        = $row['cement_buyer'];
        $_SESSION['cement_report']       = $row['cement_report'];
        $_SESSION['cement_stocks']       = $row['cement_stocks'];


        $_SESSION['rod_hisab']        = $row['rod_hisab'];
        $_SESSION['rod_kroy_hisab']   = $row['rod_kroy_hisab'];
        $_SESSION['rod_bikroy_hisab'] = $row['rod_bikroy_hisab'];
        $_SESSION['rod_category']     = $row['rod_category'];
        $_SESSION['rod_dealer']       = $row['rod_dealer'];
        $_SESSION['rod_customer']     = $row['rod_customer'];
        $_SESSION['rod_buyer']        = $row['rod_buyer'];
        $_SESSION['rod_report']       = $row['rod_report'];

        $_SESSION['create_user']      = $row['create_user'];
        $_SESSION['edit_data']        = $row['edit_data'];
        $_SESSION['delete_data']      = $row['delete_data'];

        $_SESSION['verification']     = $row['verification'];
        $_SESSION['page_permission']  = $row['page_permission'];
      
        
        if($_SESSION['verification'] == 'no'){
            header("Location: vaucher/doinik_all_hisab.php", true, 301);
            // header('location: verify_email_address.php', true, 301);
            exit;
        } else {
            if($_SESSION['page_permission'] == 'no'){
                header('location: vaucher/no_permission.php', true, 301);
                exit;
            } else {
                // exit(header("Location: vaucher/doinik_all_hisab.php"));
                header("Location: vaucher/doinik_all_hisab.php", true, 301);
                exit;
                // if($_SESSION['home'] == 'yes'){
                //     header("Location: vaucher/home.php");
                //     exit;
                // } else {
                //     if($_SESSION['doinik_hisab'] == 'yes'){
                //         header("Location: vaucher/index.php");
                //         exit;
                //     } else {
                //         if($_SESSION['joma_khat'] == 'yes'){
                //             header("Location: vaucher/add_vaucher_credit.php");
                //             exit;
                //         } else {
                //             if($_SESSION['khoros_khat'] == 'yes'){
                //                 header("Location: vaucher/add_vaucher_group.php");
                //                 exit;
                //             } else {
                //               if($_SESSION['nije_pabo'] == 'yes'){
                //                   header("Location: vaucher/nij_paonadar_add.php");
                //                   exit;
                //               } else {
                //                 if($_SESSION['paonader'] == 'yes'){
                //                     header("Location: vaucher/jara_pabe_add.php");
                //                     exit;
                //                 } else {
                //                   if($_SESSION['modify_data'] == 'yes'){
                //                     header("Location: vaucher/modify_vaucher.php");
                //                     exit;
                //                   } else {
                //                       if($_SESSION['create_user'] == 'yes'){
                //                         header("Location: vaucher/create_user.php");
                //                         exit;
                //                       } else {}
                //                   }
                //                 }
                //               }
                //             }
                //         }
                //     }
                // }
            }
        }
      } else {
        echo 'oops can not do it. It can happens missing username, password or user type.';
        exit;
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="css/style.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  <style type="text/css"> 
    .btn-radio {
        cursor: pointer;
        display: inline-block;
        float: left;
        -webkit-user-select: none;
        -moz-user-select: none;
    }
    .btn-radio input {
        display: none;
    }
    .btn-radio svg {
        fill: none;
        vertical-align: middle;
    }
    .btn-radio svg circle {
      stroke-width: 2;
      stroke: #C8CCD4;
    }
    .btn-radio svg path.inner {
        stroke-width: 6;
        stroke-dasharray: 19;
        stroke-dashoffset: 19;
    }
    .btn-radio svg path.outer {
        stroke-width: 2;
        stroke-dasharray: 57;
        stroke-dashoffset: 57;
    }
    .btn-radio svg path {
        stroke: #008FFF;
        /*stroke: #16a085;*/
        stroke: #000;
    }

    .btn-radio input:checked + svg path.inner {
        stroke-dashoffset: 38;
        transition-delay: 0.3s;
    }
    .btn-radio input:checked + svg path {
        transition: all 0.4s ease;
        transition-delay: 0s;
    }
    .btn-radio input:checked + svg path.outer {
        stroke-dashoffset: 0;
    }
    .btn-radio input:checked + svg path {
        transition: all 0.4s ease;
    }

    .btn-radio:not(:first-child) {
        margin-left: 10%;
    }
    #project_name{
      -moz-appearance:none;
      -webkit-appearance:none;
      appearance:none;
      background: url('img/logo/arrow_bottom.png') no-repeat right #495057;
      background-size: 16px 16px;
      transition: all .5s;
    }
.dropdown{ 
    overflow:auto;

}
label#adlabel {
    display: inline-block !important;
}
  </style>
</head>
<body>
    <div class="container" style="min-height: 725px;">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div class="box">
                    <p class="logoContainer">
                      <img src="img/Shah logoUsed.png" alt="logo" class="loginLogo">
                    </p>
                    <div class="floats">                        
                        <form class="form" action="" method="POST" onsubmit="return validation()">
                            <div class="form-group userTypes">
                                    <label for="adminInput" class="btn-radio" id="adlabel">
                                        <input type="radio" name="usertype" value="admin" id="adminInput" checked>
                                        <svg width="20px" height="21px" viewBox="0 0 20 20">
                                          <circle cx="10" cy="10" r="9"></circle>
                                          <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                                          <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                        </svg>
                                        <span>Admin Login</span>
                                    </label>

                                    <label for="userInput" class="btn-radio" id="urlabel">
                                        <input type="radio" name="usertype" value="user" id='userInput'>
                                        <svg width="20px" height="21px" viewBox="0 0 20 20">
                                          <circle cx="10" cy="10" r="9"></circle>
                                          <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                                          <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                        </svg>
                                        <span>User Login</span>
                                    </label>
                            </div>
                            <div class="form-group">
                                <!-- <label for="username" class="">Username:</label><br> -->
                                <input type="text" name="username" id="username" class="form-control" placeholder="USERNAME">
                            </div>
                            <div class="form-group">
                                <!-- <label for="password" class="">Password:</label><br> -->
                                <input type="password" name="password" id="password" class="form-control" placeholder="PASSWORD">
                            </div>
                            <div class="form-group wrapper" >
                            <!-- <select  id="project_name" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();"  name="project_name" class="form-control dropdown" > -->

                                <select  id="project_name"  name="project_name" class="form-control dropdown selec2" style="overflow-y: scroll;" >


                                    <option value="0">SELECT A PROJECT NAME</option>
                                    <?php
                                        // $query = "SELECT * FROM project_heading";
                                        // $result = $db->select($query);
                                        // $num_row = mysqli_num_rows($result);
                                        // if($result && $num_row > 0){
                                        //     while($row = $result->fetch_assoc()) {
                                        //         $id = $row['id'];
                                        //         $heading = $row['heading'];
                                        //         echo '<option value="'.$id.'">'.$heading.'</option>';
                                        //     }
                                        // }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-block" value="Login">
                            </div>
                        </form>
                        <div>
                          <div class="" style="float: left">
                            <a href="forget_password.php" class="text-danger">Forgot password?</a>
                            <br>
                            <a href="../index.html" class="btn" style="padding: 0px; font-size: 12px;"><img src="img/others/left_arrow.png" width = "10" height="9"> Back to website</a>
                          </div>                         
                          
                          <div style="float: right;"><a href="sign_up.php" class="btn btn-primary">Sign up</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
  $(document).ready(function(){
      $('#adlabel').addClass('uTypeActive');
      
      $('#adlabel').click(function(){        
          if($('#adlabel').hasClass('uTypeActive')){
          } else{
              $('#adlabel').addClass('uTypeActive');
              $('#urlabel').removeClass('uTypeActive');
          }
      });

      $('#urlabel').click(function(){
          if($('#urlabel').hasClass('uTypeActive')){
            
          } else{
              $('#urlabel').addClass('uTypeActive');
              $('#adlabel').removeClass('uTypeActive');
          }
      });
  });
</script>
<script type="text/javascript">
    // if menu is open then true, if closed then false
   var open = false;
   // just a function to print out message
   function isOpen(){
       if(open){
          // return "menu is open";
          $("#project_name").css({"background":"url('img/logo/arrow_top.png') no-repeat right #495057", "background-size": "16px 16px" , "transition": "all .5s"});
       }else{
          // return "menu is closed";
          $("#project_name").css({"background" : "url('img/logo/arrow_bottom.png') no-repeat right #495057", "background-size": "16px 16px" , "transition": "all .5s"});
       }
   }
   // on each click toggle the "open" variable
   $("#project_name").on("click", function() {
         open = !open;
         console.log(isOpen());
   });
   // on each blur toggle the "open" variable
   // fire only if menu is already in "open" state
   $("#project_name").on("blur", function() {
         if(open){
            open = !open;
            console.log(isOpen());
         }
   });
   // on ESC key toggle the "open" variable only if menu is in "open" state
   $(document).keyup(function(e) {
       if (e.keyCode == 27) { 
         if(open){
            open = !open;
            console.log(isOpen());
         }
       }
   });
</script>
<script type="text/javascript">
    $(document).on('input', '#username', function(){
        var username = $(this).val();
        $.ajax({
            url: 'ajaxcall_save_update/project_name_list_update.php',
            type: 'post',
            data: {username: username},
            success: function(res){
                $('#project_name').html(res);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
<script type="text/javascript">
    function validation(){
        var validUserName = false;
        var validPass = false;
        var validProjectName = false;

        var username = $("#username").val();
        var password = $("#password").val();
        var project_name = $('#project_name option:selected').val();
        // alert(project_name);

        if(username == '' && password == '' && project_name == '0') {
            alert('Username, password and project name can not be empty !');
            return false;
        } else {
            if(username == '' && password == ''){
                alert('Username and password can not be empty !');
                var validProjectName = true;
                return false;
            } else if (username == '' && project_name == '0'){
                alert('Username and project_name can not be empty !');
                var validPass = true;
                return false;
            } else if(password == '' && project_name == '0'){
                alert('Password and project_name can not be empty !');
                var validUserName = true;
                return false;
            }
        }

        if(username == ''){
            alert('Username can not be empty !');
        } else {
            validUserName = true;
        }
        if(password == ''){
            alert('Password can not be empty !');
        } else {
            validPass = true;
        }
        if(project_name == '0'){            
            alert('Please select a project name !');
        } else {
            validProjectName = true;
        }

        if(validUserName && validPass && validProjectName){
            return true;
        } else {
            return false;
        }
    }
</script>
</html>
<?php
    ob_end_flush();
?>


/////////////////////////////////////////////
left_menu_bar_cement_hisab

<!-- Left menu bar con -->
<div id="left_all_menu_con">
    <a class="header_mnu_left" href="../vaucher/cement_index.php" >
        <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
        সিমেন্ট হিসাব
    </a>
    <?php
        if($_SESSION['cement_kroy_hisab'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'cement_kroy_hisab'){echo 'mnu_active';}?>" href="../vaucher/cement_details_entry.php">
                <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
                <!-- ক্রয় হিসাবের দৈনিক এন্ট্রি -->
                ক্রয় হিসাব
            </a>
            <?php
        }
        if($_SESSION['cement_bikroy_hisab'] == 'yes'){
            ?>         
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'cement_bikroy_hisab'){echo 'mnu_active';}?>" href="../vaucher/cement_details_sell_entry.php">
                <img src="../img/logo/add2.png" alt="logo" class="img_mnu">
                <!-- বিক্রয় হিসাবের দৈনিক এন্ট্রি -->
                বিক্রয় হিসাব
            </a>
            <?php
        }
        if($_SESSION['cement_category'] == 'yes'){
            ?> 
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'cement_hisab_entry'){echo 'mnu_active';}?>" href="../vaucher/cement_hisab_entry.php">
                <img src="../img/logo/add3.png" alt="logo" class="img_mnu">
                ক্যাটাগরি এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['cement_dealer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'cement_dealer_entry'){echo 'mnu_active';}?>" href="../vaucher/cement_dealer_entry.php">
                <img src="../img/logo/add4.png" alt="logo" class="img_mnu">
                ডিলার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['cement_stocks'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'cement_stocks'){echo 'mnu_active';}?>" href="../vaucher/cement_stocks.php">
                <img src="../img/logo/add5.png" alt="logo" class="img_mnu">
                স্টক তথ্য
            </a>
            <?php
        }
        if($_SESSION['cement_buyer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'cement_buyer_entry'){echo 'mnu_active';}?>" href="../vaucher/cement_buyer_entry.php">
                <img src="../img/logo/add6.png" alt="logo" class="img_mnu">
                বায়ার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['cement_customer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'cement_customer_entry'){echo 'mnu_active';}?>" href="../vaucher/cement_customer_entry.php">
                <img src="../img/logo/add5.png" alt="logo" class="img_mnu">
            কাস্টমার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['cement_report'] == 'yes'){
            ?>
             <a class="mnu_left <?php if($_SESSION['pageName'] == '45'){echo 'mnu_active';}?>" href="../vaucher/cement_report_buy_hisab.php"> 
                <img src="../img/logo/reportVector.svg" alt="logo" class="img_mnu">
                রিপোর্ট
            </a>
            <?php
        }
    ?>
</div>



////////////////////////////////////////////////////////
cement details entry



<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$project_name_id = $_SESSION['project_name_id'];
$_SESSION['pageName'] = 'cement_kroy_hisab';
// $sucMsgPopup = '';
?>




<!DOCTYPE html>
<html>

<head>
    <title>সিমেন্ট ক্রয় হিসাব </title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
    <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>

    <style type="text/css">
        .rodDetailsEnCon {
            position: relative;
        }

        .scroll-after-btn {
            margin: 10px 0px 25px;
            width: 100px;
            position: absolute;
            right: 0px;
        }

        #detailsEtryTable {
            width: 293%;
            border: 1px solid #3e9309d4;

        }

        #detailsEtryTable tr:first-child td {
            text-align: center;
            background-color: #3e9309ba;
            Color: white;
        }

        #detailsEtryTable tr:nth-child(2) td {
            text-align: center;
            background-color: #3e9309ba;
            Color: white;
        }

        #detailsEtryTable tr:nth-child(3) td {
            border: 1px solid #3e9309d4;
            /* text-align: center; */

            /* Color: black; */
            /* box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px; */
        }

        #detailsEtryTable tr:nth-child(3) input {
            border: none;
            /* height: 39px; */
            /* border-radius: 10% 10% 0% 0%; */
            /* transition: border-bottom 1s linear ; */
        }

        #detailsEtryTable tr:nth-child(3) input[type=text]:focus {
            /* outline: 1px solid skyblue; */
            outline: none;
            border-bottom: 2px solid #508d2aba;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            height: 30px;
            /* font-size: 1px; */

        }

        #detailsEtryTable tr:nth-child(3) input[type=text]:focus::placeholder {
            color: transparent;

            /* font-size: large; */

        }

        #detailsEtryTable td {
            /* color inserted here */
            border: 2px solid #E0E4E0;
        }

        .scrolling-div {
            width: 100%;
            overflow-y: auto;
        }

        #form_entry {
            overflow-y: scroll;
        }

        /*.scrolling-div::-webkit-scrollbar {
          width: 10px;
          
        }
        .scrolling-div::-webkit-scrollbar-track {
          background: #ff9696;
          box-shadow: inset 0 0 5px grey; 
          border-radius: 10px;
        }
        .scrolling-div::-webkit-scrollbar-thumb {
          background: red;
          border-radius: 10px;
        }
        .scrolling-div::-webkit-scrollbar-thumb:hover {
          background: #900;
        }*/
        .scrollsign_plus {
            width: 25px;
            height: 25px;
            /*border: 1px solid red;*/
            font-size: 35px;
            line-height: 19px;
            padding: 3px;
            background-color: #75D265;
            color: #fff;
            border-radius: 50%;
            cursor: pointer;
            position: absolute;
            right: -35px;
            top: 15px;
            user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .widthPercent1 {
            width: 3.5%;
        }

        .widthPercent2 {
            width: 3.7%;
        }

        .widthPercent3 {
            width: 3.7%;
        }

        #detailsNewTable2 {
            width: 217%;
            border: 1px solid #ddd;
            /*transform: rotateX(180deg);*/
        }

        .header {
            /* Background color */
            /* background-color: #ddd; */

            /* Stick to the top */
            position: sticky;
            top: 0;

            /* Displayed on top of other rows when scrolling */
            z-index: 1;
        }

        #detailsNewTable2 th,
        td {
            border: 1px solid #ddd;
            padding: 2px 5px;
        }

        #detailsNewTable2 tr:first-child th {
            text-align: center;
            background-color: #363636db;
            color: #fff;
            padding: 5px 0px;
        }

        #detailsNewTable2 tr:nth-child(2) th {
            text-align: center;
            background-color: #363636db;
            padding: 5px 0px;
            color: #fff;
        }

        #detailsNewTable2 tr:nth-child(even) td {
            text-align: center;
            background-color: #d2df0d2e;
            color: black;
            padding: 5px 0px;
        }

        #detailsNewTable2 tr:nth-child(odd) td {
            text-align: center;
            background-color: white;
            color: black;
            padding: 5px 0px;
        }


        .viewDetailsCon {
            width: 100%;
            max-height: 470px;
            overflow-x: auto;
            /*overflow-y: auto;*/
            /*margin-bottom: 50px;*/
        }

        .ui-dialog-titlebar {
            color: white;
            background-color: #ce0000;
        }


        .dateSearch {
            position: relative;
            width: 225px;
            /*left: 325px;
            top: -6px;*/
        }

        .bootstrap-select {
            width: 130px !important;
        }

        .dealerIdSelect {
            width: 100%;
            text-align: center;
            height: 50px;
            /*border: 1px solid red;*/
        }

        .dealerIdSelect table {
            /*width: 50%;*/
            /*margin-left: 25%;*/
        }

        .dealerIdSelect table tr td {
            text-align: right;
            border: none;
        }

        #flip {
            /*border: 1px solid red;*/
            position: relative;
            top: -42px;
        }

        #flip label {
            display: inline-block;

        }

        #panel {
            border: 2px solid #333;
            margin: 0px 0px 20px;
        }

        table.summary tr td.hastext {
            text-align: right;
        }

        table.summary tr td.hastext {
            text-align: right;
        }

        /* The container */
        .conchk {
            display: inline-block;
            position: absolute;
            padding-right: 32px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 15px;
            right: 0px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .conchk input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            right: 0;
            height: 22px;
            width: 22px;
            background-color: #9bd1ff;
            border: 1px solid #2196F3;
        }

        /* On mouse-over, add a grey background color */
        .conchk:hover input~.checkmark {
            background-color: #2196F3;
        }

        /* When the checkbox is checked, add a blue background */
        .conchk input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .conchk input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .conchk .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .backcircle {
            font-size: 18px;
            position: absolute;
            margin-top: -25px;
        }

        .backcircle a:hover {
            text-decoration: none !important;
        }

        #gb_bank_ganti {
            position: absolute;
            left: 0px;
            top: -1px;
            background-color: #8de6a7;
            width: 150px;
            padding: 0px 3px;
            display: none;
        }

        .contorlAfterDealer {
            position: absolute;
            width: 408px;
            height: 45px;
            right: 15px;
            top: -6px;
        }

        .printBtnDlr {
            position: absolute;
            top: 0px;
            right: 1px;
            border: 2px solid #46b8da;

        }

        /* .printBtnDlrDown {
            position: absolute;
            top: 0px;
            right: 15px;
            border: 1px solid #46b8da;
        } */

        @media print {

            .no_print_media,
            .no_print_media * {
                display: none !important;
            }
        }

        .btn-info {
            background-color: #F0F0F0 !important;
            color: #000 !important;
        }

        .btn-info:hover {
            background-color: #F0F0F0 !important;
            color: #000 !important;
        }

        #popUpNewBtn {
            width: 30px;
            height: 30px;
            padding: 3px;
            background-color: #9c9c9c;
            background-color: #000;
            position: absolute;
            /*top: 30px;*/
            cursor: pointer;
            /*z-index: 9;*/
        }

        #popupEntry {
            display: none;
            width: 100%;
            background-color: rgba(0, 0, 0, .7);
            height: 100%;
            position: fixed;
            top: 0px;
            z-index: 99999;
        }

        #control_all {
            width: 50%;
            background-color: #fff;
            border: 5px solid #333;
            border-radius: 5px;
            height: 90%;
            position: relative;
            top: 5%;
            left: 50%;
            margin-left: -25%;
            padding: 15px;
        }

        .popupClose {
            position: absolute;
            top: 0px;
            right: 0px;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            padding: 5px;
            border: 1px solid red;
            transition: all .5s;
            cursor: pointer;
        }

        .bar_one {
            width: 20px;
            height: 3px;
            background-color: red;
            transform: rotate(45deg);
            position: relative;
            top: 7px;
            left: -1px;
            transition: all .5s;
        }

        .bar_two {
            width: 20px;
            height: 3px;
            background-color: red;
            transform: rotate(-45deg);
            position: relative;
            top: 4px;
            left: -1px;
            transition: all .5s;
        }

        .popupClose:hover {
            background-color: red;
            transition: all .5s;
        }

        .popupClose:hover .bar_one {
            background-color: #fff;
            transition: all .5s;
        }

        .popupClose:hover .bar_two {
            background-color: #fff;
            transition: all .5s;
        }

        .popupHead {
            text-align: center;
            margin: 15px 0px 15px;
        }

        .popupHead::after {
            content: '';
            height: 3px;
            /*width: 180px;*/
            width: calc(100% - 30px);
            position: absolute;
            left: 15px;
            top: 70px;
            /*margin-left: -98px;*/
            background-color: #ddd;
        }

        .items_all_con {
            /*border: 1px solid red;*/
            height: calc(100% - 63px);
            overflow-y: scroll;
            padding: 15px;
        }

        .pop_btn_con {
            position: relative;
            margin: 25px 0px 10px;
            height: 36px;
        }

        .popup_save_btn {
            width: 40%;
            position: absolute;
            left: 20px;
        }

        .popup_cancel_btn {
            width: 40%;
            position: absolute;
            right: 20px;
        }

        .protidinHisab {
            margin-top: 13px;
        }
    </style>
</head>

<body>
    <?php
    include '../navbar/header_text.php';
    // $page = 'rod_hisab';
    include '../navbar/navbar.php';
    ?>
    <div class="container">
        <?php
        // $ph_id = $_SESSION['project_name_id'];
        // $query = "SELECT * FROM project_heading WHERE id = $ph_id";
        // $show = $db->select($query);
        // if ($show) 
        // {
        // 	while ($rows = $show->fetch_assoc()) 
        // 	{
        ?>
        <!-- <div class="project_heading text-center" id="city_center_id">      
    				  <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
    				  h4 class="text-center"><?php echo $rows['subheading']; ?></h4>
    				</div> -->
        <?php
        // 	}
        // } 
        ?>
        <!-- <p class="text-center">রড ক্রয় হিসাব</p> -->

        <!-- <div class="backcircle">
              <a href="../vaucher/rod_index.php">
                <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
              </a>
            </div> -->

    </div>

    <div class="bar_con">
        <div class="left_side_bar">
            <?php require '../others_page/left_menu_bar_cement_hisab.php'; ?>
        </div>
        <div class="main_bar" style="padding-bottom: 30px;">
            <?php
            $ph_id = $_SESSION['project_name_id'];
            $query = "SELECT * FROM project_heading WHERE id = $ph_id";
            $show = $db->select($query);
            if ($show) {
                while ($rows = $show->fetch_assoc()) {
            ?>
                    <div class="project_heading">
                        <h2 class="headingOfAllProject" id="city_center_id">
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">ক্রয় হিসাব</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; 
                                                                ?></span> -->

                        </h2>
                    </div>
            <?php
                }
            }
            ?>
            <div class="dealerIdSelect">
                <table>
                    <tr>
                        <td><b>Select a Dealer Name :</b></td>
                        <td><?php
                            $sql = "SELECT DISTINCT dealer_name, dealer_id FROM cement_dealer WHERE dealer_name != '' AND  project_name_id = '$project_name_id'";
                            $all_custmr_id = $db->select($sql);
                            echo '<select name="delear_id" id="delear_id" class="form-control form-control-dealer" style="width: 222px;">';
                            // echo '<option value=""></option>';
                            if ($all_custmr_id->num_rows > 0) {
                                while ($row = $all_custmr_id->fetch_assoc()) {
                                    $id = $row['dealer_id'];
                                    $dealer_name = $row['dealer_name'];
                                    echo '<option value="' . $id . '">' . $dealer_name . '</option>';
                                }
                            } else {
                                echo '<option value="none">0 Result</option>';
                            }
                            echo '</select>';
                            ?></td>
                    </tr>
                </table>
            </div>
            <div id="allconid" style="display: none;">
            </div>

        </div>

        <div id="popupEntry">
            <div id="control_all">
                <div class="popupClose">
                    <div class="bar_one"></div>
                    <div class="bar_two"></div>
                </div>
                <h2 class="popupHead" style="color: Green;">ক্রয় হিসাব এন্ট্রি</h2>
                <div class="items_all_con" style="background-color: gray; color: white; border: 2px solid black;">
                    <form id="insertPopupForm">
                        <table style="width: 100%;">
                            <tr>
                                <td>Dealer ID( আই ডি)</td>
                                <td>
                                    <!-- <input type="text" name="customer_id" class="form-control-balu" id="customer_id" placeholder="Enter customer_id..."> -->
                                    <?php
                                    $sql = "SELECT dealer_id FROM cement_dealer WHERE project_name_id ='$project_name_id'";
                                    $all_custmr_id = $db->select($sql);
                                    echo '<select name="dealer_id" id="dealer_id" class="form-control"  required">';
                                    echo '<option value="none">Select...</option>';
                                    if ($all_custmr_id->num_rows > 0) {
                                        while ($row = $all_custmr_id->fetch_assoc()) {
                                            $id = $row['dealer_id'];
                                            echo '<option value="' . $id . '">' . $id . '</option>';
                                        }
                                    } else {
                                        echo '<option value="none">0 Result</option>';
                                    }
                                    echo '</select>';
                                    ?>

                                </td>
                            </tr>



                            <!-- <input type="hidden" name="pathor_details_id" id="pathor_details_id"> -->
                            <tr>
                                <td>Driver Name (ড্রাইভারের নাম)</td>
                                <td>
                                    <input type="text" name="driver_name" class="form-control" id="driver_name_popup" placeholder="Enter Driver Name...">
                                </td>
                            </tr>
                            <tr>
                                <td>Motor Name (গাড়ী নাম)</td>
                                <td>
                                    <input type="text" name="motor_name" class="form-control" id="motor_name_popup" placeholder="Enter Motor Name...">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>id</td>
                                <td>
                                    <input type="text" name ="motor_name" class="form-control" id="motor_name_popup" placeholder="Enter Motor Name...">
                                </td>           
                            </tr> -->
                            <!-- <tr> -->
                           
                            <tr>
                                <td>Motor Vara (গাড়ী ভাড়া)</td>
                                <td>
                                    <input type="text" onkeypress="return isNumber(event)" name="motor_vara" class="form-control value-calc-popup" id="motor_vara_popup" placeholder="Enter Motor Vara...">
                                </td>
                            </tr>
                            <tr>
                                <td>Unload (আনলোড)</td>
                                <td>
                                    <input type="text" onkeypress="return isNumber(event)" name="unload" class="form-control value-calc-popup" id="unload_popup" placeholder="Unload">
                                </td>
                            </tr>
                            <tr>
                                <td>Cars rent & Redeem (গাড়ী ভাড়া ও খালাস)</td>
                                <td>
                                    <input type="text" name="cars_rent_redeem" class="form-control value-calc-popup" id="car_rent_redeem_popup" placeholder="Enter cars rent & redeem...">
                                </td>
                            </tr>
                            <tr>
                                <td>Information (মালের বিবরণ)</td>
                                <td>
                                    <input type="text" name="information" class="form-control" id="information_popup" placeholder="Enter information...">
                                </td>
                            </tr>
                            <tr>
                                <td>SL (ক্রমিক)</td>
                                <td>
                                    <input type="text" name="sl_no" class="form-control" id="sl_popup" placeholder="Enter SL...">
                                </td>
                            </tr>
                            <tr>
                                <td>Challan No. (ভাউচার নং)</td>
                                <td>
                                    <input type="text" name="voucher_no" class="form-control" id="voucher_no_popup" placeholder="Enter Voucher No...">
                                </td>
                            </tr>
                            <tr>
                                <td>Address (ঠিকানা)</td>
                                <td>
                                    <input type="text" name="address" class="form-control" id="address_popup" placeholder="Enter address...">
                                </td>
                            </tr>
                            <tr>
                                <td>Motor Number (গাড়ী নাম্বার)</td>
                                <td>
                                    <input type="text" name="motor_number" class="form-control" id="motor_number_popup" placeholder="Enter motor number...">
                                </td>
                            </tr>

                            <tr>
                                <td>Motor Sl (গাড়ী নং)</td>
                                <td>
                                    <input type="text" name="motor_sl" class="form-control" id="motor_sl_popup" placeholder="Enter Motor Sl...">
                                </td>
                            </tr>
                            <tr>
                                <td>Delivery Date (ডেলিভারি তারিখ)</td>
                                <td>
                                    <input onkeypress="datecheckformatpopup(event)" type="text" name="delivery_date" class="form-control" id="delivery_date_popup" placeholder="dd-mm-yyyy">
                                </td>
                            </tr>
                            <tr>
                                <td>Date (তারিখ)</td>
                                <td>
                                    <input onkeypress="datecheckformatpopup(event)" type="text" name="dates" class="form-control" id="dates_popup" placeholder="dd-mm-yyyy">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>Partculars (মারফোত নাম)</td>
                                <td>
                                    <input type="text" name="partculars" class="form-control" id="partculars_popup" placeholder="Enter partculars...">
                                </td>
                            </tr>
                            <tr>
                                <td>Particulars (বিবরণ)</td>
                                <td>
                                    <?php
                                    $pathor_catgry_sql = "SELECT * FROM pathor_category";
                                    $rslt_pathor_catgry = $db->select($pathor_catgry_sql);

                                    echo '<select name="particulars" id="particulars_popup" class="form-control">';
                                    echo '<option value="">Select...</option>';
                                    if ($rslt_pathor_catgry->num_rows > 0) {
                                        while ($row = $rslt_pathor_catgry->fetch_assoc()) {
                                            $pathor_category_id = $row['id'];
                                            $pathor_category_name = $row['category_name'];

                                            echo '<option style="font-weight: bold;">' . $pathor_category_name . '</option>';

                                            $pathor_lbl_sql = "SELECT * FROM pathor_and_other_label";
                                            $rslt_pathor_lbl = $db->select($pathor_lbl_sql);
                                            if ($rslt_pathor_lbl->num_rows > 0) {

                                                while ($row2 = $rslt_pathor_lbl->fetch_assoc()) {
                                                    $raol_id = $row2['id'];
                                                    $raol_pathor_label = $row2['pathor_label'];
                                                    $raol_pathor_category_id = $row2['pathor_category_id'];


                                                    if ($pathor_category_id == $raol_pathor_category_id) {
                                                        echo "<option value='" . $raol_pathor_label . "'>" . $raol_pathor_label . "</option>";
                                                    }
                                                }
                                            } else {
                                                echo '<option>0 results</option>';
                                            }
                                        }
                                    } else {
                                        echo '<option>0 results</option>';
                                    }
                                    echo '</select> ';
                                    ?>
                                </td>
                            </tr> -->
                            <tr>
                                <td>Debit (জমা টাকা)</td>
                                <td>
                                    <input type="text" name="debit" class="form-control value-calc-popup" id="debit_popup" placeholder="Enter debit...">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>Ton & Kg (টোন ও কেজি)</td>
                                <td>
                                    <input type="text" name="ton_kg" class="form-control" id="ton_kg_popup" placeholder="Enter Ton & Kg...">
                                </td>
                            </tr>
                            <tr>
                                <td>Length (দৈর্ঘ্যের)</td>
                                <td>
                                    <input type="text" name="length" class="form-control" id="length_popup" placeholder="Enter Length...">
                                </td>
                            </tr>
                            <tr>
                                <td>Width (প্রস্ত)</td>
                                <td>
                                    <input type="text" name="width" class="form-control" id="width_popup" placeholder="Enter Width...">
                                </td>
                            </tr>
                            <tr>
                                <td>Height (উচাঁ)</td>
                                <td>
                                    <input type="text" name="height" class="form-control" id="height_popup" placeholder="Enter height...">
                                </td>
                            </tr>
                            <tr>
                                <td>Shifty (সেপ্টি)</td>
                                <td>
                                    <input type="text" name="shifty" class="form-control" id="shifty_popup" placeholder="Enter Shifty...">
                                </td>
                            </tr>
                            <tr>
                                <td>Inchi (-) Minus (Inchi (-) বিয়োগ )</td>
                                <td>
                                    <input type="text" name="inchi_minus" class="form-control" id="inchi_minus_popup" placeholder="Enter Inchi (-) Minus...">
                                </td>
                            </tr>
                            <tr>
                                <td>Cft ( - ) Dropped Out (সিএফটি ( - ) বাদ)</td>
                                <td>
                                    <input type="text" name="cft_dropped_out" class="form-control" id="cft_dropped_popup" placeholder="Enter Cft ( - ) Dropped Out ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Inchi (+) Added (Inchi (+) যোগ) </td>
                                <td>
                                    <input type="text" name="inchi_added" class="form-control" id="inchi_added_popup" placeholder="Enter Inchi (+) Added ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Points ( - ) Dropped Out (পয়েন্ট ( - ) বাদ) </td>
                                <td>
                                    <input type="text" name="points_dropped_out" class="form-control" id="points_dropped_popup" placeholder="Enter Points ( - ) Dropped Out ...">
                                </td>
                            </tr>
                            <tr>
                                <td> Shift(সেপ্টি) </td>
                                <td>
                                    <input type="text" name="shift" class="form-control" id="shift_popup" placeholder="Enter Shift ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Total Shift(মোট সেপ্টি) </td>
                                <td>
                                    <input type="text" name="total_shift" class="form-control" id="total_shift_popup" placeholder="Enter Total Shift ...">
                                </td>
                            </tr> -->
                            <tr>
                                <td> Para's (দর) </td>
                                <td>
                                    <input type="text" name="paras" class="form-control value-calc-popup" id="paras_popup" placeholder="Enter Paras ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Discount(কমিশন) </td>
                                <td>
                                    <input type="text" name="discount" class="form-control value-calc-popup" id="discount_popup" placeholder="Enter Discount ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Credit(মূল) </td>
                                <td>
                                    <input type="text" name="credit" class="form-control value-calc-popup" id="credit_popup" placeholder="Enter Credit ...">
                                </td>
                            </tr>
                            <tr>
                                <td> Balance(অবশিষ্ট) </td>
                                <td>
                                    <input type="text" name="balance" class="form-control value-calc-popup" id="balance_popup" placeholder="Enter Balance  ...">
                                </td>
                            </tr>

                            <tr>
                                <td>Cemeat's Para's (গাড়ী ভাড়া / লেবার সহ)</td>
                                <td>
                                    <input type="text" name="cemeats_paras" class="form-control value-calc-popup" id="cemeats_paras_popup" placeholder="Enter Cemeat's Para's...">
                                </td>
                            </tr>
                            <!-- <td>Ton(টোন)</td>
                            <td>
                                <input type="text" name="ton" class="form-control" id="ton _popup" placeholder="Enter Ton...">
                            </td>
                            </tr>
                            <tr>
                                <td>Total Shifts(সেপ্টি)</td>
                                <td>
                                    <input type="text" name="total_shifts" class="form-control" id="total_shifts_popup" placeholder="Enter Total Shifts...">
                                </td>
                            </tr> -->
                            <tr>
                                <td>Tons (টোন)</td>
                                <td>
                                    <input type="text" name="tons" class="form-control" id="tons_popup" placeholder="Enter Tons...">
                                </td>
                            </tr>
                            <tr>
                                <td>Bank Name</td>
                                <td>
                                    <input type="text" name="bank_name" class="form-control" id="bank_name_popup" placeholder="Enter Bank Name...">
                                </td>
                            </tr>
                            <tr>
                                <td>Fee(ফি)</td>
                                <td>
                                    <input type="text" name="fee" class="form-control value-calc-popup" id="fee_popup" placeholder="Enter Fee...">
                                </td>
                            </tr>
                        </table>
                        <h4 class="text-success text-center" id="NewEntrySucMsgPopup"></h4>
                        <?php
                        // $sql = "SELECT id FROM details_pathor";
                        // $id = $db->select($sql);
                        // if ($id->num_rows > 0) {
                        //     while ($row = $id->fetch_assoc()) {
                        //         $id2 = $row['id'];
                        //        echo '<input type="hidden" name="pathor_details_id" id="pathor_details_id" value="' . $id2 . '">' ;
                        //     }
                        // } 
                        ?>
                        <input type="hidden" name="pathor_details_id" id="pathor_details_id">
                        <div class="pop_btn_con">
                            <input onclick="valid('insert_popup')" type="button" name="submit" class="btn btn-primary popup_save_btn" value="Save" id="popup_save_update_btn">
                            <input type="button" class="btn btn-danger popup_cancel_btn" value="Cancel" id="popup_cancel_btn">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../others_page/delete_permission_modal.php';  ?>



    <script>
        $(document).on("click", "#flipChkbox", function() {
            if ($('#flipChkbox input[type="checkbox"]').prop("checked") == true) {
                // alert("Checkbox is checked.");
                $("#panel").slideDown("slow");
            } else if ($('#flipChkbox input[type="checkbox"]').prop("checked") == false) {
                // alert("Checkbox is unchecked.");
                $("#panel").slideUp("slow");
            }
        });
        // onkeypress="return isNumber(event)"
    </script>
    <script type="text/javascript">
        function dealerWiseSummaryDetailsSearchAndEntry(dlrId, restext = false) {
            $.ajax({
                url: '../ajaxcall/cement_dealer_wise_summary_details_search_and_entry.php',
                type: 'post',
                data: {
                    dealerId: dlrId,
                },
                success: function(res) {
                    // alert(res);
                    $('#allconid').html(res);

                    if (restext != false) {
                        $('#NewEntrySucMsg').html(restext).show();
                        $('#NewEntrySucMsgPopup').html(restext).show();
                    }

                    $('.selectpicker').selectpicker();


                    $('#delivery_date').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });


                    $('#dates').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });

                    $('#flipChkbox input[type="checkbox"]').prop("checked", true);
                    // $('#gb_bank_ganti').hide();

                    // $(document).on('keypress', '#gb_bank_ganti', function(e){
                    //     if (e.which == 13){
                    //       alert('Hiii');
                    //     }
                    // }
                    $('.left_side_bar').height($('.main_bar').height());

                    $("#popUpNewBtn").click(function() {
                        $("#NewEntrySucMsg").html('');
                        $('#NewEntrySucMsgPopup').html('');
                        // $('#popup_save_update_btn').val('Save').attr("onclick", "valid('insert_popup')");

                        $("#popupEntry").fadeIn(500);
                        $(".items_all_con").animate({
                            scrollTop: 0
                        }, "0");
                        // $(".items_all_con").scrollTop(0);
                        // console.log('red');
                    });

                    $(".popupClose").click(function() {
                        $("#popupEntry").fadeOut(500);
                        $('#buyer_id_popup').val("none").change();
                        $('#motor_name_popup').val('');
                        $('#driver_name_popup').val('');
                        $('#motor_vara_popup').val('');
                        $('#unload_popup').val('');
                        $('#car_rent_redeem_popup').val('');
                        $('#information_popup').val('');
                        $('#sl_popup').val('');
                        $('#voucher_no_popup').val('');
                        $('#address_popup').val('');
                        $('#motor_number_popup').val('');
                        $('#motor_sl_popup').val('');
                        $('#delivery_date_popup').val('');
                        $('#dates_popup').val('');
                        $('#partculars_popup').val('');
                        $('#particulars_popup').val("").change();
                        $('#debit_popup').val('');
                        $('#ton_kg_popup').val('');
                        $('#length_popup').val('');
                        $('#width_popup').val('');
                        $('#height_popup').val('');
                        $('#shifty_popup').val('');
                        $('#inchi_minus_popup').val('');
                        $('#cft_dropped_popup').val('');
                        $('#inchi_added_popup').val('');
                        $('#points_dropped_popup').val('');
                        $('#shift_popup').val('');
                        $('#total_shift_popup').val('');
                        $('#paras_popup').val('');
                        $('#discount_popup').val('');
                        $('#credit_popup').val('');
                        $('#balance_popup').val('');
                        $('#cemeats_paras_popup').val('');
                        $('#ton_popup').val('');
                        $('#total_shifts_popup').val('');
                        $('#tons_popup').val('');
                        $('#bank_name_popup').val('');
                        $('#fee_popup').val('');
                        $("#NewEntrySucMsg").html('');
                        $("#NewEntrySucMsgPopup").html('');
                    });
                    $("#popup_cancel_btn").click(function() {
                        $(".popupClose").trigger('click');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function getDealerNameByDealerId(dlrIda) {
            $.ajax({
                url: '../ajaxcall/cement_get_dealer_name_by_dealer_id.php',
                type: 'post',
                data: {
                    dealerId: dlrIda,
                },
                success: function(res) {
                    // alert(res);
                    $('#city_center_id').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        $(document).on('change', '#delear_id', function() {
            var optionValue = $('#delear_id option:selected').val();
            // alert(optionValue);
            if (optionValue === '') {
                $('#allconid').css('display', 'none');
            } else {
                dealerWiseSummaryDetailsSearchAndEntry(optionValue);
                $('#allconid').css('display', 'block');
            }
            getDealerNameByDealerId(optionValue);
        });

        $("#delear_id").val("DLAR-100001").change();
    </script>
    <script type="text/javascript">
        $(document).on('click', '.detailsDelete', function(event) {
            var data_delete_id = $(event.target).attr('data_delete_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").removeAttr("data_delete_id");
            $("#verifyToDeleteBtn").attr("data_delete_id", data_delete_id);
        });
        $(document).on('click', '#verifyToDeleteBtn', function(event) {
            event.preventDefault();
            var data_delete_id = $(event.target).attr('data_delete_id');
            console.log('detailsDelete', data_delete_id);
            $("#passMsg").html("").css({
                'margin': '0px'
            });
            var pass = $("#matchPassword").val();
            $.ajax({
                url: "../ajaxcall/balu_match_password_for_vaucher_credit.php",
                type: "post",
                data: {
                    pass: pass
                },
                success: function(response) {
                    // alert(response);
                    if (response == 'password_matched') {
                        $("#verifyPasswordModal").hide();
                        ConfirmDialog('Are you sure delete details info?', data_delete_id);
                    } else {
                        $("#passMsg").html(response).css({
                            'color': 'red',
                            'margin-top': '10px'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

            function ConfirmDialog(message, data_delete_id) {
                $('<div></div>').appendTo('body')
                    .html('<div><h4>' + message + '</h4></div>')
                    .dialog({
                        modal: true,
                        title: 'Alert',
                        zIndex: 10000,
                        autoOpen: true,
                        width: '40%',
                        resizable: false,
                        position: {
                            my: "center",
                            at: "center center-20%",
                            of: window
                        },
                        buttons: {
                            Yes: function() {
                                var urltxt = '../ajaxcall/cement_del_entry_ajax.php';
                                $.ajax({
                                    url: urltxt,
                                    type: 'post',
                                    dataType: 'html',
                                    data: {
                                        'rod_details_id': data_delete_id
                                    },
                                    success: function(res) {
                                        console.log(res);
                                        // alert(res);
                                        var optionValue = $('#delear_id option:selected').val();
                                        dealerWiseSummaryDetailsSearchAndEntry(optionValue, res);
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus, errorThrown);
                                    }
                                });
                                $(this).dialog("close");
                                //   $.get("rod_details_entry.php?remove_id="+ data_delete_id, function(data, status){
                                // console.log(status);
                                //    if(status == 'success'){
                                //      window.location.href = 'rod_details_entry.php';
                                //    }
                                //   });
                            },
                            No: function() {
                                $(this).dialog("close");
                            }
                        },
                        close: function(event, ui) {
                            $(this).remove();
                        }
                    });
            };
        });
    </script>
    <script type="text/javascript">
        function valid(submit_type) {
            var returnValid = false;

            if (submit_type == 'insert') {
                var buyer_id = $('#buyer_id').val();
                var partculars = $('#partculars').val();
                var particulars = $('#particulars').val();

                if (buyer_id == 'none') {
                    alert('Please select a buyer Id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }

                if (partculars == 'none') {
                    alert('Please select a marfot name');
                    returnValid = false;
                } else {
                    returnValid = true;
                }

                if (particulars == 'none') {
                    alert('Please select a particular');
                    returnValid = false;
                } else {
                    returnValid = true;
                }

                var formElement = $('#form_entry')[0];
                var formData = new FormData(formElement);
                var urltxt = '../ajaxcall/cement_details_entry_ajax.php';

            } else if (submit_type == 'insert_popup') {
                var buyer_id = $('#buyer_id_popup').val();

                if (buyer_id == 'none') {
                    alert('Please select a buyer Id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }
                var formElement = $('#insertPopupForm')[0];
                var formData = new FormData(formElement);
                var urltxt = '../ajaxcall/cement_details_entry_ajax.php';

            } else {
                ////Horizontal Edit er code
                // var buyer_id_edit = $('#buyer_id_edit').val();

                // if(buyer_id_edit == 'none'){
                //     alert('Please select a buyer Id');
                //     returnValid = false;
                // } else{
                //     returnValid = true;
                // }
                // var formElement = $('#form_edit')[0];
                // var formData = new FormData(formElement);
                // var urltxt = '../ajaxcall/rod_update_entry_ajax.php';

                ////Popup edit/update er code
                var buyer_id = $('#buyer_id_popup').val();

                if (buyer_id == 'none') {
                    alert('Please select a buyer Id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }
                var formElement = $('#insertPopupForm')[0];
                var formData = new FormData(formElement);
                var urltxt = '../ajaxcall/cement_update_entry_ajax.php';

            }

            if (returnValid) {
                $.ajax({
                    url: urltxt,
                    type: 'post',
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(res) {
                        console.log(res);
                        // alert(res);          
                        var optionValue = $('#delear_id option:selected').val();
                        dealerWiseSummaryDetailsSearchAndEntry(optionValue, res);

                        $('#buyer_id_popup').val("none").change();
                        $('#motor_name_popup').val('');
                        $('#driver_name_popup').val('');
                        $('#motor_vara_popup').val('');
                        $('#unload_popup').val('');
                        $('#car_rent_redeem_popup').val('');
                        $('#information_popup').val('');
                        $('#sl_popup').val('');
                        $('#voucher_popup').val('');
                        $('#address_popup').val('');
                        $('#motor_number_popup').val('');
                        $('#motor_sl_popup').val('');
                        $('#delivery_date_popup').val('');
                        $('#dates_popup').val('');
                        $('#partculars_popup').val('');
                        $('#particulars_popup').val("").change();
                        $('#debit_popup').val('');
                        $('#ton_kg_popup').val('');
                        $('#length_popup').val('');
                        $('#width_popup').val('');
                        $('#height_popup').val('');
                        $('#shifty_popup').val('');
                        $('#inchi_minus_popup').val('');
                        $('#cft_dropped_popup').val('');
                        $('#inchi_added_popup').val('');
                        $('#points_dropped_popup').val('');
                        $('#shift_popup').val('');
                        $('#total_shift_popup').val('');
                        $('#paras_popup').val('');
                        $('#discount_popup').val('');
                        $('#credit_popup').val('');
                        $('#balance_popup').val('');
                        $('#cemeats_paras_popup').val('');
                        $('#ton_popup').val('');
                        $('#total_shifts_popup').val('');
                        $('#tons_popup').val('');
                        $('#bank_name_popup').val('');
                        $('#fee_popup').val('');
                        $('#NewEntrySucMsgPopup').html('');
                        // $('#popup_save_update_btn').val('Save').attr("onclick", "valid('insert_popup')");

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        }
    </script>
    <script type="text/javascript">
        function edit_rod_details(rod_id) {
            $('.rodDetailsEnCon').hide();
            var urltxt = '../ajaxcall/cement_edit_entry_ajax.php';
            $.ajax({
                url: urltxt,
                type: 'post',
                dataType: 'html',
                // processData: false,
                // contentType: false,
                data: {
                    'cement_details_id': rod_id
                },
                success: function(res) {
                    console.log(res);
                    // alert(res);
                    $('.rodDetailsEdit').html(res).show();
                    window.scrollTo(0, 500);



                    $('#delivery_date_edit').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });
                    $('#dates_edit').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function edit_rod_popup(element, rowid) {
            var buyr_id = $(element).closest('tr').find('td:eq(0)').text();
            // var dlar_id         = $(element).closest('tr').find('td:eq(1)').text();
            var motor_name = $(element).closest('tr').find('td:eq(1)').text();
            var driver_name = $(element).closest('tr').find('td:eq(2)').text();
            var motor_vara = $(element).closest('tr').find('td:eq(3)').text();
            var unload = $(element).closest('tr').find('td:eq(4)').text();
            var cars_rent_redeem = $(element).closest('tr').find('td:eq(5)').text();
            var information = $(element).closest('tr').find('td:eq(6)').text();
            var sl = $(element).closest('tr').find('td:eq(7)').text();
            var voucher_no = $(element).closest('tr').find('td:eq(8)').text();
            var address = $(element).closest('tr').find('td:eq(9)').text();
            var motor_number = $(element).closest('tr').find('td:eq(10)').text();
            var motor_sl = $(element).closest('tr').find('td:eq(11)').text();
            var delivery_date = $(element).closest('tr').find('td:eq(12)').text();
            var date = $(element).closest('tr').find('td:eq(13)').text();
            var partculars = $(element).closest('tr').find('td:eq(14)').text();
            var particulars = $(element).closest('tr').find('td:eq(15)').text();
            var debit = $(element).closest('tr').find('td:eq(16)').text();
            var ton_kg = $(element).closest('tr').find('td:eq(17)').text();
            var length = $(element).closest('tr').find('td:eq(18)').text();
            var width = $(element).closest('tr').find('td:eq(19)').text();
            var height = $(element).closest('tr').find('td:eq(20)').text();
            var shifty = $(element).closest('tr').find('td:eq(21)').text();
            var inchi_minus = $(element).closest('tr').find('td:eq(22)').text();
            var cft_dropped = $(element).closest('tr').find('td:eq(23)').text();
            var inchi_added = $(element).closest('tr').find('td:eq(24)').text();
            var points_dropped = $(element).closest('tr').find('td:eq(25)').text();
            var shift = $(element).closest('tr').find('td:eq(26)').text();
            var total_shift = $(element).closest('tr').find('td:eq(27)').text();
            var paras = $(element).closest('tr').find('td:eq(28)').text();
            var discount = $(element).closest('tr').find('td:eq(29)').text();
            var credit = $(element).closest('tr').find('td:eq(30)').text();
            var balance = $(element).closest('tr').find('td:eq(31)').text();
            var cemeats_paras = $(element).closest('tr').find('td:eq(32)').text();
            var ton = $(element).closest('tr').find('td:eq(33)').text();
            var total_shift = $(element).closest('tr').find('td:eq(34)').text();
            var tons = $(element).closest('tr').find('td:eq(35)').text();
            var bank_name = $(element).closest('tr').find('td:eq(36)').text();
            var fee = $(element).closest('tr').find('td:eq(37)').text();


            // alert(buyr_id);
            // $('#dealer_id').val(dlar_id);
            $('#pathor_details_id').val(rowid);


            $('#buyer_id_popup').val(buyr_id);
            $('#motor_name_popup').val(motor_name);
            $('#driver_name_popup').val(driver_name);
            $('#motor_vara_popup').val(motor_vara);
            $('#unload_popup').val(unload);
            $('#car_rent_redeem_popup').val(cars_rent_redeem);
            $('#information_popup').val(information);
            $('#sl_popup').val(sl);
            $('#voucher_no_popup').val(voucher_no);
            $('#address_popup').val(address);
            $('#motor_number_popup').val(motor_number);
            $('#motor_sl_popup').val(motor_sl);
            $('#delivery_date_popup').val(delivery_date);
            $('#dates_popup').val(date);
            $('#partculars_popup').val(partculars);
            $('#particulars_popup').val(particulars);
            $('#debit_popup').val(debit);
            $('#ton_kg_popup').val(ton_kg);
            $('#length_popup').val(length);
            $('#width_popup').val(width);
            $('#height_popup').val(height);
            $('#shifty_popup').val(shifty);
            $('#inchi_minus_popup').val(inchi_minus);
            $('#cft_dropped_popup').val(cft_dropped);
            $('#inchi_added_popup').val(inchi_added);
            $('#points_dropped_popup').val(points_dropped);
            $('#shift_popup').val(shift);
            $('#total_shift_popup').val(total_shift);
            $('#paras_popup').val(paras);
            $('#discount_popup').val(discount);
            $('#credit_popup').val(credit);
            $('#balance_popup').val(balance);
            $('#cemeats_paras_popup').val(cemeats_paras);
            $('#ton_popup').val(ton);
            $('#total_shift_popup').val(total_shift);
            $('#tons_popup').val(tons);
            $('#bank_name_popup').val(bank_name);
            $('#fee_popup').val(fee);
            $('#popup_save_update_btn').val('Update').attr("onclick", "valid('update_popup')").click(function() {
                $(".popupClose").trigger('click');
            });
            $("#popupEntry").fadeIn(500);
            $("#NewEntrySucMsgPopup").html('');
            $(".items_all_con").animate({
                scrollTop: 0
            }, "0");
        }
    </script>
    <script type="text/javascript">
        //Start calculation
        $(document).on('input change paste keyup', '.value-calc', function() {

            // var input_cft = $('#shift').val();
            // if(input_cft != ''){
            //     $('#total_shift').val(input_cft);
            //         $('#total_shifts').val(input_cft);
            // }



            if (count != '') {
                $('#paras').attr("placeholder", "rate");
                var count = $('#count').val();
                var paras = $('#paras').val();

                var weight = count / 20;
                $('#weight').val(weight.toFixed(2));

                if (count == '') {
                    $('#credit').val('0');
                } else if (paras == '') {
                    $('#credit').val('0');
                } else {
                    var credit = count * paras;
                    //  alert(credit);
                    $('#credit').val(credit.toFixed(2));
                }
            }


            // if(length != ''){
            //     $('#paras').attr("placeholder", "per cft");
            //     var t_s = $('#total_shift').val();
            //             var paras = $('#paras').val();
            //             if (t_s == '') {
            //                 $('#credit').val('0');
            //             } else if (paras == '') {
            //                 $('#credit').val('0');
            //             } else {
            //                 var credit_ts = t_s * paras;
            //                 //  alert(credit);
            //                 $('#credit').val(credit_ts.toFixed(2));
            //             }
            // }
            // else{
            //     $('#paras').attr("placeholder", "per ton");

            // }

            // //shifty
            // var length = $('#length').val();
            // var width = $('#width').val();
            // var height = $('#height').val();

            // var inchi_minus = $("#inchi_minus").val();
            // var cft_dropped_out = $('#cft_dropped_out').val();
            // var inchi_added = $('#inchi_added').val();
            // var points_dropped_out = $('#points_dropped_out').val();


            // if (length != '' || width != '' || height != '') {

            //     $("#kg").attr("placeholder", "not applicable").prop("disabled", true);
            //     $("#td_kg").click(function() {
            //         Swal.fire("Clear cft first");
            //     });
            //     var shifty = length * width * height;
            //     if (inchi_minus > shifty) {
            //         Swal.fire("Not acceptable. Value should be less then cft");
            //         $('#inchi_minus').val("");
            //     }
            //     if (cft_dropped_out > shifty) {
            //         Swal.fire("Not acceptable. Value should be less then cft");
            //         $('#cft_dropped_out').val("");
            //     }
            //     if (points_dropped_out > shifty) {
            //         Swal.fire("Not acceptable. Value should be less then cft");
            //         $('#points_dropped_out').val("");
            //     }
            //     if (shifty < 0) {
            //         $('#shifty').val("");
            //     }
            //     if (inchi_minus != '' || cft_dropped_out != '' || inchi_added != '' || points_dropped_out != '') {
            //         var shifty2 = (length * width * height) - (length * width * inchi_minus / 12) - cft_dropped_out + (length * width * inchi_added / 12) - points_dropped_out;
            //         var shift2_to_ton = shifty2 / 23.5;
            //         // alert(credit);
            //         $('#shifty').val(shifty.toFixed(3));
            //         $('#ton').val(shift2_to_ton.toFixed(2));
            //         $('#tons').val(shift2_to_ton.toFixed(2));
            //         $('#shift').val(shifty2.toFixed(3));

            //         // $('#shift').attr('value', 'shifty2.toFixed(3)');
            //         // $('#total_shift').val(shifty2.toFixed(2));
            //         // $('#total_shifts').val(shifty2.toFixed(2));
            //     } else {
            //         var shift_to_ton = shifty / 23.5;
            //         // alert(credit);
            //         $('#shifty').val(shifty.toFixed(3));
            //         $('#ton').val(shift_to_ton.toFixed(2));
            //         $('#tons').val(shift_to_ton.toFixed(2));
            //         $('#shift').val(shifty.toFixed(3));
            //         // $('#total_shift').val(shifty.toFixed(2));
            //         // $('#total_shifts').val(shifty.toFixed(2));

            //     }
            // } else if (width == '') {
            //     $("#kg").attr("placeholder", "ton and kg");
            //     $("#kg").prop("disabled", false);
            //     $('#shift').attr("placeholder", "not applicable");
            //     $('#shifty').attr("placeholder", "not applicable");

            // } else if (height == '') {
            //     $("#kg").attr("placeholder", "ton and kg");
            //     $("#kg").prop("disabled", false);
            //     $('#shift').attr("placeholder", "not applicable");
            //     $('#shifty').attr("placeholder", "not applicable");
            // } else if (length == '') {
            //     $("#kg").attr("placeholder", "ton and kg");
            //     $("#kg").prop("disabled", false);
            //     $('#shift').attr("placeholder", "not applicable");
            //     $('#shifty').attr("placeholder", "not applicable");
            //     // $('#total_shifty').val('0');
            // }
            // // else if(length != ''){
            // //     $('#kg').val('0');
            // // }
            // else {



            // }


            // //ton and kg
            // var shifty = $('#shift').val();
            // var ton_kg = $('#kg').val();
            // var credit = $("#credit").val();

            // if (ton_kg != '') {
            //     $("#length").attr("placeholder", "not applicable").prop("disabled", true);
            //     $("#length").attr("readonly", true);
            //     // if($("#length").click){
            //     //     Swal.fire("Should be enter a number value");
            //     // }
            //     // $('#length').val('not applicable');
            //     $('#width').attr("placeholder", "not applicable").prop("disabled", true);
            //     $("#width").attr("readonly", true);
            //     $('#height').attr("placeholder", "not applicable").prop("disabled", true);
            //     $("#height").attr("readonly", true);

            //     $('#shifty').attr("placeholder", "not applicable").prop("disabled", true);
            //     $('#shift').attr("placeholder", "not applicable").prop("disabled", true);
            //     $('#total_shift').attr("placeholder", "not applicable").prop("disabled", true);
            //     $('#ton').attr("placeholder", "not applicable").prop("disabled", true);
            //     // $('#height').attr("placeholder", "not applicable").prop("disabled", true).css("background-color","gray");
            //     // $("#height").attr("readonly", true);
            //     // $('#').attr("value", "not applicable");
            //     $('#inchi_minus').attr("placeholder", "not applicable").prop("disabled", true);
            //     $("#inchi_minus").attr("readonly", true);
            //     $('#cft_dropped_out').attr("placeholder", "not applicable").prop("disabled", true);
            //     $("#cft_dropped_out").attr("readonly", true);
            //     $('#inchi_added').attr("placeholder", "not applicable").prop("disabled", true);
            //     $("#inchi_added").attr("readonly", true);
            //     $('#points_dropped_out').attr("placeholder", "not applicable").prop("disabled", true);
            //     $("#points_dropped_out").attr("readonly", true);
            //     // $('#').attr("value", "not applicable");
            //     $('#ton').val(ton_kg);
            //     $('#tons').val(ton_kg);

            //     var ton_to_cft = (ton_kg * 23.5).toFixed(3);
            //     // $('#shifty').val(ton_to_cft);
            //     // $('#shift').val(ton_to_cft);
            //     // $('#total_shift').val(ton_to_cft);
            //     // $('#total_shifts').val(ton_to_cft);
            // } else {
            //     $("#length").attr("placeholder", "length").prop("disabled", false);
            //     $("#length").attr("readonly", false);
            //     // $('#length').val('not applicable');
            //     $('#width').attr("placeholder", "width").prop("disabled", false);
            //     $("#width").attr("readonly", false);
            //     $('#height').attr("placeholder", "height").prop("disabled", false);
            //     $("#height").attr("readonly", false);
            //     $('#inchi_minus').attr("placeholder", "inchi_minus").prop("disabled", false);
            //     $("#inchi_minus").attr("readonly", false);
            //     $('#cft_dropped_out').attr("placeholder", "cft_dropped_out").prop("disabled", false);
            //     $("#cft_dropped_out").attr("readonly", false);
            //     $('#inchi_added').attr("placeholder", "inchi_added").prop("disabled", false);
            //     $("#inchi_added").attr("readonly", false);
            //     $('#points_dropped_out').attr("placeholder", "points_dropped_out").prop("disabled", false);
            //     $("#points_dropped_out").attr("readonly", false);


            //     $('#shifty').prop("disabled", true);
            //     $('#shift').prop("disabled", true);
            //     $('#total_shift').prop("disabled", false);
            //     $('#ton').prop("disabled", false);

            //     var credit = shifty * paras;
            //     // alert(credit);
            //     $('#credit').val(credit.toFixed(3));
            // }

            // var total_input_cft = $('#total_shift').val();
            // if (total_input_cft != '') {
            //     $('#paras').attr("placeholder", "per cft");

            //     var paras = $('#paras').val();
            //     // if (kg == '') {
            //     //     $('#credit').val('0');
            //     // } else if (paras == '') {
            //     //     $('#credit').val('0');
            //     // } else {
            //     var credit = total_input_cft * paras;
            //     //  alert(credit);
            //     $('#credit').val(credit.toFixed(2));
            //     // }
            // }


            var discount = $("#discount").val();
            if (discount != '') {
                var credit = credit - discount;
                $('#credit').val(credit.toFixed(3));
                if (discount > credit) {
                    $('#discount').focus(function() {
                        $('#discount').val("");
                    });
                    Swal.fire("Not acceptable. Value should be less then credit");
                }
            }
            // var fee = $("#fee").val();
            // if (fee != '') {
            //     var credit = parseFloat(credit) + parseFloat(fee);
            //     $('#credit').val(credit.toFixed(3));
            // }



            // // console.log(inchi_minus);
            // // console.log(ton_kg);

            // // if (inchi_minus != '') {
            // //     console.log(inchi_minus);
            // //     $('#shift').val(inchi_minus);
            // //     $('#total_shift').val('test');

            // // }

            // // if (cft_dropped_out != '') {
            // //     console.log(cft_dropped_out);

            // // }

            // // var car_rent_redeem = $('#car_rent_redeem').val();
            // // var credit = $("#credit").val();
            // // if (car_rent_redeem == '') {
            // //     var total_paras = credit;
            // //     $('#credit').val(total_paras);
            // // } else {
            // //     var total_paras = parseFloat(car_rent_redeem) + parseFloat(credit);
            // //     $('#credit').val(total_paras);
            // // }
            // // debit theke minus hote ai part tuku age dite hobe

            var debit = $("#debit").val();
            var credit = $("#credit").val();
            if (debit == '') {
                $('#balance').val('0');
            } else if (credit == '') {
                $('#balance').val('0');
            } else {
                var balance = credit - debit;
                // alert(balance);
                $('#balance').val(balance.toFixed(3));
            }

            // var motor_vara = $('#motor_vara').val();
            // var unload = $('#unload').val();
            // if (motor_vara == '') {
            //     $('#motor_vara').attr("placeholder", "motor vara");
            //     //  $('#motor_vara').attr("value", "0");
            //     //  $('#motor_vara').val(0);

            //     $('#car_rent_redeem').val(unload);
            //     $('#cemeats_paras').val(unload);
            // } else if (unload == '') {
            //     $('#unload').attr("placeholder", "unload");
            //     //  $('#unload').attr("value", "0");
            //     //  $('#unload').val(0);

            //     $('#car_rent_redeem').val(motor_vara);
            //     $('#cemeats_paras').val(motor_vara);
            // } else if (unload == 0 && motor_vara == 0) {
            //     $('#car_rent_redeem').val(0);
            // } else {


            //     //                 $('#motor_vara').focus(function(){
            //     //                     $('#motor_vara').value('')
            //     // });

            //     var car_rent_redeem = parseInt(motor_vara) + parseInt(unload);
            //     // alert(balance);
            //     $('#car_rent_redeem').val(car_rent_redeem);
            //     $('#cemeats_paras').val(car_rent_redeem);
            // }




            // // if (motor_vara == '') {
            // //     $('#motor_vara').val()=null;
            // // } else if (unload == '') {
            // //     $('#unload').val()=null;
            // // } else {
            // //     $('#motor_vara').val()=null;
            // // $('#unload').val()=null;
            // //     var tar = motor_vara?$('#motor_vara').val():'0';
            // //     var tar2 = motor_vara?$('#unload').val():'0';
            // //     var car_rent_redeem = parseInt(tar) + parseInt(tar2);
            // //     // alert(balance);
            // //     $('#car_rent_redeem').val(car_rent_redeem);
            // //     $('#cemeats_paras').val(car_rent_redeem);
            // // }


        });
        // $(document).on('input change paste keyup', '.value-calc_edit', function() {
        //     var kg = $('#kg_edit').val();
        //     var paras = $('#paras_edit').val();
        //     if (kg == '') {
        //         $('#credit_edit').val('0');
        //     } else if (paras == '') {
        //         $('#credit_edit').val('0');
        //     } else {
        //         var credit = kg * paras;
        //         // alert(credit);
        //         $('#credit_edit').val(credit);
        //     }

        //     var debit = $("#debit_edit").val();
        //     var credit = $("#credit_edit").val();
        //     if (debit == '') {
        //         $('#balance_edit').val('0');
        //     } else if (credit == '') {
        //         $('#balance_edit').val('0');
        //     } else {
        //         var balance = credit - debit;
        //         // alert(balance);
        //         $('#balance_edit').val(balance);
        //     }

        //     var motor_cash = $('#motor_cash_edit').val();
        //     var unload = $('#unload_edit').val();
        //     if (motor_cash == '') {
        //         $('#car_rent_redeem_edit').val('0');
        //     } else if (unload == '') {
        //         $('#car_rent_redeem_edit').val('0');
        //     } else {
        //         var car_rent_redeem = parseInt(motor_cash) + parseInt(unload);
        //         // alert(balance);
        //         $('#car_rent_redeem_edit').val(car_rent_redeem);
        //     }


        //     var car_rent_redeem = $('#car_rent_redeem_edit').val();
        //     var credit = $("#credit_edit").val();
        //     if (car_rent_redeem == '') {
        //         var total_paras = credit;
        //         $('#total_paras_edit').val(total_paras);
        //     } else {
        //         var total_paras = parseInt(car_rent_redeem) + parseInt(credit);
        //         $('#total_paras_edit').val(total_paras);
        //     }
        // });
        // //End calculation
        //Start calculation popup
        $(document).on('input change paste keyup', '.value-calc-popup', function() {

            ////////////////////////////////////////////////////////////////
            var kg = $('#tons_popup').val();
            var paras = $('#paras_popup').val();
            if (kg == '') {
                $('#credit_popup').val('0');
            } else if (paras == '') {
                $('#credit_popup').val('0');
            } else {
                var credit = kg * paras;
                // alert(credit);
                $('#credit_popup').val(credit);
            }

            var fee = $("#fee_popup").val();
            var credit = $("#credit_popup").val();
            var fee = parseFloat(fee);
            if (fee == '') {
                $('#fee').val('0');
            } else {
                var credit_with_fee = parseFloat(credit) + fee;
                // alert(balance);
                $('#credit_popup').val(credit_with_fee);
            }

            var debit = $("#debit_popup").val();
            var credit = $("#credit_popup").val();
            if (debit == '') {
                $('#balance_popup').val('0');
            } else if (credit == '') {
                $('#balance_popup').val('0');
            } else {
                var balance = credit - debit;
                // alert(balance);
                $('#balance_popup').val(balance);
            }

            var motor_vara = $('#motor_vara_popup').val();
            var unload = $('#unload_popup').val();
            if (motor_vara == '') {
                $('#car_rent_redeem_popup').val('0');
            } else if (unload == '') {
                $('#car_rent_redeem_popup').val('0');
            } else {
                var car_rent_redeem = parseInt(motor_vara) + parseInt(unload);
                // alert(balance);
                $('#car_rent_redeem_popup').val(car_rent_redeem);
            }


            var car_rent_redeem = $('#car_rent_redeem_popup').val();
            var credit = $("#credit_popup").val();
            if (car_rent_redeem == '') {
                var total_paras = credit;
                $('#credit_popup').val(total_paras);
            } else {
                var total_paras = parseInt(car_rent_redeem) + parseFloat(credit);
                $('#credit_popup').val(total_paras);
            }


            var discountp = $("#discount_popup").val();
            var credit_with_dis = $("#credit_popup").val();
            var discountp2 = parseFloat(discountp);
            if (discountp == '') {
                $('#discountp').val('0');
            } else {
                var credit_with_dis = credit_with_dis - ((discountp2 / 100) * credit_with_dis);
                // alert(balance);
                $('#credit_popup').val(credit_with_dis);
            }







            ///////////////////////////////////////////////////////////////////////////////////////
            //     // var kg = $('#kg_popup').val();
            //     // var paras = $('#paras_popup').val();
            //     // if (kg == '') {
            //     //     $('#credit_popup').val('0');
            //     // } else if (paras == '') {
            //     //     $('#credit_popup').val('0');
            //     // } else {
            //     //     var credit = kg * paras;
            //     //     // echo(kg);
            //     //     // echo(paras);
            //     //     // alert(credit);
            //     //     $('#credit_popup').val(credit);
            //     // }


            //     var discountp = $("#discount_popup").val();
            //     var creditp = $("#credit_popup").val();
            //     var discountp2 = parseFloat(discountp);
            //     if (discountp != '') {
            //          creditp = creditp - ((discountp2 / 100) * creditp);
            //         // alert(typeof(discountp2));
            //         $('#credit_popup').val(creditp.toFixed(2));

            //     }

            //     // var fee = parseFloat($("#fee_popup").val()) ;
            //     // if (fee != '') {
            //     //  creditp = parseInt(creditp) + parseInt(fee);
            //     //     $('#credit_popup').val(creditp);
            //     // }
            //     var debit = parseFloat($("#debit_popup").val()) ;
            //     var creditp = $("#credit_popup").val();
            //     if (debit == '') {
            //         $('#balance_popup').val('0');
            //     } else if (creditp == '') {
            //         $('#balance_popup').val('0');
            //     } else {
            //         var balance = creditp - debit;
            //         // alert(balance);
            //         $('#balance_popup').val(balance);
            //     }

            //     var motor_cash = $('#motor_vara_popup').val();
            //     var unload = $('#unload_popup').val();
            //     if (motor_cash == '') {
            //         $('#car_rent_redeem_popup').val('0');
            //     } else if (unload == '') {
            //         $('#car_rent_redeem_popup').val('0');
            //     } else {
            //         var car_rent_redeem = parseInt(motor_cash) + parseInt(unload);
            //         // alert(balance);
            //         $('#car_rent_redeem_popup').val(car_rent_redeem);
            //         $('#cemeats_paras_popup').val(car_rent_redeem);
            //     }


            // //     var car_rent_redeem = $('#car_rent_redeem_popup').val();
            // //     var credit = $("#credit_popup").val();
            // //     if (car_rent_redeem == '') {
            // //         var total_paras = credit;
            // //         $('#total_paras_popup').val(total_paras);
            // //     } else {
            // //         var total_paras = parseInt(car_rent_redeem) + parseInt(credit);
            // //         $('#total_paras_popup').val(total_paras);
            // //     }
        });
        //End calculation popup
    </script>


    <script type="text/javascript">
        function getDataByDates(datestr, dealerId) {
            $.ajax({
                url: '../ajaxcall/cement_search_date_entry.php',
                type: 'post',
                data: {
                    optionDate: datestr,
                    dealerId: dealerId,
                },
                success: function(res) {
                    // alert(res);
                    $('#viewDetails').html(res);
                    $('.left_side_bar').height($('.main_bar').innerHeight());
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }


        function getSummaryByDates(datestr, dealerId) {
            $.ajax({
                url: '../ajaxcall/cement_search_date_wise_summary_entry.php',
                type: 'post',
                data: {
                    optionDate: datestr,
                    dealerId: dealerId,
                },
                success: function(res) {
                    // alert(res);
                    $('#panel').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }


        $(document).on('change', '#dateSearchList', function() {
            var optionDate = $('#dateSearchList option:selected').val();
            var dealerId = $('#delear_id option:selected').val();
            // alert(dealerId);          
            getDataByDates(optionDate, dealerId);
            getSummaryByDates(optionDate, dealerId);
        });
    </script>
    <script>
        function datecheckformat(e) {
            //On Enter key Press

            var currentID = e.target.id;
            var dateStr = $('#' + currentID).val();
            // alert(e.target.id);            
            // alert(dateStr);
            if (e.which == 13) {
                // alert('You pressed enter!');            
                if (dateStr.length == 8) {
                    var day = dateStr.trim().substr(0, 2);
                    var month = dateStr.trim().substr(2, 2);
                    var year = dateStr.trim().substr(4, 4);
                    var formatedDate = day + '-' + month + '-' + year;
                    // alert(formatedDate);
                    $('#' + currentID).val(formatedDate);
                    $('#' + currentID).datepicker("setDate", new Date(year, month - 1, day));
                    console.log(formatedDate);
                } else {
                    alert('Date input dayMonthYear within 8 char.');
                }
            }

        }

        function datecheckformatpopup(e) {
            //On Enter key Press

            var currentID = e.target.id;
            var dateStr = $('#' + currentID).val();
            // alert(e.target.id);            
            // alert(dateStr);
            if (e.which == 13) {
                // alert('You pressed enter!');            
                if (dateStr.length == 8) {
                    var day = dateStr.trim().substr(0, 2);
                    var month = dateStr.trim().substr(2, 2);
                    var year = dateStr.trim().substr(4, 4);
                    var formatedDate = day + '-' + month + '-' + year;
                    // alert(formatedDate);
                    $('#' + currentID).val(formatedDate);
                    $('#' + currentID).datepicker("setDate", new Date(year, month - 1, day));
                    console.log(formatedDate);
                } else {
                    alert('Date input dayMonthYear within 8 char.');
                }
            }

        }
    </script>
    <script type="text/javascript">
        $(document).on('click', '#entry_scroll1', function() {
            $('#scrolling-entry-div').animate({
                scrollLeft: '1090'
            }, 1000, "swing");
            $(this).hide();
            $('#entry_scroll2').show();
            $('#entry_scroll3').hide();
        });
        $(document).on('click', '#entry_scroll2', function() {
            $('#scrolling-entry-div').animate({
                scrollLeft: '+=1110'
            }, 1000, "swing");
            $(this).hide();
            $('#entry_scroll1').hide();
            $('#entry_scroll3').show();
        });
        $(document).on('click', '#entry_scroll3', function() {
            $('#scrolling-entry-div').animate({
                scrollLeft: '0'
            }, 1000, "swing");
            $(this).hide();
            $('#entry_scroll1').show();
            $('#entry_scroll2').hide();
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '#gb_bank_ganti_td', function() {
            $('#gb_bank_ganti').show().focus();
        });

        $(document).on('mousedown', function(e) {
            console.log(e);
            console.log($(e.target).attr('id'));
            if ($(e.target).attr('id') == 'gb_bank_ganti') {

            } else {
                console.log('hide');
                $('#gb_bank_ganti').hide();
            }
        });


        function gbbank_update(id, gbvalue) {
            $.ajax({
                url: '../ajaxcall_save_update/cement_gb_bank_update.php',
                type: 'post',
                data: {
                    details_id: id,
                    gbvalue: gbvalue,
                },
                success: function(res) {
                    $('#gbbank_stable_val').html(res);
                    alert('GB Bank Ganti Updated Successfully.');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        $(document).on('keypress', '#gb_bank_ganti', function(e) {
            if (e.which == 13) {
                var id = $(e.currentTarget).attr('data-id');
                var gbvalue = $('#gb_bank_ganti').val();
                // alert(id);
                gbbank_update(id, gbvalue);
                $('#gb_bank_ganti').hide();
            }
        });
    </script>
    <script type="text/javascript">
        $(document).on('change', '#particulars', function() {
            var value = $('#particulars option:selected').val().match(/\d+/);
            // alert(value);
            if (value == '04') {
                $('#mm').val('04.5 mm');
            } else if (value == '06') {
                $('#mm').val('06 mm');
            } else if (value == '08') {
                $('#mm').val('08 mm');
            } else if (value == '10') {
                $('#mm').val('10 mm');
            } else if (value == '12') {
                $('#mm').val('12 mm');
            } else if (value == '16') {
                $('#mm').val('16 mm');
            } else if (value == '20') {
                $('#mm').val('20 mm');
            } else if (value == '22') {
                $('#mm').val('22 mm');
            } else if (value == '25') {
                $('#mm').val('25 mm');
            } else if (value == '32') {
                $('#mm').val('32 mm');
            } else if (value == '42') {
                $('#mm').val('42 mm');
            } else {
                $('#mm').val('');
            }
        });
        $(document).on('change', '#particulars_edit', function() {
            var value = $('#particulars_edit option:selected').val().match(/\d+/);
            // alert(value);
            if (value == '04') {
                $('#mm_edit').val('04.5 mm');
            } else if (value == '06') {
                $('#mm_edit').val('06 mm');
            } else if (value == '08') {
                $('#mm_edit').val('08 mm');
            } else if (value == '10') {
                $('#mm_edit').val('10 mm');
            } else if (value == '12') {
                $('#mm_edit').val('12 mm');
            } else if (value == '16') {
                $('#mm_edit').val('16 mm');
            } else if (value == '20') {
                $('#mm_edit').val('20 mm');
            } else if (value == '22') {
                $('#mm_edit').val('22 mm');
            } else if (value == '25') {
                $('#mm_edit').val('25 mm');
            } else if (value == '32') {
                $('#mm_edit').val('32 mm');
            } else if (value == '42') {
                $('#mm_edit').val('42 mm');
            } else {
                $('#mm_edit').val('');
            }
        });
        $(document).on('change', '#particulars_popup', function() {
            var value = $('#particulars_popup option:selected').val().match(/\d+/); // alert(value);
            if (value == '04') {
                $('#mm_popup').val('04.5 mm');
            } else if (value == '06') {
                $('#mm_popup').val('06 mm');
            } else if (value == '08') {
                $('#mm_popup').val('08 mm');
            } else if (value == '10') {
                $('#mm_popup').val('10 mm');
            } else if (value == '12') {
                $('#mm_popup').val('12 mm');
            } else if (value == '16') {
                $('#mm_popup').val('16 mm');
            } else if (value == '20') {
                $('#mm_popup').val('20 mm');
            } else if (value == '22') {
                $('#mm_popup').val('22 mm');
            } else if (value == '25') {
                $('#mm_popup').val('25 mm');
            } else if (value == '32') {
                $('#mm_popup').val('32 mm');
            } else if (value == '42') {
                $('#mm_popup').val('42 mm');
            } else {
                $('#mm_popup').val('');
            }
        });
    </script>
    <script>
        function myFunction() {

            var header = document.getElementById('city_center_id');
            // var summary = document.getElementById('panel');
            var details = document.getElementById('detailsNewTable2');
            var wme = window.open("", "", "width=900,height=700, scrollbars=yes");



            wme.document.write('<style>td, th{border: 1px solid #868686; padding: 4px; }#detailsNewTable2{border-collapse: collapse;}.text-center{text-align: center; margin: 6px 0px;}.summary{border-collapse: collapse; margin-bottom: 20px;}.no_print_media{display: none !important;}.hastext{text-align: right;}</style>');

            wme.document.write(header.outerHTML);
            // wme.document.write(summary.outerHTML);
            wme.document.write(details.outerHTML);


            // var x = '<script type="text/javascript" ' + 'src="https://code.jquery.com/jquery-1.10.2.js">' +'<'+ '/script>';
            // wme.document.write(x);

            wme.document.close();
            wme.focus();
            wme.print();
            // wme.close();

        }
    </script>
    <script type="text/javascript">
        $('#delivery_date_popup').bind('keydown', function(e) {
            if (e.which == 13)
                e.stopImmediatePropagation();
        }).datepicker({
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd-mm-yy",
            changeYear: true,
        });


        $('#dates_popup').bind('keydown', function(e) {
            if (e.which == 13)
                e.stopImmediatePropagation();
        }).datepicker({
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd-mm-yy",
            changeYear: true,
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '.edPermit', function(event) {
            event.preventDefault();
            ConfirmDialog('You have no permission edit/delete this data !');

            function ConfirmDialog(message) {
                $('<div></div>').appendTo('body')
                    .html('<div><h4>' + message + '</h4></div>')
                    .dialog({
                        modal: true,
                        title: 'Alert',
                        zIndex: 10000,
                        autoOpen: true,
                        width: '40%',
                        resizable: false,
                        position: {
                            my: "center",
                            at: "center center-20%",
                            of: window
                        },
                        buttons: {
                            Ok: function() {
                                $(this).dialog("close");
                            },
                            Cancel: function() {
                                $(this).dialog("close");
                            }
                        },
                        close: function(event, ui) {
                            $(this).remove();
                        }
                    });
            };
        });


        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                Swal.fire("Should be enter a number value");
                // alert("Should be enter a number value");
                console.log("Workkkkk", evt);
                return false;
            }
            return true;
        }
    </script>
    <script type="text/javascript">
        $(document).on("click", ".kajol_close, .cancel", function() {
            $("#verifyPasswordModal").hide();
        });
    </script>
    <script src="../js/common_js.js"> </script>
</body>

</html>

///////////////////////////////////////////////////////
balu_deatils_entry_with_edit_part



<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$project_name_id = $_SESSION['project_name_id'];
$_SESSION['pageName'] = 'balu_kroy_hisab';
// $sucMsgPopup = '';
?>




<!DOCTYPE html>
<html>

<head>
    <title>বালু ক্রয় হিসাব </title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
    <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
    <!-- alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>
    <!-- download -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>

    <style type="text/css">
        .rodDetailsEnCon {
            position: relative;
        }

        .scroll-after-btn {
            margin: 10px 0px 25px;
            width: 100px;
            position: absolute;
            right: 0px;
        }

        #detailsEtryTable {
            width: 293%;
            border: 1px solid #3e9309d4;

        }

        #detailsEtryTable tr:first-child td {
            text-align: center;
            background-color: #3e9309ba;
            Color: white;
        }

        #detailsEtryTable tr:nth-child(2) td {
            text-align: center;
            background-color: #3e9309ba;
            Color: white;
        }

        #detailsEtryTable tr:nth-child(3) td {
            border: 1px solid #3e9309d4;
            /* text-align: center; */

            /* Color: black; */
            /* box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px; */
        }

        #detailsEtryTable tr:nth-child(3) input {
            border: none;
            /* height: 39px; */
            /* border-radius: 10% 10% 0% 0%; */
            /* transition: border-bottom 1s linear ; */
        }

        #detailsEtryTable tr:nth-child(3) input[type=text]:focus {
            /* outline: 1px solid skyblue; */
            outline: none;
            border-bottom: 2px solid #508d2aba;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            height: 30px;
            /* font-size: 1px; */

        }

        #detailsEtryTable tr:nth-child(3) input[type=text]:focus::placeholder {
            color: transparent;

            /* font-size: large; */

        }

        #detailsEtryTable td {
            /* color inserted here */
            border: 2px solid #E0E4E0;
        }

        .scrolling-div {
            width: 100%;
            overflow-y: auto;
        }

        #form_entry {
            overflow-y: scroll;
        }

        /*.scrolling-div::-webkit-scrollbar {
          width: 10px;
          
        }
        .scrolling-div::-webkit-scrollbar-track {
          background: #ff9696;
          box-shadow: inset 0 0 5px grey; 
          border-radius: 10px;
        }
        .scrolling-div::-webkit-scrollbar-thumb {
          background: red;
          border-radius: 10px;
        }
        .scrolling-div::-webkit-scrollbar-thumb:hover {
          background: #900;
        }*/
        .scrollsign_plus {
            width: 25px;
            height: 25px;
            /*border: 1px solid red;*/
            font-size: 35px;
            line-height: 19px;
            padding: 3px;
            background-color: #75D265;
            color: #fff;
            border-radius: 50%;
            cursor: pointer;
            position: absolute;
            right: -35px;
            top: 15px;
            user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .widthPercent1 {
            width: 3.5%;
        }

        .widthPercent2 {
            width: 3.7%;
        }

        .widthPercent3 {
            width: 3.7%;
        }

        .header {
            /* Background color */
            /* background-color: #ddd; */

            /* Stick to the top */
            position: sticky;
            top: 0;

            /* Displayed on top of other rows when scrolling */
            z-index: 1;
        }


        #detailsNewTable2 {
            width: 217%;
            /* border: 1px solid #ddd; */
            /*transform: rotateX(180deg);*/
        }

        #detailsNewTable2 th,
        td {
            border: 1px solid #ddd;
            padding: 5px 5px;
            text-align: center;


        }


        #detailsNewTable2 tr:first-child th {
            text-align: center;
            background-color: #363636db;
            padding: 5px 23px;

            color: #fff;

        }

        #detailsNewTable2 tr:nth-child(2) th {
            text-align: center;
            background-color: #363636db;
            padding: 5px 23px;

            color: #fff;
        }

        #detailsNewTable2 tr:nth-child(even) td {
            text-align: center;
            background-color: #d2df0d2e;
            color: black;
            padding: 5px 5px;
        }

        #detailsNewTable2 tr:nth-child(odd) td {
            text-align: center;
            background-color: white;
            color: black;
            /* padding: 5px 0px; */
        }

        .viewDetailsCon {
            width: 100%;
            max-height: 470px;
            overflow-x: auto;
            /*overflow-y: auto;*/
            /*margin-bottom: 50px;*/

        }

        .ui-dialog-titlebar {
            color: white;
            background-color: #ce0000;
        }


        .dateSearch {
            position: relative;
            width: 225px;
            /*left: 325px;
            top: -6px;*/
        }

        .bootstrap-select {
            width: 130px !important;
        }

        .dealerIdSelect {
            width: 100%;
            text-align: center;
            height: 50px;
            /*border: 1px solid red;*/
        }

        .dealerIdSelect table {
            /*width: 50%;*/
            /*margin-left: 25%;*/
        }

        .dealerIdSelect table tr td {
            text-align: right;
            border: none;
        }

        #flip {
            /*border: 1px solid red;*/
            position: relative;
            top: -42px;
        }

        #flip label {
            display: inline-block;

        }

        #panel {
            border: 2px solid #333;
            margin: 0px 0px 20px;
        }

        table.summary tr td.hastext {
            text-align: right;
        }

        table.summary tr td.hastext {
            text-align: right;
        }

        /* The container */
        .conchk {
            display: inline-block;
            position: absolute;
            padding-right: 32px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 15px;
            right: 0px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .conchk input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            right: 0;
            height: 22px;
            width: 22px;
            background-color: #9bd1ff;
            border: 1px solid #2196F3;
        }

        /* On mouse-over, add a grey background color */
        .conchk:hover input~.checkmark {
            background-color: #2196F3;
        }

        /* When the checkbox is checked, add a blue background */
        .conchk input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .conchk input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .conchk .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .backcircle {
            font-size: 18px;
            position: absolute;
            margin-top: -25px;
        }

        .backcircle a:hover {
            text-decoration: none !important;
        }

        #gb_bank_ganti {
            position: absolute;
            left: 0px;
            top: -1px;
            background-color: #8de6a7;
            width: 150px;
            padding: 0px 3px;
            display: none;
        }

        .contorlAfterDealer {
            position: absolute;
            width: 408px;
            height: 45px;
            right: 15px;
            top: -6px;
        }

        .printBtnDlr {
            position: absolute;
            top: 0px;
            right: 1px;
            border: 2px solid #46b8da;
        }

        /* .printBtnDlrDown {
            position: absolute;
            top: 0px;
            right: 15px;
            border: 1px solid #46b8da;
        } */

        @media print {

            .no_print_media,
            .no_print_media * {
                display: none !important;
            }
        }

        .btn-info {
            background-color: #F0F0F0 !important;
            color: #000 !important;
        }

        .btn-info:hover {
            background-color: #F0F0F0 !important;
            color: #000 !important;
        }

        #popUpNewBtn {
            width: 30px;
            height: 30px;
            padding: 3px;
            background-color: #9c9c9c;
            background-color: #000;
            position: absolute;
            /*top: 30px;*/
            cursor: pointer;
            /*z-index: 9;*/
        }

        #popupEntry {
            display: none;
            width: 100%;
            background-color: rgba(0, 0, 0, .7);
            height: 100%;
            position: fixed;
            top: 0px;
            z-index: 99999;
        }

        #control_all {
            width: 50%;
            background-color: #fff;
            border: 5px solid #333;
            border-radius: 5px;
            height: 90%;
            position: relative;
            top: 5%;
            left: 50%;
            margin-left: -25%;
            padding: 15px;
        }

        .popupClose {
            position: absolute;
            top: 0px;
            right: 0px;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            padding: 5px;
            border: 1px solid red;
            transition: all .5s;
            cursor: pointer;
        }

        .bar_one {
            width: 20px;
            height: 3px;
            background-color: red;
            transform: rotate(45deg);
            position: relative;
            top: 7px;
            left: -1px;
            transition: all .5s;
        }

        .bar_two {
            width: 20px;
            height: 3px;
            background-color: red;
            transform: rotate(-45deg);
            position: relative;
            top: 4px;
            left: -1px;
            transition: all .5s;
        }

        .popupClose:hover {
            background-color: red;
            transition: all .5s;
        }

        .popupClose:hover .bar_one {
            background-color: #fff;
            transition: all .5s;
        }

        .popupClose:hover .bar_two {
            background-color: #fff;
            transition: all .5s;
        }

        .popupHead {
            text-align: center;
            margin: 15px 0px 15px;
        }

        .popupHead::after {
            content: '';
            height: 3px;
            /*width: 180px;*/
            width: calc(100% - 30px);
            position: absolute;
            left: 15px;
            top: 70px;
            /*margin-left: -98px;*/
            background-color: #ddd;
        }

        .items_all_con {
            /*border: 1px solid red;*/
            height: calc(100% - 63px);
            overflow-y: scroll;
            padding: 15px;

        }

        .pop_btn_con {
            position: relative;
            margin: 25px 0px 10px;
            height: 36px;
        }

        .popup_save_btn {
            width: 40%;
            position: absolute;
            left: 20px;
        }

        .popup_cancel_btn {
            width: 40%;
            position: absolute;
            right: 20px;
        }

        .protidinHisab {
            margin-top: 13px;
        }
    </style>
</head>

<body>
    <?php
    include '../navbar/header_text.php';
    // $page = 'rod_hisab';
    include '../navbar/navbar.php';
    ?>
    <div class="container">
        <?php
        // $ph_id = $_SESSION['project_name_id'];
        // $query = "SELECT * FROM project_heading WHERE id = $ph_id";
        // $show = $db->select($query);
        // if ($show) 
        // {
        // 	while ($rows = $show->fetch_assoc()) 
        // 	{
        ?>
        <!-- <div class="project_heading text-center" id="city_center_id">      
    				  <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
    				  h4 class="text-center"><?php echo $rows['subheading']; ?></h4>
    				</div> -->
        <?php
        // 	}
        // } 
        ?>
        <!-- <p class="text-center">রড ক্রয় হিসাব</p> -->

        <!-- <div class="backcircle">
              <a href="../vaucher/rod_index.php">
                <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
              </a>
            </div> -->

    </div>

    <div class="bar_con">
        <div class="left_side_bar">
            <?php require '../others_page/left_menu_bar_balu_hisab.php'; ?>
        </div>
        <div class="main_bar" style="padding-bottom: 30px;">
            <?php
            $ph_id = $_SESSION['project_name_id'];
            $query = "SELECT * FROM project_heading WHERE id = $ph_id";
            $show = $db->select($query);
            if ($show) {
                while ($rows = $show->fetch_assoc()) {
            ?>
                    <div class="project_heading">
                        <h2 class="headingOfAllProject" id="city_center_id">
                            <?php echo $rows['heading']; ?> <span class="protidinHisab"> ক্রয় হিসাব</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; 
                                                                ?></span> -->

                        </h2>
                    </div>
            <?php
                }
            }
            ?>
            <div class="dealerIdSelect">
                <table>
                    <tr>
                        <td><b>Select a Dealer Name</b></td>
                        <td><?php
                            // $sql = "SELECT dealer_name, dealer_id,project_name_id  FROM balu_dealer ";
                            $sql = "SELECT dealer_name, dealer_id,project_name_id  FROM balu_dealer WHERE project_name_id = '$project_name_id'";
                            $all_custmr_id = $db->select($sql);
                            echo '<select name="delear_id" id="delear_id" class="form-control" style="width: 222px;">';

                            if ($all_custmr_id->num_rows > 0) {
                                while ($row = $all_custmr_id->fetch_assoc()) {
                                    $id = $row['dealer_id'];
                                    $dealer_name = $row['dealer_name'];
                                    echo '<option value="' . $id . '">' . $dealer_name . '</option>';
                                }
                            } else {
                                echo '<option value="none">0 Result</option>';
                            }
                            echo '</select>';
                            ?></td>
                    </tr>
                </table>
            </div>
            <div id="allconid" style="display: none;">
            </div>

        </div>

        <div id="popupEntry">
            <div id="control_all">
                <div class="popupClose">
                    <div class="bar_one"></div>
                    <div class="bar_two"></div>
                </div>
                <h2 class="popupHead" style="color: Green;">ক্রয় হিসাব এন্ট্রি</h2>
                <div class="items_all_con" style="background-color: gray; color: white; border: 2px solid black;">
                    <form id="insertPopupForm">
                        <table style="width: 100%;">
                            <tr>
                                <td>Dealer ID(আই ডি)</td>
                                <td>
                                    <?php
                                    $sql = "SELECT dealer_id FROM balu_dealer WHERE project_name_id ='$project_name_id'";
                                    $all_custmr_id = $db->select($sql);
                                    echo '<select name="dealer_id" id="dealer_id" class="form-control" required">';
                                    echo '<option value="none">Select...</option>';
                                    if ($all_custmr_id->num_rows > 0) {
                                        while ($row = $all_custmr_id->fetch_assoc()) {
                                            $id = $row['dealer_id'];
                                            echo '<option value="' . $id . '">' . $id . '</option>';
                                        }
                                    } else {
                                        echo '<option value="none">0 Result</option>';
                                    }
                                    echo '</select>';
                                    ?>
                                </td>
                            </tr>



                            <!-- <input type="hidden" name="balu_details_id" id="balu_details_id"> -->
                            <tr>
                                <td>Motor Name (গাড়ী নাম)</td>
                                <td>
                                    <input type="text" name="motor_name" class="form-control" id="motor_name_popup" placeholder="Enter Motor Name...">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>id</td>
                                <td>
                                    <input type="text" name ="motor_name" class="form-control" id="motor_name_popup" placeholder="Enter Motor Name...">
                                </td>           
                            </tr> -->
                            <tr>
                            <tr>
                                <td>Driver Name (ড্রাইভারের নাম)</td>
                                <td>
                                    <input type="text" name="driver_name" class="form-control" id="driver_name_popup" placeholder="Enter Driver Name...">
                                </td>
                            </tr>
                            <tr>
                                <td>Motor Vara (গাড়ী ভাড়া)</td>
                                <td>
                                    <input type="text" onkeypress="return isNumber(event)" name="motor_vara" class="form-control value-calc-popup" id="motor_vara_popup" placeholder="Enter Motor Vara...">
                                </td>
                            </tr>
                            <tr>
                                <td>Unload (আনলোড)</td>
                                <td>
                                    <input type="text" onkeypress="return isNumber(event)" name="unload" class="form-control value-calc-popup" id="unload_popup" placeholder="Unload">
                                </td>
                            </tr>
                            <tr>
                                <td>Cars rent & Redeem (গাড়ী ভাড়া ও খালাস)</td>
                                <td>
                                    <input type="text" name="car_rent_redeem" class="form-control value-calc-popup" id="car_rent_redeem_popup" placeholder="Enter cars rent & redeem...">
                                </td>
                            </tr>
                            <tr>
                                <td>Information (মালের বিবরণ)</td>
                                <td>
                                    <input type="text" name="information" class="form-control" id="information_popup" placeholder="Enter information...">
                                </td>
                            </tr>
                            <tr>
                                <td>SL (ক্রমিক)</td>
                                <td>
                                    <input type="text" name="sl" class="form-control" id="sl_popup" placeholder="Enter SL...">
                                </td>
                            </tr>
                            <tr>
                                <td>Voucher No. (ভাউচার নং)</td>
                                <td>
                                    <input type="text" name="voucher_no" class="form-control" id="voucher_no_popup" placeholder="Enter Voucher No...">
                                </td>
                            </tr>
                            <tr>
                                <td>Address (ঠিকানা)</td>
                                <td>
                                    <input type="text" name="address" class="form-control" id="address_popup" placeholder="Enter Address...">
                                </td>
                            </tr>
                            <tr>
                                <td>Motor Number (গাড়ী নাম্বার)</td>
                                <td>
                                    <input type="text" name="motor_number" class="form-control" id="motor_number_popup" placeholder="Enter motor number...">
                                </td>
                            </tr>

                            <tr>
                                <td>Motor Sl (গাড়ী নং)</td>
                                <td>
                                    <input type="text" name="motor_sl" class="form-control" id="motor_sl_popup" placeholder="Enter Motor Sl...">
                                </td>
                            </tr>
                            <tr>
                                <td>Delivery Date (ডেলিভারি তারিখ)</td>
                                <td>
                                    <input onkeypress="datecheckformatpopup(event)" type="text" name="delivery_date" class="form-control" id="delivery_date_popup" placeholder="dd-mm-yyyy">
                                </td>
                            </tr>
                            <tr>
                                <td>Date (তারিখ)</td>
                                <td>
                                    <input onkeypress="datecheckformatpopup(event)" type="text" name="dates" class="form-control" id="dates_popup" placeholder="dd-mm-yyyy">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>Partculars (মারফোত নাম)</td>
                                <td>
                                    <input type="text" name="partculars" class="form-control" id="partculars_popup" placeholder="Enter partculars...">
                                </td>
                            </tr>
                            <tr>
                                <td>Particulars (বিবরণ)</td>
                                <td>
                                    <?php
                                    $balu_catgry_sql = "SELECT * FROM balu_category";
                                    $rslt_balu_catgry = $db->select($balu_catgry_sql);

                                    echo '<select name="particulars" id="particulars_popup" class="form-control">';
                                    echo '<option value="">Select...</option>';
                                    if ($rslt_balu_catgry->num_rows > 0) {
                                        while ($row = $rslt_balu_catgry->fetch_assoc()) {
                                            $balu_category_id = $row['id'];
                                            $balu_category_name = $row['category_name'];

                                            echo '<option style="font-weight: bold;">' . $balu_category_name . '</option>';

                                            $balu_lbl_sql = "SELECT * FROM balu_and_other_label";
                                            $rslt_balu_lbl = $db->select($balu_lbl_sql);
                                            if ($rslt_balu_lbl->num_rows > 0) {

                                                while ($row2 = $rslt_balu_lbl->fetch_assoc()) {
                                                    $raol_id = $row2['id'];
                                                    $raol_balu_label = $row2['balu_label'];
                                                    $raol_balu_category_id = $row2['balu_category_id'];


                                                    if ($balu_category_id == $raol_balu_category_id) {
                                                        echo "<option value='" . $raol_balu_label . "'>" . $raol_balu_label . "</option>";
                                                    }
                                                }
                                            } else {
                                                echo '<option>0 results</option>';
                                            }
                                        }
                                    } else {
                                        echo '<option>0 results</option>';
                                    }
                                    echo '</select> ';
                                    ?>
                                </td>
                            </tr> -->
                            <tr>
                                <td>Debit (জমা টাকা)</td>
                                <td>
                                    <input type="text" name="debit" class="form-control value-calc-popup" id="debit_popup" placeholder="Enter debit...">
                                </td>
                            </tr>
                            <tr>
                                <td>Ton & Kg (টোন ও কেজি)</td>
                                <td >
                                    <input type="text" name="ton_kg" class="form-control" id="kg_popup" placeholder="Enter Ton & Kg..." style="cursor:not-allowed;">
                                </td>
                            </tr>
                            <tr>
                                <td>Length (দৈর্ঘ্যের)</td>
                                <td>
                                    <input type="text" name="length" class="form-control" id="length_popup" placeholder="Enter Length..." >
                                </td>
                            </tr>
                            <tr>
                                <td>Width (প্রস্ত)</td>
                                <td>
                                    <input type="text" name="width" class="form-control" id="width_popup" placeholder="Enter Width..." >
                                </td>
                            </tr>
                            <tr>
                                <td>Height (উচাঁ)</td>
                                <td>
                                    <input type="text" name="height" class="form-control" id="height_popup" placeholder="Enter height..." >
                                </td>
                            </tr>
                            <tr>
                                <td>Shifty (সেপ্টি)</td>
                                <td>
                                    <input type="text" name="shifty" class="form-control" id="shifty_popup" placeholder="Enter Shifty..." >
                                </td>
                            </tr>
                            <tr>
                                <td>Inchi (-) Minus (Inchi (-) বিয়োগ )</td>
                                <td>
                                    <input type="text" name="inchi_minus" class="form-control" id="inchi_minus_popup" placeholder="Enter Inchi (-) Minus...">
                                </td>
                            </tr>
                            <tr>
                                <td>Cft ( - ) Dropped Out (সিএফটি ( - ) বাদ)</td>
                                <td>
                                    <input type="text" name="cft_dropped_out" class="form-control" id="cft_dropped_popup" placeholder="Enter Cft ( - ) Dropped Out ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Inchi (+) Added (Inchi (+) যোগ) </td>
                                <td>
                                    <input type="text" name="inchi_added" class="form-control" id="inchi_added_popup" placeholder="Enter Inchi (+) Added ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Points ( - ) Dropped Out (পয়েন্ট ( - ) বাদ) </td>
                                <td>
                                    <input type="text" name="points_dropped_out" class="form-control" id="points_dropped_popup" placeholder="Enter Points ( - ) Dropped Out ...">
                                </td>
                            </tr>
                            <tr>
                                <td> Shift(সেপ্টি) </td>
                                <td>
                                    <input type="text" name="shift" class="form-control" id="shift_popup" placeholder="Enter Shift ...">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>Total Shift(মোট সেপ্টি) </td>
                                <td>
                                    <input type="text" name="total_shift" class="form-control" id="total_shift_popup" placeholder="Enter Total Shift ...">
                                </td>
                            </tr> -->
                            <tr>
                                <td> Para's (দর) </td>
                                <td>
                                    <input type="text" name="paras" class="form-control value-calc-popup" id="paras_popup" placeholder="Enter Paras ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Discount(কমিশন) </td>
                                <td>
                                    <input type="text" name="discount" class="form-control value-calc-popup" id="discount_popup" placeholder="Enter Discount ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Credit(মূল) </td>
                                <td>
                                    <input type="text" name="credit" class="form-control value-calc-popup" id="credit_popup" placeholder="Enter Credit ...">
                                </td>
                            </tr>
                            <tr>
                                <td> Balance(অবশিষ্ট) </td>
                                <td>
                                    <input type="text" name="balance" class="form-control value-calc-popup" id="balance_popup" placeholder="Enter Balance  ...">
                                </td>
                            </tr>

                            <tr>
                                <td>Cemeat's Para's (গাড়ী ভাড়া / লেবার সহ)</td>
                                <td>
                                    <input type="text" name="cemeats_paras" class="form-control value-calc-popup" id="cemeats_paras_popup" placeholder="Enter Cemeat's Para's...">
                                </td>
                            </tr>
                            <!-- <td>Ton(টোন)</td>
                            <td>
                                <input type="text" name="ton" class="form-control" id="ton _popup" placeholder="Enter Ton..." >
                            </td>
                            </tr>
                            <tr>
                                <td>Total Shifts(সেপ্টি)</td>
                                <td>
                                    <input type="text" name="total_shifts" class="form-control" id="total_shifts_popup" placeholder="Enter Total Shifts...">
                                </td>
                            </tr>-->
                            <tr hidden>
                                <td>Tons (টোন)</td>
                                <td>
                                    <input type="text" name="tons" class="form-control" id="tons_popup" placeholder="Enter Tons...">
                                </td>
                            </tr>
                            <tr>
                                <td>Bank Name</td>
                                <td>
                                    <input type="text" name="bank_name" class="form-control" id="bank_name_popup" placeholder="Enter Bank Name...">
                                </td>
                            </tr>
                            <tr>
                                <td>Fee(ফি)</td>
                                <td>
                                    <input type="text" name="fee" class="form-control value-calc-popup" id="fee_popup" placeholder="Enter Fee...">
                                </td>
                            </tr>
                        </table>
                        <h4 class="text-success text-center" id="NewEntrySucMsgPopup"></h4>
                        <?php
                        // $sql = "SELECT id FROM details_balu";
                        // $id = $db->select($sql);
                        // if ($id->num_rows > 0) {
                        //     while ($row = $id->fetch_assoc()) {
                        //         $id2 = $row['id'];
                        //        echo '<input type="hidden" name="balu_details_id" id="balu_details_id" value="' . $id2 . '">' ;
                        //     }
                        // } 
                        ?>
                        <input type="hidden" name="balu_details_id" id="balu_details_id">
                        <div class="pop_btn_con">
                            <input onclick="valid('insert_popup')" type="button" name="submit" class="btn btn-primary popup_save_btn" value="Save" id="popup_save_update_btn">
                            <input type="button" class="btn btn-danger popup_cancel_btn" value="Cancel" id="popup_cancel_btn">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../others_page/delete_permission_modal.php';  ?>



    <script>
        $(document).on("click", "#flipChkbox", function() {
            if ($('#flipChkbox input[type="checkbox"]').prop("checked") == true) {
                // alert("Checkbox is checked.");
                $("#panel").slideDown("slow");
            } else if ($('#flipChkbox input[type="checkbox"]').prop("checked") == false) {
                // alert("Checkbox is unchecked.");
                $("#panel").slideUp("slow");
            }
        });
        // onkeypress="return isNumber(event)"
    </script>
    <script type="text/javascript">
        function dealerWiseSummaryDetailsSearchAndEntry(dlrId, restext = false) {
            $.ajax({
                url: '../ajaxcall/balu_dealer_wise_summary_details_search_and_entry.php',
                type: 'post',
                data: {
                    dealerId: dlrId,
                },
                success: function(res) {
                    // alert(res);
                    $('#allconid').html(res);

                    if (restext != false) {
                        $('#NewEntrySucMsg').html(restext).show();
                        $('#NewEntrySucMsgPopup').html(restext).show();
                    }

                    $('.selectpicker').selectpicker();


                    $('#delivery_date').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });


                    $('#dates').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });

                    $('#flipChkbox input[type="checkbox"]').prop("checked", true);
                    // $('#gb_bank_ganti').hide();

                    // $(document).on('keypress', '#gb_bank_ganti', function(e){
                    //     if (e.which == 13){
                    //       alert('Hiii');
                    //     }
                    // }
                    $('.left_side_bar').height($('.main_bar').height());

                    $("#popUpNewBtn").click(function() {
                        $("#NewEntrySucMsg").html('');
                        $('#NewEntrySucMsgPopup').html('');
                        // $('#popup_save_update_btn').val('Save').attr("onclick", "valid('insert_popup')");

                        $("#popupEntry").fadeIn(500);
                        $(".items_all_con").animate({
                            scrollTop: 0
                        }, "0");
                        // $(".items_all_con").scrollTop(0);
                        // console.log('red');
                    });

                    $(".popupClose").click(function() {
                        $("#popupEntry").fadeOut(500);
                        $('#buyer_id_popup').val("none").change();
                        $('#motor_name_popup').val('');
                        $('#driver_name_popup').val('');
                        $('#motor_vara_popup').val('');
                        $('#unload_popup').val('');
                        $('#car_rent_redeem_popup').val('');
                        $('#information_popup').val('');
                        $('#sl_popup').val('');
                        $('#voucher_no_popup').val('');
                        $('#address_popup').val('');
                        $('#motor_number_popup').val('');
                        $('#motor_sl_popup').val('');
                        $('#delivery_date_popup').val('');
                        $('#dates_popup').val('');
                        $('#partculars_popup').val('');
                        $('#particulars_popup').val("").change();
                        $('#debit_popup').val('');
                        $('#kg_popup').val('');
                        $('#length_popup').val('');
                        $('#width_popup').val('');
                        $('#height_popup').val('');
                        $('#shifty_popup').val('');
                        $('#inchi_minus_popup').val('');
                        $('#cft_dropped_popup').val('');
                        $('#inchi_added_popup').val('');
                        $('#points_dropped_popup').val('');
                        $('#shift_popup').val('');
                        $('#total_shift_popup').val('');
                        $('#paras_popup').val('');
                        $('#discount_popup').val('');
                        $('#credit_popup').val('');
                        $('#balance_popup').val('');
                        $('#cemeats_paras_popup').val('');
                        $('#ton_popup').val('');
                        $('#total_shifts_popup').val('');
                        $('#tons_popup').val('');
                        $('#bank_name_popup').val('');
                        $('#fee_popup').val('');
                        $("#NewEntrySucMsg").html('');
                        $("#NewEntrySucMsgPopup").html('');
                    });
                    $("#popup_cancel_btn").click(function() {
                        $(".popupClose").trigger('click');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function getDealerNameByDealerId(dlrIda) {
            $.ajax({
                url: '../ajaxcall/balu_get_dealer_name_by_dealer_id.php',
                type: 'post',
                data: {
                    dealerId: dlrIda,
                },
                success: function(res) {
                    // alert(res);
                    $('#city_center_id').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        $(document).on('change', '#delear_id', function() {
            var optionValue = $('#delear_id option:selected').val();
            // alert(optionValue);
            if (optionValue === '') {
                $('#allconid').css('display', 'none');
            } else {
                dealerWiseSummaryDetailsSearchAndEntry(optionValue);
                $('#allconid').css('display', 'block');
            }
            getDealerNameByDealerId(optionValue);
        });

        $("#delear_id").val("DLAR-100001").change();
    </script>
    <script type="text/javascript">
        $(document).on('click', '.detailsDelete', function(event) {
            var data_delete_id = $(event.target).attr('data_delete_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").removeAttr("data_delete_id");
            $("#verifyToDeleteBtn").attr("data_delete_id", data_delete_id);
        });
        $(document).on('click', '#verifyToDeleteBtn', function(event) {
            event.preventDefault();
            var data_delete_id = $(event.target).attr('data_delete_id');
            console.log('detailsDelete', data_delete_id);
            $("#passMsg").html("").css({
                'margin': '0px'
            });
            var pass = $("#matchPassword").val();
            $.ajax({
                url: "../ajaxcall/balu_match_password_for_vaucher_credit.php",
                type: "post",
                data: {
                    pass: pass
                },
                success: function(response) {
                    // alert(response);
                    if (response == 'password_matched') {
                        $("#verifyPasswordModal").hide();
                        ConfirmDialog('Are you sure delete details info?', data_delete_id);
                    } else {
                        $("#passMsg").html(response).css({
                            'color': 'red',
                            'margin-top': '10px'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

            function ConfirmDialog(message, data_delete_id) {
                $('<div></div>').appendTo('body')
                    .html('<div><h4>' + message + '</h4></div>')
                    .dialog({
                        modal: true,
                        title: 'Alert',
                        zIndex: 10000,
                        autoOpen: true,
                        width: '40%',
                        resizable: false,
                        position: {
                            my: "center",
                            at: "center center-20%",
                            of: window
                        },
                        buttons: {
                            Yes: function() {
                                var urltxt = '../ajaxcall/balu_del_entry_ajax.php';
                                $.ajax({
                                    url: urltxt,
                                    type: 'post',
                                    dataType: 'html',
                                    data: {
                                        'rod_details_id': data_delete_id
                                    },
                                    success: function(res) {
                                        console.log(res);
                                        // alert(res);
                                        var optionValue = $('#delear_id option:selected').val();
                                        dealerWiseSummaryDetailsSearchAndEntry(optionValue, res);
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus, errorThrown);
                                    }
                                });
                                $(this).dialog("close");
                                //   $.get("rod_details_entry.php?remove_id="+ data_delete_id, function(data, status){
                                // console.log(status);
                                //    if(status == 'success'){
                                //      window.location.href = 'rod_details_entry.php';
                                //    }
                                //   });
                            },
                            No: function() {
                                $(this).dialog("close");
                            }
                        },
                        close: function(event, ui) {
                            $(this).remove();
                        }
                    });
            };
        });
    </script>
    <script type="text/javascript">
        function valid(submit_type) {
            var returnValid = false;

            if (submit_type == 'insert') {
                var dealer_id = $('#dealer_id').val();
                var buyer_id = $('#buyer_id').val();
                var partculars = $('#partculars').val();
                var particulars = $('#particulars').val();

                if (buyer_id == 'none') {
                    alert('Please select a buyer Id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }

                if (dealer_id == 'none') {
                    alert('Please select a dealer id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }

                if (particulars == 'none') {
                    alert('Please select a particular');
                    returnValid = false;
                } else {
                    returnValid = true;
                }

                var formElement = $('#form_entry')[0];
                var formData = new FormData(formElement);
                var urltxt = '../ajaxcall/balu_details_entry_ajax.php';

            } else if (submit_type == 'insert_popup') {
                var buyer_id = $('#buyer_id_popup').val();

                if (buyer_id == 'none') {
                    alert('Please select a buyer Id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }
                var formElement = $('#insertPopupForm')[0];
                var formData = new FormData(formElement);
                var urltxt = '../ajaxcall/balu_details_entry_ajax.php';

            } else {
                ////Horizontal Edit er code
                // var buyer_id_edit = $('#buyer_id_edit').val();

                // if(buyer_id_edit == 'none'){
                //     alert('Please select a buyer Id');
                //     returnValid = false;
                // } else{
                //     returnValid = true;
                // }
                // var formElement = $('#form_edit')[0];
                // var formData = new FormData(formElement);
                // var urltxt = '../ajaxcall/rod_update_entry_ajax.php';

                ////Popup edit/update er code
                var buyer_id = $('#buyer_id_popup').val();

                if (buyer_id == 'none') {
                    alert('Please select a buyer Id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }
                var formElement = $('#insertPopupForm')[0];
                var formData = new FormData(formElement);
                var urltxt = '../ajaxcall/balu_update_entry_ajax.php';

            }

            if (returnValid) {
                $.ajax({
                    url: urltxt,
                    type: 'post',
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(res) {
                        console.log(res);
                        // alert(res);          
                        var optionValue = $('#delear_id option:selected').val();
                        dealerWiseSummaryDetailsSearchAndEntry(optionValue, res);

                        $('#buyer_id_popup').val("none").change();
                        $('#motor_name_popup').val('');
                        $('#driver_name_popup').val('');
                        $('#motor_vara_popup').val('');
                        $('#unload_popup').val('');
                        $('#car_rent_redeem_popup').val('');
                        $('#information_popup').val('');
                        $('#sl_popup').val('');
                        $('#voucher_popup').val('');
                        $('#address_popup').val('');
                        $('#motor_number_popup').val('');
                        $('#motor_sl_popup').val('');
                        $('#delivery_date_popup').val('');
                        $('#dates_popup').val('');
                        $('#partculars_popup').val('');
                        $('#particulars_popup').val("").change();
                        $('#debit_popup').val('');
                        $('#kg_popup').val('');
                        $('#length_popup').val('');
                        $('#width_popup').val('');
                        $('#height_popup').val('');
                        $('#shifty_popup').val('');
                        $('#inchi_minus_popup').val('');
                        $('#cft_dropped_popup').val('');
                        $('#inchi_added_popup').val('');
                        $('#points_dropped_popup').val('');
                        $('#shift_popup').val('');
                        $('#total_shift_popup').val('');
                        $('#paras_popup').val('');
                        $('#discount_popup').val('');
                        $('#credit_popup').val('');
                        $('#balance_popup').val('');
                        $('#cemeats_paras_popup').val('');
                        $('#ton_popup').val('');
                        $('#total_shifts_popup').val('');
                        $('#tons_popup').val('');
                        $('#bank_name_popup').val('');
                        $('#fee_popup').val('');
                        $('#NewEntrySucMsgPopup').html('');
                        // $('#popup_save_update_btn').val('Save').attr("onclick", "valid('insert_popup')");

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        }
    </script>
    <script type="text/javascript">
        function edit_rod_details(rod_id) {
            $('.rodDetailsEnCon').hide();
            var urltxt = '../ajaxcall/balu_edit_entry_ajax.php';
            $.ajax({
                url: urltxt,
                type: 'post',
                dataType: 'html',
                // processData: false,
                // contentType: false,
                data: {
                    'balu_details_id': rod_id
                },
                success: function(res) {
                    console.log(res);
                    // alert(res);
                    $('.rodDetailsEdit').html(res).show();
                    window.scrollTo(0, 500);



                    $('#delivery_date_edit').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });
                    $('#dates_edit').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function edit_rod_popup(element, rowid) {
            var buyr_id = $(element).closest('tr').find('td:eq(0)').text();
            // var dlar_id         = $(element).closest('tr').find('td:eq(1)').text();
            var motor_name = $(element).closest('tr').find('td:eq(1)').text();
            var driver_name = $(element).closest('tr').find('td:eq(2)').text();
            var motor_vara = $(element).closest('tr').find('td:eq(3)').text();
            var unload = $(element).closest('tr').find('td:eq(4)').text();
            var cars_rent_redeem = $(element).closest('tr').find('td:eq(5)').text();
            var information = $(element).closest('tr').find('td:eq(6)').text();
            var sl = $(element).closest('tr').find('td:eq(7)').text();
            var voucher_no = $(element).closest('tr').find('td:eq(8)').text();
            var address = $(element).closest('tr').find('td:eq(9)').text();
            var motor_number = $(element).closest('tr').find('td:eq(10)').text();
            var motor_sl = $(element).closest('tr').find('td:eq(11)').text();
            var delivery_date = $(element).closest('tr').find('td:eq(12)').text();
            var date = $(element).closest('tr').find('td:eq(13)').text();
            var partculars = $(element).closest('tr').find('td:eq(14)').text();
            var particulars = $(element).closest('tr').find('td:eq(15)').text();
            var debit = $(element).closest('tr').find('td:eq(16)').text();
            var ton_kg = $(element).closest('tr').find('td:eq(17)').text();
            var length = $(element).closest('tr').find('td:eq(18)').text();
            var width = $(element).closest('tr').find('td:eq(19)').text();
            var height = $(element).closest('tr').find('td:eq(20)').text();
            var shifty = $(element).closest('tr').find('td:eq(21)').text();
            var inchi_minus = $(element).closest('tr').find('td:eq(22)').text();
            var cft_dropped = $(element).closest('tr').find('td:eq(23)').text();
            var inchi_added = $(element).closest('tr').find('td:eq(24)').text();
            var points_dropped = $(element).closest('tr').find('td:eq(25)').text();
            var shift = $(element).closest('tr').find('td:eq(26)').text();
            var total_shift = $(element).closest('tr').find('td:eq(27)').text();
            var paras = $(element).closest('tr').find('td:eq(28)').text();
            var discount = $(element).closest('tr').find('td:eq(29)').text();
            var credit = $(element).closest('tr').find('td:eq(30)').text();
            var balance = $(element).closest('tr').find('td:eq(31)').text();
            var cemeats_paras = $(element).closest('tr').find('td:eq(32)').text();
            var ton = $(element).closest('tr').find('td:eq(33)').text();
            var total_shift = $(element).closest('tr').find('td:eq(34)').text();
            var tons = $(element).closest('tr').find('td:eq(35)').text();
            var bank_name = $(element).closest('tr').find('td:eq(35)').text();
            var fee = $(element).closest('tr').find('td:eq(36)').text();


            // alert(buyr_id);
            // $('#dealer_id').val(dlar_id);
            $('#balu_details_id').val(rowid);


            $('#buyer_id_popup').val(buyr_id);
            $('#motor_name_popup').val(motor_name);
            $('#driver_name_popup').val(driver_name);
            $('#motor_vara_popup').val(motor_vara);
            $('#unload_popup').val(unload);
            $('#car_rent_redeem_popup').val(cars_rent_redeem);
            $('#information_popup').val(information);
            $('#sl_popup').val(sl);
            $('#voucher_no_popup').val(voucher_no);
            $('#address_popup').val(address);
            $('#motor_number_popup').val(motor_number);
            $('#motor_sl_popup').val(motor_sl);
            $('#delivery_date_popup').val(delivery_date);
            $('#dates_popup').val(date);
            $('#partculars_popup').val(partculars);
            $('#particulars_popup').val(particulars);
            $('#debit_popup').val(debit);
            $('#kg_popup').val(ton_kg);
            $('#length_popup').val(length);
            $('#width_popup').val(width);
            $('#height_popup').val(height);
            $('#shifty_popup').val(shifty);
            $('#inchi_minus_popup').val(inchi_minus);
            $('#cft_dropped_popup').val(cft_dropped);
            $('#inchi_added_popup').val(inchi_added);
            $('#points_dropped_popup').val(points_dropped);
            $('#shift_popup').val(shift);
            $('#total_shift_popup').val(total_shift);
            $('#paras_popup').val(paras);
            $('#discount_popup').val(discount);
            $('#credit_popup').val(credit);
            $('#balance_popup').val(balance);
            $('#cemeats_paras_popup').val(cemeats_paras);
            $('#ton_popup').val(ton);
            $('#total_shift_popup').val(total_shift);
            $('#tons_popup').val(tons);
            $('#bank_name_popup').val(bank_name);
            $('#fee_popup').val(fee);
            $('#popup_save_update_btn').val('Update').attr("onclick", "valid('update_popup')").click(function() {
                $(".popupClose").trigger('click');
            });
            $("#popupEntry").fadeIn(500);
            $("#NewEntrySucMsgPopup").html('');
            $(".items_all_con").animate({
                scrollTop: 0
            }, "0");
        }
    </script>
    <script type="text/javascript">
        //Start calculation
        $(document).on('input change paste keyup', '.value-calc', function() {

            // var input_cft = $('#shift').val();
            // if(input_cft != ''){
            //     $('#total_shift').val(input_cft);
            //         $('#total_shifts').val(input_cft);
            // }

            var kg = $('#kg').val();

            if (kg != '') {
                $('#paras').attr("placeholder", "rate");
               
                var paras = $('#paras').val();
                if (kg == '') {
                    $('#credit').val('0');
                } else if (paras == '') {
                    $('#credit').val('0');
                } else {
                    var credit = kg * paras;
                    //  alert(credit);
                    $('#credit').val(credit.toFixed(2));
                }
            }


            // if(length != ''){
            //     $('#paras').attr("placeholder", "per cft");
            //     var t_s = $('#total_shift').val();
            //             var paras = $('#paras').val();
            //             if (t_s == '') {
            //                 $('#credit').val('0');
            //             } else if (paras == '') {
            //                 $('#credit').val('0');
            //             } else {
            //                 var credit_ts = t_s * paras;
            //                 //  alert(credit);
            //                 $('#credit').val(credit_ts.toFixed(2));
            //             }
            // }
            // else{
            //     $('#paras').attr("placeholder", "per ton");

            // }

            //shifty
            var length = $('#length').val();
            var width = $('#width').val();
            var height = $('#height').val();

            var inchi_minus = $("#inchi_minus").val();
            var cft_dropped_out = $('#cft_dropped_out').val();
            var inchi_added = $('#inchi_added').val();
            var points_dropped_out = $('#points_dropped_out').val();


            if (length != '' || width != '' || height != '') {

                $("#kg").attr("placeholder", "not applicable").prop("disabled", true);
                $("#td_kg").click(function() {
                    Swal.fire("Clear cft first");
                });
                var shifty = length * width * height;
                if (inchi_minus > shifty) {
                    Swal.fire("Not acceptable. Value should be less then cft");
                    $('#inchi_minus').val("");
                }
                if (cft_dropped_out > shifty) {
                    Swal.fire("Not acceptable. Value should be less then cft");
                    $('#cft_dropped_out').val("");
                }
                if (points_dropped_out > shifty) {
                    Swal.fire("Not acceptable. Value should be less then cft");
                    $('#points_dropped_out').val("");
                }
                if (shifty < 0) {
                    $('#shifty').val("");
                }
                if (inchi_minus != '' || cft_dropped_out != '' || inchi_added != '' || points_dropped_out != '') {
                    var shifty2 = (length * width * height) - (length * width * inchi_minus / 12) - cft_dropped_out + (length * width * inchi_added / 12) - points_dropped_out;
                    var shift2_to_ton = shifty2 / 23.5;
                    // alert(credit);
                    $('#shifty').val(shifty.toFixed(3));
                    $('#ton').val(shift2_to_ton.toFixed(2));
                    $('#tons').val(shift2_to_ton.toFixed(2));
                    $('#shift').val(shifty2.toFixed(3));

                    // $('#shift').attr('value', 'shifty2.toFixed(3)');
                    // $('#total_shift').val(shifty2.toFixed(2));
                    // $('#total_shifts').val(shifty2.toFixed(2));
                } else {
                    var shift_to_ton = shifty / 23.5;
                    // alert(credit);
                    $('#shifty').val(shifty.toFixed(3));
                    $('#ton').val(shift_to_ton.toFixed(2));
                    $('#tons').val(shift_to_ton.toFixed(2));
                    $('#shift').val(shifty.toFixed(3));
                    // $('#total_shift').val(shifty.toFixed(2));
                    // $('#total_shifts').val(shifty.toFixed(2));

                }
            } else if (width == '') {
                $("#kg").attr("placeholder", "ton and kg");
                $("#kg").prop("disabled", false);
                $('#shift').attr("placeholder", "not applicable");
                $('#shifty').attr("placeholder", "not applicable");

            } else if (height == '') {
                $("#kg").attr("placeholder", "ton and kg");
                $("#kg").prop("disabled", false);
                $('#shift').attr("placeholder", "not applicable");
                $('#shifty').attr("placeholder", "not applicable");
            } else if (length == '') {
                $("#kg").attr("placeholder", "ton and kg");
                $("#kg").prop("disabled", false);
                $('#shift').attr("placeholder", "not applicable");
                $('#shifty').attr("placeholder", "not applicable");
                // $('#total_shifty').val('0');
            }
            // else if(length != ''){
            //     $('#kg').val('0');
            // }
            else {



            }


            //ton and kg
            var shifty = $('#shift').val();
            var ton_kg = $('#kg').val();
            var credit = $("#credit").val();

            if (ton_kg != '') {
                $("#length").attr("placeholder", "not applicable").prop("disabled", true);
                $("#length").attr("readonly", true);
                // if($("#length").click){
                //     Swal.fire("Should be enter a number value");
                // }
                // $('#length').val('not applicable');
                $('#width').attr("placeholder", "not applicable").prop("disabled", true);
                $("#width").attr("readonly", true);
                $('#height').attr("placeholder", "not applicable").prop("disabled", true);
                $("#height").attr("readonly", true);

                $('#shifty').attr("placeholder", "not applicable").prop("disabled", true);
                $('#shift').attr("placeholder", "not applicable").prop("disabled", true);
                $('#total_shift').attr("placeholder", "not applicable").prop("disabled", true);
                $('#ton').attr("placeholder", "not applicable").prop("disabled", true);
                // $('#height').attr("placeholder", "not applicable").prop("disabled", true).css("background-color","gray");
                // $("#height").attr("readonly", true);
                // $('#').attr("value", "not applicable");
                $('#inchi_minus').attr("placeholder", "not applicable").prop("disabled", true);
                $("#inchi_minus").attr("readonly", true);
                $('#cft_dropped_out').attr("placeholder", "not applicable").prop("disabled", true);
                $("#cft_dropped_out").attr("readonly", true);
                $('#inchi_added').attr("placeholder", "not applicable").prop("disabled", true);
                $("#inchi_added").attr("readonly", true);
                $('#points_dropped_out').attr("placeholder", "not applicable").prop("disabled", true);
                $("#points_dropped_out").attr("readonly", true);
                // $('#').attr("value", "not applicable");
                $('#ton').val(ton_kg);
                $('#tons').val(ton_kg);

                var ton_to_cft = (ton_kg * 23.5).toFixed(3);
                // $('#shifty').val(ton_to_cft);
                // $('#shift').val(ton_to_cft);
                // $('#total_shift').val(ton_to_cft);
                // $('#total_shifts').val(ton_to_cft);
            } else {
                $("#length").attr("placeholder", "length").prop("disabled", false);
                $("#length").attr("readonly", false);
                // $('#length').val('not applicable');
                $('#width').attr("placeholder", "width").prop("disabled", false);
                $("#width").attr("readonly", false);
                $('#height').attr("placeholder", "height").prop("disabled", false);
                $("#height").attr("readonly", false);
                $('#inchi_minus').attr("placeholder", "inchi_minus").prop("disabled", false);
                $("#inchi_minus").attr("readonly", false);
                $('#cft_dropped_out').attr("placeholder", "cft_dropped_out").prop("disabled", false);
                $("#cft_dropped_out").attr("readonly", false);
                $('#inchi_added').attr("placeholder", "inchi_added").prop("disabled", false);
                $("#inchi_added").attr("readonly", false);
                $('#points_dropped_out').attr("placeholder", "points_dropped_out").prop("disabled", false);
                $("#points_dropped_out").attr("readonly", false);


                $('#shifty').prop("disabled", true);
                $('#shift').prop("disabled", true);
                $('#total_shift').prop("disabled", false);
                $('#ton').prop("disabled", false);

                var credit = shifty * paras;
                // alert(credit);
                $('#credit').val(credit.toFixed(3));
            }

            var total_input_cft = $('#total_shift').val();
            if (total_input_cft != '') {
                $('#paras').attr("placeholder", "per cft");

                var paras = $('#paras').val();
                // if (kg == '') {
                //     $('#credit').val('0');
                // } else if (paras == '') {
                //     $('#credit').val('0');
                // } else {
                var credit = total_input_cft * paras;
                //  alert(credit);
                $('#credit').val(credit.toFixed(2));
                // }
            }


            var discount = $("#discount").val();
            if (discount != '') {
                var credit = credit - discount;
                $('#credit').val(credit.toFixed(3));
                if (discount > credit) {
                    $('#discount').focus(function() {
                        $('#discount').val("");
                    });
                    Swal.fire("Not acceptable. Value should be less then credit");
                }
            }
            var fee = $("#fee").val();
            if (fee != '') {
                var credit = parseFloat(credit) + parseFloat(fee);
                $('#credit').val(credit.toFixed(3));
            }



            // console.log(inchi_minus);
            // console.log(ton_kg);

            // if (inchi_minus != '') {
            //     console.log(inchi_minus);
            //     $('#shift').val(inchi_minus);
            //     $('#total_shift').val('test');

            // }

            // if (cft_dropped_out != '') {
            //     console.log(cft_dropped_out);

            // }

            // var car_rent_redeem = $('#car_rent_redeem').val();
            // var credit = $("#credit").val();
            // if (car_rent_redeem == '') {
            //     var total_paras = credit;
            //     $('#credit').val(total_paras);
            // } else {
            //     var total_paras = parseFloat(car_rent_redeem) + parseFloat(credit);
            //     $('#credit').val(total_paras);
            // }
            // debit theke minus hote ai part tuku age dite hobe

            var debit = $("#debit").val();
            var credit = $("#credit").val();
            if (debit == '') {
                $('#balance').val('0');
            } else if (credit == '') {
                $('#balance').val('0');
            } else {
                var balance = credit - debit;
                // alert(balance);
                $('#balance').val(balance.toFixed(3));
            }

            var motor_vara = $('#motor_vara').val();
            var unload = $('#unload').val();
            if (motor_vara == '') {
                $('#motor_vara').attr("placeholder", "motor vara");
                //  $('#motor_vara').attr("value", "0");
                //  $('#motor_vara').val(0);

                $('#car_rent_redeem').val(unload);
                $('#cemeats_paras').val(unload);
            } else if (unload == '') {
                $('#unload').attr("placeholder", "unload");
                //  $('#unload').attr("value", "0");
                //  $('#unload').val(0);

                $('#car_rent_redeem').val(motor_vara);
                $('#cemeats_paras').val(motor_vara);
            } else if (unload == 0 && motor_vara == 0) {
                $('#car_rent_redeem').val(0);
            } else {


                //                 $('#motor_vara').focus(function(){
                //                     $('#motor_vara').value('')
                // });

                var car_rent_redeem = parseInt(motor_vara) + parseInt(unload);
                // alert(balance);
                $('#car_rent_redeem').val(car_rent_redeem);
                $('#cemeats_paras').val(car_rent_redeem);
            }




            // if (motor_vara == '') {
            //     $('#motor_vara').val()=null;
            // } else if (unload == '') {
            //     $('#unload').val()=null;
            // } else {
            //     $('#motor_vara').val()=null;
            // $('#unload').val()=null;
            //     var tar = motor_vara?$('#motor_vara').val():'0';
            //     var tar2 = motor_vara?$('#unload').val():'0';
            //     var car_rent_redeem = parseInt(tar) + parseInt(tar2);
            //     // alert(balance);
            //     $('#car_rent_redeem').val(car_rent_redeem);
            //     $('#cemeats_paras').val(car_rent_redeem);
            // }


        });
        // $(document).on('input change paste keyup', '.value-calc_edit', function() {
        //     var kg = $('#kg_edit').val();
        //     var paras = $('#paras_edit').val();
        //     if (kg == '') {
        //         $('#credit_edit').val('0');
        //     } else if (paras == '') {
        //         $('#credit_edit').val('0');
        //     } else {
        //         var credit = kg * paras;
        //         // alert(credit);
        //         $('#credit_edit').val(credit);
        //     }

        //     var debit = $("#debit_edit").val();
        //     var credit = $("#credit_edit").val();
        //     if (debit == '') {
        //         $('#balance_edit').val('0');
        //     } else if (credit == '') {
        //         $('#balance_edit').val('0');
        //     } else {
        //         var balance = credit - debit;
        //         // alert(balance);
        //         $('#balance_edit').val(balance);
        //     }

        //     var motor_cash = $('#motor_cash_edit').val();
        //     var unload = $('#unload_edit').val();
        //     if (motor_cash == '') {
        //         $('#car_rent_redeem_edit').val('0');
        //     } else if (unload == '') {
        //         $('#car_rent_redeem_edit').val('0');
        //     } else {
        //         var car_rent_redeem = parseInt(motor_cash) + parseInt(unload);
        //         // alert(balance);
        //         $('#car_rent_redeem_edit').val(car_rent_redeem);
        //     }


        //     var car_rent_redeem = $('#car_rent_redeem_edit').val();
        //     var credit = $("#credit_edit").val();
        //     if (car_rent_redeem == '') {
        //         var total_paras = credit;
        //         $('#total_paras_edit').val(total_paras);
        //     } else {
        //         var total_paras = parseInt(car_rent_redeem) + parseInt(credit);
        //         $('#total_paras_edit').val(total_paras);
        //     }
        // });
        // //End calculation
        //Start calculation popup
        $(document).on('input change paste keyup', '.value-calc-popup', function() {

            ////////////////////////////////////////////////////////////////
            var kg_popup = $('#kg_popup').val();
            if (kg_popup != '') {
                $('#paras_popup').attr("placeholder", "rate");
               
                var paras_popup = $('#paras_popup').val();
                if (kg_popup == '') {
                    $('#credit_popup').val('0');
                } else if (paras_popup == '') {
                    $('#credit_popup').val('0');
                } else {
                    var credit_popup = kg_popup * paras_popup;
                    //  alert(credit);
                    $('#credit_popup').val(credit_popup.toFixed(2));
                }
            }


            // if(length != ''){
            //     $('#paras').attr("placeholder", "per cft");
            //     var t_s = $('#total_shift').val();
            //             var paras = $('#paras').val();
            //             if (t_s == '') {
            //                 $('#credit').val('0');
            //             } else if (paras == '') {
            //                 $('#credit').val('0');
            //             } else {
            //                 var credit_ts = t_s * paras;
            //                 //  alert(credit);
            //                 $('#credit').val(credit_ts.toFixed(2));
            //             }
            // }
            // else{
            //     $('#paras').attr("placeholder", "per ton");

            // }

            //shifty
            var length_popup = $('#length_popup').val();
            var width_popup = $('#width_popup').val();
            var height_popup = $('#height_popup').val();

            var inchi_minus_popup = $("#inchi_minus_popup").val();
            var cft_dropped_out_popup = $('#cft_dropped_out_popup').val();
            var inchi_added_popup = $('#inchi_added_popup').val();
            var points_dropped_out_popup = $('#points_dropped_out_popup').val();


            if (length_popup != '' || width_popup != '' || height_popup != '') {

                $("#kg_popup").attr("placeholder", "not applicable").prop("disabled", true);
                $("#td_kg_popup").click(function() {
                    Swal.fire("Clear cft first");
                });
                var shifty_popup = length_popup * width_popup * height_popup;
                if (inchi_minus_popup > shifty_popup) {
                    Swal.fire("Not acceptable. Value should be less then cft");
                    $('#inchi_minus_popup').val("");
                }
                if (cft_dropped_out_popup > shifty_popup) {
                    Swal.fire("Not acceptable. Value should be less then cft");
                    $('#cft_dropped_out_popup').val("");
                }
                if (points_dropped_out_popup > shifty_popup) {
                    Swal.fire("Not acceptable. Value should be less then cft");
                    $('#points_dropped_out_popup').val("");
                }
                if (shifty_popup < 0) {
                    $('#shifty_popup').val("");
                }
                if (inchi_minus_popup != '' || cft_dropped_out_popup != '' || inchi_added_popup != '' || points_dropped_out_popup != '') {
                    var shifty2_popup = (length_popup * width_popup * height_popup) - (length_popup * width_popup * inchi_minus_popup / 12) - cft_dropped_out_popup + (length_popup * width_popup * inchi_added_popup / 12) - points_dropped_out_popup;
                    var shift2_to_ton_popup = shifty2_popup / 23.5;
                    // alert(credit);
                    $('#shifty_popup').val(shifty_popup.toFixed(3));
                    $('#ton_popup').val(shift2_to_ton_popup.toFixed(2));
                    $('#tons_popup').val(shift2_to_ton_popup.toFixed(2));
                    $('#shift_popup').val(shifty2_popup.toFixed(3));

                    // $('#shift').attr('value', 'shifty2.toFixed(3)');
                    // $('#total_shift').val(shifty2.toFixed(2));
                    // $('#total_shifts').val(shifty2.toFixed(2));
                } else {
                    var shift_to_ton_popup = shifty_popup / 23.5;
                    // alert(credit);
                    $('#shifty_popup').val(shifty_popup.toFixed(3));
                    $('#ton_popup').val(shift_to_ton_popup.toFixed(2));
                    $('#tons_popup').val(shift_to_ton_popup.toFixed(2));
                    $('#shift_popup').val(shifty_popup.toFixed(3));
                    // $('#total_shift').val(shifty.toFixed(2));
                    // $('#total_shifts').val(shifty.toFixed(2));

                }
            } else if (width_popup == '') {
                $("#kg_popup").attr("placeholder", "ton and kg");
                $("#kg_popup").prop("disabled", false);
                $('#shift_popup').attr("placeholder", "not applicable");
                $('#shifty_popup').attr("placeholder", "not applicable");

            } else if (height_popup == '') {
                $("#kg_popup").attr("placeholder", "ton and kg");
                $("#kg_popup").prop("disabled", false);
                $('#shift_popup').attr("placeholder", "not applicable");
                $('#shifty_popup').attr("placeholder", "not applicable");
            } else if (length_popup == '') {
                $("#kg_popup").attr("placeholder", "ton and kg");
                $("#kg_popup").prop("disabled", false);
                $('#shift_popup').attr("placeholder", "not applicable");
                $('#shifty_popup').attr("placeholder", "not applicable");
                // $('#total_shifty').val('0');
            }
            // else if(length != ''){
            //     $('#kg').val('0');
            // }
            else {



            }


            //ton and kg
            var shifty_popup = $('#shift_popup').val();
            var kg_popup = $('#kg_popup').val();
            var credit_popup = $("#credit_popup").val();

            if (kg_popup != '') {
                $("#length_popup").attr("placeholder", "not applicable").prop("disabled", true);
                $("#length_popup").attr("readonly", true);
                // if($("#length").click){
                //     Swal.fire("Should be enter a number value");
                // }
                // $('#length').val('not applicable');
                $('#width_popup').attr("placeholder", "not applicable").prop("disabled", true);
                $("#width_popup").attr("readonly", true);
                $('#height_popup').attr("placeholder", "not applicable").prop("disabled", true);
                $("#height_popup").attr("readonly", true);

                $('#shifty_popup').attr("placeholder", "not applicable").prop("disabled", true);
                $('#shift_popup').attr("placeholder", "not applicable").prop("disabled", true);
                $('#total_shift_popup').attr("placeholder", "not applicable").prop("disabled", true);
                $('#ton_popup').attr("placeholder", "not applicable").prop("disabled", true);
                // $('#height').attr("placeholder", "not applicable").prop("disabled", true).css("background-color","gray");
                // $("#height").attr("readonly", true);
                // $('#').attr("value", "not applicable");
                $('#inchi_minus_popup').attr("placeholder", "not applicable").prop("disabled", true);
                $("#inchi_minus_popup").attr("readonly", true);
                $('#cft_dropped_out_popup').attr("placeholder", "not applicable").prop("disabled", true);
                $("#cft_dropped_out_popup").attr("readonly", true);
                $('#inchi_added_popup').attr("placeholder", "not applicable").prop("disabled", true);
                $("#inchi_added_popup").attr("readonly", true);
                $('#points_dropped_out_popup').attr("placeholder", "not applicable").prop("disabled", true);
                $("#points_dropped_out_popup").attr("readonly", true);
                // $('#').attr("value", "not applicable");
                $('#ton_popup').val(kg_popup);
                $('#tons_popup').val(kg_popup);

                var ton_to_cft_popup = (kg_popup * 23.5).toFixed(3);
                // $('#shifty').val(ton_to_cft);
                // $('#shift').val(ton_to_cft);
                // $('#total_shift').val(ton_to_cft);
                // $('#total_shifts').val(ton_to_cft);
            } else {
                $("#length_popup").attr("placeholder", "length").prop("disabled", false);
                $("#length_popup").attr("readonly", false);
                // $('#length').val('not applicable');
                $('#width_popup').attr("placeholder", "width").prop("disabled", false);
                $("#width_popup").attr("readonly", false);
                $('#height_popup').attr("placeholder", "height").prop("disabled", false);
                $("#height_popup").attr("readonly", false);
                $('#inchi_minus_popup').attr("placeholder", "inchi_minus").prop("disabled", false);
                $("#inchi_minus_popup").attr("readonly", false);
                $('#cft_dropped_out_popup').attr("placeholder", "cft_dropped_out").prop("disabled", false);
                $("#cft_dropped_out_popup").attr("readonly", false);
                $('#inchi_added_popup').attr("placeholder", "inchi_added").prop("disabled", false);
                $("#inchi_added_popup").attr("readonly", false);
                $('#points_dropped_out_popup').attr("placeholder", "points_dropped_out").prop("disabled", false);
                $("#points_dropped_out_popup").attr("readonly", false);


                $('#shifty_popup').prop("disabled", true);
                $('#shift_popup').prop("disabled", true);
                $('#total_shift_popup').prop("disabled", false);
                $('#ton_popup').prop("disabled", false);

                var credit_popup = shifty_popup * paras_popup;
                // alert(credit);
                $('#credit_popup').val(credit_popup.toFixed(3));
            }

            var total_input_cft_popup = $('#total_shift_popup').val();
            if (total_input_cft_popup != '') {
                $('#paras_popup').attr("placeholder", "per cft");

                var paras_popup = $('#paras_popup').val();
                // if (kg == '') {
                //     $('#credit').val('0');
                // } else if (paras == '') {
                //     $('#credit').val('0');
                // } else {
                var credit_popup = total_input_cft_popup * paras_popup;
                //  alert(credit);
                $('#credit_popup').val(credit_popup.toFixed(2));
                // }
            }


            var discount_popup = $("#discount_popup").val();
            if (discount_popup != '') {
                var credit_popup = credit_popup - discount_popup;
                $('#credit_popup').val(credit_popup.toFixed(3));
                if (discount_popup > credit_popup) {
                    $('#discount_popup').focus(function() {
                        $('#discount_popup').val("");
                    });
                    Swal.fire("Not acceptable. Value should be less then credit");
                }
            }
            var fee_popup = $("#fee_popup").val();
            if (fee_popup != '') {
                var credit_popup = parseFloat(credit_popup) + parseFloat(fee_popup);
                $('#credit_popup').val(credit_popup.toFixed(3));
            }



            // console.log(inchi_minus);
            // console.log(ton_kg);

            // if (inchi_minus != '') {
            //     console.log(inchi_minus);
            //     $('#shift').val(inchi_minus);
            //     $('#total_shift').val('test');

            // }

            // if (cft_dropped_out != '') {
            //     console.log(cft_dropped_out);

            // }

            // var car_rent_redeem = $('#car_rent_redeem').val();
            // var credit = $("#credit").val();
            // if (car_rent_redeem == '') {
            //     var total_paras = credit;
            //     $('#credit').val(total_paras);
            // } else {
            //     var total_paras = parseFloat(car_rent_redeem) + parseFloat(credit);
            //     $('#credit').val(total_paras);
            // }
            // debit theke minus hote ai part tuku age dite hobe

            var debit_popup = $("#debit_popup").val();
            var credit_popup = $("#credit_popup").val();
            if (debit_popup == '') {
                $('#balance_popup').val('0');
            } else if (credit == '') {
                $('#balance_popup').val('0');
            } else {
                var balance_popup = credit_popup - debit_popup;
                // alert(balance);
                $('#balance_popup').val(balance_popup.toFixed(3));
            }

            var motor_vara_popup = $('#motor_vara_popup').val();
            var unload_popup = $('#unload_popup').val();
            if (motor_vara_popup == '') {
                $('#motor_vara_popup').attr("placeholder", "motor vara");
                //  $('#motor_vara').attr("value", "0");
                //  $('#motor_vara').val(0);

                $('#car_rent_redeem_popup').val(unload_popup);
                $('#cemeats_paras_popup').val(unload_popup);
            } else if (unload_popup == '') {
                $('#unload_popup').attr("placeholder", "unload");
                //  $('#unload').attr("value", "0");
                //  $('#unload').val(0);

                $('#car_rent_redeem_popup').val(motor_vara_popup);
                $('#cemeats_paras_popup').val(motor_vara_popup);
            } else if (unload_popup == 0 && motor_vara_popup == 0) {
                $('#car_rent_redeem_popup').val(0);
            } else {


                //                 $('#motor_vara').focus(function(){
                //                     $('#motor_vara').value('')
                // });

                var car_rent_redeem_popup = parseInt(motor_vara_popup) + parseInt(unload_popup);
                // alert(balance);
                $('#car_rent_redeem_popup').val(car_rent_redeem_popup);
                $('#cemeats_paras_popup').val(car_rent_redeem_popup);
            }




            // if (motor_vara == '') {
            //     $('#motor_vara').val()=null;
            // } else if (unload == '') {
            //     $('#unload').val()=null;
            // } else {
            //     $('#motor_vara').val()=null;
            // $('#unload').val()=null;
            //     var tar = motor_vara?$('#motor_vara').val():'0';
            //     var tar2 = motor_vara?$('#unload').val():'0';
            //     var car_rent_redeem = parseInt(tar) + parseInt(tar2);
            //     // alert(balance);
            //     $('#car_rent_redeem').val(car_rent_redeem);
            //     $('#cemeats_paras').val(car_rent_redeem);
            // }








           // ................................................................................
            // var kg = $('#tons_popup').val();
            // var paras = $('#paras_popup').val();
            // if (kg == '') {
            //     $('#credit_popup').val('0');
            // } else if (paras == '') {
            //     $('#credit_popup').val('0');
            // } else {
            //     var credit = kg * paras;
            //     // alert(credit);
            //     $('#credit_popup').val(credit);
            // }

            // var fee = $("#fee_popup").val();
            // var credit = $("#credit_popup").val();
            // var fee = parseFloat(fee);
            // if (fee == '') {
            //     $('#fee').val('0');
            // } else {
            //     var credit_with_fee = parseFloat(credit) + fee;
            //     // alert(balance);
            //     $('#credit_popup').val(credit_with_fee);
            // }

            // var debit = $("#debit_popup").val();
            // var credit = $("#credit_popup").val();
            // if (debit == '') {
            //     $('#balance_popup').val('0');
            // } else if (credit == '') {
            //     $('#balance_popup').val('0');
            // } else {
            //     var balance = credit - debit;
            //     // alert(balance);
            //     $('#balance_popup').val(balance);
            // }

            // var motor_vara = $('#motor_vara_popup').val();
            // var unload = $('#unload_popup').val();
            // if (motor_vara == '') {
            //     $('#car_rent_redeem_popup').val('0');
            // } else if (unload == '') {
            //     $('#car_rent_redeem_popup').val('0');
            // } else {
            //     var car_rent_redeem = parseInt(motor_vara) + parseInt(unload);
            //     // alert(balance);
            //     $('#car_rent_redeem_popup').val(car_rent_redeem);
            // }


            // var car_rent_redeem = $('#car_rent_redeem_popup').val();
            // var credit = $("#credit_popup").val();
            // if (car_rent_redeem == '') {
            //     var total_paras = credit;
            //     $('#credit_popup').val(total_paras);
            // } else {
            //     var total_paras = parseInt(car_rent_redeem) + parseFloat(credit);
            //     $('#credit_popup').val(total_paras);
            // }


            // var discountp = $("#discount_popup").val();
            // var credit_with_dis = $("#credit_popup").val();
            // var discountp2 = parseFloat(discountp);
            // if (discountp == '') {
            //     $('#discountp').val('0');
            // } else {
            //     var credit_with_dis = credit_with_dis - ((discountp2 / 100) * credit_with_dis);
            //     // alert(balance);
            //     $('#credit_popup').val(credit_with_dis);
            // }







            ///////////////////////////////////////////////////////////////////////////////////////
            //     // var kg = $('#kg_popup').val();
            //     // var paras = $('#paras_popup').val();
            //     // if (kg == '') {
            //     //     $('#credit_popup').val('0');
            //     // } else if (paras == '') {
            //     //     $('#credit_popup').val('0');
            //     // } else {
            //     //     var credit = kg * paras;
            //     //     // echo(kg);
            //     //     // echo(paras);
            //     //     // alert(credit);
            //     //     $('#credit_popup').val(credit);
            //     // }


            //     var discountp = $("#discount_popup").val();
            //     var creditp = $("#credit_popup").val();
            //     var discountp2 = parseFloat(discountp);
            //     if (discountp != '') {
            //          creditp = creditp - ((discountp2 / 100) * creditp);
            //         // alert(typeof(discountp2));
            //         $('#credit_popup').val(creditp.toFixed(2));

            //     }

            //     // var fee = parseFloat($("#fee_popup").val()) ;
            //     // if (fee != '') {
            //     //  creditp = parseInt(creditp) + parseInt(fee);
            //     //     $('#credit_popup').val(creditp);
            //     // }
            //     var debit = parseFloat($("#debit_popup").val()) ;
            //     var creditp = $("#credit_popup").val();
            //     if (debit == '') {
            //         $('#balance_popup').val('0');
            //     } else if (creditp == '') {
            //         $('#balance_popup').val('0');
            //     } else {
            //         var balance = creditp - debit;
            //         // alert(balance);
            //         $('#balance_popup').val(balance);
            //     }

            //     var motor_cash = $('#motor_vara_popup').val();
            //     var unload = $('#unload_popup').val();
            //     if (motor_cash == '') {
            //         $('#car_rent_redeem_popup').val('0');
            //     } else if (unload == '') {
            //         $('#car_rent_redeem_popup').val('0');
            //     } else {
            //         var car_rent_redeem = parseInt(motor_cash) + parseInt(unload);
            //         // alert(balance);
            //         $('#car_rent_redeem_popup').val(car_rent_redeem);
            //         $('#cemeats_paras_popup').val(car_rent_redeem);
            //     }


            // //     var car_rent_redeem = $('#car_rent_redeem_popup').val();
            // //     var credit = $("#credit_popup").val();
            // //     if (car_rent_redeem == '') {
            // //         var total_paras = credit;
            // //         $('#total_paras_popup').val(total_paras);
            // //     } else {
            // //         var total_paras = parseInt(car_rent_redeem) + parseInt(credit);
            // //         $('#total_paras_popup').val(total_paras);
            // //     }
        });
        //End calculation popup
    </script>

    <script type="text/javascript">
        function getDataByDates(datestr, dealerId) {
            $.ajax({
                url: '../ajaxcall/balu_search_date_entry.php',
                type: 'post',
                data: {
                    optionDate: datestr,
                    dealerId: dealerId,
                },
                success: function(res) {
                    // alert(res);
                    $('#viewDetails').html(res);
                    $('.left_side_bar').height($('.main_bar').innerHeight());
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }


        function getSummaryByDates(datestr, dealerId) {
            $.ajax({
                url: '../ajaxcall/balu_search_date_wise_summary_entry.php',
                type: 'post',
                data: {
                    optionDate: datestr,
                    dealerId: dealerId,
                },
                success: function(res) {
                    // alert(res);
                    $('#panel').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }


        $(document).on('change', '#dateSearchList', function() {
            var optionDate = $('#dateSearchList option:selected').val();
            var dealerId = $('#delear_id option:selected').val();
            // alert(dealerId);          
            getDataByDates(optionDate, dealerId);
            getSummaryByDates(optionDate, dealerId);
        });
    </script>
    <script>
        function datecheckformat(e) {
            //On Enter key Press

            var currentID = e.target.id;
            var dateStr = $('#' + currentID).val();
            // alert(e.target.id);            
            // alert(dateStr);
            if (e.which == 13) {
                // alert('You pressed enter!');            
                if (dateStr.length == 8) {
                    var day = dateStr.trim().substr(0, 2);
                    var month = dateStr.trim().substr(2, 2);
                    var year = dateStr.trim().substr(4, 4);
                    var formatedDate = day + '-' + month + '-' + year;
                    // alert(formatedDate);
                    $('#' + currentID).val(formatedDate);
                    $('#' + currentID).datepicker("setDate", new Date(year, month - 1, day));
                    console.log(formatedDate);
                } else {
                    alert('Date input dayMonthYear within 8 char.');
                }
            }

        }

        function datecheckformatpopup(e) {
            //On Enter key Press

            var currentID = e.target.id;
            var dateStr = $('#' + currentID).val();
            // alert(e.target.id);            
            // alert(dateStr);
            if (e.which == 13) {
                // alert('You pressed enter!');            
                if (dateStr.length == 8) {
                    var day = dateStr.trim().substr(0, 2);
                    var month = dateStr.trim().substr(2, 2);
                    var year = dateStr.trim().substr(4, 4);
                    var formatedDate = day + '-' + month + '-' + year;
                    // alert(formatedDate);
                    $('#' + currentID).val(formatedDate);
                    $('#' + currentID).datepicker("setDate", new Date(year, month - 1, day));
                    console.log(formatedDate);
                } else {
                    alert('Date input dayMonthYear within 8 char.');
                }
            }

        }
    </script>
    <script type="text/javascript">
        $(document).on('click', '#entry_scroll1', function() {
            $('#scrolling-entry-div').animate({
                scrollLeft: '1090'
            }, 1000, "swing");
            $(this).hide();
            $('#entry_scroll2').show();
            $('#entry_scroll3').hide();
        });
        $(document).on('click', '#entry_scroll2', function() {
            $('#scrolling-entry-div').animate({
                scrollLeft: '+=1110'
            }, 1000, "swing");
            $(this).hide();
            $('#entry_scroll1').hide();
            $('#entry_scroll3').show();
        });
        $(document).on('click', '#entry_scroll3', function() {
            $('#scrolling-entry-div').animate({
                scrollLeft: '0'
            }, 1000, "swing");
            $(this).hide();
            $('#entry_scroll1').show();
            $('#entry_scroll2').hide();
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '#gb_bank_ganti_td', function() {
            $('#gb_bank_ganti').show().focus();
        });

        $(document).on('mousedown', function(e) {
            console.log(e);
            console.log($(e.target).attr('id'));
            if ($(e.target).attr('id') == 'gb_bank_ganti') {

            } else {
                console.log('hide');
                $('#gb_bank_ganti').hide();
            }
        });


        function gbbank_update(id, gbvalue) {
            $.ajax({
                url: '../ajaxcall_save_update/balu_gb_bank_update.php',
                type: 'post',
                data: {
                    details_id: id,
                    gbvalue: gbvalue,
                },
                success: function(res) {
                    $('#gbbank_stable_val').html(res);
                    alert('GB Bank Ganti Updated Successfully.');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        $(document).on('keypress', '#gb_bank_ganti', function(e) {
            if (e.which == 13) {
                var id = $(e.currentTarget).attr('data-id');
                var gbvalue = $('#gb_bank_ganti').val();
                // alert(id);
                gbbank_update(id, gbvalue);
                $('#gb_bank_ganti').hide();
            }
        });
    </script>
    <script type="text/javascript">
        $(document).on('change', '#particulars', function() {
            var value = $('#particulars option:selected').val().match(/\d+/);
            // alert(value);
            if (value == '04') {
                $('#mm').val('04.5 mm');
            } else if (value == '06') {
                $('#mm').val('06 mm');
            } else if (value == '08') {
                $('#mm').val('08 mm');
            } else if (value == '10') {
                $('#mm').val('10 mm');
            } else if (value == '12') {
                $('#mm').val('12 mm');
            } else if (value == '16') {
                $('#mm').val('16 mm');
            } else if (value == '20') {
                $('#mm').val('20 mm');
            } else if (value == '22') {
                $('#mm').val('22 mm');
            } else if (value == '25') {
                $('#mm').val('25 mm');
            } else if (value == '32') {
                $('#mm').val('32 mm');
            } else if (value == '42') {
                $('#mm').val('42 mm');
            } else {
                $('#mm').val('');
            }
        });
        $(document).on('change', '#particulars_edit', function() {
            var value = $('#particulars_edit option:selected').val().match(/\d+/);
            // alert(value);
            if (value == '04') {
                $('#mm_edit').val('04.5 mm');
            } else if (value == '06') {
                $('#mm_edit').val('06 mm');
            } else if (value == '08') {
                $('#mm_edit').val('08 mm');
            } else if (value == '10') {
                $('#mm_edit').val('10 mm');
            } else if (value == '12') {
                $('#mm_edit').val('12 mm');
            } else if (value == '16') {
                $('#mm_edit').val('16 mm');
            } else if (value == '20') {
                $('#mm_edit').val('20 mm');
            } else if (value == '22') {
                $('#mm_edit').val('22 mm');
            } else if (value == '25') {
                $('#mm_edit').val('25 mm');
            } else if (value == '32') {
                $('#mm_edit').val('32 mm');
            } else if (value == '42') {
                $('#mm_edit').val('42 mm');
            } else {
                $('#mm_edit').val('');
            }
        });
        $(document).on('change', '#particulars_popup', function() {
            var value = $('#particulars_popup option:selected').val().match(/\d+/); // alert(value);
            if (value == '04') {
                $('#mm_popup').val('04.5 mm');
            } else if (value == '06') {
                $('#mm_popup').val('06 mm');
            } else if (value == '08') {
                $('#mm_popup').val('08 mm');
            } else if (value == '10') {
                $('#mm_popup').val('10 mm');
            } else if (value == '12') {
                $('#mm_popup').val('12 mm');
            } else if (value == '16') {
                $('#mm_popup').val('16 mm');
            } else if (value == '20') {
                $('#mm_popup').val('20 mm');
            } else if (value == '22') {
                $('#mm_popup').val('22 mm');
            } else if (value == '25') {
                $('#mm_popup').val('25 mm');
            } else if (value == '32') {
                $('#mm_popup').val('32 mm');
            } else if (value == '42') {
                $('#mm_popup').val('42 mm');
            } else {
                $('#mm_popup').val('');
            }
        });
    </script>
    <script>
        function myFunction() {

            var header = document.getElementById('city_center_id');
            var summary = document.getElementById('panel');
            var details = document.getElementById('detailsNewTable2');
            var wme = window.open("", "", "width=900,height=700, scrollbars=yes");



            wme.document.write('<style>td, th{border: 1px solid #868686; padding: 4px; }#detailsNewTable2{border-collapse: collapse;}.text-center{text-align: center; margin: 6px 0px;}.summary{border-collapse: collapse; margin-bottom: 20px;}.no_print_media{display: none !important;}.hastext{text-align: right;}</style>');

            wme.document.write(header.outerHTML);
            wme.document.write(summary.outerHTML);
            wme.document.write(details.outerHTML);


            // var x = '<script type="text/javascript" ' + 'src="https://code.jquery.com/jquery-1.10.2.js">' +'<'+ '/script>';
            // wme.document.write(x);

            wme.document.close();
            wme.focus();
            wme.print();
            // wme.close();

        }

        function myFunction2() {
            var doc = new jsPDF(); //create jsPDF object
            doc.fromHTML(document.getElementById("detailsNewTable2"), // page element which you want to print as PDF
                15,
                15, {
                    'width': 170 //set width
                },
                function(a) {
                    doc.save("HTML2PDF.pdf"); // save file name as HTML2PDF.pdf
                });
        }
    </script>
    <script type="text/javascript">
        $('#delivery_date_popup').bind('keydown', function(e) {
            if (e.which == 13)
                e.stopImmediatePropagation();
        }).datepicker({
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd-mm-yy",
            changeYear: true,
        });


        $('#dates_popup').bind('keydown', function(e) {
            if (e.which == 13)
                e.stopImmediatePropagation();
        }).datepicker({
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd-mm-yy",
            changeYear: true,
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '.edPermit', function(event) {
            event.preventDefault();
            ConfirmDialog('You have no permission edit/delete this data !');

            function ConfirmDialog(message) {
                $('<div></div>').appendTo('body')
                    .html('<div><h4>' + message + '</h4></div>')
                    .dialog({
                        modal: true,
                        title: 'Alert',
                        zIndex: 10000,
                        autoOpen: true,
                        width: '40%',
                        resizable: false,
                        position: {
                            my: "center",
                            at: "center center-20%",
                            of: window
                        },
                        buttons: {
                            Ok: function() {
                                $(this).dialog("close");
                            },
                            Cancel: function() {
                                $(this).dialog("close");
                            }
                        },
                        close: function(event, ui) {
                            $(this).remove();
                        }
                    });
            };
        });


        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            // if ((charCode > 31 || charCode < 46)&& charCode == 47 && (charCode < 48 || charCode > 57)) {
            if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8)) {
                Swal.fire("Should be enter a number value");
                // alert("Should be enter a number value");
                console.log("Workkkkk", evt);
                return false;
            }
            return true;
        }
    </script>
    <script type="text/javascript">
        $(document).on("click", ".kajol_close, .cancel", function() {
            $("#verifyPasswordModal").hide();
        });
    </script>
    <script src="../js/common_js.js"> </script>
</body>

</html>