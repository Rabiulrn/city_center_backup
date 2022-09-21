<?php
	session_start();
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $project_name_id = $_SESSION['project_name_id'];
?>
    			<tr>
		    		<th>Sl No</th>
		    		<th>Date</th>
		    		<th>1000 Tk</th>
		    		<th>500 Tk</th>
		    		<th>100 Tk</th>
		    		<th>50 Tk</th>
		    		<th>20 Tk</th>
		    		<th>10 Tk</th>
		    		<th>5 Tk</th>
		    		<th>2 Tk</th>
		    		<th>1 Tk</th>
		    		<th>Total Notes</th>
		    		<th>Total Taka</th>
		    		<th width="50px"></th>
		    		<th width="50px"></th>
		    	</tr>
		    
		    <?php
		    	$sql = "SELECT * FROM cash WHERE project_name_id = '$project_name_id'";
		    	$read = $db->select($sql);
		    	$i =1;
		    	if($read){
		    		while($row = $read->fetch_assoc()) {
		    			echo "<tr>";
		    				echo "<td style='text-align: center;'>".$i."</td>";
		    				echo "<td>".date("d-m-Y", strtotime($row['dates']))."</td>";
		    				echo "<td>".$row['note_1000']."</td>";
		    				echo "<td>".$row['note_500']."</td>";
		    				echo "<td>".$row['note_100']."</td>";
		    				echo "<td>".$row['note_50']."</td>";
		    				echo "<td>".$row['note_20']."</td>";
		    				echo "<td>".$row['note_10']."</td>";
		    				echo "<td>".$row['note_5']."</td>";
		    				echo "<td>".$row['note_2']."</td>";
		    				echo "<td>".$row['note_1']."</td>";
		    				echo "<td>".$row['total_notes']."</td>";
		    				echo "<td>".number_format($row['total_amout'], 2)."</td>";
		    				echo "<td><a data_trash_id='".$row['id']."' class='btn btn-danger cashDelete'>Delete</a></td>";
		    				echo "<td><a data_edit_id='".$row['id']."' class='btn btn-success' onclick='displayupdate(this)'>Edit</a></td>";
		    			echo "</tr>";
		    			$i++;
		    		}
		    	}
		    ?>