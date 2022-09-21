<?php 
session_start();  
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$project_name_id = $_SESSION['project_name_id'];

$dateList = $_GET['date'];
$group_id = $_GET['vaucherList'];
$biboron = $_GET['biboronList'];


// $optionDate = date('Y-m-d', strtotime($_GET['date']));
?>

<html>

<head>
	<title>Download</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
	<style type="text/css">
		
	</style>
</head>
<body>
	<div>
      <p style="text-align: center;"><button style="color: #fff; font-weight: bold; font-size: 14px; background-color: green; padding: 5px 10px; cursor: pointer; " onclick="download()">Download</button></p>
        <!-- <table id="container_table" style="font-size: 12px; border-collapse: collapse;" > -->
            <?php
              if(($dateList == 'alldates' && $group_id !='none' && $biboron == undefined) || ($dateList == 'alldates' && $group_id !='none' && $biboron == 'none')) {
                  //alldate, all_group

              } else if($dateList != 'alldates' && $group_id !='none' && $biboron == undefined){
                  //date, all_group
              }
              // else if($dateList == 'alldates' && $group_id !='none' && $biboron == 'none'){
              //     //alldate, all_group
              // }
              else if($dateList == 'alldates' && $group_id !='none' && $biboron != 'none'){
                  //alldate, all_group, biboron
              } else if($dateList != 'alldates' && $group_id !='none' && $biboron == 'none'){
                  //date, all_group
              } else if($dateList != 'alldates' && $group_id !='none' && $biboron != 'none'){
                  //date, all_group, biboron
              } else {
                  echo '<tr><td>Logic not found (download_filter.php) !</td></tr>';
              }
            ?>
        <!-- </table> -->
        <?php
          echo $_GET['mytable'];
        ?>
  </div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script type="text/javascript">
	
	function download(){
		// var doc = new jsPDF();          
		// var elementHandler = {
		//   '#ignorePDF': function (element, renderer) {
		//     return true;
		//   }
		// };
		// var source = window.document.getElementById("container_table");
		// doc.fromHTML(
		//     source,
		//     15,
		//     15,
		//     {
		//       'width': 180,
		//       'elementHandlers': elementHandler
		//     });

		// // doc.save("daily-work.pdf");
		// doc.output("dataurlnewwindow");







		var pdf = new jsPDF('p', 'pt', 'letter');
      source = $('#container_table')[0];

	    specialElementHandlers = {
	        '#bypassme': function (element, renderer) {
	            return true
	        }
	    };
	    margins = {
	        top: 80,
	        bottom: 60,
	        left: 40,
	        width: 522
	    };
	    pdf.fromHTML(
  	    source, // HTML string or DOM elem ref.
  	    margins.left, // x coord
  	    margins.top, { // y coord
  	        'width': margins.width, // max width of content on PDF
  	        // 'elementHandlers': specialElementHandlers
  	    },

  	    function (dispose) {
  	        pdf.save('Test.pdf');
  	    }, margins);		
	}
</script>
</body>
</html>