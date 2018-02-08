<?php
session_start();

if(!empty($_SESSION['accountid'])){

if(isset ($_POST['code'])){

$code =mysql_real_escape_string($_POST['code']);

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
   $actuel = time();
   $expiration = $donnees['End'] + $actuel;
   
   $req = $bdd->prepare('UPDATE premium SET Used = :Used, End = :End WHERE Code = :Code');
$req->execute(array(
    'Used' => 0,
    'End' => $expiration,
    'Code' => $code
    ));
	
	  $req = $bdd->prepare('UPDATE users SET Code = :Code WHERE Accountid = :Accountid');
$req->execute(array(
    'Code' => $code,
    'Accountid' => $_SESSION['accountid']
    ));
		
	echo "You are now a premium member !";
	
   }
}
}

else
{
header('Location: signin.php');

}

?>