
<!DOCTYPE html>
<html>

  <head>
    <meta charset="ucf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css?ver=1">
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

        <div class="login_register">
          <form action="login.php" method="post" id="login_init">
            <input type="submit" name="login_init" value="로그인">
          </form>
          <form action="register.php" method="post" id="register_init">
            <input type="submit" name="register_init" value="회원가입">
          </form>
        </div>

      </header>

      <section>

        <aside>
        </aside>

        <article>

          <form action="register_process.php" method="post" class="register_page">
            <div class="label">
              <label for="new_ID">ID:</label><br>
              <label for="new_password">Password:</label><br>
              <label for="new_name">Name:</label>
            </div>
              <div class="blank">
                <input type="text" name="new_ID" required><br>
                <input type="password" name="new_password" required><br>
                <input type="text" name="new_name" required>
              </div>
              <div class="enter">
                <input type="submit" name="register" value="회원가입" style="height:30px">
              </div>
           </form>

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
