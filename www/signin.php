<?php
session_start();
if(isset ($_COOKIE['accountid']) AND isset ($_COOKIE['token'])){
try{
    $bdd = new PDO('mysql:host=localhost;dbname=idata', 'root', 'YOUR_PASSWORD');
}

catch(Exception $e){
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT Username, Password, Gender, Firstname, Surname, Email, Accountid, Validation, Code, Token, Crypt FROM users WHERE Accountid = ?');
$req->execute(array($_COOKIE['accountid']));
 $donnees = $req->fetch();

   if($donnees['Token'] == $_COOKIE['token'] AND $donnees['Accountid'] == $_COOKIE['accountid']){
   $_SESSION['username']=$donnees['Username'];
   $_SESSION['accountid']=$donnees['Accountid'];
   $_SESSION['firstname']=$donnees['Firstname'];
   $_SESSION['surname']=$donnees['Surname'];
   $_SESSION['email']=$donnees['Email'];
   $_SESSION['password']=$password;
   $_SESSION['code']=$donnees['Code'];
   $_SESSION['gender']=$donnees['Gender'];
   $_SESSION['crypt']=$donnees['Crypt'];
	setcookie('token', $donnees['Token'], time() + 30*24*3600, null, null, false, true);
	setcookie('accountid', $donnees['Accountid'], time() + 30*24*3600, null, null, false, true);
header("Location: mydocs.php");
   }
}

///////////////////CONNEXION CLASSIQUE//////////////////////
if(!empty($_POST['password']) AND !empty($_POST['username']))
{
try//connexion a la bdd
{
    $bdd = new PDO('mysql:host=localhost;dbname=idata', 'root', 'YOUR_PASSWORD');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$password=mysql_real_escape_string($_POST['password']);
$username=mysql_real_escape_string($_POST['username']);

define("PRE","$315EC816%");//Sel
define("POST",",CA17E4CF?");
 
class Secure {
      /**
       * Hash un mot de passe.
       * @param Mot de passe en clair.
       * @return Mot de passe hashé.
       */
    public static function hash($password){
        return hash("whirlpool", PRE . $password . POST);
    }
}
$hash1 = Secure::hash($password);

$req = $bdd->prepare('SELECT Password, Gender, Firstname, Surname, Email, Accountid, Validation, Code, Token, Crypt FROM users WHERE Username = ?');
$req->execute(array($username));
 
$donnees = $req->fetch();

   if($donnees['Password'] == $hash1 AND $donnees['Validation'] == 1)
   {
   $_SESSION['username']=$username;
   $_SESSION['accountid']=$donnees['Accountid'];
   $_SESSION['firstname']=$donnees['Firstname'];
   $_SESSION['surname']=$donnees['Surname'];
   $_SESSION['email']=$donnees['Email'];
   $_SESSION['password']=$password;
   $_SESSION['code']=$donnees['Code'];
   $_SESSION['gender']=$donnees['Gender'];
   $_SESSION['crypt']=$donnees['Crypt'];
	setcookie('token', $donnees['Token'], time() + 30*24*3600, null, null, false, true);
	setcookie('accountid', $donnees['Accountid'], time() + 30*24*3600, null, null, false, true);
header("Location: mydocs.php");
   }

   else{
   $error="Error : incorrect username or password.";
   }
   
   if($donnees['Password'] == $hash1 AND $donnees['Validation'] == 0){
	$error="Error: you have not confirmed your account. Please, click on the link we sent to your email address.";
}
}	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
	   	<link rel="icon" type="image/png" href="cloud.png" />
        <title>Sign up to iData</title>
    </head>
    <body style="background-color: rgb(230,230,254);">	
	<?php include_once("piwiktrack.php"); ?>
	<?php include_once("header-en.php"); ?>

<div class="signinbox">
<div class="signinright">
<h2>Sign in to your account : <br/></h2>
<form method="post" action="">
<p>Username : <input type="text" name="username"/></p>
<p>Password : <input type="password" name="password" /></p>
<input type="submit" value="Sign in" />
</form>
<h2><a href="signup.php">Not signed up ? Clic here</a></h2>
<p style="color: red;"><?php echo"$error"; ?></p>
</div>
</div>


<div style="position: absolute; top: 100px; left: 0px; width: 50%;">
<a href="/" style="text-decoration: none;">
<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190);">iData</h2>
<p style="text-align: center;">
<img src="cloud.png" alt="cloud" style="width: 300px;">
</p>
</a>
</div>

</body>
</html>
