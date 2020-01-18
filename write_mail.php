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

          <div class="write_mail">
            <form action="write_mail_process.php" method="post">
              <div class="reciever">
                <label for="reciever">받는사람</label> <input type="text" name="reciever" id="reciever" placeholder="이름을 입력하세요"
                  <?php if(isset($_POST['mail_num'])){echo 'value='.$_POST['sender'];}?> required>
              </div>
              <div class="content">
                <textarea name="contents" id="content" rows="20" cols="45"></textarea>
              </div>
              <input type="submit" value="보내기" id="submit">
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
