<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vedic Multiplication</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/simple-calc-style.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="vedic" onLoad="self.focus();document.theForm.a.focus()">
    <script src="myfunctions.js"></script>
    <script src="matrix.js"></script>
    <script>
        var x, y, z, c1, c2, a = ''
        fillerchar = String.fromCharCode(183)
        vvv = [
            ['8675412903', '4325890716'],
            ['105263157894736842', '2'],
            ['1034482758620689655172413793', '3'],
            ['102564', '4'],
            ['102040816326530612244897959183673469387755102040816326530612244897959183673469387755', '5'],
            ['1016949152542372881355932203389830508474576271186440677966', '6'],
            ['1014492753623188405797', '7'],
            ['1012658227848', '8'],
            ['10112359550561797752808988764044943820224719', '9']
        ]
        vvi = 0
        // ---------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) {
                calc();
                return
            }
            if (charCode == 27) {
                clere();
                return
            };
        }
        // ---------------------------------------------------
        function clere() {
            if (document.theForm.a.value != "") vvv.push([document.theForm.a.value, document.theForm.b.value])
            document.theForm.a.value = ""
            document.theForm.b.value = ""
        }
        //-----------------------
        function calc() {
            a = document.theForm.a.value.replace(/ /g, "");
            b = document.theForm.b.value.replace(/ /g, "")
            if (a.length == 0) {
                a = vvv[vvi][0];
                b = vvv[vvi][1];
                vvi = (vvi + 1) % vvv.length
            }
            aa = a;
            bb = b
            while (a.length < b.length) a = "0" + a
            while (b.length < a.length) b = "0" + b
            document.theForm.output.value = "Multiply " + aa + " by " + bb
            document.theForm.output.value += "\n   From computer: " + (Number(aa) * Number(bb))
            document.theForm.output.value += "\n    Vedic answer: "

            c1 = "                      ";
            c2 = "";
            L = a.length;
            N = 1;
            cc = []
            for (x = 2 * L - 2; x >= 0; x--) {
                c = 0;
                ccval1 = "";
                for (y = 0; y < L; y++) {
                    z = x - y;
                    if (z > -1 && z < L) {
                        c += 1 * a[y] * b[z];
                        ccval1 += "+" + a[y] + "×" + b[z]
                    }
                }
                ccval = ("    " + c).slice(-4) + c2
                var re = new RegExp(fillerchar, "g")
                cci = 0;
                ccval = ccval.replace(/ /g, "").replace(re, "0")
                while (ccval.length > 0) {
                    while (cci >= cc.length) cc.push(0)
                    cc[cci++] += Number(ccval.slice(-1));
                    ccval = ccval.slice(0, ccval.length - 1)
                }
                c2 += fillerchar;
                c1 = c1.slice(1)
            }
            // document.theForm.output.value +="\n" + cc
            cary = 0;
            ccc = ""
            while (cc.length > 0) {
                cc1 = Number(cc.shift()) + cary;
                cc2 = cc1 % 10;
                if (cc2 == 0) ccc = "0" + ccc;
                else ccc = "" + cc2 + ccc
                cary = (cc1 - cc2) / 10
            }
            if (cary > 0) ccc = "" + cary + ccc
            while (ccc.charAt(0) == "0") ccc = ccc.slice(1)
            document.theForm.output.value += ccc + "\n  High precision: " + hpmul(aa, bb)

            c1 = "......................";
            c2 = "";
            L = a.length;
            N = 1;
            cc = []
            for (x = 2 * L - 2; x >= 0; x--) {
                c = 0;
                ccval1 = "";
                for (y = 0; y < L; y++) {
                    z = x - y;
                    if (z > -1 && z < L) {
                        c += 1 * a[y] * b[z];
                        ccval1 += "+" + a[y] + "×" + b[z]
                    }
                }
                ccval = ("...." + c).slice(-4) + c2
                document.theForm.output.value += "\n" + ("   " + (N++)).slice(-3) + c1 + ccval + "=" + ccval1.slice(1)
                var re = new RegExp(fillerchar, "g")
                cci = 0;
                ccval = ccval.replace(/ /g, "").replace(re, "0")
                while (ccval.length > 0) {
                    while (cci >= cc.length) cc.push(0)
                    cc[cci++] += Number(ccval.slice(-1));
                    ccval = ccval.slice(0, ccval.length - 1)
                }
                c2 += fillerchar;
                c1 = c1.slice(1)
            }
            while (ccc.length < 25) ccc = "." + ccc;
            document.theForm.output.value += "\n  A." + ccc
        }
    </script>
    <?php include('nav.html'); ?>
    <div id="calctainer">
        <a href="index.php"><img src="assets/calcheadertrim.png" class="calcheader"></a>
        <h1>Vedic Multiplication</h1>
        <form name="theForm">
            <span><label for="a">First number to multiply:</label>
                <input type="text" name="a" id="a" size=30 rows=1 tabindex=1 value="" /></span>
            <span><label for="b">Second number to multiply:</label>
                <input type="text" name="b" id="b" size=30 rows=1 tabindex=2 value="" /></span>
            <textarea name="output"></textarea>
            <div id="buttons">
                <input class="calcButton" name="resbut" tabindex=3 Value="Calculate" type="button" onClick="calc()" onKeyUp="enter(event)" />
                <input name="clrbut" tabindex=4 Value="Clear" type="button" onClick="clere()" /></div>
        </form>
    </div>
    <script>
        calc()
    </script>
</body>

</html>