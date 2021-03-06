<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Javascript dev sandbox </title>
    <link rel="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onload="self.focus();document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <script src="myfunctions.js"></script>
    <script>
        stack = ["x=2;2x", "x=12;x-(0)"]
        degrees = true
        // --------------------------
        function dump(what) {
            function dumpexpr(FX) {
                document.theForm.output3.value += "[";
                comma = "";
                for (var i = 0; i < FX.length; i++) {
                    document.theForm.output3.value += comma;
                    if (typeof(FX[i]) == 'object') {
                        dumpexpr(FX[i])
                    } else if (typeof(FX[i]) == 'string') {
                        document.theForm.output3.value += '"' + FX[i] + '"'
                    } else {
                        document.theForm.output3.value += FX[i]
                    };
                    comma = ","
                }
                document.theForm.output3.value += "]"
            }
            dumpexpr(what)
            document.theForm.output3.value += " & " + XX.length + " VARS: ";
            comma = ""
            for (i = 0; i < XX.length; i++) {
                document.theForm.output3.value += comma + XX[i];
                comma = ","
            }
            document.theForm.output3.value += "\n"
            return
        }
        // ---------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) exec();
            if (charCode == 27) clere();
        };
        // ---------------------------------------------------
        function copy() {
            if (stack.length > 0) {
                document.theForm.input.value = stack.pop()
            } else {
                clere()
            }
            document.theForm.input.focus()
        }
        // ---------------------------------------------------
        function clere(clOutOnly) {
            document.theForm.input.value = document.theForm.input.value.replace(/[\n; ]+$/, "").replace(/^[\n; ]+/, "")
            stack.push(document.theForm.input.value)
            if (!clOutOnly) document.theForm.input.value = ""
            document.theForm.output1.value = ""
            document.theForm.output2.value = ""
            document.theForm.output3.value = ""
            document.theForm.output4.value = ""
            document.theForm.output5.value = ""
            document.theForm.input.focus()
        }
        // ---------------------------------------------------
        function exec() {
            with(Math) {
                clere(true)
                degrees = document.theForm.degrees.checked
                expr = document.theForm.input.value
                document.theForm.output1.value = clean(expr) + " → " + cleanx(expr);
                try {
                    eval(cleanx(expr))
                } catch (err) {
                    document.theForm.output1.value += "  ** JS error **";
                    return
                }
                document.theForm.output1.value += "\n"

                var expr0 = expr.slice(0, expr.lastIndexOf(";") + 1)
                var expr1 = expr.slice(expr.lastIndexOf(";") + 1)
                document.theForm.output2.value = expr1
                jsx1 = clean(expr1);
                document.theForm.output2.value += " → " + jsx1
                jsx2 = cleanx(expr1);
                document.theForm.output2.value += " → " + jsx2
                try {
                    document.theForm.output2.value += " = " + eval(jsx2);
                } catch (err) {
                    document.theForm.output2.value += "  ** JS Error **";
                    return
                }

                FX1 = parse(jsx1)
                dump(FX1)

                FX2 = fx2xx(FX1)
                document.theForm.output4.value = FX2 + "\n"

                FX3 = cleanx(FX2)
                document.theForm.output5.value += FX3
                try {
                    document.theForm.output5.value += " → " + eval(FX3)
                } catch (err) {
                    document.theForm.output5.value += "** JS Error **";
                    return
                }
            }
        };
        // ---------------------------------------------------
    </script>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">

            <div class="button3row">
                <div class="button1"><label>Deg.</label><input name="degrees" checked="checked" type="checkbox"></div>
                <div class="button2"><input name="execbut" value="Calculate" onclick="exec(); document.theForm.input.focus()" type="button"></div>
                <div class="button3"><input name="clerebut" value="Clear" onclick="clere()" type="button"></div>
            </div>
            <div class="button3row">
                <div class="button1"><input name="copybut" value="Pop" onclick="copy()" type="button"></div>
                <div class="button2"><input name="savebut" value="Save" onclick="savestuff();document.theForm.input.focus()" type="button"></div>
                <div class="button3"><input name="loadbut" value="Load" onclick="loadstuff();exec();document.theForm.input.focus()" type="button"></div>
            </div>

            <h2>&nbsp;</h2>
            <label>input:</label>
            <!--x=90*pirad; sin((45*pirad)-(x/2)); x=90; sin((45)-(x/2)) ; ; fact(4)^2*2  -->
            <textarea name="input" rows="2" cols="50" tabindex="1" onkeyup="enter(event)">x=4; (x^2+1)/sqrt(x)</textarea>
            <label>clean(input) → cleanx(input)</label>
            <textarea name="output1" rows="2" cols="50" tabindex="2" onkeyup="enter(event)"></textarea>
            <label>expr → clean(expr) → cleanx(expr) = eval(cleanx(expr))</label>
            <textarea name="output2" rows="2" cols="50" tabindex="2" onkeyup="enter(event)"></textarea>
            <label>FX1 = parse(expr) &amp; vars</label>
            <textarea name="output3" rows="2" cols="50" tabindex="2" onkeyup="enter(event)"></textarea>
            <label>FX2 = fx2xx(FX1)</label>
            <textarea name="output4" rows="2" cols="50" tabindex="2" onkeyup="enter(event)"></textarea>
            <label>FX3 = cleanx(FX2) → eval(FX3)</label>
            <textarea name="output5" rows="2" cols="50" tabindex="2" onkeyup="enter(event)"></textarea>
        </form>
    </div>
</body>

</html>