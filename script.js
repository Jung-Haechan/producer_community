var nav = {
  show_del: function(eventTarget) {
    $(eventTarget).hover(
      function(){
        $(this).find('ul').css('display', 'block');
      },
      function(){
        $('.nav_detail').fadeOut(300, function(){
            $(this).css('display', 'none');
        });
      }
    )
  },
  nav_det: function() {
    var li = $('nav').find('li.main_li');
    for(i=0;i<li.length;i++) {
      this.show_del(li[i]);
    }
  },
  mobile: function(eventTarget1,eventTarget2) {
    $(eventTarget1).click(
      function() {
        $('.layer').addClass('show');
        $('#nav_close').css('display', 'inline');
      }
    );
    $(eventTarget2).click(
      function() {
        $('.layer').removeClass('show');
      }
    );
  }
}
if (matchMedia("screen and (min-width: 1024px)").matches) {
  nav.nav_det();
}
nav.mobile('#nav_open', '#nav_close');
