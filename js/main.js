$(function() {
    $('.view-source').find('h3').click(function(evt) {
        console.log(arguments);
        var target = evt.target || evt.srcElement;
        $(target).parent().find('code').toggle();
    });
});
