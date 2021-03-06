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
        This file:

        <pre>
&lt;html>&lt;script>
document.write("Hello world!&lt;br>")
llength=5
document.write ("the length is: ",llength,"&lt;br>")
width=3
document.write ("the width is: ",width,"&lt;br>")
area=llength*width
document.write ("the area is: ",area,"&lt;br>")
&lt;/script>&lt;/html>
</pre>
        <p>will generate this output if you open it in a browser:</p>
        <pre>
<script>
document.write("Hello world!","<br>")
llength=5
document.write ("the length is: ",llength,"<br>")
width=3
document.write ("the width is: ",width,"<br>")
area=llength*width
document.write ("the area is: ",area,"<br>")
</script>
</pre>
        <p><a href="more.js.php" target="_blank">More JS</a></p>
    </div>
</body>

</html>