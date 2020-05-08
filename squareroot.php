<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manual Square Root</title>
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/articlestyles.css">
</head>

<body onLoad="self.focus();document.theForm.input.focus()">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <h2>Manual Square Root</h2><br>
        <script type="text/javascript" src="myfunctions.js"></script>
        <script>
            var a, q, w
            fillerchar = String.fromCharCode(183)
            // ----------------------------------------------- */
            function enter(evt) {
                var charCode = evt.keyCode;
                if (charCode == 13) {
                    calc();
                    return
                }
                if (charCode == 27) {
                    clere();
                    return
                };
            }
            // ----------------------------------------------- */
            function clere() {
                document.theForm.input.value = ""
            }
            //------------------------------------------------ */
            function twosplit(x, w, rj) {
                xx = "" + x;
                var y = "";
                n = w
                if (rj && xx.length % 2 == 1) xx = '0' + xx
                while (n > 0 && xx.length > 0) {
                    n--;
                    if (!rj) xx += '00'
                    if (xx.search(/\./)) {
                        y += ' ' + xx.slice(0, 2);
                        xx = xx.slice(2)
                    } else {
                        y += xx.slice(0, 3);
                        xx = xx.slice(3)
                    }
                }
                return y
            }
            //------------------------------------------------ */
            function spaces(w) {
                var n = w;
                var y = ""
                while (n > 0) {
                    n--;
                    y += ' '
                }
                return y
            }
            //------------------------------------------------ */
            function dashes(w) {
                var n = w;
                var y = ""
                while (n > 0) {
                    n--;
                    y += '---'
                }
                return y
            }
            //------------------------------------------------ */
            function onesplit(x) {
                var xx = "" + x;
                var y = ""
                w = 0 // global
                while (xx.length) {
                    w++
                    if (xx.search(/\./)) {
                        y += '  ' + xx.slice(0, 1);
                        xx = xx.slice(1)
                    } else {
                        y += xx.slice(0, 1) + ' ' + xx.slice(1, 2);
                        xx = xx.slice(2)
                    }
                }
                return y
            }
            //------------------------------------------------ */
            function calc() {
                with(Math) {
                    a = document.theForm.input.value.replace(/ /g, "")
                    if (a.length == 0) {
                        a = "3.141592653589793";
                        document.theForm.input.value = a
                    } else {
                        a = eval(cleanx(a)) + ""
                    }
                    if (a.search(/\./) < 0) a += '.'
                    var n = a.search(/\./);
                    if (n < 0) n = a.length
                    if (n % 2 == 1) a = '0' + a;
                    else if (n == 0) a = '00' + a
                    a += '00';
                    q = Math.sqrt(a) + ""
                    document.theForm.b.value = q
                    qq = q.search(/\./)
                    if (qq < 0) qq = q;
                    else qq = q.slice(0, qq) + q.slice(qq + 1)
                    document.theForm.output.value = '     ' + onesplit(q)
                    // document.theForm.output.value +='\n012345678 1 2345678 2 2345678 3 2345678 4 2345678 5 2345678 6 2345678'
                    document.theForm.output.value += '\n     ' + dashes(w)
                    document.theForm.output.value += '\n    √' + twosplit(a, w)
                    qqn = qq.charAt(0)
                    document.theForm.output.value += "\n" + qqn + "×" + qqn + '= ' + twosplit(qqn * qqn, 1, true)
                    a1 = Number(a.slice(0, 2)) - qqn * qqn;
                    a = a.slice(2);
                    zz = 5
                    for (i = 1; i <= qq.length; i++) {
                        z1 = dashes(i)
                        document.theForm.output.value += "\n" + (spaces(zz) + z1).slice(0, 5 + z1.length)

                        p1 = "" + Number(qq.slice(0, i)) * 2
                        p2 = qq.charAt(i)
                        p3 = Number(p1 + p2) * Number(p2)
                        if (a.search(/\./) == 0) a = a.slice(1)
                        if (i < qq.length) {
                            z1 = "\n" + p1 + p2;
                            a2 = "" + a1 + a.slice(0, 2);
                            a = a.slice(2) + '00'
                            z2 = twosplit(a2, i + 1, true)
                            z3 = spaces(9 + 3 * i - z1.length - z2.length)
                        } else {
                            z1 = "\n";
                            a2 = "" + a1
                            z2 = twosplit(a2, i + 1, true)
                            z3 = spaces(6 + 3 * i - z1.length - z2.length)
                        }
                        document.theForm.output.value += z1 + z3 + z2
                        if (i == qq.length) {
                            break
                        }
                        zz = (z1 + z3).length - 1

                        a1 = Number(a2) - p3
                        z1 = "\n" + "×" + qq.charAt(i) + "="
                        z2 = twosplit(p3, 1 + i, true)
                        z3 = spaces(9 + 3 * i - z1.length - z2.length)
                        document.theForm.output.value += z1 + z3 + z2
                    }
                    document.theForm.output.value += "\n"
                }
            }
        </script>

        <form name="theForm">
            <label>Square root of</label>
            <input type="text" name="input" tabindex=1 onKeyUp="enter(event)" /><br>
            <label>is</label><input type="text" name="b" disabled /><br>
            <input name="resbut" tabindex=3 Value="Result" type="button" onClick="calc()" /> <br><br>

            <h2>Breakdown</h2>
            <textarea name="output" rows=10 cols=68 tabindex=""></textarea>
        </form>
        <script>
            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                lsf = ls.slice(1).split("&")
                document.theForm.input.value = lsf[0]
                calc()
            }
        </script>
    </div>
</body>

</html>