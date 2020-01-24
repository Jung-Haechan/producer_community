function getIndex(ele) {
  var _i = 0;
  while((ele = ele.previousSibling) != null ) {
    _i++;
  }
  return _i;
}
