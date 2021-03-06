<!DOCTYPE html>
<html lang="en">

<head>
    <title>About The Wright College Smart Calculator</title>
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/articlestyles.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('nav.html'); ?>
    <div id="whycontainer">
        <div class="artmenu" id="foreword">
            <a href="index.php"><img class="artmenuheader" src="assets/calcheader.png"></a>
            <h2>Foreword</h2>
            <p>I would like to begin by thanking the students who helped me with this project. It started out as programming assignments for students in Engineering 190, Introduction to Programming for Engineers. Subsequently I asked students in Math 99, 118, 125 and 140 to use the calculators and provide us with feedback. Students had complained that the Math curriculum spends too much time teaching process instead of concept and teaching archaic skills such as looking up cumulative distribution function values in a table. Both of these issues are eliminated by using a smart calculator.</p>
            <p>The programs are written in Javascript instead of some other programming language like Python, C++ or Java because it is currently the most universal language. It works on every O/S from Windows to Linux to MAC to Android. All it needs is a browser like IE or Safari or FireFox or Chrome or Opera. It doesn't matter whether you are using a desktop, a laptop, a netbook, a pad or a smart phone. Students don't have to install any software. They can be writing working programs from the very first class meeting. </p>
        </div>


        <div class="artmenu">
            <h2>The Power of Smart Calculators</h2>
            <p>Some of us think Mathematics is the most beautiful subject in the world. For the rest, Math is not an end in itself. At worst it is an unnecessary impediment keeping students from getting a degree. At best it is a tool for finding answers. As such, we should be teaching our students the latest advances in technology and thereby leverage their ability to solve problems. For most people the benefits of the intellectual exercise associated with doing calculations by hand is far outweighed by the improved speed and accuracy of a technology based solution. A quill pen might be more visually pleasing for calligraphy, but a simple ball point pen is much more practical. Students benefit more from learning how to arrive at solutions using advanced technology than from memorizing arcane procedures from the dark ages. The purpose of my presentation is to introduce technology that is easily accessible and not all that difficult to use.</p>&nbsp;
            <h2>Progression of Technology</h2>
            <p>So, let's look at a typical "math" problem. Let's find the square root of 2.759 using various forms of Math Technology starting with the tools used in 1950. Notice that the tools used in 1950 and 1970 have already been deprecated; they are no longer being taught. What we need to do is to move past the 1990 technology that is now in use and take advantage of technology introduced in the current millennium.</p>
            <ul>
                <li><a href="#about1950">1950:</a> Manual calculations and slide rules</li>
                <li><a href="#about1970">1970:</a> Four function calculators</li>
                <li><a href="#about1990">1990:</a> Scientific calculators</li>
                <li><a href="#about2010">2010:</a> Smart calculators</li>
            </ul>

            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu" id="about1950">
            <h2>1950: Manual calculations</h2>
            <img border="0" vspace="10" hspace="10" src="pencil.jpg" width="200" height="" alt="pencil" title="pencil" style="float:right" />
            <ul>
                <li><a href="squareroot.php?2.759" target="julius">Square Roots</a><br> using (a+b)² = a² + 2ab + b² we can calculate √2.759 like this:
                    <pre>     <u>  1. 6  6  1  0  2  3  7  8</u>
    √ 02.75 90 00 00 00 00 00 00
1×1= <u> 01</u>
26    01 75
×6=  <u> 01 56</u>
326      19 90
×6=     <u> 19 56</u>
3321        34 00
×1=        <u> 33 21</u>
33220          79 00
×0=           <u>    00</u>
332202         79 00 00
×2=           <u> 66 44 04</u>
3322043        12 55 96 00
×3=           <u> 09 96 61 29</u>
33220467       02 59 34 71 00
×7=           <u> 02 32 54 32 69</u>
332204748         26 80 38 31 00
×8=              <u> 26 57 63 79 84</u></pre>
                </li>
                <li><a href="calc.php?log(2.76)/2;10^0.2204" target="julius">Base Ten Logarithms</a> We needed to look them up in tables:<br>
                    0.3010, 0.4771, 0.6021, 0.6990, 0.7782, 0.8451, 0.9031, 0.9542</li>
                log(2.76) = 0.4409; 0.4409/2 = 0.22045; antilog(0.2204) = 1.661<br><br>
                <li><a href="calc.php?x=0.4409/0.4343;e^(x/2)" target="julius">Natural Logarithms</a> were calculated by using: ln(x) = log(x) ÷ log(<i>e</i>)<br>
                    ln(2.76) = 0.4409 ÷ 0.4343 = 1.0152<br>
                    1.0152/2= 0.5076; <i>e</i>^0.5076= 1.661</li>
            </ul>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu">
            <h2>1950: Using a Slide Rule</h2>
            <img src="sliderule.jpg" width="" height="" alt="sliderule" title="sliderule" style="display:block;margin-left:auto;margin-right:auto" />

            <p>A slide rule is a mechanical analog computer. Typically it gives a precision of two significant figures, and the user estimates the third figure. Some high-end slide rules have magnifier cursors that give more significant digits.<br>Each scale gives the results for various calculations. In this picture we set the start of the C scale to the value 1.39 on the D scale and we can read out six values under the cursor. The value is an eye-ball estimate based on the two marks to the either side of the cursor on the scale.</p>

            <p>Scale is calculation : Mark 1 &lt; value &lt; Mark 2</p>
            <ul>
                <li>K is D³ : 4.5 &lt; 4.583 &lt; 4.7</li>
                <li>A is D² : 2.7 &lt; 2.759 &lt; 2.8</li>
                <li>B is C² : 1.4 &lt; 1.428 &lt; 1.45</li>
                <li>CI is 1÷C : 0.84 > 0.8368 > 0.83</li>
                <li>C is value : 1.18 &lt; 1.195 &lt; 1.20</li>
                <li>D is 1.39 × C : 1.64 &lt; 1.661 &lt; 1.68</li>
            </ul>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu" id="about1970">
            <h2>1970: Four function calculators</h2>
            <img alt="4 function" title="4 function" />

            <p>Four function calculators such as the TI Datamath made it possible to multiply and divide many more digits than a slide rule could. They were not programmed to take square roots, but there were tricks one could use to find the square root, such as Newton's formula x = (x • x + N)/(2x).</p>
            <p>To take the square root of N you would pick some initial guess for x and apply the formula over and over again until successive values of x were close to each other. Typically two or three iterations give an accurate result.</p>
            <p><a href="calc.php?N=2.759;x=2;y=x*x;y=y+N;y=y/2;x=y/x;x=(x*x+N)/2/x;x=(x*x+N)/2/x;x=(x*x+N)/2/x;x^2" target="julius">Example:</a> to take the square root of N = 2.759</p>
            <ol>
                <li>First step, start with any random value for x, like x = 2<ul>
                        <li>
                            times x = 4</li>
                        <li>
                            plus N = 6.759</li>
                        <li>
                            divide by 2 = 3.3795</li>
                        <li>
                            divide by x = 1.68975</li>
                    </ul>
                    so we get: x = 1.68975</li>
                <li>
                    repeat: x = 1.6612679575380973</li>
                <li>
                    again: x = 1.6610237986294998</li>
                <li>
                    and finally: x = 1.6610237806846717</li>
            </ol>
            then, to verify the answer:
            1.6610237806846717² = 2.7590000000000003
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu" id="about1990">
            <h2>1990: Scientific calculators</h2>
            <p>Wow! It's like we had died and gone to Heaven! One push of the button and we get incredible precision.</p>
            <a href="../graduate/CASIO.fx115ms.HTM" target="julius"><img src="../graduate/fx115.jpg" alt="Casio calculator" title="Casio calculator" /></a>
            <p>Scientific calculators were soon followed by graphing calculators and programmable calculators. </p>
            <p>However, for whatever reason, the Math curriculum is currently stuck here. Sure, these calculators can do a lot for you, but they are not easy to use and they waste valuable keyboard space on some fairly useless functions like base ten logarithms. Math courses have not yet graduated to the next step by using smart calculators with an intuitive interface.</p>
            <p>Smart calculators can do all of the things scientific calculators can do:</p>
            <p><a href="calc.php?sqrt(2.759)" target="julius">√(2.759) =</a> 1.6610237806846715</p>
            <p><a href="calc.php?log(2.759)" target="julius">log(2.759) =</a> 0.44075170047918544</p>
            <p><a href="calc.php?ln(2.759)" target="julius">ln(2.759) =</a> 1.014868295235149</p>
            <p>But they can do so much more. Let's take a look at some of these capabilities.</p>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu" id="about2010">
            <h2><big>2010: Smart calculators</big></h2>
            <h2>What makes them so smart</h2>
            <p>All of us use smart software. Anytime you want a computer to do something for you without you having to tell it how it is to be done, you are using smart software. For example, you are using smart software when you use a GUI (Graphical User Interface) to click on an icon instead of entering a command line. Other examples are when you use a search engine to find something when you aren't too sure what you are looking for, or when your word processor checks your spelling as you are typing, or when gmail offers to look up an address in an incoming email. Software like Wolfram Alpha tries to anticipate what you are looking for and will tell you everything it knows relating to any topic. So when you ask it about
                <a href="http://www.wolframalpha.com/input/?i=the+root+of+all+evil&t=elg01" target="julius"> "the root of all evil"</a> it will tell you:</p>
            <p><i>Assuming the input is the phrase instead of the television series or a music album or a music work then "the root of all evil" ...is the love of money.
                    (The quote "Money is the root of all evil" is misattributed to Jesus Christ; it was actually stated as "The love of money is the root of all evil" by the Apostle Paul in his letter to Timothy in 1 Timothy 6:10.)</i></p>
            <p>Smart software tries to be helpful by telling you everything it knows instead of having you specify what information you need. So let's look at some of the things that a smart calculator like the Wright Calculator can do for you.</p> &nbsp;
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu">
            <h2 style="text-align:center;"><big>2010: Smart calculators</big><br>Linear Equations</h2>
            <p>Linear relationships are the foundations of mathematical modeling. It is important to understand the equivalence of various representations. The actual process of converting between them can be handled automatically by a calculator the same way it finds a square root.</p>

            <pre><strong>&#8226;</strong> Standard form ax+by=c & slope intercept y=mx+b
<strong>input</strong>
6x-3y=15
<a href="simplify.php?6x-3y=15" target="julius"><strong>result</strong></a> 
Linear equation: y =  2x -5
slope= 2; y intercept= -5; x intercept= 5/2

<strong>&#8226;</strong> Table of values
<strong>input</strong>
2x -5
<a href="plot.php?2x-5&-2&18" target="julius"><strong>result</strong></a> 
(-2.0, -9.0000)
(-1.0, -7.0000)
(0.00, -5.0000)
(1.00, -3.0000)
(2.00, -1.0000)
(3.00,  1.0000)

<strong>&#8226;</strong> Least squares linear regression
<strong>input</strong>
(-2, -9), (-1, -7), (0, -5), (1, -3), (2, -1), (3, 1)
<a href="regress.php? & & &(-2, -9), (-1, -7), (0, -5), (1, -3), (2, -1), (3, 1)" target="julius"><strong>result</strong></a> 
n= 6; &Sigma;x= 3; &Sigma;x&sup2;= 19; &Sigma;y= -24; &Sigma;xy = 23
Linear regression: y =  2x -5; r^2=1.000
</pre>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu">
            <h2 style="text-align:center;"><big>2010: Smart calculators</big><br>Quadratics &amp; Parabolas</h2>
            <p>Quadratic relations are more robust than linear relations and introduce new concepts such as factoring, the fundamental theorem of algebra, and symmetry. You can count on the calculator to do the work.</p>
            <pre>
<b>input</b>
 (x-2)(x+3)=14

<a href="parabola.php?(x-2)(x+3)=14" target="julius"><b>result</b></a> 
 Quadratic formula: 
   X = (-b ±√(b²-4ac))/(2a) = ( -1±√( 1 +80))/( 2)
   positive discriminant = 81; two real roots: X=-5 and 4

 Standard form: 
   a(X-h)²+k = ( X² +X +1/4) -1/4 -20 =  (X +1/2)² -81/4
   X =  -1/2 ±√( 81/4) = -5, or 4

 Axis of symmetry: X= -1/2; 
 Vertex (minimum)=(h,k)=( -1/2, -81/4); 
 y-intercept is (0,-20)
 p=1/4a; 
 Focus: (h,k+p)=( -1/2, -20); 
 Directrix: y=k-p=-20.5000
 Latus: ( -1, -20) to ( 0, -20); 
 Focal Diameter: 1

 Factors: ( X -4)( X +5)</pre>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu">
            <h2 style="text-align:center;"><big>2010: Smart calculators</big><br>Simplify or solve polynomials</h2>
            <pre><strong>input</strong>
x²=2.759

<a href="simplify.php?x²=2.759" target="julius"><strong>result</strong></a>
x^2 -2.759 = 0<br>Quadratic equation: x = -4121/2481 & x = 4121/2481
<a href="graphs.php?x:-3%20to%203;y:%20-1%20to%206;y=x^2;y=2.759;x=sqrt(2.759)" target="julius"><strong>graph</strong></a> 

<strong>input</strong>
 (x-2)(x+3)=14

<a href="simplify.php?(x-2)(x+3)=14" target="julius"><strong>result</strong></a>
 x^2 +3x -2x -6 =  14
 x^2 +x -6 =  14
 x^2 +x = 20
 x^2 +x -20 = 0
 Quadratic equation: x = -5 & x = 4

<strong>input</strong>
 2(3x+y)=4px+m ; x

<a href="simplify.php?2(3x+y)=4px+m" target="julius"><strong>result</strong></a>
 6x +2y =  4px +m
 6x +2y =  m +4px
 -m -4px +6x +2y = 0
 x=( m -2y)/( -4p +6)
</pre>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu">
            <h2 style="text-align:center;"><big>2010: Smart calculators</big><br>Systems of Linear Equations</h2>
            <strong>input</strong>
            <p>x/3+0y=4z</p>
            <p>y/2+15=z</p>
            <p>z=21+y</p>

            <p><a href="linear.php?x/3+0y-4z=0;y/2+15=z;z=21+y" target="julius"><strong>result</strong></a></p>
            <p>Standard form: 1/3x-4z=0; 1/2y-z=-15; -y+z=21</p>
            <p>Solution: x = 108; y = -12; z = 9; </p>
            <p> (x, y, z) = (108, -12, 9)</p>

            <p>Inverse of coefficient matrix:</p>
            <p>3, -24, -12 </p>
            <p>0, -2, -2 </p>
            <p>0, -2, -1 </p>

            <p>Cramer's rule:</p>
            <p>x= -18 ÷ (-1/6)= 108; y= 2 ÷ (-1/6)= -12; z= -1.5 ÷ (-1/6)= 9</p>

            <p>Gauss-Jordan elimination:</p>
            <p>1/3, 0, -4, 0</p>
            <p>0, 1/2, -1, -15</p>
            <p>0, -1, 1, 21</p>
            <p>-----------------------</p>
            <p>1/3, 0, -4, 0</p>
            <p>0, 1/2, -1, -15</p>
            <p>0, -1, 1, 21</p>
            <p>-----------------------</p>
            <p>1/3, 0, -4, 0</p>
            <p>0, 1/2, -1, -15</p>
            <p>0, 0, -1, -9</p>
            <p>-----------------------</p>
            <p>1/3, 0, 0, 36</p>
            <p>0, 1/2, 0, -6</p>
            <p>0, 0, -1, -9</p>
            <p>-----------------------</p>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu">
            <h2 style="text-align:center;"><big>2010: Smart calculators</big><br>Triangles &amp; Trigonometry</h2>
            <p>The Calculator takes a combination of sides and angles and gives you all kinds of information about the triangle:<strong>input</strong> sas: 32, 90°, 45</p>

            <a href="triangle.php?sas:%2032,%2090%C2%B0,%2045" target="julius"><strong>result</strong></a>
            <p>sas: Cosine Law: b² = a² + c² - 2ac cos(B)</p>
            <p>sides (a,b,c): 32, 45, 55.2178</p>
            <p>angles (A,B,C): 35.4171°, 54.5829°, 90°</p>
            <p>is a right scalene triangle</p>
            <p>area: 720 perimeter: 132.2178</p>

            <p>or</p>
            <p><strong>input</strong></p>
            <p>A=33°, a=4, b=5</p>

            <a href="triangle.php?A=33%C2%B0,%20a=4,%20b=5" target="julius"><strong>result</strong></a>
            <p>ssa: Sine Law: Sin(A)/a = Sin(B)/b</p>
            <p>sides (a,b,c): 4, 5, 7.1232</p>
            <p>angles (A,B,C): 33°, 42.9061°, 104.0939°</p>
            <p>is an obtuse scalene triangle</p>
            <p>area: 9.699 perimeter: 16.1232</p>

            <p>*** Second solution:</p>
            <p>sides (a,b,c): 4, 5, 1.2635</p>
            <p>angles (A,B,C): 33°, 137.0939°, 9.9061°</p>
            <p>is an obtuse scalene triangle</p>
            <p>area: 1.7203 perimeter: 10.2635</p>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu">
            <h2><big>2010: Smart calculators</big><br> Systems of Transcendental Equations</h2>
            <p>Students taking physics, chemistry and other science classes are often expected to find solutions for equations involving transcendental functions. For example a student may need to find all the values of x for which <em>e</em><sup>x/4</sup> is equal to 4cos(x)+5. Using the <strong>Wright College Smart Calculator</strong> you could graph both of these functions and locate the points where they are equal, like this:</p>
            <p><strong>input:</strong> x:0 to 14;y:-2 to 13;e^(x/4);4cos(x)+5 to get the <a href="graphs.php?x:0 to 14;y:-2 to 13;e^(x/4);4cos(x)+5" target="julius"><strong>result</strong></a></p>
            <p>or you could graph the difference between the two functions and see where the difference is equal to zero:</p>
            <p><strong>input:</strong> x:0 to 14;y:-8 to 49;e^(x/4)-(4cos(x)+5) to get the <a href="graphs.php?x:0 to 14;y:-8 to 49;e^(x/4)-(4cos(x)+5)" target="julius"><strong>result</strong></a> </p>
            <p>In either case, with the <strong>Wright College Smart Calculator</strong> you would need to zero in on the intersection point to see where it might be. A more sophisticated smart calculator such as <a href="http://www.wolframalpha.com/input/?i=e%5E%28x%2F4%29-%284cos%28x%29%2B5%29">Wolfram alpha</a> will not only give you several graphs, but it will also suggest alternate forms for both real and imaginary values of x, the three numerical roots, the domain of the function, the Taylor series expansion at x=0 (also known as a Maclaurin series), the derivative, the indefinite integral, differential geometric curves, differential equation solution curve families and on and on, all without asking. All we have to teach our students is what this means and how to interpret it. No, they do not have to know how to "do it by hand."</p>
            <p>The <strong>Wright College Smart Calculator</strong> can also do some of this for you. For example, although it takes more effort, a student can be shown how numerical roots can be gotten via the Newton Ralphson calculator:</p>
            <p><strong>input:</strong> e^(X/4)-(4*cos(X)+5);2;4;7 to get the <a href="newton.php?e^(X/4)-(4*cos(X)+5);2;4;7" target="julius"><strong>result</strong></a></p>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div class="artmenu">
            <h2>The End</h2>
            <p>I hope you enjoyed the explanation of where these calculators came from. You are more than welcome to use them to solve your Math Problems. </p>
            <p>If you are interested in learning about programming, you can use your browser to look at the source code. It's all there. There are two types of instructions on each page. There is HTML code and there is JAVASCRIPT code, which is identified by an HTML &lt;script&gt; tag. I am sure you will be able to figure it out. </p>
            <p>My wish for you is to <strong>enjoy life and have fun</strong>.</p>
            <p>Or, in my language: Azt kívánom, hogy <strong>élvezze az életet, és jól szórakozzon</strong></p>
            <p>Or as Google translator would say:</p>
            <p>Dorința mea pentru tine este să <strong>se bucure de viață și să se distreze.</strong></p>
            <p>Il mio augurio per voi è <strong>quello di godersi la vita e divertirsi</strong></p>
            <p>Is é mo mhian chun tú <strong>taitneamh a bhaint as an saol agus spraoi a bheith agat</strong></p>
            <p>Keinginan saya untuk Anda adalah untuk menikmati hidup dan bersenang-senang</p>
            <p>Kuv xav rau koj yog txaus siab lub neej thiab muaj kev lom zem</p>
            <p>Mauris volo atque frui anima videtur tibi est</p>
            <p>Mé přání pro vás je užívat života a bavit se</p>
            <p>Mein Wunsch für Sie ist, das <strong>Leben genießen und Spaß haben</strong></p>
            <p>Mi deseo para ti es <strong>disfrutar la vida y divertirse</strong></p>
            <p>Min önskan för dig är att njuta av livet och ha kul</p>
            <p>Moim życzeniem dla was jest cieszyć się życiem i bawić</p>
            <p>Moja želja za tebe je da uživate u životu i zabavi</p>
            <p>Moje želanie pre vás je užívať život a baviť sa</p>
            <p>Mon souhait pour vous est de <strong>profiter de la vie et s'amuser</strong></p>
            <p>Toivon sinulle on nauttia elämästä ja pitää hauskaa</p>
            <p>Η ευχή μου για σας είναι <strong>να απολαμβάνουν τη ζωή και να διασκεδάσουν</strong></p>
            <p>Dëshira ime për ju është që të <strong>gëzojnë jetën dhe . . .</strong></p>
            <a href="#foreword" class="backToTop">Back to Top</a>
        </div>


        <div><a href="mailto:jnadas@ccc.edu"> jnadas@ccc.edu </a></div>
    </div>
</body>

</html>