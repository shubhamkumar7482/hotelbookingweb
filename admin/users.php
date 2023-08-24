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
    <title>Admin Pannel - Users</title>
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
                                <h4 class="card-title m-0">USERS</h4>
                                <input type="text" oninput="search_user(this.value)" name="" class="form-control shadow-none w-25 ms-auto " placeholder="Search Users" id="">
                            </div>
                        </div>
                        <!-- room info table  -->
                        <div class="table-responsive"  >
                            <table class="table table hover border text-center" style="min-width:1300px ">
                                <thead class="">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone no.</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Verified</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="users-data">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

   
    <?php include('pages/footer-links.php') ?>
    <script src="script/users.js" ></script>



</body>

</html>