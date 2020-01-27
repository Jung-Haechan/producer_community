<?php
  include 'headline.php';
 ?>

      <section>

        <aside>
        </aside>

        <article>
          <div class="register_page">
            <form action="register_process.php" method="post">
              <input type="hidden" name="back" value="<?=$_POST['back']?>">
              <label for="new_ID">ID:</label>
              <input type="text" name="new_ID" class="blank" required>
              <input type="submit" name="register" value="회원가입" id="submit">
              <label for="new_password">Password:</label>
              <input type="password" name="new_password" class="blank" required>
              <label for="new_name">Name:</label>
              <input type="text" name="new_name" class="blank" required>
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
