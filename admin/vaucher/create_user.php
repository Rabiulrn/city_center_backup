<?php
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php'); 
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $_SESSION['pageName'] = 'create_user';
  $usertype = $_SESSION['usertype'];
  $project_name_id = $_SESSION['project_name_id'];

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require '../vendor/autoload.php';

  $newUser = "";
  $successMsg = "";
  if (isset($_POST['submit'])){
      $submit_val = trim($_POST['submit']);

      $firstname  = strtolower(trim($_POST['firstname']));
      $lastname   = strtolower(trim($_POST['lastname']));
      $username   = trim($_POST['username']);
      $mobile     = trim($_POST['mobile']);    
      

      if($submit_val == 'Sign Up'){
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
                  $newUser = 'User name is already exist! If you forget password, so you can reset password for login.';
                  // var_dump($newUser);
                  // alert('$newUser');
              } else {
                  $query = "INSERT INTO login (first_name, last_name, username, usertype, password, mobile, page_permission, doinik_hisab, protidiner_hisab, modify_data, joma_khat, khoros_khat, khoros_khat_entry, nije_pabo, paonader, report, agrim_hisab, cash_calculator, rod_hisab, rod_kroy_hisab, rod_bikroy_hisab, rod_category, rod_dealer, rod_customer, rod_buyer, rod_report, create_user, edit_data, delete_data, verification) VALUES('$firstname', '$lastname', '$username', 'user', '$password', '$mobile', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no')";
                  $result = $db->select($query);
                  // var_dump($result);
                  if($result){
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
                        $mail->SMTPDebug = false;
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
                        $successMsg = "A new user created successfully. Account Type : User";
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
      } else {
          $login_id  = trim($_POST['login_id']);
          
          $sql = "UPDATE login SET first_name = '$firstname', last_name = '$lastname', username = '$username', mobile = '$mobile' WHERE id='$login_id'";
          $read = $db->update($sql);
          if($read){
              $successMsg = 'User Updated successfully.';
          } else {
              $successMsg = 'User not Updated.';
          }
      }    
  }



  if(isset($_GET['login_id'])){
      $login_id = $_GET['login_id'];
      $sql = "DELETE FROM login WHERE id = '$login_id'";
      $result = $db->delete($sql);
      if($result){
        $successMsg = "Delete user successfully.";
        // var_dump($newUser);
      } else {
        // $newUser = "User not Create.";
        $successMsg = "User not delete.";
        // var_dump($newUser);
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">

  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <style type="text/css">
    .create_user_con{
        /*background-color: #f0f0f0;
        border: 1px solid #ddd;*/
        width: 100%;
        padding: 5px 50px 50px;
        border-radius: 4px;
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
    .userView{
        margin-bottom: 90px;
    }
    .userView table th {
        text-align: center;
    }
  </style>
  <script type="text/javascript">
    function validation(){
      var sign_up_val = $("#sign_up").val();      
      if(sign_up_val == 'Sign Up'){
          var fnameValid = false;
          var lnameValid = false;
          var unameValid = false;
          var mobileValid = false;
          var passValid = false;
          var repassValid = false;

          var firstname   = $('#firstname').val();
          var lastname    = $('#lastname').val();
          var username    = $('#username').val();
          var mobile      = $('#mobile').val();
          var password    = $('#password').val();
          var rePassword  = $('#rePassword').val();

          //First Name Validation
          if(firstname ==''){
              $('#fnameMsg').html("First name can't be empty.");
              fnameValid = false;
          }else if(firstname.length < 3){
              $('#fnameMsg').html("First name must contain at least 3 characters.");
              fnameValid = false;
          }
          else{
            $('#fnameMsg').html("");
            fnameValid = true;
          }
          //Last Name Validation
          if(lastname ==''){
              $('#lnameMsg').html("Last name can't be empty.");
              lnameValid = false;
          }else if(lastname.length < 3){
              $('#lnameMsg').html("Last name must contain at least 3 characters.");
              lnameValid = false;
          }
          else{
            $('#lnameMsg').html("");
            lnameValid = true;
          }
          //User Name validation
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(username ==''){
              $('#unameMsg').html("User name can't be empty.");
              unameValid = false;
          }else if(username.length < 10){
              $('#unameMsg').html("User name must contain at least 10 characters.");
              unameValid = false;
          }else if(!regex.test(username)){
              $('#unameMsg').html("Provide a valid email address as username.");
              unameValid = false;
          }
          else{
            $('#unameMsg').html("");
            unameValid = true;
          }
          //Mobile number validation
          if(mobile ==''){
              $('#mobileMsg').html("Mobile number can't be empty.");
              mobileValid = false;
          }else if(mobile.length !== 11){
              $('#mobileMsg').html("Mobile number must contain 11 characters.");
              mobileValid = false;
          }
          else{
              var regexNo = /^[0-9]+$/;
              if(!regexNo.test(mobile)){
                  $('#mobileMsg').html("Mobile number contain only digit.");
                  mobileValid = false;
              }else{
                  $('#mobileMsg').html("");
                  mobileValid = true;
              }        
          }

          //Password Validation
          if(password ==''){
              $('#mpassMsg').html("Password can't be empty.");
              passValid = false;
          }
          else if(password.length < 5){
              $('#mpassMsg').html("Password must contain at least 5 characters.");
              passValid = false;
          }
          else{
              // alert('aaaaaa');
              if(password === rePassword){              
                  $('#repassMsg').html("");
                  passValid = true;             
              }else{
                  $('#passMsg').html("New password and re-enter new password does not match.");
                  $('#repassMsg').html("New password and re-enter new password does not match.");
                  passValid = false;
              }
          }

          //reNew password validation
          if(rePassword ==''){
              $('#repassMsg').html("Re-enter new password can't be empty.");
              repassValid = false;
          }else if(rePassword.length < 5){
              $('#repassMsg').html("Re-enter new password must contain at least 5 characters.");
              repassValid = false;
          }
          else{
              if(password === rePassword){
                  $('#repassMsg').html("");
                  $('#mpassMsg').html("");
                  repassValid = true;
              }else{
                  $('#mpassMsg').html("New password and re-enter new password does not match.");
                  $('#repassMsg').html("New password and re-enter new password does not match.");
                  repassValid = false;
              }
          }

          if(fnameValid && lnameValid && unameValid && mobileValid && passValid && repassValid){
              return true;
          } else {
              return false;
          }
      } else {
          var fnameValid = false;
          var lnameValid = false;
          var unameValid = false;
          var mobileValid = false;

          var firstname   = $('#firstname').val();
          var lastname    = $('#lastname').val();
          var username    = $('#username').val();
          var mobile      = $('#mobile').val();
          //First Name Validation
          if(firstname ==''){
              $('#fnameMsg').html("First name can't be empty.");
              fnameValid = false;
          }else if(firstname.length < 3){
              $('#fnameMsg').html("First name must contain at least 3 characters.");
              fnameValid = false;
          }
          else{
            $('#fnameMsg').html("");
            fnameValid = true;
          }
          //Last Name Validation
          if(lastname ==''){
              $('#lnameMsg').html("Last name can't be empty.");
              lnameValid = false;
          }else if(lastname.length < 3){
              $('#lnameMsg').html("Last name must contain at least 3 characters.");
              lnameValid = false;
          }
          else{
            $('#lnameMsg').html("");
            lnameValid = true;
          }
          //User Name validation
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(username ==''){
              $('#unameMsg').html("User name can't be empty.");
              unameValid = false;
          }else if(username.length < 10){
              $('#unameMsg').html("User name must contain at least 10 characters.");
              unameValid = false;
          }else if(!regex.test(username)){
              $('#unameMsg').html("Provide a valid email address as username.");
              unameValid = false;
          }
          else{
            $('#unameMsg').html("");
            unameValid = true;
          }
          //Mobile number validation
          if(mobile ==''){
              $('#mobileMsg').html("Mobile number can't be empty.");
              mobileValid = false;
          }else if(mobile.length !== 11){
              $('#mobileMsg').html("Mobile number must contain 11 characters.");
              mobileValid = false;
          }
          else{
              var regexNo = /^[0-9]+$/;
              if(!regexNo.test(mobile)){
                  $('#mobileMsg').html("Mobile number contain only digit.");
                  mobileValid = false;
              }else{
                  $('#mobileMsg').html("");
                  mobileValid = true;
              }        
          }
          if(fnameValid && lnameValid && unameValid && mobileValid){
              return true;
          } else {
              return false;
          }
      }
      

      
    }
  </script>
</head>

<body>
    <?php
      include '../navbar/header_text.php';
      include '../navbar/navbar.php';
    ?>
    <div class="container">
      <?php
          $query = "SELECT * FROM project_heading WHERE id = '$project_name_id'";
          $show = $db->select($query);
          if ($show){
              while ($rows = $show->fetch_assoc()) {
              ?>
                  <div class="project_heading text-center">      
                      <h2 class="text-center" style="font-size: 25px;"><?php echo $rows['heading']; ?></h2>
                  </div>
                  <?php 
              }
          }
      ?>
      <form action="" method="POST" onsubmit="return validation()" autocomplete="off">
        <div class="create_user_con">
            <div class="pannel ">
                <div class="form-group">
                    <div class="new_user_heading bg-primary" id="form_header">Create New User</div>
                    <div class="errorMsg" id="errorShow"  style="text-align: center;"><?php echo $newUser; ?></div>
                    <div class="successMsg" id="sucShow"><?php echo $successMsg; ?></div>
                </div>
                <div class="form-group" style="float: left; width: 100%;">
                    <div style="width: 47%; float: left;">
                        <label for="firstname" class="">First Name:</label><br>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="FIRST NAME" autocomplete="false">
                        <div id="fnameMsg" class="errorMsg"></div>
                    </div>
                    <div style="margin-left:6%; width: 47%; float: left;">
                        <label for="lastname" class="">Last Name:</label><br>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="LAST NAME" autocomplete="false">
                        <div id="lnameMsg" class="errorMsg"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="">Username:</label><br>
                    <input type="text" name="username" id="username" class="form-control" placeholder="USERNAME AS EMAIL" autocomplete="false">
                    <div id="unameMsg" class="errorMsg"></div>
                </div>
                <div class="form-group">
                    <label for="Mobile" class="">Mobile Number:</label><br>
                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" autocomplete="false">
                    <div id="mobileMsg" class="errorMsg"></div>
                </div>
                <div class="form-group hidePassword">
                    <label for="password" class="">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control" placeholder="PASSWORD" autocomplete="false">
                    <div id="mpassMsg" class="errorMsg"></div>
                </div>
                <div class="form-group hidePassword">
                    <label for="rePassword" class="">Re-enter Password:</label><br>
                    <input type="password" name="rePassword" id="rePassword" class="form-control" placeholder="RE-ENTER PASSWORD" autocomplete="false">
                    <div id="repassMsg" class="errorMsg"></div>
                </div>               

                <div class="form-group" style="margin-bottom: 0px;">
                    <input type="submit" name="submit" id="sign_up" class="btn btn-primary btn-block" value="Sign Up">
                    <input type="hidden" name="login_id" id="login_id" value="0">
                    <div style="height: 50px; display: none;" id ="resetBtn">
                      <span class="btn btn-success" style="margin-top: 15px; float: right;"><span class="glyphicon glyphicon-circle-arrow-left"></span> Reset</span>
                    </div>
                </div>
                
            </div>            
        </div>
      </form>      
      <?php
        if($usertype == 'admin'){
            echo '<div class="userView">',
                      '<h3 class="text-center">List of all users</h3>',
                      '<table class="table table-bordered">',
                          '</tr>',
                              '<th width="60px">Sl No.</th>',
                              '<th>Fist Name</th>',
                              '<th>Last Name</th>',
                              '<th>Username as Email</th>',
                              '<th>Mobile</th>',
                              '<th>User Type</th>',
                              '<th width="80px">Delete</th>',
                              '<th width="80px">Edit</th>',
                          '</tr>';
            $sql = "SELECT id, first_name, last_name, username, usertype, mobile FROM login";
            $result = $db->select($sql);
            $i = 1;
            while ($rows = $result->fetch_assoc()) {
                $id         = $rows['id'];
                $first_name = $rows['first_name'];
                $last_name  = $rows['last_name'];
                $username   = $rows['username'];
                $mobile     = $rows['mobile'];
                $usertype   = $rows['usertype']; 
                echo '<tr>',
                        '<td class="text-center">' . $i . '</td>',
                        '<td class="">' . ucfirst($first_name) . '</td>',
                        '<td class="">' . ucfirst($last_name) . '</td>',
                        '<td class="">' . $username . '</td>',
                        '<td class="">' . $mobile . '</td>',
                        '<td class="">' . $usertype . '</td>';
                        if($usertype == 'admin'){
                            echo '<td class="text-center"><button class="btn btn-danger disabled" lgn_id="' . $id . '">Delete</button></td>';
                        } else {
                           echo '<td class="text-center"><button class="btn btn-danger clsDeleteUser" lgn_id="' . $id . '"">Delete</button></td>';
                        }                        
                        echo '<td class="text-center"><button class="btn btn-success" lgn_id="' . $id . '" onclick="display_update(this)">Edit</button></td>',
                      '</tr>';
                $i++;
            }
            echo    '</table>',
                '</div>';
        }
      ?>
      
    </div>
    <?php include '../others_page/delete_permission_modal.php';  ?>

    <script type="text/javascript">
      // $(document).on('click','#adminInput', function(){
      //     $('#home').attr('checked',"").prop('checked', true);
      //     $('#joma_khat').attr('checked',"").prop('checked', true);
      //     $('#khoros_khat').attr('checked',"").prop('checked', true);
      //     $('#nije_pabo').attr('checked',"").prop('checked', true);
      //     $('#paonader').attr('checked',"").prop('checked', true);
      //     $('#modify_data').attr('checked',"").prop('checked', true);
      //     $('#create_user').attr('checked',"").prop('checked', true).removeAttr('disabled');  

      // });
    </script>
    <script type="text/javascript">
        $(document).on('click', '.clsDeleteUser', function(event){          
            var lgn_id = $(event.target).attr('lgn_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("lgn_id", lgn_id);
        });
        $(document).on('click', '#verifyToDeleteBtn', function(event){
            var lgn_id = $(event.target).attr('lgn_id');
            $("#passMsg").html("").css({'margin':'0px'});
            var pass = $("#matchPassword").val();
            console.log(lgn_id);
            $.ajax({

                url: "../ajaxcall/match_password_for_vaucher_credit.php",
                type: "post",
                data: { pass : pass },
                success: function (response) {
                    // alert(response);s
                    if(response == 'password_matched'){
                        $("#verifyPasswordModal").hide();
                        ConfirmDialog('Are you sure delete this user?');
                    } else {
                        // alert(response);
                        $("#passMsg").html(response).css({'color':'red','margin-top':'10px'});
                    }
              },
              error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
            });
            
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
                                            $.get("create_user.php?login_id="+lgn_id, function(data, status){
                                                console.log(status);
                                                if(status == 'success'){
                                                  window.location.href = 'create_user.php';
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

        function display_update(ele){
            var fname = $(ele).closest('tr').find('td:eq(1)').text();
            var lname = $(ele).closest('tr').find('td:eq(2)').text();
            var username = $(ele).closest('tr').find('td:eq(3)').text();
            var mobile = $(ele).closest('tr').find('td:eq(4)').text();
            var login_id = $(ele).attr("lgn_id");
            
            $("#form_header").html("Update User Information");
            $("#firstname").val(fname);
            $("#lastname").val(lname);
            $("#username").val(username);
            $("#mobile").val(mobile);
            $("#login_id").val(login_id);
            $(".hidePassword").hide();
            $("#sign_up").val('Update user');
            $("html, body").animate({scrollTop: 100}, 500);

            $('#fnameMsg').html("");
            $('#lnameMsg').html("");
            $('#unameMsg').html("");
            $('#mobileMsg').html("");
            $('#resetBtn').show();
            // alert(login_id);
        }
        $(document).on('click', '#resetBtn', function(){
            $("#form_header").html("Create New User");
            $("#firstname").val('');
            $("#lastname").val('');
            $("#username").val('');
            $("#mobile").val('');
            $("#login_id").val('0');
            $(".hidePassword").show();
            $("#sign_up").val("Sign Up");

            $('#fnameMsg').html("");
            $('#lnameMsg').html("");
            $('#unameMsg').html("");
            $('#mobileMsg').html("");
            $('#repassMsg').html("");
            $('#repassMsg').html("");
            $('#errorShow').html("");
            $('#sucShow').html("");
            $('#resetBtn').hide();
        });
    </script>
    <script type="text/javascript">
        $(document).on("click", ".kajol_close, .cancel", function(){
            $("#verifyPasswordModal").hide();
        });
    </script>
</body>
</html>