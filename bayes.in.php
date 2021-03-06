<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bayes Theorem</title>
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <script src="myfunctions.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus();document.ss.venn2.focus();">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name='ss'>
            <h1>Bayes Theorem</h1>
            <input id='clearallid' name="clear" type="button" value="Clear ALL" onClick="window.open('bayes.in.php','_self')" tabindex="9">
            <input name="demobut" type="button" value="DEMO" onClick="demo()" tabindex="10">
            <br>
            <br>
            <label>Event A:</label><input type='text' name='venn2' size=12 tabindex="1" value="A" />
            <label>Event B:</label><input type='text' name='venn1' size=12 tabindex="2" value="B" />
            <label>P(B):</label> <input type='text' name='cell' size=5 value=" " tabindex="3">
            <label>P(A|B):</label> <input type='text' name='cell' size=5 value=" " tabindex="4">
            <label>P(A|~B):</label><input type='text' name='cell' size=5 value=" " tabindex="5">
            <h2></h2>

            <img src="assets/bayes.png">

            <br><br>
            <label>P(B|A) =</label><input type='text' name='answer' size=15 value=" " onfocus='calc()' tabindex="-1"><br>
            <h2></h2>
            <input name="calcbut" type="button" value="Calculate" onClick="calc()" tabindex="6">
            <input type="button" value="a/b" id="frac" onClick="swfrac(true)" title="output format" tabindex="7">
            <input name="showbut" type="button" value="Show Venn" onClick="show()" tabindex="8">

            <br>

        </form>
        <script>
            frac = 3;
            clearcount = 0
            CU = String.fromCharCode(8746) // cup = union
            CA = String.fromCharCode(8745) // cap = intersection
            // --------------------------
            function demo() {
                if (document.ss.venn2.value == "Accident" && document.ss.venn1.value == "Error") {
                    document.ss.venn2.value = "On Time"
                    document.ss.venn1.value = "Catch early bus"
                    document.ss.cell[0].value = ".30"
                    document.ss.cell[1].value = ".90"
                    document.ss.cell[2].value = ".40"
                } else {
                    document.ss.venn2.value = "Accident"
                    document.ss.venn1.value = "Error"
                    document.ss.cell[0].value = "0.1"
                    document.ss.cell[1].value = "0.3"
                    document.ss.cell[2].value = "0.2"
                }
                calc()
            }
            // -------------------------
            function validate(xx1) {
                with(Math) {
                    xx = ('' + xx1).replace('%', '/100')
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
            function calc(xx1) {
                with(Math) {
                    if (frac > 4) {
                        frac = 1;
                        swfrac()
                    }
                    pb = validate(document.ss.cell[0].value)
                    pnb = my(1 - pb, 0)
                    pab = validate(document.ss.cell[1].value)
                    panb = validate(document.ss.cell[2].value)
                    papb = my(pb * pab, 0)
                    pnapb = my(pb - papb, 0)
                    papnb = my(pnb * panb, 0)
                    pnapnb = my(pnb - papnb, 0)
                    document.ss.answer.value = my((pb * pab) / (pb * pab + (1 - pb) * panb))
                }
            }
            // -------------------------
            function show() {
                with(Math) {
                    calc()
                    callthis = 'bayes.php?' + document.ss.venn2.value + '&' + document.ss.venn1.value + '&' + papb + '&' + papnb + '&' + pnapb + '&' + pnapnb
                    window.open(callthis)
                }
            }
            // --------------------------
        </script>
    </div>
</body>

</html>