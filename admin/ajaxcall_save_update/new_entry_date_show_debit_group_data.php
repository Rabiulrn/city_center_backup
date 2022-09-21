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


    $entryList = $_POST['entryList'];
    $group_id = $_POST['seletedGroupId'];

    if($entryList == 'new_entry'){
    	?>
    	<form action="" method="POST" id="inputDataForm">
	    	<table class="table table-bordered table-condensed" id="dynamic_field">          
	        	<?php
	            $name         = '';
	            $description  = '';
	            $taka         = '';
	            $pices        = '';
	            $total_taka   = '';
	            $total_bill   = '';
	            $pay          = '';
	            $due          = '';
	            $query = "SELECT * FROM debit_group WHERE id = '$group_id'";
	            $read = $db->select($query);
	            if ($read) {
	                while ($row = $read->fetch_assoc()) {
	                    $postDateArr        = explode('-', $row['group_date']);
	                    $credit_date        = $postDateArr['2'].'/'.$postDateArr['1'].'/'.$postDateArr['0'];

	                    $row_id             = $row['id'];
	                    $name         = $row['group_name'];
	                    $description  = $row['group_description'];
	                    $taka               = $row['taka'];
	                    $pices              = $row['pices'];
	                    $total_taka         = $row['total_taka'];
	                    // $total_bill         = $row['total_bill'];
	                    $pay                = $row['pay'];
	                    $due                = $row['due'];
            			?>
	                    <thead>
	                        <tr>
	                            <th colspan="11">খরচ খাতের তারিখ: <?php echo $credit_date; ?></th>
	                        </tr>
	                    </thead>
	                    <thead>
	                        <tr style="background-color: #bbb;">
	                            <th class="centerTxt" width="112px">তারিখ</th>
	                            <th class="centerTxt"><?php echo $name; ?></th>
	                            <th class="centerTxt"><?php echo $description; ?></th>
	                            <th class="centerTxt"><?php echo $taka; ?></th>
	                            <th class="centerTxt"><?php echo $pices; ?></th>
	                            <th class="centerTxt"><?php echo $total_taka; ?></th>
	                            <th class="centerTxt"><?php echo $pay; ?></th>
	                            <th class="centerTxt"><?php echo $due; ?></th>
	                            <th class="centerTxt">Delete</th>
	                            <th class="centerTxt">
	                                <?php
	                                    if($edit_data_permission == 'yes'){
	                                        echo '<a group_id="' .$row['id'] .'" class="btn btn-success" onclick="load_header_for_edit(this)">&nbsp;&nbsp;Edit &nbsp;&nbsp;</a>';
	                                    } else {
	                                        echo '<a class="btn btn-success edPermit" disabled>&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>';
	                                    }
	                                ?>   
	                            </th>
	                        </tr>
	                    </thead> 
	            		<?php
                	}
            	}
        ?>            
    	<?php
        	$today = date('Y-m-d');
	        $query = "SELECT * FROM debit_group_data WHERE group_id = '$group_id' AND entry_date ='$today' AND project_name_id = '$project_name_id'";
	        $read = $db->select($query);
	        if ($read){
	            while ($row = $read->fetch_assoc()){
	            	$rowID = $row['id'];
	            	$entry_date = $row['entry_date'];
	                $group_name = $row['group_name'];
	                $group_description = $row['group_description'];
	                $group_taka = $row['group_taka'];
	                $group_pices = $row['group_pices'];
	                $group_total_taka = $row['group_total_taka'];
	                $group_pay = $row['group_pay'];
	                $group_due = $row['group_due'];				                
    				?>
	                <tr>
	                    <td><?php if($entry_date == '0000-00-00'){} else {echo date("d/m/Y", strtotime($entry_date));} ?></td>
	                    <td><?php echo $group_name; ?></td>
	                    <td><?php echo $group_description; ?></td>
	                    <td class="text-right"><?php echo $group_taka; ?></td>
	                    <td class="text-right"><?php echo $group_pices; ?></td>
	                    <td class="text-right"><?php echo $group_total_taka; ?></td>
	                    <td class="text-right"><?php echo $group_pay; ?></td>
	                    <td class="text-right"><?php echo $group_due; ?> </td>
	                    <td class="centerTxt">		                      
	                      	<?php
	                            if($delete_data_permission == 'yes'){
	                                echo '<a data_dels_id="'.$rowID.'" debit_group_id="'. $group_id .'" entry_list_date = "'.$entryList.'" class="btn btn-danger sgdDelete">-</a>';
	                            } else {
	                                echo '<a class="btn btn-danger edPermit" disabled>-</a>';
	                            }
	                        ?>    
	                    </td>
	                    <td class="centerTxt">
	                        <?php
	                            if($edit_data_permission == 'yes'){
	                            	echo '<a edit_id="'.$rowID.'" dataset_id="'.$group_id.'" class="btn btn-success" onclick="load_row(this)">Update</a>';
								} else {
	                                echo '<a class="btn btn-success edPermit" disabled>Update</a>';
	                            }
	                        ?>
	                    </td>
	                </tr>
        			<?php
    			}
    		}
    	?>
		        <tbody>
		            <tr>
		                <td><input type="text" name="entry_date[]" class="form-control" id="entry_date1" placeholder="dd/mm/yyyy" /></td>
		                <td><input type="text" name="group_name[]" class="form-control" size="100" id="group_name1" placeholder="<?php echo $name;?>" /></td>
		                <td><input type="text" name="group_description[]" class="form-control" size="100" id="group_description1" placeholder="<?php echo $description;?>" /></td>
		                <td><input type="text" name="taka[]" class="form-control tkCount calc1" size="40" id="taka1" placeholder="<?php echo $taka; ?>" /></td>
		                <td><input type="text" name="pices[]" class="form-control calc1" size="40" id="pices1" placeholder="<?php echo $pices; ?>" /></td>
		                <td><input type="text" name="total_taka[]" class="form-control" id="total_taka1" placeholder="<?php echo $total_taka; ?>" /></td>
		                <td><input type="text" name="pay[]" class="form-control payCalc1" id="pay1" placeholder="<?php echo $pay; ?>" /></td>
		                <td><input type="text" name="due[]" class="form-control" id="due1" placeholder="<?php echo $due; ?>" /></td>

		                <td class="centerTxt"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
		                <td class="centerTxt"><button type="button" name="remove" id="1" class="btn btn-danger btn_remove disabled">-</button></td>
		            </tr>
		        </tbody>
		    </table>
		    <div class="form-group">
		        <input type="hidden" class="" name="group_id" value="<?php echo $group_id; ?>" id="group_id">
		        <input type="button" class="form-control btn btn-primary" name="submit" value="Submit" onclick="return validation()" id="submitBtn" >
		    </div>
		</form>
		
		<!-- Modal -->
		<!-- <div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">
		        <form action="" method="POST">
		            <div class="modal-content">
		                <div class="modal-header">
		                    <button type="button" class="close" data-dismiss="modal">&times;</button>
		                    <h4 class="modal-title">Set <?php //echo $pay_for_modal; ?> amount</h4>
		                </div>
		                <div class="modal-body">                    
		                    <input type="text" name="pay_due_total" class="form-control" />
		                    <input type="hidden" name="id" value="<?php //echo $data_id; ?>"/>                    
		                </div>
		                <div class="modal-footer">
		                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		                    <input type="hidden" name="get_debit_group_id" value="<?php //echo $group_id; ?>">
		                    <input type="submit" name="set" class="btn btn-primary" value="SET" />
		                </div>
		            </div>
		        </form>        
		    </div>
		</div> -->
       <?php 
    } else {
    	// echo $entryList;
    	?>
    	
    	<form action="" method="POST" id="inputDataForm">
		    <table class="table table-bordered table-condensed" id="dynamic_field">          
		        <?php
		            
		            $query = "SELECT * FROM debit_group WHERE id = '$group_id' AND project_name_id = '$project_name_id'";
		            $read = $db->select($query);
		            if ($read) {
		                while ($row = $read->fetch_assoc()) {
		                    $postDateArr        = explode('-', $row['group_date']);
		                    $credit_date        = $postDateArr['2'].'/'.$postDateArr['1'].'/'.$postDateArr['0'];


		                    $row_id             = $row['id'];
		                    $name         = $row['group_name'];
		                    $description  = $row['group_description'];
		                    $taka               = $row['taka'];
		                    $pices              = $row['pices'];
		                    $total_taka         = $row['total_taka'];
		                    // $total_bill         = $row['total_bill'];
		                    $pay                = $row['pay'];
		                    $due                = $row['due'];
		            		?>
		                    <thead>
		                        <tr>
		                            <th colspan="11">খরচ খাতের তারিখ: <?php echo $credit_date; ?></th>
		                        </tr>
		                    </thead>

		                    <thead>
		                        <tr style="background-color: #bbb;">
		                            <th class="centerTxt" width="112px">তারিখ</th>
		                            <th class="centerTxt"><?php echo $name; ?></th>
		                            <th class="centerTxt"><?php echo $description; ?></th>
		                            <th class="centerTxt"><?php echo $taka; ?></th>
		                            <th class="centerTxt"><?php echo $pices; ?></th>
		                            <th class="centerTxt"><?php echo $total_taka; ?></th>
		                            <!-- <th class="centerTxt"><?php //echo $total_bill; ?></th> -->
		                            <th class="centerTxt"><?php echo $pay; ?></th>
		                            <th class="centerTxt"><?php echo $due; ?></th>
		                            <th class="centerTxt">Delete</th>
		                            <th class="centerTxt">
		                                <!-- <a href="update_add_vaucher_group.php?edite_id=<?php //echo $row_id; ?>" class="btn btn-success">&nbsp;&nbsp;&nbsp;Edit&nbsp;&nbsp;</a> -->
		                                <?php
		                                    if($edit_data_permission == 'yes'){
		                                        // echo '<a href="update_add_vaucher_group.php?edite_id=' .$row_id .'" class="btn btn-success">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>';
		                                        echo '<a group_id="' .$row['id'] .'" class="btn btn-success" onclick="load_header_for_edit(this)">&nbsp;&nbsp;Edit &nbsp;&nbsp;</a>';
		                                    } else {
		                                        echo '<a class="btn btn-success edPermit" disabled>&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>';
		                                    }
		                                ?>  
		                            </th>
		                        </tr>
		                    </thead>
		            <?php  

		                }
		            }
		        ?>

		    <!-- view debit group data from database -->
		    <?php
		    	
		        $query = "SELECT * FROM debit_group_data WHERE group_id = '$group_id' AND entry_date ='$entryList' AND project_name_id = '$project_name_id'";
		        $read = $db->select($query);
		        if ($read){
		            while ($row = $read->fetch_assoc()){
		            	$rowID = $row['id'];
		            	$entry_date = $row['entry_date'];
		                $group_name = $row['group_name'];
		                $group_description = $row['group_description'];
		                $group_taka = $row['group_taka'];
		                $group_pices = $row['group_pices'];
		                $group_total_taka = $row['group_total_taka'];
		                // $group_total_bill = $row['group_total_bill'];
		                $group_pay = $row['group_pay'];
		                $group_due = $row['group_due'];

		                
	    			?>
		            <!-- <thead> -->
		                <tr>
		                    <td><?php if($entry_date == '0000-00-00'){} else {echo date("d/m/Y", strtotime($entry_date));} ?></td>
		                    <td><?php echo $group_name; ?></td>
		                    <td><?php echo $group_description; ?></td>
		                    <td class="text-right"><?php echo $group_taka; ?></td>
		                    <td class="text-right"><?php echo $group_pices; ?></td>
		                    <td class="text-right"><?php echo $group_total_taka; ?></td>
		                    <!-- <td class="text-right"><?php //echo $group_total_bill;  ?></td> -->
		                    <td class="text-right"><?php echo $group_pay; ?></td>
		                    <td class="text-right"><?php echo $group_due; ?> </td>
		                    <td class="centerTxt">		                      
		                      	<?php
                                    if($delete_data_permission == 'yes'){
                                        echo '<a data_dels_id="'.$rowID.'" debit_group_id="'. $group_id .'" entry_list_date = "'.$entryList.'" class="btn btn-danger sgdDelete">-</a>';

                                    } else {
                                        echo '<a class="btn btn-danger edPermit" disabled>-</a>';
                                    }
                                ?>    
		                    </td>
		                    <td class="centerTxt">
		                        <?php
		                            // $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		                            // $str_arr = explode ("?", $url);
		                            // $last_part = end($str_arr);
		                            // // var_dump($last_part);
		                            // preg_match("|\d+|", $last_part, $m);
		                            // $idOfDataSet = $m[0];
		                            // // var_dump($idOfDataSet);
		                        ?>
		                        
		                        <?php
                                    if($edit_data_permission == 'yes'){
                                    	// echo '<a href="update_single_group_data.php?edit_id='.$rowID.'&dataset_id='.$group_id.'" class="btn btn-success">Update</a>';
                                    	echo '<a edit_id="'.$rowID.'" dataset_id="'.$group_id.'" class="btn btn-success" onclick="load_row(this)">Update</a>';
									} else {
                                        echo '<a class="btn btn-success edPermit" disabled>Update</a>';
                                    }
                                ?>
		                    </td>
		                </tr>
		            <!-- </thead> -->
		    <?php
		        }
		    }
		    ?>

		        <!-- <tbody> -->
		            <tr>
		                <td><input type="text" name="entry_date[]" class="form-control" id="entry_date1" placeholder="dd/mm/yyyy" /></td>
		                <td><input type="text" name="group_name[]" class="form-control" size="100" id="group_name1" placeholder="<?php echo $name;?>" /></td>
		                <td><input type="text" name="group_description[]" class="form-control" size="100" id="group_description1" placeholder="<?php echo $description;?>" /></td>
		                <td><input type="text" name="taka[]" class="form-control tkCount calc1" size="40" id="taka1" placeholder="<?php echo $taka; ?>" /></td>
		                <td><input type="text" name="pices[]" class="form-control calc1" size="40" id="pices1" placeholder="<?php echo $pices; ?>" /></td>
		                <td><input type="text" name="total_taka[]" class="form-control" id="total_taka1" placeholder="<?php echo $total_taka; ?>" /></td>
		                <!-- <td><input type="text" name="total_bill[]" class="form-control"  id="total_bill1" placeholder="<?php //echo $total_bill; ?>" /></td> -->
		                <td><input type="text" name="pay[]" class="form-control payCalc1" id="pay1" placeholder="<?php echo $pay; ?>" /></td>
		                <td><input type="text" name="due[]" class="form-control" id="due1" placeholder="<?php echo $due; ?>" /></td>

		                <td class="centerTxt"><button type="button" name="add" id="add" class="btn btn-success">+</button></td>
		                <td class="centerTxt"><button type="button" name="remove" id="1" class="btn btn-danger btn_remove disabled">-</button></td>
		            </tr>
		        <!-- </tbody> -->
		    </table>
		    <div class="form-group">
		        <!-- <input type="hidden" name="get_debit_group_id" id= "get_debit_group_id" value="<?php echo $get_debit_group_id; ?>"> -->
		        <input type="hidden" class="" name="group_id" value="<?php echo $group_id; ?>" id="group_id">
		        <input type="button" class="form-control btn btn-primary" name="submit" value="Submit" onclick="return validation()" id="submitBtn">
		    </div>		    
		</form>
    <?php
    }
    ?>