<!DOCTYPE html>
<html lang="en">

<head>
    <title>Group Generator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/simple-calc-style.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="groupGen">
    <?php include('nav.html'); ?>
    <script src="myfunctions.js"></script>
    <script>
        var day = [] // day, group, index into roster
        var cross = []
        var roster = []
        var n = 0
        // ------------------------------------------------------------------
        function checkSelection() {
            var selection = document.getElementById("checkSelect");
            if (selection.value == 1) {
                calc();
            } else if (selection.value == 2) {
                calc1();
            } else {
                calc();
            }

        }
        // ------------------------------------------------------------------
        function dday(d) {
            theForm.solu.value += "\nDay " + (d + 1) + ":"
            if (day[d].length == n) {
                theForm.solu.value += " Everyone has already been with everyone once.";
                return
            }
            for (var i = 0; i < day[d].length; i++) {
                theForm.solu.value += "\nGroup " + (i + 1) + ": "
                for (var j = 0; j < day[d][i].length; j++) {
                    theForm.solu.value += roster[day[d][i][j]] + ", "
                }
            }
        }
        // ------------------------------------------------------------------
        function calc1() {
            work = theForm.input.value.replace(/,/g, ";")
            if (slim(work.length) == 0) {
                theForm.input.value = " Abe Brown\n Bob Greene\n Cindy Yellow\n Dottie Blue\n Ernie Black\n Fonzie Winter\n Gerry Summer\n Helen Spring\n Ida Autumn"
            } else {
                theForm.input.value = work
                calc()
            }
        }
        // ------------------------------------------------------------------
        function calc() {
            work = theForm.input.value
            if (slim(work.length) == 0) {
                theForm.input.value = "Brown, Abe\nGreene, Bob\nYellow, Cindy\nBlue, Dottie\nBlack, Ernie\nWinter, Fonzie\nSummer, Gerry\nSpring, Helen\nAutumn, Ida"
                return
            }
            // work = work.replace (/(\d{9}\s*)?(.+),(.+?)\s+(Enroll|Dropp)ed\s*\w*\s*\d\d\/\d\d\/201\d.*/g, "$3 $2;")
            work = work.replace(/\d{9}\s*/g, "")
            work = work.replace(/(Enroll|Dropp)ed\s*\w*\s*\d\d\/\d\d\/201\d.*/g, "")
            work = work.replace(/(.+),(.+)\s*/g, "$2 $1;")
            work = work.replace(/\n/g, ";")
            work = work.replace(/\s+/g, " ")
            work = work.replace(/\s*\;\s*/g, ";")
            work = work.replace(/^[;\s]*/, "")
            work = work.replace(/[;\s]*$/, "")
            work = work.replace(/([\w\s\.]*),([\w\s\.]*)/g, "$2 $1; ")
            work = work.split(";").sort().join("; ")
            work = work.replace(/\s*\;\s*/g, ";")
            work = work.replace(/\;*$/, "")
            work = work.replace(/^\;*/, "")
            theForm.input.value = work
            roster = work.split(";")
            // initialize stuff
            n = roster.length // size of class
            s = theForm.sval.value // length of semester, number of class days
            p = theForm.gval.value // the size of each group
            m = Math.ceil(n / p) // number of groups per day
            for (i = 0; i < n; i++) cross[i] = [];
            theForm.solu.value = "There are " + n + " students"

            // do day one (d=0)
            d = 0;
            day[d] = [];
            for (i = 0; i < m; i++) day[d][i] = []
            g = 0;
            for (r = 0; r < n; r++) {
                for (i = 0; i < day[d][g].length; i++) {
                    cross[r][day[d][g][i]] = d
                }
                day[d][g].push(r);
                g = (g + 1) % m
            }
            // do day two (d=1)
            d = 1;
            day[d] = [];
            for (i = 0; i < m; i++) day[d][i] = []
            g = 0;
            for (r = 0; r < n; r++) {
                for (i = 0; i < day[d][g].length; i++) {
                    cross[r][day[d][g][i]] = d
                }
                day[d][g].push(r);
                if (day[d][g].length >= day[0][g].length) g += 1
            }
            // do the rest
            while (d < s - 1) {
                g2 = 0
                d += 1;
                day[d] = [];
                for (i = 0; i < m; i++) day[d][i] = []
                for (r = 0; r < n; r++) {
                    foundgroup = false
                    for (g1 = 0; g1 < m; g1++) {
                        g = (g2 + g1) % m
                        foundmatch = false
                        for (i = 0; i < day[d][g].length; i++) {
                            if (cross[r][day[d][g][i]] != undefined) {
                                foundmatch = true;
                                break
                            }
                        }
                        if (foundmatch) continue;
                        else {
                            foundgroup = true;
                            break
                        }
                    }
                    if (foundgroup) {
                        for (i = 0; i < day[d][g].length; i++) {
                            cross[r][day[d][g][i]] = d
                        }
                        day[d][g].push(r);
                        g2 = g + 1
                    } else {
                        day[d][m] = [];
                        day[d][m].push(r);
                        g2 = 0;
                        m += 1
                    }
                }
            }

            for (si = 0; si < s; si++) {
                dday(si)
            }
        }
    </script>
    <div id="calctainer">
        <a href="index.php"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <!--  Jessica Choe 	jchoe@ccc.edu  -->
        <h1>Group Generator</h1>
        <form name="theForm">
            <p id="desc">Create small groups from your class list.</p>
            <div id="inputDiv">
                <label for="input">Enter or copy/paste class roster:</label>
                <textarea id="input" name="input" rows="10"></textarea>
            </div>

            <label for="gval">How many students are in each group:</label>
            <input id="gval" type="text" name="gval" size=1 value="3">
            <label for="sval">How many sessions are there:</label>
            <input id="sval" type="text" name="sval" size=1 value="4">
            <label for="outputType">How would you like the names formatted:</label>
            <select name="outputType" id="outputType">
                <option disabled selected>Select One</option>
                <option value=1>Family Name, Given Name (Ex. Smith, John)</option>
                <option value=2>Given Name, Family Name (Ex. John Smith)</option>
            </select>
            <input type="button" id="checkSelect" name="checkSelect" value="Submit" onClick="checkSelection()">
            <!--
Family Name, Given Name <input name="calcbut" Value="Family Name, Given Name" type="button" onClick="calc()">
 First Name Last Name (no commas)<input name="calc1but" Value="First Name Last Name" type="button" onClick="calc1()">-->
            <textarea id="solu" name="solu" rows="10"></textarea>
        </form>
    </div>
</body>

</html>