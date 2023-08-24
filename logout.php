<?php
 include('admin/pages/essentials.php');

 session_start();
 session_destroy();
 redirect('index.php');

?>