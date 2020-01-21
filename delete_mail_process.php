<?php
  include 'db_connect.php';
  session_start();
  $delete_mail_num = $_POST['mail_num'];
  if($_POST['mailbox']==='recieved'){
    for($i=0;$i<count($delete_mail_num);$i++) {
      $sql = "UPDATE mail SET reciever_del = 'o' WHERE num = ".$delete_mail_num[$i];
      $result = mysqli_query($conn, $sql);
    }
  } elseif ($_POST['mailbox']==='sent') {
    for($i=0;$i<count($delete_mail_num);$i++) {
      $sql = "UPDATE mail SET sender_del = 'o' WHERE num = ".$delete_mail_num[$i];
      $result = mysqli_query($conn, $sql);
    }
  }
  if($result){
      header("Location:mailbox.php?mailbox=".$_POST['mailbox']);
  }
  else {
      echo '<h2>오류 발생<h2>';
  }

?>
