<!DOCTYPE html>
<html lang="en">

<head>
    <title>Math</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <h1>Cheat sheet page 2</h1>
    <table>
        <tr>
            <th> . . . . Operators . . . . </th>
            <th> . . . . . . . .Properties . . . . . . . .</th>
            <th colspan=2> . . . . . . . . . . . . Methods . . . . . . . . . . . . </th>
        </tr>
        <tr>
            <td>Arithmetic<br>
                <hl> + </hl>&nbsp;<hl> = </hl>&nbsp;<hl>++</hl>&nbsp;<hl>+=</hl>&nbsp;<hl> - </hl>&nbsp;<hl>--</hl>&nbsp;<hl>-=</hl>&nbsp;<hl> / </hl>&nbsp;<hl>%</hl>
            </td>
            <td>
                <hl>Math.E</hl><br>
                Euler's constant and the base of natural logarithms (approximately 2.7183)
            </td>
            <td>
                <hl>Math.abs ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                the absolute value of <b>a</b>
            </td>
            <td>
                <hl>Math.floor ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                integer closest to and not greater than a
            </td>
        </tr>
        <tr>
            <td>Assignment<br>
                <hl> = </hl>&nbsp;<hl>+=</hl>&nbsp;<hl>-=</hl>&nbsp;<hl>*=</hl>&nbsp;<hl>/=</hl>&nbsp;<hl>%=</hl>&nbsp;<hl>
                    <<=< /hl> <br>
                        <hl>>>=</hl>&nbsp;<hl>>>>= &=</hl>&nbsp;<hl>^=</hl>&nbsp;<hl>|=</hl>
            </td>
            <td>
                <hl>Math.LN10</hl><br>
                the natural logarithm of 10, (approximately 2.3026).
            </td>
            <td>
                <hl>Math.acos ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                arc cosine of <b>a</b>
            </td>
            <td>
                <hl>Math.log ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                log of <b>a</b> base e
            </td>
        </tr>
        <tr>
            <td>String<br>
                <hl>+</hl>
            </td>
            <td>
                <hl>Math.LN2</hl><br>
                the natural logarithm of 2, (approximately 0.6931).
            </td>
            <td>
                <hl>Math.asin ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                arc sine of <b>a</b>
            </td>
            <td>
                <hl>Math.max ( </hl> <b>&nbsp;a</b> , <b>b</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                the maximum of <b>a</b> and b
            </td>
        </tr>
        <tr>
            <td>Backslash<br>
                <hl>\'</hl>&nbsp;<hl>\"</hl>&nbsp;<hl>\\</hl>&nbsp;<hl>\b</hl>&nbsp;<hl>\f</hl>&nbsp;<hl>\n</hl>&nbsp;<hl>\r</hl>&nbsp;<hl>\t</hl>
            </td>
            <td>
                <hl>Math.LOG10E</hl><br>
                the base 10 logarithm of E (approximately 0.4343)
            </td>
            <td>
                <hl>Math.atan ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                arc tangent of <b>a</b>
            </td>
            <td>
                <hl>Math.min ( </hl> <b>&nbsp;a</b> , <b>b</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                the minimum of <b>a</b> and <b>b</b>
            </td>
        </tr>
        <tr>
            <td>Bitwise<br>
                <hl> & </hl>&nbsp;<hl> | </hl>&nbsp;<hl>^ (XOR)</hl>&nbsp;<hl> ~ </hl>&nbsp;<hl>
                    <<< /hl>&nbsp;<hl>>></hl>&nbsp;<hl>>>></hl>
            </td>
            <td>
                <hl>Math.LOG2E</hl><br>
                the base 2 logarithm of E (approximately 1.4427).
            </td>
            <td>
                <hl>Math.atan2 ( </hl> <b>&nbsp;a</b> , <b>b</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                arc tangent of <b>a</b>/<b>b</b>
            </td>
            <td>
                <hl>Math.pow ( </hl> <b>&nbsp;a</b> , <b>b</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                <b>a</b> to the power <b>b</b>
            </td>
        </tr>
        <tr>
            <td>Comparison<br>
                <hl> == </hl>&nbsp;<hl> != </hl>&nbsp;<hl> === </hl>&nbsp;<hl> !== </hl>&nbsp;<hl> > </hl>&nbsp;<hl> >= </hl>&nbsp;<hl>
                    < </hl>&nbsp;<hl>
                            <= </hl>&nbsp;
            </td>
            <td>
                <hl>Math.PI</hl><br>
                the ratio of the circumference of <b>a</b> circle to its diameter (approximately 3.1416)
            </td>
            <td>
                <hl>Math.ceil ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                integer closest to <b>a</b> and not less than <b>a</b>
            </td>
            <td>
                <hl>Math.random( )</hl><br>
                pseudo random number in the range 0 to 1
            </td>
        </tr>
        <tr>
            <td>Logical<br>
                <hl> && </hl>&nbsp;<hl> || </hl>&nbsp;<hl> !&nbsp;</hl>
            </td>
            <td>
                <hl>Math.SQRT1_2</hl><br>
                the value of 1 divided by the square root of 2 (approximately 0.7071).
            </td>
            <td>
                <hl>Math.cos ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                cosine of <b>a</b>
            </td>
            <td>
                <hl>Math.round ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                integer closest to a
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <hl>Math.SQRT2</hl><br>
                the square root of 2 (approximately 1.4142)
            </td>
            <td>
                <hl>Math.exp ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                exp(<b>a</b>)= e^<b>a</b>
            </td>
            <td>
                <hl>Math.sin ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                sine of <b>a</b>
            </td>
        </tr>
        <tr>
            <td>Special<br>
                (a==b<hl> ? </hl> "is"<hl> : </hl> "ain't")</td>
            <td>for (var i=0<hl> , </hl> j=0; i<3; i++<hl> , </hl> j++)</td>
            <td>
                <hl>Math.tan ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                tangent of <b>a</b>
            </td>
            <td>
                <hl>Math.sqrt ( </hl> <b>&nbsp;a</b>
                <hl>&nbsp;)&nbsp;</hl><br>
                square root of <b>a</b>
            </td>
        </tr>
    </table>
</body>

</html>
<br>