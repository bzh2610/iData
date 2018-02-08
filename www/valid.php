<?php
if (!empty($_GET['id'])) //vérifie que l'url contient un champ "id"
{
$id=$_GET['id'];

try//connexion a la bdd
{
    $bdd = new PDO('mysql:host=localhost;dbname=idata', 'root', 'YOUR_PASSWORD');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$req = $bdd->prepare('UPDATE users SET Validation = 1 WHERE Accountid = :id');
$req->execute(array(
    'id' => $id
    ));
mkdir("userdata/$id");
mkdir("public/$id");
$index= fopen("public/$id/index.php", "a+");
fputs ($index, "<?php\nheader(\"Location: mydocs.php\");\n?>");
fclose($index);
?>
<html>
<body style="background-color: rgb(230,230,255);">
<?php include_once("piwiktrack.php"); ?>
<?php include_once("header-en.php"); ?>
	<div style="font-family: 'Century Gothic', Arial; margin-top: 70px; text-align: center;">
	<h2>Congratulations !</h2>
	<br />
	<p>Your account is now activated, go to the login page to use iData</p>
	<a href="signin.php">Sign in now !</a>
	</div>
</body>
</html>

<?php
}

else//pas de champ id dans l'url
{
echo 'Erreur : URL incorrecte';
}
?>