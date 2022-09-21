<?php 
	session_start();
	if(!isset($_SESSION['username'])){
	  header('location:../index.php');
	}
	require '../config/config.php';
	require '../lib/database.php';
	$db = new Database();
	// $project_name_id = $_SESSION['project_name_id'];
	$edit_data_permission   = $_SESSION['edit_data'];
	$delete_data_permission = $_SESSION['delete_data'];

	$_SESSION['pageName'] = 'rod_hisab_entry';
	$sucMsg = '';
	$sucMsgLbl = '';

	if(isset($_POST['submit'])){
		if($_POST['submit'] == 'Save'){
			$rod_c = trim($_POST['rod_category']);
			// var_dump($rod_c);
			$sql="INSERT INTO rod_category (category_name) VALUES ('$rod_c')";

			if ($db->insert($sql) === TRUE) {
			    $sucMsg = "New Rod Category Saved Successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $db->error;
			}
		} else {
			$rod_c = trim($_POST['rod_category']);
			// var_dump($rod_c);
			$rod_id = trim($_POST['rod_category_id']);

			$sql="UPDATE rod_category SET category_name='$rod_c' WHERE id='$rod_id'";

			if ($db->insert($sql) === TRUE) {
			    $sucMsg = "Rod Category Updated Successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $db->error;
			}
		}		
	}

	if(isset($_POST['label_submit'])){

		if($_POST['label_submit'] == 'Save'){
			$rod_category_id = trim($_POST['category_name']);
			$rod_label = trim($_POST['rod_name']);
			// var_dump($rod_category_id, $rod_label);

			$sql="INSERT INTO rod_and_other_label (rod_label, rod_category_id) VALUES ('$rod_label', '$rod_category_id')";

			if ($db->insert($sql) === TRUE) {
			    $sucMsgLbl = "New Rod Label Saved Successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $db->error;
			}
		} else {
			$rod_category_id = trim($_POST['category_name']);
			$rod_label = trim($_POST['rod_name']);
			$id = trim($_POST['select_rod_cat_id']);
			// var_dump($rod_category_id, $rod_label);

			$sql="UPDATE rod_and_other_label SET rod_label = '$rod_label', rod_category_id ='$rod_category_id' WHERE id='$id'";

			if ($db->insert($sql) === TRUE) {
			    $sucMsgLbl = "Rod Label Updated Successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $db->error;
			}
		}
	}


	if (isset($_GET['data_delete_id'])) {		
		$del = $_GET['data_delete_id'];
		$query = "DELETE FROM rod_category WHERE id = '$del'";

		if ($db->select($query) === TRUE) {
		    $query = "DELETE FROM rod_and_other_label WHERE rod_category_id = '$del'";

			if ($db->select($query) === TRUE) {
			    // $sucMsg = "Delete Successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $db->error;
			}
		} else {
		    echo "Error: " . $sql . "<br>" . $db->error;
		}
	}

	
	if (isset($_GET['label_delete_id'])) {		
		$del = $_GET['label_delete_id'];
		$query = "DELETE FROM rod_and_other_label WHERE id = '$del'";

		if ($db->select($query) === TRUE) {
		    // $sucMsg = "Delete Successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $db->error;
		}
	}
?>





<!DOCTYPE html>
<html>
<head>
	<title>রড হিসাব</title>
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
		.table-border th{
			text-align: center;
            background-color:#3e9309d4;
            color: white;
		}
	    .table-border > tbody > tr > td {
	        border: 1px solid #ddd !important;
			
	    }
	    .table-border > thead > tr > th {
	        border: 1px solid #ddd !important;
	    }
	    .backcircle{
		    font-size: 18px;
		    position: absolute;
		    margin-top: -10px;
		}
		.backcircle a:hover{
		    text-decoration: none !important;
		}
		.backcircle{
		    font-size: 18px;
		    position: absolute;
		    margin-top: -10px;
		}
		.backcircle a:hover{
		    text-decoration: none !important;
		}
		.borderLess{
	    	border: none !important;
	    }
	    .rodAndLabelTbl{
	    	border: 1px solid #ddd;
	    	padding: 2px;
			
			
	    }
	    #tableOne{
	    	position: relative;
	    	/*left: 50%;
	    	margin-left: -25%;*/
			
	    }
	    #tableOne tr th, #tableOne tr td{
	    	padding: 4px 5px;
			
			
	    }
	    #submitBtn{
	    	width: 100px;
	    	position: absolute;
	    	right: 0px;
	    }
	    #lblSubmitBtn{
	    	width: 100px;
	    	position: absolute;
	    	right: 0px;
	    }
	    .com_en_con {
		    width: 100%;
		    border-radius: 5px;
		    margin-top: 30px;
		    position: relative;
		    height: 133px;
		}
		hr {
		    margin-top: 20px;
		    margin-bottom: 20px;
		    border-top: 20px solid #eee;
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
	  		<?php require '../others_page/left_menu_bar_rod_hisab.php'; ?>
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
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">ক্যাটাগরি এন্ট্রি</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                            
                        </h2>
                    </div>
                <?php 
                    }
                } 
            ?>  			
			<form action="" method="post" onsubmit = "return valid()">
				<div class="com_en_con">
					    <table class="table table-border table-condensed">
							<thead>
								<tr>
									<th>Rod Category Name</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<input type="text" name = "rod_category" class="form-control" id="rod_category" placeholder="Enter category name..."></td>
										<input type="hidden" name="rod_category_id" id="rod_category_id">
									</td>
								</tr>
							</tbody>
						</table>
						<h4 class="text-center text-success"><?php echo $sucMsg; ?></h4>
						<input type="submit" name="submit" id="submitBtn" class="btn btn-primary" value="Save">
				</div>
			</form>
			<hr>
			<form action="" method="post" onsubmit="return validation()">
				<div class="com_en_con">			
					<table class="table table-border" width="100%">
						<thead>
							<tr>
								<th>Rod Category Name</th>
								<th>Rod Label Name</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td width="40%" class="rodAndLabelTbl">
									<select name = 'category_name' id="category_name" class="form-control">
								    	<option value="none">Select one...</option>
									    <?php
									    	$sql = "SELECT * FROM rod_category";
									    	$result = $db->select($sql);
									    	if($result->num_rows > 0){
									    		while($row = $result->fetch_assoc()){
									    			echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
									    		}
									    	} else{
									    		echo '0 results';
									    	}
									    ?>
								    </select>
								    <input type="hidden" name="select_rod_cat_id" id="select_rod_cat_id">
								</td>
								<td class="rodAndLabelTbl">
									<input type="text" name = "rod_name" class="form-control" id="rod_name" placeholder="Enter a label name...">
								</td>
							</tr>
							<!-- <tr>
								<td class="borderLess">
									<h3 class="text-danger" id="rodCategoryNameErr"></h3>
								</td>
								<td class="borderLess">
									<h3 class="text-danger" id="rodLabelNameErr"></h3>
								</td>
							</tr> -->
						</tbody>
					</table>
					<h4 class="text-center text-success"><?php echo $sucMsgLbl; ?></h4>
					<input type="submit" name="label_submit" id="lblSubmitBtn" class="btn btn-block btn-primary" value="Save">	
				</div>
			</form>


			<div class="showRodData">
				<table width="100%" border="1" id="tableOne">
					<tr>
						<td colspan="4" class="text-center"><h3>Rod Category Names</h3></td>
					</tr>
					<?php
						$sql = "SELECT * FROM rod_category";
						$result = $db->select($sql);
				    	if($result->num_rows > 0){
				    		$i = 1;
				    		while($row = $result->fetch_assoc()){
				    			$cat_id = $row['id'];
				    			echo '<tr style="background-color: #337ab7;">';
					    			echo '<td style="text-align:center; font-weight: bold;">'.$i.'</td>';
									echo '<td style="font-weight: bold;">'.$row['category_name'].'</td>';

									if($delete_data_permission == 'yes'){
										echo '<td align="center" width="80px"><a class="btn btn-danger rod_cat_del" data_delete_id="' . $row['id'] . '">Delete</a></td>';
									} else {
										echo '<td align="center" width="80px"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
									}
									
									
									if($edit_data_permission == 'yes'){
										echo '<td align="center" width="60px"><a class="btn btn-success" onclick="displayupdate(this)" row_id="'.$row['id'].'">Edit</a></td>';
									} else {
										echo '<td align="center" width="60px"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
									}
								echo '</tr>';


								$sql2 = "SELECT * FROM rod_and_other_label WHERE rod_category_id='$cat_id' ORDER BY rod_label ASC";
								$result2 = $db->select($sql2);
						    	if($result2->num_rows > 0){
						    		while($row2 = $result2->fetch_assoc()){
						    			echo '<tr>';
							    			echo "<td></td>";
											echo '<td>'.$row2['rod_label'].'</td>';
											
											if($delete_data_permission == 'yes'){
												echo '<td align="center" width="80px"><a class="btn btn-danger rod_label_del" label_delete_id="'.$row2['id'].'">Delete</a></td>';
											} else {
												echo '<td align="center" width="80px"><a class="btn btn-danger edPermit" disabled>Delete</a></td>';
											}
											
											if($edit_data_permission == 'yes'){
												echo '<td align="center" width="60px"><a class="btn btn-success" onclick="updatelabel(this)" row_id="'.$row2['id'].'" rod_category_id="'.$row2['rod_category_id'].'">Edit</a></td>';
											} else {
												echo '<td align="center" width="60px"><a class="btn btn-success edPermit" disabled>Edit</a></td>';
											}
										echo '</tr>';

						    		}
						    	}
						    	// else{
						    	// 	echo '0 Label results';
						    	// }
						    	$i++;
				    		}
				    	} else{
				    		echo '0 results';
				    	}
					?>
				</table>

				<!-- <table width="45%" border="1" id="tableTwo">
					<tr>
						<td colspan="3" class="text-center"><h3>Rod & Others Label Names</h3></td>
					</tr>
					<?php
						// $sql = "SELECT * FROM rod_and_other_label";
						// $result = $db->select($sql);
				  //   	if($result->num_rows > 0){
				  //   		while($row = $result->fetch_assoc()){
				  //   			echo '<tr>';
						// 		echo '<td>'.$row['rod_label'].'</td>';
						// 		echo '<td align="center" width="80px"><a class="btn btn-danger rod_label_del" label_delete_id="'.$row['id'].'">Delete</a></td>';
						// 		// echo '<td align="center" width="60px"><a class="btn btn-success" href="rod_label_edit.php?label_others_id='.$row['id'].'">Edit</a></td>';
						// 		echo '<td align="center" width="60px"><a class="btn btn-success" onclick="updatelabel(this)" row_id="'.$row['id'].'" rod_category_id="'.$row['rod_category_id'].'">Edit</a></td>';
						// 		echo '</tr>';

				  //   		}
				  //   	} else{
				  //   		echo '0 results';
				  //   	}
					?>
				</table> -->
			</div>
  		</div>
	</div>
	<?php include '../others_page/delete_permission_modal.php';  ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
		function validation(){
			validReturn = false;
			var rod_name = $('#rod_name').val();
			var category_name = $('#category_name').val();
			// alert(category_name);

			if(category_name == 'none'){
				alert('Please Select a Category Name !');
				// $('#category_name').focus();
				validReturn = false;
			} else {
				if(rod_name == ''){
					alert('Rod Label Name cant be empty !');
					$('#rod_name').focus();
					validReturn = false;
				} else if($.isNumeric(rod_name)){
					alert('Rod Label Name cant be Number !');
					$('#rod_name').focus();
					validReturn = false;
				} else{
					validReturn = true;
				}
			}

			if(validReturn){
				return true;
			} else{
				return false;
			}
		}
		// function validOthers(){
		// 	validReturn = false;
		// 	var others_label = $('#others_label').val();
		// 	// alert(others_label);
		// 	if(others_label == ''){
		// 		alert('Others Label cant be empty !');
		// 		$('#others_label').focus();
		// 		validReturn = false;
		// 	} else if($.isNumeric(others_label)){
		// 		alert('Others Label cant be Number !');
		// 		$('#others_label').focus();
		// 		validReturn = false;
		// 	} else{
		// 		validReturn = true;
		// 	}

		// 	if(validReturn){
		// 		return true;
		// 	} else{
		// 		return false;
		// 	}
		// }


		function displayupdate(element){
			var td_category 		= $(element).closest('tr').find('td:eq(1)').text();
			var row_id_table		= $(element).attr('row_id');
			// alert(td_mobile);

			$('#rod_category').val(td_category);
			$('#rod_category_id').val(row_id_table);
			$('#submitBtn').val('Update');
			// alert(row_id_table);

			var body = $("html, body");
			body.stop().animate({scrollTop:250}, 500, 'swing', function() { 
			   // alert("Finished animating");
			});
		}
		
		function updatelabel(element){
			// console.log(element);
			var td_label		= $(element).closest('tr').find('td:eq(1)').text();
			var rod_category_id	= $(element).attr('rod_category_id');
			var row_id_table	= $(element).attr('row_id');
			

			$('#rod_name').val(td_label);
			$('#category_name').val(rod_category_id);
			$('#select_rod_cat_id').val(row_id_table);

			$('#lblSubmitBtn').val('Update');

			var body = $("html, body");
			body.stop().animate({scrollTop:450}, 500, 'swing', function() { 
			   // alert("Finished animating");
			});
		}
	</script>

	<script type="text/javascript">
		$(document).on('click', '.rod_cat_del', function(event){          
			var del_id = $(event.target).attr('data_delete_id');
			$("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
			$("#matchPassword").val('');
			$("#passMsg").html('');
			$("#verifyToDeleteBtn").attr("data_delete_id", del_id);
			$("#verifyToDeleteBtn").removeAttr("label_delete_id");
		});
		$(document).on('click', '.rod_label_del', function(event){          
			var del_id = $(event.target).attr('label_delete_id');
			$("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
			$("#matchPassword").val('');
			$("#passMsg").html('');
			$("#verifyToDeleteBtn").attr("label_delete_id", del_id);
			$("#verifyToDeleteBtn").removeAttr("data_delete_id");
		});

		$(document).on('click', '#verifyToDeleteBtn', function(event){
			// event.preventDefault();
			var data_delete_id = document.getElementById("verifyToDeleteBtn").hasAttribute("data_delete_id");
			var label_delete_id = document.getElementById("verifyToDeleteBtn").hasAttribute("label_delete_id");
			// alert(data_del_id);
			if (data_delete_id == true) {
			  var del_id = $(event.target).attr('data_delete_id');
			  // alert(del_id);
			  delete_category_data(del_id);
			} else if(label_delete_id == true){
			  var del_id = $(event.target).attr('label_delete_id');
			  delete_label_data(del_id);
			} else {
				alert('Logic not match !');
			}
		});

		function delete_category_data(del_id){
	        console.log(del_id);
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
						ConfirmDialog('Are you sure to delete category info ?');
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
	                            .html('<div><h4>'+message+'</h4><h5>This rod category name.</h5></div>')
	                            .dialog({
	                                modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
	                                width: '40%', resizable: false,
	                                position: { my: "center", at: "center center-20%", of: window },
	                                buttons: {
	                                    Yes: function () {
	                                        $(this).dialog("close");
	                                        $.get("rod_hisab_entry.php?data_delete_id="+del_id, function(data, status){
	                                            if(status == 'success'){
	                                              window.location.href = 'rod_hisab_entry.php';
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
	    }

	    function delete_label_data(del_id){
	        console.log(del_id);
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
						ConfirmDialog('Are you sure to delete label info ?');
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
	                            .html('<div><h4>'+message+'</h4><h5>This label name.</h5></div>')
	                            .dialog({
	                                modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
	                                width: '40%', resizable: false,
	                                position: { my: "center", at: "center center-20%", of: window },
	                                buttons: {
	                                    Yes: function () {
	                                        $(this).dialog("close");
	                                        $.get("rod_hisab_entry.php?label_delete_id="+del_id, function(data, status){
	                                            if(status == 'success'){
	                                              window.location.href = 'rod_hisab_entry.php';
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
	    }
		
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