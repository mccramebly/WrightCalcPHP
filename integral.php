<!DOCTYPE html>
<html lang="en">

<head>
    <title>Definite Integral</title>
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <script src="myfunctions.js"></script>
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus(); document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <script>
        degrees = false
        var factors = ""
        var highco = 1
        var dnf = true
        var approx = String.fromCharCode(8776)
        var h = 0
        // -------------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) calc1();
            if (charCode == 27) cla();
        };
        // -------------------------------------------------------
        function cla() {
            document.theForm.output.value = '';
            factors = ""
            highco = 1
            document.theForm.input.focus()
        };
        // -------------------------------------------------------
        function f(xx) {
            with(Math) {
                X = xx;
                return (eval(f1))
            }
        };

        // -------------------------------------------------------
        function lriem() {
            with(Math) {
                var sum = 0;
                document.theForm.output.value += "\nLeft Riemann: "
                if (document.theForm.debug.checked) document.theForm.output.value += "i, x, f(x) × h "
                for (i = 0; i < xn; i += 1) {
                    xl = x1 + i * h;
                    xr = xl + h;
                    xm = xl + h / 2;
                    yl = f(xl);
                    yr = f(xr);
                    ym = f(xm);
                    yn = min(yl, ym, yr);
                    yx = max(yl, ym, yr);
                    if (yn < ymin) ymin = yn;
                    if (yx > ymax) ymax = yx
                    sum += yl * h;
                    lgraph += '(' + xl + ',' + yl + ')(' + xr + ',' + yl + ')(' + xr + ',' + 0 + ')'
                    if (document.theForm.debug.checked) {
                        document.theForm.output.value += "\n" + (i + 1) + ", " + (my(xl)) + ", " + (my(yl)) + " × " + my(h) + " = " + (my(yl * h))
                    }
                }
                if (document.theForm.debug.checked) document.theForm.output.value += "\nTotal: "
                document.theForm.output.value += sum
            }
        }
        // -------------------------------------------------------
        function mriem() {
            with(Math) {
                var sum = 0;
                document.theForm.output.value += "\nMidpoint: "
                if (document.theForm.debug.checked) document.theForm.output.value += "i, x, f(x) × h "
                for (i = 0; i < xn; i += 1) {
                    xl = x1 + i * h;
                    xr = xl + h;
                    xm = xl + h / 2;
                    yl = f(xl);
                    yr = f(xr);
                    ym = f(xm);
                    yn = min(yl, ym, yr);
                    yx = max(yl, ym, yr);
                    if (yn < ymin) ymin = yn;
                    if (yx > ymax) ymax = yx
                    sum += ym * h;
                    mgraph += '(' + xl + ',' + ym + ')(' + xr + ',' + ym + ')(' + xr + ',' + 0 + ')'
                    if (document.theForm.debug.checked) {
                        document.theForm.output.value += "\n" + (i + 1) + ", " + (my(xm)) + ", " + (my(ym)) + " × " + my(h) + " = " + (my(ym * h))
                    }
                }
                if (document.theForm.debug.checked) document.theForm.output.value += "\nTotal: "
                document.theForm.output.value += sum
            }
        }
        // -------------------------------------------------------
        function rriem() {
            with(Math) {
                var sum = 0;
                document.theForm.output.value += "\nRight Riemann: "
                if (document.theForm.debug.checked) document.theForm.output.value += "i, x, f(x) × h "
                for (i = 0; i < xn; i += 1) {
                    xl = x1 + i * h;
                    xr = xl + h;
                    xm = xl + h / 2;
                    yl = f(xl);
                    yr = f(xr);
                    ym = f(xm);
                    yn = min(yl, ym, yr);
                    yx = max(yl, ym, yr);
                    if (yn < ymin) ymin = yn;
                    if (yx > ymax) ymax = yx
                    sum += yr * h;
                    rgraph += '(' + xl + ',' + yr + ')(' + xr + ',' + yr + ')(' + xr + ',' + 0 + ')'
                    if (document.theForm.debug.checked) {
                        document.theForm.output.value += "\n" + (i) + ", " + (my(xr)) + ", " + (my(yr)) + " × " + my(h) + " = " + (my(yr * h))
                    }
                }
                if (document.theForm.debug.checked) document.theForm.output.value += "\nTotal: "
                document.theForm.output.value += sum
            }
        }
        // -------------------------------------------------------
        function xriem() {
            with(Math) {
                var sum = 0;
                document.theForm.output.value += "\nMax Riemann: "
                if (document.theForm.debug.checked) document.theForm.output.value += "i, x, f(x) × h "
                for (i = 0; i < xn; i += 1) {
                    xl = x1 + i * h;
                    xr = xl + h;
                    xm = xl + h / 2;
                    yl = f(xl);
                    yr = f(xr);
                    ym = f(xm);
                    yn = min(yl, ym, yr);
                    yx = max(yl, ym, yr);
                    if (yn < ymin) ymin = yn;
                    if (yx > ymax) ymax = yx
                    sum += yx * h;
                    xgraph += '(' + xl + ',' + yx + ')(' + xr + ',' + yx + ')(' + xr + ',' + 0 + ')'
                    if (document.theForm.debug.checked) {
                        document.theForm.output.value += "\n" + (i) + ", " + (myround(yx)) + " × " + myround(h) + " = " + (myround(yx * h))
                    }
                }
                if (document.theForm.debug.checked) document.theForm.output.value += "\nTotal: "
                document.theForm.output.value += sum
            }
        }
        // -------------------------------------------------------
        function nriem() {
            with(Math) {
                var sum = 0;
                document.theForm.output.value += "\nMin Riemann: "
                if (document.theForm.debug.checked) document.theForm.output.value += "i, x, f(x) × h "
                for (i = 0; i < xn; i += 1) {
                    xl = x1 + i * h;
                    xr = xl + h;
                    xm = xl + h / 2;
                    yl = f(xl);
                    yr = f(xr);
                    ym = f(xm);
                    yn = min(yl, ym, yr);
                    yx = max(yl, ym, yr);
                    if (yn < ymin) ymin = yn;
                    if (yx > ymax) ymax = yx
                    sum += yn * h;
                    ngraph += '(' + xl + ',' + yn + ')(' + xr + ',' + yn + ')(' + xr + ',' + 0 + ')'
                    if (document.theForm.debug.checked) {
                        document.theForm.output.value += "\n" + (i) + ", " + (myround(yn)) + " × " + myround(h) + " = " + (myround(yn * h))
                    }
                }
                if (document.theForm.debug.checked) document.theForm.output.value += "\nTotal: "
                document.theForm.output.value += sum
            }
        }
        // -------------------------------------------------------
        function trape() {
            with(Math) {
                var sum = 0;
                document.theForm.output.value += "\nTrapezoid: "
                for (i = 0; i < xn; i += 1) {
                    xl = x1 + i * h;
                    xr = xl + h;
                    xm = xl + h / 2;
                    yl = f(xl);
                    yr = f(xr);
                    ym = f(xm);
                    yn = min(yl, ym, yr);
                    yx = max(yl, ym, yr);
                    if (yn < ymin) ymin = yn;
                    if (yx > ymax) ymax = yx
                    sum += (yl + yr) * h / 2;
                    ngraph += '(' + xl + ',' + yl + ')(' + xr + ',' + yr + ')(' + xr + ',' + 0 + ')'
                    if (document.theForm.debug.checked) {
                        document.theForm.output.value += "\n" + (i + 1) + ": " + myround(h) + " × (" + myround(f(x1 + i * h)) + "+" + myround(f(x1 + i * h + h)) + ")/2 = " + (myround((f(x1 + i * h) + f(x1 + i * h + h)) * h / 2))
                    }
                }
                if (document.theForm.debug.checked) document.theForm.output.value += "\nTotal: "
                document.theForm.output.value += sum
            }
        }
        // -------------------------------------------------------
        function simp13() {
            with(Math) {
                var sum = 0;
                document.theForm.output.value += "\nSimpson 1/3: "
                for (i = 0; i < xn; i += 1) {
                    xl = x1 + i * h;
                    xr = xl + h;
                    xm = xl + h / 2;
                    yl = f(xl);
                    yr = f(xr);
                    ym = f(xm);
                    yn = min(yl, ym, yr);
                    yx = max(yl, ym, yr);
                    if (yn < ymin) ymin = yn;
                    if (yx > ymax) ymax = yx
                    sum += (f(x1 + i * h) + 4 * f(x1 + i * h + h / 2) + f(x1 + i * h + h)) * h / 6
                    if (document.theForm.debug.checked) {
                        document.theForm.output.value += "\n" + (i + 1) + ": " + myround(h) + " × (" + myround(f(x1 + i * h) + 4 * f(x1 + i * h + h / 2) + f(x1 + i * h + h)) + ")/6 = " + ((f(x1 + i * h) + 4 * f(x1 + i * h + h / 2) + f(x1 + i * h + h)) * h / 6)
                    }
                }
                if (document.theForm.debug.checked) document.theForm.output.value += "\nTotal: "
                document.theForm.output.value += sum
            }
        }
        // -------------------------------------------------------
        function simp38() {
            with(Math) {
                var sum = 0;
                document.theForm.output.value += "\nSimpson 3/8: "
                for (i = 0; i < xn; i += 1) {
                    xl = x1 + i * h;
                    xr = xl + h;
                    xm = xl + h / 2;
                    yl = f(xl);
                    yr = f(xr);
                    ym = f(xm);
                    yn = min(yl, ym, yr);
                    yx = max(yl, ym, yr);
                    if (yn < ymin) ymin = yn;
                    if (yx > ymax) ymax = yx
                    sum += (f(x1 + i * h) + 3 * f(x1 + i * h + h / 3) + 3 * f(x1 + i * h + 2 * h / 3) + f(x1 + i * h + h)) * (h / 8)
                    if (document.theForm.debug.checked) {
                        document.theForm.output.value += "\n" + (i + 1) + ": " + myround(h) + " × (" + myround(f(x1 + i * h) + 3 * f(x1 + i * h + h / 3) + 3 * f(x1 + i * h + 2 * h / 3) + f(x1 + i * h + h)) + ") /8 = " + (f(x1 + i * h) + 3 * f(x1 + i * h + h / 3) + 3 * f(x1 + i * h + 2 * h / 3) + f(x1 + i * h + h)) * (h / 8)
                    }
                }
                if (document.theForm.debug.checked) document.theForm.output.value += "\nTotal: "
                document.theForm.output.value += sum
            }
        }
        // -------------------------------------------------------
        function calc1() {
            with(Math) {
                graphdata = ""
                x1 = eval(document.theForm.x1.value);
                if (x1 == undefined) x1 = 0
                x2 = eval(document.theForm.x2.value);
                if (x2 == undefined) x2 = 3
                if (x1 == x2) x2 = x1 + 1
                if (x2 < x1) {
                    xn = x2;
                    x2 = x1;
                    x1 = xn
                }
                document.theForm.x1.value = x1;
                document.theForm.x2.value = x2
                xn = eval(document.theForm.xn.value);
                if (xn == undefined) {
                    xn = 3;
                    document.theForm.xn.value = xn
                }
                h = (x2 - x1) / xn
                f1 = document.theForm.input.value.replace(/\n/g, "")
                if (f1.length == 0) {
                    f1 = "2x";
                    document.theForm.input.value = f1
                }
                f1 = f1.replace(/^[ ]*/g, "");
                f1 = f1.replace(/[ ]*$/g, "")
                // convert variable to x.
                if (f1.search(/x/i) == -1) {
                    xvar = f1.search(/[^A-Z][A-D,F-Z][^A-Z]/i)
                    if (xvar > -1) {
                        xvar = f1.charAt(xvar + 1);
                        var re = new RegExp(xvar, "g");
                        f1 = f1.replace(re, 'X')
                    }
                }
                f1 = cleanx(f1)
                document.theForm.output.value += "f(x)=" + f1 + "; x1=" + x1 + ", x2=" + x2 + ", n=" + xn + ", h=" + h + "; f(" + x1 + ")=" + f(x1)
                ymin = 0;
                ymax = 0;
                lgraph = '(' + x1 + ',0)';
                mgraph = '(' + x1 + ',0)';
                rgraph = '(' + x1 + ',0)';
                ngraph = '(' + x1 + ',0)';
                xgraph = '(' + x1 + ',0)';
                tgraph = '(' + x1 + ',0)';
                if (document.theForm.LRiem.checked) lriem()
                if (document.theForm.MRiem.checked) mriem()
                if (document.theForm.RRiem.checked) rriem()
                if (document.theForm.NRiem.checked) nriem()
                if (document.theForm.XRiem.checked) xriem()
                if (document.theForm.Trape.checked) trape()
                if (document.theForm.Simp1.checked) simp13()
                if (document.theForm.Simp3.checked) simp38()
                document.theForm.output.value += "\n"

                if (document.theForm.graph.checked) {
                    xg1 = x1;
                    xg2 = x2;
                    d1 = h;
                    if (document.theForm.Simp1.checked || document.theForm.Simp3.checked || document.theForm.MRiem.checked) d1 /= 2
                    xg1 = myround(xg1);
                    for (x = xg1; x <= xg2 + d1 / 2; x += d1) {
                        document.theForm.output.value += "f(" + myround(x) + ")=" + myround(f(x)) + "\n";
                    }
                    yd = (ymax - ymin) / 10
                    window.open("graphs.php?x:" + (x1 - h / 2) + " to " + (x2 + h / 2) + ";y:" + (ymin - yd) + " to " + (ymax + yd) + ';' + lgraph + '{blue};' + mgraph + '{orange};' + rgraph + '{green};' + ngraph + '{purple};' + xgraph + '{brown};' + tgraph + '{red};' + f1 + '{black};')
                }
                document.theForm.input.focus();
            }
        };
    </script>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <h1>Define Integral</h1>
        <form name="theForm">
            <h2>Integrals</h2>
            <p>arclength: sqrt(1 + (f'(x)^2)) where y = f(x) or sqrt(h'(t)^2 + g'(t)^2) where x=h(t) and y=g(t)</p><br>
            <label>f(x)</label><input type="text" name="input" rows=2 cols=68 tabindex="1" onKeyUp="enter(event)">
            <label>Left</label><input type="text" name="x1" size=10 value="" tabindex="3">
            <label>Right</label><input type="text" name="x2" size=10 value="" tabindex="4">
            <label>n</label><input type="text" name="xn" size=4 value="" tabindex="5">
            <input name="clear" type="button" value="Clear Output" onClick="cla();calc1()" tabindex="0">
            <input name="calc" type="button" value="Calc" onClick="calc1()" tabindex="6">
            <br><br><br>
            <label>Steps</label><input type="checkbox" name="debug">
            <label>Graph values</label><input type="checkbox" name="graph">

            <label>Simpson 3/8</label><input type="checkbox" name="Simp3" value="Simpson3" checked>
            <br><br><br>

            <h2>Riemann</h2>
            <label>Left</label><input type="checkbox" name="LRiem" value="LRiemann">
            <label>Mid</label><input type="checkbox" name="MRiem" value="MRiemann">
            <label>Right</label><input type="checkbox" name="RRiem" value="RRiemann">
            <label>Min</label><input type="checkbox" name="NRiem" value="NRiemann">
            <label>Max</label><input type="checkbox" name="XRiem" value="XRiemann">
            <label>Trapezoid</label><input type="checkbox" name="Trape" value="Trapezoid">
            <label>Simpson 1/3</label><input type="checkbox" name="Simp1" value="Simpson1">

            <br><br><br><br><br><br>
            <h2>Output</h2>
            <input name="savebut" value="Save" type="button" onClick="savestuff();document.theForm.input.focus()">
            <input name="loadbut" value="Load" type="button" onClick="loadstuff();calc1();document.theForm.input.focus()" />
            <textarea name="output" rows=25 cols=68 tabindex=0></textarea>

        </form>
    </div>
</body>

</html>