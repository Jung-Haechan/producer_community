<?php
  include 'db_connect.php';
  session_start();
  $sql = "INSERT INTO reply (post_num, author, contents, created) VALUE ('{$_POST['post_num']}', '{$_SESSION['user_name']}', '{$_POST['reply']}', NOW())";
  $result = mysqli_query($conn, $sql);
  if($result){
     header('Location:composer_board.php?post_num='.$_POST['post_num']);
   }
   else {
     echo '<h2>오류 발생<h2>';
   }

 ?>
