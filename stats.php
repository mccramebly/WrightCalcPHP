<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>One Variable Statistics</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="myfunctions.js"></script>
    <script type="text/javascript" src="matrix.js"></script>
    <script type="text/javascript" src="statfns.js"></script>
    <script type="text/javascript">
        probmean = 0
        probsdev = 0
        Sigma = String.fromCharCode(931);
        sigma = String.fromCharCode(963);
        mu = String.fromCharCode(956);
        plusminus = String.fromCharCode(177)
        P2 = String.fromCharCode(178);
        P3 = String.fromCharCode(179);
        F2 = String.fromCharCode(189);
        radical = String.fromCharCode(8730)
        degrees = true
        sdn = ["x", "y", "f", "w", "v", "u"]
        sd = [
            []
        ]
        sdo = []
        lsd = []
        exis = 0
        // ----------------------------------------------------------------------------------
        function sdfind(o) {
            cumf = 0;
            var i = -1
            while (cumf < o && i < (sd.length - 1)) {
                cumf += sd[++i][2]
            }
            i = Math.min(sd.length - 1, Math.max(0, i));
            qp1 = sd[i][0];
            qp2 = sd[i][2]
            if (cumf - qp2 + 1 > o) i--;
            i = Math.min(sd.length - 1, Math.max(0, i))
            return (qp1 + sd[i][0]) / 2;
        }
        // ----------------------------------------------------------------------------------
        function wsdfind(o) // weighted
        {
            cumf = 0;
            var i = -1
            while (cumf < o && i < (sd.length - 1)) {
                cumf += sd[++i][2]
            }
            i = Math.min(sd.length - 1, Math.max(0, i));
            qp1 = sd[i][0];
            qp2 = sd[i][2]
            if (cumf - qp2 + 1 > o) i--;
            i = Math.min(sd.length - 1, Math.max(0, i))
            return (qp1 * qp2 + sd[i][2] * sd[i][0]) / (sd[i][2] + qp2);
        }
        // ----------------------------------------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) {
                if (calced) callprob();
                else calc()
            }
            if (charCode == 27) cla();
        }
        // ----------------------------------------------------------------------------------
        function cla() {
            document.theForm.output.value = saveOutput
            document.theForm.input.focus()
        };
        // ----------------------------------------------------------------------------------
        function callprob() {
            window.open('continuous.php?' + probmean + '&' + probsdev)
        }
        // ----------------------------------------------------------------------------------
        function calc() {
            with(Math) {
                calced = true;
                frac2 = frac
                document.theForm.output.value = ""
                sd = [
                    []
                ];
                work = document.theForm.input.value + "\\\\"
                work = work.slice(0, work.search(/\\\\/))
                work = work.replace(/^[\n\s]*/, "")
                work = work.replace(/(\n *)*\\/g, "\\")
                work = work.replace(/\\ */g, "\\")
                work = work.replace(/\\\n/g, "\\");
                work = work.replace(/{/g, ",");
                work = work.replace(/}/g, ",");
                work = work.replace(/\n/g, ",");
                work = work.replace(/\[/g, "(").replace(/\]/g, ")");
                // document.theForm.output.value += "\n"+work+"\n";
                data = work.split(/\\/);

                // STEP 1: load data from form
                formulax = "";
                formulay = "";
                formulap = "";
                allformulas = "";
                formulapr2 = 0;
                graphdata = '';
                graph2data = '';
                graphparm = '';
                formulapc = '';
                gxstep = 1;
                graphbox = '';
                histdata = '';
                Piechart = ''
                for (i = 0; i < data.length; i++) // data sets (eg):  x: 1,2,3\
                {
                    if (data[i].search(/=/) > -1) {
                        if (data[i].search(/x=/) > -1) formulax = cleanx(data[i].substr(data[i].search(/x=/) + 2).replace(/[A-Z]/g, "X"))
                        if (data[i].search(/y=/) > -1) formulay = cleanx(data[i].substr(data[i].search(/y=/) + 2).replace(/[A-Z]/g, "X"))
                        // if (data[i].search(/z=/)>-1) formulaz=data[i].substr(data[i].search(/z=/)+2).replace(/[A-Z]/g,"X")
                        continue;

                    }
                    sdv = data[i].split(/:/);
                    sdv[0] = sdv[0].replace(' ', '')
                    if (sdv[0].search(/[uvwxyfo]/) == 0) {
                        sdt = sdv[0];
                        sdv.splice(0, 1);
                    } else sdt = "x";
                    // sdv = sdv.join(":").replace(/[a-z]/ig,'').split(/[\(\) ,;:|\t{}]/)
                    sdv = sdv.join(":").replace(/[a-z]/ig, '').split(/[\(\) ,;:|\t]/)
                    sdt = sdt.replace(/x/ig, "0");
                    sdt = sdt.replace(/y/ig, "1");
                    sdt = sdt.replace(/f/ig, "2");
                    sdt = sdt.replace(/w/ig, "3");
                    sdt = sdt.replace(/v/ig, "4");
                    sdt = sdt.replace(/u/ig, "5");
                    sdt = sdt.replace(/o/ig, "6")
                    j = 0;
                    k = -1;
                    m1 = sdt.length - 1; // sdt.length = # values per data set
                    for (j = 0; j < sdv.length; j++) {
                        if (sdv[j].length) {
                            if (sdv[j].search(/{/) > -1) {
                                sdvt = sdv[j].split(/[{}]/);
                                sdv[j] = sdvt[0];
                                jk = Number(sdvt[1]);
                                while (jk > 1) {
                                    jk--;
                                    sdv.push(sdvt[0])
                                }
                            }
                            m1 = (m1 + 1) % sdt.length;
                            m2 = parseInt(sdt.charAt(m1));
                            k += (m1 == 0);
                            if (sd[k] == undefined) sd[k] = []
                            if (sd[k][m2] == undefined) {
                                sd[k][m2] = cleanx(sdv[j], true, false)
                            } else {
                                alert("duplicate input value ignored: " + sdv[j])
                            }
                        }
                    }
                }

                // STEP2: generate additional data
                w0 = undefined;
                w1 = undefined;
                w2 = undefined
                if (sd.length > 0 && sd[0][3] != undefined) w0 = eval(sd[0][3])
                if (sd.length > 1 && sd[1][3] != undefined) w1 = eval(sd[1][3])
                if (sd.length > 2 && sd[2][3] != undefined) {
                    w2 = eval(sd[2][3]);
                    vfrom = (w0 + w1) / 2;
                    vstep = w2 - w0
                } else {
                    vfrom = 0;
                    vstep = 1;
                    vthru = 10
                }
                if (sd[0][4] != undefined) {
                    vfrom = eval(sd[0][4])
                    if (sd[1] != undefined)
                        if (sd[1][4] != undefined) {
                            vthru = eval(sd[1][4])
                        }
                    if (sd[2] != undefined)
                        if (sd[2][4] != undefined) {
                            vstep = eval(sd[2][4])
                        }
                }
                ufrom = undefined;
                ustep = 1;
                uthru = 0;
                if (sd[0][5] != undefined) {
                    ufrom = eval(sd[0][5]);
                    uthru = ufrom
                    if (sd[1] != undefined)
                        if (sd[1][5] != undefined) {
                            uthru = eval(sd[1][5])
                            if (sd[2] != undefined)
                                if (sd[2][5] != undefined) {
                                    ustep = eval(sd[2][5])
                                }
                        }
                }
                if (sd[0][0] == undefined) {
                    if (sd[0][1] == undefined && sd[0][2] == undefined) {
                        td = [19, 26, 48, 45, 50, 56, 35, 10, 10, 35, 67, 66, 46, 35, 35, 29, 10, 65, 66, 35];
                        document.theForm.input.value = "x: 19,26,48,45,50,56,35,10,10,35,67,66,46,35,35,29,10,65,66,35 \n \\f:  \\xf:  \\v:  \\w:  \\x=  \\\\"
                        i = 0;
                        while (i < td.length) {
                            if (sd[i] == undefined) sd[i] = [];
                            sd[i][0] = td[i];
                            i++
                        }
                    } else {
                        i = 0;
                        x = vfrom;
                        while (sd[i] != undefined) {
                            sd[i][0] = x;
                            i++;
                            x += vstep
                        }
                    }
                }
                if (formulax.length > 0) {
                    for (i = 0; i < sd.length; i++) {
                        X = sd[i][0];
                        sd[i][0] = eval(formulax)
                    }
                }
                for (i = 0; i < sd.length; i++)
                    if (sd[i][2] == undefined) sd[i][2] = 1

                if (formulay.length > 0) {
                    for (i = 0; i < sd.length; i++) {
                        X = sd[i][0];
                        sd[i][1] = eval(formulay)
                    }
                }
                mm = 0
                for (j = 1; j < sd.length; j++)
                    if (sd[j][0] != undefined) mm = j
                mm++;
                document.theForm.output.value += "Data: "

                // save and process data
                sdo = [];
                for (i = 0; i < sd.length; i++) sdo[i] = sd[i].slice(0)
                regord = '';
                i = 0;
                while (sd[i] != undefined && sd[i][6] != undefined) regord += sd[i++][6]
                if (regord.search('-') > -1) regord = regord.slice(0, regord.search('-') + 1) + regord.slice(regord.search('-') + 2)
                sd = sd.sort(function(a, b) {
                    return a[0] - b[0]
                });
                sd[0][0] = Number(sd[0][0]);
                w6 = Number(sd[mm - 1][0]) - sd[0][0] {
                    if (sd[0][2] == undefined) sd[0][2] = 1;
                    sd[0][0] = Number(sd[0][0])
                    i = 1;
                    while (i < mm) {
                        if (sd[i][2] == undefined) sd[i][2] = 1;
                        sd[i][0] = Number(sd[i][0])
                        if (sd[i][0] == sd[i - 1][0]) {
                            sd[i - 1][2] = Number(sd[i - 1][2]) + Number(sd[i][2]);
                            sd.splice(i, 1);
                            mm--
                        } else {
                            w6a = sd[i][0] - sd[i - 1][0];
                            i++;
                            if (w6a < w6) w6 = w6a
                        };
                    }
                    dofreq = false;
                    for (i = 0; i < mm; i++)
                        if (sd[i][2] != 1) dofreq = true
                    for (i = 0; i < mm; i++) {
                        document.theForm.output.value += (i ? ", " : "") + myround(sd[i][0]) + (!dofreq ? "" : ("{" + sd[i][2] + "}"))
                    }
                }
                // input: w0=LL1  w1=UL1 calculated: w2 = LL2  w3 = class width  w4 = midpoint w5=LB1 w6=UB1
                // "only w0" is number of classes.
                // sd[i]:  0=x; 1=y; 2=f; 3=w [class limits] ; 4=v [additional x's to generate]; 5=u [additional predictions]; 6=o [regression order]
                if (typeof w0 == "undefined") {
                    w0 = 0;
                    w1 = 0;
                    w2 = 0;
                    w3 = 0;
                    w4 = 0;
                    w5 = 0
                } else {
                    if (typeof w1 == "undefined") {
                        w1 = sd[0][0];
                        w2 = sd[mm - 1][0]
                        w3 = (1 + w2 - w1) / (w0);
                        if (w3 > 1) w3 = Math.ceil(w3)
                        w0 = w1;
                        w1 = w1 + w3 - 1;
                        w2 = undefined
                    }
                    if (typeof w2 == "undefined") w2 = w1 + 1
                    w3 = w2 - w0;
                    w4 = (w0 + w1) / 2;
                    w5 = w0 - (w2 - w1) / 2;
                    w6 = w1 + (w2 - w1) / 2
                    // change w's so that sd[0][0] is between w5 and w6
                    while (w6 < sd[0][0]) {
                        w0 += w3;
                        w1 += w3;
                        w2 += w3;
                        w4 += w3;
                        w5 += w3;
                        w6 += w3
                    }
                    while (w5 > sd[0][0]) {
                        w0 -= w3;
                        w1 -= w3;
                        w2 -= w3;
                        w4 -= w3;
                        w5 -= w3;
                        w6 -= w3
                    }
                    // classsify x's from w's
                    sd[0][0] = w4
                    for (i = 1; i < sd.length; i++) {
                        if (sd[i][0] < (w5 + i * w3)) {
                            sd[i - 1][2] = Number(sd[i - 1][2]) + Number(sd[i][2]);
                            sd.splice(i, 1);
                            mm--;
                            i--
                        } // add f to prior and reduce # of x's
                        else if (sd[i][0] > (w6 + i * w3)) {
                            sd.splice(i, 0, [w4 + i * w3, , 0]);
                            mm++;
                            i--
                        } else sd[i][0] = sd[i - 1][0] + w3
                    }
                }

                if (w0 != w1) {
                    document.theForm.output.value += "\nClasses: "
                    for (i = 0; i < mm; i++) {
                        document.theForm.output.value += (i ? ", " : "") + "[" + (w0 + w3 * i) + ":" + (w1 + w3 * i) + "] " + "{" + sd[i][2] + "}"
                    }
                }

                if (document.theForm.forceogive.checked) {
                    document.theForm.output.value += "\nOgive (cum freq.): ";
                    og = 0
                    for (i = 0; i < mm; i++) {
                        og += sd[i][2];
                        if (w0 != w1) document.theForm.output.value += (i ? ", " : "") + "[" + (w0 + w3 * i) + ":" + (w1 + w3 * i) + "] " + "{" + og + "}"
                        else document.theForm.output.value += (i ? ", " : "") + sd[i][0] + "{" + og + "}"
                        graph2data += '(' + (sd[i][0]) + ',' + og + ',-5)'
                    }
                }

                if (w3 == 0) gxstep = 1;
                else gxstep = w3
                gxgx = 0
                gyfrom = 0;
                gythru = 0;
                gxthru = sd[0][0]
                histdata += '\n'
                graphdata += '\n(' + (gxthru - gxstep) + ', 0,-5)'
                for (i = 0; i < mm; i++) {
                    graphdata += '(' + sd[i][0] + ',' + sd[i][2] + ',-5)'
                    histdata += '(' + (sd[i][0] - gxstep / 2 - gxgx) + ',' + sd[i][2] + ',' + (sd[i][0] + gxstep / 2 + gxgx) + ',0,99)'
                    if (sd[i][2] > gythru) gythru = sd[i][2]
                    if (document.theForm.forceogive.checked) gythru = og
                }
                gxthru = sd[mm - 1][0] + gxstep
                graphdata += '(' + gxthru + ',0,-5)'

                sx = 0;
                sy = 0;
                sxx = 0;
                sxy = 0;
                syy = 0;
                m = 0;
                sly = 0;
                sxly = 0;
                slyly = 0;
                sxxx = 0;
                sxxxx = 0;
                sxxy = 0;
                for (i = 0; i < mm; i++) {
                    sd[i][0] = Number(sd[i][0]);
                    m += sd[i][2];
                    sx += sd[i][2] * sd[i][0];
                    sxx += sd[i][2] * sd[i][0] * sd[i][0];
                    sxxx += sd[i][2] * sd[i][0] * sd[i][0] * sd[i][0];
                    sxxxx += sd[i][2] * sd[i][0] * sd[i][0] * sd[i][0] * sd[i][0];
                }
                m = myround(m, 10)
                if (document.theForm.relfreq.checked) {
                    document.theForm.output.value += "\nRel Frq: ";
                    for (i = 0; i < mm; i++) {
                        intt = sd[i][0] - w4
                        document.theForm.output.value += (i ? ", " : "") + "[" + (intt + w0) + (w0 != w1 ? ":" + (intt + w1) : '') + "] " + "{" + my(sd[i][2] / m) + "}";
                    }
                    if (document.theForm.forceogive.checked) {
                        document.theForm.output.value += "\nCum rel frq: ";
                        og = 0
                        for (i = 0; i < mm; i++) {
                            intt = sd[i][0] - w4
                            document.theForm.output.value += (i ? ", " : "") + "[" + (intt + w0) + (w0 != w1 ? ":" + (intt + w1) : '') + "] "
                            og += sd[i][2] / m;
                            document.theForm.output.value += "{" + my(og) + "}"
                        }
                    }
                }

                vari = (sxx - sx * sx / m) / m;
                vari1 = (m != 1 ? (sxx - sx * sx / m) / (m - 1) : vari)
                var mode = [];
                var modecnt = 0;
                for (i = 0; i < mm; i++) {
                    if (sd[i][2] > modecnt) {
                        var mode = [(sd[i][0])];
                        modecnt = sd[i][2];
                    } else if (sd[i][2] == modecnt) {
                        mode[mode.length] = sd[i][0];
                    }
                }
                // MEDIANS
                m1 = m + 1;
                q2 = m1 / 2;
                q1 = floor(q2 + 0.5) / 2;
                q3 = m1 - q1;
                q0 = 1;
                q4 = m;
                if (q3 > m) q3 = m
                q0 = sdfind(q0);
                q1 = sdfind(q1);
                q2 = sdfind(q2);
                q3 = sdfind(q3);
                q4 = sdfind(q4);
                iqr = q3 - q1
                document.theForm.output.value += "\nn= " + m + "; " + Sigma + "x= " + myround(sx) + "; " + mu + " = " + myround(sx / m) + "; " + Sigma + "x" + P2 + "= " + myround(sxx) + "; " + Sigma + "x" + P3 + "= " + myround(sxxx) + "; " + Sigma + "x^4= " + myround(sxxxx); {
                    document.theForm.output.value += "\nMean(" + mu + ")= " + myround(sx / m) + "; "
                    probmean = sx / m;
                    probsdev = sqrt(vari1)
                    document.theForm.output.value += "median= " + myround(q2)
                    document.theForm.output.value += "; mid-range= " + myround((sd[mm - 1][0] + sd[0][0]) / 2) + "; "
                    if (mode.length == 1) {
                        document.theForm.output.value += "Mode= " + mode[0]
                    } else if (mode.length == 2) {
                        document.theForm.output.value += "Bimodal, Modes= " + mode
                    } else {
                        document.theForm.output.value += "No Mode"
                    }
                    if (m > 1) {
                        document.theForm.output.value += "\nStandard Deviation for a sample: " + sigma + "n-1 = " + myround(sqrt(vari1)) + "; Variance: (" + sigma + "n-1)" + P2 + "= " + myround(vari1)
                        if (sx != 0) document.theForm.output.value += "\nCoefficient of Variation CV% = " + (myround(sqrt(vari1) * m / sx, 1))
                        if (sx != 0) document.theForm.output.value += "\nCoefficient of Skewness = " + (myround(3 * (sx / m - q2) / sqrt(vari1)))
                    }
                    document.theForm.output.value += "\nFor the entire population: " + sigma + "= " + myround(sqrt(vari)) + "; " + sigma + P2 + "= " + myround(vari);
                    if (sx != 0) document.theForm.output.value += "; CV% = " + (myround(sqrt(vari) * m / sx, 1))
                    document.theForm.output.value += "\nrange= " + myround(sd[mm - 1][0] - sd[0][0]) + "; Probably "
                    if ((sx / m < q2) && (q2 < mode[0])) {
                        document.theForm.output.value += "left"
                    } else if ((sx / m > q2) && (q2 > mode[0])) {
                        document.theForm.output.value += "right"
                    } else {
                        document.theForm.output.value += "right"
                    }
                    document.theForm.output.value += " skewed.\n" {
                        document.theForm.output.value += "Quartiles: Q0= " + myround(q0) + ", Q1= " + myround(q1) + ", Q2= " + myround(q2) + ", Q3= " + myround(q3) + ", Q4= " + myround(q4) + ", IQR= " + myround(iqr) + "\n";
                        document.theForm.output.value += "Inner fence: " + myround(q1 - 1.5 * iqr) + " to " + myround(q3 + 1.5 * iqr) + ", Outer fence: " + myround(q1 - 3 * iqr) + " to " + myround(q3 + 3 * iqr) + "\ndeciles: "
                        for (i = 1; i < 10; i++) document.theForm.output.value += 'D' + i + '=' + sdfind(floor(i * m / 10 + 1)) + (i < 9 ? ", " : "")
                        document.theForm.output.value += "\n"
                    } {
                        wq2 = m1 / 2;
                        wq1 = floor(wq2 + 0.5) / 2;
                        wq3 = m1 - wq1;
                        if (wq3 > m) wq3 = m;
                        wq0 = wsdfind(1);
                        wq1 = wsdfind(wq1);
                        wq2 = wsdfind(wq2);
                        wq3 = wsdfind(wq3);
                        wq4 = wsdfind(m)
                        document.theForm.output.value += "Weighted Quartiles: Q0= " + myround(wq0) + ", Q1= " + myround(wq1) + ", Q2= " + myround(wq2) + ", Q3= " + myround(wq3) + ", Q4= " + myround(wq4) + ", IQR= " + myround(wq3 - wq1) + "\n";
                    }
                    if (document.theForm.percentile.value != '') {
                        eval('percentile=' + document.theForm.percentile.value)
                        m1 = floor(m * percentile / 100 + 1)
                        if (m1 < m) document.theForm.output.value += percentile + " percentile is " + sdfind(m1) + "\n"
                    }
                }
                if (formulap.length > 0) {
                    for (i = 0; i < mm; i++) {
                        X = sd[i][0];
                        Y = eval(formulapc)
                        document.theForm.output.value += (i ? ", " : "Predicted: " + formulap + "\n") + "(" + myround(X) + ", " + myround(Y) + ")"
                    }
                    graphparm = "x: " + gxfrom + " to " + gxthru + ';y: ' + gyfrom + " to " + gythru + ';' + graphdata + '\n' + formulap + allformulas
                    val1 = escape(graphparm.replace(/\n/g, "<nl>").replace(/;/g, "<sc>"))
                    localStorage.setItem("graphdata", val1)
                    if (typeof ufrom != "undefined") {
                        document.theForm.output.value += "\n";
                        i = 0
                        for (X = ufrom; X < uthru + ustep / 2; X += ustep) {
                            document.theForm.output.value += (i ? ", " : "") + "(" + myround(X) + ", " + myround(eval(formulapc)) + ")"
                            i++
                        }
                    }
                    document.theForm.output.value += "\n"
                }
                if (graphdata != '') {
                    gxfrom = sd[0][0] - gxstep;
                    gxthru = sd[mm - 1][0] + gxstep
                    gxpad = (gxthru - gxfrom) / 10
                    gxfrom -= gxpad;
                    gxthru += gxpad
                    gypad = (gythru - gyfrom) / 8
                    if (m > 4) {
                        gymid = (gyfrom + gythru) / 2;
                        graphbox = ''
                        graphbox += '\n(' + q1 + ', ' + (gymid + gypad) + '),(' + q3 + ', ' + (gymid + gypad) + ')(' + q3 + ', ' + (gymid - gypad) + ')(' + q1 + ', ' + (gymid - gypad) + ')(' + q1 + ', ' + (gymid + gypad) + ');(' + q0 + ', ' + gymid + ',, Q0),(' + q1 + ', ' + gymid + ',, Q1);(' + q3 + ', ' + gymid + ',, Q3),(' + q4 + ', ' + gymid + ',, Q4); (' + q2 + ', ' + (gymid + 2 * gypad) + ')(' + q2 + ', ' + (gymid - 2 * gypad) + ',, Q2);' + '(' + q0 + ', ' + (gymid + 4 * gypad) + ',,' + q0 + ');' + '(' + q1 + ', ' + (gymid + 4 * gypad) + ',,' + q1 + ');' + '(' + q2 + ', ' + (gymid + 4 * gypad) + ',,' + q2 + ');' + '(' + q3 + ', ' + (gymid + 4 * gypad) + ',,' + q3 + ');' + '(' + q4 + ', ' + (gymid + 4 * gypad) + ',,' + q4 + ');'
                    }
                    gyfrom -= gypad;
                    gythru += gypad
                    if (grph == 1) graphparm = "x: " + gxfrom + " to " + gxthru + ';y: ' + gyfrom + " to " + gythru + ';' + graphdata + formulap + allformulas
                    if (grph == 2) {
                        graphparm = "x: " + gxfrom + " to " + gxthru + ';y: ' + gyfrom + " to " + gythru + ';' + '\nfrequency polygon:\n' + graphdata + '\nhistogram:\n' + histdata
                        if (graph2data.length > 0) graphparm += '\nogive:\n' + graph2data
                        graphparm += formulap + allformulas
                    }
                    if (grph == 3) graphparm = "x: " + gxfrom + " to " + gxthru + ';y: ' + gyfrom + " to " + gythru + ';' + graphbox
                    val1 = escape(graphparm.replace(/\n/g, "<nl>").replace(/;/g, "<sc>"))
                    localStorage.setItem("graphdata", val1)
                }
                if (grph == 4) { // pie chart
                    Piechart = "x:-1 to 11;y:-1 to 11;u:deg;(5,5,4)"
                    s = 0;
                    for (i = 0; i < sd.length; i++) {
                        s += 360 * sd[i][2] / m
                        Piechart += ";v3:(5,5)(4," + s + ",," + sd[i][0] + ': ' + my(sd[i][2] / m, true) + ")"
                    }
                    savestuff('graphdata', Piechart)
                }

                document.theForm.input.focus()
                if (document.theForm.stemleaf.checked) {
                    now = ''
                    for (i = 0; i < sdo.length; i++)
                        for (j = 0; j < sdo[i][2]; j++) now += sdo[i][0] + ',';
                    if (now.search(/\|/) < 0) {
                        if (now.search(/{/) > -1) {
                            nowl = '';
                            now = now.replace(/ /ig, '')
                            while (now.length > 0) {
                                while (now[0] == ',') now = now.slice(1)
                                nownum = ''
                                while (now.search(/\d/) == 0) {
                                    nownum += now[0];
                                    now = now.slice(1)
                                }
                                if (now[0] == "{") {
                                    nowfreq = '';
                                    now = now.slice(1)
                                    while (now[0] != "}") {
                                        nowfreq += now[0];
                                        now = now.slice(1)
                                    }
                                    now = now.slice(1);
                                    nowfreq = Number(nowfreq)
                                } else nowfreq = 1
                                while (nowfreq > 0) {
                                    nowfreq--;
                                    nowl = nowl + nownum + ','
                                }
                            }
                            now = nowl
                        }
                        now = now.replace(/.*:/g, '')
                        now = now.replace(/[^\.\w]/g, ",").replace(/,+/g, ',').replace(/^ */, '').replace(/^,/, '')
                        eval('p1 = [' + now + ']');
                        p1.sort(function(a, b) {
                            return a - b
                        })
                        n = p1.length;
                        pppd = 0;
                        p = [];
                        now = ''
                        for (i = 0; i < n; i++) {
                            pis = p1[i].toString();
                            if (pis.search(/\./) > -1) pppd = max(pppd, pis.length - pis.lastIndexOf("."));
                            p[i] = pis
                        }
                        if (pppd > 0)
                            for (i = 0; i < n; i++) {
                                if (p[i].lastIndexOf(".") == -1) p[i] += '.';
                                while (p[i].length - p[i].lastIndexOf(".") < pppd) p[i] += '0'
                            }
                        pppl = p[0].length;
                        ppps = pppl;
                        for (i = 0; i < n; i++)
                            if (p[i] != undefined) {
                                pppl = max(pppl, p[i].length);
                                ppps = min(ppps, p[i].length)
                            }
                        if (ppps > 1) ppps--
                        for (i = 0; i < n; i++)
                            while (p[i].length < pppl) p[i] = ' ' + p[i]
                        ppp1 = 'XX';
                        pppw = pppl - ppps; // document.theForm.input.value+= '\nis:  '+pppl+';'+ppps+';'+pppw+';'+pppd+';\n'
                        for (i = 0; i < n; i++) {
                            pp1 = p[i].slice(0, pppw);
                            pp2 = p[i].slice(pppw)
                            if (pp1 != ppp1) {
                                now += '\n' + pp1 + ' |';
                                ppp1 = pp1
                            }
                            now += ' ' + pp2
                        }
                        document.theForm.output.value += now + '\n'
                    } else {
                        now = ""
                        for (i = 0; i < nowl.length; i++) {
                            nowli = nowl[i].replace(/\|/g, ":")
                            nowli1 = nowli.search(/:/)
                            nowlis = (nowli.slice(0, nowli1)).replace(/ /g, "")
                            nowlil = (" " + nowli.slice(nowli1 + 1) + " ").replace(/  +/g, " ")
                            nowlil = nowlil.slice(1, nowlil.length - 1)
                            nowlill = nowlil.split(/ /)
                            while (nowlill.length > 0) {
                                nowlilll = nowlill.shift();
                                if (nowlilll.length > 0) now += "," + nowlis + nowlilll
                            }
                        }
                        document.theForm.output.value += now.replace(/,,+/g, ",").slice(1);
                    }
                }
                document.theForm.output.focus()
            }
        }
        // ---------------------------------------------------*/
    </script>
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/simple-calc-style.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus();document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <div id="calctainer">
        <a href="index.php"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <h1>One Variable Statistics</h1>
        <form name="theForm">
            <textarea id="output" name="output">Input for 1 var stats:
 x: var 1 list; f: frequency list; xf: x list combined with f list
 v: from,thru,step; values to generate x; defaults 0,10,1
 w: # classes or class limits for the first class
use ',' or ';' or ':' or '(' or ')' or 'cr' or ' ' or 'tab' for delimiters
x= f(x) to transform x values
use [] for function parameters such as: sqrt[3]
</textarea>
            <textarea id="input" name="input" tabindex="1" onKeyUp="enter(event)">
x:  \f:  \xf:  \v:  \w:  \x=  \\
</textarea>

            <input class="calcButton" id="calculate" name="calc1" type="button" value="Calculate" onClick="calc()" tabindex="3">
            <div id="buttons">
                <label for="percentile">Percentile:</label>
                <input type="text" id="percentile" name="percentile" size="4" value="" title="Percentile" />
                <input type=checkbox id="stemleaf" name="stemleaf" title='stem & leaf' onClick="calc()" />
                <label for="stemleaf">Stem &amp; Leaf</label>
                <input type=checkbox id="relfreq" name="relfreq" onclick='calc()' title="relative frequency" />
                <label for="relfreq">Relative Frequency</label>
                <input type=checkbox id="forceogive" name="forceogive" title="cumulative frequency" onClick="calc()" />
                <label class="last" for="forceogive">Ogive</label>
            </div>
            <div id="saveload">
                <input name="savebut" Value="Save" type="button" onClick="savestuff(); document.theForm.input.focus()" />
                <input name="loadbut" Value="Load" type="button" onClick="loadstuff(); document.theForm.input.focus(); calc()" />
                <input type="button" value="%" id="frac" onClick="swfrac((frac2>3?2:frac2+1))" title="output format">
            </div>
        </form>
        <div class="pass">
            <h2>Use These Calculations With:</h2>
            <ul>
                <li><a href="#" onClick="grph=2; calc(); window.open('graphs.php')">Bar Graph</a></li>
                <li><a href="#" onClick="grph=3; calc(); window.open('graphs.php')">Box &amp; Whiskers Chart</a></li>
                <li><a href="#" onClick="grph=4; calc(); window.open('graphs.php')">Pie Chart</a></li>
                <li><a href="#" onClick="calc(); callprob()">Probability Calculations</a></li>
            </ul>

        </div>
        <div class="other">
            <h2>Other Resources</h2>
            <ul>
                <li><a href="regress.php">2 Var Statistics &amp; Regression</a></li>
            </ul>
        </div>


    </div>
    <script>
        grph = 1;
        calced = false;
        frac = 4;
        frac2 = 4
        saveOutput = document.theForm.output.value
        ls = decodeURIComponent(location.search)
        if (ls.search(/\?/) == 0) {
            lsd = ls.slice(1).split("&")
            if (lsd.length == 1 && lsd[0][0] == '\\') document.theForm.input.value = lsd[0]
            else {
                for (i = 0; i < 6; i++)
                    if (lsd[i] == undefined) lsd[i] = ""
                document.theForm.input.value = "x:" + lsd[0] + " \\f: " + lsd[1] + " \\xf: " + lsd[2] + "\\v: " + lsd[3] + "  \\w: " + lsd[4] + " \\x= " + lsd[5] + "\\\\"
            }
            document.theForm.input.value += "\n x: var 1 list; f: frequency list; xf: x list combined with f list;\n v: from,thru,step; values to generate x; defaults 0,10,1\n w: # classes or class limits for the first class"
            calc();
            document.theForm.input.setSelectionRange(0, 0)
        }
    </script>

</body>

</html>