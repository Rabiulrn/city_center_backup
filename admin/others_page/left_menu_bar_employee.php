<!-- Left menu bar con -->
<div id="left_all_menu_con">
    <a class="header_mnu_left" href="../vaucher/employee.php" >
        <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
        কর্মচারী হিসাব
    </a>

            <a class="mnu_left <?php if($_SESSION['pageName'] == 'employee_everyday_entry'){echo 'mnu_active';}?>" href="../vaucher/employee_day_entry.php">
                <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
                <!-- ক্রয় হিসাবের দৈনিক এন্ট্রি -->
 
                
                দৈনিক এন্ট্রি
            </a>
         
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'employee_details_hisab'){echo 'mnu_active';}?>" href="../vaucher/employee_details_hisab.php">
                <img src="../img/logo/add2.png" alt="logo" class="img_mnu">
                <!-- বিক্রয় হিসাবের দৈনিক এন্ট্রি -->
                দৈনিক হিসাব
            </a>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'employee_new_create'){echo 'mnu_active';}?>" href="../vaucher/employee_new_create.php">
                <img src="../img/logo/add2.png" alt="logo" class="img_mnu">
                <!-- বিক্রয় হিসাবের দৈনিক এন্ট্রি -->
                কর্মচারী এন্ট্রি
            </a>
    
        
        
  
</div>