<?php
session_start();
if (!(isset($_SESSION['adminlogin']) && $_SESSION['adminlogin'] == true)) {
    echo "<script>        
        window.location.href='index.php';
    </script>";
    exit;
}

?>