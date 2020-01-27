<?php
  include 'db_connect.php';

  session_start();

  $sql = "SELECT *FROM user WHERE id='{$_POST['ID']}'&&password='{$_POST['password']}'";
  $result = mysqli_query($conn, $sql);
  $is_member = mysqli_num_rows($result);

  if($is_member>=1) {
    $_SESSION['islogin'] = 1;
    $_SESSION['user_ID'] = $_POST['ID'];
    header("Location:index.php");
  } else {
    echo "<script>alert('로그인에 실패했습니다.'); location.href='login.php';</script>";
  }
 ?>
