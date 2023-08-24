<?php include('pages/header.php') ?>



<?php
if (!isset($_GET['id'])) {
    redirect('room.php');
}
$data = filteration($_GET);

$room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

if (mysqli_num_rows($room_res) == 0) {
    redirect('room.php');
}

$room_data = mysqli_fetch_assoc($room_res);




?>


<h2 class="mt-5 pt-4 mb-4 text-center fw-bold header-font header-color">OUR ROOMS</h2>

<div class="container">
    <div class="row">
        <div class="col-12 my-3 px-4">
            <h2 class="fw-bold  header-font  header-color"><?php echo $room_data['name'] ?></h2>
            <div style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary"> > </span>
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
            </div>
        </div>

        <div class="col-lg-7 col-md-12 px-4 mb-4">
            <div class="corousel">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        // get thubnail of image 

                        $room_img = ROOMS_IMG_PATH . "thumbnail.webp";
                        $img_q = mysqli_query($con, "SELECT * FROM `room_banner` WHERE `room_id`='$room_data[id]'");

                        if (mysqli_num_rows($img_q) > 0) {

                            $active_class = 'active';
                            while ($img_res = mysqli_fetch_assoc($img_q)) {
                                echo "
                                 <div class='carousel-item $active_class'>
                                   <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100 rounded'>
                                 </div>
                                ";
                                $active_class = '';
                            }
                        } else {
                            echo "<div class='carousel-item active'>
                            <img src='$room_img' class='d-block w-100'>
                        </div>";
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-md-12 px-4">
            <div class="card mb-4 shadow-none rounded-3">
                <div class="card-body">
                    <?php
                    echo <<<price
                    <h4> ₹ $room_data[price] per night </h4>
                    price;
                    echo <<<rating
                        <span class="mb-4">
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    rating;

                    // get features data 
                    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");

                    $features_data = "";
                    while ($fea_row = mysqli_fetch_assoc($fea_q)) {

                        $features_data .= " <span class='badge rounded-pill text-bg-light text-dark text-wrap  lh-base'>
                    $fea_row[name]
                    </span>";
                    }
                    echo <<<features
                    <div class="features mb-2 mt-3">
                     <h6>Features</h6>
                     $features_data
                    </div>

                    features;

                    // get facilities data               
                    $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f INNER JOIN `rooms_fecilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

                    $facilities_data = "";
                    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                        $facilities_data .= "<span class='badge rounded-pill text-bg-light text-dark text-wrap  lh-base me-1 mb-1'>
                        $fac_row[name]
                        </span>";
                    }
                    echo <<<facilities
                    <h6>Facilities</h6>
                    <div class="facilities mb-2">
                     $facilities_data
                    </div>
                    facilities;

                    echo <<<guest
                    <div class="guest mb-2">
                        <h6>Guest</h6>
                    <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                    $room_data[adult] Adult </span>
                    <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                    $room_data[children] Children
                    </span>
                    </div>
                    guest;

                    echo <<<facilities
                    <h6>Area</h6>
                    <div class="facilities mb-2">
                    <span class='badge rounded-pill text-bg-light text-dark text-wrap  lh-base me-1 mb-1'>
                        $room_data[area] sq. ft.
                        </span>
                    </div>
                    facilities;

                    // booking button shutdwon mode active setting 

                    if (!$settings_r['shutdown']) {
                        $login = 0;
                        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {

                            $login = 1;
                        }
                        echo <<<book
                        <button onclick='checkLoginToBooking($login,$room_data[id])' class='w-100 btn btn-sm text-white shadow-none cutom-color mb-2'>Book Now</button>
                        book;
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-12 px-4 mt-4 mb-3">
            <div class="mb-4">
                <h5>Description</h5>
            </div>
            <P>
                <?php echo $room_data['discription']  ?>
            </P>

            <div class="">
                <h5>Description</h5>
                <div class="profile">
                    <h6>Random name</h6>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    dolores quia, earum illum consequatur molestiae magni.
                    Eum corrupti eligendi animi.</p>
                <div class="rating">
                    <i class="bi bi-star-fill text-warning me-1"></i>
                    <i class="bi bi-star-fill text-warning me-1"></i>
                    <i class="bi bi-star-fill text-warning me-1"></i>
                    <i class="bi bi-star-fill text-warning"></i>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('pages/footer.php') ?>
<?php include('pages/footer-links.php') ?>