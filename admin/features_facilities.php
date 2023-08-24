<?php
include('pages/connection.php');
include('pages/essentials.php');
adminlogin();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel - features and facilities</title>
    <?php include('pages/header-links.php'); ?>
</head>

<body class="bg-light">

    <?php include('pages/header.php') ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto overflow-hidden p-1 mt-3">
                <h3 class="mt-3">Features And Facilities</h3>
                <!-- features section   -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="card-body">
                            <div class=" mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0">Features</h5>
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#features-s">
                                    <i class="bi bi-plus-square"></i> Add
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive-md" style="height: 350px; overflow-y:scroll;">
                            <table class="table table hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <!-- facilities section   -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="card-body">
                            <div class=" mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0">Facilities</h5>
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#facilities-s">
                                    <i class="bi bi-plus-square"></i> Add
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive-md" style="height: 350px; overflow-y:scroll;">
                            <table class="table table hover border">
                                <thead class="">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Discription</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--Features Modal -->
    <div class="modal fade" id="features-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="features_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Rooms Features Name</h1>
                        <button type="button" onclick="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="features_name" required class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn cutom-color text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--Facilities Modal -->
    <div class="modal fade" id="facilities-s" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facilities_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Rooms Facilities Name</h1>
                        <button type="button" onclick="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="facilities_name" required class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon</label>
                            <input type="file" name="facilities_icon" accept=".svg" class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="facilities_desc" id="" class="form-control contactdetail" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn cutom-color text-white shadow-none">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php include('pages/footer-links.php') ?>
    <script src="script/features_facilities.js"></script>




</body>

</html>