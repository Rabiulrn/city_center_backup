<?php 
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php');
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  

  $rod_details_id = $_POST['rod_details_id'];
  if(isset($rod_details_id)){

      $sql = "DELETE FROM details_sell WHERE id = '$rod_details_id'";
      if ($db->select($sql) === TRUE) {
        $sucDel = "Details sell entry deleted successfully.";
        echo $sucDel;
      } else {
        echo "Error: " . $sql . "<br>" .$db->error;
      }
  }

?>