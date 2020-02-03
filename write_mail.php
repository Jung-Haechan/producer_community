<?php
  include 'headline.php';
  if(!isset($_SESSION['islogin'])) {
    echo "<script>alert('글쓰기 권한이 없습니다.'); location.href='login.php';</script>";
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
            <form action="write_mail_process.php" method="post">
              <input type="hidden" name="back" value="<?=$_POST['back']?>">
              <div class="reciever">
                <label for="reciever">받는사람</label> <input type="text" name="reciever" id="reciever" placeholder="이름을 입력하세요"
                  <?php if(isset($_POST['mail_num'])){echo 'value='.$_POST['sender'];}?> required>
              </div>
              <div class="content">
                <textarea name="contents" id="content" rows="20" cols="45"></textarea>
              </div>
              <input type="submit" value="보내기">
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
