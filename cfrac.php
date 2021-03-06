<!DOCTYPE html>
<html lang="en">

<head>
    <title>Continued Fraction Operations</title>
    <meta charset="utf-8">
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus();document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <script src="myfunctions.js"></script>
        <script>
            // ---------------------------------------------------*/
            function enter(evt) {
                var KEYcode = evt.keyCode;
                if (KEYcode == 13) {
                    ;
                    return
                }
                if (KEYcode == 27) {
                    ;
                    return
                }
            }
            // ---------------------------------------------------*/
            function cfr2rat() {
                document.theForm.input.value = ''
                bb = document.theForm.cfracdata.value
                bl = bb.split('\n')
                for (l = 0; l < bl.length; l++) {
                    b = bl[l]
                    b = b.replace(/;/g, ',').replace(/[ \[\]]/g, '')
                    eval("C=[" + b + "]")
                    repfrac = (C[C.length - 1] == '.')
                    if (repfrac) C.pop()
                    n1 = 1;
                    d1 = 0;
                    n2 = C[0];
                    d2 = 1;
                    do {
                        for (k = 1; k < C.length; k++) {
                            n3 = C[k] * n2 + n1;
                            d3 = C[k] * d2 + d1
                            n1 = n2;
                            n2 = n3;
                            d1 = d2;
                            d2 = d3
                        }
                    } while (repfrac && Math.abs((n2 / d2 - n1 / d1) / (n2 / d2)) > .0000000000001)
                    print(n3 / d3)
                }
            }
            // ---------------------------------------------------*/
            function rat2cfr() {
                document.theForm.input.value = ''
                bb = document.theForm.ratdata.value
                bl = bb.split('\n')
                for (l = 0; l < bl.length; l++) {
                    b = cleanx(bl[l], true)
                    C = [];
                    C.push(floor(b))
                    print(b, C)
                }
            }
            // ---------------------------------------------------*/
        </script>

        <h2>Continued Fraction Operations</h2>
        <form name="theForm">
            <textarea name="ratdata" rows=9 cols=68 onKeyUp="enter(event)">11/13
11/13
sqrt(3)+1
√(21)
        </textarea>
            <h2>Rational Numbers:</h2>

            <textarea name="cfracdata" rows=9 cols=68 onKeyUp="enter(event)">[0;1,5,2]
[0;1,5,1,1]
[2;1,2,'.']
[4; 1, 1, 2, 1, 1, 8, '.' ]</textarea>

            <h2>Continued Fraction:</h2>

            <textarea name="input" rows=9 cols=68 onKeyUp="enter(event)"></textarea>
            <br>

            <input name="rationalbut" value="rat2cfrac" type="button" onClick="rat2cfr()" />
            <input name="cfracbut" value="cfrac2rat" type="button" onClick="cfr2rat()" />

        </form>
        <br><br>
    </div>
</body>

</html>