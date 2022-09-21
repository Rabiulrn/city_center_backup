<?php 
    session_start();
    if(!isset($_SESSION['username']) ){    
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
    $edit_id = $_GET['edit_id'];
    $group_id = $_GET['dataset_id'];


    $sucMsg = '';
    if(isset($_POST['update'])) {
        $postDateArr        = explode('/', $_POST['entry_date']);      
        $entry_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

        $group_name = $_POST['group_name'];
        $group_description = $_POST['group_description'];
        $group_taka = $_POST['group_taka'];
        $group_pices = $_POST['group_pices'];
        $group_total_taka = $_POST['group_total_taka'];
        // $group_total_bill = $_POST['group_total_bill'];
        $group_pay = $_POST['group_pay'];
        $group_due = $_POST['group_due'];
        // $query = "UPDATE debit_group_data SET entry_date ='$entry_date', group_name='$group_name', group_description='$group_description', group_taka='$group_taka', group_pices='$group_pices', group_total_taka='$group_total_taka', group_total_bill='$group_total_bill', group_pay='$group_pay', group_due='$group_due' WHERE id = $edit_id";
        $query = "UPDATE debit_group_data SET entry_date ='$entry_date', group_name='$group_name', group_description='$group_description', group_taka='$group_taka', group_pices='$group_pices', group_total_taka='$group_total_taka', group_pay='$group_pay', group_due='$group_due' WHERE id = $edit_id";
        $update = $db->update($query);
        if ($update) {
            // echo "<script>alert('Data Updated Successfully!');</script>";
            // echo "<script>window.location.href = 'modify_vaucher.php'</script>";
            $sucMsg = 'Data Updated Successfully!';
        } else {
            // echo "<script>alert('Failed to Update Data!');</script>";
            $sucMsg = 'Failed to Update Data!';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update single group data</title>
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
    .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
      border: 1px solid #ddd !important;
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
          $query = "SELECT * FROM project_heading WHERE id = $project_name_id";
          $show = $db->select($query);
          if ($show) {
              while ($rows = $show->fetch_assoc()) {
              ?>
                <div class="project_heading text-center">      
                    <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
                    <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
                </div>
                <?php 
              }
          } 
      ?>
      <form action="" method="POST" onsubmit="return validation()">
          <table class="table table-bordered table-condensed" id="dynamic_field">
              <thead>
                  <tr>
                  <?php
                      $group_sql = "SELECT * FROM debit_group WHERE id = '$group_id' AND project_name_id = '$project_name_id'";
                      $group = $db->select($group_sql);
                      while($gdata = $group->fetch_assoc()) {
                          echo '<th class="text-center" width="110px">তারিখঃ</th>';
                          echo '<th class="text-center">'.$gdata['group_name'].'</th>';
                          echo '<th class="text-center">'.$gdata['group_description'].'</th>';
                          echo '<th class="text-center">'.$gdata['taka'].'</th>';
                          echo '<th class="text-center">'.$gdata['pices'].'</th>';
                          echo '<th class="text-center">'.$gdata['total_taka'].'</th>';
                          // echo '<th class="text-center">'.$gdata['total_bill'].'</th>';
                          echo '<th class="text-center">'.$gdata['pay'].'</th>';
                          echo '<th class="text-center">'.$gdata['due'].'</th>';
                      }
                  ?>
                  
                      
                      <!-- মারফোত নামঃ
                      <th class="text-center">বিবরণ নামঃ</th>
                      <th class="text-center">দর</th>
                      <th class="text-center">জন</th>
                      <th class="text-center">মোট টাকাঃ</th>
                      <th class="text-center">নগদ পরি‌ষদ</th>
                      <th class="text-center">জমা</th>
                      <th class="text-center">জের</th> -->
                  </tr>
              </thead>
              <?php
                  $query = "SELECT * FROM debit_group_data WHERE id = '$edit_id' AND project_name_id = '$project_name_id'";
                  $show = $db->select($query);
                  while($data = $show->fetch_assoc()) {
                    ?>
                      <tbody>
                        <tr>
                          <td><input type="text" name="entry_date" class="form-control" id="entry_date" placeholder="dd/mm/yyyy" value = "<?php if( $data['entry_date'] == '0000-00-00'){} else {echo date("d/m/Y", strtotime($data['entry_date']));} ?>"/></td>
                          <td><input type="text" name="group_name" class="form-control" size="100" value="<?php echo $data['group_name']; ?>" id="group_name"/></td>
                          <td><input type="text" name="group_description" class="form-control" size="100" value="<?php echo $data['group_description']; ?>" id="group_description"/></td>
                          <td><input type="text" name="group_taka" class="form-control calc1" size="40" value="<?php echo $data['group_taka']; ?>" id="group_taka"/></td>
                          <td><input type="text" name="group_pices" class="form-control calc1" size="40" value="<?php echo $data['group_pices']; ?>" id="group_pices"/></td>
                          <td><input type="text" name="group_total_taka" class="form-control" value="<?php echo $data['group_total_taka']; ?>" id="group_total_taka"/></td>
                          <!-- <td><input type="text" name="group_total_bill" class="form-control" value="<?php //echo $data['group_total_bill']; ?>" id="group_total_bill"/></td> -->
                          <td><input type="text" name="group_pay" class="form-control payCalc1" value="<?php echo $data['group_pay']; ?>" id="group_pay"/></td>
                          <td><input type="text" name="group_due" class="form-control" value="<?php echo $data['group_due']; ?>" id="group_due"/></td>
                        </tr>
                      </tbody>
                    <?php 
                    } 
                  ?>
          </table>
          <div class="form-group">
              <input type="submit" class="form-control btn btn-primary" name="update" value="Update">
          </div>
          <div class="form-group">
              <h3 class="text-center text-success" id='sucMsg'><?php echo $sucMsg; ?></h3>
          </div>
          <div>
              <input type="button" class="btn btn-danger" onclick="cancel()" value="Cancel" style="float: right;">
          </div>
    </form>
  </div>

  <script type="text/javascript">
      // function validation(){
      //   var validReturn = false;

      //   var group_name        = $('#group_name').val();
      //   var group_description = $('#group_description').val();
      //   var group_taka        = $('#group_taka').val();
      //   var group_pices       = $('#group_pices').val();
      //   var group_total_taka  = $('#group_total_taka').val();
      //   var group_total_bill  = $('#group_total_bill').val();
      //   var group_pay         = $('#group_pay').val();
      //   var group_due         = $('#group_due').val();


      //   if(group_name == ""){
      //           alert("মারফোত নাম ফাঁকা হবে না !");
      //           $('#group_name').focus();
      //           validReturn = false;
      //       } else if($.isNumeric(group_name)){
      //           alert("মারফোত নাম সংখ্যা হবে না !");
      //           $('#group_name').focus();
      //           validReturn = false;
      //       } else if(group_name.length > 40){
      //           alert("মারফোত নাম ৪০ অক্ষরের বেশী হবে না !");
      //           $('#group_name').focus();
      //           validReturn = false;
      //       } else {
      //           if(group_description == ""){
      //               alert("বিবরণ নাম ফাঁকা হবে না !");
      //               $('#group_description').focus();
      //               validReturn = false;
      //           } else if($.isNumeric(group_description)){
      //               alert("বিবরণ নাম সংখ্যা হবে না !");
      //               $('#group_description').focus();
      //               validReturn = false;
      //           } else if(group_name.length > 40){
      //             alert("বিবরণ নাম ৪০ অক্ষরের বেশী হবে না !");
      //             $('#group_description').focus();
      //             validReturn = false;
      //           } else{
      //               if(group_taka == ""){
      //                   alert("দর ফাঁকা হবে না !");
      //                   $('#group_taka').focus();
      //                   validReturn = false;
      //               } else if(!$.isNumeric(group_taka)){
      //                   alert("দর সংখ্যা হতে হবে !");
      //                   $('#group_taka').focus();
      //                   validReturn = false;
      //               } else{
      //                   if(group_pices == ""){
      //                       alert("জন ফাঁকা হবে না !");
      //                       $('#group_pices').focus();
      //                       validReturn = false;
      //                   } else if(!$.isNumeric(group_pices)){
      //                       alert("জন সংখ্যা হতে হবে !");
      //                       $('#group_pices').focus();
      //                       validReturn = false;
      //                   } else{
      //                         if(group_total_taka == ""){
      //                             alert("মোট টাকাঃ ফাঁকা হবে না !");
      //                             $('#group_total_taka').focus();
      //                             validReturn = false;
      //                         } else if(!$.isNumeric(group_total_taka)){
      //                             alert("মোট টাকাঃ সংখ্যা হতে হবে !");
      //                             $('#group_total_taka').focus();
      //                             validReturn = false;
      //                         } else{
      //                               validReturn = true;
      //                               // if(group_total_bill == ""){
      //                               //     alert("নগদ পরি‌ষদ ফাঁকা হবে না !");
      //                               //     $('#group_total_bill').focus();
      //                               //     validReturn = false;
      //                               // } else if(!$.isNumeric(group_total_bill)){
      //                               //     alert("নগদ পরি‌ষদ সংখ্যা হতে হবে !");
      //                               //     $('#group_total_bill').focus();
      //                               //     validReturn = false;
      //                               // } else if(group_total_bill.length > 15){
      //                               //   alert("নগদ পরি‌ষদ ১৫ অক্ষরের বেশী হবে না !");
      //                               //   $('#group_total_bill').focus();
      //                               //   validReturn = false;
      //                               // } else{
      //                               //     if(group_pay == ""){
      //                               //         alert("জমা ফাঁকা হবে না !");
      //                               //         $('#group_pay').focus();
      //                               //         validReturn = false;
      //                               //     } else if(!$.isNumeric(group_pay)){
      //                               //         alert("জমা সংখ্যা হতে হবে !");
      //                               //         $('#group_pay').focus();
      //                               //         validReturn = false;
      //                               //     } else{
      //                               //           if(group_due == ""){
      //                               //               alert("জের ফাঁকা হবে না !");
      //                               //               $('#group_due').focus();
      //                               //               validReturn = false;
      //                               //           } else if(!$.isNumeric(group_due)){
      //                               //               alert("জের সংখ্যা হতে হবে!");
      //                               //               $('#group_due').focus();
      //                               //               validReturn = false;
      //                               //           } else{
      //                               //               validReturn = true;
      //                               //           }
      //                               //     }
      //                               // }
                              
      //                         }
      //                   }
      //               }
      //           }
      //       }



      //   if(validReturn){
      //     return true;
      //   } else {
      //     return false;
      //   }
      // }



    var sucMsg = $('#sucMsg').html();
    var url = window.location.href;
    var getIdText = url.split("?").pop();
    // var idNo = getIdText.match(/\d+/)[0];
    var lastNum = getIdText.replace(/.*?(\d+)[^\d]*$/,'$1')
    // alert(lastNum);
    

    if(sucMsg == ''){
    } else if(sucMsg == 'Data Updated Successfully!'){
      // alert('Data Updated Successfully!');
      function sample(){
        window.location.href = 'add_single_group_data.php?add_id='+ lastNum;
      }
      setTimeout(sample, 1000);      
    } else{
      alert('Data Updated Failed!');
    }

    function cancel(){
        window.location.href = 'add_single_group_data.php?add_id='+ lastNum;
    }
    
  </script>
  <script type="text/javascript" id="script-1">
      $(function() {
        $('#entry_date').datepicker( {
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd/mm/yy",
            changeYear: true,
        });
      });
  </script>
  <script type="text/javascript" id="calculation-1">
        $(document).on('input', '.calc1', function(){
            var taka = $('#group_taka').val();
            var pices = $('#group_pices').val();
            // var pay = $('#pay1').val();
            // alert(pices);
            if(taka !== '' && pices !==''){
                var total_taka = taka * pices;
                $('#group_total_taka').val(total_taka);
                $('#group_pay').val(0);
                $('#group_due').val(total_taka);
            } else  {
                $('#group_total_taka').val(0);
                $('#group_pay').val(0);
                $('#group_due').val(0);
            }
        });
        $(document).on('input', '.payCalc1', function(){
            var total_taka = $('#group_total_taka').val();
            var pay = $('#group_pay').val();
            if(total_taka !== '' && pay !==''){
                var due = total_taka - pay;
                $('#group_due').val(due);
            }
        });
    </script>
</body>
</html>
