<?php 
  session_start();
  if(!isset($_SESSION['username'])){
      header('location:../index.php');
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  

    //Start Sql For Summary 500W/60G
        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '04.50 mm' OR mm = '04.50mm')";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $mm0450_rod500 = $row['kg'];
                if(is_null($mm0450_rod500)){
                    $mm0450_rod500 = 0;
                }
            }
        } else{
            $mm0450_rod500 = 0;
        }


        $mm6_rod500 = 0;
        $mm8_rod500 = 0;
        $mm10_rod500 = 0;
        $mm12_rod500 = 0;
        $mm16_rod500 = 0;
        $mm20_rod500 = 0;
        $mm25_rod500 = 0;
        $mm32_rod500 = 0;
        $mm42_rod500 = 0;

        $mmRodArry = array(6,8,10,12,16,20,25,32,42);
        $arrlength = count($mmRodArry);

        for($i=0; $i<$arrlength; $i++){
            // echo $mmRodArry[$i];
            // echo "<br>";

            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%500W%' AND (mm = '$mmRodArry[$i] mm' OR mm = '$mmRodArry[$i]mm')";
            $result = $db->select($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    ${"mm$mmRodArry[$i]_rod500"} = $row['kg'];
                    if(is_null(${"mm$mmRodArry[$i]_rod500"})){
                        ${"mm$mmRodArry[$i]_rod500"} = 0;
                    }
                }
            } else{
                ${"mm$mmRodArry[$i]_rod500"} = 0;
            }
        }
        $total_kg_rod500 = $mm0450_rod500 + $mm6_rod500 + $mm8_rod500 + $mm10_rod500 + $mm12_rod500 + $mm16_rod500 + $mm20_rod500 + $mm25_rod500 + $mm32_rod500 + $mm42_rod500;
    //End Sql For Summary 500W/60G

    //Start Sql For Summary 400W/60G
        $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '04.50 mm' OR mm = '04.50mm')";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $mm0450_rod400 = $row['kg'];
                if(is_null($mm0450_rod400)){
                    $mm0450_rod400 = 0;
                }
            }
        } else{
            $mm0450_rod400 = 0;
        }


        $mm6_rod400 = 0;
        $mm8_rod400 = 0;
        $mm10_rod400 = 0;
        $mm12_rod400 = 0;
        $mm16_rod400 = 0;
        $mm20_rod400 = 0;
        $mm25_rod400 = 0;
        $mm32_rod400 = 0;
        $mm42_rod400 = 0;

        $mmRodArry2 = array(6,8,10,12,16,20,25,32,42);
        $arrlength2 = count($mmRodArry2);

        for($j=0; $j<$arrlength2; $j++){
            // echo $mmRodArry2[$j];
            // echo "<br>";

            $sql = "SELECT SUM(kg) as kg FROM details WHERE particulars LIKE '%400W%' AND (mm = '$mmRodArry2[$j] mm' OR mm = '$mmRodArry2[$j]mm')";
            $result = $db->select($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    ${"mm$mmRodArry2[$j]_rod400"} = $row['kg'];
                    if(is_null(${"mm$mmRodArry2[$j]_rod400"})){
                        ${"mm$mmRodArry2[$j]_rod400"} = 0;
                    }
                }
            } else{
                ${"mm$mmRodArry2[$j]_rod400"} = 0;
            }
        }
        $total_kg_rod400 = $mm0450_rod400 + $mm6_rod400 + $mm8_rod400 + $mm10_rod400 + $mm12_rod400 + $mm16_rod400 + $mm20_rod400 + $mm25_rod400 + $mm32_rod400 + $mm42_rod400;
    //End Sql For Summary 400W/60G


    //Start Total para/mot_mul_khoros_shoho
        $sql = "SELECT SUM(total_paras) as total_paras FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_paras = $row['total_paras'];
                if(is_null($total_paras)){
                    $total_paras = 0;
                }
            }
        } else{
            $total_paras = 0;
        }
    //End Total para/mot_mul_khoros_shoho
    // Start total total_Balance/mot_jer
        $sql = "SELECT SUM(balance) as balance FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_balance = $row['balance'];
                if(is_null($total_balance)){
                    $total_balance = 0;
                }
            }
        } else{
            $total_balance = 0;
        }
    // End total total_Balance/mot_jer
    // Start total total_debit/joma
        $sql = "SELECT SUM(debit) as debit FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_debit = $row['debit'];
                if(is_null($total_debit)){
                    $total_debit = 0;
                }
            }
        } else{
            $total_debit = 0;
        }
    // End total total_debit/joma
    // Start total total_credit/mot_mul
        $sql = "SELECT SUM(credit) as credit FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_credit = $row['credit'];
                if(is_null($total_credit)){
                    $total_credit = 0;
                }
            }
        } else{
            $total_credit = 0;
        }
    // End total total_credit/mot_mul
    // Start total total_kg
        $sql = "SELECT SUM(kg) as kg FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_kg = $row['kg'];
                if(is_null($total_kg)){
                    $total_kg = 0;
                }
            }
        } else{
            $total_kg = 0;
        }
        $total_ton = $total_kg/100;
    // End total total_kg
    // Start total total_motor
        $sql = "SELECT SUM(motor) as motor FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $total_motor = $row['motor'];
                if(is_null($total_motor)){
                    $total_motor = 0;
                }
            }
        } else{
            $total_motor = 0;
        }
    // End total total_motor
    $nij_paona = $total_debit - $total_credit;

    //Start GB Bank Ganti
        $sql = "SELECT SUM(debit) as debit FROM details WHERE particulars = 'BG'";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $gb_bank_ganti = $row['debit'];
                if(is_null($gb_bank_ganti)){
                    $gb_bank_ganti = 0;
                }
            }
        } else{
            $gb_bank_ganti = 0;
        }
        $company_paona = ($total_debit - $total_credit) - $gb_bank_ganti;
    //End GB Bank Ganti




    //Start Dealer customer info
        $query = "SELECT * FROM dealers WHERE id = '10'";
        $result = $db->select($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $id             = $row['id'];
                $dealer_id      = $row['dealer_id'];
                $dealer_name    = $row['dealer_name'];
                $address        = $row['address'];
                $contact_person_name = $row['contact_person_name'];
                $mobile              = $row['mobile'];
                
            }
        } else{
            echo "Dealer id 10 not found.";
        }


        $query = "SELECT * FROM customers WHERE id = '16'";
        $result = $db->select($query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $id               = $row['id'];
                $customer_id      = $row['customer_id'];
                $customer_name    = $row['customer_name'];
                $customer_address = $row['address'];
                $custpmer_mobile  = $row['mobile'];
                $buying_type      = $row['buying_type'];
                
            }
        } else{
            echo "Dealer id 10 not found.";
        }
    //End Dealer customer info
    
    //Start Gari vara
        $sql = "SELECT SUM(motor_cash) as motor_cash FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $motor_cash = $row['motor_cash'];
                if(is_null($motor_cash)){
                    $motor_cash = 0;
                }
            }
        } else{
            $motor_cash = 0;
        }
    //End Gari vara

    //Start khalas/Unload
        $sql = "SELECT SUM(unload) as unload FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $unload = $row['unload'];
                if(is_null($unload)){
                    $unload = 0;
                }
            }
        } else{
            $unload = 0;
        }
    //End khalas/Unload
    //Start All kg adding
        $sql = "SELECT SUM(kg) as kg FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_kg = $row['kg'];
                if(is_null($all_kg)){
                    $all_kg = 0;
                }
            }
        } else{
            $all_kg = 0;
        }
    //End All kg adding
    //Start All paras adding
        $sql = "SELECT SUM(paras) as paras FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_paras = $row['paras'];
                if(is_null($all_paras)){
                    $all_paras = 0;
                }
            }
        } else{
            $all_paras = 0;
        }
    //End All paras adding
    //Start All discount adding
        $sql = "SELECT SUM(discount) as discount FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_discount = $row['discount'];
                if(is_null($all_discount)){
                    $all_discount = 0;
                }
            }
        } else{
            $all_discount = 0;
        }
    //End All discount adding
    //Start All debit adding
        $sql = "SELECT SUM(debit) as debit FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_debit = $row['debit'];
                if(is_null($all_debit)){
                    $all_debit = 0;
                }
            }
        } else{
            $all_debit = 0;
        }
    //End All debit adding
    $mul = ($all_kg * $all_paras - $all_discount) - $all_debit;
    //Start All bundil adding
        $sql = "SELECT SUM(bundil) as bundil FROM details";
        $result = $db->select($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $all_bundil = $row['bundil'];
                if(is_null($all_bundil)){
                    $all_bundil = 0;
                }
            }
        } else{
            $all_bundil = 0;
        }
    //End All bundil adding
?>



<!DOCTYPE html>
<html>
<head>
    <title>রড হিসাব সারাংশ</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/voucher.css">

  


    <style type="text/css">

        #detailsNewTable1{
          margin-left: 1px;
          width: 217%;
          /*transform: rotateX(180deg);*/
        }
        #detailsNewTable1 td{
            border: 1px solid #333;
            padding: 2px 3px;

        }
        .tables2Condiv{
            width: 100%;
            overflow-x: auto;
            margin-bottom: 50px;
        }
        .tables1Condiv{
            width: 100%;
            overflow: auto;
            /*background-color: #ddd;*/
            /*height: 500px;*/
            /*transform: rotateX(180deg);*/
            padding: 10px;
            margin-bottom: 50px;
        }
        #detailsNewTable2{
          width: 217%;
          border: 1px solid #333;
          /*transform: rotateX(180deg);*/
        }
        #detailsNewTable2 th, td{
          border: 1px solid #333;
          padding: 0px 5px;
        }
        #detailsNewTable2 tr:first-child th{
            text-align: center;
            background-color: #8f0000;
            color: #fff;
            padding: 5px 0px;
        }
        #detailsNewTable2 tr:nth-child(2) th{
            text-align: center;
            background-color: #009e07;
            padding: 5px 0px;
            color: #fff;
        }

        .searchCon{
            width: 100%;
            margin-bottom: 10px;            
        }
        .searchCon p{
            margin-bottom: 5px;
            padding-left: 10px;
        }
        .otherSearchCon{
            width: 100%;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .dateSearch{
            width: 172px;
        }
        .bootstrap-select{
            width: 130px !important;
        }
    </style>
</head>
<body>
    <?php
      include '../navbar/header_text.php';
      $page = 'rod_hisab';
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
  				</div>
  			<?php 
  				}
  			} 
  		?>

        <div class="searchCon">
            <p><b>Search By:</b></p>
            <div class="otherSearchCon">
                
                <div class="dateSearch"> 
                <b>Date:</b>                   
                    <select class="selectpicker" data-style="btn-info" id="dateSearchList"">
                        <option value="alldates">All dates</option>
                        <?php
                            $sql = "SELECT DISTINCT dates FROM details ORDER BY dates ASC";
                            $result = $db->select($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $dates = $row['dates'];
                                    $newDate = date("d-m-Y", strtotime($dates));
                                    // echo $newDate;
                                    if($dates == '0000-00-00'){
                                    
                                    } else {
                                        echo '<option value="'.$newDate.'">'. $newDate .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>



      <div class="tables1Condiv" id="tables1Condiv">
          <table id="detailsNewTable1">
              <tr>
                <td class="ntfc1 noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc3 noborderk"></td>
                <td class="ntfc4 noborderk"></td>
                <td class="ntfc5 noborderk"></td>

                <td class="ntfc6" width="160px">04.50mm 500W/60G</td>
                <td><?php echo $mm0450_rod500; ?></td>
                <td class="ntfc8" width="160px">04.50mm 400W/60G</td>
                <td><?php echo $mm0450_rod400; ?></td>
                

                <td colspan="6" rowspan="2" class="ntHeading noborderk"><?php echo $dealer_name; ?></td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td colspan="2" class="twodate">01.2016 & 12.2016</td>
                <!-- <td></td> -->
                <td class="noborderk" width="100px"></td>
                <td class="ntfc18 noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc20 noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc22 noborderk"></td>
                <td class="align-center">Logout</td>
              </tr>
              <!-- 2nd row -->
              <tr>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc5 noborderk"></td>

                <td>06mm 500W/60G</td>
                <td><?php echo $mm6_rod500; ?></td>
                <td>06mm 400W/60G</td>
                <td><?php echo $mm6_rod400; ?></td>
                
                <!-- <td colspan="6"></td> -->
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td align="right">জিবি ব্যাংক গ্যান্টিঃ</td>
                <td><?php echo $gb_bank_ganti; ?></td>
                <td class="noborderk"></td>
                <td align="right">মোট কেজিঃ</td>
                <td><?php echo $total_kg; ?></td>
                <td align="right">মোট মূলঃ</td>
                <td><?php echo $total_credit; ?></td>
                <td align="right">Password</td>
                <td></td>
              </tr>
              <!-- 3rd row -->
              <tr>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc5 noborderk"></td>

                <td>08mm 500W/60G</td>
                <td><?php echo $mm8_rod500; ?></td>
                <td>08mm 400W/60G</td>
                <td><?php echo $mm8_rod400; ?></td>
                

                <td colspan="6" class="ntsubHeading noborderk"><?php echo $buying_type; ?></td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
              </tr>
              <!-- 4th row -->
              <tr>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc5 noborderk"></td>

                <td>10mm 500W/60G</td>
                <td><?php echo $mm10_rod500; ?></td>
                <td>10mm 400W/60G</td>
                <td><?php echo $mm10_rod400; ?></td>

                
                <td colspan="6" class="align-center noborderk"><?php echo $contact_person_name; ?></td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td align="right">কম্পানি পাওনাঃ</td>
                <td><?php echo $company_paona; ?></td>
                <td class="noborderk"></td>
                <td align="right">মোট টোনঃ</td>
                <td><?php echo round($total_ton,2); ?></td>
                <td align="right">মোট জমাঃ</td>
                <td><?php echo $total_debit; ?></td>
                <td align="right">মোট মূল খরচ সহঃ</td>
                <td><?php echo $total_paras; ?></td>
              </tr>
              <!-- 5th row -->
              <tr>
                <td align="right">গাড়ী ভাড়া</td>
                <td width="100px"><?php echo $motor_cash; ?></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc5 noborderk"></td>

                <td>12mm 500W/60G</td>
                <td><?php echo $mm12_rod500; ?></td>
                <td>12mm 400W/60G</td>
                <td><?php echo $mm12_rod400; ?></td>
                
                <td colspan="6" class="align-center noborderk"><?php echo $address; ?></td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
              </tr>
              <!-- 6th row -->
              <tr>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc5 noborderk"></td>

                <td>16mm 500W/60G</td>
                <td><?php echo $mm16_rod500; ?></td>
                <td>16mm 400W/60G</td>
                <td><?php echo $mm16_rod400; ?></td>
                
                <td colspan="6" class="align-center noborderk">Customer ID: <b><?php echo $customer_id; ?></b></td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td align="right">নিজ পাওনাঃ</td>
                <td><?php echo $nij_paona; ?></td>
                <td class="noborderk"></td>
                <td align="right">মোট গাড়ীঃ</td>
                <td><?php echo $total_motor; ?></td>
                <td align="right">মোট জেরঃ</td>
                <td><?php echo $total_balance; ?></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
              </tr>
              <!-- 7th row -->
              <tr>
                <td align="right">খালাস</td>
                <td><?php echo $unload; ?></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc5 noborderk"></td>

                <td>20mm 500W/60G</td>
                <td><?php echo $mm20_rod500; ?></td>
                <td>20mm 500W/60G</td>
                <td><?php echo $mm20_rod400; ?></td>
                
                <td colspan="6" class="noborderk"></td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
              </tr>
              <!-- 8th row -->
              <tr>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="ntfc5 noborderk"></td>

                <td>25mm 500W/60G</td>
                <td><?php echo $mm25_rod500; ?></td>
                <td>25mm 400W/60G</td>
                <td><?php echo $mm25_rod400; ?></td>
                
                <td colspan="5" class="noborderk"></td>
                <td class="ntDelearid" align="right">ডিলার আই ডিঃ</td>
                
                <td align="center">
                    <?php
                        $sql = "SELECT DISTINCT dealer_id FROM details";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 100px;" id="dealerId2">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $info_dealer_id = $row['dealer_id'];
                                    if($info_dealer_id == ''){
                                    
                                    } else {
                                        echo '<option value="'.$info_dealer_id.'">'. $info_dealer_id .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">ঠিকানাঃ</td>
                <td align="center">
                    <?php
                        $sql = "SELECT DISTINCT address FROM details";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 100px;" id="rodAddressList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $info_address = $row['address'];
                                    if($info_address == ''){
                                    
                                    } else {
                                        echo '<option value="'.$info_address.'">'. $info_address .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">ক্রমিক নংঃ</td>
                <td align="center">
                    <?php
                        $sql = "SELECT DISTINCT sl_no FROM details";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 100%;" id="cromicNoList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $info_sl_no = $row['sl_no'];
                                    if($info_sl_no == ''){
                                    
                                    } else {
                                        echo '<option value="'.$info_sl_no.'">'. $info_sl_no .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">ভাউচার নংঃ</td>
                <td align="center">
                    <?php
                        $sql = "SELECT DISTINCT delivery_no FROM details";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 100%;" id="vaucherNoList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $info_delivery_no = $row['delivery_no'];
                                    if($info_delivery_no == ''){
                                    
                                    } else {
                                        echo '<option value="'.$info_delivery_no.'">'. $info_delivery_no .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">গাড়ীঃ</td>
                <td><?php echo $total_motor; ?></td>
              </tr>
              <!-- 9th row -->
              <tr>
                <td colspan="2" align="right">মালের বিবরণ</td>
                <!-- <td></td> -->
                <td colspan="2" align="center">
                    <?php
                        $sql = "SELECT information FROM details WHERE information IS NOT NULL";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 140px;" id="malerBiboronList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){

                                while($row = $result->fetch_assoc()){
                                    $info = $row['information'];
                                    if($info == ''){
                                    
                                    } else {
                                        echo '<option value="'.$info.'">'. $info .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <!-- <td></td> -->
                <td class="ntfc5 noborderk"></td>

                <td>32mm 500W/60G</td>
                <td><?php echo $mm32_rod500; ?></td>
                <td>32mm 400W/60G</td>
                <td><?php echo $mm32_rod400; ?></td>
                
                <td colspan="5" class="noborderk"></td>
                <td class="noborderk"></td>
                <!-- <td></td>
                <td></td>
                <td></td>
                <td></td> -->

                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
              </tr>
              <!-- 10th row -->
              <tr>
                <td colspan="2" class="noborderk"></td>
                <!-- <td></td> -->
                <td colspan="2" class="noborderk"></td>
                <!-- <td></td> -->
                <td class="ntfc5" class="noborderk"></td>

                <td>42mm 500W/60G</td>
                <td><?php echo $mm42_rod500; ?></td>
                <td>42mm 400W/60G</td>
                <td><?php echo $mm42_rod400; ?></td>
                
                <td class="ntopeningDate" align="right" width="120px">Opening Date:</td>
                <td class="ntopeningDate">
                    <?php
                        $sql = "SELECT DISTINCT dates FROM details ORDER BY dates ASC LIMIT 2";
                        $result = $db->select($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $last_dates = $row['dates'];
                                    if($last_dates == '0000-00-00'){
                                        
                                    } else {
                                        $postDateArr    = explode('-', $last_dates);
                                        $new_last_dates  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
                                        echo $new_last_dates;
                                    }
                                }

                            } else{
                                echo 'Not Found';
                            }
                    ?>
                </td>
                <td class="ntEmptyCollumn noborderk" ></td>
                <td class="ntGarino" align="right">গাড়ী নাম্বারঃ</td>
                <td class="ntGarino" align="center">
                    <?php
                        $sql = "SELECT DISTINCT motor_no FROM details WHERE motor_no IS NOT NULL";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 140px;" id="gariNumersList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){

                                while($row = $result->fetch_assoc()){
                                    $info_motor_no = $row['motor_no'];
                                    if($info_motor_no == ''){
                                    
                                    } else {
                                        echo '<option value="'.$info_motor_no.'">'. $info_motor_no .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">ডেলিভারী তারিখঃ</td>

                <td align="center">
                    <?php
                        $sql = "SELECT DISTINCT delivery_date FROM details ORDER BY delivery_date ASC";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 120px;" id="deliveryDatesList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $info_delivery_date = $row['delivery_date'];
                                    if($info_delivery_date == '0000-00-00'){
                                    
                                    } else {
                                        $DateArr    = explode('-', $info_delivery_date);
                                        $ordered_delivery_date  = $DateArr['2'].'-'.$DateArr['1'].'-'.$DateArr['0'];
                                        echo '<option value="'.$ordered_delivery_date.'">'. $ordered_delivery_date .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">তারিখঃ</td>
                <td align="center">
                    <?php
                        $sql = "SELECT DISTINCT dates FROM details ORDER BY dates ASC";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 100px;" id="rodDatesList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $info_dates = $row['dates'];
                                    if($info_dates == '0000-00-00'){
                                    
                                    } else {
                                        $postDateArr    = explode('-', $info_dates);
                                        $ordered_dates  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
                                        echo '<option value="'.$ordered_dates.'">'. $ordered_dates .'</option>';
                                    }
                                }

                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">মারফোত নামঃ</td>
                <td align="center">
                    <?php
                        $sql = "SELECT DISTINCT partculars FROM details";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 100px;" id="marfotNameList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $info_partculars = $row['partculars'];
                                    if($info_partculars == ''){
                                    
                                    } else {
                                        echo '<option value="'.$info_partculars.'">'. $info_partculars .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">বিবরণঃ</td>
                <td align="center">
                    <?php
                        $sql = "SELECT DISTINCT particulars FROM details";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 100px;" id="biboronsList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $info_particulars = $row['particulars'];
                                    if($info_particulars == ''){
                                    
                                    } else {
                                        echo '<option value="'.$info_particulars.'">'. $info_particulars .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">জমা টাকাঃ</td>
                <td><?php echo $all_debit; ?></td>
              </tr>
              <!-- 11th row -->
              <tr>
                <td colspan="2" align="right">ডিলার আই ডি</td>
                <!-- <td></td> -->
                <td colspan="2" align="center">
                    <?php
                        $sql = "SELECT DISTINCT dealer_id FROM details";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 140px;" id="dealerId1">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $dealer_id = $row['dealer_id'];
                                    if($dealer_id == ''){
                                    
                                    } else {
                                        echo '<option value="'.$dealer_id.'">'. $dealer_id .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <!-- <td></td> -->
                <td class="ntfc5 noborderk"></td>

                <td class="noborderk"></td>
                <td></td>
                <td class="noborderk"></td>
                <td></td>
                
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>

                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
                <td class="noborderk"></td>
              </tr>
              <!-- 12th row -->
              <tr>
                <td colspan="2" class="noborderk"></td>
                <!-- <td></td> -->
                <td colspan="2" class="noborderk"></td>
                <!-- <td></td> -->
                <td class="ntfc5 noborderk"></td>

                <td align="right">Total Kg:</td>
                <td><?php echo $total_kg_rod500; ?></td>
                <td align="right">Total Kg:</td>
                <td><?php echo $total_kg_rod400; ?></td>
                
                <td align="right">Last Tr. Date:</td>
                <td>
                    <?php
                        $sql = "SELECT DISTINCT dates FROM details ORDER BY dates DESC LIMIT 1";
                        $result = $db->select($sql);
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $last_dates = $row['dates'];
                                    if($last_dates == '0000-00-00'){
                                        echo 'Not Found';
                                    } else {
                                        $postDateArr    = explode('-', $last_dates);
                                        $new_last_dates  = $postDateArr['2'].'-'.$postDateArr['1'].'-'.$postDateArr['0'];
                                        echo $new_last_dates;
                                    }
                                }

                            } else{
                                echo 'Not Found';
                            }
                    ?>
                </td>
                <td class="noborderk"></td>
                <td align="right">মিমিঃ</td>
                <td align="center">
                    <?php
                        $sql = "SELECT DISTINCT mm FROM details WHERE mm IS NOT NULL";
                        $result = $db->select($sql);
                        echo '<select style="min-width: 140px;" id="milimetersList">';
                            echo '<option value="none">Select...</option>';
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $info_mm = $row['mm'];
                                    if($info_mm == ''){
                                    
                                    } else {
                                        echo '<option value="'.$info_mm.'">'. $info_mm .'</option>';
                                    }
                                }
                            } else{
                                echo '<option value="">Not Found</option>';
                            }
                        echo '</select>';
                    ?>
                </td>
                <td align="right">কেজিঃ</td>

                <td><?php echo $all_kg; ?></td>
                <td align="right">দরঃ</td>
                <td><?php echo $all_paras; ?></td>
                <td align="right">কমিশনঃ</td>
                <td><?php echo $all_discount; ?></td>
                <td align="right">মূলঃ</td>
                <td><?php echo $mul; ?></td>
                <td align="right">বান্ডিলঃ</td>
                <td><?php echo $all_bundil; ?></td>
              </tr>
          </table>
          <br>



          <table id="detailsNewTable2" >
              <tr>
                <th>Customer ID:</th>
                <th>DEALER ID:</th>
                <th>Motor Cash</th>
                <th>Unload</th>
                <th>Cars rent & Redeem</th>
                <th>Information</th>

                <th class="dntSpace"></th>

                
                <th>Address</th>
                <th>SL</th>
                <th>Delivery No:</th>
                <th>Motor</th>
                <th>Motor No</th>
                <th>Delivery Date</th>
                <th>Date</th>
                <th>Partculars</th>
                <th>Particulars</th>
                <th>Debit</th>
                <th>mm</th>
                <th>Kg</th>
                <th>Para's:</th>
                <th>Credit</th>
                <th>Discount</th>
                <th>Balance</th>
                <th>Bundil</th>
                <th>Total Para's:</th>
              </tr>
              <tr>
                    <th>কাষ্টমার আই ডি</th>
                    <th>ডিলার আই ডি</th>
                    <th>গাড়ী ভাড়া</th>
                    <th>আনলোড</th>
                    <th>গাড়ী ভাড়া ও খালাস</th>
                    <th>মালের বিবরণ</th>

                    <th class="dntSpace"></th>

                    
                    <th>ঠিকানা</th>
                    <th>ক্রমিক নং</th>
                    <th>ভাউচার নং</th>
                    <th>গাড়ী</th>
                    <th>গাড়ী নাম্বার</th>
                    <th>ডেলিভারী তারিখ</th>
                    <th>তারিখ</th>
                    <th>মারফোত নাম</th>
                    <th>বিবরণ</th>
                    <th>জমা টাকা</th>
                    <th>মিমি</th>
                    <th>কেজি</th>
                    <th>দর</th>
                    <th>মূল</th>
                    <th>কমিশন</th>
                    <th>অবশিষ্ট</th>
                    <th>বান্ডিল</th>
                    <th>মোট দামঃ</th>
              </tr>
              <?php
                    $sqlx ="SELECT * FROM details";
                    $resultx = $db->select($sqlx);
                    if ($resultx) {
                        while ($rows = $resultx->fetch_assoc()) {
                            if($rows['delivery_date'] == '0000-00-00'){
                                $format_delivery_date = '';
                            } 
                            else{
                                $delivery_date = $rows['delivery_date'];
                                $format_delivery_date = date("d-m-Y", strtotime($delivery_date));
                            }
                            if($rows['dates'] == '0000-00-00'){
                                $format_dates = '';
                            } 
                            else{
                                $dates = $rows['dates'];
                                $format_dates = date("d-m-Y", strtotime($dates));
                            }
                            echo "<tr>";
                            echo "<td>". $rows['customer_id'] ."</td>";
                            echo "<td>". $rows['dealer_id'] ."</td>";
                            echo "<td>". $rows['motor_cash'] ."</td>";
                            echo "<td>". $rows['unload'] ."</td>";
                            echo "<td>". $rows['cars_rent_redeem'] ."</td>";
                            echo "<td>". $rows['information'] ."</td>";
                            
                            echo '<td class="dntSpace"></td>';

                            echo "<td>". $rows['address'] ."</td>";
                            echo "<td>". $rows['sl_no'] ."</td>";
                            echo "<td>". $rows['delivery_no'] ."</td>";
                            echo "<td>". $rows['motor'] ."</td>";
                            echo "<td>". $rows['motor_no'] ."</td>";
                            echo "<td>". $format_delivery_date ."</td>";
                            echo "<td>". $format_dates ."</td>";
                            echo "<td>". $rows['partculars'] ."</td>";
                            echo "<td>". $rows['particulars'] ."</td>";
                            echo "<td>". $rows['debit'] ."</td>";
                            echo "<td>". $rows['mm'] ."</td>";
                            echo "<td>". $rows['kg'] ."</td>";
                            echo "<td>". $rows['paras'] ."</td>";
                            echo "<td>". $rows['credit'] ."</td>";
                            echo "<td>". $rows['discount'] ."</td>";
                            echo "<td>". $rows['balance'] ."</td>";
                            echo "<td>". $rows['bundil'] ."</td>";
                            echo "<td>". $rows['total_paras'] ."</td>";
                            echo "</tr>";                            
                        }
                    } 
              ?>
          </table>
      </div>




      <!-- <br><br><br><br><br>
      <div class="tables2Condiv">
            <table id="detailsNewTable2" >
              <tr>
                <th>Customer ID:</th>
                <th>DEALER ID:</th>
                <th>Motor Cash</th>
                <th>Unload</th>
                <th>Cars rent & Redeem</th>
                <th>Information</th>

                <th class="dntSpace"></th>

                
                <th>Address</th>
                <th>SL</th>
                <th>Delivery No:</th>
                <th>Motor</th>
                <th>Motor No</th>
                <th>Delivery Date</th>
                <th>Date</th>
                <th>Partculars</th>
                <th>Particulars</th>
                <th>Debit</th>
                <th>mm</th>
                <th>Kg</th>
                <th>Para's:</th>
                <th>Credit</th>
                <th>Discount</th>
                <th>Balance</th>
                <th>Bundil</th>
                <th>Total Para's:</th>
              </tr>
              <tr>
                    <th>কাষ্টমার আই ডি</th>
                    <th>ডিলার আই ডি</th>
                    <th>গাড়ী ভাড়া</th>
                    <th>আনলোড</th>
                    <th>গাড়ী ভাড়া ও খালাস</th>
                    <th>মালের বিবরণ</th>

                    <th class="dntSpace"></th>

                    
                    <th>ঠিকানা</th>
                    <th>ক্রমিক নং</th>
                    <th>ভাউচার নং</th>
                    <th>গাড়ী</th>
                    <th>গাড়ী নাম্বার</th>
                    <th>ডেলিভারী তারিখ</th>
                    <th>তারিখ</th>
                    <th>মারফোত নাম</th>
                    <th>বিবরণ</th>
                    <th>জমা টাকা</th>
                    <th>মিমি</th>
                    <th>কেজি</th>
                    <th>দর</th>
                    <th>মূল</th>
                    <th>কমিশন</th>
                    <th>অবশিষ্ট</th>
                    <th>বান্ডিল</th>
                    <th>মোট দামঃ</th>
              </tr>
              <?php
                    // $sql ="SELECT * FROM details";
                    // $result = $db->select($sql);
                    // if ($result) {
                    //     while ($rows = $result->fetch_assoc()) {
                    //         if($rows['delivery_date'] == '0000-00-00'){
                    //             $delivery_date = '';
                    //         } 
                    //         else{
                    //             $delivery_date = $rows['delivery_date'];
                    //         }
                    //         if($rows['dates'] == '0000-00-00'){
                    //             $dates = '';
                    //         } 
                    //         else{
                    //             $dates = $rows['dates'];
                    //         }
                    //         echo "<tr>";
                    //         echo "<td>". $rows['customer_id'] ."</td>";
                    //         echo "<td>". $rows['dealer_id'] ."</td>";
                    //         echo "<td>". $rows['motor_cash'] ."</td>";
                    //         echo "<td>". $rows['unload'] ."</td>";
                    //         echo "<td>". $rows['cars_rent_redeem'] ."</td>";
                    //         echo "<td>". $rows['information'] ."</td>";
                            
                    //         echo '<td class="dntSpace"></td>';

                    //         echo "<td>". $rows['address'] ."</td>";
                    //         echo "<td>". $rows['sl_no'] ."</td>";
                    //         echo "<td>". $rows['delivery_no'] ."</td>";
                    //         echo "<td>". $rows['motor'] ."</td>";
                    //         echo "<td>". $rows['motor_no'] ."</td>";
                    //         echo "<td>". $delivery_date ."</td>";
                    //         echo "<td>". $dates ."</td>";
                    //         echo "<td>". $rows['partculars'] ."</td>";
                    //         echo "<td>". $rows['particulars'] ."</td>";
                    //         echo "<td>". $rows['debit'] ."</td>";
                    //         echo "<td>". $rows['mm'] ."</td>";
                    //         echo "<td>". $rows['kg'] ."</td>";
                    //         echo "<td>". $rows['paras'] ."</td>";
                    //         echo "<td>". $rows['credit'] ."</td>";
                    //         echo "<td>". $rows['discount'] ."</td>";
                    //         echo "<td>". $rows['balance'] ."</td>";
                    //         echo "<td>". $rows['bundil'] ."</td>";
                    //         echo "<td>". $rows['total_paras'] ."</td>";
                    //         echo "</tr>";                            
                    //     }
                    // } 
              ?>
            </table>
            <br>
      </div> -->

    </div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript">
        function getDataByDates(datestr){
            $.ajax({
                url: '../ajaxcall/rod_search_by_dates.php',
                type: 'post',
                data: {
                    optionDate: datestr
                },
                success: function(res){
                    // alert(res);
                    $('#tables1Condiv').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThrown);
                }
            });
        }



        $(document).on('change', '#dateSearchList', function(){
            var optionText = $('#dateSearchList option:selected').val();
            // alert(optionText);
            if(optionText === 'alldates'){
                window.location.href = '../vaucher/rod_hisab_summary.php';
            } else {
                getDataByDates(optionText);
            }
        });
    </script>
    <script type="text/javascript">
        function getMalerBiborons(bName){
            $.ajax({
                url: '../ajaxcall/maler_biboron_search.php',
                type: 'post',
                data: {
                    biboronName: bName
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#malerBiboronList', function(){
            var biboronName = $('#malerBiboronList option:selected').val();
            // alert(biboronName);
            // if(biboronName === 'none'){
            //     // window.location.href = '../vaucher/rod_hisab_summary.php';
            // } else {
                getMalerBiborons(biboronName);
                // $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
                $("#dealerId1").val($("#dealerId1 option:visible:first").val());
                $("#dealerId2").val($("#dealerId2 option:visible:first").val());
                $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
                $("#milimetersList").val($("#milimetersList option:visible:first").val());
                $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
                $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
                $("#rodAddressList").val($("#rodAddressList option:visible:first").val());
                $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
                $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
                $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
                $("#biboronsList").val($("#biboronsList option:visible:first").val());

            // }
        });
    </script>
    <script type="text/javascript">
        function getDealerIds(id){
            $.ajax({
                url: '../ajaxcall/dealer_id_search.php',
                type: 'post',
                data: {
                    dealerId1: id
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#dealerId1', function(){
            var dealerId1 = $('#dealerId1 option:selected').val();
            // alert(dealerId1);
            getDealerIds(dealerId1);
            $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
            //$("#dealerId1").val($("#dealerId1 option:visible:first").val());
            $("#dealerId2").val($("#dealerId2 option:visible:first").val());
            $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
            $("#milimetersList").val($("#milimetersList option:visible:first").val());
            $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
            $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
            $("#rodAddressList").val($("#rodAddressList option:visible:first").val());
            $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
            $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
            $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
            $("#biboronsList").val($("#biboronsList option:visible:first").val());           
        });
        $(document).on('change', '#dealerId2', function(){
            var dealerId2 = $('#dealerId2 option:selected').val();
            // alert(dealerId2);
            getDealerIds(dealerId2);
            $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
            $("#dealerId1").val($("#dealerId1 option:visible:first").val());
            // $("#dealerId2").val($("#dealerId2 option:visible:first").val());
            $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
            $("#milimetersList").val($("#milimetersList option:visible:first").val());
            $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
            $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
            $("#rodAddressList").val($("#rodAddressList option:visible:first").val());
            $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
            $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
            $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
            $("#biboronsList").val($("#biboronsList option:visible:first").val());
        });
    </script>
    <script type="text/javascript">
        function getGariNumbers(num){
            $.ajax({
                url: '../ajaxcall/gari_numbers_search.php',
                type: 'post',
                data: {
                    gariNumber: num
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#gariNumersList', function(){
            var gariNumber = $('#gariNumersList option:selected').val();
            // alert(gariNumber);
            getGariNumbers(gariNumber);
                $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
                $("#dealerId1").val($("#dealerId1 option:visible:first").val());
                $("#dealerId2").val($("#dealerId2 option:visible:first").val());
                // $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
                $("#milimetersList").val($("#milimetersList option:visible:first").val());
                $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
                $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
                $("#rodAddressList").val($("#rodAddressList option:visible:first").val());
                $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
                $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
                $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
                $("#biboronsList").val($("#biboronsList option:visible:first").val());         
        });
    </script>
    <script type="text/javascript">
        function getMilimeters(mm){
            $.ajax({
                url: '../ajaxcall/milimeters_search.php',
                type: 'post',
                data: {
                    milimeter: mm
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#milimetersList', function(){
            var milimeter = $('#milimetersList option:selected').val();
            // alert(milimeter);
            getMilimeters(milimeter);
                $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
                $("#dealerId1").val($("#dealerId1 option:visible:first").val());
                $("#dealerId2").val($("#dealerId2 option:visible:first").val());
                $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
                // $("#milimetersList").val($("#milimetersList option:visible:first").val());
                $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
                $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
                $("#rodAddressList").val($("#rodAddressList option:visible:first").val());
                $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
                $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
                $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
                $("#biboronsList").val($("#biboronsList option:visible:first").val());           
        });
    </script>
    <script type="text/javascript">
        function getDeliveryDates(string){
            $.ajax({
                url: '../ajaxcall/delivery_dates_search.php',
                type: 'post',
                data: {
                    dateString: string
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#deliveryDatesList', function(){
            var dateString = $('#deliveryDatesList option:selected').val();
            // alert(dateString);
            getDeliveryDates(dateString); 
                $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
                $("#dealerId1").val($("#dealerId1 option:visible:first").val());
                $("#dealerId2").val($("#dealerId2 option:visible:first").val());
                $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
                $("#milimetersList").val($("#milimetersList option:visible:first").val());
                // $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
                $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
                $("#rodAddressList").val($("#rodAddressList option:visible:first").val());
                $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
                $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
                $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
                $("#biboronsList").val($("#biboronsList option:visible:first").val());           
        });
    </script>
    <script type="text/javascript">
        function getRodDates(string){
            $.ajax({
                url: '../ajaxcall/rod_dates_search.php',
                type: 'post',
                data: {
                    dateStr: string
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#rodDatesList', function(){
            var dateStr = $('#rodDatesList option:selected').val();
            // alert(dateStr);
            getRodDates(dateStr);
                $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
                $("#dealerId1").val($("#dealerId1 option:visible:first").val());
                $("#dealerId2").val($("#dealerId2 option:visible:first").val());
                $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
                $("#milimetersList").val($("#milimetersList option:visible:first").val());
                $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
                //$("#rodDatesList").val($("#rodDatesList option:visible:first").val());
                $("#rodAddressList").val($("#rodAddressList option:visible:first").val());
                $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
                $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
                $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
                $("#biboronsList").val($("#biboronsList option:visible:first").val());
        });
    </script>
    <script type="text/javascript">
        function getRodAddress(adrs){
            $.ajax({
                url: '../ajaxcall/rod_address_search.php',
                type: 'post',
                data: {
                    rodAddress: adrs
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#rodAddressList', function(){
            var address = $('#rodAddressList option:selected').val();
            // alert(address);
            getRodAddress(address);
                $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
                $("#dealerId1").val($("#dealerId1 option:visible:first").val());
                $("#dealerId2").val($("#dealerId2 option:visible:first").val());
                $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
                $("#milimetersList").val($("#milimetersList option:visible:first").val());
                $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
                $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
                // $("#rodAddressList").val($("#rodAddressList option:visible:first").val());
                $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
                $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
                $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
                $("#biboronsList").val($("#biboronsList option:visible:first").val());
        });
    </script>
    <script type="text/javascript">
        function getRodCromicNo(cno){
            $.ajax({
                url: '../ajaxcall/rod_cromic_no_search.php',
                type: 'post',
                data: {
                    cromicNo: cno
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#cromicNoList', function(){
            var cromicNo = $('#cromicNoList option:selected').val();
            // alert(cromicNo);
            getRodCromicNo(cromicNo);
            $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
            $("#dealerId1").val($("#dealerId1 option:visible:first").val());
            $("#dealerId2").val($("#dealerId2 option:visible:first").val());
            $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
            $("#milimetersList").val($("#milimetersList option:visible:first").val());
            $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
            $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
            $("#rodAddressList").val($("#rodAddressList option:visible:first").val());                
            // $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
            $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
            $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
            $("#biboronsList").val($("#biboronsList option:visible:first").val());
        });
    </script>
    <script type="text/javascript">
        function getMarfotName(name){
            $.ajax({
                url: '../ajaxcall/rod_marfot_name_search.php',
                type: 'post',
                data: {
                    marfotName: name
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#marfotNameList', function(){
            var marfotName = $('#marfotNameList option:selected').val();
            // alert(marfotName);
            getMarfotName(marfotName);
            $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
            $("#dealerId1").val($("#dealerId1 option:visible:first").val());
            $("#dealerId2").val($("#dealerId2 option:visible:first").val());
            $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
            $("#milimetersList").val($("#milimetersList option:visible:first").val());
            $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
            $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
            $("#rodAddressList").val($("#rodAddressList option:visible:first").val());                
            $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
            // $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
            $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
            $("#biboronsList").val($("#biboronsList option:visible:first").val());
        });
    </script>
    <script type="text/javascript">
        function getVaucherNo(no){
            $.ajax({
                url: '../ajaxcall/rod_vaucher_no_search.php',
                type: 'post',
                data: {
                    vaucherNo: no
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#vaucherNoList', function(){
            var vaucherNo = $('#vaucherNoList option:selected').val();
            // alert(vaucherNo);
            getVaucherNo(vaucherNo);
            $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
            $("#dealerId1").val($("#dealerId1 option:visible:first").val());
            $("#dealerId2").val($("#dealerId2 option:visible:first").val());
            $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
            $("#milimetersList").val($("#milimetersList option:visible:first").val());
            $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
            $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
            $("#rodAddressList").val($("#rodAddressList option:visible:first").val());                
            $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
            $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
            // $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
            $("#biboronsList").val($("#biboronsList option:visible:first").val());
        });
    </script>
    <script type="text/javascript">
        function getBiborons(b){
            $.ajax({
                url: '../ajaxcall/rod_biboron_search.php',
                type: 'post',
                data: {
                    biborons: b
                },
                success: function(res){
                    // alert(res);
                    $('#detailsNewTable2').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus, errorThown);
                }
            });
        }
        $(document).on('change', '#biboronsList', function(){
            var biborons = $('#biboronsList option:selected').val();
            // alert(biborons);
            getBiborons(biborons);
            $("#malerBiboronList").val($("#malerBiboronList option:visible:first").val());
            $("#dealerId1").val($("#dealerId1 option:visible:first").val());
            $("#dealerId2").val($("#dealerId2 option:visible:first").val());
            $("#gariNumersList").val($("#gariNumersList option:visible:first").val());
            $("#milimetersList").val($("#milimetersList option:visible:first").val());
            $("#deliveryDatesList").val($("#deliveryDatesList option:visible:first").val());
            $("#rodDatesList").val($("#rodDatesList option:visible:first").val());
            $("#rodAddressList").val($("#rodAddressList option:visible:first").val());                
            $("#cromicNoList").val($("#cromicNoList option:visible:first").val());
            $("#marfotNameList").val($("#marfotNameList option:visible:first").val());
            $("#vaucherNoList").val($("#vaucherNoList option:visible:first").val());
            // $("#biboronsList").val($("#biboronsList option:visible:first").val());
        });
    </script>
    <script type="text/javascript">
      $('.selectpicker').selectpicker();
    </script>
</body>
</html>