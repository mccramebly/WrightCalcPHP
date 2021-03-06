<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quadratic Spline</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/simple-calc-style.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="spline" onLoad="self.focus(); document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <script src="myfunctions.js"></script>
    <script src="matrix.js"></script>
    <script>
        degrees = false
        graphdata = ''
        var factors = ""
        var highco = 1
        var dnf = true
        var approx = String.fromCharCode(8776)
        var a = 0;
        b = 0;
        c = 0;
        x = 0
        // -------------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) calc1();
            if (charCode == 27) cla();
        };
        // -------------------------------------------------------
        function clear1() {
            document.theForm.output.value = '';
            document.theForm.input.value = '';
            factors = ""
            highco = 1
            document.theForm.input.focus()
        };
        // -------------------------------------------------------
        function outit(x) {
            document.theForm.output.value += x
        }
        // -------------------------------------------------------
        function calc1() {
            with(Math) {
                graphdata = '';
                graphpoints = ''
                sample = "[[0,3.8414709848078967],[0.6931471805599453,6.6818861490654635],[1.0986122886681098,7.5355691627323065],[1.21,7.5481593016220545],[1.3862943611198906,7.788374949171635],[1.6094379124341003,8.478827375073264],[1.791759469228055,9.887622378713294],[1.9459101490553132,11.440627194940042],[2.0794415416798357,12.307124413342725]]"
                x = eval(document.theForm.x.value);
                nox = x == undefined
                pval = document.theForm.input.value;
                if (pval == '') {
                    pval = sample;
                    print(sample)
                }
                pval = pval.replace(/[^\w\.\-\+]/g, ",").replace(/,+/g, ',')
                pval = '[' + pval.replace(/^,/, "").replace(/,$/, "").replace(/([^\,]*),([^\,]*)(,*)/g, "[$1,$2]$3") + ']'
                dopoints = "var p = " + pval
                eval(dopoints);
                n = p.length;
                n1 = n - 1
                document.getElementById("result").rows = n + 3
                x0 = p[0][0];
                y0 = p[0][1];
                x1 = p[1][0];
                y1 = p[1][1];
                m = (y1 - y0) / (x1 - x0);
                xfr = x0;
                xto = x0;
                yfr = y0;
                yto = y0
                document.theForm.output.value = "going from (" + my(x0) + ", " + my(y0) + ") thru (" + my(p[n1][0]) + ", " + my(p[n1][1]) + ")";
                if (document.theForm.line.checked) {
                    pspbola(x0, y0, x1, y1, m);
                    y = a * x * x + b * x + c;
                    startwith = 1
                } else {
                    graphpoints += '(' + p[1][0] + ", " + p[1][1] + ",-5);"
                    A = Mclone(p)
                    A = A.slice(0, 3)
                    B = Msplit(A)
                    C = Mmul(Minv(Mpow(A)), B)
                    a = C[0][0];
                    b = C[1][0];
                    c = C[2][0]
                    startwith = 2
                }
                x1 = x0;
                y1 = y0
                graphdata = '\n(' + x0 + ':' + x1 + '): y=' + xterm(true, b, 1, 4) + xterm(false, c, 0, 4)
                graphpoints += '(' + x0 + ", " + y0 + ",-5);(" + x1 + ", " + y1 + ",-5)"
                graphxline = ''
                for (i = startwith; i < n; i++) {
                    x0 = x1;
                    y0 = y1;
                    x1 = p[i][0];
                    y1 = p[i][1];
                    m = 2 * a * x0 + b
                    if (x1 < xfr) xfr = x1;
                    else if (x1 > xto) xto = x1
                    if (y1 < yfr) yfr = y1;
                    else if (y1 > yto) yto = y1
                    pspbola(x0, y0, x1, y1, m);
                    y = a * x * x + b * x + c
                    graphfunc = xterm(true, a, 2, 4) + xterm(false, b, 1, 4) + xterm(false, c, 0, 4)
                    graphpoints += ';(' + x1 + ", " + y1 + ",-5)"
                    graphdata += ';(' + x0 + ':' + x1 + '): y=' + graphfunc
                    if (a == 0) outit("\nline");
                    else outit("\nparabola")
                    outit(" from (" + my(x0) + ", " + my(y0) + "), slope " + my(m) + ": ")
                    if (nox) outit("f(x)= " + graphfunc)
                    else {
                        outit("f(" + my(x) + ")=" + graphfunc + "= " + my(y))
                        if (x0 <= x && x <= x1) {
                            outit(" *****");
                            graphxline += '\n(' + x + ", " + y + ",-5);x=" + x
                        }
                    }
                }
                outit("\nend at (" + my(x1) + ", " + my(y1) + "), slope " + my(2 * a * x1 + b))
                xd = (xto - xfr) / 10;
                yd = (yto - yfr) / 10
                graphdata += '\nx:' + (xfr - xd) + ' to ' + (xto + xd) + '\ny:' + (yfr - yd) + ' to ' + (yto + yd) + '\n' + graphpoints + graphxline
                val1 = escape(graphdata.replace(/\n/g, "<br>").replace(/;/g, "<sc>"))
                localStorage.setItem("graphdata", val1)
                // document.theForm.output.value += '\n---------\n'+graphdata
                // document.theForm.output.value += "\n"+yfr+','+yto+','+yd
                outit("\n")
                document.theForm.x.focus();
            }
        };
    </script>
    <div id="calctainer">
        <a href="index.php"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <h1>Quadtratic Spline</h1>
        <form name="theForm">
            <textarea name="output" id='result' tabindex="1" rows=10></textarea>
            <div id="inputLabel">
                <label for="input">Spline interpolate these points:</label>
            </div>
            <textarea name="input" id="input" rows=5></textarea>

            <input name="calc" id="calcButton" type="button" class="calcButton" value="Calculate" onClick="calc1()" tabindex="6" />
            <div id="buttons">
                <label for="x">Find fx) for x=</label><input type="text" id="x" name="x" size=10 value="" tabindex="2">
                <label for="line"> line through 1st 2 points: </label><input name="line" id="line" type="checkbox" onClick="calc1()" title="line thru first two points" checked>

                <input name="graphbut" Value="graph" type="button" onClick="calc1();window.open('graphs.php')" title="send screen to grapher">
            </div>
            <div id="saveload">
                <input name="savebut" Value="Save" type="button" onClick="savestuff();document.theForm.input.focus()" />
                <input name="clear" type="button" value="clear" onClick="clear1()" tabindex="6" />
                <input name="loadbut" Value="Load" type="button" onClick="loadstuff();calc1();document.theForm.input.focus()" />
                <input type="button" value="8 place" id="frac" onClick="swfrac(true)" title="output format" />
            </div>
        </form>
    </div>
    <script>
        ls = decodeURIComponent(location.search)
        if (ls.search(/\?/) == 0) {
            if (ls == '?&') {
                loadstuff(true, 'graphdata')
            } else {
                lsf = ls.slice(1).split("&")
                if (lsf[0].length == 0 && lsf[1].length > 0) {
                    loadstuff(true, lsf[1])
                } else {
                    document.theForm.input.value = lsf[0].split(";").join('\n') + '\n'
                }
            }
        }
    </script>
</body>

</html>