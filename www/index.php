<?php
session_start();

if (isset($_GET['lang'])){
$lang=$_GET['lang'];
	if ($lang=='en'){	}
}

else{
$lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); 
if ($lang == 'fr'){
header("Location: /fr");}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
<meta name="Description" content="iData, the secure cloud computing system"/>
<meta name="Keywords" content="cloud, computing, data, online"/>

       <link rel="stylesheet" href="style2.css" />
        <title>iData</title>
		<link rel="icon" type="image/png" href="cloud.png" />
    </head>
	
<body style="font-family: 'Century Gothic', Arial;">
<?php include_once("piwiktrack.php"); ?>
<?php include_once("header-en.php"); ?>


<script>
function show_hide_div(nomdiv){
var lediv = document.getElementById(nomdiv);
if(lediv.style.display=="block")
lediv.style.display="none";
else
lediv.style.display="block";
}
</script>

<!--FOURTH-->
<div style="width: 100%: height: 100%;">
<div style="background-color: rgb(0,210,148); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;" id="showmore3" >
<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;">
</p>
</a>
</div>

<div style="position: absolute; top: 150px; right: 0px; width:50%;">
<a href="#" 
onMouseOver="document.img_10.src='images/more1.png';"
onMouseOut="document.img_10.src='images/free.png';">
<img src="images/free.png" alt="free" style="width: 150px;" class="img" id="img_10" onClick="show_hide_div('showmore1');show_hide_div('showmore3')" ></a><br />

<a href="#" 
onMouseOver="document.img_11.src='images/more2.png';"
onMouseOut="document.img_11.src='images/secured.png';">
<img src="images/secured.png" alt="free" style="width: 150px;" class="img" id="img_11" onClick="show_hide_div('showmore2');show_hide_div('showmore3')" ></a><br />

<a href="#" 
onMouseOver="document.img_12.src='images/more3.png';"
onMouseOut="document.img_12.src='images/online-desk.png';">
<img src="images/online-desk.png" alt="online desk" style="width: 150px;" class="img" id="img_12" onClick="show_hide_div('showmore3');show_hide_div('showmore3')" ></a><br />

</div>
<div style="position: absolute; top: 400px; width: 74%; margin-left: 12%; margin-right: 12%;">
<p style="font-size: 25px;  color: white;">
With iData, your entire office is on the cloud : we provide you a text editor and an account manager. You can download, and share everything you uploaded. Bring your movies, photos, music, texts everywhere.<br />
<br />
<img src="ppt.png" alt="ppt" class="prespics"><img src="avi.png" alt="avi" class="prespics"><img src="mp3.png" alt="mp3" class="prespics"><img src="xls.png" alt="xls" class="prespics"><img src="exe.png" alt="exe" class="prespics"><img src="zip.png" alt="zip" class="prespics">
<br />
iData helps you to work : make reminders, we will e-mail you in time. 1Go isn't enough for you ? No problem : we are at least 3 times cheaper than Google Drive and 6 times cheaper than Dropbox.*</p>
</div>
</div>

<!--THIRD-->
<div style="background-color: rgb(0,187,176); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;" id="showmore2" >
<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px;  color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;">
</p>
</a>
</div>

<div style="position: absolute; top: 150px; right: 0px; width:50%;">
<a href="#" 
onMouseOver="document.img_1.src='images/more1.png';"
onMouseOut="document.img_1.src='images/free.png';">
<img src="images/free.png" alt="free" style="width: 150px;" class="img" id="img_1" onClick="show_hide_div('showmore1');show_hide_div('showmore2')" ></a><br />

<a href="#" 
onMouseOver="document.img_2.src='images/more2.png';"
onMouseOut="document.img_2.src='images/secured.png';">
<img src="images/secured.png" alt="free" style="width: 150px;" class="img" id="img_2" onClick="show_hide_div('showmore2');show_hide_div('showmore2')" ></a><br />

<a href="#" 
onMouseOver="document.img_3.src='images/more3.png';"
onMouseOut="document.img_3.src='images/online-desk.png';">
<img src="images/online-desk.png" alt="online desk" style="width: 150px;" class="img" id="img_3" onClick="show_hide_div('showmore3');show_hide_div('showmore2')" ></a><br />
</div>

<div style="position: absolute; top: 400px; width: 74%; margin-left: 12%; margin-right: 12%;">
<p style="font-size: 25px;  color: white;"><img src="lock.png" alt="lock" style="float: left;"> iData is secured : sensitive personal informations are protected by a 512 bits hash. We offer you the possibility to use HTTPS to encrypt your transactions. <br /> Moreover, to prevent attcks, we block non-HHTP(S) connections from the outside. What we build never leaves from iData. We host our servers in our own offices in France.</p>
</div>
</div>

<!--SECOND-->

<div style="background-color: rgb(0,194,212); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;" id="showmore1" >
<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px;  color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;"></p></a>
</div>

<div style="position: absolute; top: 150px; right: 0px; width:50%;">
<a href="#" 
onMouseOver="document.img_7.src='images/more1.png';"
onMouseOut="document.img_7.src='images/free.png';">
<img src="images/free.png" alt="free" style="width: 150px;" class="img" id="img_7" onClick="show_hide_div('showmore1');show_hide_div('showmore1')" ></a><br />

<a href="#" 
onMouseOver="document.img_8.src='images/more2.png';"
onMouseOut="document.img_8.src='images/secured.png';">
<img src="images/secured.png" alt="free" style="width: 150px;" class="img" id="img_8" onClick="show_hide_div('showmore2');show_hide_div('showmore1') " ></a><br />

<a href="#" 
onMouseOver="document.img_9.src='images/more3.png';"
onMouseOut="document.img_9.src='images/online-desk.png';">
<img src="images/online-desk.png" alt="online desk" style="width: 150px;" class="img" id="img_9" onClick="show_hide_div('showmore3');show_hide_div('showmore1')" ></a><br />

</div>
<div style="position: absolute; top: 400px; width: 74%; margin-left: 12%; margin-right: 12%;">
<p style="font-size: 25px;  color: white;">iData is free and without advertising. Just sign up and you will get 1Go online to store everything you want.</p>
</div>
</div>

<!--FIRST-->
<div id="defaultdiv" style="background-color: rgb(230,230,254); display: block; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;">
<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px;  color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;"></p></a>
</div>


<div style="position: absolute; top: 150px; right: 0px; width:50%;">
<a href="#" 
onMouseOver="document.img_4.src='images/more1.png';"
onMouseOut="document.img_4.src='images/free.png';">
<img src="images/free.png" alt="free" style="width: 150px;" class="img" id="img_4" onClick="show_hide_div('showmore1');show_hide_div('defaultdiv')" ></a><br />

<a href="#" 
onMouseOver="document.img_5.src='images/more2.png';"
onMouseOut="document.img_5.src='images/secured.png';">
<img src="images/secured.png" alt="free" style="width: 150px;" class="img" id="img_5" onClick="show_hide_div('showmore2');show_hide_div('defaultdiv') " ></a><br />

<a href="#" 
onMouseOver="document.img_6.src='images/more3.png';"
onMouseOut="document.img_6.src='images/online-desk.png';">
<img src="images/online-desk.png" alt="online desk" style="width: 150px;" class="img" id="img_6" onClick="show_hide_div('showmore3');show_hide_div('defaultdiv')" ></a><br />
</div>

<div style="position: absolute; top: 500px; width: 74%; margin-left: 12%; margin-right: 12%;">
<p style="font-size: 25px;  color: rgb(190,190,190); text-align: center;">To discover iData, clic on a button !</p>
</div>
</div>	
</div>
<footer style="background-color: rgb(180,180,180); width: 100%; position: absolute; left: 0px; top: 1010px;  font-size: 12px;">
	<p>Page available in : <a href="/fr">French</a> -- <a href="warning.php">HTTPS version</a>  -- <a href="about.php">About us</a> -- <a href="https://www.facebook.com/idata.cloud">Facebook</a> -- <a href="https://twitter.com/iDatacloud">Twitter</a> -- Partners : <a href="http://mtfo.fr/" target="_blank"><img src="images/mtfo.png" alt="MTFO" style="height: 25px; position: relative; top: 5px;"></a> <a href="http://www.geektheory.net/" target="_blank"><img src="../images/gt.png" alt="Geek Theory" style="height: 25px; position: relative; top: 6px;"></a> -- Copyright Evan OLLIVIER 2013-2014</p>
</footer>

</body>
</html>