<?php
  include 'db_connect.php';
  session_start();

  $sql = "DELETE FROM reply WHERE num=".$_POST['reply'];
  $result = mysqli_query($conn, $sql);
  if($result){
    echo "<script>history.go(-1);</script>";
  }
  else {
    echo '<h2>오류 발생<h2>';
  }
?>
