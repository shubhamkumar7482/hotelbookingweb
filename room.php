<?php include('pages/header.php') ?>
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold header-font header-color">OUR ROOMS</h2>

<div class="container-fluid">
    <div class="row mx-3">
        <div class="col-lg-3 col-md-12 mb-2">
            <nav class="navbar navbar-expand-lg  navbar-light bg-white rounded shadow">
                <div class="container-fluid flex-lg-column ">
                    <h4 class="mt-2">FILTERS</h4>
                    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse flex-column align-items-stretch" id="filterDropdown">
                        <div class="border bg-light p-3 rounded mb-3">
                            <h5 class="mb-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                            <label class="form-label">Check-in</label>
                            <input type="date" class="form-control shadow-none mb-3" aria-describedby="nameHelp">
                            <label class="form-label">Check-out</label>
                            <input type="date" class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                        <div class="border bg-light p-3 rounded mb-3 ">
                            <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                            <div class="mb-2">
                                <input type="checkbox" id="1" class="form-check-input shadow-none mb-3" aria-describedby="nameHelp">
                                <label for="1" class="form-label">Facilities one</label>
                            </div>
                            <div class="mb-2">
                                <input type="checkbox" id="2" class="form-check-input shadow-none mb-3" aria-describedby="nameHelp">
                                <label for="2" class="form-label">Facilities two</label>
                            </div>
                            <div class="mb-2">
                                <input type="checkbox" id="3" class="form-check-input shadow-none mb-3" aria-describedby="nameHelp">
                                <label for="3" class="form-label">Facilities three</label>
                            </div>
                        </div>
                        <div class="border bg-light p-3 rounded mb-3 ">
                            <h5 class="mb-3" style="font-size: 18px;">GUEST</h5>
                            <div class="d-flex">
                                <div class="mb-2 me-2">
                                    <label class="form-label">Adult</label>
                                    <input type="number" id="1" class="form-control shadow-none mb-3" aria-describedby="nameHelp">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Children</label>
                                    <input type="number" id="1" class="form-control shadow-none mb-3" aria-describedby="nameHelp">
                                </div>
                            </div>
                        </div>
                    </div>
            </nav>
        </div>

        <div class="col-lg-9 col-md-12 px-2">
            <?php
            $room = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');
            while ($room_data = mysqli_fetch_assoc(($room))) {
                // get features data 
                $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");

                $features_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {

                    $features_data .= " <span class='badge rounded-pill text-bg-light text-dark text-wrap  lh-base'>
                            $fea_row[name]
                        </span>";
                }

                // get facilities data               
                $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f INNER JOIN `rooms_fecilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

                $facilities_data = "";
                while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $facilities_data .= "<span class='badge rounded-pill text-bg-light text-dark text-wrap  lh-base'>
                    $fac_row[name]
                    </span>";
                    
                }

                // get thubnail of image 

                $room_thumb = ROOMS_IMG_PATH . "thumbnail.webp";
                $thumb_q = mysqli_query($con, "SELECT * FROM `room_banner` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }

                // booking button shutdwon mode active setting
                $book_btn = "";
                if(!$settings_r['shutdown']){
                     $login = 0;
                    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                        
                        $login = 1;
                    }
                    $book_btn = "<button onclick='checkLoginToBooking($login,$room_data[id])' class='w-100 btn btn-sm text-white shadow-none cutom-color mb-2'>Book Now</button>";
                }

                // print room card 

                echo <<<data
                <div class="card mb-4 border-0 shadow">
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 pe-lg-2 pe-md-2 px-0 ">
                            <img src="$room_thumb" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0">
                            <h5 class="mb-1">$room_data[name]</h5>
                            <div class="features mb-2">
                                <h6>Features</h6>
                                $features_data
                            </div>
                            <div class="facilities mb-2">
                                $facilities_data
                            </div>
                            <div class="guest mb-2">
                                <h6>Guest</h6>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                    $room_data[adult] Adult
                                </span>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                    $room_data[children] Children
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 text-align-center">
                            <h5 class="mb-4">₹ $room_data[price] per inght</h5>
                            $book_btn
                            <a href="room_details.php?id=$room_data[id]" class="w-100 btn btn-sm btn-outline-dark shadow-none ">View More</a>
                        </div>
                    </div>
                </div>
                data;
            }

            ?>
            <!-- 
            <div class="card mb-4 border-0 shadow">
                <div class="row g-0 p-3 align-items-center">
                    <div class="col-md-5 pe-lg-2 pe-md-2 px-0 ">
                        <img src="image/banners/9.webp" class="img-fluid rounded">
                    </div>
                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                        <h5 class="mb-1">simple room name</h5>
                        <div class="features mb-2">
                            <h6>Features</h6>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                2 Bathroom
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                2 Baclcony
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                2 Sofa
                            </span>
                        </div>
                        <div class="facilities mb-2">
                            <h6>Facilities</h6>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                Wifi
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                Television
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                Ac
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                Rooms heater
                            </span>
                        </div>
                        <div class="facilities mb-2">
                            <h6>Guest</h6>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                4 Adult
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                2 children
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2 text-align-center">
                        <h5 class="mb-4">₹200 per/inght</h5>
                        <a href="#" class="w-100 btn btn-sm text-white shadow-none cutom-color mb-2">Book Now</a>
                        <a href="#" class="w-100 btn btn-sm btn-outline-dark shadow-none ">View More</a>
                    </div>
                </div>
            </div>
             -->
        </div>
    </div>
</div>










<?php include('pages/footer.php') ?>
<?php include('pages/footer-links.php') ?>