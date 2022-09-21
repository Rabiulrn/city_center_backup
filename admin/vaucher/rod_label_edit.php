<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header('location:../index.php');
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();

  $sucMsg = '';

  $label_others_id = $_GET['label_others_id'];
  

  if(isset($_POST['submit'])){
    $c_name = trim($_POST['category_name']);
    $rod_lbl_name = trim($_POST['rod_lbl_name']);
    // var_dump($rod_c);
    $sql = "SELECT id FROM rod_category WHERE category_name = '$c_name'";
    $result = $db->select($sql);
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $rod_category_id = $row['id'];
    }
    // var_dump($c_name);

    $sql="UPDATE rod_and_other_label SET rod_label = '$rod_lbl_name', rod_category_id ='$rod_category_id' WHERE id = '$label_others_id'";
    if ($db->update($sql) === TRUE) {
        $sucMsg = "Rod Label or others Updated Successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }

  }



  // $rod_label = '';
  if(isset($_GET['label_others_id'])){
    $sql = "SELECT rod_label FROM rod_and_other_label WHERE id = '$label_others_id'";
    $result = $db->select($sql);
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $rod_label = $row['rod_label'];
      // echo $rod_label;
    }

    $sql = "SELECT rod_category_id FROM rod_and_other_label WHERE id = '$label_others_id'";
    $result = $db->select($sql);
    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      $rod_category_id = $row['rod_category_id'];
    }
    // var_dump($rod_category_id);
  }
?>


<!DOCTYPE html>
<html>
<head>
  <title>Rod Label Edit</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../css/voucher.css">

  


  <style type="text/css">
    .dateInput{
        line-height: 22px !important;
    }
    .allowText {
        float: right;
        margin-bottom: 3px;
    }
    .table-bordered > tbody > tr > td {
        border: 1px solid #ddd;
    }
    .table > thead > tr > th {
        border-bottom: 2px solid #ddd;
    }
    .table-bordered > thead > tr > th {
        border: 1px solid #ddd;
    }
  </style>
</head>
<body>
    <?php
      include '../navbar/header_text.php';
      include '../navbar/navbar.php';
    ?>
    <div class="container"> 

		<?php
			$ph_id = $_SESSION['project_name_id'];
			$query = "SELECT * FROM project_heading WHERE id = $ph_id";
			$show = $db->select($query);
			if ($show) 
			{
				while ($rows = $show->fetch_assoc()) 
				{
			?>
				<div class="project_heading text-center">      
				  <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
				  <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
				</div>
			<?php 
				}
			} 
		?>


    <div class="com_en_con">
      <h3 class="text-center text-success"><?php echo $sucMsg; ?></h3>
      <!-- <h3 class="rod_header">Rod Label Name Entry</h3>
      <hr class="hrstyle"> -->
      <form action="" method="post" onsubmit="return validation()">
          






          <table class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <th width="40%">Category Name:</th>
                  <th>Label Name:</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <select name = 'category_name' id="category_name" class="form-control">
                        <option value="none">Select one...</option>
                        <?php
                          $sql = "SELECT * FROM rod_category";
                          $result = $db->select($sql);
                          if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                              if($rod_category_id == $row['id']){
                                $select = "selected";
                              } else {
                                $select = "";
                              }
                              echo '<option value="'.$row['category_name'].'"'. $select .'>'.$row['category_name'].'</option>';
                            }
                          } else{
                            echo '0 results';
                          }
                        ?>
                    </select>
                  </td>
                  <td>
                    <input type="text" name = "rod_lbl_name" class="form-control" id="rod_name" value='<?php echo $rod_label;?>'>
                  </td>
                </tr>
              </tbody>
          </table>
          <input type="submit" name="submit" class="btn btn-block btn-success" value="Update">
      </form>
    </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript">
    function valid(){
      validReturn = false;
      var rod_category = $('#rod_category').val();
      // alert(rod_category);
      if(rod_category == ''){
        alert('Rod Category cant be empty !');
        $('#rod_category').focus();
        validReturn = false;
      } else if($.isNumeric(rod_category)){
        alert('Rod Category cant be Number !');
        $('#rod_category').focus();
        validReturn = false;
      } else{
        validReturn = true;
      }

      if(validReturn){
        return true;
      } else{
        return false;
      }
    }
  </script>
</body>
</html>