<?php
    include 'db_connect.php';
    session_start();
    if(!isset($_SESSION['islogin'])) {
      echo "<script>alert('댓글 권한이 없습니다.'); history.go(-1);</script>";
    } else {
      $sql = "INSERT INTO reply (post_num, author, contents, created) VALUE ('{$_POST['post_num']}', '{$_SESSION['user_name']}', '{$_POST['reply']}', NOW())";
      $result = mysqli_query($conn, $sql);
      if($result){
        $prev_page = $_SERVER['HTTP_REFERER'];
        header('Location:'.$prev_page);
       }
       else {
         echo '<h2>오류 발생<h2>';
       }
  }


 ?>
