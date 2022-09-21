<?php
function group_name_from_debit_group_tbl_select_box($db, $project_name_id){
	$html = '<select id="headerGroupNameList" style="width: 280px;">';
        $html .= '<option value="none">Select...</option>';
		$query = "SELECT DISTINCT group_name FROM debit_group_data WHERE project_name_id = '$project_name_id'";
		$show = $db->select($query);
		if($show){
		  while($rows = $show->fetch_assoc()) {
		      // $id = $rows['id'];
		      $group_name = $rows['group_name'];
		      if($group_name != ''){
		          $html .= '<option value="' . $group_name .'">' . $group_name . '</option>';
		      }
		  }
		}

    $html .= '</select>';
    return $html;
}

// function group_name_from_debit_group_tbl_select_box($db, $project_name_id){
// 	$html = '<select id="headerGroupNameList" style="width: 240px; margin-left: 4px;">';
//         $html .= '<option value="none">Select...</option>';
// 		$query = "SELECT DISTINCT group_name FROM debit_group_data WHERE project_name_id = '$project_name_id'";
// 		$show = $db->select($query);
// 		if($show){
// 		  while($rows = $show->fetch_assoc()) {
// 		      // $id = $rows['id'];
// 		      $group_name = $rows['group_name'];
// 		      if($group_name != ''){
// 		          $html .= '<option value="' . $group_name .'">' . $group_name . '</option>';
// 		      }
// 		  }
// 		}

//     $html .= '</select>';
//     return $html;
// }
?>
