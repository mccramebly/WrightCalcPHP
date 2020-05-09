<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sum of Digits of Numbers</title>
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <script src="myfunctions.js"></script>
    <script>
        function pr(x) {
            document.write("<br>" + x)
        }

        function doswers() {
            startnv = Number(document.theForm.startn.value)
            lastnv = Number(document.theForm.lastn.value)
            ndigitv = Number(document.theForm.ndigit.value)
            nsodv = Number(document.theForm.nsod.value)
            soda = [];
            tsodav = 0;
            indent = "&nbsp; &nbsp; &nbsp;"
            nvals = []
            // pr(startnv);pr(lastnv);pr(ndigitv);pr(nsodv)
            countdv = 0;
            countsdv = 0
            for (x = startnv; x <= lastnv; x++) {
                xx = x + '';
                xxx = xx.split('').sort()
                dup = false;
                for (xi = 1; xi < xxx.length; xi++)
                    if (xxx[xi] == xxx[xi - 1]) dup = true
                if (!dup || !document.theForm.nodup.checked) {
                    nvals.push(xx)
                    if (xx.search(ndigitv) > -1) countdv++
                    sdx = sod(x);
                    if (sdx == nsodv) countsdv++
                    if (isNaN(soda[sdx])) {
                        tsodav++;
                        soda[sdx] = 0;
                    }
                    soda[sdx]++
                }
            }
            pr(indent + "1. How many numbers are there, starting with " + startnv + " and going through " + lastnv + (document.theForm.nodup.checked ? ' with no duplicate digits' : '') + "? **** " + (nvals.length))
            pr(indent + "2. How many of these numbers contain the digit " + ndigitv + "? **** " + (countdv))
            pr(indent + "3. How many numbers have their digits add up to " + nsodv + "?  For example: 783 adds up to 18: 7 + 8 + 3 = 18? **** " + (countsdv))
            pr(indent + "4. What are they? **** ")
            prline = "";
            for (ix = 0; ix < nvals.length; ix++) {
                x = nvals[ix];
                sdx = sod(x);
                if (sdx == nsodv) prline += ', ' + x
            }
            if (prline.length > 0) document.write(prline.slice(2))
            pr(indent + "4. How many different Sums of Digits are there? **** " + tsodav)
            pr(indent + "5. How many different Numbers add up to each of them?")
            for (x = 0; x <= soda.length; x++)
                if (!isNaN(soda[x])) pr(x + ": " + soda[x])
        }
    </script>
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="artmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheader.png"></a>
        <form name="theForm">
            <ol>
                <li>How many numbers are there, starting with <input type="text" name="startn" size=1 value="100"> and going through <input type="text" name="lastn" size=1 value="999">
                    no duplicate digits <input type="checkbox" name="nodup" value="No Duplicates">
                </li>
                <li>How many of these numbers contain the digit <input type="text" name="ndigit" size=10 value="7"></li>
                <li>How many numbers have their digits add up to <input type="text" name="nsod" size=10 value="24"> For example: the digits in 783 add up to 18: 7 + 8 + 3 = 18</li>
                <li>How many different Sums of Digits are there?</li>
                <li>How many different Numbers add up to each of them?</li>
            </ol>
            <input type="button" name="nanswers" value="Answers" onClick="doswers()">
        </form>
    </div>
</body>

</html>