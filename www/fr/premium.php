<?php
session_start();

if(isset ($_POST['code'])){

$code=mysql_real_escape_string($_POST['code']);

	try//connexion a la bdd
	{
    $bdd = new PDO('mysql:host=localhost;dbname=idata', 'root', 'YOUR_PASSWORD');
	}
	catch(Exception $e)
	{
	die('Erreur : '.$e->getMessage());
	}
	
$req = $bdd->prepare('SELECT Used, Taille, End FROM premium WHERE Code = ?');
$req->execute(array($code));
$donnees = $req->fetch();

   if($donnees['Used'] == 1)
   {
   $period=$donnees['End'] / (60*60*24);
   $taille = $donnees['Taille'] / 1000;
   $message = 'Vous êtes sur le point d\'activer un forfait de '.$taille.' Go pour une durée de '.$period.' jours. Voulez vous continuer ?';
   ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>iData premium</title>
		<link rel="icon" type="image/png" href="../cloud.png" />
</head>	
    <body style="background-color: rgb(254,64,60);">	
	<?php include_once("../piwiktrack.php"); ?>
	<?php include_once("header-fr.php"); ?>
	<div style="background-color: rgb(100,100,100);	top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250);-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family:'Century Gothic', Arial; width: 300px; height: 400px; position: absolute; margin: -200px 0 0 -150px; text-align: center;">
	<form method="post" action="../activatepremium.php">
	<h1 style="color: white;">Parfait !
	<p style="color: white; font-size: 20px;"> <?php echo $message; ?></p>
	<input type="hidden" name="code" value="<?php echo $code; ?>"/> 
	<input type="submit" value="Activer">
	</form>
	</div>
</body>
</html>
   
   <?php
   }
   
   else{?>
   <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>iData premium</title>
		<link rel="icon" type="image/png" href="../cloud.png" />
</head>	
    <body style="background-color: rgb(254,64,60);">	
	<?php include_once("../piwiktrack.php"); ?>
	<?php include_once("header-fr.php"); ?>
	<div style="background-color: rgb(100,100,100);	top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250);-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family:'Century Gothic', Arial; width: 300px; height: 100px; position: absolute; margin: -50px 0 0 -150px; text-align: center;">
	<p style="color: white; font-size: 20px;">Erreur : le code est incorrect</p>
	<a href="premium.php" style="text-decoration : none;"><input type="submit" value="Retour"></a>
	</div>
</body>
</html>
<?php
   }
}

else{
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>iData premium</title>
		<link rel="icon" type="image/png" href="../cloud.png" />
</head>		
    <body style="background-color: rgb(254,64,60);">	
	<?php include_once("../piwiktrack.php"); ?>
	<?php include_once("header-fr.php"); ?>
	<div style="background-color: rgb(100,100,100);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(250,250,250); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 300px; height: 160px; position: absolute; margin: -80px 0 0 -150px;  text-align: center;">
	<form method="post" action="">
	<h1 style="color: white">Code premium : <input type="text" name="code"/></h1>
	<input type="submit" value="Premium">
	</form>
	</div>
</body>
</html>

<?php
}
