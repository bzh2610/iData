<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style2.css" />
        <title>iData premium</title>
		<link rel="icon" type="image/png" href="cloud.png" />
</head>	
    <body style="background-color: rgb(230,230,255);">	
	<?php include_once("piwiktrack.php"); ?>
	<?php include_once("header-en.php"); ?>
	
<div style="position: absolute; top: 145px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;"></p></a>
</div>


<div style="position: absolute; top: 195px; width: 40%; right: 10%;">
<a href="#tableprice" 
onMouseOver="document.img_4.src='../images/more1.png';"
onMouseOut="document.img_4.src='../images/buy.png';">
<img src="../images/buy.png" alt="free" style="width: 150px;" class="img" id="img_4" onClick="show_hide_div('showmore1');show_hide_div('defaultdiv')" ></a><br />

<a href="#coupon" 
onMouseOver="document.img_5.src='../images/more2.png';"
onMouseOut="document.img_5.src='../images/activate.png';">
<img src="../images/activate.png" alt="free" style="width: 150px;" class="img" id="img_5"> </a><br />

<a href="features.php#price" 
onMouseOver="document.img_6.src='../images/more3.png';"
onMouseOut="document.img_6.src='../images/learnmore.png';">
<img src="../images/learnmore.png" alt="online desk" style="width: 150px;" class="img" id="img_6"></a><br />
</div>	

<script>
function show_hide_div(nomdiv){
var lediv = document.getElementById(nomdiv);
if(lediv.style.display=="block")
lediv.style.display="none";
else
lediv.style.display="block";
}

function hide_div(nomdiv){
var lediv = document.getElementById(nomdiv);
lediv.style.display="none";
}
</script>
	
	<div style="margin-top: 80px; border: 0px; font-family: 'Century Gothic', Arial; position: absolute; top: 500px; width: 74%; margin-left: 12%; margin-right: 12%;">
	
<table id="tableprice">
<caption>Price for 1 month</caption>

   <tr>
       <th></th>
	   <th>50Go</th>
	   <th>100Go</th>
	   <th>200Go</th>
   </tr>
   <tr>
       <th>iData</th>
	   <td>0.75$</td>
	   <td>1.49$</td>
	   <td>2.99$</td>
   </tr>
   <tr>
       <th>Google Drive</th>
	   <td>-</td>
	   <td>4.99$</td>
	   <td>9.99$</td>
   </tr>
      <tr>
       <th>Dropbox</th>
	   <td>-</td>
	   <td>9.99$</td>
   	   <td>19.99$</td>
   </tr>
   
</table>
<br /><br />
<p style="color: rgb(190,190,190); font-size: 25px; text-align: center;">Storage :<br /><br />
<a style="text-decoration: none;" onClick="show_hide_div('50'); hide_div('100'); hide_div('200')" href="#tableprice">50 Go</a> |
<a style="text-decoration: none;" onClick="show_hide_div('100'); hide_div('50'); hide_div('200')" href="#tableprice">100 Go</a> |
<a style="text-decoration: none;" onClick="show_hide_div('200'); hide_div('50'); hide_div('100')" href="#tableprice">200 Go</a></p>

<div id="50" style="Display: none;">
<p style="text-align: center; color: rgb(190,190,190);"><br />_________________________________<br /></p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6GJ3MWA4MR3QA">
<table>
<tr style="border: 0px;"><td style="border: 0px; color: rgb(190,190,190); font-size: 25px;" ><input type="hidden" name="on0" value="Durée">Lenth :</td></tr>
<tr style="border: 0px;"><td style="border: 0px;"><select name="os0">
	<option value="1 mois">1 month $0,75 USD</option>
	<option value="2 mois">2 months $1,50 USD</option>
	<option value="3 mois">3 months $2,25 USD</option>
	<option value="6 mois">6 months $4,50 USD</option>
	<option value="12 mois">12 months $9,00 USD</option>
</select> </td></tr>
</table>
<input style="border: 0px;" type="hidden" name="currency_code" value="USD">
<p style="text-align: center;"><input type="image" src="http://idata.no-ip.info/buy.png" style="width: 100px;" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
</p>
<img style="text-align: center;" alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">

</form>
</div>

<div id="100" style="Display: none;">
<p style="text-align: center; color: rgb(190,190,190);"><br />_________________________________<br /></p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="BMZ58N9M96WQJ">
<table>
<tr style="border: 0px;"><td style="border: 0px; color: rgb(190,190,190); font-size: 25px;"><input type="hidden" name="on0" value="Lenth :">Lenth :</td></tr>
<tr style="border: 0px;"><td style="border: 0px;"><select name="os0">
	<option value="1 month">1 month $1,49 USD</option>
	<option value="2 months">2 months $2,98 USD</option>
	<option value="3 months">3 months $4,47 USD</option>
	<option value="6 months">6 months $8,94 USD</option>
	<option value="12 months">12 months $17,88 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<p style="text-align: center;"><input type="image" src="http://idata.no-ip.info/buy.png" style="width: 100px;" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
</p>
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>
</div>


<div id="200" style="Display: none;">
<p style="text-align: center; color: rgb(190,190,190);"><br />_________________________________<br /></p>
<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="2NAZAK7AYMF4Y">
<table>
<tr style="border: 0px;"><td style="border: 0px; color: rgb(190,190,190); font-size: 25px;"><input type="hidden" name="on0" value="Lenth :">Lenth :</td></tr>
<tr style="border: 0px;"><td style="border: 0px;"><select name="os0">
	<option value="1 month">1 month $2,99 USD</option>
	<option value="2 months">2 months $5,98 USD</option>
	<option value="3 months">3 months $8,97 USD</option>
	<option value="6 months">6 months $17,94 USD</option>
	<option value="12 months">12 months $35,88 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<p style="text-align: center;"><input type="image" src="http://idata.no-ip.info/buy.png" style="width: 100px;" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
</p>
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>
</div>

<p style="text-align: center; color: rgb(190,190,190);"><br />_________________________________</p>

<br /><br /><p id="coupon" style="color: rgb(190,190,190); font-size: 25px; text-align: center;">Use a coupon :</p>
<a href="premium.php" style="color: rgb(190,190,190); font-size: 20px; text-align: center; text-decoration: none;">
<p style="text-align: center;"><br /><img alt="coupon" src="coupon.png" style="width: 180px;"></p></a>
	</div>
	
	
<footer style="background-color: rgb(180,180,180); width: 100%; position: absolute; left: 0px; top: 1700px; font-family: 'Century Gothic', Arial; font-size: 12px;">
<p style=" font-family: 'Century Gothic', Arial; font-size: 12px;">1- Refer to Google Drive and DropBox prices for october 2013</p>
	<p>Page available in : <a href="/fr">French</a> -- <a href="warning.php">HTTPS version</a>  -- <a href="about.php">About us</a> -- <a href="https://www.facebook.com/idata.cloud">Facebook</a> -- Partners : <a href="http://mtfo.fr/" target="_blank"><img src="images/mtfo.png" alt="MTFO" style="height: 25px; position: relative; top: 5px;"></a> <a href="http://www.geektheory.net/" target="_blank"><img src="../images/gt.png" alt="Geek Theory" style="height: 25px; position: relative; top: 6px;"></a> -- Copyright Evan OLLIVIER 2013</p>
</footer>

</body>
</html>
