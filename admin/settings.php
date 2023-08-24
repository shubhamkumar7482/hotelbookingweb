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
                <h3>SETTINGS</h3>
                <!-- general settings section   -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class=" mb-4 d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">General Setting</h5>
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-2 mb-1 fw-bold">Email</h6>
                        <p class="card-text" id="site_email"></p>
                        <h6 class="card-subtitle mb-2 mb-1 fw-bold">Mobile no.</h6>
                        <p class="card-text" id="site_no"></p>
                        <h6 class="card-subtitle mb-2 mb-1 fw-bold">Address</h6>
                        <p class="card-text" id="site_address"></p>

                    </div>
                </div>

                <!-- shutdown section   -->
                <div class="card  border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class=" mb-4 d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="upd_shutdown(this.value)" type="checkbox" class="form-check-input" id="shutdown-toggle">
                                </form>
                            </div>

                        </div>
                        <p class="card-text">
                            No custormers will be allowed to book hotel room, when shutdown mode is turned on.
                        </p>

                    </div>
                </div>

                <!-- contact us details section   -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class=" mb-4 d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Contact Setting</h5>
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#contacts-s">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 mb-1 fw-bold">Address</h6>
                                    <p class="card-text">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        <span id="address"></span>
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 mb-1 fw-bold">Phone Number</h6>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="pn1"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="pn2"></span>
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 mb-1 fw-bold">Email</h6>
                                    <p class="card-text">
                                        <i class="bi bi-envelope-fill"></i>
                                        <span id="email"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 mb-1 fw-bold">Social media links :</h6>
                                    <p class="card-text">
                                        <i class="bi bi-linkedin"></i>
                                        <span id="lkd"></span>
                                    </p>

                                    <p class="card-text">
                                        <i class="bi bi-github"></i>
                                        <span id="gth"></span>
                                    </p>

                                    <p class="card-text">
                                        <i class="bi bi-instagram"></i>
                                        <span id="insta"></span>
                                    </p>

                                    <p class="card-text">
                                        <i<i class="bi bi-facebook"></i>
                                            <span id="fb"></span>
                                    </p>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-2 mb-1 fw-bold">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Management team section   -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class=" mb-4 d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0">Management team Setting</h5>
                            <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#team-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="row" id="team-data">

                        </div>
                    </div>
                </div>

                <div class="row" id="team-data">
                    
                </div>
            </div>
        </div>

    </div>



    <!--General settings Modal -->
    <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="general_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">General Settings</h1>
                        <button type="button" onclick="site_email.value = general_data.site_email, site_no.value = general_data.site_no, site_address.value = general_data.site_address" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="site_email" id="site_email_inp" required class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mobile No.</label>
                            <input type="text" name="site_no" id="site_no_inp" required class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                        <div class="col-md-12 p-0 mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                            <textarea name="site_address" id="site_address_inp" required class="form-control shadow-none" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="site_email.value = general_data.site_email, site_no.value = general_data.site_no, site_address.value = general_data.site_address" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn cutom-color text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--contacts details Modal -->
    <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="contacts_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Contact Details</h1>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid p-0 ">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" id="address_inp" required class="form-control shadow-none">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label ">Phone number (with country code) </label>
                                        <div class="input-group mb-3 pt-2">
                                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                            <input type="number" name="pn1" required id="pn1_inp" class="form-control shadow-none" aria-label="Username">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                            <input type="number" name="pn2" required id="pn2_inp" class="form-control shadow-none" aria-label="Username">
                                        </div>

                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" id="email_inp" required class="form-control shadow-none">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Social media links</label>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text"><i class="bi bi-linkedin"></i></span>
                                            <input type="text" name="ldk" required id="lkd_inp" class="form-control shadow-none" aria-label="Username">
                                        </div>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text"><i class="bi bi-github"></i></span>
                                            <input type="text" name="gth" required id="gth_inp" class="form-control shadow-none" aria-label="Username">
                                        </div>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                            <input type="text" name="insta" required id="insta_inp" class="form-control shadow-none" aria-label="Username">
                                        </div>
                                        <div class="input-group mb-2">
                                            <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                            <input type="text" name="fb" required id="fb_inp" class="form-control shadow-none" aria-label="Username">
                                        </div>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label">Google Map</label>
                                        <input type="text" name="gmap" id="gmap_inp" required class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">iFrame src</label>
                            <input type="text" name="iframe" id="iframe_inp" required class="form-control shadow-none">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="contacts_inp(contacts_data)" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn cutom-color text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Management team settings Modal -->
    <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="team_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Management team Settings</h1>
                        <button type="button" onclick="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="member_name" id="member_name_inp" required class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">picture</label>
                            <input type="file" name="member_picture" id="member_picture_inp" accept=".jpg, .png, .webp, .jpeg" required class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="member_name.value='',member_picture.value=''" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn cutom-color text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <?php include('pages/footer-links.php') ?>
    <script src="script/setting.js" ></script>
    

</body>

</html>