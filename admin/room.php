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
    <title>Admin Pannel - Room</title>
    <?php include('pages/header-links.php'); ?>
</head>

<body class="bg-light">

    <?php include('pages/header.php') ?>
    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto overflow-hidden p-1 mt-3">
                <!--room section   -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="card-body">
                            <div class=" mb-2 d-flex align-items-center justify-content-between">
                                <h4 class="card-title m-0">ROOMS</h4>
                                <button type="button" class="btn btn-dark shadow-none" data-bs-toggle="modal" data-bs-target="#add-rooms-m">
                                    <i class="bi bi-plus-square"></i> Add
                                </button>
                            </div>
                        </div>
                        <!-- room info table  -->
                        <div class="table-responsive-lg" style="height: 500px; overflow-y:scroll;">
                            <table class="table table hover border text-center">
                                <thead class="">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Guests</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="rooms-data">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <!--add room Modal -->
    <div class="modal fade" id="add-rooms-m" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Room</h1>
                        <button type="button" onclick="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Area</label>
                                <input type="number" min="1" name="area" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" min="1" name="price" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" min="1" name="quantity" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Adult(Max.)</label>
                                <input type="number" min="1" name="adult" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Children(Max.)</label>
                                <input type="number" min="1" name="children" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo <<<data
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="features" value="$opt[id]" class="form-check-input shadow-none" >
                                                $opt[name]
                                            </label>
                                        </div>
                                        data;
                                    }

                                    ?>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo <<<data
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="facilities" value="$opt[id]" class="form-check-input shadow-none" >
                                                $opt[name]
                                            </label>
                                        </div>
                                        data;
                                    }

                                    ?>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="desc" class="form-control shadow-none" required rows="4"></textarea>
                            </div>
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

    <!--Edit room Modal -->
    <div class="modal fade" id="edit-room" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Room</h1>
                        <button type="button" onclick="" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Area</label>
                                <input type="number" min="1" name="area" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" min="1" name="price" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" min="1" name="quantity" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Adult(Max.)</label>
                                <input type="number" min="1" name="adult" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Children(Max.)</label>
                                <input type="number" min="1" name="children" required class="form-control shadow-none" aria-describedby="nameHelp">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo <<<data
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="features" value="$opt[id]" class="form-check-input shadow-none" >
                                                $opt[name]
                                            </label>
                                        </div>
                                        data;
                                    }

                                    ?>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo <<<data
                                        <div class="col-md-3">
                                            <label>
                                                <input type="checkbox" name="facilities" value="$opt[id]" class="form-check-input shadow-none" >
                                                $opt[name]
                                            </label>
                                        </div>
                                        data;
                                    }

                                    ?>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="desc" class="form-control shadow-none" required rows="4"></textarea>
                            </div>
                            <input type="hidden" name="room_id">
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

    <!-- manage room images modal  -->
    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="room_name">Room name</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom pb-3 mb-3">
                        <form id="add_image_form">
                            <label for="from-label fw-bold">Add image</label>
                            <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none">
                            <button type="submit" class="btn cutom-color text-white shadow-none mt-3">ADD</button>
                            <input type="hidden" name="room_id">
                        </form>
                    </div>

                    <div class="table-responsive-lg" style="height:380px; overflow-y:scroll;">
                        <table class="table table hover border text-center ">
                            <thead class="">
                                <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" widht="60%">Image</th>
                                    <th scope="col">Thumb</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="rooms-image-data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('pages/footer-links.php') ?>
    <script src="script/room.js" ></script>



</body>

</html>