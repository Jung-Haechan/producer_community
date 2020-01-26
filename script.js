var nav = {
  contents: new Array(
    '자신이 작곡한 MR 및 멜로디를 공유하세요',
    '자신의 감정을 담은 가사를 공유하세요',
    '자신의 목소리와 악기 실력을 프로듀서에게 어필하세요',
    '음악에 대한 다양한 의견을 공유하세요',
    '협업을 통해 완성한 여러분의 음악을 들려주세요',
  ),
  show_del: function(eventTarget, text) {
    $(eventTarget).hover(
      function(){
        $(this).append('<div class="nav_detail">'+text+'</div>');
        $(this).find('a').css('color', 'pink');
    },
    function(){
      $('.nav_detail').fadeOut(300, function(){
        $(this).remove();
      });
      $(this).find('a').removeAttr('style');
    });
  },
  nav_det: function() {
    var li = $('nav').find('li');
    for(i=0;i<li.length;i++) {
      this.show_del(li[i], this.contents[i]);
    }
  },
  user_det: function() {
    var mypage = '<a href="mailbox.php?mailbox=recieved">받은쪽지함</a><a href="mailbox.php?mailbox=sent">보낸쪽지함</a><a href="write_mail.php">쪽지쓰기</a>'
    this.show_del($('#name'), mypage);
  }
}

nav.nav_det();
nav.user_det();
