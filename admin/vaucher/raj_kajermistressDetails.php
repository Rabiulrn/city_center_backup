<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $_SESSION['pageName'] = 'raj_kajerhisab';
    
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];
    $sucMsg = "";

     if (isset($_POST['checkhedmistress'])) {
           $query_hedmistress = "SELECT * FROM raj_kajer_hedmistress WHERE hedmistress_status = '1' AND project_name_id = '$project_name_id' ";
                $showData = $db->select($query_hedmistress);
                    if ($showData) {?>

             <select disabled name="r_hedmistress" id="r_hedmistress" class="form-control r_hedmistress" >

             <option value="">মিস্ত্রী নাম</option>


                <?php 
                    while ($rows = $showData->fetch_assoc()) {
                ?>                                          
                   <option value="<?php echo $rows['id']; ?>"> <?php echo $rows['hedmistress_name']; ?> </option>                                                  
                <?php 
                    }?>

              </select>         

               <?php 
           }
                    
        

        }   


?>