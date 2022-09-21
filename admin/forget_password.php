<?php 
   // session_start();
   // if(!isset($_SESSION['username'])){
   //      header('location: index.php'); 
   //  }

  // $now = time();
  // $actualTime = 10; //minutes
  // $ten_minutes_added = $now + ($actualTime * 60);
  // $startDate = date('m-d-Y H:i:s', $now);
  // $endDate = date('m-d-Y H:i:s', $ten_minutes_added);

  // echo $actualTime . " || " . $ten_minutes_added . " || " . $startDate . " || " . $endDate;

  require 'config/config.php';
  require 'lib/database.php';  
  $db = new Database();
 
  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'vendor/autoload.php';
  

  function generateNewString($len = 20) {
    $token = "poiuztrewqasdfghjklmnbvcxy1234567890";
    $token = str_shuffle($token);
    $token = substr($token, 0, $len);
    return $token;
  }



  $displayNone = 'block';
  $newUser = "";
  $successMsg = "";
  if (isset($_POST['submit'])) {
      $username = trim($_POST['username']);
      $_SESSION['username'] = trim($_POST['username']);
      // var_dump($_SESSION['userName']);

      $query = "SELECT username FROM login";
      $read = $db->select($query);    
      if($read){
          $usernames = array();
          $i =0;
          while($rows= $read->fetch_assoc()){
              $usernames[$i] =  $rows['username'];
              $i++;       
          }

          // var_dump($usernames);

          if(in_array($username, $usernames)){
              $successMsg = 'User name found !';
              $token = generateNewString();

              // $now = time();
              //$actualTime = 10; //minutes
              // $ten_minutes_added = $now + ($actualTime * 60);
              // $startDate = date('m-d-Y H:i:s', $now);
              // $endDate = date('m-d-Y H:i:s', $ten_minutes_added);

              $tokenQuery = "UPDATE login SET token = '$token', 
                        token_expire_time = ADDTIME(NOW() , '0:10:0.000003')
                        WHERE username='$username'";
              $readTokenQuery = $db->update($tokenQuery);
              if($readTokenQuery){
                    // Import PHPMailer classes into the global namespace
                  // These must be at the top of your script, not inside a function                
                  $mail = new PHPMailer(true);                
                  try {
                      //Server settings
                      // $mail->SMTPDebug = 2;                                       // Enable verbose debug output
                      $mail->isSMTP();                                            // Set mailer to use SMTP
                      $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                      $mail->Username   = 'citycenterwebapp@gmail.com';                     // SMTP username
                      $mail->Password   = 'cc@rangpur@Kh0k0n82';                               // SMTP password
                      $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
                      $mail->Port       = 465;                                    // TCP port to connect to

                      //Recipients
                      $mail->setFrom('citycenterwebapp@gmail.com', 'Rangpur City Center');
                      $mail->addAddress($username, 'User');     // Add a recipient
                      // $mail->addAddress('ellen@example.com');               // Name is optional
                      // $mail->addReplyTo('info@example.com', 'Information');
                      $mail->addCC('kallolray94@gmail.com');
                      // $mail->addBCC('bcc@example.com');

                      // Attachments
                      // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                      // Content
                      $mail->isHTML(true);                                  // Set email format to HTML
                      $mail->Subject = 'Reset password';
                      if(PASS == '') { //check localhost
                        $mail->Body    = "
                                          Hi,<br>
                                          
                                          In order to reset your password, please click on the link below:<br>
                                          <a href='http://localhost/city_center/admin/reset_password.php?username=$username&token=$token'>http://localhost/city_center1/admin/reset_password.php?username=$username&token=$token</a><br><br>
                                          
                                          Kind Regards,<br>
                                          Rangpur City Center
                                        ";
                      } else {
                        $mail->Body    = "
                                        Hi,<br>
                                        
                                        In order to reset your password, please click on the link below:<br>
                                        <a href='http://27.147.195.221:8086/city_center1/admin/reset_password.php?username=$username&token=$token'>http://27.147.195.221:8086/city_center1/admin/reset_password.php?username=$username&token=$token</a><br><br>
                                        
                                        Kind Regards,<br>
                                        Rangpur City Center
                                      ";
                      }
                                          
                      // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                      $mail->send();
                      // echo 'Message has been sent';
                      $successMsg = 'We will send a reset password link within a moment. Please check your email with in 10 minutes.';
                      $displayNone = 'none';
                  } catch (Exception $e) {
                      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                  }
              }else{
                  $newUser = 'Token is not generate ! Please try again.';
              }
                  
          }
          else{
              $newUser = 'User name not found ! Please sign up first.';
          }        

      }    
  }



?>



<!DOCTYPE html>
<html>
<head>
  <title>Forget Password</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <style type="text/css">
    .create_user_con{
        /*background-color: #f0f0f0;
        border: 1px solid #ddd;*/
        width: 100%;
        padding: 5px 50px 50px;
        border-radius: 4px;
        margin-bottom: 50px;
        /*box-shadow: 0 1px 1px rgba(0,0,0,.05);*/
    }
    .new_user_heading{
        font-size: 20px;
        font-weight: bold;
        /*text-decoration: underline;*/
        text-align: center;
        color: #fff;
        background-color: #b90000;;
        padding: 5px;
        /*border-radius: 4px;*/
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
      font-size: 16px;
      font-weight: bold;
      border-radius: 5px;
      /*margin-top: 5px;*/
    }
  </style>
  <script type="text/javascript">

    function validation(){
      var validReturn = false;
      var username = $('#username').val();

      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(username ==''){
          $('#unameMsg').html("User name can't be empty.");
          validReturn = false;
      }else if(username.length < 10){
          $('#unameMsg').html("User name must contain at least 10 characters.");
          validReturn = false;
      }else if(!regex.test(username)){
          $('#unameMsg').html("Provide a valid email address as username.");
          validReturn = false;
      }
      else{
        $('#unameMsg').html("");
        validReturn = true;
      } 


      if(validReturn == false){
        return false;
      }else{
        return true;
      }
    }


    $(document).ready(function(){
        
        $('#submitUname').attr("disabled", true);
        $('#username').on('keyup input', function(){
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var a = $(this).val();
            // alert(a);

            if( a == ''){
              $('#submitUname').attr("disabled", true);
            }
            else if(!regex.test(a)){
              $('#submitUname').attr("disabled", true);
            }
            else{
              $('#submitUname').removeAttr("disabled"); 
            }
        });

    });

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
      <div class="create_user_con">
          <div class="pannel ">
              <div class="form-group">
                <div class="new_user_heading" style="display: <?php echo $displayNone;?>;">Forget password?</div>
                <div class="bg-success" style="font-size: 15px; margin-top: 5px; padding: 5px; display: <?php echo $displayNone;?>;">Enter your user Name and click send reset link via email.</div>
                <div class="errorMsg" id="errorShow"  style="text-align: center;"><?php echo $newUser; ?></div>
                <div class="successMsg" id="sucShow"><?php echo $successMsg; ?></div>
              </div>

              <form action="" id="emailForm" method="POST" onsubmit="return validation()" style="display: <?php echo $displayNone;?>;" autocomplete="off">
                  <div class="form-group">
                      <label for="username" class="">Username:</label><br>
                      <input type="text" name="username" id="username" class="form-control" placeholder="USERNAME as Email" >
                      <div id="unameMsg" class="errorMsg"></div>
                  </div>            
                  <div class="form-group" style="margin-bottom: 0px;">
                      <input type="submit" name="submit" id="submitUname" class="btn btn-primary btn-block" value="Send Reset link via Email">
                  </div>
                  
              </form>
              <div class="form-group" style="margin-bottom: 0px;">
              <div>
                <a href="index.php" class="btn btn-success btn-block" style="margin-top: 15px;"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back to Login</a>
              </div>
            </div>
          </div>            
      </div>
      
    </div>

</body>
</html>
