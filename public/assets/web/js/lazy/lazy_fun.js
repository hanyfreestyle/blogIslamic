$(function() {
    $('.lazy').lazy();
});

$(document).ready(function() {
    $('.swiper-pagination-bullet').click(function() {
        $('.lazy').lazy({
            bind: "event",
            delay: 0
        });
    });
});
$(document).ready(function() {
    $('.swiper-button-next').click(function() {
        $('.lazy').lazy({
            bind: "event",
            delay: 0
        });
    });
});
$(document).ready(function() {
    $('.swiper-button-prev').click(function() {
        $('.lazy').lazy({
            bind: "event",
            delay: 0
        });
    });
});
