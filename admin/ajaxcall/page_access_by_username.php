<?php
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();


    $allowUserVal = $_POST['statusValue'];
    $pagevar = $_POST['pageName'];
    $username = $_POST['uname'];
    // var_dump($allowUserVal);
    // var_dump($pagevar);



    if($pagevar=='home'){
        if($allowUserVal == 'yes') {
            $update_query = "UPDATE login SET home = 'no' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read)
            {
              echo "Allow user status of home updated.";
            }
        } else if($allowUserVal == 'no'){
            $update_query = "UPDATE login SET home = 'yes' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read) 
            {
              echo "Allow user status of home updated.";
            }
        } else {

        }
    } elseif($pagevar=='doinik_hisab'){
        if($allowUserVal == 'yes') {
            $update_query = "UPDATE login SET doinik_hisab = 'no' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read)
            {
              echo "Allow user status of doinik_hisab updated.";
            }
        } else if($allowUserVal == 'no'){
            $update_query = "UPDATE login SET doinik_hisab = 'yes' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read) 
            {
              echo "Allow user status of doinik_hisab updated.";
            }
        } else {

        }
    } elseif($pagevar=='joma_khat'){
        if($allowUserVal == 'yes') {
            $update_query = "UPDATE login SET joma_khat = 'no' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read)
            {
              echo "Allow user status of joma_khat updated.";
            }
        } else if($allowUserVal == 'no'){
            $update_query = "UPDATE login SET joma_khat = 'yes' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read) 
            {
              echo "Allow user status of joma_khat updated.";
            }
        } else {

        }
    }
    elseif($pagevar=='khoros_khat'){
        if($allowUserVal == 'yes') {
            $update_query = "UPDATE login SET khoros_khat = 'no' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read)
            {
              echo "Allow user status of khoros_khat updated.";
            }
        } else if($allowUserVal == 'no'){
            $update_query = "UPDATE login SET khoros_khat = 'yes' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read) 
            {
              echo "Allow user status of khoros_khat updated.";
            }
        } else {

        }
    }
    elseif($pagevar=='nije_pabo'){
        if($allowUserVal == 'yes') {
            $update_query = "UPDATE login SET nije_pabo = 'no' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read)
            {
              echo "Allow user status of nije_pabo updated.";
            }
        } else if($allowUserVal == 'no'){
            $update_query = "UPDATE login SET nije_pabo = 'yes' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read) 
            {
              echo "Allow user status of nije_pabo updated.";
            }
        } else {

        }
    }
    elseif($pagevar=='paonader'){
        if($allowUserVal == 'yes') {
            $update_query = "UPDATE login SET paonader = 'no' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read)
            {
              echo "Allow user status of paonader updated.";
            }
        } else if($allowUserVal == 'no'){
            $update_query = "UPDATE login SET paonader = 'yes' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read) 
            {
              echo "Allow user status of paonader updated.";
            }
        } else {

        }
    }
    elseif($pagevar=='modify_data'){
        if($allowUserVal == 'yes') {
            $update_query = "UPDATE login SET modify_data = 'no' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read)
            {
              echo "Allow user status of modify_data updated.";
            }
        } else if($allowUserVal == 'no'){
            $update_query = "UPDATE login SET modify_data = 'yes' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read) 
            {
              echo "Allow user status of modify_data updated.";
            }
        } else {

        }
    }
    elseif($pagevar=='rod_hisab'){
        if($allowUserVal == 'yes') {
            $update_query = "UPDATE login SET rod_hisab = 'no' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read)
            {
              echo "Allow user status of rod_hisab updated.";
            }
        } else if($allowUserVal == 'no'){
            $update_query = "UPDATE login SET rod_hisab = 'yes' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read) 
            {
              echo "Allow user status of rod_hisab updated.";
            }
        } else {

        }
    }
    elseif($pagevar=='create_user'){
        if($allowUserVal == 'yes') {
            $update_query = "UPDATE login SET create_user = 'no' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read)
            {
              echo "Allow user status of create_user updated.";
            }
        } else if($allowUserVal == 'no'){
            $update_query = "UPDATE login SET create_user = 'yes' WHERE username = '$username'";
            $read = $db->select($update_query);
            if ($read) 
            {
              echo "Allow user status of create_user updated.";
            }
        } else {

        }
    }
    else{       
    }


    //Page permission Yes/No set
    $query = "SELECT * FROM login WHERE username = '$username'";
    $read = $db->select($query);
    $row = $read->fetch_assoc();
    // echo  $row['home'];
    if($row['home'] == 'yes' || $row['doinik_hisab'] == 'yes' || $row['joma_khat'] == 'yes' || $row['khoros_khat'] == 'yes' || $row['nije_pabo'] == 'yes' || $row['paonader'] == 'yes' || $row['modify_data'] == 'yes' || $row['create_user'] == 'yes'){
        
        $update_query = "UPDATE login SET page_permission = 'yes' WHERE username = '$username'";
        $read = $db->select($update_query);
        echo "<br/>At least One page permission true.";
    }
    else{
        $update_query = "UPDATE login SET page_permission = 'no' WHERE username = '$username'";
        $read = $db->select($update_query);
        echo "<br/>No page permission true.";
    }

    

        


?>