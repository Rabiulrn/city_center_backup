<?php
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  session_start();
  if(!isset($_SESSION['username'])){
      //haven't log in
      header('location:../index.php'); 
  }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Wait For Allow Page</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

</head>
<body>
    <?php
      include '../navbar/header_text.php';
      $page = 'allow_page';
      include '../navbar/navbar.php';
    ?>
    <div class="container">
        <?php 
          // $ph_id = $_SESSION['project_name_id'];
          // $query = "SELECT * FROM project_heading WHERE id = $ph_id";
          // $show = $db->select($query);
          // if ($show) 
          // {
          //     while ($rows = $show->fetch_assoc()) 
          //     {
          ?>          
              <!-- <h2 class="text-center text-success"><strong><?php echo $rows['heading']; ?> আপনাকে স্বাগতম</strong></h2> -->
          <?php 
          //     }
          // } 
        ?>
        <!-- <h2 class="text-center text-success"><strong>রংপুর সিটি সেন্টারে আপনাকে স্বাগতম</strong></h2> -->
        <hr>   
        <h3 class="text-center text-danger">স্বাগতম</h3>
        <h3 class="text-center text-danger">আপনার কোন পেইজ দেখার অনুমতি নেই ।</h3>
        <h4 class="text-center text-primary">অনুগ্রহ পূর্বক অ্যাডমিনের সাথে যোগাযোগ করুন ।</h4>
        <h4 class="text-center text-primary">০১৭XX-XXXXXX</h4>
    </div>    
</body>
</html>