<?php include('admin/pages/connection.php') ?>

<?php

if(isset($_GET['email']) && isset($_GET['v_code']))
{
    $data = filteration($_GET);

    $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `v_code`=?", [$data['email'], $data['v_code']], 'ss');


    if($query)
    {
        if(mysqli_num_rows($query) == 1)
        {
            $result_fetch = mysqli_fetch_assoc($query);
            if($result_fetch['is_varified'] == 0)
            {
                $update = update("UPDATE `user_cred` SET `is_varified`=? WHERE `email`=? ",[1,$data['email']],'ss');               

                if($update)
                {
                    ?><script>
                        alert('Email verification successfull!');
                        window.location.href = 'index.php';
                    </script><?php               
                    
                }else{
                    ?><script>alert('cannot run query');</script><?php
                }

            }else{
                ?><script>
                    alert('Email already verified!');
                    window.location.href = 'index.php';
                </script><?php
            }
        }

    }else{
        alert('error','cannot run query');
    }

}
?>
