<?php
  include 'db_connect.php';

  session_start();

  $sql = "SELECT *FROM user WHERE id='{$_POST['ID']}'&&password='{$_POST['password']}'";
  $result = mysqli_query($conn, $sql);
  $is_member = mysqli_num_rows($result);

  if($is_member===1) {
    $_SESSION['islogin'] = 1;
    $_SESSION['user_ID'] = $_POST['ID'];
    header ("Location:index.php");
  } else {
    header("Location:login.php");
    $_SESSION['islogin'] = -1;
  }
 ?>
