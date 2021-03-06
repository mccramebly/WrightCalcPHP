<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="assets/articlestyles.css">
    <title>Area of Rectangle</title>
    <meta charset="utf-8">
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <script src="myfunctions.js"></script>
    <script>
        // ------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 27) resett();
        };
        // ------------------------------------
        function round2(x) {
            xx = "" + (Math.round(x * 100) / 100)
            if (xx.search(/\./) == -1) {
                xx = xx + ".00"
            } else if (xx.charAt(xx.length - 2) == ".") {
                xx = xx + "0"
            }
            return (xx)
        };
        // ------------------------------------
        function cols(x, i) {
            var xi = "                                        " + x;
            return (xi.substr(xi.length - i))
        }
        // ------------------------------------
        function resett() {
            document.theForm.flength.value = 0
            document.theForm.fwidth.value = 0
            document.theForm.farea.value = 0
            document.theForm.input.value = saveinput
            document.theForm.flength.select()
        }
        // ------------------------------------
        function sample() {
            document.theForm.flength.value = 3
            document.theForm.fwidth.value = 5
            document.theForm.farea.value = 30
            document.theForm.blength.focus()
        }
        // ------------------------------------
        function doarea() {
            vlength = cleanx(document.theForm.flength.value, true, false)
            vwidth = cleanx(document.theForm.fwidth.value, true, false)
            document.theForm.farea.value = myround(vlength * vwidth / factors[document.theForm.linch.value] / factors[document.theForm.winch.value] * factors[document.theForm.ainch.value] * factors[document.theForm.ainch.value], fracval[frac])
            document.theForm.input.value = saveinput + '\nAREA = LENGTH × WIDTH = ' + vlength + " " + units[document.theForm.linch.value] + ' × ' + vwidth + " " + units[document.theForm.winch.value] + ' = ' + document.theForm.farea.value + " square " + units[document.theForm.ainch.value]
            document.theForm.flength.select()
        }
        // ------------------------------------
        function dolength() {
            vwidth = cleanx(document.theForm.fwidth.value, true, false)
            varea = cleanx(document.theForm.farea.value, true, false)
            document.theForm.flength.value = myround(varea / vwidth / factors[document.theForm.ainch.value] / factors[document.theForm.ainch.value] * factors[document.theForm.winch.value] * factors[document.theForm.linch.value], fracval[frac])
            document.theForm.input.value = saveinput + '\nLENGTH = AREA ÷ WIDTH = ' + varea + " square " + units[document.theForm.ainch.value] + ' ÷ ' + vwidth + " " + units[document.theForm.winch.value] + ' = ' + document.theForm.flength.value + " " + units[document.theForm.linch.value]
            document.theForm.flength.select()
        }
        // ------------------------------------
        function dowidth() {
            vlength = cleanx(document.theForm.flength.value, true, false)
            varea = cleanx(document.theForm.farea.value, true, false)
            document.theForm.fwidth.value = myround(varea / vlength / factors[document.theForm.ainch.value] / factors[document.theForm.ainch.value] * factors[document.theForm.winch.value] * factors[document.theForm.linch.value], fracval[frac])
            document.theForm.input.value = saveinput + '\nWIDTH = AREA ÷ LENGTH = ' + varea + " square " + units[document.theForm.ainch.value] + ' ÷ ' + vlength + " " + units[document.theForm.linch.value] + ' = ' + document.theForm.fwidth.value + " " + units[document.theForm.winch.value]
            document.theForm.flength.select()
        }
        // ------------------------------------
    </script>
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">

            <h1>Area of Rectangle</h1>
            <textarea name="input" rows=10 cols=68></textarea>
            <input type="button" name="breset" value="Reset" onClick="resett()">
            <input type="button" name="bsample" value="Examples" onClick="sample()">
            <input type="button" value="Output" id="frac" onClick="swfrac(true,4)" title="output format">

            <p>The formula for calculating the AREA of a rectangle is LENGTH times WIDTH
                Using Algebra you can get equivalent formulas for calculating the LENGTH or WIDTH
                In other words, if you know two of the three values, you can calculate the third value.</p>
            <p>
                The three variables usually used for these calculations are:<br>
                A= representing the AREA of the rectangle<br>
                L= representing the LENGTH of the rectangle<br>
                W= representing the WIDTH of the rectangle<br>
                You can calculate any of these values from the others by using the three formulas:<br>
                A= L × W<br>
                L= A ÷ W<br>
                W= A ÷ L
            </p>
            <p>
                To use this app all you have to do is to put values into the boxes, select your units of measure and click on the button for the value you want to calculate.
            </p>



            <h2>Length</h2>
            <input type="button" name="blength" value="Length" onClick="dolength()" tabindex=4>
            <input type="text" name="flength" size=10 value="" tabindex=1><br><br>
            <label>Inches</label><input name="linch" type="radio" title="linch" checked value="0">
            <label>Feet</label><input name="linch" type="radio" title="linch" value="1">
            <label>Miles</label><input name="linch" type="radio" title="linch" value="2">
            <label>Meters</label><input name="linch" type="radio" title="linch" value="3">
            <label>Kilometers</label><input name="linch" type="radio" title="linch" value="4">

            <br><br><br><br>
            <h2>Width</h2>
            <input type="button" name="bwidth" value="Width" onClick="dowidth()" tabindex=5>
            <input type="text" name="fwidth" size=10 value="" tabindex=2><br><br>
            <label>Inches</label><input name="winch" type="radio" title="winch" checked value="0">
            <label>Feet</label><input name="winch" type="radio" title="winch" value="1">
            <label>Miles</label><input name="winch" type="radio" title="winch" value="2">
            <label>Meters</label><input name="winch" type="radio" title="winch" value="3">
            <label>Kilometers</label><input name="winch" type="radio" title="winch" value="4">
            <br><br><br><br>
            <h2>Area</h2>
            <input type="button" name="barea" value="Area" onClick="doarea()" tabindex=6>
            <input type="text" name="farea" size=10 value="" tabindex=3><br><br>
            <label>Inches</label><input name="ainch" type="radio" title="ainch" checked value="0">
            <label>Feet</label><input name="ainch" type="radio" title="ainch" value="1">
            <label>Miles</label><input name="ainch" type="radio" title="ainch" value="2">
            <label>Meters</label><input name="ainch" type="radio" title="ainch" value="3">
            <label>Kilometers</label><input name="ainch" type="radio" title="ainch" value="4" />



        </form>
    </div>




    <script>
        vlength = 0
        vwidth = 0
        varea = 0
        units = ["Inches", "Feet", "Miles", "Meters", "Kilometers"]
        factors = ["63360", "5280", "1", "1609.344", "1.609344"]
        zeta = String.fromCharCode(951)
        alpha = String.fromCharCode(945)
        Sigma = String.fromCharCode(931);
        sigma = String.fromCharCode(963);
        mu = String.fromCharCode(956);
        divide = String.fromCharCode(247)
        radical = String.fromCharCode(8730)
        P2 = String.fromCharCode(178); //squared
        document.theForm.flength.value = 0
        document.theForm.fwidth.value = 0
        document.theForm.farea.value = 0
        document.theForm.flength.select()
        saveinput = document.theForm.input.value
    </script>
</body>

</html>