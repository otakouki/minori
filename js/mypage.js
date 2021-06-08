$(function() {
  // ハンバーガーメニュー
    $('.hamburger').click(function() {
        $(this).toggleClass('active');
        //activeの削除と付与
        if ($(this).hasClass('active')) {
            $('.globalMenuSp').addClass('active');
        } else {
            $('.globalMenuSp').removeClass('active');
        }
    });
    //タブメニュー
    $('.tab-item').click(function(){
      //activeの削除と付与
    $('.active').removeClass('active');
    $(this).addClass('active');
    //showクラスの削除とindex番号に付与
    $('.show').removeClass('show');
    const index = $(this).index();
    $('.tab-content').eq(index).addClass('show');
  });
});
