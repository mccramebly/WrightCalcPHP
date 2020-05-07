<!DOCTYPE html>
<html lang="en">

<head>
    <title>CCC Teacher's Union Dues</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="shortcut icon" href="favicon.ico">
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="calcmenu"> <a href="index.htm"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <table BORDER="1" CELLPADDING="10" CELLSPACING="5" WIDTH="50%" noshade bgcolor=99CC66>
            <tr align="center" valign="top">
                <th align="right" valign="top" nowrap colspan="1" rowspan="1">
                    Step One, select your college:</th>
                <td align="left" valign="top" nowrap colspan="1" rowspan="1" tabindex='1'>
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
                    </select></td>
            </tr>
            <tr align="center" valign="top">
                <th align="right" valign="top" nowrap colspan="1" rowspan="1">
                    Step Two, Select your classification</th>
                <td align="left" valign="top" nowrap colspan="1" rowspan="1" tabindex='2'>
                    <select id="classification">
                        <option id="b0"> </option>
                        <option id="b1">Full Member - Regular Division</option>
                        <option id="b2">Full Member - Classified Division</option>
                        <option id="b3">Associate Member</option>
                        <option id="b4">Retired Member</option>
                        <option id="b5">Not negotiated by CCCTU</option>
                    </select></td>
            </tr>
            <tr align="center" valign="top">
                <th id='annualh' align="right" valign="top" nowrap colspan="1" rowspan="1">Step Three, Enter annual salary
                </th>
                <td id='annuald' align="left" valign="top" nowrap colspan="1" rowspan="1" tabindex="3"><input id="salary" type="text" value="" onblur="calcdues()" \>
                </td>
            </tr>
            <tr align="center" valign="top">
                <th id='anndueh' align="right" valign="top" nowrap colspan="1" rowspan="1">Annual Dues
                </th>
                <td id='anndued' align="left" valign="top" nowrap colspan="1" rowspan="1" tabindex="4">
                </td>
            </tr>
            <tr align="center" valign="top">
                <th id='ppdueh' align="right" valign="top" nowrap colspan="1" rowspan="1">Per payperiod
                </th>
                <td id='ppdued' align="left" valign="top" nowrap colspan="1" rowspan="1" tabindex="5">
                </td>
            </tr>
        </table>
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