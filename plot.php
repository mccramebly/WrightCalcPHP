<!DOCTYPE html>
<html lang="en">

<head>
    <title>Table of Function Values</title>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" hrEF="favicon.ico">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus(); document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <script type="text/javascript" src="myfunctions.js"></script>
        <script type="text/javascript" src="statfns.js"></script>
        <form name="theForm">
            <h1>Table of Function Values</h1>
            <textarea name="output" rows=23 cols=68 tabindex="20"></textarea>
            <input name="savebut" Value="Save" type="button" onClick="savestuff();document.theForm.input.focus()" />
            <input name="loadbut" Value="Load" type="button" onClick="loadstuff();calc();document.theForm.input.focus()" />
            <input name="clabut" type="button" value="clear" onClick="cla()" tabindex="7" />
            <textarea name="input" rows=1 cols=68 tabindex="1" onKeyUp="enter(event)"></textarea>
            <br><br><br>
            <h2>X-Range</h2>
            <label>from</label><input type="text" name="x1" size=5 tabindex="2" onKeyUp="enter(event)" />
            <label>thru</label><input type="text" name="x2" size=5 tabindex="3" onKeyUp="enter(event)" />
            <label>step</label><input type="text" name="xd" size=5 tabindex="4" onKeyUp="enter(event)" /> -->
            <input name="ZIbut" type="button" value="In" onClick="ZI()" tabindex="5" />
            <input name="ZObut" type="button" value="Out" onClick="ZO()" tabindex="6" />
            <input name="radianbut" type="button" value="0 to 2&pi;" onClick="document.theForm.x1.value=0; document.theForm.x2.value=2*Math.PI; calc()" tabindex="10" />
            <input name="YIbut" type="button" value="Y +" onClick="YI()" tabindex="7" />


            <input name="Chart" type="button" value="(x,y) Table" onClick="dochart=1; calc()" tabindex="8" />
            <input name="ssbut" type="button" value="Tab Table" onClick="dochart=2; calc()" tabindex="8" />
            <input name="calcbut" type="button" value="Plot" onClick="fcus()" tabindex="9" />
            <input name="slopebut" type="button" value="Slope" onClick="slope()" tabindex="12" />



            <input name="ORbut" type="button" value="Origin" onClick="ORset()" tabindex="11" /><br>
            <input name="RObut" type="button" value="Root" onClick="Root()" tabindex="13" />
            <input name="MXbut" type="button" value="Max" onClick="MX()" tabindex="14" />
            <input name="MNbut" type="button" value="Min" onClick="MN()" tabindex="15" />
            <input name="UPbut" type="button" value="Mv Up" onClick="MUP()" tabindex="16" />
            <input name="DNbut" type="button" value="Mv Dn" onClick="MDN()" tabindex="17" />
            <!-- <input name="YMbut" type="button" value = "Y &lt; 0" onClick="YMset()" tabindex="13" /><br>
<input name="YPbut" type="button" value = "Y &gt; 0" onClick="YPset()" tabindex="14" /><br>-->



            <br>
            <input name="graphbut" Value="Graph" type="button" onClick="graph();document.theForm.input.focus()" /><br>

            <input name="newtbut" type="button" value="Newton" onClick="newton()" tabindex="7" /><br>
            <input name="myround" type="button" value="8 place" id="frac" onClick="swfrac(true)" title="output format" />


            <br><br><br><br><br><br>
        </form>
        <script>
            var dochart = 1
            var degrees = false
            var approx = String.fromCharCode(8776)
            var xval = [],
                yval = []
            var stack = [],
                x1 = -5,
                x2 = 5,
                y1 = -10,
                y2 = 10,
                f1 = "",
                px1 = 0,
                px2 = 0
            var xd = (x2 - x1) / 20,
                yd = (y2 - y1) / 80,
                xmid = (x1 + x2) / 2,
                ymid = (y1 + y2) / 2
            var fxlist = ["(x-1);(x);(x+2);(x-1)(x)(x+2)", "X^5;-8*X^3;X^5-8*X^3+16", "exp(x)-2"];
            fxnumber = 0
            var focustype = 2 // min/max, 3 S.D., scale
            // ------------------------------------------------------- */
            function enter(evt) {
                var charCode = evt.keyCode;
                if (charCode == 13) calc();
                else if (charCode == 27) cla();
                else if (charCode == 38) MUP();
                else if (charCode == 40) MDN();
                // else if (charCode == 37) ZI();
                // else if (charCode == 39) ZO();
                // else if (charCode == )
                // else document.theForm.notes.value+=" " + charCode
            };
            // ------------------------------------------------------- */
            function cla() {
                document.theForm.input.value = ''
                document.theForm.output.value = ''
                document.theForm.x1.value = ''
                document.theForm.x2.value = ''
                // document.theForm.notes.value=""
                document.theForm.input.focus()
            }
            // ------------------------------------------------------- */
            function Root() {
                getx1x2()
                for (i = 0; i + 1 < yval.length; i++) {
                    if (yval[i] * yval[i + 1] <= 0) {
                        mm = (yval[i] - yval[i + 1]) / (xval[i] - xval[i + 1])
                        xmed = xval[i] - yval[i] / mm
                        xr = Math.min(x2 - xmed, xmed - x1)
                        if (8 < i && i < 12) xr = xr / 5
                        if ((xmed - xr) == (xmed + xr)) xr = (x2 - x1) / 2
                        x1 = xmed - xr;
                        x2 = xmed + xr;
                        break
                    }
                }
                focustype = 2
                draw(x1, x2, 0, 0)
            }
            // ------------------------------------------------------- */
            function MX() {
                getx1x2()
                for (i = 1; i + 1 < yval.length; i++) {
                    if (yval[i - 1] <= yval[i] && yval[i] >= yval[i + 1]) {
                        xmed = xval[i]
                        xr = Math.min(x2 - xmed, xmed - x1)
                        if (8 < i && i < 12) xr = xr / 2
                        if (xr == 0) xr = (x2 - x1) / 2
                        x1 = xmed - xr;
                        x2 = xmed + xr;
                        break
                    }
                }
                focustype = 2
                draw(x1, x2, 0, 0)
            }
            // ------------------------------------------------------- */
            function MN() {
                getx1x2()
                for (i = 1; i + 1 < yval.length; i++) {
                    if (yval[i - 1] >= yval[i] && yval[i] <= yval[i + 1]) {
                        xmed = xval[i]
                        xr = Math.min(x2 - xmed, xmed - x1)
                        if (8 < i && i < 12) xr = xr / 2
                        if (xr == 0) xr = (x2 - x1) / 2
                        x1 = xmed - xr;
                        x2 = xmed + xr;
                        break
                    }
                }
                focustype = 2
                draw(x1, x2, 0, 0)
            }
            // ------------------------------------------------------- */
            function YI() {
                getx1x2()
                if (y1 * y2 <= 0) {
                    ya = y1 / 2;
                    yb = y2 / 2
                } else {
                    ya = ymid - 20 * yd;
                    yb = ymid + 20 * yd
                }
                draw(x1, x2, ya, yb)
            }
            // ------------------------------------------------------- */
            function ZI() {
                focustype = 2
                getx1x2();
                draw(xmid - 5 * xd, xmid + 5 * xd, 0, 0)
            }
            // ------------------------------------------------------- */
            function ZO() {
                focustype = 2
                getx1x2();
                draw(xmid - 20 * xd, xmid + 20 * xd, 0, 0)
            }
            // ------------------------------------------------------- */
            function MUP() {
                focustype = 2
                getx1x2();
                draw(xmid - 15 * xd, xmid + 5 * xd, y1, y2)
            }
            // ------------------------------------------------------- */
            function MDN() {
                focustype = 2
                getx1x2();
                draw(xmid - 5 * xd, xmid + 15 * xd, y1, y2)
            }
            // ------------------------------------------------------- */
            function ORset() {
                with(Math) {
                    focustype = 2
                    getx1x2();
                    x = max(abs(x1), abs(x2));
                    y = max(abs(y1), abs(y2))
                    draw(-x, x, -2 * x, 2 * x)
                }
            } // -y,y)}}
            // ------------------------------------------------------- */
            function f(xx) {
                with(Math) {
                    X = xx;
                    return (eval(fx1))
                }
            };
            // ------------------------------------------------------- */
            function pop() {
                stack.pop() // not the last one
                stackrec = stack.pop()
                x1 = stackrec[0]
                x2 = stackrec[1]
                document.theForm.input.value = stackrec[2]
                y1 = stackrec[3]
                y2 = stackrec[4]
                draw(x1, x2, y1, y2)
            }
            // ------------------------------------------------------- */
            function getx1x2() {
                x1 = document.theForm.x1.value
                x2 = document.theForm.x2.value
                xd = document.theForm.xd.value
                if (eval(x1) == undefined) {
                    if (eval(x2) == undefined) {
                        if (eval(xd) == undefined) {
                            x1 = -10;
                            x2 = 10;
                            xd = 1
                        } else {
                            xd = cleanx(xd, true);
                            x1 = -10;
                            x2 = x1 + 20 * xd
                        }
                    } else {
                        x2 = cleanx(x2, true)
                        if (eval(xd) == undefined) {
                            x1 = x2 - 10;
                            xd = 1
                        } else {
                            xd = cleanx(xd, true);
                            x1 = x2 - 20 * xd
                        }
                    }
                } else {
                    x1 = cleanx(x1, true)
                    if (eval(x2) == undefined) {
                        if (eval(xd) == undefined) {
                            x2 = x1 + 20;
                            xd = 1
                        } else {
                            xd = cleanx(xd, true);
                            x2 = x1 + 20 * xd
                        }
                    } else {
                        x2 = cleanx(x2, true)
                        xd = (x2 - x1) / 20
                    }
                }
                document.theForm.x1.value = x1
                document.theForm.x2.value = x2
                document.theForm.xd.value = xd

                xmid = (x1 + x2) / 2
                if (y1 == undefined) y1 = -10
                if (x2 == undefined) y2 = y1 + 20
                yd = (y2 - y1) / 80;
                ymid = (y1 + y2) / 2
                // document.theForm.notes.value=x1+","+x2+";"+y1+","+y2+";"+xmid+","+ymid+";"+xd+","+yd
            }
            // ------------------------------------------------------- */
            function fcus() {
                dochart = 0;
                focustype = (focustype + 1) % 3
                getx1x2();
                draw(x1, x2, 1, 0)
            }
            // ------------------------------------------------------- */
            function chart() {
                document.theForm.output.value = "( x, " + document.theForm.input.value + ")\n"
                for (a = 0; a < 15; a++) {
                    if (myround(xval[0], a) != myround(xval[1], a)) break
                }
                a += 1 // required accuracy?
                for (i = 0; i < yval.length; i++) {
                    X = xval[i];
                    if (dochart == 1) {
                        document.theForm.output.value += '(' + my(X);
                        j = 0;
                        while (j < ff.length) {
                            document.theForm.output.value += ", " + my(eval(cleanx(ff[j])));
                            j++
                        }
                        document.theForm.output.value += ")\n"
                    } else {
                        document.theForm.output.value += my(X);
                        j = 0
                        while (j < ff.length) {
                            document.theForm.output.value += " \t" + my(eval(cleanx(ff[j])));
                            j++
                        }
                        document.theForm.output.value += "\n"
                    }
                }
            }
            // ------------------------------------------------------- */
            function graph() {
                dochart = 1;
                calc()
                X = xval[0];
                yfrom = ythru = yval[0];
                graphdata = ""
                for (i = 0; i < yval.length; i++) {
                    graphdata += "(" + xval[i] + "," + yval[i] + ",-3);"
                    if (yval[i] < yfrom) yfrom = yval[i]
                    if (yval[i] > ythru) ythru = yval[i]
                }
                graphdata = "x: " + xval[0] + " to " + xval[yval.length - 1] + ';y: ' + yfrom + " to " + ythru + ';' + ff[0] + ";" + graphdata
                val1 = escape(graphdata.replace(/\n/g, "<nl>").replace(/;/g, "<sc>"))
                localStorage.setItem("graphdata", val1)
                window.open('graphs.php')
            }
            // ------------------------------------------------------- */
            function calc() {
                getx1x2();
                draw(x1, x2, 0, 0)
            } // ------------------------------------------------------- */
            function putit(x, s, t) {
                x = x.slice(0, s) + t + x.slice(s + 1);
                return x
            }
            // ------------------------------------------------------- */
            function draw(vx1, vx2, vy1, vy2) {
                with(Math) {
                    f1 = document.theForm.input.value.replace(/\n/g, "").replace(/^[ ]*/g, "").replace(/[ ]*$/g, "")
                    document.theForm.input.value = f1
                    if (vx1 != px1 || vx2 != px2) focustype = 0
                    px1 = vx1;
                    px2 = vx2
                    if (f1.length == 0) {
                        focustype = 3;
                        vy1 = 0;
                        vy2 = 0
                        f1 = fxlist[fxnumber];
                        fxnumber = (fxnumber + 1) % fxlist.length
                        document.theForm.input.value = f1
                    }
                    xvar = f1.search(/=/);
                    if (xvar > -1) f1 = f1.slice(0, xvar) + "-(" + f1.slice(xvar + 1) + ")"
                    xvar = f1.search(/[^A-Z][A-Z][^A-Z]/i)
                    if (xvar > -1) {
                        xvar = f1.charAt(xvar + 1)
                        if (xvar != 'X') {
                            var re = new RegExp(xvar, "g");
                            f1 = f1.replace(re, 'X')
                            document.theForm.input.value = f1
                        }
                    }
                    ff = f1.split(';');
                    f1 = ff[0];
                    fx1 = cleanx(f1)
                    xd = (vx2 - vx1) / 20;
                    if (xd == 0) {
                        xd = .05;
                        vx1 -= 1;
                        vx2 += 1
                    }
                    document.theForm.x1.value = vx1;
                    document.theForm.x2.value = vx2; // document.theForm.xd.value=xd
                    y1a = Infinity;
                    y2a = -Infinity;
                    xval = [];
                    yval = []
                    sy = 0;
                    syy = 0;
                    sn = 0
                    for (xx = vx1; xx < vx2 + xd / 2; xx += xd) {
                        xval.push(xx);
                        yy = f(xx);
                        yval.push(yy)
                        sy += yy;
                        syy += yy * yy;
                        sn += 1
                        if (yy != Infinity && yy != -Infinity && !isNaN(yy)) {
                            if (yy < y1a) y1a = yy;
                            if (yy > y2a) y2a = yy
                        }
                    }
                    ym = (y1a + y2a) / 2
                    if (y1a == y2a) {
                        y1a = ym - 20 * xd;
                        y2a = ym + 20 * xd
                    }
                    sdvy = Math.sqrt((syy - sy * sy / sn) / sn);
                    sm = sy / sn;
                    if (sdvy == 0) sdvy = 6 * xd
                    y1b = sm - 3 * sdvy;
                    y2b = sm + 3 * sdvy
                    y3a = ym - 20 * xd;
                    y3b = ym + 20 * xd
                    ytype = " (min/max) "
                    // document.theForm.notes.value="min/max:"+y1a+", "+y2a+", S.D.:"+y1b+", "+y2b+", scale:"+y3a+", "+y3b
                    if (vy1 > vy2) // focus
                    {
                        if (focustype == 0) {
                            y1 = y1a;
                            y2 = y2a
                        } else if (focustype == 1) {
                            y1 = y1b;
                            y2 = y2b;
                            ytype = " (3 S.D.)"
                        } else if (focustype == 2) {
                            y1 = y3a;
                            y2 = y3b;
                            ytype = " (scale)"
                        }
                    } else if (vy1 == vy2) // all
                    {
                        y1 = y1a;
                        y2 = y2a
                    } else {
                        y1 = vy1;
                        y2 = vy2;
                        ytype = ""
                    } // shift

                    x1 = vx1;
                    x2 = vx2;
                    yd = (y2 - y1) / 80

                    stack.push([x1, x2, f1, y1, y2])
                    headstring1 = ("" + y1 + " step " + yd + ytype).replace(/9999\d*/g, "9").replace(/0000\d*/g, "")
                    headstring2 = ("" + y2).replace(/9999\d*/g, "9").replace(/0000\d*/g, "")
                    while (headstring1.length + headstring2.length < 81) headstring1 += " "
                    document.theForm.output.value = headstring1 + headstring2
                    blankline = "·················································································"
                    rulerline = "V....v....V....v....V....v....V....v....V....v....V....v....V....v....V....v....V"
                    lastline = "";
                    lastyyy = -1
                    yd = (y2 - y1) / 80
                    if (y1 * y2 <= 0) {
                        yzero = floor((-y1 + yd / 2) / yd);
                        blankline = putit(blankline, yzero, "¦")
                        document.theForm.output.value += "\n" + putit(rulerline, yzero, "¦")
                    } else document.theForm.output.value += "\n" + rulerline

                    xaxis = true
                    for (i = 0; i < yval.length; i++) {
                        yvali = yval[i]

                        xyvali = "(" + myround(xval[i]) + "," + myround(yvali) + ")"
                        xyvali = xyvali.replace(/9999\d*/g, "9").replace(/0000\d*/g, "")

                        yyy = floor((yvali - y1 + yd / 2) / yd);
                        if (yyy < 0) yyy = 0;
                        if (yyy > 80) yyy = 80
                        yline = blankline
                        if (yyy < 40) yline = yline.slice(0, 81 - xyvali.length) + xyvali
                        else yline = xyvali + yline.slice(xyvali.length)
                        symbol = '$';
                        if (yvali <= y1 || yvali >= y2) symbol = "@"

                        if (xaxis && (abs(xval[i]) <= abs(xval[i - 1])) && (abs(xval[i]) <= abs(xval[i + 1]))) {
                            yline = yline.replace(/[\·]/g, "-").replace(/[\¦]/g, "+");
                            xaxis = false
                        }
                        yline = putit(yline, yyy, symbol)

                        if (lastyyy >= 0) {
                            yy = floor(((yvali + yval[i - 1]) / 2 - y1 + yd / 2) / yd);
                            if (yy < 0) yy = 0;
                            if (yy > 80) yy = 80
                            // document.theForm.notes.value=""+yy+" "+lastyyy+" "+yvali+" "+yval[i]+" "+yval[i-1]
                            if (abs(lastyyy - yy) < 30) {
                                for (ii = lastyyy + 1; ii < yy; ii++) lastline = putit(lastline, ii, "*")
                                for (ii = yy + 1; ii < lastyyy; ii++) lastline = putit(lastline, ii, "*")
                            }
                            if (abs(yyy - yy) < 30) {
                                for (ii = yyy + 1; ii < yy; ii++) yline = putit(yline, ii, "*")
                                for (ii = yy + 1; ii < yyy; ii++) yline = putit(yline, ii, "*")
                            }
                            document.theForm.output.value += "\n" + lastline.replace(/\$/, "#")
                        }
                        lastline = yline;
                        lastyyy = yyy
                    }

                    document.theForm.output.value += "\n" + lastline
                    document.theForm.input.focus();
                    if (dochart > 0) chart()
                }
            }
            // ------------------------------------------------------- */
            function slope() {
                with(Math) {
                    y1a = Infinity;
                    y2a = -Infinity;
                    xval = [];
                    yval = [];
                    sy = 0;
                    syy = 0;
                    sn = 0
                    for (xx = x1; xx < x2 + xd / 2; xx += xd) {
                        yy = (f(xx + xd / 2) - f(xx - xd / 2)) / xd
                        xval.push(xx);
                        yval.push(yy)
                        sy += yy;
                        syy += yy * yy;
                        sn += 1
                        if (yy != Infinity && yy != -Infinity && !isNaN(yy)) {
                            if (yy < y1a) y1a = yy;
                            if (yy > y2a) y2a = yy
                        }
                    }
                    sdvy = Math.sqrt((syy - sy * sy / sn) / sn);
                    sm = sy / sn
                    y1b = sm - 3 * sdvy;
                    y2b = sm + 3 * sdvy
                    y1 = (y1b > y1a ? y1b : y1a);
                    y2 = (y2b < y2a ? y2b : y2a)
                    yd = (y2 - y1) / 80
                    // document.theForm.notes.value=""+sm+"+/-"+sdvy+", "+sy+", "+syy
                    headstring1 = ("" + y1 + " step " + yd).replace(/9999\d*/g, "9").replace(/0000\d*/g, "")
                    headstring2 = ("" + y2).replace(/9999\d*/g, "9").replace(/0000\d*/g, "")
                    while (headstring1.length + headstring2.length < 81) headstring1 += " "
                    document.theForm.output.value = headstring1 + headstring2

                    blankline = "·················································································"
                    rulerline = "V....v....V....v....V....v....V....v....V....v....V....v....V....v....V....v....V"
                    lastline = "";
                    lastyyy = -1
                    yd = (y2 - y1) / 80
                    if (y1 * y2 <= 0) {
                        yzero = floor((-y1 + yd / 2) / yd);
                        blankline = putit(blankline, yzero, "¦")
                        document.theForm.output.value += "\n" + putit(rulerline, yzero, "¦")
                    } else document.theForm.output.value += "\n" + rulerline

                    xaxis = true
                    for (i = 0; i < yval.length; i++) {
                        yvali = yval[i]

                        xyvali = "(" + myround(xval[i]) + "," + myround(yvali) + ")"
                        xyvali = xyvali.replace(/9999\d*/g, "9").replace(/0000\d*/g, "")

                        yyy = floor((yvali - y1 + yd / 2) / yd);
                        if (yyy < 0) yyy = 0;
                        if (yyy > 80) yyy = 80
                        yline = blankline
                        if (yyy < 40) yline = yline.slice(0, 81 - xyvali.length) + xyvali
                        else yline = xyvali + yline.slice(xyvali.length)
                        symbol = '$';
                        if (yvali <= y1 || yvali >= y2) symbol = "@"

                        if (xaxis && (abs(xval[i]) <= abs(xval[i - 1])) && (abs(xval[i]) <= abs(xval[i + 1]))) {
                            yline = blankline.replace(/[\·]/g, "-").replace(/[\¦]/g, "+");
                            xaxis = false
                        }
                        yline = putit(yline, yyy, symbol)

                        if (lastyyy >= 0) {
                            yy = floor(((yvali + yval[i - 1]) / 2 - y1 + yd / 2) / yd);
                            if (yy < 0) yy = 0;
                            if (yy > 80) yy = 80
                            // document.theForm.notes.value=""+yy+" "+lastyyy+" "+yvali+" "+yval[i]+" "+yval[i-1]
                            for (ii = lastyyy + 1; ii < yy; ii++) lastline = putit(lastline, ii, "*")
                            for (ii = yy + 1; ii < lastyyy; ii++) lastline = putit(lastline, ii, "*")
                            for (ii = yyy + 1; ii < yy; ii++) yline = putit(yline, ii, "*")
                            for (ii = yy + 1; ii < yyy; ii++) yline = putit(yline, ii, "*")
                            document.theForm.output.value += "\n" + lastline.replace(/\$/, "#")
                        }
                        lastline = yline;
                        lastyyy = yyy
                    }

                    document.theForm.output.value += "\n" + lastline
                    document.theForm.input.focus();
                }
            }
            // ------------------------------------------------------- */
            function newton() {
                // narrow down range
                getx1x2();
                i = 0;
                ya = yval[i];
                x1 = xval[i]
                while (i < yval.length && ya * yval[i] > 0) {
                    ya = yval[i];
                    x1 = xval[i];
                    i++
                }
                if (i == yval.length) {
                    x1 = xval[0]
                } else {
                    i = yval.length - 1;
                    yb = yval[i];
                    x2 = xval[i]
                    while (yb * yval[i] > 0) {
                        yb = yval[i];
                        x2 = xval[i];
                        i--
                    }
                    draw(x1, x2, 0, 0)
                }
                newf1 = document.theForm.input.value
                xvar = newf1.search(/;/);
                if (xvar > -1) newf1 = newf1.slice(0, xvar)
                for (i = 0; i + 1 < yval.length; i++) {
                    if (yval[i] * yval[i + 1] <= 0) {
                        newf1 += "; " + xval[i]
                        if (yval[i + 1] == 0) i++
                    }
                }
                window.open('newton.php?' + newf1)
                pop() // restore limits
            }
            // ------------------------------------------------------- */
            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                lsd = ls.slice(1).split("&")
                if (lsd[0].length > 0) document.theForm.input.value = lsd[0]
                if (lsd[1].length > 0) document.theForm.x1.value = lsd[1]
                if (lsd[2].length > 0) document.theForm.x2.value = lsd[2]
                chart()
            }
        </script>
    </div>
</body>

</html>