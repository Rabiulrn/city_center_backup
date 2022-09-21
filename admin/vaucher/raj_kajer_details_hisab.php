<?php 
header('Content-Type: text/html; charset=utf-8');
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $_SESSION['pageName'] = 'raj_kajer_details_hisab';
    
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];
    $mistree_id = $_SESSION["mistree_id"] ;
    $mistreeName = $_SESSION["mistreeName"] ;
    $sucMsg = "";

    $mistree_id = $_GET['id'];

    //echo "Mistree ===".$mistree_id;
?>
  
<!DOCTYPE html>
<html>
<head>
    <title>রাজ কাজের হিসাব</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
    <link rel="stylesheet" href="../css/report.css?v=1.0.0">
    <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.0/dist/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>



    <style type="text/css">

        .dateInput{
            line-height: 22px !important;
        }
        .allowText {
            float: right;
            margin-bottom: 3px;
        }
        
        .table-border > tbody > tr > td {
            border: 1px solid #ddd !important;
        }
        .table-border > thead > tr > th {
            border: 1px solid #ddd !important;
        }
        
        .backcircle{
            font-size: 18px;
            position: absolute;
            margin-top: -35px;
        }
        .backcircle a:hover{
            text-decoration: none !important;
        }
        .cenText{
            text-align: center;
        }
        .submitBtn{
            width: 100px;
            float: right;
        }
/*         .main_bar{
            width: 100% !important;
            margin: 0 auto;
            padding-left: 10px;
            padding-right: 10px;
        } */
    .btn.btn-success.add_button {
            margin-top: 24px;
        }    
	.remove_button{
            margin-top: 24px;
    } 
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }   

#r_address {
    
    height: 35px;
   
    }    

.modal {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  overflow: hidden;
}
.modal-dialog {
  position: fixed;
  margin: 0;
  padding: 0;
  height: 100%;
  width: 100%;
}
.modal-header {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  border: none;
}
.modal-content {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  border-radius: 0;
  box-shadow: none;
}
.modal-body {
  position: absolute;
  top: 50px;
  bottom: 0;
  font-size: 15px;
  overflow: auto;
    margin-bottom: 60px;
  padding: 0 15px 0;
  width: 100%;
}
.modal-footer {
    position: absolute;
    right: 0;
    bottom: 0;
    left: 0;
    height: 60px;
    padding: 10px;
    background: #f1f3f5;
}
.modal-header .close {

    font-size: 35px;
    margin-top: -32px;

  }

  .raj_align {
    padding: 0;
    margin: 0;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    align-items: center;
    justify-content: center;
}
.profilePic {
    text-align: center;
}

.profileImg {
text-align: center;

width: 60px;
height: 60px;

border: 1px solid #c7cdd2;
border-radius: 0px;

}
.profiledoc {
    padding: 0;
    margin-right: 8px;
    display: -webkit-box;
    display: -moz-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-left: 20px;
}
.docImg {
    width: 35px;
    margin-right: 20px;
}
.displayCon {
    padding-top: 0;
}
.form-group {
    margin-bottom: 0px;
}
.profile_area {
    display: flex;
     align-items: center; 
     justify-content: center; 

      flex-wrap: wrap;
  gap: 12px;
}

.headingOfAllProject{
  padding-bottom: 20px;
}

.checkmistree{
  height: 34px;
padding: 6px;
border-radius: 4px;
border: 1px solid #ccc;
width: 200px;
}

#searchData {
    margin-top: 10px;
}
#dates_list {

    width: 200px !important;
}
.left_side_bar {
    height: 120vh !important;
}
.inlineDiv {
    display: inline-flex;
}
.custom_text {
    display: flex;
    gap: 20px;
    margin-left: 20px;
    margin-right: 20px;
    align-items: center;
    justify-content: center;
}
.fromToCon {

    height: 70px !important;
}
#backButton {
    margin-top: 10px;
}
.inlineDiv {
    border-bottom: 1px solid #333;
    width: 100%;
    padding-bottom: 7px;
    margin-bottom: 12px;
}
.fromToCon {

    margin: 0px 0 10px;

    border:none;

}


 </style>

</head>
<body>
    <?php
        include '../navbar/header_text.php';
        $page = 'raj_kajer_details_hisab';
        include '../navbar/navbar.php';
    ?>
    <div class="bar_con">
      <div class="left_side_bar">       
        <?php require '../others_page/left_menu_bar_rajkajer_hisab.php'; ?>
      </div>
        <div class="main_bar" style="padding-bottom: 20px; width: calc(80% - 20px);">
   				<div class="project_heading" id="project_heading"></div>
            <?php
                // $query = "SELECT * FROM project_heading WHERE id = '$project_name_id'";
                // $show = $db->select($query);
                // if ($show) {
                //     while ($rows = $show->fetch_assoc()) {
                ?>
                    <!-- <div class="project_heading" id="project_heading">      
                        <h2 class="headingOfAllProject" id="headingOfAllProject">
                           <a href="raj_kajerhisab.php" id="backButton" class="btn btn-success pull-left"> <span class="glyphicon glyphicon-arrow-left"></span>Back</a>
                            <?php //echo $rows['heading']; ?> 
                            <span class="protidinHisab">রাজ কাজের হিসাব</span>
                            , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span>
                            
                        </h2>

                    </div> -->
                <?php 
                    //}
                //} 
            ?>
            
           <!--  <div class="row" style="margin-top: -30px; ">
              <div class="form-group col-md-12">
                    <form name="rajkerMistreeForm"  id="rajkerMistreeForm" class="form-horizontal" style="margin-top:20px ">
                      <div class="form-group col-md-4">
                      	<div id="success">
              
            			</div>
        			  </div>
                      <div class="form-group col-md-4">

                      </div>
                      <div class="form-group col-md-4">
                      	<table class="table table-border table-condensed" id="rajkerMistreeFormTable">
                
                          <thead>
                                  <tr>
                                      <th class="cenText">হেড মিস্ত্রী নাম</th> 

                                  </tr>
                          </thead>
                          <tbody>
                                <tr>
                                    <td>
                                      <div class="hedmistress"> </div>
                                    </td> 
                                    
                                </tr>
                          </tbody>
                        </table>
                      </div>
                      
                    </form> 
              </div>
              
            </div>

 -->
    <div class="row">
      <div class="col-md-1">

        <a href="raj_kajerhisab.php" id="backButton" class="btn btn-success"> <span class="glyphicon glyphicon-arrow-left"></span>Back</a>
      </div>
       <div class="col-md-11">
        <div class="fromToCon noprint">
          <!-- <span class="searchBy">Search By:</span> -->
          <button href="#" onclick="myFunction()" class="btn printBtn noprint">Print</button>
          <button href="#" onclick="downloadfile()" class="btn downlaodBtn noprint">Download</button>

          <span class="onlyDate">
         <!-- <b style="margin-right: 10px">Date: </b>
           <span style="margin-left: -9px;">

            <span class="dates_list"> </span>
          </span> -->
          <button type="button" class="btn btn-info" onclick="getAllDetails()" id="showAllDates">Show all datas</button>

            <span class="hedmistress"> </span>

          <span id="biboronCon" style="display: inline-block;"></span>
          </span>
          <!-- <input type="text" class="form-control" placeholder="Search..." id="searchData"> -->
        </div>
      </div>
    </div>
       
<!-- ================ -->
            
    <div class="displayCon" id="displayCon">
              
            <div  id="details_data"></div>
                          
              <div id="allDatas">
                <h3 id="heading" style="text-align: center; margin-top: 0px;">কাজের হিসাব</h3>
               
                    <table class="table_dis" id="detailsNewTable2">
                      <thead>
                          <tr style="background-color: #b5b5b5;">
                                <th class="cenText">নং</th>
                                <th class="cenText" style="width: 86px;">তারিখ</th>
                                <th class="cenText">ঠিকানা</th> 
                                <!-- <th class="cenText">কাজের স্থান</th>                         -->
                                <th class="cenText">হেড মিস্ত্রী নাম</th>                               
                                <th class="cenText">মারফোত নাম</th>                              
                                <th class="cenText">কান্ট্রাক</th>
                                <th class="cenText">বাক্তির ধরণ</th>
                                <th class="cenText">দর</th>
                                <th class="cenText">জন</th>
                                <th class="cenText">কাজের বিল</th>
                                <th class="cenText">নগদ জমা</th>
                                <th class="cenText">পাওনা</th>

                          </tr>
                         
                      </thead>
                      <tbody id="alldata_area">
                       
                      </tbody>
                        

                    </table>      
              
                </div>              
            </div>
            <div id="editor">
              
            </div>


        </div>
    </div>


 <?php include '../others_page/delete_permission_modal.php';  ?>
       
<script type="text/javascript">


$(document).ready(function() {
  //alert("helo");
  var mistree_id ="<?php echo $mistree_id ?>";
  //alert(mistree_id);
  setTimeout(() => {
    if(mistree_id != ''){
      $("#hedmistress_name option").prop("selected", false);
      $("#hedmistress_name option[value='"+mistree_id+"']").attr('selected','selected').trigger('change');
    }
    else{
      $("#hedmistress_name option").prop("selected", false);
    $("#hedmistress_name option:first").attr('selected',true).trigger('change');
    }
  }, 0);


//document.getElementById("hedmistress_name").options.namedItem("1").selected=true;
//$("#hedmistress_name").prop("selectedIndex", 0).change();


 $("#showAllDates").on('click', function(){
    $('#allDatas').show();
    $('#details_data').hide();
  

 });


});
$('#allDatas').hide();
  headmistressName(); 
headmistressDateEntry();
//headmistressName(); 
function headmistressName(){

  var checkheadmistress ="checkheadmistress";
    $.ajax({
        url: 'raj_kajermistresstable.php',
        type: 'POST',
       // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {checkheadmistress: checkheadmistress},
        success :function(data, status){
            $(".hedmistress").html(data);
            //alert('message========',data)
                console.log("data =============", data)
        }, 
        error: function(error){
    console.log("error =============", error)
        }
    });



}
// Mistree data entry
//headmistressDateEntry();
function headmistressDateEntry(){

  var checkdate ="checkdate";
    $.ajax({
        url: 'raj_kajermistresstable.php',
        type: 'POST',
       // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {checkdate: checkdate},
        success :function(data, status){
            $(".dates_list").html(data);
            //alert('message========',data)
              console.log("data =============", data)
              $('.left_side_bar').height($('.main_bar').height());
        }, 
        error: function(error){
    console.log("error =============", error)
        }
    });



}

//alert('dsfds');

$(document).on('change', '.checkmistree', function(){
    $('#allDatas').hide();
   $('#details_data').show();

	console.log( $(this).val());
  	var id = $(this).val(); 
 		// console.log(" mistree name", $( "#r_location_name option:selected" ).text());  
     var action = 'view_details';
     var hedmistress_name = $( "#hedmistress_name option:selected" ).text();
     var  mydata = {
      id:id,
      hedmistress_name:hedmistress_name, 
      action:action
    };
     $.ajax({
        url:"raj_LocationInsert.php",
        type:"POST",
        data:mydata,
      success:function(data)
      {
        console.log("details_data===========",data);
  		$('.left_side_bar').height($('.main_bar').height());
         $("#details_data").html(data);       
      },
      error: function(data) {
            console.log(data);
       }
    });

});
// All date values 
$(document).on('change', '.checkDate', function(){

  console.log( $(this).val());
    var id = $(this).val(); 
    // console.log(" mistree name", $( "#r_location_name option:selected" ).text());  
     var action = 'date_details';
     var r_date = $( "#dates_list option:selected" ).text();
     var  mydata = {
      id:id,
      r_date:r_date, 
      action:action
    };
     $.ajax({
        url:"raj_LocationInsert.php",
        type:"POST",

        data:mydata,
       
      success:function(data)
      {
        console.log("details_data===========",data);

         $("#details_data").html(data);
    
      },
      error: function(data) {
            console.log(data);
          }
    });

});

//Get all mistree datas
// getAllDetails();
   function getAllDetails(){

        var checkAlldata ="checkAlldata";
    $.ajax({
        url: 'raj_kajermistresstable.php',
        type: 'POST',
        data: {checkAlldata: checkAlldata},
        success :function(response, status){
            $("#alldata_area").html(response);
           
                console.log("datass =============", response)
        }, 
        error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                    alert('Error - ' + errorMessage);
        }
    });



}


function myFunction(){
    var header = document.getElementById('project_heading');
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = mm + '/' + dd + '/' + yyyy;

    var divToPrint = document.getElementById('displayCon');
    var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border:1px solid #000; ' +
        'padding;0.5em;' +
        '}' +
        'table{' +
        'margin: 0px auto; ' +
        'padding;0.5em;' +
        '}' +
        '.profiledoc{' +
        'display:none; ' +
        '}' +
        '.profileImg{' +
        'display:none; ' +
        '}' +
        '.table_dis{' +
        'margin: 0px auto; ' +
        '}' +
        '.raj_align p{' +
        'text-align: center; ' +
        '}' +
        '#backButton{' +
        'display: none; ' +
        '}' +
        '#project_heading{' +
        'text-align: center; ' +
        '}' +
        'div{' +
        'display: block; ' +
        'text-align: center; ' +
        '}' +
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(header.outerHTML);
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
         
}




function downloadfile(){
  var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
      }
  };


  var doc = new jsPDF();
    doc.addHTML($('#displayCon')[0], 15, 15, {
      'background': '#fff',
    }, function() {
      doc.save('sample.pdf');
    });
}
   
window.onload = function(){
 getAllDetails();
}



</script>

    <script src="../js/common_js.js"></script>
</body>
</html>