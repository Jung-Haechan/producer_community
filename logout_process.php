<?php
  include 'db_connect.php';

  session_start();

  $_SESSION['islogin'] = NULL;
  $_SESSION['user_ID'] = NULL;
  header ("Location:index.php");
