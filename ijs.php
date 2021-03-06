<!DOCTYPE html>
<html lang="en">

<head>
    <title>Interactive J/S Console</title>
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <script src="myfunctions.js"></script>
    <script src="matrix.js"></script>
    <script src="statfns.js"></script>
    <script>
        $_stack = ['run()', 'cls()'];
        $_stackI = 2 // scroll on edit
        $_input = [];
        $_inputI = 0 // next input number on reprocess
        $_random = [];
        $_randomI = 0 // stack for random calls
        $_old = '';
        $_work = '';
        $_new = '' // input.value = $_old +' >>>' + $_work + '---\n' + $_new
        $_mode = 0;
        $_modes = ['Command', 'Scroll', 'Edit', 'Input']
        $_screen = '';
        $_hidden = ""
        // ---------------------------------------------------*/ }
        function load() { // read input into virtual screen
            var $_w = ($_hidden + document.theForm.input.value).replace(/(\s*\n)+$/, '')
            var i = $_w.lastIndexOf('>>>')
            if (i < 0) $_old = ''
            else {
                $_old = $_w.slice(0, i);
                $_w = $_w.slice(i + 3)
            }
            i = $_w.lastIndexOf('---\n')
            if (i < 0) $_new = '';
            else {
                $_new = $_w.slice(i);
                $_w = $_w.slice(0, i)
            }
            $_work = $_w
            $_screen = $_old + '>>>' + $_w + $_new + ($_new.length == 0 ? '' : '\n')
        }
        // ---------------------------------------------------*/
        function pause() {
            print('got to the pause')
            return
        }
        // ---------------------------------------------------*/
        function print(x) {
            if ($_mode != 3) {
                var $_xx = Array.prototype.slice.call(arguments)
                $_screen += Print($_xx)
            }
        }
        // ---------------------------------------------------*/
        function vprint(xxx_xxx) {
            if ($_mode == 3) return
            var $_xx = Array.prototype.slice.call(arguments)
            var $_xxx = $_screen
            for (var i = 0; i < $_xx.length; i++) {
                if (i > 0 && (i < $_xx.length - 1 || $_xx[i] != '' || typeof($_xx[i]) != 'string')) $_xxx = $_xxx + ', '
                if (!(i == $_xx.length - 1 && $_xx[i] == ' ')) $_xxx += $_xx[i]
                if (typeof($_xx[i]) == 'string') {
                    $_xxxx = eval($_xx[i])
                    if (typeof($_xxxx) == 'string') $_xxx += " = '" + $_xxxx + "'"
                    else $_xxx += " = " + $_xxxx
                }
            }
            if ('' + $_xx[i - 1] != '' && '' + $_xx[i - 1] != ' ' && ($_xx[0] + '').slice(0, 3) != '>>>' && $_xxx.slice(-2) != '? ') $_xxx = $_xxx.replace(/[\n\s]*$/, '\n')
            $_screen = $_xxx
            return
        }
        // ---------------------------------------------------*/
        function mprint(x, mrval) {
            if ($_mode == 3) return
            var $_xxx = $_screen
            for (var i = 0; i < x.length; i++) {
                $_xxx += '\n' + myround(x[i][0], mrval)
                for (var j = 1; j < x[i].length; j++) $_xxx += ',' + myround(x[i][j], mrval)
            }
            document.theForm.input.value = $_xxx
            $_screen = $_xxx
            return
        }
        // ---------------------------------------------------*/
        function show() { // write virtual screen back into the document
            var dofrom = $_screen.lastIndexOf('<><><>\n') // only display part after the last cls()
            if (dofrom < 0) {
                var i = 20;
                var sawprompt = false;
                dofrom = $_screen.length - 4
                do {
                    i--
                    dofrom = $_screen.lastIndexOf('\n', dofrom - 4)
                    sawprompt = sawprompt || ($_screen.substr(dofrom + 1, 3) == ">>>") || ($_screen.substr(dofrom + 1, 3) == "---")
                } while (dofrom > 0 && (i > 0 || !sawprompt))
            } else(dofrom += 6)
            $_hidden = $_screen.slice(0, dofrom + 1)
            document.theForm.input.focus()
            document.theForm.input.value = $_screen.slice(dofrom + 1)
        }
        // ---------------------------------------------------*/
        function enter(evt) {
            var KEYcode = evt.keyCode;
            if (KEYcode == 13) {
                load()
                if ($_screen == '>>>') {
                    document.theForm.input.value = "// A javascript program using four different methods for getting data:\n// Method one: hard assignment inside the program.\nvar a=1, b=2\nprint('a is '+a); print('b is '+b)\nprint('the sum of '+a+' plus '+b+' is '+(a+b))\n// Method two: funky input command.\na=Number(input('enter a number'))\nb=Number(input('and another number'))\nprint('the sum of '+a+' plus '+b+' is '+(a+b))\ninput('press ENTER to continue')\n// Method three: text box with a prompt command.\na=Number(prompt('enter a number'))\nprint('a is '+a)\nb=Number(prompt('enter another number'))\nprint('b is '+b)\nprint('the sum of '+a+' plus '+b+' is '+(a+b))\n// load the data into a cookie & read it\nsavestuff('dataIn','11\\n22\\n100')\nloaddata('dataIn')\nx=Number(read()); y=Number(read());z=read()\nvprint('x','y','z','x+y+z')\n// Press [ENTER] to run the program."
                    return
                }
                if ($_mode == 0) {
                    execute()
                } // command
                else if ($_mode == 1) {
                    setmode(2);
                    return
                } // scroll
                else if ($_mode == 2) { // edit
                    if (document.theForm.input.value.slice(-2) == '\n\n') {
                        setmode(0);
                        execute()
                    } else return
                } else if ($_mode == 3) saveinput() // input
                show()
            } else if (KEYcode == 27) setmode(-1)
            else if (KEYcode == 38 && $_mode < 2) {
                setmode(1)
                load()
                $_screen = $_old
                $_stackI = ($_stackI + $_stack.length - 1) % $_stack.length
                print(">>>" + $_stack[$_stackI])
                show()
            } else if (KEYcode == 40 && $_mode < 2) {
                setmode(1)
                load()
                $_screen = $_old
                $_stackI = ($_stackI + 1) % $_stack.length
                print(">>>" + $_stack[$_stackI])
                show()
            }
            // display the key code that was pressed: print(KEYcode+"="+String.fromCharCode(KEYcode)+'  ')
        }
        // ---------------------------------------------------*/ }
        function exeline($_work1) {
            with(Math) {
                var $_w = $_work1;
                var ranit = false
                if ($_w.toLowerCase() == 'r') $_w = 'run()'
                if ($_w.length == 0) return
                if ($_mode == 0) $_stack.push($_w);
                $_stackI = $_stack.length
                if ($_w.slice(0, 3) == 'run') {
                    ranit = true;
                    var $r = $_w
                    $_w = eval($_w) // eval('$_w='+$_w)
                    if ($_w == '') return
                    $_stack.push($_w);
                    $_stackI = $_stack.length
                }
                try {
                    if (ranit) {
                        cls();
                        print('>>>' + $r)
                    }
                    print('\n---')
                    work2 = eval($_w)
                    // document.theForm.dataOut.value=dataOut
                    savestuff("dataOut", dataOut)
                    if ($_w.search(/print *\(/) < 0) {
                        if (typeof(work2) == 'string') print('"' + work2 + '"')
                        else if (typeof(work2) == 'undefined') work2 = ''
                        else if (work2 != null) print(work2)
                    }
                } catch (err) {
                    if ($_mode == 0) {
                        // document.theForm.dataOut.value=dataOut
                        savestuff("dataOut", dataOut)
                        print('Javascript Syntax error')
                    }
                }
                val1 = escape(dataOut.replace(/\n/g, "<nl>").replace(/;/g, "<sc>"))
                localStorage.setItem('jsdata', val1)
            }
        }
        // ---------------------------------------------------*/
        function run(name) {
            if (name == undefined || name.length == 0) name = "ijs"
            var xx3 = unescape(localStorage.getItem(name)).replace(/<sc>/g, ";").replace(/<nl>/g, String.fromCharCode(10)).replace(/(\s*\n\s*)+$/, '')
            $_screen = ">>>" + xx3
            show()
            return xx3
        }
        // ---------------------------------------------------*/
        function read(x) {
            var din = '';
            var dinn = 'data' + (x != undefined && x > 0 ? x : '') + 'In';
            eval('din=' + dinn)
            var i = din.search(/[\n]/)
            if (i < 0) i = din.length
            var ii = din.slice(0, i)
            eval(dinn + '=din.slice(i+1)')
            return ii
        }
        // ---------------------------------------------------*/
        function write(x) {
            if ($_mode == 3) return
            var $_xx = Array.prototype.slice.call(arguments)
            dataOut += Print($_xx)
        }
        // ---------------------------------------------------*/
        function writeln(x) {
            write(x + '\n')
        }
        // ---------------------------------------------------
        function loaddata(name, x) {
            var xx3 = unescape(localStorage.getItem(name))
            xx4 = xx3.replace(/<sc>/g, ";").replace(/<nl>/g, String.fromCharCode(10)) //  "\\n"
            if (x != undefined && x > 0) document.theForm.data1In.value = xx4;
            else dataIn = document.theForm.dataIn.value = xx4
        }
        // ---------------------------------------------------*/
        function cls(x) {
            print('<><><>\n')
        }
        // ---------------------------------------------------*/
        function input(prompt) {
            if ($_mode == 3 && $_inputI < $_input.length) {
                if ($_inputI == $_input.length - 1) setmode(0)
                return ($_input[$_inputI++])
            }
            if (prompt != undefined) print((prompt + '').replace(/\?* *$/, "? "));
            else print('? ')
            setmode(3)
            show()
            undefined$_variable
        }
        // ---------------------------------------------------*/
        function saveinput() {
            var $_w = $_new.lastIndexOf("?");
            if ($_w < 0) return
            $_input.push($_new.slice($_w + 2).replace(/\n/g, ''))
            $_inputI = 0;
            $_randomI = 0
            if ($_work != '') {
                if ($_work.slice(0, 3) == 'run') {
                    name = "ijs"
                    $_work = unescape(localStorage.getItem(name)).replace(/<sc>/g, ";").replace(/<nl>/g, String.fromCharCode(10)).replace(/(\s*\n\s*)+$/, '')
                }
                exeline($_work);
                print('>>>')
            } else
                print('\n>>>')
            return
        }
        // ---------------------------------------------------*/
        function execute() {
            if (document.theForm.dataIn.value == '') loaddata('dataIn')
            if (document.theForm.data1In.value == '') loaddata('data1In', 1)
            dataIn = document.theForm.dataIn.value;
            data1In = document.theForm.data1In.value;
            dataOut = ''
            if ($_work != '') {
                if ($_mode == 0) {
                    $_input = [];
                    $_inputI = 0;
                    $_random = [];
                    $_randomI = 0
                }
                exeline($_work)
            } else print(' ')
            if ($_mode == 0) {
                print('>>>')
            }
            show()
        }
        // ---------------------------------------------------*/
        function setmode(newmode) {
            if (newmode < 0) newmode = ($_mode == 0 ? 2 : 0)
            document.getElementById("mode").value = $_modes[newmode]
            $_mode = newmode;
            document.theForm.input.focus()
        }
        // ---------------------------------------------------*/
    </script>
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
        <h2>JavaScript Console</h2>
        <form name="theForm">
            <p>Mode: <input id='mode' type="text" readonly size=9 name="mode" value="Command" onClick="setmode(-1)"></p>
            <p id='browser'> </p>
            <textarea name="input" rows=26 cols=68 onKeyUp="enter(event)"></textarea>
            <!--<p>read(0)dataIn
            <textarea name="dataIn" rows=1 cols=18></textarea>
            Learn Javascript:
            <a href="minimal.js.html" target="_blank">tutorial</a>
            <a href="math1.htm" target="_blank">code samples</a>
            <a href="math2.htm" target="_blank">Math.stuff</a>
            <a href="codes.htm" target="_blank">HTML codes</a>
            <a href="mathcodes.htm" target="_blank">Math symbols</a>
        </p>
        <p>read(1) data1In
            <textarea name = "data1In" rows=1 cols = 18></textarea>
            Sample programs:
            <a href="tron.html" target="_blank"> TRON game</a>
            <a href="2p2e4.htm" target="_blank"> TWO + TWO = FOUR</a>
            <a href="js.js" target="_blank">js methods</a>
            <a href="string.htm" target="_blank"> strings &amp; arrays</a>-->
        </form>
        <script type="text/javascript">
            var $_jsver = 1.0;
        </script>
        <script language="Javascript1.1">
            $_jsver = 1.1;
        </script>
        <script language="Javascript1.2">
            $_jsver = 1.2;
        </script>
        <script language="Javascript1.3">
            $_jsver = 1.3;
        </script>
        <script language="Javascript1.4">
            $_jsver = 1.4;
        </script>
        <script language="Javascript1.5">
            $_jsver = 1.5;
        </script>
        <script language="Javascript1.6">
            $_jsver = 1.6;
        </script>
        <script language="Javascript1.7">
            $_jsver = 1.7;
        </script>
        <script language="Javascript1.8">
            $_jsver = 1.8;
        </script>
        <script language="Javascript1.9">
            $_jsver = 1.9;
        </script>
        <script>
            var $_nVer = navigator.appVersion,
                $_nAgt = navigator.userAgent,
                $_browserName = navigator.appName;
            var $_fullVersion = '' + parseFloat(navigator.appVersion),
                majorVersion = parseInt(navigator.appVersion, 10);
            var $_nameOffset, $_verOffset, $_ix
            if (($_verOffset = $_nAgt.indexOf("Opera")) != -1) {
                $_browserName = "Opera";
                $_fullVersion = $_nAgt.substring($_verOffset + 6);
                if (($_verOffset = $_nAgt.indexOf("Version")) != -1)
                    $_fullVersion = $_nAgt.substring($_verOffset + 8);
            } else if (($_verOffset = $_nAgt.indexOf("MSIE")) != -1) {
                $_browserName = "MS IE";
                $_fullVersion = $_nAgt.substring($_verOffset + 5);
            } else if (($_verOffset = $_nAgt.indexOf("Chrome")) != -1) {
                $_browserName = "Chrome";
                $_fullVersion = $_nAgt.substring($_verOffset + 7);
            } else if (($_verOffset = $_nAgt.indexOf("Safari")) != -1) {
                $_browserName = "Safari";
                $_fullVersion = $_nAgt.substring($_verOffset + 7);
                if (($_verOffset = $_nAgt.indexOf("Version")) != -1)
                    $_fullVersion = $_nAgt.substring($_verOffset + 8);
            } else if (($_verOffset = $_nAgt.indexOf("Firefox")) != -1) {
                $_browserName = "Firefox";
                $_fullVersion = $_nAgt.substring($_verOffset + 8);
            } else if (($_nameOffset = $_nAgt.lastIndexOf(' ') + 1) < ($_verOffset = $_nAgt.lastIndexOf('/'))) {
                $_browserName = $_nAgt.substring($_nameOffset, $_verOffset);
                $_fullVersion = $_nAgt.substring($_verOffset + 1);
                if ($_browserName.toLowerCase() == $_browserName.toUpperCase()) {
                    $_browserName = navigator.appName;
                }
            }

            if (($_ix = $_fullVersion.indexOf(";")) != -1)
                $_fullVersion = $_fullVersion.substring(0, $_ix);
            if (($_ix = $_fullVersion.indexOf(" ")) != -1)
                $_fullVersion = $_fullVersion.substring(0, $_ix);
            majorVersion = parseInt('' + $_fullVersion, 10);
            if (isNaN(majorVersion)) {
                $_fullVersion = '' + parseFloat(navigator.appVersion);
                majorVersion = parseInt(navigator.appVersion, 10);
            }
            var $_OSName = "Unknown OS";
            if (navigator.appVersion.indexOf("Win") != -1) {
                wi$_nVer = [];
                wi$_nVer['5.0'] = '2000';
                wi$_nVer['5.1'] = 'XP';
                wi$_nVer['5.2'] = 'XP 64-bit';
                wi$_nVer['6.0'] = 'Vista';
                wi$_nVer['6.1'] = '7';
                wi$_nVer['6.3'] = '8';
                $_OSName = "Windows";
                $_NTver = $_nAgt.search(/ NT /)
                if ($_NTver > -1) {
                    $_NTver = $_nAgt.substr($_NTver + 4, 3)
                    $_OSName += ' ' + wi$_nVer[$_NTver]
                }
            }
            if (navigator.appVersion.indexOf("Mac") != -1) $_OSName = "Mac OS";
            if (navigator.appVersion.indexOf("X11") != -1) $_OSName = "UNIX";
            if (navigator.appVersion.indexOf("Lin") != -1) $_OSName = "Linux";
            if (navigator.appVersion.indexOf("And") != -1) $_OSName = "Android";

            document.getElementById("browser").innerHTML = '' + $_browserName + ' ' + $_fullVersion + ' on ' + $_OSName + ': ' + navigator.platform + '   ' + "  with JavaScript version: " + $_jsver

            ls = decodeURIComponent(location.search)
            if (ls.search(/\?/) == 0) {
                if (ls.slice(0, 5) == '?run&') print('>>>run("' + ls.slice(5) + '")')
                else if (ls.slice(0, 4) == '?run') print('>>>run()')
                else print('>>>' + ls.slice(1).replace(/&/g, '\n'))
                show();
                load();
                execute()
            } else print('>>>')
            show()
        </script>
    </div>
</body>

</html>