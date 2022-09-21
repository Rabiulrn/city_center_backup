<?php
  session_start();
  require 'config/config.php';
  require 'lib/database.php';
  $db = new Database();
  $resetMsg       = '';
  $changePassMsg  = '';
  $successMsg     = '';
  $isTimeExpired = false;
  // echo date("h:i:sa").'<br>';
  // echo date("d/m/Y");
  // $_SESSION['dbUsername'] = '';
  // $_SESSION['dbToken'] = '';

  if(isset($_POST['submitPass'])){
      $pass = md5(trim($_POST['newPassword']));
      // var_dump($pass);

      $dbUsername     = $_SESSION['dbUsername'];
      $dbToken        = $_SESSION['dbToken'];

      $reset_date_time_as_token_text = 'Reset success at '.date("d/m/Y") .' on '.date("h:i:sa");
      $query = "UPDATE login SET password = '$pass', token = '$reset_date_time_as_token_text.' WHERE username = '$dbUsername' AND token ='$dbToken'";
      $read = $db->update($query);
      // var_dump($read);
      // var_dump($dbUsername);
      // var_dump($dbToken);
      if($read){
        $resetMsg= "Password reset successfull.";
      }
      unset($_GET['username']);
      unset($_GET['token']);

      session_destroy();
  } elseif (isset($_GET['username']) && isset($_GET['token'])) {
      $username = $_GET['username'];
      $token = $_GET['token'];
      
      // echo $dbUsername . $dbToken;

      $query_time = "SELECT token_expire_time, token FROM login WHERE username = '$username' AND token ='$token'";
      $read_time = $db->select($query_time);
      if($read_time && mysqli_num_rows($read_time) == 1) {
        $time_row = $read_time->fetch_assoc();
        // echo $time_row['token_expire_time'];
        $dbtime = strtotime($time_row['token_expire_time']);
        $dbtoken = strtotime($time_row['token']);
        $nowtime = time();

        // $actualTime = 10; //minutes
        // $ten_minutes_added = $nowtime + ($actualTime * 60);
        // $startDate = date('m-d-Y H:i:s', $nowtime);
        // $endDate = date('m-d-Y H:i:s', $ten_minutes_added);
        // echo $dbtime . "=" . $nowtime;

        if($nowtime < $dbtime) {
          // echo strtotime($time_row['token_expire_time']) . "=" . $nowtime;
         
          $query = "SELECT username, token FROM login WHERE username='$username' AND token='$token'";
          $read = $db->select($query);
          // var_dump($read);
          if($read && mysqli_num_rows($read) == 1){
              while ($row = $read->fetch_assoc()){
                  $_SESSION['dbUsername'] = $row['username'];
                  $_SESSION['dbToken'] = $row['token'];
              }
            // var_dump($_SESSION['dbUsername']);
            // var_dump($_SESSION['dbToken']);
          }
        } else {
          $isTimeExpired = true;
          // echo "Time Expire Try Again....";
        }
      } else {
        $wrongLink =  "Wrong link.";
      }  
  }
  else{
      header('location: index.php');
  }
?>



<!DOCTYPE html>
<html>
  <head>
    <title>Create User</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/voucher.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
      .create_user_con{
          width: 100%;
          padding: 5px 50px 50px;
          border-radius: 4px;
          margin-bottom: 50px;
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
    </style>
    <script type="text/javascript">
      function validation(){
          var validReturn = false;
          var newPassword = $('#newPassword').val();
          var reenterNewPassword = $('#reenterNewPassword').val();



          if(newPassword =='') {
              $('#passMsg').html("Password can't be empty.");
              validReturn = false;
          } else if(newPassword.length < 5) {
              $('#passMsg').html("Password must contain at least 5 characters.");
              validReturn = false;
          } else {
              if(newPassword === reenterNewPassword) {
                  $('#passMsg').html("");
                  validReturn = true;
              } else {
                  $('#passMsg').html("Password doesnt match.");
                  $('#re-enterPassMsg').html("Password doesnt match.");
                  validReturn = false;
              }
          }




          if(reenterNewPassword ==''){
              $('#re-enterPassMsg').html("Password can't be empty.");
              validReturn = false;
          }
          else if(reenterNewPassword.length < 5){
              $('#re-enterPassMsg').html("Password must contain at least 5 characters.");
              validReturn = false;
          }
          else{
              if(newPassword === reenterNewPassword){
                  $('#re-enterPassMsg').html("");
                  validReturn = true;
              }else{
                  $('#passMsg').html("Password doesnt match.");
                  $('#re-enterPassMsg').html("Password doesnt match.");
                  validReturn = false;
              }
          }
          

          

          if(validReturn == false){
              return false;
          }else{
              return true;
          }
      }
    </script>
  </head>
<body>
  <?php
        include 'navbar/header_text_out_navbar.php';
  ?>
  <div class="container">
      <?php 
        // $query = "SELECT * FROM project_heading";
        // $show = $db->select($query);
        // if ($show) 
        // {
        //   while ($rows = $show->fetch_assoc()) 
        //   {
      ?>
        <!-- <div class="project_heading text-center">      
          <h2 class="text-center"><?php //echo $rows['heading']; ?></h2>
        </div> -->
      <?php 
          //   }
          // } 
      ?>
      <div  style="width: 400px; margin: 15px auto 0px;">
          <?php if(isset($_GET['username']) && isset($_GET['token'])) : ?>
              <?php if(!isset($wrongLink)){
                if($isTimeExpired) {
                  echo '<h2 class="text-danger bg-danger" style="padding: 8px; font-size: 16px;">Reset time expired. Please try again...</h2>';
                } else {
                  ?>
                  <form action="" method="post" class="form" onsubmit="return validation()" autocomplete="off">
                    <div class="form-group">
                        <div class="new_user_heading">Reset Password</div>
                        <div class="errorMsg" id="errorShow"  style="text-align: center;"><?php echo $changePassMsg; ?></div>
                        <div class="successMsg" id="sucShow"><?php echo $successMsg; ?></div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="">New Password:</label><br>
                        <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="NEW PASSWORD">
                        <div id="passMsg" class="errorMsg"></div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="">Re-enter New Password:</label><br>
                        <input type="password" name="reNewpassword" id="reenterNewPassword" class="form-control" placeholder="RE-ENTER NEW PASSWORD">
                        <div id="re-enterPassMsg" class="errorMsg"></div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0px;">
                        <input type="submit" name="submitPass" class="btn btn-primary btn-block" value="Reset Password">
                    </div>
                  </form>
              <?php }
                
              } else { ?>
                <h2 class="text-danger bg-danger" style="padding: 8px; font-size: 16px;">
                  Invalid link. Try again...
                </h2>
              <?php }?>
          <?php elseif (isset($_POST['submitPass'])): ?>
            <h2 class="text-center text-success"><?php echo $resetMsg; ?></h2>

            <h3 class="text-center"><a href="index.php" class="btn btn-primary">Click me for Login</a></h3>          
          <?php else: ?>
            <h2 class="text-danger bg-danger" style="padding: 8px;">
                Invalid link. Please Try again...
            </h2>
          <?php endif; ?>
      </div>
  </div>



</body>
</html>
