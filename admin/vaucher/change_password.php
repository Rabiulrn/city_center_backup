<?php
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php'); 
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $_SESSION['pageName'] = 'change_password';
?>


<?php
$successMsg = "";
$changePassMsg = "";
if (isset($_POST['submit'])) 
{
    
    $username = $_SESSION['username'];
    $oldPassword = md5(trim($_POST['oldPassword']));
    $newPass = md5(trim($_POST['newPassword']));



    $query = "SELECT username, password FROM login WHERE username = '$username' AND password = '$oldPassword'";
    $read = $db->select($query);    
    if($read){
        $num_rows = mysqli_num_rows($read);
        // echo $num_rows;

        if($num_rows == 0){
            $changePassMsg = "Enter correct old password and try again !";
        }else if($num_rows == 1){
            $query = "UPDATE login SET password = '$newPass' WHERE username = '$username' AND password = '$oldPassword'";
            $result =$db->update($query);
            if($result){
                $successMsg = "Password changed successfully.";
            } else{
                $changePassMsg = "Password not chanded.";
            }
        } else {
            $changePassMsg = "Password not changed.";
        }

    }
    
}

?>



<!DOCTYPE html>
<html>
<head>
  <title>Create User</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style type="text/css">
    .create_user_con{
        /*background-color: #f0f0f0;*/
        /*border: 1px solid #ddd;*/
        width: 100%;
        padding: 5px 50px 50px;
        border-radius: 4px;
        margin-bottom: 50px;
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
  </style>
  <script type="text/javascript">
    function validation(){
      var validReturn = false;
      var oldPass = $('#oldPassword').val();
      var newPass = $('#newPassword').val();
      var reNewPass = $('#reenterNewPassword').val();
      

      if(oldPass ==''){
          $('#oldPassMsg').html("Old password can't be empty.");
          validReturn = false;

      }else if(oldPass.length < 5){
          $('#oldPassMsg').html("Old password must contain at least 5 characters.");
          validReturn = false;
      }
      else{
          $('#oldPassMsg').html("");
          validReturn = true;
      }
      
      

      if(newPass ==''){
          $('#passMsg').html("Password can't be empty.");
          validReturn = false;

      }else if(newPass.length < 5){
          $('#passMsg').html("Password must contain at least 5 characters.");
          validReturn = false;
      }
      else{
          if(newPass === reNewPass){              
              $('#re-enterPassMsg').html("");
              validReturn = true;
          }else{
              $('#passMsg').html("New password and re-enter new password does not match.");
              $('#re-enterPassMsg').html("New password and re-enter new password does not match.");
              validReturn = false;
          }
      }


      if(reNewPass ==''){
          $('#re-enterPassMsg').html("Re-enter new password can't be empty.");
          validReturn = false;

      }else if(reNewPass.length < 5){
          $('#re-enterPassMsg').html("Re-enter new password must contain at least 5 characters.");
          validReturn = false;
      }
      else{
          if(newPass === reNewPass){
              $('#re-enterPassMsg').html("");
              validReturn = true;
          }else{
              $('#passMsg').html("New password and re-enter new password does not match.");
              $('#re-enterPassMsg').html("New password and re-enter new password does not match.");
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
        include '../navbar/header_text.php';
        $page = 'change_pwd';
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
          <h2 class="text-center" style="font-size: 25px;"><?php echo $rows['heading']; ?></h2>
          <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
        </div>
      <?php 
            }
          } 
      ?>

            
      <form action="" method="POST" onsubmit="return validation()" autocomplete="false">
        <div class="create_user_con">
            <div class="pannel">
                <div class="form-group">
                  <div class="new_user_heading">Change Your Password</div>
                  <div class="errorMsg" id="errorShow"  style="text-align: center;"><?php echo $changePassMsg; ?></div>
                  <div class="successMsg" id="sucShow"><?php echo $successMsg; ?></div>
                </div>
                <!-- <div class="form-group">
                    <label for="username" class="">Username:</label><br>
                    <input type="text" name="username" id="username" class="form-control" placeholder="USERNAME">
                    <div id="unameMsg" class="errorMsg"></div>
                </div> -->
                <div class="form-group">
                    <label for="password" class="">Old Password:</label><br>
                    <input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="OLD PASSWORD">
                    <div id="oldPassMsg" class="errorMsg"></div>
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
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Change Password">
                </div>
            </div>            
        </div>
      </form>
    </div>
</body>
</html>