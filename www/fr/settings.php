<?php session_start();
$log='';
$show = 1;

/////NORMAL//////
if(!empty($_SESSION['accountid'])){

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=idata', 'root', 'YOUR_PASSWORD');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$req = $bdd->prepare('SELECT Used, Taille, End FROM premium WHERE Code = ?');
$req->execute(array($_SESSION['code']));
$donnees = $req->fetch();
$actuel = time();

	if( $donnees['End'] > $actuel AND $donnees['Used'] == 0)	{
	$today = time();
	$days_to_go= $donnees['End'] - $today;
	$days_to_go = $days_to_go / 3600; //heures totales
	$hours_to_go = $days_to_go % 24; //heures modulo
	$days_to_go = $days_to_go / 24; //jours 24H
	$days_to_go = substr($days_to_go, 0, 2);
	$premium='Enabled';
	$taillego=2;
	}	
	
else{
$premium= 'Disabled';
$taillego=1;}

define("PRE","$315EC816%");//Sel
define("POST",",CA17E4CF?");
 
class Secure {
    public static function hash($newpwd){
        return hash("whirlpool", PRE . $newpwd . POST);
    }
}




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

<?php

/////Change PWD//////
if (isset ($_POST['newpwd']) AND isset ($_POST['newpwdconfirm'])){
$newpwd = $_POST['newpwd'];
$newpwdconfirm = $_POST['newpwdconfirm'];

if(strlen($newpwd)>=5){ 
if ($newpwd == $newpwdconfirm){
$show = 0;
$hash1 = Secure::hash($newpwd);

 $req = $bdd->prepare('UPDATE users SET Password = :Password WHERE Accountid = :Accountid');
$req->execute(array(
    'Password' => $hash1,
    'Accountid' => $_SESSION['accountid']
    ));
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h1 style="color: white; font-family: 'Century Gothic', Arial;">Done !</h1><br /><br />
	<a href="settings.php" style="color: white; font-family: 'Century Gothic', Arial;" ><p>Retour</a>
	</form>
	</div>
</body>
</html>
<?php
}

else{
$log= 'Les mots de passe ne correspondent pas';
}}
else{
$log= 'Le mot de passe entré est trop court';
}}

/////ENTER NEW PWD///
else if (isset ($_POST['currentpwd'])){
$currentpwd = $_POST['currentpwd'];
$currentpwd = Secure::hash($currentpwd);

if($currentpwd == $_SESSION['password']){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 400px; height: 160px; position: absolute; margin: -80px 0 0 -200px;  text-align: center;">
	<form method="post" action="settings.php">
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">Nouveau mot de passe : <input type="password" name="newpwd"/></h4>
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">Confirmation : <input type="password" name="newpwdconfirm"/></h4>
	<input type="submit" value="Continuer">
	</form>
	</div>
</body>
</html>
<?php
}

else{
$log= 'Mauvais mot de passe';
}}

/////CHANGE PWD////
else if (isset ($_GET['pwd'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h3 style="color: white">Entrez votre mot de passe : <input type="password" name="currentpwd"/></h3>
	<input type="submit" value="Next">
	</form>
	</div>
</body>
</html>
<?}

//WAIT ERASING//
else if (isset ($_POST['currentpwd2'])){
$currentpwd2 = $_POST['currentpwd2'];
$currentpwd2 = Secure::hash($currentpwd2);

if($currentpwd2 == $_SESSION['password']){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 450px; height: 520px; position: absolute; margin: -260px 0 0 -225px;  text-align: center;">
	<p style="color: white; font-family: 'Century Gothic', Arial;">
	Etes vous sûr de vouloir effacer votre cloud ?<br />
	Vous êtes conscient que :<br />
	<ul style="color: white;">
	<li>La suppression des données est permanente : il est impossible de revenir en arrière.
	<br /><br /><li>C'est votre dernière chance de revenir en arrière : Une fois que vous aurez cliqué sur "Effacer mon cloud", tout sera effacé.
	<br /><br /><li>Vous perdrez tout ce que vous avez stocké sur iData.
	</ul>
	</p>
	<form method="post" action="settings.php">
	<input type="hidden" name="hashedpwd2" value="<?php echo $currentpwd2; ?>"/>
	<input type="submit" value="Effacer mon cloud">
	</form>	
	</div>
</body>
</html>
<?php
}

else{
$log= 'Mauvais mot de passe';
}
}

//WAIT ERASING//
else if (isset ($_POST['currentpwd3'])){
$currentpwd3 = $_POST['currentpwd3'];
$currentpwd3 = Secure::hash($currentpwd3);

if($currentpwd3 == $_SESSION['password']){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	margin-top: 15%; width: 90%; padding:10px; border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; position: absolute; text-align: center;">
	
	<div id="warning" style="color: white;">
	<img src="../images/cry.png" alt="We are sad to see you leaving us" style="width: 200px; position: relative; margin:auto; display: block;">
	<p style="font-family: 'Century Gothic', Arial;">
	Etes vous sûr de vouloir supprimer votre compte ?<br />
	Vous êtes conscient que :<br />

	<li>La suppression de votre compte est permanente : il est impossible de revenir en arrière.
	<br /><br /><li>C'est votre dernière chance de revenir en arrière : Une fois que vous aurez cliqué sur "Supprimer mon compte", ce dernier sera supprimé.
	<br /><br /><li>Vous perdrez tout ce que vous avez stocké sur iData.
	<br /><br /><li>Vous perdrez tout ce que vous avez acheté sur iData.

	</p>
	<form method="post" action="settings.php">
	<input type="hidden" name="hashedpwd3" value="<?php echo $currentpwd3; ?>"/></h3>
	<input type="submit" value="Supprimer mon compte">
	</form>
	</div>
</div>
</body>
</html>
<? }
else{
$log= 'Mauvais mot de passe';
}
}

//ERASING - PHP//
else if (isset ($_POST['hashedpwd2'])){
$hashedpwd2 = $_POST['hashedpwd2'];

	if($hashedpwd2 == $_SESSION['password']){
		$show = 0;
	shell_exec('rm -r /var/www/userdata/'.$_SESSION["accountid"].';  rm -r /var/www/public/'.$_SESSION["accountid"].'; mkdir /var/www/userdata/'.$_SESSION["accountid"].'; mkdir /var/www/public/'.$_SESSION["accountid"].'');
	echo"<script>";
	echo"document.location.href='../mydocs.php';";
	echo"</script>";
	}

	else{
	$log= 'Erreur';
	}
}

//DELETE ACCOUNT - PHP//
else if (isset ($_POST['hashedpwd3'])){
$hashedpwd3 = $_POST['hashedpwd3'];

	if($hashedpwd3 == $_SESSION['password']){
		$show = 0;
		shell_exec('rm -r /var/www/userdata/'.$_SESSION["accountid"].'; rm -r /var/www/public/'.$_SESSION["accountid"].'');
		$req = $bdd->prepare('DELETE FROM users WHERE Accountid = ?');
		$req->execute(array($_SESSION['accountid']));
		$donnees = $req->fetch();	
	echo"<script>";
	echo"document.location.href='../logout.php';";
	echo"</script>";
	}

	else{
	$log= 'Erreur';
	}
}



///PWD erasing///
else if (isset ($_POST['agree1'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h3 style="color: white">Entrez votre mot de passe : 
	<input type="password" name="currentpwd2"/></h3>
	<input type="submit" value="Suivant">
	</form>
</div>
</body>
</html>
<?}

///PWD deleting///
else if (isset ($_POST['agree10']) AND isset($_POST['agree11'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h3 style="color: white">Entrez votre mot de passe : <input type="password" name="currentpwd3"/></h3>
	<input type="submit" value="Suivant">
	</form>
	</div>
</body>
</html>
<?}

///CRYPT//
else if (isset ($_GET['crypt'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">
	<input type="checkbox" name="crytaes"/>
	<label for="cryptaes">Crypter mes fichiers en AES 256 bits.</h4>
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">
	Information : Le temps nécessaire à la mise en ligne et au téléchargement des fichiers sera plus important.</h4>
	<input type="submit" value="Crypter mon cloud">
	</form>
	</div>
</body>
</html>
<?}


/////ERASE/////
else if (isset ($_GET['erase'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h4 style="color: white; font-family: 'Century Gothic', Arial;"><p><input type="checkbox" name="agree1"/>
	<label for="agree">Je comprends que je vais perdre tout ce que j'ai stocké sur iData sans possibilité de récupération.</h4>
	<input type="submit" value="Tout supprimer">
	</form>
	</div>
</body>
</html>
<?}

/////delete/////
else if (isset ($_GET['delete'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 240px; position: absolute; margin: -120px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h4 style="color: white; font-family: 'Century Gothic', Arial;"><p><input type="checkbox" name="agree10"/>
	<label for="agree">Je comprends qu'une fois mon compte supprimé, je perdrai tout ce que j'ai stocké sur iData sans possibilité de récupération.</h4>
	<h4 style="color: white; font-family: 'Century Gothic', Arial;"><p><input type="checkbox" name="agree11"/>
	<label for="agree">J'annule toute option que j'ai souscrite sans possibilité de remboursement.</h4>
	<input type="submit" value="Supprimer mon compte">
	</form>
	</div>
</body>
</html>
<?}


if($show == 1){
?>
<div style="margin-top: 70px; font-family: 'Century Gothic', Arial;">
<h2>Paramètres</h2>
<p style="margin-left: 3px; color: red;"><? echo $log;?></p>
<p style="margin-left: 3px;">Prénom : <? echo $_SESSION['firstname'];?></p>
<p style="margin-left: 3px;">Nom : <? echo $_SESSION['surname'];?></p>
<p style="margin-left: 3px;">Civilité : <? echo $_SESSION['gender'];?></p>
<p style="margin-left: 3px;">Email : <? echo $_SESSION['email'];?></p>
<p style="margin-left: 3px;">Pseudo : <? echo $_SESSION['username'];?></p>
<p style="margin-left: 3px;">Premium : <? echo $premium;?></p>
<? if($premium=='Enabled') {?>
<p style="margin-left: 3px;">Temps premium restant : <? echo ''.$days_to_go.' jours '.$hours_to_go.' heures';?></p>
<?php } ?>
<a href="?pwd"><p style="margin-left: 3px;">Changer mon mot de passe</p></a>
<a href="?crypt"><p style="margin-left: 3px;">Cryptage : <? echo $_SESSION['crypt'];?></p></a>
<a href="?erase"><p style="margin-left: 3px;">Effacer mon cloud</p>
<a href="?delete"><p style="margin-left: 3px;">Supprimer mon compte</p>
</div>
</body>
</html>

<?php
 }}else { ?>
	
	
	
	
	
	
	
	
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="../style.css" />
        <title>iData - Paramètres</title>
		<link rel="icon" type="image/png" href="../cloud.png" />
    </head>
    <body style="background-color: rgb(255,255,255);">
<?php include_once("../piwiktrack.php");
include_once("header-fr.php"); ?>
<?php

/////Change PWD//////
if (isset ($_POST['newpwd']) AND isset ($_POST['newpwdconfirm'])){
$newpwd = $_POST['newpwd'];
$newpwdconfirm = $_POST['newpwdconfirm'];

if(strlen($newpwd)>=5){ 
if ($newpwd == $newpwdconfirm){
$show = 0;
$hash1 = Secure::hash($newpwd);

 $req = $bdd->prepare('UPDATE users SET Password = :Password WHERE Accountid = :Accountid');
$req->execute(array(
    'Password' => $hash1,
    'Accountid' => $_SESSION['accountid']
    ));
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h1 style="color: white; font-family: 'Century Gothic', Arial;">Done !</h1><br /><br />
	<a href="settings.php" style="color: white; font-family: 'Century Gothic', Arial;" ><p>Retour</a>
	</form>
	</div>
</body>
</html>
<?php
}

else{
$log= 'Les mots de passe ne correspondent pas';
}}
else{
$log= 'Le mot de passe entré est trop court';
}}

/////ENTER NEW PWD///
else if (isset ($_POST['currentpwd'])){
$currentpwd = $_POST['currentpwd'];
$currentpwd = Secure::hash($currentpwd);

if($currentpwd == $_SESSION['password']){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 400px; height: 160px; position: absolute; margin: -80px 0 0 -200px;  text-align: center;">
	<form method="post" action="settings.php">
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">Nouveau mot de passe : <input type="password" name="newpwd"/></h4>
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">Confirmation : <input type="password" name="newpwdconfirm"/></h4>
	<input type="submit" value="Continuer">
	</form>
	</div>
</body>
</html>
<?php
}

else{
$log= 'Mauvais mot de passe';
}}

/////CHANGE PWD////
else if (isset ($_GET['pwd'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h3 style="color: white">Entrez votre mot de passe : <input type="password" name="currentpwd"/></h3>
	<input type="submit" value="Next">
	</form>
	</div>
</body>
</html>
<?}

//WAIT ERASING//
else if (isset ($_POST['currentpwd2'])){
$currentpwd2 = $_POST['currentpwd2'];
$currentpwd2 = Secure::hash($currentpwd2);

if($currentpwd2 == $_SESSION['password']){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 450px; height: 520px; position: absolute; margin: -260px 0 0 -225px;  text-align: center;">
	<p style="color: white; font-family: 'Century Gothic', Arial;">
	Etes vous sûr de vouloir effacer votre cloud ?<br />
	Vous êtes conscient que :<br />
	<ul style="color: white;">
	<li>La suppression des données est permanente : il est impossible de revenir en arrière.
	<br /><br /><li>C'est votre dernière chance de revenir en arrière : Une fois que vous aurez cliqué sur "Effacer mon cloud", tout sera effacé.
	<br /><br /><li>Vous perdrez tout ce que vous avez stocké sur iData.
	</ul>
	</p>
	<form method="post" action="settings.php">
	<input type="hidden" name="hashedpwd2" value="<?php echo $currentpwd2; ?>"/>
	<input type="submit" value="Effacer mon cloud">
	</form>	
	</div>
</body>
</html>
<?php
}

else{
$log= 'Mauvais mot de passe';
}
}

//WAIT ERASING//
else if (isset ($_POST['currentpwd3'])){
$currentpwd3 = $_POST['currentpwd3'];
$currentpwd3 = Secure::hash($currentpwd3);

if($currentpwd3 == $_SESSION['password']){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 450px; height: 520px; position: absolute; margin: -260px 0 0 -225px;  text-align: center;">
	
	<div id="warning" style="color: white;">
	<img src="../images/cry.png" alt="We are sad to see you leaving us" style="width: 200px; position: relative; margin:auto; display: block;">
	<p style="font-family: 'Century Gothic', Arial;">
	Etes vous sûr de vouloir supprimer votre compte ?<br />
	Vous êtes conscient que :<br />

	<li>La suppression de votre compte est permanente : il est impossible de revenir en arrière.
	<br /><br /><li>C'est votre dernière chance de revenir en arrière : Une fois que vous aurez cliqué sur "Supprimer mon compte", ce dernier sera supprimé.
	<br /><br /><li>Vous perdrez tout ce que vous avez stocké sur iData.
	<br /><br /><li>Vous perdrez tout ce que vous avez acheté sur iData.

	</p>
	<form method="post" action="settings.php">
	<input type="hidden" name="hashedpwd3" value="<?php echo $currentpwd3; ?>"/></h3>
	<input type="submit" value="Supprimer mon compte">
	</form>
	</div>
</div>
</body>
</html>
<? }
else{
$log= 'Mauvais mot de passe';
}
}

//ERASING - PHP//
else if (isset ($_POST['hashedpwd2'])){
$hashedpwd2 = $_POST['hashedpwd2'];

	if($hashedpwd2 == $_SESSION['password']){
		$show = 0;
	shell_exec('rm -r /var/www/userdata/'.$_SESSION["accountid"].';  rm -r /var/www/public/'.$_SESSION["accountid"].'; mkdir /var/www/userdata/'.$_SESSION["accountid"].'; mkdir /var/www/public/'.$_SESSION["accountid"].'');
	echo"<script>";
	echo"document.location.href='../mydocs.php';";
	echo"</script>";
	}

	else{
	$log= 'Erreur';
	}
}

//DELETE ACCOUNT - PHP//
else if (isset ($_POST['hashedpwd3'])){
$hashedpwd3 = $_POST['hashedpwd3'];

	if($hashedpwd3 == $_SESSION['password']){
		$show = 0;
		shell_exec('rm -r /var/www/userdata/'.$_SESSION["accountid"].'; rm -r /var/www/public/'.$_SESSION["accountid"].'');
		$req = $bdd->prepare('DELETE FROM users WHERE Accountid = ?');
		$req->execute(array($_SESSION['accountid']));
		$donnees = $req->fetch();	
	echo"<script>";
	echo"document.location.href='../logout.php';";
	echo"</script>";
	}

	else{
	$log= 'Erreur';
	}
}



///PWD erasing///
else if (isset ($_POST['agree1'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h3 style="color: white">Entrez votre mot de passe : 
	<input type="password" name="currentpwd2"/></h3>
	<input type="submit" value="Suivant">
	</form>
</div>
</body>
</html>
<?}

///PWD deleting///
else if (isset ($_POST['agree10']) AND isset($_POST['agree11'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h3 style="color: white">Entrez votre mot de passe : <input type="password" name="currentpwd3"/></h3>
	<input type="submit" value="Suivant">
	</form>
	</div>
</body>
</html>
<?}

///CRYPT//
else if (isset ($_GET['crypt'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">
	<input type="checkbox" name="crytaes"/>
	<label for="cryptaes">Crypter mes fichiers en AES 256 bits.</h4>
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">
	Information : Le temps nécessaire à la mise en ligne et au téléchargement des fichiers sera plus important.</h4>
	<input type="submit" value="Crypter mon cloud">
	</form>
	</div>
</body>
</html>
<?}


/////ERASE/////
else if (isset ($_GET['erase'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h4 style="color: white; font-family: 'Century Gothic', Arial;"><p><input type="checkbox" name="agree1"/>
	<label for="agree">Je comprends que je vais perdre tout ce que j'ai stocké sur iData sans possibilité de récupération.</h4>
	<input type="submit" value="Tout supprimer">
	</form>
	</div>
</body>
</html>
<?}

/////delete/////
else if (isset ($_GET['delete'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 240px; position: absolute; margin: -120px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h4 style="color: white; font-family: 'Century Gothic', Arial;"><p><input type="checkbox" name="agree10"/>
	<label for="agree">Je comprends qu'une fois mon compte supprimé, je perdrai tout ce que j'ai stocké sur iData sans possibilité de récupération.</h4>
	<h4 style="color: white; font-family: 'Century Gothic', Arial;"><p><input type="checkbox" name="agree11"/>
	<label for="agree">J'annule toute option que j'ai souscrite sans possibilité de remboursement.</h4>
	<input type="submit" value="Supprimer mon compte">
	</form>
	</div>
</body>
</html>
<?}


if($show == 1){
?>
<div style="margin-top: 70px; font-family: 'Century Gothic', Arial;">
<h2>Paramètres</h2>
<p style="margin-left: 3px; color: red;"><? echo $log;?></p>
<p style="margin-left: 3px;">Prénom : <? echo $_SESSION['firstname'];?></p>
<p style="margin-left: 3px;">Nom : <? echo $_SESSION['surname'];?></p>
<p style="margin-left: 3px;">Civilité : <? echo $_SESSION['gender'];?></p>
<p style="margin-left: 3px;">Email : <? echo $_SESSION['email'];?></p>
<p style="margin-left: 3px;">Pseudo : <? echo $_SESSION['username'];?></p>
<p style="margin-left: 3px;">Premium : <? echo $premium;?></p>
<? if($premium=='Enabled') {?>
<p style="margin-left: 3px;">Temps premium restant : <? echo ''.$days_to_go.' jours '.$hours_to_go.' heures';?></p>
<?php } ?>
<a href="?pwd"><p style="margin-left: 3px;">Changer mon mot de passe</p></a>
<a href="?crypt"><p style="margin-left: 3px;">Cryptage : <? echo $_SESSION['crypt'];?></p></a>
<a href="?erase"><p style="margin-left: 3px;">Effacer mon cloud</p>
<a href="?delete"><p style="margin-left: 3px;">Supprimer mon compte</p>
</div>
</body>
</html>

<?php
}}}

else{
header("Location: signin.php");
}
?>