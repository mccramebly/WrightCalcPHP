<!DOCTYPE html>
<html lang="en">

<head>
    <title>Calc GPA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/simple-calc-style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="gpa" onLoad="self.focus();document.theForm.a.focus()">
    <?php include('nav.html'); ?>
    <script src="myfunctions.js"></script>
    <script>
        var x, y, z, c1, c2, doa = true
        // ---------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) {
                doa = !doa;
                calc();
                return
            }
            if (charCode == 27) {
                clere();
                return
            };
        }
        // ---------------------------------------------------
        function clere() {
            document.theForm.a.value = ""
            document.theForm.b.value = ""
            document.theForm.output1.value = ""
            document.theForm.output2.value = ""
            document.theForm.a.focus()
        }
        //-----------------------
        function calc() {
            a = Number(document.theForm.a.value)
            b = Number(document.theForm.b.value)
            document.theForm.output1.value = ""
            document.theForm.output2.value = ""
            for (x = 1; x < 22; x++) {
                document.theForm.output1.value += ("  " + x).slice(-3) + "\n"
                document.theForm.output2.value += myround((a * b + x * 4) / (a + x), 2) + "\n"
            }
            if (doa) document.theForm.a.focus();
            else document.theForm.b.focus()
        }
    </script>
    <div id="calctainer">
        <a href="index.php"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <h1>Projected GPA Calculator</h1>
        <form name="theForm">
            <p id="input">If you have already taken <input type="text" name="a" size=12 tabindex="1" onblur="doa=false; calc()" onKeyUp="enter(event)"> credit hours in which you have a <input type="text" name="b" size=12 tabindex="2" onblur="doa=true; calc()" onKeyUp="enter(event)"> GPA then if you get an "A" in this many additional credit hours, your GPA will be:</p>
            <textarea name="output1" rows=22 cols=3></textarea>
            <textarea name="output2" rows=22 cols=5></textarea>
        </form>
    </div>
</body>

</html>