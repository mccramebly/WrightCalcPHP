<!DOCTYPE html>
<html lang="en">

<head>
    <title>2 Dice</title>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <script src="myfunctions.js"></script>
    <div class="widecalcmenu">
        <a href="index.htm"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <table style="float:left; margin:0 10px 10px;">
            <tr>
                <td colspan=2 align=center>Blue Die</td>
            </tr>
            <tr>
                <td align=right>Red Die</td>
                <td align=right>
                    <table class="dieTable">
                        <tr>
                            <th></th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                        </tr>
                        <tr>
                            <th class="pink">1</th>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <th class="pink">2</th>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                        </tr>
                        <tr>
                            <td class="pink">3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <td class="pink">4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td class="pink">5</td>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <td class="pink">6</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>10</td>
                            <td>11</td>
                            <td>12</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <img src="assets/dice.jpg" alt="Two Wooden Dice" title="Photo by lonso97 on Unsplash" width="210" height="339">
        <a href="probability.php" class="returnLink">Return to Discrete Distribution</a>


        <table>
            <caption>Analysis:</caption>
            <thead>
                <tr>
                    <th>X</th>
                    <th>N(X)</th>
                    <th>X*N(X)</th>
                    <th>P(X)</th>
                    <th>X*P(X)</th>
                    <th>Σ(N)</th>
                    <th>Σ(P)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2</td>
                    <td>1</td>
                    <td>2</td>
                    <td>0.02777778</td>
                    <td>0.05555556</td>
                    <td>1</td>
                    <td>0.02777778</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>2</td>
                    <td>6</td>
                    <td>0.05555556</td>
                    <td>0.16666667</td>
                    <td>3</td>
                    <td>0.08333333</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>3</td>
                    <td>12</td>
                    <td>0.08333333</td>
                    <td>0.33333333</td>
                    <td>6</td>
                    <td>0.16666667</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>4</td>
                    <td>20</td>
                    <td>0.11111111</td>
                    <td>0.55555556</td>
                    <td>10</td>
                    <td>0.27777778</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>5</td>
                    <td>30</td>
                    <td>0.13888889</td>
                    <td>0.83333333</td>
                    <td>15</td>
                    <td>0.41666667</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>6</td>
                    <td>42</td>
                    <td>0.16666667</td>
                    <td>1.16666667</td>
                    <td>21</td>
                    <td>0.58333333</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>5</td>
                    <td>40</td>
                    <td>0.13888889</td>
                    <td>1.11111111</td>
                    <td>26</td>
                    <td>0.72222222</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>4</td>
                    <td>36</td>
                    <td>0.11111111</td>
                    <td>1.00000000</td>
                    <td>30</td>
                    <td>0.83333333</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>3</td>
                    <td>30</td>
                    <td>0.08333333</td>
                    <td>0.83333333</td>
                    <td>33</td>
                    <td>0.91666667</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>2</td>
                    <td>22</td>
                    <td>0.05555556</td>
                    <td>0.61111111</td>
                    <td>35</td>
                    <td>0.97222222</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>1</td>
                    <td>12</td>
                    <td>0.027777778</td>
                    <td>0.333333333</td>
                    <td>36</td>
                    <td>1.000000000</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">36</td>
                    <td>252</td>
                    <td>1</td>
                    <td colspan="3">7 = 252/36</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>