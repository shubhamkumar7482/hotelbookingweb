<?php include('pages/header.php') ?>


<section class=" bi-light" id="">
    <?php 
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q,$values,'i'));
    // print_r($contact_r);
    ?>
    <div class="container bg-light py-4">
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-12 mx-auto">
                <div class="contactinfo">
                    <div class="mb-4 text-start">
                        <h5 class="m-0 text-white contact-2">Contact Details</h5>
                    </div>
                    <div class="">
                        <h4><i class="bi bi-geo-alt-fill"></i> Address</h4>
                        <p><?= $contact_r['address']?></p>
                    </div>
                    <div class="">
                        <h4><i class="bi bi-phone-fill"></i> Mobile No.</h4>
                        <p class="mb-0" > <a class="text-decoration-none text-white " href="tel: +<?= $contact_r['pn1'] ?>">+<?= $contact_r['pn1'] ?></a></p>
                        <?php 
                        if($contact_r['pn2'] != '')
                        {
                            echo <<<data
                            <p> <a class="text-decoration-none text-white" href="tel: +$contact_r[pn2]">+$contact_r[pn2]</a></p>
                            data;
                        }
                        ?>
                    </div>
                    <div class="">
                        <h4><i class="bi bi-envelope-fill"></i> Email</h4>
                        <p><a class="text-decoration-none text-white" href="mailto: shubhamkumar291291@gmail.com"><?= $contact_r['email'] ?></a></p>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-12 col-12 mx-auto">
                <div class="contactform">
                    <form method="POST">
                        <div class="row">
                            <h5 class="mb-2" style="color:#0641a0;">Contact Us for More Details </h5>
                            <div class="col-lg-6 col-md-12 mb-3 mx-auto">
                                <input type="text" class="form-control contactdetail me-2" placeholder="Enter Name" name="name" >
                            </div>
                            <div class="col-lg-6 col-md-12 mb-3 mx-auto">
                                <input type="number" class="form-control contactdetail ms-1" placeholder="Enter mobile No." name="number" >
                            </div>
                            <div class="col-12 mb-3">
                                <input type="email" class="form-control contactdetail " placeholder="Enter Email" name="email" >
                            </div>
                            <div class="col-12 mb-3">
                                <input type="text" class="form-control contactdetail" placeholder="Enter Address" name="address">
                            </div>
                            <div class="col-12 mb-3">
                                <textarea name="message" id="" class="form-control contactdetail" placeholder="Enter your message"></textarea>
                            </div>
                            <button type="submit" name="send" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container my-4 m">
    <div class="row">
        <div class="col-12">
            <iframe src="<?= $contact_r['iframe'] ?>" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>
<?php
if(isset($_POST['send']))
{
    $frm_data = filteration($_POST);

    $q = "INSERT INTO `user_queries`( `name`, `number`, `email`, `address`, `message`) VALUES (?,?,?,?,?)";
    $values = [$frm_data['name'],$frm_data['number'],$frm_data['email'],$frm_data['address'],$frm_data['message']];

    $res = insert($q,$values,'sssss');

    if($res == 1)
    {
       alert('success','Your query sent successfully');
    }
    else{
        alert('error','Your query sent successfully');

    }

}


?>

<?php include('pages/footer.php') ?>
<?php include('pages/footer-links.php') ?>