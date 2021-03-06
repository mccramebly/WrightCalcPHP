<!DOCTYPE html>
<html lang="en">

<head>
    <title>Simple Bayes</title>
    <meta charset="utf-8">
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <script type="text/javascript" src="myfunctions.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus();document.ss.venn2.focus();">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name='ss'>
            <h1>Frequentist view of Bayes Theorem</h1>


            <h2>Mode</h2> <br>
            <input name="demobut" type="button" value="DEMO" onClick="demo()">
            <input id='clearallid' name="clear" type="button" value="Clear ALL" onClick="window.open('bayes.php','_self')" />
            <input type="button" value="a/b" id="frac" onClick="swfrac(true)" title="output format"><br>
            <h2>Input</h2><br>
            <label>A:</label><input class="shortinput" type='text' name='venn1' size=5 tabindex="1" value="A" onfocus='legend()'>

            <label>B:</label> <input class="shortinput" type='text' name='venn2' size=12 tabindex="1" value="B" onfocus='legend()'><br>


            <table>

                <tr>
                    <th>
                    </th>
                    <th align='left'>Yes</th>
                    <th align='left'>No</th>
                    <th align='left'>Total</th>
                </tr>
                <tr>
                    <th align=right>Yes</th>
                    <td>
                        <input class="shortinput" type='text' name='cell' size=5 value=" " onfocus='calc()' tabindex="3">
                    </td>
                    <td>
                        <input class="shortinput" type='text' name='cell' size=5 value=" " onfocus='calc()' tabindex="4">
                    </td>
                    <td>
                        <input class="shortinput" type='text' name='cell' size=5 value=" " onfocus='calc()' tabindex="5">
                    </td>
                </tr>
                <tr>
                    <th align=right>No</th>
                    <td>
                        <input class="shortinput" type='text' name='cell' size=5 value=" " onfocus='calc()' tabindex="6">
                    </td>
                    <td>
                        <input class="shortinput" type='text' name='cell' size=5 value=" " onfocus='calc()' tabindex="7">
                    </td>
                    <td>
                        <input class="shortinput" type='text' name='cell' size=5 value=" " onfocus='calc()' tabindex="8">
                    </td>
                </tr>
                <tr>
                    <th align=right>Total</th>
                    <td>
                        <input class="shortinput" type='text' name='cell' size=5 value=" " onfocus='calc()' tabindex="9">
                    </td>
                    <td>
                        <input class="shortinput" type='text' name='cell' size=5 value=" " onfocus='calc()' tabindex="10">
                    </td>
                    <td>
                        <input class="shortinput" type='text' name='cell' size=5 value=" " onfocus='calc()' tabindex="11">
                    </td>
                </tr>
            </table>
            <label>Calculate</label><input type="radio" name="Mode" VALUE="Calculate" checked onClick='calc()'>
            <label>Input</label><input type="radio" name="Mode" VALUE="Enter"> <br>
            <h2>Output</h2>
            <table style="border: none;">
                <tr style="border: none;">
                    <td colspan=4 align=left style="border: none;">
                        <canvas id="theCanvas" width="250" height="150"></canvas>
                        <textarea name="output4" rows=10 cols=15>Probability:
                P(A)=
                P(~A)=
                P(B)=
                P(~B)=
                P(A&#8746;B)=
                P(A&cap;B)=
                P(~A&cup;~B)=
                P(~A&cap;~B)=</textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan=4 align=center style="border: none;">
                        <!--Ask Nadas: is iif or if?-->
                        Independent iif P(A&cap;B) = P(A)P(B) = <input type='text' name='prodab' size=9 value="">
                    </td>
                </tr>
                <tr>
                    <td colspan=4 align=center style="border: none;">
                        <textarea name="output1" rows=6 cols=15>
        P(A|B)=
        P(A|~B)=
        P(B|A)=
        P(B|~A)=
        P(A)*P(B)=
        </textarea>
                        <textarea name="output2" rows=6 cols=15>
        P(~A|B)=
        P(~A|~B)=
        P(~B|A)=
        P(~B|~A)=
        </textarea>
                        <textarea name="output3" rows=6 cols=15>Odds:
        For A=
        For B=
        For A&cup;B=
        For A&cap;B=</textarea>
                    </td>
                </tr>
            </table>
        </form>
        <script>
            frac = 3;
            clearcount = 0
            CU = String.fromCharCode(8746) // cup = union
            CA = String.fromCharCode(8745) // cap = intersection
            cc = [];
            od = []
            var cID = document.getElementById("theCanvas")
            var ctx = cID.getContext("2d")
            cID.onselectstart = function() {
                return false;
            } // ie
            cID.onmousedown = function() {
                return false;
            } // mozilla
            // Canvas variables.
            CXW = cID.width;
            CXM = (CXW - 1) / 2;
            CXD = CXW - 5 // 2 pixel border around graph area
            CYW = cID.height;
            CYM = (CYW - 1) / 2;
            CYD = CYW - 5;
            CYT = CYW - 1 // needed to flip graph
            legend()
            // -------------------------
            function validate(xx1) {
                with(Math) {
                    xx = ('' + document.ss.cell[xx1].value).replace('%', '/100')
                    try {
                        n = eval(cleanx(xx))
                    } catch (err) {
                        n = "NO"
                    }
                    if (typeof n == 'number' && !isNaN(n - n)) return n
                    return ' '
                }
            }
            // -------------------------
            function rule(a, b, c) {
                with(Math) {
                    x = validate(a)
                    y = validate(b)
                    z = validate(c)
                    if ('' + x == ' ' && '' + y != ' ' && '' + z != ' ') document.ss.cell[a].value = my(z - y)
                    else if ('' + x != ' ' && '' + y == ' ' && '' + z != ' ') document.ss.cell[b].value = my(z - x)
                    else if ('' + x != ' ' && '' + y != ' ' && document.ss.cell[c].value != my(x + y)) {
                        document.ss.cell[c].value = my(x + y);
                        if ('' + z != ' ') document.ss.Mode[1].checked = true
                    }
                }
            }
            // --------------------------
            function legend() {
                with(Math) {
                    ctx.fillStyle = "#FFFFFF";
                    ctx.fillRect(0, 0, CXW, CYW)
                    ctx.strokeStyle = 'red'
                    ctx.beginPath();
                    ctx.arc(138, 66, 50, 0, 2 * PI, false);
                    ctx.stroke()
                    ctx.strokeStyle = 'blue'
                    ctx.beginPath();
                    ctx.arc(88, 66, 50, 0, 2 * PI, false);
                    ctx.stroke()
                    ctx.font = "bold 13px Arial";
                    ctx.fillStyle = 'black'
                    ctx.fillText(document.ss.venn1.value, 40, 15)
                    ctx.fillText(document.ss.venn2.value, 170, 15)
                    ctx.fillText(document.ss.cell[1].value, 50, 76)
                    ctx.fillText(document.ss.cell[0].value, 100, 76)
                    ctx.fillText(document.ss.cell[3].value, 150, 76)
                    ctx.fillText(document.ss.cell[4].value, 100, 140)
                }
            }
            // --------------------------
            function demo() {
                if ('' + validate(8) != ' ') {
                    if (typeof(format) == 'boolean') format = 4;
                    else format = true
                    calc();
                    return
                }
                document.ss.venn2.value = 'gloves'
                document.ss.venn1.value = 'hat'
                cci = [4, 3, 7, 5, 8, 13, 9, 11, 20]
                for (i = 0; i < 9; i++) document.ss.cell[i].value = cci[i]
                legend();
                BP()
            }
            // --------------------------
            function BPval(j, not) {
                with(Math) {
                    switch (j) {
                        case 0:
                            if (isNaN(cc[0]) || isNaN(cc[6])) return ' '
                            return my(abs(not - cc[0] / cc[6]))
                        case 1:
                            if (isNaN(cc[1]) || isNaN(cc[7])) return ' '
                            return my(abs(not - cc[1] / cc[7]))
                        case 2:
                            if (isNaN(cc[0]) || isNaN(cc[2])) return ' '
                            return my(abs(not - cc[0] / cc[2]))
                        case 3:
                            if (isNaN(cc[3]) || isNaN(cc[5])) return ' '
                            return my(abs(not - cc[3] / cc[5]))
                    }
                }
            }
            // --------------------------
            function BP() {
                function reduce(a, b) {
                    var c = gcf(a, b);
                    return a / c
                }
                for (var i = 0; i < 9; i++) {
                    cc[i] = validate(i);
                    od[i] = Math.floor(10000 * cc[i] + .5)
                }
                BP1 = "";
                BP2 = "";
                BP3 = "odds:";
                BP4 = "Probability:"
                for (var i = 0; i < 4; i++) {
                    BP1 += (i ? "\n" : "") + "P(" + BPlit[i] + ")=" + BPval(i, 0)
                    BP2 += (i ? "\n" : "") + "P(~" + BPlit[i] + ")=" + BPval(i, 1)
                }
                BP3 += "\nFOR A= " + (isNaN(od[2] * od[5]) ? "" : reduce(od[2], od[5]) + ":" + reduce(od[5], od[2]))
                BP3 += "\nFOR B= " + (isNaN(od[6] * od[7]) ? "" : reduce(od[6], od[7]) + ":" + reduce(od[7], od[6]))
                BP3 += "\nFOR A" + CU + "B= " + (isNaN(od[4] * od[8]) ? "" : reduce(od[8] - od[4], od[4]) + ":" + reduce(od[4], od[8] - od[4]))
                BP3 += "\nFOR A" + CA + "B= " + (isNaN(od[0] * od[8]) ? "" : reduce(od[0], od[8] - od[0]) + ":" + reduce(od[8] - od[0], od[0]))

                if (!isNaN(cc[8])) {
                    BP4 += "\nP(A)= " + (isNaN(cc[2] * cc[8]) ? "" : my(cc[2] / cc[8]))
                    BP4 += "\nP(~A)= " + (isNaN(cc[5] * cc[8]) ? "" : my(cc[5] / cc[8]))
                    BP4 += "\nP(B)= " + (isNaN(cc[6] * cc[8]) ? "" : my(cc[6] / cc[8]))
                    BP4 += "\nP(~B)= " + (isNaN(cc[7] * cc[8]) ? "" : my(cc[7] / cc[8]))
                    BP4 += "\nP(A" + CU + "B)= " + (isNaN(cc[4] * cc[8]) ? "" : my((cc[8] - cc[4]) / cc[8]))
                    BP4 += "\nP(A" + CA + "B)= " + (isNaN(cc[0] * cc[8]) ? "" : my(cc[0] / cc[8]))
                    BP4 += "\nP(~A" + CU + "~B)= " + (isNaN(cc[0] * cc[8]) ? "" : my((cc[8] - cc[0]) / cc[8]))
                    BP4 += "\nP(~A" + CA + "~B)= " + (isNaN(cc[4] * cc[8]) ? "" : my(cc[4] / cc[8]))

                } else {
                    BP4 += "\nP(A)= " + (isNaN(cc[2] * cc[8]) ? "" : cc[2] + "/" + cc[8])
                    BP4 += "\nP(~A)= " + (isNaN(cc[5] * cc[8]) ? "" : cc[5] + "/" + cc[8])
                    BP4 += "\nP(B)= " + (isNaN(cc[6] * cc[8]) ? "" : cc[6] + "/" + cc[8])
                    BP4 += "\nP(~B)= " + (isNaN(cc[7] * cc[8]) ? "" : cc[7] + "/" + cc[8])
                    BP4 += "\nP(A" + CU + "B)= " + (isNaN(cc[4] * cc[8]) ? "" : (cc[8] - cc[4]) + "/" + cc[8])
                    BP4 += "\nP(A" + CA + "B)= " + (isNaN(cc[0] * cc[8]) ? "" : cc[0] + "/" + cc[8])
                    BP4 += "\nP(~A" + CU + "~B)= " + (isNaN(cc[0] * cc[8]) ? "" : (cc[8] - cc[0]) + "/" + cc[8])
                    BP4 += "\nP(~A" + CA + "~B)= " + (isNaN(cc[4] * cc[8]) ? "" : cc[4] + "/" + cc[8])
                }

                document.ss.output1.value = BP1
                document.ss.output2.value = BP2
                document.ss.output3.value = BP3
                document.ss.output4.value = BP4
                document.ss.prodab.value = (isNaN(cc[2] * cc[6] * cc[8]) ? "" : my(cc[2] * cc[6] / cc[8] / cc[8]))
            }
            // --------------------------
            function calc() {
                if (frac > 4) {
                    frac = 1;
                    swfrac()
                }
                if (document.ss.Mode[0].checked) {
                    rule(0, 1, 2)
                    rule(3, 4, 5)
                    rule(6, 7, 8)
                    rule(0, 3, 6)
                    rule(1, 4, 7)
                    rule(2, 5, 8)
                }
                savefrac = frac
                if (validate(8) > 1 && frac == 4) frac = 2
                for (i = 0; i < 9; i++) {
                    ii = validate(i)
                    if ('' + ii != ' ') {
                        document.ss.cell[i].value = my(ii)
                    }
                }
                frac = savefrac
                BP()
                legend()
            }
            // --------------------------

            BPlit = ['A|B', 'A|~B', 'B|A', 'B|~A']
            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                lsd = ls.slice(1).split("&")
                document.ss.venn1.value = lsd[0]
                document.ss.venn2.value = lsd[1]
                document.ss.cell[0].value = lsd[2]
                document.ss.cell[1].value = lsd[3]
                document.ss.cell[3].value = lsd[4]
                document.ss.cell[4].value = lsd[5]
                calc()
                // if (Number(document.ss.cell[8].value)==1) format=4; else format=true
                calc();
                legend();
                BP();

            }

            // --------------------------
        </script>
    </div>
</body>

</html>