<?php
  include 'db_connect.php';
  session_start();

  $sql = "DELETE FROM posts WHERE num=".$_POST['post_num'];
  $result = mysqli_query($conn, $sql);
  if($result){
    header("Location:board.php?board=".$_POST['board']);
  }
  else {
    echo '<h2>오류 발생<h2>';
  }
?>
