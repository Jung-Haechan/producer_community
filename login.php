<?php
  include 'headline.php';
 ?>

      <section>

        <aside>
        </aside>

        <article>
          <div class="login_page">
          <form action="login_process.php" method="post">
            <input type="hidden" name="back" value="<?=$_POST['back']?>">      
            <label for="ID">ID:</label>
            <input type="text" name="ID" class="blank" required>
            <label for="password">Password:</label>    
            <input type="password" name="password" class="blank" required>
            <input type="submit" name="logIn" value="로그인" id="submit">
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
