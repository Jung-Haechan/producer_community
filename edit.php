<?php
  include 'headline.php';
  $sql = "SELECT *FROM posts WHERE num='{$_GET['post_num']}'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
 ?>

      <section>

        <aside>
        </aside>

        <article>

          <div class="write">
            <form action="edit_process.php?post_num=<?=$row['num']?>" method="post">
              <div class="title">
                <label for="title">제목</label> <input type="text" name="title" id="title" style="width:400px" value="<?=$row['title']?>" required>
              </div>
              <div class="content">
                <label for="content">본문</label> <textarea name="contents" id="content" rows="20" cols="80"><?=$row['contents']?></textarea>
              </div>
              <div class="file">
                <label for="file">파일</label> <input type="file" name="file" id="file">
              </div>
              <input type="submit" value="수정" id="submit">
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
