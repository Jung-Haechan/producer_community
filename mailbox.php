<?php
  include 'headline.php';

 ?>


      <section>

        <aside>
        </aside>

        <article>

          <div class="mailbox">

            <h2><a href="mailbox.php">받은쪽지함</a></h2>



            <?php

                //mail_num이 NULL일 때, 쪽지함 테이블 출략하기
                if(!isset($_GET['page'])) {

                  $page = 1;
                    } else {
                      $page = $_GET['page'];
                    }
                    $sql = "SELECT * FROM mail WHERE reciever = '$you'";
                    $result = mysqli_query($conn, $sql);
                    $list_num = mysqli_num_rows($result);

                    $list_per_p = 20;
                    $page_per_b = 5;
                    $total_page_num = ceil($list_num/$list_per_p);
                    $total_block_num = ceil($total_page_num/$page_per_b);
                    $present_block = ceil($page/$page_per_b);
                    $page_first = ($present_block-1)*$page_per_b + 1;
                    if($present_block===$total_block_num){
                      $page_last = $total_page_num;
                    } else {
                      $page_last = $present_block * $page_per_b;
                    }
                  //paging할 때 필요한 변수 설정

                  if (!isset($_GET['mail_num'])) {
                    echo "
                    <form action='write_mail.php' method='post'>
                      <input type='submit' value='쪽지쓰기'>
                    </form>
                    <form action='mail_delete_process.php' method='post'>
                      <input type='submit' value='삭제'>
                    </form>
                    <table>
                      <thead>
                        <tr>
                          <td>번호</td><td>제목</td><td>보낸사람</td><td>날짜</td>
                        </tr>
                      </thead>
                      <tbody>";
                  //쪽지함 테이블 최상단 출력

                  $list_first = ($page-1)*$list_per_p;
                    $sql = "SELECT * FROM mail WHERE reciever = '$you' && reciever_del = 'x' ORDER BY read_check DESC, num DESC LIMIT $list_first, $list_per_p";
                    $result = mysqli_query($conn, $sql);
                    while($row_list = mysqli_fetch_assoc($result)) {
                      echo "
                      <tr>
                        <td><input type='checkbox'></td>
                        <td><a href='mailbox.php?mail_num=".$row_list['num']."'>".$row_list['contents']."</a></td>
                        <td>".$row_list['sender']."</td>
                        <td>".explode(' ',$row_list['time'])[0]."</td>
                      </tr>";
                    }
                    echo "</tbody></table>
                         <div class='page'>";
                  //쪽지함 테이블(쪽지들) 출력

                  if($present_block!=1){
                      echo "<a href='mailbox.php?page=".($page_first-1)."'><</a>";
                    }
                    for($i=$page_first; $i<=$page_last; $i++) {
                      echo "<a href='mailbox.php?page=$i'>[$i]</a>";
                    }
                    if($present_block!=$total_block_num){
                      echo "<a href='mailbox.php?page=".($page_last+1)."'>></a> </div>";
                    }
                  //mail_num이 NULL일 때 page 넘버링
                }

                //mail_num이 설정되었을 때(쪽지를 클릭할 때) 쪽지 내용 보기
                else {
                  $sql = "UPDATE mail SET read_check = '읽음' WHERE num=".$_GET['mail_num'];
                    $result = mysqli_query($conn, $sql);
                  //쪽지 읽으면 읽음 속성 주기

                  $sql = "SELECT * FROM mail WHERE num=".$_GET['mail_num'];
                    $result = mysqli_query($conn, $sql);
                    $row_mail = mysqli_fetch_assoc($result);
                    echo "
                      <div class='mail'>
                        <div class='info'>
                          <div class='sender'>From<strong> "
                            .$row_mail['sender'].
                          "</strong></div>
                          <div class='time'>"
                            .$row_mail['time'].
                          "</div>
                        </div>
                        <div class='content'>"
                          .$row_mail['contents'].
                        "</div>
                         <div class='buttons'>
                           <form action='write_mail.php' method='post'>
                               <input type='submit' value='답장'>
                               <input type='hidden' name='mail_num' value=".$row_mail['num'].">
                           </form>
                           <form action='mail_delete_process.php' method='post'>
                               <input type='submit' value='삭제'>
                               <input type='hidden' name='mail_num' value=".$row_mail['num'].">
                           </form>
                          </div>
                       </div>";
                  }
                  //mail_num이 값을 갖게되면 글의 제목 및 내용 출력

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
