<?php
require('pages/header.php');

require('pages/paytm/config_paytm.php');
require('pages/paytm/encdec_paytm.php'); 

date_default_timezone_set("Asia/Kolkata");



if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index .php');
}

if(isset($_POST['pay_now']))
{
    $ORDER_ID = 'ORD_'.$_SESSION['uId'].random_int(11111,9999999);
    $CUST_ID = $_SESSION['uId'];
    $INDUSTRY_TYPE_ID = INDUSTRY_TYPE_ID;
    // $CHANNEL_ID = $_POST["CHANNEL_ID"];
    $TXN_AMOUNT = $_SESSION['room']['payment'];

    
    // // Create an array having all required parameters for creating checksum.
    // $paramList = array();
    // $paramList["MID"] = PAYTM_MERCHANT_MID;
    // $paramList["ORDER_ID"] = $ORDER_ID;
    // $paramList["CUST_ID"] = $CUST_ID;
    // $paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
    // $paramList["CHANNEL_ID"] = $CHANNEL_ID;
    // $paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
    // $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

    // $paramList["CALLBACK_URL"] = CALLBACK_URL;

    // Insert data into data base

    $frm_data = filteration($_POST);

    $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`, `order_id`) VALUES (?,?,?,?,?)";
    insert($query1,[$CUST_ID,$_SESSION['room']['id'],$frm_data['checkin'],$frm_data['checkout'],$ORDER_ID],'issss');

    $booking_id = mysqli_insert_id($con);

    $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`, `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";
    insert($query2,[$booking_id,$_SESSION['room']['name'],$_SESSION['room']['price'],$TXN_AMOUNT,$frm_data['name'],$frm_data['number'],$frm_data['address']],'issssss');

    if($query1 && $query2)
    {
        redirect('confirm_booking.php');
    }

}
?>
