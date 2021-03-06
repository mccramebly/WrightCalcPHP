<!DOCTYPE html>
<html lang="en">

<head>
    <title>Savings &amp; Loan Calculator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <script src="myfunctions.js"></script>
    <script>
        // ------------------------------------
        function enter(evt) {
            var charCode = evt.keyCode;
            if (charCode == 13) debal();
            if (charCode == 27) cla();
        };
        // ------------------------------------
        function round2(x) {
            xx = "" + (Math.round(x * 100) / 100)
            if (xx.search(/\./) == -1) {
                xx = xx + ".00"
            } else if (xx.charAt(xx.length - 2) == ".") {
                xx = xx + "0"
            }
            return (xx)
        };
        // ------------------------------------
        function cols(x, i) {
            var xi = "                                        " + x;
            return (xi.substr(xi.length - i))
        }
        // ------------------------------------
        function cla() {
            if (document.theForm.input.value.slice(0, 72) == 'Financial calculations can involve simple interest or compound interest.') {
                document.theForm.irate.value = ''
                document.theForm.nypdval.value = ''
                document.theForm.perper.value = 12
                document.theForm.nypd[0].checked = true
                document.theForm.startbal.value = ''
                document.theForm.perpay.value = ''
                document.theForm.payendv.checked = true
                document.theForm.finalbal.value = ''
                document.theForm.input.value = ''
            } else {
                document.theForm.input.value = 'Financial calculations can involve simple interest or compound interest.\nThe simple interest formula is: I= Prt, where P= the principle, r is the interest rate per period and t is the number of periods.\nWith compound interest the interest is added to the principle and included in the interest calculation for the next period.\nAn annuity also adds or subtracts a fixed amount from the principle.\nAn ordinary annuity (annuity in arrears) adds the amount at the end of the period.\nAn annuity due (annuity In advance) adds the amount at the beginning of the period.\nMortgages are examples of an ordinary annuity.\nVariables that are usually used for these calculations are:\n  S= Principle, Present Value, or Starting Amount\n  P= Periodic Payment Amount\n  F= Future or Final Amount\n  m= number of periods per year, t= number of years, n= Total number of periods = t*m\n  i= annual interest rate (APR), r= Interest per period = i/m\nYou can calculate any of these values from the others by using formulas like these:\n  F= S * (1+r)^n + P * ((1+r)^n-1) / r\n  S= (F + (P * ((1+r)^n-1) / r))/(1+r)^n\n  P= r*(S(1+r)^n - F)/(1-(1+r)^n)\n  n= [ ln ((r*F+P)/(r*S+P))/ln(1+r)]\n'
            }
            lline = ''
            document.theForm.irate.focus()
        }
        // ------------------------------------
        function sample() {
            document.theForm.irate.value = '4.5'
            document.theForm.nypdval.value = 15
            document.theForm.perper.value = 12
            document.theForm.nypd[1].checked = true
            document.theForm.startbal.value = 100000
            document.theForm.perpay.value = -3550
            document.theForm.payendv.checked = true
            document.theForm.finalbal.value = 50000
            document.theForm.input.value = ''
        }
        // ------------------------------------
        function continu() {
            document.theForm.nypdval.value = 0
            document.theForm.startbal.value = document.theForm.finalbal.value
            document.theForm.finalbal.value = 0
        }
        // ------------------------------------
        function load() {
            doprtot = document.theForm.prtot.checked
            doallr = document.theForm.allr.checked
            irate = eval(document.theForm.irate.value) / 100;
            if (isNaN(irate)) {
                irate = 0
            }
            perper = eval(document.theForm.perper.value);
            if (isNaN(perper)) {
                perper = 12
            }
            nypdval = eval(document.theForm.nypdval.value);
            if (isNaN(nypdval)) {
                nypdval = 1
            }
            if (perper == 0) {
                prate = irate
            } else {
                prate = irate / perper
            }
            nperiods = nypdval;
            if (document.theForm.nypd[0].checked && perper != 0) nperiods = nypdval * perper
            startbal = eval(document.theForm.startbal.value);
            if (isNaN(startbal)) {
                startbal = 0
            }
            perpay = eval(document.theForm.perpay.value);
            if (isNaN(perpay)) {
                perpay = 0
            }
            finalbal = eval(document.theForm.finalbal.value);
            if (isNaN(finalbal)) {
                finalbal = 0
            }
            if (prate == 0) dprate = nperiods;
            else dprate = (Math.pow(prate + 1, nperiods) - 1) / prate
            if (perper == 0) nyears = nperiods
            document.theForm.input.value = (doprtot ? lline : "")
        }
        // ------------------------------------
        function dohead() {
            notpayend = !document.theForm.payendv.checked
            if (notpayend) {
                nline += cols(round2(tperpay), 14) + cols(round2(tinterest), 12)
                document.getElementById("hfld1").innerHTML = " &nbsp; &nbsp; Payment &nbsp; &nbsp; "
                document.getElementById("hfld2").innerHTML = " &nbsp; &nbsp; Interest &nbsp; &nbsp; "
            } else {
                nline += cols(round2(tinterest), 12) + cols(round2(tperpay), 14)
                document.getElementById("hfld1").innerHTML = " &nbsp; &nbsp; Interest &nbsp; &nbsp; "
                document.getElementById("hfld2").innerHTML = " &nbsp; &nbsp; Payment &nbsp; &nbsp; "
            }
        }
        // ------------------------------------
        function schedule() {
            endbalance = startbal;
            tinterest = 0;
            tperpay = 0;
            dohead()
            for (i = 0; i < nperiods; i++) {
                balance = endbalance;
                thispay = perpay;
                if (perper == 0) {
                    if (notpayend) {
                        endbalance = (balance + thispay) * (Math.exp(irate));
                        interest = endbalance - balance - thispay
                    } else {
                        endbalance = balance * (Math.exp(irate));
                        interest = endbalance - balance;
                        endbalance += thispay
                    }
                } else {
                    if (notpayend) interest = (balance + perpay) * prate;
                    else interest = balance * prate;
                    endbalance = balance + interest + perpay
                }
                tinterest += interest;
                tperpay += thispay;
                i0 = i + 1
                if (perper == 0) {
                    if (endbalance > finalbal && finalbal > 0) {
                        endbalance = finalbal;
                        i0 = myround(nyears, 2);
                        i = nperiods
                    }
                }
                if ((i < 9) || (i > (nperiods - 10)) || doallr) {
                    print((perper == 0 ? "      " : cols((((i % perper == 0) || (!doallr && (i == (nperiods - 9)))) ? Math.floor(i / perper) + 1 : ""), 3) + "/" + cols(i % perper + 1, 2)) + cols("(" + (i0) + ")", 7) + cols(round2(balance), 19), '')
                    if (notpayend) print(cols(round2(thispay), 14) + cols(round2(interest), 12), '')
                    else print(cols(round2(interest), 12) + cols(round2(thispay), 14), '')
                    print(cols(round2(endbalance), 14));
                } else if (i == 9) {
                    print(" . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .")
                }
            }
            nline = "Transaction Summary:" + cols(round2(startbal), 12)
            dohead()
            nline += cols(round2(endbalance), 14) + "\n                  Initial Amount"
            if (notpayend)
                nline += "       Payment    Interest   End Balance"
            else
                nline += "    Interest       Payment   End Balance"
            lline += nline + uline;
            print(uline + nline)
            if (abs(endbalance) < .0001) endbalance = 0
            finalbal = endbalance
        }
        // ------------------------------------
        function dirate() {
            load();

            function fbv(r) {
                if (r == 0) var v1 = nperiods;
                else var v1 = (Math.pow(1 + r, nperiods) - 1) / r
                if (notpayend) return (startbal * Math.pow(1 + r, nperiods) + perpay * (1 + r) * v1) - finalbal;
                else return (startbal * Math.pow(1 + r, nperiods) + perpay * v1) - finalbal;
            }
            print("F= S * (1+r)^n + P * ((1+r)^n-1) / r    rE= " + my((Math.pow(1 + prate, perper) - 1), 4))
            if (startbal == finalbal) {
                irate = 0
            } else {
                ira = -1;
                irb = 1;
                do {
                    irm = (ira + irb) / 2;
                    if ((fbv(irb) * fbv(irm)) > 0) {
                        irb = irm
                    } else {
                        ira = irm
                    }
                } while ((irb - ira) > 0.00000001)
                if (perper == 0) {
                    irate = irm;
                    prate = Math.exp(irate) - 1
                } else {
                    prate = irm;
                    irate = prate * perper
                }
            }
            document.theForm.irate.value = irate * 100
            print("Interest rate: " + round2(100 * irate) + "% compounded over " + Math.abs(nperiods) + " periods.")
            schedule()
        }
        // ------------------------------------
        function dyears() {
            load();
            if (perper == 0) {
                print("n= ln(F/S) / r    rE= " + my((Math.pow(1 + prate, perper) - 1), 4))
                nyears = Math.log(finalbal / startbal) / irate
                nperiods = nyears
            } else {
                print("n= [ ln ((r*F+P)/(r*S+P))/ln(1+r)]    rE= " + my((Math.pow(1 + prate, perper) - 1), 4))
                if (notpayend) {
                    nperiods = Math.ceil(Math.log((prate * finalbal + perpay * (1 + prate)) / (prate * startbal + perpay * (1 + prate))) / Math.log(1 + prate))
                    nyears = nperiods / perper
                } else {
                    nperiods = Math.ceil(Math.log((prate * finalbal + perpay) / (prate * startbal + perpay)) / Math.log(1 + prate))
                    nyears = nperiods / perper
                }
            }
            document.theForm.nypdval.value = (document.theForm.nypd[0].checked ? nyears : nperiods)
            schedule()
        }
        // ------------------------------------
        function dsbal() {
            load();
            if (perper == 0) {
                print("F= S * e^(rn) + P * (1-e^(r(n+1))/(1-e^r)     rE= " + my((Math.pow(1 + prate, perper) - 1), 4))
                startbal = (finalbal - perpay * (1 - Math.exp(irate * (nperiods))) / (1 - Math.exp(irate))) / (Math.exp(irate * nperiods))
            } else {
                print("S= (F - (P * ((1+r)^n-1) / r))/(1+r)^n     rE= " + my((Math.pow(1 + prate, perper) - 1), 4))
                if (notpayend)
                    startbal = (finalbal - (perpay * (1 + prate) * (Math.pow(1 + prate, nperiods) - 1) / prate)) / Math.pow(1 + prate, nperiods)
                else
                    startbal = (finalbal - (perpay * (Math.pow(1 + prate, nperiods) - 1) / prate)) / Math.pow(1 + prate, nperiods)
            }
            document.theForm.startbal.value = startbal
            schedule()
        }
        // ------------------------------------
        function dpayment() {
            load();
            print("P= r*(F - S(1+r)^n)/((1+r)^n -1)    rE= " + my((Math.pow(1 + prate, perper) - 1), 4))
            if (notpayend) {
                perpay = (finalbal - startbal * Math.pow(1 + prate, nperiods - 1)) / dprate
            } else {
                perpay = (finalbal - startbal * Math.pow(1 + prate, nperiods)) / dprate
            }
            document.theForm.perpay.value = perpay
            schedule()
        }
        // ------------------------------------
        function debal() {
            load();
            finalbal = startbal
            if (perper == 0) {
                print("F= S * e^(rn) + P * (1-e^(r(n+1))/(1-e^r)     rE= " + my((Math.pow(1 + prate, perper) - 1), 4))
                finalbal = startbal * (Math.exp(irate * nperiods)) + perpay * (1 - Math.exp(irate * (nperiods))) / (1 - Math.exp(irate))
            } else if (prate == 0) {
                print("F= S + P * n     rE= " + my((Math.pow(1 + prate, perper) - 1), 4))
                finalbal = startbal + perpay * nperiods
            } else {
                print("F= S * (1+r)^n + P * ((1+r)^n-1) / r    rE= " + my((Math.pow(1 + prate, perper) - 1), 4))
                if (notpayend) finalbal = startbal * Math.pow(1 + prate, nperiods) + perpay * (1 + prate) * (Math.pow(1 + prate, nperiods) - 1) / prate
                else finalbal = startbal * Math.pow(1 + prate, nperiods) + perpay * (Math.pow(1 + prate, nperiods) - 1) / prate
            }
            schedule()
            document.theForm.finalbal.value = round2(finalbal)
        }
        // ------------------------------------
        function swperiod() {
            simper = (simper + 1) % 4;
            if (simper == 0) dayper = 365.25
            else if (simper == 1) dayper = 364
            else if (simper == 2) dayper = 360
            else dayper = 365
            showsw()
        }
        // ------------------------------------
        function sw364() {
            if (dayper == 360) dayper = 365.25
            else if (dayper == 365.25) dayper = 364
            else if (dayper == 365) dayper = 360
            else dayper = 365
            showsw()
        }
        // ------------------------------------
        function showsw() {
            if (simper == 0) {
                document.getElementById("hfld3").innerHTML = "days";
                oneperiod = 1
            } else if (simper == 1) {
                document.getElementById("hfld3").innerHTML = "weeks";
                oneperiod = 7
            } else if (simper == 2) {
                document.getElementById("hfld3").innerHTML = "months";
                oneperiod = 30
            } else {
                document.getElementById("hfld3").innerHTML = "years";
                oneperiod = dayper
            }
            document.getElementById("hfld4").innerHTML = dayper
        }
        // ------------------------------------
        function resett() {
            document.theForm.tdate.value = ''
            document.theForm.sintr.value = ''
            document.theForm.stotl.value = ''
        }
        // ------------------------------------
        function simple() {
            sfdate = Date.parse(document.theForm.fdate.value)
            stdate = Date.parse(document.theForm.tdate.value)
            sndays = document.theForm.ndays.value
            if (typeof(sndays) == 'string') sndays = cleanx(sndays + '+0', true)
            if (isNaN(sfdate)) {
                sfdated = new Date();
                sfdate = Date.parse(sfdated) - oneday / 2
            }
            if (sndays == 0) {
                if (isNaN(stdate)) sndays = dayper
                else sndays = int((stdate - sfdate + oneday - 60000) / oneday / oneperiod)
            }
            // if (isNaN(stdate))
            stdate = sfdate + sndays * oneperiod * oneday
            x = new Date(sfdate);
            document.theForm.fdate.value = x.toLocaleDateString()
            x = new Date(stdate);
            document.theForm.tdate.value = x.toLocaleDateString()
            document.theForm.ndays.value = sndays

            ssprin = document.theForm.sprin.value
            ssrate = document.theForm.srate.value // annual rate
            ssintr = document.theForm.sintr.value
            sstotl = document.theForm.stotl.value
            if (sstotl == '') sstotl = 0;
            else sstotl = eval(sstotl)

            ssprin = parseFloat(0 + ssprin)
            ssrate = parseFloat((0 + ssrate) / 100)
            ssintr = parseFloat(0 + ssintr)
            sstotl = parseFloat(0 + sstotl)

            if (ssintr == 0) {
                if (ssprin == 0) {
                    if (ssrate == 0 || sndays == 0) ssprin = sstotl - ssintr
                    else if (ssintr == 0) ssprin = sstotl / (1 + ssrate * sndays * oneperiod / dayper)
                    else if (ssrate != 0) ssprin = ssintr * dayper / ssrate / sndays / oneperiod
                } else {
                    if (sstotl != 0) {
                        ssintr = sstotl - ssprin;
                        ssrate = dayper * ssintr / ssprin / sndays / oneperiod
                    } else {
                        ssintr = ssprin * ssrate * sndays * oneperiod / dayper
                    }
                }
            } else {
                if (ssprin != 0) {
                    sstotl = ssprin + ssintr;
                    if (ssrate == 0) ssrate = dayper * ssintr / ssprin / sndays / oneperiod
                } else {
                    if (sstotl != 0) {
                        ssprin = sstotl - ssintr;
                        ssrate = dayper * ssintr / ssprin / sndays / oneperiod
                    } else {
                        ssprin = dayper * ssintr / ssrate / sndays / oneperiod
                    }
                }
            }

            ssintr = ssprin * ssrate * sndays * oneperiod / dayper
            sstotl = ssprin + ssintr

            //***** additional periods
            asfdate = sfdate + oneday / 2;
            asndays = sndays;
            astdate = stdate;
            assprin = ssprin;
            assrate = ssrate;
            assintr = ssintr
            atotl = 0;
            lline = '';
            atintr = 0
            for (speriod = 0; speriod < 20; speriod++) {
                stdated = new Date(asfdate);
                lline += stdated.toDateString();
                asfdate += sndays * oneperiod * oneday
                lline = lline + cols(round2(assprin), 12) + '  ' + cols(round2(atintr), 12) + '  ' + cols(round2(assprin + atintr), 12)
                atintr += assintr
                lline = lline + '\n';
                document.theForm.input.value = lline
            }

            document.theForm.sprin.value = ssprin.toFixed(2)
            document.theForm.srate.value = (ssrate * 100).toFixed(2)
            document.theForm.sintr.value = ssintr.toFixed(2)
            document.theForm.stotl.value = sstotl.toFixed(2)
            document.theForm.ndays.focus()
        } // end simple()
        // exponential growth
        function xScalc() {
            document.theForm.Sval.value = document.theForm.Fval.value / Math.pow(document.theForm.rval.value, document.theForm.tval.value)
        }

        function xrcalc() {
            document.theForm.rval.value = Math.exp(Math.log(document.theForm.Fval.value / document.theForm.Sval.value) / document.theForm.tval.value)
        }

        function xtcalc() {
            document.theForm.tval.value = Math.log(document.theForm.Fval.value / document.theForm.Sval.value) / Math.log(document.theForm.rval.value)
        }

        function xFcalc() {
            document.theForm.Fval.value = document.theForm.Sval.value * Math.pow(document.theForm.rval.value, document.theForm.tval.value)
        }
    </script>
    <link REL="SHORTCUT ICON" HREF="favicon.ico">
    <link rel="stylesheet" href="assets/html5reset-1.6.1.css">
    <link rel="stylesheet" href="assets/complex-calc.css">
    <link rel="stylesheet" href="navstyles.css">
    <script src="https://kit.fontawesome.com/618d53ce21.js" crossorigin="anonymous"></script>
</head>

<body id="saveLoan">
    <?php include('nav.html'); ?>
    <div id="calctainer">
        <a href="index.php"><img class="calcheader" src="assets/calcheadertrim.png"></a>
        <h1>Savings &amp; Loan Calculator</h1>
        <form name="theForm">


            <div id="simpleInterest">
                <h2>Simple Interest</h2>
                <div>
                    <span id="hfld4" onclick="sw364()" class="clickableSpan">365</span> days per year
                </div>
                <div id="resetCalc">
                    <input type="button" name="sinta" value="Reset" onClick="resett()">
                    <input type="button" name="sintb" value="Calculate" onClick="simple()"></div>
                <div>Period: <label for="fdate">From</label>

                    <input type="text" id="fdate" name="fdate" size=14 value="" tabindex="11" placeholder="M/D/YYYY">
                </div>

                <div>
                    <span id="hfld3" class="clickableSpan" onclick="swperiod()"><label for="ndays">days</label></span>
                    <input type="text" id="ndays" name="ndays" size=4 value="" tabindex="12" placeholder="360">
                </div>

                <div>
                    <label for="tdate">To</label>
                    <input type="text" id="tdate" name="tdate" size=14 value="" tabindex="13" placeholder="M/D/YYYY">
                </div>

                <div><label for="sprin">Principle</label>
                    <input type="text" id="sprin" name="sprin" size=10 value="" tabindex="14" placeholder="0.00">
                </div>
                <div>
                    <label for="srate">Annual % Rate</label>
                    <input type="text" id="srate" name="srate" size=4 value="" tabindex="15" placeholder="0.00">
                </div>
                <div>
                    Interest
                    <input type="text" name="sintr" size=10 value="" tabindex="16" placeholder="0.00">
                </div>
                <div>
                    <label for="stotl">Total</label>
                    <input type="text" id="stotl" name="stotl" size=10 value="" tabindex="17" placeholder="0.00">
                </div>
            </div>

            <div id="expoGrowth">
                <h2>Exponential Growth</h2>
                <span> F = S*r^t</span>
                <div>
                    <input name="s" type="button" value="S" onClick="xScalc()">
                    <input type="text" name="Sval" size=10 value="" tabindex="18"></div>
                <div>
                    <input name="r" type="button" value="r" onClick="xrcalc()">
                    <input type="text" name="rval" size=10 value="" tabindex="19"></div>
                <div>
                    <input name="t" type="button" value="t" onClick="xtcalc()">
                    <input type="text" name="tval" size=10 value="" tabindex="20"></div>
                <div>
                    <input name="f" type="button" value="F" onClick="xFcalc()">
                    <input type="text" name="Fval" size=10 value="" tabindex="21"></div>
            </div>
            <div id="compoundInterest">
                <h2>Compound Interest</h2>
                <div id="compoundGroup1">
                    <input type="button" name="sclearb" value="Clear" onClick="cla()">
                    <input type="button" name="scontb" value="Continue" onClick="continu()">
                    <input type="button" name="bsample" value="Example" onClick="sample()">
                    Show:
                    <input type="checkbox" name="prtot" /> prior totals
                    <input type="checkbox" name="allr" /> all rows
                </div>
                <div id="compoundGroup2">
                    <input name="cirate" type="button" value="Calc" onClick="dirate()">
                    <input type="text" name="irate" size=5 value="" tabindex="1">% Annual Interest Rate<br>
                    <input name="cyears" type="button" value="Calc" onClick="dyears()">
                    <input type="text" name="nypdval" size=2 value="" tabindex="2">
                    <input name="nypd" type="radio" title="nypd" checked /> Years
                    <input name="nypd" type="radio" title="nypd" /> Periods<br>

                    <input type="text" name="perper" size=3 value="12" tabindex="3"> Periods per year (0= cont.)</div>

                <div id="compoundGroup3">
                    <input name="csbal" type="button" value="Calc" onClick="dsbal()">
                    <input type="text" name="startbal" size=12 value="" tabindex="4"> Starting Balance / Present Value<br>
                    <input name="cpayment" type="button" value="Calc" onClick="dpayment()">
                    <input type="text" name="perpay" size=12 value="" tabindex="5"> Periodic payment
                    <input type="checkbox" name="payendv" onClick="dohead()" checked /> at end<br>
                    <input name="cebal" type="button" value="Calc" onClick="debal()">
                    <input type="text" name="finalbal" size=12 value="" tabindex="6"> Final Balance / Future Value
                </div>
            </div>
            <div id="outputHeadings">
                <span>Year / Period</span>
                <span>Initial Amount</span>
                <span id="hfld1">Payment</span>
                <span id="hfld2">Interest</span>
                <span>New Balance</span> </div>
            <div id="outputDiv"><textarea name="input">
Financial calculations can involve simple interest or compound interest.
The simple interest formula is: I= Prt, where P= the principle, r is the interest rate per period and t is the number of periods.
With compound interest the interest is added to the principle and included in the interest calculation for the next period.
An annuity also adds or subtracts a fixed amount from the principle.
An ordinary annuity (annuity in arrears) adds the amount at the end of the period.
An annuity due (annuity In advance) adds the amount at the beginning of the period.
Mortgages are examples of an ordinary annuity.
Variables that are usually used for these calculations are:
  S= Principle, Present Value, or Starting Amount
  P= Periodic Payment Amount
  F= Future or Final Amount
  m= number of periods per year, t= number of years, n= Total number of periods = t*m
  i= annual interest rate (APR), r= Interest per period = i/m
You can calculate any of these values from the others by using formulas like these:
  F= S * (1+r)^n + P * ((1+r)^n-1) / r
  S= (F + (P * ((1+r)^n-1) / r))/(1+r)^n
  P= r*(S(1+r)^n - F)/(1-(1+r)^n)
  n= [ ln ((r*F+P)/(r*S+P))/ln(1+r)]
</textarea></div>
        </form>
    </div>
    <script type="text/javascript">
        zeta = String.fromCharCode(951)
        alpha = String.fromCharCode(945)
        Sigma = String.fromCharCode(931);
        sigma = String.fromCharCode(963);
        mu = String.fromCharCode(956);
        divide = String.fromCharCode(247)
        radical = String.fromCharCode(8730)
        P2 = String.fromCharCode(178); //squared
        notpayend = false;
        nline = '';
        tinterest = 0;
        tperpay = 0
        var x1 = 0
        var x2 = 0
        var pval = 0
        var binp = 0.5
        var dayper = 365
        var oneperiod = 1
        var simper = 0 // 0=days, 1=weeks, 2=months, 3=years
        var oneday = 1000 * 60 * 60 * 24 // convert milliseconds to days

        var finalbal = 0
        var irate = 0
        var nypdval = 0
        var nperiods = 0
        var perpay = 0
        var perper = 12
        var prate = 0
        var startbal = 0
        var lline = ""
        var uline = "                  -------------------------------------------------------\n"
        document.theForm.irate.focus()

        ls = decodeURIComponent(location.search)
        /*
          document.theForm.nypdval.value=''
          document.theForm.perper.value=12
          document.theForm.nypd[0].checked=true
          document.theForm.payendv.checked=true */
        if (ls.search(/\?/) == 0) {
            document.theForm.nypd[1].checked = true // using periods
            ls = ls.slice(1).split("&")[0].replace(/; +/g, ";")
            while (ls.length > 0 && ls.slice(1, 2) == ':') {
                lsnext = ls.search(/;/);
                if (lsnext == -1) lsnext = ls.length;
                if (ls.slice(0, 2) == 'S:') document.theForm.startbal.value = ls.slice(2, lsnext)
                else if (ls.slice(0, 2) == 'F:') document.theForm.finalbal.value = ls.slice(2, lsnext)
                else if (ls.slice(0, 2) == 'I:') document.theForm.irate.value = ls.slice(2, lsnext)
                else if (ls.slice(0, 2) == 'N:') document.theForm.nypdval.value = ls.slice(2, lsnext)
                else if (ls.slice(0, 2) == 'P:') document.theForm.perpay.value = ls.slice(2, lsnext)
                else if (ls.slice(0, 2) == 'X:') {
                    document.theForm.perper.value = ls.slice(2, lsnext);
                    document.theForm.nypd[0].checked = true; /* switch to years */
                }
                ls = ls.slice(lsnext + 1)
            }
            payendv.checked = (document.theForm.startbal.value == 0) // payment at end
            document.theForm.input.value = ''
        }
    </script>
</body>

</html>