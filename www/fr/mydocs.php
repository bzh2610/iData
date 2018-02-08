<?php
session_start();
$fileuploadresult=0;
$taillefichier=0;
$h=0;
$i3=0;
$extension_upload='';
$maxupload = 1048576000;
$taillego = 1;

if(!empty($_SESSION['accountid'])){
$i=0;
$accountid=$_SESSION['accountid'];
$dir_nom = "../userdata/$accountid"; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')


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
	$maxupload = $donnees['Taille'] * 1048576;
	$taillego = $donnees['Taille'] / 1000;
	}
}


if (isset($_POST['file_tomove']) AND isset($_POST['folder_tomove']))
{
header('Location: ../move.php?file_tomove='.$_POST['file_tomove'].'&folder_tomove='.$_POST['folder_tomove'].'');
}

if (isset($_POST['file_todelete']))
{
header('Location: ../delete.php?lang=fr&file='.$_POST['file_todelete'].'');
}

if (isset($_POST['file_torename']) AND isset($_POST['name_torename']))
{
header('Location: ../rename.php?file='.$_POST['file_torename'].'&name='.$_POST['name_torename'].'');
}

if (isset($_POST['file_toshare']))
{
header('Location: ../share.php?file='.$_POST['file_toshare'].'&lang=fr');
}

if (isset($_POST['file_tocrypt'])){
$file_tocrypt = escapeshellcmd($_POST['file_tocrypt']);
$crypt_pwd = escapeshellcmd($_POST['crypt_pwd']);
shell_exec('aescrypt -e -p '.$crypt_pwd.' /var/www/userdata/'.$accountid.'/'.basename($file_tocrypt).'');
}

if (isset($_POST['file_touncrypt'])){
$file_touncrypt = escapeshellcmd($_POST['file_touncrypt']);
$crypt_pwd = escapeshellcmd($_POST['crypt_pwd']);
shell_exec('aescrypt -d -p '.$crypt_pwd.' /var/www/userdata/'.$accountid.'/'.basename($file_touncrypt).'');
}

if (isset($_POST['file_noshare']))
{
header('Location: ../share.php?file='.$_POST['file_noshare'].'&lang=fr&private=y');
}


if (isset($_FILES['monfichier']))
{
$taille = shell_exec("cd ../userdata/$accountid; du -s");
$taille = substr($taille, 0, -1);

	if ($_FILES['monfichier']['error'] == 0)
	{
        // Testons si le fichier n'est pas trop gros
        if ($_FILES['monfichier']['size'] <= 524288000)
        {
			if($_FILES['monfichier']['size'] + $taille <= $maxupload) //si il y a assez de place sur le cloud
			{
                // Testons si l'extension est autorisée
                $infosfichier = pathinfo($_FILES['monfichier']['name']);
                $extension_upload = $infosfichier['extension'];
				$extension_upload = strtolower($extension_upload);

				$extension_interdite = array("php", "php3");
				
				if (! file_exists("../userdata/$accountid/".basename($_FILES['monfichier']['name']).""))
				{
           
					if (!in_array($extension_upload, $extension_interdite))
					{
						$fichier = basename($_FILES['monfichier']['name']);
						$fichier = strtr($fichier,'
						ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
						'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
						$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
						
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['monfichier']['tmp_name'], "../userdata/$accountid/" . basename($_FILES['monfichier']['name']));
                        
						$filerename = basename($_FILES['monfichier']['name']);
						$extension =strrchr($filerename,'.');
						$extension = strtolower($extension);
						$filerename = substr("$filerename" , 0, -(strlen($extension)));
						
						rename("../userdata/$accountid/".basename($_FILES['monfichier']['name'])."", "../userdata/$accountid/$filerename$extension");
						
						$uploadlog = "Le fichier a été envoyé !";
					}
					
					else
					{
					$uploadlog = "You are not allowed to post a .php file, sorry";
					}
				}
				else
				{
				$uploadlog = "This file already exists, please rename your file.";		
				}
				
			}
			else//taillecloud
			{
			$uploadlog = "Erreur : Votre cloud est plein";
			}
        }
		else//taille
		{
		$uploadlog= "Error : The file you selected is too large to be uploaded :( you can split it in small parts using 7-Zip.";
		}
	}
	else //error = 0
	{
	$uploadlog ="Error : it seems that you have not selected any file or that an unknown error occurred.";
	}
$fileuploadresult=1;
} //isset monfichier



if (isset ($_GET['folder']))
{
$folder = basename($_GET['folder']);
if ( $folder == "..")
{
$folder ="";
}
$dir_nom = "../userdata/$accountid/".basename($folder)."";
$container= "&container=". basename($folder)."";
}
else
{
$container= "";
}

$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
$fichier= array(); // on déclare le tableau contenant le nom des fichiers
$dossier= array(); // on déclare le tableau contenant le nom des dossiers
$hta='.htaccess';
$index='index.php';


//Nouveau fichier txt - idc
if (isset ($_POST['newfile']) AND isset($_POST['format'])){
$newfile= $_POST['newfile'];

if ($_POST['format'] == 2){
$createfile = fopen('../userdata/'.$accountid.'/'. basename($newfile).'.txt', 'a+');
fclose($createfile);
}

else if( $_POST['format'] == 1){
$createfile = fopen('../userdata/'.$accountid.'/'. basename($newfile).'.idc', 'a+');
fclose($createfile);
}
}

//Nouveau dossier
if (isset ($_POST['newfolder'])){
$newfolder= $_POST['newfolder'];
mkdir('../userdata/'.$accountid.'/'.basename($newfolder).'');
}

//Téléchargement ou ouverture
if (isset ($_GET['file_download'])){
$file_download=$_GET['file_download'];
	if(isset($_GET['container']))
	{$container = ''.basename($_GET['container']).'/'; }
	else
	{$container= '';}

if (($file_download != "") && (file_exists("../userdata/$accountid/$container" . basename($file_download))))
{
$infosfichier = pathinfo(basename($file_download));
$extension_upload = $infosfichier['extension'];
$pictures_ext = array ("jpg", "png", "gif", "bmp", "jpeg");

if ($extension_upload == ("txt")){
header("Location: ../text.php?file=".basename($file_download)."&container=$container");
}

else if ($extension_upload == ("idc")){
header("Location: myaccount.php?file=".basename($file_download)."&container=$container");
}

else if (in_array ($extension_upload, $pictures_ext)){
header("Location: ../picture.php?file=".basename($file_download)."&container=$container");
}

else{
$size = filesize("../userdata/$accountid/$container" . basename($file_download));
header("Content-Type: application/force-download; name=\"" . basename($file_download) . "\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $size");
header("Content-Disposition: attachment; filename=\"" . basename($file_download) . "\"");
header("Expires: 0");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
readfile("../userdata/$accountid/$container" . basename($file_download));
exit();
} } }

$fr_header=1;
$lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); 
if ($lang == 'fr'){
$fr_header= 0;
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
<style>
.fileexplorer{
	margin-top: 15%;
}
.fileexplorer img
{
width: 100px;
}

a{
text-decoration: none;
}
</style>
<title>iData</title>
<link rel="icon" type="image/png" href="../cloud.png" />
<meta name="viewport" content="width=device-width"/>

</head>

<body style="font-family: 'Century Gothic', Arial;">
	<div id="mask" onclick="location.reload()" style="z-index: 9; display: none; width: 100%; height:100%; position: fixed; top: 0px; right:0px; background-color: rgb(0,0,0); opacity: 0.5;">
</div>
<?php include_once("../piwiktrack.php"); ?>

<script>
function setDisplay (obj, display) {
   mask.style.display='block';
   obj.style.display = display;
}

function show_hide_div(nomdiv){
var lediv = document.getElementById(nomdiv);
if(lediv.style.display=="block")
lediv.style.display="none";
else
lediv.style.display="block";
}


</script>

<?php
if (!isset ($_SESSION['accountid'])){ ?>
<div style="z-index: 1; width: 100%; min-height: 30px; height: 10%; position: absolute; left: 0px; top: 0px; background-color: rgb(104,104,104);"> <!-- Menu bar-->
	<a href="#" onclick="signin.style.display='block'; talkbox.style.display='block'; upbtn.style.display='none';">
	<img src="../images/hoversigninfr.png" alt="menu" style="position: absolute; height: 100%; right: 0%;"/></a>
</div>

<?php }else{ ?>


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
</div>

<!-- CORPS--> 
 
<div class="fileexplorer">
<?php
$divnumber=0;

while($element = readdir($dir)) {
	if($element != '.' && $element != '..') {
		if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
		else {$dossier[] = $element;}
	}
}

closedir($dir);

if(!empty($dossier)) {
$h=1;
	sort($dossier); // pour le tri croissant, rsort() pour le tri décroissant
		foreach($dossier as $lien){
	
			$lienaffiche=$lien;
			$taille_ext= 1 + strlen($extension_upload);
			$taillefichier=strlen($lien);
			
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, -$taille_ext);
			}
			$taillefichier=strlen($lienaffiche);
			
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, - $tailefichier + 10);
			$lienaffiche="$lienaffiche.";
			}
			
			if($i3==4){
			$i3=0;
			$h++;
			}
			$i3++;

		echo "<div oncontextmenu=\"setDisplay(document.getElementById('divnumber$divnumber'), 'block'); return false;\" style='position: relative; padding: 5px; margin-left: 0px; margin-top: 30px; float: left; width: 100px; text-align: center;'>
			<p style='color: $file_shared;'><a href=\"?folder=../userdata/$accountid/$lien \">
			<img src=\"../folder-blue.png\" alt=\"folder\"></a><br />$lienaffiche</p>
			</div>";
		}
	}

if(!empty($fichier)){
	sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
		foreach($fichier as $lien) {
			
			$infosfichier = pathinfo($lien);
			$extension_upload = $infosfichier['extension'];

				if ($lien == ".htaccess" || strcmp($lien, $index) == 0){}
				
				else{		
			$extension_icon = array("ipa", "bmp", "app", "msi", "exe", "avi", "mkv", "mp4",  "wmv", "mp3", "aac", "flac", "wma", "idc",  "psd",  "jpg",  "jpeg", "png",  "gif", "txt", "pdf", "doc", "odt", "rtf", "docx", "ppt", "pptx", "odp", "ods", "xls", "xlsx", "zip", "rar", "7z", "gz");
			
			if ( ! in_array ($extension_upload, $extension_icon))
			{
			$extension_upload = "other";
			}
			$lienaffiche=$lien;
			
			if (file_exists("../public/$accountid/$lien")) 
			{
			$file_shared="rgb(248,160,0)";
			}
			
			else{
			$file_shared="rgb(180,180,180)";
			}
			
			$taille_ext= 1 + strlen($extension_upload);
			$taillefichier=strlen($lien);
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, -$taille_ext);
			}
			$taillefichier=strlen($lienaffiche);
			
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, - $taillefichier + 10);
			$lienaffiche="$lienaffiche.";
			}
					
			if($i==4){
			$i=0;
			}
			
			$i++;

			echo "\n<div oncontextmenu=\"setDisplay(document.getElementById('divnumber$divnumber'), 'block'); return false;\" style='position: relative; padding: 5px; margin-left: 0px; margin-top: 30px; float: left; width: 100px; text-align: center;'>
				<p style='color: $file_shared;'>
			<a href=\"$dir_nom/$lien$container \"><img src=\"../$extension_upload.png\" alt=\"file\"></a><br />$lienaffiche</p>
			</div>";
			
			echo "\n<div id=\"divnumber$divnumber\"
		style=\"color: white; z-index: 10; display:none; background-color: rgb(180,180,180); top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250);-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; width: 200px; height: 300px; position: absolute; margin: -150px 0 0 -100px; text-align: center;\">
		<p>
		<form id=\"form_del$divnumber\" action=\"\" method=\"post\" style=\"display:none;\">
		<input type=\"hidden\" name=\"file_todelete\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
		</form>
		<form id=\"form_share$divnumber\" action=\"\" method=\"post\" style=\"display:none;\">
		<input type=\"hidden\" name=\"file_toshare\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
		</form>
		<form id=\"form_noshare$divnumber\" action=\"\" method=\"post\" style=\"display:none;\">
		<input type=\"hidden\" name=\"file_noshare\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
		</form>

		$lienaffiche<br /><br />";
		
		if($extension_upload == "aes"){
		echo"<a href=\"#\" style=\"color: white;\" onclick=\"rendivnumber$divnumber.style.display='none';uncryptdivnumber$divnumber.style.display='block';\">
		Déchiffrer</a><br />";}
		
		else{
		echo"<a href=\"#\" style=\"color: white;\" onclick=\"rendivnumber$divnumber.style.display='none';cryptdivnumber$divnumber.style.display='block';\">
		Chiffrer</a><br />";}
		
		echo "<a href=\"#\" style=\"color: white;\" onclick=\"document.getElementById('form_share$divnumber').submit(); return false;\">
		Partager</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"document.getElementById('form_noshare$divnumber').submit(); return false;\">
		Personnel</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"cryptdivnumber$divnumber.style.display='none';rendivnumber$divnumber.style.display='block';\">
		Renommer</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"document.getElementById('form_del$divnumber').submit(); return false;\">
		Supprimer</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"document.getElementById('form_get$divnumber').submit(); return false;\">
		Télécharger</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"propdivnumber$divnumber.style.display='none';\">
		Propriétés</a><br />
				</p>
		
		<div id=\"rendivnumber$divnumber\" style=\"display:none; z-index:20; position: relative; width: 100%; margin-top: 10%;\">
		
		<form action=\"\" method=\"post\">
		<p style=\"text-align: center;\">
		<input type=\"hidden\" name=\"file_torename\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
				Nouveau nom :<br />
				<input type=\"text\" name=\"name_torename\" />
				<input type=\"submit\" value=\"Renommer\">
		</p>
		</form>
		</div>
		
		<div id=\"cryptdivnumber$divnumber\" style=\"display:none; z-index:20; position: relative; width: 100%; margin-top: 10%;\">
		
		<form action=\"\" method=\"post\">
		<p style=\"text-align: center;\">
		<input type=\"hidden\" name=\"file_touncrypt\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
				Mot de passe :<br />
				<input type=\"password\" name=\"crypt_pwd\" />
				<input type=\"submit\" value=\"Crypter\">
		</p>
		</form>
		</div>
		</div>

		";
				$divnumber++;
				}
		}
 }
 
 if($i==0)
 {
 echo "Vide !";
 }
 ?>
 </div> 
   
 
 
<?php }else{ ?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="../style.css" />
        <title>iData - Mes documents</title>
		<link rel="icon" type="image/png" href="../cloud.png" />
    </head>
    <body style="background-color: rgb(255,255,255);" >
	<div id="mask" onclick="location.reload()" style="z-index: 9; display: none; width: 100%; height:100%; position: fixed; top: 0px; right:0px; background-color: rgb(0,0,0); opacity: 0.5;">
</div>
<?php include_once("../piwiktrack.php");
include_once("header-fr.php");
?>

<nav class="mydocsnav" style="margin-top: 50px;">
<p style="margin-left: 3px;">Bonjour <? echo $_SESSION['firstname'];?></p>

<script>
function setDisplay (obj, display) {
   mask.style.display='block';
   obj.style.display = display;
}

function show_hide_div(nomdiv){
var lediv = document.getElementById(nomdiv);
if(lediv.style.display=="block")
lediv.style.display="none";
else
lediv.style.display="block";
}

function hide_div(nomdiv){

if (nomdiv=="newfile"){
move.style.display="none";
id1.style.display="none";
rename.style.display="none";
del.style.display="none";
remind.style.display="none";
get.style.display="none";
}

else if (nomdiv == "move"){
newfile.style.display="none";
id1.style.display="none";
rename.style.display="none";
del.style.display="none";
remind.style.display="none";
get.style.display="none";
}

else if (nomdiv == "id1"){
newfile.style.display="none";
move.style.display="none";
rename.style.display="none";
del.style.display="none";
remind.style.display="none";
get.style.display="none";
}

else if (nomdiv == "rename"){
newfile.style.display="none";
move.style.display="none";
id1.style.display="none";
del.style.display="none";
remind.style.display="none";
get.style.display="none";
}

else if (nomdiv == "del"){
newfile.style.display="none";
move.style.display="none";
id1.style.display="none";
rename.style.display="none";
remind.style.display="none";
get.style.display="none";
}

else if (nomdiv == "remind"){
newfile.style.display="none";
move.style.display="none";
id1.style.display="none";
rename.style.display="none";
del.style.display="none";
get.style.display="none";
}

else if (nomdiv == "get"){
newfile.style.display="none";
move.style.display="none";
id1.style.display="none";
rename.style.display="none";
del.style.display="none";
remind.style.display="none";
}
}


//->REMINDERS
function setchecked()
{
	document.images["1l"].src="1.png";
	document.images["2l"].src="2.png";
	document.images["3l"].src="3.png";
	document.images["4l"].src="4.png";			
}
</script>

<?php
$taille_brute = shell_exec("cd ../userdata/$accountid; du -s");
$taille = substr($taille_brute, 0, -1);
$taille = round( $taille / 1024, 0, PHP_ROUND_HALF_UP);
echo '<p style="margin-left: 3px;" >Utilisation : '.$taille.'Mo/'.$taillego.'Go</p>';
?>

<a href="#"><img src="../new.png" alt="new" class="sendlogo" title="New file" onClick="hide_div('newfile');show_hide_div('newfile')"></a><br />
<a href="#"><img src="../move.png" alt="move" class="renamebutton" title="Move a file" onClick="hide_div('move');show_hide_div('move')"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="../upload.png" alt="upload" class="sendlogo_2" title="Upload" onClick="hide_div('id1');show_hide_div('id1')"></a>
<a href="#"><img src="../rename.png" alt="rename" class="renamebutton" title="Rename a file" onClick="hide_div('rename');show_hide_div('rename')"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="../delete.png" alt="remove" class="removebutton" title="Remove a file" onClick="hide_div('del');show_hide_div('del')"></a>
<a href="#"><img src="../remind.png" alt="remind" class="remindbutton" title="Remind me something" onClick="hide_div('remind');show_hide_div('remind')"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="../get.png" alt="get" class="getbutton" title="Download a file" onClick="hide_div('get');show_hide_div('get')"></a>
<a href="#"><img src="../share.png" alt="share" class="sharebutton" title="Share a file" onClick="hide_div('share');show_hide_div('share')"></a>
<br /><p>&nbsp </p><br />
</nav>


<div class="fileexplorer">

<div style="position: fixed; opacity: 0%; z-index: 0; width: 100%; height: 100%;" oncontextmenu="setDisplay(document.getElementById('dash'), 'block'); return false;">
</div>

<div id="dash" style="color: white; z-index: 10; display:none; background-color: rgb(180,180,180);	top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250);-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; width: 300px; height: 200px; position: absolute; margin: -100px 0 0 -150px; text-align: center;">
<p>		
<form id=\"form_del$divnumber\" action=\"\" method=\"post\" style=\"display:none;">
<input type="hidden" name=\"file_todelete\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container" />
</form>
<form id="form_share$divnumber" action=\"\" method=\"post\" style=\"display:none;\">
<input type="hidden" name="file_toshare\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container" />
</form>
<form id="form_noshare$divnumber" action=\"\" method=\"post\" style=\"display:none;\">
<input type="hidden" name=\"file_noshare\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container" />
</form>
<div id="optn_home">
Options<br /><br />
<a href="#" style="color: white;" onclick="optn_home.style.display='none';newfolder_optn.style.display='block';">
	Nouveau dossier</a><br />
<a href="#" style="color: white;" onclick="optn_home.style.display='none';newfile_optn.style.display='block';">
	Nouveau fichier</a><br />
<a href="#" style="color: white;" onclick="optn_home.style.display='none';upload_optn.style.display='block';">
	Mettre en ligne un fichier</a><br />
		</p>
</div>

<div id="newfile_optn" style="display: none;">
		<form action="" method="post">
		<p style="text-align: center;">
				Nouveau fichier :<br />
				<input type="text" name="newfile" />
				<SELECT name="format" size="1">
			<OPTION value="1">.idc
			<OPTION value="2" selected="selected">.txt
				</SELECT>
				<input type="submit" value="Créer">
		</p>
		</form>
</div>

<div id="newfolder_optn" style="display: none;">
		<form action="" method="post">
		<p style="text-align: center;">
				Nouveau dossier :<br />
				<input type="text" name="newfolder" />
				<input type="submit" value="Créer">
		</p>
		</form>
</div>

<div id="upload_optn" style="display: none;">
<form action="" method="post" enctype="multipart/form-data">
        <p>Envoyer un fichier.<br />
				<input type="hidden"  name="enable"  value="1">
				<label for="monfichier">500 Mo max</label><br />
				<input type="file" name="monfichier" /><br />
                <input type="submit" value="Envoyer" onClick="show_hide_div('loading')"/>
        </p>
</form>
		</form>
</div>


</div>

	
	
<?php
$divnumber=0;

while($element = readdir($dir)) {
	if($element != '.' && $element != '..') {
		if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
		else {$dossier[] = $element;}
	}
}

closedir($dir);

if(!empty($dossier)) {
$h=1;
	sort($dossier); // pour le tri croissant, rsort() pour le tri décroissant
	echo "<p>Liste des dossiers	sur votre cloud :</p> \n\n";
		foreach($dossier as $lien){
	
			$lienaffiche=$lien;
			$taille_ext= 1 + strlen($extension_upload);
			$taillefichier=strlen($lien);
			
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, -$taille_ext);
			}
			$taillefichier=strlen($lienaffiche);
			
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, - $tailefichier + 10);
			$lienaffiche="$lienaffiche.";
			}
			
			if($i3==4){
			$i3=0;
			$h++;
			}
			$i3++;

			echo "\n<div class=\"onefile$i3\"><p><a href=\"?folder=../userdata/$accountid/$lien \"><img src=\"../folder-blue.png\" alt=\"folder\"></a><br />$lienaffiche</p></div>";
		}
}

$w= $h * 210;
echo'<div style="height: '.$w.'px;"><br /></div>';	
$height_footer=0;
if(!empty($fichier)){
	sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
	echo "
	<br /><p>Liste des documents sur votre cloud :</p> \n\n";
		foreach($fichier as $lien) {
			
			$infosfichier = pathinfo($lien);
			$extension_upload = $infosfichier['extension'];

				if ($lien == ".htaccess" || strcmp($lien, $index) == 0){
				}
				
				else
				{
		
			$extension_icon = array("ipa", "bmp", "app", "msi", "exe", "avi", "mkv", "mp4",  "wmv", "mp3", "aac", "flac", "wma", "idc",  "psd",  "jpg",  "jpeg", "png",  "gif", "txt", "pdf", "doc", "odt", "rtf", "docx", "ppt", "pptx", "odp", "ods", "xls", "xlsx", "zip", "rar", "7z", "gz");
			
			if ( ! in_array ($extension_upload, $extension_icon))
			{
			$extension_upload = "other";
			}
			$lienaffiche=$lien;
			
			if (file_exists("../public/$accountid/$lien")) 
			{
			$file_shared="rgb(248,160,0)";
			}
			
			else
			{
			$file_shared="rgb(180,180,180)";
			}
			
			$taille_ext= 1 + strlen($extension_upload);
			$taillefichier=strlen($lien);
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, -$taille_ext);
			}
			$taillefichier=strlen($lienaffiche);
			
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, - $taillefichier + 10);
			$lienaffiche="$lienaffiche.";
			}
					
			if($i==4){
			$i=0;
			}
			
			$i++;
			
			if($i==1){
			$height_footer=$height_footer+210;
			}

			echo "\n<div oncontextmenu=\"setDisplay(document.getElementById('divnumber$divnumber'), 'block'); return false;\" class=\"onefile$i\"><p style='color: $file_shared;'><a href=\"$dir_nom/$lien$container \"><img src=\"../$extension_upload.png\" alt=\"file\"></a><br />$lienaffiche</p></div>";
			echo "\n<div id=\"divnumber$divnumber\"
		style=\"color: white; z-index: 10; display:none; background-color: rgb(180,180,180);	top: 50%; left: 50%; padding:10px; border:1px solid rgb(250,250,250);-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; width: 200px; height: 300px; position: absolute; margin: -150px 0 0 -100px; text-align: center;\">
		<p>		
		<form id=\"form_del$divnumber\" action=\"\" method=\"post\" style=\"display:none;\">
		<input type=\"hidden\" name=\"file_todelete\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
		</form>
		<form id=\"form_share$divnumber\" action=\"\" method=\"post\" style=\"display:none;\">
		<input type=\"hidden\" name=\"file_toshare\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
		</form>
		<form id=\"form_noshare$divnumber\" action=\"\" method=\"post\" style=\"display:none;\">
		<input type=\"hidden\" name=\"file_noshare\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
		</form>

		$lienaffiche<br /><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"rendivnumber$divnumber.style.display='none';movedivnumber$divnumber.style.display='block';\">
		Déplacer</a><br />";
		
		if($infosfichier['extension'] == "aes"){
		echo"<a href=\"#\" style=\"color: white;\" onclick=\"rendivnumber$divnumber.style.display='none';uncryptdivnumber$divnumber.style.display='block';\">
		Déchiffrer</a><br />";}
		
		else{
		echo"<a href=\"#\" style=\"color: white;\" onclick=\"rendivnumber$divnumber.style.display='none';cryptdivnumber$divnumber.style.display='block';\">
		Chiffrer</a><br />";}
		
		echo "<a href=\"#\" style=\"color: white;\" onclick=\"document.getElementById('form_share$divnumber').submit(); return false;\">
		Partager</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"document.getElementById('form_noshare$divnumber').submit(); return false;\">
		Personnel</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"cryptdivnumber$divnumber.style.display='none';rendivnumber$divnumber.style.display='block';\">
		Renommer</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"document.getElementById('form_del$divnumber').submit(); return false;\">
		Supprimer</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"document.getElementById('form_get$divnumber').submit(); return false;\">
		Télécharger</a><br />
		<a href=\"#\" style=\"color: white;\" onclick=\"rendivnumber$divnumber.style.display='none';propdivnumber$divnumber.style.display='block';\">
		Propriétés</a><br />
				</p>
		
		<div id=\"rendivnumber$divnumber\" style=\"display:none; z-index:20; position: relative; width: 100%; margin-top: 10%;\">
		
		<form action=\"\" method=\"post\">
		<p style=\"text-align: center;\">
		<input type=\"hidden\" name=\"file_torename\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
				Nouveau nom :<br />
				<input type=\"text\" name=\"name_torename\" />
				<input type=\"submit\" value=\"Renommer\">
		</p>
		</form>
		</div>
		
		<div id=\"cryptdivnumber$divnumber\" style=\"display:none; z-index:20; position: relative; width: 100%; margin-top: 10%;\">
		
		<form action=\"\" method=\"post\">
		<p style=\"text-align: center;\">
		<input type=\"hidden\" name=\"file_tocrypt\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
				Mot de passe :<br />
				<input type=\"password\" name=\"crypt_pwd\" />
				<input type=\"submit\" value=\"Crypter\">
		</p>
		</form>
		</div>
		
		<div id=\"uncryptdivnumber$divnumber\" style=\"display:none; z-index:20; position: relative; width: 100%; margin-top: 10%;\">
		
		<form action=\"\" method=\"post\">
		<p style=\"text-align: center;\">
		<input type=\"hidden\" name=\"file_touncrypt\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />
				Mot de passe :<br />
				<input type=\"password\" name=\"crypt_pwd\" />
				<input type=\"submit\" value=\"Décrypter\">
		</p>
		</form>
		</div>		
		
		
		<div id=\"propdivnumber$divnumber\" style=\"display:none; z-index:20; position: relative; width: 100%; margin-top: 10%;\">
		
		<p style=\"text-align: center;\">";		
		$file_size = shell_exec("cd ../userdata/$accountid/$folder; du -s $lien");
		$file_size = substr($file_size, 0, -1);
		$file_size = round( $file_size / 1024, 1, PHP_ROUND_HALF_UP);
		
		echo "Taille : $file_size Mo
		</p>		
		</div>		
		
		
		<div id=\"movedivnumber$divnumber\" style=\"display:none; z-index:20; position: relative; width: 100%; margin-top: 10%;\">
	<form action=\"\" method=\"post\">
		<input type=\"hidden\" name=\"file_tomove\" value=\"http://idata.no-ip.info/userdata/$dir_nom/$lien$container\" />		
		<p style=\"text-align: center;\">
		Dossier de destination :
		
	<SELECT name=\"folder_tomove\">
	<OPTION value=\"\">Racine";
	sort($dossier);
		foreach($dossier as $lien){	
			$lienaffiche=$lien;
			$taille_ext= 1 + strlen($extension_upload);
			$taillefichier=strlen($lien);
			
			if ($taillefichier > 10){
			$lienaffiche=substr("$lienaffiche", 0, -$taille_ext);
			}
			$taillefichier=strlen($lienaffiche);
			
			if ($taillefichier > 10){
			$lienaffiche=substr("$lienaffiche", 0, - $tailefichier + 10);
			$lienaffiche="$lienaffiche.";
			}			
			echo "<OPTION value=\"http://idata.no-ip.info/userdata/$accountid/$lien\">$lienaffiche</OPTION>";
			}
			echo "</SELECT>
			<input type=\"submit\" value=\"Déplacer\">
			</p></form>
		</div></div>";
		$divnumber++;
		}
		
	}
 }
 
 if($i==0)
 {
 echo "<p>Vide !<br /><img src='../images/wrong.png' alt='oups' style='width: 300px;'/></p>";
 }
 ?>
</div>
 </div> 

 
 <div id="id1" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="" method="post" enctype="multipart/form-data">
        <p>Envoyer un fichier.<br />
				<input type="hidden"  name="enable"  value="1">
				<label for="monfichier">500 Mo max</label><br />
				<input type="file" name="monfichier" /><br />
                <input type="submit" value="Envoyer" onClick="show_hide_div('loading')"/>
        </p>
</form>
</div>

<div id="loading" style="Display: none;" class="loadingindicator">
<img src="../loading.gif" alt="loading" style="width: 100px;">
</div>
</div>

 <div id="del" class="mydocsdelete" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="" method="post">
        <p>Déplacez un fichier à supprimer :<br />
				<input type="text" name="file_todelete" /><br />
                <input type="submit" value="Supprimer"/>
        </p>
</form>
</div>
</div>

 <div id="get" class="mydocsdelete" style="Display: none;">
 <div  class="mydocsuploaddiv">
 <p>pour télécharger un fichier, cliquez dessus :)</p>
</div>
</div>

 <div id="share" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="" method="post">
        <p>Déplacez un fichier à partager :<br />
				<input type="text" name="file_toshare" /><br />
                <input type="submit" value="Partager"/>
        </p>
</form>
</div>
</div>

<div id="move" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="" method="post">
        <p>Faites glisser le fichier à déplacer :<br />
				<input type="text" name="file_tomove" /><br />
		<p>Faites gliser le dossier de destination :<br />
				<input type="text" name="folder_tomove" /><br />
                <input type="submit" value="Move"/>
        </p>
</form>
</div>
</div>
 
 <div id="rename" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="" method="post">
        <p>Déplacez un fichier à renommer :<br />
				<input type="text" name="file_torename" /><br />
			Nouveau nom :
				<input type="text" name="name_torename" /><br />
                <input type="submit" value="Rename"/>
        </p>
</form>
</div>
</div>

 <div id="newfile" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="" method="post">
        <p>Fichier : <input type="text" name="newfile" />
		<SELECT name="format" size="1">
		<OPTION value="1">.idc
		<OPTION value="2" selected="selected">.txt
		</SELECT>
		<br /><br />
         Dossier : <input type="text" name="newfolder" /><br />
		 <input type="submit" value="Créer"/>
        </p>
</form>
</div>
</div>


 <div id="remind" class="reminderwidget" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="../remind.php" method="post">
        <p>Titre :	<input type="text" name="title" /><br />
			Date (YYYY/MM/DD): <input type="date" name="date" /><br />
			Heure&min (hh:mm)	: <input type="time" name="hour" /><br /><br />
			Prio :
	
<input type="radio" name="priority" id="1" value="1" style="visibility: hidden;"/>
<label for="1"><img style=" padding: 0px;" id="1l" src="../1.png" alt="Low" onclick="setchecked();this.src='c1.png'"/></label>
<input type="radio" name="priority" id="2" value="2" style="visibility: hidden"/>

<label for="2"><img style=" padding: 0px;" id="2l" src="../2.png" alt="Low" onclick="setchecked();this.src='c2.png'"/></label>
<input type="radio" name="priority" id="3" value="3" style="visibility: hidden"/>

<label for="3"><img style=" padding: 0px;" id="3l" src="../3.png" alt="Quite high" onclick="setchecked();this.src='c3.png'"/> </label>
<input type="radio" name="priority" id="4" value="4" style="visibility: hidden"/>

<label for="4"><img style=" padding: 0px;" id="4l" src="../4.png" alt="High" onclick="setchecked();this.src='c4.png'"/> </label><br /><br />
<input type="submit" value="Rappelez moi"/>
        </p>
</form>
</div>
</div>
 

<?php
if($fileuploadresult==1)
{
?>
 <div id="uploadlog" class="sharesuccess">
 <div  class="mydocsuploaddiv">
    <?php echo '<a href="mydocs.php"><img src="../delete.png" alt="Close" class="quitshare"></a><br /><p>'.$uploadlog.'</p>' ?>
</div>
</div>
 <?php
}
 
if (isset ($_GET['share']))
{
?>
 <div id="share" class="sharesuccess">
 <div  class="mydocsuploaddiv">
    <?php echo '<a href="mydocs.php"><img src="../delete.png" alt="Close" class="quitshare"></a><br /><p>Votre fichier est disponnible à cette addresse : <a href="http://idata.no-ip.info/public/'.$accountid.'/'.$_GET['share'].'">http://idata.no-ip.info/public/'.$accountid.'/'.$_GET['share'].'</a><br /><br />Donnez ce liens aux personnes avec lequelles vous voulez partager ce fichier. <br /></p>' ?>
</div>
</div>

<?php
}

if ($height_footer+$w+220 < 1010){
$height_footer = 1010-$w-220;
}

?>
<footer style="background-color: rgb(180,180,180); width: 100%; position: absolute; height: 110px; left: 0px; top: <? echo $height_footer+$w+220; ?>px;" >
	<p style="display: inline;font-family:'Century Gothic', Arial; font-size: 12px;" ><a href="../index.php?lang=en"><img src="../images/en.png" alt="english" style="width: 35px; position: relative; top: 10px; left: 10px;"></a> <a href="../warning.php"><img src="../lock.png" style="width:45px; position: relative; top: 8px; left:5px;" alt="HTTPS"></a> <a href="../about.php"><img src="../../images/who.png" alt="A propos" style="width:35px; position: relative; top: 5px;"></a>  <a href="https://www.facebook.com/idata.cloud"><img style="width: 35px;position: relative; top: 5px;"src="../images/fb.png" alt="Facebook"></a><a href="https://twitter.com/iDatacloud"><img style="width: 35px;position: relative; top: 5px;"src="../images/tw.png" alt="Twitter"></a></p>
	<div style="float: right;"> <p style="font-family:'Century Gothic', Arial; font-size: 12px;" >Partenaires : <a href="http://mtfo.fr/" target="_blank"><img src="../../images/mtfo.png" alt="MTFO" style="height: 25px; position: relative; top: 5px;"></a>   <a href="http://www.geektheory.net/" target="_blank"><img src="../../images/gt.png" alt="Geek Theory" style="height: 25px; position: relative; top: 6px;"></a></p>
</div>	
<p style="font-family:'Century Gothic', Arial; font-size: 12px; text-align: center;" >Copyright © 2013 Evan OLLIVIER. Tous droits réservés.</p>
</footer>

</body>
</html>
<?php }}

else{
 echo '<meta http-equiv="Refresh" content="0;url=index.php">';
}

 ?>