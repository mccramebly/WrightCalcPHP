<!DOCTYPE html>
<html lang="en">

<head>
    <title>JS Parabola</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/complex-calc.css">
</head>

<body id="parabolaEquations">
    <?php include('nav.html'); ?>
    <script src="myfunctions.js"></script>
    <script>
        Sigma = String.fromCharCode(931);
        sigma = String.fromCharCode(963);
        mu = String.fromCharCode(956);
        plusminus = String.fromCharCode(177)
        P2 = String.fromCharCode(178);
        P3 = String.fromCharCode(179);
        F2 = String.fromCharCode(189);
        radical = String.fromCharCode(8730)
        var xra, xrb, xrc, yra, yrb, yrc
        var paradata = ""
        // ---------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            // document.theForm.output.value += " "+charCode+"="+String.fromCharCode(charCode); return
            if (charCode == 13) {
                calc();
                return
            }
            // if (charCode == 187) {calc(); return}
            if (charCode == 27) {
                clere();
                return
            };
        }
        // ---------------------------------------------------
        function switchxy() {
            document.theForm.output.value = document.theForm.output.value.replace(/\(([^,\)]*),([^,\)]*)\)/ig, "($2,$1)").replace(/([^aeiounsr])X/ig, "$1AY").replace(/([^aeiounsr])Y/ig, "$1X").replace(/AY/ig, "Y")
        }
        // ---------------------------------------------------
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
        // ---------------------------------------------------
        function clere() {
            if (document.theForm.input.value == "") document.theForm.input.value = document.theForm.output.value
            else {
                document.theForm.stand.checked = false
                document.theForm.vertex.checked = false
                document.theForm.focus.checked = false
                document.theForm.latus.checked = false
                document.theForm.quad.checked = false
                document.theForm.discr.checked = false
                document.theForm.factors.checked = false
                document.theForm.values.checked = false
                document.theForm.input.value = ""
                document.theForm.output.value = ""
            }
            putx("")
        }
        // ---------------------------------------------------
        function pair(crxx, cryy) {
            document.theForm.output.value += "(" + my(crxx) + ", " + my(cryy) + ") "
        }
        // ---------------------------------------------------
        function calc1(pno, exdata) {
            justfunction = !(document.theForm.stand.checked && document.theForm.vertex.checked && document.theForm.focus.checked && document.theForm.latus.checked && document.theForm.quad.checked && document.theForm.discr.checked && document.theForm.factors.checked && document.theForm.values.checked)
            // document.theForm.output.value += " from calc1  exdata ="+exdata +"\n"
            var ex = clean(exdata.replace(/[a-z]{2}/gi, ""))
            // document.theForm.output.value += " from calc1     ex ="+ex +"\n"
            if (ex.slice(0, 6) == "F*(X)=") {
                ex = ex.slice(6);
                exdata = ex
            }
            // document.theForm.output.value += " from calc1     parse(ex) ="+parse(ex) +"\n"
            // document.theForm.output.value += " from calc1     fx2xx(parse(ex))  ="+fx2xx(parse(ex),11) +"\n"
            if (ex.search(/;/) == -1) // Not 1;-4;-5
            {
                ex = clean(fx2xx(parse(ex), false))
            }
            // document.theForm.output.value += " from calc1     ex ="+ex +"\n"
            ex = ex.replace(/\*/g, "")
            var xra = 0,
                xrb = 0,
                xrc = 0,
                exsemi = 2,
                exequal = +1
            var yra = 0,
                yrb = 0,
                yrc = 0,
                yvar = "Y"
            var xvar = ex.search(/[A-Z]/i)
            // document.theForm.output.value += " from calc1     ex ="+ex +"\n"
            if (xvar < 0) {
                if (ex.search(/;/) > -1) xvar = "X";
                else {
                    if (ex.length > 0) document.theForm.output.value += pno + exdata + " << skipped\n";
                    return
                }
            } else {
                xvar = XX[0]
                if (XXN > 2) yvar = XX[1]
                else if (xvar == "Y") yvar = "X"
            }
            ex = ex.replace(/\^/g, "");
            if (ex.search(/[+\-]/) != 0) ex = "+" + ex;
            while (ex.length) {
                if (ex.charAt(0) == "=") {
                    ex = ex.slice(1);
                    exequal = -1
                } // remove equal
                exp = ex.slice(1).search(/[A-Z;+\-=]/) + 1;
                if (exp < 1) exp = ex.length
                ex1 = ex.slice(0, exp)
                if (ex.charAt(exp) == ";") {
                    ex = ex1 + (exsemi > 0 ? xvar + exsemi : "") + ex.slice(exp + 1);
                    exsemi = exsemi - 1
                } // replace semicolon with var
                if (ex1 == "-" || ex1 == "+" || ex1 == "") ex1 += "1"
                if (ex.charAt(exp) == xvar) {
                    ex = ex.slice(exp + 1) // drop var
                    if (ex.charAt(0) == "2") {
                        ex = ex.slice(1);
                        xra += exequal * myval(ex1)
                    } else if (ex.charAt(0) == "1") // I DO get x1
                    {
                        ex = ex.slice(1);
                        xrb += exequal * myval(ex1)
                    } else {
                        xrb += exequal * myval(ex1)
                        // if (ex.charAt(0) is a digit ) then we have too high a power
                    }
                } else if (ex.charAt(exp) == yvar) {
                    ex = ex.slice(exp + 1) // drop var
                    if (ex.charAt(0) == "2") {
                        ex = ex.slice(1);
                        yra += exequal * myval(ex1)
                    } else {
                        yrb += exequal * myval(ex1)
                        // if (ex.charAt(0) is a digit ) then we have too high a power
                    }
                } else {
                    xrc += exequal * myval(ex1);
                    ex = ex.slice(exp)
                }
                if (exsemi < 0) break
            }
            flip = false;
            if (xra == 0) {
                if (yra != 0) {
                    xra = yra;
                    yra = 0;
                    t = xrb;
                    xrb = yrb;
                    yrb = t;
                    t = xvar;
                    xvar = yvar;
                    yvar = t;
                    flip = true
                } else {
                    document.theForm.output.value += pno + "No quadratic term: " + exdata + "\n\n";
                    return
                }
            }
            document.theForm.output.value += pno + " " + exdata + "\n"
            xvar = xvar.toLowerCase()
            if (yra == 0) { // itsa parabola
                if (yrb != 0) {
                    xra /= -yrb;
                    xrb /= -yrb;
                    xrc /= -yrb
                }
                exdata1 = clean(coeff(true, xra, xvar + "^2", fracval[frac]) + coeff(false, xrb, xvar, fracval[frac]) + coeff(false, xrc, "", fracval[frac]))
                if (!justfunction) {
                    if (exdata.search(/=/) != -1) {
                        document.theForm.output.value += exdata + "; " + (yrb != 0 ? yvar : "0") + " = "
                    } else if (exdata1 != clean(exdata)) {
                        document.theForm.output.value += exdata + " = "
                    }
                }
                document.theForm.output.value += "General form: " + yvar + "= " + exdata1 + "\n"
                crh = -xrb / xra / 2;
                crk = xra * crh * crh + xrb * crh + xrc;
                crp = 1 / xra / 4
                crd = xrb * xrb - 4 * xra * xrc;
                crx1 = crh - 2 * crp;
                crx2 = crh + 2 * crp;
                rexp = RegExp(xvar, 'img');
                crpa = Math.abs(crp)
                // paradata=exdata1.replace(rexp,"X")+"&"+(crh-3*crpa)+ " to "+(crh+3*crpa)+"&"+(crk-3*crpa)+ " to "+(crk+3*crpa)
                paradata = "x:" + (crh - 3 * crpa) + " to " + (crh + 3 * crpa) + "; y:" + (crk - 3 * crpa) + " to " + (crk + 3 * crpa) + "; " + exdata1.replace(rexp, "X") + "\n"
                if (document.theForm.stand.checked) {
                    document.theForm.output.value += "Standard form: " + yvar + " = (" // y=a("+xvar+"-h)"+P2+"+k
                    document.theForm.output.value += coeff(true, xra, xvar + P2, fracval[frac]) + coeff(false, xrb, xvar, fracval[frac]) + coeff(false, (xra * crh * crh), "", fracval[frac]) + ")" + coeff(false, (-xra * crh * crh), "", fracval[frac]) + coeff(false, (crk + xra * crh * crh), "", fracval[frac]) + " = "
                    document.theForm.output.value += coeff(true, xra, "(", fracval[frac]) + xvar + coeff(false, -crh, "", fracval[frac]) + ")" + P2 + (myround(crk) != 0 ? coeff(false, crk, "", fracval[frac]) : "") + "\n"
                    document.theForm.output.value += "Transformational form: " + coeff(true, 1 / xra, "(", fracval[frac]) + yvar + coeff(false, -crk, "", fracval[frac]) + ") = (" + xvar + coeff(false, -crh, "", fracval[frac]) + ")" + P2 + "\n"
                }
                if (document.theForm.vertex.checked) {
                    document.theForm.output.value += "Axis of symmetry: " + xvar + "=" + coeff(true, crh, "", fracval[frac]) + "; Vertex (" + (xra > 0 ? "minimum" : "maximum") + ")"
                    if (flip) document.theForm.output.value += "=(k,h)=(" + coeff(true, crk, "", fracval[frac]) + "," + coeff(true, crh, "", fracval[frac]) + "); "
                    else document.theForm.output.value += "=(h,k)=(" + coeff(true, crh, "", fracval[frac]) + "," + coeff(true, crk, "", fracval[frac]) + "); "
                    document.theForm.output.value += yvar + "-intercept is (0," + xrc + ")\n"
                }
                if (document.theForm.focus.checked) {
                    document.theForm.output.value += "p=1/(4a)=" + myround(crp) + "; Focus: (h,k+p)=("
                    if (flip) document.theForm.output.value += coeff(true, crk + crp, "", fracval[frac]) + "," + coeff(true, crh, "", fracval[frac])
                    else document.theForm.output.value += coeff(true, crh, "", fracval[frac]) + "," + coeff(true, crk + crp, "", fracval[frac])
                    document.theForm.output.value += "); Directrix: " + yvar + "=k-p=" + round4(crk - crp) + "\n"
                }
                if (document.theForm.latus.checked) {
                    cry1 = xra * crx1 * crx1 + xrb * crx1 + xrc;
                    cry2 = xra * crx2 * crx2 + xrb * crx2 + xrc
                    if (flip) {
                        latus1 = "(" + coeff(true, cry1, "", fracval[frac]) + "," + coeff(true, crx1, "", fracval[frac]) + ")"
                        latus2 = "(" + coeff(true, cry2, "", fracval[frac]) + "," + coeff(true, crx2, "", fracval[frac]) + ")"
                    } else {
                        latus1 = "(" + coeff(true, crx1, "", fracval[frac]) + "," + coeff(true, cry1, "", fracval[frac]) + ")"
                        latus2 = "(" + coeff(true, crx2, "", fracval[frac]) + "," + coeff(true, cry2, "", fracval[frac]) + ")"
                    }
                    paradata += "&" + latus1 + latus2
                    // paradata += "&("+crx1+","+(crk-crp)+")("+crx2+","+(crk-crp)+")"
                    paradata += "& " + (crk - crp) + "+0x"
                    crx3 = crh + crp
                    paradata += "&(" + crh + "," + (crk + crp) + ")(" + (crx3) + "," + (xra * crx3 * crx3 + xrb * crx3 + xrc) + ")(" + (crx3) + "," + (crk - crp) + ")"
                    document.theForm.output.value += "Latus: " + latus1 + " to " + latus2
                    document.theForm.output.value += "; Focal Diameter: " + Math.sqrt((crx1 - crx2) * (crx1 - crx2) + (cry1 - cry2) * (cry1 - cry2))
                    document.theForm.output.value += "\n"
                }
                if (document.theForm.quad.checked) {
                    document.theForm.output.value += "Quadratic formula: " + xvar + " = (-b " + plusminus + radical + "(b" + P2 + "-4ac))/(2a)"
                    document.theForm.output.value += " = (" + coeff(true, -xrb, "") + plusminus + radical + "(" + coeff(true, xrb * xrb, "") + coeff(false, -4 * xra * xrc, "") + "))/(" + coeff(true, 2 * xra, "") + ")\n"
                }
                if (document.theForm.discr.checked) {
                    if (crd == 0) {
                        document.theForm.output.value += "zero discriminant; one root: " + xvar + "=" + crh + "\n"
                    } else if (crd > 0) {
                        x1 = -crh - Math.sqrt(crd) / xra / 2;
                        x2 = -crh + Math.sqrt(crd) / xra / 2;
                        xra0 = xra;
                        xra1 = 1;
                        xra2 = 1
                        xrcf = gcf(xra0, x1 * xra0);
                        x1 *= xra0 / xrcf;
                        xra1 = xra0 / xrcf;
                        xra0 = xrcf
                        xrcf = gcf(xra0, x2 * xra0);
                        x2 *= xra0 / xrcf;
                        xra2 = xra0 / xrcf;
                        xra0 = xrcf
                        document.theForm.output.value += "positive discriminant = " + myround(crd, fracval[frac]) + "; two real roots: " + xvar + "=" + myround((crh - Math.sqrt(crd) / xra / 2), fracval[frac]) + " and " + myround((crh + Math.sqrt(crd) / xra / 2), fracval[frac]) + "\n"
                    } else {
                        document.theForm.output.value += "negative discriminant = " + myround(crd, fracval[frac]) + "; two complex roots: " + xvar + "=" + crh + plusminus + coeff(true, Math.sqrt(-crd) / xra / 2, "i\n", fracval[frac])
                    }
                } else {
                    document.theForm.output.value += "Parabola, Solution" + (crd >= 0 ? " (" + xvar + "-intercept" + (crd > 0 ? "s" : "") + ")" : "") + ": " + xvar + " = " + (crh == 0 && crk != 0 ? "" : coeff(true, crh, "", fracval[frac]))
                    if (crk != 0) document.theForm.output.value += " " + plusminus + radical + "(" + coeff(true, -crk / xra, "", fracval[frac]) + ")"
                    if ((-crk / xra) > 0) {
                        document.theForm.output.value += " = " + (round4(crh - Math.sqrt(-crk / xra), fracval[frac])) + ", or " + round4(crh + Math.sqrt(-crk / xra), fracval[frac])
                    } else if (-crk / xra < 0) {
                        document.theForm.output.value += " = " + crh + "+" + Math.sqrt(crk / xra) + "i, or " + crh + "-" + Math.sqrt(crk / xra) + "i"
                    }
                    document.theForm.output.value += "\n"
                }
                if (document.theForm.factors.checked) {
                    if (crd >= 0) {
                        x1 = -crh - Math.sqrt(crd) / xra / 2;
                        x2 = -crh + Math.sqrt(crd) / xra / 2;
                        xra0 = xra;
                        xra1 = 1;
                        xra2 = 1
                        xrcf = gcf(xra0, x1 * xra0);
                        x1f = x1 * xra0 / xrcf;
                        xra1 = xra0 / xrcf;
                        xra0 = xrcf
                        xrcf = gcf(xra0, x2 * xra0);
                        x2f = x2 * xra0 / xrcf;
                        xra2 = xra0 / xrcf;
                        xra0 = xrcf
                        document.theForm.output.value += "factors: " + (round4(xra0) == 1 ? "" : xra0) + "(" + coeff(true, xra1, xvar, fracval[frac]) + coeff(false, x1f, "", fracval[frac]) + ")(" + (coeff(true, xra2, xvar, fracval[frac])) + coeff(false, x2f, "", fracval[frac]) + ")"
                        if (round4(xra) != 1) document.theForm.output.value += " = " + xra + " (" + xvar + coeff(false, x1, "", fracval[frac]) + ")(" + xvar + coeff(false, x2, "", fracval[frac]) + ")"
                        document.theForm.output.value += "\n"
                    } else // if (!document.theForm.discr.checked)
                    {
                        document.theForm.output.value += "factors: (x-(" + coeff(true, crh, "", fracval[frac]) + "+" + coeff(true, Math.sqrt(-crd) / xra / 2, "i))(x-(", fracval[frac]) + coeff(true, crh, "", fracval[frac]) + "-" + coeff(true, Math.sqrt(-crd) / xra / 2, "i))\n", fracval[frac])
                    }
                }
                // "two complex roots: "+coeff(true,crh,"", fracval[frac])+plusminus+coeff(true,Math.sqrt(-crd)/xra/2,"i\n", fracval[frac]) }}
                if (document.theForm.values.checked) {
                    crxa = Math.min(crx1, crx2)
                    if (crd >= 0) crxa = Math.min(crxa, (crh - Math.sqrt(crd) / xra / 2), (crh + Math.sqrt(crd) / xra / 2))
                    crxd = (crh - crxa) / 4;
                    document.theForm.output.value += "values: ";
                    paradata += ';\n'
                    pryint = true;
                    crxd = crxd / 2;
                    crxa = crxa - 2 * crxd
                    for (i = 0; i < 13; i++) {
                        crxx = crxa + i * crxd
                        if (pryint && (crxx > 0)) pair(0, xrc)
                        paradata += "(" + my(crxx, 2) + ',' + my(crxx * crxx * xra + crxx * xrb + xrc, 2) + ',-5); '
                        pair(crxx, crxx * crxx * xra + crxx * xrb + xrc)
                        if (crxx >= 0) pryint = false
                    }
                    if (pryint) pair(0, xrc)
                    document.theForm.output.value += "\n"
                }
                document.theForm.output.value += "\n"
                return
            }
            // it's not a parabola
            xrc1 = xrb * xrb / xra / 4;
            yrc1 = yrb * yrb / yra / 4
            exdata1 = clean(coeff(true, xra, xvar + P2, fracval[frac]) + coeff(false, xrb, xvar, fracval[frac]) + coeff(false, xrc1, "", fracval[frac]) + coeff(false, yra, yvar + P2, false) + coeff(false, yrb, yvar, fracval[frac]) + coeff(false, yrc1, "", fracval[frac]) + coeff(false, (xrc), "", fracval[frac]) + coeff(false, (-xrc1), "", fracval[frac]) + coeff(false, (-yrc1), "", fracval[frac]))
            // document.theForm.output.value += exdata1+" = 0\n"
            xrc = xrc1 + yrc1 - xrc;
            xras = 1;
            yras = 1
            if (xra < 0) {
                xra *= -1;
                xras = -1
            }
            if (yra < 0) {
                yra *= -1;
                yras = -1
            }
            if (xrc < 0) {
                xras *= -1;
                yras *= -1;
                xrc *= -1
            }
            elia = Math.sqrt(xrc / xra);
            elib = Math.sqrt(xrc / yra)
            document.theForm.output.value += coeff(true, xras * xra, "(", fracval[frac]) + xvar + coeff(false, xrb / xra / 2, "", fracval[frac]) + ")" + P2
            document.theForm.output.value += coeff(false, yras * yra, "(", fracval[frac]) + yvar + coeff(false, yrb / yra / 2, "", fracval[frac]) + ")" + P2
            document.theForm.output.value += " = " + (xrc) + " or "
            document.theForm.output.value += coeff(true, xras, "((", fracval[frac]) + xvar + coeff(false, xrb / xra / 2, "", fracval[frac]) + ")/(" + coeff(true, Math.sqrt(xrc / xra), "", fracval[frac]) + "))" + P2
            document.theForm.output.value += coeff(false, yras, "((", fracval[frac]) + yvar + coeff(false, yrb / yra / 2, "", fracval[frac]) + ")/(" + coeff(true, Math.sqrt(xrc / yra), "", fracval[frac]) + "))" + P2
            document.theForm.output.value += " = 1\n"

            if (xra * xras == yra * yras) // circle
            {
                document.theForm.output.value += "Circle, radius: " + coeff(true, Math.sqrt(xrc / xra), "; ", fracval[frac])
            } else if (xras * yras < 0) // hyperbola
            {
                document.theForm.output.value += "Hyperbola, "
                elif = Math.sqrt(Math.abs(elia * elia + elib * elib));
                elie = elif / elia
                document.theForm.output.value += " Foci: (" + (myround(-xrb / xra / 2)) + " " + plusminus + myround(elif) + ", " + (myround(-yrb / yra / 2)) + "); "
                document.theForm.output.value += " Ecentricity: " + myround(elie) + "; \n"
                document.theForm.output.value += " Asymptote: " + line(-xrb / xra / 2, -yrb / yra / 2, sqrt(xra / yra)) + "; "
                hyvertex = "Vertices: ("
                if (yras < 0) hyvertex += (myround(-xrb / xra / 2)) + " " + plusminus + myround(elia) + ", " + (myround(-yrb / yra / 2))
                else hyvertex += (myround(-xrb / xra / 2)) + ", " + (myround(-yrb / yra / 2)) + " " + plusminus + myround(elib)
                document.theForm.output.value += hyvertex + "); "

            } else // ellipse
            {
                elif = Math.sqrt(Math.abs(elia * elia - elib * elib));
                elie = elif / elia
                if (elia < elib) {
                    document.theForm.output.value += "Ellipse, minor axis: " + coeff(true, 2 * Math.sqrt(xrc / xra), "", fracval[frac]) + ", major axis: " + coeff(true, 2 * Math.sqrt(xrc / yra), "", fracval[frac]) + "\n"
                } else {
                    document.theForm.output.value += "Ellipse, major axis: " + coeff(true, 2 * Math.sqrt(xrc / xra), "", fracval[frac]) + ", minor axis: " + coeff(true, 2 * Math.sqrt(xrc / yra), "", fracval[frac]) + "\n"
                }
                document.theForm.output.value += " Foci: (" + (myround(-xrb / xra / 2)) + " " + plusminus + myround(elif) + ", " + (myround(-yrb / yra / 2)) + "); "
                document.theForm.output.value += " Vertices: (" + (myround(-xrb / xra / 2)) + " " + plusminus + myround(elia) + ", " + (myround(-yrb / yra / 2))
                document.theForm.output.value += ") and (" + (myround(-xrb / xra / 2)) + ", " + (myround(-yrb / yra / 2)) + " " + plusminus + myround(elib) + ");"
                document.theForm.output.value += " Ecentricity: " + myround(elie) + "\n"
            }
            document.theForm.output.value += " Center: (" + (myround(-xrb / xra / 2)) + ", " + (myround(-yrb / yra / 2)) + ")\n\n"
        }
        // ---------------------------------------------------
        function calc() {
            paradata = "";
            var exall = document.theForm.input.value.replace(/^\n*/, '');
            var exall = exall.replace(/\[/gi, "(").replace(/\]/gi, ")")
            if (exall.length == 0) {
                exall = document.theForm.output.value;
                document.theForm.input.value = exall
            }
            document.theForm.output.value = ""
            while (exall.length) {
                var exline = exall.search(/\n/);
                if (exline < 0) exline = exall.length
                var ex1 = exall.slice(0, exline).replace(/^ */, "");
                exall = exall.slice(exline + 1)
                if (ex1.length == 0) continue
                if (ex1.search(/,/) > -1) {
                    build(ex1)
                } else {
                    exline = ex1.search(/:/);
                    expno = ex1.slice(0, exline + 1);
                    ex1 = ex1.slice(exline + 1).replace(/^ */, "")
                    if (ex1.search(/^ *(\d+|\w)(\)|\. )/) == 0) {
                        expno += ex1.match(/^ *(\d+|\w)(\)|\. )/)[0] + " ";
                        ex1 = ex1.replace(/^ *(\d+|\w)(\)|\. )/, "")
                    }
                    ex1 = ex1.replace(/ *([a-z]) */ig, "$1")
                    while (ex1.search(/ [a-z.,]+ /ig) > -1) ex1 = ex1.replace(/ [a-z.,]+ /ig, " ")
                    ex1 = ex1.replace(/ */g, "")
                    if (ex1.length > 0) calc1(expno, ex1)
                }
            }
        }
        // ---------------------------------------------------
        function build(ex) {
            // input points, focus, directrix
            function getdata(gv) {
                while (true) {
                    if (gv == undefined) gv = "   "
                    if (isNaN(gv)) {
                        gv = clean(gv)
                        if (isNaN(gv)) {
                            try {
                                gv = "" + eval(cleanx(gv))
                            } catch (err) {}
                        }
                    }
                    gv = gv.replace(/ +/, "");
                    var gd1 = isNaN(gv),
                        gd2 = gv.length == 0;
                    if (gd1 || gd2) {
                        if (dx.length == 0) {
                            document.theForm.output.value += "*** did not find value >>>  ";
                            return ""
                        } else gv = dx.shift()
                    } else {
                        return Number(gv)
                    }
                }
            }
            xvar = "X"
            while (ex.length) {
                var fx1 = undefined,
                    fy1 = undefined,
                    dy1 = undefined,
                    vx1 = undefined,
                    vy1 = undefined
                var exline = ex.search(/\n/);
                if (exline < 0) exline = ex.length
                var ex1 = ex.slice(0, exline);
                ex = ex.slice(exline + 1);
                expno = ""
                if (ex1.search(/^ *(\d+|\w)(\)|. )/) == 0) {
                    expno = ex1.match(/^ *(\d+|\w)(\)|. )/)[0] + " ";
                    ex1 = ex1.replace(/^ *(\d+|\w)(\)|. )/, "")
                }
                ex1 = ex1.replace(/dire[a-z ]*/ig, "dire:")
                var d = [
                    [],
                    [],
                    [],
                    [],
                    []
                ];
                var di = 1;
                var dx = ex1.split(/[,():=]/)
                while (di < 4) {
                    if (vy1 != undefined && dy1 != undefined) { // document.theForm.output.value+="from vertex  " +vx1+","+vy1+","+dy1 +"<<<   "
                        fx1 = vx1;
                        fy1 = 2 * vy1 - dy1;
                        vx1 = undefined;
                        vy1 = undefined
                        // document.theForm.output.value+="to focus  " +fx1+","+fy1+ "\n"
                    }
                    if (fy1 != undefined && dy1 != undefined) { // document.theForm.output.value+="from focus  " +fx1+","+fy1+","+dy1 +"<<<\n"
                        var x1 = fx1;
                        var y1 = (fy1 + dy1) / 2;
                        di = 1
                        d[di][1] = x1 * x1;
                        d[di][2] = x1;
                        d[di][3] = 1;
                        d[di][4] = y1;
                        di++
                        d[di][1] = 2 * x1;
                        d[di][2] = 1;
                        d[di][3] = 0;
                        d[di][4] = 0;
                        di++;
                        x1 += (fy1 - dy1);
                        y1 = fy1
                        d[di][1] = x1 * x1;
                        d[di][2] = x1;
                        d[di][3] = 1;
                        d[di][4] = y1;
                        di++;
                        break
                    }
                    if (fy1 != undefined && vy1 != undefined) {
                        var x1 = fx1 + 2 * (fy1 - vy1);
                        var y1 = fy1;
                        d[di][1] = x1 * x1;
                        d[di][2] = x1;
                        d[di][3] = 1;
                        d[di][4] = y1;
                        di++;
                        break
                    }
                    if (dx.length == 0) break
                    var dxd = dx.shift()
                    if (dxd.search(/vert/i) > -1) {
                        var vx1 = getdata();
                        var vy1 = getdata()
                        d[di][1] = vx1 * vx1;
                        d[di][2] = vx1;
                        d[di][3] = 1;
                        d[di][4] = vy1;
                        di++
                        d[di][1] = 2 * vx1;
                        d[di][2] = 1;
                        d[di][3] = 0;
                        d[di][4] = 0;
                        di++;
                        continue
                    }
                    if (dxd.search(/focu/i) > -1) {
                        fx1 = getdata();
                        fy1 = getdata();
                        continue
                    }
                    if (dxd.search(/dire/i) > -1) {
                        dy1 = getdata();
                        continue
                    }
                    var x1 = getdata(dxd);
                    if (dx.length == 0) break
                    var y1 = getdata()
                    d[di][1] = x1 * x1;
                    d[di][2] = x1;
                    d[di][3] = 1;
                    d[di][4] = y1;
                    di++
                }
                if (di < 4) {
                    if (ex1.length > 0) document.theForm.output.value += ex1 + " << skipped\n"
                    continue
                }
                // for(i=1;i<4;i++){for(j=1;j<5;j++){document.theForm.output.value += d[i][j]+", "}document.theForm.output.value+="\n"}
                var d0 = d[1][1] * (d[2][2] * d[3][3] - d[2][3] * d[3][2]) - d[2][1] * (d[1][2] * d[3][3] - d[1][3] * d[3][2]) + d[3][1] * (d[1][2] * d[2][3] - d[1][3] * d[2][2])
                var xra = (d[1][4] * (d[2][2] * d[3][3] - d[2][3] * d[3][2]) - d[2][4] * (d[1][2] * d[3][3] - d[1][3] * d[3][2]) + d[3][4] * (d[1][2] * d[2][3] - d[1][3] * d[2][2])) / d0
                var xrb = (d[1][1] * (d[2][4] * d[3][3] - d[2][3] * d[3][4]) - d[2][1] * (d[1][4] * d[3][3] - d[1][3] * d[3][4]) + d[3][1] * (d[1][4] * d[2][3] - d[1][3] * d[2][4])) / d0
                var xrc = (d[1][1] * (d[2][2] * d[3][4] - d[2][4] * d[3][2]) - d[2][1] * (d[1][2] * d[3][4] - d[1][4] * d[3][2]) + d[3][1] * (d[1][2] * d[2][4] - d[1][4] * d[2][2])) / d0
                var ex2
                ex2 = coeff(true, xra, xvar + "^2", 99) + coeff(false, xrb, xvar, 99) + coeff(false, xrc, "", 99)
                // ex2 = xra+xvar+"^2"+(xrb>=0?"+":"")+xrb+xvar+(xrc>=0?"+":"")+xrc
                ex2 = ex2.replace(/ */g, "")
                // document.theForm.output.value += " from build  ex2 ="+ex2 +"\n"
                calc1(expno, ex2)
            }
        }
        // ---------------------------------------------------
        function conv() {
            var coni = 0;
            ex = document.theForm.input.value;
            confr = document.theForm.convfr.value.replace(/ */g, "");
            conto = document.theForm.convto.value;
            if (confr.length)
                while (coni < ex.length) {
                    if (ex.substr(coni, confr.length) == confr) ex = ex.slice(0, coni) + conto + ex.slice(coni + confr.length);
                    coni += 1
                }
            document.theForm.input.value = ex
            calc()
        }
        // ---------------------------------------------------
        function Graph() {
            document.theForm.latus.checked = true
            calc()
            val1 = escape(paradata.replace(/\n/g, "<nl>").replace(/[;&]/g, "<sc>"))
            localStorage.setItem("graphdata", val1)
            window.open("graphs.php")
        }
    </script>
    <!--
DECLARE FUNCTION gk# (h#)
DECLARE FUNCTION cayley# (x#)
DEFDBL A-Z
CONST pi = 3.141592653589793#
rem Perimeter of an Ellipse in QBASIC © 2002, Gérard P. Michon
INPUT "a,b="; a, b
a=ABS(a): b=ABS(b)
IF a < b THEN x=a: a=b: b=x
IF b < 0.28*a THEN
 P = 4*a*cayley((b/a)^2)
ELSE
 h = ((a-b)/(a+b))^2
 P = pi*(a+b)*gk(h)
ENDIF
PRINT "Ellipse Perimeter ="; P
END

DEFDBL A-Z
FUNCTION gk (h)
z = 0: x = 1: n = 0
REM Add 1 (to z) afterwards...
 WHILE z + x <> z
 n = n + 1
 x = h * x * ((n-1.5)/n)^2
 z = z + x
 WEND
gk = 1 + z
END FUNCTION
 	
DEFDBL A-Z
FUNCTION cayley (x)
y = LOG(16# / x) - 1
t = x / 4
n = 1
z = 0: REM Add 1 afterwards.
u = t * y
v = (n - .5) / n
w = .5 / ((n - .5) * n)
 WHILE z <> z + u
 z = z + u
 n = n + 1
 t = x * t * v
 v = (n - .5) / n
 t = t * v
 y = y - w
 w = .5 / ((n - .5) * n)
 y = y - w
 u = t * y
 WEND
cayley = 1 + z
END FUNCTION
REM Multiplications minimized
 -->
    <div id="calctainer">
        <a href="index.php"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <h1>Parabolas and Other Second Degree Equations</h1>
        <form name="theForm">
            <div id="inputDiv">
                <textarea name="input" rows=3 cols=99 tabindex="1" onKeyUp="enter(event)"></textarea>
                <div id="clearSave">
                    <input name="clerebut" Value="Clear" type="button" onClick="clere()" />
                    <input name="savebut" Value="Save" type="button" onClick="savestuff()" />
                    <input name="loadbut" Value="Load" type="button" onClick="loadstuff();calc()" />
                    <input name="graphbut" Value="Graph" type="button" onClick="Graph()" />

                    <input type="button" value="8 place" id="frac" onClick="swfrac(true,4)" />


                    <input type="button" value="X↔Y" onclick="switchxy()" />
                </div>
            </div>
            <div id="digitsGroup">
                <input type="button" value="1" onClick="putx('1')" class="digit">
                <input type="button" value="2" onClick="putx('2')" class="digit">
                <input type="button" value="3" onClick="putx('3')" class="digit">
                <input type="button" value="+" onClick="putx('+')">
                <input type="button" value="4" onClick="putx('4')" class="digit">
                <input type="button" value="5" onClick="putx('5')" class="digit">
                <input type="button" value="6" onClick="putx('6')" class="digit">
                <input type="button" value="-" onClick="putx('-')" />
                <input type="button" value="7" onClick="putx('7')" class="digit">
                <input type="button" value="8" onClick="putx('8')" class="digit">
                <input type="button" value="9" onClick="putx('9')" class="digit">
                <input type="button" value="*" onClick="putx('*')" />
                <input type="button" value=" ." onClick="putx('.')" />
                <input type="button" value="0" onClick="putx('0')" class="digit">
                <input type="button" value="," onClick="putx(',')" />
                <input type="button" value="/" onClick="putx('/')" />
            </div>

            <div id="buttonGroup1">
                <input type="button" value="x²" onClick="putx('x²')" />
                <input type="button" value="x" onClick="putx('x')" />
                <input type="button" value="(" onClick="putx('(')" />
                <input type="button" value=")" onClick="putx(')')" />
                <input type="button" value="^" onClick="putx('^')" />
            </div>




            <div id="parabolaOptions">
                <input name="stand" id="stand" type="checkbox" /><label for="stand">Standard Form</label><!-- standard form -->
                <input name="vertex" id="vertex" type="checkbox" /><label for="vertex">Vertex Max/Min</label><!-- vertex maximum/minimum -->
                <input name="focus" id="focus" type="checkbox" /><label for="focus">Focus Directrix</label><!-- focus directrix -->
                <input name="latus" id="latus" type="checkbox" /><label for="latus">Latus Rectum</label><!-- latus rectum -->



                <input name="quad" id="quad" type="checkbox" /><label for="quad">Quadratic</label><!-- quadratic formula & discriminant-->
                <input name="discr" id="discr" type="checkbox" /><label for="discr">Discr</label><!--  number of roots -->
                <input name="factors" id="factors" type="checkbox" /><label for="factors">Factors</label><!-- factors -->
                <input name="values" id="values" type="checkbox" /><label for="values">Values</label><!-- values -->

            </div>

            <input name="calcbut" Value="Solve/build" type="button" class="calcButton" onClick="calc()" />

            <div id="parabolaConvert">
                <input name="convbut" tabindex="2" Value="Convert" type="button" onClick="conv()" /> From: <textarea name="convfr" rows=1 tabindex="0" onKeyUp="enter(event)"></textarea> --> <textarea name="convto" rows=1 tabindex="0" onKeyUp="enter(event)"></textarea>
            </div>
            <div id="outputDiv">
                <textarea name="output" rows=18 cols=99>
input can be a polynomial:
  General form: x^2-4*X-5
  Standard form: (x -2)² -9
  factored: (x+1)(x-5)
  coefficients: 1;-4;-5
or an equation:
  parabola transformational form: (Y +9) = (x -2)²
  circle: x^2 +y^2 = 9
  ellipse: 9x2 +16y2 = 144
  hyperbola: 9x2 -16y2 = 144
or for parabolas:
  Focus: (2, -8.75); Directrix: y = -9.25
  Vertex (minimum): (2, -9) point (-1, 0)
  Vertex (minimum): (2, -9) Focus: (2, -8.75);
  Points: (-1, 0), (2, -9), (5, 0)
</textarea>
            </div>
        </form>
    </div>
    <script>
        ls = decodeURIComponent(location.search)
        if (ls.search(/\?/) == 0) {
            lsf = ls.slice(1).split("&")
            document.theForm.input.value = lsf[0] + "\n"
            calc()
        }
    </script>
</body>

</html>