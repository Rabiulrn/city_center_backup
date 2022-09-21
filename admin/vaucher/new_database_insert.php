<?php 
$add_id = $_GET['add_id'];

if (isset($_POST['submit'])) 
{
  $querys = "SELECT * FROM debit_group WHERE id = $add_id";
  $reads = $db->select($querys);
  if ($reads) 
  {
    while ($rows = $read->fetch_assoc()) 
    {
      $group_name = $rows['group_name'];
      $group_description = $rows['group_description'];
      $taka = $rows['taka'];
      $pices = $rows['pices'];
      $total_taka = $rows['total_taka'];
      $total_bill = $rows['total_bill'];
      $pay = $rows['pay'];
      $due = $rows['due'];
    }
  }

  $query = "SELECT * FROM debit_group_data WHERE group_id = $add_id";
  $read = $db->select($query);
  if ($read) 
  {
    while ($row = $read->fetch_assoc()) 
    {
      $s_g_name = $row['group_name'];
      $s_g__description = $row['group_description'];
      $s_g_taka = $row['group_taka'];
      $s_g_pices = $row['group_pices'];
      $s_g_total_taka = $row['group_taka'] * $row['group_pices'];
      $total_debit_due;
      $s_g_pay = $row['group_pay'];
      $s_g_due = $row['group_due'];
    }
  }


  $queryss = "INSERT INTO vaucher_debit(debit_name, debit_description, rate, pices, debit_cost, debit_pay, debit_due, due_credit_amount, due_debit_amount, debit_group_id, debit_group_data_id)VALUES('$group_name', '$s_g_name'),('$group_description', '$s_g__description'),('$taka', '$s_g_taka'),('$pices', '$s_g_pices'),('$total_taka', '$s_g_total_taka'),('$total_bill', '$total_debit_due'),('$pay', '$s_g_pay'),('$due', '$s_g_due')";
  $result = $db->insert($queryss);
}

//INSERT INTO vaucher_debit(debit_description, debit_name) VALUES('admin','admin'), ('author','admin'), ('mod','admin'), ('user','admin'), ('guest','admin')

?>