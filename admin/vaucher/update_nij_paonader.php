<?php 
session_start();
if(!isset($_SESSION['username']) ){    
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';

$db = new Database();
$sucMsg = '';
$project_name_id = $_SESSION['project_name_id'];
$edit_id = $_GET['edit_id'];



if(isset($_POST['update'])) {
    $postDateArr  = explode('/', $_POST['nij_paona_date']);
    $dates        = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $amount = trim($_POST['amount']);

    $query = "UPDATE nij_paonadar SET name='$name', description='$description', amount = '$amount', nij_paona_date = '$dates' WHERE id = '$edit_id' AND project_name_id = '$project_name_id'";
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
  <title>Update nij paonader</title>
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
        border-bottom: 1px solid #ddd;
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd !important;
    }
    .cancelBtn{
      float: right;
    }
    .headingOfAllProject {
        margin: 16px 0px 10px;
        min-height: 32px;
        padding-bottom: 8px;
        /*border-bottom: 1px solid #A54686 !important;*/
        font-size: 25px;
        line-height: 20px;
        text-align: center;
    }
    .headingOfAllProject:before {
       content: none;
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
            if ($show) {
              while ($rows = $show->fetch_assoc()) {
        ?>
                  <div class="project_heading text-center">      
                    <h2 class="headingOfAllProject"><?php echo $rows['heading']; ?></h2>
                    <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
                  </div>
        <?php 
              }
            } 
        ?>
        <form action="#" method="POST" onsubmit="return validation()">
            <table class="table table-bordered table-condensed" id="dynamic_field">
                <thead>
                  <tr>
                    <th class="text-center" width="120px">তারিখ</th>
                    <th class="text-center">যার কাছে পাবো তার নাম</th>
                    <th class="text-center">বিবরণ</th>
                    <th class="text-center" width="200px">টাকা</th>
                  </tr>
                </thead>
                <?php  
                    
                    $query = "SELECT * FROM nij_paonadar WHERE id = '$edit_id' AND project_name_id = '$project_name_id'";
                    $show = $db->select($query);
                    while($data = $show->fetch_assoc())
                    {
                ?>
                        <tbody>
                          <tr>
                            <td><input type="text", name="nij_paona_date" class="form-control text-center" value="<?php if($data['nij_paona_date'] !== '0000-00-00'){echo date("d/m/Y", strtotime($data['nij_paona_date']));} ?>" id="nij_paona_date"/></td>
                            <td><input type="text", name="name" class="form-control" size="100" value="<?php echo $data['name']; ?>" id="name"/></td>
                            <td><input type="text", name="description" class="form-control" size="100" value="<?php echo $data['description']; ?>" id="description"/></td>
                            <td><input type="text", name="amount" class="form-control" size="100" value="<?php echo $data['amount']; ?>" id="amount"/></td>                            
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
              <h3 id="updateMsg" class="text-center text-success"><?php echo $sucMsg; ?></h3>
              <input type="button" name="" class="btn btn-danger cancelBtn" value="Cancel" onclick="page_redirect()">
            </div>
        </form>
  </div>
  <script type="text/javascript">
      // function validation(){
      //     validReturn = false;

      //     var mName   = $('#mName').val();
      //     var mAmount = $('#mAmount').val();
      //     // alert(mName +"  "+ mAmount);
      //     if(mName == ""){
      //         alert("মারফোত নাম ফাঁকা হবে না !");
      //         $('#mName').focus();
      //         validReturn = false;
      //     } else if(mName.length > 100){
      //         alert("মারফোত নাম ১০০ অক্ষরের বেশী হবে না !");
      //         $('#mName').focus();
      //         validReturn = false;
      //     } else if($.isNumeric(mName)){
      //         alert("মারফোত নাম সংখ্যা হতে পারে না !");
      //         $('#mName').focus();
      //         validReturn = false;
      //     } else {
      //       if(mAmount == ""){
      //             alert("জমা ফাঁকা হবে না ! মান না থাকলে ০ বসান ।");
      //             $('#mAmount').focus();
      //             validReturn = false;
      //         } else if(!$.isNumeric(mAmount)){
      //             alert("জমা অবশ্যই সংখ্যা হতে হবে ।");
      //             $('#mAmount').focus();
      //             validReturn = false;
      //         } else {
      //           validReturn = true;
      //         }
      //     }

      //     if(validReturn){
      //         return true;
      //     }else{
      //         return false;
      //     }
      // }
  </script>
  <script type="text/javascript">
      var text = $('#updateMsg').html();
      if(text == 'Data Updated Successfully!'){
        // alert(text);
        function sample(){
          window.location.href = 'modify_vaucher.php';
        }
        setTimeout(sample, 1000);
        
      }
  </script>
  <script type="text/javascript" id="script-1">
      $(function() {
        $('#nij_paona_date').datepicker( {
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd/mm/yy",
            changeYear: true,
        });
      });
  </script>
  <script type="text/javascript">
      function page_redirect(){
          window.location.href = 'modify_vaucher.php';
      }
  </script>
</body>
</html>
