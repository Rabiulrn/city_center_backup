<?php
  session_start();

  require 'config/config.php';
  require 'lib/database.php';
  $db = new Database();


?>


<?php
$newUser = "";
$successMsg = "";
if (isset($_POST['submit'])) 
{
    
    $username = trim($_POST['username']);
    $password = md5(trim($_POST['password']));
    $usertype = $_POST['usertype'];

    if(isset($_POST['home'])){
      $home     = 'yes';
    } else {
      $home     = 'no';
    }    
    // var_dump($home);
    if(isset($_POST['joma_khat'])){
      $joma_khat     = 'yes';
    } else {
      $joma_khat     = 'no';
    }
    // var_dump($joma_khat);
    if(isset($_POST['khoros_khat'])){
      $khoros_khat     = 'yes';
    } else {
      $khoros_khat     = 'no';
    }
    // var_dump($khoros_khat);
    if(isset($_POST['nije_pabo'])){
      $nije_pabo     = 'yes';
    } else {
      $nije_pabo     = 'no';
    }
    // var_dump($nije_pabo);
    if(isset($_POST['paonader'])){
      $paonader     = 'yes';
    } else {
      $paonader     = 'no';
    }
    // var_dump($paonader);
    if(isset($_POST['modify_data'])){
      $modify_data     = 'yes';
    } else {
      $modify_data     = 'no';
    }
    // var_dump($modify_data);
    if(isset($_POST['create_user'])){
      $create_user     = 'yes';
    } else {
      $create_user     = 'no';
    }
    // var_dump($create_user);


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
        }
        else{
            $query = "INSERT INTO login (username, usertype, password, home, joma_khat, khoros_khat, nije_pabo, paonader, modify_data, create_user, verification) VALUES('$username', '$usertype', '$password', '$home', '$joma_khat', '$khoros_khat', '$nije_pabo', '$paonader', '$modify_data', '$create_user','no')";
            $result = $db->select($query);
            // var_dump($result);
            if($result)
            {
              $successMsg = "A new user created successfully. 'Account Type = ". $usertype."'.";
              // var_dump($newUser);
            }
            else{
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
  <title>Create User</title>
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
        padding: 50px 50px 50px;
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
      var username = $('#username').val();
      var password = $('#password').val();
      // var utype = $
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

      if(password ==''){
          $('#passMsg').html("Password can't be empty.");
          validReturn = false;

      }else if(password.length < 6){
          $('#passMsg').html("Password must contain at least 6 characters.");
          validReturn = false;
      }
      else{
          if(!regex.test(username)){
            $('#unameMsg').html("Provide a valid email address as username.");
            validReturn = false;
          }else{
            $('#passMsg').html("");
            validReturn = true;
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
      include 'navbar/header_text.php';
    ?>
    <div class="container">
      

            
      <form action="" method="POST" onsubmit="return validation()">
        <div class="create_user_con">
            <div class="pannel ">
                <div class="form-group">
                  <div class="new_user_heading bg-primary">Create New User</div>
                  <div class="errorMsg" id="errorShow"  style="text-align: center;"><?php echo $newUser; ?></div>
                  <div class="successMsg" id="sucShow"><?php echo $successMsg; ?></div>
                </div>
                <div class="form-group">
                    <label for="username" class="">Username:</label><br>
                    <input type="text" name="username" id="username" class="form-control" placeholder="USERNAME">
                    <div id="unameMsg" class="errorMsg"></div>
                </div>
                <div class="form-group">
                    <label for="password" class="">Password:</label><br>
                    <input type="password" name="password" id="password" class="form-control" placeholder="PASSWORD">
                    <div id="passMsg" class="errorMsg"></div>
                </div>
                <!-- <div class="form-group">
                    <label for="password" class="">Account Type:</label><br>
                    <span id="adminSpan">
                      &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="usertype" value="admin" id="adminInput"> Admin
                    </span>
                      &nbsp;&nbsp;|&nbsp;&nbsp;
                    <span id="userSpan">
                      &nbsp;&nbsp;&nbsp;&nbsp;
                      <input type="radio" name="usertype" value="user" id='userInput' checked> User
                    </span>
                    <div id="utypeMsg" class="errorMsg"></div>
                </div> -->
                <!-- <div class="form-group" style="float: left; width: 100%; margin-bottom: 25px;">
                    <label for="password" style="float: left; width: 100%;">Allow pages For this user:</label>
                    <span class="pagesCheck">
                      <input type="checkbox" name="home" value="select" id="home" checked=""> Home                      
                    </span>
                    <span class="pagesCheck">
                      <input type="checkbox" name="joma_khat" value="select" id="joma_khat"> জমা খাত
                    </span>
                    <span class="pagesCheck">
                      <input type="checkbox" name="khoros_khat" value="select" id="khoros_khat"> খরচ খাত
                    </span>
                    <span class="pagesCheck">
                      <input type="checkbox" name="nije_pabo" value="select" id="nije_pabo"> নিজে পাবো
                    </span>
                    <span class="pagesCheck">
                      <input type="checkbox" name="paonader" value="select" id="paonader"> পাওনাদার
                    </span>
                    <span class="pagesCheck">
                      <input type="checkbox" name="modify_data" value="select" id="modify_data"> Modify Data
                    </span>
                    <span class="pagesCheck">
                      <input type="checkbox" name="create_user" value="select" id="create_user" disabled="disabled"> Create User
                    </span>
                </div> -->
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


    <script type="text/javascript">
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
          $('#home').removeAttr('checked').prop('checked', true);
          $('#joma_khat').removeAttr('checked').prop('checked', false);
          $('#khoros_khat').removeAttr('checked').prop('checked', false);
          $('#nije_pabo').removeAttr('checked').prop('checked', false);
          $('#paonader').removeAttr('checked').prop('checked', false);
          $('#modify_data').removeAttr('checked').prop('checked', false);
          $('#create_user').removeAttr('checked').attr('disabled',"disabled").prop('checked', false);
          

      });

      
    </script>
</body>
</html>