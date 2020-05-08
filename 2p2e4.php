<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <title>Two + Two = Four</title>
    <meta charset="utf-8">
</head>

<!-- additonal HTML not needed for the solution of the problem -->

<body>
    <?php include('nav.html'); ?>
    <div class="artmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheader.png"></a>
        <script>
            document.write("solve the letter substitution puzzle: TWO + TWO = FOUR")
            /* totally brute force, check each of the six letters: F O R T U W */
            /* ain't nobody done said F can't be zero?  */

            K = 0;
            S = ""
            for (F = 0; F <= 9; F++) {
                S += F
                for (O = 0; O <= 9; O++)
                    if (S.search(O) == -1) {
                        S += O
                        for (R = 0; R <= 9; R++)
                            if (S.search(R) == -1) {
                                S += R
                                for (T = 0; T <= 9; T++)
                                    if (S.search(T) == -1) {
                                        S += T
                                        for (U = 0; U <= 9; U++)
                                            if (S.search(U) == -1) {
                                                S += U
                                                for (W = 0; W <= 9; W++)
                                                    if (S.search(W) == -1) {
                                                        two = 100 * T + 10 * W + O
                                                        four = 1000 * F + 100 * O + 10 * U + R
                                                        if (two + two == four) {
                                                            K = K + 1;
                                                            document.write("<br>", K, ". ", T, W, O, " + ", T, W, O, " = ", F, O, U, R)
                                                        }
                                                    }
                                                S = S.slice(0, S.length - 1)
                                            }
                                        S = S.slice(0, S.length - 1)
                                    }
                                S = S.slice(0, S.length - 1)
                            }
                        S = S.slice(0, S.length - 1)
                    }
                S = S.slice(0, S.length - 1)
            }

            document.write("<p>The end.")

            /* more advanced solution, with a user deined function and some analysis:/*
            /* ------------------------------------------------------------------------ 
            F is 1
            T + T > 9 so T > 4

            function carry(x) {return(Math.floor(x/10)) }
            F=1
            for (T=5;T<=9;T++) {
            for (W=0;W<=9;W++) if (W!=F&&W!=T){
            for (O=0;O<=9;O++) if (O!=F&&O!=T&&O!=W){
            R1=O+O; R=R1%10
            if (R!=T && R!=W && R!=O && R!=F) {
            U1=carry(R1)+W+W; U=U1%10
            if (U!=T && U!=W && U!=O && U!=R && U!=F) {
            if (T+T+carry(U1)==10+O) {
            K=K+1; document.write("<br>",K,". ",T,W,O," + ",T,W,O," = ",F,O,U,R)
            }}}}}} 
            document.write("<p>The end.") 
            /*-------------------------------------------------------------------------*/
        </script>
    </div>
</body>

</html>