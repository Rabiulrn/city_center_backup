<?php 
session_start();
require 'config/config.php';
require 'lib/database.php';
$db = new Database();

if(isset($_POST['submit'])){
    $usertype = $_POST['usertype'];
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));
    $project_name = $_POST['project_name'];
    
    $_SESSION['uNameForPlaceHolerVerify'] = $username;

    $query = "SELECT * FROM login WHERE username='$username' AND password='$password' AND usertype='$usertype'";

    $result = $db->login($query);
    $num_row = mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    if( $num_row ==1 ) {
      $_SESSION['first_name']   = $row['first_name'];
      $_SESSION['last_name']    = $row['last_name'];
      $_SESSION['username']     = $row['username'];
      $_SESSION['usertype']     = $row['usertype'];

      $_SESSION['home']         = $row['home'];
      $_SESSION['doinik_hisab'] = $row['doinik_hisab'];      
      $_SESSION['joma_khat']    = $row['joma_khat'];
      $_SESSION['khoros_khat']  = $row['khoros_khat'];
      $_SESSION['nije_pabo']    = $row['nije_pabo'];
      $_SESSION['paonader']     = $row['paonader'];
      $_SESSION['modify_data']  = $row['modify_data'];
      $_SESSION['rod_hisab']    = $row['rod_hisab'];
      $_SESSION['create_user']  = $row['create_user'];

      $_SESSION['verification'] = $row['verification'];
      $_SESSION['page_permission']  = $row['page_permission'];
      $_SESSION['project_name_id']  = $project_name;

      
      if($_SESSION['verification'] == 'no'){
          header('location: verify_email_address.php');
          exit;
      } else {
          if($_SESSION['page_permission'] == 'no'){
              header('location: vaucher/no_permission.php');
              exit;
          } else {
              /////////////////////////////////////              
              header("Location: vaucher/doinik_all_hisab.php");
              // if($_SESSION['home'] == 'yes'){
              //     header("Location: vaucher/home.php");
              //     exit;
              // } else {
                  if($_SESSION['doinik_hisab'] == 'yes'){
                      header("Location: vaucher/index.php");
                      exit;
                  } else {
                      if($_SESSION['joma_khat'] == 'yes'){
                          header("Location: vaucher/add_vaucher_credit.php");
                          exit;
                      } else {
                          if($_SESSION['khoros_khat'] == 'yes'){
                              header("Location: vaucher/add_vaucher_group.php");
                              exit;
                          } else {
                            if($_SESSION['nije_pabo'] == 'yes'){
                                header("Location: vaucher/nij_paonadar_add.php");
                                exit;
                            } else {
                              if($_SESSION['paonader'] == 'yes'){
                                  header("Location: vaucher/jara_pabe_add.php");
                                  exit;
                              } else {
                                if($_SESSION['modify_data'] == 'yes'){
                                  header("Location: vaucher/modify_vaucher.php");
                                  exit;
                                } else {
                                    if($_SESSION['create_user'] == 'yes'){
                                      header("Location: vaucher/create_user.php");
                                      exit;
                                    } else {}
                                }
                              }
                            }
                          }
                      }
                  }
              // }
          }
      }

      echo 'You have no permission to view any page.';
    }
    else {
      echo 'oops  can not do it.';
    }
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="css/style.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  <style type="text/css"> 
    .btn-radio {
        cursor: pointer;
        display: inline-block;
        float: left;
        -webkit-user-select: none;
        -moz-user-select: none;
    }
    .btn-radio input {
        display: none;
    }
    .btn-radio svg {
        fill: none;
        vertical-align: middle;
    }
    .btn-radio svg circle {
      stroke-width: 2;
      stroke: #C8CCD4;
    }
    .btn-radio svg path.inner {
        stroke-width: 6;
        stroke-dasharray: 19;
        stroke-dashoffset: 19;
    }
    .btn-radio svg path.outer {
        stroke-width: 2;
        stroke-dasharray: 57;
        stroke-dashoffset: 57;
    }
    .btn-radio svg path {
        stroke: #008FFF;
        stroke: #16a085;
    }

    .btn-radio input:checked + svg path.inner {
        stroke-dashoffset: 38;
        transition-delay: 0.3s;
    }
    .btn-radio input:checked + svg path {
        transition: all 0.4s ease;
        transition-delay: 0s;
    }
    .btn-radio input:checked + svg path.outer {
        stroke-dashoffset: 0;
    }
    .btn-radio input:checked + svg path {
        transition: all 0.4s ease;
    }

    .btn-radio:not(:first-child) {
        margin-left: 10%;
    }
    #project_name{
      -moz-appearance:none;
      -webkit-appearance:none;
      appearance:none;
      background: url('img/logo/arrow_bottom.png') no-repeat right #495057;
      background-size: 16px 16px;
      transition: all .5s;
    }
  </style>
</head>
<body>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div class="box">
                    <p class="logoContainer">
                      <img src="img/Shah logoUsed.png" alt="logo" class="loginLogo">
                    </p>
                    <div class="floats">                        
                        <form class="form" action="" method="POST">
                            <div class="form-group userTypes">
                                    <label for="adminInput" class="btn-radio" id="adlabel">
                                        <input type="radio" name="usertype" value="admin" id="adminInput" checked>
                                        <svg width="20px" height="21px" viewBox="0 0 20 20">
                                          <circle cx="10" cy="10" r="9"></circle>
                                          <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                                          <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                        </svg>
                                        <span>Admin Login</span>
                                    </label>

                                    <label for="userInput" class="btn-radio" id="urlabel">
                                        <input type="radio" name="usertype" value="user" id='userInput'>
                                        <svg width="20px" height="21px" viewBox="0 0 20 20">
                                          <circle cx="10" cy="10" r="9"></circle>
                                          <path d="M10,7 C8.34314575,7 7,8.34314575 7,10 C7,11.6568542 8.34314575,13 10,13 C11.6568542,13 13,11.6568542 13,10 C13,8.34314575 11.6568542,7 10,7 Z" class="inner"></path>
                                          <path d="M10,1 L10,1 L10,1 C14.9705627,1 19,5.02943725 19,10 L19,10 L19,10 C19,14.9705627 14.9705627,19 10,19 L10,19 L10,19 C5.02943725,19 1,14.9705627 1,10 L1,10 L1,10 C1,5.02943725 5.02943725,1 10,1 L10,1 Z" class="outer"></path>
                                        </svg>
                                        <span>User Login</span>
                                    </label>
                            </div>
                            <div class="form-group">
                                <!-- <label for="username" class="">Username:</label><br> -->
                                <input type="text" name="username" id="username" class="form-control" placeholder="USERNAME">
                            </div>
                            <div class="form-group">
                                <!-- <label for="password" class="">Password:</label><br> -->
                                <input type="password" name="password" id="password" class="form-control" placeholder="PASSWORD">
                            </div>
                            <div class="form-group">
                                <select id="project_name" name="project_name" class="form-control">
                                    <option value="0">SELECT A PROJECT NAME</option>
                                    <?php
                                        // $query = "SELECT * FROM project_heading";
                                        // $result = $db->select($query);
                                        // $num_row = mysqli_num_rows($result);
                                        // if($result && $num_row > 0){
                                        //     while($row = $result->fetch_assoc()) {
                                        //         $id = $row['id'];
                                        //         $heading = $row['heading'];
                                        //         echo '<option value="'.$id.'">'.$heading.'</option>';
                                        //     }
                                        // }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-block" value="Login">
                            </div>
                        </form>
                        <div>
                          <div class="" style="float: left">
                            <a href="forget_password.php" class="text-danger">Forgot password?</a>
                            <br>
                            <a href="../index.html" class="btn" style="padding: 0px; font-size: 12px;"><img src="img/others/left_arrow.png" width = "10" height="9"> Back to website</a>
                          </div>
                          
                          
                          <div style="float: right;"><a href="sign_up.php" class="btn btn-primary">Sign up</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
  $(document).ready(function(){
      $('#adlabel').addClass('uTypeActive');
      
      $('#adlabel').click(function(){        
          if($('#adlabel').hasClass('uTypeActive')){
          } else{
              $('#adlabel').addClass('uTypeActive');
              $('#urlabel').removeClass('uTypeActive');
          }
      });

      $('#urlabel').click(function(){
          if($('#urlabel').hasClass('uTypeActive')){
            
          } else{
              $('#urlabel').addClass('uTypeActive');
              $('#adlabel').removeClass('uTypeActive');
          }
      });
  });
</script>
<script type="text/javascript">
    // if menu is open then true, if closed then false
   var open = false;
   // just a function to print out message
   function isOpen(){
       if(open){
          // return "menu is open";
          $("#project_name").css({"background":"url('img/logo/arrow_top.png') no-repeat right #495057", "background-size": "16px 16px" , "transition": "all .5s"});
       }else{
          // return "menu is closed";
          $("#project_name").css({"background" : "url('img/logo/arrow_bottom.png') no-repeat right #495057", "background-size": "16px 16px" , "transition": "all .5s"});
       }
   }
   // on each click toggle the "open" variable
   $("#project_name").on("click", function() {
         open = !open;
         console.log(isOpen());
   });
   // on each blur toggle the "open" variable
   // fire only if menu is already in "open" state
   $("#project_name").on("blur", function() {
         if(open){
            open = !open;
            console.log(isOpen());
         }
   });
   // on ESC key toggle the "open" variable only if menu is in "open" state
   $(document).keyup(function(e) {
       if (e.keyCode == 27) { 
         if(open){
            open = !open;
            console.log(isOpen());
         }
       }
   });
</script>
<script type="text/javascript">
    $(document).on('input', '#username', function(){
        var username = $(this).val();
        // alert(username);
        $.ajax({
            url: 'ajaxcall_save_update/project_name_list_update.php',
            type: 'post',
            data: {username: username},
            success: function(res){
                // alert(res);
                $('#project_name').html(res);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
</html>

<?php  
// session_destroy();
?>


