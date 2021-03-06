<!-- saved from url=(0045)http://faculty.ccc.edu/jnadas/js/generate.htm -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Generate Sample Space</title>
    <script src="myfunctions.js"></script>
    <script>
        list = [];
        ddPV = [];
        ddT = [];
        ddPVn = 0;
        Nval = 0;
        Rval = 0;
        qRval = 0;
        frac = 3;
        oldNval = Nval;
        oldRval = Rval;
        dd = [];
        listall = []
        mu = String.fromCharCode(956);
        qwhat = 2;
        what = 2;
        whatt = ['', 'nPr', 'nCr', 'Words', 'powerset', 'Binomial']
        // --------------------------------------------------- */
        function enter1(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13 || charCode == 9) doInput();
            if (charCode == 27) document.theForm.output.value = '';
        };
        // --------------------------------------------------- */
        function enter2(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13 || charCode == 9) doNval();
            if (charCode == 27) document.theForm.output.value = '';
        };
        // --------------------------------------------------- */
        function cla() {
            document.theForm.input.value = '';
            document.theForm.inputP.value = '';
            document.theForm.output.value = '';
            document.theForm.Nval.value = '';
            document.theForm.Rval.value = '';
            document.theForm.Nvalt[0].checked = true;
            what = 2
            document.theForm.rad1[0].checked = true;
            what = 2
            document.theForm.Nval.focus()
        };
        // --------------------------------------------------- */
        function gener(v, w, rr) {
            // document.theForm.output.value += "\n"+v+" :: "+w
            if (v.length < 1 || rr < 1) {
                if (rr == 0) list.push(w);
                return
            }
            for (var i = 0; i < v.length; i++) {
                if (what == 1) {
                    v1 = v.slice(0);
                    v1.splice(i, 1)
                } else if (what == 3) v1 = v
                else v1 = v.slice(i + 1)
                w1 = w.slice(0);
                w1.push(v[i])
                gener(v1, w1, rr - 1)
            }
        }
        // --------------------------------------------------- */
        function Pascal() {
            document.theForm.output.value += "\nPascal's triangle  nCr(r,c)\n"
            rline = '';
            for (j = 0; j <= Nval; j++) rline += ncr(Nval, j) + ' '
            for (r = 0; r <= Nval; r++) {
                pline = '';
                for (j = 0; j <= r; j++) pline += ncr(r, j) + ' '
                document.theForm.output.value += pad('', (rline.length - pline.length) / 2) + pline + "\n"
            }
            document.theForm.output.value = document.theForm.output.value.slice(0, -2)
            dobinomial()
        }
        // --------------------------------------------------- */
        function doP(vn, k) {
            if (k == 1) return vn + ' ';
            if (k > 1) return vn + "^" + k + ' ';
            return ""
        }

        function dobinomial() {
            document.theForm.output.value += "\n(x+y)^" + Nval + " = "
            for (j = Nval; j >= 0; j--)
                document.theForm.output.value += (j < Nval ? '+' : '') + ((bco = ncr(Nval, j)) == 1 ? '' : bco) + doP('x', j) + doP('y', Nval - j)
        }
        // --------------------------------------------------- */
        function calc(dolist) {
            with(Math) {
                if (document.theForm.output.value.slice(0, 17) == 'Advanced options:') document.theForm.output.value = ''
                doInput();
                recalc = document.theForm.output.value == '' || document.theForm.input.value == ''
                /* if (doall)
                {Tots=0; document.theForm.input.value=''; document.theForm.inputP.value=''; document.theForm.output.value=''} */
                dd = []
                doNval();
                Rval = document.theForm.Rval.value
                recalc = recalc || oldNval != Nval || oldRval != Rval
                extra = document.theForm.extra.value.replace(/ /g, "")
                list = [];
                aa = []

                data = document.theForm.inputP.value.replace(/ /g, ",").replace(/\n/g, ",").replace(/[,;]+/g, ",").replace(/^,/, "").replace(/,$/, "")
                document.theForm.inputP.value = data
                ddP = data.split(/[,\n]/);
                ddPVn = 0;
                ddPtot = 0
                for (i = 0; i < ddP.length; i++) ddPtot += eval(ddP[i])
                if (!isNaN(ddPtot))
                    for (i = 0; i < ddP.length; i++) {
                        ddPV[dd[i]] = eval(ddP[i]) / ddPtot;
                        ddPVn++
                    }
                dd = dd.sort()

                if (isNaN(eval(Rval))) Rval = ''
                if (what < 3 && (Rval <= 0 || Rval > Nval)) Rval = 2
                document.theForm.Rval.value = Rval
                if (recalc) {
                    oldNval = Nval;
                    oldRval = Rval
                    document.theForm.output.value += "\nnPr= " + npr(Nval, Rval) //what==1
                    document.theForm.output.value += "; nCr= " + ncr(Nval, Rval) //what==2
                    document.theForm.output.value += "; n!= " + fact(Nval)
                    document.theForm.output.value += "; words: n^r= " + Math.pow(Nval, Rval) //what==3
                    document.theForm.output.value += "; Power Set: 2^n= " + Math.pow(2, Nval) //what==4
                    if (Nval < 10) dobinomial() //what==5
                }
                if (what == 1) {
                    document.theForm.output.value += '\nhowmany = nPr(' + Nval + ',' + Rval + ')= ' + npr(Nval, Rval);
                    howmany = npr(Nval, Rval)
                } else if (what == 2) {
                    document.theForm.output.value += '\nhowmany = nCr(' + Nval + ',' + Rval + ')= ' + ncr(Nval, Rval);
                    howmany = ncr(Nval, Rval)
                } else if (what == 3) {
                    document.theForm.output.value += '\nhowmany = n^r = ' + Math.pow(Nval, Rval);
                    howmany = Math.pow(Nval, Rval)
                } else if (what == 4) {
                    document.theForm.output.value += '\nhowmany = 2^n = ' + Math.pow(2, Nval);
                    howmany = Math.pow(2, Nval)
                } else if (what == 5) {
                    document.theForm.output.value += '\nhowmany = nCr(' + Nval + ',' + Rval + ')= ' + ncr(Nval, Rval);
                    howmany = ncr(Nval, Rval)
                }
                // ---------------------------
                if (dolist) {
                    if (what == 5) Pascal()
                    else if (what == 4)
                        for (Rval = 0; Rval <= Nval; Rval++) gener(dd, aa, Rval)
                    else gener(dd, aa, Rval)
                    list = list.sort()
                    if (extra == '1') {
                        listall = [];
                        for (j = 0; j < list.length; j++) listall.push(list[j].join(','))
                        listall = listall.sort()
                        for (j = 1; j < listall.length; j++) {
                            if (listall[j] == listall[j - 1]) {
                                listall.splice(j, 1);
                                j = j - 1
                            }
                        }
                        list = [];
                        for (j = 0; j < listall.length; j++) list.push((listall[j].length == 0 ? [] : listall[j].split(',')))
                    }
                }
                // ------------------------ regx include / exclude
                regxn = document.theForm.regxn.value
                regxy = document.theForm.regxy.value
                if (regxn != '') {
                    document.theForm.output.value += "; remove match for " + regxn
                    var re = new RegExp(regxn)
                    for (j = 0; j < list.length; j++) {
                        if (list[j].join('').search(re) > -1) {
                            list.splice(j, 1);
                            j = j - 1
                        }
                    }
                }
                if (regxy != '') {
                    document.theForm.output.value += "; only include match for " + regxy
                    var re = new RegExp(regxy)
                    for (j = 0; j < list.length; j++) {
                        if (list[j].join(',').search(re) < 0) {
                            list.splice(j, 1);
                            j = j - 1
                        }
                    }
                }
                // ------------------------ remove repeats
                if (extra == '2') {
                    document.theForm.output.value += "; remove adjacent repeats"
                    for (j = 0; j < list.length; j++) {
                        for (k = 1; k < list[j].length; k++) {
                            if (list[j][k - 1] == list[j][k]) {
                                list.splice(j, 1);
                                j = j - 1;
                                break
                            }
                        }
                    }
                }
                // ------------------------ remove adjacents
                if (extra == '3') {
                    document.theForm.output.value += "; remove adjacent consecutive numbers"
                    for (j = 0; j < list.length; j++) {
                        for (k = 1; k < list[j].length; k++) {
                            if (Math.abs(list[j][k - 1] - list[j][k]) < 2) {
                                list.splice(j, 1);
                                j = j - 1;
                                break
                            }
                        }
                    }
                }
                // ------------------------ count duplicate deals
                if (extra == '4') {
                    document.theForm.output.value += "; count how many duplicate deals"
                    list.sort()
                    var kk = list[0].length
                    for (j = 0; j < list.length; j++) {
                        list[j].push(1)
                        if (j == 0) continue
                        for (k = 0; k < kk; k++) {
                            if (list[j - 1][k] != list[j][k]) break
                        }
                        if (k == kk) {
                            list[j - 1][kk]++
                            list.splice(j, 1);
                            j = j - 1
                        }
                    }
                }
                // ------------------------ count duplicate hands
                if (extra == '5') {
                    document.theForm.output.value += "; count how many duplicate hands"
                    for (j = 0; j < list.length; j++) {
                        list[j] = list[j].sort()
                    }
                    list.sort()
                    var kk = list[0].length
                    for (j = 0; j < list.length; j++) {
                        list[j].push(1)
                        if (j == 0) continue
                        for (k = 0; k < kk; k++) {
                            if (list[j - 1][k] != list[j][k]) break
                        }
                        if (k == kk) {
                            list[j - 1][kk]++
                            list.splice(j, 1);
                            j = j - 1
                        }
                    }
                }
                // --------------------------  prob summary
                if (ddPVn >= Nval) {
                    ddGT = 0;
                    ddT = [];
                    for (j = 0; j <= Nval; j++) ddT[j] = 0
                    for (j = 0; j < list.length; j++) {
                        lj = list[j];
                        ljp = 1
                        for (k = 0; k < lj.length; k++) ljp *= ddPV[lj[k]]
                        ddPV[lj.join()] = ljp;
                        ddT[lj.length] += ljp;
                        ddGT += ljp
                    }
                    document.theForm.output.value += "\nProbabilities: "
                    for (j = 0; j < Nval; j++) document.theForm.output.value += (j > 0 ? ', ' : '') + "P(" + dd[j] + ")=" + my(ddPV[dd[j]])
                    if (list.length > 0) {
                        for (i = 0; i < ddT.length; i++) document.theForm.output.value += (i == 0 ? "\n" : ", ") + "P(" + i + ")=" + my(ddT[i] / ddGT)
                        document.theForm.output.value += ', ' + Sigma + "(P)= 1.00\n"
                    }
                    for (j = 0; j < list.length; j++) {
                        lj = list[j];
                        listall = "" + lj.join()
                        if (!document.theForm.commas.checked) listall = listall.replace(/,/g, "")
                        document.theForm.output.value += listall + "(" + my(ddPV[lj.join()] / ddGT) + "); "
                    }
                } else if (list.length > 0) { // ------------------------ print list
                    Totline = "\n" + whatt[what] + ": items=" + list.length
                    // if (Tots==0) Tots=list.length; else {Tots*=list.length; Totline+=" ("+Tots+")"}
                    document.theForm.output.value += Totline + ": "
                    listall = ""
                    for (j = 0; j < list.length; j++) listall += list[j] + "; "
                    if (extra == '4' || extra == '5') listall = listall.replace(/,([^,]+);/g, "($1);")
                    if (!document.theForm.commas.checked) listall = listall.replace(/,/g, "")
                    document.theForm.output.value += listall
                }
                // ------------------------ count number of items in their original position
                if (extra == '6') {
                    cnt = [];
                    for (cnti = 0; cnti <= Nval; cnti++) cnt[cnti] = 0
                    for (j = 0; j < list.length; j++) {
                        cnt1 = 0
                        for (k = 0; k < Nval; k++)
                            if (dd[k] == list[j][k]) cnt1++
                        document.theForm.output.value += "\n" + list[j] + ":  " + cnt1
                        cnt[cnt1]++
                    }
                    document.theForm.output.value += "\nX   N(X)"
                    for (cnti = 0; cnti <= Nval; cnti++) document.theForm.output.value += "\n" + cnti + "  " + cnt[cnti]
                }
                // -------------------------- end
                document.theForm.output.value += "\n"
                document.theForm.input.focus();
            }
        };
        // --------------------------------------------------- */
        function qcalc(dolist) {
            with(Math) {
                /* if (doall)
                {Tots=0; document.theForm.input.value=''; document.theForm.inputP.value=''; document.theForm.output.value=''} */
                dd = []
                doqNval();
                qRval = document.theForm.qRval.value
                recalc = recalc || oldRval != qRval
                extra = document.theForm.extra.value.replace(/ /g, "")
                list = [];
                aa = []

                data = document.theForm.inputP.value.replace(/ /g, ",").replace(/\n/g, ",").replace(/[,;]+/g, ",").replace(/^,/, "").replace(/,$/, "")
                document.theForm.inputP.value = data
                ddP = data.split(/[,\n]/);
                ddPVn = 0;
                ddPtot = 0
                for (i = 0; i < ddP.length; i++) ddPtot += eval(ddP[i])
                if (!isNaN(ddPtot))
                    for (i = 0; i < ddP.length; i++) {
                        ddPV[dd[i]] = eval(ddP[i]) / ddPtot;
                        ddPVn++
                    }
                dd = dd.sort()

                if (isNaN(eval(qRval))) qRval = ''
                if (what < 3 && (qRval <= 0 || qRval > Nval)) qRval = 3
                document.theForm.qRval.value = qRval
                if (recalc) {
                    oldRval = qRval
                    document.theForm.output.value += "\nnPr= " + npr(Nval, qRval) //what==1
                    document.theForm.output.value += "; nCr= " + ncr(Nval, qRval) //what==2
                    document.theForm.output.value += "; n!= " + fact(Nval)
                    document.theForm.output.value += "; words: n^r= " + Math.pow(Nval, qRval) //what==3
                    document.theForm.output.value += "; Power Set: 2^n= " + Math.pow(2, Nval) //what==4
                    if (Nval < 10) dobinomial() //what==5
                }
                if (qwhat == 1) {
                    document.theForm.output.value += '\nqhowmany = nPr(' + Nval + ',' + qRval + ')= ' + npr(Nval, qRval);
                    qhowmany = npr(Nval, qRval)
                } else if (qwhat == 2) {
                    document.theForm.output.value += '\nqhowmany = nCr(' + Nval + ',' + qRval + ')= ' + ncr(Nval, qRval);
                    qhowmany = ncr(Nval, qRval)
                } else if (qwhat == 3) {
                    document.theForm.output.value += '\nqhowmany = n^r = ' + Math.pow(Nval, qRval);
                    qhowmany = Math.pow(Nval, qRval)
                } else if (qwhat == 4) {
                    document.theForm.output.value += '\nqhowmany = 2^n = ' + Math.pow(2, Nval);
                    qhowmany = Math.pow(2, Nval)
                } else if (qwhat == 5) {
                    document.theForm.output.value += '\nqhowmany = nCr(' + Nval + ',' + qRval + ')= ' + ncr(Nval, qRval);
                    qhowmany = ncr(Nval, qRval)
                }
                if (document.theForm.qop[0].checked) document.theForm.output.value += '\nhowmany+qhowmany = ' + (howmany + qhowmany)
                else if (document.theForm.qop[1].checked) document.theForm.output.value += '\nhowmany-qhowmany = ' + (howmany - qhowmany)
                else if (document.theForm.qop[2].checked) document.theForm.output.value += '\nhowmany*qhowmany = ' + (howmany * qhowmany)

                // ---------------------------
                if (dolist) {
                    if (what == 5) Pascal()
                    else if (what == 4)
                        for (Rval = 0; Rval <= Nval; Rval++) gener(dd, aa, Rval)
                    else gener(dd, aa, Rval)
                    list = list.sort()
                }

                if (extra == '1') {
                    listall = [];
                    for (j = 0; j < list.length; j++) listall.push(list[j].join(','))
                    listall = listall.sort()
                    for (j = 1; j < listall.length; j++) {
                        if (listall[j] == listall[j - 1]) {
                            listall.splice(j, 1);
                            j = j - 1
                        }
                    }
                    list = [];
                    for (j = 0; j < listall.length; j++) list.push((listall[j].length == 0 ? [] : listall[j].split(',')))
                }
                // ------------------------ regx include / exclude
                regxn = document.theForm.regxn.value
                regxy = document.theForm.regxy.value
                if (regxn != '') {
                    document.theForm.output.value += "; remove match for " + regxn
                    var re = new RegExp(regxn)
                    for (j = 0; j < list.length; j++) {
                        if (list[j].join('').search(re) > -1) {
                            list.splice(j, 1);
                            j = j - 1
                        }
                    }
                }
                if (regxy != '') {
                    document.theForm.output.value += "; only include match for " + regxy
                    var re = new RegExp(regxy)
                    for (j = 0; j < list.length; j++) {
                        if (list[j].join(',').search(re) < 0) {
                            list.splice(j, 1);
                            j = j - 1
                        }
                    }
                }
                // ------------------------ remove repeats
                if (extra == '2') {
                    document.theForm.output.value += "; remove adjacent repeats"
                    for (j = 0; j < list.length; j++) {
                        for (k = 1; k < list[j].length; k++) {
                            if (list[j][k - 1] == list[j][k]) {
                                list.splice(j, 1);
                                j = j - 1;
                                break
                            }
                        }
                    }
                }
                // ------------------------ remove adjacents
                if (extra == '3') {
                    document.theForm.output.value += "; remove adjacent consecutive numbers"
                    for (j = 0; j < list.length; j++) {
                        for (k = 1; k < list[j].length; k++) {
                            if (Math.abs(list[j][k - 1] - list[j][k]) < 2) {
                                list.splice(j, 1);
                                j = j - 1;
                                break
                            }
                        }
                    }
                }
                // ------------------------ count duplicate deals
                if (extra == '4') {
                    document.theForm.output.value += "; count how many duplicate deals"
                    list.sort()
                    var kk = list[0].length
                    for (j = 0; j < list.length; j++) {
                        list[j].push(1)
                        if (j == 0) continue
                        for (k = 0; k < kk; k++) {
                            if (list[j - 1][k] != list[j][k]) break
                        }
                        if (k == kk) {
                            list[j - 1][kk]++
                            list.splice(j, 1);
                            j = j - 1
                        }
                    }
                }
                // ------------------------ count duplicate hands
                if (extra == '5') {
                    document.theForm.output.value += "; count how many duplicate hands"
                    for (j = 0; j < list.length; j++) {
                        list[j] = list[j].sort()
                    }
                    list.sort()
                    var kk = list[0].length
                    for (j = 0; j < list.length; j++) {
                        list[j].push(1)
                        if (j == 0) continue
                        for (k = 0; k < kk; k++) {
                            if (list[j - 1][k] != list[j][k]) break
                        }
                        if (k == kk) {
                            list[j - 1][kk]++
                            list.splice(j, 1);
                            j = j - 1
                        }
                    }
                }
                // --------------------------  prob summary
                if (ddPVn >= Nval) {
                    ddGT = 0;
                    ddT = [];
                    for (j = 0; j <= Nval; j++) ddT[j] = 0
                    for (j = 0; j < list.length; j++) {
                        lj = list[j];
                        ljp = 1
                        for (k = 0; k < lj.length; k++) ljp *= ddPV[lj[k]]
                        ddPV[lj.join()] = ljp;
                        ddT[lj.length] += ljp;
                        ddGT += ljp
                    }
                    document.theForm.output.value += "\nProbabilities: "
                    for (j = 0; j < Nval; j++) document.theForm.output.value += (j > 0 ? ', ' : '') + "P(" + dd[j] + ")=" + my(ddPV[dd[j]])
                    if (list.length > 0) {
                        for (i = 0; i < ddT.length; i++) document.theForm.output.value += (i == 0 ? "\n" : ", ") + "P(" + i + ")=" + my(ddT[i] / ddGT)
                        document.theForm.output.value += ', ' + Sigma + "(P)= 1.00\n"
                    }
                    for (j = 0; j < list.length; j++) {
                        lj = list[j];
                        listall = "" + lj.join()
                        if (!document.theForm.commas.checked) listall = listall.replace(/,/g, "")
                        document.theForm.output.value += listall + "(" + my(ddPV[lj.join()] / ddGT) + "); "
                    }
                } else if (list.length > 0) { // ------------------------ print list
                    Totline = "\n" + whatt[what] + ": items=" + list.length
                    // if (Tots==0) Tots=list.length; else {Tots*=list.length; Totline+=" ("+Tots+")"}
                    document.theForm.output.value += Totline + ": "
                    listall = ""
                    for (j = 0; j < list.length; j++) listall += list[j] + "; "
                    if (extra == '4' || extra == '5') listall = listall.replace(/,([^,]+);/g, "($1);")
                    if (!document.theForm.commas.checked) listall = listall.replace(/,/g, "")
                    document.theForm.output.value += listall
                }
                // ------------------------ count number of items in their original position
                if (extra == '6') {
                    cnt = [];
                    for (cnti = 0; cnti <= Nval; cnti++) cnt[cnti] = 0
                    for (j = 0; j < list.length; j++) {
                        cnt1 = 0
                        for (k = 0; k < Nval; k++)
                            if (dd[k] == list[j][k]) cnt1++
                        document.theForm.output.value += "\n" + list[j] + ":  " + cnt1
                        cnt[cnt1]++
                    }
                    document.theForm.output.value += "\nX   N(X)"
                    for (cnti = 0; cnti <= Nval; cnti++) document.theForm.output.value += "\n" + cnti + "  " + cnt[cnti]
                }
                // -------------------------- end
                document.theForm.output.value += "\n"
                document.theForm.input.focus();
            }
        };
        // --------------------------------------------------- */
        function doInput() {
            /* if(document.theForm.Nvalt[2].checked)
            { document.theForm.Nval.value = document.theForm.input.value.split(',').length }
            else */
            Nval = eval(document.theForm.Nval.value);
            if (isNaN(Nval)) return
            if (oldNval != Nval) document.theForm.input.value = '';
            nlist = ''
            if (document.theForm.Nval.value == '') document.theForm.Nval.value = 5
            if (document.theForm.input.value == '') {
                if (document.theForm.Nvalt[1].checked) {
                    for (i = 0; i < Nval; i++) nlist = nlist + (nlist.length > 0 ? ',' : '') + i
                } else {
                    nlist = '';
                    inlet1 = "A";
                    inlet2 = ((Nval > 26) ? "A" : "")
                    for (i = 0; i < Nval; i++) {
                        nlist = nlist + (nlist.length > 0 ? ',' : '') + inlet2 + inlet1
                        if (inlet1 < "Z") inlet1 = String.fromCharCode(1 + inlet1.charCodeAt(0))
                        else {
                            inlet1 = "A";
                            inlet2 = String.fromCharCode(1 + inlet2.charCodeAt(0))
                        }
                    }
                }
                document.theForm.input.value = nlist;
            }
            document.theForm.Rval.focus()
        }
        // --------------------------------------------------- */
        function uniprob() {
            document.theForm.inputP.value = ''
            for (i = 0; i < Nval; i++) document.theForm.inputP.value += (i > 0 ? ',' : '') + '1'
        }
        // --------------------------------------------------- */
        function doNval() {
            Nval = document.theForm.Nval.value
            if ((what > 4) || ((Nval != oldNval && Nval != ""))) document.theForm.input.value = ''
            if (document.theForm.input.value == '') doInput()
            data = document.theForm.input.value.replace(/ /g, ",").replace(/\n/g, ",").replace(/[,;]+/g, ",").replace(/^,/, "").replace(/,$/, "").replace(/\n*$/, "");
            document.theForm.input.value = data
            dd = data.split(/[,\n]/);
            Nval = dd.length;
            document.theForm.Nval.value = Nval
            document.theForm.commas.checked |= document.theForm.input.value.length > Nval * 2 - 1
            document.theForm.Rval.focus()
        }
        // --------------------------------------------------- */
        function doqNval() {
            if (qwhat > 4) document.theForm.input.value = ''
            if (document.theForm.input.value == '') doInput()
            data = document.theForm.input.value.replace(/ /g, ",").replace(/\n/g, ",").replace(/[,;]+/g, ",").replace(/^,/, "").replace(/,$/, "").replace(/\n*$/, "");
            document.theForm.qRval.focus()
        }
    </script>
    <link rel="SHORTCUT ICON" href="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onload="self.focus();document.theForm.Nval.focus();">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">
            <h1>Generate Sample Space</h1>
            <textarea name="output" rows="25" cols="68">Advanced options:
1 - remove duplicate strings
2 - remove anything with adjacent repeats
3 - remove anything with adjacent consecutive numbers
4 - count duplicate deals
5 - count duplicate hands
6 - count how many are in original position

Two letter words are the same as the product table on these letters.
            </textarea>
            <h2>Input</h2>
            <input name="clear" type="button" value="Do it" onclick="calc(false)">
            <input name="calc2" type="button" value="List All " onclick="calc(true)">
            <input name="calc1" type="button" value="Clear" onclick="document.theForm.output.value=&#39;&#39;;calc(false)">
            <label>N</label><input class="shortinput" type="text" name="Nval" size="1" tabindex="1" onkeyup="enter1(event)"><br><br><br>
            <label>R</label><input class="shortinput" type="text" name="Rval" size="1" tabindex="2">
            <input name="calc1" type="button" value="Clear" onclick="document.theForm.Nval.value=&#39;&#39;;document.theForm.Rval.value=&#39;&#39;">

            <label>Letters</label><input type="radio" name="Nvalt" checked="" onclick="document.theForm.input.value='';doInput()">
            <label>Digits</label><input type="radio" name="Nvalt" onclick="document.theForm.input.value='';doInput()">

            <label> 's </label><input name="commas" type="checkbox">

            <label>nPr</label><input type="radio" name="rad1" onclick="what=1" value="nPr">
            <label>nCr</label><input type="radio" name="rad1" onclick="what=2" value="nCr" checked="">
            <label>Words</label><input type="radio" name="rad1" onclick="what=3" value="All">
            <label>Powset</label><input type="radio" name="rad1" onclick="what=4" value="Pwr">
            <label>Binomial Coeff</label><input type="radio" name="rad1" onclick="what=5" value="Pwr">
            <label>Option</label><input class="shortinput" type="text" name="extra" size="1" value="1"><br><br><br><br><br><br><br><br>
            <label>&nbsp;</label><input class="shortinput" name="input" rows="1" cols="52" onkeyup="enter2(event)">
            <input name="calc1" type="button" value="Clear" onclick="document.theForm.input.value=&#39;&#39;"><br><br>


            <h2>Second Space</h2>
            <input name="clear" type="button" value="Do it" onclick="qcalc(false)">
            <input name="calc2" type="button" value="List All " onclick="qcalc(true)">
            <input name="calc1" type="button" value="Clear" onclick="document.theForm.output.value=&#39;&#39;">
            <label>Plus</label><input type="radio" name="qop">
            <label>Minus</label><input type="radio" name="qop">
            <label>Times</label><input type="radio" name="qop" checked="">



            <label>nPr</label><input type="radio" name="qrad1" onclick="qwhat=1" value="nPr">
            <label>nCr</label><input type="radio" name="qrad1" onclick="qwhat=2" value="nCr" checked="">
            <label>words</label><input type="radio" name="qrad1" onclick="qwhat=3" value="All">
            <label>Powset</label><input type="radio" name="qrad1" onclick="qwhat=4" value="Pwr">
            <label>Binomial Coeff</label><input type="radio" name="qrad1" onclick="qwhat=5" value="Pwr">
            <label>R</label><input class="shortinput" type="text" name="qRval" size="1">
            <input name="calc1" type="button" value="Clear" onclick="document.theForm.qRval.value=&#39;&#39;">
            <br><br><br><br><br><br><br>


            <h2>Advanced Functions</h2>
            <p>Starts with 3 or ends with 4 or 5: (^3|4$|5$)</p><br><br><br>
            <input name="uniform" value="uniform" type="button" onclick="uniprob()">
            <input type="button" value="a/b" id="frac" onclick="swfrac(true,7)" title="output format"><br><br>
            <label> P(X) = </label><input name="inputP" rows="1" cols="60">

            <br><label>regex to exclude</label> <input class="shortinput" name="regxn" rows="1" cols="65">
            <label>regex to include</label> &nbsp;<input class="shortinput" name="regxy" rows="1" cols="65"><br>



            <br><br>

        </form>
        <script>
            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                lsd = ls.slice(1).split("&")
                if (lsd.length == 1 && lsd[0][0] == '\\') document.theForm.input.value = lsd[0]
                else {
                    for (i = 0; i < 6; i++)
                        if (lsd[i] == undefined) lsd[i] = ""
                    document.theForm.Nval.value = lsd[0]
                    document.theForm.Rval.value = lsd[1]
                }
                calc()
            }
        </script>
    </div>
</body>

</html>