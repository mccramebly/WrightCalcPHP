<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
    <title>FÁRAÓK KINCSE</title>
    <script type="text/javascript">
        var code
        var rows4
        var rows5
        var rows6
        rowsx = "xx   xx,xx   xx,xx,xx   xx,xx,xx,xx   xx,xx,xx,xx,xx   xx,xx,xx,xx,xx,xx"

        function cla() {
            code = "";
            rows4 = "";
            rows5 = "";
            rows6 = ""
            document.theForm.coded.value = code
            document.theForm.rows4d.value = rows4;
            document.theForm.rows4x.value = ""
            document.theForm.rows5d.value = rows5;
            document.theForm.rows5x.value = ""
            document.theForm.rows6d.value = rows6;
            document.theForm.rows6x.value = ""
        }

        function test() {
            code = "78664618671283579582805376616903543101871511";
            rows4 = "69838801435718344970";
            rows5 = "731315032461344687904453545797";
            rows6 = "740436081885293153821134667880031267767995"
            document.theForm.coded.value = code
            document.theForm.rows4d.value = rows4;
            document.theForm.rows4x.value = ""
            document.theForm.rows5d.value = rows5;
            document.theForm.rows5x.value = ""
            document.theForm.rows6d.value = rows6;
            document.theForm.rows6x.value = ""
        }

        function load() {
            code = document.theForm.coded.value
            rows4 = document.theForm.rows4d.value
            rows5 = document.theForm.rows5d.value
            rows6 = document.theForm.rows6d.value
            document.theForm.coded.value = clean(code)
            document.theForm.rows4d.value = split(clean(rows4));
            document.theForm.rows4x.value = rowsx.slice(0, 36)
            document.theForm.rows5d.value = split(clean(rows5));
            document.theForm.rows5x.value = rowsx.slice(0, 54)
            document.theForm.rows6d.value = split(clean(rows6));
            document.theForm.rows6x.value = rowsx
        }

        function clean(dvar) {
            let x = dvar.replace(/\D/g, '')
            let y = ''
            for (let i = 0; i < x.length; i += 2) y += (y.length > 0 ? ',' : '') + x.slice(i, i + 2)
            return y
        }

        function put(x, y) {
            return x.slice(0, y) + "'" + x.slice(y + 1)
        }

        function split(dvar) {
            j = 2;
            for (i = 2; i < 9; i++) {
                if (j > dvar.length) return dvar.replace(/'/g, '   ')
                dvar = put(dvar, j)
                j = j + 3 * i
            }
        }

        function calc() {
            load()
            code = document.theForm.coded.value
            row4d = document.theForm.rows4d.value
            row5d = document.theForm.rows5d.value
            row6d = document.theForm.rows6d.value
            row4x = document.theForm.rows4x.value
            row5x = document.theForm.rows5x.value
            row6x = document.theForm.rows6x.value

            for (i = 0; i < code.length; i = i + 3) {
                xx = code.slice(i, i + 2)

                yy = 0;
                do {
                    y = row4d.slice(yy).search(xx);
                    if (y > -1) {
                        y = y + yy;
                        row4x = row4x.slice(0, y) + xx + row4x.slice(y + 2);
                        yy = y + 2
                    }
                } while (y > -1)
                document.theForm.rows4x.value = row4x
            }

            for (i = 0; i < code.length; i = i + 3) {
                xx = code.slice(i, i + 2)

                yy = 0;
                do {
                    y = row5d.slice(yy).search(xx);
                    if (y > -1) {
                        y = y + yy;
                        row5x = row5x.slice(0, y) + xx + row5x.slice(y + 2);
                        yy = y + 2
                    }
                } while (y > -1)
                document.theForm.rows5x.value = row5x
            }

            for (i = 0; i < code.length; i = i + 3) {
                xx = code.slice(i, i + 2)

                yy = 0;
                do {
                    y = row6d.slice(yy).search(xx);
                    if (y > -1) {
                        y = y + yy;
                        row6x = row6x.slice(0, y) + xx + row6x.slice(y + 2);
                        yy = y + 2
                    }
                } while (y > -1)
                document.theForm.rows6x.value = row6x
            }
        }
    </script>
</head>

<body onload="self.focus();">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.htm"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <p>
        </p>
        <form name="theForm">
            <h2>FÁRAÓK KINCSE </h2>
            <input type="button" name="claf" value="Clear input" onClick="cla()">
            <input type="button" name="sclearb" value="Find matches" onClick="calc()">
            <input type="button" name="testf" value="Test data" onClick="test()">

            <label>az ön számai</label><input style="font-family: monospace" type="text" name="coded" size=100 value="">
            <label>négy sor</label><input style="font-family: monospace" type="text" name="rows4d" size=100 value="">
            <label>találat</label><input style="font-family: monospace" type="text" name="rows4x" size=100 value="">

            <label>öt sor</label><input style="font-family: monospace" type="text" name="rows5d" size=100 value="">
            <label>találat</label><input style="font-family: monospace" type="text" name="rows5x" size=100 value="">

            <label>hat sor</label><input style="font-family: monospace" type="text" name="rows6d" size=100 value="">
            <label>találat</label><input style="font-family: monospace" type="text" name="rows6x" size=100 value="">


        </form>
    </div>
</body>

</html>