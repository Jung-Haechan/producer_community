<?php
  include 'headline.php';
  if(!isset($_SESSION['islogin'])) {
    echo "<script>alert('글쓰기 권한이 없습니다.'); location.href='login.php'</script>";
  }
 ?>

      <section>

        <aside>
          <div class="ad">
            AD
          </div>
        </aside>

        <article>

          <div class="write">
            <form enctype="multipart/form-data" action="write_process.php" method="post">
              <select id="board" name="board" style="width:150px">
                <option value="composer_board" <?php if($_POST['board']==='composer_board'){echo 'selected';}?>>작곡 게시판</option>
                <option value="lyricist_board" <?php if($_POST['board']==='lyricist_board'){echo 'selected';}?>>작사 게시판</option>
                <option value="performer_board" <?php if($_POST['board']==='performer_board'){echo 'selected';}?>>보컬/악기 게시판</option>
                <option value="free_board" <?php if($_POST['board']==='free_board'){echo 'selected';}?>>자유 게시판</option>
                <option value="completed_board" <?php if($_POST['board']==='completed_board'){echo 'selected';}?>>완성작 게시판</option>
              </select>
              <input type="text" name="title" id="title" style="width:100%" placeholder="제목" required>
              <textarea name="contents" id="content" rows="20"></textarea>
              <input type="file" name="file" id="file">
              <input type="submit" value="등록" id="submit">
            </form>
          </div>

        </article>

        <aside>
          <div class="ad">
            AD
          </div>
        </aside>

      </section>

      <footer>
        커뮤니티 주소
      </footer>
    </div>

    <script src="script.js"></script>

  </body>
</html>
