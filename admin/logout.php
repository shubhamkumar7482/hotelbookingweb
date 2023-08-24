<?php
 include('pages/essentials.php');

 session_start();
 session_destroy();
 redirect('index.php');

?>