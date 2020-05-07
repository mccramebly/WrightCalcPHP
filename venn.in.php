<!DOCTYPE html>
<html lang="en">

<head>
    <title>Venn Diagram Input</title>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
</head>

<body onget="self.focus()">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.htm"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <script type="text/javascript" src="myfunctions.js"></script>
        <form name='theForm'>

            <h1>Input data for Venn Diagram</h1>

            <h2>Three sets:</h2>
            <label>A:</label><input type='text' name='nA' size=15 tabindex="1" value="A" onblur='get()'> &nbsp;
            <label>B:</label><input type='text' name='nB' size=15 tabindex="2" value="B" onblur='get()'> &nbsp;
            <label>C:</label><input type='text' name='nC' size=15 tabindex="3" value="C" onblur='get()'><br>

            <h2>A</h2>
            <label>A:</label><input type='text' name='va_' size=5 value="" onblur='get()' tabindex='4'><br>
            <label>Only A:</label><input type='text' name='va' size=5 value="" onblur='get()' tabindex='7'><br>
            <label>Only B and C:</label><input type='text' name='vbc' size=5 value="" onblur='get()' tabindex="10"><br>
            <label>Both B and C == B&cap;C:</label><input type='text' name='vbc_' size=5 value="" onblur='get()' tabindex="13"><br>
            <label>Either B&cup;C:</label><input type='text' name='vb_c' size=5 value="" onblur='get()' tabindex="16"><br>
            <label>NONE:</label><input type='text' name='vx' size=5 value="" onblur='get()' tabindex="19"><br>
            <label>ALL THREE:</label><input type='text' name='vabc' size=5 value="" onblur='get()' tabindex="22">
            <h2>B</h2>
            <label> B:</label><input type='text' name='vb_' size=5 value="" onblur='get()' tabindex="5"><br>
            <label>Only B:</label><input type='text' name='vb' size=5 value="" onblur='get()' tabindex="8"><br>
            <label>Only A and C:</label><input type='text' name='vac' size=5 value="" onblur='get()' tabindex="11"><br>
            <label>Both A and C == A&cap;C:</label><input type='text' name='vac_' size=5 value="" onblur='get()' tabindex="14"><br>
            <label>Either A&cup;C:</label><input type='text' name='va_c' size=5 value="" onblur='get()' tabindex="17"><br>
            <label>ONLY ONE:</label><input type='text' name='v1' size=5 value="" onblur='get()' tabindex="20"><br>
            <label>AT LEAST TWO:</label><input type='text' name='v23' size=5 value="" onblur='get()' tabindex="23">
            <h2>C</h2>
            <label>C:</label><input type='text' name='vc_' size=5 value="" onblur='get()' tabindex="6"><br>
            <label>Only C:</label><input type='text' name='vc' size=5 value="" onblur='get()' tabindex="9"><br>
            <label>Only A and B:</label><input type='text' name='vab' size=5 value="" onblur='get()' tabindex="12"><br>
            <label>Both A and B == A&cap;B:</label><input type='text' name='vab_' size=5 value="" onblur='get()' tabindex="15"><br>
            <label>Either A&cup;B:</label><input type='text' name='va_b' size=5 value="" onblur='get()' tabindex="18"><br>
            <label>ONLY TWO:</label><input type='text' name='v2' size=5 value="" onblur='get()' tabindex="21"><br>
            <label>EVERYONE:</label><input type='text' name='vabcx' size=5 value="" onblur='get()' tabindex='24'>
            <h2>Output</h2>
            <input name="clearbut" type="button" value="Clear ALL" onClick="clearall(); get()" /> <input name="clear" type="button" value="only A,B no C" onClick="onlyabnotc()" />
            <input name="demobut" type="button" value="CALC" onClick="demo()" />
            <input name="savebut" type="button" value="SAVE" onClick="save()" />
            <input name="loadbut" type="button" value="LOAD" onClick="load()" />

            <input name="drawbut" type="button" value="DRAW" onClick="draw()" />
            <input name="testbut" type="button" value="TEST" onClick="test()" />
            <textarea name="input" rows=22 cols=60></textarea>
            <!-- <tr><td  colspan=3 align=left><canvas id="theCanvas" width="500" height="400"></canvas></td></tr> -->
        </form>
        <script type="text/javascript">
            didcalc = false;
            testi = 0;
            testn = 4

            var xx = []
            document.theForm.nA.select()
            // --------------------------
            function enter(evt) {
                var charCode = evt.keyCode;
                if (charCode == 13) calc();
                if (charCode == 27) cla();
            };
            // --------------------------
            function cla() {
                var coef = [
                    []
                ];
                n = -1;
                var xx = [];
                // document.theForm.input.value = '';
                document.theForm.output.value = '';
                document.theForm.input.focus()
            };
            // --------------------------
            function onlyabnotc() {
                get()
                vabc = 0
                vac = 0
                vbc = 0
                vc = 0
                vc_ = 0
                vac_ = 0
                vbc_ = 0
                va_c = 0
                vb_c = 0
                legend()
            }
            // --------------------------
            function test() {
                didcalc = false
                nA = 'A';
                nB = 'B';
                nC = '';
                va = '';
                vab = '';
                vabc = '';
                vac = '';
                vb = '';
                vbc = '';
                vc = '';
                vx = '';
                va_ = '';
                vb_ = '';
                vc_ = '';
                vab_ = '';
                vac_ = '';
                vbc_ = '';
                va_b = '';
                va_c = '';
                vb_c = '';
                vabcx = '';
                v1 = '';
                v2 = '';
                v23 = '';
                if (testi == 0) {
                    vabc = 0;
                    vac = 0;
                    vbc = 0;
                    vc = 0;
                    vc_ = 0;
                    vac_ = 0;
                    vbc_ = 0;
                    va_c = 0;
                    vb_c = 0;
                    va_ = 5;
                    vb_ = 12;
                    vab = 4
                } else if (testi == 1) {
                    vabc = 0;
                    vac = 0;
                    vbc = 0;
                    vc = 0;
                    vc_ = 0;
                    vac_ = 0;
                    vbc_ = 0;
                    va_c = 0;
                    vb_c = 0;
                    va_ = 15;
                    vb_ = 30;
                    va_b = 33
                } else if (testi == 2) {
                    vabc = 0;
                    vac = 0;
                    vbc = 0;
                    vc = 0;
                    vc_ = 0;
                    vac_ = 0;
                    vbc_ = 0;
                    va_c = 0;
                    vb_c = 0;
                    vab = 5;
                    vb_ = 9;
                    va_b = 22
                } else if (testi == 3) {
                    vabc = 0;
                    vac = 0;
                    vbc = 0;
                    vc = 0;
                    vc_ = 0;
                    vac_ = 0;
                    vbc_ = 0;
                    va_c = 0;
                    vb_c = 0;
                    vab = 5;
                    va_b = 38;
                    va_ = 13
                }
                legend();
                testi = ++testi % testn
            }
            // --------------------------
            function save() {
                didcalc = false
                snA = document.theForm.nA.value
                snB = document.theForm.nB.value
                snC = document.theForm.nC.value
                sva = document.theForm.va.value
                svab = document.theForm.vab.value
                svabc = document.theForm.vabc.value
                svac = document.theForm.vac.value
                svb = document.theForm.vb.value
                svbc = document.theForm.vbc.value
                svc = document.theForm.vc.value
                svx = document.theForm.vx.value
                sva_ = document.theForm.va_.value
                svb_ = document.theForm.vb_.value
                svc_ = document.theForm.vc_.value
                svab_ = document.theForm.vab_.value
                svac_ = document.theForm.vac_.value
                svbc_ = document.theForm.vbc_.value
                sva_b = document.theForm.va_b.value
                sva_c = document.theForm.va_c.value
                svb_c = document.theForm.vb_c.value
                svabcx = document.theForm.vabcx.value
                sv1 = document.theForm.v1.value
                sv2 = document.theForm.v2.value
                sv23 = document.theForm.v23.value
            }
            // --------------------------
            function load() {
                document.theForm.nA.value = snA
                document.theForm.nB.value = snB
                document.theForm.nC.value = snC
                document.theForm.va.value = sva
                document.theForm.vab.value = svab
                document.theForm.vabc.value = svabc
                document.theForm.vac.value = svac
                document.theForm.vb.value = svb
                document.theForm.vbc.value = svbc
                document.theForm.vc.value = svc
                document.theForm.vx.value = svx
                document.theForm.va_.value = sva_
                document.theForm.vb_.value = svb_
                document.theForm.vc_.value = svc_
                document.theForm.vab_.value = svab_
                document.theForm.vac_.value = svac_
                document.theForm.vbc_.value = svbc_
                document.theForm.va_b.value = sva_b
                document.theForm.va_c.value = sva_c
                document.theForm.vb_c.value = svb_c
                document.theForm.vabcx.value = svabcx
                document.theForm.v1.value = sv1
                document.theForm.v2.value = sv2
                document.theForm.v23.value = sv23
            }
            // --------------------------
            function get() {
                didcalc = false
                nA = document.theForm.nA.value
                nB = document.theForm.nB.value
                nC = document.theForm.nC.value
                va = document.theForm.va.value
                vab = document.theForm.vab.value
                vabc = document.theForm.vabc.value
                vac = document.theForm.vac.value
                vb = document.theForm.vb.value
                vbc = document.theForm.vbc.value
                vc = document.theForm.vc.value
                vx = document.theForm.vx.value
                va_ = document.theForm.va_.value
                vb_ = document.theForm.vb_.value
                vc_ = document.theForm.vc_.value
                vab_ = document.theForm.vab_.value
                vac_ = document.theForm.vac_.value
                vbc_ = document.theForm.vbc_.value
                va_b = document.theForm.va_b.value
                va_c = document.theForm.va_c.value
                vb_c = document.theForm.vb_c.value
                vabcx = document.theForm.vabcx.value
                v1 = document.theForm.v1.value
                v2 = document.theForm.v2.value
                v23 = document.theForm.v23.value
                // calc()
            }
            // --------------------------
            function legend() {
                document.theForm.nA.value = nA
                document.theForm.nB.value = nB
                document.theForm.nC.value = nC
                document.theForm.va.value = va
                document.theForm.vab.value = vab
                document.theForm.vabc.value = vabc
                document.theForm.vac.value = vac
                document.theForm.vb.value = vb
                document.theForm.vbc.value = vbc
                document.theForm.vc.value = vc
                document.theForm.vx.value = vx
                document.theForm.va_.value = va_
                document.theForm.vb_.value = vb_
                document.theForm.vc_.value = vc_
                document.theForm.vab_.value = vab_
                document.theForm.vac_.value = vac_
                document.theForm.vbc_.value = vbc_
                document.theForm.va_b.value = va_b
                document.theForm.va_c.value = va_c
                document.theForm.vb_c.value = vb_c
                document.theForm.vabcx.value = vabcx
                document.theForm.v1.value = v1
                document.theForm.v2.value = v2
                document.theForm.v23.value = v23
            }
            // --------------------------
            function clearall() {
                document.theForm.nA.value = 'A'
                document.theForm.nB.value = 'B'
                document.theForm.nC.value = 'C'
                document.theForm.va.value = ''
                document.theForm.vab.value = ''
                document.theForm.vabc.value = ''
                document.theForm.vac.value = ''
                document.theForm.vb.value = ''
                document.theForm.vbc.value = ''
                document.theForm.vc.value = ''
                document.theForm.vx.value = ''
                document.theForm.va_.value = ''
                document.theForm.vb_.value = ''
                document.theForm.vc_.value = ''
                document.theForm.vab_.value = ''
                document.theForm.vac_.value = ''
                document.theForm.vbc_.value = ''
                document.theForm.va_b.value = ''
                document.theForm.va_c.value = ''
                document.theForm.vb_c.value = ''
                document.theForm.vabcx.value = ''
                document.theForm.v1.value = ''
                document.theForm.v2.value = ''
                document.theForm.v23.value = ''
            }
            // --------------------------
            function draw() {
                if (vx == '') vx = 0
                if (vc == 0 && vb != 0)
                    window.open('bayes.htm?' + nA + '&' + nB + '&' + vab + '&' + va + '&' + vb + '&' + vx)
                else
                    window.open('venn.htm?' + nA + ';' + nB + ';' + nC + ';' + va + ';' + vab + ';' + vb + ';' + vac + ';' + vabc + ';' + vbc + ';' + vc + ';' + vx)
            }
            // --------------------------
            function demo() {
                if (nv(va) + nv(vab) + nv(vabc) + nv(vac) + nv(vb) + nv(vbc) + nv(vc) + nv(vx) + nv(va_) + nv(vb_) + nv(vc_) + nv(vab_) + nv(vbc_) + nv(vac_) + nv(va_b) + nv(va_c) + nv(vb_c) + nv(vabcx) + nv(v1) + nv(v2) + nv(v23) == 0) {
                    nA = 'Algebra';
                    nB = 'Biology';
                    nC = 'Chemistry';
                    vabcx = 24;
                    va_ = 11;
                    vb_ = 11;
                    vc_ = 12;
                    vb = 3;
                    v2 = 3;
                    vab_ = 7;
                    vabc = 5
                    /* 24 students enrolled in Algebra, Biology, and Chemistry class.
                    11 Took algebra, 11 took biology, 12 took chemistry, 3 took only biology, 3 took exactly 2 of the 3 classes, 7 took biology and algebra, 5 took all 3 classes. */
                    didcalc = false
                    legend();
                    return
                }
                calc();
                return

                // if nv(va)+nv(vab)+nv(vabc)+nv(vac)+nv(vb)+nv(vbc)+nv(vc)+nv(vx)+nv(va_)+nv(vb_)+nv(vc_)+nv(vab_)+nv(vbc_)+nv(vac_)+nv(va_b)+nv(va_c)+nv(vb_c)+nv(vabcx)+nv(v1)+nv(v2)+nv(v23)

                {
                    didcalc = false
                    nA = 'Comedy';nB = 'Drama';nC = 'Sci Fi'
                    va = 21;vab = 10;vabc = 7;vac = 15;vb = 18;vbc = 8;vc = 4;vx = 2
                    va_ = va + vab + vac + vabc;vb_ = vb + vab + vbc + vabc;vc_ = vc + vac + vbc + vabc
                    vab_ = vab + vabc;vac_ = vac + vabc;vbc_ = vbc + vabc
                    va_b = va + vb + vab + vac + vbc + vabc
                    va_c = va + vc + vab + vac + vbc + vabc
                    vb_c = vb + vc + vab + vac + vbc + vabc
                    vabcx = va + vb + vc + vab + vac + vbc + vabc + vx
                    v1 = va + vb + vc;v2 = vab + vac + vbc;v23 = v2 + vabc
                }
                calc()
                // window.open('venn.htm?'+nA+';'+nB+';'+nC+';'+va+';'+vab+';'+vabc+';'+vac+';'+vb+';'+vbc+';'+vc+';'+vx)
            }
            // --------------------------
            function nv(x) {
                if (isNaN(x)) return 0
                if (typeof(x) == 'string') {
                    var y = slim(x);
                    if (y == '') return 0
                }
                return 1
            }
            // --------------------------
            function calc() {
                with(Math) {
                    didcalc = true

                    function dump() {
                        return
                        document.theForm.input.value = 'a,ab,abc,ac,b,bc,c,x\n'
                        for (var i = 0; i < coef.length; i++) {
                            for (var j = 0; j < coef[i].length; j++) print(coef[i][j], ' ')
                            print()
                        }
                    }

                    // if (nv(va)+nv(vab)+nv(vabc)+nv(vac) +nv(vb)+nv(vbc)+nv(vc)+nv(vx)+nv(va_)+nv(vb_)+nv(vc_) +nv(vab_)+nv(vbc_)+nv(vac_) +nv(va_b)+nv(va_c)+nv(vb_c)+nv(vabcx) +nv(v1)+nv(v2)+nv(v23)<8) return

                    coef = []
                    stuff = []
                    //             [ , ,a, , , , , ]
                    //             [ ,a,b,a, ,b, , ]
                    //             [a,b,c,c,b,c,c,x]
                    stuff["va_"] = [1, 1, 1, 1, 0, 0, 0, 0]
                    stuff["vb_"] = [0, 1, 1, 0, 1, 1, 0, 0]
                    stuff["vc_"] = [0, 0, 1, 1, 0, 1, 1, 0]
                    stuff["va"] = [1, 0, 0, 0, 0, 0, 0, 0]
                    stuff["vb"] = [0, 0, 0, 0, 1, 0, 0, 0]
                    stuff["vc"] = [0, 0, 0, 0, 0, 0, 1, 0]
                    stuff["vbc"] = [0, 0, 0, 0, 0, 1, 0, 0]
                    stuff["vac"] = [0, 0, 0, 1, 0, 0, 0, 0]
                    stuff["vab"] = [0, 1, 0, 0, 0, 0, 0, 0]
                    stuff["vbc_"] = [0, 0, 1, 0, 0, 1, 0, 0]
                    stuff["vac_"] = [0, 0, 1, 1, 0, 0, 0, 0]
                    stuff["vab_"] = [0, 1, 1, 0, 0, 0, 0, 0]
                    stuff["vb_c"] = [0, 1, 1, 1, 1, 1, 1, 0]
                    stuff["va_c"] = [1, 1, 1, 1, 0, 1, 1, 0]
                    stuff["va_b"] = [1, 1, 1, 1, 1, 1, 0, 0]
                    stuff["vx"] = [0, 0, 0, 0, 0, 0, 0, 1]
                    stuff["v1"] = [1, 0, 0, 0, 1, 0, 1, 0]
                    stuff["v2"] = [0, 1, 0, 1, 0, 1, 0, 0]
                    stuff["vabc"] = [0, 0, 1, 0, 0, 0, 0, 0]
                    stuff["v23"] = [0, 1, 1, 1, 0, 1, 0, 0]
                    stuff["vabcx"] = [1, 1, 1, 1, 1, 1, 1, 1]

                    // build equations

                    function putstuff(x, z) {
                        if (nv(eval(x)) != 0)
                            if ((z && eval(x) != 0) || (!z && eval(x) == 0)) coef[coef.length] = stuff[x].concat([eval(x), x])
                    }
                    for (stu in stuff) putstuff(stu, true)
                    for (stu in stuff) putstuff(stu, false)


                    dump() // ; return
                    for (var i = 0; i < 8; i++) {
                        if (coef[i][i] == 0) {
                            for (var j = i + 1; j < coef.length; j++) {
                                if (coef[j][i] != 0) {
                                    for (var k = 0; k < coef[i].length; k++) {
                                        tt = coef[i][k];
                                        coef[i][k] = coef[j][k];
                                        coef[j][k] = tt
                                    }
                                    break
                                }
                            }
                        }
                        if (coef[i][i] == 0) break
                        dump()
                        for (var j = 0; j < coef.length; j++) {
                            if (coef[j][i] != 0 && i != j) {
                                tt = coef[j][i] / coef[i][i]
                                for (var k = 0; k < 9; k++) coef[j][k] -= coef[i][k] * tt
                            }
                        }
                        dump()
                    }
                    if (coef[0][0] != 0) va = coef[0][8] / coef[0][0];
                    else va = ''
                    if (coef[1][1] != 0) vab = coef[1][8] / coef[1][1];
                    else vab = ''
                    if (coef[2][2] != 0) vabc = coef[2][8] / coef[2][2];
                    else vabc = ''
                    if (coef[3][3] != 0) vac = coef[3][8] / coef[3][3];
                    else vac = ''
                    if (coef[4][4] != 0) vb = coef[4][8] / coef[4][4];
                    else vb = ''
                    if (coef[5][5] != 0) vbc = coef[5][8] / coef[5][5];
                    else vbc = ''
                    if (coef[6][6] != 0) vc = coef[6][8] / coef[6][6];
                    else vc = ''
                    if (coef[7][7] != 0) vx = coef[7][8] / coef[7][7];
                    else vx = ''

                    if (nv(va_) == 0) {
                        va_ = va + vab + vac + vabc;
                        if (typeof(va_) == 'string') va_ = ''
                    }
                    if (nv(vb_) == 0) {
                        vb_ = vb + vab + vbc + vabc;
                        if (typeof(vb_) == 'string') vb_ = ''
                    }
                    if (nv(vc_) == 0) {
                        vc_ = vc + vac + vbc + vabc;
                        if (typeof(vc_) == 'string') vc_ = ''
                    }
                    if (nv(vab_) == 0) {
                        vab_ = vab + vabc;
                        if (typeof(vab_) == 'string') vab_ = ''
                    }
                    if (nv(vbc_) == 0) {
                        vbc_ = vbc + vabc;
                        if (typeof(vbc_) == 'string') vbc_ = ''
                    }
                    if (nv(vac_) == 0) {
                        vac_ = vac + vabc;
                        if (typeof(vac_) == 'string') vac_ = ''
                    }
                    if (nv(va_b) == 0) {
                        va_b = va + vb + vab + vac + vbc + vabc;
                        if (typeof(va_b) == 'string') va_b = ''
                    }
                    if (nv(va_c) == 0) {
                        va_c = va + vc + vab + vac + vbc + vabc;
                        if (typeof(va_c) == 'string') va_c = ''
                    }
                    if (nv(vb_c) == 0) {
                        vb_c = vb + vc + vab + vac + vbc + vabc;
                        if (typeof(vb_c) == 'string') vb_c = ''
                    }
                    if (nv(vabcx) == 0) {
                        vabcx = va + vb + vc + vab + vac + vbc + vabc + vx;
                        if (typeof(vabcx) == 'string') vabcx = ''
                    }
                    if (nv(v1) == 0) {
                        v1 = va + vb + vc;
                        if (typeof(v1) == 'string') v1 = ''
                    }
                    if (nv(v2) == 0) {
                        v2 = vab + vac + vbc;
                        if (typeof(v2) == 'string') v2 = ''
                    }
                    if (nv(v23) == 0) {
                        v23 = vab + vac + vbc + vabc;
                        if (typeof(v23) == 'string') v23 = ''
                    }

                    legend()
                    return
                }
            }
        </script>
    </div>
</body>

</html>