<!DOCTYPE html>
<html lang="en">

<head>
    <title>Logic Calculator</title>
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus();document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <script type="text/javascript" src="myfunctions.js"></script>
    <!--
1. statements into document.theForm.indata.value
2. Show truth table: table(): calls logic(): eval(jsrun)
3. logic():
      strips off comment into comline
      js into jsrun
      english words into document.theForm.indata.value
      document.theForm.input.value:
         comline, truth table
-->
    <script>
        // ---------------------------------------------------*/
        function clere() {
            nextext = '';
            lprogsI = lprogs.length
            document.theForm.indata.value = ""
            document.theForm.input.value = ""
            document.theForm.indata.focus()
        }
        // ---------------------------------------------------*/
        function enter(evt, xx) {
            var KEYcode = evt.keyCode;
            if (KEYcode == 13) // enter
            {
                if (document.theForm.indata.value == "") show(1)
            }
            if (KEYcode == 18) logic() // alt
            if (KEYcode == 27) clere()
        } // esc
        // ---------------------------------------------------*/
        function doit(confr, conto) {
            nowl = now.split(/\n/)
            confr = confr.replace(/\\n/g, "\n") // convert the characters \n to \n
            conto = conto.replace(/\\n/g, "\n") // convert the characters \n to \n
            var re = new RegExp(confr, "g")
            for (i = 0; i < nowl.length; i++) nowl[i] = nowl[i].replace(re, conto)
            document.theForm.indata.value = nowl.join("\n")
            now = document.theForm.indata.value;
            document.theForm.input.focus()
        }
        // ---------------------------------------------------*/
        function logic() {
            jsrun = "";
            commline = '';
            now = document.theForm.indata.value.replace(/^\n*/, '')
            if (slim(now) == '')
                if (document.theForm.input.value.search(/:/) > -1) now = document.theForm.input.value;
                else {
                    show(0);
                    return
                }
            colpos = now.lastIndexOf(":") + 1
            if (colpos > 0) {
                commline = now.slice(0, colpos);
                now = slim(now.slice(colpos))
                colpos = commline.lastIndexOf("\n\n") + 1;
                if (colpos > 0) nextext = commline.slice(0, colpos)
                colpos = commline.lastIndexOf("\n") + 1;
                if (colpos > 0) commline = commline.slice(colpos)
            }
            now = now.replace(/  */ig, " ") // two or more spaces
            savel.push(commline + (commline.length > 0 ? '\n' : '') + now);
            document.theForm.indata.value = now;
            document.theForm.input.focus()
            if (now.length == 0) {
                return
            }
            now = now.replace(/, */ig, ",").replace(/~/, " not ").replace(/\/\\/g, "∧").replace(/\\\//g, "∨").replace(/_/g, "-")
            doit(String.fromCharCode(151), "-") // ASCII m-dash  = HTML &#8212;
            doit(String.fromCharCode(150), "-") // ASCII n-dash  = HTML &#8211;
            doit(String.fromCharCode(8212), "-") // ASCII m-dash  = HTML &#8212;
            doit(String.fromCharCode(8211), "-") // ASCII n-dash  = HTML &#8211;
            now = now.replace(/\[/g, "(").replace(/\{/g, "(").replace(/\]/g, ")").replace(/\}/g, ")")
            doit("≠", " xor ")
            doit("⊻", " xor ")
            doit("!=", " xor ")
            doit("⇒", " imp ")
            doit("→", " imp ")
            doit("⊃", " imp ")
            doit("⊢", " imp ")
            doit("•", " and ")
            doit("\\\^", " and ")
            doit("\&\&*", " and ")
            doit("⋀", " and ")
            doit(scap, " and ")
            doit("∙", " and ")
            doit("\\\*", " and ")
            doit("•", " and ")
            doit("⊢", " then ")
            doit("→", " then ")
            doit("imp[a-z]*", " then ")
            doit("⊃", " then ")
            doit("⇒", " then ")
            doit("equiv", "equ")
            doit("v", " or ")
            doit("⋁", " or ")
            doit(scup, " or ")
            doit("\/", " or ")
            doit("⊕", " xor ")
            doit("\\\+", " or ")
            doit("equi*", " equiv ")
            doit("⇔", " equiv ")
            doit("≡", " equiv ")
            doit("↔", " equiv ")
            doit("\\\<--*\\\>", " equiv ")
            doit("\\\<==*\\\>", " equiv ")
            doit("==*\>", " then ")
            doit("--*\>", " then ")
            doit("==*", " equiv ")
            doit("~", " not ")
            doit("!", " not ")
            doit("¬", " not ")
            doit("----*", " therefore ")
            doit("∴", " therefore ")
            doit("├", " therefore ")
            doit("-", " not ")
            doit(", *", ",")
            doit("  *", " ")
            xx = now.replace(/therefore|therefor/ig, "\n----\n").replace(/[∴├]/ig, "\n----\n").replace(/[,\n]/ig, ";")
            xx = xx.replace(/<-+>/ig, "equ")
            xx = xx.replace(/-+>/ig, "→")
            if (xx.search(/---/) != -1) {
                xxx = xx.split(/;/);
                xx1 = '';
                xx2 = ''
                if (xx.length > 1) {
                    do {
                        xx3 = xxx.pop()
                    } while (xx3.replace(/\s/g, '').length == 0)
                    for (i = 0; i < xxx.length; i++) {
                        if (xxx[i].replace(/\s/g, '').length > 0 && xxx[i].search(/---/) == -1) {
                            xx1 += ',' + xxx[i];
                            xx2 += 'and(' + xxx[i] + ')'
                        }
                    }
                    if (xx2.length == 0) xx = xx3
                    else xx = xx1.slice(1) + ';' + xx3 + ';(' + xx2.slice(3) + ')impl(' + xx3 + ')'
                }
            }
            xx = xx.replace(/\n/g, '')
            xx = xx.replace(/not/ig, "~")
            xx = xx.replace(/!=/ig, "≠")
            xx = xx.replace(/!/ig, "~")
            xx = xx.replace(/¬/ig, "~")
            xx = xx.replace(/xor/ig, "≠")
            xx = xx.replace(/if /ig, "")
            xx = xx.replace(/or/ig, scup)
            xx = xx.replace(/\|+/ig, scup)
            xx = xx.replace(/⋁/ig, scup)
            xx = xx.replace(/•/ig, scap)
            xx = xx.replace(/and/ig, scap)
            xx = xx.replace(/\^/ig, scap)
            xx = xx.replace(/\&+/ig, scap)
            xx = xx.replace(/⋀/ig, scap)
            xx = xx.replace(/equ[a-z]*/ig, String.fromCharCode(8596))
            xx = xx.replace(/iif/ig, String.fromCharCode(8596))
            xx = xx.replace(/⇔/ig, String.fromCharCode(8596))
            xx = xx.replace(/\<-+\>/ig, String.fromCharCode(8596))
            xx = xx.replace(/\<=+\>/ig, String.fromCharCode(8596))
            xx = xx.replace(/=+/ig, String.fromCharCode(8596))
            xx = xx.replace(/v/ig, scup)
            xx = xx.replace(/⊢/ig, "→")
            xx = xx.replace(/then/ig, "→")
            xx = xx.replace(/imp[a-z]*/ig, "→")
            xx = xx.replace(/=+\>/ig, "→")
            xx = xx.replace(/-+\>/ig, "→")
            xx = xx.replace(/⊃/ig, "→")
            xx = xx.replace(/⇒/ig, "→")
            xx = xx.replace(/-/ig, "~")
            var re = new RegExp(String.fromCharCode(8756), "g");
            xx = xx.replace(re, "→")
            xx = xx.replace(/[;,\n]/ig, ";").replace(/;;+/ig, ";").replace(/^[\s;]+/ig, "").replace(/[\s;+]+$/ig, "").replace(/;/ig, " ; ")
            xxa = xx.replace(/→/ig, ",")
            xxa = cleanx(xxa) // convert to valid JS - single char variables
            exprvs = xxa.match(/[A-ZΘ]/g);
            exprvsl = 0;
            if (exprvs != null) exprvsl = exprvs.length
            for (exprv = 0; exprv < exprvsl; exprv++) {
                if (eval("typeof(" + exprvs[exprv] + ")") == "undefined") eval(exprvs[exprv] + "=true")
                else eval(exprvs[exprv] + "=true==" + exprvs[exprv])
            }
            a2 = xxa.search(/A/i) > -1;
            b2 = xxa.search(/B/i) > -1;
            c2 = xxa.search(/C/i) > -1;
            p2 = xxa.search(/P/i) > -1;
            q2 = xxa.search(/Q/i) > -1;
            r2 = xxa.search(/R/i) > -1;
            s2 = xxa.search(/S/i) > -1;
            t2 = xxa.search(/T/i) > -1;
            u2 = xxa.search(/U/i) > -1; // V is seen as "or"
            w2 = xxa.search(/W/i) > -1;
            x2 = xxa.search(/X/i) > -1;
            y2 = xxa.search(/Y/i) > -1;
            z2 = xxa.search(/Z/i) > -1;
            spc1 = ' ';
            spc2 = spc1 + spc1;
            spc3 = spc2 + spc1;
            spc4 = spc3 + spc1
            SS1 = (a2 ? spc2 : '') + (b2 ? spc2 : '') + (c2 ? spc2 : '') + (p2 ? spc2 : '') + (q2 ? spc2 : '') + (r2 ? spc2 : '') + (s2 ? spc2 : '') + (t2 ? spc2 : '') + (u2 ? spc2 : '') + (w2 ? spc2 : '') + (x2 ? spc2 : '') + (y2 ? spc2 : '') + (z2 ? spc2 : '') + spc4 + '1:'
            m = -1;
            I = 2;
            while ((n = xx.indexOf(';', m + 1)) > -1) {
                SS1 += xx.slice(m + 1, n).trim() + '; ' + (I++) + ':';
                m = n
            };
            SS1 += xx.slice(m + 1).trim()
            SS3 = (a2 ? "a " : "") + (b2 ? "b " : "") + (c2 ? "c " : "") + (p2 ? "p " : "") + (q2 ? "q " : "") + (r2 ? "r " : "") + (s2 ? "s " : "") + (t2 ? "t " : "") + (u2 ? "u " : "") + (w2 ? "w " : "") + (x2 ? "x " : "") + (y2 ? "y " : "") + (z2 ? "z " : "")
            nn = SS3.length / 2
            SS4 = '1' + spc3;
            n = -1;
            I = 2;
            while ((n = xx.indexOf(';', n + 1)) > -1) SS4 += pad(I++, 4)
            SS1 = SS1.replace(/↔/ig, "⇔").replace(/ /g, '').replace(/→/ig, "⇒")
            SS1 = commline + (commline.length > 0 ? '\\n' : '') + SS1
            jsrun += "nnn=0;SS1='" + SS1 + "';SS3='" + SS3 + "';SS4='" + SS4 + "';SS5=''\nvar tf=[true,false];" + (a2 ? " for(a1 in tf)" : "") + (b2 ? " for(b1 in tf)" : "") + (c2 ? " for(c1 in tf)" : "") + (p2 ? " for(p1 in tf)" : "") + (q2 ? "for(q1 in tf)" : "") + (r2 ? "for(r1 in tf)" : "") + (s2 ? "for(s1 in tf)" : "") + (w2 ? "for(w1 in tf)" : "") + (t2 ? "for(t1 in tf)" : "") + (u2 ? "for(u1 in tf)" : "") + (x2 ? "for(x1 in tf)" : "") + (y2 ? "for(y1 in tf)" : "") + (z2 ? "for(z1 in tf)" : "") + "{" + (a2 ? " A=tf[a1]; " : "") + (b2 ? " B=tf[b1]; " : "") + (c2 ? " C=tf[c1]; " : "") + (p2 ? " P=tf[p1]; " : "") + (q2 ? " Q=tf[q1];" : "") + (r2 ? " R=tf[r1];" : "") + (s2 ? " S=tf[s1];" : "") + (t2 ? " T=tf[t1];" : "") + (u2 ? " U=tf[u1];" : "") + (w2 ? " W=tf[w1];" : "") + (x2 ? " X=tf[x1];" : "") + (y2 ? " Y=tf[y1];" : "") + (z2 ? " Z=tf[z1];" : "") + "\nSS5+='\\n'" + (a2 ? "+torf(A)" : "") + (b2 ? "+torf(B)" : "") + (c2 ? "+torf(C)" : "") + (p2 ? "+torf(P)" : "") + (q2 ? "+torf(Q)" : "") + (r2 ? "+torf(R)" : "") + (s2 ? "+torf(S)" : "") + (t2 ? "+torf(T)" : "") + (u2 ? "+torf(U)" : "") + (w2 ? "+torf(W)" : "") + (x2 ? "+torf(X)" : "") + (y2 ? "+torf(Y)" : "") + (z2 ? "+torf(Z)" : "") + "+'--> '"
            xxa = xxa + ";";
            jsoutput = ''
            while ((xxc = xxa.search(/;/)) > -1) {
                xxb = xxa.slice(0, xxc)
                xxa = xxa.slice(xxc + 1)
                i = 0;
                while ((i = xxb.indexOf(',', i + 1)) > -1) {
                    i1 = i;
                    i3 = 0
                    while (i1 >= 0) {
                        if (xxb.charAt(i1) == ')') i3++
                        else if (xxb.charAt(i1) == '(') {
                            if (i3 == 0) break;
                            else i3--
                        }
                        i1--
                    }
                    if (i1 == -1) {
                        xxb = 'imp(' + xxb + ')';
                        i += 4
                    } else {
                        xxb = xxb.slice(0, i1) + 'imp' + xxb.slice(i1);
                        i += 3
                    }
                }
                jsoutput += "+torf(" + xxb + ")"
                if (xxa.search(/;/) > -1) jsoutput += "+'; '"
            }
            jsoutput += " +'  ['+(++nnn)+']'}\nprint (SS1+'\\n'+SS3+'--> '+SS4+'[2^'+nn+'='+(Math.pow(2,nn))+']'+SS5);"
            jsrun += jsoutput
            jsrun = jsrun.replace(/F/g, 'false')
        }
        // ---------------------------------------------------*/
        function table() {
            logic();
            if (jsrun != '') {
                document.theForm.input.value = ""
                eval(jsrun)
                document.theForm.input.value = document.theForm.input.value.toUpperCase()
                document.theForm.indata.value = commline + (commline.length > 0 ? '\n' : '') + document.theForm.indata.value
                savestuff("dataOut")
            }
            document.theForm.indata.focus()
        }
        // ---------------------------------------------------*/
        function editjs() {
            logic()
            document.theForm.input.value = jsrun;
            savestuff('ijs')
            document.theForm.input.value = ""
            window.open('edit.php?ijs')
        }
        // ---------------------------------------------------*/
        function cut() {
            now = document.theForm.input.value
            colpos = now.lastIndexOf("\n\n") + 1
            if (colpos > 0) document.theForm.input.value = now.slice(0, colpos)
            else show(+1)
        }
        // ---------------------------------------------------*/
        function show(screen) {
            if (savel.length > 0) {
                document.theForm.indata.value = savel.pop();
                document.theForm.input.value = '';
                return
            }
            document.theForm.indata.value = "";
            document.theForm.input.value = ""
            lprogsI = (lprogsI + screen + lprogs.length) % lprogs.length;
            print(lprogs[lprogsI])
        }
        // ---------------------------------------------------*/
        function cnf() {
            document.theForm.input.focus()
            if (document.theForm.input.value == "") {
                print('Converts a truth table to conjunctive normal form (CNF):\np q r s -->  (p→q)∧(q→r)∧(r→s)\nT T T T --> T\nT T T F --> F\nT T F T --> F\nT T F F --> F\nT F T T --> F\nT F T F --> F\nT F F T --> F\nT F F F --> F\nF T T T --> T\nF T T F --> F\nF T F T --> F\nF T F F --> F\nF F T T --> T\nF F T F --> F\nF F F T --> T\nF F F F --> T\n')
                document.theForm.input.focus()
                return
            }
            xx = document.theForm.input.value.split(/\n/);
            yy = [];
            zz = ''
            for (xxi = 0; xxi < xx.length; xxi++) {
                xxx = xx[xxi].replace(/\s/g, '').replace(/\[\d*\]/, '')
                if ((yyi = xxx.indexOf("-->")) == -1) continue
                if (zz.length == 0) {
                    zz = xxx.slice(0, yyi);
                    continue
                }
                if (xxx.charAt(xxx.length - 1) == "F") continue
                yyy = '('
                for (j = 0; j < zz.length; j++) {
                    if (xxx.charAt(j) == "F") yyy += '~'
                    yyy += zz.charAt(j) + '∧'
                }
                yy.push(yyy.slice(0, yyy.length - 1) + ')')
            }
            document.theForm.input.value += ':' + yy.join('∨') + '\n';
            document.theForm.input.focus()
        }
        // ---------------------------------------------------*/
    </script>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <form name="theForm">
            <h2>Statements / Arguments</h2><input name="clearbut" Value="Clear All" type="button" onClick="clere()" title="Clear" />

            <textarea name="indata" rows=10 cols="68" onKeyUp="enter(event,0)"></textarea>

            <input name="tablebut" Value="Show Truth Table" type="button" onClick="table()" title="Table" />
            <input name="jsbut" Value="Pass JS to Editor" type="button" onClick="editjs()" title="DoJS" />
            <input name="cnfbut" Value="cnf" type="button" onClick="cnf()" title="truth table to CNF" />
            <input name="showbut" Value="again" type="button" onClick="show(-1)" title="back/repeat" />
            <input name="showbut" Value="next" type="button" onClick="show(1)" title="forward" />
            <textarea name="input" rows=25 cols=68 onKeyUp="enter(event,1)"></textarea>


        </form>
    </div>
    <script>
        savel = []
        lprogs = []
        scup = String.fromCharCode(8744)
        scap = String.fromCharCode(8743)
        var nextext = '';
        jsrun = ''

        lprogs.push('Logic is a branch of mathematics that works with Statements and Arguments instead of Numbers and Formulas.  It has its own special vocabulary. Some Logic words are:\n\nStatements must be True or False;\n  can not be a question, command, exclamation or paradox: This sentence is false.\nLogical Operators are used in compound statements. There are 16 of them including\nAND (∧, /\\ ), OR (∨,  \\/), NOT (~, ¬, !), XOR (⊻, ⊕, ≠), IMPL (→), EQUIV (↔)\n  They are called Conjunction, (inclusive) disjunction, negation, exclusive disjunction, implication, equivalence. \n  but not Ambition, Distraction, Uglification and Derision\nConditionals and their inverse, converse, and contrapositive\nDeMorgan\'s Laws, Truth Tables, Syllogisms, Arguments (Valid or Invalid)\nQuantifiers:  (negation of a universal is an existential)\n  universal quantifiers: all, each, every, no(one)\n  existential quantifiers: some, there exists, (for) at least one\nEuler diagrams, Venn Diagrams\n  Mastercard (some), Target (all), Snake eyes(none)\nSwitches (on, off), Circuits (Series, Parallel)\nextra topics: Logic Puzzles & Sudoku\nthe logical operators are:\np∨¬p,p∨q,q⇒p,p,p⇒q,q ,p⇔q,p∧q,¬p∨¬q,p≠q,¬q,p∧¬q,¬p,q∧¬p,¬(pvq),p∧¬p')
        lprogs.push('Statements & Truth Tables\n\nStatements must be either true or false. They can be combined into compound statements using Logical Operations, sort of like Arithmetic Operations. \nTruth Tables are like multiplication tables that give you the results of these operations.\n\nFor example, this is a compound statement-\n You are smart and you work hard\nIn Logic class we use letters to stand for simple statements\n  p = you are smart;  q = you work hard\nthen we put them into the compound statement \"p and q\", which is written:\n  p ∧ q')
        lprogs.push('Major Logic Operators and Equivalent Statements\n\nCompound statements use the variables p,q,r,s to represent simple statements and are combined with these operators \"not, and, equiv, or, xor\"\nwritten as \"(~, ¬, !) ' + scap + ' ' + String.fromCharCode(8596) + ' ' + scup + ' (⊻, ⊕, ≠)\"\nthese operations are called "negation, conjunction, equivalence, (inclusive) disjunction and exclusive disjunction"\n\nIf all the values in the Truth Table are True then the statement is called a tautology.\nIf they are all False then it is a contradiction.\nIf it is anything else it is a contingency.\n Examples: tautology, contradiction, contingency:\np or not p, p and not p, not p')
        lprogs.push('DeMorgan has two laws that help you to simplify complicated logical statements.\nDeMorgan\`s NOR Law:  ~( p∨q ); (~p∧~q); ~( p∨q ) ↔ (~p∧~q)')
        lprogs.push('DeMorgan\`s NAND law is similar to the NOR Law:\n~(p∧q); (~p∨~q); ~(p∧q) ↔ (~p∨~q)')
        lprogs.push('The Conditional is a very strange operator.\nThe best way to think of it is with a truth table.\nIt can be written many ways in English, such as: if p then q; p implies q; q follows from p; not p unless q; q if p; p only if q; whenever p, q; q whenever p; p is sufficient for q; q is necessary for p; p is a sufficient condition for q; q is a necessary condition for p.\nThere are three variations on conditionals called the inverse, converse, and contrapositive\nThe direct form <if P then Q> is written p→q where p is called the hypothesis and q is the conclusion.\nThe four forms are the direct, inverse, converse, and contrapositive written: \np→q, ~p→~q, q→p, ~q→~p ')
        lprogs.push('An example combining several operations\n In English you might say: if you are smart and you work hard then you will be successful.\nIn logic you would write:  p = you are smart;  q = you work hard;  r = you are successful\n\"if p and q then r\" is written:\n  p ∧ q → r ')
        lprogs.push('(p→q) is equivalent to (~p ' + scup + ' q); the negation (using DeMorgan\'s law) is (p ' + scap + ' ~q)\n\nTo prove this, generate the truth table for the the three statements and compare them to each other:\np→q, ~p' + scup + 'q, p' + scap + '~q')
        lprogs.push('All 16 logical operations.\nThere are a total of 16 logical operators, 10 more than the 6 common ones you have already seen. They are:\np' + scup + '~p,p' + scup + 'q,q→p,p,p→q,q ,p↔q,p' + scap + 'q,~p' + scup + '~q,p≠q,~q,p' + scap + '~q,~p,q' + scap + '~p,~p' + scap + '~q,p' + scap + '~p')
        lprogs.push('Another collection of operations are just different ways to write the ones we have seen:\np∨q;p∧q;p→q;p↔q;~p∨q;~p∧q;~p→q;~p↔q;p∨~q;p∧~q;p→~q;p↔~q;~p∨~q;~p∧~q;~p→~q;~p↔~q')
        lprogs.push('Arguments are similar to formulas.\nThey consist of one or more statements called premises that lead to a statement called the conclusion.\nIf every line in a truth table is true then the argument is valid. If any line is not true then the argument is invalid or a fallacy.\nSome arguments even have names, for example modus ponens (Law of detachment, implication elimination):\np→q\np\n---\nq')
        lprogs.push('modus tollens\n(contraposition, indirect reasoning):\np→q; ~q ∴ ~p')
        lprogs.push('disjunctive syllogism\n(modus tollendo ponens):\np∨q; ~p ∴ q')
        lprogs.push('the chain rule\n (transitivity of implication or Hypothetical Syllogism): \np→q, q→r ├ p→r')
        lprogs.push('fallacy of the inverse\n (denying the antecedent):\np→q; ~p ∴ ~q')
        lprogs.push('fallacy of the converse\n (affirming the consequent):\np→q; q ∴ p')
        lprogs.push('Euler Diagrams, Venn Diagrams, and Circuits\n\nIn addition to Truth Tables, Diagrams and Circuits are other ways to represent logic statements.\n\nLogic diagrams such as Euler Diagrams and Venn Diagrams can be thought of as\n  None [aka two fried eggs]\n  Some [aka Mastercard] and\n  All [aka target]\n\nElectric circuits, made up of switches, are also used to illustrate logical statements where a switch can be either ON (True) or OFF (False)\nYou can combine switches into parallel circuits [OR operation] or in series [AND operation]\nWe will only use simple on/off switches, not three way switches, not logic gates nor integrated circuits\n\n      p\n    _∠_                p    q\n___⌈    ⌉_____       ___∠___∠___\n   ⌊_∠_⌋ \n     q \n\nthese circuits represent:\n   p ∨ q ,           p ∧  q')

        lprogs.push("NPR's Car Talk has some fun puzzles that use logic.  Here is one:\n        Rowena and the Three Boxes\nRAY: This comes from the days of knights and kings and fair maidens and...\nTOM: And people named Rowena.\nRAY: Rowena. There you go. Turns out that the fair maiden Rowena wishes to wed.  And her father, the evil king, has devised a way to drive off suitors. He has a little quiz for them, and here it is.  It's very simple. There are three boxes on the table, OK? One is made of gold. One is made of silver. And the third is made of...\nTOM: Tofu.\nRAY: Lead. Inside one of these boxes is a picture of the fair Rowena. And it is the job of the knight, the white knight, to figure out which--without opening them, of course, which one has her picture. Now, to assist him in this endeavor there are inscriptions on each of the boxes.\nThe gold box says,  ''Rowena's picture is in this box.''\nThe silver box says, ''The picture ain't in this box.''\nAnd the lead box says, ''The picture ain't in the gold box.''\nTOM: Yeah. But he also gives him a hint, right? He's going to give him a hint.\nRAY: Yes. The hint is, one of the statements, and only one, is true.\nTOM: Excellent!\nRAY: The question is: Where's the picture?")
        lprogsI = lprogs.length - 1
        // ---
        ls = decodeURIComponent(location.search)
        if (ls.search(/\?/) == 0) {
            if (ls == '?&') loadstuff(true, 'logic')
            else {
                lsf = ls.slice(1).split("&")
                if (lsf[0].length == 0 && lsf[1].length > 0) {
                    loadstuff(true, lsf[1]);
                } else {
                    document.theForm.input.value = lsf[0].split(";").join('\n') + '\n'
                }
            }
            document.theForm.indata.value = document.theForm.input.value;
            document.theForm.input.value = ''
            table()
        } else show(1)
    </script>
</body>

</html>