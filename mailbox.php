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

          <div class="mailbox">





            <?php

              //mail_num이 NULL일 때, 쪽지함 테이블 출략하기
              $present_mailbox = $_GET['mailbox'];

                if(!isset($_GET['page'])) {
                  $page = 1;
                  } else {
                  $page = $_GET['page'];
                  }
                  echo '<h2><a href="'.$uri.'?mailbox='.$present_mailbox.'">'.$mailbox["$present_mailbox"].' 쪽지함 </a></h2>';
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
                      <input type='hidden' name='back' value='".$_SERVER['REQUEST_URI']."'>
                      <input type='submit' value='쪽지쓰기'>
                    </form>
                    <form action='delete_mail_process.php' method='post'>
                      <input type='submit' value='삭제'>
                      <input type='hidden' name='mailbox' value=".$present_mailbox.">
                      <table>
                        <thead>
                          <tr>
                            <td>번호</td><td>제목</td><td>";
                  if($present_mailbox==='recieved') {
                    echo '보낸 사람';
                  }
                  else {
                    echo '받은 사람';
                  }

                  echo     "</td><td>날짜</td>
                          </tr>
                        </thead>
                        <tbody>";
                //쪽지함 테이블 최상단 출력

                $list_first = ($page-1)*$list_per_p;
                    if($present_mailbox === 'recieved') {
                      $sql = "SELECT * FROM mail WHERE reciever = '$you' && reciever_del = 'x' ORDER BY read_check DESC, num DESC LIMIT $list_first, $list_per_p";
                    } else if ($present_mailbox === 'sent') {
                      $sql = "SELECT * FROM mail WHERE sender = '$you' && sender_del = 'x' ORDER BY num DESC LIMIT $list_first, $list_per_p";
                    }

                    $result = mysqli_query($conn, $sql);
                    while($row_list = mysqli_fetch_assoc($result)) {
                      echo "
                      <tr>
                        <td><input type='checkbox' name='mail_num[]' value=".$row_list['num']."></td>
                        <td>";
                      if($row_list['read_check']=="읽지 않음"&&$present_mailbox=='recieved') {
                        echo "<span style='color:red'>[New] </span>";
                      }
                      echo "<a href='".$uri."?mailbox=".$present_mailbox."&&mail_num=".$row_list['num']."'>".$row_list['contents']."</a></td>
                        <td>";
                      if($present_mailbox === 'recieved') {
                        echo $row_list['sender'];
                      } else {
                        echo $row_list['reciever'];
                      }
                      echo "</a></td>
                        <td>".explode(' ',$row_list['time'])[0]."</td>
                      </tr>";
                    }
                    echo "</form></tbody></table>
                         <div class='page'>";
                //쪽지함 테이블(쪽지들) 출력

                if($present_block!=1){
                      echo "<a href='".$uri."?mailbox=".$present_mailbox."&&page=".($page_first-1)."'><</a>";
                    }
                    for($i=$page_first; $i<=$page_last; $i++) {
                      echo "<a href='".$uri."?mailbox=".$present_mailbox."&&page=$i'>[$i]</a>";
                    }
                    if($present_block!=$total_block_num){
                      echo "<a href='".$uri."?mailbox=".$present_mailbox."&&page=".($page_last+1)."'>></a> </div>";
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
                        <div class='info'>";
                        if($present_mailbox === 'recieved') {
                          echo "
                          <div class='sender'>From <strong>"
                            .$row_mail['sender'].
                          "</strong></a></div>";
                        } else {
                          echo "
                          <div class='sender'>To <strong>"
                            .$row_mail['reciever'].
                          "</strong></a></div>";
                        }
                          echo
                          "<div class='time'>"
                            .$row_mail['time'].
                          "</div>
                        </div>
                        <div class='content'>"
                          .$row_mail['contents'].
                        "</div>
                         <div class='buttons'>";
                     if($present_mailbox==='recieved') {
                       echo "
                         <form action='write_mail.php' method='post'>
                             <input type='submit' value='답장'>
                             <input type='hidden' name='sender' value=".$row_mail['sender'].">
                             <input type='hidden' name='mail_num' value=".$row_mail['num'].">
                             <input type='hidden' name='back' value='".$_SERVER['REQUEST_URI']."'>
                         </form>";
                     }
                        echo "
                           <form action='delete_mail_process.php' method='post'>
                               <input type='submit' value='삭제'>
                               <input type='hidden' name='mail_num[0]' value=".$row_mail['num'].">
                               <input type='hidden' name='mailbox' value=".$present_mailbox.">
                           </form>
                          </div>
                       </div>";
                  }
                  //mail_num이 값을 갖게되면 글의 제목 및 내용 출력

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
