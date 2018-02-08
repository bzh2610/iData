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
	<title>iData</title>
<meta charset="utf-8" />
<meta name="Description" content="iData le cloud sécurisé, sauvegardez, partagez et éditez vos documents."/>
<meta name="Keywords" content=""/>

<link rel="icon" type="image/png" href="../cloud.png" />
<meta name="viewport" content="width=device-width"/>

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
</div>

<!-- CORPS -->
<div id="defaultdiv" style="position: absolute; width: 100%; left:0px; top:10%; ">
<a href="" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;">
</p>
</a>
<br />
<p style="text-align: center;">
<a href="#">
<img src="../images/freefr.png" alt="Gratuit" style="width: 28%;" class="img" id="img_4" onClick="show_div('showmore1');hide_div('defaultdiv')" ></a>

<a href="#">
<img src="../images/securedfr.png" alt="Sécurisé" style="width: 28%;" class="img" id="img_5" onClick="show_div('showmore2');hide_div('defaultdiv')" ></a>

<a href="#">
<img src="../images/online-deskfr.png" alt="Bureau en ligne" style="width: 28%;" class="img" id="img_6" onClick="show_div('showmore3'); hide_div('defaultdiv');"></a>
</p>
</div>

<!-- 4th -->
<div id="showmore3" style="background-color: rgb(0,240,172); display: none; width: 100%; position: absolute; left: 0px; top:10%;">
<h2 style="text-align: center; font-size: 35px; color: rgb(250,250,250);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;">
</p>
<br />

<p style="text-align: center;">
<a href="#">
<img src="../images/freefr.png" alt="Gratuit" style="width: 28%;" onClick="show_hide_div('showmore1');show_hide_div('showmore3')" ></a>

<a href="#">
<img src="../images/securedfr.png" alt="Sécurisé" style="width: 28%;" onClick="show_hide_div('showmore2');show_hide_div('showmore3')" ></a>

<a href="#">
<img src="../images/online-deskfr.png" alt="Bureau en ligne" style="width: 28%;" onClick="show_hide_div('showmore3');show_hide_div('showmore3')" ></a>
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
<div style="background-color: rgb(0,190,200); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 10%;" id="showmore2" >
<h2 style="text-align: center; font-size: 35px; color: rgb(250,250,250);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;">


<p style="text-align: center;">
<a href="#" >
<img src="../images/freefr.png" alt="free"  style="width: 28%;" class="img" id="img_1" onClick="show_hide_div('showmore1');show_hide_div('showmore2')" ></a>

<a href="#" >
<img src="../images/securedfr.png" alt="free" style="width: 28%;" class="img" id="img_2" onClick="show_hide_div('showmore2');show_hide_div('showmore2')" ></a>

<a href="#" >
<img src="../images/online-deskfr.png" alt="online desk" style="width: 28%;" class="img" id="img_3" onClick="show_hide_div('showmore3');show_hide_div('showmore2')" ></a>
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

<div style="background-color: rgb(0,194,212); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 10%;" id="showmore1" >
<h2 style="text-align: center; font-size: 35px; color: rgb(250,250,250);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;">

<p style="text-align: center;">
<a href="#">
<img src="../images/freefr.png" alt="free"  style="width: 28%;" class="img" id="img_7" onClick="show_hide_div('showmore1');show_hide_div('showmore1')" ></a>

<a href="#" >
<img src="../images/securedfr.png" alt="free" style="width: 28%;" class="img" id="img_8" onClick="show_hide_div('showmore2');show_hide_div('showmore1') " ></a>

<a href="#" >
<img src="../images/online-deskfr.png" alt="online desk" style="width: 28%;" class="img" id="img_9" onClick="show_hide_div('showmore3');show_hide_div('showmore1')" ></a>
</p>

<p style="font-family: 'Century Gothic', Arial; color: white; width: 90%; margin-left: 5%;">
iData est gratuit et ne comporte pas de publicité. Inscrivez vous et vous bénéficierez d'1Go de stockage en ligne pour sauvegarder que vous voulez.</p>
</div>
</body>
</html>







<?php } else { ?>







<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
<meta name="Description" content="iData le cloud sécurisé, sauvegardez, partagez et éditez vos documents en ligne."/>
<meta name="Keywords" content="cloud, computing, data, online, sauvegarde, ligne"/>
       <link rel="stylesheet" href="../style2.css" />
        <title>iData</title>
		<link rel="icon" type="image/png" href="../images/favicon.png" />
    </head>
	
<body>
<?php include_once("../piwiktrack.php"); ?>
<?php include_once("header-fr.php"); ?>

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

<div style="background-color: rgb(0,210,148); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;" id="showmore3" >
<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;">
</p>
</a>
</div>

<div style="position: absolute; top: 150px; right: 0px; width:50%;">
<a href="#" 
onMouseOver="document.img_10.src='../images/more1.png';"
onMouseOut="document.img_10.src='../images/freefr.png';">
<img src="../images/freefr.png" alt="free" style="width: 150px;" class="img" id="img_10" onClick="show_hide_div('showmore1');show_hide_div('showmore3')" ></a><br />

<a href="#" 
onMouseOver="document.img_11.src='../images/more2.png';"
onMouseOut="document.img_11.src='../images/securedfr.png';">
<img src="../images/securedfr.png" alt="secured" style="width: 150px;" class="img" id="img_11" onClick="show_hide_div('showmore2');show_hide_div('showmore3')" ></a><br />

<a href="#" 
onMouseOver="document.img_12.src='../images/more3.png';"
onMouseOut="document.img_12.src='../images/online-deskfr.png';">
<img src="../images/online-deskfr.png" alt="online desk" style="width: 150px;" class="img" id="img_12" onClick="show_hide_div('showmore3');show_hide_div('showmore3')" ></a><br />

</div>
<div style="position: absolute; top: 400px; width: 74%; margin-left: 12%; margin-right: 12%;">
<p style="font-size: 25px; font-family: 'Century Gothic', Arial; color: white;">
Avec iData, tout votre bureau est sur le cloud : nous vous fournissons un éditeur de texte et un gestionnaire de comptes. Vous pouvez re-télécharger et partager tout ce que vous avez mis en ligne. 
Apportez vos vidéos, vos photos, votre musique et vos documents partout avec vous.<br />
<br />
<img src="../ppt.png" alt="ppt" class="prespics"><img src="../avi.png" alt="avi" class="prespics"><img src="../mp3.png" alt="mp3" class="prespics"><img src="../xls.png" alt="xls" class="prespics"><img src="../exe.png" alt="exe" class="prespics"><img src="../zip.png" alt="zip" class="prespics">
<br />
iData vous aide à travailler : créez des rappels, nous vous enverrons un e-mail quand vous le déciderez.</div>
</div>

<!--THIRD-->
<div style="background-color: rgb(0,187,176); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;" id="showmore2" >
<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;">
</p>
</a>
</div>

<div style="position: absolute; top: 150px; right: 0px; width:50%;">
<a href="#" 
onMouseOver="document.img_1.src='../images/more1.png';"
onMouseOut="document.img_1.src='../images/freefr.png';">
<img src="../images/freefr.png" alt="free" style="width: 150px;" class="img" id="img_1" onClick="show_hide_div('showmore1');show_hide_div('showmore2')" ></a><br />

<a href="#" 
onMouseOver="document.img_2.src='../images/more2.png';"
onMouseOut="document.img_2.src='../images/securedfr.png';">
<img src="../images/securedfr.png" alt="free" style="width: 150px;" class="img" id="img_2" onClick="show_hide_div('showmore2');show_hide_div('showmore2')" ></a><br />

<a href="#" 
onMouseOver="document.img_3.src='../images/more3.png';"
onMouseOut="document.img_3.src='../images/online-deskfr.png';">
<img src="../images/online-deskfr.png" alt="online desk" style="width: 150px;" class="img" id="img_3" onClick="show_hide_div('showmore3');show_hide_div('showmore2')" ></a><br />
</div>

<div style="position: absolute; top: 400px; width: 74%; margin-left: 12%; margin-right: 12%;">
<p style="font-size: 25px; font-family: 'Century Gothic', Arial; color: white;"><img src="../lock.png" alt="lock" style="float: left;">
iData est sécurisé : les informations secrètes telles que vos mots de passe sont protégées par un hash de 512 bits.<br />
Vous travaillez avec des fichiers sensibles ? Nous vous offrons la possibilité d'utiliser le HTTPS pour crypter vos transactions.<br />
De plus, pour nous prémunir des attaques, nous bloquons les connexions non HTTP(S) provenant de l'extérieur. Ce que nous faisons ne quitte jamais iData.<br />
Nos serveurs sont hébergés dans nos propres bureaux, en France.<br />
</div>
</div>

<!--SECOND-->

<div style="background-color: rgb(0,194,212); display: none; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;" id="showmore1" >
<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;"></p></a>
</div>

<div style="position: absolute; top: 150px; right: 0px; width:50%;">
<a href="#" 
onMouseOver="document.img_7.src='../images/more1.png';"
onMouseOut="document.img_7.src='../images/freefr.png';">
<img src="../images/freefr.png" alt="free" style="width: 150px;" class="img" id="img_7" onClick="show_hide_div('showmore1');show_hide_div('showmore1')" ></a><br />

<a href="#" 
onMouseOver="document.img_8.src='../images/more2.png';"
onMouseOut="document.img_8.src='../images/securedfr.png';">
<img src="../images/securedfr.png" alt="free" style="width: 150px;" class="img" id="img_8" onClick="show_hide_div('showmore2');show_hide_div('showmore1') " ></a><br />

<a href="#" 
onMouseOver="document.img_9.src='../images/more3.png';"
onMouseOut="document.img_9.src='../images/online-deskfr.png';">
<img src="../images/online-deskfr.png" alt="online desk" style="width: 150px;" class="img" id="img_9" onClick="show_hide_div('showmore3');show_hide_div('showmore1')" ></a><br />

</div>
<div style="position: absolute; top: 400px; width: 74%; margin-left: 12%; margin-right: 12%;">
<p style="font-size: 25px; font-family: 'Century Gothic', Arial; color: white;">
iData est gratuit et ne comporte pas de publicité. Inscrivez vous et vous bénéficierez d'1Go de stockage en ligne pour sauvegarder que vous voulez.</p>
</div>
</div>

<!--FIRST-->
<div id="defaultdiv" style="background-color: rgb(230,230,254); display: block; width: 100%; height: 1000px; position: absolute; left: 0px; top: 45px;">
<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;"></p></a>
</div>


<div style="position: absolute; top: 150px; right: 0px; width:50%;">
<a href="#" 
onMouseOver="document.img_4.src='../images/more1.png';"
onMouseOut="document.img_4.src='../images/freefr.png';">
<img src="../images/freefr.png" alt="free" style="width: 150px;" class="img" id="img_4" onClick="show_hide_div('showmore1');show_hide_div('defaultdiv')" ></a><br />

<a href="#" 
onMouseOver="document.img_5.src='../images/more2.png';"
onMouseOut="document.img_5.src='../images/securedfr.png';">
<img src="../images/securedfr.png" alt="free" style="width: 150px;" class="img" id="img_5" onClick="show_hide_div('showmore2');show_hide_div('defaultdiv') " ></a><br />

<a href="#" 
onMouseOver="document.img_6.src='../images/more3.png';"
onMouseOut="document.img_6.src='../images/online-deskfr.png';">
<img src="../images/online-deskfr.png" alt="online desk" style="width: 150px;" class="img" id="img_6" onClick="show_hide_div('showmore3');show_hide_div('defaultdiv')" ></a><br />
</div>

<div style="position: absolute; top: 500px; width: 74%; margin-left: 12%; margin-right: 12%;">
<p style="font-size: 25px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190); text-align: center;">
Pour découvrir iData cliquez sur un bouton !</p>
</div>
</div>	

<footer style="background-color: rgb(180,180,180); width: 100%; position: absolute; left: 0px; top: 1010px;">
	<p style="display: inline;font-family:'Century Gothic', Arial; font-size: 12px;" >

<a href="../index.php?lang=en">
<img src="../images/en.png" alt="english" style="width: 35px; position: relative; top: 10px; left: 10px;"></a>
<a href="?mobile">
<img src="../images/phone.png" alt="mobile" style="width: 35px; position: relative; top: 5px; left: 10px;"></a>
<a href="../warning.php">
<img src="../lock.png" style="width:45px; position: relative; top: 8px; left:5px;" alt="HTTPS"></a>
<a href="../about.php">
<img src="../images/who.png" alt="A propos" style="width:35px; position: relative; top: 5px;"></a>
<a href="https://www.facebook.com/idata.cloud">
<img style="width: 35px;position: relative; top: 5px;" src="../images/fb.png" alt="Facebook"></a>
<a href="https://twitter.com/iDatacloud">
<img style="width: 35px;position: relative; top: 5px;" src="../images/tw.png" alt="Twitter"></a></p>



<div style="float: right;">
<p style="font-family:'Century Gothic', Arial; font-size: 12px;" >Partenaires : 
<a href="http://mtfo.fr/" target="_blank">
<img src="../images/mtfo.png" alt="MTFO" style="height: 25px; position: relative; top: 5px;"></a>
<a href="http://www.geektheory.net/" target="_blank">
<img src="../images/gt.png" alt="Geek Theory" style="height: 25px; position: relative; top: 6px;"></a>
<a href="http://www.deusexcorp.tk/" target="_blank">
<img src="../images/dx.png" alt="Deus ex corp" style="height: 32px; position: relative; top: 6px;"></a></p>
</div>	

<p style="font-family:'Century Gothic', Arial; font-size: 12px; text-align: center;" >
Copyright © 2013-2014 Evan OLLIVIER. Tous droits réservés.</p>
</footer>

</body>
</html>
<?php } ?>