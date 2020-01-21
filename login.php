<?php
  include 'headline.php';
 ?>

      <section>

        <aside>
        </aside>

        <article>

          <form action="login_process.php" method="post" class="login_page">
            <input type="hidden" name="back" value="<?=$_POST['back']?>">
            <div class="label">
              <label for="ID">ID:</label><br>
              <label for="password">Password:</label>
            </div>
              <div class="blank">
                <input type="text" name="ID" id ="ID" required><br>
                <input type="password" name="password" id="password" required>
              </div>
              <div class="enter">
                <input type="submit" name="logIn" value="로그인" style="height:30px">
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
