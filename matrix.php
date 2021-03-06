<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Matrix Operations</title>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <script type="text/javascript" src="myfunctions.js"></script>
    <script type="text/javascript" src="matrix.js"></script>
    <script type="text/javascript">
        var saveA = []
        var saveB = []
        var saveC = []
        var saveD = []
        var saveE = []
        var saveF = []
        var saveG = []
        var saveH = []
        var saveI = []
        var sampcode = [];
        dosam = false;
        frac = 0
        sampcode[0] = "swfrac(2); A=[[0.1,0.2],[0.5,0.0]];D=[[16],[8]];B=Minv(Msub(1,A));C=Mmul(B,D);I=[['x=0.1x+0.2y+16'],['y=0.5x+0.0y+8']];G=Mmul(A,C);H=Msub(C,G);E='D=X-AX, X=(1-A)⁻¹D'"
        sampcode[1] = "swfrac(2); A=[[5,2,3],[5,2,4],[5,1,1]]; B=Mmul(A,Mtran(A)); C=Mmul(25,Minv(B)); D=Mmul(Mmul(.04,B),C); E=Madd(A,B); F=Mdet(B); I='original determinant: '+Mdet(A); H=typeof(F); "
        sampcode[2] = "swfrac(2); N=5; A=[[-3,-946],[-2,-103],[-1,8],[0,11],[1,26],[2,269]]; B=Mclone(A); D=Msplit(B); B=mpow(B,N); C=Mmul(Minv(Mmul(Mtran(B),B)),Mmul(Mtran(B),D)); D=Mmul(B,C); I=mpoly(C) // A = data points, B=powers of x value, C=coefficents for N order regression, D=predicted answers"
        sampcode[3] = "swfrac(2); A=[[6,12,-3,-23], [1,1,0,-1], [0,1,-1,-4]]; B=Mclone(A); C=Msplit(B); D=Minv(B); G=Mmul(D,C); E=Mdet(B); F=Mdet(D);H=E*F // linear simultaneous equations 6x+12y-3z=-23, x+y=-1, y-z=-4"
        sampcode[4] = "swfrac(3); A=[[6,12,-3,-23], [1,1,0,-1], [0,1,-1,-4]]; B=Mclone(A); C=Msplit(B); E=Mcramer(B,C,0); F=Mcramer(B,C,1); G=Mcramer(B,C,2); b=Mdet(B); e=Mdet(E); f=Mdet(F); g=Mdet(G); I= 'determinants: '+my(b)+', '+my(e)+', '+my(f)+', '+my(g)+'; solutions: '+my(e/b)+', '+my(f/b)+', '+my(g/b) // Cramer's rule"
        sampcode[5] = "swfrac(3); A=[[6,12,-3,-23], [1,1,0,-1], [0,1,-1,-4]]; B=Mrref(A) // reduced row-echelon form for 6x+12y-3z=-23, x+y=-1, y-z=-4 "
        sampcode[6] = "swfrac(2); A=[[1,2],[3,2]]; B=Minv(A); C=Madd(A,B); D=Msub(C,A); E=Mdet(A); F=Mdet(B); G=Mmul(A,D); H=E*F; I=Msplit(A)"
        sampcoden = 6;
        sampcodei = sampcoden - 1
        // - - - - - - - - - - - - - - - - - - - -
        function mpow(X, C) {
            if (C == undefined) CC = 2;
            else CC = C
            var B = []
            for (var i = 0; i < X.length; i++) {
                B[i] = []
                for (var j = 0; j < X[i].length; j++) {
                    F = [X[i][j]];
                    for (k = 1; k < CC; k++) F[k] = F[0] * F[k - 1]
                    B[i] = B[i].concat(F.reverse())
                }
                B[i] = B[i].concat([1])
            }
            return B
        }
        // - - - - - - - - - - - - - - - - - - - -
        function mpoly(X) {
            p = '';
            q = '';
            i = X.length
            while (i > 0) {
                i--
                p += X[i] + "+X*("
                q += ')'
            }
            return p.slice(0, -4) + q.slice(0, -1)
        }
        // - - - - - - - - - - - - - - - - - - - -
        function Msplit(X) {
            var B = [
                []
            ]
            // if (X[0].length<=X.length) return B
            for (var i = 0; i < X.length; i++) {
                B[i] = [];
                B[i][0] = X[i].pop()
            }
            return B
        }
        // - - - - - - - - - - - - - - - - - - - -
        function mrestore() {
            if (saveA.length < 1) return
            document.theForm.inputA.value = saveA.pop()
            document.theForm.inputB.value = saveB.pop()
            document.theForm.inputC.value = saveC.pop()
            document.theForm.inputD.value = saveD.pop()
            document.theForm.inputE.value = saveE.pop()
            document.theForm.inputF.value = saveF.pop()
            document.theForm.inputG.value = saveG.pop()
            document.theForm.inputH.value = saveH.pop()
            document.theForm.inputI.value = saveI.pop()
        }
        // - - - - - - - - - - - - - - - - - - - -
        function Mcramer(X, Y, N) {
            var Z = []
            for (var i = 0; i < X.length; i++) {
                Z[i] = []
                for (var j = 0; j < N; j++) Z[i].push(X[i][j])
                Z[i].push(Y[i][0])
                for (var j = N + 1; j < X[i].length; j++) Z[i].push(X[i][j])
            }
            return Z
        }
        // - - - - - - - - - - - - - - - - - - - -
        function Mrref(XX) // reduced row-echelon form
        {
            X = Mclone(XX)
            zerod = false;
            determ = 1;
            determ1 = 1;
            xxn = X.length
            for (i1 = 0; i1 < xxn; i1++) {
                ii1 = i1;
                if (X[i1][i1] == 0) {
                    for (i2 = i1 + 1; i2 < xxn; i2++) {
                        if (X[i2][i1] != 0) {
                            for (i3 = 0; i3 <= 2 * xxn; i3++) {
                                X[i1][i3] += X[i2][i3]
                                // temp=X[i1][i3]; X[i1][i3]=X[i2][i3]; X[i2][i3]=temp
                            }
                            break;
                        }
                    };
                    for (ii1 = i1; ii1 < xxn; ii1++) {
                        if (X[i1][ii1] != 0) break;
                    }
                    if (ii1 == xxn) {
                        if (X[i1][xxn] != 0) {
                            document.theForm.inputI.value += "inconsistent system - no solutions.";
                        } else {
                            document.theForm.inputI.value += "dependent system - infinitely many solutions.\n";
                            for (i01 = 0; i01 < i1; i01++) {
                                for (i02 = 0; i02 < xxn; i02++) {
                                    if (X[i01][i02] != 0) {
                                        document.theForm.inputI.value += xx[i02] + "=";
                                        i02x = -X[i01][i02];
                                        i03y = 0;
                                        for (i03 = i02 + 1; i03 <= xxn; i03++) {
                                            i03x = X[i01][i03] / i02x;
                                            if ((i03x != 0) || ((i03y == 0) && (i03 == xxn))) {
                                                i03y = 1;
                                                document.theForm.inputI.value += ((i03x >= 0) ? "+" : "-") + (((Math.abs(i03x) != 1) || i03 == xxn) ? (my(Math.abs(i03x))) + "" : "") + xx[i03];
                                            }
                                        }
                                        document.theForm.inputI.value += "; ";
                                        break;
                                    }
                                }
                            }
                            // document.theForm.inputI.value += "\n";
                        };
                        zerod = true;
                    }
                }
                if (!zerod) {
                    printsubs = false
                    if (printsubs) {
                        document.theForm.inputI.value += "substitute/eliminate " + xx[i1] + " = "
                    }
                    for (i2 = 0; i2 < xxn; i2++) {
                        if (i1 != i2) {
                            if (X[i1][i2] != 0) {
                                r1 = -X[i1][i2] / X[i1][ii1];
                                if (printsubs) document.theForm.inputI.value += coeff(false, r1, xx[i2], true)
                                // (r>0?"+":"-")+(my(Math.abs(r1),true))+xx[i2]
                            };
                            r1 = X[i2][ii1];
                            r2 = X[i1][ii1]
                            if (r1 != 0) {
                                determ1 = determ1 * r2;
                                for (i3 = 0; i3 <= xxn; i3++) X[i2][i3] = (X[i2][i3] * r2 - X[i1][i3] * r1)
                            }
                        }
                    }
                    r1 = -X[i1][xxn] / X[i1][ii1];
                    if (printsubs) document.theForm.inputI.value += (r1 > 0 ? "+" : "-") + (my(Math.abs(r1)))
                }
            };
            for (i1 = 0; i1 < xxn; i1++) {
                xi = X[i1][i1]
                for (i2 = 0; i2 <= xxn; i2++) {
                    X[i1][i2] /= xi
                }
            }
            return X
        }
        // - - - - - - - - - - - - - - - - - - - -
        function Maugment(X, Y) {
            var B = []
            for (var i = 0; i < X.length; i++) {
                B[i] = [];
                var k = 0
                for (var j = 0; j < X[i].length; j++) B[i][k++] = X[i][j]
                for (var j = 0; j < Y[i].length; j++) B[i][k++] = Y[i][j]
            }
            return B
        }
        // - - - - - - - - - - - - - - - - - - - -
        function putx(x) {
            //IE support
            if (document.selection) {
                document.theForm.inputline.focus();
                sel = document.selection.createRange();
                sel.text = x
            } else if (document.theForm.inputline.selectionStart || document.theForm.inputline.selectionStart == '0') { //MOZILLA/NETSCAPE support
                var startPos = document.theForm.inputline.selectionStart;
                var endPos = document.theForm.inputline.selectionEnd;
                var cursorPos = startPos + x.length
                var prex = document.theForm.inputline.value.substring(0, startPos).replace(/ *$/, "")
                var postx = document.theForm.inputline.value.substring(endPos, document.theForm.inputline.value.length)
                if (postx.length == 0 && x.length == 1) {
                    if (prex[prex.length - 1] == "," || prex.slice(prex.length - 5) == "Minv(" || prex.slice(prex.length - 5) == "mpow(" || prex.slice(prex.length - 6) == "Mtran(" || prex.slice(prex.length - 5) == "Mdet(" || prex.slice(prex.length - 7) == "Msplit(" || prex.slice(prex.length - 7) == "Mclone(" || prex.slice(prex.length - 6) == "Mrref(") x += "); "
                    else if (prex.slice(prex.length - 5) == "Madd(" || prex.slice(prex.length - 5) == "Msub(" || prex.slice(prex.length - 5) == "Mmul(" || prex.slice(prex.length - 7) == "Maugment(") x += ","
                    else if (prex[prex.length - 1] == "=") x += "; "
                    else if (prex.length == 0 || (prex.slice(prex.length - 1) == ";")) x += "="
                    else x = "," + x + "); "
                }
                document.theForm.inputline.value = prex + x + postx;
                document.theForm.inputline.selectionStart = document.theForm.inputline.value.length
                document.theForm.inputline.selectionEnd = document.theForm.inputline.value.length
            } else {
                document.theForm.inputline.value += x
            }
            document.theForm.inputline.focus()
        }
        // - - - - - - - - - - - - - - - - - - - -
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) {
                if (dosam) samp()
                else calc();
            }
            if (charCode == 27) clere();
        };
        // - - - - - - - - - - - - - - - - - - - -
        function M(V, X) {
            // re = new RegExp( V+" *="); if (DOIT.search(re)==-1) return
            var V1 = document.getElementById("input" + V)
            V1.value = ""
            if (typeof(X) != "object") {
                V1.value += (isNaN(X) ? X : my(X));
                return
            }
            for (i = 0; i < X.length; i++) {
                V1.value += "| ";
                for (j = 0; j < X[i].length; j++) V1.value += my(X[i][j]) + (j < X[i].length - 1 ? "," : " | \n")
            }
        }
        // - - - - - - - - - - - - - - - - - - - -
        function clere() {
            clerp();
            clerd()
        }
        // - - - - - - - - - - - - - - - - - - - -
        function clerp() {
            dosam = false
            document.theForm.inputline.value = ""
            document.theForm.inputline.focus()
        }
        // - - - - - - - - - - - - - - - - - - - -
        function clerd() {
            dosam = false
            document.theForm.inputA.value = ""
            document.theForm.inputB.value = ""
            document.theForm.inputC.value = ""
            document.theForm.inputD.value = ""
            document.theForm.inputE.value = ""
            document.theForm.inputF.value = ""
            document.theForm.inputG.value = ""
            document.theForm.inputH.value = ""
            document.theForm.inputI.value = ""
            document.theForm.inputline.focus()
        }
        // - - - - - - - - - - - - - - - - - - - -
        function samp() {
            document.theForm.inputline.value = sampcode[sampcodei = (sampcodei + 1) % sampcoden]
            clerd();
            calc()
            document.theForm.inputline.focus()
        }
        // - - - - - - - - - - - - - - - - - - - -
        function calc() {
            saveA.push(document.theForm.inputA.value)
            saveB.push(document.theForm.inputB.value)
            saveC.push(document.theForm.inputC.value)
            saveD.push(document.theForm.inputD.value)
            saveE.push(document.theForm.inputE.value)
            saveF.push(document.theForm.inputF.value)
            saveG.push(document.theForm.inputG.value)
            saveH.push(document.theForm.inputH.value)
            saveI.push(document.theForm.inputI.value)
            var A = Mparse(document.theForm.inputA.value)
            var B = Mparse(document.theForm.inputB.value)
            var C = Mparse(document.theForm.inputC.value)
            var D = Mparse(document.theForm.inputD.value)
            var E = Mparse(document.theForm.inputE.value)
            var F = Mparse(document.theForm.inputF.value)
            var G = Mparse(document.theForm.inputG.value)
            var H = Mparse(document.theForm.inputH.value)
            var I = Mparse(document.theForm.inputI.value)
            // try {jsoutput = eval("I="+document.theForm.inputI.value)}
            // catch(err) {I=[]; document.theForm.inputI.value="[]"}
            DOIT = document.theForm.inputline.value.replace(/^[\s\n\t]+/, "")
            if (DOIT.length != 0) eval(DOIT) // with(Math){eval (DOIT)}
            //{DOIT=sampcode[sampcodei=(sampcodei+1)%sampcoden]; document.theForm.inputline.value=DOIT}
            if (document.theForm.inputline.value.search(/A *=/) > -1) M("A", A)
            if (document.theForm.inputline.value.search(/B *=/) > -1) M("B", B)
            if (document.theForm.inputline.value.search(/C *=/) > -1) M("C", C)
            if (document.theForm.inputline.value.search(/D *=/) > -1) M("D", D)
            if (document.theForm.inputline.value.search(/E *=/) > -1) M("E", E)
            if (document.theForm.inputline.value.search(/F *=/) > -1) M("F", F)
            if (document.theForm.inputline.value.search(/G *=/) > -1) M("G", G)
            if (document.theForm.inputline.value.search(/H *=/) > -1) M("H", H)
            if (document.theForm.inputline.value.search(/I *=/) > -1) M("I", I)
            if (I == undefined) document.theForm.inputI.value = "[]"
            else if (typeof(I) != "object") document.theForm.inputI.value = I
            else {
                if (I.length == 0) Ival = "[]"
                else {
                    Ival = "["
                    for (i = 0; i < I.length; i++) {
                        if (I[i].length == 0) Ival += "[],"
                        else {
                            Ival += "[";
                            for (j = 0; j < I[i].length; j++) Ival += my(I[i][j]) + ","
                            Ival = Ival.slice(0, Ival.length - 1) + "],"
                        }
                    }
                }
                document.theForm.inputI.value = Ival.slice(0, Ival.length - 1) + "]"
            }
            document.theForm.inputline.focus()
        }
    </script>
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onload="self.focus();">
    <?php include('nav.html'); ?>
    <div class="widecalcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">
            <h1>Matrix Math</h1>

            <input name="clearbutt" value="Clear All" onclick="clere()" type="button" title="Clear">
            <input name="cleapbutt" value="Clear Prog" onclick="clerp()" type="button" title="Clear Program">
            <input name="cleadbutt" value="Clear Data" onclick="clerd()" type="button" title="Clear Data">
            <input name="calcbutt" value="Calc" onclick="dosam=false; calc()" type="button" title="Perform commands">
            <input name="mpopbutt" value="undo" onclick="mrestore()" type="button" title="restore prior data">
            <input type="button" value="8 place" id="frac" onClick="swfrac('',4)" title="output format" />
            <br><br><br>
            <h2>Sample routines:</h2> <input name="sampbutt" value="Run Next" onclick="dosam=true; samp()" type="button" title="Sample commands">
            <input type="text" name="inputline" rows="5" cols="50" onkeyup="enter(event)">

            <h2>Functions:</h2> <input name="Maddbutt" value="Madd" onclick="putx('Madd(')" type="button" title="Matrix add">
            <input name="Msubbutt" value="Msub" onclick="putx('Msub(')" type="button" title="Matrix subtract">
            <input name="Mmulbutt" value="Mmul" onclick="putx('Mmul(')" type="button" title="Matrix multiply">
            <input name="Minvbutt" value="Minv" onclick="putx('Minv(')" type="button" title="Matrix invert">
            <input name="Mtranbutt" value="Mtran" onclick="putx('Mtran(')" type="button" title="Matrix transpose">
            <input name="Mdetbutt" value="Mdet" onclick="putx('Mdet(')" type="button" title="Matrix determinant">
            <input name="Mclonebutt" value="Mclone" onclick="putx('Mclone(')" type="button" title="Matrix clone/copy">
            <input name="Msplitbutt" value="Msplit" onclick="putx('Msplit(')" type="button" title="split off last column">
            <input name="Maugmentbutt" value="Maugment" onclick="putx('Maugment(')" type="button" title="merge matrices">
            <input name="Mrrefbutt" value="Mrref" onclick="putx('Mrref(')" type="button" title="reduced row-echelon form">
            <!-- <input name="Mcramerbutt" value="cramer" onclick="putx('Mcramer(')" type="button" title="build cramer matrix">
<input name="mpowerbutt" value="mpow" onclick="putx('mpow(')" type="button" title="build matrix for least squares polynomial calc"> -->
            <br><br><br><br><br><br><br><br>
            <div class="button2row">
                <div class="button1">
                    <label><input name="MAbutt" value="A" onclick="putx('A')" type="button" title="A"></label></div>
                <div class="button2"> <input type="text" name="inputA" id="inputA" rows="6" cols="22"><br></div>
            </div>

            <div class="button2row">
                <div class="button1"> <label><input name="MBbutt" value="B" onclick="putx('B')" type="button" title="B"></label></div>
                <div class="button2"><input type="text" name="inputB" id="inputB" rows="6" cols="22"><br></div>
            </div>

            <div class="button2row">
                <div class="button1"><label><input name="MCbutt" value="C" onclick="putx('C')" type="button" title="C"></label></div>
                <div class="button2"><input type="text" name="inputC" id="inputC" rows="6" cols="22"><br></div>
            </div>

            <div class="button2row">
                <div class="button1"><label><input name="MDbutt" value="D" onclick="putx('D')" type="button" title="D"></label></div>
                <div class="button2"><input type="text" name="inputD" id="inputD" rows="6" cols="22"><br></div>
            </div>

            <div class="button2row">
                <div class="button1"><label><input name="MEbutt" value="E" onclick="putx('E')" type="button" title="E"></label></div>
                <div class="button2"><input type="text" name="inputE" id="inputE" rows="6" cols="22"><br></div>
            </div>

            <div class="button2row">
                <div class="button1"><label><input name="MFbutt" value="F" onclick="putx('F')" type="button" title="F"></label></div>
                <div class="button2"><input type="text" name="inputF" id="inputF" rows="6" cols="22"><br></div>
            </div>

            <div class="button2row">
                <div class="button1"><label><input name="MGbutt" value="G" onclick="putx('G')" type="button" title="G"></label></div>
                <div class="button2"><input type="text" name="inputG" id="inputG" rows="6" cols="22"><br></div>
            </div>

            <div class="button2row">
                <div class="button1"><label><input name="MHbutt" value="H" onclick="putx('H')" type="button" title="H"></label></div>
                <div class="button2"><input type="text" name="inputH" id="inputH" rows="6" cols="22"><br></div>
            </div>

            <div class="button2row">
                <div class="button1"><label><input name="MIbutt" value=" I " onclick="putx('I')" type="button" title="I"></label></div>
                <div class="button2"><input type="text" name="inputI" id="inputI" rows="2" cols="100"></div>
            </div>

        </form>

    </div>
</body>

</html>