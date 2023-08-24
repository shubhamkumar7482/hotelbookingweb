<?php include('pages/header.php') ?>
<style>
    #paynow {
        background-color: #0943A0;
    }

    #paynow:hover {
        background-color: #044cc1;
    }
</style>


<?php

/* 
check room id form url is present or not
Shutdown mode is active or not
User is logged in or not

*/




if (!isset($_GET['id']) || $settings_r['shutdown'] == true) {
    redirect('room.php');
} else if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('room.php');
}

// filter and get room and user data

$data = filteration($_GET);

$room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

if (mysqli_num_rows($room_res) == 0) {
    redirect('room.php');
}

$room_data = mysqli_fetch_assoc($room_res);

$_SESSION['room'] = [
    "id" => $room_data['id'],
    "name" => $room_data['name'],
    "price" => $room_data['price'],
    "payment" => null,
    "available" => false,
];

// print_r($_SESSION['room']);

$user_res = select("SELECT * FROM `user_cred` WHERE `id`=?  LIMIT 1", [$_SESSION['uId']], 'i');
$user_data = mysqli_fetch_assoc($user_res);

?>


<h2 class="mt-5 pt-4 mb-4 text-center fw-bold header-font header-color">CONFIRM BOOKING</h2>

<div class="container">
    <div class="row">
        <div class="col-12 my-3 px-4">
            <h2 class="fw-bold  header-font  header-color">CONFIRM BOOKING</h2>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary"> > </span>
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary"> > </span>
                <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 px-4 mb-4">
            <?php
            // get thubnail of image 

            $room_thumb = ROOMS_IMG_PATH . "thumbnail.webp";
            $thumb_q = mysqli_query($con, "SELECT * FROM `room_banner` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

            if (mysqli_num_rows($thumb_q) > 0) {
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
            }

            echo <<<data
            <div class="card p-3 shadow-none rounded">
            <img src="$room_thumb" class="img-fluid rounded mb-3">
            <h5>$room_data[name]</h5>
            <h6>₹$room_data[price] per night</h6>

            </div>
            data;

            ?>

        </div>



        <div class="col-lg-5 col-md-12 px-4">
            <div class="card mb-4 shadow-none rounded-3">
                <div class="card-body">
                    <form action="pay_now.php" id="booking_form" method="post" >
                        <h6>Booking Details</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="<?php echo $user_data['name'] ?>" required class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone no.</label>
                                <input type="text" name="number" value="<?php echo $user_data['phonenum'] ?>" required class="form-control shadow-none">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="1"><?php echo $user_data['address'] ?></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Check-in</label>
                                <input type="date" onchange="check_availability()" name="checkin" required class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Check-out</label>
                                <input type="date" onchange="check_availability()" name="checkout" required class="form-control shadow-none">
                            </div>
                            <div class="col-12">

                                <div class="spinner-border text-info d-none" id="info_loader" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>

                                <h6 class="text-danger" id="pay_info">Provide check-in & check-our date</h6>

                                <button name="pay_now" class="btn w-100 text-white shadow-nonw custom-color " id="paynow"> PAY NOW </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>


<?php include('pages/footer.php') ?>
<?php include('pages/footer-links.php') ?>

<script>
    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');

    function check_availability() {

        let checkin_val = booking_form.elements['checkin'].value;
        let checkout_val = booking_form.elements['checkout'].value;

        booking_form.elements['pay_now'].setAttribute('disabled', true);

        if (checkin_val != '' && checkout_val != '') {

           pay_info.classList.add('d-none'); 
           pay_info.classList.replace('text-dark','text-danger'); 
           info_loader.classList.remove('d-none'); 

            let data = new FormData();

            data.append('check_availability', '');
            data.append('check_in', checkin_val);
            data.append('check_out', checkout_val);

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/confirm_booking.php", true);

            xhr.onload = function() {
                // console.log(this.responseText);
                let data = JSON.parse(this.responseText);

                if(data.status == 'check_in_out_equal'){
                    pay_info.innerText = "You cannot check-out on the same day!";
                }else if(data.status == 'check_out_earlier'){
                    pay_info.innerText = "Check-out date is earlier then check-in date!";
                }else if(data.status == 'check_in_earlier'){
                    pay_info.innerText = "Check-in date is earlier then today's date!";
                }else if(data.status == 'unavailable'){
                    pay_info.innerText = "Room not available for the check-in date!";
                }else{
                    pay_info.innerText = "No. of Days: "+data.days+"\n Total Amount to Pay: ₹"+data.payment;
                    pay_info.classList.replace('text-danger','text-dark');
                    booking_form.elements['pay_now'].removeAttribute('disabled');
                }
                

                pay_info.classList.remove('d-none');
                info_loader.classList.add('d-none');

            }


            xhr.send(data);
        }

    }
</script>