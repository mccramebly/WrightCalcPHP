<!DOCTYPE HTML>
<html>

<head>
    <title>Two Variable Statistics &amp; Regression</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="myfunctions.js"></script>
    <script type="text/javascript" src="matrix.js"></script>
    <script type="text/javascript" src="statfns.js"></script>
    <script>
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
            cumz = 0;
            var i = -1
            while (cumz < o && i < (sd.length - 1)) {
                cumz += sd[++i][2]
            }
            i = Math.min(sd.length - 1, Math.max(0, i));
            qp1 = sd[i][0];
            qp2 = sd[i][2]
            if (cumz - qp2 + 1 > o) i--;
            i = Math.min(sd.length - 1, Math.max(0, i))
            return (qp1 + sd[i][0]) / 2;
        }
        // ----------------------------------------------------------------------------------
        function wsdfind(o) // weighted
        {
            cumz = 0;
            var i = -1
            while (cumz < o && i < (sd.length - 1)) {
                cumz += sd[++i][2]
            }
            i = Math.min(sd.length - 1, Math.max(0, i));
            qp1 = sd[i][0];
            qp2 = sd[i][2]
            if (cumz - qp2 + 1 > o) i--;
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
            window.open('probability.php?' + probmean + '&' + probsdev)
        }
        // ----------------------------------------------------------------------------------
        function calc() {
            with(Math) {
                calced = true;
                frac2 = frac
                document.theForm.output.value = ""
                two = false;
                sd = [
                    []
                ];
                work = document.theForm.input.value + "\\\\"
                work = work.slice(0, work.search(/\\\\/))
                work = work.replace(/^[\n\s]*/, "")
                work = work.replace(/(\n *)*\\/g, "\\")
                work = work.replace(/\\ */g, "\\")
                work = work.replace(/\\\n/g, "\\");
                work = work.replace(/\n/g, ",");
                work = work.replace(/\[/g, "(").replace(/\]/g, ")");
                // document.theForm.output.value += "\n"+work+"\n";
                data = work.split(/\\/);
                // document.theForm.output.value += "  >>>>"+data.length+": "+data+"<<<\n"

                // STEP 1: load data from form

                formulax = "";
                formulay = "";
                formulap = "";
                allformulas = "";
                formulapr2 = 0;
                graphdata = '';
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
                        i = 0;
                        x = vfrom;
                        while (x < vthru + vstep / 2) {
                            if (sd[i] == undefined) sd[i] = [];
                            sd[i][0] = x;
                            i++;
                            x += vstep
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
                two = (sd[0][1] != undefined);
                regord = '';
                i = 0;
                while (sd[i] != undefined && sd[i][6] != undefined) regord += sd[i++][6]
                if (regord.search('-') > -1) regord = regord.slice(0, regord.search('-') + 1) + regord.slice(regord.search('-') + 2)
                sd = sd.sort(function(a, b) {
                    return a[0] - b[0]
                });
                sd[0][0] = Number(sd[0][0]);
                w6 = Number(sd[mm - 1][0]) - sd[0][0]
                if (two) {
                    gyfrom = sd[0][1];
                    gythru = sd[0][1]
                    if (formulax.length > 0) document.theForm.output.value += "(" + formulax + ", " + (formulay.length == 0 ? "y" : formulay) + "):\n";
                    for (i = 0; i < mm; i++) {
                        graphdata += ";(" + myround(sd[i][0]) + "," + myround(sd[i][1]) + ',-5)'
                        if (sd[i][2] == undefined) sd[i][2] = 1;
                        document.theForm.output.value += (i ? ", " : "") + "(" + myround(sd[i][0]) + ", " + myround(sd[i][1]) + ")" + ((sd[i][2] == 1) ? "" : ("{" + sd[i][2] + "}"));
                    }
                    graphdata += ';\n'
                } else {
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
                    for (i = 0; i < mm; i++) {
                        document.theForm.output.value += (i ? ", " : "") + myround(sd[i][0]) + (sd[i][2] == 1 ? "" : ("{" + sd[i][2] + "}"))
                    }
                }
                // input: w0=LL1  w1=UL1  w2 = LL2  // calculated: w3 = class width  w4 = midpoint w5=LB1; w6 smallest diff
                // "only w0" is number of classes.
                w3 = 0;
                w4 = 0
                if (typeof w0 != "undefined") {
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
                    w5 = w0 - (w2 - w1) / 2
                    // generate x's from f's
                    for (i = 0; i < sd.length; i++)
                        if (sd[i][0] == undefined) sd[i][0] = w4 + i * w3
                    // classsify x's from w
                    for (i = 0; i < sd.length; i++) {
                        sd[i][0] = floor((sd[i][0] - w5) / w3) * w3 + w4
                    }
                    i = 1;
                    while (i < mm) {
                        if (sd[i][0] == sd[i - 1][0]) {
                            sd[i - 1][2] = Number(sd[i - 1][2]) + Number(sd[i][2]);
                            sd.splice(i, 1);
                            mm--
                        } else {
                            i++
                        };
                    }
                } else {
                    w0 = 0;
                    w1 = 0;
                    w2 = 0;
                    w3 = 0;
                    w4 = 0;
                    w5 = 0
                }

                if (w0 != w1) {
                    document.theForm.output.value += "\nClasses: "
                    for (i = 0; i < mm; i++) {
                        document.theForm.output.value += (i ? ", " : "")
                        intt = sd[i][0] - w4
                        document.theForm.output.value += "[" + (intt + w0) + (w0 != w1 ? ":" + (intt + w1) : '') + "] "
                        document.theForm.output.value += "{" + sd[i][2] + "}"
                    }
                }
                if (false) {
                    // if (document.theForm.forceogive.checked) { 
                    document.theForm.output.value += "\nOgive (cum freq.): ";
                    og = 0
                    for (i = 0; i < mm; i++) {
                        intt = sd[i][0] - w4
                        document.theForm.output.value += (i ? ", " : "") + "[" + (intt + w0) + (w0 != w1 ? ":" + (intt + w1) : '') + "] "
                        og += sd[i][2];
                        document.theForm.output.value += "{" + og + "}"
                    }
                    og = 0
                    for (i = 0; i < mm; i++) {
                        intt = sd[i][0] - w4;
                        og += sd[i][2]
                        graphdata += '(' + (intt + (w0 + w1) / 2) + ',' + og + ',-5)'
                    }
                    gyfrom = 0
                }
                if (w3 == 0) gxstep = 1;
                else gxstep = w3
                gyfrom = 0;
                gythru = 0;
                gxthru = sd[0][0]
                histdata += '\n'
                if (false) {
                    if (!two) graphdata += '\n(' + (gxthru - gxstep) + ', 0,-5)'
                    for (i = 0; i < mm; i++) {
                        if (!two) graphdata += '(' + sd[i][0] + ',' + sd[i][2] + ',-5)'
                        histdata += '(' + (sd[i][0] - gxstep / 2) + ',' + sd[i][2] + ',' + (sd[i][0] + gxstep / 2) + ',0,99)'
                        if (sd[i][2] > gythru) gythru = sd[i][2]
                        if (document.theForm.forceogive.checked) gythru = og
                    }
                }
                gxthru = sd[mm - 1][0] + gxstep
                if (!two) graphdata += '(' + gxthru + ',0,-5)'

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
                    if (two) {
                        sd[i][1] = Number(sd[i][1]);
                        sy += sd[i][2] * sd[i][1];
                        sxy += sd[i][2] * sd[i][0] * sd[i][1];
                        syy += sd[i][2] * sd[i][1] * sd[i][1];
                        sxxy += sd[i][2] * sd[i][0] * sd[i][0] * sd[i][1]
                        if (sd[i][1] > 0) {
                            sly += sd[i][2] * log(sd[i][1])
                            sxly += sd[i][2] * sd[i][0] * log(sd[i][1])
                            slyly += sd[i][2] * log(sd[i][1]) * log(sd[i][1])
                        }
                    }
                }
                if (false) {
                    // if (document.theForm.relfreq.checked){ 
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
                vari1 = (sxx - sx * sx / m) / (m - 1)
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
                document.theForm.output.value += "\nn= " + m + "; " + Sigma + "x= " + myround(sx) + "; " + mu + " = " + myround(sx / m) + "; " + Sigma + "x" + P2 + "= " + myround(sxx) + "; " + Sigma + "x" + P3 + "= " + myround(sxxx) + "; " + Sigma + "x^4= " + myround(sxxxx);
                if (false) {
                    // if (!two){
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
                        if (sx != 0) document.theForm.output.value += "\n  Coefficient of Variation CV% = " + (myround(sqrt(vari1) * m / sx, 1))
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
                } else {
                    document.theForm.output.value += "\n" + Sigma + "y= " + myround(sy) + "; " + mu + " = " + myround(sy / m) + "; " + "; " + Sigma + "xy = " + myround(sxy) + "; " + Sigma + "y" + P2 + "= " + myround(syy) + "; " + Sigma + "x" + P2 + "y = " + myround(sxxy);
                    document.theForm.output.value += "\n" + Sigma + "log(y)= " + myround(sly) + "; " + Sigma + "x*log(y) = " + myround(sxly) + "; " + Sigma + "log" + P2 + "(y)= " + myround(slyly) + "\n";
                    gxfrom = sd[0][0] - gxstep;
                    gxthru = sd[mm - 1][0] + gxstep
                    gxmargin = (gxthru - gxfrom) / 10;
                    if (gxmargin == 0) gxmargin = gxfrom / 10
                    gxfrom -= gxmargin;
                    gxthru += gxmargin
                    gyfrom = sd[0][1];
                    gythru = gyfrom
                    for (i = 0; i < mm; i++) {
                        if (gyfrom > sd[i][1]) gyfrom = sd[i][1]
                        if (gythru < sd[i][1]) gythru = sd[i][1]
                    }
                    gymargin = (gythru - gyfrom) / 10;
                    if (gymargin == 0) gymargin = gyfrom / 10
                    gyfrom -= gymargin;
                    gythru += gymargin
                    xm = []
                    ym = []
                    tm = ["Constant", "Linear", "Quadratic", "Cubic", "Fourth Order", "Fifth Order"]
                    dmf = 0;
                    dmt = min(9, mm)
                    for (dm = abs(dmf); dm < dmt; dm++) {
                        if (regord.length > 0)
                            if (regord.search(dm) == -1) continue
                        if (tm[dm] == undefined) tm[dm] = dm + "-th order"
                        k = 0
                        for (i = 0; i < mm; i++) {
                            k1 = sd[i][2]
                            while (k1 > 0) {
                                xm[k] = [];
                                xm[k][0] = 1;
                                for (j = 1; j <= dm; j++) {
                                    xm[k][j] = xm[k][j - 1] * sd[i][0]
                                }
                                ym[k] = [sd[i][1]];
                                k1--;
                                k++
                            }
                        }
                        xmt = Mtran(xm)
                        am = Mmul(Minv(Mmul(xmt, xm)), Mmul(xmt, ym))
                        if (abs(am[am.length - 1][0]) < .00000001 && ((dm + 1 < dmt) || (formulap.length > 0))) continue
                        ypoly1 = "";
                        ypoly2 = ""
                        for (i = am.length - 1; i >= 0; i--) {
                            ypoly1 += xterm(ypoly1.length == 0, am[i][0], i, false)
                            ypoly2 += xterm(ypoly2.length == 0, am[i][0], i, true)
                        }
                        yt = 0;
                        for (i = 0; i < ym.length; i++) yt = yt + ym[i][0];
                        yt = yt / ym.length
                        yt1 = 0;
                        yt2 = 0
                        for (i = 0; i < ym.length; i++) {
                            yt2 = yt2 + (ym[i][0] - yt) * (ym[i][0] - yt);
                            X = xm[i][1];
                            yt3 = eval(cleanx(ypoly1));
                            yt1 = yt1 + (ym[i][0] - yt3) * (ym[i][0] - yt3)
                        }
                        if (dm != 1) {
                            r2 = 1 - yt1 / yt2;
                            r1 = sqrt(abs(r2))
                        } else {
                            r1 = (mm * sxy - sx * sy) / (sqrt(mm * sxx - sx * sx) * sqrt(mm * syy - sy * sy));
                            r2 = r1 * r1
                        }
                        if (m > 2) {
                            t2 = r2 / ((1 - r2) / (m - 2))
                            if (t2 >= 0) {
                                t1 = myround(sqrt(t2), 5)
                                document.theForm.output.value += tm[dm] + " regression: y = "
                                document.theForm.output.value += ypoly1
                                allformulas += '\n' + ypoly1
                                if (ypoly1 != ypoly2) document.theForm.output.value += " = " + ypoly2
                                document.theForm.output.value += "\nr^2= " + myround(r2, 8) + "; r= " + myround(r1, 8)
                                if (r2 < 1) document.theForm.output.value += "; t= " + t1 + "; α = P(x>" + myround(myround(sqrt(t2 / m)), 8) + ") = P(t>" + t1 + ")=" + myround(1 - tcdf(sqrt(t2), m - 2))
                                document.theForm.output.value += "; d.f.=" + (m - 2) + "\n"
                            }
                        }
                        if (r2 > formulapr2) {
                            formulapr2 = r2;
                            formulap = ypoly1
                        }
                    }
                    // exponential regression
                    formulapc = cleanx(formulap) {
                        a1 = (m * sxly - sx * sly) / (m * sxx - sx * sx)
                        a0 = sly / m - a1 * sx / m
                        r1 = (m * sxly - sx * sly) / sqrt((m * sxx - sx * sx) * (m * slyly - sly * sly))
                        r2 = r1 * r1;
                        if ((r2 > formulapr2 && regord == '') || regord.search('-') > -1) {
                            formulapr2 = r2;
                            formulapc = "myround(exp(a0)*pow(exp(a1),X))";
                            formulap = myround(exp(a0)) + "(" + myround(exp(a1)) + ")^x"
                            document.theForm.output.value += "Exponential regression: y = " + formulap
                            document.theForm.output.value += "\n = " + exp(a0) + "(" + exp(a1) + ")^x"
                            if (m > 2) {
                                t2 = r2 / ((1 - r2) / (m - 2))
                                if (t2 >= 0) {
                                    t1 = myround(sqrt(t2), 5)
                                    document.theForm.output.value += "\nr^2= " + myround(r2) + "; t= " + t1 + "; α = P(x>" + myround(myround(sqrt(t2 / m)), 5) + ") = P(t>" + t1 + ")=" + myround(1 - tcdf(sqrt(t2), m - 2)) + "; d.f.=" + (m - 2)
                                }
                            }
                            document.theForm.output.value += "\n"
                        }
                    } //  y = a*b^x
                    if (mm > 1 && regord.search('-') > -1) {
                        exr = sd[0][0];
                        exs = sd[1][0];
                        ext = sd[2][0];
                        exry = sd[0][1];
                        exsy = sd[1][1];
                        exty = sd[2][1]
                        exz = (exty - exry) / (exsy - exry);
                        exx = 1 + pow(exz * (exs - exr) / (ext - exr), (1 / (ext - exs))) // initial guess for b is zero slope plus 1
                        do {
                            exm = exz * (exs - exr) * pow(exx, (exs - exr - 1)) - (ext - exr) * pow(exx, (ext - exr - 1)) // slope at exx
                            exy = exz * pow(exx, (exs - exr)) - pow(exx, (ext - exr)) - exz + 1 // y value
                            exv = exy - exm * exx; // y intercept
                            exx = -exv / exm
                        } while (abs(exy) > .000001)
                        exa = (exsy - exry) / (pow(exx, exs) - pow(exx, exr));
                        exb = exx;
                        exc = exry - (exa * pow(exb, exr))
                        formulapc = "myround(exa*pow(exb,X)+exc)"
                        formulap = "(" + myround(exb) + ")^x "
                        if (abs(exc) > .00000001) formulap += "+" + myround(exc)
                        if (abs(exa - 1) > .00000001) formulap = myround(exa) + formulap
                        document.theForm.output.value += "Q&D Exponential regression: y = " + formulap
                        document.theForm.output.value += "\n = " + exa + "(" + exb + ")^x+" + exc
                        document.theForm.output.value += "\n"
                    } //  y = a*b^x + c
                } // end of two
                if (formulap.length > 0) {
                    for (i = 0; i < mm; i++) {
                        X = sd[i][0];
                        Y = eval(formulapc)
                        document.theForm.output.value += (i ? ", " : "Predicted: " + formulap + "\n") + "(" + myround(X) + ", " + myround(Y) + ")"
                    }
                    graphparm = "x: " + gxfrom + " to " + gxthru + ';y: ' + gyfrom + " to " + gythru + ';' + graphdata + '\n' + allformulas
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
                    if (false) {
                        // if (!two && m>4 )
                        {
                            gymid = (gyfrom + gythru) / 2;
                            graphbox = ''
                            graphbox += '\n(' + q1 + ', ' + (gymid + gypad) + '),(' + q3 + ', ' + (gymid + gypad) + ')(' + q3 + ', ' + (gymid - gypad) + ')(' + q1 + ', ' + (gymid - gypad) + ')(' + q1 + ', ' + (gymid + gypad) + ');(' + q0 + ', ' + gymid + ',, Q0),(' + q1 + ', ' + gymid + ',, Q1);(' + q3 + ', ' + gymid + ',, Q3),(' + q4 + ', ' + gymid + ',, Q4); (' + q2 + ', ' + (gymid + 2 * gypad) + ')(' + q2 + ', ' + (gymid - 2 * gypad) + ',, Q2);' + '(' + q0 + ', ' + (gymid + 4 * gypad) + ',,' + q0 + ');' + '(' + q1 + ', ' + (gymid + 4 * gypad) + ',,' + q1 + ');' + '(' + q2 + ', ' + (gymid + 4 * gypad) + ',,' + q2 + ');' + '(' + q3 + ', ' + (gymid + 4 * gypad) + ',,' + q3 + ');' + '(' + q4 + ', ' + (gymid + 4 * gypad) + ',,' + q4 + ');'
                        }
                        gyfrom -= gypad;
                        gythru += gypad
                        if (grph == 1) graphparm = "x: " + gxfrom + " to " + gxthru + ';y: ' + gyfrom + " to " + gythru + ';' + graphdata + allformulas // graphs
                        if (grph == 2) graphparm = "x: " + gxfrom + " to " + gxthru + ';y: ' + gyfrom + " to " + gythru + ';' + histdata + formulap + allformulas // histogram
                        if (grph == 3) graphparm = "x: " + gxfrom + " to " + gxthru + ';y: ' + gyfrom + " to " + gythru + ';' + graphbox // box and whiskers
                        val1 = escape(graphparm.replace(/\n/g, "<nl>").replace(/;/g, "<sc>"))
                        localStorage.setItem("graphdata", val1)
                    }
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
                if (grph == 5) { // quadratic spline
                    s = '';
                    for (i = 0; i < sd.length; i++) {
                        s += '(' + sd[i][0] + ',' + sd[i][1] + ')'
                    }
                    savestuff('graphdata', s)
                }
                document.theForm.input.focus()
                // if (document.theForm.stemleaf.checked){
                if (false) {
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
        <h1>Two Variable Statistics &amp; Regression</h1>
        <form name="theForm">
            <textarea id="output" name="output" rows=25 cols=80 tabindex=0>Notes on input:
 x: var 1 list \y: var 2 list \f: frequency list \
 xy, xf, xyf: x list combined with y or f lists\
 o: order for polynomial regression
 u: from,thru,step; additional predicted values to display
 v: from,thru,step; values to generate x from y or f; defaults 0,10,1
 w: # classes or class limits for the first class
use ',' or ';' or ':' or '(' or ')' or 'cr' or ' ' or 'tab' for delimiters
x= f(x) to transform x values
y= f(x) to generate y values
use [] for function parameters such as: sqrt[3]
</textarea>
            <textarea id="input" name="input" rows=4 cols=80 tabindex="1" onKeyUp="enter(event)">
x:  \y:  \f:  \xy:  \xf:  \xyf:  \o: 1 \u:  \v:  \w:  \x=  \y=  \\

 x: var 1 list \y: var 2 list \f: frequency list \
 xy, xf, xyf: x list combined with y or f lists\
 o: order for polynomial regression
 u: from,thru,step; additional predicted values to display
 v: from,thru,step; values to generate x from y or f; defaults 0,10,1
 w: # classes or class limits for the first class
 x= f(x) to transform x values
 y= f(x) to generate y values
</textarea>
            <input id="calc1" name="calc1" class="calcButton" type="button" value="Calculate" onClick="calc()" tabindex="3">
            <div id="saveload">
                <input name="savebut" Value="Save" type="button" onClick="savestuff(); document.theForm.input.focus()" />
                <input name="loadbut" Value="Load" type="button" onClick="loadstuff(); document.theForm.input.focus(); calc()" />
                <input type="button" value="%" id="frac" onClick="swfrac((frac2>3?2:frac2+1))" title="output format" />
            </div>
        </form>
        <div class="pass">
            <h2>Use These Calculations With:</h2>
            <ul>
                <li><a href="#" onClick="grph=1; calc(); window.open('graphs.php')" class="isDisabled">Line Graph</a></li>
                <li><a href="#" onClick="grph=5; calc(); window.open('q.spline.php'+'?&')" class="isDisabled">Q-Spline</a></li>
            </ul>
        </div>
        <div class="other">
            <h2>Other Resources</h2>
            <ul>
                <li><a href="stats.php">One Variable Statistics</a></li>
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
            for (i = 0; i < 8; i++)
                if (lsd[i] == undefined) lsd[i] = ""
            document.theForm.input.value = "x:" + lsd[0] + " \\y: " + lsd[1] + " \\f: " + lsd[2] + " \\xy: " + lsd[3] + " \\xf: " + lsd[4] + " \\xyf: " + lsd[5] + " \\o: " + lsd[6] + " \\u:  \\v:  \\w: " + lsd[7] + " \\x=  \\y=  \\\\\n  x: var 1 list \y: var 2 list \f: frequency list \ xy, xf, xyf: x list combined with y or f lists\n o: order for polynomial regression\n u: from,thru,step; additional predicted values to display\n v: from,thru,step; values to generate x from y or f; defaults 0,10,1\n w: # classes or class limits for the first class\nx= f(x) to transform x values\ny= f(x) to generate y values"
            calc()
        }
    </script>
</body>

</html>