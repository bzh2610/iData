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
<title>Inscription</title>
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

<div style="position: relative; margin-top: 15%; text-align: center;">
<br />
<h3>Créer un compte</h3>	
	<form method="post" action="success-sign-up.php">
	<p>Prénom : <input type="text" name="firstname"/></p>
	<p>Nom : <input type="text" name="surname"/></p>
	<p>Email : <input type="email" name="email" /></p>
	<p>Pseudo : <input type="text" name="username" /></p>
	<p>Mot de passe : <input type="password" name="password" /></p>
	<p>Confirmation : <input type="password" name="passwordconfirm" /></p>
	<p><input type="checkbox" name="agree" id="agree" /> <label for="agree">J'accepte les <a href="../tos.php">conditions d'utilisation</a> et les <a href="../privacy.php">règles de confidentialité</a> d'iData.</label>
	<br />
	<input type="submit" value="Envoyer" />
	</form>
</div>
</body>
</html>


<? }else{ ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="../style.css" />
	<link rel="icon" type="image/png" href="../cloud.png" />
        <title>Inscription sur iData</title>
    </head>
    <body style="background-color: rgb(230,230,255);">
	<?php include_once("../piwiktrack.php"); ?>
<?php include_once("header-fr.php"); ?>
	
<div style="position: absolute; width : 930px; height: 680px; top: 50%; left: 50%; margin: -330px 0 0 -465px;">
	<div class="signuppres">
	<div style="margin-left: 15px; margin-right: 15px;">
<h2>Découvrez iData</h2>
	<!--<h2>Regardez ce que l'on peut faire !</h2>-->
<h3>Vos fichiers partout, tout le temps.</h3>
<p>Avec iData, peu importe où vous soyez, vos fichiers sont avec vous. Il suffit de vous connecter a votre compte ! Plus le stress d'oublier vos périphériques USB ou de vous faire infecter par ce biais.</p>
<h3>Votre bureau est dans le cloud.</h3>
<img src="../ppt.png" alt="ppt" class="prespics"><img src="../avi.png" alt="avi" class="prespics"><img src="../mp3.png" alt="mp3" class="prespics"><img src="../xls.png" alt="xls" class="prespics"><img src="../exe.png" alt="exe" class="prespics"><img src="../zip.png" alt="zip" class="prespics">
<p>Accédez à tout vos documents textes, classeurs, présentations, photos et plus sur le même compte.</p>
<h3>Facile à uiliser.</h3>
<img src="../upload.png" alt="upload" class="prespics"><img src="../get.png" alt="download" class="prespics"><img src="../share.png" alt="share" class="prespics"><img src="../delete.png" alt="delete" class="prespics"><img src="../rename.png" alt="rename" class="prespics"><img src="../remind.png" alt="reminds" class="prespics">
<p>Avec moins de 10 buttons vous pouvez tout faire : mettre en ligne, télécharger, partager, supprimer, renommer et même créer des rappels. iData est simple d'utilisation !</p>
</div>
</div>

<div class="signup">
<div style="position: relative; margin-left: 7px; margin-right: 7px; top: 20px;">

<h3>Créer un compte</h3>
<!--	<h3>Inscrivez-vous maintenant ! Ca ne prend que 3 minutes</h3>-->
	
	<form method="post" action="success-sign-up.php">
<!--<p>Civilité : <select name="gender">
    <option value="Mrs">Femme</option>
    <option value="Mr">Homme</option>
	<option value="default" selected="selected" hidden>I am...</option></select></p>-->
	<p>Prénom : <input type="text" name="firstname"/></p>
	<p>Nom : <input type="text" name="surname"/></p>
	<p>Email : <input type="email" name="email" /></p>
	<p>Pseudo : <input type="text" name="username" /></p>
	<p>Mot de passe : <input type="password" name="password" /></p>
	<p>Confirmation : <input type="password" name="passwordconfirm" /></p>
	<p><input type="checkbox" name="agree" id="agree" /> <label for="agree">J'accepte les <a href="../tos.php">conditions d'utilisation</a> et les <a href="../privacy.php">règles de confidentialité</a> d'iData.</label>
	<br />
	<input type="submit" value="Envoyer" />
	</form>
	</div>
	</div>
</div>
	</body>
	</html>
	
<?php } ?>