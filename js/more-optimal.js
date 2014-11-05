var DanielApp = (function($) {
    var myPrivateEventCounter = 0,
    myPrivateHandleClick = {
        "UL": function (t) { /* do nothing. why not? */ },
        "LI": function (t) { return this.doSomething(t); },
        "FIGURE": function (t) { return this.doSomething(t); },
        "FIGCAPTION": function (t) { return this.doSomething(t); },
        "HEADER": function (t) { return this.doSomething(t); },
        "A": function (t) { return this.doSomething(t); },
        "doSomething": function (t) {
            $(t)
                .closest('section')
                .find('p.userFeedback')
                .html(['You clicked a ' + t.nodeName,'Number of clicks tracked: ' + ++myPrivateEventCounter].join('<br />'));
        }
    };
    return {
        'click': function (evt) {
            var target = evt.target || evt.srcElement;
            console.log(target.nodeName);
            return myPrivateHandleClick[target.nodeName](target);
        },
    }
}(jQuery));

// do this after the page is "ready"
$(function($, $list) {
    $list.click(DanielApp.click);
}(jQuery, $('#list-2')));
