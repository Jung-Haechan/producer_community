<?php
  include 'db_connect.php';
  session_start();
  $sql = "INSERT INTO posts (title, contents, author, board, created) VALUE ('{$_POST['title']}', '{$_POST['contents']}', '{$_SESSION['user_name']}', '{$_POST['board']}', NOW())";
  $result = mysqli_query($conn, $sql);
  if($result){
    header('Location:composer_board.php');
  }
  else {
    echo '<h2>오류 발생<h2>';
  }
 ?>
