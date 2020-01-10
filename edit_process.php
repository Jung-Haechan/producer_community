<?php
  include 'db_connect.php';
  session_start();
  $sql = "UPDATE posts SET title='{$_POST['title']}', contents='{$_POST['contents']}', created=NOW() WHERE num=".$_GET['post_num'];
  echo $sql;
  $result = mysqli_query($conn, $sql);
  if($result){
    header('Location:composer_board.php');
  }
  else {
    echo '<h2>오류 발생<h2>';
  }
 ?>
