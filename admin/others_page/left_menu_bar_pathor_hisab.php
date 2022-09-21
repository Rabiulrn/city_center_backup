<!-- Left menu bar con -->
<div id="left_all_menu_con">
    <a class="header_mnu_left" href="../vaucher/pathor_index.php" >
        <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
        পাথর হিসাব
    </a>
    <?php
        if($_SESSION['pathor_kroy_hisab'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'pathor_kroy_hisab'){echo 'mnu_active';}?>" href="../vaucher/pathor_details_entry.php">
                <img src="../img/logo/add1.png" alt="logo" class="img_mnu">
                <!-- ক্রয় হিসাবের দৈনিক এন্ট্রি -->
                ক্রয় হিসাব
            </a>
            <?php
        }
        if($_SESSION['pathor_bikroy_hisab'] == 'yes'){
            ?>         
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'pathor_bikroy_hisab'){echo 'mnu_active';}?>" href="../vaucher/pathor_details_sell_entry.php">
                <img src="../img/logo/add2.png" alt="logo" class="img_mnu">
                <!-- বিক্রয় হিসাবের দৈনিক এন্ট্রি -->
                বিক্রয় হিসাব
            </a>
            <?php
        }
        if($_SESSION['pathor_category'] == 'yes'){
            ?> 
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'pathor_hisab_entry'){echo 'mnu_active';}?>" href="../vaucher/pathor_hisab_entry.php">
                <img src="../img/logo/add3.png" alt="logo" class="img_mnu">
                ক্যাটাগরি এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['pathor_dealer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'pathor_dealer_entry'){echo 'mnu_active';}?>" href="../vaucher/pathor_dealer_entry.php">
                <img src="../img/logo/add4.png" alt="logo" class="img_mnu">
                ডিলার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['pathor_stocks'] == 'yes'){
            ?>
            <!-- <a class="mnu_left <?php if($_SESSION['pageName'] == 'pathor_stocks'){echo 'mnu_active';}?>" href="../vaucher/pathor_stocks.php">
                <img src="../img/logo/add5.png" alt="logo" class="img_mnu">
                স্টক তথ্য
            </a> -->
            <?php
        }
        if($_SESSION['pathor_buyer'] == 'yes'){
            ?>
            <!-- <a class="mnu_left <?php if($_SESSION['pageName'] == 'pathor_buyer_entry'){echo 'mnu_active';}?>" href="../vaucher/pathor_buyer_entry.php">
                <img src="../img/logo/add6.png" alt="logo" class="img_mnu">
                বায়ার এন্ট্রি
            </a> -->
            <?php
        }
        if($_SESSION['pathor_customer'] == 'yes'){
            ?>
            <a class="mnu_left <?php if($_SESSION['pageName'] == 'pathor_customer_entry'){echo 'mnu_active';}?>" href="../vaucher/pathor_customer_entry.php">
                <img src="../img/logo/add5.png" alt="logo" class="img_mnu">
            কাস্টমার এন্ট্রি
            </a>
            <?php
        }
        if($_SESSION['rod_report'] == 'yes'){
            ?>
             <a class="mnu_left <?php if($_SESSION['pageName'] == '45'){echo 'mnu_active';}?>" href="../vaucher/pathor_report_buy_hisab.php"> 
                <img src="../img/logo/reportVector.svg" alt="logo" class="img_mnu">
                রিপোর্ট
            </a>
            <?php
        }
    ?>
</div>