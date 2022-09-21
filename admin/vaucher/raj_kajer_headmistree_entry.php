<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $_SESSION['pageName'] = 'raj_kajer_mistree';
    $user_name				= $_SESSION['username'];
	$user_type 				= $_SESSION['usertype'];
	$is_super_admin			= $_SESSION['is_super_admin'];
    
    $project_name_id = $_SESSION['project_name_id'];
    $edit_data_permission   = $_SESSION['edit_data'];
    $delete_data_permission = $_SESSION['delete_data'];
    $sucMsg = "";

   
  if(isset($_POST['data_delete_id'])){
      $id = $_POST['data_delete_id'];

      $sql = "DELETE FROM raj_kajerhisab WHERE id = '$id'";
      $result = $db->delete($sql);
      if ($result) {
          $sucMsg = "Data delete successfully !";
      } else {
          echo "Error: " . $sql . "<br>" .$db->error;
      }
  }
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
  .displayCon {
    padding-top: 0;
}
.left_side_bar {
    height: 120vh !important;
}
.error {
    color: #fb1515;
}
input[class="error"]{border:1px solid #f00 !important;} 
input[class="form control error"]{border:1px solid #f00 !important;} 
.error p{color:#f00 !important;}
#rajkerMistreeFormTable td label {
    color: #dd150b;
}
#cancle_hedmistress {
    margin-left: 20px;
}
</style>

</head>
<body>
    <?php
        include '../navbar/header_text.php';
        $page = 'raj_kajer_mistree';
        include '../navbar/navbar.php';
    ?>
    <div class="bar_con">
      <div class="left_side_bar">       
        <?php require '../others_page/left_menu_bar_rajkajer_hisab.php'; ?>
      </div>
        <div class="main_bar" style="padding-bottom: 20px; width: calc(80% - 20px);">
            <?php
                $query = "SELECT * FROM project_heading WHERE id = '$project_name_id'";
                $show = $db->select($query);
                if ($show) {
                    while ($rows = $show->fetch_assoc()) {
                ?>
                    <div class="project_heading" id="project_heading">      
                        <h2 class="headingOfAllProject">
                            <?php echo $rows['heading']; ?> 
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; ?></span> -->
                            
                        </h2>
                    </div>
                <?php 
                    }
                } 
            ?>
            <div id="success">
                
            </div>




            <!-- Full Height Modal Right -->
            <div class="modal fade top" id="fullHeightModalRight" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
              aria-hidden="true">

              <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
              <div class="modal-dialog modal-full-height modal-top" role="document">


                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body" id="modal-body">
                    
                  </div>
                  <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
<!-- Full Height Modal Right -->

            <strong style="font-size: 18px">হেড মিস্ত্রী এন্ট্রি</strong> 
            <form name="rajkerMistreeForm"  id="rajkerMistreeForm" enctype="multipart/form-data"  style="margin-top:20px ">

              <table class="table table-border table-condensed" id="rajkerMistreeFormTable">
                
                <thead>
                        <tr>
                            <th class="cenText">হেড মিস্ত্রী</th>
                            <th class="cenText">মোবাইল নাম্বার</th>
                            <th class="cenText">ঠিকানা</th>
                            <th class="cenText">মারফোত নাম</th>
                            <th class="cenText">কান্ট্রাক</th>
                            <th class="cenText">প্রোফাইল ছবি</th>
                            <th class="cenText">ডকুমেন্ট</th>

                        </tr>
                </thead>
                <tbody>
                  <tr>
                  	<input type="hidden" name="id" id="id">
                    <td colspan="" rowspan="" headers="">
                      <input type ="text" class = "form-control" name="hedmistress_name" id = "hedmistress_name" placeholder = "হেড মিস্ত্রী নাম">
                      <p class="name_err" ></p>
                    </td>
                    <td colspan="" rowspan="" headers="">
                      <input type ="text" class = "form-control" name="hedmistress_mobile_num" id ="hedmistress_mobile_num" placeholder = "মোবাইল নাম্বার">
                    </td>
                    <td colspan="" rowspan="" headers="">
                      <input type ="text" class="form-control" name="address" id ="address" placeholder = "ঠিকানা">
                    </td>
                    <td colspan="" rowspan="" headers="">
                      <input type ="text" class ="form-control" name="marphot_name" id ="marphot_name" placeholder = "মারফোত নাম">
                      <p class="marphot_err" ></p>
                    </td>
                    <td colspan="" rowspan="" headers="">
                      <input type ="text" class = "form-control" name="contract" id ="contract" placeholder = "কান্ট্রাক">
                       <p class="contract_err" ></p>
                    </td>
                    <td colspan="" rowspan="" headers="">
                    <input type ="hidden"  name="hedmistress_old_pic" id ="hedmistress_old_pic" >
                      <input type ="file" class= "form-control" name="hedmistress_profile_pic" id ="hedmistress_profile_pic" onchange="checkextension()">
                    </td>
                    <td colspan="" rowspan="" headers="">
                      <input type ="hidden"  name="hedmistress_old_ducument" id ="hedmistress_old_ducument" >
                      <input type ="file" class = "form-control" name="hedmistress_ducument" id ="hedmistress_ducument" placeholder = "ডকুমেন্ট" onchange="checkextensiondoc()">
                    </td>

                  </tr>
                </tbody>

              </table>

                <div class="row">  
                        <div class = "form-group col-sm-12">
                            <button type="button" name="submit_hedmistress" id="submit_hedmistress" class = "btn btn-primary pull-right">Save</button>
                            
                            <button type="button" name="cancle_hedmistress" id="cancle_hedmistress" class = "btn btn-danger pull-right">Cancle</button>
                            <button type="button" name="update_hedmistress" id="update_hedmistress" class = "btn btn-success pull-right">Update</button>
                        </div>
                </div> 
             
            </form> 
            <div class="displayCon">
                <h3 style="text-align: center; margin-top: 0px;">রাজ কাজের হিসাব</h3>
               
                    <table class="table_dis">
                      <thead>
                          <tr style="background-color: #b5b5b5;">
                                <th class="cenText">নং</th>                        
                                <th class="cenText">হেড মিস্ত্রী নাম</th>
                                 <th class="cenText">মোবাইল নাম্বার</th>
                                 <th class="cenText">প্রোফাইল ছবি</th>
                                 <th class="cenText">ডকুমেন্ট</th>
                                <th class="cenText">ঠিকানা</th> 
                                <th class="cenText">মারফোত নাম</th>
                                 <th class="cenText">কান্ট্রাক</th>
                                <th class="cenText" style="width: 76px;">view</th>
                                <th class="cenText" style="width: 76px;">Delete</th>
                                <th class="cenText" style="width: 59px;">Edit</th>
                          </tr>
                         
                      </thead>
                      <tbody id="mistress_details">
                       
                      </tbody>
                        

                    </table>      
              
            </div>

        </div>
    </div>


<!-- Modal details view -->





    <?php include '../others_page/delete_permission_modal.php';  ?>
       
    <script type="text/javascript">

	datepickerfunction();
	$(function(){
		        $("body").on("click", ".add_button", function() {
		        	$('.mistree_name_show:last-child').val( $("#r_hedmistress").find('option:selected').text());
		            datepickerfunction();
		        });
		    });
     function datepickerfunction(){
        $('.r_date').datepicker( {
              onSelect: function(date) {
                  // alert(date);
                  $(this).change();
              },
              dateFormat: "dd/mm/yy",
              changeYear: true,
          }).datepicker("setDate", new Date());
    }

   $(document).on('change','#r_hedmistress', function(){

    	$('.mistree_name_show').val( $(this).find('option:selected').text());
    });

    // var $option = $('.r_hedmistress').val();
    // var value = $option.val();
    // $(".mistree").val(value);
    // console.log("value ==========",value);
    // var text = $option.text();


  function delete_row(ele){
            var data_row_id = $(ele).attr('data_row_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").attr("data_row_id", data_row_id);            
        }
        $(document).on('click', '#verifyToDeleteBtn', function(){
            delete_vaucher_credit_data($(this).attr("data_row_id"));
        });

        function delete_vaucher_credit_data(data_row_id){
            console.log(data_row_id);
            $("#passMsg").html("").css({'margin':'0px'});          
            var pass = $("#matchPassword").val();
            $.ajax({
                url: "../ajaxcall/match_password_for_vaucher_credit.php",
                type: "post",
                data: { pass : pass },
                success: function (response) {
                  // alert(response);
                  if(response == 'password_matched'){
                      $('#sucMsg').html('');
                      $("#verifyPasswordModal").hide();
                      ConfirmDialog('Are you sure to delete joma khat entry ?', data_row_id);
                  } else {
                      $("#passMsg").html(response).css({'color':'red','margin-top':'10px'});
                  }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
                }
            });
            function ConfirmDialog(message, data_row_id){
                $('<div></div>').appendTo('body')
                                .html('<div><h4>'+message+'</h4></div>')
                                .dialog({
                                    modal: true, title: 'Alert', zIndex: 10000, autoOpen: true,
                                    width: '40%', resizable: false,
                                    position: { my: "center", at: "center center-20%", of: window },
                                    buttons: {
                                        Yes: function () {
                                            $(this).dialog("close");
                                            $.post("raj_kajermistresstable.php", {
                                              data_delete_id : data_row_id
                                            }, function(data, status){
                                                console.log(status);
                                                console.log(data);
                                                if(status == 'success'){
                                                    // $('#sucMsg').html('succsess');
                                                    window.location.href = 'raj_kajer_headmistree_entry.php';
                                                }
                                            });
                                        },
                                        No: function () {
                                            $(this).dialog("close");
                                        }
                                    },
                                    close: function (event, ui) {
                                        $(this).remove();
                                    }
                                });
            }
        }
                
        function display_update(ele){
            console.log(ele);
            var data_row_id = $(ele).attr('data_row_id');
            var row_date = $(ele).closest('tr').find('td:eq(1)').text();
            var row_name = $(ele).closest('tr').find('td:eq(2)').text();
            var data_row_amount = $(ele).attr('data_row_amount');
            
            $('#sucMsg').html('');
            $('#data_row_id').val(data_row_id);
            $('#submitBtnId').val('Update');
            $('#r_date1').val(row_date);
            $('#credit_name1').val(row_name);
            $('#credit_amount1').val(data_row_amount);
            $('#add').attr('disabled', '');
            $('html, body').animate({ scrollTop: 0 }, 600);
        }
    </script>
    <script type="text/javascript" id="script-1">
 
        if($('.main_bar').innerHeight() > $('.left_side_bar').height()){
            $('.left_side_bar').height($('.main_bar').innerHeight() + 34);
        } else {
            $('.left_side_bar').height(640);
        }
        function heightChange(){
            var left_side_bar_height = $('.left_side_bar').height();
            var main_bar_height = $('.main_bar').innerHeight();
            if(left_side_bar_height >= main_bar_height){
                // $('.left_side_bar').height(main_bar_height + 25);          
            } else {
                $('.left_side_bar').height(main_bar_height + 25);            
            }
        }
    </script>
<script type="text/javascript">





    hedmistressAllData();
   function hedmistressAllData(){
    var mistree_details ="mistree_details";
    $.ajax({
        url: 'raj_kajermistresstable.php',
        type: 'POST',
        data: {mistree_details: mistree_details},
        success :function(response, status){
            $("#mistress_details").html(response);
           
                console.log("datass =============", response)
        }, 
        error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                    alert('Error - ' + errorMessage);
        }
    });



}
	// check image extension
	function checkextension() {
	  var file = document.querySelector("#hedmistress_profile_pic");
	  if ( /\.(jpe?g|png|gif|jpg)$/i.test(file.files[0].name) === false ) { 
	  	alert("This is not an image!"); 
	  	$("#hedmistress_profile_pic").val('');

	  }
	}
	function checkextensiondoc() {
	  var file = document.querySelector("#hedmistress_ducument");
	  if ( /\.(pdf|doc|docx|txt|xlsx|xls|csv)$/i.test(file.files[0].name) === false ) { 
	  	alert("This is not document format!"); 
	  	$("#hedmistress_ducument").val('');
	  }
	}

  $('#submit_hedmistress').on('click', function() {
      var hedmistress_name              = $("input[name='hedmistress_name']").val();
      var hedmistress_mobile_num        = $('input[name="hedmistress_mobile_num"]').val();
      var address                       = $('input[name="address"]').val();
      var marphot_name                  = $('input[name="marphot_name"]').val();
      var contract                      = parseFloat($('input[name="contract"]').val());
    //  var contract                    = parseFloat(contract1);
      var hedmistress_status            = "1";
      var project_name_id               ="<?php echo $_SESSION['project_name_id'] ?>";

    	if($('#hedmistress_name').val() == ''){
       		 $('.name_err').html('<div class="error">Name is required</div>');
       		 return false; 
    	}
	 	else if($('#marphot_name').val()== ''){
       		 $('.marphot_err').html('<div class="error">This field required</div>');
       		 return false; 
    	}
        else if($('#contract').val()==''){
       		 $('.contract_err').html('<div class="error">This field required</div>');
       		 return false; 
    	}else{

      	  var formData = new FormData($('#rajkerMistreeForm')[0]);
          formData.append("hedmistress_name", hedmistress_name);
          formData.append("hedmistress_mobile_num", hedmistress_mobile_num);
          formData.append("hedmistress_profile_pic", $('input[name="hedmistress_profile_pic"]')[0].files[0]);
          formData.append("hedmistress_ducument", $('input[name="hedmistress_ducument"]')[0].files[0]);
          formData.append("address", address);
          formData.append("marphot_name", marphot_name);
          formData.append("contract", contract);
          formData.append("hedmistress_status", hedmistress_status);
          formData.append("project_name_id", project_name_id);

     
            $.ajax({
                url: "raj_kajermistress.php",
                type: "POST",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data){
                  console.log("Mistree name data ========== ",data)
                    //$('#success').html('Data added successfully !'); 
                     if(data){
                     	alert('Data added successfully !');
                     	$('#rajkerMistreeForm')[0].reset();                       
                       hedmistressAllData();   
                     }else{
                     	console.log(data.error);
                     }
                    	          
         
                },
                error: function(data){
                //var errorMessage = xhr.status + ': ' + xhr.statusText
                    console.log('Error mistree - ' + data);
                }

            });
        }

    });

	$('#submit_hedmistress').show();
	$('#update_hedmistress').hide();
	$('#cancle_hedmistress').hide();

$(document).on('click', '#cancle_hedmistress', function(){
	$('#rajkerMistreeForm')[0].reset();
	$('#submit_hedmistress').show();
	$('#update_hedmistress').hide();
	$('#cancle_hedmistress').hide();

});

$(document).on('click', '.mistree_editBtn', function(){
	    $('#submit_hedmistress').hide();
        $('#cancle_hedmistress').show();
        $('#update_hedmistress').show();

     var id = $(this).attr('id');
     //alert(id);
     var action = 'edit_mistree_single';
     var  data = {
      id:id, 
      action:action
    };
     $.ajax({
        url:"raj_kajermistresstable.php",
        type:"POST",
        dataType:"JSON",
        data:data,
       
      success:function(data)
      {
        console.log("editdata==========",data);
        $('#id').val(data.id);
        $('#hedmistress_name').val(data.hedmistress_name);
        $('#hedmistress_mobile_num').val(data.hedmistress_mobile_num);
        $('#address').val(data.address);
        $('#marphot_name').val(data.marphot_name);
        $('#contract').val(data.contract);
        $('#hedmistress_old_pic').val(data.hedmistress_profile_pic);
        $('#hedmistress_old_ducument').val(data.hedmistress_ducument);       

        //$('#id').val(data.id);
        console.log(data);
        
      },
      error: function(data) {
            console.log("Error mistree data===",data);
          }
    });

  });



 $('#update_hedmistress').on('click', function() {
 	  var id              				= $('#id').val();
      var hedmistress_name              = $("input[name='hedmistress_name']").val();
      var hedmistress_mobile_num        = $('input[name="hedmistress_mobile_num"]').val();
      var address                       = $('input[name="address"]').val();
      var marphot_name                  = $('input[name="marphot_name"]').val();
      var contract                      = parseFloat($('input[name="contract"]').val());
      var hedmistress_old_pic      		= $('input[name="hedmistress_old_pic"]').val();
      var hedmistress_old_ducument      = $('input[name="hedmistress_old_ducument"]').val();
      var action = 'mistree_update';
      var formData = new FormData($('#rajkerMistreeForm')[0]);
          formData.append("hedmistress_name", hedmistress_name);
          formData.append("hedmistress_mobile_num", hedmistress_mobile_num);
          formData.append("hedmistress_profile_pic", $('input[name="hedmistress_profile_pic"]')[0].files[0]);
          formData.append("hedmistress_old_pic", hedmistress_old_pic);
          formData.append("hedmistress_old_ducument", hedmistress_old_ducument);
          formData.append("hedmistress_ducument", $('input[name="hedmistress_ducument"]')[0].files[0]);
          formData.append("address", address);
          formData.append("marphot_name", marphot_name);
          formData.append("contract", contract);
          formData.append("action", action);

            $.ajax({
                url: "raj_kajermistresstable.php",
                type: "POST",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(data){
                  console.log("Mistree update data ========== ",data)
                    //$('#success').html('Data added successfully !'); 
                     alert(data); 
                    	$('#rajkerMistreeForm')[0].reset();                       
                       hedmistressAllData();             
         
                },
                error: function(error){
                //var errorMessage = xhr.status + ': ' + xhr.statusText
                    console.log('Error mistree - ' + error);
                }

            });
        
    });

$(document).on('click', '.deleteBtn', function(){

     var id = $(this).attr('id');
     //alert(id);
     var action = 'delete_single';
     var  mydata = {
      id:id, 
      action:action
    };
     $.ajax({
        url:"raj_kajermistresstable.php",
        type:"POST",
        dataType:"JSON",
        data:mydata,
       
      success:function(data)
      {
        console.log(data);
        alert(data);
        getHedmistressDetails();
        
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
    });

  });





  $(document).on('click', '.mistree_viewBtn', function(){
    

     var id = $(this).attr('id');
     //alert(id);
     var action = "auto_view";
     var  mydata = {
      id:id, 
      action:action
    };
     $.ajax({
        url:"raj_LocationInsert.php.php",
        type:"POST",
        data:mydata,
      success:function(data)
      {
         //$("#modal-body").html(data);
        console.log("mistree_view======",data);
        $("#details_data").html(data);  
        
      },
      error: function(data) {
            console.log(data);
          }
    });

  });
</script>

    <script src="../js/common_js.js"></script>
</body>
</html>