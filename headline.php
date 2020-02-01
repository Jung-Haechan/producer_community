<?php
  include 'db_connect.php';
  session_start();
  include 'php_object.php';
?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="ucf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css?ver=1">
    <link rel="icon" href="images/icon.ico">
    <title> Playwithsong </title>
    <script src="jquery.js"></script>
  </head>

  <body>

    <div class="container">

      <header>
        <div id="nav_open">></div>
        <h1><a href="index.php">노래랑놀래</a></h1>
        <nav>
          <ul class="main_nav">
            <li class="main_li"><a href="introduce.php">커뮤니티소개</a></li>
            <li class="main_li"><a href="index.php">게시판</a>
              <ul class="nav_detail">
                <li><a href="board.php?board=composer_board">작곡게시판</a></li>
                <li><a href="board.php?board=lyricist_board">작사게시판</a>
                <li><a href="board.php?board=performer_board">보컬/악기게시판</a></li>
                <li><a href="board.php?board=free_board">자유게시판</a></li>
                <li><a href="board.php?board=completed_board">완성작게시판</a></li>
              </ul>
            </li>
            <li class="main_li"><a href="hall_of_fame.php">명예의전당</a></li>
            <li class="main_li"><a href="q_and_a.php">Q&A</a></li>
            <li class="main_li"><a href="mypage.php">마이페이지</a>
              <ul class="nav_detail">
                <li><a href="mypage.php">내정보</a></li>
                <li><a href="mailbox.php?mailbox=recieved">받은쪽지함</a></li>
                <li><a href="mailbox.php?mailbox=sent">보낸쪽지함</a></li>
                <li><a href="write_mail.php">쪽지쓰기</a></li>
              </ul>
            </li>
          </ul>
        </nav>

<?php
  $uri = $_SERVER['PHP_SELF'];

  if(isset($_SESSION['islogin'])) {
    $sql = "SELECT *FROM user WHERE id='{$_SESSION['user_ID']}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_name'] = $row['name'];
    $you = $_SESSION['user_name'];

    $host = $_SERVER['HTTP_HOST'];
    $parameter = $_SERVER['QUERY_STRING'];

    echo'
        <div class="login_register">
          <div id="name">'
          .$_SESSION['user_name'].
          '님</div>
          <form action="logout_process.php" method="post" id="logout_init">
            <input type="hidden" name="back" value="'.$_SERVER['REQUEST_URI'].'">
            <input type="submit" name="logout_init" value="로그아웃">
          </form>
        </div>';
  } else { echo'
        <div class="login_register">
          <form action="login.php" method="post" id="login_init">
            <input type="hidden" name="back" value="'.$_SERVER['REQUEST_URI'].'">
            <input type="submit" value="로그인">
          </form>
          <form action="register.php" method="post" id="register_init">
            <input type="hidden" name="back" value="'.$_SERVER['REQUEST_URI'].'">
            <input type="submit" value="회원가입">
          </form>
        </div>' ;
  }
?>
<dic class="layer">
  <div id="nav_close"><</div>
  <nav>
    <ul class="main_nav">
      <li class="main_li"><a href="introduce.php">커뮤니티소개</a></li>
      <li class="main_li"><a href="index.php">게시판</a>
        <ul class="nav_detail">
          <li><a href="board.php?board=composer_board">작곡게시판</a></li>
          <li><a href="board.php?board=lyricist_board">작사게시판</a>
          <li><a href="board.php?board=performer_board">보컬/악기게시판</a></li>
          <li><a href="board.php?board=free_board">자유게시판</a></li>
          <li><a href="board.php?board=completed_board">완성작게시판</a></li>
        </ul>
      </li>
      <li class="main_li"><a href="hall_of_fame.php">명예의전당</a></li>
      <li class="main_li"><a href="q_and_a.php">Q&A</a></li>
      <li class="main_li"><a href="mypage.php">마이페이지</a>
        <ul class="nav_detail">
          <li><a href="mypage.php">내정보</a></li>
          <li><a href="mailbox.php?mailbox=recieved">받은쪽지함</a></li>
          <li><a href="mailbox.php?mailbox=sent">보낸쪽지함</a></li>
          <li><a href="write_mail.php">쪽지쓰기</a></li>
        </ul>
      </li>
    </ul>
  </nav>
  <?php
    $uri = $_SERVER['PHP_SELF'];

    if(isset($_SESSION['islogin'])) {
      $sql = "SELECT *FROM user WHERE id='{$_SESSION['user_ID']}'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $_SESSION['user_name'] = $row['name'];
      $you = $_SESSION['user_name'];

      $host = $_SERVER['HTTP_HOST'];
      $parameter = $_SERVER['QUERY_STRING'];

      echo'
          <div class="login_register">
            <div id="name">'
            .$_SESSION['user_name'].
            '님</div>
            <form action="logout_process.php" method="post" id="logout_init">
              <input type="hidden" name="back" value="'.$_SERVER['REQUEST_URI'].'">
              <input type="submit" name="logout_init" value="로그아웃">
            </form>
          </div>';
    } else { echo'
          <div class="login_register">
            <form action="login.php" method="post" id="login_init">
              <input type="hidden" name="back" value="'.$_SERVER['REQUEST_URI'].'">
              <input type="submit" value="로그인">
            </form>
            <form action="register.php" method="post" id="register_init">
              <input type="hidden" name="back" value="'.$_SERVER['REQUEST_URI'].'">
              <input type="submit" value="회원가입">
            </form>
          </div>' ;
    }
  ?>
</div>
</header>
