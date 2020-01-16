jQuery(document).ready(function(){
    jQuery('.clicktop').click(function () {
     jQuery('body,html').animate({
        scrollTop: 0
    }, 800);
     return false;
 });
});

var toTop = jQuery('#to-top');
toTop.hide();
jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 0) {
        toTop.fadeIn();
    } else if (toTop.is(':visible')) {
        toTop.fadeOut();
    }
});