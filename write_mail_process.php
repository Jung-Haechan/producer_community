<?php
  include 'db_connect.php';
  session_start();

  $sql = "SELECT name FROM user WHERE name = '{$_POST['reciever']}'";
  $result = mysqli_query($conn, $sql);
  $is_member = mysqli_num_rows($result);

  if($is_member>=1) {
    $sql = "INSERT INTO mail ( sender, reciever, contents, `time`) VALUES ( '{$_SESSION['user_name']}', '{$_POST['reciever']}', '{$_POST['contents']}', NOW())";
    $result = mysqli_query($conn, $sql);
    if($result){
      header('Location:'.$_POST['back']);
    }
    else {
      echo '<h2>오류 발생<h2>';
    }
  } else {
    echo '<script>alert("받는 사람이 존재하지 않습니다.");location.href="write_mail.php";</script>';
  }


   ?>
