<?php 
if ( empty($_POST['agree'])){
	$log="You did not accept the Terms of service : you can’t use iData if you don’t agree with them";
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
<h3 style=\"color: rgb(180,180,180);\">Thank you :-)</h3>
<p style=\"font-size: 15px;\">Hello '.$firstname.', you are now a member of iData.<br />
Your username is : '.$username.'<br /><br />
To activate your account you must go to this address (copy and paste it to your address bar) :<br />
<a href=\"http://idata.no-ip.info/valid.php?id='.$accountid.'\"> http://idata.no-ip.info/valid.php?id='.$accountid.'</a>
</p><p>We hope to see you soon on our website.<br />iData\'s team.</p></body>
</html>" | mail -r noreply@idata.no-ip.info -s "$(echo "Account confirmation\nContent-Type: text/html")" -- '.$email.'');

	$log='<img src="checked2.png" alt="Done !">Thank you !</h2>
	<h4 style="font-family: \'Century gothic\', Arial; color: rgb(160,160,160);">You are now a member of iData ! Just one more step before enjoying all our services : please go to your mail box and click on the verification link we send to you. This operation will mark your account as active</h4><h2>';
	}//Email Already used
	else{
	$log="The email you specified is already is use";
	}
	
	}//USERNAME ALREADY USED
	else{
	$log="The username you specified is already is use";
	}
	
	}//<5char
	else{
	$log="Your username and password must contain at least 5 characters";
	}
		
	/*}//MR-MRS
	else{
	$log="It seems that you submitted an invalid form (gender field)";
	}*/
	
	}//Email bonne forme
	else{
	$log="It seems that you submitted an invalid form (wrong mail)";
	}
	
	}//pwd - pwd confirm
	else{
	$log="Passwords entered do not match";
	}
	
	}//fORM COMPLET
	else{
	$log="It seems that you submitted an invalid form (incomplete)";
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
       <title>Sign up</title>
	   	<link rel="icon" type="image/png" href="cloud.png" />
    </head>
    <body style="background-color: rgb(230,230,254);">
	<?php include("header-en.php");
	include("piwiktrack.php");
	echo '<div style="margin-top: 70px; width: 80%; margin-left: 10%; margin-right: 10%;">
	<h2 style="font-family: \'Century gothic\', Arial; color: rgb(190,190,190); text-align: center;">'.$log.'</h2>
	</div>';
	?>
	</body>
</html>