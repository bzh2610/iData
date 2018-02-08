<?php 
/*
session_start();
$log='';
$show = 1;

/////////////////
/////NORMAL//////
/////////////////
if(!empty($_SESSION['accountid'])){

try//connexion a la bdd
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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
        <title>iData - Settings</title>
		<link rel="icon" type="image/png" href="cloud.png" />
    </head>
    <body style="background-color: rgb(255,255,255);">
<?php include_once("piwiktrack.php");
include_once("header-connected-en.php"); ?>
<?php

/////Change PWD//////

if (isset ($_POST['newpwd']) AND isset ($_POST['newpwdconfirm'])){
$newpwd = $_POST['newpwd'];
$newpwdconfirm = $_POST['newpwdconfirm'];

if ($newpwd == $newpwdconfirm){
$show = 0;
define("PRE","$315EC816%");//Sel
define("POST",",CA17E4CF?");
 
class Secure {
    public static function hash($newpwd){
        return hash("whirlpool", PRE . $newpwd . POST);
    }
}
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
	<a href="settings.php" style="color: white; font-family: 'Century Gothic', Arial;" ><p>Go back</a>
	</form>
	</div>
</body>
</html>
<?php
}

else{
$log= 'The passwords don\'t match';
}}

/////ENTER NEW PWD///

else if (isset ($_POST['currentpwd'])){
$currentpwd = $_POST['currentpwd'];

if($currentpwd == $_SESSION['password'])
{
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">New password : <input type="password" name="newpwd"/></h4>
	<h4 style="color: white; font-family: 'Century Gothic', Arial;">Confirm : <input type="password" name="newpwdconfirm"/></h4>
	<input type="submit" value="Next">
	</form>
	</div>
</body>
</html>
<?php
}

else
{
$log= 'Wrong password';
}}


/////CHANGE PWD////

else if (isset ($_GET['pwd'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h3 style="color: white">Type your password : <input type="password" name="currentpwd"/></h3>
	<input type="submit" value="Next">
	</form>
	</div>
</body>
</html>
<?}



//WAIT ERASING//
else if (isset ($_POST['currentpwd2'])){
$currentpwd2 = $_POST['currentpwd2'];

if($currentpwd2 == $_SESSION['password']){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<h2 style="color: white; font-family: 'Century Gothic', Arial;">
	<div id="wipebtn"> <button onclick="show_hide_div();start()">Wipe</button></div>
	<div id="bip" class="display"></div>
	<div id="cancelbtn" style="display: none;"><button onclick="document.location.href = 'settings.php';">Cancel</button></div>
	<div id="goabackbtn" style="display: none;"><button onclick="document.location.href = 'settings.php';">Go back</button></div>

	<script>
var counter = 60;
var intervalId = null;
function action()
{
  clearInterval(intervalId);
  document.getElementById("bip").innerHTML = "Done";
  cancelbtn.style.display="none";
  gobackbtn.style.display="block";
	<?php
	shell_exec('rm -r /var/www/userdata/'.$_SESSION["accountid"].'; mkdir /var/www/userdata/'.$_SESSION["accountid"].'');
	?>
}
function bip()
{
  document.getElementById("bip").innerHTML = counter + " seconds before erasing.";
  counter--;
}
function start()
{
  intervalId = setInterval(bip, 1000);
  setTimeout(action, 60000);
  document.getElementbyId("wipebtn").innerHTML = "Cancel";
}	

function show_hide_div(nomdiv){
wipebtn.style.display="none";
cancelbtn.style.display="block";
}
</script>
	</h2>
	</div>
</body>
</html>
<?php
}

else
{
$log= 'Wrong password';
}
}




//WAIT ERASING//
else if (isset ($_POST['currentpwd3'])){
$currentpwd3 = $_POST['currentpwd3'];

if($currentpwd3 == $_SESSION['password']){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 400px; height: 500px; position: absolute; margin: -250px 0 0 -200px;  text-align: center;">
	
	<div id="warning">
	<img src="images/cry.png" alt="We are sad to see you leaving us" style="width: 200px; position: relative; margin:auto; display: block;">
	<p style="color: white; font-family: 'Century Gothic', Arial;">
	Are you really sure that you want to delete your account ?<br />
	You know that :<br />
	<ul style="color: white;">
	<li>It's permanent : there is no way to get back.
	<li>It's your last chance to go back : This is the last warning before the removal of your account. Once you clicked on "Delete my account", a 60 seconds countdown will show up. If you don't cancel it, your account will be deleted.
	<li>You will lost everything you stored on iData.
	<li>You will lost everything you purchased on iData.
	</ul>	</p>
	<button onclick="show_hide_div(); start()">Delete my account</button>
	</div>
	<div id="bip" class="display" style="font-size: 25px; color: white; position: relative; margin-top: 175px;"></div>
	<div id="cancelbtn" style="display: none;"><button onclick="document.location.href = 'settings.php';">Cancel</button></div>
	
	</div>
	<script>
var counter = 60;
var intervalId = null;
function action()
{
  clearInterval(intervalId);
  document.getElementById("bip").innerHTML = "Done";
  cancelbtn.style.display="none";

	<?php
	shell_exec('rm -r /var/www/userdata/'.$_SESSION["accountid"].'; rm -r /var/www/public/'.$_SESSION["accountid"]);
		$req = $bdd->prepare('DELETE FROM users WHERE Accountid = ?');
		$req->execute(array($_SESSION['accountid']));
		$donnees = $req->fetch();
	?>
	document.location.href="logout.php";
}
function bip()
{
  document.getElementById("bip").innerHTML = counter + " seconds before deleting your account.";
  counter--;
}
function start()
{
  intervalId = setInterval(bip, 1000);
  setTimeout(action, 60000);
  document.getElementbyId("wipebtn").innerHTML = "Cancel";
}	

function show_hide_div(nomdiv){
warning.style.display="none";
cancelbtn.style.display="block";
}
</script>

</body>
</html>


<?php
}

else
{
$log= 'Wrong password';
}
}


///PWD erasing///
else if (isset ($_POST['agree1'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h3 style="color: white">Type your password : <input type="password" name="currentpwd2"/></h3>
	<input type="submit" value="Next">
	</form>
	</div>
</body>
</html>
<?}

///PWD deleting///
else if (isset ($_POST['agree10']) AND isset($_POST['agree11'])){
$show = 0;
?>
<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="settings.php">
	<h3 style="color: white">Type your password : <input type="password" name="currentpwd3"/></h3>
	<input type="submit" value="Next">
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
	<h4 style="color: white; font-family: 'Century Gothic', Arial;"><p><input type="checkbox" name="agree1"/><label for="agree">I understand that I will lose everything stored on iData without any possibility of recovery.</h4>
	<input type="submit" value="Delete everything">
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
	<h4 style="color: white; font-family: 'Century Gothic', Arial;"><p><input type="checkbox" name="agree10"/><label for="agree">I understand that once my account deleted, I will lose everything stored on iData without any possibility of recovery.</h4>
	<h4 style="color: white; font-family: 'Century Gothic', Arial;"><p><input type="checkbox" name="agree11"/><label for="agree">I cancel any option that I subscribed without possibility of refund.</h4>
	<input type="submit" value="Delete my account">
	</form>
	</div>
</body>
</html>
<?}


if($show == 1){
?>
<div style="margin-top: 70px; font-family: 'Century Gothic', Arial;">
<h2>Settings</h2>
<p style="margin-left: 3px; color: red;"><? echo $log;?></p>
<p style="margin-left: 3px;">Firstname : <? echo $_SESSION['firstname'];?></p>
<p style="margin-left: 3px;">Surname : <? echo $_SESSION['surname'];?></p>
<p style="margin-left: 3px;">Gender : <? echo $_SESSION['gender'];?></p>
<p style="margin-left: 3px;">Email : <? echo $_SESSION['email'];?></p>
<p style="margin-left: 3px;">Username : <? echo $_SESSION['username'];?></p>
<p style="margin-left: 3px;">Premium : <? echo $premium;?></p>
<p style="margin-left: 3px;">Premium time left : <? echo ''.$days_to_go.' days '.$hours_to_go.' hours';?></p>
<a href="?pwd"><p style="margin-left: 3px;">Change my password</p></a>
<a href="?erase"><p style="margin-left: 3px;">Erase my cloud</p>
<a href="?delete"><p style="margin-left: 3px;">Delete my account</p>
</div></body></html>

<?php
}}

else{/**/
header("Location: mydocs.php");
//}
?>



