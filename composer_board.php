<?php
  include 'headline.php';
 ?>


      <section>

        <aside>
        </aside>

        <article>

          <div class="board">
            <h2><a href="composer_board.php"> 작곡 게시판 </a></h2>

                <?php
                  $sql = "SELECT * FROM posts WHERE board='composer_board' ORDER BY num DESC";
                  $result = mysqli_query($conn, $sql);
                  if (!isset($_GET['post_num'])) {
                    echo file_get_contents('board_table.txt');
                    echo "<tbody>";
                    while ($row = mysqli_fetch_assoc($result)){
                      echo "
                      <tr>
                        <td>".$row['num']."</td>
                        <td><a href='composer_board.php?post_num=".$row['num']."'>".$row['title']."</a></td>
                        <td>".$row['author']."</td>
                        <td>".explode(' ',$row['created'])[0]."</td>
                      </tr>";
                    }
                    echo "</tbody></table>";
                  } else {
                    $sql = "SELECT * FROM posts WHERE num=".$_GET['post_num'];
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "
                      <div class='post'>
                        <div class='head'>
                          <div class='title'>제목: "
                            .$row['title'].
                          "</div>
                          <div class='author'>By "
                            .$row['author'].
                          "</div>
                        </div>
                        <div class='content'>"
                          .$row['contents'].
                        "</div>";
                    if(isset($_SESSION['user_name'])&&$row['author']===$_SESSION['user_name']){
                      echo "
                      <div class='buttons'>
                        <form action='delete_process.php?post_num=".$row['num']."' method='post'>
                           <input type='submit' value='삭제'>
                         </form>
                         <form action='edit.php?post_num=".$row['num']."' method='post'>
                           <input type='submit' value='수정'>
                         </form>
                       </div>";
                    }
                    $sql = "SELECT * FROM posts WHERE board='composer_board'&&num>".$_GET['post_num']." LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "
                        <div class='neighbor'>다음글:
                          <a href='composer_board.php?post_num=".$row['num']."'>"
                          .$row['title'].
                        "</a></div>";
                    $sql = "SELECT * FROM posts WHERE board='composer_board'&&num<".$_GET['post_num']." ORDER BY num DESC LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "
                        <div class='neighbor'>이전글:
                          <a href='composer_board.php?post_num=".$row['num']."'>"
                          .$row['title'].
                        "</a></div>";
                  }
                ?>

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
