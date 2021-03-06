<!DOCTYPE html>
<html lang="en">

<head>
    <title>Newton's method</title>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <script type="text/javascript" src="myfunctions.js"></script>
    <script>
        degrees = false
        var x, y1, x2, y2, xm, ym
        var factors = ""
        var highco = 1
        var x3 = 0
        var dnf = true
        var approx = String.fromCharCode(8776)
        stack = [""]
        // ---------------------------------------------------
        function popstack() {
            if (stack.length > 1) {
                document.theForm.Function.value = stack.pop()
            } else if (stack.length == 1) {
                document.theForm.Function.value = stack[0]
            } else {
                cla()
            }
        }
        // -------------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) calc1();
            if (charCode == 27) popstack();
        };
        // -------------------------------------------------------
        function next() {
            stack.push(f1 = document.theForm.Function.value)
            document.theForm.Derivative.value = ''
            if ((f1e = f1.search(/\n/)) >= 0) {
                document.theForm.Function.value = f1.slice(f1e + 1);
                calc1()
            } else {
                document.theForm.Function.value = ''
            }
        }
        // -------------------------------------------------------
        function cla() {
            document.theForm.degrees[0].checked = false
            document.theForm.x1.value = ""
            document.theForm.x2.value = ""
            document.theForm.x3.value = '64'
            document.theForm.Derivative.value = ""
            document.theForm.Function.value = ""
            document.theForm.output.value = ''
            factors = ""
            highco = 1
            //document.theForm.Function.focus()
        }
        // -------------------------------------------------------
        function f(xx) {
            with(Math) {
                X = xx;
                return (eval(ff))
            }
        };
        // -------------------------------------------------------
        function d(xx) {
            with(Math) {
                X = xx;
                return (eval(fd))
            }
        };
        // -------------------------------------------------------
        function strfxy(x, y) {
            return "f(" + xr1 + ")= " + myround(y)
        }
        // -------------------------------------------------------
        function strxy(x, y) {
            return "(" + myround(x) + "," + myround(y) + ")"
        }
        // -------------------------------------------------------
        function loadthem() {
            document.theForm.reduce.checked = false;
            loadstuff();
            inputsemi = document.theForm.Function.value.search(";'");
            if (inputsemi >= 0) {
                document.theForm.Derivative.value = document.theForm.Function.value.slice(inputsemi + 2);
                document.theForm.Function.value = document.theForm.Function.value.slice(0, inputsemi)
            }
            calc1();
            document.theForm.Function.focus()
        }

        // -------------------------------------------------------
        function graphit() {
            x1g = Number(document.theForm.x1.value);
            x2g = Number(document.theForm.x2.value)
            if ((x1g < xm) && (xm < x2g)) {
                xmo = Math.min(xm - x1g, x2g - xm);
                xmo = Math.max(xmo, (x2g - x1g) / 2)
                x1g = xm - xmo;
                x2g = xm + xmo
            }
            xmo = (x2g - x1g) / 20;
            x1g -= xmo;
            x2g += xmo
            y1g = 0;
            y2g = 0;
            for (x = x1g; x <= x2g; x += xmo) {
                y1g = Math.min(y1g, f(x));
                y2g = Math.max(y2g, f(x))
            }
            val1 = "x:" + x1g + " to " + x2g + ";y:" + y1g + " to " + y2g + ";" + graphdata;
            val1 = escape(val1.replace(/\n/g, "<br>").replace(/;/g, "<sc>"))
            localStorage.setItem("graphdata", val1)
            window.open('graphs.php')
            return
        }
        // -------------------------------------------------------
        function narrow() {
            document.theForm.output.value += strfxy(x, y1) + " : "
            if (xm != x) document.theForm.output.value += strfxy(xm, ym) + " : "
            document.theForm.output.value += strfxy(x2, y2) + "\n"
            if (document.theForm.graph.checked) {
                if (!document.theForm.Method[0].checked) graphdata += strxy(x, y1) + strxy(x2, y2) + ';'
                graphdata += strxy(x, y1) + strxy(x, 0) + ';' + strxy(x2, 0) + strxy(x2, y2) + "\n"
            }
        }
        // -------------------------------------------------------
        function bisect() {
            with(Math) {
                nstep = 0;
                xx3 = x3 - 1
                y1 = f(x);
                if (y1 == 0) x2 = x
                y2 = f(x2);
                if (y2 == 0) {
                    x = x2;
                    y1 = 0
                }
                xm = x;
                ym = y1
                narrow();
                if (y1 * y2 > 0) {
                    dnf = true;
                    document.theForm.output.value += "No sign change.\n";
                    return
                }
                do {
                    nstep++
                    if (ym * y1 > 0) {
                        x = xm;
                        y1 = ym;
                    } else {
                        x2 = xm;
                        y2 = ym;
                    }
                    xm = (x + x2) / 2;
                    ym = f(xm)
                    if (document.theForm.steps.checked)
                        if (myround(x) != myround(x2)) narrow()
                } while (xx3-- > 0 && (x < xm) && (xm < x2) && (ym != 0))
                dnf = xx3 < 1;
                if (dnf) document.theForm.output.value += "Iterations exceeded: "
                document.theForm.output.value += "x= " + xm + (document.theForm.steps.checked ? "; " + nstep + " steps" : '')
                document.theForm.output.value += " using the bisection method\n--------\n"
            }
        }
        // -------------------------------------------------------
        function falsep(modified) {
            with(Math) {
                nstep = 0;
                xx3 = x3 - 1
                y1 = f(x);
                if (y1 == 0) x2 = x
                y2 = f(x2);
                if (y2 == 0) {
                    x = x2;
                    y1 = 0
                }
                xm = x;
                ym = y1;
                dida = 0
                narrow();
                if (y1 * y2 > 0) {
                    dnf = true;
                    document.theForm.output.value += "No sign change.\n";
                    return
                }
                do {
                    nstep++
                    if (ym * y1 > 0) {
                        x = xm;
                        dida--;
                    } else {
                        x2 = xm;
                        dida++;
                    }
                    if (modified) {
                        if (dida < -2) {
                            if (f((x2 + xm) / 2) * f(x2) > 0) {
                                dida = 0;
                                x2 = (x2 + xm) / 2
                            } else x = (x2 + xm) / 2
                        } else if (dida > 2) {
                            if (f((x + xm) / 2) * f(x) > 0) {
                                dida = 0;
                                x = (x + xm) / 2
                            } else x2 = (x + xm) / 2
                        }
                    }
                    y1 = f(x);
                    y2 = f(x2);
                    mm = (y1 - y2) / (x - x2);
                    bb = y1 - mm * x;
                    xm = -bb / mm;
                    ym = f(xm)
                    if (document.theForm.steps.checked)
                        if (myround(x) != myround(x2)) narrow()
                } while (xx3-- > 0 && (x < xm) && (xm < x2) && (ym != 0))
                dnf = xx3 < 1;
                if (dnf) document.theForm.output.value += "Iterations exceeded: "
                document.theForm.output.value += "x= " + xm + (document.theForm.steps.checked ? "; " + nstep + " steps" : '')
                document.theForm.output.value += " using the " + (modified ? "modified " : "") + "false position method\n--------\n"
            }
        }
        // -------------------------------------------------------
        function newcant(donewton) {
            with(Math) {
                nstep = 0;
                xx3 = x3;
                xm = undefined;
                xind = 1;
                toprint = true;
                h = 0.001;
                d1 = 0;
                d2 = 0
                fd = (donewton ? cleanx(f2) : "(-f(x+2*h)+8*f(x+h)-8*f(x-h)+f(x-2*h))/(12*h)")
                if (document.theForm.steps.checked) document.theForm.output.value += "f'(x)=" + fd + "\nxn= x - f(x)/f'(x)\n"
                while (xx3-- > 0) {
                    nstep++;
                    xr1 = myround(x);
                    y1 = f(x);
                    yr1 = myround(y1);
                    dx = d(x);
                    dr1 = myround(dx);
                    xm = x - y1 / dx
                    if (document.theForm.steps.checked && toprint) {
                        document.theForm.output.value += "x" + (xind++) + "= " + xr1 + ";  f(" + xr1 + ")=" + yr1 + ";  f'(" + xr1 + ")= " + dr1 + '\n'
                    }
                    graphdata += "(" + x + "," + y1 + ",-5)(" + xm + ",0,-5)"
                    d2 = d1;
                    d1 = xm - x;
                    if ((d1 * d2 < 0) && (nstep > 9)) break;
                    if (xm == x) break;
                    x = xm;
                    toprint = xr1 != myround(xm)
                }
                graphdata += ";\n"
                if (xx3 < 1) document.theForm.output.value += "Iterations exceeded, "
                document.theForm.output.value += "x= " + x + " in " + nstep + " steps using " + (donewton ? "Newton's" : "the modified secant") + " method\n--------\n"
            }
        }
        // -------------------------------------------------------
        function calc1() {
            with(Math) {
                /* variables:
                f1= document.theForm.Function.value: ff= expression part of f1, followed by starting values in fv, evaluated by f(x)
                f2= document.theForm.Derivative.value, evaluated by d(x): fd= f2 or simpson
                [x1, x2] interval for root. f(x1)*f(x2) < =0
                x is value of root, starts with fv[0]
                xm is next value to replace x, x1 or x2
                x3 is the maximum number of steps (safety valve)

                */
                degrees = document.theForm.degrees[0].checked
                graphdata = '';
                x1 = eval(document.theForm.x1.value);
                if (x1 == undefined) {
                    x1 = 0;
                    document.theForm.x1.value = x1
                }
                x2 = eval(document.theForm.x2.value);
                if (x2 == undefined) {
                    x2 = x1 + 10;
                    document.theForm.x2.value = x2
                }
                x3 = eval(document.theForm.x3.value);
                if (x3 == undefined) {
                    x3 = 64;
                    document.theForm.x3.value = '64'
                }
                f1 = document.theForm.Function.value.replace(/\s+\n/g, "\n").replace(/^\s+/g, "").replace(/\s$/g, "")
                f2 = document.theForm.Derivative.value.replace(/\n/g, "")
                if (f1.length == 0) {
                    if (wi >= wff.length) wi = 0
                    ff = wff[wi];
                    fv = wfv[wi];
                    f2 = wf2[wi];
                    x1 = wx1[wi];
                    x2 = wx2[wi];
                    wi++;
                    f1 = ff + ";" + fv
                    document.theForm.Method[0].checked = true;
                    document.theForm.Method[0].checked = false
                }
                if (document.theForm.Method[0].checked || document.theForm.Method[1].checked || document.theForm.Method[2].checked || document.theForm.Method[3].checked || document.theForm.Method[4].checked) {} else {
                    if (f2 != "") document.theForm.Method[3].checked = true;
                    else document.theForm.Method[4].checked = true;
                }
                stack.push(f1);
                document.theForm.Function.value = f1;
                document.theForm.Derivative.value = f2
                document.theForm.x1.value = x1;
                document.theForm.x2.value = x2;
                document.theForm.x3.value = x3
                if ((xvarlist = f1.search(/[;]/)) > -1) {
                    ff = f1.slice(0, xvarlist);
                    fv = f1.slice(xvarlist)
                }
                x = eval(document.theForm.x1.value);
                if (x == undefined) {
                    x = 0;
                    document.theForm.x1.value = '0'
                }
                if ((xvar = f1.search(/=/)) > -1) {
                    ff = f1.slice(0, xvar) + "-(" + f1.slice(xvar + 1) + ")";
                }
                f1 = ff + fv;
                document.theForm.Function.value = f1;
                graphdata = ff + ";\n";
                document.theForm.output.value += "f(x)=" + ff + "\n"
                // if (document.theForm.reduce.checked)
                // { f1= fx2xx(parse(clean(f1))); document.theForm.Function.value= f1}
                // else { if (f1e=f1.search(/\n/)>=0) f1=f1.slice(0,f1e) }
                // else {
                // document.theForm.output.value += "f(x)="+fx2xx(parse(clean(f1)))+"= 0\n"}
                //   document.theForm.output.value += "f(x)="+ff+"\n" }
                if (f2 == "")
                    if (document.theForm.Method[3].checked) {
                        ispoly = true;
                        f1p = parse(clean(f1));
                        for (i = 0; i < f1p.length; i++) {
                            if (f1p[i].length > 3) ispoly = false
                            else {
                                f1p[i][0] *= f1p[i][1];
                                f1p[i][1] -= 1
                            }
                        }
                        if (ispoly) {
                            f2 = fx2xx(f1p);
                            document.theForm.Derivative.value = f2
                        } else document.theForm.Method[4].checked = true
                    }
                if (document.theForm.Method[3].checked)
                    if (f2 != "") {
                        document.theForm.Derivative.value = f2
                        fd = cleanx(f2)
                    }
                ff = cleanx(ff)
                fv = fv.split(/\n/)[0]
                // document.theForm.output.value +=  "\n"
                if (document.theForm.graph.checked && !document.theForm.steps.checked) {
                    if (x == x2) {
                        xg1 = x - 5;
                        xg2 = x + 9;
                        d1 = 1
                    } else {
                        xg1 = x;
                        xg2 = x2;
                        d1 = (x2 - x) / 10
                    };
                    xg1 = myround(xg1);
                    for (xm = xg1; xm <= xg2 + d1 / 2; xm += d1) {
                        document.theForm.output.value += "f(" + myround(xm) + ")=" + myround(f(xm)) + "\n";
                    }
                }
                if (document.theForm.Method[0].checked) bisect()
                if (document.theForm.Method[1].checked) falsep(false)
                if (document.theForm.Method[2].checked) falsep(true)
                if (fv.length == 0) fv = "" + x
                while (fv.length > 0) {
                    xvar = fv.search(/[;,]/);
                    if (xvar == -1) xvar = fv.length
                    dox = eval(fv.slice(0, xvar));
                    fv = fv.slice(xvar + 1)
                    if (xvar == 0) continue
                    x = dox;
                    if (document.theForm.Method[3].checked) newcant(true)
                    if (document.theForm.Method[4].checked) newcant(false)
                }
                return // hmmm?

                // if (document.theForm.graph.checked)
                /* { x1g=Number(document.theForm.x1.value); x2g=Number(document.theForm.x2.value)
                  xmo=(x2g-x1g)/20; x1g-=xmo; x2g+=xmo
                  y1g=0; y2g=0; for(x=x1g;x<=x2g;x+=xmo) {y1g=Math.min(y1g,f(x)); y2g=Math.max(y2g,f(x))}
                  val1="x:" +x1g +" to " +x2g +";y:"  +y1g +" to " +y2g +";"  +graphdata;  // .slice(0,graphdata.search(/;/))
                  val1=escape(val1.replace(/\n/g,"<br>").replace(/;/g,"<sc>"))
                  localStorage.setItem("graphdata",val1)} */
                // document.theForm.output.value += "\n";
                /* if (document.theForm.reduce.checked){
                if (dnf) { if (factors.length>0) document.theForm.output.value += "Factors: "+factors+"("+document.theForm.Function.value+")\n"}
                else {*/
                var xx = [];
                /*ff= f1; if (ff.search(/[+-]/)!=0) {ff="+"+ff}
                ff= ff.replace(/([+\-])([(x])/g,"$11*$2")+";" */
                while (ff.length > 1) {
                    ffl1 = ff.length;
                    ff1 = ff.search(/[0-9+-.(]/);
                    if (ff1 == 0) // MUST be!
                    {
                        ff1 = ff.slice(1).search(/[^0-9.]/) + 1;
                        ffv1 = Number(ff.slice(0, ff1));
                        ff = ff.slice(ff1);
                    } else {
                        ffv1 = 1
                    }
                    if (ff.slice(0, 8) == "*(pow(x,") {
                        ff = ff.slice(8);
                        ff1 = ff.search(/[^0-9+-.]/);
                        ffv2 = Number(ff.slice(0, ff1));
                        ff = ff.slice(ff1 + 2);
                    } else if (ff.slice(0, 2) == "*x") {
                        ffv2 = 1;
                        ff = ff.slice(2)
                    } else {
                        ffv2 = 0;
                    }
                    if (xx[ffv2] == undefined) {
                        xx[ffv2] = ffv1
                    } else {
                        xx[ffv2] += ffv1
                    }
                    // break in case of error or non power of x  ?
                    if (ffl1 == ff.length) {
                        document.theForm.output.value += ff + "\n";
                        break
                    }
                }
                if (ff.length < 2) {
                    for (var i = xx.length - 1; i >= 0; i--)
                        if (xx[i] == undefined) xx[i] = 0
                    if (Math.abs(xx[xx.length - 1]) > 1) highco = xx[xx.length - 1]
                    else if (xx[xx.length - 1] < 0) highco = -1
                    else highco = 1
                    for (var i = 0; i < xx.length; i++) xx[i] /= highco
                    xmf = "" + myround(xm, true);
                    xmfd = 1
                    if (xmf.search(/\//) > 0) xmfd = eval(xmf.slice(xmf.search(/\//) + 1))
                    term1 = true;
                    document.theForm.output.value += "("
                    for (var i = xx.length; i; i) {
                        i--;
                        if (xx[i] == undefined) xx[i] = 0
                        document.theForm.output.value += xterm(term1, highco * xx[i], i);
                        term1 = false
                    }
                    highco /= xmfd
                    thisfact = "(" + xterm(true, xmfd, 1) + xterm(false, myround(-xm * xmfd), 0) + ")"
                    document.theForm.output.value += ")/" + thisfact + "= "
                    factors = factors + thisfact
                    for (var i = xx.length - 2; i >= 0; i--) xx[i] += xm * xx[i + 1]
                    xmr = xx.shift();
                    ffnew1 = "";
                    ffnew2 = "";
                    term1 = true
                    for (var i = xx.length; i;) {
                        i--;
                        ffnew1 += xterm(term1, highco * xx[i], i, true);
                        ffnew2 += xterm(term1, highco * xx[i], i, 99);
                        term1 = false
                    }
                    if (xx.length == 1) {
                        if (highco == -1) {
                            factors = "-" + factors
                        } else if (highco != 1) {
                            factors = highco + factors
                        }
                    }
                    document.theForm.output.value += ffnew1 + "\n" // +" remainder:"+myround(xmr)
                    document.theForm.output.value += "Factors: " + factors + "\n"
                    document.theForm.Function.value = ffnew2;
                    document.theForm.Derivative.value = ""
                }
                document.theForm.Function.focus();
            }
        };
    </script>
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">

            <h1>Find zeroes of a function</h1>
            <label onClick="document.theForm.Function.value=''">f(x)</label><input type="text" name="Function" rows=1 cols=80 tabindex="1" onKeyUp="enter(event)"><br>
            <label onClick="document.theForm.Derivative.value=''">f'(x)</label><input type="text" "Derivative" rows=1 cols=80 tabindex="2">

            <label>Interval Left</label><input type="text" name="x1" size=10 value="" tabindex="3" /><br>
            <label>Right</label><input type="text" name="x2" size=10 value="" tabindex="4" /><br>
            <label>Iterations</label><input type="text" name="x3" size=4 value="" tabindex="5" /><br>
            <br>
            <input name="clear" type="button" value="Restart" onClick="cla()" tabindex="0" />
            <input name="calc" type="button" value="Calc" onClick="calc1()" tabindex="1" />
            <input name="clear" type="button" value="Clear" onClick="document.theForm.output.value= ''" tabindex="2" />
            <input name="graph" type="button" value="Graph" onClick="graphit()" tabindex="3" />
            <br><br><br>
            <h2>Units</h2>
            <br>
            <label>Deg</label><input name="degrees" type="radio" title="degrees" />
            <label>Rad</label><input name="degrees" type="radio" title="radians" checked />

            <label>Bisect</label><input type="radio" name="Method" VALUE="Bisection">
            <label>False Pos</label><input type="radio" name="Method" VALUE="False">
            <label>Illinois</label><input type="radio" name="Method" VALUE="Illinois">
            <label>Newton</label><input type="radio" name="Method" VALUE="Newton">
            <label>Mod Sec</label><input type="radio" name="Method" VALUE="Secant">
            <label>Steps</label><input type="checkbox" name="steps" checked>
            <!-- <input type="checkbox" name="graph" checked> Graph -->
            <!-- <input type="checkbox" name="reduce"> Reduce -->

            <br><br><br><br>



            <!-- <input name="popbut" Value="Pop" type="button" onClick="popstack()"/><br> -->
            <!-- <input name="savebut" Value="Save" type="button" onClick="savestuff('jsdata',document.theForm.Function.value+';\''+document.theForm.Derivative.value); document.theForm.Function.focus()"/><br> -->
            <!-- <input name="loadbut" Value="Load" type="button" onClick="loadthem()"/><br> -->
            <!-- <input name="nextbut" Value="next" type="button" onClick="next()"/><br> -->
            <h2>Output</h2>
            <textarea name="output" rows=25 cols=68 tabindex=0></textarea>
        </form>
        <script>
            wi = 0
            wff = ["x^4 -6x^3 +11x^2 -6x -3", "x^4 -6x^3 +11x^2 -6x -3", "Sin(x)-.25"]
            wfv = ["3.5", "3.5", "2.9"]
            wf2 = ["4x3-18x2+22x-6", "", ""]
            wx1 = [3, -.5, -.5]
            wx2 = [4, 3.5, 3.5]

            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                ls = ls.slice(1).split("&")[0].replace(/; +/g, ";")
                while (ls.length > 0) {
                    if (ls.slice(0, 2) == 'u:') {
                        if (ls.slice(2, 5) == 'deg') document.theForm.degrees[0].checked = true
                        else if (ls.slice(2, 5) == 'rad') document.theForm.degrees[1].checked = true
                        lsnext = ls.search(/;/);
                        if (lsnext == -1) lsnext = ls.length;
                        ls = ls.slice(lsnext + 1);
                        continue
                    } else if (ls.slice(0, 2) == 'x:') {
                        lsstart = 1;
                        lsmid = ls.search(/ to /);
                        lsnext = ls.search(/;/);
                        if (lsnext == -1) lsnext = ls.length;
                        document.theForm.x1.value = eval(ls.slice(lsstart + 1, lsmid))
                        document.theForm.x2.value = eval(ls.slice(lsmid + 4, lsnext))
                        ls = ls.slice(lsnext + 1);
                        continue
                    } else if (ls.slice(0, 2) == 'y:') {
                        lsstart = 1;
                        lsmid = ls.search(/ to /);
                        lsnext = ls.search(/;/);
                        if (lsnext == -1) lsnext = ls.length;
                        y1 = eval(ls.slice(lsstart + 1, lsmid))
                        y2 = eval(ls.slice(lsmid + 4, lsnext))
                        ls = ls.slice(lsnext + 1);
                        continue
                    }
                    break
                }
                document.theForm.Function.value = ls;
                calc1()
            }
        </script>
    </div>
</body>

</html>