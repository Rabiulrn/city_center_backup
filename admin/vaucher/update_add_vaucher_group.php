<?php 
session_start();
if(!isset($_SESSION['username']) ){    
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';

$db = new Database();

$sucMsg = '';
if(isset($_POST['update']))
{  
  $postDateArr        = explode('/', $_POST['group_date']);      
  $group_date        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

  $group_name = $_POST['group_name'];
  $group_description = $_POST['group_description'];
  $taka = $_POST['taka'];
  $pices = $_POST['pices'];
  $total_taka = $_POST['total_taka'];
  // $total_bill = $_POST['total_bill'];
  $pay = $_POST['pay'];
  $due = $_POST['due'];
  $edit_id = $_GET['edite_id'];
  // $query = "UPDATE debit_group SET group_date = '$group_date', group_name = '$group_name', group_description = '$group_description', taka ='$taka', pices = '$pices', total_taka = '$total_taka', total_bill= '$total_bill', pay = '$pay', due = '$due' WHERE id = '$edit_id'";
  $query = "UPDATE debit_group SET group_date = '$group_date', group_name = '$group_name', group_description = '$group_description', taka ='$taka', pices = '$pices', total_taka = '$total_taka', pay = '$pay', due = '$due' WHERE id = '$edit_id'";
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
<html>
<head>
  <title>Update vaucher group</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <!-- minus calculation -->
  <script type="text/javascript">
    //any time the amount changes
    $(document).ready(function() {
        $('input[name=total_debit_amount],input[name=debit_pay]').change(function(e) {
            var total = 0;
            var $row = $(this).parent();
            var rate = $row.find('input[name=total_debit_amount]').val();
            var pack = $row.find('input[name=debit_pay]').val();
            total = parseFloat(rate - pack);
            //update the row total
            $row.find('.amount').text(total);

            var total_amounts = 0;
            $('.amount').each(function() {
                //Get the value
                var am= $(this).text();
                console.log(am);
                //if it's a number add it to the total
                if (IsNumeric(am)) {
                    total_amounts += parseFloat(am, 10);
                }
            });
            $('.total_amount').text(total_amounts);
        });
    });

    //isNumeric function Stolen from: 
    //http://stackoverflow.com/questions/18082/validate-numbers-in-javascript-isnumeric

    function IsNumeric(input) {
        return (input - 0) == input && input.length > 0;
    }
  </script>
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
      $ph_id = $_SESSION['project_name_id'];
      $query = "SELECT * FROM project_heading WHERE id = $ph_id";
      $show = $db->select($query);
      if ($show) 
      {
        while ($rows = $show->fetch_assoc()) 
        {
    ?>
      <div class="project_heading text-center">      
        <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
        <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
      </div>
    <?php 
          }
        } 
    ?>
      
      
        <table class="table table-bordered table-condensed" id="dynamic_field">
          <thead>
            <tr>
              <th class="text-center" width="110px">তারিখ</th>
              <th class="text-center">মারফোত নামঃ</th>
              <th class="text-center">বিবরণ নামঃ</th>
              <th class="text-center">দর</th>
              <th class="text-center">জন</th>
              <th class="text-center">মোট টাকাঃ-</th>
              <!-- <th class="text-center">নগদ পরি‌ষদ</th> -->
              <th class="text-center">জমা</th>
              <th class="text-center">জের</th>
            </tr>
          </thead>
          <form action="" method="POST" onsubmit="return validation()">
<?php  
$edit = $_GET['edite_id'];
$query = "SELECT * FROM debit_group WHERE id = $edit";
$show = $db->select($query);
while($data = $show->fetch_assoc())
{
?>
          <tbody>
            <tr>
              <td><input type="text" name="group_date" class="form-control" id="group_date" placeholder="dd/mm/yyyy" value = "<?php if( $data['group_date'] == '0000-00-00'){} else {echo date("d/m/Y", strtotime($data['group_date']));} ?>"/></td>
              <td><input type="text" name="group_name" class="form-control" size="100" value="<?php echo $data['group_name']; ?>" id="group_name"/></td>
              <td><input type="text" name="group_description" class="form-control" size="100" value="<?php echo $data['group_description']; ?>" id="group_description"/></td>
              <td><input type="text" name="taka" class="form-control" size="40" value="<?php echo $data['taka']; ?>" id="taka"/></td>
              <td><input type="text" name="pices" class="form-control" size="40" value="<?php echo $data['pices']; ?>" id="pices"/></td>
              <td><input type="text" name="total_taka" class="form-control" value="<?php echo $data['total_taka']; ?>" id="total_taka"/></td>
              <!-- <td><input type="text" name="total_bill" class="form-control" value="<?php //echo $data['total_bill']; ?>" id="total_bill"/></td> -->
              <td><input type="text" name="pay" class="form-control" value="<?php echo $data['pay']; ?>" id="pay"/></td>
              <td><input type="text" name="due" class="form-control" value="<?php echo $data['due']; ?>" id="due"/></td>
            </tr>
          </tbody>
<?php } ?>
        </table>
        <div class="form-group">
          <input type="submit" class="form-control btn btn-primary" name="update" value="Update">
        </div>
        <div class="form-group">
          <h3 class="text-center text-success" id="sucMsg"><?php echo $sucMsg; ?></h3>
        </div>
        <div>
            <input type="button" class="btn btn-danger" onclick="cancel()" value="Cancel" style="float: right;">
        </div>
      </form>   
    </div>
    <script type="text/javascript">
        // function validation(){
        //     var validReturn = false;

        //     var group_name        = $('#group_name').val();
        //     var group_description = $('#group_description').val();
        //     var taka              = $('#taka').val();
        //     var pices             = $('#pices').val();
        //     var total_taka        = $('#total_taka').val();
        //     var total_bill        = $('#total_bill').val();
        //     var pay               = $('#pay').val();
        //     var due               = $('#due').val();



        //     if(group_name == ""){
        //         alert("মারফোত নাম ফাঁকা হবে না !");
        //         $('#group_name').focus();
        //         validReturn = false;
        //     } else if($.isNumeric(group_name)){
        //         alert("মারফোত নাম সংখ্যা হবে না !");
        //         $('#group_name').focus();
        //         validReturn = false;
        //     } else if(group_name.length > 40){
        //         alert("মারফোত নাম ৪০ অক্ষরের বেশী হবে না !");
        //         $('#group_name').focus();
        //         validReturn = false;
        //     } else {
        //         if(group_description == ""){
        //             alert("বিবরণ নাম ফাঁকা হবে না !");
        //             $('#group_description').focus();
        //             validReturn = false;
        //         } else if($.isNumeric(group_description)){
        //             alert("বিবরণ নাম সংখ্যা হবে না !");
        //             $('#group_description').focus();
        //             validReturn = false;
        //         } else if(group_name.length > 40){
        //           alert("বিবরণ নাম ৪০ অক্ষরের বেশী হবে না !");
        //           $('#group_description').focus();
        //           validReturn = false;
        //         } else{
        //             if(taka == ""){
        //                 alert("দর ফাঁকা হবে না !");
        //                 $('#taka').focus();
        //                 validReturn = false;
        //             } else if($.isNumeric(taka)){
        //                 alert("দর সংখ্যা হবে না !");
        //                 $('#taka').focus();
        //                 validReturn = false;
        //             } else if(taka.length > 15){
        //               alert("দর ১৫ অক্ষরের বেশী হবে না !");
        //               $('#taka').focus();
        //               validReturn = false;
        //             } else{
        //                 if(pices == ""){
        //                     alert("জন ফাঁকা হবে না !");
        //                     $('#pices').focus();
        //                     validReturn = false;
        //                 } else if($.isNumeric(pices)){
        //                     alert("জন সংখ্যা হবে না !");
        //                     $('#pices').focus();
        //                     validReturn = false;
        //                 } else if(pices.length > 15){
        //                   alert("জন ১৫ অক্ষরের বেশী হবে না !");
        //                   $('#pices').focus();
        //                   validReturn = false;
        //                 } else{
        //                       if(total_taka == ""){
        //                           alert("মোট টাকাঃ ফাঁকা হবে না !");
        //                           $('#total_taka').focus();
        //                           validReturn = false;
        //                       } else if($.isNumeric(total_taka)){
        //                           alert("মোট টাকাঃ সংখ্যা হবে না !");
        //                           $('#total_taka').focus();
        //                           validReturn = false;
        //                       } else if(total_taka.length > 15){
        //                         alert("মোট টাকাঃ ১৫ অক্ষরের বেশী হবে না !");
        //                         $('#total_taka').focus();
        //                         validReturn = false;
        //                       } else{
        //                             if(total_bill == ""){
        //                                 alert("নগদ পরি‌ষদ ফাঁকা হবে না !");
        //                                 $('#total_bill').focus();
        //                                 validReturn = false;
        //                             } else if($.isNumeric(total_bill)){
        //                                 alert("নগদ পরি‌ষদ সংখ্যা হবে না !");
        //                                 $('#total_bill').focus();
        //                                 validReturn = false;
        //                             } else if(total_bill.length > 15){
        //                               alert("নগদ পরি‌ষদ ১৫ অক্ষরের বেশী হবে না !");
        //                               $('#total_bill').focus();
        //                               validReturn = false;
        //                             } else{
        //                                 if(pay == ""){
        //                                     alert("জমা ফাঁকা হবে না !");
        //                                     $('#pay').focus();
        //                                     validReturn = false;
        //                                 } else if($.isNumeric(pay)){
        //                                     alert("জমা সংখ্যা হবে না !");
        //                                     $('#pay').focus();
        //                                     validReturn = false;
        //                                 } else if(pay.length > 15){
        //                                   alert("জমা ১৫ অক্ষরের বেশী হবে না !");
        //                                   $('#pay').focus();
        //                                   validReturn = false;
        //                                 } else{
        //                                       if(due == ""){
        //                                           alert("জের ফাঁকা হবে না !");
        //                                           $('#due').focus();
        //                                           validReturn = false;
        //                                       } else if($.isNumeric(due)){
        //                                           alert("জের সংখ্যা হবে না !");
        //                                           $('#due').focus();
        //                                           validReturn = false;
        //                                       } else if(due.length > 15){
        //                                           alert("জের ১৫ অক্ষরের বেশী হবে না !");
        //                                           $('#due').focus();
        //                                           validReturn = false;
        //                                       } else{
        //                                           validReturn = true;
        //                                       }
        //                                 }
        //                             }
        //                       }
        //                 }
        //             }
        //         }
        //     }

        //     if(validReturn){
        //       return true;
        //     } else {
        //       return false;
        //     }
        // }

      var sucMsg = $('#sucMsg').html();
      var url = window.location.href;
      var getIdText = url.split("?").pop();
      var idNo = getIdText.match(/\d+/)[0];
      // alert(idNo);
      if(sucMsg == 'Data Updated Successfully!'){
        function sample(){
          window.location.href = 'add_single_group_data.php?add_id='+ idNo;
        }
        setTimeout(sample, 1000);
      }
      function cancel(){
        window.location.href = 'add_single_group_data.php?add_id='+ idNo;
      }
    </script>
    <script type="text/javascript" id="script-1">
      $(function() {
        $('#group_date').datepicker( {
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd/mm/yy",
            changeYear: true,
        });
      });

    </script>

</body>
</html>