<?php
  include 'headline.php';
 ?>
 
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
                <input type="text" name="new_ID" id="new_ID" required><br>
                <input type="password" name="new_password" id="new_password" required><br>
                <input type="text" name="new_name" id="new_name" required>
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
