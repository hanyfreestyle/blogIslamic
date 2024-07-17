$("div.show_text_but").click(function() {
    $(this).hide();
    $("div.hide_text_but").show();
    // $("div.fade_text").hide();
    $("div#wrapped_text").css("height","auto");
});
$("div.hide_text_but").click(function() {
    $(this).hide();
    $("div.show_text_but").show();
    // $("div.fade_text").hide();
    $("div#wrapped_text").css("height","235");
    $('html, body').animate({
        scrollTop: $("#wrapped_text").offset().top - 200
    }, 10);
});

$('.btn01').click(function() {
    $('.side-slide').animate({left: "0px"}, 200);
});

$('h3.nav01').click(function() {
    $('.side-slide').animate({left: "-100%"}, 200);
});



