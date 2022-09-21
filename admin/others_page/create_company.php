<?php 
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php'); 
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();


	
	$errMsg = '';
	$sucMsg = '';
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
    $company_name  = $_POST['company_name'];

    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

		$target_dir = "../img/company_img/company_logo/";
    $target_dir2 = "../img/company_img/company_banner/";

    $uploadImage_BaseName = basename($_FILES["imageUpload"]["name"]);
    $uploadImage_BaseName2 = basename($_FILES["imageUpload2"]["name"]);

    $uploadImage_TempName = $_FILES["imageUpload"]["tmp_name"];
    $uploadImage_TempName2 = $_FILES["imageUpload2"]["tmp_name"];
		
    $uploadOk = 1;
    $uploadOk2 = 1;

		$newTime = date('dmYHis');

		$imageFileType = strtolower(pathinfo($uploadImage_BaseName, PATHINFO_EXTENSION)); 
    $imageFileType2 = strtolower(pathinfo($uploadImage_BaseName2, PATHINFO_EXTENSION)); 

    $newImageName = $newTime ."_". 'company_logo' . "." .$imageFileType;  //Generate New Image name    
    $newImageName2 = $newTime ."_". 'company_banner' . "." .$imageFileType2;  //Generate New Image name    

    $target_dir_for_up_file = $target_dir . $newImageName; //Jekhane img ta rakhbo new name a
    $target_dir_for_up_file2 = $target_dir2 . $newImageName2; //Jekhane img ta rakhbo new name a
    
    $check = getimagesize($uploadImage_TempName);    
    $check2 = getimagesize($uploadImage_TempName2);    
    if($check !== false) {
        // $sucMsg = " File is an image, Extension- " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errMsg .= " File is not an image.";
        $uploadOk = 0;
    }
    if($check2 !== false) {
        // $sucMsg = " File is an image, Extension- " . $check["mime"] . ".";
        $uploadOk2 = 1;
    } else {
        $errMsg .= " File is not an image.";
        $uploadOk2 = 0;
    }

		// Check file size    
		if ($_FILES["imageUpload"]["size"] > 5242880) { //Nuber represent Byte
		    $errMsg .= " Your file is too large, Need less than 5MB.";
		    $uploadOk = 0;        
		}
    if ($_FILES["imageUpload2"]["size"] > 5242880) { //Nuber represent Byte
        $errMsg .= " Your file is too large, Need less than 5MB.";
        $uploadOk2 = 0;        
    }
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    $errMsg .= " Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
    if($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
    && $imageFileType2 != "gif" ) {
        $errMsg .= " Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk2 = 0;
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
              ak_img_resize($target_dir_for_up_file, $resized_file, $wmax, $hmax, $fileExt);
              
          }
		}



    if ($uploadOk2 == 0) {
        $errMsg .= " Your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {          
          $nameArr2 = explode(".", $uploadImage_BaseName2);
          $fileExt2 = end($nameArr2);
          // $moveResult = move_uploaded_file($uploadImage_TempName, $target_file);
          $moveResult2 = move_uploaded_file($uploadImage_TempName2, $target_dir_for_up_file2);

          if($moveResult2 !== true){
            echo "Image Not moved !";
          } else{
              $resized_file2 = $target_dir2 . $newImageName2;
              $wmax2 = 1130;
              $hmax2 = 160;
              function ak2_img_resize($gettingImg, $newcopy, $w, $h, $ext) {
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
              ak2_img_resize($target_dir_for_up_file2, $resized_file2, $wmax2, $hmax2, $fileExt2);

          }
    }


      // My db part              

      $sql = "INSERT INTO company (company_name, company_logo, company_banner) VALUES ('$company_name', '$newImageName','$newImageName2')";
      $result = $db->insert($sql);
      if ($result){
           // $sucMsg = 'Image inserted successfully !';
         $sucMsg = 'New comapny create successfully.';
      }
      else
      {
         $sucMsg = 'Company not create, Error From DB !';
      }
	}
	
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Company</title>
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
    .imgViewBanner{
      width: 100%;
      height: 100px;
      border: 2px solid #333;
      margin-bottom: 30px;
      box-shadow: 4px 4px 10px #555;
    }
    .inputCon2 label{
      width: 225px;
      float: left;
      color: #555;
      margin-bottom: 20px;
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
      <form action="" method="POST" enctype="multipart/form-data" onsubmit="return validation()">
        <div class="psContainer">
        	<h3 class="text-center bg-primary" style="margin-top: 0px; padding: 5px;">Create a new company</h3>
        	<div class="form-group">
            <label>Company Name: </label>
            <input type="text" name="company_name" class="form-control" placeholder="Enter company name..." id="company_name">
          </div>

          <div class="inputCon">
        		<label>Select Company Logo: </label>
        		<input type="file" name="imageUpload" id="imgFile" onchange="loadFile(event)">       		
        	</div>
        	<img src="../img/user_photo/default_user_photo.jpg" class="imgView" id="imgShowId"/>
        	
          <div class="inputCon2">
            <label>Select Company Banner Image: </label>
            <input type="file" name="imageUpload2" id="imgFile2" onchange="loadFile2(event)">          
          </div>
          <img src="../img/banner/default_banner_img.jpg" class="imgViewBanner" id="imgShowId2"/>
        	



        	<input type="submit" name="submit" value="Create  Company" class="btn btn-block btn-primary">
        	

        	<div class="text-success" style="font-size: 16px;"><?php if($sucMsg !== ''){echo '<br/>'. $sucMsg; } ?></div>
        	<div class="text-danger" id ="errMsgId" style="font-size: 16px;"><?php if($errMsg !== ''){echo '<br/>'. $errMsg; } ?></div>
        </div>
      </form>


      
    </div>

  <script>
		var loadFile = function(event) {
			var imgShowId = document.getElementById('imgShowId');
      imgShowId.src = URL.createObjectURL(event.target.files[0]);			
		};
    var loadFile2 = function(event) {
      var imgShowId = document.getElementById('imgShowId2');
      imgShowId.src = URL.createObjectURL(event.target.files[0]);     
    };

		function validation(){
		  	var validRetrun = false;
		  	var imgFile = $('#imgFile').val();
        var imgFile2 = $('#imgFile2').val();
        var company_name = $('#company_name').val();
		  	// alert(imgFile);

        if(company_name == ''){
          validRetrun = false;
          $('#company_name').focus();
          $('#errMsgId').html('Company name cannt be empty !').css({'text-align':'center', 'margin-top' : '15px'});
        } else if ($.isNumeric(company_name)){
          validRetrun = false;
          $('#company_name').focus();
          $('#errMsgId').html('Company name cannt be a Number !').css({'text-align':'center', 'margin-top' : '15px'});
        } else if (company_name.length > 100) {
          validRetrun = false;
          $('#company_name').focus();
          $('#errMsgId').html('Company name must within 100 character !').css({'text-align':'center', 'margin-top' : '15px'});
        } else {
          if(imgFile == ''){
            validRetrun = false;
            $('#errMsgId').html('Please select company logo !').css({'text-align':'center', 'margin-top' : '15px'});
          } else{
            if(imgFile2 == ''){
              validRetrun = false;
              $('#errMsgId').html('Please select company banner !').css({'text-align':'center', 'margin-top' : '15px'});
            } else{
              validRetrun = true;
            }
          }
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