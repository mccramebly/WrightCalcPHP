
<!DOCTYPE html>
<html lang="en">

<head>
    <title>HTM</title>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="artmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheader.png"></a>
        <script>
            function w(x) {
                i = x;
                document.write('<br>', i, ": ", p[i]);
                i++
            }
            p = []
            for (i = 0; i < 9; i++) p[i] = [
                [i],
                [i * i + 3]
            ]

            for (i = 0; i < p.length; i++) w(i)
        </script>
    </div>
</body>

</html>