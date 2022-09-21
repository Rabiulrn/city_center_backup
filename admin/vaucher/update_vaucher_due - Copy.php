<?php 
  session_start();
  require '../config/config.php';
  require '../lib/database.php';

  $db = new Database();
  $sucMsg ='';
  $project_name_id = $_SESSION['project_name_id'];

  //update
  if(isset($_GET['edite_id'])){
      $edit_id = $_GET['edite_id'];

      if(isset($_POST['update'])) {
          $due_credit_amount = $_POST['due_credit_amount'];
          $due_debit_amount = $_POST['due_debit_amount'];

          $postDateArr = explode('/',$_POST['due_date']);
          $due_date    = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

          if($due_credit_amount == ''){
            $due_credit_amount = 0;
          }
          if($due_debit_amount == ''){
            $due_debit_amount = 0;
          }

          $query = "UPDATE due SET due_credit_amount='$due_credit_amount', due_debit_amount='$due_debit_amount', due_debit_date = '$due_date' WHERE id = '$edit_id' AND project_name_id = '$project_name_id'";
          $update = $db->update($query);
          if ($update) {
            // echo "<script>alert('Data Updated Successfully!');</script>";
            $sucMsg = 'Data Updated Successfully!';
            // echo "<script>window.location.href = 'modify_vaucher.php'</script>";
          } else {
            $sucMsg = 'Failed to Update Data!';
          }
      }
  }

  //Insert and update
  if(isset($_POST['inertUpdateBtn'])){
      $submitVal = $_POST['inertUpdateBtn'];
      $edit_row_id = $_POST['row_id'];
      $due_credit_amount = $_POST['due_credit_amount'];
      $due_debit_amount = $_POST['due_debit_amount'];
      $postDateArr = explode('/', $_POST['due_date']);
      $due_date    = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

      if($due_credit_amount == ''){
        $due_credit_amount = 0;
      }
      if($due_debit_amount == ''){
        $due_debit_amount = 0;
      }
      
      if($submitVal == 'Save'){
          $isExitDate_sql = "SELECT due_debit_date FROM due WHERE due_debit_date = '$due_date' AND project_name_id = '$project_name_id'";
          $hasDate = $db->select($isExitDate_sql);
          if(mysqli_num_rows($hasDate) == 0){
              $query ="INSERT INTO due (due_credit_amount, due_debit_amount, due_debit_date, project_name_id) VALUES ('$due_credit_amount', '$due_debit_amount', '$due_date', '$project_name_id')";
              $result = $db->select($query);
              if($result){
                $sucMsg = 'New Data Inserted Successfully!';
              } else {
                $sucMsg = 'Data is not Inserted';
              }
          } else {
              $sucMsg = 'Data already inserted at this day. Please update that data.';
          }
      } else {
            $query = "UPDATE due SET due_credit_amount='$due_credit_amount', due_debit_amount='$due_debit_amount', due_debit_date = '$due_date' WHERE id = ' $edit_row_id' AND project_name_id = '$project_name_id'";
            $update = $db->update($query);
            if ($update) {
              $sucMsg = 'Data Updated Successfully!';
            } else {
              $sucMsg = 'Failed to Update Data!';
            }
      }
  }

  if(isset($_GET['detele_id'])){
      $detele_id = $_GET['detele_id'];

      $sql = "DELETE FROM due WHERE id = '$detele_id'";
      if ($db->select($sql) === TRUE) {
        $sucMsg = "Jer/paona delete successfully.";
      } else {
        $sucMsg = "Jer/paona is not delete.";
        echo "Error: " . $sql . "<br>" .$db->error;
      }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Vaucher Due</title>
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
    .backcircle{
        font-size: 18px;
        position: absolute;
        margin-top: -30px;
    }
    .backcircle a:hover{
        text-decoration: none !important;
    }
    .updateBtn{
      width: 150px;
      float: right;
    }
    .view{
      vertical-align: middle !important;
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
      $ph_id = $_SESSION['project_name_id'];
      $query = "SELECT * FROM project_heading WHERE id = $ph_id";
      $show = $db->select($query);
      if ($show){
          while ($rows = $show->fetch_assoc()){
          ?>
            <div class="project_heading text-center">      
              <h2 class="text-center" style="font-size: 25px;"><?php echo $rows['heading']; ?></h2>
              <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
            </div>
          <?php 
          }
      } 
    ?>
    <div class="backcircle">
      <a href="../vaucher/modify_vaucher.php">
        <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
      </a>
    </div>
    <?php
        if(isset($edit_id)){
            ?>
            <form action="" method="POST" onsubmit="return validation()">
                <table class="table table-bordered table-condensed" id="dynamic_field">        
                  <?php
                    $query = "SELECT * FROM due WHERE id = '$edit_id'";
                    $show = $db->select($query);
                    while($data = $show->fetch_assoc()){
                      $due_credit_amount = $data['due_credit_amount'];
                      $due_debit_amount = $data['due_debit_amount'];
                      $due_date = $data['due_debit_date'];
                      // echo '<script>alert('.$due_date.')</script>';
                      if($due_date == '0000-00-00'){
                        $due_date = date("d/m/Y");
                      } else {
                        $due_date = date("d/m/Y", strtotime($due_date));
                      }
                      ?>
                        <tr>
                          <td class="text-center" style="width: 140px;">তারিখ</td>
                          <td class="text-center" >পূর্বের জে‌রঃ</td>
                          <td class="text-center" >পূর্বের পাওনাঃ</td>
                        </tr>
                        <tr>
                          <td>
                            <input type="text" name="due_date" class="form-control" placeholder="dd/mm/yy" id="due_date" value="<?php echo $due_date; ?>">
                          </td>
                          <td>
                            <input type="text" name="due_credit_amount" class="form-control" value="<?php echo $due_credit_amount; ?>" id="credit" placeholder="পূর্বের জে‌র সংখ্যায়..."/>
                          </td>
                          <td>
                            <input type="text" name="due_debit_amount" class="form-control" value="<?php echo $due_debit_amount; ?>" id="debit" placeholder="পূর্বের পাওনা সংখ্যায়..."/>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </table>
                <div class="form-group" style="height: 35px;">
                  <input type="submit" class="form-control btn btn-primary updateBtn" name="update" value="Update">
                  <h4 class="text-center text-success" id="sucMsg" style="margin-left: 150px;"><?php echo $sucMsg; ?></h4>
                </div>
            </form>
            <br><br><br>
            <?php
        } else {
            ?>
            <form action="" method="POST" onsubmit="">
                <h4 class="text-center">পূ্র্বের জের / পাওনা সংযোজন</h4>
                <table class="table table-bordered table-condensed" id="dynamic_field">
                  <tr>
                    <td class="text-center" style="width: 140px;">তারিখ</td>
                    <td class="text-center" >পূর্বের জে‌রঃ</td>
                    <td class="text-center" >পূর্বের পাওনাঃ</td>
                  </tr>
                  <tr>
                    <td>
                      <input type="text" name="due_date" class="form-control" placeholder="dd/mm/yy" id="due_date_new" value="">
                    </td>
                    <td>
                      <input type="text" name="due_credit_amount" class="form-control" value="" id="credit_new" placeholder="পূর্বের জে‌র সংখ্যায়..." />
                    </td>
                    <td>
                      <input type="text" name="due_debit_amount" class="form-control" value="" id="debit_new" placeholder="পূর্বের পাওনা সংখ্যায়..." />
                    </td>
                  </tr>
                </table>
                <div class="form-group" style="height: 35px;">
                  <input type="submit" class="form-control btn btn-primary updateBtn" name="inertUpdateBtn" value="Save" id="inertUpdateBtn">
                  <input type="hidden" name="row_id" value="0" id="row_id">
                  <h4 class="text-center text-success" id="sucMsg" style="margin-left: 150px;"><?php echo $sucMsg; ?></h4>
                </div>
            </form>
            <br><br><br>
            <?php
        }
    ?>
    
    <div style="margin-bottom: 100px;">
      <form>
        <h4 class="text-center">পূ্র্বের জের / পাওনার হিসাব</h4>
        <table class="table table-bordered">
          <tr class="bg-primary">
            <td class="text-center" style="width: 140px;">তারিখ</td>
            <td class="text-center" >পূর্বের জে‌রঃ</td>
            <td class="text-center" >পূর্বের পাওনাঃ</td>
            <td class="text-center" style="width: 110px;">Delete</td>
            <td class="text-center" style="width: 110px;">Edit</td>
          </tr>
          <?php
            $due_sql = "SELECT * FROM due WHERE project_name_id = '$project_name_id' ORDER BY due_debit_date ASC";
            $due = $db->select($due_sql);
            if($due){
              
              while($due_data = $due->fetch_assoc()){
                $row_id = $due_data['id'];
                $credit_amount = $due_data['due_credit_amount'];
                $debit_amount = $due_data['due_debit_amount'];
                $date = $due_data['due_debit_date'];
                if($date == '0000-00-00'){
                  $date = '';
                } else {
                  $date = date('d/m/Y', strtotime($date));
                }
                echo '<tr>';
                echo '<td class="view">'.$date.'</td>';
                echo '<td class="view">'.$credit_amount.'</td>';
                echo '<td class="view">'.$debit_amount.'</td>';              
                echo '<td class="text-center"><input type="button" value="Delete" class="btn btn-danger delete_due" detele_id="' . $row_id . '"></td>';              
                echo '<td class="text-center"><input type="button" value="Edit" class="btn btn-success" edit_id="' . $row_id . '" onclick="displayupdate(this)"></td>';
                echo '</tr>';            
              }
              
            }
          ?>
        </table>
      </form>
      <a href="../vaucher/update_vaucher_due.php" class="btn btn-primary" style="float: right; width: 220px;">Add New Jer/Paona</a>
    </div>
  </div>
  <script type="text/javascript">
   // function validation(){
   //        validReturn = false;

   //        var credit   = $('#credit').val();
   //        var debit = $('#debit').val();
   //        // alert(credit +" | "+ debit);
   //        if(credit == ""){
   //            alert("পূবর্ের জের ফঁকা হবে না ! মান না থাকলে ০ বসান ।");
   //            $('#credit').focus();
   //            validReturn = false;
   //        } else if(!$.isNumeric(credit)){
   //            alert("পূরব‌ের জের অবশ্যই সংখ্যা হতে হবে ?");
   //            $('#credit').focus();
   //            validReturn = false;
   //        } else {
   //          if(debit == ""){
   //                alert("পূরব‌ের পাওনা ফাঁকা হবে না ! মান না থাকলে ০ বসান ।");
   //                $('#debit').focus();
   //                validReturn = false;
   //            } else if(!$.isNumeric(debit)){
   //                alert("পূরব‌ের পাওনা অবশ্যই সংখ্যা হতে হবে ?");
   //                $('#debit').focus();
   //                validReturn = false;
   //            } else {
   //              validReturn = true;
   //            }
   //        }

   //        if(validReturn){
   //            return true;
   //        }else{
   //            return false;
   //        }
   //    }
  </script>
  <script type="text/javascript">
    // if($('#sucMsg').html() === 'Data Updated Successfully!'){
    //     var delay = 1500;
    //     setTimeout(function() {
    //         window.location.href = 'modify_vaucher.php';
    //     }, delay);        
    //   } else{}
  </script>
  <script type="text/javascript" id="script-1">
        $('#due_date').datepicker( {
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd/mm/yy",
            changeYear: true,
        });
        $('#due_date_new').datepicker( {
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd/mm/yy",
            changeYear: true,
        }).datepicker("setDate", new Date());
  </script>
  <script type="text/javascript">    
        $(document).on('click', '.delete_due', function(event){
            event.preventDefault();
            var detele_id = $(event.target).attr('detele_id');
            console.log(detele_id);
            ConfirmDialog('Are you sure delete jer/paona info?');
            function ConfirmDialog(message){
                $('<div></div>').appendTo('body')
                                .html('<div><h4>'+message+'</h4></div>')
                                .dialog({
                                    modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                    width: '40%', resizable: false,
                                    position: { my: "center", at: "center center-20%", of: window },
                                    buttons: {
                                        Yes: function () {
                                            $(this).dialog("close");
                                            $.get("update_vaucher_due.php?detele_id="+detele_id, function(data, status){
                                              console.log(status);
                                              if(status == 'success'){
                                                window.location.href = 'update_vaucher_due.php';
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
    </script>
    <script type="text/javascript">
        function displayupdate(element){
            var td_date     = $(element).closest('tr').find('td:eq(0)').text();
            var td_jer   = $(element).closest('tr').find('td:eq(1)').text();
            var td_paona   = $(element).closest('tr').find('td:eq(2)').text();
            var attr_row_id = $(element).attr('edit_id');
            // alert(row_id);

            $('#due_date_new').val(td_date);
            $('#credit_new').val(td_jer);
            $('#debit_new').val(td_paona);
            $('#row_id').val(attr_row_id);
            $('#inertUpdateBtn').val('Update');
            $('#sucMsg').html('');
            $('html').animate({ scrollTop: 0 }, 'slow');
        }
    </script>
</body>
</html>
