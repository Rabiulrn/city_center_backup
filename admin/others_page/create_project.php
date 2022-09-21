<?php 
session_start();
if(!isset($_SESSION['username'])){
    header('location:../index.php'); 
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
// $project_name_id = $_SESSION['project_name_id'];
$edit_data_permission   = $_SESSION['edit_data'];
$delete_data_permission = $_SESSION['delete_data'];


// .................added by rabiul.................................
$project_name_id = $_SESSION['project_name_id'];
// echo $project_name_id;
// echo "Study PHP at " . $project_name_id . "<br>";

$_SESSION['pageName'] = 'create_project';
$sucMsg = '';
$errMsg = '';
// var_dump($_POST['submit']);
if(isset($_POST['submit'])) {   
    $heading = $_POST['heading'];
    $subheading = $_POST['subheading'];
    $project_id = $_POST['project_id'];

    if($_POST['submit'] == 'Create New Project'){
        $query = "INSERT INTO project_heading_3 (heading, subheading,project_name_id) VALUES('$heading', '$subheading','$project_name_id') ";
        // $query = "INSERT INTO project_heading (heading, subheading) VALUES('$heading', '$subheading')";
        $result = $db->select($query);
        if ($result)  {   
            $project_id ='0';
            // $query = "SELECT id FROM project_heading WHERE heading ='$heading' AND subheading = '$subheading'";
            $query = "SELECT id FROM project_heading_3 WHERE heading ='$heading' AND subheading = '$subheading'";
            $result = $db->select($query);
            if($result){
                while ($rows = $result->fetch_assoc()){
                    $project_id = $rows['id'];
                }
            }
            
            // $date = date("Y-m-d");  
            // $query ="INSERT INTO due (due_credit_amount, due_debit_amount, due_debit_date, project_name_id) VALUES (0, 0, '$date', '$project_id')";
            // $result = $db->select($query);
            // if($result){}
            $sucMsg = 'New Project Create Successfully!';
        } else {
          $errMsg = 'Failed Create Project !';
        }
    } else {
        // $query = "UPDATE project_heading SET heading='$heading', subheading='$subheading' WHERE id = '$project_id'";
        $query = "UPDATE project_heading_3 SET heading='$heading', subheading='$subheading' WHERE id = '$project_id'";

        $result = $db->select($query);
        if ($result) {   
          $sucMsg = 'Project Updated Successfully!';
        } else {
          $errMsg = 'Failed Create Project !';
        }
    }
}


if(isset($_GET['remove_id'])){
    $project_delete_id = $_GET['remove_id'];
    // $sql = "DELETE FROM project_heading WHERE id = '$project_delete_id'";
    $sql = "DELETE FROM project_heading_3 WHERE id = '$project_delete_id'";
    if($db->select($sql) === TRUE) {
        $sql = "DELETE FROM due WHERE project_name_id = '$project_delete_id'";
        if ($db->select($sql) === TRUE) {
            
            $qry = "DELETE FROM agrim_hisab WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM cash WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM cash WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM debit_group WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM debit_group_data WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM details WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM details_sell WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            // $qry = "DELETE FROM due WHERE project_name_id = '$project_delete_id'";
            // $result = $db->delete($qry);            

            $qry = "DELETE FROM vaucher_credit WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM jara_pabe WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM nij_paonadar WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM entry_jara_pabe WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            $qry = "DELETE FROM entry_nij_paonadar WHERE project_name_id = '$project_delete_id'";
            $result = $db->delete($qry);

            //Update login project_name_id                
                $qryst = "SELECT id, project_name_id FROM login WHERE project_name_id LIKE '%$project_delete_id%'";
                $search_rslt = $db->select($qryst);
                if($search_rslt && mysqli_num_rows($search_rslt) > 0){
                    while($srch_row = $search_rslt->fetch_assoc()){
                        $row_id = $srch_row['id'];
                        $all_project_id = $srch_row['project_name_id'];
                        $arr_ids = explode(',', $all_project_id);

                        function remove_element($array, $value) {
                          foreach (array_keys($array, $value) as $key) {
                            unset($array[$key]);
                          }  
                            return $array;
                        }
                        $removed_id_arr = remove_element($arr_ids, $project_delete_id);
                        $for_update_arr_ids = implode(",", $removed_id_arr);
                        $newQry = "UPDATE login SET project_name_id = '$for_update_arr_ids' WHERE id = '$row_id'";
                        $newUpdate = $db->select($newQry);
                        echo "Updated";
                    }
                }
            //Update login project_name_id
            $sucMsg = "A Project delete successfully.";
        } else {
            $sucMsg = "Project Not delete.";
        }        
    } else {
        echo "Error: " . $sql . "<br>" .$db->error;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Project</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <style type="text/css">
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
    }
    .table > thead > tr > th {
        border-bottom: 2px solid #ddd;
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd;
    }

    .create_user_con{
        /*background-color: #f0f0f0;
        border: 1px solid #ddd;*/
        width: 100%;
        padding: 5px 50px 50px;
        border-radius: 4px;
        margin-top: 50px;
        /*box-shadow: 0 1px 1px rgba(0,0,0,.05);*/
    }
    .new_user_heading{
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
        text-align: center;
        color: #fff;
        background-color: #286090;
        padding: 5px;
        border-radius: 4px;
    }
    .pannel{
      width: 50%;
      margin: 0px auto;
      padding: 25px;
      background-color: #fff;
      /*border-radius: 5px;*/
      /*border: 2px solid #337ab7;*/
      border: 2px solid #ddd;
      /*box-shadow: 0px 10px 30px #333;*/
    }
    .errorMsg{
      /*background-color: #ab0000;*/
      color: #ab0000;
      /*padding: 5px;*/
      font-size: 14px;
      font-weight: bold;
      border-radius: 5px;
      margin-top: 5px;
    }
    .successMsg{
      color: #0e9b1e;
      /*padding: 5px;*/
      text-align: center;
      font-size: 14px;
      font-weight: bold;
      border-radius: 5px;
      /*margin-top: 5px;*/
    }
    .pagesCheck{
      width: 33.33%;
      display: block;
      padding-left: 16px;
      float: left;
    }
    .showProjectsCon{
      margin-bottom: 100px;
    }
    .showProjectsCon table th, .showProjectsCon table td {
      padding: 2px 5px;
    }
  </style>
</head>
<body>
  <?php
    include '../navbar/header_text.php';
    include '../navbar/navbar.php';    
  ?> 
  <div class="container">
    <?php 
      // $ph_id = $_SESSION['project_name_id'];
      // $query = "SELECT * FROM project_heading WHERE id = $ph_id";
      // $show = $db->select($query);
      // if ($show) 
      // {
      //   while ($rows = $show->fetch_assoc()) 
      //   {
    ?>
    <!-- <div class="project_heading text-center">      
      <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
    </div> -->
  <?php 
      //   }
      // } 
  ?>
	
  <form action="" method="POST" onsubmit="return validation()">
        <div class="create_user_con">
            <div class="pannel ">
                <div class="form-group">
                    <div class="new_user_heading bg-primary">Create Project</div>
                    <div class="errorMsg" id="errorShow"  style="text-align: center;"><?php echo $errMsg; ?></div>
                    <div class="successMsg" id="sucShow"><?php echo $sucMsg; ?></div>
                </div>
                <div class="form-group">
                    <label for="username" class="">Project Name:</label><br>
                    <input type="text" name="heading" class="form-control" id = "heading" placeholder="প্রতিষ্ঠানের নাম..."/>
                    <input type="hidden" name="project_id" id="project_id">
                    <!-- <div id="unameMsg" class="errorMsg"></div> -->
                </div>
                <div class="form-group">
                    <label for="Mobile" class="">Project Work Details:</label><br>
                    <input type="text" name="subheading" class="form-control" id = "subheading" placeholder="কাজের বিবরন..."/>
                    <!-- <div id="mobileMsg" class="errorMsg"></div> -->
                </div>
                  

                <div class="form-group" style="margin-bottom: 0px;">
                    <input type="submit" name="submit" id="submitBtn" class="btn btn-primary btn-block" value="Create New Project">
                </div>
                
            </div>            
        </div>
      </form>

      <div class="showProjectsCon">
        <table width="100%" border="1px">
          <tr class="bg-primary">
            <th width="50px" class="text-center">Sl No</th>
            <th class="text-center">Project Name</th>
            <th class="text-center">Work details</th>
            <th></th>
            <th></th>
          </tr>
          <?php
            // $sql = "SELECT * FROM project_heading";
            $sql = "SELECT * FROM project_heading_3 WHERE project_name_id = '$project_name_id'";
            $show = $db->select($sql);
            if ($show) {
              $i=1;
              while ($rows = $show->fetch_assoc()){
                echo "<tr>";
                  echo "<td class='text-center'>".$i."</td>";
                  echo "<td>". $rows['heading'] . "</td>";
                  echo "<td>". $rows['subheading'] . "</td>";
                                    
                  if($delete_data_permission == 'yes'){
                      echo "<td width='78px'><a class='btn btn-danger projectDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
                  } else {
                      echo '<td width="78px"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
                  }
                    
                  if($edit_data_permission == 'yes'){
                      echo "<td width='60px'><a class='btn btn-success' onclick='displayupdate(this)' row_id=" . $rows['id'] . ">Edit</a></td>";
                  } else {
                      echo '<td width="60px"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
                  }
                echo "</tr>";
                $i++;
              }
            }
          ?>

        </table>
      </div>      
</div>
<?php include 'delete_permission_modal.php';  ?>
<script type="text/javascript">
      function validation(){
          validReturn = false;

          var heading   = $('#heading').val();
          var subheading = $('#subheading').val();
          // alert(heading +" | "+ subheading);
          if(heading == ""){
              alert("প্রতিষ্ঠানের নাম ফাঁকা হবে না !");
              $('#heading').focus();
              validReturn = false;
          } else if(heading.length > 40){
              alert("প্রতিষ্ঠানের নাম ৪০ অক্ষরের বেশী হবে না !");
              $('#heading').focus();
              validReturn = false;
          } else if($.isNumeric(heading)){
              alert("প্রতিষ্ঠানের নাম সংখ্যা হতে পারে না !");
              $('#heading').focus();
              validReturn = false;
          } else {
            if(subheading == ""){
                  alert("কাজের বিবরন ফাঁকা হবে না !");
                  $('#subheading').focus();
                  validReturn = false;
              }else if(subheading.length > 40){
                  alert("কাজের বিবরন ৪০ অক্ষরের বেশী হবে না !");
                  $('#subheading').focus();
                  validReturn = false;
              } else if($.isNumeric(subheading)){
                  alert("কাজের বিবরন সংখ্যা হতে পারে না !");
                  $('#subheading').focus();
                  validReturn = false;
              } else {
                validReturn = true;
              }
          }

          if(validReturn){
              return true;
          }else{
              return false;
          }
      }

    function displayupdate(element){
      var td_2      = $(element).closest('tr').find('td:eq(1)').text();
      var td_3      = $(element).closest('tr').find('td:eq(2)').text();
      var row_id    = $(element).attr('row_id');
      // alert(td_mobile);

      $('#heading').val(td_2);
      $('#subheading').val(td_3);
      $('#project_id').val(row_id);
      
      $('#submitBtn').val('Update');
      $("html, body").animate({ scrollTop: 0 }, "slow");
    }

</script>
<script type="text/javascript">
      $(document).on('click', '.projectDelete', function(event){          
        var remove_id = $(event.target).attr('data_delete_id');
        $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
        $("#matchPassword").val('');
        $("#passMsg").html('');
        $("#verifyToDeleteBtn").attr("data_delete_id", remove_id);
      });
      $(document).on('click', '#verifyToDeleteBtn', function(event){
          event.preventDefault();
          var remove_id = $(event.target).attr('data_delete_id');
          console.log(remove_id);
          $("#passMsg").html("").css({'margin':'0px'});          
          var pass = $("#matchPassword").val();
          $.ajax({
              url: "../ajaxcall/match_password_for_vaucher_credit.php",
              type: "post",
              data: { pass : pass },
              success: function (response) {
                // alert(response);
                if(response == 'password_matched'){
                  $("#verifyPasswordModal").hide();
                  ConfirmDialog('Are you sure delete the Project ?', 'If you delete the project than it will be delete all project related data, that cant be retrive again!');
                } else {
                  $("#passMsg").html(response).css({'color':'red','margin-top':'10px'});
                }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
              }
          });
          
          function ConfirmDialog(message, msg){
              $('<div></div>').appendTo('body')
                              .html('<div><h4>'+message+'</h4><h5 style="color: red;">'+msg+'</h5></div>')
                              .dialog({
                                  modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                  width: '40%', resizable: false,
                                  position: { my: "center", at: "center center-20%", of: window },
                                  buttons: {
                                      Yes: function () {
                                          $(this).dialog("close");
                                          $.get("create_project.php?remove_id="+remove_id, function(data, status){
                                            console.log(status);
                                            if(status == 'success'){
                                                window.location.href = 'create_project.php';
                                            }
                                          });
                                      },
                                      No: function () {
                                          $(this).dialog("close");
                                      }
                                  },
                                  close: function (event, ui) {
                                      $(this).remove();
                                  }
                              });
            };
      });
      $(document).on('click', '.edPermit', function(event){
          event.preventDefault();
          ConfirmDialog('You have no permission edit/delete this data !');
          function ConfirmDialog(message){
              $('<div></div>').appendTo('body')
                              .html('<div><h4>'+message+'</h4></div>')
                              .dialog({
                                  modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                  width: '40%', resizable: false,
                                  position: { my: "center", at: "center center-20%", of: window },
                                  buttons: {
                                      Ok: function () {
                                          $(this).dialog("close");
                                      },
                                      Cancel: function () {
                                          $(this).dialog("close");
                                      }
                                  },
                                  close: function (event, ui) {
                                      $(this).remove();
                                  }
                              });
          };
      });
</script>
<script type="text/javascript">
    $(document).on("click", ".kajol_close, .cancel", function(){
        $("#verifyPasswordModal").hide();
    });
</script>
</body>
</html>