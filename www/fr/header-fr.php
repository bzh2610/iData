<?
$taillego=1;
if(isset ($_COOKIE['accountid']) AND isset ($_COOKIE['token'])){
try{
    $bdd = new PDO('mysql:host=localhost;dbname=idata', 'root', 'YOUR_PASSWORD');
}

catch(Exception $e){
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('SELECT Username, Password, Gender, Firstname, Surname, Email, Accountid, Validation, Code, Token FROM users WHERE Accountid = ?');
$req->execute(array($_COOKIE['accountid']));
 $donnees = $req->fetch();

   if($donnees['Token'] == $_COOKIE['token'] AND $donnees['Accountid'] == $_COOKIE['accountid']){
   $_SESSION['username']=$donnees['Username'];
   $_SESSION['accountid']=$donnees['Accountid'];
   $_SESSION['firstname']=$donnees['Firstname'];
   $_SESSION['surname']=$donnees['Surname'];
   $_SESSION['email']=$donnees['Email'];
   $_SESSION['password']=$donnees['Password'];
   $_SESSION['code']=$donnees['Code'];
   $_SESSION['gender']=$donnees['Gender'];
	setcookie('token', $donnees['Token'], time() + 30*24*3600, '/', null, false, true);
	setcookie('accountid', $donnees['Accountid'], time() + 30*24*3600, '/', null, false, true);
   }
   
$req = $bdd->prepare('SELECT Used, Taille, End FROM premium WHERE Code = ?');
$req->execute(array($donnees['Code']));
$donnees = $req->fetch();
$actuel = time();

	if( $donnees['End'] > $actuel AND $donnees['Used'] == 0)
	{
	$maxupload = $donnees['Taille'] * 1048576;
	$taillego = $donnees['Taille'] / 1000;
	}   
}
?>

<header style="background-color: rgb(104,104,104); height: 45px; width: 100%; position: absolute; right: 0px; top: 0px;">

<?php if (isset ($_SESSION['accountid'])){
//CONNECTED ?>
<div style="display: block; width: 750px; margin: auto;">
<?php } else{ //NOT CONNECTED?>
<div style="display: block; width: 650px; margin: auto;">
<?php } ?>


<a href="index.php">
<img onmouseout="this.src='../images/home.png'" onmouseover="this.src='../images/hoverhome.png'" 
src="../images/home.png" alt="home" style="height: 45px;position: relative;" class="img" id="img_01"></a>

<a href="plans.php">
<img onMouseOver="this.src='../images/hoverplansfr.png'" onMouseOut="this.src='../images/plansfr.png'" 
src="../images/plansfr.png" alt="plans" style="height: 45px; left: -30px; position: relative;" class="img" id="img_02"></a>

<a href="features.php">
<img onMouseOver="this.src='../images/hoverfeaturesfr.png'" onMouseOut="this.src='../images/featuresfr.png'" 
src="../images/featuresfr.png" alt="features" style="height: 45px; left: -40px; position: relative;" class="img" id="img_03"></a>

<?php if (isset ($_SESSION['accountid'])){
?>

<a href="../mydocs.php">
<img onMouseOver="this.src='../images/hovermyfilesfr.png'" onMouseOut="this.src='../images/myfilesfr.png'" 
src="../images/myfilesfr.png" alt="home" style="height: 45px; left: -25px; position: relative;" class="img" id="img_555"></a>

<a href="plans.php">
<img onMouseOver="this.src='../images/hoverpremiumfr.png'" onMouseOut="this.src='../images/premiumfr.png'" 
src="../images/premiumfr.png" alt="home" style="height: 45px; position: relative; left: -28px;" class="img" id="img_00"></a>

<?php if ($taillego == 1){ ?>
<img src="../o.png" alt="disabled" style="height: 25px; left: -40px; right: 50px; position: relative; top: -12px;" class="img"></a>
<?php } else { ?>
<img src="../i.png" alt="disabled" style="height: 25px; left: -40px; right: 50px; position: relative; top: -12px;" class="img"></a>
<?php } ?>

<a href="settings.php">
<img src="../images/settings.png" alt="settings" style="height: 35px; position: relative; top: -5px; margin-left: -30px;"></a>

<a href="../logout.php">
<img src="../images/logout.png" alt="logout" style="height: 35px; position: relative; top:-5px;  margin-left: 5px;"></a>

<?php
}
else{
?>

<a href="#" onclick="signin.style.display='block'; talkbox.style.display='block'; upbtn.style.display='none';">
<img onMouseOver="this.src='../images/hoversigninfr.png'"
onMouseOut="this.src='../images/signinfr.png'"
src="../images/signinfr.png" alt="home" style="height: 45px; left: -40px; position: relative;" class="img" id="img_04"></a>
<!--
<a href="signup.php">
<img onMouseOver="this.src='../images/hoversignupfr.png'" onMouseOut="this.src='../images/signupfr.png'" 
src="../images/signupfr.png" alt="home" style="height: 45px; left: -50px; position: relative;" class="img" id="img_00"></a>-->
<a href="#"  onclick="signup_hide.style.display='block'; signupbox.style.display='block'; upbtn.style.display='none';">
<img onMouseOver="this.src='../images/hoversignupfr.png'"
onMouseOut="this.src='../images/signupfr.png'"
src="../images/signupfr.png" alt="home" style="height: 45px; left: -40px; position: relative;" class="img" id="img_04"></a>

<?php } ?>

</div>
</header>

<div id="signin" onclick="location.reload()" style="z-index: 1; display: none; width: 100%; height: 100%; position: fixed; top: 0px; right:0px; background-color: rgb(0,0,0); opacity: 0.5;">
</div>
<div id="signup_hide" onclick="location.reload()" style="z-index: 1; display: none; width: 100%; height: 100%; position: fixed; top: 0px; right:0px; background-color: rgb(250,250,250); opacity: 0.5;">
</div>

<div id="talkbox" style="z-index: 2; opacity: 1; display: none; background-color: rgb(250,250,250);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(100,100,100); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 320px; height: 400px; position: fixed; margin: -200px 0 0 -160px;  text-align: center;">
	<div style="position: relative; top: -20px;">
	<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190);">iData</h2>
	<img src="../cloud.png" alt="cloud" style="top: -20px; width: 200px; position: relative; margin: auto;">
	<form method="post" action="signin.php">
	<p style="font-size: 18px;">Pseudo : <input type="text" name="username"/></p>
	<p style="font-size: 18px;">Mot de passe : <input type="password" name="password"/></p>
	<p style="font-size: 18px;"><input type="checkbox" name="rememberme"/>Connexion automatique</p>
	<input type="submit" value="Login">
	</form>
	</div>
</div>

<div id="signupbox" style="z-index: 2; opacity: 1; display: none; background-color: rgb(150,150,150);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(100,100,100); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 350px; height: 350px; position: fixed; margin: -175px 0 0 -175px;  text-align: center;">
	<div style="position: relative; top: -20px;">
<!--	<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: white;">iData</h2>
<img src="../cloud.png" alt="cloud" style="top: -20px; width: 120px; position: relative; margin: auto;">
	-->
	<form style="color: white;position: relative; top: 20px;" method="post" action="success-sign-up.php">
	<p>Prénom : <input type="text" name="firstname"/></p>
	<p>Nom : <input type="text" name="surname"/></p>
	<p>Email : <input type="email" name="email" /></p>
	<p>Pseudo : <input type="text" name="username" /></p>
	<p>Mot de passe : <input type="password" name="password" /></p>
	<p>Confirmation : <input type="password" name="passwordconfirm" /></p>
	<p><input type="checkbox" name="agree" id="agree" /> <label for="agree">J'accepte les <a style="color: white;" href="../tos.php">conditions d'utilisation</a> et les <a style="color: white;" href="../privacy.php">règles de confidentialité</a> d'iData.</label>
	<br />
	<input type="submit" value="Envoyer" />
	</form>
	</div>
</div>
