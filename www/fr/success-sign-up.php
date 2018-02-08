<?php 
if ( empty($_POST['agree'])){
	$log="Vous n'avez pas accepté les conditions d'utilisation : vous ne pouvez pas utiliser iData sans les accepter.";
}

else{
	if (!empty($_POST['firstname']) AND !empty($_POST['surname']) AND !empty($_POST['email']) AND !empty ($_POST['username']) AND !empty ($_POST['password']) /*AND !empty($_POST['gender'])*/ AND !empty($_POST['agree'])){
	
	if (($_POST['password']) == ($_POST['passwordconfirm'])){
	//Rien n'est vide----Email valid ?
	$email=htmlspecialchars($_POST['email']); 
	$Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
	if(preg_match($Syntaxe,$email))	{
	//if ($_POST['gender'] == "Mr" || $_POST['gender'] == "Mrs"){
	
$accountid = uniqid(null,true);
$password = mysql_real_escape_string($_POST['password']);
define("PRE","$315EC816%");//Sel
define("POST",",CA17E4CF?");
 
class Secure {
    public static function hash($password){
        return hash("whirlpool", PRE . $password . POST);
    }
}
$hash1 = Secure::hash($password);

//Email is on the top
$username = htmlspecialchars($_POST['username']);
$surname = htmlspecialchars($_POST['surname']);
$firstname = htmlspecialchars($_POST['firstname']);
//$gender =  htmlspecialchars($_POST['gender']);
$signuptime = time();
//Ecriture des infos utilisateur dans BDD
try{
    $bdd = new PDO('mysql:host=localhost;dbname=idata', 'root', 'YOUR_PASSWORD');
}
catch(Exception $e){
        die('Erreur : '.$e->getMessage());
}

if(strlen($username)>=5 || strlen($password)>=5){
$req = $bdd->prepare('SELECT * FROM users WHERE Username = ?');//User name used ?
$req->execute(array($username));
$count = $req->rowCount();
if($count == 0){

	$req = $bdd->prepare('SELECT * FROM users WHERE Email = ?');//Email used ?
	$req->execute(array($email));
	$count = $req->rowCount();
	$token = Secure::hash($signuptime);
	
	if($count == 0){
	$req = $bdd->prepare('INSERT INTO users(Accountid, Gender, Firstname, Surname, Username, Email, Password, Inscription, Validation, Code, Token, Crypt) VALUES (:Accountid, :Gender, :Firstname, :Surname, :Username, :Email, :Password, :Inscription, :Validation, :Code, :Token, :Crypt)');
	$req->execute(array(
	'Accountid' => $accountid,
    'Gender' => '',
    'Firstname' => $firstname,
    'Surname' => $surname,
    'Username' => $username,
    'Email' => $email,
    'Password' => $hash1,
	'Inscription' => $signuptime,
	'Validation' => '0',
	'Code' => '',
	'Token' => $token,
	'Crypt' => '0'
    ));

shell_exec('echo "<html><head><title>Account confirmation</title></head>
<body style=\"font-family: \'Century Gothic\', Arial;\">
<div style=\"width: 200px; margin: auto;\">
	<a style=\"text-decoration: none;" href="http://idata.no-ip.info\">
	<h2 style=\"text-align: center; font-size: 35px; color: rgb(190,190,190);\">iData<br />
	<img src=\"http://idata.no-ip.info/cloud.png\" style=\"width: 150px;\">
	</h2></a></div>
<h3 style=\"color: rgb(180,180,180);\">Merci :-)</h3>
<p style=\"font-size: 15px;\">Bonjour '.$firstname.', vous êtes désormais membre d\'iData.<br />
Votre nom d\'utilisateur est : '.$username.'<br /><br />
Pour activer votre compte, vous devez cliquer sur cette adresse (ou la copier-coller dans votre barre d\'adresse): :<br />
<a href=\"http://idata.no-ip.info/valid.php?id='.$accountid.'\"> http://idata.no-ip.info/valid.php?id='.$accountid.'</a>
</p><p>Nous espérons vous revoir bientôt sur ​​notre site.<br />L\'équipe iData.</p></body>
</html>" | mail -r noreply@idata.no-ip.info -s "$(echo "Account confirmation\nContent-Type: text/html")" -- '.$email.'');

$log='<img src="../checked2.png" alt="Done !">Merci !</h2>
	<h4 style="font-family: \'Century gothic\', Arial; color: rgb(160,160,160);">Vous êtes maintenant un membre d\'iData! Une dernière étape avant de pouvoir profiter de tous nos services: rendez-vous dans votre boîte mail et cliquez sur le lien de vérification que nous vous avons envoyé. Cette opération marquera votre compte comme actif.</h4><h2>';
	}//Email Already used
	else{
	$log="L'email que vous avez entré est déjà utilisé";
	}
	
	}//USERNAME ALREADY USED
	else{
	$log="Le nom d'utilisateur que vous avez entré est déjà utilisé";
	}
	
	}//<5char
	else{
	$log="Votre nom d'utilisateur et votre mot de passe doivent contenir au moins 5 caractères chacun";
	}
		
	/*}//MR-MRS
	else{
	$log="Le formulaire que vous avez envoyé est invalide (civilité manquante)";
	}*/
	
	}//Email bonne forme
	else{
	$log="Le formulaire que vous avez envoyé est invalide (email incorrect)";
	}
	
	}//pwd - pwd confirm
	else{
	$log="Les mots de passe entrés ne correspondent pas";
	}
	
	}//fORM COMPLET
	else{
	$log="Le formulaire que vous avez envoyé est invalide (incomplet)";
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <title>Inscription</title>
	   	<link rel="icon" type="image/png" href="../cloud.png" />
    </head>
    <body style="background-color: rgb(230,230,254);">
	<?php include("header-fr.php");
	include("../piwiktrack.php");
	echo '<div style="margin-top: 70px; width: 80%; margin-left: 10%; margin-right: 10%;">
	<h2 style="font-family: \'Century gothic\', Arial; color: rgb(190,190,190); text-align: center;">'.$log.'</h2>
	</div>';
	?>
	</body>
</html>