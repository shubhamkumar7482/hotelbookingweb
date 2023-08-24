<nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 header-font header-color  " href="index.php">SK HOTEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active me-2" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="about.php">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Contact us</a>
                    </li>
                    
                </ul>
                <form class="d-flex" role="search">
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal"
                        data-bs-target="#LoginModal">
                        Login
                    </button>
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal"
                        data-bs-target="#register">
                        Register
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Modal -->
    <div class="modal fade" id="LoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex  align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>
                            User Login
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="text" class="form-control shadow-none" aria-describedby="nameHelp">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control shadow-none" aria-describedby="emailHelp">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none cutom-color">Login</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot
                                password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex  align-items-center">
                            <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                            User Register
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill text-bg-light text-dark mb-3 text-wrap  lh-base">
                            Note: Your details must your ID(Adhaar Card, Passport, Driving license ect.)
                            That will be required during check-in.
                        </span>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none" aria-describedby="nameHelp">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label ">Email</label>
                                    <input type="email" class="form-control shadow-none" aria-describedby="nameHelp">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Phone no.</label>
                                    <input type="number" class="form-control shadow-none" aria-describedby="nameHelp">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label ">Picture</label>
                                    <input type="file" class="form-control shadow-none" aria-describedby="nameHelp">
                                </div>
                                <div class="col-md-12 p-0 mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                                    <textarea class="form-control shadow-none" rows="1"></textarea>
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Pin Code</label>
                                    <input type="number" class="form-control shadow-none" aria-describedby="nameHelp">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label ">Date of birth</label>
                                    <input type="date" class="form-control shadow-none" aria-describedby="nameHelp">
                                </div>
                                <div class="col-md-6 ps-0 mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none" aria-describedby="nameHelp">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label class="form-label ">Conform Password</label>
                                    <input type="password" class="form-control shadow-none" aria-describedby="nameHelp">
                                </div>

                            </div>
                        </div>
                        <div class="text-center my-1">
                            <button type="submit" class="btn btn-dark shadow-none cutom-color">Register</button>
                        </div>

                        <!-- <div class="mb-3">
                            <label  class="form-label">Email address</label>
                            <input type="text" class="form-control shadow-none"   aria-describedby="nameHelp">
                        </div>
                        <div class="mb-4">   
                            <label  class="form-label">Email address</label>
                            <input type="email" class="form-control shadow-none"  aria-describedby="emailHelp">
                        </div>
                       <div class="d-flex align-items-center justify-content-between mb-2">
                       <button type="submit" class="btn btn-dark shadow-none">Login</button>
                        <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot password?</a>
                       </div> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
