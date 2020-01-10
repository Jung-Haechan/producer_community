<?php
  include 'db_connect.php';
  session_start();
  $sql = "SELECT *FROM user WHERE id='{$_SESSION['user_ID']}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $user_name = $row['name'];

  $sql = "INSERT INTO posts (title, contents, author, board, created) VALUE ('{$_POST['title']}', '{$_POST['content']}', '$user_name', '{$_POST['board']}', NOW())";
  echo $sql;
  $result = mysqli_query($conn, $sql);
  if($result){
    header('Location:composer_board.php');
  }
  else {
    echo '<h2>오류 발생<h2>';
  }
 ?>
