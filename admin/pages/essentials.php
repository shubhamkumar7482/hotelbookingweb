<?php
// frontend purpose data
define('SITE_URL','http://127.0.0.1/HBWEBSITE/');
define('ABOUT_IMG_PATH',SITE_URL.'image/about/');
define('CAROUSEL_IMG_PATH',SITE_URL.'image/carousel/');
define('FACILITIES_IMG_PATH',SITE_URL.'image/facilities/');
define('ROOMS_IMG_PATH',SITE_URL.'image/rooms/');
define('USERS_IMG_PATH',SITE_URL.'image/users/');

// backend upload process need this data
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/HBWEBSITE/image/');
define('ABOUT_FOLDER','about/');
define('CAROUSEL_FOLDER','carousel/');
define('FACILITIES_FOLDER','facilities/');
define('ROOMS_FOLDER','rooms/');
define('USERS_FOLDER','users/');

// function for checking user login or not 
function adminlogin()
{
   session_start();
    if (!(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin'] == true)) {
        echo "<script>        
            window.location.href='index.php';
        </script>";
        exit;
    }
}
session_unset();

// function for page redirect 
function redirect($url)
{
    echo "<script>        
         window.location.href='$url';
        </script>";
    exit;
}

// alert message function 
function alert($type, $smg)
{
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";

    echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
             <strong class="me-3">$smg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    alert;
}

function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg','image/jpg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // invalid immage mime or format
    
    }
    elseif(($image['size']/(1024 * 1024))>2)
    {
        return 'inv_size'; // invalid size greater than 2mb
    }
     else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_'.random_int(11111, 99999).".$ext";

        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if (move_uploaded_file($image['tmp_name'],$img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }
    }
}

function deleteImage($image,$folder)
{
    if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
        return true;
    }else{
        return false;
    }
}

function uploadSVGImage($image, $folder)
{
    $valid_mime = ['image/svg+xml'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // invalid immage mime or format
    
    }
    elseif(($image['size']/(1024 * 1024))>1)
    {
        return 'inv_size'; // invalid size greater than 1mb
    }
     else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_'.random_int(11111, 99999).".$ext";

        $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
        if (move_uploaded_file($image['tmp_name'],$img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }
    }
}

function uploadUserImage($image)
{
    $valid_mime = ['image/jpeg','image/jpg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img'; // invalid immage mime or format
    
    }
    else 
    {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'IMG_'.random_int(11111, 99999).".jpeg";

        $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;

        if($ext == 'png' || $ext == 'PNG'){
            $img =imagecreatefrompng($image['tmp_name']);
        }elseif($ext == 'webp' || $ext == 'WEBP'){
            $img = imagecreatefromwebp($image['tmp_name']);
        }else{
            $img = imagecreatefromjpeg($image['tmp_name']);
        }

        if(imagejpeg($img,$img_path,75)){
            return $rname;
        }else{
            return 'upd_failed';
        }

    }

}




















// $u_fetch = mysqli_fetch_assoc($u_exist);
//          if($u_fetch['is_verified'] == 0){
//             echo 'not_varified';
//          }else if($u_fetch['status'] == 0){
//             echo 'inactive';
//          }else{
//             if(!password_verify($data['pass'],$u_fetch['password'])){
//                 echo 'invalid_pass';
//             }else{
//                 $_SESSION['login'] = true;
//                 $_SESSION['uId'] = $u_fetch['id'];
//                 $_SESSION['uName'] = $u_fetch['name'];
//                 $_SESSION['uPic'] = $u_fetch['picture'];
//                 $_SESSION['uPhone'] = $u_fetch['phonenum'];
//                 echo 1;
//             }
//          } 