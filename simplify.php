<!DOCTYPE html>
<html lang="en">

<head>
    <title>Simplify and Solve Using Algebra</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/complex-calc.css">
</head>

<body id="simplifySolve">
    <?php include('nav.html'); ?>
    <script type="text/javascript" src="myfunctions.js"></script>
    <script>
        Sigma = String.fromCharCode(931);
        sigma = String.fromCharCode(963);
        mu = String.fromCharCode(956);
        plusminus = String.fromCharCode(177)
        P2 = String.fromCharCode(178);
        P3 = String.fromCharCode(179);
        F2 = String.fromCharCode(189);
        fofx = '';
        gofx = '';
        finitediff = false
        radical = String.fromCharCode(8730)
        var cra, crb, crc
        standf = false
        saveit = ''
        // ---------------------------------------------------*/
        function enter(evt) {
            var charCode = evt.keyCode;
            // document.theForm.output.value += " "+charCode+"="+String.fromCharCode(charCode); return
            if (charCode == 13) {
                calc();
                return
            }
            if (charCode == 27) {
                clere();
                return
            };
        }
        // ---------------------------------------------------*/
        function putx(x) {
            //IE support
            if (document.selection) {
                document.theForm.input.focus();
                sel = document.selection.createRange();
                sel.text = x
            } else if (document.theForm.input.selectionStart || document.theForm.input.selectionStart == '0') { //MOZILLA/NETSCAPE support
                var startPos = document.theForm.input.selectionStart;
                var endPos = document.theForm.input.selectionEnd;
                var cursorPos = startPos + x.length;
                document.theForm.input.value = document.theForm.input.value.substring(0, startPos) + x + document.theForm.input.value.substring(endPos, document.theForm.input.value.length);
                document.theForm.input.selectionStart = document.theForm.input.value.length
                document.theForm.input.selectionEnd = document.theForm.input.value.length
            } else {
                document.theForm.input.value += x
            }
            document.theForm.input.focus()
        }
        // ---------------------------------------------------*/
        function clere() {
            if (document.theForm.input.value == "" && document.theForm.output.value == "") {
                document.theForm.input.value = stuff[stuffi];
                stuffi = (stuffi + 1) % stuff.length;
                return
            }
            document.theForm.input.value = ""
            document.theForm.output.value = ""
            putx("")
        }
        // ---------------------------------------------------*/
        function slim(x) {
            return x.replace(/ /g, "")
        }
        // ---------------------------------------------------*/
        function cuberoot(x) {
            if (x < 0) return -Math.pow(-x, 1 / 3)
            return Math.pow(x, 1 / 3)
        }
        // ---------------------------------------------------*/
        function factorize(xp) {
            var xp1 = [
                [],
                []
            ]
            if (xp.length == 1) {
                xpis = fx2xx(xp, fracval[frac]);
                if (xpis == ' 1') return "";
                else return '(' + xpis + ')'
            }

            // try finding roots:
            if (XXN == 2) {
                xvarlim = Math.abs(xp[xp.length - 1][0]);
                xvarstep = 1 / Math.abs(xp[0][0]);
                xvari = 0
                while ((xvarval = xvari * xvarstep - xvarlim) <= xvarlim) {
                    xvarcalc = XX[0] + "=" + xvarval;
                    eval(xvarcalc)
                    ycalc = "yprev = " + cleanx(fx2xx(xp, fracval[frac]));
                    with(Math) {
                        eval(ycalc)
                    }
                    if (Math.abs(yprev) < 0.0000000001) {
                        xvarstep = myround(1 / xvarstep);
                        xvarval = myround(xvarval * xvarstep);
                        xvarfact = gcf(xvarval, xvarstep)
                        xp1[0] = [xvarstep / xvarfact, 1, 0];
                        xp1[1] = [-xvarval / xvarfact, 0, 0]
                        var xp2 = [],
                            xp3 = [] // reduce xp2, quotient to xp3
                        for (i = 0; i < xp.length; i++) {
                            xp2[i] = [];
                            for (j = 0; j < xp[i].length; j++) {
                                xp2[i][j] = xp[i][j]
                            }
                        }
                        while (xp2.length > 1) {
                            i = xp3.length;
                            xp3[i] = [xp2[0][0] / xp1[0][0]];
                            for (j = 1; j < xp2[0].length; j++) {
                                xp3[i][j] = xp2[0][j] - xp1[0][j]
                            }
                            k = xp2.length;
                            xp2[k] = [-xp1[0][0] * xp3[i][0]];
                            for (j = 1; j < xp1[1].length; j++) {
                                xp2[k][j] = xp1[0][j] + xp3[i][j]
                            }
                            k = xp2.length;
                            xp2[k] = [-xp1[1][0] * xp3[i][0]];
                            for (j = 1; j < xp1[1].length; j++) {
                                xp2[k][j] = xp1[1][j] + xp3[i][j]
                            }
                            xp2 = parse2(xp2)
                        }
                        // document.theForm.output.value += "("+fx2xx(xp1,fracval[frac])+") ("+fx2xx(xp3,fracval[frac])+") = "
                        return "(" + fx2xx(xp1, fracval[frac]) + ")" + factorize(xp3)
                    }
                    xvari++
                }
            }

            // try something else
            if (xp.length == 2) {
                var gcfx0 = 0;
                for (var j = 1; j < xp[0].length; j++) {
                    gcfx0 = gcf(gcfx0, xp[0][j]);
                    gcfx0 = gcf(gcfx0, xp[1][j]);
                }
                if ((gcfx0 % 2 == 0) && (xp[0][0] * xp[1][0] < 0)) {
                    xp1[0][0] = Math.sqrt(Math.abs(xp[0][0]));
                    xp1[1][0] = Math.sqrt(Math.abs(xp[1][0]));
                    for (j = 1; j < xp[0].length; j++) {
                        xp1[0][j] = xp[0][j] / 2;
                        xp1[1][j] = xp[1][j] / 2;
                    }
                    xp1x = factorize(xp1)
                    if (xp[0][0] < 0) {
                        xp1[0][0] *= -1
                    } else {
                        xp1[1][0] *= -1
                    }
                    return xp1x + factorize(xp1)
                }
                if (gcfx0 > 2) {
                    var xp0 = [
                        [],
                        []
                    ];
                    var xp2 = [];
                    xp0[0][0] = 1;
                    y = 1 / gcfx0;
                    x = xp[0][0];
                    xp1[0][0] = (x < 0 ? -Math.pow(-x, y) : Math.pow(x, y))
                    x = xp[1][0];
                    xp1[1][0] = (x < 0 ? -Math.pow(-x, y) : Math.pow(x, y))
                    for (j = 1; j < xp[0].length; j++) {
                        xp1[0][j] = xp[0][j] / gcfx0;
                        xp1[1][j] = xp[1][j] / gcfx0;
                        xp0[0][j] = 0
                    }
                    xp1x = factorize(xp1)
                    xp1[1][0] *= -1
                    for (i = 0; i < gcfx0; i++) {
                        xp2.push([1]);
                        for (j = 1; j < xp[0].length; j++) {
                            xp2[i][j] = 0
                        }
                    }
                    for (j = 0; j < xp[0].length; j++) {
                        xp0[0][j] = xp1[0][j];
                        xp0[1][j] = xp1[1][j]
                    }
                    for (i = gcfx0 - 2; i >= 0; i--) {
                        xp2[i][0] = xp0[0][0];
                        for (j = 1; j < xp[0].length; j++) {
                            xp2[i][j] = xp0[0][j]
                        }
                        xp0[0][0] *= xp1[0][0];
                        for (j = 1; j < xp[0].length; j++) {
                            xp0[0][j] += xp1[0][j]
                        }
                    }
                    for (i = 1; i < gcfx0; i++) {
                        xp2[i][0] *= xp0[1][0];
                        for (j = 1; j < xp[0].length; j++) {
                            xp2[i][j] += xp0[1][j]
                        }
                        xp0[1][0] *= xp1[1][0];
                        for (j = 1; j < xp[0].length; j++) {
                            xp0[1][j] += xp1[1][j]
                        }
                    }
                    return xp1x + "(" + fx2xx(xp2, fracval[frac]) + ")"
                }
                return "(" + fx2xx(xp, fracval[frac]) + ")"
            } else if (xp.length == 3) {
                var xp1 = [];
                xp1.push(xp[0].slice());
                xp1.push(xp[2].slice())
                for (j = 1; j < XXN; j++) {
                    if (xp[0][j] % 2 == 0 && xp[2][j] % 2 == 0 && ((xp[0][j] + xp[2][j]) == 2 * xp[1][j])) {
                        xp1[0][j] /= 2;
                        xp1[1][j] /= 2
                    } else {
                        return "(" + fx2xx(xp, fracval[frac]) + ")"
                    }
                }
                cra = xp[0][0];
                crb = xp[1][0];
                crc = xp[2][0];
                crd = crb * crb - 4 * cra * crc;
                if (crd < 0) {
                    return "(" + fx2xx(xp, fracval[frac]) + ")"
                }
                crx1 = (crb - Math.sqrt(crd)) / cra / 2;
                crx2 = (crb + Math.sqrt(crd)) / cra / 2
                cra0 = cra;
                cra1 = 1;
                cra2 = 1
                crcf = gcf(cra0, crx1 * cra0);
                crx1 *= cra0 / crcf;
                cra1 = cra0 / crcf;
                cra0 = crcf
                crx2 *= cra0;
                cra2 = cra0
                xp1[0][0] = cra1;
                xp1[1][0] = crx1
                // document.theForm.output.value += "\n >>> "+ fx2xx(xp1,fracval[frac])+ "\n"
                var xp1a = factorize(xp1)
                xp1[0][0] = cra2;
                xp1[1][0] = crx2
                // document.theForm.output.value += "\n >>> "+ fx2xx(xp1,fracval[frac])+ "\n"
                var xp1b = factorize(xp1)
                return xp1a + xp1b
            } else if (xp.length == 4) {
                var ex1pa = [];
                ex1pa.push(xp[0].slice());
                ex1pa[0][0] = gcf(ex1pa[0][0], xp[1][0])
                for (j = 1; j < ex1pa[0].length; j++) {
                    ex1pa[0][j] = Math.min(ex1pa[0][j], xp[0][j]);
                    ex1pa[0][j] = Math.min(ex1pa[0][j], xp[1][j])
                }
                var ex1pb = [
                    [],
                    []
                ];
                ex1pb[0][0] = xp[0][0] / ex1pa[0][0];;
                ex1pb[1][0] = xp[1][0] / ex1pa[0][0]
                for (j = 1; j < ex1pa[0].length; j++) {
                    ex1pb[0][j] = xp[0][j] - ex1pa[0][j];
                    ex1pb[1][j] = xp[1][j] - ex1pa[0][j]
                }
                // document.theForm.output.value += "\n >>> "+ fx2xx(ex1pa,fracval[frac])+ " >> "+ fx2xx(ex1pb,fracval[frac])+"\n"
                ex1pa.push(xp[2].slice());
                ex1pa[1][0] = gcf(ex1pa[1][0], xp[3][0])
                if (ex1pb[0][0] == -xp[2][0] / ex1pa[1][0]) {
                    ex1pa[1][0] *= -1
                }
                for (j = 1; j < ex1pa[1].length; j++) {
                    ex1pa[1][j] = Math.min(ex1pa[1][j], xp[2][j]);
                    ex1pa[1][j] = Math.min(ex1pa[1][j], xp[3][j])
                }
                if ((ex1pb[0][0] == xp[2][0] / ex1pa[1][0]) && (ex1pb[1][0] == xp[3][0] / ex1pa[1][0])) {
                    varsok = fracval[frac];
                    for (j = 1; j < ex1pa[1].length; j++) {
                        if ((ex1pb[0][j] != xp[2][j] - ex1pa[1][j]) || (ex1pb[1][j] != xp[3][j] - ex1pa[1][j])) varsok = false
                    }
                    if (varsok) return factorize(ex1pa) + factorize(ex1pb) + " "
                }
            }
            return "(" + fx2xx(xp, fracval[frac]) + ")"
        }
        // ---------------------------------------------------*/
        function calc1(pno, exdata) {
            SolveFor = (document.theForm.solvefor.value + ' ').slice(0, 1)
            ex0 = exdata;
            exrela = " ";
            fgex0f = ""
            if (SolveFor == " ") {
                expno = ex0.search(/y/i);
                if (expno == -1) expno = ex0.search(/[a-z]/i)
                if (expno > -1) SolveFor = ex0.charAt(expno)
            }
            if (ex0.search(/[<=>≥≤≠]/) > -1) {
                var exline1 = ex0.search(/[<=>≥≤≠]+/)
                var exline2 = ex0.slice(exline1).search(/[^<=>≥≤≠]/) + exline1;
                if (exline2 < 0) exline2 = ex0.length
                exrela = " " + ex0.slice(exline1, exline2) + " ";
                ex0 = ex0.slice(0, exline1) + "=" + ex0.slice(exline2)
            }
            if (fofx.length > 0) {
                ex0f = ex0.split(/f *\(/i)
                for (i = 1; i < ex0f.length; i++) {
                    var p1 = 0;
                    var p2 = 0
                    while (p1 < ex0f[i].length) {
                        if (ex0f[i].charAt(p1) == "(") p2++
                        if (ex0f[i].charAt(p1) == ")") {
                            if (p2 == 0) {
                                break
                            }
                            p2--
                        }
                        p1++
                    }
                    ex0f[i] = fofx.replace(/x/ig, ex0f[i].slice(0, p1)) + ex0f[i].slice(p1)
                }
                ex0 = ex0f.join("(");
                fgex0f = " =" + ex0
            }
            if (gofx.length > 0) {
                ex0f = ex0.split(/g *\(/i)
                for (i = 1; i < ex0f.length; i++) {
                    var p1 = 0;
                    var p2 = 0
                    while (p1 < ex0f[i].length) {
                        if (ex0f[i].charAt(p1) == "(") p2++
                        if (ex0f[i].charAt(p1) == ")") {
                            if (p2 == 0) {
                                break
                            }
                            p2--
                        }
                        p1++
                    }
                    ex0f[i] = gofx.replace(/x/ig, ex0f[i].slice(0, p1)) + ex0f[i].slice(p1)
                }
                ex0 = ex0f.join("(");
                fgex0f = " =" + ex0
            }
            var ex1 = clean(ex0)
            var ex1varlist = ex1.match(/[A-Z]/g);
            if (ex1varlist == null) {
                ex1varlist = []
            };
            ex1varlist = ex1varlist.sort();
            var i = 0;
            while (i < ex1varlist.length) {
                if (ex1varlist[i] == ex1varlist[i - 1] || ex1varlist[i] == "I") ex1varlist.splice(i, 1);
                else i++
            }
            var ex1v1 = ex1.search(/;/)
            if (ex1v1 > 0) {
                SolveFor = ex1.slice(ex1v1 + 1);
                ex1 = ex1.slice(0, ex1v1)
            } else {
                if (ex1varlist.length == 1) SolveFor = ex1varlist[0]
            }
            SolveFor = (SolveFor + "Y").slice(0, 1).toUpperCase()

            var ex = ex1.split(/\)\/\(/);
            if (ex1.search(/\) *\/ *\(/) >= 0 && ex.length == 2) {
                XXY = ex1.match(/[A-Z]/g)
                var ex1 = ex[0],
                    ex2 = ex[1];
                var ex1p = parse(clean(ex1), XXY);
                var ex2p = parse(clean(ex2), XXY);
                var ex3p = []
                done = ex.length != 2
                while (!done) // divide ex1p by ex2p
                {
                    if (ex1p.length * ex2p.length == 0) break
                    var ex3pi = ex3p.length;
                    ex3p[ex3pi] = [];
                    // build next term of quotient
                    ex3p[ex3pi][0] = ex1p[0][0] / ex2p[0][0]
                    for (var j = 0; j < XXN; j++) {
                        ex3p[ex3pi][j + 1] = ex1p[0][j + 1] - ex2p[0][j + 1]
                    }
                    for (j = 0; j < XXN; j++) {
                        if (ex3p[ex3pi][j + 1] < 0) {
                            done = true;
                            ex3p.pop();
                            break
                        }
                    }
                    if (done) {
                        break
                    }
                    ex1pi = ex1p.length
                    for (var k = 0; k < ex2p.length; k++) {
                        ex1p[ex1pi + k] = [];
                        ex1p[ex1pi + k][0] = -ex3p[ex3pi][0] * ex2p[k][0]
                        for (var j = 0; j < XXN; j++) {
                            ex1p[ex1pi + k][j + 1] = ex3p[ex3pi][j + 1] + ex2p[k][j + 1]
                        }
                    }
                    var ex1p = parse2(ex1p)
                }
                // dump ("-->",ex3p)
                document.theForm.output.value += pno + exdata + "= (" + (ex1 = fx2xx(ex3p, fracval[frac])) + ")"
                if (ex1p.length > 0) {
                    document.theForm.output.value += " remainder: (" + fx2xx(ex1p, fracval[frac]) + ")"
                }
                ex1 = clean(ex1)
                if (finitediff) {
                    document.theForm.output.value += "\n lim(h→0)= ";
                    extz = "0";
                    ext = fx2xx(ex3p, fracval[frac])
                    while (ext.length > 0) {
                        extt = ext.slice(1).search(/[+-]/) + 1;
                        if (extt < 1) extt = ext.length
                        if (ext.slice(0, extt).search(/h/) == -1) {
                            extz = "";
                            document.theForm.output.value += ext.slice(0, extt)
                        }
                        ext = ext.slice(extt)
                    }
                }
                document.theForm.output.value += "\n"
                return
            } else {
                document.theForm.output.value += pno + exdata + fgex0f
            }
            ex1eq = ex1.search(/=/)
            if (ex1eq > 0) {
                ex1a = ex1.slice(0, ex1eq);
                ex1b = ex1.slice(ex1eq + 1)
                sfie = true;
                var ex1pax1 = fx2xx(parse(ex1a), fracval[frac]);
                var ex1bpx1 = fx2xx(parse(ex1b), fracval[frac])
                sfie = false;
                var ex1pax2 = fx2xx(parse(ex1a), fracval[frac]);
                var ex1bpx2 = fx2xx(parse(ex1b), fracval[frac])
                ex011 = slim(ex1pax1 + exrela + ex1bpx1);
                ex012 = slim(ex1pax2 + exrela + ex1bpx2)
                if (document.theForm.showwork.checked) {
                    if (ex011 != slim(ex0.replace(/=/, exrela))) document.theForm.output.value += "\n" + ex011
                    if (ex011 != ex012) document.theForm.output.value += "\n" + ex012
                }
                /*     document.theForm.output.value += "\nex0: "+ex0
                    document.theForm.output.value += "\nex1: "+ex1
                    document.theForm.output.value += "\nex011: "+ex011
                    document.theForm.output.value += "\nex012: "+ex012    */
                if (standf) {
                    ex0b = parse(ex1a + "-(" + ex1b + ")")
                    if (ex0b.length > 0) ex0bc = ex0b.pop();
                    else ex0bc = [
                        [0]
                    ]
                    isconst = true
                    for (i = 1; i < ex0bc.length; i++)
                        if (ex0bc[i] != 0) isconst = false
                    if (!isconst) {
                        ex0b.push(ex0bc.slice());
                        ex0bc[0] = 0
                    }
                    ex02 = slim(fx2xx(ex0b, fracval[frac]) + exrela + (-ex0bc[0]))
                    if (ex012 != ex02) document.theForm.output.value += "\n" + ex02
                }
            }
            var ex1p = parse(ex1);
            var ex1px = fx2xx(ex1p, fracval[frac])
            if (ex1.search(/=/) > -1) {
                document.theForm.output.value += "\n"
                varxi = 0;
                for (i = 0; i < XXN; i++) {
                    if (XX[i] == SolveFor) varxi = i + 1
                }
                // varxi is equal to the exp index, one more than the XX index
                exporder = 0
                if (varxi > 0)
                    for (i = 0; i < ex1p.length; i++) {
                        if (ex1p[0] != 0) exporder = Math.max(ex1p[i][varxi], exporder)
                    }
                if (exporder == 1) {
                    var ex1pa = [];
                    var ex1pb = [];
                    varyi = 0;
                    varyc = 0
                    for (i = 0; i < ex1p.length; i++) {
                        if (ex1p[i][varxi] == 0) {
                            ex1pa.push(ex1p[i].slice());
                            ex1pa[ex1pa.length - 1][0] *= -1;
                            for (j = 0; j < XXN; j++) {
                                if (ex1pa[ex1pa.length - 1][j + 1] == 1) {
                                    if (varyc == 0) {
                                        varyi = j + 1;
                                        varyc = 1
                                    } else {
                                        if (varyi != j + 1) {
                                            varyc += 1;
                                            varyi = 0
                                        }
                                    }
                                } else if (ex1pa[ex1pa.length - 1][j + 1] > 1) varyc = 2
                            }
                        } else {
                            ex1pb.push(ex1p[i].slice());
                            ex1pb[ex1pb.length - 1][varxi] -= 1;
                        }
                    }
                    if (ex1pa.length == 0) ex1pa = [
                        [0]
                    ]
                    iscoco = ex1pb.length == 1;
                    if (iscoco) {
                        for (i = 0; i < XXN; i++)
                            if (ex1pb[0][i + 1] != 0) {
                                iscoco = false
                            }
                    }
                    if (iscoco) {
                        if (document.theForm.showwork.checked)
                            if (fx2xx(ex1pb) != 1) {
                                document.theForm.output.value += fx2xx(ex1pb, fracval[frac]) + XX[varxi - 1].toLowerCase() + exrela + fx2xx(ex1pa, fracval[frac]) + "\n"
                                if (ex1pb[0][0] < 0)
                                    exrela = exrela.replace(/</, '>').replace(/>/, '<').replace(/≥/, '≤').replace(/≤/, '≥')
                            }
                        for (i = 0; i < ex1pa.length; i++) {
                            ex1pa[i][0] /= ex1pb[0][0]
                        }
                        document.theForm.output.value += XX[varxi - 1].toLowerCase() + exrela + fx2xx(ex1pa, fracval[frac]) + "\n"
                        if (varyc == 0) saveit1 += XX[varxi - 1].toLowerCase() + '=' + fx2xx(ex1pa, fracval[frac]) + "\n"
                        else saveit += XX[varxi - 1].toLowerCase() + '=' + fx2xx(ex1pa, fracval[frac]) + "\n"
                        if (varyc == 1) {
                            // saveit += XX[varxi-1].toLowerCase() +'='+fx2xx(ex1pa,fracval[frac])+"\n"
                            document.theForm.output.value += " slope= " + (myround(ex1pa[0][0], fracval[frac])) + "; " + XX[varxi - 1].toLowerCase() + " intercept= " + (myround((ex1pa.length > 1 ? ex1pa[1][0] : 0), fracval[frac])) + "; " + XX[varyi - 1].toLowerCase() + " intercept= " + (myround(-(ex1pa.length > 1 ? ex1pa[1][0] : 0) / ex1pa[0][0], fracval[frac])) + "\n"
                        }
                    } else {
                        if (ex1pa[0][0] < 0) {
                            for (i = 0; i < ex1pa.length; i++) {
                                ex1pa[i][0] /= -1
                            }
                            for (i = 0; i < ex1pb.length; i++) {
                                ex1pb[i][0] /= -1
                            }
                        }
                        saveit += XX[varxi - 1].toLowerCase() + "=(" + fx2xx(ex1pa, 99) + ")/(" + fx2xx(ex1pb, 99) + ")\n"
                        document.theForm.output.value += XX[varxi - 1].toLowerCase() + "=(" + fx2xx(ex1pa, 99) + ")/(" + fx2xx(ex1pb, 99) + ")\n"
                    }
                } else if (exporder == 2 && XXN == 2) {
                    document.theForm.output.value += ex1px + " = 0; "
                    var cra = 0,
                        crb = 0,
                        crc = 0
                    for (i = 0; i < ex1p.length; i++) {
                        if (ex1p[i][varxi] == 2) cra = ex1p[i][0]
                        if (ex1p[i][varxi] == 1) crb = ex1p[i][0]
                        if (ex1p[i][varxi] == 0) crc = ex1p[i][0]
                    }
                    var crd = crb * crb - 4 * cra * crc;
                    document.theForm.output.value += "Quadratic equation: "
                    if (crd < 0) {
                        document.theForm.output.value += " no real solutions.\n";
                        return
                    }
                    crx1 = (-crb - Math.sqrt(crd)) / cra / 2;
                    crx2 = (-crb + Math.sqrt(crd)) / cra / 2
                    document.theForm.output.value += XX[varxi - 1].toLowerCase() + exrela + myround(crx1, fracval[frac])
                    if (crd > 0) document.theForm.output.value += " & " + XX[varxi - 1].toLowerCase() + exrela + myround(crx2, fracval[frac])
                    document.theForm.output.value += "\n"
                } else if (exporder == 0) {
                    if (XXN < 3) {
                        document.theForm.output.value += ex1px + " = 0; "
                        exp1xval = eval(ex1px)
                        document.theForm.output.value += (exp1xval == 0 ? "Equation is true for all values" : "NO SOLUTION") + "\n"
                    } else {
                        norma = 1;
                        for (i = 0; i < ex1p.length; i++)
                            if (ex1p[i][0] != 0) {
                                norma1 = myround(1 / ex1p[i][0], true)
                                norma2 = norma1.search(/\//);
                                if (norma2 > -1) norma1 = norma1.slice(0, norma2)
                                norma = lcm(norma, Number(norma1))
                            }
                        for (i = 0; i < ex1p.length; i++) ex1p[i][0] *= norma
                        varxi = 1;
                        var ex1pa = [];
                        var ex1pb = [];
                        for (i = 0; i < ex1p.length; i++)
                            if (ex1p[i][0] != 0) {
                                termdeg = 0;
                                for (j = 1; j < XXN; j++) termdeg = Math.max(ex1p[i][j], termdeg)
                                if (termdeg > 0) {
                                    ex1pa.push(ex1p[i].slice())
                                } else {
                                    ex1pb.push(ex1p[i].slice())
                                }
                            }
                        if (ex1pa[0][0] < 0) {
                            for (i = 0; i < ex1pa.length; i++) {
                                ex1pa[i][0] /= -1
                            }
                        } else {
                            for (i = 0; i < ex1pb.length; i++) {
                                ex1pb[i][0] /= -1
                            }
                        }
                        ex6b = fx2xx(ex1pb, fracval[frac]);
                        ex6a = fx2xx(ex1pa, fracval[frac]);
                        saveit += ex6a + '=' + ex6b + "\n"
                        document.theForm.output.value += ex6a + exrela + ex6b + "\n"
                    }
                } else {
                    if ((document.theForm.showwork.checked) && slim(exdata) != slim(ex1px)) document.theForm.output.value += '0 = ' + ex1px + " = "
                    f1 = factorize(ex1p);
                    saveit += f1;
                    document.theForm.output.value += f1 + "\n"
                }
            } else {
                sfie = true;
                ex1pxa = fx2xx(parse(ex1), fracval[frac]);
                sfie = false // can't pass as parameter - null parms not allowed
                saveit += ex1pxa + ";\n"
                if ((document.theForm.showwork.checked) && (slim(ex1pxa) != slim(exdata)) && (slim(ex1pxa) != slim(ex1px))) document.theForm.output.value += " = " + ex1pxa
                if (XXN == 1 && ex1.search('I') < 0) ex1px = '' + eval(cleanx(ex1))
                if (slim(exdata) != slim(ex1px)) document.theForm.output.value += " = " + ex1px
                if (document.theForm.factorize.checked && ex1p.length > 1) {
                    document.theForm.output.value += " = "
                    // take out common factors?
                    var ex1pa = [];
                    ex1pa.push(ex1p[0].slice())
                    for (i = 1; i < ex1p.length; i++) {
                        ex1pa[0][0] = gcf(ex1pa[0][0], ex1p[i][0])
                        for (j = 1; j < ex1pa[0].length; j++) {
                            ex1pa[0][j] = Math.min(ex1pa[0][j], ex1p[i][j])
                        }
                    }
                    relprime = false;
                    if (ex1pa[0][0] == 1) {
                        relprime = true;
                        for (i = 1; i < XXN; i++) {
                            if (ex1pa[0][i] != 0) {
                                relprime = false
                            }
                        }
                    }
                    if (!relprime) {
                        document.theForm.output.value += fx2xx(ex1pa, fracval[frac])
                        for (i = 0; i < ex1p.length; i++) {
                            ex1p[i][0] /= ex1pa[0][0]
                            for (j = 1; j < ex1pa[0].length; j++) {
                                ex1p[i][j] -= ex1pa[0][j]
                            }
                        }
                    }
                    f1 = factorize(ex1p);
                    saveit += f1;
                    document.theForm.output.value += f1 + "\n"
                } else {
                    document.theForm.output.value += "\n"
                }
            }
        }
        // ---------------------------------------------------*/
        function calc() {
            degrees = false
            document.theForm.output.value = "";
            saveit = '';
            saveit1 = ''
            var ex = document.theForm.input.value
            fofx = clean(document.theForm.fofx.value).replace(/X/g, "(x)")
            gofx = clean(document.theForm.gofx.value).replace(/X/g, "(x)")
            if (fofx.length > 0) {
                finitediff = ex.length == 0
                if (finitediff) {
                    ex = "(f(x+h)-f(x))/(h)"
                    document.theForm.input.value = ex
                }
                document.theForm.output.value += "f(x)=" + fofx + "\n"
            }
            if (gofx.length > 0) {
                finitediff = ex.length == 0
                if (finitediff) {
                    ex = "(f(x+h)-f(x))/(h)"
                    document.theForm.input.value = ex
                }
                document.theForm.output.value += "g(x)=" + gofx + "\n"
            }
            while (ex.length) {
                var exline = ex.search(/[\n]/);
                if (exline < 0) exline = ex.length // ;x signals solve for
                var ex1 = ex.slice(0, exline);
                ex = ex.slice(exline + 1);
                var expno = ""
                if (ex1.search(/^\s*(\d+|\w+)(\)|\. )/) == 0) {
                    expno = ex1.match(/^\s*(\d+|\w+)(\)|\. )/)[0] + " ";
                    ex1 = ex1.replace(/^\s*(\d+|\w+)(\)|\. )/, "")
                }
                if (ex1.search(/.*:/) > -1) {
                    expno += ex1.match(/.*:/)[0] + " ";
                    ex1 = ex1.replace(/.*:/, "")
                }
                if (document.theForm.stripText.checked) {
                    while (ex1.search(/ [a-z.,]{2,} /ig) > -1) ex1 = ex1.replace(/ [a-z.,]{2,} /ig, " ")
                }
                ex1 = ex1.replace(/ +/g, " ").replace(/ $/g, "")
                if (ex1.slice(0, 2) == '//') continue
                if (ex1 == " ") continue
                if (ex1.length > 0) {
                    if (document.theForm.dumpText.checked) {
                        document.theForm.output.value += "\nin: " + ex1 + "; "
                        document.theForm.output.value += "\ncleanx: " + cleanx(ex1) + "; "
                        document.theForm.output.value += "\nclean: " + clean(ex1) + "; "
                        document.theForm.output.value += "\nparse: " + parse(clean(ex1)) + "; "
                        document.theForm.output.value += "\nfx2xx: " + fx2xx(parse(clean(ex1)), fracval[frac]) + "; "
                        document.theForm.output.value += "\nXXN: " + XXN + "; "
                        document.theForm.output.value += "\ncleanx: " + cleanx(fx2xx(parse(clean(ex1)), fracval[frac])) + "\n"
                    } else calc1(expno, ex1)
                }
            }
            document.theForm.input.value = document.theForm.input.value.replace(/\s+\n/g, "\n").replace(/\n+/g, "\n").replace(/\n*$/, "") + "\n"
        }
        // ---------------------------------------------------
        function Graph() {
            document.theForm.solvefor.value = 'y'
            var ex = document.theForm.input.value
            if (ex.length == 0) {
                ex = "1) x=1; x=6; y=-1; y=6\n2) 3x+4y=25\n3) 5x-2y=8; (x-2)^2+y=3(x-2)-1"
                document.theForm.input.value = ex
            }
            calc()
            if (saveit.length > 0) {
                window.open("graphs.htm")
                localStorage.setItem("graphdata", escape((saveit + saveit1).replace(/\n/g, "<br>").replace(/;/g, "<sc>")))
            }
        }
        // ---------------------------------------------------*/
        function conv() {
            /*
            var coni=0; ex = document.theForm.input.value; confr=document.theForm.convfr.value.replace(/ /g,""); conto=document.theForm.convto.value;
            if (confr.length) while (coni<ex.length)
            { if (ex.substr(coni,confr.length)==confr) ex = ex.slice(0,coni)+conto+ex.slice(coni+confr.length); coni+=1}
            */
            confr = document.theForm.convfr.value.replace(/^ */g, "");
            conto = document.theForm.convto.value;
            if (confr.length > 0) {
                var re = new RegExp(confr, "g")
                document.theForm.input.value = document.theForm.input.value.replace(re, conto)
            }
            calc()
        }
        // ---------------------------------------------------*/
    </script>
    <div id="calctainer">
        <a href="index.htm"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <h1>Simplify and Solve Using Algebra</h1>
        <form name="theForm">
            <div id="inputOutputGroup">
                <textarea name="input" tabindex="1" onKeyUp="enter(event)"></textarea>
                <textarea name="output" rows=20 cols=80>
input notes:
division must look like:  (   ) / (   )
</textarea>
                <div id="clearSave">
                    <input type="button" value="8 place" id="frac" onClick="swfrac(true)" />
                    <input name="graphbut" Value="Graph" type="button" onClick="Graph()" />
                    <input name="clerebut" Value="Clear" type="button" onClick="clere()" />
                    <input name="savebut" Value="Save" type="button" onClick="savestuff()" />
                    <input name="loadbut" Value="Load" type="button" onClick="loadstuff();standf=false;calc()" />
                </div>
            </div>

            <div id="digitsGroup">

                <input type="button" value="1" onClick="putx('1')" class="digit">
                <input type="button" value="2" onClick="putx('2')" class="digit">
                <input type="button" value="3" onClick="putx('3')" class="digit">
                <input type="button" value="+" onClick="putx('+')" />
                <input type="button" value="4" onClick="putx('4')" class="digit">
                <input type="button" value="5" onClick="putx('5')" class="digit">
                <input type="button" value="6" onClick="putx('6')" class="digit">
                <input type="button" value="-" onClick="putx('-')" />
                <input type="button" value="7" onClick="putx('7')" class="digit">
                <input type="button" value="8" onClick="putx('8')" class="digit">
                <input type="button" value="9" onClick="putx('9')" class="digit">
                <input type="button" value="*" onClick="putx('*')">
                <input type="button" value=" ." onClick="putx('.')">
                <input type="button" value="0" onClick="putx('0')" class="digit">
                <input type="button" value="," onClick="putx(',')">
                <input type="button" value="/" onClick="putx('/')"></div>

            <div id="buttonGroup1"><input type="button" value="x²" onClick="putx('x²')" />
                <input type="button" value="x" onClick="putx('x')" /><input type="button" value="^" onClick="putx('^')" />
                <input type="button" value="(  " onClick="putx('(')" />
                <input type="button" value=")" onClick="putx(')')" />

                <input type="button" value="=" onClick="putx('=')" /></div>

            <div id="buttonGroup2">
                <label for="fofx">f(x):</label>
                <input type="text" id="fofx" name="fofx" placeholder="f(x)" value="">
                <label for="gofx">g(x):</label>
                <input type="text" name="gofx" value="" placeholder="g(x)">
            </div>

            <div id="simplifyOptions">
                <span>
                    <input name="factorize" id="factorize" type="checkbox" onClick="standf=false;calc()" />
                    <label for="factorize">Factorize</label>
                </span>
                <span>
                    <input name="stripText" id="stripText" type="checkbox" onClick="standf=false;calc()" />
                    <label for="stripText">Strip Text</label>
                </span>
                <span>
                    <input name="showwork" id="showwork" type="checkbox" onClick="standf=false;calc()" />
                    <label for="showwork">Show Work</label>
                </span>
                <span>
                    <input name="dumpText" id="dumpText" type="checkbox" onClick="standf=false;calc()" />
                    <label for="dumpText">Debug</label>
                </span>
                <span>
                    <input type="button" value="Standard Form" onClick="document.theForm.solvefor.value='#';standf=true;calc()" />
                    <label for="solvefor">Or solve for: </label><input type="text" id="solvefor" name="solvefor" size=1 value=""></span>


            </div>
            <input name="calcbut" Value="Calculate" class="calcButton" type="button" onClick="standf=false;calc()" />

        </form>
    </div>
    <script>
        stuffi = 0
        stuff = ["1) 3(x+2)=8x+1\n// ignore this line\n  \n2) 3x+2y=6;x\n3) 3x+2y=6;y", "working on: (10+50i)/(1+3i)\n50/3 + (-20/3)(1-3i)/10\n(1+3i)(1-3i)\n(10+50i)(1-3i)\n(20i +160)/10\n", "1)   x^3 + x^2 + x + 1 = 0\n2)   x^3 - 17x^2 + 96x - 182 = 0\n3)   x^4 - 4x^3 + 4x-1 = 0\n4)   x^3 + 4x^2 + 9x + 36 = 0\n5)   2x^5 - 4x^4 - 2x^3 + 28x^2 = 0\n6)   2x^5 - 5x^4 - 23x^3 + 2x^2 - 36x - 120 = 0\n"]
        ls = decodeURIComponent(location.search)
        if (ls.search(/\?/) == 0) {
            if (ls == '?&') {
                loadstuff(true, 'simplify');
                calc()
            } else {
                lsf = ls.slice(1).split("&")
                document.theForm.input.value = lsf[0].split(";").join('\n') + '\n'
                standf = false;
                calc()
            }
        }
    </script>
</body>

</html>