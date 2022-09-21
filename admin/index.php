<?php
  ob_start();
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
      

      // $query = "SELECT * FROM login WHERE username='$username' AND password='$password' AND usertype='$usertype' AND project_name_id LIKE '%$project_name%'";
      $query = "SELECT * FROM login WHERE username='$username' AND password='$password' AND (usertype='$usertype' OR usertype='superAdmin') AND project_name_id LIKE '%$project_name%'";
      $result = $db->login($query);
      $num_row = mysqli_num_rows($result);
    //   echo "user found = ". $num_row;
      $row=mysqli_fetch_array($result);
      if( $num_row ==1 ) {
        $_SESSION['project_name_id']  = $project_name;

        $_SESSION['first_name']   = $row['first_name'];
        $_SESSION['last_name']    = $row['last_name'];
        $_SESSION['username']     = $row['username'];

        if($_SESSION['usertype'] == "superAdmin") {
          $_SESSION['usertype']   = "admin";
          $_SESSION['is_super_admin'] = true;
        } else {
          $_SESSION['usertype']   = $row['usertype'];
          $_SESSION['is_super_admin'] = false;
        }
        


        $_SESSION['doinik_hisab']     = $row['doinik_hisab'];
        $_SESSION['protidiner_hisab'] = $row['protidiner_hisab'];
        $_SESSION['modify_data']      = $row['modify_data'];
        $_SESSION['joma_khat']        = $row['joma_khat'];
        $_SESSION['khoros_khat']      = $row['khoros_khat'];
        $_SESSION['khoros_khat_entry']= $row['khoros_khat_entry'];
        $_SESSION['nije_pabo']        = $row['nije_pabo'];
        $_SESSION['paonader']         = $row['paonader'];
        $_SESSION['report']           = $row['report'];
        $_SESSION['agrim_hisab']      = $row['agrim_hisab'];
        $_SESSION['cash_calculator']  = $row['cash_calculator'];
        
        // Manzu raj_kajerhisab add in sessions
        $_SESSION['raj_kajer_all_hisab']  = $row['raj_kajer_all_hisab'];
        $_SESSION['electric_kroy_bikroy']  = $row['electric_kroy_bikroy'];
        
        $_SESSION['balu_hisab']        = $row['balu_hisab'];
        $_SESSION['balu_kroy_hisab']   = $row['balu_kroy_hisab'];
        $_SESSION['balu_bikroy_hisab'] = $row['balu_bikroy_hisab'];
        $_SESSION['balu_category']     = $row['balu_category'];
        $_SESSION['balu_dealer']       = $row['balu_dealer'];
        $_SESSION['balu_customer']     = $row['balu_customer'];
        $_SESSION['balu_buyer']        = $row['balu_buyer'];
        $_SESSION['balu_report']       = $row['balu_report'];
        $_SESSION['balu_stocks']       = $row['balu_stocks'];


        $_SESSION['pathor_hisab']        = $row['pathor_hisab'];
        $_SESSION['pathor_kroy_hisab']   = $row['pathor_kroy_hisab'];
        $_SESSION['pathor_bikroy_hisab'] = $row['pathor_bikroy_hisab'];
        $_SESSION['pathor_category']     = $row['pathor_category'];
        $_SESSION['pathor_dealer']       = $row['pathor_dealer'];
        $_SESSION['pathor_customer']     = $row['pathor_customer'];
        $_SESSION['pathor_buyer']        = $row['pathor_buyer'];
        $_SESSION['pathor_report']       = $row['pathor_report'];
        $_SESSION['pathor_stocks']       = $row['pathor_stocks'];


        $_SESSION['cement_hisab']        = $row['cement_hisab'];
        $_SESSION['cement_kroy_hisab']   = $row['cement_kroy_hisab'];
        $_SESSION['cement_bikroy_hisab'] = $row['cement_bikroy_hisab'];
        $_SESSION['cement_category']     = $row['cement_category'];
        $_SESSION['cement_dealer']       = $row['cement_dealer'];
        $_SESSION['cement_customer']     = $row['cement_customer'];
        $_SESSION['cement_buyer']        = $row['cement_buyer'];
        $_SESSION['cement_report']       = $row['cement_report'];
        $_SESSION['cement_stocks']       = $row['cement_stocks'];


        $_SESSION['rod_hisab']        = $row['rod_hisab'];
        $_SESSION['rod_kroy_hisab']   = $row['rod_kroy_hisab'];
        $_SESSION['rod_bikroy_hisab'] = $row['rod_bikroy_hisab'];
        $_SESSION['rod_category']     = $row['rod_category'];
        $_SESSION['rod_dealer']       = $row['rod_dealer'];
        $_SESSION['rod_customer']     = $row['rod_customer'];
        $_SESSION['rod_buyer']        = $row['rod_buyer'];
        $_SESSION['rod_report']       = $row['rod_report'];

        $_SESSION['create_user']      = $row['create_user'];
        $_SESSION['edit_data']        = $row['edit_data'];
        $_SESSION['delete_data']      = $row['delete_data'];

        $_SESSION['verification']     = $row['verification'];
        $_SESSION['page_permission']  = $row['page_permission'];
      
        
        if($_SESSION['verification'] == 'no'){
            header("Location: vaucher/doinik_all_hisab.php", true, 301);
            // header('location: verify_email_address.php', true, 301);
            exit;
        } else {
            if($_SESSION['page_permission'] == 'no'){
                header('location: vaucher/no_permission.php', true, 301);
                exit;
            } else {
                // exit(header("Location: vaucher/doinik_all_hisab.php"));
                header("Location: vaucher/doinik_all_hisab.php", true, 301);
                exit;
                // if($_SESSION['home'] == 'yes'){
                //     header("Location: vaucher/home.php");
                //     exit;
                // } else {
                //     if($_SESSION['doinik_hisab'] == 'yes'){
                //         header("Location: vaucher/index.php");
                //         exit;
                //     } else {
                //         if($_SESSION['joma_khat'] == 'yes'){
                //             header("Location: vaucher/add_vaucher_credit.php");
                //             exit;
                //         } else {
                //             if($_SESSION['khoros_khat'] == 'yes'){
                //                 header("Location: vaucher/add_vaucher_group.php");
                //                 exit;
                //             } else {
                //               if($_SESSION['nije_pabo'] == 'yes'){
                //                   header("Location: vaucher/nij_paonadar_add.php");
                //                   exit;
                //               } else {
                //                 if($_SESSION['paonader'] == 'yes'){
                //                     header("Location: vaucher/jara_pabe_add.php");
                //                     exit;
                //                 } else {
                //                   if($_SESSION['modify_data'] == 'yes'){
                //                     header("Location: vaucher/modify_vaucher.php");
                //                     exit;
                //                   } else {
                //                       if($_SESSION['create_user'] == 'yes'){
                //                         header("Location: vaucher/create_user.php");
                //                         exit;
                //                       } else {}
                //                   }
                //                 }
                //               }
                //             }
                //         }
                //     }
                // }
            }
        }
      } else {
        echo 'oops can not do it. It can happens missing username, password or user type.';
        exit;
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
        /*stroke: #16a085;*/
        stroke: #000;
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
.dropdown{ 
    overflow:auto;

}
label#adlabel {
    display: inline-block !important;
}
  </style>
</head>
<body>
    <div class="container" style="min-height: 725px;">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div class="box">
                    <p class="logoContainer">
                      <img src="img/Shah logoUsed.png" alt="logo" class="loginLogo">
                    </p>
                    <div class="floats">                        
                        <form class="form" action="" method="POST" onsubmit="return validation()">
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
                            <div class="form-group wrapper" >
                            <!-- <select  id="project_name" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();"  name="project_name" class="form-control dropdown" > -->

                                <select  id="project_name"  name="project_name" class="form-control dropdown selec2" style="overflow-y: scroll;" >


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
        $.ajax({
            url: 'ajaxcall_save_update/project_name_list_update.php',
            type: 'post',
            data: {username: username},
            success: function(res){
                $('#project_name').html(res);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
</script>
<script type="text/javascript">
    function validation(){
        var validUserName = false;
        var validPass = false;
        var validProjectName = false;

        var username = $("#username").val();
        var password = $("#password").val();
        var project_name = $('#project_name option:selected').val();
        // alert(project_name);

        if(username == '' && password == '' && project_name == '0') {
            alert('Username, password and project name can not be empty !');
            return false;
        } else {
            if(username == '' && password == ''){
                alert('Username and password can not be empty !');
                var validProjectName = true;
                return false;
            } else if (username == '' && project_name == '0'){
                alert('Username and project_name can not be empty !');
                var validPass = true;
                return false;
            } else if(password == '' && project_name == '0'){
                alert('Password and project_name can not be empty !');
                var validUserName = true;
                return false;
            }
        }

        if(username == ''){
            alert('Username can not be empty !');
        } else {
            validUserName = true;
        }
        if(password == ''){
            alert('Password can not be empty !');
        } else {
            validPass = true;
        }
        if(project_name == '0'){            
            alert('Please select a project name !');
        } else {
            validProjectName = true;
        }

        if(validUserName && validPass && validProjectName){
            return true;
        } else {
            return false;
        }
    }
</script>
</html>
<?php
    ob_end_flush();
?>


