<!DOCTYPE html>
<html lang="en">

<head>
    <title>Continuous Probability</title>
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
        var mean = 0;
        var sdev = 1
        var x1 = 0;
        var x2 = 0
        var z1 = 0;
        var z2 = 0
        var pval = 0
        var binn = 0;
        var binp = 0.5;
        binq = 1 - binp
        var calc1Yes = false
        inhist = ["IQR:-0.6745<z<0.6745;-1<z<1;-2<z<2;-3<z<3"]
        var xfrom = 0;
        var xthru = 0;
        var xcond = 'true'
        var lastdid = 0;
        var xstats = false
        // ---------------------------------------------------*/
        function doit(v) {
            if (v >= 0) lastdid = v
            if (lastdid == 7) calcCk()
            if (lastdid == 8) calcCp()
            if (lastdid == 9) boxpick(document.theForm.boxtype.value, document.theForm.boxpick.value)
            if (lastdid == 2) dicetoss(document.theForm.noofdice.value, document.theForm.nooffaces.value)
            if (lastdid == 3) pickballs(document.theForm.blueballs.value, document.theForm.whiteballs.value, document.theForm.PickBalls.value)
            if (lastdid == 4) binomial()
        }
        // ---------------------------------------------------*/
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) calc1();
            if (charCode == 27) cla();
        };
        // ---------------------------------------------------*/
        function cla() {
            if (document.theForm.output.value == '' && document.theForm.input.value == '')
                document.theForm.output.value = "Probability Words:\nSample Space, conditional probability, given that\nFavorable Event, things we are counting, could use words like NOT, OR, AND \nProbability: P(event) = N(event) ÷ N(sample space)\nOdds:(for versus against) = N(event) : [N(sample space)-N(event)]\nThings to count:\n    —   adding up the total of the numbers on a set of dice\n    —   picking two kinds of things from an urn\n    —   selecting different types of boxes\n    —   counting Bernoulli trial events(binomial probability where p+q = 1.0)\nExpected value = average(mean)\nEmpirical(data from experiments) vs theoretical\nLaw of Large Numbers\nMutually exclusive events\n"
            else {
                document.theForm.output.value = '';
                document.theForm.input.focus();
            }
        }
        // ---------------------------------------------------*/
        function prob() {
            if (document.theForm.output.value.slice(0, 18) == "Probability Words:") document.theForm.output.value = ''
            var mean = cleanx(document.theForm.mean.value, true, false);
            var sdev = cleanx(document.theForm.sdev.value, true, false);
            var sqrsample = Math.sqrt(cleanx(document.theForm.sample.value, true, false))
            var propor = false
            var x1 = cleanx(document.theForm.x1.value, true, false)
            var x2 = cleanx(document.theForm.x2.value, true, false)
            var z1 = (x1 - mean) / (sdev / sqrsample)
            if (x2 == undefined) {
                var z2 = "";
                x2 = ""
            } else {
                z2 = (x2 - mean) / (sdev / sqrsample);
                x2 = round4(x2);
                z2 = round4(z2)
            }
            x1 = round4(x1);
            z1 = round4(z1)
            document.theForm.z1.value = z1
            document.theForm.z2.value = z2
            document.theForm.x1.value = x1
            document.theForm.x2.value = x2
            if (!calc1Yes || x2 === "") {
                document.theForm.output.value += ((x1 != z1) ? "P(x < " + x1 + ") = " : "") + "P(" + przt() + " < " + round4(z1) + ") = " + my(cdf(z1)) + prdf();
                document.theForm.pval.value = my(cdf(z1))
            }
            if (x2 !== "") {
                document.theForm.output.value += ((x1 != z1) ? "P(" + x1 + " < x < " + x2 + ") = " : "") + "P(" + round4(z1) + " < " + przt() + " < " + round4(z2) + ") = " + my(cdf(z2) - cdf(z1)) + prdf()
                if (!calc1Yes) {
                    document.theForm.output.value += ((x2 != z2) ? "P(" + x2 + " < x) = " : "") + "P(" + round4(z2) + " < " + przt() + ") = " + my(1 - cdf(z2)) + prdf();
                    document.theForm.pval.value = my(cdf(z1))
                }
            } else {
                document.theForm.output.value += ((x1 != z1) ? "P(" + x1 + " < x) = " : "") + "P(" + my(z1) + " < " + przt() + ") = " + my(1 - cdf(z1)) + prdf();
                document.theForm.pval.value = my(cdf(z1))
            }
        }
        // ---------------------------------------------------*/
        function zval() {
            if (document.theForm.output.value.slice(0, 18) == "Probability Words:") document.theForm.output.value = ''
            var mean = cleanx(document.theForm.mean.value, true, false);
            var sdev = cleanx(document.theForm.sdev.value, true, false);
            var sqrsample = Math.sqrt(cleanx(document.theForm.sample.value, true, false))
            var x1 = cleanx(document.theForm.x1.value, true, false)
            var x2 = cleanx(document.theForm.x2.value, true, false)
            var z1 = (x1 - mean) / (sdev / sqrsample)
            if (x2 == undefined) {
                var z2 = "";
                x2 = ""
            } else {
                z2 = (x2 - mean) / (sdev / sqrsample);
                x2 = round4(x2);
                z2 = round4(z2)
            }
            x1 = round4(x1);
            z1 = round4(z1)
            if (x1 != z1 && !calc1Yes) {
                document.theForm.output.value += 'x1 = ' + x1 + '; ' + (z2 == '' ? '' : 'x2 = ' + x2 + '; ') + mu + ' = ' + mean + '; ' + sigma + ' = ' + sdev
                if (sqrsample != 1) document.theForm.output.value += "; " + String.fromCharCode(951) + " = " + round4(sqrsample * sqrsample) + ";(" + sigma + String.fromCharCode(247) + String.fromCharCode(8730) + String.fromCharCode(951) + ") = " + round4(sdev / sqrsample)
                document.theForm.output.value += "\nz =( x1 - " + mu + " ) / " + ((sqrsample != 1) ? "(" + sigma + String.fromCharCode(247) + String.fromCharCode(8730) + String.fromCharCode(951) + ")" : sigma) + " = " + z1 + prdf()
                if (z2 !== '') document.theForm.output.value += "z =( x2 - " + mu + " ) / " + ((sqrsample != 1) ? "(" + sigma + String.fromCharCode(247) + String.fromCharCode(8730) + String.fromCharCode(951) + ")" : sigma) + " = " + z2 + prdf()
            }
            document.theForm.z1.value = z1
            document.theForm.z2.value = z2
            document.theForm.x1.value = x1
            document.theForm.x2.value = x2
        }
        // ---------------------------------------------------*/
        function xval() {
            z1 = document.theForm.z1.value.replace(/[^0-9\-\+\.]/g, "")
            z2 = document.theForm.z2.value.replace(/[^0-9\-\+\.]/g, "")
            mean = cleanx(document.theForm.mean.value, true, false);
            sdev = cleanx(document.theForm.sdev.value, true, false);
            sqrsample = Math.sqrt(cleanx(document.theForm.sample.value, true, false))
            x1 = cleanx(z1, true, false) * sdev / sqrsample + mean
            if (z2 === "") x2 = "";
            else x2 = cleanx(z2, true, false) * sdev / sqrsample + mean
            if (x1 != z1 && !calc1Yes) {
                document.theForm.output.value += mu + ' = ' + mean + '; ' + sigma + ' = ' + sdev + ((sqrsample != 1) ? ";(" + sigma + String.fromCharCode(247) + String.fromCharCode(8730) + String.fromCharCode(951) + ") = " + round4(sdev / sqrsample) : "")
                document.theForm.output.value += "\nx = " + mu + " + " + z1 + ((sqrsample != 1) ? "(" + sigma + String.fromCharCode(247) + String.fromCharCode(8730) + String.fromCharCode(951) + ")" : sigma) + " = " + round4(x1) + ";  "
                if (x2 !== "") document.theForm.output.value += "x = " + mu + " + " + z2 + ((sqrsample != 1) ? "(" + sigma + String.fromCharCode(247) + String.fromCharCode(8730) + String.fromCharCode(951) + ")" : sigma) + " = " + round4(x2)
                document.theForm.output.value += '\n'
            }
            document.theForm.z1.value = z1
            document.theForm.z2.value = z2
            document.theForm.x1.value = x1
            document.theForm.x2.value = x2
        }
        // ---------------------------------------------------*/
        function CIval() {
            mean = cleanx(document.theForm.mean.value, true, false);
            sdev = cleanx(document.theForm.sdev.value, true, false);
            sqrsample = Math.sqrt(cleanx(document.theForm.sample.value, true, false))
            pval = cleanx(document.theForm.pval.value, true, false);
            if (pval > 1) pval = pval / 100
            z2 = cdfinv(pval / 2 + 0.5)
            z1 = -z2
            x1 = z1 * sdev / sqrsample + mean
            x2 = z2 * sdev / sqrsample + mean
            propor = false
            x1 = round4(x1);
            x2 = round4(x2);
            z1 = round4(z1);
            z2 = round4(z2)
            if (x1 != z1) document.theForm.output.value += "x = z * " + sigma + " + " + mu + ";  "
            if (x1 != z1) document.theForm.output.value += "P(" + x1 + " < x < " + x2 + ") = "
            document.theForm.output.value += "P(" + z1 + " < " + przt() + " < " + z2 + ") = " + round4(100 * pval) + "% C.I." + prdf()
            z1 = cdfinv(pval);
            z2 = -z1
            x1 = z1 * sdev / sqrsample + mean;
            x2 = z2 * sdev / sqrsample + mean
            x1 = round4(x1);
            x2 = round4(x2);
            z1 = round4(z1);
            z2 = round4(z2)
            if (x1 != z1) document.theForm.output.value += "P(x < " + x1 + ") = "
            document.theForm.output.value += "P(" + przt() + " < " + z1 + ") = " + my(pval) + prdf()
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
            lastdid = 3;
            document.theForm.input.value = ''
            a = Number(a);
            b = Number(b);
            c = Number(c)
            N = 0;
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
                    N += n;
                    p = n / U;
                    P += p;
                    e = X * p;
                    E += e
                    statsxz += X + ',' + p + ' '
                    print(cols(X, 5) + cols(c - X, 5) + cols(n, 8) + cols(my(p), 10) + cols(my(e), 10) + cols(N, 8) + cols(my(P), 10) + cols(my(1 - P), 10))
                }
            }
            print('            -------- ---------- ----------')
            print('totals:     ' + cols(N, 8) + cols(my(P), 10) + cols(my(E), 10))
            document.theForm.output.value = '  X   not X   N(X)       P(X)       X*P(X)      ' + Sigma + 'N      ' + Sigma + 'P(X)    1-' + Sigma + 'P(X)\n----- ----- -------- ---------- ---------- -------- ---------- ----------\n' + document.theForm.input.value
            document.theForm.input.value = ''
            if (xstats) window.open('regress.php?' + statsxz + '\\\\')
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
                    statsxz += X + ',' + z + ' '
                    document.theForm.output.value += '\n' + cols(X, 4) + cols(Y, 5) + cols(my(z), 21) + cols(my(X * z), 21) + cols(tY, 7) + cols(my(tz), 18)
                }
            }
            document.theForm.output.value += '\n---- ----- --------------------- ---------------------'
            document.theForm.output.value += '\n' + cols(tY, 4) + '/' + cols(xTOT, 4) + cols(my(tz), 21) + cols(my(tiz), 21) + '\n'
            if (xstats) window.open('regress.php?' + statsxz + '\\\\')
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
            statsxz = "\\xf: "
        }
        // ---------------------------------------------------*/
        function binomial() {
            with(Math) {
                lastdid = 4
                document.theForm.output.value = "# of   # of    n = " + binn + "; p = " + round4(binp) + "; q = " + round4(binq) + "; P(x = " + xfrom + ") = nCx p^x q^(n-x) = " + (ncr(binn, xfrom) * pow(binp, xfrom) * pow(binq, binn - xfrom)).toFixed(7)
                document.theForm.output.value += "\nHeads  Ways      P(x)     " + Sigma + "P(x)    1-" + Sigma + "P(x)    x*P(x)    Normal    C.D.F.  1-CDF\n----- ----- --------- --------- --------- --------- --------- --------- ---------\n";
                var sy = 0;
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
                        sy += y;
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
                        statsxz += X + ',' + y + ' '
                        document.theForm.output.value += cols(X, 5) + cols(ncrn, 5) + cols(my(y), 9) + cols(my(sy), 9) + cols(my((1 - sy)), 9) + cols(my(X * y), 9) + cols(my(ay), 9) + cols(my(ny), 9) + cols(my(1 - ny), 9) + "\n"
                    }
                }
                document.theForm.output.value += "      ----- --------- --------- --------- --------- --------- ---------\n";
                document.theForm.output.value += Sigma + "     " + cols(sn, 5) + cols(my(sy), 9) + "                    " + (cols(my(ey), 9)) + "\n"
                document.theForm.x1.value = xfrom - 0.5;
                document.theForm.x2.value = xthru + 0.5;
                document.theForm.mean.value = mean;
                document.theForm.sdev.value = sdev;
                document.theForm.output.value += mu + " =(n p) = " + round4(binn * binp) + ";  " + sigma + P2 + " = " + "( n p q ) = " + round4(binn * binp * binq) + ";  " + sigma + " = " + radical + "( n p q ) = " + round4(sqrt(binn * binp * binq)) + "\n"
                if (xstats) window.open('regress.php?' + statsxz + '\\\\')
                if (binp * binn < 5) {
                    document.theForm.output.value += "p*n=" + round4(binp * binn) + " is < 5; do not use the Normal Approximation";
                    return
                }
                if (binq * binn < 5) {
                    document.theForm.output.value += "q*n=" + round4(binq * binn) + " is < 5; do not use the Normal Approximation";
                    return
                }
                document.theForm.output.value += "Normal Approximation:\n";
                zval();
                prob()
            }
        }
        // ---------------------------------------------------*/
        function minsamp() {
            pval = cleanx(document.theForm.pval.value, true, false);
            if (pval > 1) pval = pval / 100
            var zalpha = cdfinv(.5 + pval / 2);
            var Err1 = cleanx(document.theForm.error.value, true, false)
            document.theForm.output.value += "Minimum Sample size: " + zeta + "=(Z(" + alpha + "/2)" + sigma + divide + "E)" + P2 + " = "
            document.theForm.output.value += round4((Math.pow(zalpha * document.theForm.sdev.value / Err1, 2))) + " OR " + zeta + "=(Z(" + alpha + "/2)" + divide + "E)" + P2 + "pq = " + round4((Math.pow(zalpha / Err1, 2)) * binp * binq) + "\n"
        }
        // ---------------------------------------------------*/
        function calc0() {
            var x = (document.theForm.input.value.replace(/ /g, "") + "\n").replace(/\n+/g, "\n")
            if (x.length < 2) {
                if (inhist.length > 0) x = inhist.pop()
                x = x.replace(/\n$/, '')
                document.theForm.input.value = x;
                return
            }
            document.theForm.input.value = x;
            calc1()
        }
        // ---------------------------------------------------*/
        function calc1() {
            var x = (document.theForm.input.value.replace(/ /g, "") + "\n").replace(/\n+/g, "\n");
            document.theForm.input.value = "";
            if (x.length < 2) return
            else inhist.push(x)
            var xx = x.split(/[\n;,]/)
            while (xx.length > 0) {
                x = xx.shift()
                var doz = x.search(/[zt]/i) > -1;
                dox1 = true
                x = x.replace(/[^\d\.\+\-]/g, ",").replace(/\,+/g, ",")
                if (x.length == 0 || x == ",") continue
                document.theForm.z2.value = "";
                document.theForm.x2.value = ""
                if (doz) document.theForm.z1.value = "";
                else document.theForm.x1.value = ""
                xxx = x.split(/,/)
                while (xxx.length > 0) {
                    var x1 = xxx.shift()
                    if (x1.length == 0) continue
                    if (doz) {
                        if (dox1) document.theForm.z1.value = x1;
                        else document.theForm.z2.value = x1
                    } else {
                        if (dox1) document.theForm.x1.value = x1;
                        else document.theForm.x2.value = x1
                    }
                    dox1 = false
                }
                if (doz) xval();
                else zval()
                calc1Yes = true;
                prob();
                calc1Yes = false
            }
        }
        // ---------------------------------------------------*/
        function calcCk() {
            Ck = Math.abs(cleanx(document.theForm.Ck.value, true, false))
            if (isNaN(Ck)) Ck = Math.abs(cleanx(document.theForm.z1.value.replace(/[^0-9\-\+\.]/g, ""), true, false))
            if (isNaN(Ck)) Ck = 0
            if (Ck < 1) return
            Cp = 1 - 1 / (Ck * Ck);
            calcCh()
        }
        // ---------------------------------------------------*/
        function calcCp() {
            Cp = Math.abs(cleanx(document.theForm.Cp.value, true, false))
            if (isNaN(Cp)) Cp = Math.abs(cleanx(document.theForm.pval.value))
            if (!isNaN(Cp))
                if (Cp > 1) Cp = Cp / 100
            Ck = Math.sqrt(1 / (1 - Cp));
            calcCh()
        }
        // ---------------------------------------------------*/
        function calcCh() {
            Cp = myround(Cp, 4);
            Ck = myround(Ck, 4)
            mean = cleanx(document.theForm.mean.value, true, false);
            sdev = cleanx(document.theForm.sdev.value, true, false);
            x1 = myround(-Ck * sdev + mean, 4);
            x2 = myround(+Ck * sdev + mean, 4)
            document.theForm.output.value += "According to Chebyshev, for k = " + my(Ck) + (x2 == Ck ? ":\n" : ", " + mu + " = " + mean + ", " + sigma + " = " + sdev + ":\nx1 = " + mu + " - k * " + sigma + " = " + x1 + "; x2 = " + mu + " + k * " + sigma + " = " + x2 + "\nP( " + x1 + " < x < " + x2 + " ) = ")
            document.theForm.output.value += "P( " + (-Ck) + " < k < " + (+Ck) + " ) = 1 -(1/" + myround(Ck, 4) + ")^2 = " + my(Cp) + '\n'
            document.theForm.output.focus()
        }
        // ---------------------------------------------------*/
        function calcPX() {
            with(Math) {
                PX = cleanx(document.theForm.PX.value, true, false)
                PM = cleanx(document.theForm.PM.value, true, false)
                if (PM == 0 || PM == undefined) {
                    PM = 1;
                    document.theForm.PM.value = PM
                };
                if (PX == 0 || PX == undefined) {
                    PX = PM;
                    document.theForm.PX.value = PX
                }
                document.theForm.output.value = 'The Poisson distribution is the probability of getting x successes in a given interval of time if the average rate had been μ(also called λ)\nThe rate is proportional to the length of the interval.\nThe probability is given by: P(x; μ) =(e^-μ)(μ^x) / x!\n'
                document.theForm.output.value += '  x       P(x)    ' + Sigma + '(P(x))    1-' + Sigma + '(P(x))\n'
                document.theForm.output.value += '----- ---------- ---------- ------------\n'
                SPXF = 0
                for (pxi = 0; pxi <= PX; pxi++) {
                    PXF = exp(-PM) * pow(PM, pxi) / fact(pxi);
                    SPXF += PXF
                    document.theForm.output.value += cols(pxi, 5) + cols(my(PXF), 10) + cols(my(SPXF), 10) + cols(my(1 - SPXF), 12) + '\n'
                }
                document.theForm.output.focus()
            }
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
        // ---------------------------------------------------*/
        function graph() {
            var mean = cleanx(document.theForm.mean.value, true, false);
            var sdev = cleanx(document.theForm.sdev.value, true, false);
            var sqrsample = Math.sqrt(cleanx(document.theForm.sample.value, true, false))
            var x1 = cleanx(document.theForm.x1.value, true, false)
            var x2 = cleanx(document.theForm.x2.value, true, false)
            var z1 = (x1 - mean) / (sdev / sqrsample)
            if (x2 == undefined) {
                var z2 = "";
                x2 = ""
            } else {
                z2 = (x2 - mean) / (sdev / sqrsample);
                x2 = round4(x2);
                z2 = round4(z2)
            }

            function graphz(gz) {
                return "znormal((" + gz + "-" + mean + ")/" + sdev + ")"
            }

            function graphline(gz, gcolor) {
                gx = (+mean + gz * sdev);
                gxx = "(" + (gx) + ",";
                return "\n" + gxx + "0)" + gxx + graphz(gx) + "{" + gcolor + "}"
            }
            graphdata = "x:" + (mean - 4 * sdev) + " to " + (mean + 4 * sdev) + ";y:-0.02 to 0.44"
            zstep = 1 / 25;
            for (z = -4; z < z1; z += zstep) graphdata += "\n" + graphline(z, 'yellow')
            if (z2 !== '') {
                for (z = z2; z < 4; z += zstep) graphdata += "\n" + graphline(z, 'green')
                for (z = z1; z < z2; z += zstep) graphdata += "\n" + graphline(z, 'lime')
            } else
                for (z = z1; z < 4; z += zstep) graphdata += "\n" + graphline(z, 'green')
            graphdata += "\n" + graphline(-3, 'blue') + graphline(-2, 'blue') + graphline(-1, 'blue') + graphline(0, 'blue') + graphline(1, 'blue') + graphline(2, 'blue') + graphline(3, 'blue')
            graphdata += "\n" + graphline(z1, "red")
            if (z2 !== '') graphdata += "\n" + graphline(z2, "red")
            graphdata += "\n" + graphz('x') + "{blue}"

            val1 = escape(graphdata.replace(/\n/g, "<nl>").replace(/;/g, "<sc>"))
            localStorage.setItem("graphdata", val1)
            window.open('graphs.php')
        }
    </script>
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="if (document.theForm.mean.value == '0') {document.theForm.mean.focus(); document.theForm.mean.select()}">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <h1>Normal(continuous) Distribution Gauss (Gauß)</h1>
        <form name="theForm">
            <textarea name="output" rows=25 cols=68 onkeyup="enter(event)"></textarea>
            <textarea name="input" rows=1 cols=43 onkeyup="enter(event)"></textarea>
            <input name="NDbut" type="button" value="Enter" onClick="calc0();document.theForm.input.focus()"><br><br><br>
            <input type="button" value="8 place" id="frac" onClick="swfrac(false,5);doit(-1)" title="output format">
            <input name="clear" type="button" value="Clear" onClick="cla()">
            <input name="save" type="button" value="Save" onClick="savestuff('',document.theForm.output.value)">
            <input type="button" value="graph" id="dograph" onClick="graph()" title="show graph" />
            <label for="parm">Parameters</label><input type="radio" name="CItype" value="Parm" id="parm" Checked />
            <label for="stat">Statistics</label><input type="radio" id="stat" name="CItype" value="Stat" /><br>
            <label for="mean">μ(Mean)</label>
            <input type="text" id="mean" name="mean" size=10 value="0" tabindex=1> <br>
            <label for="sdev">σ(St Dev)</label>
            <input type="text" id="sdev" name="sdev" size=9 value="1" tabindex=2> <br>
            <label for="sample">sample size</label>
            <input type="text" id="sample" name="sample" size=7 value="1" tabindex=3>

            <h2>Data:</h2> <label for="x1">x1</label>
            <input class="shortinput" type="text" id="x1" name="x1" size=10 value="0" tabindex=4><br><br>
            <label for="x2">x2</label>
            <input class="shortinput" type="text" id="x2" name="x2" size=10 value="" tabindex=5>
            <input name="cff" type="button" value="Enter" onClick="zval(); prob(); lastdid=0" tabindex=6><br><br><br>
            <h2> Standard score:</h2> <label>z1=</label>
            <input class="shortinput" type="text" name="z1" size=5 value="1"><br><br>
            <label>z2= </label>
            <input class="shortinput" type="text" name="z2" size=5 value="">
            <input name="xscore" type="button" value="Enter" onClick="xval(); prob(); lastdid=0"><br><br><br>
            <h2>Probability</h2>
            <label> C.I. or 1-&alpha;: </label>
            <input class="shortinput" type="text" name="pval" size=10 value="95">
            <input name="zscore" type="button" value="Enter" onClick="CIval(); lastdid=0"><br><br><br>
            <h2>Error:</h2>
            <label>η =(Z<sub>α/2</sub>σ÷E)² or(Z<sub>α/2</sub>÷E)²pq </label>
            <input class="shortinput" type="text" name="error" size=5 value="0.03">

            <input name="minsam" type="button" value="Enter" onClick="minsamp(); lastdid=0"><br><br><br>



            <h2>Chebyshev (Чебышев)</h2>
            <label for="Ck">k:</label>
            <input class="shortinput" type="text" id="Ck" name="Ck" size=12 value="">
            <input name="Ckbut" type="button" value="Enter" onClick="doit(7)">
            <label for="Cp">p:</label>
            <input class="shortinput" type="text" id="Cp" name="Cp" size=12 value="">
            <input name="Cpbut" type="button" value="Enter" onClick="doit(8)"><br><br><br>
            <h2>Siméon Poisson P(x; μ) </h2>
            <label for="PX">x:</label>
            <input class="shortinput" type="text" id="PX" name="PX" size=12 value=""><br><br>
            <label for="PM">μ(or λ):</label>
            <input class="shortinput" type="text" id="PM" name="PM" size=12 value="">
            <input name="PXbut" type="button" value="Enter" onClick="calcPX()">

        </form>
        <script>
            urnmode = 0;
            urntext = ['nCr', 'nPr', 'n^r']
            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                lsd = ls.slice(1).split("&")
                if (lsd.length > 0)
                    if (lsd[0].length > 0) document.theForm.mean.value = lsd[0]
                if (lsd.length > 1)
                    if (lsd[1].length > 0) document.theForm.sdev.value = lsd[1]
                if (lsd.length > 2)
                    if (lsd[2].length > 0) document.theForm.sample.value = lsd[2]
                if (lsd.length > 3) {
                    if (lsd[3].length > 0) document.theForm.input.value = lsd[3];
                    calc1()
                } else
                    document.theForm.input.value = "IQR:-0.6745<z<0.6745;-1<z<1;-2<z<2;-3<z<3";
                document.theForm.input.focus()
            } else cla()
        </script>
        <br><br>
    </div>
</body>

</html>