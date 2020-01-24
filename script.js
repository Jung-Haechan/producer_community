var navDetail = {
  navList: document.getElementsByTagName('nav')[0].getElementsByTagName('a'),
  contents: new Array(
    '자신이 작곡한 MR 및 멜로디를 공유하세요!',
    '자신의 감정을 담은 가사를 공유하세요!',
    '자신의 목소리와 악기 실력을 프로듀서에게 어필하세요!',
    '음악에 대한 다양한 의견을 공유하세요!',
    '협업을 통해 완성한 여러분의 음악을 들려주세요!',
  ),
  hover: function(eventTarget) {
    eventTarget.addEventListener('mouseover', function() {
      eventTarget.setAttribute('style', 'color: pink');
    });
    eventTarget.addEventListener('mouseout', function() {
      eventTarget.removeAttribute('style');
    });
  },
  show_del: function(eventTarget, detail, id){
    eventTarget.addEventListener('mouseover', function() {
      var newEl = document.createElement('div');
      newEl.id = id;
      newEl.innerHTML = detail;
      eventTarget.parentNode.appendChild(newEl);
    });
    eventTarget.addEventListener('mouseout', function() {
      eventTarget.parentNode.removeChild(document.getElementById(id));
    });
  },
  nav_hover: function() {
    for (i=0; i<this.navList.length; i++){
      this.hover(this.navList[i]);
      var index = (getIndex(this.navList[i].parentNode)-1)/2;
      this.show_del(this.navList[i], this.contents[index], 'nav_det');
    }
  },
  name_hover: function() {
    var user_name = document.getElementById('name').getElementsByTagName('a')[0];
    this.hover(user_name);
    this.show_del(user_name, '마이페이지', 'mypage');
  }
}
navDetail.nav_hover();
navDetail.name_hover();
