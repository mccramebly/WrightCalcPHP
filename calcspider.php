<!DOCTYPE html>
<html>

<head>
    <title>Calc Spider</title>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>


<body onLoad="loadspider(); self.focus();document.theForm.a.focus()">
    <script type="text/javascript" src="myfunctions.js"></script>
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
            document.theForm.c.value = ""
            document.theForm.d.value = ""
            document.theForm.a.focus()
        }
        //-----------------------
        function plus1() {
            a = Number(document.theForm.a.value)
            document.theForm.a.value = (a + 1)
            calc()
        }
        //-----------------------
        function less1() {
            b = Number(document.theForm.b.value)
            document.theForm.b.value = (b + 1)
            calc()
        }
        //-----------------------
        function calc() {
            var a = Number(document.theForm.a.value)
            var b = Number(document.theForm.b.value)
            document.theForm.c.value = ""
            document.theForm.d.value = ""
            document.theForm.e.value = ""
            var t = a + b
            if (t != 0) {
                var c = Math.floor(100 * a / t);
                document.theForm.c.value = c + "%"
                var cl = Math.floor(100 * a / (t + 1));
                document.theForm.cl.value = cl + "%"
                var cw = Math.floor(100 * (a + 1) / (t + 1));
                document.theForm.cw.value = cw + "%"
                if (t != a && c != 99) {
                    e = 0;
                    f = c;
                    while (f == c) {
                        e++;
                        t = a + b + e;
                        f = Math.floor(100 * (a + e) / t)
                    }
                    document.theForm.d.value = (a + e)
                    document.theForm.e.value = e
                } else {
                    document.theForm.d.value = "* * *"
                    document.theForm.e.value = "* * *"
                }
            }
            localStorage.spider = document.theForm.a.value + ";" + document.theForm.b.value
        }
        // ---------------------------------------------------
        function loadspider() {
            var xx = unescape(localStorage.spider);
            var xx0 = xx.search(/;/)
            if (xx0 > -1) {
                document.theForm.a.value = Number(xx.slice(0, xx0))
                document.theForm.b.value = Number(xx.slice(xx0 + 1))
                calc()
            }
        }
    </script>
    <?php include('nav.html'); ?>
    <div class="calcmenu"> <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">
            <table border=1 noshade bgcolor=99CC66>

                <tr>
                    <th colspan=2 align=center>Spider</th>
                </tr>
                <tr>
                    <th id="wins" onclick="plus1()" style="background-color:yellow" align=right>Wins</th>
                    <td align=left><input type="text" name="a" size=5 rows=1 tabindex="1" value="" onblur="doa=false; calc()" onKeyUp="enter(event)" /></td>
                </tr>
                <tr>
                    <th id="wins" onclick="less1()" style="background-color:yellow" align=right>Losses</th>
                    <td align=left><input type="text" name="b" size=5 rows=1 tabindex="2" value="" onblur="doa=true; calc()" onKeyUp="enter(event)" /></td>
                </tr>
                <tr>
                    <td align=right>Percent</td>
                    <td align=left><input type="text" name="c" size=5 rows=1 value="" tabindex="-1" readonly /></td>
                </tr>
                <tr>
                    <td align=right>next level</td>
                    <td align=left><input type="text" name="d" size=5 rows=1 value="" tabindex="-1" readonly /></td>
                </tr>
                <tr>
                    <td align=right>need</td>
                    <td align=left><input type="text" name="e" size=5 rows=1 value="" tabindex="-1" readonly /></td>
                </tr>
                <tr>
                    <td align=right>win 1</td>
                    <td align=left><input type="text" name="cw" size=5 rows=1 value="" tabindex="-1" readonly /></td>
                </tr>
                <tr>
                    <td align=right>lose 1</td>
                    <td align=left><input type="text" name="cl" size=5 rows=1 value="" tabindex="-1" readonly /></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>