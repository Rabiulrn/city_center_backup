<?php  
$i = 0;
$query = "SELECT * FROM debit_group_data";
$read = $db->select($query);
if ($read) 
{
  while ($row = $read->fetch_assoc()) 
  {
    $i = $i+1; 
?>



    <thead>
      <tr>
        <th><?php echo $row['group_name']; ?></th>
        <th><?php echo $row['group_description']; ?></th>
        <th><?php echo $row['group_taka']; ?></th>
        <th><?php echo $row['group_pices']; ?></th>
        <th><?php echo $total_taka_calculation ?></th>
        <th>Total Bill</th>
        <th><?php echo $row['group_pay']; ?></th>
        <th><?php echo $row['group_due']; ?></th>
        <td>
          <a href="view.php?del_id=<?php echo $row['id']; ?>" class="btn btn-danger">-</a> 
        </td>
        <td>
          <button onclick="window.location.href = 'update_debit.php?edit_id=<?php echo $row['id']; ?>';" class="btn btn-success">Update</button>
        </td>
      </tr>
    </thead>
<?php  

  }
}

?>


<?php 

$total_taka_calculation = $row['group_taka'] * $row['group_pices'];



$sql_qry_debit_due="SELECT SUM(group_total_taka) AS debit_due FROM debit_group_data";
$duration_debit_due = $db->select($sql_qry_debit_due);
while($record_debit_due = $duration_debit_due->fetch_array()){
  $total_debit_due = $record_debit_due['debit_due'];
}

?>


<?php $qry = "INSERT INTO debit_group_data(group_total_taka)VALUES('$total_taka_calculation')";
    $result = $db->insert($qry); ?>