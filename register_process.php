<?php
  include 'db_connect.php';
  $sql = "SELECT * FROM user WHERE id ='".$_POST['new_ID']."'";
  $result = mysqli_query($conn, $sql);
  $is_exist_id = mysqli_num_rows($result);
  $sql = "SELECT * FROM user WHERE name ='".$_POST['new_name']."'";
  $result = mysqli_query($conn, $sql);
  $is_exist_name = mysqli_num_rows($result);
  if($is_exist_id>0&&$is_exist_name>0) {
    echo "<script>alert('아이디와 이름이 중복되었습니다.'); location.href='register.php';</script>";
  }
  else if($is_exist_id>0&&$is_exist_name==0) {
    echo "<script>alert('아이디가 중복되었습니다.'); location.href='register.php';</script>";
  }
  else if($is_exist_id==0&&$is_exist_name>0) {
    echo "<script>alert('이름이 중복되었습니다.'); location.href='register.php';</script>";
  }
  else {
    $sql = "INSERT INTO user(id, password, name, register_date) VALUE('{$_POST['new_ID']}','{$_POST['new_password']}','{$_POST['new_name']}',NOW())";
    $result = mysqli_query($conn, $sql);
    if($result){
      header('Location:index.php');
    }
    else {
      echo '<h2>오류 발생<h2>';
    }
  }

?>
