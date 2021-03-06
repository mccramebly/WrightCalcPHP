<!DOCTYPE html>
<html lang="en">

<head>
    <title>JS Polynomials</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/complex-calc.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="polynomials">
    <?php include('nav.html'); ?>
    <script src="myfunctions.js"></script>
    <script>
        var vars = []
        var numerator = []
        var denominator = []
        var lastans = 0
        var vertex = []
        var point = []
        var focus = []
        var directrix
        var latus
        // ---------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            // document.theForm.output.value += " "+charCode+"="+String.fromCharCode(charCode); return
            if (charCode == 13) {
                calc();
                return
            }
            if (charCode == 187) {
                calc();
                return
            }
            if (charCode == 27) {
                clere();
                return
            };
        }
        // ---------------------------------------------------
        function putx(x) {
            //IE support
            if (document.selection) {
                document.theForm.input.focus();
                sel = document.selection.createRange();
                sel.text = x
            } else if (document.theForm.input.selectionStart || document.theForm.input.selectionStart == '0') { //MOZILLA/NETSCAPE support
                var startPos = document.theForm.input.selectionStart;
                var endPos = document.theForm.input.selectionEnd;
                var cursorPos = startPos + x.length;
                document.theForm.input.value = document.theForm.input.value.substring(0, startPos) + x + document.theForm.input.value.substring(endPos, document.theForm.input.value.length);
                document.theForm.input.selectionStart = document.theForm.input.value.length
                document.theForm.input.selectionEnd = document.theForm.input.value.length
            } else {
                document.theForm.input.value += x
            }
            document.theForm.input.focus()
        }
        // ---------------------------------------------------
        function clere() {
            document.theForm.input.value = "points ( , ), ( , ), ( , ), vertex ( , ), focus ( , ), directrix x = ( )                                                     function y = (  ,  ,  )  /  ( 1 )"
            putx("")
        }
        // ---------------------------------------------------
        function parabola() {}
        // ---------------------------------------------------
        function calc(evt) {
            ex = document.theForm.input.value
            ex = ex.replace(/, *\)/g, ")");
            ex = ex.replace(/, *\)/g, ")");
            ex = ex.replace(/, *\)/g, ")");
            ex = ex.replace(/\( *\)/g, "");
            document.theForm.input.value = ex


        }
    </script>
    <div id="calctainer">
        <a href="index.php"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <h1>Polynomial Calculator</h1>
        <form name="theForm">
            <div id="inputOutputGroup">
                <textarea name="input" rows=4 cols=80 tabindex="1" onKeyUp="enter(event)">points ( , ), ( , ), ( , ), vertex ( , ), focus ( , ), directrix x = ( )
function y = (  ,  ,  )  /  ( 1 )</textarea>
                <textarea name="output" rows=9 cols=80 tabindex="2" onKeyUp="enter(event)"></textarea>
                <div id="clearSave">
                    <input name="clerebut" Value="Clear" type="button" onClick="clere()" />
                    <input name="fracbut" Value="Frac" type="button" onClick="tofrac()" />

                </div>
            </div>

            <div id="digitsGroup">
                <input type="button" value="1" onClick="putx('1')" class="digit">
                <input type="button" value="2" onClick="putx('2')" class="digit">
                <input type="button" value="3" onClick="putx('3')" class="digit">
                <input type="button" value="+" onClick="putx('+')" />
                <input type="button" value="4" onClick="putx('4')" class="digit">
                <input type="button" value="5" onClick="putx('5')" class="digit">
                <input type="button" value="6" onClick="putx('6')" class="digit">
                <input type="button" value="-" onClick="putx('-')">
                <input type="button" value="7" onClick="putx('7')" class="digit">
                <input type="button" value="8" onClick="putx('8')" class="digit">
                <input type="button" value="9" onClick="putx('9')" class="digit">
                <input type="button" value="*" onClick="putx('*')" />
                <input type="button" value=" ." onClick="putx('.')" />
                <input type="button" value="0" onClick="putx('0')" class="digit">
                <input type="button" value="," onClick="putx(',')" />
                <input type="button" value="/" onClick="putx('/')" />
            </div>

            <div id="buttonGroup1">
                <input type="button" value="x" onClick="putx('x')" />
                <input type="button" value="P I" onClick="putx('π')" />
                <input type="button" value="&deg;" onClick="putx('°')" />
                <input type="button" value="&#8730;" onClick="putx('√(')" />
                <input type="button" value="&#178;" onClick="putx('²')" />
                <input type="button" value="(" onClick="putx('(')" />
                <input type="button" value=")" onClick="putx(')')" />
                <input type="button" value="^" onClick="putx('^')" />
            </div>

            <div id="buttonGroup2">
                <input type="button" value="Last Answer" onClick="putx(lastans)" />
                <input type="button" value="exp" onClick="putx('exp(')" />
                <input type="button" value="ln" onClick="putx('ln(')" />
                <span>
                    <input id="degrees" name="degrees" type="checkbox" checked /><label for="degrees">Degrees</label>
                </span>
            </div>

            <div id="sinCosTan">
                <input type="button" value="cos" onClick="putx('cos(')" />
                <input type="button" value="acos" onClick="putx('acos(')" />
                <input type="button" value="sin" onClick="putx('sin(')" />
                <input type="button" value="asin" onClick="putx('asin(')" />
                <input type="button" value="tan" onClick="putx('tan(')" />
                <input type="button" value="atan" onClick="putx('atan(')" />
            </div>


            <input name="calcbut" Value="Calculate" type="button" onClick="calc()" class="calcButton">
        </form>
    </div>
</body>

</html>