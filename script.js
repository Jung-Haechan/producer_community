var nav = function(i, text) {
  $('nav ul li:eq('+i+')').hover ( function(){
    $(this).append('<div class="nav_detail">'+text+'</div>');
    $(this).find('a').css('color', 'powderblue');
  }, function(){
    $('.nav_detail').fadeOut(300, function(){
      $(this).children('div').remove();
    });
    $(this).find('a').removeAttr('style');
  });
}


nav(0, '자신이 작곡한 MR 및 멜로디를 공유하세요!');
nav(1, '자신의 감정을 담은 가사를 공유하세요!');
nav(2, '자신의 목소리와 악기 실력을 프로듀서에게 어필하세요!');
nav(3, '음악에 대한 다양한 의견을 공유하세요!');
