<?php include('pages/header.php') ?>

<h2 class="mt-5 pt-4 mb-4 text-center fw-bold header-font header-color">OUR Facilities</h2>

<div class="container my-4">
    <div class="row g-3 ">
        <?php
        $res = selectAll('facilities');
        $path = FACILITIES_IMG_PATH;

        while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 mx-auto">
                <div class="about-services shadow  " id="box-1">
                    <div class="service-box">
                        <div class="icon-1 mx-auto border text-center">
                        <img src="$path$row[icon]" class="mx-auto w-25" style="margin:auto;">
                        </div>
                        <h5 class="text-center my-2">$row[name]</h5>
                        <p>
                            $row[description];
                        </p>
                    </div>
                    <div class="overplay"></div>
                </div>
            </div>
            data;
        }
        ?>

        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 mx-auto">
            <div class="about-services shadow" id="box-2">
                <div class="service-box">
                    <div class="icon-2 mx-auto border">
                        <i class="bi bi-person-fill-gear" style="margin:auto;"></i>
                    </div>
                    <h5 class="text-center my-2">Cleaning Staff</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Ducimus fugiat impedit perferendis vero totam,
                        quis, accusantium cupiditate sit quidem labore blanditiis ullam eum?

                    </p>
                </div>
                <div class="overplay-1"></div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 mx-auto">
            <div class="about-services shadow" id="box-3">
                <div class="service-box">
                    <div class="icon-3 mx-auto border">
                        <i class="bi bi-person-fill-gear" style="margin:auto;"></i>
                    </div>
                    <h5 class="text-center my-2">Cleaning Staff</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Ducimus fugiat impedit perferendis vero totam,
                        quis, accusantium cupiditate sit quidem labore blanditiis ullam eum?

                    </p>
                </div>
                <div class="overplay-2"></div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 mx-auto">
            <div class="about-services shadow" id="box-4">
                <div class="service-box">
                    <div class="icon-4 mx-auto border">
                        <i class="bi bi-person-fill-gear" style="margin:auto;"></i>
                    </div>
                    <h5 class="text-center my-2">Cleaning Staff</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Ducimus fugiat impedit perferendis vero totam,
                        quis, accusantium cupiditate sit quidem labore blanditiis ullam eum?

                    </p>
                </div>
                <div class="overplay-3"></div>
            </div>
        </div>
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 mx-auto">
            <div class="about-services shadow" id="box-5">
                <div class="service-box">
                    <div class="icon-5 mx-auto border">
                        <i class="bi bi-person-fill-gear" style="margin:auto;"></i>
                    </div>
                    <h5 class="text-center my-2">Cleaning Staff</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Ducimus fugiat impedit perferendis vero totam,
                        quis, accusantium cupiditate sit quidem labore blanditiis ullam eum?

                    </p>
                </div>
                <div class="overplay-4"></div>

            </div>
        </div>
        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-12 mx-auto">
            <div class="about-services shadow" id="box-6">
                <div class="service-box">
                    <div class="icon-6 mx-auto border">
                        <i class="bi bi-person-fill-gear" style="margin:auto;"></i>
                    </div>
                    <h5 class="text-center my-2">Cleaning Staff</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Ducimus fugiat impedit perferendis vero totam,
                        quis, accusantium cupiditate sit quidem labore blanditiis ullam eum?

                    </p>
                </div>
                <div class="overplay-5"></div>

            </div>
        </div>

    </div>
</div>


<?php include('pages/footer.php') ?>
<?php include('pages/footer-links.php') ?>