<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simultaneous Linear Equations</title>
    <script src="myfunctions.js"></script>
    <script src="matrix.js"></script>
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/simple-calc-style.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="linear" onLoad="self.focus();document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <div id="calctainer">
        <a href="index.php"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <h1>Systems of Linear Equations</h1>
        <form name="theForm">
            <textarea id="output" name="output" tabindex=0>
Input notes: Enter systems of linear equations.
The first equation must have all your unknowns.
If necessary use a coefficient of 0.
Example:
2x +3y +0z =-2
2x +z =-1
y + z =1</textarea>
            <textarea id="input" name="input" tabindex="1" onKeyUp="enter(event)"></textarea>
            <input id="calculate" class="calcButton" name="calculate" type="button" value="Calculate" onClick="calc()" tabindex="2">

            <div id="buttons">
                <div id="options">
                    <span>
                        <input type="checkbox" name="debug" value="dump" />Gauss Matrix
                    </span>
                    <span>
                        <input type="checkbox" name="inverse" value="inverse" />A<sup>-1</sup>
                    </span>
                    <span>
                        <input type="checkbox" name="only1" value="only1" />short answer
                    </span>
                    <span>
                        <input type="checkbox" name="cramer" value="cramer">Cramer
                    </span>
                </div>
                <div id="buttonGroup">
                    <input name="medians" type="button" value="enter medians" onClick="dotrimid()">
                    <input name="triangle" type="button" value="Find triangle" onClick="dotriangle()">
                    <input name="invenn" type="button" value="enter venn data" onClick="vennin()">
                    <input name="outvenn" type="button" value="draw diagram" onClick="vennout()">
                    <input name="findcorn" type="button" value="draw intersections" onClick="corners()">
                    <input type="button" value="8 place" id="frac" onClick="swfrac(true,4)" title="output format">
                </div>
            </div>
            <div id="saveload">
                <input name="savebut" Value="Save" type="button" onClick="savestuff()" />
                <input name="loadbut" Value="Load" type="button" onClick="loadstuff();calc()" />
                <input name="clear" id="clear" type="button" value="Clear" onClick="cla()" />
            </div>
        </form>
    </div>
    <script type="text/javascript">
        saveone = document.theForm.output.value
        venntemplate = "Venn diagram {1:A 2:AB 3:B 4:AC 5:ABC 6:BC 7:C 8:X}:\nx1+x2+x3+x4+x5+x6+x7+x8= \nx1+x2+x3+x4+x5+x6+x7+x8= \nx1+x2+x3+x4+x5+x6+x7+x8= \nx1+x2+x3+x4+x5+x6+x7+x8= \nx1+x2+x3+x4+x5+x6+x7+x8= \nx1+x2+x3+x4+x5+x6+x7+x8= \nx1+x2+x3+x4+x5+x6+x7+x8= \nx1+x2+x3+x4+x5+x6+x7+x8=\n"
        sample = [];
        sampleI = 0
        sample.push("three equations with three unknowns and a coefficient that is evaluated\n2x +3y +0z =-2\n2x +z =-1\ny + {tan(45)} z =1")
        sample.push("vertices of triangle from three medians:\n0.5x1 + 0.5x2 + 0x3 = 2\n0x1 + 0.5x2 + 0.5x3 = 4\n0.5x1 + 0x2 + 0.5x3 = 7\n0.5y1 + 0.5y2 + 0y3 = 5\n0y1 + 0.5y2 + 0.5y3 = 1\n0.5y1 + 0y2 + 0.5y3 = 8\n")
        sample.push("intersections of lines:\nx=>0; x<=8\ny≥0; y≤10\n4x+5y <= 60\n<(6,6)(8,2)")
        sample.push(venntemplate)
        var n = -1;
        var coef = [
            []
        ]
        var xx = [];
        var mxb = [
            []
        ]
        var trimid = false;
        getcorners = false
        probno = "";
        work = '';
        graphit = false;
        graphdata = '';
        savex = [
            []
        ];
        savey = [
            []
        ]
        if (!Array.prototype.indexOf) {
            Array.prototype.indexOf = function(elt /*, from*/ ) {
                var len = this.length;
                var from = Number(arguments[1]) || 0;
                from = (from < 0) ?
                    Math.ceil(from) :
                    Math.floor(from);
                if (from < 0)
                    from += len;

                for (; from < len; from++) {
                    if (from in this && this[from] === elt)
                        return from;
                }
                return -1;
            };
        }

        ls = decodeURIComponent(location.search)
        if (ls.search(/\?/) == 0) {
            document.theForm.input.value = ls.slice(1).split("&")[0]
            calc()
        }
        // --------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) calc();
            if (charCode == 27) cla();
        };
        // --------------------------
        function cla() {
            var coef = [
                []
            ];
            n = -1;
            var xx = [];
            trimid = false;
            savelines = '';
            savemb = []
            if (document.theForm.input.value == '') {
                document.theForm.input.value = sample[sampleI++];
                sampleI = sampleI % sample.length
            } else document.theForm.input.value = '';
            document.theForm.output.value = saveone;
            document.theForm.input.focus()
        };
        // --------------------------
        function vennin() {
            coef = [
                []
            ];
            n = -1;
            xx = [];
            if (document.theForm.input.value == venntemplate) document.theForm.input.value = "  Math 144 review # 17: A- in love, B- in prison, C- truck drivers:\n1:A, 2:AB, 3:B, 4:AC, 5:ABC, 6:BC, 7:C, 8:X\n0x1+0x2+0x3+0x4+x5+0x6+0x7+0x8= 12\nx2+x5= 13\nx1+x2+x4+x5= 28\nx4+x5= 18 \nx1+x4+x7+x8= 33\nx2+x3+x5+x6= 18\nx5+x6= 15\nx4+x7= 16\n"
            else if (document.theForm.input.value == '') document.theForm.input.value = venntemplate
        }
        // --------------------------
        function vennout() {
            calc();
            vennparm = ''
            for (i1 = 0; i1 < coef.length - 1; i1++) vennparm += ';' + (-coef[i1][xxn] / coef[i1][i1])
            window.open('venn.php?A;B;C' + vennparm)
        }
        // --------------------------
        function dotrimid() {
            coef = [
                []
            ];
            n = -1;
            xx = [];
            if (document.theForm.input.value == '') {
                document.theForm.input.value = "find triangle from medians:\n"
                document.theForm.input.value += "Enter x-coords of the three medians\n"
                document.theForm.input.value += "0.5x1 + 0.5x2 + 0x3 = \n"
                document.theForm.input.value += "0x1 + 0.5x2 + 0.5x3 = \n"
                document.theForm.input.value += "0.5x1 + 0x2 + 0.5x3 = \n"
                document.theForm.input.value += "Enter y-coords of the three medians\n"
                document.theForm.input.value += "0.5y1 + 0.5y2 + 0y3 = \n"
                document.theForm.input.value += "0y1 + 0.5y2 + 0.5y3 = \n"
                document.theForm.input.value += "0.5y1 + 0y2 + 0.5y3 = \n"
            }
            document.theForm.input.focus()
        };
        // --------------------------
        function parseInput() {
            var xi = work.search(/\n/);
            if (xi == -1) xi = work.length;
            var comma = false
            if (work.search(/^\(*\w{0,3}\)/) == 0) {
                i2 = work.search(/\)/) + 1
                probno = work.substring(0, i2) + " "
                work = work.substring(i2)
            }
            xx = work.slice(0, xi).match(/[a-z][^\+\-\=\)]*/gi)
            if (xx == null) {
                xx = work.slice(0, xi).match(/,/g);
                if (xx.length == 0) return
                work = "," + work;
                comma = true
                for (var i = 1; i <= xx.length; i++) {
                    sx = "$1x" + i + ",";
                    sxi = work.search(/,/) + 1
                    if ("+-".search("\\" + work.charAt(sxi)) == -1) sx = "+" + sx
                    work = work.replace(/,([^,]+),/, sx)
                }
                work = work.replace(/,/, "")
                xi = work.search(/\n/);
                if (xi == -1) xi = work.length;
                xx = work.substring(0, xi).match(/[a-z][^\+\-\=]*/gi)
            }
            xx = xx.sort();
            i = 1;
            while (i < xx.length) {
                while ((xx[i] == xx[i - 1]) && (i < xx.length)) {
                    xx.splice(i, 1);
                };
                i++;
            };
            xxn = xx.length
            if (xxn == 1 && getcorners) {
                xxn = 2;
                if (xx[0] == 'y') xx = ['x', 'y'];
                else xx.push('y')
            }
            xx[xxn] = ""; // xxn is number of variables. last column for constants
            for (i1 = 0; i1 <= xxn; i1++) {
                coef[i1] = [];
                for (i2 = 0; i2 <= 2 * xxn; i2++) {
                    coef[i1][i2] = 0;
                };
                coef[i1][xxn + 1 + i1] = 1;
            };
            i1 = 0;
            n = 0;
            i0 = -1;
            coef[0][2 * xxn + 1] = ''
            while ((i1 < work.length) && (n < xxn)) {
                if (work.charAt(i1) == "\n") {
                    i1++;
                    n++;
                    if (getcorners) {
                        work = work.substring(i1);
                        return
                    }
                    if (comma && i1 < work.length && n < xxn) { // fix the next line
                        i2 = work.slice(i1).search(/\n/) + i1;
                        if (i2 == -1) i2 = work.slice(i1).length
                        work1 = "," + work.slice(i1, i2)
                        for (var i = 1; i <= xx.length; i++) {
                            sx = "$1x" + i + ",";
                            sxi = work1.search(/,/) + 1
                            if ("+-".search("\\" + work1.charAt(sxi)) == -1) sx = "+" + sx
                            work1 = work1.replace(/,([^,]+),/, sx)
                        }
                        work = work.slice(0, i1) + work1.replace(/,/, "") + work.slice(i2)
                    }
                    for (i2 = 0; i2 < xxn; i2++) {
                        coef[n][i2] = 0
                    };
                } else {
                    if (work[i1] == "<" || work[i1] == ">") {
                        coef[0][2 * xxn + 1] = work[i1];
                        work = work.slice(0, i1) + work.slice(i1 + 1)
                    }
                    i2 = work.slice(i1).search(/\n/) + i1;
                    if (i2 == -1) i2 = work.slice(i1).length
                    if (work.slice(i1, i2).search(/[\(\)]/) > -1) {
                        work = work.slice(0, i1) + fx2xx(parse(clean(work.slice(i1, i2), true)), true).replace(/ /g, "") + work.slice(i2)
                    }
                    i2 = i1
                    if (work.charAt(i2).match(/[\+\-]/)) {
                        i2++
                    }
                    i2 += work.substring(i2).search(/[\+\-a-z\n]/i)
                    if (work.charAt(i2 - 1) == "*") {
                        i2++;
                        i2 += work.substring(i2).search(/[\+\-a-z\n]/i)
                    }
                    if (0 == work.substring(i2).search(/[a-z]/i)) // start of next variable
                    {
                        x3 = work.substring(i2).match(/[a-z][^\+\-\=\n]*/i);
                        i3 = x3[0].length;
                        i0 = xx.indexOf(x3[0])
                    } else {
                        i0 = xxn;
                        x3 = [""];
                        i3 = 0
                    }
                    x2 = work.substring(i1, i2)
                    if (x2 == "+" || x2 == "-" || x2 == "") x2 = x2 + "1";
                    coef[n][i0] += eval(x2);
                    i1 = i2 + i3
                }
            }
            work = work.substring(i1); {
                if (xxn == 2) {
                    coefs = [
                        []
                    ];
                    for (i1 = 0; i1 < xxn; i1++) coefs[i1] = coef[i1].slice(0)
                } // no idea what/why
                document.theForm.output.value += '\n' + probno + "Standard form: ";
                probno = ''
                for (i1 = 0; i1 < xxn; i1++) {
                    i1x = 0;
                    for (i2 = 0; i2 < xxn; i2++) {
                        if (coef[i1][i2] != 0) {
                            if ((coef[i1][i2] > 0) && (i1x != 0)) document.theForm.output.value += "+"
                            if (coef[i1][i2] == -1) document.theForm.output.value += "-"
                            else if (Math.abs(coef[i1][i2]) != 1) document.theForm.output.value += my(coef[i1][i2])
                            document.theForm.output.value += xx[i2];
                            i1x = -1;
                        }
                    }
                    document.theForm.output.value += "=" + my(-coef[i1][xxn]) + "; ";
                }
                document.theForm.output.value += '\n'
            }
        }
        // --------------------------
        function dump() {
            if (document.theForm.debug.checked) {
                document.theForm.output.value += "-----------------------\n";
                for (i01 = 0; i01 < xxn; i01++) {
                    for (i02 = 0; i02 < xxn; i02++) document.theForm.output.value += my(coef[i01][i02]) + ", "
                    document.theForm.output.value += my(-coef[i01][i02])
                    // for (i02=xxn+1;i02<=2*xxn;i02++) document.theForm.output.value += ", "+my(coef[i01][i02],true) // part two
                    document.theForm.output.value += "\n";
                }
            }
        }
        // --------------------------
        function calc() {
            document.theForm.output.value = "";
            savelines = '';
            savemb = []
            work = "\n" + document.theForm.input.value.toLowerCase() + "\n";
            work = work.replace(/\|/g, "") // if output is from matrix app
            // convert pairs of points into y=mx+b form
            work = work.replace(/\)\(/g, ") (")
            while ((i1 = work.search(/\([^,()\n]+,[^,()\n]+\)[^,()\n]*\([^,()\n]+,[^,()\n]+\)/)) > -1) {
                i2 = work.slice(i1).search(/\n/);
                if (i2 == -1) i2 = work.length;
                else i2 += i1
                i3 = work.slice(i1, i2).match(/[(),][^(),]+/g)
                i4 = line(i3[0].slice(1), i3[1].slice(1), i3[3].slice(1), i3[4].slice(1))
                work = work.slice(0, i1) + i4 + work.slice(i2)
            }
            // if no equal signs then assume commas
            if (work.search(/[=><≥≤<≤]/) == -1) {
                work = work.replace(/ /g, ",").replace(/,+/g, ",") // turn spaces into commas
                work = work.replace(/,*\n,*/g, "\n") // trailing commas
                work = work.replace(/^,*/g, "") // leading commas
                work = work.replace(/,([^,]+)\n/g, ",=$1\n")
            } else {
                work = work.replace(/,/g, "\n").replace(/ /g, "")
            }
            work = work.replace(/[\$\?]/g, ""); // question marks
            work = work.replace(/[;&]/gi, "\n");
            work = work.replace(/ and /gi, "\n");
            work = work.replace(/ +/gi, " ");
            xwork = work.replace(/\[\[/g, "[").replace(/\]\]/g, "]")
            work = work.replace(/\] *, *\[/g, "]\n[")
            work = work.replace(/[\[\]]/g, "")
            work = work.replace(/([a-z])\/(\d+)/ig, "1/$2 $1")
            work = work.replace(/(\n\w+)\.(?!\d)/g, "$1)")
            work = work.replace(/(\n\w+)\)[) ]*/g, "$1) ")
            // funny minus signs
            var re = new RegExp(String.fromCharCode(8211), "g");
            work = work.replace(re, "-");
            var re = new RegExp(String.fromCharCode(8722), "g");
            work = work.replace(re, "-");
            work = work.replace(/^[\n ]*/, "");
            work = work.replace(/\n+/gi, "\n");
            worklines = work.split(/\n/)
            for (i1 = 0; i1 < worklines.length; i1++) {
                work = worklines[i1]
                if (work.search(/:/) > -1) work = work.slice(work.lastIndexOf(":") + 1)
                if (work.search(/[><≥≤]/) > -1) {
                    i2 = work.search(/[<≤]/) > -1
                    work = work.replace(/=*[<>]=*/g, '=') // <= < > >=
                    work = work.replace(/[≥≤]/g, '=')
                    work = (i2 ? "<" : ">") + work
                }
                worklines[i1] = work
            }
            work = "";
            probno = ""
            for (i1 = 0; i1 < worklines.length; i1++) {
                worklinesi1 = worklines[i1] + ""
                if (worklines[i1].search(/^\(*\w{0,3}\)/) == 0) {
                    i2 = worklines[i1].search(/\)/) + 1
                    probno = worklines[i1].substring(0, i2) + " "
                    worklines[i1] = worklines[i1].substring(i2)
                }
                if ((i2 = worklines[i1].search(/=/)) < 0) continue
                if (worklines[i1].charAt(i2 - 1) == ",") work += probno + worklines[i1].slice(0, i2) + "-1*" + worklines[i1].slice(i2 + 1) + "\n"
                else work += probno + worklines[i1].slice(0, i2) + "-1*(" + worklines[i1].slice(i2 + 1) + ")\n"
                probno = ''
            }
            while (work.search(/\{/) > -1) {
                i1 = work.search(/\{/)
                i2 = work.search(/\}/)
                if (i2 < i1) break
                work = work.slice(0, i1) + cleanx(work.slice(i1 + 1, i2), true, false) + work.slice(i2 + 1)
            }
            while (work.length) {
                parseInput()
                if (!getcorners) {
                    calc1();
                    if (!document.theForm.only1.checked) document.theForm.output.value += "\n";
                } else if (xxn == 2) savemb.push(coef[0])
            }
            document.theForm.output.value = document.theForm.output.value.replace(/\n+/g, '\n')
            document.theForm.input.focus();

            if (trimid) {
                xy = [
                    [],
                    [],
                    []
                ]
                graphit = true;
                graphdata = ''
                for (i1 = 0; i1 < xxn; i1++) {
                    xy[i1][0] = -savex[i1][xxn] / savex[i1][i1];
                    xy[i1][1] = -savey[i1][xxn] / savey[i1][i1]
                    graphdata += '(' + xy[i1][0] + ',' + xy[i1][1] + ')'
                }
                i1 = 0;
                graphdata += '(' + xy[i1][0] + ',' + xy[i1][1] + ');\n'
                xmin = Math.min(xy[0][0], xy[1][0], xy[2][0]);
                xmax = Math.max(xy[0][0], xy[1][0], xy[2][0])
                ymin = Math.min(xy[0][1], xy[1][1], xy[2][1]);
                ymax = Math.max(xy[0][1], xy[1][1], xy[2][1])
                graphdata += '(' + (xy[0][0] + xy[1][0]) / 2 + ',' + (xy[0][1] + xy[1][1]) / 2 + ')'
                graphdata += '(' + (xy[1][0] + xy[2][0]) / 2 + ',' + (xy[1][1] + xy[2][1]) / 2 + ')'
                graphdata += '(' + (xy[2][0] + xy[0][0]) / 2 + ',' + (xy[2][1] + xy[0][1]) / 2 + ')'
                graphdata += '(' + (xy[0][0] + xy[1][0]) / 2 + ',' + (xy[0][1] + xy[1][1]) / 2 + ')'
                graphdata = 'x: ' + xmin + ',' + xmax + ';y: ' + ymin + ',' + ymax + ';' + graphdata
            }

        }
        // --------------------------
        function corners() {
            // check for x and y ranges
            work = "\n" + document.theForm.input.value.toLowerCase() + "\n"
            work = work.replace(/(<=*|≤|≥|>=*|=*>) *([xy]) *(=*[<>]=*|≥|≤)/g, "$1$2; $2$3")
            work = work.replace(/([^xy;=\n]*)(<=*|≤) *([xy])/g, "$3>$1")
            work = work.replace(/([^xy;=\n]*)(≥|>=*|=*>) *([xy])/g, "$3<$1")
            work = work.replace(/([xy])(<=*|≤) *([xy])([^xy;]*)/g, "$1<$3")
            work = work.replace(/([xy])(≥|>=*|=*>) *([^xy;]*)/g, "$1>$3")
            document.theForm.input.value = work
            getcorners = true;
            calc();
            getcorners = false
            pointno = 1
            var alllines = '',
                savelines = '',
                A, B, C, F, G, H, X, Y, Z, X1 = 0,
                X2 = 0,
                Y1 = 0,
                Y2 = 0
            for (i1 = 0; i1 < savemb.length > 0; i1++) {
                A = savemb[i1][0];
                B = savemb[i1][1];
                C = savemb[i1][2]
                if (B == 0) theline = 'x=' + (-C / A)
                else {
                    theline = coeff(true, -A / B, 'x', 99) + coeff(-A / B == 0, -C / B, '', 99)
                    if (B < 0)
                        if (savemb[i1][2 * xxn + 1] == "<") savemb[i1][2 * xxn + 1] = ">";
                        else savemb[i1][2 * xxn + 1] = "<"
                }
                alllines += ';' + theline
                theline = '\n' + savemb[i1][2 * xxn + 1] + theline + '; '
                savelines += theline;
                document.theForm.output.value += theline
                for (i2 = 0; i2 < i1; i2++) {
                    F = savemb[i2][0];
                    G = savemb[i2][1];
                    H = savemb[i2][2]
                    if ((Z = F * B - G * A) != 0) {
                        X = (G * C - B * H) / Z;
                        Y = (A * H - F * C) / Z;
                        savelines += "(" + X + ',' + Y + ',, ' + (pointno++) + ');'
                        if (X < X1) X1 = X;
                        if (Y < Y1) Y1 = Y
                        if (X > X2) X2 = X;
                        if (Y > Y2) Y2 = Y
                    }
                }
            }
            if (savelines.length > 0) {
                savelines = "x: " + (X1 - 1) + " to " + (X2 + 1) + "\n y: " + (Y1 - 1) + " to " + (Y2 + 1) + "\n" + savelines + "\n" + alllines
                val1 = escape(savelines.replace(/\n/g, "<nl>").replace(/[;&]/g, "<sc>"))
                localStorage.setItem("graphdata", val1)
                window.open("graphs.php")
            }
        }
        // --------------------------
        function dotriangle() {
            trimid = true;
            calc();
            trimid = false
            val1 = escape(graphdata.replace(/\n/g, "<nl>").replace(/[;&]/g, "<sc>"))
            localStorage.setItem("graphdata", val1)
            window.open("graphs.php")
        }
        // --------------------------
        function calc1() {
            with(Math) {
                if (!document.theForm.only1.checked) document.theForm.output.value += "\n";
                if (document.theForm.inverse.checked) {
                    document.theForm.output.value += "Coefficient matrix:\n"
                    for (i01 = 0; i01 < xxn; i01++) {
                        for (i02 = 0; i02 < xxn; i02++)
                            document.theForm.output.value += (my((coef[i01][i02]))) + ", "
                        document.theForm.output.value += "\n"
                    }
                }
                dump()
                zerod = false;
                determ = 1;
                determ1 = 1
                for (i1 = 0; i1 < xxn; i1++) {
                    ii1 = i1;
                    if (coef[i1][i1] == 0) {
                        for (i2 = i1 + 1; i2 < xxn; i2++) {
                            if (coef[i2][i1] != 0) {
                                for (i3 = 0; i3 <= 2 * xxn; i3++) {
                                    coef[i1][i3] += coef[i2][i3]
                                    // temp=coef[i1][i3]; coef[i1][i3]=coef[i2][i3]; coef[i2][i3]=temp
                                }
                                break;
                            }
                        };
                        for (ii1 = i1; ii1 < xxn; ii1++) {
                            if (coef[i1][ii1] != 0) break;
                        }
                        if (ii1 == xxn) {
                            dump();
                            if (coef[i1][xxn] != 0) {
                                document.theForm.output.value += "inconsistent system - no solutions.";
                            } else {
                                document.theForm.output.value += "dependent system - infinitely many solutions.\n";
                                for (i01 = 0; i01 < i1; i01++) {
                                    for (i02 = 0; i02 < xxn; i02++) {
                                        if (coef[i01][i02] != 0) {
                                            document.theForm.output.value += xx[i02] + "=";
                                            i02x = -coef[i01][i02];
                                            i03y = 0;
                                            for (i03 = i02 + 1; i03 <= xxn; i03++) {
                                                i03x = coef[i01][i03] / i02x;
                                                if ((i03x != 0) || ((i03y == 0) && (i03 == xxn))) {
                                                    i03y = 1;
                                                    document.theForm.output.value += ((i03x >= 0) ? "+" : "-") + (((Math.abs(i03x) != 1) || i03 == xxn) ? (my(Math.abs(i03x))) + "" : "") + xx[i03];
                                                }
                                            }
                                            document.theForm.output.value += "; ";
                                            break;
                                        }
                                    }
                                }
                                // document.theForm.output.value += "\n";
                            };
                            zerod = true;
                        }
                    }
                    if (!zerod) {
                        printsubs = !document.theForm.inverse.checked && !document.theForm.only1.checked && i1 != xxn - 1
                        if (printsubs) {
                            document.theForm.output.value += "substitute/eliminate " + xx[i1] + " = "
                        }
                        for (i2 = 0; i2 < xxn; i2++) {
                            if (i1 != i2) {
                                if (coef[i1][i2] != 0) {
                                    r1 = -coef[i1][i2] / coef[i1][ii1];
                                    if (printsubs) document.theForm.output.value += coeff(false, r1, xx[i2], true)
                                    // (r>0?"+":"-")+(my(Math.abs(r1),true))+xx[i2]
                                };
                                r1 = coef[i2][ii1];
                                r2 = coef[i1][ii1]
                                if (r1 != 0) {
                                    determ1 = determ1 * r2;
                                    for (i3 = 0; i3 <= xxn + xxn; i3++) coef[i2][i3] = (coef[i2][i3] * r2 - coef[i1][i3] * r1)
                                }
                            }
                        }
                        r1 = -coef[i1][xxn] / coef[i1][ii1];
                        if (printsubs) document.theForm.output.value += (r1 > 0 ? "+" : "-") + (my(Math.abs(r1)))
                        if (printsubs) {
                            document.theForm.output.value += "\n"
                        }
                        dump();
                    }
                };
                if (!zerod && document.theForm.inverse.checked) {
                    document.theForm.output.value += "------------------------\nInverse of coefficient matrix:\n"
                    for (i01 = 0; i01 < xxn; i01++) {
                        for (i02 = xxn + 1; i02 <= 2 * xxn; i02++)
                            document.theForm.output.value += (my((coef[i01][i02]) / coef[i01][i01])) + ", "
                        if (i01 < xxn - 1)
                            document.theForm.output.value += "\n"
                    }
                }
                if (document.theForm.cramer.checked) {
                    for (i01 = 0; i01 < xxn; i01++) determ *= coef[i01][i01]
                    determ = determ / determ1
                    document.theForm.output.value += "\ndeterminant of coeff. matrix is " + my(determ) + "\n"
                    if (determ != 0)
                        for (i1 = 0; i1 < xxn; i1++)
                            document.theForm.output.value += (i1 ? "; " : "\nCramer's rule: ") + xx[i1] + " = " + my(-coef[i1][xxn] * determ / coef[i1][i1]) + " / " + determ + " = " + my(-coef[i1][xxn] / coef[i1][i1])
                }
                if (!zerod) {
                    if (!document.theForm.only1.checked) {
                        document.theForm.output.value += "\n\nSolution: ";
                        for (i1 = 0; i1 < xxn; i1++) {
                            document.theForm.output.value += xx[i1] + " = " + my(-coef[i1][xxn] / coef[i1][i1]) + "; ";
                        }
                        document.theForm.output.value += "\n"
                    }
                    document.theForm.output.value += " (";
                    for (i1 = 0; i1 < xxn; i1++) {
                        document.theForm.output.value += (i1 ? ", " : "") + xx[i1];
                    }
                    document.theForm.output.value += ") ="
                    thepoint = " ("
                    for (i1 = 0; i1 < xxn; i1++) {
                        thepoint += (i1 ? ", " : "") + my(-coef[i1][xxn] / coef[i1][i1]);
                    }
                    document.theForm.output.value += thepoint + ")"
                    if (trimid) {
                        if (xx[1][0] == 'x') savex = Mclone(coef);
                        else savey = Mclone(coef)
                    }
                }
            }
        }
    </script>
</body>

</html>