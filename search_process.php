<?php
  session_start();
  $board = $_POST['board'];
  $arrange = $_POST['arrange']; 
  $value = $_POST['search']; 
  header("Location: board.php?board=".$board."&&".$arrange."=".$value);
?>
