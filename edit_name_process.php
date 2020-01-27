<?php
  include 'db_connect.php';
  $sql = "SELECT name, password FROM user WHERE name ='".$_POST['user_name']."'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  if ($row['password']===$_POST['password']) {
      $sql = "UPDATE user SET name = '{$_POST['name']}', password = '{$_POST['new_password']}' WHERE name='{$_POST['user_name']}'";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE posts SET author = '{$_POST['name']}' WHERE author ='{$_POST['user_name']}'";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE reply SET author = '{$_POST['name']}' WHERE author ='{$_POST['user_name']}'";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE mail SET sender = '{$_POST['name']}' WHERE sender ='{$_POST['user_name']}'";
      $result = mysqli_query($conn, $sql);
      $sql = "UPDATE mail SET reciever = '{$_POST['name']}' WHERE reciever ='{$_POST['user_name']}'";
      $result = mysqli_query($conn, $sql);
      if($result){
        header('Location:index.php');
      }
      else {
        echo '<h2>오류 발생<h2>';
      }
    }
    else {
      echo "<script>alert('비밀번호가 잘못되었습니다.'); location.href='mypage.php';</script>";
    }


?>
