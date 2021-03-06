<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sample Space Generator</title>
    <script src="myfunctions.js"></script>
    <script>
        list = []
        mu = String.fromCharCode(956);
        option = '1' // 1=nPr, 2-nCr, 3=All
        // ---------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) calc1();
            if (charCode == 27) cla();
        };
        // ---------------------------------------------------
        function cla() {
            document.theForm.input.value = '';
            document.theForm.input.focus()
        };
        // ---------------------------------------------------
        function gener(v, w, rr) {
            // document.theForm.output.value += "\n"+v+" :: "+w
            if (v.length < 1 || rr < 1) {
                if (rr == 0) list.push(w);
                return
            }
            for (var i = 0; i < v.length; i++) {
                var v1 = [];
                for (j = 0; j < v.length; j++) {
                    if ((option == '1' && (j != i)) || (option == '2' && (j > i)) || (option == '3')) v1.push(v[j])
                }
                var w1 = [];
                for (j = 0; j < w.length; j++) {
                    w1.push(w[j])
                }
                w1.push(v[i])
                // if (v1.length>0) 
                gener(v1, w1, rr - 1)
            }
        }
        // ---------------------------------------------------
        function calc1() {
            with(Math) {
                Rval = document.theForm.Rval.value
                extra = document.theForm.extra.value.replace(/ /g, "")
                list = []
                aa = []
                data = document.theForm.input.value.replace(/ /g, "").replace(/\n/g, ",").replace(/,+/g, ",").replace(/^,/, "").replace(/,$/, "")
                dd = data.split(/[,\n]/).sort()
                if (isNaN(eval(Rval))) Rval = dd.length
                if (Rval < 1 || Rval > dd.length) Rval = dd.length
                document.theForm.Rval.value = Rval
                gener(dd, aa, Rval)
                if (option == '1') document.theForm.output.value = "nPr(" + dd.length + "," + Rval + ")= " + npr(dd.length, Rval)
                if (option == '2') document.theForm.output.value = "nCr(" + dd.length + "," + Rval + ")= " + ncr(dd.length, Rval)
                if (option == '3') document.theForm.output.value = dd.length + "^" + Rval + "= " + Math.pow(dd.length, Rval) + "; " + dd.length + "! = " + fact(dd.length)
                // ------------------------ remove repeats
                if (extra == '1') {
                    document.theForm.output.value += "; remove repeats"
                    for (j = 0; j < list.length; j++) {
                        for (k = 1; k < list[j].length; k++) {
                            if (list[j][k - 1] == list[j][k]) {
                                list.splice(j, 1);
                                j = j - 1;
                                break
                            }
                        }
                    }
                }
                // ------------------------ remove adjacents
                if (extra == '2') {
                    document.theForm.output.value += "; remove start with zero or contains 2"
                    for (j = 0; j < list.length; j++) {
                        if (list[j][0] == '0') {
                            list.splice(j, 1);
                            j = j - 1;
                            continue
                        }
                        for (k = 0; k < list[j].length; k++) {
                            if (list[j][k] == '2') {
                                list.splice(j, 1);
                                j = j - 1;
                                break
                            }
                        }
                    }
                }

                // ------------------------ print list
                document.theForm.output.value += "; list length = " + list.length + "\n"
                if (document.theForm.commas.checked)
                    for (j = 0; j < list.length; j++) document.theForm.output.value += list[j] + "; "
                else
                    for (j = 0; j < list.length; j++) document.theForm.output.value += list[j].join().replace(/,/g, "") + "; "
                // ------------------------ count number of items in their original position
                if (extra == '3') {
                    cnt = 0
                    for (j = 0; j < list.length; j++) {
                        cnt1 = 0
                        for (k = 0; k < dd.length; k++)
                            if (dd[k] == list[j][k]) cnt1++
                        // document.theForm.output.value += "\n"+list[j]+":  "+cnt1 
                        cnt += cnt1
                    }
                    document.theForm.output.value += "\nitems in original position: " + mu + " = " + cnt + "/" + list.length + " = " + cnt / list.length
                }
                // -------------------------- end
                document.theForm.input.focus();
            }
        };
    </script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus();document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">
            <h2>Input</h2>
            <br>
            <textarea name="input" rows=2 cols=68 tabindex="1" onKeyDown="enter(event)">1,2,3,4,5
</textarea>

            <input type="radio" name="rad1" onClick="option='1'" value="nPr" />nPr
            <input type="radio" name="rad1" onClick="option='2'" value="nCr" />nCr
            <input type="radio" name="rad1" onClick="option='3'" checked value="All" />All<br>

            <label>r</label><input type="text" name="Rval" size=2 value="4" /><br>
            <label>Extra</label><input type="text" name="extra" size=2 value="2" /><br>
            <input name="calc" type="button" value="Calc" onClick="calc1()" tabindex="3" />
            <input name="clear" type="button" value="Clear Input" onClick="cla()" tabindex="2" /> <br>
            <br>
            <h2>Output</h2>
            <input name="commas" type="checkbox" />Output with commas<br>
            <textarea name="output" rows=25 cols=68 tabindex=0></textarea>

        </form>
    </div>
</body>

</html>