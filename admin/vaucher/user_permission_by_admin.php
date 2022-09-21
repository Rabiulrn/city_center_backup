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