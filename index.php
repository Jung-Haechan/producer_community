<?php
  include 'headline.php';
 ?>

      <section>

        <aside>
          <div class="ad">
            AD
          </div>
        </aside>

        <article>

          <div class="index">

              <?php

                foreach($board as $key => $value) {
                  if($key === 'free_board'){
                    $list_num = 16;
                  } else {
                    $list_num = 7;
                  }
                  $sql = "SELECT num, title FROM posts WHERE board = '$key' ORDER BY num DESC LIMIT $list_num";
                  $result = mysqli_query($conn, $sql);

                  echo "
                  <div class='$key'>
                    <div class='title'>
                      <a href='board.php?board=".$key."'>".$value." 게시판</a></strong>
                    </div>
                    <ul>";
                    while ($row = mysqli_fetch_assoc($result)){
                      echo "<li><a href='board.php?board=$key&&post_num=".$row['num']."' style='color:black'>".$row['title']."</a>";
                    }
                  echo "</ul></div>";
                }



                  ?>

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
