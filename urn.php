<!DOCTYPE html>
<html lang="en">

<head>
    <title>Polya's Urn</title>
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus();">
    <?php include('nav.html'); ?>
    <div class="artmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheader.png"></a>
        <h2>Example of Polya's Urn</h2>
        <a href="probability.php" class="returnLink">Return to Discrete Distribution</a>
        <p>The Urn contains B=6 blue balls and W=9 that are not Blue.<br>Q1. How many ways can you pick P=8 balls?<br>
            Q2. What is the expected number of blue balls per pick.<br>Expected number is the same as the average. <br><br>
            Solution:<br>On any pick you could have X=0,1,2,3,4,5, or 6 blue balls<br> and with them you would have 8,7,6,5,4,3, or 2 white balls.<br>
            The number of ways you can pick X blue balls is<br>N(X) = nCr(B,X) * nCr(W,P-X)<br>
            So for example N(2) = 15 * 84 = 1260<br>when you add all these up you get a total of 9+216+1260+2520+1890+504+36 = 6435 ways<br>If you add up the number of blue balls for each way, you get 20592<br>and the average number of blue balls per pick = 20592/6435 = 3.2

            <br>Analysis:<br>

            <table>
                <tr>
                    <th>X</th>
                    <th>not X</th>
                    <th>N(X)</th>
                    <th>X*N(X)</th>
                    <th>P(X)</th>
                    <th>X*P(X)</th>
                    <th>ΣN(X)</th>
                    <th>ΣP(X)</th>
                    <th>1-ΣP(X)</th>

                </tr>

                <tr>
                    <td>-----</td>
                    <td>-----</td>
                    <td>-----</td>
                    <td>-----</td>
                    <td>----------</td>
                    <td>----------</td>
                    <td>-----</td>
                    <td>----------</td>
                    <td>----------</td>

                </tr>
                <tr>
                    <td>0</td>
                    <td>8</td>
                    <td>9</td>
                    <td>0</td>
                    <td>0.0013986</td>
                    <td>0</td>
                    <td>9</td>
                    <td>0.0013986</td>
                    <td>0.9986014</td>

                </tr>
                <tr>
                    <td>1</td>
                    <td>7</td>
                    <td>216</td>
                    <td>216</td>
                    <td>0.03356643</td>
                    <td>0.03356643</td>
                    <td>225</td>
                    <td>0.03496503</td>
                    <td>0.96503497</td>

                </tr>
                <tr>
                    <td>2</td>
                    <td>6</td>
                    <td>1260</td>
                    <td>2520</td>
                    <td>0.1958042</td>
                    <td>0.39160839</td>
                    <td>1485</td>
                    <td>0.23076923</td>
                    <td>0.76923077</td>

                </tr>
                <tr>
                    <td>3</td>
                    <td>5</td>
                    <td>2520</td>
                    <td>7560</td>
                    <td>0.39160839</td>
                    <td>1.17482517</td>
                    <td>4005</td>
                    <td>0.62237762</td>
                    <td>0.37762238</td>

                </tr>
                <tr>
                    <td>4</td>
                    <td>4</td>
                    <td>1890</td>
                    <td>7560</td>
                    <td>0.29370629</td>
                    <td>1.17482517</td>
                    <td>5895</td>
                    <td>0.91608392</td>
                    <td>0.08391608</td>

                </tr>
                <tr>
                    <td>5</td>
                    <td>3</td>
                    <td>504</td>
                    <td>2520</td>
                    <td>0.07832168</td>
                    <td>0.39160839</td>
                    <td>6399</td>
                    <td>0.99440559</td>
                    <td>0.00559441</td>

                </tr>
                <tr>
                    <td>6</td>
                    <td>2</td>
                    <td>36</td>
                    <td>216</td>
                    <td>0.00559441</td>
                    <td>0.03356643</td>
                    <td>6435</td>
                    <td>1</td>
                    <td>0</td>

                </tr>
                <tr>
                    <td>-----</td>
                    <td>-----</td>
                    <td>-----</td>
                    <td>-----</td>
                    <td>----------</td>
                    <td>----------</td>
                    <td>-----</td>
                    <td>----------</td>
                    <td>----------</td>

                </tr>
                <!--Check to see if this lines up properly with Prof Nadas-->
                <tr>
                    <td>Totals: </td>
                    <td></td>
                    <td>6435</td>
                    <td>20592</td>
                    <td>1</td>
                    <td>3.2</td>
                    <td>=</td>
                    <td>20592 /</td>
                    <td>6435</td>

                </tr>

            </table>
    </div>
</body>

</html>