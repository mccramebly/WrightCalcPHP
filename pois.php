<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <title>Pois</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta charset="utf-8">
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
    <?php include('nav.html'); ?>
    <A href="pois.pdf" target="_blank">click here for the explanation </A>
    <table>
        <tr>
            <th>Multi-test</th>
            <th>Single-test</th>
        </tr>
        <tr>
            <td>
                <form name="theForm">
                    <table border=1>
                        <tr>
                            <td colspan=99 onClick="window.open('index.htm')"> </td>
                        </tr>
                        <tr>
                            <td>Enter any two values:</td>
                            <td>Calculate the third value:</td>
                        </tr>
                        <tr>
                            <td>
                                weeks: <input type="text" name="VarW" size=6 value="0" /></td>
                            <td>
                                <input name="calcbut" Value="eval" type="button" onClick="calc1();illus()" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                detectors: <input type="text" name="VarD" size=6 value="3" /></td>
                            <td>
                                <input name="calcbut" Value="eval" type="button" onClick="calc2();illus()" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                containers: <input type="text" name="VarP" size=6 value="720" /></td>
                            <td>
                                <input name="calcbut" Value="eval" type="button" onClick="calc3();illus()" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2><textarea name="SVar" rows=4 cols=40></textarea></td>
                        </tr>
                        <tr>
                            <td align=center><input name="Scalcbut" Value="No Hit" type="button" onClick="calc4N();illus()" /></td>
                            <td align=center><input name="Scalcbut" Value="Hit" type="button" onClick="calc4Y();illus()" /></td>
                        </tr>
                    </table>
                </form>
            </td>
            <td>
                <form name="theSForm">
                    <table border=1>
                        <tr>
                            <td colspan=99 onClick="window.open('index.htm')"> </td>
                        </tr>
                        <tr>
                            <td>Enter any two values:</td>
                            <td>Calculate the third value:</td>
                        </tr>
                        <tr>
                            <td>
                                weeks: <input type="text" name="SVarW" size=6 value="0" /></td>
                            <td>
                                <input name="Scalcbut" Value="eval" type="button" onClick="Scalc1();illus()" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                detectors: <input type="text" name="SVarD" size=6 value="3" /></td>
                            <td>
                                <input name="Scalcbut" Value="eval" type="button" onClick="Scalc2();illus()" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                containers: <input type="text" name="SVarP" size=6 value="720" /></td>
                            <td>
                                <input name="Scalcbut" Value="eval" type="button" onClick="Scalc3();illus()" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2><textarea name="SVar" rows=4 cols=40></textarea></td>
                        </tr>
                        <tr>
                            <td align=center><input name="Scalcbut" Value="No Hit" type="button" onClick="Scalc4N();illus()" /></td>
                            <td align=center><input name="Scalcbut" Value="Hit" type="button" onClick="Scalc4Y();illus()" /></td>
                        </tr>
                    </table>
                </form>
            </td>
        </tr>
    </table>

    <script>
        calc1();
        Scalc1();
        illus()
    </script>
</body>

</html>