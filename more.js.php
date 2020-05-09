<!DOCTYPE html>
<html lang="en">

<head>
    <title>JS</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="artmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheader.png"></a>
        Here are some other considerations.<ul>
            <li>Some Browsers may require additional header information.</li>
            <li>The assignment may tell you to assign some values before the rest of your program</li>
            <li>You might want to simplify your life by defining the function pr()</li>
            <li>Your Homework will need to identify who you are.</li>
            <li>You might want to add some aesthetics</li>
        </ul>

        <pre>
&lt;html>&lt;body>&lt;script type="text/javascript">
width=3; llength=5

function pr(x){document.write(x,"&lt;br>")}
pr("Engr 190 Assignment #0 by My Name")
pr("&lt;big>&lt;center>Hello world!&lt;/center>&lt;/big>")
pr("&lt;p>The length is: "+llength)
pr("The width is: "+width)
area=llength*width
pr("&lt;b>The area is: "+area+"&lt;/b>&lt;/p>")
&lt;/script>&lt;/body>&lt;/html>
</pre>
        <p>and that will generate this output if you open it in a browser:</p>
        <pre>
<script type="text/javascript">
width=3; llength=5

function pr(x){document.write(x,"<br>")}
pr("Engr 190 Assignment #0 by My Name")
pr("<big><center>Hello world!</center></big>")
pr("<p>The length is: "+llength)
pr("The width is: "+width)
area=llength*width
pr("<b>The area is: "+area+"</b></p>")
</script>
</pre>
        <p><a href="more.2.js.php" target="_blank">Still More JS</a></p>
    </div>
</body>

</html>