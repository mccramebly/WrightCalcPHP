<!DOCTYPE html>
<html lang="en">

<head>
    <title>Regular Expression Text Editor</title>
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
</head>

<body onLoad="self.focus();document.theForm.input.focus();">
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <script src="myfunctions.js"></script>
        <script>
            // ---------------------------------------------------*/
            function getlocalstore(add) { // add = false  --> clear screen
                menucode = 0;
                localstore = document.theForm.jsdata.value;
                if (slim(localstore.length) == 0) {
                    localstore = 'jsdata';
                    document.theForm.jsdata.value = 'jsdata'
                }
                loadstuff(add, localstore);
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function putlocalstore() {
                menucode = 0;
                localstore = document.theForm.jsdata.value;
                if (slim(localstore.length) == 0) {
                    localstore = 'jsdata';
                    document.theForm.jsdata.value = 'jsdata'
                }
                savestuff(localstore);
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function menu(mc) { // menui is the item to be displayed, -1 for the table of contents
                if (mc == undefined) mc = menucode
                if (menucode != mc) menui = -1;
                menucode = mc
                localstore = '';
                document.theForm.input.value = ""
                switch (mc) { // pointer to menu and cookie
                    case 1:
                        menuprogs = lprogs;
                        document.theForm.jsdata.value = 'logic';
                        break;
                    case 2:
                        menuprogs = pyprogs;
                        document.theForm.jsdata.value = 'python';
                        break;
                    case 3:
                        menuprogs = jsprogs;
                        document.theForm.jsdata.value = 'ijs';
                        break;
                    case 4:
                        menuprogs = cprogs;
                        document.theForm.jsdata.value = 'calc';
                        break;
                    case 5:
                        menuprogs = mprogs;
                        document.theForm.jsdata.value = 'math';
                        break;
                    case 6:
                        menuprogs = sprogs;
                        document.theForm.jsdata.value = 'simplify';
                        break;
                    case 7:
                        menuprogs = gprogs;
                        document.theForm.jsdata.value = 'graphdata';
                        break;
                    case 8:
                        menuprogs = vprogs;
                        document.theForm.jsdata.value = '';
                        break;
                    case 9:
                        menuprogs = stprogs;
                        document.theForm.jsdata.value = '';
                        break;
                        /* case 10: menuprogs=tprogs; document.theForm.jsdata.value=''; break; */
                    default:
                        document.theForm.input.value = '';
                        document.theForm.input.focus();
                        return
                }
                if (menui < 0) // start a new menu
                {
                    for (var i = 0; i < menuprogs.length; i++) {
                        var menuprog = menuprogs[i];
                        if (i > 0) print(i + ') ', '')
                        var j = menuprog.search(/\n/)
                        if (j > -1) print(menuprog.slice(0, j));
                        else print(menuprog)
                    }
                    menui = 0
                } else if (menui < menuprogs.length) // print next menu item
                {
                    print(menuprogs[menui]);
                    menui++
                }
                /* else if (mc==10)
                { mc=8; menuprogs=vprogs; menui=0; menucode=mc
                  print(menuprogs[menui]); menui++
                }
                  else if (mc==8)
                { mc=10; menuprogs=tprogs; menui=-1; menucode=mc
                  menu(mc)
                } */
                else // done with menu, clear screen
                {
                    menui = -1;
                    document.theForm.input.value = ''
                }
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function clere() {
                if (document.theForm.input.value != "") {
                    thiswas.push(document.theForm.input.value)
                    document.theForm.input.value = ""
                    menucode = 0;
                    menui = -1
                }
                localstore = '';
                document.theForm.jsdata.value = ''
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function back() {
                if (menucode > 0) // we are stepping through a menu
                {
                    menui -= 2
                    localstore = '';
                    document.theForm.input.value = ""
                    menu(menucode)
                }
            }
            // ---------------------------------------------------*/
            function enter(evt) {
                var KEYcode = evt.keyCode;
                document.theForm.input.focus()
                if (KEYcode == 13) {
                    if (menucode == 0) return
                    if (menui == 0) //  menu is on screen
                    {
                        document.theForm.input.value = document.theForm.input.value.replace(/\n*$/, '')
                        menux = document.theForm.input.value.lastIndexOf('\n')
                        menui = ~~document.theForm.input.value.slice(menux + 1)
                    }
                    menu(menucode)
                    return
                }
                if (KEYcode == 18 && yesjsrun)
                    jsrun() // alt key
                if (KEYcode == 27) clere()
            };
            // ---------------------------------------------------*/
            function push(confr, conto) {
                now = document.theForm.input.value.replace(/\n\n/g, "\n  \n").replace(/\n\n/g, "\n  \n")
                while (now[0] == "\n") now = now.slice(1)
                while (now[now.length - 1] == "\n") now = now.slice(0, now.length - 1)
                nowl = now.split(/\n/)
                thiswas.push(now)
                savefr.push(confr)
                saveto.push(conto)
                document.theForm.convfr.value = ""
                document.theForm.convto.value = ""
            }
            // ---------------------------------------------------*/
            function doit(confr, conto) {
                confr = confr.replace(/\\n/g, "\n") // covert the characters \n to the character \n
                conto = conto.replace(/\\n/g, "\n") // covert the characters \n to the character \n
                var re = new RegExp(confr, "g")
                push(confr, conto)
                for (i = 0; i < nowl.length; i++) nowl[i] = nowl[i].replace(re, conto)
                document.theForm.input.value = nowl.join("\n")
                now = document.theForm.input.value;
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function doitall(confr, conto) {
                confr = confr.replace(/\\n/g, "\n") // covert the characters \n to the character \n
                conto = conto.replace(/\\n/g, "\n") // covert the characters \n to the character \n
                var re = new RegExp(confr, "g")
                push(confr, conto);
                now = now.replace(re, conto)
                document.theForm.input.value = now;
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function dolist() {
                with(Math) {
                    frarray = document.theForm.convfrlist.value.split(",")
                    toarray = document.theForm.convtolist.value.split(",")
                    for (var i = 0; i < min(toarray.length, frarray.length); i++) doit(frarray[i], toarray[i])
                    var x = document.theForm.convfrlist.value
                    document.theForm.convfrlist.value = document.theForm.convtolist.value
                    document.theForm.convtolist.value = x
                }
            }
            // ---------------------------------------------------*/
            function dodo() {
                doitall(document.theForm.convfr.value, document.theForm.convto.value)
                document.theForm.convfr.value = ""
                document.theForm.convto.value = ""
            }
            // ---------------------------------------------------*/
            function undo() {
                if (thiswas.length > 0) {
                    document.theForm.input.value = thiswas.pop()
                    document.theForm.convfr.value = savefr.pop()
                    document.theForm.convto.value = saveto.pop()
                }
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function repeat() {
                if (thiswas.length > 0) {
                    document.theForm.convfr.value = savefr.pop()
                    document.theForm.convto.value = saveto.pop()
                    dodo()
                }
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function lis() {
                push("", "")
                if (now.length == 0) {
                    print('converts values to comma separated list: \n 7 13 21 15 61 13 131 17 81 19 15 26 27 \n');
                    return
                }
                if ((xx1 = now.lastIndexOf(":")) > -1) now = now.slice(xx1 + 1)
                now = now.replace(/\w*[a-z]\w*=/, '').replace(/^\n*/, '').replace(/"/g, "").replace(/'/g, "").replace(/[^\w\.]/g, ",").replace(/,+/g, ",").replace(/^,/, "").replace(/,$/, "")
                document.theForm.input.value = now
            }
            // ---------------------------------------------------*/
            function lis1() {
                push("", "")
                if (now.length == 0) {
                    print('generates sorted list:\n 7 13 21 15 61 13 131 17 81 19 15 26 27 \n');
                    return
                }

                if (now.slice(0, 3) == 'm=[') {
                    now = (now + '\n').slice(0, now.search('\\n'));
                    eval(now);
                    m.sort();
                    now = "";
                    for (i = 0; i < m.length; i++) now += m[i] + "\n"
                    document.theForm.input.value = now;
                    document.theForm.input.focus()
                    return
                }

                lis();
                eval('p=[' + now.replace(/(\w*[a-z]\w*)/gi, '"$1"') + ']')
                if (now.search(/[a-z]/) > -1) document.theForm.input.value = p.sort()
                else document.theForm.input.value = p.sort(function(a, b) {
                    return a - b
                })
            }
            // ---------------------------------------------------*/
            function lis2() {
                push("", "")
                if (now.length == 0) {
                    print('eliminates duplicates from list:\n  7 13 21 15 61 13 131 17 81 19 15 26 27 \n');
                    return
                }
                p = [];
                lis1()
                for (i = 1; i < p.length; i++) {
                    while (p[i] == p[i - 1]) {
                        p.splice(i - 1, 1);
                        if (i >= p.length) break
                    }
                    document.theForm.input.value = p
                    document.theForm.input.focus()
                }
            }
            // ---------------------------------------------------*/
            function lis0() {
                push("", "")
                if (now.length == 0) {
                    print('creates an array:\n 7 13 21 15 61 13 131 17 81 19 15 26 27 \n');
                    return
                }
                lis();
                document.theForm.input.value = 'm=[' + now.replace(/(\w*[a-z]\w*)/gi, '"$1"') + ']\n'
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function lis3() {
                push("", "")
                if (now.length == 0) {
                    print('converts xy values to n by two array:\n0, 1\n1, 0\n2, 5\n3, 16');
                    return
                }
                if ((xx1 = now.lastIndexOf(":")) > -1) now = now.slice(xx1 + 1)
                if (now.search(/\[\[/) > -1) return
                document.theForm.input.value = now.replace(/[^\w\.\-]/g, ",")
                doit(",+", ",")
                document.theForm.input.value = 'm=[' + document.theForm.input.value.replace(/^,/, "").replace(/,$/, "").replace(/([^\,]*),([^\,]*)(,*)/g, "[$1,$2]$3").replace(/(\w*[a-z]\w*)/gi, '"$1"') + ']' + "\nmprint(m)"
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function lis4() {
                push("", "")
                if (now.length == 0) {
                    print('converts values to n by m array:\n1\n2 3\n4 5 6\n7 8 9 10\n');
                    return
                }
                if ((xx1 = now.lastIndexOf(":")) > -1) now = now.slice(xx1 + 1)
                if (now.search(/\[\[/) > -1) return
                now = "[[" + now.replace(/\w*[a-z]\w*=/, '').replace(/\n/g, "],[") + "]]"
                now = now.replace(/[^\[\]\w\.\]\[\-\+]/g, ",").replace(/,+/g, ",").replace(/,*\[\],*/g, ',').replace(/\[\,+/g, "[").replace(/\,+\]/g, "]").replace(/(\w*[a-z]\w*)/gi, '"$1"')
                document.theForm.input.value = "m=" + now.replace(/^,/, "").replace(/,$/, "") + "\nmprint(m)"
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function lis56(sortit) {
                push("", "")
                if (now.length == 0) {
                    print('convert lines to an array or sort them:\nCleveland OH\nBoston MA\nPittsburgh PA\nLos Angeles CA\nSt Louis IL\n');
                    return ''
                }
                now = "";
                for (i = 0; i < nowl.length; i++) {
                    now += (now.length > 0 ? ',' : '') + '"' + nowl[i].replace(/"/g, "'") + '"'
                }
                document.theForm.input.value = "m=[" + now + "];" + (sortit ? " m.sort();" : "") + "for (i=0;i<m.length;i++) {print(m[i]); write(m[i])}"
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function lis7() {
                push("", "")
                if (now.length == 0) {
                    print('remove first column of table:\n x   N(x)    P(x)\n--- ----- ---------\n  0     1 0.0000404\n  1    10 0.0007074\n  2    45 0.0055713\n  3   120 0.0259997\n  4   210 0.0796241\n  5   252 0.1672106\n  6   210 0.2438488\n  7   120 0.2438488\n  8    45 0.1600257\n  9    10 0.0622322\n 10     1 0.0108906\n--- ----- ---------\nall  1024 1.0000000\n');
                    return
                }
                nblines = false
                for (i = 0; i < nowl.length; i++) {
                    nowl[i] = nowl[i].replace(/^\s*/, '');
                    if (nowl[i] == nowl[i].replace(/^\S+\s+/, '')) nowl[i] = '';
                    else {
                        nblines = true;
                        nowl[i] = nowl[i].replace(/^\S+\s/, '')
                    }
                }
                document.theForm.input.value = (nblines ? nowl.join("\n") : '');
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function lis8() {
                push("", "")
                if (now.length == 0) {
                    print('remove last column of table:\n x   N(x)    P(x)\n--- ----- ---------\n  0     1 0.0000404\n  1    10 0.0007074\n  2    45 0.0055713\n  3   120 0.0259997\n  4   210 0.0796241\n  5   252 0.1672106\n  6   210 0.2438488\n  7   120 0.2438488\n  8    45 0.1600257\n  9    10 0.0622322\n 10     1 0.0108906\n--- ----- ---------\nall  1024 1.0000000\n');
                    return
                }
                nblines = false
                for (i = 0; i < nowl.length; i++) {
                    nowl[i] = nowl[i].replace(/ *$/, '');
                    if (nowl[i] == nowl[i].replace(/\s+\S+$/, '')) nowl[i] = '';
                    else {
                        nblines = true;
                        nowl[i] = nowl[i].replace(/\s+\S+$/, '')
                    }
                }
                document.theForm.input.value = (nblines ? nowl.join("\n") : '');
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function csv() {
                push("", "")
                if (now.length == 0) {
                    print('converts list of values into CSV format file:\nitem\nquantity\n\nbread&butter\n5\n\nblood, sweat & tears\n3');
                    return
                }
                if ((xx1 = now.lastIndexOf(":")) > -1) now = now.slice(xx1 + 1)
                now = '\n' + now.replace(/\t/g, "").replace(/\\[a-z]/g, "") + '\n'
                now = now.replace(/\n +/g, "\n").replace(/ +\n/g, "\n")
                now = now.replace(/\n\n\n/g, "\n\n").replace(/\n\n\n/g, "\n\n").replace(/\n/g, "\n\n").replace(/\n([^\n]*[a-z][^\n]*)\n/gi, '\n"$1"\n')
                now = now.replace(/\n\n/g, "\n").replace(/\n*$/g, "").replace(/^\n*/, "")
                document.theForm.input.value = now.replace(/\n\n/g, "\t").replace(/\n/g, ",").replace(/\t/g, "\n");
                document.theForm.input.focus()
            }
            // insert blank column 2 for 3 col data    replace(/^("[^"]*",)("[^"]*","[^"]*")$/g,'$1"",$2')
            // ---------------------------------------------------*/
            function Lagr() {
                lis3();
                push("", "")
                if (now.slice(0, 21) == 'converts xy values to') {
                    document.theForm.input.value = 'generates the LaGrange Polynomial from an' + now.slice(21)
                    return
                }
                eval('pp=' + now.slice(now.search(/=/) + 1, now.search(']]') + 2))
                document.theForm.input.value = ''
                xx = ''
                xlow = pp[0][0];
                xhi = xlow
                ylow = pp[0][1];
                yhi = ylow
                for (i = 0; i < pp.length; i++) {
                    xx += '(' + pp[i][0] + ',' + pp[i][1] + ',-4);'
                    if (xlow > pp[i][0]) xlow = pp[i][0]
                    if (xhi < pp[i][0]) xhi = pp[i][0]
                    if (ylow > pp[i][1]) ylow = pp[i][1]
                    if (yhi < pp[i][1]) yhi = pp[i][1]
                }
                xborder = (xhi - xlow) / 10;
                xhi = xhi + xborder;
                xlow = xlow - xborder
                yborder = (yhi - ylow) / 10;
                yhi = yhi + yborder;
                ylow = ylow - yborder
                x1 = ''
                for (i = 0; i < pp.length; i++) {
                    x1 += (pp[i][1] >= 0 ? '+' : '') + pp[i][1]
                    for (j = 0; j < pp.length; j++) {
                        if (i != j) x1 += '*(x-(' + pp[j][0] + '))/' + eval(pp[i][0] - pp[j][0])
                    }
                }
                x2 = 'x: ' + xlow + ' to ' + xhi + '\ny: ' + ylow + ' to ' + yhi + '\n' + x1 + '\n' + xx
                print('\Now you can press Clear and either load the "solve" cookie and call "solve" to see the reduced polynomial, or load the "graph" cookie and call "graph" to see the graph.')
                savestuff('simplify', 'simplified polynomial:\n' + x1);
                savestuff('graphdata', x2)
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function thou() {
                push('', '')
                now = now.replace(/(\d),(\d)/g, "$1$2")
                now = now.replace(/\$(\d)/g, "$1")
                document.theForm.input.value = now;
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function xdiv() {
                push("", "")
                doit("([a-z])/(\\d+)", "1/$2 $1")
            }
            // ---------------------------------------------------*/
            function pdiv() {
                push("", "")
                doit("over|divided *by", "/")
                doit(" *\\/ *", ")/(")
                doit("(\\w*\\))* *(.*)\\)\\/\\(([^\\n]*)", "$1 ($2)/($3)")
                for (i = 1; i < nowl.length - 1; i++) {
                    if (nowl[i].replace(/^\s*-+\s*$/, 'over') == 'over') {
                        nowl[i - 1] = '(' + nowl[i - 1] + ')/(' + nowl[i + 1] + ')'
                        nowl.splice(i, 2)
                        document.theForm.input.value = nowl.join("\n")
                        document.theForm.input.focus()
                    }
                }
            }
            // ---------------------------------------------------*/
            function comment() {
                doit(" .*:", " ")
            }
            // ---------------------------------------------------*/
            function probno() {
                doit("^(\\w+)\\.(?!\\d)", "$1) ")
                doit("^(\\w+)-", "$1) ")
                doit("^(\\w+)\\)[) ]*", "$1) ")
            }
            // ---------------------------------------------------*/
            function conv() {
                confr = document.theForm.convfr.value;
                conto = document.theForm.convto.value.replace(/\\n/g, "\n")
                if (confr.length > 0) {
                    push("", "")
                    conx = savefr.length
                    savefr.push(confr);
                    saveto.push(conto)
                    var re = new RegExp(confr, "g")
                    now = now.replace(re, conto)
                    document.theForm.input.value = now
                    document.theForm.convfr.value = ""
                    document.theForm.convto.value = ""
                }
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function notag() {
                push("", "")
                if (now.length == 0) {
                    document.theForm.input.value = "this button eliminates HTML tags to make text more human readable:\n<big>Hello</big> <div> silly people <p class=\"story-body-text story-content\" data-para-count=\"331\" data-total-count=\"331\"> from me on <a href=\"http://www.nytimes.com/topic/company/ebay-inc?inline=nyt-org\" title=\"More information about eBay Inc.\" class=\"meta-org\">eBay</a>"
                    document.theForm.input.focus;
                    return
                }
                now = now.replace(/\<script\>.+?\<\/script>/g, "")
                now = now.replace(/&quot;/g, '"').replace(/&nbsp;/g, " ").replace(/&#8212;/g, "--").replace(/&#8220;/g, "“").replace(/&#8221;/g, "”").replace(/&#8217;/g, "’")
                now = now.replace(/&#\d*;/g, "...").replace(/&\w+;/g, "---")
                now = now.replace(/<!--.*-->/g, "").replace(/<p>/g, "\n").replace(/<\/p>/g, "")
                now = now.replace(/\<style[^<]*\<\/style[^>]*>/g, "")
                now = now.replace(/\<[^\>]*>/g, "")
                now = now.replace(/\n(\s*\n)+/g, "\n")
                document.theForm.input.value = now;
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function parse() {
                push("", "")
                if (now.length == 0) {
                    document.theForm.input.value = "The Regular Expression Editor can clean up text so you can submit it to calculators. For example, to  get the answers to the following problems click on Parse.\n1. 3x^2 +7x +2 divided by x+2\n2. solve 2a+3b=y for b\n3. w equals $10,018 plus $23.40\n4. 4x*(x+2)^2\n5. 2.5% of $8,500.23\n6. what is 2 times 3\n"
                    document.theForm.input.focus;
                    return
                }
                probno();
                pdiv();
                comment();
                now = now.replace(/what number */ig, "x ").replace(/what */ig, "x ").replace(/%/g, "/100 ").replace(/ *of */ig, "*").replace(/ *percent */ig, "/100 ").replace(/ *plus */ig, "+").replace(/ *minus */ig, "-").replace(/ *times */ig, "*").replace(/ *equals* */ig, "=").replace(/ *is */ig, "=").replace(/solve */ig, "")
                document.theForm.input.value = now;
                thou()
                now = now.replace(/[a-z][a-z\,\.\:]+/ig, ";").replace(/\?/g, "").replace(/(; *)+/g, ";").replace(/;*\n *;*/g, "\n").replace(/^ *;/, "").replace(/; *$/, "").replace(/\n\n*/g, "\n").replace(/^\n/, "").replace(/\$(\d)/g, "$1").replace(/\+\;/g, '').replace(/\+(\d\))\+/g, '\n$1 ')
                now = now.replace(/([^); ]) ([^); ])/g, "$1+$2").replace(/\+$/, "")
                now = now.replace(/\+\++/g, "+")
                document.theForm.input.value = now;
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function cleantext() {
                push("", "")
                if (now.length == 0) {
                    document.theForm.input.value = "Look for stuff that appears to be formulas like the ones below and get rid of everything else\nl=2\nw=3\na=l*w\n"
                    return
                }
                doit("one", "1")
                doit("two", "2")
                doit("three", "3")
                doit("plus", "+")
                doit("minus", "-")
                doit("times", "*")
                doit("divided", "/")
                doit("hundred", "00")
                doit("thousand", "000")
                doit("million", "000000")
                doit("billion", "000000000")
                doit(" ", "")
                doit("[a-z,A-Z][a-z,A-Z]+", " ")
                push('', '');
                document.theForm.input.value = now.replace(/^\s+/g, "").replace(/\n\s+/g, "\n").replace(/\s+\n/g, "\n").replace(/[ \t]+/g, " ")
            }
            // ---------------------------------------------------*/
            function snl() {
                push("", "")
                if (now.length == 0) {
                    document.theForm.input.value = "convert stem and leaf data to list format:\n3 | 3 3 6 9\n4 | 0 7 8\n5 | 1 1 1\n16 |2 3 3\n27 | 0 7"
                    return
                }
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
                    now = now.replace(/[^\w]/g, ",").replace(/,+/g, ',').replace(/^ */, '').replace(/^,/, '')
                    eval('p = [' + now + ']');
                    p.sort(function(a, b) {
                        return a - b
                    })
                    ppp1 = '';
                    now = '';
                    pppl = p[0].toString().length - 1;
                    ppps = p[p.length - 1].toString().length
                    if (pppl < 1) pppl = 1;
                    if (ppps < 2) ppps = 2
                    for (i = 0; i < p.length; i++) {
                        pp = p[i].toString()
                        while (pp.length < ppps) pp = ' ' + pp
                        pp1 = pp.slice(0, -pppl);
                        pp2 = pp.slice(-pppl)
                        if (pp1 != ppp1) {
                            now += '\n' + pp1 + ' |';
                            ppp1 = pp1
                        }
                        now += ' ' + pp2
                    }
                    document.theForm.input.value = now + '\n'
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
                    document.theForm.input.value = now.replace(/,,+/g, ",").slice(1);
                    document.theForm.input.focus()
                }
            }
            // ---------------------------------------------------*/
            function lineno() {
                push("", "")
                if (now.length == 0) {
                    document.theForm.input.value = "Puts a line number on each line.";
                    return
                }
                for (i = 0; i < nowl.length; i++) nowl[i] = (i + 1) + ") " + nowl[i]
                document.theForm.input.value = nowl.join("\n");
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function cnf() {
                push("", "")
                document.theForm.input.focus()
                if (document.theForm.input.value == "") {
                    print('Converts a truth table to conjunctive normal form (CNF):\np q r s -->  (p⇒q)∧(q⇒r)∧(r⇒s)\nT T T T --> T\nT T T F --> F\nT T F T --> F\nT T F F --> F\nT F T T --> F\nT F T F --> F\nT F F T --> F\nT F F F --> F\nF T T T --> T\nF T T F --> F\nF T F T --> F\nF T F F --> F\nF F T T --> T\nF F T F --> F\nF F F T --> T\nF F F F --> T\n')
                    document.theForm.input.focus()
                    return
                }
                xx = document.theForm.input.value.split(/\n/);
                yy = [];
                zz = ''
                for (xxi = 0; xxi < xx.length; xxi++) {
                    xxx = xx[xxi].replace(/\s/g, '')
                    if ((yyi = xxx.indexOf("-->")) == -1) continue
                    if (zz.length == 0) {
                        zz = xxx.slice(0, yyi);
                        continue
                    }
                    if (xxx.charAt(xxx.length - 1) == "F") continue
                    yyy = '('
                    for (j = 0; j < zz.length; j++) {
                        if (xxx.charAt(j) == "F") yyy += '¬'
                        yyy += zz.charAt(j) + '∧'
                    }
                    yy.push(yyy.slice(0, yyy.length - 1) + ')')
                }
                document.theForm.input.value += ':' + yy.join('∨') + '\n';
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function trytoload(localstore) {
                document.theForm.jsdata.value = localstore
                if (document.theForm.input.value.length == 0) loadstuff(false, localstore)
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function logic() {
                push("", "")
                if (now.length == 0 || (menucode != 1 && menui == 0) || (menucode == 8)) {
                    menui = -1;
                    menu(1);
                    return
                }
                if (menucode == 1 && document.theForm.input.value.search(/:/) == -1) {
                    menu();
                    return
                }
                localstore = 'logic'
                xx = document.theForm.input.value + '\n'
                xx1 = xx.lastIndexOf(":");
                if (xx1 < 0) xx2 = 0;
                else xx2 = xx.slice(0, xx1).lastIndexOf("\n")
                savestuff(localstore, slim(xx.slice(xx2)))
                runcomm = 'truth.php?&'
                localstore = ''
                document.theForm.input.focus()
                window.open(runcomm)
            }
            // ---------------------------------------------------*/
            function disc() {
                push("", "")
                runcomm = 'discrete.php'
                localstore = ''
                document.theForm.input.focus()
                window.open(runcomm)
            }
            // ---------------------------------------------------*/
            function python() {
                push("", "")
                if (now.length == 0 || (menucode != 2 && menui == 0) || (menucode == 8)) {
                    menui = -1;
                    menu(2);
                    return
                }
                if (menui == 0) {
                    menu();
                    return
                }
                savestuff('python')
                nowl[nowl.length] = "#"
                nowm = [];
                nowmi = -1;
                longstring = false
                for (i = 0; i < nowl.length; i++) {
                    if (nowl[i].search(/'''/) > -1) {
                        nowl[i] = nowl[i].replace(/'''/, '"')
                        if (longstring) {
                            if (nowl[i].search(/'''/) > -1) {
                                nowl[i] = nowl[i].replace(/'''/, '"')
                            } else {
                                longstring = false
                            }
                            nowm[nowmi] += "\\n" + nowl[i]
                        } else {
                            nowm[++nowmi] = nowl[i];
                            longstring = true
                        }
                    } else {
                        if (longstring) {
                            nowm[nowmi] += "\\n" + nowl[i]
                        } else {
                            if (slim(nowl[i]).length > 0) nowm[++nowmi] = nowl[i]
                        }
                    }
                }
                now = nowm.join("\n")
                tabone = '    ';
                braceone = ""
                for (i = 1; i < 7; i++) {
                    tabtwo = '';
                    braceone = braceone + "}";
                    bracetwo = braceone
                    while (tabtwo.length < tabone.length) {
                        var re = new RegExp('(\n' + tabone + '[^ ].+)(\n' + tabtwo + '[^ ])', "g")
                        now = now.replace(re, "$1" + bracetwo + "$2")
                        tabtwo = tabtwo + '    ';
                        bracetwo = bracetwo.slice(1)
                    }
                    tabone = tabone + '    '
                }
                document.theForm.input.value = now
                doit("import.*", "")
                doit("time\\.sleep.*", "")
                doit("random\\.randint\\(", "rand(")
                doit("str\\(", "(")
                doit("if ", "if (");
                doit("while ", "while (")
                doit('def (.*):', 'function $1{')
                doit(":", ") {");
                doit('"', "'")
                doit("else *\\)", "else")
                doit('True', 'true');
                doit('False', 'false')
                doit("#", "//");
                doit(' and ', ' && ');
                doit(' or ', ' || ');
                doit(' not ', ' ! ')
                doit("\\)\\(", "),(");
                doit('\\),\\(', '],[');
                doit('\\(([^)\\]]*])', '[[$1');
                doit('(\\[[^)\\]]*)\\)', '$1]]')
                document.theForm.input.value = document.theForm.input.value.replace(/\n\s*\n/g, '\n').replace(/\n\s*\n/g, '\n')
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function jsrun() {
                push('', '')
                yesjsrun = true
                if (now.length == 0 || (menucode != 3 && menui == 0) || (menucode == 8)) {
                    menui = -1;
                    menu(3);
                    return
                }
                if (menui == 0) {
                    menu();
                    return
                }
                document.theForm.jsdata.value = 'ijs'
                localstore = 'ijs'
                savestuff(localstore);
                runcomm = 'ijs.php?run&' + localstore
                window.open(runcomm)
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function calc() {
                push('', '')
                if (now.length == 0 || (menucode != 4 && menui == 0) || (menucode == 8)) {
                    menui = -1;
                    menu(4);
                    return
                }
                if (menui == 0) {
                    menu();
                    return
                }
                document.theForm.input.value = now.replace(/ +(\d)/g, "+$1")
                localstore = 'calc'
                savestuff(localstore)
                runcomm = 'calc.php?&'
                localstore = ''
                document.theForm.input.focus()
                window.open(runcomm)
            }
            // ---------------------------------------------------*/
            function math() {
                with(Math) {
                    push("", "")
                    if (now.length == 0 || (menucode != 5 && menui == 0) || (menucode == 8)) {
                        menui = -1;
                        menu(5);
                        return
                    }
                    if (menui == 0) {
                        menu();
                        return
                    }
                    savestuff('math');
                    menucode = 0;
                    menui = -1
                    xhed = '';
                    xcod1 = '';
                    xcod2 = '';
                    xpri = '';
                    xwri = '';
                    xinit = '';
                    xxif1 = '';
                    xxif2 = ''
                    xx0 = '';
                    xx0x = '' // can only have one array
                    xx1 = now.lastIndexOf(":");
                    if (xx1 > -1) now = now.slice(xx1 + 1)
                    xx1 = now.split(/\n/)
                    pnoregex = new RegExp('^ *(\\d+|\\w)(\\)|\\. )')

                    for (xx1i = 0; xx1i < xx1.length; xx1i++) {
                        xx1x = xx1[xx1i]
                        if (xx0 == '' && (xx1xii = xx1x.search(/\[.*\]/)) > 0) // line is an array
                        {
                            xx0x = xx1x[0].toUpperCase()
                            xx0 = xx1x.slice(xx1xii)
                            xcod1 += 'pp=' + xx0 + '; '
                            xhed += (xhed == '' ? '' : ", ") + xx0x.toLowerCase()
                            xpri += (xpri == '' ? '' : ", ") + 'my(' + xx0x + ')'
                            xwri += (xwri == '' ? '' : "+', '+") + xx0x
                            continue
                        }
                        if (xx1x.search(/\/\//) > -1) continue // comment
                        if (xx1x.search(pnoregex) == 0) // line has a problem number
                        { // xpri='\n'+xx1x.match(pnoregex)[0]
                            xx1x = xx1x.replace(pnoregex, "")
                        }
                        xx2 = xx1x.split(/;/)
                        for (xx2i = 0; xx2i < xx2.length; xx2i++) // each statement
                        {
                            xx2x = xx2[xx2i]
                            xxx2 = slim(cleanx(xx2x))
                            if (xxx2 == '') continue
                            if (xxx2.search(/<|>|==|!=/) > 0) {
                                xxif1 = 'if(' + xxx2 + '){\n';
                                xxif2 += '}'
                            } else if (xxx2.search(/print/) < 0) {
                                if (xxx2.search(/=/) >= 0 && xxx2.search(/=.*[A-Z]/) < 0) {
                                    xcod1 += xxx2 + '; '
                                } else {
                                    xcod2 += xxx2 + '; '
                                    xhed += (xhed == '' ? '' : ", ") + xx2x.toLowerCase()
                                    if (xxx2.search(/=/) > 0) xxx2 = xxx2.replace(/=.*/, '')
                                    xpri += (xpri == '' ? '' : ", ") + 'my(' + xxx2 + ')'
                                    xwri += (xwri == '' ? '' : "+', '+") + xxx2
                                }
                            }
                        }
                    }
                    xcod2 += xxif1 + 'print(%xxxx%); writeln(%xxx1%)' + xxif2 + '\n'
                    var xxvars = xcod2.match(/[A-Z]/g)
                    if (xxvars == null) {
                        xxvars = []
                    };
                    xxvars = xxvars.sort().reverse()
                    var xxvarsi = 0;
                    while (xxvarsi < xxvars.length) {
                        xxvar = xxvars[xxvarsi]
                        var reg = new RegExp(xxvar + ' *= *(?![=\[])', 'i')
                        if (now.search(reg) > -1 || eval('typeof(' + xxvar + ')') != 'undefined' || xxvars[xxvarsi] == xxvars[xxvarsi - 1]) {
                            if (xxvars[xxvarsi] != xxvars[xxvarsi - 1] && xxvars[xxvarsi] != xxvars[xxvarsi + 1]) xinit += xxvar.toUpperCase() + '=0;';
                            xxvars.splice(xxvarsi, 1)
                        } else xxvarsi++
                    }
                    for (xxvarsi = 0; xxvarsi < xxvars.length; xxvarsi++) {
                        xxvar = xxvars[xxvarsi].toUpperCase()
                        if (xx0x == xxvar) {
                            xcod2 = '\nLoop' + xxvarsi + ': for (ppi in pp) {' + xxvar + '=pp[ppi];' + xcod2 + '}';
                            xx0 = '';
                            continue
                        }
                        xcod2 = 'Loop' + xxvarsi + ': for (' + xxvar + '=0;' + xxvar + '<10;' + xxvar + '++) {' + xcod2 + '}'
                        xpri = 'my(' + xxvar.toUpperCase() + ')' + (xpri == '' ? '' : ", ") + xpri
                        xwri = xxvar.toUpperCase() + (xwri == '' ? '' : "+', '+") + xwri
                        xhed = xxvar.toLowerCase() + (xhed == '' ? '' : ", ") + xhed
                    }
                    xxx = '/* ' + document.theForm.input.value + '*/\nprint(swfrac(2));'
                    xxx += xinit + '\n'
                    if (xcod1 != '') xxx += 'print("' + xcod1.replace(/\n/g, '; ').toLowerCase() + '");\n' + xcod1 + ';\n'
                    if (xhed != '') xxx += 'print("' + xhed + '");\n'
                    if (xx0x != '') xxx += 'print("' + xx0x + '=["+pp+"]");\n'
                    xxx += xcod2
                    document.theForm.input.value = xxx.replace(/%xxxx%/, xpri).replace(/%xxx1%/, xwri)
                    document.theForm.input.focus()
                }
            }
            // ---------------------------------------------------*/
            function solve() {
                push('', '')
                if (now.length == 0 || (menucode != 6 && menui == 0) || (menucode == 8)) {
                    menui = -1;
                    menu(6);
                    return
                }
                if (menui == 0) {
                    menu();
                    return
                }
                localstore = 'simplify'
                savestuff(localstore)
                runcomm = 'simplify.php?&'
                localstore = ''
                window.open(runcomm)
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function dograph() {
                push("", "")
                if (now.length == 0 || (menucode != 7 && menui == 0) || (menucode == 8)) {
                    menui = -1;
                    menu(7);
                    return
                }
                if (menui == 0) {
                    menu();
                    return
                }
                doit("θ", "x")
                if (now.search(/[a-z]x/) > 0) doit('x', '(x)')
                savestuff('graphdata');
                window.open('graphs.php')
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function vocab() {
                if (menucode == 8) {
                    switch (menui) {
                        case 2:
                            mc = 1;
                            break; // logic
                        case 5:
                            mc = 9;
                            break; // stats
                        case 8:
                            mc = 10;
                            break; // tutors
                        default:
                            document.theForm.input.value = '';
                            document.theForm.input.focus();
                            return
                    }
                    menui = 0;
                    menu(mc)
                } else {
                    menui = -1;
                    menu(8)
                }
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
            function dostats() {
                push("", "")
                if (now.length == 0 || (menucode != 9 && menui == 0)) {
                    menui = -1;
                    menu(9);
                    return
                }
                if (menui == 0) {
                    menu();
                    return
                }
                if (now.search(/:/) < 0) {
                    if (now.search(/{/) >= 0) {
                        now = now.replace(/(\d),/g, '$1{1},');
                        window.open('regress.php?&&&&' + now);
                        return
                    }
                    if (now.search(/y:/) > 0 || now.search(/yf:/) > 0) window.open('regress.php?' + now)
                    else window.open('stats.php?' + now)
                    document.theForm.input.focus();
                    return
                }
                s = ['', '', '', '', '', '', '', '']
                for (i = 0; i < nowl.length; i++) {
                    if ((j = nowl[i].search(/:/)) > 0) {
                        k = 0;
                        if (nowl[i].slice(0, j) == 'y') k = 1
                        else if (nowl[i].slice(0, j) == 'f') k = 2
                        else if (nowl[i].slice(0, j) == 'xy') k = 3
                        else if (nowl[i].slice(0, j) == 'xf') k = 4
                        else if (nowl[i].slice(0, j) == 'xyf') k = 5
                        else if (nowl[i].slice(0, j) == 'o') k = 6
                        else if (nowl[i].slice(0, j) == 'w') k = 7
                        s[k] += (s[k].length > 0 ? ' ' : '') + nowl[i].slice(j + 1)
                    }
                }
                if ((s[0] + s[1] + s[2] + s[3] + s[4] + s[5] + s[6] + s[7]).length > 0)
                    if (now.search(/y:/) > 0 || now.search(/yf:/) > 0) window.open('regress.php?' + s[0] + '&' + s[1] + '&' + s[2] + '&' + s[3] + '&' + s[4] + '&' + s[5] + '&' + s[6] + '&' + s[7])
                else window.open('stats.php?' + s[0] + '&' + s[2] + '&' + s[4] + '&' + s[6] + '&' + s[7])
                document.theForm.input.focus()
            }
            // ---------------------------------------------------*/
        </script>
        <h1>Regular Expression Text Editor</h1>
        <form name="theForm">
            <textarea name="input" rows=25 cols=68 onKeyUp="enter(event)">
The Regular Expression Text Editor is sort of like MicroSoft's Notepad on steroids.
I use it to write programs and to clean up text before I pass it on to one of the calculators.
You can use the buttons on top to use or to read about my calculators.

Python: Converts very simple Python programs to JavaScript to give you a general introduction to these two programming languages.
Math: Converts math expressions to JavaScript programs.
J/S: Provides an interactive user environment that will run JavaScript programs.  These can either be programs you wrote for yourself, programs created by the Python or Math converters, or one of several sample programs.

The next few buttons (Calc, Solve, Logic, Graph, and Stats) have sample data that you can use with the associated calculators.
Vocab: has a summary of the words that are used in the Gen Ed Math (Math 118) course.
The last three buttons are used for navigation through the various screens.
The buttons on the bottom are for:
 saving/loading text to local cookie storage,
 various pre-programmed regex operations,
 additional non-regex operations,
 a call to the JavaScript regular expression based .replace method
   [see the Guide button for more information].
The last line is for converting logical variables that are other than p,q,r,s,t.
        </textarea>
            <h2>Math118:</h2>
            <input name="vocabbut" Value="vocab" type="button" onClick="vocab()" title="Some math words you should know" />
            <input name="logbut" Value="logic" type="button" onClick="logic()" title="calls truth table for logic" />
            <input name="calcbut" Value="calc" type="button" onClick="calc()" title="saves screen to cookie and starts calculator" />
            <input name="discbut" Value="probab" type="button" onClick="disc()" title="calls discrete probability module" />
            <input name="statsbut" Value="stats" type="button" onClick="dostats()" title="send screen to statistics module" /><br><br><br>
            <h2>Go:</h2>
            <input name="nextbut" Value="next" type="button" onClick="menu()" title="subsequent menu item" />
            <input name="backbut" Value="back" type="button" onClick="back()" title="previous menu item" />
            <input name="clerebut" Value="Clear" type="button" onClick="clere()" title="clears screen (ESC)" /><br><br>
            <h2>Other:</h2>
            <input name="solvbut" Value="simplify" type="button" onClick="solve()" title="saves screen to cookie and starts algebra" />
            <input name="graphbut" Value="graph" type="button" onClick="dograph()" title="send screen to grapher" />
            <input name="pybut" value="python" type="button" onClick="python()" title="converts python to js" />
            <input name="mathbut" Value="math" type="button" onClick="math()" title="converts math to js" />
            <input name="jsrunbut" Value="J/S" type="button" onClick="jsrun()" title="start java console" /><br><br><br>



            <h2>Cookies:</h2>
            <input name="savebut" Value="Save" type="button" onClick="putlocalstore()" title="saves screen as cookie" />
            <input name="loadbut" Value="Load" type="button" onClick="getlocalstore(false)" title="loads screen from cookie" />
            <input name="addbut" Value="Add" type="button" onClick="getlocalstore(true)" title="adds cookie to end of screen" />
            <input type="text" name="jsdata" value='' size=5 rows=1 title="name of cookie" />
            <br>
            <input name="IJSbut" Value="IJS" type="button" onClick="trytoload('ijs')">
            <input name="pythonbut" Value="python" type="button" onClick="trytoload('python')">
            <input name="logicbut" Value="logic" type="button" onClick="trytoload('logic')">
            <input name="mathbut" Value="math" type="button" onClick="trytoload('math')">
            <input name="JSdatabut" Value="jsdata" type="button" onClick="trytoload('jsdata')">
            <input name="datainbut" Value="In" type="button" onClick="trytoload('dataIn')">
            <input name="data1INbut" Value="1In" type="button" onClick="trytoload('data1In')">
            <input name="dataOutbut" Value="Out" type="button" onClick="trytoload('dataOut')">
            <input name="simplifybut" Value="simplify" type="button" onClick="trytoload('simplify')">
            <input name="calcbut" Value="calc" type="button" onClick="trytoload('calc')">
            <input name="graphdatabut" Value="graph" type="button" onClick="trytoload('graphdata')">
            <br><br><br><br><br><br>
            <h2>Regex:</h2>
            <input name="probnobut" Value="#. to #)" type="button" onClick="probno()" title="converts problem number" />
            <input name="thoubut" Value="$0,000" type="button" onClick="thou()" title="converts currency to number" />
            <input name="pdivbut" Value="( )/( )" type="button" onClick="pdiv()" title="replaces 'divided by' with symbols" />
            <input name="xdivbut" Value="x/2" type="button" onClick="xdiv()" title="converts x/2 to 1/2x" />
            <input name="linenobut" Value="Line #" type="button" onClick="lineno()" title="puts line number on each line" />
            <input name="lisbut" Value="cs list" type="button" onClick="lis()" title="generates comma separated list" />
            <input name="lis1but" Value="sort" type="button" onClick="lis1()" title="generates sorted list" />
            <input name="lis2but" Value="reduce" type="button" onClick="lis2()" title="generates reduced sorted list" />
            <input name="lis5but" Value="Create Array" type="button" onClick="lis56(false)" title="n by 1 array of lines" />
            <input name="lis6but" Value="Sort Array" type="button" onClick="lis56(true)" title="sort n by 1 array" />
            <br><br><br><br><br><br>
            <h2>Special:</h2>
            <label>Replace:</label>
            <input class="shortinput" type="text" name="convfr" size=20 rows=1 tabindex="1" title="regex expression to be converted" /> <label>with:</label> <input class="shortinput" type="text" name="convto" size=20 rows=1 tabindex="2" title="output of conversion" />
            <label>from:</label>
            <input class="shortinput" type="text" name="convfrlist" size=30 rows=1 tabindex="4" title="regex expression list to be converted" /> <label>to:</label>
            <input class="shortinput" type="text" name="convtolist" size=30 rows=1 tabindex="5" title="output of conversion" value='p,q,r,s,t' />

            <input name="snlbut" Value="stem/leaf" type="button" onClick="snl()" title="converts stem & leaf to values" />
            <input name="notagbut" Value="notag" type="button" onClick="notag()" title="erase HTML tags" />
            <input name="cleanbut" Value="parse" type="button" onClick="parse()" title="cleans up math problems" />
            <input name="clean2but" Value="clean" type="button" onClick="cleantext()" title="gets rid of text" />
            <input name="lagrbut" Value="Lagrange" type="button" onClick="Lagr()" title="generates LaGrange Polynomial from (x,y)" />
            <input name="lis0but" Value="array" type="button" onClick="lis0()" title="generates 1-D array" />
            <input name="lis3but" Value="n by 2" type="button" onClick="lis3()" title="generates x,y array" />
            <input name="csvbut" Value="csv" type="button" onClick="csv()" title="generates CSV file" />
            <input name="lis4but" Value="n by m" type="button" onClick="lis4()" title="generates 2-D array" />
            <input name="lis7but" Value="-1st" type="button" onClick="lis7()" title="remove first column" />
            <input name="lis8but" Value="-mth" type="button" onClick="lis8()" title="remove last column" />
            <br><br><br><br><br><br><br>

            <input name="doitbut" Value="Do" type="button" tabindex="3" onClick="dodo()" title="perform regex conversion" />
            <input name="undobut" Value="Undo" type="button" onClick="undo()" title="undo regex conversion" />
            <input name="repbut" Value="Repeat" type="button" onClick="repeat()" title="repeat last regex conversion" />
            <input name="guidebut" Value="Guide" type="button" onClick="window.open('https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/RegExp')" title="load regex guide" />
            <br><br>

            <input name="doitbut" Value="do" type="button" tabindex="6" onClick="dolist()" title="apply list of changes" /><br><br><br>

        </form>
        <script>
            scup = String.fromCharCode(8744);
            scap = String.fromCharCode(8743)
            var thiswas = [],
                savefr = [],
                saveto = [],
                now = "",
                nowl = [],
                confr = "",
                conto = ""
            var lprogs = [];
            lprogsI = 0;
            llist = true
            var mprogs = [];
            mprogsI = 0;
            mlist = true
            var jsprogs = [];
            jsprogsI = 0;
            jslist = true
            var pyprogs = [];
            pyprogsI = 0;
            pylist = true
            var cprogs = [];
            cprogsI = 0;
            clist = true
            var sprogs = [];
            sprogsI = 0;
            slist = true
            var gprogs = [];
            gprogsI = 0;
            glist = true
            var vprogs = [];
            vprogsI = 0;
            vlist = true
            var stprogs = [];
            stprogsI = 0;
            stlist = true
            /* var tprogs = []; tprogsI=0; tlist=true */
            var menucode = 0;
            var menui = 0;
            yesjsrun = false
            // ---
            gprogs.push("polar coordinates:\np:theta from: thru: x [= H+R*cos(x)]: y [= K+R*sin(x)]:\nx:-10 to 2; y:-12 to 0;p:0:2pi:-4+cos(x)*(3.5+sin(5x)):-6+sin(x)*(3.5+sin(5x))\n(-4,-6,,Q)(-4,-6,5)")
            gprogs.push("integrals:\nx:-1.5707963267948966 to 7.853981633974483;y:-1 to 10;u:rad\nsin(x)+1\ni:sin(x)+1\n-cos(x)+x+pi/2-(pi/2-1)\n")
            gprogs.push("vectors:\n(x,y) plus: 1-(x,y), 2-(d,slope), 3-polar, 4-azimuth, 5-compass:\nx:-1 to 9;y:-1 to 9;u:deg\n// (x,y):\nv1:(2,3.464101615137755,-11,' 1')  (-2,-3.4641016151377544) (4,0) (-2,3.4641016151377544)\n// (distance, slope):;\nv2:(3.5,4.464101615137755,-11,' 2')(-4,1.73205081)(4,0)(-4,-1.73205081)\n//(rho, theta standard):\nu:deg;v3:(5,5.464101615137755,-11,' 3')(4,300)(4,180)(4,60)\nu:rad;v3:(5,5.464101615137755-.5)(3,5pi/3)(3,pi)(3,pi/3)\n//(rho, theta azimuth):;\nu:rad;v4:(6.5,6.464101615137755,-11,' 4')(4,5pi/6)(4,3pi/2)(4,pi/6)\nu:deg;v4:(6.5,6.464101615137755-.5)(3,150)(3,270)(3,30)\n//(rho, theta compass):;\nv5:(8,7.464101615137755,-11,' 5')(4,S30E)(4,W)(4,N30E)")
            gprogs.push("derivatives:\nx:0 to 7; y:-1 to 51;u:rad\nsin(x)+x^2\nd:sin(x)+x^2\ncos(x)+2x+.5")
            gprogs.push("piecewise functions:\nx:-12 to 14;y:-12 to 14;u:rad\n(3:12):3x/2+5sin(x)-13\n(-2:3):(3-x)(x+2)-8.238320218785281")
            gprogs.push('O.D.E. #1:\nx:-4.5 to 5\ny:-400 to 700\n13x^3 -26x^2 -208x +416\n(-4,0,-5),(-3,455,-5),(-2,624,-5),(-1,585,-5),(0,416,-5),(1,195,-5),(2,0,-5),(3,-91,-5),(4,0,-5),(5,351,-5),(6,1040,-5),(7,2145,-5),(8,3744,-5),(9,5915,-5),(10,8736,-5)\n// m=(y[i+1]-y[i])/(x[i+1]-x[i])\n(-4,455,-5),(-3,169,-5),(-2,-39,-5),(-1,-169,-5),(0,-221,-5),(1,-195,-5),(2,-91,-5),(3,91,-5),(4,351,-5),(5,689,-5),(6,1105,-5),(7,1599,-5),(8,2171,-5)')
            gprogs.push('O.D.E. #2:\nx:-4.5 to 5\ny:-400 to 700\n(-4,455,-5),(-3,169,-5),(-2,-39,-5),(-1,-169,-5),(0,-221,-5),(1,-195,-5),(2,-91,-5),(3,91,-5),(4,351,-5),(5,689,-5),(6,1105,-5),(7,1599,-5),(8,2171,-5)\n39x^2 -52x -208\nd:13x^3 -26x^2 -208x +416\n')
            gprogs.push('Trig equations:\nx:-0.01 to 360.01; y:-10 to 10; u:deg\n4COS2(X)+3COT(X)SIN(X)-(2COT(X)+TAN(X))')
            gprogs.push("multiple stuff:\nx:-12 to 14;y:-12 to 14;u:rad\n8-x/1.1+sin(x) \ny= (x4 -34x2 +115)/11 \nf(x)=-(x+7)(x-8)/3 \n(3:12):3x/2+5sin(x)-13\n(-4,6.4,-5,A),(4,-7,,B),(7.5,-3,,C),(10,-6,-5,D)\n(-4,-6,,Q)(-4,-6,5)\n//polar:0:2pi:H+R*cos(x):K+R*sin(x):\npolar:0:2pi:-4+cos(x)*(3.5+sin(5x)):-6+sin(x)*(3.5+sin(5x))\nd:sin(x)+9;intgrl:sin(x)+1\nv3 vector: (5,5.464101615137755)(4,4.1887902047863914)(4,0)(4,2.0943951023931957)")
            gprogs.push("Straight lines:\nx:0,10; y:0,10\nTwo points (y= 0.5x +2.5):\nyval(x,1,3,7,6)\n(1,3)(7,6)\npoint slope (y= -2x +15):\nyval(x,5,5,-2)\n(5,5,-6)")

            vprogs.push("Overview of Math 118 Topics:\nMath starts out pretty simple. \nIt starts in the crib when you learn to count your fingers and toes.\nThe difficulty comes in when we try to make things 'easier for you!'\nInstead of counting your fingers and toes, we count each of them separately and show you how to add them together to find the total number.\nThen we show you that your friends also have fingers and toes, but you don't have to count them separately, you can just multiply the number of friends you have by the number of fingers and toes each of them has.\n'Easier for you' seems to mean that you have to know more and it involves having to learn new words.\nFortunately in today's world you don't have to memorize them all, you just need to know how to look them up with Google or Bing.")
            vprogs.push("Logic\nStatements (True or False)\nLogical Operators\nLogical Operators are used in compound statements. There are 16 of them including\n   AND (∧, /\\ ), OR (∨,  \\/), NOT (~, ¬, !), XOR (⊻, ⊕, ≠), IMPL (→), EQUIV (↔) \n  They are called Conjunction, (inclusive) disjunction, negation, exclusive disjunction, implication, equivalence. \n  but not Ambition, Distraction, Uglification and Derision\nTruth Tables, Syllogisms\nEuler diagrams, Venn Diagrams\n  Mastercard, Target, Snake eyes\n  some, all, none\nSwitches, Circuits (Series, Parallel)\nsyllogisms or arguments (Valid or Invalid)\n\n")
            vprogs.push("Counting vs. measuring: How Many vs. How Much; Few vs. Less; Discrete vs. Continuous;\nunique values (like integers) vs. range of values (duration, weight, length, area, volume, etc.)\ncounting can be done by Systematic Listing, Tree diagrams, formulas, and the fundamental counting principle.\nThings to count: triangles, blocks, tiles, hand shakes, outfits, dinners, n-digit numbers,\ndifferent committees, slates of officers, license plates, combination locks,\ndifferent paths from point A (Pascal's triangle), paths from point A to point B\nThe Fundamental Counting Principle: List the steps, Count the choices, multiply them together.\nOther tools: powers of n, factorials (n!), power set, 2^n, etc. \nArrangements where order matters, Permutations, nPr, formulas, etc.\nCollections where order doesn't matter, Combinations, nCr, etc.\nBinomial distributions (Gender, Coins, Urns) Pascal's Triangle, Binomial Coefficients\nCounting playing Cards, throws of fair Dice, things in a Box.\nIf X is a value then N(X) is the frequency of X, or the number of times X occurs\nConcepts you should already know:\na) The names of the months, how many days there are in each, the days of the week\nb) The names of the suits in a deck of cards, the names of the face cards, what other cards are in the deck\nc) Prime numbers, perfect squares, multiples of a number (divisible by a number)\nd) The sum of the digits of a number\ne) The names and denominations of U.S. coins.\nFormulas might also help, for example:\n how many numbers are there from a to b: b+1-a\n what is their sum (a+b)(b+1-a)/2\n factorial n!=fact(n); P(n,r)=n!/(n-r)!; C(n,r)=P(n,r)/r!")
            vprogs.push("Probability\nFirst we start with discrete distributions of relatively small finite sets called Sample Spaces where we count all possible outcomes.\nThen we identify and count a Favorable Event using conditions and words like NOT, OR, AND.\nThe formula for calculating a probability is P(event) = N(event) ÷ N(sample space),\nand the formula for calculating Odds is (for : against) = N(event) : [N(sample space)-N(event)]\nConditional probability, written P(x|y), uses words like 'given that' which restrict the sample space.\nThere are several standard sample spaces such as a deck of cards, rolling dice, picking things out of an urn, or flipping coins.\nWe often use a  Binomial (two valued) probability where the probability of an event is fixed at p and the opposite is q=1-p.\nCoins and genders are examples of binary probabilities where p = q = 0.5\nOther words to know include\n  Expected value = average (mean)\n  Empirical (data from experiments) vs theoretical (see law of Large Numbers)\n  Mutually exclusive events")
            vprogs.push("One-variable statistics\ndata, grouped data (classes), frequency, probability distribution, population or sample\n relative frequency, Cumulative Frequency, also Cumulative relative. \nVisual Representations: Pie Chart, Histogram (bar chart), Frequency polygon (line graph),\n stem & leaf plot, box and whiskers plot, Ogive\nMeasures of Central Tendency: mean, midrange, median, mode (2 modes=bimodal, more than 2=no mode)\nMeasures of Dispersion: standard deviation (" + sigma + "), range, interquartile range IQR, Coefficient of Variation CV%\nQuantiles: percentile, decile, quartile, (5-number summary)\nStatistics are for a sample and parameters for the entire population. They are mostly the same except for " + sigma + "\n\nSample spaces too big to count have to be measured using areas under a probability curve.\nTo do this we use the z-score which equals the data minus the mean divided by the standard deviation \nor z = ( X - μ ) ÷ σ  \nIt is A.K.A. number of standard deviations from the mean, relative position, k-score, etc.\nMost of the time we will have a bell shaped normal distribution where the Mean = Median = Mode = Midrange\nWe can use a table/calculator to convert Data <-> standard score <-> probability.\nIt is harder to calculate probabilities for distributions that are skewed or flat.\nWe calculate the probability that data is within z standard deviations of the mean two ways.\nThe Empirical Rule (Gauss) is for data with a normal distribution: z=1,2,3 gives p=0.6827, 0.9545, 0.9973\nChebychev's rule for any distribution: p=1-1/k², a k-score (same as a z-score)=2,3 gives p=0.75, 0.8889\n")
            vprogs.push("Two-variable statistics and regression formulas\ngive a relationship between a dependent variable and one or more independent variables or predictors.\nStart with a Scatter Plot then we do Linear Regression Analysis calculating the Least Squares Curve fit for a Linear relation ( y = mx + b)\nThe correlation coefficient -1 < r < 1 tells us how the two sets of data are related. zero means there is no relationship.\n")
            vprogs.push("Financial calculations\ncan involve simple interest or compound interest.\nThe simple interest formula is: I= Prt, where P= the principle, r is the interest rate per period and t is the number of periods. For compound interest the interest is added to the principle and included in the interest calculation for the next period.\nAn annuity also adds or subtracts a fixed amount from the principle.\n An ordinary annuity (annuity in arrears) adds the amount at the end of the period.\n An annuity due (annuity In advance) adds the amount at the beginning of the period.\nMortgages are examples of an ordinary annuity.\nVariables that are usually used for these calculations are:\n  S= Principle, Present Value, or Starting Amount\n  P= Periodic Payment Amount\n  F= Future or Final Amount\n  m= number of periods per year, t= number of years, n= t times m\n  i= annual interest rate (APR), r= Interest per period = i/m\nYou can calculate any of these values from the others by using formulas like these:\n  F= S * (1+r)^n + P * ((1+r)^n-1) / r\n  S= (F + (P * ((1+r)^n-1) / r))/(1+r)^n\n  P= r*(S(1+r)^n - F)/(1-(1+r)^n)\n  n= [ ln ((r*F+P)/(r*S+P))/ln(1+r)]")
            vprogs.push("Links\nCounting:\nhttp://www.smbc-comics.com/comic/a-new-method\nhttp://faculty.ccc.edu/jnadas/js/SumsofDigits.htm\nhttp://magoosh.com/gmat/2013/difficult-gmat-counting-problems/\nhttp://www.intmath.com/\nhttps://braingenie.ck12.org/courses/9\nhttp://math.illinoisstate.edu/day/courses/old/312/assign/countproblems.html\nhttp://www.careerbless.com/aptitude/qa/permutations_combinations.php\nhttps://www.indiabix.com/aptitude/permutation-and-combination/\nhttps://faculty.elgin.edu/dkernler/statistics/ch05/5-5.html\nhttp://questions.ascenteducation.com/iim_cat_mba_free_sample_questions_math_quant/permutation_combination/\nhttp://www.sawaal.com/aptitude-reasoning/quantitative-aptitude-arithmetic-ability/permutations-and-combinations-questions-and-answers.html\nhttp://www.allindiaexams.in/aptitude-questions-and-answers/permutations-and-combinations\nProbability:\nhttp://www.analyzemath.com/statistics/probability_questions.html\nhttp://www.theonlinetestcentre.com/probability.html#1\nhttps://www.indiabix.com/aptitude/probability/\nhttps://math.illinoisstate.edu/day/courses/old/312/assign/probproblems.html\nhttps://gpuzzles.com/quiz/conditional-probability-questions/")
            vprogs.push("MATH on Steroids\nA couple of years ago I came to the conclusion that our Math courses were stuck in the 20th Century and we were not doing right by our students. I decided to radically change how I was teaching, but because I wasn't too sure about where I was going I told my students that they probably weren't going to be able to get any help from the tutors. After experimenting for the last two years, I think I've figured things out and I want to explain them to you so you can start working with my students again. However, let me warn you that my students are going to use a different approach than other students.\n\nThe big difference in the way I teach is that I require my students to use technology for everything. Students can use any device that has an HTML5 compliant browser. Some browsers like Apple's Safari and Microsoft's Edge might misbehave since both of these companies want to protect you from any site that doesn't kowtow to their rules. Some students found it easier to install Firefox or Chrome. In the beginning I had purchased six Amazon Fire Tablets and lent them to students to use during class. Recently I have made the same offer but there were no students who didn't have a device of their own. They all had a phone, a tablet, a pad, or a laptop. Furthermore, although I show them how to use the software I wrote, I encourage them to go out to the internet and look at other software such as the awesome Wolfram Alpha.\n\nThe website for my software is at: www.WrightCalc.com  I've got an awful lot of stuff on this site as well as on my main page: http://faculty.ccc.edu/jnadas/\n\n")

            /*
            tprogs.push("The WrightCalc functions I use in Math 118 are\ndescribed in the Reader/editor module that has a tab labeled vocab. I tell my students that this is where they should start for an overview of each of the topics we will be covering:\n1) Logic words\n2) Counting words\n3) Probability words\n4) Statistics words\n5) Financial calculator words\n\n")
            tprogs.push("First, the Logic Calculator.\nIt talks about:\n1 - Statements, Truth Tables & s\n2 - Euler Diagrams, Venn Diagrams, and Circuits\n3 - Major Logic Operators and Equivalent Statements\n4 - More operators\n5 - DeMorgan's Laws\n6 - Conditionals and their inverse, converse, and contrapositive\n7 - Common syllogisms\n\n\n")
            tprogs.push("Next we talk about counting.\n1. counting vs. measuring:\n2. Systematic Listing, Tree diagrams, and formulas.\n3. Powers of n, factorials (n!), power set, 2^n, etc. \n4. Arrangements where order matters, Permutations, nPr, etc.\n5. Collections where order doesn't matter, Combinations, nCr, etc.\n6. Binomial distributions (Gender, Coins, Urns) Pascal's Triangle, Binomial Coefficients\n7. If X is a value then N(X) is the frequency of X, or the number of times X occurs\n\nI use a lot of resources such as card decks, rows of seats in a theater, lists of three digit numbers, dice, etc. This is less structured than the section on Logic and I try to get them to think about all kinds of other things they might need to count. For this topic I use several different modules including the Scientific Calculator\n")
            tprogs.push("Then we go on to the Probability calculator and talk about probabilities in the context of small finite sets as well as larger sets that are normally distributed.\n1. Sample Space, conditional probability, given that\n2. Favorable Event, things we are counting, could use words like NOT, OR, AND \n3. Probability - P(event) = N(event) ÷ N(sample space)\n4. Odds (for : against) = N(event) : [N(sample space)-N(event)]\n5. Binomial Probability, p + q = 1.0, Coins and gender have p = q = .5\n6. Expected value = average (mean)\n7. Empirical (data from experiments) vs theoretical (see law of Large Numbers)\n8. Mutually exclusive events\n\n\n")
            tprogs.push("Finally I bring in the Statistics/regression calculator where I tell them about 1-variable statistics, 2-variable statistics, and regression formulas. We talk about calculating z-scores and although I flash it on the screen, I do not show them how to use the Normal Distribution z-Table.\n\n1. data, grouped data (classes), frequency, probability distribution, relative frequency, Cumulative Frequency, also Cumulative relative. \n2. Pie Chart, Histogram (bar chart), Frequency polygon (line graph), stem & leaf plot, box plot, Ogive\n3. Measures of Central Tendency: mean, midrange, median, mode (2 modes=bimodal, more than 2=no mode)\n4. Measures of Dispersion: standard deviation, range, interquartile range IQR\n5. Quantiles: percentile, decile, quartile, (5-number summary)\n6. z-score number of standard deviations from the mean, relative position, k-score\n7. Normal distribution: Mean = Median = Mode = Midrange\n8. Convert Data <-> standard score <-> probability\n9. Empirical Rule (Gauss) z=1,2,3 gives p=0.6827, 0.9545, 0.9973\n\n\n")
            tprogs.push("Although I am currently not using it Math 118, I also have a Financial Calculator in the event that the department decides they want to change topics for the course.\n\nOK, that was the overview.  Now see if you can figure out how to do some of the problems from the study guide for the Fall 2011 Exit Test: http://faculty.ccc.edu/jnadas/2011fall/118guide.PDF\n\nLet me warn you that you will not want to group my students with students from other classes.\nBasically the big difference is that I require my students to use technology for everything. Students can use any device that has an HTML5 compliant browser for everything they do. Some browsers like Apple's Safari and Microsoft's Edge might misbehave since both of these companies want to protect you from any site that doesn't kowtow to their rules. Many students found it easier to install Firefox or Chrome. \nThe website for my software is at: http://www.WrightCalc.com  I've got an awful lot of stuff on this site as well as on my main page: http://faculty.ccc.edu/jnadas/. I show my students how to use the software I wrote, but I also encourage them to go out to the internet and look at other software such as Wolfram Alpha.\n\nJulius Nadas\nWright College Math Department") */

            lprogs.push('All about Logic\n\nLogic is a branch of mathematics that works with Statements and Arguments instead of Numbers and Formulas.  It has its own special vocabulary:\n\nStatements must be True or False;\n  can not be a question, command, exclamation or paradox: This sentence is false.\nLogical Operators create compound statements that can be evaluated with Truth Tables.\n  (the operators include AND ∧ , OR ∨ , NOT (~, ¬, !), XOR (⊻, ⊕, ≠), IMPL ⇒ , EQUIV ⇔ )\ncalled Conjunction, (inclusive) disjunction, negation, exclusive disjunction, implication, equivalence. \n  Ambition, Distraction, Uglification and Derision are not used in logic.\n  there are many alternate ways of writing all of these. For example here is a link for negation: https://en.wikipedia.org/wiki/Negation \nConditionals and their inverse, converse, and contrapositive\nDeMorgan\'s Laws, Syllogisms or Arguments (Valid or Invalid)\nQuantifiers:  (negation of a universal is an existential)\n  universal quantifiers: all, each, every, no(one)\n  existential quantifiers: some, there exists, (for) at least one\nEuler diagrams, Venn Diagrams\n  Mastercard (some), Target (all), Snake eyes(none)\nSwitches (on, off), Circuits (Series, Parallel)\nextra topics: Logic Puzzles & Sudoku')
            lprogs.push('Statements & Truth Tables\n\nStatements must be either true or false. They can be combined into compound statements using Logical Operations, sort of like Arithmetic Operations. \nTruth Tables are like multiplication tables that give you the results of these operations.\n\nFor example, this is a compound statement-\n You are smart and you work hard\nIn Logic class we use letters to stand for simple statements\n  p = you are smart;  q = you work hard\nthen we put them into the compound statement \"p and q\", which is written:\n  p ∧ q')
            lprogs.push('Major Logic Operators and Equivalent Statements\n\nCompound statements use the variables p,q,r,s to represent simple statements and are combined with operators like these: \"not, and, equiv, or, xor\"\nwritten as \"(~, ¬, !) ' + scap + ' ⇔ ' + scup + ' (⊻, ⊕, ≠)\"\nthese operations are called "negation, conjunction, equivalence, (inclusive) disjunction, and exclusive disjunction."\n\nA truth table shows the value of a compound statement. If all the values in the Truth Table are True then the statement is called a tautology.\nIf they are all False then it is a contradiction.\nIf it is anything else it is a contingency.\n Examples: tautology, contradiction, contingency:\np or not p, p and not p, not p')
            lprogs.push('DeMorgan has two laws that help you to simplify complicated logical statements.\nDe Morgan\'s laws are sort of like the distributive law in arithmetic. \nSo, there are three ways to Evaluate 2(3+4)\nusing PEMDAS (Aunt Sally\'s rule) you would get 2*7 = 14\nusing the distributive law you would get 2*3+2*4 = 6+8 = 14\nOr you could put the whole thing into a scientific calculator and get 14.\nAnyway, DeMorgan\'s NOR Law is:  ¬( p∨q ); (¬p∧¬q); ¬( p∨q ) ⇔ (¬p∧¬q)')
            lprogs.push('DeMorgan\`s NAND law\n is similar to the NOR Law:\n¬(p∧q); (¬p∨¬q); ¬(p∧q) ⇔ (¬p∨¬q)')
            lprogs.push('The Conditional is a very strange operator.\nThe best way to think of it is with a truth table.\nIt can be written many ways in English, such as: if p then q; p implies q; q follows from p; not p unless q; q if p; p only if q; whenever p, q; q whenever p; p is sufficient for q; q is necessary for p; p is a sufficient condition for q; q is a necessary condition for p.\nThere are three variations on conditionals called the inverse, converse, and contrapositive\nThe direct form <if P then Q> is written p⇒q where p is called the hypothesis and q is the conclusion.\nThe four forms are the direct, inverse, converse, and contrapositive written: \np⇒q, ¬p⇒¬q, q⇒p, ¬q⇒¬p ')
            lprogs.push('An example combining several operations\n In English you might say: if you are smart and you work hard then you will be successful.\nIn logic you would write:  p = you are smart;  q = you work hard;  r = you are successful\n\"if p and q then r\" is written:\n  p ∧ q ⇒ r ')
            lprogs.push('(p⇒q) is equivalent to (¬p ' + scup + ' q); the negation (using DeMorgan\'s law) is (p ' + scap + ' ¬q)\n\nTo prove this, generate the truth tables and compare them to each other:\np⇒q, ¬p' + scup + 'q, p' + scap + '¬q')
            lprogs.push('All 16 logical operations.\nThere are a total of 16 logical operators, 10 more than the 6 common ones you have already seen. They are:\np' + scup + '¬p,p' + scup + 'q,q⇒p,p,p⇒q,q ,p⇔q,p' + scap + 'q,¬p' + scup + '¬q,p≠q,¬q,p' + scap + '¬q,¬p,q' + scap + '¬p,¬p' + scap + '¬q,p' + scap + '¬p')
            lprogs.push('Another collection of operations. Can you tell which ones are missing?: \np∨q;p∧q;p⇒q;p⇔q;¬p∨q;¬p∧q;¬p⇒q;¬p⇔q;p∨¬q;p∧¬q;p⇒¬q;p⇔¬q;¬p∨¬q;¬p∧¬q;¬p⇒¬q')
            lprogs.push('Arguments are similar to formulas.\nThey consist of one or more statements called premises that lead to a statement called the conclusion.\nIf every line in a truth table is true then the argument is valid. If any line is not true then the argument is invalid or a fallacy.\nSome arguments even have names, for example modus ponens (Law of detachment, implication elimination):\np→q\np\n---\nq')
            lprogs.push('modus tollens\n(contraposition, indirect reasoning):\np⇒q; ¬q ∴ ¬p')
            lprogs.push('disjunctive syllogism\n(modus tollendo ponens):\np∨q; ¬p ∴ q')
            lprogs.push('the chain rule\n (transitivity of implication or Hypothetical Syllogism): \np⇒q, q⇒r ├ p⇒r')
            lprogs.push('fallacy of the inverse\n (denying the antecedent):\np⇒q; ¬p ∴ ¬q')
            lprogs.push('fallacy of the converse\n (affirming the consequent):\np⇒q; q ∴ p')
            lprogs.push('Euler Diagrams, Venn Diagrams, and Circuits\n\nIn addition to Truth Tables, Diagrams and Circuits are other ways to represent logic statements.\n\nLogic diagrams such as Euler Diagrams and Venn Diagrams can be thought of as\n  None [aka two fried eggs]\n  Some [aka Mastercard] and\n  All [aka target]\n\nElectric circuits, made up of switches, are also used to illustrate logical statements where a switch can be either ON (True) or OFF (False)\nYou can combine switches into parallel circuits [OR operation] or in series [AND operation]\nWe will only use simple on/off switches, not three way switches, not logic gates nor integrated circuits\n\n      p\n    _∠_                p    q\n___⌈    ⌉_____       ___∠___∠___\n   ⌊_∠_⌋ \n     q \n\nthese circuits represent:\n   p ∨ q ,           p ∧  q')
            lprogs.push("NPR's Car Talk has some fun puzzles that use logic.  Here is one:      Rowena and the Three Boxes\nRAY: This comes from the days of knights and kings and fair maidens and...\nTOM: And people named Rowena.\nRAY: Rowena. There you go. Turns out that the fair maiden Rowena wishes to wed.  And her father, the evil king, has devised a way to drive off suitors. He has a little quiz for them, and here it is.  It's very simple. There are three boxes on the table, OK? One is made of gold. One is made of silver. And the third is made of...\nTOM: Tofu.\nRAY: Lead. Inside one of these boxes is a picture of the fair Rowena. And it is the job of the knight, the white knight, to figure out which--without opening them, of course, which one has her picture. Now, to assist him in this endeavor there are inscriptions on each of the boxes.\nThe gold box says,  ''Rowena's picture is in this box.''\nThe silver box says, ''The picture ain't in this box.''\nAnd the lead box says, ''The picture ain't in the gold box.''\nTOM: Yeah. But he also gives him a hint, right? He's going to give him a hint.\nRAY: Yes. The hint is, one of the statements, and only one, is true.\nTOM: Excellent!\nRAY: The question is: Where's the picture?\n\np=gold,q=silver,r=lead:\np,q,r,p,not q,not p\n((p^!q^!r)v(!p^q^!r)v(!p^!q^r))\n((p^!!q^!!p)v(!p^!q^!!p)v(!p^!!q^!p))\n((p^!q^!r)v(!p^q^!r)v(!p^!q^r))^((p^!!q^!!p)v(!p^!q^!!p)v(!p^!!q^!p))")
            lprogs.push("Another puzzle from CarTalk:    The Perplexing Paragraph\nRAY: I'm going to read this just the way I got it. It came from Robert Skidmore. He says, \"OK, I sent this one to you to be put in the daily trivia. Since you didn't do that, I'll send it again. This time as a Puzzler. It'll probably be more fun to have people try to answer it after hearing it rather than after reading it anyway. The person trying to answer this puzzle must listen/look closely at the following paragraph.\"\n\n\"This paragraph is odd. What is its oddity? You may not find it at first, but this paragraph is not normal. What is wrong? It's just a small thing, but an oddity that stands out if you find it. What is it? You must know. Your days will not go on until you find out what is odd. You will pull your hair out. Your insomnia will push you until your poor brain finally short-circuits trying to find an oddity in this paragraph. Good luck.\"")
            lprogs.push("More puzzles:\n(1) Mary’s father has FIVE daughters. Four of them are called: Nana, Nene, Nini, Nono. Look at the pattern and guess what is the most likely name for the fifth daughter name?\n(2) Question: A hobo picks up cigarette butts from the ground and can make a cigarette with 4 butts. If he finds 16 cigarette butts, how many cigarettes can he smoke?\n(3) What is the next number in the sequence? 1 11 21 1211 111221 312211\n(4) There are 100 coins scattered in a dark room. 90 have heads facing up and 10 are facing tails up. You cannot tell which coins are which. How do you sort the coins into two piles that contain the same number of tails up coins?\n(5) You're on a game show with the choice of three doors: Behind one door is a car; behind the others, goats. You pick a door, say No. 1, and the host, who knows what's behind the doors, opens another door, say No. 3, which has a goat. He then says to you, 'Do you want to pick door No. 2?' Is it to your advantage to switch your choice?\n(6) A man wants to have a party in thirty-one days where he will be serving his 1000 barrels of wine. The only problem is that one of his enemies poisoned one of the barrels. The poison kills any man who drinks any of the wine in about 30 days, give or take a few hours. The man has 10 plants that are also killed by the poison in 30 days and can be used to test the wine. How can identify the single poisoned barrel of wine?\n(7) If you have 30 white socks, 22 black socks, and 14 blue socks scattered across the floor in the dark, how many would you have to grab to get a matching pair?\n(8) You have three coins. One always comes up heads, one always comes up tails, and one is just a regular coin (has equal chance of heads or tails). If you pick one of the coins randomly and flip it twice and get heads twice, what is the chance of flipping heads again?\n(9) In a certain society any time somebody commits a serious crime they must be shot at twice with a 6 bullet revolver. The revolver only has two bullets in it, both of them right next to each other. They spin the revolver once and shoot the gun. If there was no bullet in that chamber they give the prisoner the option to either spin the chamber again or just shoot again. If the first shot is a blank, should the prisoner ask for the revolver to be spun or should they choose that it be shot again?")
            mprogs.push("converts math expressions to JavaScript:\nx=1; y=2; z=x*y+5")
            mprogs.push("only prints values which satisfy the trailing condition:\nx=2^p; y=2^q; x-y==224\n")
            mprogs.push("calculates running total:\n cos(x); z=3x2-2x; y=y+z")
            mprogs.push("Uses value from an array to evaluate expressions:\nx=[7,1,5,2]\n3x2-2x; x+1")

            jsprogs.push("// Pascal's triangle\nnoRows=input ('number of rows')\np=[[1],[1,1],[1,2,1]]; kk=''\nfor (i=p.length;i<noRows;i++){\n p[i]=[1]\n for (j=1;j<p[i-1].length;j++)p[i][j]=p[i-1][j-1]+p[i-1][j]\n p[i][i]=1\n}\nfor (i=0;i<p.length;i++){\n k='';s=0;t=0\n for (j=0;j<p[i].length;j++){\n  x=p[i][j];k+=x+', ';s+=x;t+=x*x\n  }\n  print(k+'  Σx='+s+'  Σx²='+t)\n}")
            jsprogs.push("// generate pythagorean triples\nfor (i=2;i<20;i+=2){\na=i*i; for (m=0;m*m<a;m++){\nif (a%m==0){\nn=a/m; if(gcf(n+m,gcf(n-m,2*i))==1){ \nfor(k=1;k<2;k++){\nprint (k*(n-m),k*(2*i),k*(m+n))}}}}}")
            jsprogs.push("// read & write\nprint('navigator.appVersion: '+navigator.appVersion);\nprint('navigator.userAgent: '+navigator.userAgent);\nprint('navigator.appName: '+navigator.appName);\nprint('navigator.platform: '+navigator.platform);\n// First, the program says hello world and asks for your name\nprint('hello world!','')\nmyName=input('What is your name')\nprint ('It is good to meet you, '+myName)\n//Then it loads data into the textbox dataIn, Or you could load it by hand\n// or from a cookie: loaddata('xxx') or load automatically from cookie 'dataIn'\nif (dataIn.length==0) dataIn='1,2,3,4\\ntwo\\ntres\\nnégy'\ni=0; b=[]\nwhile (dataIn.length>0){\n i++; a=read(); aa=a.split(',')\n if (typeof(aa)== 'object') if(!isNaN(aa[0])) print(Number(aa[0]))\n b.push('('+slim(a)+')'); write('item #'+i+' is '+a+'\\n')\n}\nwrite ('that\\'s all folks')\nprint (i+' items written: '+ b)\n//press enter to run the program\n//or ESC to edit it and then ESC/enter to run it\n//g=dataOut; if (g.length==0) {g=$_screen;g=g.slice(g.lastIndexOf('---')+3)}\n//  localStorage.setItem('graphdata',g);window.open('graphs.php')")
            jsprogs.push("// A javascript program using three different methods for getting data:\n// Method one: hard assignment inside the program.\nvar a=1, b=2\nprint('a is '+a); print('b is '+b)\nprint('the sum of '+a+' plus '+b+' is '+(a+b))\n// Method two: funky input command.\na=Number(input('enter a number'))\nb=Number(input('and another number'))\nprint('the sum of '+a+' plus '+b+' is '+(a+b))\ninput('press ENTER to continue')\n// Method three: text box with a prompt command.\na=Number(prompt('enter a number'))\nprint('a is '+a); show() \nb=Number(prompt('enter another number'))\nprint('b is '+b)\nprint('the sum of '+a+' plus '+b+' is '+(a+b))\n// Press [run] to run the program.")
            jsprogs.push("S='The sum of the first '; V=10 //  primes\nX=1; T=0; U=0\nwhile (U<V)\n{ X+=1\n  if (prime(X)[0]=='i')\n  { print (X,' ')\n    T+=X; U+=1 }}\nprint ()\nprint (S+U+' primes is '+T)")
            jsprogs.push("// Randomly put <c> numbers into <b> boxes\nc=12;b=4;s=[];for(i=1;i<=c;i++) s.push([Math.random(),i]);s.sort();for (i=0;i<b;i++){print('Box '+(i+1)+': ','');for (j=Math.floor(i*c/b);j<Math.floor((i+1)*c/b);j++) print(s[j][1]+' ','');print()}")
            jsprogs.push("// sum of 5 digits == N\nS=''; M=10; N=21; K=0; L=0; X=0; Y=0; Z=0; T=0; U=0\nfor (X=0;X<M;X+=1)for (Y=0;Y<M;Y+=1)for (Z=0;Z<M;Z+=1)for (T=0;T<M;T+=1)for (U=0;U<M;U+=1) {L+=1; if ( X+Y+Z+T+U==N ){K+=1; S+='('+X+','+Y+','+Z+','+T+','+U+') '}}; S=K+'/'+L+': '+S;")
            jsprogs.push("// process array\np=[      ];S='(x       )'; for(i=0;i<p.length;i++) { X=p[i]; S+='\\n('+X       +')'}")
            jsprogs.push("// process file, default: loaddata('dataIn')\ni=0\nwhile (dataIn.length>0)\n{ a= read();\n  print (++i,a)}\nprint('the end')")
            jsprogs.push("// Bagels - a number guessing game - converted from Bagels.py\n// from the 2nd edition of 'Invent Your Own Computer Games with Python'\n// by Albert Sweigart \nfunction getSecretNum(numDigits){\n  // returns a string that is numDigits long, made up of unique random digits\n  c=[[]]; for (i=0;i<10;i++) c[i]=[rand(),i]\n  c.sort(function (a,b){return a[0]-b[0]})\n  var secretNum=''; for (i=0;i<numDigits;i++) secretNum+=c[i][1]\n  return(secretNum)} \nfunction getClues(guess, secretNum){\n  // returns a string with the pico, fermi, bagels clues to the user\n  if (guess==secretNum) {\n    return 'You got it!'}\n  clue=[]\n  for (i=0; i<guess.length; i++){\n    if (guess.charAt(i)==secretNum.charAt(i)) clue.push('Fermi')\n    else if (secretNum.search(guess.charAt(i))>-1) clue.push('Pico')}\n  if (clue.length==0) return 'Bagels'\n    clue.sort()\n    return clue.join(' ')}\nfunction isOnlyDigits(num){\n  // returns true if num is a string made up of only digits. \n  //   Otherwise returns false\n  return num.search(/\\D/)<0}\nfunction playAgain(){\n  // return true if the player wants to play again, otherwise return false\n  return input('Do you want to play again? (yes or no)').toLowerCase().charAt(0)=='y'}\nNUMDIGITS = 3\nMAXGUESS = 10\nprint('I am thinking of a '+NUMDIGITS+'-digit number. Try to guess what it is.')\nprint('Here are some clues:')\nprint('When I say:    That means:')\nprint('  Pico         One digit is correct but in the wrong position')\nprint('  Fermi        One digit is correct and in the right position')\nprint('  Bagels       No digit is correct')\nwhile (true) {\n  secretNum=getSecretNum(NUMDIGITS)\n  print('I have thought up a number. You have '+MAXGUESS+' guesses to get it.')\n  numGuesses=1\n  while (numGuesses<=MAXGUESS) {\n    guess=''\n    while (guess.length != NUMDIGITS || !isOnlyDigits(guess)) {\n      guess=input('Guess #'+numGuesses)}\n    clue=getClues(guess, secretNum)\n    print('',clue)\n    if (guess==secretNum) break\n    numGuesses += 1\n    if (numGuesses>MAXGUESS)\n      print('You ran out of guesses. The answer was '+secretNum+'.')}\n  if (!playAgain()) break\n  }\n")
            jsprogs.push("// Sonar - converted from Sonar.py\n// from the 2nd edition of 'Invent Your Own Computer Games with Python'\n// by Albert Sweigart\nfunction drawBoard(board){\n  // Draw the board data structure\n  cls()\n  hline='    ' // initial space for the numbers down the left side of the board\n  for (var i=1; i< 6; i++) hline += '         '+i\n  // print the numbers across the top\n  print(hline)\n  print('   ' + ('012345678901234567890123456789012345678901234567890123456789'))\n  print()\n  // print each of the 15 rows\n  for (var i =0;i < 15;i++) {\n    // single-digit numbers need to be padded with an extra space\n    if (i<10) XSpace=' '; else XSpace=''\n    print(''+ XSpace+''+i +' '+getRow(board,i) +' '+i  )}\n  // print the numbers across the bottom\n  print()\n  print('   '+('012345678901234567890123456789012345678901234567890123456789'))\n  if (showHints) hline='+*#@&'+hline.slice(5)\n  print(hline)}\nfunction getRow(board, row){\n  // return a string from the board data structure at a certain row\n  boardRow=''\n  for (var i =0;i < 60;i++) boardRow += board[i] [row]\n  return boardRow}\nfunction getNewBoard(){\n  // create a new 60 x 15 board data structure\n  board=[]\n  for (var x =0;x < 60;x++) { // the main list is a list of 60 lists\n    board.push([])\n    for (var y =0;y < 15;y++) { \n      // each list in the main list has 15 single-character strings\n      // use different characters for the ocean to make it more readable\n      if (rand(0,1) == 0) board[x].push('~')\n      else board[x].push('`') }}\n  return board}\nfunction getRandomChests(numChests){\n  // create a list of chest data structures\n  // two-item lists of x, ycoordinates\n  chests=[]\n  for (var i =0;i < numChests;i++) {\n    chests.push([rand(0,59),rand(0,14)])}\n  return chests}\nfunction isValidMove(x, y){\n  // return true if (the coordinates are on the board, otherwise false\n  return x>=0 && x<=59 && y>=0 && y<=14}\nfunction makeMove(board, chests, x, y){\n  // Return -1 if this is an invalid move\n  // Remove treasure chests from the list as they are found. \n  // Otherwise, return the result of this move.\n  if (! isValidMove(x, y)) {return -1}\n  smallestDistance=100 //any chest will be closer than 100\n  ci=-1\n  for (var i=0;i<chests.length;i++) {\n    cx=chests[i][0]; cy=chests[i][1] \n    if (Math.abs(cx-x) > Math.abs(cy-y)) distance = Math.abs(cx-x)\n    else distance = Math.abs(cy-y)\n    if (distance < smallestDistance) {\n      // we want the closest treasure chest\n      ci=i; smallestDistance = distance}} \n  if (smallestDistance == 0) {\n      // xy is directly on a treasure chest!\n        board[x][y] = '$'; copyOfBoard[x][y] = '$';\n    chests=chests.splice(ci,1)\n    return 0}\n  else if (smallestDistance<10) {\n    board[x][y] = (smallestDistance)\n    x1=x-smallestDistance; y1=y-smallestDistance; sd2=2*smallestDistance\n    x2=x1+sd2; y2=y1+sd2\n    if (showHints) for (i=0;i<sd2;i++){\n      writeHint(x1+i,y1); writeHint(x2,y1+i); writeHint(x2-i,y2); writeHint(x1,y2-i)} \n    return 'Treasure detected at a distance of '+smallestDistance +' from the sonar device.' }\n  else {\n    if (board[x][y]!='$') board[x][y] = 'O'\n    return 'Sonar did not detect anything. All treasure chests out of range'}}\nfunction writeHint(x,y){\n  if (x>=0 && x<=59 && y>=0 && y<=14) {\n    if (board[x][y] == '`' || board[x][y] == '~') board[x][y] = '+'\n    else if (board[x][y] == '+') board[x][y] = '*'\n    else if (board[x][y] == '*') board[x][y] = '#'\n    else if (board[x][y] == '#') board[x][y] = '@'\n    else if (board[x][y] == '@') board[x][y] = '&'}}\n\nfunction enterPlayerMove(){\n  // let the player type in a move. Return a two-item list of int xy coordinates\n  print('Where do you want to drop the next sonar device? (1-59,0-14) (or type quit)')\n  while (true) {\n    move = input()\n    if (move.toLowerCase().charAt(0) == 'q') {\n      print('Thanks for playing!');return []}\n    if (move.toLowerCase().charAt(0) == 'h') {\n      showHints=!showHints\n      if (!showHints){\n        for (i=0;i<theBoard.length;i++){\n        for (j=0;j<theBoard[i].length;j++) theBoard[i][j]=copyOfBoard[i][j]}}\n      for (i=0;i<previousMoves.length;i++) {\n        makeMove(theBoard, theChests, previousMoves[i][0],previousMoves[i][1])}\n      drawBoard(theBoard); continue}\n    move = move.split(',')\n    if (move.length == 2 && !isNaN(move[0]) && !isNaN(move[1]) && isValidMove(move[0], move[1])) {\n      return  [int(move[0]), int(move[1])] }\n    print ('Enter a number from 0 to 59, a comma, then a number from 0 to 14')}}\nfunction playAgain(){\n  // This function returns true if (the player wants to play again, otherwise it returns false\n  return input('Do you want to play again? (yes or no)').toLowerCase().charAt(0)=='y'}\nfunction showInstructions(){\n  print ('Instructions: You are the captain of the Simon, a treasure-hunting ship. Your current mission\\nis to find the three sunken treasure chests that are lurking in the part of the\\nocean you are in, and collect them.\\n\\nTo play, enter the coordinates of the point in the ocean you wish to drop a\\nsonar device. The sonar can find out how far away the closest chest is to it.\\nFor example, the d below marks where the device was dropped, and the 2\\'s\\nrepresent distances of 2 away from the device. The 4\\'s represent\\ndistances of 4 away from the device.\\n\\n  444444444\\n  4       4\\n  4 22222 4\\n  4 2   2 4\\n  4 2 d 2 4\\n  4 2   2 4\\n  4 22222 4\\n  4       4\\n  444444444\\nPress enter to continue...')\n  input();cls()\n  print('For example, here is a treasure chest (the c) located a distance of 2 away\\nfrom the sonar device (the d)) {\\n\\n  22222\\n  2   2\\n  2 d 2\\n  2   2\\n  22222\\n\\nThe point where the device was dropped will be marked with a s.\\n\\nThe treasure chests don\\'t move around. Sonar devices can detect treasure\\nchests up to a distance of 9. If all the chests are out of range, the point\\nwill be marked with O\\n\\nIf a device is directly dropped on a treasure chest, you have discovered\\nthe location of the chest, and it will be collected. The sonar device will\\nremain there.\\n\\nWhen you collect a chest, all sonar devices will update to locate the next\\nclosest sunken treasure chest.\\nPress enter to continue...')\n  input();cls()}\n//---------------------*/\nshowHints=false\nprint('S O N A R !'); print()\nif (input('Would you like to view the instructions? (yes/no)').toLowerCase().charAt(0)=='y') showInstructions()\nwhile (true) {\n  // game setup\n  sonarDevices = 16\n  theBoard = getNewBoard()\n  copyOfBoard=[] // make a copy\n  for (i=0;i<theBoard.length;i++){\n    copyOfBoard[i]=[]\n    for (j=0;j<theBoard[i].length;j++) copyOfBoard[i][j]=theBoard[i][j]}\n  theChests = getRandomChests(3)\n  previousMoves = []\n  while (sonarDevices > 0) {\n    // Start of a turn:  show sonar device/chest status\n    drawBoard(theBoard)\n    if (sonarDevices > 1) { XSsonar = 's'}\n    else { XSsonar = ''}\n    if (theChests.length > 1) { XSchest = 's'}\n    else { XSchest = ''}\n    if (typeof(moveResult)=='string') print(moveResult)\n    print('You have '+sonarDevices +' sonar device'+XSsonar+' left.','')\n   print(theChests.length +' treasure chest'+ XSchest +' remaining.')\n    z = enterPlayerMove()\n    if (z.length==0) break\n    x=z[0]; y=z[1]\n    previousMoves.push(z) // we must track all moves so that sonar devices can be updated\n    moveResult = makeMove(theBoard, theChests, x, y)\n    if (moveResult<0) continue\n    else if (moveResult==0) {\n      moveResult='Congratulations!'\n      for (i=0;i<theBoard.length;i++){\n        for (j=0;j<theBoard[i].length;j++) theBoard[i][j]=copyOfBoard[i][j]}\n        // update all the sonar devices currently on the map.\n      for (i=0;i<previousMoves.length;i++) {\n        makeMove(theBoard, theChests, previousMoves[i][0],previousMoves[i][1])}}\n    if (theChests.length == 0) {\n      print('You have found all the sunken treasure chests!'); break}\n    sonarDevices -= 1}\n  if (sonarDevices == 0) {\n    print('We\\'ve run out of sonar devices! Now we have to turn the ship around and head')\n    print('for home with treasure chests still out there! Game over.') }\n  showHints=false\n  drawBoard(theBoard)\nif (theChests.length>0) {\n      print('The remaining chests were here:','')\n      for (i=0;i<theChests.length;i++) \n        print('('+theChests[i][0],theChests[i][1]+')   ','')\n      print()}\n  if (!playAgain()) break\n  moveResult}\n//\n")
            // ---
            pyprogs.push("# Convert Python programs to J/S. This program says Hello World and asks for my name\n# from the 2nd edition of 'Invent Your Own Computer Games with Python'\n# by Albert Sweigart\nprint('Hello World!')\nprint('What is your name?')\nmyName=input()\nprint ('It is good to meet you, '+myName)")
            pyprogs.push("# this is a guess the number game.\n# from the 2nd edition of 'Invent Your Own Computer Games with Python'\n# by Albert Sweigart\nimport random\nguessesTaken=0\nprint('Hello!')\nmyName=input('What is your name?')\nnumber=random.randint(1,20)\nprint ('Well, '+myName+', I am thinking of a number between 1 and 20.')\nwhile guessesTaken<6:\n    guess=input('Take a guess')\n    guess=int(guess)\n    guessesTaken=guessesTaken+1\n    if guess<number:\n        print('Your guess is too low')\n    if guess>number:\n        print('Your guess is too high')\n    if guess==number:\n        break\nif guess==number:\n    guessesTaken=str(guessesTaken)\n    print('Good job, '+myName+'! You guessed my number in '+guessesTaken+' guesses')\nif guess!=number:\n    number=str(number)\n    print('Nope. The number I was thinking of was '+number)\n")
            pyprogs.push("print ('I will flip a coin 1000 times. Guess how many times it will come up heads.')\n# from the 2nd edition of 'Invent Your Own Computer Games with Python'\n# by Albert Sweigart\nimport random\ninput('(press enter to begin)')\nflips=0\nheads=0\nwhile flips<1000:\n    if random.randint(0,1)==1:\n        heads=heads+1\n    flips=flips+1\n    if flips==900:\n        print('There have been 900 flips and there have been '+str(heads)+' heads.')\n    if flips==100:\n        print('At 100 tosses, heads has come up '+str(heads)+' times so far.')\n    if flips==500:\n        print ('Halfway done, and heads had come up '+str(heads)+' times.')\nprint()\nprint('Out of 1000 coin tosses, heads came up '+str(heads)+' times. Were you close?')\n")
            pyprogs.push("# dragons\n# from the 2nd edition of 'Invent Your Own Computer Games with Python'\n# by Albert Sweigart\nimport random\nimport time\ndef displayIntro():\n    print('You are on a planet full of dragons. In front of you, ')\n    print('you see two caves. In one cave, the dragon is friendly ')\n    print('and will share his treasure with you. The other dragon ')\n    print('is greedy and hungry, and will eat you on sight.')\n    print()\ndef chooseCave():\n    cave=''\n    while cave !='1' and cave !='2':\n        print('Which cave will you go into? (1 or 2)')\n        cave=input()\n    return cave\ndef checkCave(chosenCave):\n    print('You approach the cave...')\n    time.sleep(2)\n    print('It is dark and spooky...')\n    time.sleep(2)\n    print('A large dragon jumps out in front of you! He opens his jaws and...')\n    print()\n    time.sleep(2)\n    friendlyCave=random.randint(1,2)\n    if chosenCave==str(friendlyCave):\n        print('gives you his treasure')\n    else:\n        print('gobbles you down in one bite')\nplayAgain='yes'\nwhile playAgain=='yes' or playAgain=='y':\n    displayIntro()\n    caveNumber=chooseCave()\n    checkCave(caveNumber)\n    print('Do you want to play again? (yes or no)')\n    playAgain=input()\n")
            pyprogs.push("# python program to test true and false\n# from the 2nd edition of 'Invent Your Own Computer Games with Python'\n# by Albert Sweigart\n# press [python] to convert this to javascript\n# then press [run] to run the javascript program\ndef TrueFizz(message):\n    print(message)\n    return True\ndef FalseFizz(message):\n    print(message)\n    return False\nif FalseFizz('Cats') or TrueFizz('Dogs'):\n    print('Step 1')\nif TrueFizz('Hello') or TrueFizz('Goodbye'):\n    print('Step 2')\nif TrueFizz('Spam') and TrueFizz('Cheese'):\n    print('Step 3')\nif FalseFizz('Red') and TrueFizz('Blue'):\n    print('Step 4')\n")

            cprogs.push("Using a scientific calculator to count things:\nWARNING! Be careful with the order of operations (PEMDAS or Aunt Sally): 4+6/3+2\n is not the same as: (4+6)/(3+2)\n\n")
            cprogs.push("There are many functions you can use depending on what you need to count:\nStart with counting things that are distinct, how many ways can you take 5 objects out of 12: n=12; r=5\nyou can do permutations, arrangements of r objects out of n, order matters: nPr(n,r) \nor you can do combinations, select r objects out of n, order doesn't matter: nCr(n,r)\nfactorials, all the arrangements of n distinct objects) n!:fact(n)\nor arrangements with r identical objects out of n: fact(n)/fact(r)\nwords (join r objects out of n, same object can be repeated): n^r \nPower set (all possible subsets of n objects): 2^n\nYou can restrict your choices by saying 'given that' or specify combinations using 'and/or/not/except'\nor add up all the ones where the answer is 'at least/more than' or 'at most/less than' or 'only/exactly'")
            cprogs.push("using nCr to create Pascal's triangle and binomial coefficients.:\nPascal's triangle for n=4:\n    1\n   1 1\n  1 2 1\n 1 3 3 1\n1 4 6 4 1\n(x+y)^4 = x^4 +4x^3 y +6x^2 y^2 +4x y^3 +y^4")
            cprogs.push("Sample problems in addition to the ones in the study guides:\nYou have seven books each of which is named after a day of the week. How many different ways can you\nArrange all of them on a shelf.\nArrange any three of them\nArrange three of them such that exactly one of them starts with the letter S\nArrange three of them such that there is at least one that starts with the letter T\nArrange them alphabetically\nArrange the set consisting of the first letter of each book's name.\nArrange the set of first letters alphabetically.\nSame problems, except you only select them to go into a bag.\n")
            cprogs.push("examples of math functions using the variables: a=10; b=12\naddition: a+b\nsubtraction: b-a\nmultiplication: a×b\ndivision: b÷a\nmodulus (remainder): b%a\nexponentiation (powers): c= b^a\nsquare root: √(b)\n(a) root: c^(1/a)\ngreatest common factor: gcf(a,b)\nleast common multiple: lcm(a,b)\nsum to get the gcf: gcfsum(a,b)\nexpress the number b as a string d in base five: d= base(b,5)\nconcatenate the string with a number: d+97\nconvert the string d in base five back to base ten: base (d,5)\nequation of the line from (0,b) to (a,32): line(0,b,a,32)\nprime factors of b times a: prime(b*a)\n")
            cprogs.push("Counting triangles:\n Draw six lines such that \n  (i) none of them is parallel with any of the other five and\n (ii) there is no point where more than two lines intersect each other.\n How many triangles are formed?\n is it (A) 12  (B) 18  (C) 20  (D) 24 ")

            // cprogs.push("Math test key template:\n;q=z\n1)\n2)\n3)\n4)\n5)\n6)\n7)\n8)\n9)\n10)\n11)\n12)\n14)\n15)\n16)\n17)\n18)\n19)\n20)\nz")

            sprogs.push("Enter algebraic expression and/or equations and simplify or solve them:\nw =10018 +23.40")
            sprogs.push("polynomial division:\n(3x^2 +7x +2)/(x+2)")
            sprogs.push("solve for a specific variable:\n2a+3b=y ;b")
            sprogs.push("Combine like terms:\n3a+2(a+b)+4(b-1)^2")
            sprogs.push("Binomial coefficients:\n(x+y)^7\n")
            sprogs.push("Simplify:\n4x*(x+2)^2\n")

            stprogs.push("One variable statistics\nMaybe this poem will help with some of the words?\n\nHey diddle diddle,\nthe median's the middle;\nyou add and divide for the mean.\nThe mode is the one that appears the most,\nand the range is the difference between.")
            stprogs.push("You have several options for entering data to be analyzed-\n  one variable x:\n  an optional second variable y:\n  frequencies f:\nor you can combine lists\n  xy:\n  xf:\n  xyf:")
            stprogs.push("Example of one variable data\nx:1 2 3 4 5 2 3 4 3 2 3 4 2 3 4")
            stprogs.push("The same data using frequencies\nxf: 1 1 2 4 3 5 4 4 5 1")
            stprogs.push("If you have a lot of data you may want your data grouped into classes.\nx:16, 16, 25, 21, 28, 16, 30, 21, 28, 26, 37, 37, 29, 20, 36, 29, 34, 25, 43, 43, 43, 45, 33, 41, 43, 37, 38, 39, 44, 48, 49, 39, 50, 51, 56, 37, 47, 49, 49, 58, 49, 43, 62, 48, 55, 48, 55, 49, 56, 63, 63, 56, 54, 62, 51, 56, 60, 73, 72, 70, 61, 69, 63, 63, 79, 71, 64, 77, 78, 76, 81, 79, 84, 83, 79, 86, 83, 82, 90, 74, 77, 92, 74, 76, 84, 93, 81, 64, 83\neight classes-\nw:8")
            stprogs.push("data used in Math 118 test 4\nx: 19,26,48,45,50,56,35,10,10,35,67,66,46,35,35,29,10,65,66,35")
            stprogs.push("Visual Display: \nfrequency table, \nrelative frequency table, \nhistogram (bar chart), \nfrequency polygon, \nstem & leaf, \npie chart")
            stprogs.push("Measures of central tendency (think of them as 'averages'): \nMean: add them up and divide by how many there are, \nMedian: put them into ascending order and take the middle one, \nMode: the one that occurs most frequently , \nMidrange: half way between the smallest and the largest.")
            stprogs.push("Measures of dispersion: \nstandard deviation from the mean, \nquartiles: box and whiskers used with the the median, also deciles, and percentiles, \nrange: the smallest subtracted from the largest")
            stprogs.push("Measures of Position: \nz-score: data value minus the mean divided by the standard deviation \nz = ( X - μ ) ÷ σ  \nIt is A.K.A. number of standard deviations from the mean, the relative position, k-score, etc., \nChebyshev's rule (1-1/n^2)")
            stprogs.push("Continuous Probability \nequals the area under the normal curve generated by the mean and standard distribution, \n Gauss numbers: 0.68, 0.95, 0.9973)\n Chebyshev numbers 0, 0.75, 0.8889, 0.9375 ")
            stprogs.push("Two variable data separately:\nx:1 4 2 3 5\ny:2 17 5 10 26\no:1 ")
            stprogs.push("Two variables combined:\nxy:1 2 4 17 2 5 3 10 5 26\no: 1 ")
            stprogs.push("Regression and correlation.  \ny' = mx + b")
            stprogs.push("Text book chapter: Describing Data\n http://www.opentextbookstore.com/mathinsociety/current2.php?chapter=DescribingData.pdf")

            sigma = String.fromCharCode(963)
            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                document.theForm.input.value = "";
                trytoload(ls.slice(1));
                menucode = 3;
                menui = -1
            }
        </script>
    </div>
</body>

</html>