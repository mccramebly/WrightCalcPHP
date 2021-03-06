<!DOCTYPE html>
<html lang="en">

<head>
    <title>CCC Teacher's Union Dues</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="shortcut icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="calcmenu"> <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <div id="annualDuesCalc">
            <label for="college">Step One, select your college:</label>

            <select id="college">
                <option id="a0"> </option>
                <option id="a1">Daley College</option>
                <option id="a2">Harold Washington College</option>
                <option id="a3">Harper College</option>
                <option id="a4">Kennedy-King College</option>
                <option id="a5">Malcolm X College</option>
                <option id="a6">Moraine Valley Community College</option>
                <option id="a7">Morton College</option>
                <option id="a8">Oakton Community College</option>
                <option id="a9">Olive-Harvey College</option>
                <option id="a10">Prairie State College</option>
                <option id="a11">South Suburban College</option>
                <option id="a12">Triton College</option>
                <option id="a13">Truman College</option>
                <option id="a14">Wright College</option>
            </select>

            <label for="classification">Step Two, Select your classification</label>
            <select id="classification">
                <option id="b0"> </option>
                <option id="b1">Full Member - Regular Division</option>
                <option id="b2">Full Member - Classified Division</option>
                <option id="b3">Associate Member</option>
                <option id="b4">Retired Member</option>
                <option id="b5">Not negotiated by CCCTU</option>
            </select>


            <label for="salary">Step Three, Enter annual salary:</label>

            <input id="salary" type="text" value="" onblur="calcdues()" \>


            <span id='anndueh'>Annual Dues
            </span>
            <span id='anndued'>
            </span>
            <span id='ppdueh'>Per payperiod
            </span>
            <span id='ppdued'></span>

        </div>
        <!-- <input type="button" name="test" value ="test" onClick="test()"> -->

        <script TYPE="text/javascript">
            <!--
            annsal = '101'
            document.getElementById("college").focus()
            // ----------------------------------------
            function test() {
                document.getElementById("classification").selectedIndex = 2
                setannual()
            }
            // ----------------------------------------
            function calcdues() {
                annsal = document.getElementById("salary").value
                annual = Math.round(parseFloat(annsal) * 0.009)
                if (isNaN(annual)) return
                document.getElementById("anndued").innerHTML = annual.toFixed(2)
                document.getElementById("ppdued").innerHTML = (annual / 18).toFixed(2)
            }
            // 
            -->
        </script>

    </div>

</body>

</html>