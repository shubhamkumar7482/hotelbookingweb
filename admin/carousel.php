<?php
include('pages/essentials.php');
adminlogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel - Settings</title>
    <?php include('pages/header-links.php'); ?>
</head>

<body class="bg-light">

    <?php include('pages/header.php') ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto overflow-hidden p-4">
                <h3>Carousel</h3>
                <!-- carousel section   -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class=" mb-4 d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Carousel Images</h5>
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#carousel-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="row" id="carousel-data">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--Carousel Modal -->
    <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="carousel_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Management team Settings</h1>
                        <button type="button" onclick="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">picture</label>
                            <input type="file" name="carousel_picture" id="carousel_picture_inp" accept=".jpg, .png, .webp, .jpeg" required class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="carousel_picture_inp.value=''" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn cutom-color text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <?php include('pages/footer-links.php') ?>
    <script src="script/carousel.js" ></script>
    

</body>

</html>
