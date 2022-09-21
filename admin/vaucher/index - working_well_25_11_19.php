<?php 
  // phpinfo();
  session_start();
  if(!isset($_SESSION['username']) ){    
      header('location:../index.php');
  }
  require '../config/config.php';
  require '../lib/database.php';
  $db = new Database();
  $_SESSION['pageName'] = 'protidiner_hisab';
  
  $project_name_id = $_SESSION['project_name_id'];

 
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>দৈনিক হিসাব</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/css/bootstrap-select.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/voucher.css?v=2.0.0">
  <link rel="stylesheet" href="../css/doinik_hisab.css?v=2.0.0">

  <!-- <script src="../js/jquery-printme.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="../js/printThis.js"></script>
  <style type="text/css">
      .datesList{
        background-color: #F0F0F0;
        color: #000;
      }
      .datesList:hover{
        background-color: #F0F0F0;
        color: #000;
      }
      .datesList:focus{
        background-color: #F0F0F0;
        color: #000;
      }
      .open > .dropdown-toggle.btn-info{
        background-color: #F0F0F0;
        color: #000;
      }
      .dropdown-toggle.btn-info:hover{
        background-color: #F0F0F0;
        color: #000;
      }
      .dropdown-toggle.btn-info:hover{
        background-color: #F0F0F0 !important;
        color: #000 !important;
      }
      .first_view{
          /*background-color: #eee;*/
          height: 285px;
          font-size: 25px;
          color: #575757;
          font-weight: normal;
          vertical-align: middle !important;
          text-align: center;
          border: 1px solid #ccc !important;
      }
      #showAllDatesAllData {
        background-color: transparent;
        color: #000;
        background-color: #F0F0F0;
        display: none;
        margin-left: 10px;
      }
      #searchData {
          /*display: block;
          height: 34px;
          padding: 6px 12px;
          font-size: 14px;
          line-height: 1.42857143;
          color:
          #555;
          background-color:
          #fff;
          background-image: none;
          border: 1px solid
          #ccc;
          border-radius: 4px;
          -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
          box-shadow: inset 0 1px 1px
          rgba(0,0,0,.075);
          -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
          -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
          transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;*/

          min-width: 265px;
          position: absolute;
          display: inline;
          /*right: calc(-265px - 10px);*/
          /*margin-left: 10px;          */
          width: 30%;
          right: 10px;
          top: 54px;
          width: calc(100% - 20px);
      }
      @-moz-document url-prefix() {
          #searchData {
              /*top: -8px;*/
          }
      }
      .select2-container {
          margin-left: 9px;
          width: 240px !important;
      }
      .select2-dropdown {
          margin-left: -9px;
      }
      .select2-container .select2-selection--single{
          height:34px !important;
      }
      .select2-container--default .select2-selection--single{
          border: 1px solid #46b8da !important;
          background-color: #F0F0F0;
          /*border-radius: 0px !important; */
      } 
      .select2-container--default .select2-selection--single .select2-selection__rendered {
          color: #000;
          line-height: 34px;          
      }
      .select2-container--default .select2-selection--single .select2-selection__arrow {
          height: 32px;
          color: #000 !important;
      }
      .dataTables_wrapper .dataTables_filter input {
          margin-left: 0.5em;
          background-color: #373737;
          color: #fff;
          border: 1px solid #000;
          padding: 0px 10px;
      }
      #loader_img{
          left: 50%;
          position: absolute;
          top: calc(80% - 120px);
          z-index: 99999999999999;
          display: none;
      }

  </style>
  <script>
      function myFunction() {
          // window.print();
          var header = document.getElementById('banner-fluid');
          var project_heading = document.getElementById('project_heading');
          var printme = document.getElementById('container_table');
          // alert(printme.id);
          // console.log(printme);
          if(printme.style.display == 'none'){
              printme = document.getElementById('mytable');
          }
          
          var style = "<style>#container_table{border-collapse: collapse; margin-top: 10px;} #container_table tr td{border: 1px solid #b0b0b0; padding: 4px;} #container_table tr th{border: 1px solid #b0b0b0;  } #borderless-cell{border: none !important;}#noborders{border: none !important;} .newGroup{background-color: #373737;color: #d0d0d0; font-weight: bold; font-size: 13px; vertical-align: middle !important; text-align: center;} .active { background-color: #959595; color: #000; } .headingOfAllProject {margin: 14px 0px 10px; min-height: 32px; padding-bottom: 5px; border-bottom: 1px solid #A54686; line-height: 32px;} .protidinHisab, .dateObar{font-size: 15px; font-weight: normal;} .text-right{text-align: right; }#mytable{width: 100% !important; border-collapse:collapse;} #mytable tr td{border: 1px solid #ddd; padding: 5px;}</style>";
          var wme = window.open("", "", "width=900,height=700, scrollbars=yes");
          wme.document.write(style);
          // alert(header);
          wme.document.write(header.outerHTML);
          wme.document.write(project_heading.outerHTML);
          wme.document.write(printme.outerHTML);
          wme.document.close();
          wme.focus();
          wme.print();
          wme.close();
      }


      $("#noprint").click(function(){
        // $('.print-hide').hide();
        // $("#values").show().printMe();
        alert('warning');
      });
      function click(){
        alert('warning');
        // $("#values").show().printMe();
      }
  </script>
  <script type="text/javascript">    
      // var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
      var weekday = ["রবিবার","সোমবার","মঙ্গলবার","বুধবার","বৃহস্পতিবার","শুক্রবার","শনিবার"];
      
      function setCurrentDate(){
          var a = new Date();
          var curr_day = a.getDate();
          if(curr_day >=1 && curr_day <=9){
              curr_day = '0'+curr_day;
          }
          var curr_month = a.getMonth()+1;
          if(curr_month >=1 && curr_month <=9){
              curr_month = '0'+curr_month;
          }
          var curr_year = a.getFullYear();
          var formated_Date = curr_day + "-" + curr_month +"-" +curr_year;
          // alert(formated_Date);
          // alert(weekday[a.getDay()]);
          var getDayFromDate = weekday[a.getDay()];
          var dateandday = formated_Date + " " + getDayFromDate;
          $(".dateObar").html(dateandday);
      }
      function setSearchDate(selectedDate){
          // alert(selectedDate);
          var b = new Date(selectedDate);
          // alert(weekday[b.getDay()]);
          var c_day = b.getDate();
          if(c_day >=1 && c_day <=9){
            c_day = '0'+c_day;
          }
          var c_month = b.getMonth()+1;
          if(c_month >=1 && c_month <=9){
              c_month = '0'+c_month;
          }
          var c_year = b.getFullYear();
          var formated_Date = c_day + "-" + c_month +"-" +c_year;  
          var getDayselectedDate = weekday[b.getDay()];
          var newdateandday = formated_Date + " " + getDayselectedDate;
          $(".dateObar").html(newdateandday);
      }

      $(function() {
          setCurrentDate();
      });
  </script>
  <script type="text/javascript">
    function getDateWiseData(datestr){
        $("#loader_img").show();
        $.ajax({
            url: "../ajaxcall/day_search.php",
            type: "post",
            data: { optionDate : datestr },
            success: function (response) {
              // alert(response);
              $('#container_table').html(response).show();
              heightChange();
            },
            complete:function(data){
              $("#loader_img").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }

    function getAllData(){
        $("#loader_img").show();
        $.ajax({
            url: "../ajaxcall/day_search_all_data.php",
            // type: "post",
            // data: { optionDate : datestr },
            beforeSend: function(){
              // $("#loader_img").show();
            },
            success: function (response) {
              // alert(response);
              $('#container_table').html(response).show();
              heightChange();
            },
            complete:function(data){
              $("#loader_img").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }
    function getAllData_10_Datas(){
        $("#loader_img").show();
        $.ajax({
            url: "../ajaxcall/day_search_all_data_10_datas.php",
            // type: "post",
            // data: { optionDate : datestr },
            success: function (response) {
              // alert(response);
              $('#container_table_div').hide();
              $('#container_table').html(response).show();
              heightChange();
            },
            complete:function(data){
              $("#loader_img").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }

    $(document).on('change','#dates_list', function() {
        var optionText = $(this).children("option:selected").val();
        if($("#headerGroupNameList option:selected").val() != 'none'){
            $("#headerGroupNameList").val('none').trigger('change');
        }        
        // alert(optionText);

        $("#container_table_div").hide();
        if(optionText === 'alldates'){
            // window.location.href = "../vaucher/index.php";
            getAllData_10_Datas();
            setCurrentDate();
            $('#showAllDatesAllData').css('display', 'inline-block');
        }else{
            getDateWiseData(optionText);
            setSearchDate(optionText);
            $('#showAllDatesAllData').css('display', 'none');
        }   
    });

    $(document).on('click','#showAllDatesAllData', function() {
        $("#headerGroupNameList").val('none').change();
        getAllData();
        setCurrentDate();
        $("#container_table_div").hide();
    });

    $(document).on('input', '#searchData', function(){
        var match_string = $(this).val();
        $('#mytable').hide();
        // alert(match_string);
        $('#container_table_div').hide();
        $("#headerGroupNameList").val('none').change();
        $("#dates_list").val('alldates').change();
        setTimeout(function(){
          getMatchStringDataFromAllTable(match_string);
        }, 500);
    });


    // var typingTimer;                //timer identifier
    // var doneTypingInterval = 500;  //time in ms, 2 second for example
    // var $input = $('#searchData');
    // // updated events 
    // $input.on('input paste', function () {
    //     clearTimeout(typingTimer);
    //     typingTimer = setTimeout(doneTyping, doneTypingInterval);      
    // });
    // //user is "finished typing," do something
    // function doneTyping () {
    //     var match_string = $(this).val();
    //     $('#mytable').hide();
    //     // alert(match_string);
    //     $('#container_table_div').hide();
    //     $("#headerGroupNameList").val('none').change();
    //     $("#dates_list").val('alldates').change();
    //     getMatchStringDataFromAllTable(match_string);
    // }

    function getMatchStringDataFromAllTable(match_string){
        $("#loader_img").show();
        $.ajax({
            url: "../ajaxcall/get_match_string_data_from_all_table.php",
            type: "post",
            data: { match_string : match_string },
            success: function (response) {
                // alert(response);
                $('#container_table').html(response).show();
                heightChange();
            },
            complete:function(data){
              $("#loader_img").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }

    
    $(document).on('change','#headerGroupNameList', function() {
        var khotos_khat_id = $(this).children("option:selected").val();
        var search_date = $("#dates_list option:selected").val();
        // alert(search_date);
        if(search_date == 'alldates' && khotos_khat_id == 'none') {
            getAllData_10_Datas();
            $("#biboronCon").html('');
        } else if(search_date == 'alldates' && khotos_khat_id != 'none'){
            show_only_khoros_khat_wise_data(search_date, khotos_khat_id);
            show_biboron_list(search_date, khotos_khat_id);
        } else if(search_date != 'alldates' && khotos_khat_id == 'none'){
            // alert("খরচ খাতের নাম নির্বাচন করুন ।");
            // alert(khotos_khat_id);
            no_search_way();       
        } else if(search_date != 'alldates' && khotos_khat_id != 'none'){
            show_only_khoros_khat_wise_data(search_date, khotos_khat_id);
            show_biboron_list(search_date, khotos_khat_id);
        } else {
            alert("Logic error !");
        }
    });

    function show_only_khoros_khat_wise_data(search_date, khotos_khat_id){
        $("#loader_img").show();
        $.ajax({
            url: "../ajaxcall/search_only_khoros_khat_wise_data.php",
            type: "post",
            data: {
              search_date     : search_date,
              khotos_khat_id  : khotos_khat_id
            },
            success: function (response) {
                // alert(response);
                // $('#container_table').html(response).show();
                $('#container_table').hide();
                $('#container_table_div').html(response).show();
                dataTableCall_byId('mytable', 2);
                heightChange();
            },
            complete:function(data){
              $("#loader_img").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
    function show_biboron_list(search_date, khotos_khat_id){
        $("#loader_img").show();
        $.ajax({
            url: "../ajaxcall/show_biboron_list_box.php",
            type: "post",
            data: {
              search_date     : search_date,
              khotos_khat_id  : khotos_khat_id },
            success: function (response) {
                // alert(response);
                $('#biboronCon').html(response).show();                
                // heightChange();
                // $("#descriptionGroupList").html();
                $('#descriptionGroupList').select2().on('select2:open', function(e){
                    $('.select2-search__field').attr('placeholder', 'Search...');          
                });
            },
            complete:function(data){
              $("#loader_img").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
    function no_search_way(){
        var htm = '<table id="mytable" class="table table-bordered" style="font-size: 20px;">';
            htm +=    '<tr>';
            htm +=      '<td style="text-align: center;">খরচ খাতের নাম নির্বাচন করুন ।</td>';
            htm +=    '</tr>';
            htm += '</table>';

        // alert(htm);

        $('#biboronCon').html('');
        $('#container_table').hide();
        $('#container_table_div').html(htm).show();
        heightChange();
    }
    $(document).on('change','#descriptionGroupList', function() {
        var search_date = $("#dates_list option:selected").val();
        var group_id = $("#headerGroupNameList option:selected").val();
        var biboron = $(this).children("option:selected").val();
        // alert(group_id + "==" + biboron);
        if(biboron == 'none'){
            show_only_khoros_khat_wise_data(search_date, group_id);
        } else {
            group_description_wise_data(search_date, group_id, biboron);
        }
    });
    function group_description_wise_data(search_date, khotos_khat_id, biboron){
        $.ajax({
            url: "../ajaxcall/search_only_group_description_wise_data.php",
            type: "post",
            data: {
                    search_date     : search_date,
                    khotos_khat_id  : khotos_khat_id,
                    biboron         : biboron
                  },
            success: function (response) {
                // alert(response);
                $('#container_table').hide();                             
                $('#container_table_div').html(response).show();
                dataTableCall_byId('mytable', 2);                
                heightChange();
                // $('#container_table').addClass('sortable');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    }
      // function getFromToDatesData(minDate, maxDate){
      //   $.ajax({
      //     url: "from_to_date_search.php",
      //     type: "post",
      //     data: {
      //         minDate : minDate,
      //         maxDate : maxDate,
      //     },
      //     success: function(res){
      //         // alert(res);
      //         $('#container_table').html(res).show();
      //     },
      //     error: function(jqXHR, textStatus, errorThrown){
      //         console.log(textStatus, errorThrown);
      //     }
      //   });
      // }

      // $(document).on('change', '#minDate', function (){
      //   var minDate = $('#minDate').val();
      //   var maxDate = $('#maxDate').val();
      //   // alert(minDate + ", " + maxDate);
      //   // console.log(minDate + ", " + maxDate);
      //   getFromToDatesData(minDate, maxDate);
      // });

      // $(document).on('change', '#maxDate', function (){
      //   var minDate = $('#minDate').val();
      //   var maxDate = $('#maxDate').val();
      //   // alert(minDate + ", " + maxDate);
      //   // console.log(maxDate);
      //   getFromToDatesData(minDate, maxDate);
      // });



      // function getJomaMarfot(jmName){
      //   $.ajax({
      //     url: "joma_marfot_search.php",
      //     type: "post",
      //     data: {jomaMarforName: jmName},
      //     success: function(res){
      //       // alert(res);
      //       $('#container_table').html(res).show();
      //     },
      //     error: function(jqXHR, textStatus, errorThrown){
      //       console.log(textStatus, errorThrown);
      //     }
      //   });
      // }

      // $(document).on('change', '#jomaMarfotNames', function (){
      //   var jomaMarfotName = $("#jomaMarfotNames option:selected").val();
      //   // alert(jomaMarfotName);
      //   // console.log(jomaMarfotName);
      //   if(jomaMarfotName == "none"){
      //     // alert("Select one... As: " + jomaMarfotName);
      //   } else{
      //     // alert("Another option");
      //     getJomaMarfot(jomaMarfotName);
      //   }
        
      // });
      
      // function getKhorosMarfot(kmName){
      //   $.ajax({
      //     url: "khoros_marfot_search.php",
      //     type: "post",
      //     data: {khorosMarforName: kmName},
      //     success: function(res){
      //       // alert(res);
      //       $('#container_table').html(res);
      //     },
      //     error: function(jqXHR, textStatus, errorThrown){
      //       console.log(textStatus, errorThrown);
      //     }
      //   });
      // }
      // $(document).on('change', '#khorosMarfotNames', function (){
      //     var khorosMarfotName = $("#khorosMarfotNames option:selected").val();
      //     // alert(khorosMarfotName);
      //     // console.log(khorosMarfotName);
      //     if(khorosMarfotName == "none"){
      //       // alert("Select one... As: " + khorosMarfotName);
      //     } else{
      //       // alert("Another option");
      //       getKhorosMarfot(khorosMarfotName);
      //     }    
      // });


     
     function popupw(){
        var dateList = $("#dates_list option:selected").val();
        var vaucherList = $("#headerGroupNameList option:selected").val();
        var biboronList = $("#descriptionGroupList option:selected").val();
        // alert(biboronList);
        // console.log(biboronList);
        
        if(vaucherList == 'none' && biboronList == undefined){
            var w = window.open("../ajaxcall/download.php?date=" + dateList, "popupWindow", "width=600, height=400, scrollbars=yes",);
        } else if(vaucherList == 'none' && biboronList == 'none'){
            var w = window.open("../ajaxcall/download.php?date=" + dateList, "popupWindow", "width=600, height=400, scrollbars=yes",);
        } else if(vaucherList != 'none' && biboronList == 'none') {
            // var w = window.open("../ajaxcall/download_filter.php?date=" + dateList + "&debit_group="+ vaucherList + "&biboron="+biboronList, "popupWindow", "width=600, height=400, scrollbars=yes",);
            
            draw_table_group_wise_data();
        } else if(vaucherList != 'none' && biboronList != 'none'){
            // var w = window.open("../ajaxcall/download_filter.php?date=" + dateList + "&debit_group="+ vaucherList + "&biboron="+biboronList, "popupWindow", "width=600, height=400, scrollbars=yes",);

            draw_table_group_wise_data();
        } else {
            alert('Logic not found!');
        }

        function draw_table_group_wise_data(){
          var downBtn = '<p style="text-align: center;"><button style="color: #fff; font-weight: bold; font-size: 14px; background-color: green; padding: 5px 10px; cursor: pointer; " onclick="download_group()">Download</button></p>';
            var header = document.getElementById('banner-fluid');
            var project_heading = document.getElementById('project_heading');
            var mytable = document.getElementById("mytable");
            // alert(mytable);
            var fn = 'function download_group(){var doc = new jsPDF();var specialElementHandlers = {"#editor": function (element, renderer) {return true;}};        doc.fromHTML($("body").html(), 15, 15, {  "width": 170,    "elementHandlers": specialElementHandlers }); doc.save("sample-file.pdf"); }';
// var fn = 'function download_group(){alert("aaaaaaaa")}';

            var style = "<style>#container_table{border-collapse: collapse; margin-top: 10px;} #container_table tr td{border: 1px solid #b0b0b0; padding: 4px;} #container_table tr th{border: 1px solid #b0b0b0;  } #borderless-cell{border: none !important;}#noborders{border: none !important;} .newGroup{background-color: #373737;color: #d0d0d0; font-weight: bold; font-size: 13px; vertical-align: middle !important; text-align: center;} .active { background-color: #959595; color: #000; } .headingOfAllProject {margin: 14px 0px 10px; min-height: 32px; padding-bottom: 5px; border-bottom: 1px solid #A54686; line-height: 32px;} .protidinHisab, .dateObar{font-size: 15px; font-weight: normal;} .text-right{text-align: right; }#mytable{width: 100% !important; border-collapse:collapse;} #mytable tr td{border: 1px solid #ddd; padding: 5px;}</style>";
            var wme = window.open("", "", "width=900,height=700, scrollbars=yes");
            wme.document.write(style);
            wme.document.write('<meta charset="UTF-8">');
            // alert(header);
            wme.document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">'+'<'+'/script>');
            wme.document.write('<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js">'+'<'+'/script>');
            wme.document.write(downBtn);
            wme.document.write(header.outerHTML);
            wme.document.write(project_heading.outerHTML);
            wme.document.write(mytable.outerHTML + '<div id="editor"></div>');
            
            wme.document.write('<script>' + fn + '<'+'/script>');
            wme.document.close();
            wme.focus();
            // wme.print();
        }
        

     }

  </script>
</head>
<body>
    <?php
        include '../navbar/header_text.php';
        $page ='doinik_hisab';
        include '../navbar/navbar.php';
    ?> 
    <div class="container" id="">
        <div class="print" id="values">        
        </div>
    </div>


  <div class="bar_con">
      <img src="../img/loader_used.png" id="loader_img" width="80px">
      <div class="left_side_bar" style="min-height: 550px;">             
          <?php require '../others_page/left_menu_bar.php'; ?>
      </div>
      <div class="main_bar" style="padding-bottom: 20px; width: calc(80% - 20px);">
          <?php
              $ph_id = $_SESSION['project_name_id'];
              $query = "SELECT * FROM project_heading WHERE id = $ph_id";
              $show = $db->select($query);
              if ($show) {
                  while ($rows = $show->fetch_assoc()) {
                      ?>
                      <div class="project_heading" id="project_heading">      
                          <h2 class="headingOfAllProject">
                              <?php echo $rows['heading']; ?> <span class="protidinHisab">প্রতিদিনের হিসাব</span> <span class="dateObar"></span>
                          </h2>
                      </div>
                      <?php 
                  }
              } 
          ?>
        <div class="fromToCon noprint">
          <?php
              $date_query = "SELECT credit_date AS unique_date FROM vaucher_credit
                          UNION
                          SELECT group_date FROM debit_group
                          UNION
                          SELECT nij_paona_date FROM nij_paonadar
                          UNION
                          SELECT pabe_date FROM jara_pabe
                          ORDER BY unique_date DESC";
            
              $date_read = $db->select($date_query);
              if ($date_read) {
                  $row = $date_read->fetch_assoc();
                  $maxDate = $row['unique_date'];
                  // var_dump($maxDate);
                  $bdMaxDateFormat = date("d-m-Y", strtotime($maxDate));
                  $maxDateForToDate = date("d/m/Y", strtotime($maxDate));
              }

              $date_query = "SELECT credit_date AS unique_date FROM vaucher_credit
                          UNION
                          SELECT group_date FROM debit_group
                          UNION
                          SELECT nij_paona_date FROM nij_paonadar
                          UNION
                          SELECT pabe_date FROM jara_pabe
                          ORDER BY unique_date ASC";
            
              $date_read = $db->select($date_query);
              if ($date_read) {
                  $row = $date_read->fetch_assoc();
                  $minDate = $row['unique_date'];
                  // var_dump($minDate);
                  $minDateForFromDate = date("d/m/Y", strtotime($minDate));
              }
          ?>
          <span class="searchBy">Search By:</span>
                   
            <button href="#" onclick="myFunction()" class="btn printBtn" class="noprint">Print</button>
            <button href="#" onclick="popupw()" class="btn downlaodBtn" class="noprint">Download</button>

          <!-- <span class="fromDate"><b>From Date:</b>

            <input type="text" class="dateControl" min="<?php echo $minDate; ?>" max="<?php echo $maxDate; ?>" value="<?php echo $maxDateForToDate;?>" id="minDate"/>
          </span>
          &nbsp;
          <span class="fromDate"><b>To Date:</b>
            <input type="text" class="dateControl" min="<?php echo $minDate; ?>" max="<?php echo $maxDate; ?>" value="<?php echo $maxDateForToDate;?>" id="maxDate"/>
          </span> -->

          <?php
            
              $day_query = "SELECT credit_date AS unique_date FROM vaucher_credit WHERE project_name_id = '$project_name_id'
                            UNION
                            SELECT group_date FROM debit_group WHERE project_name_id = '$project_name_id'
                            UNION
                            SELECT nij_paona_date FROM nij_paonadar WHERE project_name_id = '$project_name_id'
                            UNION
                            SELECT pabe_date FROM jara_pabe WHERE project_name_id = '$project_name_id'
                            UNION
                            SELECT entry_date FROM debit_group_data WHERE project_name_id = '$project_name_id'
                            UNION
                            SELECT due_debit_date FROM due WHERE project_name_id = '$project_name_id'
                            ORDER BY unique_date DESC";

              
              $day_read = $db->select($day_query);
              if ($day_read){
                  ?>
                  <span class="onlyDate">
                      <b>Date: </b>
                      <select id="dates_list" class="selectpicker" data-style="btn-info datesList" data-width="170px">
                            <option value="<?php echo date("Y-m-d"); ?>"><?php echo date("d-m-Y"); ?></option>
                            <option value="alldates">All Dates 10 Datas ...</option>
                            <?php
                          while ($day_row = $day_read->fetch_assoc()) {
                              
                              if($day_row['unique_date'] == '0000-00-00') {

                              } else {
                                  $newdateformate = $day_row['unique_date'];
                                  // $newDay = $day_row['day'];
                                  $newDate = date("d-m-Y", strtotime($newdateformate));
                                  echo '<option value="'. $newdateformate . '">' .$newDate .'</option>';  
                              }

                          }
                      ?>
                      </select>
                      <input type="button" class="btn btn-info" value="Show all datas" id="showAllDatesAllData">
                      <select id="headerGroupNameList" class="" >                    
                          <option value="none">Select...</option>
                              <?php
                                  $query = "SELECT id, group_name FROM debit_group WHERE project_name_id = '$project_name_id'";
                                  $show = $db->select($query);
                                  if($show){
                                      while($rows = $show->fetch_assoc()) {
                                          $id = $rows['id'];
                                          $group_name = $rows['group_name'];
                                          echo '<option value="' . $id . '">' . $group_name . '</option>';
                                      }
                                  }
                              ?>
                      </select>
                      <span id="biboronCon" style="display: inline-block;"></span>
                      
                  </span>

                  <input type="text" class="form-control" placeholder="Search..." id = "searchData">
          <!-- <span class="onlyDate">        
              <b>জমা মাঃ নামঃ</b>
              <select class="jamaMarforDropwn" id="jomaMarfotNames">
                <option value="none">Select one...</option>
                <?php                    
                    //   $query = "SELECT DISTINCT credit_name FROM vaucher_credit";                    
                    //   $read = $db->select($query);                    
                    //   if ($read) 
                    //   {
                    //     while ($row = $read->fetch_assoc()) 
                    //     {
                    //       ?>
                    //       <option value="<?php //echo $row['credit_name'];?>"><?php //echo $row['credit_name'];?></option>
                    //       <?php
                    //     }
                    // }
                ?>
              </select>
          </span>
          <span class="onlyDate">        
              <b>খরেচর মাঃ নামঃ</b>
              <select class="jamaMarforDropwn" id="khorosMarfotNames">
                <option value="none">Select one...</option>
                <?php                    
                    //   $query = "SELECT DISTINCT group_name FROM debit_group";                    
                    //   $read = $db->select($query);                    
                    //   if ($read) 
                    //   {
                    //     while ($row = $read->fetch_assoc()) 
                    //     {
                    //       ?>
                    //       <option value="<?php //echo $row['group_name'];?>"><?php //echo $row['group_name'];?></option>
                    //       <?php
                    //     }
                    // }
                ?>
              </select>
          </span> -->
        </div>
            <?php
            }
        ?>

        <div id="container_table_div">
          
        </div>
        <table id="container_table" class="table table-bordered" style="font-size: 12px;">
            <!-- <tr>
                <th class="first_view">
                    <?php //echo date('d/m/Y'); ?>
                    Please change the date from above dropdown menu for view datas.
                </th>
            </tr> -->
        </table>
      </div>
  </div>



  <script src="../js/my-script.js"></script>
  <script type="text/javascript">
    // getDateWiseData($("#dates_list option:selected").val());



    // $(function() {
    //   $("#minDate").datepicker();
    //   $("#minDate").datepicker("option", "dateFormat", "dd/mm/yy");

    //   $("#maxDate").datepicker();
    //   $("#maxDate").datepicker("option", "dateFormat", "dd/mm/yy");
      
    // });


    $(function() {
      $('#minDate').datepicker( {
          onSelect: function(date) {
              // alert(date);
              $(this).change();
          },
          minDate: '<?php echo $minDateForFromDate;?>',
          maxDate: '<?php echo $maxDateForToDate;?>',
          dateFormat: "dd/mm/yy"
      });

      $('#maxDate').datepicker( {
          onSelect: function(date) {
              // alert(date);
              $(this).change();
          },
          minDate: '<?php echo $minDateForFromDate; ?>',
          maxDate: '<?php echo $maxDateForToDate; ?>',
          dateFormat: "dd/mm/yy",
      });
  });
  </script>
  <script type="text/javascript">
    $('.selectpicker').selectpicker();
  </script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
  <script type="text/javascript">
      $('.left_side_bar').height($('.main_bar').innerHeight()).trigger('change');
      function heightChange(){          
          var left_side_bar_height = $('.left_side_bar').height();
          var main_bar_height = $('.main_bar').innerHeight();
          if(left_side_bar_height >= main_bar_height){
              $('.left_side_bar').height(main_bar_height + 25); 
          } else {
              $('.left_side_bar').height(main_bar_height+25);
          }
          
      }
      // heightChange();
      // var table = null;
      // function dataTableCall_byId(id, collumn){
      //   if(table != null){
      //       table.clear();
      //       table.destroy();
      //   }
      //   table = $('#'+id).DataTable( {
      //         "order": [[ collumn, "asc" ]],
      //         "retrieve": true,
      //         "paging": false,
      //         "searching": false,
      //         "destroy": true,
      //   });          
      // }
      function dataTableCall_byId(id, collumn){        
          var table = $('#'+id).DataTable( {
                "order": [[ collumn, "asc" ]],
                "retrieve": true,
                "paging": true,
                "searching": true,
                "destroy": true,
          });
          // table.destroy(true);
          table.destroy();

          table = $('#'+id).DataTable( {
                "order": [[ collumn, "asc" ]],
                "retrieve": true,
                "paging": true,
                "searching": true,
                "destroy": true,
                "footerCallback": function ( row, data, start, end, display ) {
                    var api = this.api(), data;
         
                    // Remove the formatting to get integer data for summation
                    var intVal = function ( i ) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };
         
                    // Total over all pages
                    total = api
                        .column( 4 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Total over this page
                    pageTotal = api
                        .column( 4, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
         
                    // Update footer
                    $( api.column( 4 ).footer() ).html(
                        pageTotal +'.00' + '<br><span style="text-decoration:overline;">of '+ total +'.00</>'
                    );
                },
                "aLengthMenu": [[10, 25, 50, 75, 100, 150, 200, -1], [10, 25, 50, 75, 100, 150, 200, "All"]],
                "iDisplayLength": 10,
          });
      }
  </script>
  <script type="text/javascript">
      // $("#headerGroupNameList").select2();
      $('#headerGroupNameList').select2().on('select2:open', function(e){
          $('.select2-search__field').attr('placeholder', 'Search...');          
      });
  </script>
  <script type="text/javascript">
      $("#dates_list").val('alldates').trigger('change');
  </script>
</body>
</html>
