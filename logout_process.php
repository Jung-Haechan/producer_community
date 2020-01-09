<?php
  include 'db_connect.php';

  session_start();

  $_SESSION['islogin'] = 0;
  $_SESSION['user_ID'] = NULL;
  header ("Location:index.php");
