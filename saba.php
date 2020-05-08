<!DOCTYPE html>
<html lang="en">

<head>
    <title>Distance between two points</title>
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
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
            plotfunction(999, true, false)
        }
        // -------------------------------------------------------*/
        function rightfunc() {
            Dx = (GXT - GXF) / 4;
            GXF = GXF + Dx;
            GXT = GXT + Dx
            plotfunction(999, true, false)
        }
        // -------------------------------------------------------*/
        function upfunc() {
            Dy = (GYT - GYF) / 4;
            GYF = GYF + Dy;
            GYT = GYT + Dy
            plotfunction(999, true, false)
        }
        // -------------------------------------------------------*/
        function downfunc() {
            Dy = (GYT - GYF) / 4;
            GYF = GYF - Dy;
            GYT = GYT - Dy
            plotfunction(999, true, false)
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
                plotfunction(999, true, false)
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
            document.theForm.input.value = ''
            GXF = -10;
            GXT = 10;
            GYF = -10;
            GYT = 10;
            plotfunction(999, true, false);
            document.theForm.input.focus()
        }
        // -------------------------------------------------------*/
        function chdim(xy, factor) {
            recalc()
            if (xy & 1) {
                GXF = GXM - factor * GXW;
                GXT = GXM + factor * GXW
            }
            if (xy & 2) {
                GYF = GYM - factor * GYW;
                GYT = GYM + factor * GYW
            }
            plotfunction(999, true, false)
        }
        // -------------------------------------------------------*/
        function centerfunc() {
            with(Math) {
                GXMO = GXM
                if (GXT == -GXF && GYT == -GYF) {
                    GXF = GXFO;
                    GXT = GXTO;
                    GYF = GYFO;
                    GYT = GYTO
                } else {
                    GXFO = GXF;
                    GXTO = GXT;
                    GYFO = GYF;
                    GYTO = GYT
                    GXT = (GXT - GXF) / 2, GYT = (GYT - GYF) / 2
                    while (GXTO > GXT || GXFO < -GXT || GYTO > GYT || GYFO < -GYT) {
                        GXT *= 2;
                        GYT *= 2
                    }
                    GXF = -GXT;
                    GYF = -GYT
                }
                plotfunction(999, true, false)
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
                else plotfunction(999, true, false)
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
                plotfunction(999, true, false)
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
        /* function grid(){DOgrid=!DOgrid; plotfunction(999,false,true)}
        // -------------------------------------------------------*/
        function doaxis() {
            with(Math) {
                // x axis

                Mx = (GXT - GXF) / 10;
                MxL = log(Math.abs(Mx)) / log(10);
                MxL1 = Math.floor(MxL);
                Mx = myround(Math.pow(10, MxL - MxL1))
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
                MyL = log(Math.abs(My)) / log(10);
                MyL1 = Math.floor(MyL);
                My = round(Math.pow(10, MyL - MyL1))
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
        }
        // -------------------------------------------------------*/
        function myround(x) {
            return x
        }
        // -------------------------------------------------------*/
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) plotfunction(999, false, true)
            if (charCode == 27) clrscr()
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
        function plotpoint(Px, Py, Pz, Pw) {
            ctx.beginPath()
            // if (Pw!=undefined){
            ctx.font = "bold 20px Serif";
            ctx.fillStyle = 'red'
            ctx.fillText(Pw, G2CX(Px) + 5, G2CY(Py) + 15)
            if (Pz == undefined || Pz == 0) Pz = -5
            if (Pz == 0) {
                ctx.arc(G2CX(Px), G2CY(Py), border2, 0, 2 * Math.PI, false)
                ctx.fillStyle = 'red'
            } else if (Pz < 0) {
                ctx.strokeStyle = 'red';
                ctx.arc(G2CX(Px), G2CY(Py), -Pz, 0, 2 * Math.PI, false);
                ctx.fill();
                ctx.stroke()
            } else if (((GYD * .9) < GXD) && (GXD < (GYD * 1.1))) {
                ctx.strokeStyle = red;
                ctx.arc(G2CX(Px), G2CY(Py), Pz / GXD, 0, 2 * Math.PI, false);
                ctx.stroke()
            }
        }
        // --------------------------------------------*/
        function plotfunction(todo, move, getnewx) {
            with(Math) {
                OPx = 0;
                OPy = 0;
                colorI = 0;
                didsteps = 1;
                didany = false;
                hadsteps = 0;
                if (todo != 0) dowhat = todo
                ctx.fillStyle = "#FFFFFF";
                ctx.fillRect(0, 0, CXD, CYD)
                doaxis()
                return
            }
        }
        // -------------------------------------------------------*/
        function randomize() {
            with(Math) {
                document.theForm.x1.value = floor(-40 + 80 * random())
                document.theForm.y1.value = floor(-40 + 80 * random())
                document.theForm.x2.value = floor(-40 + 80 * random())
                document.theForm.y2.value = floor(-40 + 80 * random())
                calc()
            }
        }
        // -------------------------------------------------------*/
        function calc() {
            with(Math) {
                x1 = eval(document.theForm.x1.value)
                y1 = eval(document.theForm.y1.value)
                x2 = eval(document.theForm.x2.value)
                y2 = eval(document.theForm.y2.value)
                document.theForm.dist.value = sqrt((x1 - x2) * (x1 - x2) + (y1 - y2) * (y1 - y2))
                document.theForm.slope.value = (y1 - y2) / (x1 - x2)
                xrange = abs(x1 - x2);
                yrange = abs(y1 - y2)
                xfrom = min(x1, x2) - xrange / 10;
                xthru = max(x1, x2) + xrange / 10
                yfrom = min(y1, y2) - yrange / 10;
                ythru = max(y1, y2) + yrange / 10
                xfrom = -50;
                xthru = 50
                yfrom = -50;
                ythru = 50

                // Graph variables
                GXF = xfrom;
                GXT = xthru
                GXM = (GXF + GXT) / 2;
                GXD = (GXT - GXF) / CXD;
                GXW = (GXT - GXF) / 2 // Math.floor(1000*(GXT-GXF)/(CXD))/1000
                GYF = yfrom;
                GYT = ythru
                GYM = (GYF + GYT) / 2;
                GYD = (GYT - GYF) / CYD;
                GYW = (GYT - GYF) / 2 // Math.floor(1000*(GYT-GYF)/(CYD))/1000
                mGXM = undefined
                GQstack = []
                DOgrid = true
                plotfunction()
                color = 'red'
                plotpoint(x1, y1, -5, '')
                plotpoint(x2, y2, -5, '')

                ctx.beginPath();
                ctx.strokeStyle = 'blue';
                ctx.lineWidth = 4
                ctx.moveTo(G2CX(x1), G2CY(y1))
                ctx.lineTo(G2CX(x2), G2CY(y2))
                ctx.stroke();



            }
        }
    </script>
</head>

<body onLoad="self.focus()">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">

            <h2>First Point:</h2><label>X1</label><input name="x1" size=35 value="" /><label>Y1</label><input name="y1" size=35 value="" />
            <h2>Second Point:</h2> <label>X2</label><input name="x2" size=35 value="" /><label>Y2</label><input name="y2" size=35 value="" />

            <label>Length:</label><input name="dist" value="">
            <label>Slope:</label><input name="slope" value="">

            <label>&nbsp;</label><input name="calcbut" value="Calculate" onclick="calc()" type="button"><input name="randomizebut" value="Randomize" onclick="randomize()" type="button">
            <td rowspan=11><canvas id="theCanvas" width="501" height="501"></canvas>
        </form>
    </div>
    <script>
        // -------------------------------------------------------*/
        function getPosition(event) {
            var x = new Number();
            var y = new Number()

            /* if (event.x != undefined && event.y != undefined)
            { x = event.x; y = event.y;}
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
                    plotfunction(999, true, false)
                }
            }
        }
        // ------------*/main
        // loadstuff(true,'graphdata')
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
        GXF = -50;
        GXT = 50;
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
        POIshow = false;
        POIx = undefined;
        POIy = undefined
        GXFO = GXF;
        GXTO = GXT;
        GYFO = GYF;
        GYTO = GYT
        GQstack = []
        DOgrid = true

        // COLORS
        axis = "black"
        colors = ['Navy', 'red', 'green', 'blue', 'cyan', 'purple', 'chartreuse', 'deeppink', 'teal', 'orange', 'RoyalBlue', 'OliveDrab', 'Magenta', 'DarkCyan', 'Aqua', 'Brown']
        colorI = 0
        border = 3;
        border2 = border + border;
        border3 = border2 + border

        plotfunction()
    </script>
</body>

</html>