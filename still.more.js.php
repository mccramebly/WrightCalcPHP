<!DOCTYPE html>
<html lang="en">

<head>
    <title>JS</title>
    <link rel="shortcut icon" href="favicon.ico">
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/articlestyles.css">
</head>

<body>
    <?php include('nav.html'); ?>
    <div class="artmenu">
        <a href="index.php"><img class="artmenuheader" src="assets/calcheader.png"></a>
        <p>Look at the code on this page. It is the kind of code you should NEVER NEVER write.</p>
        <pre>
&lt;html>&lt;body>&lt;script type="text/javascript">
x=1; h=.0000001
a=x; b=a; c=2; m = ",  "; p='&lt;br>'
while (Math.abs(b)>h)
{b*=-x*x/c++/c++; a+=b
 if (c>99) break }
document.write (p,c/2,m," a=",a,m," b=",b)
document.write(p,'sine(x)= '+Math.sin(x)) // how close is a to the Sine of x?

x=0; y=0; c=1; n=100000
while (c&lt;n)
{x += 1/c; y += 1/(n-c++)}
document.write (p,x,m,y,m,x==y) // is x equal to y? why?
&lt;/script>&lt;/body>&lt;/html>
</pre>
        <p>Can you figure out how you get this output from that code?</p>
        <pre>
<script type="text/javascript">
x=1; h=.0000001
a=x; b=a; c=2; m = ",  "; p="<br>"
while (Math.abs(b)>h)
{b*=-x*x/c++/c++; a+=b
 if (c>99) break }
document.write (p,c/2,m," a=",a,m," b=",b)
document.write(p,'sine(x)= '+Math.sin(x)) // how close is a to the Sine of x?

x=0; y=0; c=1; n=100000
while (c<n)
{x += 1/c; y += 1/(n-c++)}
document.write (p,x,m,y,m,x==y) // is x equal to y? why?
</script>
</pre>
        <p><a href="" target="_blank"></a></p>
    </div>
</body>

</html>