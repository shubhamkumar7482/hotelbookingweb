<?php
include('../admin/pages/connection.php');
include('../admin/pages/essentials.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email,$v_code)
{
   include('../PHPmailer/Exception.php');
   include('../PHPmailer/PHPMailer.php');
   include('../PHPmailer/SMTP.php');

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'shubhamkumar291291@gmail.com';                     //SMTP username
        $mail->Password   = 'eptbcjjbspcqaqsw';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        $mail->setFrom('shubhamkumar291291@gmail.com', 'Shubham kumar');
        $mail->addAddress($email);     //Add a recipient
      
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Email Verifiction form Indian Inn';
        $mail->Body    = "Thanks for registration!
        Click the link below to verify the email address
        <a href='http://localhost/HBWEBSITE/verify.php?email=$email&v_code=$v_code'> verify </a>";
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// if (isset($_POST['register'])) {
//     $data = filteration($_POST);



    // $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1", [$data['email']], 's');

    // if ($u_exist) {
    //     if (mysqli_num_rows($u_exist) > 0) {

    //         $result_fetch = mysqli_fetch_assoc($u_exist);
    //         if ($result_fetch['email'] == $data['email']) {
    //             // user image server
    //             $img = uploadUserImage($_FILES['profile']);

    //             if ($img == 'inv_img') {
    //                 echo 'inv_img';
    //                 exit;
    //             } else if ($img == 'upd_failed') {
    //                 echo 'upd_failed';
    //                 exit;
    //             } else {

    //                 $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);

    //                 $user_q = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `pass`) VALUES (?,?,?,?,?,?,?,?)";
    //                 $values = [$data['name'], $data['email'], $data['address'], $data['phonenum'], $data['number'], $data['dob'], $img, $enc_pass];

    //                 if (insert($user_q, $values, 'ssssisss')) {
    //                     echo 1;
    //                 } else {
    //                     echo 'ins_failed';
    //                 }
    //             }
    //         } else {
    //             echo 'inv_email';
    //             exit;
    //         }
    //     }
    // }
// }



if (isset($_POST['register'])) {
    $data = filteration($_POST);

    //check user exists or not 
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? LIMIT 1", [$data['email']], 's');

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_exist_fetch['email'] == $data['email']) {
            //  echo 'inv_email'; // already registered
            echo 1;
            exit;
        }
    }

    // user image server
    $img = uploadUserImage($_FILES['profile']);

    if ($img == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img == 'upd_failed') {
        // echo 'upd_failed';
        echo 2; // when image upload failed
        exit;
    }

    // sending the data into the database

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);
    $v_code =  bin2hex(random_bytes(16));

    $user_q = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `pass`, `v_code`) VALUES (?,?,?,?,?,?,?,?,?)";
    $values = [$data['name'], $data['email'], $data['address'], $data['phonenum'], $data['number'], $data['dob'], $img, $enc_pass, $v_code];

    if (insert($user_q, $values, 'ssssissss') && sendMail($data['email'],$v_code)) {
        echo 3;// successfull query run
    } else {
        echo 4;// echo 'ins_failed';
    }
}


if (isset($_POST['login'])) {
    $data = filteration($_POST);

    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=?  LIMIT 1", [$data['email_mob']], 's');

    if (mysqli_num_rows($u_exist) > 0) {

        $result_fetch = mysqli_fetch_assoc($u_exist);
        if($result_fetch['is_varified'] == 1){
            if (password_verify($_POST['pass'],$result_fetch['pass'])) {
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['uId'] = $result_fetch['id'];
                $_SESSION['uName'] = $result_fetch['name'];
                $_SESSION['uPic'] = $result_fetch['profile'];
                $_SESSION['uPhone'] = $result_fetch['phonenum'];
                echo 1;
                exit;
            } else {
                echo 2; // incorect password
            }
        }else{
            echo 4; // email not verified
        }
       
    } else {
        echo 3; // email not registered
    }
    // $_SESSION['login'] = true;
    // $_SESSION['uId'] = $u_fetch['id'];
    // $_SESSION['uName'] = $u_fetch['name'];
    // $_SESSION['uPic'] = $u_fetch['picture'];
    // $_SESSION['uPhone'] = $u_fetch['phonenum'];
    // echo 1;


}
