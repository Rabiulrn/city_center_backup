<!-- Left menu bar con -->
<div id="left_all_menu_con">
    <a class="header_mnu_left" href="../vaucher/rod_index.php" >
        <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
        রড হিসাব
    </a>
    <?php
        if($_SESSION['rod_kroy_hisab'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'rod_kroy_hisab'){echo 'mnu_active';}?>" href="../vaucher/rod_details_entry.php">
                <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
                <!-- ক্রয় হিসাবের দৈনিক এন্ট্রি -->
                ক্রয় হিসাব
            </a>
            <?php
        }
        if($_SESSION['rod_bikroy_hisab'] == 'yes'){
            ?>         
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'rod_bikroy_hisab'){echo 'mnu_active';}?>" href="../vaucher/rod_details_sell_entry.php">
                <img src="../img/logo/add2.png" alt="logo" class="img_mnu">
                <!-- বিক্রয় হিসাবের দৈনিক এন্ট্রি -->
                বিক্রয় হিসাব
            </a>
            <?php
        }
        if($_SESSION['rod_category'] == 'yes'){
            ?> 
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'rod_hisab_entry'){echo 'mnu_active';}?>" href="../vaucher/rod_hisab_entry.php">
                <img src="../img/logo/add3.png" alt="logo" class="img_mnu">
                ক্যাটাগরি এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['rod_dealer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'rod_dealer_entry'){echo 'mnu_active';}?>" href="../vaucher/rod_dealer_entry.php">
                <img src="../img/logo/add4.png" alt="logo" class="img_mnu">
                ডিলার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['rod_customer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'rod_cusotomer_entry'){echo 'mnu_active';}?>" href="../vaucher/rod_customer_entry.php">
                <img src="../img/logo/add5.png" alt="logo" class="img_mnu">
                কাস্টমার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['rod_buyer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'rod_buyer_entry'){echo 'mnu_active';}?>" href="../vaucher/buyer_entry.php">
                <img src="../img/logo/add6.png" alt="logo" class="img_mnu">
                বায়ার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['rod_report'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == '45'){echo 'mnu_active';}?>" href="../vaucher/rod_report_buy_hisab.php">
                <img src="../img/logo/reportVector.svg" alt="logo" class="img_mnu">
                রিপোর্ট
            </a>
            <?php
        }
    ?>
</div>