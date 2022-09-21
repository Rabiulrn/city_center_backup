<?php 
 session_start();
 if(!isset($_SESSION['username'])){
    //haven't log in
      header('location: index.php'); 
  }
  require 'config/config.php';
  require 'lib/database.php';  
  $db = new Database();
 
  
 // use PHPMailer\PHPMailer\PHPMailer;
 // use PHPMailer\PHPMailer\Exception;
 // require 'vendor/autoload.php';

require("phpmailer/class.phpmailer.php");
require("phpmailer/class.smtp.php");


?>


<?php
$displayNone = 'block';


$newUser = "";
$successMsg = "";
// $_SESSION['userName'] = $_SESSION['username'];
if (isset($_POST['submit'])) 
{
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
            
                // Import PHPMailer classes into the global namespace
                // These must be at the top of your script, not inside a function                
                $randomCode = mt_rand(10000,99999);
                $_SESSION['randomCode'] = $randomCode;

                  
                
            
                    //Server settings
                    //$mail->SMTPDebug = 2;   
                    $mail = new PHPMailer(); 
                    $mail->SMTPDebug = 2;                                     // Enable verbose debug output
                    $mail->isSMTP();                                            // Set mailer to use SMTP
                    $mail->Host       = 'mail.professionalit.com.bd';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'webmaster@professionalit.com.bd';                     // SMTP username
                    $mail->Password   = 'iBPS2H})J#1O';                               // SMTP password
                    $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
                    $mail->Port       = 465;                                    // TCP port to connect to
                   
                    //Recipients
                    $mail->setFrom('citycenterwebapp@gmail.com', 'Rangpur City Center');
                    $mail->addAddress($username, 'User');     // Add a recipient
                    // $mail->addAddress('ellen@example.com');               // Name is optional
                    // $mail->addReplyTo('info@example.com', 'Information');
                    $mail->addCC('manzu.alam01@gmail.com');
                    // $mail->addBCC('bcc@example.com');

                    // Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Email Verification';
                    $mail->Body    = '
                                    To verify user account of "' . $username . '" please enter the code and click to verify.<br><b>Verification Code: '.$randomCode.'</b>
                                    <br><br>

                                    Kind Regards,<br>
                                    Rangpur City Center';
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    //$mail->send();
                    // echo 'Message has been sent';
                    if($mail->send()){
                         $successMsg = 'We will send an email within a moment. Please check your email.';
                      }else{
                          echo 'Message could not be sent.';
                          echo 'Mailer Error: ' . $mail->ErrorInfo;
                      }

                    //$successMsg = 'We will send an email within a moment. Please check your email.';
                
        }
        else{
            $newUser = 'User name not found ! Please sign up first.';
        }        

    }    
}



$vcodeSuccMsg ="";
$uname = $_SESSION['username'];
// var_dump($_SESSION['userName']);
if(isset($_POST['codeSubmit'])){
    // var_dump($_SESSION['userName']);
    $inputvcode = trim($_POST['vcodein']);
    if($inputvcode == $_SESSION['randomCode']){
        $query = "UPDATE login SET verification ='yes' WHERE username ='$uname'";
        $result = $db->update($query);
        if($result)
        {
          $vcodeSuccMsg = "Username/Email Verification Successful. You can login now.";
          $displayNone = 'none';
          // var_dump($newUser);
        }
        else{
          $vcodeSuccMsg = "Code donot match! Resend mail and try again.";
          // var_dump($newUser);
        }
    } else {
      $vcodeSuccMsg = "Code donot match! Resend mail and try again.";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
  <title>Verify Username</title>
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
        $('#codeSubmit').attr("disabled", true);
        $('#vcode').keyup(function(){
            if($(this).val().length !==5){
              $('#codeSubmit').attr("disabled", true);
            } else{
              $('#codeSubmit').removeAttr("disabled");
            }
        });        


        
        // $('#submitUname').attr("disabled", true);
        $('#username').keyup(function(){
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
    
    function codevalid(){
      var validReturn = false;
      var vcode = $('#vcode').val();
      var intRegex = /^\d+$/;      

      


      if(vcode == ''){
        $('#vcodeMsg').html('Please provide your verification code.');
        validReturn = false;
      } else if(vcode.length !== 5){
         $('#vcodeMsg').html('Verification code must contain 5 digits.');
         validReturn = false;
      } else if(!$.isNumeric(vcode)){
          $('#vcodeMsg').html('Verification code is not a Number.');
          validReturn = false;
      } else{
         $('#vcodeMsg').html('');
        validReturn = true;
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
          <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
        </div> -->
      <?php 
          //   }
          // } 
      ?>
      <div class="create_user_con">
          <div class="pannel ">
              <div class="form-group" style="display: <?php echo $displayNone;?>;">
                <div class="new_user_heading">For login verify your email address first.</div>
                <div class="errorMsg" id="errorShow"  style="text-align: center;"><?php echo $newUser; ?></div>
                <div class="successMsg" id="sucShow"><?php echo $successMsg; ?></div>
              </div>
              <form action="" id="emailForm" method="POST" onsubmit="return validation()" style="display: <?php echo $displayNone;?>;">
                  <div class="form-group">
                      <label for="username" class="">Username:</label><br>
                      <input type="text" name="username" id="username" class="form-control" placeholder="USERNAME as Email" value="<?php echo $_SESSION['uNameForPlaceHolerVerify']; ?>" readonly>
                      <div id="unameMsg" class="errorMsg"></div>
                  </div>            
                  <div class="form-group" style="margin-bottom: 0px;">
                      <input type="submit" name="submit" id="submitUname" class="btn btn-primary btn-block" value="Send Verification code via Email">
                  </div>
                  <br>
                  <hr>
              </form>              
              

              <form action="" id="codeForm" method="POST" class="form-inline text-center" onsubmit="return codevalid()" style="display: <?php echo $displayNone;?>;">
                  <div class="form-group">
                    <label class="">Please input the verification code here and click to verify.</label><br>
                  </div>
                  <div class="form-group">
                      <label for="vcode">Code:</label>
                      <input type="text" name="vcodein" id="vcode" class="form-control" placeholder="Enter your code" maxlength="5">                      
                      <input type="submit" name="codeSubmit" id="codeSubmit" class="btn btn-primary" value="Verify">

                      <div id="vcodeMsg" class="errorMsg"></div>
                      
                  </div> 
              </form>
              <div id="vcodeSuccMsg" class="successMsg"><?php echo $vcodeSuccMsg;?></div>
              <div class="form-group" style="margin-bottom: 0px;">
                    <div>
                      <a href="index.php" class="btn btn-success btn-block" style="margin-top: 15px;"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back to Login</a>
                    </div>
              </div>
          </div>            
      </div>
      
    </div>


<!--     <script type="text/javascript">
      $(document).on('click','#adminInput', function(){
          $('#home').attr('checked',"").prop('checked', true);
          $('#joma_khat').attr('checked',"").prop('checked', true);
          $('#khoros_khat').attr('checked',"").prop('checked', true);
          $('#nije_pabo').attr('checked',"").prop('checked', true);
          $('#paonader').attr('checked',"").prop('checked', true);
          $('#modify_data').attr('checked',"").prop('checked', true);
          $('#create_user').attr('checked',"").prop('checked', true).removeAttr('disabled');
      });
      $(document).on('click','#userInput', function(){
          $('#home').removeAttr('checked').prop('checked', false);
          $('#joma_khat').removeAttr('checked').prop('checked', false);
          $('#khoros_khat').removeAttr('checked').prop('checked', false);
          $('#nije_pabo').removeAttr('checked').prop('checked', false);
          $('#paonader').removeAttr('checked').prop('checked', false);
          $('#modify_data').removeAttr('checked').prop('checked', false);
          $('#create_user').removeAttr('checked').attr('disabled',"disabled").prop('checked', false);
      });      
    </script> -->
</body>
</html>
<?php
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $telephone = $_POST['telephone'];
    // $address = $_POST['address'];
    // $company = $_POST['company'];
    // $subject = $_POST['subject'];
    // $message = $_POST['message'];

    // $mail = new PHPMailer();
    // $mail->SMTPDebug = 0;
    // $mail->IsSMTP();
    // $mail->Host = "mail.professionalit.com.bd"; // Your Domain Name

    // $mail->SMTPAuth = true;
    // $mail->Port = 465;
    // $mail->Username = "webmaster@professionalit.com.bd"; // Your Email ID
    // $mail->Password = "iBPS2H})J#1O"; // Password of your email id
    // // $mail->SMTPDebug = 2; 
    // $mail->SMTPSecure = 'ssl';
    // $mail->From = "manzu.alam012@gmail.com";
    // $mail->FromName = "Professional IT Team";
    // $mail->AddAddress("manzu.alam012@gmail.com"); // On which email id you want to get the message
    // $mail->AddCC($email);

    // $mail->IsHTML(true);




?>