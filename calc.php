<!DOCTYPE html>
<html lang="en">

<head>
    <title>Scientific Calculator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <script src="statfns.js"></script>
    <script src="myfunctions.js"></script>
    <script src="matrix.js"></script>
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/complex-calc.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="sciCalc">
    <?php include('nav.html'); ?>
    <div id="calctainer">
        <a href="index.php"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <h1>Scientific Calculator</h1>
        <form name="theForm">
            <div id="inputOutputGroup">
                <textarea name="input" onKeyUp="enter(event)"></textarea>

                <div id="answerType">
                    <span id="answerOnly">
                        <input type="checkbox" id="qna" onClick="calc(wasnotqna)"> <label for="qna">Display Answers Only</label>
                    </span>
                    <span id="outputType">
                        <label for="frac">Output Type:</label>
                        <input type="button" value="8 place" id="frac" onClick="swfrac(true,7,!wasnotqna)" title="output format" />
                    </span>
                    <!--<input type="button" value="4 place" id="do4pl" onClick="frac23(2)" title="4 decimals"/>-->
                    <span id="degOrRad">
                        <input name="degrees" type="radio" id="degreesButton" title="degrees" checked onClick="calc(!wasnotqna);" />
                        <label for="degreesButton">Degrees</label>

                        <!--<input type="button" value="round" onClick="putx('myround(')"/>-->

                        <input name="degrees" type="radio" id="radiansButton" title="radians" onClick="calc(!wasnotqna);" /> <label for="radiansButton">Radians</label>
                    </span>


                    <!--<input type="button" value="a/b" id="dofrac" onClick="frac23(3)" title="fractions"/>-->



                    <span id="keyboard">
                        Use Keyboard: <input name="isphone" type="checkbox" onClick="checkphone()" title="Use Keyboard" checked /></span>
                    <!--<select>
            <option>Output Type</option>
        </select>-->
                </div>
                <div id="clearSave">
                    <input name="clerebut" Value="Clear" type="button" onClick="clere()" title="Clear Screen" />
                    <input name="delbut" Value="Delete" type="button" onClick="del()" title="" />
                    <input name="popbut" Value="Undo" type="button" onClick="popstack()" title="Undo Last Calculation (ESC)" />
                    <input name="savebut" Value="Save" type="button" onClick="savestuff();document.theForm.input.focus()" title="Save Screen to Cookies" />
                    <input name="loadbut" Value="Load" type="button" onClick="loadstuff();wasnotqna=false;document.theForm.input.focus()" title="Load Screen from Cookies" />
                    <input name="morebut" Value="More" type="button" onClick="calc(true);loadstuff(true);wasnotqna=false;document.theForm.input.focus()" title="Append to Screen from Cookie" />
                    <input name="addbut" Value="Add" type="button" onClick="addstuff();document.theForm.input.focus()" title="Append to Cookie from Screen" />
                </div>
            </div>

            <div id="col1">


                <div id="buttonGroup1">
                    <input type="button" value="%" onClick="putx('%')" title='mod' />
                    <input type="button" value="(" onClick="putx('(')" />
                    <input type="button" value=")" onClick="putx(')')" />
                    <input type="button" value="^" onClick="putx('^')" title='exponent power' />
                    <input type="button" value="&deg;" onClick="putx('°')" />
                    <input type="button" value="&#178;" onClick="putx('²')" />
                    <input type="button" value="&#8730;" onClick="putx('√(')" />
                    <input type="button" value="π" onClick="putx('π')" />
                </div>

                <div id="digitsGroup">
                    <input type="button" value="7" onClick="putx('7')" class="digit">
                    <input type="button" value="8" onClick="putx('8')" class="digit">
                    <input type="button" value="9" onClick="putx('9')" class="digit">
                    <input type="button" value="+" onClick="putx('+')" />
                    <input type="button" value="4" onClick="putx('4')" class="digit">
                    <input type="button" value="5" onClick="putx('5')" class="digit">
                    <input type="button" value="6" onClick="putx('6')" class="digit">
                    <input type="button" value="-" onClick="putx('-')" />
                    <input type="button" value="1" onClick="putx('1')" class="digit">
                    <input type="button" value="2" onClick="putx('2')" class="digit">
                    <input type="button" value="3" onClick="putx('3')" class="digit">
                    <input type="button" value="×" onClick="putx('×')" />
                    <input type="button" value=" ." onClick="putx('.')" />
                    <input type="button" value="0" onClick="putx('0')" class="digit">
                    <input type="button" value="," onClick="putx(',')" />
                    <input type="button" value="÷" onClick="putx('÷')" />
                </div>


                <input name="calcbut" class="calcButton" Value="Calculate" type="button" onClick="if(!document.theForm.isphone.checked)putx('\n');calc(true);" title="calculate" />

            </div>
            <div id="col2">
                <div id="buttonGroup2">
                    <input type="button" value="exp" onClick="putx('exp(')" title='e to a power' />
                    <input type="button" value="log" onClick="putx('log(')" title="base10 log= log(10,x)" />
                    <input type="button" value="ln" onClick="putx('ln(')" title='natural log' />
                    <input type="button" value="dist" onClick="putx('dist(')" title="length of line" />
                    <input type="button" value="floor" onClick="putx('floor(')" title='floor aka int()' />
                    <input type="button" value="ceil" onClick="putx('ceil(')" title='ceiling' />
                    <input type="button" value="DO" onClick="putx('DO: ')" title='native javascript' />
                    <input type="button" value="nPr" onClick="putx('nPr(')" title='Permutations' />
                    <input type="button" value="nCr" onClick="putx('nCr(')" title='Combinations' />
                    <input type="button" value="line" onClick="putx('line(')" title="line (x0,y0,x1,y1) OR (x0,y0,m)" />
                    <input type="button" value="slope" onClick="putx('slope(')" title="slope of line" />
                    <input type="button" value="yval" onClick="putx('yval(')" title="y(x)" />
                    <input type="button" id="hppowButton" value="hppow" onClick="putx('hppow(')" title="hppow(a,b)=a^b" />

                    <input type="button" value="=" onClick="putx('=')" />
                </div>

                <div id="buttonGroup3">
                    <input type="button" value="gcfsum" onClick="putx('gcfsum(')" title='gcf = sum' id="gcfSumButton">
                    <input type="button" value="prime" onClick="putx('prime(')" title='prime factors' />
                    <input type="button" value="base" onClick="putx('base(')" title="(number,base)" />
                    <input type="button" value="sod" onClick="putx('sod(')" title="(sum of digits)" />
                    <input type="button" value="rand" onClick="putx('rand(')" title="() 0-1, integers: (a) 0-a, (a,b) a-b">
                    <input type="button" value="gcf" onClick="putx('gcf(')" title='greatest common factor' />
                    <input type="button" value="lcm" onClick="putx('lcm(')" title='least common multiple' />
                    <input type="button" value="fact" onClick="putx('fact(')" title='factorial' />
                </div>
            </div>

            <div id="col3">
                <div id="variableGroup">
                    <h2>Variables</h2>
                    <input type="button" class="variable" name="Varxx" value="a" onClick="putx(document.theForm.Varxx[0].value)" />
                    <input type="text" name="Varxxval" size=4 value="0" onKeyUp="enterz(event,0)" />
                    <input type="button" class="variable" name="Varxx" value="b" onClick="putx(document.theForm.Varxx[1].value)" />
                    <input type="text" name="Varxxval" size=4 value="0" onKeyUp="enterz(event,1)" />
                    <input type="button" class="variable" name="Varxx" value="c" onClick="putx(document.theForm.Varxx[2].value)" />
                    <input type="text" name="Varxxval" size=4 value="0" onKeyUp="enterz(event,2)" />
                    <input type="button" class="variable" name="Varxx" value="x" onClick="putx(document.theForm.Varxx[3].value)" />
                    <input type="text" name="Varxxval" size=4 value="0" onKeyUp="enterz(event,3)" />
                    <input type="button" class="variable" name="Varxx" value="y" onClick="putx(document.theForm.Varxx[4].value)" />
                    <input type="text" name="Varxxval" size=4 value="0" onKeyUp="enterz(event,4)" />
                    <input type="button" class="variable" name="Varxx" value="z" onClick="putx(document.theForm.Varxx[5].value)" />
                    <input type="text" name="Varxxval" size=4 value="0" onKeyUp="enterz(event,5)" />
                    <input type="button" value="Last Answer" id="lastAnswer" onClick="putx('Ans')" />
                </div>

                <div id="sinCosTan">
                    <input type="button" value="sin" onClick="putx('sin(')" title='sine' />
                    <input type="button" value="asin" onClick="putx('asin(')" title='inverse sine' />
                    <input type="button" value="cos" onClick="putx('cos(')" title='cosine' />
                    <input type="button" value="acos" onClick="putx('acos(')" title='inverse cosine' />
                    <input type="button" value="tan" onClick="putx('tan(')" title='tangent' />
                    <input type="button" value="atan" onClick="putx('atan(')" title='inverse tangent' />
                </div>
            </div>
        </form>
    </div>



    <script>
        x = navigator.userAgent;
        isphone = true;
        // print(x+":")
        y = ['Android', 'BlackBerry', 'iPhone', 'iPad', 'iPod', 'Opera Mini', 'IEMobile'];
        z = ''
        for (i = 0; i < y.length; i++)
            if (x.match(y[i]) != null) z += y[i]
        if (z != '') {
            document.theForm.isphone.checked = false
            print('keyboard is ' + z + ":")
            checkphone()
        };
        x = 0
        qna = true;
        wasnotqna = false;
        dovar = -1
        lastans = 0
        degrees = true
        pcnt = false
        expressions = []
        stack = [];
        qstack = []
        scup = String.fromCharCode(8744)
        scap = String.fromCharCode(8743)
        ls = decodeURIComponent(location.search)
        if (ls.search(/\?/) == 0) {
            if (ls == '?&') {
                loadstuff(true, 'calc');
                calc(true)
            } else {
                lsf = ls.slice(1).split("&")
                if (lsf[0].length == 0 && lsf[1].length > 0) {
                    loadstuff(true, lsf[1]);
                    calc(true)
                } else {
                    document.theForm.input.value = lsf[0].split(";").join('\n') + '\n'
                    calc(true)
                }
            }
        }
        if (dovar < 0) document.theForm.input.focus()
        // ---------------------------------------------------*/
        function torf(tf1, tf2) {
            if (tf2 != undefined) var tf = imp(tf1, tf2);
            else var tf = tf1
            return (tf ? "T " : "F ")
        }
        // ---------------------------------------------------*/
        function checkphone() {
            isphone = !document.theForm.isphone.checked
            if (isphone) {
                document.theForm.input.readOnly = "readonly"
            } else {
                document.theForm.input.readOnly = ""
            }
            document.theForm.input.focus()
        }
        // ---------------------------------------------------*/
        function enterz(evt, i) {
            var KEYcode = evt.keyCode;
            if (KEYcode == 13) {
                if (eval(document.theForm.Varxx[i].value.toUpperCase()) != undefined && document.theForm.Varxxval[i].value == eval(document.theForm.Varxx[i].value.toUpperCase())) {
                    document.theForm.Varxxval[i].value++;
                    eval(document.theForm.Varxx[i].value.toUpperCase() + '++')
                }
                calc(!wasnotqna)
                addstuff('dataOut')
                document.theForm.Varxxval[i].focus()
                document.theForm.Varxxval[i].select()
            }
            return
        }
        // ---------------------------------------------------*/
        function enter(evt) {
            var KEYcode = evt.keyCode;
            // display the key code that was pressed:
            // jsoutput += " "+KEYcode+"="+String.fromCharCode(KEYcode); return
            if (KEYcode == 13) {
                calc(!wasnotqna);
                return
            }
            if (KEYcode == 27) clere()
        };
        // ---------------------------------------------------*/
        function popstack() {
            wasnotqna = false
            if (stack.length > 0) {
                document.theForm.input.value = stack.pop();
                putx("");
                return
            }
            clere();
            putx("")
        }
        // ---------------------------------------------------*/
        function restoreval() {
            var rval
            for (i = 0; i < 6; i++) {
                if (eval("typeof(" + document.theForm.Varxx[i].value.toUpperCase() + ")") !== undefined) {
                    rval = eval(document.theForm.Varxx[i].value.toUpperCase())
                    if (typeof(rval) == 'string') document.theForm.Varxxval[i].value = '"' + rval + '"'
                    else document.theForm.Varxxval[i].value = rval
                } else document.theForm.Varxxval[i].value = 0;
            }
        }
        // ---------------------------------------------------*/
        function putx(x) {
            isphone = document.theForm.isphone.checked
            //IE support
            if (document.selection) {
                document.theForm.input.focus();
                sel = document.selection.createRange();
                sel.text = x
            } else if (document.theForm.input.selectionStart || document.theForm.input.selectionStart == '0') { //MOZILLA/NETscupE support
                var startPos = document.theForm.input.selectionStart;
                var endPos = document.theForm.input.selectionEnd;
                var cursorPos = startPos + x.length;
                document.theForm.input.value = document.theForm.input.value.substring(0, startPos) + x + document.theForm.input.value.substring(endPos, document.theForm.input.value.length);
                document.theForm.input.selectionStart = cursorPos
                document.theForm.input.selectionEnd = cursorPos
            } else {
                document.theForm.input.value += x
            }
            document.theForm.input.focus()
        }
        // ---------------------------------------------------*/
        function clere() { // stack = [""]
            if (document.theForm.input.value != "") {
                stack.push(document.theForm.input.value);
                document.theForm.input.value = ""
            } else if (wasnotqna) {
                document.theForm.input.value = test[testi];
                stack.push(document.theForm.input.value);
                testi = (testi + 1) % test.length
            } else {
                wasnotqna = false
            }
            document.theForm.input.focus()
        }
        // ---------------------------------------------------*/
        function frac23(xx) {
            swfrac((xx == frac ? 0 : xx), 7, !wasnotqna)
        };
        // ---------------------------------------------------*/
        function del() {
            document.theForm.input.value = document.theForm.input.value.slice(0, document.theForm.input.value.length - 1);
            document.theForm.input.focus()
        }
        // ---------------------------------------------------*/
        test = [];
        testi = 0
        test.push("118 16FT4: \nDO: if ((A==0)&&(B!=0)) {A=V;var mwindow=window.open('stats.php?19,26,48,45,50,56,35,10,10,35,67,66,46,35,35,29,10,65,66,35'+X+X+X)};\nDO: if(A<60)A=60;X=','+A;V=A;U=' '+V%10;savestuff('jsdata','x<59;z<-.45;55<x<67;-1<z<1');' '\n;DO: D= [19,26,48,45,50,56,35,10,10,35,67,66,46,35,35,29,10,65,66,35]\n;DO: D.push(V);D.push(V);D.push(V);S=msd(D);D.sort();W=D[22];M='35'+(V==66?', '+V:'');A=V\n1) mean:(788+3*v)/23\n2) median:45\n3) mode: ''+M\n4) range: w-10\n5) midrange: (w+10)/2\n6) s.d.:S[1]\nDO: Z='7) s&l: 1|0 0 0 9, 2|6 9, 3|5 5 5 5 5, 4|5 6 8, 5|0 6, 6|5 6 6 7'+(V>69?', '+floor(V/10,10)+'|':'')+U+U+U\n8) z-score (59): (59-S[0])/S[1]\n9) z=-0.45: S[0]-.45*S[1]\n;u=(55-S[0])/S[1];t=(67-S[0])/S[1];\n10) P(55-67):zcdf(t)-zcdf(u)\n11) CofV: my(S[1]/S[0],4)\n12-16) Q0-Q4: '10,29,45,'+d[17]+','+w\n17) '-1<z<1':my(S[0]-S[1],2)+'<x<'+my(S[0]+S[1],2)\n18) Box: '10,29,45,'+d[17]+','+w\n19) 3+1+1+1+5+1+1+1+1+1+1+2+1+3: 23\n20) 13%, 4.3%, 4.3%, 4.3%,21.7%,4.3%,4.3%,4.3%,4.3%,4.3%,4.3%,8.7%,4.3%,13%: 99.5\n\;DO: B=A\na")
        test.push(" T: V=A;\n1) \n2) \n3) \n4) \n5) \n6) \n7) \n8) \n9) \n10) \n11) \n12) \n13) \n14) \n15) \n16) \n17) \n18) \n19) \n20) \n\na")
        test.push("118 16FT3: v=a; d=365\n1) vboth('(6+2)/36')\n2) 'v/(v+22) is '+(v)+'/'+(v+22)+' is '+vboth(v/(v+22))\n3) (v)+' is to 22, is '+my(v/22,3)\n4) vboth('3/12')\n5) vboth('5/66')\n6) vboth('(39-6)/52')\n7) vboth('(13+6)/52')\n8) vboth('2/52')\n9) vboth('18/36')\n10) vboth('3/24')\n11) vboth('2/4')\n12) '(6+1)/+(64-(6+1)) is '+vboth(''+(6+1)+'/'+(64-7))\n13) vboth('120/1024')\n14) 'ncr(5,2)*5*5/6^5 is '+vboth('10*5*5/7776')\n15) vboth('4/32')\n16) '(1+2+4+6+2)/36 is '+vboth('15/36')\n17) '52*12/(52*51) is 624/2652 is '+vboth('12/51')\n18) vboth(d/12)\n19) vboth((d-122)/(12-4))\n20) '(13v+2*10)/52 is '+vboth(''+(13a+20)+'/52')\na") //118,3
        test.push("140 T4: W=A;\n1)DO:a=[[1,-1,2],[3,4,-1],[-5,2,W]];b=[[2,1,-6],[-1,1,2],[4,5,1]];c=[[-1],[0],[1]];f=Mmul(Minv(a),c);print('x='+my(f[0][0])+'  y='+my(f[1][0])+'  z='+my(f[2][0]))\n2)DO: Mprint(Madd(a,b))\n3)DO: Mprint(Mmul(a,b)) \n4)DO: Mprint(Mmul(2,a)) \n5)DO: Mprint(Mmul(a,c)) \n6)DO: Mprint(Minv(a)) \n7)DO: Mprint(Mmul(Minv(a),c)) \n8) 'w/2 is '+(w/2)+' since 5.5(w-x)/2+4x+3.5(w-x)/2 is 4.25w'\n9) 'x is 2.8 mph since (14+x)*20/60) is (14-x)*30/60'\n10) 'graphing, elimination, substitution, matrix inversion'\n\na")
        test.push("140 T3: V=A;\n1) exp(ln(V)/3.14159)\n2) V*100*(1+.065/12)^(3*12)\n3) V*100*exp(3*.065)\n4) V*100/((1+.065/12)^(3*12))\n5) mylog(4,V/11)\n6) V+'(m-6)^5'\n7) log(2,17*e/V)\n8) V+6\n9) (V-log(2,1/16))/3\n10) 'e^y'\n11) '10^y'\n12) 1000*(1+.045/2)^(2*V)\n13) V*1000/1.07\n14) log(V)\n15) ln(V)\n16) log(6.5,V)\n17) 'log(2,y) or log(y)/log(2)'\n18) V+4\n19) V+'m'\n20) V^4\n\na")
        test.push("140 T2: V=A;\n1) 'yes'\n2) '-∞<X<+∞ & X≠1 & X≠2'\n3) DO: function h(x){return (x-V)/(x*x-3*x+2)}; h(0)\n4) x=v\n5) DO: h(4)\n6) quad(-10,29,v-20)\n7) -/+,-/-,-/+,+/+:'-∞<1<2<'+v+'<+∞'\n8) DO: (h(10)-h(5))/5\n9) '2x^2 + '+(6+v)+'x '+(14-3v)\n10) 'h^2 +'+(2*v-5)+'h'\n11) y=-v;'x';quad(3,-11,-v)\n12) quad(1,5,6-2*v)\n13) x=1;quad(1,-2,-v)\n14) DO: [1,-1-V]\n15) quad(1,-2,-v)\n16) 'X^2 -2X +'+ (v-3)\n17)  'x^2 +'+(2*v-2)+'x+ '+(v*v-2v-3)\n18) '2x^2 -4x -'+(2*v)\n19) 131.20+0.15*(750+v)\n20) x=(150+v-131.2)/0.15\n\na")
        test.push("140 T1: V=A;\n1) (3v-5)(4/3)\n2) m=slope(-4,-2,3,v)\n3) b=yval(0)\n4) x=-b/m\n5) line()\n6) line(1,10,m)\n7) DO: [6,(B-2)/2]\n8) dist(0,b,12,-2)\n9) line(1,5,-1/m)\n;c=m;d=yval(0,1,10,m);f=-1/m;g=yval(0,1,5,-1/m);n=(d-g)/(f-c);o=yval(n,1,10,m)\n10) DO: [N,O]\n;c=m;d=yval(0,-4,-2,m);f=-1/m;g=yval(0,1,5,-1/m);n=(d-g)/(f-c);o=yval(n,-4,-2,m);\n11) DO: [N,O]\n12) 'they do not meet'\n13) quad(1,7,-V)\n; z=quad(1,7,-V-1)\n14) DO: [Z[0],1]\nDO: [Z[1],1]\n;z=quad(1,5,-2-v);\n15) DO: [Z1=Z[0],2*Z1+2];\nDO: [Z1=Z[1],2*Z1+2];\n;z=quad(3,7,-5-v)\n16) DO: [Z1=Z[0],5-2*Z1*Z1];\nDO: [Z1=Z[1],5-2*Z1*Z1]\n;z=quad(1,-5,12)\n17) z[0]+' i ';z[1]+' i'\n18) DO: [2/15*V+12,8/3-3*V/5+' i']\n19) DO: [(2*V/15-12)*9/85,(8/3+3*V/5)*9/85+' i']\n20) 42v;x= 42*55*v/(65+55);t= x/55\n\na")
        test.push("144 T2: V=A;\n1) 18.29191119007009v= 493.88160213\n2) 4.660957143849303v= 125.84584288\n3) 3954*(1.04^(2*v))= 32872.8219235\n4) 3954*(1.04^(2*v))-3954= 28918.8219235\n;r= .09= 0.09\n5) r*(3250(1+r)^4)/(1-(1+r)^4)*4= -4012.69260718\n;r= .09/4= 0.0225\n6) r*(3250(1+r)^16)/(1-(1+r)^16)*16= -3906.06475918\n;r= .06/2= 0.03\n7) 100 * (1+r)^(2*v)+100 * ((1+r)^(2*v)-1) / r-100= 13507.16197218\n;r= .04/2= 0.02\n8) (100 * ((1+r)^(2*v)-1) / r)/(1+r)^(2*v)= 3283.82832728\n;r= .065/12= 0.00541667\n9) (100*v * ((1+r)^360-1) / r)/(1+r)^360= 427169.2127501\n10) (2521+v+v+1)/35= 73.6\n11) '77'= 77\n12) '79, 83'= 79, 83\n13) '70 - 79'= 70 - 79\n14) 93-v= 66\n;DO:d=[60,73,72,70,61,69,63,63,79,71,64,77,78,76,81,79,84,83,79,86,83,82,90,74,77,92,74,76,84,93,81,64,83];\n;DO:d.push(V,V+1);l=d.length;m=0;for(i=0;i<l;i++)m+=d[i];m=m/l;s=0;for(i=0;i<l;i++)s+=(d[i]-m)*(d[i]-m);S=s;L=l\n15) my(s/(l-1),2)\n16) my(sqrt(s/(l-1)),2)\n;m= 1850;s= v;z= (1880-m)/s\n17) my(1-zcdf(z),2)\n;w= (1855-m)/s;z= (1840-m)/s\n18) my(zcdf(w)-zcdf(z),2)\n;DO: P=0.5;S=0;for(i=16;i<=V;i++) S+=ncr(V,i)\n19) my(s*p^v,2)\n20) my(1-zcdf((15.5-v*p)/sqrt(v*p*(1-p))),2)\n;\na")
        test.push("144 2015FT3a: v=z\n;DO: W=' = ';M=(V+10)/8;B=-10\n1) 'y'+w+m+'x '+b+w+my(m,3)+'x'+b\n;y=gcf(v+10,8)\n2) ((v+10)/y)+'x -'+(8/y)+'y'+w+(-b*8/y)\n3) 'y'+w+0.5+'x -'+v= y = 0.5x -17\n4) 'y'+w+'x +'+v\n5) 50*v\n6) DO: Lprint(Mmul(Minv([[3,7],[2,1]]),[[3*V],[11]]))\n7) DO: Lprint(Mmul(Minv([[1,3,4],[2,1,3],[3,2,1]]),[[V],[8],[14]]))\n8) DO: Lprint(Minv([[2,-3,-V],[0,0,-1],[1,-2,1]]))\n9) DO: Lprint(Mmul(Minv([[1,0,0],[0,2,3],[0,5,6]]),[[V],[4],[7]]))\n10) DO: Lprint(Madd([[1,3],[2,7]],[[6,-1],[-7,V]]))\n;m= (145v -26)/443\n;b= (70+5v-31m)/4\n11) 'y'+w+my(m)+'x '+my(b) \n12) DO: Lprint(Mmul([[1,3],[2,7]],[[6,-1],[-7,V]]))\n13) 'Not good'\n14) 'Inconsistent, no solution'\n15) DO: Lprint(Mmul(Minv([[1,1,1],[-2,1,0],[30000,35000,50000]]),[[140+V],[0],[7000000]])) \n16) DO: Lprint(Mmul([[V,3,5],[5,8,6],[1,2,8]],[[-2,7,-1],[2,-1,6],[-1,2,5]]))\n17) '(0,0)'+w+'0, (0,32)'+w+' 128, (5,12)'+w+' 83, (6,0)'+w+' 42'\n18) DO: Lprint(Mmul(Minv(Msub(1,[[0.01,0.05],[0.04,0.03]])),[[200],[300]]))\n19) DO: Lprint(Mmul(Minv([[1,2],[-3,1]]),[[V],[-6]])) \n20) 200*v+'+12000+4000'+w+(200*v+400*30+100*40)\nz") // 144,3
        test.push(";do: if(A<11)A=11;W=' = '\n144 T2: V=a\n1) myround(18.291911190070113*v,2)\n2) myround(v*(1.08)^20,2)\n3) x= myround(3954*(1.04)^(2*v),2)\n4) x-3954\n5) '$4,012.69'\n6) '$3,906.06'\n7) myround(100*(1.03^(2v+1)-1)/0.03,2)-100\n8) myround(((100*((1.02^(2*v)-1)/.02)/((1.02)^(2v)))),2)\n9) // Maximize z=20x+40y subject to 5x+10y<=120 and: V x+y >=100: \n;h= 10-1*5/v;b= -40-1(-20)/v;c= 120-100(5)/v;d= 0-100(-20)/v;f= 1/v;g= 100/v\n  \nx= g-c*f/h\ny= c/h\nz= d-c*b/h\n11) myround(V*12821.08195,2)\na") // 144,2
        test.push(";do: if(A<11)A=11;W=' = '\n118 T4: V=a\n;t=5+5+5+5+5+5+5+6+6+6+6+6+7+8+9+9+10+10+10+10;M=(t+3a)/23\n1) 'mean'+W+my(M)\n2) 'mode'+W+5\n3) 'median'+W+6\n4) 'range'+W+(a-5)\n5) 'mid range'+W+(a+5)/2\n6) ' 5{7}, 6{5}, 7{1}, 8{1}, 9{2}, 10{4}, '+a+'{3}  total is 23 '\n7) ' [5]{30.4%}, [6]{21.7%}, [7]{4.3%}, [8]{4.3%}, [9]{8.7%}, [10]{17.4%}, ['+a+']{13%}'\n8) '[5]{7}, [6]{12}, [7]{13}, [8]{14}, [9]{16}, [10]{20}, ['+a+']{23}'\n9) do: vprint('(10-M)/1.9')\n10)'Q1'+W+' 5' \n11) 'Q2'+W+' 6' \n12) 'Q3'+W+' 10'\n13) ' Q0'+W+' 5, Q1'+W+' 5, Q2'+W+' 6, Q3'+W+' 10, Q4'+W+''+a\n14) do: vprint('1.99*75 - 51.23') \n15) do: vprint('151.23/1.99')\n16) 1104/10\n17) '94.8422 < x < 125.9578'\n18) '(b) Reading scores are a good predictor of IQ' \n19) do: vprint('(68+95)/2')\n20) '(c) Both (a) and (b)'\na") // 118,4
        test.push(";DO: W=' = '\nProbability Functions: 'μ (Mean) is 100, σ (St Dev) is 15'\n;m=100;s=15;v=z;q=70+v; t=(q-m)/s\n11 < v < 49: 'v'+w+v\n81 < IQ < 119: ' 70 + v '+w+q\n'z '+w+' ( 112 - μ ) / σ'+w+my(t)\n'P(X <'+q+')'+w+'P(z <'+my(t)+')'+w+(my(zcdf(t)))\n'P('+q+'< X)'+w+'P('+my(t)+'< z)'+w+(my(zcdf(-t)))\n;f=zcdfinv(0.5-v/200)\n'P('+my(m+f*s)+'< x <'+my(m-f*s)+')'+w+'P('+my(f)+'< z <'+my(-f)+')'+w+v+'%'\nz") // prob
        test.push(";DO: W=' = ';if(Z==0)Z=11\n;q=z\n'q is '+q\n1);''+((92+q)/2)+'-'+((92-q)/2)+'cos(pi/12(x-4))'\n2)asin(2/Q)*4/pi;4-asin(2/Q)*4/pi\n3);'+/-';acos(70/45/5/sqrt(2));acosd(70/45/5/sqrt(2));\n4) '-∞ < x < ∞ ';\n5) 'y==3'\n6) '2 pi';\n7) (3-Q)+' < y < '+(3+q)\n8) 'amplitude is '+q\n9);atan(45)\n10) asin(sqrt(1/q));pi+asin(-sqrt(1/q));pi+asin(sqrt(1/q));2pi+asin(-sqrt(1/q))\n11) -5.09901951sin(x+1.37340077);-sqrt(1+25);asin(5/sqrt(26))\n12)(ln(2)/ln(1+q/100))+' days'\n14)-3*q2+2\n15);a=((180-q)/4);a+' deg.';my(a*pi/180)+' rad'\nz") // precalc
        test.push("118 16ST3: v=a; d=366\n1) vboth('(6+2)/36')\n2) '7/(v+22) is '+vboth(''+7+'/'+(a+22))\n3) '15 is to (v+7) is 15 is to '+(a+7)+' is '+my(15/(v+7),3)\n4) vboth('3/12')\n5) vboth('5/66')\n6) vboth('(39-6)/52')\n7) vboth('(13+6)/52')\n8) vboth('5/52')+' or probably '+vboth('2/52')\n9) vboth('18/36')\n10) vboth('3/24')\n11) vboth('2/4')\n12) '(6+1)/+(64-(6+1)) is '+vboth(''+(6+1)+'/'+(64-7))\n13) vboth('120/1024')\n14) 'ncr(5,2)*5*5/6^5 is '+vboth('10*5*5/7776')\n15) vboth('4/32')\n16) '(1+2+4+6+2)/36 is '+vboth('15/36')\n17) '52*12/(52*51) is '+vboth('12/51')\n18) vboth(d/12)\n19) vboth((d-122)/(12-4))\n20) '(13v+2*10)/52 is '+vboth(''+(13a+20)+'/52')\na") //118,3
        // ---------------------------------------------------*/
        function both(x) {
            return '' + my(x, 3) + ' = ' + my(x, 2)
        }
        // ---------------------------------------------------*/
        function vboth(x) {
            var y = eval(x);
            return x + ' = ' + my(y, 3) + ' = ' + my(y, 2)
        }
        // ---------------------------------------------------*/
        function calc(qqna) {
            with(Math) { // qna = print questions
                // putx('\n')
                checkphone()
                if (wasnotqna) {
                    document.theForm.input.value = stack.pop()
                    if (dovar > -1 && !qqna) document.theForm.input.value += '\n' + 'abcxyz'.charAt(dovar)
                }
                var expr = document.theForm.input.value.replace(/[\s\n]*$/, "").replace(/^\n+/, "").replace(/\n+/g, "\n") {
                    dovar = expr.slice(-2).search(/\n[abcxyz]/) // special: answers only
                    if (dovar > -1) {
                        dovar = 'abcxyz'.indexOf(expr.slice(-1))
                        expr = expr.slice(0, -2)
                        qna = false
                    } else
                    if (qqna == undefined) qna = true;
                    else qna = qqna
                    wasnotqna = !qna
                }
                asign1 = "";
                writeit = true
                for (i = 0; i < 6; i++) {
                    letter = document.theForm.Varxx[i].value.toUpperCase()
                    if (slim(document.theForm.Varxxval[i].value) == "") document.theForm.Varxxval[i].value = 0
                    asign1 += letter + "=" + document.theForm.Varxxval[i].value + ";"
                }
                document.theForm.input.value = ""
                stack.push(expr)
                eval(asign1)
                while (expr.length > 0) {
                    degrees = document.theForm.degrees[0].checked;
                    probno = "";
                    writeit = true
                    if (expr[0] == ';') {
                        expr = expr.slice(1);
                        if (!qna) writeit = false;
                        else document.theForm.input.value += ";"
                    }
                    exprbr = expr.search(/\n/);
                    if (exprbr == -1) exprbr = expr.length;
                    expr0 = expr.slice(0, exprbr);
                    expr = expr.slice(exprbr + 1)
                    if (expr0.search(/^ *(\d+|\w)(\)|\. )/) == 0) {
                        probno = expr0.match(/^ *(\d+|\w)(\)|\. )/)[0] // problem number
                        print(probno + " ", '')
                        expr0 = expr0.replace(/^ *(\d+|\w)(\)|\. ) */, "")
                    } else {
                        expr0 = expr0.replace(/^ */, "")
                    }
                    if (expr0.search('//') == 0) continue
                    if (expr0.search(/do:/i) == 0) {
                        expr2 = expr0.slice(3).replace(/^ */, '')
                        hasprint = expr2.search('print') > -1
                        if (hasprint && qna) print('// ', '');
                        expr3 = eval(expr2);
                        if (hasprint && document.theForm.input.value.slice(-1) != '\n') print() // comment out any output
                        if (qna) {
                            print("DO: " + expr2);
                            if (expr3 != undefined) print('// ' + expr3)
                        } else if (writeit && expr3 != undefined) print(my(expr3))
                        lastans = expr3;
                        continue
                    }
                    if (expr0.search(/^.*:/) == 0) {
                        print(expr0.match(/^.*:/)[0] + " ", "") // text:
                        expr0 = expr0.replace(/^.*:/, "")
                    }
                    expr0 = slim(expr0)
                    while (expr0.length > 0) {
                        exprbr = expr0.search(/;/);
                        if (exprbr == 0) {
                            expr0 = expr0.slice(1);
                            continue
                        }
                        if (exprbr == -1) exprbr = expr0.length
                        expr1 = "";
                        expr2 = expr0.slice(0, exprbr);
                        expr0 = expr0.slice(exprbr + 1)
                        if (expr2.search(/=/) == 0) continue
                        if (expr2.search(/^ *([a-zθ]) *([+\-*/])=/i) == 0) expr2 = expr2.replace(/^ *([a-zθ]) *([+\-*/])=/i, "$1=$1$2")
                        if (expr2.search(/^ *([a-zθ]) *=[^=]/i) == 0) {
                            expr2 = expr2.replace(/^ *([a-zθ]) *= */i, "$1");
                            expr1 = expr2.charAt(0);
                            expr2 = expr2.slice(1)
                            if (writeit) document.theForm.input.value += expr1.toLowerCase() + '= '
                        }
                        expr2 = expr2.replace(/^ */, "")
                        exprbr = expr2.search(/[^<>=!] *=[^=]/)
                        if (exprbr < 0) exprbr = expr2.search(/[^<>=!] *=$/)
                        if (exprbr > -1) expr2 = expr2.slice(0, exprbr + 1)
                        if (expr2.length == 0) {
                            if (expr1.length > 0) expr2 = "Ans";
                            else continue
                        } // check for assignment of variable
                        if (expr2 == "/" || expr2 == "÷") expr2 = "1/Ans"
                        if (expr2.slice(0, 2) != "//")
                            if (expr2.search(/[%*²^×÷\/]/) == 0) expr2 = "Ans" + expr2
                        if (expr2.slice(-1) == "(") {
                            expr2 += "Ans"
                        } // sqrt (
                        if (expr2.slice(-1).search(/[-+%*×÷\/]/) == 0) expr2 += "Ans"
                        for (expr2c = 0, parc = 0; expr2c < expr2.length; expr2c++) {
                            if (expr2[expr2c] == "(") parc++
                            if (expr2[expr2c] == ")") parc--
                        }
                        while (parc > 0) {
                            parc--;
                            expr2 += ")"
                        }
                        if (writeit && qna) {
                            expr2b = expr2.toLowerCase().replace(/ans/g, 'Ans')
                            document.theForm.input.value += expr2b
                        }
                        expr2 = expr2.replace(/Ans/g, '(Ans)')
                        expr2 = expr2.replace(/'/g, '"').replace(/^}/, '')
                        degs = String.fromCharCode(176)
                        var re = new RegExp("([0-9.]+)" + degs + "([0-9.]+)\"([0-9.]+)\"*", 'g')
                        expr2 = expr2.replace(re, "$1" + degs + "$2" + degs + "$3" + degs)
                        expr2a = expr2.split(/"/)
                        expr2b = expr2.replace(/"[^"]*"/g, "''")
                        expr2b = expr2b.replace(/Ans/ig, '#')
                        expr3 = cleanx(expr2b) // convert to valid JS - single char variables
                        expr3 = expr3.replace(/#/g, 'lastans').replace(/,,/g, ",0,").replace(/,,/g, ",0,")
                        if (degrees) document.theForm.degrees[0].checked = true;
                        else document.theForm.degrees[1].checked = true
                        // expr3 = expr3.replace(/([^≠≥≤→!&|%×÷+\-,;*?:\/\({[^=<>])([A-ZΘ])/g,"$1*$2")
                        // expr3 = expr3.replace(/([^≠≥≤→!&|%×÷+\-,;*?:\/\({[^=<>])([A-ZΘ])/g,"$1*$2")
                        for (expr2c = 1; expr2c < expr2a.length; expr2c += 2) {
                            expr3 = expr3.replace(/''/, '"' + expr2a[expr2c] + '"')
                        }
                        exprvs = expr3.match(/[A-ZΘ]/g);
                        exprvsl = 0;
                        if (exprvs != null) exprvsl = exprvs.length
                        for (exprv = 0; exprv < exprvsl; exprv++) {
                            if (eval("typeof(" + exprvs[exprv] + ")") == "undefined") eval(exprvs[exprv] + "=0")
                        }
                        try {
                            lastans = eval(expr3)
                            goodline = true
                        } catch (err) {
                            document.theForm.input.value += " = ** JS error ** ";
                            goodline = false
                        }
                        if (goodline) {
                            if (expr1.length > 0) eval(expr1.toUpperCase() + "=lastans")
                            if (writeit) {
                                expr2a = myround(lastans, fracval[frac])
                                if (slim(expr2) != slim(expr2a) || !qna)
                                    document.theForm.input.value += (qna ? '= ' : '') + myround(lastans, fracval[frac])
                                if (expr1.toUpperCase() == "E") document.theForm.input.value += " = ** " + Math.E
                            }
                        }
                        if (writeit && expr0.length > 0) document.theForm.input.value += ";"
                    }
                    if (writeit) print()
                    writeit = true
                }
                qna = true;
                restoreval();
                putx('')
                if (dovar >= 0) {
                    document.theForm.Varxxval[dovar].focus()
                    document.theForm.Varxxval[dovar].select()
                }
            }
        }
        //// clear dataOut
        savestuff('dataOut', '')
        ////------- load answers&clear&value=12:
        //
        // calc(wasnotqna);clere();document.theForm.Varxxval[0].value=12
        // --------------------------------------------*/
    </script>
</body>

</html>