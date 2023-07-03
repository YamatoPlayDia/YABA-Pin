// glowAnimeにglowというクラス名を付ける定義
function GlowAnimeControl() {
    $('.glowAnime').each(function () {
      var elemPos = $(this).offset().top - 50;
      var scroll = $(window).scrollTop();
      var windowHeight = $(window).height();
      if (scroll >= elemPos - windowHeight) {
        $(this).addClass("glow");
  
      } else {
        $(this).removeClass("glow");
      }
    });
  }

  $(window).on('load', function () {
    //spanタグを追加する
      var element = $(".glowAnime");
    element.each(function () {
      var text = $(this).text();
      var textbox = "";
      text.split('').forEach(function (t, i) {
        if (t !== " ") {
          if (i < 10) {
            textbox += '<span style="animation-delay:.' + i + 's;">' + t + '</span>';
          } else {
          var n = i / 10;
            textbox += '<span style="animation-delay:' + n + 's;">' + t + '</span>';
          }
  
        } else {
          textbox += t;
        }
      });
      $(this).html(textbox);
    });
  
    GlowAnimeControl();/* アニメーション用の関数を呼ぶ*/
  });