<?php
  include 'db_connect.php';
  session_start();
  $board = $_POST['board'];
  $sql = "INSERT INTO posts (title, contents, file, file_type, author, board, created) VALUES ('{$_POST['title']}', '{$_POST['contents']}', '" .time()."@@@".$_FILES['file']['name']. "', '{$_FILES['file']['type']}' , '{$_SESSION['user_name']}', '{$_POST['board']}', NOW())";
  $result = mysqli_query($conn, $sql);
  if($result){
    $saving_dir = '.\\'.$board.'_file.\\'.time()."@@@".$_FILES['file']['name'];
    $tmp_dir = $_FILES['file']['tmp_name'];
    move_uploaded_file($tmp_dir, $saving_dir);
    header('Location:board.php?board='.$board);
  }
  else {
    echo '<h2>오류 발생<h2>';
  }
   ?>
