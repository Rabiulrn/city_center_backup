<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	$project_name_id = $_SESSION['project_name_id'];
	$edit_data_permission   = $_SESSION['edit_data'];
	$delete_data_permission = $_SESSION['delete_data'];

	$_SESSION['pageName'] = 'pathor_customer_entry';	
	$sucMsg = '';


  	$sql = "SELECT customer_id FROM customers_pathor ORDER BY id DESC LIMIT 1";
	$customersId = $db->select($sql);
	if($customersId->num_rows > 0){
		$row = $customersId->fetch_assoc();
		$largestId = $row['customer_id'];
	} else {
        $largestId = 'CTMR-100000';
    }
	$matches = preg_replace('/\D/', '', $largestId);
	$newNumber = $matches + 1;
	$newId = 'CTMR-' . $newNumber;

	$sucMsg ='';
	if(isset($_POST['submit'])){
		$submitBtn_value = $_POST['submit'];
		// echo $submitBtn_value;
		
		$customer_name	= trim($_POST['customer_name']);
		$address 		= trim($_POST['address']);
		$mobile 		= trim($_POST['mobile']);
		$buying_type	= trim($_POST['buying_type']);
		if($submitBtn_value == 'Save'){
			$customer_id	= $newId; //disabled not work it,  $_POST['customer_id']
			$sql="INSERT INTO customers_pathor (customer_id, customer_name, address, mobile, buying_type, project_name_id) VALUES ('$customer_id', '$customer_name', '$address', '$mobile', '$buying_type', '$project_name_id')";

			if ($db->select($sql) === TRUE) {
				$sql = "SELECT customer_id FROM customers_pathor ORDER BY id DESC LIMIT 1";
				$customersId = $db->select($sql);
				if($customersId->num_rows > 0){
					$row = $customersId->fetch_assoc();
					$largestId = $row['customer_id'];
				}
				$matches = preg_replace('/\D/', '', $largestId);
				$newNumber = $matches + 1;
				$newId = 'CTMR-' . $newNumber;
				
			    $sucMsg = "New Customer Saved Successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $db->error;
			}	
		} else{
			$customer_id = $_POST['customer_id'];
			$sql="UPDATE customers_pathor SET customer_name = '$customer_name', address = '$address', mobile = '$mobile', buying_type = '$buying_type' WHERE customer_id = '$customer_id'";

			if ($db->update($sql) === TRUE) {
			  $sucMsg = "Customer Updated Successfully";
			} else {
			  echo "Error: " . $sql . "<br>" . $db->error;
			}
		}
			
	}


	if(isset($_GET['remove_id'])){
	  	$customer_delete = $_GET['remove_id'];
		$sql = "DELETE FROM customers_pathor WHERE id = '$customer_delete'";
		if ($db->select($sql) === TRUE) {
			$sucDel = "Customer delete successfully.";
		} else {
			echo "Error: " . $sql . "<br>" .$db->error;
		}
	}
?>




<!DOCTYPE html>
<html>
<head>
	<title>পাথর কাষ্টমার এনট্রি</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
	<link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
	<link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">

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
	    .rodCustomerEnCon{
	    	position: relative;
	    	height: 157px;
	    	margin-bottom: 50px;
	    }
	    .showCustomerCon table{
	    	width: 100%;
	    	margin-bottom: 50px;
	    }
	    .showCustomerCon table tr th{
			border: 2px solid #ddd;
			text-align: center;
			padding: 5px 5px;
	    }
	    .showCustomerCon table tr td {
	    	border: 2px solid #ddd;
	    	padding: 2px 5px;
	    }
	    .customerEntryTable {
	    	width: 100%;
	    	/*margin-bottom: 10px;*/
	    }
	    .customerEntryTable tr th {
	    	border: 2px solid #ddd;
	    	padding: 4px 5px;
	    	text-align: center;
			background-color:#3e9309d4;
            Color: white;
	    }
	    .customerEntryTable tr td {
	    	border: 2px solid #ddd;
	    	padding: 2px;
			outline: none;
	    }
		.showCustomerCon table tr:nth-child(odd) td {
	    	border: 2px solid #ddd;
	    	padding: 2px 5px;
			/* text-align: center; */
            background-color: #d2df0d40;
            color: black;
	    }
	    .borderLess{
	    	border: none !important;
	    }
	    .backcircle{
		    font-size: 18px;
		    position: absolute;
		    margin-top: -20px;
		}
		.backcircle a:hover{
		    text-decoration: none !important;
		}
		#submitBtn{
			width: 100px;
			position: absolute;
			right: 0px;
		}									
	</style>
</head>
<body>
    <?php
		include '../navbar/header_text.php';
		// $page = 'rod_hisab';
		include '../navbar/navbar.php';
    ?>
    <div class="container">
		
		<!-- <div class="backcircle">
			<a href="../vaucher/rod_index.php">
				<img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
			</a>
		</div> -->
		
	</div>

		<div class="bar_con">
  		<div class="left_side_bar">  			
	  		<?php require '../others_page/left_menu_bar_pathor_hisab.php'; ?>
	  	</div>
	  	<div class="main_bar">
	  		<?php
                $ph_id = $_SESSION['project_name_id'];
                $query = "SELECT * FROM project_heading WHERE id = $ph_id";
                $show = $db->select($query);
                if ($show) {
                    while ($rows = $show->fetch_assoc()) {
                ?>
                    <div class="project_heading">      
                        <h2 class="headingOfAllProject">
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">কাস্টমার এন্ট্রি</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                            
                        </h2>
                    </div>
                <?php 
                    }
                } 
            ?>
	  		<!-- <h4 class="customer_header">Customer Entry</h4> -->
	  		<div class="rodCustomerEnCon">				
				<form action="" method="post" onsubmit="return validation()">
					<table class="customerEntryTable">
						<tr>
							<th width="130px">Customer Id</th>
							<th>Customer Name</th>
							<th>Address</th>
							<th>Mobile</th>
							<th>Buying Type</th>
						</tr>
						<tr>
							<td>
								<input type="text" class="form-control" id="customer_id" value="<?php echo $newId; ?>" disabled>
								<input type="hidden" name= "customer_id" id="customer_id_hidden" value="<?php echo $newId;; ?>">
							</td>
							<td>
								<input type="text" name = "customer_name" class="form-control" id="customer_name" placeholder="Enter customer name...">
							</td>
							<td>
							<!-- <input type="text" name = "address" class="form-control" id="address" placeholder="Enter Customer Address..."> -->
								 <textarea name = "address" class = "form-control" rows = "1" placeholder = "Enter customer address..." id='address' style="resize: none;"></textarea>
							</td>
							<td>
								<input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile no...">
							</td>
							<td>
								<input type="text" name="buying_type" class="form-control" id="buying_type" placeholder="Enter buying type...">
							</td>
						</tr>
						<tr>
							<td class="borderLess">							
							</td>
							<td class="borderLess">
								<h4 id="cNameErr" class="text-danger"></h4>
							</td>
							<td class="borderLess">
								<h4 id="addressErr" class="text-danger"></h4>
							</td>
							<td class="borderLess">
								<h4 id="mobileErr" class="text-danger"></h4>
							</td>
							<td class="borderLess">
								<h4 id="buyingTypeErr" class="text-danger"></h4>
							</td>
						</tr>
					</table>
					<h4 class="text-center text-success"><?php echo $sucMsg; ?></h4>					  	
				    <input type="submit" name="submit" id="submitBtn" class="btn btn-primary" value="Save">
				</form>
			</div>

			<div class="showCustomerCon">
				<table >
					<tr class="bg-primary">
						<th>Customer Id</th>
						<th>Customer Name</th>
						<th>Address</th>
						<th>Mobile</th>
						<th>Buying Type</th>
						<th>Delete</th>
						<th>Edit</th>
					</tr>
					<?php
						$sql = "SELECT * FROM customers_pathor WHERE project_name_id = '$project_name_id'";
						$show = $db->select($sql);
						if ($show) 
						{
							while ($rows = $show->fetch_assoc()){
								echo "<tr>";
									echo "<td>". $rows['customer_id'] . "</td>";
									echo "<td>". $rows['customer_name'] . "</td>";
									echo "<td>". $rows['address'] . "</td>";
									echo "<td>". $rows['mobile'] . "</td>";
									echo "<td>". $rows['buying_type'] . "</td>";
									
									if($delete_data_permission == 'yes'){
										echo "<td width='78px'><a class='btn btn-danger customerDelete' data_delete_id=" . $rows['id'] . ">Delete</a></td>";
									} else {
										echo '<td width="78px"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
									}
										
									if($edit_data_permission == 'yes'){
										echo "<td width='60px'><a class='btn btn-success' onclick='displayupdate(this)'>Edit</a></td>";
									} else {
										echo '<td width="60px"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
									}  
								echo "</tr>";
							}
						}
					?>

				</table>
			</div>
		</div>
  	</div>
  	<?php include '../others_page/delete_permission_modal.php';  ?>






	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		function validation(){
			// validReturn = false;
			var customer_name 	= $('#customer_name').val();
			var address 		= $('#address').val();
			var mobile 			= $('#mobile').val();
			var buying_type 	= $('#buying_type').val();
			// alert(category_name);
			var customer_name_valid = false;
			var address_valid 		= false; 
			var mobile_valid 		= false; 
			var buying_type_valid 	= false;

			if(customer_name == ''){
				$('#cNameErr').html('Customer name can not be empty !');
				$('#customer_name').focus();
			} else if(customer_name.length > 100){
				$('#cNameErr').html('Customer name can not greater than 100 characters !');
				$('#customer_name').focus();
			} else if($.isNumeric(customer_name)){
				$('#cNameErr').html('Customer name can not a number !');
				$('#customer_name').focus();
			} else{
				$('#cNameErr').html('');
				customer_name_valid = true;
			}

			if(address == ''){
				$('#addressErr').html('Address can not be empty !');
				$('#address').focus();
			} else if(address.length > 255){
				$('#addressErr').html('Address cant greater than 255 characters !');
				$('#address').focus();
			} else if($.isNumeric(address)){
				$('#addressErr').html('Customer name can not a number !');
				$('#address').focus();
			} else{
				$('#addressErr').html('');
				address_valid = true;
			}

			if(mobile == ''){
				$('#mobileErr').html('Mobile No. can not be empty !');
				$('#mobile').focus();
			} else if(mobile.length > 11){
				$('#mobileErr').html('Mobile can not greater than 11 characters !');
				$('#mobile').focus();
			}else if(mobile.length < 11){
				$('#mobileErr').html('Mobile can not less than 11 characters !');
				$('#mobile').focus();
			} else if(!$.isNumeric(mobile)){
				$('#mobileErr').html('Mobile Number must a number !');
				$('#mobile').focus();			
			} else{
				$('#mobileErr').html('');
				mobile_valid = true;
			}


			if(buying_type == ''){
				$('#buyingTypeErr').html('Buying Type can not be empty !');
				$('#buying_type').focus();
			} else if(buying_type.length > 100){
				$('#buyingTypeErr').html('Buying Type can not greater than 100 characters !');
				$('#buying_type').focus();
			} else if($.isNumeric(buying_type)){
				$('#buyingTypeErr').html('Buying Type can not be a number !');
				$('#buying_type').focus();
			} else{
				$('#buyingTypeErr').html('');
				buying_type_valid = true;
			}




			if(customer_name_valid && address_valid && mobile_valid && buying_type_valid){
				return true;
			} else{
				return false;
			}
		}
		
		function displayupdate(element){
			var td_id 		= $(element).closest('tr').find('td:eq(0)').text();
			var td_name 	= $(element).closest('tr').find('td:eq(1)').text();
			var td_addr 	= $(element).closest('tr').find('td:eq(2)').text();
			var td_mobile 	= $(element).closest('tr').find('td:eq(3)').text();
			var td_type 	= $(element).closest('tr').find('td:eq(4)').text();
			// alert(td_mobile);

			$('#customer_id').val(td_id);
			$('#customer_id_hidden').val(td_id);
			$('#customer_name').val(td_name);
			$('#address').val(td_addr);
			$('#mobile').val(td_mobile);
			$('#buying_type').val(td_type);
			$('#submitBtn').val('Update');

			$('#cNameErr').html('');
			$('#addressErr').html('');
			$('#mobileErr').html('');
			$('#buyingTypeErr').html('');

			$("html, body").animate({scrollTop: 0}, 500);
		}
	</script>
	<script type="text/javascript">
		$(document).on('click', '.customerDelete', function(event){          
			var remove_id = $(event.target).attr('data_delete_id');
			$("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
			$("#matchPassword").val('');
			$("#passMsg").html('');
			$("#verifyToDeleteBtn").attr("data_delete_id", remove_id);
		});
	    $(document).on('click', '#verifyToDeleteBtn', function(event){
	        event.preventDefault();
	        var remove_id = $(event.target).attr('data_delete_id');
	        console.log(remove_id);
	        $("#passMsg").html("").css({'margin':'0px'});          
			var pass = $("#matchPassword").val();
			$.ajax({
				url: "../ajaxcall/match_password_for_vaucher_credit.php",
				type: "post",
				data: { pass : pass },
				success: function (response) {
					// alert(response);
					if(response == 'password_matched'){
						$("#verifyPasswordModal").hide();
						ConfirmDialog('Are you sure delete customer info?');
					} else {
						$("#passMsg").html(response).css({'color':'red','margin-top':'10px'});
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});
	        
	        function ConfirmDialog(message){
	            $('<div></div>').appendTo('body')
	                            .html('<div><h4>'+message+'</h4></div>')
	                            .dialog({
	                                modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
	                                width: '40%', resizable: false,
	                                position: { my: "center", at: "center center-20%", of: window },
	                                buttons: {
	                                    Yes: function () {
	                                        $(this).dialog("close");
	                                        $.get("pathor_customer_entry.php?remove_id="+remove_id, function(data, status){
	                                          console.log(status);
	                                          if(status == 'success'){
	                                            window.location.href = 'pathor_customer_entry.php';
	                                          }
	                                        });
	                                    },
	                                    No: function () {
	                                        $(this).dialog("close");
	                                    }
	                                },
	                                close: function (event, ui) {
	                                    $(this).remove();
	                                }
	                            });
	          };
	    });
	    $(document).on('click', '.edPermit', function(event){
          event.preventDefault();
          ConfirmDialog('You have no permission edit/delete this data !');
          function ConfirmDialog(message){
              $('<div></div>').appendTo('body')
                              .html('<div><h4>'+message+'</h4></div>')
                              .dialog({
                                  modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                  width: '40%', resizable: false,
                                  position: { my: "center", at: "center center-20%", of: window },
                                  buttons: {
                                      Ok: function () {
                                          $(this).dialog("close");
                                      },
                                      Cancel: function () {
                                          $(this).dialog("close");
                                      }
                                  },
                                  close: function (event, ui) {
                                      $(this).remove();
                                  }
                              });
            };
        });
	</script>
	<script type="text/javascript">
  		$('.left_side_bar').height($('.main_bar').innerHeight());
  	</script>
  	<script type="text/javascript">
        $(document).on("click", ".kajol_close, .cancel", function(){
            $("#verifyPasswordModal").hide();
        });
    </script>
  	<script src="../js/common_js.js"> </script>
</body>
</html>