<?php
session_start();

$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
$mobile_browser = true;
}

if(isset ($_GET['desktop'])){
 $mobile_browser = false;
}

if(isset ($_GET['mobile'])){
 $mobile_browser = true;
}

if($mobile_browser == true){ ?>

<!DOCTYPE html>
<html>
    <head>
<meta charset="utf-8" />
<meta name="Description" content="iData"/>
<meta name="Keywords" content=""/>
<title>iData</title>
<link rel="icon" type="image/png" href="../cloud.png" />
<meta name="viewport" content="width=device-width"/>
<style>
table
{
border-collapse: collapse;
color: rgb(190,190,190);
text-align: center;
margin: auto;
}

td, th
{
padding: 5px;
border: 2px solid rgb(190,190,190);
}
</style>
</head>

<body style="font-family: 'Century Gothic', Arial;">
<?php include_once("../piwiktrack.php"); ?>

<script>
function show_div(nomdiv){
var lediv = document.getElementById(nomdiv);
lediv.style.display="block";
}

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

<?php
if (!isset ($_SESSION['accountid'])){ ?>
<div style="z-index: 1; width: 100%; min-height: 30px; height: 10%; position: absolute; left: 0px; top: 0px; background-color: rgb(104,104,104);"> <!-- Menu bar-->
	<a href="#" onclick="signin.style.display='block'; talkbox.style.display='block'; upbtn.style.display='none';">
	<img src="../images/hoversigninfr.png" alt="menu" style="position: absolute; height: 100%; right: 0%;"/></a>
</div>
<?php
}
else{?>
<div style="z-index: 1; width: 100%; min-height: 30px; height: 10%; position: absolute; left: 0px; top: 0px; background-color: rgb(104,104,104);"> <!-- Menu bar-->
	<a style="text-decoration: none; right: 0px; position: absolute; top: 30%; color: white;  height: 18px;" href="mydocs.php">
	<?php echo $_SESSION['username'];?> &nbsp </a>
</div>
<?php
}
?>
<a href="#" onclick="mmenu.style.display='block'; signin.style.display='block'; ">
	<img src="../images/mobilemenu.png" alt="menu" style="z-index: 2; position: absolute; top: 0px; left: 0px; height: 10%;"/></a>
	
<div id="mmenu" style="z-index: 3; display: none; width: 40%; position: fixed; height: 100%; left: 0px; top: 0px; background-color: rgb(104,104,104);"> <!-- Menu bar-->
<? if (!isset ($_SESSION['accountid'])){ ?>
	<p style="position: relative; text-align: center; color: white; height: 150%; ">
	<a style="color: white; text-decoration: none;" href="index.php">Accueil</a><br /><br />		
	<a style="color: white; text-decoration: none;" href="signup.php">S'inscrire</a><br /><br />
	<a style="color: white; text-decoration: none;" href="features.php">Fonctionnalités</a><br /><br />
	<a style="color: white; text-decoration: none;" href="plans.php">Forfaits</a><br /><br />
	<a style="color: white; text-decoration: none;" href="?desktop">Version PC</a><br /><br />
	<a style="color: white; text-decoration: none;" href="about.php">A propos</a><br /><br />
	</p>
<?php } else { ?>
	<p style="position: relative; text-align: center; color: white; height: 150%; ">
	<a style="color: white; text-decoration: none;" href="index.php">Accueil</a><br /><br />
	<a style="color: white; text-decoration: none;" href="mydocs.php">Mes Documents</a><br /><br />
	<a style="color: white; text-decoration: none;" href="plans.php">Forfaits</a><br /><br />
	<a style="color: white; text-decoration: none;" href="settings.php">Paramètres</a><br /><br />
	<a style="color: white; text-decoration: none;" href="mydocs.php">Aide</a><br /><br />
	<a style="color: white; text-decoration: none;" href="../logout.php">Se déconnecter</a><br /><br />
	<a style="color: white; text-decoration: none;" href="?desktop">Version PC</a><br /><br />
	<a style="color: white; text-decoration: none;" href="about.php">A propos</a><p>
<?php } ?>
</div>

<div id="signin" onclick="location.reload()" style="z-index: 1; display: none; width: 100%; height: 100%; px; position: fixed; top: 0px; right:0px; background-color: rgb(0,0,0); opacity: 0.5;">
</div>

<div id="talkbox" style="z-index: 2; opacity: 1; display: none; background-color: rgb(255,255,255);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(100,100,100); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;  width: 240px; height: 200px; position: fixed; margin: -100px 0 0 -120px;  text-align: center;">
	<div style="position: relative; top: -20px;">
	<form method="post" action="signin.php">
	<p style="font-size: 18px;">Pseudo : <br /><input type="text" name="username"/></p>
	<p style="font-size: 18px;">Mot de passe : <input type="password" name="password"/></p>
	<p style="font-size: 18px;"><input type="checkbox" name="rememberme"/>Connexion automatique</p>
	<input type="submit" value="Connexion">
	</form>
	</div>
</div><!--corps-->

<div id="defaultdiv" style="position: absolute; width: 100%; left:0px; top:10%; ">
<a href="" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;">
</p>
</a>
<br />
<p style="text-align: center;">
<a href="#tableprice">
<img src="../images/buyfr.png" alt="free" style="width: 28%;" onClick="show_hide_div('showmore1');show_hide_div('defaultdiv')" ></a>

<a href="#coupon">
<img src="../images/activatefr.png" alt="free" style="width: 28%;"></a>

<a href="features.php#price">
<img src="../images/learnmorefr.png" alt="online desk" style="width: 28%;"></a>
</p>
</div>
	
	<div style="margin-top: 80px; border: 0px; position: absolute; top: 500px; width: 74%; margin-left: 12%; margin-right: 12%;">
	
<table id="tableprice">
<caption>Prix pour 1 mois</caption>

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
<p style="color: rgb(190,190,190); font-size: 25px; text-align: center;">Stockage :<br /><br />
<a style="text-decoration: none;" onClick="show_hide_div('50'); hide_div('100'); hide_div('200')" href="#50">50 Go</a> |
<a style="text-decoration: none;" onClick="show_hide_div('100'); hide_div('50'); hide_div('200')" href="#100">100 Go</a> |
<a style="text-decoration: none;" onClick="show_hide_div('200'); hide_div('50'); hide_div('100')" href="#200">200 Go</a></p>

<div id="50" style="Display: none;">
<p style="text-align: center; color: rgb(190,190,190);"><br />_________________________________<br /></p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6GJ3MWA4MR3QA">
<table>
<tr style="border: 0px;"><td style="border: 0px; color: rgb(190,190,190); font-size: 25px;" ><input type="hidden" name="on0" value="Lenth">Durée :</td></tr>
<tr style="border: 0px;"><td style="border: 0px;"><select name="os0">
	<option value="1 month">1 mois $0,75 USD</option>
	<option value="2 months">2 mois $1,50 USD</option>
	<option value="3 months">3 mois $2,25 USD</option>
	<option value="6 months">6 mois $4,50 USD</option>
	<option value="12 months">12 mois $9,00 USD</option>
</select> </td></tr>
</table>
<input style="border: 0px;" type="hidden" name="currency_code" value="USD">
<p style="text-align: center;">
<input type="image" src="http://idata.no-ip.info/images/buy-fr-2.png" style="width: 100px;" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
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
<tr style="border: 0px;"><td style="border: 0px; color: rgb(190,190,190); font-size: 25px;"><input type="hidden" name="on0" value="Lenth :">Durée :</td></tr>
<tr style="border: 0px;"><td style="border: 0px;"><select name="os0">
	<option value="1 month">1 mois $1,49 USD</option>
	<option value="2 months">2 mois $2,98 USD</option>
	<option value="3 months">3 mois $4,47 USD</option>
	<option value="6 months">6 mois $8,94 USD</option>
	<option value="12 months">12 mois $17,88 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<p style="text-align: center;"><input type="image" src="http://idata.no-ip.info/images/buy-fr-2.png" style="width: 100px;" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
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
<tr style="border: 0px;"><td style="border: 0px; color: rgb(190,190,190); font-size: 25px;"><input type="hidden" name="on0" value="Lenth :">Durée :</td></tr>
<tr style="border: 0px;"><td style="border: 0px;"><select name="os0">
	<option value="1 month">1 mois $2,99 USD</option>
	<option value="2 months">2 mois $5,98 USD</option>
	<option value="3 months">3 mois $8,97 USD</option>
	<option value="6 months">6 mois $17,94 USD</option>
	<option value="12 months">12 mois $35,88 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<p style="text-align: center;"><input type="image" src="http://idata.no-ip.info/images/buy-fr-2.png" style="width: 100px;" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
</p>
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
	
<p style="text-align: center; color: rgb(190,190,190);"><br />_________________________________</p>

<br /><br /><p id="coupon" style="color: rgb(190,190,190); font-size: 25px; text-align: center;">Utiliser un code :</p>
<a href="premium.php" style="color: rgb(190,190,190); font-size: 20px; text-align: center; text-decoration: none;">
<p style="text-align: center;"><br /><img alt="coupon" src="../coupon.png" style="width: 180px;"></p></a>
	</div>
	
</body>
</html>



<?php }else{ ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../style2.css" />
        <title>iData premium</title>
		<link rel="icon" type="image/png" href="../cloud.png" />
</head>	
    <body style="background-color: rgb(230,230,255);">	
<?php include_once("../piwiktrack.php"); ?>
<?php include_once("header-fr.php"); ?>

<div style="position: absolute; top: 145px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;"></p></a>
</div>


<div style="position: absolute; top: 195px; width: 40%; right: 10%;">
<a href="#tableprice" 
onMouseOver="document.img_4.src='../images/more1.png';"
onMouseOut="document.img_4.src='../images/buyfr.png';">
<img src="../images/buyfr.png" alt="free" style="width: 150px;" class="img" id="img_4" onClick="show_hide_div('showmore1');show_hide_div('defaultdiv')" ></a><br />

<a href="#coupon" 
onMouseOver="document.img_5.src='../images/more2.png';"
onMouseOut="document.img_5.src='../images/activatefr.png';">
<img src="../images/activatefr.png" alt="free" style="width: 150px;" class="img" id="img_5"> </a><br />

<a href="features.php#price" 
onMouseOver="document.img_6.src='../images/more3.png';"
onMouseOut="document.img_6.src='../images/learnmorefr.png';">
<img src="../images/learnmorefr.png" alt="online desk" style="width: 150px;" class="img" id="img_6"></a><br />
</div>	

<script>
function show_hide_div(nomdiv){
var lediv = document.getElementById(nomdiv);
if(lediv.style.display=="block")
lediv.style.display="none";
else
lediv.style.display="block";
}
</script>

<script>
function hide_div(nomdiv){
var lediv = document.getElementById(nomdiv);
lediv.style.display="none";
}
</script>
	
	<div style="margin-top: 80px; border: 0px; font-family: 'Century Gothic', Arial; position: absolute; top: 500px; width: 74%; margin-left: 12%; margin-right: 12%;">
	
<table id="tableprice">
<caption>Prix pour 1 mois</caption>

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
<p style="color: rgb(190,190,190); font-size: 25px; text-align: center;">Stockage :<br /><br />
<a style="text-decoration: none;" onClick="show_hide_div('50'); hide_div('100'); hide_div('200')" href="#50">50 Go</a> |
<a style="text-decoration: none;" onClick="show_hide_div('100'); hide_div('50'); hide_div('200')" href="#100">100 Go</a> |
<a style="text-decoration: none;" onClick="show_hide_div('200'); hide_div('50'); hide_div('100')" href="#200">200 Go</a></p>

<div id="50" style="Display: none;">
<p style="text-align: center; color: rgb(190,190,190);"><br />_________________________________<br /></p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="6GJ3MWA4MR3QA">
<table>
<tr style="border: 0px;"><td style="border: 0px; color: rgb(190,190,190); font-size: 25px;" ><input type="hidden" name="on0" value="Lenth">Durée :</td></tr>
<tr style="border: 0px;"><td style="border: 0px;"><select name="os0">
	<option value="1 month">1 mois $0,75 USD</option>
	<option value="2 months">2 mois $1,50 USD</option>
	<option value="3 months">3 mois $2,25 USD</option>
	<option value="6 months">6 mois $4,50 USD</option>
	<option value="12 months">12 mois $9,00 USD</option>
</select> </td></tr>
</table>
<input style="border: 0px;" type="hidden" name="currency_code" value="USD">
<p style="text-align: center;"><input type="image" src="http://idata.no-ip.info/images/buy-fr-2.png" style="width: 100px;" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
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
<tr style="border: 0px;"><td style="border: 0px; color: rgb(190,190,190); font-size: 25px;"><input type="hidden" name="on0" value="Lenth :">Durée :</td></tr>
<tr style="border: 0px;"><td style="border: 0px;"><select name="os0">
	<option value="1 month">1 mois $1,49 USD</option>
	<option value="2 months">2 mois $2,98 USD</option>
	<option value="3 months">3 mois $4,47 USD</option>
	<option value="6 months">6 mois $8,94 USD</option>
	<option value="12 months">12 mois $17,88 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<p style="text-align: center;"><input type="image" src="http://idata.no-ip.info/images/buy-fr-2.png" style="width: 100px;" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
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
<tr style="border: 0px;"><td style="border: 0px; color: rgb(190,190,190); font-size: 25px;"><input type="hidden" name="on0" value="Lenth :">Durée :</td></tr>
<tr style="border: 0px;"><td style="border: 0px;"><select name="os0">
	<option value="1 month">1 mois $2,99 USD</option>
	<option value="2 months">2 mois $5,98 USD</option>
	<option value="3 months">3 mois $8,97 USD</option>
	<option value="6 months">6 mois $17,94 USD</option>
	<option value="12 months">12 mois $35,88 USD</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="USD">
<p style="text-align: center;"><input type="image" src="http://idata.no-ip.info/images/buy-fr-2.png" style="width: 100px;" border="0" name="submit" alt="PayPal - la solution de paiement en ligne la plus simple et la plus sécurisée !">
</p>
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>
</div>
	
<p style="text-align: center; color: rgb(190,190,190);"><br />_________________________________</p>

<br /><br /><p id="coupon" style="color: rgb(190,190,190); font-size: 25px; text-align: center;">Utiliser un code :</p>
<a href="premium.php" style="color: rgb(190,190,190); font-size: 20px; text-align: center; text-decoration: none;">
<p style="text-align: center;"><br /><img alt="coupon" src="../coupon.png" style="width: 180px;"></p></a>
	</div>
	
<footer style="background-color: rgb(180,180,180); width: 100%; position: absolute; left: 0px; top: 1700px;">
<p style=" font-family: 'Century Gothic', Arial; font-size: 12px;">1- Se référer aux tarifs de Google Drive et DropBox pour le mois d'octobre 2013</p>
	<p style="display: inline;font-family:'Century Gothic', Arial; font-size: 12px;" ><a href="../index.php?lang=en"><img src="../images/en.png" alt="english" style="width: 35px; position: relative; top: 10px; left: 10px;"></a> <a href="../warning.php"><img src="../lock.png" style="width:45px; position: relative; top: 8px; left:5px;" alt="HTTPS"></a> <a href="../about.php"><img src="../images/who.png" alt="A propos" style="width:35px; position: relative; top: 5px;"></a>  <a href="https://www.facebook.com/idata.cloud"><img style="width: 35px;position: relative; top: 5px;"src="../images/fb.png" alt="Facebook"></a><a href="https://twitter.com/iDatacloud"><img style="width: 35px;position: relative; top: 5px;"src="../images/tw.png" alt="Twitter"></a></p>
	<div style="float: right;"> <p style="font-family:'Century Gothic', Arial; font-size: 12px;" >Partenaires : <a href="http://mtfo.fr/" target="_blank"><img src="../images/mtfo.png" alt="MTFO" style="height: 25px; position: relative; top: 5px;"></a>   <a href="http://www.geektheory.net/" target="_blank"><img src="../images/gt.png" alt="Geek Theory" style="height: 25px; position: relative; top: 6px;"></a></p>
</div>	
<p style="font-family:'Century Gothic', Arial; font-size: 12px; text-align: center;" >Copyright © 2013 Evan OLLIVIER. Tous droits réservés.</p>
</footer>

</body>
</html>

<?php } ?>
