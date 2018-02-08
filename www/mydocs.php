<?php
session_start();


$fileuploadresult=0;
$taillefichier=0;
$h=0;
$i3=0;
$extension_upload='';
$maxupload = 1048576000;
$taillego = 1;

if(!empty($_SESSION['accountid']))
{
$i=0;
$accountid=$_SESSION['accountid'];
$dir_nom = "userdata/$accountid"; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')


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
header('Location: move.php?file_tomove='.$_POST['file_tomove'].'&folder_tomove='.$_POST['folder_tomove'].'');
}

if (isset($_POST['file_todelete']))
{
header('Location: delete.php?file='.$_POST['file_todelete'].'');
}

if (isset($_POST['file_torename']) AND isset($_POST['name_torename']))
{
header('Location: rename.php?file='.$_POST['file_torename'].'&name='.$_POST['name_torename'].'');
}

if (isset($_POST['file_toshare']))
{
header('Location: share.php?file='.$_POST['file_toshare'].'');
}


if (isset($_FILES['monfichier']))
{
$taille = shell_exec("cd userdata/$accountid; du -s");
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
				
				if (! file_exists("userdata/$accountid/".basename($_FILES['monfichier']['name']).""))
				{
           
					if (!in_array($extension_upload, $extension_interdite))
					{
						$fichier = basename($_FILES['monfichier']['name']);
						$fichier = strtr($fichier,'
						ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
						'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
						$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
						
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['monfichier']['tmp_name'], "userdata/$accountid/" . basename($_FILES['monfichier']['name']));
                        
						$filerename = basename($_FILES['monfichier']['name']);
						$extension =strrchr($filerename,'.');
						$extension = strtolower($extension);
						$filerename = substr("$filerename" , 0, -(strlen($extension)));
						
						rename("userdata/$accountid/".basename($_FILES['monfichier']['name'])."", "userdata/$accountid/$filerename$extension");
						
						$uploadlog = "The file is on the cloud ;-) !";
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
			$uploadlog = "Error : Your cloud is full";
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
$dir_nom = "userdata/$accountid/".basename($folder)."";
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
$createfile = fopen('userdata/'.$accountid.'/'. basename($newfile).'.txt', 'a+');
fclose($createfile);
}

else if( $_POST['format'] == 1){
$createfile = fopen('userdata/'.$accountid.'/'. basename($newfile).'.idc', 'a+');
fclose($createfile);
}
}

//Nouveau dossier
if (isset ($_POST['newfolder'])){
$newfolder= $_POST['newfolder'];
mkdir('userdata/'.$accountid.'/'.basename($newfolder).'');
}

//Téléchargement ou ouverture
if (isset ($_GET['file_download'])){
$file_download=$_GET['file_download'];
	if(isset($_GET['container']))
	{$container = ''.basename($_GET['container']).'/'; }
	else
	{$container= '';}

if (($file_download != "") && (file_exists("userdata/$accountid/$container" . basename($file_download))))
{
$infosfichier = pathinfo(basename($file_download));
$extension_upload = $infosfichier['extension'];
$pictures_ext = array ("jpg", "png", "gif", "bmp", "jpeg");

if ($extension_upload == ("txt")){
header("Location: text.php?file=".basename($file_download)."&container=$container");
exit();
}

else if ($extension_upload == ("idc")){
header("Location: myaccount.php?file=".basename($file_download)."&container=$container");
exit();
}

else if (in_array ($extension_upload, $pictures_ext)){
header("Location: picture.php?file=".basename($file_download)."&container=$container");
exit();
}

else{
$size = filesize("userdata/$accountid/$container" . basename($file_download));
header("Content-Type: application/force-download; name=\"" . basename($file_download) . "\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $size");
header("Content-Disposition: attachment; filename=\"" . basename($file_download) . "\"");
header("Expires: 0");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
readfile("userdata/$accountid/$container" . basename($file_download));
exit();
} } }


if (isset($_GET['lang'])){
$lang=$_GET['lang'];
	if ($lang=='en'){	}
}

else{
$lang=substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2); 
if ($lang == 'fr'){
header("Location: /fr/mydocs.php");}
}
 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
        <title>iData - My documents</title>
		<link rel="icon" type="image/png" href="cloud.png" />
    </head>
    <body style="background-color: rgb(255,255,255);">
	
<?php include_once("piwiktrack.php");
include_once("header-connected-en.php");
?>
<nav class="mydocsnav" style="margin-top: 50px;">
<h2 style="margin-left: 3px;">Hello <? echo $_SESSION['firstname'];?></h2>

<script>
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


function reply_click(clicked_id)
{
    alert(clicked_id);
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

<!--<a href="mydocs.php"><img src="home.png" alt="home" class="homebutton" title="Home"></a><br />-->
<?php
$taille_brute = shell_exec("cd userdata/$accountid; du -s");
$taille = substr($taille_brute, 0, -1);
$taille = round( $taille / 1024, 0, PHP_ROUND_HALF_UP);
echo '<p style="margin-left: 3px;" >Use : '.$taille.'Mo/'.$taillego.'Go</p>';
?>

<a href="#"><img src="new.png" alt="new" class="sendlogo" title="New file" onClick="hide_div('newfile');show_hide_div('newfile')"></a><br />
<a href="#"><img src="move.png" alt="move" class="renamebutton" title="Move a file" onClick="hide_div('move');show_hide_div('move')"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="upload.png" alt="upload" class="sendlogo_2" title="Upload" onClick="hide_div('id1');show_hide_div('id1')"></a>
<a href="#"><img src="rename.png" alt="rename" class="renamebutton" title="Rename a file" onClick="hide_div('rename');show_hide_div('rename')"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="delete.png" alt="remove" class="removebutton" title="Remove a file" onClick="hide_div('del');show_hide_div('del')"></a>
<a href="#"><img src="remind.png" alt="remind" class="remindbutton" title="Remind me something" onClick="hide_div('remind');show_hide_div('remind')"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="get.png" alt="get" class="getbutton" title="Download a file" onClick="hide_div('get');show_hide_div('get')"></a>
<a href="#"><img src="share.png" alt="share" class="sharebutton" title="Share a file" onClick="hide_div('share');show_hide_div('share')"></a>
<br /><p>&nbsp </p><br />
</nav>

 
<div class="fileexplorer">
<?php
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
	echo "<p>List of available folders in your cloud :</p> \n\n";
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

			echo "\n<div class=\"onefile$i3\"><p><a href=\"?folder=userdata/$accountid/$lien \"><img src=\"folder-blue.png\" alt=\"folder\"></a><br />$lienaffiche</p></div>";
		}
}

$w= $h * 210;
echo'<div style="height: '.$w.'px;"><br /></div>';	
$height_footer=0;
if(!empty($fichier)){
	sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
	echo "
	<br /><p>List of available documents in your cloud :</p> \n\n";
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
			
			if (file_exists("public/$accountid/$lien")) 
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

			echo "\n<div class=\"onefile$i\"><p style='color: $file_shared;'><a href=\"$dir_nom/$lien$container \"><img src=\"$extension_upload.png\" alt=\"file\"></a><br />$lienaffiche</p></div>";
			
				}
		}
 }
 
 if($i==0)
 {
 echo "Your cloud is empty";
 }
 ?>
 </div> 

 
 <div id="id1" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="mydocs.php" method="post" enctype="multipart/form-data">
        <p>Send a file to your cloud.<br />
				<input type="hidden"  name="enable"  value="1">
				<label for="monfichier">500 Mo max</label><br />
				<input type="file" name="monfichier" /><br />
                <input type="submit" value="Send !" onClick="show_hide_div('loading')"/>
        </p>
</form>
</div>

<div id="loading" style="Display: none;" class="loadingindicator">
<img src="loading.gif" alt="loading" style="width: 100px;">
</div>
</div>

 <div id="del" class="mydocsdelete" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="" method="post">
        <p>Drag&Drop a file to delete :<br />
				<input type="text" name="file_todelete" /><br />
                <input type="submit" value="Delete"/>
        </p>
</form>
</div>
</div>

 <div id="get" class="mydocsdelete" style="Display: none;">
 <div  class="mydocsuploaddiv">
 <p>To download a file, just click on it :)</p>
</div>
</div>

 <div id="share" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="mydocs.php" method="post">
        <p>Drag&Drop a file to share :<br />
				<input type="text" name="file_toshare" /><br />
                <input type="submit" value="Share"/>
        </p>
</form>
</div>
</div>

 <div id="move" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="mydocs.php" method="post">
        <p>Drag&Drop a file to move :<br />
				<input type="text" name="file_tomove" /><br />
		<p>Drag&Drop the destination folder :<br />
				<input type="text" name="folder_tomove" /><br />
                <input type="submit" value="Move"/>
        </p>
</form>
</div>
</div>
 
 <div id="rename" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="" method="post">
        <p>Drag&Drop a file to rename :<br />
				<input type="text" name="file_torename" /><br />
			New name (without extension) :
				<input type="text" name="name_torename" /><br />
                <input type="submit" value="Rename"/>
        </p>
</form>
</div>
</div>

 <div id="newfile" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="" method="post">
        <p>New file : <input type="text" name="newfile" />
		<SELECT name="format" size="1">
		<OPTION value="1">.idc
		<OPTION value="2" selected="selected">.txt
		</SELECT>
		<br /><br />
         New folder : <input type="text" name="newfolder" /><br />
		 <input type="submit" value="Create"/>
        </p>
</form>
</div>
</div>


 <div id="remind" class="reminderwidget" style="Display: none;">
 <div  class="mydocsuploaddiv">
<form action="remind.php" method="post">
        <p>Title :	<input type="text" name="title" /><br />
			Date (YYYY/MM/DD): <input type="date" name="date" /><br />
			Hour&Minute (hh:mm)	: <input type="time" name="hour" /><br /><br />
			Priority :
	
<input type="radio" name="priority" id="1" value="1" style="visibility: hidden;"/>
<label for="1"><img style=" padding: 0px;" id="1l" src="1.png" alt="Low" onclick="setchecked();this.src='c1.png'"/></label>
<input type="radio" name="priority" id="2" value="2" style="visibility: hidden"/>

<label for="2"><img style=" padding: 0px;" id="2l" src="2.png" alt="Low" onclick="setchecked();this.src='c2.png'"/></label>
<input type="radio" name="priority" id="3" value="3" style="visibility: hidden"/>

<label for="3"><img style=" padding: 0px;" id="3l" src="3.png" alt="Quite high" onclick="setchecked();this.src='c3.png'"/> </label>
<input type="radio" name="priority" id="4" value="4" style="visibility: hidden"/>

<label for="4"><img style=" padding: 0px;" id="4l" src="4.png" alt="High" onclick="setchecked();this.src='c4.png'"/> </label><br /><br />
<input type="submit" value="Remind me !"/>
        </p>
</form>
</div>
</div>
 

<?php
if($fileuploadresult==1)
{
?>
 <div id="uploadlog" class="reminderwidget">
 <div  class="mydocsuploaddiv">
    <?php echo '<a href="mydocs.php"><img src="delete.png" alt="Close" class="quitshare"></a><br /><p>'.$uploadlog.'</p>' ?>
</div>
</div>
 <?php
}
 
if (isset ($_GET['share']))
{
?>
 <div id="share" class="sharesuccess">
 <div  class="mydocsuploaddiv">
    <?php echo '<a href="mydocs.php"><img src="delete.png" alt="Close" class="quitshare"></a><br /><p>Done ! Your file is now available at this address : <a href="http://idata.no-ip.info/public/'.$accountid.'/'.$_GET['share'].'">http://idata.no-ip.info/public/'.$accountid.'/'.$_GET['share'].'</a><br /><br />Give this link to people with whom you want to share this file. <br /></p>' ?>
</div>
</div>

<?php
}
 } 
 else
 {
 echo '<meta http-equiv="Refresh" content="0;url=signin.php">';
 }
?>

<!-- <footer style="background-color: rgb(180,180,180); width: 100%; position: absolute; height: 110px; left: 0px; top: <? echo $height_footer+$w+220; ?>px;" >
	<p style="display: inline;font-family:'Century Gothic', Arial; font-size: 12px;" ><a href="../index.php?lang=en"><img src="../images/en.png" alt="english" style="width: 35px; position: relative; top: 10px; left: 10px;"></a> <a href="../warning.php"><img src="../lock.png" style="width:45px; position: relative; top: 8px; left:5px;" alt="HTTPS"></a> <a href="../about.php"><img src="../images/who.png" alt="A propos" style="width:35px; position: relative; top: 5px;"></a>  <a href="https://www.facebook.com/idata.cloud"><img style="width: 35px;position: relative; top: 5px;"src="../images/fb.png" alt="Facebook"></a><a href="https://twitter.com/iDatacloud"><img style="width: 35px;position: relative; top: 5px;"src="../images/tw.png" alt="Twitter"></a></p>
	<div style="float: right;"> <p style="font-family:'Century Gothic', Arial; font-size: 12px;" >Partenaires : <a href="http://mtfo.fr/" target="_blank"><img src="../images/mtfo.png" alt="MTFO" style="height: 25px; position: relative; top: 5px;"></a>   <a href="http://www.geektheory.net/" target="_blank"><img src="../images/gt.png" alt="Geek Theory" style="height: 25px; position: relative; top: 6px;"></a></p>
</div>	
<p style="font-family:'Century Gothic', Arial; font-size: 12px; text-align: center;" >Copyright © 2013 Evan OLLIVIER. Tous droits réservés.</p>
</footer>-->

</body>
</html>