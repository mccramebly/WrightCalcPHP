<!DOCTYPE html>
<html lang="en">

<head>
    <title>Euler project</title>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <script type="text/javascript" src="myfunctions.js"></script>
    <script type="text/javascript" src="matrix.js"></script>
    <script type="text/javascript" src="statfns.js"></script>
    <!-- <SCRIPT type="text/javascript" src="primes.js"></script> -->
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="euler">
    <?php include('nav.html'); ?>
    <div class="artmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheader.png"></a>
        <form name="theForm">
            <input type="text" name="probno" size=6 value='' onClick="euload()" /> <input name='run' type="button" value="run" onClick="eucall()" />

            <textarea name="input" rows=25 cols=80></textarea>

        </form>
        <script>
            menu = [
                [0, ''],
                [172, '18 digits, less than four repeats'],
                [-60, 'Prime pair sets'],
                [165, 'Intersections Problem '],
                [66, 'Diophantine.equation'],
                [100, 'Arranged.probability'],
                [94, 'almost.equilateral'],
                [-215, 'Crack-free.Walls'],
                [107, 'networks'],
                [93, 'arithmetic.expressions'],
                [-205, 'Dice Game'],
                [469, 'Empty chairs'],
                [-23, 'Non-abundant sums'],
                [78, 'Coin partitions '],
                [-114, 'Counting block combinations I'],
                [-116, 'Red, green or blue tiles'],
                [127, 'abc-hits'],
                [-76, 'Counting summations'],
                [113, 'non bouncy numbers'],
                [-54, 'poker hands'],
                [-61, 'Cyclical figurate numbers'],
                [-151, 'large sheets'],
                [0, 'X X']
            ]
            Mprint(menu);
            euprob = 21;
            document.theForm.probno.value = euprob;
            eucall()
            document.theForm.probno.focus()
            // document.theForm.run.focus()

            function euload() {
                document.theForm.input.value = '';
                euprob = Number(document.theForm.probno.value)
                if (euprob < menu.length) print('running ' + menu[euprob][0] + ": " + menu[euprob][1])
            }

            function eucall() {
                euload()
                switch (euprob) {
                    case 0:
                        eu();
                        break;
                    case 1:
                        eu172();
                        break;
                    case 2:
                        eu60();
                        break;
                    case 3:
                        eu165();
                        break;
                    case 4:
                        eu66();
                        break;
                    case 5:
                        eu100();
                        break;
                    case 6:
                        eu94();
                        break;
                    case 7:
                        eu215();
                        break;
                    case 8:
                        eu107();
                        break;
                    case 9:
                        eu93();
                        break;
                    case 10:
                        eu205();
                        break;
                    case 11:
                        eu469();
                        break;
                    case 12:
                        eu23();
                        break;
                    case 13:
                        eu78();
                        break;
                    case 14:
                        eu114();
                        break;
                    case 15:
                        eu116();
                        break;
                    case 16:
                        eu127();
                        break;
                    case 17:
                        eu76();
                        break;
                    case 18:
                        eu113();
                        break;
                    case 19:
                        eu54();
                        break;
                    case 20:
                        eu61();
                        break;
                    case 21:
                        eu151();
                        break;
                    case 22:
                        eu();
                        break;
                    case 23:
                        eu();
                        break;
                    default:
                        print('sorry, ' + document.theForm.probno.value + ' not found. please try again.');
                        Mprint(menu);
                        break;
                }
            }
            // ------------------------------------------------------- */
            function eu151() {
                print('Paper sheets  - Problem 151')
                q = 4 // 2^q-1 pages
                h = [
                    [1, 1, 1, 1, 0, 0, 1],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    [],
                    []
                ]
                // q = 3; h=[[1,1,1,0,0,1],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]]  // test with half large sheet
                // first generate all the possible outcomes
                m = 0 // number of outcomes
                i = 0 // number of A5's removed.
                u = 0 // total number of occurrences of one sheet times the number of permutations, sum of h[i][4]*h[i][5]'s
                t = 0 // number of permutations
                c = 0 // total number of permutations sum of h[i][6]'s
                swfrac(0);
                do {
                    if (i < 0) break // done
                    a = h[i][q];
                    d = 0;
                    for (j = 0; j < q; j++) d += h[i][j];
                    if (h[i][q - 1] == 1 && d == 1) d = -1

                    /* for (x=0;x<=i;x++){ for (y=0; y<q; y++) print (h[x][y],''); print('-',''); for (y=q; y<q+3; y++) print (h[x][y],''); print(' ','')}
                    print (m,i,a,d) // */

                    if (a >= q) {
                        if (d == 0) {
                            c += h[i][q + 2]
                            t += h[i][q + 1]
                            u += h[i][q + 2] * h[i][q + 1]
                            m++;
                            if (m < 30) {
                                print(m + ": ", '');
                                for (x = 0; x <= i; x++) {
                                    for (y = 0; y < q; y++) print(h[x][y], ''); /* print (h[x][q+1],'');/* print (h[x][q+2],'')*/ ;
                                    print(' ', '')
                                };
                                print(h[i][q + 2], h[i][q + 1], h[i][q + 2] * h[i][q + 1], c, u)
                            }
                        }
                        i--;
                        continue
                    }
                    if (h[i][a] < 1) {
                        h[i][q]++;
                        continue
                    }
                    h[i][q]++;
                    i++;
                    for (j = 0; j < q + 3; j++) h[i][j] = h[i - 1][j]
                    h[i][q + 2] *= h[i][a]
                    h[i][a]--;
                    for (j = a + 1; j < q; j++) h[i][j]++
                    h[i][q] = 0
                    if (d == 1) h[i][q + 1]++
                } while (true)

                vprint('c', 'm', 'u', 't')
                print('u/c: ' + (u / c) + '  s.b.', 0.464399)
                print('t/c: ' + (t / c) + '  s.b.', 0.464399)
            }
            // ------------------------------------------------------- */
            function eu61() {
                print('Cyclical figurate numbers - Problem 61')
                pp = [];
                for (i = 0; i < 100; i++) pp[i] = []

                function pushit(p, nn) {
                    if (1000 <= nn && nn <= 9999) {
                        k1 = Math.floor(nn / 100);
                        k2 = nn % 100
                        pp[k1].push([p, k2, n])
                    }
                }

                for (n = 10; n < 200; n++) {
                    pushit(3, n * (n + 1) / 2)
                    pushit(4, n * n)
                    pushit(5, n * (3 * n - 1) / 2)
                    pushit(6, n * (2 * n - 1))
                    pushit(7, n * (5 * n - 3) / 2)
                    pushit(8, n * (3 * n - 2))
                }

                //p8,9976,(58)  is  pp[99] = (8,76,58)
                for (i = 0; i < 100; i++)
                    if (pp[i].length == 1) print(i + ':' + pp[i], ' ');
                print()
                only = 6
                countall = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                /*for (i=0;i<100;i++) for (j=0;j<pp[i].length;j++) countall[pp[i][j][0]]++
                for (i=0;i<countall.length;i++) print (i+":"+countall[i],' '); print()*/

                for (i = 0; i < 100; i++)
                    for (j = 0; j < pp[i].length; j++) {
                        if (pp[i][j][0] == 8) {
                            lll = '' + (100 + i + '').slice(1, 3) + '-' + pp[i][j][1]
                            print(pp[i][j], lll)
                            list = [lll];
                            findnext(lll.slice(3, 5), '8')
                        }
                    }

                function findnext(k1, have) {
                    if (have.length == only) {
                        if (list[0].slice(0, 2) == list[only - 1].slice(3, 5)) {
                            print(have + ":" + list);
                            sum = 0;
                            for (i = 0; i < 6; i++) {
                                print(list[i], 100 * Number(list[i].slice(0, 2)) + Number(list[i].slice(3, 5)), sum)
                                sum += 100 * Number(list[i].slice(0, 2)) + Number(list[i].slice(3, 5))
                            }
                            print(sum)
                            stopit
                        } else return
                    }

                    {
                        for (var j = 0; j < pp[k1].length; j++) {
                            if (have.search(pp[k1][j][0]) == -1) {
                                list.push('' + k1 + '-' + pp[k1][j][1])
                                findnext(pp[k1][j][1], have + pp[k1][j][0])
                                list.pop()
                            }
                        }
                    }
                }
            }
            // ------------------------------------------------------- */
            function eu54() {
                print('Euler 54: Poker hands ')
                m = [
                    ["TH", "AH", "KH", "QH", "JH", "2D", "3D", "4D", "5D", "6D"],
                    ["TH", "AH", "KH", "QH", "JH", "TD", "AD", "KD", "QD", "JD"],
                    ["TH", "AH", "KH", "QH", "JD", "2D", "3D", "4D", "5D", "6D"],
                    ["TH", "AH", "KH", "QH", "JD", "2D", "3S", "4D", "5D", "6D"],
                    ["TH", "KD", "KH", "QH", "JH", "2D", "3S", "4D", "5D", "6D"]
                ]

                rank = '23456789TJQKA';
                color = 'CDHS'
                res = [
                    ['tie'],
                    ['str/royal flush'],
                    ['4 kind'],
                    ['full house'],
                    ['flush'],
                    ['straight'],
                    ['3 kind'],
                    ['2 pair'],
                    ['pair'],
                    ['high card']
                ]

                function cod(z) {
                    for (var i = 0; i < rank.length; i++)
                        if (rank[i] == z[0]) return '' + (102 + i)
                }

                c = 0
                for (i = 0; i < m.length; i++) {
                    stop = false
                    w = 0;
                    h1 = [];
                    h2 = [];
                    fl1 = true;
                    co1 = m[i][0][1];
                    fl2 = true;
                    co2 = m[i][5][1]
                    for (j = 0; j < 5; j++) {
                        h1.push(cod(m[i][j]));
                        if (co1 != m[i][j][1]) fl1 = false
                    }
                    for (j = 5; j < 10; j++) {
                        h2.push(cod(m[i][j]));
                        if (co2 != m[i][j][1]) fl2 = false
                    }

                    h1.sort();
                    h2.sort();
                    st1 = 1;
                    st2 = 1
                    for (j = 1; j < 5; j++) {
                        if (h1[j] != Number(h1[j - 1]) + 1) st1 = 0
                        if (h2[j] != Number(h2[j - 1]) + 1) st2 = 0
                    }
                    st1 *= Number(h1[4]);
                    st2 *= Number(h2[4])
                    if ((fl1 && st1 > 0) && (!fl2 || st1 > st2)) w = 1 // 1: royal or straight flush
                    if ((fl2 && st2 > 0) && (!fl1 || st2 > st1)) w = -1 //

                    if (w == 0) {
                        if (h1[0] == h1[3] || h1[1] == h1[4]) f1 = h1[2];
                        else f1 = 0
                        if (h2[0] == h2[3] || h2[1] == h2[4]) f2 = h2[2];
                        else f2 = 0
                        if (f1 > f2) w = 2;
                        else if (f2 > f1) w = -2
                    } // 2: four of a kind

                    if (w == 0) {
                        if (h1[0] == h1[2] || h1[1] == h1[3] || h1[2] == h1[4]) f1 = h1[2];
                        else f1 = 0
                        if (h2[0] == h2[2] || h2[1] == h2[3] || h2[2] == h2[4]) f2 = h2[2];
                        else f2 = 0
                        fh1 = 0;
                        if (f1 > 0)
                            if (h1[0] == h1[1] && h1[3] == h1[4]) fh1 = f1
                        fh2 = 0;
                        if (f2 > 0)
                            if (h2[0] == h2[1] && h2[3] == h2[4]) fh2 = f2
                        if (fh1 > fh2) w = 3;
                        else if (fh1 < fh2) w = -3
                    } // 3: full house

                    if (w == 0) {
                        if (fl1 && !fl2) w = 4
                        if (fl2 && !fl1) w = -4
                        if (fl1 && fl2) w = 4 * pickhi()
                    } // 4: flush

                    if (w == 0) {
                        if (st1 > st2) w = 5
                        if (st1 < st2) w = -5
                    } // 5: straight

                    if (w == 0) {
                        if (f1 > f2) w = 6
                        if (f1 < f2) w = -6
                    } // 6: three of a kind

                    if (w == 0) {
                        pa1 = 0;
                        pa2 = 0;
                        pb1 = 0;
                        pb2 = 0
                        for (k = 4; k > 0; k--) {
                            if (h1[k] == h1[k - 1])
                                if (pa1 == 0) pa1 = h1[k];
                                else pb1 = h1[k]
                            if (h2[k] == h2[k - 1])
                                if (pa2 == 0) pa2 = h2[k];
                                else pb2 = h2[k]
                        }
                        if (pa1 > 0 && pb1 > 0 && pa2 * pb2 == 0) w = 7
                        else if (pa2 > 0 && pb2 > 0 && pa1 * pb1 == 0) w = -7
                        else if (pa1 > 0 && pb1 > 0) {
                            if (pa1 > pa2) w = 7;
                            else if (pa1 < pa2) w = -7
                            else if (pb1 > pb2) w = 7;
                            else if (pb1 < pb2) w = -7
                            else w = 7 * pickhi()
                        }
                    } // 7: two pair

                    if (w == 0) {
                        if (pa1 > pa2) w = 8;
                        else if (pa1 < pa2) w = -8;
                        else if (pa1 > 0) w = 8 * pickhi()
                    } // 8: one pair

                    if (w == 0) {
                        w = 9 * pickhi()
                    } // 9: high card

                    if (w > 0) c++
                    if (w == 0) {
                        print(i, m[i]);
                        print(h1, fl1, co1, h2, fl2, co2);
                        print(st1, st2, w, res[Math.abs(w)]);
                    }

                }
                print('Player 1 wins ' + c + ' out of ' + m.length)
                //   */
                function pickhi() {
                    for (k = 4; k >= 0; k--)
                        if (h1[k] != h2[k]) break
                    if (h1[k] > h2[k]) return 1;
                    else if (h1[k] < h2[k]) return -1;
                    else return 0
                }
            }
            // ------------------------------------------------------- */
            function eu76() {
                print('Coin partitions ')
                print('Euler 76')
                // first try
                r = [0, 0, 1, 2, 4, 6, 10, 14, 21, 29, 41, 55, 76, 100, 134, 175, 230, 296, 384, 489]
                n = 100
                n = 5;
                c = 6
                m = 20;
                p = []

                function f(j, v, w) {
                    // print (j,v,w,'(',''); for (i=0;i<j;i++) print(p[i],' '); print(')');
                    /* subscript j is the next value to set in p[]
                       v = maximum for position j
                       w = amount left to distribute */
                    var s = min(v, w)
                    if (w == 0) { // for (i=0;i<j;i++) print(p[i],' '); print();
                        if (j > 1) c++
                        return
                    }
                    do {
                        p[j] = s
                        f(j + 1, s, w - s);
                        s--
                    } while (s > 0)
                }
                // start with values for n
                for (n = 2; n < m; n++) {
                    print('n ==> ' + n, '')
                    p = [];
                    c = 0
                    f(0, n, n);
                    print('  c: ' + c)
                }
                // second try
                m = 103;
                p = [
                    []
                ]
                for (i = 1; i < m; i++) p[i] = [0, 1]
                for (n = 1; n < m; n++) {
                    for (k = 1; k < n; k++) {
                        s = p[n - 1][k - 1]
                        if (n >= k)
                            if (p[n - k][k] != undefined) s += p[n - k][k]
                        p[n][k] = s
                    }
                }
                for (n = 1; n < m; n++) {
                    s = 0;
                    for (k = 2; k < n; k++) s += p[n][k]
                    if (n == 101) print(n - 1, s)
                }
            }
            // ------------------------------------------------------- */
            function eu78() {
                print('Coin partitions ')
                print('Euler 78')
                /*  first try
                y=prompt('enter "y" to see detail')
                m=Number(prompt('maximum number of coins to display'))
                for (n=1; n<m+1; n++){
                c=0
                print ('\nn='+n+": ",''); f(n,n,''); print(' ['+c+'] ','')}

                function f(n,j,k){
                 if (n==0) {
                   if (y=='y') print(k+'; ','')
                   c++}
                 if (n<1) return
                 var j1=j
                 while (j1>0){
                  var k1 = k+(k.length>0?',':'')+j1
                  f(n-j1,j1--,k1)}
                }
                ***** second try
                p=[,[,1],[,1,1],[,2,0,1]]
                t=[,[,1],[,1,1],[,3,1,1]]
                function dup(t){
                for (i=1;i<t.length;i++){ print (i+': ','')
                for (j=1;j<t[i].length;j++)print(t[i][j],' ')
                print ()}}

                for (i=4;i<22;i++)
                {p[i]=[]; t[i]=[]
                 for (j=1; j<i; j++){p[i][j]=0; t[i][j]=0}
                 p[i][i]=1;t[i][i]=1
                 for (k=1;k<i;k++) if(k<=i-k) p[i][k]=t[i-k][k]
                 for (k=i-1;k>0;k--) t[i][k]=t[i][k+1]+p[i][k]
                }
                dup(t) */
                // third
                t = [, [, 1],
                    [, 1, 1],
                    [, 3, 1, 1]
                ]

                function dup(t) {
                    for (i = 1; i < t.length; i++) {
                        print(i + ': ', '')
                        for (j = 1; j < t[i].length; j++) print(t[i][j], ' ')
                        print()
                    }
                }
                p = []
                i = 4;
                do {
                    p = [];
                    t[i] = []
                    for (j = 1; j < i; j++) {
                        p[j] = 0;
                        t[i][j] = 0
                    }
                    p[i] = 1;
                    t[i][i] = 1
                    for (k = 1; k <= i - k; k++) p[k] = t[i - k][k]
                    for (k = i - 1; k > 0; k--) t[i][k] = (t[i][k + 1] + p[k]) % 1000000
                    t[i / 2] = [];
                    i++
                } while (t[t.length - 1][1] % 1000000 != 0)
                // dup(t)
                i = t.length - 1
                print(i, t[i][1])
            }
            // ------------------------------------------------------- */
            function eu23() {
                print('Non-abundant sums ')
                w = [] // abu
                for (i = 1; i < 28124; i++) {
                    a = 1;
                    for (j = 2; j < i / 2 + 1; j++)
                        if (i % j == 0) a += j
                    if (a > i) w[i] = i
                }
                v = [] // abu sums
                for (i = 1; i < w.length; i++)
                    if (w[i] != undefined) {
                        for (j = 1; j < w.length; j++)
                            if (w[j] != undefined) {
                                v[i + j] = i + j
                            }
                    }
                c = 0;
                t = 0 // non-ab sums
                for (i = 1; i < 28124; i++)
                    if (v[i] == undefined) {
                        c++;
                        t += i
                    }
                print(c, t)
            }
            // ------------------------------------------------------- */
            function eu79() {
                print('79 Passcode derivation')
                p = [129, 160, 162, 168, 180, 289, 290, 316, 318, 319, 362, 368, 380, 389, 620, 629, 680, 689, 690, 710, 716, 718, 719, 720, 728, 729, 731, 736, 760, 762, 769, 790, 890]
                s = '73162890'
                w = 0
                for (i = 0; i < p.length; i++) {
                    q = '' + p[i]
                    r = '.*'
                    r = q[0] + r + q[1] + r + q[2]
                    var re = new RegExp(r)
                    if (s.search(re) == -1) {
                        print(p[i]);
                        w++
                    }
                }
                print(w, p.length)
            }
            // ------------------------------------------------------- */
            function eu80(x, n) {
                print('80 Square root digital expansion')
                // add up the first 100 digits of sqrt of 1 thru 100 except for rationals
                n = 100;
                n = n - 2;
                t = 0

                for (x = 2; x < 101; x++) { // sqrt of x
                    aa = '' + sqrt(x)
                    if (aa.length < 3) continue
                    a = aa.slice(0, 4)
                    s = Number(a[0]) + Number(a[2]) + Number(a[3])

                    for (i = 1; i < n; i++) {
                        b = a + '0';
                        c = 0;
                        while (hpless(hpmul(b, b), x)) {
                            c++;
                            if (c > 9) break;
                            b = b.slice(0, -1) + c;
                        }
                        s += (c - 1) // the next digit
                        a = b.slice(0, -1) + (c - 1)
                    }
                    t += s
                }
                print(t)
            }
            // ------------------------------------------------------- */
            function eu113() {
                print('113 Non-bouncy numbers ')
                x = 100;
                y = 10 * x
                print('a, b, c, ****, <  , > , = , != ')
                otg = 0;
                ote = 0;
                otl = 0;
                otn = 0
                tg = 0;
                te = 0;
                tl = 0;
                tn = 0
                for (i = x; i < y; i++) {
                    a = '' + i
                    b = a.split('').sort().join('')
                    c = a.split('').sort().reverse().join('')
                    if (a == b) {
                        tg++
                    }
                    if (a == c) {
                        tl++
                    }
                    if (a == b && a == c) {
                        te++;
                        tl--;
                        tg--
                    }
                    if (a != b && a != c) {
                        tn++
                    }
                    print(a, b, c, "***", tl - otl, tg - otg, te - ote, tn - otn)
                    otl = tl;
                    otg = tg;
                    ote = te;
                    otn = tn
                }
                print(tl, tg, te, tn, tl + tg + te)
            }
            // ------------------------------------------------------- */
            function eu127() {
                print('127 abc-hits ')

                function clpr(x) {
                    var a = prime(x)
                    return a.slice(a.search(":") + 1).replace(/\^\d+/ig, "").replace(/[^\d]+/ig, " ")
                }

                cc = 0;
                dd = 0
                // xx=32; for (c=xx;c<=xx;c++)
                for (c = 3; c < 120000; c++) // c<1000 yields dd=31, cc=12523
                { // print ('***', c)
                    for (a = 1; a < c / 2; a++) {
                        if (gcf(a, c) > 1) continue
                        b = c - a
                        if (gcf(b, c) > 1 || gcf(a, b) > 1) continue
                        // print ('**  ',a,b,c)
                        x = clpr(a) + clpr(b) + clpr(c)
                        y = x.replace(/^ */, '').replace(/ *$/, '').replace(/ /ig, '*')
                        z = eval(y)
                        if (z < c) {
                            cc += c;
                            dd++
                        } // print ('   x  ',x,'=',y,z)
                    }
                }
                print(dd, cc) // 456, 18407904
            }
            // ------------------------------------------------------- */
            function eu469() {
                print('Empty chairs ')
                print('0.56766764161831')
                // x = random sitting history
                // p = # choices so far ( 1/p is probab)
                // l = table (0's are taken, -1 not available
                function doit(x, p, l) {
                    // print (x,p,l)
                    var q = 0;
                    var ll = l.slice(0)
                    for (var i = 1; i < n; i++)
                        if (l[i - 1] == 0 || l[i + 1] == 0) ll[i] = -1
                    for (var i = 0; i < n; i++)
                        if (ll[i] > 0) q++
                    if (q == 0) {
                        // print ('***',ll,' p='+(100/p)+'%',' empty:'+(n-x.length)+'/'+n);
                        // print( x,ll,' p='+(100/p)+'%',' empty:'+(n-x.length))
                        tp += 1 / p;
                        ev += (n - x.length) / p
                    } else {
                        for (var i = 0; i < n; i++)
                            if (ll[i] > 0) {
                                ll[i] = 0;
                                doit(x + i, p * q, ll);
                                ll[i] = i
                            }
                    }
                }

                for (n = 4; n < 13; n += 2) {
                    m = n + 1;
                    c = [];
                    tp = 0;
                    ev = 0;
                    for (i = 0; i < n; i++) c[i] = i;
                    c[n] = 0
                    doit('0', 1, c);
                    print('n=' + n, ' p=' + my(tp * 100, 2) + '%', myround(ev / n, 9)) // +"="+my(ev/n,3))
                    //print (ev,n,ev/n)
                }
            }
            // ------------------------------------------------------- */
            function eu172() {
                // euler 172 : https://projecteuler.net/problem=172
                i = "100000000000000000"
                i = "888888061231231231"
                q = 0
                j = i.split('')
                for (x = 0; x < 18; x++) j[x] = Number(j[x])

                while (true) {
                    n = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                    for (a = 0; a < 18; a++)
                        if (3 < ++n[j[a]]) break
                    if (a == 18) {
                        q++;
                        print(j)
                    }
                    for (x = a + 1; x < 18; x++) j[x] = 0
                    while (a > 0) {
                        if (++j[a] < 10) break;
                        j[a] = 0;
                        a--
                    }
                    if (a < 1) {
                        print('******', q);
                        kkk = kkkkkk
                    }
                }
                print('***', q)
            }
            // ------------------------------------------------------- */
            function eu60() {
                print(' euler 60: prime pair sets ')
                a = [3, 7, 109, 673]
                // a=[0,0,0,0,0]
                an = a.length
                lowest = 34000

                function findnext(i, iii) {
                    if (i >= an) return true
                    var es = (i == 0 ? 3 : a[i - 1])
                    for (var e = es; e < iii; e += 2) {
                        if (prime(e)[0] != 'i') continue
                        var isok = true
                        for (var j = 0; j < i; j++) {
                            if (prime('' + e + a[j])[0] != 'i' || prime('' + a[j] + e)[0] != 'i') {
                                isok = false;
                                break
                            }
                        }
                        if (isok) {
                            a[i] = e;
                            if (findnext(i + 1, iii - e)) return true
                        }
                    }
                    return false
                }

                if (findnext(0, lowest)) {
                    print('check solution: ' + a)
                    sum = 0;
                    for (i = 0; i < an; i++) {
                        sum += a[i];
                        print(a[i] + (prime(a[i])[0] == 'i' ? ' is prime' : ' **** '))
                    }
                    for (i = 1; i < an; i++) {
                        for (j = 0; j < i; j++) {
                            b1 = '' + a[j] + a[i]
                            b = '' + a[i] + a[j]
                            print(j + ' & ' + i + ': ' + b + (prime(b)[0] == 'i' ? ' is prime' : ' **** '), b1 + (prime(b1)[0] == 'i' ? ' is prime' : ' **** '))
                        }
                    }
                    print('sum is:' + sum)
                } else print('not found under ' + lowest)
            }
            // ------------------------------------------------------- */
            function eu165() {
                // not 2864703
                // Intersections Problem 165
                s = 290797

                function pr() {
                    s = (s * s) % 50515093
                    return s % 500
                }
                n = 5000;
                k = 0;
                bug = false
                l = [];
                for (i = 0; i < n; i++) l.push([pr(), pr(), pr(), pr()])
                if (bug) Mprint(l)

                for (i = 0; i < l.length; i++) {
                    a = l[i][0];
                    b = l[i][1];
                    c = l[i][2];
                    d = l[i][3]
                    x1 = min(a, c);
                    x2 = a + c - x1
                    l[i].push(c - a, d - b, (c - a) * b - a * (d - b))
                    a1 = l[i][4];
                    b1 = l[i][5];
                    c1 = l[i][6]
                    if (bug) print("(" + l[i][0], l[i][1] + ")", "(" + l[i][2], l[i][3] + ")")
                    // if (bug)  print (a1*l[i][1],b1*l[i][0]+c1)
                    for (j = 0; j < i; j++) {
                        a2 = l[j][4];
                        b2 = l[j][5];
                        c2 = l[j][6]
                        x = (a1 * c2 - a2 * c1) / (b1 * a2 - a1 * b2)
                        y = (b1 * x + c1) / a1
                        if (bug) print("(" + x, y + ",-5)")
                        x3 = min(l[j][0], l[j][2]);
                        x4 = l[j][0] + l[j][2] - x3
                        if (x1 < x && x < x2 && x3 < x && x < x4) {
                            k++
                            if (bug) print(x1, x, x2, x3, x, x4, '****')
                        }
                    }
                }
                print('** k= **', k)
            }
            // ------------------------------------------------------- */
            function eu66() {
                print('ouch - not loaded yet ')
                //  # 66  Diophantine equation
                zzc = 0;
                zz = 3000;
                x = 1;
                y = 1;
                m = 99;
                m = 1001
                for (d = 2; d < m; d++) {
                    f = int(Math.sqrt(d))
                    if (d == f * f) continue
                    for (z = 1; z < zz; z++) { // y
                        w = 1 + d * z * z
                        f = int(Math.sqrt(w)) // x
                        if (w == f * f) break
                    }
                    vprint('d', 'f', 'z')
                    if (z == zz) zzc++
                    else if (f > x) {
                        x = f;
                        y = z
                    }
                }
                d = (x * x - 1) / (y * y)
                vprint('d', 'x', 'y', 'zzc')
            }
            // ------------------------------------------------------- */
            function eu100() {
                print('ouch - not loaded yet ')
                // Arranged probability Problem 100
                m = 1000000000000
                for (d = m; d < m + 100000; d++) {
                    a2 = 2 * d * (d - 1) + 1
                    a = int(Math.sqrt(a2))
                    if (a * a == a2) {
                        b = ((a + 1) / 2)
                        vprint('b', 'd')
                    }
                }
            }
            // ------------------------------------------------------- */
            function eu94() {
                print('ouch - not loaded yet ')
                // // euler 94 almost equilateral
                /// euler 94
                tp = 0;
                p = 0;
                l = 11111;
                l = 1000000000

                print('max: ' + l)
                for (n = 1; true; n++) {
                    a = n - 1
                    if (a + a + n - 1 > l) break
                    b = sqrt(n * n - a * a / 4)
                    if (b % 1 == 0 && a > 0) {
                        p = n + n + a
                        tp += p;
                        print(a, n, n, p)
                    }
                    a = n + 1
                    b = sqrt(n * n - a * a / 4)
                    if (n + n <= a) continue
                    if (b % 1 == 0) {
                        p = n + n + a
                        tp += p;
                        print(a, n, n, p)
                    }
                }
                print('***', tp)
                // not 9399467725
                /*

                max: 1000000000
                6, 5, 5, 16
                16, 17, 17, 50
                66, 65, 65, 196
                240, 241, 241, 722
                902, 901, 901, 2704
                3360, 3361, 3361, 10082
                12546, 12545, 12545, 37636
                46816, 46817, 46817, 140450
                174726, 174725, 174725, 524176
                652080, 652081, 652081, 1956242
                2433602, 2433601, 2433601, 7300804
                9082320, 9082321, 9082321, 27246962
                33895686, 33895685, 33895685, 101687056
                92604734, 92604733, 92604733, 277814200
                126500416, 126500417, 126500417, 379501250
                143448261, 143448260, 143448260, 430344781
                177343943, 177343944, 177343944, 532031831
                185209464, 185209465, 185209465, 555628394
                194291788, 194291787, 194291787, 582875362
                202157309, 202157308, 202157308, 606471925
                236052991, 236052992, 236052992, 708158975
                253000836, 253000835, 253000835, 759002506
                279030997, 279030998, 279030998, 837092993
                286896518, 286896519, 286896519, 860689556
                294762039, 294762040, 294762040, 884286119
                303844363, 303844362, 303844362, 911533087
                311709884, 311709883, 311709883, 935129650
                ***, 9399467725

                tp=0;h=0
                for (i=0;3*h<l;i+=2){
                a=i*i; for (m=0;m*m<a;m++){
                if (a%m==0){
                n=a/m; if(gcf(n+m,gcf(n-m,2*i))==1){
                f=(n-m); g=(2*i); h=(m+n)
                if (3*h>l) break
                //  print(f,g,h,'>')
                d=f+f; if (d+1==h||d-1==h) {print(d,h,h,d+h+h);tp+=d+h+h}
                d=g+g; if (d+1==h||d-1==h) {print(d,h,h,d+h+h);tp+=d+h+h}
                }}}}
                print('***',tp)

                //  not 191856
                */
            }
            // ------------------------------------------------------- */
            function eu215() {
                print('215 crack free walls')
                n = 32;
                h = 10 // not 11306?  is 806844323190414
                // n=9; h=3    // is 8
                print(n + ' across  ', h + ' high')
                i1 = pow(2, ceil(n / 3));
                i2 = pow(2, ceil(n / 2) + 1) - 1;
                m = []
                for (i = i1; i <= i2; i++) {
                    j = base(i, 2).split('');
                    j.shift(); // print(j,' ') // 1
                    k = 0;
                    l = [];
                    while (j.length > 0) {
                        if (j.shift() == '0') {
                            l.push(2);
                            k += 2
                        } else {
                            l.push(3);
                            k += 3
                        }
                    } // print(k) // 1
                    if (k == n) {
                        m.push(l); // print("*"," ")
                    }
                }
                print('** possible rows:'); // Mprint(m)
                print('** neighbors:')
                v = [];
                w = [];
                for (i = 0; i < m.length; i++) {
                    vv = [];
                    for (j = 0; j < m.length; j++) {
                        aa = m[i][0];
                        a = 1;
                        bb = m[j][0];
                        b = 1;
                        ok = true
                        while (a < m[i].length || b < m[j].length) {
                            if (aa == bb) {
                                ok = false;
                                break
                            }
                            if (aa <= bb) {
                                aa += m[i][a];
                                a++
                            } else {
                                bb += m[j][b];
                                b++
                            }
                        }
                        if (ok) vv.push(j)
                    }
                    v.push(vv);
                    w.push([])
                }
                // Mprint(v)
                for (i = 0; i < v.length; i++) w[i][0] = v[i].length
                hh = 1;
                while (hh < h - 1) {
                    for (i = 0; i < v.length; i++) {
                        w[i][hh] = 0;
                        for (j = 0; j < v[i].length; j++) w[i][hh] += w[v[i][j]][hh - 1]
                    }
                    hh++
                }
                // Mprint(w)
                kk = 0;
                for (i = 0; i < w.length; i++) kk += w[i][h - 2]
                print('tot=', kk)
            }
            // ------------------------------------------------------- */
            function eu72() {
                print('ouch - not loaded yet ')
                // 72 - Counting fractions
                kk = 0;
                n = 1000000 // 72
                for (i = 2; i <= n; i++) {
                    // print(i+":","");
                    k = 0;
                    for (j = 1; j < i; j++)
                        if (gcf(i, j) == 1) {
                            k = k + 1; // print(j," ")
                        }
                    kk += k; // print(' < '+k,kk)
                }
                print(n, kk)
            }
            // ------------------------------------------------------- */
            function eu107() {
                print('ouch - not loaded yet ')
                // 107 networks

                m = [
                    [0, 16, 12, 21, 0, 0, 0],
                    [16, 0, 0, 17, 20, 0, 0],
                    [12, 0, 0, 28, 0, 31, 0],
                    [21, 17, 28, 0, 18, 19, 23],
                    [0, 20, 0, 18, 0, 0, 11],
                    [0, 0, 31, 19, 0, 0, 27],
                    [0, 0, 0, 23, 11, 27, 0]
                ]
                Mprint(m);
                n = m.length;
                print('n=' + n)
                t1 = 0;
                t2 = 0;
                for (i = 0; i < n; i++)
                    for (j = i; j < n; j++)
                        if (m[i][j] > 0) {
                            t1 += m[i][j];
                            t2++
                        }
                print(t2 + ' edges total ' + t1, ' det: ' + Mdet(m))
                t = [];
                for (i = 0; i < n; i++)
                    for (j = i; j < n; j++)
                        if (m[i][j] > 0) t.push([m[i][j], i, j])
                t.sort(function(a, b) {
                    return b[0] - a[0]
                })


                s = 0
                // find maximum removable edge
                while (t.length > 0) {
                    u = t.shift()
                    m[u[1]][u[2]] = 0;
                    m[u[2]][u[1]] = 0
                    print(u, ' **** ', Mdet(m), ' ', '')
                    if (Mdet(m) == 0) {
                        m[u[2]][u[1]] = u[0];
                        m[u[1]][u[2]] = u[0];
                        print('<<')
                    } else {
                        s += u[0];
                        print(s)
                    }
                }
                print(s + ': ')
                Mprint(m)
                print('****  should be  *****')
                m = [
                    [0, 16, 12, 0, 0, 0, 0],
                    [16, 0, 17, 0, 0, 0, 0],
                    [12, 0, 0, 0, 0, 0, 0],
                    [0, 17, 0, 0, 18, 19, 0],
                    [0, 0, 0, 18, 0, 0, 11],
                    [0, 0, 0, 19, 0, 0, 0],
                    [0, 0, 0, 0, 11, 0, 0]
                ]
                Mprint(m)
                print(Mdet(m))
            }
            // ------------------------------------------------------- */
            function eu93() {
                print('93 arithmetic expressions')
                x = 0;
                y = 0;
                z = 0
                o = ["+", '-', '*', '/']
                ex = []
                ex[0] = "'  ' +a + o[x] + b + o[y] +c +  o[z] +d"
                ex[1] = "' (' +a + o[x] + b + ')' + o[y] +c +  o[z] +d"
                ex[2] = "' (' +a + o[x] + b + ')' + o[y] + '('+c +  o[z] +d + ')'"
                ex[3] = "' (' +a + o[x] + b + o[y] +c + ')'+ o[z] +d"
                ex[4] = "' ((' +a + o[x] + b + ')' + o[y] +c + ')' +o[z] +d"
                ex[5] = "' ('  +a + o[x] + '(' +b + o[y] +c + '))' +o[z] +d"
                ex[6] = "'  ' +a + o[x] + '(' +b + o[y] +c + ')' +o[z] +d"
                ex[7] = "'  ' +a + o[x] + '(' +b + o[y] +c +  o[z] +d + ')'"
                ex[8] = "'  ' +a + o[x] + '((' +b + o[y] +c + ')' +o[z] +d + ')'"
                ex[9] = "'  ' +a + o[x] + '(' +b + o[y] + '(' +c +  o[z] +d + '))'"
                ex[10] = "'  ' +a + o[x] + b + o[y] + '(' +c +  o[z] +d + ')'"


                mm = 0;
                mi = 0;
                abcd = 5;
                m = []
                for (a = 1; a < abcd; a++)
                    for (b = 1; b < abcd; b++)
                        if (a != b)
                            for (c = 1; c < abcd; c++)
                                if (c != a && c != b)
                                    for (d = 1; d < abcd; d++)
                                        if (d != a && d != b && d != c)

                {
                    for (x = 0; x < 4; x++)
                        for (y = 0; y < 4; y++)
                            for (z = 0; z < 4; z++) {
                                for (i = 0; i < ex.length; i++) {
                                    n = eval(eval(ex[i]));
                                    if (n % 1 == 0)
                                        if (m[n] == undefined) {
                                            m[n] = eval(ex[i])
                                        }
                                }
                            }
                    for (i = 1; i < m.length; i++)
                        if (m[i] == undefined) break
                    if (i - 1 > mm) {
                        mm = i - 1;
                        mi = '' + a + b + c + d;
                        print(mm, mi)
                        break
                    }
                }
            }
            // ------------------------------------------------------- */
            function eu114() {
                print('114&115 Counting block combinations')
                n = 7 // 17
                m = 3;
                n = 50
                var r = [];
                b = []

                function red(x) {
                    if (r[x] != undefined) return r[x]
                    if (x < m) return 0
                    var t = 1
                    for (var i = m; i < x; i++) t += black(x - i)
                    // print ('red',x,t)
                    r[x] = t
                    return t
                }

                function black(x) {
                    if (b[x] != undefined) return b[x]
                    if (x < 1) return 0
                    if (x < m + 1) return 1
                    var t = 1
                    for (var i = 1; i <= x - 3; i++) t += red(x - i)
                    // print ('black',x,t)
                    b[x] = t
                    return t
                }
                print('114: ' + m, n, red(n) + black(n))
                m = 50
                for (n = 123; n < 9999; n++) {
                    w = red(n) + black(n)
                    if (w > 1000000) break
                }
                print('115: ' + m, n, w)
            }
            // ------------------------------------------------------- */
            function eu116() {
                print('116 & 117 Red, green or blue tiles')
                // x = # positions,  y = [1,2,3,4,...] possible tiles
                function f(x, y) {
                    var t = 0
                    if (s[x] != undefined) return s[x]
                    for (var i = 0; i < y.length; i++) {
                        // print (i,y[i],x,t)
                        if (y[i] == x) t++
                        else if (y[i] < x) t += f(x - y[i], y)
                    }
                    // print(t,x,y)
                    s[x] = t
                    return t
                }
                n = 50
                s = [];
                a = f(n, [1, 2])
                s = [];
                a += f(n, [1, 3])
                s = [];
                a += f(n, [1, 4])
                print('#116 is ' + (a - 3))
                n = 50
                s = [];
                a = f(n, [1, 2, 3, 4])
                print('#117 is ' + (a))
            }
            // ------------------------------------------------------- */
            function eu205() {

                function blddice(n, f) { // n dice, f faces
                    var a = [0];
                    for (var i = 0; i < f; i++) a[i + 1] = 1
                    for (var m = 2; m <= n; m++) {
                        b = a.slice(0);
                        a = [0]
                        for (i = 0; i <= m * f; i++) a[i] = 0
                        for (i = 0; i < f; i++)
                            for (var j = 0; j < b.length; j++) a[j + i + 1] += b[j]
                    }
                    return a
                }

                pn = 9;
                pf = 4;
                cn = 6;
                cf = 6
                p = blddice(pn, pf);
                c = blddice(cn, cf)
                ptt = 0;
                for (i = 0; i < p.length; i++) ptt += p[i]
                for (i = c.length; i < p.length; i++) c[i] = 0
                crt = [0];
                for (i = 1; i < c.length; i++) crt[i] = crt[i - 1] + c[i];
                ctt = crt[i - 1]
                pm = 0;
                pe = 0;
                pl = 0
                for (i = 1; i < p.length; i++) {
                    pe += p[i] * c[i]
                    pm += p[i] * crt[i - 1]
                    pl += p[i] * (ctt - crt[i])
                }
                print('more: ' + pm, ' same: ' + pe, ' less: ' + pl, ' total: ' + (pm + pe + pl))
                print('p count: ' + ptt, '  c count: ' + ctt, '  all count: ' + ptt * ctt)
                print(' % more: ' + (pm / (pm + pe + pl)))
            }
            // ------------------------------------------------------- */
            function eu65() {
                print('65 - Convergents of e')
                // used recurrence formula to calculate the numerators - denom not needed.
                a = [2, 1, 2, 1, 1];
                h = [2, 3, 8, 11, 19]
                n = 100;
                k = 4
                while (a.length < n + 5) {
                    a.push(k);
                    a.push(1);
                    a.push(1);
                    k += 2
                }
                // print (a)
                aa = a.length;
                hh = h.length
                while (hh < aa) {
                    // h[hh]=a[hh]*h[hh-1]+h[hh-2]
                    h[hh] = hpadd(h[hh - 2], hpmul(a[hh], h[hh - 1]))
                    hh++
                }
                hhh = '' + h[n - 1]
                vprint('hhh')
                hhhh = 0
                while (hhh.length > 0) {
                    hhh1 = Number(hhh.slice(0, 1))
                    hhh = hhh.slice(1)
                    hhhh += hhh1
                    print(hhh1, hhhh, ' ')
                }
                print()
                print('****', hhhh)
            }
            // ------------------------------------------------------- */
            function eu102() {
                print('102 - Triangle containment')
                p = [
                    [0, 5, 4, 0, 5, 0],
                    [-1, -1, -1, 3, 1, 5],
                    [-1, -1, -1, 2, 2, -1],
                    [-153, -910, 835, -947, -340, 495],
                    [-175, 41, -421, -714, 574, -645]
                ]

                function sss(a, b, c) {
                    // find d = intersection of a-0 and b-c
                    // return a0 < ad
                    // y = mx +b = a1*x/a0; x=b/(a1/a0 - m)
                    print('*** abc  ', a, b, c)
                    line(b, c)
                    print(line(b, c))
                    bcs = abs(slope()) == Infinity
                    if ((bcs && a[0] == 0) || (a[0] * slope() == a[1])) return false
                    if (bcs) {
                        d0 = b[0];
                        d1 = a[1] * d0 / a[0]
                    } else if (a[0] == 0) {
                        d0 = 0;
                        d1 = yval(0)
                    } else {
                        d0 = a[0] * yval(0) / (a[1] - a[0] * slope());
                        d1 = a[1] * d0 / a[0]
                    }
                    // print(a,b,c,d0,d1)
                    // print(dist( a,[d0,d1]),dist(a,[0,0]))
                    return (dist(a, [d0, d1]) > dist(a, [0, 0]))
                }

                function ttt(p) {
                    a = [p[0], p[1]]
                    b = [p[2], p[3]]
                    c = [p[4], p[5]]
                    return sss(a, b, c) && sss(b, c, a) && sss(c, a, b)
                }

                yess = 0
                for (var i = 0; i < p.length; i++) {
                    yes = ttt(p[i])
                    if (yes) yess++
                    print('******* ', yes)
                }
                print('*****************', yess)
            }
            // ------------------------------------------------------- */
            function eu() {
                print('ouch - not loaded yet ')
            }
            // #1. 233168 #2. 4613732 #3. 6857 #4. 906609 #5. 232792560 #6. 25164150 #7. 104743 #8. 23514624000 #9. 31875000 #10. 142913828922 #11. 70600674 #12. 76576500 #13. 5537376230 #14. 837799 #15. 137846528820 #16. 1366 #17. 21124 #18. 1074 #19. 171 #20. 648 #21. 31626 #22. 871198282 #23. 4179871 #24. 2783915460 #25. 4782 #26. 983 #27. -59231 #28. 669171001 #29. 9183 #30. 443839 #31. 73682 #32. 45228 #33. 100 #34. 40730 #35. 55 #36. 872187 #37. 748317 #38. 932718654 #39. 840 #40. 210 #41. 7652413 #42. 162 #43. 16695334890 #44. 5482660 #45. 1533776805 #46. 5777 #47. 134043 #48. 9110846700 #49. 296962999629 #50. 997651 #51. 121313 #52. 142857 #53. 4075 #54. 376 #55. 249 #56. 972 #57. 153 #58. 26241 #59. 107359 #60. 26033 #61. 28684 #62. 127035954683 #63. 49 #64. 1322 #65. 272 #66. 661 #67. 7273 #68. 6531031914842725 #69. 510510 #70. 8319823 #71. 428570 #72. 303963552391 #73. 7295372 #74. 402 #75. 161667 #76. 190569291 #77. 71 #78. 55374 #79. 73162890 #80. 40886 #81. 427337 #82. 260324 #83. 425185 #84. 101524 #85. 2772 #86. 1818 #87. 1097343 #88. 7587457 #89. 743 #90. 1217 #91. 14234 #92. 8581146 #93. 1258 #94. 518408346 #95. 14316 #96. 24702 #97. 8739992577 #98. 18769 #99. 709 #100. 756872327473 #101. 37076114526 #102. 228 #103. 20313839404245 #104. 329468 #105. 73702 #106. 21384 #107. 259679 #108. 180180 #109. 38182 #110. 9350130049860600 #111. 612407567715 #112. 1587000 #113. 51161058134250 #114. 16475640049 #115. 168 #116. 20492570929 #117. 100808458960497 #118. 44680 #119. 248155780267521 #120. 333082500 #121. 2269 #122. 1582 #123. 21035 #124. 21417 #125. 2906969179 #126. 18522 #127. 18407904 #128. 14516824220 #129. 1000023 #130. 149253 #131. 173 #132. 843296 #133. 453647705 #134. 18613426663617118 #135. 4989 #136. 2544559 #137. 1120149658760 #138. 1118049290473932 #139. 10057761 #140. 5673835352990 #141. 878454337159 #142. 1006193 #143. 30758397 #144. 354 #145. 608720 #146. 676333270 #147. 846910284 #148. 2129970655314432 #149. 52852124 #150. -271248680 #151. 0.464399 #152. 301 #153. 17971254122360635 #154. 479742450 #155. 3857447 #156. 21295121502550 #157. 53490 #158. 409511334375 #159. 14489159 #160. 16576 #161. 20574308184277971 #162. 3D58725572C62302 #163. 343047 #164. 378158756814587 #165. 2868868 #166. 7130034 #167. 3916160068885 #168. 59206 #169. 178653872807 #170. 9857164023 #171. 142989277 #172. 227485267000992000 #173. 1572729 #174. 209566 #175. 1,13717420,8 #176. 96818198400000 #177. 129325 #178. 126461847755 #179. 986262 #180. 285196020571078987 #181. 83735848679360680 #182. 399788195976 #183. 48861552 #184. 1725323624056 #185. 4640261571849533 #186. 2325629 #187. 17427258 #188. 95962097 #189. 10834893628237824 #190. 371048281 #191. 1918080160 #192. 57060635927998347 #193. 684465067343069 #194. 61190912 #195. 75085391 #196. 322303240771079935 #197. 1.710637717 #198. 52374425 #199. 0.00396087 #200. 229161792008 #201. 115039000 #202. 1209002624 #203. 34029210557338 #204. 2944730 #205. 0.5731441 #206. 1389019170 #207. 44043947822 #208. 331951449665644800 #209. 15964587728784 #210. 1598174770174689458 #211. 1922364685 #212. 328968937309 #213. 330.721154 #214. 1677366278943 #215. 806844323190414 #216. 5437849 #217. 6273134 #218. 0 #219. 64564225042 #220. 139776,963904 #221. 1884161251122450 #222. 1590933 #223. 61614848 #224. 4137330 #225. 2009 #226. 0.11316017 #227. 3780.618622 #228. 86226 #229. 11325263 #230. 850481152593119296 #231. 7526965179680 #232. 0.83648556 #233. 271204031455541309 #234. 1259187438574927161 #235. 1.002322108633 #236. 123/59 #237. 15836928 #238. 9922545104535661 #239. 0.001887854841 #240. 7448717393364181966 #241. 482316491800641154 #242. 997104142249036713 #243. 892371480 #244. 96356848 #245. 288084712410001 #246. 810834388 #247. 782252 #248. 23507044290 #249. 9275262564250418 #250. 1425480602091519 #251. 18946051 #252. 104924.0 #253. 11.492847 #254. 8184523820510 #255. 4.4474011180 #256. 85765680 #257. 139012411 #258. 12747994 #259. 20101196798 #260. 167542057 #261. 238890850232021 #262. 2531.205 #263. 2039506520 #264. 2816417.1055 #265. 209110240768 #266. 1096883702440585 #267. 0.999992836187 #268. 785478606870985 #269. 1311109198529286 #270. 82282080 #271. 4617456485273129588 #272. 8495585919506151122 #273. 2032447591196869022 #274. 1601912348822 #275. 15030564 #276. 5777137137739632912 #277. 1125977393124310 #278. 1228215747273908452 #279. 416577688 #280. 430.088247 #281. 1485776387445623 #282. 1098988351 #283. 28038042525570324 #284. 5a411d7b #285. 157055.80999 #286. 52.6494571953 #287. 313135496 #288. 605857431263981935 #289. 6567944538 #290. 20444710234716473 #291. 4037526 #292. 3600060866 #293. 2209 #294. 789184709 #295. 4884650818 #296. 1137208419 #297. 2252639041804718029 #298. 1.76882294 #299. 549936643 #300. 8.0540771484375 #301. 2178309 #302. 1170060 #303. 1111981904675169 #304. 283988410192 #305. 18174995535140 #306. 852938 #307. 0.7311720251 #308. 1539669807660924 #309. 210139 #310. 2586528661783 #311. 2466018557 #312. 324681947 #313. 2057774861813004 #314. 132.52756426 #315. 13625242 #316. 542934735751917735 #317. 1856532.8455 #318. 709313889 #319. 268457129 #320. 278157919195482643 #321. 2470433131948040 #322. 999998760323313995 #323. 6.3551758451 #324. 96972774 #325. 54672965 #326. 1966666166408794329 #327. 34315549139516 #328. 260511850222 #329. 199740353/29386561536000 #330. 15955822 #331. 467178235146843549 #332. 2717.751525 #333. 3053105 #334. 150320021261690835 #335. 5032316 #336. CAGBIHEFJDK #337. 85068035 #338. 15614292 #339. 19823.542204 #340. 291504964 #341. 56098610614277014 #342. 5943040885644 #343. 269533451410884183 #344. 65579304332 #345. 13938 #346. 336108797689259276 #347. 11109800204052 #348. 1004195061 #349. 115384615384614952 #350. 84664213 #351. 11762187201804552 #352. 378563.260589 #353. 1.2759860331 #354. 58065134 #355. 1726545007 #356. 28010159 #357. 1739023853137 #358. 3284144505 #359. 40632119 #360. 878825614395267072 #361. 178476944 #362. 457895958010 #363. 0.0000372091 #364. 44855254 #365. 162619462356610313 #366. 88351299 #367. 48271207 #368. 253.6135092068 #369. 862400558448 #370. 41791929448408 #371. 40.66368097 #372. 301450082318807027 #373. 727227472448913 #374. 334420941 #375. 7435327983715286168 #376. 973059630185670 #377. 732385277 #378. 147534623725724718 #379. 132314136838185 #380. 6.3202e25093 #381. 139602943319822 #382. 697003956 #383. 22173624649806 #384. 3354706415856332783 #385. 3776957309612153700 #386. 528755790 #387. 696067597313468 #388. 831907372805129931 #389. 2406376.3623 #390. 2919133642971 #391. 61029882288 #392. 3.1486734435 #393. 112398351350823112 #394. 3.2370342194 #395. 28.2453753155 #396. 173214653 #397. 141630459461893728 #398. 2010.59096 #399. 1508395636674243,6.5e27330467 #400. 438505383468410633 #401. 281632621 #402. 356019862 #403. 18224771 #404. 1199215615081353 #405. 237696125 #406. 36813.12757207 #407. 39782849136421 #408. 299742733 #409. 253223948 #410. 799999783589946560 #411. 9936352 #412. 38788800 #413. 3079418648040719 #414. 552506775824935461 #415. 55859742 #416. 898082747 #417. 446572970925740 #418. 1177163565297340320 #419. 998567458,1046245404,43363922 #420. 145159332 #421. 2304215802083466198 #422. 92060460 #423. 653972374 #424. 1059760019628 #425. 46479497324 #426. 31591886008 #427. 97138867 #428. 747215561862 #429. 98792821 #430. 5000624921.38 #431. 23.386029052 #432. 754862080 #433. 326624372659664 #434. 863253606 #435. 252541322550 #436. 0.5276662759 #437. 74204709657207 #438. 2046409616809 #439. 968697378 #440. 970746056 #441. 5000088.8395 #442. 1295552661530920149 #443. 2744233049300770 #444. 1.200856722e263 #445. 659104042 #446. 907803852 #447. 530553372 #448. 106467648 #449. 103.37870096 #450. 583333163984220940 #451. 153651073760956 #452. 345558983 #453. 104354107 #454. 5435004633092 #455. 450186511399999 #456. 333333208685971546 #457. 2647787126797397063 #458. 423341841 #459. 3996390106631 #460. 18.420738199 #461. 159820276 #462. 5.5350769703e1512 #463. 808981553 #464. 198775297232878 #465. 585965659 #466. 258381958195474745 #467. 775181359 #468. 852950321 #469. 0.56766764161831 #470. 147668794 #471. 1.895093981e31 #472. 73811586 #473. 35856681704365 #474. 9690646731515010 #475. 75780067 #476. 110242.87794
        </script>
    </div>
</body>

</html>