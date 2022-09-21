<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:../index.php');
    }
    require '../config/config.php';
    require '../lib/database.php';
    $db = new Database();
    $_SESSION['pageName'] = 'raj_kajerhisab';
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

  $hedmistress = "SELECT * from raj_kajer_hedmistress where  project_name_id ='$project_name_id' ";

                $mData = $db->select($hedmistress);
                  if ($mData) {
                      $i = 1;

                      
                

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
   
.remove_button{
            margin-top: 0px;
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
.row.commonrow .form-group {
    padding-left: 2px;
    padding-right: 2px;
}
#error_name{
 color: #f90707;

}
.err_job_cat{
color: #f90707;

}
.err_taka{
color: #f90707;
  
}
#r_hedmistress {
    width: 220px;
}
    </style>

</head>
<body>
    <?php
        include '../navbar/header_text.php';
        $page = 'raj_kajerhisab';
        include '../navbar/navbar.php';
    ?>
    <div class="bar_con">
      <div class="left_side_bar">       
        <?php require '../others_page/left_menu_bar_rajkajer_hisab.php'; ?>
      </div>
 
        <div class="main_bar" style="padding-bottom: 20px; width: calc(80% - 20px);">
       
        <div class="row" id="back_again" style="margin-top: 5px;">
          <div class="col-md-12">
          <button name="" id="" class="btn btn-success" role="button">Back</button> 

          </div>
        </div>
      <div class="row" id="mistree_talika">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title ">মিস্ত্রী নাম তালিকা :</h3>
            </div>
              <div class="list-group">
                <ul class="list-group list-group-flush">
                  <?php 
                        while ($mrows = $mData->fetch_assoc()) {

                          $_SESSION["mistreeName"] = $mrows['hedmistress_name'];
                          $_SESSION["mistree_id"] = $mrows['id'];
                          ?>
                  <li class="list-group-item">
                    <a data-mistreeName="<?php echo $mrows['hedmistress_name'] ?>" data-id="<?php echo $mrows['id'] ?>" href="javascript:void(0)" class="list-group-item list-group-item-action mistree-name"><?php echo $mrows['hedmistress_name']; ?></a>
                  </li>

                <?php  } } ?>
                  
                </ul>
            </div>
          </div>


        </div>

      </div>  
      <div id="hidden_div">

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



              <form  method="POST"  id="rajkerForm" name="rajkerForm" style="margin-top:20px ">
               <table class="table table-border table-condensed" id="rajkerFormTable">
                    <input type="hidden" name="id" id="id">                
                <thead>
                        <tr>
                            <th class="cenText">তারিখ</th>
                            <th class="cenText">মিস্ত্রী নাম</th>
                            <th class="cenText">বাক্তির ধরণ</th>
                            <th class="cenText">দর</th>
                            <th class="cenText">জন</th>
                            <th class="cenText">কাজের বিল</th>
                            <th class="cenText">নগদ জমা</th>
                            <th class="cenText">পাওনা</th>                            
                            <th class="cenText">Add</th>
                             <th class="cenText">Remove</th>
                        </tr>
                </thead>

                <tbody class="table_tbody">
                                
               <tr>
                <div class="row commonrow" row-id="row1">
                  <td colspan="" rowspan="" headers="">
                     <input type="text" class="form-control r_date" id="r_date" name="r_date[]" placeholder="তারিখ">

                  </td>
                  <td colspan="" rowspan="" headers="">
                     <div class="r_hedmistress" >
                          
                      </div>
                      <div id="error_name"> </div>                                             
                  </td>
                  <td colspan="" rowspan="" headers="">
                     
                      <input type="text" class="form-control r_job_cat" data-id="r_job_cat1" id="r_job_cat" name="r_job_cat[]" placeholder="বাক্তির ধরণ">
                       <div class="err_job_cat"> </div>
                  </td>
                  <td colspan="" rowspan="" headers="">
                     
                      <input type="text" name="r_taka[]" id="r_taka" onkeyup="update_amounts()" data-id="r_taka1" class="form-control r_taka" onkeypress="return isNumberKey(event)" placeholder="দর" >
                       <div class="err_taka"> </div>
                  </td>
                  <td colspan="" rowspan="" headers="">
                     
                  <input type="text" class="form-control r_person" name="r_person[]" id="r_person" data-id="r_person1" onkeyup="update_amounts()"  onkeypress="return isNumberKey(event)" placeholder="জন">
                  <div class="err_person"> </div>
                  </td>
                   
                  <td colspan="" rowspan="" headers="">
                     
                   <input type="text" class="form-control r_totalbill" name="r_totalbill[]" data-id="r_totalbill1" data-default="0" id="r_totalbill" onkeyup="update_amounts()"  placeholder="কাজের বিল" readonly>
                  </td>
                  <td colspan="" rowspan="" headers="">
                     
                  <input type="text" class="form-control r_credit" name="r_credit[]" data-id="r_credit1" id="r_credit" data-default="0" onkeyup="update_amounts()" onkeypress="return isNumberKey(event)"  placeholder="নগদ জমা" >
                  </td>
                  <td colspan="" rowspan="" headers="">
                     
                  <input type="text" class="form-control r_paowna" name="r_paowna[]" data-id="r_paowna1" id="r_paowna"  data-default="0" onkeyup="update_amounts()"  placeholder="পাওনা" readonly>
                  </td>
                  <td colspan="" rowspan="" headers="">

                      <button class="btn btn-success add_button" type="button" > <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>
                       
                  </td>
                  <td colspan="" rowspan="" headers="">
                    <button class="btn btn-danger disabled" type="button"> <span class="glyphicon glyphicon-minus " aria-hidden="true"></span> </button>
                  </td>
                   
                 
                </tr>

                <div class="field_wrapper">
                    
                </div>
              </tbody>
           
              </table>
                <div class="row">
                        <div class="form-group col-md-12">
                        <button name="submit" name="submit" id="submit_btn" type="button" class="btn btn-primary pull-right">Submit</button>
                        </div>
                        <div class="form-group col-md-12">
                        	<button  name="updatebtn" id="updatebtn" type="button" class="btn btn-primary pull-right">Update</button>
                        </div>
                  </div>
    
            </form>

            <div class="displayCon">
                <h3 style="text-align: center; margin-top: 0px;">রাজ কাজের হিসাব</h3>
               
                    <table class="table_dis">
                      <thead>
                          <tr style="background-color: #b5b5b5;">
                                <th class="cenText">নং</th>
                                <th class="cenText" style="width: 86px;">তারিখ</th>
                                  <!-- <th class="cenText">ঠিকানা</th>   -->
                                   <!-- <th class="cenText">কাজের স্থান</th>                        -->
                                <th class="cenText">হেড মিস্ত্রী নাম</th>
                               
                                <!-- <th class="cenText">মারফোত নাম</th> -->
                              
                               <!--  <th class="cenText">কান্ট্রাক</th> -->
                                <th class="cenText">বাক্তির ধরণ</th>
                                <th class="cenText">দর</th>
                                <th class="cenText">জন</th>
                                <th class="cenText">কাজের বিল</th>
                                <th class="cenText">নগদ জমা</th>
                                <th class="cenText">পাওনা</th>
                                <th class="cenText" style="width: 76px;">view</th>
                                <th class="cenText" style="width: 76px;">Delete</th>
                                <th class="cenText" style="width: 59px;">Edit</th>
                          </tr>


                          
                      </thead>
                      <tbody id="hedmistress_area">
                       
                      </tbody>
                        

                    </table>      
              
            </div>
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
                $(".r_totalbill").val( $(".r_totalbill").data("default") );
            $(".r_paowna").val( $(".r_paowna").data("default") );
            $(".r_credit").val( $(".r_credit").data("default") );
		        });

            $(".r_totalbill").val( $(".r_totalbill").data("default") );
            $(".r_paowna").val( $(".r_paowna").data("default") );
            $(".r_credit").val( $(".r_credit").data("default") );


            $("#hidden_div").hide();
            $("#back_again").hide();
            $("#mistree_talika").show();
            
            $(document).on('click','.mistree-name', function(){
             // alert($(this).data('id'))
             $("#back_again").show();
             $("#hidden_div").show();
             $("#mistree_talika").hide();
              $('.r_hedmistress').val($(this).data('id'));
              $('.mistree_name_show').val( $(this).data('mistreename'));
            });
            $(document).on('click','#back_again', function(){ 
              $("#back_again").hide();
              $("#hidden_div").hide();
              $("#mistree_talika").show();

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
                                            $.post("raj_kajerhisab.php", {
                                              data_delete_id : data_row_id
                                            }, function(data, status){
                                                console.log(status);
                                                console.log(data);
                                                if(status == 'success'){
                                                    // $('#sucMsg').html('succsess');
                                                    window.location.href = 'raj_kajerhisab.php';
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
            $('.left_side_bar').height(100%);
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


$(document).ready(function(){


            datepickerfunction();


            var x = 2;
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.table_tbody'); //Input field wrapper

            var fieldHTML = '<tr row-id="row'+x+'">'

                fieldHTML +=  '<td>'
              //  fieldHTML +=  '<label for="r_date">তারিখ</label>'                    
                fieldHTML +=  '<input type="text" class="form-control r_date" data-id="r_date'+x+'" id="r_date" name="r_date[]" placeholder="তারিখ">'
                fieldHTML +=  '</td>'
                   fieldHTML +=  '<td>'
              //  fieldHTML +=  '<label for="r_date">তারিখ</label>'                    
                fieldHTML +=  '<input type="text" readonly name="hedmistress" id="hedmistress" class="form-control mistree_name_show">'
                fieldHTML +=  '</td>'


     
                fieldHTML +=  '<td>'
               // fieldHTML +=  '<label for="r_job_cat">বাক্তির ধরণ</label>'    
                fieldHTML +=   '<input type="text" class="form-control" data-id="r_job_cat'+x+'" id="r_job_cat" name="r_job_cat[]" placeholder="বাক্তির ধরণ">'
                fieldHTML +=   '</td>'
                fieldHTML +=   '<td>'
               // fieldHTML +=   '<label for="r_taka">দর</label>'
                fieldHTML +=   '<input type="text" name="r_taka[]" data-id="r_taka'+x+'" id="r_taka" class="form-control r_taka" onkeyup="update_amounts()" placeholder="দর" >'
                      
                 fieldHTML +=   '</td>'
                 fieldHTML +=   '<td >'
               //  fieldHTML +=   '<label for="r_person">জন</label>'
                 fieldHTML +=   '<input type="text" class="form-control r_person" data-id="r_person'+x+'" name="r_person[]" id="r_person" onkeyup="update_amounts()" placeholder="জন">'
                fieldHTML +=   '</td>'
                fieldHTML +=   '<td>'
              //  fieldHTML +=   '<label for="r_totalbill">কাজের বিল</label>'
                fieldHTML +=   '<input type="text" class="form-control r_totalbill" data-id="r_totalbill'+x+'" data-default="0"  name="r_totalbill[]" id="r_totalbill" placeholder="কাজের বিল" onkeyup="update_amounts()">'
                fieldHTML +=   '</td>'
                fieldHTML +=   '<td>'
               // fieldHTML +=   '<label for="r_credit">নগদ জমা</label>'
                fieldHTML +=   '<input type="text" class="form-control r_credit" name="r_credit[]" id="r_credit" data-default="0"  data-id="r_credit'+x+'"  placeholder="নগদ জমা" onkeyup="update_amounts()">'
                fieldHTML +=   '</td>'
                fieldHTML +=   '<td>'

               // fieldHTML +=   '<label for="r_paowna">পাওনা</label>'
                fieldHTML +=   '<input type="text" class="form-control r_paowna" data-id="r_paowna'+x+'" data-default="0" name="r_paowna[]" id="r_paowna" onkeyup="update_amounts()" placeholder="পাওনা">'
                fieldHTML +=   '</td>'
                fieldHTML +=   '<td>'
                fieldHTML +=   '<button class="btn btn-success add_button disabled" type="button" > <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> </button>'
                fieldHTML +=   '</td>'
                fieldHTML +=   '<td>'
                fieldHTML +=   '<button class="btn btn-danger remove_button" type="button"> <span class="glyphicon glyphicon-minus " aria-hidden="true"></span> </button>'
                fieldHTML +=   '</td>'

                fieldHTML +=   '</tr>'; 

            datepickerfunction();

            $(addButton).click(function(){
            	
              datepickerfunction();
              $(".r_totalbill").val( $(".r_totalbill").data("default") );
            $(".r_paowna").val( $(".r_paowna").data("default") );
            $(".r_credit").val( $(".r_credit").data("default") );

                if(x < maxField){  
                  

                    x++; //Increment field counter
                    
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            
            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
               
                datepickerfunction(); 
                $(this).closest('tr').remove(); //Remove field html
                x--; //Decrement field counter
            });

     });        
        

  getHedmistressName(); 
   function getHedmistressName(){

        var checkhedmistress ="checkhedmistress";
    $.ajax({
        url: 'raj_kajermistressDetails.php',
        type: 'POST',
       // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {checkhedmistress: checkhedmistress},
        success :function(data, status){
            $(".r_hedmistress").html(data);
            //alert('message========',data)
                console.log("data =============", data)
        }, 
        error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                    alert('Error - ' + errorMessage);
        }
    });

}
    getHedmistressDetails();
   function getHedmistressDetails(){

    var checkhedmistre ="checkhedmistre";
    $.ajax({
        url: 'raj_kajermistresstable.php',
        type: 'POST',
        data: {checkhedmistre: checkhedmistre},
        success :function(response, status){
            $("#hedmistress_area").html(response);
              console.log("datass =============", response)
        }, 
        error: function(xhr, status, error){
              var errorMessage = xhr.status + ': ' + xhr.statusText
              alert('Error - ' + errorMessage);
        }
    });



}


//============== raj_kajer_hedmistress  table data inserted

  // $('#submit_hedmistress').on('click', function() {
  //     var hedmistress_name              = $("input[name='hedmistress_name']").val();
  //     var hedmistress_mobile_num        = $('input[name="hedmistress_mobile_num"]').val();
  //     var address                       = $('input[name="address"]').val();
  //     var marphot_name                  = $('input[name="marphot_name"]').val();
  //     var contract                      = parseFloat($('input[name="contract"]').val());
  //   //  var contract                    = parseFloat(contract1);
  //     var hedmistress_status            = "1";
  //     var project_name_id               ="<?php echo $_SESSION['project_name_id'] ?>";

  //       if(hedmistress_name =="" ){
  //           alert("Hedmistre name should not empty")
  //           return;
  //       }
  //       if(contract =="" ){
  //           alert("Contract field should numeric value ")
  //           return;
  //       }
  //       console.log("marphot_name==========",marphot_name);

  //         var formData = new FormData($('#rajkerMistreeForm')[0]);
  //           formData.append("hedmistress_name", hedmistress_name);
  //           formData.append("hedmistress_mobile_num", hedmistress_mobile_num);
  //           formData.append("hedmistress_profile_pic", $('input[name="hedmistress_profile_pic"]')[0].files[0]);
  //           formData.append("hedmistress_ducument", $('input[name="hedmistress_ducument"]')[0].files[0]);
  //           formData.append("address", address);
  //           formData.append("marphot_name", marphot_name);
  //           formData.append("contract", contract);
  //           formData.append("hedmistress_status", hedmistress_status);
  //           formData.append("project_name_id", project_name_id);
  //           $.ajax({
  //               url: "raj_kajermistress.php",
  //               type: "POST",
  //               data: formData,
  //               cache: false,
  //               processData: false,
  //               contentType: false,
  //               success: function(data){
  //                 console.log("Mistree name data ========== ",data)
  //                   //$('#success').html('Data added successfully !'); 
  //                    alert(data); 
  //                   	$('#rajkerMistreeForm')[0].reset();                       
  //                       getHedmistressName();                
         
  //               },
  //               error: function(error){
  //               //var errorMessage = xhr.status + ': ' + xhr.statusText
  //                   console.log('Error mistree - ' + error);
  //               }

  //           });
        
  //   });

// number support
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

$('#submit_btn').on('click', function(e) { 
  $('select[name="r_hedmistress"]').prop('disabled', false);

  var r_hedmistress = document.forms["rajkerForm"]["r_hedmistress"].value;
  var r_job_cat = $(".r_job_cat").val();
  var r_taka = $(".r_taka").val();
  var r_person = $(".r_person").val();
  
 // var r_job_cat = document.getElementsByClassName('r_job_cat')[0].value;
//alert(r_job_cat);

  if (r_hedmistress.length < 1) {
        document.getElementById('error_name').innerHTML = " Please fill the field";
        //return;
    }
    else if(r_job_cat =='') {

       $('.err_job_cat').html("Please fill the field")
        //return;
    }else if(r_taka =='') {

       $('.err_taka').html("Please fill the field")
        //return;
    }else if(r_person =='') {

       $('.err_person').html("Please fill the field")
        //return;
    }else{
          var fdata = $('form#rajkerForm').serialize();
            $.ajax({
                url : "raj_kajermistressInsert.php",
                type: "POST",
                data: fdata,
                success: function(data){
                  console.log("from data insert ==========",data)
                        
                    //$('#success').html('Data added successfully !'); 
                    if(data){
                    alert("Data added successfully !"); 
                    $('#rajkerForm')[0].reset(); 
                    $('select[name="r_hedmistress"]').prop('disabled', true);
                      getHedmistressDetails();
                      datepickerfunction();


                    }
                    
                },
                error: function(data){
                    console.log('Error - ' + data);

                }

            });


    }
               
    });

 


   $(document).on('click', '.viewBtn', function(){

     var id = $(this).attr('id');
     //alert(id);
     var action = 'single_view';
     var  mydata = {
      id:id, 
      action:action
    };
     $.ajax({
        url:"raj_LocationInsert.php",
        type:"POST",
        data:mydata,
      success:function(data)
      {
         $("#modal-body").html(data);
        console.log(data);
        
      },
      error: function(data) {
            console.log(data);
          }
    });

  });

$('#submit_btn').show();
$('#updatebtn').hide();

$(document).on('click', '.editBtn', function(){

     var id = $(this).attr('id');
     //alert(id);
     var action = 'fetch_single';
     var  mydata = {
      id:id, 
      action:action
    };

   // '#r_hedmistress option[value="' + data.hedmistress_name + '"]'
     $.ajax({
        url:"raj_kajermistresstable.php",
        type:"POST",
        dataType:"JSON",
        data:mydata,
       
      success:function(data)
      {
        // console.log("editdata==========",data);
        $('#id').val(data.id);
        $('#r_date').val(data.r_date);
        $('.r_hedmistress').html("<select class='form-control' name='r_hedmistress' id='r_hedmistress'> <option value='"+data.r_hedmistress+"'>"+ data.hedmistress_name +"</option><select>");
        $('#r_job_cat').val(data.r_job_cat);
        $('#r_taka').val(data.r_taka);
        $('#r_person').val(data.r_person);
        $('#r_totalbill').val(data.r_totalbill);
        $('#r_credit').val(data.r_credit);
        $('#r_paowna').val(data.r_paowna);

        $('#submit_btn').hide();
        $('#updatebtn').show();
        //$('#id').val(data.id);
        console.log(data);
        
      },
      error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
    });

  });


 $('#updatebtn').on('click', function(){

		//var id = $(this).attr("id");
        var id              = $('#id').val();
        var r_date          = $('#r_date').val();
        var r_hedmistress   = $('#r_hedmistress').val();
        var r_job_cat       = $('#r_job_cat').val();
        var r_taka          = $('#r_taka').val();
        var r_person        = $('#r_person').val();
        var r_totalbill     = $('#r_totalbill').val();
        var r_credit        = $('#r_credit').val();
        var r_paowna        = $('#r_paowna').val();
        var updateData     ="updateData";
 
 
		$.ajax({
			url: 'raj_kajerhisab_update.php',
			type: 'POST',
			data: {
				id: id,
				r_date: r_date,
				r_hedmistress: r_hedmistress,
				r_job_cat: r_job_cat,
				r_taka: r_taka,
				r_person: r_person,
				r_totalbill: r_totalbill,
				r_credit: r_credit,
				r_paowna: r_paowna,
				updateData: updateData

			},
			success: function(){
					$('#rajkerForm')[0].reset();
                    $('#submit_btn').show();
                    $('#updatebtn').hide(); 
                      getHedmistressDetails();
                    
 
				alert("Successfully Updated!");

			},
			error: function(error){
                    console.log('Error - ' + error);

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




  update_amounts();
function update_amounts()
{

    $('tr').each(function() {
      if($(".r_taka").val()== 0 && $(".r_taka").val()== '' ){
        $(".r_totalbill").val(0);
        $(".r_paowna").val(0);

      }
      if($(".r_person").val()== 0 && $(".r_person").val()== '' ){
        $(".r_totalbill").val(0);
        $(".r_paowna").val(0);
      }
      if($(".r_credit").val()== 0 && $(".r_credit").val()== '' ){
        $(".r_paowna").val(0);
        $(".r_paowna").val(0);
        }
      
        var r_person = parseInt($(this).find('.r_person').val());
        var r_taka = parseInt($(this).find('.r_taka').val());
        var amount = r_taka * r_person;
        
        var r_totalbill =  $(this).find('.r_totalbill').val(amount);

        var r_credit =  $(this).find('.r_credit').val();

        $(this).find('.r_paowna').val(r_totalbill);

        var calculation = parseInt($(this).find('.r_totalbill').val()) - parseInt($(this).find('.r_credit').val());
      // console.log("calculation==========",calculation);

        var r_paowna =  parseInt($(this).find('.r_paowna').val(calculation));


        
    });
    
   

}




</script>

    <script src="../js/common_js.js"></script>
</body>
</html>