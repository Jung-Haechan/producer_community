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

          <div class="board">



            <?php

                //post_num이 NULL일 때, 게시판 테이블 출략하기
                $present_board = $_GET['board'];

                  if(!isset($_GET['page'])) {
                      $page = 1;
                    } else {
                      $page = $_GET['page'];
                    }
                    echo '<h2><a href="'.$uri.'?board='.$present_board.'">'.$board["$present_board"].' 게시판 </a></h2>';
                    if(isset($_GET['title'])) {
                      $sql = "SELECT * FROM posts WHERE board='$present_board' AND title LIKE '%".$_GET['title']."%' ORDER BY num DESC";
                    }
                    else if(isset($_GET['contents'])) {
                      $sql = "SELECT * FROM posts WHERE board='$present_board' AND ( title LIKE '%".$_GET['contents']."%' OR contents LIKE '%".$_GET['contents']."%' ) ORDER BY num DESC";
                    }
                    else if(isset($_GET['author'])) {
                      $sql = "SELECT * FROM posts WHERE board='$present_board' AND author LIKE '%".$_GET['author']."%' ORDER BY num DESC ";
                    }
                    else {
                      $sql = "SELECT * FROM posts WHERE board='$present_board' ORDER BY num DESC";
                    }
                    $result = mysqli_query($conn, $sql);
                    $list_num = mysqli_num_rows($result);
                    $list_per_p = 20;
                    $page_per_b = 5;
                    $total_page_num = ceil($list_num/$list_per_p+0.01);
                    $total_block_num = ceil($total_page_num/$page_per_b);
                    $present_block = ceil($page/$page_per_b);
                    $page_first = ($present_block-1)*$page_per_b + 1;
                    if($present_block===$total_block_num){
                      $page_last = $total_page_num;
                    } else {
                      $page_last = $present_block * $page_per_b;
                    }
                  //paging할 때 필요한 변수 설정, 검색 적용

                  if (!isset($_GET['post_num'])) {
                    echo "
                    <form action='search_process.php' method='post'>
                      <input type='hidden' name='board' value='$present_board'>
                      <select name='arrange'>
                        <option value='title'>제목</option>
                        <option value='contents'>제목+내용</option>
                        <option value='author'>작성자</option>
                      </select>
                      <input type='text' name='search'>
                      <input type='submit' value='검색'>
                    </form>
                    <form action='write.php' method='post'>
                      <input type='hidden' name='board' value='$present_board'>
                      <input type='submit' value='글쓰기'>
                    </form>
                    <table>
                      <thead>
                        <tr>
                          <td>번호</td><td>제목</td><td>글쓴이</td><td>날짜</td><td>조회수</td>
                        </tr>
                      </thead><tbody>";
                  //게시판 테이블 최상단 출력

                  $list_first = ($page-1)*$list_per_p;
                    if(isset($_GET['title'])) {
                      $sql = "SELECT * FROM posts WHERE board='$present_board' AND title LIKE '%".$_GET['title']."%' ORDER BY num DESC LIMIT $list_first, $list_per_p";
                    }
                    else if(isset($_GET['contents'])) {
                      $sql = "SELECT * FROM posts WHERE board='$present_board' AND ( title LIKE '%".$_GET['contents']."%' OR contents LIKE '%".$_GET['contents']."%' ) ORDER BY num DESC LIMIT $list_first, $list_per_p";
                    }
                    else if(isset($_GET['author'])) {
                      $sql = "SELECT * FROM posts WHERE board='$present_board' AND author LIKE '%".$_GET['author']."%' ORDER BY num DESC LIMIT $list_first, $list_per_p";
                    }
                    else {
                      $sql = "SELECT * FROM posts WHERE board='$present_board' ORDER BY num DESC LIMIT $list_first, $list_per_p";
                    }

                    $result = mysqli_query($conn, $sql);
                    while ($row_list = mysqli_fetch_assoc($result)){
                      echo "
                      <tr>
                        <td>".$row_list['num']."</td>
                        <td>";
                      if ($row_list['replies']) {
                        echo "<span style='color:red'> [".$row_list['replies']."]</span>";
                      }
                      echo "<a href='".$uri."?board=".$present_board."&&post_num=".$row_list['num']."'>".$row_list['title']."</a></td>
                        <td>".$row_list['author']."</td>
                        <td>".explode(' ',$row_list['created'])[0]."</td>
                        <td>".$row_list['views']."</td>
                      </tr>";
                    }
                    echo "</tbody></table>
                         <div class='page'>";
                  //게시판 테이블(게시글) 출력, 검색 적용

                  if(isset($_GET['title'])) {
                    $search = '&&title='.$_GET['title'];
                  } else if (isset($_GET['contents'])) {
                    $search = '&&contents='.$_GET['contents'];
                  } else if (isset($_GET['author'])) {
                    $search = '&&author='.$_GET['author'];
                  } else {
                    $search = "";
                  }
                  if($present_block!=1){
                      echo "<a href='".$uri."?board=$present_board$search&&page=".($page_first-1)."'><</a>";
                  }
                  for($i=$page_first; $i<=$page_last; $i++) {
                      echo "<a href='".$uri."?board=$present_board$search&&page=$i'>[$i]</a>";
                  }
                  if($present_block!=$total_block_num){
                      echo "<a href='".$uri."?board=$present_board$search.&&page=".($page_last+1)."'>></a> </div>";
                  }
                  //post_num이 NULL일 때, page 넘버링

                }

                //post_num이 설정되었을 때(게시글을 클릭할 때) 게시글 보기
                else {
                  $sql = "UPDATE posts SET views=views+1 WHERE num=".$_GET['post_num'];
                    $result = mysqli_query($conn, $sql);
                  //조회수 증가

                  $sql = "SELECT * FROM posts WHERE num=".$_GET['post_num'];
                    $result = mysqli_query($conn, $sql);
                    $row_post = mysqli_fetch_assoc($result);
                    echo "
                      <div class='post'>
                        <div class='title'>제목: "
                          .$row_post['title'].
                        "</div>
                        <div class='info'>
                          <div class='author'>By <strong>"
                            .$row_post['author'].
                          "</strong></div>
                          <div class='time'>"
                            .$row_post['created'].
                          "</div>
                          <div class='views'>조회수: "
                            .$row_post['views'].
                          "</div>
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
                      }
                  //post_num이 값을 갖게되면 글의 제목 및 내용 출력

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
                         </div>";
                  }
                  //만약 이용자가 로그인 상태이고 이용자와 글쓴이가 일치한다면 삭제, 수정 버튼 생성

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
                          "</a></div>";
                  //이전글과 다음글 생성

                  echo "
                        <form action='reply_process.php' method='post'>
                          <textarea name='reply' rows='8'  required></textarea>
                          <input type='submit' value='답글'>
                          <input type='hidden' name='board' value='".$present_board."'>
                          <input type='hidden' name='post_num' value='".$_GET['post_num']."'>
                        </form>";
                  //답글 창 생성

                  $sql = "SELECT * FROM reply WHERE post_num=".$_GET['post_num']." ORDER BY num DESC";
                    $result = mysqli_query($conn, $sql);
                    echo
                          "<div class='replies'>";
                    while ($row_reply = mysqli_fetch_assoc($result)) {
                      echo "
                             <div class='reply'>
                               <div class='author'><strong>"
                                 .$row_reply['author'].
                               "</strong>님의 답글</div>";
                         if(isset($you)&&$row_reply['author']===$you) {
                           echo "
                                <form action='delete_reply.php' method='post'>
                                  <input type='submit' value='삭제'>
                                  <input type='hidden' name='reply' value='".$row_reply['num']."'>
                                  <input type='hidden' name='post_num' value='".$_GET['post_num']."'>
                                </form>";
                           }
                          echo "<div class='contents'>"
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
                  //답글 출력
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
