$(function(){
  // 編集ボタン(class="js-modal-open")が押されたら発火
  $('.js-modal-open').on('click',function(){
    // モーダルの中身(class="js-modal")の表示
  $('.js-modal').fadeIn();
    // 押されたボタンから属性値を取得し変数へ格納  $(this)=js-modal-openのクラス
  var reserve = $(this).attr('value');
    // 押されたボタンからユーザーがその日の予約内容のidを取得し変数へ格納
  var reserve_id = $(this).text();

    // 取得した予約内容をモーダルの中身へ渡す
  $('.date').text(reserve);
    // 取得した投稿のidをモーダルの中身へ渡す
  $('.part').text(reserve_id);
  return false;
  });

    // 背景部分や閉じるボタン(js-modal-close)が押されたら発火
  $('.js-modal-close').on('click',function(){
    // モーダルの中身(class="js-modal")を非表示
  $('.js-modal').fadeOut();
  return false;
  });

});
