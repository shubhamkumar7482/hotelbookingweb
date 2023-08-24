<?php include('pages/header.php') ?>

<style>
    .availability-form {
        margin-top: -190px;
        z-index: 2;
        position: relative;
    }

    @media screen and (max-width:575px) {
        .availability-form {
            margin-top: 25px;
            padding: 0 35px;
        }
    }
</style>

<!-- header carousel  -->
<section class="banner">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>


        <div class="carousel-inner">
            <?php
            $res = selectAll('carousel');
            while ($row = mysqli_fetch_assoc($res)) {
                $path = CAROUSEL_IMG_PATH;
                echo <<<data
                <div class="carousel-item main-h-banner active data-bs-interval="2000"">
                <img src="$path$row[image]" class="img-fluid" />
                <div class="carousel-caption d-none d-md-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-11 col-11 mx-auto">
                                <div class="welcome-demo">
                                    <h5>Welcome&nbsp;to&nbsp;SK HOTEL </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            data;
            }
            ?>
            <!-- <div class="carousel-item ">
                   <img src="image/carousel/b-4.png" class="w-100" />
                <div class="carousel-caption d-none d-md-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-11 col-11 mx-auto">
                                <div class="welcome-demo">
                                    <h5>Welcome&nbsp;to&nbsp;SkyCity </h5>
                                    <a href="room.php" class="btn btn-danger m-4 ">EXPLORE ROOM</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- carousel  -->
<!-- <div class="container-fluid p-0 " >
    <div class="swiper mySwiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="image/carousel/b-4.png" class="w-100" />
            </div>
            <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
            </div>
            <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
            </div>
            <div class="swiper-slide">
                <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
            </div>
        </div>
    </div>
</div> -->

<!-- check availability form  -->
<!-- <div class="container availability-form position-relative">
    <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
            <h5 class="header-color">Check Booking Availability</h5>
            <form action="">
                <div class="row align-items-end">
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Check-in</label>
                        <input type="date" class="form-control shadow-none" aria-describedby="nameHelp">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Check-out</label>
                        <input type="date" class="form-control shadow-none" aria-describedby="nameHelp">
                    </div>
                    <div class="col-lg-3 mb-3">
                        <label class="form-label" style="font-weight: 500;">Adult</label>
                        <select class="form-select shadow-none form-control">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <label class="form-label" style="font-weight: 500;">Adult</label>
                        <select class="form-select shadow-none form-control">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-lg-1 mb-lg-3 mt-2">
                        <button type="submit" class="btn  text-white shadow-none cutom-color">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->

<!-- Our rooms  -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold header-font header-color">Our Room</h2>
<div class="container">
    <div class="row">
        <?php
        $room = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3", [1, 0], 'ii');
        while ($room_data = mysqli_fetch_assoc(($room))) {
            // get features data 
            $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");

            $features_data = "";
            while ($fea_row = mysqli_fetch_assoc($fea_q)) {

                $features_data .= " 
                <span class='badge rounded-pill text-bg-light text-dark text-wrap  lh-base'>
                   $fea_row[name]
                </span>
                ";
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
                    $book_btn = "<button onclick='checkLoginToBooking($login,$room_data[id])' class='btn btn-sm text-white shadow-none cutom-color'>Book Now</button>";
                }


            // print room card 

            echo <<<data
                    <div class="col-lg-4 col-md-6">
                    <div class="card" style="max-width: 350px; margin:auto;">
                        <img src="$room_thumb" class="card-img-top">
                        <div class="card-body">
                            <h5 class="">$room_data[name]</h5>
                            <h6 class="mb-4"> ₹ $room_data[price] per night</h6>
                            <div class="features mb-4">
                                <h6>Features</h6>
                                $features_data
                            </div>
                            <div class="facilities mb-4">
                                <h6>Facilities</h6>
                                $facilities_data
                            </div>
                            <div class="facilities mb-4">
                                <h6>Guest</h6>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                $room_data[adult] Adult
                                </span>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                                $room_data[children] Children
                                </span>
                            </div>
                            <div class="rating">
                                <h6>Rating</h6>
                                <span class="badge rounded-pill bg-light">
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                </span>
                            </div>
                            <div class="d-flex justify-content-evenly mb-2 mt-3 text-center">
                            $book_btn
                            <a href="room_details.php?id=$room_data[id]" class="btn btn-sm btn-outline-dark shadow-none ">View More</a>
                            </div>
                        </div>
                    </div>
                </div>              
                data;
        }

        ?>
<!--        
        <div class="col-lg-4 col-md-6">
            <div class="card" style="max-width: 350px; margin:auto;">
                <img src="image/rooms/2.webp" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="">Simple Room Name</h5>
                    <h6 class="mb-4"> ₹200 per night</h6>
                    <div class="features mb-4">
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
                    <div class="facilities mb-4">
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
                    <div class="facilities mb-4">
                        <h6>Guest</h6>
                        <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                            4 Adult
                        </span>
                        <span class="badge rounded-pill text-bg-light text-dark text-wrap  lh-base">
                            2 children
                        </span>
                    </div>
                    <div class="rating">
                        <h6>Rating</h6>
                        <span class="badge rounded-pill bg-light">
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </span>
                    </div>
                    <div class="d-flex justify-content-evenly mb-2 mt-3 text-center">
                        <a href="#" class="btn btn-sm text-white shadow-none cutom-color">Book Now</a>
                        <a href="#" class="btn btn-sm btn-outline-dark shadow-none ">View More</a>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="col-lg-12 text-center mt-5">
            <a href="room.php" class="btn btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
        </div>


    </div>
</div>

<!-- this is body banner  -->
<section class="captions mt-4">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-9 col-10 mx-auto">
                <div class="content-ul p-5">
                    <h4> The best place to enjoy your vacation!</h4>
                    <p>
                        Kick back and relax in this calm, stylish space. Located steps from the beach and Long Beach
                        harbor, this magnificent property is perfectly located for all the quaint nooks and crannies
                        of Long Beach.

                    </p>
                </div>
            </div>
            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-12 mx-auto">
                <!-- <div class="lu-banner">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner ">
                              <div class="carousel-item active image-lu overflow-hidden">
                                <img src="image/about/b-3.webp" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item image-lu overflow-hidden">
                                <img src="image/about/b-3.webp" class="d-block w-100" alt="...">
                              </div> 
                               <div class="carousel-item">
                                <img src="..." class="d-block w-100" alt="...">
                              </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="visually-hidden">Next</span>
                            </button>
                          </div>
    
                    </div> -->
            </div>
        </div>
    </div>
</section>

<!-- our testimonials  -->
<section class="bg-light pb-4 ">
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold header-font header-color">TESTIMONIALS</h2>
    <div class="container">
        <div class="swiper mySwiper-testimonials">
            <div class="swiper-wrapper pb-5">
                <div class="swiper-slide bg- p-4">
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

                <div class="swiper-slide bg- p-4">
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

                <div class="swiper-slide bg- p-4">
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
                <div class="swiper-slide bg- p-4">
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
                <div class="swiper-slide bg- p-4">
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
            <div class="swiper-pagination mt-5"></div>
        </div>
    </div>
</section>


<!-- terms and condition list  -->
<section class="icons py-4">
    <dvi class="container">
        <div class="row m-0 p-0 text-center">
            <div class="col-xxl-3 col-col-xl-3 col-lg-3 col-md-3 col-7 mx-auto">
                <div class="animation bg-light">
                    <lottie-player src="https://assets8.lottiefiles.com/packages/lf20_nxwo0iua.json" background="transparent" speed="1" style="width: 90px; height: 90px;" loop autoplay>
                    </lottie-player>
                </div>
                <h5 style="color:#0943A0;">Best Service Support</h5>
            </div>

            <div class="col-xxl-3 col-col-xl-3 col-lg-3 col-md-3 col-7 mx-auto">
                <div class="animation bg-light">
                    <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_qo07xg45.json" background="transparent" speed="1" style="width: 90px; height: 90px;" loop autoplay>
                    </lottie-player>
                </div>
                <h5 style="color:#0943A0;">Quick support system</h5>
            </div>
            <div class="col-xxl-3 col-col-xl-3 col-lg-3 col-md-3 col-7 mx-auto">
                <div class="animation bg-light">
                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_yzoqyyqf.json" background="transparent" speed="1" style="width: 90px; height: 90px;" loop autoplay>
                    </lottie-player>
                </div>
                <h5 style="color:#0943A0;">Secure Payment Way</h5>
            </div>

            <div class="col-xxl-3 col-col-xl-3 col-lg-3 col-md-3 col-7 mx-auto">
                <div class="animation bg-light">
                    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_bEwDo1.json" background="transparent" speed="1" style="width: 90px; height: 90px;" loop autoplay>
                    </lottie-player>
                </div>
                <h5 style="color:#0943A0;">Instant Money Return Policy</h5>
            </div>
        </div>
    </dvi>
</section>
<?php include('pages/footer.php') ?>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<!-- lottiefiles script  -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


<!-- header Swiper -->
<script>
    var swiper = new Swiper(".mySwiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteration: false,
        }

    });
</script>

<!-- testimonials swiper  -->
<script>
    var swiper = new Swiper(".mySwiper-testimonials", {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        slidesPerView: "3",
        loop: true,
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: false,
        },
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                loop: true,
            },
            640: {
                slidesPerView: 1,
                loop: true,
            },
            768: {
                slidesPerView: 2,
                loop: true,
            },
            1024: {
                slidesPerView: 3,
                loop: true,
            },
            1440: {
                slidesPerView: 3,
                loop: true,
            },

        }
    });
</script>

<?php include('pages/footer-links.php') ?>