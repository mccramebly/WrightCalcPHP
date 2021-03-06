<!DOCTYPE html>
<html lang="en">

<head>
    <title>JS</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>

    <div class="artmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheader.png"></a>
        <p>Here is the start of the first assignment for ENGR 190:</p>

        <pre>
&lt;html>&lt;body>&lt;script type="text/javascript">
var x=6, h=.01  // must be the first statement
function pr(x){document.write(x,"&lt;br&gt;")}
function f(x){return x*x} // use a simple function to test your program
pr("Engr 190: Assignment one - Finite difference approximations by My Name") // print the assignment number and your name
pr("First Derivatives:")
pr(" Forward of error [O(h)]"+((f(x+h)-f(x))/h))
pr("End of Assignment 1") // not a bad idea to have a print statement at the end of the program to make sure your program ran correctly
&lt;/script&gt;&lt;/body&gt;&lt;/html&gt;
</pre>
        <p>Output:</p>
        <pre>
<script type="text/javascript">
var x=6, h=.01  // must be the first statement
function pr(x){document.write(x,"<br>")}
function f(x){return x*x} // a simple function to test your program
pr("Engr 190: Assignment one - Finite difference approximations by My Name") // assignment number and your name
pr("First Derivatives:")
pr("Forward of error [O(h)]: "+(f(x+h)-f(x))/h)
pr("End of Assignment 1") // print statement at the end to make sure your program ran correctly
</script>
</pre>
        <p><a href="still.more.js.php" target="_blank">Still More JS</a></p>

    </div>
</body>

</html>