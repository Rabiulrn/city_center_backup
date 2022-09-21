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

    // $sql = "SELECT ton,partculars,particulars FROM details_cement WHERE id = '$rod_details_id'";
    // $show = $db->select($sql);
    // if ($show) {
    //   while ($rows = $show->fetch_assoc()) {
    //     $del_ton = $rows['ton'];
    //     $del_part = $rows['partculars'];
    //     $del_parti = $rows['particulars'];
    //   }
    //   // $sql_update = "UPDATE stocks_pathor SET `ton` = `ton` - '$del_ton' WHERE partculars ='$del_part' AND particulars ='$del_parti' AND `ton` - '$ton' >= 0 ORDER BY ton DESC LIMIT 1";

    //   // $result2 = $db->select($sql_update);
    //   // if ($result2) {
    //   //   echo "stocks updated  Successfully.";
    //   // }
    // }


      $sql = "DELETE FROM details_cement WHERE id = '$rod_details_id'";
      if ($db->select($sql) === TRUE) {
        $sucDel = "Details entry deleted successfully.";
        echo $sucDel;
      } else {
        echo "Error: " . $sql . "<br>" .$db->error;
      }
  }

?>