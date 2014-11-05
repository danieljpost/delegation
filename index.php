<?php
function thelist($id) {
    static $stuff = ['a,blue,happy','b,green,sad','c,red,confused'], $uniqid=0;
    $content = [];
    foreach ($stuff as $idx=>$thing) {
        list($label, $color, $feeling) = explode(',', $thing);
        $content[] = "<li id=li-$uniqid><figure>$label<figcaption><a href=#$color>$color</a></figcaption></figure></li>";
        $uniqid++;
    }
    $output=array_merge(["<ul id=$id>"],$content,['</ul>']);
    return implode('',$output);
}
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Quick and dirty Event Delegation example</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon(s) in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <style>
            /* yes, inline styling is icky, but thank you for reading my source code. -- Daniel */
            .view-source {
                background-color: rgba(0,0,0,.2);
            }
            body {
                background-color: #abcdef;
            }
            section {
                background-color: #fff;
                margin: 20px;
                padding: 10px;
            }
            section>div {
                width: 400px;
                background-color: rgba(0,0,0,.05);
                outline: 3px solid black;
                margin: 10px auto;
            }
            ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }
            div>ul * {
                padding: 0 5px;
                margin: 0 5px;
                outline: 1px solid black;
                background-color: rgba(0,0,0,.2);
            }
            .view-source code {
                font-family: monospace;
                white-space: pre;
                margin: 1em 0;
                transition: width 2s, height 2s, transform 2s;
                display: none;
            }
            .userFeedback {
                background-color: blue
                text-align: center;
                color: white;
                background-color: rgba(0,0,255, .2);
            }
        </style>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <h1>Quick and dirty Event Delegation example</h1>

        <section id="suboptimal-example">
            <h2>A Sub Optimal Example</h2>
            <p>Below is a simple unordered list of elements you could click on. </p>
            <p>I've written some quick jQuery to handle the click, just something naive and "sub-optimal" to get the thing done. There are two different click handler functions defined, one to handle if an &lt;LI&gt; element was clicked, one to handle if a &lt;A&gt; was clicked.</p>
            <p>Feel free to have a look at the source code (below) and decide in five seconds whether there are any bugs in it, before clicking around further.</p>
            <div>
            <p class="userFeedback">Click Stuff below</p>
            <?=thelist('list-1')?>
            </div>
            <blockquote class="view-source">
                <h3>Click to show/hide JavaScript Source</h3>
                <code><?readfile('js/sub-optimal.js');?></code>
            </blockquote>
            <p><em>Did you find the bug in the source code?</em></p>
            <p>Now, click around a bit. Take a look at the &quot;Number of clicks tracked&quot;</p>
            <p>There are a few things that could be fixed about this code.
                <ol>
                    <li>there are two functions that the developer needs to maintain.</li>
                    <li>even more subtle, there are a lot more event handlers being added to the document than necessary</li>
                </ol>
            </p>
        </section>

        <section id="more-optimal-example">
            <h2>A More Optimal Example</h2>
            <p>The same code was rewritten below, but I've fixed the issues I've listed above. Click stuff to see that it works just the same, then read the source code</p>
            <div>
            <p class="userFeedback">Click Stuff below</p>
            <?=thelist('list-2')?>
            </div>
            <blockquote class="view-source">
                <h3>Click to show/hide JavaScript Source</h3>
                <code><?readfile('js/more-optimal.js');?></code>
            </blockquote>
            <p>What's different about this code?</p>
            <p>In a nutshell, every click within the second example (<code>$('#list-2')</code>) is handled by the same function.</p>
            <p>That's not to say that the clicks are handled by the same <em>kind</em> of function. They're handled by the <em>one copy</em> of that function that exists in the entire application</p>
            <p>Some benefits to this:
                <ol>
                    <li>the function is easier to debug because there's ever only going to be the one scope the developer will need to look into</li>
                    <li>Smaller memory footprint. This doesn't seem like a big deal for a trivial example, but what happens when there are thousands of elements in the DOM?</li>
                </ol>
            </p>
        </section>

        <section>
            <h2>Wait, what was the bug?</h2>
            <p>In the first example the developer forgot to do <code>event.stopPropagation()</code> - probably the easiest thing to forget when developing in jQuery - so both of the click functions get called when the user clicks an &lt;A&gt; element.</p>
        </section>

        <footer>
        <cite>&copy; <?=date('Y', filemtime(__FILE__));?> Daniel J. Post</cite>
        </footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.1.min.js"><\/script>')</script>
        <script src="js/main.js"></script>
        <script src="js/sub-optimal.js"></script>
        <script src="js/more-optimal.js"></script>

    </body>
</html>
