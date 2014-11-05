// do this after the page is "ready"
$(function($, $list) {
    var doSomething = function (t) {
        $(t)
            .closest('section')
            .find('p.userFeedback')
            .html(['You clicked a ' + t.nodeName,'Number of clicks tracked: ' + ++myPrivateEventCounter].join('<br />'));
    }, myPrivateEventCounter = 0;

    $list.find('li').on('click', function(evt) {
        doSomething(evt.target);
    });
    $list.find('a').on('click', function(evt) {
        doSomething(evt.target);
    });
}(jQuery, $('#list-1')));
