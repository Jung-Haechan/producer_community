<?php
  include 'db_connect.php';
  session_start();
  $board = $_POST['board'];
  $sql = "UPDATE posts SET title='{$_POST['title']}', contents='{$_POST['contents']}', file='".time()."@@@".$_FILES['file']['name']."', file_type='{$_FILES['file']['type']}' WHERE num=".$_GET['post_num'];
  $result = mysqli_query($conn, $sql);
  if($result){
    $saving_dir = '.\\'.$board.'_file.\\'.time()."@@@".$_FILES['file']['name'];
    $tmp_dir = $_FILES['file']['tmp_name'];
    move_uploaded_file($tmp_dir, $saving_dir);
    header('Location:board.php?board='.$board.'&&post_num='.$_GET['post_num']);
  }
  else {
    echo '<h2>';
  }
 ?>
