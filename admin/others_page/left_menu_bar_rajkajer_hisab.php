<!-- Left menu bar con -->
<div id="left_all_menu_con">
    <a class="header_mnu_left" href="../vaucher/raj_kajer_all_hisab.php" >
        <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
        রাজ কাজের হিসাব
    </a>

            <a class="mnu_left <?php if($_SESSION['pageName'] == 'raj_kajerhisab'){echo 'mnu_active';}?>" href="../vaucher/raj_kajerhisab.php">
                <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
                <!-- ক্রয় হিসাবের দৈনিক এন্ট্রি -->
 
                
                দৈনিক এন্ট্রি
            </a>
         
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'raj_kajer_details_hisab'){echo 'mnu_active';}?>" href="../vaucher/raj_kajer_details_hisab.php">
                <img src="../img/logo/add2.png" alt="logo" class="img_mnu">
                <!-- বিক্রয় হিসাবের দৈনিক এন্ট্রি -->
                দৈনিক হিসাব
            </a>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'raj_kajer_mistree'){echo 'mnu_active';}?>" href="../vaucher/raj_kajer_headmistree_entry.php">
                <img src="../img/logo/add2.png" alt="logo" class="img_mnu">
                <!-- বিক্রয় হিসাবের দৈনিক এন্ট্রি -->
                হেড মিস্ত্রী এন্ট্রি
            </a>
    
        
        
  
</div>