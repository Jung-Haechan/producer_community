<?php
  include 'db_connect.php';
  session_start();
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

        <h1><a href="index.php">노래랑놀래</a></h1>

        <nav>
          <ul class="main_nav">
            <li><a href="composer_board.php">작곡게시판</a></li>
            <li><a href="lyricist_board.php">작사게시판</a></li>
            <li><a href="performer_board.php">보컬/악기게시판</a></li>
            <li><a href="free_board.php">자유게시판</a></li>
          </ul>
        </nav>

<?php
  if($_SESSION['islogin']==1) {
    $sql = "SELECT *FROM user WHERE id='{$_SESSION['user_ID']}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $user_name = $row['name'];

    echo'
        <div class="login_register">
          <div id="name">'
          .$user_name.
          '님</div>
          <form action="logout_process.php" method="post" id="logout_init">
            <input type="submit" name="logout_init" value="로그아웃">
          </form>
        </div>';
  } else { echo'
        <div class="login_register">
          <form action="login.php" method="post" id="login_init">
            <input type="submit" name="login_init" value="로그인">
          </form>
          <form action="register.php" method="post" id="register_init">
            <input type="submit" name="register_init" value="회원가입">
          </form>
        </div>' ;
        $_SESSION['islogin'] = 0;
  }
?>


      </header>

      <section>

        <aside>
        </aside>

        <article>

          <div class="index">

            <div class="source_board">
              <div class="composer_board">
                작곡 게시판
              </div>
              <div class="lyricist_board">
                작사 게시판
              </div>
              <div class="performer_board">
                보컬/악기 게시판
              </div>
            </div>

            <div class="second_part">
              <div class="free_board">
                자유 게시판
              </div>
              <div class="completed_board">
                완성작
              </div>
            </div>

          </div>
        </article>

        <aside>
        </aside>

      </section>

      <footer>
        커뮤니티 주소
      </footer>
    </div>

    <script src="script.js"></script>

  </body>
</html>
