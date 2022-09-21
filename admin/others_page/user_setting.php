<?php 
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php'); 
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $_SESSION['pageName'] = 'user_setting';
  $ph_id = $_SESSION['project_name_id'];

	
	$errMsg = '';
	$sucMsg = '';
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$target_dir = "../img/user_photo/";
    $uploadImage_BaseName = basename($_FILES["imageUpload"]["name"]);
    $uploadImage_TempName = $_FILES["imageUpload"]["tmp_name"];
		$uploadOk = 1;

		$newTime = date('dmYHis');
    $fname = $_SESSION['first_name'];
    $lname = $_SESSION['last_name'];
    $fullName = $fname . "_" . $lname;

		$imageFileType = strtolower(pathinfo($uploadImage_BaseName, PATHINFO_EXTENSION));
    $newImageName = $newTime ."_". $fullName. "." .$imageFileType;  //Generate New Image name   
    
    // $target_file = $target_dir . $newTime ."_". $uploadImage_BaseName;  //jekhane img ta rakhbo Puraton name a
    $target_dir_for_up_file = $target_dir . $newImageName; //Jekhane img ta rakhbo new name a
    
    $check = getimagesize($uploadImage_TempName);    
    if($check !== false) {
        // $sucMsg = " File is an image, Extension- " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errMsg .= " File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
		// if (file_exists($target_file)) {
		//     echo "Sorry, file already exists.";
		//     $uploadOk = 0;
		// }

		// Check file size    
		if ($_FILES["imageUpload"]["size"] > 5242880) { //Nuber represent Byte
		    $errMsg .= " Your file is too large, Need less than 5MB.";
		    $uploadOk = 0;        
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    $errMsg .= " Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $errMsg .= " Your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {          
          $nameArr = explode(".", $uploadImage_BaseName);
          $fileExt = end($nameArr);
          // $moveResult = move_uploaded_file($uploadImage_TempName, $target_file);
          $moveResult = move_uploaded_file($uploadImage_TempName, $target_dir_for_up_file);

          if($moveResult !== true){
            echo "Image Not moved !";
          } else{
              $resized_file = $target_dir . $newImageName;
              $wmax = 300;
              $hmax = 300;
              function ak_img_resize($gettingImg, $newcopy, $w, $h, $ext) {
                  list($w_orig, $h_orig) = getimagesize($gettingImg);
                  $scale_ratio = $w_orig / $h_orig;

                  if (($w / $h) > $scale_ratio) {
                         $w = $h * $scale_ratio;
                  } else {
                         $h = $w / $scale_ratio;
                  }

                  $img = "";
                  $ext = strtolower($ext);
                  // var_dump($ext);
                  if ($ext == "gif"){ 
                    $img = imagecreatefromgif($gettingImg);
                  } else if($ext =="png"){ 
                    $img = imagecreatefrompng($gettingImg);
                  } else { 
                    $img = imagecreatefromjpeg($gettingImg);
                  }
                  $tci = imagecreatetruecolor($w, $h);
                  imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
                  imagejpeg($tci, $newcopy, 80);
              }
              // ak_img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
              ak_img_resize($target_dir_for_up_file, $resized_file, $wmax, $hmax, $fileExt);

              //Uploaded Image delete
              // $del_main_up_file = $target_dir . $newTime ."_".$uploadImage_BaseName;
              // unlink($del_main_up_file);

              // My db part              
              $sesstion_username = $_SESSION['username'];

              $sql = "UPDATE login SET photo = '$newImageName' WHERE username = '$sesstion_username'";
              $result = $db->update($sql);
                if ($result){
                     // $sucMsg = 'Image inserted successfully !';
                   $sucMsg = ' The image file name "'. $uploadImage_BaseName . '" has been uploaded.';
                }
                else
                {
                   $sucMsg = 'Image not inserted, Error From DB !';
                }
          }
		}

	}
	
?>
<!DOCTYPE html>
<html>
<head>
  <title>User Setting</title>
  <meta charset="utf-8">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="../css/voucher.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>



  <style type="text/css">
    .psContainer{
    	width: 50%;
    	position: relative;
    	left: 50%;
    	margin-left: -25%;
    	margin-bottom: 50px;
    	border: 2px solid #ddd;
    	padding: 15px;

    }
    .inputCon{
    	width: 100%;
    	height: 30px;
    	margin: 25px 0px 10px;
    }
    .inputCon label{
    	width: 160px;
    	float: left;
    	color: #555;
    }
    .inputCon input{
    	width: calc(100% - 160px);
    	float: left;
    }
    .imgView{
    	width: 100px;
    	height: 100px;
    	border: 2px solid #333;
    	margin-bottom: 30px;
    	box-shadow: 4px 4px 10px #555;
      position: relative;
      left: 50%;
      margin-left: -50px;
    }
  </style>

</head>
<body>
    <?php
      include '../navbar/header_text.php';
      // $page = 'joma_khat';
      include '../navbar/navbar.php';
    ?>
    <div class="container"> 

      <?php 
        
        $query = "SELECT * FROM project_heading WHERE id = $ph_id";
        $show = $db->select($query);
        if ($show) 
        {
          while ($rows = $show->fetch_assoc()) 
          {
      ?>
        <div class="project_heading text-center">      
          <h2 class="text-center" style="font-size: 25px;"><?php echo $rows['heading']; ?></h2>
          <!-- <h4 class="text-center"><?php echo $rows['subheading']; ?></h4> -->
        </div>
      <?php 
            }
          } 
      ?>


      
      <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validation()">
        <div class="psContainer">
        	<h3 class="text-center bg-primary" style="margin-top: 0px; padding: 5px;">Change User Photo</h3>
        	<div class="inputCon">
        		<label>Select User Photo: </label>
        		<input type="file" name="imageUpload" id="imgFile" onchange="loadFile(event)">       		
        	</div>
        	<img src="../img/user_photo/default_user_photo.jpg" class="imgView" id="imgShowId"/>
        	
        	
        	<input type="submit" name="submit" value="Upload Photo" class="btn btn-block btn-primary">
        	

        	<div class="text-success" style="font-size: 16px;"><?php if($sucMsg !== ''){echo '<br/>'. $sucMsg; } ?></div>
        	<div class="text-danger" id ="errMsgId" style="font-size: 16px;"><?php if($errMsg !== ''){echo '<br/>'. $errMsg; } ?></div>
        </div>
      </form>   
    </div>

  <script>
		var loadFile = function(event) {
			var imgShowId = document.getElementById('imgShowId');
      imgShowId.src = URL.createObjectURL(event.target.files[0]);




      // var imgShowId = $('#imgShowId').val();
      // var ext = $('#imgShowId').val().split('.').pop().toLowerCase();
      // alert(ext);
      // if(ext == 'gif' || ext == 'png' || ext == 'jpg' || ext == 'jpeg'){
      //   imgShowId.src = URL.createObjectURL(event.target.files[0]);
      // }else{        
      // }
			
		};

		function validation(){
		  	var validRetrun = false;
		  	var imgFile = $('#imgFile').val();
		  	// alert(imgFile);
		  	if(imgFile == ''){
		  		validRetrun = false;
		  		$('#errMsgId').html('Please select a photo !').css({'text-align':'center', 'margin-top' : '15px'});
		  	} else{
		  		validRetrun = true;
		  	}

		  	if(validRetrun){
		  		return true;
		  	} else {
		  		return false;
		  	}
		}


	</script>
</body>
</html>