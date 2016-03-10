$(document).ready(function(){
    $('.top').click(function () {
        $('html, body').animate({scrollTop:$(document).height()}, 'slow');
return false;
});
$('.bottom').click(function () {
    $('html, body').animate({scrollTop:0}, 'slow');
return false;
});
});
