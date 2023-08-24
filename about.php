<?php include('pages/header.php') ?>


<h2 class="mt-5 pt-4 mb-4 text-center fw-bold header-font header-color">About us</h2>

<div class="container">
    <div class="row jsutify-content-between align-items-center">
        <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
            <h3>lorem ipsum dolor sit</h3>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Est explicabo, nesciunt alias iusto praesentium accusamus
                eaque quam, ut tempora, sapiente placeat molestiae sint illo
                commodi nisi at quia dolorem. Vero assumenda vel dicta inventore!
            </p>
        </div>
        <div class="col-lg-6 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
            <div class="about-img">
                <img src="image/banners/b-2.webp" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-primary text-center">
                <img src="image/features/r.png" alt="" class="w-25">
                <h4 class="mt-3">100+ ROOMS</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-primary text-center">
                <img src="image/features/r.png" alt="" class="w-25">
                <h4 class="mt-3">100+ ROOMS</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-primary text-center">
                <img src="image/features/r.png" alt="" class="w-25">
                <h4 class="mt-3">100+ ROOMS</h4>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-primary text-center">
                <img src="image/features/r.png" alt="" class="w-25">
                <h4 class="mt-3">100+ ROOMS</h4>
            </div>
        </div>
    </div>
</div>

<h2 class="mt-5 pt-4 mb-4 text-center fw-bold header-font header-color">OUR TEAM MEMBER</h2>
<div class="container px-4 my-4">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper pb-5">
            <?php
            $about_r = selectAll('team_details');
            $path = ABOUT_IMG_PATH;
            while ($row = mysqli_fetch_assoc($about_r)) {
                echo <<<data
                <div class="swiper-slide">
                <img src="$path$row[picture]" alt="" class="img-fluid">
                <h5 class="mt-2 text-center">$row[name]</h5>
                </div>
                data;
            }
            ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<?php include('pages/footer.php') ?>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 30,
        loop: true,
        autoplay: true,
        autoplaySpeed: 1000,
        pagination: {
            el: ".swiper-pagination",
        },
        breakpoints: {
            320: {
                loop: true,
                slidesPerView: 1,
            },
            640: {
                loop: true,
                slidesPerView: 1,
            },
            768: {
                loop: true,
                slidesPerView: 3,
            },
            1024: {
                loop: true,
                slidesPerView: 4,
            }

        }
    });
</script>

<?php include('pages/footer-links.php') ?>









<!-- 


<div class="swiper-slide">
                <img src="image/about/avatar-02.jpg" alt="">
            </div>
            <div class="swiper-slide">
                <img src="image/about/avatar-02.jpg" alt="">
            </div>
            <div class="swiper-slide">
                <img src="image/about/avatar-02.jpg" alt="">
            </div>
            <div class="swiper-slide">
                <img src="image/about/avatar-02.jpg" alt="">
            </div>
            <div class="swiper-slide">
                <img src="image/about/avatar-02.jpg" alt="">
            </div>
            <div class="swiper-slide">
                <img src="image/about/avatar-02.jpg" alt="">
            </div> -->