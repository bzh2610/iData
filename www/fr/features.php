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
		<title>iData</title>
<link rel="icon" type="image/png" href="../cloud.png" />
<meta name="viewport" content="width=device-width"/>
<style>
* {
    margin : 0;
    padding : 0;
}
</style>
	<script src="../js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/localscroll/jquery.localscroll.js"></script>
    <script type="text/javascript" src="../js/localscroll/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="../js/lancement.js"></script>
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
	<div style="position: absolute; height: 100%; text-align: center;">
	<form method="post" action="signin.php">
	<p style="font-size: 18px;">Pseudo : <br /><input type="text" name="username"/></p><br />
	<p style="font-size: 18px;">Mot de passe : <br/><input type="password" name="password"/></p><br />
	<p style="font-size: 18px;"><input type="checkbox" name="rememberme"/>Connexion automatique</p>
	<input type="submit" value="Connexion">
	</form>
	</div>
</div>


<div style="position: absolute; margin-top: 15%; right: 0px; width:100%; height:100%; text-align : center;">

<a href="#ecological" 
onMouseOver="document.img_17.src='../images/more8.png';"
onMouseOut="document.img_17.src='../images/ecologiquefr.png';">
<img src="../images/ecologiquefr.png" alt="Secured" style="width: 150px;" class="img" id="img_17"></a>

<a href="#price" 
onMouseOver="document.img_10.src='../images/more1.png';"
onMouseOut="document.img_10.src='../images/low_pricefr.png';">
<img src="../images/low_pricefr.png" alt="low cost" style="width: 150px;" class="img" id="img_10"></a><br />

<a href="#online-desk" 
onMouseOver="document.img_12.src='../images/more3.png';"
onMouseOut="document.img_12.src='../images/online-deskfr.png';">
<img src="../images/online-deskfr.png" alt="online desk" style="width: 150px;" class="img" id="img_12"></a>

<a href="#exclusive" 
onMouseOver="document.img_13.src='../images/more4.png';"
onMouseOut="document.img_13.src='../images/exclusivefr.png';">
<img src="../images/exclusivefr.png" alt="exclusive functionalities" style="width: 150px;" class="img" id="img_13"></a><br />

<a href="#sharing" 
onMouseOver="document.img_15.src='../images/more5.png';"
onMouseOut="document.img_15.src='../images/sharingfr.png';">
<img src="../images/sharingfr.png" alt="Sharing" style="width: 150px;" class="img" id="img_15"></a>

<a  href="#secured" 
onMouseOver="document.img_16.src='../images/more6.png';"
onMouseOut="document.img_16.src='../images/secured-2fr.png';">
<img src="../images/secured-2fr.png" alt="Secured" style="width: 150px;" class="img" id="img_16"></a><br />

<h2 style="color: rgb(201,201,201);">Cliquez sur un bouton pour découvrir !</h2>
</div>

<!--Ancres-->

<div style="position: absolute; top: 120%;">

<div id="ecological" style="position: relative; padding:0; width: 100%; margin-left: 0px; background-color: rgb(155,92,251);">

<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
<br />Le cloud n'a jamais été aussi écologique</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
iData est ecologique : nous avons toujours été attentifs à la préservation de l'environnement.<br />
C'est la raison pour laquelle nous utilisons des Raspberry Pi ces micro-ordinateurs consomment environs 1W :  moins que tout autre serveur.
Nos serveurs sont faits avec les mêmes composants que les téléphones, ils ne nécessitent pas de refroidissement : nous économisons de l'eau et de l'électricité.
<br /></p>

<p style="text-align: center; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
<img src="../images/servers.png" alt="servers" style="text-align: center; width: 40%;">
<img src="../images/servers.png" alt="servers" style="text-align: center; width: 40%;">
<br /></p>
<p style="font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
Nous recyclons : nous alimentons nos serveurs grâce à des chargeurs de téléphone déjà utilisés, dans la mesure du possible.
<br />&nbsp </p>
</div></div>

<!--Ancres-->

<div id="price" style="position: relative; width: 100%; background-color: rgb(0,184,201);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
<br />Dépensez peu, obtenez beaucoup</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
iData offre à chacun la possibilité de stocker beacoup de fichiers en ligne à un faible coût. 
Nos forfaits sont jusqu'a 6 fois moins chers que ceux de DropBox et 3 fois moins cher que ceux de Google Drive. 
<br /><br />
Plus de stress : gardez votre argent et apportez vos fichiers partout avec vous !
</p>
<p style="text-align: center">
<img src="../images/servers.png" style="width: 50%; max-width: 200px;" alt="spend a few get a lot">
<br />&nbsp </p>
</div></div>

<!--Ancres-->

<div id="online-desk" style="position: relative; width: 100%; background-color: rgb(0,199,140);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
<br />Vraiment tout, partout</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;"> 
Avec iData, tout votre bureau est sur le cloud : nous vous fournisons un éditeur de texte et un gestionnaire de comptes. Vous pouvez re-télécarger et partager tout ce que vous avez mis en ligne. 
Apportez vos vidéos, vos photos, votre musique et vos documents partout.<br />
<br /><br />
iData vous aide à travailler : créez des rappels, nous vous enverons un e-mail quand vous le déciderez. 1Go ne vous suffit pas ? Pas de problème : nous sommes moins cher que Google Drive et Dropbox.*</p>
<p style="text-align: center; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
<img src="../clock.png" alt="clock">
<br />&nbsp </p>
</div></div>


<!--Ancres-->


<div id="exclusive" style="position: relative; width: 100%; background-color: rgb(155,213,73);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
<br />Plein de fonctionnalités, pour tout le monde</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
iData vous offre des fontionnalités exclusives : créez des graphiques avec vos comptes, partagez n'importe quel fichier, utilisez des outils sécurisés et performants gratuitement.<br />
Vous n'avez pas besoin d'apprendre à utiliser iData : nous faisons en sorte que le site soit le plus intuitif possible. Avec 10 boutons, vous serez en mesure de tout faire avec vos fichiers.<br />
</p>
<p style="text-align: center;">
<img src="../stats.png" alt="graphs">
<br />&nbsp </p>
</div></div>

<div id="sharing" style="position: relative; padding: 0px; margin: 0px; width: 100%; background-color: rgb(255,130,0);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
<br />1 2 3 partagez !</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
Le partage est une fonctionnalité clé iData : téléchargez ce que vous voulez et partagez le. 
Vos amis pourons aussi récupérer vos fichiers instantanement.<br />
Vous n'avez pas besoin de repartager les fichiers après les avoir édités, iData modifie automatiquement le fichier personnel et le fichier partagé.
</p>
<p style="text-align: center;">
<img src="../images/sharefile.png" alt="share file">
</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
Ne perdez plus les liens vers vos fichier, iData vous offre la possibilité d'enoyer un email a un ami quand vous voulez partager un fichier avec lui.
<br />&nbsp </p>
</div></div>

<div id="secured" style="position: relative; width: 100%;  margin: 0px; padding: 0px; background-color: rgb(254,64,60);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
<br />Restez, vous êtes en sûreté</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
iData est sécurisé : les informations secrètes telles que vos mots de passe sont protégées par un hash de 512 bits.<br />
Vous travaillez avec des fichiers sensibles ? Nous vous offrons la possibilité d'utiliser le HTTPS pour crypter vos transactions.<br />
De plus, pour nous prémunir des attaques, nous bloquons les connexions non HTTP(S) provenant de l'extérieur. Ce que nous faisons ne quitte jamais iData. Nos serveurs sont hébergés dans nos propres bureaux, en France.<br />
<br />&nbsp </p>
<p style="text-align: center;">
<img src="../lock.png" alt="lock">
</p>
</div></div>
</div>

<a href="#top">
<img id="upbtn" src="../up.png" alt="up" style="position: fixed; right: 20px; bottom: 20px; width: 100px;"></a>
</body>
</html>
<?php } else { ?>






<!DOCTYPE html>
<html id="top">
    <head>
        <meta charset="utf-8" />
<meta name="Description" content="iData, the secure cloud computing system"/>
<meta name="Keywords" content="cloud, computing, data, online"/>

       <link rel="stylesheet" href="../style2.css" />
        <title>iData</title>
		<link rel="icon" type="image/png" href="../cloud.png" />
		
	<script src="../js/jquery.js" type="text/javascript"></script>
    <script type="text/javascript" src="../js/localscroll/jquery.localscroll.js"></script>
    <script type="text/javascript" src="../js/localscroll/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="../js/lancement.js"></script>
    </head>
	
<body>
<?php include_once("../piwiktrack.php"); ?>
<?php include_once("header-fr.php"); ?>

<div style="background-color: rgb(230,230,254); width: 100%; height: 100%; position: absolute; left: 0px; top: 45px;" id="showmore3" >

<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(204,204,204);">iData</h2>
<p style="text-align: center;">
<img src="../cloud.png" alt="cloud" style="width: 300px;">
</p>
</a>
</div>

<!--Boutons-->

<div style="position: absolute; top: 150px; right: 0px; width:50%;">

<a href="#ecological" 
onMouseOver="document.img_17.src='../images/more8.png';"
onMouseOut="document.img_17.src='../images/ecologiquefr.png';">
<img src="../images/ecologiquefr.png" alt="Secured" style="width: 150px;" class="img" id="img_17"></a>

<a href="#price" 
onMouseOver="document.img_10.src='../images/more1.png';"
onMouseOut="document.img_10.src='../images/low_pricefr.png';">
<img src="../images/low_pricefr.png" alt="low cost" style="width: 150px;" class="img" id="img_10"></a><br />

<a href="#online-desk" 
onMouseOver="document.img_12.src='../images/more3.png';"
onMouseOut="document.img_12.src='../images/online-deskfr.png';">
<img src="../images/online-deskfr.png" alt="online desk" style="width: 150px;" class="img" id="img_12"></a>

<a href="#exclusive" 
onMouseOver="document.img_13.src='../images/more4.png';"
onMouseOut="document.img_13.src='../images/exclusivefr.png';">
<img src="../images/exclusivefr.png" alt="exclusive functionalities" style="width: 150px;" class="img" id="img_13"></a><br />

<a href="#sharing" 
onMouseOver="document.img_15.src='../images/more5.png';"
onMouseOut="document.img_15.src='../images/sharingfr.png';">
<img src="../images/sharingfr.png" alt="Sharing" style="width: 150px;" class="img" id="img_15"></a>

<a  href="#secured" 
onMouseOver="document.img_16.src='../images/more6.png';"
onMouseOut="document.img_16.src='../images/secured-2fr.png';">
<img src="../images/secured-2fr.png" alt="Secured" style="width: 150px;" class="img" id="img_16"></a><br />

</div>

<!--Ancres-->

<div id="ecological" style="position: absolute; top: 100%; width: 100%; height: 100%; margin-left: 0px; background-color: rgb(155,92,251);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
Le cloud n'a jamais été aussi écologique</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
iData est ecologique : nous avons toujours été attentifs à la préservation de l'environnement.<br />
C'est la raison pour laquelle nous utilisons des Raspberry Pi ces micro-ordinateurs consomment environs 1W :  moins que tout autre serveur.
Nos serveurs sont faits avec les mêmes composants que les téléphones, ils ne nécessitent pas de refroidissement : nous économisons de l'eau et de l'électricité.
<br /></p>

<p style="text-align: center; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
<img src="../images/servers.png" alt="servers" style="text-align: center; width: 200px;">
<img src="../images/servers.png" alt="servers" style="text-align: center; width: 200px;">
<br /></p>
<p style="font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
Nous recyclons : nous alimentons nos serveurs grâce à des chargeurs de téléphone déjà utilisés, dans la mesure du possible.</p>
</div></div>

<!--Ancres-->


<div id="price" style="position: absolute; top: 200%; width: 100%; height: 100%; margin-left: 0px; background-color: rgb(0,184,201);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
Dépensez peu, obtenez beaucoup</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
iData offre à chacun la possibilité de stocker beacoup de fichiers en ligne à un faible coût. 
Nos forfaits sont jusqu'a 6 fois moins chers que ceux de DropBox et 3 fois moins cher que ceux de Google Drive. 
<br /><br />
Plus de stress : gardez votre argent et apportez vos fichiers partout avec vous !
</p>
<p style="text-align: center">
<img src="../images/servers.png" alt="spend a few get a lot">
</p>
</div></div>

<!--Ancres-->


<div id="online-desk" style="position: absolute; top: 300%; width: 100%; height: 100%; margin-left: 0px; background-color: rgb(0,199,140);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
Vraiment tout, partout</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;"> 
Avec iData, tout votre bureau est sur le cloud : nous vous fournisons un éditeur de texte et un gestionnaire de comptes. Vous pouvez re-télécarger et partager tout ce que vous avez mis en ligne. 
Apportez vos vidéos, vos photos, votre musique et vos documents partout.<br />
<br /><br />
iData vous aide à travailler : créez des rappels, nous vous enverons un e-mail quand vous le déciderez. 1Go ne vous suffit pas ? Pas de problème : nous sommes moins cher que Google Drive et Dropbox.*</p>
<p style="text-align: center; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
<img src="../clock.png" alt="clock">
</p>
</div></div>


<!--Ancres-->


<div id="exclusive" style="position: absolute; top: 400%; width: 100%; height: 100%; margin-left: 0px; background-color: rgb(155,213,73);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
Plein de fonctionnalités, pour tout le monde</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
iData vous offre des fontionnalités exclusives : créez des graphiques avec vos comptes, partagez n'importe quel fichier, utilisez des outils sécurisés et performants gratuitement.<br />
Vous n'avez pas besoin d'apprendre à utiliser iData : nous faisons en sorte que le site soit le plus intuitif possible. Avec 10 boutons, vous serez en mesure de tout faire avec vos fichiers.<br />
</p>
<p style="text-align: center;">
<img src="../stats.png" alt="graphs">
</p>
</div></div>

<div id="sharing" style="position: absolute; top: 500%; width: 100%; height: 100%; margin-left: 0px; background-color: rgb(255,130,0);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
1 2 3 partagez !</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
Le partage est une fonctionnalité clé iData : téléchargez ce que vous voulez et partagez le. 
Vos amis pourons aussi récupérer vos fichiers instantanement.<br />
Vous n'avez pas besoin de repartager les fichiers après les avoir édités, iData modifie automatiquement le fichier personnel et le fichier partagé.
</p>
<p style="text-align: center;">
<img src="../images/sharefile.png" alt="share file">
</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
Ne perdez plus les liens vers vos fichier, iData vous offre la possibilité d'enoyer un email a un ami quand vous voulez partager un fichier avec lui.
</p>
</div></div>

<div id="secured" style="position: absolute; top: 600%; width: 100%; height: 100%; margin-left: 0px; background-color: rgb(254,64,60);">
<div style="width: 74%; margin-right: 12%; margin-left: 12%;">
<p style="text-align: center; display: block; font-size: 25px; font-family: 'Century Gothic', Arial; color:white;">
Restez, vous êtes en sûreté</p>
<p style="display: block; font-size: 20px; font-family: 'Century Gothic', Arial; color:white;">
iData est sécurisé : les informations secrètes telles que vos mots de passe sont protégées par un hash de 512 bits.<br />
Vous travaillez avec des fichiers sensibles ? Nous vous offrons la possibilité d'utiliser le HTTPS pour crypter vos transactions.<br />
De plus, pour nous prémunir des attaques, nous bloquons les connexions non HTTP(S) provenant de l'extérieur. Ce que nous faisons ne quitte jamais iData. Nos serveurs sont hébergés dans nos propres bureaux, en France.<br />
</p>
<p style="text-align: center;">
<img src="../lock.png" alt="lock">
</p>
</div></div></div>



<footer style="background-color: rgb(180,180,180); width: 100%; position: absolute; left: 0px; top: 700%;">
	<p style="display: inline;font-family:'Century Gothic', Arial; font-size: 12px;" ><a href="../index.php?lang=en"><img src="../images/en.png" alt="english" style="width: 35px; position: relative; top: 10px; left: 10px;"></a> <a href="../warning.php"><img src="../lock.png" style="width:45px; position: relative; top: 8px; left:5px;" alt="HTTPS"></a> <a href="../about.php"><img src="../images/who.png" alt="A propos" style="width:35px; position: relative; top: 5px;"></a>  <a href="https://www.facebook.com/idata.cloud"><img style="width: 35px;position: relative; top: 5px;"src="../images/fb.png" alt="Facebook"></a><a href="https://twitter.com/iDatacloud"><img style="width: 35px;position: relative; top: 5px;"src="../images/tw.png" alt="Twitter"></a></p>
	<div style="float: right;"> <p style="font-family:'Century Gothic', Arial; font-size: 12px;" >Partenaires : <a href="http://mtfo.fr/" target="_blank"><img src="../images/mtfo.png" alt="MTFO" style="height: 25px; position: relative; top: 5px;"></a>   <a href="http://www.geektheory.net/" target="_blank"><img src="../images/gt.png" alt="Geek Theory" style="height: 25px; position: relative; top: 6px;"></a></p>
</div>	
<p style="font-family:'Century Gothic', Arial; font-size: 12px; text-align: center;" >Copyright © 2013 Evan OLLIVIER. Tous droits réservés.</p>
</footer>

<a href="#top">
<img id="upbtn" src="../up.png" alt="up" style="position: fixed; right: 20px; bottom: 20px; width: 100px;"></a>
</body>
</html>

<? } ?>