<!DOCTYPE html>
<html lang="en">

<head>
    <title>Initial Value ODE</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link REL="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="ODE" onLoad="self.focus(); document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <script type="text/javascript" src="myfunctions.js"></script>
    <link REL="shortcut icon" href="favicon.ico">
    <div class="widecalcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">
            <h1>Initial Value ODE</h1>
            <span class="clearFloat">
            <label>f'(x) = </label>
            <input type="text" name="input" tabindex="1" onKeyUp="enter(event)">
            <label>Left x= </label><input type="text" name="x1" size=8 value="" tabindex="3" />
            <label>Right x= </label><input type="text" name="x2" size=8 value="" tabindex="4" />
            <label>Left y = </label><input type="text" name="y1" size=8 value="" tabindex="5" />
            <label>n = </label><input type="text" name="xn" size=3 value="" tabindex="6" />


            <label>Euler</label></span><input type="checkbox" name="Eul" />
            <label>Midpoint</label><input type="checkbox" name="Mid" />
            <label>Heun</label><input type="checkbox" name="Heu" />
            <label>RK3</label><input type="checkbox" name="RK3" /> <br>
            <label>RK4</label><input type="checkbox" name="RK4" checked /> <br><br><br>

            <label>Butcher A: </label><input type='text' name="bta" size=20 value="[[],[.5],[0,.5],[0,0,1]]"><br><span class="clearFloat">
            <label>Tableau B: </label><input type='text' name="btb" size=15 value="[1,2,2,1]">
            <label>Tableau B Toggle:</label><input type="checkbox" name="But" /></span><br><br><br>

            <input name="clear" type="button" value="Calc" onClick="cla();calc1()" tabindex="0" />
            <input type="button" value="8 place" id="frac" onClick="swfrac(true,4)" title="output format" />
            <!-- <input type="checkbox" name="debug" checked/> Steps -->
            <input name="savebut" Value="Save" type="button" onClick="savestuff();document.theForm.input.focus()" />
            <input name="loadbut" Value="Load" type="button" onClick="loadstuff();calc1();document.theForm.input.focus()" />



            <textarea name="output" rows=25 cols=72 tabindex=0></textarea>

        </form>
        <script>
            degrees = false
            var factors = ""
            var highco = 1
            var dnf = true
            var approx = String.fromCharCode(8776)
            var h = 0
            // butcher tableau for RK4
            ba = [
                [],
                [.5],
                [0, .5],
                [0, 0, 1]
            ]
            bb = [1, 2, 2, 1] // weights
            bc = [] // bc[i] = sum ba[i,j]
            // -------------------------------------------------------
            function butcher() {
                // normalize weights
                var t = 0;
                for (var i = 0; i < bb.length; i++) t += bb[i]
                if (t > 0)
                    for (var i = 0; i < bb.length; i++) bb[i] /= t
                // calculate x offsets
                bc = [];
                for (var i = 0; i < ba.length; i++) {
                    t = 0;
                    for (var j = 0; j < i; j++) t += ba[i][j]
                    bc[i] = t
                }
                /*document.theForm.output.value += "\n"+ba+"\n"
                document.theForm.output.value += bb+"\n"
                document.theForm.output.value += bc+"\n"*/
            }
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
            function f(xx, yy) {
                with(Math) {
                    X = xx;
                    Y = yy;
                    return (eval(f1))
                }
            };
            // -------------------------------------------------------
            function docalc() {
                with(Math) {
                    if (document.theForm.But.checked) {
                        document.theForm.output.value += "a:["
                        for (i = 0; i < ba.length; i++) document.theForm.output.value += (i == 0 ? "" : ",") + "[" + ba[i] + "]"
                        document.theForm.output.value += "]; b:[" + myround(bb[0], true)
                        for (i = 1; i < bb.length; i++) document.theForm.output.value += ", " + myround(bb[i], true)
                        document.theForm.output.value += "]; c:[" + bc + "]\n"
                    }
                    var y = y1;
                    yk = []
                    for (xi = 0; xi < xn; xi++) {
                        x = x1 + xi * h;
                        yk[0] = f(x, y)
                        yd = bb[0] * h * yk[0]
                        // document.theForm.output.value += "1:"+yk[0]+"; " //bug
                        for (j = 1; j < ba.length; j++) {
                            yi = y
                            for (k = 0; k < ba[j].length; k++) yi += h * ba[j][k] * yk[k]
                            xxx = x + bc[j] * h
                            yk[j] = f(x + bc[j] * h, yi)
                            yd += bb[j] * h * yk[j]
                            // document.theForm.output.value += (j+1)+":"+yk[j]+"; "  //bug
                        }
                        // if (document.theForm.debug.checked)
                        {
                            document.theForm.output.value += "(" + my(x) + "," + my(y) + ") f'=" + my(yd / h) + ", "
                        }
                        y += yd
                    }
                    x = x1 + xi * h;
                    document.theForm.output.value += "\n(" + my(x) + "," + my(y) + ")"
                }
            }
            // -------------------------------------------------------
            function Eul() {
                with(Math) {
                    ba = [
                        []
                    ];
                    bb = [1];
                    butcher()
                    document.theForm.output.value += "\nEuler: ";
                    docalc()
                }
            }
            // -------------------------------------------------------
            function Mid() {
                with(Math) {
                    ba = [
                        [],
                        [.5]
                    ];
                    bb = [0, 1];
                    butcher()
                    document.theForm.output.value += "\nMidpoint: ";
                    docalc()
                }
            } // -------------------------------------------------------
            function Heu() {
                with(Math) {
                    ba = [
                        [],
                        [1]
                    ];
                    bb = [1, 1];
                    butcher()
                    document.theForm.output.value += "\nHeun: ";
                    docalc()
                }
            }
            // -------------------------------------------------------
            function RK3() {
                with(Math) {
                    ba = [
                        [],
                        [.5],
                        [-1, 2]
                    ];
                    bb = [1, 4, 1];
                    butcher()
                    document.theForm.output.value += "\nRK3: ";
                    docalc()
                }
            }
            // -------------------------------------------------------
            function RK4() {
                with(Math) {
                    ba = [
                        [],
                        [.5],
                        [0, .5],
                        [0, 0, 1]
                    ];
                    bb = [1, 2, 2, 1];
                    butcher()
                    document.theForm.output.value += "\nRK4: ";
                    docalc()
                }
            }
            // -------------------------------------------------------
            function BCal() {
                eval("ba=" + document.theForm.bta.value);
                eval("bb=" + document.theForm.btb.value)
                butcher();
                document.theForm.output.value += "\n";
                docalc()
            }
            // -------------------------------------------------------
            function calc1() {
                with(Math) {
                    x1 = eval(document.theForm.x1.value);
                    if (x1 == undefined) x1 = 0
                    x2 = eval(document.theForm.x2.value);
                    if (x2 == undefined) x2 = 10
                    y1 = eval(document.theForm.y1.value);
                    if (y1 == undefined) y1 = 0
                    if (x1 == x2) x2 = x1 + 1
                    if (x2 < x1) {
                        xn = x2;
                        x2 = x1;
                        x1 = xn
                    }
                    document.theForm.x1.value = x1;
                    document.theForm.x2.value = x2;
                    document.theForm.y1.value = y1;
                    xn = eval(document.theForm.xn.value);
                    if (xn == undefined) {
                        xn = 10;
                        document.theForm.xn.value = xn
                    }
                    h = (x2 - x1) / xn
                    f1 = document.theForm.input.value.replace(/\n/g, "")
                    if (f1.length == 0) {
                        f1 = "x^2+y";
                        document.theForm.input.value = f1
                        document.theForm.Eul.checked = true
                        document.theForm.Mid.checked = true
                        document.theForm.Heu.checked = true
                        document.theForm.RK3.checked = true
                        document.theForm.RK4.checked = true
                    }
                    f1 = f1.replace(/^[ ]*/g, "");
                    f1 = f1.replace(/[ ]*$/g, "")
                    while (f1.charAt(0) == "(" && f1.charAt(f1.length - 1) == ")") f1 = f1.slice(1, f1.length - 1)
                    // convert single variable to x.
                    xvar = f1.search(/[^A-Z][A-Z][^A-Z]/i)
                    if (xvar > -1) {
                        xvar = f1.charAt(xvar + 1).toUpperCase()
                        if (xvar != 'X' && xvar != "Y") {
                            var re = new RegExp(xvar, "gi");
                            f1 = f1.replace(re, 'X')
                        }
                    }
                    f1 = cleanx(f1)
                    document.theForm.output.value += "f'(x)=" + document.theForm.input.value + "\n"
                    document.theForm.output.value += "n=" + xn + "; h=" + h + ": from (" + round4(x1) + "," + round4(y1) + ")"
                    if (document.theForm.Eul.checked) Eul()
                    if (document.theForm.Mid.checked) Mid()
                    if (document.theForm.Heu.checked) Heu()
                    if (document.theForm.RK3.checked) RK3()
                    if (document.theForm.RK4.checked) RK4()
                    if (document.theForm.But.checked) BCal()
                    document.theForm.output.value += "\n"
                    // document.theForm.output.value += "\n";
                    document.theForm.input.focus();
                }
            };
        </script>
    </div>
</body>

</html>