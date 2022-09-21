<!-- Left menu bar con -->
<div id="left_all_menu_con">
	<a class="header_mnu_left" href="../vaucher/doinik_all_hisab.php" >
		<img src="../img/logo/summary.png" alt="logo" class="img_mnu">
		দৈনিক হিসাব
	</a>


	<?php
		if($_SESSION['protidiner_hisab'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'protidiner_hisab'){echo 'mnu_active';}?>" href="../vaucher/index.php">
				<img src="../img/logo/summary.png" alt="logo" class="img_mnu">
				প্রতিদিনের হিসাব
			</a>
			<?php
		}
		if($_SESSION['modify_data'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'modify_data'){echo 'mnu_active';}?>" href="../vaucher/modify_vaucher.php">
				<img src="../img/logo/modify2.png" alt="logo" class="img_mnu">
				মডিফাই ডাটা
			</a>
			<?php
		}
		if($_SESSION['joma_khat'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'joma_khat'){echo 'mnu_active';}?>" href="../vaucher/add_vaucher_credit.php">
				<img src="../img/logo/newentry.png" alt="logo" class="img_mnu">
				জমা খাত এন্ট্রি
			</a>
			<?php
		}
		if($_SESSION['khoros_khat'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'khoros_khat'){echo 'mnu_active';}?>" href="../vaucher/add_vaucher_group.php">
				<img src="../img/logo/khoros.png" alt="logo" class="img_mnu">
				খরচ খাতের হেডার
			</a>
		<?php
		}
		if($_SESSION['khoros_khat_entry'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'khoros_khat_entry'){echo 'mnu_active';}?>" href="../vaucher/add_vaucher_data_by_search.php">
				<img src="../img/logo/khoros_entry.png" alt="logo" class="img_mnu">
				খরচ খাত এন্ট্রি
			</a>
			<?php
		}
		if($_SESSION['nije_pabo'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'nije_pabo'){echo 'mnu_active';}?>" href="../vaucher/nij_paonadar_add.php">
				<img src="../img/logo/nijepabo.png" alt="logo" class="img_mnu">
				নিজে পাবো এন্ট্রি
			</a>
			<?php
		}
		if($_SESSION['paonader'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'jara_pabe'){echo 'mnu_active';}?>" href="../vaucher/jara_pabe_add.php">
				<img src="../img/logo/paonader.png" alt="logo" class="img_mnu">
				পাওনাদার এন্ট্রি
			</a>
			<?php
		}
		if($_SESSION['report'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'report'){echo 'active';}?>" href="../vaucher/report_joma.php">
				<img src="../img/logo/report.png" alt="logo" class="img_mnu">
				রিপোর্ট
			</a>
			<?php
		}
		if($_SESSION['agrim_hisab'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'agrim_hisab'){echo 'mnu_active';}?>" href="../vaucher/agrim_hisab.php">
				<img src="../img/logo/payment-icon.png" alt="logo" class="img_mnu">
					অগ্রিম হিসাব
			</a>
			<?php
		}
		if($_SESSION['cash_calculator'] == 'yes'){
			?>
			<a class="mnu_left <?php if($_SESSION['pageName'] == 'cash_calculator'){echo 'mnu_active';}?>" href="../vaucher/cash_calculator.php">
				<img src="../img/logo/calc.png" alt="logo" class="img_mnu">
				ক্যাশ ক্যালকুলেটর
			</a>
			<?php
		}
	?>
</div>	
