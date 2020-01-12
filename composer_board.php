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
                    echo "</tbody></table>";    //post_num이 비어있을 때, 게시판 테이블 출력
                  } else {
                    $sql = "SELECT * FROM posts WHERE num=".$_GET['post_num'];
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "
                      <div class='post'>
                        <div class='title'>제목: "
                          .$row['title'].
                        "</div>
                        <div class='info'>
                          <div class='author'>By "
                            .$row['author'].
                          "</div>
                          <div class='time'>"
                            .$row['created'].
                          "</div>
                          <div class='views'>조회수:
                          </div>
                        </div>
                        <div class='content'>"
                          .$row['contents'].
                        "</div>
                        <audio controls>
                          <source src='composer_file\\".$row['file']."'>
                        </audio>";                            //post_num이 값을 갖게되면 글의 제목 및 내용 출력
                    if(isset($_SESSION['user_name'])&&$row['author']===$_SESSION['user_name']) {
                      echo "
                        <div class='buttons'>
                          <form action='delete_process.php' method='post'>
                             <input type='submit' value='삭제'>
                             <input type='hidden' name='post_num' value=".$row['num'].">
                           </form>
                           <form action='edit.php' method='post'>
                             <input type='submit' value='수정'>
                             <input type='hidden' name='post_num' value=".$row['num'].">
                           </form>
                         </div>";             //만약 이용자가 로그인 상태이고 이용자와 글쓴이가 일치한다면 삭제, 출력 버튼 생성
                    } else {}
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
                          "</a></div>";        //이전글과 다음글 생성
                    echo "
                          <form action='reply_process.php' method='post'>
                            <textarea name='reply' rows='8' cols='80'></textarea>
                            <input type='submit' value='답글'>
                            <input type='hidden' name='post_num' value='".$_GET['post_num']."' required>
                          </form>";       //답글 창 셍상

                    $sql = "SELECT * FROM reply WHERE post_num=".$_GET['post_num']." ORDER BY num DESC";
                    $result = mysqli_query($conn, $sql);
                    echo
                          "<div class='replies'>";
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "
                             <div class='reply'>
                               <div class='author'><strong>"
                                 .$row['author'].
                               "</strong>님의 답글</div>
                               <div class='contents'>"
                                 .$row['contents'].
                               "</div>
                               <div class='created'>"
                                 .$row['created'].
                               "</div>
                             </div>";
                    }
                    echo
                          "</div>";
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
