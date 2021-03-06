<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sudoku</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <script type="text/javascript" src="http://faculty.ccc.edu/jnadas/js/myfunctions.js"></script>
    <script type="text/javascript">
        // - - - - - - - test games
        var game = [],
            bank = []
        //         V  .  .  V  .  .  V  .  .  V  .  .  V  .  .  V  .  .  V  .  .  V  .  .  V  .  .  V
        bank.push("209501060080000005000042031500000600020165040008000002870210000600000080090307506error after 17 steps")
        bank.push("301000804046801300807403002610080009489602000730000086504708000073105648108000900quint")
        bank.push("070094002400271096000300100000050700300807005754020000009002000540000000800910030vertical xwing 5's in 3 & 7")
        bank.push("410000620005006090000700000008607000060109050000502100000003000090400700046000018vertical xwing 3's in columns 0&6")
        bank.push("005201700000080000040507080507000802000020000204000903090374050000060000003102600horizontal xwing 2's in lines 3&7")
        bank.push("530014000064023500700056000080390450305040800009085030800560002001238970000470080no")
        bank.push("007300080000010003008950046100680200000000067006097008820069300700030000050001600no")
        bank.push("0006090404000005108200000000509700000018037000000640300000000210160000080803070005*")
        bank.push("000403080200000903000006000750300008490080072800007064000700000309000007040502000no")
        bank.push("813000060050043070000000000001790054470060900000300010000009000048000000560008030simple colouring")
        bank.push("408600000000090006002007000005900100104000805007004600000800900300050000000006207simple colouring")
        bank.push("080063020000801340030409865713942658829600413000318792508134270002086034340290080simple colouring")
        bank.push("0001700005000000606080031000002010070960002801008090000054009020800000060000150006*")
        bank.push("085006004000040060060200010059600020002000600040002830030004080020080000400900750yes")
        bank.push("030000007000093100000240006000006580600000002079100000200079000004350000300000040yes")
        bank.push("700300000020090060000080952300000080000438000060000007512070000030040020000002009yes")
        bank.push("000050023030048009006002000050000002642507318100000070000200400400160030760030000no")
        bank.push("000001000378000040000078020200006904081000230509200001090450000010000473000100000yes")
        bank.push("603070000090030010008600970000062000020103040000980000037006200050020030000090405yes")
        bank.push("070400900062050047000020000500103200200000009008209004000090000140030570003005090yes")
        bank.push("409700000260500040030008100000006400300000005007200000003800020090002013000007604yes")
        bankI = 0
        // - - - - - - - -- -
        /* board is displayed from document.theForm.squ[i].value:
           ssno converts 0-8, 9-16, etc position numbers to squ indexes
           00 01 02 09 10 11 18 19 20
           03 04 05 12 13 14 21 22 23
           06 07 08 15 16 17 24 25 26
           27 28 29 36 37 38 45 46 47
           30 31 32 39 40 41 48 49 50
           33 34 35 42 43 44 51 52 53
           54 55 56 63 64 65 72 73 74
           57 58 59 66 67 68 75 76 77
           60 61 62 69 70 71 78 79 80
           
        work[] is the actual data. note that work[] follows the same pattern.
        ssno[] uses a row by row sequence (row 1 = 0 - 9) and points to the work [] location */
        var isval = 0 // ssno squared = identity!
        var ssno = [0, 1, 2, 9, 10, 11, 18, 19, 20, 3, 4, 5, 12, 13, 14, 21, 22, 23, 6, 7, 8, 15, 16, 17, 24, 25, 26, 27, 28, 29, 36, 37, 38, 45, 46, 47, 30, 31, 32, 39, 40, 41, 48, 49, 50, 33, 34, 35, 42, 43, 44, 51, 52, 53, 54, 55, 56, 63, 64, 65, 72, 73, 74, 57, 58, 59, 66, 67, 68, 75, 76, 77, 60, 61, 62, 69, 70, 71, 78, 79, 80]
        var work = [] // 81 squares
        var savegame = []
        var wasChanged = true
        var alldone = false
        var moves = 0 // number of moves to make
        var listno = 0
        var list = [, , , , , , , , ]
        var donelist = [] // 27 list status
        var donesquare = [] // 81 square status 0=open, -1=error, 1=done
        var debug = false
        var skipeasy = true
        var blanklines = "\n\n\n\n\n\n\n\n\n"
        var grid = ''
        // ---------------------------------------------------
        function execute(evt) {
            var charCode = evt.keyCode
            if (charCode == 13) { // putout ("<"+charCode+":ENTER>\n");
                nextmove()
            }
        }
        // ---------------------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            code2str = String.fromCharCode(charCode)
            // putout ("<"+charCode+":"+code2str+">\n")
            if (code2str == "," || charCode == 92 || charCode == 27 || code2str == "." || code2str == "(" || code2str == "[" || code2str == "/") {
                document.theForm.b2.focus();
                return
            } // regex codes == comma
            if (charCode == 13) {
                col = isval % 9;
                row = (isval - col) / 9;
                row = (row + 1) % 9
                ishere(row * 9, false);
                return
            } // enter
            if (95 < charCode && charCode < 107) {
                charCode -= 48;
                code2str = String.fromCharCode(charCode)
            }
            if ("aAjJ".search(code2str) > -1) {
                ishere((isval + 80) % 81, false);
                return
            } // left
            if ("sSkK".search(code2str) > -1) {
                ishere((isval + 72) % 81, false);
                return
            } // up   S
            if ("dDlL".search(code2str) > -1) {
                ishere((isval + 1) % 81, false);
                return
            } // right D
            if ("zxcnmZXCNM".search(code2str) > -1) {
                ishere((isval + 9) % 81, false);
                return
            } // down  Z
            if ("aAjJ".search(code2str) > -1) {
                ishere((isval + 80) % 81, false);
                return
            } // left
            if (charCode > 48 && charCode < 58) {
                document.theForm.squ[ssno[isval]].value = code2str;
                ishere((isval + 1) % 81, true);
                return
            }
            if (charCode == 48 || charCode == 32) {
                document.theForm.squ[ssno[isval]].value = " ";
                ishere((isval + 1) % 81, true);
                return
            }
        }
        // ---------------------------------------------------
        function putout(msg) {
            document.theForm.output.style.backgroundColor = "white"
            var i = document.theForm.output.value.search("\\n") + 1
            document.theForm.output.value = document.theForm.output.value.slice(i) + document.theForm.odocount.value + ": " + msg
            if (document.theForm.input.value.length > 0)
                if (msg.indexOf(document.theForm.input.value) >= 0)
                    validate()
            document.theForm.odocount.value++
        }
        // ---------------------------------------------------
        function dodebug() {
            if (debug) {
                debug = false;
                document.theForm.b8.value = "Debug: OFF"
                document.theForm.b8.style.backgroundColor = ""
            } else {
                validate();
                debug = true;
                document.theForm.b8.value = "Debug: ON"
            }
        }
        // ---------------------------------------------------
        function doskipeasy() {
            if (skipeasy) {
                skipeasy = false;
                document.theForm.b9.value = "Skip Easy: OFF"
            } else {
                validate();
                skipeasy = true;
                document.theForm.b9.value = "skip easy is ON"
                document.theForm.b9.style.backgroundColor = ""
            }
        }
        // ---------------------------------------------------
        function newwork() // reset all
        {
            document.theForm.odocount.value = 0
            debug = false;
            document.theForm.b8.value = "Debug: OFF"
            document.theForm.b8.style.backgroundColor = ""
            document.theForm.output.value = ""
            for (i = 0; i < 81; i++) {
                document.theForm.squ[i].value = " ";
                work[i] = "123456789";
                donesquare[i] = 0
            }
            for (i = 0; i < 27; i++) {
                donelist[i] = false
            }
        }
        // ---------------------------------------------------
        function enterdata() //
        {
            newwork()
            document.theForm.output.value = "cursor = {ASDC} or {NJKL}"
            nextstep();
            ishere(0, false)
        }
        // ---------------------------------------------------
        function opengame() {
            newwork();
            document.theForm.output.value = blanklines
            if (savegame.length > 0) game = savegame.pop();
            else inputgame()
            for (i = 0; i < 81; i++) {
                if (game[i] != undefined) var x = game[i];
                else var x = " "
                if (x == 0) x = " "
                document.theForm.squ[ssno[i]].value = x
                if (x == " ") y = "123456789";
                else y = "" + x
                work[ssno[i]] = y
            }
        }
        // ---------------------------------------------------
        function loadcell() {
            lc = document.theForm.output1.value.replace(/\D+/g, ",").split(",")
            isval = lc[0]
            work[ssno[isval]] = lc[3];
            if (lc[3].length == 1) document.theForm.squ[ssno[isval]].value = lc[3]
            showwork(true)
        }
        // ---------------------------------------------------
        function loaddata() {
            gridio();
            if (grid.length == 81) return
            var xx3 = unescape(localStorage.getItem('jsdata'))
            xx4 = xx3.replace(/<sc>/g, ";").replace(/<br>/g, String.fromCharCode(10)).replace(/<nl>/g, String.fromCharCode(10)) //
            document.theForm.output.value = xx4
            gridio()
        }
        // ---------------------------------------------------
        function savedata() {
            var data = ''
            for (i = 0; i < 81; i++) {
                if (work[ssno[i]].length == 1) data += work[ssno[i]];
                else data += '0'
                if ((i + 1) % 9 == 0) data += '\n'
            }
            document.theForm.output.value = data
            val1 = escape(document.theForm.output.value.replace(/\n/g, "<br>").replace(/;/g, "<sc>"))
            localStorage.setItem('jsdata', val1)
        }
        // ---------------------------------------------------
        function gridio() {
            grid = document.theForm.output.value.replace(/\n/g, "") // put on on line
            grid1 = grid.slice(81) // stuff after column 81
            grid = grid.replace(/[^\d ]/g, "").replace(/ /g, "0").slice(0, 81)
            if (grid.length < 81) {
                document.theForm.output += "\ninput length is: " + grid.length;
                return
            }
            grid2 = grid // split into nine lines
            while (grid2.search(/\d{10}/) > -1) grid2 = grid2.replace(/(\d{9})(\d)/, "$1\n$2")
            newwork();
            document.theForm.output.value = grid2 + '\n' + grid1 + '\n'
            for (i = 0; i < 81; i++) {
                x = grid.charAt(i)
                document.theForm.squ[ssno[i]].value = x
                if (x == "0") y = "...";
                else y = "." + x + "."
                work[ssno[i]] = y
            }
            showwork(false, 5)
            for (i = 0; i < 81; i++) {
                x = grid.charAt(i);
                if (x == '0') x = " "
                document.theForm.squ[ssno[i]].value = x
                if (x == " ") y = "123456789";
                else y = "" + x
                work[ssno[i]] = y
            }
        }
        // ---------------------------------------------------
        function inputgame() {
            document.theForm.output.value = bank[bankI];
            bankI = (bankI + 1) % bank.length
            gridio()
        }
        // ---------------------------------------------------
        function savework() {
            for (i = 0; i < 81; i++) {
                if (work[i].length == 1) game[ssno[i]] = work[i];
                else game[ssno[i]] = 0
            }
            savegame[savegame.length] = game.slice(0)
            ishere(0, false)
        }
        // ---------------------------------------------------
        function union(i, j) {
            var u = i;
            if (typeof(i) != "string" || typeof(j) != "string")
                dummy = 9
            else {
                for (var k = 0; k < j.length; k++)
                    if (u.search(j.charAt(k)) == -1) u += j.charAt(k)
                return u
            }
        }
        // ---------------------------------------------------
        function minus(i, j) {
            var u;
            if (typeof(i) == "string") u = i;
            else u = " "
            for (var k = 0; k < j.length; k++) {
                var m = u.search(j.charAt(k))
                if (m >= 0) {
                    var savework1 = u
                    var savework2 = u.slice(0, m) + u.slice(m + 1)
                    u = savework2
                }
            }
            return u
        }
        // ---------------------------------------------------
        function nextlist(leavecolor) {
            if (!leavecolor) {
                nextstep();
                while (donelist[listno] && listno < 27) listno++
            }
            loadlist(listno);
            listno++
        }
        // ---------------------------------------------------
        function loadlist(listno) { // load ssno's into list[]
            if (listno < 9) // get row
            {
                for (var i = 0; i < 9; i++) list[i] = ssno[9 * listno + i]
            } else if (listno < 18) // get col
            {
                var col = listno - 9;
                for (var i = 0; i < 9; i++) list[i] = ssno[9 * i + col]
            } else // get block
            {
                var b = 9 * (listno - 18);
                for (var i = 0; i < 9; i++) list[i] = b + i
            }
        }
        // ---------------------------------------------------
        function nextstep() {
            alldone = true
            for (i = 0; i < 81; i++) {
                if (donesquare[i] == 1) document.theForm.squ[i].style.backgroundColor = "yellow"
                else if (donesquare[i] == -1) document.theForm.squ[i].style.backgroundColor = "deeppink"
                else {
                    alldone = false;
                    document.theForm.squ[i].style.backgroundColor = "white"
                }
            }
        }
        // ---------------------------------------------------
        function crossoff() {
            listno = 0;
            while (listno < 27) {
                nextlist(true);
                if (listno > 27) break;
                isdone = true
                for (var i = 0; i < 9; i++)
                    if (work[list[i]].length > 1) isdone = false
                if (isdone) {
                    donelist[listno - 1] = true
                    allnine = "";
                    for (i = 0; i < 9; i++) {
                        allnine += work[list[i]]
                    };
                    allok = true
                    for (i = 0; i < 9; i++)
                        if (donesquare[list[i]] != -1) {
                            var re = new RegExp(String.fromCharCode(49 + i), "g")
                            recnt = allnine.match(re);
                            if (recnt == null) allok = false;
                            else if (recnt != 1) allok = false
                            for (i = 0; i < 9; i++) donesquare[list[i]] = (allok ? 1 : -1)
                        }
                }
            }
        }
        // ---------------------------------------------------
        function clean() {
            do {
                wasChanged = false;
                clean0()
            } while (wasChanged)
            showwork(true)
        }
        // ---------------------------------------------------
        function nextmove() {
            nextstep();
            var anychange = false
            var numtowork = parseInt(document.theForm.autocount.value)
            if (isNaN(numtowork)) numtowork = 1
            if (numtowork < 1) numtowork = 1
            document.theForm.autocount.value = numtowork;
            moves = numtowork
            document.theForm.b2.focus()
            while (moves > 0 && !alldone) {
                wasChanged = false
                clean0();
                anychange = anychange || wasChanged;
                if (wasChanged) continue
                clean1();
                anychange = anychange || wasChanged;
                if (wasChanged) continue
                clean2();
                anychange = anychange || wasChanged;
                if (wasChanged) continue
                clean3();
                anychange = anychange || wasChanged;
                if (wasChanged) continue
                clean4();
                anychange = anychange || wasChanged;
                if (!anychange) break
            }
            if (!anychange) {
                putout("did not change\n")
            }
            validate()
        }
        // ---------------------------------------------------
        function clean0() // match 1
        {
            crossoff();
            listno = 0;
            while (listno < 27) {
                nextlist(false);
                if (listno > 27) break;
                isdone = true
                // u1 is list[i1] ( length == 1 )
                // k each of the remaining list items ( length != 1)
                // m is a match on u1 in item k - to be pulled out
                for (var i1 = 0; i1 < 9; i1++) {
                    var u1 = work[list[i1]]
                    if (u1.length == 1)
                        for (var k = 0; k < 9; k++) {
                            if (work[list[k]].length > 2) {
                                var m = work[list[k]].search(u1)
                                if (m >= 0) {
                                    clean1a(list[k], m, "match one", false)
                                    if (moves < 1 && skipeasy) moves = 1
                                    return
                                }
                            }
                        }
                }
            }
        }
        // ---------------------------------------------------
        function clean1() // force ( same as 8-match but more understandable to do it here? )
        {
            didany = true;
            while (didany) {
                didany = false;
                crossoff();
                listno = 0;
                while (listno < 27) {
                    nextlist(false);
                    if (listno > 27) break
                    allnine = "";
                    for (var i = 0; i < 9; i++) allnine += work[list[i]]
                    for (var i = 1; i < 10; i++) {
                        var re = new RegExp(String.fromCharCode(48 + i), "g")
                        recnt = allnine.match(re);
                        if (recnt == null) recnt = 0;
                        else recnt = recnt.length
                        if (recnt == 1) {
                            for (j = 0; j < 9; j++) {
                                if ((work[list[j]].length > 1) && (work[list[j]].search(re) > -1)) {
                                    if (moves < 2 && !skipeasy) showwork(true, 7);
                                    savework1 = work[list[j]]
                                    work[list[j]] = "" + i;
                                    document.theForm.squ[list[j]].value = work[list[j]]
                                    if (moves < 2) {
                                        for (var k = 0; k < 9; k++) {
                                            document.theForm.squ[list[k]]
                                        }
                                        document.theForm.squ[list[j]]
                                    }
                                    col = ssno[list[j]] % 9;
                                    row = (ssno[list[j]] - col) / 9
                                    putout("forced (" + (row + 1) + ", " + (col + 1) + "): " + savework1 + ">" + work[list[j]] + "\n")
                                    wasChanged = true;
                                    moves--;
                                    if (moves < 1 && skipeasy) moves = 1
                                    return
                                }
                            }
                        }
                    }
                }
            }
        }
        // ---------------------------------------------------
        function clean2() // match n-groups ( n = 1..7 )
        {
            crossoff();
            listno = 0;
            while (listno < 27) {
                nextlist(false);
                if (listno > 27) break;
                isdone = true
                // v1 = list of items from list[i1...] combining into u1
                // if the length of u1 = n then
                // k each of the remaining list items
                // j each of the digits in u1
                // m is a match on digit j in item k - to be pulled out
                for (var i1 = 0; i1 < 9; i1++) {
                    var v1 = "," + i1;
                    var u1 = work[list[i1]]
                    if (u1.length == 1)
                        for (var k = 0; k < 9; k++) {
                            if (work[list[k]].length > 1) {
                                var m = work[list[k]].search(u1)
                                if (m >= 0) {
                                    clean1a(list[k], m, "single match", false);
                                    return
                                }
                            }
                        }
                    for (var i2 = i1 + 1; i2 < 9; i2++)
                        if (work[list[i2]].length > 1) {
                            var v2 = v1 + "," + i2;
                            var u2 = union(u1, work[list[i2]])
                            if (u2.length == 2)
                                for (var k = 0; k < 9; k++) {
                                    if (v2.search("," + k) == -1 && work[list[k]].length > 1)
                                        for (j = 0; j < u2.length; j++) {
                                            var m = work[list[k]].search(u2.charAt(j))
                                            if (m >= 0) {
                                                clean1a(list[k], m, "double match", false);
                                                return
                                            }
                                        }
                                }
                            for (var i3 = i2 + 1; i3 < 9; i3++)
                                if (work[list[i3]].length > 1) {
                                    var v3 = v2 + "," + i3;
                                    var u3 = union(u2, work[list[i3]])
                                    if (u3.length == 3)
                                        for (var k = 0; k < 9; k++) {
                                            if (v3.search("," + k) == -1 && work[list[k]].length > 1)
                                                for (j = 0; j < u3.length; j++) {
                                                    var m = work[list[k]].search(u3.charAt(j))
                                                    if (m >= 0) {
                                                        clean1a(list[k], m, "triple match", false);
                                                        return
                                                    }
                                                }
                                        }
                                    for (var i4 = i3 + 1; i4 < 9; i4++)
                                        if (work[list[i4]].length > 1) {
                                            var v4 = v3 + "," + i4;
                                            var u4 = union(u3, work[list[i4]])
                                            if (u4.length == 4)
                                                for (var k = 0; k < 9; k++) {
                                                    if (v4.search("," + k) == -1 && work[list[k]].length > 1)
                                                        for (j = 0; j < u4.length; j++) {
                                                            var m = work[list[k]].search(u4.charAt(j))
                                                            if (m >= 0) {
                                                                clean1a(list[k], m, "quad match", true);
                                                                return
                                                            }
                                                        }
                                                }
                                            for (var i5 = i4 + 1; i5 < 9; i5++)
                                                if (work[list[i5]].length > 1) {
                                                    var v5 = v4 + "," + i5;
                                                    var u5 = union(u4, work[list[i5]])
                                                    if (u5.length == 5)
                                                        for (var k = 0; k < 9; k++) {
                                                            if (v5.search("," + k) == -1 && work[list[k]].length > 1)
                                                                for (j = 0; j < u5.length; j++) {
                                                                    var m = work[list[k]].search(u5.charAt(j))
                                                                    if (m >= 0) {
                                                                        clean1a(list[k], m, "5-match", true);
                                                                        return
                                                                    }
                                                                }
                                                        }
                                                    for (var i6 = i5 + 1; i6 < 9; i6++)
                                                        if (work[list[i6]].length > 1) {
                                                            var v6 = v5 + "," + i6;
                                                            var u6 = union(u5, work[list[i6]])
                                                            if (u6.length == 6)
                                                                for (var k = 0; k < 9; k++) {
                                                                    if (v6.search("," + k) == -1 && work[list[k]].length > 1)
                                                                        for (j = 0; j < u6.length; j++) {
                                                                            var m = work[list[k]].search(u6.charAt(j))
                                                                            if (m >= 0) {
                                                                                clean1a(list[k], m, "6-match", true);
                                                                                return
                                                                            }
                                                                        }
                                                                }
                                                            for (var i7 = i6 + 1; i7 < 9; i7++)
                                                                if (work[list[i7]].length > 1) {
                                                                    var v7 = v6 + "," + i7;
                                                                    var u7 = union(u6, work[list[i7]])
                                                                    if (u7.length == 7)
                                                                        for (var k = 0; k < 9; k++) {
                                                                            if (v7.search("," + k) == -1 && work[list[k]].length > 1)
                                                                                for (j = 0; j < u7.length; j++) {
                                                                                    var m = work[list[k]].search(u7.charAt(j))
                                                                                    if (m >= 0) {
                                                                                        clean1a(list[k], m, "7-match", true);
                                                                                        return
                                                                                    }
                                                                                }
                                                                        }
                                                                }
                                                        }
                                                }
                                        }
                                }
                        }
                }
            }
        }
        // ---------------------------------------------------
        function clean1a(k, m, msg, hard) // remove match in k at m
        {
            if (work[k].length == 1) return
            var savework1 = work[k]
            var savework2 = work[k].slice(0, m) + work[k].slice(m + 1)
            if (!skipeasy || hard || debug || savework2.length == 1)
                if (msg != "match one") {
                    if (moves < 2) {
                        showwork(true, 8)
                        for (var i = 0; i < 9; i++) {
                            document.theForm.squ[list[i]].style.backgroundColor = "#00ffff"
                        }
                        document.theForm.squ[k].style.backgroundColor = "#33ff33"
                    }
                    var col = ssno[k] % 9;
                    var row = (ssno[k] - col) / 9
                    putout(msg + " (" + (row + 1) + "," + (col + 1) + "): " + savework1 + ">" + savework2 + "\n")
                    moves--;
                }
            if (savework2.length == 1) document.theForm.squ[k].value = savework2
            work[k] = savework2;
            wasChanged = true;
            if (hard) moves--;
        }
        // ---------------------------------------------------
        function clean3() // square force
        {
            crossoff();
            listno = 18;
            var row = 0,
                col = 0,
                isec = "",
                A = "",
                B = "",
                C = ""
            while (listno < 27) {
                nextlist(false);
                if (listno > 27) break // 9 blocks
                showwork(true, 9)
                col = ssno[list[0]] % 9;
                row = (ssno[list[0]] - col) / 9
                // A = intersection,  B = square block, C = line
                // first look at all the rows in the block
                for (i = 0; i < 9; i += 3) {
                    A = "";
                    for (j = 0; j < 3; j++) A = union(A, work[list[i + j]])
                    B = "";
                    for (i1 = 0; i1 < 9; i1 += 3)
                        if (i1 != i)
                            for (j = 0; j < 3; j++) B = union(B, work[list[i1 + j]])
                    C = "";
                    for (i1 = 0; i1 < 9; i1 += 3)
                        if (i1 != col)
                            for (j = 0; j < 3; j++) C = union(C, work[ssno[9 * (row + i / 3) + i1 + j]])
                    D = minus(A, B);
                    if (D.length > 0) {
                        for (i1 = 0; i1 < 9; i1 += 3)
                            if (i1 != col)
                                for (j = 0; j < 3; j++) {
                                    savework1 = work[ssno[9 * (row + i / 3) + i1 + j]];
                                    savework2 = minus(savework1, D)
                                    if (savework1 != savework2) {
                                        wasChanged = true
                                        work[ssno[9 * (row + i / 3) + i1 + j]] = savework2
                                        if (savework2.length == 1) {
                                            document.theForm.squ[ssno[9 * (row + i / 3) + i1 + j]].value = savework2
                                        }
                                    }
                                }
                    }
                    D1 = minus(A, C);
                    if (D1.length > 0) {
                        for (i1 = 0; i1 < 9; i1 += 3)
                            if (i1 != i)
                                for (j = 0; j < 3; j++) {
                                    savework1 = work[list[i1 + j]]
                                    savework2 = minus(savework1, D1)
                                    if (savework1 != savework2) {
                                        wasChanged = true
                                        work[list[i1 + j]] = savework2
                                        if (savework2.length == 1) {
                                            document.theForm.squ[list[i1 + j]].value = savework2
                                        }
                                    }
                                }
                    }
                    if (wasChanged) {
                        if (moves < 2) {
                            for (var i1 = 0; i1 < 9; i1++) {
                                document.theForm.squ[list[i1]].style.backgroundColor = "#00ffff"
                            }
                            for (var i1 = 0; i1 < 9; i1++) {
                                document.theForm.squ[ssno[9 * (row + i / 3) + i1]].style.backgroundColor = "#00ffff"
                            }
                        }
                        putout("square (" + (row + 1) + "," + (col + 1) + ") Sq-" + D1 + "/ -" + D + "\n")
                        moves--;
                        return
                    }
                }
                // then look at all the columns in the block
                for (i = 0; i < 3; i++) {
                    A = "";
                    for (j = 0; j < 9; j += 3) A = union(A, work[list[i + j]])
                    B = "";
                    for (i1 = 0; i1 < 3; i1++)
                        if (i1 != i)
                            for (j = 0; j < 9; j += 3) B = union(B, work[list[i1 + j]])
                    C = "";
                    for (i1 = 0; i1 < 9; i1 += 3)
                        if (i1 != row)
                            for (j = 0; j < 3; j++) C = union(C, work[ssno[9 * (i1 + j) + col + i]])
                    D = minus(A, B);
                    if (D.length > 0) {
                        for (i1 = 0; i1 < 9; i1 += 3)
                            if (i1 != row)
                                for (j = 0; j < 3; j++) {
                                    savework1 = work[ssno[9 * (i1 + j) + col + i]]
                                    savework2 = minus(savework1, D)
                                    if (savework1 != savework2) {
                                        wasChanged = true
                                        work[ssno[9 * (i1 + j) + col + i]] = savework2
                                        if (savework2.length == 1) {
                                            document.theForm.squ[ssno[9 * (i1 + j) + col + i]].value = savework2
                                        }
                                    }
                                }
                    }
                    D1 = minus(A, C);
                    if (D1.length > 0) {
                        for (i1 = 0; i1 < 3; i1++)
                            if (i1 != i)
                                for (j = 0; j < 9; j += 3) {
                                    savework1 = work[list[i1 + j]]
                                    savework2 = minus(savework1, D1)
                                    if (savework1 != savework2) {
                                        wasChanged = true
                                        work[list[i1 + j]] = savework2
                                        if (savework2.length == 1) {
                                            document.theForm.squ[list[i1 + j]].value = savework2
                                        }
                                    }
                                }
                    }
                    if (wasChanged) {
                        if (moves < 2) {
                            for (var i1 = 0; i1 < 9; i1++) {
                                document.theForm.squ[list[i1]].style.backgroundColor = "#00ffff"
                            }
                            for (var i1 = 0; i1 < 9; i1++) {
                                document.theForm.squ[ssno[9 * i1 + col + i]].style.backgroundColor = "#00ffff"
                            }
                        }
                        putout("square (" + (row + 1) + "," + (col + 1) + ") Sq-" + D1 + "/ -" + D + "\n")
                        moves--;
                        return
                    }
                }
            }
        }
        // ---------------------------------------------------
        function clean4() { // x-wing
            /* i1 = # we are looking for ( 1 - 9 )
               found[] = array of what columns had i1 found in each row (0-8)
               i2 = row we are looking at (0≤i2≤8)
               i3 = 2nd row we are looking (0≤i3≤8)
               i4 = position of first occurence
               i5 = position of second occurrence
            */
            // horizontal x-wings
            for (i1 = 1; i1 < 10; i1++) {
                // variables i2 and i3 are only used locally to load the found array with the locations in each row that contain i1
                found = [];
                for (i2 = 0; i2 < 9; i2++) { // rows 1 thru 9
                    loadlist(i2);
                    found.push("")
                    for (i3 = 0; i3 < 9; i3++)
                        if (work[list[i3]].search("" + i1) > -1) found[i2] += i3
                }
                // see whether there are two rows that contain i1 in the same two locations
                for (i2 = 0; i2 < 8; i2++)
                    if (found[i2].length == 2) {
                        for (i3 = i2 + 1; i3 < 9; i3++)
                            if (found[i2] == found[i3]) {
                                i4 = found[i2][0];
                                i5 = found[i2][1]
                                for (i6 = 0; i6 < 9; i6++)
                                    if ((i6 != i2) && (i6 != i3))
                                        if ((found[i6].search(i4) >= 0) || (found[i6].search(i5) >= 0)) {
                                            // print (found); print ('x-wing: ',i1,' in ',i2,' and ',i3,' also matches ',i6,'position',i4,i5,'( 0-8 )')
                                            w3 = new RegExp('[' + i1 + ']', 'g')

                                            document.theForm.squ[ssno[i2 * 9 + Number(i4)]].style.backgroundColor = "#00ffff"
                                            document.theForm.squ[ssno[i2 * 9 + Number(i5)]].style.backgroundColor = "#00ffff"
                                            document.theForm.squ[ssno[i3 * 9 + Number(i4)]].style.backgroundColor = "#00ffff"
                                            document.theForm.squ[ssno[i3 * 9 + Number(i5)]].style.backgroundColor = "#00ffff"
                                            showwork(true);

                                            w1 = ssno[i6 * 9 + Number(i4)];
                                            w2 = work[w1];
                                            work[w1] = w2.replace(w3, '');
                                            if (w2 != work[w1]) {
                                                wasChanged = true;
                                                moves--;
                                                if (work[w1].length == 1) document.theForm.squ[w1].value = work[w1]
                                                putout("horizontal X-wing (" + (i6 * 9 + 1) + "," + (Number(i4) + 1) + "): " + w2 + ">" + work[w1] + "\n")
                                            }
                                            w1 = ssno[i6 * 9 + Number(i5)];
                                            w2 = work[w1];
                                            work[w1] = w2.replace(w3, '');
                                            if (w2 != work[w1]) {
                                                wasChanged = true;
                                                moves--;
                                                if (work[w1].length == 1) document.theForm.squ[w1].value = work[w1]
                                                putout("horizontal X-wing (" + (i6 * 9 + 1) + "," + (Number(i5) + 1) + "): " + w2 + ">" + work[w1] + "\n")
                                            }
                                            return
                                        }
                            }
                    }
            }
            // vertical x-wings
            for (i1 = 1; i1 < 10; i1++) {
                // variables i2 and i3 are only used locally to load the found array with the locations in each column that contain i1
                found = [];
                for (i2 = 9; i2 < 18; i2++) { // cols 1 thru 9
                    loadlist(i2);
                    found.push("")
                    for (i3 = 0; i3 < 9; i3++)
                        if (work[list[i3]].search("" + i1) > -1) found[i2 - 9] += i3
                }
                // see whether there are two columns that contain i1 in the same two locations
                for (i2 = 0; i2 < 8; i2++)
                    if (found[i2].length == 2) {
                        for (i3 = i2 + 1; i3 < 9; i3++)
                            if (found[i2] == found[i3]) {
                                i4 = found[i2][0];
                                i5 = found[i2][1]
                                for (i6 = 0; i6 < 9; i6++)
                                    if ((i6 != i2) && (i6 != i3))
                                        if ((found[i6].search(i4) >= 0) || (found[i6].search(i5) >= 0)) {
                                            w3 = new RegExp('[' + i1 + ']', 'g')

                                            document.theForm.squ[ssno[i4 * 9 + Number(i2)]].style.backgroundColor = "#00ffff"
                                            document.theForm.squ[ssno[i4 * 9 + Number(i3)]].style.backgroundColor = "#00ffff"
                                            document.theForm.squ[ssno[i5 * 9 + Number(i2)]].style.backgroundColor = "#00ffff"
                                            document.theForm.squ[ssno[i5 * 9 + Number(i3)]].style.backgroundColor = "#00ffff"
                                            showwork(true);

                                            w1 = ssno[i4 * 9 + i6];
                                            w2 = work[w1];
                                            work[w1] = w2.replace(w3, '');
                                            if (w2 != work[w1]) {
                                                wasChanged = true;
                                                moves--;
                                                if (work[w1].length == 1) document.theForm.squ[w1].value = work[w1]
                                                putout("vertical X-wing (" + (i4 * 9 + 1) + "," + (i6 + 1) + "): " + w2 + ">" + work[w1] + "\n")
                                            }
                                            w1 = ssno[i5 * 9 + i6];
                                            w2 = work[w1];
                                            work[w1] = w2.replace(w3, '');
                                            if (w2 != work[w1]) {
                                                wasChanged = true;
                                                moves--;
                                                if (work[w1].length == 1) document.theForm.squ[w1].value = work[w1]
                                                putout("vertical X-wing (" + (i5 * 9 + 1) + "," + (i6 + 1) + "): " + w2 + ">" + work[w1] + "\n")
                                            }
                                            return
                                        }
                            }
                    }
            }
        }
        // ---------------------------------------------------
        function dodigit(x) {
            showwork(false, 10);
            if (x == 0) {
                document.theForm.squ[ssno[isval]].value = " "
                ishere((isval + 1) % 81, true);
                return
            }
            document.theForm.squ[ssno[isval]].value = x
            ishere((isval + 1) % 81, false)
            while (work[ssno[isval]].length == 1 && isval > 0) ishere((isval + 1) % 81, false)
        }
        // ---------------------------------------------------
        function ishere(x, updated) // if updated then replace work[isval]; move to location x
        {
            if (updated) {
                showwork(false, 11)
                xval = document.theForm.squ[ssno[isval]].value;
                var r = Math.floor(isval / 9);
                var c = isval - 9 * r
                if (xval == " ") {
                    work[ssno[isval]] = "123456789"
                } else {
                    for (i = 1; i < 9; i++) {
                        if (work[ssno[9 * r + (c + i) % 9]] == xval) {
                            document.theForm.squ[ssno[isval]].style.backgroundColor = "deeppink"
                            document.theForm.squ[ssno[isval]].value = " ";
                            work[ssno[isval]] = "123456789";
                            return
                        }
                        if (work[ssno[c + (9 * (r + i)) % 81]] == xval) {
                            document.theForm.squ[ssno[isval]].style.backgroundColor = "deeppink"
                            document.theForm.squ[ssno[isval]].value = " ";
                            work[ssno[isval]] = "123456789";
                            return
                        }
                    }
                    r1 = 3 * Math.floor(r / 3);
                    c1 = 3 * Math.floor(c / 3)
                    for (r2 = 0; r2 < 3; r2++)
                        for (c2 = 0; c2 < 3; c2++) {
                            r3 = r1 + r2;
                            c3 = c1 + c2;
                            if (r != r3 || c != c3) {
                                if (work[ssno[c3 + 9 * r3]] == xval) {
                                    document.theForm.squ[ssno[isval]].style.backgroundColor = "deeppink"
                                    document.theForm.squ[ssno[isval]].value = " ";
                                    work[ssno[isval]] = "123456789";
                                    return
                                }
                            }
                        }
                    work[ssno[isval]] = "" + xval
                }
            }
            document.theForm.squ[ssno[isval]].style.backgroundColor = "white"
            document.theForm.output.style.backgroundColor = "white"
            // validate()
            isval = x
            document.theForm.squ[ssno[isval]].style.backgroundColor = "lightgreen"
            showwork(false, 12);
            col = isval % 9;
            row = (isval - col) / 9
            document.theForm.output1.value = isval + ": ( " + (row + 1) + " ," + (col + 1) + " ) " + work[ssno[isval]]
            showwork(false, 13)
            document.theForm.squ[ssno[isval]].focus()
        }
        // ---------------------------------------------------
        function showwork(not, fromwhere) {
            if (!not) return
            var watchwindow = window.open('', "watch", "width=900,height=340")

            watchwindow.document.write('<html><head><title>Sudoku Worksheet</title></head>')
            watchwindow.document.write('<body bgcolor="white">')
            watchwindow.document.write('<table border = 1 noshade  bgcolor = 99CC66>')
            for (var r = 0; r < 81; r += 9) {
                watchwindow.document.write('<tr>')
                for (var c = 0; c < 9; c++) {
                    watchwindow.document.write('<td style="border:none;">', work[ssno[r + c]], '</td>');
                    if (c == 2 || c == 5) watchwindow.document.write('<td bgcolor=white> </td>')
                }
                watchwindow.document.write('</tr>')
                if (r == 18 || r == 45) watchwindow.document.write('<tr><td bgcolor=white> </td><td bgcolor=white> </td><td bgcolor=white> </td><td bgcolor=white> </td><td bgcolor=white> </td><td bgcolor=white> </td><td bgcolor=white> </td><td bgcolor=white> </td><td bgcolor=white> </td><td bgcolor=white> </td><td bgcolor=white> </td></tr>')
            }
            watchwindow.document.write('</body>')
            watchwindow.document.close();
            self.focus()
        }
        // ---------------------------------------------------
        function validate() {
            for (var i = 0; i < 81; i++)
                if (donesquare[i] < 0) donesquare[i] = 0
            listno = 0;
            while (listno < 27) {
                nextlist(true);
                if (listno > 27) break
                allnine = "";
                for (i = 0; i < 9; i++) allnine += work[list[i]]
                for (i = 1; i < 10; i++) {
                    var re = new RegExp(String.fromCharCode(48 + i), "g")
                    recnt = allnine.match(re);
                    if (recnt == null) recnt = 0;
                    else recnt = recnt.length
                    if (recnt == 0) {
                        for (var i = 0; i < 9; i++) {
                            donesquare[list[i]] = -1
                        }
                        nextstep();
                        return
                    }
                }
            }
            showwork(true);
            return
        }
    </script>
    <style type="text/css">
        input.a {
            background-color: white;
            width: 25;
            height: 22
        }
    </style>
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body onLoad="self.focus();inputgame();savework();document.theForm.b4.focus()">
    <?php include('nav.html'); ?>
    <div class="widecalcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <h1>Sudoku</h1>
        <p>
            <form name="theForm">
                <div class="button3row">
                    <div class="button1">
                        <input type="button" name="b4" onClick="newwork()" value="clear"></div>
                    <div class="button2"><input type="button" name="b7" onClick="enterdata()" value="enter"></div>
                    <div class="button3"><input type="button" name="b5" onClick="savework()" value="save">
                    </div>
                </div>

                <div class="button3row">
                    <div class="button1">
                        <input type="button" name="b1" onClick="opengame()" value="re-load"></div>
                    <div class="button2"><input type="button" name="b6" onClick="inputgame()" value="next game">
                    </div>
                    <div class="button3"><input type="button" name="b3" onClick="clean()" value="show work"></div>
                </div>
                <h2></h2>
                <table style="border:none;">
                    <tr>
                        <td style="border:none;">
                            <table style="border:none;">
                                <tr>
                                    <td style="border:none;">
                                        <table style="border:none;">
                                            <tr>
                                                <td style="border:none;">
                                                    <!-- style="background-color:lightgreen;width:25;height:22" -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(0)" onKeyUp="enter(event)"><!-- 0 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(1)" onKeyUp="enter(event)"><!-- 1 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(2)" onKeyUp="enter(event)"><br><!-- 2 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(9)" onKeyUp="enter(event)"><!-- 9 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(10)" onKeyUp="enter(event)"><!-- 10 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(11)" onKeyUp="enter(event)"><br><!-- 11 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(18)" onKeyUp="enter(event)"><!-- 18 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(19)" onKeyUp="enter(event)"><!-- 19 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(20)" onKeyUp="enter(event)"></td>
                                            </tr><!-- 20 -->
                                        </table>
                                    </td>
                                    <td style="border:none;">
                                        <table style="border:none;">
                                            <tr>
                                                <td style="border:none;">
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(3)" onKeyUp="enter(event)"><!-- 3 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(4)" onKeyUp="enter(event)"><!-- 4 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(5)" onKeyUp="enter(event)"><br><!-- 5 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(12)" onKeyUp="enter(event)"><!-- 12 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(13)" onKeyUp="enter(event)"><!-- 13 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(14)" onKeyUp="enter(event)"><br><!-- 14 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(21)" onKeyUp="enter(event)"><!-- 21 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(22)" onKeyUp="enter(event)"><!-- 22 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(23)" onKeyUp="enter(event)"></td>
                                            </tr><!-- 23 -->
                                        </table>
                                    </td>
                                    <td style="border:none;">
                                        <table style="border:none;">
                                            <tr>
                                                <td style="border:none;">
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(6)" onKeyUp="enter(event)"><!-- 6 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(7)" onKeyUp="enter(event)"><!-- 7 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(8)" onKeyUp="enter(event)"><br><!-- 8 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(15)" onKeyUp="enter(event)"><!-- 15 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(16)" onKeyUp="enter(event)"><!-- 16 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(17)" onKeyUp="enter(event)"><br><!-- 17 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(24)" onKeyUp="enter(event)"><!-- 24 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(25)" onKeyUp="enter(event)"><!-- 25 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(26)" onKeyUp="enter(event)"></td>
                                            </tr><!-- 26 -->
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:none;">
                                        <table style="border:none;">
                                            <tr>
                                                <td style="border:none;">
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(27)" onKeyUp="enter(event)"><!-- 27 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(28)" onKeyUp="enter(event)"><!-- 28 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(29)" onKeyUp="enter(event)"><br><!-- 29 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(36)" onKeyUp="enter(event)"><!-- 36 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(37)" onKeyUp="enter(event)"><!-- 37 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(38)" onKeyUp="enter(event)"><br><!-- 38 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(45)" onKeyUp="enter(event)"><!-- 45 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(46)" onKeyUp="enter(event)"><!-- 46 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(47)" onKeyUp="enter(event)"></td>
                                            </tr><!-- 47 -->
                                        </table>
                                    </td>
                                    <td style="border:none;">
                                        <table style="border:none;">
                                            <tr>
                                                <td style="border:none;">
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(30)" onKeyUp="enter(event)"><!-- 30 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(31)" onKeyUp="enter(event)"><!-- 31 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(32)" onKeyUp="enter(event)"><br><!-- 32 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(39)" onKeyUp="enter(event)"><!-- 39 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(40)" onKeyUp="enter(event)"><!-- 40 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(41)" onKeyUp="enter(event)"><br><!-- 41 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(48)" onKeyUp="enter(event)"><!-- 48 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(49)" onKeyUp="enter(event)"><!-- 49 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(50)" onKeyUp="enter(event)"></td>
                                            </tr><!-- 50 -->
                                        </table>
                                    </td>
                                    <td style="border:none;">
                                        <table style="border:none;">
                                            <tr>
                                                <td style="border:none;">
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(33)" onKeyUp="enter(event)"><!-- 33 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(34)" onKeyUp="enter(event)"><!-- 34 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(35)" onKeyUp="enter(event)"><br><!-- 35 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(42)" onKeyUp="enter(event)"><!-- 42 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(43)" onKeyUp="enter(event)"><!-- 43 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(44)" onKeyUp="enter(event)"><br><!-- 44 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(51)" onKeyUp="enter(event)"><!-- 51 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(52)" onKeyUp="enter(event)"><!-- 52 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(53)" onKeyUp="enter(event)"></td>
                                            </tr><!-- 53 -->
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border:none;">
                                        <table style="border:none;">
                                            <tr>
                                                <td style="border:none;">
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(54)" onKeyUp="enter(event)"><!-- 54 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(55)" onKeyUp="enter(event)"><!-- 55 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(56)" onKeyUp="enter(event)"><br><!-- 56 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(63)" onKeyUp="enter(event)"><!-- 63 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(64)" onKeyUp="enter(event)"><!-- 64 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(65)" onKeyUp="enter(event)"><br><!-- 65 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(72)" onKeyUp="enter(event)"><!-- 72 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(73)" onKeyUp="enter(event)"><!-- 73 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(74)" onKeyUp="enter(event)"></td>
                                            </tr><!-- 74 -->
                                        </table>
                                    </td>
                                    <td style="border:none;">
                                        <table style="border:none;">
                                            <tr>
                                                <td style="border:none;">
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(57)" onKeyUp="enter(event)"><!-- 57 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(58)" onKeyUp="enter(event)"><!-- 58 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(59)" onKeyUp="enter(event)"><br><!-- 59 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(66)" onKeyUp="enter(event)"><!-- 66 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(67)" onKeyUp="enter(event)"><!-- 67 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(68)" onKeyUp="enter(event)"><br><!-- 68 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(75)" onKeyUp="enter(event)"><!-- 75 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(76)" onKeyUp="enter(event)"><!-- 76 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(77)" onKeyUp="enter(event)"></td>
                                            </tr><!-- 77 -->
                                        </table>
                                    </td>
                                    <td style="border:none;">
                                        <table style="border:none;">
                                            <tr>
                                                <td style="border:none;"><input class="a" type="button" name="squ" value=" " onClick="ishere(60)" onKeyUp="enter(event)"><!-- 60 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(61)" onKeyUp="enter(event)"><!-- 61 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(62)" onKeyUp="enter(event)"><br><!-- 62 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(69)" onKeyUp="enter(event)"><!-- 69 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(70)" onKeyUp="enter(event)"><!-- 70 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(71)" onKeyUp="enter(event)"><br><!-- 71 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(78)" onKeyUp="enter(event)"><!-- 78 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(79)" onKeyUp="enter(event)"><!-- 79 -->
                                                    <input class="a" type="button" name="squ" value=" " onClick="ishere(80)" onKeyUp="enter(event)"></td>
                                            </tr><!-- 80 -->
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td style="border:none;">
                            <input class="a" type="button" name="digit" value="X" onClick="dodigit(0)"><br>
                            <input class="a" type="button" name="digit" value="1" onClick="dodigit(1)"><br>
                            <input class="a" type="button" name="digit" value="2" onClick="dodigit(2)"><br>
                            <input class="a" type="button" name="digit" value="3" onClick="dodigit(3)"><br>
                            <input class="a" type="button" name="digit" value="4" onClick="dodigit(4)"><br>
                            <input class="a" type="button" name="digit" value="5" onClick="dodigit(5)"><br>
                            <input class="a" type="button" name="digit" value="6" onClick="dodigit(6)"><br>
                            <input class="a" type="button" name="digit" value="7" onClick="dodigit(7)"><br>
                            <input class="a" type="button" name="digit" value="8" onClick="dodigit(8)"><br>
                            <input class="a" type="button" name="digit" value="9" onClick="dodigit(9)"><br>
                        </td>
                    </tr>
                </table>



                <!-- <input type="button" name="b7" onClick="gridio()" value="grid I/O">-->



                <div class="button2row">
                    <div class="button1"><label>Total:</label></div>
                    <div class="button2"><input type="text" name="odocount" size=3 value="0"></div>

                </div>
                <div class="button2row">
                    <div class="button1"><label><input type="button" name="b2" onClick="nextmove()" value="move:"></label></div>
                    <div class="button2"><input type="text" name="autocount" size=3 value="1" onKeyUp="execute(event)"></div>
                </div>

                <div class="button2row">
                    <div class="button1"><label><input type="button" name="b12" onClick="loadcell()" value="replace"></label></div>
                    <div class="button2"><input type="text" name="output1">
                    </div>
                </div>


                <br>
                <br>
                <br>
                <h2>Output</h2>
                <textarea name="output" rows=15 cols=82></textarea>
                <div class="button3row">

                    <div class="button1">
                        <input type="button" name="b7" onClick="loaddata()" value="load"></div>
                    <div class="button2"><input type="button" name="b11" onClick="savedata()" value="save"></div>
                </div>
                <div class="button3row">
                    <div class="button1"><input type="button" name="b8" onClick="dodebug()" value="Debug: OFF"></div>
                    <div class="button2"><input type="button" name="b9" onClick="doskipeasy()" value="Skip Easy: ON"></div>
                </div>
                <br>
                <br>
                <br>
                <h2>Input</h2><textarea name="input" rows=5 cols=82></textarea>
            </form>
            OMG, look at this guy: <a href="http://www.sudokuwiki.org/sudoku.htm">http://www.sudokuwiki.org/sudoku.htm</a>
    </div>
</body>

</html>