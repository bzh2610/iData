<?php

session_start();
$taillego = 1000;
if(!empty($_SESSION['accountid'])){

$code = $_SESSION['code'];
if ($code != '') //premium
{

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
$actuel = time();

	if( $donnees['End'] > $actuel AND $donnees['Used'] == 0)
	{

	$taillego = $donnees['Taille'] ;
	
	}
}

$i=0;
$accountid=$_SESSION['accountid'];
$dir_nom = "../userdata/$accountid"; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')
$folder ="";
$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
$fichier= array(); // on déclare le tableau contenant le nom des fichiers
$dossier= array(); // on déclare le tableau contenant le nom des dossiers

while($element = readdir($dir)) {
	if($element != '.' && $element != '..') {
		if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
		else {$dossier[] = $element;}
	}
}

closedir($dir);
$cat1=0;
$cat2=0;
$cat3=0;
$cat4=0;
$cat5=0;
$cat6=0;
$cat7=0;


if(!empty($dossier)) {
	sort($dossier);
		foreach($dossier as $lien){
		$subdir = opendir("$dir_nom/$lien") or die('Erreur de listage : le répertoire n\'existe pas');
		
	while($element = readdir($subdir)) {
		if($element != '.' && $element != '..') {
			if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
			else {$dossier[] = $element;}
		}}
		closedir($subdir);
		
		
if(!empty($fichier)){
	sort($fichier);
		foreach($fichier as $lien2) {
			$infosfichier = pathinfo($lien2);
			$extension_upload = $infosfichier['extension'];
			
			$extension_img	= array("bmp", "psd",  "jpg",  "jpeg", "png",  "gif", "zip", "rar", "7z", "gz");
			$extension_vid = array("avi", "mkv", "mp4",  "wmv", "ogg", "mpeg"); 
			$extension_docs = array("idc", "c", "cpp", "txt", "pdf", "doc", "odt", "rtf", "docx", "ppt", "pptx", "odp", "ods", "xls", "xlsx");
			$extension_music = array("mp3", "aac", "flac", "wma", "a3c");
			$extension_arc = array("7z", "zip", "rar", "app", "ipa", "exe", "apk", "msi");
			
			if (in_array ($extension_upload, $extension_img)){
			$img_oct= shell_exec("cd ../userdata/$accountid/$lien; du -s $lien2");
			$img_clear = substr($img_oct, 0, -1);
			$cat1= $cat1 + $img_clear;
			}
			
			else if (in_array ($extension_upload, $extension_vid)){
			$img_oct= shell_exec("cd ../userdata/$accountid/$lien; du -s $lien2");
			$img_clear = substr($img_oct, 0, -1);
			$cat2= $cat2 + $img_clear;
			}
			
			else if (in_array ($extension_upload, $extension_docs)){
			$img_oct= shell_exec("cd ../userdata/$accountid/$lien; du -s $lien2");
			$img_clear = substr($img_oct, 0, -1);
			$cat3= $cat3 + $img_clear;
			}
			
			else if (in_array ($extension_upload, $extension_musics)){
			$img_oct= shell_exec("cd ../userdata/$accountid/$lien; du -s $lien2");
			$img_clear = substr($img_oct, 0, -1);
			$cat4= $cat4 + $img_clear;
			}
			
			else{
			$img_oct= shell_exec("cd ../userdata/$accountid/$lien; du -s $lien2");
			$img_clear = substr($img_oct, 0, -1);
			$cat5= $cat5 + $img_clear;
			}		
		
		}
	}
		
		}
	}

$cat1= round( $cat1 / 1024, 0, PHP_ROUND_HALF_UP);
$cat2= round( $cat2 / 1024, 0, PHP_ROUND_HALF_UP);
$cat3= round( $cat3 / 1024, 0, PHP_ROUND_HALF_UP);
$cat4= round( $cat4 / 1024, 0, PHP_ROUND_HALF_UP);
$cat5= round( $cat5 / 1024, 0, PHP_ROUND_HALF_UP);
$cat6= round( $cat6 / 1024, 0, PHP_ROUND_HALF_UP);
$cat7= $taillego - $cat1-$cat2-$cat3-$cat4-$cat5-$cat6;

$total= $cat1 + $cat2 + $cat3 + $cat4 + $cat5 + $cat6 + $cat7;
$coef= 100 / $total;

$p1= $coef* $cat1;
$p2= $coef* $cat2;
$p3= $coef* $cat3;
$p4= $coef* $cat4;
$p5= $coef* $cat5;
$p6= $coef* $cat6;
$p7= $coef* $cat7;

$taille_graph= 5;
echo'


<body style="font-family: \'Century Gothic\', Arial;background-color: rgb(240,240,240);">
<p style="margin: auto; width: 550px;">
<img src="../red_bar.png" alt="grey" style="height:50px; width:'. $taille_graph * $p1.'px"><img src="../blue_bar.png" alt="blue" style="height:50px; width:'. $taille_graph * $p2.'px"><img src="../green_bar.png" alt="yellow" style="height:50px; width:'. $taille_graph * $p3.'px"><img src="../yellow_bar.png" alt="orange" style="height:50px; width:'. $taille_graph * $p4.'px"><img src="../orange_bar.png" alt="orange" style="height:50px; width:'. $taille_graph * $p5.'px"><img src="../pink_bar.png" alt="orange" style="height:50px; width:'. $taille_graph * $p6.'px"><img src="../grey_bar.png" alt="orange" style="height:50px; width:'. $taille_graph * $p7.'px"></p>

<div style="width: 500px; margin: auto;">
<div style="position: relative; top: 10px; margin-left: 5px; width: 240px; float: left;"> 
<p style="color: #ff0000">Images : '.$cat1.'Mo</p>
<p style="color: #2e8aff">Vidéos : '.$cat2.'Mo</p>
<p style="color: #4aff52">Documents : '.$cat3.'Mo</p>
<p style="color: #ffd600">Musique : '.$cat4.'Mo</p>
</div>

<div style="position: relative; top:10px; margin-right: 5px; width: 240px; float: right;">
<p style="color: #ff9600">Autres : '.$cat5.'Mo</p>
<!--<p style="color: #cd8aff">Phone : '.$cat6.'Mo</p>-->
<p style="color: #767676">Libre : '.$cat7.'Mo</p>
</div>
</div>
</body>';

echo'<p style="width: 100px; display: inline;"><br /></p>';
}
?>