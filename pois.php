<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <title>Pois</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta charset="utf-8">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body>
    <script src="myfunctions.js"></script>
    <script>
        // ---------------------------------------------------
        // Multi test
        varY = 0;
        varN = 0
        // ---------------------------------------------------
        function calc1() {
            with(Math) {
                var t = 0
                while (p(t, document.theForm.VarD.value) < document.theForm.VarP.value) t++
                document.theForm.VarW.value = t + 1
            }
        }
        // ---------------------------------------------------
        function calc2() {
            with(Math) {
                var t = 1
                while (p(document.theForm.VarW.value, t) < document.theForm.VarP.value) t++
                document.theForm.VarD.value = t
            }
        }
        // ---------------------------------------------------
        function calc3() {
            with(Math) {
                document.theForm.VarP.value = p(Number(document.theForm.VarW.value) - 1, document.theForm.VarD.value)
            }
        }
        // ---------------------------------------------------
        function calc4N() {
            with(Math) {
                if (varN < 1) return
                document.theForm.VarP.value = varN;
                var t = 0
                while (p(t, document.theForm.VarD.value) < document.theForm.VarP.value) t++
                document.theForm.VarW.value = t + 1
            }
        }
        // ---------------------------------------------------
        function calc4Y() {
            with(Math) {
                document.theForm.VarP.value = varY
                var d = Number(document.theForm.VarD.value) - 1
                if (d < 1) {
                    document.theForm.VarW.value = 0;
                    document.theForm.VarD.value = 0;
                    return
                }
                document.theForm.VarD.value = d
                var t = 0
                if (varY > 0)
                    while (p(t, document.theForm.VarD.value) < varY) t++
                document.theForm.VarW.value = t + 1
            }
        }
        // ---------------------------------------------------
        function p(w, d) {
            w = Number(w);
            d = Number(d)
            if (d < 0) return 0;
            else if (d == 0) return 1;
            else if (d == 1) return w + 2
            if (w < 0) return 0;
            if (w == 0) return Math.pow(2, d)
            var t = 0;
            for (var i = 0; i <= d; i++) {
                t += p(w - 1, i) * ncr(d, i)
            }
            return t
        }
        // ---------------------------------------------------
        // Single test
        SvarY = 0;
        SvarN = 0
        // ---------------------------------------------------
        function Scalc1() {
            with(Math) {
                var t = 0
                while (Sp(t, document.theSForm.SVarD.value) < document.theSForm.SVarP.value) t++
                document.theSForm.SVarW.value = t + 1
            }
        }
        // ---------------------------------------------------
        function Scalc2() {
            with(Math) {
                var t = 1
                while (Sp(document.theSForm.SVarW.value, t) < document.theSForm.SVarP.value) t++
                document.theSForm.SVarD.value = t
            }
        }
        // ---------------------------------------------------
        function Scalc3() {
            with(Math) {
                document.theSForm.SVarP.value = Sp(Number(document.theSForm.SVarW.value) - 1, document.theSForm.SVarD.value)
            }
        }
        // ---------------------------------------------------
        function Scalc4N() {
            with(Math) {
                if (SvarN < 1) return
                document.theSForm.SVarP.value = SvarN;
                var t = 0
                while (Sp(t, document.theSForm.SVarD.value) < document.theSForm.SVarP.value) t++
                document.theSForm.SVarW.value = t + 1
            }
        }
        // ---------------------------------------------------
        function Scalc4Y() {
            with(Math) {
                document.theSForm.SVarP.value = SvarY
                var d = Number(document.theSForm.SVarD.value) - 1
                if (d < 1) {
                    document.theSForm.SVarW.value = 0;
                    document.theSForm.SVarD.value = 0;
                    return
                }
                document.theSForm.SVarD.value = d
                var t = 0
                if (SvarY > 0)
                    while (Sp(t, document.theSForm.SVarD.value) < SvarY) t++
                document.theSForm.SVarW.value = t + 1
            }
        }
        // ---------------------------------------------------
        function Sp(w, d) {
            w = Number(w);
            d = Number(d)
            if (d < 0) return 0;
            else if (d == 0) return 1;
            else if (d == 1) return w + 2
            if (w < 0) return 1;
            if (w == 0) return d + 1
            return d * Sp(w - 1, d - 1) + Sp(w - 1, d)
        }
        // ---------------------------------------------------
        function illus() {
            var d = Number(document.theForm.VarD.value)
            var w = Number(document.theForm.VarW.value)
            var t = p(w - 2, d - 1)
            var n = Number(document.theForm.VarP.value)
            var u = n - t * d
            if (n < 2) {
                theForm.SVar.value = "You have found the poison container";
                return
            }
            if (u < 0) u = 0
            theForm.SVar.value = "You need to test " + d + " batches of " + t + "\n leaving " + u + " untested containers."
            varY = t;
            varN = u

            var d = Number(document.theSForm.SVarD.value)
            var w = Number(document.theSForm.SVarW.value)
            var t = Sp(w - 2, d - 1)
            var n = Number(document.theSForm.SVarP.value)
            var u = n - t * d
            if (n < 2) {
                theSForm.SVar.value = "You have found the poison container";
                return
            }
            if (u < 0) u = 0
            theSForm.SVar.value = "You need to test " + d + " batches of " + t + "\n leaving " + u + " untested containers."
            SvarY = t;
            SvarN = u
        }
    </script>
    <?php include('nav.html'); ?> <div class="calcmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheaderlight.png"></a>
<a href="pois.pdf" target="_blank">Explanation	</a>
<h2>Multi-test</h2>
<form name="theForm">
        <p>Enter any two values and click "Eval" in the missing area to calculate the third.</p>
    <label>Weeks:</label><input class="shortinput" type="text" name="VarW" size=6 value="0"/>
        <input name="calcbut" Value="eval" type="button" onClick="calc1();illus()"/>
        
    <label>Detectors:</label><input class="shortinput" type="text" name="VarD" size=6 value="3"/>
        <input name="calcbut" Value="eval" type="button" onClick="calc2();illus()"/>
        
    <label>Containers:</label><input class="shortinput" type="text" name="VarP" size=6 value="720"/>
        <input name="calcbut" Value="eval" type="button" onClick="calc3();illus()"/> 
        
        <textarea name="SVar" rows=4 cols=40></textarea>
        <input name="Scalcbut" Value="No Hit" type="button" onClick="calc4N();illus()"/>
        <input name="Scalcbut" Value="Hit" type="button" onClick="calc4Y();illus()"/></form>
        
    <h2 style="margin-top: 275px;">Single-test</h2>
        <form name="theSForm">
        <p>Enter any two values and click "Eval" in the missing area to calculate the third.</p>
            <label>Weeks:</label><input class="shortinput" type="text" name="SVarW" size=6 value="0"/>
        <input name="Scalcbut" Value="eval" type="button" onClick="Scalc1();illus()"/>
            
            <label>Detectors:</label><input class="shortinput" type="text" name="SVarD" size=6 value="3"/>
        <input name="Scalcbut" Value="eval" type="button" onClick="Scalc2();illus()"/>
            
            <label>Containers:</label><input class="shortinput" type="text" name="SVarP" size=6 value="720"/>
        <input name="Scalcbut" Value="eval" type="button" onClick="Scalc3();illus()"/> 
            
        <textarea name="SVar" rows=4 cols=40></textarea>
        <input name="Scalcbut" Value="No Hit" type="button" onClick="Scalc4N();illus()"/>
        <input name="Scalcbut" Value="Hit" type="button" onClick="Scalc4Y();illus()"/>
    
    </form>
    
</div>
    <script>
        calc1();
        Scalc1();
        illus()
    </script>
</body>

</html>