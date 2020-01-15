<?php
  include 'headline.php';
 ?>


      <section>

        <aside>
        </aside>

        <article>

          <div class="board">
            <?php
                  $present_board = $_GET['board'];
                  echo '<h2><a href="board.php?board='.$present_board.'">'.$board["$present_board"].' 게시판 </a></h2>';
                  $sql = "SELECT * FROM posts WHERE board='".$present_board."' ORDER BY num DESC";
                  $result = mysqli_query($conn, $sql);
                  if (!isset($_GET['post_num'])) {
                    echo '
                    <form action="index.html" method="get">
                      <select name="arrange">
                        <option value="">제목</option>
                        <option value="">제목+내용</option>
                        <option value="">작성자</option>
                      </select>
                      <input type="text" name="search">
                      <input type="submit" value="검색">
                    </form>
                    <form action="write.php" method="post">
                      <input type="hidden" name="board" value='.$present_board.'>
                      <input type="submit" value="글쓰기">
                    </form>
                    <table>
                      <thead>
                        <tr>
                          <td>번호</td><td>제목</td><td>글쓴이</td><td>날짜</td>
                        </tr>
                      </thead><tbody>';       ;
                    while ($row_list = mysqli_fetch_assoc($result)){
                      echo "
                      <tr>
                        <td>".$row_list['num']."</td>
                        <td><a href='board.php?board=".$present_board."&&post_num=".$row_list['num']."'>".$row_list['title']."</a></td>
                        <td>".$row_list['author']."</td>
                        <td>".explode(' ',$row_list['created'])[0]."</td>
                      </tr>";
                    }
                    echo "</tbody></table>";    //post_num이 비어있을 때, 게시판 테이블 출력
                  } else {
                    $sql = "SELECT * FROM posts WHERE num=".$_GET['post_num'];
                    $result = mysqli_query($conn, $sql);
                    $row_post = mysqli_fetch_assoc($result);
                    echo "
                      <div class='post'>
                        <div class='title'>제목: "
                          .$row_post['title'].
                        "</div>
                        <div class='info'>
                          <div class='author'>By<strong> "
                            .$row_post['author'].
                          "</strong></div>
                          <div class='time'>"
                            .$row_post['created'].
                          "</div>
                          <div class='views'>조회수:
                          </div>
                        </div>
                        <div class='content'>"
                          .$row_post['contents'].
                        "</div>";
                      if (explode('/', $row_post['file_type'])[0] === 'audio'){
                        echo "
                        <audio controls>
                          <source src='".$present_board."_file\\".$row_post['file']."'>
                        </audio>";
                      }
                      else if (explode('/', $row_post['file_type'])[0] === 'image'){
                        echo "
                        <img src='".$present_board."_file\\".$row_post['file']."'>";
                      }      //post_num이 값을 갖게되면 글의 제목 및 내용 출력

                    if(isset($_SESSION['user_name'])&&$row_post['author']===$_SESSION['user_name']) {
                      echo "
                        <div class='buttons'>
                          <form action='delete_process.php' method='post'>
                             <input type='submit' value='삭제'>
                             <input type='hidden' name='post_num' value=".$row_post['num'].">
                             <input type='hidden' name='board' value='".$present_board."'>
                           </form>
                           <form action='edit.php' method='post'>
                             <input type='submit' value='수정'>
                             <input type='hidden' name='post_num' value=".$row_post['num'].">
                             <input type='hidden' name='board' value='".$present_board."'>
                           </form>
                         </div>";             //만약 이용자가 로그인 상태이고 이용자와 글쓴이가 일치한다면 삭제, 출력 버튼 생성
                    } else {}
                    $sql = "SELECT * FROM posts WHERE board='".$present_board."'&&num>".$_GET['post_num']." LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row_next = mysqli_fetch_assoc($result);
                    echo "
                         <div class='neighbor'>다음글:
                           <a href='board.php?board=".$present_board."&&post_num=".$row_next['num']."'>"
                           .$row_next['title'].
                         "</a></div>";
                    $sql = "SELECT * FROM posts WHERE board='".$present_board."'&&num<".$_GET['post_num']." ORDER BY num DESC LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row_prev = mysqli_fetch_assoc($result);
                    echo "
                          <div class='neighbor'>이전글:
                            <a href='board.php?board=".$present_board."&&post_num=".$row_prev['num']."'>"
                            .$row_prev['title'].
                          "</a></div>";        //이전글과 다음글 생성
                    echo "
                          <form action='reply_process.php' method='post'>
                            <textarea name='reply' rows='8' cols='80'></textarea>
                            <input type='submit' value='답글'>
                            <input type='hidden' name='board' value='".$present_board."'>
                            <input type='hidden' name='post_num' value='".$_GET['post_num']."'>
                          </form>";       //답글 창 셍상

                    $sql = "SELECT * FROM reply WHERE post_num=".$_GET['post_num']." ORDER BY num DESC";
                    $result = mysqli_query($conn, $sql);
                    echo
                          "<div class='replies'>";
                    while ($row_reply = mysqli_fetch_assoc($result)) {
                      echo "
                             <div class='reply'>
                               <div class='author'><strong>"
                                 .$row_reply['author'].
                               "</strong>님의 답글</div>
                               <div class='contents'>"
                                 .$row_reply['contents'].
                               "</div>
                               <div class='created'>"
                                 .$row_reply['created'].
                               "</div>
                             </div>";
                    }
                    echo
                          "</div>";
                  }
            ?>
            <div class='page'>
              [1] [2] [3] [4] [5]
            </div>

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
