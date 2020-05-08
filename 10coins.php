<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>10 Coins</title>
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <script src="myfunctions.js"></script>
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="widecalcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <h1>10 Coins</h1>
        <div>
            <p>Examples of binomial distributions</p>
            <ul>
                <li>coins: 6 heads &amp; 4 tails:
                    <ul>
                        <li>210 ways</li>
                    </ul>
                </li>
                <li>Gender: 6 girls &amp; 4 boys:
                    <ul>
                        <li>also 210 ways</li>
                    </ul>
                </li>
            </ul>
            <img src="10coins.jpg" alt="ten Coins" title="ten Coins" width="350" height="250" />
            <a href="probability.php" class="returnLink">Return to Discrete Distribution</a>
        </div>
        <table id="triangle">
            <tr>
                <th>Row</th>
                <th colspan=25><b>Pascal's triangle nCr(row,column)</b><br>
                </th>
            </tr>
            <tr>
                <th>0</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>1</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>2</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td>2</td>
                <td></td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>3</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td>3</td>
                <td></td>
                <td>3</td>
                <td></td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>4</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td>4</td>
                <td></td>
                <td>6</td>
                <td></td>
                <td>4</td>
                <td></td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>5</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td>5</td>
                <td></td>
                <td>10</td>
                <td></td>
                <td>10</td>
                <td></td>
                <td>5</td>
                <td></td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>6</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td>6</td>
                <td></td>
                <td>15</td>
                <td></td>
                <td>20</td>
                <td></td>
                <td>15</td>
                <td></td>
                <td>6</td>
                <td></td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>7</th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td>7</td>
                <td></td>
                <td>21</td>
                <td></td>
                <td>35</td>
                <td></td>
                <td>35</td>
                <td></td>
                <td>21</td>
                <td></td>
                <td>7</td>
                <td></td>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>8</th>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td>8</td>
                <td></td>
                <td>28</td>
                <td></td>
                <td>56</td>
                <td></td>
                <td>70</td>
                <td></td>
                <td>56</td>
                <td></td>
                <td>28</td>
                <td></td>
                <td>8</td>
                <td></td>
                <td>1</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>9</th>
                <td></td>
                <td></td>
                <td>1</td>
                <td></td>
                <td>9</td>
                <td></td>
                <td>36</td>
                <td></td>
                <td>84</td>
                <td></td>
                <td>126</td>
                <td></td>
                <td>126</td>
                <td></td>
                <td>84</td>
                <td></td>
                <td>36</td>
                <td></td>
                <td>9</td>
                <td></td>
                <td>1</td>
                <td></td>
            </tr>
            <tr>
                <th>10</th>
                <td></td>
                <td>1</td>
                <td></td>
                <td>10</td>
                <td></td>
                <td>45</td>
                <td></td>
                <td>120</td>
                <td></td>
                <td>210</td>
                <td></td>
                <td>252</td>
                <td></td>
                <td>210</td>
                <td></td>
                <td>120</td>
                <td></td>
                <td>45</td>
                <td></td>
                <td>10</td>
                <td></td>
                <td>1</td>
            </tr>
            <tr>
                <th colspan=2>Col:</th>
                <th>0</th>
                <th></th>
                <th>1</th>
                <th></th>
                <th>2</th>
                <th></th>
                <th>3</th>
                <th></th>
                <th>4</th>
                <th></th>
                <th>5</th>
                <th></th>
                <th>6</th>
                <th></th>
                <th>7</th>
                <th></th>
                <th>8</th>
                <th></th>
                <th>9</th>
                <th></th>
                <th>10</th>
            </tr>
        </table>


        <table class="clear">
            <caption>Analysis:</caption>
            <thead>
                <tr>
                    <th># of Heads</th>
                    <th># of Ways</th>
                    <th>X*N(X)</th>
                    <th>P(x)</th>
                    <th>ΣP(x)</th>
                    <th>1-ΣP(x)</th>
                    <th>x*P(x)</th>
                    <th>Normal</th>
                    <th>C.D.F.</th>
                    <th>1-CDF</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>0</td>
                    <td>1</td>
                    <td>0</td>
                    <td>0.0009765</td>
                    <td>0.0009765</td>
                    <td>0.9990234</td>
                    <td>0.0000000</td>
                    <td>0.0019609</td>
                    <td>0.0019609</td>
                    <td>0.9980390</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>10</td>
                    <td>10</td>
                    <td>0.0097656</td>
                    <td>0.0107421</td>
                    <td>0.9892578</td>
                    <td>0.0097656</td>
                    <td>0.0112152</td>
                    <td>0.0131762</td>
                    <td>0.9868237</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>45</td>
                    <td>90</td>
                    <td>0.0439453</td>
                    <td>0.0546875</td>
                    <td>0.9453125</td>
                    <td>0.0878906</td>
                    <td>0.0434946</td>
                    <td>0.0566708</td>
                    <td>0.9433291</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>120</td>
                    <td>360</td>
                    <td>0.1171875</td>
                    <td>0.1718750</td>
                    <td>0.8281250</td>
                    <td>0.3515625</td>
                    <td>0.1144678</td>
                    <td>0.1711387</td>
                    <td>0.8288612</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>210</td>
                    <td>840</td>
                    <td>0.2050781</td>
                    <td>0.3769531</td>
                    <td>0.6230468</td>
                    <td>0.8203125</td>
                    <td>0.2045237</td>
                    <td>0.3756625</td>
                    <td>0.6243374</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>252</td>
                    <td>1260</td>
                    <td>0.2460937</td>
                    <td>0.6230468</td>
                    <td>0.3769531</td>
                    <td>1.2304687</td>
                    <td>0.2481705</td>
                    <td>0.6238330</td>
                    <td>0.3761669</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>210</td>
                    <td>1260</td>
                    <td>0.2050781</td>
                    <td>0.8281250</td>
                    <td>0.171875</td>
                    <td>1.2304687</td>
                    <td>0.2045237</td>
                    <td>0.8283568</td>
                    <td>0.1716431</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>120</td>
                    <td>840</td>
                    <td>0.1171875</td>
                    <td>0.9453125</td>
                    <td>0.0546875</td>
                    <td>0.8203125</td>
                    <td>0.1144678</td>
                    <td>0.9428247</td>
                    <td>0.0571752</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>45</td>
                    <td>360</td>
                    <td>0.0439453</td>
                    <td>0.9892578</td>
                    <td>0.0107421</td>
                    <td>0.3515625</td>
                    <td>0.0434946</td>
                    <td>0.9863193</td>
                    <td>0.0136806</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>10</td>
                    <td>90</td>
                    <td>0.0097656</td>
                    <td>0.9990234</td>
                    <td>0.0009765</td>
                    <td>0.0878906</td>
                    <td>0.0112152</td>
                    <td>0.9975346</td>
                    <td>0.0024653</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>1</td>
                    <td>10</td>
                    <td>0.0009765</td>
                    <td>1.0000000</td>
                    <td>0.0000000</td>
                    <td>0.0097656</td>
                    <td>0.0019609</td>
                    <td>0.9994956</td>
                    <td>0.0005044</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td>Σ</td>
                    <td>1024</td>
                    <td>5120</td>
                    <td colspan="3">1.0000000</td>
                    <td>5 = 5120/1024</td>
                </tr>
            </tfoot>
        </table>
        <p>
            Using the Normal Approximation:<br>
            n = 10; p = 0.5; q = 0.5; P(x = 0) = nCx p^x q^(n-x) = 0.0009766
            μ = (n p) = 5; σ² = ( n p q ) = 2.5; σ = √( n p q ) = 1.5811<br>
            x1 = -0.5; x2 = 10.5; μ = 5; σ = 1.5811388300841898<br>
            z = ( x1 - μ ) / σ = -3.4785<br>
            z = ( x2 - μ ) / σ = 3.4785<br>
            P (-0.05 &lt; p &lt; 1.05) = P (-0.5 &lt; x &lt; 10.5) = P (-3.4785 &lt; z &lt; 3.4785) = 0.99949559<br>
        </p>
    </div>
</body>

</html>