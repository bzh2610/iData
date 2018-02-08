<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
<meta charset="utf-8" />
<meta name="Description" content="iConnect"/>
<meta name="Keywords" content=""/>
<title>iData</title>
<link rel="icon" type="image/png" href="cloud.png" />
<meta name="viewport" content="width=device-width"/>
<style>
@media screen and (max-width: 960px)
{
   
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
<div style="width: 100%; height: 10%; position: absolute; left: 0px; top: 0px; background-color: rgb(104,104,104);"> <!-- Menu bar-->
	<a href="#" onclick="mmenu.style.display='block'; signin.style.display='block'; ">
	<img src="images/mobilemenu.png" alt="menu" style="height: 100%;"/></a>
	<a href="#" onclick="signin.style.display='block'; talkbox.style.display='block'; upbtn.style.display='none';">
	<img src="images/hoversigninfr.png" alt="menu" style="position: absolute; height: 100%; right: 0%;"/></a>
</div>
<?php
}
else{?>
<div style="width: 100%; height: 10%; position: absolute; left: 0px; top: 0px; background-color: rgb(104,104,104);"> <!-- Menu bar-->
	<a href="#" onclick="mmenu.style.display='block'; signin.style.display='block'; ">
	<img src="images/mobilemenu.png" alt="menu" style="height: 100%;"/></a>
	<a style="text-decoration: none; right: 0px; position: absolute; top: 30%; color: white;  height: 18px;" href="mydocs.php">
	<!--<img src="images/hovermyfilesfr.png" alt="menu" style="position: absolute; height: 100%; right: 0px;"/>-->
	<?php echo $_SESSION['username'];?> &nbsp </a>
</div>
<?php
}
?>

<div id="mmenu" style="z-index: 3; display: none; width: 40%; position: fixed; height: 100%; left: 0px; top: 0px; background-color: rgb(104,104,104);"> <!-- Menu bar-->
<? if (!isset ($_SESSION['accountid'])){ ?>
	<p style="position: relative; text-align: center; color: white; height: 150%; ">
	<a style="color: white; text-decoration: none;" href="fr/signup.php">S'inscrire</a><br /><br />
	<a style="color: white; text-decoration: none;" href="fr/features.php">Fonctionnalités</a><br /><br />
	<a style="color: white; text-decoration: none;" href="fr/plans.php">Forfaits</a><br /><br />
	<a style="color: white; text-decoration: none;" href="about.php">A propos</a><br /><br />
	</p>
<?php } else { ?>
	<p style="position: relative; text-align: center; color: white; height: 150%; ">
	<a style="color: white; text-decoration: none;" href="fr/mydocs.php">Mes Documents</a><br /><br />
	<a style="color: white; text-decoration: none;" href="fr/plans.php">Forfaits</a><br /><br />
	<a style="color: white; text-decoration: none;" href="fr/settings.php">Paramètres</a><br /><br />
	<a style="color: white; text-decoration: none;" href="fr/mydocs.php">Aide</a><br /><br />
	<a style="color: white; text-decoration: none;" href="logout.php">Se déconnecter</a><br /><br />
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
</div>

<!-- CORPS -->
<div id="defaultdiv" style="position: absolute; width: 100%; left:0px; margin-top:10%; ">
<h2 style="text-align: center; font-size: 35px; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;">
</p>
<br />
<p style="text-align: center;">
<a href="#">
<img src="images/freefr.png" alt="free" style="width: 28%;" class="img" id="img_4" onClick="show_div('showmore1');hide_div('defaultdiv')" ></a>

<a href="#">
<img src="images/securedfr.png" alt="free" style="width: 28%;" class="img" id="img_5" onClick="show_div('showmore2');hide_div('defaultdiv')" ></a>

<a href="#">
<img src="images/online-deskfr.png" alt="online desk" style="width: 28%;" class="img" id="img_6" onClick="show_div('showmore3'); hide_div('defaultdiv');"></a>
</p>
</div>

<!-- 4th -->
<div id="showmore3" style="background-color: rgb(0,240,172); display: none; width: 100%; position: absolute; left: 0px; margin-top:10%;">
<h2 style="text-align: center; font-size: 35px; color: rgb(250,250,250);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;">
</p>
<br />

<p style="text-align: center;">
<a href="#">
<img src="../images/freefr.png" alt="free" style="width: 28%;" onClick="show_hide_div('showmore1');show_hide_div('showmore3')" ></a>

<a href="#">
<img src="../images/securedfr.png" alt="secured" style="width: 28%;" onClick="show_hide_div('showmore2');show_hide_div('showmore3')" ></a>

<a href="#">
<img src="../images/online-deskfr.png" alt="online desk" style="width: 28%;" onClick="show_hide_div('showmore3');show_hide_div('showmore3')" ></a>
</p>

<p style="font-family: 'Century Gothic', Arial; color: white; width: 90%; margin-left: 5%;">
Avec iData, tout votre bureau est sur le cloud : nous vous fournissons un éditeur de texte et un gestionnaire de comptes. 
<br />Vous pouvez re-télécharger et partager tout ce que vous avez mis en ligne. 
<br />Apportez vos vidéos, vos photos, votre musique et vos documents partout avec vous.<br />
<br /></p>
<p style="text-align: center;">
<img src="../ppt.png" alt="ppt" style="width: 15%;"><img src="../avi.png" alt="avi" style="width: 15%;"><img src="../mp3.png" alt="mp3" style="width: 15%;"><img src="../xls.png" alt="xls" style="width: 15%;"><img src="../exe.png" alt="exe" style="width: 15%;"><img src="../zip.png" alt="zip" style="width: 15%;"></p>
<p style="font-family: 'Century Gothic', Arial; color: white; width: 90%; margin-left: 5%;">
iData vous aide à travailler : créez des rappels, nous vous enverrons un e-mail quand vous le déciderez.
</p>
</div>



<!--THIRD-->
<div style="background-color: rgb(0,190,200); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;" id="showmore2" >
<h2 style="text-align: center; font-size: 35px; color: rgb(250,250,250);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;">


<p style="text-align: center;">
<a href="#" >
<img src="images/freefr.png" alt="free"  style="width: 28%;" class="img" id="img_1" onClick="show_hide_div('showmore1');show_hide_div('showmore2')" ></a>

<a href="#" >
<img src="images/securedfr.png" alt="free" style="width: 28%;" class="img" id="img_2" onClick="show_hide_div('showmore2');show_hide_div('showmore2')" ></a>

<a href="#" >
<img src="images/online-deskfr.png" alt="online desk" style="width: 28%;" class="img" id="img_3" onClick="show_hide_div('showmore3');show_hide_div('showmore2')" ></a>
</p>


<p style="font-family: 'Century Gothic', Arial; color: white; width: 90%; margin-left: 5%;">
iData est sécurisé : les informations secrètes telles que vos mots de passe sont protégées par un hash de 512 bits.<br />
Vous travaillez avec des fichiers sensibles ? Nous vous offrons la possibilité d'utiliser le HTTPS pour crypter vos transactions.</p>
<p style="text-align: center;"><img src="../images/lock.png" alt="lock" style="height: 90px; padding: 5px;"></p>
<p style="font-family: 'Century Gothic', Arial; color: white; width: 90%; margin-left: 5%;">
De plus, pour nous prémunir des attaques, nous bloquons les connexions non HTTP(S) provenant de l'extérieur. Ce que nous faisons ne quitte jamais iData.<br />
Nos serveurs sont hébergés dans nos propres bureaux, en France.
</p>
</div>

<!--SECOND-->

<div style="background-color: rgb(0,194,212); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;" id="showmore1" >
<h2 style="text-align: center; font-size: 35px; color: rgb(250,250,250);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;">

<p style="text-align: center;">
<a href="#">
<img src="images/freefr.png" alt="free"  style="width: 28%;" class="img" id="img_7" onClick="show_hide_div('showmore1');show_hide_div('showmore1')" ></a>

<a href="#" >
<img src="images/securedfr.png" alt="free" style="width: 28%;" class="img" id="img_8" onClick="show_hide_div('showmore2');show_hide_div('showmore1') " ></a>

<a href="#" >
<img src="images/online-deskfr.png" alt="online desk" style="width: 28%;" class="img" id="img_9" onClick="show_hide_div('showmore3');show_hide_div('showmore1')" ></a>
</p>

<p style="font-family: 'Century Gothic', Arial; color: white; width: 90%; margin-left: 5%;">
iData est gratuit et ne comporte pas de publicité. Inscrivez vous et vous bénéficierez d'1Go de stockage en ligne pour sauvegarder que vous voulez.</p>
</div>
</body>
</html>