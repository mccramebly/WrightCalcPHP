<!DOCTYPE html>
<html lang="en">

<head>
    <title>Graph Functions</title>
    <meta charset="utf-8">
    <script src="myfunctions.js"></script>
    <script src="statfns.js"></script>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus(); document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <script>
            // -------------------------------------------------------*/
            function C2GX(X) {
                return GXD * (X - CXM) + GXM
            } // canvas coord to graph coord
            // -------------------------------------------------------*/
            function G2CX(X) {
                var y = (X - GXM) / GXD + CXM;
                return y
            } // if (y>-999 && y<999) return y; else return 0  }
            // -------------------------------------------------------*/
            function C2GY(Y) {
                return GYD * (CYT - Y - CYM) + GYM
            }
            // -------------------------------------------------------*/
            function G2CY(Y) {
                var y = CYT - (Y - GYM) / GYD - CYM
                // if (y<-500) return (-500)
                // if (y>CYW+500) return (CYW+500)
                return y
            }
            // -------------------------------------------------------*/
            function leftfunc() {
                Dx = (GXT - GXF) / 4;
                GXF = GXF - Dx;
                GXT = GXT - Dx
                plot(999, true, false)
            }
            // -------------------------------------------------------*/
            function rightfunc() {
                Dx = (GXT - GXF) / 4;
                GXF = GXF + Dx;
                GXT = GXT + Dx
                plot(999, true, false)
            }
            // -------------------------------------------------------*/
            function upfunc() {
                Dy = (GYT - GYF) / 4;
                GYF = GYF + Dy;
                GYT = GYT + Dy
                plot(999, true, false)
            }
            // -------------------------------------------------------*/
            function downfunc() {
                Dy = (GYT - GYF) / 4;
                GYF = GYF - Dy;
                GYT = GYT - Dy
                plot(999, true, false)
            }
            // -------------------------------------------------------*/
            function backfunc() {
                if (GQstack.length > 0) {
                    GQ = GQstack.pop();
                    GQ = GQstack.pop()
                    GXF = GQ[0];
                    GXT = GQ[1];
                    GYF = GQ[2];
                    GYT = GQ[3];
                    plot(999, true, false)
                }
            }
            // -------------------------------------------------------*/
            function recalc() {
                if (GYT == GYF || GXT == GXF) return
                GXM = (GXF + GXT) / 2;
                GXD = (GXT - GXF) / CXD;
                GXW = (GXT - GXF) / 2
                GYM = (GYF + GYT) / 2;
                GYD = (GYT - GYF) / CYD;
                GYW = (GYT - GYF) / 2
                mGXM = GXM;
                mGYM = GYM
                document.theForm.lastpoint.value = "(" + myround(GXM, 14) + ',' + myround(GYM, 14) + ")"
            }
            // -------------------------------------------------------*/
            function clrscr() {
                POIget1 = false;
                POIgetn = false;
                POIx = undefined;
                POIy = undefined;
                gprogsI = 0;
                document.theForm.input.value = '';
                GXF = -10;
                GXT = 10;
                GYF = -10;
                GYT = 10;
                plot(999, true, false);
            }
            // -------------------------------------------------------*/
            function sample() {
                gprogsIsave = gprogsI;
                clrscr();
                gprogsI = gprogsIsave
                document.theForm.input.value = gprogs[gprogsI];
                gprogsI = (gprogsI + 1) % gprogs.length
                if (gprogsI != 1) plot(999, false, true)
                document.theForm.input.focus()
            }
            // -------------------------------------------------------*/
            function t2pi() {
                GXF = -.1;
                if (document.theForm.degrees[0].checked) GXT = 361;
                else if (document.theForm.degrees[1].checked) GXT = 2 * Math.PI + .1
                else if (document.theForm.degrees[2].checked) GXT = 2.1
                plot(999, true, false)
            }
            // -------------------------------------------------------*/
            function chdim(xy, factor) {
                recalc()
                if (factor == 0) {
                    if (xy & 1) {
                        if (GXT > 0) GXF = 0;
                        else GXT = 0
                    }
                    if (xy & 2) {
                        if (GYT > 0) GYF = GYT / 50;
                        else GYT = -GYT / 50
                    }
                } else {
                    if (xy & 1) {
                        GXF = GXM - factor * GXW;
                        if (xpositive) GXF = 0;
                        GXT = GXM + factor * GXW
                    }
                    if (xy & 2) {
                        GYF = GYM - factor * GYW;
                        if (ypositive) GYF = 0;
                        GYT = GYM + factor * GYW
                    }
                }
                plot(999, true, false)
            }
            // -------------------------------------------------------*/
            function centerfunc() {
                with(Math) {
                    GXFO = GXF;
                    GXTO = GXT;
                    GXMO = GXM;
                    GYFO = GYF;
                    GYTO = GYT;
                    GYMO = GYM // not sure
                    GXT = max(abs(GXF), abs(GXT));
                    GXF = -GXT
                    GYT = max(abs(GYF), abs(GYT));
                    GYF = -GYT
                    plot(999, true, false)
                }
            }
            // -------------------------------------------------------*/
            function movetoxy(X, Y) {
                with(Math) {
                    GXFO = GXF;
                    GXTO = GXT;
                    GYFO = GYF;
                    GYTO = GYT
                    GXM = (GXF + GXT) / 2 - X;
                    GXF -= GXM;
                    GXT -= GXM
                    GYM = (GYF + GYT) / 2 - Y;
                    GYF -= GYM;
                    GYT -= GYM
                    if (abs((GXF + GXT) / 2 - (GXFO + GXTO) / 2) < GXD && abs((GYF + GYT) / 2 - (GYFO + GYTO) / 2) < GYD) chdim(3, .1)
                    else plot(999, true, false)
                }
            }
            // -------------------------------------------------------*/
            function scalefunc() {
                with(Math) {
                    GXFO = GXF;
                    GXTO = GXT;
                    GYFO = GYF;
                    GYTO = GYT
                    Dy = (GXT - GXF) / 2 // scale y axis to match x axis
                    GYM = (GYF + GYT) / 2
                    // if (y.length>0) {ysort=y.sort(function(a,b){return a-b}); GYM=ysort[Math.floor(ysort.length/2)]}
                    // else GYM=0
                    GYF = GYM - Dy;
                    GYT = GYM + Dy
                    plot(999, true, false)
                }
            }
            // -------------------------------------------------------*/
            function getexpr0(k) {
                if (!isNaN(k)) expr0 = expr0.slice(k)
                var i = (expr0).search(":")
                var j = expr0.slice(0, i)
                expr0 = expr0.slice(i + 1)
                return (j)
            }
            // -------------------------------------------------------*/
            function doaxis() {
                if (hadplot) return;
                else hadplot = true
                // x axis
                Mx = (GXT - GXF) / 10;
                MxL = mylog(Mx);
                MxL1 = Math.floor(MxL);
                Mx = round4(Math.pow(10, MxL - MxL1))
                if (Mx > 5) Mx = 10;
                else if (Mx > 2) Mx = 5;
                else if (Mx > 1) Mx = 2;
                else Mx = 1
                Mx *= Math.pow(10, MxL1);
                FMx = Math.floor(GXF / Mx) * Mx
                GXTs = "" + GXT;
                if (GYF * GYT <= 0) {
                    ctx.beginPath();
                    ctx.lineWidth = border;
                    ctx.strokeStyle = axis
                    ctx.moveTo(0, G2CY(0));
                    ctx.lineTo(1, G2CY(0) - 1);
                    ctx.lineTo(CXD, G2CY(0));
                    ctx.stroke()
                    ctx.font = "bold 12px Arial";
                    ctx.fillStyle = axis
                    ctx.fillText(GXTs, CXD - 7 * GXTs.length, G2CY(0) - border3);
                    ctx.stroke()
                    // x marks
                    while (FMx <= GXT) {
                        if (DOgrid) {
                            ctx.beginPath();
                            ctx.lineWidth = 1;
                            ctx.strokeStyle = axis;
                            ctx.moveTo(G2CX(FMx), 0);
                            ctx.lineTo(G2CX(FMx), CYW)
                        } else {
                            ctx.beginPath();
                            ctx.lineWidth = border;
                            ctx.strokeStyle = axis;
                            ctx.moveTo(G2CX(FMx), G2CY(0) + 5);
                            ctx.lineTo(G2CX(FMx), G2CY(0) - 5);
                            ctx.lineTo(G2CX(FMx) + 1, G2CY(0) + 5);
                            ctx.lineTo(G2CX(FMx), G2CY(0) - 5)
                        }
                        ctx.font = "bold 12px Arial";
                        ctx.fillStyle = axis
                        ctx.fillText(("" + myround(FMx)).slice(-6), G2CX(FMx) + border2, G2CY(0) + 15)
                        ctx.stroke()
                        FMx += Mx
                    }
                } else {
                    ctx.font = "bold 12px Arial";
                    ctx.fillStyle = axis
                    ctx.fillText(GXTs, CXD - 7 * GXTs.length, CXD - 15);
                    ctx.stroke()
                    while (FMx <= GXT) {
                        if (DOgrid) {
                            ctx.beginPath();
                            ctx.lineWidth = 1;
                            ctx.strokeStyle = axis;
                            ctx.moveTo(G2CX(FMx), 0);
                            ctx.lineTo(G2CX(FMx), CYW)
                        } else {
                            ctx.beginPath();
                            ctx.lineWidth = border;
                            ctx.strokeStyle = axis;
                            ctx.lineWidth = border;
                            ctx.moveTo(G2CX(FMx), CYD);
                            ctx.lineTo(G2CX(FMx), CYD - 10);
                            ctx.lineTo(G2CX(FMx) + 1, CYD);
                            ctx.lineTo(G2CX(FMx), CYD - 10)
                        }
                        ctx.font = "bold 12px Arial";
                        ctx.fillStyle = axis
                        ctx.fillText(("" + myround(FMx)).slice(-6), G2CX(FMx) + border, CXD)
                        ctx.stroke()
                        FMx += Mx
                    }
                }
                // y axis
                My = (GYT - GYF) / 10;
                MyL = mylog(My);
                MyL1 = Math.floor(MyL);
                My = round4(Math.pow(10, MyL - MyL1))
                if (My > 5) My = 10;
                else if (My > 2) My = 5;
                else if (My > 1) My = 2;
                else My = 1
                My *= Math.pow(10, MyL1);
                FMy = Math.floor(GYF / My) * My
                if (GXF * GXT <= 0) {
                    ctx.beginPath();
                    ctx.lineWidth = border;
                    ctx.strokeStyle = axis;
                    ctx.moveTo(G2CX(0), 0);
                    ctx.lineTo(G2CX(0) + 1, 1);
                    ctx.lineTo(G2CX(0), CYD);
                    ctx.stroke()
                    // y marks
                    LFMy = FMy - My
                    while (FMy <= GYT && FMy > LFMy) {
                        if (G2CY(FMy) < (CYD - 30)) {
                            if (DOgrid) {
                                ctx.beginPath();
                                ctx.lineWidth = 1;
                                ctx.strokeStyle = axis;
                                ctx.moveTo(0, G2CY(FMy));
                                ctx.lineTo(CXW, G2CY(FMy))
                            } else {
                                ctx.beginPath();
                                ctx.lineWidth = border;
                                ctx.strokeStyle = axis
                                ctx.moveTo(G2CX(0) + border, G2CY(FMy));
                                ctx.lineTo(G2CX(0) + border + 30, G2CY(FMy))
                                ctx.lineTo(G2CX(0) + border, G2CY(FMy))
                            }
                            ctx.font = "bold 12px Arial";
                            ctx.fillStyle = axis
                            ctx.fillText(" " + myround(FMy), G2CX(0) + 5, G2CY(FMy))
                            ctx.stroke()
                        }
                        LFMy = FMy;
                        FMy += My
                    }
                } else {
                    while (FMy <= GYT) {
                        if (G2CY(FMy) < (CYD - 30)) {
                            // document.theForm.input.value+="//"+FMy+', '
                            if (DOgrid) {
                                ctx.beginPath();
                                ctx.lineWidth = 1;
                                ctx.strokeStyle = axis;
                                ctx.moveTo(0, G2CY(FMy));
                                ctx.lineTo(CXW, G2CY(FMy))
                            } else {
                                ctx.beginPath();
                                ctx.lineWidth = border;
                                ctx.strokeStyle = axis
                                ctx.moveTo(border, G2CY(FMy));
                                ctx.lineTo(border + 30, G2CY(FMy))
                                ctx.lineTo(border, G2CY(FMy))
                            }
                            ctx.font = "bold 12px Arial";
                            ctx.fillStyle = axis
                            ctx.fillText(" " + myround(FMy), 5, G2CY(FMy))
                            ctx.stroke()
                        }
                        FMy += My
                    }
                }
                // origin
                ctx.beginPath();
                ctx.arc(G2CX(0), G2CY(0), border2, 0, 2 * Math.PI, false);
                ctx.fillStyle = axis;
                ctx.fill()
            }
            // -------------------------------------------------------*/
            function enter(evt) {
                var charCode = evt.keyCode;
                if (charCode == 13) plot(999, false, true)
                if (charCode == 27) {
                    if (document.theForm.input.value == '') sample();
                    else clrscr()
                }
            };
            // --------------------------------------------*/
            function f(x) {
                with(Math) {
                    X = x;
                    if (document.theForm.degrees[2].checked) X = x * Math.PI
                    try {
                        var Y = eval(fofx)
                    } catch (err) {
                        return 0
                    }
                    return Y
                }
            }
            // --------------------------------------------*/
            function pfx(x) {
                with(Math) {
                    X = x;
                    try {
                        var Y = eval(pfxofx)
                    } catch (err) {
                        return 0
                    }
                    return Y
                }
            }
            // --------------------------------------------*/
            function pfy(x) {
                with(Math) {
                    X = x;
                    try {
                        var Y = eval(pfyofx)
                    } catch (err) {
                        return 0
                    }
                    return Y
                }
            }
            // --------------------------------------------*/
            function plot(todo, move, getnewx) {
                with(Math) {
                    if (document.theForm.input.value.slice(0, 14) == "Sample graphs:") {
                        gprogsI = base(document.theForm.input.value.slice(-3), 16) % gprogs.length
                        if (document.theForm.input.value.slice(-5) == "ned:\n") gprogsI = -1
                        document.theForm.input.value = gprogs[gprogsI + 1]
                        gprogsI = (gprogsI + 1) % gprogs.length
                        document.theForm.input.focus()
                    }
                    // todo= which graph to show 0=all, <0 only that one, up through that one
                    // move= we have been given values for GXF, GXT, GYF, GYT
                    // getnewx= process x: command  ( false says to skip it)
                    OPx = 0;
                    OPy = 0;
                    colorI = 0;
                    didsteps = 1;
                    didany = false;
                    hadsteps = 0;
                    if (todo != 0) dowhat = todo
                    var expr = '\n' + document.theForm.input.value.replace(/\s+\n/g, "\n").replace(/\n+/g, "\n").replace(/^\n+/, "").replace(/\n*$/, "") + "\n"
                    expr = expr.replace(/\[/g, "(").replace(/\]/g, ")")
                    if (expr == "\n\n") expr = ''
                    hadplot = false;
                    needY = true
                    POIget = POIget1 || POIgetn
                    if (POIget) {
                        POIx1 = undefined;
                        POIxn = undefined;
                        POIy1 = undefined;
                        POIyn = undefined
                    }
                    ctx.fillStyle = "#FFFFFF";
                    ctx.fillRect(0, 0, CXD, CYD)
                    recalc()
                    if (move) {
                        if (expr != '') ctx.fillStyle = "#DDDDDD";
                        ctx.fillRect(G2CX(GXFO), G2CY(GYFO), G2CX(GXTO) - G2CX(GXFO), G2CY(GYTO) - G2CY(GYFO))
                        needY = false
                    } else {
                        GXFO = GXF;
                        GXTO = GXT;
                        GYFO = GYF;
                        GYTO = GYT
                    }

                    changexrange = true
                    while ((ex1 = (';' + expr).search(/[;\n ][xy]:/i)) > -1) {
                        ex2 = expr.slice(ex1 + 2).search(/[;\n]/) + ex1 + 2
                        ex3 = expr.slice(ex1).search(/:/) + ex1
                        units = expr.slice(ex3 + 1, ex2);
                        changexrange = false
                        units = units.replace(/,/, " to ")
                        if (expr.charAt(ex3 - 1).toLowerCase() == 'x') document.theForm.xrange.value = units
                        else if (expr.charAt(ex3 - 1).toLowerCase() == 'y') document.theForm.yrange.value = units
                        if (ex1 == 0) expr = expr.slice(ex2);
                        else expr = expr.slice(0, ex1) + expr.slice(ex2 + 1)
                    }
                    document.theForm.input.value = expr.slice(1)
                    document.theForm.xrange.value = document.theForm.xrange.value.replace(",", " to ")
                    document.theForm.yrange.value = document.theForm.yrange.value.replace(",", " to ")
                    if (document.theForm.yrange.value.search(/ to /) > -1) expr = "\ny:" + document.theForm.yrange.value + ";" + expr
                    if (document.theForm.xrange.value.search(/ to /) > -1) expr = "\nx:" + document.theForm.xrange.value + ";" + expr
                    nt = trigfactor
                    if (document.theForm.degrees[0].checked == true) {
                        document.getElementById("degpisw").value = "0-360";
                        trigval = 'deg';
                        nt = 180 / pi
                    } else if (document.theForm.degrees[1].checked == true) {
                        document.getElementById("degpisw").value = save2pi;
                        trigval = 'rad';
                        nt = 1
                    } else if (document.theForm.degrees[2].checked == true) {
                        document.getElementById("degpisw").value = "0 - 2";
                        trigval = 'pir';
                        nt = 1 / pi
                    }
                    trigfactor = nt;
                    degrees = document.theForm.degrees[0].checked

                    while (expr.length > 0) {
                        exprbr = expr.search(/[\n;]/);
                        if (exprbr == -1) exprbr = expr.length;
                        newcolor = (expr[exprbr] == '\n') || newcolor
                        expr0 = expr.slice(0, exprbr);
                        expr = expr.slice(exprbr + 1)
                        expr0 = expr0.replace(/ *$/, '').replace(/^ */, '');
                        if (expr0.slice(-1) == ":") continue
                        if ((expr1s = expr0.search(/\/\//)) > -1) expr0 = expr0.slice(0, expr1s)
                        if (slim(expr0).length == 0) continue
                        // look for x/y ranges
                        if (expr0.search(/ to /) > -1) {
                            if (hadplot) continue
                            expr0 = expr0.replace(/^\s*/, "")
                            expr1s = expr0.search(/:/);
                            expr1e = expr0.search(/ to /);
                            if (expr0.slice(0, 1).toLowerCase() == "x" && getnewx) {
                                GXF = eval(expr0.slice(expr1s + 1, expr1e))
                                GXT = eval(expr0.slice(expr1e + 4))
                                GXD = (GXT - GXF) / CXD
                                getnewx = false
                            } else if (expr0.slice(0, 1).toLowerCase() == "y" && needY) {
                                GYF = eval(expr0.slice(expr1s + 1, expr1e))
                                GYT = eval(expr0.slice(expr1e + 4))
                                GYD = (GYT - GYF) / CYD
                                needY = false
                            }
                            continue
                        }
                        // look for trig factor changes
                        if (expr0.slice(0, 2).toLowerCase() == 'u:') {
                            trigval = expr0.replace(/\s*/, "").slice(2, 5)
                            if (trigval == 'deg') document.theForm.degrees[0].checked = true
                            else if (trigval == 'rad') document.theForm.degrees[1].checked = true
                            else if (trigval == 'pir') document.theForm.degrees[2].checked = true
                            nt = trigfactor
                            if (document.theForm.degrees[0].checked == true) {
                                document.getElementById("degpisw").value = "0-360";
                                trigval = 'deg';
                                nt = 180 / pi
                            } else if (document.theForm.degrees[1].checked == true) {
                                document.getElementById("degpisw").value = save2pi;
                                trigval = 'rad';
                                nt = 1
                            } else if (document.theForm.degrees[2].checked == true) {
                                document.getElementById("degpisw").value = "0 - 2";
                                trigval = 'pir';
                                nt = 1 / pi
                            }
                            trigfactor = nt;
                            degrees = document.theForm.degrees[0].checked
                            continue
                        }

                        recalc()

                        // set color= color
                        if (newcolor) {
                            hadsteps = didsteps;
                            didsteps++
                        }
                        if (expr0.search(/\{/) > 2) {
                            expr01 = expr0.search(/\{/);
                            expr02 = expr0.search(/\}/);
                            if (expr02 == -1) expr02 = expr0.length
                            color = expr0.slice(expr01 + 1, expr02);
                            expr0 = expr0.slice(0, expr01)
                        } else {
                            if (newcolor) colorI = (colorI + 1) % colors.length;
                            color = colors[colorI];
                            newcolor = false
                        }
                        if (dowhat < 0) {
                            if (-dowhat != hadsteps) continue
                            else didany = true
                        } else if (dowhat < hadsteps) {
                            doaxis();
                            return
                        }

                        if (expr0.slice(expr0.search(/:/) + 1).search(/^\(.*,/) > -1) // connect points with straight lines   (x,y,radius,name)
                        { // if ((expr0.search(/\(.*,/)>-1)&&(expr0.search(/[a-z]\s*\(.*,/g)==-1)) // connect points with straight lines   (x,y,radius,name)
                            savepoints = [] // x,y,r,t  [(x,y) radius text] or  a,b,c,d,99 [rectangle (a,b) to (c,d)]
                            vect = 0
                            expr0 = expr0.replace(/^\s*/, "") // no leading spaces
                            if (expr0.search(/v\d.*:/i) == 0) vect = Number(expr0[1]) // vector addition ( see below )
                            while ((p1 = expr0.search(/\(/)) > -1) {
                                expr0 = expr0.slice(p1 + 1);
                                p1 = 0;
                                var p2 = 0 // find matching parenthesis
                                do {
                                    if (expr0.charAt(p1) == "(") p2++
                                    if (expr0.charAt(p1) == ")") {
                                        if (p2 == 0) break
                                        p2--
                                    }
                                    p1++
                                } while (p1 < expr0.length)
                                var xyzw = expr0.slice(0, p1);
                                expr0 = expr0.slice(p1 + 1)
                                point = xyzw.split(',').concat(['', '', ''])
                                Px = cleanx(point[0], true)
                                Py = point[1];
                                pd = (trigval == 'deg');
                                Pz = point[2];
                                if (Pz.length > 0) Pz = cleanx(Pz, true)
                                Pw = point[3]
                                Pv = point[4]

                                if (Py == "E") Py = "90°"
                                if (Py == "W") Py = "270°"
                                if (Py == "N") Py = "0°"
                                if (Py == "S") Py = "180°"
                                var pd = pd || (Py.search(/°/) > -1)
                                // var pr=(Py.search(/π/)>-1)
                                Py = Py.replace(/([NS])([EW])/i, "$145$2")
                                if (Py.search(/[NS].*[EW]/i) > -1) {
                                    if (Py.search(/S/i) > -1) azi1 = 180;
                                    else azi1 = -360
                                    azi2 = /[NS](.*?)°*[EW]/i
                                    azi3 = Number(azi2.exec(Py)[1])
                                    if (Py.search(/E/i) > -1) azi1 -= azi3;
                                    else azi1 += azi3
                                    pd = true;
                                    Py = "" + (abs(azi1) % 360)
                                }
                                Py = cleanx(Py, true)

                                if (savepoints.length > 0) switch (vect) {
                                    case 1: // (x,y) vector
                                        Px = OPx + Px;
                                        Py = OPy + Py;
                                        break
                                    case 2: // (distance,slope)
                                        Pangle = Math.atan(Py)
                                        Py = OPy + Px * Math.sin(Pangle)
                                        Px = OPx + Px * Math.cos(Pangle)
                                        break
                                    case 3: // (rho,theta) polar coordinate
                                        if (pd) Py = Py * PI / 180
                                        Pangle = Py
                                        Py = OPy + Px * Math.sin(Pangle)
                                        Px = OPx + Px * Math.cos(Pangle)
                                        break
                                    case 4: // (distance,theta) azimuth angle
                                        if (pd) Py = Py * PI / 180
                                        Pangle = 5 * PI / 2 - Py
                                        Py = OPy + Px * Math.sin(Pangle)
                                        Px = OPx + Px * Math.cos(Pangle)
                                        break
                                    case 5: // (distance,theta) compass direction
                                        Pangle = 450 - Py
                                        Pangle = Pangle * PI / 180
                                        Py = OPy + Px * Math.sin(Pangle)
                                        Px = OPx + Px * Math.cos(Pangle)
                                        break
                                }
                                OPx = Px;
                                OPy = Py

                                if (needY) {
                                    if (Py > -Infinity && (Py < GYF || savepoints.length == 0)) GYF = Py
                                    if (Py < Infinity && (Py > GYT || savepoints.length == 0)) GYT = Py
                                }
                                if (getnewx) {
                                    if (Px < GXF || savepoints.length == 0) GXF = Px
                                    if (Px > GXT || savepoints.length == 0) GXT = Px
                                }
                                savepoints.push([Px, Py, Pz, Pw, Pv])
                            }

                            if (needY && (GYT != GYF)) {
                                GYD = (GYT - GYF) / CYD;
                                needY = false
                            }
                            if (getnewx) {
                                GXD = (GXT - GXF) / CXD;
                                getnewx = false
                            }
                            recalc() // just in case
                            ctx.beginPath();
                            ctx.strokeStyle = color;
                            ctx.lineWidth = 6
                            // ought to convert this to points that fit on the canvas #######
                            i = 0
                            if (i < savepoints.length)
                                if (savepoints[i][4] != 99) {
                                    ctx.moveTo(G2CX(savepoints[0][0]), G2CY(savepoints[0][1]));
                                    i++
                                }
                            // else ctx.moveTo(G2CX(savepoints[0][0]),G2CY(savepoints[0][3]))
                            while (i < savepoints.length) {
                                if (savepoints[i][4] != 99) ctx.lineTo(G2CX(savepoints[i][0]), G2CY(savepoints[i][1]))
                                /* else
                                { ctx.lineTo(G2CX(savepoints[i][0]),G2CY(savepoints[i][1]))
                                  ctx.lineTo(G2CX(savepoints[i][2]),G2CY(savepoints[i][1]))
                                  ctx.lineTo(G2CX(savepoints[i][2]),G2CY(savepoints[i][3]))
                                } */
                                i++
                            }
                            ctx.stroke();

                            if (POIget) {
                                savePOI = [];
                                for (i = 1; i < savepoints.length; i++) {
                                    x1 = savepoints[i][0];
                                    y1 = savepoints[i][1];
                                    x2 = savepoints[i - 1][0];
                                    y2 = savepoints[i - 1][1];
                                    m = (y2 - y1) / (x2 - x1);
                                    b = y1 - m * x1
                                    if (y1 * y2 < 0) savePOI.push([-b / m, 0])
                                    if (x1 == 0 || y1 == 0) savePOI.push([x1, y1])
                                    if (x1 * x2 < 0) savePOI.push([0, b])
                                    if (savePOI.length == 0) continue
                                    savePOI.sort(function(a, b) {
                                        return a[0] - b[0]
                                    })
                                    if (POIx1 == undefined || savePOI[0][0] < POIx1) {
                                        POIx1 = savePOI[0][0];
                                        POIy1 = savePOI[0][1]
                                    }
                                    if (POIx == undefined) {
                                        POIxn = POIx1;
                                        POIyn = POIy1
                                    } else {
                                        for (j = 0; j < savePOI.length && (savePOI[j][0] < POIx || (savePOI[j][0] == POIx && savePOI[j][1] <= POIy)); j++);
                                        if (j < savePOI.length && (POIxn == undefined || savePOI[j][0] < POIxn)) {
                                            POIxn = savePOI[j][0];
                                            POIyn = savePOI[j][1]
                                        }
                                    }
                                }
                            }
                            storeAsY = yv.length == 0
                            if (savepoints.length == 1)
                                if (savepoints[0][2] == "") savepoints[0][2] = -3;
                            while (savepoints.length > 0) {
                                Pxy = savepoints.pop();
                                drawpoints.push(Pxy);
                                if (storeAsY) yv.push(Pxy[1])
                            }
                            continue
                        }

                        pwF = GXF;
                        pwT = GXT
                        expr0 = slim(expr0).toUpperCase()
                        pshadex = false;
                        pshade = "<>".indexOf(expr0[0]) // shade portion under/over straight line
                        if (pshade > -1) {
                            expr0 = slim(expr0.slice(1))
                            if (expr0.slice(0, 2) == "X=") {
                                pshadex = true;
                                expr0 = expr0.slice(2)
                            }
                            if ((i1 = expr0.search(/\([^,()\n]+,[^,()\n]+\)[^,()\n]*\([^,()\n]+,[^,()\n]+\)/)) > -1) {
                                expr0 = expr0.replace(/\)\(/g, ") (")
                                i2 = expr0.slice(i1).search(/\n/);
                                if (i2 == -1) i2 = expr0.length;
                                else i2 += i1
                                i3 = expr0.slice(i1, i2).match(/[(),][^(),]+/g)
                                i4 = line(i3[0].slice(1), i3[1].slice(1), i3[3].slice(1), i3[4].slice(1))
                                expr0 = expr0.slice(0, i1) + i4 + expr0.slice(i2)
                            }
                        }
                        if ((expr0.search(/\):/)) >= 0 && expr0[0] == "(") {
                            pwF = Number(getexpr0(1));
                            pwT = Number(getexpr0().slice(0, -1))
                        } // piecewise functions "(pwF:pwT):"
                        pxy = getexpr0()[0]
                        dydx = pxy == "D" // derivative  D:
                        iydx = pxy == "I" // integral  I:
                        pxy = pxy == "P" // polar coordinates  P::::
                        if (pxy) {
                            expr0 += ":";
                            pxF = cleanx(getexpr0(), true)
                            pxT = cleanx(getexpr0(), true)
                            pfxofx = cleanx(getexpr0())
                            pfyofx = cleanx(getexpr0())
                        } else {
                            if (expr0.search(/X/) == -1) {
                                var re = new RegExp("[A-ZΘθ]", 'g');
                                if (expr0.search(re) >= 0) expr0 = expr0.replace(re, 'X')
                            }
                            fofx = cleanx(expr0)
                            if ((i = fofx.search(/=/)) > 0) {
                                if (fofx.slice(0, 2) == "X=") {
                                    xvalue = eval(cleanx(fofx.slice(2)))
                                    if (GXF <= xvalue && xvalue < GXT) {
                                        ctx.beginPath();
                                        ctx.lineWidth = 4;
                                        ctx.strokeStyle = color;
                                        ctx.moveTo(G2CX(xvalue), 0);
                                        ctx.lineTo(G2CX(xvalue) + 1, 1);
                                        ctx.lineTo(G2CX(xvalue), CYD);
                                        ctx.stroke()
                                    }
                                    continue
                                } else {
                                    if (i == 1) fofx = fofx.slice(2)
                                    else fofx = fofx.slice(0, i) + '-(' + fofx.slice(i + 1) + ')'
                                }
                                if (fofx.length == 0) continue
                            }
                        }

                        // draw graphs

                        if (pxy) {
                            for (i = 0; i < CXD1; i++) {
                                X = pxF + i * (pxT - pxF) / CXD
                                xv[i] = pfx(X)
                                yv[i] = pfy(X)
                            }
                        } else {
                            newton = 'x:' + document.theForm.xrange.value + ';y:' + document.theForm.yrange.value + '; u:' + trigval + ';' + expr0.slice(expr0.search(/[:=]/) + 1)
                            for (i = 0; i < CXD1; i++) {
                                xv[i] = i * GXD + GXF;
                                yv[i] = f(xv[i])
                                if (i > 1)
                                    if (yv[i - 1] != 0)
                                        if (yv[i] * yv[i - 1] <= 0)
                                            if ((yv[i] - yv[i - 1]) * (yv[i - 1] - yv[i - 2]) > 0)
                                                newton += "; " + xv[i]
                                if (yv[i] > GYT && !needY) yv[i] = GYT
                                if (yv[i] < GYF && !needY) yv[i] = GYF
                                if (isNaN(yv[i]))
                                    yv[i] = GYF - 1
                                if (dydx && i > 0) yv[i - 1] = (yv[i] - yv[i - 1]) / GXD
                                if (iydx) {
                                    if (i > 1) {
                                        if (i == 2) yv[0] = yv[0] * GXD
                                        yv[i - 1] = yv[i - 2] + yv[i - 1] * GXD
                                    }
                                }
                            }
                            if (dydx) yv[CXD] = yv[CXD - 1]
                            if (iydx) yv[CXD] = yv[CXD - 1] + yv[CXD - 1] * GXD
                            if (needY) {
                                GYF = undefined
                                for (i = 1; i < CXD1; i++) {
                                    if (pwF < xv[i] && xv[i] < pwT) {
                                        if (GYF == undefined && yv[i] < Infinity && yv[i] > -Infinity) {
                                            GYF = yv[i];
                                            GYT = GYF
                                        }
                                        if (yv[i] < GYF && yv[i] > -Infinity) GYF = yv[i]
                                        if (yv[i] > GYT && yv[i] < Infinity) GYT = yv[i]
                                    }
                                }
                                if (GYT <= GYF) {
                                    GYT = GYF + 5;
                                    GYF -= 5
                                }
                                GYD = (GYT - GYF) / CYD;
                                GYF -= GYD;
                                GYT += GYD;
                                needY = false
                            }
                        }
                        recalc()
                        if (POIget) { // POIx previous point, POIx1 1st point, POIxn next point
                            for (i = 2; i < CXD; i++) {
                                if (xv[i] * xv[i - 1] <= 0)
                                    i = i
                                if (GYF < yv[i] && yv[i] < GYT && pwF < xv[i] && xv[i] < pwT) {
                                    ispoi = false // in range
                                    if ((yv[i - 1] < yv[i] && yv[i] > yv[i + 1]) || (yv[i - 1] > yv[i] && yv[i] < yv[i + 1])) {
                                        ispoi = true;
                                        yi = yv[i];
                                        xi = xv[i]
                                    } // one point max
                                    else if ((yv[i - 2] < yv[i] && yv[i] == yv[i - 1] && yv[i] > yv[i + 1]) || (yv[i - 2] > yv[i] && yv[i] == yv[i - 1] && yv[i] < yv[i + 1])) {
                                        ispoi = true;
                                        yi = yv[i];
                                        xi = (xv[i] + xv[i - 1]) / 2
                                    } // two point max
                                    else if (yv[i] * yv[i - 1] <= 0 && yv[i - 1] != 0) {
                                        ispoi = true;
                                        yi = 0;
                                        xi = xv[i - 1] - yv[i - 1] * (xv[i - 1] - xv[i]) / (yv[i - 1] - yv[i])
                                    } // y= zero
                                    else if (xv[i] * xv[i - 1] <= 0 && xv[i - 1] != 0) {
                                        ispoi = true;
                                        xi = 0;
                                        yi = yv[i]
                                    } // x= zero
                                    if (ispoi) {
                                        if (POIx1 == undefined || xi < POIx1 || (xi == POIx1 && yi < POIy1)) {
                                            if (POIx1 > POIx || (POIx1 == POIx && POIy1 > POIy)) {
                                                POIxn = POIx1;
                                                POIyn = POIy1
                                            }
                                            POIx1 = xi;
                                            POIy1 = yi
                                        } else if (POIxn == undefined || xi < POIxn || (xi == POIxn && yi < POIyn)) {
                                            if (POIx == undefined || xi > POIx || (xi == POIx && yi > POIy)) {
                                                POIxn = xi;
                                                POIyn = yi
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        if (pshadex) { // shade x values
                            ctx.beginPath();
                            ctx.lineWidth = 4;
                            ctx.fillStyle = bgcolour
                            x0 = f(0)
                            ctx.moveTo(G2CX(x0), G2CY(GYF))
                            ctx.lineTo(G2CX(x0), G2CY(GYT))
                            if (pshade == 0) // <; >
                            {
                                ctx.lineTo(G2CX(GXT), G2CY(GYT))
                                ctx.lineTo(G2CX(GXT), G2CY(GYF))
                            } else {
                                ctx.lineTo(G2CX(GXF), G2CY(GYT))
                                ctx.lineTo(G2CX(GXF), G2CY(GYF))
                            }
                            ctx.fill();
                            ctx.beginPath();
                            ctx.lineWidth = 4;
                            ctx.strokeStyle = color
                            ctx.moveTo(G2CX(x0), G2CY(GYF))
                            ctx.lineTo(G2CX(x0), G2CY(GYT))
                            ctx.stroke()
                            continue
                        } else if (pshade > -1) { // graph straight line and shade
                            ctx.beginPath();
                            ctx.lineWidth = 4;
                            ctx.fillStyle = bgcolour
                            y0 = f(GXF);
                            y1 = f(GXT)
                            ctx.moveTo(G2CX(GXF), G2CY(y0))
                            //  (GXF,y0) (GXF,GYF) ... (GXT,GYF)(GXT,y1)
                            //
                            if (pshade == 0) // <; >
                            {
                                if (y0 < GYT) ctx.lineTo(G2CX(GXF), G2CY(GYT))
                                if (y1 < GYT) ctx.lineTo(G2CX(GXT), G2CY(GYT))
                                ctx.lineTo(G2CX(GXT), G2CY(y1))
                            } else {
                                if (y0 > GYF) ctx.lineTo(G2CX(GXF), G2CY(GYF))
                                if (y1 > GYF) ctx.lineTo(G2CX(GXT), G2CY(GYF))
                                ctx.lineTo(G2CX(GXT), G2CY(y1))
                            }
                            ctx.fill();
                            ctx.beginPath();
                            ctx.lineWidth = 4;
                            ctx.strokeStyle = color
                            ctx.moveTo(G2CX(GXF), G2CY(f(GXF)))
                            ctx.lineTo(G2CX(GXT), G2CY(f(GXT)))
                            ctx.stroke()
                            continue
                        }
                        // graph curve
                        ctx.beginPath();
                        ctx.lineWidth = 4;
                        ctx.strokeStyle = color
                        // piecewise definitions
                        if (GXF < pwF && pwF < GXT) {
                            ctx.beginPath();
                            ctx.lineWidth = 4;
                            ctx.strokeStyle = color;
                            ctx.moveTo(G2CX(pwF), 0);
                            ctx.lineTo(G2CX(pwF) + 1, 1);
                            ctx.lineTo(G2CX(pwF), CYD);
                            ctx.stroke()
                        }
                        if (GXF < pwT && pwT < GXT) {
                            ctx.beginPath();
                            ctx.lineWidth = 4;
                            ctx.strokeStyle = color;
                            ctx.moveTo(G2CX(pwT), 0);
                            ctx.lineTo(G2CX(pwT) + 1, 1);
                            ctx.lineTo(G2CX(pwT), CYD);
                            ctx.stroke()
                        }
                        xi = 0;
                        while (xv[xi] < pwF) xi++
                        ctx.moveTo(G2CX(xv[xi]), G2CY(yv[xi]))
                        for (xi++; xi < CXD1; xi++) {
                            if (xv[xi] > pwT) break
                            if (yv[xi] >= GYF && yv[xi - 1] >= GYF && ((yv[xi] > GYF && yv[xi] < GYT) || (yv[xi - 1] > GYF && yv[xi - 1] < GYT)))
                                ctx.lineTo(G2CX(xv[xi]), G2CY(yv[xi]))
                            else
                                ctx.moveTo(G2CX(xv[xi]), G2CY(yv[xi]))
                        }
                        ctx.stroke()
                    }
                    if (!didany) dowhat = 0

                    if (POIget && POIx1 != undefined) {
                        if (POIget1 || POIxn == undefined) {
                            POIx = POIx1;
                            POIy = POIy1
                        } // first POI
                        else {
                            POIx = POIxn;
                            POIy = POIyn
                        } // next POIget
                        POIget1 = false;
                        POIgetn = false;
                        POIget = false
                        drawpoints.push([POIx, POIy, -5, ''])
                        document.theForm.lastpoint.value = '(' + myround(POIx, 14) + ',' + myround(POIy, 14) + ')'
                    }

                    drawpoints.push([mGXM, mGYM, -1, '']) // midpoint
                    pointcolor = 'brown'
                    while (drawpoints.length > 0) {
                        Pxyzw = drawpoints.pop()
                        Px = Pxyzw[0];
                        Py = Pxyzw[1];
                        Pz = Pxyzw[2];
                        Pw = Pxyzw[3];
                        Pv = Pxyzw[4]
                        if (Pv == 99) {
                            ctx.fillStyle = color;
                            ctx.fillRect(G2CX(Px), G2CY(Py), G2CX(Pz) - G2CX(Px), G2CY(Pw) - G2CY(Py))
                            ctx.strokeStyle = "#FF5733";
                            ctx.lineWidth = 2
                            ctx.moveTo(G2CX(Px), G2CY(Pw))
                            ctx.lineTo(G2CX(Px), G2CY(Py))
                            ctx.lineTo(G2CX(Pz), G2CY(Py))
                            ctx.lineTo(G2CX(Pz), G2CY(Pw))
                            ctx.stroke();
                        } else {
                            ctx.beginPath()
                            ctx.font = "bold 20px Serif";
                            ctx.fillStyle = pointcolor
                            ctx.fillText(Pw, G2CX(Px) + 5, G2CY(Py) + 15)
                            if (Pz == undefined) {
                                ctx.arc(G2CX(Px), G2CY(Py), border2, 0, 2 * Math.PI, false)
                                ctx.fillStyle = pointcolor
                                ctx.fill()
                            } else if (Pz == 0) {} else if (Pz < 0) {
                                ctx.strokeStyle = pointcolor;
                                ctx.arc(G2CX(Px), G2CY(Py), -Pz, 0, 2 * Math.PI, false);
                                ctx.stroke()
                            } else if (((GYD * .9) < GXD) && (GXD < (GYD * 1.1))) {
                                ctx.strokeStyle = pointcolor;
                                ctx.arc(G2CX(Px), G2CY(Py), Pz / GXD, 0, 2 * Math.PI, false);
                                ctx.stroke()
                            }
                        }
                    }
                    color = axis;
                    doaxis();

                    GQstack.push([GXF, GXT, GYF, GYT])
                    if (!move) {
                        GXFO = GXF;
                        GXTO = GXT;
                        GYFO = GYF;
                        GYTO = GYT
                    }
                    document.theForm.xrange.value = GXF + " to " + GXT
                    document.theForm.yrange.value = GYF + " to " + GYT
                    var xxx = 'x:' + document.theForm.xrange.value + ';y:' + document.theForm.yrange.value
                    val1 = escape(xxx.replace(/\n/g, "<br>").replace(/;/g, "<sc>"))
                    localStorage.setItem('graphscale', val1)
                    document.theForm.input.focus()
                }
            }
            // --------------------------------------------*/
            function donewton() {
                plot(999, false, true)
                window.open('newton.php?' + newton)
            }
            // --------------------------------------------*/
            function url() {
                urlline = 'http://faculty.ccc.edu/jnadas/js/graphs.php?x:'
                urlline += 'x:' + GXF + ' to ' + GXT + ';y:' + GYF + ' to ' + GYT + ';'
                urlline += document.theForm.input.value.replace(/\n/g, ";")
                urlline = encodeURI(urlline)
                /*
                 document.theForm.middle.value=urlline
                document.theForm.middle.focus()
                document.getElementById('urlid').select()
                */
                return (urlline)
            } // --------------------------------------------*/
            function saveem() {
                var xxx = 'x:' + document.theForm.xrange.value + ';y:' + document.theForm.yrange.value + '\n' + document.theForm.input.value
                val1 = escape(xxx.replace(/\n/g, "<br>").replace(/;/g, "<sc>"))
                localStorage.setItem('graphdata', val1)
                savestuff('jsdata', xxx);
                document.theForm.input.focus()
            } // --------------------------------------------*/
            function ymax() {
                document.theForm.yrange.value = '';
                plot(999, false, false)
            } // --------------------------------------------*/
            function tiny() {
                window.open('http://tinyurl.com/create.php?source=indexpage&url=' + url())
            } // --------------------------------------------*/
            function POIcenter() {
                if (document.theForm.input.value == '') {
                    document.theForm.input.value = 'x:-10 to 10;y:-10 to 10\n(x-2)(x-3)(x+4){blue}\n'
                    plot(999, true, false)
                    return
                }
                if (POIx == undefined) {
                    POIgetn = true;
                    plot(999, false, false)
                }
                if (POIx != undefined) {
                    if (Math.abs(GXM - POIx) < GXD && Math.abs(GYM - POIy) < GYD) {
                        POIx = POIx - 2 * GXD;
                        POIgetn = true;
                        plot(999, false, false)
                    }
                    chdim(1, 0.5);
                    ymax()
                    movetoxy(POIx, POIy)
                }
            } // --------------------------------------------*/
        </script>
        <h1>Graph Functions</h1>
        <form name="theForm">
            <canvas id="theCanvas" width="501" height="501"></canvas>
            <input name="loadsbut" Value="reScale" type="button" onClick="loadscale()">

            <input id='lastpointx' size=35 name='lastpoint' />
            <h2>X-Range:</h2>
            <input name="xinbut" value="in" onclick="chdim(1,0.5)" type="button">
            <input name="xoutbut" value="out" onclick="chdim(1,1.2599210498948732)" type="button">
            <input name="xoutbut" value="2 X" onclick="chdim(1,2)" type="button">
            <input id="degpisw" name="x2pi" value=" 0-2&pi; " onclick="t2pi()" type="button">
            <!--not sure whether to leave this if style?-->
            <input name="xpos" value=">0" onclick="xpositive=!xpositive; chdim(1,0);" type="button">
            <br><br><br>
            <h3>Units</h3>
            <label>deg:</label><input name="degrees" type="radio" title="degrees" onClick="plot(999,false,true)" />
            <label>rad:</label><input name="degrees" type="radio" title="radians" checked onClick="plot(999,false,true)" />
            <label>pirad:</label><input name="degrees" type="radio" title="piradians" onClick="plot(999,false,true)" />
            <input name="xrange" size=35 value="" onKeyUp="enter(event)">



            <h2>Y-Range:</h2>
            <input name="yinbut" value="in" onclick="chdim(2,0.5)" type="button">
            <input name="youtbut" value="out" onclick="chdim(2,1.2599210498948732)" type="button">
            <input name="youtbut" value="2 X" onclick="chdim(2,2)" type="button">
            <input name="ymaxbut" value="max-Y" onclick="ymax()" type="button" title="range of y values for the first function">
            <input name="ypos" value=">0" onclick="ypositive=!ypositive; chdim(2,0); if(ypositive) this.style.backgroundColor='lightblue'; else this.style.backgroundColor='white'" type="button">


            <input name="yrange" size=35 value="" onKeyUp="enter(event)">
            <textarea name="input" rows=14 cols=68 onKeyUp="enter(event)"></textarea>

            <h2>Plot:</h2>
            <input name="plot0" value="All" onclick="plot(999,false,true)" type="button">
            <input name="plot1" value="first" onclick="plot(-1,false,true)" type="button">
            <input name="plot2" value="next" onclick="plot(-(Math.abs(dowhat)+1),false,true)" type="button">
            <input name="plot3" value="more" onclick="plot(Math.abs(dowhat)+1,false,true)" type="button">
            <input name="newbut" type="button" value="Newton" onClick="donewton()">
            <br><br><br>
            <h2>Move:</h2>
            <input name="leftbut" value="left" onclick="xpositive=false; leftfunc()" type="button">
            <input name="rightbut" value="right" onclick="xpositive=false; rightfunc()" type="button">
            <input name="upbut" value="up" onclick="ypositive=false; upfunc()" type="button">
            <input name="downbut" value="down" onclick="ypositive=false; downfunc()" type="button">
            <input name="backbut" value="back" onclick="backfunc()" type="button">
            <br><br><br>
            <h2>Change:</h2>
            <input name="inbut" value="in" onclick="chdim(3,.5)" type="button">
            <input name="outbut" value="out" onclick="chdim(3,1.2599210498948732)" type="button">
            <input name="outbut" value="2 X" onclick="chdim(3,2)" type="button">
            <input name="centerbut" value="origin" onclick="xpositive=false; ypositive=false; centerfunc()" type="button">
            <input name="scalebut" value="scale" onclick="document.theForm.yrange.value='';scalefunc()" type="button">
            <br><br><br>
            <h2>Other:</h2>
            <input name="savebut" Value="Save" type="button" onClick="saveem(); document.theForm.input.focus()">
            <input name="loadbut" Value="Load" type="button" onClick="loadstuff(true,'jsdata');plot(999,false,true); document.theForm.input.focus()">
            <input name="clearbut" Value="Clear" type="button" onClick="clrscr()">
            <input name="sambut" type="button" value="Samples" onClick="sample()">
            <br><br><br>
            <h2>P.O.I.</h2>
            <input name="poibut1" value="1st" onclick="POIget1=true;plot(999,false,false)" type="button">
            <input name="poibutn" value="Next" onclick="POIgetn=true;plot(999,false,false)" type="button">
            <input name="centerbut" value="center" onclick="POIcenter()" type="button">

            <br><br>
        </form>
        <script>
            // -------------------------------------------------------*/
            function loadscale() {
                document.theForm.input.value = unescape(localStorage.getItem('graphscale')).replace(/<br>/g, "\n").replace(/<sc>/g, ";").replace(/<nl>/g, String.fromCharCode(10)) + '\n' + document.theForm.input.value
                plot(999, false, true);
                document.theForm.input.focus()
            }
            // -------------------------------------------------------*/
            function getPosition(event) {
                var x = new Number();
                var y = new Number()

                /* if (event.x != undefined && event.y != undefined)
                { x= event.x; y= event.y;}
                else // Firefox method to get the position
                */
                {
                    var rect = cID.getBoundingClientRect();
                    x = Math.floor(event.clientX + document.body.scrollLeft + document.documentElement.scrollLeft - rect.left)
                    y = Math.floor(event.clientY + document.body.scrollTop + document.documentElement.scrollTop - rect.top)
                }
                // x -= cID.offsetLeft+tID.offsetLeft; y -= cID.offsetTop+tID.offsetTop;

                if (!(x < 0 || y < 0 || x > CXD || y > CYD)) {
                    // document.theForm.debug.value+=event.clientX +", "+ document.body.scrollLeft +", "+ document.documentElement.scrollLeft +", "+ rect.left +", "+ cID.offsetLeft+", "+tID.offsetLeft+"="+x+", "+ C2GX(x)+"\n"

                    if (Math.abs(CXD / 2 - x) < 5 && Math.abs(CYD / 2 - y) < 5) chdim(3, 0.5)
                    else {
                        GXM = C2GX(x);
                        Dx = (GXT - GXF) / 2;
                        GXF = GXM - Dx;
                        GXT = GXM + Dx
                        GYM = C2GY(y);
                        Dy = (GYT - GYF) / 2;
                        GYF = GYM - Dy;
                        GYT = GYM + Dy
                        mGXM = GXM;
                        mGYM = GYM
                        plot(999, true, false)
                    }
                }
            }
            // ----------------------------------------------------------*/main
            drawpoints = []
            loadstuff(true, 'graphdata')
            var cID = document.getElementById("theCanvas")
            var tID = document.getElementById("theTable")
            cID.addEventListener("mousedown", getPosition, false);
            var ctx = cID.getContext("2d")
            cID.f = function() {
                return false;
            } // ie
            cID.onmousedown = function() {
                return false;
            } // mozilla
            // Canvas variables.
            CXW = cID.width;
            CXM = (CXW - 1) / 2;
            CXD = CXW - 1;
            CXD1 = CXD + 1
            CYW = cID.height;
            CYM = (CYW - 1) / 2;
            CYD = CYW - 1;
            CYT = CYD - 1 // needed to flip graph
            // Graph variables
            GXF = -10;
            GXT = 10;
            OPx = 0;
            OPy = 0
            GXM = (GXF + GXT) / 2;
            GXD = (GXT - GXF) / CXD;
            GXW = (GXT - GXF) / 2 // Math.floor(1000*(GXT-GXF)/(CXD))/1000
            GYF = -10;
            GYT = 10
            GYM = (GYF + GYT) / 2;
            GYD = (GYT - GYF) / CYD;
            GYW = (GYT - GYF) / 2 // Math.floor(1000*(GYT-GYF)/(CYD))/1000
            mGXM = undefined
            POIget1 = false;
            POIgetn = false;
            POIx = undefined;
            POIy = undefined
            GXFO = GXF;
            GXTO = GXT;
            GYFO = GYF;
            GYTO = GYT
            GQstack = []
            DOgrid = true

            // COLORS
            axis = "black";
            bgcolour = "#FFB6C1"
            colors = ['Navy', 'red', 'green', 'blue', 'purple', 'chartreuse', 'deeppink', 'teal', 'orange', 'RoyalBlue', 'OliveDrab', 'Magenta', 'DarkCyan', 'Aqua', 'Brown']
            colorI = 0;
            dowhat = 999

            // radians and other settings
            save2pi = document.getElementById("degpisw").value
            hadplot = false;
            border = 2;
            border2 = border + border;
            border3 = border2 + border

            // function work space
            var fofx = "",
                urlline = '',
                trigfactor = 1,
                trigval = 'rad'
            xv = [];
            yv = []
            // --------------------------------------------*/
            gprogs = [];
            gprogsI = 0;
            xpositive = false;
            ypositive = false
            gprogs.push("Sample graphs:\n0) Straight Lines\n1) integrals:\n2) vectors:\n3) derivatives:\n4) Normal Distribution Function:\n5) piecewise functions:\n6) O.D.E. #1:\n7) O.D.E. #2:\n8) Trig equations:\n9) polar coordinates:\nA) feasible regions:\nB) histograms:\nC) multiple stuff combined:\n")
            gprogs.push("Straight lines:\nx:0,10; y:0,10\nTwo points (y= 0.5x +2.5):\nyval(x,1,3,7,6)\n(1,3)(7,6)\npoint slope (y= -2x +15):\nyval(x,5,5,-2)\n(5,5,-6)")
            gprogs.push("integrals:\nx:0 to 7.853981633974483;y:-1 to 10;u:rad\nsin(x)+1\ni:sin(x)+1\n-cos(x)+x+pi/2-(pi/2-1)\n")
            gprogs.push("vectors: (x,y) plus: 1-(x,y), 2-(d,slope), 3-polar, 4-azimuth, 5-compass:\nx:-1 to 9;y:-1 to 9;u:deg\n// (x,y):\nv1:(2,3.464101615137755,-11,  1 )  (-2,-3.4641016151377544) (4,0) (-2,3.4641016151377544)\n// (distance, slope):;\nv2:(3.5,4.464101615137755,-11,  2 )(-4,1.73205081)(4,0)(-4,-1.73205081)\n//(rho, theta standard):\nu:deg;v3:(5,5.464101615137755,-11,  3 )(4,300)(4,180)(4,60)\nu:rad;v3:(5,5.464101615137755-.5)(3,5pi/3)(3,pi)(3,pi/3)\n//(rho, theta azimuth):;\nu:rad;v4:(6.5,6.464101615137755,-11,  4 )(4,5pi/6)(4,3pi/2)(4,pi/6)\nu:deg;v4:(6.5,6.464101615137755-.5)(3,150)(3,270)(3,30)\n//(rho, theta compass):;\nv5:(8,7.464101615137755,-11,  5 )(4,S30E)(4,W)(4,N30E)")
            gprogs.push("derivatives:\nx:0 to 7;y:-9 to 15;\nu:rad\nsin(x)-x-2{#00FF00}\nd:sin(x)-x{#FF0000}\ncos(x)-2{#0000FF}\nsin(x)-x+1{lime}\nd:sin(x)+2x{red}\ncos(x)+1{blue}\n")
            gprogs.push("Normal Distribution Function = d(zcdf)/dx:\nx:-3 to 3; y:-.1 to 1;\nd:zcdf(x)")
            gprogs.push("piecewise functions:\nx:-12 to 14;y:-12 to 14;u:rad\n(3:12):3x/2+5sin(x)-13\n(-2:3):(3-x)(x+2)-8.238320218785281")
            gprogs.push('O.D.E. #1:\nx:-4.5 to 5\ny:-400 to 700\n13x^3 -26x^2 -208x +416\n(-4,0,-5),(-3,455,-5),(-2,624,-5),(-1,585,-5),(0,416,-5),(1,195,-5),(2,0,-5),(3,-91,-5),(4,0,-5),(5,351,-5),(6,1040,-5),(7,2145,-5),(8,3744,-5),(9,5915,-5),(10,8736,-5)\n// m=(y[i+1]-y[i])/(x[i+1]-x[i])\n(-4,455,-5),(-3,169,-5),(-2,-39,-5),(-1,-169,-5),(0,-221,-5),(1,-195,-5),(2,-91,-5),(3,91,-5),(4,351,-5),(5,689,-5),(6,1105,-5),(7,1599,-5),(8,2171,-5)')
            gprogs.push('O.D.E. #2:\nx:-4.5 to 5\ny:-400 to 700\n(-4,455,-5),(-3,169,-5),(-2,-39,-5),(-1,-169,-5),(0,-221,-5),(1,-195,-5),(2,-91,-5),(3,91,-5),(4,351,-5),(5,689,-5),(6,1105,-5),(7,1599,-5),(8,2171,-5)\n39x^2 -52x -208\nd:13x^3 -26x^2 -208x +416\n')
            gprogs.push('Trig equations:\nu:deg\nx:-0.01 to 360.01;y:-10 to 10\n4COS2(X)+3COT(X)SIN(X)-(2COT(X)+TAN(X))')
            gprogs.push("polar coordinates:\np:theta from: thru: x [= H+R*cos(x)]: y [= K+R*sin(x)]:\nu:rad; x:-10 to 2; y:-12 to 0;\np:0:2pi:-4+cos(x)*(3.5+sin(5x)): -6+sin(x)*(3.5+sin(5x))\n(-4,-6,,Q)(-4,-6,5)")
            gprogs.push("feasible regions:\nx:-1 to 9;y:-1 to 9\n>y=-2/3x +6\n<y=1/3x +4; (2,14/3)\n>x=3;(3,4);(3,5);\n<x=8;(8,2/3),(8,20/3)\n>(6,2)(9,4)\n")
            gprogs.push("frequency polygon:\nx:1.5 to 109.5;y:-2 to 18;(10.5, 0,-5)(20.5,8,-5)(30.5,8,-5)(40.5,16,-5)(50.5,15,-5)(60.5,15,-5)(70.5,7,-5)(80.5,16,-5)(90.5,4,-5)(100.5,0,-5)\nhistogram:\n(15.5,8,25.5,0,99)(25.5,8,35.5,0,99)(35.5,16,45.5,0,99)(45.5,15,55.5,0,99)(55.5,15,65.5,0,99)(65.5,7,75.5,0,99)(75.5,16,85.5,0,99)(85.5,4,95.5,0,99)")
            gprogs.push("multiple stuff:\nx:-12 to 14;y:-12 to 14;u:rad\n8-x/1.1+sin(x) \ny= (x4 -34x2 +115)/11 \nf(x)=-(x+7)(x-8)/3 \n(3:12):3x/2+5sin(x)-13\n(-4,6.4,-5,A),(4,-7,,B),(7.5,-3,,C),(10,-6,-5,D)\n(-4,-6,,Q)(-4,-6,5)\n//polar:0:2pi:H+R*cos(x):K+R*sin(x):\npolar:0:2pi:-4+cos(x)*(3.5+sin(5x)):-6+sin(x)*(3.5+sin(5x))\nd:sin(x)+9;intgrl:sin(x)+1\nv3 vector: (5,5.464101615137755)(4,4.1887902047863914)(4,0)(4,2.0943951023931957)")
            ls = decodeURIComponent(location.search)
            // graph?f(x)&x1,x2&y1,y2&f1(x)&etc...
            if (ls.search(/\?/) == 0) {
                lsd = ls.slice(1).split("&")
                for (i = 0; i < 3; i++)
                    if (lsd[i] == undefined) lsd[i] = " "
                document.theForm.input.value = lsd[0]
                if (lsd[1] == ' ') lsd[1] = '-10 to 10';
                document.theForm.xrange.value = lsd[1]
                if (lsd[2] == ' ') lsd[2] = '-10 to 10';
                document.theForm.yrange.value = lsd[2]
                for (i = 3; i < lsd.length; i++) document.theForm.input.value += '\n' + lsd[i]
            }
            plot(999, false, true)
        </script>
    </div>
</body>

</html>