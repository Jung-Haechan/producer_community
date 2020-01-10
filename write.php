<?php
  include 'headline.php';
  if(!isset($_SESSION['islogin'])) {
    echo "<script>alert('글쓰기 권한이 없습니다.'); history.go(-1);</script>";
  }
 ?>

      <section>

        <aside>
        </aside>

        <article>

          <div class="write">
            <form action="write_process.php" method="post">
              <div class="title">
                <label for="title">제목</label> <input type="text" name="title" id="title" style="width:400px">
                <label for="board">게시판</label>
                  <select id="board" name="board">
                    <option value="composer_board">작곡</option>
                    <option value="lyricist_board">작사</option>
                    <option value="performer_board">보컬/악기</option>
                    <option value="free_board">자유</option>
                    <option value="completed_board">완성작</option>
                  </select>
              </div>
              <div class="content">
                <label for="content">본문</label> <textarea name="content" id="content" rows="20" cols="80"></textarea>
              </div>
              <div class="file">
                <label for="file">파일</label> <input type="file" name="file" id="file">
              </div>
              <input type="submit" value="등록" id="submit">
            </form>
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
