<?php
  // session_start();
  require 'config/config.php';
  require 'lib/database.php';
  $db = new Database();

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'vendor/autoload.php';

$newUser = "";
$successMsg = "";
if (isset($_POST['submit'])) {
    $firstname  = strtolower(trim($_POST['firstname']));
    $lastname   = strtolower(trim($_POST['lastname']));
    $username   = trim($_POST['username']);
    $mobile     = trim($_POST['mobile']);    
    $password   = md5(trim($_POST['password']));

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
            $newUser = 'User name is already exist !';
            // var_dump($newUser);
            // alert('$newUser');
        } else {
            $query = "INSERT INTO login (first_name, last_name, username, usertype, password, mobile, page_permission, doinik_hisab, protidiner_hisab, modify_data, joma_khat, khoros_khat, khoros_khat_entry, nije_pabo, paonader, report, agrim_hisab, cash_calculator, rod_hisab, rod_kroy_hisab, rod_bikroy_hisab, rod_category, rod_dealer, rod_customer, rod_buyer, rod_report, create_user, edit_data, delete_data, verification) VALUES ('$firstname', '$lastname', '$username', 'user', '$password', '$mobile', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no')";
            $result = $db->select($query);
            // var_dump($result);
            if($result) {
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
                  $mail->Subject = 'Create User';
                  $mail->Body    = "
                                    Dear Mr. " . $firstname . " ". $lastname .",<br>
                                    Your user registration is complete successfully.<br>
                                    Username = " . $username . "<br>
                                    Password = " . $_POST['password'] . "<br>
                                    Account Type = User Login <br><br>

                                    You can login after page permission and browse allow after verification your email. You can show pages, edit, update or delete infomation if you have related permission.<br><br>
                                    
                                    Kind Regards,<br>
                                    Rangpur City Center
                                  ";

                                      
                  // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                  $mail->send();
                  // echo 'Message has been sent';
                  $successMsg = "A new user created successfully. Account Type: User";
                  $displayNone = 'none';
              } catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }
              
              // var_dump($newUser);
            } else {
              $newUser = "User not Create.";
              // var_dump($newUser);
            }
        }        

    }
    
}

?>



<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
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
      var validFirstname = false;
      var validLastname = false;
      var validUsername = false;
      var validMobile = false;
      var validPassword = false;
      var validRepassword = false;

      var firstname   = $('#firstname').val();
      var lastname    = $('#lastname').val();
      var username    = $('#username').val();
      var mobile      = $('#mobile').val();
      var password    = $('#password').val();
      var rePassword  = $('#rePassword').val();

      //First Name Validation
      var regName = /^[a-zA-Z]+$/;
      if(firstname ==''){
          $('#fnameMsg').html("First name can't be empty.");
          validFirstname = false;
      }else if(firstname.length < 2){
          $('#fnameMsg').html("First name must contain at least 2 characters.");
          validFirstname = false;
      }else if(!regName.test(firstname)){
          $('#fnameMsg').html("Provide only alphabet.");
          validFirstname = false;
      }
      else{
        $('#fnameMsg').html("");
        validFirstname = true;
      }
      //Last Name Validation
      if(lastname ==''){
          $('#lnameMsg').html("Last name can't be empty.");
          validLastname = false;
      }else if(lastname.length < 2){
          $('#lnameMsg').html("Last name must contain at least 2 characters.");
          validLastname = false;
      }else if(!regName.test(lastname)){
          $('#lnameMsg').html("Provide only alphabet.");
          validFirstname = false;
      }
      else{
        $('#lnameMsg').html("");
        validLastname = true;
      }
      //User Name validation
      var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if(username ==''){
          $('#unameMsg').html("User name can't be empty.");
          validUsername = false;
      }else if(username.length < 10){
          $('#unameMsg').html("User name must contain at least 10 characters.");
          validUsername = false;
      }else if(!regex.test(username)){
          $('#unameMsg').html("Provide a valid email address as username.");
          validUsername = false;
      }
      else{
        $('#unameMsg').html("");
        validUsername = true;
      }
      //Mobile number validation
      if(mobile ==''){
          $('#mobileMsg').html("Mobile number can't be empty.");
          validMobile = false;
      }else if(mobile.length !== 11){
          $('#mobileMsg').html("Mobile number must contain 11 characters.");
          validMobile = false;
      }
      else{
          var regexNo = /^[0-9]+$/;
          if(!regexNo.test(mobile)){
              $('#mobileMsg').html("Mobile number contain only digit.");
              validMobile = false;
          }else{
              $('#mobileMsg').html("");
              validMobile = true;
          }        
      }

      //Password Validation
//       validPassword
// validRepassword
      if(password ==''){
          $('#passMsg').html("Password can't be empty.");
          validPassword = false;
      }
      else if(password.length < 5){
          $('#passMsg').html("Password must contain at least 5 characters.");
          validPassword = false;
      }
      else{
          if(rePassword ==''){
              $('#repassMsg').html("Re-enter new password can't be empty.");
              validRepassword = false;
          }else if(rePassword.length < 5){
              $('#repassMsg').html("Re-enter new password must contain at least 5 characters.");
              validRepassword = false;
          } else {
            if(password === rePassword){              
                $('#repassMsg').html("");
                validPassword = true;
                validRepassword = true;
                $('#passMsg').html("");
                $('#repassMsg').html("");
            }else{
                $('#passMsg').html("New password and re-enter new password does not match.");
                $('#repassMsg').html("New password and re-enter new password does not match.");
                validPassword = false;
                validRepassword = false;
            }
          }
          
      }

      //reNew password validation
      // if(rePassword ==''){
      //     $('#repassMsg').html("Re-enter new password can't be empty.");
      //     validRepassword = false;
      // }else if(rePassword.length < 5){
      //     $('#repassMsg').html("Re-enter new password must contain at least 5 characters.");
      //     validRepassword = false;
      // }
      // else{
      //     if(password === rePassword){
      //         $('#repassMsg').html("");
      //         if(validRepassword == true){
      //           validRepassword = true;
      //         }else{
      //           validRepassword = false;
      //         }  
      //     }else{
      //         $('#passMsg').html("New password and re-enter new password does not match.");
      //         $('#repassMsg').html("New password and re-enter new password does not match.");
      //         validRepassword = false;
      //     }
      // }



      if(validFirstname == false || validLastname == false || validUsername == false || validMobile  == false || validPassword == false || validRepassword == false){
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
          <h4 class="text-center"><?php echo $rows['subheading']; ?></h4>
        </div> -->
      <?php 
          //   }
          // } 
      ?>
      <form action="" method="POST" onsubmit="return validation()" autocomplete="off">
        <div class="create_user_con">
            <div class="pannel ">
                <div class="form-group">
                    <div class="new_user_heading bg-primary">Create New User</div>
                    <div class="errorMsg" id="errorShow"  style="text-align: center;"><?php echo $newUser; ?></div>
                    <div class="successMsg" id="sucShow"><?php echo $successMsg; ?></div>
                </div>
                <div class="form-group" style="float: left; width: 100%;">
                    <div style="width: 47%; float: left;">
                        <label for="firstname" class="">First Name:</label><br>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="FIRST NAME" autocomplete="off">
                        <div id="fnameMsg" class="errorMsg"></div>
                    </div>
                    <div style="margin-left:6%; width: 47%; float: left;">
                        <label for="lastname" class="">Last Name:</label><br>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="LAST NAME" autocomplete="off">
                        <div id="lnameMsg" class="errorMsg"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="">Username:</label><br>
                    <input type="text" name="username" id="username" class="form-control" placeholder="USERNAME AS EMAIL" autocomplete="new-username">
                    <div id="unameMsg" class="errorMsg"></div>
                </div>
                <div class="form-group">
                    <label for="Mobile" class="">Mobile Number:</label><br>
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" autocomplete="off">
                    <div id="mobileMsg" class="errorMsg"></div>
                </div>
                <div class="form-group">
                    <label for="password" class="">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control" placeholder="PASSWORD" autocomplete="new-password">
                    <div id="passMsg" class="errorMsg"></div>
                </div>
                <div class="form-group">
                    <label for="rePassword" class="">Re-enter Password:</label><br>
                    <input type="password" name="rePassword" id="rePassword" class="form-control" placeholder="RE-ENTER PASSWORD" autocomplete="off">
                    <div id="repassMsg" class="errorMsg"></div>
                </div>               

                <div class="form-group" style="margin-bottom: 0px;">
                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign Up">
                    <div>
                      <a href="index.php" class="btn btn-success btn-block" style="margin-top: 15px;"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back to Login</a>
                    </div>
                </div>
                
            </div>            
        </div>
      </form>
    </div>

</body>
</html>