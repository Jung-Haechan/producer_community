<?php
  include 'db_connect.php';

  session_start();

  $_SESSION['islogin'] = NULL;
  $_SESSION['user_ID'] = NULL;
  $_SESSION['user_name'] = NULL;
  $prev_page = $_SERVER['HTTP_REFERER'];
  header('Location:'.$prev_page);
?>
