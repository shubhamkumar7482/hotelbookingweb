<?php
include('../pages/connection.php');
include('../pages/essentials.php');
adminlogin();
?>


 <?php


    if (isset($_POST['get_users'])) {

        $res = selectAll('user_cred');
        $i = 1;
        $path = USERS_IMG_PATH;

        // $data = "";
        while ($row = mysqli_fetch_assoc($res)) {

            // delete button
            $del_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none'>
            <i class='bi bi-trash'></i> 
            </button>";

            // here we make a badge that user is verified or not
            $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";
            if ($row['is_varified']) {
                $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
                $del_btn = "";
            }

            // we make a active button
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none' >Active</button>";
            if (!$row['status']) {
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Inactive</button>";
            }

            // date and format
            $data = date("d-m-y", strtotime($row['datentime']));

            echo <<<data
                <tr>
                    <td>$i</td>
                    <td>
                    <img src='$path$row[profile]' style="width:40px; height:40px; border-radius: 50%;"> <br>
                    $row[name]
                    </td>
                    <td>$row[email]</td>
                    <td>$row[phonenum]</td>
                    <td>$row[address] | $row[pincode]</td>
                    <td>$row[dob]</td>
                    <td>$verified</td>
                    <td>$status</td>
                    <td>$data</td>
                    <td>$del_btn</td>                             
                </tr>

            data;
            $i++;
        }
    }


    if (isset($_POST['toggle_status'])) {
        $frm_data = filteration($_POST);

        $q = "UPDATE `user_cred` SET `status`=? WHERE `id`=?";
        $v = [$frm_data['value'], $frm_data['toggle_status']];
        if (update($q, $v, 'ii')) {
            echo 1;
        } else {
            echo 0;
        }
    }   

    if (isset($_POST['remove_user'])) {

        $frm_data = filteration($_POST);

        $res5 = delete("DELETE FROM  `user_cred` WHERE `id`=? AND `is_varified`=?", [$frm_data['user_id'],0], 'ii');

        if($res5){
            echo 1;
        }else{
            echo 0;
        }
        // echo 1; 
    }


    if (isset($_POST['search_user'])) {

        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `user_cred` WHERE `name` LIKE ?";

        $res = select($query,["%$frm_data[name]%"],'s');
        $i = 1;
        $path = USERS_IMG_PATH;

        // $data = "";
        while ($row = mysqli_fetch_assoc($res)) {

            // delete button
            $del_btn = "<button type='button' onclick='remove_user($row[id])' class='btn btn-danger shadow-none'>
            <i class='bi bi-trash'></i> 
            </button>";

            // here we make a badge that user is verified or not
            $verified = "<span class='badge bg-warning'><i class='bi bi-x-lg'></i></span>";
            if ($row['is_varified']) {
                $verified = "<span class='badge bg-success'><i class='bi bi-check-lg'></i></span>";
                $del_btn = "";
            }

            // we make a active button
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none' >Active</button>";
            if (!$row['status']) {
                $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-danger btn-sm shadow-none'>Inactive</button>";
            }

            // date and format
            $data = date("d-m-y", strtotime($row['datentime']));

            echo <<<data
                <tr>
                    <td>$i</td>
                    <td>
                    <img src='$path$row[profile]' style="width:40px; height:40px; border-radius: 50%;"> <br>
                    $row[name]
                    </td>
                    <td>$row[email]</td>
                    <td>$row[phonenum]</td>
                    <td>$row[address] | $row[pincode]</td>
                    <td>$row[dob]</td>
                    <td>$verified</td>
                    <td>$status</td>
                    <td>$data</td>
                    <td>$del_btn</td>                             
                </tr>

            data;
            $i++;
        }
    }


    ?>
    
   