<?php
  include 'db_connect.php';
  session_start();
  if($_FILES['file']['type']==='audio/mp3'
   ||$_FILES['file']['type']==='audio/wav'
   ||$_FILES['file']['type']==='audio/wma'
   ||$_FILES['file']['type']==='audio/aac') {
     $sql = "UPDATE posts SET title='{$_POST['title']}', contents='{$_POST['contents']}', file='".time()."@@@".$_FILES['file']['name']."' WHERE num=".$_GET['post_num'];
     $result = mysqli_query($conn, $sql);
     if($result){
       $saving_dir = '.\composer_file\\'.time()."@@@".$_FILES['file']['name'];
       $tmp_dir = $_FILES['file']['tmp_name'];
       move_uploaded_file($tmp_dir, $saving_dir);
       header('Location:composer_board.php');
     }
     else {
       echo '<h2>오류 발생<h2>';
     }
   } else {
     echo '<script> alert("오디오 파일을 올려주세요."); history.go(-1); </script>';
   }


 ?>
