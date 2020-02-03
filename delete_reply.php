<?php
  include 'db_connect.php';
  session_start();

  $sql = "DELETE FROM reply WHERE num=".$_POST['reply'];
  $result = mysqli_query($conn, $sql);
  $sql = "UPDATE posts SET replies=replies-1 WHERE num =".$_POST['post_num'];
  $result = mysqli_query($conn, $sql);
  if($result){
    $prev_page = $_SERVER['HTTP_REFERER'];
    header('Location:'.$prev_page);
  }
  else {
    echo '<h2>오류 발생<h2>';
  }
?>
