<!DOCTYPE html>
<html lang="en">

<head>
    <title>Spreadsheet</title>
    <link rel="stylesheet" href="assets/articlestyles.css">
    <meta charset="utf-8">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
</head>

<body onLoad="self.focus();window.resizeTo( 750, 750 );">
    <?php include('nav.html'); ?>
    <script type="text/javascript" src="myfunctions.js"></script>
    <script>
        A1 = "";
        B1 = "";
        C1 = "";
        D1 = "";
        E1 = "";
        F1 = "";
        G1 = "";
        H1 = ""
        // ---------------------------------------------------*/
        function val(x) {
            if (slim(x) == "") return "";
            else return eval(x)
        }

        function getA1() {
            document.theForm.A1.value = A1
        };

        function putA1() {
            A1 = document.theForm.A1.value;
            document.theForm.A1.value = val(A1)
        }

        function getB1() {
            document.theForm.B1.value = B1
        };

        function putB1() {
            B1 = document.theForm.B1.value;
            document.theForm.B1.value = val(B1)
        }

        function getC1() {
            document.theForm.C1.value = C1
        };

        function putC1() {
            C1 = document.theForm.C1.value;
            document.theForm.C1.value = val(C1)
        }

        function getD1() {
            document.theForm.D1.value = D1
        };

        function putD1() {
            D1 = document.theForm.D1.value;
            document.theForm.D1.value = val(D1)
        }

        function getE1() {
            document.theForm.E1.value = E1
        };

        function putE1() {
            E1 = document.theForm.E1.value;
            document.theForm.E1.value = val(E1)
        }

        function getF1() {
            document.theForm.F1.value = F1
        };

        function putF1() {
            F1 = document.theForm.F1.value;
            document.theForm.F1.value = val(F1)
        }

        function getG1() {
            document.theForm.G1.value = G1
        };

        function putG1() {
            G1 = document.theForm.G1.value;
            document.theForm.G1.value = val(G1)
        }

        function getH1() {
            document.theForm.H1.value = H1
        };

        function putH1() {
            H1 = document.theForm.H1.value;
            document.theForm.H1.value = val(H1)
        }

        function getA2() {
            document.theForm.A2.value = A2
        };

        function putA2() {
            A2 = document.theForm.A2.value;
            document.theForm.A2.value = val(A2)
        }

        function getB2() {
            document.theForm.B2.value = B2
        };

        function putB2() {
            B2 = document.theForm.B2.value;
            document.theForm.B2.value = val(B2)
        }

        function getC2() {
            document.theForm.C2.value = C2
        };

        function putC2() {
            C2 = document.theForm.C2.value;
            document.theForm.C2.value = val(C2)
        }

        function getD2() {
            document.theForm.D2.value = D2
        };

        function putD2() {
            D2 = document.theForm.D2.value;
            document.theForm.D2.value = val(D2)
        }

        function getE2() {
            document.theForm.E2.value = E2
        };

        function putE2() {
            E2 = document.theForm.E2.value;
            document.theForm.E2.value = val(E2)
        }

        function getF2() {
            document.theForm.F2.value = F2
        };

        function putF2() {
            F2 = document.theForm.F2.value;
            document.theForm.F2.value = val(F2)
        }

        function getG2() {
            document.theForm.G2.value = G2
        };

        function putG2() {
            G2 = document.theForm.G2.value;
            document.theForm.G2.value = val(G2)
        }

        function getH2() {
            document.theForm.H2.value = H2
        };

        function putH2() {
            H2 = document.theForm.H2.value;
            document.theForm.H2.value = val(H2)
        }

        function getA3() {
            document.theForm.A3.value = A3
        };

        function putA3() {
            A3 = document.theForm.A3.value;
            document.theForm.A3.value = val(A3)
        }

        function getB3() {
            document.theForm.B3.value = B1
        };

        function putB1() {
            B3 = document.theForm.B3.value;
            document.theForm.B3.value = val(B3)
        }

        function getC3() {
            document.theForm.C3.value = C3
        };

        function putC3() {
            C3 = document.theForm.C3.value;
            document.theForm.C3.value = val(C3)
        }

        function getD3() {
            document.theForm.D3.value = D3
        };

        function putD3() {
            D3 = document.theForm.D3.value;
            document.theForm.D3.value = val(D3)
        }

        function getE3() {
            document.theForm.E3.value = E3
        };

        function putE3() {
            E3 = document.theForm.E3.value;
            document.theForm.E3.value = val(E3)
        }

        function getF3() {
            document.theForm.F3.value = F3
        };

        function putF3() {
            F3 = document.theForm.F3.value;
            document.theForm.F3.value = val(F3)
        }

        function getG3() {
            document.theForm.G3.value = G3
        };

        function putG3() {
            G3 = document.theForm.G3.value;
            document.theForm.G3.value = val(G3)
        }

        function getH3() {
            document.theForm.H3.value = H3
        };

        function putH3() {
            H3 = document.theForm.H3.value;
            document.theForm.H3.value = val(H3)
        }

        function getA4() {
            document.theForm.A4.value = A4
        };

        function putA4() {
            A4 = document.theForm.A4.value;
            document.theForm.A4.value = val(A4)
        }

        function getB4() {
            document.theForm.B4.value = B4
        };

        function putB4() {
            B4 = document.theForm.B4.value;
            document.theForm.B4.value = val(B4)
        }

        function getC4() {
            document.theForm.C4.value = C4
        };

        function putC4() {
            C4 = document.theForm.C4.value;
            document.theForm.C4.value = val(C4)
        }

        function getD4() {
            document.theForm.D4.value = D4
        };

        function putD4() {
            D4 = document.theForm.D4.value;
            document.theForm.D4.value = val(D4)
        }

        function getE4() {
            document.theForm.E4.value = E4
        };

        function putE4() {
            E4 = document.theForm.E4.value;
            document.theForm.E4.value = val(E4)
        }

        function getF4() {
            document.theForm.F4.value = F4
        };

        function putF4() {
            F4 = document.theForm.F4.value;
            document.theForm.F4.value = val(F4)
        }

        function getG4() {
            document.theForm.G4.value = G4
        };

        function putG4() {
            G4 = document.theForm.G4.value;
            document.theForm.G4.value = val(G4)
        }

        function getH4() {
            document.theForm.H4.value = H4
        };

        function putH4() {
            H4 = document.theForm.H4.value;
            document.theForm.H4.value = val(H1)
        }

        function getA1() {
            document.theForm.A1.value = A1
        };

        function putA1() {
            A1 = document.theForm.A1.value;
            document.theForm.A1.value = val(A1)
        }

        function getB1() {
            document.theForm.B1.value = B1
        };

        function putB1() {
            B1 = document.theForm.B1.value;
            document.theForm.B1.value = val(B1)
        }

        function getC1() {
            document.theForm.C1.value = C1
        };

        function putC1() {
            C1 = document.theForm.C1.value;
            document.theForm.C1.value = val(C1)
        }

        function getD1() {
            document.theForm.D1.value = D1
        };

        function putD1() {
            D1 = document.theForm.D1.value;
            document.theForm.D1.value = val(D1)
        }

        function getE1() {
            document.theForm.E1.value = E1
        };

        function putE1() {
            E1 = document.theForm.E1.value;
            document.theForm.E1.value = val(E1)
        }

        function getF1() {
            document.theForm.F1.value = F1
        };

        function putF1() {
            F1 = document.theForm.F1.value;
            document.theForm.F1.value = val(F1)
        }

        function getG1() {
            document.theForm.G1.value = G1
        };

        function putG1() {
            G1 = document.theForm.G1.value;
            document.theForm.G1.value = val(G1)
        }

        function getH1() {
            document.theForm.H1.value = H1
        };

        function putH1() {
            H1 = document.theForm.H1.value;
            document.theForm.H1.value = val(H1)
        }

        function getA1() {
            document.theForm.A1.value = A1
        };

        function putA1() {
            A1 = document.theForm.A1.value;
            document.theForm.A1.value = val(A1)
        }

        function getB1() {
            document.theForm.B1.value = B1
        };

        function putB1() {
            B1 = document.theForm.B1.value;
            document.theForm.B1.value = val(B1)
        }

        function getC1() {
            document.theForm.C1.value = C1
        };

        function putC1() {
            C1 = document.theForm.C1.value;
            document.theForm.C1.value = val(C1)
        }

        function getD1() {
            document.theForm.D1.value = D1
        };

        function putD1() {
            D1 = document.theForm.D1.value;
            document.theForm.D1.value = val(D1)
        }

        function getE1() {
            document.theForm.E1.value = E1
        };

        function putE1() {
            E1 = document.theForm.E1.value;
            document.theForm.E1.value = val(E1)
        }

        function getF1() {
            document.theForm.F1.value = F1
        };

        function putF1() {
            F1 = document.theForm.F1.value;
            document.theForm.F1.value = val(F1)
        }

        function getG1() {
            document.theForm.G1.value = G1
        };

        function putG1() {
            G1 = document.theForm.G1.value;
            document.theForm.G1.value = val(G1)
        }

        function getH1() {
            document.theForm.H1.value = H1
        };

        function putH1() {
            H1 = document.theForm.H1.value;
            document.theForm.H1.value = val(H1)
        }
    </script>
    <form name="theForm">
        <table style="font-family:Monospace" border=1>
            <tr>
                <td colspan=99 onClick="window.open('index.htm')" align='center' tabindex="1">Spreadsheets</td>
            </tr>
            <tr>
                <td></td>
                <th>A</th>
                <th>B</th>
                <th>C</th>
                <th>D</th>
                <th>E</th>
                <th>F</th>
                <th>G</th>
                <th>H</th>
            </tr>
            <tr>
                <td style="align=center">1</td>
                <td><input name="A1" onfocus="getA1()" onblur="putA1()" /></td>
                <td><input name="B1" onfocus="getB1()" onblur="putB1()" /></td>
                <td><input name="C1" onfocus="getC1()" onblur="putC1()" /></td>
                <td><input name="D1" onfocus="getD1()" onblur="putD1()" /></td>
                <td><input name="E1" onfocus="getE1()" onblur="putE1()" /></td>
                <td><input name="F1" onfocus="getF1()" onblur="putF1()" /></td>
                <td><input name="G1" onfocus="getG1()" onblur="putG1()" /></td>
                <td><input name="H1" onfocus="getH1()" onblur="putH1()" /></td>
            </tr>
            <tr>
                <td style="">2</td>
                <td><input name="A2" /></td>
                <td><input name="B2" /></td>
                <td><input name="C2" /></td>
                <td><input name="D2" /></td>
                <td><input name="E2" /></td>
                <td><input name="F2" /></td>
                <td><input name="G2" /></td>
                <td><input name="H2" /></td>
            </tr>
            <tr>
                <td style="">3</td>
                <td><input name="A3" /></td>
                <td><input name="B3" /></td>
                <td><input name="C3" /></td>
                <td><input name="D3" /></td>
                <td><input name="E3" /></td>
                <td><input name="F3" /></td>
                <td><input name="G3" /></td>
                <td><input name="H3" /></td>
            </tr>
            <tr>
                <td style="">4</td>
                <td><input name="A4" /></td>
                <td><input name="B4" /></td>
                <td><input name="C4" /></td>
                <td><input name="D4" /></td>
                <td><input name="E4" /></td>
                <td><input name="F4" /></td>
                <td><input name="G4" /></td>
                <td><input name="H4" /></td>
            </tr>
            <tr>
                <td style="">5</td>
                <td><input name="A5" /></td>
                <td><input name="B5" /></td>
                <td><input name="C5" /></td>
                <td><input name="D5" /></td>
                <td><input name="E5" /></td>
                <td><input name="F5" /></td>
                <td><input name="G5" /></td>
                <td><input name="H5" /></td>
            </tr>
            <tr>
                <td style="">6</td>
                <td><input name="A6" /></td>
                <td><input name="B6" /></td>
                <td><input name="C6" /></td>
                <td><input name="D6" /></td>
                <td><input name="E6" /></td>
                <td><input name="F6" /></td>
                <td><input name="G6" /></td>
                <td><input name="H6" /></td>
            </tr>
            <tr>
                <td style="">7</td>
                <td><input name="A7" /></td>
                <td><input name="B7" /></td>
                <td><input name="C7" /></td>
                <td><input name="D7" /></td>
                <td><input name="E7" /></td>
                <td><input name="F7" /></td>
                <td><input name="G7" /></td>
                <td><input name="H7" /></td>
            </tr>
            <tr>
                <td style="">8</td>
                <td><input name="A8" /></td>
                <td><input name="B8" /></td>
                <td><input name="C8" /></td>
                <td><input name="D8" /></td>
                <td><input name="E8" /></td>
                <td><input name="F8" /></td>
                <td><input name="G8" /></td>
                <td><input name="H8" /></td>
            </tr>
            <tr>
                <td style="">9</td>
                <td><input name="A9" /></td>
                <td><input name="B9" /></td>
                <td><input name="C9" /></td>
                <td><input name="D9" /></td>
                <td><input name="E9" /></td>
                <td><input name="F9" /></td>
                <td><input name="G9" /></td>
                <td><input name="H9" /></td>
            </tr>
            <tr>
                <td style="">10</td>
                <td><input name="A10" /></td>
                <td><input name="B10" /></td>
                <td><input name="C10" /></td>
                <td><input name="D10" /></td>
                <td><input name="E10" /></td>
                <td><input name="F10" /></td>
                <td><input name="G10" /></td>
                <td><input name="H10" /></td>
            </tr>
            <tr>
                <td style="">11</td>
                <td><input name="A11" /></td>
                <td><input name="B11" /></td>
                <td><input name="C11" /></td>
                <td><input name="D11" /></td>
                <td><input name="E11" /></td>
                <td><input name="F11" /></td>
                <td><input name="G11" /></td>
                <td><input name="H11" /></td>
            </tr>
            <tr>
                <td style="">12</td>
                <td><input name="A12" /></td>
                <td><input name="B12" /></td>
                <td><input name="C12" /></td>
                <td><input name="D12" /></td>
                <td><input name="E12" /></td>
                <td><input name="F12" /></td>
                <td><input name="G12" /></td>
                <td><input name="H12" /></td>
            </tr>
            <tr>
                <td style="">13</td>
                <td><input name="A13" /></td>
                <td><input name="B13" /></td>
                <td><input name="C13" /></td>
                <td><input name="D13" /></td>
                <td><input name="E13" /></td>
                <td><input name="F13" /></td>
                <td><input name="G13" /></td>
                <td><input name="H13" /></td>
            </tr>
            <tr>
                <td style="">14</td>
                <td><input name="A14" /></td>
                <td><input name="B14" /></td>
                <td><input name="C14" /></td>
                <td><input name="D14" /></td>
                <td><input name="E14" /></td>
                <td><input name="F14" /></td>
                <td><input name="G14" /></td>
                <td><input name="H14" /></td>
            </tr>
            <tr>
                <td style="">15</td>
                <td><input name="A15" /></td>
                <td><input name="B15" /></td>
                <td><input name="C15" /></td>
                <td><input name="D15" /></td>
                <td><input name="E15" /></td>
                <td><input name="F15" /></td>
                <td><input name="G15" /></td>
                <td><input name="H15" /></td>
            </tr>
            <tr>
                <td style="">16</td>
                <td><input name="A16" /></td>
                <td><input name="B16" /></td>
                <td><input name="C16" /></td>
                <td><input name="D16" /></td>
                <td><input name="E16" /></td>
                <td><input name="F16" /></td>
                <td><input name="G16" /></td>
                <td><input name="H16" /></td>
            </tr>
            <tr>
                <td style="">17</td>
                <td><input name="A17" /></td>
                <td><input name="B17" /></td>
                <td><input name="C17" /></td>
                <td><input name="D17" /></td>
                <td><input name="E17" /></td>
                <td><input name="F17" /></td>
                <td><input name="G17" /></td>
                <td><input name="H17" /></td>
            </tr>
            <tr>
                <td style="">18</td>
                <td><input name="A18" /></td>
                <td><input name="B18" /></td>
                <td><input name="C18" /></td>
                <td><input name="D18" /></td>
                <td><input name="E18" /></td>
                <td><input name="F18" /></td>
                <td><input name="G18" /></td>
                <td><input name="H18" /></td>
            </tr>
            <tr>
                <td style="">19</td>
                <td><input name="A19" /></td>
                <td><input name="B19" /></td>
                <td><input name="C19" /></td>
                <td><input name="D19" /></td>
                <td><input name="E19" /></td>
                <td><input name="F19" /></td>
                <td><input name="G19" /></td>
                <td><input name="H19" /></td>
            </tr>
            <tr>
                <td style="">20</td>
                <td><input name="A20" /></td>
                <td><input name="B20" /></td>
                <td><input name="C20" /></td>
                <td><input name="D20" /></td>
                <td><input name="E20" /></td>
                <td><input name="F20" /></td>
                <td><input name="G20" /></td>
                <td><input name="H20" /></td>
            </tr>
            <tr>
                <td style="">21</td>
                <td><input name="A21" /></td>
                <td><input name="B21" /></td>
                <td><input name="C21" /></td>
                <td><input name="D21" /></td>
                <td><input name="E21" /></td>
                <td><input name="F21" /></td>
                <td><input name="G21" /></td>
                <td><input name="H21" /></td>
            </tr>
            <tr>
                <td style="">22</td>
                <td><input name="A22" /></td>
                <td><input name="B22" /></td>
                <td><input name="C22" /></td>
                <td><input name="D22" /></td>
                <td><input name="E22" /></td>
                <td><input name="F22" /></td>
                <td><input name="G22" /></td>
                <td><input name="H22" /></td>
            </tr>
            <tr>
                <td style="">23</td>
                <td><input name="A23" /></td>
                <td><input name="B23" /></td>
                <td><input name="C23" /></td>
                <td><input name="D23" /></td>
                <td><input name="E23" /></td>
                <td><input name="F23" /></td>
                <td><input name="G23" /></td>
                <td><input name="H23" /></td>
            </tr>
            <tr>
                <td style="">24</td>
                <td><input name="A24" /></td>
                <td><input name="B24" /></td>
                <td><input name="C24" /></td>
                <td><input name="D24" /></td>
                <td><input name="E24" /></td>
                <td><input name="F24" /></td>
                <td><input name="G24" /></td>
                <td><input name="H24" /></td>
            </tr>
            <tr>
                <td style="">25</td>
                <td><input name="A25" /></td>
                <td><input name="B25" /></td>
                <td><input name="C25" /></td>
                <td><input name="D25" /></td>
                <td><input name="E25" /></td>
                <td><input name="F25" /></td>
                <td><input name="G25" /></td>
                <td><input name="H25" /></td>
            </tr>
            <tr>
                <td style="">26</td>
                <td><input name="A26" /></td>
                <td><input name="B26" /></td>
                <td><input name="C26" /></td>
                <td><input name="D26" /></td>
                <td><input name="E26" /></td>
                <td><input name="F26" /></td>
                <td><input name="G26" /></td>
                <td><input name="H26" /></td>
            </tr>
            <tr>
                <td style="">27</td>
                <td><input name="A27" /></td>
                <td><input name="B27" /></td>
                <td><input name="C27" /></td>
                <td><input name="D27" /></td>
                <td><input name="E27" /></td>
                <td><input name="F27" /></td>
                <td><input name="G27" /></td>
                <td><input name="H27" /></td>
            </tr>
            <tr>
                <td style="">28</td>
                <td><input name="A28" /></td>
                <td><input name="B28" /></td>
                <td><input name="C28" /></td>
                <td><input name="D28" /></td>
                <td><input name="E28" /></td>
                <td><input name="F28" /></td>
                <td><input name="G28" /></td>
                <td><input name="H28" /></td>
            </tr>
            <tr>
                <td style="">29</td>
                <td><input name="A29" /></td>
                <td><input name="B29" /></td>
                <td><input name="C29" /></td>
                <td><input name="D29" /></td>
                <td><input name="E29" /></td>
                <td><input name="F29" /></td>
                <td><input name="G29" /></td>
                <td><input name="H29" /></td>
            </tr>
            <tr>
                <td style="">30</td>
                <td><input name="A30" /></td>
                <td><input name="B30" /></td>
                <td><input name="C30" /></td>
                <td><input name="D30" /></td>
                <td><input name="E30" /></td>
                <td><input name="F30" /></td>
                <td><input name="G30" /></td>
                <td><input name="H30" /></td>
            </tr>
        </table>
    </form>
    <script>
        document.theForm.A1.focus()
    </script>
</body>

</html>