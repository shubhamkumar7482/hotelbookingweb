<?php include('pages/connection.php') ?>
<?php include('pages/essentials.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Pannel</title>
    <?php include('pages/header-links.php') ?>
</head>
<body>
 


<?php include('pages/header-links.php') ?>

<?php
 session_start();
 if((isset($_SESSION['adminlogin']) && $_SESSION['adminlogin'] == true))
 {
     redirect('dashboard.php');
     

 }
session_unset();
?>

<style>
    .login-form{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
    }
</style>
<div class="login-form text-center border rounded bg-white shadow overflor-hidden">
    <form method="POST">
        <h4 class="py-3" >ADMIN LOGIN PANNEL</h4>
        <div class="p-4 border">
            <div class="mb-3">
                <input type="text" name="name" required class="form-control shadow-none" aria-describedby="nameHelp" placeholder="USERNAME" >
            </div>
            <div class="mb-3">
                <input type="password" name="pass" required class="form-control shadow-none" aria-describedby="nameHelp" placeholder="UPASSWORD" >
            </div>
            <button type="submit" name="login" class="btn text-white cutom-color ">LOGIN</button>
        </div>
    </form>
</div>

<?php
if(isset($_POST['login']))
{
    $frm_data = filteration($_POST);

    $query = "SELECT * FROM `admin_user` WHERE `name`=? AND `pass`=? ";
    $values = [$frm_data['name'], $frm_data['pass']];
    // $datatypes = "ss";

    $res = select($query,$values,"ss");    
    // print_r($res);

    if($res->num_rows==1){
        $row = mysqli_fetch_assoc($res);       
        $_SESSION['adminlogin'] = true;
        $_SESSION['adminId'] = $row['id'];
        redirect('dashboard.php');
        session_unset();

    }else{
         alert('error','Login failed - invalid credentials!');                       
      
    }


    

}
   


?>



<?php include('pages/footer-links.php') ?>
   
</body>
</html>
