<!DOCTYPE html>
<html lang="en">

<head>
    <title>Discrete Probability</title>
    <meta charset="utf-8">
    <script src="myfunctions.js"></script>
    <script src="statfns.js"></script>
    <script>
        zeta = String.fromCharCode(951)
        alpha = String.fromCharCode(945)
        Sigma = String.fromCharCode(931);
        sigma = String.fromCharCode(963);
        mu = String.fromCharCode(956);
        divide = String.fromCharCode(247)
        radical = String.fromCharCode(8730)
        P2 = String.fromCharCode(178); //squared
        degrees = true
        var pval = 0
        var binn = 0;
        var binp = 0.5;
        binq = 1 - binp
        var calc1Yes = false
        var xfrom = 0;
        var xthru = 0;
        var xcond = 'true'
        var lastdid = 0;
        var xstats = false
        // ---------------------------------------------------*/
        function doit(v) {
            if (v >= 0) lastdid = v
            if (lastdid == 9) boxpick(document.theForm.boxtype.value, document.theForm.boxpick.value)
            if (lastdid == 2) dicetoss(document.theForm.noofdice.value, document.theForm.nooffaces.value)
            if (lastdid == 3) pickballs(document.theForm.blueballs.value, document.theForm.whiteballs.value, document.theForm.PickBalls.value)
            if (lastdid == 4) binomial()
        }
        // ---------------------------------------------------*/
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 27) cla();
        };
        // ---------------------------------------------------*/
        function cla() {
            if (document.theForm.output.value == '')
                document.theForm.output.value = "Probability Words:\nSample Space, conditional probability, given that\nFavorable Event, things we are counting, could use words like NOT, OR, AND \nProbability: P(event) = N(event) ÷ N(sample space)\nOdds:(for versus against) = N(event) : [N(sample space)-N(event)]\nThings to count:\n    —   adding up the total of the numbers on a set of dice\n    —   picking two kinds of things from an urn\n    —   selecting different types of boxes\n    —   counting Bernoulli trial events(binomial probability where p+q = 1.0)\nExpected value = average(mean)\nEmpirical(data from experiments) vs theoretical\nLaw of Large Numbers\nMutually exclusive events\n"
            else {
                document.theForm.output.value = '';
                document.theForm.input.focus();
            }
        }
        // ---------------------------------------------------*/
        function prob() {
            if (document.theForm.output.value.slice(0, 18) == "Probability Words:") document.theForm.output.value = ''
            var binp = cleanx(document.theForm.binp.value, true, false);
            var binn = cleanx(document.theForm.binn.value, true, false);
            var propor = binn * binp == mean
        }
        // ---------------------------------------------------*/
        function CIval() {
            binp = cleanx(document.theForm.binp.value, true, false);
            binn = cleanx(document.theForm.binn.value, true, false);
            mean = cleanx(document.theForm.mean.value, true, false);
            sdev = cleanx(document.theForm.sdev.value, true, false);
            sqrsample = Math.sqrt(cleanx(document.theForm.sample.value, true, false))
            pval = cleanx(document.theForm.pval.value, true, false);
            if (pval > 1) pval = pval / 100
            z2 = cdfinv(pval / 2 + 0.5)
            z1 = -z2
            x1 = z1 * sdev / sqrsample + mean
            x2 = z2 * sdev / sqrsample + mean
            propor = binn * binp == mean
            p1 = round4(x1 / binn);
            p2 = round4(x2 / binn);
            x1 = round4(x1);
            x2 = round4(x2);
            z1 = round4(z1);
            z2 = round4(z2)
            if (x1 != z1) document.theForm.output.value += "x = z * " + sigma + " + " + mu + ";  "
            if (propor) document.theForm.output.value += "P(" + p1 + " < p < " + p2 + ") = "
            if (x1 != z1) document.theForm.output.value += "P(" + x1 + " < x < " + x2 + ") = "
            document.theForm.output.value += "P(" + z1 + " < " + przt() + " < " + z2 + ") = " + round4(100 * pval) + "% C.I." + prdf()
            z1 = cdfinv(pval);
            z2 = -z1
            x1 = z1 * sdev / sqrsample + mean;
            x2 = z2 * sdev / sqrsample + mean
            propor = binn * binp == mean
            p1 = round4(x1 / binn);
            p2 = round4(x2 / binn);
            x1 = round4(x1);
            x2 = round4(x2);
            z1 = round4(z1);
            z2 = round4(z2)
            if (propor) document.theForm.output.value += "P(p < " + p1 + ") = "
            if (x1 != z1) document.theForm.output.value += "P(x < " + x1 + ") = "
            document.theForm.output.value += "P(" + przt() + " < " + z1 + ") = " + my(pval) + prdf()
            if (propor) document.theForm.output.value += "P(" + p2 + " < p) = "
            if (x2 != z2) document.theForm.output.value += "P(" + x2 + " < x) = "
            document.theForm.output.value += "P(" + z2 + " < " + przt() + ") = " + my(pval) + prdf()
        }
        // ------------------------------------
        function cols(xarg, i) {
            if (typeof(xarg) == 'number')
                if ((int(xarg) + '').length > i) xarg = my(xarg, 6)
            if ((xarg + '').indexOf('e') > -1) {
                var xe = (xarg + '').indexOf('e');
                var x1 = (xarg + '').slice(0, xe);
                var x2 = (xarg + '').slice(xe)
                var i1 = i - x2.length;
                if (i1 < x1.length) x1 = x1.slice(0, i1)
                xarg = x1 + x2
            }
            var xi = "                                        " + ('' + xarg).slice(0, i);
            return xi.substr(xi.length - i) + " "
        }
        // ---------------------------------------------------*/
        function pickballs(a, b, c) {
            function ncpr(x1, x2) {
                if (urnmode < 1) return ncr(x1, x2);
                else if (urnmode < 2) return npr(x1, x2);
                else return Math.pow(x1, x2)
            }
            lastdid = 3
            a = Number(a);
            b = Number(b);
            c = Number(c);
            savepicks = '  X   not X     N(X)    X*N(X)     P(X)      X*P(X)      ' + Sigma + 'N(X)    ' + Sigma + 'P(X)     1-' + Sigma + 'P(X)\n'
            savepicks += '----- ----- --------- --------- ---------- ---------- --------- ---------- ----------\n'
            N = 0;
            NX = 0;
            U = ncpr(a + b, c);
            P = 0;
            E = 0;
            UU = ncpr(c, c)
            X0 = Math.max(0, c - b);
            XN = Math.min(c, a);
            if (urnmode == 2) XN = c
            getx(X0, XN)
            for (X = xfrom; X <= xthru; X++) {
                if (eval(xcond)) {
                    if (urnmode < 2) n = ncr(a, X) * ncr(b, c - X) * UU;
                    else n = ncr(c, X) * Math.pow(a, X) * Math.pow(b, c - X)
                    nX = n * X;
                    p = n / U;
                    N += n;
                    NX += nX;
                    P += p;
                    e = X * p;
                    E += e
                    statsxf += X + ',' + n + ' '
                    savepicks += cols(X, 5) + cols(c - X, 5) + cols(n, 9) + cols(nX, 9) + cols(my(p), 10) + cols(my(e), 10) + cols(N, 9) + cols(my(P), 10) + cols(my(1 - P), 10) + '\n'
                }
            }
            savepicks += '            --------- --------- ---------- ---------- expected value\n'
            document.theForm.output.value = savepicks + 'totals:     ' + cols(N, 9) + cols(NX, 9) + cols(my(P), 10) + cols(my(E), 10) + '= ' + NX + '/' + N + '\n'
            if (xstats) window.open('stats.php?' + statsxf + ' \\w: \\\\')
        }
        // ---------------------------------------------------*/
        function dicetoss(x, f) {
            lastdid = 2

            function blddice(n, f) { // n dice, f faces
                var a = [0];
                for (var i = 0; i < f; i++) a[i + 1] = 1
                for (var m = 2; m <= n; m++) {
                    b = a.slice(0);
                    a = [0]
                    for (i = 0; i <= m * f; i++) a[i] = 0
                    for (i = 0; i < f; i++)
                        for (var j = 0; j < b.length; j++) a[j + i + 1] += b[j]
                }
                return a
            }

            xTOT = Math.pow(f, x);
            getx(x, f * x)
            document.theForm.output.value = '   X  N(X)            P(X)           X*P(X)             ' + Sigma + '(N)           ' + Sigma + '(P)\n---- ----- --------------------- --------------------- ------- ------------------'

            tY = 0;
            tz = 0;
            tiz = 0;
            d = blddice(x, f)
            for (X = xfrom; X <= xthru; X++) {
                if (X <= f * x) Y = d[X];
                else Y = 0
                if (eval(xcond)) {
                    z = Y / xTOT;
                    tY += Y;
                    tz += z;
                    tiz += X * z
                    statsxf += X + ',' + Y + ' '
                    document.theForm.output.value += '\n' + cols(X, 4) + cols(Y, 5) + cols(my(z), 21) + cols(my(X * z), 21) + cols(tY, 7) + cols(my(tz), 18)
                }
            }
            document.theForm.output.value += '\n---- ----- --------------------- ---------------------'
            document.theForm.output.value += '\n' + cols(tY, 4) + '/' + cols(xTOT, 4) + cols(my(tz), 21) + cols(my(tiz), 21) + '\n'
            if (xstats) window.open('stats.php?' + statsxf + ' \\w: \\\\')
        }
        // ---------------------------------------------------*/
        function boxpick(mm, nn) {
            mm = Number(mm) // number of different types of items
            nn = Number(nn) // number selected
            nbox = ncr(mm + nn - 1, mm - 1)
            document.theForm.output.value = mm + ' types of boxes, ' + nn + ' selected, nCr(' + (mm + nn - 1) + ',' + (nn) + ') = ' + nbox + ' ways\n'
            A = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.slice(0, mm)
            dobox(A, nn, '');
            document.theForm.output.value += '\n';
            // -----------------*/
            function lotsof(a, x) {
                // var b=''; while(x>0){b+=a;x--}; return b
                if (x > 0) return x + a;
                else return ''
            }
            // -----------------*/
            function dobox(A, n, X) {
                var B = A.slice(0, 1);
                var C = A.slice(1)
                if (C.length == 0) document.theForm.output.value += X + lotsof(B, n) + '; '
                else {
                    for (var D = 0; D <= n; D++) dobox(C, n - D, X + lotsof(B, D))
                }
            }
        }
        // ---------------------------------------------------*/
        function getx(lowx, highx) {
            if (document.theForm.xfrom.value != '') xfrom = cleanx(document.theForm.xfrom.value, true, false);
            else xfrom = lowx
            if (document.theForm.xthru.value != '') xthru = cleanx(document.theForm.xthru.value, true, false);
            else xthru = highx
            if (document.theForm.disprime.checked) xPrime = "prime(X)[0]=='i'"
            else if (document.theForm.dnotprime.checked) xPrime = "prime(X)[0]!='i'"
            else xPrime = "true"
            xcond = slim(document.theForm.xcond.value.toUpperCase())
            if (xcond.length == 0) xcond = xPrime;
            else xcond = '(' + xcond + ')'
            xandor = document.theForm.xandor.value
            if (xandor == "or") xcond = xPrime + " || " + xcond
            else if (xandor == "and") xcond = xPrime + " && " + xcond
            statsxf = "\\xf: "
        }
        // ---------------------------------------------------*/
        function binomial() {
            with(Math) {
                lastdid = 4
                binn = cleanx(document.theForm.binn.value, true, false);
                getx(0, binn)
                binp = cleanx(document.theForm.binp.value, true, false);
                if (binp > 1) binp = binp / 100;
                if (binp > 1 || binp < 0) binp = 0.05;
                var binq = 1 - binp;
                document.theForm.output.value = "# of   # of    n = " + binn + "; p = " + round4(binp) + "; q = " + round4(binq) + "; P(x = " + xfrom + ") = nCx p^x q^(n-x) = " + (ncr(binn, xfrom) * pow(binp, xfrom) * pow(binq, binn - xfrom)).toFixed(7)
                document.theForm.output.value += "\nHeads     Ways      P(x)     " + Sigma + "P(x)    1-" + Sigma + "P(x)    x*P(x)    Normal    C.D.F.  1-CDF\n----- -------- --------- --------- --------- --------- --------- --------- ---------\n";
                var sy = 0;
                syy = 0;
                ny = 0;
                ey = 0;
                sn = 0
                var mean = binn * binp;
                var sdev = sqrt(binn * binp * binq)
                var c3 = '',
                    c4 = '',
                    c5 = '',
                    c6 = ''
                for (X = xfrom; X <= xthru; X++) {
                    if (eval(xcond)) {
                        ncrn = ncr(binn, X);
                        y = ncrn * pow(binp, X) * pow(binq, binn - X);
                        yy = y * pow(2, binn);
                        sy += y;
                        syy += yy
                        if (isNaN(y)) {
                            document.theForm.output.value += "### overflow ### can not compute\n";
                            break
                        }
                        var x1 = X - .5,
                            x2 = X + .5
                        var z1 = (x1 - mean) / (sdev),
                            z2 = (x2 - mean) / (sdev);
                        ay = zcdf(z2) - zcdf(z1)
                        ny += ay
                        ey += X * y
                        sn += ncrn
                        statsxf += X + ',' + myround(yy, 12) + ' '
                        document.theForm.output.value += cols(X, 5) + cols(ncrn, 8) + cols(my(y), 9) + cols(my(sy), 9) + cols(my((1 - sy)), 9) + cols(my(X * y), 9) + cols(my(ay), 9) + cols(my(ny), 9) + cols(my(1 - ny), 9) + "\n"
                    }
                }
                document.theForm.output.value += "      -------- --------- --------- --------- --------- --------- ---------\n";
                document.theForm.output.value += Sigma + "     " + cols(sn, 8) + cols(my(sy), 9) + "                    " + (cols(my(ey), 9)) + "\n"
                document.theForm.output.value += mu + " =(n p) = " + round4(binn * binp) + ";  " + sigma + P2 + " = " + "( n p q ) = " + round4(binn * binp * binq) + ";  " + sigma + " = " + radical + "( n p q ) = " + round4(sqrt(binn * binp * binq)) + "\n"
                if (xstats) window.open('stats.php?' + statsxf + ' \\w: \\\\')
                if (binp * binn < 5) {
                    document.theForm.output.value += "p*n=" + round4(binp * binn) + " is < 5; do not use the Normal Approximation";
                    return
                }
                if (binq * binn < 5) {
                    document.theForm.output.value += "q*n=" + round4(binq * binn) + " is < 5; do not use the Normal Approximation";
                    return
                }
            }
        }
        // ---------------------------------------------------*/
        function minsamp() {
            pval = cleanx(document.theForm.pval.value, true, false);
            if (pval > 1) pval = pval / 100
            var binp = cleanx(document.theForm.binp.value, true, false);
            var binq = 1 - binp;
            var zalpha = cdfinv(.5 + pval / 2);
            var Err1 = cleanx(document.theForm.error.value, true, false)
            document.theForm.output.value += "Minimum Sample size: " + zeta + "=(Z(" + alpha + "/2)" + sigma + divide + "E)" + P2 + " = "
            document.theForm.output.value += round4((Math.pow(zalpha * document.theForm.sdev.value / Err1, 2))) + " OR " + zeta + "=(Z(" + alpha + "/2)" + divide + "E)" + P2 + "pq = " + round4((Math.pow(zalpha / Err1, 2)) * binp * binq) + "\n"
        }
        // ---------------------------------------------------*/
        function calcnr() {
            if (document.theForm.Nval.value == '') document.theForm.Nval.value = 5
            if (document.theForm.Rval.value == '') document.theForm.Rval.value = 3
            Nval = eval(document.theForm.Nval.value);
            if (isNaN(Nval)) return
            Rval = eval(document.theForm.Rval.value);
            if (isNaN(Rval)) return
            if (document.theForm.output.value != '') document.theForm.output.value += "\n\n"
            document.theForm.output.value += "repetitions allowed: n^r= " + Math.pow(Nval, Rval)
            document.theForm.output.value += "\nno repetitions: order matters: nPr= " + npr(Nval, Rval)
            document.theForm.output.value += "; order doesn't matter: nCr= " + ncr(Nval, Rval)
            document.theForm.output.value += "\nall possible arrangements of all values: n!= " + fact(Nval)
            document.theForm.output.value += "\nPower Set: 2^n= " + Math.pow(2, Nval)
        }
        // ---------------------------------------------------*/
        xconds = ['X%2==0', 'X%2==1', 'X>7 ', 'X>=6', 'X!=7', 'X<=6', 'X<=4||X>=8'];
        xcondi = 0
        // ---------------------------------------------------*/
        function switchandor() {
            fixandor();
            xandor = document.theForm.xandor.value
            if (xandor == "and") document.theForm.xandor.value = "or"
            if (xandor == "or") document.theForm.xandor.value = "and"
        }
        // ---------------------------------------------------*/
        function fixandor() {
            if ((document.theForm.disprime.checked || document.theForm.dnotprime.checked) && document.theForm.xcond.value.trim().length > 0) {
                if (document.theForm.xandor.value.length == 0) document.theForm.xandor.value = "and"
            } else document.theForm.xandor.value = ""
        }
    </script>
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <h1>Discrete Distribution</h1>
        <form name="theForm">
            <textarea name="output" rows=25 cols=68 onkeyup="enter(event)"></textarea>
            <input name="stats" type="button" value="Stats" onClick="xstats=true;if (lastdid==0) lastdid=2;doit();xstats=false">
            <input name="clear1" type="button" value="Clear" onClick="document.theForm.output.value ='';cla();">
            <br><br>

            <h2 style="margin-top: 400px;">Combinations &amp; Permutations</h2>

            <label for="nval">N:</label>
            <input class="shortinput" type="text" id="nval" name="Nval" size=1><br><br>
            <label for="rval">R:</label>
            <input class="shortinput" type="text" id="rval" name="Rval" size=1>

            <input name="calc1" type="button" value="Enter" onClick="calcnr()" />

            <br><br><br>
            <h2><a href="javascript: window.open('2dice.php','','top=100,left=100')">Dice</a> </h2>
            <label for="noOfDice">Number of Dice:</label>
            <input class="shortinput" type="text" id="noOfDice" name="noofdice" size=1 value="2" onClick="noofdice.value=(Number(noofdice.value)+1); noofdice.select()"> <br><br>
            <label for="faces">Number of Faces:</label>
            <input class="shortinput" type="text" id="faces" name="nooffaces" size=1 value="6" onClick="nooffaces.value=(Number(nooffaces.value)+1); nooffaces.select()">
            <input name="DiceToss" type="button" value="Enter" onClick="fixandor(); doit(2)">
            <br><br>

            <h2><a href="javascript: window.open('box.php','','top=100,left=100')">Box</a></h2>
            <label for="boxTypes">Types:</label>
            <input class="shortinput" type="text" id="boxTypes" name="boxtype" size=1 value="4" onClick="boxtype.value=(Number(boxtype.value)+1); boxtype.select()"><br><br>
            <label for="boxpick">Pick:</label>
            <input class="shortinput" type="text" id="boxpick" name="boxpick" size=1 value="5" onClick="boxpick.value=(Number(boxpick.value)+1); boxpick.select()">
            <input name="boxdo" type="button" value="Enter" onClick="doit(9)">
            <br><br>

            <h2><a href="javascript: window.open('10coins.php','','top=100,left=100')">Coins (Binomial)</a></h2>
            <label for="binn">n:</label>
            <input class="shortinput" type="text" id="binn" name="binn" size=1 value="10" onClick="binn.value=(Number(binn.value)+1); binn.select()"><br><br>
            <label for="binp">p:</label>
            <input class="shortinput" type="text" id="binp" name="binp" size=1 value="0.5">
            <input name="Binomial" type="button" value="Enter" onClick="doit(4)"><br><br>

            <h2><a href="javascript: window.open('urn.php','','top=100,left=100')">Urn</a></h2>

            <label for="blueballs"># X:</label>
            <input class="shortinput" type="text" id="blueballs" name="blueballs" size=1 value="6" onClick="blueballs.value=(Number(blueballs.value)+1); blueballs.select()"> <br><br>
            <label for="whiteballs"># Not X:</label>
            <input class="shortinput" type="text" id="whiteballs" name="whiteballs" size=1 value="9" onClick="whiteballs.value=(Number(whiteballs.value)+1); whiteballs.select()"> <br><br>
            <label for="pickBalls">Pick:</label>
            <input class="shortinput" type="text" id="pickBalls" name="PickBalls" size=1 value="8" onClick="PickBalls.value=(Number(PickBalls.value)+1); PickBalls.select()"> <br><br>



            <label for="disprime">Prime</label><input id="disprime" name="disprime" type="checkbox" onClick="if (disprime.checked) dnotprime.checked=false;fixandor();doit()">

            <label for="dnotprime">Not Prime</label><input name="dnotprime" id="dnotprime" type="checkbox" onClick="if (dnotprime.checked) disprime.checked=false;fixandor();doit()">


            <input name='xandor' type='button' value='' onClick='switchandor();doit()' />

            <input class="shortinput" type="text" name="xcond" size=20 value="" onClick="document.theForm.xcond.value=xconds[xcondi++]; if (xcondi>=xconds.length) xcondi=0; fixandor();doit()"><br><br><br>
            <label for="xfrom">From:</label>
            <input class="shortinput" type="text" id="xfrom" name="xfrom" size=1>
            <label for="xthru">Thru:</label>
            <input class="shortinput" type="text" id="xthru" name="xthru" size=1>
            <input name="clear" type="button" value="Clear" onClick="dnotprime.checked=false; disprime.checked=false; document.theForm.xandor.value=''; document.theForm.xcond.value=''; document.theForm.xfrom.value=''; document.theForm.xthru.value=''">
            <input type="button" value="nCr" id="urntxt" onClick="urnmode=++urnmode%3;document.getElementById('urntxt').value=urntext[urnmode];doit(3)" title="type of selection">
            <input name="PickBall" type="button" value="Enter" onClick="doit(3)"><br><br><br>


        </form>
        <script>
            urnmode = 0;
            urntext = ['nCr', 'nPr', 'n^r']
            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                lsd = ls.slice(1).split("&")
                if (lsd[0] == "B") {
                    document.theForm.boxtype.value = lsd[1];
                    document.theForm.boxpixk.value = lsd[2]
                } else if (lsd[0] == "D") {
                    document.theForm.noofdice.value = lsd[1];
                    document.theForm.nooffaces.value = lsd[2]
                } else if (lsd[0] == "U") {
                    document.theForm.blueballs.value = lsd[1];
                    document.theForm.whiteballs.value = lsd[2];
                    document.theForm.PickBalls.value = lsd[3]
                } else if (lsd[0] == "C") {
                    document.theForm.binn.value = lsd[1];
                    document.theForm.binp.value = lsd[2]
                }
            } else cla()
        </script>
    </div>
</body>

</html>