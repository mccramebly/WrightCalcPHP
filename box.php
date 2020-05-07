<!DOCTYPE html>
<html lang="en">

<head>
    <title>Multisets</title>
    <meta charset="utf-8">
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
</head>

<body onLoad="self.focus();window.resizeTo( 950, 750 );">
    <?php include('nav.html'); ?>
    <div class="artmenu">
        <a href="index.htm"><img class="artmenuheader" src="assets/calcheader.png"></a>
        <p><a href="probability.htm" alt="wrightcalc.htm" title="wrightcalc.htm">Probability Link</a></p>

        <p>
            A multiset is a collection of unordered elements, where every element occurs a finite number of times.<br>
            Let's say you have four different types of boxes identified as type
            <span class="red">A</span>, <span class="green">B</span>, <span class="blue">C</span>, and <span class="purple">D</span><br>
            How many different multisets of 5 boxes can you have? <br>Here are four, shown three different ways:
        </p>
        <table>
            <tr>
                <th>Boxes</th>
                <th>box counts</th>
                <th>stars and stripes</th>
            </tr>
            <tr align=center>
                <td>
                    <span class="blue">C</span> <span class="blue">C</span> <span class="purple">D</span> <span class="purple">D</span> <span class="purple">D</span>
                </td>
                <td>2C3D</td>
                <td>||**|***</td>
            </tr>
            <tr align=center>
                <td>
                    <span class="red">A</span>
                    <span class="blue">C</span>
                    <span class="blue">C</span>
                    <span class="blue">C</span>
                    <span class="purple">D</span>
                </td>
                <td>1A3C1D</td>
                <td>*||***|*</td>
            </tr>
            <tr align=center>
                <td>
                    <span class="red">A</span>
                    <span class="green">B</span>
                    <span class="blue">C</span>
                    <span class="blue">C</span>
                    <span class="purple">D</span>
                </td>
                <td>1A1B2C1D</td>
                <td>*|*|**|*</td>
            </tr>
            <tr align=center>
                <td>
                    <span class="red">A</span>
                    <span class="red">A</span>
                    <span class="red">A</span>
                    <span class="red">A</span>
                    <span class="red">A</span>
                </td>
                <td>5A</td>
                <td>*****|||</td>
            </tr>
        </table>
        <p>Answer: <br>
            let's introduce a new notation: ((4,5)) to represent 5 choices of 4 different box types.<br>
            The stars and stripes presentation has us using five stars separated by three lines into four groups where the first set of stars are the A's separated with a line from the B's, then the C's and finally the D's.<br>
            Since we are selecting 5 of the 5+3 symbols to be stars, combinatorics tells us that there are nCr(8,5) = 56 possible multisets.
        </p>
        <p>Here is the Analysis performed by the program. <br>Note that the four examples from above are shown in bold.</p>
        <p>4 types of boxes, 5 selected, nCr(8,5) = 56 ways<br>
            5D; 1C4D; <b>2C3D</b>; 3C2D; 4C1D; 5C; 1B4D; 1B1C3D; 1B2C2D; 1B3C1D;<br>
            1B4C; 2B3D; 2B1C2D; 2B2C1D; 2B3C; 3B2D; 3B1C1D; 3B2C; 4B1D; 4B1C; <br>
            5B; 1A4D; 1A1C3D; 1A2C2D; <b>1A3C1D</b>; 1A4C; 1A1B3D; 1A1B1C2D; <b>1A1B2C1D</b>; <br>
            1A1B3C; 1A2B2D; 1A2B1C1D; 1A2B2C; 1A3B1D; 1A3B1C; 1A4B; 2A3D; 2A1C2D; 2A2C1D; <br>
            2A3C; 2A1B2D; 2A1B1C1D; 2A1B2C; 2A2B1D; 2A2B1C; 2A3B; 3A2D; 3A1C1D; 3A2C; <br>
            3A1B1D; 3A1B1C; 3A2B; 4A1D; 4A1C; 4A1B; <b>5A</b>;
        </p>

    </div>
</body>

</html>