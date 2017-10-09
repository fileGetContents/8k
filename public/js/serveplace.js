$(window).ready(function jindu($) {
    var $bg = $('.bg_');
    var statu = false;
    var ox = 0;
    var lx = 0;
    var left = 200;
    var bgleft = 0;
    $bg.click(function (e) {
        if (!statu) {
            bgleft = $bg.offset().left;
            left = e.pageX - bgleft;
            if (left < 0) {
                left = 0;

            }
            if (left > 200) {
                left = 200;
            }
            $(this).next('div').css('left', left);
            $(this).children().stop().animate({
                width: left
            }, 200);
            $(this).parent('div').siblings('div').html(parseFloat(left / 20).toFixed(0) + '公里');
        }
    });
});
$('.del').click(function () {

    this.parentNode.remove(this.parentNode);
})