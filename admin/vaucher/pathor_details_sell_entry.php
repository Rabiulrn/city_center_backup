<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:../index.php');
}
require '../config/config.php';
require '../lib/database.php';
$db = new Database();
$project_name_id = $_SESSION['project_name_id'];
$_SESSION['pageName'] = 'pathor_bikroy_hisab';
// $sucMsgPopup = '';
?>




<!DOCTYPE html>
<html>

<head>
    <title>পাথর বিক্রয় হিসাব</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../img/Shah logo@1553422164642.jpg" type="image/x-icon" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../css/voucher.css?v=1.0.0">
    <link rel="stylesheet" href="../css/doinik_hisab.css?v=1.0.0">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.7/dist/js/bootstrap-select.min.js"></script>

    <!-- alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>


    <style type="text/css">
        .rodDetailsEnCon {
            position: relative;
        }

        .scroll-after-btn {
            margin: 10px 0px 25px;
            width: 100px;
            position: absolute;
            right: 0px;
        }

        #detailsEtryTable {
            width: 293%;
            border: 1px solid #ddd;
        }

        #detailsEtryTable tr:first-child td {
            text-align: center;
            background-color: #3e9309ba;
            color: white;
        }

        #detailsEtryTable tr:nth-child(2) td {
            text-align: center;
            background-color: #3e9309ba;
            Color: white;
        }

        #detailsEtryTable tr:nth-child(3) td {
            border: 1px solid #3e9309d4;
            /* text-align: center; */

            /* Color: black; */
            /* box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px; */
        }

        #detailsEtryTable tr:nth-child(3) input {
            border: none;
            /* height: 39px; */
            /* border-radius: 10% 10% 0% 0%; */
            /* transition: border-bottom 1s linear ; */
        }

        #detailsEtryTable tr:nth-child(3) input[type=text]:focus {
            /* outline: 1px solid skyblue; */
            outline: none;
            border-bottom: 2px solid #508d2aba;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            /* font-size: 1px; */

        }

        #detailsEtryTable tr:nth-child(3) input[type=text]:focus::placeholder {
            color: transparent;

            /* font-size: large; */

        }

        #detailsEtryTable td {
            border: 2px solid #E0E4E0;
        }

        .scrolling-div {
            width: 100%;
            overflow-y: auto;
        }

        #form_entry {
            overflow-y: scroll;
        }

        /*.scrolling-div::-webkit-scrollbar {
          width: 10px;
          
        }
        .scrolling-div::-webkit-scrollbar-track {
          background: #ff9696;
          box-shadow: inset 0 0 5px grey; 
          border-radius: 10px;
        }
        .scrolling-div::-webkit-scrollbar-thumb {
          background: red;
          border-radius: 10px;
        }
        .scrolling-div::-webkit-scrollbar-thumb:hover {
          background: #900;
        }*/
        .scrollsign_plus {
            width: 25px;
            height: 25px;
            /*border: 1px solid red;*/
            font-size: 35px;
            line-height: 19px;
            padding: 3px;
            background-color: #75D265;
            color: #fff;
            border-radius: 50%;
            cursor: pointer;
            position: absolute;
            right: -35px;
            top: 15px;
            user-select: none;
            -moz-user-select: none;
            -webkit-user-select: none;
        }

        .widthPercent1 {
            width: 3.5%;
        }

        .widthPercent2 {
            width: 3.7%;
        }

        .widthPercent3 {
            width: 3.7%;
        }

        .header {
            /* Background color */
            /* background-color: #ddd; */

            /* Stick to the top */
            position: sticky;
            top: 0;

            /* Displayed on top of other rows when scrolling */
            z-index: 1;
        }

        #detailsNewTable2 {
            width: 217%;
            border: 1px solid #ddd;
            /*transform: rotateX(180deg);*/
        }

        #detailsNewTable2 th,
        td {
            border: 1px solid #ddd;
            padding: 2px 5px;
            margin-bottom: 0;

        }

        #detailsNewTable2 tr:first-child th {
            text-align: center;
            background-color: #363636db;
            color: #fff;
            padding: 5px 0px;
        }

        #detailsNewTable2 tr:nth-child(2) th {
            text-align: center;
            background-color: #363636db;
            padding: 5px 0px;
            color: #fff;
        }

        #detailsNewTable2 tr:nth-child(even) td {
            text-align: center;
            background-color: #d2df0d2e;
            color: black;
            padding: 5px 0px;
        }

        #detailsNewTable2 tr:nth-child(odd) td {
            text-align: center;
            background-color: white;
            color: black;
            padding: 5px 0px;
        }

        .viewDetailsCon {
            width: 100%;
            max-height: 470px;
            overflow-x: auto;
            /*overflow-y: auto;*/
            /*margin-bottom: 50px;*/
        }

        .ui-dialog-titlebar {
            color: white;
            background-color: #ce0000;
        }


        .dateSearch {
            position: relative;
            width: 225px;
            /*left: 325px;
            top: -6px;*/
        }

        .bootstrap-select {
            width: 130px !important;
        }

        .dealerIdSelect {
            width: 100%;
            text-align: center;
            height: 50px;
            /*border: 1px solid red;*/
        }

        .dealerIdSelect table {
            /*width: 50%;*/
            /*margin-left: 25%;*/
        }

        .dealerIdSelect table tr td {
            text-align: right;
            border: none;
        }

        #flip {
            /*border: 1px solid red;*/
            position: relative;
            top: -42px;
        }

        #flip label {
            display: inline-block;

        }

        #panel {
            border: 2px solid #333;
            margin: 0px 0px 20px;
        }

        table.summary tr td.hastext {
            text-align: right;
        }

        table.summary tr td.hastext {
            text-align: right;
        }

        /* The container */
        .conchk {
            display: inline-block;
            position: absolute;
            padding-right: 32px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 15px;
            right: 0px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default checkbox */
        .conchk input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        /* Create a custom checkbox */
        .checkmark {
            position: absolute;
            top: 0;
            right: 0;
            height: 22px;
            width: 22px;
            background-color: #9bd1ff;
            border: 1px solid #2196F3;
        }

        /* On mouse-over, add a grey background color */
        .conchk:hover input~.checkmark {
            background-color: #2196F3;
        }

        /* When the checkbox is checked, add a blue background */
        .conchk input:checked~.checkmark {
            background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the checkmark when checked */
        .conchk input:checked~.checkmark:after {
            display: block;
        }

        /* Style the checkmark/indicator */
        .conchk .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        .backcircle {
            font-size: 18px;
            position: absolute;
            margin-top: -25px;
        }

        .backcircle a:hover {
            text-decoration: none !important;
        }

        #gb_bank_ganti {
            position: absolute;
            left: 0px;
            top: -1px;
            background-color: #8de6a7;
            width: 150px;
            padding: 0px 3px;
            display: none;
        }

        .contorlAfterDealer {
            position: absolute;
            width: 408px;
            height: 45px;
            right: 15px;
            top: -6px;
        }

        .printBtnDlr {
            position: absolute;
            top: 0px;
            right: 1px;
            border: 2px solid #46b8da;
        }

        /* .printBtnDlrDown{
            position: absolute;
            top: 0px;
            right: 15px;
            border: 1px solid #46b8da;
        } */
        @media print {

            .no_print_media,
            .no_print_media * {
                display: none !important;
            }
        }

        .btn-info {
            background-color: #F0F0F0 !important;
            color: #000 !important;
        }

        .btn-info:hover {
            background-color: #F0F0F0 !important;
            color: #000 !important;
        }

        #popUpNewBtn {
            width: 30px;
            height: 30px;
            padding: 3px;
            background-color: #9c9c9c;
            background-color: #000;
            position: absolute;
            /*top: 30px;*/
            cursor: pointer;
            /*z-index: 9;*/
        }

        #popupEntry {
            display: none;
            width: 100%;
            background-color: rgba(0, 0, 0, .7);
            height: 100%;
            position: fixed;
            top: 0px;
            z-index: 99999;
        }

        #control_all {
            width: 50%;
            background-color: #fff;
            border: 5px solid #333;
            border-radius: 5px;
            height: 90%;
            position: relative;
            top: 5%;
            left: 50%;
            margin-left: -25%;
            padding: 15px;
        }

        .popupClose {
            position: absolute;
            top: 0px;
            right: 0px;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            padding: 5px;
            border: 1px solid red;
            transition: all .5s;
            cursor: pointer;
        }

        .bar_one {
            width: 20px;
            height: 3px;
            background-color: red;
            transform: rotate(45deg);
            position: relative;
            top: 7px;
            left: -1px;
            transition: all .5s;
        }

        .bar_two {
            width: 20px;
            height: 3px;
            background-color: red;
            transform: rotate(-45deg);
            position: relative;
            top: 4px;
            left: -1px;
            transition: all .5s;
        }

        .popupClose:hover {
            background-color: red;
            transition: all .5s;
        }

        .popupClose:hover .bar_one {
            background-color: #fff;
            transition: all .5s;
        }

        .popupClose:hover .bar_two {
            background-color: #fff;
            transition: all .5s;
        }

        .popupHead {
            text-align: center;
            margin: 15px 0px 15px;
        }

        .popupHead::after {
            content: '';
            height: 3px;
            /*width: 180px;*/
            width: calc(100% - 30px);
            position: absolute;
            left: 15px;
            top: 70px;
            /*margin-left: -98px;*/
            background-color: #ddd;
        }

        .items_all_con {
            /*border: 1px solid red;*/
            height: calc(100% - 63px);
            overflow-y: scroll;
            padding: 15px;
        }

        .pop_btn_con {
            position: relative;
            margin: 25px 0px 10px;
            height: 36px;
        }

        .popup_save_btn {
            width: 40%;
            position: absolute;
            left: 20px;
        }

        .popup_cancel_btn {
            width: 40%;
            position: absolute;
            right: 20px;
        }

        .protidinHisab {
            margin-top: 13px;
        }
    </style>
</head>

<body>
    <?php
    include '../navbar/header_text.php';
    // $page = 'rod_hisab';
    include '../navbar/navbar.php';
    ?>
    <div class="container">
        <?php
        // $ph_id = $_SESSION['project_name_id'];
        // $query = "SELECT * FROM project_heading WHERE id = $ph_id";
        // $show = $db->select($query);
        // if ($show) 
        // {
        // 	while ($rows = $show->fetch_assoc()) 
        // 	{
        ?>
        <!-- <div class="project_heading text-center" id="city_center_id">      
    				  <h2 class="text-center"><?php echo $rows['heading']; ?></h2>
    				  h4 class="text-center"><?php echo $rows['subheading']; ?></h4>
    				</div> -->
        <?php
        // 	}
        // } 
        ?>
        <!-- <p class="text-center">রড ক্রয় হিসাব</p> -->

        <!-- <div class="backcircle">
              <a href="../vaucher/rod_index.php">
                <img src="../img/logo/back.svg" alt="<== Back" width="20px" height="20px"> Back
              </a>
            </div> -->

    </div>

    <div class="bar_con">
        <div class="left_side_bar">
            <?php require '../others_page/left_menu_bar_pathor_hisab.php'; ?>
        </div>
        <div class="main_bar" style="padding-bottom: 30px;">
            <?php
            $ph_id = $_SESSION['project_name_id'];
            $query = "SELECT * FROM project_heading WHERE id = $ph_id";
            $show = $db->select($query);
            if ($show) {
                while ($rows = $show->fetch_assoc()) {
            ?>
                    <div class="project_heading">
                        <h2 class="headingOfAllProject" id="city_center_id">
                            <?php echo $rows['heading']; ?> <span class="protidinHisab">pathor and balu bikroy হিসাব</span>
                            <!-- , <span class="protidinHisab"><?php //echo $rows['subheading']; 
                                                                ?></span> -->

                        </h2>
                    </div>
            <?php
                }
            }
            ?>
            <div class="dealerIdSelect">
                <table>
                    <tr>
                        <td><b>Select a Customer Name</b></td>
                        <td><?php
                            $sql = "SELECT customer_name,customer_id FROM customers_pathor WHERE project_name_id = '$project_name_id'";
                            // $sql = "SELECT dealer_name, dealer_id,project_name_id  FROM balu_dealer WHERE project_name_id = '$project_name_id'";
                            $all_custmr_id = $db->select($sql);
                            echo '<select name="customer_id" id="delear_id" class="form-control" style="width: 222px;">';

                            if ($all_custmr_id->num_rows > 0) {
                                while ($row = $all_custmr_id->fetch_assoc()) {
                                    $id = $row['customer_id'];
                                    $dealer_name = $row['customer_name'];
                                    echo '<option value="' . $id . '">' . $dealer_name . '</option>';
                                }
                            } else {
                                echo '<option value="none">0 Result</option>';
                            }
                            echo '</select>';
                            ?></td>
                    </tr>
                </table>
            </div>
            <div id="allconid" style="display: none;">
            </div>

        </div>

        <div id="popupEntry">
            <div id="control_all">
                <div class="popupClose">
                    <div class="bar_one"></div>
                    <div class="bar_two"></div>
                </div>
                <h2 class="popupHead" style="color: Green;">বিক্রয় হিসাব এন্ট্রি</h2>
                <div class="items_all_con" style="background-color: gray; color: white; border: 2px solid black;">
                    <form id="insertPopupForm">
                        <table style="width: 100%;">
                            <tr>
                                <td>Customer ID(Customer আই ডি)</td>
                                <td>
                                    <?php
                                    $sql = "SELECT customer_id FROM customers_pathor";
                                    $all_custmr_id = $db->select($sql);
                                    echo '<select name="customer_id" id="customer_id_popup" class="form-control" disabled >';
                                    echo '<option value="none">Select...</option>';
                                    if ($all_custmr_id->num_rows > 0) {
                                        while ($row = $all_custmr_id->fetch_assoc()) {
                                            $id = $row['customer_id'];
                                            echo '<option value="' . $id . '">' . $id . '</option>';
                                        }
                                    } else {
                                        echo '<option value="none">0 Resulst</option>';
                                    }
                                    echo '</select>';
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Motor Name (গাড়ী নাম)</td>
                                <td>
                                    <input type="text" name="motor_name" class="form-control" id="motor_name_popup" placeholder="Enter Motor Name...">
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td>Driver Name (ড্রাইভারের নাম)</td>
                                <td>
                                    <input type="text" name="driver_name" class="form-control" id="driver_name_popup" placeholder="Enter Driver Name...">
                                </td>
                            </tr>
                            <tr>
                                <td>Motor Vara (গাড়ী ভাড়া)</td>
                                <td>
                                    <input type="text" onkeypress="return isNumber(event)" name="motor_vara" class="form-control value-calc-popup" id="motor_vara_popup" placeholder="Enter Motor Vara...">
                                </td>
                            </tr>
                            <tr>
                                <td>Unload (আনলোড)</td>
                                <td>
                                    <input type="text" name="unload" class="form-control value-calc-popup" id="unload_popup" placeholder="Unload">
                                </td>
                            </tr>
                            <tr>
                                <td>Cars rent & Redeem (গাড়ী ভাড়া ও খালাস)</td>
                                <td>
                                    <input type="text" name="cars_rent_redeem" class="form-control value-calc-popup" id="car_rent_redeem_popup" placeholder="Enter cars rent & redeem...">
                                </td>
                            </tr>
                            <tr>
                                <td>Information (মালের বিবরণ)</td>
                                <td>
                                    <input type="text" name="information" class="form-control" id="information_popup" placeholder="Enter information...">
                                </td>
                            </tr>
                            <tr>
                                <td>SL (ক্রমিক)</td>
                                <td>
                                    <input type="text" name="sl_no" class="form-control" id="sl_popup" placeholder="Enter SL...">
                                </td>
                            </tr>
                            <tr>
                                <td>Voucher No. (ভাউচার নং)</td>
                                <td>
                                    <input type="text" name="voucher_no" class="form-control" id="voucher_no_popup" placeholder="Enter Voucher No...">
                                </td>
                            </tr>
                            <tr>
                                <td>Address (ঠিকানা)</td>
                                <td>
                                    <input type="text" name="address" class="form-control" id="address_popup" placeholder="Enter address...">
                                </td>
                            </tr>
                            <tr>
                                <td>Motor Number (গাড়ী নাম্বার)</td>
                                <td>
                                    <input type="text" name="motor_number" class="form-control" id="motor_number_popup" placeholder="Enter motor number...">
                                </td>
                            </tr>

                            <tr>
                                <td>Motor Sl (গাড়ী নং)</td>
                                <td>
                                    <input type="text" name="motor_sl" class="form-control" id="motor_sl_popup" placeholder="Enter Motor Sl...">
                                </td>
                            </tr>
                            <tr>
                                <td>Delivery Date (ডেলিভারি তারিখ)</td>
                                <td>
                                    <input onkeypress="datecheckformatpopup(event)" type="text" name="delivery_date" class="form-control" id="delivery_date_popup" placeholder="dd-mm-yyyy">
                                </td>
                            </tr>
                            <tr>
                                <td>Date (তারিখ)</td>
                                <td>
                                    <input onkeypress="datecheckformatpopup(event)" type="text" name="dates" class="form-control" id="dates_popup" placeholder="dd-mm-yyyy">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>Partculars (মারফোত নাম)</td>
                                <td>
                                    <input type="text" name="partculars" class="form-control" id="partculars_popup" placeholder="Enter partculars...">
                                </td>
                            </tr>
                            <tr>
                                <td>Particulars (বিবরণ)</td>
                                <td>
                                    <?php
                                    $pathor_catgry_sql = "SELECT * FROM pathor_category";
                                    $rslt_pathor_catgry = $db->select($pathor_catgry_sql);

                                    echo '<select name="particulars" id="particulars_popup" class="form-control">';
                                    echo '<option value="">Select...</option>';
                                    if ($rslt_pathor_catgry->num_rows > 0) {
                                        while ($row = $rslt_pathor_catgry->fetch_assoc()) {
                                            $pathor_category_id = $row['id'];
                                            $pathor_category_name = $row['category_name'];

                                            echo '<option style="font-weight: bold;">' . $pathor_category_name . '</option>';

                                            $pathor_lbl_sql = "SELECT * FROM pathor_and_other_label";
                                            $rslt_pathor_lbl = $db->select($pathor_lbl_sql);
                                            if ($rslt_pathor_lbl->num_rows > 0) {

                                                while ($row2 = $rslt_pathor_lbl->fetch_assoc()) {
                                                    $raol_id = $row2['id'];
                                                    $raol_pathor_label = $row2['pathor_label'];
                                                    $raol_pathor_category_id = $row2['pathor_category_id'];


                                                    if ($pathor_category_id == $pathor_balu_category_id) {
                                                        echo "<option value='" . $raol_pathor_label . "'>" . $raol_pathor_label . "</option>";
                                                    }
                                                }
                                            } else {
                                                echo '<option>0 results</option>';
                                            }
                                        }
                                    } else {
                                        echo '<option>0 results</option>';
                                    }
                                    echo '</select> ';
                                    ?>
                                </td>
                            </tr> -->
                            <tr>
                                <td>Debit (জমা টাকা)</td>
                                <td>
                                    <input type="text" name="debit" class="form-control value-calc-popup" id="debit_popup" placeholder="Enter debit...">
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>Ton & Kg (টোন ও কেজি)</td>
                                <td>
                                    <input type="text" name="ton_kg" class="form-control" id="ton_kg_popup" placeholder="Enter Ton & Kg...">
                                </td>
                            </tr>
                            <tr>
                                <td>Length (দৈর্ঘ্যের)</td>
                                <td>
                                    <input type="text" name="length" class="form-control" id="length_popup" placeholder="Enter Length...">
                                </td>
                            </tr>
                            <tr>
                                <td>Width (প্রস্ত)</td>
                                <td>
                                    <input type="text" name="width" class="form-control" id="width_popup" placeholder="Enter Width...">
                                </td>
                            </tr>
                            <tr>
                                <td>Height (উচাঁ)</td>
                                <td>
                                    <input type="text" name="height" class="form-control" id="height_popup" placeholder="Enter height...">
                                </td>
                            </tr>
                            <tr>
                                <td>Shifty (সেপ্টি)</td>
                                <td>
                                    <input type="text" name="shifty" class="form-control" id="shifty_popup" placeholder="Enter Shifty...">
                                </td>
                            </tr>
                            <tr>
                                <td>Inchi (-) Minus (Inchi (-) বিয়োগ )</td>
                                <td>
                                    <input type="text" name="inchi_minus" class="form-control" id="inchi_minus_popup" placeholder="Enter Inchi (-) Minus...">
                                </td>
                            </tr>
                            <tr>
                                <td>Cft ( - ) Dropped Out (সিএফটি ( - ) বাদ)</td>
                                <td>
                                    <input type="text" name="cft_dropped_out" class="form-control" id="cft_dropped_popup" placeholder="Enter Cft ( - ) Dropped Out ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Inchi (+) Added (Inchi (+) যোগ) </td>
                                <td>
                                    <input type="text" name="inchi_added" class="form-control" id="inchi_added_popup" placeholder="Enter Inchi (+) Added ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Points ( - ) Dropped Out (পয়েন্ট ( - ) বাদ) </td>
                                <td>
                                    <input type="text" name="points_dropped_out" class="form-control" id="points_dropped_popup" placeholder="Enter Points ( - ) Dropped Out ...">
                                </td>
                            </tr>
                            <tr>
                                <td> Shift(সেপ্টি) </td>
                                <td>
                                    <input type="text" name="shift" class="form-control" id="shift_popup" placeholder="Enter Shift ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Total Shift(মোট সেপ্টি) </td>
                                <td>
                                    <input type="text" name="total_shift" class="form-control" id="total_shift_popup" placeholder="Enter Total Shift ...">
                                </td>
                            </tr> -->
                            <tr>
                                <td> Para's (দর) </td>
                                <td>
                                    <input type="text" name="paras" class="form-control value-calc-popup" id="paras_popup" placeholder="Enter Paras ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Discount(কমিশন) </td>
                                <td>
                                    <input type="text" name="discount" class="form-control value-calc-popup" id="discount_popup" placeholder="Enter Discount ...">
                                </td>
                            </tr>
                            <tr>
                                <td>Credit(মূল) </td>
                                <td>
                                    <input type="text" name="credit" class="form-control value-calc-popup" id="credit_popup" placeholder="Enter Credit ...">
                                </td>
                            </tr>
                            <tr>
                                <td> Balance(অবশিষ্ট) </td>
                                <td>
                                    <input type="text" name="balance" class="form-control value-calc-popup" id="balance_popup" placeholder="Enter Balance  ...">
                                </td>
                            </tr>

                            <tr>
                                <td>Cemeat's Para's (গাড়ী ভাড়া / লেবার সহ)</td>
                                <td>
                                    <input type="text" name="cemeats_paras" class="form-control value-calc-popup" id="cemeats_paras_popup" placeholder="Enter Cemeat's Para's...">
                                </td>
                            </tr>
                            <!-- <td>Ton(টোন)</td>
                            <td>
                                <input type="text" name="ton" class="form-control" id="ton _popup" placeholder="Enter Ton...">
                            </td>
                            </tr>
                            <tr>
                                <td>Total Shift(সেপ্টি)</td>
                                <td>
                                    <input type="text" name="total_shift" class="form-control" id="total_shift_popup" placeholder="Enter bundil...">
                                </td>
                            </tr> -->
                            <tr hidden>
                                <td>Tons (টোন)</td>
                                <td>
                                    <input type="text" name="tons" class="form-control value-calc-popup" id="tons_popup" placeholder="Enter total_paras...">
                                </td>
                            </tr>
                            <tr>
                                <td>Bank_name (ব্যাংক নাম)</td>
                                <td>
                                    <input type="text" name="bank_name" class="form-control" id="bank_name_popup" placeholder="Enter Bank Name...">
                                </td>
                            </tr>
                            <tr>
                                <td>Fee(ফি)</td>
                                <td>
                                    <input type="text" name="fee" class="form-control value-calc-popup" id="fee_popup" placeholder="Enter fee...">
                                </td>
                            </tr>
                        </table>
                        <h4 class="text-success text-center" id="NewEntrySucMsgPopup"></h4>

                        <input type="hidden" name="pathor_details_id" id="pathor_details_id">
                        <div class="pop_btn_con">
                            <input onclick="valid('insert_popup')" type="button" name="submit" class="btn btn-primary popup_save_btn" value="Save" id="popup_save_update_btn">
                            <input type="button" class="btn btn-danger popup_cancel_btn" value="Cancel" id="popup_cancel_btn">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../others_page/delete_permission_modal.php';  ?>



    <script>
        $(document).on("click", "#flipChkbox", function() {
            if ($('#flipChkbox input[type="checkbox"]').prop("checked") == true) {
                // alert("Checkbox is checked.");
                $("#panel").slideDown("slow");
            } else if ($('#flipChkbox input[type="checkbox"]').prop("checked") == false) {
                // alert("Checkbox is unchecked.");
                $("#panel").slideUp("slow");
            }
        });
        // onkeypress="return isNumber(event)"
    </script>
    <script type="text/javascript">
        function dealerWiseSummaryDetailsSearchAndEntry(dlrId, restext = false) {
            $.ajax({
                url: '../ajaxcall/pathor_sell_dealer_wise_summary_details_search_and_sell_entry.php',
                type: 'post',
                data: {
                    dealerId: dlrId,
                },
                success: function(res) {
                    // alert(res);
                    $('#allconid').html(res);

                    if (restext != false) {
                        $('#NewEntrySucMsg').html(restext).show();
                        $('#NewEntrySucMsgPopup').html(restext).show();
                    }

                    $('.selectpicker').selectpicker();


                    $('#delivery_date').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });


                    $('#dates').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });

                    $('#flipChkbox input[type="checkbox"]').prop("checked", true);
                    // $('#gb_bank_ganti').hide();

                    // $(document).on('keypress', '#gb_bank_ganti', function(e){
                    //     if (e.which == 13){
                    //       alert('Hiii');
                    //     }
                    // }
                    $('.left_side_bar').height($('.main_bar').height());

                    $("#popUpNewBtn").click(function() {
                        $("#NewEntrySucMsg").html('');
                        $('#NewEntrySucMsgPopup').html('');
                        // $('#popup_save_update_btn').val('Save').attr("onclick", "valid('insert_popup')");

                        $("#popupEntry").fadeIn(500);
                        $(".items_all_con").animate({
                            scrollTop: 0
                        }, "0");
                        // $(".items_all_con").scrollTop(0);
                        // console.log('red');
                    });

                    $(".popupClose").click(function() {
                        $("#popupEntry").fadeOut(500);

                        $('#customer_id_popup').val("none").change();
                        $('#motor_name_popup').val('');
                        $('#driver_name_popup').val('');
                        $('#unload_popup').val('');
                        $('#car_rent_redeem_popup').val('');
                        $('#information_popup').val('');
                        $('#sl_popup').val('');
                        $('#voucher_no_popup').val('');
                        $('#address_popup').val('');
                        $('#motor_number_popup').val('');
                        $('#motor_sl_popup').val('');
                        $('#delivery_date_popup').val('');
                        $('#dates_popup').val('');
                        $('#partculars_popup').val('');
                        $('#particulars_popup').val("").change();
                        $('#debit_popup').val('');
                        $('#ton_kg_popup').val('');
                        $('#length_popup').val('');
                        $('#width_popup').val('');
                        $('#height_popup').val('');
                        $('#shifty_popup').val('');
                        $('#inchi_minus_popup').val('');
                        $('#cft_dropped_popup').val('');
                        $('#inchi_added_popup').val('');
                        $('#points_dropped_popup').val('');
                        $('#shift_popup').val('');
                        $('#total_shift_popup').val('');
                        $('#paras_popup').val('');
                        $('#discount_popup').val('');
                        $('#credit_popup').val('');
                        $('#balance_popup').val('');
                        $('#cemeats_paras_popup').val('');
                        $('#ton_popup').val('');
                        $('#total_shift_popup').val('');
                        $('#tons_popup').val('');
                        $('#bank_name_popup').val('');
                        $('#fee_popup').val('');
                        $("#NewEntrySucMsg").html('');
                        $("#NewEntrySucMsgPopup").html('');
                    });
                    $("#popup_cancel_btn").click(function() {
                        $(".popupClose").trigger('click');
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function getDealerNameByDealerId(dlrIda) {
            $.ajax({
                url: '../ajaxcall/pathor_get_dealer_name_by_dealer_id.php',
                type: 'post',
                data: {
                    dealerId: dlrIda,
                },
                success: function(res) {
                    // alert(res);
                    $('#city_center_id').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
        $(document).on('change', '#delear_id', function() {
            var optionValue = $('#delear_id option:selected').val();
            // alert(optionValue);
            if (optionValue === '') {
                $('#allconid').css('display', 'none');
            } else {
                dealerWiseSummaryDetailsSearchAndEntry(optionValue);
                $('#allconid').css('display', 'block');
            }
            getDealerNameByDealerId(optionValue);
        });

        $("#delear_id").val("DLAR-100001").change();
    </script>
    <script type="text/javascript">
        $(document).on('click', '.detailsDelete', function(event) {
            var data_delete_id = $(event.target).attr('data_delete_id');
            $("#verifyPasswordModal").show().height($("html").height() + $(".bar_con").height());
            $("#matchPassword").val('');
            $("#passMsg").html('');
            $("#verifyToDeleteBtn").removeAttr("data_delete_id");
            $("#verifyToDeleteBtn").attr("data_delete_id", data_delete_id);
        });
        $(document).on('click', '#verifyToDeleteBtn', function(event) {
            event.preventDefault();
            var data_delete_id = $(event.target).attr('data_delete_id');
            console.log('detailsDelete', data_delete_id);
            $("#passMsg").html("").css({
                'margin': '0px'
            });
            var pass = $("#matchPassword").val();
            $.ajax({
                url: "../ajaxcall/balu_match_password_for_vaucher_credit.php",
                type: "post",
                data: {
                    pass: pass
                },
                success: function(response) {
                    // alert(response);
                    if (response == 'password_matched') {
                        $("#verifyPasswordModal").hide();
                        ConfirmDialog('Are you sure delete details info?', data_delete_id);
                    } else {
                        $("#passMsg").html(response).css({
                            'color': 'red',
                            'margin-top': '10px'
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

            function ConfirmDialog(message, data_delete_id) {
                $('<div></div>').appendTo('body')
                    .html('<div><h4>' + message + '</h4></div>')
                    .dialog({
                        modal: true,
                        title: 'Alert',
                        zIndex: 10000,
                        autoOpen: true,
                        width: '40%',
                        resizable: false,
                        position: {
                            my: "center",
                            at: "center center-20%",
                            of: window
                        },
                        buttons: {
                            Yes: function() {
                                var urltxt = '../ajaxcall/pathor_del_sell_entry_ajax.php';
                                $.ajax({
                                    url: urltxt,
                                    type: 'post',
                                    dataType: 'html',
                                    data: {
                                        'rod_details_id': data_delete_id
                                    },
                                    success: function(res) {
                                        console.log(res);
                                        // alert(res);
                                        var optionValue = $('#delear_id option:selected').val();
                                        dealerWiseSummaryDetailsSearchAndEntry(optionValue, res);
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.log(textStatus, errorThrown);
                                    }
                                });
                                $(this).dialog("close");
                                //   $.get("rod_details_entry.php?remove_id="+ data_delete_id, function(data, status){
                                // console.log(status);
                                //    if(status == 'success'){
                                //      window.location.href = 'rod_details_entry.php';
                                //    }
                                //   });
                            },
                            No: function() {
                                $(this).dialog("close");
                            }
                        },
                        close: function(event, ui) {
                            $(this).remove();
                        }
                    });
            };
        });
    </script>
    <script type="text/javascript">
        function valid(submit_type) {
            var returnValid = false;

            if (submit_type == 'insert') {
                var customer_id = $('#customer_id').val();
                var partculars = $('#partculars').val();
                var particulars = $('#particulars').val();

                if (customer_id == 'none') {
                    alert('Please select a customer Id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }

                if (partculars == 'none') {
                    alert('Please select a marfot name');
                    returnValid = false;
                } else {
                    returnValid = true;
                }

                if (particulars == 'none') {
                    alert('Please select a particular');
                    returnValid = false;
                } else {
                    returnValid = true;
                }
                var formElement = $('#form_entry')[0];
                var formData = new FormData(formElement);
                var urltxt = '../ajaxcall/pathor_sell_details_entry_ajax.php';

            } else if (submit_type == 'insert_popup') {
                var buyer_id = $('#buyer_id_popup').val();

                if (buyer_id == 'none') {
                    alert('Please select a buyer Id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }
                var formElement = $('#insertPopupForm')[0];
                var formData = new FormData(formElement);
                var urltxt = '../ajaxcall/pathor_details_entry_ajax.php';

            } else {
                ////Horizontal Edit er code
                // var buyer_id_edit = $('#buyer_id_edit').val();

                // if(buyer_id_edit == 'none'){
                //     alert('Please select a buyer Id');
                //     returnValid = false;
                // } else{
                //     returnValid = true;
                // }
                // var formElement = $('#form_edit')[0];
                // var formData = new FormData(formElement);
                // var urltxt = '../ajaxcall/rod_update_entry_ajax.php';

                ////Popup edit/update er code
                var customer_id = $('#customer_id_popup').val();

                if (customer_id == 'none') {
                    alert('Please select a customer Id');
                    returnValid = false;
                } else {
                    returnValid = true;
                }
                var formElement = $('#insertPopupForm')[0];
                var formData = new FormData(formElement);
                var urltxt = '../ajaxcall/pathor_update_sell_entry_ajax.php';

            }

            if (returnValid) {
                $.ajax({
                    url: urltxt,
                    type: 'post',
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    data: formData,
                    success: function(res) {
                        console.log(res);
                        // alert(res);          
                        var optionValue = $('#delear_id option:selected').val();
                        dealerWiseSummaryDetailsSearchAndEntry(optionValue, res);
                        $('#customer_id_popup').val("none").change();
                        $('#motor_name_popup').val('');
                        $('#driver_name_popup').val('');
                        $('#motor_vara_popup').val('');
                        $('#unload_popup').val('');
                        $('#car_rent_redeem_popup').val('');
                        $('#information_popup').val('');
                        $('#sl_popup').val('');
                        $('#voucher_popup').val('');
                        $('#address_popup').val('');
                        $('#motor_number_popup').val('');
                        $('#motor_sl_popup').val('');
                        $('#delivery_date_popup').val('');
                        $('#dates_popup').val('');
                        $('#partculars_popup').val('');
                        $('#particulars_popup').val("").change();
                        $('#debit_popup').val('');
                        $('#ton_kg_popup').val('');
                        $('#length_popup').val('');
                        $('#width_popup').val('');
                        $('#height_popup').val('');
                        $('#shifty_popup').val('');
                        $('#inchi_minus_popup').val('');
                        $('#cft_dropped_popup').val('');
                        $('#inchi_added_popup').val('');
                        $('#points_dropped_popup').val('');
                        $('#shift_popup').val('');
                        $('#total_shift_popup').val('');
                        $('#paras_popup').val('');
                        $('#discount_popup').val('');
                        $('#credit_popup').val('');
                        $('#balance_popup').val('');
                        $('#cemeats_paras_popup').val('');
                        $('#ton_popup').val('');
                        $('#total_shifts_popup').val('');
                        $('#tons_popup').val('');
                        $('#bank_name_popup').val('');
                        $('#fee_popup').val('');
                        $('#NewEntrySucMsgPopup').html('');
                        // $('#popup_save_update_btn').val('Save').attr("onclick", "valid('insert_popup')");

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        }
    </script>
    <script type="text/javascript">
        function edit_rod_details(rod_id) {
            $('.rodDetailsEnCon').hide();
            var urltxt = '../ajaxcall/pathor_edit_entry_ajax.php';
            $.ajax({
                url: urltxt,
                type: 'post',
                dataType: 'html',
                // processData: false,
                // contentType: false,
                data: {
                    'pathor_details_id': rod_id
                },
                success: function(res) {
                    console.log(res);
                    // alert(res);
                    $('.rodDetailsEdit').html(res).show();
                    window.scrollTo(0, 500);



                    $('#delivery_date_edit').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });
                    $('#dates_edit').bind('keydown', function(e) {
                        if (e.which == 13)
                            e.stopImmediatePropagation();
                    }).datepicker({
                        onSelect: function(date) {
                            // alert(date);
                            $(this).change();
                        },
                        dateFormat: "dd-mm-yy",
                        changeYear: true,
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        function edit_rod_popup(element, rowid) {
            var customer_id = $(element).closest('tr').find('td:eq(0)').text();
            // var dlar_id         = $(element).closest('tr').find('td:eq(1)').text();
            var motor_name = $(element).closest('tr').find('td:eq(1)').text();
            var driver_name = $(element).closest('tr').find('td:eq(2)').text();
            var motor_vara = $(element).closest('tr').find('td:eq(3)').text();
            var unload = $(element).closest('tr').find('td:eq(4)').text();
            var cars_rent_redeem = $(element).closest('tr').find('td:eq(5)').text();
            var information = $(element).closest('tr').find('td:eq(6)').text();
            var sl = $(element).closest('tr').find('td:eq(7)').text();
            var voucher_no = $(element).closest('tr').find('td:eq(8)').text();
            var address = $(element).closest('tr').find('td:eq(9)').text();
            var motor_number = $(element).closest('tr').find('td:eq(10)').text();
            var motor_sl = $(element).closest('tr').find('td:eq(11)').text();
            var delivery_date = $(element).closest('tr').find('td:eq(12)').text();
            var date = $(element).closest('tr').find('td:eq(13)').text();
            var partculars = $(element).closest('tr').find('td:eq(14)').text();
            var particulars = $(element).closest('tr').find('td:eq(15)').text();
            var debit = $(element).closest('tr').find('td:eq(16)').text();
            var ton_kg = $(element).closest('tr').find('td:eq(17)').text();
            var length = $(element).closest('tr').find('td:eq(18)').text();
            var width = $(element).closest('tr').find('td:eq(19)').text();
            var height = $(element).closest('tr').find('td:eq(20)').text();
            var shifty = $(element).closest('tr').find('td:eq(21)').text();
            var inchi_minus = $(element).closest('tr').find('td:eq(22)').text();
            var cft_dropped = $(element).closest('tr').find('td:eq(23)').text();
            var inchi_added = $(element).closest('tr').find('td:eq(24)').text();
            var points_dropped = $(element).closest('tr').find('td:eq(25)').text();
            var shift = $(element).closest('tr').find('td:eq(26)').text();
            var total_shift = $(element).closest('tr').find('td:eq(27)').text();
            var paras = $(element).closest('tr').find('td:eq(28)').text();
            var discount = $(element).closest('tr').find('td:eq(29)').text();
            var credit = $(element).closest('tr').find('td:eq(30)').text();
            var balance = $(element).closest('tr').find('td:eq(31)').text();
            var cemeats_paras = $(element).closest('tr').find('td:eq(32)').text();
            var ton = $(element).closest('tr').find('td:eq(33)').text();
            var total_shift = $(element).closest('tr').find('td:eq(34)').text();
            var tons = $(element).closest('tr').find('td:eq(35)').text();
            var bank_name = $(element).closest('tr').find('td:eq(36)').text();
            var fee = $(element).closest('tr').find('td:eq(37)').text();


            // alert(buyr_id);
            $('#pathor_details_id').val(rowid);
            $('#customer_id_popup').val(customer_id);
            $('#motor_name_popup').val(motor_name);
            $('#driver_name_popup').val(driver_name);
            $('#motor_vara_popup').val(motor_vara);
            $('#unload_popup').val(unload);
            $('#car_rent_redeem_popup').val(cars_rent_redeem);
            $('#information_popup').val(information);
            $('#sl_popup').val(sl);
            $('#voucher_no_popup').val(voucher_no);
            $('#address_popup').val(address);
            $('#motor_number_popup').val(motor_number);
            $('#motor_sl_popup').val(motor_sl);
            $('#delivery_date_popup').val(delivery_date);
            $('#dates_popup').val(date);
            $('#partculars_popup').val(partculars);
            $('#particulars_popup').val(particulars);
            $('#debit_popup').val(debit);
            $('#ton_kg_popup').val(ton_kg);
            $('#length_popup').val(length);
            $('#width_popup').val(width);
            $('#height_popup').val(height);
            $('#shifty_popup').val(shifty);
            $('#inchi_minus_popup').val(inchi_minus);
            $('#cft_dropped_popup').val(cft_dropped);
            $('#inchi_added_popup').val(inchi_added);
            $('#points_dropped_popup').val(points_dropped);
            $('#shift_popup').val(shift);
            $('#total_shift_popup').val(total_shift);
            $('#paras_popup').val(paras);
            $('#discount_popup').val(discount);
            $('#credit_popup').val(credit);
            $('#balance_popup').val(balance);
            $('#cemeats_paras_popup').val(cemeats_paras);
            $('#ton_popup').val(ton);
            $('#total_shift_popup').val(total_shift);
            $('#tons_popup').val(tons);
            $('#bank_name_popup').val(bank_name);
            $('#fee_popup').val(fee);


            $('#popup_save_update_btn').val('Update').attr("onclick", "valid('update_popup')").click(function() {
                $(".popupClose").trigger('click');
            });
            $("#popupEntry").fadeIn(500);
            $("#NewEntrySucMsgPopup").html('');
            $(".items_all_con").animate({
                scrollTop: 0
            }, "0");
        }
    </script>
    <script type="text/javascript">
        //Start calculation
        $(document).on('input change paste keyup', '.value-calc', function() {

            // var input_cft = $('#shift').val();
            // if(input_cft != ''){
            //     $('#total_shift').val(input_cft);
            //         $('#total_shifts').val(input_cft);
            // }



            if (kg != '') {
                $('#paras').attr("placeholder", "rate");
                var kg = $('#kg').val();
                var paras = $('#paras').val();
                if (kg == '') {
                    $('#credit').val('0');
                } else if (paras == '') {
                    $('#credit').val('0');
                } else {
                    var credit = kg * paras;
                    //  alert(credit);
                    $('#credit').val(credit.toFixed(2));
                }
            }


            // if(length != ''){
            //     $('#paras').attr("placeholder", "per cft");
            //     var t_s = $('#total_shift').val();
            //             var paras = $('#paras').val();
            //             if (t_s == '') {
            //                 $('#credit').val('0');
            //             } else if (paras == '') {
            //                 $('#credit').val('0');
            //             } else {
            //                 var credit_ts = t_s * paras;
            //                 //  alert(credit);
            //                 $('#credit').val(credit_ts.toFixed(2));
            //             }
            // }
            // else{
            //     $('#paras').attr("placeholder", "per ton");

            // }

            //shifty
            var length = $('#length').val();
            var width = $('#width').val();
            var height = $('#height').val();

            var inchi_minus = $("#inchi_minus").val();
            var cft_dropped_out = $('#cft_dropped_out').val();
            var inchi_added = $('#inchi_added').val();
            var points_dropped_out = $('#points_dropped_out').val();


            if (length != '' || width != '' || height != '') {

                $("#kg").attr("placeholder", "not applicable").prop("disabled", true);
                $("#td_kg").click(function() {
                    Swal.fire("Clear cft first");
                });
                var shifty = length * width * height;
                if (inchi_minus > shifty) {
                    Swal.fire("Not acceptable. Value should be less then cft");
                    $('#inchi_minus').val("");
                }
                if (cft_dropped_out > shifty) {
                    Swal.fire("Not acceptable. Value should be less then cft");
                    $('#cft_dropped_out').val("");
                }
                if (points_dropped_out > shifty) {
                    Swal.fire("Not acceptable. Value should be less then cft");
                    $('#points_dropped_out').val("");
                }
                if (shifty < 0) {
                    $('#shifty').val("");
                }
                if (inchi_minus != '' || cft_dropped_out != '' || inchi_added != '' || points_dropped_out != '') {
                    var shifty2 = (length * width * height) - (length * width * inchi_minus / 12) - cft_dropped_out + (length * width * inchi_added / 12) - points_dropped_out;
                    var shift2_to_ton = shifty2 / 23.5;
                    // alert(credit);
                    $('#shifty').val(shifty.toFixed(3));
                    $('#ton').val(shift2_to_ton.toFixed(2));
                    $('#tons').val(shift2_to_ton.toFixed(2));
                    $('#shift').val(shifty2.toFixed(3));

                    // $('#shift').attr('value', 'shifty2.toFixed(3)');
                    // $('#total_shift').val(shifty2.toFixed(2));
                    $('#total_shifts').val(shifty2.toFixed(2));
                } else {
                    var shift_to_ton = shifty / 23.5;
                    // alert(credit);
                    $('#shifty').val(shifty.toFixed(3));
                    $('#ton').val(shift_to_ton.toFixed(2));
                    $('#tons').val(shift_to_ton.toFixed(2));
                    $('#shift').val(shifty.toFixed(3));
                    // $('#total_shift').val(shifty.toFixed(2));
                    $('#total_shifts').val(shifty.toFixed(2));

                }
            } else if (width == '') {
                $("#kg").attr("placeholder", "ton and kg");
                $("#kg").prop("disabled", false);
                $('#shift').attr("placeholder", "not applicable");
                $('#shifty').attr("placeholder", "not applicable");

            } else if (height == '') {
                $("#kg").attr("placeholder", "ton and kg");
                $("#kg").prop("disabled", false);
                $('#shift').attr("placeholder", "not applicable");
                $('#shifty').attr("placeholder", "not applicable");
            } else if (length == '') {
                $("#kg").attr("placeholder", "ton and kg");
                $("#kg").prop("disabled", false);
                $('#shift').attr("placeholder", "not applicable");
                $('#shifty').attr("placeholder", "not applicable");
                // $('#total_shifty').val('0');
            }
            // else if(length != ''){
            //     $('#kg').val('0');
            // }
            else {



            }


            //ton and kg
            var shifty = $('#shift').val();
            var ton_kg = $('#kg').val();
            var credit = $("#credit").val();

            if (ton_kg != '') {
                $("#length").attr("placeholder", "not applicable").prop("disabled", true);
                $("#length").attr("readonly", true);
                // if($("#length").click){
                //     Swal.fire("Should be enter a number value");
                // }
                // $('#length').val('not applicable');
                $('#width').attr("placeholder", "not applicable").prop("disabled", true);
                $("#width").attr("readonly", true);
                $('#height').attr("placeholder", "not applicable").prop("disabled", true);
                $("#height").attr("readonly", true);

                $('#shifty').attr("placeholder", "not applicable").prop("disabled", true);
                $('#shift').attr("placeholder", "not applicable").prop("disabled", true);
                $('#total_shift').attr("placeholder", "not applicable").prop("disabled", true);
                $('#ton').attr("placeholder", "not applicable").prop("disabled", true);
                // $('#height').attr("placeholder", "not applicable").prop("disabled", true).css("background-color","gray");
                // $("#height").attr("readonly", true);
                // $('#').attr("value", "not applicable");
                $('#inchi_minus').attr("placeholder", "not applicable").prop("disabled", true);
                $("#inchi_minus").attr("readonly", true);
                $('#cft_dropped_out').attr("placeholder", "not applicable").prop("disabled", true);
                $("#cft_dropped_out").attr("readonly", true);
                $('#inchi_added').attr("placeholder", "not applicable").prop("disabled", true);
                $("#inchi_added").attr("readonly", true);
                $('#points_dropped_out').attr("placeholder", "not applicable").prop("disabled", true);
                $("#points_dropped_out").attr("readonly", true);
                // $('#').attr("value", "not applicable");
                $('#ton').val(ton_kg);
                $('#tons').val(ton_kg);

                var ton_to_cft = (ton_kg * 23.5).toFixed(3);
                // $('#shifty').val(ton_to_cft);
                // $('#shift').val(ton_to_cft);
                // $('#total_shift').val(ton_to_cft);
                $('#total_shifts').val(ton_to_cft);
            } else {
                $("#length").attr("placeholder", "length").prop("disabled", false);
                $("#length").attr("readonly", false);
                // $('#length').val('not applicable');
                $('#width').attr("placeholder", "width").prop("disabled", false);
                $("#width").attr("readonly", false);
                $('#height').attr("placeholder", "height").prop("disabled", false);
                $("#height").attr("readonly", false);
                $('#inchi_minus').attr("placeholder", "inchi_minus").prop("disabled", false);
                $("#inchi_minus").attr("readonly", false);
                $('#cft_dropped_out').attr("placeholder", "cft_dropped_out").prop("disabled", false);
                $("#cft_dropped_out").attr("readonly", false);
                $('#inchi_added').attr("placeholder", "inchi_added").prop("disabled", false);
                $("#inchi_added").attr("readonly", false);
                $('#points_dropped_out').attr("placeholder", "points_dropped_out").prop("disabled", false);
                $("#points_dropped_out").attr("readonly", false);


                $('#shifty').prop("disabled", false);
                $('#shift').prop("disabled", false);
                $('#total_shift').prop("disabled", false);
                $('#ton').prop("disabled", false);

                var credit = shifty * paras;
                // alert(credit);
                $('#credit').val(credit.toFixed(3));
            }

            var total_input_cft = $('#total_shift').val();
            if (total_input_cft != '') {
                $('#paras').attr("placeholder", "per cft");

                var paras = $('#paras').val();
                // if (kg == '') {
                //     $('#credit').val('0');
                // } else if (paras == '') {
                //     $('#credit').val('0');
                // } else {
                var credit = total_input_cft * paras;
                //  alert(credit);
                $('#credit').val(credit.toFixed(2));
                // }
            }


            var discount = $("#discount").val();
            if (discount != '') {
                var credit = credit - discount;
                $('#credit').val(credit.toFixed(3));
                if (discount > credit) {
                    $('#discount').focus(function() {
                        $('#discount').val("");
                    });
                    Swal.fire("Not acceptable. Value should be less then credit");
                }
            }
            var fee = $("#fee").val();
            if (fee != '') {
                var credit = parseFloat(credit) + parseFloat(fee);
                $('#credit').val(credit.toFixed(3));
            }



            // console.log(inchi_minus);
            // console.log(ton_kg);

            // if (inchi_minus != '') {
            //     console.log(inchi_minus);
            //     $('#shift').val(inchi_minus);
            //     $('#total_shift').val('test');

            // }

            // if (cft_dropped_out != '') {
            //     console.log(cft_dropped_out);

            // }

            // var car_rent_redeem = $('#car_rent_redeem').val();
            // var credit = $("#credit").val();
            // if (car_rent_redeem == '') {
            //     var total_paras = credit;
            //     $('#credit').val(total_paras);
            // } else {
            //     var total_paras = parseFloat(car_rent_redeem) + parseFloat(credit);
            //     $('#credit').val(total_paras);
            // }
            // debit theke minus hote ai part tuku age dite hobe

            var debit = $("#debit").val();
            var credit = $("#credit").val();
            if (debit == '') {
                $('#balance').val('0');
            } else if (credit == '') {
                $('#balance').val('0');
            } else {
                var balance = credit - debit;
                // alert(balance);
                $('#balance').val(balance.toFixed(3));
            }

            var motor_vara = $('#motor_vara').val();
            var unload = $('#unload').val();
            if (motor_vara == '') {
                $('#motor_vara').attr("placeholder", "motor vara");
                //  $('#motor_vara').attr("value", "0");
                //  $('#motor_vara').val(0);

                $('#car_rent_redeem').val(unload);
                $('#cemeats_paras').val(unload);
            } else if (unload == '') {
                $('#unload').attr("placeholder", "unload");
                //  $('#unload').attr("value", "0");
                //  $('#unload').val(0);

                $('#car_rent_redeem').val(motor_vara);
                $('#cemeats_paras').val(motor_vara);
            } else if (unload == 0 && motor_vara == 0) {
                $('#car_rent_redeem').val(0);
            } else {


                //                 $('#motor_vara').focus(function(){
                //                     $('#motor_vara').value('')
                // });

                var car_rent_redeem = parseInt(motor_vara) + parseInt(unload);
                // alert(balance);
                $('#car_rent_redeem').val(car_rent_redeem);
                $('#cemeats_paras').val(car_rent_redeem);
            }




            // if (motor_vara == '') {
            //     $('#motor_vara').val()=null;
            // } else if (unload == '') {
            //     $('#unload').val()=null;
            // } else {
            //     $('#motor_vara').val()=null;
            // $('#unload').val()=null;
            //     var tar = motor_vara?$('#motor_vara').val():'0';
            //     var tar2 = motor_vara?$('#unload').val():'0';
            //     var car_rent_redeem = parseInt(tar) + parseInt(tar2);
            //     // alert(balance);
            //     $('#car_rent_redeem').val(car_rent_redeem);
            //     $('#cemeats_paras').val(car_rent_redeem);
            // }


        });
        // $(document).on('input change paste keyup', '.value-calc_edit', function() {
        //     var kg = $('#kg_edit').val();
        //     var paras = $('#paras_edit').val();
        //     if (kg == '') {
        //         $('#credit_edit').val('0');
        //     } else if (paras == '') {
        //         $('#credit_edit').val('0');
        //     } else {
        //         var credit = kg * paras;
        //         // alert(credit);
        //         $('#credit_edit').val(credit);
        //     }

        //     var debit = $("#debit_edit").val();
        //     var credit = $("#credit_edit").val();
        //     if (debit == '') {
        //         $('#balance_edit').val('0');
        //     } else if (credit == '') {
        //         $('#balance_edit').val('0');
        //     } else {
        //         var balance = credit - debit;
        //         // alert(balance);
        //         $('#balance_edit').val(balance);
        //     }

        //     var motor_cash = $('#motor_cash_edit').val();
        //     var unload = $('#unload_edit').val();
        //     if (motor_cash == '') {
        //         $('#car_rent_redeem_edit').val('0');
        //     } else if (unload == '') {
        //         $('#car_rent_redeem_edit').val('0');
        //     } else {
        //         var car_rent_redeem = parseInt(motor_cash) + parseInt(unload);
        //         // alert(balance);
        //         $('#car_rent_redeem_edit').val(car_rent_redeem);
        //     }


        //     var car_rent_redeem = $('#car_rent_redeem_edit').val();
        //     var credit = $("#credit_edit").val();
        //     if (car_rent_redeem == '') {
        //         var total_paras = credit;
        //         $('#total_paras_edit').val(total_paras);
        //     } else {
        //         var total_paras = parseInt(car_rent_redeem) + parseInt(credit);
        //         $('#total_paras_edit').val(total_paras);
        //     }
        // });
        // //End calculation
        //Start calculation popup
        $(document).on('input change paste keyup', '.value-calc-popup', function() {

            ////////////////////////////////////////////////////////////////
            var kg_ton = $('#tons_popup').val();
            var paras = $('#paras_popup').val();
            if (kg_ton == '') {
                $('#credit_popup').val('0');
            } else if (paras == '') {
                $('#credit_popup').val('0');
            } else {
                var credit = kg_ton * paras;
                // alert(credit);
                $('#credit_popup').val(credit);
            }

            var fee = $("#fee_popup").val();
            var credit = $("#credit_popup").val();
            var fee = parseFloat(fee);
            if (fee == '') {
                $('#fee').val('0');
            } else {
                var credit_with_fee = parseFloat(credit) + fee;
                // alert(balance);
                $('#credit_popup').val(credit_with_fee);
            }

            var debit = $("#debit_popup").val();
            var credit = $("#credit_popup").val();
            if (debit == '') {
                $('#balance_popup').val('0');
            } else if (credit == '') {
                $('#balance_popup').val('0');
            } else {
                var balance = credit - debit;
                // alert(balance);
                $('#balance_popup').val(balance);
            }

            var motor_vara = $('#motor_vara_popup').val();
            var unload = $('#unload_popup').val();
            if (motor_vara == '') {
                $('#motor_vara_popup').attr("placeholder", "motor vara");
                //  $('#motor_vara').attr("value", "0");
                //  $('#motor_vara').val(0);

                $('#car_rent_redeem_popup').val(unload);
                $('#cemeats_paras_popup').val(unload);
            } else if (unload == '') {
                $('#unload_popup').attr("placeholder", "unload");
                //  $('#unload').attr("value", "0");
                //  $('#unload').val(0);

                $('#car_rent_redeem_popup').val(motor_vara);
                $('#cemeats_paras_popup').val(motor_vara);
            } else if (unload == 0 && motor_vara == 0) {
                $('#car_rent_redeem_popup').val(0);
            } else {


                //                 $('#motor_vara').focus(function(){
                //                     $('#motor_vara').value('')
                // });

                var car_rent_redeem = parseInt(motor_vara) + parseInt(unload);
                // alert(balance);
                $('#car_rent_redeem_popup').val(car_rent_redeem);
                $('#cemeats_paras_popup').val(car_rent_redeem);
            }





            var discountp = $("#discount_popup").val();
            var credit_with_dis = $("#credit_popup").val();
            var discountp2 = parseFloat(discountp);
            if (discountp == '') {
                $('#discountp').val('0');
            } else {
                var credit_with_dis = credit_with_dis - discountp2;
                // alert(balance);
                $('#credit_popup').val(credit_with_dis);
            }







            ///////////////////////////////////////////////////////////////////////////////////////
            //     // var kg = $('#kg_popup').val();
            //     // var paras = $('#paras_popup').val();
            //     // if (kg == '') {
            //     //     $('#credit_popup').val('0');
            //     // } else if (paras == '') {
            //     //     $('#credit_popup').val('0');
            //     // } else {
            //     //     var credit = kg * paras;
            //     //     // echo(kg);
            //     //     // echo(paras);
            //     //     // alert(credit);
            //     //     $('#credit_popup').val(credit);
            //     // }


            //     var discountp = $("#discount_popup").val();
            //     var creditp = $("#credit_popup").val();
            //     var discountp2 = parseFloat(discountp);
            //     if (discountp != '') {
            //          creditp = creditp - ((discountp2 / 100) * creditp);
            //         // alert(typeof(discountp2));
            //         $('#credit_popup').val(creditp.toFixed(2));

            //     }

            //     // var fee = parseFloat($("#fee_popup").val()) ;
            //     // if (fee != '') {
            //     //  creditp = parseInt(creditp) + parseInt(fee);
            //     //     $('#credit_popup').val(creditp);
            //     // }
            //     var debit = parseFloat($("#debit_popup").val()) ;
            //     var creditp = $("#credit_popup").val();
            //     if (debit == '') {
            //         $('#balance_popup').val('0');
            //     } else if (creditp == '') {
            //         $('#balance_popup').val('0');
            //     } else {
            //         var balance = creditp - debit;
            //         // alert(balance);
            //         $('#balance_popup').val(balance);
            //     }

            //     var motor_cash = $('#motor_vara_popup').val();
            //     var unload = $('#unload_popup').val();
            //     if (motor_cash == '') {
            //         $('#car_rent_redeem_popup').val('0');
            //     } else if (unload == '') {
            //         $('#car_rent_redeem_popup').val('0');
            //     } else {
            //         var car_rent_redeem = parseInt(motor_cash) + parseInt(unload);
            //         // alert(balance);
            //         $('#car_rent_redeem_popup').val(car_rent_redeem);
            //         $('#cemeats_paras_popup').val(car_rent_redeem);
            //     }


            // //     var car_rent_redeem = $('#car_rent_redeem_popup').val();
            // //     var credit = $("#credit_popup").val();
            // //     if (car_rent_redeem == '') {
            // //         var total_paras = credit;
            // //         $('#total_paras_popup').val(total_paras);
            // //     } else {
            // //         var total_paras = parseInt(car_rent_redeem) + parseInt(credit);
            // //         $('#total_paras_popup').val(total_paras);
            // //     }
        });
        //End calculation popup
    </script>
    <script type="text/javascript">
        function getDataByDates(datestr, dealerId) {
            $.ajax({
                url: '../ajaxcall/pathor_search_date_entry.php',
                type: 'post',
                data: {
                    optionDate: datestr,
                    dealerId: dealerId,
                },
                success: function(res) {
                    // alert(res);
                    $('#viewDetails').html(res);
                    $('.left_side_bar').height($('.main_bar').innerHeight());
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }


        function getSummaryByDates(datestr, dealerId) {
            $.ajax({
                url: '../ajaxcall/pathor_search_date_wise_summary_entry.php',
                type: 'post',
                data: {
                    optionDate: datestr,
                    dealerId: dealerId,
                },
                success: function(res) {
                    // alert(res);
                    $('#panel').html(res);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }


        $(document).on('change', '#dateSearchList', function() {
            var optionDate = $('#dateSearchList option:selected').val();
            var dealerId = $('#delear_id option:selected').val();
            // alert(dealerId);          
            getDataByDates(optionDate, dealerId);
            getSummaryByDates(optionDate, dealerId);
        });
    </script>
    <script>
        function datecheckformat(e) {
            //On Enter key Press

            var currentID = e.target.id;
            var dateStr = $('#' + currentID).val();
            // alert(e.target.id);            
            // alert(dateStr);
            if (e.which == 13) {
                // alert('You pressed enter!');            
                if (dateStr.length == 8) {
                    var day = dateStr.trim().substr(0, 2);
                    var month = dateStr.trim().substr(2, 2);
                    var year = dateStr.trim().substr(4, 4);
                    var formatedDate = day + '-' + month + '-' + year;
                    // alert(formatedDate);
                    $('#' + currentID).val(formatedDate);
                    $('#' + currentID).datepicker("setDate", new Date(year, month - 1, day));
                    console.log(formatedDate);
                } else {
                    alert('Date input dayMonthYear within 8 char.');
                }
            }

        }

        function datecheckformatpopup(e) {
            //On Enter key Press

            var currentID = e.target.id;
            var dateStr = $('#' + currentID).val();
            // alert(e.target.id);            
            // alert(dateStr);
            if (e.which == 13) {
                // alert('You pressed enter!');            
                if (dateStr.length == 8) {
                    var day = dateStr.trim().substr(0, 2);
                    var month = dateStr.trim().substr(2, 2);
                    var year = dateStr.trim().substr(4, 4);
                    var formatedDate = day + '-' + month + '-' + year;
                    // alert(formatedDate);
                    $('#' + currentID).val(formatedDate);
                    $('#' + currentID).datepicker("setDate", new Date(year, month - 1, day));
                    console.log(formatedDate);
                } else {
                    alert('Date input dayMonthYear within 8 char.');
                }
            }

        }
    </script>
    <script type="text/javascript">
        $(document).on('click', '#entry_scroll1', function() {
            $('#scrolling-entry-div').animate({
                scrollLeft: '1090'
            }, 1000, "swing");
            $(this).hide();
            $('#entry_scroll2').show();
            $('#entry_scroll3').hide();
        });
        $(document).on('click', '#entry_scroll2', function() {
            $('#scrolling-entry-div').animate({
                scrollLeft: '+=1110'
            }, 1000, "swing");
            $(this).hide();
            $('#entry_scroll1').hide();
            $('#entry_scroll3').show();
        });
        $(document).on('click', '#entry_scroll3', function() {
            $('#scrolling-entry-div').animate({
                scrollLeft: '0'
            }, 1000, "swing");
            $(this).hide();
            $('#entry_scroll1').show();
            $('#entry_scroll2').hide();
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '#gb_bank_ganti_td', function() {
            $('#gb_bank_ganti').show().focus();
        });

        $(document).on('mousedown', function(e) {
            console.log(e);
            console.log($(e.target).attr('id'));
            if ($(e.target).attr('id') == 'gb_bank_ganti') {

            } else {
                console.log('hide');
                $('#gb_bank_ganti').hide();
            }
        });


        function gbbank_update(id, gbvalue) {
            $.ajax({
                url: '../ajaxcall_save_update/pathor_gb_bank_update.php',
                type: 'post',
                data: {
                    details_id: id,
                    gbvalue: gbvalue,
                },
                success: function(res) {
                    $('#gbbank_stable_val').html(res);
                    alert('GB Bank Ganti Updated Successfully.');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }

        $(document).on('keypress', '#gb_bank_ganti', function(e) {
            if (e.which == 13) {
                var id = $(e.currentTarget).attr('data-id');
                var gbvalue = $('#gb_bank_ganti').val();
                // alert(id);
                gbbank_update(id, gbvalue);
                $('#gb_bank_ganti').hide();
            }
        });
    </script>
    <script type="text/javascript">
        $(document).on('change', '#particulars', function() {
            var value = $('#particulars option:selected').val().match(/\d+/);
            // alert(value);
            if (value == '04') {
                $('#mm').val('04.5 mm');
            } else if (value == '06') {
                $('#mm').val('06 mm');
            } else if (value == '08') {
                $('#mm').val('08 mm');
            } else if (value == '10') {
                $('#mm').val('10 mm');
            } else if (value == '12') {
                $('#mm').val('12 mm');
            } else if (value == '16') {
                $('#mm').val('16 mm');
            } else if (value == '20') {
                $('#mm').val('20 mm');
            } else if (value == '22') {
                $('#mm').val('22 mm');
            } else if (value == '25') {
                $('#mm').val('25 mm');
            } else if (value == '32') {
                $('#mm').val('32 mm');
            } else if (value == '42') {
                $('#mm').val('42 mm');
            } else {
                $('#mm').val('');
            }
        });
        $(document).on('change', '#particulars_edit', function() {
            var value = $('#particulars_edit option:selected').val().match(/\d+/);
            // alert(value);
            if (value == '04') {
                $('#mm_edit').val('04.5 mm');
            } else if (value == '06') {
                $('#mm_edit').val('06 mm');
            } else if (value == '08') {
                $('#mm_edit').val('08 mm');
            } else if (value == '10') {
                $('#mm_edit').val('10 mm');
            } else if (value == '12') {
                $('#mm_edit').val('12 mm');
            } else if (value == '16') {
                $('#mm_edit').val('16 mm');
            } else if (value == '20') {
                $('#mm_edit').val('20 mm');
            } else if (value == '22') {
                $('#mm_edit').val('22 mm');
            } else if (value == '25') {
                $('#mm_edit').val('25 mm');
            } else if (value == '32') {
                $('#mm_edit').val('32 mm');
            } else if (value == '42') {
                $('#mm_edit').val('42 mm');
            } else {
                $('#mm_edit').val('');
            }
        });
        $(document).on('change', '#particulars_popup', function() {
            var value = $('#particulars_popup option:selected').val().match(/\d+/); // alert(value);
            if (value == '04') {
                $('#mm_popup').val('04.5 mm');
            } else if (value == '06') {
                $('#mm_popup').val('06 mm');
            } else if (value == '08') {
                $('#mm_popup').val('08 mm');
            } else if (value == '10') {
                $('#mm_popup').val('10 mm');
            } else if (value == '12') {
                $('#mm_popup').val('12 mm');
            } else if (value == '16') {
                $('#mm_popup').val('16 mm');
            } else if (value == '20') {
                $('#mm_popup').val('20 mm');
            } else if (value == '22') {
                $('#mm_popup').val('22 mm');
            } else if (value == '25') {
                $('#mm_popup').val('25 mm');
            } else if (value == '32') {
                $('#mm_popup').val('32 mm');
            } else if (value == '42') {
                $('#mm_popup').val('42 mm');
            } else {
                $('#mm_popup').val('');
            }
        });
    </script>
    <script>
        function myFunction() {

            var header = document.getElementById('city_center_id');
            // var summary = document.getElementById('panel');
            var details = document.getElementById('detailsNewTable2');
            var wme = window.open("", "", "width=900,height=700, scrollbars=yes");



            wme.document.write('<style>td, th{border: 1px solid #868686; padding: 4px; }#detailsNewTable2{border-collapse: collapse;}.text-center{text-align: center; margin: 6px 0px;}.summary{border-collapse: collapse; margin-bottom: 20px;}.no_print_media{display: none !important;}.hastext{text-align: right;}</style>');

            wme.document.write(header.outerHTML);
            // wme.document.write(summary.outerHTML);
            wme.document.write(details.outerHTML);


            // var x = '<script type="text/javascript" ' + 'src="https://code.jquery.com/jquery-1.10.2.js">' +'<'+ '/script>';
            // wme.document.write(x);

            wme.document.close();
            wme.focus();
            wme.print();
            // wme.close();

        }
    </script>
    <script type="text/javascript">
        $('#delivery_date_popup').bind('keydown', function(e) {
            if (e.which == 13)
                e.stopImmediatePropagation();
        }).datepicker({
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd-mm-yy",
            changeYear: true,
        });


        $('#dates_popup').bind('keydown', function(e) {
            if (e.which == 13)
                e.stopImmediatePropagation();
        }).datepicker({
            onSelect: function(date) {
                // alert(date);
                $(this).change();
            },
            dateFormat: "dd-mm-yy",
            changeYear: true,
        });
    </script>
    <script type="text/javascript">
        $(document).on('click', '.edPermit', function(event) {
            event.preventDefault();
            ConfirmDialog('You have no permission edit/delete this data !');

            function ConfirmDialog(message) {
                $('<div></div>').appendTo('body')
                    .html('<div><h4>' + message + '</h4></div>')
                    .dialog({
                        modal: true,
                        title: 'Alert',
                        zIndex: 10000,
                        autoOpen: true,
                        width: '40%',
                        resizable: false,
                        position: {
                            my: "center",
                            at: "center center-20%",
                            of: window
                        },
                        buttons: {
                            Ok: function() {
                                $(this).dialog("close");
                            },
                            Cancel: function() {
                                $(this).dialog("close");
                            }
                        },
                        close: function(event, ui) {
                            $(this).remove();
                        }
                    });
            };
        });


        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8)) {
                Swal.fire("Should be enter a number value");
                // alert("Should be enter a number value");
                console.log("Workkkkk", evt);
                return false;
            }
            return true;
        }
    </script>
    <script type="text/javascript">
        $(document).on("click", ".kajol_close, .cancel", function() {
            $("#verifyPasswordModal").hide();
        });
    </script>
    <script src="../js/common_js.js"> </script>
</body>

</html>