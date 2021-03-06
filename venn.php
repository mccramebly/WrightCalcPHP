<!DOCTYPE html>
<html lang="en">

<head>
    <title>Venn Diagram</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus()">
    <?php include('nav.html'); ?>
    <div class="widecalcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <script type="text/javascript" src="myfunctions.js"></script>
        <form name='ss'>


            <h1>Venn Diagram</h1>
            <input name="clear" type="button" value="Clear ALL" onClick="window.open('venn.php','_self')" /><input name="demobut" type="button" value="DEMO" onClick="demo()" /> &nbsp; <input name="pcntbut" type="button" value="PCNT" onClick="pcnt()" /> &nbsp; <br><br>

            <h2>A</h2>
            <label>A:</label><input type='text' name='nA' size=15 tabindex="1" value="A" onblur='legend()'><br>
            <label>Only A:</label><input type='text' name='a' size=5 tabindex="4" value="" onblur='legend()'><br>
            <label>Only A &amp; C: </label><input type='text' name='ac' size=5 tabindex="7" value="" onblur='legend()'><br>
            <div id='sum1'></div>
            <h2>B</h2><br>
            <label> B:</label><input type='text' name='nB' size=15 tabindex="2" value="B" onblur='legend()'><br>
            <label>Only B:</label><input type='text' name='b' size=5 tabindex="6" value="" onblur='legend()'><br>
            <label>Only B &amp; C: </label><input type='text' name='bc' size=5 tabindex="9" value="" onblur='legend()'><br>
            <label>None: </label><input type='text' name='x' size=5 tabindex="11" value="" onblur='legend()'><br>
            <div id='sum2'></div>
            <h2>C</h2><br>
            <label>C:</label><input type='text' name='nC' size=15 tabindex="3" value="C" onblur='legend()'><br>
            <label>Only A &amp; B: </label><input type='text' name='ab' size=5 tabindex="5" value="" onblur='legend()'><br>
            <label>All three: </label><input type='text' name='abc' size=5 tabindex="8" value="" onblur='legend()'><br>
            <label>Only C:</label><input type='text' name='c' size=5 tabindex="10" value="" onblur='legend()'><br>
            <div id='sum3'></div>

            <canvas id="theCanvas" width="500" height="400"></canvas>
        </form>
        <script>
            ispcnt = false
            CU = String.fromCharCode(8746) // cup = union
            CA = String.fromCharCode(8745) // cap = intersection
            cc = []
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
            document.ss.nA.select()
            // --------------------------
            function legend() {
                with(Math) {
                    a = Number(document.ss.a.value)
                    b = Number(document.ss.b.value)
                    c = Number(document.ss.c.value)
                    ab = Number(document.ss.ab.value)
                    bc = Number(document.ss.bc.value)
                    ac = Number(document.ss.ac.value)
                    abc = Number(document.ss.abc.value)
                    x = Number(document.ss.x.value)
                    if (ispcnt) U = (x + a + b + c + ab + ac + bc + abc);
                    else U = 1


                    if (ispcnt) Q = 4;
                    else Q = 0
                    document.getElementById("sum1").innerHTML =
                        "<label>" + document.ss.nA.value + ": </label><input type='text' value='" + my((a + ab + ac + abc) / U, Q) +
                        "' disabled><br><label>Only " + document.ss.nA.value + ": </label><input type='text' value='" + my((a) / U, Q) +
                        "' disabled><br><label>Only " + document.ss.nA.value + "&cap;" + document.ss.nB.value + ": </label><input type='text' value='" + my((ab) / U, Q) +
                        "' disabled><br><label>" + document.ss.nA.value + "&cap;" + document.ss.nB.value + ": </label><input type='text' value='" + my((ab + abc) / U, Q) +
                        "' disabled><br><label>" + document.ss.nA.value + "&cup;" + document.ss.nB.value + ": </label><input type='text' value='" + my((a + b + ab + ac + bc + abc) / U, Q) +
                        "' disabled><br><label>NONE: </label><input type='text' value='" + my((x) / U, Q) +
                        "' disabled><br><label>ALL THREE: </label><input type='text' value='" + my((abc) / U, Q) +
                        "' disabled>"
                    document.getElementById("sum2").innerHTML =
                        "<label>" + document.ss.nB.value + ": </label><input type='text' value='" + my((b + ab + bc + abc) / U, Q) +
                        "' disabled><br><label>Only " + document.ss.nB.value + ": </label><input type='text' value='" + my((b) / U, Q) +
                        "' disabled><br><label>Only " + document.ss.nB.value + "&cap;" + document.ss.nC.value + ": </label><input type='text' value='" + my((bc) / U, Q) +
                        "' disabled><br><label>" + document.ss.nB.value + "&cap;" + document.ss.nC.value + ": </label><input type='text' value='" + my((bc + abc) / U, Q) +
                        "' disabled><br><label>" + document.ss.nB.value + "&cup;" + document.ss.nC.value + ": </label><input type='text' value='" + my((b + c + ab + ac + bc + abc) / U, Q) +
                        "' disabled><br><label>ONLY ONE: </label><input type='text' value='" + my((a + b + c) / U, Q) +
                        "' disabled><br><label>AT LEAST TWO: </label><input type='text' value='" + my((ab + ac + bc + abc) / U, Q) +
                        "' disabled>"

                    document.getElementById("sum3").innerHTML =
                        "<label>" + document.ss.nC.value + ": </label><input type='text' value='" + my((c + ac + bc + abc) / U, Q) +
                        "' disabled><br><label>Only " + document.ss.nC.value + ": </label><input type='text' value='" + my((c) / U, Q) +
                        "' disabled><br><label>Only " + document.ss.nA.value + "&cap;" + document.ss.nC.value + ": </label><input type='text' value='" + my((ac) / U, Q) +
                        "' disabled><br><label>" + document.ss.nA.value + "&cap;" + document.ss.nC.value + ": </label><input type='text' value='" + my((ac + abc) / U, Q) +
                        "' disabled><br><label>" + document.ss.nA.value + "&cup;" + document.ss.nC.value + ": </label><input type='text' value='" + my((a + c + ab + ac + bc + abc) / U, Q) +
                        "' disabled><br><label>ONLY TWO: </label><input type='text' value='" + my((ab + ac + bc) / U, Q) +
                        "' disabled><br><label>EVERYONE: </label><input type='text' value='" + my((x + a + b + c + ab + ac + bc + abc) / U, Q) +
                        "' disabled>"

                    ctx.fillStyle = "#FFFFFF";
                    ctx.fillRect(0, 0, CXW, CYW)
                    ctx.strokeStyle = 'red'
                    ctx.beginPath();
                    ctx.arc(300, 140, 100, 0, 2 * PI, false);
                    ctx.stroke()
                    ctx.strokeStyle = 'blue'
                    ctx.beginPath();
                    ctx.arc(180, 140, 100, 0, 2 * PI, false);
                    ctx.stroke()
                    ctx.strokeStyle = 'green'
                    ctx.beginPath();
                    ctx.arc(240, 250, 100, 0, 2 * PI, false);
                    ctx.stroke()
                    ctx.font = "bold 13px Arial";
                    ctx.fillStyle = 'black'
                    ctx.fillText(document.ss.nA.value, 40, 20)
                    ctx.fillText(document.ss.nB.value, 360, 20)
                    ctx.fillText(document.ss.nC.value, 20, 330)
                    ctx.fillText(document.ss.a.value, 140, 140)
                    ctx.fillText(document.ss.b.value, 320, 140)
                    ctx.fillText(document.ss.c.value, 230, 300)
                    ctx.fillText(document.ss.ab.value, 230, 140)
                    ctx.fillText(document.ss.ac.value, 190, 200)
                    ctx.fillText(document.ss.bc.value, 270, 200)
                    ctx.fillText(document.ss.abc.value, 230, 180)
                    ctx.fillText('none: ' + document.ss.x.value, 400, 330)
                }
            }
            // --------------------------
            function pcnt() {
                ispcnt = !ispcnt
                if (ispcnt) document.ss.pcntbut.value = "Counts";
                else document.ss.pcntbut.value = "PCNT"
                legend()
            }
            // --------------------------
            function demo() {
                //Solution: a = 21; ab = 10; abc = 7; ac = 15; b = 18; bc = 8; c = 4; x = 2;
                //a:comedy  , b:drama   , c:science fiction   :
                // ?comedy;drama;sciencefiction;21;10;7;15;18;8;4;2;
                document.ss.nA.value = 'Comedy'
                document.ss.nB.value = 'Drama'
                document.ss.nC.value = 'Sci Fi'
                document.ss.a.value = 21
                document.ss.ab.value = 10
                document.ss.abc.value = 7
                document.ss.ac.value = 15
                document.ss.b.value = 18
                document.ss.bc.value = 8
                document.ss.c.value = 4
                document.ss.x.value = 2
                legend()
            }


            // --------program starts here------------------

            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                ls = ls.slice(1).split("&").join(';').split(";")
                document.ss.nA.value = ls[0]
                document.ss.nB.value = ls[1]
                document.ss.nC.value = ls[2]
                document.ss.a.value = ls[3]
                document.ss.ab.value = ls[4]
                document.ss.b.value = ls[5]
                document.ss.ac.value = ls[6]
                document.ss.abc.value = ls[7]
                document.ss.bc.value = ls[8]
                document.ss.c.value = ls[9]
                document.ss.x.value = ls[10]
                legend()
            }
        </script>
    </div>
</body>

</html>