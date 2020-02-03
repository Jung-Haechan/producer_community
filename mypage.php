<?php
  include 'headline.php';
  if(!isset($_SESSION['islogin'])) {
    echo "<script>alert('로그인 한 다음 이용해주세요.');location.href='login.php';</script>";
  }
 ?>


      <section>

        <aside>
          <div class="ad">
            AD
          </div>
        </aside>

        <article>

          <div class="mypage">
            <h2><a href="mypage.php">내 정보</a></h2>

            <?php
              echo "
              <div class='myinfo'>
                <div class='post_number'>
                  <h4 id='total_num'>총 게시글 수: ";
              $sql = "SELECT * FROM posts WHERE author='$you'";
              $result = mysqli_query($conn, $sql);
              $row_num = mysqli_num_rows($result);
              echo $row_num."</h4>";
              foreach($board as $key => $value) {
                echo "<li class='each_num'> $value 게시판: <a href='board.php?board=$key&&author=$you' style='color:red'>";
                $sql = "SELECT * FROM posts WHERE author='$you'&&board='$key'";
                $result = mysqli_query($conn, $sql);
                $row_num = mysqli_num_rows($result);
                echo $row_num."</a></li>";
              }


            ?>
              </div>
              <div class="edit_name">
                <h4>회원정보 수정</h4>
                <form action="edit_name_process.php" method="post">
                  <input type="hidden" name="user_name" value="<?=$you?>">
                  <label for="name">이름:</label>
                  <input type="text" name="name" id="name" class="blank" value="<?=$you?>" required>
                  <input type="submit" name="register" value="수정" id="submit">
                  <label for="password">현재 Password:</label>
                  <input type="password" name="password" id="password" class="blank" required>
                  <label for="new_password">바꿀 Password:</label>
                  <input type="password" name="new_password" id="new_password" class="blank" required>
                </form>
                <h5>* 이름만 수정시, 현재 Password와 <br>바꿀 Password에 현재 Password를 입력하세요.</h5>
              </div>
            </div>
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
