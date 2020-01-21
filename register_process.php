<?php
  include 'db_connect.php';
  $sql = "INSERT INTO user(id, password, name, register_date) VALUE('{$_POST['new_ID']}','{$_POST['new_password']}','{$_POST['new_name']}',NOW())";
  $result = mysqli_query($conn, $sql);
  if($result){
    header('Location:'.$_POST['back']);
  }
  else {
    echo '<h2>오류 발생<h2>';
  }
?>
